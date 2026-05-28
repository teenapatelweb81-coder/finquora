<style>
  #msg {
    font-size: 20px;
    color: green !important; 
  }
</style>

<section class="p-t-130 p-b-100" id="page-title" data-bg-parallax=".assets/images/header-bg-104.jpg">
  <div class="parallax-container img-loaded" data-velocity="-.140"
    style="background: url(<?= isset($contectUs['background_img']) && !empty($contectUs['background_img']) ? base_url('beta/assets/images/contect-us/' . $contectUs['background_img']) : base_url('upload/assets/images/header-bg-104.jpg') ?>) 0px;">
  </div>
  <div class="container">
    <div class="page-title">
      <h1><?= isset($contectUs['title']) && !empty($contectUs['title']) ? htmlspecialchars($contectUs['title']) : 'Contact Us' ?></h1>
    </div>
    <div class="breadcrumb">
      <ul itemscope="" itemtype="https://schema.org/BreadcrumbList">
        <li itemprop="itemListElement" itemscope="" itemtype="#">
          <a itemprop="item" href="<?= base_url(); ?>">
            <span itemprop="name">Home</span>
          </a>
          <meta itemprop="position" content="1">
        </li>
        <li itemprop="itemListElement" itemscope="" itemtype="#">
          <a itemprop="item" href="#">
            <span itemprop="name">Contact</span>
          </a>
          <meta itemprop="position" content="2">
        </li>
      </ul>
    </div>
  </div>
</section>

<section id="contact" class="p-b-30">
  <div class="container">	
    <div class="row">
      <div class="col-12 m-b-20">
        <div class="heading-text heading-line text-center">
          <h4 class="text-medium font-weight-500">
            <?= isset($contectUs['heading']) && !empty($contectUs['heading']) ? htmlspecialchars($contectUs['heading']) : 'Company.' ?>
          </h4>
        </div>
      </div>
      
      <div class="col-lg-3 col-md-3 col-12 m-b-20">
        <h5><strong><i class="fa fa-map-marker m-r-5"></i> Registered Office: </strong></h5>
        <p><?= isset($contectUs['registered_office']) && !empty($contectUs['registered_office']) ? htmlspecialchars($contectUs['registered_office']) : 'Address not found' ?></p>
      </div>

      <div class="col-lg-3 col-md-3 col-12 m-b-20">
        <h5><strong><i class="fa fa-envelope m-r-5"></i> Write To Us: </strong></h5>
        <p class="m-b-0">Customer Support: 
          <a href="mailto:<?= isset($contectUs['company_gmail']) && !empty($contectUs['company_gmail']) ? htmlspecialchars($contectUs['company_gmail']) : 'Mail not found' ?>">
            <?= isset($contectUs['company_gmail']) && !empty($contectUs['company_gmail']) ? htmlspecialchars($contectUs['company_gmail']) : 'Mail not found' ?>
          </a>
        </p>
        <p>Partner Support: 
          <a href="mailto:<?= isset($contectUs['other_gmail']) && !empty($contectUs['other_gmail']) ? htmlspecialchars($contectUs['other_gmail']) : 'Mail not found' ?>">
            <?= isset($contectUs['other_gmail']) && !empty($contectUs['other_gmail']) ? htmlspecialchars($contectUs['other_gmail']) : 'Mail not found' ?>
          </a>
        </p>
      </div>

      <div class="col-lg-3 col-md-3 col-12 m-b-20">
        <h5><strong><i class="fa fa-phone m-r-5"></i> Help Line: </strong></h5>
        <p class="m-b-0">
          <a href="tel:+91-<?= isset($contectUs['mobile_no']) && !empty($contectUs['mobile_no']) ? htmlspecialchars($contectUs['mobile_no']) : 'contact number not found' ?>">
            +91-<?= isset($contectUs['mobile_no']) && !empty($contectUs['mobile_no']) ? htmlspecialchars($contectUs['mobile_no']) : 'contact number not found' ?>
          </a>
        </p>
      </div>
    </div>
    
  </div>
</section>


<!-- Google Map Section -->
<section class="p-t-30 p-b-60">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="heading-text heading-line text-center m-b-30">
          <h4>Find Us On Map</h4>
        </div>
        <div class="embed-responsive embed-responsive-16by9" style="border-radius: 8px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
          <iframe
            class="embed-responsive-item"
            width="100%"
            height="450"
            style="border:0;"
            loading="lazy"
            allowfullscreen
            referrerpolicy="no-referrer-when-downgrade"
            src="https://www.google.com/maps/embed/v1/place?key=AIzaSyAMgu9EHYNJdyl4Ie8adlQ8RNGCG6kleng&q=<?= urlencode(isset($contectUs['registered_office']) ? $contectUs['registered_office'] : 'New Delhi, India') ?>">
          </iframe>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- End Google Map Section -->
 
<section class="p-t-30">
  <div class="container">
    <div class="row">
      <div class="col-12 m-b-20">
        <div class="heading-text heading-line text-center">
          <h4 class="text-medium font-weight-500">
            <?= isset($contectUs['contect_form_heading']) && !empty($contectUs['contect_form_heading']) ? htmlspecialchars($contectUs['contect_form_heading']) : 'Help us serve you better' ?>
          </h4>
        </div>
      </div>

      <div class="col-lg-12 col-md-12">
        <form action="<?= base_url('send-query'); ?>" id="contactForm" class="form-horizontal" novalidate="novalidate" method="post" accept-charset="utf-8">
          <p>
            <em><?= isset($contectUs['content_form_text']) && !empty($contectUs['content_form_text']) ? htmlspecialchars($contectUs['content_form_text']) : 'If you got any questions, please do not hesitate to send us a message. We reply within 24 hours!' ?></em>
          </p>
          <span class="text-center text-primary mb-2" id="msg">
            <?= $this->session->flashdata('message') ? htmlspecialchars($this->session->flashdata('message')) : '' ?>
          </span>

          <div class="row">
            <div class="form-group col-md-6">
              <label class="text-dark" for="fullname">Full Name *</label>
              <input type="text" aria-required="true" name="fullname" class="form-control" required="">
              <div class="help-block font-small-3"></div>
            </div>
            <div class="form-group col-md-6">
              <label class="text-dark" for="mobile">Mobile no *</label>
              <input type="text" aria-required="true" name="mobile" class="form-control" required="">
              <div class="help-block font-small-3"></div>
            </div>
          </div>

          <div class="row">
            <div class="form-group col-md-6">
              <label class="text-dark" for="email">Email id *</label>
              <input type="email" aria-required="true" name="email" class="form-control" required="">
              <div class="help-block font-small-3"></div>
            </div>
            <div class="form-group col-md-6">
              <label class="text-dark" for="subject">Subject</label>
              <input type="text" name="subject" class="form-control">
            </div>
          </div>

          <div class="form-group">
            <label class="text-dark" for="message">Message *</label>
            <textarea name="message" rows="5" aria-required="true" class="form-control" maxlength="500" required=""></textarea>
            <div class="help-block font-small-3"></div>
          </div>

          <div class="form-group">
            <div class="custom-control custom-checkbox">
              <input type="checkbox" aria-required="true" name="conditions" id="conditions" class="custom-control-input" value="1" required="">
              <label class="custom-control-label" for="conditions">
                <small>By proceeding, you agree to the 
                  <a href="#" target="_blank">Terms of Use</a>, 
                  <a href="#" target="_blank">Privacy Policy</a> 
                  and this consent will override any registration by me for DNC / NDNC.
                </small>
              </label>
              <div class="help-block font-small-3"></div>
            </div>
          </div>

          <button type="submit" id="submit-btn" class="btn btn-primary">Send Message</button>
        </form> 
      </div>
    </div>
  </div>
</section>