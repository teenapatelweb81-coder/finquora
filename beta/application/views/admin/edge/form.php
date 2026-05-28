
<div class="container-fluid p-0">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin-dashboard");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">edgeForm</li>
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
            <?php echo form_open_multipart('admin/add-edge');?>
            
            <div class="row">
                <div class="col-md-6 mt-2">
                    <label for="Image Alt Description" class="form-label">Title <span class="text-danger">*</span></label>
                      <input type="text" name="title" id="title" class="form-control" value="<?= set_value('title'); ?>" required placeholder="Add Title">
                      <input type="hidden" name="type" value="edge">
                    <?php echo form_error('title','<span class="text-danger mt-1">','</span>') ;?>
               </div>
                 <?php
                  if ($this->session->userdata('type') == 'admin') { ?>
                        <div class="col-6 mb-3">
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
               <div class=" col-md-6  mt-2">
                 
                 <label for="Image Alt Description" class=" form-label">Description</label>
                 <input type="text" name="sub_title" id="sub_title" class="form-control" title="Enter product image" placeholder="Add Sub Title" >
                
                </div>
            </div>
            <div class="row">
             <div class="form-group col-md-6 mt-2">
                     <label for="Image Alt Description" class=" col-form-label">Edge Image(Upload size Max 2 MB) <span class="text-danger">*</span></label>
                     <input type="file"required name="slider_image" id="slider_image" class="form-control" title="Enter  image" placeholder="Add image" >
                     <span class="text-center text-danger mb-2" id="errid"> <?php  echo $this->session->flashdata('imgerror');?></span>
                     
              </div>
            </div>
  
             
            <div class="border-bottom border border-secondary mb-5 mt-5"></div>
             
            <div class="form-group row">
               <label for="Status" class="col-sm-2 col-form-label">Status <span class="text-danger">*</span></label>
               <div class="col-sm-10">
                  <select class="form-control" name="status" id="status">
                     <option value="">---- Choose a Status ----</option>
                     <option value="1" selected=""> Active</option>
                     <option value="0"> Inctive</option>
                  </select>
                  <span id="statusErr"></span>
                  <?php echo form_error('status','<span class="text-danger mt-1">','</span>') ;?>
               </div>
            </div>
            <div class="form-group">
               <label for="" class="col-sm-2 col-form-label"></label>
               <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-info mt-4">
               <a href="<?php echo base_url('admin/edge') ;?>" class="btn btn-secondary mt-4">Show</a>
            </div>
            <?php echo form_close();?>
         </div>
      </div>
   </div>
</div>
