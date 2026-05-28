 <?php
  $platinum = $this->db->where('domain_id', domain_id_get())->get('plantinum_section_1')->row_array();
  $card_color = $this->db->where('domain_id', domain_id_get())->get('card_color')->row_array();
//   print_r($card_color);die;
  ?>
<style>
    .credit-card {
    margin: 0 auto;
}

.cardss {
    padding:20px;
    position: relative;
}
.card img{
    height: 19%;
    border-radius: 25px;
}
.com_icon,.com_icon1{
    background:  url('<?php echo isset($card_color['image']) && !empty($card_color['image']) ? base_url('beta/assets/images/plantinumBanner/') . $card_color['image'] : base_url('assets/images/plantinumBanner/default.jpg'); ?>');
    color: <?php echo $cardColor['card_text_color'] ?>;
    padding: 20px;
    background-size: cover;
    width: 100%;
    border-radius: 6px;
    top:0px;
    left: 0;
}
.com_icon2{
   /* color:#ffffffba; */
   color: <?php echo $cardColor['details_text_color'] ?>;
    font-size: 12px !important;
}
.credit-card {
    margin: 0 auto;
    width: 400px;
}

@media (max-width: 500px){
.credit-card {
        width: 100%;
    }
}
   </style>

   <?php
$cardColor = $cardColor ?? [
    'background_color' => "url('upload/assets/images/card.jpg')",
    'card_text_color' => '#ffffffba',
    'details_text_color' => '#ffffffba',
];

$plantinumBanner = $plantinumBanner ?? [
    'background_color' => '#f4f4f4',
    'title' => 'No Title Available',
    'subtitle' => 'No Subtitle Available',
    'text' => 'No Text Available',
    'image' => '', // or a placeholder like 'default.png'
];

$plantinum_section_1 = $plantinum_section_1 ?? [
    'heading' => 'Platinum Membership – Let Your Business Excel',
    'text' => 'A great first step for your business finance.',
    'description' => 'Default platinum section description.',
    'previous_price' => '3999.00',
    'card_name' => 'Platinum',
    'card_no' => '0000 0000 0000 0000',
    'validity' => '2 Year',
    'name' => 'Card Holder'
];

$plantinum_section_2 = $plantinum_section_2 ?? [
    'heading' => 'Apply for Business Loan',
    'text' => 'Advantages of our collaboration',
    'description_1' => 'Default description 1.',
    'description_2' => 'Default description 2.'
];

$plantinum_section_3 = $plantinum_section_3 ?? [
    'heading' => 'Futuristic Benefits',
    'heading_text' => 'Services aiming for great customer experiences'
];

$plantinum_sections_3 = $plantinum_sections_3 ?? [
    [
        'title' => 'Default Benefit 1',
        'description' => 'This is a default description for benefit 1.'
    ],
    [
        'title' => 'Default Benefit 2',
        'description' => 'This is a default description for benefit 2.'
    ]
];

$plantinum_section_4 = $plantinum_section_4 ?? [
    'heading' => 'How it works?',
    'heading_text' => 'We’ve set out all the steps for you!',
    'disclaimer' => 'Membership does not guarantee loan approval.'
];

$plantinum_sections_4 = $plantinum_sections_4 ?? [
    [
        'title' => 'Step 1',
        'description' => '<li>Register on the website.</li><li>Enter your details.</li>'
    ],
    [
        'title' => 'Step 2',
        'description' => '<li>Submit documents.</li><li>Wait for approval.</li>'
    ]
];

$contect_us = $contect_us ?? ['logo' => 'default-logo.png'];
$amount = $amount ?? '999.00';
?>



<!--=================slider============================================-->
        <div id="slider" class="inspiro-slider slider-fullscreen dots-creative flickity-enabled" data-height-xs="360"
            data-autoplay="8000" data-items="1" data-loop="true">
            <div class="slide background-corn-blue" style="background: <?php echo $plantinumBanner['background_color'] ?>!important;">
                <div class="container">
                    <div class="slide-captions row">
                        <div class="col-lg-6 col-md-6 col-12 align-self-center fadeInUp">
                            <!-- <h1 class="text-medium">Highly Result-Driven Business Financial Consultation</h1> -->
                            <h1 class="text-medium"><?php echo !empty($plantinumBanner['title']) ? $plantinumBanner['title'] : 'No Title Available'; ?></h1>

                            <!-- <h4>Boost Your Business & Grow In A Strategic Manner</h4> -->
                            <h4><?php echo !empty($plantinumBanner['subtitle']) ? $plantinumBanner['subtitle'] : 'No Subtitle Available'; ?></h4>

                            <!-- <p>Get Platinum Membership & Utilize Our Collaborations with Partnered NBFCs</p> -->
                            <p><?php echo !empty($plantinumBanner['text']) ? $plantinumBanner['text'] : 'No Text Available'; ?></p>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12 fadeInUp">
                            <!-- <img src="<?= base_url('upload/assets') ?>/images/model-10.png" alt="premium membership" class="img-fluid" /> -->
                            <?php if(!empty($plantinumBanner['image'])) { ?>
                                <img src="<?php echo base_url('beta/assets/images/plantinumBanner/'.$plantinumBanner['image']); ?>" alt="premium membership" class="img-fluid" />
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
                            <!-- <h2>Platinum Membership – Let Your Business Excel</h2> -->
                            <h2><?php echo $plantinum_section_1['heading']; ?></h2>

                            <!-- <p>A great first step for your business finance to mount high</p> -->
                            <p><?php echo $plantinum_section_1['text']; ?></p>
                        </div>

                        <!-- <p>Whensss it comes to giving your business the best financial direction, our industry experts never leave a stone unturned! Along with Platinum Membership, you leverage the actionable financial consultation and services for a
                             period of 1 year and you can apply for an Instant Business Loan in Our Partnered NBFCs.</p> -->
                             <p><?php echo $plantinum_section_1['description']; ?></p>

                        <!-- <h3>Rs. <del class="text-danger">3999.00</del> <span class="text-success"><?php echo $amount;?></span> only
                        </h3> -->
                        <h3>Rs. <del class="text-danger"><?php echo $plantinum_section_1['previous_price']; ?></del> <span class="text-success"><?php echo $amount;?></span> only

                        </h3>

                        <a href="<?php echo base_url('/personalLoan');?>" class="btn btn-outline btn-rounded btn-reveal btn-reveal-right"><span>Buy
                                Now</span><i class="fa fa-arrow-right"></i></a>
                                <div class="credit-card">

                                <div class="card"> 
                                    <div class="com_icon">
                                        <!-- <div class=""style="font-size: 22px;font-weight: 600;" >Plantinum</div> -->
                                        <div class=""style="font-size: 22px;font-weight: 600;" ><?php echo $plantinum_section_1['card_name']; ?></div>
                                
                                      <div class="imgdiv">
                                        <!-- <img src="<?= base_url('upload/assets/logo.png')?>" alt="000" srcset="" width="200px"> -->
                                        <img src="<?= base_url("beta/assets/images/logo/") . $contect_us['logo']?>" alt="000" srcset="" width="200px">
                                      </div>
                                        <div class="div" style="height: 15px;">
                                        </div>
                                        <div class="num">
                                            <!-- <h2 style=" font-size: 31px;margin: 0px 0px 0px 10px;"class="com_icon2">0000 0000 0000 1354</h2> -->
                                            <h2 style=" font-size: 31px;margin: 0px 0px 0px 10px;"class="com_icon2"><?php echo $plantinum_section_1['card_no']; ?></h2>
                                            <!-- <p style="font-weight: 600; margin: 5px 10px; font-size:15px; "class="com_icon2">VALIDITY 2 Year</p> -->
                                            <p style="font-weight: 600; margin: 5px 10px; font-size:15px; "class="com_icon2">VALIDITY <?php echo $plantinum_section_1['validity']; ?></p>
                                              <!-- <h4 style="margin: 11px 10px; "class="com_icon2">NAME</h4> -->
                                              <h4 style="margin: 11px 10px; "class="com_icon2"><?php echo $plantinum_section_1['name']; ?></h4>
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
                    <!-- <h2>Apply for Business Loan in Our Partnered NBFCs with Platinum Membership!</h2> -->
                    <h2><?php echo $plantinum_section_2['heading']; ?></h2>

                    <!-- <p>Access a plethora of advantages of our collaboration with leading NBFCs</p> -->
                    <p><?php echo $plantinum_section_2['text']; ?></p>
                </div>
        
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-12 text-justify">
                        <!-- <p>With our Platinum Membership, you can make the most of our partnership with leading NBFCs. Your documents that have been submitted to us will be further submitted to those NBFC partners whose criteria may match your profile and requirements. Once the eligibility check is done, we will provide you with the list of NBFCs that have approved your loan application. This is entirely an online process that will help save your precious time.</p> -->
                        <p><?php echo $plantinum_section_2['description_1']; ?></p>
                    </div>
        
                    <div class="col-lg-6 col-md-6 col-12 text-justify">
                        <!-- <p>This is the most optimized way of functioning as visiting multiple banks personally and making several iterations of document submission is an extremely time-consuming procedure. Looking at the fast-paced nature of your routine, there is no time to go to multiple banks for loan processing; therefore, we offer the facilities and services under a single portal.</p> -->
                        <p><?php echo $plantinum_section_2['description_2']; ?></p>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="container">
                <div class="text-center p-b-20">
                    <!-- <h2>Futuristic Benefits of Platinum Membership</h2> -->
                    <h2><?php echo $plantinum_section_3['heading']; ?></h2>

                    <!-- <p>All-encompassing services aiming for great customer experiences</p> -->
                    <p><?php echo $plantinum_section_3['heading_text']; ?></p>
                </div>
        
                <div class="row">
                <?php foreach($plantinum_sections_3 as $value){ ?>
                <div class="col-lg-4 col-md-4">

                        <div class="icon-box effect small border">

                            <div class="icon"><a href="#"><i class="fa fa-briefcase" aria-hidden="true"></i></a></div>

                            <h3><?php echo $value['title']; ?></h3>

                            <p><?php echo $value['description']; ?></p>

                        </div>

                    </div>
                   <?php } ?> 
<!-- 
                    <div class="col-lg-4 col-md-4">
                        <div class="icon-box effect small border">
                            <div class="icon"><a href="#"><i class="fa fa-briefcase" aria-hidden="true"></i></a></div>
                            <h3>Apply for Loan in Our Partnered NBFCs</h3>
                            <p>As we've tie-ups with some of the leading NBFCs, we provide our customers with an efficient online portal to apply for a loan in our partnered NBFCs.</p>
                        </div>
                    </div>
        
                    <div class="col-lg-4 col-md-4">
                        <div class="icon-box effect small border">
                            <div class="icon"><a href="#"><i class="fa fa-television" aria-hidden="true"></i></a></div>
                            <h3>100% Online Financial Consultation Process</h3>
                            <p>Get financial consultation from industry-leading experts with a completely digital process – no hassles at all.</p>
                        </div>
                    </div>
        
                    <div class="col-lg-4 col-md-4">
                        <div class="icon-box effect small border">
                            <div class="icon"><a href="#"><i class="fa fa-th-large" aria-hidden="true"></i></a></div>
                            <h3>Access Personalized Tracking Portal</h3>
                            <p>You can keep a good track of your details and notifications easily while sitting at your home and getting timely updates.</p>
                        </div>
                    </div>
        
                    <div class="col-lg-4 col-md-4">
                        <div class="icon-box effect small border">
                            <div class="icon"><a href="#"><i class="fa fa-headphones" aria-hidden="true"></i></a></div>
                            <h3>1 Year Free On-Call Expert Consultancy</h3>
                            <p>We'll help you out in improving your financial aspects and suggest the best steps for upscaling your financial potential through on-call assistance.</p>
                        </div>
                    </div>
        
                    <div class="col-lg-4 col-md-4">
                        <div class="icon-box effect small border">
                            <div class="icon"><a href="#"><i class="fa fa-calendar-o" aria-hidden="true"></i></a></div>
                            <h3>Apply For Loan Every 6 Months for Free</h3>
                            <p>We provide a great facility to our customers through which they can apply for a loan in Our Partnered NBFCs every 6 months.</p>
                        </div>
                    </div>
        
                    <div class="col-lg-4 col-md-4">
                        <div class="icon-box effect small border">
                            <div class="icon"><a href="#"><i class="fa fa-percent" aria-hidden="true"></i></a></div>
                            <h3>Earn up to 40% Referral Payout Bonus</h3>
                            <p>Start earning easy income through our refer and earn program. Get up to 40% commission for every membership sold through your referral link.</p>
                        </div>
                    </div> -->
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
                    <!-- <h2>How it works?</h2> -->
                    <h2><?php echo $plantinum_section_4['heading']; ?></h2>

                    <!-- <p>We've set out a stream of all the imperative stages for You!</p> -->
                    <p><?php echo $plantinum_section_4['heading_text']; ?></p>
                </div>
        
                <div class="row">
                    <div class="col-md-12 col-12">
                        <div class="tabs tabs-vertical">
                            <div class="row">
                                <div class="col-md-4">
                                    <ul class="nav flex-column nav-tabs" id="myTab4" role="tablist" aria-orientation="vertical">
                                    <?php foreach($plantinum_sections_4 as $key => $value){ ?>
                                    <li class="nav-item"> <a class="nav-link <?php if($key == 0){ echo 'active';} ?>" id="point<?php echo $key +1; ?>-tab" data-toggle="tab" href="#point<?php echo $key+1; ?>" role="tab" aria-controls="home" aria-selected="true"><span class="badge badge-dark"><?php echo $key +1; ?></span> <?php echo $value['title'] ?></a> </li>
                                    <?php } ?>
<!-- 
                                        <li class="nav-item"> <a class="nav-link active" id="point1-tab" data-toggle="tab" href="#point1" role="tab" aria-controls="home" aria-selected="true"><span class="badge badge-dark">1</span> Quick Registration</a> </li>
        
                                        <li class="nav-item"> <a class="nav-link" id="point2-tab" data-toggle="tab" href="#point2" role="tab" aria-controls="profile" aria-selected="false"><span class="badge badge-dark">2</span> Check Eligibility</a> </li>
                                        
                                        <li class="nav-item"> <a class="nav-link" id="point3-tab" data-toggle="tab" href="#point3" role="tab" aria-controls="profile" aria-selected="false"><span class="badge badge-dark">3</span> Buy Membership</a> </li>
                                        
                                        <li class="nav-item"> <a class="nav-link" id="point4-tab" data-toggle="tab" href="#point4" role="tab" aria-controls="profile" aria-selected="false"><span class="badge badge-dark">4</span> Submit Document</a> </li>
                                        
                                        <li class="nav-item"> <a class="nav-link" id="point5-tab" data-toggle="tab" href="#point5" role="tab" aria-controls="profile" aria-selected="false"><span class="badge badge-dark">5</span> Bank Verification</a> </li>
                                        
                                        <li class="nav-item"> <a class="nav-link" id="point6-tab" data-toggle="tab" href="#point6" role="tab" aria-controls="profile" aria-selected="false"><span class="badge badge-dark">6</span> Bank Sanction</a> </li> -->
                                    </ul>
                                </div>
        
                                <div class="col-md-8">
                                    <div class="tab-content p-t-40" id="myTabContent4">

                                    <?php foreach($plantinum_sections_4 as $key => $value){ ?>
                                    <div class="tab-pane fade show <?php if($key == 0){ echo 'active';} ?>" id="point<?php echo $key +1; ?>" role="tabpanel" aria-labelledby="point<?php echo $key +1; ?>-tab">
                                    <ul class="list-icon list-icon-check">
                                    <?php echo $value['description']; ?>
                                    </ul>

                                        </div>
                                        <?php } ?>
<!-- 
                                        <div class="tab-pane fade show active" id="point1" role="tabpanel" aria-labelledby="point1-tab">
                                            <h4>Quick Registration</h4>
                                            <ul class="list-icon list-icon-check">
                                                <li>Search on google INSTALNTLOANSDEALS.COM or visit a website <a href="#" target="_blank"><?php echo base_url();?></a></li>
                                                <li>Click on "Apply for Personal Consultation".</li>
                                                <li>Register your bank register name and mobile number.</li>
                                                <li>If you have already registered then click on the Login option.</li>
                                                <li>If you want to calculate loan EMI and get its details then click on the Loan Calculator. After that click on Apply Now.</li>
                                            </ul>
                                        </div>
                                        
                                        <div class="tab-pane fade show" id="point2" role="tabpanel" aria-labelledby="point2-tab">
                                            <h4>Check Eligibility</h4>
                                            <ul class="list-icon list-icon-check">
                                                <li>Fill up the given details such as CIBIL score, city, loan purpose, income, monthly EMI (in case of an existing loan). Then click on Check Eligibility.</li>
                                                <li>Our automated system will show you the eligibility based on your details and income. Here, only the pre-approval will be shown based on your details, it will not be your final approval.</li> 
                                                <li>Now after checking your eligibility, select the tenure and EMI and click on Get Offer.</li>
                                            </ul>
                                        </div>
        
                                        <div class="tab-pane fade show" id="point3" role="tabpanel" aria-labelledby="point3-tab">
                                            <h4>Buy Membership</h4>
                                            <ul class="list-icon list-icon-check">
                                                <li>Our portal will show you the membership details with customer name with unique code. Click on Buy Now for getting a pre-approved loan offer from our partnered NBFCs along with the membership.</li>
                                                <li>Enter your phone number and email-id; then click on Proceed.</li>
                                                <li>In the next step, the portal will show you multiple payment options. You can pay with any suitable payment option from there.</li>
                                                <li>You can avail several benefits of the membership. Check the detailed benefits of the membership here: <a href="<?php echo base_url('/plantinum-membership-card');?>" target="_blank">membership-card-benefit</a></li>
                                            </ul>
                                        </div>
        
                                        <div class="tab-pane fade show" id="point4" role="tabpanel" aria-labelledby="point4-tab">
                                            <h4>Submit Document</h4>
                                            <ul class="list-icon list-icon-check">
                                                <li>After successful payment, you'll receive a receipt and pasword on your email id.</li>
                                                <li>You will get a call from the login department in 24-48 hours after payment for document verification.</li>
                                                <li>Customer has to submit their documents within 3 days through the provided WhatsApp number or their customer portal.</li>
                                                <li>Document verification is compulsory as our company is not able to proces loan without it.</li>
                                            </ul> 
                                        </div>
        
                                        <div class="tab-pane fade show" id="point5" role="tabpanel" aria-labelledby="point5-tab">
                                            <h4>Bank Verification</h4>
                                            <ul class="list-icon list-icon-check">
                                                <li>NBFC Banks will verify your profile as per their rules and criteria.</li>
                                                <li>Your documents will be verified by the NBFC Bank as per their terms and rules.</li>
                                            </ul>
                                        </div>
        
                                        <div class="tab-pane fade show" id="point6" role="tabpanel" aria-labelledby="point6-tab">
                                            <h4>Bank Sanction</h4>
                                            <ul class="list-icon list-icon-check">
                                                <li>Bank Sanction directly depends on the customer’s profile and bank criteria &amp; rules and regulations.</li>
                                                <li>The final decision on loan sanction, approval, and disbursement will depend on the banks as per their rules and regulations.</li>
                                            </ul>
                                            <p>You can check all the company Terms &amp; Conditions here: <a href="<?php echo base_url('terms-conditions');?>" target="_blank">terms-conditions</a></p>
                                        </div> -->
        
                                    </div>
                                </div>
        
                            </div>
                        </div>
        
                    </div>
                </div>
        
                <div class="row m-t-50">
                    <div class="col-md-12 col-12">
                        <!-- <p><strong>Disclaimer:</strong> The Premium Membership is not any sort of loan approval guarantee and the customer should not be under the impression that buying membership means getting money in the bank. Membership is limited to our company only, providing certain benefits. T&amp;C applied*.</p> -->
                        <p><strong>Disclaimer:</strong><?php echo $plantinum_section_4['disclaimer']; ?></p>
                    </div>
                </div>
            </div>
        </section>