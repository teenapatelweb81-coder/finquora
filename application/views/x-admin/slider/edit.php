<?php
//print_r($datas);
?>

<div class="container-fluid p-0">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin-dashboard");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Slider  Form</li>
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
            <?php echo form_open_multipart('admin/update-slider',['id'=>'sliderfrmm']);?>
            
            <div class="row">
                <div class="col-md-12">
                    <label for="Image Alt Description" class="form-label">Title </label>
                      <input type="text" name="title" id="title" class="form-control" value="<?= set_value('title', $datas->title); ?>" placeholder="Add Title">
                    <?php echo form_error('title','<span class="text-danger mt-1">','</span>') ;?>
               </div>
                <!--<div class="form-group col-md-4">-->
                <!--     <input type="hidden" name="id" value="<?= $datas->id ?>"> <input type="hidden" name="old_img" value="<?= $datas->slider_image ?>">-->
                <!--     <label for="Image Alt Description" class=" col-form-label">Sub Title</label>-->
                <!--     <input type="text" name="sub_title" id="sub_title" class="form-control" title="Enter product image" placeholder="Add Sub Title" value="<?= set_value('sub_title',$datas->sub_title); ?>">-->
                <!--      <?php echo form_error('sub_title','<span class="text-danger mt-1">','</span>') ;?>-->
                <!-- </div>-->
            </div>
            <div class="row">
                 <div class="form-group col-md-6 mt-4">
                     <img src="<?= base_url('upload/assets/images/slider/').$datas->slider_image ?>" style="width:30px; height:30px;"> 
                     <label for="Image Alt Description" class=" col-form-label">Slider Image(Upload size Max 2 MB)</label>
                     <input type="file" name="slider_image" id="slider_image" class="form-control" title="Enter product image" placeholder="Add Catogery image" >
                     <span class="text-center text-danger mb-2" id="errid"> <?php  echo $this->session->flashdata('imgerror');?></span>
                 </div>
                  <input type="hidden" name="id" value="<?= $datas->id ?>"> <input type="hidden" name="old_img" value="<?= $datas->slider_image ?>">
            </div>
            
  
             
            <div class="border-bottom border border-secondary mb-5 mt-5"></div>
             
            <div class="form-group row">
               <label for="Status" class="col-sm-2 col-form-label">Status <span class="text-danger">*</span></label>
               <div class="col-sm-10">
                  <select class="form-control" name="status" id="status">
                     <option value="">---- Choose a Status ----</option>
                     <option value="1" <?= ($datas->status ==1)? 'selected = selected' : '' ?> > Active</option>
                     <option value="0" <?= ($datas->status ==0)? 'selected = selected' : '' ?> > Inactive</option>
                  </select>
                  <span id="statusErr"></span>
                  <?php echo form_error('status','<span class="text-danger mt-1">','</span>') ;?>
               </div>
            </div>
            <div class="form-group">
               <label for="" class="col-sm-2 col-form-label"></label>
               <input type="submit" name="submit" id="submit" value="Update" class="btn btn-info mt-4">
               <a href="<?php echo base_url('admin/slider') ;?>" class="btn btn-secondary mt-4">Show</a>
            </div>
            <?php echo form_close();?>
         </div>
      </div>
   </div>
</div>
