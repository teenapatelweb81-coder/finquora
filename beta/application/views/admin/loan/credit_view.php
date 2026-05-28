<style>
td, th {
    padding: 6px 10px;
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
        <div class="row">
            <div class="col-md-12 px-0 form-main">
                <div class="card  form-card">
                    <div id="success_message"></div>
                    <span class="text-center text-info mb-2" id="susid"></span>  <?php //echo $this->session->flashdata('success');?>
                    <span class="text-center text-white bg-danger mb-2" id="errid"> </span> <?php // echo $this->session->flashdata('error');?>
                        <div class="row">
                            <?php if ($this->session->userdata('role') == 1) {?>
                                    <div class="col-md-12 text-right mb-3">
                                        <div class="copy-text">
                                                <input type="text" class="text p-1" id="myInput" value="<?= base_url('web_pages/sharePagecredit/cpsess1101506595/')?><?= $loans['id']?>" />
                                                <button class="btn btn-primary" onclick="copylinks()"><i class="fa fa-clone"></i></button>
                                            </div>
                                    </div>
                                <?php }?>
                        
                            <div class="col-md-4 mb-3">
                                <label for="creditPhone" class="form-label">Phone No <span class="text-danger">*</span></label>
                                <input type="number" name="creditPhone" id="creditPhone" class="form-control" value="<?= $loans['creditPhone']?>" max="10" min="10" required>
                                <input type="hidden" name="apply_for_loan"  value="Credit Card" id="apply_for_loan" class="form-control">
                            </div> 
                            <div class="col-md-4 mb-3">
                            <label for="client_name" class="form-label">Pin Code <span class="text-danger">*</span></label>
                                <input type="number" name="creditPincode" id="creditPincode" class="form-control" value="<?= $loans['client_name']?>" max="6" min="6" required>
                            
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="creditDSA" class="form-label">DSA Name/Branch Name <span class="text-danger">*</span></label>
                                <input type="text" name="creditDSA" id="creditDSA" class="form-control" value="<?= $loans['creditDSA']?>" value=""required >
                            </div>
                             <div class="col-md-4 mb-3">
                                <label for="client_name" class="form-label">Customer Name<span class="text-danger">*</span></label>
                                <input type="text" name="client_name" id="client_name" value="<?= $loans['client_name']?>" class="form-control"  value="" required>
                            </div>
                             <div class="col-md-4 mb-3">
                                <label for="clientnumber" class="form-label">Customer No. <span class="text-danger">*</span></label>
                                <input type="text" name="clientnumber" id="clientnumber"  value="<?= $loans['clientnumber']?>" class="form-control"  value="" required>
                            </div>
                             <div class="col-md-4 mb-3">
                                <label for="pin_code" class="form-label">Customer Pincode <span class="text-danger">*</span></label>
                                <input type="text" name="pin_code" id="pin_code"  value="<?= $loans['pin_code']?>" class="form-control"  value="" required>
                            </div>
                        </div>

                          <?php 
                        if ($this->session->userdata('role') == 1) {?>
                <div class="col-md-12 mb-3" style="background-color:#fed8b1;">
                            <label for="References" class="form-label"  style="padding: 2px;">For Remarks  <span class="text-danger">*</span></label>
                        </div> 
                 <form action="<?= base_url('admin/Dashboard/remarks/')?><?= $loans['id']?>" method="post"> 
                    <div class="form-group row align-items-end" style="margin-bottom:0 !important;">
                            <div class="col-md-4 mb-3">
                                <label for="bank_for_admin" class="form-label">Select RM </label>
                                <input type="text" name="rm_assign" id="rm_assign" value="<?= $loans['rm_assign']?>" class="form-control" >
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="bank_for_admin" class="form-label">File login to Submit Bank</label>
                                <input type="text" name="bank_for_admin" id="bank_for_admin" class="form-control">
                                 <!-- <select name="bank_for_admin" id="bank_for_admin"  class="form-control">
                                        <?php if (!empty($bank_data)) {
                                                foreach ($bank_data as $key => $bank) { ?>
                                                <option value=''>Select</option>
                                                <option <?php if($loans['bank_for_admin'] == $bank->id){echo 'selected';}?> value="<?= $bank->id?>"><?= $bank->bank_name?></option> 
                                            <?php }}?>
                                <select> -->
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="lead_feedback" class="form-label">Lead Feedback<span class="text-danger">*</span></label>
                                 <textarea name="lead_feedback" rows="2" cols="20" class="form-control track-focus" type="text"  style="height: 56px;"><?= $loans['lead_feedback']?></textarea>
                            </div> 

                            <div class="col-md-4 mb-3">
                                <label for="remarks" class="form-label">Remarks</label>
                                <textarea name="admin_remark" rows="2" cols="20" class="form-control track-focus" type="text"  style="height: 56px;"><?= $loans['admin_remark']?></textarea>
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
<script>
    function copylinks() {
        var copyText = document.getElementById("myInput");
        copyText.select();
        copyText.setSelectionRange(0, 99999); 
        navigator.clipboard.writeText(copyText.value);
        alert(copyText.value);
    }
</script>