<style>
    a#test {
    padding-left: 10px;
    padding-right: 10px;
    }
</style>

<div class="container-fluid p-0">
   <div class="row m-0">
      <div class="col-md-12 px-0">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin/Dashboard/");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Referral Data</li>
           </ol>
         </nav>
</div>
	<div id="message" class="text-primary text-center"></div>
		<div class=" table-responsive shadow-lg">
			<table class=" table-bordered text-center table-hover " id="dtBasicExample">
				<span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>
                <span class="text-center text-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error');?></span>				
				<thead class="text-white bg-primary">
					<tr>
					    <th class=''>Sl No.</th>
						<th class=''>Name</th>
						<th class=''>Email</th>
						<th class=''>Mobile</th>
						<th class=''>City</th>
						<th class=''>Subscription</th>
						<th class=''>Created By</th>
						<th class=''>Account Type</th>
						<th class=''>Date</th>
						<th class=''>Referral Amount</th>
						<th class=''>Status</th>
					</tr>
				</thead>
				<tbody id="appBody">
					<?php
					if(!empty($datas)) {
					 $num = count($datas) ; 
					foreach($datas as $data) {
                        if (!empty($data->parent_id) == '') {
                        $c = 'Registered User';
                            }elseif (!empty($data->subscription) != '') {
                                if (!empty($data->parent_id) != '') {
                                    $c = 'Network Member';
                                }
                            }elseif (!empty($data->parent_id) != '') {
                                if (!empty($data->subscription) == '') {
                                    $c = 'Team Member';
                                }
                        }

                        $parent_name = '';
                        if (empty($data->parent_name)) {
                            if ($data->parent_id != '') {
                                $parent_name = $this->db->where('id',$data->parent_id)->get('branch_franchise')->row('name');
                            }
                        }else {
                           $parent_name = $data->parent_name;
                        }
                      
                    ?>
					<tr>
						<td class=''><?php echo $num; ?></td>		
						<td style='text-wrap:nowrap;'><?php echo ucwords($data->name); ?>
                         <?php  if ($data->transfer_status == 1 || $data->transfer_status_user == 1 ) { ?>
                            <i class="fa fa-refresh text-primary p-1"aria-hidden="true"></i>
                        <?php }?></td>
						<td class=''><?php echo ucwords($data->email); ?></td>
						<td class=''><?php echo ucwords($data->mobile_no); ?></td>
						<td class=''><?php echo ucwords($data->city); ?></td>
						<td class=''><?php 
                        if ($data->subscription == 'platinum_free') {
                            echo "Platinum free plan";
                            }elseif ($data->subscription == 'silver_free') {
                            echo "Sliver free plan";
                            }elseif ($data->status == 1 ) {
                                echo ucwords($data->subscription);
                            }else {
                                echo "Unpaid";
                            }
                            ?>
                        </td>
						<td class=''><?php echo ucwords($parent_name); ?></td>
						<td class=''><?php echo ucwords($c); ?></td>
                        <td class=''>
                            <?php
                         if (!empty($data->date)) {
                             echo ucwords(date('d-m-Y h:i A', strtotime($data->date)));
                            } else {
                                echo ucwords(date('d-m-Y h:i A', strtotime($data->created_on)));
                            }    
                            ?></td>
                        <td class=''><?= $data->referral_amount; ?></td>
						<td class=''><?php  if ($data->status == 1) {echo 'Active';} else {echo 'Inactive';} ?></td>

				
					</tr>
				   <?php $num--;  }} ?>
				</tbody>
			</table>
		</div>
	</div>
    <script>
    $(document).ready(function () {
        $('#dtBasicExample').DataTable({
            "order": [[ 0, 'desc' ]],
            responsive: true,
        });
       
    });

</script>