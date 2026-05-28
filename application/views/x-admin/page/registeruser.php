

<div class="container-fluid p-0">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin/Dashboard/");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Register User Details</li>
           </ol>
         </nav>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-12 px-0">
		    <div id="message" class="text-primary text-center"></div>
			<div class="table-responsive shadow-lg">
			<table class="table table-bordered text-center table-hover">
				<span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>
                <span class="text-center text-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error');?></span>				
				<thead class="text-white bg-primary">
					<tr>
						<th class=''>Sl No.</th>
						<th class=''>Name</th>
						<th class=''>Email</th>
						<th class=''>Mobile</th>
						<!--<th class=''>Status</th>-->
						<!--<th class=''>Action</th>					-->
					</tr>
				</thead>
				<tbody>
					<?php
					if(!empty($datas)) {
					 $num = 1 ; 
					foreach($datas as $data) { ?>
					<tr>
						<td class=''><?php echo $num; ?></td>						
						<td class=''><?php echo ucwords($data->username); ?></td>
						<td class=''><?php echo ucwords($data->email); ?></td>
						<td class=''><?php echo ucwords($data->mobile); ?></td>
						<!--<td class=''><?php  if ($data->status == 1) {echo 'Active';} else {echo 'Inactive';} ?></td>-->
						
					   <!--<a href="<?php echo base_url('edit-category/').$data->id;?>"><i class="fa fa-pencil-square-o text-primary fa-lg" aria-hidden="true"></i></a>-->
					   <!--<a href="javascript:void(0)" id="<?= $data->id ?>" class="cremove"><i class="fa fa-trash text-danger fa-lg" aria-hidden="true"></i></a> -->
				
					</tr>
				   <?php $num++;  } } else {?>
				   <tr><td colspan="5">Register User Details not available.</td></tr>
				   <?php }?>
				</tbody>
			</table>
			</div>
		</div>
	</div>
</div>
