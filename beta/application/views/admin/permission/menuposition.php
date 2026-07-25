<style>
    .menu-container {
        max-width: 800px;
        margin: 0 auto;
    }
    
    .menu-header {
        background: linear-gradient(135deg, #4361ee 0%, #3a0ca3 100%);
        color: white;
        border-radius: 10px 10px 0 0;
        padding: 20px 25px;
        margin-bottom: 0;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    
    .menu-card {
        background: white;
        border-radius: 10px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        overflow: hidden;
        margin-bottom: 30px;
    }
    
    .menu-body {
        padding: 25px;
    }
    
    .menus {
        padding: 15px 20px;
        background: #ffffff;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        margin-bottom: 12px;
        cursor: move;
        display: flex;
        align-items: center;
        transition: all 0.3s ease;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        font-weight: 600;
        touch-action: none;
        -ms-touch-action: none;
    }
    
    .menus:hover {
        background: #f8f9fa;
        transform: translateX(5px);
        border-left: 4px solid #4361ee;
    }
    
    .menus:active {
        cursor: grabbing;
    }
    
    #menu-sortable {
        min-height: 50px;
    }
    
    .ui-sortable-helper {
        transform: rotate(2deg);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    
    .ui-sortable-placeholder {
        visibility: visible !important;
        background: #f8f9fa;
        border: 2px dashed #dee2e6;
        border-radius: 8px;
        margin: 12px 0;
    }
    
    .save-btn-container {
        display: flex;
        justify-content: flex-end;
        padding: 20px;
        background: #f8f9fa;
        border-top: 1px solid #e9ecef;
        border-radius: 0 0 10px 10px;
    }
    
    #saveOrder {
        padding: 10px 30px;
        font-weight: 600;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    #saveOrder .spinner-border {
        display: none;
        width: 16px;
        height: 16px;
        border-width: 2px;
    }
    
    #saveOrder.saving .spinner-border {
        display: inline-block;
    }
    
    .alert-success {
        margin: 20px 0;
        border-radius: 8px;
        border-left: 4px solid #28a745;
    }
    #menu-sortable {
    touch-action: none;
}

.menus {
    touch-action: none;
    user-select: none;
    -webkit-user-select: none;
    -webkit-touch-callout: none;
}

</style>

<div class="container-fluid p-0">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb ">
      <li class="breadcrumb-item "><a href="<?php echo base_url('admin-dashboard'); ?>" class="text-decoration-none">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Menu Position</li>
    </ol>
  </nav>
</div>

<div class="container-fluid px-0">
    <div class="menu-container">
        <div class="menu-card">
            <h4 class="menu-header">
                <i class="fas fa-bars mr-2"></i> Menu Positions
                <small class="d-block text-white-50 mt-1" style="font-size: 14px;">Drag and drop to reorder menu items</small>
            </h4>
            
            <div class="menu-body">
                <?php if($this->session->flashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= $this->session->flashdata('success'); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php endif; ?>
                
                <ul id="menu-sortable" class="list-unstyled">
                    <li class="menus" data-key="home" data-id="<?= $roles['home']; ?>"><span class="mr-2"><?= $roles['home']; ?>. </span> <i class="fas fa-home mr-2"></i> Home</li>
                    <li class="menus" data-key="cibil_score_check" data-id="<?= $roles['cibil_score_check']; ?>"><span class="mr-2"><?= $roles['cibil_score_check']; ?>. </span> <i class="fas fa-credit-card mr-2"></i> CIBIL Score Check</li>
                    <li class="menus" data-key="instant_loans_kyc" data-id="<?= $roles['instant_loans_kyc']; ?>"><span class="mr-2"><?= $roles['instant_loans_kyc']; ?>. </span> <i class="fas fa-file-signature mr-2"></i> Upload excel For payout Instant loan</li>
                    <li class="menus" data-key="dsa_registration" data-id="<?= $roles['dsa_registration']; ?>"><span class="mr-2"><?= $roles['dsa_registration']; ?>. </span> <i class="fas fa-user-tie mr-2"></i> DSA Registration</li>
                    <li class="menus" data-key="branch_franchise" data-id="<?= $roles['branch_franchise']; ?>"><span class="mr-2"><?= $roles['branch_franchise']; ?>. </span> <i class="fas fa-code-branch mr-2"></i> Branch / Franchise</li>
                    <li class="menus" data-key="change_plan" data-id="<?= $roles['change_plan']; ?>"><span class="mr-2"><?= $roles['change_plan']; ?>. </span> <i class="fas fa-exchange-alt mr-2"></i> Change Plan</li>
                    <li class="menus" data-key="my_customers" data-id="<?= $roles['my_customers']; ?>"><span class="mr-2"><?= $roles['my_customers']; ?>. </span> <i class="fas fa-users mr-2"></i> My Customers</li>
                    <li class="menus" data-key="payment_history" data-id="<?= $roles['payment_history']; ?>"><span class="mr-2"><?= $roles['payment_history']; ?>. </span> <i class="fas fa-history mr-2"></i> Payment History</li>
                    <li class="menus" data-key="banker_contact" data-id="<?= $roles['banker_contact']; ?>"><span class="mr-2"><?= $roles['banker_contact']; ?>. </span> <i class="fas fa-address-book mr-2"></i> Banker Contact</li>
                    <li class="menus" data-key="add_bank" data-id="<?= $roles['add_bank']; ?>"><span class="mr-2"><?= $roles['add_bank']; ?>. </span> <i class="fas fa-university mr-2"></i> Add Bank</li>
                    <li class="menus" data-key="loan_type_master" data-id="<?= $roles['loan_type_master']; ?>"><span class="mr-2"><?= $roles['loan_type_master']; ?>. </span> <i class="fas fa-clipboard-list mr-2"></i> Loan Type Master</li>
                    <li class="menus" data-key="bankwise_eligibility" data-id="<?= $roles['bankwise_eligibility']; ?>"><span class="mr-2"><?= $roles['bankwise_eligibility']; ?>. </span> <i class="fas fa-check-circle mr-2"></i> Bankwise Eligibility</li>
                    <li class="menus" data-key="bankwise_pdf" data-id="<?= $roles['bankwise_pdf']; ?>"><span class="mr-2"><?= $roles['bankwise_pdf']; ?>. </span> <i class="fas fa-file-pdf mr-2"></i> Bankwise PDF</li>
                    <li class="menus" data-key="lead_menu" data-id="<?= $roles['lead_menu']; ?>"><span class="mr-2"><?= $roles['lead_menu']; ?>. </span> <i class="fas fa-bullseye mr-2"></i> Lead</li>
                    <li class="menus" data-key="your_team_bank_login_list" data-id="<?= $roles['your_team_bank_login_list']; ?>"><span class="mr-2"><?= $roles['your_team_bank_login_list']; ?>. </span> <i class="fas fa-user-friends mr-2"></i> Your Team Bank Login List</li>
                    <li class="menus" data-key="bank_login_list" data-id="<?= $roles['bank_login_list']; ?>"><span class="mr-2"><?= $roles['bank_login_list']; ?>. </span> <i class="fas fa-list-ul mr-2"></i> Bank Login List</li>
                    <li class="menus" data-key="bank_login" data-id="<?= $roles['bank_login']; ?>"><span class="mr-2"><?= $roles['bank_login']; ?>. </span> <i class="fas fa-sign-in-alt mr-2"></i> Bank Login</li>
                    <li class="menus" data-key="my_team" data-id="<?= $roles['my_team']; ?>"><span class="mr-2"><?= $roles['my_team']; ?>. </span> <i class="fas fa-users-cog mr-2"></i> My Team</li>
                    <li class="menus" data-key="dsa_branch_team" data-id="<?= $roles['dsa_branch_team']; ?>"><span class="mr-2"><?= $roles['dsa_branch_team']; ?>. </span> <i class="fas fa-sitemap mr-2"></i> DSA & Branch Team</li>
                    <li class="menus" data-key="my_network" data-id="<?= $roles['my_network']; ?>"><span class="mr-2"><?= $roles['my_network']; ?>. </span> <i class="fas fa-project-diagram mr-2"></i> My Network</li>
                    <li class="menus" data-key="self_bank_login" data-id="<?= $roles['self_bank_login']; ?>"><span class="mr-2"><?= $roles['self_bank_login']; ?>. </span> <i class="fas fa-user-lock mr-2"></i> Self Bank Login</li>
                    <li class="menus" data-key="bank_wise_login" data-id="<?= $roles['bank_wise_login']; ?>"><span class="mr-2"><?= $roles['bank_wise_login']; ?>. </span> <i class="fas fa-university mr-2"></i> Bank Wise Login</li>
                    <li class="menus" data-key="my_payout_slabs" data-id="<?= $roles['my_payout_slabs']; ?>"><span class="mr-2"><?= $roles['my_payout_slabs']; ?>. </span> <i class="fas fa-money-bill-wave mr-2"></i> My Payout Slabs</li>
                    <li class="menus" data-key="my_profile" data-id="<?= $roles['my_profile']; ?>"><span class="mr-2"><?= $roles['my_profile']; ?>. </span> <i class="fas fa-user-circle mr-2"></i> My Profile</li>
                    <li class="menus" data-key="promotional_notifications" data-id="<?= $roles['promotional_notifications']; ?>"><span class="mr-2"><?= $roles['promotional_notifications']; ?>. </span> <i class="fas fa-bullhorn mr-2"></i> Promotional Notifications</li>
                    <li class="menus" data-key="video" data-id="<?= $roles['video']; ?>"><span class="mr-2"><?= $roles['video']; ?>. </span> <i class="fas fa-video mr-2"></i> Videos</li>
                    <li class="menus" data-key="permission" data-id="<?= $roles['permission']; ?>"><span class="mr-2"><?= $roles['permission']; ?>. </span> <i class="fas fa-key mr-2"></i> Permissions</li>
                    <li class="menus" data-key="pages" data-id="<?= $roles['pages']; ?>"><span class="mr-2"><?= $roles['pages']; ?>. </span> <i class="fas fa-file-alt mr-2"></i> Pages</li>
                    <li class="menus" data-key="marketing_material_sales_data" data-id="<?= $roles['marketing_material_sales_data']; ?>"><span class="mr-2"><?= $roles['marketing_material_sales_data']; ?>. </span> <i class="fas fa-chart-line mr-2"></i> Marketing Material / Sales Data</li>
                    <li class="menus" data-key="loan_enquiry" data-id="<?= $roles['loan_enquiry']; ?>"><span class="mr-2"><?= $roles['loan_enquiry']; ?>. </span> <i class="fas fa-search-dollar mr-2"></i> Loan Enquiry</li>
                    <li class="menus" data-key="government_services" data-id="<?= $roles['government_services']; ?>"><span class="mr-2"><?= $roles['government_services']; ?>. </span> <i class="fas fa-landmark mr-2"></i> Government Services</li>
                    <li class="menus" data-key="brand_loan" data-id="<?= $roles['brand_loan']; ?>"><span class="mr-2"><?= $roles['brand_loan']; ?>. </span> <i class="fas fa-tag mr-2"></i> Brand Loan</li>
                    <li class="menus" data-key="document_menu" data-id="<?= $roles['document_menu']; ?>"><span class="mr-2"><?= $roles['document_menu']; ?>. </span> <i class="fas fa-file-contract mr-2"></i> Document</li>
                    <li class="menus" data-key="indiasale_dashboard" data-id="<?= $roles['indiasale_dashboard']; ?>"><span class="mr-2"><?= $roles['indiasale_dashboard']; ?>. </span> <i class="fas fa-file-contract mr-2"></i>  Apply Instant Loan kyc</li>
                    <li class="menus" data-key="product" data-id="<?= $roles['product']; ?>"><span class="mr-2"><?= $roles['product']; ?>. </span> <i class="fas fa-box mr-2"></i>  Product</li>
                </ul>
            </div>
            
            <div class="save-btn-container">
                <button id="saveOrder" class="btn btn-primary">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    <span class="btn-text">Save Menu Order</span>
                </button>
            </div>
        </div>
    </div>
</div>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

<script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>
<script>
    $(document).ready(function() {
    var $menuItems = $("#menu-sortable > li");
    $menuItems.sort(function(a, b) {
    return ($(a).data('id') || 999) - ($(b).data('id') || 999);
    });
    $("#menu-sortable").append($menuItems);
    });         
</script>
<script>
$(document).ready(function() {
    $("#menu-sortable").sortable({
        placeholder: "ui-state-highlight",
        tolerance: "pointer",
        delay: 200,      
        scroll: true
    });

    $("#saveOrder").click(function () {
        let menuData = {};
        let position = 1;
        $("#menu-sortable li").each(function () {
            let columnName = $(this).data("key");
            menuData[columnName] = position;
            position++;
        });
        $.ajax({
            url: "<?= base_url('admin/rolepermission/update_menu_position'); ?>",
            type: "POST",
            data: {
                menus: menuData,
                role_id: 1,
                domain_id: 3
            },
            success: function () {
                alert("Menu order updated successfully");
                location.reload();
            }
        });
    });

});
</script>