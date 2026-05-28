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
    .pro_img img{
        border-radius: 50%;
        /* height: 180px; */
        width: 180px;
        }
        /* .h_30{
            height:30px;
        } */
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


<body style="width:80%;margin:0 auto;" >
    <?php
    
    
                        $url0 = base_url('upload/assets/left-bg.jpeg');
                            $image0 = file_get_contents($url0);
                            if ($image0 !== false){
                                $img0 =  'data:image/jpg;base64,'.base64_encode($image0);

                            }
                          $img1 = '';
                            if (isset($logo)) {
                                $image1 = @file_get_contents($logo);
                                if ($image1 !== false) {
                                    $img1 = 'data:image/jpg;base64,' . base64_encode($image1);
                                }
                            }

                             $url2 = base_url('upload/assets/images/male.jpg');
                            $image2 = file_get_contents($url2);
                            if ($image2 !== false){
                                $img2 =  'data:image/jpg;base64,'.base64_encode($image2);

                            }

                            if (isset($user['profile_photo'])) {
                             $url3 = $user['profile_photo'];
                            $image3 = file_get_contents($url3);
                            if ($image3 !== false){
                                $img3 =  'data:image/jpg;base64,'.base64_encode($image3);

                            }

                           }
    ?>

<table style="border:4px solid #000;">
     <tbody>

            <tr >
                <td style="width:10%;">
                    <?php
                    $bgColor = isset($idCard['side_background_color']) ? $idCard['side_background_color'] : '';
                    $isColorSet = isset($bgColor);
                    ?>
                    <div class="image_left" style="<?php if($isColorSet): ?>background: <?= $bgColor ?>;<?php endif; ?>">
                        <?php if(!$isColorSet): ?>
                        <img src="<?= $img0?>" alt="image" style="width:110px;" >
                         <?php endif; ?>
                    </div>
                </td>

                <td style="width:80%;text-align:center;">
                    <div class="img">
                        <img src="<?= $img1?>" alt="image" style="width: 65%;overflow: hidden; border-top: 0 !important; border: 2px solid #4472c4; padding: 10px 20px; border-radius: 20px 0 20px 0;margin:0 auto;" >
                    </div>
                    
                    <div style=" height:20px;" ></div>
                    <div class="" style=";text-align:center;">
                        <div class="pro_img" style="width:100%;margin:0 auto;">
                             <?php 
                                if (isset($user['profile_photo'])) {?> 
                            <img src="<?php echo $img3 ?>" alt="profile photo" style="width:40%;height:18%;">
                            <?php }else{?>
                             <img src="<?php echo $img2 ?>" alt="profile photo"  style="width:40%;height:18%;">
                             <?php }?>

                        </div>
                        <div style=" height:20px;" ></div>
                        <div class="pro_img_text">
                            <?php 
                                if ($this->session->userdata('role') == 2) {
                                    $a = 'DSA';
                                }else {
                                    $a = 'Branch Manager';
                                }
                                ?>
                            <h4 class="border" style="width:85%; color: <?php echo isset($idCard['text_color']) ? $idCard['text_color'] : '#000'; ?>"><b><?= $a?></b></h4>
                        </div>

                        <div class="pro_d_box " style="margin-bottom:6px;padding:10px 20px;border:1px solid #000; width:80%;">
                            <p style="text-align:left;color: <?php echo isset($idCard['text_color']) ? $idCard['text_color'] : '#000'; ?>">NAME : <?php echo isset($user['username']) ? $user['username'] : ''; ?></p>
                            <p style="text-align:left;color: <?php echo isset($idCard['text_color']) ? $idCard['text_color'] : '#000'; ?>">MEMBERSHIP CODE : <?php echo isset($user['code']) ? $user['code'] : ''; ?></p>
                            <p style="text-align:left;color: <?php echo isset($idCard['text_color']) ? $idCard['text_color'] : '#000'; ?>">MAIL ID : <?php echo isset($user['email']) ? $user['email'] : ''; ?></p>
                            <p style="text-align:left;color: <?php echo isset($idCard['text_color']) ? $idCard['text_color'] : '#000'; ?>">MOBILE NO :<?php echo isset($user['mobile_no']) ? $user['mobile_no'] : ''; ?></p>
                        </div>

                        <div class="pro_img_text">
                            <h4 class="border" style="word-break: break-word;font-size:14px;text-align:center;color: <?php echo isset($idCard['text_color']) ? $idCard['text_color'] : '#000'; ?>" ><b><?php echo $company_url; ?></b></h4>
                        </div>
                    </td>
                </tr>

       </tbody>    
  </table>  
        

</body>
</html>
