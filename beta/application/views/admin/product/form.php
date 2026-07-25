
<div class="container-fluid p-0">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url('admin-dashboard'); ?>" class="text-decoration-none">Home</a></li>
            <li class="breadcrumb-item"><a href="<?php echo base_url('admin/product'); ?>" class="text-decoration-none">Loan Products</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo isset($product) ? 'Edit Product' : 'Add Product'; ?></li>
        </ol>
    </nav>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 px-0">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><?php echo isset($product) ? 'Edit Loan Product' : 'Add New Loan Product'; ?></h5>
                </div>
                <div class="card-body">
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

                    <?php echo form_open_multipart('admin/product/save', ['class' => 'form-horizontal']); ?>
                    <?php if (isset($product)): ?>
                        <input type="hidden" name="id" value="<?php echo $product->id; ?>">
                    <?php endif; ?>

                    <div class="row">
                        <!-- <div class="col-md-6">
                            <div class="form-group">
                                <label>Domain <span class="text-danger">*</span></label>
                                <select name="domain_id" class="form-control" required>
                                    <option value="">Select Domain</option>
                                    <?php foreach ($domains as $domain): ?>
                                        <option value="<?php echo $domain['id']; ?>" <?php echo (isset($product) && $product->domain_id == $domain['id']) ? 'selected' : ''; ?>>
                                            <?php echo $domain['url']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div> -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Product Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" value="<?php echo isset($product) ? $product->name : ''; ?>" placeholder="Enter product name" required>
                                <?php echo form_error('name', '<span class="text-danger">', '</span>'); ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Loan Type <span class="text-danger">*</span></label>
                                <select name="loan_type" class="form-control" required>
                                    <option value="">-- Select Loan Type --</option>
                                    <option value="Personal Loan" <?= (isset($product) && $product->loan_type == 'Personal Loan') ? 'selected' : ''; ?>>
                                        Personal Loan
                                    </option>
                                    <option value="Business Loan" <?= (isset($product) && $product->loan_type == 'Business Loan') ? 'selected' : ''; ?>>
                                        Business Loan
                                    </option>
                                    <option value="Both" <?= (isset($product) && $product->loan_type == 'Both') ? 'selected' : ''; ?>>
                                        Both
                                    </option>
                                </select>
                                <?= form_error('loan_type', '<span class="text-danger">', '</span>'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Partner Logo</label>
                                <input type="file" name="logo" id="logo" class="form-control" accept="image/*" onchange="previewLogo(this)">
                                <?php echo form_error('logo', '<span class="text-danger">', '</span>'); ?>

                                <div class="mt-3">
                                    <img id="logoPreview"
                                        src="<?php
                                            if(isset($product) && !empty($product->logo)){
                                                echo base_url($product->logo);
                                            }else{
                                                echo '';
                                            }
                                        ?>"
                                        style="max-width:120px;max-height:120px;<?php echo (isset($product) && !empty($product->logo)) ? '' : 'display:none;'; ?>" class="img-thumbnail">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Amount <span class="text-danger">*</span></label>
                                <input type="text" name="amount" class="form-control" value="<?php echo isset($product) ? $product->amount : ''; ?>" placeholder="e.g., ₹5 Lakhs" required>
                                <?php echo form_error('amount', '<span class="text-danger">', '</span>'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Benefit <span class="text-danger">*</span></label>
                                <input type="text" name="benefit" class="form-control" value="<?php echo isset($product) ? $product->benefit : ''; ?>" placeholder="e.g., Instant Approval" required>
                                <?php echo form_error('benefit', '<span class="text-danger">', '</span>'); ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Approval Time</label>
                                <input type="text" name="approval_time" class="form-control" value="<?php echo isset($product) ? $product->approval_time : '30 Minutes'; ?>" placeholder="e.g., 30 Minutes">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Processing Fee</label>
                                <input type="text" name="processing_fee" class="form-control" value="<?php echo isset($product) ? $product->processing_fee : 'Zero'; ?>" placeholder="e.g., Zero">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="1" <?php echo (isset($product) && $product->status == 1) ? 'selected' : (!isset($product) ? 'selected' : ''); ?>>Active</option>
                                    <option value="0" <?php echo (isset($product) && $product->status == 0) ? 'selected' : ''; ?>>Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Description <span class="text-danger">*</span></label>
                        <textarea name="description" class="form-control" rows="3" placeholder="Enter product description" required><?php echo isset($product) ? $product->description : ''; ?></textarea>
                        <?php echo form_error('description', '<span class="text-danger">', '</span>'); ?>
                    </div>

                    <div class="form-group">
                        <label>Benefits (One per line)</label>
                        <textarea name="benefits" class="form-control" rows="4" placeholder="Enter benefits (one per line)"><?php echo isset($product) ? $product->benefits : ''; ?></textarea>
                    </div>

                    <div class="form-group">
                        <label>How It Works (One per line)</label>
                        <textarea name="how_it_works" class="form-control" rows="4" placeholder="Enter steps (one per line)"><?php echo isset($product) ? $product->how_it_works : ''; ?></textarea>
                    </div>

                    <div class="form-group">
                        <label>Terms & Conditions (One per line)</label>
                        <textarea name="terms" class="form-control" rows="3" placeholder="Enter terms (one per line)"><?php echo isset($product) ? $product->terms : ''; ?></textarea>
                    </div>

                    <div class="form-group">
                        <label>Target Customers (One per line)</label>
                        <textarea name="target_customers" class="form-control" rows="3" placeholder="Enter target customers (one per line)"><?php echo isset($product) ? $product->target_customers : ''; ?></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Copy Link</label>
                                <input type="text" name="copy_link" class="form-control" value="<?php echo isset($product) ? $product->copy_link : ''; ?>" placeholder="Enter copy link">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Sell Link</label>
                                <input type="text" name="sell_link" class="form-control" value="<?php echo isset($product) ? $product->sell_link : ''; ?>" placeholder="Enter sell link">
                            </div>
                        </div>
                        <!-- <div class="col-md-4">
                            <div class="form-group">
                                <label>CIBIL Check Link</label>
                                <input type="text" name="cibil_check_link" class="form-control" value="<?php echo isset($product) ? $product->cibil_check_link : ''; ?>" placeholder="Enter CIBIL check link">
                            </div>
                        </div> -->
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> <?php echo isset($product) ? 'Update Product' : 'Add Product'; ?>
                        </button>
                        <a href="<?php echo base_url('admin/product'); ?>" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                    </div>

                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
function previewLogo(input){

    if(input.files && input.files[0]){

        var reader = new FileReader();

        reader.onload = function(e){

            $('#logoPreview')
                .attr('src', e.target.result)
                .show();

        }

        reader.readAsDataURL(input.files[0]);
    }
}
</script>