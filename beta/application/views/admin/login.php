<!DOCTYPE html>
<html>
   <head>
      <title>Admin Login</title>
      <?php echo link_tag('upload/admin/vendor/bootstrap/css/bootstrap.min.css');?>
      <?php echo link_tag('upload/admin/css/admin.css');?>

     <style>
       body {
            background: <?php echo (domain_id_get() == 22) 
               ? "url('" . base_url('upload/assets/bg-img.jpeg') . "')  bottom center / cover" 
               : "#80d4e3"; ?>;
         }
         #myform {
             margin-top: 40px !important;
         }
         .btn_forget:focus{
            outline:unset !important;
         }
     </style>

   </head>
   <body class="body">
      <div class="container">
         <div class="row">
            
  <?php   $type = $this->uri->segment(2);?>  
             <div class="log_in shadow mt-50">
                  <div class="col-sm-12 text-center">
                     <?php
                            $domain_id = domain_id_get();
                            $contectUs = $this->db->where('domain_id', $domain_id)->get('contect_us')->row_array(); ?>    
                            <!-- <img src="<?= base_url()?>upload/assets/images/logo.png" alt="InstaLoansDeals" width="250"> </a> -->
                            <img src="<?= base_url('assets/images/logo/' . (isset($contectUs['logo']) && !empty($contectUs['logo']) ? $contectUs['logo'] : '')) ?>" alt="<?= isset($contectUs['company_title']) && !empty($contectUs['company_title']) ? $contectUs['company_title'] :'' ?>" style="width: 200px;margin-bottom: 8px;max-height: 120px;"> </a>
                        </div>
                  <div class="clearfix"></div>


                  <?php if( $this->session->flashdata('message') ) {?>
                  <span class="text-center text-danger mb-3"> <?php  echo $this->session->flashdata('message') ; ?></span>
                  <?php }?>
                 <?php echo form_open('desk-login/'.$type, ['id' => 'myform']) ?>
                  
                  <div class="form-group">
                     <input type="text" name="email" id="email"  class="form-control box_in3" autocomplete="off" placeholder="">
                     <?php echo form_error('email','<span class="text-danger mt-1">','</span>') ;?>  
                     <label class="form-control-placeholder2" for="email">Email Id</label>
                  </div>
                  <div class="form-group">
                     <input type="Password" name="password" id="password"  class="form-control box_in3" autocomplete="off" placeholder="">
                     <?php echo form_error('password','<span class="text-danger mt-1">','</span>') ;?>
                     <label class="form-control-placeholder2" for="password">Password</label>
                  </div>
                  <div class="form-group">
                     <input type=submit name="submit" class="btn  sub">
                   </div>
                   
                   <div class="col-sm-12 text-center link">
                   <?php 
                        $current_domain = $_SERVER['HTTP_HOST']; // Get current domain
                        $base_url = ($this->session->userdata('authenticated')) ? "/beta/" : "/";

                        $home_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://") . $current_domain . $base_url;
                     ?>
                         <a href="<?= $home_url; ?>"  class="text-decoration-none font-weight-bolder">Go To Home</a>
                        </div>
                    <div class="col-sm-12 text-center link">
                        <button type="button" class="btn_forget" style="border: unset;color: #007bff; font-weight: 400; background: unset;" data-toggle="modal" data-target="#myModal"> Forgot password? </button>
                     </div>
                  <?php echo form_close()?>
               </div>
            
         </div>
      </div>
      
      <!-- The Modal -->
      <div class="modal" id="myModal">
        <div class="modal-dialog">
          <div class="modal-content">
                <form name="forgetPassword" action="<?php echo base_url('admin/agent-password/');?><?= $this->uri->segment(2);?>" method="post">
                    <!-- Modal Header -->
                    <div class="modal-header">
                      <h4 class="modal-title">Agent Forget Password</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                
                    <!-- Modal body -->
                    <div class="modal-body">
                         <!--<input type="email" name="email" id="email" required/>-->
                         <div class="form-group">
                            <label class="sr-only">email</label>
                            <input type="email" name="email" class="form-control" placeholder="email" aria-required="true" required=""> 
                            <?php echo form_error('email','<span class="text-danger mt-1">','</span>') ;?>  
                            <div class="help-block font-small-3"></div>
                        </div>
                         <div class="form-group">
                            <label class="sr-only">Mobile</label>
                            <input type="number" name="mobile_no" class="form-control" placeholder="Mobile" aria-required="true" required=""> 
                            <?php echo form_error('mobile_no','<span class="text-danger mt-1">','</span>') ;?>  
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
      
     <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
      
      <!--<script src="<?php //echo base_url('upload/admin/vendor/jquery.min.js')?>"></script>-->
      <!--<script src="<?php //echo base_url('upload/admin/vendor/bootstrap/js/bootstrap.min.js')?>"></script>-->
      
   </body>
</html>