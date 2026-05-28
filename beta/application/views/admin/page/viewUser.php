<style>
.container {
    margin-top: 20px;
    margin-bottom: 15px;
}
</style>


<div class="container-fluid p-0">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin/Dashboard/");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Edit user</li>
           </ol>
         </nav>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-12 px-0">
		    <div id="message" class="text-primary text-center"></div>
			<div class="table-responsive shadow-lg">
			 <div class="container">
			     <form name="channel" method="post" action="<?php echo base_url("admin/update-user");?>">
			     <input type="hidden" class="form-control" id="id" name="id" value="<?= isset($datas[0]->id) ? $datas[0]->id : ''?>" >
    			  <div class="row">
    			      <div class="col-md-6">
                        <div class="form-group">
                          <label for="usr">Name:</label>
                          <input type="text" class="form-control" id="name" name="name" value="<?=isset($datas[0]->name) ? $datas[0]->name : ''?>" >
                        </div>
    			          
    			      </div>
    			      <div class="col-md-6">
    			        <div class="form-group">
                          <label for="usr">Email:</label>
                          <input type="text" class="form-control" id="email" name="email" value="<?=isset($datas[0]->email) ? $datas[0]->email : ''?>" readonly>
                        </div>
    			          
    			      </div>
    			  </div>
    			  <div class="row">
    			      <div class="col-md-6">
                        <div class="form-group">
                          <label for="usr">username:</label>
                          <input type="text" class="form-control" id="username" name="username" value="<?=isset($datas[0]->username) ? $datas[0]->username : ''?>">
                        </div>
    			          
    			      </div>
    			      <div class="col-md-6">
    			        <div class="form-group">
                          <label for="usr">mobile:</label>
                          <input type="text" class="form-control" id="mobile" name="mobile" value="<?=isset($datas[0]->mobile) ? $datas[0]->mobile : ''?>">
                        </div>
    			          
    			      </div>
    			  </div>
    			  <div class="row">
    			      

					  <div class="col-md-6">
    			        <div class="form-group">
                          <label for="usr">Loan Amount:</label>
                          <input type="text" class="form-control" id="mobile" name="mobile" value="<?= isset($eligibilityData['loan_amount']) ? $eligibilityData['loan_amount'] : '' ?> ">
                        </div>
    			          
    			      </div>

                <div class="col-md-6">
    			        <div class="form-group">
                          <label for="usr">Customer Type:</label>
                         <input type="text" 
       class="form-control" 
       id="mobile" 
       name="mobile" 
       value="<?= isset($eligibilityData['loan_amount']) 
                  ? ($eligibilityData['cust_type'] == 1 
                        ? 'Self Employed Person' 
                        : 'Salaried Person') 
                  : '' ?>">

                        </div>
    			          
    			      </div>

    			  </div>
				  <div class="row">
    			      <div class="col-md-6">
                        <div class="form-group">
                          <label for="usr">Civil Score:</label>
                        
                          <input type="text" class="form-control" id="mobile" name="mobile" value="<?= isset($eligibilityData['civil_score']) ? $eligibilityData['civil_score'] : '' ?>">
                        </div>
    			          
    			      </div>

					  <div class="col-md-6">
    			        <div class="form-group">
                          <label for="usr">Monthly Income:</label>
                          <input type="text" class="form-control" id="mobile" name="mobile" value="<?= isset($eligibilityData['monthly_income']) ? $eligibilityData['monthly_income'] : '' ?> ">
                        </div>
    			          
    			      </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="usr">Aadhaar no:</label>
                    <input type="text" class="form-control" id="aadhaar_no" name="aadhaar_no" value="<?= isset($eligibilityData['aadhaar_no']) ? $eligibilityData['aadhaar_no'] : '' ?> ">
                  </div>
                </div>
    
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="usr">Pancard no:</label>
                      <input type="text" class="form-control" id="pan_no" name="pan_no" value="<?= isset($eligibilityData['pan_no']) ? $eligibilityData['pan_no'] : '' ?> ">
                    </div>
                </div>

    			  </div>
            

				  <div class="row">
    			      <div class="col-md-6">
                        <div class="form-group">
                          <label for="usr">Current Monthly EMI:</label>
                        
                          <input type="text" class="form-control" id="mobile" name="mobile" value="<?= isset($eligibilityData['current_emi']) ? $eligibilityData['current_emi'] : '' ?> ">
                        </div>
    			          
    			      </div>

					  <div class="col-md-6">
    			        <div class="form-group">
                          <label for="usr">Loan Purpose:</label>
                          <input type="text" class="form-control" id="mobile" name="mobile" value="<?= isset($eligibilityData['loan_type']) ? $eligibilityData['loan_type'] : '' ?>">
                        </div>
    			          
    			      </div>

    			  </div>

				  <div class="row">
    			      <div class="col-md-6">
                        <div class="form-group">
                          <label for="usr">City:</label>
                        
                          <input type="text" class="form-control" id="mobile" name="mobile" value="<?= isset($eligibilityData['city']) ? $eligibilityData['city'] : '' ?>">
                        </div>
    			          
    			      </div>

					  <div class="col-md-6">
    			        <div class="form-group">
                          <label for="usr">State:</label>
                          <input type="text" class="form-control" id="mobile" name="mobile" value="<?= isset($eligibilityData['state']) ? $eligibilityData['state'] : '' ?>">
                        </div>
    			          
    			      </div>

    			  </div>

				  <div class="row">
    			      <div class="col-md-6">
                        <div class="form-group">
                          <label for="usr">Subscription Plan:</label>
                        
                          <input type="text" class="form-control" id="mobile" name="mobile" value="<?=isset($datas[0]->subscription) ? $datas[0]->subscription : ''?>">
                        </div>
    			          
    			      </div>

                <div class="col-md-6">
                        <div class="form-group">
                          <label for="usr">Plan Amount:</label>
                      
                          <input type="text" class="form-control" id="mobile" name="mobile" value="<?=$user['plan_amount']?>">
                        </div>
    			          
    			      </div>


    			  </div>

				  <div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="usr">Required Loan Amount:</label>
            <input type="text" class="form-control" id="mobile" name="mobile"
               value="<?= isset($pre_approval['required_loan_amount']) ? $pre_approval['required_loan_amount'] : '' ?>"
>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="usr">Tenure:</label>
            <input type="text" class="form-control" id="mobile" name="mobile"
                value="<?= isset($pre_approval['tenure']) ? $pre_approval['tenure'] . ' Months' : '' ?>">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="usr">EMI:</label>
            <input type="text" class="form-control" id="mobile" name="mobile"
                value="<?= isset($pre_approval['emi']) ? 'Rs. ' . $pre_approval['emi'] : '' ?>">
        </div>
    </div>

    <?php if ($user['step'] <= 6) { ?>
        <div class="col-md-6">
            <div class="form-group">
                <label for="usr"> The customer stopped filling the form here: </label>
                <input type="text" class="form-control" id="mobile" name="mobile"
                    value="<?= isset($user['step_url']) ? $user['step_url'] : '' ?>">
            </div>
        </div>
    <?php } ?>
</div>


				  <div class="row">
				  <?php if (isset($transection['image'])) { 
        // Remove the first occurrence of 'beta' from the image path
        $imagePath = str_replace('/beta', '', $transection['image']); 
    ?>
	 <img src="<?= str_replace('/beta/', '/', base_url()); ?><?php echo $imagePath; ?>" alt="Payment Image" class="img-fluid" style="
    width: 100px;
    height: auto;
">
	 <?php }?>
 

    			  </div>
    			  
    			
    		
    			</form>
    			  
			  </div>
			</div>
		</div>
	</div>
</div>
<script>
  $(document).ready(function(){
    $("input, select").prop("disabled", true); // Disable all inputs and selects
});

</script>