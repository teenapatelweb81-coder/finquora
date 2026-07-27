<style>
     .body-thanks {
      padding: 100px 0;
      font-family: "Poppins", sans-serif;
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
    } 

    

    .container-boxs {
      text-align: center;
      position: relative;
      background: #ffffff;
      padding: 60px 40px;
      border-radius: 12px;
      box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
    }

    .checkmark {
      font-size: 50px;
      color: <?= isset($heading->color) ? $heading->color : ''?>;
    }

    h1 {
      margin-top: 15px;
      font-size: 32px;
      color: #222;
    }

    p {
      font-size: 15px;
      color: #555;
      margin-bottom: 40px;
      line-height: 1.6;
    }

    .cards {
      display: flex;
      justify-content: center;
      gap: 20px;
      flex-wrap: wrap;
    }

    .card {
      background: #fff;
      border: 1px solid #eee;
      border-radius: 10px;
      padding: 20px;
      width: 100%;
      box-shadow: 0 3px 6px rgba(0,0,0,0.05);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
      transform: translateY(-4px);
      box-shadow: 0 6px 10px rgba(0,0,0,0.1);
    }

    .card h3 {
      font-size: 16px;
      margin-bottom: 15px;
      color: #333;
    }

  
    .text-color{
      color: <?= isset($heading->color) ? $heading->color : ''?>;

    }
    .visit-btn {
      background: <?= isset($heading->color) ? $heading->color : ''?>;
      color: #fff;
      border: none;
      border-radius: 6px;
      padding: 10px 18px;
      font-size: 15px;
      cursor: pointer;
      transition: background 0.3s ease;
      text-decoration: none;
      display: inline-block;
    }

    .visit-btn:hover {
      background: <?= isset($heading->color) ? $heading->color : ''?>;
    }

    /* ✅ Responsive Design */
    @media (max-width: 768px) {
      .container-boxs {
        padding: 40px 25px;
      }

      h1 {
        font-size: 26px;
      }

      p {
        font-size: 14px;
      }

      .cards {
        flex-direction: column;
        align-items: center;
      }

      .card {
        width: 90%;
        margin-bottom: 15px;
      }
      .qrcode img{
          width: 100% !important;
          margin: 10px auto;
      }
      .copy-image{
        font-size: 50px; 
        padding: 8px !important;
      }
    }

    @media (max-width: 480px) {
      .checkmark {
        font-size: 40px;
      }

      h1 {
        font-size: 24px;
      }

      p {
        font-size: 13px;
      }
    }
    .qrcode img{
        width: 200px;
        margin: 10px auto;
    }
    .copy-image{
      font-size: 110px; 
      padding: 50px !important;
    }
  </style>

  <!-- Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

  <div class="body-thanks">

  <div class="container-boxs  w-75 m-auto">
    <div class="checkmark"><i class="fas fa-check-circle"></i></div>
    <h1><?= isset($heading->title) ? $heading->title : 'Thank you !'?></h1>
    <p><?= isset($heading->description) ? $heading->description : 'Scan the QR code or copy the link below to open your Lead Panel and manage your leads easily.'?></p>
    
    
    <div class="row m-0">
        <div class="col-md-6">
            <div class="card ">
                <h3>Scan our Qr</h3>
                <input type="url" id="website" name="website"  class="mb-1 form-control" disabled value="<?= isset($lead['url']) ? $lead['url'] : '' ; ?>">
                <div id="qrcode-container">
                    <div id="qrcode" class="qrcode text-center mb-2" ></div>
                </div>
                <button type="button" onclick="generateQRCode()" class="generate visit-btn"> Generate QR Code</button>
            </div>
        </div>
      
        <div class=" col-md-6">
            <div class="card ">
                <h3>Copy the link</h3>

                <div class="input-group">
                  <input type="url" 
                        id="leadLink"
                        class="form-control" 
                        placeholder="Copy Link" 
                        value="<?= isset($lead['url']) ? $lead['url'] : '' ; ?>" 
                        disabled 
                        required>
                  <div class="input-group-append">
                    <button class="btn btn-primary" type="button" id="copyBtn">Copy</button>
                  </div>
                </div>
  <i class="fa fa-link p-2 text-color copy-image" style=" "></i>
                <a href="<?= isset($lead['url']) ? $lead['url'] : '' ; ?>" class="visit-btn">Visit Website</a>
            </div>
        </div>
    </div>
  </div>
  </div>
   <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
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
     window.onload = function() {
      generateQRCode();
    };

    function shareImage() {
            const imageUrl = document.getElementById('sharedImage').src;
            // alert(imageUrl);
            const shareText = 'Check out this image!';
            const shareUrl = 'whatsapp://send?text=' + encodeURIComponent(shareText + '\n' + imageUrl);
            // window.location.href = shareUrl;
    }
    
document.getElementById('copyBtn').addEventListener('click', function() {
  const input = document.getElementById('leadLink');
  const button = this;

  // Temporarily enable input to copy
  input.disabled = false;
  input.select();
  input.setSelectionRange(0, 99999); // For mobile devices
  document.execCommand('copy');
  input.disabled = true;

  // Change button text to "Copied!" for 2 seconds
  button.textContent = 'Copied!';
  button.classList.remove('btn-primary');
  button.classList.add('btn-success');

  setTimeout(() => {
    button.textContent = 'Copy';
    button.classList.remove('btn-success');
    button.classList.add('btn-primary');
  }, 2000);
});
  </script>
