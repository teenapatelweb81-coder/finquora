<style>
.container {
    margin-top: 20px;
    margin-bottom: 15px;
}
</style>
<div class="container-fluid p-0">
    <nav aria-label="breadcrumb">
    <ol class="breadcrumb ">
        <li class="breadcrumb-item active" aria-current="page">Change password </li>
    </ol>
    </nav>
</div>
<div class="container-fluid">
    <div class="table-responsive shadow-lg p-2 rounded">
        <h3 class="mb-3">Change Password</h3>
        <form  method="post" action="<?php echo base_url("admin/save-change-password");?>">
            <div id="message" class="text-primary text-center">
                <span class="text-center text-primary mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>
                <span class="text-center text-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error');?></span>
            </div>
            <div class="row m-0 align-items-end">
                <div class="col-md-4">
                    <div class="">
                        <label for="usr">New Password:</label>
                        <input type="password" class="form-control" name="password" value="">
                    </div>
                    <input type="hidden" name="uid" value="<?php echo $uid; ?>">
                    <input type="hidden" name="role" value="<?php echo $role; ?>">
                </div>
                <div class="col-md-1">
                    <div class="">
                        <input type="submit" name="update" class="btn btn-primary w-100" value="Submit">
                    </div>
                </div>
                <div class="col-md-1" >
                    <div>
                        <?php if ($skip == 0): ?> 
                        <button type="button" class="btn btn-secondary px-4 w-100" onclick="skipChangePassword()">Skip</button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Advertise Modal -->
<div class="modal fade" id="advertiseModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border: none; border-radius: 15px; overflow: hidden; box-shadow: 0 5px 30px rgba(0,0,0,0.2);">
            <!-- Modal Header with Close Button -->
            <div class="modal-header" style="border: none; padding: 15px 20px; background: linear-gradient(135deg, #4e73df 0%, #224abe 100%); color: white;">
                <h5 class="modal-title" style="font-weight: 600; font-size: 1.5rem;">Special Offer! 🎉</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white; opacity: 1; text-shadow: none;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <!-- Modal Body with Ad Content -->
            <div class="modal-body" style="padding: 25px;">
                <div class="text-center mb-4">
                    <i class="fas fa-gift fa-4x mb-3" style="color: #4e73df;"></i>
                    <h4 style="color: #2c3e50; font-weight: 600;">Exclusive Deal Just For You!</h4>
                </div>
                
                <div class="text-center mb-4">
                    <?= $notification['content']?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
 $teams_parent = $this->db->get_where('user_master', ['id' => $this->session->userdata('user_id'),'role' => $this->session->userdata('role')])->row_array();
  if (empty($teams_parent)) {
  $teams_parent = $this->db->get_where('branch_franchise', ['id' => $this->session->userdata('user_id'),'role' => $this->session->userdata('role')])->row_array();
  }
?>
<script>
$(document).ready(function() {
    <?php if ($teams_parent['skip'] == 0 || $teams_parent['change_password_status'] == 1) { ?>
    $('#advertiseModal').modal('show');
    <?php } ?>
});
</script>
<script>
function skipChangePassword() {
    var uid = "<?php echo $uid; ?>";
    var role = "<?php echo $role; ?>";
    
    fetch("<?php echo base_url('admin/skip-change-password'); ?>", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
        },
        body: "uid=" + uid + "&role=" + role
    }).then(response => response.json())
      .then(data => {
          if (data.success) {
              window.location.href = "<?php echo base_url('admin-dashboard'); ?>";
          } else {
              alert("Failed to update skip status.");
          }
      }).catch(error => console.error("Error:", error));
}
</script>