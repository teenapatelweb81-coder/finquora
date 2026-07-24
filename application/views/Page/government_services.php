<div class=" <?php if(domain_id_get() == 3){?> container-fluid <?php }else{ ?>container<?php } ?> py-5 px-sm-5">
    <div class="row m-0">

    <?php if(domain_id_get() == 3){?>
        <!-- LEFT CONTENT -->
        <div class="col-lg-5 mb-4">

            <div class="loan-info">
                <?php if (!empty($page_content['description'])) { ?>
                <?= $page_content['description']; ?>
            <?php } ?>

            </div>

        </div>
        <?php }?>


        <!-- RIGHT FORM -->
        <div class="<?php if(domain_id_get() == 3){?> col-lg-7 <?php }else{ ?>col-lg-12<?php } ?>">
            <div class="">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="card shadow-lg">
                            <div class="card-header text-white p-3" style="background-color:<?= isset($heading['color']) ? $heading['color'] :  '#ed940d' ?>">
                                <h3 class="mb-0 text-center"><i class="fas fa-file-invoice-dollar mr-2"></i><?= isset($heading['title']) ? $heading['title'] : 'Government Services' ?>   Form</h3>
                            </div>
                            <?php if ($this->session->flashdata('success')): ?>
                                <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                                    <?= $this->session->flashdata('success'); ?>
                                </div>

                            <?php elseif ($this->session->flashdata('error')): ?>
                                <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                                    <?= $this->session->flashdata('error'); ?>
                                </div>
                            <?php endif; ?>


                            <form class="form-horizontal" action="<?= base_url('government-services-insert'); ?>" method="post" enctype="multipart/form-data" novalidate>
                                <div class="card-body p-4">
                                    <h5 class="mb-4 text-primary pb-1"><i class="fas fa-user-circle mr-2"></i>Personal Information</h5>
                                    <div class="row g-3 mb-3">
                                        <div class="col-md-6">
                                            <input type="hidden" name="type" value="<?= isset($_GET['type']) ? $_GET['type'] : 'governmentservices' ?>">
                                            <input type="hidden" name="domain_id" value="<?= domain_id_get() ?>">
                                            <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter your full name" value="<?= set_value('name'); ?>" required>
                                            </div>
                                            <?php echo form_error('name', '<div class="invalid-feedback d-block">', '</div>'); ?>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="mobile" class="form-label">Mobile Number <span class="text-danger">*</span></label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                                <input type="tel" class="form-control" id="mobile" name="mobile" placeholder="Enter 10-digit mobile number" value="<?= set_value('mobile'); ?>" pattern="[0-9]{10}" required>
                                            </div>
                                            <?php echo form_error('mobile', '<div class="invalid-feedback d-block">', '</div>'); ?>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="email" class="form-label">Email ID <span class="text-danger">*</span></label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" value="<?= set_value('email'); ?>">
                                            </div>
                                            <?php echo form_error('email', '<div class="invalid-feedback d-block">', '</div>'); ?>
                                        </div>

                                    
                                    </div>

                                    <h5 class="mb-4 text-primary pb-1"><i class="fas fa-map-marker-alt mr-2"></i>Address Details</h5>
                                    <div class="row g-3 mb-3">
                                        <div class="col-12">
                                            <label for="address" class="form-label">Full Address</label>
                                            <div class="input-group mb-3">
                                                <textarea class="form-control" id="address" name="address" rows="3" placeholder="Enter your full address"><?= set_value('address'); ?></textarea>
                                            </div>
                                        </div>

                                    
                                        <div class="col-md-4">
                                            <label for="state" class="form-label">State <span class="text-danger">*</span></label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text"><i class="fas fa-map"></i></span>
                                                <select class="form-control" id="state" name="state" required>
                                                    <option value="" disabled selected>Select State</option>
                                                    <?php foreach ($states as $state): ?>
                                                        <option value="<?= $state['id'] ?>"><?= $state['name'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <?php echo form_error('state', '<div class="invalid-feedback d-block">', '</div>'); ?>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="city" class="form-label">City <span class="text-danger">*</span></label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text"><i class="fas fa-city"></i></span>
                                                <input type="text" class="form-control" id="city" name="city" placeholder="Your city" value="<?= set_value('city'); ?>" required>
                                            </div>
                                            <?php echo form_error('city', '<div class="invalid-feedback d-block">', '</div>'); ?>
                                        </div>


                                        <div class="col-md-4">
                                            <label for="pincode" class="form-label">Pincode <span class="text-danger">*</span></label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text"><i class="fas fa-map-pin"></i></span>
                                                <input type="text" class="form-control" id="pincode" name="pincode" placeholder="6-digit pincode" pattern="[0-9]{6}" value="<?= set_value('pincode'); ?>" required>
                                            </div>
                                            <?php echo form_error('pincode', '<div class="invalid-feedback d-block">', '</div>'); ?>
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <div class="form-check d-flex align-items-center"style="gap: 5px">
                                            <input class="" type="checkbox" id="terms" name="terms" required>
                                            <label class="form-check-label" for="terms">
                                                I hereby declare that the information provided is true and correct to the best of my knowledge.
                                            </label><br>
                                            <div class="invalid-feedback">
                                                You must agree to the terms and conditions.
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer bg-light p-4 text-center">
                                <button type="reset" class="btn  <?= isset($heading['color']) ? 'btn-dynamic' :  'btn-outline-secondary' ?>    mr-2"><i class="fas fa-redo me-1"></i> Reset</button>
                                    <button type="submit" class="btn  <?= isset($heading['color']) ? 'btn-dynamic' :  'btn-primary' ?> px-4">
                                        <i class="fas fa-paper-plane mr-2"></i>Submit government services
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<!-- Add Bootstrap JS and Popper.js for form validation -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Form validation script -->
<script>
// Form validation


// Auto-format Aadhar number
const aadharInput = document.getElementById('aadhar');
if (aadharInput) {
    aadharInput.addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        if (value.length > 12) value = value.substring(0, 12);
        e.target.value = value;
    });
}

// Auto-format PAN number (uppercase and limit to 10 characters)
const panInput = document.getElementById('pan');
if (panInput) {
    panInput.addEventListener('input', function(e) {
        let value = e.target.value.toUpperCase();
        if (value.length > 10) value = value.substring(0, 10);
        e.target.value = value;
    });
}

// Auto-format mobile number (limit to 10 digits)
const mobileInput = document.getElementById('mobile');
if (mobileInput) {
    mobileInput.addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        if (value.length > 10) value = value.substring(0, 10);
        e.target.value = value;
    });
}

// Auto-format pincode (limit to 6 digits)
const pincodeInput = document.getElementById('pincode');
if (pincodeInput) {
    pincodeInput.addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        if (value.length > 6) value = value.substring(0, 6);
        e.target.value = value;
    });
}
</script>

<style>
    .alert-dismissible p{
    margin-bottom:0;
    color:#fff;
    } 
.card-body {
    padding: 2rem;
}

.form-label {
    font-weight: 500;
    margin-bottom: 0.5rem;
}

.input-group-text {
    background-color:  <?= isset($heading['color']) ? $heading['color'] :  '#ed940d' ?>;
    border-radius: 5px 0 0 5px;
}

.btn-dynamic {
    background-color:  <?= isset($heading['color']) ? $heading['color'] :  '#ed940d' ?> !important;
    border :1px solid  <?= isset($heading['color']) ? $heading['color'] :  '#ed940d' ?> !important;
}


.btn-primary {
    padding: 0.5rem 2rem;
    font-weight: 500;
}

.invalid-feedback {
    font-size: 0.85rem;
}

/* Custom checkbox style */
.form-check-input:checked {
    background-color: #0d6efd;
    border-color: #0d6efd;
}

/* Add some spacing between form sections */
h5 {
    padding-bottom: 0.5rem;
    border-bottom: 2px solid #e9ecef;
    margin-bottom: 1.5rem;
    padding-bottom: 0.75rem;
}

/* Make form controls more consistent in height */
.form-control, .form-select, .form-check-input {
    min-height: 45px;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .card-body {
        padding: 1.5rem;
    }
    
    .btn {
        width: 100%;
        margin-bottom: 0.5rem;
    }
}
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        setTimeout(function() {
            $(".fade-out").fadeOut("slow");
        }, 5000); 
    });
</script>
<script>
$(document).ready(function() {
    $("form").submit(function(e) {
        let isValid = true;
        
        // $("input, select").each(function() {
        $("input[required], select[required]").each(function() {
            if ($(this).prop("required") && $(this).val().trim() === "") {
                isValid = false;
                $(this).css("border", "2px solid red");
            } else {
                $(this).css("border", "1px solid #ced4da");
            }
        });

        if (!isValid) {
            alert("Please fill out all required fields.");
            e.preventDefault();
        }
    });
});
</script>
