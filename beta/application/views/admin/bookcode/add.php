<?php $website_id = domain_id_get(); ?>
<div class="container-fluid p-0">
  <div class="row">
    <div class="col-md-12">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb ">
          <li class="breadcrumb-item "><a href="<?php echo base_url('admin-dashboard'); ?>" class="text-decoration-none">Home</a></li>
          <li class="breadcrumb-item"><a href="<?php echo base_url('admin/payoutslab'); ?>" class="text-decoration-none">Payout Slabs</a></li>
          <li class="breadcrumb-item active" aria-current="page">Add</li>
        </ol>
      </nav>
    </div>
  </div>
</div>

<div class="container-fluid">
  <div class="row">
    <div class="col-md-12 mt-3">
      <?php echo form_open('admin/payoutslab-create'); ?>
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
							<label for="type" class="form-label">Type</label>
							<select class="form-control" id="type" required="" name="type" fdprocessedid="e7bnas">
                  <option value="team">Team</option>
                  <option value="Branch">Branch</option>
              </select>
						</div>
            <div class="col-md-4 mb-3">
              <label class="form-label">Bank Name</label>
              <input type="text" name="bank_name" class="form-control" required>
            </div>

            <div class="col-md-4 mb-3">
              <label class="form-label">Business Loan</label>
              <textarea name="businees_loan" class="form-control" rows="3"></textarea>
            </div>
            <div class="col-md-4 mb-3">
              <label class="form-label">Personal Loan</label>
              <textarea name="personal_loan" class="form-control" rows="3"></textarea>
            </div>
            <div class="col-md-4 mb-3">
              <label class="form-label">Doctor Loan</label>
              <textarea name="doctor_loan" class="form-control" rows="3"></textarea>
            </div>
            <div class="col-md-4 mb-3">
              <label class="form-label">DOD</label>
              <textarea name="dod" class="form-control" rows="3"></textarea>
            </div>
            <div class="col-md-4 mb-3">
              <label class="form-label">OD</label>
              <textarea name="od" class="form-control" rows="3"></textarea>
            </div>
            <div class="col-md-4 mb-3">
              <label class="form-label">Top Up Cases</label>
              <textarea name="top_up_cases" class="form-control" rows="3"></textarea>
            </div>
            <div class="col-md-4 mb-3">
              <label class="form-label">Interest/Digital</label>
              <textarea name="interest_rate" class="form-control" rows="3"></textarea>
              <small class="text-muted">Use this field for Interest or Digital column as per your sheet.</small>
            </div>
            <div class="col-md-4 mb-3">
              <label class="form-label">Digital (optional)</label>
              <textarea name="digital" class="form-control" rows="3"></textarea>
            </div>
            <div class="col-md-4 mb-3">
              <label class="form-label">Team Loan (optional)</label>
              <textarea name="team_loan" class="form-control" rows="3"></textarea>
            </div>
          </div>
          <button class="btn btn-success">Save</button>
          <a href="<?php echo base_url('admin/payoutslab'); ?>" class="btn btn-secondary">Cancel</a>
        </div>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>
