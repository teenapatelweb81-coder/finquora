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
<body>

  <div class="container mt-4">
    <div class="page">
        <div class="card m-auto" style="border:unset; box-shadow: 0 1rem 3rem rgba(0,0,0,.175)!important;">
        <div class="card-body p-4" >
          <div class=" p-3" style="padding-right: 0 !important;border: 1px solid #000 !important;">

    <table style="width:100%;">
        <tbody>

        <tr>
            
            <td >
                <div class="card-title text-center" style="background: #fff;padding: 10px;box-shadow: 0px 2px 9px 0px;border-radius: 44px 0px;width: fit-content;margin: 0 auto;">
                <?php

                 $img0 = '';
                  if (!empty($logo)) {
                      $image0 = @file_get_contents($logo);
                      if ($image0 !== false) {
                          $img0 = 'data:image/jpg;base64,' . base64_encode($image0);
                      }
                  }
                              
                ?>
                    <img src="<?= $img0?>" alt="image" class="m-t-20 m-b-30" style="max-width: 200px;padding: 25px 6px;">
                </div>
            </td>
            <td style="text-align:right;">
                <h5 class="card-title "style="text-align:center;">
                 <?php if (!empty($user['profile_photo'])) {
                    
                        $url1 = $user['profile_photo'];
                            $image1 = file_get_contents($url1);
                            if ($image1 !== false){
                                $img1 =  'data:image/jpg;base64,'.base64_encode($image1);

                            }
                    ?> 
                  <img src="<?php echo $img1; ?>" alt="img" class="m-t-20 m-b-30" style="width:1px;"> 
                 <?php }else{

                            $url2 = base_url('upload/assets/images/male.jpg');
                            $image2 = file_get_contents($url2);
                            if ($image2 !== false){
                                $img2 =  'data:image/jpg;base64,'.base64_encode($image2);

                            }

?>

                   <img src="<?php echo $img2 ?>" alt="" class="m-t-20 m-b-30" style="width:150px;">
                   <?php }?>
                </h5>
                 </td>
</tr>   
<tr>
            <td colspan="2" style="padding: 10px;">
                <div style="font-size: 15px; line-height: 1.4; color: #000;">
                    <?php
                    $domain_id = domain_id_get();
                    $admin = $this->db->where('type','admin')->where('role',1)->where('domain_id',$domain_id)->get('user_master')->row_array();
                    ?>
                    <p style="margin-left: 80px; margin-top: 0; margin-bottom: 10px;">
                        TO<br>
                        CEO<br>
                        FOUNDER NAME: <?= isset($admin['name']) ? $admin['name'] : '' ?><br>
                        <?= isset($contectUs['company_title']) && !empty($contectUs['company_title']) ? $contectUs['company_title'] : '' ?><br>
                        Add - <?= isset($user['address']) ? $user['address'] : '' ?><br>
                        Email - <?= isset($user['email']) ? $user['email'] : '' ?><br>
                        MOBILE NO: <?= isset($user['mobile_no']) ? $user['mobile_no'] : '' ?><br>
                        BRANCH MANAGER: <?= isset($user['username']) ? $user['username'] : '' ?>
                    </p>

                    <p style="text-align: center; font-size: 18px; font-weight: bold; text-decoration: underline; padding-top: 10px; margin: 10px 0;">
                        BRANCH CODE - <?= isset($user['code']) ? $user['code'] : '' ?>
                    </p>

                    <p style="margin-left: 80px; margin-top: 10px;">
                        <b>SUB:</b> Joining Letter<br><br>
                        <?php
                        if ($this->session->userdata('role') == 2) {
                            $b = 'DSA';
                        } else {
                            $b = 'BRANCH MANAGER';
                        }
                        ?>
                        Dear Sir/Ma’am,<br><br>
                        I am immensely pleased to inform you that I acknowledge the same. I am ready to join as a 
                        <b><?= $b ?></b> in your company 
                        <b><?= isset($contectUs['company_title']) ? $contectUs['company_title'] : '' ?></b>.<br><br>
                        <b>Date of Joining:</b> <?= isset($user['created_on']) ? date('d-m-Y', strtotime($user['created_on'])) : '' ?><br>
                        I sincerely thank you for believing in me and offering me this position. I assure to work with sincerity and dedication.
                        I will be submitting all the required documents on my joining date. Should you require any further information:<br><br>

                        <b>KYC Details</b><br>
                        Aadhar card: <?= isset($user['adharcard_no']) ? $user['adharcard_no'] : ''; ?><br>
                        PAN card: <?= isset($user['pan_card_number']) ? $user['pan_card_number'] : ''; ?><br>
                        Bank Account: <?= isset($user['bank_account_number']) ? $user['bank_account_number'] : ''; ?><br>
                        Mail ID: <?= isset($user['email']) ? $user['email'] : ''; ?><br>
                    </p>
                </div>
            </td>
        </tr>
    <tr>
        <td>
                <p style="margin-left: 80px;">THANKING YOU<br>

                <?php
                 $img4 = '';
        if (!empty($signature)) {
            $image1 = @file_get_contents($signature);
            if ($image1 !== false) {
                $img4 = 'data:image/jpg;base64,' . base64_encode($image1);
            }
        }
                ?>
                    FOUNDER SIGNATURE:<img src="<?= $img4 ?>" alt="" style="margin-left: 27px; margin-bottom: 10px;width: 100px;">
                </p>
        </td>
            <?php
             $img3 = '';
        if (!empty($ceal)) {
            $image3 = @file_get_contents($ceal);
            if ($image3 !== false) {
                $img3 = 'data:image/jpg;base64,' . base64_encode($image3);
            }
        }
                ?>
        <td style="text-align:right;"><img src="<?php echo $img3 ?>" alt="" style="width: 100px;"></td>
    </tr>

    <!-- <tr>
        <td>
            <div ></div>
        </td>
    </tr>   -->

                            </tbody>
    </table>
          </div>
        </div>
      </div>

    </div>
  </div>

</body>

</html>
<?php //die;?>