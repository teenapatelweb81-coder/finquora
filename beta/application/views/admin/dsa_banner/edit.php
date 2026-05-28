<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>


<div class="container-fluid p-0">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
               <li class="breadcrumb-item"><a href="<?php echo base_url("admin-dashboard"); ?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Add Lead</li> 
           </ol>
         </nav>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 px-0 form-main">
            <div class="card form-card">
                <div id="success_message"></div>
                <span class="text-center text-info mb-2" id="susid"><?php echo $this->session->flashdata('success'); ?></span>
                <span class="text-center text-danger mb-2" id="errid"><?php echo $this->session->flashdata('error'); ?></span>
                <?php echo form_open_multipart('admin/dsa-banner-update'); ?>
                
                <div class="row">
                    <!-- Check if $dsaBanner is set and is an array before accessing -->
                    <input type="hidden" name="id" id="uid" class="form-control" value="<?php echo (isset($dsaBanner) && is_array($dsaBanner) && isset($dsaBanner['id'])) ? $dsaBanner['id'] : ''; ?>">
                </div>

                <div class="row">
                    <?php
                    $selected_domain_id = isset($_GET['domain_id']) ? (int)$_GET['domain_id'] : null;
                    $website_id = $selected_domain_id ?? domain_id_get();

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
                    <?php } else { ?>
                        <input type="hidden" name="domain_id" class="form-control" value="<?= $website_id ?>">
                    <?php } ?>
                    
                    <div class="col-md-6">
                        <label for="title" class="form-label">Title<span class="text-danger">*</span></label>
                        <input type="text" name="title" id="title" class="form-control" value="<?php echo (isset($dsaBanner) && is_array($dsaBanner) && isset($dsaBanner['title'])) ? $dsaBanner['title'] : ''; ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label for="text" class="form-label">Text<span class="text-danger">*</span></label>
                        <input name="text" id="text" class="form-control" required value="<?php echo (isset($dsaBanner) && is_array($dsaBanner) && isset($dsaBanner['text'])) ? $dsaBanner['text'] : ''; ?>">
                    </div>

                    <div class="col-md-6">
                        <label for="background_color" class="form-label">Background Color<span class="text-danger">*</span></label>
                        <input name="background_color" id="background_color" class="form-control" required value="<?php echo (isset($dsaBanner) && is_array($dsaBanner) && isset($dsaBanner['background_color'])) ? $dsaBanner['background_color'] : ''; ?>">
                    </div>

                    <div class="col-md-6">
                        <label for="image" class="form-label">Image<span class="text-danger">*</span></label>
                        <input type="file" name="image" id="image" class="form-control" <?php echo (empty($dsaBanner) || !is_array($dsaBanner) || empty($dsaBanner['image'])) ? 'required' : ''; ?>>
                        <?php if (isset($dsaBanner) && is_array($dsaBanner) && !empty($dsaBanner['image'])) { ?>
                            <img src="<?= base_url('assets/images/dsaBanner/' . $dsaBanner['image']) ?>" alt="Image" width="100">
                        <?php } ?>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-5"></div>
                    <div class="col-md-2"> 
                        <div class="form-group">
                            <button type="submit" id="create" value="create" class="btn btn-info mt-4">Update</button>
                        </div>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>