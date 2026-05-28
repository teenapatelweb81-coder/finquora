<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
body , .page{
  background: #8cd4ea;
}
.form {
  font-family: Helvetica, sans-serif;
  max-width: 400px;
  margin-top: 100px;
  text-align: center;
  padding: 16px;
  background: #ffffff;
}
.form h1 {
  background: #03773f;
  padding: 20px 0;
  font-weight: 300;
  text-align: center;
  color: #fff;
  margin: -16px -16px 16px -16px;
  font-size:  25px;
}
.form input[type="text"],
.form input[type="url"] {
  box-sizing: border-box;
  width: 100%;
  background: #fff;
  margin-bottom: 4%;
  border: 1px solid #ccc;
  padding: 4%;
  font-size: 17px;
  color: rgb(9, 61, 125);
}
.form input[type="text"]:focus,
.form input[type="url"]:focus {
  box-shadow: 0 0 5px #5868bf;
  padding: 4%;
  border: 1px solid #5868bf;
}

.form button {
  box-sizing: border-box;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  width: 180px;
  margin: 0 auto;
  padding: 3%;
  background: #0853b6;
  border: none;
  border-radius: 3px;
  font-size: 17px;
  border-top-style: none;
  border-right-style: none;
  border-left-style: none;
  color: #fff;
  cursor: pointer;
}
.form button:hover {
  background: rgba(88,104,191, 0.5);
}
#qrcode-container{
    display:none;
}

.qrcode{
  padding: 16px;
  margin-bottom: 30px;
}
.qrcode img{
  margin: 0 auto;
  box-shadow: 0 0 10px rgba(67, 67, 68, 0.25);
  padding: 4px;
}

    </style>
</head>
<body>

<?php

if (isset($_GET['user_id'])) {
    $type = $_GET['user_id'];
} else {
    $type = '';
}
?>
    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>

<div style="display:flex; justify-content:center; gap:15px;">

<div class="form">
  <h1>QR Code Generator</h1>
  <form>
    <?php if ($_GET['type'] == 'pl') {?>
        <input type="url" id="website" name="website" required value="<?php echo base_url('admin/share-pl?user_id='); ?><?=$type?>&role=<?=$this->session->userdata('role')?>" disabled/>
    <?php } else {?>
        <input type="url" id="website" name="website" required value="<?php echo base_url('admin/share-bl?user_id='); ?><?=$type?>&role=<?=$this->session->userdata('role')?>" disabled/>
    <?php }?>

    <div id="qrcode-container">
        <div id="qrcode" class="qrcode"></div>
    </div>

    <button type="button" onclick="generateQRCode()" class="generate"> Generate QR Code</button>

    <!-- <button onclick="shareImage()">Share Image</button> -->

</form>
</div>

<div class="form">
  <h1>Link Copy</h1>
  <form>
  <?php if ($_GET['type'] == 'pl') {?>
        <input type="url" id="" name="" disabled placeholder="Copy Link" required value="<?php echo base_url('admin/share-pl?user_id='); ?><?=$type?>&role=<?=$this->session->userdata('role')?>"/>
        <button type="button" onclick="copyLink_share_pl('<?php echo base_url('admin/share-pl?user_id='); ?><?=$type?>&role=<?=$this->session->userdata('role')?>')" class="generate">Link Copy</button>
    <?php } else {?>
        <input type="url" id="" name="" disabled placeholder="Copy Link" required value="<?php echo base_url('admin/share-bl?user_id='); ?><?=$type?>&role=<?=$this->session->userdata('role')?>"/>
        <button type="button" onclick="copyLink_share_pl('<?php echo base_url('admin/share-bl?user_id='); ?><?=$type?>&role=<?=$this->session->userdata('role')?>')" class="generate">Link Copy</button>
    <?php }?>

</form>

</div>
</div>


  <script type="text/javascript">
    function generateQRCode() {
      let website = document.getElementById("website").value;
      if (website) {
        let qrcodeContainer = document.getElementById("qrcode");
        qrcodeContainer.innerHTML = "";
        new QRCode(qrcodeContainer, website);

        document.getElementById("qrcode-container").style.display = "block";

      } else {
        alert("Please enter a valid URL");
      }
    }

    function shareImage() {
            const imageUrl = document.getElementById('sharedImage').src;
            // alert(imageUrl);
            const shareText = 'Check out this image!';
            const shareUrl = 'whatsapp://send?text=' + encodeURIComponent(shareText + '\n' + imageUrl);
            // window.location.href = shareUrl;
    }

  </script>
</div>
</body>
</html>