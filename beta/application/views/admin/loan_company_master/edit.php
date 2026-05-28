
<div class="container-fluid p-0">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin-dashboard"); ?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Edit Self Bank Login</li>
           </ol>
         </nav>
</div>
<div class="container-fluid">
   <div class="row">
      <div class="col-md-12 px-0  form-main">
         <div class="card  form-card">
            <div id="success_message"></div>
             <!--<span class="text-center text-info mb-2" id="susid"> <?php //echo $this->session->flashdata('success');?></span>-->
             <span class="text-center text-white bg-danger mb-2" id="errid"> <?php //echo $this->session->flashdata('message');?></span>
            <?php echo form_open_multipart('admin/loan-company-master-update'); ?>

            <div class="row">
               <div class="col-sm-4">
                <div class="form-group">
            				<label class="text-dark" for="bank_name">Bank Name<span class="text-danger">*</span></label>
            				<input type="text"  value="<?=$datas->bank_name;?>" class="form-control" aria-required="true" name="bank_name"  id="username" required>
            				<input type="hidden" name="id" id="id_type" value="<?=$datas->id;?>">
            				<!-- <input type="hidden" name="member_type" id="member_type" value="network"> -->
            			</div>
            		</div>

                    <div class="col-sm-4">
            			<div class="form-group">
            				<label class="text-dark" for="loan_type">Loan Type<span class="text-danger">*</span> </label>
                            <select class="form-control" id="loan_type" name="loan_type">
                                <!-- <option value="<?=($datas->loan_type == '') ? 'selected' : '';?>">Select loan type</option> -->
                                <option value="home_loan"<?=($datas->loan_type == 'home_loan') ? 'selected' : '';?>>Home loan</option>
                                <option value="personal_loan"<?=($datas->loan_type == 'personal_loan') ? 'selected' : '';?>>Personal loan</option>
                                <option value="business_loan"<?=($datas->loan_type == 'business_loan') ? 'selected' : '';?>>Business loan</option>
                                <option value="instant_loan"<?=($datas->loan_type == 'instant_loan') ? 'selected' : '';?> >Instant loan</option>
                                <!-- <option value="instant_loan" >Instant loan</option> -->
                            </select>
            			</div>
            	   </div>

                  <?php
                        if ($this->session->userdata('type') == 'admin') { ?>
                              <div class="col-sm-4">
                                  <div class="form-group">
                                    <label for="domain_id_main" class="form-label">Domain</label>
                                    <select class="form-control" id="domain_id_main" required name="domain_id">
                                       <?php foreach ($domains as $domain) { ?>
                                             <option <?= ($datas->domain_id == $domain['id']) ? 'selected' : ''; ?> value="<?= $domain['id'] ?>"> <?= $domain['url'] ?></option>
                                       <?php } ?>
                                    </select>
                                 </div>
                              </div>
                        <?php }else{?>
                           <input type="hidden" name="domain_id"  class="form-control" value="<?= domain_id_get() ?>" >
                        <?php }?>
                        
                  <div class="col-sm-4">
                         <div class="form-group">
                              <label class="text-dark" for="bank_name">Link</label>
                              <input type="text" class="form-control" value="<?=$datas->link;?>"  aria-required="true" name="link" placeholder="Enter link" id="link">
                        </div>
                     </div>
                    <div class="col-sm-4">
                         <div class="form-group">
                              <label class="text-dark" for="user_id">User Id:</label>
                              <input type="text" class="form-control" aria-required="true" name="user" id="user_id" value="<?=$datas->user;?>" >
                        </div>
                     </div>
                     <div class="col-sm-4">
                         <div class="form-group">
                              <label class="text-dark" for="password">Password:</label>
                              <input type="text" class="form-control" aria-required="true" name="password" id="password"  value="<?=$datas->password;?>">
                        </div>
                     </div>
                     <div class="col-sm-4">
                         <div class="form-group">
                              <label class="text-dark" for="pincode">Pincode:</label>
                              <input type="text" class="form-control" aria-required="true" name="pincode" placeholder="Enter Pincode Number" id="pincode"  value="<?=$datas->pincode;?>" >
                        </div>
                     </div>
                     <div class="col-sm-3">
                         <div class="form-group">
                              <label class="text-dark" for="document">Pincode PDF/Excel</label>
                              <input type="file" class="form-control" aria-required="true" name="pincode_document"  id="document">
                        </div>
                     </div>
                     <div class="col-sm-3">
                         <div class="form-group">
                              <label class="text-dark" for="bank_name">Image</label>
                              <input type="file" class="form-control" aria-required="true" name="image"  id="image">
                        </div>
                     </div>

                     <div class="col-sm-2">
                        <?php if($datas->image){ ?>
                         <div class="">
                              <img src="<?=base_url()?><?=$datas->image;?>" width="100px"/>
                        </div>
                        <?php } ?>
                     </div>
                      <div class="col-sm-4">
                         <div class="form-group">
                              <label class="text-dark" for="document">Documnet Upload</label>
                              <input type="file" class="form-control" aria-required="true" name="document"  id="document" >
                        </div>
                     </div>
                     <div class="col-sm-4">
                         <div class="form-group">
                              <label class="text-dark" for="bank_name">Descriptions</label><br>
                              <textarea id="descriptions"class="form-control" name="descriptions" rows="3"><?=$datas->descriptions;?></textarea>
                        </div>
                     </div>
                     </div>

            <div class="row">

                <div class="col-md-5">

                </div>
                <div class="col-md-2">
                     <div class="form-group">
                       <button type="submit" id="create" class="btn btn-info mt-4">update</button>
                       <!--<a href="<?php echo base_url('admin/create-lead'); ?>" class="btn btn-secondary mt-4">Create</a>-->
                    </div>

                </div>
            </div>
            <?php echo form_close(); ?>
         </div>
      </div>
   </div>
</div>
