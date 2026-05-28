<style>
.container {
    margin-top: 20px;
    margin-bottom: 15px;
}



</style>

<div class="container-fluid p-0">
	<nav aria-label="breadcrumb">
	<ol class="breadcrumb ">
		<li class="breadcrumb-item "><a href="<?php echo base_url("admin/Dashboard/");?>" class="text-decoration-none">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page">Channel Partner Details</li>
	</ol>
	</nav>
</div>
<div class="container-fluid px-0">
	<div class="row m-0">
		<div class="col-md-12 px-0">
		    <div id="message" class="text-primary text-center"></div>
			<div class="table-responsive shadow-lg">
			 <div class="p-3">
			     <form name="channel" method="post" action="<?php echo base_url("admin/update-partner/");?>"  enctype="multipart/form-data">
			     <input type="hidden" class="form-control" id="id" name="id" value="<?=$datas[0]->id?>" >
    			  <div class="row mx-0">
    			      <div class="col-md-6">
                        <div class="form-group mb-2">
                          <label for="usr">Name:</label>
                          <input type="hidden" class="form-control" id="ref" name="ref" value="<?=$ref?>" >
                          <input type="text" class="form-control" id="name" name="name" value="<?=$datas[0]->name?>" >
                        </div>
    			          
    			      </div>
    			      <div class="col-md-6">
    			        <div class="form-group mb-2">
                          <label for="usr">Email:</label>
                          <input type="text" class="form-control" id="email" name="email" value="<?=$datas[0]->email?>" readonly>
                        </div>
    			          
    			      </div>
    			  </div>
    			  <div class="row mx-0">
    			      <div class="col-md-6">
                        <div class="form-group mb-2">
                          <label for="usr">username:</label>
                          <input type="text" class="form-control" id="username" name="username" value="<?=$datas[0]->username?>">
                        </div>
    			          
    			      </div>
    			      <div class="col-md-6">
    			        <div class="form-group mb-2">
                          <label for="usr">mobile:</label>
                          <input type="text" class="form-control" id="mobile_no" name="mobile_no" value="<?=$datas[0]->mobile_no?>">
                        </div>
    			          
    			      </div>
    			  </div>
    			  <div class="row mx-0">
    			      <div class="col-md-6">
                        <div class="form-group mb-2">
                          <label for="usr">city:</label>
                          <input type="text" class="form-control" id="city" name="city" value="<?=$datas[0]->city?>">
                        </div>
    			          
    			      </div>
    			      <div class="col-md-6">
    			        <div class="form-group mb-2">
                          <label for="usr">Pin code:</label>
                          <input type="text" class="form-control" name="pin_code" id="pin_code" value="<?=$datas[0]->pin_code?>">
                        </div>
    			          
    			      </div>
					    <?php 
							if (!empty($ref)) {?>
							<div class="col-md-6">
								<div class="form-group mb-2">
								<label for="usr">Referral Amount:</label>
								<input type="number" class="form-control" name="referral_amount"  id="rejected_file_count" value="<?=$datas[0]->referral_amount?>">
								</div>
							</div>
							<?php }?>
						</div>
				  <?php
						if ($this->session->userdata('role') == 1 && !empty($ref) && $ref == 'my-team') { ?>
						<h4 style="font-weight:600;">ID Card Info</h4>
						<div class="row">
						<div class="col-sm-6">
							<div class="form-group mb-2">
								<label class="text-dark" for="emp_profile">Position<span class="text-danger">*</span></label>
								<input type="text" aria-required="true" name="emp_profile"  value="<?=$datas[0]->emp_profile?>"  class="form-control" placeholder="Position" required>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group mb-2">
								<label class="text-dark" for="profile_photo">Profile Image</label>
								<div class="custom-file">
									<input type="file" class="custom-file-input" id="profile_photo" name="profile_photo" accept="image/*" onchange="previewImage(this, 'preview-edit');">
									<label class="custom-file-label" for="profile_photo">Choose file</label>
								</div>
								<small class="form-text text-muted">Maximum file size: 2MB (JPG, PNG, JPEG)</small>
								<div class="d-flex gap-2">
									<?php if (!empty($datas[0]->profile_photo) && file_exists($datas[0]->profile_photo)): ?>
										<div class="mb-2 mr-2">
											<p class="mb-1">Current Image:</p>
											<img src="<?php echo base_url($datas[0]->profile_photo); ?>" 
											alt="Current Profile Photo" 
											class="img-thumbnail" 
											style="max-width: 150px; max-height: 150px;">
										</div>
									<?php endif; ?>
									
									<!-- Preview container for new image -->
									<div class="" id="imagePreviewEdit" style="display: none;">
										<p class="mb-1">New Image Preview:</p>
										<img id="preview-edit" src="#" alt="Preview" class="img-thumbnail" style="max-width: 150px; max-height: 150px;">
									</div>
								</div>
								
							</div>
						</div>

						<!-- Add this script at the bottom of your file, before the closing body tag -->
						<script>
						function previewImage(input, previewId) {
							const preview = document.getElementById(previewId);
							const imagePreview = document.getElementById('imagePreviewEdit');
							const file = input.files[0];
							
							if (file) {
								const reader = new FileReader();
								
								reader.onload = function(e) {
									preview.src = e.target.result;
									imagePreview.style.display = 'block';
								}
								
								reader.readAsDataURL(file);
								
								// Update file label
								const fileName = input.files[0].name;
								const label = input.nextElementSibling;
								label.textContent = fileName;
							}
						}

						// Show file name in custom file input
						document.querySelectorAll('.custom-file-input').forEach(input => {
							input.addEventListener('change', function(e) {
								const fileName = e.target.files[0]?.name || 'Choose file';
								const label = this.nextElementSibling;
								label.textContent = fileName;
							});
						});
						</script>
						<div class="col-sm-6">
							<div class="form-group mb-2">
								<label class="text-dark" for="joining_date">Joining Date</label>
								<input type="date" class="form-control" id="joining_date"  value="<?=$datas[0]->joining_date?>"  name="joining_date">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group mb-2">
								<label class="text-dark" for="emergency_number">Emergency number</label>
								<input type="number" class="form-control" id="emergency_number"  value="<?=$datas[0]->emergency_number?>"  name="emergency_number">
							</div>
						</div>
					</div>
					<h4 style="font-weight:600;">Offer letter Info</h4>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="text-dark" for="job_title">Job Title</label>
								<input type="text" class="form-control" name="job_title" id="job_title" placeholder="Enter job title" value="<?=$datas[0]->job_title?>">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="text-dark" for="reporting_to">Reporting To</label>
								<input type="text" class="form-control" name="reporting_to" id="reporting_to" placeholder="Enter reporting manager" value="<?=$datas[0]->reporting_to?>">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="text-dark" for="proposed_start_date">Proposed Start Date</label>
								<input type="date" class="form-control" name="proposed_start_date" id="proposed_start_date" value="<?=$datas[0]->proposed_start_date?>">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="text-dark" for="annual_salary">Annual Salary</label>
								<input type="text" class="form-control" name="annual_salary" id="annual_salary" placeholder="Enter annual salary" value="<?=$datas[0]->annual_salary?>">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="text-dark" for="work_schedule">Work Schedule</label>
								<input type="text" class="form-control" name="work_schedule" id="work_schedule" placeholder="e.g., 9:00 AM - 6:00 PM" value="<?=$datas[0]->work_schedule?>">
							</div>
						</div>
						<!-- <div class="col-sm-6">
							<div class="form-group">
								<label class="text-dark" for="min_retainership_amount">Min. Retainership Amount</label>
								<input type="number" class="form-control" name="min_retainership_amount" id="min_retainership_amount" placeholder="Enter minimum retainership amount" value="<?=$datas[0]->min_retainership_amount?>">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="text-dark" for="max_retainership_amount">Max. Retainership Amount</label>
								<input type="number" class="form-control" name="max_retainership_amount" id="max_retainership_amount" placeholder="Enter maximum retainership amount" value="<?=$datas[0]->max_retainership_amount?>">
							</div>
						</div> -->
						<div class="col-sm-12 ">
							<div class="form-group mb-2">
								<label class="text-dark" for="description">Description</label>
								<textarea class="form-control" name="description" id="description" rows="3" placeholder="Enter team member description"><?=$datas[0]->description?></textarea>
								<script>CKEDITOR.replace('description', {height:150});</script>
							</div>
						</div>
					<?php }?>
					
    			  </div>
    			  
    			  
    			  
    			  <div class="row mx-0">
					
 
					  <?php 
					  	if(domain_id_get() == $datas[0]->domain_id && $datas[0]->parent_id_role != 1){
					 		if (empty($ref) && $this->session->userdata('role') == 1) {?>
								<div class="col-md-6">
									<div class="form-group mb-2">
									<label for="parent_team_id">Select Team</label>
										<select class="form-control" name="parent_team_id" >
											<option value="">Select Team</option>
											<?php
												if($teamData){
													foreach($teamData as $team_data){
														$selected = ($datas[0]->parent_team_id ==  $team_data->id) ? 'selected' : '';
														echo '<option '.$selected.' value="'.$team_data->id.'">'.$team_data->name.'</option>';
													}
												} 
												// echo '<option disabled >-----My Network-----</option>';
												// if($networkData){
												// 	foreach($networkData as $network_data){
												// 		$selected = ($datas[0]->parent_team_id ==  $network_data->id) ? 'selected' : '';
												// 		echo '<option '.$selected.' value="'.$network_data->id.'">'.$network_data->name.'</option>';
												// 	}
												// }
											?>
										</select>
									</div>
								</div>
								<?php } }?>
							</div>
							<div class="row">
						
						<?php if($this->session->userdata('role') == 1){?>
						  
						<?php if($this->session->userdata('type') == 'admin'){?>
						<div class="col-md-12">	<h3>Transfer user</h3></div>
						<div class="col-md-6">
							<label for="domain_id" class="form-label">Domain</label>
							<select class="form-control" id="domain_id" required name="domain_id">
								<?php foreach ($domains as $domain) { ?>
									<option <?= ($datas[0]->domain_id == $domain['id']) ? 'selected' : ''; ?> value="<?= $domain['id'] ?>"> <?= $domain['url'] ?></option>
								<?php } ?>
							</select>
						</div>
					<?php }else {?>
						<input type="hidden" value="<?= $datas[0]->domain_id?>" name="domain_id">
				<?php }?>
				<?php 
				if (empty($ref) ) {?>
					<div class="col-md-6">
						<div class="form-group mb-2">
						<label for="assigned_rm">Assign RM</label>
							<select class="form-control" name="assigned_rm" >
								<option>Select RM</option>
								<?php
									if($teamData){
										foreach($teamData as $team_data){
											$selected = ($datas[0]->assigned_rm ==  $team_data->id) ? 'selected' : '';
											echo '<option '.$selected.' value="'.$team_data->id.'">'.$team_data->name.'</option>';
										}
									} 
									
								?>
							</select>
						</div>
					</div>
					<?php }?>



					<?php }?>
				</div>
    			  
    			  <div class="row mx-0">
    			      <div class="col-md-5">
                          
    			      </div>
    			       <div class="col-md-2">
    			           
    			            <input type="submit" name="update" class="btn btn-primary mb-2" value="Submit">
    			          
    			      </div>
    			      <div class="col-md-5">
    			          
    			      </div>
    			  </div>
    			</form>
    			  
			  </div>
			</div>
		</div>
	</div>
</div>
