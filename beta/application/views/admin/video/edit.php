
<div class="container-fluid p-0">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin-dashboard");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Video</li>
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
            <?php //echo form_open_multipart('admin/create-lead');?>
            
            
            
            
             <div class="row">
                <div class="form-group col-md-6">
                <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                      <input type="text" name="title" id="title" class="form-control" maxlength="10"  required placeholder ="Enter Title">
                       <?php echo form_error('title','<span class="text-danger mt-1">','</span>') ;?>
                </div>
                 <div class="col-md-6">
                     <label for="video" class="form-label">Yourtube Video Link<span class="text-danger">*</span></label>
                     <input type="text" name="video" id="video" class="form-control" required>
                     <?php echo form_error('video','<span class="text-danger mt-1">','</span>') ;?>
                 </div>
                 <?php
                     if ($this->session->userdata('type') == 'admin') { ?>
                              <div class="form-group col-md-6">
                                 <label for="domain_id_main" class="col-form-label">Domain</label>
                                 <select class="form-control" id="domain_id_main" required name="domain_id">
                                    <?php foreach ($domains as $domain) { ?>
                                          <option value="<?= $domain['id'] ?>"> <?= $domain['url'] ?></option>
                                    <?php } ?>
                                 </select>
                              </div>
                     <?php }else{?>
                        <input type="hidden" name="domain_id"  class="form-control" value="<?= domain_id_get() ?>" >
                     <?php }?>
            </div>
            
            
            
            
            <?php echo form_close();?>
         </div>
      </div>
   </div>
</div>
