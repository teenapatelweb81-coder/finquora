 <style>
.table-responsive.text-light {
    padding-top: 70px;
}
 </style>
 
    <section class="reservation-form-over no-padding">
    <div class="container p-b-80 p-t-90">
      <div class="row reservation-form p-0 b-r-20">
           <div class="col-lg-4 col-md-4 col-12 p-30 b-r-20 background-pale-orange">
               <div class="table-responsive text-light">
                      <h4>Your details</h4>
                      <table class="table text-light">
                          <tbody>
                              <tr>
                                  <td class="cart-product-name">
                                      <strong>Name</strong>
                                  </td>
                                  <td class="cart-product-name text-right">
                                      
                                      <?php echo $name; ?>								
                                   </td>
                              </tr>
                              <tr>
                                  <td class="cart-product-name">
                                      <strong>Mobile no.</strong>
                                  </td>
                                  <td class="cart-product-name text-right">
                                      <?php echo $mobile; ?>								
                                   </td>
                              </tr>
                              <tr>
                                  <td class="cart-product-name">
                                      <strong>Loan Amount </strong>
                                  </td>
                                  <td class="cart-product-name text-right">
                                   <?php echo $loan_amount;?>
                                </td>
                              </tr>
                          </tbody>
                      </table>
                  </div>
           </div>
  
           <div class="col-lg-8 col-md-8 col-12 p-30">
               <!-- START : CHECK ELIGIBLITY -->
              <!--<form action="#" id="submitForm1" class="" >-->
              
              <form action="<?= base_url('/preapproval') ?>" method="POST">
                  <div class="row">
                      <div class="form-group col-md-12">
                          <p>Fill your details to get pre-approved loan offer from our NBFC Partners</p>
                      </div>
  
                      <input type="hidden" name="uid" value="<?php echo $uid ;?>" class="form-control" />
                      
                      <input type="hidden" name="loan_amount" value="<?php echo $loan_amount;?>" class="form-control" />
  
                      <input type="hidden" name="cust_type" value="<?php echo $cust_type;?>" class="form-control" />
  
                      <div class="form-group col-md-6">
                          <label class="text-dark" for="cibilscore">Cibil Score</label>
                          <select name="civil_score" aria-required="true" id="civil_score" class="form-control" required="">
                              <option value="">Select Score</option>
                              <option value="Below 650">Below 650</option>
                              <option value="650 - 700">650 - 700</option>
                              <option value="700 - 750">700 - 750</option>
                              <option value="750 - 800">750 - 800</option>
                              <option value="800 - 850">800 - 850</option>
                              <option value="850 - 900">850 - 900</option>
                          </select>
                          <div class="help-block font-small-3"></div>
                      </div>
  
                      <div class="form-group col-md-6">
                          <label class="text-dark" for="monincome">Monthly Income</label>
                          <input type="text" aria-required="true" name="monthly_income" placeholder="Enter Monthly Income" id="monthly_income" class="form-control" required="" data-validation-regex-regex="[0-9]+">
                          <div class="help-block font-small-3"></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="text-dark" >Aadhaar Number</label>
                            <input type="text" class="form-control" required="" id="aadhaar" name="aadhaar_no" maxlength="12" placeholder="Enter 12-digit Aadhaar">
                            <div class="help-block font-small-3"></div>
                        </div>
                            
                        <div class="form-group col-md-6">
                            <label class="text-dark" >PAN Number</label>
                            <input type="text" class="form-control" required="" id="pan" name="pan_no" maxlength="10" placeholder="ABCDE1234F">
                            <div class="help-block font-small-3"></div>
                        </div>


  
                      <div class="form-group col-md-6">
                          <label class="text-dark" for="monemi">Current Monthly EMI</label>
                          <input type="text" aria-required="true" name="current_emi" id="current_emi" class="form-control" required="" data-validation-regex-regex="[0-9]+" placeholder="Enter Current Monthly EMI1">
                          <div class="help-block font-small-3"></div>
                      </div>
  
                      <div class="form-group col-md-6">
                          <label class="text-dark" for="loanpurpose">Loan Purpose</label>
                          <select name="loan_type" aria-required="true" id="loan_type" class="form-control" required="">
                              <option value="">Select Loan Purpose</option>
                                    <option value="Personal Use">Personal Use</option>
                                    <option value="Property Renovation">Property Renovation</option>
                                    <option value="Marriage Purpose">Marriage Purpose</option>
                                    <option value="Education Purpose">Education Purpose</option>
                                    <option value="Medical Emergency">Medical Emergency</option>
                                    <option value="Other">Other</option>
                                        </select>
                          <div class="help-block font-small-3"></div>
                      </div>
  
                      <div class="form-group col-md-6">
                          <label class="text-dark" for="city">City</label>
                          <input type="text" aria-required="true" name="city" id="city" class="form-control" required="" placeholder="Enter City">
                          <div class="help-block font-small-3"></div>
                      </div>
  
                      <div class="form-group col-md-6">
                          <label class="text-dark" for="state">State</label>
                          <select name="state" aria-required="true" id="state" class="form-control" required="">
                              <option value="">Select State</option>
                              <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                              <option value="Andhra Pradesh">Andhra Pradesh</option>
                              <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                              <option value="Assam">Assam</option>
                              <option value="Bihar">Bihar</option>
                              <option value="Chandigarh">Chandigarh</option>
                              <option value="Chhattisgarh">Chhattisgarh</option>
                              <option value="Dadra and Nagar Haveli">Dadra and Nagar Haveli</option>
                              <option value="Daman and Diu">Daman and Diu</option>
                              <option value="Delhi">Delhi</option>
                              <option value="Goa">Goa</option>
                              <option value="Gujarat">Gujarat</option>
                              <option value="Haryana">Haryana</option>
                              <option value="Himachal Pradesh">Himachal Pradesh</option>
                              <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                              <option value="Jharkhand">Jharkhand</option>
                              <option value="Karnataka">Karnataka</option>
                              <option value="Kerala">Kerala</option>
                              <option value="Ladakh">Ladakh</option>
                              <option value="Lakshadweep">Lakshadweep</option>
                              <option value="Madhya Pradesh">Madhya Pradesh</option>
                              <option value="Maharashtra">Maharashtra</option>
                              <option value="Manipur">Manipur</option>
                              <option value="Meghalaya">Meghalaya</option>
                              <option value="Mizoram">Mizoram</option>
                              <option value="Nagaland">Nagaland</option>
                              <option value="Odisha">Odisha</option>
                              <option value="Puducherry">Puducherry</option>
                              <option value="Punjab">Punjab</option>
                              <option value="Rajasthan">Rajasthan</option>
                              <option value="Sikkim">Sikkim</option>
                              <option value="Tamil Nadu">Tamil Nadu</option>
                              <option value="Telangana">Telangana</option>
                              <option value="Tripura">Tripura</option>
                              <option value="Uttar Pradesh">Uttar Pradesh</option>
                              <option value="Uttarakhand">Uttarakhand</option>
                              <option value="West Bengal">West Bengal</option>						
                            </select>
                          <div class="help-block font-small-3"></div>
                      </div>
  
                      <div class="form-group col-md-12 text-center text-uppercase p-t-20">
                          <input type="submit" name="submit" class="btn btn-primary" value="CHECK ELIGIBILITY" />
                          <!--<button type="submit" id="form-submit1" class="btn btn-primary">CHECK ELIGIBILITY</button>-->
                      </div>
                  </div>
              
              </form>
           </div>
       </div>
    </div>
</section>
        