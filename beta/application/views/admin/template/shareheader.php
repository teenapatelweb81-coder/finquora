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
      <link rel="stylesheet" href="<?php echo base_url();?>upload/admin/vendor/bootstrap/css/bootstrap.min.css">
      <!-- Font Awesome CSS-->
      <link rel="stylesheet" href="<?php echo base_url();?>upload/admin/vendor/font-awesome/css/font-awesome.min.css">
      <!-- Fontastic Custom icon font-->
      <link rel="stylesheet" href="<?php echo base_url();?>upload/admin/css/fontastic.css">
      <!-- Google fonts - Poppins -->
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">
      <!-- theme stylesheet-->
      <link rel="stylesheet" href="<?php echo base_url();?>upload/admin/css/style.green.css" id="theme-stylesheet">
      <!-- Custom stylesheet - for your changes-->
      <link rel="stylesheet" href="<?php echo base_url();?>upload/admin/css/custom.css">
      <!-- Favicon-->
      <link rel="shortcut icon" href="<?php //echo base_url();?>upload/admin/img/favicon.ico">
      <link rel="stylesheet" href="<?php echo base_url();?>upload/admin/css/admin.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="//cdn.ckeditor.com/4.14.1/full/ckeditor.js"></script>
      <!-- Google Font: Source Sans Pro -->
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="<?php echo base_url();?>upload/admin/plugins/fontawesome-free/css/all.min.css">
      <!-- Ionicons -->
      <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
      <!-- Tempusdominus Bootstrap 4 -->
      <link rel="stylesheet" href="<?php echo base_url();?>upload/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
      <!-- iCheck -->
      <link rel="stylesheet" href="<?php echo base_url();?>upload/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
      <!-- JQVMap -->
      <link rel="stylesheet" href="<?php echo base_url();?>upload/admin/plugins/jqvmap/jqvmap.min.css">
      <!-- Theme style -->
      <link rel="stylesheet" href="<?php echo base_url();?>upload/admin/dist/css/adminlte.min.css">
      <!-- overlayScrollbars -->
      <link rel="stylesheet" href="<?php echo base_url();?>upload/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
      <!-- Daterange picker -->
      <link rel="stylesheet" href="<?php echo base_url();?>upload/admin/plugins/daterangepicker/daterangepicker.css">
      <!-- summernote -->
      <link rel="stylesheet" href="<?php echo base_url();?>upload/admin/plugins/summernote/summernote-bs4.min.css">
   <?php $currentURL = $this->uri->segment(2); ?>   
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
 
</style>
   </head>
   <body>
    <?php
      $domain_id = domain_id_get();
      $contectUs = $this->db->where(($this->session->userdata('type') != 'admin') ? array('domain_id' => $domain_id) : array())->get('contect_us')->row_array();?>
      <?php
      if ($this->uri->segment(2) == 'share-pl' || $this->uri->segment(2) == 'share-bl') {
         $user = $this->db->where('id', $_GET['user_id'])->where('role', $_GET['role'])->get('branch_franchise')->row_array();
         if (empty($user)) {
            $user = $this->db->where('id', $_GET['user_id'])->where('role', $_GET['role'])->get('user_master')->row_array();
         }
      }else{
         $user = $this->db->where('id', $_GET['type'])->where('role', $_GET['role'])->get('branch_franchise')->row_array();
         if (empty($user)) {
            $user = $this->db->where('id', $_GET['type'])->where('role', $_GET['role'])->get('user_master')->row_array();
         }
      }
      ?>
          <div class="page">
      <!-- Main Navbar-->
      <header class="header">
         <nav class="navbar">
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
                        <div class="brand-text d-none d-lg-inline-block"><strong><?= isset($contectUs['company_title']) && !empty($contectUs['company_title']) ? $contectUs['company_title'] : ''?></strong></div>
                        <div class="brand-text d-none d-sm-inline-block d-lg-none"><strong></strong></div>
                     </a>
                     <!-- Toggle Button-->
                     <a id="toggle-btn" href="#" class="menu-btn active"><span></span><span></span><span></span></a>
                  </div>
                  <!-- Navbar Menu -->
                  <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                     <!-- Search-->
                      <?php //if ($this->uri->segment(2) == 'share-pl' || $this->uri->segment(2) == 'share-bl' || $this->uri->segment(2) == 'add-network-member-share' || $this->uri->segment(2) == 'add-member-share') {?>

                      <?php if(!empty($user['user_logo'])){?>
                          <img 
                class="img-thumbnail mr-2" 
                style=" max-height: 50px; object-fit:cover;"
                id="profile_photo_preview"  src="<?=base_url()?><?php echo $user['user_logo']; ?>" alt="Logo">
                <?php }?>
                     <li>Welcome <?= isset($contectUs['company_name']) && !empty($contectUs['company_name']) ? $contectUs['company_name'] : ''?> <span class='text-primary'>  </li>
                     
                    <li class="nav-item">
                         <a href="<?php echo base_url('admin/Login/logout');?>" class="nav-link logout">
                            <span class="d-none d-sm-inline">  </span>
                            <i class="fa fa-sign-out">
                            </i>
                        </a>
                    </li>
                    
                  </ul>
               </div>
            </div>
         </nav>
      </header>