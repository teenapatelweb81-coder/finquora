 <?php $silver = $this->db->where('domain_id', domain_id_get())->get('silver_section_1')->row_array();
  ?>
<style>
    .credit-card {
        margin: 0 auto;
    }
    .cardss {
        padding: 20px;
        position: relative;
    }
    .card img {
        height: 19%;
        border-radius: 25px;
    }

.com_icon {
    background: url('<?php echo isset($cardColor['image']) && !empty($cardColor['image']) ? base_url('beta/assets/images/plantinumBanner/') . $cardColor['image'] : base_url('beta/assets/images/plantinumBanner/default.jpg'); ?>');
}

    .com_icon, .com_icon1 {
        color: <?php echo !empty($cardColor['card_text_color']) ? $cardColor['card_text_color'] : '#ffffffba'; ?>;
        padding: 20px;
        background-size: cover;
        width: 100%;
        border-radius: 6px;
        top: 0px;
        left: 0;
    }
    .com_icon2 {
        color: <?php echo !empty($cardColor['details_text_color']) ? $cardColor['details_text_color'] : '#ffffffba'; ?>;
        font-size: 12px !important;
    }
    .credit-card {
        margin: 0 auto;
        width: 400px;
    }
    @media (max-width: 500px) {
        .credit-card {
            width: 100%;
        }
    }
</style>

<!--=================slider============================================-->
<div id="slider" class="inspiro-slider slider-fullscreen dots-creative flickity-enabled" data-height-xs="360" data-autoplay="8000" data-items="1" data-loop="true">
    <div class="slide background-eggshell" style="background: <?php echo !empty($silverBanner['background_color']) ? $silverBanner['background_color'] : '#f8f1e9'; ?> !important;">
        <div class="container">
            <div class="slide-captions row">
                <div class="col-lg-6 col-md-6 col-12 align-self-center fadeInUp">
                    <h1 class="text-medium"><?php echo !empty($silverBanner['title']) ? $silverBanner['title'] : 'Your Future Depends on Financial Decisions Taken Today!'; ?></h1>
                    <h4><?php echo !empty($silverBanner['subtitle']) ? $silverBanner['subtitle'] : 'The Best Way To Access Your Personal Financial Consultation & Services'; ?></h4>
                    <p><?php echo !empty($silverBanner['text']) ? $silverBanner['text'] : 'Get Premium Membership & Leverage Our Partnership With Leading NBFCs'; ?></p>
                </div>
                <div class="col-lg-6 col-md-6 col-12 fadeInUp">
                    <?php if (!empty($silverBanner['image'])) { ?>
                        <img src="<?php echo base_url('beta/assets/images/silverBanner/' . $silverBanner['image']); ?>" alt="premium membership" class="img-fluid" />
                    <?php } else { ?>
                        <img src="<?php echo base_url('upload/assets/images/model-11.png'); ?>" alt="premium membership" class="img-fluid" />
                    <?php } ?>
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
                    <h2><?php echo !empty($silver_section_1['heading']) ? $silver_section_1['heading'] : 'Premium Membership – Expedite Your Finances'; ?></h2>
                    <p><?php echo !empty($silver_section_1['text']) ? $silver_section_1['text'] : 'A comprehensive approach to upscale your financial aspects'; ?></p>
                </div>
                <p><?php echo !empty($silver_section_1['description']) ? $silver_section_1['description'] : 'Unlock exclusive financial tools and services with your membership.'; ?></p>
                <h3>Rs. <del class="text-danger"><?php echo !empty($silver_section_1['previous_price']) ? $silver_section_1['previous_price'] : '2999.00'; ?></del> <span class="text-success"><?php echo !empty($amount) ? $amount : '1999.00'; ?></span> only</h3>
                <a href="<?php echo base_url('/personalLoan'); ?>" class="btn btn-outline btn-rounded btn-reveal btn-reveal-right"><span>Buy Now</span><i class="fa fa-arrow-right"></i></a>
                <div class="credit-card">
                    <div class="card">
                        <div class="com_icon">
                            <div style="font-size: 22px; font-weight: 600;"><?php echo !empty($silver_section_1['card_name']) ? $silver_section_1['card_name'] : 'Silver'; ?></div>
                            <div class="imgdiv">
                                <img src="<?php echo !empty($contect_us['logo']) ? base_url('beta/assets/images/logo/' . $contect_us['logo']) : base_url('upload/assets/logo.png'); ?>" alt="card logo" width="200px">
                            </div>
                            <div style="height: 15px;"></div>
                            <div class="num">
                                <h2 style="font-size: 31px; margin: 0px 0px 0px 10px;" class="com_icon2"><?php echo !empty($silver_section_1['card_no']) ? $silver_section_1['card_no'] : '0000 0000 0000 1354'; ?></h2>
                                <p style="font-weight: 600; margin: 5px 10px; font-size: 15px;" class="com_icon2">VALIDITY <?php echo !empty($silver_section_1['validity']) ? $silver_section_1['validity'] : '2 Year'; ?></p>
                                <h4 style="margin: 11px 10px;" class="com_icon2"><?php echo !empty($silver_section_1['name']) ? $silver_section_1['name'] : 'Cardholder Name'; ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="background-grey">
    <div class="container">
        <div class="text-center p-b-20">
            <h2><?php echo !empty($silver_section_2['heading']) ? $silver_section_2['heading'] : 'Easily Apply for Personal Loan in Our Partnered NBFCs with Premium Membership!'; ?></h2>
            <p><?php echo !empty($silver_section_2['text']) ? $silver_section_2['text'] : 'Leverage the fantastic perks of the membership & fulfil your aspirations!'; ?></p>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-12 text-justify">
                <p><?php echo !empty($silver_section_2['description_1']) ? $silver_section_2['description_1'] : 'Upon purchasing the Premium Membership, you can submit your documents that will be attached to your profile and shared with Our Partnered NBFCs. They will check your profile and verify whether your loan application meets their eligibility requirements for loan approval or not.'; ?></p>
            </div>
            <div class="col-lg-6 col-md-6 col-12 text-justify">
                <p><?php echo !empty($silver_section_2['description_2']) ? $silver_section_2['description_2'] : 'With our service, your profile is shared only with compatible banks, helping maintain your CIBIL score even if you are not eligible for a loan.'; ?></p>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="text-center p-b-20">
            <h2><?php echo !empty($silverBanner['four_title']) ? $silverBanner['four_title'] : 'Highly-Appealing Perks of Premium Membership'; ?></h2>
            <p><?php echo !empty($silverBanner['four_sub_title']) ? $silverBanner['four_sub_title'] : 'Offering a whole new experience and dimension of services'; ?></p>
        </div>
        <div class="row">
            <?php 
            $default_sections_3 = [
                ['title' => 'Exclusive Access', 'description' => 'Get priority access to premium financial tools.'],
                ['title' => 'Personalized Support', 'description' => 'Receive dedicated support from our financial experts.'],
                ['title' => 'Fast-Track Approvals', 'description' => 'Speed up your loan approval process with our partners.']
            ];
            $sections_3 = !empty($silver_sections_3) && is_array($silver_sections_3) ? $silver_sections_3 : $default_sections_3;
            foreach ($sections_3 as $value) { ?>
                <div class="col-lg-4 col-md-4">
                    <div class="icon-box effect small border">
                        <div class="icon"><a href="#"><i class="fa fa-briefcase" aria-hidden="true"></i></a></div>
                        <h3><?php echo !empty($value['title']) ? $value['title'] : 'Feature Title'; ?></h3>
                        <p><?php echo !empty($value['description']) ? $value['description'] : 'Feature description goes here.'; ?></p>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="row">
            <div class="col-md-12 col-12 text-center m-t-20">
                <a href="#" class="btn btn-primary btn-sm">Know Detailed Benefits</a>
            </div>
        </div>
    </div>
</section>

<section class="background-grey">
    <div class="container">
        <div class="text-center p-b-20">
            <h2><?php echo !empty($silverBanner['five_tilte']) ? $silverBanner['five_tilte'] : 'How it works?'; ?></h2>
            <p><?php echo !empty($silverBanner['five_sub_title']) ? $silverBanner['five_sub_title'] : 'We\'ve set out a stream of all the imperative stages for You!'; ?></p>
        </div>
        <div class="row">
            <div class="col-md-12 col-12">
                <div class="tabs tabs-vertical">
                    <div class="row">
                        <div class="col-md-4">
                            <ul class="nav flex-column nav-tabs" id="myTab4" role="tablist" aria-orientation="vertical">
                                <?php 
                                $default_sections_4 = [
                                    ['title' => 'Step 1: Sign Up', 'description' => '<li>Register for Premium Membership.</li>'],
                                    ['title' => 'Step 2: Submit Documents', 'description' => '<li>Upload your documents securely.</li>'],
                                    ['title' => 'Step 3: Get Approved', 'description' => '<li>Receive approval from our partnered NBFCs.</li>']
                                ];
                                $sections_4 = !empty($silver_sections_4) && is_array($silver_sections_4) ? $silver_sections_4 : $default_sections_4;
                                foreach ($sections_4 as $key => $value) { ?>
                                    <li class="nav-item">
                                        <a class="nav-link <?php echo $key == 0 ? 'active' : ''; ?>" id="point<?php echo $key + 1; ?>-tab" data-toggle="tab" href="#point<?php echo $key + 1; ?>" role="tab" aria-controls="point<?php echo $key + 1; ?>" aria-selected="<?php echo $key == 0 ? 'true' : 'false'; ?>">
                                            <span class="badge badge-dark"><?php echo $key + 1; ?></span> <?php echo !empty($value['title']) ? $value['title'] : 'Step Title'; ?>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                        <div class="col-md-8">
                            <div class="tab-content p-t-40" id="myTabContent4">
                                <?php foreach ($sections_4 as $key => $value) { ?>
                                    <div class="tab-pane fade show <?php echo $key == 0 ? 'active' : ''; ?>" id="point<?php echo $key + 1; ?>" role="tabpanel" aria-labelledby="point<?php echo $key + 1; ?>-tab">
                                        <ul class="list-icon list-icon-check">
                                            <?php echo !empty($value['description']) ? $value['description'] : '<li>Step description goes here.</li>'; ?>
                                        </ul>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row m-t-50">
            <div class="col-md-12 col-12">
                <p><strong>Disclaimer:</strong> <?php echo !empty($silverBanner['Disclaimer']) ? $silverBanner['Disclaimer'] : 'Terms and conditions apply. Please review our policies before proceeding.'; ?></p>
            </div>
        </div>
    </div>
</section>