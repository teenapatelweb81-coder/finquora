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
               <li class="breadcrumb-item active" aria-current="page">Self Bank login </li>
           </ol>
         </nav>
</div>
<div class="container-fluid px-0">
    <div class="row m-0 bg-white">
		<div class="col-md-12 px-0">
            <span class="text-center text-info" id="susid"> <?php echo $this->session->flashdata('success'); ?></span>
            <span class="text-center text-danger" id="errid"> <?php echo $this->session->flashdata('error'); ?></span>
               <?php if($this->session->userdata('role') == 1 || $count > 0 ||  $count2 > 0 ||  $count3 > 0) { ?>
		    <div id="" class="text-primary text-right  mr-2">
                <a href="<?php echo base_url() ?>admin/loan-company-master-form" class="btn btn-primary"><i class="fa fa-plus text-light fa-sm" aria-hidden="true"></i> Add</a>
            </div>
            <?php }?>

			<div class="table-responsive ">
			<table class=" table-bordered text-center table-hover" id="dtBasicExample">
				<thead class="text-white bg-primary">
					<tr>
						<th class=''>Sr No.</th>
						<th class=''>Bank name</th>
                        <th class=''>Loan Type</th>
						<th class=''>URL</th>
						<th class=''>User ID</th>
						<th class=''>Password</th>
                        <th class=''>Image</th>
                        <th class=''>Pincode PDF/Excel</th>
                        <th class=''>Bank Criteria PDF File</th>
                        <th class=''>Description</th>
                        <?php if($this->session->userdata('role') == 1) { ?>
                        <th class=''>Action</th>
                        <?php }?>
					</tr>
				</thead>
				<tbody id="leadBody">
				    <?php
                    if (!empty($banker)) {
                        $num = count($banker);
                        foreach ($banker as $data) {
                        $domain =  $this->db->where('id',$data->domain_id)->get('domains')->row_array();
                        ?>
					<tr>
						<td class=''><?php echo $num; ?></td>
						<td class=''><?=$data->bank_name?></td>
						<td class=''><?=$data->loan_type?></td>
						<td class=''><?php if ($data->link) {?>
                            <a href="<?=$data->link?>" target="_blank"><?=$data->link?></a>
                            <div class=""><i class="fa fa-copy btn btn-success" style="cursor:pointer;" aria-hidden="true" onclick="copyLink('<?=$data->link?>')"></i></div><?php }?>
                        </td>
						<td class=''><?php if ($data->user) {?>
                            <?= $data->user?><div class=""><i class="fa fa-copy btn btn-success" style="cursor:pointer;" aria-hidden="true" onclick="userName('<?=$data->user?>')"></i></div> <?php }?>
                        </td>
						<td class=''><?php if ($data->password) {?><?=$data->password?><div class=""><i class="fa fa-copy btn btn-success" style="cursor:pointer;" aria-hidden="true" onclick="password('<?=$data->password?>')"></i></div><?php }?></td>
						<td class=''>
                            <?php if (!empty($data->image)) {?>
                                <img src="<?=base_url()?>/<?=$data->image?>" width="100px"/>
                            <?php }?>
                        </td>
                        <td class=''>
                            <?php if (!empty($data->pincode_document)) {?>
                               <a href="<?=base_url()?>/<?=$data->pincode_document?>" class="btn btn-danger" > <i class="fa fa-file"></i></a>
                            <?php }?>
                        </td>
						<td class=''>
                            <?php if (!empty($data->document)) {?>
                               <a href="<?=base_url()?>/<?=$data->document?>" class="btn btn-danger" > <i class="fa fa-file"></i></a>
                            <?php }?>
                        </td>
						<td class=''><?=$data->descriptions?></td>
                          <?php if($this->session->userdata('role') == 1) { ?>
						<td>
					       <a href="<?php echo base_url('admin/loan-company-master-edit/') . $data->id; ?>"><i class="fa fa-pencil-square-o text-primary fa-lg" aria-hidden="true"></i></a>
					       <a href="<?php echo base_url('admin/Dashboard/loan_company_master_delete/') . $data->id; ?>" onclick="return confirm('Are you sure ?')" ><i class="fa fa-trash text-danger fa-lg" aria-hidden="true" onclick="delLead"></i></a>
					   </td>
                       <?php }?>
                         <?php $num--;}?>
					</tr>
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


function copyLink(url) {
    var input = document.createElement('input');
    input.value = url;
    document.body.appendChild(input);
    input.select();
    document.execCommand('copy');
    document.body.removeChild(input);
    alert('URL copied to clipboard : ' + url);
}

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