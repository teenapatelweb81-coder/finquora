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
 
  </style>
</head>
                <?php
                 $img1 = '';
                  if (!empty($logo)) {
                      $image1 = @file_get_contents($logo);
                      if ($image1 !== false) {
                          $img1 = 'data:image/jpg;base64,' . base64_encode($image1);
                      }
                  }
                  
                $url2 = base_url('upload/assets/img1_cropped.jpeg');
                $image2 = file_get_contents($url2);
                if ($image2 !== false){
                    $img2 =  'data:image/jpg;base64,'.base64_encode($image2);

                }
                ?>

<body style=" font-family: sans-serif;">
<div class="container mt-4">

<table width="80%" align="center" style="
    border: 1px solid black;
">
    <tbody>
        <tr align="center">
            <td>
            <div class="card-title text-center" style="width:100%;margin-bottom:10px;"><img src="<?= $img1 ?>" alt="" class="m-t-20 m-b-30"
                      style="max-width: 300px;">
</div>
            </td>
        </tr>
        <tr align="center">
            <td>
            <p class="m-0 text-center font-bolder" style="font-size: 18px;margin:0px;"><u><i><?php echo isset($user['username']) ? $user['username'] : ''; ?></i></u></p>
            </td>
        </tr>
        <tr align="center">
            <td>
            <p class="m-0 text-center font-bolder" style="font-size: 18px;color:#031eff;"><u><i><?php echo isset($user['email']) ? $user['email'] : ''; ?></i></u></p><div class="for_length" style=""></div>
            </td>
        </tr>
        <tr align="center">
            <td>
            <p class="text-center font-bolder" style="font-size: 18px; margin:0;"><i><?php echo isset($user['mobile_no']) ? $user['mobile_no'] : ''; ?></i></p>
            </td>
        </tr>
        <tr align="center">
            <td style="padding: 0;">
              <?php if (empty($visitingCard['background_color']) || $visitingCard['background_color'] == '1'): ?>
                      <img src="<?= $img2?>" alt="" class="m-t-20 w-100 m-b-30">
                  <?php else: ?>
                      <div class="curved" style="width: 100%; height: 125px; background: <?= $visitingCard['background_color']; ?>; border-bottom: 1px solid black; width: 100%;height: 130px;clip-path: polygon(0px 0, 21% 50%, 64% 12%, 100% 0, 100% 100%, 0 100%) !important;"></div>
                  <?php endif; ?>

            <!-- <img src="<?= $img2?>" alt="" class="m-t-20 w-100 m-b-30">  -->
            </td>
        </tr>
    </tbody>
</table>

<table width="80%" align="center" style="
     margin-top: 20px; border: 1px solid black; 
" >
    <tbody style="
    background: <?php echo isset($visitingCard['background_color']) ? $visitingCard['background_color'] : '#00883c'; ?>
">
        <tr>
          <td style="margin:0;"> <p class=" " style="font-size: 14px;padding-top: 10px;   margin-bottom:0;  padding-left: 20px;background: <?php echo isset($visitingCard['background_color']) ? $visitingCard['background_color'] : '#00883c'; ?>">
            <p class="" style="padding-top: 10px;     padding-left: 20px; margin-bottom:0;color: <?php echo isset($visitingCard['text_color']) ? $visitingCard['text_color'] : '#212529'; ?>;background: <?php echo isset($visitingCard['background_color']) ? $visitingCard['background_color'] : '#00883c'; ?>"><i>Legal Disclaimer</i></p>
            
            <p class="" style="padding-top: 10px;     padding-left: 20px; margin-bottom:0;color: <?php echo isset($visitingCard['text_color']) ? $visitingCard['text_color'] : '#212529'; ?>;background: <?php echo isset($visitingCard['background_color']) ? $visitingCard['background_color'] : '#00883c'; ?>">
              
             <?php 
                if ($this->session->userdata('role') == 2) { ?>
                  ___We do NOT collect Any Advance payment.
Loan approval, rate of interest & terms are decided by the lending bank & Instant Loans deals._We follow 100% transparent & bank-authorized DSA process.

              <?php  }else { ?>
                   _Do NOT pay any advance fees to anyone.
Our franchise/services follow authorized banking procedures only. Loan approval, processing time & terms are solely determined by the lending bank/NBFC. Instant loans Deals_

             <?php }?>
              </p>
        
              <p class="" style="font-size: 17px;padding-top: 10px;  margin-bottom:0;  padding-left: 20px;color: <?php echo isset($visitingCard['text_color']) ? $visitingCard['text_color'] : '#212529'; ?>;background: <?php echo isset($visitingCard['background_color']) ? $visitingCard['background_color'] : '#00883c'; ?>"><i><?php echo isset($user['mobile_no']) ? $user['mobile_no'] : ''; ?></i></p>
        
         
              <p class=" " style="padding-top: 10px;font-size: 17px;   margin-bottom:0;   padding-left: 20px;  letter-spacing: 4px;color: <?php echo isset($visitingCard['text_color']) ? $visitingCard['text_color'] : '#212529'; ?>;background: <?php echo isset($visitingCard['background_color']) ? $visitingCard['background_color'] : '#00883c'; ?>"><u>ADD- <?php echo isset($user['address']) ? $user['address'] : '' ; ?></u></p>
        
         
              <?php 
                if ($this->session->userdata('role') == 2) {
                  $a = 'DSA';
                }else {
                  $a = 'Branch Manager (Franchise Partner)';
                }
              ?>

                <p class="m-0 font-bolder" style="padding-top: 12px;font-size: 17px;font-weight: bolder;  padding-left: 20px;"color: <?php echo isset($visitingCard['text_color']) ? $visitingCard['text_color'] : '#212529'; ?>;background: <?php echo isset($visitingCard['background_color']) ? $visitingCard['background_color'] : '#00883c'; ?>><u><i>AUTHORIZE <?= $a?></i></u></p>
                <div class="for_length" style=""></div>
                <div class="for_length" style=""></div>
              </div>
            </div>
          </div>

    </div>
</div>

  </body>
  
  </html>