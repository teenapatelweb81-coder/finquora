<section id="update">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-8">

				<div class="card">
					<div class="card-body">
					    <div class="text-center">
                          <h1 class="display-3">Thank You!</h1>
                          <p class="lead">Your payment has been received successfully.</p>
                          <p class="lead">Access to the system will be granted upon approval by the administrator, after which you may proceed with logging in.</p>
                          <hr>
                          <p>
                            Having trouble? <a href="<?= base_url('customer')?>">Contact us</a>
                          </p>

                          <p class="lead">
                            <?php
                             $uid = $this->session->userdata('uid');
                             $user = $this->db->where('id', $uid)->get('registerUser')->row_array(); ?>


                             <!-- if($user['status'] == 1 && $user['role'] == ''){?>
                            <a class="btn btn-primary btn-sm mb-1" href="<?php echo base_url('Cards');?>" role="button">View Card</a>
                            <?php //} ?> -->
                            <a class="btn btn-primary btn-sm" href="<?= base_url('logout') ?>" role="button">Continue to Website</a>
                          </p>

                          
                        </div>
                            
                    </div>
				</div>
					
			</div>
		</div>
	</div>
</section>
<script>
// setTimeout(function() {
//         window.location.href = "<?php echo base_url();?>";
//     }, 3000);

</script>


