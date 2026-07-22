
<div class="container-fluid p-0">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin-dashboard");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Add Lead</li>
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
            <?php echo form_open_multipart('admin/create-lead');?>
            
            
            <div class="row">
                <input type="hidden" name="uid" id="uid" class="form-control" value="<?php echo $this->session->userdata('user_id');?>" >
                <div class="col-md-6">
                    <label for="Process" class="form-label">Process Type<span class="text-danger">*</span></label>
                     
                       <select id="process_id" class="form-control" name="process_id" required>
                        <option _ngcontent-mir-c194="" value="0">Select type</option>
                        <?php foreach($process_type as $type) { ?>
                            <option _ngcontent-mir-c194="" value="<?=$type->id?>"><?=$type->process_name?>. (<?=$type->process_type?>)</option>
                            
                        <?php } ?>
                    </select>
                    <?php echo form_error('process_id','<span class="text-danger mt-1">','</span>') ;?>
                
                </div>
                <?php
               if ($this->session->userdata('type') == 'admin') { ?>
                     <div class="col-md-6 ">
                        <label for="domain_id_main" class="form-label">Domain</label>
                  <select class="form-control" id="domain_id_main" required name="domain_id">
                     <?php foreach ($domains as $domain) { ?>
                        <option value="<?= $domain['id'] ?>"> <?= $domain['url'] ?></option>
                        <?php } ?>
                     </select>
                  </div>
                  <?php }else{?>
                     <input type="hidden" name="domain_id"  class="form-control" value="<?= domain_id_get() ?>" >
                     <?php }?>           
                     
                  </div>
            
             <div class="row">
                <div class="col-md-6">
                    <label for="loan_amount" class="form-label">Loan Amount<span class="text-danger">*</span></label>
                      <input type="number" name="loan_amount" id="loan_amount" class="form-control" maxlength="10"  required>
                       <?php echo form_error('loan_amount','<span class="text-danger mt-1">','</span>') ;?>
                    </div>
                
                <div class="form-group col-md-6">
                <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                      <select id="title" class="form-control" name="title" required>
                        <option _ngcontent-mir-c194="" value="">Select type</option>
                        <option _ngcontent-mir-c194="" value="Miss">Miss</option>
                        <option _ngcontent-mir-c194="" value="MR">MR</option>
                        <option _ngcontent-mir-c194="" value="MRS">MRS</option>
                        
                    </select>
                       <?php echo form_error('title','<span class="text-danger mt-1">','</span>') ;?>
                </div>
                
            </div>
            
             <div class="row">
                <div class="col-md-4">
                    <label for="first_name" class="form-label">First Name<span class="text-danger">*</span></label>
                      <input type="text" name="first_name" id="first_name" class="form-control" maxlength="25"  required>
                       <?php echo form_error('first_name','<span class="text-danger mt-1">','</span>') ;?>
                </div>
                <div class="col-md-4">
                    <label for="midle_name" class="form-label">Middle Name<span class="text-danger"></span></label>
                      <input type="text" name="middle_name" id="middle_name" class="form-control"  maxlength="25">
                       <?php echo form_error('middle_name','<span class="text-danger mt-1">','</span>') ;?>
                </div>
                <div class="col-md-4">
                    <label for="last_name" class="form-label">Last Name<span class="text-danger">*</span></label>
                      <input type="text" name="last_name" id="last_name" class="form-control"  maxlength="25" required>
                       <?php echo form_error('last_name','<span class="text-danger mt-1">','</span>') ;?>
                </div>
                
            </div>
            
            
            <div class="row">
                 <div class="col-md-6">
                   <label for="gender" class="form-label">Gender<span class="text-danger">*</span></label>
                      <select id="gender" class="form-control" name="gender" required>
                        <option _ngcontent-mir-c194="" value="">Select type</option>
                        <option _ngcontent-mir-c194="" value="male">Male</option>
                        <option _ngcontent-mir-c194="" value="female">Female</option>
                        <option _ngcontent-mir-c194="" value="other">Other </option>
                        
                    </select>
                    <?php echo form_error('gender','<span class="text-danger mt-1">','</span>') ;?>
                
                 </div>
                 <div class="col-md-6">
                   <label for="dob" class="form-label">DOB<span class="text-danger">*</span></label>
                     <input type="date" name="dob" id="dob" class="form-control"  required>
                    <?php echo form_error('dob','<span class="text-danger mt-1">','</span>') ;?>
                
                 </div>
            </div>
            <div class="row">
                 <div class="col-md-6">
                     <label for="mobile" class="form-label">Mobile No<span class="text-danger">*</span></label>
                     <input type="number" name="mobile" id="mobile" class="form-control"  maxlength="10" required>
                     <?php echo form_error('mobile','<span class="text-danger mt-1">','</span>') ;?>
                 </div>
                 <div class="col-md-6">
                     <label for="pan" class="form-label">Pan<span class="text-danger">*</span></label>
                     <input type="text" name="pan" id="pan" class="form-control"   maxlength="10" required>
                     <?php echo form_error('pan','<span class="text-danger mt-1">','</span>') ;?>
                 </div>
            </div>
            
            <div class="row">
                 <div class="col-md-6">
                     <label for="zip_code" class="form-label">Pincode<span class="text-danger">*</span></label>
                     <input type="number" name="zip_code" id="zip_code" class="form-control"  maxlength="10" required>
                     <?php echo form_error('zip_code','<span class="text-danger mt-1">','</span>') ;?>
                 </div>
                
            </div>
            
             <?php
                $user = $this->db
                ->where('id', $this->session->userdata('user_id'))
                ->get('user_master')
                ->row_array();
                if(!empty($user) && $user['parent_id_role'] == 1){?>
               <div class="row">
                  <div class="col-md-6">
                        <label for="add_for" class="form-label">Add For<span class="text-danger">*</span></label>
                        <select id="add_for" class="form-control" name="add_for">
                           <?php
                           if (!empty($teamusers)) {
                              foreach ($teamusers as $teamuser) {
                                    ?>
                                    <option value="<?php echo $teamuser['id']; ?>"
                                          data-role="<?php echo $teamuser['role']; ?>">
                                       <?php echo $teamuser['name']; ?>
                                    </option>
                                    <?php
                              }
                           }
                           ?>
                        </select>

                        <input type="hidden" name="add_for_role" id="add_for_role">
                  </div>
                  
               </div>
               <script>
                  $(document).ready(function () {

                     function setRole() {
                        var role = $('#add_for option:selected').data('role');
                        $('#add_for_role').val(role);
                     }

                     setRole(); // first selected option

                     $('#add_for').change(function () {
                        setRole();
                     });
                  });
               </script>
            <?php }?>
            <div class="row">
                
                <div class="col-md-5">
                    
                </div>
                <div class="col-md-2"> 
                     <div class="form-group">
                       <button type="submit" name="create" id="create" value="create" class="btn btn-info mt-4">Create </button>
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
