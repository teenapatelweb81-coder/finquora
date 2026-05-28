<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    
    public function  __construct()
   {
     parent::__construct();
     $this->load->library('session');
     $this->load->library('form_validation');
     $this->load->helper('form');
     $this->load->model('admin/Login_Model');
    }
 
  public function sso_login()
{
    $user_id = $this->input->get('user_id');
    $time    = $this->input->get('time');
    $hash    = $this->input->get('hash');

    $secret = "MY_SECRET_123";

    // ⏱️ Expire link after 60 seconds
    if (empty($time) || (time() - $time > 60)) {
        show_error('Link expired');
    }

    // 🔐 Verify hash
    $verifyHash = hash_hmac('sha256', $user_id . '|' . $time, $secret);

    if ($hash !== $verifyHash) {
        show_error('Invalid token');
    }

    // 👤 Get user
    $user = $this->db->where('id', $user_id)->get('user_master')->row();

    if (!$user) {
        show_error('User not found');
    }

    // ✅ Set session (LOGIN SUCCESS)
    $this->session->set_userdata([
        'adminEmail'    => $user->email,
        'authenticated' => true,
        'user_id'       => $user->id,
        'username'      => $user->username ?? null,
        'role'          => $user->role ?? null,
        'name'          => $user->name ?? null,
    ]);

    // 🚀 Redirect to dashboard
    redirect('admin-dashboard');
}
  
public function index()
{
 $currentDomain = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http")
                      . "://" . $_SERVER['HTTP_HOST'] . '/';
    $domainData = $this->db->where('url', $currentDomain)
                           ->get('domains')
                           ->row();
    if (!$domainData || $domainData->status != 1) {

        $data['domain'] = $currentDomain;
        $data['message'] = "The website you are trying to access is currently unavailable or not authorized for use.";

        return $this->load->view('access_denied', $data);
    }


     if ($this->session->userdata('authenticated')) {
        redirect('admin/Dashboard');
    }
    $this->load->library('form_validation');
    $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
    $this->form_validation->set_rules('password', 'Password', 'required|trim');
    $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');

    if ($this->form_validation->run() == false) {
        $this->load->view('admin/login');
    } else {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $type = $this->uri->segment(2);
        $domain_id = domain_id_get();
        $user = null;
        if ($type === 'admin') {
            $user = $this->db->where('email', $email)
                ->where('role', 1)
                ->where('domain_id', $domain_id)
                ->where('password', MD5($password))
                ->get('user_master')
                ->row();
                // print_r($this->db->last_query());die;
        } elseif ($type === 'branch') {
            $user = $this->db->where('email', $email)->where('status', 1)
               ->where('role', 3)
               ->where('domain_id', $domain_id)
               ->where('password', MD5($password))
                ->get('branch_franchise')
                ->row();
        } else {
            $user = $this->db->where('email', $email)
                ->where('role', 2)
                ->where('domain_id', $domain_id)
                ->where('password', MD5($password))
                ->where('status', 1)
                ->get('user_master')
                ->row();
        }

        // print_r($this->db->last_query());die;
        // Validate user and password
        if ($user) {
            $storedPassword = $user->password;
           
                $userData = [
                    'adminEmail'    => $user->email,
                    'authenticated' => true,
                    'user_id'       => $user->id,
                    'username'      => $user->username ?? null,
                    'role'          => $user->role ?? null,
                    'name'          => $user->name ?? null,
                    'type'          => $user->type ?? null,
                ];

                // Set session data
                $this->session->set_userdata($userData);

                // Redirect user with a success message
                if (!empty($user->role) && $user->role != 1) {
                    $this->session->set_flashdata('success', 'Welcome! ' . $user->name);
                }
                if ($this->session->userdata('role') != 1 ) {
                  if($user->signature == null || (!empty($user->signature) && $user->agreement_status == 'pending')){
                    if($user->signature == NULL){
                      $this->session->set_flashdata('message', 'Please upload your signature');
                      }elseif($user->agreement_status == 'pending'){
                        $this->session->set_flashdata('message', 'Please upload your agreement');
                      }
                    redirect('admin/agreement');
                   }elseif($user->change_password_status == 1 || $user->skip == 0){
                    redirect('admin/change-password');
                   }else{
                    redirect('admin-dashboard');
                   }
                    // echo '1';die;
                } elseif ($user->change_password_status == 1 || $user->skip == 0) {
                    redirect('admin/change-password');
                    // echo '2';die;
                } else {
                    redirect('admin-dashboard');
                    // echo '3';die;
                }
        }

        // Authentication failed
        $this->session->set_flashdata('message', 'Invalid Email or Password. Please try again!');
        redirect('desk-login/' . $type);
    }
}

   public function forgot_password() {
       $mobile_no = $this->input->post('mobile_no');
       $email = $this->input->post('email');
      $type = $this->uri->segment(3);
      if($type == 'branch' ){
        $emailStatus = $this->db->where(array('mobile_no' => $mobile_no, 'email'=> $email, 'role' => 3,'status!=' => 3))->where('email not like', '%Unpaid%')->get('branch_franchise')->row_array();
      }else {
        $emailStatus = $this->db->where(array('mobile_no' => $mobile_no, 'email'=> $email, 'role' => 2,'status!=' => 3))->where('email not like', '%Unpaid%')->get('user_master')->row_array();
      }

// print_r($emailStatus);die;
      $email_config = $this->db->where('domain_id', domain_id_get())->get('email_config')->row_array();
      $admin_name = $this->db->where('domain_id', domain_id_get())->get('contect_us')->row_array();
      $domain = $this->db->where('id', domain_id_get())->get('domains')->row_array();

        if($emailStatus['mobile_no']) {
            $pass = $this->randomPassword();
            
            // update paswword
            $Updatedata['password'] = MD5($pass);
            

               if($type == 'branch' ){

                  $up = $this->Login_Model->update_password($emailStatus['id'], $mobile_no, $Updatedata,'branch_franchise');
                  $this->db->update('branch_franchise', ['pass_text' => $pass], ['id' => $emailStatus['id']]);
                }else {
                  if (empty($up)) {
                    $up = $this->Login_Model->update_password($emailStatus['id'],$mobile_no, $Updatedata,'user_master');
                    $this->db->update('user_master', ['pass_text' => $pass], ['id' => $emailStatus['id']]);
                  }
                }

            if ($up) {
              $this->session->set_flashdata('message','Password Updated.');
            }

            $userdata =  $this->db->where(array('mobile_no' => $mobile_no,'email'=> $email,'role' => 2))->where('email not like', '%Unpaid%')->get('user_master')->row();
            if (empty($userdata)) {
              $userdata =  $this->db->where(array('mobile_no' => $mobile_no,'email'=> $email,'role' => 3))->where('email not like', '%Unpaid%')->get('branch_franchise')->row();
            }
            
            $mobile = $userdata->mobile_no;

            $to = $email;
            $subject = "Forget Password";
            
            $message = "Your have generated a new password for " . (!empty($admin_name['company_title']) ? $admin_name['company_title'] : '') . ". Your New Password is:<strong>".$pass ."</strong>";
            $message .= "\nDo not share with anyone.";
            
            $header = "From:" . (!empty($email_config['from_email']) ? $email_config['from_email'] : '') . " \r\n";
            $header .= "MIME-Version: 1.0\r\n";
            $header .= "Content-type: text/html\r\n";
             
            // $retval = mail ($to,$subject,$message,$header);
            
            $sms_message = "Dear%20Customer,%20Welcome%20to%20Instant%20Loans%20Deals%20Your%20Password%20is%20".$pass."%20More%20details:%20https://www.instantloansdeals.com%20EXELORA%20CONSULTANCY";
            
	        //  $this->send_sms($mobile,$sms_message);
          if($domain['social_status'] == 'sms') {$this->send_sms($mobile, $sms_message);}else{$this->send_mail($to, $subject, $message);}
            
            
            $this->session->set_flashdata('message','Password has been sent to your ' . $domain['social_status'] == 'sms' ? 'mobile no' : 'emails' . ' successfully.');
            // $this->session->set_flashdata('message','Password has been sent to your eamil successfully.');
           
             redirect($_SERVER['HTTP_REFERER']);
            
        }
        else {
            $this->session->set_flashdata('message','Email is not registred with Us. Please contact to Support team.');
           
             redirect($_SERVER['HTTP_REFERER']);
        }
       
   }
   
   
   	function send_sms($mobileNumber,$message){
        
        $senderId = 'ECPTlD';
        $routeId = '1';
        $authKey = 'b794dd4728d670a';
        // $authKey = 'ee8bd44d9b272c2d1bdd342585d71f4';
        // $serverUrl = "http://msg.icloudsms.com/rest/services/sendSMS/sendGroupSms?AUTH_KEY=".$authKey;
        $serverUrl = "http://cdfmsg.cdfhosting.in/rest/services/sendSMS/sendGroupSms?AUTH_KEY=".$authKey."&message=".$message."&senderId=".$senderId."&routeId=1&mobileNos=".$mobileNumber."&smsContentType=english";
        
      //Prepare you post parameters
      $postData = array(
          'mobileNumbers' => $mobileNumber,
          'smsContent' => $message,
          'senderId' => $senderId,
          'routeId' => $routeId,
          "smsContentType" =>'English'
      );
    
    
    $data_json = json_encode($postData);
      // init the resource
      $ch = curl_init();
    
      curl_setopt_array($ch, array(
          CURLOPT_URL => $serverUrl,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_HTTPHEADER => array(
            'Cookie: JSESSIONID=C02316B7203690DEEA81FD48A5587B19.node3'
          ),
        ));
    
      //get response
      $output = curl_exec($ch);
    
      //Print error if any
      if(curl_errno($ch))
      {
          echo 'error:' . curl_error($ch);
      }
      curl_close($ch);
      
    //   print_r($output);
    //   die();
      $response = json_decode($output);
      if(isset($response->responseCode) && $response->responseCode=='3001'){
          return true;
      }else{
          return false;
      }
    }
   
   function randomPassword() {
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }
   
  // public function logout()  
  //   {  
  //     $this->session->sess_destroy();  
  //     redirect('https://instantloansdeals.com/', 'refresh');
  //   }
  public function logout()  
    {  
      $this->session->sess_destroy();  
      $base_url = str_replace('/beta/', '/', base_url());

      redirect($base_url, 'refresh'); 
    }

    
   public function send_mail($email, $subject, $message)
{
    $ci =& get_instance();
    $ci->load->database();
    $ci->load->library('email');

    // Get domain id
    $domain_id = domain_id_get();

    if (!$domain_id) {
        log_message('error', 'Domain not found in domains table');
        return false;
    }

    // Fetch email config for that domain
    $config_row = $ci->db
        ->where('domain_id', $domain_id)
        ->get('email_config')
        ->row_array();

    if (!$config_row) {
        log_message('error', 'Email configuration not found for domain_id: ' . $domain_id);
        return false;
    }

    // ✅ Prepare config for Mailtrap
    $config = array(
        'protocol'  => 'smtp',
        'smtp_host' => $config_row['smtp_host'], // live.smtp.mailtrap.io
        'smtp_port' => $config_row['smtp_port'], // 587
        'smtp_user' => $config_row['smtp_user'], // api
        'smtp_pass' => $config_row['smtp_pass'], // your API token
        'mailtype'  => 'html',
        'charset'   => 'utf-8',
        'wordwrap'  => TRUE,
        'newline'   => "\r\n",       // important for Mailtrap
        'crlf'      => "\r\n",       // important for Mailtrap
        'smtp_timeout' => 30,
        'smtp_crypto'  => 'tls',     // important for Mailtrap
    );

    $ci->email->initialize($config);

    $ci->email->from($config_row['from_email'], $config_row['from_name']);
    $ci->email->to(trim($email));
    $ci->email->subject($subject);
    $ci->email->message($message);

    if ($ci->email->send()) {
        log_message('info', 'Email successfully sent to: ' . $email);
        return true;
    } else {
        // 🔎 Debug log if something fails
        $error = $ci->email->print_debugger(['headers']);
        log_message('error', 'Email failed to send. Error: ' . $error);
        return false;
    }
}
}
?>