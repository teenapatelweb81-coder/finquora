<?php
// Fetch contact data from the database
$contectUs = $this->db->where('domain_id', domain_id_get())->get('contect_us')->row_array();
$disclaimer = $this->db->where('domain_id', domain_id_get())->get('disclaimer')->row_array();
$terms_condition = $this->db->where('domain_id', domain_id_get())->get('terms_condition')->row_array();
$privacy_policy = $this->db->where('domain_id', domain_id_get())->get('privacy_policy')->row_array();
$cancellation_and_refund_policy = $this->db->where('domain_id', domain_id_get())->get('cancellation_and_refund_policy')->row_array();
$important_update = $this->db->where('domain_id', domain_id_get())->get('important_update')->row_array();

// Define dummy data as fallback
$defaultData = [
    'logo' => 'default_logo.png',
    'description' => 'Not found.',
    'mobile_no' => 'Not found',
    'company_gmail' => 'Not found',
    'other_gmail' => 'Not found',
    'ownere_gmail' => 'Not found',
    'company_url' => 'Not found',
    'cin_no' => 'Not found',
    'registered_office' => 'Not found',
    'google' => '',
    'facebook' => '',
    'instagram' => '',
    'twitter' => '',
    'linkedin' => '',
    'pinterest' => '',
    'youtube' => '',
    'company_title' => ''
];
?>

<footer id="footer" class="inverted">
    <div class="footer-content">
        <div class="container">
            <div class="row gap-y">
                <div class="col-md-4 col-sm-12">
                    <img src="<?= base_url('beta/assets/images/logo/' . (isset($contectUs['logo']) && !empty($contectUs['logo']) ? $contectUs['logo'] : $defaultData['logo'])) ?>" alt="<?= isset($contectUs['company_title']) && !empty($contectUs['company_title']) ? $contectUs['company_title'] : $defaultData['company_title'] ?>" class="m-t-20 m-b-30" style="width:<?php echo isset($contectUs['footer_w_logo']) ? $contectUs['footer_w_logo'] : '100'; ?>px;height:<?php echo isset($contectUs['footer_w_logo']) ? $contectUs['footer_w_logo'] : '100'; ?>px;">
                    <p class="m-b-20"><?= isset($contectUs['description']) && !empty($contectUs['description']) ? $contectUs['description'] : $defaultData['description'] ?></p>
                    <p class="p-t-10"><a href="#" target="_blank" class="text-danger" rel="<?= isset($contectUs['company_title']) && !empty($contectUs['company_title']) ? $contectUs['company_title'] : $defaultData['company_title'] ?>"><i class="fa fa-youtube"></i> Learn company information &amp; products</a></p>
                </div>

                <div class="col-md-5 col-sm-12">
                    <h5 class="text-uppercase m-b-15">Useful Links</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="list-inline">
                                <li><a href="<?= base_url('company') ?>"><i class="fa fa-info-circle m-r-5"></i> Company</a></li>
                                <li><a href="<?= base_url('channel-partner-code')?>"><i class="fa fa-user m-r-5"></i> DSA</a></li>
                                <li><a href="https://emicalculator.net/" target="_blank"><i class="fa fa-calculator m-r-5"></i> Loan EMI Calculator</a></li>
                               <?php if (!empty($important_update)) { ?>  <li><a href="<?= base_url('important-update') ?>"><i class="fa fa-exclamation-triangle m-r-5"></i> Important Update</a></li><?php }?>
                                <li><a href="<?= base_url('contact') ?>"><i class="fa fa-map m-r-5"></i> Contact Us</a></li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="list-inline">
                                <li><a href="<?= base_url('customer') ?>"><i class="fa fa-lock m-r-5"></i> Customer Login</a></li>
                                <li><a href="<?= base_url('beta/desk-login') ?>"><i class="fa fa-lock m-r-5"></i> DSA Login</a></li>
                                 <?php if (!empty($privacy_policy)) { ?><li><a href="<?= base_url('privacy-policy') ?>"><i class="fa fa-shield m-r-5"></i> Privacy Policy</a></li><?php }?>
                                 <?php if (!empty($cancellation_and_refund_policy)) { ?> <li><a href="<?= base_url('refund-policy') ?>"><i class="fa fa-shield m-r-5"></i> Cancellation &amp; Refund Policy</a></li><?php }?>
                                <?php if (!empty($disclaimer)) { ?><li><a href="<?= base_url('disclaimer') ?>"><i class="fa fa-shield m-r-5"></i> Disclaimer</a></li> <?php }?>
                                 <?php if (!empty($terms_condition)) { ?><li><a href="<?= base_url('terms-conditions') ?>"><i class="fa fa-shield m-r-5"></i> Terms &amp; Conditions</a></li><?php }?>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-12">
                    <h5 class="text-uppercase m-b-15">Contact Us</h5>
                    <div>
                        <p><a href="tel:+91-<?= isset($contectUs['mobile_no']) && !empty($contectUs['mobile_no']) ? $contectUs['mobile_no'] : $defaultData['mobile_no'] ?>"><i class="fa fa-phone m-r-5"></i> +91-<?= isset($contectUs['mobile_no']) && !empty($contectUs['mobile_no']) ? $contectUs['mobile_no'] : $defaultData['mobile_no'] ?></a></p>
                        <p><a href="mailto:<?= isset($contectUs['company_gmail']) && !empty($contectUs['company_gmail']) ? $contectUs['company_gmail'] : $defaultData['company_gmail'] ?>"><i class="fa fa-envelope m-r-5"></i> <?= isset($contectUs['company_gmail']) && !empty($contectUs['company_gmail']) ? $contectUs['company_gmail'] : $defaultData['company_gmail'] ?></a></p>
                        <p><a href="mailto:<?= isset($contectUs['other_gmail']) && !empty($contectUs['other_gmail']) ? $contectUs['other_gmail'] : $defaultData['other_gmail'] ?>"><i class="fa fa-envelope m-r-5"></i> <?= isset($contectUs['other_gmail']) && !empty($contectUs['other_gmail']) ? $contectUs['other_gmail'] : $defaultData['other_gmail'] ?></a></p>
                        <p><a href="mailto:<?= isset($contectUs['ownere_gmail']) && !empty($contectUs['ownere_gmail']) ? $contectUs['ownere_gmail'] : $defaultData['ownere_gmail'] ?>"><i class="fa fa-envelope m-r-5"></i> <?= isset($contectUs['ownere_gmail']) && !empty($contectUs['ownere_gmail']) ? $contectUs['ownere_gmail'] : $defaultData['ownere_gmail'] ?></a></p>
                        <p><a href="<?= isset($contectUs['company_url']) && !empty($contectUs['company_url']) ? $contectUs['company_url'] : $defaultData['company_url'] ?>"><i class="fa fa-map-marker m-r-5"></i> <?= isset($contectUs['company_url']) && !empty($contectUs['company_url']) ? $contectUs['company_url'] : $defaultData['company_url'] ?></a></p>
                        <p><i class="fa fa-gavel m-r-5"></i> CIN No.: <?= isset($contectUs['cin_no']) && !empty($contectUs['cin_no']) ? $contectUs['cin_no'] : $defaultData['cin_no'] ?></p>
                        <p><i class="fa fa-map-marker m-r-5"></i> Registered Office: <br><?= isset($contectUs['registered_office']) && !empty($contectUs['registered_office']) ? $contectUs['registered_office'] : $defaultData['registered_office'] ?></p>
                    </div>
                    <div class="social-icons social-icons-colored social-icons-rounded float-left">
                        <?php
                            $socials = [
                                'google'    => 'fa-google',
                                'facebook'  => 'fa-facebook',
                                'instagram' => 'fa-instagram',
                                'twitter'   => 'fa-twitter',
                                'linkedin'  => 'fa-linkedin',
                                'pinterest' => 'fa-pinterest',
                                'youtube'   => 'fa-youtube',
                            ];

                            foreach ($socials as $key => $icon) {
                                $url = !empty($contectUs[$key]) ? $contectUs[$key] : (!empty($defaultData[$key]) ? $defaultData[$key] : '');
                                if (!empty($url)) { ?>
                                    <li class="social-<?= $key ?>">
                                        <a href="<?= $url ?>" target="_blank"
                                        rel="<?= !empty($contectUs['company_title']) ? $contectUs['company_title'] : $defaultData['company_title'] ?>">
                                            <i class="fa <?= $icon ?>"></i>
                                        </a>
                                    </li>
                            <?php }
                            } ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="copyright-content background-bright-grey">
        <div class="container">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="copyright-text text-light"><?= isset($contectUs['copyright']) && !empty($contectUs['copyright']) ? $contectUs['copyright'] : '' ?></div>
                </div>
                <div class="col-lg-4 text-right">
                    <p class="text-light m-b-0 small">Secure Payment Modes:</p>
                    <img src="<?= base_url('beta/assets/images/logo/' . (isset($contectUs['payment_images']) && !empty($contectUs['payment_images']) ? $contectUs['payment_images'] : '')) ?>" alt="Payment method" style="width:50px;" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="<?= base_url('upload/assets') ?>/js/jquery.js"></script>
<script src="<?= base_url('upload/assets') ?>/js/plugins.js"></script>
<script src="<?= base_url('upload/assets') ?>/js/functions.js"></script>
</body>
</html>