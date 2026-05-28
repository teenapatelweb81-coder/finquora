
<?php //echo '<pre>';print_r($datas);die;?>
<div class="container-fluid p-0">
    <nav aria-label="breadcrumb">
    <ol class="breadcrumb ">
        <li class="breadcrumb-item "><a href="<?php echo base_url("admin/Dashboard/"); ?>" class="text-decoration-none">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">My Network</li>
    </ol>
    </nav>
</div>
<div class="container-fluid px-0">
    <div class="row m-0">
        <div class="col-md-12 px-0">
        	 <section class="content">
        	  <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row m-0">

                     <div class="col-md-4">
                        <div _ngcontent-wsc-c195=""
                            class="form-group mb-2">
                            <input type="text" id="filter-table" name="filter-table" placeholder="Search . . ." class="form-control form-control-alternative" />
                        </div>

                    </div>
                    <div class="col-md-2">
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-2 text-right">
                            <a href="<?php echo base_url('admin/add-network-member'); ?>"><button type="button" class="btn btn-primary" >Add Network Member</button></a>
                            <a href ="javascript:void(0);" onclick = copyLink("<?php echo base_url('admin/add-network-member-share?type='); ?><?=$this->session->userdata('user_id')?>&role=<?= $this->session->userdata('role');?>")><button type="button" class="btn btn-primary">share network member link</button></a>
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
			<table class="table table-bordered text-center table-hover">
				<span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success'); ?></span>
                <span class="text-center text-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error'); ?></span>
				<thead class="text-white bg-primary">
					<tr>
						<th class=''>Sl No.</th>
						<th class=''>Name</th>
						<th class=''>Email</th>
						<th class=''>Mobile</th>
						<th class=''>Status</th>
						<th class=''>Paid Plan</th>
						<th class=''>Amount</th>
						<th class=''>Parent name</th>
						<th class=''>Date And Time</th>
                        <th class=''>Membership  Code</th>
                        <th class=''>Referral Amount</th>
						<th class=''>Action</th>
					</tr>
				</thead>
				<tbody id="networkBody">
					<?php
                        if (!empty($datas)) {
                        $num = 1;
                        foreach ($datas as $data) {
                         $parent_name = '';
                         $parent_name = $this->db->where('id',$data->parent_id)->get('branch_franchise')->row('name');
                         
                         if ($parent_name == '') {
                             $parent_name = $this->db->where('id',$data->parent_id)->get('user_master')->row('name');
                            }
                            // print_r($parent_name);die;
                      
                        ?>
					<tr>
						<td class=''><?php echo $num; ?></td>
						
                            <td class=''><?php echo ucwords($data->name); ?>
                         <?php  if ($data->transfer_status_user == 1 ) { ?>
                            <i class="fa fa-refresh text-primary p-1"aria-hidden="true"></i>
                        <?php }?></td>
                            <td class=''><?php echo ucwords($data->email); ?></td>
                            <td class=''><?php echo ucwords($data->mobile_no); ?></td>

						<td class=''><?php if ($data->status == 1) {echo 'Active';} else {echo 'Inactive';}?></td>
                         <td class=''><?php echo ucwords($data->subscription); ?></td>

                    <?php
                        $amount = '';
                        $plan = $this->db->where('domain_id', $data->domain_id)->where('uid', $data->id)->get('tbl_transection')->row();
                        $amount = $plan->plan_amount ?? null;
                        $domain =  $this->db->where('id',$data->domain_id)->get('domains')->row_array();

                    ?>
                        <!-- <td class=''><?php echo ucwords($amount); ?></td> -->
                        <td class=''><?php echo ucwords($data->plan_amount); ?></td>
                        <td class=''><?php echo ucwords($parent_name); ?></td>
                          <td class=''><?php echo date('d-m-Y h:i A', strtotime(($data->created_on))); ?></td>
                          <td class=''><?php echo ucwords($data->code); ?></td>
                           <td class=''>₹<?php if (!empty($data->referral_amount)) {echo $data->referral_amount;} else {echo 0;}?></td>
						<td>
					        <a href="<?php echo base_url('admin/edit-partner/') . $data->id; ?>?ref=my-network"><i class="fa fa-pencil-square-o text-primary fa-lg" aria-hidden="true"></i></a>
					 <a href="#" ><i class="fa fa-eye text-primary fa-lg" aria-hidden="true" onclick="statusUser(<?=$data->id?>, <?=$data->status?>)"></i></a>
					   </td>

					</tr>
				   <?php $num++;}}?>
				</tbody>
			</table>
			</div>
		</div>
	</div>

</div>


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
                            <?php if ($role == 2) {?>
                            str += '<td>' + element.first_name + '</td>';
                            str += '<td>NA</td>';
                            str += '<td>' + element.mobile + '</td>';

                            <?php } else {?>
                                str += '<td>' + element.name + '</td>';
                                str += '<td>' + element.email + '</td>';
                                if(networkId == "customer") {
                                    str += '<td>' + element.mobile + '</td>';
                                }
                                else {
                                    str += '<td>' + element.mobile_no + '</td>';
                                }

                            <?php }?>

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
