<!doctype html>
<html lang="en">
<?php
    $domain_id = domain_id_get();
    $contectUs = $this->db->where('domain_id', $domain_id)->get('contect_us')->row_array(); ?>  
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description"
        content="Expert Financial Consultation with <?= isset($contectUs['company_title']) && !empty($contectUs['company_title']) ? $contectUs['company_title'] :'' ?> ™ Quick Registration and Process. Apply Now at <?= isset($contectUs['company_title']) && !empty($contectUs['company_title']) ? $contectUs['company_title'] :'' ?> & Get Best Financial Consultation" />
    <meta name="keywords" content="Apply for Business loan, Business loan online, Business loan approval" />
    <link rel="apple-touch-icon" sizes="180x180" href="https://nowofloan.com/assets/images/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="16x16" href="https://nowofloan.com/assets/images/favicon-16x16.png">
    <link rel="icon" type="image/x-icon" href="https://nowofloan.com/assets/images/favicon.ico">
    <link rel="stylesheet" href="<?= base_url()?>upload/assets/css/plugins.css">
    <link rel="stylesheet" href="<?= base_url()?>upload/assets/css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Apply for Expert Financial Consultation | <?= isset($contectUs['company_title']) && !empty($contectUs['company_title']) ? $contectUs['company_title'] :'' ?></title>
</head>

<body>
    <div class="body-inner">
        <section class="fullscreen"><div class="parallax-container img-loaded"  style="background: url(<?= base_url()?>upload/assets/images/bw-business-bg.jpg);">
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 center b-r-6 background-white p-30">
                        <div class="text-center m-b-30">
                            <a href="#" class="logo"> 
                              
                            <!-- <img src="<?= base_url()?>upload/assets/images/logo.png" alt="<?= isset($contectUs['company_title']) && !empty($contectUs['company_title']) ? $contectUs['company_title'] :'' ?>" width="250"> </a> -->
                            <img src="<?= base_url('beta/assets/images/logo/' . (isset($contectUs['logo']) && !empty($contectUs['logo']) ? $contectUs['logo'] : '')) ?>" alt="<?= isset($contectUs['company_title']) && !empty($contectUs['company_title']) ? $contectUs['company_title'] :'' ?>" width="250"> </a>
                        </div>
    
                        <h4 class="text-center">Customer Account Login</h4>
                        
                        
                        <!--<form action="<?php echo base_url('/customer-login');?>" id="submitForm1" class="" novalidate="novalidate" method="post" accept-charset="utf-8">-->
                        <?php if( $this->session->flashdata('message') ) {?>
                          <span class="text-center text-danger mb-3"> <?php  echo $this->session->flashdata('message') ; ?></span>
                          <?php }?>
                          <?php echo form_open('customer-login',['id'=>'submitForm1' ])?>   
                           
                                <div class="form-group">
                                    <label class="sr-only">Email</label>
                                    <input type="text" name="email" class="form-control" placeholder="Email" aria-required="true" required=""> 
                                    <?php echo form_error('email','<span class="text-danger mt-1">','</span>') ;?>  
                                    <div class="help-block font-small-3"></div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="sr-only">Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="Password" aria-required="true" required=""> 
                                    <?php echo form_error('password','<span class="text-danger mt-1">','</span>') ;?>
                                    <div class="help-block font-small-3"></div>
                                </div>
                                <div class="form-group">
                                    <input type="submit" id="form-submit1" name="submit" value="login" class="btn btn-block btn-secondary"/>
                                </div>
                         <?php echo form_close()?>					
                        <!--<p class="small text-right"><a href="#">Forgot password?</a></p>-->
                        <button type="button" class="btn btn-primary small text-right" data-toggle="modal" data-target="#myModal" style="margin-left: 62%"> Forgot password? </button>
    
                        <hr>
                        <p class="text-center m-b-0">Don't have an account yet? <a href="<?php echo base_url('personalLoan') ;?>">Apply Now</a> </p>
                    </div>
                    
                      
                    
                </div>
            </div>
        </section>
    </div>
    
      <!-- The Modal -->
      <div class="modal" id="myModal">
        <div class="modal-dialog">
          <div class="modal-content">
                <form name="forgetPassword" action="<?php echo base_url('/forgetPassword');?>" method="post">
                    <!-- Modal Header -->
                    <div class="modal-header">
                      <h4 class="modal-title">Forget Password</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                
                    <!-- Modal body -->
                    <div class="modal-body">
                         <!--<input type="email" name="email" id="email" required/>-->
                         <div class="form-group">
                            <label class="sr-only">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Email" aria-required="true" required=""> 
                            <?php echo form_error('email','<span class="text-danger mt-1">','</span>') ;?>  
                            <div class="help-block font-small-3"></div>
                        </div>
                    
                    </div>
                
                
                    <div class="modal-footer">
                        <div class="form-group">
                        <!--<label class="sr-only">Email</label>-->
                        <input type="submit" class="btn btn-primary" name="submit"  value="submit" />
                        <div class="help-block font-small-3">
                          
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
          </div>
        </div>
      </div>
      
    <script src="./assets/js/jquery.js"></script>
    <script src="./assets/js/plugins.js"></script>
    <script src="./assets/js/functions.js"></script>
</body>