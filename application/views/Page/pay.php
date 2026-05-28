<section id="update">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">

				<div class="card">
					<div class="card-body">
					    <div class="text-center">
					        <!--       
					        https://secure.payu.in/_payment
					        https://test.payu.in/_payment
					        -->
                         <form action='https://test.payu.in/_payment' method='post'>
                         <!--<form action='https://api-preprod.phonepe.com/apis/merchant-simulator/pg/v1/pay' method='post'>-->
                            <input type="hidden" name="key" value="<?php echo $key; ?>" />
                            <input type="hidden" name="txnid" value="<?php echo $txnid; ?>" />
                            <input type="hidden" name="amount" value="<?php echo $amount; ?>" />
                            <input type="hidden" name="productinfo" value="<?php echo $productinfo;?>" />
                            
                            <input type="hidden" name="firstname" value="<?php echo $firstname; ?>" />
                            <input type="hidden" name="email" value="<?php echo $email; ?>" />
                            <input type="hidden" name="phone" value="<?php echo $phone; ?>" />
                            
                            
                            
                            <input type="hidden" name="udf1" value="" />
                            <input type="hidden" name="udf2" value="" />
                            <input type="hidden" name="udf3" value="" />
                            <input type="hidden" name="udf4" value="" />
                            <input type="hidden" name="udf5" value="" />
                           
                           
                            <!--<input type="hidden" name="phone" value="<?php //echo $phone; ?>" />-->
                            <input type="hidden" name="hash" value="<?php echo $hash; ?>" />
                             <input type="hidden" name="surl" value="<?php echo base_url('payment-respone');?>" />
                            <input type="hidden" name="furl" value="<?php echo base_url('payment-respone');?>" />
                            <input type="hidden" name="uid" value="<?php echo $uid; ?>" />
                            <input type="hidden" name="role" value="<?php echo $role; ?>" />
                            <input type="submit" value="Pay">
                         </form>
                         
                         
                        </div>
                            
                    </div>
				</div>
					
			</div>
		</div>
	</div>
</section>



