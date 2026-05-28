
<div class="container-fluid p-0 ">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin/Dashboard/");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Slider Details</li>
           </ol>
         </nav>
</div>
<div class="container-fluid px-0">
	<div class="row m-0 bg-white">
		<div class="col-md-12 px-0">
			<span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>
			<span class="text-center text-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error');?></span>		
		    <div id="message" class="text-primary text-center"></div>
			<a href="<?php echo base_url('admin/add-slider') ;?>" class="btn btn-primary float-right mr-1"><i class="fa fa-plus" aria-hidden="true"></i> Add New Slider </a>
			<div class="table-responsive ">
                
			<table class="table table-bordered text-center table-hover shadow-lg">
				<thead class="text-white bg-primary">
					<tr>
						<th class=''>Sl No.</th>
						<th class=''>Title</th>
						<th class=''>Sub Title</th>
						<th class=''>Button Name</th>
						<th class=''>Redirection</th>
						<th class=''>Image</th>
						<th class=''>Background Image</th>
						<th class=''>Status</th>
						<th class=''>Action</th>					
					</tr>
				</thead>
				<tbody>
					<?php
					if(!empty($datas)) {
					 $num = 1 ; 
					foreach($datas as $data) {
						$domain =  $this->db->where('id',$data->domain_id)->get('domains')->row_array(); ?>
					<tr>
						<td class='text-primary'><?php echo $num; ?></td>						
						<td class=''><?php echo ucwords($data->title); ?></td>
						<td class=''><?php echo ($data->sub_title) ?></td>
						<td class=''><?php echo ($data->button_name) ?></td>
						<td class=''><?php echo ($data->url) ?></td>
						<td class=''><img src="<?= base_url('assets/images/slider/').$data->slider_image ?>" style="width:50px; height:50px;" clas="img-fluid"> </td>
						<td class=''><img src="<?= base_url('assets/images/slider/').$data->bg_image ?>" style="width:50px; height:50px;" clas="img-fluid"> </td>

						<td><button type="button" id="<?= $data->id; ?>" class="status_checks btn btn-sm mt-1 <?= ($data->status == 1)?"btn-primary":"btn-danger"; ?> ">
						    <?= ($data->status == 1)?"Activate":"Deactivate"; ?>
						    </button>
						</td>
						<td class=''>
					   <a href="<?php echo base_url('admin/edit-slider/').$data->id;?>" class="btn btn-primary"><i class="fa fa-pencil-square-o fa-sm" aria-hidden="true"></i></a>
					   <a href="<?php echo base_url('admin/delete-slider/').$data->id;?>" class="btn btn-danger"><i class="fa fa-trash fa-sm" aria-hidden="true"></i></a> 
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
                  url: "<?= base_url('admin/update_slider_status'); ?>", 
                  data: {"status":newstatus, "id":id}, 
                  success: function(data) {
                  location.reload();
                  }         
             });
         }
      });    
    });
</script>
