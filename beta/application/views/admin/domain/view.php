<div class="container-fluid p-0">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin/Dashboard/");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Domain</li>
           </ol>
         </nav>
</div>
<div class="container-fluid px-0">
	<div class="row m-0 bg-white">
	

		<div class="col-md-12 px-0">
			<span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>
			<span class="text-center text-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error');?></span>		
		    <div id="message" class="text-primary text-center"></div>
			 <?php
                    $secret = "MY_SECRET_123";
                    $user_id = 1;
                    $time = time();
                    $hash = hash_hmac('sha256', $user_id . '|' . $time, $secret);

                    $url = "https://fastfinancepartner.com/beta/api/login?user_id=$user_id&time=$time&hash=$hash";
                    ?>

                <a href="<?= $url ?>" target="_blank" class="btn btn-primary ml-1 float-right"><i class="fa fa-plus text-light fa-sm " aria-hidden="true"></i> FF Admin Panel</a>
			<a href="<?php echo base_url('admin/domain-add') ;?>" class="btn btn-primary float-right "><i class="fa fa-plus" aria-hidden="true"></i> Add New Domain </a>
			<div class="table-responsive ">
                
			<table class="table table-bordered text-center table-hover shadow-lg">
				<thead class="text-white bg-primary">
					<tr>
						<th class=''>Sl No.</th>
						<th class=''>Title</th>
						<th class=''>Status</th>
						<th class=''>Login Link</th>
						<th class=''>Action</th>					
					</tr>
				</thead>
				<tbody>
					<?php
					if(!empty($domains)) {
					 $num = 1 ; 

					foreach($domains as $data) {
						// print_r($data);die;
						$sub_user = $this->db->where('domain_id', $data->id)->where('type','subadmin')->get('user_master')->row();
						// print_r($sub_user);die;

						
						?>
					<tr>
						<td class='text-primary'><?php echo $num++; ?></td>						
						<td class=''><?php echo ucwords($data->url); ?></td>
						<td><span id="<?= $data->id; ?>"   data-url="<?= $data->url; ?>"  class="status_checks btn btn-sm mt-1 <?= ($data->status == 1)?"btn-primary":"btn-danger"; ?> ">
						    <?= ($data->status == 1)?"Activate":"Inactivate"; ?>
						    </span>
						</td>
						<td>
							<?php if($sub_user) {
								$hashs = hash_hmac('sha256', $sub_user->id . '|' . $time, $secret);
								
								// Try direct controller call instead of api/login route
								$web_url = rtrim($data->url, '/') . "/beta/api/login?user_id=".$sub_user->id."&time=$time&hash=$hashs";
								?>
							<a href="<?= $web_url ?>" target="_blank" class="btn btn-primary">Dashboard</a>
							<?php }?>
						</td>
						<td class=''>
							<?php if($data->id != 3) { ?>
							<a href="<?php echo base_url('admin/domain-edit/').$data->id;?>" class="btn btn-primary"><i class="fa fa-pencil-square-o fa-sm" aria-hidden="true"></i></a>
							<a href="<?php echo base_url('admin/domainDel/').$data->id;?>" onclick="return confirm('Are you sure you want to delete this domain?')" class="btn btn-danger"><i class="fa fa-trash fa-sm" aria-hidden="true"></i></a>
							<?php } ?>
						</td>
					</tr>
				
				   <?php }}?>
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
        var status = ($(this).hasClass("btn-primary")) ? '1' : '2'; 
		var url = $(this).data('url');
        var msg = (status=='2')? 'Activate':'Inactivate';
        var newstatus = (status=='2')? '1':'2';
         if(confirm("Are you sure to "+ msg)) {
                  $.ajax({
                  type:"POST",
                  url: "<?= base_url('admin/domain/domainupdate'); ?>", 
                  data: {"status":newstatus, "id":id , "url": url }, 
                  success: function(data) {
                  location.reload();
                  }         
             });
         }
      });    
    });
</script>
