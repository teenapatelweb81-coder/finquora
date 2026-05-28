<!DOCTYPE html>
<html lang="en">

<?php //echo '<pre>'; print_r($user);die();?>
<head>
  <title>ID card</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

  <style>
    .img img{
        width: 89%;
        overflow: hidden;
        border-top: 0 !important;
        border: 2px solid #4472c4;
        padding: 10px 30px;
        border-radius: 20px 0 20px 0;
    }
    .pro_img img{
        border-radius: 50%;
        height: 180px;
        width: 180px;
        }
        .h_30{
            height:30px;
        }
       .pro_img_text h4{
        background: #ffd966;
        padding: 10px;
        border-color: #000 !important;
       }
       .pro_d_box {
            font-weight: 600;
            border-color: #000 !important;
            background: #4472c4;
            font-size: 17px;
        }
  </style>
</head>
<body>
  <div class="ml-2" ></div>
<div class="container ">
    <div class="w-50 m-auto" style="border: 4px solid #000;">
        <div class="main_div">
            <div class="row">
                <div class="col-2">
                    <div class="image_left">
                        <img src="<?= base_url()?>upload/assets/left-bg.jpeg" alt="InstantLoanDeals" width="115px">
                    </div>
                </div>
                <div class="col-10">
                    <div class="img">
                        <img src="<?= base_url()?>upload/assets/logo.png" alt="InstantLoanDeals">
                    </div>
                    
                    <div class="h_30" ></div>
                    <div class=" w-75  text-center" style="margin-left: 5%;">
                        <div class="pro_img">
                             <?php 
                                if (!empty($user['profile_photo'])) {?> 
                            <img src="<?= base_url($user['profile_photo']); ?>" alt="profile photo" class="img-thumbnail" style="max-width: 150px; max-height: 150px;">
                            <?php }else{?>
                             <img src="<?php echo base_url('upload/assets/images/male.jpg') ?>" alt="profile photo">
                             <?php }?>

                        </div>
                        <div class="h_30"></div>
                        <div class="pro_img_text">
                            <h4 class="border"><b>Team Member</b></h4>
                        </div>

                        <div class="pro_d_box border px-4 py-2 font-bold mb-2">
                            <p class="text-left">NAME : <?php echo $user['username']; ?></p>
                            <p class="text-left">MEMBERSHIP CODE : <?php echo $user['code']; ?></p>
                            <p class="text-left">MAIL ID : <?php echo $user['email']; ?></p>
                            <p class="text-left">MOBILE NO :<?php echo $user['mobile_no']; ?></p>
                        </div>

                        <div class="pro_img_text">
                            <h4 class="border"><b> <?php echo str_replace('/beta/', '/', base_url()) ?></b></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
