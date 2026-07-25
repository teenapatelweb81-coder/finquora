<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>




<div class="container-fluid p-0">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin-dashboard");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">update contact us details</li> 
           </ol>
         </nav>
</div>
<div class="container-fluid">
    
    
    <!-- <form action="<?php //base_url('admin/banker-create')?>" method="post"> -->
        <div class="row">
        

            <div class="col-md-12 px-0 form-main">
                <div class="card  form-card">
                    <div id="success_message"></div>
                    <span class="text-center text-info mb-2" id="susid"></span>  <?php //echo $this->session->flashdata('success');?>
                    <span class="text-center text-white bg-danger mb-2" id="errid"> </span> <?php // echo $this->session->flashdata('error');?>
            <?php echo form_open_multipart('admin/contect-us-update');?>
                    <span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success'); ?></span>
                    <span class="text-center text-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error'); ?></span>
                    
                
                    <div class="row">
                        <input type="hidden" name="id" id="uid" class="form-control" value="<?php echo isset($datas['id']) ? $datas['id'] : ''; ?>" >
                    
                    </div>

                    
                    <div class="row">

                    <?php
                            $selected_domain_id = isset($_GET['domain_id']) ? (int)$_GET['domain_id'] : null;
                            
                            if ($selected_domain_id) {
                                $website_id = $selected_domain_id;
                            } else {
                                $website_id = domain_id_get();
                            }

                            if ($this->session->userdata('type') == 'admin') { ?>
                                <div class="col-12 mb-3">
                                    <div class="col-4 mb-3">
                                        <label for="domain_id_main" class="col-form-label">Domain</label>
                                        <select class="form-control" id="domain_id_main" required name="domain_id" onchange="window.location.href = window.location.pathname + '?domain_id=' + this.value;">
                                            <?php foreach ($domains as $domain) { ?>
                                                <option <?= ($website_id == $domain['id']) ? 'selected' : ''; ?> value="<?= $domain['id'] ?>"> <?= $domain['url'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                        <?php }else{?>
                            <input type="hidden" name="domain_id"  class="form-control" value="<?= $website_id ?>" >
                        <?php }?>
                            
                       <div class="col-md-6">
                        <label for="title" class="form-label">Text<span class="text-danger">*</span></label>
                        <input type="text" name="title" id="title" class="form-control" value="<?php echo isset($datas['title']) ? $datas['title'] : ''; ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label for="heading" class="form-label">Heading<span class="text-danger">*</span></label>
                        <input type="text" name="heading" id="heading" class="form-control" value="<?php echo isset($datas['heading']) ? $datas['heading'] : ''; ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label for="background_img" class="form-label">Background Img<span class="text-danger">*</span></label>
                        <input type="file" name="background_img" id="background_img" class="form-control" <?php echo empty($datas['background_img']) ? 'required' : ''; ?>>
                        <?php if (!empty($datas['background_img'])) { ?>
                            <div class="preview mt-3">
                                <img id="preview_background_img" src="<?php echo base_url('assets/images/contect-us/' . $datas['background_img']); ?>" alt="Image" width="100">
                            </div>
                        <?php } ?>
                    </div>

                    <div class="col-md-6">
                        <label for="contect_form_heading" class="form-label">Contact Form Heading<span class="text-danger">*</span></label>
                        <input type="text" name="contect_form_heading" id="contect_form_heading" class="form-control" value="<?php echo isset($datas['contect_form_heading']) ? $datas['contect_form_heading'] : ''; ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label for="content_form_text" class="form-label">Content Form Text<span class="text-danger">*</span></label>
                        <input type="text" name="content_form_text" id="content_form_text" class="form-control" value="<?php echo isset($datas['content_form_text']) ? $datas['content_form_text'] : ''; ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label for="mobile_no" class="form-label">Whatsapp no.<span class="text-danger">*</span></label>
                        <input type="text" name="whatsapp_no" id="whatsapp_no" class="form-control" value="<?php echo isset($datas['whatsapp_no']) ? $datas['whatsapp_no'] : ''; ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label for="company_gmail" class="form-label">Company Gmail<span class="text-danger">*</span></label>
                        <input type="text" name="company_gmail" id="company_gmail" class="form-control" value="<?php echo isset($datas['company_gmail']) ? $datas['company_gmail'] : ''; ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label for="mobile_no" class="form-label">Mobile No.<span class="text-danger">*</span></label>
                        <input type="text" name="mobile_no" id="mobile_no" class="form-control" value="<?php echo isset($datas['mobile_no']) ? $datas['mobile_no'] : ''; ?>" required>
                    </div>


                    <div class="col-md-6">
                        <label for="other_gmail" class="form-label">Other Gmail</label>
                        <input type="text" name="other_gmail" id="other_gmail" class="form-control" value="<?php echo isset($datas['other_gmail']) ? $datas['other_gmail'] : ''; ?>" >
                    </div>

                    <div class="col-md-6">
                        <label for="ownere_gmail" class="form-label">Owner Gmail</label>
                        <input type="text" name="ownere_gmail" id="ownere_gmail" class="form-control" value="<?php echo isset($datas['ownere_gmail']) ? $datas['ownere_gmail'] : ''; ?>" >
                    </div>

                    <div class="col-md-6">
                        <label for="other_mobile" class="form-label">Other Mobile</label>
                        <input type="text" name="other_mobile" id="other_mobile" class="form-control" value="<?php echo isset($datas['other_mobile']) ? $datas['other_mobile'] : ''; ?>" >
                    </div>

                    <div class="col-md-6">
                        <label for="owner_mobile" class="form-label">Owner Mobile</label>
                        <input type="text" name="owner_mobile" id="owner_mobile" class="form-control" value="<?php echo isset($datas['owner_mobile']) ? $datas['owner_mobile'] : ''; ?>" >
                    </div>

                    <div class="col-md-6">
                        <label for="company_url" class="form-label">Company Url<span class="text-danger">*</span></label>
                        <input type="text" name="company_url" id="company_url" class="form-control" value="<?php echo isset($datas['company_url']) ? $datas['company_url'] : ''; ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label for="cin_no" class="form-label">CIN No<span class="text-danger">*</span></label>
                        <input type="text" name="cin_no" id="cin_no" class="form-control" value="<?php echo isset($datas['cin_no']) ? $datas['cin_no'] : ''; ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label for="gst_no" class="form-label">GST No<span class="text-danger">*</span></label>
                        <input type="text" name="gst_no" id="gst_no" class="form-control" value="<?php echo isset($datas['gst_no']) ? $datas['gst_no'] : ''; ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label for="registered_office" class="form-label">Registered Office<span class="text-danger">*</span></label>
                        <input type="text" name="registered_office" id="registered_office" class="form-control" value="<?php echo isset($datas['registered_office']) ? $datas['registered_office'] : ''; ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label for="google" class="form-label">Google<span class="text-danger">*</span></label>
                        <input type="text" name="google" id="google" class="form-control" value="<?php echo isset($datas['google']) ? $datas['google'] : ''; ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label for="facebook" class="form-label">Facebook<span class="text-danger">*</span></label>
                        <input type="text" name="facebook" id="facebook" class="form-control" value="<?php echo isset($datas['facebook']) ? $datas['facebook'] : ''; ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label for="instagram" class="form-label">Instagram<span class="text-danger">*</span></label>
                        <input type="text" name="instagram" id="instagram" class="form-control" value="<?php echo isset($datas['instagram']) ? $datas['instagram'] : ''; ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label for="twitter" class="form-label">Twitter<span class="text-danger">*</span></label>
                        <input type="text" name="twitter" id="twitter" class="form-control" value="<?php echo isset($datas['twitter']) ? $datas['twitter'] : ''; ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label for="linkedin" class="form-label">LinkedIn<span class="text-danger">*</span></label>
                        <input type="text" name="linkedin" id="linkedin" class="form-control" value="<?php echo isset($datas['linkedin']) ? $datas['linkedin'] : ''; ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label for="pinterest" class="form-label">Pinterest<span class="text-danger">*</span></label>
                        <input type="text" name="pinterest" id="pinterest" class="form-control" value="<?php echo isset($datas['pinterest']) ? $datas['pinterest'] : ''; ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label for="youtube" class="form-label">YouTube<span class="text-danger">*</span></label>
                        <input type="text" name="youtube" id="youtube" class="form-control" value="<?php echo isset($datas['youtube']) ? $datas['youtube'] : ''; ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label for="description" class="form-label">Description<span class="text-danger">*</span></label>
                        <textarea name="description" id="description" class="form-control" required><?php echo isset($datas['description']) ? $datas['description'] : ''; ?></textarea>
                    </div>

                    
                    <div class="col-md-6">
                        <label for="company_name" class="form-label">Company name<span class="text-danger">*</span></label>
                        <input type="text" name="company_name" id="company_name" class="form-control" value="<?php echo isset($datas['company_name']) ? $datas['company_name'] : ''; ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label for="company_title" class="form-label">Company title<span class="text-danger">*</span></label>
                        <input type="text" name="company_title" id="company_title" class="form-control" value="<?php echo isset($datas['company_title']) ? $datas['company_title'] : ''; ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label for="copyright" class="form-label">Copy right<span class="text-danger">*</span></label>
                        <input type="text" name="copyright" id="copyright" class="form-control" value="<?php echo isset($datas['copyright']) ? $datas['copyright'] : ''; ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label for="logo" class="form-label">Logo<span class="text-danger">*</span></label>
                        <input type="file" name="logo" id="logo" class="form-control" <?php echo empty($datas['logo']) ? 'required' : ''; ?>>
                        <?php if (!empty($datas['logo'])) { ?>
                            <div class="preview mt-3">
                                <img id="preview_logo" src="<?php echo base_url('assets/images/logo/' . $datas['logo']); ?>" alt="Image" width="100">
                            </div>
                        <?php } ?>
                    </div>
                    <div class="col-md-6">
                        <label for="logo_icon" class="form-label">Logo icon<span class="text-danger">*</span></label>
                        <input type="file" name="logo_icon" id="logo_icon" class="form-control" <?php echo empty($datas['logo_icon']) ? 'required' : ''; ?>>
                        <?php if (!empty($datas['logo_icon'])) { ?>
                            <div class="preview mt-3">
                                <img id="preview_logo_icon" src="<?php echo base_url('assets/images/logo/' . $datas['logo_icon']); ?>" alt="Image" width="50">
                            </div>
                        <?php } ?>
                    </div>
                    <div class="col-md-6">
                        <label for="id_card_image" class="form-label">ID card image </label>
                        <input type="file" name="id_card_image" id="id_card_image" class="form-control" >
                        <?php if (!empty($datas['id_card_image'])) { ?>
                            <div class="preview mt-3">
                                <img id="preview_id_card_image" src="<?php echo base_url('assets/images/logo/' . $datas['id_card_image']); ?>" alt="Image" width="50">
                            </div>
                        <?php } ?>
                    </div>
                    <div class="col-md-6">
                        <label for="id_card_bg_image" class="form-label">ID card bg image</label>
                        <input type="file" name="id_card_bg_image" id="id_card_bg_image" class="form-control" >
                        <?php if (!empty($datas['id_card_bg_image'])) { ?>
                            <div class="preview mt-3">
                                <img id="preview_id_card_bg_image" src="<?php echo base_url('assets/images/logo/' . $datas['id_card_bg_image']); ?>" alt="Image" width="50">
                            </div>
                        <?php } ?>
                    </div>
                    <div class="col-md-6">
                        <label for="offer_letter_image" class="form-label">Offer letter image</label>
                        <input type="file" name="offer_letter_image" id="offer_letter_image" class="form-control" >
                        <?php if (!empty($datas['offer_letter_image'])) { ?>
                            <div class="preview mt-3">
                                <img id="preview_offer_letter_image" src="<?php echo base_url('assets/images/logo/' . $datas['offer_letter_image']); ?>" alt="Image" width="50">
                            </div>
                        <?php } ?>
                    </div>
                    <div class="col-md-6">
                        <label for="payment_images" class="form-label">Footer payment method image <span class="text-danger">*</span></label>
                        <input type="file" name="payment_images" id="payment_images" class="form-control" <?php echo empty($datas['payment_images']) ? 'required' : ''; ?>>
                        <?php if (!empty($datas['payment_images'])) { ?>
                            <div class="preview mt-3">
                                <img id="preview_payment_images" src="<?php echo base_url('assets/images/logo/' . $datas['payment_images']); ?>" alt="Image" width="100">
                            </div>
                        <?php } ?>
                    </div>
                    <div class="col-md-6">
                        <label for="header_w_logo" class="form-label">Header logo width(px)</label>
                        <input type="number" name="header_w_logo" id="header_w_logo" class="form-control"  value="<?php echo isset($datas['header_w_logo']) ? $datas['header_w_logo'] : ''; ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="header_h_logo" class="form-label">Header logo height(px)</label>
                        <input type="number" name="header_h_logo" id="header_h_logo" class="form-control"  value="<?php echo isset($datas['header_h_logo']) ? $datas['header_h_logo'] : ''; ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="footer_w_logo" class="form-label">Footer logo width(px)</label>
                        <input type="number" name="footer_w_logo" id="footer_w_logo" class="form-control"  value="<?php echo isset($datas['footer_w_logo']) ? $datas['footer_w_logo'] : ''; ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="footer_h_logo" class="form-label">Footer logo height(px)</label>
                        <input type="number" name="footer_h_logo" id="footer_h_logo" class="form-control"  value="<?php echo isset($datas['footer_h_logo']) ? $datas['footer_h_logo'] : ''; ?>">
                    </div>
                </div>
                    
                
                    
                    <div class="row">
                        
                        <div class="col-md-5">
                            
                        </div>
                        <div class="col-md-2"> 
                            <div class="form-group">
                            <button type="submit"  id="create" value="create" class="btn btn-info mt-4">update </button>
                            <!-- <a href="<?php //echo base_url('admin/banker_create') ;?>" class="btn btn-secondary mt-4">Create</a> -->
                            </div>
                            
                        </div>
                        <!-- <div class="col-md-5">
                            
                        </div> -->
                        
                    </div>
                    <?php echo form_close();?>
                </div>
            </div>
        </div>
    <!-- </form> -->
</div>
<script>
function showImagePreview(input, previewId) {
    if (input.files && input.files[0]) {
        let reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById(previewId).src = e.target.result;
            document.getElementById(previewId).style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    }
}

// All image inputs
document.getElementById('background_img')?.addEventListener('change', function(){
    showImagePreview(this, 'preview_background_img');
});

document.getElementById('logo')?.addEventListener('change', function(){
    showImagePreview(this, 'preview_logo');
});

document.getElementById('logo_icon')?.addEventListener('change', function(){
    showImagePreview(this, 'preview_logo_icon');
});

document.getElementById('id_card_image')?.addEventListener('change', function(){
    showImagePreview(this, 'preview_id_card_image');
});

document.getElementById('id_card_bg_image')?.addEventListener('change', function(){
    showImagePreview(this, 'preview_id_card_bg_image');
});

document.getElementById('offer_letter_image')?.addEventListener('change', function(){
    showImagePreview(this, 'preview_offer_letter_image');
});

document.getElementById('payment_images')?.addEventListener('change', function(){
    showImagePreview(this, 'preview_payment_images');
});
</script>
