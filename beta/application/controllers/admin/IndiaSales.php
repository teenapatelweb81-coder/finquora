<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class IndiaSales extends CI_Controller
{
    private $baseUrl = 'https://api.indiasales.club';
    private $apiKey  = '82c8a81b-2b91-41f7-ac68-723116165b94';
    private $encKey = '96d5b0a8f2923743283748bf5904b622';
    private $encIv  = '40b702932f399b0d';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }

    /* ===============================
       ENTRY POINT
    ================================*/
    public function login()
    {
        $userId = $this->session->userdata('user_id');
        $role   = $this->session->userdata('role');

        if (!$userId) redirect('/login');

        $user = $this->db->where('id', $userId)
                         ->where('role', $role)
                         ->get('user_master')
                         ->row_array();
        if (empty($user)) {
            $user = $this->db->where('id', $userId)
                             ->where('role', $role)
                             ->get('branch_franchise')
                             ->row_array();
        }
        if (!empty($user) && in_array($user['parent_id'], [1, 2066, 2044]) || $user['type'] == 'admin') {
           $user = $this->db->where('id', 1)
                         ->where('role', 1)
                         ->get('user_master')
                         ->row_array();
        }
        
        if (!$user) {
            show_error('User not found', 404);
        }
        $this->createAndLogin($user);
    }

    /* ===============================
       🔐 INDIA SALES ENCRYPTION
    ================================*/
    private function encryptData($plainText)
    {
        // SAME AS JSON.stringify()
        $jsonText = json_encode($plainText);

        $encrypted = openssl_encrypt(
            $jsonText,
            'AES-256-CBC',
            $this->encKey,
            OPENSSL_RAW_DATA,
            $this->encIv
        );

        if ($encrypted === false) {
            throw new Exception('Encryption failed');
        }

        // base64 + encodeURIComponent
        return rawurlencode(base64_encode($encrypted));
    }

    /* ===============================
       CREATE USER + LOGIN
    ================================*/
    private function createAndLogin($user)
    {
        try {
           
            $mobile = (string) $user['mobile_no'];
            $report = '9890284889';

            $encryptedPhone = $this->encryptData($mobile);
            $encryptedReport = $this->encryptData($report);
            

            $payload = [
                "phoneNumber" => $encryptedPhone,
                "iv"          => $this->encIv, // FIXED IV

                "personalDetails" => [
                    "name"   => $user['name'],
                    "gender" => ""
                ],

                "reportingTo" => $encryptedReport,
                "designation" => "Member",
                "referenceId" => (string)$user['id'],
                "occupation"  => "",
                "annualIncome"=> 0,
                "memberId"=> '3G6G7480'
            ];


            $response = $this->callApi(
                '/api/v1/agency/user/createAndLogin',
                $payload
            );
            

            // if (empty($response['success'])) {
            //     throw new Exception($response['msg'] ?? 'IndiaSales error');
            // }
            if (empty($response['success'])) {
                if (
                    !empty($response['msg']) &&
                    stripos($response['msg'], 'already exists') !== false
                ) {
                    $this->generateTransferToken($user);
                    return;
                }
                throw new Exception($response['msg'] ?? 'IndiaSales error');
            }

            if (!empty($response['data']['userId'])) {
                if ($user['role'] == 3) {
                    $this->db->where('id', $user['id'])->where('role', $user['role'])
                             ->update('user_master', [
                                 'indiasales_user_id' => $response['data']['userId']
                             ]);
                } else {
                    $this->db->where('id', $user['id'])->where('role', $user['role'])
                             ->update('branch_franchise', [
                                 'indiasales_user_id' => $response['data']['userId']
                             ]);
                }
            }

             $transferToken = $response['data']['accessToken'];

            $loginUrl = 'https://www.indiasales.club/link/' . $transferToken;

            redirect($loginUrl);
            exit;

        } catch (Exception $e) {
            show_error($e->getMessage(), 500);
        }
    }

    /* ===============================
       TRANSFER TOKEN
    ================================*/
    private function generateTransferToken($user)
    {
        try {
            $payload = [
                "phoneNumber" => $this->encryptData((string)$user['mobile_no']),
                "iv"          => $this->encIv
            ];

            $response = $this->callApi(
                '/api/v1/agency/auth/transfer-token',
                $payload
            );

          if (empty($response['success'])) {
                throw new Exception($response['msg'] ?? 'Token error');
            }

            if (empty($response['data']['accessToken'])) {
                throw new Exception('Transfer token not received');
            }

            $transferToken = $response['data']['accessToken'];

            $loginUrl = 'https://www.indiasales.club/link/' . $transferToken;

            redirect($loginUrl);
            exit;


        } catch (Exception $e) {
            show_error($e->getMessage(), 500);
        }
    }

    /* ===============================
       CURL HELPER
    ================================*/
    private function callApi($endpoint, array $payload)
    {
        $url = $this->baseUrl . $endpoint;
        $jsonPayload = json_encode($payload);
        

        $ch = curl_init($url);

        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => true,  // Include headers in output
            CURLOPT_POST           => true,
            CURLOPT_HTTPHEADER     => [
                'x-api-key: ' . $this->apiKey,
                'Content-Type: application/json'
            ],
            CURLOPT_POSTFIELDS     => $jsonPayload,
            CURLOPT_TIMEOUT        => 30,
            CURLINFO_HEADER_OUT    => true  // Enable tracking of the request header
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $responseHeaders = substr($response, 0, $headerSize);
        $responseBody = substr($response, $headerSize);

        if ($response === false) {
            $error = curl_error($ch);
            $errno = curl_errno($ch);
            curl_close($ch);
            throw new Exception("cURL Error ($errno): $error");
        }

        $info = curl_getinfo($ch);
        curl_close($ch);


        $decodedResponse = json_decode($responseBody, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return $responseBody; // Return raw response if not valid JSON
        }

        return $decodedResponse;
    }
}
