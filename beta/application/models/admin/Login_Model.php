<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_Model extends CI_Model {

    public function login_chk($email ,$password) {
        
    	 $this->db->where('email', $email);
    	 $this->db->where('password', $password); 
    	 $this->db->where('status', 1); 
         $this->db->from('user_master');
         $query = $this->db->get();
    
           if($query->num_rows() == 1) {
    
              return $query->row();
    
          } else {
          	return false;
          }
      }
      
    public function check_email($mobile_no ,$dbname) {
        $this->db->where('mobile_no', $mobile_no);
        $this->db->where('role', 2);
    	$this->db->from($dbname);
        $query = $this->db->get();
    
           if($query->num_rows() == 1) {
    
              return $query->row();
    
          } else {
          	return false;
          }
      }

      public function check_emailsss($mobile_no ,$dbname) {
        $this->db->where('mobile_no', $mobile_no);
        $this->db->where('role', 3);
    	$this->db->from($dbname);
        $query = $this->db->get();
    
           if($query->num_rows() == 1) {
    
              return $query->row();
    
          } else {
          	return false;
          }
      }
      
      public function get_data_with_email($email, $dbname) {
        // registerUser
        $this->db->where('mobile_no', $email);
        $this->db->from($dbname);
    	$query = $this->db->get();
        if($query->num_rows() == 1) {

          return $query->row();

        } else {
      	    return false;
        }
    }
      
    public function update_password($id,$email, $data, $dbName) {
        return $this->db->where('mobile_no',$email)->where('id',$id)->update($dbName,$data);
    }

}