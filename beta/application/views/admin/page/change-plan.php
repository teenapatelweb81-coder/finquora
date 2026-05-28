<style>
.container {
    margin-top: 20px;
    margin-bottom: 15px;
}
.loading {
    display: inline-block;
    width: 20px;
    height: 20px;
    border: 3px solid rgba(0,0,0,.3);
    border-radius: 50%;
    border-top-color: #000;
    animation: spin 1s ease-in-out infinite;
    margin-left: 10px;
}
@keyframes spin {
    to { transform: rotate(360deg); }
}
</style>

<div class="container-fluid p-0">
    <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url("admin/Dashboard/");?>" class="text-decoration-none">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Plan</li>
    </ol>
    </nav>
</div>

<div class="">
    <div class="table-responsive shadow-lg p-2 pb-4" >
        <div id="message" class="text-primary text-center">
            <span class="text-center text-primary mb-2" id="susid"><?= $this->session->flashdata('success');?></span>
            <span class="text-center text-danger mb-2" id="errid"><?= $this->session->flashdata('error');?></span>
        </div>
		<div class="">
            <?php if ($this->session->userdata('role') == 1) { ?>
                   <?php
                        $selected_domain_id = isset($_GET['domain_id']) ? (int)$_GET['domain_id'] : null;
                        if ($selected_domain_id) {
                            $website_id = $selected_domain_id;
                        } else {
                            $website_id = domain_id_get();
                        }

                        if ($this->session->userdata('type') == 'admin') { ?>
                            <div class="col-12 mb-3">
                                <div class="col-4 mb-3">
                                    <label for="domain_id_main" class="col-form-label">Domain</label>
                                    <select class="form-control mb-2" id="domain_id_main" required name="domain_id" onchange="window.location.href = window.location.pathname + '?domain_id=' + this.value;">
                                        <?php foreach ($domains as $domain) { ?>
                                            <option <?= ($website_id == $domain['id']) ? 'selected' : ''; ?> value="<?= $domain['id'] ?>"> <?= $domain['url'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                    <?php }else{?>
                        <input type="hidden" name="domain_id"  class="form-control mb-2" value="<?= $website_id ?>" >
                    <?php }?>

                  <!-- =============== Customer Plan Form =============== -->
			     <form method="post" class="mb-4" action="<?= base_url("admin/get_plan_data_by_domain");?>">
    			     <div class="row m-0 align-items-end">
    			      <div class="col-md-2 text-center">
                        <label>Customer Plan:</label>
                        <input type="hidden" id="id" name="id" value="<?= $data[0]->id ?? '' ?>">
                        <input type="hidden" id="domain_id" name="domain_id" value="<?= $website_id ?? '' ?>">
                        <input type="hidden" id="plan_name" name="plan_name" value="<?= $data[0]->plan_name ?? 'Silver' ?>">
                        <input type="hidden" id="plan2_name" name="plan2_name" value="<?= $data[0]->plan2_name ?? 'Platinum' ?>">
                        <input type="hidden" id="plan_type" name="plan_type" value="1">
                      </div>
    			      <div class="col-md-3">
                        <label>Silver:</label>
                        <input type="number" class="form-control mb-2" id="amount" name="amount" placeholder="Enter Silver plan amount" value="<?= $data[0]->amount ?? '' ?>">
    			      </div>
    			      <div class="col-md-3">
                        <label>Platinum:</label>
                        <input type="text" class="form-control mb-2" id="amount2" name="amount2" placeholder="Enter Platinum plan amount" value="<?= $data[0]->amount2 ?? '' ?>">
    			      </div>
                      <div class="col-md-2">
                        <label>Validity:</label>
                        <input type="text" class="form-control mb-2" id="validity" name="validity" placeholder="Enter validity" value="<?= $data[0]->validity ?? '' ?>">
                      </div>
    			      <div class="col-md-1">
                          <input type="submit" name="update" class="btn btn-primary mb-2" value="Submit">
    			      </div>
    			     </div>
    			 </form>

                 <!-- =============== DSA Plan Form =============== -->
    			 <form method="post" class="mb-4" action="<?= base_url("admin/get_plan_data_by_domain");?>">
    			  <div class="row m-0 align-items-end">
    			      <div class="col-md-2 text-center">
                        <label>DSA Plan:</label>
                         <input type="hidden" id="domain_id" name="domain_id" value="<?= $website_id ?? '' ?>">
                        <input type="hidden" id="id_1" name="id" value="<?= $data[1]->id ?? '' ?>">
                        <input type="hidden" id="plan_name_1" name="plan_name" value="<?= $data[1]->plan_name ?? 'Silver' ?>">
                        <input type="hidden" id="plan2_name_1" name="plan2_name" value="<?= $data[1]->plan2_name ?? 'Platinum' ?>">
                        <input type="hidden" id="plan_type_1" name="plan_type" value="2">
    			      </div>
    			      <div class="col-md-3">
                        <label>Silver:</label>
                        <input type="text" class="form-control mb-2" id="amount_1" name="amount" placeholder="Enter Silver plan amount" value="<?= $data[1]->amount ?? '' ?>">
    			      </div>
    			      <div class="col-md-3">
                        <label>Platinum:</label>
                        <input type="text" class="form-control mb-2" id="amount2_1" name="amount2" placeholder="Enter Platinum plan amount" value="<?= $data[1]->amount2 ?? '' ?>">
    			      </div>
                      <div class="col-md-2">
                        <label>Validity:</label>
                        <input type="text" class="form-control mb-2" id="validity_1" name="validity" placeholder="Enter validity" value="<?= $data[1]->validity ?? '' ?>">
                      </div>
    			       <div class="col-md-1">
                          <input type="submit" name="update" class="btn btn-primary mb-2" value="Submit">
    			      </div>
    			  </div>
    			</form>

                <!-- =============== Branch Franchise Plan Form =============== -->
                <form method="post" class="mb-4" action="<?= base_url("admin/get_plan_data_by_domain");?>">
                  <div class="row m-0 align-items-end">
                      <div class="col-md-2 text-center">
                        <label>Branch Franchise Plan:</label>
                         <input type="hidden" id="domain_id" name="domain_id" value="<?= $website_id ?? '' ?>">
                        <input type="hidden" id="id_2" name="id" value="<?= $data[2]->id ?? '' ?>">
                        <input type="hidden" id="plan_name_2" name="plan_name" value="<?= $data[2]->plan_name ?? 'Silver' ?>">
                        <input type="hidden" id="plan2_name_2" name="plan2_name" value="<?= $data[2]->plan2_name ?? 'Platinum' ?>">
                        <input type="hidden" id="plan_type_2" name="plan_type" value="3">
                      </div>
                      <div class="col-md-3">
                        <label>Silver:</label>
                        <input type="text" class="form-control mb-2" id="amount_2" name="amount" placeholder="Enter Silver plan amount" value="<?= $data[2]->amount ?? '' ?>">
                      </div>
                      <div class="col-md-3">
                        <label>Platinum:</label>
                        <input type="text" class="form-control mb-2" id="amount2_2" name="amount2" placeholder="Enter Platinum plan amount" value="<?= $data[2]->amount2 ?? '' ?>">
                      </div>
                      <div class="col-md-2">
                        <label>Validity:</label>
                        <input type="text" class="form-control mb-2" id="validity_2" name="validity" placeholder="Enter validity" value="<?= $data[2]->validity ?? '' ?>">
                      </div>    
                      <div class="col-md-1">
                          <input type="submit" name="update" class="btn btn-primary mb-2" value="Submit">
                      </div>
                  </div>
                </form>
<?php }?>
                <!-- =============== Branch Franchise team Plan Form =============== -->
                <form method="post" class="mb-4" action="<?= base_url("admin/get_plan_data_by_domain");?>">
                  <div class="row m-0 align-items-end">
                      <div class="col-md-2 text-center">
                        <label>Branch DSA plan:</label>
                         <input type="hidden" id="domain_id" name="domain_id" value="<?= $website_id ??  domain_id_get()?>">
                        <input type="hidden" id="id_3" name="id" value="<?= isset($user_data->id) ? $user_data->id : '' ?>">
                        <input type="hidden" id="plan_name_3" name="plan_name" value="<?= isset($user_data->plan_name) ? $user_data->plan_name : 'Silver' ?>">
                        <input type="hidden" id="plan3_name_3" name="plan2_name" value="<?= isset($user_data->plan3_name) ? $user_data->plan3_name : 'Platinum' ?>">
                        <input type="hidden" id="plan_type_3" name="plan_type" value="4">
                      </div>
                     <div class="col-md-3">
                        <label>Silver:</label>
                        <input type="text" class="form-control mb-2" id="amount_3" name="amount"
                            placeholder="Enter Silver plan amount"
                            value="<?= ($this->session->userdata('role') != 1 && isset($user_data->amount)) ? $user_data->amount : '' ?>">
                    </div>

                    <div class="col-md-3">
                        <label>Platinum:</label>
                        <input type="text" class="form-control mb-2" id="amount2_3" name="amount2"
                            placeholder="Enter Platinum plan amount"
                            value="<?= ($this->session->userdata('role') != 1 && isset($user_data->amount2)) ? $user_data->amount2 : '' ?>">
                    </div>

                    <div class="col-md-2">
                        <label>Validity:</label>
                        <input type="text" class="form-control mb-2" id="validity_3" name="validity"
                            placeholder="Enter validity"
                            value="<?= ($this->session->userdata('role') != 1 && isset($user_data->validity)) ? $user_data->validity : '' ?>">
                    </div>
 
                      <?php  if ($this->session->userdata('role') == 1 ) { ?>
                      <div class="col-md-2">
                          <label>Branch user:</label>
                          <select class="form-control mb-2" id="branch_id" required name="user_id">
                              <option value ='' selected> Select branch user</option>
                              <?php foreach ($branches as $branch) { ?>
                                <option value="<?= $branch['id'] ?>"><?= $branch['name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>   
                        <div class="col-md-2"></div>   
                       <?php }?> 
                      <div class="col-md-1">
                          <input type="submit" name="update" class="btn btn-primary mb-2" value="Submit">
                      </div>
                  </div>
                </form>
			  </div>
	</div>
</div>

  <?php if ($this->session->userdata('role') == 1) { ?>
<script>
$(document).ready(function() {
    // Handle branch change for plan type 4
    $('#branch_id').on('change', function() {
        var planType = $('#plan_type_3').val();
        var branchId = $(this).val();
        
        // Only proceed if plan type is 4
        if (planType == '4') {
            var loading = $('<span class="loading"></span>');
            $(this).after(loading);
            
            $.ajax({
                url: '<?= base_url("admin/Dashboard/get_branch_plan_data") ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    branch_id: branchId,
                    plan_type: planType,
                    domain_id: $('#domain_id').val()
                },
                success: function(response) {
                    if (response.status == 'success') {
                        console.log(response.data.amount);
                        $('#amount_3').val(response.data.amount || '');
                        $('#amount2_3').val(response.data.amount2 || '');
                        $('#validity_3').val(response.data.validity || '');
                    }
                    loading.remove();
                },
                error: function() {
                    alert('Error fetching branch data');
                    loading.remove();
                }
            });
        }
    });
});
</script>
<?php }?>
