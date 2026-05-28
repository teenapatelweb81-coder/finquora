
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
        <li class="breadcrumb-item active" aria-current="page">Banker List</li>
    </ol>
    </nav>
</div>
<div class="container-fluid px-0">
    <div class="row m-0">
		<div class="col-md-12 px-0">
            <div id="" class="text-primary text-right">
                
                 <?php if($this->session->userdata('role') == 1 || $count > 0 ||  $count2 > 0 ||  $count3 > 0) { ?>
                <button class="btn btn-primary pull-right ml-2" type="button" id="addMember" style="float: right; margin-bottom:10px;" data-toggle="modal" data-target="#download_salerate" >Upload Banker Excel</button>

                    <a href="<?php echo base_url() ?>admin/banker-add" class="btn btn-primary"><i class="fa fa-plus text-light fa-sm" aria-hidden="true"></i> Add</a>
                <?php }?>
            </div>
            <form action="<?=base_url('admin/banker')?>" method="get" class="card w-100 pt-3 p-2 mb-1">
                <div class="row w-100">
                    <div class="col-md-3">
                        <select  class="form-control mb-2" name="states" id="state">
                            <option value="">Select State</option>
                            <?php
                            if (!empty($states)) {
                                foreach ($states as $key => $value) {
                                    ?>
                            <option <?=(isset($_GET['states']) && $_GET['states'] == $value->state) ? "selected" : '';?> value="<?=$value->state?>"> <?=$value->state?></option>
                            <?php }}?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select  class="form-control mb-2" name="citys" id="city">
                            <option value="">Select City</option>
                            <?php
                                if (!empty($cities)) {
                                    foreach ($cities as $key => $value) {
                                        ?>
                            <option <?=(isset($_GET['citys']) && $_GET['citys'] == $value['city']) ? "selected" : '';?> value="<?=$value['city']?>"><?=$value['city']?></option>
                            <?php }}?>
                        </select>
                    </div>
                    <div class="col-md-3">
                    <select class="form-control mb-2" name="products" id="">
                        <option value="">Select Product</option>
                        <?php
                        if (!empty($products)) {
                            foreach ($products as $key => $value) {
                        ?>
                        <option <?= (isset($_GET['products']) && $_GET['products'] == $value['product']) ? "selected" : ''; ?> 
                            value="<?=$value['product']?>"><?=$value['product']?></option>
                        <?php }}?>
                    </select>
                </div>

                <div class="col-md-3">
                    <select class="form-control mb-2" name="bankNames" id="">
                        <option value="">Select Bank</option>
                        <?php
                        if (!empty($bankNames)) {
                            foreach ($bankNames as $key => $value) {
                        ?>
                        <option <?= (isset($_GET['bankNames']) && $_GET['bankNames'] == $value['bank_id']) ? "selected" : ''; ?> 
                            value="<?=$value['bank_id']?>"><?=$value['bank_id']?></option>
                        <?php }}?>
                    </select>
                </div>
                    
                <div class="col-md-12 text-right">
                    <button type="submit" class="btn btn-success">Search</button>
                    <a href="<?=base_url('admin/banker')?>" class="btn btn-danger">Reset</a>
                </div>

                </div>
            </form>
            <div class="table-responsive ">
			<table class="table table-bordered text-center table-hover" id="">
                <?php if ($this->session->flashdata('success')) {?>
				<p class="alert alert-success mb-2" id="susid">
                    <?php echo $this->session->flashdata('success'); ?>
                </p>
                <?php }?>
                <?php if ($this->session->flashdata('error')) {?>
                <p class="alert alert-danger mb-2" id="errid">
                    <?php echo $this->session->flashdata('error'); ?>
                </p>
                <?php }?>
				<thead class="text-white bg-primary">
					<tr class="text-center">
						<th class=''>Sr No.</th>
                        <th class=''>State</th>
						<th class=''>City</th>
						<th class=''>Product</th>
                        <th class=''>Bank Name</th>
                        <th class=''>Banker Name</th>
                        <th class=''>Bank Contact No</th>
                        <th class=''>Mail Id</th>


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
                            // $bankName = $this->db->where('id',$data->bank_id)->get('tbl_banks')->row('bank_name');
 
                            ?>
					<tr>
		                <td class=''><?php echo $num; ?></td>
						<td class=''><?=$data->state?></td>
						<td class=''><?=$data->city?></td>
                        <td class=''><?=$data->product?></td>
                        <td class=''><?=$data->bank_id?></td>
                        <td class=''><?=$data->name?></td>
                        <td class=''><?=$data->mobile?></td>
                        <td class=''><?=$data->email?></td>



                         <?php if($this->session->userdata('role') == 1) { ?>
						<td>
					       <a href="<?php echo base_url('admin/banker_edit/') . $data->id; ?>"><i class="fa fa-pencil-square-o text-primary fa-lg" aria-hidden="true"></i></a>
					        <a href="<?php echo base_url('admin/Dashboard/banker_del/') . $data->id; ?>" onclick="return confirm('Are you sure ?')" ><i class="fa fa-trash text-danger fa-lg" aria-hidden="true" onclick="delLead"></i></a>
					   </td>
                    <?php }?>
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
<!-- import modal -->

<div class="modal fade" id="download_salerate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabela" aria-hidden="true">
    <div class="modal-dialog" role="documents">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabela">Banker Excel File Import</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="javascript:void(0);" method="post" id="import_intDownload_banker" enctype="multipart/form-data">
            <div class="form-group">
                    <label for="formClient-Name">Excel Import</label>
                    <input type="file" class="form-control" name="files" id="files" required autofocus />
                    <a href="<?=base_url('assets/excel_files/BankerImport.xlsx')?>" download="">example file</a>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>

        </div>
    </div>
</div>
<script>
function loadCities(state_id, selectedCity = "") {

    if (state_id == "" || state_id == null) {
        $('#city').html('<option value="">Select City</option>');
        return;
    }

    $.ajax({
        url: "<?= base_url('admin/Dashboard/getCityBanker'); ?>",
        type: "POST",
        data: { id: state_id },
        success: function (data) {
            $('#city').html(data);
            if (selectedCity !== "") {
                $('#city').val(selectedCity);
            }
        }
    });
}


$('#state').change(function () {
    var state_id = $(this).val();
    loadCities(state_id);  
});


$(document).ready(function () {

    var selectedState = $("#state").val();  
    var selectedCity = "<?= isset($_GET['citys']) ? $_GET['citys'] : '' ?>";

    if (selectedState !== "") {
        loadCities(selectedState, selectedCity);
    }

});



$('#import_intDownload_banker').submit(function(e){
    
    console.log('hii');
    e.preventDefault();
     var formData = new FormData(this);
    $(':input[type="submit"]').prop('disabled', true);
     $.ajax({
        url:'<?=base_url('admin/banker-excel-import')?>',
        type:'post',
        data:formData,
        cache:false,
        contentType: false,
        processData: false,
        success:function(result){
            console.log(result);
            $(':input[type="submit"]').prop('disabled', false);
            if(result.trim() == 'yes'){
                $('#download_salerate').modal('hide');
                $('#import_intDownload_banker').trigger('reset');
                // alert("File Import Successfully");
                // swal({
                //     title: "Success",
                //     text: "File Import Successfully",
                //     icon: "success",
                //     button: false,
                //     timer: 3000
                // });
                location.reload(true);
                // setTimeout(function() {
                // }, 3000);
            }else if(result.trim() == 'not'){
                alert("Some Error Occured Plase Try again.");
                // swal({
                //     title: "Failed",
                //     text: "Some Error Occured Plase Try again.",
                //     icon: "error",
                //     button: false,
                //     timer: 3000
                // });
            }
        }
     });
  })
</script>