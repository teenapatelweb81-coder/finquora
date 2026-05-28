<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Branches extends CI_Controller {
    
     public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->model('admin/Dashboard_Model');
        $this->load->model('admin/Branch_model');
        $this->load->model('admin/User_model','A');
        $this->load->library('upload');
        date_default_timezone_set('Asia/Kolkata');
        $this->checkDomainAccess();
        $this->logged_in();
        $user_id = $this->session->userdata('user_id');
        $role = $this->session->userdata('role');
      
        $current_url = uri_string();
        if ($current_url == 'admin/agreement') return;
        if ($user_id) {

            if ($role == 3) { // Branch Franchise
                $user = $this->db->get_where('branch_franchise', [
                    'id' => $user_id
                ])->row();

                if (!$user || $user->agreement_status != 'approved' || empty($user->signature)) {
                    redirect('admin/agreement');
                }

            } elseif ($role == 2) { // Master User
                $user = $this->db->get_where('user_master', [
                    'id' => $user_id
                ])->row();

                if (!$user || $user->agreement_status != 'approved' || empty($user->signature)) {
                    redirect('admin/agreement');
                }
            }
        }
        
    }
     private function logged_in()
    {
        if (!$this->session->userdata('authenticated')) {
            redirect('desk-login');

        }
    }

    private function checkDomainAccess()
    {
        $currentDomain = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http")
                        . "://" . $_SERVER['HTTP_HOST'] . '/';

        $domainData = $this->db->where('url', $currentDomain)->get('domains')->row();

        if (!$domainData || $domainData->status != 1) {
            redirect('admin/access-denied');
            exit;
        }
    }
    
    public function index()
    {
        if ((has_permission('Pages') && has_permission('branch-location') && has_permission('Admin settings') || $this->session->userdata('type') == 'admin')) {
            $data['title'] = 'Branch manage';
            $data['branches'] = $this->Branch_model->get_branches();
            $domain_id = domain_id_get();
            if (isset($_GET['domain_id']) && (int)$_GET['domain_id']) {
                $data['heading'] = $this->Dashboard_Model->common_rows('branch-location','settings', $_GET['domain_id']);  
            }else {
                $data['heading'] = $this->Dashboard_Model->common_rows('branch-location','settings', $domain_id);  
            }
            $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
            $this->load->view('admin/template/header');
            $this->load->view('admin/branches/index', $data);
            $this->load->view('admin/template/footer');
        }else{
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            
        }
    }

   
    public function add()
    {
        if ((has_permission('Pages') && has_permission('branch-location') && has_permission('Admin settings') || $this->session->userdata('type') == 'admin')) {
            $this->form_validation->set_rules('branch_name', 'Branch Name', 'required');
            $this->form_validation->set_rules('contact_person', 'Contact Person', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('mobile', 'Mobile', 'required');
            $this->form_validation->set_rules('address', 'Address', 'required');
            $this->form_validation->set_rules('city', 'City', 'required');
            $this->form_validation->set_rules('state', 'State', 'required');
            $this->form_validation->set_rules('pincode', 'Pincode', 'required');
            $this->form_validation->set_rules('branch_date', 'Date', 'required');
            $this->form_validation->set_rules('short_description', 'Short Description', 'required|max_length[200]');
            
            if ($this->form_validation->run()) {
                
                $data =  $this->input->post();
                if ($_FILES['branch_image']['name'] != "") {
                    $config['upload_path'] = './upload/assets/images/';
                    $config['allowed_types'] = 'jpg|jpeg|png|mp4|webm|avi|mov';
                    $config['max_size'] = 0; // 0 means no limit
                    $config['file_ext_tolower'] = true;
                    $config['encrypt_name'] = true; // Encrypt the filename for security
                    
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    if ($this->upload->do_upload('branch_image')) {
                        $uploadData = $this->upload->data();
                        $data['branch_image'] = $uploadData['file_name'];
                    } else {
                        $ierror = $this->upload->display_errors();
                        $this->session->set_flashdata('imgerror', $ierror);
                        redirect('admin/branch-location', 'refresh');
                    }
                }
                    $branch_data = [
                        'branch_name' => $data['branch_name'],
                        'contact_person' => $data['contact_person'],
                        'email' => $data['email'],
                        'mobile' => $data['mobile'],
                        'address' => $data['address'],
                        'city' => $data['city'],
                        'branch_image' => $data['branch_image'] ,
                        'state' => $data['state'],
                        'pincode' => $data['pincode'],
                        'country' => !empty($data['country']) ? $data['country'] : 'India',
                        'short_description' => $data['short_description'] ?? null,
                        'long_description' => $data['long_description'] ?? null,
                        'branch_date' => !empty($data['branch_date']) ? date('Y-m-d', strtotime($data['branch_date'])) : date('Y-m-d'),
                        'status' => isset($data['status']) ? 1 : 0,
                        'domain_id' => $data['domain_id'],
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ];

                $insert = $this->Dashboard_Model->common_insert($branch_data, 'branch_locations');

                if ($insert) {
                    $this->session->set_flashdata('success', 'Branch  Data Insert Successfully!!');
                    redirect('admin/branch-location');
                } else {
                    $this->session->set_flashdata('error', 'Something Went Wrong, try again!!');
                    redirect('admin/branch-location');
                }

            } else {
                $data['title'] = 'Add Branch';
                $data['domains'] =$this->db->where('status',1)->get('domains')->result_array();
                $this->load->view('admin/template/header');
                $this->load->view('admin/branches/add', $data);
                $this->load->view('admin/template/footer');
            }
        }else{
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
		
		}
    }

    public function edit($id)
    {
        if ((has_permission('Pages') && has_permission('branch-location') && has_permission('Admin settings') || $this->session->userdata('type') == 'admin')) {
            if (ctype_digit(strval($id))) {
                $data['title'] = 'Edit branch manage';
                $data['domains'] =$this->db->where('status',1)->get('domains')->result_array();
                $data['branch'] = $this->db->where('id',$id)->get('branch_locations')->row_array();
                $this->load->view('admin/template/header');
                $this->load->view('admin/branches/edit', $data);
                $this->load->view('admin/template/footer');

            } else {
                redirect('admin/branch-location');
            }
        }else{
		$this->session->set_flashdata('message', 'You do not have permission to access this section.');
		redirect('admin-dashboard');
		return;
		
		}
    }

    public function update()
    {
         if ((has_permission('Pages') && has_permission('branch-location') && has_permission('Admin settings') || $this->session->userdata('type') == 'admin')) {
        $data =  $this->input->post();
        $id =  $this->input->post('id');

            if (!empty($_FILES['branch_image']['name'])) {
                    $config['upload_path']   = './upload/assets/images/';
                    $config['allowed_types'] = 'jpg|jpeg|png|mp4|avi|mov|mkv|webm';
                    $config['max_size']      = 0; 
                    $config['encrypt_name']  = true;

                    $this->load->library('upload');
                    $this->upload->initialize($config);

                    if ($this->upload->do_upload('branch_image')) {
                        $uploadData = $this->upload->data();
                        $data['branch_image'] = $uploadData['file_name'];
                    } else {
                        echo $this->upload->display_errors();
                        exit;
                    }

                } else {
                    $data['branch_image'] = $this->input->post('old_img');
                }

           $branch_data = [
                    'branch_name' => $data['branch_name'],
                    'contact_person' => $data['contact_person'],
                    'email' => $data['email'],
                    'mobile' => $data['mobile'],
                    'address' => $data['address'],
                    'city' => $data['city'],
                    'branch_image' => $data['branch_image'] ,
                    'state' => $data['state'],
                    'pincode' => $data['pincode'],
                    'country' => !empty($data['country']) ? $data['country'] : 'India',
                    'short_description' => $data['short_description'] ?? null,
                    'long_description' => $data['long_description'] ?? null,
                    'branch_date' => !empty($data['branch_date']) ? date('Y-m-d', strtotime($data['branch_date'])) : date('Y-m-d'),
                    'status' => isset($data['status']) ? 1 : 0,
                    'domain_id' => $data['domain_id'],
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                //    print_r($branch_data);die;

            $update = $this->Dashboard_Model->common_update($id, $branch_data, 'branch_locations');

            if ($update) {
                $this->session->set_flashdata('success', 'Branch Data Update Successfully!!');
                redirect('admin/branch-location');
            } else {
                $this->session->set_flashdata('error', 'Something Went Wrong, try again!!');
                redirect('admin/branch-location');
            }
        }else{
		$this->session->set_flashdata('message', 'You do not have permission to access this section.');
		redirect('admin-dashboard');
		return;
		
		}
    }
    
    public function delete($id) {
         if ((has_permission('Pages') && has_permission('branch-location') && has_permission('Admin settings') || $this->session->userdata('type') == 'admin')) {
            $this->Branch_model->delete_branch($id);
            $this->session->set_flashdata('success', 'Branch deleted successfully');
            redirect('admin/branch-location');
        }else{
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
		}
    }
    
    public function status($id, $status) {
         if ((has_permission('Pages') && has_permission('branch-location') && has_permission('Admin settings') || $this->session->userdata('type') == 'admin')) {
            $this->Branch_model->update_status($id, $status);
            $status_text = $status == 1 ? 'activated' : 'deactivated';
            $this->session->set_flashdata('success', 'Branch ' . $status_text . ' successfully');
            redirect('admin/branch-location');
        }else{
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
		
		}
    }
}
