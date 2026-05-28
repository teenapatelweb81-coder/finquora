
<div class="container-fluid p-0">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
               <li class="breadcrumb-item"><a href="<?php echo base_url('admin-dashboard'); ?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Edit Menu</li>
           </ol>
         </nav>
</div>
<div class="container-fluid">
   <div class="row">
      <div class="col-md-12 px-0 form-main">
         <div class="card form-card">
            <div id="success_message"></div>
            <span class="text-center text-info mb-2" id="susid"><?php echo $this->session->flashdata('success'); ?></span>
            <span class="text-center text-white bg-danger mb-2" id="errid"><?php echo $this->session->flashdata('error'); ?></span>
            <?php echo form_open_multipart('admin/update_menu/' . $datas->id); ?>
            
            <div class="row">
                <div class="col-md-6 mt-2">
                    <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" id="title" class="form-control" value="<?php echo set_value('title', $datas->title); ?>" required placeholder="Add Title">
                    <?php echo form_error('title', '<span class="text-danger mt-1">', '</span>'); ?>
                </div>
                <div class="col-md-6 mt-2">
                    <label for="redirect" class="form-label">Redirect </label>
                    <input type="text" name="url" id="redirect" class="form-control" value="<?php echo set_value('url', $datas->url); ?>" placeholder="Enter redirection url">
                    <?php echo form_error('url', '<span class="text-danger mt-1">', '</span>'); ?>
                </div>
                <div class="col-md-6 mt-2">
                    <label for="parent_id" class="form-label">Parent Menu</label>
                    <select name="parent_id" class="form-control">
                        <option value="0" <?php echo ($datas->parent_id == 0) ? 'selected' : ''; ?>>None (Top Level)</option>
                        <?php foreach ($all_menus as $m): ?>
                            <option value="<?php echo $m->id; ?>" <?php echo ($datas->parent_id == $m->id) ? 'selected' : ''; ?>>
                                <?php echo $m->title; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                  <?php
                     if ($this->session->userdata('type') == 'admin') { ?>
                           <div class="col-6 mb-3">
                                 <label for="domain_id_main" class="col-form-label">Domain</label>
                                 <select class="form-control" id="domain_id_main" required name="domain_id">
                                    <?php foreach ($domains as $domain): ?>
                                       <option value="<?php echo $domain->id; ?>" <?php echo ($datas->domain_id == $domain->id) ? 'selected' : ''; ?>>
                                          <?php echo $domain->url; ?>
                                       </option>
                                    <?php endforeach; ?>
                                 </select>
                           </div>
                     <?php }else{?>
                        <input type="hidden" name="domain_id"  class="form-control" value="<?= domain_id_get() ?>" >
                     <?php }?>           

                <div class="col-md-6 mt-2">
                    <label for="is_public" class="form-label">Visibility</label><br>
                    <label><input type="checkbox" name="is_public" <?php echo ($datas->is_public) ? 'checked' : ''; ?>> Public</label>
                </div>
            </div>
            <div class="border-bottom border border-secondary mb-5 mt-5"></div>
            <div class="form-group row">
                <label for="status" class="col-sm-2 col-form-label">Status <span class="text-danger">*</span></label>
                <div class="col-sm-10">
                    <select class="form-control" name="status" id="status" required>
                        <option value="">---- Choose a Status ----</option>
                        <option value="1" <?php echo ($datas->status == 1) ? 'selected' : ''; ?>>Active</option>
                        <option value="0" <?php echo ($datas->status == 0) ? 'selected' : ''; ?>>Inactive</option>
                    </select>
                    <span id="statusErr"></span>
                    <?php echo form_error('status', '<span class="text-danger mt-1">', '</span>'); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 col-form-label"></label>
                <input type="submit" name="submit" id="submit" value="Update" class="btn btn-info mt-4">
                <a href="<?php echo base_url('admin/edge'); ?>" class="btn btn-secondary mt-4">Show</a>
            </div>
            <?php echo form_close(); ?>
         </div>
      </div>
   </div>
</div>