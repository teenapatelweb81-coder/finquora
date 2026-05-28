
<style>
    iframe {
        width: 200px !important;
        height: 100px !important;
    }
</style>
<div class="container-fluid p-0">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin/Dashboard/");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Marketing data</li>
           </ol>
         </nav>
</div>
<div class="container-fluid px-0">
    
    <div class="row m-0">
		<div class="col-md-12 px-0">
              <?php if($_SESSION['role'] == 1){ ?>
		    <div id="" class="text-primary text-right mb-2">
                <a href="<?= base_url('admin/marketing-data-add')?>" class="btn btn-primary mr-2"><i class="fa fa-plus text-light fa-sm" aria-hidden="true"></i> Add</a>
            </div>
            <?php }?>

			<div class="table-responsive shadow-lg">
			<table class="table table-bordered text-center table-hover" > 
				<span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>
                <span class="text-center text-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error');?></span>				
				<thead class="text-white bg-primary">
					<tr class="">
						<th class='text-center'>Sl No.</th>
						<th class='text-center'>User name</th>
                        <th class='text-center'>Document</th>
						<th class='text-center'>Remark</th>
						<th class='text-center'>Date</th>
                          <?php if($_SESSION['role'] == 1){ ?>
						<th class='text-center'>Action</th>	
                        <?php }?>				
					</tr>
				</thead>
				<tbody id="leadBody">
					<?php
					if(!empty($datas)) {
					 $num = count($datas) ; 
					foreach($datas as $data) {
						if ($data->user_role_id == 3) {
							$user = $this->db->where('id',$data->user_id)->get('branch_franchise')->row('name');
						}else {
							$user = $this->db->where('id',$data->user_id)->get('user_master')->row('name');
						}
                        $domain = $this->db->where('id',$data->domain_id)->get('domains')->row('url');
                        ?>
					<tr>
						<td class=''><?php echo $num; ?></td>						
						<td class=''><?= $user ?></td>
						
						<td class='width: 100px;'><?php if(!empty($data->documents)){?><a href="<?= base_url('upload/assets/images/').$data->documents ?>" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true" style="color: red; font-size: 17px;" ></i></a><?php }?></div></td>
						
                        <td class='width: 100px;'><?= $data->remark ;?></td>

                        <td class='width: 100px;'><?= date('d-m-Y h:i A', strtotime($data->created_at)) ?></td>


                        <!-- <div class='videoSet'><?= $data->file ?> -->
                          <?php if($_SESSION['role'] == 1){ ?>
						<td>
					        <a href="<?php echo base_url('admin/marketing-data-delete/').$data->id;?>" onclick="return confirm('Are you sure ?')" ><i class="fa fa-trash text-danger fa-lg" aria-hidden="true" onclick="delLead"></i></a>
					   </td>
                         <?php } ?>
					</tr>
				   <?php $num--;  } ?>
				   <?php }?>
				</tbody>
			</table>
			</div>
		</div>
	</div>
   
</div>
