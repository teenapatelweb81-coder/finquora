
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
                    <?php echo form_open_multipart('admin/plantinum-section-4-create');?>
                    
                    
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
                        <div class="col-md-12">
                            <label for="description" class="form-label">Description<span class="text-danger">*</span></label>
                            <textarea name="description" id="description" class="form-control" required></textarea>
                            <?php //echo form_error('description','<span class="text-danger mt-1">','</span>'); ?>
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
                        </script> 
                     <div class="col-md-12">
                            <label for="disclaimer" class="form-label">Disclaimer<span class="text-danger">*</span></label>
                            <textarea name="disclaimer" id="disclaimer" class="form-control" required><?php echo $datas['disclaimer']; ?></textarea>
                            <?php //echo form_error('description','<span class="text-danger mt-1">','</span>'); ?>
                        </div>

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
