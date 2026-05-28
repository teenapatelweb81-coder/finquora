<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AboutUs extends CI_Controller {
	
	function __construct()
	{
        parent::__construct();
        $this->load->library('session');
        $this->load->model('admin/Dashboard_Model');
        $this->logged_in();
    }
	private function logged_in()
	{
        if (!$this->session->userdata('authenticated')) {
            redirect('desk-login');
        }
    }
    public function about()
    {
        $data['datas'] = $this->Dashboard_Model->common_all('aboutUs');
        $this->load->view('admin/template/header');
        $this->load->view('admin/aboutUs/view',$data);
        $this->load->view('admin/template/footer');
    }
    public function aboutForm(){}
    public function aboutEdit($id)
    {
        $data['datas'] = $this->Dashboard_Model->common_row($id,'aboutUs');
	    $this->load->view('admin/template/header');
        $this->load->view('admin/aboutUs/edit',$data);
        $this->load->view('admin/template/footer');
    }
    public function aboutUpdate()
    {
        $this->form_validation->set_rules('trainedProfessionals', 'Trained Professionals', 'required|trim');
	    $this->form_validation->set_rules('happyCustomer', 'Happy Customer', 'required|trim');
	    $this->form_validation->set_rules('cities', 'Cities', 'required|trim');
	    $this->form_validation->set_rules('countries', 'Countries', 'required|trim');
	    $this->form_validation->set_rules('firstData', 'first Data', 'required|trim');
	    $this->form_validation->set_rules('SecondData', 'Second Data', 'required|trim');
	    $this->form_validation->set_rules('status', 'Status', 'required|trim');
	    $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');
	    
	    $id = $this->input->post('id');
	    if($this->form_validation->run()) {
	   
	            $data['trainedProfessionals'] = $this->input->post('trainedProfessionals');
	            $data['happyCustomer'] = $this->input->post('happyCustomer');
	            $data['cities'] = $this->input->post('cities');
	            $data['countries'] = $this->input->post('countries');
	            $data['firstData'] = $this->input->post('firstData');
	            $data['SecondData'] = $this->input->post('SecondData'); 
	            $data['status']  = $this->input->post('status');
	            $data['updated_at']  = date('d m Y h:i:s');
	            
	               $update = $this->Dashboard_Model->common_update($id,$data,'aboutUs');
	            
    	            if($update) {
    	                $this->session->set_flashdata('success','About Us Data Update Successfully!!');
                        redirect('admin/about-us');
    	            } else {
    	                $this->session->set_flashdata('error','Something Went Wrong, try again!!');
                        redirect('admin/about-us');
    	            }
	        }else {
	               redirect("admin/edit-about-us/$id");
	           }   
    }
    public function aboutDelete(){}
    public function aboutStatusUpdate()
    {
        $id = $this->input->post('id');
	    $status = $this->input->post('status'); $data = ['status'=>$status];
	    $update = $this->Dashboard_Model->common_update($id,$data,'aboutUs');
	    echo $update;
    }
    
    
    
}    