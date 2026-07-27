<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>




<div class="container-fluid p-0">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin-dashboard");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Edit Branch Banner</li> 
           </ol>
         </nav>
</div>
<div class="container-fluid">
    
    <!-- <form action="<?php //base_url('admin/banker-create')?>" method="post"> -->
        <div class="row">
            <div class="col-md-12 px-0 form-main">
                <div class="card  form-card">
                    <div id="success_message"></div>
                    <span class="text-center text-info mb-2" id="susid"></span>  <?php //echo $this->session->flashdata('success');?>
                    <span class="text-center text-white bg-danger mb-2" id="errid"> </span> <?php // echo $this->session->flashdata('error');?>
                    <?php echo form_open_multipart('admin/branch-banner-update');?>
                    <span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success'); ?></span>
                <span class="text-center text-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error'); ?></span>
                    
                    <div class="row">
                        <input type="hidden" name="id" id="uid" class="form-control" value="<?php echo (isset($branchBanner) && is_array($branchBanner) && isset($branchBanner['id'])) ? $branchBanner['id'] : ''; ?>" >
                    
                    </div>

                    
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


                        <div class="col-md-6">
                            <label for="first_name" class="form-label">Title<span class="text-danger">*</span></label>
                            <input type="text" name="title" id="title" class="form-control" value="<?php echo (isset($branchBanner) && is_array($branchBanner) && isset($branchBanner['title'])) ? $branchBanner['title'] : ''; ?> " required>
                            <?php //echo form_error('first_name','<span class="text-danger mt-1">','</span>') ;?>
                        </div>
                        <div class="col-md-6">
                            <label for="description" class="form-label">Text<span class="text-danger">*</span></label>
                            <input name="text" id="text" class="form-control" required value="<?php echo (isset($branchBanner) && is_array($branchBanner) && isset($branchBanner['text'])) ? $branchBanner['text'] : ''; ?>" >
                            <?php //echo form_error('description','<span class="text-danger mt-1">','</span>'); ?>
                        </div>

                        <!-- <div class="col-md-6">
                            <label for="background_color" class="form-label">Background_Color<span class="text-danger">*</span></label>
                            <input name="background_color" id="background_color" class="form-control" required value="<?php echo (isset($branchBanner) && is_array($branchBanner) && isset($branchBanner['background_color'])) ? $branchBanner['background_color'] : ''; ?>" >
                            <?php //echo form_error('description','<span class="text-danger mt-1">','</span>'); ?>
                        </div> -->
                        <div class="col-md-6">
                            <label for="button_name" class="form-label">Button Name<span class="text-danger">*</span></label>
                            <input type="text" name="button_name" id="button_name" class="form-control " required value="<?php echo (isset($branchBanner) && is_array($branchBanner) && isset($branchBanner['button_name'])) ? $branchBanner['button_name'] : ''; ?>" >
                            <?php //echo form_error('button_name','<span class="text-danger mt-1">','</span>'); ?>
                        </div>
                        <div class="col-md-6">
                            <label for="button_link" class="form-label">Button Link<span class="text-danger">*</span></label>
                            <input type="text" name="button_link" id="button_link" class="form-control" required value="<?php echo (isset($branchBanner) && is_array($branchBanner) && isset($branchBanner['button_link'])) ? $branchBanner['button_link'] : ''; ?>" >
                            <?php //echo form_error('button_link','<span class="text-danger mt-1">','</span>'); ?>
                        </div>
                        <div class="col-md-6">
                            <label for="button_color" class="form-label">Button Color</label>
                            <div class="input-group">
                                <input type="text" name="button_color" id="button_color" class="form-control text-left" placeholder="Add button color" value="<?php echo (isset($branchBanner) && is_array($branchBanner) && isset($branchBanner['button_color'])) ? $branchBanner['button_color'] : ''; ?>">
                                <input type="color" id="button_color_picker" class="form-control form-control-color" value="<?php echo (isset($branchBanner) && is_array($branchBanner) && isset($branchBanner['button_color'])) ? $branchBanner['button_color'] : ''; ?>">
                            </div>
                            <?php echo form_error('button_color','<span class="text-danger mt-1">','</span>'); ?>
                        </div>
                        <div class="col-md-6">
                            <label for="text_color" class="form-label">Text Color</label>
                            <div class="input-group">
                                <input type="text" name="text_color" id="text_color" class="form-control" placeholder="Add button color" value="<?php echo (isset($branchBanner) && is_array($branchBanner) && isset($branchBanner['text_color'])) ? $branchBanner['text_color'] : ''; ?>">
                                <input type="color" id="text_color_picker" class="form-control form-control-color" value="<?php echo (isset($branchBanner) && is_array($branchBanner) && isset($branchBanner['text_color'])) ? $branchBanner['text_color'] : ''; ?>">
                            </div>
                            <?php echo form_error('text_color','<span class="text-danger mt-1">','</span>'); ?>
                        </div>

                        <div class="col-md-6">
                            <label for="background_color" class="form-label">Background Color</label>
                            <div class="input-group">
                                <input type="text" name="background_color" id="background_color" class="form-control" placeholder="Add button color" value="<?php echo (isset($branchBanner) && is_array($branchBanner) && isset($branchBanner['background_color'])) ? $branchBanner['background_color'] : ''; ?>">
                                <input type="color" id="background_color_picker" class="form-control form-control-color" value="<?php echo (isset($branchBanner) && is_array($branchBanner) && isset($branchBanner['background_color'])) ? $branchBanner['background_color'] : ''; ?>">
                            </div>
                            <?php echo form_error('background_color','<span class="text-danger mt-1">','</span>'); ?>
                        </div>

                        <div class="col-md-6">
                            <label for="image" class="form-label">Image<span class="text-danger">*</span></label>
                            <input type="file" name="image" id="image" class="form-control" <?php if(empty($branchBanner['image'])){ ?> required <?php } ?> >
                            <?php if(!empty($branchBanner['image'])){ ?>
                            <img src="<?= base_url('assets/images/branchBanner/'.$branchBanner['image']) ?>" alt="Image" width="100">
                            <?php } ?>
                            <?php //echo form_error('description','<span class="text-danger mt-1">','</span>'); ?>
                        </div>

                      


                        
                      
                    </div>
                    
                
                    
                    <div class="row">
                        
                        <div class="col-md-5">
                            
                        </div>
                        <div class="col-md-2"> 
                            <div class="form-group">
                            <button type="submit"  id="create" value="create" class="btn btn-info mt-4">update </button>
                            <!-- <a href="<?php //echo base_url('admin/banker_create') ;?>" class="btn btn-secondary mt-4">Create</a> -->
                            </div>
                            
                        </div>
                        <!-- <div class="col-md-5">
                            
                        </div> -->
                        
                    </div>
                    <?php echo form_close();?>
                </div>
            </div>
        </div>
    <!-- </form> -->
</div>
<script>
document.addEventListener("DOMContentLoaded", function () {

    function initColorPicker(textInputId, colorPickerId) {
        const textInput = document.getElementById(textInputId);
        const colorPicker = document.getElementById(colorPickerId);

        if (!textInput || !colorPicker) return;

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
    }

    // Background Color
    initColorPicker("background_color", "background_color_picker");

    // Button Color
    initColorPicker("button_color", "button_color_picker");

    // Text Color
    initColorPicker("text_color", "text_color_picker");

});
</script>