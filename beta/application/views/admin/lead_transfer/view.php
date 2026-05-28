
<div class="container-fluid p-0">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin/Dashboard/");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">leads</li>
           </ol>
         </nav>
</div>
<div class="container">
	<div class="row">
	<div class="col-md-12">
			<?php echo form_open_multipart('admin/Slider/heading_update');?>
				
				<div class="card p-3">
					<div class="cart-b">
				<div class="row align-items-end">
					<div class="col-md-3 mt-2">
						<label for="Image Alt Description" class="form-label">Title <span class="text-danger">*</span></label>
						<input type="text" name="title" id="title" class="form-control" value="<?= (isset($heading->title)) ? $heading->title : '' ; ?>" required placeholder="Add Title">
						<input type="hidden" name="type" value="leads">
						<input type="hidden" name="id" value="<?= (isset($heading->id)) ? $heading->id : '' ; ?> ">
						<?php echo form_error('title','<span class="text-danger mt-1">','</span>') ;?>
				</div>
				<div class=" col-md-3  mt-2">
					
					<label for="Image Alt Description" class=" form-label">Description</label>
					<input type="text" name="description" id="description" class="form-control" placeholder="Add Description"value="<?= (isset($heading->description)) ? $heading->description : '' ; ?>" >
				</div>

				<div class=" col-md-3  mt-2">
					<label for="Image Alt Description" class=" form-label">Color</label>
					<input type="color" name="color" id="color" class="form-control" placeholder="Add color"value="<?= (isset($heading->color)) ? $heading->color : '' ; ?>" >
				</div>

					<?php
					$selected_domain_id = isset($_GET['domain_id']) ? (int)$_GET['domain_id'] : null;
					
					if ($selected_domain_id) {
						$website_id = $selected_domain_id;
					} else {
						$website_id = domain_id_get();
					}

					if ($this->session->userdata('type') == 'admin') { ?>
						<div class="col-md-3 mt-2">
							<label for="domain_id_main" class="form-label">Domain</label>
							<select class="form-control" id="domain_id_main" required name="domain_id" onchange="window.location.href = window.location.pathname + '?domain_id=' + this.value;">
								<?php foreach ($domains as $domain) { ?>
									<option <?= ($website_id == $domain['id']) ? 'selected' : ''; ?> value="<?= $domain['id'] ?>"> <?= $domain['url'] ?></option>
								<?php } ?>
							</select>
						</div>
				<?php }else{?>
					<input type="hidden" name="domain_id"  class="form-control" value="<?= $website_id ?>" >
				<?php }?>

					<div class=" col-md-3  mt-3">
						<input type="submit" name="submit" id="submit" value="Submit" class="btn btn-info mt-4">
					</div>
				<?php echo form_close();?>
				</div>
			</div>
			</div>
			
		<div class="col-md-12">
		    <div id="message" class="text-primary text-center"></div>
			<a href="<?php echo base_url('admin/add-lead-transfer') ;?>" class="btn btn-primary float-right mb-3"><i class="fa fa-plus" aria-hidden="true"></i> Add New lead </a>
			<div class="table-responsive ">
			    <span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>
                <span class="text-center text-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error');?></span>		
                
			<table class="table table-bordered text-center table-hover shadow-lg">
				<thead class="text-white bg-primary">
					<tr>
						<th class=''>Sl No.</th>
						<th class=''>Url</th>
						<th class=''>Status</th>
						<th class=''>Action</th>					
					</tr>
				</thead>
				<tbody>
					<?php
					if(!empty($datas)) {
					 $num = 1 ; 
					foreach($datas as $data) {
 						$domain =  $this->db->where('id',$data->domain_id)->get('domains')->row_array();
					?>
					<tr>
						<td class='text-primary'><?php echo $num; ?></td>	
						<td class=''><?php echo ($data->url) ?></td>
						<td><button type="button" id="<?= $data->id; ?>" class="status_checks btn btn-sm mt-1 <?= ($data->status == 1)?"btn-primary":"btn-danger"; ?> ">
						    <?= ($data->status == 1)?"Activate":"Deactivate"; ?>
						    </button>
						</td>
						<td class=''>
					   <a href="<?php echo base_url('admin/edit-lead-transfer/').$data->id;?>"><i class="fa fa-pencil-square-o text-warning fa-lg" aria-hidden="true"></i></a>
					   <a href="<?php echo base_url('admin/delete-lead-transfer/').$data->id;?>"><i class="fa fa-trash text-danger fa-lg" aria-hidden="true"></i></a> 
						</td>
					</tr>
				   <?php $num++;  }} ?>
				</tbody>
			</table>
			</div>
		</div>
	</div>
</div>

<script>
    $(document).ready(function(){
        
    $(document).on('click','.status_checks',function() {
        var id = (this.id);
        var status = ($(this).hasClass("btn-primary")) ? '1' : '0'; 
        var msg = (status=='0')? 'Activate':'Deactivate';
        var newstatus = (status=='0')? '1':'0';
         if(confirm("Are you sure to "+ msg)) {
                  $.ajax({
                  type:"POST",
                  url: "<?= base_url('admin/update-lead-status-transfer'); ?>", 
                  data: {"status":newstatus, "id":id}, 
                  success: function(data) {
                  location.reload();
                  }         
             });
         }
      });    
    });
</script>
