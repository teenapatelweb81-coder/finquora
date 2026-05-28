<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Page_Model extends CI_Model

{

    // Check customer login

    // public function customer_chk($email, $password)

    // {

    //     $this->db->where('email', $email);

    //     $this->db->where('password', $password);

    //     $this->db->where('status', 1);

    //     $this->db->from('registerUser');

    //     $query = $this->db->get();



    //     return ($query->num_rows() == 1) ? $query->row() : false;

    // }

    

    

    public function customer_chk($email)

{

    // Query the database for user data by email
$domain_id = domain_id_get();
    $this->db->where('email', $email);

    $this->db->where('status', 1); 
    $this->db->where('domain_id', $domain_id); 

    $query = $this->db->get('registerUser');



    return ($query->num_rows() == 1) ? $query->row() : false;

}


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


    // Get data with email from dynamic table

    public function get_data_with_email($email, $dbname)

    {

        $this->db->where('email', $email);

        $query = $this->db->get($dbname);  // No need to use $this->db->from() here

        return ($query->num_rows() == 1) ? $query->row() : false;

    }



    // Check if email exists in a table

    public function check_email($email, $dbname)

    {

        $this->db->where('email', $email);

        $query = $this->db->get($dbname);

        return ($query->num_rows() == 1);

    }



    // Check if emailId exists for agent or user

    public function check_emailId($emailId, $userType, $domain_row)

    {

        $domain_row = domain_id_get();
        $dbname = ($userType == "agent") ? "user_master" : "registerUser";

        $this->db->where('email', $emailId);
        $this->db->where('domain_id', $domain_row);

        $query = $this->db->get($dbname);

        return ($query->num_rows() == 1);

    }



    // Update password for user

    public function update_password($email, $data, $dbName)

    {

        return $this->db->where('email', $email)->update($dbName, $data);

    }



    // Get plan data by plan_id

    public function plan_data($plan_id)

    {
$domain_id = domain_id_get();
        $this->db->select('*');

        $this->db->from('plan_tbl');

        $this->db->where(['domain_id'=> $domain_id ,'plan_type' =>$plan_id]);

        $query = $this->db->get();
// print_r($query->result() );die;
        return $query->result();

    }

    public function get_domain_by_url($current_domain)
    {
        $this->db->select('*');
        $this->db->from('domains');
        $query = $this->db->get();

        foreach ($query->result() as $row) {
            $parsed_url = parse_url($row->url, PHP_URL_HOST);
            $parsed_url = preg_replace('/^www\./', '', $parsed_url);

            if ($parsed_url == $current_domain) {
                return $row;
            }
        }

        return false;
    }  

    

    // Get payment data for Silver or other plans

    public function get_payment_data($plan_id, $pid )

    {
$domain_id = domain_id_get();
        $this->db->select(($plan_id == "Silver") ? 'amount' : 'amount2');
        $this->db->where('domain_id', $domain_id);
        $this->db->from('plan_tbl');

        if ($plan_id == "Silver") {

            $this->db->where('plan_name', $plan_id);

        } else {

            $this->db->where('plan2_name', $plan_id);

        }

        $this->db->where('id', $pid);
      
        $query = $this->db->get();

        return $query->row();

    }



    // Update data for a specific table

    public function update_data($uid, $data, $dbName)

    {

        return $this->db->where('id', $uid)->update($dbName, $data);

    }



    // Insert data into any table
public function insert_data($data, $dbname)
{    
    $domain_id = domain_id_get();
    $domain = $this->db->where('id', $domain_id)->get('domains')->row_array();

    if (
        in_array($dbname, ['user_master', 'registerUser', 'branch_franchise']) 
        && isset($data['email']) 
        && !empty($data['email'])
    ) {
        // Prepend "Unpaid--" only if domain not found or payment_status != 'free'
        $data['email'] = ((!$domain || strtolower($domain['payment_status']) !== 'free') ? 'Unpaid--' : '') . $data['email'];

        $data['status'] = 2;  // Set status to 2
    }

    $this->db->insert($dbname, $data);

    return ($this->db->affected_rows() > 0) ? $this->db->insert_id() : false;
}




    // Get common data from any table

    public function common_alls($table)

    {

        $this->db->from($table);

        $this->db->order_by("id", "DESC");

        $query = $this->db->get();

        return $query->result();

    }



    // Insert transaction data into the transaction table

    public function insert_transaction($data)

    {

        $this->db->insert('tbl_transection', $data);

        return ($this->db->affected_rows() > 0) ? $this->db->insert_id() : false;

    }



    // Update transaction data for a given payment ID

    public function update_transaction($transaction_id, $data)

    {

        $this->db->where('payment_id', $transaction_id);

        $this->db->update('tbl_transection', $data);

        return ($this->db->affected_rows() > 0);

    }



    // Get transaction data by payment ID

    public function get_transaction_data($txid)

    {

        $this->db->select('*');

        $this->db->from('tbl_transection');

        $this->db->where('payment_id', $txid);

        $this->db->where('pass_json !=', 'NULL');

        $query = $this->db->get();

        return $query->row();

    }



    // Get unpaid user data

    public function get_unpaid_user_data($uid)

    {

        $this->db->select('*');

        $this->db->from('user_master');  // You might want to change this dynamic

        $this->db->where('id', $uid);

        $this->db->where('status', '2');

        $query = $this->db->get();

        return $query->row();

    }

}

?>

