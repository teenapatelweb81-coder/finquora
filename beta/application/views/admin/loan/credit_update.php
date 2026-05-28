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
                        <form action = "<?= base_url('admin/Dashboard/credit_Update')?>" method="post">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="creditPhone" class="form-label">Phone No <span class="text-danger">*</span></label>
                                <input type="number" name="creditPhone" id="creditPhone" class="form-control" value="<?= $loans['creditPhone']?>" required>
                                <input type="hidden" name="id"  value="<?= $loans['id']?>" id="id" class="form-control">
                            </div> 
                            <div class="col-md-4 mb-3">
                            <label for="client_name" class="form-label">Pin Code <span class="text-danger">*</span></label>
                                <input type="number" name="creditPincode" id="creditPincode" class="form-control" value="<?= $loans['client_name']?>" required>
                            
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
                            <div class="col-md-12"> 
                                <div class="form-group">
                                    <button type="submit" id="create" value="Save" class="btn btn-info mt-4">Send </button>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                   
                </div>
            </div>
        </div>
</div>
