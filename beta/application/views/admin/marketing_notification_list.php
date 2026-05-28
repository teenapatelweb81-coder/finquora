
<style>
    iframe {
        width: 200px !important;
        height: 100px !important;
    }
    p{
        margin-bottom: 0px;
    }
    .notification-card {
        max-width: 600px;
        margin: 20px auto;
        border: 1px solid #e6e6e6;
        border-radius: 8px;
        background: #fff;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
    .notification-header {
        display: flex;
        align-items: center;
        padding: 12px 15px;
        border-bottom: 1px solid #efefef;
    }
    .user-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        margin-right: 10px;
        object-fit: cover;
        background-color: #f0f0f0;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .user-name {
        font-weight: 600;
        color: #262626;
        margin: 0;
        font-size: 14px;
    }
    .notification-content {
        padding: 15px;
    }
    .notification-title  {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 0px;
        color: #262626;
    }

    .document-container {
        margin: 15px 0;
        border: 1px solid #e6e6e6;
        border-radius: 8px;
        overflow: hidden;
    }
    .document-viewer {
        width: 100%;
        height: 500px;
        border: none;
        background: #f8f9fa;
    }
    .document-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 15px;
        background: #f8f9fa;
        border-top: 1px solid #e6e6e6;
    }
    .document-info {
        display: flex;
        align-items: center;
    }
    .document-info img {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        margin-right: 10px;
    }
    .document-details {
        line-height: 1.3;
    }
    .document-details small {
        display: block;
        color: #6c757d;
        font-size: 12px;
    }
    
    .notification-footer {
        padding: 10px 15px;
        border-top: 1px solid #efefef;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .status-badge {
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 500;
    }
    .action-buttons a, .action-buttons button {
        margin-left: 8px;
    }
    .no-notifications {
        text-align: center;
        padding: 40px 20px;
        color: #8e8e8e;
    }
    .add-notification-btn {
        position: fixed;
        bottom: 30px;
        right: 30px;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        font-size: 24px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.2);
        z-index: 1000;
    }
    /* Custom switch styling */
    .custom-switch .custom-control-label::before {
        width: 2.25rem;
        height: 1.25rem;
        pointer-events: all;
        border-radius: 0.625rem;
    }

    .custom-switch .custom-control-label::after {
        width: calc(1.25rem - 4px);
        height: calc(1.25rem - 4px);
        border-radius: 0.5rem;
        background-color: #fff;
    }

    .custom-switch .custom-control-input:checked ~ .custom-control-label::after {
        transform: translateX(1rem);
    }

    /* Make the switch bigger and more touch-friendly */
    .custom-control-label {
        padding-left: 0.5rem;
        cursor: pointer;
    }
</style>

<div class="container-fluid p-0">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item "><a href="<?php echo base_url("admin/Dashboard/");?>" class="text-decoration-none">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= $page_title?></li>
        </ol>
    </nav>
</div>

<div class="container-fluid px-0">
    <div class="row m-0 bg-white">
        <?php if($this->session->userdata('role') == 1 || $count > 0 || $count2 > 0 || $count3 > 0): ?>
        <div class="col-md-12 p-0 ">
            <div class="d-flex justify-content-end mr-1 mt-1">
                <a href="<?= base_url('admin/marketing-notification-add') ?>" class="btn btn-primary me-1">Add Notification</a>
            </div>
        </div>
        <?php endif; ?>
        <div class="col-md-12 p-0 mb-4">
            <?php if(empty($notifications)): ?>
                <div class="no-notifications">
                    <i class="fa fa-bell-slash fa-3x mb-3" style="color: #dbdbdb;"></i>
                    <h4>No Notifications Yet</h4>
                    <p>When you create notifications, they'll appear here</p>
                </div>
            <?php else: ?>
                <div class="notifications-feed">
                    <?php foreach($notifications as $notification): ?>
                        <div class="notification-card mb-4">
                            <!-- Notification Content -->
                            <div class="notification-content">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <!-- <h5 class="notification-title"><?php echo html_escape($notification->title); ?></h5> -->
                                        <?php if(!empty($notification->content)): ?>
                                        <div class="notification-text">
                                            <?php echo $notification->content; ?>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                    <?php if(!empty($notification->document)): ?>
                                    <div>
                                        <div  class="download-btn btn btn-primary btn-sm">
                                            <i class="fa fa-download"></i>  
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                
                                <?php if(!empty($notification->document)): 
                                    $file_extension = strtolower(pathinfo($notification->document, PATHINFO_EXTENSION));
                                    $is_pdf = in_array($file_extension, ['pdf']);
                                    $is_image = in_array($file_extension, ['jpg', 'jpeg', 'png', 'gif']);
                                    $is_video = in_array($file_extension, ['mp4', 'webm', 'ogg']);
                                    $file_url = base_url($notification->document);
                                    $file_name = basename($notification->document);
                                ?>
                                    <div class="document-container">
                                        <?php if($is_pdf): ?>
                                            <iframe src="<?php echo $file_url; ?>#toolbar=0&navpanes=0" class="document-viewer"></iframe>
                                        <?php elseif($is_image): ?>
                                            <div class="document-preview">
                                                <img src="<?php echo $file_url; ?>" alt="Document Image" class="img-fluid w-100">
                                            </div>
                                        <?php elseif($is_video): ?>
                                            <div class="video-preview">
                                                <video controls class="w-100" style="max-height: 500px;">
                                                    <source src="<?php echo $file_url; ?>" type="video/<?php echo $file_extension; ?>">
                                                    Your browser does not support the video tag.
                                                </video>
                                            </div>
                                        <?php else: ?>
                                            <div class="p-4 text-center">
                                                <i class="fa fa-file-text-o fa-5x text-muted mb-3"></i>
                                                <p>Preview not available for this file type</p>
                                            </div>
                                        <?php endif; ?>
                                        
                                        
                                        <?php 
                                        $teams1 = $this->db->get_where('user_master', ['id' => $this->session->userdata('user_id'),'role' => $this->session->userdata('role')])->row_array();
                                        if (empty($teams1)) {
                                            $teams1 = $this->db->get_where('branch_franchise', ['id' => $this->session->userdata('user_id'),'role' => $this->session->userdata('role')])->row_array();
                                        }
                                        ?>
                                        <div class="document-actions">
                                            <div class="document-info">
                                                <div class="user-avatar">
                                                    <i class="fa fa-user text-muted"></i>
                                                </div>
                                                <div class="document-details">
                                                    <strong><?php echo html_escape($this->session->userdata('username') ?: 'Admin'); ?></strong><br>
                                                    <span><?php echo $teams1['email']; ?></span><br>
                                                    <span><?php echo $teams1['mobile_no']; ?></span><br>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            
                            <!-- Footer with actions -->
                            <?php if($this->session->userdata('role') == 1 || $count > 0 || $count2 > 0 || $count3 > 0): ?>
                            <div class="notification-footer flex-wrap">
                                <?php 
                                $domain_name = $this->db->where('id', $notification->domain_id)->get('domains')->row()->url;
                                ?>
                                
                                <div class="d-flex align-items-center">
                                    <p class="mb-0 mr-3"><?php echo $domain_name; ?></p>
                                </div>
                                
                                <div class="action-buttons d-flex align-items-center">
                                    <?php if (!empty($notification->content) && empty($notification->document)): ?>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox"
                                            class="custom-control-input status-toggle"
                                            id="status_<?php echo $notification->id; ?>"
                                            data-id="<?php echo $notification->id; ?>"
                                            data-domain="<?php echo $notification->domain_id; ?>"
                                            <?php echo $notification->is_active ? 'checked' : ''; ?>>
                                        <label class="custom-control-label"
                                            for="status_<?php echo $notification->id; ?>">
                                        </label>
                                    </div>
                                    <?php endif; ?>

                                    <a href="<?php echo base_url('admin/marketing-notification-edit/'.$notification->id); ?>" 
                                    class="btn btn-sm btn-outline-primary" 
                                    data-toggle="tooltip" 
                                    title="Edit">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                    <button type="button" 
                                            class="btn btn-sm btn-outline-danger delete-notification" 
                                            data-id="<?php echo $notification->id; ?>"
                                            data-toggle="tooltip"
                                            title="Delete">
                                        <i class="fa fa-trash"></i> Delete
                                    </button>
                                </div>
                            </div>
                        <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Add Notification Button (Floating Action Button) -->
<?php if($this->session->userdata('role') == 1 || $count > 0 || $count2 > 0 || $count3 > 0): ?>
    <a href="<?= base_url('admin/marketing-notification-add')?>" class="btn btn-primary add-notification-btn d-flex align-items-center justify-content-center">
        <i class="fa fa-plus text-light"></i>
    </a>
<?php endif; ?>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title" id="deleteModalLabel"><i class="fa fa-warning"></i> Confirm Delete</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this notification?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a href="<?= base_url('admin/marketing-notification-delete/' . $notification->id) ?>" id="confirmDelete" class="btn btn-primary">Delete</a>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

<script>
  // Delete confirmation
    $('.delete-notification').on('click', function() {
        var id = $(this).data('id');
        var deleteUrl = '<?php echo base_url("admin/marketing-notification-delete/"); ?>' + id;
        $('#confirmDelete').attr('href', deleteUrl);
        $('#deleteModal').modal('show');
    });

</script>   
<script>
$(document).on('click', '.download-btn', function () {

    // current notification card
    let card = $(this).closest('.notification-card');
    let container = card.find('.document-container')[0];

    // check if video exists
    let video = card.find('video');

    /* ======================
       CASE 1 : VIDEO DOWNLOAD
       ====================== */
    if (video.length > 0) {
        let videoSrc = video.find('source').attr('src');

        let a = document.createElement('a');
        a.href = videoSrc;
        a.download = videoSrc.split('/').pop();
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        return;
    }

    /* ======================
       CASE 2 : IMAGE / PDF / IFRAME → IMAGE DOWNLOAD
       ====================== */

    // temporary full screen styling
    let originalStyle = container.getAttribute("style");
    container.style.width = "500px";
    container.style.height = "100%";
    container.style.fontSize = "18px";

    html2canvas(container, {
        useCORS: true,
        scale: 2,
        windowWidth: window.innerWidth,
        windowHeight: window.innerHeight
    }).then(function (canvas) {

        let imgData = canvas.toDataURL("image/png");

        let a = document.createElement("a");
        a.href = imgData;
        a.download = "document.png";
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);

        // restore original style
        if (originalStyle) {
            container.setAttribute("style", originalStyle);
        } else {
            container.removeAttribute("style");
        }
    });
});
</script>
<script>
$(document).on('change', '.status-toggle', function () {

    let notificationId = $(this).data('id');
    let domainId       = $(this).data('domain');
    let status         = $(this).is(':checked') ? 1 : 0;

    $.ajax({
        url: "<?= base_url('admin/marketing-notification-toggle'); ?>",
        type: "POST",
        data: {
            id: notificationId,
            domain_id: domainId,
            status: status
        },
        success: function (res) {
            let response = JSON.parse(res);

            if (response.success) {
                location.reload(); // simple & safe
            } else {
                alert(response.message);
            }
        }
    });
});
</script>
