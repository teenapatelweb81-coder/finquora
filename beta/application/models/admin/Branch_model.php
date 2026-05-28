<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Branch_model extends CI_Model {
    
    private $table = 'branch_locations';
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
   public function get_branches()
{
    // ($this->session->userdata('type') != 'admin')
    //     ?
    //     : '';
        
    $this->db->where('domain_id', domain_id_get());
    $this->db->order_by('id', 'DESC');
    return $this->db->get($this->table)->result_array();
}

    
    public function get_branch($id) {
        return $this->db->get_where($this->table, ['id' => $id])->row_array();
    }
    
    public function add_branch($data) {
        $branch_data = [
            'branch_name' => $data['branch_name'],
            'contact_person' => $data['contact_person'],
            'email' => $data['email'],
            'mobile' => $data['mobile'],
            'address' => $data['address'],
            'city' => $data['city'],
            'state' => $data['state'],
            'pincode' => $data['pincode'],
            'country' => !empty($data['country']) ? $data['country'] : 'India',
            'short_description' => $data['short_description'] ?? null,
            'long_description' => $data['long_description'] ?? null,
            'branch_date' => !empty($data['branch_date']) ? date('Y-m-d', strtotime($data['branch_date'])) : date('Y-m-d'),
            'status' => isset($data['status']) ? 1 : 0,
            'domain_id' => $data['domain_id'],
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        
        // Handle image upload if exists
        if (!empty($_FILES['branch_image']['name'])) {
            $upload_path = './upload/assets/images/';
            if (!is_dir($upload_path)) {
                mkdir($upload_path, 0777, true);
            }
            
            $config['upload_path'] = $upload_path;
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size'] = 2048; // 2MB
            $config['file_name'] = 'branch_' . time() . '_' . rand(1000, 9999);
            
            $this->load->library('upload', $config);
            
            if ($this->upload->do_upload('branch_image')) {
                $upload_data = $this->upload->data();
                $branch_data['branch_image'] = $upload_data['file_name'];
            }
        }
        
        return $this->db->insert($this->table, $branch_data);
    }
    
    public function update_branch($id, $data) {
        $branch = $this->get_branch($id);
        $branch_data = [
            'branch_name' => $data['branch_name'],
            'contact_person' => $data['contact_person'],
            'email' => $data['email'],
            'mobile' => $data['mobile'],
            'address' => $data['address'],
            'city' => $data['city'],
            'state' => $data['state'],
            'pincode' => $data['pincode'],
            'domain_id' => $data['domain_id'],
            'country' => !empty($data['country']) ? $data['country'] : 'India',
            'short_description' => $data['short_description'] ?? null,
            'long_description' => $data['long_description'] ?? null,
            'branch_date' => !empty($data['branch_date']) ? date('Y-m-d', strtotime($data['branch_date'])) : date('Y-m-d'),
            'status' => isset($data['status']) ? 1 : 0,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        
        $upload_path = FCPATH . 'upload/assets/images/';
        
        // Handle image upload if exists
        if (!empty($_FILES['branch_image']['name'])) {
            // Create directory if it doesn't exist
            if (!is_dir($upload_path)) {
                if (!mkdir($upload_path, 0777, true)) {
                    log_message('error', 'Failed to create directory: ' . $upload_path);
                    return false;
                }
                // Set directory permissions
                chmod($upload_path, 0777);
            }
            
            $config = [
                'upload_path' => $upload_path,
                'allowed_types' => 'jpg|jpeg|png|gif',
                'max_size' => 2048, // 2MB
                'file_name' => 'branch_' . time() . '_' . rand(1000, 9999),
                'overwrite' => false,
                'remove_spaces' => true
            ];
            
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            
            if ($this->upload->do_upload('branch_image')) {
                // Delete old image if exists
                if (!empty($branch['branch_image']) && file_exists($upload_path . $branch['branch_image'])) {
                    @unlink($upload_path . $branch['branch_image']);
                }
                $upload_data = $this->upload->data();
                $branch_data['branch_image'] = $upload_data['file_name'];
            } else {
                log_message('error', 'Upload Error: ' . $this->upload->display_errors());
            }
        } elseif (isset($data['remove_image']) && $data['remove_image'] == 1) {
            // Remove image if remove_image is checked
            if (!empty($branch['branch_image']) && file_exists($upload_path . $branch['branch_image'])) {
                @unlink($upload_path . $branch['branch_image']);
            }
            $branch_data['branch_image'] = null;
        }
        $this->db->where('id', $id);
        return $this->db->update($this->table, $branch_data);
    }
    
    public function delete_branch($id) {
        // Delete associated image if exists
        $branch = $this->get_branch($id);
        if (!empty($branch['branch_image'])) {
            $upload_path = './upload/assets/images/';
            if (file_exists($upload_path . $branch['branch_image'])) {
                unlink($upload_path . $branch['branch_image']);
            }
        }
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }
    
    public function update_status($id, $status) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, ['status' => $status]);
    }
}
