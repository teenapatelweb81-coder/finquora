<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'libraries/razorpay/Razorpay.php';
include APPPATH . 'third_party/vendor/autoload.php';

use Razorpay\Api\Api;

class Rolepermission extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->model('admin/Dashboard_Model');
        $this->load->model('admin/User_model','A');
        $this->load->library('upload');
        $this->logged_in();
    }

    private function logged_in()
    {
        if (!$this->session->userdata('authenticated')) {
            redirect('desk-login');

        }
    }

    // public function permission()
    // { 
    //     if ($this->session->userdata('type') != 'admin') {
    //         $this->session->set_flashdata('message', 'You do not have permission to access this section.');
    //         redirect('admin-dashboard');
    //         return;
    //         }
    //     $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
    //     $data['permission'] = $this->db->get('roles')->result_array();
    //     // echo "<pre>";print_r($data['permission']);die;
    //     $this->load->view('admin/template/header');
    //     $this->load->view('admin/permission/view', $data);
    //     $this->load->view('admin/template/footer');
    // }
   public function permission()
{
    if ($this->session->userdata('type') != 'admin') {
        $this->session->set_flashdata('message', 'You do not have permission to access this section.');
        redirect('admin-dashboard');
        return;
    }

    $roles_raw = $this->db->get('roles')->result_array();
        $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();

    // Step 1: Create a map of all roles
    $roleMap = [];
    foreach ($roles_raw as $role) {
        $role['children'] = [];
        $roleMap[$role['id']] = $role;
    }

    // Step 2: Organize roles into a hierarchy
    $tree = [];
    foreach ($roleMap as $id => &$role) {
        if ($role['parent_id']) {
            if (isset($roleMap[$role['parent_id']])) {
                $roleMap[$role['parent_id']]['children'][] = &$role;
            }
        } else {
            $tree[] = &$role;
        }
    }

    $data['roles'] = $tree;

    $this->load->view('admin/template/header');
    $this->load->view('admin/permission/view', $data);
    $this->load->view('admin/template/footer');
}

   public function menu_position()
{
    if ($this->session->userdata('type') != 'admin') {
        $this->session->set_flashdata('message', 'You do not have permission to access this section.');
        redirect('admin-dashboard');
        return;
    }

    $data['roles'] = $this->db->where( array('domain_id' => 3))->get('menu_possition')->row_array();
    $this->load->view('admin/template/header');
    $this->load->view('admin/permission/menuposition', $data);
    $this->load->view('admin/template/footer');
}

public function update_menu_position()
{
     if ($this->session->userdata('type') != 'admin') {
        $this->session->set_flashdata('message', 'You do not have permission to access this section.');
        redirect('admin-dashboard');
        return;
    }
    $menus     = $this->input->post('menus');
    $role_id   = $this->input->post('role_id');
    $domain_id = $this->input->post('domain_id');

    if (!empty($menus)) {

        $this->db->where('id', $role_id);
        $this->db->where('domain_id', $domain_id);
        $this->db->update('menu_possition', $menus);

        echo json_encode(['status' => 'success']);
    }
}




    public function update_permission() {
        $domain_id = $this->input->post('domain_id');
        $permissions = $this->input->post('permissions');
        // print_r($permissions);die;

        if (empty($domain_id)) {
            $this->session->set_flashdata('error', 'Please select a domain first. This will help us which domains you want to give permission.');
            redirect('admin/permission');
        }
        $this->db->where('domain_id', $domain_id);
        $this->db->delete('permissions');

        if (!empty($permissions)) {
            foreach ($permissions as $perm) {
                $this->db->insert('permissions', [
                    'domain_id' => $domain_id,
                    'permission' => $perm
                ]);
            }
        }

        $this->session->set_flashdata('success', 'Permissions updated successfully.');
        redirect('admin/permission');
    }


    public function get_permissions() {
        $domain_id = $this->input->post('domain_id');
        $permissions = $this->db->get('permissions')->result_array();

        $query = $this->db->select('permission')->where('domain_id', $domain_id)->get('permissions');
        $assigned_permissions = array_column($query->result_array(), 'permission');
        echo json_encode($assigned_permissions);
    }

    
    public function domain()
    { 
        if ($this->session->userdata('type') != 'admin') {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            }
        //$data['domains'] = $this->db->where('status', 1)->get('domains')->result();
        $data['domains'] = $this->db->where_in('status', [1, 2])->get('domains')->result();
        $this->load->view('admin/template/header');
        $this->load->view('admin/domain/view', $data);
        $this->load->view('admin/template/footer');
    }

    public function domain_add()
    {
        if ($this->session->userdata('type') != 'admin') {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            }
        $this->load->view('admin/template/header');
        $this->load->view('admin/domain/form');
        $this->load->view('admin/template/footer');
    }

    public function domainCreate()
    {
        if ($this->session->userdata('type') != 'admin') {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            }
        $post = $this->input->post();
        $data = array(
            'url' => $post['url'],
            'payment_status' => $post['payment_status'],
            'social_status' => $post['social_status'],
        );
        $insert = $this->Dashboard_Model->common_insert($data, 'domains');
    
        if ($insert) {
            $this->session->set_flashdata('success', 'Domains has been Created Successfully!!');
            redirect('admin/domain');
        } else {
        $this->session->set_flashdata('error', 'Something Went Wrong, try again!!');
        redirect('admin/domain-add');
        }
    }

    public function domain_edit($id)
    {
        if ($this->session->userdata('type') != 'admin') {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            }
        $data['datas'] = $this->Dashboard_Model->common_row($id, 'domains');
        $this->load->view('admin/template/header');
        $this->load->view('admin/domain/edit', $data);
        $this->load->view('admin/template/footer');
    }

    public function domainUpdate()
    {
        if ($this->session->userdata('type') != 'admin') {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            }
        $post = $this->input->post();
        $id = $post['id'];
        unset($post['id']);
        $data = array(
            'url' => $post['url'],
            'payment_status' => $post['payment_status'],
            'social_status' => $post['social_status'],
            'status' => $post['status']
        );
        $update = $this->Dashboard_Model->common_update($id, $data, 'domains');
        if ($update) {
            redirect('admin/domain');
        } else {
            redirect('admin/domain-edit/'.$id);
        }
    }

    public function domainDel($id)
    { 
        if ($this->session->userdata('type') != 'admin') {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            }
        $domains = $this->db->where('id', $id)->delete('domains');
        if ($domains) {
            $this->session->set_flashdata('success', 'Domains deleted successfully');
            redirect('admin/domain');
        } else {
            $this->session->set_flashdata('error', 'Something went wrong, try again!!');
            redirect('admin/domain');
        }
    }

}
