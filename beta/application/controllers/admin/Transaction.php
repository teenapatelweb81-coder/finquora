<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction extends CI_Controller {
	
	function __construct()
	{
        parent::__construct();
        $this->load->library('session');
        $this->load->model('admin/Dashboard_Model');
    }
	
public function transaction()
{
    if (!has_permission('Payment History') && $this->session->userdata('type') != 'admin') {
        $this->session->set_flashdata('message', 'You do not have permission to access this section.');
        redirect('admin-dashboard');
        return;
        }

        // if ($this->session->userdata('type') == 'admin') { 
            // $query = $this->db->get('tbl_transection');
        // }else {
            $query = $this->db->where('domain_id', domain_id_get())->get('tbl_transection');
        // }
    $data = $query->result_array(); 
    // echo '<pre>';print_r($data );die;
    
    // Pass the data to the view
    $this->load->view('admin/template/header');
    $this->load->view('admin/transaction', ['datas' => $data]);
    $this->load->view('admin/template/footer');
}

  
   
}    