
<?php 
   $user = $this->db->where(array('id' => $_GET['type']))->get('branch_franchise')->row_array();

   if(empty($user)){
      $user = $this->db->where(array('id' => $_GET['type']))->get('user_master')->row_array();
   }
 
?>

<style>
   @media screen and (max-width: 500px) {

   .text-user-sm{
      text-align: left !important;
  } }
</style>

<div class="container-fluid p-0">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
               <li class="breadcrumb-item active" aria-current="page">Add Network Member</li>
           </ol>
         </nav>
</div>
<div class="container-fluid">
   <div class="row">
      <div class="col-md-12 px-0 form-main">
         <div class="card  form-card">
            <div id="success_message"></div>
             <!--<span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success'); ?></span>-->
             <span class="text-center text-white bg-danger mb-2" id="errid"> <?php echo $this->session->flashdata('message'); ?></span>
            <?php echo form_open_multipart('admin/send-network-otp-share?type=' . $_GET['type'].'&role='.$_GET['role']) ?>


            <div class="row">

                <div class="col-md-6 pr-0">

                     <nav aria-label="breadcrumb">
                        <ol class="breadcrumb ">
                           <li class="breadcrumb-item active text-dark" aria-current="page">Add Network Member</li>
                        </ol>
                     </nav>
                  </div>
                  <div class="col-md-6 pl-0 text-user-sm" 

style="text-align: right;    padding: 0.75rem 1rem;
    margin-bottom: 1rem;
    list-style: none;
    background-color: #e9ecef;
    border-radius: 0.25rem;" >

                        <p class="m-0"><?= $user['name']?></p>
                        <p class="m-0"><?= $user['mobile_no']?></p>
                  </div>

               <div class="col-sm-4">
                <div class="form-group">
            				<label class="text-dark" for="username">Full name<span class="text-danger">*</span></label>

            				<input type="text" class="form-control" aria-required="true" name="username" placeholder="Full Name" id="username" required>
            				<input type="hidden" name="user_type" id="user_type" value="agent">
            				<input type="hidden" name="member_type" id="member_type" value="network">
            				<input type="hidden" name="domain_id" id="domain_id" value="<?= domain_id_get()?>">
            			</div>
            		</div>
                    <div class="col-sm-4">
            			<div class="form-group">
            				<label class="text-dark" for="usermobile">Mobile No<span class="text-danger">*</span> </label>
            				<input type="number" class="form-control" aria-required="true" name="usermobile" placeholder="Mobile No" id="usermobile" required>
            			</div>
            	   </div>
            	   <div class="col-sm-4">
            			<div class="form-group">
            				<label class="text-dark" for="useremail">Email<span class="text-danger">*</span></label>
            				<input type="email" aria-required="true" name="useremail" value="" class="form-control" placeholder="As per your bank records" required>
            				<div class="help-block font-small-3"></div>
            			</div>
            	   </div>
            	</div>

            	<div class="row">
               <div class="col-sm-4">
                <div class="form-group">
            				<label class="text-dark" for="city">City<span class="text-danger">*</span></label>
            				<input type="text" aria-required="true" name="city"  class="form-control" placeholder="City" required>
            				<div class="help-block font-small-3"></div>
            			</div>
            		</div>
                    <div class="col-sm-4">
            		<div class="form-group">
            				<label class="text-dark" for="address">Address<span class="text-danger">*</span></label>
            				<input type="text" aria-required="true" name="address"  class="form-control" placeholder="Address" required>
            				<div class="help-block font-small-3"></div>
            			</div>
            	   </div>
            	   <div class="col-sm-4">
            			<div class="form-group">
            				<label class="text-dark" for="pin_code">Pin code<span class="text-danger">*</span></label>
            				<input type="text" aria-required="true" name="pin_code"  class="form-control" placeholder="Pin code" min="100000" inputmode="numeric" data-validation-regex-regex="[0-9]+" aria-invalid="false" required>
            				<div class="help-block font-small-3"></div>
            			</div>
            	   </div>
            	</div>


            </div>



            <div class="row " style="margin-bottom: 100px;">

                <div class="col-md-5">

                </div>
                <div class="col-md-2">
                     <div class="form-group text-center">
                       <button type="submit" name="create" id="create" value="create" class="btn btn-info mt-4">Create</button>
                    </div>

                </div>
                <div class="col-md-5">

                </div>

            </div>
            <?php echo form_close(); ?>
         </div>
      </div>
   </div>
</div>
