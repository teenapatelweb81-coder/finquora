
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
                    <?php echo form_open_multipart('admin/plantinum-section-3-create');?>
                    
                    
                    <div class="row">
                        <!-- <input type="hidden" name="id" id="uid" class="form-control" value="" > <?php //echo $this->session->userdata('user_id');?> -->
                    
                    </div>

                    
                    <div class="row">
                        <div class="col-md-6">
                            <label for="first_name" class="form-label">Heading<span class="text-danger">*</span></label>
                            <input type="text" name="heading" id="heading" class="form-control" required value="<?php if(!empty($datas) && $datas['heading']){ echo $datas['heading'];} ?>">
                            <?php //echo form_error('first_name','<span class="text-danger mt-1">','</span>') ;?>
                        </div>
                        <div class="col-md-6">
                            <label for="first_name" class="form-label">Heding Text<span class="text-danger">*</span></label>
                            <input type="text" name="heading_text" id="heading_text" class="form-control" value="<?php if(!empty($datas) && $datas['heading_text']){ echo $datas['heading_text'];} ?>" required>
                            <?php //echo form_error('first_name','<span class="text-danger mt-1">','</span>') ;?>
                        </div>
                       
                        <div class="col-md-6">
                            <label for="first_name" class="form-label">Title<span class="text-danger">*</span></label>
                            <input type="text" name="title" id="title" class="form-control" required>
                            <?php //echo form_error('first_name','<span class="text-danger mt-1">','</span>') ;?>
                        </div>
                        <div class="col-md-6">
                            <label for="first_name" class="form-label">Description<span class="text-danger">*</span></label>
                            <textarea name="description" id="description" class="form-control" required></textarea>
                            
                        </div> 
                        <div class="col-md-6">
                            <label for="first_name" class="form-label">Icon<span class="text-danger">*</span></label>
                            <input type="text" name="icon" id="icon" class="form-control" required>
                            <?php //echo form_error('first_name','<span class="text-danger mt-1">','</span>') ;?>
                        </div>
                        <!-- <div class="col-md-6">
                            <label for="Process" class="form-label">Bank Name<span class="text-danger">*</span></label>
                            
                            <select id="bank_id" class="form-control" name="bank_id" required>
                                <option _ngcontent-mir-c194="" disabled selected value="0">Bank Name</option>
                                <?php foreach($bank_data as $type) { ?>
                                    <option _ngcontent-mir-c194="" value="<?=$type->id?>"><?=$type->bank_name?></option>
                                
                                <?php } ?>
                            </select>
                            <?php //echo form_error('process_id','<span class="text-danger mt-1">','</span>') ;?>
                        
                        </div>
                        <div class="col-md-6">
                            <label for="first_name" class="form-label">Product<span class="text-danger">*</span></label>
                            <input type="text" name="product" id="product" class="form-control" required>
                            <?php //echo form_error('first_name','<span class="text-danger mt-1">','</span>') ;?>
                        </div> 
                
                        <div class="col-md-6">
                            <label for="pan" class="form-label">Email Id<span class="text-danger">*</span></label>
                            <input type="email" name="email" id="email" class="form-control" required>
                            <?php //echo form_error('pan','<span class="text-danger mt-1">','</span>') ;?>
                        </div>
                        <div class="col-md-6">
                            <label for="mobile" class="form-label">Mobile<span class="text-danger">*</span></label>
                            <input type="number" name="mobile" id="mobile" class="form-control"  maxlength="10" required>
                            <?php //echo form_error('mobile','<span class="text-danger mt-1">','</span>') ;?>
                        </div> -->
                    </div>
                    
                
                    
                    <div class="row">
                        
                        <div class="col-md-5">
                            
                        </div>
                        <div class="col-md-2"> 
                            <div class="form-group">
                            <button type="submit"  id="create" value="create" class="btn btn-info mt-4">Create </button>
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
