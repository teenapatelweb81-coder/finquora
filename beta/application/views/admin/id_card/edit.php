<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>




<div class="container-fluid p-0">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin-dashboard");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Edit ID Card</li> 
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
                    <?php echo form_open_multipart('admin/id-card-update');?>
                    <span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success'); ?></span>
                <span class="text-center text-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error'); ?></span>
                    
                    <div class="row">
                        <input type="hidden" name="id" id="uid" class="form-control" value="<?php echo $idCard['id']; ?>" >
                    
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

                        <!-- <div class="col-md-6">
                            <label for="image" class="form-label">Image<span class="text-danger">*</span></label>
                            <input type="file" name="image" id="image" class="form-control" <?php if(empty($idCard['image'])){ ?> required <?php } ?> >
                            <?php if(!empty($idCard['image'])){ ?>
                            <img src="<?= base_url('assets/images/idCard/'.$idCard['image']) ?>" alt="Image" width="100" height="100">
                            <?php } ?>
                        </div> -->

                        <div class="col-md-6">
                        <label for="side_background_color" class="form-label">Side Background Color</label>
                        <div class="input-group">
                            <input type="text" name="side_background_color" id="side_background_color" class="form-control" value="<?php echo $idCard['side_background_color']; ?>" oninput="syncColor('side_background_color', 'side_background_color_picker')">
                            <input type="color" id="side_background_color_picker" class="form-control form-control-color" value="<?php echo $idCard['side_background_color']; ?>" onchange="syncColor('side_background_color_picker', 'side_background_color')">
                        </div>
                        </div>

                        <div class="col-md-6">
                        <label for="text_color" class="form-label">Text Color<span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="text" name="text_color" id="text_color" class="form-control" required value="<?php echo $idCard['text_color']; ?>" oninput="syncColor('text_color', 'text_color_picker')">
                            <input type="color" id="text_color_picker" class="form-control form-control-color" value="<?php echo $idCard['text_color']; ?>" onchange="syncColor('text_color_picker', 'text_color')">
                        </div>
                        </div>

                        <div class="col-md-6">
                        <label for="background_color" class="form-label">Background Color<span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="text" name="background_color" id="background_color" class="form-control" required value="<?php echo $idCard['background_color']; ?>" oninput="syncColor('background_color', 'background_color_picker')">
                            <input type="color" id="background_color_picker" class="form-control form-control-color" value="<?php echo $idCard['background_color']; ?>" onchange="syncColor('background_color_picker', 'background_color')">
                        </div>
                        </div>

                        <div class="col-md-6">
                        <label for="background_color_2" class="form-label">Background Color Details<span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="text" name="background_color_2" id="background_color_2" class="form-control" required value="<?php echo $idCard['background_color_2']; ?>" oninput="syncColor('background_color_2', 'background_color_2_picker')">
                            <input type="color" id="background_color_2_picker" class="form-control form-control-color" value="<?php echo $idCard['background_color_2']; ?>" onchange="syncColor('background_color_2_picker', 'background_color_2')">
                        </div>
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
function syncColor(inputId, targetId) {
    document.getElementById(targetId).value = document.getElementById(inputId).value;
}
</script>