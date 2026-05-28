<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
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
	public function index()
	{   
	   $this->load->view('admin/template/header');
       $this->load->view('admin/template/footer');
	}
	public function category()
	{   
	    $data['datas'] = $this->Dashboard_Model->common_all('category');
	    $this->load->view('admin/template/header');
	    $this->load->view('admin/category/view',$data);
        $this->load->view('admin/template/footer');
	}
	
	public function categoryForm()
	{   
	    $this->form_validation->set_rules('category', 'Category', 'required|trim|is_unique[category.category]');
	    $this->form_validation->set_rules('status', 'Status', 'required|trim');
	    $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');
	    $this->form_validation->set_rules('is_unique', 'The %s entered is already in use');
	    
	    if($this->form_validation->run()) {
	            
	            if($_FILES['cat_image']['name'] !="") {
    	         $config['upload_path'] = './upload/assets/images/'; 
    	         $config['max_size'] = 1024;
                 $config['allowed_types'] = 'jpg|jpeg|png'; 
    	         $this->load->library('upload',$config);
    	         $this->upload->initialize($config);
    	         
    	         if($this->upload->do_upload('cat_image')){
                   $uploadImg = $this->upload->data(); 
                   $data['cat_image'] = $uploadImg['file_name']; 
    	          }  else {
    	              $ierror = $this->upload->display_errors();
    	               $this->session->set_flashdata('imgerror',$ierror);
                       redirect('add-category','refresh');
    	          }
    	        }
    	    
    	        $data['category'] = $this->input->post('category'); 
	            $data['status']  = $this->input->post('status');
	            $data['created_at']  = date('d m Y h:i:s'); 
	            $data['slug'] = url_title($data['category'], 'dash', true);
	            
	            $insert = $this->Dashboard_Model->common_insert($data,'category');
	            
    	            if($insert) {
    	                $this->session->set_flashdata('success','Category Data Insert Successfully!!');
                        redirect('add-category');
    	            } else {
    	                $this->session->set_flashdata('error','Something Went Wrong, try again!!');
                        redirect('add-category');
    	            }
	            
	        }else {
                    $this->load->view('admin/template/header');
                    $this->load->view('admin/category/form');
                    $this->load->view('admin/template/footer');
	    }
   }
	public function categoryEdit($id)
	{
	  if (ctype_digit(strval($id)) ) {
	        
	        $data['datas'] = $this->Dashboard_Model->common_row($id,'category');
	        $this->load->view('admin/template/header');
	        $this->load->view('admin/category/edit',$data);
            $this->load->view('admin/template/footer');
	      
    	   } else {
    	       redirect('category');
    	   }
	}
	
	public function categoryUpdate()
	{
	    $this->form_validation->set_rules('category', 'Category', 'required|trim');
	    $this->form_validation->set_rules('status', 'Status', 'required|trim');
	    $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');
	    
	    if($this->form_validation->run()) {
	        
	           if($_FILES['cat_image']['name'] !="") {
    	         $config['upload_path'] = './upload/assets/images/'; 
                 $config['allowed_types'] = 'jpg|jpeg|png'; 
    	         $this->load->library('upload',$config);
    	         $this->upload->initialize($config);
    	         
    	         if($this->upload->do_upload('cat_image')){
                   $uploadImg = $this->upload->data(); 
                   $data['cat_image'] = $uploadImg['file_name']; 
    	          }  else {
    	              //$data['cat_image'] = $this->upload->display_errors();
                     // print_r($data['cat_image']);
    	          }
    	          $data['cat_image'] = $uploadImg['file_name'];
    	          
    	        } else { $data['cat_image'] = $this->input->post('old_img'); }
    	        
	            $data['category'] = $this->input->post('category');
	            $data['status']  = $this->input->post('status');
	            $data['updeated_at']  = date('d m Y h:i:s'); 
	            $id = $this->input->post('id');
	            $data['slug'] = url_title($data['category'], 'dash', true);
	            
	            $update = $this->Dashboard_Model->common_update($id,$data,'category');
	            
    	            if($update) {
    	                $this->session->set_flashdata('success','Category Data Update Successfully!!');
                        redirect('category');
    	            } else {
    	                $this->session->set_flashdata('error','Something Went Wrong, try again!!');
                        redirect('category');
    	            }
	        } else {
                    $this->load->view('admin/template/header');
                    $this->load->view('admin/category/form');
                    $this->load->view('admin/template/footer');
	        }
	}
	public function categoryDelete($id)
	{
	   $delete = $this->Dashboard_Model->common_delete($id,'category');
            if($delete) {
                $this->session->set_flashdata('success','Category Data Update Successfully!!');
                redirect('category');
            } else {
                $this->session->set_flashdata('error','Something Went Wrong, try again!!');
                redirect('category');
            }
	}
	public function categoryStatusUpdate()
	{
	    $id = $this->input->post('id');
	    $status = $this->input->post('status'); $data = ['status'=>$status];
	    $update = $this->Dashboard_Model->common_update($id,$data,'category');
	    echo $update;
	}
	public function subcategory() {
	    
	    $data['datas'] = $this->db->query("select category.category as category_name,
	                                              subcategory.* FROM subcategory 
	                                              JOIN category ON category.id = subcategory.category")->result();  
	    $this->load->view('admin/template/header');
	    $this->load->view('admin/subcategory/view',$data);
        $this->load->view('admin/template/footer');
	}
	public function subcategoryForm() {
	    
	    $this->form_validation->set_rules('category', 'Category', 'required|trim');
	    $this->form_validation->set_rules('subcategory', 'Subcategory', 'required|trim|is_unique[subcategory.subcategory]');
	    $this->form_validation->set_rules('status', 'Status', 'required|trim');
	    $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');
	    $this->form_validation->set_rules('is_unique', 'The %s entered is already exist');
	    if($this->form_validation->run()) {
	           
	            if($_FILES['sub_cat_image']['name'] !="") {
    	         $config['upload_path'] = './upload/assets/images/cate/'; 
    	         $config['max_size'] = 1024;
                 $config['allowed_types'] = 'jpg|jpeg|png'; 
    	         $this->load->library('upload',$config);
    	         $this->upload->initialize($config);
    	         
    	         if($this->upload->do_upload('sub_cat_image')){
                   $uploadImg = $this->upload->data(); 
                   $data['sub_cat_image'] = $uploadImg['file_name']; 
    	          }  else {
    	              $ierror = $this->upload->display_errors();
    	               $this->session->set_flashdata('imgerror',$ierror);
                       redirect('add-subcategory','refresh');
    	          }
    	        }
	            $data['category'] = $this->input->post('category');
	            $data['is_child'] = $this->input->post('is_child');
	            $data['subcategory'] = $this->input->post('subcategory'); 
	            $data['status']  = $this->input->post('status');
	            $data['created_at']  = date('d m Y h:i:s');
	            $data['subcategory_slug'] = url_title($data['subcategory'], 'dash', true);
	            
	                $insert = $this->Dashboard_Model->common_insert($data,'subcategory');
	            
        	            if($insert) {
        	                $this->session->set_flashdata('success','Subcategory Data Insert Successfully!!');
                            redirect('add-subcategory');
        	            } else {
        	                $this->session->set_flashdata('error','Something Went Wrong, try again!!');
                            redirect('add-subcategory');
        	            }
	            
	        }else {
	                $all['datas'] = $this->Dashboard_Model->common_all('category');
                    $this->load->view('admin/template/header');
                    $this->load->view('admin/subcategory/form',$all);
                    $this->load->view('admin/template/footer');
	       }
	}
	public function subcategoryEdit($id)
	{   
	    $data['datas'] = $this->Dashboard_Model->common_all('category');
	    $data['single'] = $this->Dashboard_Model->common_row($id,'subcategory');
	    $this->load->view('admin/template/header');
        $this->load->view('admin/subcategory/edit',$data);
        $this->load->view('admin/template/footer');
	}
	public function subcategoryUpdate()
	{
	    $this->form_validation->set_rules('category', 'Category', 'required|trim');
	    $this->form_validation->set_rules('subcategory', 'Subcategory', 'required|trim');
	    $this->form_validation->set_rules('status', 'Status', 'required|trim');
	    $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');
	    
	    if($this->form_validation->run()) {
	        
	             if($_FILES['sub_cat_image']['name'] !="") {
    	         $config['upload_path'] = './upload/assets/images/'; 
                 $config['allowed_types'] = 'jpg|jpeg|png'; 
    	         $this->load->library('upload',$config);
    	         $this->upload->initialize($config);
    	         
    	         if($this->upload->do_upload('sub_cat_image')){
                   $uploadImg = $this->upload->data(); 
                   $data['sub_cat_image'] = $uploadImg['file_name']; 
    	          }  else {
    	              //$data['cat_image'] = $this->upload->display_errors();
                     // print_r($data['cat_image']);
    	          }
    	          $data['sub_cat_image'] = $uploadImg['file_name'];
    	          
    	        } else {$data['sub_cat_image'] = $this->input->post('old_img'); }
    	        
	            $data['is_child'] = $this->input->post('is_child');
	            $data['category'] = $this->input->post('category');
	            $data['subcategory'] = $this->input->post('subcategory'); 
	            $data['status']  = $this->input->post('status');
	            $data['updeated_at']  = date('d m Y h:i:s');
	            $data['subcategory_slug'] = url_title($data['subcategory'], 'dash', true);
	            
	            $id = $this->input->post('id');
	               $update = $this->Dashboard_Model->common_update($id,$data,'subcategory');
	            
    	            if($update) {
    	                $this->session->set_flashdata('success','Subategory Data Update Successfully!!');
                        redirect('subcategory');
    	            } else {
    	                $this->session->set_flashdata('error','Something Went Wrong, try again!!');
                        redirect('subcategory');
    	            }
	            
	        }else {
	                $all['datas'] = $this->Dashboard_Model->common_all('category');
                    $this->load->view('admin/template/header');
                    $this->load->view('admin/subcategory/form',$all);
                    $this->load->view('admin/template/footer');
	       }
	}
	public function subcategoryDelete($id)
	{
	 $delete = $this->Dashboard_Model->common_delete($id,'subcategory');
	   if($delete) {
	       $this->session->set_flashdata('success','Subcategory delete successfully');
           redirect('subcategory');
	   } else {
           $this->session->set_flashdata('error','Something Went Wrong');
           redirect('subcategory');
	   }
	}
	public function subcategoryStatusUpdate()
	{
	    $id = $this->input->post('id');
	    $status = $this->input->post('status'); $data = ['status'=>$status];
	    $update = $this->Dashboard_Model->common_update($id,$data,'subcategory');
	    echo $update;
	}
	public function childSubcategory() {
	    
	    $data['datas'] = $this->db->query("select subcategory.subcategory as sub_cat_name,
	                                       childSubcategory.* FROM childSubcategory
	                                       JOIN subcategory ON subcategory.id = childSubcategory.subcategory_id ")->result();  
	    $this->load->view('admin/template/header');
	    $this->load->view('admin/subcategory/childView.php',$data);
        $this->load->view('admin/template/footer');
	}
	public function childSubcategoryForm() {
	    
	    $this->form_validation->set_rules('subcategory_id', 'Sub Category', 'required|trim');
	    $this->form_validation->set_rules('child_sub_cat_name', 'Child SubCategory Name', 'required|trim|is_unique[childSubcategory.child_sub_cat_name]');
	    $this->form_validation->set_rules('status', 'Status', 'required|trim');
	    $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');
	    $this->form_validation->set_rules('is_unique', 'The %s entered is already exist');
	    if($this->form_validation->run()) {
	           
	            if($_FILES['child_sub_cat_image']['name'] !="") {
    	         $config['upload_path'] = './upload/assets/images/cate/'; 
    	         $config['max_size'] = 1024;
                 $config['allowed_types'] = 'jpg|jpeg|png'; 
    	         $this->load->library('upload',$config);
    	         $this->upload->initialize($config);
    	         
    	         if($this->upload->do_upload('child_sub_cat_image')){
                   $uploadImg = $this->upload->data(); 
                   $data['child_sub_cat_image'] = $uploadImg['file_name']; 
    	          }  else {
    	              $ierror = $this->upload->display_errors();
    	               $this->session->set_flashdata('imgerror',$ierror);
                       redirect('admin/child-subcategory','refresh');
    	          }
    	        }
	            $data['subcategory_id'] = $this->input->post('subcategory_id');
	            $data['child_sub_cat_name'] = $this->input->post('child_sub_cat_name'); 
	            $data['child_sub_cat_slug'] = url_title($data['child_sub_cat_name'], 'dash', true);
	            $data['status']  = $this->input->post('status');
	            $data['created_at']  = date('d m Y h:i:s');
	            
	                $insert = $this->Dashboard_Model->common_insert($data,'childSubcategory');
        	            if($insert) {
        	                $this->session->set_flashdata('success','Child Subcategory Data Insert Successfully!!');
                            redirect('admin/child-subcategory');
        	            } else {
        	                $this->session->set_flashdata('error','Something Went Wrong, try again!!');
                            redirect('admin/child-subcategory');
        	            }
	        }else {
	                $all['datas'] = $all['datas'] = $this->db->get_where('subcategory', ['is_child'=>1])->result();
                    $this->load->view('admin/template/header');
                    $this->load->view('admin/subcategory/childForm.php',$all);
                    $this->load->view('admin/template/footer');
	       }
	}
	public function childSubcategoryEdit($id) {
	    
	    $data['datas'] = $this->db->get_where('subcategory', ['is_child'=>1])->result();
	    $data['single'] = $this->Dashboard_Model->common_row($id,'childSubcategory');
	    $this->load->view('admin/template/header');
        $this->load->view('admin/subcategory/childEdit',$data);
        $this->load->view('admin/template/footer');
	    
	}
	public function childSubcategoryUpdate() {
	    
	    $this->form_validation->set_rules('subcategory_id', 'Sub Category', 'required|trim');
	    $this->form_validation->set_rules('child_sub_cat_name', 'Child SubCategory Name', 'required|trim|is_unique[childSubcategory.child_sub_cat_name]');
	    $this->form_validation->set_rules('status', 'Status', 'required|trim');
	    $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');
	    $this->form_validation->set_rules('is_unique', 'The %s entered is already exist');
	    if($this->form_validation->run()) {
	           
	             if($_FILES['child_sub_cat_image']['name'] !="") {
    	         $config['upload_path'] = './upload/assets/images/cate/'; 
                 $config['allowed_types'] = 'jpg|jpeg|png'; 
    	         $this->load->library('upload',$config);
    	         $this->upload->initialize($config);
    	         
    	         if($this->upload->do_upload('child_sub_cat_image')){
                   $uploadImg = $this->upload->data(); 
                   $data['child_sub_cat_image'] = $uploadImg['file_name']; 
    	          }  else {
    	              //$data['cat_image'] = $this->upload->display_errors();
                     // print_r($data['cat_image']);
    	          }
    	          $data['child_sub_cat_image'] = $uploadImg['file_name'];
    	          
    	        } else {$data['child_sub_cat_image'] = $this->input->post('old_img'); }
    	        $id = $this->input->post('id');
	            $data['subcategory_id'] = $this->input->post('subcategory_id');
	            $data['child_sub_cat_name'] = $this->input->post('child_sub_cat_name'); 
	            $data['child_sub_cat_slug'] = url_title($data['child_sub_cat_name'], 'dash', true);
	            $data['status']  = $this->input->post('status');
	            $data['updeated_at']  = date('d m Y h:i:s');
	            
	            $update = $this->Dashboard_Model->common_update($id,$data,'childSubcategory');
	                
        	            if($update) {
        	                $this->session->set_flashdata('success','Child Subcategory Data Update Successfully!!');
                            redirect('admin/child-subcategory');
        	            } else {
        	                $this->session->set_flashdata('error','Something Went Wrong, try again!!');
                            redirect('admin/child-subcategory');
        	            }
	        }else {
	                $all['datas'] = $all['datas'] = $this->db->get_where('subcategory', ['is_child'=>1])->result();
                    $this->load->view('admin/template/header');
                    $this->load->view('admin/subcategory/childForm.php',$all);
                    $this->load->view('admin/template/footer');
	       }

	}
	public function childSubcategoryDelete($id) {
	    
	    $delete = $this->Dashboard_Model->common_delete($id,'childSubcategory');
	   if($delete) {
	       $this->session->set_flashdata('success','Child Subcategory delete successfully');
           redirect('admin/child-subcategory');
	   } else {
           $this->session->set_flashdata('error','Something Went Wrong');
           redirect('admin/child-subcategory');
	   }
	}
	public function childSubcategoryStatusUpdate() {
	    $id = $this->input->post('id');
	    $status = $this->input->post('status'); $data = ['status'=>$status];
	    $update = $this->Dashboard_Model->common_update($id,$data,'childSubcategory');
	    echo $update;
	}

	
	public function contactUs()
	{
	     $all['datas'] = $this->Dashboard_Model->common_all('contactUs');
         $this->load->view('admin/template/header');
         $this->load->view('admin/page/contact-view',$all);
         $this->load->view('admin/template/footer');
	}


	public function registerUser()
	{
	     $all['datas'] = $this->Dashboard_Model->common_all('registerUser');
         $this->load->view('admin/template/header');
         $this->load->view('admin/page/registeruser',$all);
         $this->load->view('admin/template/footer');
	}
	
	public function dsadetailUser($id)
	{
	     $all['datas'] = $this->Dashboard_Model->common_all('registerUser');
         $this->load->view('admin/template/header');
         $this->load->view('admin/page/dsadetailUser',$all);
         $this->load->view('admin/template/footer');
	}
	
	public function branchdetailUser($id)
	{
	     $all['datas'] = $this->Dashboard_Model->common_all('registerUser');
         $this->load->view('admin/template/header');
         $this->load->view('admin/page/branchuserdetail',$all);
         $this->load->view('admin/template/footer');
	}
}