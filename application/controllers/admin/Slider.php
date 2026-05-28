<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Slider extends CI_Controller {
	
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
    public function sliderForm()
    {    

	    $this->form_validation->set_rules('title', 'title', 'required|trim');
	    //$this->form_validation->set_rules('sub_title', 'Sub Title', 'required|trim');
	    $this->form_validation->set_rules('status', 'Status', 'required|trim');
	    $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');
	    $this->form_validation->set_rules('is_unique', 'The %s entered is already in use');
	    
	    if($this->form_validation->run()) {
	            
	            if($_FILES['slider_image']['name'] !="") {
    	         $config['upload_path'] = './public/assets/images/slider/'; 
    	         $config['max_size'] = 2448;
                 $config['allowed_types'] = 'jpg|jpeg|png'; 
    	         $this->load->library('upload',$config);
    	         $this->upload->initialize($config);
    	         
    	         if($this->upload->do_upload('slider_image')){
                   $uploadImg = $this->upload->data(); 
                   $data['slider_image'] = $uploadImg['file_name']; 
    	          }  else {
    	              $ierror = $this->upload->display_errors();
    	               $this->session->set_flashdata('imgerror',$ierror);
                       redirect('admin/add-slider','refresh');
    	          }
    	        }
    	      //  $data['slider_image'] = $uploadImg['file_name'];
    	        $data['title'] = $this->input->post('title'); 
	            $data['sub_title'] = $this->input->post('sub_title');
	            $data['status']  = $this->input->post('status');
	            $data['created_at']  = date('d m Y h:i:s'); 
	           
	            $insert = $this->Dashboard_Model->common_insert($data,'slider');
	            
    	            if($insert) {
    	                $this->session->set_flashdata('success','Slider Data Insert Successfully!!');
                        redirect('admin/add-slider');
    	            } else {
    	                $this->session->set_flashdata('error','Something Went Wrong, try again!!');
                        redirect('admin/add-slider');
    	            }
	        } else {
	            
	            $this->load->view('admin/template/header');
                $this->load->view('admin/slider/form');
                $this->load->view('admin/template/footer');   
	        }
    }
    public function slider()
    {    
         $data['datas'] = $this->Dashboard_Model->common_all('slider');
         $this->load->view('admin/template/header');
         $this->load->view('admin/slider/view',$data);
         $this->load->view('admin/template/footer');   
    }
    public function sliderEdit($id)
    {    
         $data['datas'] = $this->Dashboard_Model->common_row($id,'slider');
         $this->load->view('admin/template/header');
         $this->load->view('admin/slider/edit',$data);
         $this->load->view('admin/template/footer');   
    }
    public function sliderUpdate()
    {
	    $this->form_validation->set_rules('title', 'title', 'required|trim');
	    //$this->form_validation->set_rules('sub_title', 'Sub Title', 'required|trim');
	    $this->form_validation->set_rules('status', 'Status', 'required|trim');
	    $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');
	   
	    if($this->form_validation->run()) {
	            
	            if($_FILES['slider_image']['name'] !="") {
    	         $config['upload_path'] = './upload/assets/images/slider/'; 
    	         $config['max_size'] = 2448;
                 $config['allowed_types'] = 'jpg|jpeg|png'; 
    	         $this->load->library('upload',$config);
    	         $this->upload->initialize($config);
    	         
    	         if($this->upload->do_upload('slider_image')){
                   $uploadImg = $this->upload->data(); 
                   $data['slider_image'] = $uploadImg['file_name']; 
    	          }  else {
    	               $ierror = $this->upload->display_errors();
    	               $this->session->set_flashdata('imgerror',$ierror);
                       redirect('admin/add-slider','refresh');
    	          }
    	        } else { $data['slider_image'] = $this->input->post('old_img'); }
    	        
    	        $id = $this->input->post('id');
    	        $data['title'] = $this->input->post('title'); 
	            $data['sub_title'] = $this->input->post('sub_title');
	            $data['status']  = $this->input->post('status');
	            $data['created_at']  = date('d m Y h:i:s'); 
	           
	            $update = $this->Dashboard_Model->common_update($id,$data,'slider');
	            
    	            if($update) {
    	                $this->session->set_flashdata('success','Slider Data update Successfully!!');
                        redirect('admin/slider');
    	            } else {
    	                $this->session->set_flashdata('error','Something Went Wrong, try again!!');
                        redirect('admin/slider');
    	            }
	        } else {
	            $this->load->view('admin/template/header');
                $this->load->view('admin/slider/form');
                $this->load->view('admin/template/footer');   
	        }
    }
    public function sliderDelete($id)
    {   
        $query_image = $this->db->get_where('slider', array('id' => $id))->row();
            $image = $query_image->slider_image;
            
            if (file_exists('upload/assets/images/slider/'.$image)) {
                   unlink('upload/assets/images/slider/'.$image);
            }
             $delete = $this->Dashboard_Model->common_delete($id,'slider');
        	   if($delete) {
        	       $this->session->set_flashdata('success','Slider data delete successfully');
                   redirect('admin/slider');
        	   } else {
                   $this->session->set_flashdata('error','Something Went Wrong');
                   redirect('admin/slider');
        	   }
    }
    function sliderStatusUpdate()
    {
        $id = $this->input->post('id');
	    $status = $this->input->post('status'); $data = ['status'=>$status];
	    $update = $this->Dashboard_Model->common_update($id,$data,'slider');
	    echo $update;
    }

}    