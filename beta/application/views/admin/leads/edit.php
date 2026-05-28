


<div class="container-fluid p-0">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin-dashboard"); ?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Edit Lead</li>
           </ol>
         </nav>
</div>
<div class="container-fluid">
   <div class="row">
      <div class="col-md-12 px-0 form-main">
         <div class="card  form-card">
            <div id="success_message"></div>
             <span class="text-center text-info mb-2" id="susid"> <?php //echo $this->session->flashdata('success');?></span>
             <span class="text-center text-white bg-danger mb-2" id="errid"> <?php //echo $this->session->flashdata('error');?></span>
            <?php echo form_open_multipart('admin/update-lead'); ?>


            <div class="row">
                <!-- <input type="hidden" name="uid" id="uid" class="form-control" value="<?php echo $this->session->userdata('user_id'); ?>" >
                -->
                <input type="hidden" name="id" id="id" class="form-control" value="<?php echo $datas->id; ?>" >
                <div class="col-md-6">
                    <label for="Process" class="form-label">Process Type<span class="text-danger">*</span></label>

                       <select id="process_id" class="form-control" name="process_id" required>
                        <option _ngcontent-mir-c194="" value="0">Select type</option>
                        <?php foreach ($process_type as $type) {?>
                            <option _ngcontent-mir-c194="" <?php if ($datas->process_id == $type->id) {echo 'selected';}?>  value="<?=$type->id?>"><?=$type->process_name?>. (<?=$type->process_type?>)</option>

                        <?php }?>
                    </select>
                    <?php echo form_error('process_id', '<span class="text-danger mt-1">', '</span>'); ?>

                </div>
                 <?php
                    $selected_domain_id = isset($_GET['domain_id']) ? (int)$_GET['domain_id'] : null;
                    
                    if ($selected_domain_id) {
                        $website_id = $selected_domain_id;
                    } else {
                        $website_id = domain_id_get();
                    }

                    if ($this->session->userdata('type') == 'admin') { ?>
                        <div class="col-md-6">
                            <div class="">
                                <label for="domain_id_main" class="col-form-label">Domain</label>
                                <select class="form-control" id="domain_id_main" required name="domain_id" onchange="window.location.href = window.location.pathname + '?domain_id=' + this.value;">
                                    <?php foreach ($domains as $domain) { ?>
                                        <option <?= ($website_id == $domain['id']) ? 'selected' : ''; ?> value="<?= $domain['id'] ?>"> <?= $domain['url'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                <?php }else{?>
                    <input type="hidden" name="domain_id"  class="form-control" value="<?= $website_id ?>" >
                <?php }?>
                <!-- <div class="col-md-6">
                    <label for="bank_id" class="form-label">Bank<span class="text-danger">*</span></label>

                       <select id="bank_id" class="form-control" name="bank_id" required>
                        <option _ngcontent-mir-c194="" value="0">Select type</option>
                        <?php foreach ($bank_data as $bank) {?>
                            <option _ngcontent-mir-c194="" <?php if ($datas->bank_id == $bank->id) {echo 'selected';}?>  value="<?=$bank->id?>"><?=$bank->bank_name?></option>

                        <?php }?>
                    </select>
                    <?php echo form_error('bank_id', '<span class="text-danger mt-1">', '</span>'); ?>
                </div> -->
            </div>

             <div class="row">
                <div class="col-md-6">
                    <label for="loan_amount" class="form-label">Loan Amount<span class="text-danger">*</span></label>
                      <input type="number" name="loan_amount" id="loan_amount" value="<?php echo $datas->loan_amount; ?>" class="form-control" maxlength="10"  required>
                       <?php echo form_error('loan_amount', '<span class="text-danger mt-1">', '</span>'); ?>
                    </div>

                <!-- <div class="form-group col-md-6">
                    <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                      <input type="text" name="title" id="title" value="<?php echo $datas->loan_amount; ?>" class="form-control" maxlength="25" required>
                       <?php //echo form_error('title','<span class="text-danger mt-1">','</span>') ;?>
                </div> -->

                <div class="form-group col-md-6">
                <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                      <select id="title" class="form-control" name="title" required>
                        <option _ngcontent-mir-c194="" value="">Select type</option>
                        <option _ngcontent-mir-c194="" <?php if ($datas->title == 'Miss') {echo 'selected';}?> value="Miss">Miss</option>
                        <option _ngcontent-mir-c194=""<?php if ($datas->title == 'MR') {echo 'selected';}?>  value="MR">MR</option>
                        <option _ngcontent-mir-c194=""<?php if ($datas->title == 'MRS') {echo 'selected';}?>  value="MRS">MRS</option>

                    </select>
                       <?php echo form_error('title', '<span class="text-danger mt-1">', '</span>'); ?>
                </div>

            </div>

             <div class="row">
                <div class="col-md-4">
                    <label for="first_name" class="form-label">First Name<span class="text-danger">*</span></label>
                      <input type="text" name="first_name" id="first_name" value="<?php echo $datas->first_name; ?>" class="form-control" maxlength="25"  required>
                       <?php echo form_error('first_name', '<span class="text-danger mt-1">', '</span>'); ?>
                </div>
                <div class="col-md-4">
                    <label for="midle_name" class="form-label">Middle Name<span class="text-danger"></span></label>
                      <input type="text" name="middle_name" id="middle_name" value="<?php echo $datas->middle_name; ?>" class="form-control"  maxlength="25">
                       <?php echo form_error('middle_name', '<span class="text-danger mt-1">', '</span>'); ?>
                </div>
                <div class="col-md-4">
                    <label for="last_name" class="form-label">Last Name<span class="text-danger">*</span></label>
                      <input type="text" name="last_name" id="last_name" value="<?php echo $datas->last_name; ?>" class="form-control"  maxlength="25" required>
                       <?php echo form_error('last_name', '<span class="text-danger mt-1">', '</span>'); ?>
                </div>

            </div>


            <div class="row">
                 <div class="col-md-6">
                   <label for="gender" class="form-label">Gender<span class="text-danger">*</span></label>
                      <select id="gender" class="form-control" name="gender" required>
                        <option _ngcontent-mir-c194="" value="">Select type</option>
                        <option _ngcontent-mir-c194="" <?php if ($datas->gender == 'male') {echo 'selected';}?> value="male">Male</option>
                        <option _ngcontent-mir-c194=""  <?php if ($datas->gender == 'female') {echo 'selected';}?> value="female">Female</option>
                        <option _ngcontent-mir-c194=""  <?php if ($datas->gender == 'other') {echo 'selected';}?> value="other">Other </option>

                    </select>
                    <?php echo form_error('gender', '<span class="text-danger mt-1">', '</span>'); ?>

                 </div>
                 <div class="col-md-6">
                   <label for="dob" class="form-label">DOB<span class="text-danger">*</span></label>
                     <input type="text" name="dob" id="dob"  value="<?php echo $datas->dob; ?>" class="form-control form-year"  required>
                    <?php echo form_error('dob', '<span class="text-danger mt-1">', '</span>'); ?>

                 </div>
            </div>
            <div class="row">
                 <div class="col-md-6">
                     <label for="mobile" class="form-label">Mobile No<span class="text-danger">*</span></label>
                     <input type="number" name="mobile" id="mobile" value="<?php echo $datas->mobile; ?>" class="form-control"  maxlength="10" required>
                     <?php echo form_error('mobile', '<span class="text-danger mt-1">', '</span>'); ?>
                 </div>
                 <div class="col-md-6">
                     <label for="pan" class="form-label">Pan<span class="text-danger">*</span></label>
                     <input type="text" name="pan" id="pan" value="<?php echo $datas->pan; ?>" class="form-control"   maxlength="10" required>
                     <?php echo form_error('pan', '<span class="text-danger mt-1">', '</span>'); ?>
                 </div>
            </div>

            <div class="row">
                 <div class="col-md-6">
                     <label for="zip_code" class="form-label">Pincode<span class="text-danger">*</span></label>
                     <input type="number" name="zip_code" id="zip_code" value="<?php echo $datas->zip_code; ?>" class="form-control"  maxlength="10" required>
                     <?php echo form_error('zip_code', '<span class="text-danger mt-1">', '</span>'); ?>
                 </div>
                <?php if ($this->session->userdata('role') == 1) {?>
                 <div class="col-md-6">
                   <label for="lead_status" class="form-label">lead Status<span class="text-danger">*</span></label>
                      <select id="lead_status" class="form-control" name="lead_status" required>
                        <option _ngcontent-mir-c194="" value="">Select type</option>
                        <option _ngcontent-mir-c194=""  <?php if ($datas->lead_status == 'Apporved') {echo 'selected';}?> value="Apporved">Apporved</option>
                        <option _ngcontent-mir-c194=""  <?php if ($datas->lead_status == 'Reject') {echo 'selected';}?> value="Reject">Reject</option>
                        <option _ngcontent-mir-c194=""  <?php if ($datas->lead_status == 'Duplicate') {echo 'selected';}?> value="Duplicate">Duplicate</option>
                        <option _ngcontent-mir-c194=""  <?php if ($datas->lead_status == 'Document Pending') {echo 'selected';}?> value="Document Pending">Document Pending</option>
                        <option _ngcontent-mir-c194=""  <?php if ($datas->lead_status == 'Disbursements') {echo 'selected';}?> value="Disbursements">Disbursements</option>
                    </select>

                    <?php echo form_error('lead_status', '<span class="text-danger mt-1">', '</span>'); ?>

                 </div>
                

                 <div class="col-md-6">
                   <label for="status" class="form-label">Satus<span class="text-danger">*</span></label>
                      <select id="status" class="form-control" name="status" required>
                        <option _ngcontent-mir-c194="" value="">Select type</option>
                        <option _ngcontent-mir-c194="" <?php if ($datas->status == 1) {echo 'selected';}?> value="1">Active</option>
                        <option _ngcontent-mir-c194=""  <?php if ($datas->status == 2) {echo 'selected';}?> value="2">Inactive</option>
                    </select>
                    <?php echo form_error('gender', '<span class="text-danger mt-1">', '</span>'); ?>

                 </div>
                  <?php }?>

            </div>

            <div class="row">

                <div class="col-md-5">

                </div>
                <div class="col-md-2">
                     <div class="form-group">
                       <button type="submit" id="updated" value="updated" class="btn btn-info mt-4">Updated </button>
                    </div>

                </div>
                <div class="col-md-5">

                </div>

            </div>
            <?php echo form_close(); ?>
         </div>
      </div>
   </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<script>
    $('.form-year').datepicker({
            format: 'yyyy-mm-dd',
            todayHighlight: true,
            autoclose: true,
            });
   </script>