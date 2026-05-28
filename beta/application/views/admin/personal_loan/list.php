<style>
.extra-fields-customer ,.extra-fields-customerss{
    background: green;
    padding: 6px 12px;
    border-radius: 12px;
    font-size: 14px;
    color:#fff;
}
a.extra-fields-customer:hover ,a.extra-fields-customer:focus {
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
.bs-stepper-circle {
    width: 5em !important;
    height: 5em !important;
    padding: 30px !important;
    border-radius: 3em !important;
    font-weight: 500!important;
    font-size: 15px!important;
}
    </style>
    
  <link rel="stylesheet" href="<?= base_url('upload/admin/')?>plugins/bs-stepper/css/bs-stepper.min.css">





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
        <div class="col-lg-12">

<!-- card start -->
<div class="card">

  <div class="card-header bg-white border-0">
    <div class="row align-items-center">
        <div class="col-8">
            <h3 class="mb-0" style="font-size: 23px;">Add New Lead</h3>
        </div>
        <div class="col-4 text-right">
            <?php if (domain_id_get() == '3') { ?>
            <a class="btn btn-primary" target="_blank" href="<?= base_url('upload/assets/loandocumnet.pdf')?>">Document List</i></a> 
        <?php } ?>
        </div>
        <div class="col-12">
            <?php if ($this->session->flashdata('success')) { ?>
                <div class="alert alert-success">
            <?php echo $this->session->flashdata('success') ?>
                </div>
            <?php } ?>
       </div>
    </div>
  </div>

<div class="row">
          <div class="col-md-12">
            <div class="card card-default">
              <div class="card-header">
                <!-- <h3 class="card-title">bs-stepper</h3> -->
              </div>
              <div class="card-body p-0">
                <div class="bs-stepper">
                  <div class="bs-stepper-header" role="tablist">
                    <!-- your steps here -->
                    <div class="step" data-target="#logins-part">
                      <button type="button" class="step-trigger" role="tab" aria-controls="logins-part" id="logins-part-trigger">
                        <span class="bs-stepper-circle">1 Login</span>
                        <!-- <span class="bs-stepper-label">Logins</span> -->
                      </button>
                    </div>
                    <div class="line"></div>
                    <div class="step" data-target="#information-part1">
                      <button type="button" class="step-trigger" role="tab" aria-controls="information-part1" id="information-part-trigger">
                        <span class="bs-stepper-circle">2 Step</span>
                        <!-- <span class="bs-stepper-label">Various information</span> -->
                      </button>
                    </div>
                    <div class="line"></div>
                    <div class="step" data-target="#information-part">
                      <button type="button" class="step-trigger" role="tab" aria-controls="information-part" id="information-part-trigger">
                        <span class="bs-stepper-circle">Last Step</span>
                        <!-- <span class="bs-stepper-label">Various information</span> -->
                      </button>
                    </div>
                  </div>
                  <div class="bs-stepper-content">
                  <!--  //base_url('admin/Dashboard/loan_lead_add')?> action method -->
                <form class="form-horizontal" action="<?php echo base_url('admin/home-insert')?>" method="post" enctype="multipart/form-data">
                    <!-- your steps content here -->
                    <div id="logins-part" class="content" role="tabpanel" aria-labelledby="logins-part-trigger">
                          <div class="form-group row">
                        <div class="col-md-12">
                <div class="row">
                    <div class="col-md-3 mb-3">
                             <label for="loan_amount_req" class="form-label">Loan Requirement Amount <span class="text-danger">*</span></label>
                             <input type="number" name="loan_amount_req" id="loan_amount_req" class="form-control">
                             <span class="text-red loan_amount_req-error"></span>
                         </div> 
                         <div class="col-md-3 mb-3">
                         <label for="client_name" class="form-label">Client Name <span class="text-danger">*</span></label>
                             <input type="text" name="client_name" id="client_name" class="form-control">
                             <span class="text-red client_name-error"></span>
                         </div>
                         <div class="col-md-3 mb-3">
                             <label for="mobile" class="form-label">Mobile No. <span class="text-danger">*</span></label>
                             <input type="number" name="clientnumber" id="clientnumber" class="form-control">
                              <span class="text-red clientnumber-error"></span>
                         </div> 
                         <div class="col-md-3 mb-3">
                             <label for="email" class="form-label">Email Id <span class="text-danger">*</span></label>
                             <input type="email" name="email" id="email" class="form-control">
                              <span class="text-red email-error"></span>
                         </div> 
                         <div class="col-md-3 mb-3">
                             <label for="employment" class="form-label">Employment <span class="text-danger">*</span></label>
                                 <select name="employment" id="employment" class="form-control" >
                                 <option value="salaried">Salaried</option>
                                 <option value="self_employed">Self Employed</option>
                             </select>
                              <span class="text-red employment_status-error"></span>
                         </div> 
                         <div class="col-md-3 mb-3">
                             <label for="company_name" class="form-label">Company Name <span class="text-danger">*</span></label>
                             <input type="text" name="company_name" id="company_name" class="form-control">
                              <span class="text-red company_name-error"></span>
                         </div> 
                         <div class="col-md-3 mb-3" id="self-employed-fields1" style="display:none;">
                             <label for="annual_ternover" class="form-label ">Annual Turnover<span class="text-danger">*</span></label>
                                 <select name="annual_ternover" id="annual_ternover" class="form-control" >
                                 <option value="">Select</option>
                                 <option value="20_lacs">20 Lacs</option>
                                 <option value="50_lacs">50 Lacs</option>
                                 <option value="80_lacs">80 Lacs</option>
                                 <option value="1_crore">1 Crore+</option>
                             </select>
                              <span class="text-red annual_ternover-error"></span>
                         </div>
                         <div class="col-md-3 mb-3" id="self-employed-fields2"  style="display:none;">
                             <label for="business_age" class="form-label">Business Age<span class="text-danger">*</span></label>
                                 <select name="business_age" id="business_age" class="form-control" >
                                 <option value="">Select</option>
                                 <option value="6_month">6 Month</option>
                                 <option value="1_year">1 year</option>
                                 <option value="2_year">2 year</option>
                                 <option value="3_year+">3 year+</option>
                             </select>
                              <span class="text-red business_age-error"></span>
                         </div>
                         <div class="col-md-3 mb-3" id="self-employed-fields3"  style="display:none;">
                             <label for="business_type" class="form-label">Business Type<span class="text-danger">*</span></label>
                                 <select name="business_type" id="business_type" class="form-control" >
                                 <option value="">Select</option>
                                 <option value="proprietorship">Proprietorship</option>
                                 <option value="Partnership">Partnership</option>
                                 <option value="private_Limited">Private Limited</option>
                             </select>
                              <span class="text-red business_type-error"></span>
                         </div>

                         <div class="col-md-3 mb-3 net_salary1" >
                             <label for="net_salary" class="form-label">Net Salary <span class="text-danger">*</span></label>
                             <input type="text" name="net_salary" id="net_salary" class="form-control">
                              <span class="text-red net_salary-error"></span>
                         </div> 
                         <div class="col-md-3 mb-3">
                             <label for="state" class="form-label">State Name <span class="text-danger">*</span></label>
                             <select name="state_name" id="state"  class="form-control">
                                    <option value="">Select</option>
                                    <?php if (!empty($states)) {
                                        foreach ($states as $key => $state) { ?>
                                           <option value="<?= $state->id?>"><?= $state->name?></option> 
                                    <?php }}?>
                                </select>
                              <span class="text-red state-error"></span>
                         </div>    
                         <div class="col-md-3 mb-3">
                             <label for="city" class="form-label">City Name <span class="text-danger">*</span></label>
                             <select name="city" id="city" class="form-control">
                                <option value="">Select</option>
                             </select>
                              <span class="text-red city-error"></span>
                         </div> 
                         <div class="col-md-3 mb-3">
                             <label for="pin_code" class="form-label">Pin code <span class="text-danger">*</span></label>
                             <input type="text" name="pin_code" id="pin_code" class="form-control">
                              <span class="text-red pin_code-error"></span>
                         </div> 
                         <div class="col-md-3 mb-3">
                             <label for="property_type" class="form-label">Property Type <span class="text-danger">*</span></label>
                                 <select name="property_type" id="property_type" class="form-control" >
                                 <option value="">Select</option>
                                 <option value="sale_deed">Sale Deed</option>
                                 <option value="bba">BBA</option>
                                 <option value="gpa">GPA</option>
                                 <option value="gpa_registered">GPA Registered</option>
                                 <option value="govt_approved_property">Govt Approved Property</option>
                                 <option value="regularised_colony_property">Regularised Colony Property</option>
                                 <option value="khasra_khatauni_property">Khasra Khatauni Property</option>
                                 <option value="village_property">Village Property</option>
                                 <option value="builder_floor_property">Builder Floor Property</option>
                                 <option value="commercial_property">Commercial Property</option>
                                 <option value="residential_property">Residential Property</option>
                                 <option value="industrial_property">Industrial Property</option>
                                 <option value="school_property">School Property</option>
                                 <option value="hospital_property">Hospital property</option>
                                 <option value="hotel_property">Hotel Property</option>
                                 <option value="farmer_field_property">Farmer Field Property</option>
                             </select>
                              <span class="text-red property_type-error"></span>
                         </div>
                         <div class="col-md-3 mb-3">
                             <label for="property_market_value" class="form-label">Property Market Value <span class="text-danger">*</span></label>
                             <input type="text" name="property_market_value" id="property_market_value" class="form-control">
                              <span class="text-red property_market_value-error"></span>
                         </div> 
                         <div class="col-md-3 mb-3">
                             <label for="remark" class="form-label">Remarks (If Any)</label>
                             <textarea name="remark" rows="2" cols="20"  tabindex="12" class="form-control track-focus"></textarea>
                         </div> 
                    </div>  
                </div>
            </div>
                        <a href="javascript:void(0)" class="btn btn-primary"  id="first_form">Next</a>
                         </div>

        <div id="information-part1" class="content" role="tabpanel" aria-labelledby="information-part1-trigger">
                <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="marital_Status" class="form-label">Marital Status <span class="text-danger">*</span></label>
                            <select name="marital_status" id="marital_Status" class="form-control">
                                <option value="">Select</option>
                                <option value="Married">Married</option>
                                <option value="unmarried">unmarried</option>
                            </select>
                            <span class="text-red marital_Status-error"></span>
                        </div> 
                        <div class="col-md-3 mb-3">
                                    <label for="spouse_house" class="form-label">Spouse House <span class="text-danger">*</span></label>
                                    <input type="text" name="spouse_house" id="spouse_house" class="form-control">
                                    <span class="text-red spouse_house-error"></span>
                        </div> 
                        <div class="col-md-3 mb-3">
                                    <label for="mother_name" class="form-label">Mother Name <span class="text-danger">*</span></label>
                                    <input type="text" name="mother_name" id="mother_name" class="form-control">
                                    <span class="text-red mother_name-error"></span>
                        </div> 
                        <div class="col-md-3 mb-3">
                                    <label for="residence_Type" class="form-label">Residence Type <span class="text-danger">*</span></label>
                                        <select name="residence_type" id="residence_Type" class="form-control">
                                            <option value="">Select</option>
                                            <option value="owned">Owned</option>
                                            <option value="rented">Rented</option>
                                            <option value="parental">Parental</option>
                                            <option value="company_accomodation">Company Accomodation</option>
                                        </select>
                                        <span class="text-red residence_Type-error"></span>
                        </div> 
                        <div class="col-md-3 mb-3">
                                    <label for="residential_address" class="form-label">Residential Address <span class="text-danger">*</span></label>
                                    <input type="text" name="residential_address" id="residential_address" class="form-control">
                                    <span class="text-red residential_address-error"></span>
                        </div> 
                        <div class="col-md-3 mb-3">
                                    <label for="company_address" class="form-label">Company Address <span class="text-danger">*</span></label>
                                    <input type="text" name="company_address" id="company_address" class="form-control">
                                    <span class="text-red company_address-error"></span>
                        </div> 
                        <div class="col-md-3 mb-3">
                                    <label for="designation" class="form-label">Designation <span class="text-danger">*</span></label>
                                    <input type="text" name="designation" id="designation" class="form-control">
                                    <span class="text-red designation-error"></span>
                        </div> 
                        <div class="col-md-3 mb-3">
                                    <label for="salary_transfer_mode" class="form-label">Salary Transfer Mode <span class="text-danger">*</span></label>
                                        <select name="salary_transfer_mode" id="salary_transfer_mode"  class="form-control">
                                            <option value="">Select</option>
                                            <option value="account">Account Transfer</option>
                                            <option value="cheque">Cheque</option>
                                            <option value="case">Case</option>
                                        </select>
                                        <span class="text-red salary_transfer_mode-error"></span>
                        </div> 
                        <div class="col-md-3 mb-3">
                        <label for="job_peried_current_company" class="form-label">Job Period (Current Company) <span class="text-danger">*</span></label>
                                        <select name="job_peried_current_company" id="job_peried_current_company" class="form-control">
                                                <option value="">Select</option>
                                                <option value="month_6">6 Month</option>
                                                <option value="year_1">1 Year</option>
                                                <option value="year_2">2 Year</option>
                                                <option value="year_3">3 Year</option>
                                        </select>
                                        <span class="text-red job_peried_current_company-error"></span>
                        </div>
                        <div class="col-md-3 mb-3">
                        <label for="job_experience" class="form-label">Total Job Experience <span class="text-danger">*</span></label>
                                        <select name="job_experience" id="job_experience" class="form-control">
                                                <option value="">Select</option>
                                                <option value="month_6">6 Month</option>
                                                <option value="year_1">1 Year</option>
                                                <option value="year_2">2 Year</option>
                                                <option value="year_3">3 Year</option>
                                        </select>
                                        
                        <input type="hidden" name="apply_for_loan" id="apply_for_loan" value="Home Loan" class="form-control" >
                                        <span class="text-red total_Job_Experience-error"></span>
                        </div>
                        
                        <!-- <div class="col-md-3 mb-3">
                                    <label for="total_Job_Experience" class="form-label">Apply Loan <span class="text-danger">*</span></label>
                                        <select name="apply_for_loan" id="apply_for_loan" class="form-control">
                                            <?php //if (!empty($banker)) {
                                               // foreach ($banker as $key => $banks) { ?>
                                                <option value="<? // $banks->loan_name?>"><? // $banks->loan_name?></option> 
                                            <?php // }}?>
                                        <select>
                                        </select>
                        </div> -->
                        <div class="col-md-3 mb-3">
                                    <label for="property_total_area" class="form-label">Property Total Area <span class="text-danger">*</span></label>
                                    <input type="text" name="property_total_area" id="property_total_area" class="form-control">
                                    <span class="text-red property_total_area-error"></span>
                        </div> 
                        <div class="col-md-3 mb-3">
                                    <label for="property_address" class="form-label">Property Address <span class="text-danger">*</span></label>
                                    <input type="text" name="property_address" id="property_address" class="form-control">
                                    <span class="text-red property_address-error"></span>
                        </div> 
                    </div>
                        <button class="btn btn-primary" onclick="stepper.previous()">Previous</button>
                        <a  href="javascript:void(0)" class="btn btn-primary" id="second_step" >Next</a>
                    </div>

                     <div id="information-part" class="content" role="tabpanel" aria-labelledby="information-part-trigger">
                        <div class="" style="background-color:#67c8ff;padding-top: 4px;margin-bottom: 12px;padding-left:5px;">
                            <label for="References"  class="form-label" style="padding: 2px;">Any Running Loan ?</label>
                        </div> 
                            <div class="form-group row align-items-end customer_records" style="margin-bottom:0 !important;"> 
                                <div class="col-md-3 mb-3">
                                    <label for="Loan_Type" class="form-label">Loan Type <span class="text-danger"></span></label>
                                    <input type="text" name="loan_type" id="loan_type" class="form-control" required>
                                </div> 
                                <div class="col-md-2 mb-3">
                                    <label for="Loan_amount" class="form-label">Loan Amount <span class="text-danger"></span></label>
                                    <input type="text" name="loan_amount[]" id="Loan_Amount" class="form-control" required>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label for="bank_name" class="form-label">Bank Name <span class="text-danger"></span></label>
                                        <input type="text" name="bank_name" id="bank_name" class="form-control" required>
                                </div> 
                                <div class="col-md-2 mb-3">
                                        <label for="emi_amount" class="form-label">EMI Amount <span class="text-danger"></span></label>
                                        <input type="text" name="emi_amount" id="emi_amount" class="form-control" required>
                                </div> 
                                <div class="col-md-2 mb-3">
                                        <label for="paid" class="form-label">Paid EMI <span class="text-danger"></span></label>
                                        <input type="text" name="paid_emi" id="paid" class="form-control" required>
                                </div> 
                            </div>
                            <div class="customer_records_dynamic"></div>
                            <div class="form-group row">
                                <div class="col-md-2 mb-3 text-left">
                                    <label for="paid" class="form-label"> </label>
                                    <a class="extra-fields-customer" href="javascript:void(0)">Add More</i></a>
                                </div>
                            </div> 
                             <div class="form-group row">
                            <div class="col-md-12 mb-12" style="background-color:#fed8b1;padding-top: 4px;margin-bottom: 12px;">
                                <label for="References" class="form-label" style="padding: 2px;">References 1 <span class="text-danger">*</span></label>
                            </div>  
                            <div class="col-md-4 mb-4">
                                <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" name="ref_name1" id="name" class="form-control">
                                <span class="text-red name-error"></span>               
                            </div> 
                            <div class="col-md-4 mb-4">
                                <label for="mobile" class="form-label">Mobile No. <span class="text-danger">*</span></label>
                                <input type="number" name="ref_mobile1" id="mobile" class="form-control">
                                <span class="text-red mobile-error"></span>  
                            </div> 
                            <div class="col-md-4 mb-4">
                                <label for="relation" class="form-label">Relation <span class="text-danger">*</span></label>
                                <input type="text" name="ref_relation1" id="rname" class="form-control">
                                <span class="text-red rname-error"></span>  
                            </div> 
                            <div class="col-md-12 mb-12" style="background-color:#fed8b1;padding-top: 4px;margin-bottom: 12px;">
                                <label for="References" class="form-label" style="padding: 2px;">References 2 <span class="text-danger">*</span></label>
                            </div>  
                            <div class="col-md-4 mb-4">
                                <label for="rname" class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" name="ref_name2" id="rname2" class="form-control">
                                <span class="text-red rname2-error"></span>  
                            </div> 
                            <div class="col-md-4 mb-4">
                                <label for="mobile_no" class="form-label">Mobile No. <span class="text-danger">*</span></label>
                                <input type="number" name="ref_mobile2" id="mobile_no2" class="form-control">
                                <span class="text-red mobile_no2-error"></span>  
                            </div> 
                            <div class="col-md-4 mb-4">
                                <label for="relation" class="form-label">Relation <span class="text-danger">*</span></label>
                                <input type="text" name="ref_relation2" id="rname22" class="form-control">
                                <span class="text-red mobile_no2-error"></span>  
                            </div> 
                            <div class="col-md-12 mb-12" style="background-color:#fed8b1;">
                                <label for="References" class="form-label" style="padding: 2px;">Upload Documents  <span class="text-danger">*</span></label>
                            </div>  
                        </div>
                        <div class="form-group row customer_records_doc" style="margin-bottom:0 !important;">
                            <div class="col-md-3 mb-3">
                                <label for="attachment" class="form-label">Attachment Type <span class="text-danger">*</span></label>
                                <select name="attachment[]" id="attachment_third_page"  class="form-control">
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
                                <span class="text-red attachment_third_page-error"></span>  
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
                                <span class="text-red image-error"></span>  
                            </div> 
                            <div class="col-md-3 mb-3">
                                <label for="password" class="form-label">Password(if any)</label>
                                <input type="text" name="password[]" id="password" class="form-control">
                                <span class="text-red password-error"></span>  
                            </div> 
                        </div>
                        <div class="customer_records_dynamicss"></div>

                        <div class="form-group row">
                            <div class="col-md-2 mb-3 text-left">
                                <label for="paid" class="form-label"> </label>
                                <a class="extra-fields-customerss" href="javascript:void(0)">Add More</i></a>
                            </div> 
                        </div>
                    
                      
                      <button class="btn btn-primary" onclick="stepper.previous()">Previous</button>
                      <button type="submit" class="btn btn-primary"id= "last_step">Send</button>

                    </div>
           </form>
                  </div>
                </div>
              </div>
            <!-- /.card -->
          </div>
        </div>
    </div>


  </div>
</div>
</div>

</div>
</div>

        </div>
</div>


<!-- BS-Stepper -->
<script src="<?= base_url('upload/admin/')?>plugins/bs-stepper/js/bs-stepper.min.js"></script>

<script>

  document.addEventListener('DOMContentLoaded', function () {
    window.stepper = new Stepper(document.querySelector('.bs-stepper'))
  })

     $(document).on('change','#state',function(){
        var id  = $(this).val();
         $.ajax({
            type: 'POST',
            data: {id:id},
            url: '<?php echo site_url('admin/Dashboard/getCity'); ?>',
            success: function(res) {
               $('#city').html(res);
            }
        });
    })


    $('.extra-fields-customer').click(function() {
        $('.customer_records').clone().appendTo('.customer_records_dynamic');
        $('.customer_records_dynamic .customer_records').addClass('single remove');
        $('.single .extra-fields-customer').remove();
        $('.single').append('<div class="col-md-1 pt-3 text-center remove-field btn-remove-customer"><i class="fa fa-minus text-light fa-lg" aria-hidden="true"></i></div>');
        $('.customer_records_dynamic > .single').attr("class", "remove row");
        });

        $(document).on('click', '.remove-field', function(e) {
        $(this).parent('.remove').remove();
        e.preventDefault();
        });


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

// form validtaion
//first step validation on
$(document).on('click',"#first_form",function(){

    var loan_amount_req = $("#loan_amount_req").val();
        if (loan_amount_req == '') {
            var  name = 'loan_amount_req';
            var method = 'input';
            check_validation(name,method);
            $('.loan_amount_req-error').css('display','block');
            $('.loan_amount_req-error').html('<span style="color:red;">This field is required</span>');
        }else{
            $('.loan_amount_req-error').css('display','none');  
            $('.loan_amount_req-error').html('');
        }
   
    var client_name = $("#client_name").val();
        if (client_name == '') {
        var  name = 'client_name';
        var method = 'input';
        check_validation(name,method);
        $('.client_name-error').css('display','block');
        $('.client_name-error').html('<span style="color:red;">This field is required</span>');
        }else{
        $('.client_name-error').css('display','none');  
        $('.client_name-error').html('');
    }

    var clientnumber = $("#clientnumber").val();
        if (clientnumber == '') {
        var  name = 'clientnumber';
        var method = 'input';
        check_validation(name,method);
        $('.clientnumber-error').css('display','block');
        $('.clientnumber-error').html('<span style="color:red;">This field is required</span>');
        }else{
        $('.clientnumber-error').css('display','none');  
        $('.clientnumber-error').html('');
    }

     var email = $("#email").val();
        if (email == '') {
        var  name = 'email';
        var method = 'input';
        check_validation(name,method);
        $('.email-error').css('display','block');
        $('.email-error').html('<span style="color:red;">This field is required</span>');
        }else{
        $('.email-error').css('display','none');  
        $('.email-error').html('');
    }

    var company_name = $("#company_name").val();
        if (company_name == '') {
        var  name = 'company_name';
        var method = 'input';
        check_validation(name,method);
        $('.company_name-error').css('display','block');
        $('.company_name-error').html('<span style="color:red;">This field is required</span>');
        }else{
        $('.company_name-error').css('display','none');  
        $('.company_name-error').html('');
    }
  
   


    var city = $("#city").val();
        if (city == '') {
        var  name = 'city';
        var method = 'change';
        check_validation(name,method);
        $('.city-error').css('display','block');
        $('.city-error').html('<span style="color:red;">This field is required</span>');
        }else{
        $('.city-error').css('display','none');  
        $('.city-error').html('');
    }

    var pin_code = $("#pin_code").val();
        if (pin_code == '') {
        var  name = 'pin_code';
        var method = 'input';
        check_validation(name,method);
        $('.pin_code-error').css('display','block');
        $('.pin_code-error').html('<span style="color:red;">This field is required</span>');
        }else{
        $('.pin_code-error').css('display','none');  
        $('.pin_code-error').html('');
    }

    var state = $("#state").val();
        if (state == '') {
        var  name = 'state';
        var method = 'change';
        check_validation(name,method);
        $('.state-error').css('display','block');
        $('.state-error').html('<span style="color:red;">This field is required</span>');
        }else{
        $('.state-error').css('display','none');  
        $('.state-error').html('');
    }
    var property_market_value = $("#property_market_value").val();
        if (property_market_value == '') {
        var  name = 'property_market_value';
        var method = 'input';
        check_validation(name,method);
        $('.property_market_value-error').css('display','block');
        $('.property_market_value-error').html('<span style="color:red;">This field is required</span>');
        }else{
        $('.property_market_value-error').css('display','none');  
        $('.property_market_value-error').html('');
    }
    var annual_ternover = $("#annual_ternover").val();
        if (annual_ternover == '') {
        var  name = 'annual_ternover';
        var method = 'change';
        check_validation(name,method);
        $('.annual_ternover-error').css('display','block');
        $('.annual_ternover-error').html('<span style="color:red;">This field is required</span>');
        }else{
        $('.annual_ternover-error').css('display','none');  
        $('.annual_ternover-error').html('');
    }
    var business_age = $("#business_age").val();
        if (business_age == '') {
        var  name = 'business_age';
        var method = 'change';
        check_validation(name,method);
        $('.business_age-error').css('display','block');
        $('.business_age-error').html('<span style="color:red;">This field is required</span>');
        }else{
        $('.business_age-error').css('display','none');  
        $('.business_age-error').html('');
    }
    var business_type = $("#business_type").val();
        if (business_type == '') {
        var  name = 'business_type';
        var method = 'change';
        check_validation(name,method);
        $('.business_type-error').css('display','block');
        $('.business_type-error').html('<span style="color:red;">This field is required</span>');
        }else{
        $('.business_type-error').css('display','none');  
        $('.business_type-error').html('');
    }
    
    


    var job_period = $("#job_period").val();
        if (job_period == '') {
        var  name = 'job_period';
        var method = 'input';
        check_validation(name,method);
        $('.job_period-error').css('display','block');
        $('.job_period-error').html('<span style="color:red;">This field is required</span>');
        }else{
        $('.job_period-error').css('display','none');  
        $('.job_period-error').html('');
    }
    var property_type = $("#property_type").val();
        if (property_type == '') {
        var  name = 'property_type';
        var method = 'change';
        check_validation(name,method);
        $('.property_type-error').css('display','block');
        $('.property_type-error').html('<span style="color:red;">This field is required</span>');
        }else{
        $('.property_type-error').css('display','none');  
        $('.property_type-error').html('');
    }
    var employment_status = $("#employment").val();
        if (employment_status == '') {
        var  name = 'employment';
        var method = 'change';
        check_validation(name,method);
        $('.employment_status-error').css('display','block');
        $('.employment_status-error').html('<span style="color:red;">This field is required</span>');
        }else{
        $('.employment_status-error').css('display','none');  
        $('.employment_status-error').html('');
    }
     
    
    


     var net_salary = $("#net_salary").val();
        if (net_salary == '') {
        var  name = 'net_salary';
        var method = 'input';
        check_validation(name,method);
        $('.net_salary-error').css('display','block');
        $('.net_salary-error').html('<span style="color:red;">This field is required</span>');
        }else{
        $('.net_salary-error').css('display','none');  
        $('.net_salary-error').html('');
    }

    if (employment_status == 'salaried') {
        
        if (loan_amount_req !== '' && client_name !== '' && clientnumber !== '' && email !== '' && company_name !== '' &&  net_salary !== '' && state !== '' && city !== '' && pin_code !== ''   && property_type !== '' && property_market_value !== '') {  
            $('#first_form').attr('onclick', 'stepper.next()');
        }

    } else if(employment_status == 'self_employed'){
        
        if (loan_amount_req !== '' && client_name !== '' && clientnumber !== '' && email !== '' && company_name !== '' && annual_ternover != ''  && business_age != ''  && business_type != ''  && state !== ''  && city !== '' && pin_code !== ''  && property_type !== '' && property_market_value !== '' ) {  
            $('#first_form').attr('onclick', 'stepper.next()');
        }

    }

        // if (loan_amount_req !== '' && client_name !== '' && clientnumber !== '' && email !== '' && company_name !== '' && city !== '' && pin_code !== '' && state !== '' && job_period !== '' && net_salary !== ''&& loan_amount_req !== '' && client_name !== '' && clientnumber !== '' && email !== '' && company_name !== '' && city !== '' && pin_code !== '' && state !== '' && job_period !== '' && net_salary !== '') {  
        //     $('#first_form').attr('onclick', 'stepper.next()');
        // }
            
});

$(document).on('click',"#second_step",function(){

    var marital_Status = $("#marital_Status").val();
        if (marital_Status == '') {
        var  name = 'marital_Status';
        var method = 'change';
        check_validation(name,method);
        $('.marital_Status-error').css('display','block');
        $('.marital_Status-error').html('<span style="color:red;">This field is required</span>');
        }else{
        $('.marital_Status-error').css('display','none');  
        $('.marital_Status-error').html('');
    }
    var spouse_house = $("#spouse_house").val();
        if (spouse_house == '') {
        var  name = 'spouse_house';
        var method = 'input';
        check_validation(name,method);
        $('.spouse_house-error').css('display','block');
        $('.spouse_house-error').html('<span style="color:red;">This field is required</span>');
        }else{
        $('.spouse_house-error').css('display','none');  
        $('.spouse_house-error').html('');
    }
    var mother_name = $("#mother_name").val();
        if (mother_name == '') {
        var  name = 'mother_name';
        var method = 'input';
        check_validation(name,method);
        $('.mother_name-error').css('display','block');
        $('.mother_name-error').html('<span style="color:red;">This field is required</span>');
        }else{
        $('.mother_name-error').css('display','none');  
        $('.mother_name-error').html('');
    }
    var residence_Type = $("#residence_Type").val();
        if (residence_Type == '') {
        var  name = 'residence_Type';
        var method = 'change';
        check_validation(name,method);
        $('.residence_Type-error').css('display','block');
        $('.residence_Type-error').html('<span style="color:red;">This field is required</span>');
        }else{
        $('.residence_Type-error').css('display','none');  
        $('.residence_Type-error').html('');
    }
    var residential_address = $("#residential_address").val();
        if (residential_address == '') {
        var  name = 'residential_address';
        var method = 'input';
        check_validation(name,method);
        $('.residential_address-error').css('display','block');
        $('.residential_address-error').html('<span style="color:red;">This field is required</span>');
        }else{
        $('.residential_address-error').css('display','none');  
        $('.residential_address-error').html('');
    }
    var company_address = $("#company_address").val();
        if (company_address == '') {
        var  name = 'company_address';
        var method = 'input';
        check_validation(name,method);
        $('.company_address-error').css('display','block');
        $('.company_address-error').html('<span style="color:red;">This field is required</span>');
        }else{
        $('.company_address-error').css('display','none');  
        $('.company_address-error').html('');
    }
    var designation = $("#designation").val();
        if (designation == '') {
        var  name = 'designation';
        var method = 'input';
        check_validation(name,method);
        $('.designation-error').css('display','block');
        $('.designation-error').html('<span style="color:red;">This field is required</span>');
        }else{
        $('.designation-error').css('display','none');  
        $('.designation-error').html('');
    }
    var salary_transfer_mode = $("#salary_transfer_mode").val();
        if (salary_transfer_mode == '') {
        var  name = 'salary_transfer_mode';
        var method = 'change';
        check_validation(name,method);
        $('.salary_transfer_mode-error').css('display','block');
        $('.salary_transfer_mode-error').html('<span style="color:red;">This field is required</span>');
        }else{
        $('.salary_transfer_mode-error').css('display','none');  
        $('.salary_transfer_mode-error').html('');
    }
    var job_peried_current_company = $("#job_peried_current_company").val();
        if (job_peried_current_company == '') {
        var  name = 'job_peried_current_company';
        var method = 'change';
        check_validation(name,method);
        $('.job_peried_current_company-error').css('display','block');
        $('.job_peried_current_company-error').html('<span style="color:red;">This field is required</span>');
        }else{
        $('.job_peried_current_company-error').css('display','none');  
        $('.job_peried_current_company-error').html('');
    }
    var total_Job_Experience = $("#total_Job_Experience").val();
        if (total_Job_Experience == '') {
        var  name = 'total_Job_Experience';
        var method = 'change';
        check_validation(name,method);
        $('.total_Job_Experience-error').css('display','block');
        $('.total_Job_Experience-error').html('<span style="color:red;">This field is required</span>');
        }else{
        $('.total_Job_Experience-error').css('display','none');  
        $('.total_Job_Experience-error').html('');
    }
    var property_total_area = $("#property_total_area").val();
        if (property_total_area == '') {
        var  name = 'property_total_area';
        var method = 'input';
        check_validation(name,method);
        $('.property_total_area-error').css('display','block');
        $('.property_total_area-error').html('<span style="color:red;">This field is required</span>');
        }else{
        $('.property_total_area-error').css('display','none');  
        $('.property_total_area-error').html('');
    }
    var property_address = $("#property_address").val();
        if (property_address == '') {
        var  name = 'property_address';
        var method = 'input';
        check_validation(name,method);
        $('.property_address-error').css('display','block');
        $('.property_address-error').html('<span style="color:red;">This field is required</span>');
        }else{
        $('.property_address-error').css('display','none');  
        $('.property_address-error').html('');
    }
    
    



    if (marital_Status !== '' && spouse_house !== '' && mother_name !== '' && residence_Type !== '' && residential_address !== '' && company_address !== '' && designation !== '' && salary_transfer_mode !== '' && job_peried_current_company !== '' && total_Job_Experience !== ''&& property_total_area !== '' && property_address !== '') {  
    $('#second_step').attr('onclick', 'stepper.next()');
}   

});


$(document).on('click',"#last_step",function(){

    var name = $("#name").val();
        if (name == '') {
        var  name = 'name';
        var method = 'input';
        check_validation(name,method);
        $('.name-error').css('display','block');
        $('.name-error').html('<span style="color:red;">This field is required</span>');
        }else{
        $('.name-error').css('display','none');  
        $('.name-error').html('');
    }
    var mobile = $("#mobile").val();
        if (mobile == '') {
        var  name = 'mobile';
        var method = 'input';
        check_validation(name,method);
        $('.mobile-error').css('display','block');
        $('.mobile-error').html('<span style="color:red;">This field is required</span>');
        }else{
        $('.mobile-error').css('display','none');  
        $('.mobile-error').html('');
    }
    var rname = $("#rname").val();
        if (rname == '') {
        var  name = 'rname';
        var method = 'input';
        check_validation(name,method);
        $('.rname-error').css('display','block');
        $('.rname-error').html('<span style="color:red;">This field is required</span>');
        }else{
        $('.rname-error').css('display','none');  
        $('.rname-error').html('');
    }
    var rname2 = $("#rname2").val();
        if (rname2 == '') {
        var  name = 'rname2';
        var method = 'input';
        check_validation(name,method);
        $('.rname2-error').css('display','block');
        $('.rname2-error').html('<span style="color:red;">This field is required</span>');
        }else{
        $('.rname2-error').css('display','none');  
        $('.rname2-error').html('');
    }
    var mobile_no2 = $("#mobile_no2").val();
        if (mobile_no2 == '') {
        var  name = 'mobile_no2';
        var method = 'input';
        check_validation(name,method);
        $('.mobile_no2-error').css('display','block');
        $('.mobile_no2-error').html('<span style="color:red;">This field is required</span>');
        }else{
        $('.mobile_no2-error').css('display','none');  
        $('.mobile_no2-error').html('');
    }
    var rname22 = $("#rname22").val();
        if (rname22 == '') {
        var  name = 'rname22';
        var method = 'input';
        check_validation(name,method);
        $('.rname22-error').css('display','block');
        $('.rname22-error').html('<span style="color:red;">This field is required</span>');
        }else{
        $('.rname22-error').css('display','none');  
        $('.rname22-error').html('');
    }
    var attachment_third_page = $("#attachment_third_page").val();
        if (attachment_third_page == '') {
        var  name = 'attachment_third_page';
        var method = 'change';
        check_validation(name,method);
        $('.attachment_third_page-error').css('display','block');
        $('.attachment_third_page-error').html('<span style="color:red;">This field is required</span>');
        }else{
        $('.attachment_third_page-error').css('display','none');  
        $('.attachment_third_page-error').html('');
    }
    var image = $("#image").val();
        if (image == '') {
        var  name = 'image';
        var method = 'change';
        check_validation(name,method);
        $('.image-error').css('display','block');
        $('.image-error').html('<span style="color:red;">This field is required</span>');
        }else{
        $('.image-error').css('display','none');  
        $('.image-error').html('');
    }
    var password = $("#password").val();
        if (password == '') {
        var  name = 'password';
        var method = 'change';
        check_validation(name,method);
        $('.password-error').css('display','block');
        $('.password-error').html('<span style="color:red;">This field is required</span>');
        }else{
        $('.password-error').css('display','none');  
        $('.password-error').html('');
    }
    
    



});


  function check_validation(param,method){
    $(document).on(''+method+'','#'+param+'',function(){
        if ($(this).val() == '') {
          $('.'+param+'-error').css('display','block');
          $('.'+param+'-error').html('<span style="color:red;">This field is required</span>');
        }else{
          $('.'+param+'-error').css('display','none');
          $('.'+param+'-error').html('');
        }
      
      });
  }
// form validtaion



    

    // var value = $("#employment").val(); 

    
    $('#employment').on('change',function() {
        var selectedOption = $(this).val();
        if (selectedOption === 'self_employed') {
            $('#self-employed-fields1').show();
            $("#self-employed-fields1 input").attr('required');
            $('#self-employed-fields2').show();
            $('#self-employed-fields3').show();
            $('.net_salary1').hide();

        } else {
            $('#self-employed-fields1').hide();
            $('#self-employed-fields1').removeAttr('required');
            $('#self-employed-fields2').hide();
            $('#self-employed-fields3').hide();
            $('.net_salary1').show();
           
        }
    });

</script>