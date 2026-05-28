
<div class="container-fluid p-0">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin-dashboard");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Add loan company master</li>
           </ol>
         </nav>
</div>
<div class="container-fluid">
   <div class="row">
      <div class="col-md-12 px-0 form-main">
         <div class="card  form-card">
            <div id="success_message"></div>
             <!--<span class="text-center text-info mb-2" id="susid"> <?php //echo $this->session->flashdata('success');?></span>-->
             <span class="text-center text-white bg-danger mb-2" id="errid"> <?php  //echo $this->session->flashdata('message');?></span>
            <?php echo form_open_multipart('admin/add-loan-company-master');?>
            
            <div class="row">
               <div class="col-sm-4">
                <div class="form-group">
            				<label class="text-dark" for="bank_name">Bank Name<span class="text-danger">*</span></label>
            				<input type="text" class="form-control" aria-required="true" name="bank_name" placeholder="Bank Name" id="username" required>
            		</div>
                  </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                           <label class="text-dark" for="loan_type">Loan Type<span class="text-danger">*</span> </label>
                              <select class="form-control" id="loan_type" name="loan_type">
                                 <option value="">Select loan type</option>
                                 <option value="home_loan">Home loan</option>
                                 <option value="personal_loan">Personal loan</option>
                                 <option value="business_loan">Business loan</option>
                                 <option value="instant_loan" >Instant loan</option>
                              </select>
                        </div>
                     </div>
                     <div class="col-sm-4">
                         <div class="form-group">
                              <label class="text-dark" for="bank_name">Link<span class="text-danger">*</span></label>
                              <input type="text" class="form-control" aria-required="true" name="link" placeholder="Enter link" id="link" required>
                        </div>
                     </div>
                        <div class="col-sm-4">
                         <div class="form-group">
                              <label class="text-dark" for="bank_name">Image<span class="text-danger">*</span></label>
                              <input type="file" class="form-control" aria-required="true" name="image"  id="image" required>
                        </div>
                     </div>
                     <div class="col-sm-4">
                         <div class="form-group">
                              <label class="text-dark" for="bank_name">Descriptions<span class="text-danger">*</span></label>
                              <textarea id="descriptions" name="descriptions" rows="2" cols="47"></textarea>
                        </div>
                     </div>
            	   </div>
            	 
            <div class="row">
                
                <div class="col-md-5">
                    
                </div>
                <div class="col-md-2"> 
                     <div class="form-group">
                       <button type="submit" id="create" class="btn btn-info mt-4">Create</button>
                    </div>
                     
                </div>
            </div>
            <?php echo form_close();?>
         </div>
      </div>
   </div>
</div>
