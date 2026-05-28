<?php
//print_r($datas);
?>
<div class="container-fluid p-0">
   <div class="row">
      <div class="col-md-12 px-0">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin-dashboard");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Marketing WhatsApp Links </li>
           </ol>
         </nav>
</div>
<div class="container-fluid">
   <div class="row">
      <div class="col-md-12 px-0 mt-1 form-main">
         <div class="card  form-card">
            <div id="success_message"></div>
             <span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>
             <span class="text-center text-white bg-danger mb-2" id="errid"> <?php  echo $this->session->flashdata('error');?></span>
            <?php echo form_open_multipart('admin/update-whatsapp-transfer',['id'=>'sliderfrmm']);?>
            
            <div class="row">
                 <?php
               if ($this->session->userdata('type') == 'admin') { ?>
                     <div class="col-md-6 mt-2">
                           <label for="domain_id_main" class="form-label">Domain</label>
                           <select class="form-control" id="domain_id_main" required name="domain_id">
                              <?php foreach ($domains as $domain) { ?>
                                 <option <?= (domain_id_get() == $domain['id']) ? 'selected' : ''; ?> value="<?= $domain['id'] ?>"> <?= $domain['url'] ?></option>
                              <?php } ?>
                           </select>
                     </div>
               <?php }else{?>
                  <input type="hidden" name="domain_id"  class="form-control" value="<?= domain_id_get() ?>" >
                  <?php }?>        
                  <input type="hidden" name="id"  class="form-control" value="<?= $datas->id ?>" >
               
                <div class=" col-md-6 mt-2">
                 
                  <label for="Image Alt Description" class=" form-label"> URL</label>
                  <input type="text" name="url" id="url" class="form-control" title="redirection" placeholder="Add url" value="<?= isset($datas->url) ? $datas->url : ''; ?>">
                     <?php echo form_error('url','<span class="text-danger mt-1">','</span>') ;?>
                 </div>
            </div>
            
  
             
            <!-- <div class="border-bottom border border-secondary mb-5 mt-5"></div>
             
            <div class="form-group row">
               <label for="Status" class="col-sm-2 col-form-label">Status <span class="text-danger">*</span></label>
               <div class="col-sm-10">
                  <select class="form-control" name="status" id="status">
                     <option value="">---- Choose a Status ----</option>
                     <option value="1" <?= ($datas->status ==1)? 'selected = selected' : '' ?> > Active</option>
                     <option value="0" <?= ($datas->status ==0)? 'selected = selected' : '' ?> > Inactive</option>
                  </select>
                  <span id="statusErr"></span>
                  <?php echo form_error('status','<span class="text-danger mt-1">','</span>') ;?>
               </div>
            </div> -->
            <div class="form-group">
               <label for="" class="col-sm-2 col-form-label"></label>
               <input type="submit" name="submit" id="submit" value="Update" class="btn btn-info mt-4">
               <a href="<?php echo base_url('admin/whatsapp_transfer') ;?>" class="btn btn-secondary mt-4">Show</a>
            </div>
            <?php echo form_close();?>
         </div>
      </div>
   </div>
</div>
