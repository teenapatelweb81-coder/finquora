<div class="content-wrapper m-0">
    <div class="container-fluid p-0">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url("admin-dashboard");?>" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= $page_title ?></li> 
            </ol>
        </nav>
    </div>

    <section class="content">
        <div class="row m-0">
            <div class="col-md-12 col-md-offset-2 px-0">
                <div class="card-ui">
                    
                    <div class="card-header-ui">
                        <h3>🔔 Create Marketing Notification</h3>
                        <p class="text-muted">
                            This message will be shown to users.
                        </p>
                    </div>

                    <form method="post" enctype="multipart/form-data" action="<?= base_url('admin/marketing-notification-add')?>" en>
                        <!-- TITLE -->
                        <div class="row m-0">
                            <div class="col-md-6 ">
                                <div class="form-group">
                                    <label>Notification Title</label>
                                    <input type="text" class="form-control" name="title"
                                        placeholder="Eg: New Year Offer 🎉" readonly
                                        value="Marketing Notifications">
                                    <small class="form-text">Short and clear title for users</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Media Upload *</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="document" id="document" accept="image/*,video/*" onchange="previewFile(this)">
                                        <label class="custom-file-label" for="document">Choose image or video</label>
                                    </div>
                                    
                                    <!-- Media Preview Container -->
                                    <div class="mt-3" id="mediaPreview">
                                        <!-- Image Preview -->
                                        <div id="imagePreview" style="display: none; max-width: 100%; margin-top: 10px;">
                                            <img id="previewImage" src="#" alt="Preview" style="width: 200px; max-height: 150px; border: 1px solid #ddd; border-radius: 4px; padding: 5px;">
                                            <button type="button" class="btn btn-sm btn-danger mt-2" onclick="clearMediaPreview()">
                                                <i class="fa fa-times"></i> Remove
                                            </button>
                                        </div>
                                        
                                        <!-- Video Preview -->
                                        <div id="videoPreview" style="display: none; max-width: 100%; margin-top: 10px;">
                                            <video id="previewVideo" controls style="width: 200px !important;max-height: 150px;background: #000;">
                                                Your browser does not support the video tag.
                                            </video>
                                            <button type="button" class="btn btn-sm btn-danger mt-2" onclick="clearMediaPreview()">
                                                <i class="fa fa-times"></i> Remove
                                            </button>
                                        </div>
                                        
                                        <!-- File Info (for non-media files) -->
                                        <div class="file-preview" style="display: none;">
                                            <div class="d-flex align-items-center">
                                                <i class="fa fa-file fa-2x text-primary mr-2"></i>
                                                <div>
                                                    <div class="file-name font-weight-bold"></div>
                                                    <small class="file-size text-muted"></small>
                                                </div>
                                                <button type="button" 
                                                        class="btn btn-sm btn-link text-danger ml-auto" 
                                                        onclick="clearMediaPreview()">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Add this JavaScript code before the closing body tag or in your script section -->
                            <script>
                            function previewFile(input) {
                                const file = input.files[0];
                                if (!file) return;

                                const fileType = file.type.split('/')[0]; // 'image' or 'video'
                                const fileSize = (file.size / (1024 * 1024)).toFixed(2); // Size in MB

                                // Hide all previews first
                                document.getElementById('imagePreview').style.display = 'none';
                                document.getElementById('videoPreview').style.display = 'none';
                                document.querySelector('.file-preview').style.display = 'none';

                                // Show appropriate preview based on file type
                                if (fileType === 'image') {
                                    const reader = new FileReader();
                                    reader.onload = function(e) {
                                        const imgPreview = document.getElementById('previewImage');
                                        imgPreview.src = e.target.result;
                                        document.getElementById('imagePreview').style.display = 'block';
                                    }
                                    reader.readAsDataURL(file);
                                } 
                                else if (fileType === 'video') {
                                    const videoPreview = document.getElementById('previewVideo');
                                    videoPreview.src = URL.createObjectURL(file);
                                    document.getElementById('videoPreview').style.display = 'block';
                                } 
                                else {
                                    // For other file types, show file info
                                    const fileName = document.querySelector('.file-name');
                                    const fileSizeEl = document.querySelector('.file-size');
                                    
                                    fileName.textContent = file.name;
                                    fileSizeEl.textContent = `${fileSize} MB`;
                                    document.querySelector('.file-preview').style.display = 'block';
                                }

                                // Update the file input label
                                const label = input.nextElementSibling;
                                label.textContent = file.name;
                            }

                            function clearMediaPreview() {
                                // Clear the file input
                                const fileInput = document.getElementById('document');
                                fileInput.value = '';
                                
                                // Reset the label
                                fileInput.nextElementSibling.textContent = 'Choose image or video';
                                
                                // Hide all previews
                                document.getElementById('imagePreview').style.display = 'none';
                                document.getElementById('videoPreview').style.display = 'none';
                                document.querySelector('.file-preview').style.display = 'none';
                                
                                // Clear preview sources
                                document.getElementById('previewImage').src = '#';
                                document.getElementById('previewVideo').src = '';
                            }

                            // Update the file input label when a file is selected
                            document.getElementById('document').addEventListener('change', function() {
                                const fileName = this.files[0] ? this.files[0].name : 'Choose image or video';
                                this.nextElementSibling.textContent = fileName;
                            });
                            </script>

                            <!-- CONTENT -->
                            <div class="col-md-12 ">
                                <div class="form-group">
                                    <label>Message Content *</label>
                                    <textarea class="form-control" name="content" rows="5" id="content" placeholder="Write your message here..."><?= set_value('content'); ?></textarea>
                                        <script>
                                        CKEDITOR.replace( 'content' );
                                        </script>
                                    <small class="form-text">
                                        This message will appear in notifications.
                                    </small>
                                </div>
                            </div>
                            
                            <!-- STATUS -->
                            <div class="col-md-12">
                                <div class="status-box">
                                    <label class="switch">
                                        <input type="checkbox" name="is_active" value="1" checked>
                                        <span class="slider"></span>
                                    </label>
                                    <span class="status-text">Active Notification</span>
                                </div>
                            </div>
                            <!-- ACTIONS -->
                            <div class="col-md-12 ">
                                <div class="text-center mt-4">
                                    <button class="btn btn-primary btn-md" type="submit">
                                        Save Notification
                                    </button>
                                    <a href="<?= base_url('admin/marketing-notification-list'); ?>"
                                    class="btn btn-light btn-md">
                                        Cancel
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>
</div>
<style>
    .card-ui {
    background: #ffffff;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.08);
}

.card-header-ui h3 {
    margin-bottom: 5px;
    font-weight: 600;
}

.form-group label {
    font-weight: 600;
    margin-bottom: 6px;
}

.form-control {
    height: 44px;
    border-radius: 8px;
}

textarea.form-control {
    height: auto;
}

.form-text {
    font-size: 13px;
    color: #6c757d;
}

.schedule-box {
    background: #f8f9fa;
    padding: 15px;
    border-radius: 10px;
    margin: 20px 0;
}

.schedule-box h4 {
    margin-bottom: 15px;
}

.status-box {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-top: 20px;
}

/* Toggle Switch */
.switch {
    position: relative;
    width: 50px;
    height: 26px;
}

.switch input {
    display: none;
}

.slider {
    position: absolute;
    cursor: pointer;
    background: #ccc;
    border-radius: 50px;
    inset: 0;
    transition: .3s;
}

.slider:before {
    content: "";
    position: absolute;
    height: 20px;
    width: 20px;
    left: 3px;
    bottom: 3px;
    background: white;
    border-radius: 50%;
    transition: .3s;
}

.switch input:checked + .slider {
    background: #3c8dbc;
}

.switch input:checked + .slider:before {
    transform: translateX(24px);
}

.status-text {
    font-weight: 600;
}

.btn-lg {
    padding: 12px 30px;
    border-radius: 8px;
}

</style>