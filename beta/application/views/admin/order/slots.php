
<div class="container-fluid p-0">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin/Dashboard/");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Payout-slabs</li>
           </ol>
         </nav>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-12 px-0">
			<?php 
				if ($this->session->userdata('role') == 1) {
			?>
				<div id =""class="text-primary text-right mr-3">
						<a href="<?php echo base_url()?>admin/my-payout-add" class="btn btn-primary"><i class="fa fa-plus text-light fa-sm" aria-hidden="true"></i> Add</a>
					</div>
					<?php }?>
		    <!-- <section class="content" style="padding:0">
        	  <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                        <div _ngcontent-wsc-c195="" 
                            class="form-group">
                            <input type="text" id="filter-table" name="filter-table" placeholder="Search . . ." class="form-control form-control-alternative" />
                        </div>
                        
                    </div>
                    
                </div>
              </div>
              
            </section> -->
		    
		    <div id="message" class="text-primary text-center"></div>
			<div class="table-responsive ">
			    <span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>
                <span class="text-center text-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error');?></span>		
                
			<table class=" table-bordered text-center table-hover shadow-lg" id="dtBasicExample">
					<thead>
						<tr>
							<th class="no">No</th>
							<th class="no">Bank Name</th>
							<th class="name">Loan Type</th>
							<th class="date">Slob A(%)</th>
							<th class="date">Slob B(%)</th>
							<th class="date">Slob C(%)</th>
							<th class="date">Slob D(%)</th>
							<th class="date">Starperformer(%)</th>
							<?php 
								if ($this->session->userdata('role') == 1) {
							?>
							<th class="">Action</th>
							<?php }?>
							
						</tr>
					</thead>
				<tbody id="slabs">
				 <?php $num = count($slots); if(!empty($slots)) { foreach($slots as $value) { ?>
						<tr>
						    <td><?= $num ?></td>
						    <td><?= $value->bank_name ?></td>
							<td><?= $value->loan_type ?></td>
							<td><?= $value->slab_A.'('.$value->slab_A_per.')' ?></td>
							<td><?= $value->slab_B.'('.$value->slab_B_per.')' ?></td>
							<td><?= $value->slab_C.'('.$value->slab_C_per.')' ?></td>
							<td><?= $value->slab_D.'('.$value->slab_D_per.')' ?></td>
							<td><?= $value->starperformer.'('.$value->starperformance_per.')' ?></td>
							<?php 
								if ($this->session->userdata('role') == 1) {
							?>
							<td> 
								<a href="<?= base_url()?>/admin/payoutedit/<?= $value->id?>"><i class="fa fa-pencil-square-o text-primary fa-lg" aria-hidden="true"></i></a>
								<a href="<?= base_url()?>/admin/Dashboard/payoutdelete/<?= $value->id?>" onclick="return confirm('Are you sure ?')"><i class="fa fa-trash text-danger fa-lg" aria-hidden="true" onclick="delLead"></i></a>
						</td>
						<?php }?>
							
							
						</tr>
						<?php $num--; }} else {?>
						    <!-- <tr>
						        <td colspan="5" class="text-center"><h6>Bank Slots is not available</h6></td>
						    </tr> -->
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
 
 $(document).ready(function(){
  $("#filter-table").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#slabs tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
    
    
</script>