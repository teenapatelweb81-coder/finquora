<!--====================header close=============================-->

<!--=================slider============================================-->
<div id="slider" class="inspiro-slider slider-fullscreen dots-creative flickity-enabled" data-height-xs="360"
    data-autoplay="8000" data-items="1" data-loop="true">
    <div class="slide background-columbia-blue" style="background-color:<?php echo isset($dsaBanner['background_color']) && !empty($dsaBanner['background_color']) ? htmlspecialchars($dsaBanner['background_color']) : '#e6f0fa'; ?> !important">
        <div class="container">
            <div class="slide-captions row">
                <div class="col-lg-6 col-md-6 col-12 align-self-center fadeInUp">
                    <h1 class="text-medium"><?php echo isset($dsaBanner['title']) && !empty($dsaBanner['title']) ? htmlspecialchars($dsaBanner['title']) : 'Join Our DSA Program Today'; ?></h1>
                    <p><?php echo isset($dsaBanner['text']) && !empty($dsaBanner['text']) ? htmlspecialchars($dsaBanner['text']) : 'Earn high commissions by sharing your unique referral link with your network.'; ?></p>
                    <a href="<?php echo base_url('/agent'); ?>" class="btn btn-outline btn-rounded btn-reveal btn-reveal-right">
                        <span>Apply Now</span><i class="fa fa-arrow-right"></i>
                    </a>
                </div>
                <div class="col-lg-6 col-md-6 col-12 fadeInUp">
                    <img src="<?php echo isset($dsaBanner['image']) && !empty($dsaBanner['image']) ? base_url('beta/assets/images/dsaBanner/' . htmlspecialchars($dsaBanner['image'])) : base_url('beta/assets/images/dsaBanner/default-banner.jpg'); ?>" alt="premium membership" class="img-fluid" />
                </div>
            </div>
        </div>
    </div>
</div>
<!--=================slider close============================================-->

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-12 text-center">
                <div class="text-center p-b-20">
                    <h2><?php echo isset($dsaSection1['heading']) && !empty($dsaSection1['heading']) ? htmlspecialchars($dsaSection1['heading']) : 'Not found'; ?></h2>
                    <p><?php echo isset($dsaSection1['text']) && !empty($dsaSection1['text']) ? htmlspecialchars($dsaSection1['text']) : 'Not found.'; ?></p>
                </div>
                <p><?php echo isset($dsaSection1['description']) && !empty($dsaSection1['description']) ? strip_tags($dsaSection1['description']) : 'Not found.'; ?></p>
                <a href="<?php echo base_url('/agent'); ?>" class="btn btn-outline btn-rounded btn-reveal btn-reveal-right">
                    <span>Register Now</span><i class="fa fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<section class="background-grey">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-12 text-justify">
                <div class="text-left">
                    <h2><?php echo isset($dsaSection2['heading_1']) && !empty($dsaSection2['heading_1']) ? htmlspecialchars($dsaSection2['heading_1']) : 'Not found'; ?></h2>
                </div>
                <p><?php echo isset($dsaSection2['description_1']) && !empty($dsaSection2['description_1']) ? strip_tags($dsaSection2['description_1']) : 'Not found'; ?></p>
            </div>
            <div class="col-lg-6 col-md-6 col-12 text-justify">
                <div class="text-left">
                    <h2><?php echo isset($dsaSection2['heading_2']) && !empty($dsaSection2['heading_2']) ? htmlspecialchars($dsaSection2['heading_2']) : 'Not found'; ?></h2>
                    <p>Only a few small stages to cross and you're there!</p>
                </div>
                <p><?php echo isset($dsaSection2['description_2']) && !empty($dsaSection2['description_2']) ? strip_tags($dsaSection2['description_2']) : 'Not found.'; ?></p>
                <!-- <ol>
                    <li>Quick registration</li>
                    <li>Submit application form</li>
                    <li>Start business</li>
                </ol> -->
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="text-center m-b-50">
            <h2><?php echo isset($dsaSection3['heading']) && !empty($dsaSection3['heading']) ? htmlspecialchars($dsaSection3['heading']) : 'Why Choose Our DSA Program?'; ?></h2>
            <p><?php echo isset($dsaSection3['text']) && !empty($dsaSection3['text']) ? htmlspecialchars($dsaSection3['text']) : 'Discover the benefits that make this opportunity unmissable.'; ?></p>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-12 text-justify">
                <p><?php echo isset($dsaSection3['description']) && !empty($dsaSection3['description']) ? strip_tags($dsaSection3['description']) : 'Not found'; ?></p>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
                <ul class="list-group">
                    <li class="list-group-item"><i class="fa fa-long-arrow-alt-right m-r-5"></i> <?php echo isset($dsaSection3['benefit_1']) && !empty($dsaSection3['benefit_1']) ? htmlspecialchars($dsaSection3['benefit_1']) : 'Not found'; ?></li>
                    <li class="list-group-item"><i class="fa fa-long-arrow-alt-right m-r-5"></i> <?php echo isset($dsaSection3['benefit_2']) && !empty($dsaSection3['benefit_2']) ? htmlspecialchars($dsaSection3['benefit_2']) : 'Not found'; ?></li>
                    <li class="list-group-item"><i class="fa fa-long-arrow-alt-right m-r-5"></i> <?php echo isset($dsaSection3['benefit_3']) && !empty($dsaSection3['benefit_3']) ? htmlspecialchars($dsaSection3['benefit_3']) : 'Not found'; ?></li>
                    <li class="list-group-item"><i class="fa fa-long-arrow-alt-right m-r-5"></i> <?php echo isset($dsaSection3['benefit_4']) && !empty($dsaSection3['benefit_4']) ? htmlspecialchars($dsaSection3['benefit_4']) : 'Not found'; ?></li>
                </ul>
            </div>
        </div>
    </div>
</section>