
<style>
    iframe {
        width: 200px !important;
        height: 100px !important;
    }
</style>
<div class="container-fluid p-0">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin/Dashboard/"); ?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Bank login list</li>
           </ol>
         </nav>
</div>
<div class="container-fluid px-0">

    
    <div class="row m-0">
		<div class="col-md-12 px-0">
              

			<div class="table-responsive ">
			<table class=" table-bordered text-center table-hover" id="dtBasicExample">
				<span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success'); ?></span>
                <span class="text-center text-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error'); ?></span>
				<thead class="text-white bg-primary">
					<tr>
						<th class=''>Sr No.</th>
						<th class=''>Lead No </th>
                        <?php if ($this->session->userdata('role') == 1) {?>
                            <th class=''>Users Name</th>
                            <?php }?>
						<th class=''>Loan Type</th>
                        <th class=''>Loan Amount</th>
                        <th class=''>Lead Date</th>
                        <th class=''>Client Name</th>
                        <th class=''>Mobile No</th>
                         <th class=''>Member</th>
                        <th class=''>Allocated To</th>
                        <th class=''>Lead Feedback</th>
                         <?php if ($this->session->userdata('role') == 1) {?>
                        <th class=''>Update</th>
                        <?php }?>
						<th class=''>Remarks</th>
                        <?php if ($this->session->userdata('role') != 1) {?>
                            <th class=''>Sanction amount </th>
                            <th class=''>Payout Percentage</th>
                            <th class=''>Payout Amount Paid</th>
                            <th class=''>Disbursed</th>
                            <th class=''>Bank Name</th>
                            <th class=''>Edit</th>



                        <?php }?>
                        <th class=''>View</th>
					</tr>
				</thead>
				<tbody id="leadBody">
					<?php
                        if (!empty($loans)) {
                        $i = count($loans);
                        foreach ($loans as $loan) {

                            $user = $this->db->where('id', $loan['user_id'])->where('role',2)->get('user_master')->row_array();
                            $user1 = $this->db->where('id', $loan['user_id'])->where('role',3)->get('branch_franchise')->row_array();
                            if (!empty($user['username'])) {
                                $b = $user['username'];
                            } elseif (!empty($user1['username']) && empty($user['username'])) {
                                $b = $user1['username'];
                            }else {
                                $b ='';
                            } 
                            if (!empty($loan['parent_id']) == '') {
                                $c = 'Registered User';
                            } elseif (!empty($loan['subscription']) != '') {
                                if (!empty($loan['parent_id']) != '') {
                                    $c = 'Network Member';
                                }
                            } elseif (!empty($loan['parent_id']) != '') {
                                if (!empty($loan['subscription']) == '') {
                                    $c = 'Team Member';
                                }
                            }
                        ?>
					<tr>
						<td class=''><?=$i?></td>
						<td class=''><?=10001 + $loan['id']?></td>
                        <?php if ($this->session->userdata('role') == 1) {?>
                        <td class=''><?=$b?></td>
                        <?php }?>
                        <td class=''><?=$loan['apply_for_loan']?></td>
						<td class=''><?=$loan['loan_amount_req']?></td>
                        <td class=''><?=date('d/m/Y', strtotime($loan['created_at']))?></td>
                        <td class=''><?=$loan['client_name']?></td>
                        <td class=''><?=$loan['clientnumber']?></td>
                        <td class=''><?=$c?></td>
                        <td class=''><?=$loan['rm_assign']?></td>
                        <td class=''><?=$loan['lead_feedback']?></td>
                         <?php if ($this->session->userdata('role') == 1) {?>
                        <td class=''>
                            <button type="button" 
                                class="btn btn-primary open-update-modal"
                                data-id="<?= $loan['id'] ?>"
                                data-sanction="<?= $loan['sanction'] ?>"
                                data-disbursed="<?= $loan['disbursed'] ?>"
                                data-payout="<?= $loan['payout'] ?>"
                                data-paid="<?= $loan['payment_amount_paid'] ?>"
                                data-bank="<?= $loan['bankModal'] ?>"
                                data-payout_team="<?= $loan['payout_team'] ?>"
                                data-sanction_team="<?= $loan['sanction_team'] ?>"
                                data-payment_amount_paid_team="<?= $loan['payment_amount_paid_team'] ?>"
                                data-toggle="modal" 
                                data-target="#updateLoanModal">
                                Update
                            </button>
                            <?php if (empty($b)) {?>
                            <button type="button"
                                class="btn btn-primary open-assign-modal"
                                data-id="<?= $loan['id'] ?>"
                                data-toggle="modal"
                                data-target="#assignLeadModal">
                                Assign Leads
                            </button>
                            <?php }?>
                        </td>
                        <?php }?>
                        <td class=''><?=$loan['admin_remark']?></td>

                         <?php if ($this->session->userdata('role') != 1 && empty($user['parent_id'])) {
            // echo 'hii';
            ?>
                            <td class=''><?=$loan['sanction']?></td>
                            <td class=''><?=$loan['payout']?></td>
                            <td class=''><?=$loan['payment_amount_paid']?></td>
                            <td class=''><?=$loan['disbursed']?></td>
                            <td class=''><?=$loan['bankModal']?></td>

                        <?php } else if ($this->session->userdata('role') != 1) {

            ?>
                            <td class=''><?=$loan['sanction_team']?></td>
                            <td class=''><?=$loan['payout_team']?></td>
                            <td class=''><?=$loan['payment_amount_paid_team']?></td>
                            <td class=''><?=$loan['disbursed_team']?></td>
                            <td class=''><?=$loan['bankModal_team']?></td>
                       <?php }?>

                        <?php if ($this->session->userdata('role') != 1) {?>
                        <td>
                            <?php if ($loan['apply_for_loan'] == 'Instant Loan') {?>
					            <a href="<?php echo base_url('admin/creditCardUpdate/') . $loan['id']; ?>"><i class="fa fa-pencil-square-o text-primary fa-lg" aria-hidden="true"></i></a>
                           <?php } elseif ($loan['apply_for_loan'] == 'Business Loan') {?>
                                <a href="<?php echo base_url('admin/businessUpdate/') . $loan['id']; ?>"><i class="fa fa-pencil-square-o text-primary fa-lg" aria-hidden="true"></i></a>
                            <?php } elseif ($loan['apply_for_loan'] == 'Home Loan') {?>
                                <a href="<?php echo base_url('admin/homeloanUpdate/') . $loan['id']; ?>"><i class="fa fa-pencil-square-o text-primary fa-lg" aria-hidden="true"></i></a>
                           <?php } else {?>
                                <a href="<?php echo base_url('admin/loan-edit/') . $loan['id']; ?>"><i class="fa fa-pencil-square-o text-primary fa-lg" aria-hidden="true"></i></a>
                             <?php }?>
                        </td>

                        <?php }?>
                        <td>
                            <?php if ($loan['apply_for_loan'] == 'Instant Loan') {?>
                               <a href="<?php echo base_url('admin/creditCardView/') . $loan['id']; ?>" ><i class="fa fa-eye text-danger fa-lg" aria-hidden="true" onclick="delLead"></i></a>
                            <?php } elseif ($loan['apply_for_loan'] == 'Business Loan') {?>
                                <a href="<?php echo base_url('admin/businessView/') . $loan['id']; ?>"><i class="fa fa-eye text-danger fa-lg" aria-hidden="true" onclick="delLead"></i></a>
                            <?php } else {?>
					        <a href="<?php echo base_url('admin/loan-view/') . $loan['id']; ?>" ><i class="fa fa-eye text-danger fa-lg" aria-hidden="true" onclick="delLead"></i></a>
                            <?php }?>
					   </td>

                    



                         <?php $i--;}?>
					</tr>
				    <?php } ?>
				</tbody>
			</table>
			</div>
		</div>
	</div>

        </div>



<div class="modal" id="updateLoanModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                 <form id="updateLoanForm" method="post">
                    <div class="row">

                        <input type="hidden" name="payout_team" id="modal_payout_team" class="form-control"  value="" >
                        <input type="hidden" name="sanction_team" id="modal_sanction_team" class="form-control"  value="" >
                        <input type="hidden" name="payment_amount_paid_team" id="modal_payment_amount_paid_team" class="form-control"  value="" >

                        <div class="col-md-12 mb-3">
                            <label for="sanction" class="form-label">Sanction amount<span class="text-danger">*</span></label>
                            <input type="text" name="sanction" id="modal_sanction" class="form-control"  value="" >
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="disbursed" class="form-label">Disbursed<span class="text-danger">*</span></label>
                            <input type="number" name="disbursed" id="modal_disbursed" class="form-control" value=""   >
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="payout" class="form-label">Payout Percentage<span class="text-danger">*</span></label>
                            <input type="text" name="payout" id="modal_payout" class="form-control"  value="" >
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="payment_amount_paid" class="form-label">Payout Amount Paid<span class="text-danger">*</span></label>
                            <input type="text" name="payment_amount_paid" id="modal_paid" class="form-control"  value="" >
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="bankModal" class="form-label">Bank Name<span class="text-danger">*</span></label>
                            <input type="text" name="bankModal" id="bankModal" class="form-control nonNumericInput"  pattern="[A-Za-z]+" value="" >
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit" id="create" value="Save" class="btn btn-info mt-4">Update </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="assignLeadModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Select Any DSA/Branch</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                 <form id="assignLeadForm" method="post">
                    <div class="row">

                        <input type="hidden" id="assign_loan_id" name="id" class="form-control"  value="" >

                        <div class="col-md-12 mb-3">
                            <label for="user_id" class="form-label">DSA/Branch<span class="text-danger">*</span></label>
                            <select _ngcontent-wsc-c195="" name="user_id"  class="form-control form-control-alternative">
                                <option _ngcontent-wsc-c195="" value="" selected="">Select DSA/Branch</option>

                                <option  disabled  style="background:#f2b23e!important;">DSA Name</option>
                                    <?php 
                                        if(!empty($dsa_users)){
                                        foreach($dsa_users as $dsa_user){
                                    ?>
                                    <option _ngcontent-wsc-c195="" value="<?= $dsa_user->id?>" ><?= $dsa_user->username ?></option>
                                    <?php }}?>

                                <option disabled  style="background:#f2b23e!important;" >Branch Name</option>
                                    <?php 
                                        if(!empty($branch_users)){
                                        foreach($branch_users as $branch_user){
                                    ?>
                                    <option _ngcontent-wsc-c195="" value="<?= $branch_user->id?>" ><?= $branch_user->username?></option>
                                    <?php }}?>



                            </select>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit" id="create" value="Save" class="btn btn-info mt-4">Assign </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>

    
<script>
    $(document).ready(function() {
    // open Update Modal
    $('.open-update-modal').on('click', function() {
        let id = $(this).data('id');
        $('#updateLoanForm').attr('action', '<?= base_url('admin/Dashboard/dis_update/') ?>' + id);

        $('#modal_sanction').val($(this).data('sanction'));
        $('#modal_disbursed').val($(this).data('disbursed'));
        $('#modal_payout').val($(this).data('payout'));
        $('#modal_paid').val($(this).data('paid'));
        $('#bankModal').val($(this).data('bank'));

        $('#modal_payment_amount_paid_team').val($(this).data('payment_amount_paid_team'));
        $('#modal_sanction_team').val($(this).data('sanction_team'));
        $('#modal_payout_team').val($(this).data('payout_team'));
    });

    // open Assign Modal
    $('.open-assign-modal').on('click', function() {
        let id = $(this).data('id');
        $('#assignLeadForm').attr('action', '<?= base_url('admin/Dashboard/assign_lead/') ?>' + id);
        $('#assign_loan_id').val(id);
    });

    // allow only letters in bank name
    $('.nonNumericInput').on('input', function() {
        $(this).val($(this).val().replace(/[^a-zA-Z ]/g, ''));
    });
});

    $(document).ready(function () {
        $('#dtBasicExample').DataTable({
            "order": [[ 0, 'desc' ]]
        });
        $('.dataTables_length').addClass('bs-select');
    });

</script>




<script>

    function myleadsData() {
        var leadTime = $('#myleads').find(":selected").val();
        var to_date = "2023-02-04";
         //var to_date =  $('#to_date').val();
        //  var to_date = new Date($('#to_date').val());
        //       var day = $('#date-input').getDate();
        //       var month = $('#date-input').getMonth() + 1;
        //       var year = $('#date-input').getFullYear();
        //       alert(day+"/"+ month+"/"+year);

        // if(leadTime == "custom" && (to_date == "" ||  to_date == undefined) {
        //     alert("Please choose custom date");
        // }

        //alert(to_date);
        var str = "";
        $("#leadBody").empty();

        if(leadTime) {
            $.ajax({
                type: 'POST',
                url: 'get-leads-data',
                data: {
                    'leadTime': leadTime,
                    'customDate' : to_date

                },
                success: function(result){
                    var obj = JSON.parse(result);
                    console.log(obj)
                    if(obj.lead_data.length > 0) {

                        $.each(obj.lead_data, function(index, element) {
                            str += '<tr>' ;
                            str += '<td>' + ++index + '</td>';
                            str += '<td>' + element.process_id + '</td>';
                            str += '<td>' + element.title + '</td>';
                            str += '<td>' + element.title + '</td>';
                            str += '<td>' + element.first_name + '</td>';
                            str += '<td>' + element.last_name + '</td>';
                            str += '<td>' + element.loan_amount + '</td>';
                            str += '<td>' + element.gender + '</td>';
                            str += '<td>' + element.mobile + '</td>';
                            str += '<td>' + element.dob + '</td>';

                            str += '<td><a href="<?php echo base_url("admin/edit-lead/"); ?>"'+ element.id +'><i class="fa fa-pencil-square-o text-primary fa-lg" aria-hidden="true"></i></a>';
                            str += '<a href="#" ><i class="fa fa-trash text-danger fa-lg" aria-hidden="true" onclick="delLead('+ element.id +')"></i></a></td>';

        //                     <td>
					   //     <a href="<?php echo base_url('admin/edit-user/') . $data->id; ?>"><i class="fa fa-pencil-square-o text-primary fa-lg" aria-hidden="true"></i></a>
					   //     <a href="#" ><i class="fa fa-trash text-danger fa-lg" aria-hidden="true" onclick="delUser(<?=$data->id?>)"></i></a>
					   //</td>

                            str += '</tr>';
                        });
                         $('#leadBody').append(str);

                    }
                    else {
                         str += '<tr><td colspan="12">No data found</td></tr>' ;
                         $('#leadBody').append(str);

                    }


                },
                error: function (error) {
                    alert("server error");
                }
            });

        }

    }


    $(document).ready(function(){
  $("#filter-table").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#leadBody tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});


</script>

<script>
$(document).ready(function(){
    $('.nonNumericInput').on('input', function() {
         $(this).val($(this).val().replace(/[^a-zA-Z]/g, ''));
    });
});
</script>