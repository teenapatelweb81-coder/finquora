
<div class="container-fluid p-0">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin-dashboard");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Website setting Update Form</li>
           </ol>
         </nav>
</div>
<div class="container-fluid">
   <div class="row">
      <div class="col-md-12 px-0 form-main">
         <div class="card  form-card">
            <div id="success_message"></div>
             <span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>
             <span class="text-center text-white bg-danger mb-2" id="errid"> <?php  echo $this->session->flashdata('error');?></span>
            <?php echo form_open_multipart('admin/update-site-setting',['id'=>'sliderfrmm']);?>
            
             <input type="hidden" name="id" value="<?= $datas->id ?>"> <input type="hidden" name="old_img" value="<?= $datas->logo ?>">
            <div class="row">
                <div class="col-md-6">
                    <label for="Image Alt Description" class="form-label">Linkedin Link<span class="text-danger">*</span></label>
                      <input type="text" name="linkedin" id="linkedin" class="form-control" value="<?= set_value('linkedin',$datas->linkedin); ?>" >
                       <?php echo form_error('linkedin','<span class="text-danger mt-1">','</span>') ;?>
                </div>
             
                 <div class="form-group col-md-6">
                     <label for="Image Alt Description" class=" col-form-label">Facebook Link<span class="text-danger">*</span></label>
                     <input type="text" name="facebook" id="facebook" class="form-control" value="<?= set_value('facebook',$datas->facebook); ?>" >
                      <?php echo form_error('linkedin','<span class="text-danger mt-1">','</span>') ;?>
                 </div>
                
            </div>
            <div class="row">
             <div class="form-group col-md-6">
                <label for="Image Alt Description" class=" col-form-label">Twitter Link<span class="text-danger">*</span></label>
                 <input type="text" name="twitter" id="instagram" class="form-control" value="<?= set_value('twitter',$datas->twitter); ?>" >
                  <?php echo form_error('twitter','<span class="text-danger mt-1">','</span>') ;?>
             </div>
             <div class="form-group col-md-6">
                 <img src="<?= base_url('upload/assets/images/').$datas->logo ?>" style="width:30px; height:30px;"> 
                 <label for="Image Alt Description" class=" col-form-label">Logo(Upload size Max 2 MB)<span class="text-danger">*</span></label>
                 <input type="file" name="logo" id="logo" class="form-control" >
                 <span class="text-center text-danger mb-2" id="errid"> <?php  echo $this->session->flashdata('imgerror');?></span>
             </div>
            </div>
            <div class="row">
             <div class="form-group col-md-6">
                <label for="Image Alt Description" class=" col-form-label">Email<span class="text-danger">*</span></label>
                 <input type="text" name="email" id="email" class="form-control" value="<?= set_value('email',$datas->email); ?>" >
                  <?php echo form_error('email','<span class="text-danger mt-1">','</span>') ;?>
             </div>
             <div class="form-group col-md-6">
                 <label for="Image Alt Description" class=" col-form-label">Mobile No<span class="text-danger">*</span></label>
                 <input type="text" name="mobile" id="mobile" class="form-control" value="<?= set_value('mobile',$datas->mobile); ?>">
                 <?php echo form_error('instagram','<span class="text-danger mt-1">','</span>') ;?>
             </div>
            </div>
              <div class="form-group row">
                <label for="Image Alt Description" class=" col-form-label">Website short description<span class="text-danger">*</span></label>
                <textarea  name="short_details" class="form-control"  rows="3"><?= $datas->short_details ?></textarea>
                <?php echo form_error('short_details','<span class="text-danger mt-1">','</span>') ;?>
            </div>
 
            <div class="form-group row">
                <label for="Image Alt Description" class=" col-form-label">Address<span class="text-danger">*</span></label>
                <textarea id="editor" name="address" class="form-control"  rows="1"><?= $datas->address ?></textarea>
                <?php echo form_error('address','<span class="text-danger mt-1">','</span>') ;?>
                <script type="text/javascript">
                    CKEDITOR.replace( 'editor',{
                    height: 100
                    });
                </script>
            </div>
  
         
            <div class="form-group">
               <label for="" class="col-sm-2 col-form-label"></label>
               <input type="submit" name="submit" id="Update" value="Update" class="btn btn-info mt-4">
               <a href="<?php echo base_url('admin/site-setting') ;?>" class="btn btn-secondary mt-4">Show</a>
            </div>
            <?php echo form_close();?>
         </div>
      </div>
   </div>
</div>
