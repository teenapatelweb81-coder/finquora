<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>




<div class="container-fluid p-0">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin-dashboard");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Edit Silver Section 2</li> 
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
                    <?php echo form_open_multipart('admin/silver-section-2-update');?>
                    <span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success'); ?></span>
                <span class="text-center text-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error'); ?></span>
                    
                    <div class="row">
                        <input type="hidden" name="id" id="uid" class="form-control" value="<?= (isset($silverSection1['id'])) ? $silverSection1['id'] : '' ; ?> " >
                    
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
                            <label for="first_name" class="form-label">Heading<span class="text-danger">*</span></label>
                            <input type="text" name="heading" id="heading" class="form-control" value="<?= (isset($silverSection1['heading'])) ? $silverSection1['heading'] : '' ; ?>  " required>
                            <?php //echo form_error('first_name','<span class="text-danger mt-1">','</span>') ;?>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="description" class="form-label">Text<span class="text-danger">*</span></label>
                            <input name="text" id="text" class="form-control" required value="<?= (isset($silverSection1['text'])) ? $silverSection1['text'] : '' ; ?> " >
                            <?php //echo form_error('description','<span class="text-danger mt-1">','</span>'); ?>
                        </div>

                        <div class="col-md-12">
                            <label for="description_1" class="form-label">Description<span class="text-danger">*</span></label>
                            <textarea name="description_1" id="description_1" class="form-control" required><?= (isset($silverSection1['description_1'])) ? $silverSection1['description_1'] : '' ; ?>  </textarea>
                            <?php //echo form_error('description','<span class="text-danger mt-1">','</span>'); ?>
                        </div>

                        <div class="col-md-12">
                            <label for="description_2" class="form-label">Description<span class="text-danger">*</span></label>
                            <textarea name="description_2" id="description_2" class="form-control" required><?= (isset($silverSection1['description_2'])) ? $silverSection1['description_2'] : '' ; ?> </textarea>
                            <?php //echo form_error('description','<span class="text-danger mt-1">','</span>'); ?>
                        </div>

                        <script>
                            CKEDITOR.replace('description_1');
                            CKEDITOR.replace('description_2');

                            document.querySelector('form').addEventListener('submit', function(e) {
                                const description = CKEDITOR.instances.description.getData().trim();
                                if (!description) {
                                    alert('Description is required!');
                                    e.preventDefault();
                                }
                            });
                        </script>



                       

                      


                        
                      
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
