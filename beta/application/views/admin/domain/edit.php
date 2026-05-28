<?php
//print_r($datas);
?>

<div class="container-fluid p-0">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin-dashboard");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Domain  Form</li>
           </ol>
         </nav>
</div>
<div class="container-fluid">
   <div class="row">
      <div class="col-md-12 px-0 form-main">
         <div class="card  form-card">
            <div id="success_message"></div>
             <span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>
             <span class="text-center text-white bg-danger mb-2" id="errid"> <?php  echo $this->session->flashdata('error');?></span>
            <?php echo form_open_multipart('admin/rolepermission/domainUpdate',['id'=>'sliderfrmm']);?>
            <input type="hidden" name="id" value="<?= $datas->id; ?>">
            <div class="row">
                <div class="col-md-6 mt-2">
                    <label for="Image Alt Description" class="form-label">Domain url </label>
                      <input type="text" name="url" id="url" class="form-control" value="<?= set_value('url', $datas->url); ?>" placeholder="Add Domain">
                    <?php echo form_error('url','<span class="text-danger mt-1">','</span>') ;?>
               </div>
               <div class="col-md-6 mt-2">
                  <label for="first_name" class="form-label">Payment status<span class="text-danger">*</span></label>
                  <select class="form-control" name="payment_status">
                     <option value='free' <?php if($datas->payment_status == 'free'){ echo 'selected';};?>>Free</option>
                     <option value='paid' <?php if($datas->payment_status == 'paid'){ echo 'selected';};?>>Paid</option>
                  </select>
            </div>
               <div class="col-md-6 mt-2">
                  <label for="first_name" class="form-label">Social status<span class="text-danger">*</span></label>
                  <select class="form-control" name="social_status">
                     <option value='mail' <?php if($datas->social_status == 'mail'){ echo 'selected';};?>>mail</option>
                     <option value='sms' <?php if($datas->social_status == 'sms'){ echo 'selected';};?>>sms</option>
                  </select>
            </div>
               
            </div>
            
  
             
            <div class="border-bottom border border-secondary mb-5 mt-5"></div>
             
            <div class="form-group row">
               <label for="Status" class="col-sm-2 col-form-label">Status <span class="text-danger">*</span></label>
               <div class="col-sm-10">
                  <select class="form-control" name="status" id="status">
                     <option value="">---- Choose a Status ----</option>
                     <option value="1" <?= ($datas->status ==1)? 'selected = selected' : '' ?> > Active</option>
                     <option value="2" <?= ($datas->status ==2)? 'selected = selected' : '' ?> > Inactive</option>
                  </select>
                  <span id="statusErr"></span>
                  <?php echo form_error('status','<span class="text-danger mt-1">','</span>') ;?>
               </div>
            </div>
            <div class="form-group">
               <label for="" class="col-sm-2 col-form-label"></label>
               <input type="submit" name="submit" id="submit" value="Update" class="btn btn-info mt-4">
               <a href="<?php echo base_url('admin/domain') ;?>" class="btn btn-secondary mt-4">Show</a>
            </div>
            <?php echo form_close();?>
         </div>
      </div>
   </div>
</div>
