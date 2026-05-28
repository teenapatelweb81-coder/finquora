<!DOCTYPE html>
<html lang="en">

<head>
  <title>Banner</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    .body{
      font-family: sans-serif;
    }
    .text-green{
      color:#528135;
    }.for_length{
      height: 16px;
    }.font-bolder{
      font-weight:bold;
    }.font-600{
       font-weight:600;
    }.font-700{
       font-weight:700;
    }.w-85{
        width:85%;
    }

    /* }.banner_img {
        background-image: url(image/bg-img.jpeg);
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        height: 100%; */
    
  </style>
</head>

<body>

  <div class="container mt-4" >
    <div class="page banner_img" style="">
      <div class="card w-85 m-auto" style="border:unset; box-shadow: 0 1rem 3rem rgba(0,0,0,.175)!important;">
        <div class="card-body p-4" >
          <div class=" p-3" style="border: 1px solid #000 !important;">
            <h5 class="card-title text-left">
                <div class="row align-items-center">
                    <div class="col-8 text-center">
                      <!-- <img src="<?= base_url()?>upload/assets/logo.png" alt="image" class="m-t-20 m-b-30" style="max-width: 250px;"> -->
                      <img src="<?= $logo; ?>" alt="image" class="m-t-20 m-b-30" style="max-width: 250px;">
                    </div>
                    <div class="col-4 text-right" >
                      <!-- <img src="<?= base_url()?>upload/assets/img2.jpeg" alt="image" class="m-t-20 m-b-30" style="max-width: 250px;"> -->
                      <img src="<?= $first_image; ?>" alt="image" class="m-t-20 m-b-30" style="max-width: 250px;">
                    </div>
                </div>
            </h5>
            <div class="row align-items-center">
                <div class="col-8">
                    <div class="card-text234" style="padding-left: 8%;">
                        <div class="for_length" style=""></div>
                        <div class="pl-3">
                        <h2 class="text-green text-left m-0"><i style="font-size:22px;"><span  style="font-size:24px;">•</span> 
                        <!-- <span class="font-700">ALL TYPES OF LOAN SERVICES</span> -->
                        <span class="font-700" style="color: <?= $text_color; ?>"><?= $title; ?></span>
                        </i></h2>
                        <h2 class="text-green text-left font-600 m-0"><i style="font-size:24px;"><span  style="font-size:25px;">•</span> 
                        <!-- <span class="font-700">COMMON SERVICES CENTER</span> -->
                        <span class="font-700" style="color: <?= $text_color; ?>"><?= $sub_title; ?></span>
                        </i></h2>
                        </div> 
                        <div class="for_length" style=""></div>
                        <p class="m-0 text-left font-bolder font-700" style="font-size: 18px;padding-top: 12px;"><u><i><?php echo isset($user['username']) ? $user['username'] : ''; ?></i></u></p>
                        <p style="margin:0;text-align:left;font-weight:700;font-size: 18px;padding-top: 12px;text-transform: uppercase;"><u><i><?= (isset($contactUs['comapany_title'])) ? $contactUs['comapany_title'] : '' ;?></i></u></p>
                        <div class="for_length" style=""></div>
                        <div class="for_length" style=""></div>
                        <p class="m-0 text-left font-bolder" style="font-size: 22px;padding-top: 12px;"><u><i><?php echo isset($user['mobile_no']) ? $user['mobile_no'] : ''; ?></u></i></p>
                        <div class="for_length" style=""></div>
                        <div class="for_length" style=""></div>
                        <p class="m-0 text-left font-bolder" style="font-size: 24px;padding-top: 12px;color:#007bff;"><u><i style=""><?php echo isset($user['email']) ? $user['email'] : '';; ?></u></i></p>
                        <div class="for_length" style=""></div>
                        <div class="for_length" style=""></div>
                        <p class="m-0 text-left font-bolder" style="font-size: 17px;padding-top: 12px;"><u><i>ADDRESS:- <?php echo isset($user['address']) ? $user['address'] : ''; ?></u></i></p>
                        <div class="for_length" style=""></div>
                        <div class="for_length" style=""></div>

                    </div>
                </div>
        <div class="card-text2 col-4 text-right">
            <!-- <img src="<?= base_url()?>upload/assets/img3.jpeg" alt="image" class="m-t-20 m-b-30" style="max-width: 250px;"> -->
            <img src="<?= $second_image ; ?>" alt="image" class="m-t-20 m-b-30" style="max-width: 250px;">
        </div>
    </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>

</html>