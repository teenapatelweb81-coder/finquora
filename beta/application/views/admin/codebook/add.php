<?php $website_id = domain_id_get(); ?>
<div class="container-fluid p-0">
  <div class="row">
    <div class="col-md-12">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb ">
          <li class="breadcrumb-item "><a href="<?php echo base_url('admin-dashboard'); ?>" class="text-decoration-none">Home</a></li>
          <li class="breadcrumb-item"><a href="<?php echo base_url('admin/codebook'); ?>" class="text-decoration-none">Codebook</a></li>
          <li class="breadcrumb-item active" aria-current="page">Add</li>
        </ol>
      </nav>
    </div>
  </div>
</div>

<div class="container-fluid">
  <div class="row">
    <div class="col-md-12 mt-3">
      <?php echo form_open('admin/codebook-create'); ?>
      <div class="card">
        <div class="card-body">
          <div class="row">
            <?php if ($this->session->userdata('type') == 'admin') { ?>
              <div class="col-md-4 mb-3">
                <label class="form-label">Domain</label>
                <select class="form-control" name="domain_id">
                  <?php foreach ($domains as $domain) { ?>
                    <option <?= ($website_id == $domain['id']) ? 'selected' : ''; ?> value="<?= $domain['id'] ?>"><?= $domain['url'] ?></option>
                  <?php } ?>
                </select>
              </div>
            <?php } else { ?>
              <input type="hidden" name="domain_id" value="<?= $website_id ?>">
            <?php } ?>

            <div class="col-md-4 mb-3">
              <label class="form-label">Bank Name</label>
              <input type="text" name="bank_name" class="form-control" required>
            </div>
            
            <div class="col-md-4 mb-3">
              <label class="form-label">HL</label>
              <input type="text" name="hl" class="form-control" required>
            </div>
            <div class="col-md-4 mb-3">
              <label class="form-label">LAP</label>
              <input type="text" name="lap" class="form-control" required>
            </div>
            <div class="col-md-4 mb-3">
              <label class="form-label">BL</label>
              <input type="text" name="bl" class="form-control" required>
            </div>
            <div class="col-md-4 mb-3">
              <label class="form-label">PL</label>
              <input type="text" name="pl" class="form-control" required>
            </div>
            <div class="col-md-4 mb-3">
              <label class="form-label">EL</label>
              <input type="text" name="el" class="form-control" required>
            </div>
            <div class="col-md-4 mb-3">
              <label class="form-label">SME</label>
              <input type="text" name="sme" class="form-control" required>
            </div>
            <div class="col-md-4 mb-3">
              <label class="form-label">LAS/Mutual Funds/Shares</label>
              <input type="text" name="las" class="form-control" required>
            </div>
            <div class="col-md-4 mb-3">
              <label class="form-label">WC</label>
              <input type="text" name="wc" class="form-control" required>
            </div>
            <div class="col-md-4 mb-3">
              <label class="form-label">Auto Loan</label>
              <input type="text" name="auto_loan" class="form-control" required>
            </div>
            <div class="col-md-4 mb-3">
              <label class="form-label">ML</label>
              <input type="text" name="ml" class="form-control" required>
            </div>

          </div>
          <button class="btn btn-success">Save</button>
          <a href="<?php echo base_url('admin/codebook'); ?>" class="btn btn-secondary">Cancel</a>
        </div>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>
