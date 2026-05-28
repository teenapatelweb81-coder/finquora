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
      

   </head>
   <body>
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
                        <div class="brand-text d-none d-lg-inline-block"><strong>InstantLoansDeals</strong></div>
                        <div class="brand-text d-none d-sm-inline-block d-lg-none"><strong>BD</strong></div>
                     </a>
                     <!-- Toggle Button-->
                     <a id="toggle-btn" href="#" class="menu-btn active"><span></span><span></span><span></span></a>
                  </div>
                  <!-- Navbar Menu -->
                  <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                     <!-- Search-->
                     <li>Welcome <span class='text-primary'> <?php echo $this->session->userdata('username'); ?></span> </li>
                     <!-- Logout    -->
                     <li class="nav-item"><a href="<?php echo base_url('admin/Login/logout');?>" class="nav-link logout"> <span class="d-none d-sm-inline">Logout</span><i class="fa fa-sign-out"></i></a></li>
                  </ul>
               </div>
            </div>
         </nav>
      </header>
      <div class="container-fluid p-0">
      <div class="row">
      <div class="col-md-2">
         <div class="page-content d-flex align-items-stretch">
            <!-- Side Navbar -->
            <nav class="side-navbar">
               <ul class="list-unstyled">
                  <li class="active"><a href="<?php echo base_url('admin-dashboard') ;?>"> <i class="icon-home"></i></a></li>
                  
                   <!--  <li><a href="#menuDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-interface-windows"></i>Manage Menu</a>-->
                   <!--  <ul id="menuDropdown" class="collapse list-unstyled">-->
                   <!--     <li><a href="<?php echo base_url('Menu/main_menu') ;?>">Main Menu</a></li>-->
                   <!--     <li><a href="<?php echo base_url('Menu/sub_menu') ;?>">Sub Menu</a></li>                        -->
                   <!--  </ul>-->
                   <!--</li>-->
<!--                   <li><a href="#userDropdown" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-user"></i>Manage User</a>-->
<!--                     <ul id="userDropdown" class="collapse list-unstyled">-->
<!--                        <li><a href="<?php echo base_url('Menu/user') ;?>">User</a></li>-->
<!--                        <li><a href="<?php //echo base_url('Menu/sub_menu') ;?>">Sub Menu</a></li>                        -->
<!--                     </ul>-->
<!--                   </li>-->
                  
                   
                  <!--<li>-->
                  <!--   <a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse">Manage Products</a>-->
                  <!--   <ul id="exampledropdownDropdown" class="collapse list-unstyled">-->
                  <!--      <li><a href="<?php echo base_url('admin/user-order');?>">User Order</a></li> -->
                  <!--      <li><a href="<?php echo base_url('category');?>">Add Category</a></li>-->
                  <!--      <li><a href="<?php echo base_url('subcategory');?>">Add Subategory</a></li>-->
                  <!--      <li><a href="<?php echo base_url('product');?>">Add Product</a></li>-->
                  <!--      <li><a href="<?php echo base_url('admin/add-coupon');?>">Add Coupon</a></li>-->
                  <!--      <li><a href="<?php echo base_url('gallary');?>">Product Images</a></li>-->
                  <!--   </ul>-->
                  <!--</li>-->
                    
                    
                        <!--<li><a href="<?php echo base_url('category');?>">Add Category</a></li>-->
                        <!--<li><a href="<?php echo base_url('subcategory');?>">Add Subategory</a></li>-->
                        <!--<li><a href="<?php echo base_url('admin/about-us');?>">About Us</a></li>-->
                        <!--<li><a href="<?php echo base_url('admin/slider');?>">Add Slider</a></li>-->
                        <!--<li><a href="<?php echo base_url('admin/blog');?>">Our Blog</a></li>-->
                        <!--<li><a href="<?php echo base_url('admin/policy');?>">Policy</a></li>-->
                        <!--<li><a href="<?php echo base_url('admin/add-testimonial');?>">Add Testimonial</a></li>-->
                        <li><a href="<?php echo base_url('admin/site-setting');?>"><i class="fa fa-cog" aria-hidden="true"></i> Website setting</a></li>
                        <!--<li><a href="<?php echo base_url('admin/register-user');?>">Registered User</a></li>-->
                        <!--<li><a href="<?php echo base_url('admin/contact-us');?>">Contact Us</a></li>-->
                        <!--<li><a href="<?php echo base_url('admin/subscribe');?>">Subscribe</a></li>-->
                        <li><a href="<?php echo base_url('admin/Login/logout');?>"><i class="fa fa-sign-out"></i>Logout</a></li>
				       
				         
				  <!--<li><a href="<?php //echo base_url('admin/Dashboard/impulForm');?>">Impul</a></li>-->
				  
				  
	
				  
                  <!--<li><a href="#footerDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-interface-windows"></i>Footer</a>-->
                  <!--   <ul id="footerDropdown" class="collapse list-unstyled">-->
                  <!--      <li><a href="<?php echo base_url('admin/Dashboard/productAll') ;?>">Our Products</a></li>-->
                  <!--      <li><a href="<?php echo base_url('admin/Dashboard/policyData') ;?>">Footer Pages</a></li>-->
                  <!--      <li><a href="<?php echo base_url('admin/Dashboard/socialAll') ;?>">Social</a></li>-->
                  <!--      <li><a href="<?php echo base_url('admin/Dashboard/subscribe') ;?>">Subscribe</a></li>-->
                  <!--      <li><a href="<?php echo base_url('admin/Dashboard/conact') ;?>">Contact-Us Data</a></li>-->
                  <!--      <li><a href="<?php echo base_url('admin/Dashboard/enquiry') ;?>">Enquiry Form</a></li>-->
                        
                  <!--   </ul>-->
                  <!--</li>-->
               </ul>
               <!-- <span class="heading">Extras</span>
               <ul class="list-unstyled">
                  <li> <a href="#"> <i class="icon-flask"></i>Demo </a></li>
               </ul> -->
            </nav>
         </div> 
      </div> <!---- col-md-2 end  ----->
      <div class="col-md-10"> <!---- col-md-8 start  ----->