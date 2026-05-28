
    <!-- Intro settings -->
    <style>
      #intro {
        /* Margin to fix overlapping fixed navbar */
        margin-top: 58px;
      }

      @media (max-width: 991px) {
        #intro {
          /* Margin to fix overlapping fixed navbar */
          margin-top: 45px;
        }
      }
    </style>


  <!--Main Navigation-->

  <!--Main layout-->
  <main class="my-5">
    <div class="container">
      <!--Section: Content-->
      <section class="text-center">
        <h3 class="mb-5"><strong>Our Blogs</strong></h3>

        <div class="row">

        <?php 
            if ($datas) {
            foreach ($datas as $key => $data) {
        ?>

          <div class="col-lg-4 col-md-12 mb-4">
            <div class="card">
              <div class="bg-image hover-overlay" data-mdb-ripple-init data-mdb-ripple-color="light">
                <?php if ($data->blogImage){?><img style="height:300px" src="<?= base_url('beta/')?><?= $data->blogImage;?>" class="img-fluid" /><?php }?>
                <a href="#!">
                  <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                </a>
              </div>
              <div class="card-body">
                <h5 class="card-title"><?= $data->blogTitle?></h5>
                <p class="card-text"><?= $data->shortData?></p>
                <a href="<?= base_url('blog-detail')?>/<?= $data->id;?>" class="btn btn-primary" data-mdb-ripple-init>Read</a>
              </div>
            </div>
          </div>
          <?php }}?>
       
        </div>
      </section>
      <!--Section: Content-->

      <!-- Pagination -->
      <!-- <nav class="my-4" aria-label="...">
        <ul class="pagination pagination-circle justify-content-center">
          <li class="page-item">
            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
          </li>
          <li class="page-item"><a class="page-link" href="#">1</a></li>
          <li class="page-item active" aria-current="page">
            <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
          </li>
          <li class="page-item"><a class="page-link" href="#">3</a></li>
          <li class="page-item">
            <a class="page-link" href="#">Next</a>
          </li>
        </ul>
      </nav> -->
    </div>
  </main>
  <!--Main layout-->
