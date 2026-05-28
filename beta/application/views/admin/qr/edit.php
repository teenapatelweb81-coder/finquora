<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>



<div class="container-fluid p-0">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin-dashboard");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Qr and payment</li> 
            </ol>
         </nav>
</div>
<div class="container-fluid">
    
    <!-- <form action="<?php //base_url('admin/banker-create')?>" method="post"> -->
        <div class="row m-0">
            <div class="col-md-12 px-0 form-main">
                <div class="card  form-card">
                    <div id="success_message"></div>
                    <span class="text-center text-info mb-2" id="susid"></span>  <?php //echo $this->session->flashdata('success');?>
                    <span class="text-center text-white bg-danger mb-2" id="errid"> </span> <?php // echo $this->session->flashdata('error');?>
                    <?php echo form_open_multipart('admin/qr-update');?>
                    <span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success'); ?></span>
                <span class="text-center text-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error'); ?></span>
                    
                    <div class="row">
                        <input type="hidden" name="id" id="uid" class="form-control" value="<?= (isset($datas['id'])) ? $datas['id'] : '' ; ?>" >
                    
                    </div>

                    
                    <div class="row">
                         <?php
    $selected_domain_id = isset($_GET['domain_id']) ? (int)$_GET['domain_id'] : null;
    
    if ($selected_domain_id) {
        $website_id = $selected_domain_id;
    } else {
        $website_id = domain_id_get();
    }

    if ($this->session->userdata('type') == 'admin') { ?>
        <div class="col-12 mb-3">
            <div class="col-4 mb-3">
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
                        <div class="col-md-6 mb-2">
                            <label for="heading" class="form-label">Heading</label>
                            <input type="text" name="heading" id="heading" class="form-control" value="<?= (isset($datas['heading'])) ? $datas['heading'] : '' ; ?>">
                            <?php //echo form_error('first_name','<span class="text-danger mt-1">','</span>') ;?>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="bank_name" class="form-label">Bank Name<span class="text-danger">*</span></label>
                            <input type="text" name="bank_name" id="bank_name" class="form-control" value="<?= (isset($datas['bank_name'])) ? $datas['bank_name'] : '' ; ?>" required>
                            <?php //echo form_error('first_name','<span class="text-danger mt-1">','</span>') ;?>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="account_number" class="form-label">Account Number<span class="text-danger">*</span></label>
                            <input type="text" name="account_number" id="account_number" class="form-control" value="<?= (isset($datas['account_number'])) ? $datas['account_number'] : '' ; ?>" required>
                            <?php //echo form_error('first_name','<span class="text-danger mt-1">','</span>') ;?>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="ifsc" class="form-label">IFSC<span class="text-danger">*</span></label>
                            <input type="text" name="ifsc" id="ifsc" class="form-control" value="<?= (isset($datas['ifsc'])) ? $datas['ifsc'] : '' ; ?>" required>
                            <?php //echo form_error('first_name','<span class="text-danger mt-1">','</span>') ;?>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="upi" class="form-label">UPI Id<span class="text-danger">*</span></label>
                            <input type="text" name="upi" id="upi" class="form-control" value="<?= (isset($datas['upi'])) ? $datas['upi'] : '' ; ?>" required>
                            <?php //echo form_error('first_name','<span class="text-danger mt-1">','</span>') ;?>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="g_id" class="form-label">google Id</label>
                            <input type="text" name="g_id" id="g_id" class="form-control" value="<?= (isset($datas['g_id'])) ? $datas['g_id'] : '' ; ?>">
                            <?php //echo form_error('first_name','<span class="text-danger mt-1">','</span>') ;?>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="p_id" class="form-label">Phonepay Id</label>
                            <input type="text" name="p_id" id="p_id" class="form-control" value="<?= (isset($datas['p_id'])) ? $datas['p_id'] : '' ; ?>">
                            <?php //echo form_error('first_name','<span class="text-danger mt-1">','</span>') ;?>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="bg_color" class="form-label">Background color</label>
                            <input type="color" name="bg_color" id="bg_color" class="form-control" value="<?= (isset($datas['bg_color'])) ? $datas['bg_color'] : '' ; ?>">
                            <?php //echo form_error('first_name','<span class="text-danger mt-1">','</span>') ;?>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="qr_image" class="form-label">QR Img<span class="text-danger">*</span></label>
                            <input type="file" name="qr_image" id="qr_image" class="form-control" <?php echo empty($datas['qr_image']) ? 'required' : ''; ?>>
                            <?php if (!empty($datas['qr_image'])) { ?>
                                 <input type="hidden" name="old_qr_image" value="<?= $datas['qr_image']; ?>">
                                <div class="mt-3">
                                    <img src="<?php echo base_url('assets/images/contect-us/' . $datas['qr_image']); ?>" alt="Image" width="100">
                                </div>
                                <?php } ?>
                                
                    </div>


                        
                      
                    </div>
                    
                
                    
                    <div class="row">
                        
                        <div class="col-md-5">
                            
                        </div>
                        <div class="col-md-2"> 
                            <div class="form-group">
                            <button type="submit"  id="create" value="create" class="btn btn-info mt-4">update </button>
                            <!-- <a href="<?php //echo base_url('admin/banker_create') ;?>" class="btn btn-secondary mt-4">Create</a> -->
                            </div>
                            
                        </div>
                        <!-- <div class="col-md-5">
                            
                        </div> -->
                        
                    </div>
                    <?php echo form_close();?>
                </div>
            </div>
        </div>
    <!-- </form> -->
</div>
