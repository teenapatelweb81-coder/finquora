
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
                    <?php echo form_open_multipart('admin/roles-create');?>
                    
                    
                    <div class="row">
                        <!-- <input type="hidden" name="id" id="uid" class="form-control" value="" > <?php //echo $this->session->userdata('user_id');?> -->
                    
                    </div>

                    
                    <div class="row">
                        <div class="col-md-6">
                            <label for="permission_name" class="form-label">Permission Name<span class="text-danger">*</span></label>
                            <input type="text" name="permission_name" id="permission_name" class="form-control" required>
                            <?php //echo form_error('first_name','<span class="text-danger mt-1">','</span>') ;?>
                        </div>
                        <div class="col-md-6">
                            <label for="parent_id" class="form-label">Parent Role (Optional)</label>
                            <select name="parent_id" id="parent_id" class="form-control">
                                <option value="">-- No Parent --</option>
                                <?php 
                                $roles = $this->db->get('roles')->result_array();
                                foreach ($roles as $role) { ?>
                                    <option value="<?= $role['id'] ?>"><?= $role['permission'] ?></option>
                                <?php } ?>
                            </select>
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
