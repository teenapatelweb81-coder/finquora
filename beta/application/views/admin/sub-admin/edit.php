<div class="container-fluid p-0">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin-dashboard");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Edit Sub Admin</li> 
            </ol>
         </nav>
</div>
<div class="container-fluid px-0">
    <!-- <form action="<?php //base_url('admin/banker-create')?>" method="post"> -->
        <div class="row m-0">
            <div class="col-md-12 p-0 form-main">
                <div class="card  form-card">
                    <div id="success_message"></div>
                    <span class="text-center text-info mb-2" id="susid"></span>  <?php //echo $this->session->flashdata('success');?>
                    <span class="text-center text-white bg-danger mb-2" id="errid"> </span> <?php // echo $this->session->flashdata('error');?>
                    <?php echo form_open_multipart('admin/sub-admin-update');?>
                    
                    
                    <div class="row">
                        <input type="hidden" name="id" id="uid" class="form-control" value="<?php echo $datas->id; ?>" >
                    
                    </div>

                    
                    <div class="row m-0">
                        <div class="col-md-6">
                            <label for="first_name" class="form-label">Name<span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control" value="<?php echo $datas->name;?>" required>
                            <?php //echo form_error('first_name','<span class="text-danger mt-1">','</span>') ;?>
                        </div>
                        <div class="col-md-6">
                            <label for="first_name" class="form-label">Email<span class="text-danger">*</span></label>
                            <input type="text" name="email" id="name" class="form-control" value="<?php echo $datas->email;?>" required>
                            <?php //echo form_error('first_name','<span class="text-danger mt-1">','</span>') ;?>
                        </div>
                        <div class="col-md-6">
                            <label for="first_name" class="form-label">Mobile No<span class="text-danger">*</span></label>
                            <input type="text" name="mobile_no" id="name" class="form-control" value="<?php echo $datas->mobile_no;?>" required>
                            <?php //echo form_error('first_name','<span class="text-danger mt-1">','</span>') ;?>
                        </div>
                        <div class="col-md-6">
                            <label for="first_name" class="form-label">Pass<span class="text-danger">*</span></label>
                            <input type="text" name="password" id="name" class="form-control" value="<?php echo $datas->pass_text;?>" required>
                            <?php //echo form_error('first_name','<span class="text-danger mt-1">','</span>') ;?>
                        </div>
                        
                        
                        <div class="col-md-6">
                            <label for="first_name" class="form-label">Status<span class="text-danger">*</span></label>
                            <select class="form-control" name="status">
                                <option value='1' <?php if($datas->status == 1){ echo 'selected';};?>>Active</option>
                                <option value='0' <?php if($datas->status == 0){ echo 'selected';};?>>In-Active</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="first_name" class="form-label">Domain<span class="text-danger">*</span></label>
                            <select class="form-control" name="domain_id" id="domain_id" required>
                                <option value=''>Select Domain</option>
                                <?php foreach ($domains as $domain) { ?>
                                    <option value="<?= $domain['id'] ?>" 
                                        <?= ($domain['id'] == $datas->domain_id) ? 'selected' : '' ?>>
                                        <?= $domain['url'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>


                    </div>
                    
                
                    
                    <div class="row m-0">
                        
                        <div class="col-md-5">
                            
                        </div>
                        <div class="col-md-2"> 
                            <div class="form-group">
                            <button type="submit"  id="create" value="create" class="btn btn-info mt-4">update </button>
                            </div>
                            
                        </div>
                        
                    </div>
                    <?php echo form_close();?>
                </div>
            </div>
        </div>
</div>
