
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
                    <?php echo form_open_multipart('admin/silver-section-3-update');?>
                    
                    
                    <div class="row">
                        <input type="hidden" name="id" id="uid" class="form-control" value="<?php echo $datas->id; ?>" >
                    
                    </div>

                    
                    <div class="row">
                        <?php
                            if ($this->session->userdata('type') == 'admin') { ?>
                                    <div class="col-6 mb-3">
                                        <label for="domain_id_main" class="col-form-label">Domain</label>
                                        <select class="form-control" id="domain_id_main" required name="domain_id">
                                            <?php foreach ($domains as $domain) { ?>
                                                <option <?= ($datas->domain_id == $domain['id']) ? 'selected' : ''; ?> value="<?= $domain['id'] ?>"> <?= $domain['url'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                            <?php }else{?>
                                <input type="hidden" name="domain_id"  class="form-control" value="<?= domain_id_get() ?>" >
                            <?php }?>
                            
                        <div class="col-md-6">
                            <label for="first_name" class="form-label">Heading<span class="text-danger">*</span></label>
                            <input type="text" name="heading" id="heading" class="form-control" value="<?php echo $datas->heading;?>" required>
                            <?php //echo form_error('first_name','<span class="text-danger mt-1">','</span>') ;?>
                        </div>
                        <div class="col-md-6">
                            <label for="first_name" class="form-label">Heding Text<span class="text-danger">*</span></label>
                            <input type="text" name="heading_text" id="heading_text" class="form-control" value="<?php echo $datas->heading_text;?>" required>
                            <?php //echo form_error('first_name','<span class="text-danger mt-1">','</span>') ;?>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="first_name" class="form-label">Title<span class="text-danger">*</span></label>
                            <input type="text" name="title" id="title" class="form-control" value="<?php echo $datas->title;?>" required>
                            <?php //echo form_error('first_name','<span class="text-danger mt-1">','</span>') ;?>
                        </div>
                        <div class="col-md-6">
                            <label for="first_name" class="form-label">Description<span class="text-danger">*</span></label>
                            <textarea name="description" id="description" class="form-control" required><?php echo $datas->description;?></textarea>
                            <?php //echo form_error('first_name','<span class="text-danger mt-1">','</span>') ;?>
                        </div>
                        <div class="col-md-6">
                            <label for="first_name" class="form-label">Icon<span class="text-danger">*</span></label>
                            <input type="text" name="icon" id="icon" class="form-control" value="<?php echo $datas->icon;?>" required>
                            <?php //echo form_error('first_name','<span class="text-danger mt-1">','</span>') ;?>
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
