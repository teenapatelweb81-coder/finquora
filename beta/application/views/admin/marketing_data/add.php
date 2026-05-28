
<div class="container-fluid p-0">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin-dashboard");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Marketing data add</li>
           </ol>
         </nav>
</div>
<div class="container-fluid">
   <div class="row">
      <div class="col-md-12 px-0 form-main">
         <div class="card  form-card">
            <div id="success_message"></div>
             <span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>
             <span class="text-center text-white bg-danger mb-2" id="errid"> <?php  echo $this->session->flashdata('error');?></span>
            <?php echo form_open_multipart('admin/marketing-data-store');?>
            
            <div class="row">
               <?php if ($this->session->userdata('type') == 'admin') { ?>
                  <div class="form-group col-md-4">
                     <label for="domain_id_main" class="form-label">Domain</label>
                     <select class="form-control" id="domain_id_main" name="domain_id" required>
                           <option value="">Select Domain</option>
                           <?php foreach ($domains as $domain) { ?>
                              <option value="<?= $domain['id'] ?>"><?= $domain['url'] ?></option>
                           <?php } ?>
                     </select>
                  </div>
               <?php } else { ?>
                  <input type="hidden" id="domain_id_main" name="domain_id" value="<?= domain_id_get() ?>">
               <?php } ?>


               <div class="form-group col-md-4">
                  <label for="user_id" class="form-label">User<span class="text-danger">*</span></label>
                  <select id="user_id" name="user_id" class="form-control" required>
                     <option value="">Select User</option>
                     <?php if (!empty($dsa)) foreach ($dsa as $u) { ?>
                        <option value="<?= $u->id ?>">DSA - <?= $u->name ?></option>
                     <?php } ?>

                     <?php if (!empty($branch)) foreach ($branch as $u) { ?>
                        <option value="<?= $u->id ?>">Branch - <?= $u->name ?></option>
                     <?php } ?>

                     <?php if (!empty($team)) foreach ($team as $u) { ?>
                        <option value="<?= $u->id ?>">Team - <?= $u->name ?></option>
                     <?php } ?>

                     <?php if (!empty($admin)) foreach ($admin as $u) { ?>
                        <option value="<?= $u->id ?>">Subadmin - <?= $u->name ?></option>
                     <?php } ?>
                  </select>
               </div>
               <input type="hidden" name="user_role_id" id="user_role_id">


               <div class="form-group col-md-4">
                  <label for="image" class="form-label">Document upload<span class="text-danger">*</span></label>
                  <input type="file" id="image" name="documents" class="form-control" required>
               </div>

               <div class="form-group col-md-4">
                  <label for="remark" class="form-label">Remark</label>
                  <textarea id="remark" name="remark" class="form-control" rows="3"></textarea>
               </div>

               <div class="col-md-12">
                  <button type="submit" class="btn btn-info mt-4">Create</button>
               </div>
            </div>
            <?php echo form_close();?>
         </div>
      </div>
   </div>
</div>

<script>

   $('#user_id').on('change', function () {
    var role_id = $(this).find(':selected').data('role') || '';
    $('#user_role_id').val(role_id);
});


$('#domain_id_main').on('change', function () {
    var domain_id = $(this).val();

    $.ajax({
        url: '<?= base_url("admin/get-users-by-domain") ?>',
        type: 'POST',
        data: { domain_id: domain_id },
        dataType: 'json',
        success: function (res) {

            $('#user_id').empty().append('<option value="">Select User</option>');

            // DSA group
            if (res.dsa.length > 0) {
                var dsaGroup = $('<optgroup label="DSA" style="background:#bf941d; color:#fff;"></optgroup>');
                $.each(res.dsa, function (i, u) {
                    dsaGroup.append('<option style="background:#fff;" value="' + u.id + '"  data-role="' + u.role + '">' + u.name + '</option>');
                });
                $('#user_id').append(dsaGroup);
            }

            // Branch group
            if (res.branch.length > 0) {
                var branchGroup = $('<optgroup label="Branch" style="background:#bf941d; color:#fff;"></optgroup>');
                $.each(res.branch, function (i, u) {
                    branchGroup.append('<option style="background:#fff;" value="' + u.id + '"  data-role="' + u.role + '">' + u.name + '</option>');
                });
                $('#user_id').append(branchGroup);
            }

            // Team group
            if (res.team.length > 0) {
                var teamGroup = $('<optgroup label="Team" style="background:#bf941d; color:#fff;"></optgroup>');
                $.each(res.team, function (i, u) {
                    teamGroup.append('<option style="background:#fff;" value="' + u.id + '"  data-role="' + u.role + '">' + u.name + '</option>');
                });
                $('#user_id').append(teamGroup);
            }

            // Admin group
            if (res.admin.length > 0) {
                var adminGroup = $('<optgroup label="Admin" style="background:#bf941d; color:#fff;"></optgroup>');
                $.each(res.admin, function (i, u) {
                    adminGroup.append('<option style="background:#fff;" value="' + u.id + '"  data-role="' + u.role + '">' + u.name + '</option>');
                });
                $('#user_id').append(adminGroup);
            }
        }
    });
});


</script>