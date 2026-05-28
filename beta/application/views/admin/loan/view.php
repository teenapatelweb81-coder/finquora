<style>
td, th {
    padding: 6px 10px;
}
</style>

<div class="container-fluid p-0">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin-dashboard");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page"><?= (isset($loans['apply_for_loan'])) ? $loans['apply_for_loan'] : '' ; ?> view</li> 
           </ol>
         </nav>
</div>
<div class="container-fluid">
        <div class="row">
            <div class="col-md-12 px-0 form-main">
                <div class="card  form-card">
                    <div id="success_message"></div>
                    <span class="text-center text-info mb-2" id="susid"></span>  <?php //echo $this->session->flashdata('success');?>
                    <span class="text-center text-white bg-danger mb-2" id="errid"> </span> <?php // echo $this->session->flashdata('error');?>
                    <?php //echo '<pre>';print_r($loans);die;?>
                    <div class="row">
                          <?php if ($this->session->userdata('role') == 1) {?>
                        <div class="col-md-12 text-right mb-3">
                            <div class="copy-text d-flex align-items-center justify-content-end">
                                    <input type="text" class="text py-1 px-2 form-control w-25" id="myInput" value="<?= base_url('web_pages/share/cpsess1101506595/')?><?= (isset($loans['id'])) ? $loans['id'] : '' ; ?>" />
                                    <button class="btn btn-primary" onclick="copylinks()"><i class="fa fa-clone"></i></button>
                                </div>
                        </div>
                        <?php }?>
                        <div class="col-md-3 mb-3">
                             <label for="loan_amount_req" class="form-label">Loan Requirement Amount <span class="text-danger">*</span></label>
                             <input type="text" name="loan_amount_req" id="loan_amount_req" class="form-control" value="<?= (isset($loans['loan_amount_req'])) ? $loans['loan_amount_req'] : '' ; ?>">

                         </div> 
                         <div class="col-md-3 mb-3">
                         <label for="client_name" class="form-label">Client Name <span class="text-danger">*</span></label>
                             <input type="text" name="client_name" id="client_name" class="form-control" value="<?= (isset($loans['client_name'])) ? $loans['client_name'] : '' ; ?> " >
                         
                         </div>
                         <div class="col-md-3 mb-3">
                             <label for="mobile" class="form-label">Mobile No. <span class="text-danger">*</span></label>
                             <input type="number" name="clientnumber" id="mobile" class="form-control"  value="<?= (isset($loans['clientnumber'])) ? $loans['clientnumber'] : '' ; ?>" >
                         </div> 
                         <div class="col-md-3 mb-3">
                             <label for="email" class="form-label">Email Id <span class="text-danger">*</span></label>
                             <input type="email" name="email" id="email" class="form-control"  value="<?= (isset($loans['email'])) ? $loans['email'] : '' ; ?> ">
                         </div> 
                        <div class="col-md-3 mb-3">
                            <label for="dob" class="form-label">Date Of Birth<span class="text-danger">*</span></label>
                            <input type="text" name="dob" id="name" class="form-control" value="<?= (isset($loans['dob'])) ? $loans['dob'] : '' ; ?>" >
                        </div> 
                        <div class="col-md-3 mb-3">
                        <label for="pan" class="form-label">Pan No.<span class="text-danger">*</span></label>
                            <input type="text" name="pan" id="pan" value="<?= (isset($loans['pan'])) ? $loans['pan'] : '' ; ?>" class="form-control" >
                        
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="aadhar" class="form-label">Aadhar No.<span class="text-danger">*</span></label>
                            <input type="text" name="aadhar" value="<?= (isset($loans['aadhar'])) ? $loans['aadhar'] : '' ; ?>" id="aadhar" class="form-control" >
                        </div> 
                        <div class="col-md-3 mb-3">
                             <label for="marital_Status" class="form-label">Marital Status <span class="text-danger">*</span></label>
                                <select name="marital_status" id="marital_Status" class="form-control">
                                    <option value="">Select</option>
                                    <option <?php if($loans['marital_status'] == 'Married'){echo 'selected';}?> value="Married">Married</option>
                                    <option <?php if($loans['marital_status'] == 'unmarried'){echo 'selected';}?> value="unmarried">unmarried</option>
                                </select>
                        </div> 
                        <div class="col-md-3 mb-3">
                            <label for="spouse_house" class="form-label">Spouse House<span class="text-danger">*</span></label>
                            <input type="text" name="spouse_house" id="spouse_house" value="<?= (isset($loans['spouse_house'])) ? $loans['spouse_house'] : '' ; ?>" class="form-control" >
                        </div> 
                        <div class="col-md-3 mb-3">
                            <label for="mother_name" class="form-label">Mother Name<span class="text-danger">*</span></label>
                            <input type="text" name="mother_name" id="mother_name" value="<?= (isset($loans['mother_name'])) ? $loans['mother_name'] : '' ; ?>" class="form-control" >
                        </div> 
                        <div class="col-md-3 mb-3">
                            <label for="alt_number" class="form-label">Other Contact Name<span class="text-danger">*</span></label>
                            <input type="text" name="alt_number" id="alt_number" value="<?= (isset($loans['mother_name'])) ? $loans['mother_name'] : '' ; ?>"  class="form-control" >
                        </div> 
                        <div class="col-md-3 mb-3">
                            <label for="qualification" class="form-label">Qualification<span class="text-danger">*</span></label>
                            <input type="text" name="qualification" id="qualification" value="<?= (isset($loans['qualification'])) ? $loans['qualification'] : '' ; ?>" class="form-control" >
                        </div> 
                        <div class="col-md-3 mb-3">
                            <label for="residential_type" class="form-label">Residence Type<span class="text-danger">*</span></label>
                            <input type="text" name="residential_type" id="residential_type" value="<?= (isset($loans['residential_type'])) ? $loans['residential_type'] : '' ; ?>" class="form-control" >
                        </div> 
                        <div class="col-md-3 mb-3">
                            <label for="residential_address" class="form-label">Residential Address <span class="text-danger">*</span></label>
                            <input type="text" name="residential_address" id="residential_address" value="<?= (isset($loans['residential_address'])) ? $loans['residential_address'] : '' ; ?>" class="form-control" >
                        </div> 
                        <div class="col-md-3 mb-3">
                            <label for="residential_address_token" class="form-label">Residential Address Token Form<span class="text-danger">*</span></label>
                            <input type="text" name="residential_address_token" id="residential_address_token" value="<?= (isset($loans['residential_address_token'])) ? $loans['residential_address_token'] : '' ; ?>" class="form-control" >
                        </div> 
                        <div class="col-md-3 mb-3">
                            <label for="residence_stability" class="form-label">Residence Stability<span class="text-danger">*</span></label>
                            <input type="text" name="residence_stability" id="residence_stability" value="<?= (isset($loans['residence_stability'])) ? $loans['residence_stability'] : '' ; ?>" class="form-control" >
                        </div> 

                        <div class="col-md-3 mb-3">
                             <label for="state" class="form-label">State Name <span class="text-danger">*</span></label>
                             <select name="state_name" id="state"  class="form-control">
                                    <option value="Select">Select</option>
                                    <?php if (!empty($states)) {
                                        foreach ($states as $key => $state) { ?>
                                           <option <?php if($state->id == $loans['state']){echo 'selected';}?> value="<?= $state->id?>"><?= $state->name?></option> 
                                    <?php }}?>
                                </select>
                        </div> 
                        <div class="col-md-3 mb-3">
                            <label for="city" class="form-label">City Name <span class="text-danger">*</span></label>
                            <select name="city" id="city" class="form-control">
                                    
                             </select>
                        </div> 
                        <div class="col-md-3 mb-3">
                            <label for="pin_code" class="form-label">Pin Code<span class="text-danger">*</span></label>
                            <input type="text" name="pin_code" id="pin_code" value="<?= (isset($loans['pin_code'])) ? $loans['pin_code'] : '' ; ?>" class="form-control" >
                        </div> 
                        <div class="col-md-3 mb-3">
                            <label for="company_name" class="form-label">Company Name<span class="text-danger">*</span></label>
                            <input type="text" name="company_name" id="company_name" value="<?= (isset($loans['company_name'])) ? $loans['company_name'] : '' ; ?>" class="form-control" >
                        </div> 

                        <div class="col-md-3 mb-3">
                            <label for="designation" class="form-label">Designation<span class="text-danger">*</span></label>
                            <input type="text" name="designation" id="designation" value="<?= (isset($loans['designation'])) ? $loans['designation'] : '' ; ?>" class="form-control" >
                        </div> 
                        <div class="col-md-3 mb-3">
                            <label for="company_address" class="form-label">Company Address<span class="text-danger">*</span></label>
                            <input type="text" name="company_address" id="company_address" value="<?= (isset($loans['company_address'])) ? $loans['company_address'] : '' ; ?>" class="form-control" >
                        </div> 
                        <div class="col-md-3 mb-3">
                            <label for="company_address" class="form-label">Net Salary<span class="text-danger">*</span></label>
                            <input type="text" name="company_address" id="net_salary" value="<?= (isset($loans['net_salary'])) ? $loans['net_salary'] : '' ; ?>" class="form-control" >
                        </div> 
                        <div class="col-md-3 mb-3">
                            <label for="salary_transfer_mode" class="form-label">Salary Transfer Mode<span class="text-danger">*</span></label>
                            <input type="text" name="salary_transfer_mode" id="salary_transfer_mode" value="<?= (isset($loans['salary_transfer_mode'])) ? $loans['salary_transfer_mode'] : '' ; ?>" class="form-control" >
                        </div> 
                        <div class="col-md-3 mb-3">
                            <label for="job_period" class="form-label">Job Period (Current Company) <span class="text-danger">*</span></label>
                            <input type="text" name="job_period" id="job_period" value="<?= (isset($loans['job_period'])) ? $loans['job_period'] : '' ; ?>" class="form-control" >
                        </div> 
                        <div class="col-md-3 mb-3">
                            <label for="job_experience" class="form-label">Total Job Experience<span class="text-danger">*</span></label>
                            <input type="text" name="job_experience" id="job_experience" value="<?= (isset($loans['salary_transfer_mode'])) ? $loans['salary_transfer_mode'] : '' ; ?>" class="form-control" >
                        </div> 
                        <div class="col-md-3 mb-3">
                            <label for="ofc_email" class="form-label">Office Email ID<span class="text-danger">*</span></label>
                            <input type="text" name="ofc_email" id="ofc_email" value="<?= (isset($loans['ofc_email'])) ? $loans['ofc_email'] : '' ; ?>" class="form-control" >
                        </div> 
                        <div class="col-md-3 mb-3">
                            <label for="ofc_number" class="form-label">Office Number<span class="text-danger">*</span></label>
                            <input type="text" name="ofc_number" id="ofc_number" value="<?= (isset($loans['ofc_number'])) ? $loans['ofc_number'] : '' ; ?> " class="form-control" >
                        </div> 

                        <div class="col-md-3 mb-3">
                            <label for="no_of_dependent" class="form-label">No of Dependent<span class="text-danger">*</span></label>
                            <input type="text" name="no_of_dependent" value="<?= (isset($loans['no_of_dependent'])) ? $loans['no_of_dependent'] : '' ; ?>" id="no_of_dependent" class="form-control" >
                        </div> 
                        <div class="col-md-3 mb-3">
                            <label for="cc_outstanding_amount" class="form-label">Credit Card Outstanding Amount<span class="text-danger">*</span></label>
                            <input type="text" name="cc_outstanding_amount" value="<?= (isset($loans['cc_outstanding_amount'])) ? $loans['cc_outstanding_amount'] : '' ; ?>" id="cc_outstanding_amount" class="form-control" >
                        </div> 
                        <div class="col-md-3 mb-3">
                            <label for="ofc_number" class="form-label">Remarks (If Any)<span class="text-danger">*</span></label>
                            <textarea name="remark" rows="2" readonly cols="20" class="form-control track-focus" type="text"  style="height: 56px; width: 296px;"><?= (isset($loans['remark'])) ? $loans['remark'] : '' ; ?></textarea>
                        </div> 

                          <div class="col-md-12 mb-12" style="background-color:#fed8b1;padding-top: 4px;margin-bottom: 12px;">
                            <label for="References" class="form-label" style="padding: 2px;">Any Running Loan ?</label>
                        </div>  
                            </div>


                             

                            <?php 
                                if (!empty($lead_list)) {
                                   foreach ($lead_list as $key => $lead) {
                            ?>
                            <div class="form-group row align-items-end customer_records" style="margin-bottom:0 !important;"> 
                                <div class="col-md-3 mb-3">
                                    <label for="Loan_Type" class="form-label">Loan Type <span class="text-danger">*</span></label>
                                     <input type="text" name="loan_type[]" value="<?= $lead['loan_type']?>" id="loan_type" class="form-control" >
                                </div> 
                         <!-- <div class="form-group row align-items-end customer_records" style="margin-bottom:0 !important;"> 
                                <div class="col-md-3 mb-3">
                                    <label for="Loan_Type" class="form-label">Loan Type <span class="text-danger">*</span></label>
                                    <select name="loan_type[]" id="loan_type"  class="form-control">
                                        <?php if (!empty($banker)) {
                                                foreach ($banker as $key => $banks) { ?>
                                                <option <?php if ($banks->id == $lead['loan_type']) {echo 'selected';}?>   value="<?= $banks->id?>"><?= $banks->loan_name?></option> 
                                            <?php }}?>
                                        <select>
                                </div>  -->

                                <div class="col-md-2 mb-3">
                                    <label for="Loan_amount" class="form-label">Loan Amount <span class="text-danger">*</span></label>
                                    <input type="text" name="loan_amount[]" value="<?= $lead['loan_amount']?>" id="Loan_Amount" class="form-control" >
                                </div> 
                                
                                 <div class="col-md-2 mb-3">
                                    <label for="bank_name" class="form-label">Bank Name <span class="text-danger">*</span></label>
                                      <input type="text" name="bank_name[]" value="" id="bank_name" value ="<?= $lead['bank_name']?>" class="form-control" >

                                    <!-- <select name="bank_name[]" id="bank_name"  class="form-control">
                                        <?php 
                                        if (!empty($bank_data)) {
                                                foreach ($bank_data as $key => $bank) { ?>
                                                <option value="<?= $bank->id?>"><?= $bank->bank_name?></option> 
                                            <?php }}?>
                                        <select> -->
                                </div> 
                                <div class="col-md-2 mb-3">
                                    <label for="emi_amount" class="form-label">EMI Amount <span class="text-danger">*</span></label>
                                    <input type="text" name="emi_amount[]" value ="<?= $lead['emi_amount']?>" id="emi_mount" class="form-control">
                                </div> 
                                <div class="col-md-2 mb-3">
                                    <label for="paid" class="form-label">Paid EMI <span class="text-danger">*</span></label>
                                    <input type="text" name="paid_emi[]"  value ="<?= $lead['paid_emi']?>" id="paid" class="form-control">
                                </div> 
                                </div>
                        <?php }}else {?>
                           <div class="form-group row align-items-end customer_records" style="margin-bottom:0 !important;"> 
                                <div class="col-md-3 mb-3">
                                    <label for="Loan_Type" class="form-label">Loan Type <span class="text-danger">*</span></label>
                                    <select name="loan_type[]" id="loan_type"  class="form-control">
                                        <?php if (!empty($banker)) {
                                                foreach ($banker as $key => $banks) { ?>
                                                <option value="<?= $banks->id?>"><?= $banks->loan_name?></option> 
                                            <?php }}?>
                                        <select>
                                </div> 

                                <div class="col-md-2 mb-3">
                                    <label for="Loan_amount" class="form-label">Loan Amount <span class="text-danger">*</span></label>
                                    <input type="text" name="loan_amount[]" id="Loan_Amount" class="form-control" >
                                </div> 
                                <div class="col-md-2 mb-3">
                                    <label for="bank_name" class="form-label">Bank Name <span class="text-danger">*</span></label>
                                      <input type="text" name="bank_name[]" value="" id="bank_name" class="form-control" >

                                    <!-- <select name="bank_name[]" id="bank_name"  class="form-control">
                                        <?php if (!empty($bank_data)) {
                                                foreach ($bank_data as $key => $bank) { ?>
                                                <option value="<?= $bank->id?>"><?= $bank->bank_name?></option> 
                                            <?php }}?>
                                        <select> -->
                                </div> 
                                <div class="col-md-2 mb-3">
                                    <label for="emi_amount" class="form-label">EMI Amount <span class="text-danger">*</span></label>
                                    <input type="text" name="emi_amount[]" id="emi_mount" class="form-control">
                                </div> 
                                <div class="col-md-2 mb-3">
                                    <label for="paid" class="form-label">Paid EMI <span class="text-danger">*</span></label>
                                    <input type="text" name="paid_emi[]" id="paid" class="form-control">
                                </div> 
                            </div>
                            <?php }?>
                                                
                                        
                <div class="form-group row align-items-end"> 
                        <div class="col-md-12 mb-12" style="background-color:#fed8b1;padding-top: 4px;margin-bottom: 12px;">
                            <label for="References" class="form-label" style="padding: 2px;">References 1 <span class="text-danger">*</span></label>
                        </div>  
                        <div class="col-md-4 mb-4">
                            <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" name="ref_name1" value ="<?= (isset($loans['ref_name1'])) ? $loans['ref_name1'] : '' ; ?>" id="name" class="form-control">
                        </div> 
                        <div class="col-md-4 mb-4">
                            <label for="mobile" class="form-label">Mobile No. <span class="text-danger">*</span></label>
                            <input type="number" name="ref_mobile1"value ="<?= (isset($loans['ref_mobile1'])) ? $loans['ref_mobile1'] : '' ; ?>" id="mobile" class="form-control">
                        </div> 
                        <div class="col-md-4 mb-4">
                            <label for="relation" class="form-label">Relation <span class="text-danger">*</span></label>
                            <input type="text" name="ref_relation1" value ="<?= (isset($loans['ref_relation1'])) ? $loans['ref_relation1'] : '' ; ?>" id="rname" class="form-control">
                        </div> 
                        <div class="col-md-12 mb-12" style="background-color:#fed8b1;padding-top: 4px;margin-bottom: 12px;">
                            <label for="References" class="form-label"  style="padding: 2px;">References 2 <span class="text-danger">*</span></label>
                        </div>  
                        <div class="col-md-4 mb-4">
                            <label for="rname" class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" name="ref_name2" value ="<?= (isset($loans['ref_name2'])) ? $loans['ref_name2'] : '' ; ?> " id="rname" class="form-control">
                        </div> 
                        <div class="col-md-4 mb-4">
                            <label for="mobile_no" class="form-label">Mobile No. <span class="text-danger">*</span></label>
                            <input type="number" name="ref_mobile2" value ="<?= (isset($loans['ref_mobile2'])) ? $loans['ref_mobile2'] : '' ; ?>" id="mobile_no" class="form-control">
                        </div> 
                        <div class="col-md-4 mb-4">
                            <label for="relation" class="form-label">Relation <span class="text-danger">*</span></label>
                            <input type="text" name="ref_relation2" value ="<?= (isset($loans['ref_relation2'])) ? $loans['ref_relation2'] : '' ; ?>" id="rname" class="form-control">
                        </div>

                        <div class="col-md-12 mb-3" style="background-color:#fed8b1;">
                            <label for="References" class="form-label"  style="padding: 2px;">Upload Documents  <span class="text-danger">*</span></label>
                        </div>  
                    </div>
                        <div class="form-group row customer_records_doc" style="margin-bottom:0 !important;">
                        <div class="col-md-3 mb-3">
                            <label for="attachment" class="form-label">Attachment Type <span class="text-danger">*</span></label>
                            <select name="attachment[]" id="attachment" class="form-control">
                                        <option value="">Select</option>
                                        <option value="pan_car">PAN CARD</option>
                                        <option value="aadhar">Aadhar Card</option>
                                        <option value="residence">Residence Proof</option>
                                        <option value="slip_1">Salary Slip 1</option>
                                        <option value="slip_2">Salary Slip 2</option>
                                        <option value="slip_3">Salary Slip 3</option>
                                        <option value="statement">Bank Statement</option>
                                        <option value="form">Form 16(if available)</option>
                                        <option value="loan_statement">Loan Statement(if Any)</option>
                                        <option value="loan_statement">Other Docs(if any)</option>
                                </select>
                        </div>  
                        <div class="col-md-3 mb-3">
                                <label for="login_which_bank" class="form-label">login which Bank <span class="text-danger">*</span></label>
                                <select name="login_which_bank" id="login_which_bank" class="form-control" >
                                    <?php 
                                        if (!empty($bank_data)) {
                                                foreach ($bank_data as $key => $bank) { ?>
                                                <option value="<?= $bank->id?>"><?= $bank->bank_name?></option> 
                                        <?php }}?>
                                </select>
                            </div>
                        <div class="col-md-3 mb-3">
                            <label for="mobile_no" class="form-label">File Upload <span class="text-danger">*</span></label>
                            <input type="file" name="image[]" id="image" class="form-control">
                        </div> 
                        <div class="col-md-3 mb-3">
                            <label for="password" class="form-label">Password(if any)</label>
                            <input type="text" name="password[]" id="password" class="form-control">
                        </div> 

                        <div class="col-md-12 mb-3">
                            <table class=" table-bordered text-center table-hover" id="dtBasicExample" style="width:90%;"> 
				        	
                            <thead class="text-white bg-primary">
                                <tr>
                                    <th class=''>Attachment Type </th>
                                    <th class=''>Attachment Password</th>
                                    <th class=''>Bank Name</th>
                                    <th class=''>View</th>
                                    <th class=''>Delete</th>	
                                </tr>
                            </thead>
                            <tbody id="leadBody">
                                <?php
                                if (!empty($document)) {
                                    foreach ($document as $key => $doc) {
                                          $bank_name = $this->db->where('id',$doc['login_which_bank'])->get('tbl_banks')->row_array();
                                    ?>

                                <tr>						
                                    <td class=''><?= $doc['attachment']?></td>	
                                    <td class=''><?= $doc['password']?></td>				
                                    <td class=''><?= $bank_name['bank_name'] ?? ''?></td>					
                                    <td class=''>
                                    <?php if (!empty($doc['image'])) {?>   
                                    <a href="<?= base_url()?><?= $doc['image']?>" target ="_blank">View</a></td><?php }?>
                                    <td class=''><a href="<?= base_url()?>admin/Dashboard/document_del/<?= $doc['id']?>"  onclick="return confirm('Are you sure ?')"><i class="fa fa-trash text-danger fa-lg" aria-hidden="true"></i></a></td>
                                </tr> 
                                <?php }} ?>
                            </tbody> 
                        </table>
                        </div>

            <?php 
                if ($this->session->userdata('role') == 1) {?>
                    <div class="col-md-12 mb-3" style="background-color:#fed8b1;">
                    <label for="References" class="form-label"  style="padding: 2px;">For Remarks And lead status</label>
                </div> 
                 <form action="<?= base_url('admin/Dashboard/remarks/')?><?= (isset($loans['id'])) ? $loans['id'] : '' ; ?> " method="post"> 
                    <div class="form-group row align-items-end" style="margin-bottom:0 !important;">
                        <div class="col-md-4 mb-3">
                             <label for="loan_status" class="form-label">Loan Status</label>
                              <select id="loan_status" class="form-control" name="loan_status">
                                  <option value="">Select type</option>
                                  <option  <?php if ($loans['loan_status'] == 'Apporved') {echo 'selected';}?> value="Apporved">Apporved</option>
                                  <option  <?php if ($loans['loan_status'] == 'Reject') {echo 'selected';}?> value="Reject">Reject</option>
                              </select>
                              <?php echo form_error('loan_status', '<span class="text-danger mt-1">', '</span>'); ?>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="rm_assign" class="form-label">Assign RM </label>
                            <input type="text" name="rm_assign" id="rm_assign" value='<?= (isset($loans['rm_assign'])) ? $loans['rm_assign'] : '' ; ?>' class="form-control">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="bank_for_admin" class="form-label">File login to Submit Bank</label>
                            <input type="text" name="bank_for_admin" id="bank_for_admin" value="<?= (isset($loans['bank_for_admin'])) ? $loans['bank_for_admin'] : '' ; ?> " class="form-control">
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="lead_feedback" class="form-label">Lead Feedback</label>
                                <textarea name="lead_feedback" rows="2" cols="20" class="form-control track-focus" type="text"  style="height: 56px;"><?= (isset($loans['lead_feedback'])) ? $loans['lead_feedback'] : '' ; ?></textarea>
                        </div> 

                        <div class="col-md-4 mb-3">
                            <label for="remarks" class="form-label">Remarks</label>
                            <textarea name="admin_remark" rows="2" cols="20" class="form-control track-focus" type="text"  style="height: 56px;"><?= (isset($loans['admin_remark'])) ? $loans['admin_remark'] : '' ; ?></textarea>
                        </div>

                            <div class="col-md-3 mb-3">
                            <button type="submit" class="btn btn-primary">Send</button>
                            </div>
                        </div>
                    </form>
                    <?php }?>

                    </div>
                    </div>
                  
                   
                </div>
            </div>
        </div>
    <!-- </form> -->
</div>
<script>
      $(document).ready(function() {
            var id  = $('#state').val();
            var city  = $('#city').val();
            $.ajax({
                type: 'POST',
                data: {id:id,city:city},
                url: '<?php echo site_url('admin/Dashboard/getCity'); ?>',
                success: function(res) {
                $('#city').html(res);
                }
            });
        });
       $(document).on('change','#state',function(){
        var id  = $(this).val();
        var city  = $('#city').val();
         $.ajax({
            type: 'POST',
            data: {id:id,city:city},
            url: '<?php echo site_url('admin/Dashboard/getCity'); ?>',
            success: function(res) {
               $('#city').html(res);
            }
        });
    })


function copylinks() {
  var copyText = document.getElementById("myInput");
  copyText.select();
  copyText.setSelectionRange(0, 99999); 
  navigator.clipboard.writeText(copyText.value);
  alert(copyText.value);
}
</script>
