<div class="container-fluid p-0">
	<nav aria-label="breadcrumb">
	<ol class="breadcrumb ">
		<li class="breadcrumb-item "><a href="<?php echo base_url("admin/Dashboard/");?>" class="text-decoration-none">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page">Marketing WhatsApp software</li>
	</ol>
	</nav>
</div>
<div class="container-fluid p-0">
	
	
			
	<div id="message" class="text-primary text-center"></div>
		<a href="<?php echo base_url('admin/add-marketing-whatsapp') ;?>" class="btn btn-primary float-right mb-3"><i class="fa fa-plus" aria-hidden="true"></i> Add Marketing Whatsapp </a>
		<a href="<?php echo base_url('admin/whatsapp_transfer') ;?>" class="btn btn-primary float-right mb-3  mr-2"><i class="fa fa-plus" aria-hidden="true"></i> Add Marketing Whatsapp Links </a>
		<div class="table-responsive ">
			<span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>
			<span class="text-center text-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error');?></span>		
			
		<table class="table table-bordered text-center table-hover shadow-lg">
			<thead class="text-white bg-primary">
				<tr>
					<th class=''>Sl No.</th>
					<th class=''>User</th>
					<th class=''>User id</th>
					<th class=''>Password</th>
					<th class=''>Action</th>					
				</tr>
			</thead>
			<tbody>
				<?php
				if(!empty($datas)) {
					$num = 1 ; 
				foreach($datas as $data) {
					$domain =  $this->db->where('id',$data->domain_id)->get('domains')->row_array();
					if ($data->user_role_id == 3) {
						$user = $this->db->where('id',$data->user_id)->get('branch_franchise')->row('name');
					}else {
						$user = $this->db->where('id',$data->user_id)->get('user_master')->row('name');
					}
				?>
				<tr>
					<td class='text-primary'><?php echo $num; ?></td>	
					<td class=''><?= $user ?></td>
					<td class=''><?= $data->user_name ?></td>
					<td class=''><?= $data->password?></td>
					
					<td class=''>
						<a href="<?php echo base_url('admin/marketing-whatsapp-credentials/').$data->id;?>" class="btn btn-sm btn-info" target="_blank"><i class="fa fa-eye"></i> View</a>
						<a href="<?php echo base_url('admin/edit-marketing-whatsapp/').$data->id;?>" class="btn btn-sm btn-warning "><i class="fa fa-pencil-square-o text-white" aria-hidden="true"></i></a>
						<a href="<?php echo base_url('admin/delete-marketing-whatsapp/').$data->id;?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this?')"><i class="fa fa-trash" aria-hidden="true"></i></a> 
					</td>
				</tr>
				<?php $num++;  }} ?>
			</tbody>
		</table>
	</div>
</div>
