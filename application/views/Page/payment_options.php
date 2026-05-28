<div class="box">
	<?php
	$session_email=$_SESSION['customer_email'];
	$select_cust="select * from customers where customer_email= '$session_email'";
	$run_cust=mysqli_query($con,$select_cust);
	$row_cust=mysqli_fetch_array($run_cust);
	$customer_id=$row_cust['customer_id'];



	?>

		<h1 class="text-center">Payment Options for you</h1>
		<p class="lead text-center">
			<a href="order.php?c_id=<?php echo $customer_id; ?>">Pay offline</a>
		</p>
		<center>
			<p class="lead">
				<!--<a id="rzp-button1" href='#!'>Pay online</a>-->
					<!--<img src="images/paypal.jpg" width="500" height="270" class="img-responsive"></a>-->
					
					
					<form name="razorpay_frm_payment" class="razorpay-frm-payment" id="razorpay-frm-payment" method="post">
                        <input type="hidden" name="merchant_order_id" id="merchant_order_id" value="12345">
                        <input type="hidden" name="language" value="EN">
                        <input type="hidden" name="currency" id="currency" value="INR">
                        <input type="hidden" name="surl" id="surl" value="http://shop.vskingsoft.com/pay_online/success.php">
                        
                         
                        
                        <input type="hidden" name="furl" id="furl" value="http://shop.vskingsoft.com/pay_online/failed.php">
                            
                                <button type="button" class="btn btn-success mt-4 float-right" id="razor-pay-now"><i class="fa fa-credit-card" aria-hidden="true"></i> Pay online</button>
                              
                           
                        </form>
					
					
					
			</p>
		</center>
</div>