
<div class="container-fluid p-0">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin-dashboard");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Category Update Form</li>
           </ol>
         </nav>
</div>
<div class="container-fluid">
   <div class="row">
      <div class="col-md-12 px-0 form-main">
         <div class="card  form-card">
            <div id="success_message"></div>
             <span class="text-center text-primary mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>
             <span class="text-center text-white bg-danger mb-2" id="errid"> <?php  echo $this->session->flashdata('error');?></span>
            <?php echo form_open_multipart('update-category',['id'=>'catfrmm']);?>
            <div class=" row">
                     <div class="col-sm-6">
                        <label for="Image Alt Description" class="form-label">Category <span class="text-danger">*</span></label>
                        <input type="text" name="category" id="category" class="form-control" value="<?= set_value('category',$datas->category); ?>">
                        <span id="categoryErr"></span>
                        <input type="hidden" name="id" value="<?= $datas->id?>">
                        <input type="hidden" name="old_img" value="<?= $datas->cat_image ?>">
                        <?php echo form_error('category','<span class="text-danger mt-1">','</span>') ;?>
                    </div>
                    <div class="col-md-4">
                      <i class="fa fa-cloud-upload fa-2x text-primary" aria-hidden="true"></i>
                     <label for="Image Alt Description" class=" col-form-label">Catogery Image</label>
                     <input type="file" name="cat_image" id="cat_image" class="form-control" title="Enter product image" placeholder="Add Catogery image">
                   </div>
                   <div class="col-md-2 mt-4">
                       <img src="<?= base_url('upload/assets/images/').$datas->cat_image ?>" style="width:50px; height:50px;" class="img-fluid" >
                   </div>
            </div>
  
            <div class="border-bottom border border-secondary mb-5 mt-5"></div>
            
            <div class="form-group row">
               <label for="Status" class="col-sm-2 col-form-label">Status <span class="text-danger">*</span></label>
               <div class="col-sm-10">
                  <select class="form-control" name="status" id="status">
                     <option value="">---- Choose a Status ----</option>
                     <option value="1" <?= ($datas->status == 1) ?  "selected = 'selected'" : ''; ?> > Active</option>
                     <option value="0" <?= ($datas->status == 0) ?  "selected = 'selected'" : ''; ?> > Inctive</option>
                  </select>
                  <span id="statusErr"></span>
                  <?php echo form_error('status','<span class="text-danger mt-1">','</span>') ;?>
               </div>
            </div>
            <div class="form-group">
               <label for="" class="col-sm-2 col-form-label"></label>
               <input type="submit" name="submit" id="submit" value="Update" class="btn btn-primary mt-4">
               <a href="<?php echo base_url('category') ;?>" class="btn btn-primary mt-4">Show</a>
            </div>
            <?php echo form_close();?>
         </div>
      </div>
   </div>
</div>
