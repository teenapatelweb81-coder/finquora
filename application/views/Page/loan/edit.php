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
                    <?php echo form_open_multipart('admin/Dashboard/loan_lead_update');?>
                    <?php //echo '<pre>';print_r($loans);die;?>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                             <label for="loan_amount_req" class="form-label">Loan Requirement Amount <span class="text-danger">*</span></label>
                             <input required type="text" name="loan_amount_req" id="loan_amount_req" class="form-control" value="<?= $loans['loan_amount_req']?>" >
                             <input  type="hidden" name="id" class="form-control" value="<?= $loans['id']?>">
                             <input  type="hidden" name="apply_for_loan" class="form-control" value="<?= $loans['apply_for_loan']?>">
                             <input  type="hidden"  class="form-control city" value="<?= $loans['city']?>">
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
                         
                        <div class="col-md-3 mb-3">
                            <label for="dob" class="form-label">Date Of Birth<span class="text-danger">*</span></label>
                            <input required type="text" name="dob" id="name" class="form-control" value="<?= $loans['dob']?>" >
                        </div> 
                        <div class="col-md-3 mb-3">
                        <label for="pan" class="form-label">Pan No.<span class="text-danger">*</span></label>
                            <input required type="text" name="pan" id="pan" value="<?= $loans['pan']?>" class="form-control" >
                        
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="aadhar" class="form-label">Aadhar No.<span class="text-danger">*</span></label>
                            <input required type="text" name="aadhar" value="<?= $loans['aadhar']?>" id="aadhar" class="form-control" >
                        </div> 
                        <div class="col-md-3 mb-3">
                             <label for="marital_Status" class="form-label">Marital Status <span class="text-danger">*</span></label>
                                <select name="marital_status" id="marital_Status" class="form-control" required  >
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
                            <label for="alt_number" class="form-label">Other Contact Name<span class="text-danger">*</span></label>
                            <input required type="text" name="alt_number" id="alt_number" value="<?= $loans['mother_name']?>"  class="form-control" >
                        </div> 
                        <div class="col-md-3 mb-3">
                            <label for="qualification" class="form-label">Qualification<span class="text-danger">*</span></label>
                            <input required type="text" name="qualification" id="qualification" value="<?= $loans['qualification']?>" class="form-control" >
                        </div> 
                        <div class="col-md-3 mb-3">
                            <label for="residential_type" class="form-label">Residence Type<span class="text-danger">*</span></label>
                            <input required type="text" name="residential_type" id="residential_type" value="<?= $loans['residential_type']?>" class="form-control" >
                        </div> 
                        <div class="col-md-3 mb-3">
                            <label for="residential_address" class="form-label">Residential Address <span class="text-danger">*</span></label>
                            <input required type="text" name="residential_address" id="residential_address" value="<?= $loans['residential_address']?>" class="form-control" >
                        </div> 
                        <div class="col-md-3 mb-3">
                            <label for="residential_address_token" class="form-label">Residential Address Token Form<span class="text-danger">*</span></label>
                            <input required type="text" name="residential_address_token" id="residential_address_token" value="<?= $loans['residential_address_token']?>" class="form-control" >
                        </div> 
                        <div class="col-md-3 mb-3">
                            <label for="residence_stability" class="form-label">Residence Stability<span class="text-danger">*</span></label>
                            <input required type="text" name="residence_stability" id="residence_stability" value="<?= $loans['residence_stability']?>" class="form-control" >
                        </div> 

                        <div class="col-md-3 mb-3">
                             <label for="state" class="form-label">State Name <span class="text-danger">*</span></label>
                             <select name="state_name" id="state"  class="form-control" required >
                                    <option value="Select">Select</option>
                                    <?php if (!empty($states)) {
                                        foreach ($states as $key => $state) { ?>
                                           <option <?php if($state->id == $loans['state']){echo 'selected';}?> value="<?= $state->id?>"><?= $state->name?></option> 
                                    <?php }}?>
                                </select>
                        </div> 
                        <div class="col-md-3 mb-3">
                            <label for="city" class="form-label">City Name <span class="text-danger">*</span></label>
                            <select name="city" id="city" class="form-control" required >
                                    
                             </select>
                        </div> 
                        <div class="col-md-3 mb-3">
                            <label for="pin_code" class="form-label">Pin Code<span class="text-danger">*</span></label>
                            <input required type="text" name="pin_code" id="pin_code" value="<?= $loans['pin_code']?>" class="form-control" >
                        </div> 
                        <div class="col-md-3 mb-3">
                            <label for="company_name" class="form-label">Company Name<span class="text-danger">*</span></label>
                            <input required type="text" name="company_name" id="company_name" value="<?= $loans['company_name']?>" class="form-control" >
                        </div> 

                        <div class="col-md-3 mb-3">
                            <label for="designation" class="form-label">Designation<span class="text-danger">*</span></label>
                            <input required type="text" name="designation" id="designation" value="<?= $loans['designation']?>" class="form-control" >
                        </div> 
                        <div class="col-md-3 mb-3">
                            <label for="company_address" class="form-label">Company Address<span class="text-danger">*</span></label>
                            <input required type="text" name="company_address" id="company_address" value="<?= $loans['company_address']?>" class="form-control" >
                        </div> 
                        <div class="col-md-3 mb-3">
                            <label for="company_address" class="form-label">Net Salary<span class="text-danger">*</span></label>
                            <input required type="text" name="net_salary" id="net_salary" value="<?= $loans['net_salary']?>" class="form-control" >
                        </div> 
                        <div class="col-md-3 mb-3">
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
                    </div>

                <div class="form-group row align-items-end" > 
                        <div class="col-md-12 mb-12" style="background-color:#fed8b1;padding-top: 4px;margin-bottom: 12px;">
                            <label for="References" class="form-label" style="padding: 2px;">References 1 </label>
                        </div>  
                        <div class="col-md-4 mb-4">
                            <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                            <input required type="text" name="ref_name1" value ="<?= $loans['ref_name1']?>" id="name" class="form-control" ="">
                        </div> 
                        <div class="col-md-4 mb-4">
                            <label for="mobile" class="form-label">Mobile No. <span class="text-danger">*</span></label>
                            <input required type="number" name="ref_mobile1"value ="<?= $loans['ref_mobile1']?>" id="mobile" class="form-control" ="">
                        </div> 
                        <div class="col-md-4 mb-4">
                            <label for="relation" class="form-label">Relation <span class="text-danger">*</span></label>
                            <input required type="text" name="ref_relation1" value ="<?= $loans['ref_relation1']?>" id="rname" class="form-control" ="">
                        </div> 
                        <div class="col-md-12 mb-12" style="background-color:#fed8b1;padding-top: 4px;margin-bottom: 12px;">
                            <label for="References" class="form-label"  style="padding: 2px;">References 2 <span class="text-danger">*</span></label>
                        </div>  
                        <div class="col-md-4 mb-4">
                            <label for="rname" class="form-label">Name <span class="text-danger">*</span></label>
                            <input required type="text" name="ref_name2" value ="<?= $loans['ref_name2']?>" id="rname" class="form-control" ="">
                        </div> 
                        <div class="col-md-4 mb-4">
                            <label for="mobile_no" class="form-label">Mobile No. <span class="text-danger">*</span></label>
                            <input required type="number" name="ref_mobile2" value ="<?= $loans['ref_mobile2']?>" id="mobile_no" class="form-control" ="">
                        </div> 
                        <div class="col-md-4 mb-4">
                            <label for="relation" class="form-label">Relation <span class="text-danger">*</span></label>
                            <input required type="text" name="ref_relation2" value ="<?= $loans['ref_relation2']?>" id="rname" class="form-control" ="">
                        </div>

                        <div class="col-md-12 mb-12" style="background-color:#fed8b1;">
                            <label for="References" class="form-label" style="padding: 2px;">Upload Documents  <span class="text-danger">*</span></label>
                        </div>  
                    </div>
                     <div class="form-group row customer_records_doc" style="margin-bottom:0 !important;">
                        <div class="col-md-3 mb-3">
                            <label for="attachment" class="form-label">Attachment Type <span class="text-danger">*</span></label>
                            <select name="attachment[]" id="ctl00_ContentPlaceHolder1_ddl_job_time_in_current_company"  class="form-control">
                                         <option value="">Select</option>
                                        <option value="PAN CARD">PAN CARD</option>
                                        <option value="Aadhar Card">Aadhar Card</option>
                                        <option value="Residence Proof">Residence Proof</option>
                                        <option value="Salary Slip 1">Salary Slip 1</option>
                                        <option value="Salary Slip 2">Salary Slip 2</option>
                                        <option value="Salary Slip 3">Salary Slip 3</option>
                                        <option value="Bank Statement">Bank Statement</option>
                                        <option value="Form 16(if available)">Form 16(if available)</option>
                                        <option value="Loan Statement(if Any)">Loan Statement(if Any)</option>
                                        <option value="Other Docs(if any)">Other Docs(if any)</option>
                                </select>
                        </div>  
                        <div class="col-md-3 mb-3">
                                <label for="login_which_bank" class="form-label">login which Bank <span class="text-danger">*</span></label>
                                <select name="login_which_bank" id="login_which_bank" class="form-control" >
                                    <?php 
                                        if (!empty($bank_data)) {
                                                foreach ($bank_data as $key => $bank) { ?>
                                                <option  value="<?= $bank->id?>"><?= $bank->bank_name?></option> 
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
                                    <th class=''>Bank Name</th>
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
                                    <td class=''><?= $doc['login_which_bank']?></td>				
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
                            <button required type="submit" class="btn btn-primary" style="background-color:#325f9a;">Send</button>
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
        var city  = $('.city').val();
         $.ajax({
            type: 'POST',
            data: {id:id,city:city},
            url: '<?php echo site_url('admin/Dashboard/getCity'); ?>',
            success: function(res) {
               $('#city').html(res);
            }
        });
    })
    //  $("#city ").trigger('change');

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
