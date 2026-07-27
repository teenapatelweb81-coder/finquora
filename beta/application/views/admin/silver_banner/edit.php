<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>




<div class="container-fluid p-0">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin-dashboard");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Edit Silver Banner</li> 
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
                    <?php echo form_open_multipart('admin/silver-banner-update');?>
                    <span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success'); ?></span>
                <span class="text-center text-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error'); ?></span>
                    
                    <div class="row">
                        <input type="hidden" name="id" id="uid" class="form-control" value="<?= (isset($silverBanner['id'])) ? $silverBanner['id'] : '' ; ?>" >
                    
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
                            <input type="text" name="title" id="title" class="form-control" value="<?= (isset($silverBanner['title'])) ? $silverBanner['title'] : '' ; ?> " required>
                            <?php //echo form_error('first_name','<span class="text-danger mt-1">','</span>') ;?>
                        </div>
                        <div class="col-md-6">
                            <label for="first_name" class="form-label">Sub Title<span class="text-danger">*</span></label>
                            <input type="text" name="subtitle" id="subtitle" class="form-control" value="<?= (isset($silverBanner['subtitle'])) ? $silverBanner['subtitle'] : '' ; ?>" required>
                            <?php //echo form_error('first_name','<span class="text-danger mt-1">','</span>') ;?>
                        </div>
                        <div class="col-md-6">
                            <label for="description" class="form-label">Text<span class="text-danger">*</span></label>
                            <input name="text" id="text" class="form-control" required value="<?= (isset($silverBanner['text'])) ? $silverBanner['text'] : '' ; ?>" >
                            <?php //echo form_error('description','<span class="text-danger mt-1">','</span>'); ?>
                        </div>

                        <div class="col-md-6">
                            <label for="background_color" class="form-label">Background_Color<span class="text-danger">*</span></label>
                            <input name="background_color" id="background_color" class="form-control" required value="<?= (isset($silverBanner['background_color'])) ? $silverBanner['background_color'] : '' ; ?>" >
                            <?php //echo form_error('description','<span class="text-danger mt-1">','</span>'); ?>
                        </div>

                        <div class="col-md-6">
                            <label for="image" class="form-label">Image<span class="text-danger">*</span></label>
                            <input type="file" name="image" id="image" class="form-control" <?php if(empty($silverBanner['image'])){ ?> required <?php } ?> >
                            <?php if(!empty($silverBanner['image'])){ ?>
                            <img src="<?= base_url('assets/images/silverBanner/'.$silverBanner['image']) ?>" alt="Image" width="100"> 
                            <?php } ?>
                            <?php //echo form_error('description','<span class="text-danger mt-1">','</span>'); ?>
                        </div>

                      


                        
                      
                    </div>
                    
                
                    
                    <div class="row">
                        <div class="col-md-12">
                        <div class="card-header pl-0">
                                <h4>Premium Membership Section four</h4>
                            </div>
                        </div>
                        
                       <div class="col-md-6">
                            <label for="four_title" class="form-label">Heading<span class="text-danger">*</span></label>
                            <input name="four_title" id="four_title" class="form-control" required value="<?= (isset($silverBanner['four_title'])) ? $silverBanner['four_title'] : '' ; ?>" >
                            <?php //echo form_error('description','<span class="text-danger mt-1">','</span>'); ?>
                        </div>

                       <div class="col-md-6">
                            <label for="four_sub_title" class="form-label">text<span class="text-danger">*</span></label>
                            <input name="four_sub_title" id="four_sub_title" class="form-control" required value="<?= (isset($silverBanner['four_sub_title'])) ? $silverBanner['four_sub_title'] : '' ; ?>" >
                            <?php //echo form_error('description','<span class="text-danger mt-1">','</span>'); ?>
                        </div>

                        <div class="col-md-12">
                        <div class="card-header pl-0">
                                <h4>Premium Membership Section Five</h4>
                            </div>
                        </div>
                        
                       <div class="col-md-6">
                            <label for="five_title" class="form-label">Heading<span class="text-danger">*</span></label>
                            <input name="five_title" id="five_title" class="form-control" required value="<?= (isset($silverBanner['five_tilte'])) ? $silverBanner['five_tilte'] : '' ; ?>" >
                            <?php //echo form_error('description','<span class="text-danger mt-1">','</span>'); ?>
                        </div>

                       <div class="col-md-6">
                            <label for="five_sub_title" class="form-label">text<span class="text-danger">*</span></label>
                            <input name="five_sub_title" id="five_sub_title" class="form-control" required value="<?= (isset($silverBanner['five_sub_title'])) ? $silverBanner['five_sub_title'] : '' ; ?>" >
                            <?php //echo form_error('description','<span class="text-danger mt-1">','</span>'); ?>
                        </div>

                       <div class="col-md-6">
                            <label for="disclaimer" class="form-label">Disclaimer<span class="text-danger">*</span></label>
                            <input name="disclaimer" id="disclaimer" class="form-control" required value="<?= (isset($silverBanner['Disclaimer'])) ? $silverBanner['Disclaimer'] : '' ; ?>" >
                            <?php //echo form_error('description','<span class="text-danger mt-1">','</span>'); ?>
                        </div>

                        
                    </div>

                        <div class="text-center"> 
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
