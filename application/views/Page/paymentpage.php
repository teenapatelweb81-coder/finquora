<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Payment Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <?php
        $domain_id = domain_id_get();
        $payment = $this->db->where('domain_id',$domain_id)->get('qr')->row_array();
        $contact = $this->db->where('domain_id',$domain_id)->get('contect_us')->row_array();
     ?>
    <style>
        body {
            background:  <?= (isset($payment['bg_color'])) ? $payment['bg_color'] : '' ?> ;
            font-family: 'Arial', sans-serif;
        }
        .payment-container {
            max-width: 900px;
            margin: 50px auto;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
            position: relative;
        }
        .payment-container h3 {
            color: <?= (isset($payment['bg_color'])) ? $payment['bg_color'] : '' ?>;
            text-align: center;
            margin-bottom: 10px;
        }
        .payment-container p {
            color: <?= (isset($payment['bg_color'])) ? $payment['bg_color'] : '' ?>;
            text-align: center;
            margin-top: 5px;
            font-weight: bold;
        }
        .form-section {
            padding: 20px;
        }
        .qr-bank-section {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .qr-bank-section img {
            width: 100px;
            margin-bottom: 10px;
        }
        .qr-bank-section h5 {
            color: <?= (isset($payment['bg_color'])) ? $payment['bg_color'] : '' ?>;
        }
        .submit-btn {
            background-color: <?= (isset($payment['bg_color'])) ? $payment['bg_color'] : '' ?>;
            color: white;
            width: 100%;
            padding: 10px;
            font-size: 18px;
            border: none;
            border-radius: 5px;
            margin-top: 20px;
            transition: background-color 0.3s;
        }
        .submit-btn:hover {
            background-color: <?= (isset($payment['bg_color'])) ? $payment['bg_color'] : '' ?>;
        }
        .safe-payment {
            color: <?= (isset($payment['bg_color'])) ? $payment['bg_color'] : '' ?>;
            font-size: 16px;
            text-align: center;
            margin-top: 20px;
            font-weight: bold;
        }
        .logo-section {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo-section img {
            width: 150px;
        }
        .payment-note {
            text-align: center;
            font-size: 14px;
            margin-top: 10px;
        }
        /* Add subtle diagonal stripe pattern to background */
        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: repeating-linear-gradient(45deg, rgba(255,255,255,0.1) 25%, transparent 25%, transparent 50%, rgba(255,255,255,0.1) 50%, rgba(255,255,255,0.1) 75%, transparent 75%, transparent);
            opacity: 0.2;
            z-index: -1;
        }
    </style>
</head>
<body>

<div class="payment-container">
    <!-- Logo Section -->
     
    <div class="logo-section">
        <a href="<?= base_url('/')?>">
            <img src="<?= base_url('beta/assets/images/logo/' . (!empty($contact['logo']) ? $contact['logo'] : 'default.png')) ?>" alt="Loans Deals Logo">
        </a>
    </div>

    <h3 style="font-size:21px;">Complete Your Payment</h3>
    <!-- <p>Payment is made to <?= (isset($contact['company_name'])) ? $contact['company_name'] : '' ; ?></p> -->
    <p> <?= (isset($payment['heading'])) ? $payment['heading'] : '' ; ?></p>

    <div class="row">
    <!-- Form Section -->
    <div class="col-md-7 form-section">
        <?php echo form_open_multipart('Page/submitpayment'); ?>
            <div class="mb-3">
                <label for="paymentAmount" class="form-label">Payment Amount</label>
                <input type="number" class="form-control" name="amount" id="paymentAmount" required placeholder="Enter Payment Amount">
            </div>
            <div class="mb-3">
                <label for="transactionNumber" class="form-label">Transaction Number</label>
                <input type="text" class="form-control" name="payment_id" id="payment_id" required placeholder="Enter Transaction Number">
            </div>
            <div class="mb-3">
                <label for="uploadTransaction" class="form-label">Upload Transaction Screenshot</label>
                <input type="file" class="form-control" name="image" required id="uploadTransaction">
                
                 <input type="hidden" name="uid" value="<?php echo $uid; ?>">
        <input type="hidden" name="user_type" value="<?php echo $user_type; ?>">
            </div>
            
            

       
        

    <button type="submit" class="submit-btn">Submit Payment</button>
        <?php echo form_close(); ?>
    </div>

        
        <!-- QR Code and Bank Details Section -->
        <div class="col-md-5 qr-bank-section">
            <h4><b><p>Amount: <?php echo "₹" . $amt; ?></p></b> </h4>
                <img src="<?= base_url('beta/assets/images/contect-us/' . (!empty($payment['qr_image']) ? $payment['qr_image'] : 'default-qr.png')) ?>" alt="QR Code" style="width:150px;">

            <h5>Scan to Pay</h5>
            <!--<p>Company Name: EXELORA CONSULTANCY PRIVATE LIMITED</p>-->
            <p>Bank Name: <?= (isset($payment['bank_name'])) ? $payment['bank_name'] : '' ; ?></p>
            <p>Account Number: <?= (isset($payment['account_number'])) ? $payment['account_number'] : '' ; ?></p>
            <p>IFSC Code: <?= (isset($payment['ifsc'])) ? $payment['ifsc'] : '' ; ?></p>
            <p>UPI: <?= (isset($payment['upi'])) ? $payment['upi'] : '' ; ?></p>
            <p>Google Pay ID: <?= (isset($payment['g_id'])) ? $payment['g_id'] : '' ; ?></p>
            <p>Phone Pay ID: <?= (isset($payment['p_id'])) ? $payment['p_id'] : '' ; ?></p>
        </div>
    </div>

    <!-- Safe Payment Label -->
    <div class="safe-payment">Safe & Secure Payment</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>