<!DOCTYPE html>
<html lang="en">

<head>
  <title>Joining Letter</title>
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

<body style="width: 70%;margin: auto;">


  <div class="container mt-4">
    <div class="page">
      <div class="card w-100 m-auto" style="border:unset; box-shadow: 0 1rem 3rem rgba(0,0,0,.175)!important;">
        <div class="card-body p-4" >
          <div class=" p-3" style="padding-right: 0 !important;border: 1px solid #000 !important;">
            <div class="row">
            <div class="col-sm-6">
            <h5 class="card-title text-center" style="background: #fff;width: 326px;margin-top: 43px;box-shadow: 0px 2px 9px 0px;border-radius: 44px 0px;margin-left: 60px;">
              <!-- <img src="<?= base_url()?>upload/assets/logo.png" alt="" class="m-t-20 m-b-30"
              style="max-width: 300px;margin-top: 11px;margin-left: 8px;padding: 27px 6px;box-shadow: inset;border-radius: 30px 2px;border: 1px solid black;"> -->
              <img src="<?= $logo; ?>" alt="" class="m-t-20 m-b-30"
              style="max-width: 300px;margin-top: 11px;margin-left: 8px;padding: 27px 6px;box-shadow: inset;border-radius: 30px 2px;border: 1px solid black;">
            </h5>
            </div>
            <div class="col-sm-6">
                <h5 class="card-title text-center">
                 <?php if (!empty($user['profile_photo'])) {?> 
                  <img src="../<?php echo $user['profile_photo']; ?>" alt="" class="m-t-20 m-b-30" style="max-width: 200px; margin-top: 45px;">
                 <?php }else{?>
                   <img src="<?php echo base_url('upload/assets/images/male.jpg') ?>" alt="" class="m-t-20 m-b-30" style="max-width: 200px; margin-top: 45px;">
                   <?php }?>
                </h5>
                </div>
            </div>    
            <div class="card-text">
                <?php 
                
              $domain_id = domain_id_get();
              $admin = $this->db->where('type','admin')->where('role',1)->where('domain_id',$domain_id)->get('user_master')->row_array()
              ?>
              <div class="for_length" style=""></div>
              <p style="margin-left: 80px;">TO<br>CEO<br>FOUNDAR NAME : <?= isset($admin['name']) ? $admin['name'] : '' ?><br><?= isset($contactUs['company_name']) ? $contactUs['company_name'] : ''?><br>
               Add- <?= isset($user['address']) ? $user['address'] : '' ?> <br>
               Email- <?= isset($user['email']) ? $user['email'] : '' ?> <br>
                MOBILE NO: <?= isset($user['mobile_no']) ? $user['mobile_no'] : '' ?> ; <br>
                BRANCH MANAGER: <?= isset($user['username']) ? $user['username'] : '' ?>  </p>
                                
              <p class="m-0 text-center" style="font-size: 20px;padding-top: 12px;">BRANCH CODE - <?= isset($user['code']) ? $user['code'] : '' ?>

</p>
              <p style="margin-left: 80px;"><br>SUB:- joining letter<br>
              
                                <?php 
                                if ($this->session->userdata('role') == 2) {
                                    $b = 'DSA';
                                }else {
                                    $b = 'BRANCH MANAGER';
                                }
                                ?>
                Dear Sir/Ma’am<br>
                I am immensely pleased to inform you that i acknowledge the same. i am ready to join as a <?= $b?> in your company <?= isset($contactUs['company_title']) && !empty($contactUs['company_title']) ? $contactUs['company_title'] : ''?>. (date of joining) <?= isset($user['created_on']) ?  date('d-m-Y', strtotime($user['created_on'])) : '' ?> sincerely thank
                you for believing in me and offering me this Position. i assure to work with sincerely and Dedication
                I will be submitting all the required documents on my joining date. Should you require any further
                information
                <div style="margin-left: 80px;">
                <?php //if (!empty($description)) {
                    //echo htmlspecialchars_decode($description); 
                //} else {
                  //  echo "<p>No description available.</p>";
                //} ?>
               KYC -Aadhar card: <?= isset($user['adharcard_no']) ? $user['adharcard_no'] : ''; ?><br>
                Pan card: <?= isset($user['pan_card_number']) ? $user['pan_card_number'] : ''; ?><br>
                Bank account: <?= isset($user['bank_account_number']) ? $user['bank_account_number'] : ''; ?><br>
                MAIL ID: <?= isset($user['email']) ? $user['email'] : ''; ?><br>

                </div>
                <p style="margin-left: 80px;"><br><br>THANKING YOU<br>
                    FOUNDER SIGNATURE:
                    <!-- <img src="<?php echo base_url('upload/assets/images/signed.png') ?>" alt="" style="margin-left: 27px; margin-bottom: 10px;"> -->
                    <img src="<?php echo $signature; ?>" alt="" style="margin-left: 27px;margin-bottom: 10px;max-width: 200px;">
                </p>
              <div style="text-align: end;">
                <!-- <img src="<?php echo base_url('upload/assets/images/ceal.png') ?>" alt="" style="width: 300px;height: 200px;"> -->
                <img src="<?php echo $ceal; ?>" alt="" style="width: 300px;height: 200px;"><br>
                <!-- <img src="<?php echo $signature; ?>" alt="" style="max-width: 200px;"> -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>

</html>