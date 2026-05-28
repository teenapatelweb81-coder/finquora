
<style>
    .col-md-12 .mb-3{
        text-align: left !important;
    }
</style>
<div class="container-fluid p-0">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin/Dashboard/"); ?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">My Leads</li>
           </ol>
         </nav>
</div>
<div class="container-fluid px-0" >
    <div class="row m-0">
        <div class="col-md-12 px-0">
        	 <section class="content p-0">
        	  <div class="container-fluid px-0">
                <!-- Small boxes (Stat box) -->
                <div class="row m-0">
                    <div class="col-md-4 pl-0">
                        <div _ngcontent-wsc-c195=""
                            class="form-group mb-2">
                            <select _ngcontent-wsc-c195="" name="myleads" id="myleads" class="form-control form-control-alternative">
                                <option _ngcontent-wsc-c195="" value="today" selected="">Today</option>
                                <option _ngcontent-wsc-c195="" value="lastweek">Last Week</option>
                                <option _ngcontent-wsc-c195="" value="currentmonth">Current Month</option>
                                <option _ngcontent-wsc-c195="" value="lastmonth">Last Month</option>
                                <option _ngcontent-wsc-c195="" value="lastthreemonth">Last Three Month</option>
                                <option _ngcontent-wsc-c195="" value="qtd">Quarter to Date</option>
                                <option _ngcontent-wsc-c195="" value="ytd">Year to Date</option>
                                <option _ngcontent-wsc-c195="" value="custom">Custom</option>
                            </select>
                        </div>

                    </div>
                    
                    <div class="col-md-4 pr-0">
                        <div _ngcontent-wsc-c195=""
                        class="form-group mb-2">
                        <input type="text" id="filter-table" name="filter-table" placeholder="Search . . ." class="form-control form-control-alternative" />
                    </div>
                    
                </div>
                
                <?php if ($this->session->userdata('role') != 1) {?>
                <div class="col-md-4 text-right">
                    <a href="<?= isset($lead['url']) ? $lead['url'] :'' ?>" class="btn btn-success">Go to lead dashboard</a>
                    </div>
                <?php }?>


                    <!--<div class="col-md-4 ">-->
                    <!--    <div _ngcontent-wsc-c195="" class="form-group mb-2">-->
                    <!--        <input _ngcontent-wsc-c195="" type="date"  placeholder="custom date" id="to_date" name="to_date"  class="form-control form-control-alternative ng-pristine ng-invalid ng-touched">-->
                    <!--    </div>-->

                    <!--</div>-->

                </div>
              </div>


            </section>
       </div>
    </div>
    <div class="row m-0">
		<div class="col-md-12 px-0">
		    <div id="message" class="text-primary text-center"></div>
			<div class="table-responsive shadow-lg">
			<table class=" table-bordered text-center table-hover" id="datatable_buttons">
				<span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success'); ?></span>
                <span class="text-center text-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error'); ?></span>
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
						<th class=''>Branch Franchise/DSA</th>
						<th class=''>Network Member</th>
						<th class=''>Team Member</th>
						<th class=''>Date</th>
                        <th class=''>lead Status</th>
                        <th class=''>Status</th>
                        <th class=''>Update</th>
						<th class=''>Action</th>
					</tr>
				</thead>
			</table>
			</div>
		</div>
	</div>

</div>

<div class="modal" id="myModalAdmin">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                    <button type="button"  class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form action ="javascript:void(0);" method="post" id="admin_modal_form">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="sanction" class="form-label">Sanction amount<span class="text-danger">*</span></label>
                                <input type="text" name="sanction" id="sanction" class="form-control"  value="" >
                                <input type="hidden" name="id" id="admin_id" class="form-control"  value="" >
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="disbursed" class="form-label">Disbursed<span class="text-danger">*</span></label>
                                <input type="number" name="disbursed" id="disbursed" class="form-control" value=""   >
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="payout" class="form-label">Payout Percentage<span class="text-danger">*</span></label>
                                <input type="text" name="payout" id="payout" class="form-control"  value="" >
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="payment_amount_paid" class="form-label">Payout Amount Paid<span class="text-danger">*</span></label>
                                <input type="text" name="payment_amount_paid" id="payment_amount_paid" class="form-control"  value="" >
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="bankModal" class="form-label">Bank Name<span class="text-danger">*</span></label>
                                <input type="text" name="bankModal" id="bankModal" class="form-control nonNumericInput" value="" pattern="[A-Za-z]+" >
                            </div>

                            <?php if ($this->session->userdata('role') == 1) {?>
                            <div class="col-md-12">
                                <div class="form-group mb-2">
                                    <button id="create" value="Save" class="btn btn-info mt-4">Update </button>
                                </div>
                            </div>
                            <?php }?>

                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>

        <div class="modal" id="myModalUser">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form action = "javascript:void(0);" method="post" id="user_modal_form">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="sanction_team" class="form-label">Sanction amount<span class="text-danger">*</span></label>
                                <input type="text" name="sanction_team" id="sanction_team" class="form-control"  value="" >
                                <input type="hidden" name="id" id="user_id" class="form-control"  value="" >
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="disbursed_team" class="form-label">Disbursed<span class="text-danger">*</span></label>
                                <input type="number" name="disbursed_team" id="disbursed_team" class="form-control" value=""   >
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="payout_team" class="form-label">Payout Percentage<span class="text-danger">*</span></label>
                                <input type="text" name="payout_team" id="payout_team" class="form-control"  value="" >
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="payment_amount_paid_team" class="form-label">Payout Amount Paid<span class="text-danger">*</span></label>
                                <input type="text" name="payment_amount_paid_team" id="payment_amount_paid_team" class="form-control"  value="" >
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="bankModal_team" class="form-label">Bank Name<span class="text-danger">*</span></label>
                                <input type="text" name="bankModal_team" id="bankModal_team" class="form-control nonNumericInput" value="" pattern="[A-Za-z]+" >
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-2">
                                    <button id="create" value="Save" class="btn btn-info mt-4"> Update</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>

        <div class="modal" id="myModalUserTeam">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form action = "javascript:void(0);" method="post">
                        <div class="row">

                            <div class="col-md-12 mb-3">
                                <label for="sanction_team" class="form-label">Sanction amount<span class="text-danger">*</span></label>
                                <input type="text" name="sanction_team" id="sanction_team_user" class="form-control"  value="" >
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="disbursed_team" class="form-label">Disbursed<span class="text-danger">*</span></label>
                                <input type="number" name="disbursed_team" id="disbursed_team_user" class="form-control" value=""   >
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="payout_team" class="form-label">Payout Percentage<span class="text-danger">*</span></label>
                                <input type="text" name="payout_team" id="payout_team_user" class="form-control"  value="" >
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="payment_amount_paid_team" class="form-label">Payout Amount Paid<span class="text-danger">*</span></label>
                                <input type="text" name="payment_amount_paid_team" id="payment_amount_paid_team_user" class="form-control"  value="" >
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="bankModal_team" class="form-label">Bank Name<span class="text-danger">*</span></label>
                                <input type="text" name="bankModal_team" id="bankModal_team_user" class="form-control nonNumericInput" value="" pattern="[A-Za-z]+" >
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>

<script type="text/javascript">
    
            // $(document).ready(function(){
            //     var table = $('#datatable_buttons').DataTable( {
            //             dom: 'Bfrtip',
            //             buttons: [
            //                 'copy', 'excel', 'pdf', 'colvis'
            //             ],
            //             "searching": false,
            //             "processing":true,  
            //                "serverSide":true,  
            //                "order":[],  
            //                "ajax":{  
            //                     "url":"<?php echo base_url() . 'admin/Dashboard/getLeadsDataAjax2'; ?>",  
            //                     "type":"POST",
            //                     "data": function(data){
            //                         data.myleads = $('#myleads').val();
            //                     }   
            //                },  
            //                "columnDefs":[  
            //                     {  
            //                          "targets":[0, 3, 4],  
            //                          "orderable":false,  
            //                     },  
            //             ]
            //     } );
            //     $(document).on('change','#myleads',function(){
            //         table.ajax.reload(); 
            //     } );
                
            //     } );

            $(document).ready(function () {
    var table = $('#datatable_buttons').DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'copy',
                text: '📋 Copy All',
                action: function (e, dt, button, config) {
                    exportAllData(e, dt, button, config, 'copyHtml5');
                }
            },
            {
                extend: 'excel',
                text: '📊 Excel All',
                action: function (e, dt, button, config) {
                    exportAllData(e, dt, button, config, 'excelHtml5');
                }
            },
            {
                extend: 'pdf',
                text: '📄 PDF All',
                action: function (e, dt, button, config) {
                    exportAllData(e, dt, button, config, 'pdfHtml5');
                }
            },
            'colvis'
        ],
        searching: false,
        processing: true,
        serverSide: true,
        order: [],
        ajax: {
            url: "<?php echo base_url('admin/Dashboard/getLeadsDataAjax2'); ?>",
            type: "POST",
            data: function (data) {
                data.myleads = $('#myleads').val();
            }
        },
        columnDefs: [
            {
                targets: [0, 3, 4],
                orderable: false
            }
        ]
    });

    // 🔄 Reload on filter change
    $(document).on('change', '#myleads', function () {
        table.ajax.reload();
    });

    // ✅ Custom function to export ALL data
    function exportAllData(e, dt, button, config, exportType) {
        var oldStart = dt.settings()[0]._iDisplayStart;

        dt.one('preXhr', function (e, s, data) {
            data.start = 0;
            data.length = -1; // <-- Load all records
        });

        dt.one('xhr', function (e, s, json) {
            // Temporarily load all data into table
            var oldData = dt.rows({ search: 'applied' }).data();
            dt.clear();
            dt.rows.add(json.data).draw();

            // Trigger the export
            $.fn.dataTable.ext.buttons[exportType].action.call(dt.button(button), e, dt, button, config);

            // Restore table
            dt.clear();
            dt.rows.add(oldData).draw();

            dt.one('preXhr', function (e, s, data) {
                data.start = oldStart;
            });

            setTimeout(function () {
                dt.ajax.reload(null, false);
            }, 500);
        });

        // Reload data
        dt.ajax.reload();
    }
});


$(document).ready(function(){
  $("#filter-table").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#datatable_buttons tbody tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
// $(document).ready(function(){
//     var page = 1;

//     function loadData() {
//         $.ajax({
//             url: "<?php echo base_url('admin/Dashboard/getLeadsDataAjax');?>/" + page,
//             type: "GET",
//             dataType: "json",
//             success: function(data) {
//                 console.log(data);
//                 var tableBody = $('#dtBasicExample').find('tbody');
//                 tableBody.empty(); // Clear existing table rows

//                 if (data && data.htmlRows) {
//                     tableBody.append(data.htmlRows);
//                 } else {
//                     tableBody.html('<tr><td colspan="18" class="text-center">No data found</td></tr>');
//                 }
//             },
//             error: function(jqXHR, textStatus, errorThrown) {
//                 console.error('Error: ' + textStatus + ' - ' + errorThrown);
//                 // Show error message in the table body
//                 var tableBody = $('#dtBasicExample').find('tbody');
//                 tableBody.html('<tr><td colspan="18" class="text-center">Error fetching data</td></tr>');
//             }
//         });
//     }

//     loadData();
//     $('#load-more-button').click(function() {
//         page++;
//         loadData();
//     });
// });
// $(document).ready(function(){
//     // Initialize DataTables after appending rows
//     $('#dtBasicExample').DataTable({
//         "order": [[ 0, 'desc' ]]
//     });
//     $('.dataTables_length').addClass('bs-select');
// });

$(document).on("click",".admin_modal",function(e){
        var value = $(this).attr('data-id');
        $("#myModalAdmin").show();
        $.ajax({  
            "url": "<?php echo base_url() . 'admin/Dashboard/user_all_leads'; ?>",  
            "type": "POST",
            "data": {
                'value': value,
            },
            "success": function(response) {
                if (response != []) {
                    
                    var resp = JSON.parse(response);
                    $("#sanction").val(resp['sanction']);
                    $("#disbursed").val(resp['disbursed']);
                    $("#payout").val(resp['payout']);
                    $("#payment_amount_paid").val(resp['payment_amount_paid']);
                    $("#bankModal").val(resp['bankModal']);
                    $("#admin_id").val(resp['id']);
                }
            },
            "error": function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }); 


$(document).on("click",".view_main_user",function(e){
        var value = $(this).attr('data-id');
        $("#myModalUser").show();
        $.ajax({  
            "url": "<?php echo base_url() . 'admin/Dashboard/user_all_leads'; ?>",  
            "type": "POST",
            "data": {
                'value': value,
            },
            "success": function(response) {
                if (response != []) {
                    var resp = JSON.parse(response);
                    $("#sanction_team").val(resp['sanction_team']);
                    $("#disbursed_team").val(resp['disbursed_team']);
                    $("#payout_team").val(resp['payout_team']);
                    $("#payment_amount_paid_team").val(resp['payment_amount_paid_team']);
                    $("#bankModal_team").val(resp['bankModal_team']);
                    $("#user_id").val(resp['id']);
                }
            },
            "error": function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }); 


$(document).on("click",".team_modal",function(e){
        var value = $(this).attr('data-id');
        $("#myModalUserTeam").show();
        $.ajax({  
            "url": "<?php echo base_url() . 'admin/Dashboard/user_all_leads'; ?>",  
            "type": "POST",
            "data": {
                'value': value,
            },
            "success": function(response) {
                if (response != []) {
                    var resp = JSON.parse(response);
                    $("#sanction_team_user").val(resp['sanction_team']);
                    $("#disbursed_team_user").val(resp['disbursed_team']);
                    $("#payout_team_user").val(resp['payout_team']);
                    $("#payment_amount_paid_team_user").val(resp['payment_amount_paid_team']);
                    $("#bankModal_team_user").val(resp['bankModal_team']);
                }
            },
            "error": function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }); 

    $(document).on("submit","#admin_modal_form",function(e){
        $.ajax({
            type: 'POST',
            data: $(this).serialize(),
            url: '<?php echo base_url() . 'admin/Dashboard/dis_leads_update'; ?>',
            success: function(response) {
                if (response) {
                    setTimeout(function(){
                        location.reload();
                         }, 2000);
                    }
            $("#myModalAdmin").hide(); 

            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });

    $(document).on("submit","#user_modal_form",function(e){
        $.ajax({
            type: 'POST',
            data: $(this).serialize(),
            url: '<?php echo base_url() . 'admin/Dashboard/dis_leads_update_user'; ?>',
            success: function(response) {
                if (response) {
                    setTimeout(function(){
                        location.reload();
                         }, 2000);
                    } 
                $("#myModalUser").hide(); 
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
    $(document).on('click','.close',function(e){
        $("#myModalAdmin").hide();
        $("#myModalUser").hide();
        $("#myModalUserTeam").hide();
    })
</script>

<script>
$(document).ready(function(){
    $('.nonNumericInput').on('input', function() {
         $(this).val($(this).val().replace(/[^a-zA-Z]/g, ''));
    });
});
</script>
