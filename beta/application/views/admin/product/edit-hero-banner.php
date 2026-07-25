<div class="container-fluid p-0">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url('admin-dashboard'); ?>" class="text-decoration-none">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo isset($banner) ? 'Edit Hero Banner' : 'Add Hero Banner'; ?></li>
        </ol>
    </nav>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 px-0">
            <div class="card shadow-unset">
                    <div class="card-body">
                    <h4 class="mb-0"><?php echo isset($banner) ? 'Edit Hero Banner' : 'Add New Hero Banner'; ?></h4>
                    <?php if ($this->session->flashdata('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show">
                            <?php echo $this->session->flashdata('success'); ?>
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger alert-dismissible fade show">
                            <?php echo $this->session->flashdata('error'); ?>
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('admin/product/update_hero_banner') ?>" method="post">
        
                            <input type="hidden" name="domain_id" class="form-control" value="3" required>
                            <input type="hidden" name="id" class="form-control" value="<?= isset($banner) ? $banner->id : '' ?>" required>

                        <hr>
                        <h5>Left Section</h5>

                        <div class="mb-3">
                            <label class="form-label">Badge Text</label>
                            <input type="text" name="badge_text" class="form-control" 
                                value="<?= set_value('badge_text', isset($banner) ? $banner->badge_text : '') ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Main Heading</label>
                            <input type="text" name="main_heading" class="form-control" 
                                value="<?= set_value('main_heading', isset($banner) ? $banner->main_heading : '') ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Sub Heading</label>
                            <textarea name="sub_heading" class="form-control" rows="3"><?= set_value('sub_heading', isset($banner) ? $banner->sub_heading : '') ?></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">CTA 1 Text</label>
                                <input type="text" name="cta1_text" class="form-control" 
                                    value="<?= set_value('cta1_text', isset($banner) ? $banner->cta1_text : '') ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">CTA 1 Link</label>
                                <input type="text" name="cta1_link" class="form-control" 
                                    value="<?= set_value('cta1_link', isset($banner) ? $banner->cta1_link : '') ?>">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">CTA 2 Text</label>
                                <input type="text" name="cta2_text" class="form-control" 
                                    value="<?= set_value('cta2_text', isset($banner) ? $banner->cta2_text : '') ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">CTA 2 Link</label>
                                <input type="text" name="cta2_link" class="form-control" 
                                    value="<?= set_value('cta2_link', isset($banner) ? $banner->cta2_link : '') ?>">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Trusts (One per line or JSON)</label>
                            <textarea name="trusts" class="form-control" rows="4"><?= set_value('trusts', isset($banner) ? $banner->trusts : '') ?></textarea>
                        </div>

                        <hr>
                        <h5>Right Section</h5>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Score Value</label>
                                <input type="text" name="score_value" class="form-control" 
                                    value="<?= set_value('score_value', isset($banner) ? $banner->score_value : '') ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Score Label</label>
                                <input type="text" name="score_label" class="form-control" 
                                    value="<?= set_value('score_label', isset($banner) ? $banner->score_label : '') ?>">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Right Heading</label>
                            <input type="text" name="right_heading" class="form-control" 
                                value="<?= set_value('right_heading', isset($banner) ? $banner->right_heading : '') ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Right Description</label>
                            <textarea name="right_description" class="form-control" rows="3"><?= set_value('right_description', isset($banner) ? $banner->right_description : '') ?></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Right CTA Text</label>
                                <input type="text" name="right_cta_text" class="form-control" 
                                    value="<?= set_value('right_cta_text', isset($banner) ? $banner->right_cta_text : '') ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Right CTA Link</label>
                                <input type="text" name="right_cta_link" class="form-control" 
                                    value="<?= set_value('right_cta_link', isset($banner) ? $banner->right_cta_link : '') ?>">
                            </div>
                        </div>

                        <hr>
                        <div class="mb-3">
                             <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="1" <?php echo (isset($banner) && $banner->status == 1) ? 'selected' : (!isset($banner) ? 'selected' : ''); ?>>Active</option>
                                    <option value="0" <?php echo (isset($banner) && $banner->status == 0) ? 'selected' : ''; ?>>Inactive</option>
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary"><?= isset($banner) ? 'Update Banner' : 'Add Banner' ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>