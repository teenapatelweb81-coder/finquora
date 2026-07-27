<!DOCTYPE html>
<html lang="en">

<?php //echo '<pre>'; print_r($user);die();?>

<head>
  <title>Visiting Card</title>
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
    }
    .custom-card {
      padding-right: 0 !important;
      border: 1px solid #000;
      /* background: #00883c; */
    }
    /* clip-path: polygon(0px 0, 21% 50%, 64% 12%, 100% 0, 100% 100%, 0 100%); */
    .wave{
      width: 100%;height: 125px;border-bottom: 1px solid black;width: 100%;height: 130px;background: #00883c;border-bottom: 1px solid black;z-index: 99999;
    }
  </style>
</head>


<body>
<div class="container mt-4">
    <div class="page">
        <div class="card w-100 m-auto" style="border:unset; box-shadow: 0 1rem 3rem rgba(0,0,0,.175)!important;">
            <div class="card-body p-4" style="padding-bottom:unset !important;">
                <div class="w-75 m-auto" style="padding-right: 0 !important;border: 1px solid #000;border-bottom: unset;">
                  <div class="for_length" style=""></div> 
                  <h5 class="card-title text-center" style="width:100%;">
                    <!-- <img src="<?= base_url()?>upload/assets/logo.png" alt="" class="m-t-20 m-b-30" style="max-width: 300px;"> -->
                    <img src="<?= $logo; ?>" alt="" class="m-t-20 m-b-30" style="max-width: 300px;">
                   </h5>
                  <div class="for_length" style=""></div> 
                    <p class="m-0 text-center font-bolder" style="font-size: 18px;padding-top: 12px;"><u><i><?php echo isset($user['username']) ? $user['username'] : ''; ?></i></u></p>
                    <div class="for_length" style=""></div>
                    <p class="m-0 text-center font-bolder" style="font-size: 18px;padding-top: 12px;color:#031eff;"><u><i><?php echo isset($user['email']) ? $user['email'] : '';; ?></i></u></p><div class="for_length" style=""></div>
                    <p class="m-0 text-center font-bolder" style="font-size: 18px;padding-top: 12px;"><i><?php echo isset($user['mobile_no']) ? $user['mobile_no'] : ''; ?></i></p>
                    <!-- <img src="<?= base_url()?>upload/assets/img1.jpeg" alt="" class="m-t-20 w-100 m-b-30"> -->

                    <?php if (empty($visitingCard['top_background_color']) || $visitingCard['top_background_color'] == '1'): ?>
                      <img src="<?= base_url() ?>upload/assets/img1.jpeg" alt="" class="m-t-20 w-100 m-b-30">
                  <?php else: ?>
                      <div class="wave" style="width: 100%; height: 125px; background: <?= $visitingCard['top_background_color']; ?>; border-bottom: 1px solid black;" ></div>
                  <?php endif; ?>

                  </div>
            </div>
        </div>
          <div class="card w-100 m-auto" style="border:unset; box-shadow: 0 1rem 3rem rgba(0,0,0,.175)!important;">
            <div class="card-body p-4">
              <div class="p-4 w-75 m-auto custom-card" style="background: <?php echo isset($visitingCard['background_color']) ? $visitingCard['background_color'] : '#00883c'; ?>">
                <p class="m-0 font-bolder" style="padding-top: 12px;color: <?php echo isset($visitingCard['text_color']) ? $visitingCard['text_color'] : '#212529'; ?>;"><i>Legal Disclaimer</i></p>
                <!-- <p class="m-0 font-bolder" style="font-size: 14px;padding-top: 12px;">
                  If undelivered please note - info@.com</p> -->
                  <p class="m-0 font-bolder" style="font-size: 14px;padding-top: 12px;color: <?php echo isset($visitingCard['text_color']) ? $visitingCard['text_color'] : '#212529'; ?>;">
                 <?php 
                  if ($this->session->userdata('role') == 2) { ?>
                    ___We do NOT collect Any Advance payment.Loan approval, rate of interest & terms are decided by the lending bank & Instant Loans deals._We follow 100% transparent & bank-authorized DSA process.

                  <?php  }else { ?>
                      _Do NOT pay any advance fees to anyone. Our franchise/services follow authorized banking procedures only. Loan approval, processing time & terms are solely determined by the lending bank/NBFC. Instant loans Deals_

                <?php }?> 
                </p>
                <div class="for_length" style=""></div>
                <p class="m-0 font-bolder" style="padding-top: 12px;font-size: 22px;color: <?php echo isset($visitingCard['text_color']) ? $visitingCard['text_color'] : '#212529'; ?>;"><i><?php echo isset($user['username']) ? $user['username'] : ''; ?></i></p>
                <p class="m-0 font-bolder" style="font-size: 17px;padding-top: 12px;color: <?php echo isset($visitingCard['text_color']) ? $visitingCard['text_color'] : '#212529'; ?>;"><i>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo isset($user['mobile_no']) ? $user['mobile_no'] : ''; ?></i></p>
                <div class="for_length" style=""></div>
                <p class="m-0 font-bolder" style="padding-top: 12px;font-size: 19px;    letter-spacing: 4px;color: <?php echo isset($visitingCard['text_color']) ? $visitingCard['text_color'] : '#212529'; ?>;"><u>ADD- <?php echo isset($user['address']) ? $user['address'] : ''; ?></u></p>
                <?php 
                  if ($this->session->userdata('role') == 2) {
                    $a = 'DSA';
                  }else {
                    $a = 'Branch Manager (Franchise Partner)';
                  }
                ?>

                <p class="m-0 font-bolder" style="padding-top: 12px;font-size: 17px;font-weight: bolder;color: <?php echo isset($visitingCard['text_color']) ? $visitingCard['text_color'] : '#212529'; ?>;"><u><i>AUTHORIZE <?= $a?></i></u></p>
                <div class="for_length" style=""></div>
                <div class="for_length" style=""></div>
              </div>
            </div>
          </div>

    </div>
</div>

  </body>
  
  </html>