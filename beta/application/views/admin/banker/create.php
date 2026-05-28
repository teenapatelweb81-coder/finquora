
<div class="container-fluid p-0">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin-dashboard"); ?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Add Banker</li>
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
                    <?php echo form_open_multipart('admin/banker-create'); ?>


                    <div class="row">
                        <!-- <input type="hidden" name="id" id="uid" class="form-control" value="" > <?php //echo $this->session->userdata('user_id');?> -->

                    </div>


                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="state" class="form-label">State<span class="text-danger">*</span></label>
                            <input type="text" name="state" id="state" class="form-control"   required>
                            <?php //echo form_error('mobile','<span class="text-danger mt-1">','</span>') ;?>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="city" class="form-label">City<span class="text-danger">*</span></label>
                            <input type="text" name="city" id="city" class="form-control"   required>
                            <?php //echo form_error('mobile','<span class="text-danger mt-1">','</span>') ;?>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="first_name" class="form-label">Product<span class="text-danger">*</span></label>
                            <input type="text" name="product" id="product" class="form-control" required>
                            <?php //echo form_error('first_name','<span class="text-danger mt-1">','</span>') ;?>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="bank_id" class="form-label">Bank Name<span class="text-danger">*</span></label>
                            <input type="text" name="bank_id" id="bank_id" class="form-control" required>
                            <!-- <select id="bank_id" class="form-control" name="bank_id" required>
                                <option _ngcontent-mir-c194="" disabled selected value="0">Bank Name</option>
                                <?php foreach ($bank_data as $type) {?>
                                    <option _ngcontent-mir-c194="" value="<?=$type->id?>"><?=$type->bank_name?></option>

                                <?php }?>
                            </select> -->
                            <?php //echo form_error('process_id','<span class="text-danger mt-1">','</span>') ;?>

                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="first_name" class="form-label">Banker Name<span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control" required>
                            <?php //echo form_error('first_name','<span class="text-danger mt-1">','</span>') ;?>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="mobile" class="form-label">Bank Contact No <span class="text-danger">*</span></label>
                            <input type="number" name="mobile" id="mobile" class="form-control"  maxlength="10" required>
                            <?php //echo form_error('mobile','<span class="text-danger mt-1">','</span>') ;?>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="pan" class="form-label">Mail Id<span class="text-danger">*</span></label>
                            <input type="email" name="email" id="email" class="form-control" required>
                            <?php //echo form_error('pan','<span class="text-danger mt-1">','</span>') ;?>
                        </div>

                          <?php
                            if ($this->session->userdata('type') == 'admin') { ?>
                                    <div class="col-6 mb-3">
                                        <label for="domain_id_main" class="col-form-label">Domain</label>
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

                        <div class="col-md-5">

                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                            <button type="submit"  id="create" value="create" class="btn btn-info mt-4">Create </button>
                            <!-- <a href="<?php //echo base_url('admin/banker_create') ;?>" class="btn btn-secondary mt-4">Create</a> -->
                            </div>

                        </div>
                        <!-- <div class="col-md-5">

                        </div> -->

                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    <!-- </form> -->
</div>
