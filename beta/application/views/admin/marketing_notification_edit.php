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
                        <h3>🔔 Edit Marketing Notification</h3>
                        <p class="text-muted">
                            This message will be shown to users.
                        </p>
                    </div>

                    <form method="post" enctype="multipart/form-data" action="<?= base_url('admin/marketing-notification-edit/')?><?= $notification['id']?>">
                        <!-- TITLE -->
                        <div class="row m-0">
                            <div class="col-md-6 ">
                                <div class="form-group">
                                    <label>Notification Title *</label>
                                    <input type="text" class="form-control" name="title"
                                        placeholder="Eg: New Year Offer 🎉"
                                        value="<?= $notification['title']; ?>">
                                        <input type="hidden" value="<?= $notification['id']; ?>">
                                    <small class="form-text">Short and clear title for users</small>
                                </div>
                            </div>
                            <!-- Document Upload -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Document upload</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="document" id="document" onchange="previewFile(this)">
                                        <label class="custom-file-label" for="document">Choose file</label>
                                    </div>
                                    <small class="form-text text-muted">
                                        Supported formats: JPG, PNG, PDF, DOC, DOCX (Max 10MB)
                                    </small>
                                    
                                    <!-- File Preview -->
                                    <div class="mt-3" id="filePreview">
                                        <?php if(!empty($notification['document'])): ?>
                                            <div class="document-preview">
                                                <div class="d-flex align-items-center">
                                                    <?php
                                                    $file_ext = pathinfo($notification['document'], PATHINFO_EXTENSION);
                                                    $icon_class = 'fa-file';
                                                    if(in_array(strtolower($file_ext), ['jpg', 'jpeg', 'png', 'gif'])) {
                                                        $icon_class = 'fa-file-image';
                                                    } elseif(strtolower($file_ext) == 'pdf') {
                                                        $icon_class = 'fa-file-pdf';
                                                    } elseif(in_array(strtolower($file_ext), ['doc', 'docx'])) {
                                                        $icon_class = 'fa-file-word';
                                                    }
                                                    ?>
                                                    <i class="fa <?php echo $icon_class; ?> fa-2x text-primary mr-2"></i>
                                                    <div>
                                                        <div class="font-weight-bold">
                                                            <a href="<?php echo base_url($notification['document']); ?>" 
                                                            target="_blank" 
                                                            class="text-primary">
                                                                View Current Document
                                                            </a>
                                                        </div>
                                                        <small class="text-muted">
                                                            <?php 
                                                            $file_path = FCPATH . $notification['document'];
                                                            if(file_exists($file_path)) {
                                                                echo round(filesize($file_path) / 1024, 2) . ' KB';
                                                            }
                                                            ?>
                                                        </small>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="existing_document" value="<?php echo $notification['document']; ?>">
                                            </div>
                                        <?php else: ?>
                                            <div class="preview-container" style="display: none;">
                                                <div class="d-flex align-items-center">
                                                    <i class="fa fa-file fa-2x text-primary mr-2"></i>
                                                    <div>
                                                        <div class="file-name font-weight-bold"></div>
                                                        <small class="file-size text-muted"></small>
                                                    </div>
                                                    <button type="button" 
                                                            class="btn btn-sm btn-link text-danger ml-auto" 
                                                            onclick="clearFileInput()">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <style>
                            .document-preview, .preview-container {
                                border: 1px solid #dee2e6;
                                border-radius: 5px;
                                padding: 10px;
                                margin-top: 10px;
                                background-color: #f8f9fa;
                            }
                            .custom-file-label::after {
                                content: "Browse";
                            }
                            </style>

                            <script>
                            function previewFile(input) {
                                const previewContainer = document.querySelector('.preview-container');
                                const fileName = document.querySelector('.file-name');
                                const fileSize = document.querySelector('.file-size');
                                const file = input.files[0];
                                
                                if (file) {
                                    const fileSizeKB = (file.size / 1024).toFixed(2);
                                    fileName.textContent = file.name;
                                    fileSize.textContent = fileSizeKB + ' KB';
                                    
                                    // Show preview container
                                    if (previewContainer) {
                                        previewContainer.style.display = 'block';
                                    }
                                    
                                    // Update custom file label
                                    const label = input.nextElementSibling;
                                    label.textContent = file.name;
                                }
                            }

                            function clearFileInput() {
                                const fileInput = document.getElementById('document');
                                const previewContainer = document.querySelector('.preview-container');
                                const fileLabel = document.querySelector('.custom-file-label');
                                
                                fileInput.value = '';
                                if (previewContainer) {
                                    previewContainer.style.display = 'none';
                                }
                                if (fileLabel) {
                                    fileLabel.textContent = 'Choose file';
                                }
                            }

                            function removeDocument() {
                                if (confirm('Are you sure you want to remove this document?')) {
                                    const previewContainer = document.querySelector('.document-preview');
                                    if (previewContainer) {
                                        previewContainer.innerHTML = `
                                            <input type="hidden" name="remove_document" value="1">
                                            <div class="text-muted">Document will be removed after saving</div>
                                        `;
                                    }
                                }
                            }
                            </script>

                            <!-- CONTENT -->
                            <div class="col-md-12 ">
                                <div class="form-group">
                                    <label>Message Content *</label>
                                    <textarea class="form-control" name="content" rows="5" id="content" placeholder="Write your message here..."><?= $notification['content']; ?></textarea>
                                        <script>
                                        CKEDITOR.replace( 'content' );
                                        </script>
                                    <small class="form-text">
                                        This message will appear in notifications.
                                    </small>
                                </div>
                            </div>
                            
                            <!-- STATUS -->
                            <!-- <div class="col-md-12">
                                <div class="status-box">
                                    <label class="switch">
                                        <input type="checkbox" name="is_active" value="1" checked>
                                        <span class="slider"></span>
                                    </label>
                                    <span class="status-text">Active Notification</span>
                                </div>
                            </div> -->
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