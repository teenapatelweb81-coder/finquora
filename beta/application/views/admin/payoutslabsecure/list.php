<?php $website_id = domain_id_get(); ?>
<div class="container-fluid p-0">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb ">
      <li class="breadcrumb-item "><a href="<?php echo base_url('admin-dashboard'); ?>" class="text-decoration-none">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Payout slab secured loans</li>
    </ol>
  </nav>
</div>

<div class="container-fluid px-0">
  <div class="row m-0 bg-white">
    <div class="col-md-12  px-0">
      <?php if($this->session->flashdata('success')) { ?><div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div><?php } ?>
      <?php if($this->session->flashdata('error')) { ?><div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div><?php } ?>

      <?php if($this->session->userdata('role') == 1 || $count > 0 ||  $count2 > 0 ||  $count3 > 0) { ?>
      <div class="d-flex mr-1 mt-1 align-items-center justify-content-end">
        <a href="<?php echo base_url('admin/payoutslabsecure-add'); ?>" class="btn btn-primary mr-2">Add New</a>
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#importPayoutModal">Import Excel</button>
         <?php if($this->session->userdata('role') == 1) { ?>
         <button type="button" class="btn btn-danger ml-2" id="deleteSelectedBtn">Bulk delete</button>
         <?php } ?>

      </div>
      <?php } ?>

      <div class="modal fade" id="importPayoutModal" tabindex="-1" role="dialog" aria-labelledby="importPayoutModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="importPayoutModalLabel">Import Payout Slabs</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="<?php echo base_url('admin/payout-slab-secure-import'); ?>" method="post" enctype="multipart/form-data">
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
                <small class="text-muted d-block"> <a href="<?=base_url('assets/excel_files/payoutslabsecure.xlsx')?>" download="">example file</a></small>
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
        <div class="table-responsive">
          <table class="table-bordered" id="dtBasicExample">
            <thead class="bg-primary text-white">
              <tr>
                <?php if($this->session->userdata('role') == 1) { ?>
                <th><input type="checkbox" id="selectAll"></th>
                <?php } ?>
                <th>#</th>
                <th>Type</th>
                <th>Bank Name</th>
                <th>Home Loan</th>
                <th>Affordable Housing</th>
                <th>Loan Against Property</th>
                <th>Loan Against Credit Card</th>
                <th>SME Loans</th>
                <th>DOD/OD</th>
                <th>Credit Card Swipe Machine</th>
                <th>Plant & Machinery</th>
                <th>Education Loan</th>
                <th>Machinery Loan</th>
                <th>MSME</th>
                <th>Working Capital OD</th>
                <th>Secured Term Loan</th>
                <th>Gold Loan</th>
                <th>Remarks</th>
                <?php if($this->session->userdata('role') == 1) { ?>
                <th>Actions</th>
                <?php } ?>
              </tr>
            </thead>
            <tbody>
              <?php if(!empty($rows)) { $i=1; foreach($rows as $r) { 
                ?>
                <tr>
                   <?php if($this->session->userdata('role') == 1) { ?>
                  <td><input type="checkbox" class="rowCheckbox" value="<?= $r->id ?>"></td>
                  <?php } ?>
                  <td><?php echo $i++; ?></td>
                  <td><?php echo htmlspecialchars($r->type); ?></td>
                  <td><?php echo htmlspecialchars($r->bank_name); ?></td>
                  <td><?php echo nl2br(htmlspecialchars($r->home_loan)); ?></td>
                  <td><?php echo nl2br(htmlspecialchars($r->affordable_housing)); ?></td>
                  <td><?php echo nl2br(htmlspecialchars($r->loan_against_property)); ?></td>
                  <td><?php echo nl2br(htmlspecialchars($r->loan_against_credit_card)); ?></td>
                  <td><?php echo nl2br(htmlspecialchars($r->sme_loans)); ?></td>
                  <td><?php echo nl2br(htmlspecialchars($r->dod_od)); ?></td>
                  <td><?php echo nl2br(htmlspecialchars($r->credit_card_swipe_machine)); ?></td>
                  <td><?php echo nl2br(htmlspecialchars($r->plant_machinery)); ?></td>
                  <td><?php echo nl2br(htmlspecialchars($r->education_loan)); ?></td>
                  <td><?php echo nl2br(htmlspecialchars($r->machinery_loan)); ?></td>
                  <td><?php echo nl2br(htmlspecialchars($r->msme)); ?></td>
                  <td><?php echo nl2br(htmlspecialchars($r->working_capital_od)); ?></td>
                  <td><?php echo nl2br(htmlspecialchars($r->secured_term_loan)); ?></td>
                  <td><?php echo nl2br(htmlspecialchars($r->gold_loan)); ?></td>
                  <td><?php echo nl2br(htmlspecialchars($r->remarks)); ?></td>
                  <?php if($this->session->userdata('role') == 1) { ?>
                  <td>
                  <div class="d-flex gap-2">
                    <a class="btn btn-sm btn-primary mr-2" href="<?php echo base_url('admin/payoutslabsecure-edit/'.$r->id); ?>"><i class="fa fa-edit"></i></a>
                    <a class="btn btn-sm btn-danger" href="<?php echo base_url('admin/payoutslabsecure-delete/'.$r->id); ?>" onclick="return confirm('Delete this record?');"><i class="fa fa-trash"></i></a>
                  </div>
                  </td>
                  <?php } ?>
                </tr>
              <?php } } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function () {
    $('#dtBasicExample').DataTable({
        order: [[0, 'desc']],

        // Pagination dropdown options
        lengthMenu: [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "All"]
        ],

        // Default rows per page
        pageLength: 10
    });
});
</script>
<script>
$('#selectAll').on('click', function() {
    $('.rowCheckbox').prop('checked', $(this).prop('checked'));
});
$('#deleteSelectedBtn').on('click', function() {
    let ids = [];
    $('.rowCheckbox:checked').each(function() {
        ids.push($(this).val());
    });
    if (ids.length === 0) {
        alert("Please select at least one record.");
        return;
    }
    if (!confirm("Are you sure you want to delete selected records?")) {
        return;
    }
    $.ajax({
        url: "<?= base_url('admin/payoutslab-secure-bulk-delete'); ?>",
        type: "POST",
        data: { ids: ids },
        success: function(response) {
            location.reload();
        }
    });
});
</script>