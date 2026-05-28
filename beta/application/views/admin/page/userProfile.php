<style>
    .top_banner{
    min-height: 300px;
    background-image: url(../upload/assets/vivid.jpg);
    background-size: 100%;
    background-position: center top;
    position: relative;
    z-index: 0;

}
.mask {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    transition: all .15s ease;
  }
.opacity-8{
  opacity: 1.9!important;
}
.bg_remove{
  background: none !important;
}
.header12 {
    position: relative;
}
.icon{
    position: relative;
    width: 100%;
    padding-right: 21px;
    padding-left: 14px;
}
.position123{
  position: absolute;
    width: 100%;
    top: 150px;
}
.breadcrumb li.breadcrumb-item {
    font-weight: 900 !important;
}
.img-fluid{
  position: absolute;
  top: -55px;
  right: 30%;
}
@media (max-width: 330px) {
  .position123 {
    position: absolute;
    width: 100%;
    top: 60%;
}
.icon{
  padding-left: 7px;
  padding-right: 21px;
}

}
</style>

<?php
  $adhar_card_no = $profile[0]->adharcard_no;
  $Pan_Card_No = $profile[0]->pan_card_number;
  $gst_no = $profile[0]->gst_number;
  $verify = '';
  if (!empty($adhar_card_no) && !empty($Pan_Card_No) && !empty($gst_no)) {
      $verify = 'all_include';
  } else {
      $verify = '';
  }
?>
  <div class="container-fluid px-0"style="height: 100vh;" >
    <div class="row top_banner header12 m-0">
      <div class="col">
      </div>
    </div>
    <div class="row position123 m-0">
      <div class="col-lg-4 icon px-1">
        <div class="card mb-4">
          <div class="card-body text-center" style="position: relative;">
          <?php
            if ($verify == 'all_include') {?>
              <img src="<?=base_url()?>/upload/assets/verified.png" alt=""  width="40" height="40" style="float: right; position: absolute;right: 30%;top: 20%;z-index: 9;">
              <?php }?>
            <?php if ($profile[0]->profile_photo != '') { ?>
              <img src="<?=base_url()?><?php echo $profile[0]->profile_photo; ?>" alt="avatar" class="rounded-circle img-fluid" style="height: 145px; width: 150px;box-shadow: 0 0 2rem 0 rgba(22,23,24,.15)!important;">
            <?php } else {?>
              <img src="<?=base_url()?>/upload/assets/images/male.jpg" alt="avatar" class="rounded-circle img-fluid" style="height: 145px;  width: 150px;box-shadow: 0 0 2rem 0 rgba(22,23,24,.15)!important;">
            <?php }?>
            <h5 class="my-3" style="height: 32px;"></h5>
            <div class="mb-1" >
                <?php
                  if ($profile[0]->name != '') {
                      $name = $profile[0]->name;
                  } else {
                      $name = '';
                  }
                ?>
                <P style="color: #32325d;"><i class="fa fa-user" aria-hidden="true"></i> <?php echo $name; ?></p>
              </div>

              <div class="mb-1" >
                <p>
                  <i class="fa fa-phone" aria-hidden="true"></i>
                  <a _ngcontent-vki-c278="" href="tel:<?php echo $profile[0]->mobile_no; ?>"><?php echo $profile[0]->mobile_no; ?></a>
                </p>
              </div>
              <?php if ($this->session->userdata('role') != 1) {?>
                <div class="mb-1" ><?php echo $profile[0]->code; ?></div>
              <?php }?>
              <div class="mb-1" >
                <i class="fa fa-envelope" aria-hidden="true"></i>
                
                
                <a _ngcontent-vki-c278="" target="_blank" href="https://mail.google.com/mail/?view=cm&amp;to=<?php echo $profile[0]->email; ?>"> <?php echo $profile[0]->email; ?></a><br>
                <?php if ( $this->session->userdata('role') != 1 &&  $profile[0]->parent_id_role != 1) {?>
                  <a href="<?=base_url('admin/agreement');?>" target="_blank" class="btn btn-outline-primary btn-sm mt-2" style="border-radius: 20px; padding: 5px 15px; transition: all 0.3s ease;">
                    <i class="fa fa-file pr-2" aria-hidden="true"></i> View Agreement
                  </a>
                  <?php } ?>
                  

            </div>

          </div>

        </div>


      </div>


      <?php 
        $parent_id =[];
        $parent = $this->db->where(['id' => $this->session->userdata('user_id'),'role' => $this->session->userdata('role')])->get('user_master')->row_array();
        // print_r($parent);die;
        if(!empty($parent)){
          if($parent['parent_id_role'] == 3){
            $parent_id = $this->db->where('id', $parent['parent_id'])->get('branch_franchise')->row_array();
          }else{
          $parent_id = $this->db->where('id', $parent['parent_id'])->get('user_master')->row_array();
          }
        }
      ?>
      <div class="col-lg-8 px-1">

      <!-- card start -->
      <div class="card" style="border-radius: .25rem;">
        <div class="card-header bg-white border-0">
          <div class="row align-items-center">
            <div class="col-8">
              <h3 class="mb-0" style="font-size: 23px;">My Profile</h3>
            </div>
          </div>
        </div>
        <div class="card-header p-2">
          <ul class="nav nav-pills">
            <li class="nav-item">
              <a class="nav-link active" href="#basic_details" data-toggle="tab">Basic Details</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#Bank_Details" data-toggle="tab">Bank Details</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#timeline" data-toggle="tab">KYC</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#change_password" data-toggle="tab">Change Password</a>
            </li>
            <?php if(!empty($parent_id) ){ ?>
            <li class="nav-item">
              <a class="nav-link" href="#parent_detail" data-toggle="tab">Under Parent</a>
            </li>
            <?php }?>
          </ul>
        </div>


      <form class="form-horizontal" action="<?=base_url('admin/dashboard/updateProfile');?>" method="post" enctype="multipart/form-data">
        <div class="card-body">
          <div class="tab-content">
            <div class="tab-pane active" id="basic_details">
                <div class="form-group row">
                  <div class="col-md-6">
                    <div class="row">
                      <div class="col-md-12">
                        <label for="inputName">Name</label>
                      </div>
                      <div class="col-md-12">
                        <input type="text" class="form-control" name="name" id="inputName" placeholder="Name" value="<?php echo $profile[0]->name; ?>">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="row">
                      <div class="col-md-12">
                        <label for="inputName">Email</label>
                      </div>
                      <div class="col-md-12">
                          <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Email" value="<?php echo $profile[0]->email; ?>" readonly>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="row">
                      <div class="col-md-12">
                        <label for="inputName">Mobile</label>
                      </div>
                      <div class="col-md-12">
                        <input type="number" name="mobile_no" class="form-control" id="inputName2" placeholder="Mobile" value="<?php echo $profile[0]->mobile_no; ?>" readonly>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="row">
                      <div class="col-md-12">
                        <label for="inputName">Gender</label>
                      </div>
                      <div class="col-md-12">
                          <!-- <input type="text" class="form-control" id="inputName2" placeholder="gender" value="<?php echo $profile[0]->gender; ?>"> -->
                          <select class="form-select form-control" aria-label="Default select example" name="gender">
                              <option disabled <?php echo ($profile[0]->gender == '') ? 'selected' : ''; ?>  value="">Gender</option>
                              <option <?php echo ($profile[0]->gender == 'Male') ? 'selected' : ''; ?>  value="Male">Male</option>
                              <option <?php echo ($profile[0]->gender == 'Female') ? 'selected' : ''; ?>  value="Female">Female</option>
                              <option <?php echo ($profile[0]->gender == 'Other') ? 'selected' : ''; ?>  value="Other">Other</option>
                            </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="row">
                      <div class="col-md-12">
                        <label for="inputName">Pincode</label>
                      </div>
                      <?php if ($this->session->userdata('role') == 3) {?>
                      <div class="col-md-12">
                          <input type="text" name="pincode" class="form-control" id="inputName2" placeholder="Pincode" value="<?php echo $profile[0]->pincode; ?>">
                      </div>
                      <?php } else {?>
                        <input type="text" name="pin_code" class="form-control" id="inputName2" placeholder="Pincode" value="<?php echo $profile[0]->pin_code; ?>">
                      <?php }?>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="row">
                      <div class="col-md-12">
                        <label for="inputName">City</label>
                      </div>
                      <div class="col-md-12">
                          <input type="text" name="city" class="form-control" id="inputName2" placeholder="City" value="<?php echo $profile[0]->city; ?>">
                            <input type="hidden" name="id" value="<?php echo $profile[0]->id; ?>">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="row">
                      <div class="col-md-12">
                        <label for="inputName">Address</label>
                      </div>
                      <div class="col-md-12">
                          <input type="text" name="address" class="form-control" id="inputName21" placeholder="Address" value="<?php echo $profile[0]->address; ?>">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="row">
                      <div class="col-md-12">
                        <label for="inputName">State</label>
                      </div>
                      <div class="col-md-12">
                          <input type="text" name="state" class="form-control" id="inputEmail" placeholder="State" value="<?php echo $profile[0]->state; ?>">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="inputName">Profile Photo</label>
                        </div>
                        <div class="col-md-12">
                            <input type="file"  accept="image/*" name="profile_photo" class="form-control" id="profile_photo_input" onchange="previewImage(event, 'profile_photo_preview')">
                            <?php if (!empty($profile[0]->profile_photo)): ?>
                                <div class="mt-2">
                                    <small class="text-muted">Current Photo:</small><br>
                                    <img src="<?=base_url()?><?php echo $profile[0]->profile_photo; ?>" 
                                        alt="Profile Photo" 
                                        class="img-thumbnail" 
                                        style="max-width: 150px; max-height: 150px; object-fit:cover;"
                                        id="profile_photo_preview">
                                </div>
                            <?php else: ?>
                                <div class="mt-2">
                                    <small class="text-muted">Preview:</small><br>
                                    <img src="" 
                                        alt="Profile Photo Preview" 
                                        class="img-thumbnail d-none" 
                                        style="max-width: 150px; max-height: 150px; object-fit:cover;"
                                        id="profile_photo_preview">
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="inputName">Your logo</label>
                        </div>
                        <div class="col-md-12">
                            <input type="file" name="user_logo" class="form-control" id="user_logo_input" onchange="previewImage(event, 'user_logo_preview')">
                            <?php if (!empty($profile[0]->user_logo)): ?>
                                <div class="mt-2">
                                    <small class="text-muted">Current Logo:</small><br>
                                    <img src="<?=base_url()?><?php echo $profile[0]->user_logo; ?>" 
                                        alt="User Logo" 
                                        class="img-thumbnail" 
                                        style="max-width: 150px; max-height: 150px;"
                                        id="user_logo_preview"  accept="image/*">
                                </div>
                            <?php else: ?>
                                <div class="mt-2">
                                    <small class="text-muted">Preview:</small><br>
                                    <img src="" 
                                        alt="User Logo Preview" 
                                        class="img-thumbnail d-none" 
                                        style="max-width: 150px; max-height: 150px;"
                                        id="user_logo_preview">
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                
                   <!-- <?php if ($this->session->userdata('role') != 1) {?>
                  <div class="col-md-6">
                    <div class="row">
                      <div class="col-md-12">
                        <label for="inputName">Code</label>
                      </div>
                      <div class="col-md-12">
                          <input type="text" class="form-control" id="inputEmail" placeholder="code" disabled value="<?php echo $profile[0]->code; ?>">
                      </div>
                    </div>
                  </div>
                  <?php }?> -->



                                <!-- <div class="form-group row">
                                  <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                  <div class="col-sm-10">

                                    <input type="text" class="form-control" name="name" id="inputName" placeholder="Name" value="<?php echo $profile[0]->name; ?>">
                                  </div>
                                </div> -->

                                <!-- <div class="form-group row">
                                  <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                  <div class="col-sm-10">
                                    <input type="email" class="form-control" id="inputEmail" placeholder="Email" value="<?php echo $profile[0]->email; ?>" readonly>
                                  </div>
                                </div> -->

                                <!-- <div class="form-group row">
                                  <label for="inputName2" class="col-sm-2 col-form-label">Mobile</label>
                                  <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputName2" placeholder="Mobile" value="<?php echo $profile[0]->mobile_no; ?>" readonly>
                                  </div>
                                </div> -->

                                <!-- <div class="form-group row">
                                  <label for="inputName2" class="col-sm-2 col-form-label">gender</label>
                                  <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputName2" placeholder="gender" value="<?php echo $profile[0]->gender; ?>">
                                  </div>
                                </div> -->

                                <!-- <div class="form-group row">
                                  <label for="inputName2" class="col-sm-2 col-form-label">Pincode</label>
                                  <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputName2" placeholder="Pincode" value="<?php echo $profile[0]->pin_code; ?>">
                                  </div>
                                </div> -->

                                <!-- <div class="form-group row">
                                  <label for="inputName2" class="col-sm-2 col-form-label">City</label>
                                  <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputName2" placeholder="City" value="<?php echo $profile[0]->city; ?>">
                                  </div>
                                </div> -->

                                <!-- <div class="form-group row">
                                  <label for="inputEmail" class="col-sm-2 col-form-label">State</label>
                                  <div class="col-sm-10">
                                    <input type="email" class="form-control" id="inputEmail" placeholder="State" value="<?php echo $profile[0]->state; ?>">
                                  </div>
                                </div> -->

                                <!-- <div class="form-group row">
                                  <label for="inputName2" class="col-sm-2 col-form-label">Profile Photo</label>
                                  <div class="col-sm-10">
                                    <input type="file" name="profile_photo" class="form-control">
                                  </div>
                                </div> -->


                </div>
                      <div class="form-group row">
                        <div class="offset-sm-10 col-sm-2">
                          <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>
            </div>
            <div class="tab-pane" id="Bank_Details">
              <div class="form-group row">
                <div class="col-md-6">
                    <div class="row">
                      <div class="col-md-12">
                      <label for="inputName">Bank IFSC Code</label>
                        <!-- <label for="inputName">Name</label> -->
                      </div>
                      <div class="col-md-12">
                      <input type="text" class="form-control" name="bank_ifsc_code" id="inputName" placeholder="Bank IFSC Code"  value="<?php echo $profile[0]->bank_ifsc_code; ?>">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="row">
                      <div class="col-md-12">
                      <label for="inputEmail">Bank Name</label>
                      </div>
                      <div class="col-md-12">
                      <input type="text" class="form-control"  name="bank_name" id="inputEmail" placeholder="Bank Name"  value="<?php echo $profile[0]->bank_name; ?>">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="row">
                      <div class="col-md-12">
                      <label for="inputName2">Branch Name</label>
                      </div>
                      <div class="col-md-12">
                      <input type="text" class="form-control" name="branch_name" id="inputName2" placeholder="Branch Name"  value="<?php echo $profile[0]->branch_name; ?>">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="row">
                      <div class="col-md-12">
                      <label for="inputName">Account Holder Name</label>
                      </div>
                      <div class="col-md-12">
                      <input type="text" class="form-control"  name="account_holder_name"   id="inputName" placeholder="Account Holder Name"  value="<?php echo $profile[0]->account_holder_name; ?>">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="row">
                      <div class="col-md-12">
                      <label for="inputName">Bank Account Number</label>
                      </div>
                      <div class="col-md-12">
                      <input type="text" class="form-control"  name="bank_account_number"  id="inputName" placeholder="Bank Account Number"  value="<?php echo $profile[0]->bank_account_number; ?>">
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="row">
                      <div class="col-md-12">
                      <label for="inputName">Google Pay UPI Id</label>
                      </div>
                      <div class="col-md-12">
                      <input type="text" class="form-control"  name="gpay_upi"  id="inputName" placeholder="Google Pay UPI"  value="<?php echo $profile[0]->gpay_upi; ?>">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="row">
                      <div class="col-md-12">
                      <label for="inputName">Phone pay UPI Id</label>
                      </div>
                      <div class="col-md-12">
                      <input type="text" class="form-control"  name="ppay_upi"  id="inputName" placeholder="Phone pay UPI Id"  value="<?php echo $profile[0]->ppay_upi; ?>">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="offset-sm-10 col-sm-2">
                    <button type="submit" class="btn btn-success">Submit</button>
                  </div>
                </div>
            </div>

              </form>
            <div class="tab-pane" id="timeline">
              <div class="form-group row">
                  <label for="inputName" class="col-sm-3 col-form-label">Adhar Card No.</label>
                  <div class="col-sm-9">
                    <input type="number" minlength="12" maxlength="12" class="form-control" name="adharcard_no" id="inputName" placeholder="Adhar Card No."  value="<?php echo $profile[0]->adharcard_no; ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputEmail" class="col-sm-3 col-form-label">Pan Card No.</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control"  minlength="10" maxlength="10"  name="pan_card_number" id="inputEmail" placeholder="Pan Card No."  value="<?php echo $profile[0]->pan_card_number; ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputName2" class="col-sm-3 col-form-label">GST No.</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="gst_number" id="inputName2" placeholder="GST No."  value="<?php echo $profile[0]->gst_number; ?>">
                  </div>
                </div>

                <div class="form-group row">
                  <div class="offset-sm-10 col-sm-2">
                    <button type="submit" class="btn btn-success">Submit</button>
                  </div>
                </div>
            </div>

            <div class="tab-pane" id="change_password">
              <?php if ($this->session->flashdata('success')): ?>
                  <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
              <?php endif; ?>

              <?php if ($this->session->flashdata('error')): ?>
                  <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
              <?php endif; ?>

                <form  method="post" action="<?php echo base_url("admin/save-change-password");?>">
                <div class="form-group row">
                    <label for="inputName" class="col-sm-3 col-form-label">New Password</label>
                    <div class="col-sm-9">

                    <input type="hidden" name="uid" value="<?php echo isset($uid) ? $uid : ''; ?>">
                    <input type="hidden" name="role" value="<?php echo isset($role) ? $role : ''; ?>">
                    
                      <input type="password" class="form-control" name="password" value="">
                    </div>
                  </div>
                
                  <div class="form-group row">
                    <div class="offset-sm-10 col-sm-2 m-auto">
                      <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                  </div>  
                 </form>
              </div>
               <?php if(!empty($parent_id) ){ ?>
              <div class="tab-pane" id="parent_detail">
               
                <div class="form-group row">
                  <div class="col-sm-6">
                    <label for="inputName" class="form-label">Parent name</label>
                    <input type="text" readonly class="form-control" value="<?= $parent_id['name'] ?>">
                  </div>
    
                  <div class="col-sm-6">
                    <label for="inputName" class="form-label">Parent mobile no.</label>
                    <input type="text" readonly class="form-control" value="<?= $parent_id['mobile_no'] ?>">
                  </div>
                </div>
              </div>
              <?php }?>
          </div>
          
      </div>
      <!-- card start -->

        <!--<div class="row">-->

          <!--  <div class="col-md-6">-->

          <!--    <div class="card mb-4 mb-md-0">-->

          <!--      <div class="card-body">-->

          <!--        <p class="mb-4"><span class="text-primary font-italic me-1">assigment</span> Project Status-->

          <!--        </p>-->

          <!--        <p class="mb-1" style="font-size: .77rem;">Web Design</p>-->

          <!--        <div class="progress rounded" style="height: 5px;">-->

          <!--          <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80"-->

          <!--            aria-valuemin="0" aria-valuemax="100"></div>-->

          <!--        </div>-->

          <!--        <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>-->

          <!--        <div class="progress rounded" style="height: 5px;">-->

          <!--          <div class="progress-bar" role="progressbar" style="width: 72%" aria-valuenow="72"-->

          <!--            aria-valuemin="0" aria-valuemax="100"></div>-->

          <!--        </div>-->

          <!--        <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>-->

          <!--        <div class="progress rounded" style="height: 5px;">-->

          <!--          <div class="progress-bar" role="progressbar" style="width: 89%" aria-valuenow="89"-->

          <!--            aria-valuemin="0" aria-valuemax="100"></div>-->

          <!--        </div>-->

          <!--        <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>-->

          <!--        <div class="progress rounded" style="height: 5px;">-->

          <!--          <div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="55"-->

          <!--            aria-valuemin="0" aria-valuemax="100"></div>-->

          <!--        </div>-->

          <!--        <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>-->

          <!--        <div class="progress rounded mb-2" style="height: 5px;">-->

          <!--          <div class="progress-bar" role="progressbar" style="width: 66%" aria-valuenow="66"-->

          <!--            aria-valuemin="0" aria-valuemax="100"></div>-->

          <!--        </div>-->

          <!--      </div>-->

          <!--    </div>-->

          <!--  </div>-->

          <!--  <div class="col-md-6">-->

          <!--    <div class="card mb-4 mb-md-0">-->

          <!--      <div class="card-body">-->

          <!--        <p class="mb-4"><span class="text-primary font-italic me-1">assigment</span> Project Status-->

          <!--        </p>-->

          <!--        <p class="mb-1" style="font-size: .77rem;">Web Design</p>-->

          <!--        <div class="progress rounded" style="height: 5px;">-->

          <!--          <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80"-->

          <!--            aria-valuemin="0" aria-valuemax="100"></div>-->

          <!--        </div>-->

          <!--        <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>-->

          <!--        <div class="progress rounded" style="height: 5px;">-->

          <!--          <div class="progress-bar" role="progressbar" style="width: 72%" aria-valuenow="72"-->

          <!--            aria-valuemin="0" aria-valuemax="100"></div>-->

          <!--        </div>-->

          <!--        <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>-->

          <!--        <div class="progress rounded" style="height: 5px;">-->

          <!--          <div class="progress-bar" role="progressbar" style="width: 89%" aria-valuenow="89"-->

          <!--            aria-valuemin="0" aria-valuemax="100"></div>-->

          <!--        </div>-->

          <!--        <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>-->

          <!--        <div class="progress rounded" style="height: 5px;">-->

          <!--          <div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="55"-->

          <!--            aria-valuemin="0" aria-valuemax="100"></div>-->

          <!--        </div>-->

          <!--        <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>-->

          <!--        <div class="progress rounded mb-2" style="height: 5px;">-->

          <!--          <div class="progress-bar" role="progressbar" style="width: 66%" aria-valuenow="66"-->

          <!--            aria-valuemin="0" aria-valuemax="100"></div>-->

          <!--        </div>-->

          <!--      </div>-->

          <!--    </div>-->

          <!--  </div>-->

        <!--</div>-->

      </div>

    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    setTimeout(function() {
      $(".alert").fadeOut("slow");
    }, 5000); // 5 seconds
  });
</script>
<script>
function previewImage(event, previewId) {
    const file = event.target.files[0];
    const preview = document.getElementById(previewId);
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.classList.remove('d-none');
        }
        reader.readAsDataURL(file);
    } else {
        preview.src = '';
        preview.classList.add('d-none');
    }
}
</script>
<!--</section>-->