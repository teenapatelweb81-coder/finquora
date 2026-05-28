
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
               <li class="breadcrumb-item active" aria-current="page">loan Form</li>
           </ol>
         </nav>
</div>
<div class="container">
    <div class="row" style="margin-bottom: -90px;">
        <div class="col-md-12">
        	 <section class="content">
        	  <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <!-- <div class="row">
                    <div class="col-md-4">
                        <div _ngcontent-wsc-c195="" 
                            class="form-group">
                            <select _ngcontent-wsc-c195="" name="myleads" id="myleads" onchange="myleadsData()" class="form-control form-control-alternative">
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
                    
                     <div class="col-md-4">
                        <div _ngcontent-wsc-c195="" 
                            class="form-group">
                            <input type="text" id="filter-table" name="filter-table" placeholder="Search . . ." class="form-control form-control-alternative" />
                        </div>
                        
                    </div>
                    
                    
                    <!--<div class="col-md-4 ">-->
                    <!--    <div _ngcontent-wsc-c195="" class="form-group">-->
                    <!--        <input _ngcontent-wsc-c195="" type="date"  placeholder="custom date" id="to_date" name="to_date"  class="form-control form-control-alternative ng-pristine ng-invalid ng-touched">-->
                    <!--    </div>-->
                        
                    <!--</div>
                    
                </div> -->
              </div>
              
    
            </section>
       </div>
    </div>
    <div class="row">
		<div class="col-md-12 mt-4  pt-2 shadow-lg">
              <?php //if($_SESSION['role'] == 1){ ?>
		    <div id="" class="text-primary text-right mr-3">
                <a href="<?php echo base_url()?>admin/loan-company-master-form" class="btn btn-primary"><i class="fa fa-plus text-light fa-sm" aria-hidden="true"></i> Add</a>
            </div>
            <?php // }?>

			<div class="table-responsive ">
			<table class=" table-bordered text-center table-hover" id="dtBasicExample"> 
				<span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>                     
                <span class="text-center text-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error');?></span>			         	
				<thead class="text-white bg-primary">
					<tr>
						<th class=''>Sr No.</th>
						<th class=''>Bank name</th>
                        <th class=''>Loan Type</th>
						<th class=''>Link</th>
                        <th class=''>Image</th>
                        <th class=''>Description</th>
                        <th class=''>Action</th> 		
					</tr>
				</thead>
				<tbody id="leadBody">
				    <?php
					if(!empty($banker)) {
					 $num = count($banker) ; 
					foreach($banker as $data) {
                        ?> 
					<tr>
						<td class=''><?php //echo $num; ?></td>						
						<td class=''><?php //echo $data->bank_name ?></td>					
						<td class=''><?php //echo $data->loan_type ?></td>					
						<td class=''><?php //echo $data->link ?></td>
                        <td class=''><?php //echo $data->link ?></td>					
						<td class=''></td>	
                    
                    
                         <?php  $num--; } ?>
					</tr> 
				    <?php   }  else {?>
				   <!-- <tr><td colspan="12">No data found</td></tr> -->
				   <?php  }?>
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



