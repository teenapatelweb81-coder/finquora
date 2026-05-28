
<style>
    iframe {
        width: 200px !important;
        height: 100px !important;
    }
</style>
<?php
    $role = isset($_GET['role']) ? $_GET['role'] : '';
    $type = isset($_GET['user']) ? $_GET['user'] : '';

    if ($role === 'disbursements' && $type === 'team') {
        $loans = $team_disbursemenets_loan_digital;
        $column = 'Disbursement';

    } elseif ($role === 'payout' && $type === 'team') {
        $loans = $team_payout_loan_digital;
        $column = ' Payout';

    } elseif ($role === 'approved' && $type === 'team') {
        $loans = $team_loans_approved_digital;
        $column = 'Status';
        
    } elseif ($role === 'rejected' && $type === 'team') {
        $loans = $team_loans_rejects_digital;
        $column = 'Status';
        
    } elseif ($role === 'loan' && $type === 'team') {
        $loans = $team_loans_digital;
        $column = 'Status';
        
    } elseif ($role === 'disbursements') {
        $loans = $disbursemenets_loan_digital;
        $column = 'Disbursement';
        
    } elseif ($role === 'payout') {
        $loans = $payout_loan_digital;
        $column = 'Payout';
        
    } elseif ($role === 'approved') {
        $loans = $digital_loan_approved;
        $column = 'Status';
        
    } elseif ($role === 'rejected') {
        $loans = $digital_loan_reject;
        $column = 'Status';
    } else {
        $loans = $totalLoans;
        $column = 'Status';
    }
?>
<div class="container-fluid p-0">
    <nav aria-label="breadcrumb">
    <ol class="breadcrumb ">
        <li class="breadcrumb-item "><a href="<?php echo base_url("admin/Dashboard/"); ?>" class="text-decoration-none">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page"> </li>
    </ol>
    </nav>
</div>
<div class="container-fluid">
    <div class="row m-0">
		<div class="col-md-12">
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
                        <th class=''><?= $column?></th>
					</tr>
				</thead>
				<tbody id="leadBody">
					<?php
                        if (!empty($loans)) {
                        $i = count($loans);
                        foreach ($loans as $loan) {

                            if ($role === 'disbursements' && $type === 'team') {
                                $loans = $team_disbursemenets_loan_digital;
                                $value = $loan['disbursed_team'];
                                
                            } elseif ($role === 'payout' && $type === 'team') {
                                $loans = $team_payout_loan_digital;
                                $value = $loan['payment_amount_paid_team'];
                                
                            } elseif ($role === 'approved' && $type === 'team') {
                                $loans = $team_loans_approved_digital;
                                $value = $loan['loan_status'];
                                
                            } elseif ($role === 'rejected' && $type === 'team') {
                                $loans = $team_loans_rejects_digital;
                                $value = $loan['loan_status'];
                                
                            } elseif ($role === 'loan' && $type === 'team') {
                                $loans = $team_loans_digital;
                                $value = $loan['loan_status'];
                                
                            } elseif ($role === 'disbursements') {
                                $loans = $disbursemenets_loan_digital;
                                $value = $loan['disbursed'];
                                
                            } elseif ($role === 'payout') {
                                $loans = $payout_loan_digital;
                                $value = $loan['payment_amount_paid'];
                                
                            } elseif ($role === 'approved') {
                                $loans = $digital_loan_approved;
                                $value = $loan['loan_status'];
                                
                            } elseif ($role === 'rejected') {
                                $loans = $digital_loan_reject;
                                $value = $loan['loan_status'];
                            } else {
                                $loans = $totalLoans;
                                $value = $loan['loan_status'];
                            }

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
                            
                            
                            <td><?=$value;?></td>

                            <?php $i--;}?>
    					</tr>
				    <?php } ?>
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
