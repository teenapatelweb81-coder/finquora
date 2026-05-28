<div class="container-fluid p-0">
	<nav aria-label="breadcrumb">
	<ol class="breadcrumb ">
		<li class="breadcrumb-item "><a href="<?php echo base_url("admin/Dashboard/");?>" class="text-decoration-none">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page">Add Team</li>
	</ol>
	</nav>
</div>

<div class="container-fluid">
   <div class="row">
      <div class="col-md-12 px-0 form-main">
         <div class="card  form-card">
            <div id="success_message"></div>
            <span class="text-center text-white bg-danger mb-2" id="errid"> <?php  echo $this->session->flashdata('message');?></span>
            <?php echo form_open_multipart('admin/send-otp');?>
            
            <div class="row ">
               <div class="col-sm-4">
                <div class="form-group">
            				<label class="text-dark" for="username">Full name<span class="text-danger">*</span></label>
            				<input type="text" class="form-control" aria-required="true" name="username" placeholder="Full Name" id="username" required>
            				<input type="hidden" name="user_type" id="user_type" value="agent">
            			</div>
            		</div>
                    <div class="col-sm-4">
            			<div class="form-group">
            				<label class="text-dark" for="usermobile">Mobile No<span class="text-danger">*</span> </label>
            				<input type="number" class="form-control" aria-required="true" name="usermobile" placeholder="Mobile No" id="usermobile" required>
            			</div>
            	   </div>
            	   <div class="col-sm-4">
            			<div class="form-group">
            				<label class="text-dark" for="useremail">Email<span class="text-danger">*</span></label>
            				<input type="email" aria-required="true" name="useremail" value="" class="form-control" placeholder="As per your bank records" required>
            				<div class="help-block font-small-3"></div>
            			</div>
            	   </div>

            	</div>
            	
            	<div class="row">
               		<div class="col-sm-4">
                		<div class="form-group">
            				<label class="text-dark" for="city">City<span class="text-danger">*</span></label>
            				<input type="text" aria-required="true" name="city"  class="form-control" placeholder="City" required>
            				<div class="help-block font-small-3"></div>
            			</div>
            		</div>
                    <div class="col-sm-4">
            		<div class="form-group">
            				<label class="text-dark" for="address">Address<span class="text-danger">*</span></label>
            				<input type="text" aria-required="true" name="address"  class="form-control" placeholder="Address" required>
            				<div class="help-block font-small-3"></div>
            			</div>
            	   </div>
            	   <div class="col-sm-4">
            			<div class="form-group">
            				<label class="text-dark" for="pin_code">Pin code<span class="text-danger">*</span></label>
            				<input type="text" aria-required="true" name="pin_code"  class="form-control" placeholder="Pin code" min="100000" inputmode="numeric" data-validation-regex-regex="[0-9]+" aria-invalid="false" required>
            				<div class="help-block font-small-3"></div>
            			</div>
            	   </div>
            	</div>
				   <?php
						if ($this->session->userdata('role') == 1) { ?>
					<h4 style="font-weight:600;">ID Card Info</h4>
					<div class="row">
						<div class="col-sm-4">
							<div class="form-group">
								<label class="text-dark" for="emp_profile">Position<span class="text-danger">*</span></label>
								<input type="text" aria-required="true" name="emp_profile"  class="form-control" placeholder="Position" required>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label class="text-dark" for="profile_photo">Profile Image</label>
								<div class="custom-file">
									<input type="file" class="custom-file-input" id="profile_photo" name="profile_photo" accept="image/*" onchange="previewImage(this);">
									<label class="custom-file-label" for="profile_photo">Choose file</label>
								</div>
								<small class="form-text text-muted">Maximum file size: 2MB (JPG, PNG, JPEG)</small>
								
								<!-- Add this div for image preview -->
								<div class="mt-3" id="imagePreview" style="display: none;">
									<img id="preview" src="#" alt="Preview" class="img-thumbnail" style="max-width: 150px; max-height: 150px;">
								</div>
							</div>
						</div>

						<!-- Add this script at the bottom of your file or in your existing script section -->
						<script>
						function previewImage(input) {
							const preview = document.getElementById('preview');
							const imagePreview = document.getElementById('imagePreview');
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
						document.querySelector('.custom-file-input').addEventListener('change', function(e) {
							const fileName = e.target.files[0]?.name || 'Choose file';
							const label = this.nextElementSibling;
							label.textContent = fileName;
						});
						</script>
						<div class="col-sm-4">
							<div class="form-group">
								<label class="text-dark" for="joining_date">Joining Date</label>
								<input type="date" class="form-control" id="joining_date" name="joining_date" value="<?php echo date('Y-m-d'); ?>">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="text-dark" for="emergency_number">Emergency number</label>
								<input type="text" class="form-control" name="emergency_number" id="emergency_number" placeholder="Enter Emergency number">
							</div>
						</div>

					</div>
					<h4 style="font-weight:600;">Offer letter Info</h4>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="text-dark" for="job_title">Job Title</label>
								<input type="text" class="form-control" name="job_title" id="job_title" placeholder="Enter job title">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="text-dark" for="reporting_to">Reporting To</label>
								<input type="text" class="form-control" name="reporting_to" id="reporting_to" placeholder="Enter reporting manager">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="text-dark" for="proposed_start_date">Proposed Start Date</label>
								<input type="date" class="form-control" name="proposed_start_date" id="proposed_start_date">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="text-dark" for="annual_salary">Annual Salary</label>
								<input type="text" class="form-control" name="annual_salary" id="annual_salary" placeholder="Enter annual salary">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="text-dark" for="work_schedule">Work Schedule</label>
								<input type="text" class="form-control" name="work_schedule" id="work_schedule" placeholder="e.g., 9:00 AM - 6:00 PM">
							</div>
						</div>
						<!-- <div class="col-sm-6">
							<div class="form-group">
								<label class="text-dark" for="min_retainership_amount">Min. Retainership Amount</label>
								<input type="number" class="form-control" name="min_retainership_amount" id="min_retainership_amount" placeholder="Enter minimum retainership amount">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="text-dark" for="max_retainership_amount">Max. Retainership Amount</label>
								<input type="number" class="form-control" name="max_retainership_amount" id="max_retainership_amount" placeholder="Enter maximum retainership amount">
							</div>
						</div> -->
						<div class="col-sm-12">
							<div class="form-group">
								<label class="text-dark" for="description">Description</label>
								<textarea class="form-control" name="description" id="description" rows="3" placeholder="Enter team member description"></textarea>
								<script>CKEDITOR.replace('description', {height:150});</script>
							</div>
						</div>
						<?php } 
						if ($this->session->userdata('role') == 'admin') { ?>
						<div class="col-sm-4">
							<label for="domain_id_main" class="form-label">Domain</label>
							<select class="form-control" id="domain_id_main" required name="domain_id">
								<?php foreach ($domains as $domain) { ?>
									<option <?= (domain_id_get() == $domain['id']) ? 'selected' : ''; ?> value="<?= $domain['id'] ?>"> <?= $domain['url'] ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<?php }else{?>
						<input type="hidden" name="domain_id"  class="form-control" value="<?= domain_id_get() ?>" >
						<?php }?> 
				</div>
            
            <div class="row">
                <div class="col-md-12"> 
                     <div class="form-group">
                       <button type="submit" name="create" id="create" value="create" class="btn btn-info mt-4">Create</button>
                       <!--<a href="<?php echo base_url('admin/create-lead') ;?>" class="btn btn-secondary mt-4">Create</a>-->
                    </div>
                </div>
                    
                </div>
                 
            </div>
            <?php echo form_close();?>
         </div>
      </div>
   </div>
</div>
