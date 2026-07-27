<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('admin/Product_model');
        $this->load->model('admin/Dashboard_Model');
        $this->load->library('upload');
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->logged_in();
    }

    private function logged_in()
    {
        if (!$this->session->userdata('authenticated')) {
            redirect('desk-login');
        }
    }

    // List all products
    public function index()
    {
        if (($this->session->userdata('type') == 'admin') || has_permission('Products')) {
            $data['products'] = $this->Product_model->get_all_products();
            $data['domains'] = $this->db->where('status', 1)->get('domains')->result_array();
            
            $this->load->view('admin/template/header');
            $this->load->view('admin/product/list', $data);
            $this->load->view('admin/template/footer');
        } else {
            $this->load->view('access_denied');
        }
    }

    // Add new product form
    public function add()
    {
        if (($this->session->userdata('type') == 'admin') || has_permission('Products')) {
            $data['domains'] = $this->db->where('status', 1)->get('domains')->result_array();
            
            $this->load->view('admin/template/header');
            $this->load->view('admin/product/form', $data);
            $this->load->view('admin/template/footer');
        } else {
            $this->load->view('access_denied');
        }
    }

    // Edit product form
    public function edit($id)
    {
        if (($this->session->userdata('type') == 'admin') || has_permission('Products')) {
            $data['product'] = $this->Product_model->get_product_by_id($id);
            $data['domains'] = $this->db->where('status', 1)->get('domains')->result_array();
            
            $this->load->view('admin/template/header');
            $this->load->view('admin/product/form', $data);
            $this->load->view('admin/template/footer');
        } else {
            $this->load->view('access_denied');
        }
    }

    // Save/Update product
    public function save()
    {
        if (($this->session->userdata('type') == 'admin') || has_permission('Products')) {
            $this->form_validation->set_rules('name', 'Product Name', 'required|trim');
            $this->form_validation->set_rules('amount', 'Amount', 'required|trim');
            $this->form_validation->set_rules('benefit', 'Benefit', 'required|trim');
            $this->form_validation->set_rules('description', 'Description', 'required|trim');
            $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error', validation_errors());
                redirect($_SERVER['HTTP_REFERER']);
            }

            $id = $this->input->post('id');

             $olddata = $this->db->where('id', $id)->get('products')->row();
            if ($_FILES["logo"]["size"] > 0) {
                $tmpFilePath = $_FILES['logo']['tmp_name'];
                $fileinfo = @getimagesize($_FILES["logo"]["tmp_name"]);
                $image_file_type = pathinfo($_FILES["logo"]["name"], PATHINFO_EXTENSION);
                $newFilePath = 'upload/assets/' . time() . '.' . $image_file_type;
                if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                    $logo = $newFilePath;
                }
            }else{
                $logo  =  $olddata->logo; 
            }
            
            $data = [
                'name' => $this->input->post('name'),
                'logo' => $logo,
                'loan_type' => $this->input->post('loan_type'),
                'amount' => $this->input->post('amount'),
                'benefit' => $this->input->post('benefit'),
                'description' => $this->input->post('description'),
                'approval_time' => $this->input->post('approval_time'),
                'processing_fee' => $this->input->post('processing_fee'),
                'benefits' => $this->input->post('benefits'),
                'how_it_works' => $this->input->post('how_it_works'),
                'terms' => $this->input->post('terms'),
                'target_customers' => $this->input->post('target_customers'),
                'copy_link' => $this->input->post('copy_link'),
                'sell_link' => $this->input->post('sell_link'),
                'cibil_check_link' => $this->input->post('cibil_check_link'),
                'status' => $this->input->post('status') ? 1 : 0,
                'domain_id' => 3,
            ];

            if ($id) {
                // Update existing product
                $result = $this->Product_model->update_product($id, $data);
                $message = $result ? 'Product updated successfully!' : 'Something went wrong!';
            } else {
                // Insert new product
                $result = $this->Product_model->insert_product($data);
                $message = $result ? 'Product added successfully!' : 'Something went wrong!';
            }

            $this->session->set_flashdata('success', $message);
            redirect('admin/product');
        } else {
            $this->load->view('access_denied');
        }
    }

    // Delete product
    public function delete($id)
    {
        if (($this->session->userdata('type') == 'admin') || has_permission('Products')) {
            $result = $this->Product_model->delete_product($id);
            $message = $result ? 'Product deleted successfully!' : 'Something went wrong!';
            $this->session->set_flashdata('success', $message);
            redirect('admin/product');
        } else {
            $this->load->view('access_denied');
        }
    }

    // Toggle status
    public function toggle_status($id)
    {
        if (($this->session->userdata('type') == 'admin') || has_permission('Products')) {
            $product = $this->Product_model->get_product_by_id($id);
            $new_status = $product->status == 1 ? 0 : 1;
            $this->Product_model->update_product($id, ['status' => $new_status]);
            $this->session->set_flashdata('success', 'Status updated successfully!');
            redirect('admin/product');
        } else {
            $this->load->view('access_denied');
        }
    }

    // Edit hero banner
   public function view_hero_banner()
    {
        $data['banner'] = $this->Product_model->get_hero_banner(1);
         $this->load->view('admin/template/header');
            $this->load->view('admin/product/edit-hero-banner', $data);
            $this->load->view('admin/template/footer');
    }

    // Update hero banner
    // ===================== UPDATE =====================
    public function update_hero_banner()
    {

        // Validation Rules
        $this->form_validation->set_rules('badge_text', 'Badge Text', 'trim|max_length[255]');
        $this->form_validation->set_rules('main_heading', 'Main Heading', 'trim|max_length[255]');
        $this->form_validation->set_rules('sub_heading', 'Sub Heading', 'trim');
        $this->form_validation->set_rules('cta1_text', 'CTA 1 Text', 'trim|max_length[100]');
        $this->form_validation->set_rules('cta1_link', 'CTA 1 Link', 'trim|max_length[500]');
        $this->form_validation->set_rules('cta2_text', 'CTA 2 Text', 'trim|max_length[100]');
        $this->form_validation->set_rules('cta2_link', 'CTA 2 Link', 'trim|max_length[500]');
        $this->form_validation->set_rules('trusts', 'Trusts', 'trim');
        $this->form_validation->set_rules('score_value', 'Score Value', 'trim|max_length[20]');
        $this->form_validation->set_rules('score_label', 'Score Label', 'trim|max_length[100]');
        $this->form_validation->set_rules('right_heading', 'Right Heading', 'trim|max_length[255]');
        $this->form_validation->set_rules('right_description', 'Right Description', 'trim');
        $this->form_validation->set_rules('right_cta_text', 'Right CTA Text', 'trim|max_length[100]');
        $this->form_validation->set_rules('right_cta_link', 'Right CTA Link', 'trim|max_length[500]');
        $this->form_validation->set_rules('status', 'Status', 'required|in_list[0,1]');
        $this->form_validation->set_rules('domain_id', 'Domain ID', 'required|integer');

        $id = $this->input->post('id');
        if ($this->form_validation->run() === FALSE) {
            // Validation fail → form wapas dikhao
            $data['banner'] = $this->Product_model->get_hero_banner($id);
            $this->load->view('admin/product/edit-hero-banner', $data);
            return;
        }

        $olddata = $this->db->where('id', $id)->get('product_hero_banner')->row();
            if ($_FILES["image"]["size"] > 0) {
                $tmpFilePath = $_FILES['image']['tmp_name'];
                $fileinfo = @getimagesize($_FILES["image"]["tmp_name"]);
                $image_file_type = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
                $newFilePath = 'upload/assets/' . time() . '.' . $image_file_type;
                if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                    $image = $newFilePath;
                }
            }else{
                $image  =  $olddata->image; 
            }

        // Data prepare
        $update_data = [
            'domain_id'         => $this->input->post('domain_id', TRUE),
            'badge_text'        => $this->input->post('badge_text', TRUE),
            'main_heading'      => $this->input->post('main_heading', TRUE),
            'sub_heading'       => $this->input->post('sub_heading', TRUE),
            'cta1_text'         => $this->input->post('cta1_text', TRUE),
            'cta1_link'         => $this->input->post('cta1_link', TRUE),
            'cta2_text'         => $this->input->post('cta2_text', TRUE),
            'cta2_link'         => $this->input->post('cta2_link', TRUE),
            'background_color'  => $this->input->post('background_color', TRUE),
            'trusts'            => $this->input->post('trusts', TRUE),
            'title'             => $this->input->post('title', TRUE),
            'sub_title'         => $this->input->post('sub_title', TRUE),
            'right_heading'     => $this->input->post('right_heading', TRUE),
            'right_description' => $this->input->post('right_description', TRUE),
            'right_cta_text'    => $this->input->post('right_cta_text', TRUE),
            'right_cta_link'    => $this->input->post('right_cta_link', TRUE),
            'image'             => $image,
            'status'            => $this->input->post('status', TRUE),
        ];
        // print_r($update_data);die;

        if(empty($id)) {
            $updated = $this->Product_model->insert_hero_banner($update_data);
        } else {
            $updated = $this->Product_model->update_hero_banner($id, $update_data);
        }
// print_r($this->db->last_query());die;
        if ($updated) {
            $this->session->set_flashdata('success', 'Banner updated successfully!');
        } else {
            $this->session->set_flashdata('error', 'Failed to update banner.');
        }

        redirect('admin/product/view_hero_banner/' . $id);
    }
}
?>
