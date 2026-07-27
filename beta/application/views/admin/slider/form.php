
<div class="container-fluid p-0">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin-dashboard");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Slider  Form</li>
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
            <?php echo form_open_multipart('admin/add-slider',['id'=>'sliderfrmm']);?>
            
            <div class="row">
                <div class="col-md-6 mt-2">
                    <label for="Image Alt Description" class="form-label">Title <span class="text-danger">*</span></label>
                      <input type="text" name="title" id="title" class="form-control" value="<?= set_value('title'); ?>" placeholder="Add Title">
                    <?php echo form_error('title','<span class="text-danger mt-1">','</span>') ;?>
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
                <div class="col-md-6 mt-2">
                     <label for="Image Alt Description" class=" form-label">Sub Title</label>
                    <input type="text" name="sub_title" id="sub_title" class="form-control" title="Enter product image" placeholder="Add Sub Title" value="<?= set_value('sub_title'); ?>">
                     <?php echo form_error('sub_title','<span class="text-danger mt-1">','</span>') ;?>
                </div>
                <div class="col-md-6 mt-2">
                     <label for="button_name" class=" form-label">Button Name</label>
                    <input type="text" name="button_name" id="button_name" class="form-control" title="Enter button_name" placeholder="Add button name" value="<?= set_value('button_name'); ?>">
                     <?php echo form_error('button_name','<span class="text-danger mt-1">','</span>') ;?>
                </div>
               <div class="col-md-6 mt-2">
                  <label for="button_color" class="form-label">Button Color</label>
                  <div class="input-group">
                     <input type="text" name="button_color" id="button_color" class="form-control" placeholder="Add button color" value="<?= set_value('button_color'); ?>">
                     <input type="color" id="button_color_picker" class="form-control form-control-color" value="<?= set_value('button_color') ? set_value('button_color') : '#0d6efd'; ?>">
                  </div>
                  <?php echo form_error('button_color','<span class="text-danger mt-1">','</span>'); ?>
               </div>
                <div class="col-md-6 mt-2">
                     <label for="url" class=" form-label">Redirection</label>
                    <input type="text" name="url" id="url" class="form-control" title="Enter url" placeholder="Add url" value="<?= set_value('url'); ?>">
                     <?php echo form_error('url','<span class="text-danger mt-1">','</span>') ;?>
                </div>
            </div>
            <div class="row">
             <div class="form-group col-md-6 mt-2">
                     <label for="Image Alt Description" class=" col-form-label">Slider Image(Upload size Max 2 MB) <span class="text-danger">*</span></label>
                     <input type="file" name="slider_image" id="slider_image" class="form-control" title="Enter product image" placeholder="Add Catogery image" >
                     <span class="text-center text-danger mb-2" id="errid"> <?php  echo $this->session->flashdata('imgerror');?></span>
              </div>
             <div class="form-group col-md-6 mt-2">
                     <label for="Image Alt Description" class=" col-form-label">Slider Background Image(Upload size Max 2 MB) <span class="text-danger">*</span></label>
                     <input type="file" name="bg_image" id="bg_image" class="form-control" title="Enter product image" placeholder="Add Catogery image" >
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
               <a href="<?php echo base_url('admin/slider') ;?>" class="btn btn-secondary mt-4">Show</a>
            </div>
            <?php echo form_close();?>
         </div>
      </div>
   </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function () {

    const textInput = document.getElementById("button_color");
    const colorPicker = document.getElementById("button_color_picker");

    // Initial Sync
    if (textInput.value) {
        colorPicker.value = textInput.value;
    } else {
        textInput.value = colorPicker.value;
    }

    // Text → Color Picker
    textInput.addEventListener("input", function () {
        if (/^#[0-9A-Fa-f]{6}$/.test(this.value)) {
            colorPicker.value = this.value;
        }
    });

    // Color Picker → Text
    colorPicker.addEventListener("input", function () {
        textInput.value = this.value;
    });

});
</script>
