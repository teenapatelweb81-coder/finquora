<style>
    a#test {
        padding-left: 10px;
        padding-right: 10px;
    }
    
    .icon-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        border-radius: 5px;
        background-color: #4e73df;
        color: white !important;
        transition: all 0.3s ease;
        text-decoration: none;
    }
   
    
    .icon-btn.btn-danger {
        background-color: #e74a3b;
    }
    
    .icon-btn i {
        font-size: 14px;
        color: white !important;
    }
</style>

<div class="container-fluid p-0">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item "><a href="<?php echo base_url("admin/Dashboard/");?>" class="text-decoration-none">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Branch Franchise </li>
        </ol>
    </nav>
</div>
	<div id="message" class="text-primary text-center"></div>
		<div class="table-responsive shadow-lg">
			<table class=" table-bordered text-center table-hover table-responsive" id="dtBasicExample">
				<span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>
                <span class="text-center text-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error');?></span>				
				<thead class="text-white bg-primary">
					<tr>
					    <th class=''>Sl No.</th>
						<th class=''>Name</th>
						<th class=''>Email</th>
						<th class=''>Mobile</th>
						<th class=''>City</th>
						<th class=''>Subscription</th>
						<th class=''>Account Type</th>
						<th class=''>Password</th>
						<th class=''>Date</th>
						<th class=''>Status</th>
						<th class=''>User Profile</th>
						<th class=''>Action</th>
						<!--<th class=''>Action</th> -->
					</tr>
				</thead>
				<tbody id="appBody">
					<?php
					if(!empty($datas)) {
					 $num = count($datas) ; 
					foreach($datas as $data) {

                         if (!empty($data->parent_id) == '') {
                        $c = 'Registered User';
                            }elseif (!empty($data->subscription) != '') {
                                if (!empty($data->parent_id) != '') {
                                    $c = 'Network Member';
                                }
                            }elseif (!empty($data->parent_id) != '') {
                                if (!empty($data->subscription) == '') {
                                    $c = 'Team Member';
                                }
                        }
                        ?>
					<tr>
						<td class=''><?php echo $num; ?></td>						
						<!--<td class=''><?php echo ucwords($data->username); ?></td>-->
						<td  style='text-wrap:nowrap;'><?php echo ucwords($data->name); ?>
                    <?php  if ($data->transfer_status == 1) { ?>
                            <i class="fa fa-refresh text-primary p-1"aria-hidden="true"></i>
                        <?php }?></td>
						<td class=''><?php echo ucwords($data->email); ?></td>
						<td class=''><?php echo ucwords($data->mobile_no); ?></td>
						<td class=''><?php echo ucwords($data->city); ?></td>
                        
						<td class=''><?php
                        if ($data->subscription == 'platinum_free') {
                            echo "Platinum free plan";
                            }elseif ($data->subscription == 'silver_free') {
                            echo "Sliver free plan";
                            }elseif ($data->status == 2 ) {
                                echo "Unpaid";
                            }else {
                                echo ucwords($data->subscription);
                            }
                        ?>
                        </td>
						<!-- <td class=''><?php echo ucwords($data->account_type); ?></td> -->
                        <td class=''><?php echo ucwords($c); ?></td> 
						<td class=''><?php echo $data->pass_text; ?></td>
						<td class=''>
                            <?php
                         if (!empty($data->date)) {
                                echo ucwords(date('d-m-Y h:i A', strtotime($data->date)));
                            } else {
                                echo ucwords(date('d-m-Y h:i A', strtotime($data->created_on)));
                            }    
                        ?></td>
						
						<td class=''><?php  if ($data->status == 1) {echo 'Active';} else {echo 'Inactive';} ?></td>
                        <td style="word-spacing: 15px">
					        <a class="icon-btn" href="<?php echo base_url('admin/Dashboard/branchProfiledetail/').$data->id;?>"><i class="fa fa-user  fa-lg" aria-hidden="true"></i></a>
                             <a class="icon-btn" href="<?php echo base_url('admin/agreement/'.$data->id.'/'.$data->role);?>"><i class="fa fa-file  fa-lg" aria-hidden="true"></i></a>
					   
					    </td> 
						<td style="word-spacing: 15px">
                            <div class="d-flex justify-content-center align-items-center" style="gap:10px;">
                        <?php if ($this->session->userdata('role') == 1) { ?>
					        <a class="icon-btn" href="<?php echo base_url('admin/edit-branch-franchise/').$data->id;?>"><i class="fa fa-pencil-square-o  fa-lg" aria-hidden="true"></i></a>
					        <a class="icon-btn btn-danger" href="#" ><i class="fa fa-trash fa-lg" aria-hidden="true" onclick="deleteUser(<?= $data->id ?>)"></i></a> 
                        <?php }?>
					        <a class="icon-btn" href="#" ><i class="fa fa-eye  fa-lg" aria-hidden="true" onclick="statusUser(<?= $data->id ?>, <?= $data->status ?>)"></i></a>
					   </div>
					   </td>
				
					</tr>
				   <?php $num--;  } } ?>
				</tbody>
			</table>
		</div>
	</div>
<script>
    $(document).ready(function () {
        $('#dtBasicExample').DataTable({
            "order": [[ 0, 'desc' ]],
            responsive: true,
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'copyHtml5',
                    text: '📋 Copy',
                    titleAttr: 'Copy to clipboard'
                },
                {
                    extend: 'excelHtml5',
                    text: '📊 Excel',
                    titleAttr: 'Export to Excel'
                },
                {
                    extend: 'pdfHtml5',
                    text: '📄 PDF',
                    titleAttr: 'Export to PDF',
                    orientation: 'landscape',
                    pageSize: 'A4'
                }
            ]
        });
       
    });

</script>



<script>
 function deleteUser(id) {
     if (confirm("Are you sure want to delete") == true) {
         $.ajax({
            url: "<?= base_url() ?>admin/delete-branch",
            type: "POST",
            data: { id: id},
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
 
  function statusUser(id, status) {
    if (confirm("Are you sure want to change the status of Agent") == true) {
         $.ajax({
             url: "<?= base_url() ?>admin/status-agents",
            type: "POST",
            data: { id: id, status: status},
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
 
  function agentCity() {
        var agentCity = $('#agentCity').find(":selected").val();
         
        var str = "";
        $("#appBody").empty();
        if(agentCity) {
            $.ajax({
                type: 'POST',
                url: 'get-agent-city',
                data: { 
                    'city': agentCity, 
                },
                success: function(result) {
                    var obj = JSON.parse(result);
                    
                    if(obj.agent_city.length > 0) {
                        
                        
                        $.each(obj.agent_city, function(index, element) {
                            let act = "Inactive"
                            if(element.status == 1) {
                                act = "Active"
                            }
                            str += '<tr>' ;
                            str += '<td>' + ++index + '</td>';
                            str += '<td>' + element.name + '</td>';
                            str += '<td>' + element.email + '</td>';
                            str += '<td>' + element.mobile_no + '</td>';
                            str += '<td>' + element.city + '</td>';
                            str += '<td>' + element.subscription + '</td>';
                            
                            
                            str += '<td>' + act + '</td>';
                            
                            str += '<td style="word-spacing: 15px">';
                            
                            
                            str += '<a  href="http://instantloansdeals.com/beta/admin/edit-partner/'+id+'"><i class="fa fa-pencil-square-o text-primary fa-lg" aria-hidden="true"></i></a>';
                            str += '<a id="test" href="#" ><i class="fa fa-trash text-danger fa-lg" aria-hidden="true" onclick="deleteUser('+element.id+')"></i></a>'; 
					        str += '<a href="#" ><i class="fa fa-eye text-primary fa-lg" aria-hidden="true" onclick="statusUser('+element.id+','+element.status+')"></i></a>';
                            str += '</td>';
                            
                                   
                            str += '</tr>';
                        });
                         $('#appBody').append(str);
                        
                    }
                    else {
                         str += '<tr><td colspan="12">No data found</td></tr>' ;
                         $('#appBody').append(str);
                        
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
    $("#appBody tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>