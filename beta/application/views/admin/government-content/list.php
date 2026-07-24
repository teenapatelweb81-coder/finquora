

<style>
    iframe {
        width: 200px !important;
        height: 100px !important;
    }
</style>
<div class="container-fluid p-0">
   <div class="row m-0">
      <div class="col-md-12">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin/Dashboard/"); ?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Government Content</li>
           </ol>
         </nav>
</div>
<div class="container-fluid">
    <div class="row m-0">
		<div class="col-md-12">
              <?php //if($_SESSION['role'] == 1){ ?>
		    <div id="" class="text-primary text-right mr-3">
                <a href="<?php echo base_url() ?>admin/government-content-add" class="btn btn-primary"><i class="fa fa-plus text-light fa-sm" aria-hidden="true"></i> Add</a>

            </div>
            <?php // }?>

			<div class="table-responsive ">
			<table class="table table-bordered text-center table-hover" >
				<span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success'); ?></span>
                <span class="text-center text-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error'); ?></span>
				<thead class="text-white bg-primary">
					<tr>
						<th class=''>Sr No.</th>
						<th class=''>Page</th>
                        <th class=''>Action</th>
						
					</tr>
				</thead>
				<tbody id="leadBody">
				    <?php
                        if (!empty($contents)) {
                            $num = count($contents);
                            foreach ($contents as $content) {
                            $menu = $this->db->where('id', $content['menu_id'])->get('menus')->row_array();
                    ?>
					<tr>
						<td class=''><?php echo $num; ?></td>
						<td class=''><?=$menu['url']?></td>
						<td>
                    
					       <a href="<?php echo base_url('admin/government-content-edit/') . $content['id']; ?>"><i class="fa fa-pencil-square-o text-primary fa-lg" aria-hidden="true"></i></a>
					        <a href="<?php echo base_url('admin/government-content-del/') . $content['id']; ?>" onclick="return confirm('Are you sure ?')" ><i class="fa fa-trash text-danger fa-lg" aria-hidden="true" onclick="delLead"></i></a>

					   </td>

                         <?php $num--;}?>
					</tr>
				    <?php } else {?>
				   <!-- <tr><td colspan="12">No data found</td></tr> -->
				   <?php }?>
				</tbody>
			</table>
			</div>
		</div>
	</div>

</div>
