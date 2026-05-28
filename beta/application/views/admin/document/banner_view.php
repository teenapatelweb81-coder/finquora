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

<body style=" font-family: sans-serif;">

                    <?php
                        $img1 = '';
                        if (!empty($logo)) {
                            $image1 = @file_get_contents($logo);
                            if ($image1 !== false) {
                                $img1 = 'data:image/jpg;base64,' . base64_encode($image1);
                            }
                        }
                        $img2 = '';
                        if (!empty($first_image)) {
                            $image2 = @file_get_contents($first_image);
                            if ($image2 !== false) {
                                $img2 = 'data:image/jpg;base64,' . base64_encode($image2);
                            }
                        }

                        $img3 = '';
                        if (!empty($second_image)) {
                            $image3 = @file_get_contents($second_image);
                            if ($image3 !== false) {
                                $img3 = 'data:image/jpg;base64,' . base64_encode($image3);
                            }
                        }

                    ?>

  <div class="container mt-4" >
    <div class="page banner_img" style="">
      <div class="card w-85 " style="border:unset; box-shadow: 0 1rem 3rem rgba(0,0,0,.175)!important;margin:0 auto;">
        <div class="card-body p-4" >
          <div class="" style="border: 1px solid #000 !important;padding:16px;">

    <table style="width:100%;">
    <tbody>
        <tr>
            <td style="width:50%;text-align:center;"><div style="text-align:right;"><img src="<?= $img1?>" alt="img" style="max-width: 300px;"></div> </td>
            <td style="width:50%;text-align:right;"><div style="text-align:right;" ><img src="<?= $img2?>"  alt="img" style="max-width: 300px;"></div></td>
        </tr>

 </tr>
    <td class="">
                    <div class="card-text234" style="padding-left: 8%;">
                        <div class="for_length" style=""></div>
                        <div class="pl-3">
                        <h2 class="text-green text-left" style="margin:0;"><i style="font-size:22px;"><span  style="font-size:24px;color: <?= $text_color; ?>">•</span> <span class="font-700" style="color: <?= $text_color; ?>"><?= $title; ?></span></i></h2>
                        <h2 class="text-green text-left font-600 "style="margin:0;"><i style="font-size:24px;"><span  style="font-size:25px;color: <?= $text_color; ?>">•</span> <span class="font-700" style="color: <?= $text_color; ?>"><?= $sub_title; ?></span></i></h2>
                        </div> 
                        <div class="for_length" style=""></div>
                        <p style="margin:0;text-align:left;font-weight:700;font-size: 18px;padding-top: 12px;"><u><i><?php echo  isset($user['username']) ? $user['username'] : ''; ?></i></u></p>
                        <p style="margin:0;text-align:left;font-weight:700;font-size: 18px;padding-top: 12px;text-transform: uppercase;"><u><i><?= (isset($contactUs['comapany_title'])) ? $contactUs['comapany_title'] : '' ;?></i></u></p>
                        <div class="for_length" style=""></div>
                        <p class="m-0 text-left font-bolder" style="font-size: 22px;padding-top: 12px;"><u><i><?php echo  isset($user['mobile_no']) ? $user['mobile_no'] : ''; ?></u></i></p>
                        <div class="for_length" style=""></div>
                        <p class="m-0 text-left font-bolder" style="font-size: 24px;padding-top: 12px;color:#007bff;"><u><i style=""><?php echo  isset($user['email']) ? $user['email'] : '';; ?></u></i></p>
                        <div class="for_length" style=""></div>
                        <p  style="margin:0;text-align:left;font-weight:700;font-size: 17px;padding-top: 12px;"><u><i>ADDRESS:- <?php echo  isset($user['address']) ? $user['address'] : ''; ?></u></i></p>
                        <div class="for_length" style=""></div>

                    </div>
     </td>
        <td class="card-text2" style=" text-align:right">
            <img src="<?= $img3?>" alt="image" class="m-t-20 m-b-30" style="max-width: 300px;">
             <div class="for_length" style=""></div>
                        </td>
    </td> 
</tr>
                        </tbody>
                        </table>


          </div>
        </div>
      </div>
    </div>
  </div>

</body>

</html>