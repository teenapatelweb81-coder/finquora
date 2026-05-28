
<div class="container-fluid p-0">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin-dashboard");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Edit Role</li> 
           </ol>
         </nav>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 px-0 form-main">
            <div class="card form-card">
                <div id="success_message"></div>
                <span class="text-center text-info mb-2" id="susid"></span>
                <span class="text-center text-white bg-danger mb-2" id="errid"></span>
                <?php echo form_open_multipart('admin/roles-update');?>
                
                <div class="row">
                    <input type="hidden" name="id" id="uid" class="form-control" value="<?php echo $datas->id; ?>">
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="permission_name" class="form-label">Permission Name<span class="text-danger">*</span></label>
                        <input type="text" name="permission_name" id="permission_name" class="form-control" value="<?php echo $datas->permission;?>" required>
                    </div>
                    <div class="col-md-6">
                        <label for="parent_id" class="form-label">Parent Role (Optional)</label>
                        <select name="parent_id" id="parent_id" class="form-control">
                            <option value="">-- No Parent --</option>
                            <?php foreach ($roles as $role) { ?>
                                <option value="<?= $role['id'] ?>" <?php echo ($datas->parent_id == $role['id']) ? 'selected' : ''; ?>>
                                    <?= $role['permission'] ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-5"></div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <button type="submit" id="create" value="update" class="btn btn-info mt-4">Update</button>
                        </div>
                    </div>
                </div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>