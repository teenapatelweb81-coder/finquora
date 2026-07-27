<div class="container-fluid p-0">
	<nav aria-label="breadcrumb">
	<ol class="breadcrumb ">
		<li class="breadcrumb-item "><a href="<?php echo base_url("admin/Dashboard/");?>" class="text-decoration-none">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page">Credentials</li>
	</ol>
	</nav>
</div>


<div class="container-fluid p-0">
    <div class="row justify-content-center">
        <div class="col-12">
            <!-- Header Card -->
            <div class="card border-0 shadow-sm mb-4 overflow-hidden">
                <div class="card-header bg-gradient-primary text-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="mb-0 fw-bold"><?= $heading->title?></h4>
                            <p class="mb-0 small opacity-75"><?= $heading->description?></p>
                        </div>
                        
                    </div>
                </div>
                
                <div class="card-body p-0">
                    <?php if (!empty($whatsapp_transfer)): ?>
                        <div class="border-0  mb-2">
                            <div class="card-body pb-0">
                                <div class="input-group input-group-lg mb-3">
                                    <span class="input-group-text bg-light border-end-0"><i class="fas fa-link text-primarys"></i></span>
                                    <input type="text" class="form-control border-start-0 ps-2" style="font-size: 16px;border-left: 0;height: 40px;border: 0;"
                                        value="<?php echo htmlspecialchars($whatsapp_transfer->url); ?>" 
                                        id="transferLinkDisplay" 
                                        readonly>
                                    <button class="btn btn-primarys text-white font-weight-bold" type="button" onclick="copyToClipboard('transferLinkDisplay', this)" style="border-radius: 0px;font-size: 14px;">
                                        <i class="far fa-copy me-2"></i> Copy
                                    </button>
                                    <a href="<?php echo htmlspecialchars($whatsapp_transfer->url); ?>" style="border-radius: 0px 8px 8px 0px;font-size: 14px;"
                                    target="_blank" 
                                    class="btn btn-success">
                                        <i class="fas fa-external-link-alt me-2"></i> Open
                                    </a>
                                </div>
                                
                            </div>
                        </div>
                        <?php endif; ?>
                    <div class="row g-0">
                        <!-- Left Side - User Info -->
                        <div class="col-md-4 p-4 border-end">
                            <div class="d-flex align-items-center mb-4">
                                <div class="avatar-lg bg-primarys bg-opacity-10 text-white  rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 70px; height: 70px;">
                                    <i class="fas fa-user-tie fa-2x"></i>
                                </div>
                                <div class="pl-2">
                                    <h5 class="mb-0 fw-bold font-weight-bold pb-1"><?php echo isset($user->name) ? htmlspecialchars($user->name) : 'N/A'; ?></h5>
                                    <span class="badge bg-primarys bg-opacity-10 text-white">Account Holder</span>
                                </div>
                            </div>
                            
                            <div class="info-card mb-3 p-3 bg-light rounded">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-globe text-primarys me-2"></i>
                                    <span class="fw-bold pl-2">Domain</span>
                                </div>
                                <p class="mb-0 text-dark"><?php echo !empty($domain['url']) ? htmlspecialchars($domain['url']) : 'N/A'; ?></p>
                            </div>
                            
                            <div class="info-card p-3 bg-light rounded">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="far fa-calendar-alt text-primarys me-2"></i>
                                    <span class="fw-bold pl-2">Created On</span>
                                </div>
                                <p class="mb-0 text-dark"><?php echo date('d M Y, h:i A', strtotime($credential->created_at ?? 'now')); ?></p>
                            </div>
                        </div>
                        
                        <!-- Middle - Credentials -->
                        <div class="col-md-4 p-4 border-end">
                            <h5 class="fw-bold mb-4 text-black small font-weight-bold" style="font-size: 20px;">Access Credentials</h5>
                            
                            <div class="credential-card mb-4 p-3 bg-light rounded">
                                <label class="form-label text-muted small mb-2">Username</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text bg-white border-end-0"><i class="fas fa-user text-primarys"></i></span>
                                    <input type="text" class="form-control border-start-0 ps-2" value="<?php echo htmlspecialchars($credential->user_name); ?>" id="username" readonly>
                                    <button class="btn btn-sm btn-outline-primarys" type="button" onclick="copyToClipboard('username', this)">
                                        <i class="far fa-copy"></i> Copy
                                    </button>
                                </div>
                            </div>
                            
                            <div class="credential-card p-3 bg-light rounded">
                                <label class="form-label text-muted small mb-2">Password</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text bg-white border-end-0"><i class="fas fa-key text-primarys"></i></span>
                                    <input type="password" class="form-control border-start-0 ps-2" value="<?php echo htmlspecialchars($credential->password); ?>" id="password" readonly>
                                    <button class="btn btn-sm btn-outline-secondary" type="button" onclick="togglePassword()">
                                        <i class="far fa-eye" id="toggleIcon"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-primarys" type="button" onclick="copyToClipboard('password', this)">
                                        <i class="far fa-copy"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Right Side - QR Code -->
                        <div class="col-md-4 p-4 bg-light">
                            <div class="text-center mb-4">
                                <div class="qr-code-container bg-white p-3 rounded shadow-sm d-inline-block">
                                    <div id="qrcode" class="mx-auto"></div>
                                    <p class="small text-muted mt-2 mb-0">Scan to open this </p>
                                </div>
                            </div>
                            
                            <div class="d-grid gap-2">
                                <?php if (!empty($whatsapp_transfer)): ?>
                                    <button class="btn btn-outline-primarys py-2 rounded-pill shadow-sm w-100 mb-2 font-weight-bold" 
                                            onclick="downloadQR()">
                                        <i class="fas fa-download me-2"></i> Download QR
                                    </button>
                                 
                                    
                                    <input type="hidden" id="transferLink" value="<?php echo htmlspecialchars($whatsapp_transfer->url); ?>">
                                <?php else: ?>
                                    <div class="alert alert-warning mb-0">
                                        <i class="fas fa-exclamation-triangle me-2"></i> No WhatsApp transfer link available
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Bottom Action Buttons -->
                     <?php if (($this->session->userdata('type') == 'admin')) { ?>
                    <div class="p-3 bg-light border-top">
                        <div class="d-flex justify-content-between">
                            <a href="<?php echo base_url('admin/marketing-whatsapp'); ?>" 
                               class="btn btn-outline-secondary rounded-pill px-4">
                                <i class="fas fa-arrow-left me-2"></i> Back to List
                            </a>
                            <div>
                                <a href="<?php echo base_url('admin/edit-marketing-whatsapp/').$credential->id; ?>" 
                                   class="btn btn-warning rounded-pill px-4 me-2">
                                    <i class="fas fa-edit me-2"></i> Edit
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php }?>
                </div>
            </div>
            
                                    
        </div>
    </div>
</div>

<!-- QR Code Library -->
<script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>

<script>
// Generate QR Code
document.addEventListener('DOMContentLoaded', function() {
    <?php if (!empty($whatsapp_transfer)): ?>
    var qrcode = new QRCode(document.getElementById("qrcode"), {
        text: "<?php echo htmlspecialchars($whatsapp_transfer->url); ?>",
        width: 180,
        height: 180,
        colorDark: "#2c3e50",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H
    });
    <?php endif; ?>
    
    // Add animation to cards on load
    const cards = document.querySelectorAll('.card, .info-card, .credential-card');
    cards.forEach((card, index) => {
        setTimeout(() => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'all 0.5s ease-out';
            
            setTimeout(() => {
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, 50);
        }, index * 100);
    });
});

function copyToClipboard(elementId, button) {
    const element = document.getElementById(elementId);
    element.select();
    element.setSelectionRange(0, 99999);
    document.execCommand("copy");
    
    // Show feedback
    const originalText = button.innerHTML;
    button.innerHTML = '<i class="fas fa-check me-1"></i> Copied!';
    button.classList.add('btn-success', 'text-white');
    button.classList.remove('btn-outline-primarys', 'btn-outline-secondary');
    
    // Add animation
    button.style.animation = 'none';
    void button.offsetWidth; // Trigger reflow
    button.style.animation = 'bounce 0.5s';
    
    // Revert after delay
    setTimeout(() => {
        button.innerHTML = originalText;
        button.classList.remove('btn-success', 'text-white');
        if (button.classList.contains('btn-outline-primarys')) {
            button.classList.add('btn-outline-primarys');
        } else {
            button.classList.add('btn-outline-secondary');
        }
    }, 2000);
}

function togglePassword() {
    const passwordInput = document.getElementById('password');
    const toggleIcon = document.getElementById('toggleIcon');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye');
    }
    
    // Add animation
    toggleIcon.style.animation = 'none';
    void toggleIcon.offsetWidth; // Trigger reflow
    toggleIcon.style.animation = 'bounce 0.5s';
}

function downloadQR() {
    <?php if (!empty($whatsapp_transfer)): ?>
    const qrCodeElement = document.querySelector('#qrcode img');
    if (qrCodeElement) {
        const link = document.createElement('a');
        link.download = 'whatsapp-qr-code-<?php echo $credential->id ?? ''; ?>.png';
        link.href = qrCodeElement.src;
        link.click();
        
        // Show toast notification
        showToast('QR Code downloaded successfully!', 'success');
    }
    <?php endif; ?>
}


function showToast(message, type = 'info') {
    // Create toast element
    const toast = document.createElement('div');
    toast.className = `toast show position-fixed bottom-0 end-0 m-3 bg-${type} text-white`;
    toast.style.zIndex = '9999';
    toast.style.borderRadius = '8px';
    toast.style.boxShadow = '0 4px 12px rgba(0,0,0,0.15)';
    toast.innerHTML = `
        <div class="d-flex align-items-center p-3">
            <div class="toast-body">
                <i class="fas fa-${type === 'success' ? 'check-circle' : 'info-circle'} me-2"></i>
                ${message}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" onclick="this.closest('.toast').remove()"></button>
        </div>
    `;
    document.body.appendChild(toast);
    
    // Auto-remove after 3 seconds
    setTimeout(() => {
        toast.remove();
    }, 3000);
}

// Initialize tooltips
document.addEventListener('DOMContentLoaded', function() {
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});
</script>

<style>
:root {
    --primary-colors: <?= $heading->color?>;
    --secondary-color: #858796;
    --success-color: #1cc88a;
    --info-color: #36b9cc;
    --warning-color: #f6c23e;
    --danger-color: #e74a3b;
    --light-color: #f8f9fc;
    --dark-color: #5a5c69;
}

.btn-outline-primarys {
    color: var(--primary-colors);
    border-color: var(--primary-colors);
}

.btn-outline-primarys:hover {
    color: #fff;
    background: var(--primary-colors);
    border-color: var(--primary-colors);
}
.bg-primarys {
    background: var(--primary-colors);
}
.card {
    border: none;
    border-radius: 0.5rem;
    overflow: hidden;
    transition: all 0.3s ease;
    margin-bottom: 1.5rem;
    box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.15);
}

.card-header {
    background: #fff;
    border-bottom: 1px solid #e3e6f0;
    padding: 1rem 1.5rem;
}

.bg-gradient-primary {
    background: <?= $heading->color?> !important;
}

.input-group-text {
    border-right: 0;
    border-radius: 8px 0 0 8px;
}

.form-control, .form-control:focus {
    border-color: #d1d3e2;
    box-shadow: none;
}

.form-control:focus {
    border-color: #bac8f3;
    box-shadow: <?= $heading->color?>      ;
}

.btn {
    font-weight: 600;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    font-size: 0.75rem;
    padding: 0.5rem 1rem;
}

.btn-lg {
    padding: 0.75rem 1.5rem;
    font-size: 0.9rem;
}

.text-primarys {
    color: var(--primary-colors);
}
.btn-primarys {
    background: var(--primary-colors);
    border-color: var(--primary-colors);
}

.btn-primarys:hover {
    background: #2e59d9;
    border-color: #2653d4;
}

.btn-success {
    background: var(--success-color);
    border-color: var(--success-color);
}

.btn-success:hover {
    background: #17a673;
    border-color: #169b6b;
}

.badge {
    font-weight: 500;
    letter-spacing: 0.5px;
    padding: 0.4em 0.8em;
}

.avatar-lg {
    width: 4rem;
    height: 4rem;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    border-radius: 50%;
}

.info-card, .credential-card {
    transition: all 0.3s ease;
    border: 1px solid #e3e6f0;
}

.info-card:hover, .credential-card:hover {
    transform: translateX(5px);
    border-color: #bac8f3;
    background: #fff !important;
}

.qr-code-container {
    background: #fff;
    padding: 1rem;
    border-radius: 0.5rem;
    box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
}

/* Animations */
@keyframes bounce {
    0%, 20%, 50%, 80%, 100% {transform: translateY(0);} 
    40% {transform: translateY(-5px);} 
    60% {transform: translateY(-3px);} 
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.fade-in {
    animation: fadeIn 0.5s ease-out forwards;
}

/* Toast notification */
.toast {
    opacity: 0;
    transition: opacity 0.3s ease-in-out;
}

.toast.show {
    opacity: 1;
}

/* Responsive adjustments */
@media (max-width: 991.98px) {
    .card {
        margin-bottom: 1rem;
    }
    
    .input-group > .form-control {
        font-size: 0.875rem;
    }
    
    .btn {
        padding: 0.375rem 0.75rem;
    }
}

/* Print styles */
@media print {
    body * {
        visibility: hidden;
    }
    .card, .card * {
        visibility: visible;
    }
    .card {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        border: none;
        box-shadow: none;
    }
    .no-print {
        display: none !important;
    }
}
</style>