<style>
    a#test {
    padding-left: 10px;
    padding-right: 10px;
    }
</style>

<div class="container-fluid p-0">
   <div class="row m-0">
      <div class="col-md-12 px-0">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin/Dashboard/");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Customer list</li>
           </ol>
         </nav>
</div>
<div class="container-fluid px-0">
    <div class="row m-0">
        <div class="col-md-12 px-0">
        	 <section class="content">
        	  <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-md-4">
                        <div _ngcontent-wsc-c195="" 
                            class="form-group mb-1">
                            <select _ngcontent-wsc-c195="" name="userCity" id="userCity" onchange="userCity()" class="form-control form-control-alternative">
                                <option _ngcontent-wsc-c195="" value="all" selected="">All</option>
                                <?php if(sizeof($city) > 0 ) { ?>
                                <?php foreach($city as $c) { ?>
                                    <option _ngcontent-wsc-c195="" value="<?=$c->city?>"><?=$c->city?></option>
                               <?php  } ?>
                                
                                
                                <?php } ?>
                                <!--<option _ngcontent-wsc-c195="" value="custom">Custom</option>-->
                            </select>
                        </div>
                        
                    </div>
                    
                    <div class="col-md-4">
                        <div _ngcontent-wsc-c195="" 
                            class="form-group mb-1">
                            <input type="text" id="filter-table" name="filter-table" placeholder="Search . . ." class="form-control form-control-alternative" />
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
			<div class="table-responsive shadow-lg">
			<table class=" table-bordered text-center table-hover" id="dtBasicExample">
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
						<th class=''>Date</th>
						<th class=''>Pasword</th>
						<th class=''>Status</th>
						<th class=''>Update Detail</th>
                        <th class=''>Action</th>
					</tr>
				</thead>
				<tbody id="appBody">
				    <?php
					if(!empty($datas)) {
					 $num = count($datas); 
					foreach($datas as $data) {
                         $eligibilityData = $this->db->from('check_user_data')->where('uid', $data->id)->get()->row();
                        $city = '';

                        if (!empty($data->city)) {
                            $city = $data->city;
                        } elseif (!empty($eligibilityData) && !empty($eligibilityData->city)) {
                            $city = $eligibilityData->city;
                        } else {
                            $city = ''; 
                        }
                        ?>
					<tr>
						<td ><?php echo $num; ?></td>						
						<!--<td class=''><?php echo ucwords($data->username); ?></td>-->
						<td  style='text-wrap:nowrap;'><?php echo ucwords($data->name); ?>
                         <?php  if ($data->transfer_status == 1) { ?>
                            <i class="fa fa-refresh text-primary p-1"aria-hidden="true"></i>
                        <?php }?></td>
						<td class=''><?php echo ucwords($data->email); ?></td>
						<td class=''><?php echo ucwords($data->mobile); ?></td>
                            <td class=''><?php echo ucwords($city); ?></td>
						<td class=''>
                        <?php  if ($data->subscription == 'platinum_free') {
                            echo "Platinum free plan";
                            }elseif ($data->subscription == 'silver_free') {
                            echo "Sliver free plan";
                            }elseif ($data->status == 1 ) {
                                echo ucwords($data->subscription);
                            }else {
                                echo "Unpaid";
                            }
                            ?>
                        </td>
						<td class=''><?php
                            if (!empty($data->date)) {
                                echo ucwords(date('d-m-Y h:i A', strtotime($data->date)));
                            } else {
                                echo ucwords(date('d-m-Y h:i A', strtotime($data->created_on)));
                            }
                            ?>
</td>
                        <td class=''><?php echo $data->pass_text; ?></td>
						<td class=''><?php  if ($data->status == 1) {echo 'Active';} else {echo 'Inactive';} ?></td>
                        <td style="word-spacing: 15px">
					        <a href="<?php echo base_url('admin/edit-detail/').$data->id;?>"><i class="fa fa-pencil-square text-warning fa-lg" aria-hidden="true"></i></a>
                    </td>
						<td style="word-spacing: 15px">
                            <div class="d-flex justify-content-center align-items-center" style="gap:10px;">
                                
                                <!--<a href="javascript:void(0)" id="<?= $data->id ?>" class="cremove"><i class="fa fa-trash text-danger fa-lg" aria-hidden="true"></i></a> -->
                                
                                <!--<a href="#"><i class="fa fa-pencil-square-o text-primary fa-lg" aria-hidden="true"></i></a>-->
                                 <?php if ($this->session->userdata('role') == 1) { ?>
                            <a href="<?php echo base_url('admin/edit-user/').$data->id;?>"><i class="fa fa-pencil-square-o text-primary fa-lg" aria-hidden="true"></i></a>
					        <a href="#" ><i class="fa fa-trash text-danger fa-lg" aria-hidden="true" onclick="delUser(<?= $data->id ?>)"></i></a>
                            <?php }?>
                            <a href="<?php echo base_url('admin/view-user/').$data->id;?>"><i class="fa fa-info-circle  text-success" aria-hidden="true"></i></a>
					         <a href="#" ><i class="fa fa-eye text-primary fa-lg" aria-hidden="true" onclick="statusUser(<?= $data->id ?>, <?= $data->status ?>)"></i></a>
                        </div>
					   </td>
				
					</tr>
				   <?php $num--;  } } else {?>
				   <tr><td colspan="5">Register User Details not available.</td></tr>
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
            "order": [[ 0, 'desc' ]],
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
 function delUser($id) {
    if (confirm("Are you sure want to delete") == true) {
         $.ajax({
            url: "delete-user",
            type: "POST",
            data: { id: $id},
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
 
  function statusUser($id, $status) {
    if (confirm("Are you sure want to change the status of Customer") == true) {
         $.ajax({
            url: "status-user",
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
 
 function userCity() {
        var userCity = $('#userCity').find(":selected").val();
         
        var str = "";
        
        $("#appBody").empty();
        if(userCity) {
            $.ajax({
                type: 'POST',
                url: 'get-user-city',
                data: { 
                    'city': userCity, 
                },
                success: function(result) {
                    var obj = JSON.parse(result);
                    
                    if(obj.user_city.length > 0) {
                        
                        $.each(obj.user_city, function(index, element) {
                            let act = "Inactive"
                            if(element.status == 1) {
                                act = "Active"
                            }
                            var id = element.id;
                            
                            str += '<tr>' ;
                            str += '<td>' + ++index + '</td>';
                            str += '<td>' + element.name + '</td>';
                            str += '<td>' + element.email + '</td>';
                            str += '<td>' + element.mobile + '</td>';
                            str += '<td>' + element.city + '</td>';
                            str += '<td>' + element.subscription + '</td>';
                            
                            str += '<td>' + act + '</td>';
                            str += '<td style="word-spacing: 15px">';
                            
                            
                            str += '<a  href="http://instantloansdeals.com/beta/admin/edit-user/'+id+'"><i class="fa fa-pencil-square-o text-primary fa-lg" aria-hidden="true"></i></a>';
                            str += '<a id="test" href="#" ><i class="fa fa-trash text-danger fa-lg" aria-hidden="true" onclick="delUser('+element.id+')"></i></a>'; 
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
