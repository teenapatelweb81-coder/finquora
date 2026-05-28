
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
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin/Dashboard/"); ?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">My Leads</li>
           </ol>
         </nav>
</div>
<div class="container">
    <div class="row" style="margin-bottom: -90px;">
        <div class="col-md-12">
        	 <section class="content">
        	  <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-md-4">
                        <div _ngcontent-wsc-c195=""
                            class="form-group">
                            <select _ngcontent-wsc-c195="" name="myleads" id="myleads" onchange="myleadsData()" class="form-control form-control-alternative">
                                <option _ngcontent-wsc-c195="" value="today" selected="">Today</option>
                                <option _ngcontent-wsc-c195="" value="lastweek">Last Week</option>
                                <option _ngcontent-wsc-c195="" value="currentmonth">Current Month</option>
                                <option _ngcontent-wsc-c195="" value="lastmonth">Last Month</option>
                                <option _ngcontent-wsc-c195="" value="lastthreemonth">Last Three Month</option>
                                <option _ngcontent-wsc-c195="" value="qtd">Quarter to Date</option>
                                <option _ngcontent-wsc-c195="" value="ytd">Year to Date</option>
                                <option _ngcontent-wsc-c195="" value="custom">Custom</option>
                            </select>
                        </div>

                    </div>

                     <div class="col-md-4">
                        <div _ngcontent-wsc-c195=""
                            class="form-group">
                            <input type="text" id="filter-table" name="filter-table" placeholder="Search . . ." class="form-control form-control-alternative" />
                        </div>

                    </div>


                    <!--<div class="col-md-4 ">-->
                    <!--    <div _ngcontent-wsc-c195="" class="form-group">-->
                    <!--        <input _ngcontent-wsc-c195="" type="date"  placeholder="custom date" id="to_date" name="to_date"  class="form-control form-control-alternative ng-pristine ng-invalid ng-touched">-->
                    <!--    </div>-->

                    <!--</div>-->

                </div>
              </div>


            </section>
       </div>
    </div>
    <div class="row">
		<div class="col-md-12 px-0">
		    <div id="message" class="text-primary text-center"></div>
			<div class="table-responsive shadow-lg">
			<table class=" table-bordered text-center table-hover" id="dtBasicExample">
				<span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success'); ?></span>
                <span class="text-center text-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error'); ?></span>
				<thead class="text-white bg-primary">
					<tr>
						<th class=''>Sl No.</th>
						<th class=''>Process Name</th>
						<th class=''>Process Type</th>
						<th class=''>Title</th>
						<th class=''>First Name</th>
						<th class=''>Last Name</th>
						<th class=''>Loan Amount</th>
						<th class=''>Gender</th>
						<th class=''>Mobile</th>
						<th class=''>DOB</th>
						<th class=''> Branch Franchise/DSA</th>
						<th class=''>Network Member</th>
						<th class=''>Team Member</th>
						<th class=''>Datess</th>
                        <th class=''>lead Status</th>
                        <th class=''>Status</th>
                        <th class=''>Update</th>
						<th class=''>Action</th>
					</tr>
				</thead>
				<tbody id="leadBody">
					<?php
                                    if (!empty($datas)) {
                                        $num = count($datas);
                                        foreach ($datas as $data) {
                                            $user_name = '';
                                            $process = $this->db->where('id', $data->process_id)->get('loan_process')->row();
                                            $table = '';

                                            $user = $this->db->where('id', $data->uid)->where('role', 2)->get('user_master')->row();
                                            $table = 'user_master';
                                            if (empty($user)) {
                                                $user = $this->db->where('id', $data->uid)->get('branch_franchise')->row();
                                                $table = 'branch_franchise';
                                            }
                                            if (empty($user->parent_id)) {
                                                $user_name = $user;
                                            } else {
                                                $user_name = $this->db->select('name')->where('id', $user->parent_id)->where('role', 2)->get('user_master')->row();
                                                if (empty($user_name)) {
                                                    $user_name = $this->db->select('name')->where('id', $user->parent_id)->get('branch_franchise')->row();
                                                }
                                            }

        ?>
					<tr>
						<td class=''><?php echo $num; ?></td>
						<td class=''><?php if (!empty($process->process_name)) {echo $process->process_name;} else {echo 'N/A';}?></td>
						<td class=''><?php if (!empty($process->process_type)) {echo $process->process_type;} else {echo 'N/A';}?></td>
						<td class=''><?php echo ucwords($data->title); ?></td>
						<td class=''><?php echo ucwords($data->first_name); ?></td>
						<td class=''><?php echo ucwords($data->last_name); ?></td>
						<td class=''><?php echo ucwords($data->loan_amount); ?></td>
						<td class=''><?php echo ucwords($data->gender); ?></td>
						<td class=''><?php echo ucwords($data->mobile); ?></td>
						<td class=''><?php echo ucwords($data->dob); ?></td>

						<td class=''>
                            <?=($user_name) ? $user_name->name : '';?>

                        </td>

                            <?php
$team_member = '';
        $network_member = '';

        if (!empty($user)) {
            if (!empty($user->parent_id)) {
                if ($user->subscription == 'Silver' || $user->subscription == 'Platinum') {
                    $network_member = $user->username;
                } else {
                    $team_member = $user->username;
                }
            }
            $parent_id = $this->db->where('id', $user->parent_id)->get('user_master')->row();
        }

        ?>

						<td class=''><?php if (!empty($network_member)) {echo $network_member;} else {echo 'N/A';}?></td>
						<td class=''><?php if (!empty($team_member)) {echo $team_member;} else {echo 'N/A';}?></td>
						<td class=''><?php echo ucwords($data->created_on); ?></td>
                        <td class=''><?php echo ucwords($data->lead_status); ?></td>
                       
						<td class=''><?php if ($data->status == 1) {echo 'Active';} else {echo 'Inactive';}?></td>


        <?php if ($this->session->userdata('role') == 1) {?>
        <td class=''>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModalAdmin<?=$data->id?>">Update By Admin</button>
        </td>
        <?php }?>


        <?php if ($this->session->userdata('role') != 1) {?>
                <td class=''>

            <?php if ((empty($user->parent_id) || $user->parent_id == '' || $user->parent_id == 0) && ($data->uid == $this->session->userdata('user_id'))) {?>
                    <button type="button" class="btn btn-primary mt-2" data-toggle="modal" data-target="#myModalAdmin<?=$data->id?>">View Main user</button>
            <?php } else {?>

                <?php if (!empty($user->user_type) && empty($main_user->parent_id) || $main_user->parent_id == '' || $main_user->parent_id == 0) {?>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModalUser<?=$data->id?>">Update Main user</button>
                    <button type="button" class="btn btn-primary mt-2" data-toggle="modal" data-target="#myModalAdmin<?=$data->id?>">admin View</button>
                <?}else{?>
                    <button type="button" class="btn btn-primary mt-2" data-toggle="modal" data-target="#myModalUserTeam<?=$data->id?>">View</button>
                <?php }?>
            </td>
            <?php }}?>


    <div class="modal" id="myModalAdmin<?=$data->id?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form action = "<?=base_url('admin/Dashboard/dis_leads_update/')?><?=$data->id?>" method="post">
                        <div class="row">
                        <input type="hidden" name="sanction_team" value="<?=$data->sanction_team?>" >
                        <input type="hidden" name="disbursed_team" value="<?=$data->disbursed_team?>" >
                        <input type="hidden" name="payout_team" value="<?=$data->payout_team?>" >
                        <input type="hidden" name="payment_amount_paid_team" value="<?=$data->payment_amount_paid_team?>" >
                        <input type="hidden" name="bankModal_team" value="<?=$data->bankModal_team?>" >


                            <div class="col-md-12 mb-3">
                                <label for="sanction" class="form-label">Sanction amount<span class="text-danger">*</span></label>
                                <input type="text" name="sanction" id="sanction" class="form-control"  value="<?=$data->sanction?>" >
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="disbursed" class="form-label">Disbursed<span class="text-danger">*</span></label>
                                <input type="number" name="disbursed" id="disbursed" class="form-control" value="<?=$data->disbursed?>"   >
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="payout" class="form-label">Payout Percentage<span class="text-danger">*</span></label>
                                <input type="text" name="payout" id="payout" class="form-control"  value="<?=$data->payout?>" >
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="payment_amount_paid" class="form-label">Payout Amount Paid<span class="text-danger">*</span></label>
                                <input type="text" name="payment_amount_paid" id="payment_amount_paid" class="form-control"  value="<?=$data->payment_amount_paid?>" >
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="bankModal" class="form-label">Bank Name<span class="text-danger">*</span></label>
                                <input type="text" name="bankModal" id="bankModal" class="form-control" value="<?=$data->bankModal?>" >
                            </div>

                            <?php if ($this->session->userdata('role') == 1) {?>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button id="create" value="Save" class="btn btn-info mt-4">Update </button>
                                </div>
                            </div>
                            <?php }?>

                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>



        <div class="modal" id="myModalUser<?=$data->id?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form action = "<?=base_url('admin/Dashboard/dis_leads_update/')?><?=$data->id?>" method="post">
                        <div class="row">

                            <input type="hidden" name="sanction" value="<?=$data->sanction?>" >
                            <input type="hidden" name="disbursed" value="<?=$data->disbursed?>" >
                            <input type="hidden" name="payout" value="<?=$data->payout?>" >
                            <input type="hidden" name="payment_amount_paid" value="<?=$data->payment_amount_paid?>" >
                            <input type="hidden" name="bankModal" value="<?=$data->bankModal?>" >


                            <div class="col-md-12 mb-3">
                                <label for="sanction_team" class="form-label">Sanction amount<span class="text-danger">*</span></label>
                                <input type="text" name="sanction_team" id="sanction_team" class="form-control"  value="<?=$data->sanction_team?>" >
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="disbursed_team" class="form-label">Disbursed<span class="text-danger">*</span></label>
                                <input type="number" name="disbursed_team" id="disbursed_team" class="form-control" value="<?=$data->disbursed_team?>"   >
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="payout_team" class="form-label">Payout Percentage<span class="text-danger">*</span></label>
                                <input type="text" name="payout_team" id="payout_team" class="form-control"  value="<?=$data->payout_team?>" >
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="payment_amount_paid_team" class="form-label">Payout Amount Paid<span class="text-danger">*</span></label>
                                <input type="text" name="payment_amount_paid_team" id="payment_amount_paid_team" class="form-control"  value="<?=$data->payment_amount_paid_team?>" >
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="bankModal_team" class="form-label">Bank Name<span class="text-danger">*</span></label>
                                <input type="text" name="bankModal_team" id="bankModal_team" class="form-control" value="<?=$data->bankModal_team?>" >
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button id="create" value="Save" class="btn btn-info mt-4"> Update</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>


        <div class="modal" id="myModalUserTeam<?=$data->id?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form action = "<?=base_url('admin/Dashboard/dis_leads_update/')?><?=$data->id?>" method="post">
                        <div class="row">

                            <input type="hidden" name="sanction" value="<?=$data->sanction?>" >
                            <input type="hidden" name="disbursed" value="<?=$data->disbursed?>" >
                            <input type="hidden" name="payout" value="<?=$data->payout?>" >
                            <input type="hidden" name="payment_amount_paid" value="<?=$data->payment_amount_paid?>" >
                            <input type="hidden" name="bankModal" value="<?=$data->bankModal?>" >


                            <div class="col-md-12 mb-3">
                                <label for="sanction_team" class="form-label">Sanction amount<span class="text-danger">*</span></label>
                                <input type="text" name="sanction_team" id="sanction_team" class="form-control"  value="<?=$data->sanction_team?>" >
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="disbursed_team" class="form-label">Disbursed<span class="text-danger">*</span></label>
                                <input type="number" name="disbursed_team" id="disbursed_team" class="form-control" value="<?=$data->disbursed_team?>"   >
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="payout_team" class="form-label">Payout Percentage<span class="text-danger">*</span></label>
                                <input type="text" name="payout_team" id="payout_team" class="form-control"  value="<?=$data->payout_team?>" >
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="payment_amount_paid_team" class="form-label">Payout Amount Paid<span class="text-danger">*</span></label>
                                <input type="text" name="payment_amount_paid_team" id="payment_amount_paid_team" class="form-control"  value="<?=$data->payment_amount_paid_team?>" >
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="bankModal_team" class="form-label">Bank Name<span class="text-danger">*</span></label>
                                <input type="text" name="bankModal_team" id="bankModal_team" class="form-control" value="<?=$data->bankModal_team?>" >
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
						<td>
					        <a href="<?php echo base_url('admin/edit-lead/') . $data->id; ?>"><i class="fa fa-pencil-square-o text-primary fa-lg" aria-hidden="true"></i></a>

					        <!--<a href="javascript:void(0)" id="<?=$data->id?>" class="cremove"><i class="fa fa-trash text-danger fa-lg" aria-hidden="true"></i></a> -->

					        <!--<a href="#"><i class="fa fa-pencil-square-o text-primary fa-lg" aria-hidden="true"></i></a>-->
					        <a href="#" ><i class="fa fa-trash text-danger fa-lg" aria-hidden="true" onclick="delLead(<?=$data->id?>)"></i></a>
					   </td>

					</tr>
				   <?php $num--;}}?>

				</tbody>
			</table>
			</div>
		</div>
	</div>

</div>

<script>
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