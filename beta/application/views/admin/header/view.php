<div class="container-fluid p-0">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin/Dashboard/");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Header menu</li>
           </ol>
         </nav>
</div>
<div class="container-fluid px-0">
	<div class="row m-0 bg-white">
		

		<div class="col-md-12 px-0">
			<span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>
			<span class="text-center text-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error');?></span>		
		    <div id="message" class="text-primary text-center"></div>
			<a href="<?php echo base_url('admin/add_menu'); ?>" class="btn btn-primary float-right mr-1"><i class="fa fa-plus" aria-hidden="true"></i> Add New header Menu </a>
			<div class="table-responsive ">
                
			<table class="table table-bordered text-center table-hover shadow-lg">
				<thead class="text-white bg-primary">
				<tr>
					<th>SI No.</th>
					<th>Title</th>
					<th>URL</th>
					<th>Parent</th>
					<th>Visibility</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
				</thead>
				<tbody>
					<?php foreach ($menus as $index => $menu){
						$domains = $this->db->get('domains')->result();
						$domain_map = [];
						foreach ($domains as $domain) {
							$domain_map[$domain->id] = $domain->url;
						}
						?>
					<tr>
						<td><?php echo $index + 1; ?></td>
						<td><?php echo $menu->title; ?></td>
						<td><?php echo $menu->url; ?></td>
						<td>
							<?php
							if ($menu->parent_id == 0) {
								echo "None";
							} else {
								$parent = array_filter($menus, function($m) use ($menu) {
									return $m->id == $menu->parent_id;
								});
								$parent = reset($parent);
								echo $parent ? $parent->title : 'Unknown';
							}
							?>
						</td>
						<td><?php echo $menu->is_public ? 'Public' : 'Private'; ?></td>
						<td><?php echo ($menu->status == 1) ? 'active' : 'inactive'; ?></td>
						<td>
							<a href="<?php echo base_url('admin/edit_menu/' . $menu->id); ?>" class="btn btn-primary"><i class="fa fa-pencil-square-o fa-sm" aria-hidden="true"></i></a>
							<a href="<?php echo base_url('admin/delete_menu/' . $menu->id); ?>" onclick="return confirm('Are you sure?')" class="btn btn-danger"><i class="fa fa-trash fa-sm" aria-hidden="true"></i></a>
						</td>
					</tr>
					<?php } ?>
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
