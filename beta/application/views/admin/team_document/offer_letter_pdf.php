<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Offer Letter</title>

<?php
function imgToBase64($path){
    if (!empty($path) && file_exists($path)) {
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        return 'data:image/'.$type.';base64,'.base64_encode($data);
    }
    return '';
}
?>
<?php
$logoImg      = imgToBase64(FCPATH.'assets/images/logo/'.$contactUs['logo']);
$signImg      = imgToBase64(FCPATH.'assets/images/joiningLetter/'.$joiningLetter['image']);
$sealImg      = imgToBase64(FCPATH.'assets/images/joiningLetter/'.$joiningLetter['ceal']);
$contactusImg = '';
if (!empty($contactUs['offer_letter_image'])) {
    $contactusImg = imgToBase64(
        FCPATH.'assets/images/logo/'.$contactUs['offer_letter_image']
    );
}
?>

<style>
    body{
        margin:0;
        padding:0;
        font-family: DejaVu Sans, sans-serif;
        background:#f5f5f5;
    }

    table{
        border-collapse: collapse;
        width:100%;
    }

    .page{
        width:218mm;
        min-height:297mm;
        margin:2px auto;
        background:#fff;
        border:1px solid #ccc;
    }

    
    .header{
         background-image: url(<?= $contactusImg ?>);
    }
    .header td{
        vertical-align: middle;
        padding:2px;
        font-size:14px;
    }

    .logo img{
        max-width:160px;
        height:auto;
    }

    .content{
        padding:20px;
        font-size:13px;
        line-height:1;
    }

    h2{
        text-align:center;
        font-size:26px;
        margin:0 0 20px 0;
    }

    .bold{
        font-weight:bold;
    }

    .info-table td{
        padding:6px 0;
        font-size:15px;
    }

    .signature-table td{
        vertical-align: middle;
        padding-top:30px;
    }

    .signature-table img{
        max-width:160px;
        height:auto;
    }

    ul{
        margin:0;
        padding-left:18px;
    }
</style>
</head>

<body>

<div class="page">

    <!-- HEADER -->
    <table class="header" border="0">
        <tr>
            <td width="20.33%" class="logo">
                 <?php if($logoImg): ?>
                    <img src="<?= $logoImg ?>">
                <?php endif; ?>
            </td>

            <td width="42.33%" align="center">
                📍 <?= $contactUs['registered_office'] ?>
            </td>

            <td width="37.33%" align="start">
                📞 <?= isset($contactUs['mobile_no']) && !empty($contactUs['mobile_no']) ? $contactUs['mobile_no'] : '' ?>,<?= isset($contactUs['other_mobile']) && !empty($contactUs['other_mobile']) ? $contactUs['other_mobile'] : '' ?>,<?= isset($contactUs['owner_mobile']) && !empty($contactUs['owner_mobile']) ? $contactUs['owner_mobile'] : '' ?><br>
                ✉ <?= isset($contactUs['company_gmail']) && !empty($contactUs['company_gmail']) ? $contactUs['company_gmail'] : '' ?><br>
                ✉ <?= isset($contactUs['other_gmail']) && !empty($contactUs['other_gmail']) ? $contactUs['other_gmail'] : '' ?><br>
                ✉ <?= isset($contactUs['ownere_gmail']) && !empty($contactUs['ownere_gmail']) ? $contactUs['ownere_gmail'] : '' ?><br>
                🌐 <?php echo $domains['url']; ?></p>
            </td>
        </tr>
    </table>

    <!-- CONTENT -->
    <div class="content">

        <h2>Offer Letter</h2>

        <p>Dear <span class="bold"><?= $offer_letter['name'] ?></span>,</p>

        <p>
            We are delighted to extend an offer for you to join
            <span class="bold"><?= $contactUs['company_name'] ?></span> as the
            <span class="bold"><?= $offer_letter['job_title'] ?></span>.
        </p>

        <p class="bold">Position Overview:</p>

        <table class="info-table">
            <tr>
                <td class="bold" width="35%">Job Title</td>
                <td>: <?= $offer_letter['job_title'] ?></td>
            </tr>
            <tr>
                <td class="bold">Reporting To</td>
                <td>: <?= $offer_letter['reporting_to'] ?></td>
            </tr>
            <tr>
                <td class="bold">Work Location</td>
                <td>:  <?= isset($contactUs['registered_office']) && !empty($contactUs['registered_office']) ? $contactUs['registered_office'] : '' ?></td>
            </tr>
            <tr>
                <td class="bold">Start Date</td>
                <td>: <?= $offer_letter['proposed_start_date'] ?></td>
            </tr>
        </table>

        <br>

        <p class="bold">Compensation & Benefits:</p>

        <table class="info-table">
            <tr>
                <td class="bold" width="35%">Annual Salary</td>
                <td>: <?= $offer_letter['annual_salary'] ?></td>
            </tr>
            <tr>
                <td class="bold">Work Schedule</td>
                <td>: <?= $offer_letter['work_schedule'] ?></td>
            </tr>
        </table>

        <br>

        <?= $offer_letter['description'] ?>

        <!-- SIGNATURE -->
        <table class="signature-table" width="100%">
            <tr>
                <td width="33.33%" class="bold">
                    <?= $contactUs['company_name'] ?>
                </td>

                    <td width="33.33%" align="right">
                    <?php if($signImg): ?>
                        <img src="<?= $signImg ?>"><br>
                    <?php endif; ?></td>
                    <td width="33.33%" align="right">

                    <?php if($sealImg): ?>
                        <img src="<?= $sealImg ?>">
                    <?php endif; ?>
                </td>

            </tr>
        </table>

    </div>
</div>

</body>
</html>
