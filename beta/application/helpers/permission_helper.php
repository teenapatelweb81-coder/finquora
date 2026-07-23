<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('has_permission')) {
    
    function has_permission($permission) {
        $CI =& get_instance();
        $CI->load->database();
        $CI->load->helper('url');

        // Check if user is logged in and get user data
        $user_id = $CI->session->userdata('user_id');
        $role = $CI->session->userdata('role');
        if ($user_id) {
            if($role == 3){
                $user = $CI->db->get_where('branch_franchise', ['id' => $user_id])->row();
            }else{
                $user = $CI->db->get_where('user_master', ['id' => $user_id])->row();
            }
            
            // Check if user has parent_id_role = 1, if yes, return false for agreement flow
            if (isset($user->parent_id_role) && $user->parent_id_role == 1) {
                return true;
            }
            
            // Check for role 3 (franchise) and verify agreement status and signature
            if (isset($user->role) && $user->role == 3) {
                $franchise = $CI->db->get_where('branch_franchise', [
                    'id' => $user_id,
                    'agreement_status' => 'approved',
                    'signature IS NOT NULL' => NULL
                ])->row();
                
                if (!$franchise) {
                    return false;
                }
            }elseif( isset($user->role) && $user->role == 2) {
                $user_master = $CI->db->get_where('user_master', [
                    'id' => $user_id,
                    'agreement_status' => 'approved',
                    'signature IS NOT NULL' => NULL
                ])->row();
                
                if (!$user_master) {
                    return false;
                }
            }
        }

        $current_domain = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http");
        $current_domain .= "://" . $_SERVER['HTTP_HOST'] . '/';
        $domain = $CI->db->get_where('domains', ['url' => $current_domain, 'status' => 1])->row();
        
        // If domain not found or status is not active, destroy session and redirect to access_denied
        if (!$domain) {
            $CI->session->sess_destroy();
            redirect('accessdenied');
            exit;
        }
        
        $permissions = $CI->db->get_where('roles', ['permission' => $permission])->row();
        
        if (!$permissions) {
            return false; 
        }

        // $domain_id = $domain->id;
        // $permissions = $permissions->id;
        // $query = $CI->db->get_where('permissions', [
        //     'permission' => $permissions,
        //     'domain_id' => $domain_id
        // ]);

        // return $query->num_rows() > 0;

        $domain_id = $domain->id;
        $permission_id = $permissions->id;

        // Check if current user has any custom permissions
        $has_custom_permission = $CI->db
            ->where('user_id', $user_id)
            ->where('role', $role)
            ->count_all_results('permissions');

        if ($has_custom_permission > 0) {

            // User has custom permissions
            $query = $CI->db->get_where('permissions', [
                'permission' => $permission_id,
                'domain_id'  => $domain_id,
                'user_id'    => $user_id,
                'role'       => $role
            ]);

            return ($query->num_rows() > 0);

        } else {

            // Existing permission system
            $query = $CI->db->get_where('permissions', [
                'permission' => $permission_id,
                'domain_id'  => $domain_id
            ]);

            return ($query->num_rows() > 0);

        }
    }

 if (!function_exists('domain_id_get')) {
    function domain_id_get()
    {
        $CI =& get_instance();

        $current_domain = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http");
        $current_domain .= "://" . $_SERVER['HTTP_HOST'] . '/';

        $query = $CI->db->get_where('domains', ['url' => $current_domain,'status'=>1])->row();
        return $query ? $query->id : null;
    }
}

if (!function_exists('send_mail')) {
    function send_mail($to, $subject, $message)
    {
        $ci =& get_instance();
        $ci->load->database();

        // Get domain id
        $domain_id = domain_id_get();

        if (!$domain_id) {
            log_message('error', 'Domain not found in domains table');
            return false;
        }

        // Fetch email config for that domain
        $config_row = $ci->db
            ->where('domain_id', $domain_id)
            ->get('email_config')
            ->row_array();

        if (!$config_row) {
            log_message('error', 'Email configuration not found for domain_id: ' . $domain_id);
            return false;
        }

        // Prepare config
        $config = array(
            'protocol'  => $config_row['protocol'],
            'mailpath'  => $config_row['mailpath'],
            'smtp_host' => $config_row['smtp_host'],
            'smtp_port' => $config_row['smtp_port'],
            'smtp_user' => $config_row['smtp_user'],
            'smtp_pass' => $config_row['smtp_pass'],
            'mailtype'  => $config_row['mailtype'],
            'charset'   => $config_row['charset'],
        );

        $ci->load->library('email', $config);
        $ci->email->set_newline("\r\n");

        $ci->email->from($config_row['from_email'], $config_row['from_name']);
        $ci->email->to(trim($to));
        $ci->email->subject($subject);
        $ci->email->message($message);

        if ($ci->email->send()) {
            return true;
        } else {
            log_message('error', $ci->email->print_debugger());
            return false;
        }
    }

}

if (!function_exists('get_all_child_roles')) {

    function get_all_child_roles($parent_id)
    {
        $CI =& get_instance();

        $ids = [$parent_id];

        $children = $CI->db
            ->where('parent_id', $parent_id)
            ->get('roles')
            ->result();

        foreach ($children as $child) {

            $ids = array_merge($ids, get_all_child_roles($child->id));

        }

        return $ids;
    }

}


}
?>
