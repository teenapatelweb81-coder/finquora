
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
        <li class="breadcrumb-item active" aria-current="page">Videos</li>
    </ol>
    </nav>
</div>
<div class="container-fluid px-0">
    <div class="row m-0 bg-white">
        <?php if($this->session->userdata('role') == 1) { ?>
            <div class="col-md-12 mt-1 px-0">
				<span class="text-center text-info mb-1" id="susid"> <?php echo $this->session->flashdata('success');?></span>
                <span class="text-center text-danger mb-1" id="errid"> <?php echo $this->session->flashdata('error');?></span>	

                <?php echo form_open_multipart('admin/Slider/heading_update');?>
                    <div class="px-2">
                        <div class="cart-b">
                            <div class="row align-items-end">
                                <div class="col-md-4 mt-1">
                                    <label for="Image Alt Description" class="form-label">Titles <span class="text-danger">*</span></label>
                                    <input type="text" name="title" id="title" class="form-control" value=" <?= (isset($heading->title)) ? $heading->title : '' ; ?>" required placeholder="Add Title">
                                    <input type="hidden" name="type" value="video">
                                    <input type="hidden" name="id" value="<?= (isset($heading->id)) ? $heading->id : '' ; ?>">
                                    <?php echo form_error('title','<span class="text-danger mt-1">','</span>') ;?>
                                </div>
                                <div class=" col-md-4  mt-1">
                                    <label for="Image Alt Description" class=" form-label">Description</label>
                                    <input type="text" name="description" id="description" class="form-control" placeholder="Add Description"value=" <?= (isset($heading->description)) ? $heading->description : '' ; ?>" >	
                                </div>
                                        
                        <?php
                            $selected_domain_id = isset($_GET['domain_id']) ? (int)$_GET['domain_id'] : null;
                            
                            if ($selected_domain_id) {
                                $website_id = $selected_domain_id;
                            } else {
                                $website_id = domain_id_get();
                            }

                            if ($this->session->userdata('type') == 'admin') { ?>
                                    <div class="col-4 mt-1">
                                        <label for="domain_id_main" class="col-form-label">Domain</label>
                                        <select class="form-control" id="domain_id_main" required name="domain_id" onchange="window.location.href = window.location.pathname + '?domain_id=' + this.value;">
                                            <?php foreach ($domains as $domain) { ?>
                                                <option <?= ($website_id == $domain['id']) ? 'selected' : ''; ?> value="<?= $domain['id'] ?>"> <?= $domain['url'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                        <?php }else{?>
                            <input type="hidden" name="domain_id"  class="form-control" value="<?= $website_id ?>" >
                        <?php }?>

                                <div class=" col-md-4  mt-1">
                                    <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-info mt-4">
                                </div>
                            </div>
                        </div>
                    </div>  
                <?php echo form_close();?>
            </div>
        <?php }?>
		<div class="col-md-12 mt-1 px-0">
          <?php if($this->session->userdata('role') == 1 || $count > 0 ||  $count2 > 0 ||  $count3 > 0) { ?>
		    <div id="" class="text-primary text-right mb-1 mr-1">
                <a href="<?= base_url()?>admin/videoAdd" class="btn btn-primary"><i class="fa fa-plus text-light fa-sm" aria-hidden="true"></i> Add</a>
            </div>
          <?php } ?>
			<div class="table-responsive ">
			<table class="table table-bordered text-center table-hover">			
				<thead class="text-white bg-primary">
					<tr>
						<th class=''>Sl No.</th>
						<th class=''>Title</th>
						<th class=''>Youtube Link</th>
                        <th class=''>Image</th>
                          <?php if($this->session->userdata('role') == 1) { ?>
						<th class=''>Action</th>		
                        <?php }?>			
					</tr>
				</thead>
				<tbody id="leadBody">
					<?php
					if(!empty($datas)) {
					 $num = 1 ; 
					foreach($datas as $data) {
                        ?>
					<tr>
						<td class=''><?php echo $num; ?></td>						
						<td class=''><?php echo ucwords($data->title); ?></td>
                        <td>
                        <?php
                        $videoSrc = '';
                        if (!empty($data->url)) {
                            preg_match('/src="([^"]+)"/', $data->url, $matches);
                            $videoSrc = isset($matches[1]) ? $matches[1] : '';
                        }
                        
                            if (!empty($videoSrc)): ?>
                                <iframe width="200" height="150" src="<?php echo $videoSrc; ?>" frameborder="0" allowfullscreen></iframe>
                                <button class="btn btn-sm btn-primary copy-btn" data-src="<?php echo $videoSrc; ?>">Copy Link</button>
                            <?php endif; ?>
                        </td>
						<!-- <td class='width: 100px;'><div class='videoSet'><?php echo $data->url; ?></div></td> -->
                        <!-- <td class='width: 100px;'><img width='200px' src="<?= base_url()?><?= $data->image?>"></td> -->
                        <td style="width: 100px;">
                            <?php if (!empty($data->image)): ?>
                                <a href="<?= base_url() . $data->image ?>" class="download-image" data-src="<?= base_url() . $data->image ?>" title="Download Image">
                                    <img width="200px" src="<?= base_url() . $data->image ?>" style="cursor: pointer;">
                                </a>
                            <?php endif; ?>
                        </td>
                          <?php if($this->session->userdata('role') == 1) { ?>
						<td>
					       <!-- <a href="<?php echo base_url('admin/videoEdit/').$data->id;?>"><i class="fa fa-pencil-square-o text-primary fa-lg" aria-hidden="true"></i></a> -->
					        <a href="<?php echo base_url('admin/videodelete/').$data->id;?>" onclick="return confirm('Are you sure?')"><i class="fa fa-trash text-danger fa-lg" aria-hidden="true"></i></a>
					   </td>
                       <?php }?>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).on("click", ".copy-btn", function () {
        var videoSrc = $(this).attr("data-src");

        Swal.fire({
            title: "Copy Link?",
            text: "Do you want to copy this video link?",
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "Yes, Copy!",
            cancelButtonText: "No",
        }).then((result) => {
            if (result.isConfirmed) {
                var tempInput = $("<input>");
                $("body").append(tempInput);
                tempInput.val(videoSrc).select();
                document.execCommand("copy");
                tempInput.remove();

                Swal.fire({
                    title: "Copied!",
                    text: "The video link has been copied successfully.",
                    icon: "success",
                    timer: 2000,
                    showConfirmButton: false
                });
            }
        });
    });
</script>

<script>
    $(document).on("click", ".download-image", function (e) {
        e.preventDefault(); // Prevent direct download

        var imageUrl = $(this).attr("data-src");

        Swal.fire({
            title: "Download Image?",
            text: "Do you want to download this image?",
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "Yes, Download!",
            cancelButtonText: "No",
        }).then((result) => {
            if (result.isConfirmed) {
                // Create a temporary link and trigger download
                var tempLink = document.createElement("a");
                tempLink.href = imageUrl;
                tempLink.download = imageUrl.split('/').pop(); // Extract filename from URL
                document.body.appendChild(tempLink);
                tempLink.click();
                document.body.removeChild(tempLink);

                Swal.fire({
                    title: "Downloaded!",
                    text: "The image has been downloaded successfully.",
                    icon: "success",
                    timer: 2000,
                    showConfirmButton: false
                });
            }
        });
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