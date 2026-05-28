<?php

class User_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function insert_data($table, $data)
    {
        $que = $this->db->insert_string($table, $data);
        $this->db->query($que);
        $id=$this->db->insert_id();
        if ($id) {
            return $id;
        } else {
            return false;
        }
    }
    // function for insert record end
    public function insert_batch($table, $data)
    {
        $this->db->insert_batch($table, $data);
    }
    
    public function table_truncate($table)
    {
        $query = $this->db->truncate($table);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

   
    public function update_data($table, $data, $where)
    {

        $this->db->where($where);
        $rs=$this->db->update($table, $data);
        if ($rs) {
            return true;
        } else {
            return false;
        }
    }
    // function for update record end

    // function for delete record  start
    public function delete_data($table, $where)
    {
        $rs=$this->db->delete($table, $where);
        if ($rs) {
            return true;
        } else {
            return false;
        }
    }
    // function for delete record end 
    
    public function fetch_usercount($id,$role,$job_type,$all,$status='',$approvel='')
    {
        if($all == "all"){
            if($role == "Admin" ){
                if ($status != 0 && $status != 1) {
                    $queryy = " SELECT * FROM `user_detail` WHERE  role != '$role' and delete_status = 0 ORDER BY updated_at DESC";
                }elseif ($status == 1){
                    $queryy = " SELECT * FROM `user_detail` WHERE  role != '$role' and delete_status = 0 AND kyc_status = '$status' AND kyc_approved = '$approvel' ORDER BY updated_at DESC";
                    // print_r($queryy);die;
                }elseif ($status == 0){
                    $queryy = " SELECT * FROM `user_detail` WHERE  role != '$role' and delete_status = 0 AND kyc_status = '$status' AND kyc_approved = '$approvel' ORDER BY updated_at DESC";
                }
                 
            }else{
                if ($status != 0 && $status != 1) {
                    $queryy = " SELECT * FROM `user_detail` WHERE  role = '$role' and delete_status = 0 ORDER BY updated_at DESC";
                }elseif ($status == 1){
                    $queryy = " SELECT * FROM `user_detail` WHERE  role = '$role' and delete_status = 0 AND kyc_status = '$status' AND kyc_approved = '$approvel' ORDER BY updated_at DESC";
                }elseif ($status == 0){
                    $queryy = " SELECT * FROM `user_detail` WHERE  role = '$role' and delete_status = 0 AND kyc_status = '$status' AND kyc_approved = '$approvel' ORDER BY updated_at DESC";
                }
            }
          
        }else if($all == "Today User"){
            $date = date("Y/m/d"); 
            if($role == "Admin"){
                $queryy = " SELECT * FROM `user_detail` WHERE  date(`register_date_time`)= '$date' and role != '$role' and delete_status = 0   ORDER BY updated_at DESC"; 

            }else {
                if(!empty($job_type))
                {
                   $queryy = " SELECT * FROM `user_detail` WHERE user_id != '$id' AND job_type = '$job_type' AND date(`register_date_time`)= '$date' and delete_status = 0   ORDER BY updated_at DESC"; 
                } else {
                    $queryy = " SELECT * FROM `user_detail` WHERE user_id != '$id' AND role = '$role' AND date(`register_date_time`)= '$date' and delete_status = 0  ORDER BY updated_at DESC";
                }
            }
        }else if($all == "Month User"){
            if($role == "Admin"){
                $queryy = " SELECT * FROM `user_detail` WHERE  MONTH(register_date_time) = MONTH(CURDATE())  and role != '$role' and delete_status = 0   ORDER BY updated_at DESC"; 

            }else {
                if(!empty($job_type))
                {
                   $queryy = " SELECT * FROM `user_detail` WHERE delete_status = 0 AND user_id != '$id' AND job_type = '$job_type' AND MONTH(register_date_time)=MONTH(CURDATE())   ORDER BY updated_at DESC"; 
                } else {
                    $queryy = " SELECT * FROM `user_detail` WHERE delete_status = 0 AND user_id != '$id' AND role = '$role' AND MONTH(register_date_time)=MONTH(CURDATE())   ORDER BY updated_at DESC";
                }
            }
        }else if($all == "Kyc User"){
            if($role == "Admin"){
                $queryy = "SELECT * FROM `user_detail` ud INNER JOIN `final_kyc` b on b.add_emp_id=ud.user_id or b.user_id=ud.user_id ORDER BY updated_at DESC";
                //$queryy = " SELECT * FROM `user_detail` WHERE  role != '$role' and kyc_status = 1"; 

            }else{   
                if(!empty($job_type)){
                   $queryy = " SELECT * FROM `user_detail` WHERE delete_status = 0 AND user_id != '$id' AND job_type = '$job_type' and kyc_status = 1    ORDER BY updated_at DESC"; 
                } else {
                    $queryy = " SELECT * FROM `user_detail` WHERE delete_status = 0 AND user_id != '$id' AND role = '$role' kyc_status = 1 ud INNER JOIN `final_kyc` b on b.add_emp_id=ud.user_id or b.user_id=ud.user_id   ORDER BY updated_at DESC";
                }
            }
        }else if($all == "No Kyc User"){
            if($role == "Admin"){
                $queryy = " SELECT * FROM `user_detail` WHERE  role != '$role' and kyc_status = 0 and delete_status = 0 ORDER BY updated_at DESC";
            }else{
                if(!empty($job_type)){
                    $queryy = " SELECT * FROM `user_detail` WHERE user_id != '$id' AND job_type = '$job_type' and kyc_status = 0 and delete_status = 0 ORDER BY updated_at DESC";
                }else{
                    $queryy = " SELECT * FROM `user_detail` WHERE user_id != '$id' AND role = '$role' and kyc_status = 0 and delete_status = 0 ORDER BY updated_at DESC";
                }
            }
        }else{
            if($role == "Admin"){
                $queryy = " SELECT * FROM `user_detail` WHERE  role != '$role' ORDER BY updated_at DESC"; 

            }else {
                if(!empty($job_type))
                {
                   $queryy = " SELECT * FROM `user_detail` WHERE user_id != '$id' AND job_type = '$job_type' and kyc_status = '$status' ORDER BY updated_at DESC"; 
                } else {
                    $queryy = " SELECT * FROM `user_detail` WHERE user_id != '$id' AND role = '$role' and kyc_status = '$status'    ORDER BY updated_at DESC";
                }
            }
        }
        $query = $this->db->query($queryy);
       
        if ($query->num_rows() > 0) {
            $row = $query->num_rows();
            return $row;
        } else {
            return 0;
        }
    }

    // function for single record start
    public function fetch_condrecordwithfield($tbname, $data, $fname)
    {
        $this->db->where($data);
        $this->db->select($fname);
        $query = $this->db->get($tbname);
        //SELECT * FROM tablename WHERE id = $id
        if ($query->num_rows() > 0) {
            $row = $query->row_array();
            return $row;
        } else {
            return false;
        }
    }

    public function fetch_count($tbname, $data, $fname)
    {
        $this->db->where($data);
        $this->db->select($fname);
        $query = $this->db->get($tbname);
        if ($query->num_rows() > 0) {
            $row = $query->num_rows();
            return $row;
        } else {
            return 0;
        }
    }

    public function fetch_count_with_where_in($tbname, $data, $fname, $where_in='')
        {
            $this->db->where($data);
            
            if (!empty($where_in)) {
                $this->db->where_in('bm_id',$where_in); 
             }
            $this->db->select($fname);
            $query = $this->db->get($tbname);
            
            if ($query->num_rows() > 0) {
                $row = $query->num_rows();
                return $row;
            } else {
                return 0;
            }
        }

    public function fetch_record_orderby($table, $orderby)
    {
        $this->db->select("*");
        if ($orderby !='') {
            $this->db->order_by($orderby, 'DESC');
        }
        $data = $this->db->get($table);
        $get_data = $data->result_array();
        if ($get_data) {
            return $get_data;
        } else {
            return false;
        }
    }

    public function fetch_allrecord_wherecondition($table, $orderby, $where, $select)
    {
        if ($orderby !='') {
            $this->db->order_by($orderby, 'ASC');
        }
        $this->db->select($select);
        if ($where !='') {
            $this->db->where($where);
        }
        $data = $this->db->get($table);
        $get_data = $data->result_array();
        if ($get_data) {
            return $get_data;
        } else {
            return false;
        }
    }
    public function fetch_allrecord_wherecondition_a($table, $orderby, $where, $select)
    {
        if ($orderby !='') {
            $this->db->order_by($orderby, 'ASC');
        }
        $this->db->select($select);
        if ($where !='') {
            $this->db->where($where);
        }
        $data = $this->db->get($table);
        $get_data = $data->result_array();
        if ($get_data) {
            return $get_data;
        } else {
            return false;
        }
    }

    public function fetch_allrecord_wherecondition_limit($table, $orderby, $where, $select, $limit="")
    {
        if ($orderby !='') {
            $this->db->order_by($orderby, 'ASC');
        }
        $this->db->select($select);
        if ($limit !='') {
            $this->db->limit($limit);
        }
        $this->db->where($where);
        $data = $this->db->get($table);
        $get_data = $data->result_array();
        if ($get_data) {
            return $get_data;
        } else {
            return false;
        }
    }


    // fetch single data for ajax from data base
    public function fetchSingleData($data, $tablename, $where)
    {
        $query = $this->db->select($data)
                            ->from($tablename)
                            ->where($where)
                            ->get();
        return $query->row_array();
    }
    // fetch single data for ajax from data base


    // update data for ajax on database
    public function updateData($tablename, $data, $where)
    {
        $query = $this->db->update($tablename, $data, $where);
        return $query;
    }
    // update data for ajax on database

    // Iner Joint
    public function inerjoint()
    {
        $this->db->select("l.id,l.pin_code,l.state_name,l.channels,l.status");
        $this->db->from('distrubutor_location as l');
        $this->db->join('distributor_district as d', 'd.distributor_id = l.id');
        $query = $this->db->get();
        if ($query->num_rows() != 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    // public function get_leads_count($user_id, $role)
    // {
    //     if ($role == 'Admin') {            
    //         $this->db->where(array('delete_status' => 1));
    //         $query =$this->db->get('real_estate_enquiry');
    //         return $query->num_rows();
    //     } 
    //     elseif ($role == 'Sub Admin') {            
    //         $this->db->where(array('bm_id!=' => 803,'delete_status' => 1));
    //         $query =$this->db->get('real_estate_enquiry');
    //         return $query->num_rows();
    //     } 
    //     elseif ($role == 'Business Partner') {
    //         $this->db->where(array('delete_status' => 1,'bp_id' => $user_id));  
    //         $query =$this->db->get('real_estate_enquiry');
    //         return $query->num_rows();
    //     } 
    //     elseif ($role == 'Sr. Business Manager') {
    //         $this->db->where(array('delete_status' => 1,'bm_id' => $user_id));  
    //         $query =$this->db->get('real_estate_enquiry');
    //         return $query->num_rows();
    //     } 
    //     elseif ($role == 'Manager') {
    //         $this->db->where(array('delete_status' => 1,'bm_id' => $user_id ,'role!=' == 'Sr. Business Manager'));  
    //         $query =$this->db->get('real_estate_enquiry');
    //         return $query->num_rows();
    //     } 
    //     elseif ($role == 'Sr. Counsellor') {
    //         $this->db->where(array('delete_status' => 1,'counselor_id' => $user_id));  
    //         $query =$this->db->get('real_estate_enquiry');
    //         return $query->num_rows();
    //     } 
    //     elseif ($role == 'Counselor') {
    //         $this->db->where(array('delete_status' => 1,'counselor_id' => $user_id,'role!=' == 'Sr. Counsellor'));  
    //         $query =$this->db->get('real_estate_enquiry');
    //         return $query->num_rows();
    //     } 
    //     elseif ($role == 'Employee') {
    //         $this->db->where(array('bm_id' => $user_id,'bp_id' => 0,'delete_status' => 1));
    //         $query =$this->db->get('real_estate_enquiry');
    //         return $query->num_rows();
    //     }
    //     elseif ($role == 'Full Time Business Partner') {
    //         $this->db->where(array('delete_status' => 1,'bp_id' => $user_id,'role' =>'Full Time Business Partner'));
    //         $query =$this->db->get('real_estate_enquiry');
    //         return $query->num_rows();
    //     }
    //     elseif ($role == 'Part Time Business Partner') {
    //         $this->db->where(array('delete_status' => 1,'bp_id' => $user_id,'role' =>'Part Time Business Partner'));
    //         $query =$this->db->get('real_estate_enquiry');
    //         return $query->num_rows();
    //     }
    //     else {
    //         $this->db->where(array('bm_id' => $user_id,'bp_id' =>  $user_id,'delete_status' => 1));
    //         $query =$this->db->get('real_estate_enquiry');
    //         return $query->num_rows();
    //     }
    // }

    public function get_leads_count($user_id, $role,$where_in=''){
        if ($role == 'Admin') {            
            $this->db->where(array('delete_status' => 1));
            $query =$this->db->get('real_estate_enquiry');
            return $query->num_rows();
        } 
        else{            
            $this->db->where(array('delete_status' => 1,'created >='=>'2023-07-10 00:00:00'));
            if (!empty($where_in)) {
                $this->db->where_in('bm_id',$where_in); 
             }

            $query =$this->db->get('real_estate_enquiry');
            // print_r($this->db->last_query());die;
            return $query->num_rows();
        } 
    }

    
    public function get_otherlead_count($user_id, $role, $where_in='')
    {
        $user= '';
        $currentDateTime = date('Y-m-d H:i:s');
        $twoHoursAgo = date('Y-m-d H:i:s', strtotime('-2 hours', strtotime($currentDateTime)));
        
        if ($role == 'Admin') {
            $where = array('delete_status' => 1);
        }else{
             $where = array('delete_status' => 1,'created >='=>'2023-07-10 00:00:00');
        }
              
        if ($role != 'Admin' && $role != 'Sub Admin') {
            $result['hotlisted'] = $this->db->where('is_hot', 1)->where($where)->where_in('bm_id',$where_in)->get('real_estate_enquiry')->num_rows();

        $result['upcomingVisits'] = $this->db->where('type', 'Upcoming visit')->where($where)->where_in('bm_id',$where_in)->get('real_estate_enquiry')->num_rows();
        $result['holdBeforeVisit'] = $this->db->where('type', 'Hold before visit')->where($where)->where_in('bm_id',$where_in)->get('real_estate_enquiry')->num_rows();
        $result['rejectBeforeVisit'] = $this->db->where('type', 'Reject before visit')->where($where)->where_in('bm_id',$where_in)->get('real_estate_enquiry')->num_rows();
        $result['visitDone'] = $this->db->where('type', 'Visit done')->where($where)->where_in('bm_id',$where_in)->get('real_estate_enquiry')->num_rows();
        $result['booked'] = $this->db->where('type', 'Booked')->where($where)->where_in('bm_id',$where_in)->get('real_estate_enquiry')->num_rows();
        $result['monthlyvisit'] = $this->db->where('type', 'Visit done')->where($where)->where_in('bm_id',$where_in)->where(array('updated >='=>date('Y-m-1 00:00:00'),'updated <=' =>date('Y-m-31 23:59:00')))->get('real_estate_enquiry')->num_rows();

        $result['monthlybooked'] = $this->db->where('type', 'Booked')->where($where)->where_in('bm_id',$where_in)->where(array('updated >='=>date('Y-m-1 00:00:00'),'updated <=' =>date('Y-m-31 23:59:00')))->get('real_estate_enquiry')->num_rows();

        $result['hold'] = $this->db->where('type', 'Hold')->where($where)->where_in('bm_id',$where_in)->get('real_estate_enquiry')->num_rows();
        $result['reject'] = $this->db->where('type', 'Reject')->where($where)->where_in('bm_id',$where_in)->get('real_estate_enquiry')->num_rows();
        $result['registered'] = $this->db->where('type', 'Registered')->where($where)->where_in('bm_id',$where_in)->get('real_estate_enquiry')->num_rows();
        $result['skippedfollowup'] = $this->db->where('type', NULL)->where_in('bm_id',$where_in)->where('created <=', $twoHoursAgo)->where($where)->get('real_estate_enquiry')->num_rows();
        
        $result['pendingleads'] = $this->db->where('type', NULL)->where('date!=', date('Y-m-d'))->where($where)->where_in('bm_id',$where_in)->get('real_estate_enquiry')->num_rows();

        $result['pending'] = $this->db->where('type', NULL)->where($where)->where_in('bm_id',$where_in)->get('real_estate_enquiry')->num_rows();
        return $result;
        }else {
            $result['hotlisted'] = $this->db->where('is_hot', 1)->where($where)->get('real_estate_enquiry')->num_rows();
        
        // print_r($this->db->last_query());die;

        $result['upcomingVisits'] = $this->db->where('type', 'Upcoming visit')->where($where)->get('real_estate_enquiry')->num_rows();
        $result['holdBeforeVisit'] = $this->db->where('type', 'Hold before visit')->where($where)->get('real_estate_enquiry')->num_rows();
        $result['rejectBeforeVisit'] = $this->db->where('type', 'Reject before visit')->where($where)->get('real_estate_enquiry')->num_rows();
        $result['visitDone'] = $this->db->where('type', 'Visit done')->where($where)->get('real_estate_enquiry')->num_rows();
        $result['booked'] = $this->db->where('type', 'Booked')->where($where)->get('real_estate_enquiry')->num_rows();
        $result['monthlyvisit'] = $this->db->where('type', 'Visit done')->where($where)->where(array('updated >='=>date('Y-m-1 00:00:00'),'updated <=' =>date('Y-m-31 23:59:00')))->get('real_estate_enquiry')->num_rows();

        $result['monthlybooked'] = $this->db->where('type', 'Booked')->where($where)->where(array('updated >='=>date('Y-m-1 00:00:00'),'updated <=' =>date('Y-m-31 23:59:00')))->get('real_estate_enquiry')->num_rows();

        $result['hold'] = $this->db->where('type', 'Hold')->where($where)->get('real_estate_enquiry')->num_rows();
        $result['reject'] = $this->db->where('type', 'Reject')->where($where)->get('real_estate_enquiry')->num_rows();
        $result['registered'] = $this->db->where('type', 'Registered')->where($where)->get('real_estate_enquiry')->num_rows();
        $result['skippedfollowup'] = $this->db->where('type', NULL)->where('created <=', $twoHoursAgo)->where($where)->get('real_estate_enquiry')->num_rows();
        
        $result['pendingleads'] = $this->db->where('type', NULL)->where('date!=', date('Y-m-d'))->where($where)->get('real_estate_enquiry')->num_rows();

        $result['pending'] = $this->db->where('type', NULL)->where($where)->get('real_estate_enquiry')->num_rows();
        return $result;
        }
        
    }
   

  public function get_otherlead_count_api($user_id, $role, $where_in='')
    {
        $user= '';
        $currentDateTime = date('Y-m-d H:i:s');
        $twoHoursAgo = date('Y-m-d H:i:s', strtotime('-2 hours', strtotime($currentDateTime)));
        
        if ($role == 'Admin') {
            $where = array('delete_status' => 1);
        }else{
             $where = array('delete_status' => 1,'created >='=>'2023-07-10 00:00:00');
        }
              
        if ($role != 'Admin' && $role != 'Sub Admin') {
            $result['hotlisted'] = $this->db->where('type','Hot listed')->where($where)->where_in('bm_id',$where_in)->get('real_estate_enquiry')->num_rows();

        $result['upcomingVisits'] = $this->db->where('type', 'Upcoming visit')->where($where)->where_in('bm_id',$where_in)->get('real_estate_enquiry')->num_rows();
        $result['holdBeforeVisit'] = $this->db->where('type', 'Hold before visit')->where($where)->where_in('bm_id',$where_in)->get('real_estate_enquiry')->num_rows();
        $result['rejectBeforeVisit'] = $this->db->where('type', 'Reject before visit')->where($where)->where_in('bm_id',$where_in)->get('real_estate_enquiry')->num_rows();
        $result['visitDone'] = $this->db->where('type', 'Visit done')->where($where)->where_in('bm_id',$where_in)->get('real_estate_enquiry')->num_rows();
        $result['booked'] = $this->db->where('type', 'Booked')->where($where)->where_in('bm_id',$where_in)->get('real_estate_enquiry')->num_rows();
        $result['monthlyvisit'] = $this->db->where('type', 'Visit done')->where($where)->where_in('bm_id',$where_in)->where(array('updated >='=>date('Y-m-1 00:00:00'),'updated <=' =>date('Y-m-31 23:59:00')))->get('real_estate_enquiry')->num_rows();

        $result['monthlybooked'] = $this->db->where('type', 'Booked')->where($where)->where_in('bm_id',$where_in)->where(array('updated >='=>date('Y-m-1 00:00:00'),'updated <=' =>date('Y-m-31 23:59:00')))->get('real_estate_enquiry')->num_rows();

        $result['hold'] = $this->db->where('type', 'Hold')->where($where)->where_in('bm_id',$where_in)->get('real_estate_enquiry')->num_rows();
        $result['reject'] = $this->db->where('type', 'Reject')->where($where)->where_in('bm_id',$where_in)->get('real_estate_enquiry')->num_rows();
        $result['registered'] = $this->db->where('type', 'Registered')->where($where)->where_in('bm_id',$where_in)->get('real_estate_enquiry')->num_rows();
        $result['skippedfollowup'] = $this->db->where('type', NULL)->where_in('bm_id',$where_in)->where('created <=', $twoHoursAgo)->where($where)->get('real_estate_enquiry')->num_rows();
        
        $result['pendingleads'] = $this->db->where('type', NULL)->where('date!=', date('Y-m-d'))->where($where)->where_in('bm_id',$where_in)->get('real_estate_enquiry')->num_rows();

        $result['pending'] = $this->db->where('type', NULL)->where($where)->where_in('bm_id',$where_in)->get('real_estate_enquiry')->num_rows();
        return $result;
        }else {
            $result['hotlisted'] = $this->db->where('type','Hot listed')->where($where)->get('real_estate_enquiry')->num_rows();
        
        // print_r($this->db->last_query());die;

        $result['upcomingVisits'] = $this->db->where('type', 'Upcoming visit')->where($where)->get('real_estate_enquiry')->num_rows();
        $result['holdBeforeVisit'] = $this->db->where('type', 'Hold before visit')->where($where)->get('real_estate_enquiry')->num_rows();
        $result['rejectBeforeVisit'] = $this->db->where('type', 'Reject before visit')->where($where)->get('real_estate_enquiry')->num_rows();
        $result['visitDone'] = $this->db->where('type', 'Visit done')->where($where)->get('real_estate_enquiry')->num_rows();
        $result['booked'] = $this->db->where('type', 'Booked')->where($where)->get('real_estate_enquiry')->num_rows();
        $result['monthlyvisit'] = $this->db->where('type', 'Visit done')->where($where)->where(array('updated >='=>date('Y-m-1 00:00:00'),'updated <=' =>date('Y-m-31 23:59:00')))->get('real_estate_enquiry')->num_rows();

        $result['monthlybooked'] = $this->db->where('type', 'Booked')->where($where)->where(array('updated >='=>date('Y-m-1 00:00:00'),'updated <=' =>date('Y-m-31 23:59:00')))->get('real_estate_enquiry')->num_rows();

        $result['hold'] = $this->db->where('type', 'Hold')->where($where)->get('real_estate_enquiry')->num_rows();
        $result['reject'] = $this->db->where('type', 'Reject')->where($where)->get('real_estate_enquiry')->num_rows();
        $result['registered'] = $this->db->where('type', 'Registered')->where($where)->get('real_estate_enquiry')->num_rows();
        $result['skippedfollowup'] = $this->db->where('type', NULL)->where('created <=', $twoHoursAgo)->where($where)->get('real_estate_enquiry')->num_rows();
        
        $result['pendingleads'] = $this->db->where('type', NULL)->where('date!=', date('Y-m-d'))->where($where)->get('real_estate_enquiry')->num_rows();

        $result['pending'] = $this->db->where('type', NULL)->where($where)->get('real_estate_enquiry')->num_rows();
        return $result;
        }
        
    }

    public function get_leadsdetails($user_id, $role)
    {
        if ($role == 'Admin') {         
            $this->db->where(array('bp_id' => $user_id));
            $query =$this->db->get('real_estate_enquiry');
            return $query->result_array();
        } elseif ($role == 'Business Partner') {
            $this->db->where(array('bp_id' => $user_id));
            $query =$this->db->get('real_estate_enquiry');
            return $query->result_array();
        } elseif ($role == 'Employee') {
            $this->db->where(array('bm_id' => $user_id,'bp_id' => 0));
            $query =$this->db->get('real_estate_enquiry');
            return $query->result_array();
        } elseif ($role == 'Counselor') {
            $this->db->where(array('counselor_id' => $user_id));
            $query =$this->db->get('real_estate_enquiry');
            return $query->result_array();
        } else {
            $this->db->where(array('bm_id' => $user_id,'bp_id' =>  $user_id));
            $query =$this->db->get('real_estate_enquiry');
            return $query->result_array();
        }
    }

    public function get_today_lead($user_id, $role, $where_in=''){
        // if ($role == 'Admin') {
        //     $where = array('delete_status' => 1,'date' => date("Y-m-d"));
        //  }elseif ($role == 'Sub Admin') {
        //     $where = array('delete_status' => 1,'bm_id!=' => 803,'date' => date("Y-m-d"));
        //  }elseif ($role == 'Business Partner') {
        //     $where = array('delete_status' => 1,'bp_id' => $user_id,'date' => date("Y-m-d"));
        //  }elseif ($role == 'Employee') {
        //     $where = array('delete_status' => 1,'bm_id' => $user_id,'bp_id' => 0,'date' => date("Y-m-d"));  
        //  }elseif ($role == 'Counselor') {
        //     $where = array('delete_status' => 1,'counselor_id' => $user_id,'date' => date("Y-m-d"));  
        //  }else{
        //     $where = array('delete_status' => 1,'bm_id' => $user_id,'bp_id' =>  $user_id,'date' => date("Y-m-d"));  
        //  }
       
    //      elseif ($role == 'Business Partner') {
    //        $where = array('delete_status' => 1,'date' => date("Y-m-d"));
    //        $user = array('Sr. Business Manager', 'Counselor', 'Sr. Counsellor', 'Sub Admin', 'Admin'); 
    //      }elseif ($role == 'Sr. Business Manager') {
    //        $where = array('delete_status' => 1,'date' => date("Y-m-d"));  
    //        $user  = array('Counselor', 'Sr. Counsellor', 'Sub Admin', 'Admin');
    //     }elseif ($role == 'Manager') {
    //        $where = array('delete_status' => 1,'date' => date("Y-m-d"));  
    //        $user  = array('Admin', 'Sub Admin', 'Sr. Counsellor', 'Counselor', 'Sr. Business Manager');
    //     }elseif ($role == 'Sr. Counsellor') {
    //        $where = array('delete_status' => 1,'date' => date("Y-m-d"));  
    //        $user  = array( 'Sub Admin', 'Admin'); 
    //    }elseif ($role == 'Counselor') {
    //         $where = array('delete_status' => 1,'date' => date("Y-m-d")); 
    //         $user  = array('Sr. Counsellor', 'Sub Admin', 'Admin');
    //     }elseif ($role == 'Full Time Business Partner') {
    //        $where = array('delete_status' => 1,'role' =>'Full Time Business Partner','date' => date("Y-m-d"));  
    //    }elseif ($role == 'Part Time Business Partner') {
    //        $where = array('delete_status' => 1,'role' =>'Part Time Business Partner','date' => date("Y-m-d"));  
    //     }
    //     elseif ($role == 'Employee') {
    //        $where = array('delete_status' => 1,'bm_id' => $user_id,'bp_id' => 0,'date' => date("Y-m-d"));  
    //     }else{
    //         $where = array('delete_status' => 1,'bm_id' => $user_id,'bp_id' => $user_id,'date' => date("Y-m-d"));
    //     }

    $user ='';
   
    if ($role == 'Admin') {	
        $where = array('delete_status' => 1,'date' => date("Y-m-d"));
     }elseif ($role == 'Sub Admin') {
       $where = array('delete_status' => 1,'bm_id!=' => 803,'date' => date("Y-m-d"));
     }else{
        $where = array('delete_status' => 1,'date' => date("Y-m-d"));
      }
        
        $date = date("Y-m-d");
        $this->db->select('*');
        $this->db->from('real_estate_enquiry');
        $this->db->where($where);
        $this->db->where_not_in('role',$user);
        if ($role != 'Admin') {	
            if (!empty($where_in)) {
                $this->db->where_in('bm_id',$where_in);  
            }
        }
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function get_today_work($user_id, $role, $where_in='')
    {
        $date = date("Y-m-d");
        if ($role == 'Business Partner' || $role == 'Shareholder' || $role == 'Full Time Business Partner' || $role == 'Part Time Business Partner') {
            $this->db->select('*');
            $this->db->from('real_estate_enquiry as ree');
            $this->db->join('followup_detail as fd', 'ree.id = fd.lead_id');
            $this->db->like('fd.next_followup_date', $date);
            $this->db->where(array('ree.bp_id' => $user_id,'ree.delete_status' => 1));
             if (!empty($where_in)) {
                $this->db->where_in('bm_id',$where_in); 
             }
            $query = $this->db->get();
        }elseif ($role == 'Counselor') {
            $this->db->select('*');
            $this->db->from('real_estate_enquiry as ree');
            $this->db->join('followup_detail as fd', 'ree.id = fd.lead_id');
            $this->db->like('fd.next_followup_date', $date);
            $this->db->where(array('ree.counselor_id' => $user_id,'ree.delete_status' => 1));
             if (!empty($where_in)) {
                $this->db->where_in('bm_id',$where_in); 
             }
            $query = $this->db->get();
        }else{
            $this->db->select('*');
            $this->db->from('real_estate_enquiry as ree');
            $this->db->join('followup_detail as fd', 'ree.id = fd.lead_id');
            $this->db->like('fd.next_followup_date', $date);
            $this->db->where(array('ree.delete_status' => 1));
            if (!empty($where_in)) {
                $this->db->where_in('bm_id',$where_in); 
             }
            $query = $this->db->get();
        }
            // print_r($this->db->last_query()); die;
        return $query->num_rows();
    }

    public function get_today_bp_work($user_id, $role)
    {
        if ($role == 'Employee') {
            $date = date("Y-m-d");
            $this->db->select('*');
            $this->db->from('followup_detail as fd');
            $this->db->join('real_estate_enquiry as ree', '(ree.bm_id = fd.user_id OR ree.bp_id=fd.user_id) AND ree.id=fd.lead_id');
            $this->db->where(array('fd.next_followup_date'=> $date, 'ree.bm_id' => $user_id , 'ree.bp_id !=' => 0 ));
            $query = $this->db->get();
            return $query->num_rows();
        }
    }

    public function get_today_bp_leads($user_id, $role)
    {
        $this->db->where(array('bp_id' => $user_id,'bm_id' => $user_id));
        $this->db->select('*');
        $this->db->from('followup_detail as fd');
        $this->db->where(array('fd.lead_id'=>'real_estate_enquiry.id', 'fd.type !='=>'Call'));
        $query = $this->db->get('real_estate_enquiry');

        if ($role == 'Employee') {
            $date = date("Y-m-d");
            $this->db->select('*');
            $this->db->from('followup_detail as fd');
            $this->db->join('real_estate_enquiry as ree', '(ree.bm_id = fd.user_id OR ree.bp_id=fd.user_id) AND ree.id = fd.lead_id');
            $this->db->where(array('fd.next_followup_date'=> $date, 'ree.bm_id' => $user_id , 'ree.bp_id !=' => 0 ));

            $query = $this->db->get();
        }      
        return $query->num_rows();
    }

    // data table start

    private function _get_datatables_query($table='', $column_order='', $column_search = '', $select='', $where='', $order='',  $where_in =[],$where_in_role='', $is_hot_list ="" )
    {
        if (!empty($this->input->post('cmpn_name'))) {
            $data = $this->testing($this->input->post('cmpn_name'));
            if (!empty($data)) {
                $this->db->where('company_id', $data->user_id);
            } else {
                $this->db->where('company_id', 0);
            }
        }
       
        if (!empty($_POST['fromdate'])) {
            if ($_POST['fromdate'] != '') {
                $this->db->where('insert_date >=', date('Y-m-01',strtotime($_POST['fromdate'])));
                $this->db->where('insert_date <=', date('Y-m-t',strtotime($_POST['fromdate'])));
            }
        }

        if (!empty($_POST['fromdate1'])) {
            if ($_POST['fromdate1'] != '') {
                $this->db->where('sold_update_date >=', date('Y-m-01',strtotime($_POST['fromdate1'])));
                $this->db->where('sold_update_date <=', date('Y-m-t',strtotime($_POST['fromdate1'])));
            }
        }


        // if (!empty($where_in)) {
        //     $this->db->where_in('uid',$where_in);             
        // }
        // if (!empty($where_in_role)) {
        //     $this->db->where_in('uid_role',$where_in_role);             
        // }

        if (!empty($where_in)) {

                $this->db->group_start();

                foreach ($where_in as $pair) {
                    $uid = $pair[0] ?? null;
                    $role = $pair[1] ?? null;

                    if ($uid !== null && $role !== null) {
                        $this->db->or_group_start()
                            ->where('uid', $uid)
                            ->where('uid_role', $role)
                        ->group_end();
                    }
                }

                $this->db->group_end();
            }

        if (!empty($is_hot_list)) {
            $this->db->where_in('color_type',$is_hot_list);             
        }


        if (!empty($_POST['new_name'])) {
            if ($_POST['new_name'] != '') {
                $this->db->like('name', $_POST['new_name']);
            }
        }

        if (!empty($_POST['calony_name'])) {
            if ($_POST['calony_name'] != '') {
                $this->db->like('calony_name', $_POST['calony_name']);
            }
        }

        if (!empty($_POST['price_per_square'])) {
            if ($_POST['price_per_square'] != '') {
                $this->db->like('price_per_square', $_POST['price_per_square']);
            }
        }

        if (!empty($_POST['location'])) {
            if ($_POST['location'] != '') {
                $this->db->like('location', $_POST['location']);
            }
        }

        if (!empty($_POST['possession_status'])) {
            if ($_POST['possession_status'] != '') {
                $this->db->like('possession_status', $_POST['possession_status']);
            }
        }

        if (!empty($_POST['contact_no'])) {
            if ($_POST['contact_no'] != '') {
                $this->db->like('contact1', $_POST['contact_no']);
            }
        }


        if (!empty($_POST['new_source'])) {
            if ($_POST['new_source'] != '') {
                $this->db->like('lead_source', $_POST['new_source']);
            }
        }

        if (!empty($_POST['employee_name'])) {
            if ($_POST['employee_name'] != '') {
                $this->db->where('bm_id', $_POST['employee_name']);
            }
        }

        if (!empty($this->input->post('c_type'))) {
            $this->db->join('user', 'user.id = post_jobs.company_id');
            $this->db->where('user.user_type', $this->input->post('c_type'));
            $where = array('post_jobs.id !='=>0);
            $order = array('post_jobs.id' => 'DESC');
            $select  = 'post_jobs.id,company_id,job_title,post_jobs.email,experience,num_post,approve_status,DATE_FORMAT(post_jobs.created,"%d/%m/%Y") as date,
        (SELECT company FROM company_profile WHERE company_profile.user_id = company_id) AS company_name,
        (SELECT industry_id FROM company_profile WHERE company_profile.user_id = company_id) AS industry_id ,
        (SELECT name FROM industries WHERE industries.id = industry_id) AS industry
        ';
        }
        $this->db->select($select);

        if ($where) {
            $this->db->where($where);
        }
   
        $this->db->from($table);
        $i = 0;

        foreach ($column_search as $item) { // loop column
            if(!empty($_POST['search'])){
                if ($_POST['search']['value']) { // if datatable send POST for search
                    if ($i===0) { // first loop
                        $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                        $this->db->like($item, $_POST['search']['value']);
                    } else {
                        $this->db->or_like($item, $_POST['search']['value']);
                    }

                    if (count($column_search) - 1 == $i) { //last loop
                        $this->db->group_end();
                    } //close bracket
                }
            $i++;
            }
        }

        if (isset($_POST['order'])) { // here order processing
            $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } elseif (isset($order)) {
            $order = $order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function get_datatables($table='', $column_order='', $column_search='', $select='', $where='', $order='', $where_in= [],$where_in_role=''){
       $a =  $this->_get_datatables_query($table, $column_order, $column_search, $select, $where, $order,$where_in,$where_in_role);
       if (isset($_POST['length'])) {
            if ($_POST['length'] != -1 ) {
                $this->db->limit($_POST['length'], $_POST['start']);
            }
       }
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered($table='', $column_order='', $column_search='', $select='', $where='', $order='', $where_in=[],$where_in_role='')
    {
        $this->_get_datatables_query($table, $column_order, $column_search, $select, $where, $order,$where_in,$where_in_role);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all($table ='')
    {
        $this->db->from($table);
        return $this->db->count_all_results();
    }
    // data table end

    public function profile($user_id)
    {
        $this->db->where(array('user_id' => $user_id));
        $query =$this->db->get('user_detail');
        return $query->result_array();
    }
    
      public function select_single($table_name,$where){
        $this->db->select('*');
        $this->db->where($where);
        $data = $this->db->get($table_name);
        if ($data) {
            return $data->row_array();
        }else {
            return false;
        }
    }

     public function select_with_where($table_name,$where){
        $this->db->select('*');
        $this->db->where($where);
        $data = $this->db->get($table_name);
        if ($data) {
            return $data->result_array();
        }else {
            return false;
        }
    }

    public function fetch_result_array($table,$where,$data){
        $sql =  $this->db->select($data)
                         ->where($where)
                         ->get($table);
           if ($sql) {
             return $sql->result_array();
           }
           else{
             return false;
           }    
       } 
       
}
