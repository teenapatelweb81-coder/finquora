<!--====================header close=============================-->
   <section class="p-t-130 p-b-100" id="page-title" data-bg-parallax="<?= base_url('beta/assets/images/contect-us/' . ($this->db->where('domain_id', domain_id_get())->get('contect_us')->row('background_img') ?? '')) ?>
"><div class="parallax-container img-loaded" data-velocity="-.140" style="background: url(&quot;<?= base_url('beta/assets/images/contect-us/' . ($this->db->where('domain_id', domain_id_get())->get('contect_us')->row('background_img') ?? '')) ?>
&quot;) 0px;"></div>
  <div class="container">
    <div class="page-title">
      <h1><?php echo !empty($company_profile['title']) ? htmlspecialchars($company_profile['title']) : 'Company Profile'; ?></h1>
    </div>
    <div class="breadcrumb">
      <ul itemscope="" itemtype="https://schema.org/BreadcrumbList">
        <li itemprop="itemListElement" itemscope="" itemtype="#">
          <a itemprop="item" href="#">
            <span itemprop="name">Home</span>
          </a>
          <meta itemprop="position" content="1">
        </li>
        <li itemprop="itemListElement" itemscope="" itemtype="#">
          <a itemprop="item" href="#">
            <span itemprop="name">Company</span>
          </a>
          <meta itemprop="position" content="2">
        </li>
      </ul>
    </div>
  </div>
</section>

<section id="company">
  <div class="container">
    <div class="row">
      <div class="col-12 m-b-20">
        <h2><?php echo !empty($company_profile['sub_title']) ? htmlspecialchars($company_profile['sub_title']) : 'Know Our Company!'; ?></h2>
        <p><?php echo !empty($company_profile['sub_title_text']) ? htmlspecialchars($company_profile['sub_title_text']) : 'Come across our motto as a customer-centric organization'; ?></p>
      </div>

      <div class="col-lg-8 col-md-8 col-12 m-b-20">
        <div class="text-justify">
          <?php if (!empty($company_profile['description'])): ?>
            <?php echo $company_profile['description']; ?>
          <?php else: ?>
            <h4><strong>No Title</strong></h4>
            
            <p>No description Found.</p>
          <?php endif; ?>
        </div>
      </div>  

      <div class="sidebar col-lg-4 col-md-4 col-12">
        <div class="sidebar-menu">
          <?php if (!empty($company_profile['right_description'])): ?>
            <?php echo $company_profile['right_description']; ?>
          <?php else: ?>
            <p>Not Found any details.</p>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="background-grey">
  <div class="container">
    <div class="text-center">
      <?php echo !empty($company_profile['second_title']) ? $company_profile['second_title'] : '<h2>No Title</h2>'; ?>
      <?php echo !empty($company_profile['second_sub_title']) ? $company_profile['second_sub_title'] : '<p>Not Found any details.</p>'; ?>
    </div>

    <div class="row">
      <?php if (!empty($our_stories)): ?>
        <?php foreach ($our_stories as $data): ?>
          <div class="col-lg-3 col-md-3 col-12 p-cb">
            <h2 class="text-success font-weight-400"><i class="fa fa-calendar-o" aria-hidden="true"></i> <?php echo htmlspecialchars($data['date']); ?></h2>
            <h4><?php echo htmlspecialchars($data['title']); ?></h4>
            <p><?php echo htmlspecialchars($data['description']); ?></p>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="col-lg-3 col-md-3 col-12 p-cb">
          <h2 class="text-success font-weight-400"><i class="fa fa-calendar-o" aria-hidden="true"></i> Not Found any dates.</h2>
          <h4>No Title</h4>
          <p>No description Found.</p>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>

<section>
  <div class="container">
    <div class="row">
      <div class="col-lg-7 col-md-7 col-12">
        <div class="text-left m-b-20">
          <?php echo !empty($company_profile['third_title']) ? $company_profile['third_title'] : '<h2>No data</h2>'; ?>
          <?php echo !empty($company_profile['third_sub_title']) ? $company_profile['third_sub_title'] : '<p>No description Found.</p>'; ?>
        </div>

        <?php if (!empty($smart_choices)): ?>
          <?php foreach ($smart_choices as $data): ?>
            <div class="icon-box effect small m-b-10">
              <div class="icon"><a href="#"><i class="<?php echo htmlspecialchars($data['icon']); ?>"></i></a></div>
              <h3><?php echo htmlspecialchars($data['title']); ?></h3>
              <p><?php echo htmlspecialchars($data['text']); ?></p>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <div class="icon-box effect small m-b-10">
            <div class="icon"><a href="#"><i class="fa fa-users"></i></a></div>
            <h3>No data</h3>
            <p>No description Found.</p>
          </div>
        <?php endif; ?>
      </div>

      <div class="col-lg-5 col-md-5 col-12 text-center">
        <?php if (!empty($company_profile['image'])): ?>
          <img src="<?php echo base_url('beta/assets/images/media_coverage/' . htmlspecialchars($company_profile['image'])); ?>" alt="<?php echo htmlspecialchars($company_profile['alt_text'] ?? 'Media Coverage Image'); ?>" style="width: 100%; max-width: 100px;">
        <?php else: ?>
          <img src="<?php echo base_url('beta/assets/images/model-8.png'); ?>" alt="our products" class="img-fluid">
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>

<section class="background-grey p-b-40">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="text-center m-b-10">
          <?php echo !empty($company_profile['four_title']) ? $company_profile['four_title'] : '<h2>The Media Coverage</h2>'; ?>
          <?php echo !empty($company_profile['four_sub_title']) ? $company_profile['four_sub_title'] : '<p>Our unique services and accomplishments were well-featured all across</p>'; ?>
        </div>

        <div class="carousel client-logos flickity-enabled is-draggable carousel-loaded" data-items="5" data-arrows="false" data-dots="false">
          <?php if (!empty($media_coverages)): ?>
            <?php foreach ($media_coverages as $data): ?>
              <div class="icon-box box-type effect center process">
                <img alt="<?php echo htmlspecialchars($data['image']); ?>" src="<?= base_url('beta/assets/images/media_coverage/' . htmlspecialchars($data['image'])); ?>">
              </div>
            <?php endforeach; ?>
          <?php else: ?>
            <div class="icon-box box-type effect center process">
              No Data
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>