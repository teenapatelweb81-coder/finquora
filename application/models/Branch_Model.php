<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Branch_Model extends CI_Model {
    
    public function get_active_branches($domain_id) {
        $this->db->where('status', 1);
        $this->db->where('domain_id', $domain_id);
        $this->db->order_by('branch_name', 'ASC');
        return $this->db->get('branch_locations')->result_array();
    }
    
    public function add_branch($data) {
        return $this->db->insert('branch_locations', $data);
    }
    
    public function get_branch($id, $domain_id) {
        $this->db->where('id', $id);
        $this->db->where('domain_id', $domain_id);
        return $this->db->get('branch_locations')->row_array();
    }
    
    public function update_branch($id, $data, $domain_id) {
        $this->db->where('id', $id);
        $this->db->where('domain_id', $domain_id);
        return $this->db->update('branch_locations', $data);
    }

    public function get_branches_for_homepage($domain_id) {
        $this->db->where('status', 1);
        $this->db->where('domain_id', $domain_id);
        $this->db->order_by('branch_name', 'ASC');
        return $this->db->get('branch_locations')->result_array();
    }
}
