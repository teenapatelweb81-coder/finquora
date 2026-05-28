<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'libraries/razorpay/Razorpay.php';
include APPPATH . 'third_party/vendor/autoload.php';

use Razorpay\Api\Api;

class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->model('admin/Dashboard_Model');
    }

    public function index()
    {
        //$this->load->view('welcome_message');
        echo "this is admin home page";
    }

    public function test()
    {

        echo "this is Home trst file";
    }

    public function sharePage($id)
    {
        $data['loans'] = $this->db->where(array('status' => 1, 'id' => $id))->order_by('id', 'DESC')->get('loan_master')->row_array();
        $data['document'] = $this->db->where(array('status' => 1, 'loan_id' => $id))->get('lead_document')->result_array();
        $data['lead_list'] = $this->db->where(array('status' => 1, 'loan_id' => $id))->get('new_leads')->result_array();
        $data['rms'] = $this->db->where(array('id' => 793))->get('user_master')->result_array();
        $data['bank_data'] = $this->Dashboard_Model->bank_list();
        $data['banker'] = $this->Dashboard_Model->loan_list();
        $data['states'] = $this->Dashboard_Model->state_data();
        $this->load->view('admin/template/shareheader');
        $this->load->view('admin/loan/sharepage', $data);
        $this->load->view('admin/template/footer');
    }

    public function sharePagebusiness($id)
    {
        $data['loans'] = $this->db->where(array('status' => 1, 'id' => $id))->get('loan_master')->row_array();
        $data['bank_data'] = $this->Dashboard_Model->bank_list();
        $data['states'] = $this->Dashboard_Model->state_data();
        $this->load->view('admin/template/shareheader');
        $this->load->view('admin/loan/business', $data);
        $this->load->view('admin/template/footer');
    }

    public function sharePagehome($id)
    {
        $data['loans'] = $this->db->where(array('status' => 1, 'id' => $id))->order_by('id', 'DESC')->get('loan_master')->row_array();
        $data['document'] = $this->db->where(array('status' => 1, 'loan_id' => $id))->get('lead_document')->result_array();
        $data['states'] = $this->Dashboard_Model->state_data();
        $data['banker'] = $this->Dashboard_Model->loan_list();
        $data['bank_data'] = $this->Dashboard_Model->bank_list();
        $this->load->view('admin/template/shareheader');
        $this->load->view('admin/loan/sharepagehome', $data);
        $this->load->view('admin/template/footer');
    }

    public function sharePagecredit($id)
    {
        $data['states'] = $this->Dashboard_Model->state_data();
        $data['loans'] = $this->db->where(array('status' => 1, 'id' => $id))->get('loan_master')->row_array();
        $data['rms'] = $this->db->where(array('id' => 793))->get('user_master')->result_array();
        $this->load->view('admin/template/shareheader');
        $this->load->view('admin/loan/sharepagecredit', $data);
        $this->load->view('admin/template/footer');
    }

    public function loan_lead_update()
    {
        $post = $this->input->post();
        // print_r($post);die;

        $inserted_id = $post['id'];
        $data = array(
            'loan_amount_req' => $post['loan_amount_req'],
            'client_name' => $post['client_name'],
            'clientnumber' => $post['clientnumber'],
            'dob' => $post['dob'],
            'pan' => $post['pan'],
            'aadhar' => $post['aadhar'],
            'marital_status' => $post['marital_status'],
            'spouse_house' => $post['spouse_house'],
            'mother_name' => $post['mother_name'],
            'alt_number' => $post['alt_number'],
            'qualification' => $post['qualification'],
            'residential_type' => $post['residential_type'],
            'residential_address' => $post['residential_address'],
            'residential_address_token' => $post['residential_address_token'],
            'residence_stability' => $post['residence_stability'],
            'state' => $post['state_name'],
            'city' => $post['city'],
            'pin_code' => $post['pin_code'],
            'company_name' => $post['company_name'],

            'designation' => $post['designation'],
            'company_address' => $post['company_address'],
            'net_salary' => $post['net_salary'],
            'salary_transfer_mode' => $post['salary_transfer_mode'],
            'job_period' => $post['job_period'],
            'job_experience' => $post['job_experience'],
            'ofc_email' => $post['ofc_email'],
            'ofc_number' => $post['ofc_number'],
            'no_of_dependent' => $post['no_of_dependent'],
            'cc_outstanding_amount' => $post['cc_outstanding_amount'],
            'remark' => $post['remark'],

            'ref_name1' => $post['ref_name1'],
            'ref_name2' => $post['ref_name2'],
            'ref_mobile1' => $post['ref_mobile1'],
            'ref_mobile2' => $post['ref_mobile2'],
            'ref_relation1' => $post['ref_relation1'],
            'apply_for_loan' => $post['apply_for_loan'],
            'ref_relation2' => $post['ref_relation2'],
            'domain_id' => domain_id_get(),
            'role' =>  $this->session->userdata('role'),
        );

        $loan_del = $this->Dashboard_Model->common_update($inserted_id, $data, 'loan_master');

        for ($i = 0; $i < count($post['loan_type']); $i++) {
            $lead = array(
                'loan_type' => $post['loan_type'][$i],
                'loan_amount' => $post['loan_amount'][$i],
                'bank_name' => $post['bank_name'][$i],
                'emi_amount' => $post['emi_amount'][$i],
                'paid_emi' => $post['paid_emi'][$i],
                'loan_id' => $inserted_id,
            );

            $insert2 = $this->Dashboard_Model->common_insert($lead, 'new_leads');
        }

        for ($i = 0; $i < count($post['attachment']); $i++) {
            if ($_FILES["image"]["size"][$i] > 0) {
                $tmpFilePath = $_FILES['image']['tmp_name'][$i];
                $fileinfo = @getimagesize($_FILES["image"]["tmp_name"][$i]);
                $image_file_type = pathinfo($_FILES["image"]["name"][$i], PATHINFO_EXTENSION);
                $newFilePath = 'upload/assets/images/' . time() . '.' . rand() . '.' . $image_file_type;

                if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                    $post['image'][$i] = $newFilePath;
                }
            }

            $file = array(
                'attachment' => $post['attachment'][$i],
                'image' => isset($post['image'][$i]) ? $post['image'][$i] : '',
                'password' => $post['password'][$i],
                'loan_id' => $inserted_id,
            );

            $insert2 = $this->Dashboard_Model->common_insert($file, 'lead_document');
        }

        if ($insert) {
            $this->session->set_flashdata('success', 'loan has been Created Successfully!!');
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            $this->session->set_flashdata('error', 'Something Went Wrong, try again!!');
            redirect($_SERVER['HTTP_REFERER']);
        }

    }

    public function credit_Update()
    {
        $data = $this->input->post();
        $id = $data['id'];
        unset($data['id']);
        $update = $this->Dashboard_Model->common_update($id, $data, 'loan_master');

        if ($update) {
            $this->session->set_flashdata('success', 'Updated successfully.');
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            $this->session->set_flashdata('error', 'Something Went Wrong, try again!!');
            redirect($_SERVER['HTTP_REFERER']);
        }

    }

    public function loan_lead_add()
    {
        if ($this->input->post()) {
            $post = $this->input->post();

            $role = (!empty($_GET['role'])) ? $_GET['role'] : '';
            $type = (!empty($_GET['user_id'])) ? $_GET['user_id'] : '';

            if ($role == 3) {
                $user_data = $this->db->where('id', $type)->where('role', $role)->get('branch_franchise')->row_array();
            }else {
                $user_data = $this->db->where('id', $type)->where('role', $role)->get('user_master')->row_array();
            }
            $domain = $this->db->where('id',$user_data['domain_id'])->get('domains')->result_array();

            $data = array(
                'loan_amount_req' => $post['loan_amount_req'],
                'client_name' => $post['client_name'],
                'clientnumber' => $post['clientnumber'],
                'email' => $post['email'],
                'company_name' => $post['company_name'],
                'net_salary' => $post['net_salary'],
                'state' => $post['state_name'],
                'city' => $post['city'],
                'pin_code' => $post['pin_code'],
                'user_id' => $type,
                'remark' => $post['remark'],
                'marital_status' => $post['marital_status'],
                'residence_type' => $post['residence_type'],
                'residential_status' => $post['residential_status'],
                'spouse_house' => $post['spouse_house'],
                'mother_name' => $post['mother_name'],
                'designation' => $post['designation'],
                'company_address' => $post['company_address'],
                'salary_transfer_mode' => $post['salary_transfer_mode'],
                'total_job_experience' => $post['total_job_experience'],
                'ref_name1' => $post['ref_name1'],
                'ref_name2' => $post['ref_name2'],
                'ref_mobile1' => $post['ref_mobile1'],
                'ref_mobile2' => $post['ref_mobile2'],
                'ref_relation1' => $post['ref_relation1'],
                'apply_for_loan' => $post['apply_for_loan'],
                'ref_relation2' => $post['ref_relation2'],
                'domain_id' => domain_id_get(),
                'role' =>  $this->session->userdata('role'),
            );

            $insert = $this->Dashboard_Model->common_insert($data, 'loan_master');
            $inserted_id = $this->db->insert_id();

            for ($i = 0; $i < count($post['loan_type']); $i++) {
                $lead = array(
                    'loan_type' => $post['loan_type'][$i],
                    'loan_amount' => $post['loan_amount'][$i],
                    'bank_name' => $post['bank_name'][$i],
                    'emi_amount' => $post['emi_amount'][$i],
                    'paid_emi' => $post['paid_emi'][$i],
                    'loan_id' => $inserted_id,
                'domain_id' => $user_data['domain_id'],
                );

                $insert2 = $this->Dashboard_Model->common_insert($lead, 'new_leads');
            }

            for ($i = 0; $i < count($post['attachment']); $i++) {
                if ($_FILES["image"]["size"][$i] > 0) {
                    $tmpFilePath = $_FILES['image']['tmp_name'][$i];
                    $fileinfo = @getimagesize($_FILES["image"]["tmp_name"][$i]);
                    $image_file_type = pathinfo($_FILES["image"]["name"][$i], PATHINFO_EXTENSION);
                    $newFilePath = 'upload/assets/images/' . time() . '.' . $image_file_type;

                    if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                        $post['image'][$i] = $newFilePath;
                    }
                }

                $file = array(
                    'attachment' => $post['attachment'][$i],
                    'login_which_bank' => $post['login_which_bank'][$i],
                    'image' => isset($post['image'][$i]) ? $post['image'][$i] : '',
                    'password' => $post['password'][$i],
                    'loan_id' => $inserted_id,
                    'domain_id' => $user_data['domain_id'],
                );

                $insert2 = $this->Dashboard_Model->common_insert($file, 'lead_document');
            }

            if ($insert) {
                // $this->session->set_flashdata('success', 'Request sent successfully. Lead ID - ' . (10001 + $inserted_id));
                // $this->session->set_flashdata('success', 'Request sent successfully. Lead ID - ' . (10001 + $inserted_id));
                redirect($domain->url);
            } else {
                $this->session->set_flashdata('error', 'Something Went Wrong, try again!!');
                redirect($domain->url);
            }

        } else {
            $data['cities'] = $this->Dashboard_Model->cities_data();
            $data['states'] = $this->Dashboard_Model->state_data();
            $data['bank_data'] = $this->Dashboard_Model->bank_list();
            $data['banker'] = $this->Dashboard_Model->loan_list();
            $this->load->view('admin/template/shareheader');
            $this->load->view('admin/loan/share_pl', $data);
            $this->load->view('admin/template/footer');
        }

    }

    public function getCity()
    {
        $cities = $this->db->where(array('state_id' => $this->input->post('id')))->get('cities')->result_array();
        $show = '';

        $city = $this->input->post('city');

        if (!empty($cities)) {
            foreach ($cities as $key => $value) {
                if ($city == $value['id']) {
                    $a = 'selected';
                } else {
                    $a = '';
                }
                $show .= '<option ' . $a . ' value="' . $value['id'] . '" data-id="' . $value['city'] . '">' . $value['city'] . '</option>';
            }}
        echo $show;
    }

    public function businessloan_insert()
    {

        if ($this->input->post()) {

            $post = $this->input->post();
            // echo '<pre>';
            // print_r($post);die;

            if (!empty($_GET['user_id'])) {
                $type = $_GET['user_id'];
            } else {
                $type = '';
            }

            $data = array(
                'loan_amount_req' => $post['loan_amount_req'],
                'client_name' => $post['client_name'],
                'clientnumber' => $post['clientnumber'],
                'email' => $post['email'],
                'business_type' => $post['business_type'],
                'nature_of_business' => $post['nature_of_business'],
                'annual_turnover' => $post['annual_turnover'],
                'business_age' => $post['business_age'],
                'business_registration_proof' => $post['business_registration_proof'],
                'how_many_year_itr_available' => $post['how_many_year_itr_available'],
                'state' => $post['state_name'],
                'city' => $post['city'],
                'pin_code' => $post['pin_code'],
                'remark' => $post['remark'],
                'marital_status' => $post['marital_status'],
                'spouse_house' => $post['spouse_house'],
                'mother_name' => $post['mother_name'],
                'alt_number' => $post['alt_number'],
                'residence_type' => $post['residence_type'],
                'residential_address' => $post['residential_address'],
                'company_name' => $post['company_name'],
                'company_address' => $post['company_address'],
                'business_premises' => $post['business_premises'],
                'apply_for_loan' => $post['apply_for_loan'],
                'user_id' => $type,
                'ref_name1' => $post['ref_name1'],
                'ref_mobile1' => $post['ref_mobile1'],
                'ref_relation1' => $post['ref_relation1'],
                'ref_name2' => $post['ref_name2'],
                'ref_mobile2' => $post['ref_mobile2'],
                'ref_relation2' => $post['ref_relation2'],
                'domain_id' => domain_id_get(),
                'role' =>  $this->session->userdata('role'),
            );

            $insert = $this->Dashboard_Model->common_insert($data, 'loan_master');
            $inserted_id = $this->db->insert_id();

            for ($i = 0; $i < count($post['loan_type']); $i++) {
                $lead = array(
                    'loan_type' => $post['loan_type'][$i],
                    'loan_amount' => $post['loan_amount'][$i],
                    'bank_name' => $post['bank_name'][$i],
                    'emi_amount' => $post['emi_amount'][$i],
                    'paid_emi' => $post['paid_emi'][$i],
                    'loan_id' => $inserted_id,
                );

                $insert2 = $this->Dashboard_Model->common_insert($lead, 'new_leads');
            }

            for ($i = 0; $i < count($post['attachment']); $i++) {
                if ($_FILES["image"]["size"][$i] > 0) {
                    $tmpFilePath = $_FILES['image']['tmp_name'][$i];
                    $fileinfo = @getimagesize($_FILES["image"]["tmp_name"][$i]);
                    $image_file_type = pathinfo($_FILES["image"]["name"][$i], PATHINFO_EXTENSION);
                    $newFilePath = 'upload/assets/images/' . time() . '.' . $image_file_type;

                    if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                        $post['image'][$i] = $newFilePath;
                    }
                }

                $file = array(
                    'attachment' => $post['attachment'][$i],
                    'login_which_bank' => $post['login_which_bank'][$i],
                    'image' => isset($post['image'][$i]) ? $post['image'][$i] : '',
                    'password' => $post['password'][$i],
                    'loan_id' => $inserted_id,
                );

                $insert2 = $this->Dashboard_Model->common_insert($file, 'lead_document');
            }

            if ($insert) {
                // $this->session->set_flashdata('success', 'Request sent successfully. Lead ID - ' . (10001 + $inserted_id));
                 $base = base_url();
                $baseWithoutBeta = str_replace('/beta', '', $base);
                redirect($baseWithoutBeta);
            } else {
                $this->session->set_flashdata('error', 'Something Went Wrong, try again!!');
                 $base = base_url();
                $baseWithoutBeta = str_replace('/beta', '', $base);
                redirect($baseWithoutBeta);
            }

        } else {
            $data['cities'] = $this->Dashboard_Model->cities_data();
            $data['states'] = $this->Dashboard_Model->state_data();
            $data['bank_data'] = $this->Dashboard_Model->bank_list();
            $data['banker'] = $this->Dashboard_Model->loan_list();
            $this->load->view('admin/template/shareheader');
            $this->load->view('admin/loan/share_bl', $data);
            $this->load->view('admin/template/footer');

        }
    }

    public function addNetworkMember()
    {
        $this->load->view('admin/template/shareheader');
        $this->load->view('admin/my-network-share/add');
        $this->load->view('admin/template/footer');
    }

    public function sendNetworkOtp()
    {

        $this->form_validation->set_rules('useremail', 'Email', 'required');
        $this->form_validation->set_rules('username', 'Name', 'required|trim');
        $this->form_validation->set_rules('usermobile', 'Mobile', 'required|trim');
        $this->form_validation->set_rules('city', 'Mobile', 'required|trim');
        $this->form_validation->set_rules('address', 'Mobile', 'required|trim');
        $this->form_validation->set_rules('pin_code', 'Mobile', 'required|trim');
        $this->form_validation->set_rules('domain_id', 'Mobile', 'required|trim');

        // $this->form_validation->set_rules('mobile','Mobile','required|trim');
        // $this->form_validation->set_rules('user_type','User Type','required|trim');

        $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');

        if ($this->form_validation->run() == false) {
            $this->load->view('admin/template/shareheader');
            $this->load->view('admin/my-team/add');
            $this->load->view('admin/template/footer');

        } else {

            $email = $this->security->xss_clean($this->input->post('useremail'));
            $name = $this->security->xss_clean($this->input->post('username'));
            $mobile = $this->security->xss_clean($this->input->post('usermobile'));
            $city = $this->security->xss_clean($this->input->post('city'));
            $address = $this->security->xss_clean($this->input->post('address'));
            $pin_code = $this->security->xss_clean($this->input->post('pin_code'));
            $domain_id = $this->security->xss_clean($this->input->post('domain_id'));
            // $role = $this->security->xss_clean($this->input->post('user_type'));
            $role = 'agent';
            
            if ($this->emailValidation($email, $role)) {
                
                $email_config = $this->db->where('domain_id', $domain_id)->get('email_config')->row_array();
                $admin_name = $this->db->where('domain_id', $domain_id)->get('contect_us')->row_array();
                $domain = $this->db->where('id', $domain_id)->get('domains')->row_array();
                // echo "<pre>";print_r($domain);die;


                $n = 4;
                $newOtp = $this->generateNumericOTP($n);
                $to = $email;
                $subject = "Registration OTP";
                $message = "Please verify your account in  " . (!empty($admin_name['company_title']) ? $admin_name['company_title'] : '') . ". Your otp is:<strong>" . $newOtp . "</strong>";
                $message .= "\nDo not share with anyone. This OTP will expire after 10 minutes.";
               $header = "From:". (!empty($email_config['from_email']) ? $email_config['from_email'] : '') . " \r\n";
                $header .= "MIME-Version: 1.0\r\n";
                $header .= "Content-type: text/html\r\n";
                //$retval = mail ($to,$subject,$message,$header);

                $sms_message = "Your%20OTP%20is%20" . $newOtp . "%20for%20Instant%20Loans%20Deals.%20Do%20not%20share%20to%20Others.%20More%20details:%20https://www.instantloansdeals.com%20EXELORA%20CONSULTANCY";
                // $this->send_mail($email,$subject,$message );
                if($domain['social_status'] == 'sms') { $this->send_sms($mobile, $sms_message);}else{$this->send_mail($to, $subject, $message);}

                $data['title'] = 'otp';
                $data['keywords'] = 'otp,page,test';
                $data['description'] = 'this is otp page';
                $data['otp'] = $newOtp;
                $data['email'] = $email;
                $data['mobile'] = $mobile;
                $data['name'] = $name;
                $data['city'] = $city;
                $data['address'] = $address;
                $data['pin_code'] = $pin_code;
                $data['user_type'] = $role;
                $data['domain_id'] = $domain_id;
                $data['otp_channel'] = ($domain['social_status'] == 'sms') ? 'sms' : 'email';

                //         $this->load->view('Page/template/header',$data);
                //         $this->load->view('Page/otp_page',$data);
                //         $this->load->view('Page/template/footer',$data);

                $this->load->view('admin/template/shareheader', $data);
                $this->load->view('admin/my-network-share/otp_page', $data);
                $this->load->view('admin/template/footer', $data);
            } else {
                $this->session->set_flashdata('message', 'Oh!, Email is already exist! Please try another Email.');
                redirect('admin/add-network-member-share?type=' . $_GET['type']);

            }

        }
    }

    public function createNetworkMember()
    {

        if (!empty($_GET['type'])) {
            $type = $_GET['type'];
        } else {
            $type = '';
        }
        
        if (!empty($_GET['role'])) {
            $parent_role = $_GET['role'];
        } else {
            $parent_role = '';
        }

        $email = $this->input->post('email');
        $name = $this->input->post('name');
        $mobile = $this->input->post('mobile');
        $city = $this->input->post('city');
        $address = $this->input->post('address');
        $pin_code = $this->input->post('pin_code');
        $status = $this->input->post('status');
        $domain_id = $this->input->post('domain_id');
        $role = 'agent';

        $pass = $this->randomPassword();

        ////********* send email to customer / agent********************** //
        
                //$message = "Instant Loans Deal";
                //$message .= "<h1>Registration OTP is: </h1>".$newOtp;

        $email_config = $this->db->where('domain_id', $domain_id)->get('email_config')->row_array();
        // print_r( $email_config);die;
        $admin_name = $this->db->where('domain_id', $domain_id)->get('contect_us')->row_array();
        $domain = $this->db->where('id', $domain_id)->get('domains')->row_array();

        $to = $email;
        $subject = (!empty($admin_name['company_title']) ? $admin_name['company_title'] : '') . " User";
        $message = "You are successfully registrated to " . (!empty($admin_name['company_title']) ? $admin_name['company_title'] : '') . ". Your Password is:<strong>" . $pass . "</strong>";
        $message .= "\nDo not share with anyone. This Password is confidentially.";

       $header = "From:". (!empty($email_config['from_email']) ? $email_config['from_email'] : '') . " \r\n";
        $header .= "MIME-Version: 1.0\r\n";
        $header .= "Content-type: text/html\r\n";

        $email_data = array(
            'mobile' => $mobile,
            'message' => "Dear%20Customer,%20Welcome%20to%20Instant%20Loans%20Deals%20Your%20Password%20is%20" . $pass . "%20More%20details:%20https://www.instantloansdeals.com%20EXELORA%20CONSULTANCY",
        );

        $exist = $this->db->order_by('id', 'DESC')->get('user_master')->row_array();
        if (empty($exist)) {
            $code = 'Member-0000';
        } else {
            $code = 'Member-000' . $exist['id'];
        }

        if($domain['social_status'] == 'sms') { $this->send_sms($email_data['mobile'], $email_data['message']);}else{$this->send_mail($to, $subject, $message);}

        // $this->send_sms($email_data['mobile'], $email_data['message']);
        ////********* send email to customer / agent********************** //
        $unpaid_email = 'Unpaid--' . $email;

        $insertData = ['username' => $name,
            'name' => $name,
            //'email'      => $email,
            'email' => $unpaid_email,
            'password' => MD5($pass),
            'mobile_no' => $mobile,
            'city' => $city,
            'address' => $address,
            'pin_code' => $pin_code,
            'parent_id' => $type,
            'parent_id_role' => $parent_role,
            'pass_text' => $pass,
            'domain_id' => $domain_id,
            'subscription' => 'pending',
            'role' => 2,
            'status' => 2,
            'code' => $code,
        ];

        $reg = $this->Dashboard_Model->insertTeamData($insertData, 'user_master');
        $insertData['user_type'] = 'agent';
        $insertData['pass'] = $pass;

        $insertData['email'] = $email;
        $insertData['email_data'] = $email_data;

        //$this->session->set_userdata('email_data',$email_data);// For email after payment.
        if ($reg) {

            $insertData['uid'] = $reg;

            $this->session->set_userdata('network_member_data', $insertData);

            $data['status'] = 'true';
            echo json_encode($data);die;
        } else {
            $data['status'] = 'false';
            echo json_encode($data);die;
        }
    }

    public function networkMemberOffer()
    {

        // $data['data'] = $this->Dashboard_Model->plan_detail(2);

         $data['data'] = $this->db->where(['status'=> '1','domain_id' => $this->session->userdata('network_member_data')['domain_id'],'plan_type'=> '4','user_id'=> $_GET['type']])->get('plan_tbl')->result();
        // print_r( $this->db->last_query() );die;
        if(empty($data['data'])){
            $data['data'] = $this->db->where(['status'=> '1','domain_id' => $this->session->userdata('network_member_data')['domain_id'],'plan_type'=> '2'])->get('plan_tbl')->result();
        }


        $data['title'] = 'Agent Payment Amount';
        $data['keywords'] = 'Agent payment,page,test';
        $data['description'] = 'this is Agent Payment page';

        $this->load->view('admin/template/shareheader', $data);
        $this->load->view('admin/my-network-share/agent-offer', $data);
        $this->load->view('admin/template/footer', $data);
    }

    public function networkMemberPayment()
    {
   
        $networkMemberData = $this->session->userdata('network_member_data');
        $uid = $networkMemberData['uid'];
        $role = $networkMemberData['user_type'];
        $email = $networkMemberData['email'];
        $mobile = $networkMemberData['mobile_no'];
        $plan = $this->input->post('plan');

        if ( $plan == 'Silver') {
        $arr =  $this->db->where(['status'=> 1 ,'domain_id' => $this->input->post('domain_id'),'plan_name'=>$plan ,'plan_type'=> 4,'user_id'=> $_GET['type']])->get('plan_tbl')->row_array();
        if (empty($arr)) {
            $arr =  $this->db->where(['status'=> 1 ,'domain_id' => $this->input->post('domain_id'),'plan_name'=>$plan ,'plan_type'=> 2])->get('plan_tbl')->row_array();
        }
    }else{
            $arr =  $this->db->where(['status'=> 1 ,'domain_id' => $this->input->post('domain_id'),'plan2_name'=>$plan ,'plan_type'=> 4,'user_id'=> $_GET['type']])->get('plan_tbl')->row_array();
        if (empty($arr)) {
                $arr =  $this->db->where(['status'=> 1 ,'domain_id' => $this->input->post('domain_id'),'plan2_name'=>$plan ,'plan_type'=> 2])->get('plan_tbl')->row_array();
        }
    }

         if ($plan == 'platinum_free' || $plan == 'silver_free') {
            $updateData = [
            'subscription' => $plan,
            ];
            $updateStatus = $this->Dashboard_Model->update_data($uid, $updateData, 'user_master');
               redirect('admin/my-network-share?type'.$_GET['type'], 'refresh');
        }

        if (!$plan) {
            $this->session->set_flashdata('error', 'Plan is required.');
               redirect('admin/my-network-share?type'.$_GET['type'], 'refresh');
        }
        if (empty($arr)) {
            $this->session->set_flashdata('error', 'Invalid plan data.');
               redirect('admin/my-network-share?type'.$_GET['type'], 'refresh');
        }

        $array = json_decode(json_encode($arr), true);
        $amt = ($plan === "Silver") ? $array['amount'] : $array['amount2'];
        

        // Check for session data
        if (!$this->session->has_userdata('network_member_data')) {
               redirect('admin/my-network-share?type'.$_GET['type'], 'refresh');
        }

        $prefix = $this->generateNumericOTP(6);
        $updateData = [
            'subscription' => $plan,
            'plan_id' => $arr['id'],
            'plan_amount' =>  $amt,
        ];

        $updateStatus = $this->Dashboard_Model->update_data($uid, $updateData, 'user_master');

        if ($updateStatus) {
            $data = [
                'uid' => $uid,
                'user_type' => $role,
                'email' => $email,
                'mobile' => $mobile,
                'plan' => $plan,
                'amt' => $amt,
                'domain_id' => $this->input->post('domain_id'), 
            ];
            $this->load->view('admin/paymentpage', $data);
        } else {
            $this->session->set_flashdata('error', 'Failed to update subscription.');
               redirect('admin/my-network-share?type'.$_GET['type'], 'refresh');
        }   
    }


    public function paymentResponse()
    {
        // PhonePe PG Start
        $txtId = $this->input->get('txtId');

        if (empty($txtId)) {
            redirect('admin/my-network-share?type='.$_GET['type'], 'refresh');
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
                'entity' => 'payment',
                'currency' => 'INR',
                'method' => $mode,
                'payment_date' => date("Y-m-d"),
                'status' => $status,

            ];

            $paidStatus = $this->Dashboard_Model->update_transaction($txtId, $updateData, 'tbl_transection');
            $this->setfinaluserdata($txtId);
            $this->session->unset_userdata('network_member_data');

        } else {
            $status = 0;
        }

        $base = base_url();
        $baseWithoutBeta = str_replace('/beta', '', $base);
        redirect($baseWithoutBeta);

    }

     public function setfinaluserdata($txtId)
    {
        $transaction_data = $this->Dashboard_Model->get_transaction_data($txtId, 'tbl_transection');
        if (isset($transaction_data->uid)) {
            $uid = $transaction_data->uid;
            $role = $transaction_data->role;
            $json_data = json_decode($transaction_data->pass_json);
            if ($role == 'user') {
                $dbName = 'registerUser';
            } else {
                $dbName = 'user_master';
            }
            $unpaid_user_data = $this->Dashboard_Model->get_unpaid_user_data($uid, $dbName);
            $Updatedata['email'] = explode('--', $unpaid_user_data->email)[1];
            $Updatedata['status'] = 1;
            $this->Dashboard_Model->update_data($uid, $Updatedata, $dbName);
            $domain = $this->db->where('id', domain_id_get())->get('domains')->row_array();
            if($domain['social_status'] == 'sms') { $this->send_sms($json_data->mobile, $json_data->message);}else{$this->send_mail($unpaid_user_data->email, 'Payment', $json_data->message);}
        }
    }


    public function emailValidation($emailData, $type)
    {

        $checkStatus = $this->Dashboard_Model->check_emailId($emailData, $type);

        if ($checkStatus) {
            return false;
        } else {
            return true;
        }

    }

    public function generateNumericOTP($n)
    {
        // Take a generator string which consist of
        // all numeric digits
        $generator = "1357902468";
        $result = "";
        for ($i = 1; $i <= $n; $i++) {
            $result .= substr($generator, (rand() % (strlen($generator))), 1);
        }
        return $result;
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




      public function myTeam()
    {

        $role = $this->session->userdata('role');
        $uid = $this->session->userdata('user_id');

        $teamData = $this->Dashboard_Model->getTeamData($uid);

        $all['datas'] = $teamData;
        $all['role'] = $role;

        $this->load->view('admin/template/shareheader');
        $this->load->view('admin/my-team-share/view', $all);
        $this->load->view('admin/template/footer');
    }


      public function addTeamMember()
    {
       
        $this->load->view('admin/template/shareheader');
        $this->load->view('admin/my-team-share/add');
        $this->load->view('admin/template/footer');
    }


    public function createTeamMember()
    {
        $email = $this->input->post('email');
        $name = $this->input->post('name');
        $mobile = $this->input->post('mobile');
        $city = $this->input->post('city');
        $address = $this->input->post('address');
        $pin_code = $this->input->post('pin_code');
        $status = $this->input->post('status');
        $domain_id = $this->input->post('domain_id');
        $role = 'agent';

        $pass = $this->randomPassword();
        $domain = $this->db->where('id', $domain_id)->get('domains')->row_array();
        

        ////********* send email to customer / agent********************** //
        $to = $email;
        $subject = (!empty($admin_name['company_title']) ? $admin_name['company_title'] : '') . " User";
        $message = "You are successfully registrated to " . (!empty($admin_name['company_title']) ? $admin_name['company_title'] : '') . ". Your Password is:<strong>" . $pass . "</strong>";
        $message .= "\nDo not share with anyone. This Password is confidentially.";
        $header = "From:". (!empty($email_config['from_email']) ? $email_config['from_email'] : '') . " \r\n";
        $header .= "MIME-Version: 1.0\r\n";
        $header .= "Content-type: text/html\r\n";
        $email_data = array(
            'mobile' => $mobile,
            'message' => "Dear%20Customer,%20Welcome%20to%20Instant%20Loans%20Deals%20Your%20Password%20is%20" . $pass . "%20More%20details:%20https://www.instantloansdeals.com%20EXELORA%20CONSULTANCY",
        );
       

        if($domain['social_status'] == 'sms') { $this->send_sms($email_data['mobile'], $email_data['message']);}else{$this->send_mail($to, $subject, $message);}
    



        $this->send_sms($email_data['mobile'], $email_data['message']);
        ////********* send email to customer / agent********************** //
        $exist = $this->db->order_by('id', 'DESC')->get('user_master')->row_array();
        if (empty($exist)) {
            $code = 'Team-0000';
        } else {
            $code = 'Team-000' . $exist['id'];
        }

        $insertData = ['username' => $name,
            'name' => $name,
            'email' => $email,
            'password' => MD5($pass),
            'mobile_no' => $mobile,
            'city' => $city,
            'address' => $address,
            'pin_code' => $pin_code,
            'parent_id' =>$_GET['type'],
            'parent_id_role' => $_GET['role'],
            'pass_text' => $pass,
            'role' => 2,
            'status' => $status,
            'code' => $code,
            'domain_id' => $domain_id,
        ];

        $reg = $this->Dashboard_Model->insertTeamData($insertData, 'user_master');
        $insertData['user_type'] = 'agent';
        $insertData['pass'] = $pass;

        //$this->session->set_userdata('email_data',$email_data);// For email after payment.
        if ($reg) {

            $insertData['uid'] = $reg;
            //$this->session->set_userdata($insertData);
            $data['status'] = 'true';
            echo json_encode($data);die;
        } else {
            $data['status'] = 'false';
            echo json_encode($data);die;
        }
    }

    public function sendotp()
    {

        $this->form_validation->set_rules('useremail', 'Email', 'required');
        $this->form_validation->set_rules('username', 'Name', 'required|trim');
        $this->form_validation->set_rules('usermobile', 'Mobile', 'required|trim');
        $this->form_validation->set_rules('city', 'Mobile', 'required|trim');
        $this->form_validation->set_rules('address', 'Mobile', 'required|trim');
        $this->form_validation->set_rules('pin_code', 'Mobile', 'required|trim');
        // $this->form_validation->set_rules('mobile','Mobile','required|trim');
        // $this->form_validation->set_rules('user_type','User Type','required|trim');

        $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');

        if ($this->form_validation->run() == false) {
            $this->load->view('admin/template/shareheader');
            $this->load->view('admin/my-team/add');
            $this->load->view('admin/template/footer');

        } else {

            $email = $this->security->xss_clean($this->input->post('useremail'));
            $name = $this->security->xss_clean($this->input->post('username'));
            $mobile = $this->security->xss_clean($this->input->post('usermobile'));
            $city = $this->security->xss_clean($this->input->post('city'));
            $address = $this->security->xss_clean($this->input->post('address'));
            $pin_code = $this->security->xss_clean($this->input->post('pin_code'));
            $domain_id = $this->security->xss_clean($this->input->post('domain_id'));
            // $role = $this->security->xss_clean($this->input->post('user_type'));
            $role = 'agent';

            if ($this->emailValidation($email, $role)) {
                $email_config = $this->db->where('domain_id', $domain_id)->get('email_config')->row_array();
                $admin_name = $this->db->where('domain_id', $domain_id)->get('contect_us')->row_array();
                $domain = $this->db->where('id', $domain_id)->get('domains')->row_array();


                $n = 4;
                $newOtp = $this->generateNumericOTP($n);
                $to = $email;
                $subject = "Registration OTP";
                $message = "Please verify your account in  " . (!empty($admin_name['company_title']) ? $admin_name['company_title'] : '') . ". Your otp is:<strong>" . $newOtp . "</strong>";
                $message .= "\nDo not share with anyone. This OTP will expire after 10 minutes.";
               $header = "From:". (!empty($email_config['from_email']) ? $email_config['from_email'] : '') . " \r\n";
                $header .= "MIME-Version: 1.0\r\n";
                $header .= "Content-type: text/html\r\n";
                //$retval = mail ($to,$subject,$message,$header);

                $sms_message = "Your%20OTP%20is%20" . $newOtp . "%20for%20Instant%20Loans%20Deals.%20Do%20not%20share%20to%20Others.%20More%20details:%20https://www.instantloansdeals.com%20EXELORA%20CONSULTANCY";
                // $this->send_mail($email,$subject,$message );
                if($domain['social_status'] == 'sms') { $this->send_sms($mobile, $sms_message);}else{$this->send_mail($to, $subject, $message);}

                // $subject = "Registration OTP";
                // $message = "Please verify your mobile no in Instant loans deals. Your otp is:<strong>" . $newOtp . "</strong>";
                // $message .= "\nDo not share with anyone. This OTP will expire after 10 minutes.";
                // $header = 'From:admin@instantloansdeals.com' . "\r\n";
                // $header .= "MIME-Version: 1.0\r\n";
                // $header .= "Content-type: text/html\r\n";
                
                // $sms_message = "Your%20OTP%20is%20" . $newOtp . "%20for%20Instant%20Loans%20Deals.%20Do%20not%20share%20to%20Others.%20More%20details:%20https://www.instantloansdeals.com%20EXELORA%20CONSULTANCY";
                // $this->send_sms($mobile, $sms_message);
                


                $data['title'] = 'otp';
                $data['keywords'] = 'otp,page,test';
                $data['description'] = 'this is otp page';
                $data['otp'] = $newOtp;
                $data['email'] = $email;
                $data['mobile'] = $mobile;
                $data['name'] = $name;
                $data['city'] = $city;
                $data['address'] = $address;
                $data['pin_code'] = $pin_code;
                $data['domain_id'] = $domain_id;
                $data['user_type'] = $role;
                $data['otp_channel'] = ($domain['social_status'] == 'sms') ? 'sms' : 'email';

                //         $this->load->view('Page/template/header',$data);
                //         $this->load->view('Page/otp_page',$data);
                //         $this->load->view('Page/template/footer',$data);

                $this->load->view('admin/template/shareheader', $data);
                $this->load->view('admin/my-team/otp_page', $data);
                $this->load->view('admin/template/footer', $data);
            } else {
                $this->session->set_flashdata('message', 'Oh!, Email is already exist! Please try another Email.');
                  $base = base_url();
                $baseWithoutBeta = str_replace('/beta', '', $base);
                redirect($baseWithoutBeta);

            }

        }
    }

      public function send_mail($email, $subject, $message)
{
    $ci =& get_instance();
    $ci->load->database();
    $ci->load->library('email');

    $domain_id = domain_id_get();

    if (!$domain_id) {
        log_message('error', 'Domain not found in domains table');
        return false;
    }

    $config_row = $ci->db
        ->where('domain_id', $domain_id)
        ->get('email_config')
        ->row_array();

    if (!$config_row) {
        log_message('error', 'Email configuration not found for domain_id: ' . $domain_id);
        return false;
    }

    // Sanitize and validate recipient
    $email = trim($email);
    if (stripos($email, 'Unpaid--') === 0 || stripos($email, 'Deleted--') === 0) {
        $parts = explode('--', $email, 2);
        $email = isset($parts[1]) ? trim($parts[1]) : '';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        log_message('error', 'Invalid recipient email after sanitization: ' . print_r($email, true));
        return false;
    }

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
    $ci->email->to($email);
    $ci->email->subject($subject);
    $ci->email->message($message);

    if ($ci->email->send()) {
        log_message('info', 'Email successfully sent to: ' . $email);
        return true;
    } else {
        $error = $ci->email->print_debugger(['headers']);
        log_message('error', 'Email failed to send. Error: ' . $error);
        return false;
    }
}

public function processAgreement()
{
    // Load form validation library
    $this->load->library('form_validation');
    $this->form_validation->set_rules('agreement_id', 'Agreement ID', 'required');
    $this->form_validation->set_rules('user_id', 'User ID', 'required|numeric');
    $this->form_validation->set_rules('role', 'User Role', 'required|numeric');

    if ($this->form_validation->run() === FALSE) {
        $this->session->set_flashdata('error', validation_errors());
        redirect('admin/agreement');
        return;
    }

    $post = $this->input->post();
    $signature_path = '';
    
    if ($_FILES['signature']['name'] != "") {
        $config['upload_path'] = './upload/assets/images/';
        $config['max_size'] = 1024;
        $config['allowed_types'] = 'jpg|jpeg|png';
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if ($this->upload->do_upload('signature')) {
            $uploadImg = $this->upload->data();
            $signature_path = $uploadImg['file_name'];
        } else {
            $ierror = $this->upload->display_errors();
            $this->session->set_flashdata('imgerror', $ierror);
            redirect('admin/agreement', 'refresh');
        }
    }

    // Prepare data
    $data = [
        'agreement_id' => $post['agreement_id'],
        'signature' => $signature_path ?? '',
        'agreement_date' => date('Y-m-d H:i:s'),
        'agreement_status' => 'pending'
    ];

    // Determine table and where condition
    $table = ($post['role'] == 3) ? 'branch_franchise' : 'user_master';
    $where = $post['user_id'];

    // Update record
    if ($this->Dashboard_Model->common_update($where, $data, $table)) {
        $this->session->set_flashdata('success', 'Agreement processed successfully');
    } else {
        // Delete uploaded file if update fails
        @unlink($config['upload_path'] . $signature_path);
        $error = $this->db->error();
        $this->session->set_flashdata('error', 'Failed to process agreement. Please try again.');
    }
    
    redirect('admin/agreement');
}


}
