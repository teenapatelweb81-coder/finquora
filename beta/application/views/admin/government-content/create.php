
<div class="container-fluid p-0">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin-dashboard");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Government Content Add</li> 
           </ol>
         </nav>
</div>
<div class="container-fluid">
    <span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success'); ?></span>
    <span class="text-center text-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error'); ?></span>
				
        <div class="row">
            <div class="col-md-12 px-0 form-main">
                <div class="card  form-card">
                    <div id="success_message"></div>
                    <span class="text-center text-info mb-2" id="susid"></span>  <?php //echo $this->session->flashdata('success');?>
                    <span class="text-center text-white bg-danger mb-2" id="errid"> </span> <?php // echo $this->session->flashdata('error');?>
                    <?php echo form_open_multipart('admin/government-content-create');?>        
                    <div class="row">
                        <?php
                        if ($this->session->userdata('type') == 'admin') { ?>
                                <div class="col-6 mb-3">
                                    <label for="domain_id_main" class="col-form-label">Domain</label>
                                    <select class="form-control" id="domain_id_main" required name="domain_id">
                                        <?php foreach ($domains as $domain) { ?>
                                            <option <?= (domain_id_get() == $domain['id']) ? 'selected' : ''; ?> value="<?= $domain['id'] ?>"> <?= $domain['url'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                        <?php }else{?>
                            <input type="hidden" name="domain_id"  class="form-control" value="<?= domain_id_get() ?>" >
                        <?php }?>
                        <div class="col-md-4 mb-2">
                            <label for="first_name" class="form-label">Pages<span class="text-danger">*</span></label>
                            <select class="form-control" id="pags" name="menu_id" required>
                                <option value="" disabled selected>Select </option>
                                <?php foreach ($menus as $menu): ?>
                                    <option value="<?= $menu['id'] ?>"><?= $menu['url'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="first_name" class="form-label">Content<span class="text-danger">*</span></label>
                            <textarea name="description" id="description" class="form-control" required></textarea>
                             <script>
                         CKEDITOR.replace('description');
                        </script>
                        </div> 
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center"> 
                            <div class="form-group">
                            <button type="submit"  id="create" value="create" class="btn btn-info mt-4">Create </button>
                            </div>
                        </div>
                    </div>
                    <?php echo form_close();?>
                </div>
            </div>
        </div>
    <!-- </form> -->
</div>


