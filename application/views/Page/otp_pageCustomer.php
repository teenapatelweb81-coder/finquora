 
 <section class="profile-content">

    <div class="profile-image background-ash" style="background: <?php echo isset($buynowBanner['background_color']) ? $buynowBanner['background_color'] : ''; ?> !important;">

                <div class="profile-name p-40">

                    <!-- <h2>Helping You With Your Financial Pursuits, Smartly!</h2> -->
                    <h2><?php echo isset($buynowBanner['title']) ? $buynowBanner['title'] : 'No Title Available'; ?></h2>


                    <div class="list-icon list-icon-check list-icon-colored p-t-20">
                            <?php echo isset($buynowBanner['description']) ? $buynowBanner['description'] : '<ul><li>No description available</li></ul>'; ?>
                        </div>

                    <div class="line"></div>

                    <!-- <h4>Our Lending NBFC Partners</h4> -->
                    <h4><?php echo isset($buynowBanner['text']) ? $buynowBanner['text'] : 'No Title Available'; ?></h4>



                    <div class="carousel client-logos flickity-enabled is-draggable carousel-loaded" data-items="4"

                        data-dots="false" data-arrows="false">
                        
                        <?php if (isset($smartChoice)) { 
                        foreach ($smartChoice as $data) { ?>
                            <div>
                                    <img src="<?= base_url('beta/assets/images/banner_slider/'.$data['image']) ?>" alt="Image">
                            </div>
                    <?php } } else { ?>
                        <p>No banners available.</p>
                    <?php } ?>

                    </div>

                </div>

            </div>




            <div class="profile-bio">

                <section class="fullscreen p-t-40">

                    

                <!------------------------ User OTP screen  Starts ------------------------->

                    <div class="container m-0 p-10" id="second">

                        <div class="text-middle text-center">

                            <?php if (isset($otp_channel) && $otp_channel === 'email'): ?>
                            <h5 class="p-b-10">Please enter the OTP you got on your Email.</h5>
                            <?php else: ?>
                            <h5 class="p-b-10">Please enter the OTP you get on your Mobile No.</h5>
                            <?php endif; ?>

                            

                            <form action="#" id="submitForm2" class="col-md-12 col-sm-12 p-0" novalidate="novalidate" method="post" accept-charset="utf-8" data-gtm-form-interact-id="0">

                            <div class="form-group">

                            	<?php if (isset($otp_channel) && $otp_channel === 'email'): ?>
								<img src="https://ssl.gstatic.com/ui/v1/icons/mail/rfr/logo_gmail_lockup_default_1x_r2.png" alt="Email OTP" class="m-b-20" style="height:32px">

								<label class="text-dark" for="email">Email : <strong><?php echo $email;?></strong></label>
								<?php else: ?>
								<img src="https://nowofloan.com/assets/images/icons/mobile-otp.png" alt="Mobile OTP" class="m-b-20">

								<label class="text-dark" for="mobileno">Mobile : <strong><?php echo $mobile;?></strong></label>
								<?php endif; ?>

                            	<input type="hidden" name="otp" id="otp" value="<?php echo $otp; ?>">

                            	<input type="hidden" name="email" id="email" value="<?php echo $email; ?>">

                            	<input type="hidden" name="mobile" id="mobile" value="<?php echo $mobile; ?>">

                            	<input type="hidden" name="name" id="name" value="<?php echo $name; ?>">

                            	<input type="hidden" name="user_type" id="user_type" value="<?php echo $user_type; ?>">

                            	<input type="hidden" name="persone_type" id="persone_type" value="<?php echo $persone_type; ?>">

                            </div>

                            

                            <div class="form-group validate">

                            	<input type="text" name="otpcode" id="otpcode" class="form-control optnumber text-center" required="" maxlength="4" inputmode="numeric" data-validation-regex-regex="[0-9]+" aria-invalid="false" data-gtm-form-interact-field-id="0">

                            	<div class="help-block font-small-3"></div>

                            </div>

                            

                            <div class="p-countdown" data-delay="1">

                            	<div class="p-countdown-count" style="display: none;">

                            		<!--<code>New OTP code will generate in <span class="count-number">1</span> Sec</code>-->

                            	</div>

                            	<div class="p-countdown-show" style="display: block;"><code>Don't received OTP? <a href="javascript:resendotp()">Resend OTP</a></code></div>

                            	<!--<div><em> New OTP code will generate in  : </em><span id="countdown1" countdown="1"></span></div>-->

                            	<code id="resend-message"></code>

                            </div>

                            

                            <div class="custom-error" id="otpcodeError"></div>

                            

                            <div class="form-group m-b-0">

                            	<button type="submit" id="form-submit2" class="btn btn-block btn-primary">VERIFY</button>

                            </div>

                            </form>		

                        </div>

                    

                        <div class="line m-20"></div>

                    

                        <div class="text-center">

                            <p class="text-theme">Already have an account? 

                            <a href="<?php base_url('/');?>" class="btn btn-outline btn-sm text-uppercase">Login</a>

                            </p>

                        </div>

                    </div>

                <!------------------------ User OTP screen ends ------------------------->

		

		

                </section>



            </div>

        </section>



        <section>

            <div class="container">

                <div class="row">

                    <div class="col-md-6 col-12">

                        
                        <h5><?php echo isset($buynow_section_2['heading']) ? $buynow_section_2['heading'] : 'No Title Available'; ?></h5>



                        <!-- <h6 class="text-theme">Salaried Person Eligibility Criteria</h6> -->
                        <h6 class="text-theme"><?php echo isset($buynow_section_2['text1']) ? $buynow_section_2['text1'] : 'No Text Available'; ?></h6>

                        <!-- <p><small>(1) Min. Salary: Rs. 15,000/- per month (2) 1 Year Job Stability (3) Min. Age: 21

                                Years</small></p> -->
                                <p><small><?php echo isset($buynow_section_2['description_1']) ? $buynow_section_2['description_1'] : 'No Description Available'; ?></small></p>



                        <!-- <h6 class="text-theme">Self-Employed Person Eligibility Criteria</h6> -->
                        <h6 class="text-theme"><?php echo isset($buynow_section_2['text2']) ? $buynow_section_2['text2'] : 'No Text Available'; ?></h6>

                        <!-- <p><small>(1) Min. 1 Year IT Return (2) 1 Year Business Stability (3) Min. Age: 21 Years</small>

                        </p> -->
                        <p><small><?php echo isset($buynow_section_2['description_2']) ? $buynow_section_2['description_2'] : 'No Description Available'; ?></small></p>



                        <!-- <h6 class="text-theme">Rate of Interest starts at?</h6> -->
                        <h6 class="text-theme"><?php echo isset($buynow_section_2['text3']) ? $buynow_section_2['text3'] : 'No Text Available'; ?></h6>

                        <!-- <p><small>Personal Loan – 12.5%</small></p> -->
                        <p><small><?php echo isset($buynow_section_2['description_3']) ? $buynow_section_2['description_3'] : 'No Description Available'; ?></small></p>


                        <h6 class="text-theme"><?php echo isset($buynow_section_2['text4']) ? $buynow_section_2['text4'] : 'No Text Available'; ?></h6>
                                with Leading NBFCs</small></p> -->
                                <p><small><?php echo isset($buynow_section_2['description_4']) ? $buynow_section_2['description_4'] : 'No Description Available'; ?></small></p>



                        <!-- <h6 class="text-theme">How to works?</h6> -->
                        <h6 class="text-theme"><?php echo isset($buynow_section_2['text5']) ? $buynow_section_2['text5'] : 'No Text Available'; ?></h6>

                        <!-- <p><small>(1) Quick Registration (2) Check Eligibility (3) Buy Membership (4) Submit Documents

                                (5) Bank Verification (6) Bank Sanction</small></p> -->
                                <p><small><?php echo isset($buynow_section_2['description_5']) ? $buynow_section_2['description_5'] : 'No Description Available'; ?></small></p>



                        <h6 class="text-theme"><?php echo isset($buynow_section_2['text6']) ? $buynow_section_2['text6'] : 'No Text Available'; ?></h6>

                        <!-- <p><small>(1) Get Pre-Approved Loan Offers from Partnered NBFCs (2) 100% Online Financial

                                Consultation Process (3) Access Personalized Tracking Portal (4) 1 Year Free On-Call

                                Expert Consultancy (5) Apply For Loan Every 6 Months for Free (6) Earn up to 40%

                                Referral Payout Bonus</small></p> -->
                                <p><small><?php echo isset($buynow_section_2['description_6']) ? $buynow_section_2['description_6'] : 'No Description Available'; ?></small></p>

                    </div>



                    <div class="col-md-6 col-12">

                        <!-- <h5 class="text-theme">Overview – Personal Loan from Our Partnered NBFCs</h5> -->
                        <h5 class="text-theme"><?php echo isset($buynow_section_1['heading']) ? $buynow_section_1['heading'] : 'No Text Available'; ?></h5>

                        <!-- <p class="text-justify"><small>Money requirements can arise at any time and at any specific

                                instance of life. If you are planning for an exciting vacation at an enthralling

                                destination, or any of your family members is hit with a medical emergency, or you want

                                the dull interiors of your home to be renovated, or wedding bells are about to ring in

                                your home – the most convenient option to meet your money needs is by availing an

                                 Personal Loan from our Partnered NBFCs – who facilitates you with easy and

                                convenient personal loan offers with a 100% online process, that too utmost

                                quickly!</small></p> -->


                                <p class="text-justify"><small><?php echo isset($buynow_section_1['description']) ? $buynow_section_1['description'] : 'No Description Available'; ?></small></p>



                        <!-- <ul class="text-dark">

                            <li><small>Get Personal Loan - up to ₹15 Lakhs</small></li>

                            <li><small>Reasonable Interest Rate starting at 12.5%</small></li>

                            <li><small>Processing Charge of 2%</small></li>

                        </ul> -->

                        <div class="text-dark">
                            <?php echo isset($buynow_section_1['description_1']) ? html_entity_decode($buynow_section_1['description_1']) : '<ul><li><small>No details available</small></li></ul>'; ?>
                        </div>



                        <!-- <p class="text-justify"><small>Let's consider an example of an individual who is in pursuit of a

                                personal loan of ₹1 Lakh at the annual interest rate of 12.5% for a repayment tenure of

                                6 years. As the lending firms charge the processing fees, this individual would have to

                                pay 2% of the loan amount as processing fees. So, the EMI that this individual would

                                have to pay is ₹1982 per month. Additionally, the loan insurance amount has to be paid;

                                this amount is usually 2% but it also depends on the applicant's age.</small></p> -->

                                <p class="text-justify"><small><?php echo isset($buynow_section_1['description_2']) ? $buynow_section_1['description_2'] : 'No Description Available'; ?></small></p>



                        <div class="profile-bio-footer">

                            <!-- <h6 class="text-theme">Contact Us</h6> -->
                            <h6 class="text-theme"><?php echo isset($buynow_section_1['contact_us']) ? $buynow_section_1['contact_us'] : 'No Heading Available'; ?></h6>

                            <address>

                                <small>

                                    <!-- <strong>Corporate Office Address:</strong> -->
                                    <strong><?php echo isset($buynow_section_1['contact_title']) ? $buynow_section_1['contact_title'] : 'No Heading Available'; ?></strong>

                                    <br>
                                    <!-- E-Wing,Kohinoor Abhiman Homes, Shirgaon, pune, 410506<br><i class="fa fa-clock m-r-5"></i>10 AM to 5 PM (Monday to Saturday)  -->
                                    <?php echo isset($buynow_section_1['contact_address']) ? $buynow_section_1['contact_address'] : 'No Heading Available'; ?><br><i class="fa fa-clock m-r-5"></i><?php echo isset($buynow_section_1['contact_time']) ? $buynow_section_1['contact_time'] : 'No Heading Available'; ?> 
                                </small>

                            </address>

                        </div>

                    </div>

                </div>

            </div>

        </section>

        

   <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>      

     <script>

     

       $('#submitForm2').submit(function (e) {

        e.preventDefault();

        var otpcode = $("#otpcode").val(); 

        var otp     = $("#otp").val();

        var email   = $("#email").val();

        var mobile  = $("#mobile").val();

        var name    =  $("#name").val();

        var role    =  $("#user_type").val();

        
        var persone_type    =  $("#persone_type").val();

        

        if(otpcode === otp) {

            const regData = {name : name,

                            email : email,

                            mobile : mobile,

                            status : 2,

                            user_type   : role

                

                            };

        

            $.ajax({

                    type: 'post',

                    url: "<?php echo base_url('/userRegistration');?>",

                    data: regData,

                    success: function (response) {

                        const obj = JSON.parse(response);

                        

                        if(obj.status == "true") {

                            if(role == "user") {

                         
                                window.location.href = "<?php echo base_url('/checkamount');?>?type=" + persone_type;


                            }

                            else {

                                window.location.href = "<?php echo base_url('/agentdetail');?>"; 

                            }

                           

                        }

                        

                     },

                    error: function (error) {

                  

                      alert("server error")

                    }

                  });

            

        }

        else {

            alert("OTP is invalid");

        }

     

    }); 

         

     </script>

   