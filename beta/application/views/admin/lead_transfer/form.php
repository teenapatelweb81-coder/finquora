
<div class="container-fluid p-0">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin-dashboard");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">leads</li>
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
            <?php echo form_open_multipart('admin/add-lead-transfer');?>
            
            <div class="row">
                <?php
                     $selected_domain_id = isset($_GET['domain_id']) ? (int)$_GET['domain_id'] : null;
                     
                     if ($selected_domain_id) {
                        $website_id = $selected_domain_id;
                     } else {
                        $website_id = domain_id_get();
                     }

                     if ($this->session->userdata('type') == 'admin') { ?>
                        <div class="col-12 mb-3">
                              <div class="col-4 mb-3">
                                 <label for="domain_id_main" class="col-form-label">Domain</label>
                                 <select class="form-control" id="domain_id_main" required name="domain_id" onchange="window.location.href = window.location.pathname + '?domain_id=' + this.value;">
                                    <?php foreach ($domains as $domain) { ?>
                                          <option <?= ($website_id == $domain['id']) ? 'selected' : ''; ?> value="<?= $domain['id'] ?>"> <?= $domain['url'] ?></option>
                                    <?php } ?>
                                 </select>
                              </div>
                        </div>
                  <?php }else{?>
                     <input type="hidden" name="domain_id"  class="form-control" value="<?= $website_id ?>" >
                  <?php }?>

                
            
                <div class="col-md-6 mt-2">
                     <label for="url" class=" form-label">Url</label>
                    <input type="text" name="url" id="url" class="form-control" title="Enter url" placeholder="Add url" value="<?= set_value('url'); ?>">
                     <?php echo form_error('url','<span class="text-danger mt-1">','</span>') ;?>
                     <input type="hidden" name="type" value="partner_slider">
                </div>
            </div>
  
             
            <div class="border-bottom border border-secondary mb-5 mt-5"></div>
             
            <div class="form-group row">
               <label for="Status" class="col-sm-2 col-form-label">Status <span class="text-danger">*</span></label>
               <div class="col-sm-10">
                  <select class="form-control" name="status" id="status">
                     <option value="">---- Choose a Status ----</option>
                     <option value="1" > Active</option>
                     <option value="0" selected=""> Inctive</option>
                  </select>
                  <span id="statusErr"></span>
                  <?php echo form_error('status','<span class="text-danger mt-1">','</span>') ;?>
               </div>
            </div>
            <div class="form-group">
               <label for="" class="col-sm-2 col-form-label"></label>
               <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-info mt-4">
               <a href="<?php echo base_url('admin/lead_transfer') ;?>" class="btn btn-secondary mt-4">Show</a>
            </div>
            <?php echo form_close();?>
         </div>
      </div>
   </div>
</div>
