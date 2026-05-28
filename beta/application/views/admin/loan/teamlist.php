
<style>
    iframe {
        width: 200px !important;
        height: 100px !important;
    }
</style>

<div class="container-fluid p-0">
    <nav aria-label="breadcrumb">
    <ol class="breadcrumb ">
        <li class="breadcrumb-item "><a href="<?php echo base_url("admin/Dashboard/");?>" class="text-decoration-none">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Loan Master</li>
    </ol>
    </nav>
</div>
<div class="container-fluid px-0">
    <div class="row m-0">
		<div class="col-md-12 px-0">
			<div class="table-responsive ">
			<table class=" table-bordered text-center table-hover" id="dtBasicExample"> 
				<span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>                     
                <span class="text-center text-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error');?></span>			         	
				<thead class="text-white bg-primary">
					<tr>
						<th class=''>Sr No.</th>
						<th class=''>Lead No </th>
                        <th class=''>DSA Name</th>
						<th class=''>Loan Type</th>
                        <th class=''>Loan Amount</th>
                        <th class=''>Lead Date</th>	
                        <th class=''>Client Name</th>	
                        <th class=''>Mobile No</th>	
                         <th class=''>Member</th>
                        <th class=''>Allocated To</th>	
                        <th class=''>Lead Feedback</th>
                        <th class=''>Update</th>
						<th class=''>Remarks</th>
                        <?php if ($this->session->userdata('role') != 1) {?>
                            <th class=''>Sanction amount </th>
                            <th class=''>Payout Percentage</th>
                            <th class=''>Payout Amount Paid</th>
                            <th class=''>Disbursed</th>
                            <th class=''>Bank Name</th>
                        <?php }?>
                        <th class=''>View</th>
					</tr>
				</thead>
				<tbody id="leadBody">
					<?php
                       $branch = $this->db->where('id',$this->session->userdata('user_id'))->get('branch_franchise')->row_array(); 
                       if (!empty($branch) ) {
                        if ($branch['parent_id'] == '' || $branch['parent_id'] == 0 ) {
                           $branch_head = 'yes';
                        }else{
                            $branch_head = 'no';
                        }
                       }else{
                            $branch_head = 'no';
                        } 
                        // print_r($branch);die;
					if(!empty($loans)) {
					 $i = count($loans) ; 
					foreach($loans as $loan) {
                        // if($loan['rm_assign'] == 793){
                        //     $a = 'sandhya prasad';
                        // }else{
                        //     $a ='';
                        // }
                        
                        $user = $this->db->where('id',$loan['user_id'])->get('user_master')->row_array();                       
                    //    print_r( $user['parent_id']);die;
                       if (!empty($user['username'])) {
                        $b =$user['username'];
                       }else {
                        $b = '';
                       }
                    
                        if($user['subscription'] == '' && $user['parent_id'] != ''){
                            $c = 'Team Member';
                        }else if($user['subscription'] != '' && $user['parent_id'] != ''){
                              $c = 'Network Member';
                        }else{
                                $c = 'channel Partner';
                        }
                        ?>
					<tr>
						<td class=''><?= $i?></td>						
						<td class=''><?= 10001+$loan['id']?></td>	
                        <?php //if($this->session->userdata('role') == 1){?>
                        <td class=''><?= $b?></td>	
                        <?php //}?>
                        <td class=''><?= $loan['apply_for_loan'] ?></td>				
						<td class=''><?= $loan['loan_amount_req']?></td>
                        <td class=''><?= date('d/m/Y',strtotime($loan['created_at']))?></td>
                        <td class=''><?= $loan['client_name']?></td>

                        <td class=''><?= $loan['clientnumber']?></td>
                        <td class=''><?= $c?></td>
                        <td class=''><?=  $loan['rm_assign'] ?></td>
                        <td class=''><?= $loan['lead_feedback'] ?></td>
                        <td class=''> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal<?= $loan['id']?>">Update</button></td>
                            <td class=''><?= $loan['admin_remark']?></td>


                         <?php if ($this->session->userdata('role') != 1 &&  $branch_head == 'yes') { ?>
                            <td class=''><?= $loan['sanction'] ?></td>
                            <td class=''><?= $loan['payout'] ?></td>
                            <td class=''><?= $loan['payment_amount_paid'] ?></td>
                            <td class=''><?= $loan['disbursed'] ?></td>
                            <td class=''><?= $loan['bankModal'] ?></td>
                        <?php }else {?>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                       <?php  }?>

                       

                        <td>
                            <?php if ( $loan['apply_for_loan'] == 'Credit Card') {?>
                               <a href="<?php echo base_url('admin/creditCardView/').$loan['id'];?>" ><i class="fa fa-eye text-danger fa-lg" aria-hidden="true" onclick="delLead"></i></a>
                            <?php }elseif ($loan['apply_for_loan'] == 'Business Loan') {?>
                                <a href="<?php echo base_url('admin/businessView/').$loan['id'];?>"><i class="fa fa-eye text-danger fa-lg" aria-hidden="true" onclick="delLead"></i></a>
                            <?php }else{?>
					        <a href="<?php echo base_url('admin/loan-view/').$loan['id'];?>" ><i class="fa fa-eye text-danger fa-lg" aria-hidden="true" onclick="delLead"></i></a>
                            <?php }?>
					   </td>

                    <div class="modal" id="myModal<?= $loan['id']?>">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title"></h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <form action = "<?= base_url('admin/Dashboard/dis_update/')?><?= $loan['id']?>" method="post">
                                        <div class="row">
                                        <input type="hidden" name="payout" id="payout" class="form-control"  value="<?= $loan['payout'] ?>" >
                                         <input type="hidden" name="sanction" id="sanction" class="form-control"  value="<?= $loan['sanction'] ?>" >
                                          <input type="hidden" name="payment_amount_paid" id="payment_amount_paid" class="form-control"  value="<?= $loan['payment_amount_paid'] ?>" >
                                           <input type="hidden" name="bankModal" id="bankModal" class="form-control"  value="<?= $loan['bankModal'] ?>" >
                                            
                                            <div class="col-md-12 mb-3">
                                                <label for="sanction" class="form-label">Sanction amount<span class="text-danger">*</span></label>
                                                <input type="text" name="sanction_team" id="sanction" class="form-control"  value="<?= $loan['sanction_team']?>" >
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label for="disbursed" class="form-label">Disbursed<span class="text-danger">*</span></label>
                                                <input type="number" name="disbursed_team" id="disbursed" class="form-control" value="<?= $loan['disbursed_team']?>"   >
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label for="payout" class="form-label">Payout Percentage<span class="text-danger">*</span></label>
                                                <input type="text" name="payout_team" id="payout" class="form-control"  value="<?= $loan['payout_team'] ?>" >
                                            </div>
                                           
                                             <div class="col-md-12 mb-3">
                                                <label for="payment_amount_paid_team" class="form-label">Payout Amount Paid<span class="text-danger">*</span></label>
                                                <input type="text" name="payment_amount_paid_team" id="payment_amount_paid_team" class="form-control"  value="<?= $loan['payment_amount_paid_team'] ?>">
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label for="bankModal" class="form-label">Bank Name<span class="text-danger">*</span></label>
                                                <input type="text" name="bankModal_team" id="bankModal" class="form-control nonNumericInput" value="<?= $loan['bankModal_team']?>" pattern="[A-Za-z]+">
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


                    
                         <?php $i--;} ?>
					</tr> 
				    <?php   }  else {?>
				   <!-- <tr><td colspan="12">No data found</td></tr> -->
				   <?php }?>
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
                             
                            str += '<td><a href="<?php echo base_url("admin/edit-lead/");?>"'+ element.id +'><i class="fa fa-pencil-square-o text-primary fa-lg" aria-hidden="true"></i></a>';
                            str += '<a href="#" ><i class="fa fa-trash text-danger fa-lg" aria-hidden="true" onclick="delLead('+ element.id +')"></i></a></td>';
                            
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