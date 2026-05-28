<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Slider extends CI_Controller {
	
	function __construct()
	{
        parent::__construct();
        $this->load->library('session');
        $this->load->model('admin/Dashboard_Model');
        $this->load->library('upload');
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->logged_in();
    }
	private function logged_in()
	{
        if (!$this->session->userdata('authenticated')) {
            redirect('desk-login');
        }
    }

   public function heading_update()
	{
		$this->form_validation->set_rules('title', 'Title', 'required|trim');

		if ($this->form_validation->run() == false) {
			$this->session->set_flashdata('error', validation_errors());
			redirect($_SERVER['HTTP_REFERER']);
		}
		
		

		$data['title'] = $this->input->post('title');
		$data['description'] = $this->input->post('description');
		$data['type'] = $this->input->post('type');
		$data['color'] = $this->input->post('color');
		$data['domain_id'] = $this->input->post('domain_id');
		$data['status'] = $this->input->post('status') ?? 1;

		  // Upload configuration
        $config['upload_path'] = './assets/images/slider';
        $config['allowed_types'] = 'jpg|jpeg|png|gif|bmp|tiff|jfif';
        $config['max_size'] = 2048;  // 2MB
        $config['encrypt_name'] = TRUE;  // Encrypt file name

        $this->upload->initialize($config);

        $upload_data = [];

        // Check if the image upload was successful
        if (!empty($_FILES['image']['name'])) {
            if ($this->upload->do_upload('image')) {
                $upload_data = $this->upload->data();
				$data['image'] = $upload_data['file_name'];
            } else {
                // Debugging the upload error
                echo $this->upload->display_errors();
                exit;
            }
        }

		// check if domain_id already exists
		$existing = $this->db->where('domain_id', $data['domain_id'])->where('type',$data['type'])->get('settings')->row();
		if ($existing) {
			// UPDATE
			$update = $this->Dashboard_Model->common_update($existing->id, $data, 'settings');
			$msg = $update ? 'Data Updated Successfully!!' : 'Something Went Wrong, try again!!';
		} else {
			// INSERT
			$insert = $this->Dashboard_Model->common_insert($data, 'settings');
			$msg = $insert ? 'Data Inserted Successfully!!' : 'Something Went Wrong, try again!!';
		}

		$this->session->set_flashdata($existing ? 'success' : 'success', $msg);
		redirect($_SERVER['HTTP_REFERER']);
	}


	
    public function sliderForm()
    {    
         if (($this->session->userdata('type') == 'admin') || has_permission('Pages') && has_permission('Home page') && has_permission('slider')) {
			$this->form_validation->set_rules('title', 'title', 'required|trim');
	    //$this->form_validation->set_rules('sub_title', 'Sub Title', 'required|trim');
	    $this->form_validation->set_rules('status', 'Status', 'required|trim');
	    $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');
	    $this->form_validation->set_rules('is_unique', 'The %s entered is already in use');
	    
	    if($this->form_validation->run()) {
	            
	            if($_FILES['slider_image']['name'] !="") {
    	         $config['upload_path'] = './assets/images/slider/'; 
    	         $config['max_size'] = 2448;
                 $config['allowed_types'] = 'jpg|jpeg|png|webp'; 
                 $config['encrypt_name'] = TRUE; 
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

	            if($_FILES['bg_image']['name'] !="") {
    	         $config['upload_path'] = './assets/images/slider/'; 
    	         $config['max_size'] = 2448;
                 $config['allowed_types'] = 'jpg|jpeg|png|webp'; 
                 $config['encrypt_name'] = TRUE; 
    	         $this->load->library('upload',$config);
    	         $this->upload->initialize($config);
    	         
    	         if($this->upload->do_upload('bg_image')){
                   $uploadImg1 = $this->upload->data(); 
                   $data['bg_image'] = $uploadImg1['file_name']; 
    	          }  else {
    	              $ierror = $this->upload->display_errors();
    	               $this->session->set_flashdata('imgerror',$ierror);
                       redirect('admin/add-slider','refresh');
    	          }
    	        }
    	      //  $data['slider_image'] = $uploadImg['file_name'];
    	        $data['title'] = $this->input->post('title'); 
	            $data['sub_title'] = $this->input->post('sub_title');
	            $data['url'] = $this->input->post('url');
	            $data['domain_id'] = $this->input->post('domain_id');
				$data['type'] = 'slider';
	            $data['button_name'] = $this->input->post('button_name');
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
	            
				$data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
	            $this->load->view('admin/template/header');
                $this->load->view('admin/slider/form' ,$data);
                $this->load->view('admin/template/footer');   
	        }
		 }else{
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;  
        }

	    
    }
    public function slider(){
        if (($this->session->userdata('type') == 'admin') || has_permission('Pages') && has_permission('Home page') && has_permission('slider')) {
			$domain_id = domain_id_get();
        //  echo '<pre>'; print_r($this->Dashboard_Model->common_all('user_master'));die;
        $data['datas'] = $this->db->where('status !=', 2)->where(array('domain_id' => $domain_id))->where('type', 'slider')->get('slider')->result();
		$data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
		 
         $this->load->view('admin/template/header');
         $this->load->view('admin/slider/view',$data);
         $this->load->view('admin/template/footer'); 
		}else{
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            
            }
			  
    }
    public function sliderEdit($id)
    {     
        if (($this->session->userdata('type') == 'admin') || has_permission('Pages') && has_permission('Home page') && has_permission('slider')) {
			 $data['datas'] = $this->Dashboard_Model->common_row($id,'slider');
			$data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
			$this->load->view('admin/template/header');
			$this->load->view('admin/slider/edit',$data);
			$this->load->view('admin/template/footer');   
		}else{
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            
        }
        
    }
    public function sliderUpdate()
    { 
         if (($this->session->userdata('type') == 'admin') || has_permission('Pages') && has_permission('Home page') && has_permission('slider')) {
			$this->form_validation->set_rules('title', 'title', 'required|trim');
	    //$this->form_validation->set_rules('sub_title', 'Sub Title', 'required|trim');
	    $this->form_validation->set_rules('status', 'Status', 'required|trim');
	    $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');
	   
	    if($this->form_validation->run()) {
	            
	            if($_FILES['slider_image']['name'] !="") {
    	         $config['upload_path'] = './assets/images/slider/'; 
    	         $config['max_size'] = 2448;
                 $config['allowed_types'] = 'jpg|jpeg|png|webp'; 
                 $config['encrypt_name'] = TRUE; 
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

	            if($_FILES['bg_image']['name'] !="") {
    	         $config['upload_path'] = './assets/images/slider/'; 
    	         $config['max_size'] = 2448;
                 $config['allowed_types'] = 'jpg|jpeg|png|webp'; 
                 $config['encrypt_name'] = TRUE; 
    	         $this->load->library('upload',$config);
    	         $this->upload->initialize($config);
    	         
    	         if($this->upload->do_upload('bg_image')){
                   $uploadImg1 = $this->upload->data(); 
                   $data['bg_image'] = $uploadImg1['file_name']; 
    	          }  else {
    	               $ierror = $this->upload->display_errors();
    	               $this->session->set_flashdata('imgerror',$ierror);
                       redirect('admin/add-slider','refresh');
    	          }
    	        } else { $data['bg_image'] = $this->input->post('old_bg_img'); }
    	        
    	        $id = $this->input->post('id');
    	        $data['title'] = $this->input->post('title'); 
	            $data['sub_title'] = $this->input->post('sub_title');
	            $data['url'] = $this->input->post('url');
				$data['type'] = 'slider';
	            $data['button_name'] = $this->input->post('button_name');
	            $data['status']  = $this->input->post('status');
	            $data['domain_id']  = $this->input->post('domain_id');
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
				
				$data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
	            $this->load->view('admin/template/header');
                $this->load->view('admin/slider/form',$data);
                $this->load->view('admin/template/footer');   
	        }
		 }else{
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
        }
	    
    }
    public function sliderDelete($id)
    {    
        if (($this->session->userdata('type') == 'admin') || has_permission('Pages') && has_permission('Home page') && has_permission('slider')) {
			$query_image = $this->db->get_where('slider', array('id' => $id))->row();
            $image = $query_image->slider_image;
            
            if (file_exists('assets/images/slider/'.$image)) {
                   unlink('assets/images/slider/'.$image);
            }
             $delete = $this->Dashboard_Model->common_delete($id,'slider');
        	   if($delete) {
        	       $this->session->set_flashdata('success','Slider data delete successfully');
                   redirect('admin/slider');
        	   } else {
                   $this->session->set_flashdata('error','Something Went Wrong');
                   redirect('admin/slider');
        	   }
		}else{
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            
        }
        
    }
    function sliderStatusUpdate()
    { 
         if (($this->session->userdata('type') == 'admin') || has_permission('Pages') && has_permission('Home page') && has_permission('slider')) {
			
			 $id = $this->input->post('id');
	    $status = $this->input->post('status'); $data = ['status'=>$status];
	    $update = $this->Dashboard_Model->common_update($id,$data,'slider');
	    echo $update;
		  }else {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
        }
       
    }








// Partener slider




public function partner_sliderForm()
{    
	 if (($this->session->userdata('type') == 'admin') || has_permission('Pages') && has_permission('Home page') && has_permission('Partner Slider')) {
			$this->form_validation->set_rules('title', 'title', 'required|trim');
	//$this->form_validation->set_rules('sub_title', 'Sub Title', 'required|trim');
	$this->form_validation->set_rules('status', 'Status', 'required|trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');
	$this->form_validation->set_rules('is_unique', 'The %s entered is already in use');
	
	if($this->form_validation->run()) {
			
			if($_FILES['slider_image']['name'] !="") {
			 $config['upload_path'] = './assets/images/slider/'; 
			 $config['max_size'] = 2448;
			 $config['allowed_types'] = 'jpg|jpeg|png|webp'; 
			 $config['encrypt_name'] = TRUE; 
			 $this->load->library('upload',$config);
			 $this->upload->initialize($config);
			 
			 if($this->upload->do_upload('slider_image')){
			   $uploadImg = $this->upload->data(); 
			   $data['slider_image'] = $uploadImg['file_name']; 
			  }  else {
				  $ierror = $this->upload->display_errors();
				   $this->session->set_flashdata('imgerror',$ierror);
				   redirect('admin/add-partner-slider','refresh');
			  }
			}
		  //  $data['slider_image'] = $uploadImg['file_name'];
			$data['title'] = $this->input->post('title'); 
			$data['sub_title'] = $this->input->post('sub_title');
			$data['url'] = $this->input->post('url');
			$data['type'] = 'partner_slider';
			$data['button_name'] = $this->input->post('button_name');
			$data['status']  = $this->input->post('status');
			$data['domain_id']  = $this->input->post('domain_id');
			$data['created_at']  = date('d m Y h:i:s'); 
		   
			$insert = $this->Dashboard_Model->common_insert($data,'slider');
			
				if($insert) {
					$this->session->set_flashdata('success','Partner Slider Data Insert Successfully!!');
					redirect('admin/add-partner-slider');
				} else {
					$this->session->set_flashdata('error','Something Went Wrong, try again!!');
					redirect('admin/add-partner-slider');
				}
		} else {
			
		$data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
			$this->load->view('admin/template/header');
			$this->load->view('admin/partner_slider/form',$data);
			$this->load->view('admin/template/footer');   
		}
	 }else{
		$this->session->set_flashdata('message', 'You do not have permission to access this section.');
		redirect('admin-dashboard');
		return;
	}
	
}

public function partner_slider()
{    
	if (($this->session->userdata('type') == 'admin') || has_permission('Pages') && has_permission('Home page') && has_permission('Partner Slider')) {
		$domain_id = domain_id_get();
	 $data['datas'] = $this->db->where('status !=', 2)->where(array('domain_id' => $domain_id))->where('type', 'partner_slider')->get('slider')->result();

	 if (isset($_GET['domain_id']) && (int)$_GET['domain_id']) {
		$data['heading'] = $this->Dashboard_Model->common_rows('partner_slider','settings', $_GET['domain_id']);  
	}else {
		$data['heading'] = $this->Dashboard_Model->common_rows('partner_slider','settings', $domain_id);  
	}
	
	 $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
	 $this->load->view('admin/template/header');
	 $this->load->view('admin/partner_slider/view',$data);
	 $this->load->view('admin/template/footer');   
			
    }else{
		$this->session->set_flashdata('message', 'You do not have permission to access this section.');
		redirect('admin-dashboard');
		return;
	
		}
}
public function partner_sliderEdit($id)
{    
	 if (($this->session->userdata('type') == 'admin') || has_permission('Pages') && has_permission('Home page') && has_permission('Partner Slider')) {
		 $data['datas'] = $this->Dashboard_Model->common_row($id,'slider');
	$data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
		 $this->load->view('admin/template/header');
		 $this->load->view('admin/partner_slider/edit',$data);
		 $this->load->view('admin/template/footer');   
			
	 }else{
		$this->session->set_flashdata('message', 'You do not have permission to access this section.');
		redirect('admin-dashboard');
		return;
		
		}
}
public function partner_sliderUpdate()
{
	 if (($this->session->userdata('type') == 'admin') || has_permission('Pages') && has_permission('Home page') && has_permission('Partner Slider')) {
		 $this->form_validation->set_rules('title', 'title', 'required|trim');
		 //$this->form_validation->set_rules('sub_title', 'Sub Title', 'required|trim');
		 $this->form_validation->set_rules('status', 'Status', 'required|trim');
		 $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');
		
		 if($this->form_validation->run()) {
				 
				 if($_FILES['slider_image']['name'] !="") {
				  $config['upload_path'] = './assets/images/slider/'; 
				  $config['max_size'] = 2448;
				  $config['allowed_types'] = 'jpg|jpeg|png|webp'; 
				  $config['encrypt_name'] = TRUE; 
				  $this->load->library('upload',$config);
				  $this->upload->initialize($config);
				  
				  if($this->upload->do_upload('slider_image')){
					$uploadImg = $this->upload->data(); 
					$data['slider_image'] = $uploadImg['file_name']; 
				   }  else {
						$ierror = $this->upload->display_errors();
						$this->session->set_flashdata('imgerror',$ierror);
						redirect('admin/add-partner-slidersss','refresh');
				   }
				 } else { $data['slider_image'] = $this->input->post('old_img'); }
				 
				 $id = $this->input->post('id');
				 $data['title'] = $this->input->post('title'); 
				 $data['sub_title'] = $this->input->post('sub_title');
				 $data['url'] = $this->input->post('url');
				 $data['type'] = 'partner_slider';
				 $data['button_name'] = $this->input->post('button_name');
				 $data['status']  = $this->input->post('status');
				 $data['domain_id']  = $this->input->post('domain_id');
				 $data['created_at']  = date('d m Y h:i:s'); 
				
				 $update = $this->Dashboard_Model->common_update($id,$data,'slider');
				 
					 if($update) {
						 $this->session->set_flashdata('success','Partner Slider Data update Successfully!!');
						 redirect('admin/partner_slider');
					 } else {
						 $this->session->set_flashdata('error','Something Went Wrong, try again!!');
						 redirect('admin/partner_slider');
					 }
			 } else {
				 $this->load->view('admin/template/header');
				 $this->load->view('admin/partner_slider/form');
				 $this->load->view('admin/template/footer');   
			 }
			
     }else{
		$this->session->set_flashdata('message', 'You do not have permission to access this section.');
		redirect('admin-dashboard');
		return;
	}
}
public function partner_sliderDelete($id)
{   
	 if (($this->session->userdata('type') == 'admin') || has_permission('Pages') && has_permission('Home page') && has_permission('Partner Slider')) {
		 $query_image = $this->db->get_where('slider', array('id' => $id))->row();
			 $image = $query_image->slider_image;
			 
			 if (file_exists('/assets/images/slider/'.$image)) {
					unlink('/assets/images/slider/'.$image);
			 }
			  $delete = $this->Dashboard_Model->common_delete($id,'slider');
				if($delete) {
					$this->session->set_flashdata('success','Partner Slider data delete successfully');
					redirect('admin/partner_slider');
				} else {
					$this->session->set_flashdata('error','Something Went Wrong');
					redirect('admin/partner_slider');
				}
			
	 }else{
		$this->session->set_flashdata('message', 'You do not have permission to access this section.');
		redirect('admin-dashboard');
		return;
		
		}
}
function partner_sliderStatusUpdate()
{
	 if (($this->session->userdata('type') == 'admin') || has_permission('Pages') && has_permission('Home page') && has_permission('Partner Slider')) {
		 $id = $this->input->post('id');
		 $status = $this->input->post('status'); $data = ['status'=>$status];
		 $update = $this->Dashboard_Model->common_update($id,$data,'slider');
		 echo $update;
			
	 }else{
		$this->session->set_flashdata('message', 'You do not have permission to access this section.');
		redirect('admin-dashboard');
		return;
	}
}






// EDGE




public function edgeForm()
{     
	 if (($this->session->userdata('type') == 'admin') || has_permission('Pages') && has_permission('Home page') && has_permission('our edge')) {
			$this->form_validation->set_rules('title', 'title', 'required|trim');
	//$this->form_validation->set_rules('sub_title', 'Sub Title', 'required|trim');
	$this->form_validation->set_rules('status', 'Status', 'required|trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');
	$this->form_validation->set_rules('is_unique', 'The %s entered is already in use');
	
	if($this->form_validation->run()) {
			
			if($_FILES['slider_image']['name'] !="") {
			 $config['upload_path'] = './assets/images/slider/'; 
			 $config['max_size'] = 2448;
			 $config['allowed_types'] = 'jpg|jpeg|png|webp'; 
			 $config['encrypt_name'] = TRUE; 
			 $this->load->library('upload',$config);
			 $this->upload->initialize($config);
			 
			 if($this->upload->do_upload('slider_image')){
			   $uploadImg = $this->upload->data(); 
			   $data['slider_image'] = $uploadImg['file_name']; 
			  }  else {
				  $ierror = $this->upload->display_errors();
				   $this->session->set_flashdata('imgerror',$ierror);
				   redirect('admin/add-partner-slider','refresh');
			  }
			}
		  //  $data['slider_image'] = $uploadImg['file_name'];
			$data['title'] = $this->input->post('title'); 
			$data['sub_title'] = $this->input->post('sub_title');
			$data['url'] = $this->input->post('url');
			$data['type'] = 'edge';
			$data['button_name'] = $this->input->post('button_name');
			$data['status']  = $this->input->post('status');
			$data['domain_id']  = $this->input->post('domain_id');
			$data['created_at']  = date('d m Y h:i:s'); 
		   
			$insert = $this->Dashboard_Model->common_insert($data,'slider');
			
				if($insert) {
					$this->session->set_flashdata('success','edge Data Insert Successfully!!');
					redirect('admin/add-edge');
				} else {
					$this->session->set_flashdata('error','Something Went Wrong, try again!!');
					redirect('admin/add-edge');
				}
		} else {
			$data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
			$this->load->view('admin/template/header');
			$this->load->view('admin/edge/form' ,$data);
			$this->load->view('admin/template/footer');   
		}
	 }else{
		$this->session->set_flashdata('message', 'You do not have permission to access this section.');
		redirect('admin-dashboard');
		return;
		}
		
	
}

public function edge()
{    
	if (($this->session->userdata('type') == 'admin') || has_permission('Pages') && has_permission('Home page') && has_permission('our edge')) {
			
	$domain_id = domain_id_get();
	$data['datas'] = $this->db->where('status !=', 2)->where(array('domain_id' => $domain_id))->where('type', 'edge')->get('slider')->result();
	$data['domains'] = $this->db->where('status',1)->get('domains')->result_array();

	if (isset($_GET['domain_id']) && (int)$_GET['domain_id']) {
		$data['heading'] = $this->Dashboard_Model->common_rows('edge','settings', $_GET['domain_id']);  
	}else {
		$data['heading'] = $this->Dashboard_Model->common_rows('edge','settings', $domain_id);  
	}

	 $this->load->view('admin/template/header');
	 $this->load->view('admin/edge/view',$data);
	 $this->load->view('admin/template/footer');   
	}else{
		$this->session->set_flashdata('message', 'You do not have permission to access this section.');
		redirect('admin-dashboard');
		return;
		}
		
}
public function edgeEdit($id)
{    
	if (($this->session->userdata('type') == 'admin') || has_permission('Pages') && has_permission('Home page') && has_permission('our edge')) {
		$data['datas'] = $this->Dashboard_Model->common_row($id,'slider');
		$data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
		$this->load->view('admin/template/header');
		$this->load->view('admin/edge/edit',$data);
		$this->load->view('admin/template/footer');   
			
	}else{
		$this->session->set_flashdata('message', 'You do not have permission to access this section.');
		redirect('admin-dashboard');
		return;
		}
		
}
public function edgeUpdate()
{
	if (($this->session->userdata('type') == 'admin') || has_permission('Pages') && has_permission('Home page') && has_permission('our edge')) {
			
		$this->form_validation->set_rules('title', 'title', 'required|trim');
		//$this->form_validation->set_rules('sub_title', 'Sub Title', 'required|trim');
		$this->form_validation->set_rules('status', 'Status', 'required|trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');
	   
		if($this->form_validation->run()) {
				
				if($_FILES['slider_image']['name'] !="") {
				 $config['upload_path'] = './assets/images/slider/'; 
				 $config['max_size'] = 2448;
				 $config['allowed_types'] = 'jpg|jpeg|png|webp'; 
				 $config['encrypt_name'] = TRUE; 
				 $this->load->library('upload',$config);
				 $this->upload->initialize($config);
				 
				 if($this->upload->do_upload('slider_image')){
				   $uploadImg = $this->upload->data(); 
				   $data['slider_image'] = $uploadImg['file_name']; 
				  }  else {
					   $ierror = $this->upload->display_errors();
					   $this->session->set_flashdata('imgerror',$ierror);
					   redirect('admin/add-partner-slidersss','refresh');
				  }
				} else { $data['slider_image'] = $this->input->post('old_img'); }
				
				$id = $this->input->post('id');
				$data['title'] = $this->input->post('title'); 
				$data['sub_title'] = $this->input->post('sub_title');
				$data['url'] = $this->input->post('url');
				$data['type'] = 'edge';
				$data['button_name'] = $this->input->post('button_name');
				$data['status']  = $this->input->post('status');
				$data['domain_id']  = $this->input->post('domain_id');
				$data['created_at']  = date('d m Y h:i:s'); 
			   
				$update = $this->Dashboard_Model->common_update($id,$data,'slider');
				
					if($update) {
						$this->session->set_flashdata('success','edge update Successfully!!');
						redirect('admin/edge');
					} else {
						$this->session->set_flashdata('error','Something Went Wrong, try again!!');
						redirect('admin/edge');
					}
			} else {
				$this->load->view('admin/template/header');
				$this->load->view('admin/edge/form');
				$this->load->view('admin/template/footer');   
			}
	}else{
		$this->session->set_flashdata('message', 'You do not have permission to access this section.');
		redirect('admin-dashboard');
		return;
		}
		
}
public function edgeDelete($id)
{   
	if (($this->session->userdata('type') == 'admin') || has_permission('Pages') && has_permission('Home page') && has_permission('our edge')) {
			
		$query_image = $this->db->get_where('slider', array('id' => $id))->row();
			$image = $query_image->slider_image;
			
			if (file_exists('assets/images/slider/'.$image)) {
				   unlink('assets/images/slider/'.$image);
			}
			 $delete = $this->Dashboard_Model->common_delete($id,'slider');
			   if($delete) {
				   $this->session->set_flashdata('success','edge data delete successfully');
				   redirect('admin/edge');
			   } else {
				   $this->session->set_flashdata('error','Something Went Wrong');
				   redirect('admin/edge');
			   }
	}else{
		$this->session->set_flashdata('message', 'You do not have permission to access this section.');
		redirect('admin-dashboard');
		return;
		}
		
}
function edgeStatusUpdate()
{
	if (($this->session->userdata('type') == 'admin') || has_permission('Pages') && has_permission('Home page') && has_permission('our edge')) {
		$id = $this->input->post('id');
		$status = $this->input->post('status'); $data = ['status'=>$status];
		$update = $this->Dashboard_Model->common_update($id,$data,'slider');
		echo $update;
			
	}else{
		$this->session->set_flashdata('message', 'You do not have permission to access this section.');
		redirect('admin-dashboard');
		return;
		}
		
}



// category

public function categoriesForm()
{    
	if (($this->session->userdata('type') == 'admin') || has_permission('Pages') && has_permission('Home page') && has_permission('category')) {
			
		$this->form_validation->set_rules('title', 'title', 'required|trim');
		//$this->form_validation->set_rules('sub_title', 'Sub Title', 'required|trim');
		$this->form_validation->set_rules('status', 'Status', 'required|trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');
		$this->form_validation->set_rules('is_unique', 'The %s entered is already in use');
		
		if($this->form_validation->run()) {
				
				if($_FILES['slider_image']['name'] !="") {
				 $config['upload_path'] = './assets/images/slider/'; 
				 $config['max_size'] = 2448;
				 $config['allowed_types'] = 'jpg|jpeg|png|webp'; 
				 $config['encrypt_name'] = TRUE; 
				 $this->load->library('upload',$config);
				 $this->upload->initialize($config);
				 
				 if($this->upload->do_upload('slider_image')){
				   $uploadImg = $this->upload->data(); 
				   $data['slider_image'] = $uploadImg['file_name']; 
				  }  else {
					  $ierror = $this->upload->display_errors();
					   $this->session->set_flashdata('imgerror',$ierror);
					   redirect('admin/add-partner-slider','refresh');
				  }
				}
			  //  $data['slider_image'] = $uploadImg['file_name'];
				$data['title'] = $this->input->post('title'); 
				$data['sub_title'] = $this->input->post('sub_title');
				$data['url'] = $this->input->post('url');
				$data['type'] = 'categories';
				$data['button_name'] = $this->input->post('button_name');
				$data['status']  = $this->input->post('status');
				$data['domain_id']  = $this->input->post('domain_id');
				$data['created_at']  = date('d m Y h:i:s'); 
			   
				$insert = $this->Dashboard_Model->common_insert($data,'slider');
				
					if($insert) {
						$this->session->set_flashdata('success','categories Data Insert Successfully!!');
						redirect('admin/add-categories');
					} else {
						$this->session->set_flashdata('error','Something Went Wrong, try again!!');
						redirect('admin/add-categories');
					}
			} else {
				
				$data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
				$this->load->view('admin/template/header');
				$this->load->view('admin/categories/form',$data);
				$this->load->view('admin/template/footer');   
			}
	}else{
		$this->session->set_flashdata('message', 'You do not have permission to access this section.');
		redirect('admin-dashboard');
		return;
		}
		
}

public function categories()
{    
	if (($this->session->userdata('type') == 'admin') || has_permission('Pages') && has_permission('Home page') && has_permission('category')) {
		$domain_id = domain_id_get();
	 $data['datas'] = $this->db->where('status !=', 2)->where(array('domain_id' => $domain_id))->where('type', 'categories')->get('slider')->result();
	 
	if (isset($_GET['domain_id']) && (int)$_GET['domain_id']) {
		$data['heading'] = $this->Dashboard_Model->common_rows('categories','settings', $_GET['domain_id']);  
	}else {
		$data['heading'] = $this->Dashboard_Model->common_rows('categories','settings', $domain_id);  
	}

	 $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
	//  print_r($data['heading']);die;
	 $this->load->view('admin/template/header');
	 $this->load->view('admin/categories/view',$data);
	 $this->load->view('admin/template/footer');   
			
	}else{
		$this->session->set_flashdata('message', 'You do not have permission to access this section.');
		redirect('admin-dashboard');
		return;
		}
		
}
public function categoriesEdit($id)
{    
	if (($this->session->userdata('type') == 'admin') || has_permission('Pages') && has_permission('Home page') && has_permission('category')) {
			
		$data['datas'] = $this->Dashboard_Model->common_row($id,'slider');
	   $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
		$this->load->view('admin/template/header');
		$this->load->view('admin/categories/edit',$data);
		$this->load->view('admin/template/footer');   
	}else{
		$this->session->set_flashdata('message', 'You do not have permission to access this section.');
		redirect('admin-dashboard');
		return;
		}
		
}

public function categoriesUpdate()
{
	if (($this->session->userdata('type') == 'admin') || has_permission('Pages') && has_permission('Home page') && has_permission('category')) {
			
		$this->form_validation->set_rules('title', 'title', 'required|trim');
		//$this->form_validation->set_rules('sub_title', 'Sub Title', 'required|trim');
		$this->form_validation->set_rules('status', 'Status', 'required|trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');
	   
		if($this->form_validation->run()) {
				
				if($_FILES['slider_image']['name'] !="") {
				 $config['upload_path'] = './assets/images/slider/'; 
				 $config['max_size'] = 2448;
				 $config['allowed_types'] = 'jpg|jpeg|png|webp'; 
				 $config['encrypt_name'] = TRUE; 
				 $this->load->library('upload',$config);
				 $this->upload->initialize($config);
				 
				 if($this->upload->do_upload('slider_image')){
				   $uploadImg = $this->upload->data(); 
				   $data['slider_image'] = $uploadImg['file_name']; 
				  }  else {
					   $ierror = $this->upload->display_errors();
					   $this->session->set_flashdata('imgerror',$ierror);
					   redirect('admin/add-partner-slidersss','refresh');
				  }
				} else { $data['slider_image'] = $this->input->post('old_img'); }
				
				$id = $this->input->post('id');
				$data['title'] = $this->input->post('title'); 
				$data['sub_title'] = $this->input->post('sub_title');
				$data['url'] = $this->input->post('url');
				$data['type'] = 'categories';
				$data['button_name'] = $this->input->post('button_name');
				$data['status']  = $this->input->post('status');
				$data['domain_id']  = $this->input->post('domain_id');
				$data['created_at']  = date('d m Y h:i:s'); 
			   
				$update = $this->Dashboard_Model->common_update($id,$data,'slider');
				
					if($update) {
						$this->session->set_flashdata('success','categories update Successfully!!');
						redirect('admin/categories');
					} else {
						$this->session->set_flashdata('error','Something Went Wrong, try again!!');
						redirect('admin/categories');
					}
			} else {
				$this->load->view('admin/template/header');
				$this->load->view('admin/categories/form');
				$this->load->view('admin/template/footer');   
			}
	}else{
		$this->session->set_flashdata('message', 'You do not have permission to access this section.');
		redirect('admin-dashboard');
		return;
		}
		
}
public function categoriesDelete($id)
{   
	if (($this->session->userdata('type') == 'admin') || has_permission('Pages') && has_permission('Home page') && has_permission('category')) {
		$query_image = $this->db->get_where('slider', array('id' => $id))->row();
			$image = $query_image->slider_image;
			
			if (file_exists('assets/images/slider/'.$image)) {
				   unlink('assets/images/slider/'.$image);
			}
			 $delete = $this->Dashboard_Model->common_delete($id,'slider');
			   if($delete) {
				   $this->session->set_flashdata('success','categories data delete successfully');
				   redirect('admin/categories');
			   } else {
				   $this->session->set_flashdata('error','Something Went Wrong');
				   redirect('admin/categories');
			   }
			
	}else{
		$this->session->set_flashdata('message', 'You do not have permission to access this section.');
		redirect('admin-dashboard');
		return;
		}
		
}
function categoriesStatusUpdate()
{
	if (($this->session->userdata('type') == 'admin') || has_permission('Pages') && has_permission('Home page') && has_permission('category')) {
		$id = $this->input->post('id');
		$status = $this->input->post('status'); $data = ['status'=>$status];
		$update = $this->Dashboard_Model->common_update($id,$data,'slider');
		echo $update;
			
	}else{
		$this->session->set_flashdata('message', 'You do not have permission to access this section.');
		redirect('admin-dashboard');
		return;
		}
		
}



// category

public function about_customerForm()
{    
	if (($this->session->userdata('type') == 'admin') || has_permission('Pages') && has_permission('Home page') && has_permission('about')) {
			
		$this->form_validation->set_rules('title', 'title', 'required|trim');
		//$this->form_validation->set_rules('sub_title', 'Sub Title', 'required|trim');
		$this->form_validation->set_rules('status', 'Status', 'required|trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');
		$this->form_validation->set_rules('is_unique', 'The %s entered is already in use');
		
		if($this->form_validation->run()) {
				
				if($_FILES['slider_image']['name'] !="") {
				 $config['upload_path'] = './assets/images/slider/'; 
				 $config['max_size'] = 2448;
				 $config['allowed_types'] = 'jpg|jpeg|png|webp'; 
				 $config['encrypt_name'] = TRUE; 
				 $this->load->library('upload',$config);
				 $this->upload->initialize($config);
				 
				 if($this->upload->do_upload('slider_image')){
				   $uploadImg = $this->upload->data(); 
				   $data['slider_image'] = $uploadImg['file_name']; 
				  }  else {
					  $ierror = $this->upload->display_errors();
					   $this->session->set_flashdata('imgerror',$ierror);
					   redirect('admin/add-partner-slider','refresh');
				  }
				}
			  //  $data['slider_image'] = $uploadImg['file_name'];
				$data['title'] = $this->input->post('title'); 
				$data['sub_title'] = $this->input->post('sub_title');
				$data['url'] = $this->input->post('url');
				$data['type'] = 'about_customer';
				$data['button_name'] = $this->input->post('button_name');
				$data['status']  = $this->input->post('status');
				$data['domain_id']  = $this->input->post('domain_id');
				$data['created_at']  = date('d m Y h:i:s'); 
			   
				$insert = $this->Dashboard_Model->common_insert($data,'slider');
				
					if($insert) {
						$this->session->set_flashdata('success',' Data Insert Successfully!!');
						redirect('admin/add-about_customer');
					} else {
						$this->session->set_flashdata('error','Something Went Wrong, try again!!');
						redirect('admin/add-about_customer');
					}
			} else {
	$data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
				
				$this->load->view('admin/template/header');
				$this->load->view('admin/about_customer/form', $data);
				$this->load->view('admin/template/footer');   
			}
	}else{
		$this->session->set_flashdata('message', 'You do not have permission to access this section.');
		redirect('admin-dashboard');
		return;
		}
		
}

public function about_customer()
{    
	if (($this->session->userdata('type') == 'admin') || has_permission('Pages') && has_permission('Home page') && has_permission('about')) {
		$domain_id = domain_id_get();
	 $data['datas'] = $this->db->where('status !=', 2)->where(array('domain_id' => $domain_id))->where('type', 'about_customer')->get('slider')->result();
	 $data['heading'] = $this->Dashboard_Model->common_rows('about_customer','settings', $domain_id);
	//  print_r($data['heading']);die;
	 $this->load->view('admin/template/header');
	 $this->load->view('admin/about_customer/view',$data);
	 $this->load->view('admin/template/footer');   
			
	}else{
		$this->session->set_flashdata('message', 'You do not have permission to access this section.');
		redirect('admin-dashboard');
		return;
		}
		
}
public function about_customerEdit($id)
{    
	if (($this->session->userdata('type') == 'admin') || has_permission('Pages') && has_permission('Home page') && has_permission('about')) {
			
			$data['datas'] = $this->Dashboard_Model->common_row($id,'slider');
			$data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
			$this->load->view('admin/template/header');
			$this->load->view('admin/about_customer/edit',$data);
			$this->load->view('admin/template/footer');   
	}else{
		$this->session->set_flashdata('message', 'You do not have permission to access this section.');
		redirect('admin-dashboard');
		return;
		}
		
}
public function about_customerUpdate()
{
	if (($this->session->userdata('type') == 'admin') || has_permission('Pages') && has_permission('Home page') && has_permission('about')) {
			
		$this->form_validation->set_rules('title', 'title', 'required|trim');
		//$this->form_validation->set_rules('sub_title', 'Sub Title', 'required|trim');
		$this->form_validation->set_rules('status', 'Status', 'required|trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');
	   
		if($this->form_validation->run()) {
				
				if($_FILES['slider_image']['name'] !="") {
				 $config['upload_path'] = './assets/images/slider/'; 
				 $config['max_size'] = 2448;
				 $config['allowed_types'] = 'jpg|jpeg|png|webp'; 
				 $config['encrypt_name'] = TRUE; 
				 $this->load->library('upload',$config);
				 $this->upload->initialize($config);
				 
				 if($this->upload->do_upload('slider_image')){
				   $uploadImg = $this->upload->data(); 
				   $data['slider_image'] = $uploadImg['file_name']; 
				  }  else {
					   $ierror = $this->upload->display_errors();
					   $this->session->set_flashdata('imgerror',$ierror);
					   redirect('admin/add-partner-slidersss','refresh');
				  }
				} else { $data['slider_image'] = $this->input->post('old_img'); }
				
				$id = $this->input->post('id');
				$data['title'] = $this->input->post('title'); 
				$data['sub_title'] = $this->input->post('sub_title');
				$data['url'] = $this->input->post('url');
				$data['type'] = 'about_customer';
				$data['button_name'] = $this->input->post('button_name');
				$data['status']  = $this->input->post('status');
				$data['domain_id']  = $this->input->post('domain_id');
				$data['created_at']  = date('d m Y h:i:s'); 
			   
				$update = $this->Dashboard_Model->common_update($id,$data,'slider');
				
					if($update) {
						$this->session->set_flashdata('success','about_customer update Successfully!!');
						redirect('admin/about_customer');
					} else {
						$this->session->set_flashdata('error','Something Went Wrong, try again!!');
						redirect('admin/about_customer');
					}
			} else {
				$this->load->view('admin/template/header');
				$this->load->view('admin/about_customer/form');
				$this->load->view('admin/template/footer');   
			}
	}else{
		$this->session->set_flashdata('message', 'You do not have permission to access this section.');
		redirect('admin-dashboard');
		return;
		}
		
}
public function about_customerDelete($id)
{   
	if (($this->session->userdata('type') == 'admin') || has_permission('Pages') && has_permission('Home page') && has_permission('about')) {
		$query_image = $this->db->get_where('slider', array('id' => $id))->row();
			$image = $query_image->slider_image;
			
			if (file_exists('assets/images/slider/'.$image)) {
				   unlink('assets/images/slider/'.$image);
			}
			 $delete = $this->Dashboard_Model->common_delete($id,'slider');
			   if($delete) {
				   $this->session->set_flashdata('success',' data delete successfully');
				   redirect('admin/about_customer');
			   } else {
				   $this->session->set_flashdata('error','Something Went Wrong');
				   redirect('admin/about_customer');
			   }
			
	}else{
		$this->session->set_flashdata('message', 'You do not have permission to access this section.');
		redirect('admin-dashboard');
		return;
		}
		
}
	function about_customerStatusUpdate()
	{
		if (($this->session->userdata('type') == 'admin') || has_permission('Pages') && has_permission('Home page') && has_permission('about')) {
			$id = $this->input->post('id');
			$status = $this->input->post('status'); $data = ['status'=>$status];
			$update = $this->Dashboard_Model->common_update($id,$data,'slider');
			echo $update;

			
        }else {
			$this->session->set_flashdata('message', 'You do not have permission to access this section.');
			redirect('admin-dashboard');
			return;
		
		}
	}


	public function show_menu() {
		if (($this->session->userdata('type') == 'admin') || has_permission('Pages') && has_permission('Home page') && has_permission('Header menu') ) {
			$domain_id = domain_id_get();
			$data['menus'] = $this->db->where(array('domain_id' => $domain_id))->get('menus')->result();
			$this->load->view('admin/template/header');
			$this->load->view('admin/header/view', $data);
			$this->load->view('admin/template/footer');
		}else {
			$this->session->set_flashdata('message', 'You do not have permission to access this section.');
			redirect('admin-dashboard');
			return;
		}

	}

	public function add_menu() {
		if (has_permission('Pages') && has_permission('Home page') && has_permission('Header menu') || ($this->session->userdata('type') == 'admin')) {
			$data['domains'] = $this->db->get('domains')->result_array();
			$domain_id = domain_id_get();
			$data['all_menus'] = $this->db->where('status', 1)->where('parent_id',0)->where(($this->session->userdata('type') != 'admin') ? array('domain_id' => $domain_id) : array())->get('menus')->result();
			// echo '<pre>';print_r($data['all_menus']);die;
			$this->load->view('admin/template/header');
			$this->load->view('admin/header/form', $data);
			$this->load->view('admin/template/footer');
		}else{
			$this->session->set_flashdata('message', 'You do not have permission to access this section.');
			redirect('admin-dashboard');
			return;
		
		}
		
	}


	public function save_menu() {
		if (has_permission('Pages') && has_permission('Home page') && has_permission('Header menu') || ($this->session->userdata('type') == 'admin')) {
			
			$data = array(
				'title' => $this->input->post('title'),
				'url' => $this->input->post('url'),
				'parent_id' => $this->input->post('parent_id') ?: 0,
				'status' => 1,
				'is_public' => $this->input->post('is_public') ? 1 : 0,
				'domain_id' => $this->input->post('domain_id')
			);
			$this->db->insert('menus', $data);
			redirect('admin/show_menu');
			
		}else {
			$this->session->set_flashdata('message', 'You do not have permission to access this section.');
			redirect('admin-dashboard');
			return;
		}
    }

    public function edit_menu($id) {
		if (has_permission('Pages') && has_permission('Home page') && has_permission('Header menu') || ($this->session->userdata('type') == 'admin')) {
			$data['datas'] = $this->db->where('id', $id)->get('menus')->row();
			$domain_id = domain_id_get();
			$data['all_menus'] = $this->db->where('status', 1)->where('parent_id',0)->where(($this->session->userdata('type') != 'admin') ? array('domain_id' => $domain_id) : array())->get('menus')->result();
			$data['domains'] = $this->db->get('domains')->result();
			$this->load->view('admin/template/header');
			$this->load->view('admin/header/edit', $data);
			$this->load->view('admin/template/footer');
		}else {
			$this->session->set_flashdata('message', 'You do not have permission to access this section.');
			redirect('admin-dashboard');
			return;
		
		}
    }

    public function update_menu($id) {
		if (has_permission('Pages') && has_permission('Home page') && has_permission('Header menu') || ($this->session->userdata('type') == 'admin')) {
			$data = array(
				'title' => $this->input->post('title'),
				'url' => $this->input->post('url'),
				'parent_id' => $this->input->post('parent_id') ?: 0,
				'is_public' => $this->input->post('is_public') ? 1 : 0
			);
			$this->db->where('id', $id);
			$this->db->update('menus', $data);
			redirect('admin/show_menu');
			
		}else{	
		$this->session->set_flashdata('message', 'You do not have permission to access this section.');
		redirect('admin-dashboard');
		return;
		
		}
    }

    public function delete_menu($id) {
		if (has_permission('Pages') && has_permission('Home page') && has_permission('Header menu') || ($this->session->userdata('type') == 'admin')) {
			
			$this->db->where('id', $id);
			$this->db->delete('menus');
			redirect('admin/show_menu');
        }else{
			$this->session->set_flashdata('message', 'You do not have permission to access this section.');
			redirect('admin-dashboard');
			return;
			
		}
    }


}    