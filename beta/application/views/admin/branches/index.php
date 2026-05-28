<div class="container-fluid p-0">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin-dashboard");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page"><?= $title ?></li> 
           </ol>
         </nav>
</div>
<div class="card shadow mb-4">
    <div class="card-body p-0">
        <?php if($this->session->flashdata('success')): ?>
            <div class="alert alert-success">
                <?= $this->session->flashdata('success') ?>
            </div>
        <?php endif; ?>
        <?php echo form_open_multipart('admin/Slider/heading_update');?>
            <div class="row align-items-end mx-0 mb-1">
                <div class="col-md-3 mt-2">
                    <label for="Image Alt Description" class="form-label">Title <span class="text-danger">*</span></label>
                      <input type="text" name="title" id="title" class="form-control" value="<?= (isset($heading->title)) ? $heading->title : '' ; ?>" required placeholder="Add Title">
                      <input type="hidden" name="type" value="branch-location">
					  <input type="hidden" name="id" value="<?= (isset($heading->id)) ? $heading->id : '' ; ?>">
                    <?php echo form_error('title','<span class="text-danger mt-1">','</span>') ;?>
               </div>
               <div class=" col-md-3  mt-2">
                    <label for="Image Alt Description" class=" form-label">Description</label>
                    <input type="text" name="description" id="description" class="form-control" placeholder="Add Description"value="<?= (isset($heading->description)) ? $heading->description : '' ; ?>" >
                </div>
               
				 <?php
					$selected_domain_id = isset($_GET['domain_id']) ? (int)$_GET['domain_id'] : null;
					
					if ($selected_domain_id) {
						$website_id = $selected_domain_id;
					} else {
						$website_id = domain_id_get();
					}

					if ($this->session->userdata('type') == 'admin') { ?>
						<div class="col-md-3 mt-2">
							<label for="domain_id_main" class="form-label">Domain</label>
							<select class="form-control" id="domain_id_main" required name="domain_id" onchange="window.location.href = window.location.pathname + '?domain_id=' + this.value;">
								<?php foreach ($domains as $domain) { ?>
									<option <?= ($website_id == $domain['id']) ? 'selected' : ''; ?> value="<?= $domain['id'] ?>"> <?= $domain['url'] ?></option>
								<?php } ?>
							</select>
						</div>
				<?php }else{?>
					<input type="hidden" name="domain_id"  class="form-control" value="<?= $website_id ?>" >
				<?php }?>
                 <div class="col-md-2 mt-2">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-control" id="status" required name="status">
                        <option value="1" <?= (isset($heading->status) && $heading->status == 1) ? 'selected' : ''; ?>>Active</option>
                        <option value="0" <?= (isset($heading->status) && $heading->status == 0) ? 'selected' : ''; ?>>Inactive</option>
                    </select>
                </div>
				<div class=" col-md-1  mt-3">
					 <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-info mt-4">
				</div>
			</div>
		<?php echo form_close();?>
        <div class="container-fluid text-right mb-1">
            <a href="<?= base_url('admin/branches/add') ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50"></i> Add New Branch
            </a>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="bg-primary">
                    <tr>
                        <th>#</th>
                        <th>Branch Name</th>
                        <th>Contact Person</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>City</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; foreach($branches as $branch):
                    ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td><?= html_escape($branch['branch_name']) ?></td>
                        <td><?= html_escape($branch['contact_person']) ?></td>
                        <td><?= html_escape($branch['email']) ?></td>
                        <td><?= html_escape($branch['mobile']) ?></td>
                        <td><?= html_escape($branch['city']) ?>, <?= html_escape($branch['state']) ?></td>
                        <td>
                            <?php if($branch['status'] == 1): ?>
                                <span class="badge badge-success">Active</span>
                            <?php else: ?>
                                <span class="badge badge-danger">Inactive</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="<?= base_url('admin/branches/edit/'.$branch['id']) ?>" class="btn btn-sm btn-primary">
                                <i class="fas fa-edit"></i>
                            </a>
                            <?php if($branch['status'] == 1): ?>
                                <a href="<?= base_url('admin/branches/status/'.$branch['id'].'/0') ?>" class="btn btn-sm btn-warning" onclick="return confirm('Are you sure you want to deactivate this branch?')">
                                    <i class="fas fa-ban"></i>
                                </a>
                            <?php else: ?>
                                <a href="<?= base_url('admin/branches/status/'.$branch['id'].'/1') ?>" class="btn btn-sm btn-success" onclick="return confirm('Are you sure you want to activate this branch?')">
                                    <i class="fas fa-check"></i>
                                </a>
                            <?php endif; ?>
                            <a href="<?= base_url('admin/branches/delete/'.$branch['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this branch?')">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
