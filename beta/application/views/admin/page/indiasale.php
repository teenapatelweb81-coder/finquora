<div class="container-fluid p-0">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url("admin/Dashboard/");?>" class="text-decoration-none">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Instant loan data</li>
        </ol>
    </nav>
</div>

<section class="content p-0">
    <div class="container-fluid px-0">
        
    <div class="row m-0 bg-white">
        <?php 
            $user = $this->db->where('id',$this->session->userdata('user_id'))->where('role',$this->session->userdata('role'))->get('user_master')->row_array();
            if (empty($user)) {
                $user = $this->db->where('id',$this->session->userdata('user_id'))->where('role',$this->session->userdata('role'))->get('branch_franchise')->row_array();
            }
         ?>

        <div class="col-md-12 px-0">
        <?php if($this->session->flashdata('success')): ?>
            <div class="alert alert-success"><?= $this->session->flashdata('success') ?></div>
            <?php endif; ?>
            <?php if($this->session->flashdata('error')): ?>
                <div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
                <?php endif; ?>    
            </div>
        <?php if($this->session->userdata('role') == 1 || (empty($user['parent_id']) && $user['domain_id'] == 3)) { ?>
            <div class="col-md-12 px-0">
            <?php echo form_open_multipart('admin/Dashboard/assign_link_to_indiasale');?>
                    <div class="px-2">
                        <div class="cart-b">
                            <div class="row align-items-end">
                                <?php if($this->session->userdata('type') == 'admin') { ?>
                                    <div class="col-md-3 mt-1">
                                        <label for="domain_id_main_website" class="form-label">Domain Name <span class="text-danger">*</span></label>
                                        <select class="form-control" id="domain_id_main_website" required name="domain_id" >
                                            <option value="">Select Domain</option>
                                            <?php foreach ($domains as $domain) { ?>
                                                <option  value="<?= $domain['id'] ?>" <?= isset($_GET['domain_id']) && $_GET['domain_id'] == $domain['id'] ? 'selected' : '' ?>>
                                                    <?= $domain['url'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="user_id_website" class="form-label">User<span class="text-danger">*</span></label>
                                        <select id="user_id_website" name="user_id" class="form-control" required>
                                            <option value="">Select User</option>
                                            <?php if (!empty($dsa)) foreach ($dsa as $u) { ?>
                                                <option value="<?= $u->id ?>">DSA - <?= $u->name ?></option>
                                            <?php } ?>

                                            <?php if (!empty($branch)) foreach ($branch as $u) { ?>
                                                <option value="<?= $u->id ?>">Branch - <?= $u->name ?></option>
                                            <?php } ?>

                                            <?php if (!empty($admin)) foreach ($admin as $u) { ?>
                                                <option value="<?= $u->id ?>">Subadmin - <?= $u->name ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <input type="hidden" name="role" id="user_role_id_website">
                                <?php } else { ?>
                                    <input type="hidden" name="domain_id" value="<?= domain_id_get() ?>">
                                    <input type="hidden" name="user_id" value="<?= $this->session->userdata('user_id') ?>">
                                    <input type="hidden" name="role" value="<?= $this->session->userdata('role') ?>">
                                <?php } ?>
                                
                                <div class="col-md-3 mt-1">
                                    <label for="indiasale_team_link" class="form-label">URL</label>
                                    <input type="url" name="indiasale_team_link" id="indiasale_team_link" class="form-control" 
                                        placeholder="Add indiasale team link" 
                                        value="<?= (isset($indiasale_team_link['link'])) ? $indiasale_team_link['link'] : ''; ?>" >	
                                </div>
                                <div class="col-md-2 mt-1">
                                    <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-info mt-4">
                                </div>
                            </div>
                        </div>
                    </div>  
                <?php echo form_close();?>
            </div>
        <?php } ?>
       
        <div class="col-12 px-0">
            <div class="">
                <div class="d-flex justify-content-end align-items-center">
                    <?php if (empty($user['parent_id']) || $user['parent_id_role'] == 1) { ?>
                        <div class="pt-2 text-right mr-2">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addInstanLoanModal">
                                <i class="fas fa-plus"></i> Upload excel
                            </button>
                        </div>
                        
                    <?php }?>

                    <div class="pt-2 text-right mr-2">
                        <?php 
                        // echo '<pre>';print_r($user);die;
                        $domain_id = domain_id_get();
                        $sub_user = $this->db->where('domain_id', $domain_id)->where('type','subadmin')->get('user_master')->row_array();

                        if(($user['domain_id'] == 3 && ($user['parent_id_role'] == 1 || empty($user['parent_id']))) || $this->session->userdata('role') == 1){
                            $url = base_url('admin/indiasales-login');
                        }else{
                            if (!empty($user['parent_id_role']) || !empty($user['parent_id']) ) {
                                $this->db->select('link,user_id');
                                $this->db->where('user_id_role', $user['parent_id_role']);
                                $this->db->where('user_id', $user['parent_id']);
                                $this->db->where('domain_id', $domain_id);
                                $link_name = $this->db->get('indiasale_user_links')->row_array();
                                $url = (isset($link_name['link'])) ? $link_name['link'] : '#';
                            }else{
                                $this->db->select('link,user_id');
                                $this->db->where('user_id_role', $sub_user['role']);
                                $this->db->where('user_id', $sub_user['id']);
                                $this->db->where('domain_id', $domain_id);
                                $link_name = $this->db->get('indiasale_user_links')->row_array();
                                $url = (isset($link_name['link'])) ? $link_name['link'] : '#';
                            }
                        }
                        // print_r( $link_name);die;

                        //if(empty($user['parent_id'])  || $user['parent_id'] == $link_name['user_id'] || $user['parent_id_role'] == 1 || $this->session->userdata('role') == 1): ?>
                            <!-- <a class="btn btn-success" href="<?= $url ?>">
                                <i class="fa fa-file-text" aria-hidden="true"></i> Go to Dashboard
                            </a> -->
                        <?php //endif; ?>
                    </div>
                </div>
                <div class="">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="bg-primary">
                                <tr>
                                    <th>#</th>
                                    <th>User name</th>
                                    <th>Customer name</th>
                                    <th>Customer phone</th>
                                    <th>Lead creation date</th>
                                    <th>Lead id</th>
                                    <th>Lead remarks</th>
                                    <th>Lead status</th>
                                    <th>Lead sub status</th>
                                    <th>Member id</th>
                                    <th>Product name</th>
                                    <th>Product infocode</th>
                                    <th>Member name</th>
                                    <th>Date of sale</th>
                                    <th>Member type</th>
                                    <th>Product redirect url</th>
                                    <th>Pending Remark</th>
                                    <th>Status</th>
                                    <?php if($this->session->userdata('role') == 1) { ?>
                                    <th>Actions</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($datas as $link):
                                    ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $link->user_id ?></td>
                                        <td><?= $link->customer_name ?></td>
                                        <td><?= $link->customer_phone ?></td>
                                        <td><?= $link->lead_creation_date ?></td>
                                        <td><?= $link->lead_id ?></td>
                                        <td><?= $link->lead_remarks ?></td>
                                        <td><?= $link->lead_status ?></td>
                                        <td><?= $link->lead_sub_status ?></td>
                                        <td><?= $link->member_id ?></td>
                                        <td><?= $link->product_name ?></td>
                                        <td><?= $link->product_infocode ?></td>
                                        <td><?= $link->member_name ?></td>
                                        <td><?= $link->date_of_sale ?></td>
                                        <td><?= $link->member_type ?></td>
                                        <td><?= $link->product_redirect_url ?></td>
                                        <td><?= $link->lead_description ?></td>
                                        <td class='text-center'>
                                            <button type="button" 
                                            class="btn btn-primary open-update-modal btn-sm"
                                            data-id="<?= $link->id ?>"
                                            data-sanction="<?= $link->sanction ?>"
                                            data-disbursed="<?= $link->disbursed ?>"
                                            data-payout="<?= $link->payout ?>"
                                            data-paid="<?= $link->payment_amount_paid ?>"
                                            data-bank="<?= $link->bankModal ?>"
                                            data-status="<?= $link->status ?>"
                                            <?php if($link->status == 1){?>
                                            data-statusType="Approved"
                                            <?php }elseif($link->status == 2){?>
                                            data-statusType="Reject"
                                            <?php }else{?>
                                            data-statusType="Pending"
                                            <?php }?>
                                            data-toggle="modal" 
                                            data-target="#updateLoanModal">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                    </td>   
                                    <?php if($this->session->userdata('role') == 1) { ?>
                                        <td class='text-center'>
                                            <form action="<?= base_url('admin/deleteInstanloan/' . $link->id) ?>" method="POST" style="display: inline;">
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                        <?php } ?>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</section>

<!-- updateLoanModal -->
<div class="modal" id="updateLoanModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <?php if($this->session->userdata('role') == 1) { ?>
                 <form id="updateLoanForm" method="post"> <?php }?>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="sanction" class="form-label">Sanction amount</label>
                            <input type="text" name="sanction" id="modal_sanction" class="form-control"  value="" >
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="disbursed" class="form-label">Disbursed</label>
                            <input type="number" name="disbursed" id="modal_disbursed" class="form-control" value=""   >
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="payout" class="form-label">Payout Percentage</label>
                            <input type="text" name="payout" id="modal_payout" class="form-control"  value="" >
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="payment_amount_paid" class="form-label">Payout Amount Paid</label>
                            <input type="text" name="payment_amount_paid" id="modal_paid" class="form-control"  value="" >
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="bankModal" class="form-label">Bank Name</label>
                            <input type="text" name="bankModal" id="bankModal" class="form-control nonNumericInput"  pattern="[A-Za-z]+" value="" >
                        </div>
                        <?php if($this->session->userdata('role') == 1) { ?>
                            <div class="col-md-12 mb-3">
                                <label for="bankModal" class="form-label">Status</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="0">Select Status</option>
                                    <option value="1">Approved</option>
                                    <option value="2">Reject</option>
                                </select>
                            </div>
                        <?php }else{?>
                        <div class="col-md-12 mb-3">
                            <label for="bankModal" class="form-label">Status</label>
                            <input type="text" name="status" id="statusType" class="form-control" value="" >
                        </div>
                        <?php }?>
                    </div>
                    <?php if($this->session->userdata('role') == 1) { ?>
                    <div class="">
                        <div class="form-group">
                            <button type="submit" id="create" value="Save" class="btn btn-info mt-4">Update </button>
                        </div>
                    </div>
                </form>
                <?php }?>
            </div>
        </div>
    </div>
</div>
<!-- Add CIBIL Link Modal -->
<div class="modal fade" id="addInstanLoanModal" tabindex="-1" role="dialog" aria-labelledby="addInstanLoanModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addInstanLoanModalLabel">Add new excel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/addInstanLoan') ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                     <?php
                        if ($this->session->userdata('type') == 'admin') { ?>
                            <div class="form-group mb-2">
                                <label for="domain_id_main_modal" class="">Domain</label>
                                <select class="form-control" id="domain_id_main_modal" required name="domain_id">
                                     <option value="">Select domain</option>
                                    <?php foreach ($domains as $domain) { ?>
                                        <option value="<?= $domain['id'] ?>"> <?= $domain['url'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        <?php }else{?>
                            <input type="hidden" name="domain_id"  class="form-control" value="<?= domain_id_get() ?>" >
                        <?php }?> 
                        <?php if ($this->session->userdata('role') == 1) { ?>
                        <div class="form-group mb-2">
                            <label for="user_id" class="form-label">User</label>
                            <select id="user_id" name="user_id" class="form-control" required>
                                <option value="">Select User</option>
                                <?php if (!empty($dsa)) foreach ($dsa as $u) { ?>
                                    <option value="<?= $u->id ?>">DSA - <?= $u->name ?></option>
                                <?php } ?>

                                <?php if (!empty($branch)) foreach ($branch as $u) { ?>
                                    <option value="<?= $u->id ?>">Branch - <?= $u->name ?></option>
                                <?php } ?>

                                <?php if (!empty($team)) foreach ($team as $u) { ?>
                                    <option value="<?= $u->id ?>">Team - <?= $u->name ?></option>
                                <?php } ?>

                                <?php if (!empty($admin)) foreach ($admin as $u) { ?>
                                    <option value="<?= $u->id ?>">Subadmin - <?= $u->name ?></option>
                                <?php } ?>
                            </select>
                        </div>   
                        <?php }else{?> 
                            <input id="user_id" type="hidden" name="user_id"  class="form-control" data-role="<?= $this->session->userdata('role')?>" value="<?= $this->session->userdata('user_id')?>" >
                        <?php }?> 
                        <input type="hidden" name="user_role_id" id="user_role_id">

                    <div class="form-group">
                        <label for="files">Upload Excel</label>
                        <div class="custom-file">
                            <input type="file" class="form-control" id="files" name="files" accept=".xls,.xlsx" required>
                            <?php
                             $parent = $this->db->where('id', $this->session->userdata('user_id'))->get('user_master')->row();
                            if ($this->session->userdata('role') == 1 || (!empty($parent) && $parent->parent_id_role == 1 )) { ?>
                                <a href="<?=base_url('assets/excel_files/indiasale-admin.xlsx')?>" download="">example file</a>
                            <?php }else{?>
                                <a href="<?=base_url('assets/excel_files/indiasaleUsers.xlsx')?>" download="">example file</a>
                            <?php }?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>
<script>
    $(document).ready(function() {
    // open Update Modal
    $('.open-update-modal').on('click', function() {
        let id = $(this).data('id');
        $('#updateLoanForm').attr('action', '<?= base_url('admin/Dashboard/indiasaleupdate/') ?>' + id);

        $('#modal_sanction').val($(this).data('sanction'));
        $('#modal_disbursed').val($(this).data('disbursed'));
        $('#modal_payout').val($(this).data('payout'));
        $('#modal_paid').val($(this).data('paid'));
        $('#bankModal').val($(this).data('bank'));
        $('#status').val($(this).data('status'));
        $('#statusType').val($(this).data('statustype'));
    });

    function setUserRole() {
        let role_id = '';
        if ($('#user_id').is('select')) {
            role_id = $('#user_id').find('option:selected').data('role') || '';
        }
        else {
            role_id = $('#user_id').data('role') || '';
        }
        $('#user_role_id').val(role_id);
    }

    $(document).on('change', '#user_id', function () {
        setUserRole();
    });
     setUserRole();
}); 

$('#domain_id_main_modal').on('change', function () {
    var domain_id = $(this).val();

    $.ajax({
        url: '<?= base_url("admin/get-users-by-domain") ?>',
        type: 'POST',
        data: { domain_id: domain_id },
        dataType: 'json',
        success: function (res) {

            $('#user_id').empty().append('<option value="">Select User</option>');

            // DSA group
            if (res.dsa.length > 0) {
                var dsaGroup = $('<optgroup label="DSA" style="background:#bf941d; color:#fff;"></optgroup>');
                $.each(res.dsa, function (i, u) {
                    dsaGroup.append('<option style="background:#fff;" value="' + u.id + '"  data-role="' + u.role + '">' + u.name + '</option>');
                });
                $('#user_id').append(dsaGroup);
            }

            // Branch group
            if (res.branch.length > 0) {
                var branchGroup = $('<optgroup label="Branch" style="background:#bf941d; color:#fff;"></optgroup>');
                $.each(res.branch, function (i, u) {
                    branchGroup.append('<option style="background:#fff;" value="' + u.id + '"  data-role="' + u.role + '">' + u.name + '</option>');
                });
                $('#user_id').append(branchGroup);
            }

            // Team group
            if (res.team.length > 0) {
                var teamGroup = $('<optgroup label="Team" style="background:#bf941d; color:#fff;"></optgroup>');
                $.each(res.team, function (i, u) {
                    teamGroup.append('<option style="background:#fff;" value="' + u.id + '"  data-role="' + u.role + '">' + u.name + '</option>');
                });
                $('#user_id').append(teamGroup);
            }

        }
    });
});

</script>


<script>
  function setUserRoleWebsite() {
        let role_id = '';
        if ($('#user_id_website').is('select')) {
            role_id = $('#user_id_website').find('option:selected').data('role') || '';
        }
        else {
            role_id = $('#user_id_website').data('role') || '';
        }
        $('#user_role_id_website').val(role_id);
    }

    $(document).on('change', '#user_id_website', function () {
        setUserRoleWebsite();
    });
     setUserRoleWebsite();
$('#domain_id_main_website').on('change', function () {
    var domain_id = $(this).val();

    $.ajax({
        url: '<?= base_url("admin/get-users-by-domain") ?>',
        type: 'POST',
        data: { domain_id: domain_id },
        dataType: 'json',
        success: function (res) {

            $('#user_id_website').empty().append('<option value="">Select User</option>');

            // DSA group
            if (res.dsa.length > 0 && domain_id == 3) {
                var dsaGroup = $('<optgroup label="DSA" style="background:#bf941d; color:#fff;"></optgroup>');
                $.each(res.dsa, function (i, u) {
                    dsaGroup.append('<option style="background:#fff;" value="' + u.id + '"  data-role="' + u.role + '">' + u.name + '</option>');
                });
                $('#user_id_website').append(dsaGroup);
            }

            // Branch group
            if (res.branch.length > 0 && domain_id == 3) {
                var branchGroup = $('<optgroup label="Branch" style="background:#bf941d; color:#fff;"></optgroup>');
                $.each(res.branch, function (i, u) {
                    branchGroup.append('<option style="background:#fff;" value="' + u.id + '"  data-role="' + u.role + '">' + u.name + '</option>');
                });
                $('#user_id_website').append(branchGroup);
            }

            // Admin group
            if (res.admin.length > 0) {
                var adminGroup = $('<optgroup label="Admin" style="background:#bf941d; color:#fff;"></optgroup>');
                $.each(res.admin, function (i, u) {
                    adminGroup.append('<option style="background:#fff;" value="' + u.id + '"  data-role="' + u.role + '">' + u.name + '</option>');
                });
                $('#user_id_website').append(adminGroup);
            }
        }
    });
});

$(document).on('change', '#domain_id_main_website, #user_id_website', function () {

    let domain_id = $('#domain_id_main_website').val();
    let user_id   = $('#user_id_website').val();
    let role_id   = $('#user_role_id_website').val();
console.log(domain_id,user_id,role_id);

    if (domain_id && user_id && role_id) {
        $.ajax({
            url: "<?= base_url('admin/get-indiasale-link') ?>",
            type: "POST",
            data: {
                domain_id: domain_id,
                user_id: user_id,
                user_id_role: role_id
            },
            dataType: "json",
            success: function (res) {
                if (res.status === 'success') {
                    $('#indiasale_team_link').val(res.link);
                } else {
                    $('#indiasale_team_link').val('');
                }
            }
        });
    } else {
        $('#indiasale_team_link').val('');
    }
});
</script>
