<style>
    .background-columbia-blue {
        background: <?= !empty($branchBanner['background_color']) ? htmlspecialchars($branchBanner['background_color']) : '#77E3FD' ?> !important;
    }
</style>
        <!--====================header close=============================-->

        <!--=================slider============================================-->

       
<div id="slider" class="inspiro-slider slider-fullscreen dots-creative flickity-enabled" data-height-xs="360"
    data-autoplay="8000" data-items="1" data-loop="true">

    <div class="slide background-columbia-blue">
        <div class="container">
            <div class="slide-captions row">
                <div class="col-lg-6 col-md-6 col-12 align-self-center fadeInUp">
                    <h1 class="text-medium">
                        <?php echo !empty($branchBanner['title']) ? htmlspecialchars($branchBanner['title']) : 'NOt found'; ?>
                    </h1>
                    <p>
                        <?php echo !empty($branchBanner['text']) ? htmlspecialchars($branchBanner['text']) : 'NOt found.'; ?>
                    </p>
                    <a href="<?php echo base_url('/branch-franchise');?>" class="btn btn-outline btn-rounded btn-reveal btn-reveal-right">
                        <span>Apply Now</span><i class="fa fa-arrow-right"></i>
                    </a>
                </div>
                <div class="col-lg-6 col-md-6 col-12 fadeInUp">
                    <img src="<?php echo !empty($branchBanner['image']) ? base_url('beta/assets/images/branchBanner/' . htmlspecialchars($branchBanner['image'])) : base_url('beta/assets/images/model-12.png'); ?>" alt="premium membership" class="img-fluid" />
                </div>
            </div>
        </div>
    </div>

</div>

        <!--=================slider close============================================-->