


<div class="container-fluid p-0">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin/Dashboard/");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">My applications</li>
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
                            <select _ngcontent-wsc-c195="" name="applicationDate" id="applicationDate" onchange="myapplicationData()" class="form-control form-control-alternative">
                                <option _ngcontent-wsc-c195="" value="all" selected="">All</option>
                                <option _ngcontent-wsc-c195="" value="today">Today</option>
                                <option _ngcontent-wsc-c195="" value="lastweek">Last Week</option>
                                <option _ngcontent-wsc-c195="" value="currentmonth">Current Month</option>
                                <option _ngcontent-wsc-c195="" value="lastmonth">Last Month</option>
                                <option _ngcontent-wsc-c195="" value="lastthreemonth">Last Three Month</option>
                                <option _ngcontent-wsc-c195="" value="qtd">Quarter to Date</option><option _ngcontent-wsc-c195="" value="YTD">Year to Date</option>
                                <!--<option _ngcontent-wsc-c195="" value="custom">Custom</option>-->
                            </select>
                        </div>
                        
                    </div>
                    
                     <div class="col-md-4">
                        <div _ngcontent-wsc-c195="" 
                            class="form-group">
                            <input type="text" id="filter-table" name="filter-table" placeholder="Search . . ." class="form-control form-control-alternative" />
                        </div>
                        
                    </div>
                    
                </div>
              </div>
              
            </section>
       </div>
    </div>
    <div class="row">
		<div class="col-md-12 px-0">
		    <div id="message" class="text-primary text-center"></div>
			<div class="table-responsive shadow-lg">
			<table class="table table-bordered text-center table-hover">
				<span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>
                <span class="text-center text-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error');?></span>				
				<thead class="text-white bg-primary">
					<tr>
						<th class=''>Sl No.</th>
						<th class=''>Process Name</th>
						<th class=''>Process Type</th>
						<th class=''>Title</th>
						<th class=''>First Name</th>
						<th class=''>Last Name</th>
						<th class=''>Loan Amount</th>
						<th class=''>Gender</th>
						<th class=''>Mobile</th>
						<th class=''>DOB</th>
						<!--<th class=''>Action</th>					-->
					</tr>
				</thead>
				<tbody id="appBody">
					<?php
					if(!empty($datas)) {
					 $num = 1 ; 
					foreach($datas as $data) { ?>
					<tr>
						<td class=''><?php echo $num; ?></td>						
						<td class=''><?php echo ucwords($data->process_name); ?></td>
						<td class=''><?php echo ucwords($data->process_type); ?></td>
						<td class=''><?php echo ucwords($data->title); ?></td>
						<td class=''><?php echo ucwords($data->first_name); ?></td>
						<td class=''><?php echo ucwords($data->last_name); ?></td>
						<td class=''><?php echo ucwords($data->loan_amount); ?></td>
						<td class=''><?php echo ucwords($data->gender); ?></td>
						<td class=''><?php echo ucwords($data->mobile); ?></td>
						<td class=''><?php echo ucwords($data->dob); ?></td>
						
						<!--<td class=''><?php  if ($data->status == 1) {echo 'Active';} else {echo 'Inactive';} ?></td>-->
						<!--<td>-->
					 <!--       <a href="<?php echo base_url('admin/edit-user/').$data->id;?>"><i class="fa fa-pencil-square-o text-primary fa-lg" aria-hidden="true"></i></a>-->
					        
					        <!--<a href="javascript:void(0)" id="<?= $data->id ?>" class="cremove"><i class="fa fa-trash text-danger fa-lg" aria-hidden="true"></i></a> -->
					        
					        <!--<a href="#"><i class="fa fa-pencil-square-o text-primary fa-lg" aria-hidden="true"></i></a>-->
					 <!--       <a href="#" ><i class="fa fa-trash text-danger fa-lg" aria-hidden="true" onclick="delUser(<?= $data->id ?>)"></i></a>-->
					 <!--  </td>-->
				
					</tr>
				   <?php $num++;  } } else {?>
				   <tr><td colspan="12">No data found</td></tr>
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

    function myapplicationData() {
        var applicationData = $('#applicationDate').find(":selected").val();
         
        var str = "";
        $("#appBody").empty();
        if(applicationData) {
            $.ajax({
                type: 'POST',
                url: 'get-application-data',
                data: { 
                    'date': applicationData, 
                },
                success: function(result){
                    var obj = JSON.parse(result);
                    //console.log(obj.application_data);
                    if(obj.application_data.length > 0) {
                        
                        $.each(obj.application_data, function(index, element) {
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
