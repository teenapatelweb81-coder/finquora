<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Get all products
    public function get_all_products($domain_id = NULL)
    {
        $this->db->order_by('id', 'DESC');
        if ($domain_id) {
            $this->db->where('domain_id', $domain_id);
        }
        return $this->db->get('products')->result();
    }

    // Get product by ID
    public function get_product_by_id($id)
    {
        return $this->db->where('id', $id)->get('products')->row();
    }

    // Insert new product
    public function insert_product($data)
    {
        return $this->db->insert('products', $data);
    }

    // Update product
    public function update_product($id, $data)
    {
        return $this->db->where('id', $id)->update('products', $data);
    }

    // Delete product
    public function delete_product($id)
    {
        return $this->db->where('id', $id)->delete('products');
    }

    // Get active products for frontend
    public function get_active_products($domain_id = NULL)
    {
        $this->db->where('status', 1);
        $this->db->order_by('id', 'DESC');
        if ($domain_id) {
            $this->db->where('domain_id', $domain_id);
        }
        return $this->db->get('products')->result();
    }

    // Get hero banner
    public function get_hero_banner($id)
    {
        return $this->db->where('id', $id)->get('product_hero_banner')->row();
    }
    
    // Update hero banner
    public function update_hero_banner($id, $data)
    {
        return $this->db->where('id', $id)->update('product_hero_banner', $data);
    }
    
    // Insert hero banner
    public function insert_hero_banner($data)
    {
        return $this->db->insert('product_hero_banner', $data);
    }
}
