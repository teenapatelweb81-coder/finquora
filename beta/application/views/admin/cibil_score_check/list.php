<div class="container-fluid p-0">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url("admin/Dashboard/");?>" class="text-decoration-none">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">CIBIL Score Check</li>
        </ol>
    </nav>
</div>

<section class="content">
    <div class="container-fluid px-0">
        <div class="row m-0">
            <div class="col-12 px-0">
                <div class="card">
                      <?php if($this->session->userdata('role') == 1 || $count > 0 ||  $count2 > 0 ||  $count3 > 0) { ?>
                    <div class="pt-2 text-right mr-2">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addCibilLinkModal">
                            <i class="fas fa-plus"></i> Add New Link
                        </button>
                    </div>
                    <?php } ?>
                    <div class="card-body">
                        <?php if($this->session->flashdata('success')): ?>
                            <div class="alert alert-success"><?= $this->session->flashdata('success') ?></div>
                        <?php endif; ?>
                        <?php if($this->session->flashdata('error')): ?>
                            <div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
                        <?php endif; ?>
                        
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>URL</th>
                                          <?php if($this->session->userdata('role') == 1) { ?>
                                        <th>Actions</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($cibil_links as $link):
                                        ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td>
                                                <?php if (!empty($link->image)): ?>
                                                    <img src="<?= base_url('upload/assets/images/' . $link->image) ?>" alt="<?= html_escape($link->title) ?>" style="max-width: 100px; max-height: 60px;">
                                                <?php else: ?>
                                                    <span class="text-muted">No image</span>
                                                <?php endif; ?>
                                            </td>
                                            <td><?= html_escape($link->title) ?></td>
                                            <td>
                                                <div class="d-flex align-items-center justify-content-center">
                                                    <a href="<?= html_escape($link->url) ?>" target="_blank" class="text-primary font-weight-bold text-truncate mr-2" style="max-width: 200px;" title="<?= html_escape($link->url) ?>">
                                                        <?= html_escape($link->url) ?>
                                                    </a>
                                                    <button class="btn btn-sm btn-outline-secondary copy-btn" type="button" data-clipboard-text="<?= html_escape($link->url) ?>" title="Copy URL">
                                                        <i class="fas fa-copy"></i>
                                                    </button>
                                                </div>
                                            </td>
                                             <?php if($this->session->userdata('role') == 1) { ?>
                                            <td>
                                                <form action="<?= base_url('admin/deleteCibilLink/' . $link->id) ?>" method="POST" style="display: inline;">
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this CIBIL link?')">
                                                        <i class="fas fa-trash"></i> Delete
                                                    </button>
                                                </form>
                                            </td>
                                            <?php } ?>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Add CIBIL Link Modal -->
<div class="modal fade" id="addCibilLinkModal" tabindex="-1" role="dialog" aria-labelledby="addCibilLinkModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCibilLinkModalLabel">Add New CIBIL Link</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/addCibilLink') ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="url">URL <span class="text-danger">*</span></label>
                        <input type="url" class="form-control" id="url" name="url" required>
                    </div>
                     <?php
                        if ($this->session->userdata('type') == 'admin') { ?>
                            <div class="form-group">
                                <label for="domain_id_main" class="">Domain</label>
                                <select class="form-control" id="domain_id_main" required name="domain_id">
                                    <?php foreach ($domains as $domain) { ?>
                                        <option <?= (domain_id_get() == $domain['id']) ? 'selected' : ''; ?> value="<?= $domain['id'] ?>"> <?= $domain['url'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        <?php }else{?>
                            <input type="hidden" name="domain_id"  class="form-control" value="<?= domain_id_get() ?>" >
                        <?php }?>     
                    <div class="form-group">
                        <label for="image">Image (Optional)</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="image" name="image" accept="image/*">
                            <label class="custom-file-label" for="image">Choose file</label>
                        </div>
                        <small class="form-text text-muted">Max file size: 1MB. Allowed types: JPG, JPEG, PNG</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialize clipboard.js
        var clipboard = new ClipboardJS('.copy-btn');
        
        // Show success message when URL is copied
        clipboard.on('success', function(e) {
            var $btn = $(e.trigger);
            var originalText = $btn.html();
            $btn.html('<i class="fas fa-check"></i> Copied!');
            
            setTimeout(function() {
                $btn.html(originalText);
            }, 2000);
            
            e.clearSelection();
        });

        // Update the file input label with the selected file name
        $('.custom-file-input').on('change', function() {
            var fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName || 'Choose file');
        });
    });
</script>