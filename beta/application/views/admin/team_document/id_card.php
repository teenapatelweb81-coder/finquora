<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Employee ID Card</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: #f5f5f5;
        }
        
        .id-card-container {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            justify-content: center;
        }
        
        .id-card {
            width: 350px;
            height: 500px;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            position: relative;
            background: white;
            margin: 5px;
        }
        
        /* Front Side */
        .front {
            position: relative;
            height: 100%;
            padding: 0px 20px 5px 20px;
            box-sizing: border-box;
            /* background: url('<?php echo base_url('assets/images/contect-us/background-white.jpg'); ?>'); */
            background-image: url('<?= !empty($contactUs['id_card_bg_image']) 
            ? base_url('assets/images/logo/'.$contactUs['id_card_bg_image']) 
            : '' ?>');
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
        
        .logo {
            text-align: center;
            margin-bottom: 0px;
        }
        
        .logo img {
               max-width: 200px;
                 height: 60px;
        }
        
        .logo h2 {
            margin: 5px 0 0;
            color: #333;
            font-size: 16px;
            font-weight: 600;
        }
        
        .photo-container {
            width: 130px;
            height: 130px;
            margin: 0 auto 8px;
            border-radius: 50%;
            overflow: hidden;
            border: 5px solid #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background: linear-gradient(135deg, #4b6cb7, #182848);
            position: relative;
            margin-top: 35px;
        }
        
        .photo {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .employee-name {
            text-align: center;
            margin-bottom: 5px;
        }
        
        .employee-name h3 {
            margin: 0;
            font-size: 24px;
            color: #333;
            font-weight: 700;
        }
        
        .designation {
            background: #90EE90;
            color: #006400;
            display: inline-block;
            padding: 5px 20px;
            border-radius: 20px;
            margin: 0 auto 0px;
            font-size: 14px;
            font-weight: 600;
        }
        
        .details {
            text-align: center;
            margin-top: 30px;
        }
        
        .detail-item {
            margin-bottom: 8px;
            font-size: 16px;
            color: #000;
            text-decoration: underline;
            font-weight:600;
        }
        
        /* Back Side */
        .back {
            position: relative;
            height: 100%;
            padding: 20px;
            box-sizing: border-box;
             background-image: url('<?= !empty($contactUs['id_card_bg_image']) 
            ? base_url('assets/images/logo/'.$contactUs['id_card_bg_image']) 
            : '' ?>');
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
        
        .terms {
            margin-top: 20px;
        }
        
        .terms h4 {
            text-align: center;
            margin-bottom: 15px;
            color: #333;
            font-size: 18px;
            font-weight: 700;
            margin-top: 0;
        }
        
        .terms ul {
            padding-left: 20px;
            margin: 0 0 20px 0;
        }
        
        .terms li {
            margin-bottom: 10px;
            font-size: 12px;
            color: #555;
            line-height: 1.4;
        }
        
        .join-date {
            text-align: center;
            margin:0;
            font-size: 16px;
            color: #333;
            font-weight:600;
        }
        
        .qr-code {  
            text-align: center;
            margin: 20px 0;
        }
        
        .qr-code img {
            width: 100px;
            height: 100px;
            background: #fff;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        .company-name {
            position: absolute;
            bottom: 0px;
            left: 0;
            right: 0;
            text-align: center;
            font-weight: 700;
            font-size: 17px;
            color: #333;
            text-decoration: underline;
            padding: 0px;
            color: white;
            text-transform: uppercase;
        }
        
        .id-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            opacity: 0.1;
            background: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiPjxkZWZzPjxwYXR0ZXJuIGlkPSJwYXR0ZXJuIiB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHBhdHRlcm5Vbml0cz0idXNlclNwYWNlT25Vc2UiIHBhdHRlcm5UcmFuc2Zvcm09InJvdGF0ZSg0NSkiPjxyZWN0IHdpZHRoPSIyMCIgaGVpZ2h0PSIyMCIgZmlsbD0iI2ZmYzEwNyI+PC9yZWN0PjxyZWN0IHg9IjIwIiB5PSIyMCIgd2lkdGg9IjIwIiBoZWlnaHQ9IjIwIiBmaWxsPSIjZmY5ZjBhIj48L3JlY3Q+PC9wYXR0ZXJuPjwvZGVmcz48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSJ1cmwoI3BhdHRlcm4pIiBvcGFjaXR5PSIwLjEiPjwvcmVjdD48L3N2Zz4=');
        }
        
        .content {
            position: relative;
            z-index: 1;
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        .bg-add{
            height: 165px;
            width: 100%;
            position: absolute;
            background-image: url('<?= !empty($contactUs['id_card_image']) 
            ? base_url('assets/images/logo/'.$contactUs['id_card_image']) 
            : '' ?>');
            left: 0;
            top: 61px;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
        .bg-add-back{
            height: 120px;
            width: 100%;
            position: absolute;
            background-image: url('<?= !empty($contactUs['id_card_image']) 
            ? base_url('assets/images/logo/'.$contactUs['id_card_image']) 
            : '' ?>');
            left: 0;
            bottom: 0px;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
        #downloadidcard {
            background: #4e73df;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        #downloadidcard:hover {
            background: #2e59d9;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        #downloadidcard i {
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div style="position: fixed; top: 20px; right: 20px; z-index: 1000;">
    <button id="downloadidcard" title="Download ID Card" class="btn btn-primary">
        <i class="fa fa-download"></i>
    </button>
</div>
    <div class="id-card-container">
        <!-- Front Side -->
        <div class="id-card">
            <div class="front">
                <div class="bg-add"></div>
                <div class="id-bg"></div>
                <div class="content">
                    <div class="logo">
                        <img src="<?php echo base_url('assets/images/logo/' . $contactUs['logo']); ?>" alt="<?= isset($contactUs['company_title']) && !empty($contactUs['company_title']) ? $contactUs['company_title'] : '' ?>" >
                        <h2><?= isset($contectUs['company_title']) && !empty($contectUs['company_title']) ? $contectUs['company_title'] : '' ?></h2>
                    </div>
                    
                    <div class="photo-container">
                        <?php if ($id_card['profile_photo']) {?>
                            <img src="<?php echo base_url( $id_card['profile_photo']); ?>" alt="Employee Photo" class="photo">
                        <?php } else {?>
                            <img src="https://ui-avatars.com/api/?name=<?= urlencode($id_card['name']) ?>&background=4b6cb7&color=fff&size=200" alt="Employee Photo" class="photo">
                        <?php }?>
                    </div>
                    
                    <div class="employee-name">
                        <h3><?= $id_card['name']?></h3>
                    </div>
                    
                    <div style="text-align: center;">
                        <span class="designation"><?= $id_card['emp_profile']?></span>
                    </div>
                    
                    <div class="details">
                        <div class="detail-item">Employee No - <?= str_replace('Team-', '', $id_card['code']); ?></div>
                        <div class="detail-item">E mail - <?= $id_card['email']?></div>
                       <?php if ( $id_card['id'] != 1) { ?>
                       <div class="detail-item">Emergency contact No-  <?= $id_card['emergency_number']?></div> <?php }?> 
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Back Side -->
        <div class="id-card">
            <div class="back">
                <div class="bg-add-back"></div>
                <div class="id-bg"></div>
                <div class="content">
                    <div class="logo">
                        <img src="<?php echo base_url('assets/images/logo/' . $contactUs['logo']); ?>" alt="<?= isset($contactUs['company_title']) && !empty($contactUs['company_title']) ? $contactUs['company_title'] : '' ?>" >
                    </div>
                    
                    <div class="terms">
                        <h4>TERMS & CONDITIONS</h4>
                        <ul>
                            <li>Official notes: Carry the ID card at all times during working hours for identification purposes.</li>
                            <li>Authorized Use: The ID card is strictly for official use and should not be shared or used for unauthorized purposes.</li>
                        </ul>
                    </div>
                    
                    <div class="join-date ">
                        Joining - <?= date('d/m/Y', strtotime($id_card['joining_date']))?>
                    </div>
                   
                   <div class="qr-code">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=100x100&data=<?= urlencode($domains['url']) ?>" alt="QR Code">
                    </div>

                    
                    <div class="company-name">
                       <?= isset($contactUs['company_name']) && !empty($contactUs['company_name']) ? $contactUs['company_name'] : '' ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

                    <!-- Add html2pdf library for PDF generation -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const downloadBtn = document.getElementById("downloadidcard");

    // Function to convert image to data URL
    function getDataUrl(url) {
        return new Promise((resolve, reject) => {
            const img = new Image();
            img.crossOrigin = 'Anonymous';
            img.onload = () => {
                const canvas = document.createElement('canvas');
                const ctx = canvas.getContext('2d');
                canvas.width = img.width;
                canvas.height = img.height;
                ctx.drawImage(img, 0, 0);
                resolve(canvas.toDataURL('image/jpeg'));
            };
            img.onerror = reject;
            img.src = url;
        });
    }

    downloadBtn.addEventListener("click", async function () {
        try {
            // Show loading state
            const originalText = downloadBtn.innerHTML;
            downloadBtn.disabled = true;
            downloadBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Preparing...';

            // Convert QR code to data URL
            const qrCodeImg = document.querySelector('.qr-code img');
            if (qrCodeImg) {
                const qrDataUrl = await getDataUrl(qrCodeImg.src);
                qrCodeImg.src = qrDataUrl;
                
                // Small delay to ensure image is updated
                await new Promise(resolve => setTimeout(resolve, 500));
            }

            const content = document.querySelector(".id-card-container");
            const options = {
                margin: 10,
                filename: "Id-card.pdf",
                image: { 
                    type: "jpeg", 
                    quality: 0.98,
                    useCORS: true // Enable CORS for external images
                },
                html2canvas: { 
                    scale: 2,
                    useCORS: true, // Enable CORS for external images
                    logging: true, // Enable logging for debugging
                    allowTaint: true // Allow tainted canvas
                },
                jsPDF: { 
                    unit: "mm", 
                    format: "a4", 
                    orientation: "portrait" 
                }
            };

            // Generate PDF
            await html2pdf().set(options).from(content).save();
        } catch (error) {
            console.error("Error generating PDF:", error);
            alert("Error generating PDF. Please try again.");
        } finally {
            // Restore button state
            downloadBtn.disabled = false;
            downloadBtn.innerHTML = originalText;
        }
    });
});
</script>
</body>
</html>