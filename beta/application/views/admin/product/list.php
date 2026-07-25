<div class="container-fluid p-0">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url('admin-dashboard'); ?>" class="text-decoration-none">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Loan Products</li>
        </ol>
    </nav>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 px-0">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Loan Products Management</h5>
                        <div>
                            <a href="<?php echo base_url('admin/product/view_hero_banner'); ?>" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Edit Hero Banner
                            </a>
                            <a href="<?php echo base_url('admin/product/add'); ?>" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Add New Product
                            </a>
                        </div>
                    </div>
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

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th width="50">#</th>
                                    <th>Logo</th>
                                    <th>Product Name</th>
                                    <th>Amount</th>
                                    <th>Benefit</th>
                                    <th>Status</th>
                                    <th width="150">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($products)): ?>
                                    <?php $count = 1; foreach ($products as $product): ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <td><span style="font-size: 24px;"> <img style="max-width:80px;max-height:80px;" src="<?= base_url((isset($product->logo) && !empty($product->logo) ? $product->logo : '')) ?>"></span></td>
                                            <td><?php echo $product->name; ?></td>
                                            <td><?php echo $product->amount; ?></td>
                                            <td><?php echo $product->benefit; ?></td>
                                            <td>
                                                <?php if ($product->status == 1): ?>
                                                    <span class="badge badge-success">Active</span>
                                                <?php else: ?>
                                                    <span class="badge badge-danger">Inactive</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <a href="<?php echo base_url('admin/product/edit/' . $product->id); ?>" class="btn btn-sm btn-info">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="<?php echo base_url('admin/product/toggle_status/' . $product->id); ?>" class="btn btn-sm btn-warning" onclick="return confirm('Are you sure you want to change status?');">
                                                    <i class="fas fa-toggle-on"></i>
                                                </a>
                                                <a href="<?php echo base_url('admin/product/delete/' . $product->id); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this product?');">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="7" class="text-center">No products found</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
