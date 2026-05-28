<div class="container-fluid p-0">
             <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin/Dashboard/");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Permission list</li>
           </ol>
         </nav>
</div>
<div class="container-fluid px-0">
	<div class="row m-0 bg-white">
        
        <div class="col-md-12 px-0">
            <div class="card form-card">
                    <h4>Permission Lists</h4>
                
        <div class="">
            <span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>
            <span class="text-center text-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error');?></span>		
        </div>
        <form action="<?php echo base_url('admin/rolepermission/update_permission'); ?>" method="POST">
            <div class="row align-items-end mb-4">
                <div class="col-4">
                    <label for="domain_id" class="col-form-label">Domain</label>
                    <select class="form-control" name="domain_id" id="domain_id" required>
                        <!-- <option value="">---- Choose a Domain ----</option> -->
                        <?php foreach ($domains as $domain) { ?>
                            <option <?= (domain_id_get() == $domain['id']) ? 'selected' : ''; ?>  value="<?= $domain['id'] ?>"> <?= $domain['url'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
			<?php
                function render_roles($roles, $level = 0) {
                    foreach ($roles as $role) {
                        ?>
                        <div class="form-group mb-1 d-flex align-items-center" style="margin-left:<?= $level * 20 ?>px; gap:5px;">
                            <input type="checkbox" name="permissions[]" value="<?= $role['id'] ?>" id="role<?= $role['id'] ?>">
                            <label for="role<?= $role['id'] ?>" class="mb-0"><?= str_repeat(' ', $level) . $role['permission'] ?></label>
                        </div>
                        <?php
                        if (!empty($role['children'])) {
                            render_roles($role['children'], $level + 1);
                        }
                    }
                }
            ?>


                    <div id="permission-list">
                        <?php if (!empty($roles)) {
                            render_roles($roles);
                        } ?>
                    </div>


            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="form-group mb-1 d-flex align-items-center" style="gap:5px;">
                        <button type="submit" class="btn btn-info  d-inline">Provide Permission</button>
						<a href="<?php echo base_url('admin/permission'); ?>" class="btn btn-secondary">Reset</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
	</div>
</div>

<script>
$(document).ready(function () {
    function loadPermissions(domain_id) {
        $.ajax({
            url: "<?php echo base_url('admin/rolepermission/get_permissions'); ?>",
            type: "POST",
            data: { domain_id: domain_id },
            dataType: "json", // Ensure we return JSON instead of HTML
            success: function (response) {
                $("input[name='permissions[]']").each(function () {
                    if (response.includes($(this).val())) {
                        $(this).prop("checked", true);
                    } else {
                        $(this).prop("checked", false);
                    }
                });
            }
        });
    }

    // Load permissions on page load
    var selectedDomain = $("#domain_id").val();
    if (selectedDomain) {
        loadPermissions(selectedDomain);
    }

    // Update permissions when domain changes
    $("#domain_id").change(function () {
        var domain_id = $(this).val();
        loadPermissions(domain_id);
    });
});

</script>
