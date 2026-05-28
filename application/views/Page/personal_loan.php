 <section class="profile-content">

            <div class="profile-image background-ash" style="background: <?php echo isset($buynowBanner['background_color']) ? $buynowBanner['background_color'] : '' ?>!important;">

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

                    <!-------------- user registration  start ------------------->

                    <div class="container m-0 p-10" id="first">

                         <div class="text-middle">

                             

                            <!-- <h4>Get Rs.5,00,000/- Pre-Approved Loan Offer in 5 min from Our NBFC Partner</h4> -->
                            <h4><?php echo isset($buynowSection['title']) ? $buynowSection['title'] : 'No Title Available'; ?></h4>

                            <!-- <p class="p-b-20">Start off the process with just a few details</p> -->
                            <p class="p-b-20"><?php echo isset($buynowSection['text']) ? $buynowSection['text'] : 'No Text Available'; ?></p>



                            <!--<form action="" id="#"  method="post" class="col-md-12 col-sm-12 p-0"-->

                            <!--    method="post" accept-charset="utf-8">-->

                            <?php if( $this->session->flashdata('message') ) {?>

                          <span class="text-center text-danger mb-3"> <?php  echo $this->session->flashdata('message') ; ?></span>

                          <?php }?>

                            <?php echo form_open('/sendotp_customer');?>

                                <input type="hidden" name="loantype" value="2">

                                <input type="hidden" name="user_type" value="user">
                                <input type="hidden" name="persone_type" value="<?php echo $this->uri->segment('1'); ?>">



                                <div class="form-group">

                                    <label class="text-dark" for="fullname">Full name</label>

                                    <input type="text" aria-required="true" name="name" id="name"

                                        class="form-control" placeholder="Bank registerd name" required/>

                                    <div class="help-block font-small-3"></div>

                                </div>

                                

                                <div class="form-group">

                                    <label class="text-dark" for="email">Email:*</label>

                                    <input type="email" aria-required="true" name="email" id="email"

                                        class="form-control" placeholder="Bank registerd number" required>

                                    <div class="help-block font-small-3"></div>

                                </div>



                                <div class="form-group">

                                    <label class="text-dark" for="mobile">Mobile no.</label>

                                    <input type="text" aria-required="true" name="mobile" id="mobile"

                                        class="form-control" placeholder="Bank registerd number" 

                                        minlength="10" maxlength="10" data-validation-regex-regex="^[6789]\d{9}$"  required>

                                    <div class="help-block font-small-3"></div>

                                </div>



                                <div class="form-group">

                                    <div class="custom-control custom-checkbox">

                                        <input type="checkbox" aria-required="true" name="conditions" id="conditions"

                                            class="custom-control-input" value="1" required>

                                        <label class="custom-control-label" for="conditions"><small>By proceeding, you

                                                agree to the <a href="<?php echo base_url('terms-conditions'); ?>"

                                                    target="_blank">Terms of Use</a> and <a

                                                    href="<?php echo base_url('privacy-policy'); ?>" target="_blank">Privacy

                                                    Policy</a> of <?= base_url()?></small></label>

                                        <div class="help-block font-small-3"></div>

                                    </div>

                                </div>



                                <div class="custom-error" id="mobilenoError"></div>



                                <div class="form-group">

                                    <!--<button type="submit" id="form1submit" class="btn btn-block btn-primary">APPLY NOW</button>-->

                                    <input type="submit" name="submit" class="btn btn-block btn-primary" value="APPLY NOW"/>

                                </div>



                                
                            <!--</form>-->

                            <?php echo form_close();?>

                        </div>





                        <div class="line m-20"></div>



                        <div class="text-center">

                            <p class="text-theme">Already have an account?

                                <a href="<?php echo base_url('/customer');?>" class="btn btn-outline btn-sm text-uppercase">Login</a>

                            </p>

                        </div>



                    </div>

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
                                with Leading NBFCs</small></p>
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

  <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>

   <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>

   

 <script>  

//   function resendotp() {

//       var email = localStorage.getItem('email');

//       $.ajax({

//             type: 'post',

//             url: "<?php echo base_url('/sendotp');?>",

//             data: {email : email},

//             success: function (response) {

//                 const obj = JSON.parse(response);

//                 if(obj.otp) {

//                     $("#mob").html(mobile);

//                      var date = new Date();

//                      var minutes = 0.5;

//                      var otpTime = date.setTime(date.getTime() + (minutes * 60 * 1000));

//                      localStorage.setItem('regotp', obj.otp, { expires: otpTime })

//                       setTimeout(function() {

//                           localStorage.removeItem('regotp');

                          

//                         }, otpTime);

                    

//                 }

//                 else {

//                   alert("Otp is not send correctly") 

//                 }

               

//             },

//             error: function (error) {

          

//               alert("server error")

//             }

//           });

      

      

//   }



    // $('#submitForm2').submit(function (e) {

    //     e.preventDefault();

    //     var otpcode = $("#otpcode").val();    

    //     var otpold  =    localStorage.getItem('regotp');

    //     if(otpcode === otpold) {

    //         const regData = {name : localStorage.getItem('name'),

    //                         email : localStorage.getItem('email'),

    //                         mobile : localStorage.getItem('mobile'),

    //                         status : 1

                

    //                         };

    //         $.ajax({

    //                 type: 'post',

    //                 url: "<?php echo base_url('/userRegistration');?>",

    //                 data: regData,

    //                 success: function (response) {

    //                     console.log(response)

    //                  },

    //                 error: function (error) {

                  

    //                   alert("server error")

    //                 }

    //               });

            

    //     }

    //     else {

    //         alert("OTP is invalid");

    //     }

     

    // });  

        

    // $('#submitForm1').submit(function (e) {

    //       e.preventDefault();

          

    //     var name        = $("#name").val();

    //     var email        = $("#email").val();

    //     var mobile        = $("#mobile").val();

    //     var conditions        = $("#conditions").val();

    //     if(!name) {

    //         $("#name").css({"border": "2px solid red"});

    //         return false;

    //     }

    //     if(!email) {

    //         $("#email").css({"border": "2px solid red"});

    //         return false;

    //     }

        

    //     if(!mobile) {

    //         $("#mobile").css({"border": "2px solid red"});

    //         return false;

    //     }

    //     if(!conditions) {

    //         $("#conditions").css({"border": "2px solid red"});

    //         return false;

    //     }

        

    //     if(isValidEmailAddress(email)) {

            

    //         const emailValidate = checkEmail(email);

            

    //         console.log(emailValidate);

            

    //         $('#name').removeAttr('style');

    //         $('#email').removeAttr('style');

    //         $('#mobile').removeAttr('style');

    //         $('#conditions').removeAttr('style');

    //         //   $.ajax({

    //         //     type: 'post',

    //         //     url: "<?php echo base_url('/sendotp');?>",

    //         //     data: $('form').serialize(),

    //         //     success: function (response) {

    //         //         const obj = JSON.parse(response);

    //         //         if(obj.otp) {

    //         //             $("#mob").html(mobile);

    //         //              var date = new Date();

    //         //              var minutes = 0.5;

    //         //              var otpTime = date.setTime(date.getTime() + (minutes * 60 * 1000));

    //         //              localStorage.setItem('regotp', obj.otp, { expires: otpTime })

    //         //              localStorage.setItem('mobile', mobile)

    //         //              localStorage.setItem('email', email)

    //         //              localStorage.setItem('name', name)

    //         //               setTimeout(function() {

    //         //                   localStorage.removeItem('regotp');

                              

    //         //                 }, otpTime);

                        

    //         //              document.getElementById("submitForm1").reset();

    //         //              $("#second").show();

    //         //              $("#first").hide();

                        

    //         //         }

    //         //         else {

    //         //           alert("Otp is not send correctly") 

    //         //         }

                   

    //         //     },

    //         //     error: function (error) {

              

    //         //       alert("server error")

    //         //     }

    //         //   });

            

    //     }

    //     else {

            

    //     }

      

          

    // });

    

    // function checkEmail(userEmail) {

    //     $.ajax({

    //         type: 'post',

    //         url: "<?php echo base_url('/checkEmail');?>",

    //         data: {email : email},

    //         success: function (response) {

                

    //           console.log(response);

    //         },

    //         error: function (error) {

          

    //           alert("server error")

    //         }

    //     });

        

        

    // }

    

    // function isValidEmailAddress(emailAddress) {

    //         var pattern = new RegExp(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/);

    //         return pattern.test(emailAddress);

    // };

    

 </script>

    

