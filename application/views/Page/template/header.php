<!doctype html>
<html lang="en">
<head>

<?php
    // Fetch domain ID and validate
    $domain_ids = domain_id_get();
   
    $hedercontectUs = $this->db->where('domain_id', $domain_ids)->get('contect_us')->row_array();
     $logo_path = !empty($hedercontectUs['logo']) && file_exists(FCPATH . 'beta/assets/images/logo/' . $hedercontectUs['logo']) 
        ? base_url('beta/assets/images/logo/' . $hedercontectUs['logo']) 
        : base_url('upload/assets/images/default-logo.png');
     $logo_icon_path = !empty($hedercontectUs['logo_icon']) && file_exists(FCPATH . 'beta/assets/images/logo/' . $hedercontectUs['logo_icon']) 
        ? base_url('beta/assets/images/logo/' . $hedercontectUs['logo_icon']) 
        : base_url('upload/assets/images/default-logo.png');
    // print_r($hedercontectUs);die;
    $default_phone = '';
    $default_email = '';
?>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Expert Financial Consultation with <?= isset($contectUs['company_title']) && !empty($contectUs['company_title']) ? $contectUs['company_title'] : '' ?>™ Quick Registration and Process. Apply Now at <?= isset($contectUs['company_title']) && !empty($contectUs['company_title']) ? $contectUs['company_title'] : '' ?>.com & Get Best Financial Consultation" />
    <meta name="keywords" content="Apply for Personal loan, Personal loan online, personal loan approval" />

    <!-- Favicon and Apple Touch Icon -->
    <?php
    // Define base URL for assets
    $asset_base = base_url('upload/assets');
    // Check if favicon and apple-touch-icon files exist
    $favicon_path = file_exists(FCPATH . 'upload/assets/images/favicon.ico') ? $asset_base . '/images/favicon.ico' : $asset_base . '/images/default-favicon.ico';
    $apple_icon_path = file_exists(FCPATH . 'upload/assets/images/apple-icon-180x180.png') ? $asset_base . '/images/apple-icon-180x180.png' : $asset_base . '/images/default-apple-icon.png';
    $favicon_16x16_path = file_exists(FCPATH . 'upload/assets/images/favicon-16x16.png') ? $asset_base . '/images/favicon-16x16.png' : $asset_base . '/images/default-favicon-16x16.png';
    ?>
    <link rel="apple-touch-icon" sizes="180x180" href="<?= $logo_icon_path ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= $logo_icon_path ?>">
    <link rel="icon" type="image/x-icon" href="<?= $logo_icon_path ?>">

    <!-- CSS Files -->
    <?php
    // Check if CSS files exist
    $plugins_css = file_exists(FCPATH . 'upload/assets/css/plugins.css') ? $asset_base . '/css/plugins.css' : '';
    $style_css = file_exists(FCPATH . 'upload/assets/css/style.css') ? $asset_base . '/css/style.css' : '';
    ?>
    <?php if (!empty($plugins_css)): ?>
        <link rel="stylesheet" href="<?= $plugins_css ?>">
    <?php endif; ?>
    <?php if (!empty($style_css)): ?>
        <link rel="stylesheet" href="<?= $style_css ?>">
    <?php endif; ?>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <title><?= isset($hedercontectUs['heading']) && !empty($hedercontectUs['heading']) ? $hedercontectUs['heading'] : 'Not found' ?> | <?= isset($hedercontectUs['company_title']) && !empty($hedercontectUs['company_title']) ? $hedercontectUs['company_title'] : 'Not found' ?></title>
</head>
<body>
    <div class="body-inner">
        <!-- Topbar -->
        <div id="topbar" class="d-none d-xl-block d-lg-block topbar-transparent topbar-fullwidth dark">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <ul class="top-menu">
                            
                            <li>
                                <a href="tel:<?= !empty($hedercontectUs['mobile_no']) ? htmlspecialchars($hedercontectUs['mobile_no']) : $default_phone ?>">
                                    <i class="fa fa-phone m-r-5"></i> <?= !empty($hedercontectUs['mobile_no']) ? htmlspecialchars($hedercontectUs['mobile_no']) : $default_phone ?>
                                </a>
                            </li>
                            <li>
                                <a href="mailto:<?= !empty($hedercontectUs['company_gmail']) ? htmlspecialchars($hedercontectUs['company_gmail']) : $default_email ?>">
                                    <i class="fa fa-envelope m-r-5"></i> <?= !empty($hedercontectUs['company_gmail']) ? htmlspecialchars($hedercontectUs['company_gmail']) : $default_email ?>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6 d-none d-sm-block">
                        <ul class="top-menu right">
                            
                    <?php $imp = $this->db->where('domain_id', domain_id_get())->get('important_update')->row_array(); ?>
                            <li><a href="<?= base_url('raise-request') ?>">Raise a Request</a></li>
                            <?php if (!empty($imp)) { ?> <li><a href="<?= base_url('important-update') ?>">Important Update</a></li><?php }?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Header -->
        <header id="header" data-transparent="true" data-fullwidth="true" class="light submenu-light">
            <div class="header-inner">
                <div class="container">
                    <!-- Logo -->
                    <div id="logo">
                        <a href="<?= base_url() ?>">
                            <?php
                            // Fetch contact details for logo
                            $contectUs = $this->db->where('domain_id', $domain_ids)->get('contect_us')->row_array();
                           
                            ?>
                           <span class="logo-default">
                                <img src="<?= $logo_path ?>"
                                    alt="<?= !empty($contectUs['company_title']) ? $contectUs['company_title'] : '' ?>"
                                    style="object-fit:contain;
                                            width:<?= !empty($contectUs['header_w_logo']) ? $contectUs['header_w_logo'] : '100'; ?>px;
                                            height:<?= !empty($contectUs['header_h_logo']) ? $contectUs['header_h_logo'] : '100'; ?>px;">
                            </span>

                            <span class="logo-dark">
                                <img src="<?= $logo_path ?>"
                                    alt="<?= !empty($contectUs['company_title']) ? $contectUs['company_title'] : '' ?>"
                                    style="object-fit:contain;
                                            width:<?= !empty($contectUs['header_w_logo']) ? $contectUs['header_w_logo'] : '100'; ?>px;
                                            height:<?= !empty($contectUs['header_h_logo']) ? $contectUs['header_h_logo'] : '100'; ?>px;">
                            </span>
                        </a>
                    </div>

                    <!-- Menu Trigger -->
                    <div id="mainMenu-trigger">
                        <a class="lines-button x"><span class="lines"></span></a>
                    </div>

                    <!-- Main Menu -->
                    <div id="mainMenu">
                        <div class="container">
                            <?php
                            // Fetch active menus
                            $menus = $this->db->where(['status' => 1, 'domain_id' => $domain_ids])->get('menus')->result();
                            
                            // Function to build menu tree
                            function build_menu_tree($menus, $parent_id = 0) {
                                $menu_tree = [];
                                foreach ($menus as $menu) {
                                    if ($menu->parent_id == $parent_id) {
                                        $menu->children = build_menu_tree($menus, $menu->id);
                                        $menu_tree[] = $menu;
                                    }
                                }
                                return $menu_tree;
                            }

                            // Build menu tree with fallback
                            $menu_tree = !empty($menus) ? build_menu_tree($menus) : [];
       ?>

                            <nav>
                                <ul>
                                    <?php if (!empty($menu_tree)): ?>
                                        <?php foreach ($menu_tree as $menu): ?>
                                            <li id="menu_<?= htmlspecialchars($menu->id) ?>" class="<?= !empty($menu->children) ? 'dropdown' : '' ?>">
                                                <a href="<?= !empty($menu->children) ? '#' : htmlspecialchars($menu->url) ?>">
                                                    <?= htmlspecialchars($menu->title) ?>
                                                </a>
                                                <?php if (!empty($menu->children)): ?>
                                                    <ul class="dropdown-menu">
                                                        <?php foreach ($menu->children as $child): ?>
                                                            <li id="menu_<?= htmlspecialchars($child->id) ?>" class="">
                                                                <a href="<?= htmlspecialchars($child->url) ?>">
                                                                    <i class="fa fa-info-circle"></i> 
                                                                    <?= htmlspecialchars($child->title) ?>
                                                                </a>
                                                            </li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                <?php endif; ?>
                                            </li>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <li><a href="<?= base_url() ?>">Home</a></li> <!-- Fallback menu item -->
                                    <?php endif; ?>

                                     <li id="111" class=""><a href="<?= base_url('channel-partner-code')?>">DSA Registration</a></li>
                                    <li id="111" class=""><a href="<?= base_url('branch-franchise-code')?>">Branch Franchise Registration</a></li>

                                    <?php if (!$this->session->userdata('role')): ?>
                                        <li id="112" class="dropdown">
                                            <a href="#">Leads</a>
                                            <ul class="dropdown-menu">
                                                <li id="1091" class="">
                                                    <a href="<?= base_url('beta/admin/share-pl?user_id=&role=') ?>">Personal Loan</a>
                                                </li>
                                                <li id="1091" class="">
                                                    <a href="<?= base_url('beta/admin/share-bl?user_id=&role=') ?>">Business Loan</a>
                                                </li>
                                            </ul>
                                        </li>
                                    <?php endif; ?>
                                    <!-- User Menu (Conditional based on login status) -->

                                    <?php if ($this->session->userdata('username')): ?>
                                        <li id="112" class="dropdown">
                                            <a href="#"><?= htmlspecialchars($this->session->userdata('username')) ?></a>
                                            <ul class="dropdown-menu menu-last">
                                               <?php 
                                            //    $branch_user = $this->db->where(['role'=> 3, 'id'=> $this->session->userdata('uid')])->get('branch_franchise')->row_array();
                                                $dsa_user = $this->db->where(['role'=> 2, 'id'=> $this->session->userdata('user_id')])->get('user_master')->row_array();

                                               if ($this->session->userdata('role') !== null && $this->session->userdata('status') == 2) { }else{?> 
                                               
                                                 <?php if ($this->session->userdata('role') !== null ){ ?>
                                                     <li id="1121" class="">
                                                         <a href="<?= base_url('beta/admin-dashboard') ?>">
                                                             <i class="fa fa-users"></i> Dashboard
                                                         </a>
                                                     </li>
                                                   
                                                <?php }?>
                                                <?php if ($this->session->userdata('role') !== null): ?>
                                                    <li id="1121" class="">
                                                        <a href="<?= base_url('profile') ?>">
                                                            <i class="fa fa-users"></i> Profile
                                                        </a>
                                                    </li>
                                                <?php endif; ?>
                                                <?php if ($this->session->userdata('role') !== null ){ ?>
                                                <?php if ($this->session->userdata('type') != 'admin' && $this->session->userdata('type') != 'subadmin' ): ?>
                                                    <?php 
                                                        // print_r($this->db->last_query());die;
                                                        if (!empty($dsa_user) && $dsa_user['parent_id_role'] == 1) {
                                                            
                                                        }else{ ?>
                                                        <li id="1121" class="">
                                                            <a href="<?= base_url('Cards') ?>">
                                                                <i class="fa fa-users"></i> Active Membership
                                                            </a>
                                                        </li>
                                                   <?php }?>
                                                <?php endif; ?>
                                                <?php }?>
                                                <?php if (empty($this->session->userdata('role'))): ?>
                                                    <li id="1121" class="">
                                                        <a href="<?= base_url('Loan_details') ?>">
                                                            <i class="fa fa-users"></i> Loan Details
                                                        </a>
                                                    </li>
                                                <?php endif; ?>
                                            <?php }?>
                                                <li id="1123" class="">
                                                    <a href="<?= base_url('logout') ?>">
                                                        <i class="fa fa-users"></i> Logout
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                    <?php else: ?>
                                        <li id="112" class="dropdown">
                                            <a href="#">Login</a>
                                            <ul class="dropdown-menu menu-last">
                                                <li id="1121" class="">
                                                    <a href="<?= base_url('customer') ?>">
                                                        <i class="fa fa-users"></i> Customer Login
                                                    </a>
                                                </li>
                                                <li id="1123" class="">
                                                    <a href="<?= base_url('beta/desk-login/branch') ?>">
                                                        <i class="fa fa-users"></i> Branch Franchise Login
                                                    </a>
                                                </li>
                                                <li id="1123" class="">
                                                    <a href="<?= base_url('beta/desk-login') ?>">
                                                        <i class="fa fa-users"></i> DSA Login/Team Login
                                                    </a>
                                                </li>
                                                <li id="1123" class="">
                                                    <a href="<?= base_url('beta/desk-login/admin') ?>">
                                                        <i class="fa fa-users"></i> Admin Login
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                    <?php endif; ?>

                                    <!-- Contact Info Dropdown -->
                                    <li>
                                        <div class="header-extras">
                                            <div class="p-dropdown">
                                                <a class="x"><span class="lines"></span></a>
                                                <ul class="p-dropdown-content">
                                                    <li>
                                                        <a href="tel:<?= !empty($hedercontectUs['mobile_no']) ? htmlspecialchars($hedercontectUs['mobile_no']) : $default_phone ?>">
                                                            <i class="icon-phone-call"></i> <?= !empty($hedercontectUs['mobile_no']) ? htmlspecialchars($hedercontectUs['mobile_no']) : $default_phone ?>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="mailto:<?= !empty($hedercontectUs['company_gmail']) ? htmlspecialchars($hedercontectUs['company_gmail']) : $default_email ?>">
                                                            <i class="icon-mail"></i> <?= !empty($hedercontectUs['company_gmail']) ? htmlspecialchars($hedercontectUs['company_gmail']) : $default_email ?>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </header>