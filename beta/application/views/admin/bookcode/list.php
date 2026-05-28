<?php $website_id = domain_id_get(); ?>
<div class="container-fluid p-0">
  <div class="row">
    <div class="col-md-12">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb ">
          <li class="breadcrumb-item "><a href="<?php echo base_url('admin-dashboard'); ?>" class="text-decoration-none">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Payout Slabs</li>
        </ol>
      </nav>
    </div>
  </div>
</div>

<div class="container-fluid">
  <div class="row">
    <div class="col-md-12 mt-3">
      <?php if($this->session->flashdata('success')) { ?><div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div><?php } ?>
      <?php if($this->session->flashdata('error')) { ?><div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div><?php } ?>

      <div class="d-flex mb-3 align-items-center">
        <a href="<?php echo base_url('admin/payoutslab-add'); ?>" class="btn btn-primary mr-2">Add New</a>
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#importPayoutModal">Import Excel</button>
      </div>

      <div class="modal fade" id="importPayoutModal" tabindex="-1" role="dialog" aria-labelledby="importPayoutModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="importPayoutModalLabel">Import Payout Slabs</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="<?php echo base_url('admin/payout-slab-import'); ?>" method="post" enctype="multipart/form-data">
              <div class="modal-body">
                <?php if ($this->session->userdata('type') == 'admin') { ?>
                  <div class="form-group mb-2">
                    <label>Domain</label>
                    <select name="domain_id" class="form-control" onchange="window.location.href = window.location.pathname + '?domain_id=' + this.value;">
                      <?php foreach ($this->db->where('status',1)->get('domains')->result_array() as $domain) { ?>
                        <option <?= ($website_id == $domain['id']) ? 'selected' : ''; ?> value="<?= $domain['id'] ?>"><?= $domain['url'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                <?php } ?>
                <div class="form-group mb-2">
                  <label for="type" class="form-label">Type</label>
                  <select class="form-control" id="type" required="" name="type" fdprocessedid="e7bnas">
                      <option value="team">Team</option>
                      <option value="Branch">Branch</option>
                  </select>
                </div>
                <div class="form-group mb-2">
                  <label>Select Excel File</label>
                  <input type="file" name="files" class="form-control" required>
                </div>
                <small class="text-muted d-block"> <a href="<?=base_url('assets/excel_files/payoutslab.xlsx')?>" download="">example file</a></small>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Upload</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-body table-responsive">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>Type</th>
                <th>Bank Name</th>
                <th>Business Loan</th>
                <th>Personal Loan</th>
                <th>Doctor Loan</th>
                <th>DOD</th>
                <th>OD</th>
                <th>Top Up Cases</th>
                <th>Interest/Digital</th>
                <th>Team Loan</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php if(!empty($rows)) { $i=1; foreach($rows as $r) { 
                ?>
                <tr>
                  <td><?php echo $i++; ?></td>
                  <td><?php echo htmlspecialchars($r->type); ?></td>
                  <td><?php echo htmlspecialchars($r->bank_name); ?></td>
                  <td><?php echo nl2br(htmlspecialchars($r->businees_loan)); ?></td>
                  <td><?php echo nl2br(htmlspecialchars($r->personal_loan)); ?></td>
                  <td><?php echo nl2br(htmlspecialchars($r->doctor_loan)); ?></td>
                  <td><?php echo nl2br(htmlspecialchars($r->dod)); ?></td>
                  <td><?php echo nl2br(htmlspecialchars($r->od)); ?></td>
                  <td><?php echo nl2br(htmlspecialchars($r->top_up_cases)); ?></td>
                  <td><?php echo nl2br(htmlspecialchars($r->interest_rate)); ?><?php if(isset($r->digital)) { echo '<br>'.nl2br(htmlspecialchars($r->digital)); } ?></td>
                  <td><?php echo nl2br(htmlspecialchars($r->team_loan)); ?></td>
                  <td>
                  <div class="d-flex gap-2">
                    <a class="btn btn-sm btn-primary mr-2" href="<?php echo base_url('admin/payoutslab-edit/'.$r->id); ?>"><i class="fa fa-edit"></i></a>
                    <a class="btn btn-sm btn-danger" href="<?php echo base_url('admin/payoutslab-delete/'.$r->id); ?>" onclick="return confirm('Delete this record?');"><i class="fa fa-trash"></i></a>
                  </div>
                  </td>
                </tr>
              <?php } } else { ?>
                <tr><td colspan="11" class="text-center">No records found</td></tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
