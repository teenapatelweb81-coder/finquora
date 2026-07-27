<!-- Modern Breadcrumb -->
<div class="container-fluid px-0 ">
    <nav aria-label="breadcrumb" class=" rounded-3 p-2">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="<?php echo base_url("admin-dashboard");?>" class="text-decoration-none text-primary"><i class="fas fa-home me-1"></i> Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"> Agreement</li>
        </ol>
    </nav>
</div>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-xxl-10">
            <div class="card shadow-lg border-0 rounded-3 overflow-hidden">
                
                
                <!-- Card Body -->
                <div class="card-body p-0">
                    <!-- Agreement Content -->
                    <div class="agreement-content p-2 bg-white">
                        <div class="agreement-scroll p-2">
                           <?php 
                            $user_id = $this->uri->segment(3);  // 2043
                            $role_id = $this->uri->segment(4);  // 2

                            // If segment is empty, then fallback to session
                            if (empty($user_id)) {
                                $user_id = $this->session->userdata('user_id');
                            }

                            if (empty($role_id)) {
                                $role_id = $this->session->userdata('role');
                            }

                            $username = ($role_id == 2)  ? "DSA" : "Branch";
                            $agent_contact = $this->db->where('domain_id', domain_id_get())->get('contect_us')->row();
                            // print_r($agent_contact);die;
                            $admin_name = $this->db->where('domain_id', domain_id_get())->where('role', 1)->get('user_master')->row();
                           $signature = $this->db->where('domain_id', domain_id_get())->get('joining_letter')->row();
                            if ($role_id == 3) {
                                $agent = $this->db->where('id', $user_id)->get('branch_franchise')->row();
                            }else {
                                $agent = $this->db->where('id', $user_id)->get('user_master')->row();
                            }
                           
                            ?>
                            <?php if (!empty($agent_contact->logo)) { ?>
                                <div class="mt-3 text-center">
                                    <img src="<?php echo base_url('assets/images/logo/' . $agent_contact->logo); ?>" alt="Image" width="200">
                                </div>
                            <?php } ?>
                            <div class="text-right">
                            <button id="downloadAgreement" title="Download Agreement" class="btn btn-primary"><i class="fas fa-download me-2"></i></button>
                            </div>

                               <div class="agreement-container">
                                <h2 class="text-center mb-4"><?php echo $username; ?> Loan Agreement</h2>
                                
                                <div class="agreement-intro mb-4">
                                    <p class="text-center mb-4">This <?php echo $username; ?> Agreement ("Agreement") is made on <span class="current-date"><?= (!empty($agent->agreement_date)) ? date('d/m/Y', strtotime($agent->agreement_date)) : date('d/m/Y') ?></span>, between:</p>
                                </div>

                                <div class="party-section mb-5">
                                    <div class="party-header bg-light p-3 mb-3">
                                        <h4 class="m-0">FIRST PARTY</h4>
                                    </div>
                                    
                                    <div class="party-details ps-4 mb-4">
                                        <div class="row mb-2">
                                            <div class="col-md-3 fw-bold">Company Name:</div>
                                            <div class="col-md-9"><?= (!empty($agent_contact->company_name)) ? $agent_contact->company_name : 'N/A' ?></div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-md-3 fw-bold">Address:</div>
                                            <div class="col-md-9"><?= (!empty($agent_contact->registered_office)) ? $agent_contact->registered_office : 'N/A' ?></div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-md-3 fw-bold">Authorized Representative:</div>
                                            <div class="col-md-9"><?= $admin_name->name?></div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-md-3 fw-bold">Phone/Email:</div>
                                            <div class="col-md-9"><?= $agent_contact->mobile_no?></div>
                                        </div>
                                        <div class="mt-3 fst-italic font-weight-bold">
                                            (Hereinafter referred to as "<?= $agent_contact->company_name?> / First Party")
                                        </div>
                                    </div>

                                    <div class="party-header bg-light p-3 mb-3">
                                        <h4 class="m-0">SECOND PARTY</h4>
                                    </div>
                                    <div class="party-details ps-4 mb-4">
                                        <div class="row mb-2">
                                            <div class="col-md-3 fw-bold">DSA/Agent Name:</div>
                                            <div class="col-md-9"><?= $agent->name?></div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-md-3 fw-bold">Address:</div>
                                            <div class="col-md-9"><?= $agent->address?></div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-md-3 fw-bold">Phone/Email:</div>
                                            <div class="col-md-9"><?= $agent->mobile_no?></div>
                                        </div>
                                        <div class="mt-3 fst-italic font-weight-bold">
                                            (Hereinafter referred to as "<?= $agent->name?> / Second Party")
                                        </div>
                                    </div>

                                    
                                </div>
                            </div>

                           
                            <?= $agreement['content'] ?? '<div class="text-center py-5"><i class="fas fa-info-circle fa-3x text-muted mb-3"></i><p class="text-muted">No agreement content found.</p></div>' ?>
                        </div>
                      
                        <div class="party-section mb-5">
                            <div class="p-1 mb-2">
                                <h4 class="pb-3 text-muted"> Authorized Signatures</h4>
                                <h4 class="m-0"> Company (First Party)</h4>
                            </div>
                            
                            <div class="party-details ps-4 mb-4">
                                <div class="row mb-2">
                                    <div class="col-md-2 fw-bold">Name:</div>
                                    <div class="col-md-10"><?= $admin_name->name?></div>
                                </div>
                                <div class="row mb-2 align-items-center">
                                    <div class="col-md-2 fw-bold">Signature:</div>
                                    <div class="col-md-10">
                                        <div class="d-flex align-items-center">
                                            <img src="<?= base_url('assets/images/joiningLetter/'.$signature->image)?>" alt="Signature" style="object-fit: contain;width: 150px;height: 60px;">
                                            <img src="<?= base_url('assets/images/joiningLetter/'.$signature->ceal)?>" alt="Signature" style="object-fit: contain;width: 150px;">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-2 fw-bold">Date:</div>
                                    <div class="col-md-10"><?= (!empty($agent->agreement_date)) ? date('d/m/Y', strtotime($agent->agreement_date)) : date('d/m/Y') ?></div>
                                </div>
                            </div>

                            <div class="p-1 mb-2">
                                <h4 class="m-0"> Agent (Second Party)</h4>
                            </div>
                            <div class="party-details ps-4 mb-4">
                                <div class="row mb-2">
                                    <div class="col-md-2 fw-bold"> Name:</div>
                                    <div class="col-md-10"><?= $agent->name?></div>
                                </div>
                                <div class="row mb-2 align-items-center">
                                    <div class="col-md-2 fw-bold">Signature:</div>
                                    <div class="col-md-10"><?php if($agent->signature != '') { ?> <img src="<?= base_url('upload/assets/images/'.$agent->signature)?>" alt="Signature" style="object-fit: contain;width: 150px;height: 60px;"> <?php }else{ ?>______________<?php } ?></div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-2 fw-bold">Date:</div>
                                    <div class="col-md-10"><?= (!empty($agent->agreement_date)) ? date('d/m/Y', strtotime($agent->agreement_date)) : date('d/m/Y') ?></div>
                                </div>
                            </div>

                            
                        </div>
                    </div>

                    <!-- Add this after the agreement content -->
                        <div class="mt-5 border-top pt-4">
                         <?php 
                            $agreement_status = isset($agent->agreement_status) ? $agent->agreement_status : null;
                            $agreement_notes = isset($agent->agreement_note) ? $agent->agreement_note : '';
                            $updated_by = isset($agent->agreement_approved_by) ? $this->db->where('id', $agent->agreement_approved_by)->get('user_master')->row() : null;
                            $updated_at = isset($agent->agreement_date) ? date('d/m/Y H:i', strtotime($agent->agreement_date)) : '';

                            if (!is_null($agreement_status)):

                                // Status-wise text & class
                                if ($agreement_status === 'approved') {
                                    $status_class = 'success';
                                    $status_text = 'Approved';
                                    $extra_message = '';
                                } elseif ($agreement_status === 'rejected') {
                                    $status_class = 'danger';
                                    $status_text = 'Rejected';
                                    $extra_message = '';
                                } else { 
                                    // Pending case
                                    $status_class = 'warning';
                                    $status_text = 'Pending';
                                    $extra_message = 'Your approval is pending. Once the admin approves your agreement, you will get access.';
                                }
                            ?>
                                <div class="alert m-2 alert-<?php echo $status_class; ?>">
                                    <h5 class="text-dark">Agreement Status: <strong><?php echo $status_text; ?></strong></h5>

                                    <?php if (!empty($agreement_notes)): ?>
                                        <p class="mb-1"><strong>Notes:</strong> <?php echo $agreement_notes; ?></p>
                                    <?php endif; ?>

                                    <?php if (!empty($extra_message)): ?>
                                        <p class="mb-1"><strong>Info:</strong> <?php echo $extra_message; ?></p>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>


                            
                        </div>
                    
                    <!-- Signature Section -->
                    <div class="signature-section p-2 p-md-5 bg-white">
                        <div class="row justify-content-center">
                            <div class="col-12 col-lg-8">
                                <?php if ($this->session->userdata('role') == 1): ?>
                                    <!-- Admin Approval Form -->
                                    <div class="card mt-4">
                                        <div class="card-header bg-primary text-white">
                                            <h5 class="mb-0 text-white">Update Agreement Status</h5>
                                        </div>
                                        <div class="card-body">
                                            <form id="agreementStatusForm">
                                                <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                                                <input type="hidden" name="role_id" value="<?php echo $role_id; ?>">
                                                
                                                <div class="form-group mb-3">
                                                    <label>Status</label>
                                                    <div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="agreement_status" id="approve" value="approved" required>
                                                            <label class="form-check-label" for="approve">Approve</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="agreement_status" id="reject" value="rejected" required>
                                                            <label class="form-check-label" for="reject">Reject</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group mb-3">
                                                    <label for="notes">Notes</label>
                                                    <textarea class="form-control" id="notes" name="agreement_note" rows="3" required></textarea>
                                                    <small class="text-muted">Please provide details for approval/rejection</small>
                                                </div>
                                                
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                    
                                <?php else: ?>
                                        <?php  if((!is_null($agreement_status) && $agreement_status != 'approved') || $agent->signature == ''): ?>
                                            <form id="agreementForm" action="<?= base_url('admin/process-agreement') ?>" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                                        <input type="hidden" name="agreement_id" value="<?= $agreement['id'] ?? 0 ?>">
                                        <input type="hidden" name="role" value="<?= $role_id ?>">
                                        <input type="hidden" name="user_id" value="<?= $user_id ?>">
                                        
                                        <div class="card border-0 shadow-sm mb-4 bg-light">
                                            <div class="card-body p-4">
                                                <h5 class="h5 mb-4 text-center">
                                                    <i class="fas fa-signature text-primary me-2"></i>Upload Your Signature
                                                </h5>
                                                <p class="text-muted text-center mb-4">
                                                    Please upload a clear image of your signature to acknowledge and agree to the terms and conditions.
                                                </p>
                                                
                                                <!-- Upload Area -->
                                                <div class="upload-area p-4 text-center border-2 border-dashed rounded-3 bg-white position-relative" id="uploadContainer">
                                                    <!-- Preview Container -->
                                                    <div id="imagePreview" class="mb-4 text-center" style="display: none;">
                                                        <div class="position-relative d-inline-block">
                                                            <img id="signaturePreview" src="#" alt="Signature Preview" class="img-fluid rounded shadow-sm" style="max-height: 120px; border: 1px solid #e9ecef;">
                                                        </div>
                                                    </div>
                                                    
                                                    <!-- Upload UI -->
                                                    <div id="uploadUI">
                                                        <div class="p-4">
                                                            <div class="icon-container bg-soft-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                                                <i class="fas fa-cloud-upload-alt fa-2x text-primary"></i>
                                                            </div>
                                                            <h5 class="h6 mb-2">Drag & drop your signature here</h5>
                                                            <p class="small text-muted mb-3">or click to browse files</p>
                                                            <div class="badge bg-soft-primary text-primary px-3 py-2 mb-3">
                                                                <i class="far fa-file-image me-1"></i> JPG, PNG (Max 2MB)
                                                            </div>
                                                            <p class="small text-muted mb-0">For best results, use a white background with dark signature</p>
                                                        </div>
                                                    </div>
                                                    
                                                    <input type="file" name="signature" id="signatureUpload" accept="image/*" class="d-none" required>
                                                </div>
                                                
                                                <!-- Current Signature -->
                                                <?php if(isset($user_signature) && !empty($user_signature)): ?>
                                                    <div class="current-signature mt-4 text-center">
                                                        <p class="text-muted mb-2">Your current signature:</p>
                                                        <div class="d-inline-block position-relative">
                                                            <img src="<?= base_url('uploads/signatures/'.$user_signature) ?>" 
                                                                 alt="Your Signature" 
                                                                 class="img-thumbnail shadow-sm" 
                                                                 style="max-height: 80px; background: #fff;">
                                                            <span class="badge bg-success position-absolute top-0 start-100 translate-middle">
                                                                <i class="fas fa-check"></i> Saved
                                                            </span>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        
                                        <!-- Submit Button -->
                                        <div class="text-center mt-4 pt-3">
                                            <button type="submit" class="btn btn-primary btn-lg px-5 py-3 fw-bold" id="submit-agreement">
                                                <i class="fas fa-check-circle me-2"></i> I Agree & Submit
                                            </button>
                                            <p class="text-muted small mt-3 mb-0">
                                                By clicking "I Agree & Submit", you acknowledge that you have read, understood, and agree to be bound by all terms and conditions stated above.
                                            </p>
                                        </div>
                                    </form>
                                <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add this in the <head> section of your layout or agreement.php -->
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
<script>
        $(document).ready(function() {
            $('#agreementStatusForm').on('submit', function(e) {
                e.preventDefault();
                
                $.ajax({
                    url: '<?php echo base_url("admin/update-agreement-status"); ?>',
                    type: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if(response.status == 1) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: response.message,
                                timer: 2000,
                                showConfirmButton: false
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.message
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'An error occurred. Please try again.'
                        });
                    }
                });
            });
        });
        </script>
<style>
/* Base Styles */
:root {
    --primary-color: #4361ee;
    --primary-light: #eef2ff;
    --secondary-color: #6c757d;
    --success-color: #28a745;
    --danger-color: #dc3545;
    --light-color: #f8f9fa;
    --dark-color: #343a40;
    --border-radius: 0.5rem;
    --box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.05);
    --transition: all 0.3s ease-in-out;
}

/* Typography */
body {
    background: #f5f7fb;
    color: #4a5568;
    line-height: 1.7;
}

h1, h2, h3, h4, h5, h6 {
    color: #2d3748;
    font-weight: 700;
    line-height: 1.3;
}

/* Card Styles */
.card {
    border: none;
    box-shadow: var(--box-shadow);
    transition: var(--transition);
    margin-bottom: 2rem;
}

.card:hover {
    box-shadow: 0 0.75rem 1.5rem rgba(0, 0, 0, 0.08);
}

.card-header {
    border-bottom: 1px solid rgba(0, 0, 0, 0.03);
    padding: 1.25rem 1.5rem;
}

/* Agreement Content */
.agreement-content {
    line-height: 1;
    font-size: 1rem;
    color: #4a5568 !important;
}

.agreement-content h1 {
    font-size: 2rem;
    margin: 2rem 0 1.5rem;
    color: #1a365d;
    position: relative;
    padding-bottom: 0.5rem;
}



.agreement-content h2 {
    font-size: 1.75rem;
    margin: 0 0 10px 0;
    color: #2c5282;
}

.agreement-content h3 {
    font-size: 1.5rem;
    margin: 0 0 10px 0;
    color: #2b6cb0;
}

.agreement-content h4 {
    font-size: 1.25rem;
    margin: 0 0 10px 0;
    color: #3182ce;
}

.agreement-content p {
    margin-bottom: 10px;
    color: #4a5568;
}

.agreement-content ul,
.agreement-content ol {
    margin-bottom: 10px;
    padding-left: 2rem;
}

.agreement-content li {
    margin-bottom: 0.5rem;
    position: relative;
}

.agreement-content ol {
    counter-reset: item;
}

.agreement-content ol li {
    counter-increment: item;
}

.agreement-content ol li:before {
    content: counter(item) '.';
    color: var(--primary-color);
    font-weight: bold;
    position: absolute;
    left: -1.5em;
}

/* Signature Section */
.signature-section {
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    border-top: 1px solid rgba(0, 0, 0, 0.03);
}

/* Upload Area */
.upload-area {
    border: 2px dashed #cbd5e0;
    border-radius: var(--border-radius);
    background: #fff;
    transition: var(--transition);
    cursor: pointer;
    position: relative;
    overflow: hidden;
}

.upload-area:hover, 
.upload-area.dragover {
    border-color: var(--primary-color);
    background: rgba(67, 97, 238, 0.03);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(67, 97, 238, 0.1);
}

.upload-area .icon-container {
    transition: var(--transition);
}

.upload-area:hover .icon-container {
    transform: translateY(-3px);
    background: rgba(67, 97, 238, 0.1) !important;
}

/* Buttons */
.btn {
    font-weight: 500;
    padding: 0.5rem 1.25rem;
    border-radius: 50px;
    transition: var(--transition);
    letter-spacing: 0.3px;
}

.btn-lg {
    padding: 0.75rem 2rem;
    font-size: 1.1rem;
}

.btn-primary {
    background: var(--primary-color);
    border-color: var(--primary-color);
    box-shadow: 0 4px 6px rgba(67, 97, 238, 0.2);
}

.btn-primary:hover {
    background: #3a56d4;
    border-color: #3a56d4;
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(67, 97, 238, 0.25);
}

.btn-primary:active {
    transform: translateY(0);
    box-shadow: 0 2px 4px rgba(67, 97, 238, 0.3);
}

/* Form Elements */
.form-control:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 0.2rem rgba(67, 97, 238, 0.25);
}

/* Custom Scrollbar */
.agreement-scroll::-webkit-scrollbar {
    width: 8px;
}

.agreement-scroll::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

.agreement-scroll::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 10px;
}

.agreement-scroll::-webkit-scrollbar-thumb:hover {
    background: #a8a8a8;
}



/* Responsive Adjustments */
@media (max-width: 992px) {
    .agreement-content {
        padding: 2rem !important;
    }
    
    .signature-section {
        padding: 2rem !important;
    }
}

@media (max-width: 768px) {
    .card-header h3 {
        font-size: 1.5rem;
    }
    
    .agreement-content {
        font-size: 1rem;
        padding: 1.5rem !important;
    }
    
    .signature-section {
        padding: 1.5rem !important;
    }
    
    .btn-lg {
        width: 100%;
        padding: 0.75rem 1.5rem;
    }
}

@media (max-width: 576px) {
    .agreement-content h1 {
        font-size: 1.75rem;
    }
    
    .agreement-content h2 {
        font-size: 1.5rem;
    }
    
    .agreement-content h3 {
        font-size: 1.3rem;
    }
    
    .upload-area {
        padding: 1.5rem !important;
    }
}

.party-header {
    border-left: 4px solid #4361ee;
    background: #f8f9fa;
}

.party-details {
    border-left: 2px solid #e9ecef;
    padding-left: 1.5rem;
}

.form-control-plaintext {
    min-height: 2.5rem;
    padding: 0.375rem 0;
}

.current-date {
    text-decoration: underline;
    font-weight: 500;
}

@media (max-width: 768px) {
    .agreement-container {
        padding: 1rem;
    }
    
    .party-details {
        padding-left: 1rem;
    }
    
    .col-md-3, .col-md-4 {
        margin-bottom: 0.5rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Elements
    const uploadArea = document.getElementById('uploadArea');
    const uploadContainer = document.getElementById('uploadContainer');
    const uploadUI = document.getElementById('uploadUI');
    const fileInput = document.getElementById('signatureUpload');
    const imagePreview = document.getElementById('imagePreview');
    const signaturePreview = document.getElementById('signaturePreview');
    const removeImageBtn = document.getElementById('removeImage');
    const form = document.getElementById('agreementForm');
    const submitBtn = document.querySelector('#submit-agreement');
    
    // Add animation class to elements
    document.querySelectorAll('.card, .agreement-content, .signature-section').forEach((el, index) => {
        setTimeout(() => {
            el.classList.add('fade-in');
        }, 100 * index);
    });
    
    // Form validation
    if (form) {
        form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
                
                // Add shake animation to invalid fields
                const invalidFields = form.querySelectorAll(':invalid');
                invalidFields.forEach(field => {
                    field.classList.add('is-invalid');
                    field.addEventListener('animationend', function() {
                        field.classList.remove('shake-animation');
                    }, { once: true });
                });
                
                // Scroll to first invalid field
                if (invalidFields.length > 0) {
                    invalidFields[0].scrollIntoView({ 
                        behavior: 'smooth', 
                        block: 'center' 
                    });
                }
            }
            
            form.classList.add('was-validated');
        }, false);
    }

    // Handle drag and drop
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        uploadContainer.addEventListener(eventName, preventDefaults, false);
    });
    
    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    // Highlight drop area when item is dragged over it
    ['dragenter', 'dragover'].forEach(eventName => {
        uploadContainer.addEventListener(eventName, function() {
            this.classList.add('dragover');
            uploadUI.innerHTML = `
                <div class="p-4">
                    <div class="icon-container bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px; transition: all 0.3s ease;">
                        <i class="fas fa-file-upload fa-2x"></i>
                    </div>
                    <h5 class="h6 mb-2">Drop your signature here</h5>
                </div>`;
        }, false);
    });

    // Remove highlight when item leaves drop area
    ['dragleave', 'drop'].forEach(eventName => {
        uploadContainer.addEventListener(eventName, function() {
            this.classList.remove('dragover');
            resetUploadUI();
        }, false);
    });
    
    // Reset upload UI to default state
    function resetUploadUI() {
        uploadUI.innerHTML = `
            <div class="p-4">
                <div class="icon-container bg-soft-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                    <i class="fas fa-cloud-upload-alt fa-2x text-primary"></i>
                </div>
                <h5 class="h6 mb-2">Drag & drop your signature here</h5>
                <p class="small text-muted mb-3">or click to browse files</p>
                <div class="badge bg-soft-primary text-primary px-3 py-2 mb-3">
                    <i class="far fa-file-image me-1"></i> JPG, PNG (Max 2MB)
                </div>
                <p class="small text-muted mb-0">For best results, use a white background with dark signature</p>
            </div>`;
    }

    // Handle dropped files
    uploadContainer.addEventListener('drop', handleDrop, false);
    uploadContainer.addEventListener('click', () => fileInput.click());

    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        handleFiles(files);
    }

    // Handle file selection via input
    fileInput.addEventListener('change', function() {
        handleFiles(this.files);
    });

    // Process selected files
    function handleFiles(files) {
        if (files.length > 0) {
            const file = files[0];
            if (file.type.match('image.*')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    signaturePreview.src = e.target.result;
                    imagePreview.style.display = 'block';
                    removeImageBtn.style.display = 'inline-block';
                    uploadArea.querySelector('p').style.display = 'none';
                    uploadArea.querySelector('.fa-cloud-upload-alt').style.display = 'none';
                }
                reader.readAsDataURL(file);
            } else {
                alert('Please upload a valid image file (JPG, PNG)');
            }
        }
    }

    // Remove image
    removeImageBtn.addEventListener('click', function() {
        fileInput.value = '';
        imagePreview.style.display = 'none';
        this.style.display = 'none';
        uploadArea.querySelector('p').style.display = 'block';
        uploadArea.querySelector('.fa-cloud-upload-alt').style.display = 'block';
    });

   
});
</script>

                    <!-- Add html2pdf library for PDF generation -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {

    const downloadBtn = document.getElementById("downloadAgreement");

    downloadBtn.addEventListener("click", function () {

        const content = document.querySelector(".agreement-content");

        const options = {
            margin: 10,
            filename: "Agreement.pdf",
            image: { type: "jpeg", quality: 0.98 },
            html2canvas: { scale: 2 },
            jsPDF: { unit: "mm", format: "a4", orientation: "portrait" }
        };

        html2pdf().set(options).from(content).save();
    });
});
</script>