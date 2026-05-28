
	 <?php   //echo '<>';print_r($slots);die; ?>

<div class="container-fluid p-0">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin-dashboard");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Edit Payout Slabs</li>
           </ol>
         </nav>
</div>
<div class="container-fluid">
   <div class="row">
      <div class="col-md-12 px-0 form-main">
         <div class="card  form-card">
            <div id="success_message"></div>
             <span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>
             <span class="text-center text-white bg-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error');?></span>
            <?php echo form_open_multipart('admin/update-slots');?>
            
            
            <div class="row">
                <input type="hidden" name="id" id="id" class="form-control" value="<?= $slots[0]->id  ?>" >
                <div class="col-md-6 mb-2">
                    <label for="Process" class="form-label">Bank Name<span class="text-danger">*</span></label>

                     <input type="text" name="bank_name" id="bank_name" class="form-control"   value="<?= $slots[0]->bank_name  ?>" required>
                       <?php echo form_error('bank_name','<span class="text-danger mt-1">','</span>') ;?>
                        <!-- <select id="bank_name" class="form-control" name="bank_name" required>
                        <option _ngcontent-mir-c194="" value="0">Select type</option> -->
                        <?php //foreach($bank_data as $bank) { ?>

                            <!-- <option _ngcontent-mir-c194="" <?php if($bank->bank_name == $slots[0]->bank_name){echo 'selected';}?> value="<?=$bank->bank_name?>"><?=$bank->bank_name?></option> -->
                            
                        <?php //} ?>
                    <!-- </select> -->

                    <?php echo form_error('bank_name','<span class="text-danger mt-1">','</span>') ;?>
                
                </div>
                <?php $website_id = domain_id_get(); ?>
                <?php
                  if ($this->session->userdata('type') == 'admin') { ?>
                          <div class="col-6 mb-3">
                              <label for="domain_id_main" class="col-form-label">Domain</label>
                              <select class="form-control" id="domain_id_main" required name="domain_id">
                                  <?php foreach ($domains as $domain) { ?>
                                      <option <?= ($slots[0]->domain_id == $domain['id']) ? 'selected' : ''; ?> value="<?= $domain['id'] ?>"> <?= $domain['url'] ?></option>
                                  <?php } ?>
                              </select>
                          </div>
                  <?php }else{?>
                      <input type="hidden" name="domain_id"  class="form-control" value="<?= domain_id_get() ?>" >
                  <?php }?>
                <div class="col-md-6 mb-2">
                    <label for="loan_type" class="form-label">Loan Type<span class="text-danger">*</span></label>
                      <input type="text" name="loan_type" id="loan_type" class="form-control" required value="<?= $slots[0]->loan_type  ?>">
                       <?php echo form_error('loan_type','<span class="text-danger mt-1">','</span>') ;?>
                </div>
                <div class="col-md-6 mb-2">
                    <label for="slab_A_per" class="form-label">Slot A<span class="text-danger">*</span></label>
                      <input type="text" name="slab_A" id="slab_A" class="form-control"   value="<?= $slots[0]->slab_A  ?>" required>
                       <?php echo form_error('slab_A','<span class="text-danger mt-1">','</span>') ;?>
                </div>
                
                <!-- <div class="col-md-6 mb-2">
                    <label for="slab_A_per" class="form-label">Slot A(%)<span class="text-danger">*</span></label>
                      <input type="text" name="slab_A_per" id="slab_A_per" class="form-control"  value="<?= $slots[0]->slab_A_per  ?>"  required>
                       <?php echo form_error('slab_A_per','<span class="text-danger mt-1">','</span>') ;?>
                </div> -->

                <div class="col-md-6 mb-2">
                    <label for="slab_B" class="form-label">Slot B<span class="text-danger"></span></label>
                      <input type="text" name="slab_B" id="slab_B" class="form-control"  value="<?= $slots[0]->slab_B  ?>" >
                       <?php echo form_error('slab_B','<span class="text-danger mt-1">','</span>') ;?>
                </div>
                
                <!-- <div class="col-md-6 mb-2">
                    <label for="slab_B_per" class="form-label">Slot B(%)<span class="text-danger"></span></label>
                      <input type="text" name="slab_B_per" id="slab_B_per" class="form-control"  value="<?= $slots[0]->slab_B_per  ?>" >
                       <?php echo form_error('slab_B_per','<span class="text-danger mt-1">','</span>') ;?>
                </div> -->
                <div class="col-md-6 mb-2">
                    <label for="slab_C" class="form-label">Slot C<span class="text-danger">*</span></label>
                      <input type="text" name="slab_C" id="slab_C" class="form-control"  value="<?= $slots[0]->slab_C  ?>" required>
                       <?php echo form_error('slab_C','<span class="text-danger mt-1">','</span>') ;?>
                </div>
                
                <!-- <div class="col-md-6 mb-2">
                    <label for="slab_C_per" class="form-label">Slot C(%)<span class="text-danger">*</span></label>
                      <input type="text" name="slab_C_per" id="slab_C_per" class="form-control"  value="<?= $slots[0]->slab_C_per  ?>"  required>
                       <?php echo form_error('slab_C_per','<span class="text-danger mt-1">','</span>') ;?>
                </div> -->
                <div class="col-md-6 mb-2">
                    <label for="slab_D" class="form-label">Slot D<span class="text-danger"></span></label>
                      <input type="text" name="slab_D" id="slab_D" class="form-control"  value="<?= $slots[0]->slab_D  ?>" >
                       <?php echo form_error('slab_D','<span class="text-danger mt-1">','</span>') ;?>
                </div>
                
                <!-- <div class="col-md-6 mb-2">
                    <label for="slab_D_per" class="form-label">Slot D(%)<span class="text-danger"></span></label>
                      <input type="text" name="slab_D_per" id="slab_D_per" class="form-control"  value="<?= $slots[0]->slab_D_per  ?>" >
                       <?php echo form_error('slab_D_per','<span class="text-danger mt-1">','</span>') ;?>
                </div> -->

                <div class="col-md-6 mb-2">
                    <label for="starperformer" class="form-label">starperformer<span class="text-danger">*</span></label>
                      <input type="text" name="starperformer" id="starperformer" class="form-control"  value="<?= $slots[0]->starperformer  ?>"  required>
                       <?php echo form_error('starperformer','<span class="text-danger mt-1">','</span>') ;?>
                </div>
            
                <!-- <div class="col-md-6 mb-2">
                    <label for="starperformance_per" class="form-label">Starperformance(%)<span class="text-danger">*</span></label>
                      <input type="text" name="starperformance_per" id="starperformance_per" class="form-control"  value="<?= $slots[0]->starperformance_per  ?>"  required>
                       <?php echo form_error('starperformance_per','<span class="text-danger mt-1">','</span>') ;?>
                </div> -->
            </div>

            <div class="row">
                <div class="col-md-5"></div>
                    <div class="col-md-2"> 
                        <div class="form-group">
                        <button type="submit" value="update" class="btn btn-info mt-4"> Update </button>
                        </div>
                    </div>
                <div class="col-md-5"></div>
            </div>
            
            <?php echo form_close();?>
         </div>
      </div>
   </div>
</div>
