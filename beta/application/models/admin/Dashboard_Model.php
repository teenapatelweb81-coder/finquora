<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_Model extends CI_Model
{
    
   public function changeBranchPassword($uid, $data, $role)
    {
        if($role==3)
        {
            $this->db->where('id', $uid); // Ensure the correct ID column name
             return $this->db->update('branch_franchise', $data);
        }
        if($role==2)
        {
            $this->db->where('id', $uid); // Ensure the correct ID column name
             return $this->db->update('user_master', $data);
        }
        
        if($role==1)
        {
            $this->db->where('id', $uid); 
             return $this->db->update('user_master', $data);
        }
        
    }

    public function updateSkipStatus($uid, $data, $role)
    {
        if ($role == 2 || $role == 1) {
            $this->db->where('id', $uid);
            return $this->db->update('user_master', $data);
        }
        if ($role == 3) {
            $this->db->where('id', $uid);
            return $this->db->update('branch_franchise', $data);
        }
        return false;
    }

    public function getUserById($uid, $role)
    {
        if ($role == 2 || $role == 1) {
            return $this->db->get_where('user_master', ['id' => $uid])->row_array();
        } elseif ($role == 3) {
            return $this->db->get_where('branch_franchise', ['id' => $uid])->row_array();
        }
        return null;
    }
    
    public function insert_transaction($data)
    {
        $this->db->insert('tbl_transection', $data);
        return ($this->db->affected_rows() > 0) ? $this->db->insert_id() : false;
    }
    
   public function get_user_by_id($id)
{
    $this->db->select('mobile_no, password, email');
    $this->db->from('user_master');
    $this->db->where('id', $id);
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
        return $query->row_array(); // Returns user data as an associative array
    } else {
        return false; // No user found
    }
}


public function update_user_password($id, $hashedPassword,$pass)
{
    $this->db->where('id', $id);
    return $this->db->update('user_master', ['password' => $hashedPassword,'pass_text' => $pass]);
}


 public function get_branch_franchise_by_id($id)
{
    $this->db->select('mobile_no, password, email');
    $this->db->from('branch_franchise');
    $this->db->where('id', $id);
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
        return $query->row_array(); // Returns user data as an associative array
    } else {
        return false; // No user found
    }
}

public function update_branch_franchise_password($id, $hashedPassword,$pass)
{
    $this->db->where('id', $id);
    return $this->db->update('branch_franchise', ['password' => $hashedPassword,'pass_text'=>$pass]);
}   





public function get_registerUser_by_id($id)
{
    $this->db->select('mobile, password, email', 'pass_text');
    $this->db->from('registerUser');
    $this->db->where('id', $id);
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
        return $query->row_array(); // Returns user data as an associative array
    } else {
        return false; // No user found
    }
}

public function update_registerUser_password($id, $hashedPassword,$pas)
{
    $this->db->where('id', $id);
    return $this->db->update('registerUser', ['password' => $hashedPassword,'pass_text' => $pas]);
} 




    
    public function selectWithWhereCondition($data,$where,$tableName){
        $this->db->select($data);
        $this->db->where($where);
        $query = $this->db->get($tableName);
        if ($query) {
            return $query->result_array();
        } else {
            return false;
        }
    }
    public function selectWithWhereInCondition($data,$columnName,$where,$tableName){
        $this->db->select($data);
        $this->db->where_in($columnName, $where);
        $query = $this->db->get($tableName);
        if ($query) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function common_all($table, $type='')
    {
        $role = $this->session->userdata('role');
        $uid = $this->session->userdata('user_id');
        if (!empty($type)) {
            $query = $this->db->where('type' ,$type);
        } 

        $this->db->where('status !=', 2);
        if ($role == 2) {
            //$this->db->where('uid', $uid);
            $query = $this->db->get($table);
            return $query->result();
        } else {
            return $this->db->get($table)->result();
        }

    }

    public function common_alls($table)
    {
        // $this->db->from($table);
        // $this->db->order_by("id", "DESC");
        // $this->db->get();
        // return $query->result();
        //return $this->db->last_query();
        $role = $this->session->userdata('role');
        $uid = $this->session->userdata('user_id');
        $domain_id = domain_id_get();
        $this->db->where(array('domain_id' => $domain_id))->order_by("updated_at", "DESC");
        // $this->db->where('status !=', 2);
        if ($role == 2) {
            //$this->db->where('uid', $uid);
            $query = $this->db->get($table);
            return $query->result();
        } else {
            return $this->db->get($table)->result();
        }

    }

    

    public function all_customer($table, $user_id)
    {
        $domain_id = domain_id_get();

        $this->db->where(array('domain_id' => $domain_id));
        $this->db->where('parent_team_id', $user_id);
        $this->db->order_by('updated_at', 'DESC');

        return $this->db->get($table)->result();
    }


    public function check_emailId($emailId, $userType, $domain_id ='')
    {

        if ($userType == "agent") {
            $dbname = "user_master";
            $this->db->where('domain_id', $domain_id);
            $this->db->where('email', $emailId);
            $this->db->from($dbname);
            $query = $this->db->get();
            if ($query->num_rows() == 1) {

                return true;

            } else {
                return false;
            }
        }

        if ($userType == "user") {
            $dbname = "registerUser";
            $this->db->where('email', $emailId);
            $this->db->from($dbname);
            $query = $this->db->get();
            if ($query->num_rows() == 1) {

                return true;

            } else {

                return false;
            }

        }

    }

    public function insertTeamData($data, $dbname)
    {

        //   if($dbname=='user_master' || $dbname=='registerUser'){
        //       if((isset($data['email']) && !empty($data['email']))){
        //           $data['email']='Unpaid--'.$data['email'];
        //           $data['status']=2;
        //       }
        //   }

        $this->db->insert($dbname, $data);
        $insert_id = $this->db->insert_id();
        if ($insert_id > 1) {
            return $insert_id;

        } else {
            return false;
        }
    }

    public function city_all($dbname)
    {
        $this->db->distinct();
        $this->db->select('city');
        $this->db->from($dbname);
        $query = $this->db->get();
        return $query->result();
    }

    public function plan_detail($plan_id)
    {
        $dbname = 'plan_tbl';
        $this->db->select('*');
        $this->db->from($dbname);
        $this->db->where('plan_type', $plan_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_unpaid_user_data($uid, $dbName)
    {
        $this->db->select('*');
        $this->db->from($dbName);
        $this->db->where('id', $uid);
        $this->db->where('status', '2');
        $query = $this->db->get();
        return $query->row();

    }

    public function get_transaction_data($txid, $dbName)
    {

        $this->db->select('*');
        $this->db->from($dbName);
        $this->db->where('payment_id', $txid);
        $this->db->where('pass_json !=', 'NULL');
        $query = $this->db->get();
        return $query->row();

    }

    public function get_payment_data($plan_id, $pid)
    {

        if ($plan_id == "Silver") {
            $dbname = 'plan_tbl';
            $this->db->select('amount');
            $this->db->from($dbname);
            $this->db->where('plan_name', $plan_id);
            $this->db->where('id', $pid);
        } else {
            $dbname = 'plan_tbl';
            $this->db->select('amount2');
            $this->db->from($dbname);
            $this->db->where('plan2_name', $plan_id);
            $this->db->where('id', $pid);

        }

        $query = $this->db->get();
        return $query->row();
    }

    public function insert_data($data, $dbname)
    {

        $this->db->insert($dbname, $data);
        $insert_id = $this->db->insert_id();
        if ($insert_id > 1) {
            return $insert_id;

        } else {
            return false;
        }
    }

    public function update_data($uid, $data, $dbName)
    {

        return $this->db->where('id', $uid)->update($dbName, $data);

    }

    public function update_transaction($txid, $data, $dbName)
    {

        return $this->db->where('payment_id', $txid)->update($dbName, $data);

    }

    public function plan_data($domain_id = '')
    {   
        $type = $this->session->userdata('type');
        if($domain_id == ''){
            $domain_id =domain_id_get();
        }

        $dbname = 'plan_tbl';
        $this->db->select('*');
        $this->db->where('domain_id', $domain_id);
        
        $this->db->from($dbname);
        $this->db->order_by("plan_type", "ASC");
        $query = $this->db->get();
        return $query->result();
    }

    public function plan_update($id, $data)
    {

        $table = 'plan_tbl';
        return $this->db->where('id', $id)->update($table, $data);
    }


    public function channel_partner()
    {
        $domain_id =domain_id_get();
        $type = $this->session->userdata('type');

        $table = 'user_master';
        $this->db->from($table);
        $this->db->where('role', 2);
        $this->db->where('domain_id',$domain_id );
        if ($type != 'admin') {
        }
        $this->db->where('status !=', 3);
        $this->db->order_by("id", "DESC");
        $query = $this->db->get();
        return $query->result();

    }


    public function get_domain_by_url($domain_id)
    {
        // Fetch domain based on domain_id
        $this->db->select('url');
        $this->db->from('domains');
        $this->db->where('id', $domain_id); // Match domain_id
        $query = $this->db->get();

        // Check if domain exists
        if ($query->num_rows() > 0) {
            return $query->row(); // Return the domain URL
        }

        return false; // Return false if no domain is found
    }
  

    public function branch_franchise()
    {
        $domain_id =domain_id_get();
        $type = $this->session->userdata('type');

        $table = 'branch_franchise';
        $this->db->from($table);
        $this->db->where('domain_id',$domain_id );
        // if ($type != 'admin') {
        // }
        $this->db->where('role', 3);
        $this->db->where('status !=', 3);
        $this->db->order_by("id", "DESC");
        $query = $this->db->get();
        return $query->result();
        //return $this->db->last_query();
        //return $this->db->get($table)->result();

    }

    public function getTeamData($uid, $subStatus = null)
    {
        $type = $this->session->userdata('type');
        $role = $this->session->userdata('role');

        $domain_id = domain_id_get();
        $table = 'user_master';
        $this->db->from($table);
        $this->db->where('domain_id', $domain_id);
       
        if ($role != 1) {
        $this->db->where('parent_id', $uid);
        }else {
            $this->db->where('parent_id !=', '');
        }
        $this->db->where('role', 2);
        $this->db->where_not_in('status', [2, 3]);
        if (empty($subStatus)) {
            $this->db->where('subscription', '');
        } else {
            $this->db->where('subscription !=', '');
        }

        $this->db->order_by("id", "DESC");
        $query = $this->db->get();
        return $query->result();
        //return $this->db->last_query();
        //return $this->db->get($table)->result();

    }
    public function getonlyAdminTeamData($uid)
    {
        $type = $this->session->userdata('type');
        $role = $this->session->userdata('role');

        $domain_id = domain_id_get();
        $table = 'user_master';
        $this->db->from($table);
        $this->db->where('domain_id', $domain_id);
        $this->db->where('parent_id_role', 1);
        $this->db->where('role', 2);
        $this->db->where_not_in('status', [2, 3]);
        $this->db->where('subscription', '');

        $this->db->order_by("id", "DESC");
        $query = $this->db->get();
        return $query->result();

    }

    public function getMyTeamData($uid)
    {
        $type = $this->session->userdata('type');
        $role = $this->session->userdata('role');

        $domain_id = domain_id_get();
        $table = 'user_master';
        $this->db->from($table);
        $this->db->where('domain_id', $domain_id);
        if ($type != 'admin') {
        }
        if ($role != 1) {
            $this->db->where('parent_id', $uid);
        }else {
            $this->db->where('parent_id !=', '');
            if ($type == 'admin') {
            $this->db->group_start();
            $this->db->where('domain_id !=', 3);
            $this->db->or_group_start();
            $this->db->where('domain_id', 3);
            $this->db->where('parent_id_role !=', 1);
            $this->db->group_end();
            $this->db->group_end();
            }elseif ($type == 'subadmin') {
                $this->db->group_start();
                $this->db->where('domain_id !=', $domain_id);
                $this->db->or_group_start();
                $this->db->where('domain_id', $domain_id);
                $this->db->where('parent_id_role !=', 1);
                $this->db->group_end();
                $this->db->group_end();
            }
            
        }
        $this->db->where('role', 2);
        $this->db->where_not_in('status', [2, 3]);
        $this->db->where('subscription', '');

        $this->db->order_by("id", "DESC");
        $query = $this->db->get();
        return $query->result();

    }

    
    public function getadminTeamData($uid, $subStatus = null)
    {
        $type = $this->session->userdata('type');
        $role = $this->session->userdata('role');

        $domain_id = domain_id_get();
        $table = 'user_master';

        $this->db->from($table);
        $this->db->where('domain_id', $domain_id);
        $this->db->where('parent_id_role', 1);
        $this->db->where('role', 2);
        $this->db->where('status', 1);
        $this->db->where('subscription', '');

        // Only users having a parent_id
        $this->db->where('parent_id IS NOT NULL', NULL, FALSE);
        $this->db->where('parent_id !=', '');
        // If parent_id can be 0, uncomment the next line
        // $this->db->where('parent_id !=', 0);

        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        return $query->result();

    }

    public function get_channel_partner($id)
    {
        $domain_id =domain_id_get();
        $type = $this->session->userdata('type');

        $table = 'user_master';
        $this->db->from($table);
        $this->db->where('domain_id',$domain_id );
        if ($type != 'admin') {
        }
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result();

    }

    public function get_user($id)
    {
        $current_domain = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http");
        $current_domain .= "://" . $_SERVER['HTTP_HOST'] . '/';
        $website_id = $this->db->where('url', $current_domain)->get('domains')->row();
        $type = $this->session->userdata('type');
        $table = 'registerUser';
        $this->db->from($table);
         if ($type != 'admin') {
            $this->db->where('domain_id',$website_id->id );
        }
        $this->db->where('id', $id);
        // $this->db->where('status !=', 2);
        $query = $this->db->get();
        return $query->result();

    }
    public function get_user_view($id)
    {
        $table = 'registerUser';
         $domain_id = domain_id_get();
        $this->db->from($table);
        $this->db->where('id', $id);
        $this->db->where('domain_id', $domain_id);
        // if ($this->session->userdata('type') != 'admin') {
        // }
        $query = $this->db->get();
        return $query->result();

    }

    public function bank_list()
    {
        $domain_id = domain_id_get();
        $table = 'tbl_banks';
        $this->db->from($table);
        $this->db->where('status', 1);
        $this->db->where('domain_id', $domain_id);
        // if ($this->session->userdata('type') != 'admin') {
        // }
        $query = $this->db->get();
        return $query->result();

    }
    public function bankwise_pdfs()
    {
         $domain_id = domain_id_get();
        $table = 'bankwise_pdfs';
        $this->db->from($table);
        $this->db->where('status', 1);
        $this->db->where('domain_id', $domain_id);
        //  if ($this->session->userdata('type') != 'admin') {
        // }
        $this->db->order_by("id", "DESC");
        $query = $this->db->get();
        return $query->result();

    }

   public function loan_list()
{
    $domain_id = domain_id_get();
    $this->db->where('status', 1);

    $this->db->where('domain_id', $domain_id);
    // if ($this->session->userdata('type') != 'admin') {
    // }

    $query = $this->db->get('tbl_loan');
    return $query->result();
}


    public function process_type_list()
    {
        $table = 'loan_process';
        $this->db->from($table);
        // $this->db->where('status', 1);
        $query = $this->db->get();
        return $query->result();

    }

    public function get_count($role, $status, $tbName)
    {

        $role = $this->session->userdata('role');
        $uid = $this->session->userdata('user_id');
        $domain_id = domain_id_get();
        $this->db->where('domain_id',$domain_id);
        // if ($this->session->userdata('type') != 'admin') {
        // }
        if ($role == 2) {

            if ($status == 1) {
                $this->db->where('uid', $uid);
                $this->db->where('status', $status);
            }
            if ($status == 2) {
                $this->db->where('uid', $uid);
                $this->db->where('status', $status);
            }
            if ($status == 3) {
                $this->db->where('uid', $uid);
                $this->db->where('status', $status);
            }
            if ($status == 4) {
                $this->db->where('uid', $uid);
                $this->db->where('status', $status);
            }

            $query = $this->db->get($tbName);
            return $query->num_rows();
        } else {
            $query = $this->db->get($tbName);
            return $query->num_rows();

        }

    }

    public function get_payouts_and_disbursements_total()
    {

        $role = $this->session->userdata('role');
        $uid = $this->session->userdata('user_id');
        $domain_id = domain_id_get();

        $table = 'user_master';
        $this->db->select('SUM(payout) AS total_payouts,SUM(disbursements) AS total_disbursements,SUM(approved_file_count) AS total_approved_file_count,SUM(rejected_file_count) AS total_rejected_file_count');
        $this->db->from($table);

        if ($role == 1) {
            //   $this->db->where("id=$uid OR parent_id=$uid");
            //    $this->db->where("parent_id=$uid");

            $this->db->where("parent_id IS NULL");
        } else {
            $this->db->where("id = $uid");
        }
      $this->db->where('status !=', 3);
      
      $this->db->where('domain_id',$domain_id);
        // if ($this->session->userdata('type') != 'admin') {
        // }

        $query = $this->db->get();
        return $query->result();

    }

    public function profile_data($uid)
    {
        $table = 'user_master';
        $this->db->from($table);
        $this->db->where('id', $uid);
        $query = $this->db->get();
        return $query->result();

    }

    public function get_branch($id)
    {
        $table = 'branch_franchise';
        $this->db->from($table);
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result();

    }

    // public function video_data()
    // {
    //     $table = 'video';
    //     $this->db->from($table);
    //     $this->db->where('status', 1);
    //     $query = $this->db->get();
    //     return $query->result();

    // }

    public function video_data()
    {
        $domain_id =domain_id_get();
        $this->db->select('id, title, url, image, status,domain_id, created_at, update_at'); // Explicitly select columns
        $this->db->from('video');
        $this->db->where('status', 1);
        $this->db->where('domain_id', $domain_id);
    //     if ($this->session->userdata('type') != 'admin') {
    // }

        $query = $this->db->get();
        return $query->result();
    }
    

    public function lead_list()
    {
        $role = $this->session->userdata('role');
        $uid = $this->session->userdata('user_id');

        $table = 'leads';
        $table1 = 'loan_process';
        $table2 = 'user_master';
        $this->db->select("IF($table2.parent_id IS NOT NULL AND $table2.role=2,CONCAT((SELECT us.username FROM $table2 AS us WHERE us.id=$table2.parent_id),'/',$table2.username),$table2.username) as u_username,$table2.subscription as subscription,$table1.process_type,$table1.process_name,$table.*");
        $this->db->from($table);
        $this->db->join($table1, "$table1.id = $table.process_id", 'left');
        $this->db->join($table2, "$table2.id = $table.uid OR $table2.parent_id = $table.uid", 'left');
        // $this->db->join($table2, "$table2.id = $table.uid",'left');
        $this->db->where("$table.status", 1);
        if ($role == 1) {
            // $this->db->where("($table.uid=$uid OR $table2.parent_id=$uid)");
        } else {

            $this->db->where("$table.uid", $uid);
        }
        $this->db->group_by("$table.id");
        $query = $this->db->get();
        return $query->result();

    }

    public function all_lead_list()
    {
        $role = $this->session->userdata('role');
        $uid = $this->session->userdata('user_id');

        $table = 'leads';
        $table1 = 'loan_process';
        $table2 = 'user_master';
        $this->db->select("IF($table2.parent_id IS NOT NULL AND $table2.role=2,CONCAT((SELECT us.username FROM $table2 AS us WHERE us.id=$table2.parent_id),'/',$table2.username),$table2.username) as u_username,$table2.subscription as subscription,$table1.process_type,$table1.process_name,$table.*");
        $this->db->from($table);
        $this->db->join($table1, "$table1.id = $table.process_id", 'left');
        $this->db->join($table2, "$table2.id = $table.uid OR $table2.parent_id = $table.uid", 'left');
        // $this->db->join($table2, "$table2.id = $table.uid",'left');
        // $this->db->where("$table.status", 1);
        if ($role == 1) {
            // $this->db->where("($table.uid=$uid OR $table2.parent_id=$uid)");
        } else {

            $this->db->where("$table.uid", $uid);
        }
        $this->db->group_by("$table.id");
        $this->db->order_by("$table.created_on", "DESC");
        $query = $this->db->get();
        return $query->result();
    }

    public function get_leads_data($startDate, $endDate, $flag, $tbName)
    {
        $role = $this->session->userdata('role');
        $uid = $this->session->userdata('user_id');

        if ($flag == "ytd") {
            $this->db->where('lead_date <=', 'DATE_ADD(NOW(),INTERVAL 360 DAYS )');
            if ($role > 1) {
                $this->db->where('uid', $uid);
            }

            $query = $this->db->get($tbName);
            return $query->result();
        } else if ($flag == "custom") {
            $this->db->where('lead_date =', $startDate);
            if ($role > 1) {
                $this->db->where('uid', $uid);
            }
            $query = $this->db->get($tbName);
            return $query->result();
        } else if ($flag == "qtd") {
            $this->db->where('lead_date <=', 'DATE_ADD(NOW(),INTERVAL 90 DAYS )');
            if ($role > 1) {
                $this->db->where('uid', $uid);
            }
            $query = $this->db->get($tbName);
            return $query->result();
        } else if ($flag == "lastthreemonth") {
            $this->db->where('lead_date <=', 'DATE_ADD(NOW(),INTERVAL 90 DAYS )');
            if ($role > 1) {
                $this->db->where('uid', $uid);
            }
            $query = $this->db->get($tbName);
            return $query->result();
        } else if ($flag == "all") {
            if ($role > 1) {
                $this->db->where('uid', $uid);
            }
            $query = $this->db->get($tbName);
            return $query->result();
        } else {
            if ($endDate == '' && $startDate != '') {
                $this->db->where('lead_date', $startDate);
                if ($role > 1) {
                    $this->db->where('uid', $uid);
                }
                $query = $this->db->get($tbName);
                return $query->result();
            } else {
                $this->db->where('lead_date >=', $startDate);
                $this->db->where('lead_date <=', $endDate);
                if ($role > 1) {
                    $this->db->where('uid', $uid);
                }
                $query = $this->db->get($tbName);
                return $query->result();
            }

        }

    }

    public function get_busniess_data($startDate, $endDate, $flag, $role, $uid, $tbName)
    {
        if ($flag == "qtd") {
            $this->db->where('lead_date <=', 'DATE_ADD(NOW(),INTERVAL 360 DAYS )');
            $this->db->where('uid', $uid);
            $query = $this->db->get($tbName);
            return $query->num_rows();
        } else if ($flag == "lastthreemonth") {
            $this->db->where('lead_date <=', 'DATE_ADD(NOW(),INTERVAL 90 DAYS )');
            $this->db->where('uid', $uid);
            $query = $this->db->get($tbName);
            return $query->num_rows();
        } else if ($flag == "all") {
            $this->db->where('uid', $uid);
            $query = $this->db->get($tbName);
            return $query->num_rows();
        } else {
            if ($endDate == '' && $startDate != '') {
                $this->db->where('lead_date', $startDate);
                $this->db->where('uid', $uid);
                $query = $this->db->get($tbName);
                return $query->num_rows();
            } else {
                $this->db->where('lead_date >=', $startDate);
                $this->db->where('lead_date <=', $endDate);
                $this->db->where('uid', $uid);
                $query = $this->db->get($tbName);
                return $query->num_rows();
            }

        }

    }

    public function get_AgentCity_data($city, $dnname)
    {
        if ($city != "all") {
            $this->db->like('city', $city);
        }

        $this->db->where('role', 2);
        $query = $this->db->get($dnname);
        return $query->result();

    }

    public function get_UserCity_data($city, $dnname)
    {
        if ($city != "all") {
            $this->db->like('city', $city);
        }
        $query = $this->db->get($dnname);
        return $query->result();
    }

    public function get_application_data($startDate, $endDate, $flag, $role, $uid, $tbName)
    {
        if ($flag == "ytd") {
            $this->db->where('lead_date <=', 'DATE_ADD(NOW(),INTERVAL 360 DAYS )');
            $this->db->where('uid', $uid);
            $query = $this->db->get($tbName);
            return $query->result();
        } else if ($flag == "qtd") {
            $this->db->where('lead_date <=', 'DATE_ADD(NOW(),INTERVAL 90 DAYS )');
            $this->db->where('uid', $uid);
            $query = $this->db->get($tbName);
            return $query->result();
        } else if ($flag == "lastthreemonth") {
            $this->db->where('lead_date <=', 'DATE_ADD(NOW(),INTERVAL 90 DAYS )');
            $this->db->where('uid', $uid);
            $query = $this->db->get($tbName);
            return $query->result();
        } else if ($flag == "all") {
            $this->db->where('uid', $uid);
            $query = $this->db->get($tbName);
            return $query->result();
        } else {
            if ($endDate == '' && $startDate != '') {
                $this->db->where('lead_date', $startDate);
                $this->db->where('uid', $uid);
                $query = $this->db->get($tbName);
                return $query->result();
            } else {
                $this->db->where('lead_date >=', $startDate);
                $this->db->where('lead_date <=', $endDate);
                $this->db->where('uid', $uid);
                $query = $this->db->get($tbName);
                return $query->result();
            }

        }

    }

    public function get_network_people($userdata)
    {
        if ($userdata == "customer") {

            $role = $this->session->userdata('role');
            $uid = $this->session->userdata('user_id');

            if ($role == 2) {
                $this->db->where('uid', $uid);
                $query = $this->db->get('leads');
                return $query->result();
            } else {
                $this->db->where('status !=', 2);
                $query = $this->db->get('registerUser');
                return $query->result();
            }

        } else {
            $this->db->where('status !=', 2);
            $this->db->where('role', 2);
            $query = $this->db->get('user_master');
            return $query->result();

        }

    }

    public function get_network_data($userdata)
    {
         $current_domain = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http");
        $current_domain .= "://" . $_SERVER['HTTP_HOST'] . '/';
        $website_id = $this->db->where('url', $current_domain)->get('domains')->row();
        $type = $this->session->userdata('type');
        $this->db->where('domain_id',$website_id->id );
         if ($type != 'admin') {
        }
        if ($userdata == "customer") {
            //$this->db->where('uid', $uid);
            $this->db->where('status !=', 2);
            $query = $this->db->get('registerUser');
            return $query->result();

        } else {
            $this->db->where('status !=', 2);
            $this->db->where('role', 2);
            $query = $this->db->get('user_master');
            return $query->result();

        }

    }

    public function bank_criteria($loan_id, $bank_id,$domain_id)
    {
        $table = 'bank_eligibility_criteria';
        $this->db->from($table);
        $this->db->where('loan_id', $loan_id);
        $this->db->where('bank_id', $bank_id);
        $this->db->where('domain_id', $domain_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function bank_criteria_update($loan_id, $bank_id, $data)
    {
        $table = 'bank_eligibility_criteria';
        $this->db->where('loan_id', $loan_id);
        $this->db->where('bank_id', $bank_id);
        return $this->db->insert($table, $data);
    }

    public function delete_by_id($table, $id)
    {
        $this->db->where('id', $id);
        return $this->db->delete($table);

    }

    public function slots_data()
    {
        $domain_id = domain_id_get();
        $table = 'slot_tbl';
        $this->db->from($table);
        $this->db->where('domain_id', $domain_id);
        // if ($this->session->userdata('type') != 'admin') {
        // }
        $this->db->order_by("id", "DESC");
        $query = $this->db->get();
        return $query->result();

    }
    public function slots_data_with_where($id)
    {
        $table = 'slot_tbl';
        $this->db->from($table);
        $this->db->where('id', $id);
        $this->db->order_by("id", "ASC");
        $query = $this->db->get();
        // echo '<pre>';print_r($query->result());die;
        return $query->result();

    }

    public function update_channel_partner($id, $updateData)
    {
        $table = 'user_master';
        return $this->db->where('id', $id)->update($table, $updateData);

    }

    public function update_branch($id, $updateData)
    {
        $table = 'branch_franchise';
        return $this->db->where('id', $id)->update($table, $updateData);

    }

    public function update_user($id, $updateData)
    {
        $table = 'registerUser';
        return $this->db->where('id', $id)->update($table, $updateData);

    }

    public function common_insert($data, $table)
    {
        return $this->db->insert($table, $data);
    }

    public function common_row($id, $table)
    {
        return $this->db->get_where($table, ['id' => $id])->row();
    }

    public function common_rows($id, $table, $domain_id)
    {
        return $this->db->get_where($table, ['type' => $id,'domain_id'=> $domain_id])->row();
        // print_r($this->db->last_query());
    }

    public function common_update($id, $data, $table)
    {
        return $this->db->where('id', $id)->update($table, $data);
    }

    public function update_status($id, $data, $table)
    {

        return $this->db->where('id', $id)->update($table, $data);
        //return $this->db->where('id',$id)->delete($table);
    }
    
   public function remove_unpaid_prefix($id)
{
    $sql = "UPDATE user_master 
            SET email = TRIM(REPLACE(email, 'Unpaid--', '')) 
            WHERE id = ? AND email LIKE 'Unpaid--%'";
    return $this->db->query($sql, array($id));
}

 public function remove_registerUser_unpaid_prefix($id)
{
    $sql = "UPDATE registerUser 
            SET email = TRIM(REPLACE(email, 'Unpaid--', '')) 
            WHERE id = ? AND email LIKE 'Unpaid--%'";
    return $this->db->query($sql, array($id));
}

public function remove__branch_franchise_unpaid_prefix($id)
{
    $sql = "UPDATE branch_franchise 
            SET email = TRIM(REPLACE(email, 'Unpaid--', '')) 
            WHERE id = ? AND email LIKE 'Unpaid--%'";
    return $this->db->query($sql, array($id));
}

public function remove_statusagentss_unpaid_prefix($id)
{
    
    $sql = "UPDATE branch_franchise 
            SET email = TRIM(REPLACE(email, 'Unpaid--', '')) 
            WHERE id = ? AND email LIKE 'Unpaid--%'";
    return $this->db->query($sql, array($id));
    
}

public function remove_statususer_unpaid_prefix($id)
{
    
     $sql = "UPDATE registerUser 
            SET email = TRIM(REPLACE(email, 'Unpaid--', '')) 
            WHERE id = ? AND email LIKE 'Unpaid--%'";
    return $this->db->query($sql, array($id));
    
    
}



    public function common_join($table1, $table2, $table3)
    {
        $this->db->select("$table2.category,$table3.subcategory,$table1.*");
        $this->db->from($table1);
        $this->db->join($table2, "$table1.cat_id = $table2.id");
        $this->db->join($table3, "$table1.subcat_id = $table3.id");
        // $this->db->where("$table1.status",1);
        $this->db->order_by("$table1.id", "DESC");
        return $this->db->get()->result();
        // $this->db->last_query();
    }

    public function banker_data_get($filters = [])
    {
        $table = 'banker';
        $domain_id =domain_id_get();
        $this->db->from($table);
        $this->db->order_by("id", "DESC");
        $this->db->where('status', 1);
        
        $this->db->where('domain_id', $domain_id);
    // if ($this->session->userdata('type') != 'admin') {
    // }

        if (!empty($filters)) {
            $this->db->where($filters);
        }
        
        //  $this->db->limit(100);
        $query = $this->db->get();
        return $query->result();

    }
   public function bankmaster_data_get()
{
      $domain_id =domain_id_get();
      
      $this->db->where('status', 1);
      $this->db->where('domain_id', $domain_id);
    //   if ($this->session->userdata('type') != 'admin') {
    //   }
    $this->db->order_by("id", "DESC");

    $query = $this->db->get('tbl_banks');
    return $query->result();
}


    public function cities_data()
    {
        $table = 'cities';
        $this->db->from($table);
        $this->db->order_by("id", "DESC");
        $query = $this->db->get();
        return $query->result();

    }

    public function state_data()
    {
        $table = 'states';
        $this->db->from($table);
        $this->db->order_by("id", "DESC");
        $query = $this->db->get();
        return $query->result();

    }

    public function paperProcess($table, $processIds)
    {
        $userId = $this->session->userdata('user_id');
        $role = $this->session->userdata('role');
        $domain_id = domain_id_get();
        $this->db->from($table);
        $this->db->where_in('process_id', $processIds);
        if ($role != 1) {
            $this->db->where('uid', $userId);
             $this->db->where('uid_role', $role);
        }
        $this->db->where('domain_id',$domain_id);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function paperProcessData($table, $processIds)
    {
        $userId = $this->session->userdata('user_id');
        $role = $this->session->userdata('role');
        $domain_id = domain_id_get();
        $this->db->from($table);
        $this->db->where_in('process_id', $processIds);
        if ($role != 1) {
            $this->db->where('uid', $userId);
             $this->db->where('uid_role', $role);
        }
        $this->db->where('domain_id',$domain_id);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function digitalProcess($table, $processIds)
    {
        $userId = $this->session->userdata('user_id');
        $role = $this->session->userdata('role');
        $domain_id = domain_id_get();
        $this->db->from($table);
        $this->db->where_in('process_id ', $processIds);
        if ($role != 1) {
            $this->db->where('uid', $userId);
            $this->db->where('uid_role', $role);
        }
        $this->db->where('domain_id',$domain_id);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function digitalProcessData($table, $processIds)
    {
        $userId = $this->session->userdata('user_id');
        $role = $this->session->userdata('role');
        $domain_id = domain_id_get();
        $this->db->from($table);
        $this->db->where_in('process_id ', $processIds);
        if ($role != 1) {
            $this->db->where('uid', $userId);
             $this->db->where('uid_role', $role);
        }
        $this->db->where('domain_id',$domain_id);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function leadCountreject($table, $processIds)
    {
        $userId = $this->session->userdata('user_id');
        $role = $this->session->userdata('role');
        $domain_id = domain_id_get();
        $this->db->from($table);

        $this->db->where('domain_id',$domain_id);
        // if ($this->session->userdata('type') != 'admin') {
        // }
        $this->db->where_not_in('process_id ', $processIds);
        if ($role == 1) { // for admin
            $this->db->where('lead_status', 'Reject');
        } else {
            $this->db->where('uid', $userId);
             $this->db->where('uid_role', $role);
            $this->db->where('lead_status', 'Reject');
        }
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function leadreject($table, $processIds)
    {
        $userId = $this->session->userdata('user_id');
        $role = $this->session->userdata('role');
        $domain_id = domain_id_get();
        $this->db->from($table);

        $this->db->where('domain_id',$domain_id);
        // if ($this->session->userdata('type') != 'admin') {
        // }
        $this->db->where_not_in('process_id ', $processIds);
        if ($role == 1) { // for admin
            $this->db->where('lead_status', 'Reject');
        } else {
            $this->db->where('uid', $userId);
             $this->db->where('uid_role', $role);
            $this->db->where('lead_status', 'Reject');
        }
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function leadCountrejectpaper($table, $processIds)
    {
        $userId = $this->session->userdata('user_id');
        $role = $this->session->userdata('role');
        $domain_id = domain_id_get();
        $this->db->from($table);
        $this->db->where('domain_id',$domain_id);
        // if ($this->session->userdata('type') != 'admin') {
        // }
        $this->db->where_in('process_id ', $processIds);
        if ($role == 1) { // for admin
            $this->db->where('lead_status', 'Reject');
        } else {
            $this->db->where('uid', $userId);
             $this->db->where('uid_role', $role);
            $this->db->where('lead_status', 'Reject');
        }
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function leadrejectpaper($table, $processIds)
    {
        $userId = $this->session->userdata('user_id');
        $role = $this->session->userdata('role');
        $domain_id = domain_id_get();
        $this->db->from($table);
        $this->db->where('domain_id',$domain_id);
        // if ($this->session->userdata('type') != 'admin') {
        // }
        $this->db->where_in('process_id ', $processIds);
        if ($role == 1) { // for admin
            $this->db->where('lead_status', 'Reject');
        } else {
            $this->db->where('uid', $userId);
             $this->db->where('uid_role', $role);
            $this->db->where('lead_status', 'Reject');
        }
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function countreferralAmount($uid, $subStatus = null)
    {
        $table = 'user_master';
        $this->db->select_sum('referral_amount');
        $this->db->from($table);
        $this->db->where('role', 2);
        $this->db->where('status !=', 2);
        $this->db->where('parent_id', $uid);
        if (empty($subStatus)) {
            $this->db->where('subscription', '');
        } else {
            $this->db->where('subscription !=', '');
        }

        $this->db->order_by("id", "DESC");
        $query = $this->db->get();
        return $query->result();

    }

    public function loanCount($table)
    {
        $userId = $this->session->userdata('user_id');
        $role = $this->session->userdata('role');

        $domain_id = domain_id_get();
        $this->db->from($table);
        $this->db->where('domain_id',$domain_id);
        if ($role == 1) {
            $this->db->where('status', 1);
        } else {
            $this->db->where('status', 1);
            $this->db->where('user_id', $userId);
        }
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function loandata($table)
    {
        $userId = $this->session->userdata('user_id');
        $role = $this->session->userdata('role');

        $domain_id = domain_id_get();
        $this->db->from($table);

        $this->db->where('domain_id',$domain_id);
        // if ($this->session->userdata('type') != 'admin') {
        // }
        if ($role == 1) {
            $this->db->where('status', 1);
        } else {
            $this->db->where('status', 1);
            $this->db->where('user_id', $userId);
        }
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function loanCountapporve($table)
    {
        $userId = $this->session->userdata('user_id');
        $role = $this->session->userdata('role');
        $this->db->from($table);
        if ($role == 1) { // for admin
            $this->db->where('status', 1);
            $this->db->where('lead_staus', 'apporved');
        } else {
            $this->db->where('status', 1);
            $this->db->where('user_id', $userId);
            $this->db->where('lead_staus', 'apporved');
        }
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function loanCountreject($table)
    {
        $userId = $this->session->userdata('user_id');
        $role = $this->session->userdata('role');
        $domain_id = domain_id_get();
        $this->db->from($table);
        $this->db->where('domain_id',$domain_id);
        // if ($this->session->userdata('type') != 'admin') {
        // }
        if ($role == 1) { // for admin
            $this->db->where('status', 1);
            $this->db->where('lead_staus', 'rejected');
        } else {
            $this->db->where('status', 1);
            $this->db->where('user_id', $userId);
            $this->db->where('lead_staus', 'rejected');
        }
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function loanreject($table)
    {
        $userId = $this->session->userdata('user_id');
        $role = $this->session->userdata('role');
        $domain_id = domain_id_get();
        $this->db->from($table);
        $this->db->where('domain_id',$domain_id);
        // if ($this->session->userdata('type') != 'admin') {
        // }
        if ($role == 1) { // for admin
            $this->db->where('status', 1);
            $this->db->where('lead_staus', 'rejected');
        } else {
            $this->db->where('status', 1);
            $this->db->where('user_id', $userId);
            $this->db->where('lead_staus', 'rejected');
        }
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function countAndSumData($table, $table1)
    {
        $userId = $this->session->userdata('user_id');
        $role = $this->session->userdata('role');
        $this->db->select('SUM(' . $table1 . '.payment_amount_paid) AS total_payouts, SUM(' . $table1 . '.disbursed) AS total_disbursements');
        $this->db->from($table);
        $this->db->join($table1, "$table.id = $table1.user_id");
        if ($role != 1) {

            $this->db->where("$table1.user_id", $userId);
        }
        $query = $this->db->get();

        return $query->row();
    }

    public function countAndSumDatasss($table, $table1)
    {
        $userId = $this->session->userdata('user_id');
        $this->db->select('SUM(' . $table1 . '.payment_amount_paid_team) AS total_payouts, SUM(' . $table1 . '.disbursed_team) AS total_disbursements');
        $this->db->from($table);
        $this->db->join($table1, "$table.id = $table1.user_id");
        $this->db->where("$table1.user_id", $userId);

        // if ($userId == 1) {
        //     $this->db->where("$table.parent_id", $userId);
        // }
        // else {
        //     // $this->db->where("$table.parent_id", $userId);

        // }
        $query = $this->db->get();

        return $query->row();
    }

    public function loan_company_master_get()
    {
        $table = 'loan_company_master';
        $domain_id = domain_id_get();
        $this->db->from($table);

        
        $this->db->where('domain_id',$domain_id);
    // if ($this->session->userdata('type') != 'admin') {
    //     }

        $this->db->order_by("id", "DESC");
        $this->db->where('status', 1);
        
        $query = $this->db->get();
        return $query->result();

    }

    public function update_status_loan($id)
    {
        $data = array(
            'status' => 0,
        );
        $this->db->where('id', $id);
        $this->db->update('loan_company_master', $data);
    }

    public function common_delete($id, $table)
    {
        $this->db->where('id', $id);
        $this->db->delete($table);
    }
    

}
