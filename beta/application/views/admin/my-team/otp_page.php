 <section class="profile-content">



            <div class="profile-bio card form-card">

                <section class="fullscreen " style="padding-top: 4rem;">

                    

                <!------------------------ User OTP screen  Starts ------------------------->

                    <div class="container m-0 p-10 w-100 m-auto" id="second" style="display: flex;flex-direction: row;justify-content: center;">

                        <div class="text-middle text-center">

                            <?php if (isset($otp_channel) && $otp_channel === 'email'): ?>
                            <h5 class="p-b-10">Please enter the OTP you got on your Email.</h5>
                            <?php else: ?>
                            <h5 class="p-b-10">Please enter the OTP you get on your Mobile No.</h5>
                            <?php endif; ?>

                            

                            <form action="#" id="submitForm2" class="col-md-12 col-sm-12 p-0" novalidate="novalidate" method="post" accept-charset="utf-8" data-gtm-form-interact-id="0">

                            <div class="form-group">

                            	<?php if (isset($otp_channel) && $otp_channel === 'email'): ?>
								<img src="https://ssl.gstatic.com/ui/v1/icons/mail/rfr/logo_gmail_lockup_default_1x_r2.png" alt="Email OTP" class="m-b-20" style="height:32px"><br>

								<label class="text-dark" for="email">Email : <strong><?php echo $email;?></strong></label>
								<?php else: ?>
								<img src="https://nowofloan.com/assets/images/icons/mobile-otp.png" alt="Mobile OTP" class="m-b-20"><br>

								<label class="text-dark" for="mobileno">Mobile : <strong><?php echo $mobile;?></strong></label>
								<?php endif; ?>

                            	<input type="hidden" name="otp" id="otp" value="<?php echo $otp; ?>">
                                <?php if(isset($domain_id)){ ?>
                            	<input type="hidden" name="domain_id" id="domain_id" value="<?php echo $domain_id; ?>">
                                <?php }else{ ?>
                                    <input type="hidden" name="domain_id" id="domain_id" value="<?php echo domain_id_get(); ?>">

                                <?php } ?>

                            	<input type="hidden" name="email" id="email" value="<?php echo $email; ?>">

                            	<input type="hidden" name="mobile" id="mobile" value="<?php echo $mobile; ?>">

                            	<input type="hidden" name="name" id="name" value="<?php echo $name; ?>">

                            	<input type="hidden" name="user_type" id="user_type" value="<?php echo $user_type; ?>">

                            	<input type="hidden" name="city" id="city" value="<?php echo $city; ?>">

                            	<input type="hidden" name="address" id="address" value="<?php echo $address; ?>">

                            	<input type="hidden" name="pin_code" id="pin_code" value="<?php echo $pin_code; ?>">
                                
                            	<input type="hidden" name="joining_date" id="joining_date" value="<?php echo $joining_date ?? ''; ?>">
                            	<input type="hidden" name="description" id="description" value="<?php echo $description  ?? ''; ?>">
                            	<input type="hidden" name="profile_photo" id="profile_photo" value="<?php echo $profile_photo  ?? ''; ?>">
                            	<input type="hidden" name="emp_profile" id="emp_profile" value="<?php echo $emp_profile  ?? ''; ?>">
                                
                            	<input type="hidden" name="job_title" id="job_title" value="<?php echo $job_title  ?? ''; ?>">
                            	<input type="hidden" name="emergency_number" id="emergency_number" value="<?php echo $emergency_number  ?? ''; ?>">
                            	<input type="hidden" name="work_schedule" id="work_schedule" value="<?php echo $work_schedule  ?? ''; ?>">
                            	<input type="hidden" name="annual_salary" id="annual_salary" value="<?php echo $annual_salary  ?? ''; ?>">
                            	<input type="hidden" name="min_retainership_amount" id="min_retainership_amount" value="<?php echo $min_retainership_amount  ?? ''; ?>">
                            	<input type="hidden" name="max_retainership_amount" id="max_retainership_amount" value="<?php echo $max_retainership_amount  ?? ''; ?>">
                            	<input type="hidden" name="proposed_start_date" id="proposed_start_date" value="<?php echo $proposed_start_date  ?? ''; ?>">
                            	<input type="hidden" name="reporting_to" id="reporting_to" value="<?php echo $reporting_to  ?? ''; ?>">

                            </div>

                            

                            <div class="form-group validate">

                            	<input type="text" name="otpcode" id="otpcode" class="form-control optnumber text-center" required="" maxlength="4" inputmode="numeric" data-validation-regex-regex="[0-9]+" aria-invalid="false" data-gtm-form-interact-field-id="0" style="font-size: 2rem!important;letter-spacing: 1rem;">

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

                

                    </div>

                <!------------------------ User OTP screen ends ------------------------->

		

		

                </section>



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

        var city    =  $("#city").val();

        var address    =  $("#address").val();

        var pin_code    =  $("#pin_code").val();

        var role    =  $("#user_type").val();
        var domain_id    =  $("#domain_id").val();

        var emp_profile    =  $("#emp_profile").val();
        var joining_date    =  $("#joining_date").val();
        var description    =  $("#description").val();
        var profile_photo    =  $("#profile_photo").val();
        
        var job_title    =  $("#job_title").val();
        var emergency_number    =  $("#emergency_number").val();
        var work_schedule    =  $("#work_schedule").val();
        var annual_salary    =  $("#annual_salary").val();
        var min_retainership_amount    =  $("#min_retainership_amount").val();
        var max_retainership_amount    =  $("#max_retainership_amount").val();
        var proposed_start_date    =  $("#proposed_start_date").val();
        var reporting_to    =  $("#reporting_to").val();
        

        if(otpcode === otp) {

            const regData = {name : name,

                            email : email,

                            mobile : mobile,

                            city : city,

                            address : address,

                            pin_code : pin_code,

                            status : 1,

                            user_type   : role,
                            domain_id   : domain_id,
                            emp_profile  : emp_profile,
                            joining_date  : joining_date,
                            description  : description,
                            profile_photo  : profile_photo,

                            job_title : job_title,
                            emergency_number : emergency_number,
                            work_schedule :work_schedule ,
                            annual_salary :annual_salary ,
                            min_retainership_amount :min_retainership_amount ,
                            max_retainership_amount :max_retainership_amount ,
                            proposed_start_date :proposed_start_date ,
                            reporting_to :reporting_to ,

                

                            };

        

            $.ajax({

                    type: 'post',

                    <?php if (isset($_GET['type']) && isset($_GET['role'])) {?>
                        url: "<?php echo base_url('/admin/create-member-share?type='.$_GET['type'].'&role='.$_GET['role']);?>",
                    <?php }else{?>
                            url: "<?php echo base_url('/admin/create-member');?>",
                    <?php }?>

                    data: regData,

                    success: function (response) {

                        const obj = JSON.parse(response);

                        

                        if(obj.status == "true") {

                            if(role == "user") {

                                <?php if (isset($_GET['type']) && isset($_GET['role'])) {?>
                                    window.location.href = "<?php echo base_url('/');?>"; 
                                    <?php }else{?>
                                        window.location.href = "<?php echo base_url('/admin/my-team');?>"; 
                                <?php }?>

                            }

                            else {
                                <?php if (isset($_GET['type']) && isset($_GET['role'])) {?>
                                    window.location.href = "<?php echo base_url('/');?>"; 
                                    <?php }else{?>
                                        window.location.href = "<?php echo base_url('/admin/my-team');?>"; 
                                <?php }?>

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

   