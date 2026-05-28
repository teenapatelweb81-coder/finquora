     <?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'libraries/razorpay/Razorpay.php';
include APPPATH . 'third_party/vendor/autoload.php';

use Razorpay\Api\Api;

class Dashboard extends CI_Controller
{
    private $count = 0;
    private $count2 = 0;
    private $count3 = 0;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->model('admin/Dashboard_Model');
        $this->load->model('admin/User_model','A');
        $this->load->library('upload');
        date_default_timezone_set('Asia/Kolkata');
        $this->checkDomainAccess();
        $this->logged_in();
        $user_id = $this->session->userdata('user_id');
        $role = $this->session->userdata('role');
         $domain_id = domain_id_get();

         $this->db->from('registerUser');
         if ($this->session->userdata('type') != 'admin') {
            $this->db->where('domain_id', $domain_id);
         }
         $this->db->where('parent_team_id', $user_id);
         $this->count = $this->db->count_all_results(); 

         $this->db->from('user_master');
         if ($this->session->userdata('type') != 'admin') {
            $this->db->where('domain_id', $domain_id);
         }
         $this->db->where('parent_team_id', $user_id);
         $this->count2 = $this->db->count_all_results();

         $this->db->from('branch_franchise');
         if ($this->session->userdata('type') != 'admin') {
            $this->db->where('domain_id', $domain_id);
         }
         $this->db->where('parent_team_id', $user_id);
         $this->count3 = $this->db->count_all_results();
        
        // Make these variables available to all views
        $this->load->vars([
            'count' => $this->count,
            'count2' => $this->count2,
            'count3' => $this->count3
        ]);
        
        $current_url = uri_string();
        if ($current_url == 'admin/agreement') return;

        if ($user_id) {

            if ($role == 3) { // Branch Franchise
                $user = $this->db->get_where('branch_franchise', [
                    'id' => $user_id
                ])->row();

                if (!$user || $user->agreement_status != 'approved' || empty($user->signature)) {
                    redirect('admin/agreement');
                }

            } elseif ($role == 2) { // Master User
                $user = $this->db->get_where('user_master', [
                    'id' => $user_id
                ])->row();

                if (!$user || $user->agreement_status != 'approved' || empty($user->signature)) {
                    redirect('admin/agreement');
                }
            }
        }
    }

    private function logged_in()
    {
        
        if (!$this->session->userdata('authenticated')) {
            redirect('desk-login');

        }
    }

        /**
     * Get branch plan data via AJAX
     */
    public function marketing_notification_add()
    {
        if (!has_permission('Promotional Notifications') && $this->session->userdata('type') != 'admin') {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
        }

        $data = [];
        $data['page_title'] = 'Add Promotional Notifications';

        if ($this->input->post()) {

            $this->form_validation->set_rules('title', 'Title', 'required');

            if ($this->form_validation->run() !== FALSE) {

                $document = null;

                /* ================= FILE UPLOAD ================= */
                if (!empty($_FILES['document']['name'])) {
                    $tmpFilePath = $_FILES['document']['tmp_name'];
                    $image_file_type = pathinfo($_FILES["document"]["name"], PATHINFO_EXTENSION);
                    $newFilePath = 'upload/assets/images/' . time() . '.' . $image_file_type;

                    if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                        $document = $newFilePath;
                    }
                }

                $content   = $this->input->post('content');
                $is_active = $this->input->post('is_active') ? 1 : 0;
                $domain_id = domain_id_get();

                /* =================================================
                🔥 MAIN RULE (Same as toggle logic)
                ================================================= */
                if (!empty($content) && empty($document) && $is_active == 1) {

                    // Same domain ke sab content-only notifications inactive
                    $this->db->where('domain_id', $domain_id);
                    $this->db->where('document IS NULL', null, false);
                    $this->db->where('content IS NOT NULL', null, false);
                    $this->db->update('marketing_notifications', [
                        'is_active' => 0
                    ]);
                }

                /* ================= INSERT ================= */
                $insert_data = [
                    'title'      => $this->input->post('title'),
                    'content'    => $content,
                    'document'   => $document,
                    'domain_id'  => $domain_id,
                    'is_active'  => $is_active,
                    'created_at'=> date('Y-m-d H:i:s')
                ];

                $this->db->insert('marketing_notifications', $insert_data);

                $this->session->set_flashdata('success', 'Marketing notification added successfully!');
                redirect('admin/marketing-notification-list');
            }
        }

        $this->load->view('admin/template/header');
        $this->load->view('admin/marketing_notification_add', $data);
        $this->load->view('admin/template/footer');
    }

    
    public function marketing_notification_list()
    {
         if (!has_permission('Promotional Notifications') && $this->session->userdata('type') != 'admin') {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
        }

        $data = [];
        $data['page_title'] = 'Promotional Notifications';
        $domain_id = domain_id_get();
       $this->db->from('marketing_notifications');

       $this->db->where('domain_id', $domain_id);
        // domain condition (non-admin type)
        if ($this->session->userdata('type') != 'admin') {
        }

        // role condition
        if ($this->session->userdata('role') != 1) {
            // document must not be null
            $this->db->where('document IS NOT NULL', null, false);
        }

        // common conditions
        // $this->db->where('is_active', 1);
        $this->db->order_by('id', 'desc');

        $data['notifications'] = $this->db->get()->result();

        
        $this->load->view('admin/template/header');
        $this->load->view('admin/marketing_notification_list', $data);
        $this->load->view('admin/template/footer');
    }
    
    public function marketing_notification_edit($id = null)
    {
         if (!has_permission('Promotional Notifications') && $this->session->userdata('type') != 'admin') {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
        }

        if (!$id) {
            show_404();
        }
        
        $data = [];
        $data['page_title'] = 'Edit Promotional Notifications';
        $data['notification'] = $this->db->get_where('marketing_notifications', ['id' => $id])->row_array();
        
        if (!$data['notification']) {
            show_404();
        }
        
        if ($this->input->post()) {
            $this->form_validation->set_rules('title', 'Title', 'required');
            
            if ($this->form_validation->run() !== FALSE) {
                $update_data = [
                    'title' => $this->input->post('title'),
                    'content' => $this->input->post('content'),
                    'domain_id' =>domain_id_get(),
                    'is_active' => $this->input->post('is_active') ? 1 : 0,
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                
                // Handle file upload if a new file was selected
                if (!empty($_FILES['document']['name'])) {

                    $upload_path = FCPATH . 'upload/assets/images/';
                    if (!is_dir($upload_path)) {
                        mkdir($upload_path, 0777, true);
                    }
                    $config['upload_path']   = $upload_path;
                    $config['allowed_types'] = 'jpg|jpeg|png|gif|mp4|mov|avi|mkv|webm|pdf|doc|docx';
                    $config['max_size']      = 0;
                    $config['encrypt_name']  = true; 
                    $config['overwrite']    = false;
                    $this->load->library('upload');
                    $this->upload->initialize($config);
                    if ($this->upload->do_upload('document')) {
                        if (!empty($data['notification']->document) && file_exists(FCPATH . $data['notification']->document)) {
                            unlink(FCPATH . $data['notification']->document);
                        }
                        $upload_data = $this->upload->data();
                        $update_data['document'] = 'upload/assets/images/' . $upload_data['file_name'];
                    } else {
                        $this->session->set_flashdata('error', strip_tags($this->upload->display_errors()));
                        redirect(current_url());
                        return;
                    }
                }

                
                $this->db->where('id', $id);
                $this->db->update('marketing_notifications', $update_data);
                
                $this->session->set_flashdata('success', 'Marketing notification updated successfully!');
                redirect('admin/marketing-notification-list');
            }
        }
        
        $this->load->view('admin/template/header');
        $this->load->view('admin/marketing_notification_edit', $data);
        $this->load->view('admin/template/footer');
    }
    
    public function marketing_notification_delete($id = null)
    {
        if (!has_permission('Promotional Notifications') && $this->session->userdata('type') != 'admin') {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
        }
        
        if (!$id) {
            show_404();
        }
        
        // Get the notification to check for associated document
        $notification = $this->db->get_where('marketing_notifications', ['id' => $id])->row();
        
        if ($notification) {
            // Delete the document file if it exists
            if (!empty($notification->document) && file_exists(FCPATH . $notification->document)) {
                unlink(FCPATH . $notification->document);
            }
            
            // Delete the notification from database
            $this->db->where('id', $id);
            $this->db->delete('marketing_notifications');
            
            $this->session->set_flashdata('success', 'Marketing notification deleted successfully!');
        } else {
            $this->session->set_flashdata('error', 'Notification not found!');
        }
        
        redirect('admin/marketing-notification-list');
    }

    public function marketing_notification_toggle()
    {
        if (!has_permission('Promotional Notifications') && $this->session->userdata('type') != 'admin') {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
        }

        $id        = $this->input->post('id');
        $domain_id = $this->input->post('domain_id');
        $status    = $this->input->post('status');

        if ($status == 1) {

            $this->db->where('domain_id', $domain_id);
            $this->db->where('document IS NULL', null, false);
            $this->db->where('content IS NOT NULL', null, false);
            $this->db->update('marketing_notifications', [
                'is_active' => 0
            ]);

            $this->db->where('id', $id);
            $this->db->update('marketing_notifications', [
                'is_active' => 1
            ]);

        } else {
            $this->db->where('id', $id);
            $this->db->update('marketing_notifications', [
                'is_active' => 0
            ]);
        }

        echo json_encode([
            'success' => true,
            'message' => 'Status updated successfully'
        ]);
    }

    
    public function get_branch_plan_data()
    {
        $this->output->set_content_type('application/json');
        
        $branch_id = $this->input->post('branch_id');
        $plan_type = $this->input->post('plan_type');
        $domain_id = $this->input->post('domain_id');
        
        if (empty($branch_id) || empty($plan_type) || empty($domain_id)) {
            echo json_encode(['status' => 'error', 'message' => 'Missing required parameters']);
            return;
        }
        
        // Get plan data for the selected branch
        $this->db->where('user_id', $branch_id);
        $this->db->where('plan_type', $plan_type);
        $this->db->where('domain_id', $domain_id);
        $query = $this->db->get('plan_tbl');
        
        if ($query->num_rows() > 0) {
            $plan_data = $query->row_array();
            echo json_encode([
                'status' => 'success',
                'data' => [
                    'amount' => $plan_data['amount'] ?? '',
                    'amount2' => $plan_data['amount2'] ?? '',
                    'validity' => $plan_data['validity'] ?? '',
                    // Add other fields as needed
                ]
            ]);
        } else {
            // Return default values if no plan found
            echo json_encode([
                'status' => 'success',
                'data' => [
                    'amount' => '',
                    'validity' => '',
                    // Default values for other fields
                ]
            ]);
        }
    }

    // Helper function to get all team member IDs recursively
    private function getTeamUserIds($parentId, $role) {
        $userIds = [];
        $query = $this->db->select('id')
                         ->where('parent_id', $parentId)
                         ->where('domain_id', domain_id_get())
                         ->get('user_master');
        
        $users = $query->result_array();
        
        foreach ($users as $user) {
            $userIds[] = $user['id'];
            // Recursively get team members of team members
            $userIds = array_merge($userIds, $this->getTeamUserIds($user['id'], $role));
        }
        
        return $userIds;
    }

  
    public function index()
    {
        $uid       = $this->session->userdata('user_id');
        $role      = $this->session->userdata('role');
        $domain_id = domain_id_get();
        
        // Pass the counts to the view
        $data['count'] = $this->count;
        $data['count2'] = $this->count2;
        $data['count3'] = $this->count3;

        $processIdsPaper   = [7, 8, 9, 10, 11, 12, 14, 15, 16, 20];
        $processIdsdigital = [1, 2, 3, 4, 5, 6, 17];

        // My leads
        $data['leads']             = $this->Dashboard_Model->digitalProcess('leads', $processIdsdigital);
        $data['paperProcessLeads'] = $this->Dashboard_Model->paperProcess('leads', $processIdsPaper);
        // print_r($this->db->last_query());die;

        // Total loans
        $data['totalLoans'] = $this->Dashboard_Model->loanCount('loan_master');
        
        // Total Instant Loans Kyc
        $data['instant_leads'] =  $this->db
        ->where(array('domain_id' => $domain_id))
        ->where(($this->session->userdata('role') != 1) ? array('user_id' => $uid) : array())
        ->get('indiasale_tbl')
        ->num_rows();

        $data['instantDisbursements'] =  $this->db->select('SUM(disbursed) as dis')
        ->where(array('domain_id' => $domain_id))
        ->where(($this->session->userdata('role') != 1) ? array('user_id' => $uid) : array())
        ->get('indiasale_tbl')
        ->row();

         $data['instantPayouts'] =  $this->db->select('SUM(payment_amount_paid) as pay_amount')
        ->where(array('domain_id' => $domain_id))
        ->where(($this->session->userdata('role') != 1) ? array('user_id' => $uid) : array())
        ->get('indiasale_tbl')
        ->row();

        $data['instantApproved'] =  $this->db
        ->where(array('domain_id' => $domain_id))
        ->where(($this->session->userdata('role') != 1) ? array('user_id' => $uid) : array())
        ->where(array('status' => '1'))
        ->get('indiasale_tbl')
        ->num_rows();
        
        $data['instantRejected'] =  $this->db
        ->where(array('domain_id' => $domain_id))
        ->where(($this->session->userdata('role') != 1) ? array('user_id' => $uid) : array())
        ->where(array('status' => '2'))
        ->get('indiasale_tbl')
        ->num_rows();

        // Referral amount
        // Get user data
        $user_data = $this->db->where('id', $uid)
        ->where('role', $role)
        ->where('domain_id', $domain_id)
        ->where('status',1)
        ->get('user_master')
        ->row_array();
        
        if (empty($user_data)) {
            $user_data = $this->db->where('id', $uid)
            ->where('role', $role)
            ->where('domain_id', $domain_id)
            ->where('status',1)
            ->get('branch_franchise')
            ->row_array();
        }
        // Team user ids
        $teamUserIds = [];
        $userIds = array();
        $userIdsrole = array();
        $uid = $user_data['id'];
        $userIds[] = $user_data['id'];
        $userIdsrole[] = $user_data['role'];
        
        if ($role != 1) {
            $users = $this->db->select('id,role')
            ->where('domain_id', $domain_id)
            ->where('parent_id', $uid)
            ->where('parent_id_role', $this->session->userdata('role'))
            ->where('status',1)
            ->get('user_master')
            ->result_array();
            
            if (!empty($users)) {
                foreach ($users as $user) {
                    $userIds[]     = $user['id'];
                    $teamUserIds[] = $user['id'];
                    $userIdsrole[] = $user['role'];
                }
            }
        }
        
        if (empty($teamUserIds)) {
            $teamUserIds = [-1];
        }
        
        //myteam userids 
        
        // Code for parent_team_id START
        $myteamuserIds     = [$uid];
        $myteamUserIds =  [];
        $myteamUserIdsrole = [];
        
        if ($role != 1) {
            $users = $this->db->select('id,role')
            ->where('domain_id', $domain_id)
                ->where('parent_team_id', $uid)
                ->where('parent_team_role','2')
                ->where('status',1)
                ->get('user_master')
                ->result_array();
                
                if (empty($users)) {
                    $users = $this->db->select('id,role')
                    ->where('domain_id', $domain_id)
                    ->where('parent_team_id', $uid)
                    ->where('parent_team_role','2')
                    ->where('status',1)
                    ->get('branch_franchise')
                    ->result_array();
                }
                if (!empty($users)) {
                    foreach ($users as $user) {
                        $myteamuserIds[]     = $user['id'];
                        $myteamUserIdsrole[] = $user['role'];
                    }
                }
            }
            // print_r($myteamuserIds);die;
            if (empty($myteamuserIds)) {
                $myteamuserIds = [-1];
            }else{
                // foreach($myteamuserIds as $myteamUserId){
                    //     $users = $this->db->select('id')
                    //                 ->where('domain_id', $domain_id)
                    //                 ->where('parent_id', $myteamUserId)
                //                 ->get('user_master')
                //                 ->result_array();
                
                //                 if (!empty($users)) {
                    //                 foreach ($users as $user) {
                        //                     $myteamUserIds[]     = $user['id'];
                        //                 }
                        //             }
                        // }
                        // print_r($myteamuserIds);die;
                        // check error a rhi hai
                // $this->db->select('id');
                // $this->db->from('user_master');
                // $this->db->where('domain_id', $domain_id);
                // $this->db->where('status', 1);
                // $this->db->group_start();
                        
                //         foreach ($myteamuserIds as $key => $pid) {
                //             $prole = $myteamUserIdsrole[$key] ?? null;
                            
                //             if ($prole !== null) {
                //                 $this->db->or_group_start()
                //                 ->where('parent_id', $pid)
                //                 ->where('parent_id_role', $prole)
                //                 ->group_end();
                //             }
                //         }
            
                //  $this->db->group_end();
                // $users = $this->db->get()->result_array();

                $this->db->select('id');
                $this->db->from('user_master');
                $this->db->where('domain_id', $domain_id);
                $this->db->where('status', 1);

                $hasCondition = false;

                foreach ($myteamuserIds as $key => $pid) {

                    $prole = $myteamUserIdsrole[$key] ?? null;

                    if ($prole !== null) {

                        if (!$hasCondition) {
                            $this->db->group_start();
                            $hasCondition = true;
                        }

                        $this->db->or_group_start()
                                ->where('parent_id', $pid)
                                ->where('parent_id_role', $prole)
                                ->group_end();
                    }
                }

                if ($hasCondition) {
                    $this->db->group_end();
                }

                $users = $this->db->get()->result_array();
            
            // IDs collect करो
            if (!empty($users)) {
                foreach ($users as $user) {
                    $myteamuserIds[] = $user['id'];
                }
            }
        }
    //    echo '<pre>'; print_r($this->db->last_query());
        
    //     print_r($myteamuserIds);die;

       
        // Code for parent_team_id END

        
        $query = $this->db->select_sum('referral_amount');

        ($this->session->userdata('type') != 'admin')
            ? $query->where('domain_id', $domain_id)
            : null;

        ($this->session->userdata('role') != 1)
            ? $query->where_in('parent_id', $teamUserIds)
            : null;

        $data['referralAmount'] = $query->get('user_master')->row();

            $this->db->from('user_master');
            $this->db->where('parent_team_id', $uid);
            $this->db->where('domain_id', $domain_id);
            $this->db->where('role', $role);
            $this->db->where('status', 1);
            $direct_team = $this->db->get()->result(); 
            if (empty($direct_team)) {
                $this->db->from('branch_franchise');
                $this->db->where('parent_team_id', $uid);
                $this->db->where('domain_id', $domain_id);
                $this->db->where('role', $role);
                $this->db->where('status', 1);
                $direct_team = $this->db->get()->result(); 
            }
            $team_ids = [];
            foreach ($direct_team as $member) {
                $team_ids[] = $member->id;
            }
            
            if (empty($team_ids)) {
                $team_ids = [0];
            }
            
            $this->db->from('user_master');
            $this->db->where_in('parent_id', $team_ids);
            $this->db->where('domain_id', $domain_id);
            $this->db->where('status', 1);
            $this->db->order_by('id', 'DESC');
            $channel_partner= $this->db->get()->result();
            $channel_partner_data = array_merge($direct_team, $channel_partner);
            $channel_partner_ids = array_column($channel_partner_data, 'id');
            // print_r($channel_partner_ids);die;

        
        $loan_name_digital = ['Business Loan', 'Personal Loan', 'Instant Loan'];
        $loan_name_paper   = ['Home Loan'];

        /* -------------------- PAPER PROCESS --------------------------- */

        if ($user_data['parent_id'] == '' || $user_data['parent_id'] == 0 || $user_data['parent_id'] == NULL) {
             //leads   
            $data['paper_reject'] = $this->db->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('process_id', $processIdsPaper)->where('uid', $uid)->where('lead_status', 'Reject')->get('leads')->num_rows();
            $data['paper_approved'] = $this->db->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('process_id', $processIdsPaper)->where('uid', $uid)->where('lead_status', 'Apporved')->get('leads')->num_rows();
            $data['payout_lead_paper'] = $this->db->select('SUM(payment_amount_paid) as pay_amount')
                ->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])
                ->where_in('process_id', $processIdsPaper)
                ->where('uid', $uid)
                ->get('leads')
                ->row();
            $data['disbursemenets_lead_paper'] = $this->db->select('SUM(disbursed) as dis')
                ->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])
                ->where_in('process_id', $processIdsPaper)
                ->where('uid', $uid)
                ->get('leads')
                ->row();
            // TEAM PAPER
            $data['team_payout_lead_paper'] = $this->db->select('SUM(payment_amount_paid_team) as pay_amount')
                ->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])
                ->where_in('process_id', $processIdsPaper)
                ->where_in('uid', $teamUserIds)
                ->get('leads')
                ->row();

            $data['team_disbursemenets_lead_paper'] = $this->db->select('SUM(disbursed_team) as dis')
                ->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])
                ->where_in('process_id', $processIdsPaper)
                ->where_in('uid', $teamUserIds)
                ->get('leads')
                ->row();

            $data['team_leads'] = $this->db
                ->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])
                ->where_in('process_id', $processIdsPaper)
                ->where_in('uid', $teamUserIds)
                ->get('leads')
                ->num_rows();

            $data['team_rejects'] = $this->db
                ->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])
                ->where_in('process_id', $processIdsPaper)
                ->where('lead_status', 'Reject')
                ->where_in('uid', $teamUserIds)
                ->get('leads')
                ->num_rows();
            
            $data['team_approved'] = $this->db
                ->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])
                ->where_in('process_id', $processIdsPaper)
                ->where('lead_status', 'Apporved')
                ->where_in('uid', $teamUserIds)
                ->get('leads')
                ->num_rows();

            // loan master
            $data['paper_loan_reject'] = $this->db->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('apply_for_loan',$loan_name_paper)->where('user_id', $uid)->where('loan_status', 'Reject')->get('loan_master')->num_rows();
            $data['paper_loan_approved'] = $this->db->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('apply_for_loan',$loan_name_paper)->where('user_id', $uid)->where('loan_status', 'Apporved')->get('loan_master')->num_rows();
            $data['payout_loan_paper'] = $this->db->select('SUM(payment_amount_paid) as pay_amount')
                ->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])
                ->where_in('apply_for_loan', $loan_name_paper)
                ->where('user_id', $uid)
                ->get('loan_master')
                ->row();
            $data['disbursemenets_loan_paper'] = $this->db->select('SUM(disbursed) as dis')
                ->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])
                ->where_in('apply_for_loan', $loan_name_paper)
                ->where('user_id', $uid)
                ->get('loan_master')
                ->row();
            // TEAM PAPER
            $data['team_payout_loan_paper'] = $this->db->select('SUM(payment_amount_paid_team) as pay_amount')
                ->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])
                ->where_in('apply_for_loan', $loan_name_paper)
                ->where_in('user_id', $teamUserIds)
                ->get('loan_master')
                ->row();

            $data['team_disbursemenets_loan_paper'] = $this->db->select('SUM(disbursed_team) as dis')
                ->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])
                ->where_in('apply_for_loan', $loan_name_paper)
                ->where_in('user_id', $teamUserIds)
                ->get('loan_master')
                ->row();

            $data['team_loans'] = $this->db
                ->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])
                ->where_in('apply_for_loan', $loan_name_paper)
                ->where_in('user_id', $teamUserIds)
                ->get('loan_master')
                ->num_rows();

            $data['team_loan_rejects'] = $this->db
                ->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])
                ->where_in('apply_for_loan', $loan_name_paper)
                ->where('loan_status', 'Reject')
                ->where_in('user_id', $teamUserIds)
                ->get('loan_master')
                ->num_rows();
            
            $data['team_loan_approved'] = $this->db
                ->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])
                ->where_in('apply_for_loan', $loan_name_paper)
                ->where('loan_status', 'Apporved')
                ->where_in('user_id', $teamUserIds)
                ->get('loan_master')
                ->num_rows();    
        }

        // Team logic
        else if ($user_data['parent_id'] != '') {
            //leads
            $data['payout_lead_paper'] = $this->db->select('SUM(payment_amount_paid_team) as pay_amount')
                ->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])
                ->where_in('process_id', $processIdsPaper)
                ->where('uid', $uid)
                ->get('leads')
                ->row();
            $data['paper_reject'] = $this->db->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('process_id', $processIdsPaper)->where('uid', $uid)->where('lead_status', 'Reject')->get('leads')->num_rows();
            $data['paper_approved'] = $this->db->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('process_id', $processIdsPaper)->where('uid', $uid)->where('lead_status', 'Apporved')->get('leads')->num_rows();
            $data['disbursemenets_lead_paper'] = $this->db->select('SUM(disbursed_team) as dis')
                ->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])
                ->where_in('process_id', $processIdsPaper)
                ->where('uid', $uid)
                ->get('leads')
                ->row();
            //loan master

             $data['payout_loan_paper'] = $this->db->select('SUM(payment_amount_paid_team) as pay_amount')
                ->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])
                ->where_in('apply_for_loan', $loan_name_paper)
                ->where('user_id', $uid)
                ->get('loan_master')
                ->row();
            $data['paper_loan_reject'] = $this->db->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('apply_for_loan', $loan_name_paper)->where('user_id', $uid)->where('loan_status', 'Reject')->get('loan_master')->num_rows();
            $data['paper_loan_approved'] = $this->db->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('apply_for_loan', $loan_name_paper)->where('user_id', $uid)->where('loan_status', 'Apporved')->get('loan_master')->num_rows();
            $data['disbursemenets_loan_paper'] = $this->db->select('SUM(disbursed_team) as dis')
                ->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])
                ->where_in('apply_for_loan', $loan_name_paper)
                ->where('user_id', $uid)
                ->get('loan_master')
                ->row();
        }

        // Admin override
        if ($role == 1) {
            //lead
            $data['paper_reject'] = $this->db->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('process_id', $processIdsPaper)->where('lead_status', 'Reject')->get('leads')->num_rows();
            $data['paper_approved'] = $this->db->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('process_id', $processIdsPaper)->where('lead_status', 'Apporved')->get('leads')->num_rows();

            $data['payout_lead_paper'] = $this->db->select('SUM(payment_amount_paid) as pay_amount')
                ->where_in('process_id', $processIdsPaper)
                ->where('admin_id', 1)
                ->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])
                ->get('leads')
                ->row();

            $data['disbursemenets_lead_paper'] = $this->db->select('SUM(disbursed) as dis')
                ->where_in('process_id', $processIdsPaper)
                ->where('admin_id', 1)
                ->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])
                ->get('leads')
                ->row();
            // loan master

            $data['paper_loan_reject'] = $this->db->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('apply_for_loan', $loan_name_paper)->where('loan_status', 'Reject')->get('loan_master')->num_rows();
            $data['paper_loan_approved'] = $this->db->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('apply_for_loan', $loan_name_paper)->where('loan_status', 'Apporved')->get('loan_master')->num_rows();

            $data['payout_loan_paper'] = $this->db->select('SUM(payment_amount_paid) as pay_amount')
                ->where_in('apply_for_loan', $loan_name_paper)
                ->where('admin_id', 1)
                ->get('loan_master')
                ->row();

            $data['disbursemenets_loan_paper'] = $this->db->select('SUM(disbursed) as dis')
                ->where_in('apply_for_loan', $loan_name_paper)
                ->where('admin_id', 1)
                ->get('loan_master')
                ->row();

        }
        
        // For digital process
        if ($user_data['parent_id'] == '' || $user_data['parent_id'] == 0 || $user_data['parent_id'] == NULL) {
            //lead
            $data['payout_lead_digital'] = $this->db->select('SUM(payment_amount_paid) as pay_amount')->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('process_id', $processIdsdigital)->where('uid', $uid)->get('leads')->row();
            $data['digital_reject'] = $this->db->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('process_id', $processIdsdigital)->where('uid', $uid)->where('lead_status', 'Reject')->get('leads')->num_rows();
            $data['digital_approved'] = $this->db->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('process_id', $processIdsdigital)->where('uid', $uid)->where('lead_status', 'Apporved')->get('leads')->num_rows();
            $data['disbursemenets_lead_digital'] = $this->db->select('SUM(disbursed) as dis')->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('process_id', $processIdsdigital)->where('uid', $uid)->get('leads')->row();
            //team
            $data['team_payout_lead_digital'] = $this->db->select('SUM(payment_amount_paid_team) as pay_amount')->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('process_id', $processIdsdigital)->where_in('uid', $teamUserIds)->get('leads')->row();
            $data['team_disbursemenets_lead_digital'] = $this->db->select('SUM(disbursed_team) as dis')->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('process_id', $processIdsdigital)->where_in('uid', $teamUserIds)->get('leads')->row();
            $data['team_leads_digital'] = $this->db->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('process_id', $processIdsdigital)->where_in('uid', $teamUserIds)->get('leads')->num_rows();
            $data['team_rejects_digital'] = $this->db->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('process_id', $processIdsdigital)->where('lead_status', 'Reject')->where_in('uid', $teamUserIds)->get('leads')->num_rows();
            $data['team_approved_digital'] = $this->db->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('process_id', $processIdsdigital)->where('lead_status', 'Apporved')->where_in('uid', $teamUserIds)->get('leads')->num_rows();
           
            //loan master
            $data['payout_loan_digital'] = $this->db->select('SUM(payment_amount_paid) as pay_amount')->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('apply_for_loan', $loan_name_digital)->where('user_id', $uid)->get('loan_master')->row();
            $data['digital_loan_reject'] = $this->db->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('apply_for_loan', $loan_name_digital)->where('user_id', $uid)->where('loan_status', 'Reject')->get('loan_master')->num_rows();
            $data['digital_loan_approved'] = $this->db->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('apply_for_loan', $loan_name_digital)->where('user_id', $uid)->where('loan_status', 'Apporved')->get('loan_master')->num_rows();
            $data['disbursemenets_loan_digital'] = $this->db->select('SUM(disbursed) as dis')->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('apply_for_loan', $loan_name_digital)->where('user_id', $uid)->get('loan_master')->row();
            //team
            $data['team_loans_rejects_digital'] = $this->db->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('apply_for_loan', $loan_name_digital)->where('loan_status', 'Reject')->where_in('user_id', $teamUserIds)->get('loan_master')->num_rows();
            $data['team_loans_approved_digital'] = $this->db->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('apply_for_loan', $loan_name_digital)->where('loan_status', 'Apporved')->where_in('user_id', $teamUserIds)->get('loan_master')->num_rows();
            $data['team_payout_loan_digital'] = $this->db->select('SUM(payment_amount_paid_team) as pay_amount')->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('apply_for_loan', $loan_name_digital)->where_in('user_id', $teamUserIds)->get('loan_master')->row();
            $data['team_disbursemenets_loan_digital'] = $this->db->select('SUM(disbursed_team) as dis')->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('apply_for_loan', $loan_name_digital)->where_in('user_id', $teamUserIds)->get('loan_master')->row();
            $data['team_loans_digital'] = $this->db->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('apply_for_loan', $loan_name_digital)->where_in('user_id', $teamUserIds)->get('loan_master')->num_rows();

        } else if ($user_data['parent_id'] != '') {
            // lead
            $data['payout_lead_digital'] = $this->db->select('SUM(payment_amount_paid_team) as pay_amount')->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('process_id', $processIdsdigital)->where('uid', $uid)->get('leads')->row();
            $data['digital_reject'] = $this->db->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('process_id', $processIdsdigital)->where('uid', $uid)->where('lead_status', 'Reject')->get('leads')->num_rows();
            $data['digital_approved'] = $this->db->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('process_id', $processIdsdigital)->where('uid', $uid)->where('lead_status', 'Apporved')->get('leads')->num_rows();
            $data['disbursemenets_lead_digital'] = $this->db->select('SUM(disbursed_team) as dis')->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('process_id', $processIdsdigital)->where('uid', $uid)->get('leads')->row(); 
            // loan master
            $data['payout_loan_digital'] = $this->db->select('SUM(payment_amount_paid_team) as pay_amount')->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('apply_for_loan', $loan_name_digital)->where('user_id', $uid)->get('loan_master')->row();
            $data['digital_loan_reject'] = $this->db->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('apply_for_loan', $loan_name_digital)->where('user_id', $uid)->where('loan_status', 'Reject')->get('loan_master')->num_rows();
            $data['digital_loan_approved'] = $this->db->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('apply_for_loan', $loan_name_digital)->where('user_id', $uid)->where('loan_status', 'Apporved')->get('loan_master')->num_rows();
            $data['disbursemenets_loan_digital'] = $this->db->select('SUM(disbursed_team) as dis')->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('apply_for_loan', $loan_name_digital)->where('user_id', $uid)->get('loan_master')->row(); 
        } 


        //Parent Team lead data 
        $user_id = $this->session->userdata('user_id');
        $my_team_user = $this->db->from('user_master');
        if ($this->session->userdata('type') != 'admin') {
            $team_user = $this->db->where('domain_id', $domain_id);
        }
        $team_user = $this->db->where('parent_team_id', $user_id);
        $team_user = $this->count2 = $this->db->count_all_results();

        if($team_user > 0){

            $data['team_leads_digital'] = $this->db->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('process_id', $processIdsdigital)->where_in('uid', $myteamuserIds)->get('leads')->num_rows();
            $data['team_disbursemenets_lead_digital'] = $this->db->select('SUM(COALESCE(disbursed,0) + COALESCE(disbursed_team,0)) AS dis')->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('process_id', $processIdsdigital)->where_in('uid', $myteamuserIds)->get('leads')->row();
            $data['team_payout_lead_digital'] = $this->db->select('SUM(COALESCE(payment_amount_paid_team,0) + COALESCE(payment_amount_paid,0)) AS pay_amount')->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('process_id', $processIdsdigital)->where_in('uid', $myteamuserIds)->get('leads')->row();
            $data['team_approved_digital'] = $this->db->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('process_id', $processIdsdigital)->where('lead_status', 'Apporved')->where_in('uid', $myteamuserIds)->get('leads')->num_rows();
            $data['team_rejects_digital'] = $this->db->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('process_id', $processIdsdigital)->where('lead_status', 'Reject')->where_in('uid', $myteamuserIds)->get('leads')->num_rows();
            $data['team_rejects'] = $this->db
                ->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])
                ->where_in('process_id', $processIdsPaper)
                ->where('lead_status', 'Reject')
                ->where_in('uid', $myteamuserIds)
                ->get('leads')
                ->num_rows();

            $data['team_leads'] = $this->db->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('process_id', $processIdsPaper)->where_in('uid', $myteamuserIds)->get('leads')->num_rows();
            $data['team_disbursemenets_lead_paper'] = $this->db->select('SUM(COALESCE(disbursed,0) + COALESCE(disbursed_team,0)) AS dis')->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('process_id', $processIdsPaper)->where_in('uid', $myteamuserIds)->get('leads')->row();
            $data['team_payout_lead_paper'] = $this->db->select('SUM(COALESCE(payment_amount_paid_team,0) + COALESCE(payment_amount_paid,0)) AS pay_amount')->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('process_id', $processIdsPaper)->where_in('uid', $myteamuserIds)->get('leads')->row();
            $data['team_approved'] = $this->db->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('process_id', $processIdsPaper)->where('lead_status', 'Apporved')->where_in('uid', $myteamuserIds)->get('leads')->num_rows();
            $data['team_rejects'] = $this->db->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('process_id', $processIdsPaper)->where('lead_status', 'Reject')->where_in('uid', $myteamuserIds)->get('leads')->num_rows();
            
            
            $data['team_loans_digital'] = $this->db->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('apply_for_loan', $loan_name_digital)->where_in('user_id', $myteamuserIds)->get('loan_master')->num_rows();
            $data['team_disbursemenets_loan_digital'] = $this->db->select('SUM(COALESCE(disbursed,0) + COALESCE(disbursed_team,0)) AS dis')->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('apply_for_loan', $loan_name_digital)->where_in('user_id', $myteamuserIds)->get('loan_master')->row();
            $data['team_payout_loan_digital'] = $this->db->select('SUM(COALESCE(payment_amount_paid_team,0) + COALESCE(payment_amount_paid,0)) AS pay_amount')->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('apply_for_loan', $loan_name_digital)->where_in('user_id', $myteamuserIds)->get('loan_master')->row();
            $data['team_loans_approved_digital'] = $this->db->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('apply_for_loan', $loan_name_digital)->where('loan_status', 'Apporved')->where_in('user_id', $myteamuserIds)->get('loan_master')->num_rows();
            $data['team_loans_rejects_digital'] = $this->db->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('apply_for_loan', $loan_name_digital)->where('loan_status', 'Reject')->where_in('user_id', $myteamuserIds)->get('loan_master')->num_rows();
        }
         


        // Admin-specific data
        if ($role == 1) {
            //lead
            $data['payout_lead_digital'] = $this->db->select('SUM(payment_amount_paid) as pay_amount')->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('process_id', $processIdsdigital)->where('admin_id', 1)->get('leads')->row();
            $data['digital_reject'] = $this->db->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('process_id', $processIdsdigital)->where('lead_status', 'Reject')->get('leads')->num_rows();
            $data['digital_approved'] = $this->db->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('process_id', $processIdsdigital)->where('lead_status', 'Apporved')->get('leads')->num_rows();  
            $data['disbursemenets_lead_digital'] = $this->db->select('SUM(disbursed) as dis')->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('process_id', $processIdsdigital)->where('admin_id', 1)->get('leads')->row(); 
            //loan master
            $data['payout_loan_digital'] = $this->db->select('SUM(payment_amount_paid) as pay_amount')->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('apply_for_loan', $loan_name_digital)->where('admin_id', 1)->get('loan_master')->row();
            $data['digital_loan_reject'] = $this->db->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('apply_for_loan', $loan_name_digital)->where('loan_status', 'Reject')->get('loan_master')->num_rows();
            $data['digital_loan_approved'] = $this->db->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('apply_for_loan', $loan_name_digital)->where('loan_status', 'Apporved')->get('loan_master')->num_rows();    
            $data['disbursemenets_loan_digital'] = $this->db->select('SUM(disbursed) as dis')->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('apply_for_loan', $loan_name_digital)->where('admin_id', 1)->get('loan_master')->row(); 

        }

        $data['adminColor'] = $this->db->where( array('domain_id' => $domain_id))->get('admin_color')->row_array();
        $data['notification'] = $this->db->where( array('domain_id' => $domain_id))->where('is_active', 1)->where('document',null)->order_by('id', 'desc')->get('marketing_notifications')->row_array();
        $this->load->view('admin/template/header', $data);
        $this->load->view('admin/dashboard/view', $data);
        $this->load->view('admin/template/footer', $data);
    }
            

    public function instantKyc()
    {
        $uid = $this->session->userdata('user_id');
        $role = $this->session->userdata('role');
        $domain_id = domain_id_get();
        if (isset($_GET['role']) && $_GET['role'] == 'disbursements' ) {
            $rows =  $this->db->where('disbursed !=', '')->where('disbursed IS NOT NULL', null, false)
            ->where(array('domain_id' => $domain_id))
            ->where(($this->session->userdata('role') != 1) ? array('user_id' => $uid) : array())
           ->order_by('id', 'DESC')->get('indiasale_tbl')
            ->result();
        }elseif (isset($_GET['role']) && $_GET['role'] == 'payout' ) {
            $rows =  $this->db->where('payment_amount_paid !=', '')->where('payment_amount_paid IS NOT NULL', null, false)
            ->where(array('domain_id' => $domain_id))
            ->where(($this->session->userdata('role') != 1) ? array('user_id' => $uid) : array())
            ->order_by('id', 'DESC')->get('indiasale_tbl')
            ->result();
        }elseif (isset($_GET['role']) && $_GET['role'] == 'approved' ) {
            $rows =  $this->db
            ->where(array('domain_id' => $domain_id))
            ->where(($this->session->userdata('role') != 1) ? array('user_id' => $uid) : array())
            ->where(array('status' => '1'))
           ->order_by('id', 'DESC')->get('indiasale_tbl')
            ->result();
        }elseif (isset($_GET['role']) && $_GET['role'] == 'rejected' ) {
            $rows =  $this->db
            ->where(array('domain_id' => $domain_id))
            ->where(($this->session->userdata('role') != 1) ? array('user_id' => $uid) : array())
            ->where(array('status' => '2'))->order_by('id', 'DESC')
            ->get('indiasale_tbl')
            ->result();
        }else{
            $rows =  $this->db
            ->where(array('domain_id' => $domain_id))
            ->where(($this->session->userdata('role') != 1) ? array('user_id' => $uid) : array())
            ->order_by('id', 'DESC')->get('indiasale_tbl')
            ->result();
        }
         foreach ($rows as $r) {
            if ($r->user_id_role == 3) {
                $user = $this->db->select('name')->where('id', $r->user_id)->get('branch_franchise')->row();
            } else {
                $user = $this->db->select('name')->where('id', $r->user_id)->get('user_master')->row();
            }
            $r->user_id = $user->name ?? '';
        }
        $data['instants'] = $rows;

        $this->load->view('admin/template/header', $data);
        $this->load->view('admin/dashboard/instantKyc', $data);
        $this->load->view('admin/template/footer', $data);
    }

    public function myleads()
    {
        
        $data['loans'] = 0;
        $uid = $this->session->userdata('user_id');
        $role = $this->session->userdata('role');
        
        $domain_id = domain_id_get();
        $processIdsPaper = [7, 8, 9, 10, 11, 12, 14, 15, 16, 20]; 
        $processIdsdigital = [1, 2, 3, 4,5, 6, 17]; 
         // Get user data
        $user_data = $this->db->where('id', $uid)
        ->where('role', $role)
        ->where('domain_id', $domain_id)
        ->where('status',1)
        ->get('user_master')
        ->row_array();
        
        if (empty($user_data)) {
            $user_data = $this->db->where('id', $uid)
            ->where('role', $role)
            ->where('domain_id', $domain_id)
            ->where('status',1)
            ->get('branch_franchise')
            ->row_array();
        }
        
        // Team user ids
        $teamUserIds = [];
        $userIds = array();
        $userIdsrole = array();
        $uid = $user_data['id'];
        $userIds[] = $user_data['id'];
        $userIdsrole[] = $user_data['role'];
        
        if ($role != 1) {
            $users = $this->db->select('id,role')
            ->where('domain_id', $domain_id)
                ->where('parent_id', $uid)
                ->where('parent_id_role', $this->session->userdata('role'))
                ->get('user_master')
                ->result_array();
                
                if (!empty($users)) {
                foreach ($users as $user) {
                    $userIds[]     = $user['id'];
                    $teamUserIds[] = $user['id'];
                    $userIdsrole[] = $user['role'];
                }
            }
        }
        
        if (empty($teamUserIds)) {
            $teamUserIds = [-1];
        }

        //myteam userids 

        // Code for parent_team_id START
        $myteamuserIds     = [$uid];
        $myteamUserIds = [];
        $myteamUserIdsrole = [];
        
        if ($role != 1) {
           $users = $this->db->select('id,role')
            ->where('domain_id', $domain_id)
                ->where('parent_team_id', $uid)
                ->where('parent_team_role','2')
                ->where('status',1)
                ->get('user_master')
                ->result_array();
                
                if (empty($users)) {
                $users = $this->db->select('id,role')
                ->where('domain_id', $domain_id)
                ->where('parent_team_id', $uid)
                ->where('parent_team_role','2')
                ->where('status',1)
                ->get('branch_franchise')
                ->result_array();
                }
                
                if (!empty($users)) {
                foreach ($users as $user) {
                    $myteamuserIds[]     = $user['id'];
                    $myteamUserIdsrole[] = $user['role'];
                }
            }
        }
        
        if (empty($myteamuserIds)) {
            $myteamuserIds = [-1];
        }else{
            // foreach($myteamUserIds as $myteamUserId){
            //     $users = $this->db->select('id')
            //                 ->where('domain_id', $domain_id)
            //                 ->where('parent_id', $myteamUserId)
            //                 ->get('user_master')
            //                 ->result_array();
                            
            //                 if (!empty($users)) {
            //                 foreach ($users as $user) {
            //                     $myteamUserIds[]     = $user['id'];
            //                 }
            //             }
            // }
            $this->db->select('id');
                $this->db->from('user_master');
                $this->db->where('domain_id', $domain_id);
                $this->db->where('status', 1);

                $hasCondition = false;

                foreach ($myteamuserIds as $key => $pid) {

                    $prole = $myteamUserIdsrole[$key] ?? null;

                    if ($prole !== null) {

                        if (!$hasCondition) {
                            $this->db->group_start();
                            $hasCondition = true;
                        }

                        $this->db->or_group_start()
                                ->where('parent_id', $pid)
                                ->where('parent_id_role', $prole)
                                ->group_end();
                    }
                }

                if ($hasCondition) {
                    $this->db->group_end();
                }

                $users = $this->db->get()->result_array();

            // IDs collect करो
            if (!empty($users)) {
                foreach ($users as $user) {
                    $myteamuserIds[] = $user['id'];
                }
            }
        }

        // Code for parent_team_id END
        
        $data['paperProcessLeads'] = $this->Dashboard_Model->paperProcessData('leads', $processIdsPaper);
        $data['leads'] = $this->Dashboard_Model->digitalProcessData('leads', $processIdsdigital);
        // print_r($this->db->last_query());die;
        $data['team_leads_paper'] = 0;
        $data['team_leads_digital'] = 0;

        if ($user_data['parent_id'] == '' || $user_data['parent_id'] == 0 || $user_data['parent_id'] == NULL) {
            $data['team_leads_paper'] = $this->db
                ->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])
                ->where_in('process_id', $processIdsPaper)
                ->where_in('uid', $teamUserIds)->order_by('id', 'DESC')
                ->get('leads')
                ->result();
            $data['team_leads_digital'] = $this->db
                ->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])
                ->where_in('process_id', $processIdsdigital)
                ->where_in('uid', $teamUserIds)->order_by('id', 'DESC')
                ->get('leads')
                ->result();
        }

        //Parent Team lead data 
        $user_id = $this->session->userdata('user_id');
        $my_team_user = $this->db->from('user_master');
        if ($this->session->userdata('type') != 'admin') {
            $team_user = $this->db->where('domain_id', $domain_id);
        }
        $team_user = $this->db->where('parent_team_id', $user_id);
        $team_user = $this->count2 = $this->db->count_all_results();

        if($team_user > 0 && $this->session->userdata('role') == 2){
            $data['team_leads_paper'] = $this->db
                ->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])
                ->where_in('process_id', $processIdsPaper)
                ->where_in('uid', $myteamuserIds)->order_by('id', 'DESC')
                ->get('leads')
                ->result();
            $data['team_leads_digital'] = $this->db
                ->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])
                ->where_in('process_id', $processIdsdigital)
                ->where_in('uid', $myteamuserIds)->order_by('id', 'DESC')
                ->get('leads')
                ->result();
        }

        $data['adminColor'] = $this->db->where( array('domain_id' => $domain_id))->get('admin_color')->row_array();

        $this->load->view('admin/template/header', $data);
        $this->load->view('admin/dashboard/myleads', $data);
        $this->load->view('admin/template/footer', $data);
    }

    public function payout()
    {
        $uid       = $this->session->userdata('user_id');
        $role      = $this->session->userdata('role');
        $domain_id = domain_id_get();

        $processIdsPaper   = [7, 8, 9, 10, 11, 12, 14, 15, 16, 20];
        $processIdsdigital = [1, 2, 3, 4, 5, 6, 17];
        $user_data = $this->db->where('id', $uid)->where('role', $role)->where('domain_id', $domain_id)->get('user_master')->row_array();

       $user_data = $this->db->where('id', $uid)
        ->where('role', $role)
        ->where('domain_id', $domain_id)
        ->where('status',1)
        ->get('user_master')
        ->row_array();
        
        if (empty($user_data)) {
            $user_data = $this->db->where('id', $uid)
            ->where('role', $role)
            ->where('domain_id', $domain_id)
            ->where('status',1)
            ->get('branch_franchise')
            ->row_array();
        }
        
        // Team user ids
        $teamUserIds = [];
        $userIds = array();
        $userIdsrole = array();
        $uid = $user_data['id'];
        $userIds[] = $user_data['id'];
        $userIdsrole[] = $user_data['role'];
        
        if ($role != 1) {
            $users = $this->db->select('id,role')
            ->where('domain_id', $domain_id)
                ->where('parent_id', $uid)
                ->where('parent_id_role', $this->session->userdata('role'))
                ->where('status',1)
                ->get('user_master')
                ->result_array();
                
                if (!empty($users)) {
                foreach ($users as $user) {
                    $userIds[]     = $user['id'];
                    $teamUserIds[] = $user['id'];
                    $userIdsrole[] = $user['role'];
                }
            }
        }
        
        if (empty($teamUserIds)) {
            $teamUserIds = [-1];
        }

        //myteam userids 

        // Code for parent_team_id START
        $myteamuserIds     = [$uid];
        $myteamUserIds = [];
        $myteamUserIdsrole = [];
        
        if ($role != 1) {
            $users = $this->db->select('id,role')
            ->where('domain_id', $domain_id)
                ->where('parent_team_id', $uid)
                ->where('parent_team_role','2')
                ->where('status',1)
                ->get('user_master')
                ->result_array();
                
                if (empty($users)) {
                $users = $this->db->select('id,role')
                ->where('domain_id', $domain_id)
                ->where('parent_team_id', $uid)
                ->where('parent_team_role','2')
                ->where('status',1)
                ->get('branch_franchise')
                ->result_array();
                }
                
                if (!empty($users)) {
                foreach ($users as $user) {
                    $myteamuserIds[]     = $user['id'];
                    $myteamUserIdsrole[] = $user['role'];
                }
            }
        }
        
        if (empty($myteamuserIds)) {
            $myteamuserIds = [-1];
        }else{
            // foreach($myteamuserIds as $myteamUserId){
            //     $users = $this->db->select('id')
            //                 ->where('domain_id', $domain_id)
            //                 ->where('parent_id', $myteamUserId)
            //                 ->get('user_master')
            //                 ->result_array();
                            
            //                 if (!empty($users)) {
            //                 foreach ($users as $user) {
            //                     $myteamUserIds[]     = $user['id'];
            //                 }
            //             }
            // }
            $this->db->select('id');
                $this->db->from('user_master');
                $this->db->where('domain_id', $domain_id);
                $this->db->where('status', 1);

                $hasCondition = false;

                foreach ($myteamuserIds as $key => $pid) {

                    $prole = $myteamUserIdsrole[$key] ?? null;

                    if ($prole !== null) {

                        if (!$hasCondition) {
                            $this->db->group_start();
                            $hasCondition = true;
                        }

                        $this->db->or_group_start()
                                ->where('parent_id', $pid)
                                ->where('parent_id_role', $prole)
                                ->group_end();
                    }
                }

                if ($hasCondition) {
                    $this->db->group_end();
                }

                $users = $this->db->get()->result_array();

            // IDs collect करो
            if (!empty($users)) {
                foreach ($users as $user) {
                    $myteamuserIds[] = $user['id'];
                }
            }
        }

        // Code for parent_team_id END


        if ($user_data['parent_id'] == '' || $user_data['parent_id'] == 0 || $user_data['parent_id'] == NULL) {
            $data['payout_lead_paper'] = $this->db->select('*')->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('process_id', $processIdsPaper)->where('uid', $uid)->where('payment_amount_paid !=', '')->where('payment_amount_paid IS NOT NULL', null, false)->get('leads')->result();
            $data['payout_lead_digital'] = $this->db->select('*')->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('process_id', $processIdsdigital)->where('uid', $uid)->where('payment_amount_paid !=', '')->where('payment_amount_paid IS NOT NULL', null, false)->get('leads')->result();
             $data['team_payout_lead_digital'] = $this->db
                ->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])
                ->where_in('process_id', $processIdsdigital)
                ->where_in('uid', $teamUserIds)
                ->where('payment_amount_paid_team !=', '')->where('payment_amount_paid_team IS NOT NULL', null, false)
                ->order_by('id', 'DESC')->get('leads')
                ->result();
            $data['team_payout_lead_paper'] = $this->db
                ->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])
                ->where_in('process_id', $processIdsPaper)
                ->where_in('uid', $teamUserIds)
                ->where('payment_amount_paid_team !=', '')->where('payment_amount_paid_team IS NOT NULL', null, false)
                ->order_by('id', 'DESC')->get('leads')
                ->result();
        }

        // Team logic
        else if ($user_data['parent_id'] != '') {
            $data['payout_lead_paper'] = $this->db->select('*')->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('process_id', $processIdsPaper)->where('uid', $uid)->where('payment_amount_paid !=', '')->where('payment_amount_paid IS NOT NULL', null, false)->order_by('id', 'DESC')->get('leads')->result();
            $data['payout_lead_digital'] = $this->db->select('*')->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('process_id', $processIdsdigital)->where('uid', $uid)->where('payment_amount_paid !=', '')->where('payment_amount_paid IS NOT NULL', null, false)->order_by('id', 'DESC')->get('leads')->result();
        }

        // Admin override
        if ($role == 1) {
            $data['payout_lead_paper'] =  $this->db->select('*')->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('process_id', $processIdsPaper)->where('admin_id', 1)->where('payment_amount_paid !=', '')->where('payment_amount_paid IS NOT NULL', null, false)->order_by('id', 'DESC')->get('leads')->result();
            $data['payout_lead_digital'] = $this->db->select('*')->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('process_id', $processIdsdigital)->where('admin_id', 1)->where('payment_amount_paid !=', '')->where('payment_amount_paid IS NOT NULL', null, false)->order_by('id', 'DESC')->get('leads')->result();
        }

         //Parent Team lead data 
        $user_id = $this->session->userdata('user_id');
        $my_team_user = $this->db->from('user_master');
        if ($this->session->userdata('type') != 'admin') {
            $team_user = $this->db->where('domain_id', $domain_id);
        }
        $team_user = $this->db->where('parent_team_id', $user_id);
        $team_user = $this->count2 = $this->db->count_all_results();

        if($team_user > 0 && $this->session->userdata('role') == 2){
            $data['team_payout_lead_digital'] = $this->db
                ->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])
                ->where_in('process_id', $processIdsdigital)
                ->where_in('uid', $myteamuserIds)
                ->group_start()
                    ->group_start()
                        ->where('payment_amount_paid !=', '')
                        ->where('payment_amount_paid IS NOT NULL', null, false)
                    ->group_end()
                    ->or_group_start()
                        ->where('payment_amount_paid_team !=', '')
                        ->where('payment_amount_paid_team IS NOT NULL', null, false)
                    ->group_end()
                ->group_end()
                ->order_by('id', 'DESC')
                ->get('leads')
                ->result();

            $data['team_payout_lead_paper'] = $this->db
                ->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])
                ->where_in('process_id', $processIdsPaper)
                ->where_in('uid', $myteamuserIds)
                ->group_start()
                    ->group_start()
                        ->where('payment_amount_paid !=', '')
                        ->where('payment_amount_paid IS NOT NULL', null, false)
                    ->group_end()
                    ->or_group_start()
                        ->where('payment_amount_paid_team !=', '')
                        ->where('payment_amount_paid_team IS NOT NULL', null, false)
                    ->group_end()
                ->group_end()
                ->order_by('id', 'DESC')
                ->get('leads')
                ->result();
        }
        
        $data['adminColor'] = $this->db->where(array('domain_id' => $domain_id))->get('admin_color')->row_array();
        $this->load->view('admin/template/header', $data);
        $this->load->view('admin/dashboard/payout', $data);
        $this->load->view('admin/template/footer', $data);
    }

    public function disbursement()
    {
        $uid       = $this->session->userdata('user_id');
        $role      = $this->session->userdata('role');
        $domain_id = domain_id_get();
        $processIdsPaper   = [7, 8, 9, 10, 11, 12, 14, 15, 16, 20];
        $processIdsdigital = [1, 2, 3, 4, 5, 6, 17];
        $user_data = $this->db->where('id', $uid)
        ->where('role', $role)
        ->where('domain_id', $domain_id)
        ->where('status',1)
        ->get('user_master')
        ->row_array();
        
        if (empty($user_data)) {
            $user_data = $this->db->where('id', $uid)
            ->where('role', $role)
            ->where('domain_id', $domain_id)
            ->where('status',1)
            ->get('branch_franchise')
            ->row_array();
        }
        
        // Team user ids
        $teamUserIds = [];
        $userIds = array();
        $userIdsrole = array();
        $uid = $user_data['id'];
        $userIds[] = $user_data['id'];
        $userIdsrole[] = $user_data['role'];
        
        if ($role != 1) {
            $users = $this->db->select('id,role')
            ->where('domain_id', $domain_id)
            ->where('status',1)
                ->where('parent_id', $uid)
                ->where('parent_id_role', $this->session->userdata('role'))
                ->get('user_master')
                ->result_array();
                
                if (!empty($users)) {
                foreach ($users as $user) {
                    $userIds[]     = $user['id'];
                    $teamUserIds[] = $user['id'];
                    $userIdsrole[] = $user['role'];
                }
            }
        }
        
        if (empty($teamUserIds)) {
            $teamUserIds = [-1];
        }

        //myteam userids 

        // Code for parent_team_id START
        $myteamuserIds     = [$uid];
        $myteamUserIds = [];
        $myteamUserIdsrole = [];
        
        if ($role != 1) {
           $users = $this->db->select('id,role')
            ->where('domain_id', $domain_id)
                ->where('parent_team_id', $uid)
                ->where('parent_team_role','2')
                ->where('status',1)
                ->get('user_master')
                ->result_array();
                
                if (empty($users)) {
                $users = $this->db->select('id,role')
                ->where('domain_id', $domain_id)
                ->where('parent_team_id', $uid)
                ->where('parent_team_role','2')
                ->where('status',1)
                ->get('branch_franchise')
                ->result_array();
                }
                
                if (!empty($users)) {
                foreach ($users as $user) {
                    $myteamuserIds[]     = $user['id'];
                    $myteamUserIdsrole[] = $user['role'];
                }
            }
        }
        
        if (empty($myteamuserIds)) {
            $myteamuserIds = [-1];
        }else{
            // foreach($myteamuserIds as $myteamUserId){
            //     $users = $this->db->select('id')
            //                 ->where('domain_id', $domain_id)
            //                 ->where('parent_id', $myteamUserId)
            //                 ->get('user_master')
            //                 ->result_array();
                            
            //                 if (!empty($users)) {
            //                 foreach ($users as $user) {
            //                     $myteamuserIds[]     = $user['id'];
            //                 }
            //             }
            // }
            $this->db->select('id');
                $this->db->from('user_master');
                $this->db->where('domain_id', $domain_id);
                $this->db->where('status', 1);

                $hasCondition = false;

                foreach ($myteamuserIds as $key => $pid) {

                    $prole = $myteamUserIdsrole[$key] ?? null;

                    if ($prole !== null) {

                        if (!$hasCondition) {
                            $this->db->group_start();
                            $hasCondition = true;
                        }

                        $this->db->or_group_start()
                                ->where('parent_id', $pid)
                                ->where('parent_id_role', $prole)
                                ->group_end();
                    }
                }

                if ($hasCondition) {
                    $this->db->group_end();
                }

                $users = $this->db->get()->result_array();

            // IDs collect करो
            if (!empty($users)) {
                foreach ($users as $user) {
                    $myteamuserIds[] = $user['id'];
                }
            }
        }

        // Code for parent_team_id END

        if ($user_data['parent_id'] == '' || $user_data['parent_id'] == 0 || $user_data['parent_id'] == NULL) {
            $data['disbursemenets_lead_paper'] = $this->db->select('*')->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('process_id', $processIdsPaper)->where('uid', $uid)->where('disbursed !=', '')->where('disbursed IS NOT NULL', null, false)->get('leads')->result();
            $data['disbursemenets_lead_digital'] = $this->db->select('*')->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('process_id', $processIdsdigital)->where('uid', $uid)->where('disbursed !=', '')->where('disbursed IS NOT NULL', null, false)->get('leads')->result();
            $data['team_disbursemenets_lead_digital'] = $this->db
                ->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])
                ->where_in('process_id', $processIdsdigital)
                ->where_in('uid', $teamUserIds)
                ->where('disbursed_team !=', '')->where('disbursed_team IS NOT NULL', null, false)
                ->order_by('id', 'DESC')->get('leads')
                ->result();
            $data['team_disbursemenets_lead_paper'] = $this->db
                ->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])
                ->where_in('process_id', $processIdsPaper)
                ->where_in('uid', $teamUserIds)
                ->where('disbursed_team !=', '')->where('disbursed_team IS NOT NULL', null, false)
                ->order_by('id', 'DESC')->get('leads')
                ->result();
        }
        // Team logic
        else if ($user_data['parent_id'] != '') {
            $data['disbursemenets_lead_paper'] = $this->db->select('*')->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('process_id', $processIdsPaper)->where('uid', $uid)->where('disbursed !=', '')->where('disbursed IS NOT NULL', null, false)->order_by('id', 'DESC')->get('leads')->result();
            $data['disbursemenets_lead_digital'] = $this->db->select('*')->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('process_id', $processIdsdigital)->where('uid', $uid)->where('disbursed !=', '')->where('disbursed IS NOT NULL', null, false)->order_by('id', 'DESC')->get('leads')->result();
        }

        //Parent Team lead data 
        $user_id = $this->session->userdata('user_id');
        $my_team_user = $this->db->from('user_master');
        if ($this->session->userdata('type') != 'admin') {
            $team_user = $this->db->where('domain_id', $domain_id);
        }
        $team_user = $this->db->where('parent_team_id', $user_id);
        $team_user = $this->count2 = $this->db->count_all_results();

        if($team_user > 0 && $this->session->userdata('role') == 2){
            // $data['disbursemenets_lead_paper'] = $this->db->select('*')->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('process_id', $processIdsPaper)->where('uid', $uid)->where('disbursed !=', '')->where('disbursed IS NOT NULL', null, false)->get('leads')->result();
            // $data['disbursemenets_lead_digital'] = $this->db->select('*')->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('process_id', $processIdsdigital)->where('uid', $uid)->where('disbursed !=', '')->where('disbursed IS NOT NULL', null, false)->get('leads')->result();
           $data['team_disbursemenets_lead_digital'] = $this->db
                                    ->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])
                                    ->where_in('process_id', $processIdsdigital)
                                    ->where_in('uid', $myteamuserIds)
                                    ->group_start()
                                        ->group_start()
                                            ->where('disbursed_team !=', '')
                                            ->where('disbursed_team IS NOT NULL', null, false)
                                        ->group_end()
                                        ->or_group_start()
                                            ->where('disbursed !=', '')
                                            ->where('disbursed IS NOT NULL', null, false)
                                        ->group_end()
                                    ->group_end()
                                    ->order_by('id', 'DESC')
                                    ->get('leads')
                                    ->result();

            $data['team_disbursemenets_lead_paper'] = $this->db
                                ->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])
                                ->where_in('process_id', $processIdsPaper)
                                ->where_in('uid', $myteamuserIds)
                                ->group_start()
                                    ->group_start()
                                        ->where('disbursed_team !=', '')
                                        ->where('disbursed_team IS NOT NULL', null, false)
                                    ->group_end()
                                    ->or_group_start()
                                        ->where('disbursed !=', '')
                                        ->where('disbursed IS NOT NULL', null, false)
                                    ->group_end()
                                ->group_end()
                                ->order_by('id', 'DESC')
                                ->get('leads')
                                ->result();


        }

        // Admin override
        if ($role == 1) {
            $data['disbursemenets_lead_paper'] = $this->db->select('*')->where_in('process_id', $processIdsPaper)->where('admin_id', 1)->where('disbursed !=', '')->where('disbursed IS NOT NULL', null, false)->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->order_by('id', 'DESC')->get('leads')->result();
            $data['disbursemenets_lead_digital'] = $this->db->select('*')->where_in('process_id', $processIdsdigital)->where('admin_id', 1)->where('disbursed !=', '')->where('disbursed IS NOT NULL', null, false)->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->order_by('id', 'DESC')->get('leads')->result(); 
        //    echo '<pre>'; print_r($data['disbursemenets_lead_digital']);die;
        }

        $data['adminColor'] = $this->db->where(['domain_id' => $domain_id])->get('admin_color')->row_array();
        $this->load->view('admin/template/header', $data);
        $this->load->view('admin/dashboard/disbursement', $data);
        $this->load->view('admin/template/footer', $data);
    }
 
    public function approved()
    {
        
       $data['loans'] = 0;

        $uid       = $this->session->userdata('user_id');
        $role      = $this->session->userdata('role');
        $domain_id = domain_id_get();

        $processIdsPaper   = [7, 8, 9, 10, 11, 12, 14, 15, 16, 20];
        $processIdsdigital = [1, 2, 3, 4, 5, 6, 17];

        // Get user data
        $user_data = $this->db->where('id', $uid)
        ->where('role', $role)
        ->where('domain_id', $domain_id)
        ->where('status',1)
        ->get('user_master')
        ->row_array();
        
        if (empty($user_data)) {
            $user_data = $this->db->where('id', $uid)
            ->where('role', $role)
            ->where('domain_id', $domain_id)
            ->where('status',1)
            ->get('branch_franchise')
            ->row_array();
        }
        
        // Team user ids
        $teamUserIds = [];
        $userIds = array();
        $userIdsrole = array();
        $uid = $user_data['id'];
        $userIds[] = $user_data['id'];
        $userIdsrole[] = $user_data['role'];
        
        if ($role != 1) {
            $users = $this->db->select('id,role')
            ->where('domain_id', $domain_id)
                ->where('parent_id', $uid)
                ->where('status',1)
                ->where('parent_id_role', $this->session->userdata('role'))
                ->get('user_master')
                ->result_array();
                
                if (!empty($users)) {
                foreach ($users as $user) {
                    $userIds[]     = $user['id'];
                    $teamUserIds[] = $user['id'];
                    $userIdsrole[] = $user['role'];
                }
            }
        }
        
        if (empty($teamUserIds)) {
            $teamUserIds = [-1];
        }

        //myteam userids 

        // Code for parent_team_id START
        $myteamuserIds     = [$uid];
        $myteamUserIds = [];
        $myteamUserIdsrole = [];
        
        if ($role != 1) {
           $users = $this->db->select('id,role')
            ->where('domain_id', $domain_id)
                ->where('parent_team_id', $uid)
                ->where('parent_team_role','2')
                ->where('status',1)
                ->get('user_master')
                ->result_array();
                
                if (empty($users)) {
                $users = $this->db->select('id,role')
                ->where('domain_id', $domain_id)
                ->where('parent_team_id', $uid)
                ->where('parent_team_role','2')
                ->where('status',1)
                ->get('branch_franchise')
                ->result_array();
                }
                
                if (!empty($users)) {
                foreach ($users as $user) {
                    $myteamuserIds[]     = $user['id'];
                    $myteamUserIdsrole[] = $user['role'];
                }
            }
        }
        
        if (empty($myteamuserIds)) {
            $myteamuserIds = [-1];
        }else{
            // foreach($myteamuserIds as $myteamUserId){
            //     $users = $this->db->select('id')
            //                 ->where('domain_id', $domain_id)
            //                 ->where('parent_id', $myteamUserId)
            //                 ->get('user_master')
            //                 ->result_array();
                            
            //                 if (!empty($users)) {
            //                 foreach ($users as $user) {
            //                     $myteamuserIds[]     = $user['id'];
            //                 }
            //             }
            // }
            $this->db->select('id');
                $this->db->from('user_master');
                $this->db->where('domain_id', $domain_id);
                $this->db->where('status', 1);

                $hasCondition = false;

                foreach ($myteamuserIds as $key => $pid) {

                    $prole = $myteamUserIdsrole[$key] ?? null;

                    if ($prole !== null) {

                        if (!$hasCondition) {
                            $this->db->group_start();
                            $hasCondition = true;
                        }

                        $this->db->or_group_start()
                                ->where('parent_id', $pid)
                                ->where('parent_id_role', $prole)
                                ->group_end();
                    }
                }

                if ($hasCondition) {
                    $this->db->group_end();
                }

                $users = $this->db->get()->result_array();

            // IDs collect करो
            if (!empty($users)) {
                foreach ($users as $user) {
                    $myteamuserIds[] = $user['id'];
                }
            }
        }

        // Code for parent_team_id END

        if ($user_data['parent_id'] == '' || $user_data['parent_id'] == 0 || $user_data['parent_id'] == NULL) {
            $data['paper_Approved'] = $this->db->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('process_id', $processIdsPaper)->where('uid', $uid)->where('lead_status', 'Apporved')->get('leads')->result();
            $data['digital_Approved'] = $this->db->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('process_id', $processIdsdigital)->where('uid', $uid)->where('lead_status', 'Apporved')->get('leads')->result();
             $data['team_approved_lead_digital'] = $this->db
                ->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])
                ->where_in('process_id', $processIdsdigital)
                ->where_in('uid', $teamUserIds)
                ->where('lead_status', 'Apporved')
                ->order_by('id', 'DESC')
                ->get('leads')
                ->result();
                // print_r( $data['team_approved_lead_digital']);die;
            $data['team_approved_lead_paper'] = $this->db
                ->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])
                ->where_in('process_id', $processIdsPaper)
                ->where_in('uid', $teamUserIds)
                ->where('lead_status', 'Apporved')
                ->order_by('id', 'DESC')
                ->get('leads')
                ->result();
        }
        // Team logic
        else if ($user_data['parent_id'] != '') {
            $data['paper_Approved'] = $this->db->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('process_id', $processIdsPaper)->where_in('uid', $uid)->where('lead_status', 'Apporved')->order_by('id', 'DESC')->get('leads')->result();
            $data['digital_Approved'] = $this->db->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('process_id', $processIdsdigital)->where_in('uid', $uid)->where('lead_status', 'Apporved')->order_by('id', 'DESC')->get('leads')->result();
        }
        // Admin override
        if ($role == 1) {
            $data['paper_Approved'] = $this->db->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('process_id', $processIdsPaper)->where('lead_status', 'Apporved')->order_by('id', 'DESC')->get('leads')->result();
            $data['digital_Approved'] = $this->db->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('process_id', $processIdsdigital)->where('lead_status', 'Apporved')->order_by('id', 'DESC')->get('leads')->result();
        }

         //Parent Team lead data 
        $user_id = $this->session->userdata('user_id');
        $my_team_user = $this->db->from('user_master');
        if ($this->session->userdata('type') != 'admin') {
            $team_user = $this->db->where('domain_id', $domain_id);
        }
        $team_user = $this->db->where('parent_team_id', $user_id);
        $team_user = $this->count2 = $this->db->count_all_results();

        if($team_user > 0 && $this->session->userdata('role') == 2){
            $data['team_approved_lead_digital'] = $this->db
                ->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])
                ->where_in('process_id', $processIdsdigital)
                ->where_in('uid', $myteamuserIds)
                ->where('lead_status', 'Apporved')
                ->order_by('id', 'DESC')->get('leads')
                ->result();
                // print_r( $data['team_approved_lead_digital']);die;
            $data['team_approved_lead_paper'] = $this->db
                ->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])
                ->where_in('process_id', $processIdsPaper)
                ->where_in('uid', $myteamuserIds)
                ->where('lead_status', 'Apporved')
               ->order_by('id', 'DESC') ->get('leads')
                ->result();
        }

        $data['adminColor'] = $this->db->where( array('domain_id' => $domain_id))->get('admin_color')->row_array();
        $this->load->view('admin/template/header', $data);
        $this->load->view('admin/dashboard/approved', $data);
        $this->load->view('admin/template/footer', $data);
    }

    public function reject()
    {
        
       $data['loans'] = 0;

        $uid       = $this->session->userdata('user_id');
        $role      = $this->session->userdata('role');
        $domain_id = domain_id_get();

        $processIdsPaper   = [7, 8, 9, 10, 11, 12, 14, 15, 16, 20];
        $processIdsdigital = [1, 2, 3, 4, 5, 6, 17];

        // Get user data
        $user_data = $this->db->where('id', $uid)
        ->where('role', $role)
        ->where('domain_id', $domain_id)
        ->where('status',1)
        ->get('user_master')
        ->row_array();
        
        if (empty($user_data)) {
            $user_data = $this->db->where('id', $uid)
            ->where('role', $role)
            ->where('domain_id', $domain_id)
            ->where('status',1)
            ->get('branch_franchise')
            ->row_array();
        }
        
        // Team user ids
        $teamUserIds = [];
        $userIds = array();
        $userIdsrole = array();
        $uid = $user_data['id'];
        $userIds[] = $user_data['id'];
        $userIdsrole[] = $user_data['role'];
        
        if ($role != 1) {
            $users = $this->db->select('id,role')
            ->where('domain_id', $domain_id)
            ->where('status',1)
                ->where('parent_id', $uid)
                ->where('parent_id_role', $this->session->userdata('role'))
                ->get('user_master')
                ->result_array();
                
                if (!empty($users)) {
                foreach ($users as $user) {
                    $userIds[]     = $user['id'];
                    $teamUserIds[] = $user['id'];
                    $userIdsrole[] = $user['role'];
                }
            }
        }
        
        if (empty($teamUserIds)) {
            $teamUserIds = [-1];
        }

        //myteam userids 

        // Code for parent_team_id START
        $myteamuserIds     = [$uid];
        $myteamUserIds = [];
        $myteamUserIdsrole = [];
        
        if ($role != 1) {
            $users = $this->db->select('id,role')
            ->where('domain_id', $domain_id)
                ->where('parent_team_id', $uid)
                ->where('parent_team_role','2')
                ->where('status',1)
                ->get('user_master')
                ->result_array();
                
                if (empty($users)) {
                $users = $this->db->select('id,role')
                ->where('domain_id', $domain_id)
                ->where('parent_team_id', $uid)
                ->where('parent_team_role','2')
                ->where('status',1)
                ->get('branch_franchise')
                ->result_array();
                }
                
                if (!empty($users)) {
                foreach ($users as $user) {
                    $myteamuserIds[]     = $user['id'];
                    $myteamUserIdsrole[] = $user['role'];
                }
            }
        }
        
        if (empty($myteamuserIds)) {
            $myteamuserIds = [-1];
        }else{
            // foreach($myteamuserIds as $myteamUserId){
            //     $users = $this->db->select('id')
            //                 ->where('domain_id', $domain_id)
            //                 ->where('parent_id', $myteamUserId)
            //                 ->get('user_master')
            //                 ->result_array();
                            
            //                 if (!empty($users)) {
            //                 foreach ($users as $user) {
            //                     $myteamuserIds[]     = $user['id'];
            //                 }
            //             }
            // }
            $this->db->select('id');
                $this->db->from('user_master');
                $this->db->where('domain_id', $domain_id);
                $this->db->where('status', 1);

                $hasCondition = false;

                foreach ($myteamuserIds as $key => $pid) {

                    $prole = $myteamUserIdsrole[$key] ?? null;

                    if ($prole !== null) {

                        if (!$hasCondition) {
                            $this->db->group_start();
                            $hasCondition = true;
                        }

                        $this->db->or_group_start()
                                ->where('parent_id', $pid)
                                ->where('parent_id_role', $prole)
                                ->group_end();
                    }
                }

                if ($hasCondition) {
                    $this->db->group_end();
                }

                $users = $this->db->get()->result_array();

            // IDs collect करो
            if (!empty($users)) {
                foreach ($users as $user) {
                    $myteamuserIds[] = $user['id'];
                }
            }
        }

        // Code for parent_team_id END
        
        if ($user_data['parent_id'] == '' || $user_data['parent_id'] == 0 || $user_data['parent_id'] == NULL) {
            $data['paper_reject'] = $this->db->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('process_id', $processIdsPaper)->where('uid', $uid)->where('lead_status', 'Reject')->get('leads')->result();
            $data['digital_reject'] = $this->db->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('process_id', $processIdsdigital)->where('uid', $uid)->where('lead_status', 'Reject')->get('leads')->result();
            $data['team_reject_lead_digital'] = $this->db
                ->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])
                ->where_in('process_id', $processIdsdigital)
                ->where_in('uid', $teamUserIds)
                ->where('lead_status', 'Reject')
                ->order_by('id', 'DESC')->get('leads')
                ->result();
            $data['team_reject_lead_paper'] = $this->db
                ->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])
                ->where_in('process_id', $processIdsPaper)
                ->where_in('uid', $teamUserIds)
                ->where('lead_status', 'Reject')
                ->order_by('id', 'DESC')->get('leads')
                ->result();
        }

        // Team logic
        else if ($user_data['parent_id'] != '') {
            $data['paper_reject'] = $this->db->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('process_id', $processIdsPaper)->where('uid', $uid)->where('lead_status', 'Reject')->order_by('id', 'DESC')->get('leads')->result();
            $data['digital_reject'] = $this->db->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('process_id', $processIdsdigital)->where('uid', $uid)->where('lead_status', 'Reject')->order_by('id', 'DESC')->get('leads')->result();

        }

        // Admin override
        if ($role == 1) {
            $data['paper_reject'] = $this->db->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('process_id', $processIdsPaper)->where('lead_status', 'Reject')->order_by('id', 'DESC')->get('leads')->result();
            $data['digital_reject'] = $this->db->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('process_id', $processIdsdigital)->where('lead_status', 'Reject')->order_by('id', 'DESC')->get('leads')->result();
        }

         //Parent Team lead data 
        $user_id = $this->session->userdata('user_id');
        $my_team_user = $this->db->from('user_master');
        if ($this->session->userdata('type') != 'admin') {
            $team_user = $this->db->where('domain_id', $domain_id);
        }
        $team_user = $this->db->where('parent_team_id', $user_id);
        $team_user = $this->count2 = $this->db->count_all_results();

        if($team_user > 0 && $this->session->userdata('role') == 2){
            $data['team_reject_lead_digital'] = $this->db
                ->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])
                ->where_in('process_id', $processIdsdigital)
                ->where_in('uid', $myteamuserIds)
                ->where('lead_status', 'Reject')
                ->order_by('id', 'DESC')->get('leads')
                ->result();
            $data['team_reject_lead_paper'] = $this->db
                ->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])
                ->where_in('process_id', $processIdsPaper)
                ->where_in('uid', $myteamuserIds)
                ->where('lead_status', 'Reject')
                ->order_by('id', 'DESC')->get('leads')
                ->result();
        }

        $data['adminColor'] = $this->db->where( array('domain_id' => $domain_id))->get('admin_color')->row_array();

        $this->load->view('admin/template/header', $data);
        $this->load->view('admin/dashboard/reject', $data);
        $this->load->view('admin/template/footer', $data);
    }

     public function referral_data()
    {
        $uid       = $this->session->userdata('user_id');
        $role      = $this->session->userdata('role');
        $domain_id = domain_id_get();
        
        // Get user data
        $user_data = $this->db->where('id', $uid)->where('role', $role)->where('domain_id', $domain_id)->get('user_master')->row_array();
        if (empty($user_data)) {
        $user_data = $this->db->where('id', $uid)->where('role', $role)->where('domain_id', $domain_id)->get('branch_franchise')->row_array();
        }

        // Team user ids
        $userIds     = [$uid];
        $teamUserIds = [];

        if ($role != 1) {
            $users = $this->db->select('id')->where('domain_id', $domain_id)->where('parent_id', $uid)->where('status',1)->get('user_master')->result_array();

            if (!empty($users)) {
                foreach ($users as $user) {
                    $userIds[]     = $user['id'];
                    $teamUserIds[] = $user['id'];
                }
            }
        }

        if (empty($teamUserIds)) {
            $teamUserIds = [-1];
        }
        
        // Referral amount  

         $query = $this->db->where('referral_amount !=',0)->where('status',1);

        ($this->session->userdata('type') != 'admin')
            ? $query->where('domain_id', $domain_id)
            : null;

        ($this->session->userdata('role') != 1)
            ? $query->where_in('parent_id', $teamUserIds)
            : null;

        $data['datas'] = $query->order_by('id', 'DESC')->get('user_master')->result();

        $data['adminColor'] = $this->db->where( array('domain_id' => $domain_id))->get('admin_color')->row_array();
        $this->load->view('admin/template/header', $data);
        $this->load->view('admin/dashboard/referral', $data);
        $this->load->view('admin/template/footer', $data);
    }


     public function loan_lead_mange()
    {
        $uid       = $this->session->userdata('user_id');
        $role      = $this->session->userdata('role');
        $domain_id = domain_id_get();

        $data['totalLoans'] = $this->Dashboard_Model->loandata('loan_master');

        // Get user data
        $user_data = $this->db->where('id', $uid)
        ->where('role', $role)
        ->where('domain_id', $domain_id)
        ->where('status',1)
        ->get('user_master')
        ->row_array();
        
        if (empty($user_data)) {
            $user_data = $this->db->where('id', $uid)
            ->where('role', $role)
            ->where('domain_id', $domain_id)
            ->where('status',1)
            ->get('branch_franchise')
            ->row_array();
        }
        
        // Team user ids
        $teamUserIds = [];
        $userIds = array();
        $userIdsrole = array();
        $uid = $user_data['id'];
        $userIds[] = $user_data['id'];
        $userIdsrole[] = $user_data['role'];
        
        if ($role != 1) {
            $users = $this->db->select('id,role')
            ->where('domain_id', $domain_id)
            ->where('status',1)
                ->where('parent_id', $uid)
                ->where('parent_id_role', $this->session->userdata('role'))
                ->get('user_master')
                ->result_array();
                
                if (!empty($users)) {
                foreach ($users as $user) {
                    $userIds[]     = $user['id'];
                    $teamUserIds[] = $user['id'];
                    $userIdsrole[] = $user['role'];
                }
            }
        }
        
        if (empty($teamUserIds)) {
            $teamUserIds = [-1];
        }

        //myteam userids 

        // Code for parent_team_id START
        $myteamuserIds     = [$uid];
        $myteamUserIds = [];
        $myteamUserIdsrole = [];
        
        if ($role != 1) {
            $users = $this->db->select('id,role')
            ->where('domain_id', $domain_id)
                ->where('parent_team_id', $uid)
                ->where('parent_team_role','2')
                ->where('status',1)
                ->get('user_master')
                ->result_array();
                
                if (empty($users)) {
                $users = $this->db->select('id,role')
                ->where('domain_id', $domain_id)
                ->where('parent_team_id', $uid)
                ->where('parent_team_role','2')
                ->where('status',1)
                ->get('branch_franchise')
                ->result_array();
                }
                
                if (!empty($users)) {
                foreach ($users as $user) {
                    $myteamuserIds[]     = $user['id'];
                    $myteamUserIdsrole[] = $user['role'];
                }
            }
        }
        
        if (empty($myteamuserIds)) {
            $myteamuserIds = [-1];
        }else{
            // foreach($myteamuserIds as $myteamUserId){
            //     $users = $this->db->select('id')
            //                 ->where('domain_id', $domain_id)
            //                 ->where('parent_id', $myteamUserId)
            //                 ->get('user_master')
            //                 ->result_array();
                            
            //                 if (!empty($users)) {
            //                 foreach ($users as $user) {
            //                     $myteamuserIds[]     = $user['id'];
            //                 }
            //             }
            // }
            $this->db->select('id');
                $this->db->from('user_master');
                $this->db->where('domain_id', $domain_id);
                $this->db->where('status', 1);

                $hasCondition = false;

                foreach ($myteamuserIds as $key => $pid) {

                    $prole = $myteamUserIdsrole[$key] ?? null;

                    if ($prole !== null) {

                        if (!$hasCondition) {
                            $this->db->group_start();
                            $hasCondition = true;
                        }

                        $this->db->or_group_start()
                                ->where('parent_id', $pid)
                                ->where('parent_id_role', $prole)
                                ->group_end();
                    }
                }

                if ($hasCondition) {
                    $this->db->group_end();
                }

                $users = $this->db->get()->result_array();

            // IDs collect करो
            if (!empty($users)) {
                foreach ($users as $user) {
                    $myteamuserIds[] = $user['id'];
                }
            }
        }

        // Code for parent_team_id END

        $loan_name_digital = ['Business Loan', 'Personal Loan', 'Instant Loan'];
        $loan_name_paper   = ['Home Loan'];
        // For digital process
        if ($user_data['parent_id'] == '' || $user_data['parent_id'] == 0 || $user_data['parent_id'] == NULL) {
           
            //loan master
            $data['payout_loan_digital'] = $this->db->where('payment_amount_paid !=', '')->where('payment_amount_paid IS NOT NULL', null, false)->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('apply_for_loan', $loan_name_digital)->where('user_id', $uid)->get('loan_master')->result_array();
            $data['digital_loan_reject'] = $this->db->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('apply_for_loan', $loan_name_digital)->where('user_id', $uid)->where('loan_status', 'Reject')->get('loan_master')->result_array();
            $data['digital_loan_approved'] = $this->db->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('apply_for_loan', $loan_name_digital)->where('user_id', $uid)->where('loan_status', 'Apporved')->get('loan_master')->result_array();
            $data['disbursemenets_loan_digital'] = $this->db->where('disbursed !=', '')->where('disbursed IS NOT NULL', null, false)->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('apply_for_loan', $loan_name_digital)->where('user_id', $uid)->get('loan_master')->result_array();
            //team
            $data['team_loans_rejects_digital'] = $this->db->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('apply_for_loan', $loan_name_digital)->where('loan_status', 'Reject')->where_in('user_id', $teamUserIds)->get('loan_master')->result_array();
            $data['team_loans_approved_digital'] = $this->db->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('apply_for_loan', $loan_name_digital)->where('loan_status', 'Apporved')->where_in('user_id', $teamUserIds)->get('loan_master')->result_array();
            $data['team_payout_loan_digital'] = $this->db->where('payment_amount_paid_team !=', '')->where('payment_amount_paid_team IS NOT NULL', null, false)->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('apply_for_loan', $loan_name_digital)->where_in('user_id', $teamUserIds)->get('loan_master')->result_array();
            $data['team_disbursemenets_loan_digital'] = $this->db->where('disbursed_team !=', '')->where('disbursed_team IS NOT NULL', null, false)->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('apply_for_loan', $loan_name_digital)->where_in('user_id', $teamUserIds)->get('loan_master')->result_array();
            $data['team_loans_digital'] = $this->db->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('apply_for_loan', $loan_name_digital)->where_in('user_id', $teamUserIds)->get('loan_master')->result_array();

        } else if ($user_data['parent_id'] != '') {
            // loan master
            $data['payout_loan_digital'] = $this->db->where('payment_amount_paid_team !=', '')->where('payment_amount_paid_team IS NOT NULL', null, false)->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('apply_for_loan', $loan_name_digital)->where('user_id', $uid)->get('loan_master')->result_array();
            $data['digital_loan_reject'] = $this->db->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('apply_for_loan', $loan_name_digital)->where('user_id', $uid)->where('loan_status', 'Reject')->get('loan_master')->result_array();
            $data['digital_loan_approved'] = $this->db->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('apply_for_loan', $loan_name_digital)->where('user_id', $uid)->where('loan_status', 'Apporved')->get('loan_master')->result_array();
            $data['disbursemenets_loan_digital'] = $this->db->where('disbursed_team !=', '')->where('disbursed_team IS NOT NULL', null, false)->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('apply_for_loan', $loan_name_digital)->where('user_id', $uid)->get('loan_master')->result_array(); 
        } 

        // Admin-specific data
        if ($role == 1) {
            //loan master
            $data['payout_loan_digital'] = $this->db->where('payment_amount_paid !=', '')->where('payment_amount_paid IS NOT NULL', null, false)->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('apply_for_loan', $loan_name_digital)->where('admin_id', 1)->get('loan_master')->result_array();
            $data['digital_loan_reject'] = $this->db->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('apply_for_loan', $loan_name_digital)->where('loan_status', 'Reject')->get('loan_master')->result_array();
            $data['digital_loan_approved'] = $this->db->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('apply_for_loan', $loan_name_digital)->where('loan_status', 'Apporved')->get('loan_master')->result_array();    
            $data['disbursemenets_loan_digital'] = $this->db->where('disbursed !=', '')->where('disbursed IS NOT NULL', null, false)->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('apply_for_loan', $loan_name_digital)->where('admin_id', 1)->get('loan_master')->result_array(); 

        }
        //Parent Team lead data 
        $user_id = $this->session->userdata('user_id');
        $my_team_user = $this->db->from('user_master');
        if ($this->session->userdata('type') != 'admin') {
            $team_user = $this->db->where('domain_id', $domain_id);
        }
        $team_user = $this->db->where('parent_team_id', $user_id);
        $team_user = $this->count2 = $this->db->count_all_results();

        if($team_user > 0 && $this->session->userdata('role') == '2'){
            $data['team_loans_digital'] = $this->db->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('apply_for_loan', $loan_name_digital)->where_in('user_id', $myteamuserIds)->get('loan_master')->result_array();
            $data['team_disbursemenets_loan_digital'] = $this->db->where('disbursed_team !=', '')->where('disbursed_team IS NOT NULL', null, false)->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('apply_for_loan', $loan_name_digital)->where_in('user_id', $myteamuserIds)->get('loan_master')->result_array();
            $data['team_payout_loan_digital'] = $this->db->where('payment_amount_paid_team !=', '')->where('payment_amount_paid_team IS NOT NULL', null, false)->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('apply_for_loan', $loan_name_digital)->where_in('user_id', $myteamuserIds)->get('loan_master')->result_array();
            $data['team_loans_rejects_digital'] = $this->db->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('apply_for_loan', $loan_name_digital)->where('loan_status', 'Reject')->where_in('user_id', $myteamuserIds)->get('loan_master')->result_array();
            $data['team_loans_approved_digital'] = $this->db->where(($this->session->userdata('type') != 'admin') ? ['domain_id' => $domain_id] : [])->where_in('apply_for_loan', $loan_name_digital)->where('loan_status', 'Apporved')->where_in('user_id', $myteamuserIds)->get('loan_master')->result_array();
        }

        $data['adminColor'] = $this->db->where( array('domain_id' => $domain_id))->get('admin_color')->row_array();
        $this->load->view('admin/template/header', $data);
        $this->load->view('admin/dashboard/disbursement_payout_loan', $data);
        $this->load->view('admin/template/footer', $data);
    }

  

    public function category()
    {
        $data['datas'] = $this->Dashboard_Model->common_all('category');
        $this->load->view('admin/template/header');
        $this->load->view('admin/category/view', $data);
        $this->load->view('admin/template/footer');
    }

    public function categoryForm()
    {
        $this->form_validation->set_rules('category', 'Category', 'required|trim|is_unique[category.category]');
        $this->form_validation->set_rules('status', 'Status', 'required|trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');
        $this->form_validation->set_rules('is_unique', 'The %s entered is already in use');

        if ($this->form_validation->run()) {

            if ($_FILES['cat_image']['name'] != "") {
                $config['upload_path'] = './upload/assets/images/';
                $config['max_size'] = 1024;
                $config['allowed_types'] = 'jpg|jpeg|png';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ($this->upload->do_upload('cat_image')) {
                    $uploadImg = $this->upload->data();
                    $data['cat_image'] = $uploadImg['file_name'];
                } else {
                    $ierror = $this->upload->display_errors();
                    $this->session->set_flashdata('imgerror', $ierror);
                    redirect('add-category', 'refresh');
                }
            }

            $data['category'] = $this->input->post('category');
            $data['status'] = $this->input->post('status');
            $data['created_at'] = date('d m Y H:i:s');
            $data['slug'] = url_title($data['category'], 'dash', true);

            $insert = $this->Dashboard_Model->common_insert($data, 'category');

            if ($insert) {
                $this->session->set_flashdata('success', 'Category Data Insert Successfully!!');
                redirect('add-category');
            } else {
                $this->session->set_flashdata('error', 'Something Went Wrong, try again!!');
                redirect('add-category');
            }

        } else {
            $this->load->view('admin/template/header');
            $this->load->view('admin/category/form');
            $this->load->view('admin/template/footer');
        }
    }

    public function categoryEdit($id)
    {
        if (ctype_digit(strval($id))) {
            $data['datas'] = $this->Dashboard_Model->common_row($id, 'category');
            $this->load->view('admin/template/header');
            $this->load->view('admin/category/edit', $data);
            $this->load->view('admin/template/footer');

        } else {
            redirect('category');
        }
    }

    public function categoryUpdate()
    {
        $this->form_validation->set_rules('category', 'Category', 'required|trim');
        $this->form_validation->set_rules('status', 'Status', 'required|trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');

        if ($this->form_validation->run()) {

            if ($_FILES['cat_image']['name'] != "") {
                $config['upload_path'] = './upload/assets/images/';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ($this->upload->do_upload('cat_image')) {
                    $uploadImg = $this->upload->data();
                    $data['cat_image'] = $uploadImg['file_name'];
                } else {
                    //$data['cat_image'] = $this->upload->display_errors();
                    // print_r($data['cat_image']);
                }
                $data['cat_image'] = $uploadImg['file_name'];

            } else { $data['cat_image'] = $this->input->post('old_img');}

            $data['category'] = $this->input->post('category');
            $data['status'] = $this->input->post('status');
            $data['updeated_at'] = date('d m Y H:i:s');
            $id = $this->input->post('id');
            $data['slug'] = url_title($data['category'], 'dash', true);

            $update = $this->Dashboard_Model->common_update($id, $data, 'category');

            if ($update) {
                $this->session->set_flashdata('success', 'Category Data Update Successfully!!');
                redirect('category');
            } else {
                $this->session->set_flashdata('error', 'Something Went Wrong, try again!!');
                redirect('category');
            }
        } else {
            $this->load->view('admin/template/header');
            $this->load->view('admin/category/form');
            $this->load->view('admin/template/footer');
        }
    }

    public function categoryDelete($id)
    {
        $delete = $this->Dashboard_Model->common_delete($id, 'category');
        if ($delete) {
            $this->session->set_flashdata('success', 'Category Data Update Successfully!!');
            redirect('category');
        } else {
            $this->session->set_flashdata('error', 'Something Went Wrong, try again!!');
            redirect('category');
        }
    }

    public function categoryStatusUpdate()
    {
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $data = ['status' => $status];
        $update = $this->Dashboard_Model->common_update($id, $data, 'category');
        echo $update;
    }

    public function subcategory()
    {
        $data['datas'] = $this->db->query("select category.category as category_name, subcategory.* FROM subcategory JOIN category ON category.id = subcategory.category")->result();
        $this->load->view('admin/template/header');
        $this->load->view('admin/subcategory/view', $data);
        $this->load->view('admin/template/footer');
    }

    public function subcategoryForm()
    {
        $this->form_validation->set_rules('category', 'Category', 'required|trim');
        $this->form_validation->set_rules('subcategory', 'Subcategory', 'required|trim|is_unique[subcategory.subcategory]');
        $this->form_validation->set_rules('status', 'Status', 'required|trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');
        $this->form_validation->set_rules('is_unique', 'The %s entered is already exist');
        if ($this->form_validation->run()) {

            if ($_FILES['sub_cat_image']['name'] != "") {
                $config['upload_path'] = './upload/assets/images/cate/';
                $config['max_size'] = 1024;
                $config['allowed_types'] = 'jpg|jpeg|png';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ($this->upload->do_upload('sub_cat_image')) {
                    $uploadImg = $this->upload->data();
                    $data['sub_cat_image'] = $uploadImg['file_name'];
                } else {
                    $ierror = $this->upload->display_errors();
                    $this->session->set_flashdata('imgerror', $ierror);
                    redirect('add-subcategory', 'refresh');
                }
            }
            $data['category'] = $this->input->post('category');
            $data['is_child'] = $this->input->post('is_child');
            $data['subcategory'] = $this->input->post('subcategory');
            $data['status'] = $this->input->post('status');
            $data['created_at'] = date('d m Y H:i:s');
            $data['subcategory_slug'] = url_title($data['subcategory'], 'dash', true);

            $insert = $this->Dashboard_Model->common_insert($data, 'subcategory');

            if ($insert) {
                $this->session->set_flashdata('success', 'Subcategory Data Insert Successfully!!');
                redirect('add-subcategory');
            } else {
                $this->session->set_flashdata('error', 'Something Went Wrong, try again!!');
                redirect('add-subcategory');
            }

        } else {
            $all['datas'] = $this->Dashboard_Model->common_all('category');
            $this->load->view('admin/template/header');
            $this->load->view('admin/subcategory/form', $all);
            $this->load->view('admin/template/footer');
        }
    }

    public function subcategoryEdit($id)
    {
        $data['datas'] = $this->Dashboard_Model->common_all('category');
        $data['single'] = $this->Dashboard_Model->common_row($id, 'subcategory');
        $this->load->view('admin/template/header');
        $this->load->view('admin/subcategory/edit', $data);
        $this->load->view('admin/template/footer');
    }

    public function subcategoryUpdate()
    {
        $this->form_validation->set_rules('category', 'Category', 'required|trim');
        $this->form_validation->set_rules('subcategory', 'Subcategory', 'required|trim');
        $this->form_validation->set_rules('status', 'Status', 'required|trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');

        if ($this->form_validation->run()) {

            if ($_FILES['sub_cat_image']['name'] != "") {
                $config['upload_path'] = './upload/assets/images/';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ($this->upload->do_upload('sub_cat_image')) {
                    $uploadImg = $this->upload->data();
                    $data['sub_cat_image'] = $uploadImg['file_name'];
                } else {
                    //$data['cat_image'] = $this->upload->display_errors();
                    // print_r($data['cat_image']);
                }
                $data['sub_cat_image'] = $uploadImg['file_name'];

            } else { $data['sub_cat_image'] = $this->input->post('old_img');}

            $data['is_child'] = $this->input->post('is_child');
            $data['category'] = $this->input->post('category');
            $data['subcategory'] = $this->input->post('subcategory');
            $data['status'] = $this->input->post('status');
            $data['updeated_at'] = date('d m Y H:i:s');
            $data['subcategory_slug'] = url_title($data['subcategory'], 'dash', true);

            $id = $this->input->post('id');
            $update = $this->Dashboard_Model->common_update($id, $data, 'subcategory');

            if ($update) {
                $this->session->set_flashdata('success', 'Subategory Data Update Successfully!!');
                redirect('subcategory');
            } else {
                $this->session->set_flashdata('error', 'Something Went Wrong, try again!!');
                redirect('subcategory');
            }

        } else {
            $all['datas'] = $this->Dashboard_Model->common_all('category');
            $this->load->view('admin/template/header');
            $this->load->view('admin/subcategory/form', $all);
            $this->load->view('admin/template/footer');
        }
    }

    public function subcategoryDelete($id)
    {
        $delete = $this->Dashboard_Model->common_delete($id, 'subcategory');
        if ($delete) {
            $this->session->set_flashdata('success', 'Subcategory delete successfully');
            redirect('subcategory');
        } else {
            $this->session->set_flashdata('error', 'Something Went Wrong');
            redirect('subcategory');
        }
    }

    public function subcategoryStatusUpdate()
    {
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $data = ['status' => $status];
        $update = $this->Dashboard_Model->common_update($id, $data, 'subcategory');
        echo $update;
    }

    public function childSubcategory()
    {
        $data['datas'] = $this->db->query("select subcategory.subcategory as sub_cat_name, childSubcategory.* FROM childSubcategory JOIN subcategory ON subcategory.id = childSubcategory.subcategory_id ")->result();
        $this->load->view('admin/template/header');
        $this->load->view('admin/subcategory/childView.php', $data);
        $this->load->view('admin/template/footer');
    }

    public function childSubcategoryForm()
    {
        $this->form_validation->set_rules('subcategory_id', 'Sub Category', 'required|trim');
        $this->form_validation->set_rules('child_sub_cat_name', 'Child SubCategory Name', 'required|trim|is_unique[childSubcategory.child_sub_cat_name]');
        $this->form_validation->set_rules('status', 'Status', 'required|trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');
        $this->form_validation->set_rules('is_unique', 'The %s entered is already exist');
        if ($this->form_validation->run()) {

            if ($_FILES['child_sub_cat_image']['name'] != "") {
                $config['upload_path'] = './upload/assets/images/cate/';
                $config['max_size'] = 1024;
                $config['allowed_types'] = 'jpg|jpeg|png';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ($this->upload->do_upload('child_sub_cat_image')) {
                    $uploadImg = $this->upload->data();
                    $data['child_sub_cat_image'] = $uploadImg['file_name'];
                } else {
                    $ierror = $this->upload->display_errors();
                    $this->session->set_flashdata('imgerror', $ierror);
                    redirect('admin/child-subcategory', 'refresh');
                }
            }
            $data['subcategory_id'] = $this->input->post('subcategory_id');
            $data['child_sub_cat_name'] = $this->input->post('child_sub_cat_name');
            $data['child_sub_cat_slug'] = url_title($data['child_sub_cat_name'], 'dash', true);
            $data['status'] = $this->input->post('status');
            $data['created_at'] = date('d m Y H:i:s');

            $insert = $this->Dashboard_Model->common_insert($data, 'childSubcategory');
            if ($insert) {
                $this->session->set_flashdata('success', 'Child Subcategory Data Insert Successfully!!');
                redirect('admin/child-subcategory');
            } else {
                $this->session->set_flashdata('error', 'Something Went Wrong, try again!!');
                redirect('admin/child-subcategory');
            }
        } else {
            $all['datas'] = $all['datas'] = $this->db->get_where('subcategory', ['is_child' => 1])->result();
            $this->load->view('admin/template/header');
            $this->load->view('admin/subcategory/childForm.php', $all);
            $this->load->view('admin/template/footer');
        }
    }

    public function childSubcategoryEdit($id)
    {
        $data['datas'] = $this->db->get_where('subcategory', ['is_child' => 1])->result();
        $data['single'] = $this->Dashboard_Model->common_row($id, 'childSubcategory');
        $this->load->view('admin/template/header');
        $this->load->view('admin/subcategory/childEdit', $data);
        $this->load->view('admin/template/footer');

    }

    public function childSubcategoryUpdate()
    {
        $this->form_validation->set_rules('subcategory_id', 'Sub Category', 'required|trim');
        $this->form_validation->set_rules('child_sub_cat_name', 'Child SubCategory Name', 'required|trim|is_unique[childSubcategory.child_sub_cat_name]');
        $this->form_validation->set_rules('status', 'Status', 'required|trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');
        $this->form_validation->set_rules('is_unique', 'The %s entered is already exist');
        if ($this->form_validation->run()) {

            if ($_FILES['child_sub_cat_image']['name'] != "") {
                $config['upload_path'] = './upload/assets/images/cate/';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ($this->upload->do_upload('child_sub_cat_image')) {
                    $uploadImg = $this->upload->data();
                    $data['child_sub_cat_image'] = $uploadImg['file_name'];
                } else {
                    //$data['cat_image'] = $this->upload->display_errors();
                    // print_r($data['cat_image']);
                }
                $data['child_sub_cat_image'] = $uploadImg['file_name'];

            } else { $data['child_sub_cat_image'] = $this->input->post('old_img');}
            $id = $this->input->post('id');
            $data['subcategory_id'] = $this->input->post('subcategory_id');
            $data['child_sub_cat_name'] = $this->input->post('child_sub_cat_name');
            $data['child_sub_cat_slug'] = url_title($data['child_sub_cat_name'], 'dash', true);
            $data['status'] = $this->input->post('status');
            $data['updeated_at'] = date('d m Y H:i:s');

            $update = $this->Dashboard_Model->common_update($id, $data, 'childSubcategory');

            if ($update) {
                $this->session->set_flashdata('success', 'Child Subcategory Data Update Successfully!!');
                redirect('admin/child-subcategory');
            } else {
                $this->session->set_flashdata('error', 'Something Went Wrong, try again!!');
                redirect('admin/child-subcategory');
            }
        } else {
            $all['datas'] = $all['datas'] = $this->db->get_where('subcategory', ['is_child' => 1])->result();
            $this->load->view('admin/template/header');
            $this->load->view('admin/subcategory/childForm.php', $all);
            $this->load->view('admin/template/footer');
        }

    }

    public function childSubcategoryDelete($id)
    {
        $delete = $this->Dashboard_Model->common_delete($id, 'childSubcategory');
        if ($delete) {
            $this->session->set_flashdata('success', 'Child Subcategory delete successfully');
            redirect('admin/child-subcategory');
        } else {
            $this->session->set_flashdata('error', 'Something Went Wrong');
            redirect('admin/child-subcategory');
        }
    }

    public function childSubcategoryStatusUpdate()
    {
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $data = ['status' => $status];
        $update = $this->Dashboard_Model->common_update($id, $data, 'childSubcategory');
        echo $update;
    }

    public function contactUs()
    {
        $all['datas'] = $this->Dashboard_Model->common_all('contactUs');
        $this->load->view('admin/template/header');
        $this->load->view('admin/page/contact-view', $all);
        $this->load->view('admin/template/footer');
    }

    public function registerUser()
    {
        if (!has_permission('My Customers') && $this->session->userdata('type') != 'admin') {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
        }
        if($this->session->userdata('role') == '2'){
            $uid = $this->session->userdata('user_id');
            $users = $this->Dashboard_Model->all_customer('registerUser',$uid);
        }else{
            $users = $this->Dashboard_Model->common_alls('registerUser');

        }

        if (!empty($users)) {
            foreach ($users as $user) {
                if (!empty($user->domain_id)) {
                    $domain = $this->Dashboard_Model->get_domain_by_url($user->domain_id);
                    if ($domain) {
                        $user->domain_url = $domain->url;
                    } else {
                        $user->domain_url = 'No domain found';
                    }
                }
            }
        }

        $all['datas'] = $users;
        
        // $all['datas'] = $this->Dashboard_Model->common_alls('registerUser');

        $all['city'] = $this->Dashboard_Model->city_all('registerUser');
        $this->load->view('admin/template/header');
        $this->load->view('admin/page/registeruser', $all);
        $this->load->view('admin/template/footer');
    }

    public function branchProfiledetail($id)
    {
        if (!has_permission('Branch Franchise')) {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            }
        $all['profile'] = $this->Dashboard_Model->get_branch($id);
        $this->load->view('admin/template/header');
        $this->load->view('admin/page/branchuserdetail', $all);
        $this->load->view('admin/template/footer');
    }

    public function userProfiledetail($id)
    {
        $all['profile'] = $this->Dashboard_Model->profile_data($id);
        $this->load->view('admin/template/header');
        $this->load->view('admin/page/dsauserdetail', $all);
        $this->load->view('admin/template/footer');
    }

    public function editUser($id)
    {
        if (!has_permission('My Customers')) {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            }
        $all['datas'] = $this->Dashboard_Model->get_user($id);
        $all['domains'] = $this->db->where('status',1)->get('domains')->result_array();
        
        $uid = $this->session->userdata('user_id');
        
        $teamData = $this->Dashboard_Model->getadminTeamData($uid);
         $all['teamData'] = $teamData;
         
        $networkData = $this->Dashboard_Model->getTeamData($uid, 'network');
        $all['networkData'] = $networkData;


        $this->load->view('admin/template/header');
        $this->load->view('admin/page/editUser', $all);
        $this->load->view('admin/template/footer');
    }

    public function editDetail($id)
    {
        if (!has_permission('My Customers')) {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            }
        $all['datas'] =  $this->db->from('user_bank_loan_detail')->where('user_id', $id)->get()->row_array();
        $all['banks'] = $this->db->from('tbl_banks')->get()->result_array();
        $all['id'] = $id;

     
        $this->load->view('admin/template/header');
        $this->load->view('admin/page/editDetail', $all);
        $this->load->view('admin/template/footer');
    }

    public function viewUser($id)
    {
        if (!has_permission('My Customers')) {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            }
        $all['datas'] = $this->Dashboard_Model->get_user_view($id);
        $domain_id = domain_id_get();
        $all['eligibilityData'] = $this->db->from('check_user_data')->where(array('domain_id' => $domain_id))->where('uid', $id)->get()->row_array();
        $all['transection'] = $this->db->from('tbl_transection')->where(array('domain_id' => $domain_id))->where('uid', $id)->get()->row_array();  
        $all['user'] = $this->db->from('registerUser')->where(array('domain_id' => $domain_id))->where('id', $id)->get()->row_array();  
        $all['pre_approval'] = $this->db->from('pre_approval')->where(array('domain_id' => $domain_id))->where('uid', $id)->get()->row_array();  
        $this->load->view('admin/template/header');
        $this->load->view('admin/page/viewUser', $all);
        $this->load->view('admin/template/footer');
    }

   public function updateUser()
    { 
        if (!has_permission('My Customers')) {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
        }
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $username = $this->input->post('username');
        $mobile = $this->input->post('mobile');
        $status = $this->input->post('status');
        $email = $this->input->post('email');
        $domain_id = $this->input->post('domain_id');
        $parent_team_id = $this->input->post('parent_team_id');
        
        $updateArr = [
            'name' => $name,
            'username' => $username,
            'mobile' => $mobile,
            'status' => $status,
            'updated_at' => date('Y-m-d H:i:s'),
        ];

       $this->db->from('registerUser')
            ->where('email', $email)
            ->where('domain_id', $domain_id)
            ->where('id !=', $id)
            ->where('email NOT LIKE', '%Unpaid--%')
            ->where('email NOT LIKE', '%Deleted--%');

        $existingUser = $this->db->get()->row();

        if ($existingUser) {
            $this->session->set_flashdata('message', 'A user with this email already exists in this domain.');
            redirect('admin/edit-user/' . $id);
            return;
        } else {
            $updateArr['transfer_status'] = 1;
            $updateArr['domain_id'] = $domain_id;
        }
        
        if (!empty($parent_team_id)) {
            $updateArr['parent_team_id'] = $parent_team_id;
            
        }

        $updateStatus = $this->Dashboard_Model->update_user($id, $updateArr);
        if ($updateStatus) {
            redirect('admin/register-user');
        } else {
            redirect('admin/edit-user/' . $id);
        }
    }

    public function updateDetail()
    { 
        if (!has_permission('My Customers')) {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            }
        $id = $this->input->post('id');
        $user_id = $this->input->post('user_id');
        $datas =  $this->db->from('user_bank_loan_detail')->where('id', $id)->get()->row_array();

        $updateArr = [
            'amount' => $this->input->post('amount'),
            'bank_id' => $this->input->post('bank_id'),
            'emi' => $this->input->post('emi'),
            'tenure' => $this->input->post('tenure'),
            'interest' => $this->input->post('interest'),
            'disbusment' => $this->input->post('disbusment'),
            'remark' => $this->input->post('remark'),
            'user_id' => $this->input->post('user_id'),
           
        ];
        if(!empty($datas)){
            $updateArr['updated_at'] = date('Y-m-d H:s:i');
            $this->db->where('id', $id);
            $this->db->update('user_bank_loan_detail', $updateArr);
        }
        else{
            $this->db->insert('user_bank_loan_detail', $updateArr);
        }
  
        redirect('admin/register-user');
        
    }

    public function channelPartnerUser()
    {
        if ($this->session->userdata('type') != 'admin' && !has_permission('DSA Registration')) {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
        }
        $final_data =[];
        $user = $this->session->userdata('user_id');
        if ($this->session->userdata('role') == 1) {
            $channel_partner_data = $this->Dashboard_Model->channel_partner();
       
        if (!empty($channel_partner_data)) {
            foreach ($channel_partner_data as $partner_detail) {

                if (!empty($partner_detail->domain_id)) {
                    $domain = $this->Dashboard_Model->get_domain_by_url($partner_detail->domain_id);
                    if ($domain) {
                        $partner_detail->domain_url = $domain->url;
                    } else {
                        $partner_detail->domain_url = 'No domain found';
                    }
                }

                $partner_detail->parent_name = '';
                $partner_detail->account_type = 'Registered User';
                if (!empty($partner_detail->parent_id)) {

                    $parent_data = $this->Dashboard_Model->get_channel_partner($partner_detail->parent_id);
                    if (!empty($parent_data)) {
                        $partner_detail->parent_name = $parent_data[0]->username;

                        if (!empty($partner_detail->subscription)) {
                            $partner_detail->account_type = 'Network Member';
                        } else {
                            $partner_detail->account_type = 'Team Member';
                        }

                    }

                }
            }
        }
        }else {
            // Get direct team members
            $this->db->from('user_master');
            $this->db->where('parent_team_id', $user);
             $this->db->where('status !=', 3);
            $direct_team = $this->db->get()->result(); // Changed to result() for object consistency
          
            // Get team member IDs for the next query
            $team_ids = [];
            foreach ($direct_team as $member) {
                $team_ids[] = $member->id;
            }
            
            if (empty($team_ids)) {
                $team_ids = [0];
            }
            
            // Get channel partners who have team members as parents
            $this->db->from('user_master');
            $this->db->where_in('parent_id', $team_ids);
            $this->db->where('status !=', 3);
            $this->db->order_by('id', 'DESC');
            $channel_partner= $this->db->get()->result();
            
            // Merge both results
            $channel_partner_data = array_merge($direct_team, $channel_partner);
        }
        //  echo '<pre>';print_r($final_data);die;
        $all['datas'] = $channel_partner_data;
        $all['city'] = $this->Dashboard_Model->city_all('user_master');
        $this->load->view('admin/template/header');
        $this->load->view('admin/page/channelUser', $all);
        $this->load->view('admin/template/footer');
    }

    public function branchfranchiseUser()
    {
        if ($this->session->userdata('type') != 'admin' && !has_permission('Branch Franchise')) {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            }
        $final_data =[];
        $user = $this->session->userdata('user_id');
        if ($this->session->userdata('role') == 1) {

        $channel_partner_data = $this->Dashboard_Model->branch_franchise();

        if (!empty($channel_partner_data)) {
            foreach ($channel_partner_data as $partner_detail) {

                if (!empty($partner_detail->domain_id)) {
                    $domain = $this->Dashboard_Model->get_domain_by_url($partner_detail->domain_id);
                    if ($domain) {
                        $partner_detail->domain_url = $domain->url;
                    } else {
                        $partner_detail->domain_url = 'No domain found';
                    }
                }
                
                $partner_detail->parent_name = '';
                $partner_detail->account_type = 'Registered User';
                if (!empty($partner_detail->parent_id)) {
                    $parent_data = $this->Dashboard_Model->get_branch($partner_detail->parent_id);
                    if (!empty($parent_data)) {
                        $partner_detail->parent_name = $parent_data[0]->username;

                        if (!empty($partner_detail->subscription)) {
                            $partner_detail->account_type = 'Network Member';
                        } else {
                            $partner_detail->account_type = 'Team Member';
                        }

                    }

                }
            }
        }
        }else {
            // Get direct team members
            $this->db->from('branch_franchise');
            $this->db->where('parent_team_id', $user);
            $this->db->where('status !=', 3);
            $direct_team = $this->db->get()->result(); // Changed to result() for object consistency
          
            // Get team member IDs for the next query
            $team_ids = [];
            foreach ($direct_team as $member) {
                $team_ids[] = $member->id;
            }
            
            if (empty($team_ids)) {
                $team_ids = [0];
            }
            
            // Get channel partners who have team members as parents
            $this->db->from('user_master');
            $this->db->where_in('parent_id', $team_ids);
            $this->db->where('role', 3);
           $this->db->where('status !=', 3);
            $this->db->order_by('id', 'DESC');
            $channel_partner= $this->db->get()->result();
            
            // Merge both results
            $channel_partner_data = array_merge($direct_team, $channel_partner);
        }

        $all['datas'] = $channel_partner_data;

        // $all['datas'] = $this->db->get('branch_franchise')->result();
        $all['city'] = $this->Dashboard_Model->city_all('branch_franchise');
        $this->load->view('admin/template/header');
        $this->load->view('admin/page/branchUser', $all);
        $this->load->view('admin/template/footer');
    }

    public function editChannelPartner($id)
    {
        if (!has_permission('DSA Registration')) {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            }
        $all['datas'] = $this->Dashboard_Model->get_channel_partner($id);
        $all['ref'] = empty($this->input->get('ref')) ? '' : $this->input->get('ref');
        $all['domains'] = $this->db->where('status',1)->get('domains')->result_array();
        $all['admins'] = $this->db->where('domain_id',domain_id_get())->where('role',1)->where('status',1)->get('user_master')->result_array();
        $all['dsas'] = $this->db->where('domain_id',domain_id_get())->where('role',2)->where('status',1)->where('parent_id', NULL)->get('user_master')->result_array();
        $all['branches'] = $this->db->where('domain_id',domain_id_get())->where('role',3)->where('status',1)->get('branch_franchise')->result_array();
        $all['customers'] = $this->db->where('domain_id',domain_id_get())->where('status',1)->get('registerUser')->result_array();

        $uid = $this->session->userdata('user_id');

        $teamData = $this->Dashboard_Model->getadminTeamData($uid);
         $all['teamData'] = $teamData;
         
        $networkData = $this->Dashboard_Model->getTeamData($uid, 'network');
        $all['networkData'] = $networkData;

        $this->load->view('admin/template/header');
        $this->load->view('admin/page/editChannelUser', $all);
        $this->load->view('admin/template/footer');
    }

    public function editbranchfranchise($id)
    {
        if (!has_permission('Branch Franchise')) {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            }
        $all['datas'] = $this->Dashboard_Model->get_branch($id);
        $all['ref'] = empty($this->input->get('ref')) ? '' : $this->input->get('ref');
        $all['domains'] = $this->db->where('status',1)->get('domains')->result_array();
        
        $uid = $this->session->userdata('user_id');
        
        $teamData = $this->Dashboard_Model->getadminTeamData($uid);
         $all['teamData'] = $teamData;
         
        $networkData = $this->Dashboard_Model->getTeamData($uid, 'network');
        $all['networkData'] = $networkData;


        $this->load->view('admin/template/header');
        $this->load->view('admin/page/editbranchUser', $all);
        $this->load->view('admin/template/footer');
    }

    public function deletePartner()
    {
        if (!has_permission('DSA Registration')) {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            }
        $id = $this->input->post('id');
        $c_data = $this->Dashboard_Model->get_channel_partner($id);
        $UpdateData['email'] = 'Deleted--' . $c_data[0]->email;
        $UpdateData['status'] = 3;
        $delStatus = $this->Dashboard_Model->update_channel_partner($id, $UpdateData);

        if ($delStatus) {
            echo "true";die;
        } else {
            echo "false";die;
        }
    }

    public function deletebranch()
    {
        if (!has_permission('Branch Franchise')) {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            }
        $id = $this->input->post('id');
        $c_data = $this->Dashboard_Model->get_branch($id);
        $UpdateData['email'] = 'Deleted--' . $c_data[0]->email;
        $UpdateData['status'] = 3;
        $delStatus = $this->Dashboard_Model->update_branch($id, $UpdateData);

        if ($delStatus) {
            echo "true";die;
        } else {
            echo "false";die;
        }
    }

    public function deleteUser()
    {
        if (!has_permission('My Customers')) {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            }
        $id = $this->input->post('id');
        $delStatus = $this->Dashboard_Model->delete_by_id("registerUser", $id);

        if ($delStatus) {
            echo "true";die;
        } else {
            echo "false";die;
        }
    }

    public function statusUser()
    {
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $data['status'] = ($status == 1 ? 0 : 1);
        $updateStatus = $this->Dashboard_Model->update_status($id, $data, "registerUser");

        if ($updateStatus) {
            $this->Dashboard_Model->remove_registerUser_unpaid_prefix($id); 
            $userDetails = $this->Dashboard_Model->get_registerUser_by_id($id);
            if ($userDetails) {
                $mobileNumber = $userDetails['mobile'];
                $email = $userDetails['email']; 
                $pass = $this->randomPassword();
                $hashedPassword = MD5($pass);

                $query = $this->db->from('registerUser')->where('id', $id)->get()->row_array();
                $email_config = $this->db->where('domain_id', $query['domain_id'])->get('email_config')->row_array();
                $admin_name = $this->db->where('domain_id', $query['domain_id'])->get('contect_us')->row_array();
                $domain = $this->db->where('id', $query['domain_id'])->get('domains')->row_array();
                $pass = $query['pass_text'];
           
                $to = $email;
                $subject = (!empty($admin_name['company_title']) ? $admin_name['company_title'] : '') . " User";
                $message = "You are successfully registrated to " . (!empty($admin_name['company_title']) ? $admin_name['company_title'] : '') . ". Your Password is:<strong>" . $pass . "</strong>";
                $message .= "\nDo not share with anyone. This Password is confidentially.";
                $header = "From:". (!empty($email_config['from_email']) ? $email_config['from_email'] : '') . " \r\n";
                $header .= "MIME-Version: 1.0\r\n";
                $header .= "Content-type: text/html\r\n";

                $email_data = array(
                    'mobile' => $mobileNumber,
                    'message' => "Dear%20Customer,%20Welcome%20to%20Instant%20Loans%20Deals%20Your%20Password%20is%20" . $pass . "%20More%20details:%20https://www.instantloansdeals.com%20EXELORA%20CONSULTANCY",
                );
        
                if($domain['social_status'] == 'sms') { $this->send_sms($email_data['mobile'], $email_data['message']);}else{$this->send_mail($to, $subject, $message);}
            } else {
                echo "false"; 
            }
        } else {
            echo "false"; 
        }
        die;
    }    
    
    public function statusAgent()
    {
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $data['status'] = ($status == 1 ? 0 : 1);
        $updateStatus = $this->Dashboard_Model->update_status($id, $data, "user_master");
        $change_password_status = $this->db->query("SELECT change_password_status FROM user_master WHERE id = ?", [$id]);
        $user = $this->db->where('id', $id)->get('user_master')->row_array();
        $email_config = $this->db->where('domain_id', $user['domain_id'])->get('email_config')->row_array();
        $admin_name = $this->db->where('domain_id', $user['domain_id'])->get('contect_us')->row_array();
        $domain = $this->db->where('id', $user['domain_id'])->get('domains')->row_array();

        if ($updateStatus) {
            $this->Dashboard_Model->remove_unpaid_prefix($id);
            $userDetails = $this->Dashboard_Model->get_user_by_id($id);
            if ($userDetails) {
                if( $status==2){
                    $mobileNumber = $userDetails['mobile_no'];
                    $email = $userDetails['email']; 
                    $pass = $user['pass_text'];
                    $to = $email;

                    $subject = (!empty($admin_name['company_title']) ? $admin_name['company_title'] : '') . " User";
                    $message = "You are successfully registrated to " . (!empty($admin_name['company_title']) ? $admin_name['company_title'] : '') . ". Your Password is:<strong>" . $pass . "</strong>";
                    $message .= "\nDo not share with anyone. This Password is confidentially.";
                    $header = "From:". (!empty($email_config['from_email']) ? $email_config['from_email'] : '') . " \r\n";
                    $header .= "MIME-Version: 1.0\r\n";
                    $header .= "Content-type: text/html\r\n";
                    $email_data = array(
                        'mobile' => $mobileNumber,
                        'message' => "Dear%20Customer,%20Welcome%20to%20Instant%20Loans%20Deals%20Your%20Password%20is%20" . $pass . "%20More%20details:%20https://www.instantloansdeals.com%20EXELORA%20CONSULTANCY",
                    );
                    if($domain['social_status'] == 'sms') { $this->send_sms($email_data['mobile'], $email_data['message']);}else{$this->send_mail($to, $subject, $message);}
                }
            } else {
                echo "false"; 
            }
        } else {
            echo "false"; 
        }
        die;
    }

    public function statusAgentss()
    {
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $data['status'] = ($status == 1 ? 0 : 1);
        $updateStatus = $this->Dashboard_Model->update_status($id, $data, "branch_franchise");
        $change_password_status = $this->db->query("SELECT change_password_status FROM branch_franchise WHERE id = ?", [$id]);
        $user = $this->db->where('id', $id)->get('branch_franchise')->row_array();
        $email_config = $this->db->where('domain_id', $user['domain_id'])->get('email_config')->row_array();
        $admin_name = $this->db->where('domain_id', $user['domain_id'])->get('contect_us')->row_array();
        $domain = $this->db->where('id', $user['domain_id'])->get('domains')->row_array();

        if ($updateStatus) {
            if ($updateStatus) {
                $this->Dashboard_Model->remove__branch_franchise_unpaid_prefix($id);
                $userDetails = $this->Dashboard_Model->get_branch_franchise_by_id($id);
                if ($userDetails) {
                    if($status == 2)
                    {
                        $mobileNumber = $userDetails['mobile_no']; 
                        $email = $userDetails['email']; 
                        $pass = $user['pass_text'];
                        $to = $email;
                        $subject = (!empty($admin_name['company_title']) ? $admin_name['company_title'] : '') . " User";
                        $message = "You are successfully registrated to " . (!empty($admin_name['company_title']) ? $admin_name['company_title'] : '') . ". Your Password is:<strong>" . $pass . "</strong>";
                        $message .= "\nDo not share with anyone. This Password is confidentially.";
                        $header = "From:". (!empty($email_config['from_email']) ? $email_config['from_email'] : '') . " \r\n";
                        $header .= "MIME-Version: 1.0\r\n";
                        $header .= "Content-type: text/html\r\n";

                        $email_data = array(
                            'mobile' => $mobileNumber,
                            'message' => "Dear%20Customer,%20Welcome%20to%20Instant%20Loans%20Deals%20Your%20Password%20is%20" . $pass . "%20More%20details:%20https://www.instantloansdeals.com%20EXELORA%20CONSULTANCY",
                        );
                        if($domain['social_status'] == 'sms') { $this->send_sms($email_data['mobile'], $email_data['message']);}else{$this->send_mail($to, $subject, $message);}
                    }
                }else {
                    echo "false";
                }
            } else {
                echo "false";
            }
        die;
        }
    
    }
    
    public function updateChannelPartner()
    {
        if (!has_permission('DSA Registration')) {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
        }

        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $username = $this->input->post('username');
        $mobile_no = $this->input->post('mobile_no');
        $city = $this->input->post('city');
        $pin_code = $this->input->post('pin_code');
        $payout = $this->input->post('payout');
        $disbursements = $this->input->post('disbursements');
        $ref = $this->input->post('ref');
        $rejected_file_count = $this->input->post('rejected_file_count');
        $approved_file_count = $this->input->post('approved_file_count');
        $referral_amount = $this->input->post('referral_amount') ?? 0;
        $email = $this->input->post('email');
        $domain_id = $this->input->post('domain_id');
        $parent_id = $this->input->post('parent_id');
        $parent_team_id = $this->input->post('parent_team_id');
        $assigned_rm = $this->input->post('assigned_rm');
        $assigned_rm_role = 2;
        $joining_date = $this->input->post('joining_date');
        $description = $this->input->post('description');
        $emp_profile = $this->input->post('emp_profile');
        $job_title = $this->security->xss_clean($this->input->post('job_title'));
        $emergency_number = $this->security->xss_clean($this->input->post('emergency_number'));
        $reporting_to = $this->security->xss_clean($this->input->post('reporting_to'));
        $proposed_start_date = $this->security->xss_clean($this->input->post('proposed_start_date'));
        $annual_salary = $this->security->xss_clean($this->input->post('annual_salary'));
        $work_schedule = $this->security->xss_clean($this->input->post('work_schedule'));
        $min_retainership_amount = $this->security->xss_clean($this->input->post('min_retainership_amount'));
        $max_retainership_amount = $this->security->xss_clean($this->input->post('max_retainership_amount'));

        $oldUser = $this->db->where('id', $id)->get('user_master')->row();
         if ($_FILES["profile_photo"]["size"] > 0) {
            $tmpFilePath = $_FILES['profile_photo']['tmp_name'];
            $fileinfo = @getimagesize($_FILES["profile_photo"]["tmp_name"]);
            $image_file_type = pathinfo($_FILES["profile_photo"]["name"], PATHINFO_EXTENSION);
            $newFilePath = 'upload/assets/profile_photo/' . time() . '.' . $image_file_type;
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                $profile_photo = $newFilePath;
            }
        }else{
            $profile_photo  =  $oldUser->profile_photo; 
        }


        $skipCheck = (stripos($email, 'Unpaid--') !== false || stripos($email, 'Deleted--') !== false);

        if (!$skipCheck) {
            $existingUser = $this->db
                ->from('user_master')
                ->where('email', $email)
                ->where('domain_id', $domain_id)
                ->where('id !=', $id)
                ->get()
                ->row();

            if ($existingUser) {
                $this->session->set_flashdata('message', 'A user with this email already exists in this domain.');
                redirect('admin/channel-partner/' . $id);
                return;
            }
        }

        $anyUser = $this->db
            ->from('user_master')
            ->where('email', $email)
            ->where('email NOT LIKE', 'Unpaid--%')
            ->where('email NOT LIKE', 'Deleted--%')
            ->get()
            ->row();

        $updateArr = [
            'name' => $name,
            'username' => $username,
            'mobile_no' => $mobile_no,
            'city' => $city,
            'pin_code' => $pin_code,
            'payout' => $payout,
            'disbursements' => $disbursements,
            'rejected_file_count' => $rejected_file_count,
            'approved_file_count' => $approved_file_count,
            'referral_amount' => $referral_amount,
            'domain_id' => $domain_id,
            'email' => $email,
            'assigned_rm' => $assigned_rm,
            'assigned_rm_role' => $assigned_rm_role,
             'emp_profile' => $emp_profile,
            'joining_date' => $joining_date,
            'profile_photo' => $profile_photo,
            'description' => $description,
            'job_title' => $job_title,
            'emergency_number' => $emergency_number,
            'reporting_to' => $reporting_to,
            'proposed_start_date' => $proposed_start_date,
            'annual_salary' => $annual_salary,
            'work_schedule' => $work_schedule,
            'min_retainership_amount' => $min_retainership_amount,
            'max_retainership_amount' => $max_retainership_amount,
        ];

        if (!$anyUser) {
            $updateArr['transfer_status'] = 1;
        }

        // ✔ If parent_id changed → set transfer_status_user = 1
        if (!empty($parent_id) && $parent_id != $oldUser->parent_id) {
            $updateArr['parent_id'] = $parent_id;
        }
        
        
        if (!empty($parent_team_id)) {
            $updateArr['parent_team_id'] = $parent_team_id;
            $updateArr['transfer_status_user'] = 1;
        }
        
        $updateStatus = $this->Dashboard_Model->update_channel_partner($id, $updateArr);
        if ($updateStatus) {
            if (empty($ref)) {
                redirect('admin/channel-partner');
            } else {
                redirect('admin/' . $ref);
            }
        } else {
            redirect('admin/channel-partner/' . $id);
        }
    }


    public function updatebranch()
    {
        if (!has_permission('Branch Franchise')) {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
        }

        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $username = $this->input->post('username');
        $mobile_no = $this->input->post('mobile_no');
        $city = $this->input->post('city');
        $pin_code = $this->input->post('pincode');
        $payout = $this->input->post('payout');
        $disbursements = $this->input->post('disbursements');
        $ref = $this->input->post('ref');
        $rejected_file_count = $this->input->post('rejected_file_count');
        $approved_file_count = $this->input->post('approved_file_count');
        $email = $this->input->post('email');
        $domain_id = $this->input->post('domain_id');
        $parent_team_id = $this->input->post('parent_team_id');
        $assigned_rm = $this->input->post('assigned_rm');
        $assigned_rm_role = 2;

        // 🚫 Skip duplicate check if email contains Unpaid-- or Deleted--
        $skipCheck = (stripos($email, 'Unpaid--') !== false || stripos($email, 'Deleted--') !== false);
        if (!$skipCheck) {
            // 🔍 Step 1: Check if another branch franchise with same email & domain exists
            $existingUser = $this->db
            ->from('branch_franchise')
            ->where('email', $email)
            ->where('domain_id', $domain_id)
                ->where('id !=', $id)
                ->get()
                ->row();
            // echo '<pre>';    print_r($existingUser);die;

            if ($existingUser) {
                $this->session->set_flashdata('message', 'A user with this email already exists in this domain.');
                redirect('admin/branch-franchise/' . $id);
                return;
            }
        }

        // 🔍 Step 2: Check if user exists in user_master (excluding Unpaid-- / Deleted--)
        $anyUser = $this->db
            ->from('user_master')
            ->where('email', $email)
            ->where('email NOT LIKE', 'Unpaid--%')
            ->where('email NOT LIKE', 'Deleted--%')
            ->get()
            ->row();

        // ✅ Step 3: Prepare update data
        $updateArr = [
            'name' => $name,
            'username' => $username,
            'mobile_no' => $mobile_no,
            'city' => $city,
            'pincode' => $pin_code,
            'payout' => $payout,
            'disbursements' => $disbursements,
            'rejected_file_count' => $rejected_file_count,
            'approved_file_count' => $approved_file_count,
            'email' => $email,
            'domain_id' => $domain_id,
            'assigned_rm' => $assigned_rm,
            'assigned_rm_role' => $assigned_rm_role,
        ];

        // 🟩 Step 4: If no user found in user_master → mark transfer_status = 1
        if (!$anyUser) {
            $updateArr['transfer_status'] = 1;
        }

        if (!empty($parent_team_id)) {
            $updateArr['parent_team_id'] = $parent_team_id;
            $updateArr['transfer_status'] = 1;
        }

        // 🔄 Step 5: Update record
        $updateStatus = $this->Dashboard_Model->update_branch($id, $updateArr);

        // 🔁 Step 6: Redirect
        if ($updateStatus) {
            if (empty($ref)) {
                redirect('admin/branch-franchise');
            } else {
                redirect('admin/' . $ref);
            }
        } else {
            redirect('admin/branch-franchise/' . $id);
        }
    }

    public function leads()
    {
        if (!has_permission('lead') && !has_permission('My lead')) {
            if ($this->session->userdata('type') != 'admin') {
                $this->session->set_flashdata('message', 'You do not have permission to access this section.');
                redirect('admin-dashboard');
                return;
            }
		}

        $role = $this->session->userdata('role');
        $uid = $this->session->userdata('user_id');
        $domain_id =  domain_id_get();
        $userIds = array();
        $userIdsrole = array();

        $main_user = $this->db->where('id', $this->session->userdata('user_id'))->where('role',$role)->where('domain_id', $domain_id)->get('user_master')->row();
        if (empty($main_user)) {
            $main_user = $this->db->where('id', $this->session->userdata('user_id'))->where('role',$role)->where('domain_id', $domain_id)->get('branch_franchise')->row();
        }
        // $userIds[] = $uid;
        $userIds[] = $main_user->id;
        $userIdsrole[] = $main_user->role;
// print_r($main_user);
        if ($role != 1) {
            $users = $this->db->select('id,role')->where(['parent_id'=> $this->session->userdata('user_id'),'parent_id_role'=> $this->session->userdata('role'),'domain_id' =>$domain_id ])->get('user_master')->result_array();
            // print_r($users);die;

            if (!empty($users)) {
                foreach ($users as $user) {
                    $userIds[] = $user['id'];
                    $userIdsrole[] = $user['role'];
                }
            }
        }

        if ($role == 1) {
            $data['datas'] = $this->db->where('domain_id', domain_id_get())->order_by('id', 'DESC')->get('leads')->result_array();
        } else {
            $data['datas'] = $this->db->where('domain_id', domain_id_get())->where_in('uid', $userIds)->where_in('uid_role', $userIdsrole)->order_by('id', 'DESC')->get('leads')->result();
        }

     

      
        $data['lead'] = $this->db->where('domain_id',$domain_id)->where('status',1)->get('leadtransfer')->row_array();

        // echo '<pre>';print_r( $data['datas'] );die;

        $this->load->view('admin/template/header');
        $this->load->view('admin/leads/view-ajax', $data);
        $this->load->view('admin/template/footer');
    }

    public function leadsthanks()
    {    
        $role = $this->session->userdata('role');
        $uid = $this->session->userdata('user_id');

        $userIds = array();
        $userIds[] = $uid;
        $domain_id =  domain_id_get();
        $data['heading'] = $this->Dashboard_Model->common_rows('leads','settings', $domain_id); 
        $data['lead'] = $this->db->where('domain_id',$domain_id)->where('status',1)->get('leadtransfer')->row_array();
        $this->load->view('admin/template/header');
        $this->load->view('admin/leads/thankyou', $data);
        $this->load->view('admin/template/footer');
    }

    public function getLeadsDataAjax2()
    {
        $role = $this->session->userdata('role');
        $uid = $this->session->userdata('user_id');
        $domain_id = domain_id_get();
        $main_user = $this->db->where('id', $this->session->userdata('user_id'))->where('role',$role)->where('domain_id', $domain_id)->where('status',1)->get('user_master')->row();
        if (empty($main_user)) {
            $main_user = $this->db->where('id', $this->session->userdata('user_id'))->where('role',$role)->where('domain_id', $domain_id)->where('status',1)->get('branch_franchise')->row();
        }
        $userIds = array();
        $userIdsrole = array();
        $uid = $main_user->id;
        $userIds[] = $main_user->id;
        $userIdsrole[] = $main_user->role;
        if ($role != 1) {
            $users = $this->db->select('id,role')->where(['parent_id'=> $this->session->userdata('user_id'),'parent_id_role'=> $this->session->userdata('role'),'domain_id' => $domain_id])->where('status',1)->get('user_master')->result_array();
            if (!empty($users)) {
                foreach ($users as $user) {
                    $userIds[] = $user['id'];
                    $userIdsrole[] = $user['role'];
                }
            }
        }

        $myteamUserIds = [];
        $myteamUserIdsrole = [];

        $myteamUserIds[] = $uid;
        $myteamUserIdsrole[] = $role;

        if ($role != 1) {
            $users = $this->db->select('id,role')
            ->where('domain_id', $domain_id)
                ->where('parent_team_id', $uid)
                ->where('parent_team_role','2')
                ->where('status',1)
                ->get('user_master')
                ->result_array();
                
                if (empty($users)) {
                $users = $this->db->select('id,role')
                ->where('domain_id', $domain_id)
                ->where('parent_team_id', $uid)
                ->where('parent_team_role','2')
                ->where('status',1)
                ->get('branch_franchise')
                ->result_array();
                }

            if (!empty($users)) {
                foreach ($users as $user) {
                    $myteamUserIds[] = $user['id'];
                    $myteamUserIdsrole[] = $user['role'];
                }
            }
        }

                if (empty($myteamUserIds)) {
                    $myteamUserIds = [-1];
                } else {
                    // foreach ($myteamUserIds as $myteamUserId) {
                    //     $users = $this->db->select('id')
                    //         ->where('domain_id', $domain_id)
                    //         ->where('parent_id', $myteamUserId)
                    //         ->where_in('parent_id_role', $myteamUserIdsrole)
                    //         ->get('user_master')
                    //         ->result_array();

                    //     if (!empty($users)) {
                    //         foreach ($users as $user) {
                    //             $myteamUserIds[] = $user['id'];
                    //         }
                    //     }
                    // }
                     $this->db->select('id');
                $this->db->from('user_master');
                $this->db->where('domain_id', $domain_id);
                $this->db->where('status', 1);

                $hasCondition = false;

                foreach ($myteamUserIds as $key => $pid) {

                    $prole = $myteamUserIdsrole[$key] ?? null;

                    if ($prole !== null) {

                        if (!$hasCondition) {
                            $this->db->group_start();
                            $hasCondition = true;
                        }

                        $this->db->or_group_start()
                                ->where('parent_id', $pid)
                                ->where('parent_id_role', $prole)
                                ->group_end();
                    }
                }

                if ($hasCondition) {
                    $this->db->group_end();
                }

                $users = $this->db->get()->result_array();
            
            // IDs collect करो
            if (!empty($users)) {
                foreach ($users as $user) {
                    $myteamUserIds[] = $user['id'];
                }
            }
        }
                // echo '<pre>';print_r($this->db->last_query());
                // print_r($myteamUserIds);die;
        
        $user_id = $this->session->userdata('user_id');
        $my_team_user = $this->db->from('user_master');
        $team_user = $this->db->where('domain_id', $domain_id);
        // if ($this->session->userdata('type') != 'admin') {
        // }
        $team_user = $this->db->where('parent_team_id', $user_id);
        $team_user = $this->count2 = $this->db->count_all_results();

        
        // if ($role == 1) {
        //     $where_in = [];
        //     $where_in_role = [];
        //     }elseif($team_user > 0 && $this->session->userdata('role') == 2){
        //         $where_in = $myteamUserIds;
        //         $where_in_role = [];
        // }else {
        //     $where_in = $userIds;
        //     $where_in_role = $userIdsrole;
        // }

        if ($role == 1) {
            $where_in = [];
        }
        elseif($team_user > 0 && $this->session->userdata('role') == 2){
            $where_in = array_map(null, $myteamUserIds, $myteamUserIdsrole);
            // $where_in = array_map(null, $myteamUserIds, null);
        }
        else {
            $where_in = array_map(null, $userIds, $userIdsrole);
        }
            $table = 'leads';
              $column_order = array('title', 'first_name','last_name','loan_amount','gender','mobile','mobile'); //set column field database for datatable orderable
              $column_search = array('title', 'first_name','last_name','loan_amount','gender','mobile','dob'); //set column field database for datatable searchable 
              $select  = '*';
              $order = array('id' => 'DESC'); // default order 
              $where = array('domain_id' => $domain_id);
            //   print_r($where_in);die;

              $list = $this->A->get_datatables($table,$column_order,$column_search,$select,$where,$order,$where_in);

            //   print_r($this->db->last_query()); die;
              $data = array();
              $no = $_POST['start'];
              foreach ($list as $industry) {
                $process = $this->db->where('id', $industry->process_id)->get('loan_process')->row();
                $domain =  $this->db->where('id',$industry->domain_id)->get('domains')->row_array();
                $user_name = '';
                $tables = '';
                $user = $this->db->where('id', $industry->uid)->where('role', 2)->get('user_master')->row();
                $tables = 'user_master';

                if (empty($user)) {
                    $user = $this->db->where('id', $industry->uid)->get('branch_franchise')->row();
                    $tables = 'branch_franchise';
                }

                if (empty($user->parent_id)) {
                    $user_name = $user;
                } else {
                    $user_name = $this->db->select('name')->where('id', $user->parent_id)->where('role', $role)->get('user_master')->row();

                    if (empty($user_name)) {
                        $user_name = $this->db->select('name')->where('id', $user->parent_id)->get('branch_franchise')->row();
                    }
                }

                $team_member = '';
                $network_member = '';

                if (!empty($user)) {
                    if (!empty($user->parent_id)) {
                        if ($user->subscription == 'Silver' || $user->subscription == 'Platinum') {
                            $network_member = $user->username;
                        } else {
                            $team_member = $user->username;
                        }
                    }
                    $parent_id = $this->db->where('id', $user->parent_id)->get('user_master')->row();
                }
                $update = '';
                $action = '';
            


                    if ($this->session->userdata('role') == 1) {
                        $update .= '<button type="button" class="btn btn-primary admin_modal" data-id="'.$industry->id.'" data-toggle="modal">Update By Admin</button>';
                    }

                    if ($this->session->userdata('role') != 1) {

                        if ((empty($user->parent_id) || $user->parent_id == '' || $user->parent_id == 0) && ($industry->uid == $this->session->userdata('user_id'))) {
                            $update .= '<button type="button" class="btn btn-primary mt-2 admin_modal" data-id="'.$industry->id.'">View Main user</button>';
                        } else {
                            if (!empty($user->user_type) && empty($main_user->parent_id) || $main_user->parent_id == '' || $main_user->parent_id == 0) {
                                $update .= '<button type="button" class="btn btn-primary view_main_user" data-id="'.$industry->id.'">Update Main user</button>';

                                $update .= '<button type="button" class="btn btn-primary mt-2 admin_modal" data-id="'.$industry->id.'">admin View</button>';

                            } else {
                                $update .= '<button type="button" class="btn btn-primary mt-2 team_modal" data-id="'.$industry->id.'">View</button>';
                            }
                        }
                    }
                    $action .= '<a href="' . base_url('admin/edit-lead/') . $industry->id . '"><i class="fa fa-pencil-square-o text-primary fa-lg" aria-hidden="true"></i></a>
                                <a href="#" onclick="delLead(' . $industry->id . ')"><i class="fa fa-trash text-danger fa-lg" aria-hidden="true"></i></a>';
                  $no++;
                  $row = array();
                //   $row[] = $industry->id;
                  $row[] = $no;
                  $row[] = ($process ? $process->process_name : 'N/A');
                  $row[] = ($process ? $process->process_type : 'N/A');
                  $row[] = $industry->title;
                  $row[] = $industry->first_name;
                  $row[] = $industry->last_name;
                  $row[] = $industry->loan_amount;
                  $row[] = ucfirst($industry->gender);
                  $row[] = $industry->mobile;
                  $row[] = $industry->dob;
                  $row[] = ($user_name ? $user_name->name : 'N/A');
                  $row[] = ($network_member ? $network_member : 'N/A');
                  $row[] = ($team_member ? $team_member : 'N/A');
                  $row[] = $industry->created_on;
                  $row[] = $industry->lead_status;
                  $row[] = ($industry->status == 1 ? 'Active' : 'Inactive') ;
                  $row[] = $update;
                  $row[] = $action;
                  $data[] = $row;
              }
              
              $output = array(
                              "draw" => $_POST['draw'],
                              "recordsTotal" => $this->A->count_all($table),
                              "recordsFiltered" => $this->A->count_filtered($table,$column_order,$column_search,$select,$where,$order,$where_in),
                              "data" => $data,
                      );
              //output to json format
              echo json_encode($output);
    }

    public function leadsAjax()
    {
        if (!has_permission('Lead') || !has_permission('My lead')) {
			
            if ($this->session->userdata('type') != 'admin') {
		$this->session->set_flashdata('message', 'You do not have permission to access this section.');
		redirect('admin-dashboard');
		return;
		}
		}
        $this->load->view('admin/template/header');
        $this->load->view('admin/leads/view-ajax');
        $this->load->view('admin/template/footer');
    }
    
    public function getLeadsDataAjax($page = 1)
    {
         if (!has_permission('Lead') || !has_permission('My lead')) {
			
            if ($this->session->userdata('type') != 'admin') {
		$this->session->set_flashdata('message', 'You do not have permission to access this section.');
		redirect('admin-dashboard');
		return;
		}
		}
        $limit = 10; // Number of items per page
        $offset = ($page - 1) * $limit; // Calculate offset
        $role = $this->session->userdata('role');
        $uid = $this->session->userdata('user_id');

        $userIds = array($uid);

        if ($role != 1) {
            $users = $this->db->select('id')->where('parent_id', $uid)->get('user_master')->result_array();

            if (!empty($users)) {
                foreach ($users as $user) {
                    $userIds[] = $user['id'];
                }
            }
        }

        $data = array();

        if ($role == 1) {
            $data['datas'] = $this->db->limit($limit, $offset)->order_by('id', 'DESC')->get('leads')->result();
        } else {
            $data['datas'] = $this->db->limit($limit, $offset)->where_in('uid', $userIds)->order_by('id', 'DESC')->get('leads')->result();
        }

        // Process the data for HTML append
        $htmlRows = '';
        if (!empty($data['datas'])) {
            foreach ($data['datas'] as $item) {
                $process = $this->db->where('id', $item->process_id)->get('loan_process')->row();
                $user_name = '';
                $table = '';
                $user = $this->db->where('id', $item->uid)->where('role', $item->uid_role)->get('user_master')->row();
                $table = 'user_master';

                if (empty($user)) {
                    $user = $this->db->where('id', $item->uid)->get('branch_franchise')->row();
                    $table = 'branch_franchise';
                }

                if (empty($user->parent_id)) {
                    $user_name = $user;
                } else {
                    $user_name = $this->db->select('name')->where('id', $user->parent_id)->where('role', $item->uid_role)->get('user_master')->row();

                    if (empty($user_name)) {
                        $user_name = $this->db->select('name')->where('id', $user->parent_id)->get('branch_franchise')->row();
                    }
                }

                $team_member = '';
                $network_member = '';

                if (!empty($user)) {
                    if (!empty($user->parent_id)) {
                        if ($user->subscription == 'Silver' || $user->subscription == 'Platinum') {
                            $network_member = $user->username;
                        } else {
                            $team_member = $user->username;
                        }
                    }
                    $parent_id = $this->db->where('id', $user->parent_id)->get('user_master')->row();
                }

                $htmlRows .= '<tr>' .
                    '<td>' . $item->id . '</td>' .
                    '<td>' . ($process ? $process->process_name : 'N/A') . '</td>' .
                    '<td>' . ($process ? $process->process_type : 'N/A') . '</td>' .
                    '<td>' . $item->title . '</td>' .
                    '<td>' . $item->first_name . '</td>' .
                    '<td>' . $item->last_name . '</td>' .
                    '<td>' . $item->loan_amount . '</td>' .
                    '<td>' . $item->gender . '</td>' .
                    '<td>' . $item->mobile . '</td>' .
                    '<td>' . $item->dob . '</td>' .
                    '<td>' . ($user_name ? $user_name->name : 'N/A') . '</td>' .
                    '<td>' . ($network_member ? $network_member : 'N/A') . '</td>' .
                    '<td>' . ($team_member ? $team_member : 'N/A') . '</td>' .
                    '<td>' . $item->created_on . '</td>' .
                    '<td>' . $item->lead_status . '</td>' .
                    '<td>' . $item->status . '</td>';
                    // Update button conditions
                    if ($this->session->userdata('role') == 1) {
                        $htmlRows .= '<td class="">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModalAdmin' . $item->id . '">Update By Admin</button>
                        </td>';
                    }
                    if ($this->session->userdata('role') != 1) {
                        $htmlRows .= '<td class="">';

                        if ((empty($user->parent_id) || $user->parent_id == '' || $user->parent_id == 0) && ($item->uid == $this->session->userdata('user_id'))) {
                            $htmlRows .= '<button type="button" class="btn btn-primary mt-2" data-toggle="modal" data-target="#myModalAdmin' . $item->id . '">View Main user</button>';
                        } else {
                            if (!empty($user->user_type) && empty($main_user->parent_id) || $main_user->parent_id == '' || $main_user->parent_id == 0) {
                                $htmlRows .= '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModalUser' . $item->id . '">Update Main user</button>';
                                $htmlRows .= '<button type="button" class="btn btn-primary mt-2" data-toggle="modal" data-target="#myModalAdmin' . $item->id . '">admin View</button>';
                            } else {
                                $htmlRows .= '<button type="button" class="btn btn-primary mt-2" data-toggle="modal" data-target="#myModalUserTeam' . $item->id . '">View</button>';
                            }
                        }
                        $htmlRows .= '</td>';
                    }
                    $htmlRows .= '<td>
                                <a href="' . base_url('admin/edit-lead/') . $item->id . '"><i class="fa fa-pencil-square-o text-primary fa-lg" aria-hidden="true"></i></a>
                                <a href="#" onclick="delLead(' . $item->id . ')"><i class="fa fa-trash text-danger fa-lg" aria-hidden="true"></i></a>
                            </td>';
                    $htmlRows .= '</tr>';
            }
        }

        $data['htmlRows'] = $htmlRows;
        echo json_encode($data);
    }

    public function leadTransfer()
    {
        $data = [];
        //$all['datas'] = $this->Dashboard_Model->channel_partner();
        $this->load->view('admin/template/header');
        $this->load->view('admin/leads/view', $data);
        $this->load->view('admin/template/footer');
    }

    public function addLead()
    {
        if (!has_permission('Lead') || !has_permission('add lead') ) {
			
            if ($this->session->userdata('type') != 'admin') {
		$this->session->set_flashdata('message', 'You do not have permission to access this section.');
		redirect('admin-dashboard');
		return;
		}
		}
        //$data = [];
        $all['domains'] = $this->db->where('status',1)->get('domains')->result_array();
        $all['process_type'] = $this->Dashboard_Model->process_type_list();
        $this->load->view('admin/template/header');
        $this->load->view('admin/leads/add', $all);
        $this->load->view('admin/template/footer');
    }

    public function editLead($leadId)
    {
        if (!has_permission('Lead') || !has_permission('My lead')) {
			
            if ($this->session->userdata('type') != 'admin') {
		$this->session->set_flashdata('message', 'You do not have permission to access this section.');
		redirect('admin-dashboard');
		return;
		}
		}

        $data['process_type'] = $this->Dashboard_Model->process_type_list();
        $data['datas'] = $this->Dashboard_Model->common_row($leadId, 'leads');

        $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
        $this->load->view('admin/template/header');
        $this->load->view('admin/leads/edit', $data);
        $this->load->view('admin/template/footer');

    }

    public function createLead()
    {
         if (!has_permission('Lead') || !has_permission('add lead')) {
			
            if ($this->session->userdata('type') != 'admin') {
		$this->session->set_flashdata('message', 'You do not have permission to access this section.');
		redirect('admin-dashboard');
		return;
		}
		}
        $this->form_validation->set_rules('process_id', 'Process Type', 'required|trim');
        $this->form_validation->set_rules('loan_amount', 'Loan amount', 'required|trim');
        $this->form_validation->set_rules('title', 'title', 'required|trim');
        $this->form_validation->set_rules('first_name', 'First name', 'required|trim');
        $this->form_validation->set_rules('last_name', 'Last name', 'required|trim');

        $this->form_validation->set_rules('gender', 'Gender', 'required|trim');
        $this->form_validation->set_rules('dob', 'dob', 'required|trim');
        $this->form_validation->set_rules('mobile', 'mobile', 'required|trim');
        $this->form_validation->set_rules('pan', 'pan', 'required|trim');
        $this->form_validation->set_rules('zip_code', 'Zip code', 'required|trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');

        if ($this->form_validation->run()) {
            $data['uid'] = $this->session->userdata('user_id');
            $data['uid_role'] = $this->session->userdata('role');
            $data['process_id'] = $this->input->post('process_id');
            $data['title'] = $this->input->post('title');
            $data['first_name'] = $this->input->post('first_name');
            $data['loan_amount'] = $this->input->post('loan_amount');
            $data['lead_date'] = date('Y-m-d');
            $data['middle_name'] = $this->input->post('middle_name');
            $data['last_name'] = $this->input->post('last_name');
            $data['gender'] = $this->input->post('gender');
            $data['dob'] = $this->input->post('dob');
            $data['mobile'] = $this->input->post('mobile');
            $data['pan'] = $this->input->post('pan');
            $data['zip_code'] = $this->input->post('zip_code');
            $data['domain_id'] = $this->input->post('domain_id');

            $insert = $this->Dashboard_Model->common_insert($data, 'leads');

            if ($insert) {
                $this->session->set_flashdata('success', 'Lead has been Created Successfully!!');
                redirect('admin/leads-thanks');
            } else {
                $this->session->set_flashdata('error', 'Something Went Wrong, try again!!');
                redirect('admin/leads');
            }

        } else {
            $all['process_type'] = $this->Dashboard_Model->process_type_list();
            $this->load->view('admin/template/header');
            $this->load->view('admin/leads/add', $all);
            $this->load->view('admin/template/footer');
        }

    }

    public function updateLead()
    {
        if (!has_permission('lead') || !has_permission('My lead')) {
			
            if ($this->session->userdata('type') != 'admin') {
		$this->session->set_flashdata('message', 'You do not have permission to access this section.');
		redirect('admin-dashboard');
		return;
		}
		}
        $data = $this->input->post();
        $id = $data['id'];
        unset($data['id']);
        $updateData = $this->Dashboard_Model->update_data($id, $data, 'leads');
        if ($updateData) {
            $this->session->set_flashdata('success', 'Lead has been Updated Successfully!!');
            redirect('admin/leads');
        } else {
            $this->session->set_flashdata('error', 'Something Went Wrong, try again!!');
            redirect('admin/edit-lead/' . $id);
        }

    }

    public function myBusiness()
    {
        $role = $this->session->userdata('role');
        $data['leads'] = count($this->Dashboard_Model->lead_list());
        $data['applications'] = $this->Dashboard_Model->get_count($role, 2, 'leads');
        $payouts_and_disbursements = $this->Dashboard_Model->get_payouts_and_disbursements_total();
        $data['disbursements'] = $payouts_and_disbursements[0]->total_disbursements;
        $data['payouts'] = $payouts_and_disbursements[0]->total_payouts;
        $this->load->view('admin/template/header');
        $this->load->view('admin/my-business/view', $data);
        $this->load->view('admin/template/footer');
    }

    public function getLeadsData()
    {
        $filterDate = $this->input->post('leadTime');
        $customDate = $this->input->post('customDate');
        $start = '';
        $end = '';
        if ($filterDate == "all") {
            $start = '';
            $end = '';
        }
        if ($filterDate == "today") {
            $start = date("Y-m-d");
            $end = '';
        }
        if ($filterDate == "lastweek") {
            $start = date("Y-m-d", strtotime("last sunday", strtotime("-1 week")));
            $end = date("Y-m-d", strtotime("saturday", strtotime("-1 week")));
        }
        if ($filterDate == "currentmonth") {
            $start = date('Y-m-01');
            $end = date('Y-m-t');
        }
        if ($filterDate == "lastmonth") {
            $start = date('Y-m-01', strtotime('previous month'));
            $end = date('Y-m-t', strtotime('previous month'));
        }
        if ($filterDate == "lastthreemonth") {
            $start = '';
            $end = '';
        }
        if ($filterDate == "qtd") {
            $start = '';
            $end = '';
        }
        if ($filterDate == "ytd") {
            $start = '';
            $end = '';
        }
        if ($filterDate == "custom") {
            $start = $customDate;
            $end = '';
        }
        $data['lead_data'] = $this->Dashboard_Model->get_leads_data($start, $end, $filterDate, 'leads');

        echo json_encode($data);die;

    }

    public function getBusinessData()
    {
        $uid = $this->session->userdata('user_id');
        $role = $this->session->userdata('role');
        $filterDate = $this->input->post('date');
        $start = '';
        $end = '';
        if ($filterDate == "all") {
            $start = '';
            $end = '';
        }
        if ($filterDate == "today") {
            $start = date("Y-m-d");
            $end = '';
        }
        if ($filterDate == "lastweek") {
            $start = date("Y-m-d", strtotime("last sunday", strtotime("-1 week")));
            $end = date("Y-m-d", strtotime("saturday", strtotime("-1 week")));
        }
        if ($filterDate == "currentmonth") {
            $start = date('Y-m-01');
            $end = date('Y-m-t');
        }
        if ($filterDate == "lastmonth") {
            $start = date('Y-m-01', strtotime('previous month'));
            $end = date('Y-m-t', strtotime('previous month'));
        }
        if ($filterDate == "lastthreemonth") {
            $start = '';
            $end = '';
        }
        if ($filterDate == "qtd") {
            $start = '';
            $end = '';
        }
        if ($filterDate == "ytd") {
            $start = '';
            $end = '';
        }

        //$data['business_data'] = $this->Dashboard_Model->get_busniess_data();
        $data['leads'] = $this->Dashboard_Model->get_busniess_data($start, $end, $filterDate, $role, $uid, 'leads');
        $data['applications'] = $this->Dashboard_Model->get_busniess_data($start, $end, $filterDate, $role, $uid, 'leads');
        $data['disbursements'] = $this->Dashboard_Model->get_busniess_data($start, $end, $filterDate, $role, $uid, 'leads');
        $data['payouts'] = $this->Dashboard_Model->get_busniess_data($start, $end, $filterDate, $role, $uid, 'leads');

        echo json_encode($data);die;

    }

     public function changePlan()
    {
        if (!has_permission('Change Plan') && $this->session->userdata('type') != 'admin') {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
        }

        if (isset($_GET['domain_id']) && (int)$_GET['domain_id']) {
            $domain_id = $_GET['domain_id'];
        }else{
            $domain_id = domain_id_get();
        }
        
        $data['data'] = $this->Dashboard_Model->plan_data($domain_id);
        $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
        $data['branches'] = $this->db->where('domain_id', $domain_id)->where('status',1)->order_by('id','desc')->get('branch_franchise')->result_array();
        $data['user_data'] = $this->db->where('user_id', $this->session->userdata('user_id'))->get('plan_tbl')->row();
        $this->load->view('admin/template/header');
        $this->load->view('admin/page/change-plan', $data);
        $this->load->view('admin/template/footer');

    }

    public function get_plan_data_by_domain()
    {
        if (!has_permission('Change Plan') && $this->session->userdata('type') != 'admin') {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
        }
        $data = [];
        // print_r($this->input->post());die;
        if ($this->input->post()) {
            $pid = $this->input->post('id');
            $amount = $this->input->post('amount');
            $amount2 = $this->input->post('amount2');
            $validity = $this->input->post('validity');
            $plan_name = $this->input->post('plan_name');
            $plan2_name = $this->input->post('plan2_name');
            $plan_type = $this->input->post('plan_type');
            $domain_id = $this->input->post('domain_id');
            $user_id = $this->input->post('user_id');
            if ( $user_id == '') {
                $user_id = $this->session->userdata('user_id');
            }


            $data['amount'] = $amount;
            $data['amount2'] = $amount2;
            $data['validity'] = $validity;
            $data['plan_name'] = $plan_name;
            $data['plan2_name'] = $plan2_name;
            $data['plan_type'] = $plan_type;
            $data['domain_id'] = $domain_id;
            $data['user_id'] = $user_id;

            $existing = $this->db->get_where('plan_tbl', ['domain_id' => $domain_id ,'plan_type'=> $plan_type,'user_id' => $user_id])->row();
            // print_r( $existing);
            // print_r( $this->db->last_query());die;

            if ($existing) {
                $status = $this->db->where(['id' => $pid, 'domain_id' => $domain_id])->update('plan_tbl', $data);
            } else {
                $status = $this->db->insert('plan_tbl', $data);
            }
            
            $data['data'] = $this->Dashboard_Model->plan_data($domain_id);
            if ($status) {
                $this->session->set_flashdata('success', 'Plan has changed successfully');
                 return redirect('admin/change-plan');

            } else {
                $this->session->set_flashdata('error', 'Something Went Wrong');
                 return redirect('admin/change-plan');

            }
        }
    }
    
    public function changePassword()
    {
        $uid = $this->session->userdata('user_id');
        $role = $this->session->userdata('role');
        $domain_id = domain_id_get();
        $this->load->model('Dashboard_Model');
        $user = $this->Dashboard_Model->getUserById($uid, $role);

        if (isset($user['skip']) && $user['skip'] == 1) {
            redirect('admin-dashboard');
            exit;
        }

        $data = ['uid' => $uid,
                'role'=>$role,
                'skip' => isset($user['skip']) ? $user['skip'] : 0
                ]; 
         $data['notification'] = $this->db->where( array('domain_id' => $domain_id))->where('is_active', 1)->where('document',null)->order_by('id', 'desc')->get('marketing_notifications')->row_array();
       
        $this->load->view('admin/template/header');
        $this->load->view('admin/page/change-password', $data);
        $this->load->view('admin/template/footer');
    }

    public function saveChangePassword()
    {
        // Retrieve form data
        $uid = $this->input->post('uid');
        $password = $this->input->post('password');
        
        $role = $this->input->post('role');
        

        
        
        if (empty($uid) || empty($password)) {
            $this->session->set_flashdata('error', 'User ID and Password are required.');
            return redirect('admin/change-password');
        }
        
        $hashedPassword = MD5($password);
        
        $data = [
            'password' => $hashedPassword,
            'pass_text' => $password,
            'change_password_status'=> 0,
        ];
        
        $this->load->model('Dashboard_Model');
        $result = $this->Dashboard_Model->changeBranchPassword($uid, $data, $role);

        if ($result) {
            $this->session->set_flashdata('success', 'Password updated successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to update password. Please try again.');
        }
        
        return redirect('admin-dashboard');
    }

    public function skipChangePassword()
    {
        $uid = $this->input->post('uid');
        $role = $this->input->post('role');

        if (empty($uid)) {
            echo json_encode(['success' => false, 'message' => 'User ID is required.']);
            return;
        }

        $data = ['skip' => 1];

        $this->load->model('Dashboard_Model');
        $result = $this->Dashboard_Model->updateSkipStatus($uid, $data, $role);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update skip status.']);
        }
    }

    public function bankwiseEligibility()
    {
        if (!has_permission('Bankwise Eligibility') && $this->session->userdata('type') != 'admin') {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            }
        $data['bank_data'] = $this->Dashboard_Model->bank_list();
        $data['loan_data'] = $this->Dashboard_Model->loan_list();
        $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();

        $this->load->view('admin/template/header');
        $this->load->view('admin/bankwise/view', $data);
        $this->load->view('admin/template/footer');
    }

    public function bankwisePDFs()
    {
        if (!has_permission('Bankwise pdf') && $this->session->userdata('type') != 'admin') {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            }
        $datas['datas'] = $this->Dashboard_Model->bankwise_pdfs();
        //  echo "<pre>";
        //  print_r($datas); die;
        $this->load->view('admin/template/header');
        $this->load->view('admin/bankwise-pdfs/list', $datas);
        $this->load->view('admin/template/footer');
    }

    public function bankwisePDFsAdd()
    {
        if (!has_permission('Bankwise pdf') && $this->session->userdata('type') != 'admin') {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            }
        $data['bank_data'] = $this->Dashboard_Model->bank_list();
        $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
        $this->load->view('admin/template/header');
        $this->load->view('admin/bankwise-pdfs/add', $data);
        $this->load->view('admin/template/footer');
    }

    public function bankwisePDFsStore()
    {
        if (!has_permission('Bankwise pdf') && $this->session->userdata('type') != 'admin') {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            }
        $data = $this->input->post();
        if ($_FILES["file"]["size"] > 0) {
            $tmpFilePath = $_FILES['file']['tmp_name'];
            $fileinfo = @getimagesize($_FILES["file"]["tmp_name"]);
            $image_file_type = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
            $newFilePath = 'upload/assets/bankwise-file/' . time() . '.' . $image_file_type;
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                $data['file'] = $newFilePath;
            }
        }
        $insert = $this->Dashboard_Model->common_insert($data, 'bankwise_pdfs');
        if ($insert) {
            $this->session->set_flashdata('success', 'Bankwise PDF added Successfully!!');
            redirect('admin/bankwise-pdfs');
        } else {
            $this->session->set_flashdata('error', 'Something Went Wrong, try again!!');
            redirect('admin/bankwise-pdfs');
        }
    }

    public function bankCriteria()
    {
         if (!has_permission('Bankwise Eligibility') && $this->session->userdata('type') != 'admin') {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            }
        $loan_id = $this->input->post('loan_id');
        $bank_id = $this->input->post('bank_id');
        $domain_id = $this->input->post('domain_id');

        $data['data'] = $this->Dashboard_Model->bank_criteria($loan_id, $bank_id,$domain_id);
        echo json_encode($data);

    }

    public function bankCriteriaUpdate()
    {
         if (!has_permission('Bankwise Eligibility') && $this->session->userdata('type') != 'admin') {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            }
        $data = $this->input->post();
        $id = $data['id'];
        unset($data['id']);
        if (!empty($id)) {
            $result = $this->Dashboard_Model->update_data($id, $data, 'bank_eligibility_criteria');
            $this->session->set_flashdata('success', 'Bankwise PDF Updated Successfully!!');
            redirect('admin/bankwise-eligibility');
        } else {
            $result = $this->Dashboard_Model->common_insert($data, 'bank_eligibility_criteria');
            $this->session->set_flashdata('success', 'Bankwise PDF added Successfully!!');
            redirect('admin/bankwise-eligibility');
        }

    }

    public function myApplications()
    {
         if (!has_permission('My Applications') && $this->session->userdata('type') != 'admin') {
        $this->session->set_flashdata('message', 'You do not have permission to access this section.');
        redirect('admin-dashboard');
        return;
        }
        $all['datas'] = [];
        $this->load->view('admin/template/header');
        $this->load->view('admin/my-applications/view', $all);
        $this->load->view('admin/template/footer');
    }

    public function getAgentCityData()
    {
        $city = $this->input->post('city');
        $data['agent_city'] = $this->Dashboard_Model->get_AgentCity_data($city, 'user_master');
        echo json_encode($data);
    }

    public function getUserCityData()
    {
        $city = $this->input->post('city');
        $data['user_city'] = $this->Dashboard_Model->get_UserCity_data($city, 'registerUser');
        echo json_encode($data);
    }

    public function getApplicationData()
    {
        $uid = $this->session->userdata('user_id');
        $role = $this->session->userdata('role');
        $filterDate = $this->input->post('date');
        $start = '';
        $end = '';
        if ($filterDate == "all") {
            $start = '';
            $end = '';
        }
        if ($filterDate == "today") {
            $start = date("Y-m-d");
            $end = '';
        }
        if ($filterDate == "lastweek") {
            $start = date("Y-m-d", strtotime("last sunday", strtotime("-1 week")));
            $end = date("Y-m-d", strtotime("saturday", strtotime("-1 week")));
        }
        if ($filterDate == "currentmonth") {
            $start = date('Y-m-01');
            $end = date('Y-m-t');
        }
        if ($filterDate == "lastmonth") {
            $start = date('Y-m-01', strtotime('previous month'));
            $end = date('Y-m-t', strtotime('previous month'));
        }
        if ($filterDate == "lastthreemonth") {
            $start = '';
            $end = '';
        }
        if ($filterDate == "qtd") {
            $start = '';
            $end = '';
        }

        $data['application_data'] = $this->Dashboard_Model->get_application_data($start, $end, $filterDate, $role, $uid, 'leads');
        echo json_encode($data);
    }

    public function getNetworkData()
    {
        if (!has_permission('My Network') && $this->session->userdata('type') != 'admin') {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
        }
        $uid = $this->session->userdata('user_id');
        $customer = $this->input->post('customer');

        $data['networkData'] = $this->Dashboard_Model->get_network_people($customer);
        echo json_encode($data);

    }

    public function getMyNetworkList()
    {
        if (!has_permission('My Network') && $this->session->userdata('type') != 'admin') {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
        }
        $uid = $this->session->userdata('user_id');
        $networkName = $this->input->post('networkName');
        $custId = $this->input->post('custId');
        if ($networkName == "customer") {
            $dbName = 'registerUser';
        } else {
            $dbName = 'user_master';
        }
        $data['myNetData'] = $this->Dashboard_Model->get_network_data($uid, $custId, $dbName);
        echo json_encode($data);

    }

    public function paymentLink()
    {
        $mobile = $this->input->post('mobile');
        $email = $this->input->post('email');
        $amount = $this->input->post('amount');

        $api = new Api(API_KEY, API_SECRET);

        $api->paymentLink->create(array('amount' => $amount * 100, 'currency' => 'INR', 'accept_partial' => true,
            'first_min_partial_amount' => 100, 'description' => 'InstantLeansDeals', 'customer' => array('name' => 'InstantLeansDeals',
                'email' => $email, 'contact' => '+91' . $mobile), 'notify' => array('sms' => true, 'email' => true),
            'reminder_enable' => true, 'notes' => array('policy_name' => 'NA'), 'callback_url' => 'http://instantloansdeals.com/',
            'callback_method' => 'get'));

        //print_r($api);die;
        $this->session->set_flashdata('success', 'Payment Link sent Successfully!!');
        redirect('admin/change-plan', 'refresh');

    }

    public function myNetwork()
    {
        if (!has_permission('My Network') && $this->session->userdata('type') != 'admin') {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
        }
        $role = $this->session->userdata('role');
        $uid = $this->session->userdata('user_id');
        $teamData = $this->Dashboard_Model->getTeamData($uid, 'network');
        $all['datas'] = $teamData;
        $all['role'] = $role;
        $this->load->view('admin/template/header');
        $this->load->view('admin/my-network/view', $all);
        $this->load->view('admin/template/footer');
    }

    public function addNetworkMember()
    {
        if (!has_permission('My Network') && $this->session->userdata('type') != 'admin') {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
        }

        $role = $this->session->userdata('role');

        $all['datas'] = [];
        $all['role'] = $role;
        $all['domains'] = $this->db->where('status',1)->get('domains')->result_array();


        $this->load->view('admin/template/header');
        $this->load->view('admin/my-network/add', $all);
        $this->load->view('admin/template/footer');
    }

    public function sendNetworkOtp()
    {
        if (!has_permission('My Network') && $this->session->userdata('type') != 'admin') {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
        }

        $this->form_validation->set_rules('useremail', 'Email', 'required');
        $this->form_validation->set_rules('username', 'Name', 'required|trim');
        $this->form_validation->set_rules('usermobile', 'Mobile', 'required|trim');
        $this->form_validation->set_rules('city', 'Mobile', 'required|trim');
        $this->form_validation->set_rules('address', 'Mobile', 'required|trim');
        $this->form_validation->set_rules('pin_code', 'Mobile', 'required|trim');

        // $this->form_validation->set_rules('mobile','Mobile','required|trim');
        // $this->form_validation->set_rules('user_type','User Type','required|trim');

        $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');

        if ($this->form_validation->run() == false) {
            $this->load->view('admin/template/header');
            $this->load->view('admin/my-team/add');
            $this->load->view('admin/template/footer');

        } else {
            $email = $this->security->xss_clean($this->input->post('useremail'));
            $name = $this->security->xss_clean($this->input->post('username'));
            $mobile = $this->security->xss_clean($this->input->post('usermobile'));
            $city = $this->security->xss_clean($this->input->post('city'));
            $address = $this->security->xss_clean($this->input->post('address'));
            $pin_code = $this->security->xss_clean($this->input->post('pin_code'));
            $domain_id = $this->security->xss_clean($this->input->post('domain_id'));
            // $role = $this->security->xss_clean($this->input->post('user_type'));
            $role = 'agent';

            if ($this->emailValidation($email, $role ,$domain_id)) {
                $email_config = $this->db->where('domain_id', $domain_id)->get('email_config')->row_array();
                $admin_name = $this->db->where('domain_id', $domain_id)->get('contect_us')->row_array();
                $domain = $this->db->where('id', $domain_id)->get('domains')->row_array();

                $n = 4;
                $newOtp = $this->generateNumericOTP($n);
                $to = $email;
                $subject = "Registration OTP";
                $message = "Please verify your account in  " . (!empty($admin_name['company_title']) ? $admin_name['company_title'] : '') . ". Your otp is:<strong>" . $newOtp . "</strong>";
                $message .= "\nDo not share with anyone. This OTP will expire after 10 minutes.";
               $header = "From:". (!empty($email_config['from_email']) ? $email_config['from_email'] : '') . " \r\n";
                $header .= "MIME-Version: 1.0\r\n";
                $header .= "Content-type: text/html\r\n";
                //$retval = mail ($to,$subject,$message,$header);

                $sms_message = "Your%20OTP%20is%20" . $newOtp . "%20for%20Instant%20Loans%20Deals.%20Do%20not%20share%20to%20Others.%20More%20details:%20https://www.instantloansdeals.com%20EXELORA%20CONSULTANCY";
                // $this->send_mail($email,$subject,$message );
                if($domain['social_status'] == 'sms') { $this->send_sms($mobile, $sms_message);}else{$this->send_mail($to, $subject, $message);}

                // $this->send_sms($mobile, $sms_message);

                $data['title'] = 'otp';
                $data['keywords'] = 'otp,page,test';
                $data['description'] = 'this is otp page';
                $data['otp'] = $newOtp;
                $data['email'] = $email;
                $data['mobile'] = $mobile;
                $data['name'] = $name;
                $data['city'] = $city;
                $data['address'] = $address;
                $data['pin_code'] = $pin_code;
                $data['user_type'] = $role;
                $data['domain_id'] = $domain_id;
                $data['type'] = 'user';
                $data['otp_channel'] = ($domain['social_status'] == 'sms') ? 'sms' : 'email';

                //         $this->load->view('Page/template/header',$data);
                //         $this->load->view('Page/otp_page',$data);
                //         $this->load->view('Page/template/footer',$data);

                $this->load->view('admin/template/header', $data);
                $this->load->view('admin/my-network/otp_page', $data);
                $this->load->view('admin/template/footer', $data);
            } else {
                $this->session->set_flashdata('message', 'Oh!, Email is already exist! Please try another Email.');
                redirect('admin/add-network-member');

            }

        }
    }

    public function createNetworkMember()
    {
       if (!has_permission('My Network') && $this->session->userdata('type') != 'admin') {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
        }
        
        $email = $this->input->post('email');
        $name = $this->input->post('name');
        $mobile = $this->input->post('mobile');
        $city = $this->input->post('city');
        $address = $this->input->post('address');
        $pin_code = $this->input->post('pin_code');
        $status = $this->input->post('status');
        $role = 'agent';
        $domain_id = $this->input->post('domain_id');

        $pass = $this->randomPassword();

        ////********* send email to customer / agent********************** //
        $email_config = $this->db->where('domain_id', $domain_id)->get('email_config')->row_array();
        $admin_name = $this->db->where('domain_id', $domain_id)->get('contect_us')->row_array();
        $domain = $this->db->where('id', $domain_id)->get('domains')->row_array();

        $to = $email;

        $subject = (!empty($admin_name['company_title']) ? $admin_name['company_title'] : '') . " User";
         $message = "You are successfully registrated to " . (!empty($admin_name['company_title']) ? $admin_name['company_title'] : '') . ". Your Password is:<strong>" . $pass . "</strong>";
        $message .= "\nDo not share with anyone. This Password is confidentially.";
        $header = "From:". (!empty($email_config['from_email']) ? $email_config['from_email'] : '') . " \r\n";
        $header .= "MIME-Version: 1.0\r\n";
        $header .= "Content-type: text/html\r\n";

        // $retval = mail ($to,$subject,$message,$header);
        // $this->send_mail($email, $subject, $message);  // Commented on 07/23/2023

        $email_data = array(
            'mobile' => $mobile,
            'message' => "Dear%20Customer,%20Welcome%20to%20Instant%20Loans%20Deals%20Your%20Password%20is%20" . $pass . "%20More%20details:%20https://www.instantloansdeals.com%20EXELORA%20CONSULTANCY",
        );

        $exist = $this->db->where('domain_id',domain_id_get())->order_by('id', 'DESC')->get('user_master')->row_array();
        if (empty($exist)) {
            $code = 'Member-0000';
        } else {
            $code = 'Member-000' . $exist['id'];
        }

        // $this->send_sms($email_data['mobile'], $email_data['message']);

        if($domain['social_status'] == 'sms') { $this->send_sms($email_data['mobile'], $email_data['message']);}else{$this->send_mail($to, $subject, $message);}

        ////********* send email to customer / agent********************** //
        $unpaid_email = 'Unpaid--' . $email;

        $insertData = ['username' => $name,
            'name' => $name,
            //'email'      => $email,
            'email' => $unpaid_email,
            'password' => MD5($pass),
            'pass_text' => $pass,
            'mobile_no' => $mobile,
            'city' => $city,
            'address' => $address,
            'pin_code' => $pin_code,
            'parent_id' => $this->session->userdata('user_id'),
            'parent_id_role' => $this->session->userdata('role'),
            'subscription' => 'pending',
            'role' => 2,
            'status' => 2,
            'code' => $code,
            'domain_id' => $domain_id,
            'type' => 'user',
            'date' => date('Y-m-d H:i:s')
        ];

        $reg = $this->Dashboard_Model->insertTeamData($insertData, 'user_master');
        $insertData['user_type'] = 'agent';
        $insertData['pass'] = $pass;

        $insertData['email'] = $email;
        $insertData['email_data'] = $email_data;

        //$this->session->set_userdata('email_data',$email_data);// For email after payment.
        if ($reg) {

            $insertData['uid'] = $reg;
            $this->session->set_userdata('network_member_data', $insertData);
            $data['status'] = 'true';
            echo json_encode($data);die;
        } else {
            $data['status'] = 'false';
            echo json_encode($data);die;
        }
    }

    public function networkMemberOffer()
    {
        if (!has_permission('My Network') && $this->session->userdata('type') != 'admin') {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
        }
        $data['data'] = $this->db->where(['status'=> '1','domain_id' => $this->session->userdata('network_member_data')['domain_id'],'user_id' => $this->session->userdata('user_id'),'plan_type'=> '4'])->get('plan_tbl')->result();

        if (empty( $data['data'])) {
            $data['data'] = $this->db->where(['status'=> '1','domain_id' => $this->session->userdata('network_member_data')['domain_id'],'plan_type'=> '2'])->get('plan_tbl')->result();
        }
// print_r($this->db->last_query());die;
        $data['title'] = 'Agent Payment Amount';
        $data['keywords'] = 'Agent payment,page,test';
        $data['description'] = 'this is Agent Payment page';

        $this->load->view('admin/template/header', $data);
        $this->load->view('admin/my-network/agent-offer', $data);
        $this->load->view('admin/template/footer', $data);

    }

    public function networkMemberPayment()
    {
        if (!has_permission('My Network') && $this->session->userdata('type') != 'admin') {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
        }
        $networkMemberData = $this->session->userdata('network_member_data');
        $uid = $networkMemberData['uid'];
        $role = $networkMemberData['user_type'];
        $email = $networkMemberData['email'];
        $mobile = $networkMemberData['mobile_no'];
        $plan = $this->input->post('plan');

        if ( $plan == 'Silver') {
            $arr =  $this->db->where(['status'=> 1 ,'domain_id' => $this->input->post('domain_id'),'plan_name'=>$plan ,'plan_type'=> 4,'user_id' => $this->session->userdata('user_id')])->get('plan_tbl')->row_array();
        }else{
            $arr =  $this->db->where(['status'=> 1 ,'domain_id' => $this->input->post('domain_id'),'plan2_name'=>$plan ,'plan_type'=> 4,'user_id' => $this->session->userdata('user_id')])->get('plan_tbl')->row_array();
        }
        if (empty($arr)) {
            if ( $plan == 'Silver') {
                $arr =  $this->db->where(['status'=> 1 ,'domain_id' => $this->input->post('domain_id'),'plan_name'=>$plan ,'plan_type'=> 2])->get('plan_tbl')->row_array();
            }else{
                $arr =  $this->db->where(['status'=> 1 ,'domain_id' => $this->input->post('domain_id'),'plan2_name'=>$plan ,'plan_type'=> 2])->get('plan_tbl')->row_array();
            }
        }

        if ($plan == 'platinum_free' || $plan == 'silver_free') {
            $updateData = [
            'subscription' => $plan,
            ];
            $updateStatus = $this->Dashboard_Model->update_data($uid, $updateData, 'user_master');
        redirect('admin/my-network', 'refresh');
        }
        if (!$plan) {
            $this->session->set_flashdata('error', 'Plan is required.');
            redirect('admin/my-network', 'refresh');
        }
        if (empty($arr)) {
            $this->session->set_flashdata('error', 'Invalid plan data.');
            redirect('admin/my-network', 'refresh');
        }

        $array = json_decode(json_encode($arr), true);
        $amt = ($plan === "Silver") ? $array['amount'] : $array['amount2'];
        

        // Check for session data
        if (!$this->session->has_userdata('network_member_data')) {
            redirect('admin/my-network', 'refresh');
        }

        $prefix = $this->generateNumericOTP(6);
        $updateData = [
            'subscription' => $plan,
            'plan_id' => $arr['id'],
        ];

        $updateStatus = $this->Dashboard_Model->update_data($uid, $updateData, 'user_master');

        if ($updateStatus) {
            $data = [
                'uid' => $uid,
                'user_type' => $role,
                'email' => $email,
                'mobile' => $mobile,
                'plan' => $plan,
                'amt' => $amt,
                'domain_id' => $this->input->post('domain_id'), 
            ];
            $this->load->view('admin/paymentpage', $data);
        } else {
            $this->session->set_flashdata('error', 'Failed to update subscription.');
            redirect('admin/my-network', 'refresh');
        }
    }

    public function paymentResponse()
    {
        if (!has_permission('My Network') && $this->session->userdata('type') != 'admin') {
                $this->session->set_flashdata('message', 'You do not have permission to access this section.');
                redirect('admin-dashboard');
                return;
            }
                $file_data = $this->upload->data();
                $paymentData = [
                    'amount' => $this->input->post('amount'),
                    'payment_id' => $this->input->post('payment_id'), // Use correct field name
                    'plan_amount' => $this->input->post('amt'), // Use correct field name
                    'image' => $file_data['file_name'], // Save the uploaded file name
                    'uid' => $this->session->userdata('user_id'), // Assuming you store user ID in session
                    'status' => 1, // Default status value
                    'uid' => $this->input->post('uid'), 
                    'domain_id' => $this->input->post('domain_id'), 
                    'role' => $this->input->post('user_type'), 
                    'entity' => 'payment',
                    'currency' => 'INR',
                    'method' => 'manual',
                    'payment_date' => date('Y-m-d') ,
                    'created_on' => date('Y-m-d H:i:s')
                ];
                $insert_id = $this->Dashboard_Model->insert_transaction($paymentData);
                redirect('admin/my-network');
    }

    public function setfinaluserdata($txtId)
    {
        $transaction_data = $this->Dashboard_Model->get_transaction_data($txtId, 'tbl_transection');
        if (isset($transaction_data->uid)) {
            $uid = $transaction_data->uid;
            $role = $transaction_data->role;
            $json_data = json_decode($transaction_data->pass_json);
            if ($role == 'user') {
                $dbName = 'registerUser';
            } else {
                $dbName = 'user_master';
            }
            $unpaid_user_data = $this->Dashboard_Model->get_unpaid_user_data($uid, $dbName);
            $Updatedata['email'] = explode('--', $unpaid_user_data->email)[1];
            $Updatedata['status'] = 1;
            $this->Dashboard_Model->update_data($uid, $Updatedata, $dbName);
            $domain = $this->db->where('id', domain_id_get())->get('domains')->row_array();
            if($domain['social_status'] == 'sms') { $this->send_sms($json_data->mobile, $json_data->message);}else{$this->send_mail($unpaid_user_data->email, 'Payment', $json_data->message);}
        }
    }

    public function myTeam()
    {
        if (!has_permission('My Team') && $this->session->userdata('type') != 'admin') {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
        }

        $role = $this->session->userdata('role');
        $uid = $this->session->userdata('user_id');

        $teamData = $this->Dashboard_Model->getMyTeamData($uid);

        $all['datas'] = $teamData;
        $all['role'] = $role;

        $this->load->view('admin/template/header');
        $this->load->view('admin/my-team/view', $all);
        $this->load->view('admin/template/footer');
    }
    
    public function adminTeam()
    {
        if (!has_permission('My Team') && $this->session->userdata('type') != 'admin') {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
        }

        $role = $this->session->userdata('role');
        $uid = $this->session->userdata('user_id');

        $teamData = $this->Dashboard_Model->getonlyAdminTeamData($uid);

        $all['datas'] = $teamData;
        $all['role'] = $role;

        $this->load->view('admin/template/header');
        $this->load->view('admin/my-team/view', $all);
        $this->load->view('admin/template/footer');
    }

    public function addTeamMember()
    {
        if (!has_permission('My Team') && $this->session->userdata('type') != 'admin') {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
        }

        $role = $this->session->userdata('role');

        $all['datas'] = [];
        $all['role'] = $role;

        $all['domains'] = $this->db->where('status',1)->get('domains')->result_array();
        $this->load->view('admin/template/header');
        $this->load->view('admin/my-team/add', $all);
        $this->load->view('admin/template/footer');
    }

    public function createTeamMember()
    {
        if (!has_permission('My Team') && $this->session->userdata('type') != 'admin') {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
        }
    
        $email = $this->input->post('email');
        $name = $this->input->post('name');
        $mobile = $this->input->post('mobile');
        $city = $this->input->post('city');
        $address = $this->input->post('address');
        $pin_code = $this->input->post('pin_code');
        $status = $this->input->post('status');
        $domain_id = $this->input->post('domain_id');
        $joining_date = $this->input->post('joining_date');
        $description = $this->input->post('description');
        $profile_photo = $this->input->post('profile_photo');
        $emp_profile = $this->input->post('emp_profile');

        $reporting_to = $this->input->post('reporting_to');
        $emergency_number = $this->input->post('emergency_number');
        $job_title = $this->input->post('job_title');
        $proposed_start_date = $this->input->post('proposed_start_date');
        $annual_salary = $this->input->post('annual_salary');
        $work_schedule = $this->input->post('work_schedule');
        $min_retainership_amount = $this->input->post('min_retainership_amount');
        $max_retainership_amount = $this->input->post('max_retainership_amount');
        $role = 'agent';

        $pass = $this->randomPassword();

        $email_config = $this->db->where('domain_id', $domain_id)->get('email_config')->row_array();
        $admin_name = $this->db->where('domain_id', $domain_id)->get('contect_us')->row_array();
        $domain = $this->db->where('id', $domain_id)->get('domains')->row_array();

        ////********* send email to customer / agent********************** //
        $to = $email;
        $subject = (!empty($admin_name['company_title']) ? $admin_name['company_title'] : '') . " User";
        $message = "You are successfully registrated to " . (!empty($admin_name['company_title']) ? $admin_name['company_title'] : '') . ". Your Password is:<strong>" . $pass . "</strong>";
        $message .= "\nDo not share with anyone. This Password is confidentially.";
        $header = "From:". (!empty($email_config['from_email']) ? $email_config['from_email'] : '') . " \r\n";
        $header .= "MIME-Version: 1.0\r\n";
        $header .= "Content-type: text/html\r\n";


        // $retval = mail ($to,$subject,$message,$header);
        // $this->send_mail($email, $subject, $message);  // Commented on 07/23/2023

        $email_data = array(
            'mobile' => $mobile,
            'message' => "Dear%20Customer,%20Welcome%20to%20Instant%20Loans%20Deals%20Your%20Password%20is%20" . $pass . "%20More%20details:%20https://www.instantloansdeals.com%20EXELORA%20CONSULTANCY",
        );

        if($domain['social_status'] == 'sms') { $this->send_sms($email_data['mobile'], $email_data['message']);}else{$this->send_mail($to, $subject, $message);}

        // $this->send_sms($email_data['mobile'], $email_data['message']);
        ////********* send email to customer / agent********************** //
        $exist = $this->db->where('domain_id',domain_id_get())->order_by('id', 'DESC')->get('user_master')->row_array();
        $admin_exist = $this->db->where('domain_id', 3)->where('status',1)->where('parent_id_role',1)->order_by('code', 'DESC')->get('user_master')->row_array();
        
        // echo '<pre>';print_r($admin_exist);die;
        if(!empty($admin_exist)) {
            $nextId = $admin_exist['code'] + 1;
            $code = str_pad($nextId, 5, '0', STR_PAD_LEFT);
        }elseif (empty($exist)) {
            $code = 'Team-0000';
        } else {
            $code = 'Team-000' . $exist['id'];
        }

        
        $insertData = ['username' => $name,
            'name' => $name,
            'email' => $email,
            'password' => MD5($pass),
            'pass_text' => $pass,
            'mobile_no' => $mobile,
            'city' => $city,
            'address' => $address,
            'pin_code' => $pin_code,
            'parent_id' => $this->session->userdata('user_id'),
            'parent_id_role' => $this->session->userdata('role'),
            'domain_id' => $domain_id,
            'role' => 2,
            'status' => $status,
            'code' => $code,
            'emp_profile' => $emp_profile,
            'joining_date' => $joining_date,
            'profile_photo' => $profile_photo,
            'description' => $description,
             'emergency_number' => $emergency_number,

            'work_schedule' => $work_schedule,
            'annual_salary' => $annual_salary,
            'job_title' => $job_title,
            'reporting_to' => $reporting_to,
            'proposed_start_date' => $proposed_start_date,
            'min_retainership_amount' => $min_retainership_amount,
            'max_retainership_amount' => $max_retainership_amount,
            'date' => date('Y-m-d H:i:s')
        ];
        if ($this->session->userdata('role') == 1) {
            $insertData['agreement_status'] = 'approved';
            $insertData['signature'] = '1';
            $insertData['status'] = '2';
        }
        
        $reg = $this->Dashboard_Model->insertTeamData($insertData, 'user_master');
        $insertData['user_type'] = 'agent';
        $insertData['pass'] = $pass;

        //$this->session->set_userdata('email_data',$email_data);// For email after payment.
        if ($reg) {

            $insertData['uid'] = $reg;
            //$this->session->set_userdata($insertData);
            $data['status'] = 'true';
            echo json_encode($data);die;
        } else {
            $data['status'] = 'false';
            echo json_encode($data);die;
        }
    }

    public function sendotp()
    {
         if (!has_permission('My Team') && $this->session->userdata('type') != 'admin') {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
        }
        $a =  $this->input->post();
        
        $this->form_validation->set_rules('useremail', 'Email', 'required');
        $this->form_validation->set_rules('username', 'Name', 'required|trim');
        $this->form_validation->set_rules('usermobile', 'Mobile', 'required|trim');
        $this->form_validation->set_rules('city', 'Mobile', 'required|trim');
        $this->form_validation->set_rules('address', 'Mobile', 'required|trim');
        $this->form_validation->set_rules('pin_code', 'Mobile', 'required|trim');

        // $this->form_validation->set_rules('mobile','Mobile','required|trim');
        // $this->form_validation->set_rules('user_type','User Type','required|trim');

        $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');

        if ($this->form_validation->run() == false) {
            $this->load->view('admin/template/header');
            $this->load->view('admin/my-team/add');
            $this->load->view('admin/template/footer');

        } else {
            $email = $this->security->xss_clean($this->input->post('useremail'));
            $name = $this->security->xss_clean($this->input->post('username'));
            $mobile = $this->security->xss_clean($this->input->post('usermobile'));
            $city = $this->security->xss_clean($this->input->post('city'));
            $address = $this->security->xss_clean($this->input->post('address'));
            $pin_code = $this->security->xss_clean($this->input->post('pin_code'));
            $domain_id = $this->security->xss_clean($this->input->post('domain_id'));

            $joining_date = $this->security->xss_clean($this->input->post('joining_date'));
            $description = $this->security->xss_clean($this->input->post('description'));
            $emp_profile = $this->security->xss_clean($this->input->post('emp_profile'));
            $emergency_number = $this->security->xss_clean($this->input->post('emergency_number'));
            $job_title = $this->security->xss_clean($this->input->post('job_title'));
            $reporting_to = $this->security->xss_clean($this->input->post('reporting_to'));
            $proposed_start_date = $this->security->xss_clean($this->input->post('proposed_start_date'));
            $annual_salary = $this->security->xss_clean($this->input->post('annual_salary'));
            $work_schedule = $this->security->xss_clean($this->input->post('work_schedule'));
            $min_retainership_amount = $this->security->xss_clean($this->input->post('min_retainership_amount'));
            $max_retainership_amount = $this->security->xss_clean($this->input->post('max_retainership_amount'));

            // $role = $this->security->xss_clean($this->input->post('user_type'));
            $role = 'agent';

            if ($this->emailValidation($email, $role ,$domain_id)) {

                $email_config = $this->db->where('domain_id', $domain_id)->get('email_config')->row_array();
                $admin_name = $this->db->where('domain_id', $domain_id)->get('contect_us')->row_array();
                $domain = $this->db->where('id', $domain_id)->get('domains')->row_array();
                
                $n = 4;
                $newOtp = $this->generateNumericOTP($n);
                $to = $email;
                $subject = "Registration OTP";
                $message = "Please verify your mobile no in  " . (!empty($admin_name['company_title']) ? $admin_name['company_title'] : '') . ". Your otp is:<strong>" . $newOtp . "</strong>";
                $message .= "\nDo not share with anyone. This OTP will expire after 10 minutes.";
                $header = "From:". (!empty($email_config['from_email']) ? $email_config['from_email'] : '') . " \r\n";
                $header .= "MIME-Version: 1.0\r\n";
                $header .= "Content-type: text/html\r\n";
               
                //$retval = mail ($to,$subject,$message,$header);
                
                $sms_message = "Your%20OTP%20is%20" . $newOtp . "%20for%20Instant%20Loans%20Deals.%20Do%20not%20share%20to%20Others.%20More%20details:%20https://www.instantloansdeals.com%20EXELORA%20CONSULTANCY";
                    // $this->send_mail($email,$subject,$message );
                    if($domain['social_status'] == 'sms') { $this->send_sms($mobile, $sms_message);}else{$this->send_mail($to, $subject, $message);}
                    
                    // $this->send_sms($mobile, $sms_message);
                    
               if (
                    isset($_FILES['profile_photo']) &&
                    !empty($_FILES['profile_photo']['name']) &&
                    $_FILES['profile_photo']['error'] == 0
                ){
                        $tmpFilePath = $_FILES['profile_photo']['tmp_name'];
                        $fileinfo = @getimagesize($_FILES["profile_photo"]["tmp_name"]);
                        $image_file_type = pathinfo($_FILES["profile_photo"]["name"], PATHINFO_EXTENSION);
                        $newFilePath = 'upload/assets/profile_photo/' . time() . '.' . $image_file_type;
                        if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                            $data['profile_photo'] = $newFilePath;
                        }
                    }
                $data['title'] = 'otp';
                $data['keywords'] = 'otp,page,test';
                // $data['description'] = 'this is otp page';
                $data['otp'] = $newOtp;
                $data['email'] = $email;
                $data['mobile'] = $mobile;
                $data['name'] = $name;
                $data['city'] = $city;
                $data['address'] = $address;
                $data['pin_code'] = $pin_code;
                $data['user_type'] = $role;
                $data['domain_id'] = $domain_id;

                $data['emp_profile'] = $emp_profile;
                $data['joining_date'] = $joining_date;
                $data['description'] = $description;
                $data['emergency_number'] = $emergency_number;
                
                $data['job_title'] = $job_title;
                $data['reporting_to'] = $reporting_to;
                $data['proposed_start_date'] = $proposed_start_date;
                $data['annual_salary'] = $annual_salary;
                $data['work_schedule'] = $work_schedule;
                $data['min_retainership_amount'] = $min_retainership_amount;
                $data['max_retainership_amount'] = $max_retainership_amount;

                 $data['otp_channel'] = ($domain['social_status'] == 'sms') ? 'sms' : 'email';

                //         $this->load->view('Page/template/header',$data);
                //         $this->load->view('Page/otp_page',$data);
                //         $this->load->view('Page/template/footer',$data);

                $this->load->view('admin/template/header', $data);
                $this->load->view('admin/my-team/otp_page', $data);
                $this->load->view('admin/template/footer', $data);
            } else {
                $this->session->set_flashdata('message', 'Oh!, Email is already exist! Please try another Email.');
                redirect('admin/add-member');

            }

        }
    }

    public function randomPassword()
    {
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

    public function generateNumericOTP($n)
    {
        $generator = "1357902468";
        $result = "";
        for ($i = 1; $i <= $n; $i++) {
            $result .= substr($generator, (rand() % (strlen($generator))), 1);
        }
        return $result;
    }

    public function emailValidation($emailData, $type ,$domain_id)
    {
        $checkStatus = $this->Dashboard_Model->check_emailId($emailData, $type ,$domain_id);
        if ($checkStatus) {
            return false;
        } else {
            return true;
        }
    }

    public function send_sms($mobileNumber, $message)
    {

        $senderId = 'ECPTlD';
        $routeId = '1';
        $authKey = 'b794dd4728d670a';
    
        $serverUrl = "http://cdfmsg.cdfhosting.in/rest/services/sendSMS/sendGroupSms?AUTH_KEY=" . $authKey . "&message=" . $message . "&senderId=" . $senderId . "&routeId=1&mobileNos=" . $mobileNumber . "&smsContentType=english";

        //Prepare you post parameters
             $postData = array(
            'mobileNumbers' => $mobileNumber,
            'smsContent' => $message,
            'senderId' => $senderId,
            'routeId' => $routeId,
            "smsContentType" => 'English',
        );

        $data_json = json_encode($postData);
        // init the resource
        $ch = curl_init();

        curl_setopt_array($ch, array(
            CURLOPT_URL => $serverUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Cookie: JSESSIONID=C02316B7203690DEEA81FD48A5587B19.node3',
            ),
        ));

        //get response
        $output = curl_exec($ch);

        //Print error if any
        if (curl_errno($ch)) {
            echo 'error:' . curl_error($ch);
        }
        curl_close($ch);

        //   print_r($output);
        //   die();
        $response = json_decode($output);
        if (isset($response->responseCode) && $response->responseCode == '3001') {
            return true;
        } else {
            return false;
        }
    }

    public function myWallet()
    {
        $data = [];
        $id = $this->session->userdata('user_id');
        $payouts_and_disbursements = $this->Dashboard_Model->get_payouts_and_disbursements_total();
        $data['disbursements'] = $payouts_and_disbursements[0]->total_disbursements;
        $data['payouts'] = $payouts_and_disbursements[0]->total_payouts;
        $data['payouts'] = $payouts_and_disbursements[0]->total_payouts;
        $data['rejected_file_count'] = $payouts_and_disbursements[0]->total_rejected_file_count;
        $data['approved_file_count'] = $payouts_and_disbursements[0]->total_approved_file_count;

        //$all['datas'] = $this->Dashboard_Model->channel_partner();
        $this->load->view('admin/template/header');
        $this->load->view('admin/page/wallet', $data);
        $this->load->view('admin/template/footer');
    }

    public function myPayoutSlabs()
    {
        if (!has_permission('My Payout Slabs')  && $this->session->userdata('type') != 'admin') {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
        }
        $data['slots'] = $this->Dashboard_Model->slots_data();
        $this->load->view('admin/template/header');
        $this->load->view('admin/order/slots', $data);
        $this->load->view('admin/template/footer');
    }

    public function Payoutcreate()
    {
        if (!has_permission('My Payout Slabs')  && $this->session->userdata('type') != 'admin') {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
        }

        $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
        $this->load->view('admin/template/header');
        $this->load->view('admin/order/slots_create' ,$data);
        $this->load->view('admin/template/footer');
    }

    public function Payoutcreatedd()
    {
        if (!has_permission('My Payout Slabs')  && $this->session->userdata('type') != 'admin') {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
        }
        $data = $this->input->post();
        $insert = $this->Dashboard_Model->common_insert($data, 'slot_tbl');
        if ($insert) {
            $this->session->set_flashdata('success', 'loan has been Created Successfully!!');
            redirect('admin/my-payout-slabs');
        } else {
            $this->session->set_flashdata('error', 'Something Went Wrong, try again!!');
            redirect('admin/my-payout-add');
        }
    }

    public function payoutdelete($id)
    {
        if (!has_permission('My Payout Slabs')  && $this->session->userdata('type') != 'admin') {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
        }
        $payout = $this->Dashboard_Model->delete_by_id('slot_tbl', $id);
        if ($payout) {
            $this->session->set_flashdata('success', 'Slabs delete Successfully!!');
            redirect('admin/my-payout-slabs');
        } else {
            $this->session->set_flashdata('error', 'Something Went Wrong, try again!!');
            redirect('admin/my-payout-slabs');
        }
    }

    public function payoutedit($id)
    {
        if (!has_permission('My Payout Slabs')  && $this->session->userdata('type') != 'admin') {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
        }
        //$data = [];
        $data['slots'] = $this->Dashboard_Model->slots_data_with_where($id);
        $data['bank_data'] = $this->Dashboard_Model->bank_list();
        $data['process_type'] = $this->Dashboard_Model->process_type_list();
        $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
        //echo "<pre>";print_r($data['slabs']);die;
        $this->load->view('admin/template/header');
        $this->load->view('admin/order/slots_edit', $data);
        $this->load->view('admin/template/footer');
    }

    public function updateslots()
    {
        $data = $this->input->post();
        $id = $data['id'];
        unset($datat['id']);
        $slots = $this->Dashboard_Model->common_update($id, $data, 'slot_tbl');
        if ($slots) {
            $this->session->set_flashdata('success', 'Updated Successfully!!');
            redirect('admin/my-payout-slabs');
        } else {
            $this->session->set_flashdata('error', 'Something Went Wrong, try again!!');
            redirect('admin/payoutedit/' . $id);
        }
    }

    public function userProfile()
    {
        if (!has_permission('My Profile')  && $this->session->userdata('type') != 'admin') {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            
            redirect('admin-dashboard');
            return;
        }

        $uid = $this->session->userdata('user_id');
        if (empty($uid)) {
            $uid = $this->session->userdata('uid');
        }

        $role = $this->session->userdata('role');
        if ($role == 3) {
            $data['profile'] = $this->Dashboard_Model->get_branch($uid);

        } else {
            $data['profile'] = $this->Dashboard_Model->profile_data($uid);

        }

          $data['uid'] = $uid;
          $data['role'] = $role;

        // echo '<pre>'; print_r($data['profile']);die;
        $this->load->view('admin/template/header');
        $this->load->view('admin/page/userProfile', $data);
        $this->load->view('admin/template/footer');
    }

    public function video()
    {
        if (!has_permission('Video') && $this->session->userdata('type') != 'admin') {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
        }

        $domain_id = domain_id_get();
        $uid = $this->session->userdata('user_id');
        $datas['datas'] = $this->Dashboard_Model->video_data();
        $datas['domains'] = $this->db->where('status',1)->get('domains')->result_array();
        $datas['heading'] = $this->Dashboard_Model->common_rows('video','settings',$domain_id);
        $this->load->view('admin/template/header');
        $this->load->view('admin/video/list', $datas);
        $this->load->view('admin/template/footer');

    }

    public function videoAdd()
    {
        if (!has_permission('Video') && $this->session->userdata('type') != 'admin') {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
        }

        $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
        $uid = $this->session->userdata('user_id');
        $this->load->view('admin/template/header');
        $this->load->view('admin/video/add' , $data);
        $this->load->view('admin/template/footer');
    }

    public function videoEdit()
    {
        if (!has_permission('Video') && $this->session->userdata('type') != 'admin') {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
        }
        $uid = $this->session->userdata('user_id');
        
        $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
        $this->load->view('admin/template/header');
        $this->load->view('admin/video/edit',$data);
        $this->load->view('admin/template/footer');
    }

    public function certificate_doc()
    {
        if (!has_permission('Document') && $this->session->userdata('type') != 'admin') {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
        }
        if ($this->session->userdata('type') != 'admin' && !has_permission('Certificate-user')) {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
        }
        $uid = $this->session->userdata('user_id');
        $role = $this->session->userdata('role');
        $domain_id = domain_id_get();
        $this->load->library('pdf');
        if ($this->session->userdata('role') == 2) {
            
        $data['user'] = $this->db->where('id', $uid)->where('role',$role)->get('user_master')->row_array();
        } else {
            $data['user'] = $this->db->where('id', $uid)->where('role',$role)->get('branch_franchise')->row_array();
        }
        $data['name'] = $this->session->userdata('user_name');
        $logo = $this->db->select('logo')->where(($this->session->userdata('type') != 'admin') ? array('domain_id' => $domain_id) : array())->get('contect_us')->row_array();
        
        if (!empty($logo['logo'])) {
            $data['logo'] = base_url('assets/images/logo/' . $logo['logo']);
        } else {
            $data['logo'] = base_url('assets/images/logo/default.png');
        }

        $document = $this->db->where(($this->session->userdata('type') != 'admin') ? array('domain_id' => $domain_id) : array())->get('joining_certificate')->row_array();
        
        if (!empty($document['image'])) {
            $data['document_image'] = base_url('assets/images/joiningCertificate/' . $document['image']);
        } else {
            $data['document_image'] = base_url('assets/images/default.png'); 
        }
        $data['joiningCertificate'] = $this->db->where(($this->session->userdata('type') != 'admin') ? array('domain_id' => $domain_id) : array())->get('joining_certificate')->row_array();
        $data['contectUs'] = $this->db->where(($this->session->userdata('type') != 'admin') ? array('domain_id' => $domain_id) : array())->get('contect_us')->row_array();
        $this->load->view('admin/document/certificate', $data);
    }

    public function certificate()
    {
         if (!has_permission('Document') && $this->session->userdata('type') != 'admin') {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
        }
       $teams_parent = $this->db->get_where('user_master', ['id' => $this->session->userdata('user_id'),'role' => $this->session->userdata('role')])->row_array();
        if (empty($teams_parent)) {
        $teams_parent = $this->db->get_where('branch_franchise', ['id' => $this->session->userdata('user_id'),'role' => $this->session->userdata('role')])->row_array();
        }
        if (!empty($teams_parent['parent_id']) && $teams_parent['parent_id_role'] != 1) {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
        }
        $this->load->view('admin/template/header');
        $this->load->view('admin/document/list');
        $this->load->view('admin/template/footer');
    }

    public function id_card()
    {

        if ($this->session->userdata('type') != 'admin' && !has_permission('id-card-user')) {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
        }

        $uid = $this->session->userdata('user_id');

        if ($this->session->userdata('role') == 2) {
            $data['user'] = $this->db->where('id', $uid)->get('user_master')->row_array();
        } else {
            $data['user'] = $this->db->where('id', $uid)->get('branch_franchise')->row_array();
        }
        $domain_id = domain_id_get();
           // Fetch logo and company_url from contect_us table
            $contact = $this->db->select('logo, company_url')->where(($this->session->userdata('type') != 'admin') ? array('domain_id' => $domain_id) : array())->get('contect_us')->row_array();
            
            if (!empty($contact['logo'])) {
                $data['logo'] = base_url('assets/images/logo/' . $contact['logo']);
            } else {
                $data['logo'] = base_url('assets/images/logo/default.png');
            }

            $data['company_url'] = !empty($contact['company_url']) ? $contact['company_url'] : '';


            $data['idCard'] = $this->db->where('domain_id', $domain_id)->get('id_card')->row_array();

            // echo '<pre>';print_r($data['idCard']);die;
        // $this->load->view('admin/template/header');
        $this->load->view('admin/document/id_card', $data);
        // $this->load->view('admin/template/footer');
    }

    public function visiting()
    {
        if ($this->session->userdata('type') != 'admin' && !has_permission('visiting-card-user')) {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
        }

        $uid = $this->session->userdata('user_id');
        $domain_id = domain_id_get();
        
        if ($this->session->userdata('role') == 2) {
            $data['user'] = $this->db->where('id', $uid)->get('user_master')->row_array();
        } else {
            $data['user'] = $this->db->where('id', $uid)->get('branch_franchise')->row_array();
        }
        $contact = $this->db->select('logo, company_gmail')->where(($this->session->userdata('type') != 'admin') ? array('domain_id' => $domain_id) : array())->get('contect_us')->row_array();
    
        if (!empty($contact['logo'])) {
            $data['logo'] = base_url('assets/images/logo/' . $contact['logo']);
        } else {
            $data['logo'] = base_url('assets/images/logo/default.png'); // Fallback image
        }

        $data['company_gmail'] = !empty($contact['company_gmail']) ? $contact['company_gmail'] : '';
        $data['visitingCard'] = $this->db->where(($this->session->userdata('type') != 'admin') ? array('domain_id' => $domain_id) : array())->get('visiting_card')->row_array();
        $this->load->view('admin/document/visiting', $data);
    }

    public function visiting_view()
    {
        $uid = $this->session->userdata('user_id');
        
        $domain_id = domain_id_get();
        if ($this->session->userdata('role') == 2) {
            $data['user'] = $this->db->where('id', $uid)->where(($this->session->userdata('type') != 'admin') ? array('domain_id' => $domain_id) : array())->get('user_master')->row_array();
        } else {
            $data['user'] = $this->db->where('id', $uid)->where(($this->session->userdata('type') != 'admin') ? array('domain_id' => $domain_id) : array())->get('branch_franchise')->row_array();
        }
        $this->load->view('admin/document/visiting_view', $data);
    }

    public function joining_letter()
    {
        $uid = $this->session->userdata('user_id');
         $domain_id = domain_id_get();
        if ($this->session->userdata('role') == 2) {
            $data['user'] = $this->db->where('id', $uid)->where(($this->session->userdata('type') != 'admin') ? array('domain_id' => $domain_id) : array())->get('user_master')->row_array();
        } else {
            $data['user'] = $this->db->where('id', $uid)->where(($this->session->userdata('type') != 'admin') ? array('domain_id' => $domain_id) : array())->get('branch_franchise')->row_array();
        }
        $joiningLetter = $this->db->where(($this->session->userdata('type') != 'admin') ? array('domain_id' => $domain_id) : array())->get('joining_letter')->row_array();
        $data['signature'] = !empty($joiningLetter['image']) ? base_url('assets/images/joiningLetter/' . $joiningLetter['image']) : base_url('assets/images/joiningLetter/default.png');
        $data['ceal'] = !empty($joiningLetter['ceal']) ? base_url('assets/images/joiningLetter/' . $joiningLetter['ceal']) : base_url('assets/images/joiningLetter/default.png');

        $data['contactUs'] = $this->db->where(($this->session->userdata('type') != 'admin') ? array('domain_id' => $domain_id) : array('domain_id' => $domain_id))->get('contect_us')->row_array();
        $logo = $this->db->select('logo')->where(($this->session->userdata('type') != 'admin') ? array('domain_id' => $domain_id) : array('domain_id' => $domain_id))->get('contect_us')->row_array();
    
        if (!empty($logo['logo'])) {
            $data['logo'] = base_url('assets/images/logo/' . $logo['logo']);
        } else {
            $data['logo'] = base_url('assets/images/logo/default.png');
        }
        
        $this->load->view('admin/document/joining_letter', $data);
    }

    public function joining_letter_view()
    {
        $uid = $this->session->userdata('user_id');
        if ($this->session->userdata('role') == 2) {
            $data['user'] = $this->db->where('id', $uid)->get('user_master')->row_array();
        } else {
            $data['user'] = $this->db->where('id', $uid)->get('branch_franchise')->row_array();
        }
        $this->load->view('admin/document/joining_letter_view', $data);
    }

    public function banner()
    {
        if ($this->session->userdata('type') != 'admin' && !has_permission('banner-user')) {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
        }

        $uid = $this->session->userdata('user_id');
        
        $domain_id = domain_id_get();
        if ($this->session->userdata('role') == 2) {
            $data['user'] = $this->db->where('id', $uid)->get('user_master')->row_array();
        } else {
            $data['user'] = $this->db->where('id', $uid)->get('branch_franchise')->row_array();
        }
        $joiningBanner = $this->db->where(($this->session->userdata('type') != 'admin') ? array('domain_id' => $domain_id) : array())->get('joining_banner')->row_array();
        
        $data['first_image'] = !empty($joiningBanner['first_image']) ? base_url('assets/images/joiningBanner/' . $joiningBanner['first_image']) : base_url('assets/images/joiningBanner/default.png');
        $data['second_image'] = !empty($joiningBanner['second_image']) ? base_url('assets/images/joiningBanner/' . $joiningBanner['second_image']) : base_url('assets/images/joiningBanner/default.png');

        $data['contactUs'] = $this->db->where(($this->session->userdata('type') != 'admin') ? array('domain_id' => $domain_id) : array())->get('contect_us')->row_array();
    
        $data['title'] = !empty($joiningBanner['title']) ? $joiningBanner['title'] : 'ALL TYPES OF LOAN SERVICES';
        $data['sub_title'] = !empty($joiningBanner['sub_title']) ? $joiningBanner['sub_title'] : 'COMMON SERVICES CENTER';
        $data['text_color'] = !empty($joiningBanner['text_color']) ? $joiningBanner['text_color'] : '#000';

        $logo = $this->db->select('logo')->where(($this->session->userdata('type') != 'admin') ? array('domain_id' => $domain_id) : array())->get('contect_us')->row_array();
    
        if (!empty($logo['logo'])) {
            $data['logo'] = base_url('assets/images/logo/' . $logo['logo']);
        } else {
            $data['logo'] = base_url('assets/images/logo/default.png');
        }

        // $this->load->view('admin/template/header');
        $this->load->view('admin/document/banner', $data);
        // $this->load->view('admin/template/footer');
    }

    public function teamMember($id)
    {
        $data['user'] = $this->db->where('id', $id)->get('user_master')->row_array();
        $this->load->view('admin/page/teamMember', $data);
    }

    public function createvideo()
    {
        $data = $this->input->post();
        if ($_FILES["image"]["size"] > 0) {
            $tmpFilePath = $_FILES['image']['tmp_name'];
            $fileinfo = @getimagesize($_FILES["image"]["tmp_name"]);
            $image_file_type = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
            $newFilePath = 'upload/assets/video/' . time() . '.' . $image_file_type;
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                $data['image'] = $newFilePath;
            }
        }
        $insert = $this->Dashboard_Model->common_insert($data, 'video');
        if ($insert) {
            $this->session->set_flashdata('success', 'Video Add Successfully!!');
            redirect('admin/video');
        } else {
            $this->session->set_flashdata('error', 'Something Went Wrong, try again!!');
            redirect('admin/video');
        }
    }

    public function videodelete($id)
    {
        $videodlt = $this->Dashboard_Model->common_update($id, array('status' => 0), 'video');
        if ($videodlt) {
            $this->session->set_flashdata('success', 'video delete Successfully!!');
            redirect('admin/video');
        } else {
            $this->session->set_flashdata('error', 'Something Went Wrong, try again!!');
            redirect('admin/video');
        }
    }

    public function pdfdelete($id)
    {
        $pdfdelete = $this->Dashboard_Model->common_update($id, array('status' => 0), 'bankwise_pdfs');
        if ($pdfdelete) {
            $this->session->set_flashdata('success', 'Bankwise tool pdf delete');
            redirect('admin/bankwise-pdfs');
        } else {
            $this->session->set_flashdata('error', 'Something Went Wrong, try again!!');
            redirect('admin/bankwise-pdfs');
        }
    }

    public function updateProfile()
    {
        $post = $this->input->post();

        if ($_FILES["profile_photo"]["size"] > 0) {
            $tmpFilePath = $_FILES['profile_photo']['tmp_name'];
            $fileinfo = @getimagesize($_FILES["profile_photo"]["tmp_name"]);
            $image_file_type = pathinfo($_FILES["profile_photo"]["name"], PATHINFO_EXTENSION);
            $newFilePath = 'upload/assets/profile_photo/' . time() . '.' . $image_file_type;
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                $post['profile_photo'] = $newFilePath;
            }
        }

        if ($_FILES["user_logo"]["size"] > 0) {
            $tmpFilePath = $_FILES['user_logo']['tmp_name'];
            $fileinfo = @getimagesize($_FILES["user_logo"]["tmp_name"]);
            $image_file_type = pathinfo($_FILES["user_logo"]["name"], PATHINFO_EXTENSION);
            $newFilePath = 'upload/assets/profile_photo/' . time() . '.' . $image_file_type;
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                $post['user_logo'] = $newFilePath;
            }
        }


        $id = $post['id'];
        unset($post['id']);
        if ($this->session->userdata('role') == 3) {
            $insert = $this->Dashboard_Model->common_update($id, $post, 'branch_franchise');
        } else {
            $insert = $this->Dashboard_Model->common_update($id, $post, 'user_master');
        }
        if ($insert) {
            $this->session->set_flashdata('success', 'Profile Updated Successfully!!');
            // redirect('admin/user-profile');
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            $this->session->set_flashdata('error', 'Something Went Wrong, try again!!');
            // redirect('admin/user-profile');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function updatebranchProfile()
    {
        $post = $this->input->post();

        if ($_FILES["profile_photo"]["size"] > 0) {
            $tmpFilePath = $_FILES['profile_photo']['tmp_name'];
            $fileinfo = @getimagesize($_FILES["profile_photo"]["tmp_name"]);
            $image_file_type = pathinfo($_FILES["profile_photo"]["name"], PATHINFO_EXTENSION);
            $newFilePath = 'upload/assets/profile_photo/' . time() . '.' . $image_file_type;
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                $post['profile_photo'] = $newFilePath;
            }
        }

        $id = $post['id'];
        unset($post['id']);
        $insert = $this->Dashboard_Model->common_update($id, $post, 'branch_franchise');

        if ($insert) {
            $this->session->set_flashdata('success', 'Profile Updated Successfully!!');
            // redirect('admin/user-profile');
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            $this->session->set_flashdata('error', 'Something Went Wrong, try again!!');
            // redirect('admin/user-profile');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function cartificate_genrate()
    {

        if ($this->session->userdata('type') != 'admin' && !has_permission('Certificate-user')) {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
        }

        $uid = $this->session->userdata('user_id');
        $this->load->library('pdf');
        $domain_id = domain_id_get();
        
        if ($this->session->userdata('role') == 2) {
            $data['user'] = $this->db->where('id', $uid)->where(($this->session->userdata('type') != 'admin') ? array('domain_id' => $domain_id) : array())->get('user_master')->row_array();
        } else {
            $data['user'] = $this->db->where('id', $uid)->get('branch_franchise')->row_array();
        }
        $logo = $this->db->select('logo')->where(($this->session->userdata('type') != 'admin') ? array('domain_id' => $domain_id) : array())->get('contect_us')->row_array();
            
            if (!empty($logo['logo'])) {
                $data['logo'] = base_url('assets/images/logo/' . $logo['logo']);
            } else {
                $data['logo'] = base_url('assets/images/logo/default.png'); // Fallback image
            }
        $document = $this->db->where(($this->session->userdata('type') != 'admin') ? array('domain_id' => $domain_id) : array())->get('joining_certificate')->row_array();
    
        if (!empty($document['image'])) {
            $data['document_image'] = base_url('assets/images/joiningCertificate/' . $document['image']);
        } else {
            $data['document_image'] = base_url('assets/images/default.png'); // Fallback image
        }

        $data['joiningCertificate'] = $this->db->where(($this->session->userdata('type') != 'admin') ? array('domain_id' => $domain_id) : array())->get('joining_certificate')->row_array();
        $data['contectUs'] = $this->db->where(($this->session->userdata('type') != 'admin') ? array('domain_id' => $domain_id) : array())->get('contect_us')->row_array();
    
        $this->load->library('pdf');
        $paper = 'A4';
        $orientation = 'landscape';
        $this->pdf->folder('assets/pdf/');
        $filename = $paper . '-' . $orientation . '.pdf';
        $this->pdf->filename($filename);
        $this->pdf->paper($paper, $orientation);
        $this->pdf->html($this->load->view('admin/document/certificate_view', $data, true));
        if ($this->pdf->create('save')) {
            $this->output->set_content_type('application/pdf')->set_output(file_get_contents('assets/pdf/' . $filename));
        }
    }

    public function id_genrate()
    {
        if ($this->session->userdata('type') != 'admin' && !has_permission('id-card-user')) {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
        }

        $uid = $this->session->userdata('user_id');
        $this->load->library('pdf');
        if ($this->session->userdata('role') == 2) {
            $data['user'] = $this->db->where('id', $uid)->get('user_master')->row_array();
        } else {
            $data['user'] = $this->db->where('id', $uid)->get('branch_franchise')->row_array();
        }
        $domain_id = domain_id_get();
        $contact = $this->db->select('logo, company_url')->where(($this->session->userdata('type') != 'admin') ? array('domain_id' => $domain_id) : array())->get('contect_us')->row_array();
        
        if (!empty($contact['logo'])) {
            $data['logo'] = base_url('assets/images/logo/' . $contact['logo']);
        } else {
            $data['logo'] = base_url('assets/images/logo/default.png');
        }

        $data['company_url'] = !empty($contact['company_url']) ? $contact['company_url'] : '';

        $data['idCard'] = $this->db->where('domain_id', $domain_id)->get('id_card')->row_array();

        $paper = 'A4';
        $orientation = 'portrait';
        $this->pdf->folder('assets/pdf/');

        //Set the filename to save/download as
        $filename = $paper . '-' . $orientation . '.pdf';
        $this->pdf->filename($filename);

        //Set the paper defaults portrait/landscape
        $this->pdf->paper($paper, $orientation);

        $this->pdf->html($this->load->view('admin/document/id_card_view', $data, true));

        //PDF was successfully saved and view
        if ($this->pdf->create('save')) {
            $this->output->set_content_type('application/pdf')->set_output(file_get_contents('assets/pdf/' . $filename));
        }
    }

public function id_genrate_docx()
{
    // Load PHPWord library
    require_once FCPATH . 'vendor/autoload.php';
    
    // Get user data
    $uid = $this->session->userdata('user_id');
    if ($this->session->userdata('role') == 2) {
        $user = $this->db->where('id', $uid)->get('user_master')->row_array();
    } else {
        $user = $this->db->where('id', $uid)->get('branch_franchise')->row_array();
    }
    
    $domain_id = domain_id_get();
    $contact = $this->db->select('logo, company_url, company_title, company_name, company_gmail')
                      ->where(($this->session->userdata('type') != 'admin') ? array('domain_id' => $domain_id) : array())
                      ->get('contect_us')
                      ->row_array();
    
    $id_card = $this->db->where('domain_id', $domain_id)->get('id_card')->row_array();
    
    // Create new PHPWord object
    $phpWord = new \PhpOffice\PhpWord\PhpWord();
    
    // Add a section
    $section = $phpWord->addSection([
        'marginLeft' => \PhpOffice\PhpWord\Shared\Converter::cmToTwip(1.5),
        'marginRight' => \PhpOffice\PhpWord\Shared\Converter::cmToTwip(1.5),
        'marginTop' => \PhpOffice\PhpWord\Shared\Converter::cmToTwip(1.5),
        'marginBottom' => \PhpOffice\PhpWord\Shared\Converter::cmToTwip(1.5)
    ]);
    
    // Define styles
    $phpWord->addTitleStyle(1, ['name' => 'Arial', 'size' => 18, 'color' => '2c3e50', 'bold' => true], ['alignment' => 'center', 'spaceAfter' => 200]);
    $phpWord->addFontStyle('headerStyle', ['name' => 'Arial', 'size' => 14, 'color' => '2c3e50', 'bold' => true]);
    $phpWord->addFontStyle('subHeaderStyle', ['name' => 'Arial', 'size' => 12, 'color' => '2c3e50', 'bold' => true]);
    $phpWord->addFontStyle('normalText', ['name' => 'Arial', 'size' => 11, 'color' => '2c3e50']);
    $phpWord->addFontStyle('smallText', ['name' => 'Arial', 'size' => 9, 'color' => '7f8c8d']);
    
    // Add company logo if available
    if (!empty($contact['logo']) && file_exists(FCPATH . 'assets/images/logo/' . $contact['logo'])) {
        $section->addImage(
            FCPATH . 'assets/images/logo/' . $contact['logo'],
            [
                'width' => 100,
                'alignment' => 'center',
                'marginTop' => 500,
                'marginBottom' => 500
            ]
        );
    }
    
    // Add company title
    if (!empty($contact['company_title'])) {
        $section->addText(
            strtoupper($contact['company_title']),
            'headerStyle',
            ['alignment' => 'center', 'spaceAfter' => 200]
        );
    }
    
    // Add ID Card title
    $section->addText(
        'EMPLOYEE ID CARD',
        'headerStyle',
        ['alignment' => 'center', 'spaceAfter' => 400]
    );
    
    // Create a table for the ID card
    $table = $section->addTable([
        'borderSize' => 6,
        'borderColor' => '4a90e2',
        'cellMargin' => 80,
        'alignment' => 'center'
    ]);
    
    // Add a row for the card
    $table->addRow(1000);
    
    // Add left cell for photo
    $cell = $table->addCell(2000, ['valign' => 'center', 'bgcolor' => 'f8f9fa']);
    
    // Add photo if available
    if (!empty($id_card['emp_photo']) && file_exists(FCPATH . $id_card['emp_photo'])) {
        $cell->addImage(
            FCPATH . $id_card['emp_photo'],
            [
                'width' => 100,
                'alignment' => 'center',
                'marginTop' => 10,
                'marginBottom' => 10
            ]
        );
    } else {
        $cell->addText(
            'Photo',
            ['name' => 'Arial', 'size' => 10, 'color' => '95a5a6'],
            ['alignment' => 'center']
        );
    }
    
    // Add right cell for details
    $cell = $table->addCell(4000, ['valign' => 'center']);
    
    // Add employee details
    $details = [];
    if (!empty($id_card['name'])) {
        $details[] = ['Name', $id_card['name']];
    }
    if (!empty($id_card['emp_profile'])) {
        $details[] = ['Designation', $id_card['emp_profile']];
    }
    if (!empty($id_card['email'])) {
        $details[] = ['Email', $id_card['email']];
    }
    if (!empty($id_card['joining_date'])) {
        $details[] = ['Joining Date', date('d/m/Y', strtotime($id_card['joining_date']))];
    }
    if (!empty($id_card['phone'])) {
        $details[] = ['Phone', $id_card['phone']];
    }
    
    foreach ($details as $detail) {
        $cell->addText(
            $detail[0] . ':',
            'subHeaderStyle',
            ['spaceAfter' => 50]
        );
        $cell->addText(
            $detail[1],
            'normalText',
            ['spaceAfter' => 100]
        );
    }
    
    // Add footer with company name
    $section->addText(
        'Authorized Signatory',
        ['name' => 'Arial', 'size' => 10, 'italic' => true],
        ['alignment' => 'right', 'spaceBefore' => 300]
    );
    
    // Add company name at the bottom
    if (!empty($contact['company_name'])) {
        $section->addText(
            $contact['company_name'],
            'smallText',
            ['alignment' => 'center', 'spaceBefore' => 500]
        );
    }
    
    // Add contact information
    $contactInfo = [];
    if (!empty($contact['company_gmail'])) {
        $contactInfo[] = 'Email: ' . $contact['company_gmail'];
    }
    if (!empty($contact['company_phone'])) {
        $contactInfo[] = 'Phone: ' . $contact['company_phone'];
    }
    if (!empty($contact['company_url'])) {
        $contactInfo[] = 'Website: ' . $contact['company_url'];
    }
    
    if (!empty($contactInfo)) {
        $section->addText(
            implode(' | ', $contactInfo),
            'smallText',
            ['alignment' => 'center', 'spaceBefore' => 100]
        );
    }
    
    // Save file to a temporary location first
    $tempFile = tempnam(sys_get_temp_dir(), 'PHPWord');
    $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
    $objWriter->save($tempFile);
    
    // Check if file was created
    if (file_exists($tempFile)) {
        // Set headers for download
        $filename = 'ID_Card_' . (!empty($id_card['name']) ? str_replace(' ', '_', $id_card['name']) : 'Employee') . '.docx';
        header('Content-Description: File Transfer');
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($tempFile));
        ob_clean();
        flush();
        readfile($tempFile);
        unlink($tempFile); // Delete the temporary file
        exit;
    } else {
        // If there was an error, show a message
        echo "Error generating the document. Please try again.";
        exit;
    }
}

    public function visit_genrate()
    {
        if ($this->session->userdata('type') != 'admin' && !has_permission('visiting-card-user')) {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
        }

        $this->load->library('pdf');
        $uid = $this->session->userdata('user_id');
        
        $domain_id = domain_id_get();
        if ($this->session->userdata('role') == 2) {
            $data['user'] = $this->db->where('id', $uid)->get('user_master')->row_array();
        } else {
            $data['user'] = $this->db->where('id', $uid)->get('branch_franchise')->row_array();
        }

         $contact = $this->db->select('logo, company_gmail')->where(($this->session->userdata('type') != 'admin') ? array('domain_id' => $domain_id) : array())->get('contect_us')->row_array();
    
            if (!empty($contact['logo'])) {
                $data['logo'] = base_url('assets/images/logo/' . $contact['logo']);
            } else {
                $data['logo'] = base_url('assets/images/logo/default.png'); // Fallback image
            }

            $data['company_gmail'] = !empty($contact['company_gmail']) ? $contact['company_gmail'] : '';
            $data['visitingCard'] = $this->db->where(($this->session->userdata('type') != 'admin') ? array('domain_id' => $domain_id) : array())->get('visiting_card')->row_array();
                
        $paper = 'A4';
        $orientation = 'portrait';
        $this->pdf->folder('assets/pdf/');

        //Set the filename to save/download as
        $filename = $paper . '-' . $orientation . '.pdf';
        $this->pdf->filename($filename);

        //Set the paper defaults portrait/landscape
        $this->pdf->paper($paper, $orientation);

        $this->pdf->html($this->load->view('admin/document/visiting_view', $data, true));

        //PDF was successfully saved and view
        if ($this->pdf->create('save')) {
            $this->output->set_content_type('application/pdf')->set_output(file_get_contents('assets/pdf/' . $filename));
        }
    }

    public function banner_genrate()
    {
         if ($this->session->userdata('type') != 'admin' && !has_permission('banner-user')) {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
        }

        $this->load->library('pdf');
        $uid = $this->session->userdata('user_id');
        
        $domain_id = domain_id_get();
        if ($this->session->userdata('role') == 2) {
            $data['user'] = $this->db->where('id', $uid)->get('user_master')->row_array();
        } else {
            $data['user'] = $this->db->where('id', $uid)->get('branch_franchise')->row_array();
        }
        $joiningBanner = $this->db->where(($this->session->userdata('type') != 'admin') ? array('domain_id' => $domain_id) : array())->get('joining_banner')->row_array();
        
        $data['first_image'] = !empty($joiningBanner['first_image']) ? base_url('assets/images/joiningBanner/' . $joiningBanner['first_image']) : base_url('assets/images/joiningBanner/default.png');
        $data['second_image'] = !empty($joiningBanner['second_image']) ? base_url('assets/images/joiningBanner/' . $joiningBanner['second_image']) : base_url('assets/images/joiningBanner/default.png');

        $data['title'] = !empty($joiningBanner['title']) ? $joiningBanner['title'] : 'ALL TYPES OF LOAN SERVICES';
        $data['sub_title'] = !empty($joiningBanner['sub_title']) ? $joiningBanner['sub_title'] : 'COMMON SERVICES CENTER';
        $data['text_color'] = !empty($joiningBanner['text_color']) ? $joiningBanner['text_color'] : '#000';

        $data['contactUs'] = $this->db->where(($this->session->userdata('type') != 'admin') ? array('domain_id' => $domain_id) : array())->get('contect_us')->row_array();
    
        $logo = $this->db->select('logo')->where(($this->session->userdata('type') != 'admin') ? array('domain_id' => $domain_id) : array())->get('contect_us')->row_array();
    
        if (!empty($logo['logo'])) {
            $data['logo'] = base_url('assets/images/logo/' . $logo['logo']);
        } else {
            $data['logo'] = base_url('assets/images/logo/default.png');
        }


        $paper = 'A4';
        $orientation = 'landscape';
        $this->pdf->folder('assets/pdf/');
        $filename = $paper . '-' . $orientation . '.pdf';
        $this->pdf->filename($filename);
        $this->pdf->paper($paper, $orientation);
        $this->pdf->html($this->load->view('admin/document/banner_view', $data, true));
        if ($this->pdf->create('save')) {
            $this->output->set_content_type('application/pdf')->set_output(file_get_contents('assets/pdf/' . $filename));
        }
    }

    public function joining_letter_genrate()
    {

        $this->load->library('pdf');
        $uid = $this->session->userdata('user_id');
        $domain_id = domain_id_get();
        if ($this->session->userdata('role') == 2) {
            $data['user'] = $this->db->where('id', $uid)->where(($this->session->userdata('type') != 'admin') ? array('domain_id' => $domain_id) : array())->get('user_master')->row_array();
        } else {
            $data['user'] = $this->db->where('id', $uid)->where(($this->session->userdata('type') != 'admin') ? array('domain_id' => $domain_id) : array())->get('branch_franchise')->row_array();
        }
        $data['contactUs'] = $this->db->where(($this->session->userdata('type') != 'admin') ? array('domain_id' => $domain_id) : array())->get('contect_us')->row_array();
    
        // Fetch joining letter data
        $joiningLetter = $this->db->where(($this->session->userdata('type') != 'admin') ? array('domain_id' => $domain_id) : array())->get('joining_letter')->row_array();
        
        // $data['description'] = !empty($joiningLetter['description']) ? $joiningLetter['description'] : '';
        $data['signature'] = !empty($joiningLetter['image']) ? base_url('assets/images/joiningLetter/' . $joiningLetter['image']) : base_url('assets/images/joiningLetter/default.png');
        $data['ceal'] = !empty($joiningLetter['ceal']) ? base_url('assets/images/joiningLetter/' . $joiningLetter['ceal']) : base_url('assets/images/joiningLetter/default.png');


        $logo = $this->db->select('logo')->where(($this->session->userdata('type') != 'admin') ? array('domain_id' => $domain_id) : array())->get('contect_us')->row_array();
    
        if (!empty($logo['logo'])) {
            $data['logo'] = base_url('assets/images/logo/' . $logo['logo']);
        } else {
            $data['logo'] = base_url('assets/images/logo/default.png');
        }

        $paper = 'A4';
        $orientation = 'portrait';
        $this->pdf->folder('assets/pdf/');

        //Set the filename to save/download as
        $filename = $paper . '-' . $orientation . '.pdf';
        $this->pdf->filename($filename);

        //Set the paper defaults portrait/landscape
        $this->pdf->paper($paper, $orientation);

        $this->pdf->html($this->load->view('admin/document/joining_letter_view', $data, true));

        //PDF was successfully saved and view
        if ($this->pdf->create('save')) {
            $this->output->set_content_type('application/pdf')->set_output(file_get_contents('assets/pdf/' . $filename));
        }
    }

    public function demoPage()
    {
        $exist = $this->db->order_by('id', 'ASC')->get('registerUser')->result_array();
        foreach ($exist as $key => $value) {
            if (isset($exist[$key - 1]['id'])) {
                $this->Dashboard_Model->common_update($value['id'], array('code' => 'USER-000' . $exist[$key - 1]['id']), 'registerUser');
            }
        }
        print_r($exist);
    }

    public function banker()
    {
        if (!has_permission('Banker Contact') && $this->session->userdata('type') != 'admin') {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            }
        $state = $this->input->get('states');
        $city = $this->input->get('citys');
        $product = $this->input->get('products');
        $bankName = $this->input->get('bankNames');
    
        $filters = [];
        if (!empty($state)) {
            $filters['state'] = $state;
        }
        if (!empty($city)) {
            $filters['city'] = $city;
        }
        if (!empty($product)) {
            $filters['product'] = $product;
        }
        if (!empty($bankName)) {
            $filters['bank_id'] = $bankName;
        }

        $data['banker'] = $this->Dashboard_Model->banker_data_get($filters);
        // echo '<pre>';print_r($this->db->last_query());die;
        // echo '<pre>';print_r($data['banker']);die;
        $domain_id = domain_id_get();
        $data['states'] = $this->db->distinct()->select('state')->from('banker')->where(($this->session->userdata('type') != 'admin') ? array('domain_id' => $domain_id) : array())->where('status', 1)->get()->result();
        $data['cities'] = $this->db->distinct()->select('city')->from('banker')->where(($this->session->userdata('type') != 'admin') ? array('domain_id' => $domain_id) : array())->where('status', 1)->get()->result_array();
        
        $data['products'] = $this->db->distinct()->select('product')->from('banker')->where(($this->session->userdata('type') != 'admin') ? array('domain_id' => $domain_id) : array())->where('status', 1)->get()->result_array();
        $data['bankNames'] = $this->db->distinct()->select('bank_id')->from('banker')->where(($this->session->userdata('type') != 'admin') ? array('domain_id' => $domain_id) : array())->where('status', 1)->get()->result_array();
       
        $this->load->view('admin/template/header');
        $this->load->view('admin/banker/list', $data);
        $this->load->view('admin/template/footer');
    }

     public function getCityBanker()
    {
        $cities = $this->db->where(array('state' => $this->input->post('id')))->group_by('city')->get('banker')->result_array();
        $state = $this->input->post('id');
       echo '<pre>'; print_r($cities);
        $show = '';

        if (!empty($cities)) {
            foreach ($cities as $key => $value) {
                $show .= '<option value="' . $value['city'] . '" data-id="' . $value['city'] . '">' . $value['city'] . '</option>';
            }}
        echo $show;
    }


    public function bankerExcelImport()
    {
        if (!has_permission('Banker Contact') && $this->session->userdata('type') != 'admin') {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            
        }
            
        // Suppress legacy PHPExcel deprecation/notice output to prevent header issues on redirect
        $prevErrLevel = error_reporting();
        error_reporting($prevErrLevel & ~E_DEPRECATED & ~E_NOTICE);
        ini_set('display_errors', '0');
        $this->load->library('excel');
        if (isset($_FILES["files"]["name"])) {
            
            $path = $_FILES["files"]["tmp_name"];
            $object = PHPExcel_IOFactory::load($path);
            foreach ($object->getWorksheetIterator() as $worksheet) {
                $highestRow = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();
                $data = array();
                for ($row = 3; $row <= $highestRow; $row++) {
                    $e[0] = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                    $e[1] = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $e[2] = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $e[3] = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $e[4] = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $e[5] = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                    $e[6] = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                    //   for ($z = 8; $z <= 107; $z++) {
                    //     $e[$z] = $worksheet->getCellByColumnAndRow($z, $row)->getValue();
                    //   }
                    if (!empty($e[1])) {
                        $data = array(
                            'state' => $e[0],
                            'city' => $e[1],
                            'product' => $e[2],
                            'bank_id' => $e[3],
                            'name' => $e[4],
                            'mobile' => $e[5],
                            'email' => $e[6],
                            'domain_id' =>domain_id_get(),
                        );
                        // echo "<pre>";
                        // print_r($data);
                        // die;
                        // $res = $this->Dashboard_Model->insert_data($data, 'banker');
                        $this->db->insert('banker', $data);
                    }

                }
            }
            $this->session->set_flashdata('success', 'Bankers Uploaded Successfully');
            echo 'yes';
        } else {
            $this->session->set_flashdata('error', 'Question Uploaded Failed');
            echo 'not';
        }
    }

    public function payoutslabImport()
    {
        if (!has_permission('My Payout Slabs') || !has_permission('Payout slab unsecured loans') ) {
                    
            if ($this->session->userdata('type') != 'admin') {
                $this->session->set_flashdata('message', 'You do not have permission to access this section.');
                redirect('admin-dashboard');
                return;
            }
        }

         $__prevErrLevel = error_reporting();
        $__prevDisplay = ini_get('display_errors');
        error_reporting($__prevErrLevel & ~E_DEPRECATED & ~E_NOTICE);
        ini_set('display_errors', '0');
        ob_start();

        $this->load->library('excel');
        if (isset($_FILES["files"]["name"])) {
            
            $path = $_FILES["files"]["tmp_name"];
            $object = PHPExcel_IOFactory::load($path);
            foreach ($object->getWorksheetIterator() as $worksheet) {
                $highestRow = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();
                $data = array();
                for ($row = 2; $row <= $highestRow; $row++) {
                    $e[0] = $worksheet->getCellByColumnAndRow(0, $row)->getFormattedValue();
                    $e[1] = $worksheet->getCellByColumnAndRow(1, $row)->getFormattedValue();
                    $e[2] = $worksheet->getCellByColumnAndRow(2, $row)->getFormattedValue();
                    $e[3] = $worksheet->getCellByColumnAndRow(3, $row)->getFormattedValue();
                    $e[4] = $worksheet->getCellByColumnAndRow(4, $row)->getFormattedValue();
                    $e[5] = $worksheet->getCellByColumnAndRow(5, $row)->getFormattedValue();
                    $e[6] = $worksheet->getCellByColumnAndRow(6, $row)->getFormattedValue();
                    $e[7] = $worksheet->getCellByColumnAndRow(7, $row)->getFormattedValue();
                    $e[8] = $worksheet->getCellByColumnAndRow(8, $row)->getFormattedValue();
                    $e[9] = $worksheet->getCellByColumnAndRow(9, $row)->getFormattedValue();
                    
                    if (!empty($e[1])) {
                        $data = array(
                            'bank_name' => $e[0],
                            'businees_loan' => $e[1],
                            'personal_loan' => $e[2],
                            'interest_rate' => $e[3],
                            'doctor_loan' => $e[4],
                            'dod' => $e[5],
                            'od' => $e[6],
                            'top_up_cases' => $e[7],
                            'digital' => $e[8],
                            'team_loan' => $e[9],
                            'domain_id' =>$this->input->post('domain_id'),
                            'type' =>$this->input->post('type'),
                        );
                        $this->db->insert('payoutslab_tbl', $data);
                    }

                }
            }
            $this->session->set_flashdata('success', 'Payout Slab Uploaded Successfully');
             ob_end_clean();
            ini_set('display_errors', $__prevDisplay);
            error_reporting($__prevErrLevel);
           redirect('admin/payoutslab');
        } else {
            $this->session->set_flashdata('error', 'Payout Slab Uploaded Failed');
            ob_end_clean();
            ini_set('display_errors', $__prevDisplay);
            error_reporting($__prevErrLevel);
            redirect('admin/payoutslab');
        }
    }

    public function payoutslabBulkDelete()
    {
         if (!has_permission('My Payout Slabs') || !has_permission('Payout slab unsecured loans') ) {
                    
            if ($this->session->userdata('type') != 'admin') {
                $this->session->set_flashdata('message', 'You do not have permission to access this section.');
                redirect('admin-dashboard');
                return;
            }
        }

        $ids = $this->input->post('ids');
        if (!empty($ids)) {
            $this->db->where_in('id', $ids)->delete('payoutslab_tbl');
            echo "success";
        } else {
            echo "no_ids";
        }
    }

     public function payoutslasecurebBulkDelete()
    {
         if (!has_permission('My Payout Slabs') || !has_permission('Payout slab secured loans') ) {
                    
            if ($this->session->userdata('type') != 'admin') {
                $this->session->set_flashdata('message', 'You do not have permission to access this section.');
                redirect('admin-dashboard');
                return;
            }
        }

        $ids = $this->input->post('ids');
        if (!empty($ids)) {
            $this->db->where_in('id', $ids)->delete('payoutslabsecure_tbl');
            echo "success";
        } else {
            echo "no_ids";
        }
    }


    public function payoutslabsecureImport()
    {
        if (!has_permission('My Payout Slabs') || !has_permission('Payout slab secured loans')) {
            if ($this->session->userdata('type') != 'admin') {
                $this->session->set_flashdata('message', 'You do not have permission to access this section.');
                redirect('admin-dashboard');
                return;
            }
        }

        $__prevErrLevel = error_reporting();
        $__prevDisplay = ini_get('display_errors');
        error_reporting($__prevErrLevel & ~E_DEPRECATED & ~E_NOTICE);
        ini_set('display_errors', '0');
        ob_start();

        $this->load->library('excel');
        if (isset($_FILES["files"]["name"])) {
            
            $path = $_FILES["files"]["tmp_name"];
            $object = PHPExcel_IOFactory::load($path);
            foreach ($object->getWorksheetIterator() as $worksheet) {
                $highestRow = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();
                $data = array();
                for ($row = 2; $row <= $highestRow; $row++) {
                    $e[0] = $worksheet->getCellByColumnAndRow(0, $row)->getFormattedValue();
                    $e[1] = $worksheet->getCellByColumnAndRow(1, $row)->getFormattedValue();
                    $e[2] = $worksheet->getCellByColumnAndRow(2, $row)->getFormattedValue();
                    $e[3] = $worksheet->getCellByColumnAndRow(3, $row)->getFormattedValue();
                    $e[4] = $worksheet->getCellByColumnAndRow(4, $row)->getFormattedValue();
                    $e[5] = $worksheet->getCellByColumnAndRow(5, $row)->getFormattedValue();
                    $e[6] = $worksheet->getCellByColumnAndRow(6, $row)->getFormattedValue();
                    $e[7] = $worksheet->getCellByColumnAndRow(7, $row)->getFormattedValue();
                    $e[8] = $worksheet->getCellByColumnAndRow(8, $row)->getFormattedValue();
                    $e[9] = $worksheet->getCellByColumnAndRow(9, $row)->getFormattedValue();
                    $e[10] = $worksheet->getCellByColumnAndRow(10, $row)->getFormattedValue();
                    $e[11] = $worksheet->getCellByColumnAndRow(11, $row)->getFormattedValue();
                    $e[12] = $worksheet->getCellByColumnAndRow(12, $row)->getFormattedValue();
                    $e[13] = $worksheet->getCellByColumnAndRow(13, $row)->getFormattedValue();
                    $e[14] = $worksheet->getCellByColumnAndRow(14, $row)->getFormattedValue();
                    $e[15] = $worksheet->getCellByColumnAndRow(15, $row)->getFormattedValue();

                    if (!empty($e[1])) {
                        $data = array(
                            'bank_name' => $e[0],
                            'home_loan' => $e[1],
                            'affordable_housing' => $e[2],
                            'loan_against_property' => $e[3],
                            'loan_against_credit_card' => $e[4],
                            'sme_loans' => $e[5],
                            'dod_od' => $e[6],
                            'credit_card_swipe_machine' => $e[7],
                            'plant_machinery' => $e[8],
                            'education_loan' => $e[9],
                            'machinery_loan' => $e[10],
                            'msme' => $e[11],
                            'working_capital_od' => $e[12],
                            'secured_term_loan' => $e[13],
                            'gold_loan' => $e[14],
                            'remarks' => $e[15],
                            'domain_id' =>$this->input->post('domain_id'),
                            'type' =>$this->input->post('type'),
                        );
                        $this->db->insert('payoutslabsecure_tbl', $data);
                    }

                }
            }
            $this->session->set_flashdata('success', 'Payout Slab Uploaded Successfully');
            ob_end_clean();
            ini_set('display_errors', $__prevDisplay);
            error_reporting($__prevErrLevel);
            redirect('admin/payoutslabsecure');
        } else {
            $this->session->set_flashdata('error', 'Payout Slab Uploaded Failed');
            ob_end_clean();
            ini_set('display_errors', $__prevDisplay);
            error_reporting($__prevErrLevel);
            redirect('admin/payoutslabsecure');
        }
    }

    public function codebookImport()
    {
       if (!has_permission('My Payout Slabs') || !has_permission('Bank & Finance Type code book') ) {
                    
            if ($this->session->userdata('type') != 'admin') {
                $this->session->set_flashdata('message', 'You do not have permission to access this section.');
                redirect('admin-dashboard');
                return;
            }
        }

        $__prevErrLevel = error_reporting();
        $__prevDisplay = ini_get('display_errors');
        error_reporting($__prevErrLevel & ~E_DEPRECATED & ~E_NOTICE);
        ini_set('display_errors', '0');
        ob_start();

        $this->load->library('excel');
        if (isset($_FILES["files"]["name"])) {
            
            $path = $_FILES["files"]["tmp_name"];
            $object = PHPExcel_IOFactory::load($path);
            foreach ($object->getWorksheetIterator() as $worksheet) {
                $highestRow = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();
                $data = array();
                for ($row = 2; $row <= $highestRow; $row++) {
                    $e[0] = $worksheet->getCellByColumnAndRow(0, $row)->getFormattedValue();
                    $e[1] = $worksheet->getCellByColumnAndRow(1, $row)->getFormattedValue();
                    $e[2] = $worksheet->getCellByColumnAndRow(2, $row)->getFormattedValue();
                    $e[3] = $worksheet->getCellByColumnAndRow(3, $row)->getFormattedValue();
                    $e[4] = $worksheet->getCellByColumnAndRow(4, $row)->getFormattedValue();
                    $e[5] = $worksheet->getCellByColumnAndRow(5, $row)->getFormattedValue();
                    $e[6] = $worksheet->getCellByColumnAndRow(6, $row)->getFormattedValue();
                    $e[7] = $worksheet->getCellByColumnAndRow(7, $row)->getFormattedValue();
                    $e[8] = $worksheet->getCellByColumnAndRow(8, $row)->getFormattedValue();
                    $e[9] = $worksheet->getCellByColumnAndRow(9, $row)->getFormattedValue();
                    $e[10] = $worksheet->getCellByColumnAndRow(10, $row)->getFormattedValue();

                    if (!empty($e[1])) {
                        $data = array(
                            'bank_name' => $e[0],
                            'hl' => $e[1],
                            'lap' => $e[2],
                            'bl' => $e[3],
                            'pl' => $e[4],
                            'el' => $e[5],
                            'sme' => $e[6],
                            'las' => $e[7],
                            'wc' => $e[8],
                            'auto_loan' => $e[9],
                            'ml' => $e[10],
                            'domain_id' =>$this->input->post('domain_id'),
                            // 'type' =>$this->input->post('type'),
                        );
                        $this->db->insert('codebook_tbl', $data);
                    }

                }
            }
            $this->session->set_flashdata('success', 'Codebook Uploaded Successfully');
            ob_end_clean();
            ini_set('display_errors', $__prevDisplay);
            error_reporting($__prevErrLevel);
            redirect('admin/codebook');
        } else {
            $this->session->set_flashdata('error', 'Codebook Uploaded Failed');
            ob_end_clean();
            ini_set('display_errors', $__prevDisplay);
            error_reporting($__prevErrLevel);
            redirect('admin/codebook');
        }
    }

    public function codebook()
    {
         if (!has_permission('My Payout Slabs') || !has_permission('Bank & Finance Type code book') ) {
                    
            if ($this->session->userdata('type') != 'admin') {
                $this->session->set_flashdata('message', 'You do not have permission to access this section.');
                redirect('admin-dashboard');
                return;
            }
        }

        $domain_id = domain_id_get();
        $this->db->where('domain_id', $domain_id);
        // if ($this->session->userdata('type') != 'admin') {
        // }
        $data['rows'] = $this->db->get('codebook_tbl')->result();
        $this->load->view('admin/template/header');
        $this->load->view('admin/codebook/list', $data);
        $this->load->view('admin/template/footer');
    }

    public function codebook_add()
    {
        if (!has_permission('My Payout Slabs') || !has_permission('Bank & Finance Type code book') ) {
                    
            if ($this->session->userdata('type') != 'admin') {
                $this->session->set_flashdata('message', 'You do not have permission to access this section.');
                redirect('admin-dashboard');
                return;
            }
        }

        $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
        $this->load->view('admin/template/header');
        $this->load->view('admin/codebook/add', $data);
        $this->load->view('admin/template/footer');
    }

    public function codebook_create()
    {
        if (!has_permission('My Payout Slabs') || !has_permission('Bank & Finance Type code book') ) {
                    
            if ($this->session->userdata('type') != 'admin') {
                $this->session->set_flashdata('message', 'You do not have permission to access this section.');
                redirect('admin-dashboard');
                return;
            }
        }
        $post = $this->input->post();
        $data = array(
            'bank_name' => $post['bank_name'],
            'hl' => $post['hl'],
            'lap' => $post['lap'],
            'bl' => $post['bl'],
            'pl' => $post['pl'],
            'el' => $post['el'],
            'sme' => $post['sme'],
            'las' => $post['las'],
            'wc' => $post['wc'],
            'auto_loan' => $post['auto_loan'],
            'ml' => $post['ml'],
            'domain_id' => $post['domain_id'],
        );
        $insert = $this->Dashboard_Model->common_insert($data, 'codebook_tbl');
        if ($insert) {
            $this->session->set_flashdata('success', 'Codebook entry created');
            redirect('admin/codebook');
        } else {
            $this->session->set_flashdata('error', 'Something went wrong');
            redirect('admin/codebook-add');
        }
    }

    public function codebook_edit($id)
    {
        if (!has_permission('My Payout Slabs') || !has_permission('Bank & Finance Type code book') ) {
                    
            if ($this->session->userdata('type') != 'admin') {
                $this->session->set_flashdata('message', 'You do not have permission to access this section.');
                redirect('admin-dashboard');
                return;
            }
        }
        $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
        $data['row'] = $this->Dashboard_Model->common_row($id, 'codebook_tbl');
        $this->load->view('admin/template/header');
        $this->load->view('admin/codebook/edit', $data);
        $this->load->view('admin/template/footer');
    }

    public function codebook_update()
    {
        if (!has_permission('My Payout Slabs') || !has_permission('Bank & Finance Type code book') ) {
                    
            if ($this->session->userdata('type') != 'admin') {
                $this->session->set_flashdata('message', 'You do not have permission to access this section.');
                redirect('admin-dashboard');
                return;
            }
        }
        $post = $this->input->post();
        $id = $post['id'];
        $data = array(
            'bank_name' => $post['bank_name'],
            'hl' => $post['hl'],
            'lap' => $post['lap'],
            'bl' => $post['bl'],
            'pl' => $post['pl'],
            'el' => $post['el'],
            'sme' => $post['sme'],
            'las' => $post['las'],
            'wc' => $post['wc'],
            'auto_loan' => $post['auto_loan'],
            'ml' => $post['ml'],
            'domain_id' => $post['domain_id'],
        );
        $update = $this->Dashboard_Model->common_update($id, $data, 'codebook_tbl');
        if ($update) {
            $this->session->set_flashdata('success', 'Codebook entry updated');
            redirect('admin/codebook');
        } else {
            $this->session->set_flashdata('error', 'Something went wrong');
            redirect('admin/codebook-edit/'.$id);
        }
    }

    public function codebook_delete($id)
    {
        if (!has_permission('My Payout Slabs') || !has_permission('Bank & Finance Type code book') ) {
                    
            if ($this->session->userdata('type') != 'admin') {
                $this->session->set_flashdata('message', 'You do not have permission to access this section.');
                redirect('admin-dashboard');
                return;
            }
        }
        $del = $this->Dashboard_Model->delete_by_id('codebook_tbl', $id);
        if ($del) {
            $this->session->set_flashdata('success', 'Codebook entry deleted');
        } else {
            $this->session->set_flashdata('error', 'Something went wrong');
        }
        redirect('admin/codebook');
    }


      public function codebookBulkDelete()
    {
         if (!has_permission('My Payout Slabs') || !has_permission('Bank & Finance Type code book') ) {
                    
            if ($this->session->userdata('type') != 'admin') {
                $this->session->set_flashdata('message', 'You do not have permission to access this section.');
                redirect('admin-dashboard');
                return;
            }
        }

        $ids = $this->input->post('ids');
        if (!empty($ids)) {
            $this->db->where_in('id', $ids)->delete('codebook_tbl');
            echo "success";
        } else {
            echo "no_ids";
        }
    }

    public function payoutslab()
    {
          if (!has_permission('My Payout Slabs') || !has_permission('Payout slab unsecured loans') ) {
            if ($this->session->userdata('type') != 'admin') {
                $this->session->set_flashdata('message', 'You do not have permission to access this section.');
                redirect('admin-dashboard');
                return;
            }
        }
        $domain_id = domain_id_get();
        $this->db->where('domain_id', $domain_id);
        if ($this->session->userdata('role') == 1) {
            $data['rows'] = $this->db->get('payoutslab_tbl')->result();
        }elseif ($this->session->userdata('role') == 3) {
            $data['rows'] = $this->db->where('type','branch')->get('payoutslab_tbl')->result();
        }else {
            $data['rows'] = $this->db->where('type','team')->get('payoutslab_tbl')->result();
        }

        $this->load->view('admin/template/header');
        $this->load->view('admin/payoutslab/list', $data);
        $this->load->view('admin/template/footer');
    }

    public function payoutslab_add()
    {
        if (!has_permission('My Payout Slabs') || !has_permission('Payout slab unsecured loans') ) {
            if ($this->session->userdata('type') != 'admin') {
                $this->session->set_flashdata('message', 'You do not have permission to access this section.');
                redirect('admin-dashboard');
                return;
            }
        }
        $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
        $this->load->view('admin/template/header');
        $this->load->view('admin/payoutslab/add', $data);
        $this->load->view('admin/template/footer');
    }

    public function payoutslab_create()
    {
        if (!has_permission('My Payout Slabs') || !has_permission('Payout slab unsecured loans') ) {
            if ($this->session->userdata('type') != 'admin') {
                $this->session->set_flashdata('message', 'You do not have permission to access this section.');
                redirect('admin-dashboard');
                return;
            }
        }
        $post = $this->input->post();
        $data = array(
            'bank_name' => $post['bank_name'],
            'businees_loan' => $post['businees_loan'],
            'personal_loan' => $post['personal_loan'],
            'interest_rate' => $post['interest_rate'],
            'doctor_loan' => $post['doctor_loan'],
            'dod' => $post['dod'],
            'od' => $post['od'],
            'top_up_cases' => $post['top_up_cases'],
            'digital' => $post['digital'],
            'team_loan' => $post['team_loan'],
            'domain_id' => $post['domain_id'],
        );
        $insert = $this->Dashboard_Model->common_insert($data, 'payoutslab_tbl');
        if ($insert) {
            $this->session->set_flashdata('success', 'Payout slab created');
            redirect('admin/payoutslab');
        } else {
            $this->session->set_flashdata('error', 'Something went wrong');
            redirect('admin/payoutslab-add');
        }
    }

    public function payoutslab_edit($id)
    {
        if (!has_permission('My Payout Slabs') || !has_permission('Payout slab unsecured loans') ) {
            if ($this->session->userdata('type') != 'admin') {
                $this->session->set_flashdata('message', 'You do not have permission to access this section.');
                redirect('admin-dashboard');
                return;
            }
        }
        $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
        $data['row'] = $this->Dashboard_Model->common_row($id, 'payoutslab_tbl');
        $this->load->view('admin/template/header');
        $this->load->view('admin/payoutslab/edit', $data);
        $this->load->view('admin/template/footer');
    }

    public function payoutslab_update()
    {
        if (!has_permission('My Payout Slabs') || !has_permission('Payout slab unsecured loans') ) {
            if ($this->session->userdata('type') != 'admin') {
                $this->session->set_flashdata('message', 'You do not have permission to access this section.');
                redirect('admin-dashboard');
                return;
            }
        }
        $post = $this->input->post();
        $id = $post['id'];
        $data = array(
            'bank_name' => $post['bank_name'],
            'businees_loan' => $post['businees_loan'],
            'personal_loan' => $post['personal_loan'],
            'interest_rate' => $post['interest_rate'],
            'doctor_loan' => $post['doctor_loan'],
            'dod' => $post['dod'],
            'od' => $post['od'],
            'top_up_cases' => $post['top_up_cases'],
            'digital' => $post['digital'],
            'team_loan' => $post['team_loan'],
            'domain_id' => $post['domain_id'],
        );
        $update = $this->Dashboard_Model->common_update($id, $data, 'payoutslab_tbl');
        if ($update) {
            $this->session->set_flashdata('success', 'Payout slab updated');
            redirect('admin/payoutslab');
        } else {
            $this->session->set_flashdata('error', 'Something went wrong');
            redirect('admin/payoutslab-edit/'.$id);
        }
    }

    public function payoutslab_delete($id)
    {
        if (!has_permission('My Payout Slabs') || !has_permission('Payout slab unsecured loans') ) {
            if ($this->session->userdata('type') != 'admin') {
                $this->session->set_flashdata('message', 'You do not have permission to access this section.');
                redirect('admin-dashboard');
                return;
            }
        }
        $del = $this->Dashboard_Model->delete_by_id('payoutslab_tbl', $id);
        if ($del) {
            $this->session->set_flashdata('success', 'Payout slab deleted');
        } else {
            $this->session->set_flashdata('error', 'Something went wrong');
        }
        redirect('admin/payoutslab');
    }

    public function payoutslabsecure()
    {
        if (!has_permission('My Payout Slabs') || !has_permission('Payout slab secured loans') ) {
            if ($this->session->userdata('type') != 'admin') {
                $this->session->set_flashdata('message', 'You do not have permission to access this section.');
                redirect('admin-dashboard');
                return;
            }
        }
        $domain_id = domain_id_get();
        $this->db->where('domain_id', $domain_id);
        if ($this->session->userdata('role') == 1) {
            $data['rows'] = $this->db->get('payoutslabsecure_tbl')->result();
        }elseif ($this->session->userdata('role') == 3) {
            $data['rows'] = $this->db->where('type','branch')->get('payoutslabsecure_tbl')->result();
        }else {
            $data['rows'] = $this->db->where('type','team')->get('payoutslabsecure_tbl')->result();
        }
        $this->load->view('admin/template/header');
        $this->load->view('admin/payoutslabsecure/list', $data);
        $this->load->view('admin/template/footer');
    }

    public function payoutslabsecure_add()
    {
        if (!has_permission('My Payout Slabs') || !has_permission('Payout slab secured loans') ) {
            if ($this->session->userdata('type') != 'admin') {
                $this->session->set_flashdata('message', 'You do not have permission to access this section.');
                redirect('admin-dashboard');
                return;
            }
        }
        $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
        $this->load->view('admin/template/header');
        $this->load->view('admin/payoutslabsecure/add', $data);
        $this->load->view('admin/template/footer');
    }

    public function payoutslabsecure_create()
    {
        if (!has_permission('My Payout Slabs') || !has_permission('Payout slab secured loans') ) {
            if ($this->session->userdata('type') != 'admin') {
                $this->session->set_flashdata('message', 'You do not have permission to access this section.');
                redirect('admin-dashboard');
                return;
            }
        }
        $post = $this->input->post();
        $data = array(
            'bank_name' => $post['bank_name'],
            'home_loan' => $post['home_loan'],
            'affordable_housing' => $post['affordable_housing'],
            'loan_against_property' => $post['loan_against_property'],
            'loan_against_credit_card' => $post['loan_against_credit_card'],
            'sme_loans' => $post['sme_loans'],
            'dod_od' => $post['dod_od'],
            'credit_card_swipe_machine' => $post['credit_card_swipe_machine'],
            'plant_machinery' => $post['plant_machinery'],
            'education_loan' => $post['education_loan'],
            'machinery_loan' => $post['machinery_loan'],
            'msme' => $post['msme'],
            'working_capital_od' => $post['working_capital_od'],
            'secured_term_loan' => $post['secured_term_loan'],
            'gold_loan' => $post['gold_loan'],
            'remarks' => $post['remarks'],
            'domain_id' => $post['domain_id'],
        );
        $insert = $this->Dashboard_Model->common_insert($data, 'payoutslabsecure_tbl');
        if ($insert) {
            $this->session->set_flashdata('success', 'Secure payout slab created');
            redirect('admin/payoutslabsecure');
        } else {
            $this->session->set_flashdata('error', 'Something went wrong');
            redirect('admin/payoutslabsecure-add');
        }
    }

    public function payoutslabsecure_edit($id)
    {
        if (!has_permission('My Payout Slabs') || !has_permission('Payout slab secured loans') ) {
            if ($this->session->userdata('type') != 'admin') {
                $this->session->set_flashdata('message', 'You do not have permission to access this section.');
                redirect('admin-dashboard');
                return;
            }
        }
        $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
        $data['row'] = $this->Dashboard_Model->common_row($id, 'payoutslabsecure_tbl');
        $this->load->view('admin/template/header');
        $this->load->view('admin/payoutslabsecure/edit', $data);
        $this->load->view('admin/template/footer');
    }

    public function payoutslabsecure_update()
    {
        if (!has_permission('My Payout Slabs') || !has_permission('Payout slab secured loans') ) {
            if ($this->session->userdata('type') != 'admin') {
                $this->session->set_flashdata('message', 'You do not have permission to access this section.');
                redirect('admin-dashboard');
                return;
            }
        }
        $post = $this->input->post();
        $id = $post['id'];
        $data = array(
            'bank_name' => $post['bank_name'],
            'home_loan' => $post['home_loan'],
            'affordable_housing' => $post['affordable_housing'],
            'loan_against_property' => $post['loan_against_property'],
            'loan_against_credit_card' => $post['loan_against_credit_card'],
            'sme_loans' => $post['sme_loans'],
            'dod_od' => $post['dod_od'],
            'credit_card_swipe_machine' => $post['credit_card_swipe_machine'],
            'plant_machinery' => $post['plant_machinery'],
            'education_loan' => $post['education_loan'],
            'machinery_loan' => $post['machinery_loan'],
            'msme' => $post['msme'],
            'working_capital_od' => $post['working_capital_od'],
            'secured_term_loan' => $post['secured_term_loan'],
            'gold_loan' => $post['gold_loan'],
            'remarks' => $post['remarks'],
            'domain_id' => $post['domain_id'],
        );
        $update = $this->Dashboard_Model->common_update($id, $data, 'payoutslabsecure_tbl');
        if ($update) {
            $this->session->set_flashdata('success', 'Secure payout slab updated');
            redirect('admin/payoutslabsecure');
        } else {
            $this->session->set_flashdata('error', 'Something went wrong');
            redirect('admin/payoutslabsecure-edit/'.$id);
        }
    }

    public function payoutslabsecure_delete($id)
    {
        if (!has_permission('My Payout Slabs') || !has_permission('Payout slab secured loans') ) {
            if ($this->session->userdata('type') != 'admin') {
                $this->session->set_flashdata('message', 'You do not have permission to access this section.');
                redirect('admin-dashboard');
                return;
            }
        }
        $del = $this->Dashboard_Model->delete_by_id('payoutslabsecure_tbl', $id);
        if ($del) {
            $this->session->set_flashdata('success', 'Secure payout slab deleted');
        } else {
            $this->session->set_flashdata('error', 'Something went wrong');
        }
        redirect('admin/payoutslabsecure');
    }

     public function payoutslabsecureBulkDelete()
    {
         if (!has_permission('My Payout Slabs') || !has_permission('Payout slab secured loans') ) {
                    
            if ($this->session->userdata('type') != 'admin') {
                $this->session->set_flashdata('message', 'You do not have permission to access this section.');
                redirect('admin-dashboard');
                return;
            }
        }

        $ids = $this->input->post('ids');
        if (!empty($ids)) {
            $this->db->where_in('id', $ids)->delete('codebook_tbl');
            echo "success";
        } else {
            echo "no_ids";
        }
    }
    

    public function banker_add()
    {
         if (!has_permission('Banker Contact') && $this->session->userdata('type') != 'admin') {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            }
        $data['bank_data'] = $this->Dashboard_Model->bank_list();
        $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();

        $this->load->view('admin/template/header');
        $this->load->view('admin/banker/create', $data);
        $this->load->view('admin/template/footer');
    }

    public function banker_edit($id)
    {
       if (!has_permission('Banker Contact') && $this->session->userdata('type') != 'admin') {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            }
         $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();     
        $data['datas'] = $this->Dashboard_Model->common_row($id, 'banker');
        $data['bank_data'] = $this->Dashboard_Model->bank_list();
        $this->load->view('admin/template/header');
        $this->load->view('admin/banker/edit', $data);
        $this->load->view('admin/template/footer');
    }

    public function banker_create()
    {
        if (!has_permission('Banker Contact') && $this->session->userdata('type') != 'admin') {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            }
        $post = $this->input->post();
        // print_r($post);die;
        $insert = $this->Dashboard_Model->common_insert($post, 'banker');

        if ($insert) {
            $this->session->set_flashdata('success', 'Banker has been Created Successfully!!');
            redirect('admin/banker');
        } else {
            $this->session->set_flashdata('error', 'Something Went Wrong, try again!!');
            redirect('admin/banker-add');
        }
    }

    public function banker_del($id)
    {
        if (!has_permission('Banker Contact') && $this->session->userdata('type') != 'admin') {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            }
        $banker_del = $this->Dashboard_Model->common_update($id, array('status' => 0), 'banker');
        if ($banker_del) {
            $this->session->set_flashdata('success', 'Banker delete');
            redirect('admin/banker');
        } else {
            $this->session->set_flashdata('error', 'Something Went Wrong, try again!!');
            redirect('admin/banker');
        }
    }

    public function banker_update()
    {
        if (!has_permission('Banker Contact') && $this->session->userdata('type') != 'admin') {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            }
        // $id = $this->input->post('id');
        $post = $this->input->post();
        $id = $post['id'];
        unset($post['id']);
        $update = $this->Dashboard_Model->common_update($id, $post, 'banker');
        if ($update) {
            redirect('admin/banker');
        } else {
            redirect('admin/banker-update');
        }
    }

    public function bankermaster()
    {
        if (!has_permission('Add Bank') && $this->session->userdata('type') != 'admin' ) {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            }
        $data['banker'] = $this->Dashboard_Model->bankmaster_data_get();
        $this->load->view('admin/template/header');
        $this->load->view('admin/banker-master/list', $data);
        $this->load->view('admin/template/footer');
    }

    public function bankmaster_add()
    {  
        if (!has_permission('Add Bank')) {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            }

        $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
        // echo "<pre>";print_r();die;
        // $data['bank_data'] = $this->Dashboard_Model->bank_list();
        $this->load->view('admin/template/header');
        $this->load->view('admin/banker-master/create', $data);
        $this->load->view('admin/template/footer');
    }

    public function bankmaster_create()
    {
        if (!has_permission('Add Bank')) {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            }
        $post = $this->input->post();
        // print_r($post);die;
        $insert = $this->Dashboard_Model->common_insert($post, 'tbl_banks');

        if ($insert) {
            $this->session->set_flashdata('success', 'Bank has been Created Successfully!!');
            redirect('admin/banker-master');
        } else {
            $this->session->set_flashdata('error', 'Something Went Wrong, try again!!');
            redirect('admin/bankmaster-add');
        }
    }

    public function bankmaster_edit($id)
    {
        if (!has_permission('Add Bank')) {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            }
             $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
        $data['datas'] = $this->Dashboard_Model->common_row($id, 'tbl_banks');
        $data['bank_data'] = $this->Dashboard_Model->bank_list();
        $this->load->view('admin/template/header');
        $this->load->view('admin/banker-master/edit', $data);
        $this->load->view('admin/template/footer');
    }

    public function bankermaster_update()
    {
        if (!has_permission('Add Bank')) {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            }
        // $id = $this->input->post('id');
        $post = $this->input->post();
        $id = $post['id'];
        unset($post['id']);
        $update = $this->Dashboard_Model->common_update($id, $post, 'tbl_banks');
        if ($update) {
            redirect('admin/banker-master');
        } else {
            redirect('admin/bankmaster-update');
        }
    }

    public function bankermaster_del($id)
    {
        if (!has_permission('Add Bank')) {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            }
        $banker_del = $this->Dashboard_Model->common_update($id, array('status' => 0), 'tbl_banks');
        if ($banker_del) {
            $this->session->set_flashdata('success', 'Bank-Name delete');
            redirect('admin/banker-master');
        } else {
            $this->session->set_flashdata('error', 'Something Went Wrong, try again!!');
            redirect('admin/banker-master');
        }
    }

    public function subAdmin()
    {
        if ($this->session->userdata('type') != 'admin') {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            }
        $this->db->select('user_master.*, domains.url as domain_url');
        $this->db->from('user_master');
        $this->db->join('domains', 'domains.id = user_master.domain_id', 'left');
        $this->db->where('user_master.made_by', $this->session->userdata('user_id'));
        $data['subAdmin'] = $this->db->get()->result_array();
        // $data['subAdmin'] = $this->db->where('made_by',$this->session->userdata('user_id'))->get('user_master')->result_array();
        $this->load->view('admin/template/header');
        $this->load->view('admin/sub-admin/list', $data);
        $this->load->view('admin/template/footer');
    }

    public function subAdminAdd()
    {
        if ($this->session->userdata('type') != 'admin') {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            }
        // $data['bank_data'] = $this->Dashboard_Model->bank_list();
        $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
        $this->load->view('admin/template/header');
        $this->load->view('admin/sub-admin/create', $data);
        $this->load->view('admin/template/footer');
    }

    public function subAdminCreate()
    {
        if ($this->session->userdata('type') != 'admin') {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            }

        $post = $this->input->post();
        // print_r($post);die;
        $data = array(
            'name' => $post['name'],
            'username' => $post['name'],
            'email' => $post['email'],
            'mobile_no' => $post['mobile_no'],
            'password' => MD5($post['password']),
            'pass_text' => $post['password'],
            'type' => 'subadmin',
            'role' => 1,
            'status' => $post['status'],
            'domain_id' => $post['domain_id'],
            'made_by' => $this->session->userdata('user_id'),
            'date'=>date('Y-m-d H:i:s'),
            'created_on'=>date('Y-m-d H:i:s'),
        );
        $insert = $this->Dashboard_Model->common_insert($data, 'user_master');
  

        if ($insert) {
            $this->session->set_flashdata('success', 'Sub-Admin has been Created Successfully!!');
            redirect('admin/sub-admin');
        } else {
        $this->session->set_flashdata('error', 'Something Went Wrong, try again!!');
        redirect('admin/sub-admin-add');
        }
    }

    public function subAdminEdit($id)
    {
        if ($this->session->userdata('type') != 'admin') {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            }
        $data['datas'] = $this->Dashboard_Model->common_row($id, 'user_master');
        $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
        
        $this->load->view('admin/template/header');
        $this->load->view('admin/sub-admin/edit', $data);
        $this->load->view('admin/template/footer');
    }

    public function subAdminUpdate()
    {
        if ($this->session->userdata('type') != 'admin') {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            }
        // $id = $this->input->post('id');
        $post = $this->input->post();
        $id = $post['id'];
        unset($post['id']);
        $data = array(
            'name' => $post['name'],
            'username' => $post['name'],
            'email' => $post['email'],
            'mobile_no' => $post['mobile_no'],
            'password' => MD5($post['password']),
            'pass_text' => $post['password'],
            'role' => 1,
            'status' => $post['status'],
            'domain_id' => $post['domain_id'],
            'made_by' => $this->session->userdata('user_id'),
        );
        $update = $this->Dashboard_Model->common_update($id, $data, 'user_master');
        if ($update) {
            redirect('admin/sub-admin');
        } else {
            redirect('admin/sub-admin-update');
        }
    }

    public function subAdminDel($id)
    { 
        if ($this->session->userdata('type') != 'admin') {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            }
        $banker_del = $this->db->where('id', $id)->delete('user_master');
        if ($banker_del) {
            $this->session->set_flashdata('success', 'Sub-Admin deleted successfully');
            redirect('admin/sub-admin');
        } else {
            $this->session->set_flashdata('error', 'Something went wrong, try again!!');
            redirect('admin/sub-admin');
        }
    }

    //Term Condition
    public function termsCondition()
    {
        
        if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('footer pages') && has_permission('Terms Conditions'))) {
            if (isset($_GET['domain_id']) && (int)$_GET['domain_id']) {
                $data['datas'] = $this->db->where('domain_id',$_GET['domain_id'])->get('terms_condition')->row_array();
            }else {
                $data['datas'] = $this->db->where('domain_id', domain_id_get())->get('terms_condition')->row_array();
            }
    
            $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
        //   print_r($data['datas'] );die;
            
            $this->load->view('admin/template/header');
            $this->load->view('admin/terms-condition/edit', $data);
            $this->load->view('admin/template/footer');
        }else{

            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            
        }

    }

    public function termsConditionUpdate()
    {
        if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('footer pages') && has_permission('Terms Conditions'))) {
            $id = $this->input->post('id');
            $domain_id = $this->input->post('domain_id');
            $post = $this->input->post();
            $data['datas'] = $this->db->where('domain_id',$domain_id)->get('terms_condition')->row_array();
    
            // Upload background img
            $config['upload_path'] = './assets/images/terms-condition';
            $config['allowed_types'] = 'jpg|jpeg|png|gif|bmp|tiff|jfif';  // Explicit allowed image types
            $config['max_size'] = 2048;  // 2MB
            $config['encrypt_name'] = TRUE;  // Encrypt file name
        
            $this->upload->initialize($config);
    
        if ($this->upload->do_upload('background_img')) {
            $upload_data = $this->upload->data();
    
                $background_img = $upload_data['file_name'];
                
    
        }
    
    
            if($data['datas']){
           
            $id = $post['id'];
           
            $data = array(
                'title' => $post['name'],
                'description' => $post['description'],
                'domain_id' => $post['domain_id'],
                'user_id' => $this->session->userdata('user_id'),
            );
            if ($this->upload->do_upload('background_img')) {
                $data['background_img'] = $background_img;
            }
            $update = $this->Dashboard_Model->common_update($id, $data, 'terms_condition');
            $this->session->set_flashdata('success', 'Terms Condition Update successfully');
                redirect('admin/terms_condition');
            
        }else{
            $data = array(
                'title' => $post['name'],
                'description' => $post['description'],
                'domain_id' => $post['domain_id'],
                'user_id' => $this->session->userdata('user_id'),
            );
            if ($this->upload->do_upload('background_img')) {
                $data['background_img'] = $background_img;
            }
            $insert = $this->Dashboard_Model->common_insert($data, 'terms_condition');
            $this->session->set_flashdata('success', 'Terms Condition Add successfully');
                redirect('admin/terms_condition');
            
        }
        }else{
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            }
    }

    //Disclaimer
    public function disclaimer(){
            
        if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('footer pages') && has_permission('Disclaimer'))) {
        
        if (isset($_GET['domain_id']) && (int)$_GET['domain_id']) {
            $data['datas'] = $this->db->where('domain_id',$_GET['domain_id'])->get('disclaimer')->row_array();
        }else {
            $data['datas'] = $this->db->where('domain_id', domain_id_get())->get('disclaimer')->row_array();
        }
        $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
        
        
        $this->load->view('admin/template/header');
        $this->load->view('admin/disclaimer/edit', $data);
        $this->load->view('admin/template/footer');
        }else{ 
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            
        }
    }

    public function disclaimerUpdate()
    {
    
        if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('footer pages') && has_permission('Disclaimer'))) {
            $id = $this->input->post('id');
            $post = $this->input->post();
            $data['datas'] = $this->db->where('domain_id',$post['domain_id'])->get('disclaimer')->row_array();
            if($data['datas']){
            
            $id = $post['id'];
            
            $data = array(
                'title' => $post['name'],
                'description' => $post['description'],
                'domain_id' => $post['domain_id'],
                'user_id' => $this->session->userdata('user_id'),
            );
            $update = $this->Dashboard_Model->common_update($id, $data, 'disclaimer');
            $this->session->set_flashdata('success', 'Terms Condition Update successfully');
                redirect('admin/disclaimer');
            
        }else{
            $data = array(
                'title' => $post['name'],
                'description' => $post['description'],
                'domain_id' => $post['domain_id'],
                'user_id' => $this->session->userdata('user_id'),
            );
            $insert = $this->Dashboard_Model->common_insert($data, 'disclaimer');
            $this->session->set_flashdata('success', 'Terms Condition Add successfully');
                redirect('admin/disclaimer');
            
        }
        }else{
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            
            }
    }

    //important-update
    public function important_update()
    {
        if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('footer pages') && has_permission('Important update'))) {
            if (isset($_GET['domain_id']) && (int)$_GET['domain_id']) {
                $data['datas'] = $this->db->where('domain_id',$_GET['domain_id'])->get('important_update')->row_array();
            }else {
                $data['datas'] = $this->db->where('domain_id', domain_id_get())->get('important_update')->row_array();
            }
        $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();

        
        $this->load->view('admin/template/header');
        $this->load->view('admin/important_update/edit', $data);
        $this->load->view('admin/template/footer');

        
        }else{
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            
            }
    }
    
    public function important_updateUpdate()
    {
        if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('footer pages') && has_permission('Important update'))) {

        
            $id = $this->input->post('id');
            $post = $this->input->post();
            $data['datas'] = $this->db->where('domain_id',$post['domain_id'])->get('important_update')->row_array();
            if($data['datas']){
            
            $id = $post['id'];
            
            $data = array(
                'title' => $post['name'],
                'description' => $post['description'],
                'domain_id' => $post['domain_id'],
                'date' => $post['date'],
                'user_id' => $this->session->userdata('user_id'),
            );
            $update = $this->Dashboard_Model->common_update($id, $data, 'important_update');
            $this->session->set_flashdata('success', 'Terms Condition Update successfully');
                redirect('admin/important_update');
            
        }else{
            $data = array(
                'title' => $post['name'],
                'description' => $post['description'],
                'domain_id' => $post['domain_id'],
                'date' => $post['date'],
                'user_id' => $this->session->userdata('user_id'),
            );
            $insert = $this->Dashboard_Model->common_insert($data, 'important_update');
            $this->session->set_flashdata('success', 'Terms Condition Add successfully');
                redirect('admin/important_update');
            
        }
            }else{
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            
            }
    }

    //cancellation And Refund Policy
    public function cancellationAndRefundPolicy()
    {
        if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('footer pages') && has_permission('Cancellation Refund Policy'))) {
            if (isset($_GET['domain_id']) && (int)$_GET['domain_id']) {
                $data['datas'] = $this->db->where('domain_id',$_GET['domain_id'])->get('cancellation_and_refund_policy')->row_array();
            }else {
                $data['datas'] = $this->db->where('domain_id', domain_id_get())->get('cancellation_and_refund_policy')->row_array();
            }
            
                $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
            $this->load->view('admin/template/header');
            $this->load->view('admin/cancellation_and_refund_policy/edit', $data);
            $this->load->view('admin/template/footer');
        
        }else{
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            
            }
    }
    
    public function cancellationAndRefundPolicyUpdate()
    {
        if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('footer pages') && has_permission('Cancellation Refund Policy'))) {
            $id = $this->input->post('id');
            $post = $this->input->post();
            $data['datas'] = $this->db->where('domain_id',$post['domain_id'])->get('cancellation_and_refund_policy')->row_array();
            if($data['datas']){
            
            $id = $post['id'];
            
            $data = array(
                'title' => $post['name'],
                'description' => $post['description'],
                'user_id' => $this->session->userdata('user_id'),
            );
            $update = $this->Dashboard_Model->common_update($id, $data, 'cancellation_and_refund_policy');
            $this->session->set_flashdata('success', 'Terms Condition Update successfully');
                redirect('admin/cancellation_and_refund_policy');
            
            }else{
                $data = array(
                    'title' => $post['name'],
                    'description' => $post['description'],
                    'domain_id' => $post['domain_id'],
                    'user_id' => $this->session->userdata('user_id'),
                );
                $insert = $this->Dashboard_Model->common_insert($data, 'cancellation_and_refund_policy');
                $this->session->set_flashdata('success', 'Terms Condition Add successfully');
                    redirect('admin/cancellation_and_refund_policy');
                
            }
        }else{
        $this->session->set_flashdata('message', 'You do not have permission to access this section.');
        redirect('admin-dashboard');
        return;
        
        }
    }

    public function privacyPolicy()
    {  
        if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('footer pages') && has_permission('Privacy Policy'))) {
        
            if (isset($_GET['domain_id']) && (int)$_GET['domain_id']) {
                $data['datas'] = $this->db->where('domain_id',$_GET['domain_id'])->get('privacy_policy')->row_array();
            }else {
                $data['datas'] = $this->db->where('domain_id', domain_id_get())->get('privacy_policy')->row_array();
            }
        $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();

        $this->load->view('admin/template/header');
        $this->load->view('admin/privacy_policy/edit', $data);
        $this->load->view('admin/template/footer');
        }else{
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            
        }
    }
    
    public function privacyPolicyUpdate()
    {
        if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('footer pages') && has_permission('Privacy Policy'))) {
                
                $id = $this->input->post('id');
                $post = $this->input->post();
                $data['datas'] = $this->db->where('domain_id',$post['domain_id'])->get('privacy_policy')->row_array();
                if($data['datas']){
                
                $id = $post['id'];
                
                $data = array(
                    'title' => $post['name'],
                    'description' => $post['description'],
                    'user_id' => $this->session->userdata('user_id'),
                );
                $update = $this->Dashboard_Model->common_update($id, $data, 'privacy_policy');
                $this->session->set_flashdata('success', 'Terms Condition Update successfully');
                    redirect('admin/privacy-policy');
                
            }else{
                $data = array(
                    'title' => $post['name'],
                    'description' => $post['description'],
                    'user_id' => $this->session->userdata('user_id'),
                    'domain_id' => $post['domain_id'],
                );
                $insert = $this->Dashboard_Model->common_insert($data, 'privacy_policy');
                $this->session->set_flashdata('success', 'Terms Condition Add successfully');
                    redirect('admin/privacy-policy');
                
            }
        }else{
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            
        }
    }

    public function companyProfile()
    {            
        if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('Company') && has_permission('Profile') && has_permission('Company info'))) {
        
            if (isset($_GET['domain_id']) && (int)$_GET['domain_id']) {
                $data['datas'] = $this->db->where('domain_id',$_GET['domain_id'])->get('company_profile')->row_array();
            }else {
                $data['datas'] = $this->db->where('domain_id', domain_id_get())->get('company_profile')->row_array();
            }
            $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
            $this->load->view('admin/template/header');
            $this->load->view('admin/company_profile/edit', $data);
            $this->load->view('admin/template/footer');
        }else{
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            
            }

    }
    
    public function companyProfileUpdate()
    {
        if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('Company') && has_permission('Profile') && has_permission('Company info'))) {
            $id = $this->input->post('id');
            $domain_id = $this->input->post('domain_id');
            $post = $this->input->post();
            $data['datas'] = $this->db->where('domain_id',$domain_id)->get('company_profile')->row_array();
            if($data['datas']){
            
            $id = $post['id'];

            $config['upload_path'] = './assets/images/media_coverage';
            $config['allowed_types'] = 'jpg|jpeg|png|gif|bmp|tiff|jfif|webp|web';  // Explicit allowed image types
            $config['max_size'] = 16384;  // 16MB
            $config['encrypt_name'] = TRUE;  // Encrypt file name

            $this->upload->initialize($config);

            // Check image upload or existing image_id
            if ($this->upload->do_upload('image')) {
                $upload_data = $this->upload->data();
                $image_name = $upload_data['file_name'];
            } elseif (!empty($post['image_id'])) {
                $image_name = $post['image_id'];
            } else {
                $this->session->set_flashdata('error', 'You did not select a file to upload.');
                // return;
            }
            // print_r($_FILES);die;
            
            $data = array(
                'title' => $post['name'],
                'sub_title' => $post['sub_title'],
                'sub_title_text' => $post['sub_title_text'],
                'description' => $post['description'],
                'right_description' => $post['right_description'],
                'four_sub_title' => $post['four_sub_title'],
                'four_title' => $post['four_title'],
                'third_title' => $post['third_title'],
                'third_sub_title' => $post['third_sub_title'],
                'image' => $image_name,
                'second_title' => $post['second_title'],
                'second_sub_title' => $post['second_sub_title'],
                'user_id' => $this->session->userdata('user_id'),
            );
            $update = $this->Dashboard_Model->common_update($id, $data, 'company_profile');
            $this->session->set_flashdata('success', 'Company Profile Update successfully');
                redirect('admin/company-profile');
            
            }else{
                $data = array(
                    'title' => $post['name'],
                    'sub_title' => $post['sub_title'],
                    'sub_title_text' => $post['sub_title_text'],
                    'description' => $post['description'],
                    'user_id' => $this->session->userdata('user_id'),
                    'right_description' => $post['right_description'],
                    'four_sub_title' => $post['four_sub_title'],
                    'four_title' => $post['four_title'],
                    'third_title' => $post['third_title'],
                    'third_sub_title' => $post['third_sub_title'],
                    'image' => $image_name,
                    'second_title' => $post['second_title'],
                    'second_sub_title' => $post['second_sub_title'],
                    'domain_id' => $post['domain_id']
                );
                $insert = $this->Dashboard_Model->common_insert($data, 'company_profile');
                $this->session->set_flashdata('success', 'Company Profile Add successfully');
                    redirect('admin/company-profile');
                
            }
        }else{
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
        
        }
    }

        // Our Story

        public function ourStory()
        {
            // $sql = "ALTER TABLE our_story ADD domain_id INT(11) NULL ";
            // $this->db->query($sql);
            // echo "Column added successfully!";

            if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('Company') && has_permission('Profile') && has_permission('our story'))) {
                // if ($this->session->userdata('type') == 'admin') { 
                //      $data['subAdmin'] = $this->db->get('our_story')->result_array();
                //  }else {
                     $data['subAdmin'] = $this->db->where('domain_id', domain_id_get())->get('our_story')->result_array();
                //  }
                 // echo '<pre>';print_r($data['subAdmin'] );die;
                 $this->load->view('admin/template/header');
                 $this->load->view('admin/our_story/list', $data);
                 $this->load->view('admin/template/footer');
			
                }else{
                $this->session->set_flashdata('message', 'You do not have permission to access this section.');
                redirect('admin-dashboard');
                return;
                
                }

        }
        public function ourStoryAdd()
        {
           if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('Company') && has_permission('Profile') && has_permission('our story'))) {
               // $data['bank_data'] = $this->Dashboard_Model->bank_list();
               $data['datas'] = $this->db->get('our_story')->row_array();
               $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
               $this->load->view('admin/template/header');
               $this->load->view('admin/our_story/create',$data);
               $this->load->view('admin/template/footer');
           
			
           }else{
                $this->session->set_flashdata('message', 'You do not have permission to access this section.');
                redirect('admin-dashboard');
                return;
                
                }
        }
        public function ourStoryCreate()
        {
            if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('Company') && has_permission('Profile') && has_permission('our story'))) {
			
                $post = $this->input->post();
                // print_r($post);die;
                $data = array(
                    'date' => $post['date'],
                    'domain_id' => $post['domain_id'],
                    'title' => $post['title'],
                    'description' => $post['description'],
                    'heading' => $post['heading'],
                    'heading_text' => $post['heading_text'],
                    'user_id' => $this->session->userdata('user_id'),
                );
                $insert = $this->Dashboard_Model->common_insert($data, 'our_story');
    
                if ($insert) {
                    $this->session->set_flashdata('success', 'Oue Story has been Created Successfully!!');
                    redirect('admin/our-story');
                } else {
                $this->session->set_flashdata('error', 'Something Went Wrong, try again!!');
                redirect('admin/our-story-add');
                }
            }else{
                $this->session->set_flashdata('message', 'You do not have permission to access this section.');
                redirect('admin-dashboard');
                return;
                
                }
        }
        public function ourStoryEdit($id)
        {
            if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('Company') && has_permission('Profile') && has_permission('our story'))) {
                $data['datas'] = $this->Dashboard_Model->common_row($id, 'our_story');
                $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
                
                $this->load->view('admin/template/header');
                $this->load->view('admin/our_story/edit', $data);
                $this->load->view('admin/template/footer');
			
            }else{
                $this->session->set_flashdata('message', 'You do not have permission to access this section.');
                redirect('admin-dashboard');
                return;
                
            }
        }
    
        public function ourStoryUpdate()
        {
            if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('Company') && has_permission('Profile') && has_permission('our story'))) {
			
                // $id = $this->input->post('id');
                $post = $this->input->post();
                $id = $post['id'];
                unset($post['id']);
                $data = array(
                    'date' => $post['date'],
                    'title' => $post['title'],
                    'domain_id' => $post['domain_id'],
                    'description' => $post['description'],
                    'user_id' => $this->session->userdata('user_id'),
                    'heading' => $post['heading'],
                    'heading_text' => $post['heading_text'],
                );
                $update = $this->Dashboard_Model->common_update($id, $data, 'our_story');
                
                if ($update) {
                    $this->session->set_flashdata('success', 'Our Story Update successfully');
                    redirect('admin/our-story');
                } else {
                    redirect('admin/our-story-update');
                }
             }else{
                $this->session->set_flashdata('message', 'You do not have permission to access this section.');
                redirect('admin-dashboard');
                return;
                
            }
        }
        public function ourStoryDel($id)
        { 
            if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('Company') && has_permission('Profile') && has_permission('our story'))) {
                $banker_del = $this->db->where('id', $id)->delete('our_story');
                if ($banker_del) {
                    $this->session->set_flashdata('success', 'Our Story deleted successfully');
                    redirect('admin/our-story');
                } else {
                    $this->session->set_flashdata('error', 'Something went wrong, try again!!');
                    redirect('admin/our-story');
                }
			
                }else {
                $this->session->set_flashdata('message', 'You do not have permission to access this section.');
                redirect('admin-dashboard');
                return;
                
            }
        }


                // Smartest Choice

                public function smartChoice()
                {
                   

                    if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('Company') && has_permission('Profile') && has_permission('smartest choice'))) {
                        
			
                        // if ($this->session->userdata('type') == 'admin') { 
                        //     $data['smartChoice'] = $this->db->get('smart_choice')->result_array();
                        // }else {
                            $data['smartChoice'] = $this->db->where('domain_id', domain_id_get())->get('smart_choice')->result_array();
                        // }
                    
                    $this->load->view('admin/template/header');
                    $this->load->view('admin/smart_choice/list', $data);
                    $this->load->view('admin/template/footer');
                }else{
                $this->session->set_flashdata('message', 'You do not have permission to access this section.');
                redirect('admin-dashboard');
                return;
                
                }
                }
                public function smartChoiceAdd()
                {
                if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('Company') && has_permission('Profile') && has_permission('smartest choice'))) {
			
                    // $data['bank_data'] = $this->Dashboard_Model->bank_list();
                    $data['datas'] = $this->db->get('smart_choice')->row_array();
                    $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
                    $this->load->view('admin/template/header');
                    $this->load->view('admin/smart_choice/create',$data);
                    $this->load->view('admin/template/footer');
                }else{
                $this->session->set_flashdata('message', 'You do not have permission to access this section.');
                redirect('admin-dashboard');
                return;
                
                }
                }
                public function smartChoiceCreate()
                {
                      if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('Company') && has_permission('Profile') && has_permission('smartest choice'))) {
			
                          $post = $this->input->post();
                          // print_r($post);die;
                          $data = array(
                              'title' => $post['title'],
                              'text' => $post['text'],
                              'icon' => $post['icon'],
                              'user_id' => $this->session->userdata('user_id'),
                              'domain_id' => $post['domain_id'],
                              'heading' => $post['heading'],
                              'heading_text' => $post['heading_text'],
                          );
                          $insert = $this->Dashboard_Model->common_insert($data, 'smart_choice');
              
                          if ($insert) {
                              $this->session->set_flashdata('success', 'Smart Choice has been Created Successfully!!');
                              redirect('admin/smart-choice');
                          } else {
                          $this->session->set_flashdata('error', 'Something Went Wrong, try again!!');
                          redirect('admin/our-story-add');
                          }
                }else{
                $this->session->set_flashdata('message', 'You do not have permission to access this section.');
                redirect('admin-dashboard');
                return;
                
                }
                }
                public function smartChoiceEdit($id)
                {
                      if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('Company') && has_permission('Profile') && has_permission('smartest choice'))) {
			
                          $data['datas'] = $this->Dashboard_Model->common_row($id, 'smart_choice');
          $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
                          
                          $this->load->view('admin/template/header');
                          $this->load->view('admin/smart_choice/edit', $data);
                          $this->load->view('admin/template/footer');
                }else{
                $this->session->set_flashdata('message', 'You do not have permission to access this section.');
                redirect('admin-dashboard');
                return;
                
                }
                }
            
                public function smartChoiceUpdate()
                {
                      if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('Company') && has_permission('Profile') && has_permission('smartest choice'))) {
			
                          // $id = $this->input->post('id');
                          $post = $this->input->post();
                          $id = $post['id'];
                          unset($post['id']);
                          $data = array(
                              'title' => $post['title'],
                              'text' => $post['text'],
                              'icon' => $post['icon'],
                              'domain_id' => $post['domain_id'],
                              'user_id' => $this->session->userdata('user_id'),
                              'heading' => $post['heading'],
                              'heading_text' => $post['heading_text'],
                          );
                          $update = $this->Dashboard_Model->common_update($id, $data, 'smart_choice');
              
                          
                          if ($update) {
                              $this->session->set_flashdata('success', 'Smart Choice Update successfully');
                              redirect('admin/smart-choice');
                          } else {
                              redirect('admin/smart-choice-update');
                          }
                }else{
                $this->session->set_flashdata('message', 'You do not have permission to access this section.');
                redirect('admin-dashboard');
                return;
                
                }
                }
                public function smartChoiceDel($id)
                { 
                      if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('Company') && has_permission('Profile') && has_permission('smartest choice'))) {
                          $banker_del = $this->db->where('id', $id)->delete('smart_choice');
                          if ($banker_del) {
                              $this->session->set_flashdata('success', 'Smart Choice deleted successfully');
                              redirect('admin/smart-choice');
                          } else {
                              $this->session->set_flashdata('error', 'Something went wrong, try again!!');
                              redirect('admin/smart-choice');
                          }
			
               }else{
                $this->session->set_flashdata('message', 'You do not have permission to access this section.');
                redirect('admin-dashboard');
                return;
                
                }
                }

        // Media Coverage

        public function mediaCoverage()
        {
            
              if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('Company') && has_permission('Profile') && has_permission('media coverage'))) {
			
                //   if ($this->session->userdata('type') == 'admin') { 
                //      $data['smartChoice'] = $this->db->get('media_coverage')->result_array();
                //  }else {
                     $data['smartChoice'] = $this->db->where('domain_id', domain_id_get())->get('media_coverage')->result_array();
                //  }
             
             $this->load->view('admin/template/header');
             $this->load->view('admin/media_coverage/list', $data);
             $this->load->view('admin/template/footer');
               }else{
                $this->session->set_flashdata('message', 'You do not have permission to access this section.');
                redirect('admin-dashboard');
                return;
                
                }
        }
        public function mediaCoverageAdd()
        {
            if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('Company') && has_permission('Profile') && has_permission('media coverage'))) {
			
                // $data['bank_data'] = $this->Dashboard_Model->bank_list();
                $data['datas'] = $this->db->get('media_coverage')->row_array();
                $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
                $this->load->view('admin/template/header');
                $this->load->view('admin/media_coverage/create',$data);
                $this->load->view('admin/template/footer');
                }else{
                $this->session->set_flashdata('message', 'You do not have permission to access this section.');
                redirect('admin-dashboard');
                return;
                
                }
        }
        public function mediaCoverageCreate()
        {
            if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('Company') && has_permission('Profile') && has_permission('media coverage'))) {
                // Upload configuration
                $config['upload_path'] = './assets/images/media_coverage';
                $config['allowed_types'] = 'jpg|jpeg|png|gif|bmp|tiff|jfif';  // Explicit allowed image types
                $config['max_size'] = 2048;  // 2MB
                $config['encrypt_name'] = TRUE;  // Encrypt file name
            
                $this->upload->initialize($config);
            
                // Check if the image upload was successful
                if ($this->upload->do_upload('image')) {
                    $upload_data = $this->upload->data();
            
                    // Debugging: Check the uploaded data
                    echo '<pre>';
                    print_r($upload_data);
                    echo '</pre>';
            
                    // Prepare data for database insertion
                    $data = array(
                       
                        'image' => $upload_data['file_name'],
                        'user_id' => $this->session->userdata('user_id'),
                        'heading' => $this->input->post('heading'),
                        'text' => $this->input->post('text'),
                        'domain_id' => $this->input->post('domain_id'),
                    );
            
                    // Insert into database
                    $insert = $this->Dashboard_Model->common_insert($data, 'media_coverage');
    
                    if ($insert) {
                        $this->session->set_flashdata('success', 'Media Coverage has been Created Successfully!');
                        redirect('admin/media-coverage');
                    } else {
                        $this->session->set_flashdata('error', 'Something Went Wrong, try again!');
                        redirect('admin/media-coverage-add');
                    }
                } else {
                    // Upload failed
                    echo $this->upload->display_errors();  // Display upload errors
                    die();  // Stop execution to see the error
                }
			
                }else{
                $this->session->set_flashdata('message', 'You do not have permission to access this section.');
                redirect('admin-dashboard');
                return;
                
                }
        }
        
        
        public function mediaCoverageEdit($id)
        {
            if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('Company') && has_permission('Profile') && has_permission('media coverage'))) {
                $data['datas'] = $this->Dashboard_Model->common_row($id, 'media_coverage');
                $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
                
                $this->load->view('admin/template/header');
                $this->load->view('admin/media_coverage/edit', $data);
                $this->load->view('admin/template/footer');
			
                }else{
                $this->session->set_flashdata('message', 'You do not have permission to access this section.');
                redirect('admin-dashboard');
                return;
                
                }
        }
    
        public function mediaCoverageUpdate()
        {
            if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('Company') && has_permission('Profile') && has_permission('media coverage'))) {
                $post = $this->input->post();
                $id = $post['id'];
                unset($post['id']);
                // Upload configuration
                $config['upload_path'] = './assets/images/media_coverage';
                $config['allowed_types'] = 'jpg|jpeg|png|gif|bmp|tiff|jfif';  // Explicit allowed image types
                $config['max_size'] = 16384;  // 16MB
                $config['encrypt_name'] = TRUE;  // Encrypt file name
    
                $this->upload->initialize($config);
                // print_r($post);die;
    
                // Check image upload or existing image_id
                if ($this->upload->do_upload('image')) {
                    $upload_data = $this->upload->data();
                    $image_name = $upload_data['file_name'];
                } elseif (!empty($post['image_id'])) {
                    $image_name = $post['image_id'];
                } else {
                    $this->session->set_flashdata('error', 'You did not select a file to upload.');
                    return;
                }
             
                     // Prepare data for database insertion
                     $data = array(
                         'image' => $image_name,
                         'user_id' => $this->session->userdata('user_id'),
                         'heading' => $post['heading'],
                         'text' => $post['text'],
                         'domain_id' => $post['domain_id'],
                     );
                         $update = $this->Dashboard_Model->common_update($id, $data, 'media_coverage');
                     if ($update) {
                        $this->session->set_flashdata('success', 'Smart Choice Update successfully');
                         redirect('admin/media-coverage');
                     } else {
                         $this->session->set_flashdata('error', 'Something Went Wrong, try again!');
                         redirect('admin/media-coverage');
                     }
			
                }else{
                $this->session->set_flashdata('message', 'You do not have permission to access this section.');
                redirect('admin-dashboard');
                return;
                
                }
            



        }
        public function mediaCoverageDel($id)
        { 
            if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('Company') && has_permission('Profile') && has_permission('media coverage'))) {
                $banker_del = $this->db->where('id', $id)->delete('media_coverage');
                if ($banker_del) {
                    $this->session->set_flashdata('success', 'Media Coverage deleted successfully');
                    redirect('admin/media-coverage');
                } else {
                    $this->session->set_flashdata('error', 'Something went wrong, try again!!');
                    redirect('admin/media-coverage');
                }
                
            }else{
                $this->session->set_flashdata('message', 'You do not have permission to access this section.');
                redirect('admin-dashboard');
                return;
                
            }
         }

        // Contect Us

    public function contectUs(){
            if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('Company') && has_permission('Contact us'))) {
                $domain_id = domain_id_get();
                    if (isset($_GET['domain_id']) && (int)$_GET['domain_id']) {
                        $data['datas'] = $this->db->where('domain_id',$_GET['domain_id'])->get('contect_us')->row_array();
                    }else {
                        $data['datas'] = $this->db->where('domain_id',$domain_id)->get('contect_us')->row_array();
                    }
                    $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
                    
                    $this->load->view('admin/template/header');
                    $this->load->view('admin/contact_us/edit', $data);
                    $this->load->view('admin/template/footer');
            }else{
                $this->session->set_flashdata('message', 'You do not have permission to access this section.');
                redirect('admin-dashboard');
                return;
            }
    }

    public function contectUsUpdate()
    {
        // $sql = "ALTER TABLE contect_us ADD domain_id INT(11) NOT NULL DEFAULT 1";
        // $this->db->query($sql);
        // echo "Column added successfully!";
        
       if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('Company') && has_permission('Contact us'))) {
           $id = $this->input->post('id');
           $post = $this->input->post();
           $data['datas'] = $this->db->where('domain_id', $post['domain_id'])->get('contect_us')->row_array();
           // echo '<pre>';
           // print_r($data['datas']);die;
           
                    // Upload background img
                    $config['upload_path'] = './assets/images/contect-us';
                    $config['allowed_types'] = 'jpg|jpeg|png|gif|bmp|tiff|jfif|webp';  // Explicit allowed image types
                    $config['max_size'] = 2048;  // 2MB
                    $config['encrypt_name'] = TRUE;  // Encrypt file name
                
                    $this->upload->initialize($config);
           
                   if ($this->upload->do_upload('background_img')) {
                       $upload_data = $this->upload->data();
               
                           $background_img = $upload_data['file_name'];
                          
           
                   }
   
   
   
            // Upload configuration
            $config['upload_path'] = './assets/images/logo';
           $config['allowed_types'] = '*'; // Explicit allowed image types
            $config['max_size'] = 5120;  // 2MB
            $config['encrypt_name'] = TRUE;  // Encrypt file name
        
            $this->upload->initialize($config);
   
            if ($this->upload->do_upload('logo_icon')) {
                $logo_icon_data = $this->upload->data();
                    $logo_icon = $logo_icon_data['file_name'];
            }
            
           if ($this->upload->do_upload('logo')) {
               $upload_data = $this->upload->data();
                   $logo = $upload_data['file_name'];
           }
           
           if ($this->upload->do_upload('payment_images')) {
               $payment_data = $this->upload->data();
                   $payment_images = $payment_data['file_name'];
           }

           if ($this->upload->do_upload('id_card_image')) {
               $id_card_images = $this->upload->data();
                   $id_card_image = $id_card_images['file_name'];
           }
           if ($this->upload->do_upload('id_card_bg_image')) {
               $id_card_bg_images = $this->upload->data();
                   $id_card_bg_image = $id_card_bg_images['file_name'];
           }
           if ($this->upload->do_upload('offer_letter_image')) {
               $offer_letter_images = $this->upload->data();
                   $offer_letter_image = $offer_letter_images['file_name'];
           }
           
           if($data['datas']){
          
           $id = $post['id'];
        //   echo  '<pre>';print_r($this->upload->do_upload('logo_icon'));die;
           $data = array(
               'title' => $post['title'],
               'heading' => $post['heading'],
               'contect_form_heading' => $post['contect_form_heading'],
               'content_form_text' => $post['content_form_text'],
               'mobile_no' => $post['mobile_no'],
               'company_gmail' => $post['company_gmail'],
               'other_gmail' => $post['other_gmail'],
               'ownere_gmail' => $post['ownere_gmail'],
               'company_url' => $post['company_url'],
               'cin_no' => $post['cin_no'],
               'registered_office' => $post['registered_office'],
               'google' => $post['google'],
               'facebook' => $post['facebook'],
               'instagram' => $post['instagram'],
               'twitter' => $post['twitter'],
               'linkedin' => $post['linkedin'],
               'pinterest' => $post['pinterest'],
               'youtube' => $post['youtube'],
               'description' =>$post['description'],
               'user_id' => $this->session->userdata('user_id'),
               'domain_id' =>$post['domain_id'],
               'company_name' =>$post['company_name'],
               'company_title' =>$post['company_title'],
               'copyright' =>$post['copyright'],
               'whatsapp_no' =>$post['whatsapp_no'],
               'other_mobile' =>$post['other_mobile'],
               'owner_mobile' =>$post['owner_mobile'],
           );
           if(isset($logo)){
               $data['logo'] = $logo;
           }
           if(isset($payment_images)){
               $data['payment_images'] = $payment_images; 
           }
           if(isset($background_img)){
               $data['background_img'] = $background_img;
           }
           if(isset($logo_icon)){
               $data['logo_icon'] = $logo_icon;
           }

           if(isset($id_card_image)){
               $data['id_card_image'] = $id_card_image;
           }
           if(isset($id_card_bg_image)){
               $data['id_card_bg_image'] = $id_card_bg_image;
           }
           if(isset($offer_letter_image)){
               $data['offer_letter_image'] = $offer_letter_image;
           }
           $update = $this->Dashboard_Model->common_update($id, $data, 'contect_us');
           $this->session->set_flashdata('success', 'Contect Us Update successfully');
               redirect('admin/contect-us');
           
       }else{
           $data = array(
               'title' => $post['title'],
               'heading' => $post['heading'],
               'contect_form_heading' => $post['contect_form_heading'],
               'content_form_text' => $post['content_form_text'],
               'mobile_no' => $post['mobile_no'],
               'company_gmail' => $post['company_gmail'],
               'other_gmail' => $post['other_gmail'],
               'ownere_gmail' => $post['ownere_gmail'],
               'company_url' => $post['company_url'],
               'cin_no' => $post['cin_no'],
               'registered_office' => $post['registered_office'],
               'google' => $post['google'],
               'facebook' => $post['facebook'],
               'instagram' => $post['instagram'],
               'twitter' => $post['twitter'],
               'linkedin' => $post['linkedin'],
               'pinterest' => $post['pinterest'],
               'youtube' => $post['youtube'],
               'user_id' => $this->session->userdata('user_id'),
               'domain_id' =>$post['domain_id'],
               'company_name' =>$post['company_name'],
               'company_title' =>$post['company_title'],
               'copyright' =>$post['copyright'],
           );
           if(isset($logo)){
               $data['logo'] = $logo;
           }
           if(isset($payment_images)){
               $data['payment_images'] = $payment_images;
           }
           if(isset($background_img)){
               $data['background_img'] = $background_img;
           }
           if(isset($logo_icon)){
               $data['logo_icon'] = $logo_icon;
           }
           
           if(isset($id_card_image)){
               $data['id_card_image'] = $id_card_image;
           }
           if(isset($id_card_bg_image)){
               $data['id_card_bg_image'] = $id_card_bg_image;
           }
           if(isset($offer_letter_image)){
               $data['offer_letter_image'] = $offer_letter_image;
           }
           $insert = $this->Dashboard_Model->common_insert($data, 'contect_us');
           $this->session->set_flashdata('success', 'Contect Us Add successfully');
               redirect('admin/contect-us');
           
       }
			
       }else{
                $this->session->set_flashdata('message', 'You do not have permission to access this section.');
                redirect('admin-dashboard');
                return;
                
                }
    }



     // DSA Banner

     public function dsaBanner()
     {
        if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('Our Services') && has_permission('dsa registration page') && has_permission('dsa banner'))) {
        
            //  $sql = "ALTER TABLE dsa_banner ADD domain_id INT(11) NULL ";
            //     $this->db->query($sql);
            //     echo "Column added successfully!";



                if (isset($_GET['domain_id']) && (int)$_GET['domain_id']) {
                    $data['dsaBanner'] = $this->db->where('domain_id',$_GET['domain_id'])->get('dsa_banner')->row_array();
                }else {
                    $data['dsaBanner'] = $this->db->where('domain_id', domain_id_get())->get('dsa_banner')->row_array();
                }
//                 $data['dsaBanner'] = $this->db->get('dsa_banner')->row_array();
// echo '<pre>';print_r($data['dsaBanner']);die;
                $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
                
         
         $this->load->view('admin/template/header');
         $this->load->view('admin/dsa_banner/edit', $data);
         $this->load->view('admin/template/footer');
			
        }else{
                $this->session->set_flashdata('message', 'You do not have permission to access this section.');
                redirect('admin-dashboard');
                return;
                
                }
     }

     public function dsaBannerUpdate()
     {
        if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('Our Services') && has_permission('dsa registration page') && has_permission('dsa banner'))) {
			
            $post = $this->input->post();
        
            // Upload configuration
            $config['upload_path'] = './assets/images/dsaBanner';
            $config['allowed_types'] = 'jpg|jpeg|png|gif|bmp|tiff|jfif|webp';
            $config['max_size'] = 2048;  // 2MB
            $config['encrypt_name'] = TRUE;  // Encrypt file name
        
            $this->upload->initialize($config);
        
            $upload_data = [];
        
            // Check if the image upload was successful
            if (!empty($_FILES['image']['name'])) {
               if ($this->upload->do_upload('image')) {
                   $upload_data = $this->upload->data();
               } else {
                   // Debugging the upload error
                   echo $this->upload->display_errors();
                   exit;
               }
           }
           
        
            $data = array(
                'title' => $post['title'],
                'text' => $post['text'],
                'background_color' => $post['background_color'],
                'user_id' => $this->session->userdata('user_id'),
                'domain_id' => $post['domain_id'],
            );
        
            if (isset($upload_data['file_name'])) {
                $data['image'] = $upload_data['file_name'];
            }
        
            // Check if the banner already exists
            $existingData = $this->db->where('domain_id', $post['domain_id'])->get('dsa_banner')->row_array();
        
            if ($existingData) {
                $id = $existingData['id'];
                $update = $this->Dashboard_Model->common_update($id, $data, 'dsa_banner');
            } else {
                $insert = $this->Dashboard_Model->common_insert($data, 'dsa_banner');
            }
        
            $this->session->set_flashdata('success', 'DSA Banner updated successfully');
            redirect('admin/dsa-banner');
        }else{
                $this->session->set_flashdata('message', 'You do not have permission to access this section.');
                redirect('admin-dashboard');
                return;
                
                }
     }

          // DSA Section 1

          public function dsaSection1()
          {
              
            if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('Our Services') && has_permission('dsa registration page') && has_permission('dsa section 1'))) {
			
                if (isset($_GET['domain_id']) && (int)$_GET['domain_id']) {
                    $data['dsaSection1'] = $this->db->where('domain_id',$_GET['domain_id'])->get('dsa_section_1')->row_array();
                }else {
                    $data['dsaSection1'] = $this->db->where('domain_id', domain_id_get())->get('dsa_section_1')->row_array();
                }
                $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
                    
              
              $this->load->view('admin/template/header');
              $this->load->view('admin/dsa_section_1/edit', $data);
              $this->load->view('admin/template/footer');
            }else{
                $this->session->set_flashdata('message', 'You do not have permission to access this section.');
                redirect('admin-dashboard');
                return;
                
            }

          }
     
          public function dsaSection1Update()
          {
            
           if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('Our Services') && has_permission('dsa registration page') && has_permission('dsa section 1'))) {
			
               $post = $this->input->post();
           
               $data = array(
                   'heading' => $post['heading'],
                   'text' => $post['text'],
                   'description' => $post['description'],
                   'user_id' => $this->session->userdata('user_id'),
              'domain_id' => $post['domain_id'],
               );
           
             
               // Check if the banner already exists
               $existingData = $this->db->where('domain_id', $post['domain_id'])->get('dsa_section_1')->row_array();
           
               if ($existingData) {
                   $id = $existingData['id'];
                   $update = $this->Dashboard_Model->common_update($id, $data, 'dsa_section_1');
               } else {
                   $insert = $this->Dashboard_Model->common_insert($data, 'dsa_section_1');
               }
           
               $this->session->set_flashdata('success', 'DSA Section updated successfully');
               redirect('admin/dsa-section-1');
           }else{
                $this->session->set_flashdata('message', 'You do not have permission to access this section.');
                redirect('admin-dashboard');
                return;
                
            }
          }

        // DSA Section 2

        public function dsaSection2()
        { 
            if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('Our Services') && has_permission('dsa registration page') && has_permission('dsa section 2'))) {
			
                if (isset($_GET['domain_id']) && (int)$_GET['domain_id']) {
                    $data['dsaSection1'] = $this->db->where('domain_id',$_GET['domain_id'])->get('dsa_section_2')->row_array();
                }else {
                    $data['dsaSection1'] = $this->db->where('domain_id', domain_id_get())->get('dsa_section_2')->row_array();
                }
                    // print_r($data['dsaSection1']);die;
                $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
                    
                if (!has_permission('Pages')) {
                    $this->session->set_flashdata('message', 'You do not have permission to access this section.');
                    redirect('admin-dashboard');
                    return;
                    }
                
                $this->load->view('admin/template/header');
                $this->load->view('admin/dsa_section_2/edit', $data);
                $this->load->view('admin/template/footer');
            }else{
                $this->session->set_flashdata('message', 'You do not have permission to access this section.');
                redirect('admin-dashboard');
                return;
                
            }

        }
    
        public function dsaSection2Update()
        {
            if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('Our Services') && has_permission('dsa registration page') && has_permission('dsa section 2'))) {
			
                $post = $this->input->post();
            
                $data = array(
                    'heading_1' => $post['heading_1'],
                    'description_1' => $post['description_1'],
                    'heading_2' => $post['heading_2'],
                    'description_2' => $post['description_2'],
                    'user_id' => $this->session->userdata('user_id'),
                    'domain_id' => $post['domain_id'],
                );
            
                
                // Check if the banner already exists
                $existingData = $this->db->where('domain_id', $post['domain_id'])->get('dsa_section_2')->row_array();
            
                if ($existingData) {
                    $id = $existingData['id'];
                    $update = $this->Dashboard_Model->common_update($id, $data, 'dsa_section_2');
                } else {
                    $insert = $this->Dashboard_Model->common_insert($data, 'dsa_section_2');
                }
            
                $this->session->set_flashdata('success', 'DSA Section updated successfully');
                redirect('admin/dsa-section-2');
            }else{
                $this->session->set_flashdata('message', 'You do not have permission to access this section.');
                redirect('admin-dashboard');
                return;
                
            }

        }  


        // DSA Section 3

        public function dsaSection3()
        {
           
            
            if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('Our Services') && has_permission('dsa registration page') && has_permission('dsa section 3'))) {
                if (isset($_GET['domain_id']) && (int)$_GET['domain_id']) {
                    $data['dsaSection1'] = $this->db->where('domain_id',$_GET['domain_id'])->get('dsa_section_3')->row_array();
                }else {
                    $data['dsaSection1'] = $this->db->where('domain_id', domain_id_get())->get('dsa_section_3')->row_array();
                }
                    // print_r($data['ds    aSection1']);die;
                $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
                
                $this->load->view('admin/template/header');
                $this->load->view('admin/dsa_section_3/edit', $data);
                $this->load->view('admin/template/footer');
			
            }else{
                $this->session->set_flashdata('message', 'You do not have permission to access this section.');
                redirect('admin-dashboard');
                return;
                
            }

        }
    
        public function dsaSection3Update()
        {
            if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('Our Services') && has_permission('dsa registration page') && has_permission('dsa section 3'))) {
			
                $post = $this->input->post();
            
                $data = array(
                    'heading' => $post['heading'],
                    'text' => $post['text'],
                    'description' => $post['description'],
                    'benefit_1' => $post['benefit_1'],
                    'benefit_2' => $post['benefit_2'],
                    'benefit_3' => $post['benefit_3'],
                    'benefit_4' => $post['benefit_4'],
                    'domain_id' => $post['domain_id'],
                    'user_id' => $this->session->userdata('user_id'),
                );
            
                
                // Check if the banner already exists
                $existingData = $this->db->where('domain_id', $post['domain_id'])->get('dsa_section_3')->row_array();
            
                if ($existingData) {
                    $id = $existingData['id'];
                    $update = $this->Dashboard_Model->common_update($id, $data, 'dsa_section_3');
                } else {
                    $insert = $this->Dashboard_Model->common_insert($data, 'dsa_section_3');
                }
            
                $this->session->set_flashdata('success', 'DSA Section updated successfully');
                redirect('admin/dsa-section-3');
            }else{
                $this->session->set_flashdata('message', 'You do not have permission to access this section.');
                redirect('admin-dashboard');
                return;
                
            }

        }  


    // Branch Banner

    public function branchBanner()
    {
        
        if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('branch franchise registration') && has_permission('branch banner'))) {
			
            if (isset($_GET['domain_id']) && (int)$_GET['domain_id']) {
                $data['branchBanner'] = $this->db->where('domain_id',$_GET['domain_id'])->get('branch_banner')->row_array();
            }else {
                $data['branchBanner'] = $this->db->where('domain_id', domain_id_get())->get('branch_banner')->row_array();
            }
                // print_r($data['branchBanner']);die;
            $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
                
        $this->load->view('admin/template/header');
        $this->load->view('admin/branch_banner/edit', $data);
        $this->load->view('admin/template/footer');
        }else {
                $this->session->set_flashdata('message', 'You do not have permission to access this section.');
                redirect('admin-dashboard');
                return;
                
            }



    }

    public function branchBannerUpdate()
    {
        
        if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('branch franchise registration') && has_permission('branch banner'))) {
		
			
            $post = $this->input->post();
        
            // Upload configuration
            $config['upload_path'] = './assets/images/branchBanner';
            $config['allowed_types'] = 'jpg|jpeg|png|gif|bmp|tiff|jfif';
            $config['max_size'] = 2048;  // 2MB
            $config['encrypt_name'] = TRUE;  // Encrypt file name
        
            $this->upload->initialize($config);
        
            $upload_data = [];
        
            // Check if the image upload was successful
            if (!empty($_FILES['image']['name'])) {
                if ($this->upload->do_upload('image')) {
                    $upload_data = $this->upload->data();
                } else {
                    // Debugging the upload error
                    echo $this->upload->display_errors();
                    exit;
                }
            }
            
        
            $data = array(
                'title' => $post['title'],
                'text' => $post['text'],
                'background_color' => $post['background_color'],
                'domain_id' =>$post['domain_id'],
                'user_id' => $this->session->userdata('user_id'),
            );
        
            if (isset($upload_data['file_name'])) {
                $data['image'] = $upload_data['file_name'];
            }
        
            // Check if the banner already exists
            $existingData = $this->db->where('domain_id', $post['domain_id'])->get('branch_banner')->row_array();
        
            if ($existingData) {
                $id = $existingData['id'];
                $update = $this->Dashboard_Model->common_update($id, $data, 'branch_banner');
            } else {
                $insert = $this->Dashboard_Model->common_insert($data, 'branch_banner');
            }
        
            $this->session->set_flashdata('success', 'Branch Banner updated successfully');
            redirect('admin/branch-banner');
        }else{
                $this->session->set_flashdata('message', 'You do not have permission to access this section.');
                redirect('admin-dashboard');
                return;
                
            }
    }    

        
    // Silver Banner

    public function silverBanner()
    {
        if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('Our Services') && has_permission('silver membership') && has_permission('silver banner'))) {
        
            if (isset($_GET['domain_id']) && (int)$_GET['domain_id']) {
                $data['silverBanner'] = $this->db->where('domain_id',$_GET['domain_id'])->get('silver_banner')->row_array();
            }else {
                $data['silverBanner'] = $this->db->where('domain_id', domain_id_get())->get('silver_banner')->row_array();
            }
        // $data['silverBanner'] = $this->db->where('user_id',$this->session->userdata('user_id'))->get('silver_banner')->row_array();
        $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
    // print_r($data['silverBanner']);die;
        $this->load->view('admin/template/header');
        $this->load->view('admin/silver_banner/edit', $data);
        $this->load->view('admin/template/footer');
			
        }else{
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            
        }
           


    }

    public function silverBannerUpdate()
    {

         if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('Our Services') && has_permission('silver membership') && has_permission('silver banner'))) {
       
			
             $post = $this->input->post();
     
             // Upload configuration
             $config['upload_path'] = './assets/images/silverBanner';
             $config['allowed_types'] = 'jpg|jpeg|png|gif|bmp|tiff|jfif';
             $config['max_size'] = 2048;  // 2MB
             $config['encrypt_name'] = TRUE;  // Encrypt file name
     
             $this->upload->initialize($config);
     
             $upload_data = [];
     
             // Check if the image upload was successful
             if (!empty($_FILES['image']['name'])) {
                 if ($this->upload->do_upload('image')) {
                     $upload_data = $this->upload->data();
                 } else {
                     // Debugging the upload error
                     echo $this->upload->display_errors();
                     exit;
                 }
             }
             
     
             $data = array(
                 'title' => $post['title'],
                 'subtitle' => $post['subtitle'],
                 'text' => $post['text'],
                 'domain_id' => $post['domain_id'],
                 'four_title' => $post['four_title'] ?? '',
                 'four_sub_title' => $post['four_sub_title'] ?? '',
                 'five_tilte' => $post['five_title'] ?? '',
                 'five_sub_title' => $post['five_sub_title'] ?? '',
                 'disclaimer' => $post['disclaimer'] ?? '',
                 'background_color' => $post['background_color'],
                 'user_id' => $this->session->userdata('user_id'),
             );
     
             if (isset($upload_data['file_name'])) {
                 $data['image'] = $upload_data['file_name'];
             }
     
             // Check if the banner already exists
             $existingData = $this->db->where('domain_id', $post['domain_id'])->get('silver_banner')->row_array();
     
             if ($existingData) {
                 $id = $existingData['id'];
                 $update = $this->Dashboard_Model->common_update($id, $data, 'silver_banner');
             } else {
                 $insert = $this->Dashboard_Model->common_insert($data, 'silver_banner');
             }
     
             $this->session->set_flashdata('success', 'Silver Banner updated successfully');
             redirect('admin/silver-banner');
         }else{
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            
        }
    } 


        // Silver Section 1

        public function silverSection1()
        {
             if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('Our Services') && has_permission('silver membership') && has_permission('silver member section 1'))) {
			
                 if (isset($_GET['domain_id']) && (int)$_GET['domain_id']) {
                     $data['silverSection1'] = $this->db->where('domain_id',$_GET['domain_id'])->get('silver_section_1')->row_array();
                 }else {
                     $data['silverSection1'] = $this->db->where('domain_id', domain_id_get())->get('silver_section_1')->row_array();
                 }
                 $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
                 // echo '<pre>';print_r($data['silverSection1'] );die;
         
                 $this->load->view('admin/template/header');
                 $this->load->view('admin/silver_section_1/edit', $data);
                 $this->load->view('admin/template/footer');
            }else{
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            
        }

        }
    

        
        public function silverSection1Update()
        {
            if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('Our Services') && has_permission('silver membership') && has_permission('silver member section 1'))) {
			
                $post = $this->input->post();
        
              
                
        
                $data = array(
                    'heading' => $post['heading'],
                    'text' => $post['text'],
                    'description' => $post['description'],
                    'previous_price' => $post['previous_price'],
                    'new_price' => $post['new_price'],
                    'card_name' => $post['card_name'],
                    'card_no' => $post['card_no'],
                    'validity' => $post['validity'],
                    'card_plan' => $post['card_plan'],
                    'branch_card_plan' => $post['branch_card_plan'],
                    'customer_card_plan' => $post['customer_card_plan'],
                    'network_card_plan' => $post['network_card_plan'],
                    'free_card_plan' => $post['free_card_plan'],
                    'network_free_card_plan' => $post['network_free_card_plan'],
                    'branch_free_card_plan' => $post['branch_free_card_plan'],
                    'customer_free_card_plan' => $post['customer_free_card_plan'],
                    'name' => $post['name'],
                    'domain_id' => $post['domain_id'],
                    'user_id' => $this->session->userdata('user_id'),
                );
                // Upload configuration
            $config['upload_path'] = './assets/images/plantinumBanner';
            $config['allowed_types'] = 'jpg|jpeg|png|gif|bmp|tiff|jfif|webp';
            $config['max_size'] = 2048;  // 2MB
            $config['encrypt_name'] = TRUE;  // Encrypt file name
    
            $this->upload->initialize($config);
    
            $upload_data = [];
    
            // Check if the image upload was successful
            if (!empty($_FILES['image']['name'])) {
                if ($this->upload->do_upload('image')) {
                    $upload_data = $this->upload->data();
                } else {
                    // Debugging the upload error
                    echo $this->upload->display_errors();
                    exit;
                }
            }
                 if (isset($upload_data['file_name'])) {
                $data['image'] = $upload_data['file_name'];
            }
        
             
                $existingData = $this->db->where('domain_id', $post['domain_id'])->get('silver_section_1')->row_array();
        
                if ($existingData) {
                    $id = $existingData['id'];
                    $update = $this->Dashboard_Model->common_update($id, $data, 'silver_section_1');
                } else {
                    $insert = $this->Dashboard_Model->common_insert($data, 'silver_section_1');
                }
        
                $this->session->set_flashdata('success', 'Silver Membership Section updated successfully');
                redirect('admin/silver-section-1');
            }else{
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            
        }
        } 

        // Silver Section 2

        public function silverSection2()
        {
         if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('Our Services') && has_permission('silver membership') && has_permission('silver member section 2'))) {
             if (isset($_GET['domain_id']) && (int)$_GET['domain_id']) {
                 $data['silverSection1'] = $this->db->where('domain_id',$_GET['domain_id'])->get('silver_section_2')->row_array();
             }else {
                 $data['silverSection1'] = $this->db->where('domain_id', domain_id_get())->get('silver_section_2')->row_array();
             }
             $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
     
             $this->load->view('admin/template/header');
             $this->load->view('admin/silver_section_2/edit', $data);
             $this->load->view('admin/template/footer');
            }else{
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            
        }

        }
    

        
        public function silverSection2Update()
        {
            if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('Our Services') && has_permission('silver membership') && has_permission('silver member section 2'))) {
                $post = $this->input->post();
                $data = array(
                    'heading' => $post['heading'],
                    'text' => $post['text'],
                    'description_1' => $post['description_1'],
                    'description_2' => $post['description_2'],
                    'domain_id' => $post['domain_id'],
                    'user_id' => $this->session->userdata('user_id'),
                );
        
             
                $existingData = $this->db->where('domain_id', $post['domain_id'])->get('silver_section_2')->row_array();
        
                if ($existingData) {
                    $id = $existingData['id'];
                    $update = $this->Dashboard_Model->common_update($id, $data, 'silver_section_2');
                } else {
                    $insert = $this->Dashboard_Model->common_insert($data, 'silver_section_2');
                }
        
                $this->session->set_flashdata('success', 'Silver Membership Section updated successfully');
                redirect('admin/silver-section-2');
            }else{
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            
        }
    
          
            
    
        } 


        // silver section  3

        public function silverSection3()
        {
           if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('Our Services') && has_permission('silver membership') && has_permission('silver member section 3'))) {
            //    if ($this->session->userdata('type') == 'admin') { 
            //        $data['subAdmin'] = $this->db->get('silver_section_3')->result_array();
            //    }else {
                   $data['subAdmin'] = $this->db->where('domain_id', domain_id_get())->get('silver_section_3')->result_array();
            //    }
   
           $this->load->view('admin/template/header');
           $this->load->view('admin/silver_section_3/list', $data);
           $this->load->view('admin/template/footer');
            
			
           }else{
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            
        }
        }
        public function silverSection3Add()
        {
            if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('Our Services') && has_permission('silver membership') && has_permission('silver member section 3'))) {
                // $data['bank_data'] = $this->Dashboard_Model->bank_list();
                $data['datas'] = $this->db->get('silver_section_3')->row_array();
                $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
    
                $this->load->view('admin/template/header');
                $this->load->view('admin/silver_section_3/create',$data);
                $this->load->view('admin/template/footer');
            }else{
                $this->session->set_flashdata('message', 'You do not have permission to access this section.');
                redirect('admin-dashboard');
                return;
                }
        }
        public function silverSection3Create()
        {
            
            if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('Our Services') && has_permission('silver membership') && has_permission('silver member section 3'))) {
                 $post = $this->input->post();
                 // print_r($post);die;
                 $data = array(
                     'title' => $post['title'],
                     'description' => $post['description'],
                     'icon' => $post['icon'],
                     'domain_id' => $post['domain_id'],
                     'user_id' => $this->session->userdata('user_id'),
                     'heading' => $post['heading'],
                     'heading_text' => $post['heading_text'],
                 );
                 $insert = $this->Dashboard_Model->common_insert($data, 'silver_section_3');
                
                 if ($insert) {
                     $this->session->set_flashdata('success', 'Silver Membership Section has been Created Successfully!!');
                     redirect('admin/silver-section-3');
                 } else {
                 $this->session->set_flashdata('error', 'Something Went Wrong, try again!!');
                 redirect('admin/silver-section-3-add');
                 }
             }else{
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            
        }
    
        }
        public function silverSection3Edit($id)
        {
           if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('Our Services') && has_permission('silver membership') && has_permission('silver member section 3'))) {
               $data['datas'] = $this->Dashboard_Model->common_row($id, 'silver_section_3');
               $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
   
               $this->load->view('admin/template/header');
               $this->load->view('admin/silver_section_3/edit', $data);
               $this->load->view('admin/template/footer');
            
           }else{
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            
        }
        }
    
        public function silverSection3Update()
        {
          if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('Our Services') && has_permission('silver membership') && has_permission('silver member section 3'))) {
              // $id = $this->input->post('id');
              $post = $this->input->post();
              $id = $post['id'];
              unset($post['id']);
              $data = array(
                  'title' => $post['title'],
                  'description' => $post['description'],
                  'icon' => $post['icon'],
                  'user_id' => $this->session->userdata('user_id'),
                  'heading' => $post['heading'],
                  'heading_text' => $post['heading_text'],
                  'domain_id' => $post['domain_id'],
              );
              $update = $this->Dashboard_Model->common_update($id, $data, 'silver_section_3');
              
              
              if ($update) {
                  $this->session->set_flashdata('success', 'Silver Membership Section Update successfully');
                  redirect('admin/silver-section-3');
              } else {
                  redirect('admin/silver-section-3-update');
              }
          }else{
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
        }
        
        }
        public function silverSection3Del($id)
        { 
           if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('Our Services') && has_permission('silver membership') && has_permission('silver member section 3'))) {
               $banker_del = $this->db->where('id', $id)->delete('silver_section_3');
               if ($banker_del) {
                   $this->session->set_flashdata('success', 'Our Story deleted successfully');
                   redirect('admin/silver-section-3');
               } else {
                   $this->session->set_flashdata('error', 'Something went wrong, try again!!');
                   redirect('admin/silver-section-3');
               }
           }else{
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            
        }
        }



                // silver section  4

                public function silverSection4()
                {

                   if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('Our Services') && has_permission('silver membership') && has_permission('silver member section 4'))) {
			
                    //    if ($this->session->userdata('type') == 'admin') { 
                    //         $data['subAdmin'] = $this->db->get('silver_section_4')->result_array();
                    //     }else {
                            $data['subAdmin'] = $this->db->where('domain_id', domain_id_get())->get('silver_section_4')->result_array();
                        // }
                        
                        $this->load->view('admin/template/header');
                        $this->load->view('admin/silver_section_4/list', $data);
                        $this->load->view('admin/template/footer');
                   }else{
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            
        }
                }
                public function silverSection4Add()
                {
                if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('Our Services') && has_permission('silver membership') && has_permission('silver member section 4'))) {
                    // $data['bank_data'] = $this->Dashboard_Model->bank_list();
                    $data['datas'] = $this->db->get('silver_section_4')->row_array();
                    $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
        
                    $this->load->view('admin/template/header');
                    $this->load->view('admin/silver_section_4/create',$data);
                    $this->load->view('admin/template/footer');
			
                }else{
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            
        }
                }
                public function silverSection4Create()
                {
                    if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('Our Services') && has_permission('silver membership') && has_permission('silver member section 4'))) {
                        $post = $this->input->post();
                        // print_r($post);die;
                        $data = array(
                            'title' => $post['title'],
                            'description' => $post['description'],
                            'user_id' => $this->session->userdata('user_id'),
                            'heading' => $post['heading'],
                            'heading_text' => $post['heading_text'],
                            'disclaimer' => $post['disclaimer'],
                            'domain_id' => $post['domain_id'],
                        );
                        $insert = $this->Dashboard_Model->common_insert($data, 'silver_section_4');
                
                        if ($insert) {
                            $this->session->set_flashdata('success', 'Silver Membership Section has been Created Successfully!!');
                            redirect('admin/silver-section-4');
                        } else {
                        $this->session->set_flashdata('error', 'Something Went Wrong, try again!!');
                        redirect('admin/silver-section-4-add');
                        }
                    }else{
                        $this->session->set_flashdata('message', 'You do not have permission to access this section.');
                        redirect('admin-dashboard');
                        return;
                        }
            
                }
                public function silverSection4Edit($id)
                {
                    if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('Our Services') && has_permission('silver membership') && has_permission('silver member section 4'))) {
                        $data['datas'] = $this->Dashboard_Model->common_row($id, 'silver_section_4');
                        $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
            
                        $this->load->view('admin/template/header');
                        $this->load->view('admin/silver_section_4/edit', $data);
                        $this->load->view('admin/template/footer');
			
                    }else{
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            
        }
                }
            
                public function silverSection4Update()
                {
                   if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('Our Services') && has_permission('silver membership') && has_permission('silver member section 4'))) {
                       // $id = $this->input->post('id');
                       $post = $this->input->post();
                       $id = $post['id'];
                       unset($post['id']);
                       $data = array(
                           'title' => $post['title'],
                           'description' => $post['description'],
                           'user_id' => $this->session->userdata('user_id'),
                           'domain_id' => $post['domain_id'],
                           'heading' => $post['heading'],
                           'heading_text' => $post['heading_text'],
                           'disclaimer' => $post['disclaimer'],
                       );
                       $update = $this->Dashboard_Model->common_update($id, $data, 'silver_section_4');
            
                       if ($update) {
                           $this->session->set_flashdata('success', 'Silver Membership Section Update successfully');
                           redirect('admin/silver-section-4');
                       } else {
                           redirect('admin/silver-section-4-update');
                       }
                   }else{   
                    $this->session->set_flashdata('message', 'You do not have permission to access this section.');
                        redirect('admin-dashboard');
                        return;
                        }
                }
                public function silverSection4Del($id)
                { 
                    if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('Our Services') && has_permission('silver membership') && has_permission('silver member section 4'))) {
			
                        $banker_del = $this->db->where('id', $id)->delete('silver_section_4');
                        if ($banker_del) {
                            $this->session->set_flashdata('success', 'Silver Membership Section deleted successfully');
                            redirect('admin/silver-section-4');
                        } else {
                            $this->session->set_flashdata('error', 'Something went wrong, try again!!');
                            redirect('admin/silver-section-4');
                        }
                    }else{
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            
        }
                }
 
  
    // Plantinum Banner

    public function plantinumBanner()
    {
        
        
        if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('Our Services') && has_permission('platinum membership') && has_permission('platinum banner'))) {
            if (isset($_GET['domain_id']) && (int)$_GET['domain_id']) {
                $data['plantinumBanner'] = $this->db->where('domain_id',$_GET['domain_id'])->get('plantinum_banner')->row_array();
            }else {
                $data['plantinumBanner'] = $this->db->where('domain_id', domain_id_get())->get('plantinum_banner')->row_array();
            }
            
    $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
            $this->load->view('admin/template/header');
            $this->load->view('admin/plantinum_banner/edit', $data);
            $this->load->view('admin/template/footer');
        }else{
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            
        }
      
    }

    public function plantinumBannerUpdate()
    {
         if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('Our Services') && has_permission('platinum membership') && has_permission('platinum banner'))) {
       
			
             $post = $this->input->post();
     
             // Upload configuration
             $config['upload_path'] = './assets/images/plantinumBanner';
             $config['allowed_types'] = 'jpg|jpeg|png|gif|bmp|tiff|jfif';
             $config['max_size'] = 2048;  // 2MB
             $config['encrypt_name'] = TRUE;  // Encrypt file name
     
             $this->upload->initialize($config);
     
             $upload_data = [];
     
             // Check if the image upload was successful
             if (!empty($_FILES['image']['name'])) {
                 if ($this->upload->do_upload('image')) {
                     $upload_data = $this->upload->data();
                 } else {
                     // Debugging the upload error
                     echo $this->upload->display_errors();
                     exit;
                 }
             }
             
     
             $data = array(
                 'title' => $post['title'],
                 'subtitle' => $post['subtitle'],
                 'text' => $post['text'],
                 'background_color' => $post['background_color'],
                 'domain_id' => $post['domain_id'],
                 'user_id' => $this->session->userdata('user_id'),
             );
     
             if (isset($upload_data['file_name'])) {
                 $data['image'] = $upload_data['file_name'];
             }
     
             // Check if the banner already exists
             $existingData = $this->db->where('domain_id', $post['domain_id'])->get('plantinum_banner')->row_array();
     
             if ($existingData) {
                 $id = $existingData['id'];
                 $update = $this->Dashboard_Model->common_update($id, $data, 'plantinum_banner');
             } else {
                 $insert = $this->Dashboard_Model->common_insert($data, 'plantinum_banner');
             }
     
             $this->session->set_flashdata('success', 'Plantinum Banner updated successfully');
             redirect('admin/plantinum-banner');
         }else{
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            
        }
    } 


        // Plantinum Section 1

        public function plantinumSection1()
        {
            if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('Our Services') && has_permission('platinum membership') && has_permission('platinum membership section 1'))) {
                
                $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
                        if (isset($_GET['domain_id']) && (int)$_GET['domain_id']) {
                            $data['plantinumSection1'] = $this->db->where('domain_id',$_GET['domain_id'])->get('plantinum_section_1')->row_array();
                        }else {
                            $data['plantinumSection1'] = $this->db->where('domain_id', domain_id_get())->get('plantinum_section_1')->row_array();
                        }
                
                            $this->load->view('admin/template/header');
                            $this->load->view('admin/plantinum_section_1/edit', $data);
                            $this->load->view('admin/template/footer');
            }else{
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            
        }
   
        }
    

        
        public function plantinumSection1Update()
{
    if (
        ($this->session->userdata('type') == 'admin') ||
        (has_permission('Pages') && has_permission('Our Services') && has_permission('platinum membership') && has_permission('platinum membership section 1'))
    ) {
        $post = $this->input->post();
        $step = isset($post['step']) ? (int)$post['step'] : 0;
        $domain_id = $post['domain_id'];

        // Prepare base update data per step
        $data = [
            'domain_id' => $domain_id,
            'user_id' => $this->session->userdata('user_id'),
        ];

        switch ($step) {
            case 1:
                $data['heading'] = $post['heading'];
                $data['text'] = $post['text'];
                $data['description'] = $post['description'];
                break;

            case 2:
                $data['previous_price'] = $post['previous_price'];
                $data['new_price'] = $post['new_price'];
                $data['card_name'] = $post['card_name'];
                $data['card_no'] = $post['card_no'];
                $data['validity'] = $post['validity'];
                $data['name'] = $post['name'];
                break;

            case 3:
                $data['card_plan'] = $post['card_plan'];
                $data['branch_card_plan'] = $post['branch_card_plan'];
                $data['customer_card_plan'] = $post['customer_card_plan'];
                $data['network_card_plan'] = $post['network_card_plan'];
                break;

            case 4:
                $data['free_card_plan'] = $post['free_card_plan'];
                $data['branch_free_card_plan'] = $post['branch_free_card_plan'];
                $data['customer_free_card_plan'] = $post['customer_free_card_plan'];
                $data['network_free_card_plan'] = $post['network_free_card_plan'];

                // Handle image upload
                $config['upload_path'] = './assets/images/plantinumBanner/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif|bmp|tiff|jfif|webp';
                $config['max_size'] = 2048;
                $config['encrypt_name'] = TRUE;
                $this->upload->initialize($config);

                if (!empty($_FILES['image']['name'])) {
                    if ($this->upload->do_upload('image')) {
                        $upload_data = $this->upload->data();
                        $data['image'] = $upload_data['file_name'];
                    } else {
                        $this->session->set_flashdata('error', $this->upload->display_errors());
                        redirect($_SERVER['HTTP_REFERER']);
                        return;
                    }
                }
                break;

            default:
                $this->session->set_flashdata('error', 'Invalid form step.');
                redirect($_SERVER['HTTP_REFERER']);
                return;
        }

        // Check if record exists for this domain
        $existingData = $this->db->where('domain_id', $domain_id)->get('plantinum_section_1')->row_array();

        if ($existingData) {
            $id = $existingData['id'];
            $this->Dashboard_Model->common_update($id, $data, 'plantinum_section_1');
        } else {
            $this->Dashboard_Model->common_insert($data, 'plantinum_section_1');
        }

        $this->session->set_flashdata('success', 'Platinum Membership Section updated successfully.');
        redirect('admin/plantinum-section-1');
    } else {
        $this->session->set_flashdata('message', 'You do not have permission to access this section.');
        redirect('admin-dashboard');
    }
}

        // Plantinum Section 2

        public function plantinumSection2()
        {
           if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('Our Services') && has_permission('platinum membership') && has_permission('platinum membership section 2'))) {
               $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
                       if (isset($_GET['domain_id']) && (int)$_GET['domain_id']) {
                           $data['plantinumSection1'] = $this->db->where('domain_id',$_GET['domain_id'])->get('plantinum_section_2')->row_array();
                       }else {
                           $data['plantinumSection1'] = $this->db->where('domain_id', domain_id_get())->get('plantinum_section_2')->row_array();
                       }
               
                           $this->load->view('admin/template/header');
                           $this->load->view('admin/plantinum_section_2/edit', $data);
                           $this->load->view('admin/template/footer');
			
            }else{
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return; 
            
        }
            
        
        }
    

        
        public function plantinumSection2Update()
        {
           if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('Our Services') && has_permission('platinum membership') && has_permission('platinum membership section 2'))) {
			
               $post = $this->input->post();
       
             
               
       
               $data = array(
                   'heading' => $post['heading'],
                   'text' => $post['text'],
                   'description_1' => $post['description_1'],
                   'description_2' => $post['description_2'],
                   'domain_id' => $post['domain_id'],
                   'user_id' => $this->session->userdata('user_id'),
               );
       
            
               $existingData = $this->db->where('domain_id', $post['domain_id'])->get('plantinum_section_2')->row_array();
       
               if ($existingData) {
                   $id = $existingData['id'];
                   $update = $this->Dashboard_Model->common_update($id, $data, 'plantinum_section_2');
               } else {
                   $insert = $this->Dashboard_Model->common_insert($data, 'plantinum_section_2');
               }
       
               $this->session->set_flashdata('success', 'Plantinum Membership Section updated successfully');
               redirect('admin/plantinum-section-2');
            }else{
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            
        }
        } 


        // plantinum  Section 3

        public function plantinumSection3()
        {
            if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('Our Services') && has_permission('platinum membership') && has_permission('platinum membership section 3'))) {
                $data['subAdmin'] = $this->db->where('user_id',$this->session->userdata('user_id'))->get('plantinum_section_3')->result_array();
                $this->load->view('admin/template/header');
                $this->load->view('admin/plantinum_section_3/list', $data);
                $this->load->view('admin/template/footer');
			
            }else{
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            
        }
          
        }
        public function plantinumSection3Add()
        {
           if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('Our Services') && has_permission('platinum membership') && has_permission('platinum membership section 3'))) {
               // $data['bank_data'] = $this->Dashboard_Model->bank_list();
               $data['datas'] = $this->db->get('plantinum_section_3')->row_array();
               $this->load->view('admin/template/header');
               $this->load->view('admin/plantinum_section_3/create',$data);
               $this->load->view('admin/template/footer');
			
           }else{
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            
        }
        }
        public function plantinumSection3Create()
        {
            if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('Our Services') && has_permission('platinum membership') && has_permission('platinum membership section 3'))) {
			
                $post = $this->input->post();
                // print_r($post);die;
                $data = array(
                    'title' => $post['title'],
                    'description' => $post['description'],
                    'icon' => $post['icon'],
                    'user_id' => $this->session->userdata('user_id'),
                );
                $insert = $this->Dashboard_Model->common_insert($data, 'plantinum_section_3');
        
              
        
            
        
                $data = array(
                    'heading' => $post['heading'],
                    'heading_text' => $post['heading_text'],
                );
                
                // Ensure you specify the table name and use it properly
                $this->db->update('plantinum_section_3', $data);
                
               
          
        
                if ($insert) {
                    $this->session->set_flashdata('success', 'Plantinum Membership Section has been Created Successfully!!');
                    redirect('admin/plantinum-section-3');
                } else {
                $this->session->set_flashdata('error', 'Something Went Wrong, try again!!');
                redirect('admin/plantinum-section-3-add');
                }
            }else{
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            
        }
    
        }
        public function plantinumSection3Edit($id)
        {
            if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('Our Services') && has_permission('platinum membership') && has_permission('platinum membership section 3'))) {
                $data['datas'] = $this->Dashboard_Model->common_row($id, 'plantinum_section_3');
                
                $this->load->view('admin/template/header');
                $this->load->view('admin/plantinum_section_3/edit', $data);
                $this->load->view('admin/template/footer');
			
            }else{
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            
        }
        }
    
        public function plantinumSection3Update()
        {
            if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('Our Services') && has_permission('platinum membership') && has_permission('platinum membership section 3'))) {
			
                // $id = $this->input->post('id');
                $post = $this->input->post();
                $id = $post['id'];
                unset($post['id']);
                $data = array(
                    'title' => $post['title'],
                    'description' => $post['description'],
                    'icon' => $post['icon'],
                    'user_id' => $this->session->userdata('user_id'),
                );
                $update = $this->Dashboard_Model->common_update($id, $data, 'plantinum_section_3');
    
                $data = array(
                    'heading' => $post['heading'],
                    'heading_text' => $post['heading_text'],
                );
                
                // Ensure you specify the table name and use it properly
                $this->db->update('plantinum_section_3', $data);
                
                
                if ($update) {
                    $this->session->set_flashdata('success', 'Plantinum Membership Section Update successfully');
                    redirect('admin/plantinum-section-3');
                } else {
                    redirect('admin/plantinum-section-3-update');
                }
            }else{
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            
        }
        }
        public function plantinumSection3Del($id)
        { 
            if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('Our Services') && has_permission('platinum membership') && has_permission('platinum membership section 3'))) {
                $banker_del = $this->db->where('id', $id)->delete('plantinum_section_3');
                if ($banker_del) {
                    $this->session->set_flashdata('success', 'Our Story deleted successfully');
                    redirect('admin/plantinum-section-3');
                } else {
                    $this->session->set_flashdata('error', 'Something went wrong, try again!!');
                    redirect('admin/plantinum-section-3');
                }
			
            }else{
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            
        }
        }



                // plantinum Section 4

                public function plantinumSection4()
                {
                    if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('Our Services') && has_permission('platinum membership') && has_permission('platinum membership section 4'))) {
                        $data['subAdmin'] = $this->db->where('user_id',$this->session->userdata('user_id'))->get('plantinum_section_4')->result_array();
                        $this->load->view('admin/template/header');
                        $this->load->view('admin/plantinum_section_4/list', $data);
                        $this->load->view('admin/template/footer');
                        
            }else{
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            
        }
                  
                }
                public function plantinumSection4Add()
                {
                    if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('Our Services') && has_permission('platinum membership') && has_permission('platinum membership section 4'))) {
			
                        // $data['bank_data'] = $this->Dashboard_Model->bank_list();
                        $data['datas'] = $this->db->get('plantinum_section_4')->row_array();
                        $this->load->view('admin/template/header');
                        $this->load->view('admin/plantinum_section_4/create',$data);
                        $this->load->view('admin/template/footer');
            }else{
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            
        }
                }
                public function plantinumSection4Create()
                {
                    if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('Our Services') && has_permission('platinum membership') && has_permission('platinum membership section 4'))) {
                        $post = $this->input->post();
                        // print_r($post);die;
                        $data = array(
                            'title' => $post['title'],
                            'description' => $post['description'],
                            'user_id' => $this->session->userdata('user_id'),
                        );
                        $insert = $this->Dashboard_Model->common_insert($data, 'plantinum_section_4');
            
                      
            
                    
            
                        $data = array(
                            'heading' => $post['heading'],
                            'heading_text' => $post['heading_text'],
                            'disclaimer' => $post['disclaimer'],
                        );
                        
                        // Ensure you specify the table name and use it properly
                        $this->db->update('plantinum_section_4', $data);
                        
                       
                  
                
                        if ($insert) {
                            $this->session->set_flashdata('success', 'Plantinum Membership Section has been Created Successfully!!');
                            redirect('admin/plantinum-section-4');
                        } else {
                        $this->session->set_flashdata('error', 'Something Went Wrong, try again!!');
                        redirect('admin/plantinum-section-4-add');
                    }
                        }else{
                        $this->session->set_flashdata('message', 'You do not have permission to access this section.');
                        redirect('admin-dashboard');
                        return;
                        }
            
                }
                public function plantinumSection4Edit($id)
                {
                    if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('Our Services') && has_permission('platinum membership') && has_permission('platinum membership section 4'))) {
			
                        $data['datas'] = $this->Dashboard_Model->common_row($id, 'plantinum_section_4');
                        
                        $this->load->view('admin/template/header');
                        $this->load->view('admin/plantinum_section_4/edit', $data);
                        $this->load->view('admin/template/footer');
            }else{
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            
        }
                }
            
                public function plantinumSection4Update()
                {
                    if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('Our Services') && has_permission('platinum membership') && has_permission('platinum membership section 4'))) {
                        // $id = $this->input->post('id');
                        $post = $this->input->post();
                        $id = $post['id'];
                        unset($post['id']);
                        $data = array(
                            'title' => $post['title'],
                            'description' => $post['description'],
                            'user_id' => $this->session->userdata('user_id'),
                        );
                        $update = $this->Dashboard_Model->common_update($id, $data, 'plantinum_section_4');
            
                        $data = array(
                            'heading' => $post['heading'],
                            'heading_text' => $post['heading_text'],
                            'disclaimer' => $post['disclaimer'],
                        );
                        
                        // Ensure you specify the table name and use it properly
                        $this->db->update('plantinum_section_4', $data);
                        
                        
                        if ($update) {
                            $this->session->set_flashdata('success', 'Plantinum Membership Section Update successfully');
                            redirect('admin/plantinum-section-4');
                        } else {
                            redirect('admin/plantinum-section-4-update');
                        }
                        }else{
                        $this->session->set_flashdata('message', 'You do not have permission to access this section.');
                        redirect('admin-dashboard');
                        return;
                        }
                }
                public function plantinumSection4Del($id)
                { 
                    if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('Our Services') && has_permission('platinum membership') && has_permission('platinum membership section 4'))) {
                        $banker_del = $this->db->where('id', $id)->delete('plantinum_section_4');
                        if ($banker_del) {
                            $this->session->set_flashdata('success', 'Plantinum Membership Section deleted successfully');
                            redirect('admin/plantinum-section-4');
                        } else {
                            $this->session->set_flashdata('error', 'Something went wrong, try again!!');
                            redirect('admin/plantinum-section-4');
                        }
			
            }else{
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            
        }
                }

                
                
    // Buy Now Banner

    public function buynowBanner()
    {
        if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('buy now') && has_permission('buy now banner'))) {
		           
            if (isset($_GET['domain_id']) && (int)$_GET['domain_id']) {
                $data['buynowBanner'] = $this->db->where('domain_id',$_GET['domain_id'])->get('buynow_banner')->row_array();
            }else {
                $data['buynowBanner'] = $this->db->where('domain_id', domain_id_get())->get('buynow_banner')->row_array();
            }
            $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
            $this->load->view('admin/template/header');
            $this->load->view('admin/buynow_banner/edit', $data);
            $this->load->view('admin/template/footer');
        }else{
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
        }
    }

    public function buynowBannerUpdate()
    {
        if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('buy now') && has_permission('buy now banner'))) {
		
        $post = $this->input->post();
        

        $data = array(
            'title' => $post['title'],
            'description' => $post['description'],
            'text' => $post['text'],
            'background_color' => $post['background_color'],
            'user_id' => $this->session->userdata('user_id'),
            'domain_id' => $post['domain_id'],
        );

        // Check if the banner already exists
        $existingData = $this->db->where('domain_id' , $post['domain_id'])->get('buynow_banner')->row_array();

        if ($existingData) {
            $id = $existingData['id'];
            $update = $this->Dashboard_Model->common_update($id, $data, 'buynow_banner');
        } else {
            $insert = $this->Dashboard_Model->common_insert($data, 'buynow_banner');
        }

        $this->session->set_flashdata('success', 'Buy Now Banner updated successfully');
        redirect('admin/buynow-banner');
     }else{
        
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            }
    } 


    
        // Buy Now Section
 

        public function buynowSection()
        {
           if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('buy now') && has_permission('buy now section'))) {
		
            
            if (isset($_GET['domain_id']) && (int)$_GET['domain_id']) {
                $data['buynowSection'] = $this->db->where('domain_id',$_GET['domain_id'])->get('buynow_section')->row_array();
            }else {
                $data['buynowSection'] = $this->db->where('domain_id', domain_id_get())->get('buynow_section')->row_array();
            }
             $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
            $this->load->view('admin/template/header');
            $this->load->view('admin/buynow_section/edit', $data);
            $this->load->view('admin/template/footer');
        }else{
            
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            }
        } 
                
        public function buynowSectionUpdate()
        {
            if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('buy now') && has_permission('buy now section'))) {
		
            $post = $this->input->post();

            $data = array(
                'title' => $post['title'],
                'text' => $post['text'],
                'domain_id' => $post['domain_id'],
                'user_id' => $this->session->userdata('user_id'),
            );
    
         
            $existingData = $this->db->where( 'domain_id' ,$post['domain_id'])->get('buynow_section')->row_array();
    
            if ($existingData) {
                $id = $existingData['id'];
                $update = $this->Dashboard_Model->common_update($id, $data, 'buynow_section');
            } else {
                $insert = $this->Dashboard_Model->common_insert($data, 'buynow_section');
            }
    
            $this->session->set_flashdata('success', 'Buy Now Section updated successfully');
            redirect('admin/buynow-section');
            }else{

            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            }
        }


        // Buy Now Section 1

        
        public function buynowSection1()
        {
            if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('buy now') && has_permission('buy now section 1'))) {
		
                if (isset($_GET['domain_id']) && (int)$_GET['domain_id']) {
                    $data['buynowSection1'] = $this->db->where('domain_id',$_GET['domain_id'])->get('buynow_section_1')->row_array();
                }else {
                    $data['buynowSection1'] = $this->db->where('domain_id', domain_id_get())->get('buynow_section_1')->row_array();
                }
                $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
                
                $this->load->view('admin/template/header');
                $this->load->view('admin/buynow_section_1/edit', $data);
                $this->load->view('admin/template/footer');
               }else{ 
                                $this->session->set_flashdata('message', 'You do not have permission to access this section.');
                                redirect('admin-dashboard');
                                return;
                                }
        }
    

        
        public function buynowSection1Update()
        {
            if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('buy now') && has_permission('buy now section 1'))) {
		

            $post = $this->input->post();
            
    
            $data = array(
                'heading' => $post['heading'],
                'description' => $post['description'],
                'description_1' => $post['description_1'],
                'description_2' => $post['description_2'],
                'contact_us' => $post['contact_us'],
                'contact_title' => $post['contact_title'],
                'contact_address' => $post['contact_address'],
                'contact_time' => $post['contact_time'],
                'domain_id' => $post['domain_id'],
                'user_id' => $this->session->userdata('user_id'),
            );
    
         
            $existingData = $this->db->where('domain_id', $post['domain_id'])->get('buynow_section_1')->row_array();
    
            if ($existingData) {
                $id = $existingData['id'];
                $update = $this->Dashboard_Model->common_update($id, $data, 'buynow_section_1');
            } else {
                $insert = $this->Dashboard_Model->common_insert($data, 'buynow_section_1');
            }
    
            $this->session->set_flashdata('success', 'Buy Now Section updated successfully');
            redirect('admin/buynow-section-1');
            }else{
                
                $this->session->set_flashdata('message', 'You do not have permission to access this section.');
                redirect('admin-dashboard');
                return;
                }
        } 



        // Our Section 2

        public function buynowSection2()
        {
            if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('buy now') && has_permission('buy now section 2'))) {
            if (isset($_GET['domain_id']) && (int)$_GET['domain_id']) {
                $data['buynowSection2'] = $this->db->where('domain_id',$_GET['domain_id'])->get('buynow_section_2')->row_array();
            }else {
                $data['buynowSection2'] = $this->db->where('domain_id', domain_id_get())->get('buynow_section_2')->row_array();
            }
            $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
                $this->load->view('admin/template/header');
                $this->load->view('admin/buynow_section_2/edit', $data);
                $this->load->view('admin/template/footer');
            }else{
                $this->session->set_flashdata('message', 'You do not have permission to access this section.');
                redirect('admin-dashboard');
                return;
            }
        }
    

        
        public function buynowSection2Update()
        {
            if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('buy now') && has_permission('buy now section 2 '))) {
		
                $post = $this->input->post();
                
                
                $data = array(
                'heading' => $post['heading'],
                'text1' => $post['text1'],
                'description_1' => $post['description_1'],
                'text2' => $post['text2'],
                'description_2' => $post['description_2'],
                'text3' => $post['text3'],
                'description_3' => $post['description_3'],
                'text4' => $post['text4'],
                'description_4' => $post['description_4'],
                'text5' => $post['text5'],
                'description_5' => $post['description_5'],
                'text6' => $post['text6'],
                'description_6' => $post['description_6'],
                'domain_id' => $post['domain_id'],
                'user_id' => $this->session->userdata('user_id'),
            );
    
         
            $existingData = $this->db->where('domain_id',$post['domain_id'])->get('buynow_section_2')->row_array();
    
            if ($existingData) {
                $id = $existingData['id'];
                $update = $this->Dashboard_Model->common_update($id, $data, 'buynow_section_2');
            } else {
                $insert = $this->Dashboard_Model->common_insert($data, 'buynow_section_2');
            }
            
            $this->session->set_flashdata('success', 'Buy Now Section updated successfully');
            redirect('admin/buynow-section-2');
        }else{
                            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
                            redirect('admin-dashboard');
                            return;
                            }
        }



                // Our Section 4

                public function bannerSlider()
                {
                    if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('buy now') && has_permission('banner slider'))) {
		
                $domain_id = domain_id_get();
                    
                    $data['smartChoice'] = $this->db->where(array('domain_id' => $domain_id))->get('banner_slider')->result_array();
                    
                    $this->load->view('admin/template/header');
                    $this->load->view('admin/banner_slider/list', $data);
                    $this->load->view('admin/template/footer');
                }else {
                    
                        $this->session->set_flashdata('message', 'You do not have permission to access this section.');
                        redirect('admin-dashboard');
                        return;
                        
                }
                }

                public function bannerSliderAdd()
                {
                    if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('buy now') && has_permission('banner slider'))) {
		

                    // $data['bank_data'] = $this->Dashboard_Model->bank_list();
                    $data['datas'] = $this->db->get('banner_slider')->row_array();
                    $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();

                    $this->load->view('admin/template/header');
                    $this->load->view('admin/banner_slider/create',$data);
                    $this->load->view('admin/template/footer');
                    }else {
                        
                        $this->session->set_flashdata('message', 'You do not have permission to access this section.');
                        redirect('admin-dashboard');
                        return;
                        
                    }
                }
                public function bannerSliderCreate()
                {
                    if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('buy now') && has_permission('banner slider'))) {
		
                    // Upload configuration
                    $config['upload_path'] = './assets/images/banner_slider';
                    $config['allowed_types'] = 'jpg|jpeg|png|gif|bmp|tiff|jfif';
                    $config['max_size'] = 2048;  // 2MB
                    $config['encrypt_name'] = TRUE;  
                
                    $this->upload->initialize($config);
                
                    if ($this->upload->do_upload('image')) {
                        $upload_data = $this->upload->data();
                
                        $data = array(
                            'image' => $upload_data['file_name'],
                            'domain_id' => $this->input->post('domain_id'),
                            'user_id' => $this->session->userdata('user_id'),
                        );
                
                        // Insert into database
                        $insert = $this->Dashboard_Model->common_insert($data, 'banner_slider');
                
                        if ($insert) {
                            $this->session->set_flashdata('success', 'Banner Slider has been Created Successfully!');
                            redirect('admin/banner-slider');
                        } else {
                            $this->session->set_flashdata('error', 'Something Went Wrong, try again!');
                            redirect('admin/banner-slider-add');
                        }
                    } else {
                        echo $this->upload->display_errors();
                        die();
                    }
                }else{
                    

                        $this->session->set_flashdata('message', 'You do not have permission to access this section.');
                        redirect('admin-dashboard');
                        return;
                        
                }
                }
                
                
                
                public function bannerSliderEdit($id)
                {
                    if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('buy now') && has_permission('banner slider'))) {
		

                    $data['datas'] = $this->Dashboard_Model->common_row($id, 'banner_slider');
                    $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
                    
                    $this->load->view('admin/template/header');
                    $this->load->view('admin/banner_slider/edit', $data);
                    $this->load->view('admin/template/footer');
                    }else {
                        
                        $this->session->set_flashdata('message', 'You do not have permission to access this section.');
                        redirect('admin-dashboard');
                        return;
                        
                    }
                }
            
                public function bannerSliderUpdate()
                {
                    if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('buy now') && has_permission('banner slider'))) {
		
                    $post = $this->input->post();
                    $id = $post['id'];
                    unset($post['id']);
                
                    // Get the existing record and convert to array
                    $existing = $this->Dashboard_Model->common_row($id, 'banner_slider');
                    if (!empty($existing)) {
                        $existing = (array) $existing;  // Convert object to array
                    }
                
                    // Upload configuration
                    $config['upload_path'] = './assets/images/banner_slider';
                    $config['allowed_types'] = 'jpg|jpeg|png|gif|bmp|tiff|jfif';
                    $config['max_size'] = 16384;  // 16MB
                    $config['encrypt_name'] = TRUE;
                
                    $this->upload->initialize($config);
                
                    // Check if a new image is uploaded
                    if ($this->upload->do_upload('image')) {
                        $upload_data = $this->upload->data();
                        $post['image'] = $upload_data['file_name'];
                
                        // Delete old image
                        if (!empty($existing['image']) && file_exists('./assets/images/banner_slider/' . $existing['image'])) {
                            unlink('./assets/images/banner_slider/' . $existing['image']);
                        }
                    } else {
                        // Keep the existing image if no new image is uploaded
                        $post['image'] = $existing['image'];
                    }
                
                    $post['user_id'] = $this->session->userdata('user_id');
                    $post['domain_id'] =  $post['domain_id'];
                
                    // Update database
                    $update = $this->Dashboard_Model->common_update($id, $post, 'banner_slider');
                
                    if ($update) {
                        $this->session->set_flashdata('success', 'Banner Slider updated successfully');
                        redirect('admin/banner-slider');
                    } else {
                        $this->session->set_flashdata('error', 'Something Went Wrong, try again!');
                        redirect('admin/banner-slider-edit/'.$id);
                    }
                }else{
                    
                        $this->session->set_flashdata('message', 'You do not have permission to access this section.');
                        redirect('admin-dashboard');
                        return;
                        
                }
                }
                
                public function bannerSliderDel($id)
                { 
                    if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('buy now') && has_permission('buy now banner'))) {
		
                    $banker_del = $this->db->where('id', $id)->delete('banner_slider');
                    if ($banker_del) {
                        $this->session->set_flashdata('success', 'Banner Slider deleted successfully');
                        redirect('admin/banner-slider');
                    } else {
                        $this->session->set_flashdata('error', 'Something went wrong, try again!!');
                        redirect('admin/banner-slider');
                    }
                }else{
                    

                        $this->session->set_flashdata('message', 'You do not have permission to access this section.');
                        redirect('admin-dashboard');
                        return;
                        
                }
                }


                
    // Blog Section

    public function blogSection()
    {
        
        $data['blogSection'] = $this->db->where('user_id',$this->session->userdata('user_id'))->get('blog_section')->row_array();
        
        $this->load->view('admin/template/header');
        $this->load->view('admin/blog_section/edit', $data);
        $this->load->view('admin/template/footer');
    }

    public function blogSectionUpdate()
    {
        $post = $this->input->post();

        // Upload configuration
        $config['upload_path'] = './assets/images/blogSection';
        $config['allowed_types'] = 'jpg|jpeg|png|gif|bmp|tiff|jfif';
        $config['max_size'] = 2048;  // 2MB
        $config['encrypt_name'] = TRUE;  // Encrypt file name

        $this->upload->initialize($config);

        $upload_data = [];

        // Check if the image upload was successful
        if (!empty($_FILES['image']['name'])) {
            if ($this->upload->do_upload('image')) {
                $upload_data = $this->upload->data();
            } else {
                // Debugging the upload error
                echo $this->upload->display_errors();
                exit;
            }
        }
        

        $data = array(
            'heading' => $post['heading'],
            'title' => $post['title'],
            'text' => $post['text'],
            'user_id' => $this->session->userdata('user_id'),
        );

        if (isset($upload_data['file_name'])) {
            $data['image'] = $upload_data['file_name'];
        }

        // Check if the banner already exists
        $existingData = $this->db->where('user_id', $this->session->userdata('user_id'))->get('blog_section')->row_array();

        if ($existingData) {
            $id = $existingData['id'];
            $update = $this->Dashboard_Model->common_update($id, $data, 'blog_section');
        } else {
            $insert = $this->Dashboard_Model->common_insert($data, 'blog_section');
        }

        $this->session->set_flashdata('success', 'Blog Section updated successfully');
        redirect('admin/blog-section');
    }

    
    // Document Section

    public function documentSection()
    {
        
        $data['documentSection'] = $this->db->where('user_id',$this->session->userdata('user_id'))->get('document_section')->row_array();
        
        $this->load->view('admin/template/header');
        $this->load->view('admin/document_section/edit', $data);
        $this->load->view('admin/template/footer');
    }

    public function documentSectionUpdate()
    {
        $post = $this->input->post();
        $session_user_id = $this->session->userdata('user_id');

    // If user_id is incorrect, fetch it from user_master
    if ($session_user_id == 1) {
        $user = $this->db->where('username', $this->session->userdata('user_name'))->get('user_master')->row_array();
        if (!empty($user)) {
            $session_user_id = $user['id'];
            $this->session->set_userdata('user_id', $session_user_id);
        }
    }

        // Upload configuration
        $config['upload_path'] = './assets/images/documentSection';
        $config['allowed_types'] = 'jpg|jpeg|png|gif|bmp|tiff|jfif';
        $config['max_size'] = 2048;  // 2MB
        $config['encrypt_name'] = TRUE;  // Encrypt file name

        $this->upload->initialize($config);

        $upload_data = [];

        // Check if the image upload was successful
        if (!empty($_FILES['image']['name'])) {
            if ($this->upload->do_upload('image')) {
                $upload_data = $this->upload->data();
            } else {
                // Debugging the upload error
                echo $this->upload->display_errors();
                exit;
            }
        }
        

        $data = array(
            'user_id' => $session_user_id,
        );

        if (isset($upload_data['file_name'])) {
            $data['image'] = $upload_data['file_name'];
        }

        // Check if the banner already exists
        $existingData = $this->db->where('user_id', $session_user_id)->get('document_section')->row_array();

        if ($existingData) {
            $id = $existingData['id'];
            $update = $this->Dashboard_Model->common_update($id, $data, 'document_section');
        } else {
            $insert = $this->Dashboard_Model->common_insert($data, 'document_section');
        }

        $this->session->set_flashdata('success', 'Document Section updated successfully');
        redirect('admin/document-section');
    }


    
    //Branch Document Section

    public function joiningLetter()
    {
        if (!has_permission('Pages')) {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            }
 
            if (isset($_GET['domain_id']) && (int)$_GET['domain_id']) {
                    $data['joiningLetter'] = $this->db->where('domain_id',$_GET['domain_id'])->get('joining_letter')->row_array();
                }else {
                    $data['joiningLetter'] = $this->db->where('domain_id', domain_id_get())->get('joining_letter')->row_array();
                }
                    // print_r($data['joiningLetter']);die;
                $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
                            

        $this->load->view('admin/template/header');
        $this->load->view('admin/joining_letter/edit', $data);
        $this->load->view('admin/template/footer');
    }

    public function joiningLetterUpdate()
    {
        if (!has_permission('Pages')) {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            }
        $post = $this->input->post();
    
        // Upload configuration
        $config['upload_path'] = './assets/images/joiningLetter';
        $config['allowed_types'] = 'jpg|jpeg|png|gif|bmp|tiff|jfif';
        $config['max_size'] = 2048; // 2MB
        $config['encrypt_name'] = TRUE; // Encrypt file name
    
        $this->load->library('upload'); // Ensure upload library is loaded
    
        $upload_data = [];
    
        // Process 'image' file upload
        if (!empty($_FILES['image']['name'])) {
            $this->upload->initialize($config);
            if ($this->upload->do_upload('image')) {
                $upload_data['image'] = $this->upload->data('file_name');
            } else {
                $this->session->set_flashdata('error', 'Image Upload Error: ' . $this->upload->display_errors());
                redirect('admin/joining-letter-section');
                return;
            }
        }
    
        // Process 'ceal' file upload
        if (!empty($_FILES['ceal']['name'])) {
            $this->upload->initialize($config);
            if ($this->upload->do_upload('ceal')) {
                $upload_data['ceal'] = $this->upload->data('file_name');
            } else {
                $this->session->set_flashdata('error', 'Ceal Upload Error: ' . $this->upload->display_errors());
                redirect('admin/joining-letter-section');
                return;
            }
        }
    
        // Data to update
        $data = [
            // 'description' => $post['description'],
            'user_id' => $this->session->userdata('user_id'),
            'domain_id' => $post['domain_id'],
        ];
    
        if (!empty($upload_data['image'])) {
            $data['image'] = $upload_data['image'];
        }
    
        if (!empty($upload_data['ceal'])) {
            $data['ceal'] = $upload_data['ceal'];
        }
    
        // Check if the record already exists
        $existingData = $this->db->where('domain_id', $post['domain_id'])->get('joining_letter')->row_array();
        if ($existingData) {
            $id = $existingData['id'];
            $this->Dashboard_Model->common_update($id, $data, 'joining_letter');
        } else {
            $this->Dashboard_Model->common_insert($data, 'joining_letter');
        }
    
        $this->session->set_flashdata('success', 'Joining Letter updated successfully');
        redirect('admin/joining-letter-section');
    }


    
    public function joiningBanner()
    {
        if (!has_permission('Pages') && $this->session->userdata('role') == 3) {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            }
                    

        if (isset($_GET['domain_id']) && (int)$_GET['domain_id']) {
            $data['joiningBanner'] = $this->db->where('domain_id',$_GET['domain_id'])->get('joining_banner')->row_array();
        }else {
            $data['joiningBanner'] = $this->db->where('domain_id', domain_id_get())->get('joining_banner')->row_array();
        }
            // print_r($data['datas']);die;
        $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
        

        if (empty($data['joiningBanner'])) {
            $data['joiningBanner'] = [
                'id' => '',
                'title' => '',
                'sub_title' => '',
                'text_color' => '',
                'first_image' => '',
                'second_image' => ''
            ];
        }
        
        $this->load->view('admin/template/header');
        $this->load->view('admin/joining_banner/edit', $data);
        $this->load->view('admin/template/footer');
    }

   
    public function joiningBannerUpdate()
    {
        if (!has_permission('Pages')) {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            }
        $post = $this->input->post();
    
        // Upload configuration
        $config['upload_path'] = './assets/images/joiningBanner';
        $config['allowed_types'] = 'jpg|jpeg|png|gif|bmp|tiff|jfif';
        $config['max_size'] = 2048; // 2MB
        $config['encrypt_name'] = TRUE; // Encrypt file name
    
        $this->load->library('upload'); // Ensure upload library is loaded
    
        $upload_data = [];
    
        // Process 'image' file upload
        if (!empty($_FILES['first_image']['name'])) {
            $this->upload->initialize($config);
            if ($this->upload->do_upload('first_image')) {
                $upload_data['first_image'] = $this->upload->data('file_name');
            } else {
                $this->session->set_flashdata('error', 'First Image Upload Error: ' . $this->upload->display_errors());
                redirect('admin/joining-banner');
                return;
            }
        }
    
        // Process 'second image' file upload
        if (!empty($_FILES['second_image']['name'])) {
            $this->upload->initialize($config);
            if ($this->upload->do_upload('second_image')) {
                $upload_data['second_image'] = $this->upload->data('file_name');
            } else {
                $this->session->set_flashdata('error', 'Second Image Upload Error: ' . $this->upload->display_errors());
                redirect('admin/joining-banner');
                return;
            }
        }
    
        // Data to update
        $data = [
            'user_id' => $this->session->userdata('user_id'),
            'title'      => $post['title'],
            'sub_title'  => $post['sub_title'],
            'domain_id'  => $post['domain_id'],
            'text_color' => $post['text_color'],
            'domain_id' => $post['domain_id'],
        ];
    
        if (!empty($upload_data['first_image'])) {
            $data['first_image'] = $upload_data['first_image'];
        }
    
        if (!empty($upload_data['second_image'])) {
            $data['second_image'] = $upload_data['second_image'];
        }
    
        // Check if the record already exists
        $existingData = $this->db->where('domain_id', $post['domain_id'])
                                 ->get('joining_banner')
                                 ->row_array();
    
        if ($existingData) {
            $id = $existingData['id'];
            $this->Dashboard_Model->common_update($id, $data, 'joining_banner');
        } else {
            $this->Dashboard_Model->common_insert($data, 'joining_banner');
        }
    
        $this->session->set_flashdata('success', 'Joining Banner updated successfully');
        redirect('admin/joining-banner');
    }

    
    public function joiningCertificate()
    {
        if (!has_permission('Pages')) {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            }
        
    
$domain_id = domain_id_get();

if (isset($_GET['domain_id']) && (int)$_GET['domain_id']) {
    $data['joiningCertificate'] = $this->db->where('domain_id',$_GET['domain_id'])->get('joining_certificate')->row_array();
}else {
    $data['joiningCertificate'] = $this->db->where('domain_id', $domain_id)->get('joining_certificate')->row_array();
}
    // print_r($data['joiningCertificate']);die;
$data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
    


        if (empty($data['joiningCertificate'])) {
            $data['joiningCertificate'] = [
                'id' => '',
                'title' => '',
                'sub_title' => '',
                'sub_title_branch' => '',
                'text_color' => '',
                'image' => ''
            ];
        }
        
        $this->load->view('admin/template/header');
        $this->load->view('admin/joining_certificate/edit', $data);
        $this->load->view('admin/template/footer');
    }

    public function joiningCertificateUpdate()
    {
        if (!has_permission('Pages')) {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            }
        $post = $this->input->post();
        
        $domain_id = $post['domain_id'];
        $session_user_id = $this->session->userdata('user_id');

        // If user_id is incorrect, fetch it from user_master
        if ($session_user_id == 1) {
            $user = $this->db->where('domain_id', $domain_id)->get('user_master')->row_array();
            if (!empty($user)) {
                $session_user_id = $user['id'];
                $this->session->set_userdata('user_id', $session_user_id);
            }
        }

        // Upload configuration
        $config['upload_path'] = './assets/images/joiningCertificate';
        $config['allowed_types'] = 'jpg|jpeg|png|gif|bmp|tiff|jfif|webp';
        $config['max_size'] = 2048; // 2MB
        $config['encrypt_name'] = TRUE;
$config['detect_mime'] = TRUE; // Or FALSE for testing only // Encrypt file name
    
        $this->load->library('upload'); // Ensure upload library is loaded
    
        $upload_data = [];
    
        // Process 'image' file upload
        if (!empty($_FILES['image']['name'])) {
            $this->upload->initialize($config);
            if ($this->upload->do_upload('image')) {
                $upload_data['image'] = $this->upload->data('file_name');
            } else {
                $this->session->set_flashdata('error', 'Image Upload Error: ' . $this->upload->display_errors());
                redirect('admin/certificate');
                return;
            }
        }
    
        // Data to update   
        $data = [
            'title' => $post['title'],
            'sub_title' => $post['sub_title'],
            'sub_title_branch' => $post['sub_title_branch'],
            'text_color' => $post['text_color'],
            'domain_id' => $post['domain_id'],
            'user_id' => $session_user_id,
        ];

        if (!empty($upload_data['image'])) {
            $data['image'] = $upload_data['image'];
        }
    
        // Check if the record already exists
        $existingData = $this->db->where('domain_id', $domain_id)
                                 ->get('joining_certificate')
                                 ->row_array();
    
        if ($existingData) {
            $id = $existingData['id'];
            $this->Dashboard_Model->common_update($id, $data, 'joining_certificate');
        } else {
            $this->Dashboard_Model->common_insert($data, 'joining_certificate');
        }
    
        $this->session->set_flashdata('success', 'Certificate updated successfully');
        redirect('admin/certificate');
    }


    public function visitingCard()
    {
        if (!has_permission('Pages')) {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            }

 $domain_id = domain_id_get();

            if (isset($_GET['domain_id']) && (int)$_GET['domain_id']) {
                $data['visitingCard'] = $this->db->where('domain_id',$_GET['domain_id'])->get('visiting_card')->row_array();
            }else {
                $data['visitingCard'] = $this->db->where('domain_id', $domain_id)->get('visiting_card')->row_array();
            }
                // print_r($data['visitingCard']);die;
            $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
                        
        if (empty($data['visitingCard'])) {
            $data['visitingCard'] = [
                'id' => '',
                'background_color' => '',
                // 'image' => '',
                'top_background_color' => '',
                'text_color' => ''
            ];
        }
        
        $this->load->view('admin/template/header');
        $this->load->view('admin/visiting_card/edit', $data);
        $this->load->view('admin/template/footer');
    }

    public function visitingCardUpdate()
    {
        if (!has_permission('Pages')) {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            }
        $post = $this->input->post();

        // $config['upload_path'] = './assets/images/visitingCard';
        // $config['allowed_types'] = 'jpg|jpeg|png|gif|bmp|tiff|jfif';
        // $config['max_size'] = 2048;
        // $config['encrypt_name'] = TRUE;

        // $this->upload->initialize($config);

        // $upload_data = [];

        // if (!empty($_FILES['image']['name'])) {
        //     if ($this->upload->do_upload('image')) {
        //         $upload_data = $this->upload->data();
        //     } else {
        //         echo $this->upload->display_errors();
        //         exit;
        //     }
        // }
    
        // Data to update
        $data = [
            'background_color' => $post['background_color'],
            'text_color' => $post['text_color'],
            'top_background_color' => $post['top_background_color'],
            'domain_id' => $post['domain_id'],
            'user_id' => $this->session->userdata('user_id'),
        ];

        // if (isset($upload_data['file_name'])) {
        //     $data['image'] = $upload_data['file_name'];
        // }
    
        // Check if the record already exists
        $existingData = $this->db->where('domain_id', $post['domain_id'])
                                 ->get('visiting_card')
                                 ->row_array();
    
        if ($existingData) {
            $id = $existingData['id'];
            $this->Dashboard_Model->common_update($id, $data, 'visiting_card');
        } else {
            $this->Dashboard_Model->common_insert($data, 'visiting_card');
        }
    
        $this->session->set_flashdata('success', 'Visiting Card updated successfully');
        redirect('admin/visiting-card');
    }

    
    public function idCard()
    {
        if (!has_permission('Pages')) {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            }
        

            if (isset($_GET['domain_id']) && (int)$_GET['domain_id']) {
                $data['idCard'] = $this->db->where('domain_id',$_GET['domain_id'])->get('id_card')->row_array();
            }else {
                $data['idCard'] = $this->db->where('domain_id', domain_id_get())->get('id_card')->row_array();
            }
                // print_r($data['idCard']);die;
            $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
                        

        if (empty($data['idCard'])) {
            $data['idCard'] = [
                'id' => '',
                'background_color' => '',
                'background_color_2' => '',
                // 'image' => '',
                'side_background_color' => '',
                'text_color' => ''
            ];
        }
        
        $this->load->view('admin/template/header');
        $this->load->view('admin/id_card/edit', $data);
        $this->load->view('admin/template/footer');
    }

    public function idCardUpdate()
    {
        if (!has_permission('Pages')) {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            }
        $post = $this->input->post();

        // $config['upload_path'] = './assets/images/idCard';
        // $config['allowed_types'] = 'jpg|jpeg|png|gif|bmp|tiff|jfif';
        // $config['max_size'] = 2048;
        // $config['encrypt_name'] = TRUE;

        // $this->upload->initialize($config);

        // $upload_data = [];

        // if (!empty($_FILES['image']['name'])) {
        //     if ($this->upload->do_upload('image')) {
        //         $upload_data = $this->upload->data();
        //     } else {
        //         echo $this->upload->display_errors();
        //         exit;
        //     }
        // }
    
        // Data to update
        $data = [
            'background_color' => $post['background_color'],
            'background_color_2' => $post['background_color_2'],
            'side_background_color' => $post['side_background_color'],
            'text_color' => $post['text_color'],
            'domain_id' => $post['domain_id'],
            'user_id' => $this->session->userdata('user_id'),
        ];

        // if (isset($upload_data['file_name'])) {
        //     $data['image'] = $upload_data['file_name'];
        // }
    
        // Check if the record already exists
        $existingData = $this->db->where('domain_id', $post['domain_id'])
                                 ->get('id_card')
                                 ->row_array();
    
        if ($existingData) {
            $id = $existingData['id'];
            $this->Dashboard_Model->common_update($id, $data, 'id_card');
        } else {
            $this->Dashboard_Model->common_insert($data, 'id_card');
        }
    
        $this->session->set_flashdata('success', 'ID Card updated successfully');
        redirect('admin/id-card');
    }


   //Color Section

    public function adminColor()
    {
         
        if ((has_permission('Pages') && has_permission('color') && has_permission('Admin color') || $this->session->userdata('type') == 'admin')) {
			
            if (isset($_GET['domain_id']) && (int)$_GET['domain_id']) {
                $data['adminColor'] = $this->db->where('domain_id',$_GET['domain_id'])->get('admin_color')->row_array();
            }else {
                $data['adminColor'] = $this->db->where('domain_id', domain_id_get())->get('admin_color')->row_array();
            }
            $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
                        
            $this->load->view('admin/template/header');
            $this->load->view('admin/admin_color/edit', $data);
            $this->load->view('admin/template/footer');
         }else{
             $this->session->set_flashdata('message', 'You do not have permission to access this section.');
             redirect('admin-dashboard');
             return;
        }
    }

    public function adminColorUpdate()
    {
       if ((has_permission('Pages') && has_permission('color') && has_permission('Admin color') || $this->session->userdata('type') == 'admin')) {
			
           
           $post = $this->input->post();
           
           
           $data = array(
            'header_background_color' => $post['header_background_color'],
            'header_text_color' => $post['header_text_color'],
            'footer_background_color' => $post['footer_background_color'],
            'footer_text_color' => $post['footer_text_color'],
            'sidebar_color' => $post['sidebar_color'],
            'sidebar_text_color' => $post['sidebar_text_color'],
            'sidebar_hover_color' => $post['sidebar_hover_color'],
            'dropdown_background_color' => $post['dropdown_background_color'],
            'background_color' => $post['background_color'],
            'header_logo_color' => $post['header_logo_color'],
            'page_header_color' => $post['page_header_color'],
            'page_header_first_text_color' => $post['page_header_first_text_color'],
            'page_header_second_text_color' => $post['page_header_second_text_color'],
            'domain_id' => $post['domain_id'],
            'user_id' => $this->session->userdata('user_id'),
        );

        $existingData = $this->db->where('domain_id', $post['domain_id'])->get('admin_color')->row_array();
        
        if ($existingData) {
            $id = $existingData['id'];
            $update = $this->Dashboard_Model->common_update($id, $data, 'admin_color');
        } else {
            $insert = $this->Dashboard_Model->common_insert($data, 'admin_color');
        }
        
        $this->session->set_flashdata('success', 'Admin Color updated successfully');
        redirect('admin/admin-color');
        }else{
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
        }
    }


    public function cardColor()
    {
        if ((has_permission('Pages')  && has_permission('Color')  && has_permission('card color')) || $this->session->userdata('type') == 'admin') {
               
            if (isset($_GET['domain_id']) && (int)$_GET['domain_id']) {
                $data['cardColor'] = $this->db->where('domain_id',$_GET['domain_id'])->get('card_color')->row_array();
            }else {
                $data['cardColor'] = $this->db->where('domain_id', domain_id_get())->get('card_color')->row_array();
            }
                // print_r($data['datas']);die;
            $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
            
            $this->load->view('admin/template/header');
            $this->load->view('admin/card_color/edit', $data);
            $this->load->view('admin/template/footer');
        }else{
             $this->session->set_flashdata('message', 'You do not have permission to access this section.');
                redirect('admin-dashboard');
                return;
        
        }
    }

    public function cardColorUpdate()
    {
      
        if ((has_permission('Pages')  && has_permission('color')  && has_permission('card color')) || $this->session->userdata('type') == 'admin') {
            

        $post = $this->input->post();
        // print_r($post);die;

        $data = array(
            'card_text_color' => $post['card_text_color'],
            'details_text_color' => $post['details_text_color'],
            'background_color' => $post['background_color'],
            'domain_id' => $post['domain_id'],
            'user_id' => $this->session->userdata('user_id'),
        );

         // Upload configuration
            $config['upload_path'] = './assets/images/plantinumBanner';
            $config['allowed_types'] = 'jpg|jpeg|png|gif|bmp|tiff|jfif|webp';
            $config['max_size'] = 2048;  // 2MB
            $config['encrypt_name'] = TRUE;  // Encrypt file name
    
            $this->upload->initialize($config);
    
            $upload_data = [];
    
            // Check if the image upload was successful
            if (!empty($_FILES['image']['name'])) {
                if ($this->upload->do_upload('image')) {
                    $upload_data = $this->upload->data();
                } else {
                    // Debugging the upload error
                    echo $this->upload->display_errors();
                    exit;
                }
            }
                 if (isset($upload_data['file_name'])) {
                $data['image'] = $upload_data['file_name'];
            }
        

        $existingData = $this->db->where(array('domain_id' => $post['domain_id']))->get('card_color')->row_array();

        if ($existingData) {
            $id = $existingData['id'];
            $update = $this->Dashboard_Model->common_update($id, $data, 'card_color');
        } else {
            $insert = $this->Dashboard_Model->common_insert($data, 'card_color');
        }

        $this->session->set_flashdata('success', 'Card Color updated successfully');
        redirect('admin/card-color');
        
        }else{
         $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
         	
        }
    }
    

        // Loan Type

    public function loan_type_master()
    {
        if (!has_permission('Loan Type Master') && $this->session->userdata('type') != 'admin' ) {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            }
        $data['banker'] = $this->Dashboard_Model->loan_list();
        $this->load->view('admin/template/header');
        $this->load->view('admin/loantype-master/list', $data);
        $this->load->view('admin/template/footer');
    }

    public function loantype_master_add()
    {
        
        if (!has_permission('Loan Type Master') && $this->session->userdata('type') != 'admin') {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            }
         $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();     
        $this->load->view('admin/template/header');
        $this->load->view('admin/loantype-master/create',$data);
        $this->load->view('admin/template/footer');
    }

    public function loan_type_master_create()
    {
        if (!has_permission('Loan Type Master')) {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            }
        $post = $this->input->post();
        // print_r($post);die;
        $insert = $this->Dashboard_Model->common_insert($post, 'tbl_loan');
        
        if ($insert) {
            $this->session->set_flashdata('success', 'loan has been Created Successfully!!');
            redirect('admin/loan-type-master');
        } else {
            $this->session->set_flashdata('error', 'Something Went Wrong, try again!!');
            redirect('admin/Dashboard/loantype_master_add');
        }

    }
    public function loan_type_master_edit($id)
    {
        if (!has_permission('Loan Type Master')) {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            }
        $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();       
        $data['datas'] = $this->Dashboard_Model->common_row($id, 'tbl_loan');
        $this->load->view('admin/template/header');
        $this->load->view('admin/loantype-master/edit', $data);
        $this->load->view('admin/template/footer');
    }

    public function loan_type_master_update()
    {
        if (!has_permission('Loan Type Master')) {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            }
        // $id = $this->input->post('id');
        $post = $this->input->post();
   // print_r($post);die;
        $id = $post['id'];
        unset($post['id']);
        $update = $this->Dashboard_Model->common_update($id, $post, 'tbl_loan');
        if ($update) {
            redirect('admin/loan-type-master');
        } else {
            redirect('admin/loan-type-master-update');
        }
    }
    public function loan_type_master_del($id)
    {
        if (!has_permission('Loan Type Master')) {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            }
        $banker_del = $this->Dashboard_Model->common_update($id, array('status' => 0), 'tbl_loan');
        if ($banker_del) {
            $this->session->set_flashdata('success', 'Bank-Name delete');
            redirect('admin/loan-type-master');
        } else {
            $this->session->set_flashdata('error', 'Something Went Wrong, try again!!');
            redirect('admin/loan-type-master');
        }
    }

    public function home_loan()
    {
        
        $data['cities'] = $this->Dashboard_Model->cities_data();
        $data['states'] = $this->Dashboard_Model->state_data();
        $data['bank_data'] = $this->Dashboard_Model->bank_list();
        $data['banker'] = $this->Dashboard_Model->loan_list();
        $this->load->view('admin/template/header');
        $this->load->view('admin/personal_loan/list', $data);
        $this->load->view('admin/template/footer');
    }

    public function loan()
    {
        if (!has_permission('Bank Login List') && $this->session->userdata('type') != 'admin') {
        $this->session->set_flashdata('message', 'You do not have permission to access this section.');
        redirect('admin-dashboard');
        return;
        }
        $data['loans'] = $this->db->where(array('status' => 1))->order_by('id', 'DESC')->limit(100)->get('loan_master')->result_array();
        
        $loans = $this->db->where(array('status' => 1))
        ->where(($this->session->userdata('type') != 'admin') ? array('domain_id' => domain_id_get()) : array())
        ->where(($this->session->userdata('role') != 1) ? array('user_id' =>  $this->session->userdata('user_id')) : array())
        ->order_by('id', 'DESC')
        // ->limit(100)
        ->get('loan_master')
        ->result_array();
        
        // echo '<pre>';print_r($count = count($loans));die;

                $data['loans'] = [];

                // Loop through each loan to fetch user_master and branch_franchise data
                foreach ($loans as &$loan) {
                    // Fetch user_master data
                    $this->db->select('username, parent_id, subscription');
                    $this->db->from('user_master');
                    $this->db->where('id', $loan['user_id']);
                    $this->db->where('role', $loan['role']);
                    $user = $this->db->get()->row_array();
                    
                    // Add user_master data to the loan record
                    $loan['user_name'] = $user['username'] ?? null;
                    $loan['parent_id'] = $user['parent_id'] ?? null;
                    $loan['subscription'] = $user['subscription'] ?? null;

                    // Fetch branch_franchise data
                    $this->db->select('username');
                    $this->db->from('branch_franchise');
                    $this->db->where('id', $loan['user_id']);
                    
                    $branch = $this->db->get()->row_array();
                    
                    // Add branch_franchise data to the loan record
                    $loan['branch_name'] = $branch['username'] ?? null;

                    // Add the modified loan record to the result array
                    $data['loans'][] = $loan;
                }
                
        $domain_id = domain_id_get();
        $data['dsa_users'] = $this->db->where('parent_id', Null)->where('role', 2)->where('status', 1)->where('domain_id', $domain_id)->get('user_master')->result();
        
        // echo "<pre>"; print_r($this->db->last_query());die;
        $data['branch_users'] = $this->db->where('parent_id', 0)->where('role', 3)->where('status', 1)->where('domain_id', $domain_id)->get('branch_franchise')->result();
        

        $this->load->view('admin/template/header');
        $this->load->view('admin/loan/list', $data);
        $this->load->view('admin/template/footer');
    }

    public function loan_add()
    {
        if (!has_permission('Bank Login List')) {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            }
            
        $data['cities'] = $this->Dashboard_Model->cities_data();
        $data['states'] = $this->Dashboard_Model->state_data();
        $data['bank_data'] = $this->Dashboard_Model->bank_list();
        $data['banker'] = $this->Dashboard_Model->loan_list();
        $this->load->view('admin/template/header');
        $this->load->view('admin/loan/create', $data);
        $this->load->view('admin/template/footer');
    }

    public function loan_edit($id)
    {
        if (!has_permission('Bank Login List')) {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            }
            $domain_id = domain_id_get();
        $data['loans'] = $this->db->where(array('status' => 1, 'id' => $id , 'domain_id'=> $domain_id))->order_by('id', 'DESC')->get('loan_master')->row_array();
        // print_r($this->db->last_query());die;
        $data['document'] = $this->db->where(array('status' => 1, 'loan_id' => $id))->get('lead_document')->result_array();
        $data['states'] = $this->Dashboard_Model->state_data();
        $data['banker'] = $this->Dashboard_Model->loan_list();
        $data['bank_data'] = $this->Dashboard_Model->bank_list();
        $this->load->view('admin/template/header');
        $this->load->view('admin/loan/edit', $data);
        $this->load->view('admin/template/footer');
    }

    public function loan_view($id)
    {
        if (!has_permission('Bank Login List')) {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            }
             $domain_id = domain_id_get();

             $data['loans'] = $this->db->where(array('status' => 1, 'id' => $id ,'domain_id'=> $domain_id))->order_by('id', 'DESC')->get('loan_master')->row_array();
             
            $data['document'] = $this->db->where(array('status' => 1, 'loan_id' => $id ,'domain_id'=> $domain_id))->get('lead_document')->result_array();
            $data['lead_list'] = $this->db->where(array('status' => 1, 'loan_id' => $id ,'domain_id'=> $domain_id))->get('new_leads')->result_array();
            $data['rms'] = $this->db->where(array('id' => 793))->get('user_master')->result_array();
            
            $data['bank_data'] = $this->Dashboard_Model->bank_list();
        $data['banker'] = $this->Dashboard_Model->loan_list();
        $data['states'] = $this->Dashboard_Model->state_data();
        $this->load->view('admin/template/header');
        $this->load->view('admin/loan/view', $data);
        $this->load->view('admin/template/footer');
    }
    
    public function teamList()
    {
        if (!has_permission('Your Team Bank Login List')) {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            }
        $data['states'] = $this->Dashboard_Model->state_data();
        $domain_id = domain_id_get();
        $uid =  $this->session->userdata('user_id');
        $role =  $this->session->userdata('role');


        $user_data = $this->db->where('id', $uid)
        ->where('role', $role)
        ->where('domain_id', $domain_id)
        ->get('user_master')
        ->row_array();
        
        if (empty($user_data)) {
            $user_data = $this->db->where('id', $uid)
            ->where('role', $role)
            ->where('domain_id', $domain_id)
            ->get('branch_franchise')
            ->row_array();
        }
        
        // Team user ids
        $teamUserIds = [];
        $userIds = array();
        $userIdsrole = array();
        $uid = $user_data['id'];
        $userIds[] = $user_data['id'];
        $userIdsrole[] = $user_data['role'];
        
        if ($role != 1) {
            $users = $this->db->select('id,role')
            ->where('domain_id', $domain_id)
                ->where('parent_id', $uid)
                ->where('parent_id_role', $this->session->userdata('role'))
                ->get('user_master')
                ->result_array();
                
                if (!empty($users)) {
                foreach ($users as $user) {
                    $userIds[]     = $user['id'];
                    $teamUserIds[] = $user['id'];
                    $userIdsrole[] = $user['role'];
                }
            }
        }
        
        if (empty($teamUserIds)) {
            $teamUserIds = [-1];
        }

        //myteam userids 

        // Code for parent_team_id START
        $myteamuserIds     = [$uid];
        $myteamUserIds = [];
        $myteamUserIdsrole = [];
        
        if ($role != 1) {
            $users = $this->db->select('id,role')
            ->where('domain_id', $domain_id)
                ->where('parent_team_id', $uid)
                ->get('user_master')
                ->result_array();
                
                if (!empty($users)) {
                foreach ($users as $user) {
                    $myteamuserIds[]     = $user['id'];
                    $myteamUserIdsrole[] = $user['role'];
                }
            }
        }
        
        if (empty($myteamUserIds)) {
            $myteamUserIds = [-1];
        }else{
            // foreach($myteamUserIds as $myteamUserId){
            //     $users = $this->db->select('id')
            //                 ->where('domain_id', $domain_id)
            //                 ->where('parent_id', $myteamUserId)
            //                 ->get('user_master')
            //                 ->result_array();
                            
            //                 if (!empty($users)) {
            //                 foreach ($users as $user) {
            //                     $myteamUserIds[]     = $user['id'];
            //                 }
            //             }
           $this->db->select('id');
                $this->db->from('user_master');
                $this->db->where('domain_id', $domain_id);
                $this->db->where('status', 1);

                $hasCondition = false;

                foreach ($myteamuserIds as $key => $pid) {

                    $prole = $myteamUserIdsrole[$key] ?? null;

                    if ($prole !== null) {

                        if (!$hasCondition) {
                            $this->db->group_start();
                            $hasCondition = true;
                        }

                        $this->db->or_group_start()
                                ->where('parent_id', $pid)
                                ->where('parent_id_role', $prole)
                                ->group_end();
                    }
                }

                if ($hasCondition) {
                    $this->db->group_end();
                }

                $users = $this->db->get()->result_array();

            // IDs collect करो
            if (!empty($users)) {
                foreach ($users as $user) {
                    $myteamUserIds[] = $user['id'];
                }
            }
        }

        // Code for parent_team_id END
           //Parent Team lead data 
        $user_id = $this->session->userdata('user_id');
        $my_team_user = $this->db->from('user_master');
        if ($this->session->userdata('type') != 'admin') {
            $team_user = $this->db->where('domain_id', $domain_id);
        }
        $team_user = $this->db->where('parent_team_id', $user_id);
        $team_user = $this->count2 = $this->db->count_all_results();

        if($team_user > 0 && $this->session->userdata('role') == 2){
            $data['loans'] = $this->db->where(array('status' => 1))->where_in('user_id', $myteamUserIds)->where('domain_id',$domain_id)->order_by('id', 'DESC')->get('loan_master')->result_array();
        }



        $this->load->view('admin/template/header');
        $this->load->view('admin/loan/teamlist', $data);
        $this->load->view('admin/template/footer');
    }

    public function credit()
    {
        $data['states'] = $this->Dashboard_Model->state_data();
$domain_id = domain_id_get();
        $user = $this->db->select('id')->where('parent_id', $this->session->userdata('user_id'))->get('user_master')->row_array();
        if ($user) {
            $data['loans'] = $this->db->where(array('status' => 1, 'user_id' => $user['id']))->where('domain_id',$domain_id)->order_by('id', 'DESC')->get('loan_master')->result_array();
        }
        $this->load->view('admin/template/header');
        $this->load->view('admin/loan/teamlist', $data);
        $this->load->view('admin/template/footer');
    }

    public function getCity()
    {
        $cities = $this->db->where(array('state_id' => $this->input->post('id')))->get('cities')->result_array();
        $show = '';

        $city = $this->input->post('city');

        if (!empty($cities)) {
            foreach ($cities as $key => $value) {
                if ($city == $value['city']) {
                    $a = 'selected';
                } else {
                    $a = '';
                }
                $show .= '<option ' . $a . ' value="' . $value['city'] . '" data-id="' . $value['city'] . '">' . $value['city'] . '</option>';
            }}
        echo $show;
    }


    // public function getCity()
    // {
    //     $stateId = $this->input->post('id');
    //     $selectedCity = $this->input->post('city');

    //     $cities = $this->db->where('state_id', $stateId)->get('cities')->result_array();
    //     $options = '<option value="">Select City</option>';

    //     foreach ($cities as $city) {
    //         $isSelected = ($selectedCity == $city['city']) ? 'selected' : '';
    //         $options .= '<option value="' . $city['city'] . '" ' . $isSelected . '>' . $city['city'] . '</option>';
    //     }

    //     echo $options;
    // }


    

    public function loan_create()
    {

        $post = $this->input->post();
        $post['domain_id'] = domain_id_get();
        // print_r($post);die;
        $insert = $this->Dashboard_Model->common_insert($post, 'loan_master');

        if ($insert) {
            $this->session->set_flashdata('success', 'loan has been Created Successfully!!');
            redirect('admin/loan');
        } else {
            $this->session->set_flashdata('error', 'Something Went Wrong, try again!!');
            redirect('admin/loan-add');
        }

    }

    public function loan_del($id)
    {
        $loan_del = $this->Dashboard_Model->common_update($id, array('status' => 0), 'loan_master');
        if ($loan_del) {
            $this->session->set_flashdata('success', 'loan delete');
            redirect('admin/loan');
        } else {
            $this->session->set_flashdata('error', 'Something Went Wrong, try again!!');
            redirect('admin/loan');
        }
    }

    public function loan_update()
    {
        // $id = $this->input->post('id');
        $post = $this->input->post();
        $id = $post['id'];
        unset($post['id']);
        $update = $this->Dashboard_Model->common_update($id, $post, 'loan_master');
        if ($update) {
            redirect('admin/loan');
        } else {
            redirect('admin/loan-update');
        }
    }

    public function loan_lead_add()
    {
        if (!has_permission('Bank Login List')) {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
        }


        if (!empty($_GET['user_id'])) {
            $type = $_GET['user_id'];
        } else {
            $type = $this->session->userdata('user_id');
        }
// print_r($type);die;
        $post = $this->input->post();

        $data = array(
            'loan_amount_req' => $post['loan_amount_req'],
            'client_name' => $post['client_name'],
            'clientnumber' => $post['clientnumber'],
            'email' => $post['email'],
            'company_name' => $post['company_name'],
            'net_salary' => $post['net_salary'],
            'state' => $post['state_name'],
            'city' => $post['city'],
            'pin_code' => $post['pin_code'],
            'user_id' => $type,
            'remark' => $post['remark'],
            'marital_status' => $post['marital_status'],
            'residence_type' => $post['residence_type'],
            'residential_status' => $post['residential_status'],
            'spouse_house' => $post['spouse_house'],
            'mother_name' => $post['mother_name'],
            'designation' => $post['designation'],
            'company_address' => $post['company_address'],
            'salary_transfer_mode' => $post['salary_transfer_mode'],
            'total_job_experience' => $post['total_job_experience'],
            'ref_name1' => $post['ref_name1'],
            'ref_name2' => $post['ref_name2'],
            'ref_mobile1' => $post['ref_mobile1'],
            'ref_mobile2' => $post['ref_mobile2'],
            'ref_relation1' => $post['ref_relation1'],
            'apply_for_loan' => $post['apply_for_loan'],
            'ref_relation2' => $post['ref_relation2'],
            'domain_id' => domain_id_get(),
            'role' =>  $this->session->userdata('role'),
        );

        $insert = $this->Dashboard_Model->common_insert($data, 'loan_master');
        $inserted_id = $this->db->insert_id();

        for ($i = 0; $i < count($post['loan_type']); $i++) {
            $lead = array(
                'loan_type' => $post['loan_type'][$i],
                'loan_amount' => $post['loan_amount'][$i],
                'bank_name' => $post['bank_name'][$i],
                'emi_amount' => $post['emi_amount'][$i],
                'paid_emi' => $post['paid_emi'][$i],
                'loan_id' => $inserted_id,
                'domain_id' => domain_id_get(),
            );

            $insert2 = $this->Dashboard_Model->common_insert($lead, 'new_leads');
        }

        for ($i = 0; $i < count($post['attachment']); $i++) {
            if ($_FILES["image"]["size"][$i] > 0) {
                $tmpFilePath = $_FILES['image']['tmp_name'][$i];
                $fileinfo = @getimagesize($_FILES["image"]["tmp_name"][$i]);
                $image_file_type = pathinfo($_FILES["image"]["name"][$i], PATHINFO_EXTENSION);
                $newFilePath = 'upload/assets/images/' . time() . '.' . $image_file_type;

                if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                    $post['image'][$i] = $newFilePath;
                }
            }

            $file = array(
                'attachment' => $post['attachment'][$i],
                'login_which_bank' => $post['login_which_bank'][$i],
                'image' => isset($post['image'][$i]) ? $post['image'][$i] : '',
                'password' => $post['password'][$i],
                'loan_id' => $inserted_id,
            'domain_id' => domain_id_get(),
            );

            $insert2 = $this->Dashboard_Model->common_insert($file, 'lead_document');
        }

        if (!empty($_GET['user_id'])) {
            if ($insert) {
                $this->session->set_flashdata('success', 'Request sent successfully. Lead ID - ' . (10001 + $inserted_id));
                redirect('admin-dashboard');
            } else {
                $this->session->set_flashdata('error', 'Something Went Wrong, try again!!');
                redirect('admin-dashboard');
            }

        } else {
            if ($insert) {
                $this->session->set_flashdata('success', 'Request sent successfully. Lead ID - ' . (10001 + $inserted_id));
                redirect('admin/loan-add');
            } else {
                $this->session->set_flashdata('error', 'Something Went Wrong, try again!!');
                redirect('admin/loan-add');
            }
        }

    }

    public function document_del($id)
    {
        $loan_del = $this->Dashboard_Model->common_update($id, array('status' => 0), 'lead_document');
        if ($loan_del) {
            $this->session->set_flashdata('success', 'loan delete');
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            $this->session->set_flashdata('error', 'Something Went Wrong, try again!!');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function remarks($id)
    {
        $loan_update = $this->Dashboard_Model->common_update($id, 
        array(
            'admin_remark' => $this->input->post('admin_remark'),
            'bank_for_admin' => $this->input->post('bank_for_admin'),
            'rm_assign' => $this->input->post('rm_assign'),
            'lead_feedback' => $this->input->post('lead_feedback'),
            'loan_status' => $this->input->post('loan_status')
        ), 
           'loan_master');
        if ($loan_update) {
            $this->session->set_flashdata('success', 'loan updated successfully');
            redirect('admin/loan');
        } else {
            $this->session->set_flashdata('error', 'Something Went Wrong, try again!!');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function dis_update($id)
    {

        if ($this->session->userdata('role') == 1) {
            // $admin_id = $this->session->userdata('user_id');
            $admin_id = 1;
        } else {
            $admin_id = '';
        }

        $loan_del = $this->Dashboard_Model->common_update($id,

            array('disbursed' => $this->input->post('disbursed'),
                'payout' => $this->input->post('payout'),
                'bankModal' => $this->input->post('bankModal'),
                'payment_amount_paid' => $this->input->post('payment_amount_paid'),
                'sanction' => $this->input->post('sanction'),
                'payment_amount_paid_team' => $this->input->post('payment_amount_paid_team'),
                'payout_team' => $this->input->post('payout_team'),
                'disbursed_team' => $this->input->post('disbursed_team'),
                'bankModal_team' => $this->input->post('bankModal_team'),
                'sanction_team' => $this->input->post('sanction_team'),
                'payment_amount_paid_team' => $this->input->post('payment_amount_paid_team'),
                'admin_id' => $admin_id),
            'loan_master');
        if ($loan_del) {
            $this->session->set_flashdata('success', 'loan updated');
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            $this->session->set_flashdata('error', 'Something Went Wrong, try again!!');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function dis_leads_update()
    {

        if ($this->session->userdata('role') == 1) {
             // $admin_id = $this->session->userdata('user_id');
            $admin_id = 1;
        } else {
            $admin_id = '';
        }

        // print_r($this->input->post());die;

        $loan_del = $this->Dashboard_Model->common_update($this->input->post('id'),

            array('disbursed' => $this->input->post('disbursed'),
                'payout' => $this->input->post('payout'),
                'bankModal' => $this->input->post('bankModal'),
                'payment_amount_paid' => $this->input->post('payment_amount_paid'),
                'sanction' => $this->input->post('sanction'),
                'admin_id' => $admin_id),
            'leads');

        if ($loan_del) {
            echo 'yes';
            } 
    }


    public function dis_leads_update_user()
    {
        if ($this->session->userdata('role') == 1) {
            // $admin_id = $this->session->userdata('user_id');
            $admin_id = 1;
        } else {
            $admin_id = '';
        }

        // print_r($this->input->post());
        // die;
        $loan_del = $this->Dashboard_Model->common_update($this->input->post('id'),

            array(
                'payout_team' => $this->input->post('payout_team'),
                'disbursed_team' => $this->input->post('disbursed_team'),
                'bankModal_team' => $this->input->post('bankModal_team'),
                'sanction_team' => $this->input->post('sanction_team'),
                'payment_amount_paid_team' => $this->input->post('payment_amount_paid_team'),
                // 'admin_id' => $admin_id
            ),
            'leads');

        if ($loan_del) {
           echo 'yes';
        } 
    }



    public function loan_lead_update()
    {
        $post = $this->input->post();
        $inserted_id = $post['id'];
        $data = array(
            'loan_amount_req' => $post['loan_amount_req'],
            'client_name' => $post['client_name'],
            'clientnumber' => $post['clientnumber'],
            'dob' => $post['dob'],
            'pan' => $post['pan'],
            'aadhar' => $post['aadhar'],
            'marital_status' => $post['marital_status'],
            'spouse_house' => $post['spouse_house'],
            'mother_name' => $post['mother_name'],
            'alt_number' => $post['alt_number'],
            'qualification' => $post['qualification'],
            'residential_address' => $post['residential_address'],
            'residential_type' => $post['residential_type'],
            'residential_address_token' => $post['residential_address_token'],
            'residence_stability' => $post['residence_stability'],
            'state' => $post['state_name'],
            'city' => $post['city'],
            'pin_code' => $post['pin_code'],
            'company_name' => $post['company_name'],

            'designation' => $post['designation'],
            'company_address' => $post['company_address'],
            'net_salary' => $post['net_salary'],
            'salary_transfer_mode' => $post['salary_transfer_mode'],
            'job_period' => $post['job_period'],
            'job_experience' => $post['job_experience'],
            'ofc_email' => $post['ofc_email'],
            'ofc_number' => $post['ofc_number'],
            'no_of_dependent' => $post['no_of_dependent'],
            'cc_outstanding_amount' => $post['cc_outstanding_amount'],
            // 'remark' => $post['remark'],

            'ref_name1' => $post['ref_name1'],
            'ref_name2' => $post['ref_name2'],
            'ref_mobile1' => $post['ref_mobile1'],
            'ref_mobile2' => $post['ref_mobile2'],
            'ref_relation1' => $post['ref_relation1'],
            'ref_relation2' => $post['ref_relation2'],
            'domain_id' => domain_id_get(),
            'role' =>  $this->session->userdata('role'),
        );

        // echo '<pre>';print_r($data);die;
        $loan_inesrt = $this->Dashboard_Model->common_update($inserted_id, $data, 'loan_master');

        if (!empty($post['loan_type'])) {

            for ($i = 0; $i < count($post['loan_type']); $i++) {
                $lead = array(
                    'loan_type' => $post['loan_type'][$i],
                    'loan_amount' => $post['loan_amount'][$i],
                    'bank_name' => $post['bank_name'][$i],
                    'emi_amount' => $post['emi_amount'][$i],
                    'paid_emi' => $post['paid_emi'][$i],
                    'loan_id' => $inserted_id,
                    'domain_id' => domain_id_get(),
                );

                $insert2 = $this->Dashboard_Model->common_insert($lead, 'new_leads');
            }
        }

        for ($i = 0; $i < count($post['attachment']); $i++) {
            if ($_FILES["image"]["size"][$i] > 0) {
                $tmpFilePath = $_FILES['image']['tmp_name'][$i];
                $fileinfo = @getimagesize($_FILES["image"]["tmp_name"][$i]);
                $image_file_type = pathinfo($_FILES["image"]["name"][$i], PATHINFO_EXTENSION);
                $newFilePath = 'upload/assets/images/' . time() . '.' . rand() . '.' . $image_file_type;

                if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                    $post['image'][$i] = $newFilePath;
                }
            }

            $file = array(
                'attachment' => $post['attachment'][$i],
                'image' => isset($post['image'][$i]) ? $post['image'][$i] : '',
                'password' => $post['password'][$i],
                'login_which_bank' => $post['login_which_bank'][$i],
                'loan_id' => $inserted_id,
            );

            if (!empty($post['attachment'][$i]) || $post['image'][$i] || $post['password'][$i]) {
                $insert2 = $this->Dashboard_Model->common_insert($file, 'lead_document');
            }
        }

        if ($insert) {
            $this->session->set_flashdata('success', 'loan has been Created Successfully!!');
            redirect('admin/loan');
        } else {
            $this->session->set_flashdata('error', 'Something Went Wrong, try again!!');
            redirect($_SERVER['HTTP_REFERER']);
        }

    }
    public function loanasign()
    {
        if (!has_permission('Bank Login List')) {
        $this->session->set_flashdata('message', 'You do not have permission to access this section.');
        redirect('admin-dashboard');
        return;
        }
        $data['loans'] = $this->db->where(array('status' => 1, 'rm_assign' => 793))->order_by('id', 'DESC')->get('loan_master')->result_array();
        $this->load->view('admin/template/header');
        $this->load->view('admin/loan/leadasign', $data);
        $this->load->view('admin/template/footer');
    }

    public function business_lead_update()
    {
        $post = $this->input->post();
        $inserted_id = $post['id'];
        $data = array(
            'loan_amount_req' => $post['loan_amount_req'],
            'client_name' => $post['client_name'],
            'clientnumber' => $post['clientnumber'],
            'dob' => $post['dob'],
            'pan' => $post['pan'],
            'aadhar' => $post['aadhar'],
            'marital_status' => $post['marital_status'],
            'spouse_house' => $post['spouse_house'],
            'mother_name' => $post['mother_name'],
            'alt_number' => $post['alt_number'],
            'qualification' => $post['qualification'],
            'residential_address' => $post['residential_address'],
            'residential_type' => $post['residential_type'],
            'residential_address_token' => $post['residential_address_token'],
            'residence_stability' => $post['residence_stability'],
            'state' => $post['state_name'],
            'city' => $post['city'],
            'pin_code' => $post['pin_code'],
            'company_name' => $post['company_name'],

            // 'company_address'       => $post['company_address'],
            // 'net_salary'       => $post['net_salary'],
            // 'salary_transfer_mode'       => $post['salary_transfer_mode'],
            // 'job_period'       => $post['job_period'],
            // 'job_experience'       => $post['job_experience'],
            // 'ofc_email'       => $post['ofc_email'],
            // 'ofc_number'       => $post['ofc_number'],
            // 'no_of_dependent'       => $post['no_of_dependent'],
            // 'cc_outstanding_amount'       => $post['cc_outstanding_amount'],
            'remark' => $post['remark'],

            'ref_name1' => $post['ref_name1'],
            'ref_name2' => $post['ref_name2'],
            'ref_mobile1' => $post['ref_mobile1'],
            'ref_mobile2' => $post['ref_mobile2'],
            'ref_relation1' => $post['ref_relation1'],
            'ref_relation2' => $post['ref_relation2'],
            'domain_id' => domain_id_get(),
            'role' =>  $this->session->userdata('role'),
        );

        $loan_del = $this->Dashboard_Model->common_update($inserted_id, $data, 'loan_master');

        if (!empty($post['loan_type'])) {

            for ($i = 0; $i < count($post['loan_type']); $i++) {
                $lead = array(
                    'loan_type' => $post['loan_type'][$i],
                    'loan_amount' => $post['loan_amount'][$i],
                    'bank_name' => $post['bank_name'][$i],
                    'emi_amount' => $post['emi_amount'][$i],
                    'paid_emi' => $post['paid_emi'][$i],
                    'loan_id' => $inserted_id,
                    'domain_id' => domain_id_get(),
                );

                $insert2 = $this->Dashboard_Model->common_insert($lead, 'new_leads');
            }
        }

        for ($i = 0; $i < count($post['attachment']); $i++) {
            if ($_FILES["image"]["size"][$i] > 0) {
                $tmpFilePath = $_FILES['image']['tmp_name'][$i];
                $fileinfo = @getimagesize($_FILES["image"]["tmp_name"][$i]);
                $image_file_type = pathinfo($_FILES["image"]["name"][$i], PATHINFO_EXTENSION);
                $newFilePath = 'upload/assets/images/' . time() . '.' . rand() . '.' . $image_file_type;

                if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                    $post['image'][$i] = $newFilePath;
                }
            }

            $file = array(
                'attachment' => $post['attachment'][$i],
                'login_which_bank' => $post['login_which_bank'][$i],
                'image' => isset($post['image'][$i]) ? $post['image'][$i] : '',
                'password' => $post['password'][$i],
                'loan_id' => $inserted_id,
            );

            if (!empty($post['attachment'][$i]) || $post['image'][$i] || $post['password'][$i]) {
                $insert2 = $this->Dashboard_Model->common_insert($file, 'lead_document');
            }
        }

        if ($insert) {
            $this->session->set_flashdata('success', 'loan has been Created Successfully!!');
            redirect('admin/loan');
        } else {
            $this->session->set_flashdata('error', 'Something Went Wrong, try again!!');
            redirect($_SERVER['HTTP_REFERER']);
        }

    }

    public function home_loan_insert()
    {

        if (!has_permission('bank login')) {
        if ($this->session->userdata('type') != 'admin') {
		
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            }
            }
        $post = $this->input->post();
        // echo '<pre>';
        // print_r($post);die;

        $data = array(
            'loan_amount_req' => $post['loan_amount_req'],
            'client_name' => $post['client_name'],
            'clientnumber' => $post['clientnumber'],
            'email' => $post['email'],
            'company_name' => $post['company_name'],
            'net_salary' => $post['net_salary'],
            'state' => $post['state_name'],
            'city' => $post['city'],
            'pin_code' => $post['pin_code'],
            'user_id' => $this->session->userdata('user_id'),
            'property_market_value' => $post['property_market_value'],
            'remark' => $post['remark'],
            'marital_status' => $post['marital_status'],
            'spouse_house' => $post['spouse_house'],
            'mother_name' => $post['mother_name'],
            'residence_type' => $post['residence_type'],
            'residential_address' => $post['residential_address'],
            'company_address' => $post['company_address'],
            'designation' => $post['designation'],
            'employment' => $post['employment'],
            'salary_transfer_mode' => $post['salary_transfer_mode'],
            'job_period' => $post['job_peried_current_company'],
            'job_experience' => $post['job_experience'],
            'property_total_area' => $post['property_total_area'],
            'property_address' => $post['property_address'],
            'apply_for_loan' => $post['apply_for_loan'],
            'annual_turnover' => $post['annual_ternover'],
            'business_age' => $post['business_age'],
            'business_type' => $post['business_type'],
            'ref_name1' => $post['ref_name1'],
            'ref_mobile1' => $post['ref_mobile1'],
            'ref_relation1' => $post['ref_relation1'],
            'ref_name2' => $post['ref_name2'],
            'ref_mobile2' => $post['ref_mobile2'],
            'ref_relation2' => $post['ref_relation2'],
            'domain_id' => domain_id_get(),
            'role' =>  $this->session->userdata('role'),

        );
        $insert = $this->Dashboard_Model->common_insert($data, 'loan_master');
        $inserted_id = $this->db->insert_id();

        for ($i = 0; $i < count($post['loan_type']); $i++) {
            $lead = array(
                'loan_type' => $post['loan_type'][$i],
                'loan_amount' => $post['loan_amount'][$i],
                'bank_name' => $post['bank_name'][$i],
                'emi_amount' => $post['emi_amount'][$i],
                'paid_emi' => $post['paid_emi'][$i],
                'loan_id' => $inserted_id,
            'domain_id' => domain_id_get(),
            );

            $insert2 = $this->Dashboard_Model->common_insert($lead, 'new_leads');
        }

        for ($i = 0; $i < count($post['attachment']); $i++) {
            if ($_FILES["image"]["size"][$i] > 0) {
                $tmpFilePath = $_FILES['image']['tmp_name'][$i];
                $fileinfo = @getimagesize($_FILES["image"]["tmp_name"][$i]);
                $image_file_type = pathinfo($_FILES["image"]["name"][$i], PATHINFO_EXTENSION);
                $newFilePath = 'upload/assets/images/' . time() . '.' . $image_file_type;

                if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                    $post['image'][$i] = $newFilePath;
                }
            }

            $file = array(
                'attachment' => $post['attachment'][$i],
                'login_which_bank' => $post['login_which_bank'][$i],
                'image' => isset($post['image'][$i]) ? $post['image'][$i] : '',
                'password' => $post['password'][$i],
                'loan_id' => $inserted_id,
            'domain_id' => domain_id_get(),
            );

            $insert2 = $this->Dashboard_Model->common_insert($file, 'lead_document');
        }

        if ($insert) {
            $this->session->set_flashdata('success', 'Request sent successfully. Lead ID - ' . (10001 + $inserted_id));
            redirect('admin/home-loan');
        } else {
            $this->session->set_flashdata('error', 'Something Went Wrong, try again!!');
            redirect('admin/home-loan');
        }
    }
    public function homeloanUpdate($id)
    {

         if (!has_permission('bank login')) {
        if ($this->session->userdata('type') != 'admin') {
		
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            }
        }
        $data['cities'] = $this->Dashboard_Model->cities_data();
        $data['states'] = $this->Dashboard_Model->state_data();
        $data['bank_data'] = $this->Dashboard_Model->bank_list();
        $data['loans'] = $this->db->where(array('status' => 1, 'id' => $id))->get('loan_master')->row_array();
        $data['lead_list'] = $this->db->where(array('status' => 1, 'loan_id' => $id))->get('new_leads')->result_array();
        $data['document'] = $this->db->where(array('status' => 1, 'loan_id' => $id))->get('lead_document')->result_array();
        $this->load->view('admin/template/header');
        $this->load->view('admin/personal_loan/edit', $data);
        $this->load->view('admin/template/footer');
    }

    public function creditCard()
    {
        $this->load->view('admin/template/header');
        $this->load->view('admin/loan/credit');
        $this->load->view('admin/template/footer');
    }

    public function creditCardView($id)
    {
        $data['states'] = $this->Dashboard_Model->state_data();
        $data['loans'] = $this->db->where(array('status' => 1, 'id' => $id))->get('loan_master')->row_array();
        $data['rms'] = $this->db->where(array('id' => 793))->get('user_master')->result_array();
        $this->load->view('admin/template/header');
        $this->load->view('admin/loan/credit_view', $data);
        $this->load->view('admin/template/footer');
    }

    public function creditCardUpdate($id)
    {
        $data['loans'] = $this->db->where(array('status' => 1, 'id' => $id))->get('loan_master')->row_array();
        $data['rms'] = $this->db->where(array('id' => 793))->get('user_master')->result_array();
        $this->load->view('admin/template/header');
        $this->load->view('admin/loan/credit_update', $data);
        $this->load->view('admin/template/footer');
    }

    public function businessUpdate($id)
    {
        $data['loans'] = $this->db->where(array('status' => 1, 'id' => $id))->get('loan_master')->row_array();
        $data['bank_data'] = $this->Dashboard_Model->bank_list();
        $data['states'] = $this->Dashboard_Model->state_data();
        $data['document'] = $this->db->where(array('status' => 1, 'loan_id' => $id))->get('lead_document')->result_array();
        $this->load->view('admin/template/header');
        $this->load->view('admin/loan/business_update', $data);
        $this->load->view('admin/template/footer');
    }

    public function businessView($id)
    {
        if (!has_permission('Bank Login List')) {
        $this->session->set_flashdata('message', 'You do not have permission to access this section.');
        redirect('admin-dashboard');
        return;
        }
        $data['loans'] = $this->db->where(array('status' => 1, 'id' => $id))->get('loan_master')->row_array();
        $data['bank_data'] = $this->Dashboard_Model->bank_list();
        $data['states'] = $this->Dashboard_Model->state_data();
        $data['document'] = $this->db->where(array('status' => 1, 'loan_id' => $id))->get('lead_document')->result_array();
        $this->load->view('admin/template/header');
        $this->load->view('admin/loan/business_view', $data);
        $this->load->view('admin/template/footer');
    }

    public function businessloan()
    {

        $data['cities'] = $this->Dashboard_Model->cities_data();
        $data['states'] = $this->Dashboard_Model->state_data();
        $data['bank_data'] = $this->Dashboard_Model->bank_list();
        $data['banker'] = $this->Dashboard_Model->loan_list();
        $this->load->view('admin/template/header');
        $this->load->view('admin/loan/business', $data);
        $this->load->view('admin/template/footer');
    }

    public function credit_Update()
    {
        $data = $this->input->post();
        $data['domain_id'] = domain_id_get();
        $id = $data['id'];
        unset($data['id']);
        $update = $this->Dashboard_Model->common_update($id, $data, 'loan_master');
        if ($update) {
            $this->session->set_flashdata('success', 'Updated successfully.');
            redirect('admin/loan');
        } else {
            $this->session->set_flashdata('error', 'Something Went Wrong, try again!!');
            redirect($_SERVER['HTTP_REFERER']);
        }

    }

    public function businessloan_insert()
    {
        $post = $this->input->post();
        //
        if (!empty($_GET['user_id'])) {
            $type = $_GET['user_id'];
        } else {
            $type = $this->session->userdata('user_id');
        }

        $data = array(
            'loan_amount_req' => $post['loan_amount_req'],
            'client_name' => $post['client_name'],
            'clientnumber' => $post['clientnumber'],
            'email' => $post['email'],
            'business_type' => $post['business_type'],
            'nature_of_business' => $post['nature_of_business'],
            'annual_turnover' => $post['annual_turnover'],
            'business_age' => $post['business_age'],
            'business_registration_proof' => $post['business_registration_proof'],
            'how_many_year_itr_available' => $post['how_many_year_itr_available'],
            'state' => $post['state_name'],
            'city' => $post['city'],
            'pin_code' => $post['pin_code'],
            'remark' => $post['remark'],
            'marital_status' => $post['marital_status'],
            'spouse_house' => $post['spouse_house'],
            'mother_name' => $post['mother_name'],
            'alt_number' => $post['alt_number'],
            'residence_type' => $post['residence_type'],
            'residential_address' => $post['residential_address'],
            'company_name' => $post['company_name'],
            'company_address' => $post['company_address'],
            'business_premises' => $post['business_premises'],
            'apply_for_loan' => $post['apply_for_loan'],
            'user_id' => $type,
            'ref_name1' => $post['ref_name1'],
            'ref_mobile1' => $post['ref_mobile1'],
            'ref_relation1' => $post['ref_relation1'],
            'ref_name2' => $post['ref_name2'],
            'ref_mobile2' => $post['ref_mobile2'],
            'ref_relation2' => $post['ref_relation2'],
            'domain_id' => domain_id_get(),
            'role' =>  $this->session->userdata('role'),
        );
        $insert = $this->Dashboard_Model->common_insert($data, 'loan_master');
        $inserted_id = $this->db->insert_id();

        for ($i = 0; $i < count($post['loan_type']); $i++) {
            $lead = array(
                'loan_type' => $post['loan_type'][$i],
                'loan_amount' => $post['loan_amount'][$i],
                'bank_name' => $post['bank_name'][$i],
                'emi_amount' => $post['emi_amount'][$i],
                'paid_emi' => $post['paid_emi'][$i],
                'loan_id' => $inserted_id,
                'domain_id' => domain_id_get(),
                'role' =>  $this->session->userdata('role'),
            );

            $insert2 = $this->Dashboard_Model->common_insert($lead, 'new_leads');
        }

        for ($i = 0; $i < count($post['attachment']); $i++) {
            if ($_FILES["image"]["size"][$i] > 0) {
                $tmpFilePath = $_FILES['image']['tmp_name'][$i];
                $fileinfo = @getimagesize($_FILES["image"]["tmp_name"][$i]);
                $image_file_type = pathinfo($_FILES["image"]["name"][$i], PATHINFO_EXTENSION);
                $newFilePath = 'upload/assets/images/' . time() . '.' . $image_file_type;

                if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                    $post['image'][$i] = $newFilePath;
                }
            }

            $file = array(
                'attachment' => $post['attachment'][$i],
                'login_which_bank' => $post['login_which_bank'][$i],
                'image' => isset($post['image'][$i]) ? $post['image'][$i] : '',
                'password' => $post['password'][$i],
                'loan_id' => $inserted_id,
                'domain_id' => domain_id_get(),
            );

            $insert2 = $this->Dashboard_Model->common_insert($file, 'lead_document');
        }

        if (!empty($_GET['user_id'])) {
            if ($insert) {
                $this->session->set_flashdata('success', 'Request sent successfully. Lead ID - ' . (10001 + $inserted_id));
                redirect('admin-dashboard');
            } else {
                $this->session->set_flashdata('error', 'Something Went Wrong, try again!!');
                redirect('admin-dashboard');
            }

        } else {
            if ($insert) {
                $this->session->set_flashdata('success', 'Request sent successfully. Lead ID - ' . (10001 + $inserted_id));
                redirect('admin/businessloan');
            } else {
                $this->session->set_flashdata('error', 'Something Went Wrong, try again!!');
                redirect('admin/businessloan');
            }

        }

    }

    public function credit_insert()
    {
        $post = $this->input->post();
        $a = $post['save'];
        unset($post['save']);

        $post['user_id'] = $this->session->userdata('user_id');
        $post['domain_id'] = domain_id_get();
        $credit = $this->Dashboard_Model->common_insert($post, 'loan_master');
        if ($a == 'Save') {
            if ($credit) {
                $this->session->set_flashdata('success', 'Added Successfully');
                redirect('https://wee.bnking.in/c/OWY5OWJk');
            } else {
                $this->session->set_flashdata('error', 'Something Went Wrong, try again!!');
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {
            if ($credit) {
                $this->session->set_flashdata('success', 'Added Successfully');
                redirect('https://loan.gromo.in/?journeyId=2&shortCode=_2xMXbSRHKFESEfvK8W-A&subCode=l&productType=Personal%20Loan');
            } else {
                $this->session->set_flashdata('error', 'Something Went Wrong, try again!!');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }

    }

    public function home_lead_update()
    {
        $post = $this->input->post();
        // echo '<pre>';
        // print_r($post);
        // die;
        $inserted_id = $post['id'];
        $data = array(

            'loan_amount_req' => $post['loan_amount_req'],
            'client_name' => $post['client_name'],
            'clientnumber' => $post['clientnumber'],
            'email' => $post['email'],
            'company_name' => $post['company_name'],
            'net_salary' => $post['net_salary'],
            'state' => $post['state_name'],
            'city' => $post['city'],
            'pin_code' => $post['pin_code'],
            'property_market_value' => $post['property_market_value'],
            'remark' => $post['remark'],
            'marital_status' => $post['marital_status'],
            'spouse_house' => $post['spouse_house'],
            'mother_name' => $post['mother_name'],
            'residence_type' => $post['residence_type'],
            'residential_address' => $post['residential_address'],
            'company_address' => $post['company_address'],
            'designation' => $post['designation'],
            'employment' => $post['employment'],
            'salary_transfer_mode' => $post['salary_transfer_mode'],
            'job_period' => $post['job_peried_current_company'],
            'job_experience' => $post['job_experience'],
            'property_total_area' => $post['property_total_area'],
            'property_address' => $post['property_address'],
            'annual_turnover' => $post['annual_ternover'],
            'business_age' => $post['business_age'],
            'business_type' => $post['business_type'],
            'ref_name1' => $post['ref_name1'],
            'ref_mobile1' => $post['ref_mobile1'],
            'ref_relation1' => $post['ref_relation1'],
            'ref_name2' => $post['ref_name2'],
            'ref_mobile2' => $post['ref_mobile2'],
            'ref_relation2' => $post['ref_relation2'],
            'domain_id' => domain_id_get(),
        );

        $loan_del = $this->Dashboard_Model->common_update($inserted_id, $data, 'loan_master');

        if (!empty($post['loan_type'])) {

            for ($i = 0; $i < count($post['loan_type']); $i++) {
                $lead = array(
                    'loan_type' => $post['loan_type'][$i],
                    'loan_amount' => $post['loan_amount'][$i],
                    'bank_name' => $post['bank_name'][$i],
                    'emi_amount' => $post['emi_amount'][$i],
                    'paid_emi' => $post['paid_emi'][$i],
                    'loan_id' => $inserted_id,
                    'domain_id' => domain_id_get(),
                );

                $insert2 = $this->Dashboard_Model->common_insert($lead, 'new_leads');
            }
        }

        for ($i = 0; $i < count($post['attachment']); $i++) {
            if ($_FILES["image"]["size"][$i] > 0) {
                $tmpFilePath = $_FILES['image']['tmp_name'][$i];
                $fileinfo = @getimagesize($_FILES["image"]["tmp_name"][$i]);
                $image_file_type = pathinfo($_FILES["image"]["name"][$i], PATHINFO_EXTENSION);
                $newFilePath = 'upload/assets/images/' . time() . '.' . rand() . '.' . $image_file_type;

                if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                    $post['image'][$i] = $newFilePath;
                }
            }

            $file = array(
                'attachment' => $post['attachment'][$i],
                'login_which_bank' => $post['login_which_bank'][$i],
                'image' => isset($post['image'][$i]) ? $post['image'][$i] : '',
                'password' => $post['password'][$i],
                'loan_id' => $inserted_id,
            'domain_id' => domain_id_get(),
            );

            if (!empty($post['attachment'][$i]) || $post['image'][$i] || $post['password'][$i]) {
                $insert2 = $this->Dashboard_Model->common_insert($file, 'lead_document');
            }
        }

        if ($insert) {
            $this->session->set_flashdata('success', 'loan has been Created Successfully!!');
            redirect('admin/loan');
        } else {
            $this->session->set_flashdata('error', 'Something Went Wrong, try again!!');
            redirect($_SERVER['HTTP_REFERER']);
        }

    }

    public function loan_company_master_list()
    {
        if (!has_permission('Self Bank Login')  && $this->session->userdata('type') != 'admin') {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
        }
        $data['banker'] = $this->Dashboard_Model->loan_company_master_get();
        $this->load->view('admin/template/header');
        $this->load->view('admin/loan_company_master/list', $data);
        $this->load->view('admin/template/footer');
    }

    public function loan_company_master_form()
    {
        if (!has_permission('Self Bank Login')  && $this->session->userdata('type') != 'admin') {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
        }

$data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
        $this->load->view('admin/template/header');
        $this->load->view('admin/loan_company_master/add' , $data);
        $this->load->view('admin/template/footer');
    }

    public function add_loan_company_master()
    {
        if (!has_permission('Self Bank Login')  && $this->session->userdata('type') != 'admin') {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
        }
        $data = $this->input->post();
        // echo '<pre>';
        // print_r($data);die;
        if ($_FILES["image"]["size"] > 0) {
            $tmpFilePath = $_FILES['image']['tmp_name'];
            $fileinfo = @getimagesize($_FILES["image"]["tmp_name"]);
            $image_file_type = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
            $newFilePath = 'upload/assets/video/' . time() . '.' . $image_file_type;
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                $data['image'] = $newFilePath;
            }
        }

        if ($_FILES["document"]["size"] > 0) {
            $tmpFilePath = $_FILES['document']['tmp_name'];
            $fileinfo = @getimagesize($_FILES["document"]["tmp_name"]);
            $image_file_type = pathinfo($_FILES["document"]["name"], PATHINFO_EXTENSION);
            $newFilePath = 'upload/assets/video/' . time() . '.' . $image_file_type;
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                $data['document'] = $newFilePath;
            }
        }

        if ($_FILES["pincode_document"]["size"] > 0) {
            $tmpFilePath = $_FILES['pincode_document']['tmp_name'];
            $fileinfo = @getimagesize($_FILES["pincode_document"]["tmp_name"]);
            $image_file_type = pathinfo($_FILES["pincode_document"]["name"], PATHINFO_EXTENSION);
            $newFilePath = 'upload/assets/video/' . time() . '.' . $image_file_type;
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                $data['pincode_document'] = $newFilePath;
            }
        }

        $insert = $this->Dashboard_Model->common_insert($data, 'loan_company_master');
        if ($insert) {
            redirect('admin/loan-company-master');
        }
        // $data['cities'] = $this->Dashboard_Model->cities_data();
        // $data['states'] = $this->Dashboard_Model->state_data();
        // $data['bank_data'] = $this->Dashboard_Model->bank_list();
        // $data['banker'] = $this->Dashboard_Model->loan_list();
        // $this->load->view('admin/template/header');
        // $this->load->view('admin/loan_company_master/add');
        // $this->load->view('admin/template/footer');
    }
    public function loan_company_master_edit($id)
    {
        if (!has_permission('Self Bank Login')  && $this->session->userdata('type') != 'admin') {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
        }
        // $data['datas'] = $this->Dashboard_Model->common_all('category');
        $data['datas'] = $this->Dashboard_Model->common_row($id, 'loan_company_master');
        $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
        $this->load->view('admin/template/header');
        $this->load->view('admin/loan_company_master/edit', $data);
        $this->load->view('admin/template/footer');
    }

    public function loan_company_master_update()
    {
        if (!has_permission('Self Bank Login')  && $this->session->userdata('type') != 'admin') {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
        }
        $post = $this->input->post();

        if ($_FILES["image"]["size"] > 0) {
            $tmpFilePath = $_FILES['image']['tmp_name'];
            $fileinfo = @getimagesize($_FILES["image"]["tmp_name"]);
            $image_file_type = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
            $newFilePath = 'upload/assets/video/' . time() . '.' . $image_file_type;
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                $post['image'] = $newFilePath;
            }
        }

        if ($_FILES["document"]["size"] > 0) {
            $tmpFilePath = $_FILES['document']['tmp_name'];
            $fileinfo = @getimagesize($_FILES["document"]["tmp_name"]);
            $image_file_type = pathinfo($_FILES["document"]["name"], PATHINFO_EXTENSION);
            $newFilePath = 'upload/assets/video/' . time() . '.' . $image_file_type;
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                $post['document'] = $newFilePath;
            }
        }

        if ($_FILES["pincode_document"]["size"] > 0) {
            $tmpFilePath = $_FILES['pincode_document']['tmp_name'];
            $fileinfo = @getimagesize($_FILES["pincode_document"]["tmp_name"]);
            $image_file_type = pathinfo($_FILES["pincode_document"]["name"], PATHINFO_EXTENSION);
            $newFilePath = 'upload/assets/video/' . time() . '.' . $image_file_type;
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                $post['pincode_document'] = $newFilePath;
            }
        }

        $id = $post['id'];
        unset($post['id']);
        $update = $this->Dashboard_Model->common_update($id, $post, 'loan_company_master');
        if ($update) {
            redirect('admin/loan-company-master');
        } else {
            redirect('admin/loan-company-master-update');
        }
    }

    public function loan_company_master_delete($id)
    {
        if (!has_permission('Self Bank Login')  && $this->session->userdata('type') != 'admin') {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
        }
        // Load the model
        // $this->load->model('update_status_loan');
        $this->Dashboard_Model->update_status_loan($id);
        redirect('admin/loan-company-master');
    }

    public function loan_lead_list()
    {
    if (!has_permission('Bank Wise Login') && $this->session->userdata('type') != 'admin') {
        $this->session->set_flashdata('message', 'You do not have permission to access this section.');
        redirect('admin-dashboard');
        return;
    }

        $domain_id = domain_id_get();
        $user_id = $this->session->userdata('user_id');
        if ($this->session->userdata('role') == 1) {
           $data['loan'] = $this->db->where(array('status !=' => 2))->where(array('domain_id' => $domain_id))->get('loan_lead_new')->result();
        } else {
            $data['loan'] = $this->db->where(array('status' => 1, 'user_id' => $user_id,'domain_id' => $domain_id))->get('loan_lead_new')->result();
        }
        $this->load->view('admin/template/header');
        $this->load->view('admin/loan_lead_new/list', $data);
        $this->load->view('admin/template/footer');
    }

    public function loan_lead_create()
    {
        if (!has_permission('Bank Wise Login')  && $this->session->userdata('type') != 'admin') {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
        }
        $data['banker'] = $this->Dashboard_Model->loan_company_master_get();
        $this->load->view('admin/template/header');
        $this->load->view('admin/loan_lead_new/add', $data);
        $this->load->view('admin/template/footer');
    }
    public function loan_lead_edit($id)
    {
        if (!has_permission('Bank Wise Login')  && $this->session->userdata('type') != 'admin') {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
        }
        $data['datas'] = $this->Dashboard_Model->common_row($id, 'loan_lead_new');
        $this->load->view('admin/template/header');
        $this->load->view('admin/loan_lead_new/edit', $data);
        $this->load->view('admin/template/footer');
    }

    public function loan_type_list($id)
    {
        if (!has_permission('Bank Wise Login')  && $this->session->userdata('type') != 'admin') {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
        }
        $data['datas'] = $this->Dashboard_Model->common_row($id, 'loan_lead_new');
        // $type = $_GET['type'];
        // $data['datas'] = $this->db->where(array('status' => 1, 'loan_type' => $type))->get('loan_company_master')->result();
        // print_r($id);die;
        // $this->load->view('admin/loan_lead_new/loan_type_list', $data);
        $this->load->view('admin/template/header');
        $this->load->view('admin/loan_lead_new/view', $data);
        $this->load->view('admin/template/footer');
    }

    public function loan_lead_created()
    {
        $data = $this->input->post();
        $data['user_id'] = $this->session->userdata('user_id');
        $data['role'] = $this->session->userdata('role');
        $insert = $this->Dashboard_Model->common_insert($data, 'loan_lead_new');
        if ($insert) {
            redirect('admin/loan-lead-list');
            $this->session->set_flashdata('message', 'Created Successfully');
        } else {
            redirect('admin/loan-lead-create');
            $this->session->set_flashdata('message', 'Oh!, Somthing Went Wrong ');
        }
    }

    public function loan_lead_updated()
    {
        $post = $this->input->post();
        $id = $post['id'];
        unset($post['id']);
        $update = $this->Dashboard_Model->common_update($id, $post, 'loan_lead_new');
        if ($update) {
            redirect('admin/loan-lead-list');
            $this->session->set_flashdata('message', 'Updated Successfully');
        } else {
            redirect($_SERVER['HTTP_REFERER']);
            $this->session->set_flashdata('message', 'Oh!, Somthing Went Wrong ');
        }
    }

    public function loan_lead_delete($id)
    {

        $delete = $this->db->where('id', $id)->update('loan_lead_new', array('satus' => 2));
        if ($delete) {
            $this->session->set_flashdata('success', 'Category Data Update Successfully!!');
            redirect('category');
        } else {
            $this->session->set_flashdata('error', 'Something Went Wrong, try again!!');
            redirect('category');
        }
    }

    public function loan_type_created()
    {
        $post = $this->input->post();
        $id = $post['id'];
        unset($post['id']);
        $data['user_id'] = $this->session->userdata('user_id');
        $data['role'] = $this->session->userdata('role');

        $insert = $this->Dashboard_Model->common_update($id, $post, 'loan_lead_new');
        if ($insert) {
            redirect('admin/loan-lead-list');
            $this->session->set_flashdata('message', 'Created Successfully');
        } else {
            redirect('admin/loan-lead-create');
            $this->session->set_flashdata('message', 'Oh!, Somthing Went Wrong ');
        }
    }

    public function qr_code()
    {
        // $type = $_GET['type'];
        // $data['datas'] = $this->db->where(array('status' => 1, 'loan_type' => $type))->get('loan_company_master')->result();
        // print_r($data['datas']);die;

        $this->load->view('admin/template/header');
        $this->load->view('admin/loan/qr_code_share');
        $this->load->view('admin/template/footer');
    }

    public function assign_lead()
    {
        $post = $this->input->post();

        $update = $this->db->where('id', $post['id'])->update('loan_master', array('user_id' => $post['user_id']));
      if ($update) {
            redirect('admin/loan');
            $this->session->set_flashdata('message', 'Assign Successfully');
        } else {
            redirect('admin/loan');
            $this->session->set_flashdata('message', 'Oh!, Somthing Went Wrong ');
        }

    }

public function user_all_leads(){
    $post = $this->input->post();
    $data = $this->db->where('id', $post['value'])->get('leads')->row_array();
    echo json_encode($data);
}

public function roles()
    { 
        if ($this->session->userdata('type') != 'admin') {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            }
        $data['roles'] = $this->db->get('roles')->result_array();
        // echo '<pre>';print_r($data['roles']);die;       
        $this->load->view('admin/template/header');
        $this->load->view('admin/roles/index', $data);
        $this->load->view('admin/template/footer');
    }
    public function rolesAdd()
    {
        if ($this->session->userdata('type') != 'admin') {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            }
        // $data['bank_data'] = $this->Dashboard_Model->bank_list();
        $this->load->view('admin/template/header');
        $this->load->view('admin/roles/create');
        $this->load->view('admin/template/footer');
    }
    public function rolesCreate()
    {
        if ($this->session->userdata('type') != 'admin') {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            }

        $post = $this->input->post();
        // $this->form_validation->set_rules('permission_name', 'permission_name', 'required|trim');
        

        $data = array(
            'permission' => $post['permission_name'],
            'parent_id' => $post['parent_id'] ?? NULL,
            // 'user_id' => $post['user'],
            // 'made_by' => $this->session->userdata('user_id'),
        );
        
        $insert = $this->Dashboard_Model->common_insert($data, 'roles');
    
        if ($insert) {
            $this->session->set_flashdata('success', 'Role has been Created Successfully!!');
            redirect('admin/roles');
        } else {
        $this->session->set_flashdata('error', 'Something Went Wrong, try again!!');
        redirect('admin/roles-add');
        }
    }
    public function rolesEdit($id)
    {
        if ($this->session->userdata('type') != 'admin') {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            }
        $data['datas'] = $this->Dashboard_Model->common_row($id, 'roles');
        $data['roles'] = $this->db->get('roles')->result_array();
        
        // echo "<pre>";print_r($data['datas']);die;
        $this->load->view('admin/template/header');
        $this->load->view('admin/roles/edit', $data);
        $this->load->view('admin/template/footer');
    }

    public function rolesUpdate()
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
            'permission' => $post['permission_name'],
            'parent_id' => $post['parent_id'] ?? NULL,
        );
        // echo "<pre>";print_r($data);die;
        $update = $this->Dashboard_Model->common_update($id, $data, 'roles');
        if ($update) {
            redirect('admin/roles');
        } else {
            redirect('admin/roles-update');
        }
    }
    public function rolesDel($id)
    { 
        if ($this->session->userdata('type') != 'admin') {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            }
        $roles_del = $this->db->where('id', $id)->delete('roles');
        if ($roles_del) {
            $this->session->set_flashdata('success', 'Role deleted successfully');
            redirect('admin/roles');
        } else {
            $this->session->set_flashdata('error', 'Something went wrong, try again!!');
            redirect('admin/roles');
        }
    }


    public function qr(){

        if (!has_permission('Pages') || !has_permission('Qr payment')) {
    
        if ($this->session->userdata('type') != 'admin') {
        $this->session->set_flashdata('message', 'You do not have permission to access this section.');
        redirect('admin-dashboard');
        return;
        }
        }
            if (isset($_GET['domain_id']) && (int)$_GET['domain_id']) {
            $data['datas'] = $this->db->where('domain_id',$_GET['domain_id'])->get('qr')->row_array();
        }else {
            $data['datas'] = $this->db->where('domain_id', domain_id_get())->get('qr')->row_array();
            }
        $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();

        
        $this->load->view('admin/template/header');
        $this->load->view('admin/qr/edit', $data);
        $this->load->view('admin/template/footer');
    }

    public function qrUpdate()
    {
        if (!has_permission('Pages') || !has_permission('Qr payment')) {
        
        if ($this->session->userdata('type') != 'admin') {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
        }
            }
            $background_img = $this->input->post('old_qr_image');
            $config['upload_path'] = './assets/images/contect-us';
            $config['allowed_types'] = 'jpg|jpeg|png|gif|bmp|tiff|jfif';
            $config['max_size'] = 2048;
            $config['encrypt_name'] = TRUE; 
            $this->upload->initialize($config);

            if ($this->upload->do_upload('qr_image')) {
                $upload_data = $this->upload->data();
                $background_img = $upload_data['file_name'];
            }
            // print_r($background_img);die;

        $id = $this->input->post('id');
        $post = $this->input->post();
        $data['datas'] = $this->db->where('domain_id',$post['domain_id'])->get('qr')->row_array();
        if($data['datas']){
        
        $id = $post['id'];
        
        $data = array(
            'bank_name' => $post['bank_name'],
            'account_number' => $post['account_number'],
            'ifsc' => $post['ifsc'],
            'upi' => $post['upi'],
            'g_id' => $post['g_id'],
            'p_id' => $post['p_id'],
            'heading' => $post['heading'],
            'bg_color' => $post['bg_color'],
            'qr_image' => $background_img,
            'user_id' => $this->session->userdata('user_id'),
        );
        $update = $this->Dashboard_Model->common_update($id, $data, 'qr');
        $this->session->set_flashdata('success', 'QR and Bank Update successfully');
            redirect('admin/qr');
    }else{
        $data = array(
            'bank_name' => $post['bank_name'],
            'account_number' => $post['account_number'],
            'ifsc' => $post['ifsc'],
            'upi' => $post['upi'],
            'qr_image' => $background_img,
            'domain_id' => $post['domain_id'],
            'heading' => $post['heading'],
            'bg_color' => $post['bg_color'],
            'user_id' => $this->session->userdata('user_id'),
        );
        $insert = $this->Dashboard_Model->common_insert($data, 'qr');
        $this->session->set_flashdata('success', 'QR and Bank Add successfully');
            redirect('admin/qr');
        
    }
    }

    public function smtp(){

            if (!has_permission('Permission') && !has_permission('Email configuration')) {
                if ($this->session->userdata('type') != 'admin') {
                    $this->session->set_flashdata('message', 'You do not have permission to access this section.');
                    redirect('admin-dashboard');
                    return;
                }
            }
        if (isset($_GET['domain_id']) && (int)$_GET['domain_id']) {
            $data['datas'] = $this->db->where('domain_id',$_GET['domain_id'])->get('email_config')->row_array();
        }else {
            $data['datas'] = $this->db->where('domain_id', domain_id_get())->get('email_config')->row_array();
            }
        $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();

        
        $this->load->view('admin/template/header');
        $this->load->view('admin/smtp/edit', $data);
        $this->load->view('admin/template/footer');
    }

   public function smtpUpdate()
{
    if (!has_permission('Permission') && !has_permission('Email configuration')) {
                if ($this->session->userdata('type') != 'admin') {
                    $this->session->set_flashdata('message', 'You do not have permission to access this section.');
                    redirect('admin-dashboard');
                    return;
                }
            }
    $post = $this->input->post();

    // Check if email_config exists for this domain
    $config_data = $this->db
        ->where('domain_id', $post['domain_id'])
        ->get('email_config')
        ->row_array();

    // Prepare data according to email_config table
    $data = array(
        'smtp_host'  => $post['smtp_host'],
        'smtp_port'  => $post['smtp_port'],
        'smtp_user'  => $post['smtp_user'],
        'smtp_pass'  => $post['smtp_pass'],
        'from_email' => $post['from_email'],
        'domain_id'  => $post['domain_id'],
        'updated_at' => date("Y-m-d H:i:s"),
    );

    if ($config_data) {
        // Update existing config
        $id = $config_data['id'];
        $this->Dashboard_Model->common_update($id, $data, 'email_config');
        $this->session->set_flashdata('success', 'SMTP updated successfully');
    } else {
        // Insert new config
        $data['created_at'] = date("Y-m-d H:i:s");
        $this->Dashboard_Model->common_insert($data, 'email_config');
        $this->session->set_flashdata('success', 'SMTP added successfully');
    }

    redirect('admin/smtp');
}


// Dsa agent detail

        public function dsaagentdetail()
        {
            if (!has_permission('Pages') ) {
			
            if ($this->session->userdata('type') != 'admin') {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return; 
            }
        }

            if (isset($_GET['domain_id']) && (int)$_GET['domain_id']) {
                $data['dsaagentdetail'] = $this->db->where('domain_id',$_GET['domain_id'])->get('dsaagentdetail')->row_array();
            }else {
                $data['dsaagentdetail'] = $this->db->where('domain_id', domain_id_get())->get('dsaagentdetail')->row_array();
            }
            $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
            // echo '<pre>';print_r($data['dsaagentdetail'] );die;

            $this->load->view('admin/template/header');
            $this->load->view('admin/dsaagentdetail/edit', $data);
            $this->load->view('admin/template/footer');
        }
    

        
        public function dsaagentdetailUpdate()
{
    // Permission check
    if (!has_permission('Pages')) {
        if ($this->session->userdata('type') != 'admin') {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
        }
    }

    $post = $this->input->post();

    $data = array(
        'leftheading'      => $post['leftheading'],
        'rightheading'     => $post['rightheading'],
        'description'      => $post['description'],
        'leftdescription'  => $post['leftdescription'],
        'rightdescription' => $post['rightdescription'],
        'domain_id'        => $post['domain_id'],
        'user_id'          => $this->session->userdata('user_id'),
    );

    // Check if record already exists
    $existingData = $this->db->where('domain_id', $post['domain_id'])->get('dsaagentdetail')->row_array();

    $uploaded_images = [];

    // Loop through uploaded files
    if (!empty($_FILES['image']['name'][0])) {
        for ($i = 0; $i < count($_FILES['image']['name']); $i++) {
            if ($_FILES["image"]["size"][$i] > 0) {
                $tmpFilePath = $_FILES['image']['tmp_name'][$i];
                $fileinfo = @getimagesize($tmpFilePath);
                $image_file_type = pathinfo($_FILES["image"]["name"][$i], PATHINFO_EXTENSION);

                $newFilePath = 'assets/images/plantinumBanner/' . time() . '_' . $i . '.' . $image_file_type;

                if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                    $uploaded_images[] = $newFilePath;
                }
            }
        }
    }

    // If new images uploaded → merge with old ones
    if (!empty($uploaded_images)) {
        if (!empty($existingData['image'])) {
            $old_images = json_decode($existingData['image'], true);
            if (!is_array($old_images)) {
                $old_images = [];
            }
            $merged_images   = array_merge($old_images, $uploaded_images);
            $data['image']   = json_encode($merged_images);
        } else {
            $data['image'] = json_encode($uploaded_images);
        }
    } else {
        // No new upload → keep old images
        if (!empty($existingData['image'])) {
            $data['image'] = $existingData['image'];
        } else {
            $data['image'] = null;
        }
    }

    // Insert / Update
    if ($existingData) {
        $id     = $existingData['id'];
        $update = $this->Dashboard_Model->common_update($id, $data, 'dsaagentdetail');
    } else {
        $insert = $this->Dashboard_Model->common_insert($data, 'dsaagentdetail');
    }

    $this->session->set_flashdata('success', 'DSA agent updated successfully');
    redirect('admin/dsaagentdetail');
}



// branchdetail

        public function branchAgentDetail()
        {
           if (($this->session->userdata('type') == 'admin') || (has_permission('Pages') &&  has_permission('branch franchise registration') && has_permission('branch agent detail'))) {
		
               if (isset($_GET['domain_id']) && (int)$_GET['domain_id']) {
                   $data['branchAgentDetail'] = $this->db->where('domain_id',$_GET['domain_id'])->get('branchAgentDetail')->row_array();
               }else {
                   $data['branchAgentDetail'] = $this->db->where('domain_id', domain_id_get())->get('branchAgentDetail')->row_array();
               }
               $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
               // echo '<pre>';print_r($data['branchAgentDetail'] );die;
       
               $this->load->view('admin/template/header');
               $this->load->view('admin/branchAgentDetail/edit', $data);
               $this->load->view('admin/template/footer');
			
           }else{
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
            
        }

        }
    

        
        public function branchAgentDetailUpdate()
{
    if (($this->session->userdata('type') == 'admin') || 
        (has_permission('Pages') && has_permission('branch franchise registration') && has_permission('branch agent detail'))) {
        
        $post = $this->input->post();

        $data = array(
            'leftheading'      => $post['leftheading'],
            'rightheading'     => $post['rightheading'],
            'description'      => $post['description'],
            'leftdescription'  => $post['leftdescription'],
            'rightdescription' => $post['rightdescription'],
            'domain_id'        => $post['domain_id'],
            'user_id'          => $this->session->userdata('user_id'),
        );

        // Fetch existing record
        $existingData = $this->db->where('domain_id', $post['domain_id'])->get('branchAgentDetail')->row_array();

        $uploaded_images = [];

        // Loop through uploaded files
        if (!empty($_FILES['image']['name'][0])) {
            for ($i = 0; $i < count($_FILES['image']['name']); $i++) {
                if ($_FILES["image"]["size"][$i] > 0) {
                    $tmpFilePath = $_FILES['image']['tmp_name'][$i];
                    $fileinfo = @getimagesize($tmpFilePath);
                    $image_file_type = pathinfo($_FILES["image"]["name"][$i], PATHINFO_EXTENSION);

                    $newFilePath = 'assets/images/plantinumBanner/' . time() . '_' . $i . '.' . $image_file_type;

                    if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                        $uploaded_images[] = $newFilePath;
                    }
                }
            }
        }

        // If new images uploaded → merge with old ones
        if (!empty($uploaded_images)) {
            if (!empty($existingData['image'])) {
                $old_images = json_decode($existingData['image'], true);
                if (!is_array($old_images)) {
                    $old_images = [];
                }
                $merged_images = array_merge($old_images, $uploaded_images);
                $data['image'] = json_encode($merged_images);
            } else {
                $data['image'] = json_encode($uploaded_images);
            }
        } else {
            // No new upload → keep old images
            if (!empty($existingData['image'])) {
                $data['image'] = $existingData['image'];
            } else {
                $data['image'] = null;
            }
        }

        // Insert / Update
        if ($existingData) {
            $id     = $existingData['id'];
            $update = $this->Dashboard_Model->common_update($id, $data, 'branchAgentDetail');
        } else {
            $insert = $this->Dashboard_Model->common_insert($data, 'branchAgentDetail');
        }

        $this->session->set_flashdata('success', 'Branch agent detail updated successfully');
        redirect('admin/branchAgentDetail');

    } else {
        $this->session->set_flashdata('message', 'You do not have permission to access this section.');
        redirect('admin-dashboard');
        return;
    }
}


public function deleteBranchAgentImage()
{
    $domain_id = $this->input->post('domain_id');
    $id = $this->input->post('id');
    $image_path = $this->input->post('image_path');

    $record = $this->db->where('domain_id', $domain_id)->where('id', $id)->get('branchAgentDetail')->row_array();
    if($record && !empty($record['image'])) {
        $images = json_decode($record['image'], true);
        if(($key = array_search($image_path, $images)) !== false) {
            unset($images[$key]);
            $images = array_values($images); // reindex array

            $this->db->where('id', $id)->where('domain_id', $domain_id)
                     ->update('branchAgentDetail', ['image' => json_encode($images)]);

            // Optional: delete file physically
            if(file_exists($image_path)) {
                unlink($image_path);
            }

            echo json_encode(['status' => 'success']);
            return;
        }
    }

    echo json_encode(['status' => 'error']);
}


public function deleteDsaAgentImage()
{
    $domain_id = $this->input->post('domain_id');
    $id = $this->input->post('id');
    $image_path = $this->input->post('image_path');

    $record = $this->db->where('domain_id', $domain_id)->where('id', $id)->get('dsaagentdetail')->row_array();
    if($record && !empty($record['image'])) {
        $images = json_decode($record['image'], true);
        if(($key = array_search($image_path, $images)) !== false) {
            unset($images[$key]);
            $images = array_values($images); // reindex array

            $this->db->where('domain_id', $domain_id)->where('id', $id)
                     ->update('dsaagentdetail', ['image' => json_encode($images)]);

            // Optional: delete file physically
            if(file_exists($image_path)) {
                unlink($image_path);
            }

            echo json_encode(['status' => 'success']);
            return;
        }
    }

    echo json_encode(['status' => 'error']);
}




public function lead_transferForm()
{    
	 if ((has_permission('Pages') && has_permission('lead dashboard') && has_permission('Admin settings') || $this->session->userdata('type') == 'admin')) {
			$this->form_validation->set_rules('url', 'url', 'required|trim');
	//$this->form_validation->set_rules('sub_title', 'Sub Title', 'required|trim');
	$this->form_validation->set_rules('status', 'Status', 'required|trim');
	
	if($this->form_validation->run()) {
			
			$data['url'] = $this->input->post('url');
			$data['status']  = $this->input->post('status');
			$data['domain_id']  = $this->input->post('domain_id');
		   
			$insert = $this->Dashboard_Model->common_insert($data,'leadtransfer');
			
				if($insert) {
					$this->session->set_flashdata('success','Leads Data Insert Successfully!!');
					redirect('admin/add-lead-transfer');
				} else {
					$this->session->set_flashdata('error','Something Went Wrong, try again!!');
					redirect('admin/add-lead-transfer');
				}
		} else {
			
		    $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
		    $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
			$this->load->view('admin/template/header');
			$this->load->view('admin/lead_transfer/form',$data);
			$this->load->view('admin/template/footer');   
		}
	 }else{
		$this->session->set_flashdata('message', 'You do not have permission to access this section.');
		redirect('admin-dashboard');
		return;
	}
	
}

public function lead_transfer()
{    
	 if ((has_permission('Pages') && has_permission('lead dashboard') && has_permission('Admin settings') || $this->session->userdata('type') == 'admin')) {
        	$domain_id = domain_id_get();

         $data['datas'] = $this->db->where( array('domain_id' => $domain_id))->get('leadtransfer')->result();

        if (isset($_GET['domain_id']) && (int)$_GET['domain_id']) {
            $data['heading'] = $this->Dashboard_Model->common_rows('leads','settings', $_GET['domain_id']);  
        }else {
            $data['heading'] = $this->Dashboard_Model->common_rows('leads','settings', $domain_id);  
        }
	
	 $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
	 $this->load->view('admin/template/header');
	 $this->load->view('admin/lead_transfer/view',$data);
	 $this->load->view('admin/template/footer');   
			
    }else{
		$this->session->set_flashdata('message', 'You do not have permission to access this section.');
		redirect('admin-dashboard');
		return;
	
		}
}
public function lead_transferEdit($id)
{    
	 if ((has_permission('Pages') && has_permission('lead dashboard') && has_permission('Admin settings') || $this->session->userdata('type') == 'admin')) {
         $data['datas'] = $this->Dashboard_Model->common_row($id,'leadtransfer');
	    $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
		 $this->load->view('admin/template/header');
		 $this->load->view('admin/lead_transfer/edit',$data);
		 $this->load->view('admin/template/footer');   
			
	 }else{
		$this->session->set_flashdata('message', 'You do not have permission to access this section.');
		redirect('admin-dashboard');
		return;
		
		}
}
public function lead_transferUpdate()
{
	  if ((has_permission('Pages') && has_permission('lead dashboard') && has_permission('Admin settings') || $this->session->userdata('type') == 'admin')) {	
		 $this->form_validation->set_rules('url', 'url', 'required|trim');
		 $this->form_validation->set_rules('status', 'Status', 'required|trim');
		 $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');
		
		 if($this->form_validation->run()) {

				 $id = $this->input->post('id');
				 $data['url'] = $this->input->post('url');
				 $data['status']  = $this->input->post('status');
				 $data['domain_id']  = $this->input->post('domain_id');
				 $data['created_at']  = date('d m Y H:i:s'); 
				
				 $update = $this->Dashboard_Model->common_update($id,$data,'leadtransfer');
				 
					 if($update) {
						 $this->session->set_flashdata('success','lead Data update Successfully!!');
						 redirect('admin/lead_transfer');
					 } else {
						 $this->session->set_flashdata('error','Something Went Wrong, try again!!');
						 redirect('admin/lead_transfer');
					 }
			 } else {
				 $this->load->view('admin/template/header');
				 $this->load->view('admin/lead_transfer/form');
				 $this->load->view('admin/template/footer');   
			 }
			
     }else{
		$this->session->set_flashdata('message', 'You do not have permission to access this section.');
		redirect('admin-dashboard');
		return;
	}
}
public function lead_transferDelete($id)
{   
	  if ((has_permission('Pages') && has_permission('lead dashboard') && has_permission('Admin settings') || $this->session->userdata('type') == 'admin')) {
		
			
			  $delete = $this->Dashboard_Model->common_delete($id,'leadtransfer');
				if($delete) {
					$this->session->set_flashdata('success','Lead data delete successfully');
					redirect('admin/lead_transfer');
				} else {
					$this->session->set_flashdata('error','Something Went Wrong');
					redirect('admin/lead_transfer');
				}
			
	 }else{
		$this->session->set_flashdata('message', 'You do not have permission to access this section.');
		redirect('admin-dashboard');
		return;
		
		}
}
public function lead_transferStatusUpdate()
{
    // Check permission
     if ((has_permission('Pages') && has_permission('lead dashboard') && has_permission('Admin settings') || $this->session->userdata('type') == 'admin')) {

        $id = $this->input->post('id');
        $status = $this->input->post('status');

        // Get current record
        $lead = $this->db->where('id', $id)->get('leadtransfer')->row();

        if ($lead) {
            $domain_id = $lead->domain_id;

            // If activating this one, deactivate all others in same domain
            if ($status == 1) {
                $this->db->where('domain_id', $domain_id)
                         ->where('id !=', $id)
                         ->update('leadtransfer', ['status' => 0]);
            }

            // Now update selected record
            $data = ['status' => $status];
            $update = $this->Dashboard_Model->common_update($id, $data, 'leadtransfer');

            echo $update ? 'success' : 'error';
        } else {
            echo 'invalid';
        }

    } else {
        $this->session->set_flashdata('message', 'You do not have permission to access this section.');
        redirect('admin-dashboard');
        return;
    }
}


  public function send_mail($email, $subject, $message)
{
    $ci =& get_instance();
    $ci->load->database();
    $ci->load->library('email');

    $domain_id = domain_id_get();

    if (!$domain_id) {
        log_message('error', 'Domain not found in domains table');
        return false;
    }

    $config_row = $ci->db
        ->where('domain_id', $domain_id)
        ->get('email_config')
        ->row_array();

    if (!$config_row) {
        log_message('error', 'Email configuration not found for domain_id: ' . $domain_id);
        return false;
    }

    // Sanitize and validate recipient
    $email = trim($email);
    if (stripos($email, 'Unpaid--') === 0 || stripos($email, 'Deleted--') === 0) {
        $parts = explode('--', $email, 2);
        $email = isset($parts[1]) ? trim($parts[1]) : '';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        log_message('error', 'Invalid recipient email after sanitization: ' . print_r($email, true));
        return false;
    }

    $config = array(
        'protocol'  => 'smtp',
        'smtp_host' => $config_row['smtp_host'], // live.smtp.mailtrap.io
        'smtp_port' => $config_row['smtp_port'], // 587
        'smtp_user' => $config_row['smtp_user'], // api
        'smtp_pass' => $config_row['smtp_pass'], // your API token
        'mailtype'  => 'html',
        'charset'   => 'utf-8',
        'wordwrap'  => TRUE,
        'newline'   => "\r\n",       // important for Mailtrap
        'crlf'      => "\r\n",       // important for Mailtrap
        'smtp_timeout' => 30,
        'smtp_crypto'  => 'tls',     // important for Mailtrap
    );

    $ci->email->initialize($config);

    $ci->email->from($config_row['from_email'], $config_row['from_name']);
    $ci->email->to($email);
    $ci->email->subject($subject);
    $ci->email->message($message);

    if ($ci->email->send()) {
        log_message('info', 'Email successfully sent to: ' . $email);
        return true;
    } else {
        $error = $ci->email->print_debugger(['headers']);
        log_message('error', 'Email failed to send. Error: ' . $error);
        return false;
    }
}

public function marketingDataList()
{

    if (!has_permission('Marketing material & Sales Data')  && !has_permission('Marketing data'))  {
        if($this->session->userdata('type') != 'admin'){
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
        }
    }

    $domain_id = domain_id_get();

    $datas['datas'] = $this->db
        ->where('status', 1)
        ->where(array('domain_id' => $domain_id))
        ->where(($this->session->userdata('role') != 1) ? array('user_id' => $this->session->userdata('user_id')) : array())
        ->order_by('id', 'DESC')
        ->get('marketing_data')
        ->result();

    $this->load->view('admin/template/header');
    $this->load->view('admin/marketing_data/list', $datas);
    $this->load->view('admin/template/footer');
}

public function marketingDataEdit($id)
{
     if (!has_permission('Marketing material & Sales Data')  && !has_permission('Marketing data'))  {
        if($this->session->userdata('type') != 'admin'){
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
        }
    }

    $domain_id = domain_id_get();

    $datas['datas'] = $this->db
        ->where('status', 1)
        ->where(($this->session->userdata('type') != 'admin') ? array('domain_id' => $domain_id) : array())
        ->order_by('id', 'DESC')
        ->get('marketing_data')
        ->result();
        
    $this->load->view('admin/template/header');
    $this->load->view('admin/marketing_data/list', $datas);
    $this->load->view('admin/template/footer');
}

public function marketingDataAdd()
{
    if (!has_permission('Marketing material & Sales Data')  && !has_permission('Marketing data'))  {
        if($this->session->userdata('type') != 'admin'){
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
        }
    }

    $domain_id = ($this->session->userdata('type') == 'admin')
                 ? null 
                 : domain_id_get();
    if ($domain_id != null) {
        $data = $this->getUsersByDomain($domain_id);

        $data['whatsapp_transfers'] = $this->db->where('status',1)->where('domain_id',$domain_id)->get('whatsapp_transfer')->result_array();

    } else {
        $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
        $data['users'] = [];
        $data['branch'] = [];
        $data['team'] = [];
        $data['admin'] = [];
        $data['whatsapp_transfers'] = [];
    }

    $this->load->view('admin/template/header');
    $this->load->view('admin/marketing_data/add', $data);
    $this->load->view('admin/template/footer');
}

private function getUsersByDomain($domain_id)
{
    $user_type = $this->db->where('domain_id',$domain_id)->where('type','subadmin')->get('user_master')->row_array();

    $data['dsa'] = $this->db
        ->where('status', 1)
        ->where('role', 2)
        ->where('domain_id', $domain_id)
        ->group_start()
            ->where('parent_id', '')
            ->or_where('parent_id', 0)
            ->or_where('parent_id IS NULL', null, false)
        ->group_end()
        ->get('user_master')
        ->result();

    // echo '<pre>';print_r( $data['dsa']);die;        

    $data['branch'] = $this->db
        ->where('status', 1)
        ->where('role', 3)
        ->where('domain_id', $domain_id)
        ->get('branch_franchise')->result();

    $data['admin'] = $this->db
        ->where('status', 1)
        ->where('role', 1) 
        ->where('type', 'subadmin') 
        ->where('domain_id', $domain_id)
        ->get('user_master')->result();

    $data['team'] = $this->db
        ->where('status', 1)
        ->where('role', 2)
        ->where(($this->session->userdata('type') != 'admin') ? array('parent_id' => $user_type['id']) : array('parent_id' => 1))
        // ->where('parent_id',1)
        ->where('domain_id', $domain_id)
        ->get('user_master')->result();

    return $data;

}

public function marketingDataStore()
{
    if (!has_permission('Marketing material & Sales Data')  && !has_permission('Marketing data'))  {
        if($this->session->userdata('type') != 'admin'){
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
        }
    }

    $domain_id    = $this->input->post('domain_id');
    $user_id      = $this->input->post('user_id');
    $user_role_id = $this->input->post('user_role_id');
    $remark       = $this->input->post('remark');
    $date         = $this->input->post('date');

     if (!empty($_FILES['documents']['name'])) {
    $config['upload_path']   = './upload/assets/images/';
    $config['allowed_types'] = '*'; 
    $config['max_size']      = 512000;
    $config['remove_spaces'] = TRUE;
    $config['encrypt_name']  = TRUE; 
    if (!is_dir($config['upload_path'])) {
        mkdir($config['upload_path'], 0777, true);
    }

    $this->load->library('upload', $config);
    $this->upload->initialize($config);

    if ($this->upload->do_upload('documents')) {
        $uploadData = $this->upload->data();
        $documents  = $uploadData['file_name'];
    } else {
        $error = $this->upload->display_errors();
        $this->session->set_flashdata('imgerror', $error);
        redirect('admin/marketing-data-add', 'refresh');
    }
}


    $data = [
        'domain_id'    => $domain_id,
        'user_id'      => $user_id,
        'user_role_id' => $user_role_id,
        'remark'       => $remark,
        'documents'    => $documents,
        'status'       => 1,
        'created_at'   => date('Y-m-d H:i:s'),
    ];

    $insert = $this->db->insert('marketing_data', $data);

    if ($insert) {
        $this->session->set_flashdata('success', 'Marketing data added successfully!');
    } else {
        $this->session->set_flashdata('error', 'Something went wrong, try again!');
    }

    redirect('admin/marketing-data');
}

public function getUsersByDomainAjax()
{
    $domain_id = $this->input->post('domain_id');
    $data = $this->getUsersByDomain($domain_id);

    echo json_encode($data);
}

   public function marketingDataDelete($id)
    {
        $delete = $this->Dashboard_Model->common_delete($id, 'marketing_data');
        if ($delete) {
            $this->session->set_flashdata('success', 'Marketing Data delete Successfully!!');
            redirect('admin/marketing-data');
        } else {
            $this->session->set_flashdata('error', 'Something Went Wrong, try again!!');
            redirect('admin/marketing-data');
        }
    }


    
/**
 * Get WhatsApp transfers by domain ID
 */
public function get_whatsapp_transfers_by_domain() {
    $domain_id = $this->input->post('domain_id');
    $response = array('status' => false, 'data' => array());
    
    if ($domain_id) {
        $this->db->where('domain_id', $domain_id);
        $this->db->where('status', 1); // Only active transfers
        $query = $this->db->get('whatsapp_transfer');
        
        if ($query->num_rows() > 0) {
            $response['status'] = true;
            $response['data'] = $query->result();
        }
    }
    
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

public function marketingWhatsappForm()
{  
    if ((has_permission('Marketing WhatsApp software') && has_permission('Marketing material & Sales Data')) || $this->session->userdata('type') == 'admin') {
        $this->form_validation->set_rules('user_name', 'user_name', 'required|trim');
        $this->form_validation->set_rules('password', 'password', 'required|trim');
    
        if($this->form_validation->run()) {
            $data['user_name'] = $this->input->post('user_name');
            $data['password'] = $this->input->post('password');
            $data['user_id'] = $this->input->post('user_id');
            $data['user_role_id'] = $this->input->post('user_role_id');
            $data['domain_id'] = $this->input->post('domain_id');
           
            $insert = $this->Dashboard_Model->common_insert($data, 'marketing_whatsapp');
            
            if($insert) {
                $this->session->set_flashdata('success', 'Marketing WhatsApp software Inserted Successfully!!');
                redirect('admin/marketing-whatsapp');
            } else {
                $this->session->set_flashdata('error', 'Something Went Wrong, try again!!');
                redirect('admin/add-marketing-whatsapp');
            }
        } else {
            $domain_id = $this->session->userdata('type') == 'admin' ? null : domain_id_get();
            $data['domains'] = $this->db->where('status', 1)->get('domains')->result_array();
            
            // Load WhatsApp transfers if domain is set
            if ($domain_id) {
                $this->db->where('domain_id', $domain_id);
                $this->db->where('status', 1);
                $data['whatsapp_transfers'] = $this->db->get('whatsapp_transfer')->result();
            } else {
                $data['whatsapp_transfers'] = array();
            }
            
            $this->load->view('admin/template/header');
            $this->load->view('admin/marketing_whatsapp/form', $data);
            $this->load->view('admin/template/footer');   
        }
    } else {
        $this->session->set_flashdata('message', 'You do not have permission to access this section.');
        redirect('admin-dashboard');
        return;
    }
}

public function marketingWhatsapp()
{    
	 if ((has_permission('Marketing WhatsApp software') && has_permission('Marketing material & Sales Data')) || $this->session->userdata('type') == 'admin') {
        	$domain_id = domain_id_get();

         $data['datas'] = $this->db->where( array('domain_id' => $domain_id))->get('marketing_whatsapp')->result();

        if (isset($_GET['domain_id']) && (int)$_GET['domain_id']) {
            $data['heading'] = $this->Dashboard_Model->common_rows('marketing_whatsapp','settings', $_GET['domain_id']);  
        }else {
            $data['heading'] = $this->Dashboard_Model->common_rows('marketing_whatsapp','settings', $domain_id);  
        }
	
	 $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
	 $this->load->view('admin/template/header');
	 $this->load->view('admin/marketing_whatsapp/view',$data);
	 $this->load->view('admin/template/footer');   
			
    }else{
		$this->session->set_flashdata('message', 'You do not have permission to access this section.');
		redirect('admin-dashboard');
    }}


public function marketingWhatsappEdit($id)
{
    if ((has_permission('Marketing WhatsApp software') && has_permission('Marketing material & Sales Data')) || $this->session->userdata('type') == 'admin') {
        $data['data'] = $this->Dashboard_Model->common_row($id, 'marketing_whatsapp');
        
        if (empty($data['data'])) {
            show_404();
        }
        
        $data['domains'] = $this->db->where('status', 1)->get('domains')->result_array();
        $domain_id = $data['data']->domain_id;
        $this->load->view('admin/template/header');
        $this->load->view('admin/marketing_whatsapp/edit', $data);
        $this->load->view('admin/template/footer');
    } else {
        $this->session->set_flashdata('message', 'You do not have permission to access this section.');
        redirect('admin-dashboard');
    }
}

public function marketingWhatsappUpdate()
{

     if ((has_permission('Marketing WhatsApp software') && has_permission('Marketing material & Sales Data')) || $this->session->userdata('type') == 'admin') {
       
		 $this->form_validation->set_rules('status', 'Status', 'required|trim');
		 $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');
		
		 if($this->form_validation->run()) {

				 $id = $this->input->post('id');
				 $data['user_role_id']  = $this->input->post('user_role_id');
				 $data['user_id']  = $this->input->post('user_id');
				 $data['domain_id']  = $this->input->post('domain_id');
				 $data['user_name'] = $this->input->post('user_name');
				 $data['password'] = $this->input->post('password');
				 $data['status']  = $this->input->post('status');
				 $data['created_at']  = date('d m Y H:i:s'); 
				
				 $update = $this->Dashboard_Model->common_update($id,$data,'marketing_whatsapp');
				 
					 if($update) {
						 $this->session->set_flashdata('success','lead Data update Successfully!!');
						 redirect('admin/marketing-whatsapp');
					 } else {
						 $this->session->set_flashdata('error','Something Went Wrong, try again!!');
						 redirect('admin/marketing-whatsapp');
					 }
			 } else {
				 $this->load->view('admin/template/header');
				 $this->load->view('admin/marketing_whatsapp/form');
				 $this->load->view('admin/template/footer');   
			 }
			
     }else{
		$this->session->set_flashdata('message', 'You do not have permission to access this section.');
}
}

public function marketingWhatsappDelete($id)
{   
    if ((has_permission('Marketing WhatsApp software') && has_permission('Marketing material & Sales Data')) || $this->session->userdata('type') == 'admin') {
        
        $delete = $this->Dashboard_Model->common_delete($id,'marketing_whatsapp');
        if($delete) {
            $this->session->set_flashdata('success','Lead data delete successfully');
            redirect('admin/marketing-whatsapp');
        } else {
            $this->session->set_flashdata('error','Something Went Wrong');
            redirect('admin/marketing-whatsapp');
        }
        
    }else{
        $this->session->set_flashdata('message', 'You do not have permission to access this section.');
        redirect('admin-dashboard');
        return;
        
    }
}

public function marketingWhatsappCredentials($id)
{
    $data['credential'] = $this->Dashboard_Model->common_row($id, 'marketing_whatsapp');
    
    if (empty($data['credential'])) {
        show_404();
    }
    
    // Get domain details
    $data['domain'] = $this->db->where('id', $data['credential']->domain_id)->get('domains')->row_array();
    
    // Get user details based on role
    if ($data['credential']->user_role_id == 3) {
        $data['user'] = $this->db->where('id', $data['credential']->user_id)->get('branch_franchise')->row();
    } else {
        $data['user'] = $this->db->where('id', $data['credential']->user_id)->get('user_master')->row();
    }
    $data['whatsapp_transfer'] = $this->db->where('domain_id',$data['credential']->domain_id)->where('status',1)->get('whatsapp_transfer')->row();
    $data['heading'] = $this->db->where('domain_id',$data['credential']->domain_id)->where('type','marketing_whatsapp')->get('settings')->row();
    
    
    // Load the view
    $this->load->view('admin/template/header');
    $this->load->view('admin/marketing_whatsapp/credentials_view', $data);
    $this->load->view('admin/template/footer');
}

public function whatsapp_transferForm()
{    
    if ((has_permission('Marketing WhatsApp software') && has_permission('Marketing material & Sales Data')) || $this->session->userdata('type') == 'admin') {
        $this->form_validation->set_rules('url', 'url', 'required|trim');
        $this->form_validation->set_rules('status', 'Status', 'required|trim');
    
        if($this->form_validation->run()) {
            $data['url'] = $this->input->post('url');
            $data['status']  = $this->input->post('status');
            $data['domain_id']  = $this->input->post('domain_id');
           
            $insert = $this->Dashboard_Model->common_insert($data,'whatsapp_transfer');
            
            if($insert) {
                $this->session->set_flashdata('success','Leads Data Inserted Successfully!!');
                redirect('admin/whatsapp_transfer');
            } else {
                $this->session->set_flashdata('error','Something Went Wrong, try again!!');
                redirect('admin/whatsapp_transfer');
            }
        } else {
            $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
            $this->load->view('admin/template/header');
            $this->load->view('admin/whatsapp_transfer/form',$data);
            $this->load->view('admin/template/footer');   
        }
    } else {
        $this->session->set_flashdata('message', 'You do not have permission to access this section.');
        redirect('admin-dashboard');
        return;
    }
}

public function whatsapp_transfer()
{    
	 if ((has_permission('Marketing WhatsApp software') && has_permission('Marketing material & Sales Data')) || $this->session->userdata('type') == 'admin') {
        	$domain_id = domain_id_get();

         $data['datas'] = $this->db->where(($this->session->userdata('type') != 'admin') ? array('domain_id' => $domain_id) : array())->get('whatsapp_transfer')->result();

        if (isset($_GET['domain_id']) && (int)$_GET['domain_id']) {
            $data['heading'] = $this->Dashboard_Model->common_rows('marketing_whatsapp','settings', $_GET['domain_id']);  
        }else {
            $data['heading'] = $this->Dashboard_Model->common_rows('marketing_whatsapp','settings', $domain_id);  
        }
	
	 $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
	 $this->load->view('admin/template/header');
	 $this->load->view('admin/whatsapp_transfer/view',$data);
	 $this->load->view('admin/template/footer');   
			
    }else{
		$this->session->set_flashdata('message', 'You do not have permission to access this section.');
		redirect('admin-dashboard');
		return;
	
		}
}
public function whatsapp_transferEdit($id)
{    
	 if ((has_permission('Marketing WhatsApp software') && has_permission('Marketing material & Sales Data')) || $this->session->userdata('type') == 'admin') {
         $data['datas'] = $this->Dashboard_Model->common_row($id,'whatsapp_transfer');
	    $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
		 $this->load->view('admin/template/header');
		 $this->load->view('admin/whatsapp_transfer/edit',$data);
		 $this->load->view('admin/template/footer');   
			
	 }else{
		$this->session->set_flashdata('message', 'You do not have permission to access this section.');
		redirect('admin-dashboard');
		return;
		
		}
}
public function whatsapp_transferUpdate()
{
	  if ((has_permission('Marketing WhatsApp software') && has_permission('Marketing material & Sales Data')) || $this->session->userdata('type') == 'admin') {	
		 $this->form_validation->set_rules('url', 'url', 'required|trim');
		 $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');
		
		 if($this->form_validation->run()) {

				 $id = $this->input->post('id');
				 $data['url'] = $this->input->post('url');
				 $data['domain_id']  = $this->input->post('domain_id');
				 $data['created_at']  = date('d m Y H:i:s'); 
				
				 $update = $this->Dashboard_Model->common_update($id,$data,'whatsapp_transfer');
				 
					 if($update) {
						 $this->session->set_flashdata('success','Marketing WhatsApp software update Successfully!!');
						 redirect('admin/whatsapp_transfer');
					 } else {
						 $this->session->set_flashdata('error','Something Went Wrong, try again!!');
						 redirect('admin/whatsapp_transfer');
					 }
			 } else {
				 $this->load->view('admin/template/header');
				 $this->load->view('admin/whatsapp_transfer/form');
				 $this->load->view('admin/template/footer');   
			 }
			
     }else{
		$this->session->set_flashdata('message', 'You do not have permission to access this section.');
		redirect('admin-dashboard');
		return;
	}
}
public function whatsapp_transferDelete($id)
{   
	  if ((has_permission('Marketing WhatsApp software') && has_permission('Marketing material & Sales Data')) || $this->session->userdata('type') == 'admin') {
		
			
			  $delete = $this->Dashboard_Model->common_delete($id,'whatsapp_transfer');
				if($delete) {
					$this->session->set_flashdata('success','Marketing WhatsApp software delete successfully');
					redirect('admin/whatsapp_transfer');
				} else {
					$this->session->set_flashdata('error','Something Went Wrong');
					redirect('admin/whatsapp_transfer');
				}
			
	 }else{
		$this->session->set_flashdata('message', 'You do not have permission to access this section.');
		redirect('admin-dashboard');
		return;
		
		}
}
public function whatsapp_transferStatusUpdate()
{
    // Check permission
     if ((has_permission('Marketing WhatsApp software') && has_permission('Marketing material & Sales Data')) || $this->session->userdata('type') == 'admin') {

        $id = $this->input->post('id');
        $status = $this->input->post('status');

        // Get current record
        $lead = $this->db->where('id', $id)->get('whatsapp_transfer')->row();

        if ($lead) {
            $domain_id = $lead->domain_id;

            // If activating this one, deactivate all others in same domain
            if ($status == 1) {
                $this->db->where('domain_id', $domain_id)
                         ->where('id !=', $id)
                         ->update('whatsapp_transfer', ['status' => 0]);
            }

            // Now update selected record
            $data = ['status' => $status];
            $update = $this->Dashboard_Model->common_update($id, $data, 'whatsapp_transfer');

            echo $update ? 'success' : 'error';
        } else {
            echo 'invalid';
        }

    } else {
        $this->session->set_flashdata('message', 'You do not have permission to access this section.');
        redirect('admin-dashboard');
        return;
    }
}

public function getWhatsappTransferByDomainAjax()
{
    $domain_id = $this->input->post('domain_id');
    $whatsapp_transfers = $this->db->where('status', 1)->where('domain_id', $domain_id)->get('whatsapp_transfer')->result_array();
    // print_r($this->db->last_query());
    echo json_encode($whatsapp_transfers);
}

    public function dsa_agreement(){

        if (!has_permission('permission') && !has_permission('agreement dsa')) {
    
        if ($this->session->userdata('type') != 'admin') {
        $this->session->set_flashdata('message', 'You do not have permission to access this section.');
        redirect('admin-dashboard');
        return;
        }
        }
            if (isset($_GET['domain_id']) && (int)$_GET['domain_id']) {
            $data['datas'] = $this->db->where('domain_id',$_GET['domain_id'])->where('type','dsa_agreement')->get('agreement')->row_array();
        }else {
            $data['datas'] = $this->db->where('domain_id', domain_id_get())->where('type','dsa_agreement')->get('agreement')->row_array();
            }
        $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();

        
        $this->load->view('admin/template/header');
        $this->load->view('admin/agreement/agreement_dsa', $data);
        $this->load->view('admin/template/footer');
    }

    public function branch_agreement()
    {

     if (!has_permission('permission') && !has_permission('agreement branch')) {
    
        if ($this->session->userdata('type') != 'admin') {
        $this->session->set_flashdata('message', 'You do not have permission to access this section.');
        redirect('admin-dashboard');
        return;
        }
        }
        if (isset($_GET['domain_id']) && (int)$_GET['domain_id']) {
            $data['datas'] = $this->db->where('domain_id',$_GET['domain_id'])->where('type','branch_agreement')->get('agreement')->row_array();
        }else {
            $data['datas'] = $this->db->where('domain_id', domain_id_get())->where('type','branch_agreement')->get('agreement')->row_array();
        }
        $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
        
        
        $this->load->view('admin/template/header');
        $this->load->view('admin/agreement/agreement_branch', $data);
        $this->load->view('admin/template/footer');
    }

    public function agreementUpdate()
    {
        if (!has_permission('permission') && !has_permission('agreement dsa') && !has_permission('agreement branch')) {
        
        if ($this->session->userdata('type') != 'admin') {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
        }
            }
            
        $id = $this->input->post('id');
        $post = $this->input->post();
        $data['datas'] = $this->db->where('domain_id',$post['domain_id'])->where('type',$post['type'])->get('agreement')->row_array();
        if($data['datas']){
        
        $id = $post['id'];
        
        $data = array(
            'heading' => $post['heading'],
            'content' => $post['content'],
            'domain_id' => $post['domain_id'],
            'user_id' => $this->session->userdata('user_id'),
        );
        $update = $this->Dashboard_Model->common_update($id, $data, 'agreement');
        $this->session->set_flashdata('success', ' Agreement Update successfully');
        if($post['type'] == 'dsa_agreement'){
            redirect('admin/dsa-agreement');
        }else{
            redirect('admin/branch-agreement');
        }
        }else{
            $data = array(
                'heading' => $post['heading'],
                'content' => $post['content'],  
                'domain_id' => $post['domain_id'],
                'type' => $post['type'],
                'user_id' => $this->session->userdata('user_id'),
            );
            $insert = $this->Dashboard_Model->common_insert($data, 'agreement');
            $this->session->set_flashdata('success', ' Agreement Add successfully');
            if($post['type'] == 'dsa_agreement'){
                redirect('admin/dsa-agreement');
            }else{
                redirect('admin/branch-agreement');
            }
            
        }
    }

    public function agreement($user_id='',$role_id='')
    {
        if (!empty($role_id)) {
            $role = $role_id;
        }else{
            $role = $this->session->userdata('role');
        }
        
        if($role == 3){
            $data['agreement'] = $this->db->where('domain_id', domain_id_get())->where('type','branch_agreement')->get('agreement')->row_array();
        }else{
            $data['agreement'] = $this->db->where('domain_id', domain_id_get())->where('type','dsa_agreement')->get('agreement')->row_array();
        }
        $this->load->view('admin/template/header');
        $this->load->view('admin/page/agreement', $data);
        $this->load->view('admin/template/footer');
    }


public function accessDenied()
{
// echo 'hii';die;
    $this->load->view('admin/template/header');
    $this->load->view('admin/page/access_denied');
    $this->load->view('admin/template/footer');
}
private function checkDomainAccess()
{
    $currentDomain = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http")
                    . "://" . $_SERVER['HTTP_HOST'] . '/';

    $domainData = $this->db->where('url', $currentDomain)->get('domains')->row();

    if (!$domainData || $domainData->status != 1) {
        redirect('admin/access-denied');
        exit;
    }
}


// In Dashboard.php controller, add this method
public function update_agreement_status() {
    $response = array('status' => 0, 'message' => '');
    
    $user_id = $this->input->post('user_id');
    $role_id = $this->input->post('role_id');
    $status = $this->input->post('agreement_status'); // 1 for approved, 0 for rejected
    $notes = $this->input->post('agreement_note');
    $updated_by = $this->session->userdata('user_id');
    
    $data = array(
        'agreement_status' => $status,
        'agreement_note' => $notes,
        'agreement_approved_by' => $updated_by,
        'agreement_date' => date('Y-m-d H:i:s')
    );
    
    if($role_id == 3) {
        $this->db->where('id', $user_id)->update('branch_franchise', $data);
    } else {
        $this->db->where('id', $user_id)->update('user_master', $data);
    }
    
    if($this->db->affected_rows() > 0) {
        $response['status'] = 1;
        $response['message'] = 'Agreement status updated successfully';
    } else {
        $response['message'] = 'Failed to update agreement status';
    }
    
    echo json_encode($response);
}

public function loanEnquiry()
{
    if ($this->session->userdata('type') != 'admin' && !has_permission('Loan Enquiry')) {
        $this->session->set_flashdata('message', 'You do not have permission to access this section.');
        redirect('admin-dashboard');
        return;
    }

    $domain_id = domain_id_get();
    $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
    $data['datas'] = $this->db
    ->where(array('domain_id' => $domain_id))
    ->where(($this->session->userdata('role') != 1) ? array('team_id' =>$this->session->userdata('user_id')) : array())
    ->get('loan_enquiry_tbl')->result();

    $data['heading'] = $this->Dashboard_Model->common_rows('loan_enquiry','settings', $domain_id); 
    $this->load->view('admin/template/header');
    $this->load->view('admin/page/loan_enquiry', $data);
    $this->load->view('admin/template/footer');
}

public function delete_loan_enquiry($id)
{
    // Check if user has permission
    if ($this->session->userdata('type') != 'admin' && !has_permission('Loan Enquiry')) {
        echo json_encode(['status' => 'error', 'message' => 'You do not have permission to perform this action']);
        return;
    }

    // Check if the record exists
    $query = $this->db->where('id', $id);
    
    // If not admin, also check domain ownership
    if ($this->session->userdata('type') != 'admin') {
        $query->where('domain_id', domain_id_get());
    }
    
    $record = $query->get('loan_enquiry_tbl')->row();
    
    if (!$record) {
        echo json_encode(['status' => 'error', 'message' => 'Record not found or you do not have permission to delete it']);
        return;
    }

    // Delete the record
    $this->db->where('id', $id)->delete('loan_enquiry_tbl');
    
    if ($this->db->affected_rows() > 0) {
        echo json_encode(['status' => 'success', 'message' => 'Loan enquiry deleted successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to delete loan enquiry']);
    }
}

public function governmentServices()
{
  
    if ($this->session->userdata('type') != 'admin' && !has_permission('Government Services')) {
        $this->session->set_flashdata('message', 'You do not have permission to access this section.');
        redirect('admin-dashboard');
        return;
    }

    $domain_id = domain_id_get();
    $data['datas'] = $this->db->where(array('domain_id' => $domain_id))->where(($this->session->userdata('role') != 1) ? array('team_id' =>$this->session->userdata('user_id')) : array())->get('government_services_tbl')->result();
    $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
     $data['heading'] = $this->Dashboard_Model->common_rows('government_services','settings', $domain_id); 
    $this->load->view('admin/template/header');
    $this->load->view('admin/page/government_services', $data);
    $this->load->view('admin/template/footer');
}

public function delete_government_service($id)
{
    // Check if user has permission
    if ($this->session->userdata('type') != 'admin' && !has_permission('Government Services')) {
        echo json_encode(['status' => 'error', 'message' => 'You do not have permission to perform this action']);
        return;
    }

    // Check if the record exists
    $query = $this->db->where('id', $id);
    
    // If not admin, also check domain ownership
    if ($this->session->userdata('type') != 'admin') {
        $query->where('domain_id', domain_id_get());
    }
    
    $record = $query->get('government_services_tbl')->row();
    
    if (!$record) {
        echo json_encode(['status' => 'error', 'message' => 'Record not found or you do not have permission to delete it']);
        return;
    }

    // Delete the record
    $this->db->where('id', $id)->delete('government_services_tbl');
    
    if ($this->db->affected_rows() > 0) {
        echo json_encode(['status' => 'success', 'message' => 'Record deleted successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to delete record']);
    }
}

 public function government_services_assign_user(){
         $team_id = $this->input->post('team_id');
         $id = $this->input->post('enquiry_id');
        $status = $this->db->where(['id' => $id])->update('government_services_tbl', ['team_id' => $team_id , 'parent_user'=> $this->session->userdata('id')]);
         echo json_encode([
            'status' => 'success',
            'team_id' => $team_id,
        ]);
      
    }


public function brandLoan()
{
  
    if ($this->session->userdata('type') != 'admin' && !has_permission('Brand loan')) {
        $this->session->set_flashdata('message', 'You do not have permission to access this section.');
        redirect('admin-dashboard');
        return;
    }

    $domain_id = domain_id_get();
    $data['datas'] = $this->db->where(array('domain_id' => $domain_id))->where(($this->session->userdata('role') != 1) ? array('team_id' =>$this->session->userdata('user_id')) : array())->get('brand_loan_tbl')->result();
    $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
     $data['heading'] = $this->Dashboard_Model->common_rows('brand_loan','settings', $domain_id); 
    $this->load->view('admin/template/header');
    $this->load->view('admin/page/brand_loan', $data);
    $this->load->view('admin/template/footer');
}

public function delete_brand_loan($id)
{
    // Check if user has permission
    if ($this->session->userdata('type') != 'admin' && !has_permission('Brand loan')) {
        echo json_encode(['status' => 'error', 'message' => 'You do not have permission to perform this action']);
        return;
    }

    // Check if the record exists
    $query = $this->db->where('id', $id);
    
    // If not admin, also check domain ownership
    if ($this->session->userdata('type') != 'admin') {
        $query->where('domain_id', domain_id_get());
    }
    
    $record = $query->get('brand_loan_tbl')->row();
    
    if (!$record) {
        echo json_encode(['status' => 'error', 'message' => 'Record not found or you do not have permission to delete it']);
        return;
    }

    // Delete the record
    $this->db->where('id', $id)->delete('brand_loan_tbl');
    
    if ($this->db->affected_rows() > 0) {
        echo json_encode(['status' => 'success', 'message' => 'Record deleted successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to delete record']);
    }
}

 public function brand_loan_assign_user(){
         $team_id = $this->input->post('team_id');
         $id = $this->input->post('enquiry_id');
        $status = $this->db->where(['id' => $id])->update('brand_loan_tbl', ['team_id' => $team_id , 'parent_user'=> $this->session->userdata('id')]);
         echo json_encode([
            'status' => 'success',
            'team_id' => $team_id,
        ]);
      
    }

// CIBIL Score Check Module
public function cibilScoreCheck()
{
//      $sql = "ALTER TABLE cibil_score_links ADD domain_id INT(11) NULL ";
//  $this->db->query($sql);
//  echo "Column added successfully!";

    if ($this->session->userdata('type') != 'admin' && !has_permission('CIBIL Score Check')) {
       $this->session->set_flashdata('message', 'You do not have permission to access this section.');
        redirect('admin-dashboard');
        return;
    }
    $domain_id = domain_id_get();
    $data['cibil_links'] = $this->db->where( array('domain_id' => $domain_id))->get('cibil_score_links')->result();
    $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
    $this->load->view('admin/template/header');
    $this->load->view('admin/cibil_score_check/list', $data);
    $this->load->view('admin/template/footer');
}

public function addCibilLink()
{
    // echo '<pre>';print_r($this->input->post());die;
    if ($this->session->userdata('type') != 'admin' && !has_permission('CIBIL Score Check')) {
        $this->session->set_flashdata('message', 'You do not have permission to access this section.');
        redirect('admin-dashboard');
        return;
    }

    $this->form_validation->set_rules('title', 'Title', 'required|trim');
    $this->form_validation->set_rules('url', 'URL', 'required|trim|valid_url');

    if ($_FILES['image']['name'] != "") {
        $config['upload_path'] = './upload/assets/images/';
        $config['max_size'] = 1024;
        $config['allowed_types'] = 'jpg|jpeg|png';
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        
        if ($this->upload->do_upload('image')) {
            $uploadImg = $this->upload->data();
            $image = $uploadImg['file_name'];
        } else {
            $ierror = $this->upload->display_errors();
            $this->session->set_flashdata('imgerror', $ierror);
            redirect('admin/cibil-score-check', 'refresh');
        }
    }

    $data = [
        'title' => $this->input->post('title'),
        'url' => $this->input->post('url'),
        'domain_id' => $this->input->post('domain_id'),
        'image' => $image,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
    ];

    $this->db->insert('cibil_score_links', $data);
    $insert_id = $this->db->insert_id();

    if($insert_id){
        $this->session->set_flashdata('success', 'Cibil score add successfully');
         redirect('admin/cibil-score-check');
    }else{
        $this->session->set_flashdata('error', 'Cibil score add successfully');
         redirect('admin/cibil-score-check');
    }

}

public function deleteCibilLink($id)
{
    if ($this->session->userdata('type') != 'admin' && !has_permission('CIBIL Score Check')) {
        $this->session->set_flashdata('message', 'You do not have permission to access this section.');
        redirect('admin-dashboard');
        return;
    }

    // Get the image path before deleting
    $link = $this->db->where('id', $id)->get('cibil_score_links')->row();
    
    if ($link) {
        // Delete the image file if it exists
        if (!empty($link->image) && file_exists(FCPATH . $link->image)) {
            unlink(FCPATH . $link->image);
        }
        
        // Delete the record from database
        $this->db->where('id', $id)->delete('cibil_score_links');
        
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Cibil score deleted successfully');
            redirect('admin/cibil-score-check');
        } else {
            $this->session->set_flashdata('error', 'Something went wrong');
            redirect('admin/cibil-score-check');
        }
    } else {
       $this->session->set_flashdata('error', 'Something went wrong');
         redirect('admin/cibil-score-check');
    }
}

    public function instanloankyc()
    {
        if ($this->session->userdata('type') != 'admin' && !has_permission('Instant Loans Kyc')) {
        $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
        }

        $domain_id = domain_id_get();
        $rows = $this->db
        ->where(array('domain_id' => $domain_id))
        ->where(($this->session->userdata('role') != 1) ? array('user_id' => $this->session->userdata('user_id')) : array())
        ->get('indiasale_tbl')
        ->result();
        foreach ($rows as $r) {
            if ($r->user_id_role == 3) {
                $user = $this->db->select('name')->where('id', $r->user_id)->get('branch_franchise')->row();
            } else {
                $user = $this->db->select('name')->where('id', $r->user_id)->get('user_master')->row();
            }
            $r->user_id = $user->name ?? '';
        }
        $data['datas'] = $rows;
        $data['domains'] = $this->db->where('status',1)->get('domains')->result_array();
        if (isset($_GET['domain_id']) && (int)$_GET['domain_id']) {
            $d = $_GET['domain_id'];
        }else{
            if($this->session->userdata('type') == 'admin') {
                $a =  $this->db->where('status',1)->get('domains')->row_array();
                $d  =$a['id'];
            }else{
                 $d = domain_id_get();
            }
        }
        // print_r($d);die;
        $data['domain_name'] = $this->db->where('id',$d)->get('domains')->row_array();
        $data['indiasale_team_link'] = $this->db->where('domain_id',domain_id_get())->where('status',1)->where('user_id',$this->session->userdata('user_id'))->where('user_id_role',$this->session->userdata('role'))->get('indiasale_user_links')->row_array();
        $this->load->view('admin/template/header');
        $this->load->view('admin/page/indiasale', $data);
        $this->load->view('admin/template/footer');
    }

    public function addInstanLoan()
    {
        if ($this->session->userdata('type') != 'admin' && !has_permission('Instant Loans Kyc')) {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
        }
        
        $prevErrLevel = error_reporting();
        error_reporting($prevErrLevel & ~E_DEPRECATED & ~E_NOTICE);
        ini_set('display_errors', '0');
        $this->load->library('excel');
        
        if (isset($_FILES["files"]["name"])) {
            $user_id = $this->input->post('user_id');
            $user_role_id = $this->input->post('user_role_id');
            $domain_id = domain_id_get();
            $parent = $this->db->where('id', $this->session->userdata('user_id'))->get('user_master')->row();
           
            if ($this->session->userdata('role') == 1 || $parent->parent_id_role == 1 ) {
                $expectedHeaders = [
                    'Member ID', 'Member Type', 'Member Name', 'Lead ID', 'Lead Creation Date',
                    'Customer Phone', 'Customer Name', 'Product Name', 'productInfo.code', 'Lead Status',
                    'Lead Sub Status', 'Lead Remarks', 'Date of Sale', 'Product Redirect URL','Approved', 'Reject', 'Pending', 'disburshment'
                ];
            }else {
                $expectedHeaders = [
                    'Member ID', 'Member Type', 'Member Name', 'Lead ID', 'Lead Creation Date',
                    'Customer Phone', 'Customer Name', 'Product Name', 'productInfo.code', 'Lead Status',
                    'Lead Sub Status', 'Lead Remarks', 'Date of Sale', 'Product Redirect URL'
                ];
            }

           
            
            $path = $_FILES["files"]["tmp_name"];
            try {
                $object = PHPExcel_IOFactory::load($path);
                $worksheet = $object->getActiveSheet();
                
                // Validate headers
                $headerRow = [];
                $highestColumn = $worksheet->getHighestColumn();
                $columnCount = PHPExcel_Cell::columnIndexFromString($highestColumn);
                
                // Read first row as headers
                for ($col = 0; $col < $columnCount; $col++) {
                    $headerRow[] = trim($worksheet->getCellByColumnAndRow($col, 1)->getValue());
                }
                // Check if headers match exactly
                if ($headerRow !== $expectedHeaders) {
                    $this->session->set_flashdata('error', 'Invalid file format. Please upload the Excel file using the provided sample template only.');
                    redirect('admin/instanloankyc');
                    return;
                }
                
                // Delete existing records
                // $this->db->where('user_id', $user_id);
                // $this->db->where('user_id_role', $user_role_id);
                // $this->db->where('domain_id', $domain_id);
                // $this->db->delete('indiasale_tbl');
                
                $highestRow = $worksheet->getHighestRow();
                
                for ($row = 2; $row <= $highestRow; $row++) {
                    $e = [];
                    for ($col = 0; $col < count($expectedHeaders); $col++) {
                        $e[] = $worksheet->getCellByColumnAndRow($col, $row)->getValue();
                    }
                    if (!empty($e[0])) {
                        $data = [
                            'member_id' => $e[0],
                            'member_type' => $e[1],
                            'member_name' => $e[2],
                            'lead_id' => $e[3],
                            'lead_creation_date' => $e[4],
                            'customer_phone' => $e[5],
                            'customer_name' => $e[6],
                            'product_name' => $e[7],
                            'product_infocode' => $e[8],
                            'lead_status' => $e[9],
                            'lead_sub_status' => $e[10],
                            'lead_remarks' => $e[11],
                            'date_of_sale' => $e[12],
                            'product_redirect_url' => $e[13],
                            'domain_id' => $domain_id,
                            'user_id' => $user_id,
                            'user_id_role' => $user_role_id,
                        ];
                        
                        // Add approval columns only for admin users
                        if ($this->session->userdata('role') == 1 || $parent->parent_id_role == 1 ) {
                            if (count($e) > 14) {
                                $approved = strtolower(trim($e[14]));
                                $reject   = strtolower(trim($e[15]));
                                if ($approved == 'yes' && $reject == 'no') {
                                    $data['status'] = '1'; // approved
                                } 
                                elseif ($approved == 'no' && $reject == 'yes') {
                                    $data['status'] = '2'; // reject
                                } 
                                else {
                                    $data['status'] = '0'; // pending
                                }
                                $data['lead_description'] = $e[16];
                                $data['disbursed'] = $e[17];
                            }
                        }
                    //   echo '<pre>';  print_r($data);
                        $this->db->insert('indiasale_tbl', $data);
                    }
                }
                
                $this->session->set_flashdata('success', 'Data uploaded successfully');
            } catch (Exception $e) {
                $this->session->set_flashdata('error', 'Error processing file: ' . $e->getMessage());
            }
        } else {
            $this->session->set_flashdata('error', 'No file was uploaded');
        }
        
        redirect('admin/instanloankyc');
    }

    public function deleteInstanloan($id)
    {
         if ($this->session->userdata('type') != 'admin' && !has_permission('Instant Loans Kyc')) {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
        }
        $link = $this->db->where('id', $id)->get('indiasale_tbl')->row();
        
        if ($link) {
            $this->db->where('id', $id)->delete('indiasale_tbl');
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data deleted successfully');
                redirect('admin/instanloankyc');
            } else {
                $this->session->set_flashdata('error', 'Something went wrong');
                redirect('admin/instanloankyc');
            }
        } else {
        $this->session->set_flashdata('error', 'Something went wrong');
            redirect('admin/instanloankyc');
        }
    }

      public function indiasaleupdate($id)
    {
        if ($this->session->userdata('type') != 'admin' && !has_permission('Instant Loans Kyc')) {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
        }
        $loan_del = $this->Dashboard_Model->common_update($id,
            array(
                'disbursed' => $this->input->post('disbursed'),
                'payout' => $this->input->post('payout'),
                'bankModal' => $this->input->post('bankModal'),
                'payment_amount_paid' => $this->input->post('payment_amount_paid'),
                'sanction' => $this->input->post('sanction'),
                'status'=> $this->input->post('status') ?? 0,
                ),
            'indiasale_tbl');
        if ($loan_del) {
            $this->session->set_flashdata('success', 'data updated');
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            $this->session->set_flashdata('error', 'Something Went Wrong, try again!!');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function team_id_card($id)
    {
        
        if ($this->session->userdata('type') != 'admin' && !has_permission('id-card-user')) {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
        }
        $domain_id = domain_id_get();
        $data['contactUs'] = $this->db->where(array('domain_id' => $domain_id))->get('contect_us')->row_array();
        $data['id_card'] = $this->db->where('id',$id)->get('user_master')->row_array();
        $data['domains'] = $this->db->where('id',$domain_id)->get('domains')->row_array();
        $this->load->view('admin/team_document/id_card', $data);
    }
    public function team_offer_letter($id){
        
        if ($this->session->userdata('type') != 'admin' && !has_permission('Offer-letter-user')) {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
        }
        $domain_id = domain_id_get();
        $data['contactUs'] = $this->db->where(array('domain_id' => $domain_id))->get('contect_us')->row_array();
        $data['offer_letter'] = $this->db->where('id',$id)->get('user_master')->row_array();
        $data['domains'] = $this->db->where('id',$domain_id)->get('domains')->row_array();
        $data['joiningLetter'] = $this->db->where(array('domain_id' => $domain_id))->get('joining_letter')->row_array();
        $this->load->view('admin/team_document/offer_letter', $data);
    }
    
    public function team_offer_pdf_letter($id){
        if ($this->session->userdata('type') != 'admin' && !has_permission('Offer-letter-user')) {
            $this->session->set_flashdata('message', 'You do not have permission to access this section.');
            redirect('admin-dashboard');
            return;
        }
        $domain_id = domain_id_get();
        $data['contactUs'] = $this->db->where(array('domain_id' => $domain_id))->get('contect_us')->row_array();
        $data['offer_letter'] = $this->db->where('id',$id)->get('user_master')->row_array();
        $data['domains'] = $this->db->where('id',$domain_id)->get('domains')->row_array();
        $data['joiningLetter'] = $this->db->where(array('domain_id' => $domain_id))->get('joining_letter')->row_array();
          $this->load->library('pdf');
        $paper = 'A4';
        $orientation = 'landscape';
        $this->pdf->folder('assets/pdf/');
        $filename = 'offer-letter.pdf';
        $this->pdf->filename($filename);
        $this->pdf->paper($paper, $orientation);
        $this->pdf->html($this->load->view('admin/team_document/offer_letter_pdf', $data, true));
        if ($this->pdf->create('save')) {
            $this->output->set_content_type('application/pdf')->set_output(file_get_contents('assets/pdf/' . $filename));
        }
        $this->pdf->create('download');
        // $this->load->view('admin/team_document/offer_letter_pdf', $data);
    }

   public function get_admin_users()
    {
        $domain_id = $this->input->post('domain_id');
        $users = $this->db->where('parent_id_role',1)->where('status',1)->where('subscription','')->where('domain_id', $domain_id)->get('user_master')->result_array();
        echo json_encode([
            'status' => 'success',
            'users'  => $users
        ]);
    }

    public function assign_user(){
         $team_id = $this->input->post('team_id');
         $id = $this->input->post('enquiry_id');
        $status = $this->db->where(['id' => $id])->update('loan_enquiry_tbl', ['team_id' => $team_id , 'parent_user'=> $this->session->userdata('id')]);
         echo json_encode([
            'status' => 'success',
            'team_id' => $team_id,
        ]);
      
    }
    
    public function assign_link_to_indiasale(){
        $domain_id = $this->input->post('domain_id');
        $link = $this->input->post('indiasale_team_link');
        $user_id = $this->input->post('user_id') ?? 0;
        $role = $this->input->post('role') ?? 0;
        $exists = $this->db->where([
            'user_id'      => $user_id,
            'domain_id'    => $domain_id,
            'user_id_role' => $role
        ])
        ->get('indiasale_user_links')
        ->row();

        if(!empty($exists)){
            $status = $this->db->where(['id' => $exists->id])->update('indiasale_user_links', ['link' => $link, 'user_id' => $user_id ,'user_id_role'=> $role,'domain_id' => $domain_id]);
        }else {
            $status = $this->db->insert('indiasale_user_links', [
                'user_id'       => $user_id,
                'user_id_role'  => $role,
                'domain_id'     => $domain_id,
                'link'          => $link,
                'status'        => 1
            ]);
        }
         if ($status) {
                $this->session->set_flashdata('success', 'URLUpdate  Successfully!!');
                redirect('admin/instanloankyc');
            } else {
                $this->session->set_flashdata('error', 'Something Went Wrong, try again!!');
                redirect('admin/instanloankyc');
            }
      
    }
    
    public function get_indiasale_link()
{
    $domain_id    = $this->input->post('domain_id');
    $user_id      = $this->input->post('user_id');
    $user_id_role = $this->input->post('user_id_role');

    $row = $this->db
        ->where('domain_id', $domain_id)
        ->where('user_id', $user_id)
        ->where('user_id_role', $user_id_role)
        ->where('status', 1)
        ->get('indiasale_user_links')
        ->row_array();

    if (!empty($row)) {
        echo json_encode([
            'status' => 'success',
            'link'   => $row['link']
        ]);
    } else {
        echo json_encode([
            'status' => 'error'
        ]);
    }
}


}

