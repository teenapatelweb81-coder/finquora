<?php
//echo "<pre>";
//print_r($uaddress);
?>
  <!--== End Header Wrapper ==-->
  
  <main class="main-content">
    
    <!--== Start Contact Area ==-->
    <section class="user-area">
      <div class="container-fluid">
        <div class="row">
          <h3 class="uk_title">Order Summary</h3>
		  
		  <div class="summery_order">
			<div class="row">
				<div class="col-sm-9">
				    <?php if(!empty($val[0]->buy_date)) {  $date = strtotime($val[0]->buy_date);  $fdate= date('d F Y',$date); } ?>
					<p><b>Order ID : <?= (!empty($val[0]->invoiceID))? $val[0]->invoiceID:'' ?> | </b>Status: <span class="approved"><?= (!empty($val[0]->order_action))? ucwords($val[0]->order_action):'' ?></span>  |  Order Date : <?= (!empty($fdate))? $fdate:'' ?></p>
				</div>
				
				<div class="col-sm-3 text-center">
					<p><a href="<?= base_url('admin/user-order') ?>" class="btn btn-success"><i class="fa fa-long-arrow-left" ></i> Back to Order List</a></p>
				</div>
			</div>
			<hr>
		<div class="col-md-12">	
		<div class="table-responsive">	
			<table class="table table-bordered table-striped text-center">
				<tr>
					<td>Product Name</td>
					<td>Size</td>
					<td>Unit Price</td>
					<td>Qty</td>
					<td>Subtotal</td>
				</tr>
				
				<?php if(!empty($val)) { foreach($val as $value) {?>
				<tr>
					<td> <img src="<?= base_url('upload/assets/image/').$value->product_image ?>" class="order_pic" style= "width:60px;height: 60px;" > <?= $value->productName ?></td>
					<td>  <?= $value->productSize ?> </td>
					<td> € <?= $value->productUnitPrice  ?></td>
					<td>  <?= (!empty($value->ProductQty))?$value->ProductQty :'' ?> </td>
					<td> € <?= $value->productPrice  ?></td>
				</tr>
				<?php } } ?>
		
				
				<tr>
					<td colspan="4" class="text-right"> Total</td>
					<td> € <?= $value->total  ?></td>
				</tr>
				<!--<tr>-->
				<!--	<td colspan="3" class="text-right"> Tax</td>-->
				<!--	<td> $ 5</td>-->
				<!--</tr>-->
				
				<tr>
					<td colspan="4" class="text-right"><b> Subtotal</b></td>
					<td> <b>€ <?= $value->total  ?></b></td>
				</tr>
			</table>
		</div>	
	</div>	
			<div class="pp_profile">
				<div class="row">
					<div class="col-sm-6">
						<h3 class="uk_title">Billing Address</h3>
						<p><?php echo $uaddress->bill_street_address;  $uaddress->bill_apartment; ?></p>
						<p>Pin - <?php echo $uaddress->bill_zip;   ?></p>
						<p><?php echo $uaddress->bill_town_city;   $uaddress->bill_state_region;   ?></p>
						<p>Email : <?php echo $uaddress->user_email; ?></p>
						<p>Mobile : <?php echo $uaddress->bill_phone; ?></p>
						
					</div>
					
					<div class="col-sm-6">
						<h3 class="uk_title">Shipping Address</h3>
						<p><?= (!empty($uaddress->zip_street_address))? $uaddress->zip_street_address : $uaddress->bill_street_address ?>
						   <?= (!empty($uaddress->zip_apartment))? $uaddress->zip_apartment : $uaddress->bill_apartment ?>
						</p>
						<p>Pin - <?= (!empty($uaddress->ship_zip))? $uaddress->ship_zip : $uaddress->bill_zip ?></p>
						<p><?= (!empty($uaddress->zip_town_city))? $uaddress->zip_town_city : $uaddress->bill_town_city ?>
						   <?= (!empty($uaddress->zip_state_region))? $uaddress->zip_state_region : $uaddress->bill_state_region ?></p>
						<p>Email : <?php echo $uaddress->user_email; ?> </p>
						<p>Mobile : <?= (!empty($uaddress->ship_phone))? $uaddress->ship_phone : $uaddress->bill_phone ?></p>
					</div>
					
				</div>
			</div>
			
				<div class="col-sm-12 text-center">
					<!--<a href="orders.php" class="btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i> Cancel Order</a>-->
				</div>
			
		  </div>
					
					
          </div>
      </div>
    </section>
    <!--== End Contact Area ==-->

  
  
  </main>

  <!--== Start Footer Area Wrapper ==-->
