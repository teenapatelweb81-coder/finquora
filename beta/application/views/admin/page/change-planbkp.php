<style>
.container {
    margin-top: 20px;
    margin-bottom: 15px;
}
</style>


<div class="container-fluid p-0">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
               <li class="breadcrumb-item "><a href="<?= base_url("admin/Dashboard/");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Plan </li>
           </ol>
         </nav>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-12 px-0">
		    <div id="message" class="text-primary text-center">
		        <span class="text-center text-primary mb-2" id="susid"> <?= $this->session->flashdata('success');?></span>
                <span class="text-center text-danger mb-2" id="errid"> <?= $this->session->flashdata('error');?></span>
		    </div>
			<div class="table-responsive shadow-lg">
			 <div class="container">
			     
       <?php
      //  print_r($this->session->userdata('type'));die;
       if($this->session->userdata('type') == 'admin'){?>
        <div class="col-4">
              <label for="domain_id_main" class="col-form-label">Domain</label>
              <select class="form-control" id="domain_id_main" required>
                  <?php foreach ($domains as $domain) { 
                     $current_domain = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http");
                        $current_domain .= "://" . $_SERVER['HTTP_HOST'] . '/';
                        $website_id = $this->db->where('url', $current_domain)->get('domains')->row();
                  ?>
                      <option <?= ($website_id->id == $domain['id'] ) ? 'selected': ''; ?> value="<?= $domain['id'] ?>"> <?= $domain['url'] ?></option>
                  <?php } ?>
              </select>
          </div>
          <?php }?>

			       <form  method="post" action="<?= base_url("admin/change-plan");?>">
    			     <div class="row">
    			      <div class="col-md-2" style= "padding-top: 33px">
                        <div class="form-group">
                          <label for="usr">Customer Plan:</label>
                          <input type="hidden" name="domain_id" class="domain_id_hidden">
                          <input type="hidden" class="form-control" id="id" name="id" value="<?= (!empty($data[0]->id)) ? $data[0]-> id: '' ;?>" >
                          <input type="hidden" class="form-control" id="plan_name" name="plan_name" value="<?= (!empty($data[0]->plan_name)) ? $data[0]->plan_name : '' ;?>" >
                          <input type="hidden" class="form-control" id="plan2_name" name="plan2_name" value="<?= (!empty($data[0]->plan2_name)) ? $data[0]->plan2_name : '' ;?>" >
                          <input type="hidden" class="form-control" id="plan_type" name="plan_type" value="1" >
                        </div>
    			      </div>
    			      <div class="col-md-3">
                        <div class="form-group">
                          <label for="usr">Silver:</label>
                          <input type="number" class="form-control" id="amount" name="amount" value="<?= (!empty($data[0]->amount)) ? $data[0]->amount : '' ;?>" >
                        </div>
    			          
    			      </div>
    			      <div class="col-md-3">
    			        <div class="form-group">
                          <label for="usr">Plantinum:</label>
                          <input type="text" class="form-control" id="amount2" name="amount2" value="<?= (!empty($data[0]->amount2)) ? $data[0]->amount2 : '' ; ?>">
                        </div>
    			          
    			      </div>
                <div class="col-md-2">
                        <div class="form-group">
                          <label for="usr">Validity:</label>
                          <input type="text" class="form-control" placeholder="Enter Validate Year " id="validity" name="validity" value="<?= (!empty($data[0]->validity)) ? $data[0]->validity : '' ;?>">
                        </div>
                          
                      </div>
    			      <div class="col-md-2" style= "padding-top: 33px">
                        <div class="form-group">
                            <label for="usr"></label>
                          <input type="submit" name="update" class="btn btn-primary" value="Submit">
                          
                        </div>
    			      </div>
    			     </div>
    			 </form>
    			 <form name="channel" method="post" action="<?= base_url("admin/change-plan");?>">
    			  <div class="row">
    			      <div class="col-md-2" style= "padding-top: 33px">
                        <div class="form-group">
                          <label for="usr">DSA Plan:</label>
                          <input type="hidden" name="domain_id" class="domain_id_hidden">
                          <input type="hidden" class="form-control" id="id_1" name="id" value="<?= (!empty($data[1]->id)) ? $data[1]->id : '' ;?>" >
                          <input type="hidden" class="form-control" id="plan_name_1" name="plan_name" value="<?= (!empty($data[1]->plan_name)) ? $data[1]->plan_name : '' ;?>" >
                          <input type="hidden" class="form-control" id="plan2_name_1" name="plan2_name" value="<?= (!empty($data[1]->plan2_name)) ? $data[1]->plan2_name : '' ;?>" >
                          <input type="hidden" class="form-control" id="plan_type_1" name="plan_type" value="2" >
                          
                        </div>
    			      </div>
    			      <div class="col-md-3">
                        <div class="form-group">
                          <label for="usr">Silver:</label>
                          <input type="text" class="form-control" id="amount_1" name="amount" value="<?= (!empty($data[1]->amount)) ? $data[1]->amount : '' ;?>">
                        </div>
    			          
    			      </div>
    			      <div class="col-md-3">
    			        <div class="form-group">
                          <label for="usr">Plantinum:</label>
                          <input type="text" class="form-control" id="amount2_1" name="amount2" value="<?= (!empty($data[1]->amount2)) ? $data[1]->amount2 : '' ;?>">
                        </div>
    			          
    			      </div>
                <div class="col-md-2">
                        <div class="form-group">
                          <label for="usr">Validity:</label>
                          <input type="text" class="form-control" id="validity_1" name="validity" value="<?= (!empty($data[1]->validity)) ? $data[1]->validity : '' ;?>">
                        </div>
                          
                      </div>
    			       <div class="col-md-2" style= "padding-top: 33px">
                        <div class="form-group">
                             <label for="usr"></label>
                          <input type="submit" name="update" class="btn btn-primary" value="Submit">
                          
                        </div>
    			      </div>
    			  </div>
    			  
    			</form>
                 <form name="channel" method="post" action="<?= base_url("admin/change-plan");?>">
                  <div class="row">
                      <div class="col-md-2" style= "padding-top: 33px">
                        <div class="form-group">
                          <label for="usr">Branch Franchise Plan:</label>
                          <input type="hidden" name="domain_id" class="domain_id_hidden">
                          <input type="hidden" class="form-control" id="id_2" name="id" value="<?= (!empty($data[2]->id)) ? $data[2]->id : '' ;?>" >
                          <input type="hidden" class="form-control" id="plan_name_2" name="plan_name" value="<?= (!empty($data[2]->plan_name)) ? $data[2]->plan_name : '' ;?>" >
                          <input type="hidden" class="form-control" id="plan2_name_2" name="plan2_name" value="<?= (!empty($data[2]->plan2_name)) ? $data[2]->plan2_name : '' ;?>" >
                          <input type="hidden" class="form-control" id="plan_type_2" name="plan_type" value="3" >
                          
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="usr">Silver:</label>
                          <input type="text" class="form-control" id="amount_2" name="amount" value="<?= (!empty($data[2]->amount)) ? $data[2]->amount : '' ;?>">
                        </div>
                          
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="usr">Plantinum:</label>
                          <input type="text" class="form-control" id="amount2_2" name="amount2" value="<?= (!empty($data[2]->amount2)) ? $data[2]->amount2 : '' ;?>">
                        </div>
                    </div>
                        <div class="col-md-2">
                        <div class="form-group">
                          <label for="usr">Validity:</label>
                          <input type="text" class="form-control" id="validity_2" name="validity" value="<?= (!empty($data[2]->validity)) ? $data[2]->validity : '' ;?>">
                        </div>
                      </div>    
                      
                       <div class="col-md-2" style= "padding-top: 33px">
                        <div class="form-group">
                             <label for="usr"></label>
                          <input type="submit" name="update" class="btn btn-primary" value="Submit">
                          
                        </div>
                      </div>
                  </div>
                  
                </form>
    			
    			<!---------- Generate payment link for user and agent ------------------->
    			<!--<form  method="post" action="<?php //echo base_url("admin/payment-link");?>">-->
    			<!--     <div class="row">-->
    			<!--      <div class="col-md-2" style= "padding-top: 33px">-->
       <!--                 <div class="form-group">-->
       <!--                   <label for="usr">Send Payment link:</label>-->
       <!--                   <input type="hidden" class="form-control" id="id" name="id" value="<?= (!empty($data[0]->id)) ? $data[0]->id : '' ; ;?>" >-->
       <!--                 </div>-->
    			<!--      </div>-->
    			<!--      <div class="col-md-2">-->
       <!--                 <div class="form-group">-->
       <!--                   <label for="usr">Mobile:</label>-->
       <!--                   <input type="text" class="form-control" id="mobile" name="mobile"  required/>-->
       <!--                 </div>-->
    			          
    			<!--      </div>-->
    			<!--      <div class="col-md-3">-->
    			<!--        <div class="form-group">-->
       <!--                   <label for="usr">Email:</label>-->
       <!--                   <input type="email" class="form-control" id="email" name="email"  required/>-->
       <!--                 </div>-->
    			          
    			<!--      </div>-->
    			<!--      <div class="col-md-2">-->
    			<!--        <div class="form-group">-->
       <!--                   <label for="usr">Amount:</label>-->
       <!--                   <input type="number" class="form-control" id="amount" name="amount"  required/>-->
       <!--                 </div>-->
    			          
    			<!--      </div>-->
    			<!--      <div class="col-md-2" style= "padding-top: 33px">-->
       <!--                 <div class="form-group">-->
       <!--                     <label for="usr"></label>-->
       <!--                   <input type="submit" name="Send" class="btn btn-primary" value="Send">-->
                          
       <!--                 </div>-->
    			<!--      </div>-->
    			<!--     </div>-->
    			<!-- </form>-->
    			
    			<!---------- Generate payment link for user and agent ends ------------------->
    			  
			  </div>
			</div>
		</div>
	</div>
</div>
<script>
document.getElementById("domain_id_main").addEventListener("change", function () {
    const selectedDomain = this.value;
    document.querySelectorAll(".domain_id_hidden").forEach(function (input) {
        input.value = selectedDomain;
    });
});

document.getElementById("domain_id_main").dispatchEvent(new Event('change'));
</script>

<script>
    document.getElementById("domain_id_main").addEventListener("change", function () {
    const selectedDomain = this.value;
    
    // Set the hidden domain_id value
    document.querySelectorAll(".domain_id_hidden").forEach(function (input) {
        input.value = selectedDomain;
    });

    // Make an AJAX request to fetch the plan data based on domain_id
    fetch("<?= base_url('admin/get_plan_data_by_domain'); ?>", {
        method: "POST",
        body: JSON.stringify({ domain_id: selectedDomain }),
        headers: {
            "Content-Type": "application/json"
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Clear all 3 forms first
            for (let i = 0; i < 3; i++) {
                document.getElementById(`id${i ? `_${i}` : ''}`).value = 1;
                document.getElementById(`amount${i ? `_${i}` : ''}`).value = 0;
                document.getElementById(`amount2${i ? `_${i}` : ''}`).value = 0;
                document.getElementById(`validity${i ? `_${i}` : ''}`).value = "lifetime";
                document.getElementById(`plan_name${i ? `_${i}` : ''}`).value = "Silver";
                document.getElementById(`plan2_name${i ? `_${i}` : ''}`).value = "Platinum";
                
            }

            data.plan.forEach(plan => {
                const idx = parseInt(plan.plan_type) - 1; // Convert plan_type to index (0,1,2)
                if (idx >= 0 && idx < 3) {
                    document.getElementById(`id${idx ? `_${idx}` : ''}`).value = plan.id;
                    document.getElementById(`amount${idx ? `_${idx}` : ''}`).value = plan.amount;
                    document.getElementById(`amount2${idx ? `_${idx}` : ''}`).value = plan.amount2;
                    document.getElementById(`validity${idx ? `_${idx}` : ''}`).value = plan.validity;
                    document.getElementById(`plan_name${idx ? `_${idx}` : ''}`).value = plan.plan_name;
                    document.getElementById(`plan2_name${idx ? `_${idx}` : ''}`).value = plan.plan2_name;
                }
            });
        } else {
            for (let i = 0; i < 3; i++) {
                document.getElementById(`id${i ? `_${i}` : ''}`).value = 1;
                document.getElementById(`amount${i ? `_${i}` : ''}`).value = 0;
                document.getElementById(`amount2${i ? `_${i}` : ''}`).value = 0;
                document.getElementById(`validity${i ? `_${i}` : ''}`).value = "lifetime";
                document.getElementById(`plan_name${i ? `_${i}` : ''}`).value = "Silver";
                document.getElementById(`plan2_name${i ? `_${i}` : ''}`).value = "Platinum";
            }
        }
    })
    .catch(error => {
        console.error("Error fetching plan data:", error);
        alert('There was an error retrieving the plan data.');
    });
});
</script>
