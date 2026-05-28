
<style>
    iframe {
        width: 200px !important;
        height: 100px !important;
    }
    .form-group {
        margin-bottom: 1.5rem!important;
    }
</style>
<div class="container-fluid p-0">
    <nav aria-label="breadcrumb">
    <ol class="breadcrumb ">
        <li class="breadcrumb-item "><a href="<?php echo base_url("admin/Dashboard/");?>" class="text-decoration-none">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Bank wish login</li>
    </ol>
    </nav>
</div>
<div class="container-fluid px-0">
    <div class="row m-0 bg-white">
		<div class="col-md-12 px-0">
            <span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>                     
            <span class="text-center text-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error');?></span>			         	
		    <div id="" class="text-primary text-right mr-1">
                <a href="<?php echo base_url()?>admin/loan-lead-create" class="btn btn-primary"><i class="fa fa-plus text-light fa-sm" aria-hidden="true"></i> Add</a>
            </div>

			<div class="table-responsive ">
			<table class=" table-bordered text-center table-hover" id="dtBasicExample"> 
				<thead class="text-white bg-primary">
					<tr>    
						<th class=''>Sr No.</th>
                        <?php if($this->session->userdata('role') == 1 || $count > 0 ||  $count2 > 0 ||  $count3 > 0) { ?>
                        <th class=''>User Name</th>
                         <?php }?>
						<th class=''>Name</th>
                        <th class=''>Contact Number</th>
						<th class=''>Email</th>
                        <th class=''>Loan Type</th>
                        <th class=''>Loan Amount</th>
                         <th class=''>User ID</th> 
                         <th class=''>Password</th>
                        <th class=''>View</th>
                         <?php if($this->session->userdata('role') == 1) { ?>
                        <th class=''>Update</th>
                        <?php }?>
                        <th class=''>Action</th> 			
					</tr>
				</thead>
				<tbody id="leadBody">
				    <?php
                        if(!empty($loan)) {
                        $num = count($loan) ; 
                        foreach($loan as $data) {
                        $user = $this->db->where('id',$data->user_id)->get('user_master')->row();
                        if (empty($user)) {
                            $user = $this->db->where('id',$data->user_id)->get('branch_franchise')->row();
                        }
                    ?> 
					<tr>
                        <td class=''><?php echo $num; ?></td>
                        <?php if($this->session->userdata('role') == 1 || $count > 0 ||  $count2 > 0 ||  $count3 > 0) { ?>
                        <td class=''> <?= !empty($user) ? $user->username : '<span class="text-danger">N/A</span>' ?></td>
                        <?php }?>							
                        <td class=''><?= $data->name ?></td>					
                        <td class=''><?= $data->number ?></td>					
                        <td class=''><?= $data->email ?></td>					
                        <td class=''><?= $data->loan_type ?></td>	
                        <td class=''><?= $data->loan_amount ?></td>	
                        <td class=''><?php if ( $data->password) {?><?= $data->user_name ?> <div class=""><i class="fa fa-copy btn btn-success" style="cursor:pointer;font-size:10px;" aria-hidden="true" onclick="userName('<?= $data->user_name ?>')"></i></div> <?php }?></td>	
                        <td class=''><?php if ( $data->password) {?><?= $data->password ?> <div class=""><i class="fa fa-copy btn btn-success" style="font-size:10px;cursor:pointer;" aria-hidden="true" onclick="userName('<?= $data->password ?>')"></i></div><?php }?></td>	
                        <?php 
                            $loan_type = str_replace(' ', '_', strtolower($data->loan_type));
                            $domain =  $this->db->where('id',$data->domain_id)->get('domains')->row_array();
                        ?>
                        <td class=''><a href="<?php echo base_url('admin/loan-type-list/').$data->id;?>"><i class="fa fa-eye text-primary fa-lg" aria-hidden="true"></i></a></td>
                        <?php if($this->session->userdata('role') == 1) { ?>
                        <td class=''>
                            <button type="button" class="btn btn-info open-update-modal"
                            data-id="<?= $data->id ?>"
                            data-user_id="<?= $data->user_id ?>"
                            data-password="<?= $data->password ?>"
                            data-toggle="modal" 
                            data-target="#myModal">Update</button>
                        </td>
                        <?php }?>
                        <td>
                            <a href="<?php echo base_url('admin/loan-lead-edit/').$data->id;?>"><i class="fa fa-pencil-square-o text-primary fa-lg" aria-hidden="true"></i></a>
                        </td>
                    </tr> 
                    <?php  $num--; } ?>
				   <?php  }?>
				</tbody> 
			</table>
			</div>
		</div>
	</div>
</div>
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="updateLoanForm"  method="post">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                    <label class="text-dark" for="user_name">User ID<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" aria-required="true" name="user_name"  placeholder="Name" id="modal_user_id" value="" required>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                    <label class="text-dark" for="bank_name">Password<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" aria-required="true" name="password"  placeholder = "Contact Number" id="modal_password" value="" required>
                                    <input type="hidden" aria-required="true" id="modal_id"  name="id" value="" >
                            </div>
                        </div>
                            <div class="col-md-2"> 
                            <div class="form-group">
                            <button type="submit" id="create" class="btn btn-info mt-4">Updated</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>
<script>
    $(document).ready(function() {
    // open Update Modal
    $('.open-update-modal').on('click', function() {
        let id = $(this).data('id');
        $('#updateLoanForm').attr('action', '<?= base_url('admin/Dashboard/loan_type_created/') ?>');

        $('#modal_user_id').val($(this).data('user_id'));
        $('#modal_password').val($(this).data('password'));
        $('#modal_id').val($(this).data('id'));
    });

    $('#dtBasicExample').DataTable({
            "order": [[ 0, 'desc' ]]
        });
        $('.dataTables_length').addClass('bs-select');
    });
    
function userName(url) {
    var input = document.createElement('input');
    input.value = url;
    document.body.appendChild(input);
    input.select();
    document.execCommand('copy');
    document.body.removeChild(input);
    alert('User Id copied to clipboard : ' + url);
}

function password(url) {
    var input = document.createElement('input');
    input.value = url;
    document.body.appendChild(input);
    input.select();
    document.execCommand('copy');
    document.body.removeChild(input);
    alert('Password copied to clipboard : ' + url);
}
</script>
