
<div class="container-fluid p-0">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin-dashboard");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">About Us Update Form</li>
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
            <?php echo form_open('admin/update-about-us',['id'=>'catfrmm']);?>
            <div class=" row">
                     <div class="col-md-3">
                         <div class="form-group">
                              <label for="Image Alt Description" class="form-label">Trained Professionals<span class="text-danger">*</span></label>
                              <input type="text" name="trainedProfessionals" class="form-control" value="<?= set_value('trainedProfessionals',$datas->trainedProfessionals);?>" placeholder="">
                               <?php echo form_error('trainedProfessionals','<span class="text-danger mt-1">','</span>') ;?>
                         </div>
                     </div>
                     <div class="col-md-3">
                         <div class="form-group">
                              <label for="Image Alt Description" class="form-label">Happy Customer<span class="text-danger">*</span></label>
                              <input type="text" name="happyCustomer" class="form-control" value="<?= set_value('happyCustomer',$datas->happyCustomer);?>" placeholder="Happy Customer">
                               <?php echo form_error('happyCustomer','<span class="text-danger mt-1">','</span>') ;?>
                         </div>
                     </div>
                     <div class="col-md-3">
                         <div class="form-group">
                              <label for="Image Alt Description" class="form-label">Cities<span class="text-danger">*</span></label>
                              <input type="text" name="cities" class="form-control" value="<?= set_value('cities',$datas->cities);?>" placeholder="Cities">
                               <?php echo form_error('cities','<span class="text-danger mt-1">','</span>') ;?>
                         </div>
                     </div>
                     <div class="col-md-3">
                         <div class="form-group">
                              <label for="Image Alt Description" class="form-label">Countries<span class="text-danger">*</span></label>
                              <input type="text" name="countries" class="form-control" value="<?= set_value('countries',$datas->countries);?>" placeholder="Countries">
                              <?php echo form_error('countries','<span class="text-danger mt-1">','</span>') ;?>
                         </div>
                     </div>
            </div>
            <div class="form-group row">
                 <div class="col-sm-12">
                       <label for="Image Alt Description" class=" col-form-label">1<sup>ST</sup> Page Content<span class="text-danger">*</span></label>
                        <input type="hidden" name="id" value="<?= $datas->id ?>">
                        <textarea id="editor" name="firstData" rows="2" class="form-control"><?= $datas->firstData ?></textarea>
                       <?php echo form_error('firstData','<span class="text-danger mt-1">','</span>') ;?>
                        <script>
                         CKEDITOR.replace( 'editor' );
                        </script>
                 </div>
            </div>
            <div class="form-group row">
                 <div class="col-sm-12">
                       <label for="Image Alt Description" class=" col-form-label">2<sup>ND</sup> Page Content<span class="text-danger">*</span></label>
                        <textarea id="editor1" name="SecondData" rows="2" class="form-control"><?= $datas->SecondData ?></textarea>
                       <?php echo form_error('SecondData','<span class="text-danger mt-1">','</span>') ;?>
                        <script>
                         CKEDITOR.replace( 'editor1' );
                        </script>
                 </div>
            </div>   

            <div class="border-bottom border border-secondary mb-5 mt-5"></div>
            
            <!--  <div class="form-group row">-->
            <!--   <label for="" class="col-sm-2 col-form-label">Meta Title</label>-->
            <!--   <div class="col-sm-10">-->
            <!--        <input type="text" class="form-control" placeholder="Enter Title" name="metaTitle" value="<?= $datas->metaTitle ?>">                    -->
            <!--    </div>-->
            <!--</div>-->
            
            <!-- <div class="form-group row">-->
            <!--   <label for="" class="col-sm-2 col-form-label">Meta Tag</label>-->
            <!--   <div class="col-sm-10">-->
            <!--        <input type="text" class="form-control" placeholder="Enter Meta Tag" name="metaTag" value="<?= $datas->metaTag ?>">                    -->
            <!--    </div>-->
            <!--</div>-->
            
            <!-- <div class="form-group row">-->
            <!--   <label for="" class="col-sm-2 col-form-label">Meta Description</label>-->
            <!--   <div class="col-sm-10">-->
            <!--        <textarea class="form-control" name="metaDescription" rows="2" placeholder="Enter Meta Description"><?= $datas->metaDescription ?></textarea>-->
            <!--    </div>-->
            <!--</div>-->
            
            <div class="form-group row">
               <label for="Status" class="col-sm-2 col-form-label">Status <span class="text-danger">*</span></label>
               <div class="col-sm-10">
                  <select class="form-control" name="status" id="status">
                     <option value="">---- Choose a Status ----</option>
                     <option value="1" selected=""> Active</option>
                     <option value="0"> Inctive</option>
                  </select>
                  <span id="statusErr"></span>
                  <?php echo form_error('status','<span class="text-danger mt-1">','</span>') ;?>
               </div>
            </div>
            <div class="form-group">
               <label for="" class="col-sm-2 col-form-label"></label>
               <input type="submit" name="submit" id="submit" value="Update" class="btn btn-primary mt-4">
               <a href="<?php echo base_url('admin/policy') ;?>" class="btn btn-primary mt-4">Show</a>
            </div>
            <?php echo form_close();?>
         </div>
      </div>
   </div>
</div>
