 <section class="profile-content">

            <div class="profile-bio card form-card">
                <section class="fullscreen p-t-40">
                    
                <!------------------------ User OTP screen  Starts ------------------------->
                    <div class="container m-0 p-10" id="second" style="display: flex;flex-direction: row;justify-content: center;">
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
                            	<input type="hidden" name="city" id="city" value="<?php echo $city; ?>">
                            	<input type="hidden" name="address" id="address" value="<?php echo $address; ?>">
                            	<input type="hidden" name="pin_code" id="pin_code" value="<?php echo $pin_code; ?>">
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
        
        if(otpcode === otp) {
            const regData = {name : name,
                            email : email,
                            mobile : mobile,
                            city : city,
                            address : address,
                            pin_code : pin_code,
                            status : 1,
                            user_type   : role
                
                            };
        
            $.ajax({
                    type: 'post',
                    url: "<?php echo base_url('/admin/create-network-member');?>",
                    data: regData,
                    success: function (response) {
                        const obj = JSON.parse(response);
                        
                        if(obj.status == "true") {
                            if(role == "user") {
                                window.location.href = "<?php echo base_url('/admin/network-member-plan');?>"; 
                            }
                            else {
                                window.location.href = "<?php echo base_url('/admin/network-member-plan');?>"; 
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
   