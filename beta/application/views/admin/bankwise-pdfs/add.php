<div class="container-fluid p-0">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin-dashboard");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Add CIBIL Score Check</li>
            </ol>
         </nav>
</div>
<div class="container-fluid px-0">
   <div class="row m-0">
      <div class="col-md-12 p-0 form-main">
         <div class="card  form-card">
            <div id="success_message"></div>
             <span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>
             <span class="text-center text-white bg-danger mb-2" id="errid"> <?php  echo $this->session->flashdata('error');?></span>
            <?php //echo form_open_multipart('admin/create-lead');?>
            
            
            
            <form action="<?= base_url('admin/Dashboard/bankwisePDFsStore')?>" method ="post" enctype="multipart/form-data">
             <div class="row">
                <div class="form-group col-md-6">
                <label for="title" class="form-label">Title<span class="text-danger">*</span></label>
                      <!-- <select name="bank_id" id="bank_id" class="form-control input-lg ng-pristine ng-valid ng-touched" >
                      <option>Select Bank</option>
                      <?php foreach($bank_data as $bank) { ?>
                        <option value="<?=$bank->id?>"><?=$bank->bank_name?></option>
                      <?php } ?>
                      </select> -->
                      <input type="text" id="bank_id" name="bank_id" class="form-control" required>
                       <?php echo form_error('bank_id','<span class="text-danger mt-1">','</span>') ;?>
                </div>

                <?php
                  if ($this->session->userdata('type') == 'admin') { ?>
                        <div class="col-md-6 mt-2">
                              <label for="domain_id_main" class="col-form-label">Domain</label>
                              <select class="form-control" id="domain_id_main" required name="domain_id">
                                 <?php foreach ($domains as $domain) { ?>
                                    <option <?= (domain_id_get() == $domain['id']) ? 'selected' : ''; ?> value="<?= $domain['id'] ?>"> <?= $domain['url'] ?></option>
                                 <?php } ?>
                              </select>
                        </div>
                  <?php }else{?>
                     <input type="hidden" name="domain_id"  class="form-control" value="<?= domain_id_get() ?>" >
                  <?php }?>           




                <div class="form-group col-md-6">
                <label for="title" class="form-label">Url<span class="text-danger">*</span></label>
                      <input type="text" id="url" name="url" class="form-control" >
                       <?php echo form_error('url','<span class="text-danger mt-1">','</span>') ;?>
                </div>
                 <div class="col-md-6">
                     <label for="url" class="form-label">Selct PDF File<span class="text-danger">*</span></label>
                     <input type="file" id="file" name="file" class="form-control">
                     <?php echo form_error('file','<span class="text-danger mt-1">','</span>') ;?>
                 </div>

                 <div class="col-md-12" >
                  <button type="submit" id="create" value="create" class="btn btn-info mt-4">Create </button>
                  </div>
            </div>
            
            
            
            
            <?php echo form_close();?>
         </div>
      </div>
   </div>
</div>
