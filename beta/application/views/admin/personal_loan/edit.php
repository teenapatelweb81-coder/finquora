<style>
td, th {
    padding: 6px 10px;
}
.extra-fields-customer ,.extra-fields-customerss{
    background: green;
    padding: 6px 12px;
    border-radius: 12px;
    font-size: 14px;
    color:#fff;
}
a.extra-fields-customerss:hover ,a.extra-fields-customerss:focus {
    color: #fff;
}
.btn-remove-customer i ,.btn-remove-customers i{
    background: red;
    padding: 12px 13px;
    border-radius: 29px;
    font-size: 12px;
}
.remove ,.removess{
    align-items:center;
}
</style>

<div class="container-fluid p-0">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin-dashboard");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Add Lead</li> 
           </ol>
         </nav>
</div>
<div class="container-fluid">
    <!-- <form action="<?php //base_url('admin/banker-create')?>" method="post"> -->
        <div class="row">
            <div class="col-md-12 px-0 form-main">
                <div class="card  form-card">
                    <div id="success_message"></div>
                    <span class="text-center text-info mb-2" id="susid"></span>  <?php //echo $this->session->flashdata('success');?>
                    <span class="text-center text-white bg-danger mb-2" id="errid"> </span> <?php // echo $this->session->flashdata('error');?>
                    <?php echo form_open_multipart('admin/Dashboard/home_lead_update');?>
                    <?php //echo '<pre>';print_r($loans);die;?>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                             <label for="loan_amount_req" class="form-label">Loan Requirement Amount <span class="text-danger">*</span></label>
                             <input required type="text" name="loan_amount_req" id="loan_amount_req" class="form-control" value="<?= $loans['loan_amount_req']?>" >
                             <input  type="hidden" name="id" class="form-control" value="<?= $loans['id']?>">
                         </div> 
                         <div class="col-md-3 mb-3">
                         <label for="client_name" class="form-label">Client Name <span class="text-danger">*</span></label>
                             <input required type="text" name="client_name" id="client_name" class="form-control" value="<?= $loans['client_name']?>" >
                         
                         </div>
                         <div class="col-md-3 mb-3">
                             <label for="mobile" class="form-label">Mobile No. <span class="text-danger">*</span></label>
                             <input required type="number" name="clientnumber" id="mobile" class="form-control"  value="<?= $loans['clientnumber']?>" >
                         </div> 
                         <div class="col-md-3 mb-3">
                             <label for="email" class="form-label">Email Id <span class="text-danger">*</span></label>
                             <input required type="email" name="email" id="email" class="form-control"  value="<?= $loans['email']?>">
                         </div>
                        <?php // print_r($loans);die;?> 
                         <div class="col-md-3 mb-3">
                             <label for="employment" class="form-label">Employment <span class="text-danger">*</span></label>
                                 <select name="employment" id="employment" class="form-control" required>
                                 <option value="">Select</option>
                                 <option <?php if($loans['employment'] == 'salaried'){echo 'selected';}?> value="salaried">Salaried</option>
                                 <option <?php if($loans['employment'] == 'self_employed'){echo 'selected';}?> value="self_employed">Self Employed</option>
                             </select>
                              <span class="text-red employment_status-error"></span>
                         </div> 
                         <div class="col-md-3 mb-3">
                            <label for="company_name" class="form-label">Company Name<span class="text-danger">*</span></label>
                            <input required type="text" name="company_name" id="company_name" value="<?= $loans['company_name']?>" class="form-control" >
                        </div> 
                        <div class="col-md-3 mb-3">
                            <label for="company_address" class="form-label">Net Salary<span class="text-danger">*</span></label>
                            <input required type="text" name="net_salary" id="net_salary" value="<?= $loans['net_salary']?>" class="form-control" >
                        </div> 
                        <div class="col-md-3 mb-3" id="self-employed-fields1">
                             <label for="annual_ternover" class="form-label ">Annual Turnover<span class="text-danger">*</span></label>
                                 <select name="annual_ternover" id="annual_ternover" class="form-control" required>
                                 <option value="">Select</option>
                                 <option <?php if($loans['annual_turnover'] == '20_lacs'){echo 'selected';}?> value="20_lacs">20 Lacs</option>
                                 <option <?php if($loans['annual_turnover'] == '50_lacs'){echo 'selected';}?> value="50_lacs">50 Lacs</option>
                                 <option <?php if($loans['annual_turnover'] == '80_lacs'){echo 'selected';}?> value="80_lacs">80 Lacs</option>
                                 <option <?php if($loans['annual_turnover'] == '1_crore'){echo 'selected';}?> value="1_crore">1 Crore+</option>
                             </select>
                              <span class="text-red annual_ternover-error"></span>
                         </div>
                         <div class="col-md-3 mb-3" id="self-employed-fields2">
                             <label for="business_age" class="form-label">Business Age<span class="text-danger">*</span></label>
                                 <select name="business_age" id="business_age" class="form-control" required>
                                 <option value="">Select</option>
                                 <option <?php if($loans['business_age'] == '6_month'){echo 'selected';}?> value="6_month">6 Month</option>
                                 <option <?php if($loans['business_age'] == '1_year'){echo 'selected';}?> value="1_year">1 year</option>
                                 <option <?php if($loans['business_age'] == '2_year'){echo 'selected';}?> value="2_year">2 year</option>
                                 <option <?php if($loans['business_age'] == '3_year+'){echo 'selected';}?> value="3_year+">3 year+</option>
                             </select>
                              <span class="text-red business_age-error"></span>
                         </div>
                         <div class="col-md-3 mb-3" id="self-employed-fields3" >
                             <label for="business_type" class="form-label">Business Type<span class="text-danger">*</span></label>
                                 <select name="business_type" id="business_type" class="form-control" required>
                                 <option value="">Select</option>
                                 <option <?php if($loans['business_type'] == 'proprietorship'){echo 'selected';}?> value="proprietorship">Proprietorship</option>
                                 <option <?php if($loans['business_type'] == 'Partnership'){echo 'selected';}?> value="Partnership">Partnership</option>
                                 <option <?php if($loans['business_type'] == 'private_Limited'){echo 'selected';}?> value="private_Limited">Private Limited</option>
                             </select>
                              <span class="text-red business_type-error"></span>
                         </div>
                        <div class="col-md-3 mb-3">
                             <label for="state" class="form-label">State Name <span class="text-danger">*</span></label>
                             <select name="state_name" id="state"  class="form-control" required>
                                    <option value="Select">Select</option>
                                    <?php if (!empty($states)) {
                                        foreach ($states as $key => $state) { ?>
                                           <option <?php if($state->id == $loans['state']){echo 'selected';}?> value="<?= $state->id?>"><?= $state->name?></option> 
                                    <?php }}?>
                                </select>
                        </div> 
                        <div class="col-md-3 mb-3">
                            <label for="city" class="form-label">City Name <span class="text-danger">*</span></label>
                            <select name="city" id="city" class="form-control" required>
                                    
                             </select>
                        </div> 
                        <div class="col-md-3 mb-3">
                            <label for="pin_code" class="form-label">Pin Code<span class="text-danger">*</span></label>
                            <input required type="text" name="pin_code" id="pin_code" value="<?= $loans['pin_code']?>" class="form-control" >
                        </div> 
                        <div class="col-md-3 mb-3">
                             <label for="property_type" class="form-label">Property Type <span class="text-danger">*</span></label>
                                 <select name="" id="property_type" class="form-control" required>
                                 <option value="">Select</option>
                                 <option <?php if($loans['property_type'] == 'sale_deed'){echo 'selected';}?>  value="sale_deed">Sale Deed</option>
                                 <option <?php if($loans['property_type'] == 'bba'){echo 'selected';}?> value="bba">BBA</option>
                                 <option <?php if($loans['property_type'] == 'gpa'){echo 'selected';}?> value="gpa">GPA</option>
                                 <option <?php if($loans['property_type'] == 'gpa_registered'){echo 'selected';}?> value="gpa_registered">GPA Registered</option>
                                 <option <?php if($loans['property_type'] == 'govt_approved_property'){echo 'selected';}?> value="govt_approved_property">Govt Approved Property</option>
                                 <option <?php if($loans['property_type'] == 'regularised_colony_property'){echo 'selected';}?> value="regularised_colony_property">Regularised Colony Property</option>
                                 <option <?php if($loans['property_type'] == 'khasra_khatauni_property'){echo 'selected';}?> value="khasra_khatauni_property">Khasra Khatauni Property</option>
                                 <option <?php if($loans['property_type'] == 'village_property'){echo 'selected';}?> value="village_property">Village Property</option>
                                 <option <?php if($loans['property_type'] == 'builder_floor_property'){echo 'selected';}?> value="builder_floor_property">Builder Floor Property</option>
                                 <option <?php if($loans['property_type'] == 'commercial_property'){echo 'selected';}?> value="commercial_property">Commercial Property</option>
                                 <option <?php if($loans['property_type'] == 'residential_property'){echo 'selected';}?> value="residential_property">Residential Property</option>
                                 <option <?php if($loans['property_type'] == 'industrial_property'){echo 'selected';}?> value="industrial_property">Industrial Property</option>
                                 <option <?php if($loans['property_type'] == 'school_property'){echo 'selected';}?> value="school_property">School Property</option>
                                 <option <?php if($loans['property_type'] == 'hospital_property'){echo 'selected';}?> value="hospital_property">Hospital property</option>
                                 <option <?php if($loans['property_type'] == 'hotel_property'){echo 'selected';}?> value="hotel_property">Hotel Property</option>
                                 <option <?php if($loans['property_type'] == 'farmer_field_property'){echo 'selected';}?> value="farmer_field_property">Farmer Field Property</option>
                             </select>
                              <span class="text-red property_type-error"></span>
                         </div>
                         <div class="col-md-3 mb-3">
                             <label for="property_market_value" class="form-label">Property Market Value <span class="text-danger">*</span></label>
                             <input required type="text" name="property_market_value" id="property_market_value" value="<?= $loans['property_market_value']?>" class="form-control">
                              <span class="text-red property_market_value-error"></span>
                         </div> 
                         <div class="col-md-3 mb-3">
                             <label for="remark" class="form-label">Remarks (If Any)</label>
                             <textarea name="remark" rows="2" cols="20" value="<?= $loans['remark']?>" tabindex="12" class="form-control track-focus"></textarea>
                         </div> 
                         <div class="col-md-3 mb-3">
                             <label for="marital_Status" class="form-label">Marital Status <span class="text-danger">*</span></label>
                                <select name="marital_status" id="marital_Status" class="form-control" required> 
                                    <option value="">Select</option>
                                    <option <?php if($loans['marital_status'] == 'Married'){echo 'selected';}?> value="Married">Married</option>
                                    <option <?php if($loans['marital_status'] == 'unmarried'){echo 'selected';}?> value="unmarried">unmarried</option>
                                </select>
                        </div> 
                        <div class="col-md-3 mb-3">
                            <label for="spouse_house" class="form-label">Spouse House<span class="text-danger">*</span></label>
                            <input required type="text" name="spouse_house" id="spouse_house" value="<?= $loans['spouse_house']?>" class="form-control" >
                        </div> 
                        <div class="col-md-3 mb-3">
                            <label for="mother_name" class="form-label">Mother Name<span class="text-danger">*</span></label>
                            <input required type="text" name="mother_name" id="mother_name" value="<?= $loans['mother_name']?>" class="form-control" >
                        </div> 
                        <div class="col-md-3 mb-3">
                                    <label for="residence_Type" class="form-label">Residence Type <span class="text-danger">*</span></label>
                                        <select name="residence_type" id="residence_Type" class="form-control">
                                            <option value="">Select</option>
                                            <option <?php if($loans['residence_type'] == 'owned'){echo 'selected';}?> value="owned">Owned</option>
                                            <option <?php if($loans['residence_type'] == 'rented'){echo 'selected';}?> value="rented">Rented</option>
                                            <option <?php if($loans['residence_type'] == 'parental'){echo 'selected';}?> value="parental">Parental</option>
                                            <option <?php if($loans['residence_type'] == 'company_accomodation'){echo 'selected';}?> value="company_accomodation">Company Accomodation</option>
                                        </select>
                                        <span class="text-red residence_Type-error"></span>
                        </div> 
                        <div class="col-md-3 mb-3">
                            <label for="residential_address" class="form-label">Residential Address <span class="text-danger">*</span></label>
                            <input required type="text" name="residential_address" id="residential_address" value="<?= $loans['residential_address']?>" class="form-control" >
                        </div> 
                        <div class="col-md-3 mb-3">
                            <label for="company_address" class="form-label">Company Address<span class="text-danger">*</span></label>
                            <input required type="text" name="company_address" id="company_address" value="<?= $loans['company_address']?>" class="form-control" >
                        </div> 
                        <div class="col-md-3 mb-3">
                            <label for="designation" class="form-label">Designation<span class="text-danger">*</span></label>
                            <input required type="text" name="designation" id="designation" value="<?= $loans['designation']?>" class="form-control" >
                        </div> 
                        <div class="col-md-3 mb-3">
                                    <label for="salary_transfer_mode" class="form-label">Salary Transfer Mode <span class="text-danger">*</span></label>
                                        <select name="salary_transfer_mode" id="salary_transfer_mode"  class="form-control">
                                            <option value="">Select</option>
                                            <option <?php if($loans['salary_transfer_mode'] == 'account'){echo 'selected';}?> value="account">Account Transfer</option>
                                            <option <?php if($loans['salary_transfer_mode'] == 'cheque'){echo 'selected';}?> value="cheque">Cheque</option>
                                            <option <?php if($loans['salary_transfer_mode'] == 'case'){echo 'selected';}?> value="case">Case</option>
                                        </select>
                                        <span class="text-red salary_transfer_mode-error"></span>
                        </div> 
                        <div class="col-md-3 mb-3">
                        <label for="job_peried_current_company" class="form-label">Job Period (Current Company) <span class="text-danger">*</span></label>
                                        <select name="job_peried_current_company" id="job_peried_current_company" class="form-control" required>
                                                <option value="">Select</option>
                                                <option <?php if($loans['job_period'] == 'month_6'){echo 'selected';}?> value="month_6">6 Month</option>
                                                <option <?php if($loans['job_period'] == 'year_1'){echo 'selected';}?> value="year_1">1 Year</option>
                                                <option <?php if($loans['job_period'] == 'year_2'){echo 'selected';}?> value="year_2">2 Year</option>
                                                <option <?php if($loans['job_period'] == 'year_3'){echo 'selected';}?> value="year_3">3 Year</option>
                                        </select>
                                        <span class="text-red job_peried_current_company-error"></span>
                        </div>
                        <div class="col-md-3 mb-3">
                        <label for="total_Job_Experience" class="form-label">Total Job Experience <span class="text-danger">*</span></label>
                                        <select name="job_experience" id="total_Job_Experience" class="form-control" required>
                                                <option value="">Select</option>
                                                <option <?php if($loans['job_experience'] == 'month_6'){echo 'selected';}?>value="month_6">6 Month</option>
                                                <option <?php if($loans['job_experience'] == 'year_1'){echo 'selected';}?>value="year_1">1 Year</option>
                                                <option <?php if($loans['job_experience'] == 'year_2'){echo 'selected';}?>value="year_2">2 Year</option>
                                                <option <?php if($loans['job_experience'] == 'year_3'){echo 'selected';}?>value="year_3">3 Year</option>
                                        </select>
                                        
                        <input required type="hidden" name="apply_for_loan" id="apply_for_loan" value="Home Loan" class="form-control" >
                                        <span class="text-red total_Job_Experience-error"></span>
                        </div>
                        <div class="col-md-3 mb-3">
                                    <label for="property_total_area" class="form-label">Property Total Area <span class="text-danger">*</span></label>
                                    <input required type="text" name="property_total_area"  value="<?= $loans['designation']?>" id="property_total_area" class="form-control">
                                    <span class="text-red property_total_area-error"></span>
                        </div> 
                        <div class="col-md-3 mb-3">
                                    <label for="property_address" class="form-label">Property Address <span class="text-danger">*</span></label>
                                    <input required type="text" name="property_address" value="<?= $loans['property_address']?>" id="property_address" class="form-control">
                                    <span class="text-red property_address-error"></span>
                        </div> 

                        <!-- <div class="col-md-3 mb-3">
                            <label for="alt_number" class="form-label">Other Contact Name<span class="text-danger">*</span></label>
                            <input required type="text" name="alt_number" id="alt_number" value="<?= $loans['mother_name']?>"  class="form-control" >
                        </div>  -->
                        <!-- <div class="col-md-3 mb-3">
                            <label for="qualification" class="form-label">Qualification<span class="text-danger">*</span></label>
                            <input required type="text" name="qualification" id="qualification" value="<?= $loans['qualification']?>" class="form-control" >
                        </div> 
                        <div class="col-md-3 mb-3">
                            <label for="residential_type" class="form-label">Residence Type<span class="text-danger">*</span></label>
                            <input required type="text" name="residential_type" id="residential_type" value="<?= $loans['residential_type']?>" class="form-control" >
                        </div> 
                        
                        <div class="col-md-3 mb-3">
                            <label for="residential_address_token" class="form-label">Residential Address Token Form<span class="text-danger">*</span></label>
                            <input required type="text" name="residential_address_token" id="residential_address_token" value="<?= $loans['residential_address_token']?>" class="form-control" >
                        </div> 
                        <div class="col-md-3 mb-3">
                            <label for="residence_stability" class="form-label">Residence Stability<span class="text-danger">*</span></label>
                            <input required type="text" name="residence_stability" id="residence_stability" value="<?= $loans['residence_stability']?>" class="form-control" >
                        </div>  -->
                        <!-- <?php
                        // echo'<pre>';
                        // print_r($lead_list);die;
                        ?> -->
                        
                        <div class="col-md-12 mb-12" style="background-color:#67c8ff;padding-top: 4px;margin-bottom: 12px;padding-left:5px;">
                            <label for="References" class="form-label" style="padding: 2px;">Running Loan </label>
                        </div> 

                        <?php 
                                if (!empty($lead_list)) {
                                   foreach ($lead_list as $key => $lead) {
                            ?>

                        <div class="form-group row align-items-end customer_records" style="margin-bottom:0 !important;"> 
                                <div class="col-md-3 mb-3">
                                    <label for="Loan_Type" class="form-label">Loan Type <span class="text-danger"></span></label>
                                    <input required type="text" name="loan_type" id="loan_type"  value="<?= $lead['loan_type']?>" class="form-control" >
                                </div> 
                                <?php if (!empty($banker)) {
                                                foreach ($banker as $key => $banks) { ?>
                                                <option <?php if ($banks->id == $lead['loan_type']) {echo 'selected';}?>   value="<?= $banks->id?>"><?= $banks->loan_name?></option> 
                                            <?php }}?>
                                <div class="col-md-2 mb-3">
                                    <label for="Loan_amount" class="form-label">Loan Amount <span class="text-danger"></span></label>
                                    <input required type="text" name="loan_amount[]" id="Loan_Amount" value="<?= $lead['loan_amount']?>" class="form-control" >
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label for="bank_name" class="form-label">Bank Name <span class="text-danger"></span></label>
                                        <input required type="text" name="bank_name" id="bank_name" value ="<?= $lead['bank_name']?>" class="form-control" >
                                </div> 

                               
                                <div class="col-md-2 mb-3">
                                        <label for="emi_amount" class="form-label">EMI Amount <span class="text-danger"></span></label>
                                        <input required type="text" name="emi_amount" id="emi_amount" value ="<?= $lead['emi_amount']?>" class="form-control" >
                                </div> 
                                <div class="col-md-2 mb-3">
                                        <label for="paid" class="form-label">Paid EMI <span class="text-danger"></span></label>
                                        <input required type="text" name="paid_emi" id="paid" value ="<?= $lead['paid_emi']?>" class="form-control" >
                                </div> 
                            </div>
                            <?php }}else {?>
                                <div class="form-group row align-items-end customer_records" style="margin-bottom:0 !important;"> 
                                <div class="col-md-3 mb-3">
                                    <label for="Loan_Type" class="form-label">Loan Type <span class="text-danger">*</span></label>
                                    <select name="loan_type[]" id="loan_type"  class="form-control" required>
                                        <?php if (!empty($banker)) {
                                                foreach ($banker as $key => $banks) { ?>
                                                <option value="<?= $banks->id?>"><?= $banks->loan_name?></option> 
                                            <?php }}?>
                                                </select>
                                </div> 

                                <div class="col-md-2 mb-3">
                                    <label for="Loan_amount" class="form-label">Loan Amount <span class="text-danger">*</span></label>
                                    <input required type="text" name="loan_amount[]" id="Loan_Amount" class="form-control" >
                                </div> 
                                <div class="col-md-2 mb-3">
                                    <label for="bank_name" class="form-label">Bank Name <span class="text-danger">*</span></label>
                                      <input required type="text" name="bank_name[]" value="" id="bank_name" class="form-control" >

                                    <!-- <select name="bank_name[]" id="bank_name"  class="form-control">
                                        <?php if (!empty($bank_data)) {
                                                foreach ($bank_data as $key => $bank) { ?>
                                                <option value="<?= $bank->id?>"><?= $bank->bank_name?></option> 
                                            <?php }}?>
                                        <select> -->
                                </div> 
                                <div class="col-md-2 mb-3">
                                    <label for="emi_amount" class="form-label">EMI Amount <span class="text-danger">*</span></label>
                                    <input required type="text" name="emi_amount[]" id="emi_mount" class="form-control">
                                </div> 
                                <div class="col-md-2 mb-3">
                                    <label for="paid" class="form-label">Paid EMI <span class="text-danger">*</span></label>
                                    <input required type="text" name="paid_emi[]" id="paid" class="form-control">
                                </div> 
                            </div>
                            <?php }?>
                            <div class="form-group row align-items-end" > 
                        <div class="col-md-12 mb-12" style="background-color:#fed8b1;padding-top: 4px;margin-bottom: 12px;">
                            <label for="References" class="form-label" style="padding: 2px;">References 1 </label>
                        </div>  
                        <div class="col-md-4 mb-4">
                            <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                            <input required type="text" name="ref_name1" value="<?= $loans['ref_name1']?>" id="name" class="form-control" >
                        </div> 
                        <div class="col-md-4 mb-4">
                            <label for="mobile" class="form-label">Mobile No. <span class="text-danger">*</span></label>
                            <input required type="number" name="ref_mobile1"value ="<?= $loans['ref_mobile1']?>" id="mobile" class="form-control">
                        </div> 
                        <div class="col-md-4 mb-4">
                            <label for="relation" class="form-label">Relation <span class="text-danger">*</span></label>
                            <input required type="text" name="ref_relation1" value="<?= $loans['ref_relation1']?>" id="rname" class="form-control" >
                        </div> 
                        <div class="col-md-12 mb-12" style="background-color:#fed8b1;padding-top: 4px;margin-bottom: 12px;">
                            <label for="References" class="form-label"  style="padding: 2px;">References 2 <span class="text-danger">*</span></label>
                        </div>  
                        <div class="col-md-4 mb-4">
                            <label for="rname" class="form-label">Name <span class="text-danger">*</span></label>
                            <input required type="text" name="ref_name2" value ="<?= $loans['ref_name2']?>" id="rname" class="form-control" >
                        </div> 
                        <div class="col-md-4 mb-4">
                            <label for="mobile_no" class="form-label">Mobile No. <span class="text-danger">*</span></label>
                            <input required type="number" name="ref_mobile2" value ="<?= $loans['ref_mobile2']?>" id="mobile_no" class="form-control" >
                        </div> 
                        <div class="col-md-4 mb-4">
                            <label for="relation" class="form-label">Relation <span class="text-danger">*</span></label>
                            <input required type="text" name="ref_relation2" value ="<?= $loans['ref_relation2']?>" id="rname" class="form-control" >
                        </div>

                        <div class="col-md-12 mb-12" style="background-color:#fed8b1;">
                            <label for="References" class="form-label" style="padding: 2px;">Upload Documents  <span class="text-danger">*</span></label>
                        </div>  
                    </div>

                     
                        <!-- <div class="col-md-3 mb-3">
                            <label for="salary_transfer_mode" class="form-label">Salary Transfer Mode<span class="text-danger">*</span></label>
                            <input required type="text" name="salary_transfer_mode" id="salary_transfer_mode" value="<?= $loans['salary_transfer_mode']?>" class="form-control" >
                        </div> 
                        <div class="col-md-3 mb-3">
                            <label for="job_period" class="form-label">Job Period (Current Company) <span class="text-danger">*</span></label>
                            <input required type="text" name="job_period" id="job_period" value="<?= $loans['job_period']?>" class="form-control" >
                        </div> 
                        <div class="col-md-3 mb-3">
                            <label for="job_experience" class="form-label">Total Job Experience<span class="text-danger">*</span></label>
                            <input required type="text" name="job_experience" id="job_experience" value="<?= $loans['salary_transfer_mode']?>" class="form-control" >
                        </div> 
                        <div class="col-md-3 mb-3">
                            <label for="ofc_email" class="form-label">Office Email ID<span class="text-danger">*</span></label>
                            <input required type="text" name="ofc_email" id="ofc_email" value="<?= $loans['ofc_email']?>" class="form-control" >
                        </div> 
                        <div class="col-md-3 mb-3">
                            <label for="ofc_number" class="form-label">Office Number<span class="text-danger">*</span></label>
                            <input required type="text" name="ofc_number" id="ofc_number" value="<?= $loans['ofc_number']?>" class="form-control" >
                        </div> 

                        <div class="col-md-3 mb-3">
                            <label for="no_of_dependent" class="form-label">No of Dependent<span class="text-danger">*</span></label>
                            <input required type="text" name="no_of_dependent" value="<?= $loans['no_of_dependent']?>" id="no_of_dependent" class="form-control" >
                        </div> 
                        <div class="col-md-3 mb-3">
                            <label for="cc_outstanding_amount" class="form-label">Credit Card Outstanding Amount<span class="text-danger">*</span></label>
                            <input required type="text" name="cc_outstanding_amount" value="<?= $loans['cc_outstanding_amount']?>" id="cc_outstanding_amount" class="form-control" >
                        </div> 
                    </div> -->

                
                     <div class="form-group row customer_records_doc" style="margin-bottom:0 !important;">
                        <div class="col-md-3 mb-3">
                            <label for="attachment" class="form-label">Attachment Type <span class="text-danger">*</span></label>
                            <select name="attachment[]" id="ctl00_ContentPlaceHolder1_ddl_job_time_in_current_company"  class="form-control">
                            <option value="">Select</option>
                                    <option value="PAN CARD">PAN CARD</option>
                                    <option value="Passport Size Photo">Passport Size Photo</option>
                                    <option value="Aadhar Card">Aadhar Card</option>
                                    <option value="Residence Proof">Residence Proof</option>
                                    <option value="Salary Slip 1">Salary Slip 1</option>
                                    <option value="Salary Slip 2">Salary Slip 2</option>
                                    <option value="Salary Slip 3">Salary Slip 3</option>
                                    <option value="Bank Statement">Bank Statement</option>
                                    <option value="Form 16(if available)">Form 16(if available)</option>
                                    <option value="Office ID Card">Office ID Card (If Available)</option>
                                    <option value="Loan Statement(if Any)">Loan Statement(if Any)</option>
                                    <option value="Other Docs(if any)">Other Docs(if any)</option>
                                    <option value="Property Papers">Property Papers</option>
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
                            <input  type="file" name="image[]" id="image" class="form-control">
                        </div> 
                        
                        <div class="col-md-3 mb-3">
                            <label for="password" class="form-label">Password(if any)</label>
                            <input  type="text" name="password[]" id="password" class="form-control">
                        </div> 
                </div>
                 <div class="customer_records_dynamicss"></div>
                  <div class="col-md-2 mb-3 text-left">
                            <label for="paid" class="form-label"> </label>
                           <a class="extra-fields-customerss" href="javascript:void(0)">Add More</i></a>
                        </div> 

                        <div class="col-md-12 pb-3 mb-3" style="border-bottom: 1px solid #0000004a;">
                            <table class=" table-bordered text-center table-hover" id="dtBasicExample" style="width:90%;"> 
                                        
                            <thead class="text-white bg-primary">
                                <tr>
                                    <th class=''>Attachment Type </th>
                                    <th class=''>Attachment Password</th>
                                    <th class=''>View</th>
                                    <th class=''>Delete</th>	
                                </tr>
                            </thead>
                            <tbody id="leadBody">
                                <?php
                                if (!empty($document)) {
                                    foreach ($document as $key => $doc) {
                                    ?>
                                <tr>						
                                    <td class=''><?= $doc['attachment']?></td>	
                                    <td class=''><?= $doc['password']?></td>				
                                    <td class=''>
                                        <?php if (!empty($doc['image'])) {?>
                                            <a href="<?= base_url()?><?= $doc['image']?>" target ="_blank">View</a>
                                        <?php }?>
                                </td>
                                    <td class=''><a href="<?= base_url()?>admin/Dashboard/document_del/<?= $doc['id']?>"  onclick="return confirm('Are you sure ?')"><i class="fa fa-trash text-danger fa-lg" aria-hidden="true"></i></a></td>
                                </tr> 
                                <?php }} ?>
                            </tbody> 
                        </table>
                    </div>

                     <div class="form-group row align-items-center">
                            <div class="col-md-12 mb-3 text-right">
                            <button  type="submit" class="btn btn-primary" style="background-color:#325f9a;">Send</button>
                            </div>
                        </div>

                    </div>
                    </div>
                  
                   
                </div>
            </div>
        </div> 
        <?php echo form_close();?>
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
                 $('#city').trigger('change');
            }
        });
    })

    $('.extra-fields-customerss').click(function() {
                $('.customer_records_doc').clone().appendTo('.customer_records_dynamicss');
                $('.customer_records_dynamicss .customer_records_doc').addClass('singless removess');
                $('.singless .extra-fields-customerss').remove();
                $('.singless').append('<div class="col-md-1 pt-3 text-center remove-fieldss btn-remove-customers"><i class="fa fa-minus text-light fa-lg" aria-hidden="true"></i></div>');
                $('.customer_records_dynamicss > .singless').attr("class", "removess row");
        });

        $(document).on('click', '.remove-fieldss', function(e) {
        $(this).parent('.removess').remove();
        e.preventDefault();
        }); 
    </script>
