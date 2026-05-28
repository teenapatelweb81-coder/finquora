<?php $prearrovedAmount = rand(300000, 699999);?>

    <div class="breakpoint-xl b--desktop">

        <div class="body-inner">

           

            <div id="slider" class="inspiro-slider max-vh-30 ">

  	            <div class="slide bg-loaded is-selected" data-bg-image="https://nowofloan.com/assets/images/slider/bg-img-6.jpg">

                </div>

            </div>

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

                                              <td class="cart-product-name text-right"><?php echo $name;?></td>

                                          </tr>

                                          <tr>

                                              <td class="cart-product-name">

                                                  <strong>Mobile no.</strong>

                                              </td>

                                              <td class="cart-product-name text-right"><?php echo $mobile;?>	</td>

                                          </tr>

                                          <tr>

                                              <td class="cart-product-name">

                                                  <strong>Loan Amount </strong>

                                              </td>

                                              <td class="cart-product-name text-right"><?php echo $eligibilityData['loan_amount'];?></td>

                                          </tr>

                                      </tbody>

                                  </table>

                              </div>

                       </div>

              

                       <div class="col-lg-8 col-md-8 col-12 p-30">

                           <!-- START : CHECK ELIGIBLITY -->

                          <form action="<?php echo base_url('card');?>" id="submitForm2" method="post">

                              <div class="row">

                                  <input type="hidden" name="applyid" value="1573810" class="form-control" required="">

              

                                  <input type="hidden" name="userid" value="1565721" class="form-control" required="">
                                  <input type="hidden" name="uid" value="<?php echo $eligibilityData['uid'];?>" class="form-control">
                                  <!-- <input type="hidden" name="required_loan_amount" value="<?php echo $prearrovedAmount;?>" class="form-control"> -->
                                  <input type="hidden" name="required_loan_amount" value="334540" class="form-control">
                                  <input type="hidden" name="loan_amount" value="<?php echo $eligibilityData['loan_amount'];?>" class="form-control">

                                                      

                                  <input type="hidden" name="mobile" value="6395872676" class="form-control" required="">

              

                                  <input type="hidden" name="cardtype" value="11" class="form-control" required="">

              

                                  <div class="form-group col-md-12">

                                     <input type="hidden" name="eligibilityamt" value="164526" class="form-control" required="">

              

                                      <p><span class="badge badge-info">Pre-Approved Offer - Expiring at 12 am</span></p>

                                      <!-- <h5 class="text-success">Congrats! Your Loan Amount Rs. <?php echo $prearrovedAmount;?> is Successfully Pre-Approved*. Get Your Pre-Approved Loan Offer in Just Few Steps!</h5> -->
                                      <h5 class="text-success">Congrats! Your Loan Amount Rs. 334540 is Successfully Pre-Approved*. Get Your Pre-Approved Loan Offer in Just Few Steps!</h5>

                                      <hr>

                        </div>

              

                        <div class="form-group col-md-12">

                                      <h5>As per your required loan amount - Rs. <strong><?php echo $eligibilityData['loan_amount'];?></strong>. Your monthly EMI are as below. Kindly select any option:</h5>

                                  </div>

              

                                  <div class="form-group col-md-12 text-dark">

                                      <div class="form-check">

                                          <label class="form-check-label m-l-15 text-left">

                                              <strong>Tenure</strong> <i class="fa fa-long-arrow-right m-r-20 m-l-20"></i> <strong>EMI</strong>

                                          </label>

                                      </div>

              
              
                                      <?php
                                            // function calculateEMI($loanAmount, $tenure) {
                                            //     $annualInterestRate = 12; // 12% annual interest
                                            //     $monthlyInterestRate = ($annualInterestRate / 12) / 100; // Monthly Interest Rate
                                            //     $months = $tenure; // Loan Tenure in Months

                                            //     $emi = ($loanAmount * $monthlyInterestRate * pow(1 + $monthlyInterestRate, $months)) / 
                                            //         (pow(1 + $monthlyInterestRate, $months) - 1);

                                            //     return round($emi, 2); // Round to 2 decimal places
                                            // }

                                                                                        
                                                function calculateEMI($P, $annualInterestRate, $n) {
                                                    $r = ($annualInterestRate / 100) / 12; // Monthly Interest Rate
                                                    $emi = ($P * $r * pow(1 + $r, $n)) / (pow(1 + $r, $n) - 1);
                                                    return round($emi, 2);
                                                }

                                              
                                                $annualInterestRate = 12; // Annual Interest Rate
                                                

                                            $emi_36 = calculateEMI($prearrovedAmount, $annualInterestRate, 36);
                                            $emi_48 = calculateEMI($prearrovedAmount, $annualInterestRate, 48);
                                            $emi_60 = calculateEMI($prearrovedAmount, $annualInterestRate, 60);
                                            ?>

                                      <div class="form-check">

                                          <input type="radio" class="form-check-input" name="tenure" id="years3" value="36" checked="">

                                          <label class="form-check-label m-l-10" for="years3">

                                              36 Months <i class="fa fa-long-arrow-right m-r-10 m-l-10"></i> Rs. <?php echo number_format($emi_36, 2); ?>							</label>

                                      </div>

              

                                      <div class="form-check">

                                          <input type="radio" class="form-check-input" name="tenure" id="years4" value="48">

                                          <label class="form-check-label m-l-10" for="years4">

                                              48 Months <i class="fa fa-long-arrow-right m-r-10 m-l-10"></i> Rs. <?php echo number_format($emi_48, 2); ?>							</label>

                                      </div>

              

                                      <div class="form-check">

                                          <input type="radio" class="form-check-input" name="tenure" id="years5" value="60">

                                          <label class="form-check-label m-l-10" for="years5">

                                              60 Months <i class="fa fa-long-arrow-right m-r-10 m-l-10"></i> Rs. <?php echo number_format($emi_60, 2); ?>							</label>

                                      </div>

                                  </div>

              

                                  <div class="form-group col-md-12 text-center text-uppercase js-confetti">

                                      <button  class="btn btn-primary">GET OFFER</button>

                                      <!--<button type="submit" id="form-submit2" class="btn btn-primary">GET OFFER</button>-->

                                  </div>

              

                                  <div class="form-group col-md-12 text-center">

                                      <hr>

                                      <p class="m-b-0"><small>How is pre-approved loan offer calculated? <a class="text-primary" data-target="#modal" data-toggle="modal" href="#">Know Here</a></small></p>

                                  </div>

                              </div>

                          </form>			<!-- END : CHECK ELIGIBLITY -->

                       </div>

              

                   </div>

                </div>

              </section>

              <section class="p-b-30 background-ash">

                <div class="container">

                    <div class="text-center">

                        <h2>Your Pre-Approved Loan Offers From Partnered NBFCs</h2>

                        <p>View the specifics of your pre-approved offers</p>

                    </div>

            

                    <div class="row">

                                    <div class="col-md-3 col-12">

                            <div class="icon-box effect center process m-t-10 m-b-10 p-10 w-100 b-r-10 background-white">

                                <img alt="" src="./assets/images/037.png">

                                <p class="m-t-20 m-b-5">Rs. 20,000.00						<br></p><hr>

                                    <strong>EMI : Rs. 1,043.00</strong>

                                    <br><hr>

                                    ROI : 22.50%						<br><hr>

                                    Terms : 24 months<p></p>

                            </div>

                        </div>

                                    <div class="col-md-3 col-12">

                            <div class="icon-box effect center process m-t-10 m-b-10 p-10 w-100 b-r-10 background-white">

                                <img alt="" src="./assets/images/022.png">

                                <p class="m-t-20 m-b-5">Rs. 20,000.00						<br></p><hr>

                                    <strong>EMI : Rs. 508.00</strong>

                                    <br><hr>

                                    ROI : 18.00%						<br><hr>

                                    Terms : 60 months<p></p>

                            </div>

                        </div>

                                    <div class="col-md-3 col-12">

                            <div class="icon-box effect center process m-t-10 m-b-10 p-10 w-100 b-r-10 background-white">

                                <img alt="" src="./assets/images/034.png">

                                <p class="m-t-20 m-b-5">Rs. 20,000.00						<br></p><hr>

                                    <strong>EMI : Rs. 974.00</strong>

                                    <br><hr>

                                    ROI : 15.50%						<br><hr>

                                    Terms : 24 months<p></p>

                            </div>

                        </div>

                                    <div class="col-md-3 col-12">

                            <div class="icon-box effect center process m-t-10 m-b-10 p-10 w-100 b-r-10 background-white">

                                <img alt="" src="./assets/images/015.png">

                                <p class="m-t-20 m-b-5">Rs. 20,000.00						<br></p><hr>

                                    <strong>EMI : Rs. 664.00</strong>

                                    <br><hr>

                                    ROI : 12.00%						<br><hr>

                                    Terms : 36 months<p></p>

                            </div>

                        </div>

                        

                        <div class="col-12 text-center">

                            <p class="p-t-10"><small>Disclaimer - The above data is tentative and purely on the information provided by you. Final EMI, loan sanction, loan approval, and loan amount depend on customer profile and NBFCs criteria and rules &amp; regulations.</small></p>

                        </div>

                    </div>

                </div>

            </section>

            

        </div>

    </div>

    <script src="./assets/js/jquery.js"></script>

    <script src="./assets/js/plugins.js"></script>

    <script src="./assets/js/functions.js"></script>

</body>