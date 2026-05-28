<?php $website_id = domain_id_get(); ?>
<div class="container-fluid p-0">
  <div class="row">
    <div class="col-md-12">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb ">
          <li class="breadcrumb-item "><a href="<?php echo base_url('admin-dashboard'); ?>" class="text-decoration-none">Home</a></li>
          <li class="breadcrumb-item"><a href="<?php echo base_url('admin/payoutslabsecure'); ?>" class="text-decoration-none">Payout Slabs</a></li>
          <li class="breadcrumb-item active" aria-current="page">Add</li>
        </ol>
      </nav>
    </div>
  </div>
</div>

<div class="container-fluid">
  <div class="row">
    <div class="col-md-12 mt-3">
      <?php echo form_open('admin/payoutslabsecure-create'); ?>
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
              <label class="form-label">Home Loan</label>
              <textarea name="home_loan" class="form-control" rows="3"></textarea>
            </div>
            <div class="col-md-4 mb-3">
              <label class="form-label">Affordable Housing</label>
              <textarea name="affordable_housing" class="form-control" rows="3"></textarea>
            </div>
            <div class="col-md-4 mb-3">
              <label class="form-label">Loan Against Property</label>
              <textarea name="loan_against_property" class="form-control" rows="3"></textarea>
            </div>
            <div class="col-md-4 mb-3">
              <label class="form-label">Loan Against Credit Card</label>
              <textarea name="loan_against_credit_card" class="form-control" rows="3"></textarea>
            </div>
            <div class="col-md-4 mb-3">
              <label class="form-label">SME Loans</label>
              <textarea name="sme_loans" class="form-control" rows="3"></textarea>
            </div>
            <div class="col-md-4 mb-3">
              <label class="form-label">DOD/OD</label>
              <textarea name="dod_od" class="form-control" rows="3"></textarea>
            </div>
            <div class="col-md-4 mb-3">
              <label class="form-label">Credit Card Swipe Machine</label>
              <textarea name="credit_card_swipe_machine" class="form-control" rows="3"></textarea>
            </div>
            <div class="col-md-4 mb-3">
              <label class="form-label">Plant & Machinery</label>
              <textarea name="plant_machinery" class="form-control" rows="3"></textarea>
            </div>
            <div class="col-md-4 mb-3">
              <label class="form-label">Education Loan</label>+
              <textarea name="education_loan" class="form-control" rows="3"></textarea>
            </div>
            <div class="col-md-4 mb-3">
              <label class="form-label">Machinery Loan</label>
              <textarea name="machinery_loan" class="form-control" rows="3"></textarea>
            </div>
            <div class="col-md-4 mb-3">
              <label class="form-label">MSME</label>
              <textarea name="msme" class="form-control" rows="3"></textarea>
            </div>
            <div class="col-md-4 mb-3">
              <label class="form-label">Working Capital OD</label>
              <textarea name="working_capital_od" class="form-control" rows="3"></textarea>
            </div>
            <div class="col-md-4 mb-3">
              <label class="form-label">Secured Term Loan</label>
              <textarea name="secured_term_loan" class="form-control" rows="3"></textarea>
            </div>
            <div class="col-md-4 mb-3">
              <label class="form-label">Gold Loan</label>
              <textarea name="gold_loan" class="form-control" rows="3"></textarea>
            </div>
            <div class="col-md-4 mb-3">
              <label class="form-label">Remarks</label>
              <textarea name="remarks" class="form-control" rows="3"></textarea>
            </div>
          </div>
          <button class="btn btn-success">Save</button>
          <a href="<?php echo base_url('admin/payoutslabsecure'); ?>" class="btn btn-secondary">Cancel</a>
        </div>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>
