

<div class="container-fluid p-0">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin/Dashboard/");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Admin Team</li>
           </ol>
         </nav>
</div>
<div class="container-fluid px-0 bg-white pt-1">
    <div class="row m-0">
        <div class="col-md-12 px-0">
        	 <section class="content py-0">
        	  <div class="container-fluid px-0">
                <!-- Small boxes (Stat box) -->
                <div class="row m-0">
                     <div class="col-md-4">
                         <div _ngcontent-wsc-c195="" 
                         class="form-group mb-0">
                         <input type="text" id="filter-table" name="filter-table" placeholder="Search . . ." class="form-control form-control-alternative" />
                        </div>
                        
                    </div>
                    <div class="col-md-2"></div>
                    
                    <div class="col-md-6 pr-1">
                        <div class="form-group mb-0 text-right">
                            <a href="<?php echo base_url('admin/add-member');?>"><button type="button" class="btn btn-primary" >Add Member</button></a>
                            <a herf="javascript:void(0);" onclick = copyLink("<?php echo base_url('admin/add-member-share?type=');?><?= $this->session->userdata('user_id');?>&role=<?= $this->session->userdata('role');?>") ><button type="button" class="btn btn-primary" >Share team member link</button></a>
                        </div>
                        
                    </div>
                    
                    
                </div>
              </div>
            </section>
       </div>
    </div>
    <div class="row m-0">
		<div class="col-md-12 px-0">
		    <div id="message" class="text-primary text-center"></div>
			<div class="table-responsive">
			<table class=" table-bordered text-center table-hover" id="dtBasicExample">
				<span class="text-center text-info" id="susid"> <?php echo $this->session->flashdata('success');?></span>
                <span class="text-center text-danger" id="errid"> <?php echo $this->session->flashdata('error');?></span>				
				<thead class="text-white bg-primary">
					<tr>
						<th class=''>Sl No.</th>
						<th class=''>Name</th>
						<th class=''>Email</th>
						<th class=''>Mobile</th>
						<th class=''>Parent name</th>
						<th class=''>Status</th>
                        <th class=''>Team code</th>
                       <?php if($this->session->userdata('role') == 1): ?>
                        <th class=''>Team Document</th>
                        <?php endif;?>
						<th class=''>Action</th>					
					</tr>
				</thead>
				<tbody id="networkBody">
					<?php
					if(!empty($datas)) {
					 $num = count($datas) ; 
					foreach($datas as $data) {
                        
                        $parent_name = $this->db->where('id',$data->parent_id)->where('role',$data->parent_id_role)->get('user_master')->row_array();
                        if(empty($parent_name)) {
                            $parent_name = $this->db->where('id',$data->parent_id)->where('role',$data->parent_id_role)->get('branch_franchise')->row_array();
                        }
                        $parent_name = (!empty($parent_name)) ? $parent_name['name'] : '';
                        ?>
					<tr>
						<td class=''><?php echo $num; ?></td>
						<?php if($role == 2) {   ?>
						<td class=''><?php echo ucwords($data->name); ?></td>
						<td class=''><?php echo ucwords($data->email); ?></td>
						<td class=''><?php echo ucwords($data->mobile_no); ?></td>
						
						<?php } else {  ?>
						<td class=''><?php echo ucwords($data->name); ?></td>
						<td class=''><?php echo ucwords($data->email); ?></td>
						<td class=''><?php echo ucwords($data->mobile_no); ?></td>
						
						<?php }
                        ?>
						<td class=''><?= $parent_name; ?></td>
						<td class=''><?php  if ($data->status == 1) {echo 'Active';} else {echo 'Inactive';} ?></td>
                        <?php if(($_SESSION['role'] == 1 || $_SESSION['type'] == 'admin') && $data->parent_id_role == 1){ ?>
                        <td class=''> <?= str_replace('Team-', '', $data->code); ?></td>
                        <?php }else{?>
                            <td class=''><?php echo ucwords($data->code); ?></td>
                        <?php }?>
                        <?php if ($this->session->userdata('role') == 1) { ?>
                        <td>
                            <?php if( $data->parent_id_role == 1){ ?>
                       
					        <a href="<?php echo base_url('admin/document?id=');?><?= $data->id?>" title="document"> <i class="fa fa-eye text-white btn btn-success  fa-sm" aria-hidden="true"></i></a>
                            <?php }?>
                            <?php }else{?>
                                <!-- <a  title="view" href="<?php echo base_url('admin/Dashboard/teamMember/').$data->id;?>?ref=my-team"> <i class="fa fa-eye btn btn-primary fa-sm" aria-hidden="true"></i></a> -->
                            </td>
                            <?php }?>

						<td>
					        <a href="<?php echo base_url('admin/edit-partner/').$data->id;?>?ref=my-team"><i class="fa fa-pencil-square-o text-primary fa-lg" aria-hidden="true"></i></a>
					        <a href="#" ><i class="fa fa-eye text-primary fa-lg" aria-hidden="true" onclick="statusUser(<?= $data->id ?>, <?= $data->status ?>)"></i></a>
					   </td>
				
					</tr>
				   <?php $num--;  } } else {?>
				   <!-- <tr><td colspan="8"> Data not found.</td></tr> -->
				   <?php }?>
				</tbody>
			</table>
			</div>
		</div>
	</div>
   
</div>
<script>
    $(document).ready(function () {
        $('#dtBasicExample').DataTable({
            "order": [[ 0, 'desc' ]]
        });
        $('.dataTables_length').addClass('bs-select');
    });

</script>


<script>
    function getCustomer() {
        var networkId = $('#network').find(":selected").val();
         
        var str = "";
        $("#networkBody").empty();
        if(networkId) {
            $.ajax({
                type: 'POST',
                url: 'get-customer-data',
                data: { 
                    'customer': networkId, 
                },
                success: function(result){
                    var obj = JSON.parse(result);
                    console.log(obj.networkData);
                    
                      if(obj.networkData.length > 0) {
                        $.each(obj.networkData, function(index, element) {
                            
                            if(element.status == 1) {
                                var st = 'Active';
                            }
                            else {
                                var st = 'Inactive';
                            }
                            
                            str += '<tr>';
                            str += '<td>' + ++index + '</td>';
                            <?php if($role == 2) { ?>
                            str += '<td>' + element.first_name + '</td>';
                            str += '<td>NA</td>';
                            str += '<td>' + element.mobile + '</td>';
                            
                            <?php } else { ?>
                                str += '<td>' + element.name + '</td>';
                                str += '<td>' + element.email + '</td>';
                                if(networkId == "customer") {
                                    str += '<td>' + element.mobile + '</td>';
                                }
                                else {
                                    str += '<td>' + element.mobile_no + '</td>';
                                }
                                
                            <?php } ?>
                            
                            str += '<td>'+ st +'</td>';
                            
                            
                            str += '</tr>';
                            
                        });
                       
                         $('#networkBody').append(str);
                        
                    }
                    else {
                        str = '<tr><td colspan="12"> Data not found.</td></tr>'
                         $('#networkBody').append(str);
                        
                    }
                    
                },
                error: function (error) {
                    alert("server error");
                }
            });
            
        }
        
    }
    
    
    function statusUser($id, $status) {
    if (confirm("Are you sure want to change the status of Agent") == true) {
         $.ajax({
            url: "status-agent",
            type: "POST",
            data: { id: $id, status: $status},
            success: function (data) {
                if (data == "true") {
                  window.location.reload();
                }

            }
        });
      } else {
         window.location.reload();
    }
     
 }
    
    
    
    

 $(document).ready(function(){
  $("#filter-table").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#networkBody tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>

<script>
function copyLink(url) {
    var input = document.createElement('input');
    input.value = url;
    document.body.appendChild(input);
    input.select();
    document.execCommand('copy');
    document.body.removeChild(input);
    // alert('Link copied to clipboard : ' + url);
}
</script>