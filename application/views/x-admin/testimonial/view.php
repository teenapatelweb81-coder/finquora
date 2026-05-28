
<div class="container-fluid p-0">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin/Dashboard/");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Testimonial Details</li>
           </ol>
         </nav>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-12 px-0">
		    <div id="message" class="text-primary text-center"></div>
			<a href="<?php echo base_url('admin/add-testimonial') ;?>" class="btn btn-primary float-right mb-3"><i class="fa fa-plus" aria-hidden="true"></i> Add New Slider </a>
			<div class="table-responsive ">
			    <span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>
                <span class="text-center text-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error');?></span>		
                
			<table class="table table-bordered text-center table-hover shadow-lg">
				<thead>
					<tr>
						<th class=''>Sl No.</th>
						<th class=''>Name</th>
						<th class=''>Data</th>
						<th class=''>Image</th>
						<th class=''>Status</th>
						<th class=''>Action</th>					
					</tr>
				</thead>
				<tbody>
					<?php
					if(!empty($datas)) {
					 $num = 1 ; 
					foreach($datas as $data) { ?>
					<tr>
						<td class=''><?php echo $num; ?></td>						
						<td class=''><?php echo ucwords($data->testimonial_name); ?></td>
						<td class=''><?php echo ($data->testimonial_data) ?></td>
						<td class=''><img src="<?= base_url('upload/assets/image/').$data->image ?>" style="width:50px; height:50px;" clas="img-fluid"> </td>
						<td class=''><?php  if ($data->status == 1) {echo 'Active';} else {echo 'Inactive';} ?></td>
						<td class=''>
					   <a href="<?php echo base_url('admin/edit-testimonial/').$data->id;?>"><i class="fa fa-pencil-square-o text-primary fa-lg" aria-hidden="true"></i></a>
					   <a href="<?php echo base_url('admin/delete-testimonial/').$data->id;?>"><i class="fa fa-trash text-danger fa-lg" aria-hidden="true"></i></a> 
						</td>
					</tr>
				   <?php $num++;  } } else {?>
				   <tr><td colspan="5">Slider data not available.</td></tr>
				   <?php }?>
				</tbody>
			</table>
			</div>
		</div>
	</div>
</div>
