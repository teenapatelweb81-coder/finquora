
<div class="container-fluid p-0">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin-dashboard");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Media Coverage</li> 
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
                    <?php echo form_open_multipart('admin/media-coverage-update');?>
                    
                    
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
                            <input type="text" name="text" id="text" class="form-control" value="<?php echo $datas->text;?>" required>
                            <?php //echo form_error('first_name','<span class="text-danger mt-1">','</span>') ;?>
                        </div>
                       
                        <div class="col-md-6">
                            <label for="first_name" class="form-label">image<span class="text-danger">*</span></label>
                            <input type="file" name="image" id="image" class="form-control">
                            <input type="hidden" name="image_id" id="image_id" class="form-control" value="<?= $datas->image?>">
                            <img src="<?= base_url('assets/images/media_coverage/'.$datas->image) ?>" alt="Image" width="100">
                            
                        </div>
 
                        <!-- <div class="col-md-6">
                            <label for="Process" class="form-label">Bank Name<span class="text-danger">*</span></label>
                            
                            <select id="bank_id" class="form-control" name="bank_id" <?php echo $datas->bank_id;?> required>
                                <option _ngcontent-mir-c194="" disabled selected value="0">Bank Name</option>
                                <?php foreach($bank_data as $type) { ?>
                                    <option _ngcontent-mir-c194="" <?= ($datas->bank_id == $type->id)?'selected':'' ?> value="<?=$type->id;?>"><?=$type->bank_name;?></option>
                                
                                <?php } ?>
                            </select>
                            <?php //echo form_error('process_id','<span class="text-danger mt-1">','</span>') ;?>
                        
                        </div> -->
                        <!-- <div class="col-md-6">
                            <label for="first_name" class="form-label">Product<span class="text-danger">*</span></label>
                            <input type="text" name="product" id="product" class="form-control"  value="<?php echo $datas->product;?>" required>
                            <?php //echo form_error('first_name','<span class="text-danger mt-1">','</span>') ;?>
                        </div> 
                
                        <div class="col-md-6">
                            <label for="pan" class="form-label">Email Id<span class="text-danger">*</span></label>
                            <input type="email" name="email" id="email" class="form-control" value="<?php echo $datas->email;?>" required>
                            <?php //echo form_error('pan','<span class="text-danger mt-1">','</span>') ;?>
                        </div>
                        <div class="col-md-6">
                            <label for="mobile" class="form-label">Mobile<span class="text-danger">*</span></label>
                            <input type="number" name="mobile" id="mobile" class="form-control" value="<?php echo $datas->mobile;?>" maxlength="10" required>
                            <?php //echo form_error('mobile','<span class="text-danger mt-1">','</span>') ;?>
                        </div> -->
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
