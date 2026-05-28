<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Offer Letter</title>  
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
    body {
        margin: 0;
        font-family: math;
        background: #f5f5f5;
    }

    .page {
       width: 200mm; /* A4 exact width */
       min-height: 297mm;
        margin: 20px auto;
        background: #fff;
        border: 1px solid #ccc;
    }
    /* Add this to your existing style section */
.content {
    page-break-inside: avoid;
    page-break-after: auto;
}



/* Ensure images don't cause page breaks */
img {
    max-width: 100%;
    height: auto;
    page-break-inside: avoid;
}

    /* Header */
    .header {
        display: flex;
        color: #000;
        font-size: 16px;
        box-sizing: border-box;
        align-items: center;
        justify-content: space-between;
        /* background: url('<?php echo base_url('assets/images/contect-us/offer-letter-bg.jpg'); ?>'); */
        background-image: url('<?= !empty($contactUs['offer_letter_image']) 
            ? base_url('assets/images/logo/'.$contactUs['offer_letter_image']) 
            : '' ?>');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;

    }

    .header div {
        padding: 10px;
    }


    .header p {
        margin: 3px 0;
    }
    .header .header-middle {
        text-align: center;
    }

    /* Content */
    .content {
        padding: 20px;
        font-size: 16px;
        line-height: 1.6;
    }

    h2 {
        text-align: center;
        font-weight: normal;
        margin-bottom: 0;
        margin-top: 0;
        font-size: 30px;
    }

    .bold {
        font-weight: bold;
    }

    ul {
        margin-left: 20px;
    }
    .logo {
            text-align: center;
            margin-bottom: 0px;
        }
        
        .logo img {
               max-width: 200px;
            height: 60px;
        }
        .downloadofferletter {
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

        .downloadofferletter:hover {
            background: #2e59d9;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        .downloadofferletter i {
            font-size: 16px;
        }
        .full_content{
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
</style>
</head>
<body>
     <div style="position: fixed; top: 20px; right: 20px; z-index: 1000;">
    <!-- <button id="downloadofferletter" title="Download Offer Letter" class="btn btn-primary"><i class="fa fa-download"></i></button> -->
    <a class="btn btn-primary downloadofferletter" href="<?= base_url('admin/team-offer-letter-pdf/')?><?= $offer_letter['id']?>"> <i class="fa fa-download btn btn-primary"></i></a>
</div>

<div class="page offer-letter-content">

    <div class="header">
        <div class="header-left logo">
            <img src="<?php echo base_url('assets/images/logo/' . $contactUs['logo']); ?>" alt="<?= isset($contactUs['company_title']) && !empty($contactUs['company_title']) ? $contactUs['company_title'] : '' ?>" >
        </div>

        <div class="header-middle ">
            <p class="text-center">📍 <?= isset($contactUs['registered_office']) && !empty($contactUs['registered_office']) ? $contactUs['registered_office'] : '' ?></p>
    </div>

        <div class="header-right">
            <p style="font-size:14px;">📞<?= isset($contactUs['mobile_no']) && !empty($contactUs['mobile_no']) ? $contactUs['mobile_no'] : '' ?>,<?= isset($contactUs['other_mobile']) && !empty($contactUs['other_mobile']) ? $contactUs['other_mobile'] : '' ?>,<?= isset($contactUs['owner_mobile']) && !empty($contactUs['owner_mobile']) ? $contactUs['owner_mobile'] : '' ?></p>

            <p>✉ <?= isset($contactUs['company_gmail']) && !empty($contactUs['company_gmail']) ? $contactUs['company_gmail'] : '' ?></p>
            <p>✉ <?= isset($contactUs['other_gmail']) && !empty($contactUs['other_gmail']) ? $contactUs['other_gmail'] : '' ?></p>
            <p>✉ <?= isset($contactUs['ownere_gmail']) && !empty($contactUs['ownere_gmail']) ? $contactUs['ownere_gmail'] : '' ?></p>
            <p>🌐 <?php echo $domains['url']; ?></p>
        </div>
    </div>

    <div class="content">
        <h2>Offer Letter</h2>

        <p>Dear <span class="bold"><?= $offer_letter['name']?></span>,</p>

        <p>
            We are delighted to extend an offer for you to join
            <span class="bold"><?=  $contactUs['company_name']?></span> as the
            <span class="bold"><?= $offer_letter['job_title']?></span>. After reviewing your qualifications,
            we are confident that your expertise and professional background will
            significantly contribute to the continued success of our team.
        </p>

        <p class="bold">Position Overview:</p>
        <ul>
            <li><span class="bold">Job Title:</span> <?= $offer_letter['job_title']?></li>
            <li><span class="bold">Reporting To:</span> <?= $offer_letter['reporting_to']?></li>
            <li><span class="bold">Work Location:</span> 📍 <?= isset($contactUs['registered_office']) && !empty($contactUs['registered_office']) ? $contactUs['registered_office'] : '' ?></li>
            <li><span class="bold">Proposed Start Date:</span> <?= $offer_letter['proposed_start_date']?></li>
        </ul>

        <p class="bold">Compensation & Benefits Package:</p>
        <ul>
            <li><span class="bold">Annual Salary:</span> <?= $offer_letter['annual_salary']?></li>
            <li><span class="bold">Work Schedule:</span> <?= $offer_letter['work_schedule']?></li>
        </ul>

        <?= $offer_letter['description']?>
        <div class="full_content">
            <p class="bold"><?=  $contactUs['company_name']?></p>
            <div class="images" style="display: flex;align-items: center;">
                <img src="<?= base_url('assets/images/joiningLetter/' . $joiningLetter['image'])?>" alt="" style="display: block;width: 150px;">
                <img src="<?= base_url('assets/images/joiningLetter/' . $joiningLetter['ceal'])?>" alt="" style="display: block;width: 200px;">
            </div>
        </div>
    </div>
</div>
                  <!-- Add html2pdf library for PDF generation -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script>
document.getElementById("downloadofferletter").addEventListener("click", function () {

    const element = document.querySelector(".offer-letter-content");

    html2pdf().set({
        filename: "Offer_Letter.pdf",
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: {
            scale: 2,
            useCORS: true
        },
        jsPDF: {
            unit: 'mm',
            format: 'a4',
            orientation: 'portrait'
        },
        margin: [0, 0, 0, 0] // ✅ thoda margin do
    }).from(element).save();

});
</script>
</body>
</html>
