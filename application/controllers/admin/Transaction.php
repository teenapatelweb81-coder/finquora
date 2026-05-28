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
        // echo "gyggh";
        
        
         $domain_id =domain_id_get();
        $query = $this->db->where('domain_id',$domain_id)->get('tbl_transection');
        $data = $query->result_array();

        
        
        // $query=select * form('tbl_transection');
        
        // print_r($transactions);

       

    $this->load->view('x-admin/template/header');
    $this->load->view('transaction',$data);
    $this->load->view('x-admin/template/footer');
    }

    
  
   
}    