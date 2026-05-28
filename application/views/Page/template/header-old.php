<!doctype html>

<html lang="en">

  <head>

    <!-- Required meta tags -->

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="description" content="Expert Financial Consultation with Instantloansdeals™ Quick Registration and Process. Apply Now at Instantloansdeals.com & Get Best Financial Consultation" />

    <meta name="keywords" content="Apply for Personal loan, Personal loan online, personal loan approval" />

    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('upload/assets') ?>/images/apple-icon-180x180.png">

    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('upload/assets') ?>/images/favicon-16x16.png">

    <link rel="icon" type="image/x-icon" href="<?= base_url('upload/assets') ?>/images/favicon.ico">

    <link rel="stylesheet" href="<?= base_url('upload/assets') ?>/css/plugins.css">

    <link rel="stylesheet" href="<?= base_url('upload/assets') ?>/css/style.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Apply for Expert Financial Consultation | Instantloansdeals</title>

  </head>

  <body>

    <div class="body-inner">

      <div id="topbar" class="d-none d-xl-block d-lg-block topbar-transparent topbar-fullwidth dark">

          <div class="container">

            <div class="row">

              <div class="col-md-6">

                <ul class="top-menu">

                  <li><a href="tel:+91-9890284889"><i class="fa fa-phone m-r-5"></i> +91-9890284889</a></li>

                  <li><a href="mailto:info@Instantloansdeals.com"><i class="fa fa-envelope m-r-5"></i> info@Instantloansdeals.com</a></li>

                </ul>

              </div>

    

              <div class="col-md-6 d-none d-sm-block">

                <ul class="top-menu right">

                  <li><a href="<?= base_url('raise-request') ?>">Raise a Request</a></li>

                  <li><a href="<?= base_url('important-update') ?>">Important Update</a></li>

                </ul>

              </div>

            </div>

          </div>

      </div>

       <!--====================header=============================-->

      <header id="header" data-transparent="true" data-fullwidth="true" class="light submenu-light">

          <div class="header-inner">

            <div class="container">

    

              <div id="logo"> 

                <a href="<?= base_url() ?>">
                <?php $contectUs = $this->db->where('user_id',1)->get('contect_us')->row_array(); ?>
                  <!-- <span class="logo-default"><img src="<?= base_url('upload/assets') ?>/logo.png" alt="InstantLoanDeals" width="220"></span> -->
                  <span class="logo-default"><img src="<?= base_url('beta/assets/images/logo/'.$contectUs['logo']) ?>" alt="InstantLoanDeals" width="220"></span>

                  <span class="logo-dark"><img src="<?= base_url('upload/assets') ?>/images/dark-logo.png" alt="InstantLoanDeals" width="220"></span>

                </a> 

              </div>

    

              <div id="mainMenu-trigger">

                <a class="lines-button x"><span class="lines"></span></a>

              </div>

    

              <div id="mainMenu">

                <div class="container">

                  <nav>

                    <ul>

                      <li id="102" class="dropdown"><a href="#">Company</a>

                        <ul class="dropdown-menu" >

                          <li id="1021" class=""><a href="<?= base_url('company') ?>"><i class="fa fa-info-circle"></i> Profile</a></li>

                          <!--<li id="1022" class=""><a href="#"><i class="fa fa-file-pdf"></i> White Paper</a></li>-->

                          <!--<li id="1023" class=""><a href="<?= base_url('career') ?>"><i class="fa fa-chart-line"></i> Career</a></li>-->

                          <li id="1024" class=""><a href="<?= base_url('contact') ?>"><i class="fa fa-map"></i> Contact Us</a></li>

                        </ul>

                      </li>

    

                      <li id="103" class="dropdown"><a href="#">Our Services</a>

                        <ul class="dropdown-menu" >

                          <li id="1031" class=""><a href="<?= base_url('/premium-membership-card') ?>"><i class="fa fa-credit-credit"></i> Silver Membership</a></li>

                          <li id="1032" class=""><a href="<?= base_url('/plantinum-membership-card') ?>"><i class="fa fa-credit-credit"></i> Platinum Membership</a></li>

                          <!--<li id="1032" class=""><a href="#"><i class="fa fa-credit-credit"></i> Finmax Plan</a></li>-->

                          <li id="1033" class=""><a href="<?= base_url('channel-partner-code')?>"><i class="fa fa-credit-credit"></i> DSA Registration</a></li>

                        </ul>

                      </li>

    

                      <li id="111" class=""><a href="<?= base_url('channel-partner-code')?>">DSA Registration</a></li>
                      <li id="111" class=""><a href="<?= base_url('branch-franchise-code')?>">Branch Franchise Registration</a></li>

                <li id="" class=""><a href="<?= base_url('blog')?>">Blog</a></li>

                      <li id="109" class="dropdown"><a href="#">Customer Plan</a>

                        <ul class="dropdown-menu" >

                          <li id="1091" class=""><a href="<?= base_url('premium-membership-card')?>"><i class="fa fa-rupee-sign"></i> Premium Membership</a></li>

                          <li id="1092" class=""><a href="<?= base_url('plantinum-membership-card')?>"><i class="fa fa-rupee-sign"></i> Platinum Membership</a></li>

                         

                        </ul>

                      </li>
                      <?php if(!$this->session->userdata('role')) { ?>
                         <li id="112" class="dropdown"><a href="#">Leads</a>
                         <ul class="dropdown-menu" >
                            <li id="1091" class=""><a href="<?= base_url('beta/admin/share-pl?user_id=')?>">Personal Loan</a></li>
                            <li id="1091" class=""><a href="<?= base_url('beta/admin/share-bl?user_id=')?>">Business loan</a></li>
                          </ul>               
                        </li>
                      <?php }?>

                      <?php if($this->session->userdata('username')) { ?>

                        <li id="112" class="dropdown"><a href="#"><?php echo $this->session->userdata('username'); ?></a>

                            <ul class="dropdown-menu menu-last" >

                          <?php if($this->session->userdata('role') != NULL) { ?>
                              <li id="1121" class=""><a href="<?= base_url('profile') ?>"><i class="fa fa-users"></i> Profile </a></li>
                            <?php }?>
                            <?php if($this->session->userdata('role') != 1) { ?>
                              <li id="1121" class=""><a href="<?= base_url('Cards') ?>"><i class="fa fa-users"></i> Active Membership</a></li>
                            <?php }?>
                            <?php if($this->session->userdata('role') == '') { ?>
                              <li id="1121" class=""><a href="<?= base_url('Loan_details') ?>"><i class="fa fa-users"></i> Loan Details</a></li>
                            <?php }?>
                              <li id="1123" class=""><a href="<?= base_url('logout') ?>"><i class="fa fa-users"></i> Logout</a></li>

                            </ul>

                        </li>

                      

                      <?php } else { ?>

                      

                            <li id="112" class="dropdown"><a href="#">Login</a>

                            <ul class="dropdown-menu menu-last" >

                              <li id="1121" class=""><a href="<?= base_url('customer') ?>"><i class="fa fa-users"></i> Customer Login</a></li>
                              <li id="1123" class=""><a href="<?= base_url('beta/desk-login/branch') ?>"><i class="fa fa-users"></i> 
                              Branch Franchise Login</a></li>
                              <li id="1123" class=""><a href="<?= base_url('beta/desk-login') ?>"><i class="fa fa-users"></i> DSA Login</a></li>

                              <li id="1123" class=""><a href="<?= base_url('beta/desk-login/admin') ?>"><i class="fa fa-users"></i> Admin Login</a></li>

                             

                            </ul>

                          </li>

                      <? } ?>

                       <li>

                          <div class="header-extras">

                                        <div class="p-dropdown">

                                            <a class="x"><span class="lines"></span></a>

                                            <ul class="p-dropdown-content">

                                                <li><a href="tel:+91-9890284889"><i class="icon-phone-call"></i>+91-9890284889</a>

                                                </li>

                                                <li><a href="mailto:info@Instantloansdeals.com"><i class="icon-mail"></i>info@Instantloansdeals.com</a>

                                                </li>

                                            </ul>

                                        </div>

                                    </div>

                          

                      </li>

                      

                     </ul>

                  </nav>

                </div>

              </div>

    

            </div>

          </div>

      </header>