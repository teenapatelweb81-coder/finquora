<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<style>
    button.btn-close.position-absolute.top-0.end-0.remove-image-btn.btn-danger {
    top: 0;
    right: 0;
    border: 0;
    padding: 5px 9px;
    border-radius: 50%;
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
                    <?php echo form_open_multipart('admin/branchAgentDetail-update');?>
                    <span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success'); ?></span>
                <span class="text-center text-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error'); ?></span>
                    
                    <div class="row">
                        <input type="hidden" name="id" id="uid" class="form-control" value="<?= (isset($branchAgentDetail['id'])) ? $branchAgentDetail['id'] : '' ; ?> " >
                    
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
                            <label for="first_name" class="form-label">Left heading<span class="text-danger">*</span></label>
                            <input type="text" name="leftheading" id="heading" class="form-control" value="<?= (isset($branchAgentDetail['leftheading'])) ? $branchAgentDetail['leftheading'] : '' ; ?>" required>
                            <?php //echo form_error('first_name','<span class="text-danger mt-1">','</span>') ;?>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="description" class="form-label">Right heading<span class="text-danger">*</span></label>
                            <input  type="text"  name="rightheading" id="rightheading" class="form-control" required value="<?= (isset($branchAgentDetail['rightheading'])) ? $branchAgentDetail['rightheading'] : '' ; ?> " >
                            <?php //echo form_error('description','<span class="text-danger mt-1">','</span>'); ?>
                        </div>

                        <div class="col-md-12">
                            <label for="description" class="form-label">Top description<span class="text-danger">*</span></label>
                            <textarea name="description" id="description" class="form-control" required><?= (isset($branchAgentDetail['description'])) ? $branchAgentDetail['description'] : '' ; ?> </textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="description" class="form-label">Left description<span class="text-danger">*</span></label>
                            <textarea name="leftdescription" id="leftdescription" class="form-control" required><?= (isset($branchAgentDetail['leftdescription'])) ? $branchAgentDetail['leftdescription'] : '' ; ?> </textarea>
                        </div>

                        <div class="col-md-6">
                            <label for="description" class="form-label">Right description<span class="text-danger">*</span></label>
                            <textarea name="rightdescription" id="rightdescription" class="form-control" required><?= (isset($branchAgentDetail['rightdescription'])) ? $branchAgentDetail['rightdescription'] : '' ; ?> </textarea>
                            <?php //echo form_error('description','<span class="text-danger mt-1">','</span>'); ?>
                        </div>

                        <script>
                            CKEDITOR.replace('description');
                            CKEDITOR.replace('leftdescription');
                            CKEDITOR.replace('rightdescription');

                            document.querySelector('form').addEventListener('submit', function(e) {
                                const description = CKEDITOR.instances.description.getData().trim();
                                if (!description) {
                                    alert('Description is required!');
                                    e.preventDefault();
                                }
                            });
                        </script>

                        
                        <div class="col-md-6">
                            <label for="name" class="form-label">NBFC image</label>
                            <input type="file" name="image[]" id="image" class="form-control"  multiple>
                            
                        </div>
                       <div class="col-md-12">
                            <?php if (isset($branchAgentDetail['image']) && !empty($branchAgentDetail['image'])): ?>
                                <?php 
                                    $images = json_decode($branchAgentDetail['image'], true); 
                                    if (is_array($images)):
                                        foreach ($images as $index => $img): 
                                ?>
                                    <div class="d-inline-block position-relative me-2 mb-2">
                                        <img class="img-thumbnail" src="<?= base_url($img) ?>" alt="" width="160" height="60">
                                        <button type="button" class="btn-close position-absolute top-0 end-0 remove-image-btn  btn-danger" 
                                            data-img="<?= $img ?>" aria-label="Close" style="font-size:12px;"><i class="fa fa-trash"></i></button>
                                    </div>
                                <?php 
                                        endforeach; 
                                    endif;
                                ?>
                            <?php endif; ?>
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

<script>
$(document).ready(function() {
    
    var csrfHash = '<?= $this->security->get_csrf_hash(); ?>';
    var csrfName = '<?= $this->security->get_csrf_token_name(); ?>';

    $('.remove-image-btn').on('click', function() {
        var imgPath = $(this).data('img'); 
        var parentDiv = $(this).closest('div');

        if(confirm('Are you sure you want to delete this image?')) {
            $.ajax({
                url: '<?= base_url("admin/deleteBranchAgentImage") ?>',
                type: 'POST',
                data: { 
                    domain_id: <?= (isset($branchAgentDetail['domain_id'])) ? $branchAgentDetail['domain_id'] : '' ; ?>,
                    id: <?= (isset($branchAgentDetail['id'])) ? $branchAgentDetail['id'] : '' ; ?>,
                    image_path: imgPath,
                    [csrfName]: csrfHash  // add CSRF token
                },
                success: function(response) {
                    var res = JSON.parse(response);
                    if(res.status == 'success') {
                        parentDiv.remove(); // remove from view
                    } else {
                        alert('Failed to delete image.');
                    }
                },
                error: function() {
                    alert('Error in request.');
                }
            });
        }
    });
});
</script>