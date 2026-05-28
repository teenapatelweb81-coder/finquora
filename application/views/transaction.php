
<div class="container-fluid p-0">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin/Dashboard/");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Transaction Details</li>
            </ol>
         </nav>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-12 px-0">
		    <div id="message" class="text-primary text-center"></div>
			<div class="table-responsive ">
			    <span class="text-center text-primary mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>
                <span class="text-center text-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error');?></span>		
                
			<table class="table table-bordered text-center table-hover shadow-lg">
				<thead class="bg-primary text-white">
					<tr>
						<th class=''>Sl No.</th>
						<th class=''>Transaction Id</th>
						<th class=''>Amount</th>
						<th class=''>Method</th>
						<th class=''>Role</th>
									
					</tr>
				</thead>
				<tbody>
					<?php
					if(!empty($datas)) {
					 $num = 1 ; 
					foreach($datas as $data) {  ?>
					<tr>
						<td class='text-primary'><?php echo $num; ?></td>						
						<td class='text-left'><?php echo ucwords($data->payment_id); ?></td>
						<td class=''><?php echo ucwords($data->amount); ?>></td>
						<td class=''><?php echo ucwords($data->method); ?></td>
						
				        <td class=''><?php echo ucwords($data->role); ?></td>

					</tr>
				   <?php $num++;  } } else {?>
				   <tr><td colspan="5">Blog Category data not available.</td></tr>
				   <?php }?>
				</tbody>
			</table>
			</div>
		</div>
	</div>
</div>

