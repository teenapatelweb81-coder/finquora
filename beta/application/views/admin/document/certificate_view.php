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
?>

<body>

  

<table style="border:1px solid #000;padding:10px;">
    <tbody>
        <?php
        // Load logo image
        $img1 = '';
        if (!empty($logo)) {
            $image1 = @file_get_contents($logo);
            if ($image1 !== false) {
                $img1 = 'data:image/jpg;base64,' . base64_encode($image1);
            }
        }
        $img2 = '';
        if (!empty($document_image)) {
            $image2 = @file_get_contents($document_image);
            if ($image2 !== false) {
                $img2 = 'data:image/jpg;base64,' . base64_encode($image2);
            }
        }

        // Determine role
        $role = $this->session->userdata('role');
        $roleLabel = ($role == 2) ? 'DSA' : 'Branch Manager';

        // Get certificate details
        $title = isset($joiningCertificate['title']) ? $joiningCertificate['title'] : 'CERTIFICATE OF APPOINTMENT';
        $subTitle = isset($joiningCertificate['sub_title']) ? $joiningCertificate['sub_title'] : 'This certificate is presented to';
        $subTitleBranch = isset($joiningCertificate['sub_title_branch']) ? $joiningCertificate['sub_title_branch'] : 'This certificate is presented to';
        $textColor = isset($joiningCertificate['text_color']) ? $joiningCertificate['text_color'] : '#000';

        // Get user details
        $username = $this->session->userdata('username');
        $userAddress = isset($user['address']) ? $user['address'] : '';
        ?>

            <tr ><td class="card-title text-center"><img src="<?= $img1?>" alt="image" class="m-t-20 m-b-30"
              style="width:200px;"> <tr></td> 
            <div class="card-text">
              <div class="for_length" style=""></div>
              <h2 class="font-bolder" style="text-align:center; <?= $textColor ?>"><u><i style="font-size: 30px;"><?=  $title?></i></u></h2>
              <p class="m-0 font-bolder" style="font-size: 20px;padding-top: 12px;text-align:center;"><?= ($role == 2) ? $subTitle : $subTitleBranch;?></p>
             
              <p class="m-0  font-bolder" style="font-size: 26px;padding-top: 12px;text-align:center;"><i><?php echo $this->session->userdata('username'); ?></i></p>
           
              <p class="m-0 font-600" style="font-size: 24px;padding-top: 12px;"><i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; For His Appointment As A <?= isset($user['address']) ? $user['address'] : ''; ?> <?= $roleLabel ?> OF <?= isset($contectUs['company_title']) && !empty($contectUs['company_title']) ? $contectUs['company_title'] : '' ?></i></p>
        <div class="for_length" style=""></div>
              <div ><img src="<?= $img2?>" alt="image" class="m-t-20 m-b-30 w-100" style=" max-height: 200px; width:100%;object-fit: contain; "></div>
            </div>
</tbody>
</table>


</body>

</html>