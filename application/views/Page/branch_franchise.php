

<section class="profile-content">

    <div class="profile-image background-ash">
                <div class="profile-name p-40">
                    <?php if (!empty($branchAgentDetail['leftheading'])): ?>
                        <h2><?= $branchAgentDetail['leftheading']; ?></h2>
                    <?php else: ?>
                            <p>No heading found</p>
                        <?php endif; ?>

                    <?php if (!empty($branchAgentDetail['description'])): ?>
                        <ul class="list-icon list-icon-check list-icon-colored p-t-20">
                            <?= $branchAgentDetail['description']; ?>
                        </ul>
                    <?php else: ?>
                            <p>No heading found</p>
                        <?php endif; ?>
                    
                    <div class="line"></div>

                    <h4>Our Lending NBFC Partners</h4>

                    <div class="carousel client-logos flickity-enabled is-draggable carousel-loaded"
                        data-items="<?= isset($branchAgentDetail['image']) && !empty($branchAgentDetail['image']) ? count((array) json_decode($branchAgentDetail['image'], true)) : 0 ?>"
                        data-dots="false" data-arrows="false">
                        <?php if (isset($branchAgentDetail['image']) && !empty($branchAgentDetail['image'])): ?>
                            <?php 
                                $images = json_decode($branchAgentDetail['image'], true); 
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

                    <?php if (!empty($branchAgentDetail['rightheading'])): ?>
                        <h4><?= $branchAgentDetail['rightheading']; ?></h4>
                    <?php else: ?>
                            <p>No heading found</p>
                        <?php endif; ?>

                    <p class="p-b-20">Start off the process with just a few details</p>

                    <?php if( $this->session->flashdata('message') ) {?>

                          <span class="text-center text-danger mb-3"> <?php  echo $this->session->flashdata('message') ; ?></span>

                          <?php }?>

                    

                    <?php echo form_open('/sendotp_franchise');?>

                                <input type="hidden" name="loantype" value="2">

                                <input type="hidden" name="user_type" value="agent">



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

                                                    Policy</a> of <?php echo base_url('/'); ?></small></label>

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

                        <a href="#" class="btn btn-outline btn-sm text-uppercase">Login</a>

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
                <?php if (!empty($branchAgentDetail['leftdescription'])): ?>
                        <h4><?= $branchAgentDetail['leftdescription']; ?></h4>
                    <?php else: ?>
                <p>No heading found</p>
            <?php endif; ?>
            </div>

            <div class="col-md-6 col-12">
                 <?php if (!empty($branchAgentDetail['rightdescription'])): ?>
                        <h4><?= $branchAgentDetail['rightdescription']; ?></h4>
                    <?php else: ?>
                <p>No heading found</p>
            <?php endif; ?>
            </div>
        </div>
    </div>

</section>



        