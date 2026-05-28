<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>


<div class="container-fluid p-0">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="<?php echo base_url("admin-dashboard");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Edit Email Config</li>
           </ol>
         </nav>
</div>

<div class="container-fluid px-0">
   <div class="row m-0 bg-white">
      <div class="col-md-12 form-main px-0">
         <div class="card form-card">
            <div id="success_message"></div>
            <span class="text-center text-info mb-2" id="susid"><?php echo $this->session->flashdata('success'); ?></span>
            <span class="text-center text-danger mb-2" id="errid"><?php echo $this->session->flashdata('error'); ?></span>

        <?php echo form_open_multipart('admin/email-config-update'); ?>

            <div class="row m-0">
              
               <div class="col-sm-6 col-12">
                  <label for="smtp_host" class="eForm-label">SMTP Host</label>
                  <input type="text" class="form-control eForm-control" id="smtp_host" name="smtp_host" 
                     value="<?= isset($datas['smtp_host']) ? $datas['smtp_host'] : '' ?>" required>
               </div>

               <div class="col-sm-6 col-12">
                  <label for="smtp_port" class="eForm-label">SMTP Port</label>
                  <input type="text" class="form-control eForm-control" id="smtp_port" name="smtp_port" 
                     value="<?= isset($datas['smtp_port']) ? $datas['smtp_port'] : '' ?>" required>
               </div>

               <div class="col-sm-6 col-12">
                  <label for="smtp_user" class="eForm-label">SMTP Username</label>
                  <input type="text" class="form-control eForm-control" id="smtp_user" name="smtp_user" 
                     value="<?= isset($datas['smtp_user']) ? $datas['smtp_user'] : '' ?>" required>
               </div>

               <div class="col-sm-6 col-12">
                  <label for="smtp_pass" class="eForm-label">SMTP Password</label>
                  <input type="text" class="form-control eForm-control" id="smtp_pass" name="smtp_pass" 
                     value="<?= isset($datas['smtp_pass']) ? $datas['smtp_pass'] : '' ?>" required>
               </div>

               <div class="col-sm-6 col-12">
                  <label for="from_email" class="eForm-label">From Email</label>
                  <input type="email" class="form-control eForm-control" id="from_email" name="from_email" 
                     value="<?= isset($datas['from_email']) ? $datas['from_email'] : '' ?>" required>
               </div>

               <?php
                  $selected_domain_id = isset($_GET['domain_id']) ? (int)$_GET['domain_id'] : null;
                  $website_id = $selected_domain_id ?: domain_id_get();

                  if ($this->session->userdata('type') == 'admin') { ?>
                     <div class="col-sm-6 col-12">
                        <label for="domain_id_main" class="col-form-label">Domain</label>
                        <select class="form-control" id="domain_id_main" required name="domain_id"
                           onchange="window.location.href = window.location.pathname + '?domain_id=' + this.value;">
                           <?php foreach ($domains as $domain) { ?>
                              <option <?= ($website_id == $domain['id']) ? 'selected' : ''; ?> value="<?= $domain['id'] ?>">
                                 <?= $domain['url'] ?>
                              </option>
                           <?php } ?>
                        </select>
                     </div>
               <?php } else { ?>
                     <input type="hidden" name="domain_id" value="<?= $website_id ?>">
               <?php } ?>

               <div class="col-sm-12 col-12 pt-2">
                  <button type="submit" id="create" value="create" class="btn btn-info mt-4">Update</button>
               </div>
            </div>

            <?php echo form_close(); ?>
         </div>
      </div>
   </div>
</div>
