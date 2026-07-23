<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'libraries/razorpay/Razorpay.php';
include APPPATH . 'third_party/vendor/autoload.php';

ob_start();


class Page extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper(['form', 'url', 'text']);
        $this->load->model('Page_Model');
        $this->load->model('Branch_Model');
        date_default_timezone_set('Asia/Kolkata');
    }
    
    /**
     * Display branch details page
     */
    public function branch($id = null) {
        if (empty($id)) {
            show_404();
        }
        
        $domain_id = domain_id_get();
        
        // Get branch details
        $branch = $this->Branch_Model->get_branch($id, $domain_id);
        
        if (empty($branch)) {
            show_404();
        }
        
        // Get nearby branches (excluding current branch)
        $this->db->where('id !=', $id);
        $this->db->where('status', 1);
        $this->db->where('domain_id', $domain_id);
        $this->db->order_by('branch_name', 'ASC');
        $this->db->limit(3);
        $nearby_branches = $this->db->get('branch_locations')->result_array();
        
        // Prepare data for view
        $data['branch'] = $branch;
        $data['nearby_branches'] = $nearby_branches;
        $data['title'] = $branch['branch_name'] . ' - Branch Details';
        $data['description'] = character_limiter(strip_tags($branch['short_description']), 160);
        $data['keywords'] = $branch['branch_name'] . ', branch, location, contact';
        
        // Load views
        $this->load->view('Page/template/header', $data);
        $this->load->view('Page/branch_detail', $data);
        $this->load->view('Page/template/footer');
    }
    
    /**
     * Handle contact form submission for a branch
     */
    public function contact_branch($branch_id) {
        $this->load->library('email');
        $this->load->helper('email');
        
        // Validate form
        $this->form_validation->set_rules('name', 'Name', 'required|trim|max_length[100]');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|max_length[100]');
        $this->form_validation->set_rules('subject', 'Subject', 'required|trim|max_length[200]');
        $this->form_validation->set_rules('message', 'Message', 'required|trim');
        $this->form_validation->set_rules('privacy_policy', 'Privacy Policy', 'required', ['required' => 'You must accept the privacy policy']);
        
        if ($this->form_validation->run() === FALSE) {
            // Form validation failed, redirect back with errors
            $this->session->set_flashdata('error', validation_errors('<div class="alert alert-danger">', '</div>'));
            redirect('page/branch/' . $branch_id . '#contact', 'refresh');
            return;
        }
        
        // Get branch details
        $branch = $this->Branch_Model->get_branch($branch_id, domain_id_get());
        
        if (empty($branch)) {
            show_404();
        }
        
        // Prepare email data
        $to = !empty($branch['email']) ? $branch['email'] : $this->config->item('admin_email');
        $subject = 'New Contact Form Submission: ' . $this->input->post('subject', TRUE);
        $message = $this->load->view('emails/branch_contact', [
            'name' => $this->input->post('name', TRUE),
            'email' => $this->input->post('email', TRUE),
            'message' => $this->input->post('message', TRUE),
            'branch' => $branch
        ], TRUE);
        
        // Send email
        $this->email->clear();
        $this->email->from($this->input->post('email', TRUE), $this->input->post('name', TRUE));
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);
        
        if ($this->email->send()) {
            $this->session->set_flashdata('success', '<div class="alert alert-success">Thank you for contacting us. We will get back to you soon!</div>');
        } else {
            log_message('error', 'Email sending failed: ' . $this->email->print_debugger());
            $this->session->set_flashdata('error', '<div class="alert alert-danger">Sorry, there was an error sending your message. Please try again later.</div>');
        }
        
        redirect('page/branch/' . $branch_id . '#contact', 'refresh');
    }
    
    /**
     * Display all active branches
     */
    public function branches() {
        $domain_id = domain_id_get();
        $data['branches'] = $this->Branch_Model->get_active_branches($domain_id);
        $data['title'] = 'Our Branches';
        $data['description'] = 'Find our branches across different locations';
        $data['keywords'] = 'branches, locations, contact us';
        
        $this->load->view('Page/template/header', $data);
        $this->load->view('Page/branches', $data);
        $this->load->view('Page/template/footer');
    }

    public function dummy()
    {

        $data['title'] = 'Home';
        $data['keywords'] = 'home,page,test';
        $data['description'] = 'this is home page';
        $data['datas'] = $this->db->where('domain_id',domain_id_get())->where('status', 1)->get('video')->result_array();
        $this->load->view('Page/template/headers', $data);
        $this->load->view('Page/dummy', $data);
        $this->load->view('Page/template/footer', $data);
    }

    public function index()
    {
        $data['title'] = 'Home';
        $data['keywords'] = 'home,page,test';
        $data['description'] = 'this is home page';
        $domain_id = domain_id_get();
        
        // Load the Branch_Model
        $this->load->model('Branch_Model');
        
        // Get branches for homepage (limit to 3)
        $data['branch_data'] = $this->Branch_Model->get_branches_for_homepage($domain_id);
        
        $data['sliders'] = $this->db->where('status', 1)->where('domain_id',$domain_id)->where('type','slider')->get('slider')->result_array();
        $data['edges'] = $this->db->where('status', 1)->where('domain_id',$domain_id)->where('type','edge')->get('slider')->result_array();
        $data['partner_sliders'] = $this->db->where('status', 1)->where('domain_id',$domain_id)->where('type','partner_slider')->get('slider')->result_array();
        $data['categories'] = $this->db->where('status', 1)->where('domain_id',$domain_id)->where('type','categories')->get('slider')->result_array();
        $data['about_customer'] = $this->db->where('status', 1)->where('domain_id',$domain_id)->where('type','about_customer')->get('slider')->result_array();
        
        $data['datas'] = $this->db->where('domain_id',$domain_id)->where('status', 1)->get('video')->result_array();
        $data['edge_heading'] = $this->db->where('domain_id',$domain_id)->where('type','edge')->get('settings')->row_array();
        $data['partner_heading'] = $this->db->where('domain_id',$domain_id)->where('type','partner_slider')->get('settings')->row_array();
        $data['video_heading'] = $this->db->where('domain_id',$domain_id)->where('type','video')->get('settings')->row_array();
        $data['branches'] = $this->db->where('domain_id',$domain_id)->where('type','branch-location')->get('settings')->row_array();
        $data['categories_heading'] = $this->db->where('domain_id',$domain_id)->where('type','categories')->get('settings')->row_array();

        $this->load->view('Page/template/header', $data);
        $this->load->view('Page/index', $data);
        $this->load->view('Page/template/footer', $data);
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

    // Function to generate OTP
    public function generateNumericOTP($n)
    {
        $generator = "1357902468";
        $result = "";
        for ($i = 1; $i <= $n; $i++) {
            $result .= substr($generator, (rand() % (strlen($generator))), 1);
        }
        return $result;
    }

    public function setfinaluserdata($txtId)
    {
        $transaction_data = $this->Page_Model->get_transaction_data($txtId, 'tbl_transection');
        if (isset($transaction_data->uid)) {
            $uid = $transaction_data->uid;
            $role = $transaction_data->role;
            $json_data = json_decode($transaction_data->pass_json);
            if ($role == 'user') {
                $dbName = 'registerUser';
            } else if ($role == 'branch') {
                $dbName = 'branch_franchise';
            } else {
                $dbName = 'user_master';
            }

            $unpaid_user_data = $this->Page_Model->get_unpaid_user_data($uid, $dbName);

            $Updatedata['email'] = explode('--', $unpaid_user_data->email)[1];
            $Updatedata['status'] = 1;
            $this->Page_Model->update_data($uid, $Updatedata, $dbName);
            $domain = $this->db->where('id', domain_id_get())->get('domains')->row_array();

            if($domain['social_status'] == 'sms') { $this->send_sms($json_data->mobile, $json_data->message);}else{$this->send_mail($unpaid_user_data->email, 'Payment', $json_data->message);}
           ;
        }

    }

    public function success()
    {
        
        $uid = $this->session->userdata('uid');
        $data['user'] = $this->db->where('id', $uid)->get('registerUser')->row_array();

        $this->load->view('Page/template/header');
        $this->load->view('Page/success', 'refresh');
        $this->load->view('Page/template/footer');

    }

        
    public function cards()
    {
        $uid = $this->session->userdata('user_id');
        $domain_id = domain_id_get();

        if (empty($uid)) {
            $uid = $this->session->userdata('uid');
        }

        if (!empty($uid)) {
            $role = $this->session->userdata('role');

            if ($role == 3) {
                $data['user'] = $this->db->where('id', $uid)->get('branch_franchise')->row_array();
                $table = 'branch_franchise';
            } elseif ($role == 2 || $role == 1) {
                $data['user'] = $this->db->where('id', $uid)->get('user_master')->row_array();
                $table = 'user_master';
            } else {
                $data['user'] = $this->db->where('id', $uid)->get('registerUser')->row_array();
                $table = 'registerUser';
            }

            if (!empty($data['user']) && empty($data['user']['card_no'])) {
                
                $digit = substr($uid . rand(1000000000000000, 9999999999999999), 0, 16);
                $arr = str_split($digit, 4);
                $cardNo = implode(' ', $arr);

                $this->db->where('id', $uid)->update($table, ['card_no' => $cardNo]);

                $data['user']['card_no'] = $cardNo;
            }

            $data['tbl_transection'] = $this->db->where('uid', $uid)->get('tbl_transection')->row_array();

            $data['card_no'] = $data['user']['card_no'] ?? '';

            $data['cardColor'] = $this->db->where('domain_id',$domain_id)->get('card_color')->row_array();

            $this->load->view('Page/template/header');
            $this->load->view('Page/cards', $data);
            $this->load->view('Page/template/footer');
        } else {
            redirect('/', 'refresh');
        }
    }
    

    public function loan_details()
    {
        $this->db->select('user_bank_loan_detail.*, tbl_banks.bank_name');
        $this->db->from('user_bank_loan_detail');
        $this->db->join('tbl_banks', 'tbl_banks.id = user_bank_loan_detail.bank_id', 'left');
        $this->db->where('user_bank_loan_detail.user_id', $this->session->userdata('user_id'));

        $query = $this->db->get();
    
        $data['loans'] = $query->row_array();
    
        $this->load->view('Page/template/header');
        $this->load->view('Page/loan_details', $data);
        $this->load->view('Page/template/footer');
    }

    public function failed()
    {
        // $this->session->sess_destroy();
        $this->load->view('Page/template/header');
        $this->load->view('Page/failed');
        $this->load->view('Page/template/footer');
    }

    public function profile()
    {
        $uid = $this->session->userdata('user_id');
        if (empty($uid)) {
            $uid = $this->session->userdata('uid');
        }

        $role = $this->session->userdata('role');
        if ($role == 3) {
            $data['profile'] = $this->db->where('id', $uid)->get('branch_franchise')->row();
        } else {
            $data['profile'] = $this->db->where('id', $uid)->get('user_master')->row();
        }

          $data['uid'] = $uid;
          $data['role'] = $role;
        // echo '<pre>'; print_r($data['role']);die;

        $data['title'] = 'Profile';
        $data['keywords'] = 'home,page,test';
        $data['description'] = 'this is profile page';
        $this->load->view('Page/template/header', $data);
        $this->load->view('Page/profile', $data);
        $this->load->view('Page/template/footer', $data);
    }

    public function saveChangePassword()
    {
        // Retrieve form data
        $uid = $this->input->post('uid');
        $password = $this->input->post('password');
        
        $role = $this->input->post('role');
        

        
        
        if (empty($uid) || empty($password)) {
            $this->session->set_flashdata('error', 'User ID and Password are required.');
            return redirect('profile');
        }
        
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        
        $data = [
            'password' => $hashedPassword,
            'pass_text' => $password,
            'change_password_status'=> 0,
        ];
        
        $this->load->model('Page_Model');
        $result = $this->Page_Model->changeBranchPassword($uid, $data, $role);

        if ($result) {
            $this->session->set_flashdata('success', 'Password updated successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to update password. Please try again.');
        }
        
        return redirect('profile');
    }   
    
    
    public function agentPayment()
{

    $plan = $this->input->post('plan');

    if ($plan == 'platinum_free' || $plan == 'silver_free') {
        $Updatedata['subscription'] = $plan;
        $up = $this->Page_Model->update_data($this->session->userdata('uid'), $Updatedata, 'user_master');
        $this->session->sess_destroy();
        redirect('Page/success');
    }

    $arr = $this->Page_Model->get_payment_data($plan, 5);
    
    $array = $this->db->where('domain_id',domain_id_get())->where('plan_type',2)->get('plan_tbl')->row_array();
    if (empty($array)) {
        $array['amount'] = 0;
        $array['amount2'] = 0;
    }
    
    // $array = json_decode(json_encode($arr), true);
    $amt = ($plan == "Silver") ? $array['amount'] : $array['amount2'];
    
    // echo '<pre>';    print_r($this->db->last_query());
    //     print_r($arr );die;
    $data = [
        'amt' => $amt,
        'uid' => $this->session->userdata('uid'),
        'user_type' => $this->session->userdata('user_type'),
        'email' => $this->session->userdata('email'),
        'mobile' => $this->session->userdata('mobile_no'),
    ];

    $this->load->view('Page/paymentpage', $data);
}


    public function agentPaymentold()
    {
        $plan = $this->input->post('plan');

        if (!$this->session->has_userdata('uid')) {
            $this->session->sess_destroy();
            redirect('/', 'refresh');
        }

        $arr = $this->Page_Model->get_payment_data($plan, 5);
        $array = $this->db->where('domain_id',domain_id_get())->where('plan_type',2)->get('plan_tbl')->row_array();
    if (empty($array)) {
        $array['amount'] = 0;
        $array['amount2'] = 0;
    }
        // $array = json_decode(json_encode($arr), true);
        if ($plan == "Silver") {
            $amt = $array['amount'];
        } else {
            $amt = $array['amount2'];
        }
        

        // $amt = 1;

        $uid = $this->session->userdata('uid');
        $role = $this->session->userdata('user_type');
        $email = $this->session->userdata('email');
        $mobile = $this->session->userdata('mobile_no');

        $prefix = $this->generateNumericOTP(6);
         $Updatedata = [
            'subscription' => $plan,
            'plan_id' => $array['id'],
            'plan_amount' =>  $amt,
        ];
        $up = $this->Page_Model->update_data($uid, $Updatedata, 'user_master');

        // $txtId = substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 14);
        $txtId = time() + rand(1000, 999999);
        
        $data['amt'] = $amt;
        
        $this->load->view('Page/    ', $data);


    }
    
    


public function submitpayment()
{
    // Check if an image file is uploaded
    if (isset($_FILES["image"]) && $_FILES["image"]["size"] > 0) {
        $tmpFilePath = $_FILES['image']['tmp_name'];
        $image_file_type = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);

        // Set the new file path
        $newFilePath = 'beta/upload/assets/transactions/' . time() . '.' . $image_file_type;

        // Move the uploaded file to the new location
        if (move_uploaded_file($tmpFilePath, $newFilePath)) {
            $imagePath = $newFilePath; // Store the new file path
        } else {
            // Handle file upload failure
            $this->session->set_flashdata('error', 'Failed to upload image. Please try again.');
            redirect('Page/failed');
            return;
        }
    } else {
        $imagePath = null; // No image uploaded
    }

    // Prepare data for insertion
    $paymentData = [
        'amount' => $this->input->post('amount'),
        'payment_id' => $this->input->post('payment_id'),
        'image' => $imagePath, // Save the uploaded file path or null
        'uid' => $this->input->post('uid'),
        'role' => $this->input->post('user_type'),
        'status' => 1, // Default status value
        'entity' => 'payment',
        'domain_id' => domain_id_get(),
        'currency' => 'INR',
        'method' => 'manual',
        'payment_date' => date('Y-m-d'),
        'created_on' => date('Y-m-d H:i:s')
    ];

    // if($this->input->post('amount') != 0){
    // Insert transaction data into database using the model
    $insert_id = $this->Page_Model->insert_transaction($paymentData);
    // }

    if (isset($insert_id)) {
        $updateData = ['step' => 6,
        'step_url'=>base_url("/Page/success"),

    ];
    
       $this->Page_Model->update_data($this->input->post('uid') , $updateData, 'registerUser');
      
        // Redirect to success page if the transaction is inserted successfully
        $this->session->set_flashdata('success', 'Payment submitted successfully!');
        redirect('Page/success');
    } else {
        // Redirect to failure page if insertion fails
        $this->session->set_flashdata('error', 'Failed to submit payment. Please try again.');
        redirect('Page/failed');
    }
}



public function submitpaymentold()
{
    // // Set form validation rules
    // $this->form_validation->set_rules('amount', 'Payment Amount', 'required|numeric');
    // $this->form_validation->set_rules('payment_id', 'Transaction Number', 'required');
    // $this->form_validation->set_rules('image', 'Transaction Screenshot', 'callback_file_check');

    // if ($this->form_validation->run() == FALSE) {
    //     // If validation fails, redirect to payment page with error messages
    //     $this->session->set_flashdata('form_data', $this->input->post());
    //     $this->session->set_flashdata('validation_errors', validation_errors());
    //     redirect('Page/paymentpage');
    // } else {
    //     // Handle file upload configuration
    //     $config['upload_path'] = './uploads/';
    //     $config['allowed_types'] = 'jpg|png|jpeg|gif';
    //     $config['max_size'] = 2048; // 2MB limit
    //     $config['encrypt_name'] = TRUE; // Generate unique file names

    //     $this->load->library('upload', $config);

        // if (!$this->upload->do_upload('image')) {
        //     // If file upload fails, show error and redirect
        //     $this->session->set_flashdata('form_data', $this->input->post());
        //     $this->session->set_flashdata('upload_error', $this->upload->display_errors());
        //     redirect('Page/paymentpage');
        // } else {
            // If file upload is successful
            $file_data = $this->upload->data();
            
           

            // Prepare data for insertion
            $paymentData = [
                'amount' => $this->input->post('amount'),
                'payment_id' => $this->input->post('payment_id'), // Use correct field name
                'image' => $file_data['file_name'], // Save the uploaded file name
                'uid' => $this->session->userdata('user_id'), // Assuming you store user ID in session
                'status' => 1, // Default status value
                'uid' => $this->input->post('uid'), 
                'role' => $this->input->post('user_type'), 
                'entity' => 'payment',
                'currency' => 'INR',
                'method' => 'manual',
                'domain_id' => domain_id_get(),
                 'payment_date' => date('Y-m-d') ,


                'created_on' => date('Y-m-d H:i:s') // Add current timestamp
                
            ];

            // Insert transaction data into database using model
            $insert_id = $this->Page_Model->insert_transaction($paymentData);

            if ($insert_id) {
                // Redirect to success page if the transaction is inserted successfully
                $this->session->set_flashdata('success', 'Payment submitted successfully!');
                redirect('Page/success');
            } else {
                // Redirect to failure page if insertion fails
                $this->session->set_flashdata('error', 'Failed to submit payment. Please try again.');
                redirect('Page/failed');
            }
        
    
}

// Custom file validation callback
public function file_check($str)
{
    if (empty($_FILES['image']['name'])) {
        $this->form_validation->set_message('file_check', 'The Transaction Screenshot is required.');
        return FALSE;
    }
    return TRUE;
}

public function brancePayment()
{
    $plan = $this->input->post('plan');

    if ($plan == 'platinum_free' || $plan == 'silver_free') {
        $Updatedata['subscription'] = $plan;
        $up = $this->Page_Model->update_data($this->session->userdata('uid'), $Updatedata, 'branch_franchise');
        $this->session->sess_destroy();
        redirect('Page/success');
    }

    // Check user authentication
    if (!$this->session->has_userdata('uid')) {
        $this->session->sess_destroy();
        redirect('/', 'refresh');
    }

    // Fetch payment data
    $arr = $this->Page_Model->get_payment_data($plan, 6);
    $array = $this->db->where('domain_id',domain_id_get())->where('plan_type',3)->get('plan_tbl')->row_array();
    if (empty($array)) {
        $array['amount'] = 0;
        $array['amount2'] = 0;
    }
    // $array = json_decode(json_encode($arr), true);

    // Determine the amount based on the plan
    $amt = ($plan == "Silver") ? $array['amount'] : $array['amount2'];

    // Prepare session-related data
    $uid = $this->session->userdata('uid');
    $role = $this->session->userdata('user_type');
    $email = $this->session->userdata('email');
    $mobile = $this->session->userdata('mobile_no'); // Corrected key for mobile

    // Update subscription data
    $prefix = $this->generateNumericOTP(6);
 
      $Updatedata = [
            'subscription' => $plan,
            'plan_id' => $array['id'],
            'plan_amount' =>  $amt,
        ];
    $this->Page_Model->update_data($uid, $Updatedata, 'branch_franchise');

    // Prepare data for the view
    $data = [
        'amt' => $amt,
        'uid' => $uid,
        'user_type' => $role,
        'email' => $email,
        'mobile' => $mobile,
    ];

    // Load the payment page
    $this->load->view('Page/paymentpage', $data);
}



    
    public function paymentResponse()
    {
        // PhonePe PG Start
        $txtId = $this->input->get('txtId');

        if (empty($txtId)) {
            redirect('/', 'refresh');
        }

        $merchantId = 'GUPTASASSOCIATEONLINE';
        $saltKey = 'f625be87-8df9-435e-a694-6696f5076732';
        $saltIndex = '1';

        $client = new \GuzzleHttp\Client();

        $hvalue = '/pg/v1/status/' . $merchantId . '/' . $txtId . $saltKey;
        $hasht = hash('sha256', $hvalue);

        $body = array();

        $url = 'https://api.phonepe.com/apis/hermes/pg/v1/status/' . $merchantId . '/' . $txtId;
        $response = $client->request('GET', $url, [
            'body' => json_encode($body),
            'headers' => [
                'Content-Type' => 'application/json',
                'accept' => 'application/json',
                'X-VERIFY' => $hasht . '###' . $saltIndex,
                'X-MERCHANT-ID' => $merchantId,
            ],
        ]);

        $decodedResponse = json_decode($response->getBody(), true);

        $responseStatus = $decodedResponse['success'];

        if ($responseStatus) {
            $status = 1;
            $net_amount_debit = $decodedResponse['data']['amount'];
            $mihpayid = $decodedResponse['data']['transactionId'];
            $mode = $decodedResponse['data']['paymentInstrument']['type'];

            $updateData = [
                // 'amount'        => $net_amount_debit,//$_POST['net_amount_debit'],
                // 'payment_id'    => $mihpayid,//$_POST['mihpayid'],
                'entity' => 'payment',
                'currency' => 'INR',
                'method' => $mode, //$_POST['mode'],
                
        'domain_id' => domain_id_get(),

                'payment_date' => date("Y-m-d"),
                'status' => $status,

            ];

            $paidStatus = $this->Page_Model->update_transaction($txtId, $updateData, 'tbl_transection');
            $this->setfinaluserdata($txtId);

        } else {
            $status = 0;
        }

        $this->load->view('Page/template/header');
        if ($status) {
            redirect('success', 'refresh');

        } else {
            redirect('failed', 'refresh');
        }

        $this->load->view('Page/template/footer');
    }
    
    public function userPayment()
{
    $plan = $this->input->post('plan');
    $plan_amount = $this->input->post('plan_amount');
    $plan_amount1 = $this->input->post('plan_amount1');

    if ($plan == 'platinum_free' || $plan == 'silver_free') {
        $Updatedata['subscription'] = $plan;
        $up = $this->Page_Model->update_data($this->session->userdata('uid'), $Updatedata, 'registerUser');
        $this->session->sess_destroy();
        redirect('Page/success');
    }

    // Check user authentication
    if (!$this->session->has_userdata('uid')) {
        $this->session->sess_destroy();
        redirect('/', 'refresh');
    }

    // Fetch payment data
    $arr = $this->Page_Model->get_payment_data($plan, 1);
    $array = $this->db->where('domain_id',domain_id_get())->where('plan_type',1)->get('plan_tbl')->row_array();
    if (empty($array)) {
        $array['amount'] = 0;
        $array['amount2'] = 0;
    }
    // $array = json_decode(json_encode($arr), true);

    // Determine the amount based on the plan
    $amt = ($plan == "Silver") ? $array['amount'] : $array['amount2'];

    // Prepare session-related data
    $uid = $this->session->userdata('uid');
    $role = $this->session->userdata('user_type');
    $email = $this->session->userdata('email');
    $mobile = $this->session->userdata('mobile_no'); 


    $main_plan_amount = ($plan == "Silver") ? $plan_amount : $plan_amount1;
    $prefix = $this->generateNumericOTP(6);
    $Updatedata['subscription'] = $plan;
    $Updatedata['plan_amount'] = $main_plan_amount;
    $Updatedata['step_url'] = base_url("/userPayment/" . $uid);
    $Updatedata['step'] = 5;

    $this->Page_Model->update_data($uid, $Updatedata, 'registerUser');

    // Prepare data for the view
    $data = [
        'amt' => $amt,
        'uid' => $uid,
        'user_type' => $role,
        'email' => $email,
        'mobile' => $mobile,
    ];

    // Load the payment page
    $this->load->view('Page/paymentpage', $data);
}

public function userPaymentAgen($id)
{
    $user = $this->db->where('id',$id)->get('registerUser')->row_array();
    $user['uid'] = $user['id'];

    $this->session->set_userdata($user);


   

    // Determine the amount based on the plan
   

    // Prepare session-related data
    $uid = $id;
    $role = $this->session->userdata('user_type');
    $email = $this->session->userdata('email');
    $mobile = $this->session->userdata('mobile_no'); // Corrected key for mobile





    // Prepare data for the view
    $data = [
        'amt' => $user['plan_amount'],
        'uid' => $uid,
        'user_type' => $role,
        'email' => $email,
        'mobile' => $mobile,
    ];


    // Load the payment page
    $this->load->view('Page/paymentpage', $data);
}


    

    public function sendMail()
    {
        $email_config = $this->db->where('domain_id', domain_id_get())->get('email_config')->row_array();
        $admin_name = $this->db->where('domain_id', domain_id_get())->get('contect_us')->row_array();

        $fullname = $this->input->post('fullname');
        $email = $this->input->post('email');
        $mobile = $this->input->post('mobile');
        $subject = $this->input->post('subject');
        $message = $this->input->post('message');

        $to = "vivekpcst.kumar@gmail.com";

        $message .= "\n Name : " . $fullname;
        $message .= "\n Email : " . $email;
        $message .= "\n Mobile : " . $mobile;

        $header = "From:". (!empty($email_config['from_email']) ? $email_config['from_email'] : '') . " \r\n";
        $header .= "MIME-Version: 1.0\r\n";
        $header .= "Content-type: text/html\r\n";
        //*********** sending to admin *****************//
        $adminStatus = mail($to, $subject, $message, $header);

        //*********** sending to Customer *****************//

        $tot = $email;
        $message1 = "Hi  " . $fullname;
        $message1 .= ",\n We have recieved your mail. Our Agent will contact you soon.";

        // $customerStatus = mail ($tot,$subject,$message1,$header);
        $this->send_mail($email, $subject, $message1);

        $this->session->set_flashdata('message', 'Message has been sent successfully.');
        redirect('contact', 'refresh');

    }

    public function forgetPassword()
    {

        $email_config = $this->db->where('domain_id', domain_id_get())->get('email_config')->row_array();
        $admin_name = $this->db->where('domain_id', domain_id_get())->get('contect_us')->row_array();
        $domain = $this->db->where('id', domain_id_get())->get('domains')->row_array();
        $email = $this->input->post('email');
        $emailStatus = $this->Page_Model->check_email($email, 'registerUser');
        if ($emailStatus) {
            $pass = $this->randomPassword();

            // update paswword
            $Updatedata['password'] = md5($pass);
            $up = $this->Page_Model->update_password($email, $Updatedata, 'registerUser');
            $userdata = $this->Page_Model->get_data_with_email($email, 'registerUser');

            $mobile = $userdata->mobile;

            $to = $email;
            $subject = "Forget Password";

            $message = "Your have generated a new password for " . (!empty($admin_name['company_title']) ? $admin_name['company_title'] : '') . ". Your New Password is:<strong>" . $pass . "</strong>";
            $message .= "\nDo not share with anyone.";

            $header = "From:". (!empty($email_config['from_email']) ? $email_config['from_email'] : '') . " \r\n";
            $header .= "MIME-Version: 1.0\r\n";
            $header .= "Content-type: text/html\r\n";
            $sms_message = "Dear%20Customer,%20Welcome%20to%20Instant%20Loans%20Deals%20Your%20Password%20is%20" . $Updatedata['password'] . "%20More%20details:%20https://www.instantloansdeals.com%20EXELORA%20CONSULTANCY";

            if($domain['social_status'] == 'sms') {$this->send_sms($mobile, $sms_message);}else{$this->send_mail($to, $subject, $message);}
            

            $this->session->set_flashdata('message', 'Password has been sent to your ' . $domain['social_status'] == 'sms' ? 'mobile no' : 'email' . ' successfully.');
            // $this->session->set_flashdata('message','Password has been sent to your eamil successfully.');
            redirect('customer', 'refresh');

        } else {
            $this->session->set_flashdata('message', 'Email is not registred with Us. Please contact to Support team.');
            redirect('customer', 'refresh');
        }

    }

    public function sendotp()
    {

        $email_config = $this->db->where('domain_id', domain_id_get())->get('email_config')->row_array();
        $admin_name = $this->db->where('domain_id', domain_id_get())->get('contect_us')->row_array();
        $domain = $this->db->where('id', domain_id_get())->get('domains')->row_array();
        // print_r($domain );die;

        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('mobile', 'Mobile', 'required|trim');
        $this->form_validation->set_rules('user_type', 'User Type', 'required|trim');

        $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');

        if ($this->form_validation->run() == false) {
            $this->load->view('customer');

        } else {
            $email = $this->security->xss_clean($this->input->post('email'));
            $name = $this->security->xss_clean($this->input->post('name'));
            $mobile = $this->security->xss_clean($this->input->post('mobile'));
            $role = $this->security->xss_clean($this->input->post('user_type'));

            if ($this->emailValidation($email, $role)) {
                
                // echo $role;

                $n = 4;
                $newOtp = $this->generateNumericOTP($n);
                $to = $email;
                $subject = "Registration OTP";
               $message = "Please verify your mobile no in " . (!empty($admin_name['company_title']) ? $admin_name['company_title'] : '') . ". Your otp is:<strong>" . $newOtp . "</strong>";
                $message .= "\nDo not share with anyone. This OTP will expire after 10 minutes.";
                $header = "From:". (!empty($email_config['from_email']) ? $email_config['from_email'] : '') . "\r\n";
                $header .= "MIME-Version: 1.0\r\n";
                $header .= "Content-type: text/html\r\n";
                //$retval = mail ($to,$subject,$message,$header);

                $sms_message = "Your%20OTP%20is%20" . $newOtp . "%20for%20Instant%20Loans%20Deals.%20Do%20not%20share%20to%20Others.%20More%20details:%20https://www.instantloansdeals.com%20EXELORA%20CONSULTANCY";
                // $this->send_mail($email,$subject,$message );
                
                if ($domain['social_status'] == 'sms')  {
                    $this->send_sms($mobile, $sms_message);
                    if(!$this->send_sms($mobile,$sms_message)){
                        if($role == "user") {
                            $this->session->set_flashdata('message','Oh!, Please enter correct Mobile no.');
                                redirect('personalLoan');
                        }
                        else {
                            $this->session->set_flashdata('message','Oh!, Please enter correct Mobile no.');
                                redirect('agent');
                        }
                    }
                }else{
                    $this->send_mail($to, $subject, $message);
                }
                

                $data['title'] = 'otp';
                $data['keywords'] = 'otp,page,test';
                $data['description'] = 'this is otp page';
                $data['otp'] = $newOtp;
                $data['email'] = $email;
                $data['mobile'] = $mobile;
                $data['name'] = $name;
                $data['user_type'] = $role;
                $data['persone_type'] = $this->input->post('persone_type');
                $data['otp_channel'] = ($domain['social_status'] == 'sms') ? 'sms' : 'email';
            $data['dsaagentdetail'] = $this->db->where('domain_id',domain_id_get())->get('dsaagentdetail')->row_array();

                $this->load->view('Page/template/header', $data);
                $this->load->view('Page/otp_page', $data);
                $this->load->view('Page/template/footer', $data);
            } else {

                if ($role == "user") {
                    $this->session->set_flashdata('message', 'Oh!, Email is already exist! Please try another Email.');
                    redirect('personalLoan');
                } else {
                    $this->session->set_flashdata('message', 'Oh!, Email is already exist! Please try another Email.');
                    redirect('agent');
                }

            }

        }
    }

    public function sendotp_customer()
    {

        $email_config = $this->db->where('domain_id', domain_id_get())->get('email_config')->row_array();
        $admin_name = $this->db->where('domain_id', domain_id_get())->get('contect_us')->row_array();
        $domain = $this->db->where('id', domain_id_get())->get('domains')->row_array();
        // print_r($domain );die;

        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('mobile', 'Mobile', 'required|trim');
        $this->form_validation->set_rules('user_type', 'User Type', 'required|trim');

        $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');

        if ($this->form_validation->run() == false) {
            $this->load->view('customer');

        } else {
            $email = $this->security->xss_clean($this->input->post('email'));
            $name = $this->security->xss_clean($this->input->post('name'));
            $mobile = $this->security->xss_clean($this->input->post('mobile'));
            $role = $this->security->xss_clean($this->input->post('user_type'));

            if ($this->emailValidation($email, $role)) {
                
                // echo $role;

                $n = 4;
                $newOtp = $this->generateNumericOTP($n);
                $to = $email;
                $subject = "Registration OTP";
               $message = "Please verify your mobile no in " . (!empty($admin_name['company_title']) ? $admin_name['company_title'] : '') . ". Your otp is:<strong>" . $newOtp . "</strong>";
                $message .= "\nDo not share with anyone. This OTP will expire after 10 minutes.";
                $header = "From:". (!empty($email_config['from_email']) ? $email_config['from_email'] : '') . "\r\n";
                $header .= "MIME-Version: 1.0\r\n";
                $header .= "Content-type: text/html\r\n";
                //$retval = mail ($to,$subject,$message,$header);

                $sms_message = "Your%20OTP%20is%20" . $newOtp . "%20for%20Instant%20Loans%20Deals.%20Do%20not%20share%20to%20Others.%20More%20details:%20https://www.instantloansdeals.com%20EXELORA%20CONSULTANCY";
                // $this->send_mail($email,$subject,$message );
                
                if ($domain['social_status'] == 'sms')  {
                    $this->send_sms($mobile, $sms_message);
                    if(!$this->send_sms($mobile,$sms_message)){
                        if($role == "user") {
                            $this->session->set_flashdata('message','Oh!, Please enter correct Mobile no.');
                                redirect('personalLoan');
                        }
                        else {
                            $this->session->set_flashdata('message','Oh!, Please enter correct Mobile no.');
                                redirect('agent');
                        }
                    }
                }else{
                    $this->send_mail($to, $subject, $message);
                }
                

                $data['title'] = 'otp';
                $data['keywords'] = 'otp,page,test';
                $data['description'] = 'this is otp page';
                $data['otp'] = $newOtp;
                $data['email'] = $email;
                $data['mobile'] = $mobile;
                $data['name'] = $name;
                $data['user_type'] = $role;
                $data['persone_type'] = $this->input->post('persone_type');
            $data['dsaagentdetail'] = $this->db->where('domain_id',domain_id_get())->get('dsaagentdetail')->row_array();

            $domain_id = domain_id_get();
            $data['buynowBanner'] = $this->db->where('domain_id',domain_id_get())->get('buynow_banner')->row_array();
            $data['buynowSection'] = $this->db->where('domain_id',domain_id_get())->get('buynow_section')->row_array();
            $data['buynow_section_2'] = $this->db->where('domain_id',domain_id_get())->get('buynow_section_2')->row_array();
            $data['buynow_section_1'] = $this->db->where('domain_id',domain_id_get())->get('buynow_section_1')->row_array();
            $data['smartChoice'] = $this->db->where('domain_id',domain_id_get())->get('banner_slider')->result_array();
            $data['contect_us'] = $this->db->where('domain_id',domain_id_get())->get('contect_us')->row_array();
            $data['otp_channel'] = ($domain['social_status'] == 'sms') ? 'sms' : 'email';

                $this->load->view('Page/template/header', $data);
                $this->load->view('Page/otp_pageCustomer', $data);
                $this->load->view('Page/template/footer', $data);
            } else {

                if ($role == "user") {
                    $this->session->set_flashdata('message', 'Oh!, Email is already exist! Please try another Email.');
                    redirect('personalLoan');
                } else {
                    $this->session->set_flashdata('message', 'Oh!, Email is already exist! Please try another Email.');
                    redirect('agent');
                }

            }

        }
    }

    public function sendotp_franchise()
    {
        // $arr = ["key" => "value"];
        
        $email_config = $this->db->where('domain_id', domain_id_get())->get('email_config')->row_array();
        $admin_name = $this->db->where('domain_id', domain_id_get())->get('contect_us')->row_array();
        $domain = $this->db->where('id', domain_id_get())->get('domains')->row_array();
        
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('mobile', 'Mobile', 'required|trim');
        $this->form_validation->set_rules('user_type', 'User Type', 'required|trim');
        
        $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');
        
        if ($this->form_validation->run() == false) {
            $this->load->view('branch-franchise');
            
        } else {
            $email = $this->security->xss_clean($this->input->post('email'));
            $name = $this->security->xss_clean($this->input->post('name'));
            $mobile = $this->security->xss_clean($this->input->post('mobile'));
            $role = $this->security->xss_clean($this->input->post('user_type'));

            if ($this->emailValidation($email, $role)) {
                // echo '<pre>';print_r($email); die;
                
                $n = 4;
                $newOtp = $this->generateNumericOTP($n);
                $to = $email;
                $subject = "Registration OTP";
                $message = "Please verify your mobile no in " . (!empty($admin_name['company_title']) ? $admin_name['company_title'] : '') . ". Your otp is:<strong>" . $newOtp . "</strong>";
                $message .= "\nDo not share with anyone. This OTP will expire after 10 minutes.";
                $header = "From:". (!empty($email_config['from_email']) ? $email_config['from_email'] : '') . " \r\n";
                $header .= "MIME-Version: 1.0\r\n";
                $header .= "Content-type: text/html\r\n";

                $sms_message = "Your%20OTP%20is%20" . $newOtp . "%20for%20Instant%20Loans%20Deals.%20Do%20not%20share%20to%20Others.%20More%20details:%20https://www.instantloansdeals.com%20EXELORA%20CONSULTANCY";
                if($domain['social_status'] == 'sms') {$this->send_sms($mobile, $sms_message);}else{$this->send_mail($to, $subject, $message);}
                   

                $data['title'] = 'otp';
                $data['keywords'] = 'otp,page,test';
                $data['description'] = 'this is otp page';
                $data['otp'] = $newOtp;
                $data['email'] = $email;
                $data['mobile'] = $mobile;
                $data['name'] = $name;
                $data['user_type'] = $role;
                $data['otp_channel'] = ($domain['social_status'] == 'sms') ? 'sms' : 'email';

        $data['branchAgentDetail'] = $this->db->where('domain_id',domain_id_get())->get('branchAgentDetail')->row_array();
                $this->load->view('Page/template/header', $data);
                $this->load->view('Page/otp_pagebranch', $data);
                $this->load->view('Page/template/footer', $data);
            } else {

                if ($role == "user") {
                    $this->session->set_flashdata('message', 'Oh!, Email is already exist! Please try another Email.');
                    redirect('branch-franchise');
                } else {
                    $this->session->set_flashdata('message', 'Oh!, Email is already exist! Please try another Email.');
                    redirect('branch-franchise');
                }

            }

        }
    }

    public function emailValidation($emailData, $type)
    {
        $current_domain = parse_url(base_url(), PHP_URL_HOST);
        $current_domain = preg_replace('/^www\./', '', $current_domain);
        $domain_row = $this->Page_Model->get_domain_by_url($current_domain);
        $checkStatus = $this->Page_Model->check_emailId($emailData, $type,'');
        if ($checkStatus) {
            return false;
        } else {
            return true;
        }

    }

    public function send_sms($mobileNumber, $message)
    {

        $senderId = 'ECPTlD';
        $routeId = '1';
        $authKey = 'b794dd4728d670a';
        // $authKey = 'ee8bd44d9b272c2d1bdd342585d71f4';
        // $serverUrl = "http://msg.icloudsms.com/rest/services/sendSMS/sendGroupSms?AUTH_KEY=".$authKey;
        $serverUrl = "http://cdfmsg.cdfhosting.in/rest/services/sendSMS/sendGroupSms?AUTH_KEY=" . $authKey . "&message=" . $message . "&senderId=" . $senderId . "&routeId=1&mobileNos=" . $mobileNumber . "&smsContentType=english";

        //Prepare you post parameters
        $postData = array(
            'mobileNumbers' => $mobileNumber,
            'smsContent' => $message,
            'senderId' => $senderId,
            'routeId' => $routeId,
            "smsContentType" => 'English',
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
                'Cookie: JSESSIONID=C02316B7203690DEEA81FD48A5587B19.node3',
            ),
        ));

        //get response
        $output = curl_exec($ch);

        //Print error if any
        if (curl_errno($ch)) {
            echo 'error:' . curl_error($ch);
        }
        curl_close($ch);

        //   print_r($output);
        //   die();
        $response = json_decode($output);
        if (isset($response->responseCode) && $response->responseCode == '3001') {
            return true;
        } else {
            return false;
        }
    }
   public function sendSMSApproval($mobileNumber, $message)
{
    $serverUrl = "http://msg.icloudsms.com/rest/services/sendSMS/sendGroupSms?AUTH_KEY=b794dd4728d670a&message=" . urlencode($message)."&senderId=ECPTlD&routeId=1&mobileNos={$mobileNumber}&smsContentType=english";

    // CURL call
    $ch = curl_init();
    curl_setopt_array($ch, array(
        CURLOPT_URL => $serverUrl,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
    ));

    $output = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'CURL Error: ' . curl_error($ch);
        curl_close($ch);
        return false;
    }

    curl_close($ch);

    $response = json_decode($output);

    if (isset($response->responseCode) && $response->responseCode == '3001') {
        return true;
    } else {
        return false;
    }
}


    public function checkEmail()
    {
        $email = $this->input->post('email');
        $checkStatus = $this->Page_Model->check_email($email);
        if ($checkStatus) {
            echo json_encode("true");die;
        } else {
            echo json_encode("false");die;
        }

    }

    public function userRegistration()
    {
         $email_config = $this->db->where('domain_id', domain_id_get())->get('email_config')->row_array();
        $admin_name = $this->db->where('domain_id', domain_id_get())->get('contect_us')->row_array();


        $email = $this->input->post('email');
        $name = $this->input->post('name');
        $mobile = $this->input->post('mobile');
        $status = $this->input->post('status');
        $role = $this->input->post('user_type');
        $persone_type = $this->input->post('persone_type');

        $pass = $this->randomPassword();

        ////********* send email to customer / agent********************** //
        $to = $email;
        $subject = (!empty($admin_name['company_title']) ? $admin_name['company_title'] : '') . " User";
        $message = "You are successfully registrated to " . (!empty($admin_name['company_title']) ? $admin_name['company_title'] : '') . ". Your Password is:<strong>" . $pass . "</strong>";
        $message .= "\nDo not share with anyone. This Password is confidentially.";
        $header = "From:". (!empty($email_config['from_email']) ? $email_config['from_email'] : '') . " \r\n";
        $header .= "MIME-Version: 1.0\r\n";
        $header .= "Content-type: text/html\r\n";

        // $retval = mail ($to,$subject,$message,$header);
        // $this->send_mail($email, $subject, $message);  // Commented on 07/23/2023

        $email_data = array(
            'email' => $email,
            'subject' => $subject,
            'message' => $message,
        );

        $email_data = array(
            'mobile' => $mobile,
            'message' => "Dear%20Customer,%20Welcome%20to%20Instant%20Loans%20Deals%20Your%20Password%20is%20" . $pass . "%20More%20details:%20https://www.instantloansdeals.com%20EXELORA%20CONSULTANCY",
        );

        $current_domain = parse_url(base_url(), PHP_URL_HOST);
        $current_domain = preg_replace('/^www\./', '', $current_domain);
    
        $this->load->model('Page_Model');
        $domain_row = $this->Page_Model->get_domain_by_url($current_domain);
    
        ////********* send email to customer / agent********************** //

        if ($role == "user") {
            $insertData = ['username' => $name,
                'name' => $name,
                'email' => $email,
                'password' => MD5($pass),
                'mobile' => $mobile,
                'status' => $status,
                'pass_text' => $pass,
                'step'=>1,
                'domain_id'=>domain_id_get(),
                'date' => date('Y-m-d H:i:s')

            ];
                //   echo '<pre>';  print_r($insertData);die;

            $reg = $this->Page_Model->insert_data($insertData, 'registerUser');
            $insertData['user_type'] = 'user';
            $insertData['pass'] = $pass;

            $updateData = ['username' => $name,
            'step_url'=>base_url("/checkamount/$reg"),

        ];
           $this->Page_Model->update_data($reg , $updateData, 'registerUser');
         
        } else {
            $exist = $this->db->order_by('id', 'DESC')->get('user_master')->row_array();
            if (empty($exist)) {
                $code = 'DSA-0000';
            } else {
                $code = 'DSA-000' . $exist['id'];
            }
            $insertData = ['username' => $name,
                'name' => $name,
                'email' => $email,
                'password' => MD5($pass),
                'mobile_no' => $mobile,
                'role' => 2,
                'status' => $status,
                'code' => $code,
                'user_type' => 'dsa',
                'pass_text' => $pass,
                'domain_id'=>$domain_row->id,
                'date'=>date('Y-m-d H:i:s'),
                'created_on'=>date('Y-m-d H:i:s'),

            ];

            $reg = $this->Page_Model->insert_data($insertData, 'user_master');
            $insertData['user_type'] = 'agent';
            $insertData['pass'] = $pass;

        }

        $this->session->set_userdata('email_data', $email_data); // For email after payment.
        if ($reg) {

            $insertData['uid'] = $reg;
            $this->session->set_userdata($insertData);
            $data['status'] = 'true';
            echo json_encode($data);die;
        } else {
            $data['status'] = 'false';
            echo json_encode($data);die;
        }
    }

    public function branchRegistration()
    {
        $email_config = $this->db->where('domain_id', domain_id_get())->get('email_config')->row_array();
        $admin_name = $this->db->where('domain_id', domain_id_get())->get('contect_us')->row_array();
        $email = $this->input->post('email');
        $name = $this->input->post('name');
        $mobile = $this->input->post('mobile');
        $status = $this->input->post('status');
        $role = $this->input->post('user_type');

        $pass = $this->randomPassword();
        $to = $email;
        $subject = (!empty($admin_name['company_title']) ? $admin_name['company_title'] : '') . " User";
        $message = "You are successfully registrated to " . (!empty($admin_name['company_title']) ? $admin_name['company_title'] : '') . ". Your Password is:<strong>" . $pass . "</strong>";
        $message .= "\nDo not share with anyone. This Password is confidentially.";

        $header = "From:". (!empty($email_config['from_email']) ? $email_config['from_email'] : '') . " \r\n";
        $header .= "MIME-Version: 1.0\r\n";
        $header .= "Content-type: text/html\r\n";

        $email_data = array(
            'email' => $email,
            'subject' => $subject,
            'message' => $message,
        );

        $email_data = array(
            'mobile' => $mobile,
            'message' => "Dear%20Customer,%20Welcome%20to%20Instant%20Loans%20Deals%20Your%20Password%20is%20" . $pass . "%20More%20details:%20https://www.instantloansdeals.com%20EXELORA%20CONSULTANCY",
        );

        ////********* send email to customer / agent********************** //
        $current_domain = parse_url(base_url(), PHP_URL_HOST);
        $current_domain = preg_replace('/^www\./', '', $current_domain);
    
        $this->load->model('Page_Model');
        $domain_row = $this->Page_Model->get_domain_by_url($current_domain);
    
       
            $exist = $this->db->order_by('id', 'DESC')->get('branch_franchise')->row_array();
            if (empty($exist)) {
                $code = 'BF-0000';
            } else {
                $code = 'BF-000' . $exist['id'];
            }
            $insertData = ['username' => $name,
                'name' => $name,
                'email' => $email,
                'password' => MD5($pass),
                'mobile_no' => $mobile,
                'role' => 3,
                'status' => $status,
                'code' => $code,
                'user_type' => 'branch',
                'pass_text' => $pass,
                'domain_id'=>$domain_row->id,
                'date'=>date('Y-m-d H:i:s'),
                'created_on'=>date('Y-m-d H:i:s'),

            ];

            $reg = $this->Page_Model->insert_data($insertData, 'branch_franchise');
            $insertData['user_type'] = 'branch';
            $insertData['pass'] = $pass;

        

        $this->session->set_userdata('email_data', $email_data); // For email after payment.
        if ($reg) {

            $insertData['uid'] = $reg;
            $this->session->set_userdata($insertData);
            $data['status'] = 'true';
            echo json_encode($data);die;
        } else {
            $data['status'] = 'false';
            echo json_encode($data);die;
        }
    }

    public function checkAmount()
    {
        $data['name'] = $this->session->userdata('name');
        $data['email'] = $this->session->userdata('email');
        $data['mobile'] = $this->session->userdata('mobile');
        $data['title'] = 'check eligibility';
        $data['keywords'] = 'home,page,test';
        $data['description'] = 'this is eligibility page';
        $domain_id = domain_id_get();
        $data['buynowBanner'] = $this->db->where('domain_id',domain_id_get())->get('buynow_banner')->row_array();
        $data['buynowSection'] = $this->db->where('domain_id',domain_id_get())->get('buynow_section')->row_array();
        $data['buynow_section_2'] = $this->db->where('domain_id',domain_id_get())->get('buynow_section_2')->row_array();
        $data['buynow_section_1'] = $this->db->where('domain_id',domain_id_get())->get('buynow_section_1')->row_array();
        $data['smartChoice'] = $this->db->where('domain_id',domain_id_get())->get('banner_slider')->result_array();
        $data['contect_us'] = $this->db->where('domain_id',domain_id_get())->get('contect_us')->row_array();

        $this->load->view('Page/template/header', $data);
        $this->load->view('Page/check_amount', $data);
        $this->load->view('Page/template/footer', $data);
    }

    public function checkAmountAgen($id)
    {
        $user = $this->db->where('id',$id)->get('registerUser')->row_array();
        $user['uid'] = $user['id'];

        $this->session->set_userdata($user);

     
        $data['name'] = $user['name'];
        $data['email'] = $user['email'];
        $data['mobile'] = $user['mobile'];
        $data['title'] = 'check eligibility';
        $data['keywords'] = 'home,page,test';
        $data['description'] = 'this is eligibility page';
        $this->load->view('Page/template/header', $data);
        $this->load->view('Page/check_amount', $data);
        $this->load->view('Page/template/footer', $data);
    }

    public function agentdetail()
    {
        
        // echo "hhff";
        if (!$this->session->has_userdata('email')) {
            $this->session->sess_destroy();
            redirect('/', 'refresh');
        }
        $data['name'] = $this->session->userdata('name');
        $data['email'] = $this->session->userdata('email');
        $data['mobile'] = $this->session->userdata('mobile');
        $data['title'] = 'check eligibility';
        $data['keywords'] = 'home,page,test';
        $data['description'] = 'this is eligibility page';
        $data['dsaagentdetail'] = $this->db->where('domain_id',domain_id_get())->get('dsaagentdetail')->row_array();
        $this->load->view('Page/template/header', $data);
        $this->load->view('Page/agent_detail', $data);
        $this->load->view('Page/template/footer', $data);
    }

    public function brancedetail()
    {
        if (!$this->session->has_userdata('email')) {
            $this->session->sess_destroy();
            redirect('/', 'refresh');
        }
        $data['name'] = $this->session->userdata('name');
        $data['email'] = $this->session->userdata('email');
        $data['mobile'] = $this->session->userdata('mobile');
        $data['title'] = 'check eligibility';
        $data['keywords'] = 'home,page,test';
        $data['description'] = 'this is eligibility page';
        $data['branchAgentDetail'] = $this->db->where('domain_id',domain_id_get())->get('branchAgentDetail')->row_array();
        $this->load->view('Page/template/header', $data);
        $this->load->view('Page/brance_detail', $data);
        $this->load->view('Page/template/footer', $data);
    }

    // public function branceOffer()
    // {
    //     if (!$this->session->has_userdata('uid')) {
    //         $this->session->sess_destroy();
    //         redirect('/', 'refresh');
    //     }
    //     //$status = $this->Page_Model->insert_data($eligibilityData,'check_user_data');
    //     $uid = $this->session->userdata('uid');
    //     $Updatedata['city'] = $this->input->post('city');
    //     $Updatedata['pincode'] = $this->input->post('pin_code');
    //     $up = $this->Page_Model->update_data($uid, $Updatedata, 'branch_franchise');

    //     $data['data'] = $this->Page_Model->plan_data(3);
    //     // print_r( $data['data']);die;
    //     $data['title'] = 'Agent Payment Amount';
    //     $data['keywords'] = 'Agent payment,page,test';
    //     $data['description'] = 'this is Agent Payment page';
    //     $this->load->view('Page/template/header', $data);
    //     $this->load->view('Page/brance-offer', $data);
    //     $this->load->view('Page/template/footer', $data);

    // }

    public function branceOffer()
    {
        if (!$this->session->has_userdata('uid')) {
            $this->session->sess_destroy();
            redirect('/', 'refresh');
        }

        $uid = $this->session->userdata('uid');
        $city = $this->input->post('city');
        $pin_code = $this->input->post('pin_code');

        $current_domain = parse_url(base_url(), PHP_URL_HOST);
        $current_domain = preg_replace('/^www\./', '', $current_domain);

        $this->load->model('Page_Model');
        $domain_row = $this->Page_Model->get_domain_by_url($current_domain);

        $Updatedata = [
            'city' => $city,
            'pincode' => $pin_code
        ];

        if ($domain_row) {
            $Updatedata['domain_id'] = $domain_row->id;
        }

        $this->Page_Model->update_data($uid, $Updatedata, 'branch_franchise');

        $data['data'] = $this->Page_Model->plan_data(3);
        $data['title'] = 'Agent Payment Amount';
        $data['keywords'] = 'Agent payment,page,test';
        $data['description'] = 'this is Agent Payment page';

        $this->load->view('Page/template/header', $data);
        $this->load->view('Page/brance-offer', $data);
        $this->load->view('Page/template/footer', $data);
    }


    // public function agentOffer()
    // {
    //     if (!$this->session->has_userdata('uid')) {
    //         $this->session->sess_destroy();
    //         redirect('/', 'refresh');
    //     }
    //     //$status = $this->Page_Model->insert_data($eligibilityData,'check_user_data');
    //     $uid = $this->session->userdata('uid');
    //     $Updatedata['city'] = $this->input->post('city');
    //     $Updatedata['pin_code'] = $this->input->post('pin_code');
    //     $up = $this->Page_Model->update_data($uid, $Updatedata, 'user_master');

    //     $data['data'] = $this->Page_Model->plan_data(2);
    //     $data['title'] = 'Agent Payment Amount';
    //     $data['keywords'] = 'Agent payment,page,test';
    //     $data['description'] = 'this is Agent Payment page';
    //     $this->load->view('Page/template/header', $data);
    //     $this->load->view('Page/agent-offer', $data);
    //     $this->load->view('Page/template/footer', $data);

    // }


    public function agentOffer()
    {
        if (!$this->session->has_userdata('uid')) {
            $this->session->sess_destroy();
            redirect('/', 'refresh');
        }
    
        $uid = $this->session->userdata('uid');
        $city = $this->input->post('city');
        $pin_code = $this->input->post('pin_code');
    
        $current_domain = parse_url(base_url(), PHP_URL_HOST);
        $current_domain = preg_replace('/^www\./', '', $current_domain);
    
        $this->load->model('Page_Model');
        $domain_row = $this->Page_Model->get_domain_by_url($current_domain);
    
        $Updatedata = [
            'city' => $city,
            'pin_code' => $pin_code
        ];
    
        if ($domain_row) {
            $Updatedata['domain_id'] = $domain_row->id;
        }
    
        $this->Page_Model->update_data($uid, $Updatedata, 'user_master');
    
        $data['data'] = $this->Page_Model->plan_data(2);
        $data['title'] = 'Agent Payment Amount';
        $data['keywords'] = 'Agent payment,page,test';
        $data['description'] = 'this is Agent Payment page';
        $this->load->view('Page/template/header', $data);
        $this->load->view('Page/agent-offer', $data);
        $this->load->view('Page/template/footer', $data);
    }
    

    public function checkeligibility()
    {
        if (!$this->session->has_userdata('uid')) {
            $this->session->sess_destroy();
            redirect('/', 'refresh');
        }

         $this->load->model('Page_Model');

        $current_domain = parse_url(base_url(), PHP_URL_HOST);
        $current_domain = preg_replace('/^www\./', '', $current_domain);

        $domain_row = $this->Page_Model->get_domain_by_url($current_domain);

        $data['loan_amount'] = $this->input->post('loanamount');
        $data['cust_type'] = $this->input->post('usertype');
        $data['name'] = $this->session->userdata('name');
        $data['mobile'] = $this->input->post('usermobile');
        $data['uid'] = $this->session->userdata('uid');

        $data['title'] = 'check eligibility';
        $data['keywords'] = 'home,page,test';
        $data['description'] = 'this is eligibility page';


        $eligibilityData = ['uid' => $data['uid'],
            'loan_amount' => $data['loan_amount'],
            'cust_type' => $data['cust_type'],
        'domain_id' => domain_id_get(),
    
        ];
        $this->Page_Model->insert_data($eligibilityData, 'check_user_data');
        $updateData = [
     'step_url' => base_url("/checkeligibility/" . $data['uid']),
     'step' => 2,


    ];

        if ($domain_row) {
            $updateData['domain_id'] = $domain_row->id;
        }

       $this->Page_Model->update_data($data['uid'] , $updateData, 'registerUser');


        $this->load->view('Page/template/header', $data);
        $this->load->view('Page/eligibility', $data);
        $this->load->view('Page/template/footer', $data);

    }

    public function checkeligibilityAgen($id)
    {
        
       $user = $this->db->where('id',$id)->get('registerUser')->row_array();
       $user['uid'] = $user['id'];
       $this->session->set_userdata($user);

       $eligibilityData = $this->db->where('uid',$id)->get('check_user_data')->row_array();


        $data['loan_amount'] = $eligibilityData['loan_amount'];
        $data['cust_type'] = $eligibilityData['cust_type'];
        $data['name'] = $user['name'];
        $data['mobile'] = $user['mobile'];
        $data['uid'] = $id;

        $data['title'] = 'check eligibility';
        $data['keywords'] = 'home,page,test';
        $data['description'] = 'this is eligibility page';


  


        $this->load->view('Page/template/header', $data);
        $this->load->view('Page/eligibility', $data);
        $this->load->view('Page/template/footer', $data);

    }

    // public function preapproval()
    // {
    //     if (!$this->session->has_userdata('mobile')) {
    //         $this->session->sess_destroy();
    //         redirect('/', 'refresh');
    //     }
    //     $data['uid'] = $this->input->post('uid');
    //     $data['loan_amount'] = $this->input->post('loan_amount');
    //     $data['cust_type'] = $this->input->post('cust_type');
    //     $data['civil_score'] = $this->input->post('civil_score');
    //     $data['monthly_income'] = $this->input->post('monthly_income');
    //     $data['current_emi'] = $this->input->post('current_emi');
    //     $data['loan_type'] = $this->input->post('loan_type');
    //     $data['city'] = $this->input->post('city');
    //     $data['state'] = $this->input->post('state');
    //     $data['pan_no'] = $this->input->post('pan_no');
    //     $data['aadhaar_no'] = $this->input->post('aadhaar_no');

    //     $eligibilityData = ['uid' => $data['uid'],
    //     'loan_amount' => $data['loan_amount'],
    //     'cust_type' => $data['cust_type'],
    //     'civil_score' => $data['civil_score'],
    //     'monthly_income' => $data['monthly_income'],
    //     'current_emi' => $data['current_emi'],
    //     'loan_type' => $data['loan_type'],
    //     'city' => $data['city'],
    //     'state' => $data['state'],
    //     'pan_no' => $data['pan_no'],
    //     'aadhaar_no' => $data['aadhaar_no'],
    //     'domain_id' => domain_id_get(),
        
    //     ];
    //     $data['eligibilityData'] = $eligibilityData;
    //     $data['name'] = $this->session->userdata('name');
    //     $data['mobile'] = $this->session->userdata('mobile');
        
    //     $Updatedata['city'] = $data['city'];
    //     // $up = $this->Page_Model->update_data($data['uid'], $Updatedata, 'registerUser');
    //     $loanAmount = $this->db->where('uid',$data['uid'])->get('check_user_data')->row_array();
        
    //     if($loanAmount){
    //         $status = $this->db->where('uid',$data['uid'])->update('check_user_data',$eligibilityData);
    //     }else{
    //         $status = $this->Page_Model->insert_data($eligibilityData, 'check_user_data');
    //     }
    
    //     // echo '<pre>';print_r($status);die;
    //    $Updatedata = [
    //    'step_url' => base_url("/preapproval/" . $data['uid']),
    //    'step' => 3,
  
  
    //   ];
    //      $this->Page_Model->update_data($data['uid'] , $Updatedata, 'registerUser');
    //     $message = "Congrats! Your Loan has been Pre-Approved! 334540 Get money directly in your bank a/c. Get Offer Now- Instant loans Deals https://instantloansdeals.com/preapproval/?" . $data['uid'] . " Exelora consultancy pvt ltd";


    //         $sms = $this->sendSMSApproval($data['mobile'], $message);
    //         // print_r($sms);die;
            
    //         $this->load->view('Page/template/header', $data);
    //         $this->load->view('Page/offer', $eligibilityData);
    //         $this->load->view('Page/template/footer', $data);

    //     }


    public function preapproval()
{
    // 🔹 AUTO CLEAN URL: if URL is like /preapproval/?2516 → redirect to /preapproval/2516
    $uri = $_SERVER['REQUEST_URI']; // example: /preapproval/?2516

    if (strpos($uri, '?') !== false) {
        $parts = explode('?', $uri);

        if (!empty($parts[1])) {
            $cleanId = $parts[1];  // 2516
            redirect(base_url("preapproval/" . $cleanId));
            exit;
        }
    }

    // 🔹 Normal session check
    if (!$this->session->has_userdata('mobile')) {
        $this->session->sess_destroy();
        redirect('/', 'refresh');
    }

    // 🔹 All your original code below
    $data['uid'] = $this->input->post('uid');
    $data['loan_amount'] = $this->input->post('loan_amount');
    $data['cust_type'] = $this->input->post('cust_type');
    $data['civil_score'] = $this->input->post('civil_score');
    $data['monthly_income'] = $this->input->post('monthly_income');
    $data['current_emi'] = $this->input->post('current_emi');
    $data['loan_type'] = $this->input->post('loan_type');
    $data['city'] = $this->input->post('city');
    $data['state'] = $this->input->post('state');
    $data['pan_no'] = $this->input->post('pan_no');
    $data['aadhaar_no'] = $this->input->post('aadhaar_no');

    $eligibilityData = [
        'uid' => $data['uid'],
        'loan_amount' => $data['loan_amount'],
        'cust_type' => $data['cust_type'],
        'civil_score' => $data['civil_score'],
        'monthly_income' => $data['monthly_income'],
        'current_emi' => $data['current_emi'],
        'loan_type' => $data['loan_type'],
        'city' => $data['city'],
        'state' => $data['state'],
        'pan_no' => $data['pan_no'],
        'aadhaar_no' => $data['aadhaar_no'],
        'domain_id' => domain_id_get(),
    ];

    $data['eligibilityData'] = $eligibilityData;
    $data['name'] = $this->session->userdata('name');
    $data['mobile'] = $this->session->userdata('mobile');

    $Updatedata['city'] = $data['city'];

    $loanAmount = $this->db->where('uid', $data['uid'])->get('check_user_data')->row_array();

    if ($loanAmount) {
        $status = $this->db->where('uid', $data['uid'])->update('check_user_data', $eligibilityData);
    } else {
        $status = $this->Page_Model->insert_data($eligibilityData, 'check_user_data');
    }

    $Updatedata = [
        'step_url' => base_url("preapproval/" . $data['uid']),
        'step' => 3,
    ];

    $this->Page_Model->update_data($data['uid'], $Updatedata, 'registerUser');

    // SMS template cannot be changed — OK
    $message = "Congrats! Your Loan has been Pre-Approved! 334540 Get money directly in your bank a/c. Get Offer Now- Instant loans Deals https://instantloansdeals.com/preapproval/?" . $data['uid'] . " Exelora consultancy pvt ltd";

    $sms = $this->sendSMSApproval($data['mobile'], $message);

    $this->load->view('Page/template/header', $data);
    $this->load->view('Page/offer', $eligibilityData);
    $this->load->view('Page/template/footer', $data);
}


        


        public function preapprovalAgen($id)
        {


            $data['eligibilityData'] =  $this->db->where('uid',$id)->get('check_user_data')->row_array();
        
            $user = $this->db->where('id',$id)->get('registerUser')->row_array();

            $user['uid'] = $user['id'];

            $this->session->set_userdata($user);
    
            $data['name'] = $user['name'];
            $data['email'] = $user['email'];
            $data['mobile'] = $user['mobile'];
            $this->load->view('Page/template/header', $data);
            $this->load->view('Page/offer',$data);
            $this->load->view('Page/template/footer', $data);

        }


        public function card()
        {
            $data['uid'] = $this->input->post('uid');
            $data['loan_amount'] = $this->input->post('loan_amount');
            $data['required_loan_amount'] = $this->input->post('required_loan_amount');
            $data['tenure'] = $this->input->post('tenure');

            $annualInterestRate = 12;       
            if($data['tenure'] == 36){
            $emi = $this->calculateEMI($data['required_loan_amount'], $annualInterestRate, 36);
            }elseif($data['tenure'] == 48){
            $emi = $this->calculateEMI($data['required_loan_amount'], $annualInterestRate, 48);
            }elseif($data['tenure'] == 60){
            $emi = $this->calculateEMI($data['required_loan_amount'], $annualInterestRate, 60);
            }
        

            $pre_approval = ['uid' => $data['uid'],
            'loan_amount' => $data['loan_amount'],
            'required_loan_amount' => $data['required_loan_amount'],
            'tenure' => $data['tenure'],
            'emi' => $emi,
            'domain_id' => domain_id_get(),
        

        ];

        $updateData = [
            'step_url' => base_url("/card/" . $data['uid']),
            'step' => 4,
    
    
        ];
            $this->Page_Model->update_data($data['uid'] , $updateData, 'registerUser');
            $this->Page_Model->insert_data($pre_approval, 'pre_approval');
            $data['data'] = $this->db->where('domain_id',domain_id_get())->where('plan_type',1)->get('plan_tbl')->row();



            $data['title'] = 'Approval card';
            $data['keywords'] = 'Card,page,test';
            $data['description'] = 'this is Card page';
            $this->load->view('Page/template/header', $data);
            $this->load->view('Page/preapproval', $data);
            $this->load->view('Page/template/footer', $data);

        }

        public function cardAgen($id)
        {
        
            $user = $this->db->where('id',$id)->get('registerUser')->row_array();
            $user['uid'] = $user['id'];

            $this->session->set_userdata($user);
            $data['uid'] = $id;


            // $data['data'] = $this->Page_Model->plan_data(1);
            $data['data'] = $this->db->where('domain_id',domain_id_get())->where('plan_type',1)->get('plan_tbl')->row();

            $data['title'] = 'Approval card';
            $data['keywords'] = 'Card,page,test';
            $data['description'] = 'this is Card page';
            $this->load->view('Page/template/header', $data);
            $this->load->view('Page/preapproval', $data);
            $this->load->view('Page/template/footer', $data);

        }



        public function calculateEMI($P, $annualInterestRate, $n) {
            $r = ($annualInterestRate / 100) / 12; // Monthly Interest Rate
            $emi = ($P * $r * pow(1 + $r, $n)) / (pow(1 + $r, $n) - 1);
            return round($emi, 2);
        }
        public function randomPassword()
        {
            $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
            $pass = array(); //remember to declare $pass as an array
            $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
            for ($i = 0; $i < 8; $i++) {
                $n = rand(0, $alphaLength);
                $pass[] = $alphabet[$n];
            }
            return implode($pass); //turn the array into a string
        }

        // public function login()
        // {

        //     // $this->form_validation->set_rules('mobile_no','Mobile no','required');
        //     $this->form_validation->set_rules('email', 'Email', 'required');
        //     $this->form_validation->set_rules('password', 'Password', 'required|trim');
        //     $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');

        //     if ($this->form_validation->run() == false) {
        //         $this->load->view('customer');

        //     } else {

        //         $email = $this->security->xss_clean($this->input->post('email'));
        //         $password = md5($this->security->xss_clean($this->input->post('password')));
        //         $user = $this->Page_Model->customer_chk($email, $password);

        //         if ($user) {

        //             $userData = [
        //                 'userEmail' => $user->email,
        //                 // 'authenticated' => TRUE,
        //                 'user_id' => $user->id,
        //                 'username' => $user->username,

        //             ];

        //             $this->session->set_userdata($userData);
        //             redirect('/');

        //         } else {
        //             $this->session->set_flashdata('message', 'Oh, Invalid Email or Password, try again!!');
        //             redirect('customer');
        //         }
        //     }

        // }
        
        
        public function login()
    {
        // Set validation rules for login form
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');

        if ($this->form_validation->run() == false) {
            // Load the login view if validation fails
            $this->load->view('customer');
        } else {
            // Clean and fetch form input
            $email = $this->security->xss_clean($this->input->post('email'));
            $password = $this->security->xss_clean($this->input->post('password'));

            // Check user credentials
            $user = $this->Page_Model->customer_chk($email);
            // if ($user && password_verify($password, $user->password)) {
            if ($user && $user->password === md5($password)) {
                $userData = [
                    'userEmail' => $user->email,
                    'user_id' => $user->id,
                    'username' => $user->username,
                ];
                $this->session->set_userdata($userData);

                // Redirect to the homepage or dashboard
                redirect('/');
            } else {
                // Flash error message for invalid login
                $this->session->set_flashdata('message', 'Oh, Invalid Email or Password, try again!');
                redirect('customer');
            }
        }
    }


        public function logout()
        {
            $this->session->sess_destroy();
            redirect('/', 'refresh');
        }

        public function test()
        {

            echo 'test';
        }

        public function personalLoan()
        {

            $data['title'] = 'personalLoan';
            $data['keywords'] = 'personalLoan,page,test';
            $data['description'] = 'this is personalLoan page';

            $domain_id = domain_id_get();
            $data['buynowBanner'] = $this->db->where('domain_id',domain_id_get())->get('buynow_banner')->row_array();
            $data['buynowSection'] = $this->db->where('domain_id',domain_id_get())->get('buynow_section')->row_array();
            $data['buynow_section_2'] = $this->db->where('domain_id',domain_id_get())->get('buynow_section_2')->row_array();
            $data['buynow_section_1'] = $this->db->where('domain_id',domain_id_get())->get('buynow_section_1')->row_array();
            $data['smartChoice'] = $this->db->where('domain_id',domain_id_get())->get('banner_slider')->result_array();
            $data['contect_us'] = $this->db->where('domain_id',domain_id_get())->get('contect_us')->row_array();

            $this->load->view('Page/template/header', $data);
            $this->load->view('Page/personal_loan', $data);
            $this->load->view('Page/template/footer', $data);
        }

    //     public function otpPage() {
    //         $this->load->view('Page/template/header',$data);
    //         $this->load->view('Page/personal_loan',$data);
    //         $this->load->view('Page/template/footer',$data);

    //     }
        public function company()
        {
            $data['title'] = 'Home';
            $data['keywords'] = 'home,page,test';
            $data['description'] = 'this is home page';
            
            $domain_id = domain_id_get();
            $data['company_profile'] = $this->db->where('domain_id',$domain_id)->get('company_profile')->row_array();
        
            $data['our_story'] = $this->db->where('domain_id',$domain_id)->get('our_story')->row_array();
            $data['our_stories'] = $this->db->where('domain_id',$domain_id)->get('our_story')->result_array();

            $data['smart_choice'] = $this->db->where('domain_id',$domain_id)->get('smart_choice')->row_array();
            $data['smart_choices'] = $this->db->where('domain_id',$domain_id)->get('smart_choice')->result_array();

            $data['media_coverage'] = $this->db->where('domain_id',$domain_id)->get('media_coverage')->row_array();
            $data['media_coverages'] = $this->db->where('domain_id',$domain_id)->get('media_coverage')->result_array();

            $this->load->view('Page/template/header', $data);
            $this->load->view('Page/company', $data);
            $this->load->view('Page/template/footer', $data);
        }
        public function emi_calculator()
        {
            $data['title'] = 'Emi-Calculator';
            $data['keywords'] = 'home,page,test';
            $data['description'] = 'this is Emi-Calculator page';
            $this->load->view('Page/template/header', $data);
            $this->load->view('Page/calculator', $data);
            $this->load->view('Page/template/footer', $data);
        }

        public function career()
        {
            $data['title'] = 'Career';
            $data['keywords'] = 'home,page,test';
            $data['description'] = 'this is Career page';
            $this->load->view('Page/template/header', $data);
            $this->load->view('Page/career', $data);
            $this->load->view('Page/template/footer', $data);
        }

        public function about()
        {
            $data['title'] = 'About';
            $data['keywords'] = 'about,page,test';
            $data['description'] = 'this is about page';
            $this->load->view('Page/about', $data);
        }

        public function services()
        {
            $data['title'] = 'Services';
            $data['keywords'] = 'services,page,test';
            $data['description'] = 'this is services page';
            $this->load->view('Page/services', $data);
        }
        public function contact()
        {
            $data['title'] = 'Contact';
            $data['keywords'] = 'contact,page,test';
            $data['description'] = 'this is contact page';
            $this->load->view('Page/template/header', $data);
            $data['contectUs'] = $this->db->where('domain_id',domain_id_get())->get('contect_us')->row_array();
            $this->load->view('Page/contact', $data);
            $this->load->view('Page/template/footer', $data);

        }

        public function raise_request()
        {

            $data['title'] = 'Raise-request';
            $data['keywords'] = 'Raise request,page,test';
            $data['description'] = 'this is Raise request page';
            $data['contectUs'] = $this->db->where('domain_id',domain_id_get())->get('contect_us')->row_array();
            $this->load->view('Page/template/header', $data);
            $this->load->view('Page/raise_request', $data);
            $this->load->view('Page/template/footer', $data);

        }

        public function plantinum_membership_card()
        {
            $domain_id = domain_id_get();
            // $amount = $this->Page_Model->get_payment_data('Platinum', 1);
            $amount = $this->db->where('domain_id',$domain_id)->where('plan2_name','Platinum')->get('plan_tbl')->row();
            $data['amount'] = $amount->amount2 ?? '';
            // print_r($amount);die;
            $data['title'] = 'plantinum-membership-card';
            $data['keywords'] = 'plantinum-membership-card,page,test';
            $data['description'] = 'this is plantinum-membership-card page';

            $data['plantinumBanner'] = $this->db->where('domain_id', $domain_id)->get('plantinum_banner')->row_array();
            $data['plantinum_section_1'] = $this->db->where('domain_id', $domain_id)->get('plantinum_section_1')->row_array();
            $data['plantinum_section_2'] = $this->db->where('domain_id', $domain_id)->get('plantinum_section_2')->row_array();
            $data['plantinum_section_3'] = $this->db->where('user_id',1)->get('plantinum_section_3')->row_array();
            $data['plantinum_sections_3'] = $this->db->where('user_id',1)->get('plantinum_section_3')->result_array();
            $data['plantinum_section_4'] = $this->db->where('user_id',1)->get('plantinum_section_4')->row_array();
            $data['plantinum_sections_4'] = $this->db->where('user_id',1)->get('plantinum_section_4')->result_array();
            $data['contect_us'] = $this->db->where('domain_id', $domain_id)->get('contect_us')->row_array();

            $data['cardColor'] = $this->db->where('domain_id', $domain_id)->get('card_color')->row_array();
            // print_r($data['cardColor']);die;

            $this->load->view('Page/template/header', $data);
            $this->load->view('Page/plantinum-membership', $data);
            $this->load->view('Page/template/footer', $data);
        }

        public function premium_membership_card()
        {

            $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
            $domain = $_SERVER['HTTP_HOST'];
            $domain = $protocol . $domain."/";

            $query = $this->db->get_where('domains', ['url' => $domain]);
            $domain_id = 1;
            if ($query->num_rows() > 0) {
                $domain_data = $query->row();
                $domain_id =(int) $domain_data->id;
            }

            //echo $domain_id; die;
            $domain_id = domain_id_get();

            // $amount = $this->Page_Model->get_payment_data('Silver', 1);
            $amount = $this->db->where('domain_id',$domain_id)->where('plan_name','Silver')->get('plan_tbl')->row();
            $data['amount'] = $amount->amount ?? '' ;
            $data['title'] = 'premium-membership-card';
            $data['keywords'] = 'premium-membership-card,page,test';
            $data['description'] = 'this is premium-membership-card page';

            $data['silverBanner'] = $this->db->where('domain_id',$domain_id)->get('silver_banner')->row_array();
            $data['silver_section_1'] = $this->db->where('domain_id',$domain_id)->get('silver_section_1')->row_array();
            $data['silver_section_2'] = $this->db->where('domain_id',$domain_id)->get('silver_section_2')->row_array();
            $data['silver_section_3'] = $this->db->where('domain_id',$domain_id)->get('silver_section_3')->row_array();
            $data['silver_sections_3'] = $this->db->where('domain_id',$domain_id)->get('silver_section_3')->result_array();
            $data['silver_section_4'] = $this->db->where('domain_id',$domain_id)->get('silver_section_4')->row_array();
            $data['silver_sections_4'] = $this->db->where('domain_id',$domain_id)->get('silver_section_4')->result_array();
            $data['contect_us'] = $this->db->where('domain_id',$domain_id)->get('contect_us')->row_array();

            $data['cardColor'] = $this->db->where('domain_id',$domain_id)->get('card_color')->row_array();
            
            $this->load->view('Page/template/header', $data);
            $this->load->view('Page/premium-membership', $data);
            $this->load->view('Page/template/footer', $data);

        }
        public function important_update()
        {
            $data['title'] = 'Important Update-';
            $data['keywords'] = 'update,page,test';
            $data['description'] = 'this is Important Update page';
            $data['important_update'] = $this->db->where('domain_id',domain_id_get())->get('important_update')->row_array();
            $this->load->view('Page/template/header', $data);
            $this->load->view('Page/important-update', $data);
            $this->load->view('Page/template/footer', $data);

        }
        public function terms_conditions()
        {
            $data['title'] = 'Terms & Conditions-';
            $data['keywords'] = 'terms-condtions,page,test';
            $data['description'] = 'this is Terms & Conditions page';
            $data['terms_condition'] = $this->db->where('domain_id',domain_id_get())->get('terms_condition')->row_array();
            $this->load->view('Page/template/header', $data);
            $this->load->view('Page/terms-condtions', $data);
            $this->load->view('Page/template/footer', $data);

        }
        public function disclaimer()
        {
            $data['title'] = 'disclaimer-';
            $data['keywords'] = 'disclaimer,page,test';
            $data['description'] = 'this is Disclaimer page';
            $data['disclaimer'] = $this->db->where('domain_id',domain_id_get())->get('disclaimer')->row_array();
            $this->load->view('Page/template/header', $data);
            $this->load->view('Page/disclaimer', $data);
            $this->load->view('Page/template/footer', $data);

        }
        public function refund_policy()
        {
            $data['title'] = 'Cancellation & Refund Policy-';
            $data['keywords'] = 'refund-policy,page,test';
            $data['description'] = 'this is Cancellation & Refund Policy page';
            $data['refund_policy'] = $this->db->where('domain_id',domain_id_get())->get('cancellation_and_refund_policy')->row_array();
            $this->load->view('Page/template/header', $data);
            $this->load->view('Page/refund-policy', $data);
            $this->load->view('Page/template/footer', $data);

        }
        public function privacy_policy()
        {
            $data['title'] = 'Privacy Policy-';
            $data['keywords'] = 'privacy-policy,page,test';
            $data['description'] = 'this is Privacy Policy page';
            $data['privacy_policy'] = $this->db->where('domain_id',domain_id_get())->get('privacy_policy')->row_array();
            $this->load->view('Page/template/header', $data);
            $this->load->view('Page/privacy-policy', $data);
            $this->load->view('Page/template/footer', $data);

        }
        public function faqs()
        {
            $data['title'] = 'faqs-';
            $data['keywords'] = 'faqs,page,test';
            $data['description'] = 'this is faqs page';
            $this->load->view('Page/template/header', $data);
            $this->load->view('Page/faqs', $data);
            $this->load->view('Page/template/footer', $data);

        }
        public function finmax_plan()
        {
            $data['title'] = 'finmax plan-';
            $data['keywords'] = 'finmax-plan,page,test';
            $data['description'] = 'this is finmax-plan page';
            $this->load->view('Page/template/header', $data);
            $this->load->view('Page/finmax_plan', $data);
            $this->load->view('Page/template/footer', $data);
        }

        public function branch_franchise_code()
        {
            $data['title'] = 'Branch-Franchiser-Code-';
            $data['keywords'] = 'Branch-Franchiser-Code,page,test';
            $data['description'] = 'this is Branch-Franchiser-Code page';
            $data['branchBanner'] = $this->db->where('domain_id',domain_id_get())->get('branch_banner')->row_array();
            $this->load->view('Page/template/header', $data);
            $this->load->view('Page/branch_franchise_code', $data);
            $this->load->view('Page/template/footer', $data);
        }

        public function channel_partner_code()
        {
            
            $data['title'] = 'channel-partner-code-';
            $data['keywords'] = 'channel-partner-code,page,test';
            $data['description'] = 'this is channel-partner-code page';
            $domain_id = domain_id_get();
            $data['dsaBanner'] = $this->db->where('domain_id',$domain_id)->get('dsa_banner')->row_array();
            // echo '<pre>';print_r($data['dsaBanner']);die;
            $data['dsaSection1'] = $this->db->where('domain_id',$domain_id)->get('dsa_section_1')->row_array();
            $data['dsaSection2'] = $this->db->where('domain_id',$domain_id)->get('dsa_section_2')->row_array();
            $data['dsaSection3'] = $this->db->where('domain_id',$domain_id)->get('dsa_section_3')->row_array();

            $this->load->view('Page/template/header', $data);
            $this->load->view('Page/channel_partner_code', $data);
            $this->load->view('Page/template/footer', $data);
        }
        public function personal_loan()
        {
            $data['title'] = 'personal_loan-';
            $data['keywords'] = 'personal_loan,page,test';
            $data['description'] = 'this is personal_loan page';
            $this->load->view('Page/template/header', $data);
            $this->load->view('Page/personal_loan', $data);
            //$this->load->view('Page/template/footer',$data);
        }
        public function business_loan()
        {
            $data['title'] = 'business-loan-';
            $data['keywords'] = 'business-loan,page,test';
            $data['description'] = 'this is business-loan page';
            $data['dsaagentdetail'] = $this->db->where('domain_id',domain_id_get())->get('dsaagentdetail')->row_array();
            $this->load->view('Page/template/header', $data);
            $this->load->view('Page/business_loan', $data);
            //    $this->load->view('Page/template/footer',$data);
        }
        public function finmax()
        {
            $data['title'] = 'finmax-';
            $data['keywords'] = 'finmax,page,test';
            $data['description'] = 'this is finmax page';
            $this->load->view('Page/template/header', $data);
            $this->load->view('Page/finmax', $data);
            //$this->load->view('Page/template/footer',$data);
        }
        public function customer()
        {
            $data['title'] = 'customer-';
            $data['keywords'] = 'customer,page,test';
            $data['description'] = 'this is customer page';
            $this->load->view('Page/template/header', $data);
            $this->load->view('Page/customer', $data);
            $this->load->view('Page/template/footer', $data);
        }

        public function agent()
        {
            $data['title'] = 'channel-partner-';
            $data['keywords'] = 'channel-partner,page,test';
            $data['description'] = 'this is channel-partner page';
            $data['dsaagentdetail'] = $this->db->where('domain_id',domain_id_get())->get('dsaagentdetail')->row_array();
            $this->load->view('Page/template/header', $data);
            $this->load->view('Page/business_loan', $data);
            $this->load->view('Page/template/footer', $data);
        }
        
        public function branch_franchise()
        {
            $data['title'] = 'channel-partner-';
            $data['keywords'] = 'channel-partner,page,test';
            $data['description'] = 'this is channel-partner page';
            $this->load->view('Page/template/header', $data);
            $data['branchAgentDetail'] = $this->db->where('domain_id',domain_id_get())->get('branchAgentDetail')->row_array();
            $this->load->view('Page/branch_franchise', $data);
            $this->load->view('Page/template/footer', $data);
        }

        public function cureent_opening()
        {
            $data['title'] = 'cureent-opening-';
            $data['keywords'] = 'cureent-opening,page,test';
            $data['description'] = 'this is cureent-opening page';
            $this->load->view('Page/template/header', $data);
            $this->load->view('Page/cureent_opening', $data);
            $this->load->view('Page/template/footer', $data);
        }
        public function forgot_password()
        {
            $data['title'] = 'forgot_password-';
            $data['keywords'] = 'cureent-opening,page,test';
            $data['description'] = 'this is cureent-opening page';
            $this->load->view('Page/template/header', $data);
            $this->load->view('Page/forgot-password', $data);
            $this->load->view('Page/template/footer', $data);
        }
    //     public function premium_membership()
    //     {
    //         $data['title'] = 'premium-membership-'; $data['keywords'] = 'premium-membership,page,test'; $data['description'] = 'this is premium-membership page';
    //         $this->load->view('Page/template/header',$data);
    //         $this->load->view('Page/premium-membership',$data);
    //         $this->load->view('Page/template/footer',$data);
    //     }
    //     public function platinum_membership()
    //     {
    //         $data['title'] = 'platinum_membership-'; $data['keywords'] = 'cureent-opening,page,test'; $data['description'] = 'this is cureent-opening page';
    //         $this->load->view('Page/template/header',$data);
    //         $this->load->view('Page/platinum-membership',$data);
    //         $this->load->view('Page/template/footer',$data);
    //     }

        public function blog()
        {
            $data['title'] = 'Blog-';
            $data['keywords'] = 'cureent-opening,page,test';
            $data['description'] = 'This is Blog page';
    $domain_id = domain_id_get();
            // $data['datas'] = $this->Page_Model->common_alls('blog');
            $data['datas'] = $this->db->where('status', 1)->where('domain_id',$domain_id)->get('blog')->result();
            $this->load->view('Page/template/header', $data);
            $this->load->view('Page/blog', $data);
            $this->load->view('Page/template/footer', $data);
        }

        public function blog_detail($id)
        {
            $data['title'] = 'Blog-Detail';
            $data['keywords'] = 'cureent-opening,page,test';
            $data['description'] = 'This is Blog Detail page';
    $domain_id = domain_id_get();
            $data['data'] = $this->db->where('id', $id)->where('domain_id',$domain_id)->get('blog')->row();
            // echo '<pre>';
            // print_r($data);die;
            $this->load->view('Page/template/header', $data);
            $this->load->view('Page/blog_detail', $data);
            $this->load->view('Page/template/footer', $data);
        }

        public function loan_create()
        {

            $post = $this->input->post();
            $post['domain_id'] = domain_id_get();
            // print_r($post);die;
            $insert = $this->Dashboard_Model->common_insert($post, 'loan_master');

            if ($insert) {
                $this->session->set_flashdata('success', 'loan has been Created Successfully!!');
                redirect('admin/loan');
            } else {
                $this->session->set_flashdata('error', 'Something Went Wrong, try again!!');
                redirect('page/loan-add');
            }

        }
        public function enquiry_leads()
        {
            $data['title'] = 'Loan-';
            $data['keywords'] = 'cureent-opening,page,test';
            $data['description'] = 'This is Loan page';
            $domain_id = domain_id_get();
            $current_domain = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http");
            $current_domain .= "://" . $_SERVER['HTTP_HOST'] . '/';
            $data['heading'] =  $this->db->where('domain_id',$domain_id)->where('type','loan_enquiry')->get('settings')->row_array();
            $data['states'] = $this->db->get('states')->result_array();
             // Current page URL
                $loan = $_GET['loan'];
                $segment = $this->uri->segment(1); // enquiry-leads
                $url = $segment.'?loan='.$loan;
                // Get menu id from menus table
                $menu = $this->db->like('url', $url)
                                ->where('domain_id', $domain_id) // agar menus me domain_id hai
                                ->get('menus')
                                ->row_array();
                                // print_r($menu);die;

                if (!empty($menu)) {

                    // Get content using menu_id
                    $data['page_content'] = $this->db
                        ->where('domain_id', $domain_id)
                        ->where('menu_id', $menu['id'])
                        ->get('enquiry_content')
                        ->row_array();

                } else {
                    $data['page_content'] = [];
                }
            // print_r($this->db->last_query());die;
            $this->load->view('Page/template/header', $data);
            $this->load->view('Page/enquiry_leads', $data);
            $this->load->view('Page/template/footer', $data);
        }

        
        public function loan_insert() {
            $this->form_validation->set_rules('name', 'Full Name', 'required|trim|max_length[100]');
            $this->form_validation->set_rules('mobile', 'Mobile Number', 'required');
            $this->form_validation->set_rules('email', 'Email', 'valid_email|max_length[100]');
            $this->form_validation->set_rules('state', 'State', 'required');
            $this->form_validation->set_rules('city', 'City', 'required|max_length[50]');
            $this->form_validation->set_rules('pincode', 'Pincode', 'required');
            $this->form_validation->set_rules('loan_amount', 'Loan Amount', 'required|numeric');
            $this->form_validation->set_rules('terms', 'Terms and Conditions', 'required');
            $this->form_validation->set_rules('domain_id', 'Domain ID', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error', validation_errors());
                redirect('enquiry-leads?loan='.$this->input->post('type'));
            } else {    
                $data = array(
                    'name' => $this->input->post('name'),
                    'mobile' => $this->input->post('mobile'),
                    'email' => $this->input->post('email'),
                    'age' => $this->input->post('age'),
                    'address' => $this->input->post('address'),
                    'state' => $this->input->post('state'),
                    'city' => $this->input->post('city'),
                    'pincode' => $this->input->post('pincode'),
                    'aadhar' => $this->input->post('aadhar'),
                    'pan' => strtoupper($this->input->post('pan')),
                    'loan_amount' => $this->input->post('loan_amount'),
                    'type' => $this->input->post('type'),
                    'domain_id' => $this->input->post('domain_id') ?: NULL,
                    'status' => 'pending',
                    'created_at' => date('Y-m-d H:i:s')
                );

            $insert_id = $this->Page_Model->insert_data($data, 'loan_enquiry_tbl');

                if ($insert_id) {
                    $this->session->set_flashdata('success', 'Thank you for your enquiry. We will contact you soon!');
                    redirect('enquiry-leads?loan='.$this->input->post('type'));
                } else {
                    $this->session->set_flashdata('error', 'There was an error submitting your enquiry. Please try again.');
                    redirect('enquiry-leads?loan='.$this->input->post('type'));
                }
            }
        }

    
        public function government_services()
        {
            $data['title'] = 'Government Services-';
            $data['keywords'] = 'cureent-opening,page,test';
            $data['description'] = 'This is Government Services page';
            $domain_id = domain_id_get();
            $data['heading'] =  $this->db->where('domain_id',$domain_id)->where('type','government_services')->get('settings')->row_array();
            $data['states'] = $this->db->get('states')->result_array();
            $this->load->view('Page/template/header', $data);
            $this->load->view('Page/government_services', $data);
            $this->load->view('Page/template/footer', $data);
        }

        
        public function government_services_insert() {
            $this->form_validation->set_rules('name', 'Full Name', 'required|trim|max_length[100]');
            $this->form_validation->set_rules('mobile', 'Mobile Number', 'required');
            $this->form_validation->set_rules('email', 'Email', 'valid_email|max_length[100]');
            $this->form_validation->set_rules('state', 'State', 'required');
            $this->form_validation->set_rules('city', 'City', 'required|max_length[50]');
            $this->form_validation->set_rules('pincode', 'Pincode', 'required');
            $this->form_validation->set_rules('terms', 'Terms and Conditions', 'required');
            $this->form_validation->set_rules('domain_id', 'Domain ID', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error', validation_errors());
                redirect('government-services?loan='.$this->input->post('type'));
            } else {    
                $data = array(
                    'name' => $this->input->post('name'),
                    'mobile' => $this->input->post('mobile'),
                    'email' => $this->input->post('email'),
                    'address' => $this->input->post('address'),
                    'state' => $this->input->post('state'),
                    'city' => $this->input->post('city'),
                    'pincode' => $this->input->post('pincode'),
                    'type' => $this->input->post('type'),
                    'domain_id' => $this->input->post('domain_id') ?: NULL,
                    'status' => 'pending',
                    'created_at' => date('Y-m-d H:i:s')
                );

            $insert_id = $this->Page_Model->insert_data($data, 'government_services_tbl');

                if ($insert_id) {
                    $this->session->set_flashdata('success', 'Thank you for your enquiry. We will contact you soon!');
                    redirect('government-services?loan='.$this->input->post('type'));
                } else {
                    $this->session->set_flashdata('error', 'There was an error submitting your enquiry. Please try again.');
                    redirect('government-services?loan='.$this->input->post('type'));
                }
            }
        }

        public function brand_loan()
        {
            $data['title'] = 'Brand Loan-';
            $data['keywords'] = 'cureent-opening,page,test';
            $data['description'] = 'This is Brand Loan page';
            $domain_id = domain_id_get();
            $data['heading'] =  $this->db->where('domain_id',$domain_id)->where('type','brand_loan')->get('settings')->row_array();
            $data['states'] = $this->db->get('states')->result_array();
            $this->load->view('Page/template/header', $data);
            $this->load->view('Page/brand_loan', $data);
            $this->load->view('Page/template/footer', $data);
        }

        
        public function brand_loan_insert() {
            $this->form_validation->set_rules('name', 'Full Name', 'required|trim|max_length[100]');
            $this->form_validation->set_rules('mobile', 'Mobile Number', 'required');
            $this->form_validation->set_rules('email', 'Email', 'valid_email|max_length[100]');
            $this->form_validation->set_rules('state', 'State', 'required');
            $this->form_validation->set_rules('city', 'City', 'required|max_length[50]');
            $this->form_validation->set_rules('pincode', 'Pincode', 'required');
            $this->form_validation->set_rules('terms', 'Terms and Conditions', 'required');
            $this->form_validation->set_rules('domain_id', 'Domain ID', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error', validation_errors());
                redirect('brand-loan?loan='.$this->input->post('type'));
            } else {    
                $data = array(
                    'name' => $this->input->post('name'),
                    'mobile' => $this->input->post('mobile'),
                    'email' => $this->input->post('email'),
                    'address' => $this->input->post('address'),
                    'state' => $this->input->post('state'),
                    'city' => $this->input->post('city'),
                    'pincode' => $this->input->post('pincode'),
                    'type' => $this->input->post('type'),
                    'domain_id' => $this->input->post('domain_id') ?: NULL,
                    'status' => 'pending',
                    'created_at' => date('Y-m-d H:i:s')
                );

            $insert_id = $this->Page_Model->insert_data($data, 'brand_loan_tbl');

                if ($insert_id) {
                    $this->session->set_flashdata('success', 'Thank you for your enquiry. We will contact you soon!');
                    redirect('brand-loan?loan='.$this->input->post('type'));
                } else {
                    $this->session->set_flashdata('error', 'There was an error submitting your enquiry. Please try again.');
                    redirect('brand-loan?loan='.$this->input->post('type'));
                }
            }
        }

    

    }
