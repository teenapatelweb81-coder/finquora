<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>




<div class="container-fluid p-0">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin-dashboard");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Edit Document Section</li> 
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
                    <?php echo form_open_multipart('admin/document-section-update');?>
                    <span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success'); ?></span>
                <span class="text-center text-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error'); ?></span>
                    
                    <div class="row">
                        <input type="hidden" name="id" id="uid" class="form-control" value="<?php echo isset($documentSection['id']) ? $documentSection['id'] : ''; ?>">
                    
                    </div>

                        <div class="col-md-6">
                            <label for="image" class="form-label">Image<span class="text-danger">*</span></label>
                            <input type="file" name="image" id="image" class="form-control" <?php if(empty($documentSection['image'])){ ?> required <?php } ?> >
                            <?php if(!empty($documentSection['image'])){ ?>
                            <img src="<?= base_url('assets/images/documentSection/'.$documentSection['image']) ?>" alt="Image" width="100">
                            <?php } ?>
                            <?php //echo form_error('description','<span class="text-danger mt-1">','</span>'); ?>
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
