
<div class="container-fluid p-0">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin/Dashboard/");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">User order</li>
           </ol>
         </nav>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-12 px-0">
		    <div id="message" class="text-primary text-center"></div>
			<div class="table-responsive ">
			    <span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>
                <span class="text-center text-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error');?></span>		
                
			<table class="table table-bordered text-center table-hover shadow-lg">
					<thead>
						<tr>
							<th class="no">No</th>
							<th class="no">Order ID</th>
							<th class="name">Name</th>
							<th class="date">Date</th>
							<th class="status">Transaction  ID</th>
							<th class="status">Payment Status</th>
							<th class="total">Total  Amount</th>
							<th class="action">Details</th>
							<th class="action">Action</th>
						</tr>
					</thead>
				<tbody>
				 <?php $num = 1; if(!empty($val)) { foreach($val as $value) { 
				        $date = strtotime($value->created_at); $fdate = date('d F Y h : m : A',$date);
				 ?>
						<tr>
						    <td><?= $num ?></td>
						    <td><?= $value->id ?></td>
							<td><?= ucfirst($value->bill_name);  $value->bill_last_name;  ?></td>
							<td><?= $fdate ?></td>
							<td><?= $value->txn_id ?></td>
							<td class="hold"><?= $value->payment_status ?></td>
							<td> € <?= $value->total_payment ?></td>
							<td><a href="<?= base_url('admin/user-order-details/').$value->id ?>" class="btn btn-success">View</a></td>
							<td>
							    <select id="order_action" data-id="<?= $value->id?>" name='order_action' class="form-control orderAction">
							        <option value="">Order Action</option>
							        <option value="processing" <?= ($value->order_action == 'processing')?'selected = selected':'' ?> >Processing</option>
							        <option value="packing" <?= ($value->order_action == 'packing')?'selected = selected':'' ?> >Packing</option>
							        <option value="shipped" <?= ($value->order_action == 'shipped')?'selected = selected':'' ?> >Shipped</option>
							        <option value="delivered" <?= ($value->order_action == 'delivered')?'selected = selected':'' ?> >Delivered</option>
							        <option value="hold" <?= ($value->order_action == 'hold')?'selected = selected':'' ?> >Hold</option>
							        <option value="cancelled" <?= ($value->order_action == 'cancelled')?'selected = selected':'' ?> >Cancelled</option>
							    </select>
						  </td>
						</tr>
						<?php $num++; }} else {?>
						    <tr>
						        <td colspan="5" class="text-center"><h6>Order is not available</h6></td>
						    </tr>
						<?php }?>
				</tbody>
			</table>
			</div>
		</div>
	</div>
</div>
