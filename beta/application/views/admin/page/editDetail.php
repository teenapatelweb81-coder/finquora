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
			 <div class="container-fluid px-0">
			     <form name="channel" method="post" action="<?php echo base_url("admin/update-detail");?>">
			     <input type="hidden" class="form-control" id="id" name="id" value="<?= (isset($datas['id'])) ? $datas['id'] : '' ; ?> " >
			     <input type="hidden" class="form-control" id="id" name="user_id" value="<?=$id?>" >
    			  <div class="row">
    			      <div class="col-md-6">
                        <div class="form-group">
                          <label for="usr">Approval Amount:</label>
                          <input type="text" class="form-control" id="amount" name="amount" value="<?= (isset($datas['amount'])) ? $datas['amount'] : '' ; ?>" >
                        </div>
    			          
    			      </div>
    			      <div class="col-md-6">
    			        <div class="form-group">
                          <label for="usr">Bank Name:</label>
                          <select class="form-control" name="bank_id">
							<option value="">Select Bank</option>
							<?php foreach ($banks as $key => $value) {
								$selected = (isset($datas['bank_id']) && $datas['bank_id'] == $value['id']) ? 'selected' : '';
								?>
                                <option value="<?php echo $value['id'];?>"<?php echo $selected; ?>><?php echo $value['bank_name'];?></option>
                            <?php }?>
						  </select>
                        </div>
    			          
    			      </div>
    			  </div>
    			  <div class="row">
    			      <div class="col-md-6">
                        <div class="form-group">
                          <label for="usr">Emi Amount:</label>
                          <input type="text" class="form-control" id="emi" name="emi" value="<?= (isset($datas['emi'])) ? $datas['emi'] : '' ; ?>">
                        </div>
    			          
    			      </div>
    			      <div class="col-md-6">
    			        <div class="form-group">
                          <label for="usr">Tenure:</label>
                          <input type="text" class="form-control" id="tenure" name="tenure" value="<?= (isset($datas['tenure'])) ? $datas['tenure'] : '' ; ?>">
                        </div>
    			          
    			      </div>
					  <div class="col-md-6">
    			        <div class="form-group">
                          <label for="usr">Rate Of Interest:</label>
                          <input type="text" class="form-control" id="interest" name="interest" value="<?= (isset($datas['interest'])) ? $datas['interest'] : '' ; ?>">
                        </div>
    			          
    			      </div>
					  <div class="col-md-6">
    			        <div class="form-group">
                          <label for="usr">Disbusment:</label>
                          <input type="text" class="form-control" id="disbusment" name="disbusment" value="<?= (isset($datas['disbusment'])) ? $datas['disbusment'] : '' ; ?>">
                        </div>
    			          
    			      </div>

					  <div class="col-md-12">
    			        <div class="form-group">
                          <label for="usr">Remark:</label>
                          <textarea type="text" class="form-control" id="remark" name="remark"><?= (isset($datas['remark'])) ? $datas['remark'] : '' ; ?></textarea>
                        </div>
    			          
    			      </div>
    			  </div>

    			  
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
