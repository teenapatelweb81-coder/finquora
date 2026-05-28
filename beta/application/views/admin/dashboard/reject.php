<style>
    .col-md-12 .mb-3{
        text-align: left !important;
    }
</style>

<?php
$main_user = $this->db->where('id', $this->session->userdata('user_id'))->get('user_master')->row();
if (empty($main_user)) {
    $main_user = $this->db->where('id', $this->session->userdata('user_id'))->get('branch_franchise')->row();
}
?>

<div class="container-fluid p-0">
     <nav aria-label="breadcrumb">
        <ol class="breadcrumb ">
           <li class="breadcrumb-item "><a href="<?=base_url("admin/Dashboard/");?>" class="text-decoration-none">Home</a></li>
           <li class="breadcrumb-item active" aria-current="page"><?=ucwords($_GET['role']);?> Rejected Leads</li>
       </ol>
     </nav>
</div>

<div class="container-fluid">
    <div class="row">
		<div class="col-md-12 px-0">
		    <div id="message" class="text-primary text-center"></div>
			
            <div class="table-responsive shadow-lg">
			<table class=" table-bordered text-center table-hover" id="dtBasicExample">

				<span class="text-center text-info mb-2"><?= $this->session->flashdata('success'); ?></span>
                <span class="text-center text-danger mb-2"><?= $this->session->flashdata('error'); ?></span>

				<thead class="text-white bg-primary">
					<tr>
						<th>Sl No.</th>
						<th>Process Name</th>
						<th>Process Type</th>
						<th>Title</th>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Loan Amount</th>
						<th>Gender</th>
						<th>Mobile</th>
						<th>DOB</th>
						<th>Branch Franchise/DSA</th>
						<th>Network Member</th>
						<th>Team Member</th>
						<th>Date</th>
                        <th>Lead Status</th>
                        <th>Status</th>
                        <!-- <th>Update</th> -->
						<th>Action</th>
					</tr>
				</thead>

				<tbody>

					<?php
                       $role = isset($_GET['role']) ? $_GET['role'] : '';
                        $type = isset($_GET['user']) ? $_GET['user'] : '';

                        if ($role === 'paper' && $type === 'team') {
                            $datas = $team_reject_lead_paper;

                        } elseif ($role === 'digital' && $type === 'team') {
                            $datas = $team_reject_lead_digital;

                        } elseif ($role === 'paper') {
                            $datas = $paper_reject;

                        } else {
                            $datas = $digital_reject;
                        }

                    if (!empty($datas)) {
                        $num = count($datas);

                        foreach ($datas as $data) {

                            $process = $this->db->where('id',$data->process_id)->get('loan_process')->row();

                            $user = $this->db->where('id',$data->uid)->where('role',$data->uid_role)->get('user_master')->row();
                            if(empty($user)){
                                $user = $this->db->where('id',$data->uid)->get('branch_franchise')->row();
                            }

                            if(empty($user->parent_id)){
                                $user_name = $user;
                            } else {
                                $user_name = $this->db->select('name')->where('id',$user->parent_id)->where('role',2)->get('user_master')->row();
                                if(empty($user_name)){
                                    $user_name = $this->db->select('name')->where('id',$user->parent_id)->get('branch_franchise')->row();
                                }
                            }

                            $network_member = ($user->subscription=='Silver'||$user->subscription=='Platinum') ? $user->username : 'N/A';
                            $team_member = ($user->subscription!='Silver' && $user->subscription!='Platinum') ? $user->username : 'N/A';

                          
                    ?>

                <tr>
                    <td><?=$num;?></td>
                    <td><?=!empty($process->process_name)?$process->process_name:'N/A';?></td>
                    <td><?=!empty($process->process_type)?$process->process_type:'N/A';?></td>
                    <td><?=ucwords($data->title);?></td>
                    <td><?=ucwords($data->first_name);?></td>
                    <td><?=ucwords($data->last_name);?></td>
                    <td><?=$data->loan_amount;?></td>
                    <td><?=$data->gender;?></td>
                    <td><?=$data->mobile;?></td>
                    <td><?=$data->dob;?></td>

                    <td><?=$user_name->name ?? '';?></td>
                    <td><?=$network_member;?></td>
                    <td><?=$team_member;?></td>

                    <td><?=$data->created_on;?></td>
                    <td><?=$data->lead_status;?></td>

                    <td><?=$data->status==1?'Active':'Inactive';?></td>

                    <!-- <td>
                        <button 
                            class="btn btn-primary openAdminModal"
                            data-id="<?=$data->id?>"
                            data-sanction="<?=$data->sanction?>"
                            data-disbursed="<?=$data->disbursed?>"
                            data-payout="<?=$data->payout?>"
                            data-paid="<?=$data->payment_amount_paid?>"
                            data-bank="<?=$data->bankModal?>"
                        >Update</button>
                    </td> -->

                    <td>
                        <a href="<?=base_url('admin/edit-lead/'.$data->id);?>">
                            <i class="fa fa-pencil-square-o text-primary fa-lg"></i>
                        </a>
                        <a href="#" onclick="delLead(<?=$data->id?>)">
                            <i class="fa fa-trash text-danger fa-lg"></i>
                        </a>
                    </td>
                </tr>

                <?php $num--; }} ?>

				</tbody>

			</table>
			</div>
		</div>
	</div>
</div>

<!-- UNIVERSAL ADMIN MODAL -->
<div class="modal fade" id="adminModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <form method="POST" id="adminForm">

                <div class="modal-header">
                    <h5 class="modal-title">Update Lead</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">

                    <input type="hidden" name="lead_id" id="modal_lead_id">

                    <div class="col-md-12 mb-3">
                        <label>Sanction Amount</label>
                        <input type="text" name="sanction" id="modal_sanction" class="form-control">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label>Disbursed</label>
                        <input type="text" name="disbursed" id="modal_disbursed" class="form-control">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label>Payout %</label>
                        <input type="text" name="payout" id="modal_payout" class="form-control">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label>Amount Paid</label>
                        <input type="text" name="payment_amount_paid" id="modal_paid" class="form-control">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label>Bank Name</label>
                        <input type="text" name="bankModal" id="modal_bank" class="form-control">
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-info">Update</button>
                </div>

            </form>

        </div>
    </div>
</div>



<script>
$('.openAdminModal #modal_lead_id #modal_sanction #modal_disbursed #modal_payout #modal_paid #modal_bank').on('click', function () {

    $('#adminModal').modal('show');
    console.log($(this).data());
    
    $('#modal_lead_id').val($(this).data('id'));
    $('#modal_sanction').val($(this).data('sanction'));
    $('#modal_disbursed').val($(this).data('disbursed'));
    $('#modal_payout').val($(this).data('payout'));
    $('#modal_paid').val($(this).data('paid'));
    $('#modal_bank').val($(this).data('bank'));

    $('#adminForm').attr('action', '<?=base_url("admin/Dashboard/dis_leads_update/")?>' + $(this).data('id'));

});
</script>
<script>
// $("#adminForm").on("submit", function(e){
//     e.preventDefault();

//     let form = $(this);
//     let actionUrl = form.attr("action");

//     $.ajax({
//         url: actionUrl,
//         type: "POST",
//         data: form.serialize(),
//         success: function(response){

//             // response == "yes" check
//             if(response.trim() === "yes"){
//                 alert("Updated Successfully!");

//                 // Close Modal
//                 $("#adminModal").modal("hide");

//                 // Refresh Page
//                 location.reload();
//             }
//             else {
//                 alert("Error: " + response);
//             }
//         },
//         error: function(){
//             alert("Something went wrong!");
//         }
//     });
// });
</script>



<script>
$(document).ready(function(){
    $('#dtBasicExample').DataTable({"order":[[0,'desc']]});
});
</script>
