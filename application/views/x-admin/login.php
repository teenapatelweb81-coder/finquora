<!DOCTYPE html>
<html>
   <head>
      <title>Admin Login</title>
      <?php echo link_tag('upload/admin/vendor/bootstrap/css/bootstrap.min.css');?>
      <?php echo link_tag('upload/admin/css/admin.css');?>

     <style>
         .body{
             background:#80d4e3;
         }
     </style>

   </head>
   <body class="body">
      <div class="container">
         <div class="row">
            
               <div class="log_in shadow mt-50">
                  <div class="col-sm-12 text-center"><img src="<?php echo base_url(); ?>upload/assets/logo.png" style="width: 200px; margin-bottom: 40px;"></div>
                  <div class="clearfix"></div>


                  <?php if( $this->session->flashdata('message') ) {?>
                  <span class="text-center text-danger mb-3"> <?php  echo $this->session->flashdata('message') ; ?></span>
                  <?php }?>
                  <?php echo form_open('desk-login',['id'=>'myform'])?>
                  
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
                   <div class="col-sm-12 text-center link"><a href="<?= base_url(); ?>" target="_blank" class="text-decoration-none font-weight-bolder">Go To Home</a></div>
                  <?php echo form_close()?>
               </div>
            
         </div>
      </div>
      
      <script src="<?php echo base_url('upload/admin/vendor/jquery.min.js')?>"></script>
      <script src="<?php echo base_url('upload/admin/vendor/bootstrap/js/bootstrap.min.js')?>"></script>
      
   </body>
</html>