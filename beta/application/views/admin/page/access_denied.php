<!-- Modern Breadcrumb -->
<div class="container-fluid px-0">
    <nav aria-label="breadcrumb" class="rounded-3 p-2">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="<?php echo base_url("admin-dashboard");?>" class="text-decoration-none text-primary"><i class="fas fa-home me-1"></i> Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"> Access Denied</li>
        </ol>
    </nav>
</div>

<div class="container-fluid">
    <div class="row justify-content-center align-items-center min-vh-80">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                <div class="card-body p-5 text-center">
                    <!-- Icon -->
                    <div class="mb-4">
                        <div class="bg-soft-danger rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                            <i class="fas fa-ban text-danger" style="font-size: 2.5rem;"></i>
                        </div>
                    </div>
                    
                    <!-- Title -->
                    <h2 class="h3 mb-3">Access Restricted</h2>
                    
                    <!-- Message -->
                    <p class="text-muted mb-4">
                        You don't have the necessary permissions to access this page.
                        Please contact your administrator if you believe this is an error.
                    </p>
                    
                    <!-- Action Button -->
                    <a href="<?php echo base_url('admin-dashboard'); ?>" class="btn btn-primary px-4">
                        <i class="fas fa-arrow-left me-2"></i> Back to Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .min-vh-80 {
        min-height: 80vh;
    }
    .bg-soft-danger {
        background-color: rgba(220, 53, 69, 0.1) !important;
    }
    .card {
        border: none;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.1) !important;
    }
</style>
