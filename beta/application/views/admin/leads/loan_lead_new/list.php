
<style>
    iframe {
        width: 200px !important;
        height: 100px !important;
    }
    .form-group {
        margin-bottom: 1.5rem!important;
    }
</style>
<?php 
// print_r($this->session->userdata());die;
?>

<div class="container-fluid p-0">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin/Dashboard/");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">loan Lead</li>
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
              <?php if($_SESSION['user_id'] != 1){ ?>
		    <div id="" class="text-primary text-right mr-3">
                <a href="<?php echo base_url()?>admin/loan-lead-create" class="btn btn-primary"><i class="fa fa-plus text-light fa-sm" aria-hidden="true"></i> Add</a>

            </div>
            <?php  }?>

			<div class="table-responsive ">
			<table class=" table-bordered text-center table-hover" id="dtBasicExample"> 
				<span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>                     
                <span class="text-center text-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error');?></span>			         	
				<thead class="text-white bg-primary">
					<tr>    
						<th class=''>Sr No.</th>
                    <?php if($_SESSION['user_id'] == 1) { ?>
                        <th class=''>User Name</th>
                    <?php }?>
						<th class=''>Name</th>
                        <th class=''>Contact Number</th>
						<th class=''>Email</th>
                        <th class=''>Loan Type</th>
                        <th class=''>Loan Amount</th>
                         <!-- <th class=''>URL</th>  -->
                         <th class=''>User ID</th> 
                         <th class=''>Password</th>
                        <th class=''>View</th>
                        <?php if ($this->session->userdata('user_id')  == 1) {?>
                            <th class=''>Update</th>
                        <?php }if ($this->session->userdata('user_id')  != 1) {?>
                            <th class=''>Action</th> 			
                        <?php }?>
					</tr>
				</thead>
				<tbody id="leadBody">
				    <?php
					if(!empty($loan)) {
					 $num = count($loan) ; 
					foreach($loan as $data) {
                        // echo '<pre>';
                        // print_r($banker);die;
                      
                            $user = $this->db->where('id',$data->user_id)->get('user_master')->row();
                        if (empty($user)) {
                             $user = $this->db->where('id',$data->user_id)->get('branch_franchise')->row();
                         }
                        ?> 
					<tr>
						<td class=''><?php echo $num; ?></td>
                    <?php if($_SESSION['user_id'] == 1) { ?>
                        <td class=''><?= $user->username ?></td>
                    <?php }?>							
						<td class=''><?= $data->name ?></td>					
						<td class=''><?= $data->number ?></td>					
						<td class=''><?= $data->email ?></td>					
						<td class=''><?= $data->loan_type ?></td>	
						<td class=''><?= $data->loan_amount ?></td>	
						<!-- <td class=''><?php //echo  $data->url ?></td>	 -->
						<td class=''><?= $data->user_name ?></td>	
						<td class=''><?= $data->password ?></td>	
                        <?php 
                            $loan_type = str_replace(' ', '_', strtolower($data->loan_type));
                        ?>
                        <td class=''><a href="<?php echo base_url('admin/loan-type-list?type=').$loan_type;?>"><i class="fa fa-eye text-primary fa-lg" aria-hidden="true"></i></a></td>

                         <?php if ($this->session->userdata('user_id')  == 1) {?>
                            <td class=''><button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal<?= $data->id?>">Update</button></td>
                        <?php }if ($this->session->userdata('user_id')  != 1) {?>
						<td>
					       <a href="<?php echo base_url('admin/loan-lead-edit/').$data->id;?>"><i class="fa fa-pencil-square-o text-primary fa-lg" aria-hidden="true"></i></a>
					       <!-- <a href="<?php echo base_url('admin/Dashboard/loan_lead_delete/').$data->id;?>" onclick="return confirm('Are you sure ?')" ><i class="fa fa-trash text-danger fa-lg" aria-hidden="true" onclick="delLead"></i></a> -->
                           
					   </td>
                         <?php }?>

                       <div id="myModal<?= $data->id?>" class="modal fade" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                       <form action="<?= base_url()?>/admin/Dashboard/loan_type_created" method="post">
                                            <div class="row">
                                                <!-- <div class="col-sm-12">
                                                    <div class="form-group">
                                                                <label class="text-dark" for="user_name">Link<span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" aria-required="url" name="url"  placeholder=Name" id="url" required value="<?= $data->url?>">
                                                        </div>
                                                    </div> -->
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                                <label class="text-dark" for="user_name">User ID<span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" aria-required="true" name="user_name"  placeholder=Name" id="user_name" value="<?= $data->user_name?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                                <label class="text-dark" for="bank_name">Password<span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" aria-required="true" name="password"  placeholder = "Contact Number" id="password" value="<?= $data->password?>" required>
                                                                <input type="hidden" aria-required="true"  name="id" value="<?= $data->id?>" >
                                                        </div>
                                                    </div>
                                                     <div class="col-md-2"> 
                                                        <div class="form-group">
                                                        <button type="submit" id="create" class="btn btn-info mt-4">Updated</button>
                                                        </div>
                                                    </div>
                                                </div>
                                       </form>
                                    </div>
                                    </div>

                                </div>
                                </div>
                      
                    
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
