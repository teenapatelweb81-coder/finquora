
<div class="container-fluid p-0">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin-dashboard");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Add Network Member</li>
           </ol>
         </nav>
</div>
<div class="container-fluid">
   <div class="row">
      <div class="col-md-12 px-0 form-main">
         <div class="card  form-card">
            <div id="success_message"></div>
             <!--<span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>-->
             <span class="text-center text-white bg-danger mb-2" id="errid"> <?php  echo $this->session->flashdata('message');?></span>
            <?php echo form_open_multipart('admin/send-network-otp');?>
            
            <div class="row">
               <div class="col-sm-4">
                <div class="form-group">
            				<label class="text-dark" for="username">Full name<span class="text-danger">*</span></label>
            
            				<input type="text" class="form-control" aria-required="true" name="username" placeholder="Full Name" id="username" required>
            				<input type="hidden" name="user_type" id="user_type" value="agent">
            				<input type="hidden" name="member_type" id="member_type" value="network">
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
                    <?php
                     if ($this->session->userdata('type') == 'admin') { ?>
                           <div class="col-sm-4">
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
            
            			
            </div>
            
            
            
            <div class="row">
                
                <div class="col-md-5">
                    
                </div>
                <div class="col-md-2"> 
                     <div class="form-group">
                       <button type="submit" name="create" id="create" value="create" class="btn btn-info mt-4">Create</button>
                       <!--<a href="<?php echo base_url('admin/create-lead') ;?>" class="btn btn-secondary mt-4">Create</a>-->
                    </div>
                     
                </div>
                <div class="col-md-5">
                    
                </div>
                 
            </div>
            <?php echo form_close();?>
         </div>
      </div>
   </div>
</div>
