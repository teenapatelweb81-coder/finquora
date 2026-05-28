<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<style>
    .cke_notification_warning{
        display:none;
    }
</style>



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
                    <?php echo form_open_multipart('admin/company-profile-update');?>
                    <span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success'); ?></span>
                <span class="text-center text-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error'); ?></span>
                    
                    <div class="row">
                       <input type="hidden" name="id" id="uid" class="form-control" value="<?php echo isset($datas['id']) ? htmlspecialchars($datas['id']) : ''; ?>" >
                    
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
                            <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control" value="<?php echo isset($datas['title']) ? htmlspecialchars($datas['title']) : ''; ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="sub_title" class="form-label">Title<span class="text-danger">*</span></label>
                            <input type="text" name="sub_title" id="sub_title" class="form-control" value="<?php echo isset($datas['sub_title']) ? htmlspecialchars($datas['sub_title']) : ''; ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="sub_title_text" class="form-label">Text<span class="text-danger">*</span></label>
                            <input type="text" name="sub_title_text" id="sub_title_text" class="form-control" value="<?php echo isset($datas['sub_title_text']) ? htmlspecialchars($datas['sub_title_text']) : ''; ?>" required>
                        </div>
                        <div class="col-md-12">
                            <label for="description" class="form-label">Left Description<span class="text-danger">*</span></label>
                            <textarea name="description" id="description" class="form-control" required><?php echo isset($datas['description']) ? htmlspecialchars($datas['description']) : ''; ?></textarea>
                        </div>
                        <div class="col-md-12">
                            <label for="description" class="form-label">Right Description<span class="text-danger">*</span></label>
                            <textarea name="right_description" id="right_description" class="form-control" required><?php echo isset($datas['right_description']) ? htmlspecialchars($datas['right_description']) : ''; ?></textarea>
                        </div>

                        <script>
                            CKEDITOR.replace('description');

                            document.querySelector('form').addEventListener('submit', function(e) {
                                const description = CKEDITOR.instances.description.getData().trim();
                                if (!description) {
                                    alert('Description is required!');
                                    e.preventDefault();
                                }
                            });
                            CKEDITOR.replace('right_description');

                            document.querySelector('form').addEventListener('submit', function(e) {
                                const description = CKEDITOR.instances.description.getData().trim();
                                if (!description) {
                                    alert('right description is required!');
                                    e.preventDefault();
                                }
                            });
                        </script>


                        
                      
                    </div>
                    
                
                    
                    <div class="row">
                        
                        <div class="col-md-12 mt-3">
                            <div class="card-header pl-0">
                                <h4>Second section</h4>
                            </div>
                        </div>
                            <div class="col-md-6">
                            <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                            <input type="text" name="second_title" id="name" class="form-control" value="<?php echo isset($datas['second_title']) ? htmlspecialchars($datas['second_title']) : ''; ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="sub_title" class="form-label">Short Description<span class="text-danger">*</span></label>
                            <input type="text" name="second_sub_title" id="sub_title" class="form-control" value="<?php echo isset($datas['second_sub_title']) ? htmlspecialchars($datas['second_sub_title']) : ''; ?>" required>
                        </div>
                        
                        <div class="col-md-12 mt-3">
                            <div class="card-header pl-0">
                                <h4>Third section</h4>
                            </div>
                        </div>
                            <div class="col-md-6">
                            <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                            <input type="text" name="third_title" id="name" class="form-control" value="<?php echo isset($datas['third_title']) ? htmlspecialchars($datas['third_title']) : ''; ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="sub_title" class="form-label">Short Description<span class="text-danger">*</span></label>
                            <input type="text" name="third_sub_title" id="sub_title" class="form-control" value="<?php echo isset($datas['third_sub_title']) ? htmlspecialchars($datas['third_sub_title']) : ''; ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="img" class="form-label">Image<span class="text-danger">*</span></label>
                            <input type="file" name="image" id="image" class="form-control">
                             <input type="hidden" name="image_id" value="<?php echo isset($datas['image']) ? htmlspecialchars($datas['image']) : ''; ?>">
                            <?php if (!empty($datas['image'])): ?>
                                <img src="<?php echo base_url('assets/images/media_coverage/' . htmlspecialchars($datas['image'])); ?>" alt="<?php echo htmlspecialchars($datas['alt_text'] ?? 'Media Coverage Image'); ?>" style="width: 100%; max-width: 100px;">
                                <?php endif; ?>
                        </div>

                        <div class="col-md-12 mt-3">
                            <div class="card-header pl-0">
                                <h4>Four section</h4>
                            </div>
                        </div>
                            <div class="col-md-6">
                            <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                            <input type="text" name="four_title" id="name" class="form-control" value="<?php echo isset($datas['four_title']) ? htmlspecialchars($datas['four_title']) : ''; ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="sub_title" class="form-label">Short Description<span class="text-danger">*</span></label>
                            <input type="text" name="four_sub_title" id="sub_title" class="form-control" value="<?php echo isset($datas['four_sub_title']) ? htmlspecialchars($datas['four_sub_title']) : ''; ?>" required>
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
