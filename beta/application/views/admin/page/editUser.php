<style>
.container {
    margin-top: 20px;
    margin-bottom: 15px;
}
</style>


<div class="container-fluid p-0">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin/Dashboard/");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Edit user</li>
           </ol>
         </nav>
</div>
<div class="container-fluid px-0">
	<div class="row m-0">
		<div class="col-md-12 px-0">
		    <div id="message" class="text-primary text-center"></div>
			<div class="table-responsive shadow-lg">
			 <div class="container-fluid px-2 py-3">
			     <form name="channel" method="post" action="<?php echo base_url("admin/update-user");?>">
			     <input type="hidden" class="form-control" id="id" name="id" value="<?=$datas[0]->id?>" >
    			  <div class="row">
    			      <div class="col-md-6">
                        <div class="form-group mb-2">
                          <label for="usr">Name:</label>
                          <input type="text" class="form-control" id="name" name="name" value="<?=$datas[0]->name?>" >
                        </div>
    			          
    			      </div>
    			      <div class="col-md-6">
    			        <div class="form-group mb-2">
                          <label for="usr">Email:</label>
                          <input type="text" class="form-control" id="email" name="email" value="<?=$datas[0]->email?>" readonly>
                        </div>
    			          
    			      </div>
    			  </div>
    			  <div class="row">
    			      <div class="col-md-6">
                        <div class="form-group mb-2">
                          <label for="usr">username:</label>
                          <input type="text" class="form-control" id="username" name="username" value="<?=$datas[0]->username?>">
                        </div>
    			          
    			      </div>
    			      <div class="col-md-6">
    			        <div class="form-group mb-2">
                          <label for="usr">mobile:</label>
                          <input type="text" class="form-control" id="mobile" name="mobile" value="<?=$datas[0]->mobile?>">
                        </div>
    			          
    			      </div>
    			  </div>
    			  <div class="row">
    			      <div class="col-md-6">
                        <div class="form-group mb-2">
                          <label for="usr">Status:</label>
                          <select name="status" class="form-control">
                             
                              <option value="0" <?php if($datas[0]->status == 0) { echo "selected"; }; ?>>Inactive</option>
                               <option value="1" <?php if($datas[0]->status == 1) { echo "selected"; }; ?>>Active</option>
                          </select>
                          <!--<input type="text" class="form-control" id="username" name="username" value="<?=$datas[0]->username?>">-->
                        </div>
    			          
    			    </div>

				  
				<?php 
					if(domain_id_get() == 3){
						if (empty($ref)) {?>
							<div class="col-md-6">
								<div class="form-group mb-2">
								<label for="parent_team_id">Select Team</label>
									<select class="form-control" name="parent_team_id" >
										<option value="">Select Team</option>
										<?php
											if($teamData){
												foreach($teamData as $team_data){
													$selected = ($datas[0]->parent_team_id ==  $team_data->id) ? 'selected' : '';
													echo '<option '.$selected.' value="'.$team_data->id.'">'.$team_data->name.'</option>';
												}
											} 
										?>
									</select>
								</div>
							</div>
							<?php } }?>
						</div>
    			  
				   <?php if($this->session->userdata('type') == 'admin'){?>
				  <h3>Transfer user</h3>

				  <div class="row">
					<div class="col-md-6 my-2">
							<label for="domain_id" class="col-form-label">Domain</label>
							<select class="form-control" id="domain_id" required name="domain_id">
								<?php foreach ($domains as $domain) { ?>
									<option <?= ($datas[0]->domain_id == $domain['id']) ? 'selected' : ''; ?> value="<?= $domain['id'] ?>"> <?= $domain['url'] ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					
					<?php }?>
					
    			  <div class="row">
    			      <div class="col-md-5">
                          
    			      </div>
    			       <div class="col-md-2">
    			           
    			            <input type="submit" name="update" class="btn btn-primary" value="Submit">
    			          
    			      </div>
    			      <div class="col-md-5">
    			          
    			      </div>
    			  </div>
    			</form>
    			  
			  </div>
			</div>
		</div>
	</div>
</div>
