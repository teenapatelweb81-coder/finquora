<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Payment Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            /* Background gradient with Instant Loans Deals color theme */
            background: linear-gradient(135deg, #009933 0%, #66cc66 100%);
            font-family: 'Arial', sans-serif;
        }
        .payment-container {
            max-width: 900px;
            margin: 50px auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
            position: relative;
        }
        .payment-container h3 {
            color: #006400; /* Instant Loans Deals color */
            text-align: center;
            margin-bottom: 10px;
        }
        .payment-container p {
            color: #006400;
            text-align: center;
            margin-top: 5px;
            font-weight: bold;
        }
        .form-section {
            padding: 20px;
        }
        .qr-bank-section {
            background: #f8f9fa;
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
            color: #006400;
        }
        .submit-btn {
            background: #006400;
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
            background: #004b29;
        }
        .safe-payment {
            color: #28a745;
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
     <?php
        $payment = $this->db->where('domain_id',$domain_id)->get('qr')->row_array();
        $contact = $this->db->where('domain_id',$domain_id)->get('contect_us')->row_array();
     ?>
    <div class="logo-section">
        <a href="<?= base_url('/')?>">
            <img src="<?= base_url('assets/images/logo/'.$contact['logo']) ?> " alt="Loans Deals Logo">
        </a>
    </div>

    <h3 style="font-size:21px;">Complete Your Payment</h3>
   <p> <?= (isset($payment['heading'])) ? $payment['heading'] : '' ; ?></p>

    <div class="row">
    <!-- Form Section -->
    <div class="col-md-7 form-section">
        <?php echo form_open_multipart('admin/payment-respone'); ?>
            <div class="mb-3">
                <label for="paymentAmount" class="form-label">Payment Amount</label>
                <input type="number" class="form-control" name="amount" id="paymentAmount" placeholder="Enter Payment Amount">
            </div>
            <div class="mb-3">
                <label for="transactionNumber" class="form-label">Transaction Number</label>
                <input type="text" class="form-control" name="payment_id" id="payment_id" placeholder="Enter Transaction Number">
            </div>
            <div class="mb-3">
                <label for="uploadTransaction" class="form-label">Upload Transaction Screenshot</label>
                <input type="file" class="form-control" name="image" id="uploadTransaction">
                
                 <input type="hidden" name="uid" value="<?php echo $uid; ?>">
                 <input type="hidden" name="amt" value="<?php echo $amt; ?>">
                 <input type="hidden" name="domain_id" value="<?php echo $domain_id; ?>">
                <input type="hidden" name="user_type" value="<?php echo $user_type; ?>">
            </div>
            
            

       
        

            <button type="submit" class="submit-btn">Submit Payment</button>
        <?php echo form_close(); ?>
    </div>

        <!-- QR Code and Bank Details Section -->
        <div class="col-md-5 qr-bank-section">
            <h4><b><p>Amount: <?php echo "₹" . $amt; ?></p></b> </h4>
            <img src="<?= base_url('assets/images/contect-us/'.$payment['qr_image']) ?>" alt="QR Code" style="width:150px;">
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