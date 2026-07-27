<style>
  .inspiro-slider .slide {
    background-size: cover;
    background-position: center center;
    background-repeat: no-repeat;
}
</style>

     <?php
// Define dummy data for each section to prevent null errors
$sliders = !empty($sliders) ? $sliders : [
    [
        'bg_image' => 'default-bg.jpg',
        'title' => 'Welcome to Our Platform',
        'sub_title' => 'Discover our amazing services',
        'url' => '#',
        'button_name' => 'Learn More',
        'slider_image' => 'default-slide.jpg'
    ]
];

$edge_heading = !empty($edge_heading) ? $edge_heading : [
    'title' => 'Our Advantages',
    'description' => 'Explore what makes us unique'
];

$edges = !empty($edges) ? $edges : [
    [
        'title' => 'Feature One',
        'sub_title' => 'Description of feature one',
        'slider_image' => 'feature1.jpg'
    ]
];

$categories_heading = !empty($categories_heading) ? $categories_heading : [
    'title' => 'Our Categories',
    'description' => 'Browse through our categories',
    'image' => 'category-default.jpg'
];

$categories = !empty($categories) ? $categories : [
    [
        'title' => 'Default Category',
        'sub_title' => 'Description of default category',
        'url' => '#',
        'button_name' => 'View Details'
    ]
];

$about_customer = !empty($about_customer) ? $about_customer : [
    [
        'title' => 'About Our Customers',
        'sub_title' => 'We value our customers and their success'
    ]
];

$partner_heading = !empty($partner_heading) ? $partner_heading : [
    'title' => 'Our Partners',
    'description' => 'Trusted by leading brands'
];

$partner_sliders = !empty($partner_sliders) ? $partner_sliders : [
    [
        'slider_image' => 'partner-default.jpg',
        'title' => 'Default Partner'
    ]
];

$video_heading = !empty($video_heading) ? $video_heading : [
    'title' => 'Our Videos',
    'description' => 'Watch our featured videos'
];

$datas = !empty($datas) ? $datas : [
    [
        'url' => '',
        'image' => 'default-video-thumb.jpg'
    ]
];
?>
<style>
  iframe{
    height: 250px;
    width: unset !important;
    top: 60px !important;
  }

  video,.img_slider,iframe,source{
    width:200px !important;
    height:200px !important;
  }

</style>

<!--=================slider============================================-->

<!-- <div id="slider" class="inspiro-slider slider-fullscreen dots-creative flickity-enabled" data-height-xs="360" data-autoplay="8000" data-items="1" data-loop="false"> -->
  <div id="slider"
     class="inspiro-slider slider-fullscreen dots-creative"
     data-height-xs="360"
     data-autoplay="0"
     data-items="1"
     data-loop="false"
     data-arrows="true">
  <?php 
    if (!empty($sliders)) {
    foreach ($sliders as $key => $slide) {                 
  ?>
    <div class="slide" style="background-image: url(<?= base_url('beta/assets/images/slider/')?><?= $slide['bg_image']?>">
      <div class="container">
        <div class="slide-captions row">
          <div class="col-lg-6 col-md-6 col-12 align-self-center fadeInUp">
            <h2 class="text-dark"><?= $slide['title']?></h2> 
            <p class="text-dark"><?= $slide['sub_title']?></p>
            <a href="<?= base_url($slide['url']); ?>" class="btn btn-outline btn-rounded btn-reveal btn-reveal-right">
                <span><?= $slide['button_name'] ?></span>
                <i class="fa fa-arrow-right"></i>
            </a>
          </div>
          <div class="col-lg-6 col-md-6 col-12 fadeInUp">
            <?php if (!empty($slide['slider_image'])) { ?>
              <img alt="premium membership" class="img-fluid" src="<?= base_url('beta/assets/images/slider/')?><?= $slide['slider_image']?>">
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  <?php }}?>
</div>
<!--=================slider close============================================--> 

<section class="">
  <div class="container">
    <div class="text-center">
      <h2><?= $edge_heading['title']?></h2>
      <p><?= $edge_heading['description']?></p>
    </div>
    <div class="row">
    <?php 
      if (!empty($edges)) {
      foreach ($edges as $key => $edge) {                 
    ?>
      <div class="col-lg-3">
        <div class="icon-box box-type effect medium center process">
          <div class="icon m-t-0"> <a href="#">
            <?php if (!empty($edge['slider_image'])) { ?>
              <img  class="" height='64'  width="64" src="<?= base_url('beta/assets/images/slider/')?><?= $edge['slider_image']?>">
            <?php } ?></a>
          </div>
          <h3><?= $edge['title']?></h3>
          <p><?= $edge['sub_title']?></p>
        </div>
      </div>
    <?php }}?>
  </div>
</section>

<section class="background-grey">
  <div class="container">
    <div class="row">
      <div class="col-lg-7 col-md-7 col-12">
        <h2><?= $categories_heading['title']?></h2>
        <p><?= $categories_heading['description']?></p>
        <div class="accordion accordion-simple">
          <?php 
            if(!empty($categories)) {
            foreach ($categories as $key => $category) {                 
          ?>
            <div class="ac-item">
              <h3 class="ac-title"><i class="fa fa-credit-credit"></i><?= $category['title']?></h3>
              <div class="ac-content">
                <p><?= $category['sub_title']?></p>
                <a href="<?php echo base_url($category['url']);?>" class="btn btn-primary btn-sm"><?= $category['button_name']?></a>
              </div>
            </div>
          <?php }}?>
        </div>
      </div>
      <div class="col-lg-5 col-md-5 col-12 text-center">
      <img src="<?= base_url('beta/assets/images/slider/')?><?= $categories_heading['image']?>" alt="<?= $categories_heading['title']?>" class="img-fluid">
      </div>
    </div>
  </div>
</section>

<section>
  <div class="container">
    <div class="row">
      <?php 
        if (!empty($about_customer)) {
          foreach ($about_customer as $key => $about) {                 
      ?>
      <div class="col-lg-4">
        <h2 class="text-medium"><?= $about['title']?></h2>
      </div>
      <div class="col-lg-8">
        <p><?= $about['sub_title']?></p>
      </div>
      <?php }}?>
    </div>
  </div>
</section>

<section class="background-grey">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="text-center m-b-20">
          <h2><?= $partner_heading['title']?></h2>
          <p><?= $partner_heading['description']?></p>
        </div>
          <div class="carousel client-logos flickity-enabled is-draggable carousel-loaded" data-items="6" data-arrows="true" data-dots="false">
            <?php 
              if (!empty($partner_sliders)) {
              foreach ($partner_sliders as $key => $partner_slider) {                 
            ?>
            <div class="icon-box box-type effect center process">
              <img style="" src="<?= base_url('beta/assets/images/slider/')?><?= $partner_slider['slider_image']?>" alt="<?= $partner_slider['title']?>">
            </div>
            <?php }}?>
        </div>
      </div>
    </div>
  </div>
</section>

<section>
  <div class="container">
    <div class="text-center m-b-50">
      <h2><?= $video_heading['title']?></h2>
      <p><?= $video_heading['description']?></p>
    </div>
    <div class="row">
      <div class="col-lg-12 col-md-12 col-12">
        <div class="carousel flickity-enabled is-draggable carousel-loaded" data-items="3" data-dots="false">
          <?php 
            if (!empty($datas)) {
            foreach ($datas as $key => $data) {                 
          ?>
          <?php if (!empty($data['url'])) { ?>
            <div class="video-wrap m-b-20"><?= $data['url']?></div>
            <?php }if (!empty($data['image'])) { ?>
            <div class="video-wrap m-b-20"><img  class="img_slider" width='200px'  width="250" src="<?= base_url('beta/')?><?= $data['image']?>"></div>
          <?php }}}?>
        </div>
      </div>
    </div>
  </div>
</section>

<?php if(!empty($branches) && $branches['status'] == 1): ?>
<section class="blog-section py-5 background-grey">
  <div class="container">
    <!-- Section Heading -->
    <div class="section-title text-center mb-5">
        <h2 class="display-5 fw-bold"><?= $branches['title']; ?></h2>
        <p class="lead text-muted"><?= $branches['description']; ?></p>
    </div>
    <div class="carousel client-logos flickity-enabled is-draggable carousel-loaded" data-items="3" data-arrows="true" data-dots="false">
      <?php if (!empty($branch_data)): ?>
          <?php foreach ($branch_data as $branch): ?>
              <div class="">
                  <article class="card h-100 border-0 shadow-sm">

                      <!-- Image -->
                      <div class="position-relative">
                          <?php
                            $file_extension = !empty($branch['branch_image']) ? strtolower(pathinfo($branch['branch_image'], PATHINFO_EXTENSION)) : '';
                            $is_video = in_array($file_extension, ['mp4', 'webm', 'avi', 'mov']);

                            if (!empty($branch['branch_image'])): 
                                if ($is_video): 
                            ?>
                                    <video class="card-img-top w-100" 
                                          style="height:220px!important;object-fit:cover;border-radius: 10px 10px 0 0;"
                                          controls
                                          poster="<?= base_url('beta/upload/assets/images/thumbnails/' . pathinfo($branch['branch_image'], PATHINFO_FILENAME) . '.jpg') ?>">
                                        <source src="<?= base_url('beta/upload/assets/images/' . $branch['branch_image']) ?>" 
                                                type="video/<?= $file_extension ?>">
                                        Your browser does not support the video tag.
                                    </video>
                                <?php else: ?>
                                    <img src="<?= base_url('beta/upload/assets/images/' . $branch['branch_image']) ?>"
                                        class="card-img-top w-100"
                                        alt="<?= $branch['branch_name']; ?>"
                                        style="height:220px!important;object-fit:cover;border-radius: 10px 10px 0 0;">
                                <?php 
                                endif;
                            endif; 
                            ?>

                          <!-- Date -->
                          <div class="d-flex align-items-center justify-content-between p-0">
                            <div class="bg-white px-3 pt-2 rounded-top">
                              <small class="text-muted">
                                <i class="fa fa-calendar-alt me-1"></i>
                                <?= date('M d, Y', strtotime($branch['branch_date'] ?? 'now')); ?>
                              </small>
                            </div>
                            <div class="bg-white px-3 pt-2 rounded-top">
                                <a href="tel:<?= $branch['mobile']; ?>">
                                  <i class="fa fa-phone me-1"></i>
                                  <?= $branch['mobile']; ?>
                                </a>
                              </div>
                          </div>
                      </div>

                      <!-- Card Body -->
                      <div class="px-3 py-2 d-flex flex-column">

                          <!-- Branch Name -->
                          <h4 class="fw-bold mb-1">
                              <?= $branch['branch_name']; ?>
                          </h4>

                          <!-- Contact Details -->
                          <ul class="list-unstyled mb-3">
                              <li class="mb-1">
                                  <i class="fa fa-user text-primary me-2"></i>
                                  <strong>Contact:</strong>
                                  <?= $branch['contact_person']; ?>
                              </li>
                              <li>
                                  <i class="fa fa-envelope text-primary me-2"></i>
                                  <strong>Email:</strong>
                                  <a href="mailto:<?= $branch['email']; ?>" class="text-decoration-none">
                                      <?= $branch['email']; ?>
                                  </a>
                              </li>
                              <li>
                                  <i class="fa fa-map-marker text-primary me-2"></i>
                                  <strong>Address:</strong>
                                  <span class="text-decoration-none">
                                      <?= $branch['address']; ?>
                                  </span>
                              </li>
                          </ul>

                          <!-- Long Description -->
                          <p class="card-text text-muted flex-grow-1">
                              <?= strip_tags($branch['short_description']); ?>
                          </p>

                          <!-- Button -->
                          <a href="<?= site_url('page/branch/' . $branch['id']) ?>" class="btn btn-outline-primary mt-auto">
                              View more details <i class="fa fa-arrow-right ms-1"></i>
                          </a>

                      </div>
                  </article>
              </div>
          <?php endforeach; ?>
      <?php else: ?>
          <div class="col-12 text-center">
              <p class="text-muted">No branches available.</p>
          </div>
      <?php endif; ?>
    </div>
  </div>
</section>
<?php endif; ?>

