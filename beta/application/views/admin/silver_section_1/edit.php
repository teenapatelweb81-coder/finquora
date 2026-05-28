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
                    <?php echo form_open_multipart('admin/silver-section-1-update');?>
                    <span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success'); ?></span>
                <span class="text-center text-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error'); ?></span>
                    
                    <div class="row">
                        <input type="hidden" name="id" id="uid" class="form-control" value="<?= (isset($silverSection1['heading'])) ? $silverSection1['heading'] : '' ; ?> " >
                    
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
                            <input type="text" name="heading" id="heading" class="form-control" value="<?= (isset($silverSection1['heading'])) ? $silverSection1['heading'] : '' ; ?>" required>
                            <?php //echo form_error('first_name','<span class="text-danger mt-1">','</span>') ;?>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="description" class="form-label">Text<span class="text-danger">*</span></label>
                            <input name="text" id="text" class="form-control" required value="<?= (isset($silverSection1['text'])) ? $silverSection1['text'] : '' ; ?> " >
                            <?php //echo form_error('description','<span class="text-danger mt-1">','</span>'); ?>
                        </div>

                        <div class="col-md-12">
                            <label for="description" class="form-label">Description<span class="text-danger">*</span></label>
                            <textarea name="description" id="description" class="form-control" required><?= (isset($silverSection1['description'])) ? $silverSection1['description'] : '' ; ?> </textarea>
                            <?php //echo form_error('description','<span class="text-danger mt-1">','</span>'); ?>
                        </div>

                        

                        <div class="col-md-6">
                            <label for="previous_price" class="form-label">Previous Price<span class="text-danger">*</span></label>
                            <input name="previous_price" id="previous_price" class="form-control" required value="<?= (isset($silverSection1['previous_price'])) ? $silverSection1['previous_price'] : '' ; ?> " >
                            <?php //echo form_error('description','<span class="text-danger mt-1">','</span>'); ?>
                        </div>

                        <div class="col-md-6">
                            <label for="new_price" class="form-label">New price<span class="text-danger">*</span></label>
                            <input type="text" name="new_price" id="new_price" class="form-control"  required  value="<?= (isset($silverSection1['new_price'])) ? $silverSection1['new_price'] : '' ; ?> "> 
                           
                        </div>

                        <div class="col-md-6">
                            <label for="card_name" class="form-label">Card Name<span class="text-danger">*</span></label>
                            <input type="text" name="card_name" id="card_name" class="form-control"  required  value="<?= (isset($silverSection1['card_name'])) ? $silverSection1['card_name'] : '' ; ?> "> 
                           
                        </div>

                        <div class="col-md-6">
                            <label for="card_no" class="form-label">Card No<span class="text-danger">*</span></label>
                            <input type="text" name="card_no" id="card_no" class="form-control"  required  value="<?= (isset($silverSection1['card_no'])) ? $silverSection1['card_no'] : '' ; ?>"> 
                           
                        </div>

                        <div class="col-md-6">
                            <label for="validity" class="form-label">Validity<span class="text-danger">*</span></label>
                            <input type="text" name="validity" id="validity" class="form-control"  required  value="<?= (isset($silverSection1['validity'])) ? $silverSection1['validity'] : '' ; ?>"> 
                           
                        </div>

                        <div class="col-md-6">
                            <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control"  required  value="<?= (isset($silverSection1['name'])) ? $silverSection1['name'] : '' ; ?> "> 
                           
                        </div>
                        
                        <div class="col-md-6">
                            <label for="name" class="form-label">DSA Card plan  <span class="text-danger">*</span></label>
                            <textarea name="card_plan" id="card_plan" class="form-control" required><?php echo isset($silverSection1['card_plan']) ? htmlspecialchars($silverSection1['card_plan']) : ''; ?></textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="name" class="form-label">Branch Card plan  <span class="text-danger">*</span></label>
                            <textarea name="branch_card_plan" id="branch_card_plan" class="form-control" required><?php echo isset($silverSection1['branch_card_plan']) ? htmlspecialchars($silverSection1['branch_card_plan']) : ''; ?></textarea>
                        </div>

                        <div class="col-md-6">
                            <label for="name" class="form-label">Customer Card plan  <span class="text-danger">*</span></label>
                            <textarea name="customer_card_plan" id="customer_card_plan" class="form-control" required><?php echo isset($silverSection1['customer_card_plan']) ? htmlspecialchars($silverSection1['customer_card_plan']) : ''; ?></textarea>
                        </div>

                        <div class="col-md-6">
                            <label for="name" class="form-label">Network member Card plan<span class="text-danger">*</span></label>
                            <textarea name="network_card_plan" id="network_card_plan" class="form-control" required><?php echo isset($silverSection1['network_card_plan']) ? htmlspecialchars($silverSection1['network_card_plan']) : ''; ?></textarea>
                        </div>

                        <div class="col-md-6">
                            <label for="name" class="form-label">DSA Card plan for free<span class="text-danger">*</span></label>
                            <textarea name="free_card_plan" id="free_card_plan" class="form-control" required><?php echo isset($silverSection1['free_card_plan']) ? htmlspecialchars($silverSection1['free_card_plan']) : ''; ?></textarea>
                        </div>

                        <div class="col-md-6">
                            <label for="name" class="form-label">Branch Card plan for free<span class="text-danger">*</span></label>
                            <textarea name="branch_free_card_plan" id="branch_free_card_plan" class="form-control" required><?php echo isset($silverSection1['branch_free_card_plan']) ? htmlspecialchars($silverSection1['branch_free_card_plan']) : ''; ?></textarea>
                        </div>

                        <div class="col-md-6">
                            <label for="name" class="form-label">Customer Card plan for free<span class="text-danger">*</span></label>
                            <textarea name="customer_free_card_plan" id="customer_free_card_plan" class="form-control" required><?php echo isset($silverSection1['customer_free_card_plan']) ? htmlspecialchars($silverSection1['customer_free_card_plan']) : ''; ?></textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="name" class="form-label">Network member Card plan for free<span class="text-danger">*</span></label>
                            <textarea name="network_free_card_plan" id="network_free_card_plan" class="form-control" required><?php echo isset($silverSection1['network_free_card_plan']) ? htmlspecialchars($silverSection1['network_free_card_plan']) : ''; ?></textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="name" class="form-label">card bg image<span class="text-danger">*</span></label>
                            <input type="file" name="image" id="image" class="form-control" >
                            <?php if(isset($silverSection1['image'])){ ?>
                                <img class="mt-2" src="<?=base_url('assets/images/plantinumBanner/') ?><?= $silverSection1['image'] ?>" alt="" width="160" height="60px">
                           <?php } ?>
                        </div>
                       

                      <script>
                            CKEDITOR.replace('description');
                            CKEDITOR.replace('card_plan');
                            CKEDITOR.replace('branch_card_plan');
                            CKEDITOR.replace('free_card_plan');
                            CKEDITOR.replace('customer_card_plan');
                            CKEDITOR.replace('network_card_plan');
                            CKEDITOR.replace('network_free_card_plan');
                            CKEDITOR.replace('branch_free_card_plan');
                            CKEDITOR.replace('customer_free_card_plan');

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
