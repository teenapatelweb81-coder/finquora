<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>


<div class="container-fluid p-0">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
               <li class="breadcrumb-item"><a href="<?php echo base_url("admin-dashboard"); ?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Edit Plantinum section 1</li> 
           </ol>
         </nav>
</div>

<div class="container-fluid">
   <div class="row">
      <div class="col-md-12 px-0 form-main">
         <div class="card form-card">
            <div id="success_message"></div>
            <span class="text-center text-info mb-2" id="susid"><?php echo isset($this->session) ? $this->session->flashdata('success') : ''; ?></span>
            <span class="text-center text-white bg-danger mb-2" id="errid"><?php echo isset($this->session) ? $this->session->flashdata('error') : ''; ?></span>

            <?php
               $selected_domain_id = isset($_GET['domain_id']) ? (int)$_GET['domain_id'] : null;
               $website_id = $selected_domain_id ?: domain_id_get();
            ?>

            <div class="row">
               <?php if ($this->session->userdata('type') == 'admin') { ?>
                  <div class="col-12 mb-3">
                     <div class="col-4 mb-3">
                        <label for="domain_id_main" class="col-form-label">Domain</label>
                        <select class="form-control" id="domain_id_main" required name="domain_id"
                           onchange="window.location.href = window.location.pathname + '?domain_id=' + this.value;">
                           <?php foreach ($domains as $domain) { ?>
                              <option <?= ($website_id == $domain['id']) ? 'selected' : ''; ?> value="<?= $domain['id'] ?>"> <?= $domain['url'] ?></option>
                           <?php } ?>
                        </select>
                     </div>
                  </div>
               <?php } else { ?>
                  <input type="hidden" name="domain_id" class="form-control" value="<?= $website_id ?>">
               <?php } ?>
            </div>

            <!-- FORM 1: Basic Info -->
            <?php echo form_open_multipart('admin/plantinum-section-1-update'); ?>
            <input type="hidden" name="id" value="<?= $plantinumSection1['id'] ?? ''; ?>">
            <input type="hidden" name="domain_id" value="<?= $website_id ?>">

            <div class="row">
               <div class="col-md-6">
                  <label for="heading" class="form-label">Heading<span class="text-danger">*</span></label>
                  <input type="text" name="heading" id="heading" class="form-control" value="<?= htmlspecialchars($plantinumSection1['heading'] ?? '') ?>" required>
                  <input type="hidden" name="step" value="1">
               </div>

               <div class="col-md-6">
                  <label for="text" class="form-label">Text<span class="text-danger">*</span></label>
                  <input name="text" id="text" class="form-control" required value="<?= htmlspecialchars($plantinumSection1['text'] ?? '') ?>">
               </div>

               <div class="col-md-12">
                  <label for="description" class="form-label">Description<span class="text-danger">*</span></label>
                  <textarea name="description" id="description" class="form-control" required><?= htmlspecialchars($plantinumSection1['description'] ?? '') ?></textarea>
               </div>
            </div>

            <div class="text-center mt-3 mb-4">
               <button type="submit" class="btn btn-info">Update Info</button>
            </div>
            <?php echo form_close(); ?>

            <hr>

            <!-- FORM 2: Pricing + Card Info -->
            <?php echo form_open_multipart('admin/plantinum-section-1-update'); ?>
            <input type="hidden" name="id" value="<?= $plantinumSection1['id'] ?? ''; ?>">
            <input type="hidden" name="domain_id" value="<?= $website_id ?>">

            <div class="row">
               <div class="col-md-6">
                  <label for="previous_price" class="form-label">Previous Price<span class="text-danger">*</span></label>
                  <input name="previous_price" id="previous_price" class="form-control" required value="<?= htmlspecialchars($plantinumSection1['previous_price'] ?? '') ?>">
               </div>

               <div class="col-md-6">
                  <label for="new_price" class="form-label">New Price<span class="text-danger">*</span></label>
                  <input type="text" name="new_price" id="new_price" class="form-control" required value="<?= htmlspecialchars($plantinumSection1['new_price'] ?? '') ?>">
                <input type="hidden" name="step" value="2">
                </div>

               <div class="col-md-6">
                  <label for="card_name" class="form-label">Card Name<span class="text-danger">*</span></label>
                  <input type="text" name="card_name" id="card_name" class="form-control" required value="<?= htmlspecialchars($plantinumSection1['card_name'] ?? '') ?>">
               </div>

               <div class="col-md-6">
                  <label for="card_no" class="form-label">Card No<span class="text-danger">*</span></label>
                  <input type="text" name="card_no" id="card_no" class="form-control" required value="<?= htmlspecialchars($plantinumSection1['card_no'] ?? '') ?>">
               </div>

               <div class="col-md-6">
                  <label for="validity" class="form-label">Validity<span class="text-danger">*</span></label>
                  <input type="text" name="validity" id="validity" class="form-control" required value="<?= htmlspecialchars($plantinumSection1['validity'] ?? '') ?>">
               </div>

               <div class="col-md-6">
                  <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                  <input type="text" name="name" id="name" class="form-control" required value="<?= htmlspecialchars($plantinumSection1['name'] ?? '') ?>">
               </div>
            </div>

            <div class="text-center mt-3 mb-4">
               <button type="submit" class="btn btn-info">Update Card Info</button>
            </div>
            <?php echo form_close(); ?>

            <hr>

            <!-- FORM 3: Paid Plans -->
            <?php echo form_open_multipart('admin/plantinum-section-1-update'); ?>
            <input type="hidden" name="id" value="<?= $plantinumSection1['id'] ?? ''; ?>">
            <input type="hidden" name="domain_id" value="<?= $website_id ?>">

            <div class="row">
               <div class="col-md-6">
                  <label class="form-label">DSA Card Plan<span class="text-danger">*</span></label>
                  <textarea name="card_plan" id="card_plan" class="form-control" required><?= htmlspecialchars($plantinumSection1['card_plan'] ?? '') ?></textarea>
               </div>

               <div class="col-md-6">
                  <label class="form-label">Branch Card Plan<span class="text-danger">*</span></label>
                  <textarea name="branch_card_plan" id="branch_card_plan" class="form-control" required><?= htmlspecialchars($plantinumSection1['branch_card_plan'] ?? '') ?></textarea>
                <input type="hidden" name="step" value="3">
                </div>

               <div class="col-md-6">
                  <label class="form-label">Customer Card Plan<span class="text-danger">*</span></label>
                  <textarea name="customer_card_plan" id="customer_card_plan" class="form-control" required><?= htmlspecialchars($plantinumSection1['customer_card_plan'] ?? '') ?></textarea>
               </div>

               <div class="col-md-6">
                  <label class="form-label">Network Member Card Plan<span class="text-danger">*</span></label>
                  <textarea name="network_card_plan" id="network_card_plan" class="form-control" required><?= htmlspecialchars($plantinumSection1['network_card_plan'] ?? '') ?></textarea>
               </div>
            </div>

            <div class="text-center mt-3 mb-4">
               <button type="submit" class="btn btn-info">Update Paid Plans</button>
            </div>
            <?php echo form_close(); ?>

            <hr>

            <!-- FORM 4: Free Plans + Image -->
            <?php echo form_open_multipart('admin/plantinum-section-1-update'); ?>
            <input type="hidden" name="id" value="<?= $plantinumSection1['id'] ?? ''; ?>">
            <input type="hidden" name="domain_id" value="<?= $website_id ?>">

            <div class="row">
               <div class="col-md-6">
                  <label class="form-label">DSA Card Plan for Free<span class="text-danger">*</span></label>
                  <textarea name="free_card_plan" id="free_card_plan" class="form-control" required><?= htmlspecialchars($plantinumSection1['free_card_plan'] ?? '') ?></textarea>
               </div>

               <div class="col-md-6">
                 <input type="hidden" name="step" value="4">
                  <label class="form-label">Branch Card Plan for Free<span class="text-danger">*</span></label>
                  <textarea name="branch_free_card_plan" id="branch_free_card_plan" class="form-control" required><?= htmlspecialchars($plantinumSection1['branch_free_card_plan'] ?? '') ?></textarea>
               </div>

               <div class="col-md-6">
                  <label class="form-label">Customer Card Plan for Free<span class="text-danger">*</span></label>
                  <textarea name="customer_free_card_plan" id="customer_free_card_plan" class="form-control" required><?= htmlspecialchars($plantinumSection1['customer_free_card_plan'] ?? '') ?></textarea>
               </div>

               <div class="col-md-6">
                  <label class="form-label">Network Member Card Plan for Free<span class="text-danger">*</span></label>
                  <textarea name="network_free_card_plan" id="network_free_card_plan" class="form-control" required><?= htmlspecialchars($plantinumSection1['network_free_card_plan'] ?? '') ?></textarea>
               </div>

               
            </div>

            <div class="text-center mt-3 mb-4">
               <button type="submit" class="btn btn-info">Update Free Plans & Image</button>
            </div>
            <?php echo form_close(); ?>

         </div>
      </div>
   </div>
</div>

<script>
CKEDITOR.replace('description');
CKEDITOR.replace('card_plan');
CKEDITOR.replace('branch_card_plan');
CKEDITOR.replace('customer_card_plan');
CKEDITOR.replace('network_card_plan');
CKEDITOR.replace('free_card_plan');
CKEDITOR.replace('branch_free_card_plan');
CKEDITOR.replace('customer_free_card_plan');
CKEDITOR.replace('network_free_card_plan');
</script>
