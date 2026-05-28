
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
        <li class="breadcrumb-item active" aria-current="page">Documents</li>
    </ol>
    </nav>
</div>
<div class="container-fluid px-0">
   <?php   $parents = $this->db->get_where('user_master', array('id' => $_SESSION['user_id']))->row_array();
         $parent_id_role = isset($parents['parent_id_role']) ? $parents['parent_id_role'] : 0;

   ?>
    <div class="row m-0">
		<div class="col-md-12 px-0">
			<div class="table-responsive">
			<table class="table table-bordered text-center table-hover">
				<span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>
                <span class="text-center text-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error');?></span>				
				<thead class="text-white bg-primary">
					<tr>
						<th class=''>Sl No.</th>
						<th class=''>Document Name</th>
						<th class=''>View </th>
                        <?php if(($_SESSION['role'] != 1 && $_SESSION['type'] != 'admin') && $parent_id_role != 1){ ?>
						<th class=''>Download </th>
                         <?php } ?>
					</tr>
				</thead>
				<tbody id="leadBody">
				    <?php if($_SESSION['role'] == 1 || $_SESSION['type'] == 'admin'){ ?>
				    <?php if (has_permission('Offer-letter-user')) { ?>
					<tr>
						<td class=''>1</td>						
						<td class=''>Offer letter</td>
						<td class='width: 100px;'><a href="<?= base_url('admin/team-offer-letter/') ?><?= $_GET['id']?>" target="_blank"><i class="fa fa-eye" aria-hidden="true" style="color: red; font-size: 17px;" ></i></a></div>
                            </td>
					</tr>
                    <?php }?>
                    <?php if (has_permission('id-card-user')) { ?>
                    <tr>
						<td class=''>2</td>						
						<td class=''>ID Card</td>
						<td class='width: 100px;'><a href="<?= base_url('admin/team-id-card/') ?><?= $_GET['id']?>" target="_blank"><i class="fa fa-eye" aria-hidden="true" style="color: red; font-size: 17px;" ></i></a></div>
                            </td>
					</tr>
                <?php }?>
                <?php }?>
                
                
                <?php  if($parent_id_role == 1){ ?>
                    <?php if (has_permission('Offer-letter-user')) { ?>
                        <tr>
                            <td class=''>1</td>						
                            <td class=''>Offer letter</td>
                            <td class='width: 100px;'><a href="<?= base_url('admin/team-offer-letter/') ?><?= $_SESSION['user_id']?>" target="_blank"><i class="fa fa-eye" aria-hidden="true" style="color: red; font-size: 17px;" ></i></a></div>
                        </td>
					</tr>
                    <?php }?>
                    <?php if (has_permission('id-card-user')) { ?>
                    <tr>
						<td class=''>2</td>						
						<td class=''>ID Card</td>
						<td class='width: 100px;'><a href="<?= base_url('admin/team-id-card/') ?><?= $_SESSION['user_id']?>" target="_blank"><i class="fa fa-eye" aria-hidden="true" style="color: red; font-size: 17px;" ></i></a></div>
                            </td>
					</tr>
                    <?php }?>
                <?php }else{ ?>
                    <?php if ($_SESSION['role'] != 1) { ?>
                        <?php if (has_permission('Certificate-user')) { ?>
                            <tr>
                                <td class=''>1</td>						
                                <td class=''>Cerfiticate</td>
                                <td class='width: 100px;'><a href="<?= base_url('admin/document_doc') ?>" target="_blank"><i class="fa fa-eye" aria-hidden="true" style="color: red; font-size: 17px;" ></i></a></div>
                            </td>
					    <td class='width: 100px;'><a href="<?= base_url('admin/cartificate-genrate') ?>"target="_blank"><i class="fa fa-download" aria-hidden="true" style="color: red; font-size: 17px;" ></i></a></div>
                    </td>
                </tr>
                <?php }?>
                
                
                    <?php if (has_permission('visiting-card-user')) { ?>
                        <tr>
                            <td class=''>2</td>						
                            <td class=''>Visiting Card</td>
                            <td class='width: 100px;'><a href="<?= base_url('admin/visiting') ?>" target="_blank"><i class="fa fa-eye" aria-hidden="true" style="color: red; font-size: 17px;" ></i></a></div>
                        </td>
					    <td class='width: 100px;'><a href="<?= base_url('admin/vising-card-genrate') ?>"target="_blank" ><i class="fa fa-download" aria-hidden="true" style="color: red; font-size: 17px;" ></i></a></div>
                    </td>
                </tr>
                <?php }?>
                
                
                <?php if (has_permission('id-card-user')) { ?>
                    <tr>
                        <td class=''>3</td>						
						<td class=''>ID Card</td>
						<td class='width: 100px;'><a href="<?= base_url('admin/id_card') ?>" target="_blank"><i class="fa fa-eye" aria-hidden="true" style="color: red; font-size: 17px;" ></i></a></div>
                    </td>
                    <td class='width: 100px;'><a href="<?= base_url('admin/id-genrate') ?>" target="_blank"><i class="fa fa-download" aria-hidden="true" style="color: red; font-size: 17px;" ></i></a></div>
                </td>
            </tr>
            <?php }?>
            
            <?php 
                  
                  if($_SESSION['role'] == 3){ ?>

                <?php if (has_permission('banner-user')) { ?>
                    <tr>
                        <td class=''>4</td>						
						<td class=''>Banner</td>
						<td class='width: 100px;'><a href="<?= base_url('admin/banner') ?>" target="_blank"><i class="fa fa-eye" aria-hidden="true" style="color: red; font-size: 17px;" ></i></a></div>
                    </td>
                    <td class='width: 100px;'><a href="<?= base_url('admin/banner-genrate') ?>"target="_blank" ><i class="fa fa-download" aria-hidden="true" style="color: red; font-size: 17px;" ></i></a></div>
                </td>
            </tr>
            <?php }?>
            <?php if (has_permission('joining-letter-user')) { ?>
                    
                <tr>
                    <td class=''>5</td>						
                    <td class=''> Joining Letter</td>
                    <td class='width: 100px;'><a href="<?= base_url('admin/joining-letter') ?>" target="_blank"><i class="fa fa-eye" aria-hidden="true" style="color: red; font-size: 17px;" ></i></a></div>
                        </td>
                    <td class='width: 100px;'><a href="<?= base_url('admin/joining-letter-genrate') ?>" target="_blank" ><i class="fa fa-download" aria-hidden="true" style="color: red; font-size: 17px;" ></i></a></div>
                    </td>
                </tr>
            <?php }?>
                <?php }?>
                <?php }?>
                <?php }?>
                

				</tbody>
			</table>
			</div>
		</div>
	</div>
   
</div>


<script>
    $(document).ready(function () {
        $('#dtBasicExample').DataTable();
        $('.dataTables_length').addClass('bs-select');
    });

</script>




<script>

    function myleadsData() {
        var leadTime = $('#myleads').find(":selected").val();
        var to_date = "2023-02-04";
         //var to_date =  $('#to_date').val();
        //  var to_date = new Date($('#to_date').val());
        //       var day = $('#date-input').getDate();
        //       var month = $('#date-input').getMonth() + 1;
        //       var year = $('#date-input').getFullYear();
        //       alert(day+"/"+ month+"/"+year);
       
        // if(leadTime == "custom" && (to_date == "" ||  to_date == undefined) {
        //     alert("Please choose custom date");
        // }
        
        //alert(to_date);
        var str = "";
        $("#leadBody").empty();
        
        if(leadTime) {
            $.ajax({
                type: 'POST',
                url: 'get-leads-data',
                data: { 
                    'leadTime': leadTime, 
                    'customDate' : to_date
                    
                },
                success: function(result){
                    var obj = JSON.parse(result);
                    console.log(obj)
                    if(obj.lead_data.length > 0) {
                        
                        $.each(obj.lead_data, function(index, element) {
                            str += '<tr>' ;
                            str += '<td>' + ++index + '</td>';
                            str += '<td>' + element.process_id + '</td>';
                            str += '<td>' + element.title + '</td>';
                            str += '<td>' + element.title + '</td>';
                            str += '<td>' + element.first_name + '</td>';
                            str += '<td>' + element.last_name + '</td>';
                            str += '<td>' + element.loan_amount + '</td>';
                            str += '<td>' + element.gender + '</td>';
                            str += '<td>' + element.mobile + '</td>';
                            str += '<td>' + element.dob + '</td>';
                             
                            str += '<td><a href="<?php echo base_url("admin/edit-lead/");?>"'+ element.id +'><i class="fa fa-pencil-square-o text-primary fa-lg" aria-hidden="true"></i></a>';
                            str += '<a href="#" ><i class="fa fa-trash text-danger fa-lg" aria-hidden="true" onclick="delLead('+ element.id +')"></i></a></td>';
                            
        //                     <td>
					   //     <a href="<?php echo base_url('admin/edit-user/').$data->id;?>"><i class="fa fa-pencil-square-o text-primary fa-lg" aria-hidden="true"></i></a>
					   //     <a href="#" ><i class="fa fa-trash text-danger fa-lg" aria-hidden="true" onclick="delUser(<?= $data->id ?>)"></i></a>
					   //</td>
                                    
                            str += '</tr>';
                        });
                         $('#leadBody').append(str);
                        
                    }
                    else {
                         str += '<tr><td colspan="12">No data found</td></tr>' ;
                         $('#leadBody').append(str);
                        
                    }
                    
                    
                },
                error: function (error) {
                    alert("server error");
                }
            });
            
        }
        
    }
   
   
    $(document).ready(function(){
  $("#filter-table").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#leadBody tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>