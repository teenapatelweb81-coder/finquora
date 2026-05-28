 <section class="profile-content">
            <div class="profile-image background-ash">
                <div class="profile-name p-40">
                    <?php if (!empty($dsaagentdetail['leftheading'])): ?>
                        <h2><?= $dsaagentdetail['leftheading']; ?></h2>
                    <?php else: ?>
                            <p>No heading found</p>
                        <?php endif; ?>

                    <?php if (!empty($dsaagentdetail['description'])): ?>
                        <ul class="list-icon list-icon-check list-icon-colored p-t-20">
                            <?= $dsaagentdetail['description']; ?>
                        </ul>
                    <?php else: ?>
                            <p>No heading found</p>
                        <?php endif; ?>
                    
                    <div class="line"></div>

                    <h4>Our Lending NBFC Partners</h4>

                    <div class="carousel client-logos flickity-enabled is-draggable carousel-loaded"
                        data-items="<?= isset($dsaagentdetail['image']) && !empty($dsaagentdetail['image']) ? count((array) json_decode($dsaagentdetail['image'], true)) : 0 ?>"
                        data-dots="false" data-arrows="false">
                        <?php if (isset($dsaagentdetail['image']) && !empty($dsaagentdetail['image'])): ?>
                            <?php 
                                $images = json_decode($dsaagentdetail['image'], true); 
                                if (is_array($images) && count($images) > 0):
                                    foreach ($images as $img): 
                                        if (!empty($img)):
                            ?>
                                <img class="mt-2" src="<?= base_url('beta/'.$img) ?>" alt="Partner Logo" style="width:160px; height:70px">
                            <?php 
                                        endif;
                                    endforeach; 
                                endif;
                            ?>
                        <?php else: ?>
                            <p>No heading found</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="profile-bio">
                <section class="fullscreen p-t-40">
                    <div class="container m-0 p-10">	
                    <div class="text-middle">
                        <?php if (!empty($dsaagentdetail['rightheading'])): ?>
                        <h4><?= $dsaagentdetail['rightheading']; ?></h4>
                    <?php else: ?>
                            <p>No heading found</p>
                        <?php endif; ?>
            		<h5 class="p-b-10">Select Your Profile &amp; Enter Details.</h5>
            
            		<!--<form action="https://nowofloan.com/digital/registeredUser" id="submitForm3" class="col-md-12 col-sm-12 p-0" novalidate="novalidate" method="post" accept-charset="utf-8">-->
            		 <?php echo form_open('/agentOffer');?>
            			<div class="form-group">
            				<label class="text-dark" for="username">Full name : <strong><?php echo $name;?> </strong></label>
            
            				<!--<input type="hidden" name="username" id="username" value="testing">-->
            				<input type="hidden" name="referralcode" id="referralcode" value="">
            				<input type="hidden" name="fbclid" id="fbclid" value="">
            				<input type="hidden" name="loantype" id="loantype" value="1">
            			</div>
            
            			<div class="form-group">
            				<label class="text-dark" for="usermobile">Mobile No. : <strong><?php echo $mobile;?></strong></label>
            				<input type="hidden" name="usermobile" id="usermobile" value="<?php echo $mobile;?>">
            			</div>
            
            			<!--<div class="form-group btn-group-toggle validate" data-toggle="buttons">-->
            			<!--	<div class="btn-group">-->
            			<!--		<label class="btn btn-light active">-->
            			<!--			<input type="radio" name="usertype" value="0" autocomplete="off" checked="" aria-invalid="false"><i class="icon-briefcase"></i> Salaried Person-->
            			<!--		</label>-->
            			<!--		<label class="btn btn-light">-->
            			<!--			<input type="radio" name="usertype" value="1" autocomplete="off" aria-invalid="false"><i class="icon-flag"></i> Self Employed Person-->
            			<!--		</label>-->
            			<!--	</div>-->
            			<!--</div>-->
            
            			<div class="form-group">
            				<label class="text-dark" for="useremail">Email id</label>
            				<input type="email" aria-required="true" name="useremail" value="<?php echo $email;?>" readonly class="form-control" placeholder="As per your bank records" required>
            				<div class="help-block font-small-3"></div>
            			</div>
            			
            			<div class="form-group">
            				<label class="text-dark" for="city">City*</label>
            				<input type="text" aria-required="true" name="city"  class="form-control" placeholder="City" required>
            				<div class="help-block font-small-3"></div>
            			</div>
            			
            			<div class="form-group">
            				<label class="text-dark" for="address">Address*</label>
            				<input type="text" aria-required="true" name="address"  class="form-control" placeholder="Address" required>
            				<div class="help-block font-small-3"></div>
            			</div>
            			
            			<div class="form-group">
            				<label class="text-dark" for="pin_code">Pin code*</label>
            				<input type="text" aria-required="true" name="pin_code"  class="form-control" placeholder="Pin code" min="100000" inputmode="numeric" data-validation-regex-regex="[0-9]+" aria-invalid="false" required>
            				<div class="help-block font-small-3"></div>
            			</div>
            	
            			<div class="form-group m-b-0">
            			   
            			    <input type="submit" id="form-submit3" name="submit" value="Process" class="btn btn-block btn-primary"/>
            				<!--<button type="submit" id="form-submit3" class="btn btn-block btn-primary">PROCESS</button>-->
            			</div>
            		<?php echo form_close();?>
            	    </div>
            	
            	<div class="line m-20"></div>
            
            	<div class="text-center">
            		<p class="text-theme">Already have an account? 
            		<a href="https://nowofloan.com/customer/login" class="btn btn-outline btn-sm text-uppercase">Login</a>
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
                <?php if (!empty($dsaagentdetail['leftdescription'])): ?>
                        <h4><?= $dsaagentdetail['leftdescription']; ?></h4>
                    <?php else: ?>
                <p>No heading found</p>
            <?php endif; ?>
            </div>

            <div class="col-md-6 col-12">
                 <?php if (!empty($dsaagentdetail['rightdescription'])): ?>
                        <h4><?= $dsaagentdetail['rightdescription']; ?></h4>
                    <?php else: ?>
                <p>No heading found</p>
            <?php endif; ?>
            </div>
        </div>
    </div>
        </section>
