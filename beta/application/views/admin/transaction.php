<div class="container-fluid p-0">
   <div class="row m-0">
      <div class="col-md-12 px-0">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin/Dashboard/");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Transaction Details</li>
           </ol>
         </nav>
</div>
<div class="container-fluid px-0">
	<div class="row m-0">
		<div class="col-md-12 px-0">
		    <div id="message" class="text-primary text-center"></div>
			<div class="table-responsive ">
			    <span class="text-center text-primary mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>
                <span class="text-center text-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error');?></span>		
      
<table class="table table-bordered text-center table-hover shadow-lg">
    <thead class="bg-primary text-white">
        <tr>
            <th>Sl No.</th>
            <th>Transaction Id</th>
            <th>Amount</th>
            <th>Method</th>
            <th>Role</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (!empty($datas)) {
            $num = 1; 
            foreach ($datas as $data) {
             ?>
            <tr>
                <td class='text-primary'><?php echo $num; ?></td>                        
                <td class='text-left'><?php echo ucwords($data['payment_id']); ?></td>
                <td><?php echo $data['amount']; ?></td>
                <td><?php echo ucwords($data['method']); ?></td>
                <td><?php echo ucwords($data['role']); ?></td>
                <td>
    <?php if (!empty($data['image'])) { 
        // Remove the first occurrence of 'beta' from the image path
        $imagePath = str_replace('/beta', '', $data['image']); 
    ?>
        <!-- Eye button to open modal -->
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#imageModal<?php echo $num; ?>">
            <i class="fa fa-eye"></i>
        </button>

        <!-- Modal to show the image -->
        <div class="modal fade" id="imageModal<?php echo $num; ?>" tabindex="-1" aria-labelledby="imageModalLabel<?php echo $num; ?>" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="imageModalLabel<?php echo $num; ?>">Payment Image</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                       <img src="<?= str_replace('/beta/', '/', base_url()); ?><?php echo $imagePath; ?>" alt="Payment Image" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <span class="text-muted">No Image</span>
    <?php } ?>
</td>

            </tr>
        <?php $num++; } 
        } else { ?>
            <tr><td colspan="6">Transaction data not available.</td></tr>
        <?php } ?>
    </tbody>
</table>


			</div>
		</div>
	</div>
</div>

