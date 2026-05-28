


<div class="container-fluid p-0">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin/Dashboard/");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">My Network</li>
           </ol>
         </nav>
</div>
<div class="container">
    <div class="row" style="margin-bottom: -90px;">
        <div class="col-md-12">
        	 <section class="content">
        	  <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-md-4">
                        <div _ngcontent-wsc-c195="" 
                            class="form-group">
                            <select _ngcontent-wsc-c195="" name="network" id="network" onchange="getCustomer()" class="form-control form-control-alternative">
                                <option _ngcontent-wsc-c195="" value="">Select Network</option>
                                <option _ngcontent-wsc-c195="" value="customer">Customer</option>
                                <?php if($role == 1) {   ?>
                                <option _ngcontent-wsc-c195="" value="partner">Channel Partner</option>
                                <?php } ?>
                               
                            </select>
                        </div>
                        
                    </div>
                    <!--<div class="col-md-4 ">-->
                    <!--    <div _ngcontent-wsc-c195="" -->
                    <!--        class="form-group">-->
                    <!--        <select _ngcontent-wsc-c195="" name="customer" id="customer" class="form-control form-control-alternative">-->
                    <!--            <option _ngcontent-wsc-c195="" value="">Select People</option>-->
                                
                    <!--        </select>-->
                    <!--    </div>-->
                        
                    <!--</div>-->
                    
                </div>
              </div>
            </section>
       </div>
    </div>
    <div class="row">
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
					
						<th class=''>Status</th>
						<!--<th class=''>Action</th>					-->
					</tr>
				</thead>
				<tbody id="networkBody">
					<?php
					if(!empty($datas)) {
					 $num = count($datas) ; 
					foreach($datas as $data) { ?>
					<tr>
						<td class=''><?php echo $num; ?></td>
						<?php if($role == 2) {   ?>
						<td class=''><?php echo ucwords($data->name); ?></td>
						<td class=''><?php echo ucwords($data->email); ?></td>
						<td class=''><?php echo ucwords($data->mobile); ?></td>
						
						<?php } else {  ?>
						<td class=''><?php echo ucwords($data->name); ?></td>
						<td class=''><?php echo ucwords($data->email); ?></td>
						<td class=''><?php echo ucwords($data->mobile); ?></td>
						
						<?php } ?>
						
						<td class=''><?php  if ($data->status == 1) {echo 'Active';} else {echo 'Inactive';} ?></td>
						<!--<td>-->
					 <!--       <a href="<?php echo base_url('admin/edit-user/').$data->id;?>"><i class="fa fa-pencil-square-o text-primary fa-lg" aria-hidden="true"></i></a>-->
					        
					        <!--<a href="javascript:void(0)" id="<?= $data->id ?>" class="cremove"><i class="fa fa-trash text-danger fa-lg" aria-hidden="true"></i></a> -->
					        
					        <!--<a href="#"><i class="fa fa-pencil-square-o text-primary fa-lg" aria-hidden="true"></i></a>-->
					 <!--       <a href="#" ><i class="fa fa-trash text-danger fa-lg" aria-hidden="true" onclick="delUser(<?= $data->id ?>)"></i></a>-->
					 <!--  </td>-->
				
					</tr>
				   <?php $num--;  } } else {?>
				   <tr><td colspan="12"> Data not found.</td></tr>
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

</script>
