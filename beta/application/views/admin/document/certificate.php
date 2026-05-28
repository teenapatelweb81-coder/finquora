<!DOCTYPE html>
<html lang="en">

<head>
  <title>Certificate</title>
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
// $id = print_r($this->session->userdata('user_id'));
// $a = $this->db->where('id',$id)->get('user_master')->row_array();
// print_r($a);die;
if ($this->session->userdata('role') == 2) {
                                    $a = 'DSA';
                                }else {
                                    $a = 'Branch Manager';
                                }
?>

<body>

  <div class="container mt-4">
    <div class="page">
      <div class="card w-100 m-auto" style="border:unset; box-shadow: 0 1rem 3rem rgba(0,0,0,.175)!important;">
        <div class="card-body p-4" >
          <div class=" p-3" style="padding-right: 0 !important;border: 1px solid #000 !important;">
            <h5 class="card-title text-center;width:100%;">
              <!-- <img src="<?= base_url()?>upload/assets/logo.png" alt="" class="m-t-20 m-b-30" style="max-width: 250px;"> -->
              <img src="<?= $logo; ?>" alt="" class="m-t-20 m-b-30" style="max-width: 250px;">

            </h5>
            <div class="card-text">
              <div class="for_length" style=""></div>
              <!-- <h2 class="text-green text-center font-bolder"><u><i style="font-size: 40px;">CERTIFICATE OF APPOINTMENT</i></u></h2> -->
              <h2 class="text-center font-bolder" style='color: <?php echo isset($joiningCertificate['text_color']) ? $joiningCertificate['text_color'] : '#000'; ?>;'><u><i style="font-size: 40px;"><?php echo isset($joiningCertificate['title']) ? $joiningCertificate['title'] : 'CERTIFICATE OF APPOINTMENT'; ?></i></u></h2>
              <!-- <p class="m-0 text-center font-bolder" style="font-size: 20px;padding-top: 12px;">This certificate is presented to</p> -->
              <?php  if ($this->session->userdata('role') == 2) { ?>
              <p class="m-0 text-center font-bolder" style="font-size: 20px;padding-top: 12px;"><?php echo isset($joiningCertificate['sub_title']) ? $joiningCertificate['sub_title'] : 'This certificate is presented to'; ?></p>
              <?php }else{?>
              <p class="m-0 text-center font-bolder" style="font-size: 20px;padding-top: 12px;"><?php echo isset($joiningCertificate['sub_title_branch']) ? $joiningCertificate['sub_title_branch'] : 'This certificate is presented to'; ?></p>
              <?php }?>
              <div class="for_length" style=""></div>
              <div class="for_length" style=""></div>
              <p class="m-0 text-center font-bolder" style="font-size: 26px;padding-top: 12px;"><i><?php echo $this->session->userdata('username'); ?></i></p>
              <div class="for_length" style=""></div>
              <div class="for_length" style=""></div>
               <p class="m-0 font-600" style="font-size: 24px;padding-top: 12px;"><i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; For His Appointment As A <?= isset($user['address']) ? $user['address'] : ''; ?> <?= $a?> <?= isset($contectUs['company_title']) && !empty($contectUs['company_title']) ? $contectUs['company_title'] : '' ?></i></p>
              <div class="for_length" style=""></div><div class="for_length" style=""></div>
              <!-- <div ><img src="<?= base_url()?>upload/assets/img.jpeg" alt="" class="m-t-20 m-b-30 w-100" ></div> -->
              <div><img src="<?= $document_image; ?>" style="object-fit: contain; " alt="" class="m-t-20 m-b-30 w-100"></div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>

</html>