<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!-- Page Header -->
<header class="page-header bg-light py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 class="display-5 fw-bold text-primary mb-2"><?= html_escape($branch['branch_name']) ?></h1>
                <p class="lead text-muted mb-0"><?= html_escape($branch['short_description']) ?></p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="tel:<?= html_escape($branch['mobile']) ?>" class="btn btn-primary btn-lg px-4 me-2">
                    <i style="font-size:18px;"  class="fa fa-phone-alt me-2"></i> Call Now
                </a>
                <a href="mailto:<?= html_escape($branch['email']) ?>" class="btn btn-outline-primary btn-lg px-4">
                    <i style="font-size:18px;"  class="fa fa-envelope me-2"></i> Email Us
                </a>
            </div>
        </div>
    </div>
</header>

<!-- Branch Details Section -->
<section class="py-5">
    <div class="container-fluid">
        <div class="row g-5">
            <!-- Main Content -->
            <div class="col-lg-7">
                <!-- Branch Image -->
                <div class="card border-0 shadow-sm mb-4">
                    <?php
                            $file_extension = !empty($branch['branch_image']) ? strtolower(pathinfo($branch['branch_image'], PATHINFO_EXTENSION)) : '';
                            $is_video = in_array($file_extension, ['mp4', 'webm', 'avi', 'mov']);

                            if (!empty($branch['branch_image'])): 
                                if ($is_video): 
                            ?>
                                    <video class="card-img-top w-100" 
                                          style="height:400px!important;object-fit:cover;border-radius: 10px 10px 0 0;"
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
                                        style="height:400px!important;object-fit:cover;border-radius: 10px 10px 0 0;">
                                <?php 
                                endif;
                            endif; 
                            ?>
                </div>
                
                <!-- Branch Description -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h3 class="h4 mb-4">About This Branch</h3>
                        <div class="content">
                            <?= !empty($branch['long_description']) 
                                ? $branch['long_description'] 
                                : '<p>No detailed description available.</p>'; 
                            ?>
                        </div>
                    </div>
                </div>
                
                <!-- Branch Services -->
                <?php if (!empty($branch['services'])): ?>
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h3 class="h4 mb-4">Our Services</h3>
                        <div class="row g-4">
                            <?php 
                            $services = explode(',', $branch['services']);
                            foreach ($services as $service): 
                                if (trim($service)):
                            ?>
                            <div class="col-md-6">
                                <div class="d-flex align-items-start">
                                    <div class="bg-primary bg-opacity-10 p-2 rounded mr-3">
                                        <i style="font-size:18px;"  class="fa fa-check-circle text-primary"></i>
                                    </div>
                                    <div>
                                        <h5 class="h6 mb-0"><?= html_escape(trim($service)) ?></h5>
                                    </div>
                                </div>
                            </div>
                            <?php 
                                endif;
                            endforeach; 
                            ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
            
            <!-- Sidebar -->
            <div class="col-lg-5">
                <!-- Contact Card -->
                <div class="card border-0 shadow-sm sticky-top" style="top: 20px;">
                    <div class="card-body">
                        <h3 class="h5 mb-4">Contact Information</h3>
                        <ul class="list-unstyled">
                            <li class="mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="text-primary mr-3">
                                        <i style="font-size:18px;"  class="fa fa-map-marker"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">Address</h6>
                                        <p class="text-muted mb-0"><?= nl2br(html_escape($branch['address'])) ?></p>
                                        <span class="text-muted mb-0"><?= nl2br(html_escape($branch['city'])) ?></span>
                                        <span class="text-muted mb-0"><?= nl2br(html_escape($branch['state'])) ?></span>
                                        <span class="text-muted mb-0"><?= nl2br(html_escape($branch['country'])) ?></span>
                                        <span class="text-muted mb-0"><?= nl2br(html_escape($branch['pincode'])) ?></span>
                                    </div>
                                </div>
                            </li>
                            <li class="mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="text-primary mr-3">
                                        <i style="font-size:18px;"  class="fa fa-phone"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">Phone</h6>
                                        <p class="mb-0">
                                            <a href="tel:<?= html_escape($branch['mobile']) ?>" class="text-decoration-none">
                                                <?= html_escape($branch['mobile']) ?>
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <?php if (!empty($branch['email'])): ?>
                            <li class="mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="text-primary mr-3">
                                        <i style="font-size:18px;"  class="fa fa-envelope"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">Email</h6>
                                        <p class="mb-0">
                                            <a href="mailto:<?= html_escape($branch['email']) ?>" class="text-decoration-none">
                                                <?= html_escape($branch['email']) ?>
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <?php endif; ?>
                            <?php if (!empty($branch['working_hours'])): ?>
                            <li class="mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="text-primary mr-3">
                                        <i style="font-size:18px;"  class="fa fa-clock"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">Working Hours</h6>
                                        <p class="text-muted mb-0"><?= nl2br(html_escape($branch['working_hours'])) ?></p>
                                    </div>
                                </div>
                            </li>
                            <?php endif; ?>
                        </ul>
                        
                        <!-- Social Media Links -->
                        <!-- <div class="mt-4">
                            <h6 class="mb-3">Connect With Us</h6>
                            <div class="d-flex align-items-center">
                                <?php if (!empty($branch['facebook_url'])): ?>
                                <a href="<?= html_escape($branch['facebook_url']) ?>" target="_blank" class="btn btn-sm btn-outline-primary me-2">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <?php endif; ?>
                                <?php if (!empty($branch['twitter_url'])): ?>
                                <a href="<?= html_escape($branch['twitter_url']) ?>" target="_blank" class="btn btn-sm btn-outline-info me-2">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <?php endif; ?>
                                <?php if (!empty($branch['linkedin_url'])): ?>
                                <a href="<?= html_escape($branch['linkedin_url']) ?>" target="_blank" class="btn btn-sm btn-outline-primary me-2">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <?php endif; ?>
                                <?php if (!empty($branch['instagram_url'])): ?>
                                <a href="<?= html_escape($branch['instagram_url']) ?>" target="_blank" class="btn btn-sm btn-outline-danger me-2">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                <?php endif; ?>
                            </div>
                        </div> -->
                    </div>
                </div>
                
                
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
                            src="https://www.google.com/maps/embed/v1/place?key=AIzaSyAMgu9EHYNJdyl4Ie8adlQ8RNGCG6kleng&q=<?= urlencode(isset($branch['address']) ? $branch['address'] : '') ?>">
                        </iframe>
                        </div>
                    </div>
                    </div>
                </div>
                </section>
                <!-- End Google Map Section -->
                
            </div>
        </div>
    </div>
</section>
<?php if (!empty($nearby_branches)): ?>
<section class="blog-section py-5 background-grey">
  <div class="container">
    <!-- Section Heading -->
    <div class="text-center mb-5">
        <h2 class="display-5 fw-bold">Other Branches</h2>
        <p class="lead text-muted">Check out our other branches nearby</p>
    </div>
    <div class="carousel  flickity-enabled is-draggable carousel-loaded" data-items="3" data-arrows="true" data-dots="false">
      <?php if (!empty($nearby_branches)): ?>
          <?php foreach ($nearby_branches as $branch): ?>
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
