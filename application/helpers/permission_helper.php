<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('has_permission')) {
    
    function has_permission($permission) {
        $CI =& get_instance();
        $CI->load->database();

        // $current_domain = $_SERVER['HTTP_HOST'];
        $current_domain = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http");
        $current_domain .= "://" . $_SERVER['HTTP_HOST'] . '/';
        $domain = $CI->db->get_where('domains', ['url' => $current_domain,'status'=> 1])->row();
        $permissions = $CI->db->get_where('roles', ['permission' => $permission])->row();

        if (!$domain) {
            return false; 
        }
        if (!$permissions) {
            return false; 
        }

        $domain_id = $domain->id;
        $permissions = $permissions->id;
        $query = $CI->db->get_where('permissions', [
            'permission' => $permissions,
            'domain_id' => $domain_id
        ]);

        return $query->num_rows() > 0;
    }

    if (!function_exists('domain_id_get')) {
    function domain_id_get()
    {
        $CI =& get_instance();

        $current_domain = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http");
        $current_domain .= "://" . $_SERVER['HTTP_HOST'] . '/';

        $query = $CI->db->get_where('domains', ['url' => $current_domain, 'status'=>1])->row();
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
        //  echo '<pre>';   print_r($config_row);die;

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
}
?>
