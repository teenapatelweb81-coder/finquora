
<div class="container-fluid p-0">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin/Dashboard/"); ?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Blog Category Details</li>
           </ol>
         </nav>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-12 px-0">
		    <div id="message" class="text-primary text-center"></div>
			<a href="<?php echo base_url('admin/add-blog'); ?>" class="btn btn-primary float-right mb-3"><i class="fa fa-plus" aria-hidden="true"></i> Add New Blog</a>
			<!-- <a href="<?php echo base_url('admin/add-blog-category'); ?>" class="btn btn-primary float-right mr-3 mb-3"><i class="fa fa-plus" aria-hidden="true"></i> Add New Blog Category</a> -->
			<div class="table-responsive ">
			    <span class="text-center text-primary mb-2" id="susid"> <?php echo $this->session->flashdata('success'); ?></span>
                <span class="text-center text-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error'); ?></span>

			<table class="table table-bordered text-center table-hover shadow-lg">
				<thead class="bg-primary text-white">
					<tr>
						<th class=''>Sl No.</th>
						<th class=''>Blog Title</th>
						<th class=''>Blog Image</th>
						<th class=''>Blog Author</th>
						<th class=''>Publish Date</th>
						<th class=''>Status</th>
						<th class=''>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
if (!empty($datas)) {
    $num = 1;
    foreach ($datas as $data) {?>
					<tr>
						<td class='text-primary'><?php echo $num; ?></td>
						<td class='text-left'><?php echo ucwords($data->blogTitle); ?></td>
						<td class=''><img src="<?=base_url('') . $data->blogImage?>" style="width:60px; height:60px;" clas="img-thumbnail"> </td>
						<td class=''><?php echo ucwords($data->author); ?></td>
						<td class=''><?php echo date('j F, Y', strtotime($data->publishDate)); ?></td>
						<td><button type="button" id="<?=$data->id;?>" class="status_checks btn btn-sm mt-2 <?=($data->status == 1) ? "btn-primary" : "btn-danger";?> ">
						    <?=($data->status == 1) ? "Activate" : "Deactivate";?>
						    </button>
						</td>
						<td class=''>
					   <a href="<?php echo base_url('admin/edit-blog/') . $data->id; ?>"><i class="fa fa-pencil-square-o text-warning fa-lg" aria-hidden="true"></i></a>
					   <a href="<?php echo base_url('admin/delete-blog/') . $data->id; ?>"><i class="fa fa-trash text-danger fa-lg" aria-hidden="true"></i></a>
						</td>
					</tr>
				   <?php $num++;}} else {?>
				   <tr><td colspan="5">Blog Category data not available.</td></tr>
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
                  url: "<?=base_url('admin/update_blogs_status')?>",
                  data: {"status":newstatus, "id":id},
                  success: function(data) {
                  location.reload();
                  }
             });
         }
      });
    });
</script>
