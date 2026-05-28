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
     // LOGIN ROUTE  REMOVE DESIGN CSS FROM PUBLIC/ASSETS
    //$route['desk-login'] = 'admin/Login';
    //$route['admin-dashboard'] = 'admin/Dashboard';
    
	public function index()
	{    
	    if($this->session->userdata('authenticated')) {
            redirect('admin/Dashboard');
         }
	    
	    $this->form_validation->set_rules('email','Email','required|trim|valid_email');
        $this->form_validation->set_rules('password','Password','required|trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">','</span>');
        
        if( $this->form_validation->run() == false) {
		   $this->load->view('admin/login');
        
	     } else {
	         
	          $email = $this->security->xss_clean($this->input->post('email'));
              $password = md5($this->security->xss_clean($this->input->post('password')));
              $user = $this->Login_Model->login_chk($email,$password);
                
             if($user) {

              $userData = [
                    'adminEmail'=> $user->email,
                    'authenticated' => TRUE,
                    'user_id'=> $user->id,
                    'username' => $user->username
                ];
                
                $this->session->set_userdata($userData);
                redirect('admin-dashboard');

             } else {
                $this->session->set_flashdata('message','Oh, Invalid Email or Password, try again!!');
                redirect('desk-login');
             }
	    }
   }
   
  public function logout()  
    {  
      $this->session->sess_destroy();  
      redirect('desk-login', 'refresh');
    }
}
?>