<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DomainCheck {

public function validate_domain()
{
    // Allow CLI
    if (php_sapi_name() === 'cli') {
        return true;
    }

    $CI =& get_instance();

    // If CodeIgniter core not loaded
    if (!is_object($CI) || !is_object($CI->load)) {
        return true;
    }

    // Build current domain
    $current_domain = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http")
                      . "://" . $_SERVER['HTTP_HOST'] . '/';

    log_message('debug', 'DomainCheck - Current domain: ' . $current_domain);

    // Load DB if not loaded
    if (!isset($CI->db) || !is_object($CI->db)) {
        try {
            $CI->load->database();
        } catch (Exception $e) {
            log_message('error', 'DomainCheck: DB load fail - ' . $e->getMessage());
            return true;
        }
    }

    $CI->load->helper('url');

    $current_uri = trim(uri_string(), '/');

    // -------------------------------------------
    // 1️⃣ Always allow accessdenied page itself
    // -------------------------------------------
    if (stripos($current_uri, 'accessdenied') === 0) {
        return true;
    }

    // -------------------------------------------
    // 2️⃣ Block any desk-login related URL
    // -------------------------------------------
    if (stripos($current_uri, 'desk-login') !== false) {
        log_message('debug', 'DomainCheck - Blocking desk-login route: ' . $current_uri);
        $this->show_access_denied();
        return false;
    }

    // -------------------------------------------
    // 3️⃣ Allowed URIs (bypass)
    // -------------------------------------------
    $bypass = [
        'accessdenied',
        'accessdenied/index',
        'domains',
        'login',
        'assets',
        'images',
        'css',
        'js',
        'fonts',
        'uploads',
        'api',
        'index.php/accessdenied'
    ];

    foreach ($bypass as $bp) {
        $bp = trim($bp, '/');
        if ($current_uri === $bp || strpos($current_uri, $bp) === 0) {
            log_message('debug', 'DomainCheck - Bypass URI: ' . $current_uri);
            return true;
        }
    }

    // -------------------------------------------
    // 4️⃣ Validate domain status
    // -------------------------------------------
    $domain = $CI->db->get_where('domains', ['url' => $current_domain])->row();

    log_message('debug', 'DomainCheck - Domain record: ' . print_r($domain, true));

    if (!$domain) {
        log_message('error', 'DomainCheck - Domain not found: ' . $current_domain);
        $this->show_access_denied();
        return false;
    }

    if ($domain->status != 1) {
        log_message('error', 'DomainCheck - Domain inactive: ' . $current_domain);
        $this->show_access_denied();
        return false;
    }

    return true;
}

private function show_access_denied()
{
    $current_uri = trim(uri_string(), '/');

    if (stripos($current_uri, 'accessdenied') === false) {
        redirect(base_url('accessdenied'));
        exit();
    }
}

}
