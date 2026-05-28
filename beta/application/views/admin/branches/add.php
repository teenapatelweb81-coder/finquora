<div class="container-fluid pb-4 px-0">
    <div class="container-fluid p-0">
        <nav aria-label="breadcrumb">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item "><a href="<?php echo base_url("admin-dashboard");?>" class="text-decoration-none">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= $title ?></li> 
        </ol>
        </nav>
    </div>

    <?= form_open('admin/branches/add', ['class' => 'needs-validation', 'novalidate' => '','enctype'=> 'multipart/form-data']) ?>
        <div class="card shadow-lg border-0 rounded-lg">
            <div class="card-header bg-primary text-white py-3">
                <h5 class="m-0 font-weight-bold"><i class="fas fa-plus-circle mr-2"></i>Branch Information</h5>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle mr-2"></i> Please fill in all required fields marked with an asterisk (*).
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="form-group mb-2">
                            <label class="font-weight-bold"><i class="fas fa-calendar-alt text-primary mr-2"></i>Date <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-calendar"></i></span>
                                </div>
                                <input type="date" name="branch_date" class="form-control form-control-lg" required>
                            </div>
                            <?= form_error('branch_date', '<small class="text-danger"><i class="fas fa-exclamation-circle"></i> ', '</small>') ?>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group mb-2">
                            <label class="font-weight-bold"><i class="fas fa-image text-primary mr-2"></i>Branch Image/Video</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="branch_image" name="branch_image" accept="image/*,video/*" onchange="previewFile(this)">
                                <label class="custom-file-label" for="branch_image">Choose file</label>
                            </div>
                            <small class="form-text text-muted">Recommended size: 800x500px</small>
                            
                            <!-- Preview Container -->
                            <div class="mt-3" id="filePreview" style="display: none;">
                                <div class="card">
                                    <div class="card-body p-2">
                                        <div class="text-center">
                                            <div id="imagePreview" style="display: none;">
                                                <img id="previewImage" src="#" alt="Preview" class="img-fluid rounded" style="max-height: 200px;">
                                            </div>
                                            <div id="videoPreview" style="display: none;">
                                                <video id="previewVideo" controls class="img-fluid rounded" style="max-height: 200px;">
                                                    Your browser does not support the video tag.
                                                </video>
                                            </div>
                                            <button type="button" class="btn btn-sm btn-danger mt-2" onclick="removePreview()">
                                                <i class="fas fa-times mr-1"></i> Remove
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                    function previewFile(input) {
                        const file = input.files[0];
                        if (!file) return;

                        const previewContainer = document.getElementById('filePreview');
                        const imagePreview = document.getElementById('imagePreview');
                        const videoPreview = document.getElementById('videoPreview');
                        const previewImage = document.getElementById('previewImage');
                        const previewVideo = document.getElementById('previewVideo');
                        
                        // Hide both previews initially
                        imagePreview.style.display = 'none';
                        videoPreview.style.display = 'none';
                        
                        // Show the preview container
                        previewContainer.style.display = 'block';

                        if (file.type.startsWith('image/')) {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                previewImage.src = e.target.result;
                                imagePreview.style.display = 'block';
                            }
                            reader.readAsDataURL(file);
                        } 
                        else if (file.type.startsWith('video/')) {
                            previewVideo.src = URL.createObjectURL(file);
                            videoPreview.style.display = 'block';
                        }
                        
                        // Update the file label
                        const label = input.nextElementSibling;
                        label.textContent = file.name;
                    }

                    function removePreview() {
                        const input = document.getElementById('branch_image');
                        const previewContainer = document.getElementById('filePreview');
                        const label = input.nextElementSibling;
                        
                        // Reset the file input
                        input.value = '';
                        
                        // Hide preview container
                        previewContainer.style.display = 'none';
                        
                        // Reset the label
                        label.textContent = 'Choose file';
                        
                        // Clear video source if it exists
                        const previewVideo = document.getElementById('previewVideo');
                        if (previewVideo) {
                            previewVideo.pause();
                            previewVideo.src = '';
                        }
                    }
                    </script>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="form-group mb-2">
                            <label class="font-weight-bold"><i class="fas fa-building text-primary mr-2"></i>Branch Name <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-building"></i></span>
                                </div>
                                <input type="text" name="branch_name" class="form-control form-control-lg" placeholder="Enter branch name" required>
                            </div>
                            <?= form_error('branch_name', '<small class="text-danger"><i class="fas fa-exclamation-circle"></i> ', '</small>') ?>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group mb-2">
                            <label class="font-weight-bold"><i class="fas fa-user-tie text-primary mr-2"></i>Contact Person Name <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" name="contact_person" class="form-control form-control-lg" placeholder="Enter contact person name" required>
                            </div>
                            <?= form_error('contact_person', '<small class="text-danger"><i class="fas fa-exclamation-circle"></i> ', '</small>') ?>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="form-group mb-2">
                            <label class="font-weight-bold"><i class="fas fa-envelope text-primary mr-2"></i>Email <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-at"></i></span>
                                </div>
                                <input type="email" name="email" class="form-control form-control-lg" placeholder="Enter email address" required>
                            </div>
                            <?= form_error('email', '<small class="text-danger"><i class="fas fa-exclamation-circle"></i> ', '</small>') ?>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group mb-2">
                            <label class="font-weight-bold"><i class="fas fa-mobile-alt text-primary mr-2"></i>Mobile <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div>
                                <input type="text" name="mobile" class="form-control form-control-lg" placeholder="Enter mobile number" required>
                            </div>
                            <?= form_error('mobile', '<small class="text-danger"><i class="fas fa-exclamation-circle"></i> ', '</small>') ?>
                        </div>
                    </div>
                </div>
                
                <div class="form-group mb-3">
                    <label class="font-weight-bold"><i class="fas fa-align-left text-primary mr-2"></i>Short Description <span class="text-danger">*</span></label>
                    <textarea name="short_description" class="form-control form-control-lg" rows="2" placeholder="Enter a brief description (max 200 characters)" maxlength="200" required></textarea>
                    <?= form_error('short_description', '<small class="text-danger"><i class="fas fa-exclamation-circle"></i> ', '</small>') ?>
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold"><i class="fas fa-align-justify text-primary mr-2"></i>Long Description</label>
                    <textarea name="long_description" class="form-control form-control-lg" id="long_description" rows="4" placeholder="Enter detailed description"></textarea>
                </div>

                <div class="form-group mb-4">
                    <label class="font-weight-bold"><i class="fas fa-map-marker-alt text-primary mr-2"></i>Full Address <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-home"></i></span>
                        </div>
                        <textarea name="address" class="form-control form-control-lg" rows="3" placeholder="Enter full address" required></textarea>
                    </div>
                    <?= form_error('address', '<small class="text-danger"><i class="fas fa-exclamation-circle"></i> ', '</small>') ?>
                </div>
                
                <?php if ($this->session->userdata('type') == 'admin') {?>
                <div class="form-group mb-4">
                    <label class="font-weight-bold"><i class="fas fa-globe text-primary mr-2"></i>Domain <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-server"></i></span>
                        </div>
                        <select name="domain_id" class="form-control form-control-lg" required>
                            <option value="">-- Select Domain --</option>
                            <?php foreach ($domains as $domain): ?>
                                <option value="<?= $domain['id'] ?>" <?= set_select('domain_id', $domain['id']) ?>><?= $domain['url'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <?= form_error('domain_id', '<small class="text-danger"><i class="fas fa-exclamation-circle"></i> ', '</small>') ?>
                </div>
                <?php }else{?>
                    <input type="hidden" value="<?= domain_id_get()?>" name="domain_id" >
                <?php }?>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <div class="form-group mb-2">
                            <label class="font-weight-bold"><i class="fas fa-city text-primary mr-2"></i>City <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-city"></i></span>
                                </div>
                                <input type="text" name="city" class="form-control form-control-lg" placeholder="Enter city" required>
                            </div>
                            <?= form_error('city', '<small class="text-danger"><i class="fas fa-exclamation-circle"></i> ', '</small>') ?>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="form-group mb-2">
                            <label class="font-weight-bold"><i class="fas fa-map-marked-alt text-primary mr-2"></i>State <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-map"></i></span>
                                </div>
                                <input type="text" name="state" class="form-control form-control-lg" placeholder="Enter state" required>
                            </div>
                            <?= form_error('state', '<small class="text-danger"><i class="fas fa-exclamation-circle"></i> ', '</small>') ?>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="form-group mb-2">
                            <label class="font-weight-bold"><i class="fas fa-map-pin text-primary mr-2"></i>Pincode <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                                </div>
                                <input type="text" name="pincode" class="form-control form-control-lg" placeholder="Enter pincode" required>
                            </div>
                            <?= form_error('pincode', '<small class="text-danger"><i class="fas fa-exclamation-circle"></i> ', '</small>') ?>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="form-group mb-2">
                            <label class="font-weight-bold"><i class="fas fa-globe-asia text-primary mr-2"></i>Country</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-flag"></i></span>
                                </div>
                                <input type="text" name="country" class="form-control form-control-lg" value="India" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group mb-2">
                            <label class="font-weight-bold d-block"><i class="fas fa-power-off text-primary mr-2"></i>Status</label>
                            <div class="custom-control custom-switch custom-switch-lg">
                                <input type="checkbox" class="custom-control-input" id="status" name="status" checked>
                                <label class="custom-control-label" for="status"><span class="badge badge-success">Active</span></label>
                                <small class="form-text text-muted">Toggle to enable/disable this branch</small>
                            </div>
                        </div>
                    </div>
                </div>
                
                
            </div>
            <div class="card-footer bg-light py-3">
                <div class="d-flex gap-1">
                    <a href="<?= base_url('admin/branches') ?>" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left mr-2"></i>Back to List
                    </a>
                    <button type="submit" class="btn btn-primary px-4 ml-2">
                        <i class="fas fa-save mr-2"></i>Save Branch
                    </button>
                    <div>
                    </div>
                </div>
            </div>
        </div>
    <?= form_close() ?>
</div>

<!-- Add this before closing body tag -->
<script>
// Form validation
(function() {
    'use strict';
    window.addEventListener('load', function() {
        var forms = document.getElementsByClassName('needs-validation');
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();

// Initialize CKEditor for long description
CKEDITOR.replace('long_description', {
    toolbar: [
        { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike', '-', 'RemoveFormat'] },
        { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Blockquote'] },
        { name: 'links', items: ['Link', 'Unlink'] },
        { name: 'document', items: ['Source'] }
    ],
    height: 150,
    removeButtons: 'Subscript,Superscript,Image,Table,HorizontalRule,SpecialChar',
    removePlugins: 'elementspath',
    resize_enabled: false
});

// Update file input label with selected file name
$("input[type='file']").change(function(){
    var fileName = $(this).val().split('\\\\').pop();
    $(this).next('.custom-file-label').html(fileName || 'Choose image');
});

// Add animation to form elements
$(document).ready(function() {
    $('.form-control').on('focus', function() {
        $(this).parent().find('.input-group-text').addClass('bg-primary text-white');
    }).on('blur', function() {
        $(this).parent().find('.input-group-text').removeClass('bg-primary text-white');
    });
});
</script>
