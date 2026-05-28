<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>




<div class="container-fluid p-0">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin-dashboard");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Add Lead</li> 
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
                    <?php echo form_open_multipart('admin/card-color-update');?>
                    <span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success'); ?></span>
                <span class="text-center text-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error'); ?></span>
                    
                    <div class="row">
                        <input type="hidden" name="id" id="uid" class="form-control" value="<?= (isset($cardColor['id'])) ? $cardColor['id'] : '' ; ?>" >
                    
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
                        <label for="card_text_color" class="form-label">Card Text Color<span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="text" name="card_text_color" id="card_text_color" class="form-control" required value=" <?= (isset($cardColor['card_text_color'])) ? $cardColor['card_text_color'] : '' ; ?> " oninput="syncColor('card_text_color', 'card_text_color_picker')">
                            <input type="color" id="card_text_color_picker" class="form-control form-control-color" value="<?= (isset($cardColor['card_text_color'])) ? trim($cardColor['card_text_color']) : '' ; ?>" onchange="syncColor('card_text_color_picker', 'card_text_color')">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="details_text_color" class="form-label">Details Text Color<span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="text" name="details_text_color" id="details_text_color" class="form-control" required value=" <?= (isset($cardColor['details_text_color'])) ? $cardColor['details_text_color'] : '' ; ?> " oninput="syncColor('details_text_color', 'details_text_color_picker')">
                            <input type="color" id="details_text_color_picker" class="form-control form-control-color" value="<?= (isset($cardColor['details_text_color'])) ? trim($cardColor['details_text_color']) : '' ; ?>" onchange="syncColor('details_text_color_picker', 'details_text_color')">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="background_color" class="form-label">Background Color<span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="text" name="background_color" id="background_color" class="form-control" required value=" <?= (isset($cardColor['background_color'])) ? $cardColor['background_color'] : '' ; ?> " oninput="syncColor('background_color', 'background_color_picker')">
                            <input type="color" id="background_color_picker" class="form-control form-control-color" value="<?= (isset($cardColor['background_color'])) ? trim($cardColor['background_color']) : '' ; ?>" onchange="syncColor('background_color_picker', 'background_color')">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="image" class="form-label">Card image<span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="file" name="image" id="image" class="form-control" >
                        </div>
                        <?php if(!empty($cardColor['image'])){ ?>
                            <img src="<?= base_url('assets/images/plantinumBanner/'.$cardColor['image']) ?>" alt="Image" width="100" class="mt-2">
                        <?php } ?>    
                    </div>
                </div>  
                    
                    <div class="row">
                        
                        <div class="col-md-5">
                            
                        </div>
                        <div class="col-md-2"> 
                            <div class="form-group">
                            <button type="submit"  id="create" value="create" class="btn btn-info mt-4">update </button>
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