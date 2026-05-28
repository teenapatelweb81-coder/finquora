

<style>
    iframe {
        width: 200px !important;
        height: 100px !important;
    }
</style>

<div class="container-fluid p-0">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin/Dashboard/"); ?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Smart choice list</li>
           </ol>
         </nav>
</div>
<div class="container-fluid">
   
    <div class="row  m-0">
		<div class="col-md-12 ">
              <?php //if($_SESSION['role'] == 1){ ?>
		    <div id="" class="text-primary text-right mb-3">
                <a href="<?php echo base_url() ?>admin/smart-choice-add" class="btn btn-primary"><i class="fa fa-plus text-light fa-sm" aria-hidden="true"></i> Add</a>

            </div>
            <?php // }?>

			<div class="table-responsive ">
			<table class="table table-bordered text-center table-hover" >
				<span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success'); ?></span>
                <span class="text-center text-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error'); ?></span>
				<thead class="text-white bg-primary">
					<tr>
						<th class=''>Sr No.</th>
						<th class=''>Icon</th>
						<th class=''>Title</th>
						<th class=''>Text</th>
                        <th class=''>Action</th>
						
					</tr>
				</thead>
				<tbody id="leadBody">
				    <?php
                    if (!empty($smartChoice)) {
                        $num = count($smartChoice);
                        foreach ($smartChoice as $data) {
                    ?>
					<tr>
						<td class=''><?php echo $num; ?></td>
						<td class=''><i class="<?=$data['icon']?>"></i></td>
						<td class=''><?=$data['title']?></td>
						<td class=''><?=$data['text']?></td>
						<td>
                    
					       <a href="<?php echo base_url('admin/smart-choice-edit/') . $data['id']; ?>"><i class="fa fa-pencil-square-o text-primary fa-lg" aria-hidden="true"></i></a>
					        <a href="<?php echo base_url('admin/smart-choice-del/') . $data['id']; ?>" onclick="return confirm('Are you sure ?')" ><i class="fa fa-trash text-danger fa-lg" aria-hidden="true" onclick="delLead"></i></a>

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


<script>
    $(document).ready(function () {
        $('#dtBasicExample').DataTable({
            "order": [[ 0, 'desc' ]]
        });
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

                            str += '<td><a href="<?php echo base_url("admin/edit-lead/"); ?>"'+ element.id +'><i class="fa fa-pencil-square-o text-primary fa-lg" aria-hidden="true"></i></a>';
                            str += '<a href="#" ><i class="fa fa-trash text-danger fa-lg" aria-hidden="true" onclick="delLead('+ element.id +')"></i></a></td>';

        //                     <td>
					   //     <a href="<?php echo base_url('admin/edit-user/') . $data->id; ?>"><i class="fa fa-pencil-square-o text-primary fa-lg" aria-hidden="true"></i></a>
					   //     <a href="#" ><i class="fa fa-trash text-danger fa-lg" aria-hidden="true" onclick="delUser(<?=$data->id?>)"></i></a>
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