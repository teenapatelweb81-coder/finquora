<div class="container-fluid p-0">
    <nav aria-label="breadcrumb">
    <ol class="breadcrumb ">
        <li class="breadcrumb-item "><a href="<?php echo base_url("admin/Dashboard/");?>" class="text-decoration-none">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Loan Enquiry</li>
    </ol>
    </nav>
</div>
<div class="container-fluid px-0">
    <?php if ($this->session->userdata('role') == 1) {?>
	<div class="row m-0">
		<div class="col-md-12 px-0">
		<?php echo form_open_multipart('admin/Slider/heading_update');?>
            
            <div class="card p-3 mb-0" style="box-shadow:unset;">
				<div class="cart-b">
            <div class="row align-items-end">
                <div class="col-md-3 mt-2">
                    <label for="Image Alt Description" class="form-label">Title <span class="text-danger">*</span></label>
                      <input type="text" name="title" id="title" class="form-control" value="<?= (isset($heading->title)) ? $heading->title : '' ; ?>" required placeholder="Add Title">
                      <input type="hidden" name="type" value="loan_enquiry">
					  <input type="hidden" name="id" value="<?= (isset($heading->id)) ? $heading->id : '' ; ?>">
                    <?php echo form_error('title','<span class="text-danger mt-1">','</span>') ;?>
               </div>
               <!-- <div class=" col-md-3  mt-2">
                 
                 <label for="color" class=" form-label">Color</label>
                 <input type="color" name="color" id="color" class="form-control" placeholder="Add color"value="<?= (isset($heading->color)) ? $heading->color : '' ; ?>" >
                
                </div> -->
                 <div class="col-md-6">
                    <label for="color" class="form-label"> Color</label>
                    <div class="input-group">
                        <input type="text" name="color" id="color" class="form-control" placeholder="Add button color" value="<?= (isset($heading->color)) ? $heading->color : '' ; ?>">
                        <input type="color" id="color_picker" class="form-control form-control-color" value="<?= (isset($heading->color)) ? $heading->color : '' ; ?>">
                    </div>
                    <?php echo form_error('color','<span class="text-danger mt-1">','</span>'); ?>
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
				<div class=" col-md-3  mt-3">
					   <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-info mt-4">
				</div>
			<?php echo form_close();?>
            </div>
		</div>
	</div>
    <?php  }?>
	<div class="row m-0">
        <div id="message" class="text-primary text-center"></div>
        <div class="table-responsive shadow-lg">
            <?php if ($this->session->userdata('type') == 'seo' || $this->session->userdata('type') == 'admin') {?>
            <div class="px-0">
                 <div id="" class="text-primary text-right mr-3">
                    <a href="<?php echo base_url() ?>admin/enquiry-content" class="btn btn-primary"><i class="fa fa-plus text-light fa-sm" aria-hidden="true"></i> Add Loan Enquiry Content</a>
    
                </div>
            <?php }?>
            <table class="table table-bordered text-center table-hover">
				<span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>
                <span class="text-center text-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error');?></span>				
				<thead>
					<tr>
						<th class=''>Sl No.</th>
						<th class=''>Name</th>                                            
						<th class=''>Phone</th>                                            
						<th class=''>Email</th>                                            
						<th class=''>Age</th>                                            
						<th class=''>Address</th>                                            
						<th class=''>State</th>                                            
						<th class=''>City</th>                                            
						<th class=''>Pincode</th>                                            
						<th class=''>Loan Type</th>                                            
						<th class=''>Adhar No</th>                                            
						<th class=''>Pan No</th>                                            
						<th class=''>Loan Amount</th>                                       
						<th class=''>Parent name</th>                                       
						<th class=''>Date</th>                                                
						<?php if ($this->session->userdata('role') == 1) {?>                                      
						<th class=''>Action</th>
                        <?php }?>
					</tr>
				</thead>
				<tbody>
					<?php
					if(!empty($datas)) {
					 $num = 1 ; 
                    //  print_r($datas);die;
					foreach($datas as $data) {
                        $domain_name = $this->db->select('url')->where('id', $data->domain_id)->get('domains')->row();
						$state = $this->db->select('name')->where('id', $data->state)->get('states')->row();
						$assigned_admin = '';
						$parent_name = '';
						if(!empty($data->assigned_to)) {
							$admin = $this->db->select('name')->where('id', $data->assigned_to)->get('user_master')->row();
							$assigned_admin = $admin ? $admin->name : '';
						}
                        if(!empty($data->parent_user)) {
                        $parent = $this->db->select('name')->where('id', $data->parent_user)->get('user_master')->row();
                        $parent_name = $parent ? $parent->name : '';
                        }
                        ?>
					<tr>
						<td class=''><?php echo $num; ?></td>						
						<td class=''><?php echo $data->name; ?></td>                                               
						<td class=''><?php echo $data->mobile; ?></td>                                               
						<td class=''><?php echo $data->email; ?></td>                                               
						<td class=''><?php echo $data->age == 0 ? '' : $data->age; ?></td>                                               
						<td class=''><?php echo $data->address; ?></td>                                               
						<td class=''><?php echo $state->name ?? $data->state; ?></td>                                               
						<td class=''><?php echo $data->city; ?></td>                                               
						<td class=''><?php echo $data->pincode; ?></td>                                               
						<td class=''><?php echo $data->type; ?></td>                                               
						<td class=''><?php echo $data->aadhar; ?></td>                                               
						<td class=''><?php echo $data->pan; ?></td>                                               
						<td class=''><?php echo $data->loan_amount; ?></td>                                               
						<td class=''><?php echo $parent_name; ?></td>                                               
						<td class=''><?php echo date('d-m-Y', strtotime($data->created_at)); ?></td>                                               
						<?php if($this->session->userdata('role') == 1){ ?>
						<td class=''>
							<button type='button' class='btn btn-primary btn-sm assign_user' title="Assign user"  data-id='<?php echo $data->id; ?>' data-assignedTo='<?php echo $data->team_id; ?>' data-domain_id='<?php echo $data->domain_id; ?>'>
								<i class='fa fa-eye'></i>
							</button>
							<button type='button' class='btn btn-danger btn-sm delete-btn' title="Delete" data-id='<?php echo $data->id; ?>'>
                                <i class='fa fa-trash'></i>
							</button>
						</td>
                        <?php } ?>
					</tr>
				   <?php $num++;  } }?>
				</tbody>
			</table>
			</div>
		</div>
	</div>
</div>

<!-- Assign User Modal -->
<div class="modal fade" id="assignUserModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Assign to User</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label>Assign Lead</label>
                    <select id="team_id" class="form-control">
                        <option value="">Select user</option>
                    </select>
                </div>
            </div>

            <div class="modal-footer">
                <input type="hidden" id="selectedEnquiryId">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="assignUserBtn">Assign</button>
            </div>

        </div>
    </div>
</div>


<!-- Delete Confirmation Modal -->
<div class='modal fade' id='deleteModal' tabindex='-1' role='dialog' aria-labelledby='deleteModalLabel' aria-hidden='true'>
    <div class='modal-dialog' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='deleteModalLabel'>Confirm Delete</h5>
                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </div>
            <div class='modal-body'>
                Are you sure you want to delete this loan enquiry? This action cannot be undone.
            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancel</button>
                <button type='button' class='btn btn-danger' id='confirmDelete'>Delete</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    var deleteId;
    var deleteButton;
    
// Handle assign user button click
$('.assign_user').on('click', function () {
    var enquiryId = $(this).data('id');
    var domainId  = $(this).data('domain_id');
     var assignedTo = $(this).attr('data-assignedto'); 

    $('#selectedEnquiryId').val(enquiryId);
    $('#assignUserModal').modal('show');

    $.ajax({
        url: '<?= base_url("admin/Dashboard/get_admin_users"); ?>',
        type: 'POST',
        dataType: 'json',
        data: { domain_id: domainId },
        success: function (response) {
            var html = '<option value="">Select user</option>';

            if (response.status === 'success' && response.users.length > 0) {
                $.each(response.users, function (index, user) {
					console.log(user.id);
					console.log(assignedTo);
					
					var selected = (user.id == assignedTo) ? 'selected' : '';
                    html += '<option value="' + user.id + '" ' + selected + '>' + user.name + '</option>';
                });
            } else {
                html = '<option value="">No admin users found</option>';
            }

            $('#team_id').html(html);
        },
        error: function () {
            $('#team_id').html('<option value="">No admin users found</option>');
        }
    });
});


// Assign button click
$('#assignUserBtn').on('click', function () {
    var teamId    = $('#team_id').val();
    var enquiryId = $('#selectedEnquiryId').val();

    if (teamId === '') {
        alert('Please select user');
        return;
    }

    $.ajax({
        url: '<?= base_url("admin/Dashboard/assign_user"); ?>',
        type: 'POST',
        dataType: 'json',
        data: {
            team_id: teamId,
            enquiry_id: enquiryId
        },
        success: function (response) {
            if (response.status === 'success') {
                alert('User assigned successfully');
				$('.assign_user[data-id="' + enquiryId + '"]')
				.attr('data-assignedto', response.team_id);
				
				// (optional) user name UI me show
				var teamName = $('#team_id option:selected').text();
				$('#assigned_user_' + enquiryId).text(teamName);
                $('#assignUserModal').modal('hide');
            } else {
                alert('Something went wrong');
            }
        }
    });
});

      
    // Handle delete button click
    $('.delete-btn').on('click', function() {
        deleteId = $(this).data('id');
        deleteButton = $(this);
        $('#deleteModal').modal('show');
    });
    
    // Handle confirm delete
    $('#confirmDelete').on('click', function() {
        if (deleteId) {
            $.ajax({
                url: '<?php echo base_url("admin/Dashboard/delete_loan_enquiry/"); ?>' + deleteId,
                type: 'POST',
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        // Show success message
                        $('#message').html('<div class="alert alert-success">' + response.message + '</div>');
                        // Remove the deleted row
                        deleteButton.closest('tr').fadeOut(400, function() {
                            $(this).remove();
                        });
                    } else {
                        // Show error message
                        $('#message').html('<div class="alert alert-danger">' + (response.message || 'Error deleting record') + '</div>');
                    }
                    // Hide message after 5 seconds
                    setTimeout(function() {
                        $('#message').fadeOut('slow');
                    }, 5000);
                    // Hide the modal
                    $('#deleteModal').modal('hide');
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    $('#message').html('<div class="alert alert-danger">Error deleting record. Please try again.</div>');
                    $('#deleteModal').modal('hide');
                    // Hide message after 5 seconds
                    setTimeout(function() {
                        $('#message').fadeOut('slow');
                    }, 5000);
                }
            });
        }
    });
});
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const textInput = document.getElementById("color");
    const colorPicker = document.getElementById("color_picker");

    // Initial Sync
    if (textInput.value) {
        colorPicker.value = textInput.value;
    } else {
        textInput.value = colorPicker.value;
    }

    // Text → Color Picker
    textInput.addEventListener("input", function () {
        if (/^#[0-9A-Fa-f]{6}$/.test(this.value)) {
            colorPicker.value = this.value;
        }
    });

    // Color Picker → Text
    colorPicker.addEventListener("input", function () {
        textInput.value = this.value;
    });

});
</script>
