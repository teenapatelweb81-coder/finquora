<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>DASHBOARD</title>
      <meta name="description" content="">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="robots" content="all,follow">
      <!-- Bootstrap CSS-->
      <link rel="stylesheet" href="<?php echo base_url(); ?>upload/admin/vendor/bootstrap/css/bootstrap.min.css">
      <!-- Font Awesome CSS-->
      <link rel="stylesheet" href="<?php echo base_url(); ?>upload/admin/vendor/font-awesome/css/font-awesome.min.css">
      <!-- Fontastic Custom icon font-->
      <link rel="stylesheet" href="<?php echo base_url(); ?>upload/admin/css/fontastic.css">
      <!-- Google fonts - Poppins -->
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">
      <!-- theme stylesheet-->
      <link rel="stylesheet" href="<?php echo base_url(); ?>upload/admin/css/style.green.css" id="theme-stylesheet">
      <!-- Custom stylesheet - for your changes-->
      <!-- <link rel="stylesheet" href="<?php echo base_url(); ?>upload/admin/css/custom.css"> -->
      <!-- Favicon-->
      <link rel="shortcut icon" href="<?php //echo base_url();?>upload/admin/img/favicon.ico">
      <link rel="stylesheet" href="<?php echo base_url(); ?>upload/admin/css/admin.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="//cdn.ckeditor.com/4.14.1/full/ckeditor.js"></script>
      <!-- Google Font: Source Sans Pro -->
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="<?php echo base_url(); ?>upload/admin/plugins/fontawesome-free/css/all.min.css">
      <!-- Ionicons -->
      <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
      <!-- Tempusdominus Bootstrap 4 -->
      <link rel="stylesheet" href="<?php echo base_url(); ?>upload/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
      <!-- iCheck -->
      <link rel="stylesheet" href="<?php echo base_url(); ?>upload/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
      <!-- JQVMap -->
      <link rel="stylesheet" href="<?php echo base_url(); ?>upload/admin/plugins/jqvmap/jqvmap.min.css">
      <!-- Theme style -->
      <link rel="stylesheet" href="<?php echo base_url(); ?>upload/admin/dist/css/adminlte.min.css">
      <!-- overlayScrollbars -->
      <link rel="stylesheet" href="<?php echo base_url(); ?>upload/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
      <!-- Daterange picker -->
      <link rel="stylesheet" href="<?php echo base_url(); ?>upload/admin/plugins/daterangepicker/daterangepicker.css">
      <!-- summernote -->
      <link rel="stylesheet" href="<?php echo base_url(); ?>upload/admin/plugins/summernote/summernote-bs4.min.css">
      
      
      
      <?php $currentURL = $this->uri->segment(2);
   $domain_id = domain_id_get();
   $hedercontectUs = $this->db->where('domain_id', $domain_id)->get('contect_us')->row_array();
   $logo_path = !empty($hedercontectUs['logo']) && file_exists(FCPATH . 'assets/images/logo/' . $hedercontectUs['logo']) 
   ? base_url('assets/images/logo/' . $hedercontectUs['logo']) 
   : base_url('upload/assets/images/default-logo.png');
   $logo_icon_path = !empty($hedercontectUs['logo_icon']) && file_exists(FCPATH . 'assets/images/logo/' . $hedercontectUs['logo_icon']) 
   ? base_url('assets/images/logo/' . $hedercontectUs['logo_icon']) 
   : base_url('upload/assets/images/default-logo.png');
   
   $adminColor = $this->db->where( array('domain_id' => $domain_id))->get('admin_color')->row_array();
   $menu_possition = $this->db->where( array('domain_id' => 3))->get('menu_possition')->row_array();

   ?>
   <link rel="apple-touch-icon" sizes="180x180" href="<?= $logo_icon_path ?>">
   <link rel="icon" type="image/png" sizes="16x16" href="<?= $logo_icon_path ?>">
   <link rel="icon" type="image/x-icon" href="<?= $logo_icon_path ?>">
<style>
   .header{
      position: fixed !important;
      width: 100%;
      z-index: 999;
   }
   ::-webkit-scrollbar {
    width: 6px;
    height: 6px;
    background:gray;
}
nav.side-navbar ul li a {
    font-weight: 600;
}
.cumd-sdsd-45{
   color: #000;
    font-weight: 500;
    font-size: 18px;
}
.breadcrumb{
   background: <?php echo isset($adminColor['page_header_color']) ? $adminColor['page_header_color'] : '#8cd4ea'; ?>;
   margin: 5px 0;
}
.breadcrumb a{
   color: <?php echo isset($adminColor['page_header_first_text_color']) ? $adminColor['page_header_first_text_color'] : '#8cd4ea'; ?>;
   font-weight:bold;
}
.breadcrumb li.breadcrumb-item{
   color: <?php echo isset($adminColor['page_header_second_text_color']) ? $adminColor['page_header_second_text_color'] : '#8cd4ea'; ?>;
   font-weight:600;
}
body{
   /* background: #8cd4ea; */
   background: <?php echo isset($adminColor['background_color']) ? $adminColor['background_color'] : '#8cd4ea'; ?>;

}
table.dataTable tbody th, table.dataTable tbody td{
   text-wrap: nowrap;
}
/* Assuming your modal gets a class like .modal-open on <body> or .open on the modal itself */
body.modal-open .clr_bg_new,
.modal.open .clr_bg_new,
.modal[aria-hidden="false"] .clr_bg_new {
    transform: none !important;
}
.cke_notifications_area{
   display:none;
}
.table-responsive {
    background: #fff;
}
.clr_bg_new{
   /* background: #8cd4ea !important; */
   background: <?php echo $adminColor['background_color'] ?>!important;
}
nav.side-navbar a[aria-expanded="true"] {

/* background: #EEF5F9; */
   background: <?php echo isset($adminColor['dropdown_background_color']) ? $adminColor['dropdown_background_color'] : '#EEF5F9'; ?>;

}
nav.side-navbar ul li li a {
   background: <?php echo isset($adminColor['dropdown_background_color']) ? $adminColor['dropdown_background_color'] : '#EEF5F9'; ?>;

}
nav.side-navbar ul li a:hover {
  /* background: #f2b23e; */
     background: <?php echo isset($adminColor['sidebar_hover_color']) ? $adminColor['sidebar_hover_color'] : '#f2b23e'; ?>;
}
nav.side-navbar ul li.active>a {

/* background: #f2b23e; */
   background: <?php echo isset($adminColor['sidebar_hover_color']) ? $adminColor['sidebar_hover_color'] : '#f2b23e'; ?>;

}
#toggle-btn span {
    background-color: <?php echo $adminColor['header_logo_color']; ?> !important;
}
 @media screen and (max-width: 644px){
   .main_hide_show {
      margin-bottom: -50px !important;
   }
}
   <?php

if (isset($_GET['type']) || isset($_GET['user_id'])) {?>
   .main_hide_show{
      justify-content: center;
   }
   .hide_show{
         display:none;
   }
   <?php }?>

</style>

   </head>
   <body>

      <div class="page">
      <!-- Main Navbar-->
      <header class="header">
         <!-- <nav class="navbar" style="background: #f2b23e;"> -->
         <nav class="navbar" style="background: <?php echo isset($adminColor['header_background_color']) ? $adminColor['header_background_color'] : '#f2b23e'; ?>">
            <!-- Search Box-->
            <div class="search-box">
               <button class="dismiss"><i class="icon-close"></i></button>
               <form id="searchForm" action="#" role="search">
                  <input type="search" placeholder="What are you looking for..." class="form-control">
               </form>
            </div>
            <div class="container-fluid">
               <div class="navbar-holder d-flex align-items-center justify-content-between">
                  <!-- Navbar Header-->
                  <div class="navbar-header">
                     <!-- Navbar Brand -->
                     <a href="<?php base_url('admin-dashboard');?>" class="navbar-brand d-none d-sm-inline-block">
                       <?php
                        $domain_id = domain_id_get();
                       $logo = $this->db->where(($this->session->userdata('type') != 'admin') ? array('domain_id' => $domain_id) : array())->get('contect_us')->row_array();
                     //   if ($this->session->userdata('type') == 'admin') { ?>
                        <div class="brand-text d-none d-lg-inline-block">
                           <strong style="color: <?= isset($adminColor['header_logo_color']) ? $adminColor['header_logo_color'] : '#000' ?>">
                              <?= isset($logo['company_title']) ? $logo['company_title'] : '' ?>
                           </strong>
                        </div>
                        <div class="brand-text d-none d-sm-inline-block d-lg-none"><strong></strong></div>
                     </a>
                     <!-- Toggle Button-->
                     <a id="toggle-btn" href="#" class="menu-btn active"><span></span><span></span><span></span></a>
                  </div>
                  <!-- Navbar Menu -->
                  <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                     <!-- Search-->
                    
                    <li class="font-bold cumd-sdsd-45">
                     <span style="font-weight:bold;color: <?= isset($adminColor['header_text_color']) ? $adminColor['header_text_color'] : '#000'; ?>;">
                        <?php
                              $users = $this->db->where('id', $_SESSION['user_id'])->where('role', $_SESSION['role'])->where('status !=', 2)->get('branch_franchise')->row();
                              if (empty($users)) {
                                 $users = $this->db->where('id', $_SESSION['user_id'])->where('role', $_SESSION['role'])->where('status !=', 2)->get('user_master')->row();
                              }
                              ?>
                                <img 
                                class="img-thumbnail mr-2" 
                                style="max-height: 40px; object-fit:cover;"
                                id="profile_photo_preview"  src="<?=base_url()?><?php echo $users->user_logo; ?>" alt="Logo">
                                <?php //echo isset($logo['company_name']) ? $logo['company_name'] : ''; ?>
                                Welcome
                        <?= $users->name; ?>
                     </span>
                  </li>
 
                    <li class="nav-item">
                         <a class="btn btn-primary btn-sm ml-3" href="<?= str_replace('/beta/', '/', base_url()); ?>" role="button">Continue to Website</a>
                    </li>

                  </ul>
               </div>
            </div>
         </nav>
      </header>

      <?php
         $agent = $this->db->where(['id'=>$_SESSION['user_id'] ,'role'=>$_SESSION['role']])->where('status !=', 2)->get('user_master')->row();
         if (empty($agent)) {
            $agent = $this->db->where(['id'=>$_SESSION['user_id'] ,'role'=>$_SESSION['role']])->where('status !=', 2)->get('branch_franchise')->row();
         }
         $domain_id = domain_id_get();
         $user_id   = $this->session->userdata('user_id');
         $this->db->from('registerUser');
         if ($this->session->userdata('type') != 'admin') {
            $this->db->where('domain_id', $domain_id);
         }
         $this->db->where('parent_team_id', $user_id);
         $count = $this->db->count_all_results(); 

         $this->db->from('user_master');
         if ($this->session->userdata('type') != 'admin') {
            $this->db->where('domain_id', $domain_id);
         }
         $this->db->where('parent_team_id', $user_id);
         $count2 = $this->db->count_all_results();

         $this->db->from('branch_franchise');
         if ($this->session->userdata('type') != 'admin') {
            $this->db->where('domain_id', $domain_id);
         }
         $this->db->where('parent_team_id', $user_id);
         $count3 = $this->db->count_all_results();
      ?>

   <div class="container-fluid p-0">
      <div class="row main_hide_show m-0" style="height:100vh;">
         <div class="col-md-2 px-0 hide_show">
               <!-- Side Navbar -->
               <nav class="side-navbar" style="color: <?= isset($adminColor['sidebar_text_color']) ? $adminColor['sidebar_text_color'] : '#000'; ?> ">
                  <ul class="list-unstyled side-navbar-bar" style="background: <?= isset($adminColor['sidebar_color']) ? $adminColor['sidebar_color'] : '#fff'; ?>">
                     <?php 
                        $user_id = $this->session->userdata('user_id');
                        $role = $this->session->userdata('role');
                        $show_home = false;
                        if ($user_id) {
                           if ($role == 1) {
                              $show_home = true;
                           } elseif ($role == 3) {
                              $user = $this->db->get_where('branch_franchise', ['id' => $user_id])->row();
                              if (isset($user->role) && $user->role == 3) {
                                 $franchise = $this->db->get_where('branch_franchise', ['id' => $user_id,'agreement_status' => 'approved','signature IS NOT NULL' => NULL])->row();
                                    $show_home = (bool)$franchise;
                                 }
                              } else {
                                 $user = $this->db->get_where('user_master', ['id' => $user_id])->row();
                                 if (isset($user->role) && $user->role == 2) {
                                    $user_master = $this->db->get_where('user_master', ['id' => $user_id,'agreement_status' => 'approved','signature IS NOT NULL' => NULL])->row();
                                       $show_home = (bool)$user_master;
                                    }
                                 }
                              }
                           if ($show_home): 
                        ?>
                        <li data-id="<?= $menu_possition['home'] ?>" class="<?= ($currentURL == "") ? "active" : "" ?>">
                           <a href="<?= base_url('admin-dashboard') ?>"> <i class="fa fa-home" aria-hidden="true"></i>Home</a>
                        </li>
                        <?php endif; ?>


                     <?php if ($this->session->userdata('type') == 'admin' || has_permission('CIBIL Score Check')) { ?>
                        <li data-id="<?= $menu_possition['cibil_score_check'] ?>" class="<?= ($currentURL == "cibil-score-check") ? "active" : "" ?>">
                           <a href="<?= base_url('admin/cibil-score-check') ?>">
                                 <i class="fa fa-credit-card" aria-hidden="true"></i> CIBIL Score Check
                           </a>
                        </li>
                     <?php } ?>
                     <?php if ($this->session->userdata('type') == 'admin' || has_permission('Instant Loans Kyc')) { ?>
                        
                        <li  data-id="<?= $menu_possition['instant_loans_kyc'] ?>" class="<?= ($currentURL == "instanloankyc") ? "active" : "" ?>">
                           <a href="<?= base_url('admin/instanloankyc') ?>">
                                 <i class="fa fa-file-text" aria-hidden="true"></i> Upload excel For payout Instant loan
                           </a>
                        </li>
                        
                     <?php } ?>
                     <?php 
                        $userkyc = $this->db->where('id',$this->session->userdata('user_id'))->where('role',$this->session->userdata('role'))->get('user_master')->row_array();
                        if (empty($userkyc)) {
                           $userkyc = $this->db->where('id',$this->session->userdata('user_id'))->where('role',$this->session->userdata('role'))->get('branch_franchise')->row_array();
                        }
                     ?>
                        <?php 
                        // echo '<pre>';print_r($user);die;
                        $domain_id = domain_id_get();
                        $sub_user = $this->db->where('domain_id', $domain_id)->where('type','subadmin')->get('user_master')->row_array();

                        if(($userkyc['domain_id'] == 3 && ($userkyc['parent_id_role'] == 1 || empty($userkyc['parent_id']))) || $this->session->userdata('role') == 1){
                            $url = base_url('admin/indiasales-login');
                        }else{
                            if (!empty($userkyc['parent_id_role']) || !empty($userkyc['parent_id']) ) {
                                $this->db->select('link,user_id');
                                $this->db->where('user_id_role', $userkyc['parent_id_role']);
                                $this->db->where('user_id', $userkyc['parent_id']);
                                $this->db->where('domain_id', $domain_id);
                                $link_name = $this->db->get('indiasale_user_links')->row_array();
                                $url = (isset($link_name['link'])) ? $link_name['link'] : '#';
                            }else{
                                $this->db->select('link,user_id');
                                $this->db->where('user_id_role', $sub_user['role']);
                                $this->db->where('user_id', $sub_user['id']);
                                $this->db->where('domain_id', $domain_id);
                                $link_name = $this->db->get('indiasale_user_links')->row_array();
                                $url = (isset($link_name['link'])) ? $link_name['link'] : '#';
                            }
                        }

                        // if(empty($userkyc['parent_id']) || $userkyc['parent_id'] == $link_name['user_id'] || $userkyc['parent_id_role'] == 1 || $this->session->userdata('role') == 1):
                         ?>
                             <?php if ($this->session->userdata('type') == 'admin' || has_permission('Instant Loans Kyc')) { ?>
                      
                               <li data-id="<?= $menu_possition['indiasale_dashboard'] ?>" class="text-left"><a href="<?= $url?>"><i class="fa fa-handshake-o" aria-hidden="true"></i>  Apply Instant Loan kyc</a></li>
                        <?php //endif; ?>
                        <?php  }?>
                  
                     <?php if ($this->session->userdata('role') == 1 ||  $count2 > 0 ) {?>
                        <?php if ($this->session->userdata('type') == 'admin' || has_permission('DSA Registration')) { ?>
                        <li data-id="<?= $menu_possition['dsa_registration'] ?>" class=<?php if ($currentURL == "channel-partner") {echo "active";}?>><a href="<?php echo base_url('admin/channel-partner'); ?>"><i class="fa fa-handshake-o" aria-hidden="true"></i> DSA Registration</a></li>
                        <?php }}?>
                      
                        
                     <?php if ($this->session->userdata('role') == 1 ||  $count3 > 0 ) {?>
                        <?php if ($this->session->userdata('type') == 'admin' || has_permission('Branch Franchise')) { ?>

                     <li data-id="<?= $menu_possition['branch_franchise'] ?>" class=<?php if ($currentURL == "branch-franchise") {echo "active";}?>><a href="<?php echo base_url('admin/branch-franchise'); ?>"><i class="fa fa-handshake-o" aria-hidden="true"></i> Branch Franchise</a></li>
                     <?php }}?>

                     <?php if ($this->session->userdata('role') == 1 || $this->session->userdata('role') == 3) {?>
                        <?php if ($this->session->userdata('type') == 'admin' || has_permission('Change Plan')) { ?>
                     <li data-id="<?= $menu_possition['change_plan'] ?>" class=<?php if ($currentURL == "change-plan") {echo "active";}?>><a href="<?php echo base_url('admin/change-plan'); ?>"><i class="fa fa-handshake-o" aria-hidden="true"></i> Change Plan</a></li>
                     <?php }}?>
                        
                     <?php if ($this->session->userdata('role') == 1 || $count > 0) {?>
                        <?php if ($this->session->userdata('type') == 'admin' || has_permission('My Customers')) { ?>
                        <li data-id="<?= $menu_possition['my_customers'] ?>" class=<?php if ($currentURL == "register-user") {echo "active";}?>><a href="<?php echo base_url('admin/register-user'); ?>"><i class="fas fa-users" aria-hidden="true"></i>My Customers</a></li>
                     <?php }}?>
                        
                     <?php if($this->session->userdata('role') == 1 || $count > 0 ||  $count2 > 0 ||  $count3 > 0) { ?>
                        <?php if ($this->session->userdata('type') == 'admin' || has_permission('Payment History')) { ?>
                        <li data-id="<?= $menu_possition['payment_history'] ?>" class=<?php if ($currentURL == "transaction") {echo "active";}?>><a href="<?php echo base_url('admin/transaction'); ?>"><i class="fas fa-money" aria-hidden="true"></i>Payment History</a></li>
                     <?php }}?>

                     <?php if ($this->session->userdata('type') == 'admin' || $count > 0 ||  $count2 > 0 ||  $count3 > 0 || has_permission('Banker Contact')) { ?>
                        <li data-id="<?= $menu_possition['banker_contact'] ?>" class=<?php if ($currentURL == "banker") {echo "active";}?>><a href="<?php echo base_url('admin/banker'); ?>"><i class="fa fa-volume-control-phone" aria-hidden="true"></i>Banker Contact</a></li>
                     <?php }?>

                     <?php if ($this->session->userdata('type') == 'admin' || $count > 0 ||  $count2 > 0 ||  $count3 > 0 || (has_permission('Add Bank') && $this->session->userdata('role') == 1)) { ?>
                     <li data-id="<?= $menu_possition['add_bank'] ?>" class=<?php if ($currentURL == "banker-master") {echo "active";}?>><a href="<?php echo base_url('admin/banker-master'); ?>"><i class="fa fa-university" aria-hidden="true"></i>Add Bank</a></li>
                     <?php }?>

                     <?php if ($this->session->userdata('type') == 'admin' || $count > 0 ||  $count2 > 0 ||  $count3 > 0 || (has_permission('Loan Type Master') && $this->session->userdata('role') == 1)) { ?>
                        <li data-id="<?= $menu_possition['loan_type_master'] ?>" class=<?php if ($currentURL == "loan-type-master") {echo "active";}?>><a href="<?php echo base_url('admin/loan-type-master'); ?>"><i class="fa fa-credit-card" aria-hidden="true"></i>Loan Type Master</a></li>
                     <?php }?>

                     <?php if ($this->session->userdata('type') == 'admin' || has_permission('Bankwise Eligibility')) { ?>
                        <li data-id="<?= $menu_possition['bankwise_eligibility'] ?>" class=<?php if ($currentURL == "bankwise-eligibility") {echo "active";}?>><a href="<?php echo base_url('admin/bankwise-eligibility'); ?>"><i class="fa fa-newspaper-o" aria-hidden="true"></i> Bankwise Eligibility</a></li>
                     <?php }?>

                     <?php if ($this->session->userdata('type') == 'admin' || has_permission('Bankwise pdf')) { ?>
                        <li data-id="<?= $menu_possition['bankwise_pdf'] ?>" class=<?php if ($currentURL == "bankwise-pdfs") {echo "active";}?>><a href="<?php echo base_url('admin/bankwise-pdfs'); ?>"><i class="fa fa-file-pdf-o" aria-hidden="true"></i>Bankwise pdf</a></li>
                     <?php } ?>

                     <?php if ($this->session->userdata('type') == 'admin' || has_permission('Lead')) { ?>
                        <li data-id="<?= $menu_possition['lead_menu'] ?>"><a href="#footerDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-interface-windows"></i>Lead</a>
                           <ul id="footerDropdown" class="collapse list-unstyled">
                              <?php if ($this->session->userdata('type') == 'admin' || has_permission('My lead')) { ?><li class=<?php if ($currentURL == "add-lead") {echo "active";}?>><a href="<?php echo base_url('admin/add-lead'); ?>">Add lead</a></li><?php } ?>
                              <?php if ($this->session->userdata('type') == 'admin' || has_permission('add lead')) { ?><li class=<?php if ($currentURL == "leads") {echo "active";}?>><a href="<?php echo base_url('admin/leads'); ?>">My lead</a></li><?php } ?>
                           </ul>
                        </li>
                     <?php } ?>

                     <?php if ($this->session->userdata('type') == 'admin' || has_permission('Bank Login List')) { ?>
                        <li data-id="<?= $menu_possition['bank_login_list'] ?>" class=<?php if ($currentURL == "loan") {echo "active";}?>><a href="<?php echo base_url('admin/loan'); ?>"><i class="fa fa-cog" aria-hidden="true"></i>Bank Login List</a></li>
                     <?php } ?>
                        
                        <?php if ($this->session->userdata('role') != 1 && (empty($agent->parent_id) ||  $count2 > 0 ) || has_permission('Your Team Bank Login List')) {?>
                        <li data-id="<?= $menu_possition['your_team_bank_login_list'] ?>" class=<?php if ($currentURL == "teamList") {echo "active";}?>><a href="<?php echo base_url('admin/teamList'); ?>"><i class="fa fa-cog" aria-hidden="true"></i>Your Team Bank Login List</a></li>
                     <?php }?>
                           
                     <?php if ($this->session->userdata('type') == 'admin' || has_permission('bank login')) { ?>
                     <?php if ($this->session->userdata('role') != 1) {?>
                        <li data-id="<?= $menu_possition['bank_login'] ?>"><a href="#leadsDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-interface-windows"></i>Bank Login</a>
                           <ul id="leadsDropdown" class="collapse list-unstyled">
                              <?php if ($this->session->userdata('type') == 'admin' || has_permission('personal lone')) { ?><li class=<?php if ($currentURL == "loan-add") {echo "active";}?>><a href="<?php echo base_url('admin/loan-add'); ?>">Personal Loan</a></li><?php } ?>
                              <?php if ($this->session->userdata('type') == 'admin' || has_permission('business loan')) { ?><li class=<?php if ($currentURL == "businessloan") {echo "active";}?>><a href="<?php echo base_url('admin/businessloan'); ?>"> Business loan</a></li><?php } ?>
                           </ul>
                        </li>
                        <li class=<?php if ($currentURL == "loanasign") {echo "active";}?>></li>
                     <?php }}?>

                     <?php if ($this->session->userdata('role') == 1 && $this->session->userdata('type') != 'seo') { ?>
                        <li data-id="<?= $menu_possition['my_team'] ?>" class=<?php if ($currentURL == "admin-team") {echo "active";}?>><a href="<?php echo base_url('admin/admin-team'); ?>"><i class="fa fa-handshake-o" aria-hidden="true"></i>My Team</a></li>
                     <?php }?>

                     <?php 
                  //   print_r($agent);die;
                     if (empty($agent->parent_id) || $agent->parent_id == 0) {?>
                     <?php if ($this->session->userdata('type') == 'admin' || has_permission('My Team')) { ?>
                        <li data-id="<?= $menu_possition['dsa_branch_team'] ?>" class=<?php if ($currentURL == "my-team") {echo "active";}?>><a href="<?php echo base_url('admin/my-team'); ?>"><i class="fa fa-handshake-o" aria-hidden="true"></i><?=  ($this->session->userdata('role') == 1) ? 'DSA & Branch team' : 'My team free DSA' ; ?></a></li>
                     <?php }} ?>
                     
                     <?php if ($_SESSION['role'] != 2) {?>
                     <?php if ($this->session->userdata('type') == 'admin' || has_permission('My Network')) { ?>
                        <li data-id="<?= $menu_possition['my_network_paid_dsa'] ?>" class=<?php if ($currentURL == "my-network") {echo "active";}?>><a href="<?php echo base_url('admin/my-network'); ?>"><i class="fa fa-handshake-o" aria-hidden="true"></i><?=  ($this->session->userdata('role') == 1) ? 'My Network' : 'My network paid DSA' ; ?></a></li>
                     <?php }}?>
                  
                     <?php if ($this->session->userdata('type') == 'admin' || has_permission('Self Bank Login')) { ?>
                        <li data-id="<?= $menu_possition['self_bank_login'] ?>" class=<?php if ($currentURL == "loan-company-master") {echo "active";}?>><a href="<?php echo base_url('admin/loan-company-master'); ?>"><i class="fa fa-landmark" aria-hidden="true"></i> Self Bank Login</a></li>
                     <?php }?>

                     <?php if ($this->session->userdata('type') == 'admin' || has_permission('Bank Wise Login')) { ?>
                        <li data-id="<?= $menu_possition['bank_wise_login'] ?>" class=<?php if ($currentURL == "loan-lead-list") {echo "active";}?>><a href="<?php echo base_url('admin/loan-lead-list'); ?>"><i class="fa fa-landmark" aria-hidden="true"></i>Bank Wise Login</a></li>
                     <?php }?>

                     <?php if (($this->session->userdata('type') == 'admin') || (has_permission('My Payout Slabs'))) { 
                        $showWhatsapp = true;   
                        $userId = $this->session->userdata('user_id');
                        if ($userId) {
                           $user = $this->db->get_where('user_master', ['id' => $userId])->row();
                           if (!empty($user) && !empty($user->parent_id)) {
                              $parent = null;
                              if ($user->parent_id_role == 2) {
                                    $parent = $this->db->get_where('user_master', ['id' => $user->parent_id])->row();
                              }
                              if ($user->parent_id_role == 3) {
                                    $parent = $this->db->get_where('branch_franchise', ['id' => $user->parent_id])->row();
                              }
                              if (!empty($parent) && isset($parent->role) && $parent->role != 1) {
                                    $showWhatsapp = false;
                              }
                           }
                        }
                     ?>
                        <?php if ($showWhatsapp) { ?>
                        <li data-id="<?= $menu_possition['my_payout_slabs'] ?>"><a href="#payout_slab_dropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-interface-windows"></i>My Payout Slabs</a>
                           <ul id="payout_slab_dropdown" class="collapse list-unstyled">
                              <?php if (has_permission('Payout slab unsecured loans') || ($this->session->userdata('type') == 'admin')) { ?>
                                 <li class=<?php if ($currentURL == "payoutslab") {echo "active";}?>><a href="<?php echo base_url('admin/payoutslab'); ?>">Payout slab unsecured loans</a></li>
                              <?php }?>
                              <?php if (has_permission('Payout slab secured loans') || ($this->session->userdata('type') == 'admin')) { ?>
                                 <li class=<?php if ($currentURL == "payoutslabsecure") {echo "active";}?>><a href="<?php echo base_url('admin/payoutslabsecure'); ?>">Payout slab secured loans</a></li>
                              <?php }?>
                              <?php if (has_permission('Bank & Finance Type code book') || ($this->session->userdata('type') == 'admin')) { ?>
                                 <li class=<?php if ($currentURL == "codebook") {echo "active";}?>><a href="<?php echo base_url('admin/codebook'); ?>"> Bank & Finance Type code book</a></li>
                              <?php }?>
                           </ul>
                        </li>
                        <?php }?>
                     <?php }?> 

                     <?php if ($this->session->userdata('type') == 'admin' || has_permission('My Profile')) { ?>
                        <li data-id="<?= $menu_possition['my_profile'] ?>" class=<?php if ($currentURL == "user-profile") {echo "active";}?>><a href="<?php echo base_url('admin/user-profile'); ?>"><i class="fa fa-user" aria-hidden="true"></i> My Profile</a></li>
                     <?php }?>
                  
                     <?php if ($this->session->userdata('type') == 'admin' || has_permission('Promotional Notifications')) { ?>
                        <li data-id="<?= $menu_possition['promotional_notifications'] ?>" class=<?php if ($currentURL == "marketing-notification-list") {echo "active";}?>><a href="<?php echo base_url('admin/marketing-notification-list'); ?>"><i class="fa fa-bell" aria-hidden="true"></i> Promotional Notifications</a></li>
                     <?php } ?>

                     <?php if ($this->session->userdata('type') == 'admin' || has_permission('Video')) { ?>
                        <li data-id="<?= $menu_possition['video'] ?>" class=<?php if ($currentURL == "video") {echo "active";}?>><a href="<?php echo base_url('admin/video'); ?>"><i class="fa fa-video-camera" aria-hidden="true"></i> Video</a></li>
                     <?php } ?>

                     <?php if ($this->session->userdata('type') == 'admin' || has_permission('document')) { 
                     $teams_parent = $this->db->get_where('user_master', ['id' => $this->session->userdata('user_id'),'role' => $this->session->userdata('role')])->row_array();
                     if (empty($teams_parent)) {
                        $teams_parent = $this->db->get_where('branch_franchise', ['id' => $this->session->userdata('user_id'),'role' => $this->session->userdata('role')])->row_array();
                     }
                     if ($_SESSION['role'] != 1 && (empty($teams_parent['parent_id']) || $teams_parent['parent_id_role'] == 1) ) { ?>
                        <li data-id="<?= $menu_possition['document_menu'] ?>" class=<?php if ($currentURL == "admin/document/") {echo "active";}?>><a href="<?php echo base_url('admin/document/'); ?>"><i class="fa fa-file-text" aria-hidden="true"></i> Document</a></li>
                     <?php }}?>
                           
                     <?php if (($this->session->userdata('type') == 'admin') ||( $this->session->userdata('role') == 1 &&  has_permission('Permission'))) { ?>
                        <li data-id="<?= $menu_possition['permission'] ?>" class=<?php if ($currentURL == "admin/permission") {echo "active";}?>><a href="#permission_dropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-interface-windows"></i>Permission</a>
                           <ul id="permission_dropdown" class="collapse list-unstyled">
                              <?php if ($this->session->userdata('type') == 'admin') { ?>
                                 <li class=<?php if ($currentURL == "admin/domain/") {echo "active";}?>><a href="<?php echo base_url('admin/domain/'); ?>"> Domain </a></li>
                                 <li class=<?php if ($currentURL == "admin/sub-admin/") {echo "active";}?>><a href="<?php echo base_url('admin/sub-admin/'); ?>"> Admin Create</a></li>
                                 <li class=<?php if ($currentURL == "admin/permission") {echo "active";}?>><a href="<?php echo base_url('admin/permission'); ?>"> Permissions </a></li>
                                 <li class=<?php if ($currentURL == "admin/seo-permission") {echo "active";}?>><a href="<?php echo base_url('admin/seo-permission'); ?>">SEO Permissions </a></li>
                              <?php }?>
                                 
                              <?php if (($this->session->userdata('type') == 'admin') || $this->session->userdata('role') == 1 && has_permission('Email configuration')) { ?>
                                 <li class=<?php if ($currentURL == "admin/smtp") {echo "active";}?>><a href="<?php echo base_url('admin/smtp'); ?>"> Email configuration </a></li>
                              <?php } ?>
                              <?php if (($this->session->userdata('type') == 'admin') || $this->session->userdata('role') == 1 && has_permission('agreement branch')) { ?>
                                 <li class=<?php if ($currentURL == "branch-agreement") {echo "active";}?>><a href="<?php echo base_url('admin/branch-agreement'); ?>"> Branch Agreement </a></li>
                              <?php } ?>
                              <?php if (($this->session->userdata('type') == 'admin') || $this->session->userdata('role') == 1 && has_permission('agreement dsa')) { ?>
                                 <li class=<?php if ($currentURL == "dsa-agreement") {echo "active";}?>><a href="<?php echo base_url('admin/dsa-agreement'); ?>"> DSA Agreement </a></li>
                              <?php } ?>
                           </ul>
                        </li>
                     <?php } ?>

                     <?php if (($this->session->userdata('type') == 'admin') || $this->session->userdata('role') == 1 &&  has_permission('Pages')) { ?>
                        <li data-id="<?= $menu_possition['pages'] ?>"><a href="#pages" aria-expanded="false" data-toggle="collapse"> <i class="icon-interface-windows"></i>Pages</a>
                           <ul id="pages" class="collapse list-unstyled">
                              <?php if ($this->session->userdata('type') == 'admin' || has_permission('Home page')) { ?>
                              <li><a href="#dashboardDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-interface-windows"></i>Home page</a>
                                 <ul id="dashboardDropdown" class="collapse list-unstyled">
                                    <?php if (($this->session->userdata('type') == 'admin') || $this->session->userdata('role') == 1 && has_permission('Header menu')) { ?> <li class=<?php if ($currentURL == "admin/show_menu") {echo "active";}?>><a href="<?php echo base_url('admin/show_menu'); ?>">Header Menu</a></li><?php } ?>
                                    <?php if (($this->session->userdata('type') == 'admin') || $this->session->userdata('role') == 1 && has_permission('slider')) { ?> <li class=<?php if ($currentURL == "admin/slider") {echo "active";}?>><a href="<?php echo base_url('admin/slider'); ?>">Slider</a></li><?php } ?>
                                    <?php if (($this->session->userdata('type') == 'admin') || $this->session->userdata('role') == 1 && has_permission('our edge')) { ?> <li class=<?php if ($currentURL == "admin/edge") {echo "active";}?>><a href="<?php echo base_url('admin/edge'); ?>">Our Edge</a></li><?php } ?>
                                    <?php if (($this->session->userdata('type') == 'admin') || $this->session->userdata('role') == 1 && has_permission('category')) { ?> <li class=<?php if ($currentURL == "admin/categories") {echo "active";}?>><a href="<?php echo base_url('admin/categories'); ?>">Category</a></li><?php } ?>
                                    <?php if (($this->session->userdata('type') == 'admin') || $this->session->userdata('role') == 1 && has_permission('about')) { ?> <li class=<?php if ($currentURL == "admin/about_customer") {echo "active";}?>><a href="<?php echo base_url('admin/about_customer'); ?>">About</a></li><?php } ?>
                                    <?php if (($this->session->userdata('type') == 'admin') || $this->session->userdata('role') == 1 && has_permission('Partner Slider')) { ?> <li class=<?php if ($currentURL == "admin/partner_slider") {echo "active";}?>><a href="<?php echo base_url('admin/partner_slider'); ?>">Partner Slider</a></li><?php } ?>
                                 </ul>
                              </li>
                              <?php }?>
                              <li>
                                 <?php if (($this->session->userdata('type') == 'admin') || $this->session->userdata('role') == 1 && has_permission('Company')) { ?>
                                    <a href="#companyDropdown" aria-expanded="false" data-toggle="collapse"><i class="icon-interface-windows"></i>Company</a>
                                    <ul id="companyDropdown" class="collapse list-unstyled">
                                       <?php if (($this->session->userdata('type') == 'admin') || $this->session->userdata('role') == 1 && has_permission('Profile')) { ?>
                                          <li class="<?php if ($currentURL == "admin/company-profile") {echo "active";}?>">
                                             <a href="<?php echo base_url('admin/company-profile'); ?>" data-toggle="collapse" data-target="#companySubMenu" aria-expanded="false">
                                                Profile
                                             </a>
                                             <ul id="companySubMenu" class="collapse list-unstyled">
                                                <?php if (($this->session->userdata('type') == 'admin') || $this->session->userdata('role') == 1 && has_permission('our story')) { ?>
                                                   <li class="<?php if ($currentURL == "admin/our-story") {echo "active";}?>">
                                                      <a href="<?php echo base_url('admin/our-story'); ?>">Our Story</a>
                                                   </li>
                                                <?php } ?>
                                                <?php if (($this->session->userdata('type') == 'admin') || $this->session->userdata('role') == 1 && has_permission('smartest choice')) { ?>
                                                   <li class="<?php if ($currentURL == "admin/smart-choice") {echo "active";}?>">
                                                      <a href="<?php echo base_url('admin/smart-choice'); ?>">Smartest Choice</a>
                                                   </li>
                                                <?php } ?>
                                                <?php if (($this->session->userdata('type') == 'admin') || $this->session->userdata('role') == 1 && has_permission('media coverage')) { ?>
                                                   <li class="<?php if ($currentURL == "admin/media-coverage") {echo "active";}?>">
                                                   <a href="<?php echo base_url('admin/media-coverage'); ?>">Media Coverage</a>
                                                </li>
                                                <?php } ?>

                                                <?php if (($this->session->userdata('type') == 'admin') || $this->session->userdata('role') == 1 && has_permission('Company info')) { ?>
                                                   <li class="<?php if ($currentURL == "admin/company-profile") {echo "active";}?>">
                                                   <a href="<?php echo base_url('admin/company-profile'); ?>">Company info	</a>
                                                </li>
                                                <?php } ?>
                                             </ul>
                                          </li>
                                          <?php } ?>
                                       <?php if (($this->session->userdata('type') == 'admin') || $this->session->userdata('role') == 1 && has_permission('Contact us')) { ?>
                                       
                                          <li class=<?php if ($currentURL == "admin/contect-us") {echo "active";}?>><a href="<?php echo base_url('admin/contect-us'); ?>">Contect Us/header/footer manage</a></li>
                                       <?php } ?>
                                    </ul>
                                 <?php } ?>
                              </li>
                              <li>
                              <?php if (($this->session->userdata('type') == 'admin') || $this->session->userdata('role') == 1 && has_permission('Our Services')) { ?>
                                 <a href="#ourServicesDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-interface-windows"></i>Our Services</a>
                                 <ul id="ourServicesDropdown" class="collapse list-unstyled">
                                    <?php if (has_permission('silver membership') && ($this->session->userdata('type') == 'admin') || $this->session->userdata('role') == 1) { ?>
                                    <li>
                                       <a href="#silverMembershipDropdown" aria-expanded="false" data-toggle="collapse"> Silver Membership</a>
                                       <ul id="silverMembershipDropdown" class="collapse list-unstyled">
                                          <?php if (($this->session->userdata('type') == 'admin') || $this->session->userdata('role') == 1 && has_permission('silver banner')) { ?> <li class="<?php if ($currentURL == 'admin/silver-banner') {echo 'active';}?>">
                                             <a href="<?php echo base_url('admin/silver-banner'); ?>">Banner</a>
                                          </li>
                                          <?php }?>
                                          <?php if (($this->session->userdata('type') == 'admin') || $this->session->userdata('role') == 1 && has_permission('silver member section 1')) { ?> <li class="<?php if ($currentURL == 'admin/silver-section-1') {echo 'active';}?>">
                                             <a href="<?php echo base_url('admin/silver-section-1'); ?>">Silver Member Section 1</a>
                                          </li>
                                          <?php }?>
                                          <?php if (($this->session->userdata('type') == 'admin') || $this->session->userdata('role') == 1 && has_permission('silver member section 2')) { ?> <li class="<?php if ($currentURL == 'admin/silver-section-2') {echo 'active';}?>">
                                             <a href="<?php echo base_url('admin/silver-section-2'); ?>">Silver Member Section 2</a>
                                          </li>
                                          <?php }?>
                                          <?php if (($this->session->userdata('type') == 'admin') || $this->session->userdata('role') == 1 && has_permission('silver member section 3')) { ?> <li class="<?php if ($currentURL == 'admin/silver-section-3') {echo 'active';}?>">
                                             <a href="<?php echo base_url('admin/silver-section-3'); ?>">Silver Member Section 3</a>
                                          </li>
                                          <?php }?>
                                          <?php if (($this->session->userdata('type') == 'admin') || $this->session->userdata('role') == 1 && has_permission('silver member section 4')) { ?> <li class="<?php if ($currentURL == 'admin/silver-section-4') {echo 'active';}?>">
                                             <a href="<?php echo base_url('admin/silver-section-4'); ?>">Silver Member Section 4</a>
                                          </li>
                                          <?php }?>
                                       </ul>
                                    </li>
                                    <?php }?>
                                    <!-- Platinum Membership -->
                                    <?php if (($this->session->userdata('type') == 'admin') || $this->session->userdata('role') == 1 && has_permission('platinum membership')) { ?>
                                    <li>
                                       <a href="#platinumMembershipDropdown" aria-expanded="false" data-toggle="collapse"> Platinum Membership</a>
                                       <ul id="platinumMembershipDropdown" class="collapse list-unstyled">
                                          <?php if (($this->session->userdata('type') == 'admin') || $this->session->userdata('role') == 1 && has_permission('platinum banner')) { ?><li class="<?php if ($currentURL == 'admin/plantinum-banner') {echo 'active';}?>">
                                             <a href="<?php echo base_url('admin/plantinum-banner'); ?>">Banner</a>
                                          </li><?php }?>
                                          <?php if (($this->session->userdata('type') == 'admin') || $this->session->userdata('role') == 1 && has_permission('platinum membership section 1')) { ?><li class="<?php if ($currentURL == 'admin/plantinum-section-1') {echo 'active';}?>">
                                             <a href="<?php echo base_url('admin/plantinum-section-1'); ?>">Platinum Member Section 1</a>
                                          </li><?php }?>
                                          <?php if (($this->session->userdata('type') == 'admin') || $this->session->userdata('role') == 1 && has_permission('platinum membership section 2')) { ?><li class="<?php if ($currentURL == 'admin/plantinum-section-2') {echo 'active';}?>">
                                             <a href="<?php echo base_url('admin/plantinum-section-2'); ?>">Platinum Member Section 2</a>
                                          </li><?php }?>
                                          <?php if (($this->session->userdata('type') == 'admin') || $this->session->userdata('role') == 1 && has_permission('platinum membership section 3')) { ?><li class="<?php if ($currentURL == 'admin/plantinum-section-3') {echo 'active';}?>">
                                             <a href="<?php echo base_url('admin/plantinum-section-3'); ?>">Platinum Member Section 3</a>
                                          </li><?php }?>
                                          <?php if (($this->session->userdata('type') == 'admin') || $this->session->userdata('role') == 1 && has_permission('silver member section 3')) { ?><li class="<?php if ($currentURL == 'admin/plantinum-section-4') {echo 'active';}?>">
                                             <a href="<?php echo base_url('platinum membership section 4'); ?>">Platinum Member Section 4</a>
                                          </li><?php }?>
                                       </ul>
                                    </li>
                                    <?php }?>
                                    <!-- DSA Registration -->
                                    <?php if (($this->session->userdata('type') == 'admin') || $this->session->userdata('role') == 1 && has_permission('dsa registration page')) { ?>
                                    <li>
                                       <a href="#dsaDropdown" aria-expanded="false" data-toggle="collapse"> DSA Registration </a>
                                       <ul id="dsaDropdown" class="collapse list-unstyled">
                                          <?php if (($this->session->userdata('type') == 'admin') || $this->session->userdata('role') == 1 && has_permission('dsa banner')) { ?><li class="<?php if ($currentURL == 'admin/dsa-banner') {echo 'active';}?>">
                                             <a href="<?php echo base_url('admin/dsa-banner'); ?>">Banner</a>
                                          </li><?php }?>
                                          <?php if (($this->session->userdata('type') == 'admin') || $this->session->userdata('role') == 1 && has_permission('dsa section 1')) { ?><li class="<?php if ($currentURL == 'admin/dsa-section-1') {echo 'active';}?>">
                                             <a href="<?php echo base_url('admin/dsa-section-1'); ?>">DSA Section 1</a>
                                          </li><?php }?>
                                          <?php if (($this->session->userdata('type') == 'admin') || $this->session->userdata('role') == 1 && has_permission('dsa section 2')) { ?><li class="<?php if ($currentURL == 'admin/dsa-section-2') {echo 'active';}?>">
                                             <a href="<?php echo base_url('admin/dsa-section-2'); ?>">DSA Section 2</a>
                                          </li><?php }?>
                                          <?php if (($this->session->userdata('type') == 'admin') || $this->session->userdata('role') == 1 && has_permission('dsa section 3')) { ?><li class="<?php if ($currentURL == 'admin/dsa-section-3') {echo 'active';}?>">
                                             <a href="<?php echo base_url('admin/dsa-section-3'); ?>">DSA Section 3</a>
                                          </li><?php }?>
                                          <?php if (($this->session->userdata('type') == 'admin') || $this->session->userdata('role') == 1 && has_permission('dsa agent detail')) { ?><li class="<?php if ($currentURL == 'admin/dsaagentdetail') {echo 'active';}?>">
                                             <a href="<?php echo base_url('admin/dsaagentdetail'); ?>">DSA Agent Detail</a>
                                          </li><?php }?>
                                       </ul>
                                    </li>
                                 </ul>
                                 <?php }?>
                                 <?php }?>
                              </li>
                              <?php if (($this->session->userdata('type') == 'admin') || $this->session->userdata('role') == 1 &&  has_permission('branch franchise registration')) { ?>
                                 <li>
                                    <a href="#branchDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-interface-windows"></i>Branch Franchise Registration</a>
                                    <ul id="branchDropdown" class="collapse list-unstyled">
                                       <?php if (($this->session->userdata('type') == 'admin') || $this->session->userdata('role') == 1 && has_permission('branch banner')) { ?><li class=" <?php if ($currentURL == "admin/branch-banner") {echo "active";}?>"><a href="<?php echo base_url('admin/branch-banner'); ?>">Banner</a></li><?php }?>
                                       <?php if (($this->session->userdata('type') == 'admin') || $this->session->userdata('role') == 1 && has_permission('branch agent detail')) { ?><li class=" <?php if ($currentURL == 'admin/branchAgentDetail') {echo 'active';}?>"><a href="<?php echo base_url('admin/branchAgentDetail'); ?>">Branch Agent Detail</a></li><?php }?>                  
                                    </ul>
                                 </li>
                              <?php }?>
                              <?php if (($this->session->userdata('type') == 'admin') || $this->session->userdata('role') == 1 && has_permission('Blogs')) { ?>
                              <li>
                                 <a href="#documentSectionDropdown" aria-expanded="false" data-toggle="collapse">  <i class="icon-interface-windows"></i>Blogs</a>
                                 <ul id="documentSectionDropdown" class="collapse list-unstyled">
                                    <li <?php if (($this->session->userdata('type') == 'admin') || $this->session->userdata('role') == 1 && has_permission('blog')) { ?> class="<?php if ($currentURL == "blog") {echo "active";}?>"><a href="<?php echo base_url('admin/blog'); ?>"><i class="fa fa-landmark" aria-hidden="true"></i> Blog</a></li><?php }?>
                                    <?php if (($this->session->userdata('type') == 'admin') || $this->session->userdata('role') == 1 && has_permission('Blog Category')) { ?>
                                    <li <?php if (($this->session->userdata('type') == 'admin') || $this->session->userdata('role') == 1 && has_permission('Blog Category')) { ?> class="<?php if ($currentURL == "blog-category") {echo "active";}?>"><a href="<?php echo base_url('admin/blog-category'); ?>"><i class="fa fa-landmark" aria-hidden="true"></i> Blog Category</a></li><?php }?>
                                    <?php }?>
                                 </ul>
                              </li>
                              <?php }?>
                              <?php if (($this->session->userdata('type') == 'admin') || $this->session->userdata('role') == 1 && has_permission('buy now')) { ?>
                                 <li>
                                    <a href="#buynowMembershipDropdown" aria-expanded="false" data-toggle="collapse">  <i class="icon-interface-windows"></i>Buy Now customer details</a>
                                    <ul id="buynowMembershipDropdown" class="collapse list-unstyled">
                                    <?php if (($this->session->userdata('type') == 'admin') || $this->session->userdata('role') == 1 && has_permission('buy now banner')) { ?> <li class="<?php if ($currentURL == "admin/buynow-banner") {echo "active";}?>"><a href="<?php echo base_url('admin/buynow-banner'); ?>">Banner</a></li><?php }?>
                                    <?php if (($this->session->userdata('type') == 'admin') || $this->session->userdata('role') == 1 && has_permission('banner slider')) { ?> <li class="<?php if ($currentURL == "admin/banner-slider") {echo "active";}?>"><a href="<?php echo base_url('admin/banner-slider'); ?>">Banner Slider</a></li><?php }?>
                                    <?php if (($this->session->userdata('type') == 'admin') || $this->session->userdata('role') == 1 && has_permission('buy now section')) { ?> <li class="<?php if ($currentURL == "admin/buynow-section") {echo "active";}?>"><a href="<?php echo base_url('admin/buynow-section'); ?>">Buy Now Section</a></li><?php }?>                                       
                                    <?php if (($this->session->userdata('type') == 'admin') || $this->session->userdata('role') == 1 && has_permission('buy now section 1')) { ?> <li class="<?php if ($currentURL == "admin/buynow-section-2") {echo "active";}?>"><a href="<?php echo base_url('admin/buynow-section-2'); ?>">Buy Now Section 1</a></li><?php }?>
                                    <?php if (($this->session->userdata('type') == 'admin') || $this->session->userdata('role') == 1 && has_permission('buy now section 2')) { ?> <li class="<?php if ($currentURL == "admin/buynow-section-1") {echo "active";}?>"><a href="<?php echo base_url('admin/buynow-section-1'); ?>">Buy Now Section 2</a></li><?php }?>
                                 </ul>
                              </li>
                              <?php }?>      
                              <?php if (($this->session->userdata('type') == 'admin') || $this->session->userdata('role') == 1 && has_permission('footer pages')) { ?>
                                 <li>
                                    <a href="#footerPagesDropdown" aria-expanded="false" data-toggle="collapse"><i class="icon-interface-windows"></i>Footer Pages</a>
                                    <ul id="footerPagesDropdown" class="collapse list-unstyled">
                                       <?php if (($this->session->userdata('type') == 'admin') || $this->session->userdata('role') == 1 && has_permission('Terms Conditions')) { ?><li class="<?php if ($currentURL == 'admin/terms_condition') {echo 'active';}?>">
                                          <a href="<?php echo base_url('admin/terms_condition'); ?>">Terms Conditions</a>
                                    </li><?php }?>
                                    <?php if (($this->session->userdata('type') == 'admin') || $this->session->userdata('role') == 1 && has_permission('Disclaimer')) { ?><li class="<?php if ($currentURL == 'admin/disclaimer') {echo 'active';}?>">
                                       <a href="<?php echo base_url('admin/disclaimer'); ?>">Disclaimer</a>
                                    </li><?php }?>
                                    <?php if (($this->session->userdata('type') == 'admin') || $this->session->userdata('role') == 1 && has_permission('Cancellation Refund Policy')) { ?><li class="<?php if ($currentURL == 'admin/cancellation_and_refund_policy') {echo 'active';}?>">
                                       <a href="<?php echo base_url('admin/cancellation_and_refund_policy'); ?>">Cancellation & Refund Policy</a>
                                    </li><?php }?>
                                    <?php if (($this->session->userdata('type') == 'admin') || $this->session->userdata('role') == 1 && has_permission('Privacy Policy')) { ?><li class="<?php if ($currentURL == 'admin/privacy-policy') {echo 'active';}?>">
                                       <a href="<?php echo base_url('admin/privacy-policy'); ?>">Privacy Policy</a>
                                    </li><?php }?>
                                    <?php if (($this->session->userdata('type') == 'admin') || $this->session->userdata('role') == 1 && has_permission('Important update')) { ?><li class="<?php if ($currentURL == 'admin/important_update') {echo 'active';}?>">
                                       <a href="<?php echo base_url('admin/important_update'); ?>">Important update</a>
                                    </li><?php }?>
                                 </ul>
                              </li>
                              <?php }?>
                              <?php if (($this->session->userdata('type') == 'admin') || $this->session->userdata('role') == 1 && has_permission('Admin settings')) { ?>
                              <li>
                                 <a href="#adminSettingsDropdown" aria-expanded="false" data-toggle="collapse"><i class="icon-interface-windows"></i>Admin Settings</a>
                                 <ul id="adminSettingsDropdown" class="collapse list-unstyled">
                                    <?php if (($this->session->userdata('type') == 'admin') || $this->session->userdata('role') == 1 && has_permission('Documents')) { ?>
                                    <li>
                                       <a href="#branchDocumentDropdown" aria-expanded="false" data-toggle="collapse">Documents</a>
                                       <ul id="branchDocumentDropdown" class="collapse list-unstyled">
                                          <?php if (($this->session->userdata('type') == 'admin') || $this->session->userdata('role') == 1 && has_permission('certificate')) { ?> <li class="<?php if ($currentURL == 'admin/certificate') {echo 'active';}?>">
                                             <a href="<?php echo base_url('admin/certificate'); ?>">Certificate</a>
                                          </li><?php }?>
                                          <?php if (($this->session->userdata('type') == 'admin') || $this->session->userdata('role') == 1 && has_permission('visiting card')) { ?> <li class="<?php if ($currentURL == 'admin/visiting-card') {echo 'active';}?>">
                                             <a href="<?php echo base_url('admin/visiting-card'); ?>">Visiting Card</a>
                                          </li><?php }?>
                                          <?php if (($this->session->userdata('type') == 'admin') || $this->session->userdata('role') == 1 && has_permission('id card')) { ?> <li class="<?php if ($currentURL == 'admin/id-card') {echo 'active';}?>">
                                             <a href="<?php echo base_url('admin/id-card'); ?>">ID Card</a>
                                          </li><?php }?>
                                          <?php if (($this->session->userdata('type') == 'admin') || $this->session->userdata('role') == 1 && has_permission('banner')) { ?> <li class="<?php if ($currentURL == 'admin/joining-banner') {echo 'active';}?>">
                                             <a href="<?php echo base_url('admin/joining-banner'); ?>">Banner</a>
                                          </li><?php }?>
                                          <?php if (($this->session->userdata('type') == 'admin') || $this->session->userdata('role') == 1 && has_permission('joining letter')) { ?> <li class="<?php if ($currentURL == 'admin/joining-letter-section') {echo 'active';}?>">
                                             <a href="<?php echo base_url('admin/joining-letter-section'); ?>">Joining Letter</a>
                                          </li><?php }?>
                                       </ul>
                                    </li>
                                    <?php } ?>
                                    <?php if (($this->session->userdata('type') == 'admin') || $this->session->userdata('role') == 1 && has_permission('Qr payment')) { ?>
                                       <li class="<?php if ($currentURL == 'admin/qr') {echo 'active';}?>">
                                          <a href="<?php echo base_url('admin/qr'); ?>">Qr and Payment</a>
                                       </li>
                                    <?php } ?>
                                    <?php if (($this->session->userdata('type') == 'admin') || $this->session->userdata('role') == 1 && has_permission('lead dashboard')) { ?>
                                       <li class="<?php if ($currentURL == 'admin/lead_transfer') {echo 'active';}?>">
                                          <a href="<?php echo base_url('admin/lead_transfer'); ?>">Lead dashboard</a>
                                       </li>
                                    <?php } ?>
                                       <!-- Color -->
                                    <?php if (($this->session->userdata('type') == 'admin') || $this->session->userdata('role') == 1 && has_permission('Color')) { ?>
                                    <li>
                                       <a href="#colorDropdown" aria-expanded="false" data-toggle="collapse">Color</a>
                                       <ul id="colorDropdown" class="collapse list-unstyled">
                                          <?php if (($this->session->userdata('type') == 'admin') || $this->session->userdata('role') == 1 && has_permission('Admin color')) { ?> <li class="<?php if ($currentURL == 'admin/admin-color') {echo 'active';}?>">
                                             <a href="<?php echo base_url('admin/admin-color'); ?>">Admin Color</a>
                                          </li><?php }?>
                                          <?php if (($this->session->userdata('type') == 'admin') || $this->session->userdata('role') == 1 && has_permission('card color')) { ?> <li class="<?php if ($currentURL == 'admin/card-color') {echo 'active';}?>">
                                             <a href="<?php echo base_url('admin/card-color'); ?>">Card Color</a>
                                          </li><?php }?>
                                       </ul>
                                    </li>
                                    <?php }?>
                                    <?php if (($this->session->userdata('type') == 'admin') || $this->session->userdata('role') == 1 && has_permission('branch-location')) { ?>
                                       <li class="<?php if ($currentURL == 'admin/branch-location') {echo 'active';}?>">
                                          <a href="<?php echo base_url('admin/branch-location'); ?>">Branch Location</a>
                                       </li>
                                    <?php } ?>

                                    <?php if (($this->session->userdata('type') == 'admin')) { ?>
                                       <li class="<?php if ($currentURL == 'admin/menu-position') {echo 'active';}?>">
                                          <a href="<?php echo base_url('admin/menu-position'); ?>">Menu Position Change</a>
                                       </li>
                                    <?php } ?>
                                 
                                 </ul>
                              </li>
                              <?php } ?>
                           </ul>
                        </li>
                        <?php }?>
                        <?php
                           $showMenu = true;  
                           $userId = $this->session->userdata('user_id');
                           $roleId = $this->session->userdata('role');
                           if ($userId && $roleId) {
                              $user = $this->db->get_where('user_master', ['id' => $userId,'role' => $roleId ])->row();
                              if (!empty($user) && !empty($user->parent_id)) {
                                 $parent = null;
                                 if ($user->parent_id_role == 2) {
                                       $parent = $this->db->get_where('user_master', ['id' => $user->parent_id])->row();
                                 }
                                 if ($user->parent_id_role == 3) {
                                       $parent = $this->db->get_where('branch_franchise', ['id' => $user->parent_id])->row();
                                 }
                                 if (!empty($parent) && isset($parent->role) && $parent->role != 1) {
                                    $showMenu = false;
                                 }
                              }
                           }
                        ?>
                        <?php if ($showMenu) { ?>
                           <?php if (($this->session->userdata('type') == 'admin') || has_permission('Marketing material & Sales Data')) { ?>
                           <li data-id="<?= $menu_possition['marketing_material_sales_data'] ?>"><a href="#marketing_dropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-interface-windows"></i>Marketing material & Sales Data</a>
                              <ul id="marketing_dropdown" class="collapse list-unstyled">
                                 <?php if (has_permission('Marketing data') || ($this->session->userdata('type') == 'admin')) { ?>
                                    <li class=<?php if ($currentURL == "marketing-data") {echo "active";}?>><a href="<?php echo base_url('admin/marketing-data'); ?>">Marketing data</a></li>
                                 <?php }?>

                                 <?php if (has_permission('Marketing WhatsApp software') || ($this->session->userdata('type') == 'admin')) { ?>
                                 <?php if (($this->session->userdata('role') == 1)) { ?>
                                    <li class=<?php if ($currentURL == "marketing-whatsapp") {echo "active";}?>><a href="<?php echo base_url('admin/marketing-whatsapp'); ?>">Marketing WhatsApp software</a></li>
                                 <?php }else{?>
                                    <?php 
                                       $user_id = $this->session->userdata('user_id');
                                       $role  = $this->session->userdata('role');
                                    $marketing_whatesapp  = $this->db->get_where('marketing_whatsapp', ['user_id' => $user_id , 'domain_id' =>domain_id_get(), 'user_role_id' => $role])->row();
                                       if (!empty($marketing_whatesapp)) {
                                       ?>
                                    <li class=<?php if ($currentURL == "marketing-whatsapp-credentials") {echo "active";}?>><a href="<?php echo base_url('admin/marketing-whatsapp-credentials/'.$marketing_whatesapp->id); ?>">Marketing WhatsApp software</a></li>
                                 <?php }else{?>
                                 <li class=<?php if ($currentURL == "access-denied") {echo "active";}?>><a href="<?php echo base_url('admin/access-denied'); ?>">Marketing WhatsApp software</a></li>
                                 <?php }}}?>
                                 
                                 </ul>
                           </li>
                        <?php }?>
                     <?php }?>
                     <?php
                     $count4 = $this->db->where('team_id', $_SESSION['user_id'])->where('status !=', 2)->get('loan_enquiry_tbl')->num_rows();
                     $count5 = $this->db->where('team_id', $_SESSION['user_id'])->where('status !=', 2)->get('government_services_tbl')->num_rows();
                     $count6 = $this->db->where('team_id', $_SESSION['user_id'])->where('status !=', 2)->get('brand_loan_tbl')->num_rows();
                  
                     ?>
                     <?php if ($this->session->userdata('type') == 'admin' || $count > 0 ||  $count2 > 0 ||  $count3 > 0 || ($this->session->userdata('role') == 1 &&  has_permission('Loan Enquiry'))) { ?>
                     <li data-id="<?= $menu_possition['loan_enquiry'] ?>" class="<?php if ($currentURL == 'loan-enquiry') {echo 'active';}?>"><a href="<?php echo base_url('admin/loan-enquiry'); ?>"><i class="fa fa-money"></i> Loan Enquiry</a></li>
                     <?php }?>
                     <?php if ($this->session->userdata('type') == 'admin' || $count > 0 ||  $count2 > 0 ||  $count3 > 0 || ($this->session->userdata('role') == 1 &&  (has_permission('Government Services')))  ) { ?>
                     <li data-id="<?= $menu_possition['government_services'] ?>" class="<?php if ($currentURL == 'government-services') {echo 'active';}?>"><a href="<?php echo base_url('admin/government-services'); ?>"><i class="fa fa-building"></i> Government Services</a></li>
                     <?php }?>
                     <?php if (domain_id_get() == 3) {?>
                     <?php if ($this->session->userdata('type') == 'admin' || $count > 0 ||  $count2 > 0 ||  $count3 > 0 || ($this->session->userdata('role') == 1 &&  (has_permission('Brand loan')))  ) { ?>
                     <li data-id="<?= $menu_possition['brand_loan'] ?>" class="<?php if ($currentURL == 'brand-loan') {echo 'active';}?>"><a href="<?php echo base_url('admin/brand-loan'); ?>"><i class="fa fa-building"></i> Brand loan</a></li>
                     <?php }?>
                     <?php }?>
                     <li style="margin-bottom: 100px;"><a href="<?php echo base_url('admin/Login/logout'); ?>"><i class="fa fa-sign-out"></i>Logout</a></li>
                  </ul>
               </nav>
         </div>
         <!---- col-md-2 end  ----->
<script>
$(document).ready(function() {
   var $menuItems = $(".side-navbar > ul > li");
   $menuItems.sort(function(a, b) {
   return ($(a).data('id') || 999) - ($(b).data('id') || 999);
});
$(".side-navbar > ul").append($menuItems);
});         
</script>
         <div class="col-md-10 clr_bg_new px-0" style=" transform: translateY(70px); "> <!---- col-md-8 start  ----->