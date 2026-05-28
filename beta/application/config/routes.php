<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'Page';
$route['404_override'] = '';
$route['translate_uri_dashes'] = false;

/**********************************
ADMIN ROUTE
 ***********************************/

$route['desk-login'] = 'admin/Login';
$route['desk-login/(:any)'] = 'admin/Login/index/$1';
$route['api/login'] = 'admin/Login/sso_login';

// IndiaSales Login
$route['admin/indiasales-login'] = 'admin/IndiaSales/login';
$route['admin/IndiaSales/login'] = 'admin/IndiaSales/login';
$route['admin/instanloankyc'] = 'admin/Dashboard/instanloankyc';
$route['admin/addInstanLoan'] = 'admin/Dashboard/addInstanLoan';
$route['admin/deleteInstanloan/(:num)'] = 'admin/Dashboard/deleteInstanloan/$1';

$route['admin-dashboard'] = 'admin/Dashboard';
$route['admin/reject'] = 'admin/Dashboard/reject';
$route['admin/myleads'] = 'admin/Dashboard/myleads';
$route['admin/disbursement'] = 'admin/Dashboard/disbursement';
$route['admin/payout'] = 'admin/Dashboard/payout';
$route['admin/approved'] = 'admin/Dashboard/approved';
$route['admin/loan_lead'] = 'admin/Dashboard/loan_lead_mange';
$route['admin/referral_data'] = 'admin/Dashboard/referral_data';
$route['admin/instantKyc'] = 'admin/Dashboard/instantKyc';

$route['admin/agent-password'] = 'admin/Login/forgot_password';
$route['admin/agent-password/(:any)'] = 'admin/Login/forgot_password/$1';

$route['admin/register-user'] = 'admin/Dashboard/registerUser';
$route['admin/edit-user/(:num)'] = 'admin/Dashboard/editUser/$1';
$route['admin/edit-detail/(:num)'] = 'admin/Dashboard/editDetail/$1';
$route['admin/view-user/(:num)'] = 'admin/Dashboard/viewUser/$1';
$route['admin/update-user'] = 'admin/Dashboard/updateUser';
$route['admin/update-detail'] = 'admin/Dashboard/updateDetail';
$route['admin/delete-user'] = 'admin/Dashboard/deleteUser';

$route['admin/status-user'] = 'admin/Dashboard/statusUser';
$route['admin/status-agent'] = 'admin/Dashboard/statusAgent';

$route['admin/channel-partner'] = 'admin/Dashboard/channelPartnerUser';
$route['admin/edit-partner/(:num)'] = 'admin/Dashboard/editChannelPartner/$1';
$route['admin/update-partner'] = 'admin/Dashboard/updateChannelPartner';
$route['admin/delete-partner'] = 'admin/Dashboard/deletePartner';
$route['admin/dsa-user/(:num)'] = 'admin/Dashboard/dsadetailUser/$1';
$route['admin/branch-user/(:num)'] = 'admin/Dashboard/branchdetailUser/$1';
$route['admin/deleteBranchAgentImage'] = 'admin/Dashboard/deleteBranchAgentImage';
$route['admin/deleteDsaAgentImage'] = 'admin/Dashboard/deleteDsaAgentImage';

$route['admin/branch-franchise'] = 'admin/Dashboard/branchfranchiseUser';
$route['admin/edit-branch-franchise/(:num)'] = 'admin/Dashboard/editbranchfranchise/$1';
$route['admin/update-branch'] = 'admin/Dashboard/updatebranch';
$route['admin/delete-branch'] = 'admin/Dashboard/deletebranch';

$route['admin/status-agents'] = 'admin/Dashboard/statusAgentss';

$route['admin/bank-criteria'] = 'admin/Dashboard/bankCriteria';
$route['admin/bank-criteria-update'] = 'admin/Dashboard/bankCriteriaUpdate';

$route['admin/add-lead'] = 'admin/Dashboard/addLead';
$route['admin/edit-lead/(:num)'] = 'admin/Dashboard/editLead/$1';
$route['admin/create-lead'] = 'admin/Dashboard/createLead';
$route['admin/leads'] = 'admin/Dashboard/leads';
$route['admin/leads-thanks'] = 'admin/Dashboard/leadsthanks';
$route['admin/leads-ajax'] = 'admin/Dashboard/leadsAjax';
$route['admin/get-leads-data-ajax'] = 'admin/Dashboard/getLeadsDataAjax';
$route['admin/update-lead'] = 'admin/Dashboard/updateLead';

$route['admin/lead-transfer'] = 'admin/Dashboard/leadTransfer';

$route['admin/my-business'] = 'admin/Dashboard/myBusiness';
$route['admin/get-business-data'] = 'admin/Dashboard/getBusinessData';
$route['admin/get-leads-data'] = 'admin/Dashboard/getLeadsData';

$route['admin/my-applications'] = 'admin/Dashboard/myApplications';
$route['admin/get-application-data'] = 'admin/Dashboard/getApplicationData';

$route['admin/get-agent-city'] = 'admin/Dashboard/getAgentCityData';
$route['admin/get-user-city'] = 'admin/Dashboard/getUserCityData';

$route['admin/bankwise-eligibility'] = 'admin/Dashboard/bankwiseEligibility';
$route['admin/bankwise-pdfs'] = 'admin/Dashboard/bankwisePDFs';
$route['admin/bankwise-pdfs-add'] = 'admin/Dashboard/bankwisePDFsAdd';
// $route['admin/bankiwse-pdfs-store']                 = 'admin/Dashboard/bankwisePDFsStore';

$route['admin/my-network'] = 'admin/Dashboard/myNetwork';
$route['admin/get-customer-data'] = 'admin/Dashboard/getNetworkData';
$route['admin/get-my-network'] = 'admin/Dashboard/getMyNetworkList';

// For Team

$route['admin/my-team'] = 'admin/Dashboard/myTeam';
$route['admin/admin-team'] = 'admin/Dashboard/adminTeam';
$route['admin/add-member'] = 'admin/Dashboard/addTeamMember';
$route['admin/send-otp'] = 'admin/Dashboard/sendotp';
// $route['admin/edit-lead/(:num)']     = 'admin/Dashboard/editLead/$1';
$route['admin/create-member'] = 'admin/Dashboard/createTeamMember';
// $route['admin/leads']                = 'admin/Dashboard/leads';
// $route['admin/update-lead']          = 'admin/Dashboard/updateLead';

// For Network

$route['admin/add-network-member'] = 'admin/Dashboard/addNetworkMember';
$route['admin/send-network-otp'] = 'admin/Dashboard/sendNetworkOtp';
$route['admin/create-network-member'] = 'admin/Dashboard/createNetworkMember';
$route['admin/network-member-plan'] = 'admin/Dashboard/networkMemberOffer';
$route['admin/network-member-payment'] = 'admin/Dashboard/networkMemberPayment';
$route['admin/payment-respone'] = 'admin/Dashboard/paymentResponse';
// Banker

$route['admin/banker'] = 'admin/Dashboard/banker';
$route['admin/banker-excel-import'] = 'admin/Dashboard/bankerExcelImport';
$route['admin/banker-add'] = 'admin/Dashboard/banker_add';
$route['admin/banker-create'] = 'admin/Dashboard/banker_create';
$route['admin/banker_edit/(:any)'] = 'admin/Dashboard/banker_edit/$1';
$route['admin/banker-update'] = 'admin/Dashboard/banker_update';

// Loan master
$route['admin/loan'] = 'admin/Dashboard/loan';
$route['admin/loanasign'] = 'admin/Dashboard/loanasign';
$route['admin/loan-add'] = 'admin/Dashboard/loan_add';
$route['admin/loan-view/(:num)'] = 'admin/Dashboard/loan_view/$1';
$route['admin/loan-edit/(:num)'] = 'admin/Dashboard/loan_edit/$1';


//Banker Master
$route['admin/banker-master'] = 'admin/Dashboard/bankermaster';
$route['admin/bankmaster-create'] = 'admin/Dashboard/bankmaster_create';
$route['admin/bankmaster-add'] = 'admin/Dashboard/bankmaster_add';
$route['admin/bankmaster-edit/(:any)'] = 'admin/Dashboard/bankmaster_edit/$1';
$route['admin/bankmaster-update'] = 'admin/Dashboard/bankermaster_update';
//Sub Admin Master
$route['admin/sub-admin'] = 'admin/Dashboard/subAdmin';
$route['admin/sub-admin-create'] = 'admin/Dashboard/subAdminCreate';
$route['admin/sub-admin-add'] = 'admin/Dashboard/subAdminAdd';
$route['admin/sub-admin-edit/(:any)'] = 'admin/Dashboard/subAdminEdit/$1';
$route['admin/sub-admin-update'] = 'admin/Dashboard/subAdminUpdate';
$route['admin/sub-admin-del/(:any)'] = 'admin/Dashboard/subAdminDel/$1';

//Terms Conditions
$route['admin/terms_condition'] = 'admin/Dashboard/termsCondition';
$route['admin/terms_condition-update'] = 'admin/Dashboard/termsConditionUpdate';

//Disclaimer
$route['admin/disclaimer'] = 'admin/Dashboard/disclaimer';
$route['admin/disclaimer-update'] = 'admin/Dashboard/DisclaimerUpdate';

//important_update
$route['admin/important_update'] = 'admin/Dashboard/important_update';
$route['admin/important_update-update'] = 'admin/Dashboard/important_updateUpdate';

//qr
$route['admin/qr'] = 'admin/Dashboard/qr';
$route['admin/qr-update'] = 'admin/Dashboard/qrUpdate';

//smtp
$route['admin/smtp'] = 'admin/Dashboard/smtp';
$route['admin/email-config-update'] = 'admin/Dashboard/smtpUpdate';

//cancellation_and_refund_policy
$route['admin/cancellation_and_refund_policy'] = 'admin/Dashboard/cancellationAndRefundPolicy';
$route['admin/cancellation-and-refund-policy-update'] = 'admin/Dashboard/cancellationAndRefundPolicyUpdate';


//Privacy Policy
$route['admin/privacy-policy'] = 'admin/Dashboard/privacyPolicy';
$route['admin/privacy-policy-update'] = 'admin/Dashboard/privacyPolicyUpdate';

//Company Profile
$route['admin/company-profile'] = 'admin/Dashboard/companyProfile';
$route['admin/company-profile-update'] = 'admin/Dashboard/companyProfileUpdate';

//Our Story
$route['admin/our-story'] = 'admin/Dashboard/ourStory';
$route['admin/our-story-create'] = 'admin/Dashboard/ourStoryCreate';
$route['admin/our-story-add'] = 'admin/Dashboard/ourStoryAdd';
$route['admin/our-storyn-edit/(:any)'] = 'admin/Dashboard/ourStoryEdit/$1';
$route['admin/our-story-update'] = 'admin/Dashboard/ourStoryUpdate';
$route['admin/our-story-del/(:any)'] = 'admin/Dashboard/ourStoryDel/$1';

//Smartest Choice
$route['admin/smart-choice'] = 'admin/Dashboard/smartChoice';
$route['admin/smart-choice-create'] = 'admin/Dashboard/smartChoiceCreate';
$route['admin/smart-choice-add'] = 'admin/Dashboard/smartChoiceAdd';
$route['admin/smart-choice-edit/(:any)'] = 'admin/Dashboard/smartChoiceEdit/$1';
$route['admin/smart-choice-update'] = 'admin/Dashboard/smartChoiceUpdate';
$route['admin/smart-choice-del/(:any)'] = 'admin/Dashboard/smartChoiceDel/$1';

//Media Coverage
$route['admin/media-coverage'] = 'admin/Dashboard/mediaCoverage';
$route['admin/media-coverage-create'] = 'admin/Dashboard/mediaCoverageCreate';
$route['admin/media-coverage-add'] = 'admin/Dashboard/mediaCoverageAdd';
$route['admin/media-coverage-edit/(:any)'] = 'admin/Dashboard/mediaCoverageEdit/$1';
$route['admin/media-coverage-update'] = 'admin/Dashboard/mediaCoverageUpdate';
$route['admin/media-coverage-del/(:any)'] = 'admin/Dashboard/mediaCoverageDel/$1';

//Contect Us
$route['admin/contect-us'] = 'admin/Dashboard/contectUs';
$route['admin/contect-us-update'] = 'admin/Dashboard/contectUsUpdate';


//DSA Banner
$route['admin/dsa-banner'] = 'admin/Dashboard/dsaBanner';
$route['admin/dsa-banner-update'] = 'admin/Dashboard/dsaBannerUpdate';

//DSA Section 1
$route['admin/dsa-section-1'] = 'admin/Dashboard/dsaSection1';
$route['admin/dsa-section-1-update'] = 'admin/Dashboard/dsaSection1Update';

//DSA Section 2
$route['admin/dsa-section-2'] = 'admin/Dashboard/dsaSection2';
$route['admin/dsa-section-2-update'] = 'admin/Dashboard/dsaSection2Update';

//DSA Section 3
$route['admin/dsa-section-3'] = 'admin/Dashboard/dsaSection3';
$route['admin/dsa-section-3-update'] = 'admin/Dashboard/dsaSection3Update';

//Branch Banner
$route['admin/branch-banner'] = 'admin/Dashboard/branchBanner';
$route['admin/branch-banner-update'] = 'admin/Dashboard/branchBannerUpdate';

//dsa agent detail
$route['admin/dsaagentdetail'] = 'admin/Dashboard/dsaagentdetail';
$route['admin/dsaagentdetail-update'] = 'admin/Dashboard/dsaagentdetailUpdate';

//dsa agent detail
$route['admin/branchAgentDetail'] = 'admin/Dashboard/branchAgentDetail';
$route['admin/branchAgentDetail-update'] = 'admin/Dashboard/branchAgentDetailUpdate';

//Silver Banner
$route['admin/silver-banner'] = 'admin/Dashboard/silverBanner';
$route['admin/silver-banner-update'] = 'admin/Dashboard/silverBannerUpdate';

//Silver Section 1
$route['admin/silver-section-1'] = 'admin/Dashboard/silverSection1';
$route['admin/silver-section-1-update'] = 'admin/Dashboard/silverSection1Update';

//Silver Section 2
$route['admin/silver-section-2'] = 'admin/Dashboard/silverSection2';
$route['admin/silver-section-2-update'] = 'admin/Dashboard/silverSection2Update';

//Silver Section 3
$route['admin/silver-section-3'] = 'admin/Dashboard/silverSection3';
$route['admin/silver-section-3-create'] = 'admin/Dashboard/silverSection3Create';
$route['admin/silver-section-3-add'] = 'admin/Dashboard/silverSection3Add';
$route['admin/silver-section-3-edit/(:any)'] = 'admin/Dashboard/silverSection3Edit/$1';
$route['admin/silver-section-3-update'] = 'admin/Dashboard/silverSection3Update';
$route['admin/silver-section-3-del/(:any)'] = 'admin/Dashboard/silverSection3Del/$1';

//Silver Section 4
$route['admin/silver-section-4'] = 'admin/Dashboard/silverSection4';
$route['admin/silver-section-4-create'] = 'admin/Dashboard/silverSection4Create';
$route['admin/silver-section-4-add'] = 'admin/Dashboard/silverSection4Add';
$route['admin/silver-section-4-edit/(:any)'] = 'admin/Dashboard/silverSection4Edit/$1';
$route['admin/silver-section-4-update'] = 'admin/Dashboard/silverSection4Update';
$route['admin/silver-section-4-del/(:any)'] = 'admin/Dashboard/silverSection4Del/$1';


//Plantinum Banner
$route['admin/plantinum-banner'] = 'admin/Dashboard/plantinumBanner';
$route['admin/plantinum-banner-update'] = 'admin/Dashboard/plantinumBannerUpdate';

//Plantinum Section 1
$route['admin/plantinum-section-1'] = 'admin/Dashboard/plantinumSection1';
$route['admin/plantinum-section-1-update'] = 'admin/Dashboard/plantinumSection1Update';

//Plantinum Section 2
$route['admin/plantinum-section-2'] = 'admin/Dashboard/plantinumSection2';
$route['admin/plantinum-section-2-update'] = 'admin/Dashboard/plantinumSection2Update';

//Plantinum Section 3
$route['admin/plantinum-section-3'] = 'admin/Dashboard/plantinumSection3';
$route['admin/plantinum-section-3-create'] = 'admin/Dashboard/plantinumSection3Create';
$route['admin/plantinum-section-3-add'] = 'admin/Dashboard/plantinumSection3Add';
$route['admin/plantinum-section-3-edit/(:any)'] = 'admin/Dashboard/plantinumSection3Edit/$1';
$route['admin/plantinum-section-3-update'] = 'admin/Dashboard/plantinumSection3Update';
$route['admin/plantinum-section-3-del/(:any)'] = 'admin/Dashboard/plantinumSection3Del/$1';

//Plantinum Section 4
$route['admin/plantinum-section-4'] = 'admin/Dashboard/plantinumSection4';
$route['admin/plantinum-section-4-create'] = 'admin/Dashboard/plantinumSection4Create';
$route['admin/plantinum-section-4-add'] = 'admin/Dashboard/plantinumSection4Add';
$route['admin/plantinum-section-4-edit/(:any)'] = 'admin/Dashboard/plantinumSection4Edit/$1';
$route['admin/plantinum-section-4-update'] = 'admin/Dashboard/plantinumSection4Update';
$route['admin/plantinum-section-4-del/(:any)'] = 'admin/Dashboard/plantinumSection4Del/$1';


//Buy Now Banner
$route['admin/buynow-banner'] = 'admin/Dashboard/buynowBanner';
$route['admin/buynow-banner-update'] = 'admin/Dashboard/buynowBannerUpdate';


//Buy Now Section
$route['admin/buynow-section'] = 'admin/Dashboard/buynowSection';
$route['admin/buynow-section-update'] = 'admin/Dashboard/buynowSectionUpdate';

//Buy Now Section 1
$route['admin/buynow-section-1'] = 'admin/Dashboard/buynowSection1';
$route['admin/buynow-section-1-update'] = 'admin/Dashboard/buynowSection1Update';

//Buy Now Section 2
$route['admin/buynow-section-2'] = 'admin/Dashboard/buynowSection2';
$route['admin/buynow-section-2-update'] = 'admin/Dashboard/buynowSection2Update';

//Buy Now Slider
$route['admin/banner-slider'] = 'admin/Dashboard/bannerSlider';
$route['admin/banner-slider-create'] = 'admin/Dashboard/bannerSliderCreate';
$route['admin/banner-slider-add'] = 'admin/Dashboard/bannerSliderAdd';
$route['admin/banner-slider-edit/(:any)'] = 'admin/Dashboard/bannerSliderEdit/$1';
$route['admin/banner-slider-update'] = 'admin/Dashboard/bannerSliderUpdate';
$route['admin/banner-slider-del/(:any)'] = 'admin/Dashboard/bannerSliderDel/$1';


//Blog Section
$route['admin/blog-section'] = 'admin/Dashboard/blogSection';
$route['admin/blog-section-update'] = 'admin/Dashboard/blogSectionUpdate';


//Document Section
$route['admin/document-section'] = 'admin/Dashboard/documentSection';
$route['admin/document-section-update'] = 'admin/Dashboard/documentSectionUpdate';

//Branch Document Section
$route['admin/certificate'] = 'admin/Dashboard/joiningCertificate';
$route['admin/certificate-update'] = 'admin/Dashboard/joiningCertificateUpdate';

$route['admin/visiting-card'] = 'admin/Dashboard/visitingCard';
$route['admin/visiting-card-update'] = 'admin/Dashboard/visitingCardUpdate';

$route['admin/id-card'] = 'admin/Dashboard/idCard';
$route['admin/id-card-update'] = 'admin/Dashboard/idCardUpdate';

$route['admin/joining-letter-section'] = 'admin/Dashboard/joiningLetter';
$route['admin/joining-letter-update'] = 'admin/Dashboard/joiningLetterUpdate';

$route['admin/joining-banner'] = 'admin/Dashboard/joiningBanner';
$route['admin/joining-banner-update'] = 'admin/Dashboard/joiningBannerUpdate';

//Color Section
$route['admin/admin-color'] = 'admin/Dashboard/adminColor';
$route['admin/admin-color-update'] = 'admin/Dashboard/adminColorUpdate';

$route['admin/card-color'] = 'admin/Dashboard/cardColor';
$route['admin/card-color-update'] = 'admin/Dashboard/cardColorUpdate';


// Loan type master
$route['admin/loan-type-master'] = 'admin/Dashboard/loan_type_master';
$route['admin/loan-type-master-add'] = 'admin/Dashboard/loantype_master_add';
$route['admin/loan-type-master-edit/(:any)'] = 'admin/Dashboard/loan_type_master_edit/$1';
$route['admin/loan-type-master-create'] = 'admin/Dashboard/loan_type_master_create';
$route['admin/loan-type-master-update'] = 'admin/Dashboard/loan_type_master_update';
// personal loan type master
$route['admin/home-loan'] = 'admin/Dashboard/home_loan';
$route['admin/home-insert'] = 'admin/Dashboard/home_loan_insert';
$route['admin/teamList'] = 'admin/Dashboard/teamList';
$route['admin/businessView/(:any)'] = 'admin/Dashboard/businessView/$1';
$route['admin/creditCardView/(:any)'] = 'admin/Dashboard/creditCardView/$1';
$route['admin/creditCardUpdate/(:any)'] = 'admin/Dashboard/creditCardUpdate/$1';
$route['admin/businessUpdate/(:any)'] = 'admin/Dashboard/businessUpdate/$1';
$route['admin/homeloanUpdate/(:any)'] = 'admin/Dashboard/homeloanUpdate/$1';

$route['admin/my-wallet'] = 'admin/Dashboard/myWallet';
$route['admin/my-payout-slabs'] = 'admin/Dashboard/myPayoutSlabs';
$route['admin/my-payout-add'] = 'admin/Dashboard/Payoutcreate';
$route['admin/my-payout-createdata'] = 'admin/Dashboard/Payoutcreatedd';
$route['admin/user-profile'] = 'admin/Dashboard/userProfile';

// Payout Slab CRUD
$route['admin/payoutslab'] = 'admin/Dashboard/payoutslab';
$route['admin/payoutslab-add'] = 'admin/Dashboard/payoutslab_add';
$route['admin/payoutslab-create'] = 'admin/Dashboard/payoutslab_create';
$route['admin/payoutslab-edit/(:num)'] = 'admin/Dashboard/payoutslab_edit/$1';
$route['admin/payoutslab-update'] = 'admin/Dashboard/payoutslab_update';
$route['admin/payoutslab-delete/(:num)'] = 'admin/Dashboard/payoutslab_delete/$1';
$route['admin/payout-slab-import'] = 'admin/Dashboard/payoutslabImport';
$route['admin/payoutslab-bulk-delete'] = 'admin/Dashboard/payoutslabBulkDelete';

$route['admin/payoutslab-secure-bulk-delete'] = 'admin/Dashboard/payoutslasecurebBulkDelete';
$route['admin/payoutslabsecure'] = 'admin/Dashboard/payoutslabsecure';
$route['admin/payoutslabsecure-add'] = 'admin/Dashboard/payoutslabsecure_add';
$route['admin/payoutslabsecure-create'] = 'admin/Dashboard/payoutslabsecure_create';
$route['admin/payoutslabsecure-edit/(:num)'] = 'admin/Dashboard/payoutslabsecure_edit/$1';
$route['admin/payoutslabsecure-update'] = 'admin/Dashboard/payoutslabsecure_update';
$route['admin/payoutslabsecure-delete/(:num)'] = 'admin/Dashboard/payoutslabsecure_delete/$1';
$route['admin/payout-slab-secure-import'] = 'admin/Dashboard/payoutslabsecureImport';

$route['admin/codebook'] = 'admin/Dashboard/codebook';
$route['admin/codebook-add'] = 'admin/Dashboard/codebook_add';
$route['admin/codebook-create'] = 'admin/Dashboard/codebook_create';
$route['admin/codebook-edit/(:num)'] = 'admin/Dashboard/codebook_edit/$1';
$route['admin/codebook-update'] = 'admin/Dashboard/codebook_update';
$route['admin/codebook-delete/(:num)'] = 'admin/Dashboard/codebook_delete/$1';
$route['admin/codebook-import'] = 'admin/Dashboard/codebookImport';
$route['admin/codebook-bulk-delete'] = 'admin/Dashboard/codebookBulkDelete';

$route['admin/change-plan'] = 'admin/Dashboard/changePlan';


$route['admin/change-password'] = 'admin/Dashboard/changePassword';
$route['admin/agreement'] = 'admin/Dashboard/agreement';
$route['admin/agreement/(:num)/(:num)'] = 'admin/Dashboard/agreement/$1/$2';
$route['admin/process-agreement'] = 'admin/Home/processAgreement';
$route['admin/approve-agreement/(:num)/(:num)'] = 'admin/Dashboard/approveAgreement/$1/$2';
$route['admin/update-agreement-status'] = 'admin/Dashboard/update_agreement_status';

$route['admin/save-change-password'] = 'admin/Dashboard/saveChangePassword';


$route['admin/skip-change-password'] = 'admin/Dashboard/skipChangePassword';


$route['admin/payment-link'] = 'admin/Dashboard/paymentLink';

$route['admin/video'] = 'admin/Dashboard/video';
$route['admin/videoAdd'] = 'admin/Dashboard/videoAdd';
$route['admin/videoEdit'] = 'admin/Dashboard/videoEdit';
$route['admin/pdfdelete'] = 'admin/Dashboard/pdfdelete';
$route['admin/videodelete/(:num)'] = 'admin/Dashboard/videodelete/$1';

$route['admin/document'] = 'admin/Dashboard/certificate';
$route['admin/document_doc'] = 'admin/Dashboard/certificate_doc';
$route['admin/visiting'] = 'admin/Dashboard/visiting';
$route['admin/id_card'] = 'admin/Dashboard/id_card';
$route['admin/banner'] = 'admin/Dashboard/banner';
$route['admin/joining-letter'] = 'admin/Dashboard/joining_letter';

$route['admin/cartificate-genrate'] = 'admin/Dashboard/cartificate_genrate';
$route['admin/id-genrate'] = 'admin/Dashboard/id_genrate';
$route['admin/vising-card-genrate'] = 'admin/Dashboard/visit_genrate';
$route['admin/banner-genrate'] = 'admin/Dashboard/banner_genrate';
$route['admin/joining-letter-genrate'] = 'admin/Dashboard/joining_letter_genrate';
$route['admin/payoutedit/(:num)'] = 'admin/Dashboard/payoutedit/$1';
$route['admin/update-slots'] = 'admin/Dashboard/updateslots';
$route['admin/credit'] = 'admin/Dashboard/creditCard';
// bussion loan route
$route['admin/businessloan'] = 'admin/Dashboard/businessloan';
$route['admin/businessloan-insert'] = 'admin/Dashboard/businessloan_insert';

$route['admin/loan-company-master-form'] = 'admin/Dashboard/loan_company_master_form';
$route['admin/add-loan-company-master'] = 'admin/Dashboard/add_loan_company_master';
$route['admin/loan-company-master'] = 'admin/Dashboard/loan_company_master_list';
$route['admin/loan-company-master-edit/(:any)'] = 'admin/Dashboard/loan_company_master_edit/$1';
$route['admin/loan-company-master-update'] = 'admin/Dashboard/loan_company_master_update';
$route['admin/loan-company-master-delete/(:num)'] = 'admin/Dashboard/loan_company_master_delete/$1';

$route['web_pages/share/cpsess1101506595/(:num)'] = 'admin/Home/sharePage/$1';
$route['web_pages/sharePagebusiness/cpsess1101506595/(:num)'] = 'admin/Home/sharePagebusiness/$1';
$route['web_pages/sharePagehome/cpsess1101506595/(:num)'] = 'admin/Home/sharePagehome/$1';
$route['web_pages/sharePagecredit/cpsess1101506595/(:num)'] = 'admin/Home/sharePagecredit/$1';

$route['admin/loan-lead-list'] = 'admin/Dashboard/loan_lead_list';
$route['admin/loan-type-list/(:any)'] = 'admin/Dashboard/loan_type_list/$1';
$route['admin/loan-lead-create'] = 'admin/Dashboard/loan_lead_create';
$route['admin/loan-lead-edit/(:any)'] = 'admin/Dashboard/loan_lead_edit/$1';


$route['admin/transaction'] = 'admin/Transaction/transaction';



// $route['admin/document']                = 'admin/Dashboard/id_card';

// $route['category'] = 'admin/Dashboard/category';
// $route['add-category'] = 'admin/Dashboard/categoryForm';
// $route['edit-category/(:num)'] = 'admin/Dashboard/categoryEdit/$1';
// $route['update-category'] = 'admin/Dashboard/categoryUpdate';
// $route['delete-category/(:num)'] = 'admin/Dashboard/categoryDelete/$1';
// $route['update_category_status'] = 'admin/Dashboard/categoryStatusUpdate';

// $route['subcategory'] = 'admin/Dashboard/subcategory';
// $route['add-subcategory'] = 'admin/Dashboard/subcategoryForm';
// $route['edit-subcategory/(:num)'] = 'admin/Dashboard/subcategoryEdit/$1';
// $route['update-subcategory'] = 'admin/Dashboard/subcategoryUpdate';
// $route['delete-subcategory/(:num)'] = 'admin/Dashboard/subcategoryDelete/$1';
// $route['update_subcategory_status'] = 'admin/Dashboard/subcategoryStatusUpdate';

// $route['admin/child-subcategory'] = 'admin/Dashboard/childSubcategory';
// $route['admin/add-child-subcategory'] = 'admin/Dashboard/childSubcategoryForm';
// $route['admin/edit-child-subcategory/(:num)'] = 'admin/Dashboard/childSubcategoryEdit/$1';
// $route['admin/update-child-subcategory'] = 'admin/Dashboard/childSubcategoryUpdate';
// $route['delete-child-subcategory/(:num)'] = 'admin/Dashboard/childSubcategoryDelete/$1';
// $route['update_child_subcategory_status'] = 'admin/Dashboard/childSubcategoryStatusUpdate';

$route['admin/add-slider'] = 'admin/Slider/sliderForm';
$route['admin/slider'] = 'admin/Slider/slider';
$route['admin/edit-slider/(:num)'] = 'admin/Slider/sliderEdit/$1';
$route['admin/update-slider'] = 'admin/Slider/sliderUpdate';
$route['admin/delete-slider/(:num)'] = 'admin/Slider/sliderDelete/$1';
$route['admin/update_slider_status'] = 'admin/Slider/sliderStatusUpdate';

$route['admin/add-edge'] = 'admin/Slider/edgeForm';
$route['admin/edge'] = 'admin/Slider/edge';
$route['admin/edit-edge/(:num)'] = 'admin/Slider/edgeEdit/$1';
$route['admin/update-edge'] = 'admin/Slider/edgeUpdate';
$route['admin/delete-edge/(:num)'] = 'admin/Slider/edgeDelete/$1';
$route['admin/update_edge_status'] = 'admin/Slider/edgeStatusUpdate';

$route['admin/add-partner-slider'] = 'admin/Slider/partner_sliderForm';
$route['admin/partner_slider'] = 'admin/Slider/partner_slider';
$route['admin/edit-partner-slider/(:num)'] = 'admin/Slider/partner_sliderEdit/$1';
$route['admin/update-partner-slider'] = 'admin/Slider/partner_sliderUpdate';
$route['admin/delete-partner-slider/(:num)'] = 'admin/Slider/partner_sliderDelete/$1';
$route['admin/update_partner-slider'] = 'admin/Slider/partner_sliderUpdate';

$route['admin/add-lead-transfer'] = 'admin/Dashboard/lead_transferForm';
$route['admin/lead_transfer'] = 'admin/Dashboard/lead_transfer';
$route['admin/edit-lead-transfer/(:num)'] = 'admin/Dashboard/lead_transferEdit/$1';
$route['admin/update-lead-transfer'] = 'admin/Dashboard/lead_transferUpdate';
$route['admin/delete-lead-transfer/(:num)'] = 'admin/Dashboard/lead_transferDelete/$1';
$route['admin/update-lead-status-transfer'] = 'admin/Dashboard/lead_transferStatusUpdate';

$route['admin/add-categories'] = 'admin/Slider/categoriesForm';
$route['admin/categories'] = 'admin/Slider/categories';
$route['admin/edit-categories/(:num)'] = 'admin/Slider/categoriesEdit/$1';
$route['admin/update-categories'] = 'admin/Slider/categoriesUpdate';
$route['admin/delete-categories/(:num)'] = 'admin/Slider/categoriesDelete/$1';
$route['admin/update_categories_status'] = 'admin/Slider/categoriesStatusUpdate';

$route['admin/add-about_customer'] = 'admin/Slider/about_customerForm';
$route['admin/about_customer'] = 'admin/Slider/about_customer';
$route['admin/edit-about_customer/(:num)'] = 'admin/Slider/about_customerEdit/$1';
$route['admin/update-about_customer'] = 'admin/Slider/about_customerUpdate';
$route['admin/delete-about_customer/(:num)'] = 'admin/Slider/about_customerDelete/$1';
$route['admin/update_about_customer_status'] = 'admin/Slider/about_customerStatusUpdate';

// $route['all-category'] = 'admin/Dashboard/productAll';

// $route['admin/policy'] = 'admin/PolicyTerm/policy';
// $route['admin/add-policy'] = 'admin/PolicyTerm/policyForm';
// $route['admin/edit-policy/(:num)'] = 'admin/PolicyTerm/policyEdit/$1';
// $route['admin/update-policy'] = 'admin/PolicyTerm/policyUpdate';
// $route['admin/delete-policy/(:num)'] = 'admin/PolicyTerm/policyDelete/$1';
// $route['admin/update_policy_status'] = 'admin/PolicyTerm/policyStatusUpdate';

// $route['admin/about-us'] = 'admin/AboutUs/about';
// //$route['admin/add-about-us'] = 'admin/AboutUs/aboutForm';
// $route['admin/edit-about-us/(:num)'] = 'admin/AboutUs/aboutEdit/$1';
// $route['admin/update-about-us'] = 'admin/AboutUs/aboutUpdate';
// //$route['admin/delete-about-us/(:num)'] = 'admin/AboutUs/aboutDelete/$1';
// $route['admin/update_aboutus_status'] = 'admin/AboutUs/aboutStatusUpdate';

$route['admin/site-setting'] = 'admin/SiteSetting/setting';
$route['admin/edit-site-setting/(:num)'] = 'admin/SiteSetting/settingEdit/$1';
$route['admin/update-site-setting'] = 'admin/SiteSetting/settingUpdate';

$route['admin/blog-category'] = 'admin/Blog/blogCategory';
$route['admin/add-blog-category'] = 'admin/Blog/blogCategoryForm';
$route['admin/edit-blog-category/(:num)'] = 'admin/Blog/blogCategoryEdit/$1';
$route['admin/update-blog-category'] = 'admin/Blog/blogCategoryUpdate';
$route['admin/delete-blog-category/(:num)'] = 'admin/Blog/blogCategoryDelete/$1';
$route['admin/update_blog_category_status'] = 'admin/Blog/blogCategoryStatusUpdate';

$route['admin/blog'] = 'admin/Blog/blogs';
$route['admin/add-blog'] = 'admin/Blog/blogsForm';
$route['admin/edit-blog/(:num)'] = 'admin/Blog/blogsEdit/$1';
$route['admin/update-blog'] = 'admin/Blog/blogsUpdate';
$route['admin/delete-blog/(:num)'] = 'admin/Blog/blogsDelete/$1';
$route['admin/update_blogs_status'] = 'admin/Blog/blogsStatusUpdate';

//Roles Master
$route['admin/roles'] = 'admin/Dashboard/roles';
$route['admin/roles-create'] = 'admin/Dashboard/rolesCreate';
$route['admin/roles-add'] = 'admin/Dashboard/rolesAdd';
$route['admin/roles-edit/(:any)'] = 'admin/Dashboard/rolesEdit/$1';
$route['admin/roles-update'] = 'admin/Dashboard/rolesUpdate';
$route['admin/roles-del/(:any)'] = 'admin/Dashboard/rolesDel/$1';

// $route['admin/contact-us'] = 'admin/Dashboard/contactUs';

/**********************************
FRONT ROUTE
 ***********************************/

// $route['']                          = 'page';
// $route['career']                    = 'page/career';
// $route['company']                   = 'page/company';
// $route['services']                  = 'page/services';
// $route['contact']                   = 'page/contact';
// $route['premium-membership-card']   = 'page/premium_membership_card';
// $route['plantinum-membership-card'] = 'page/plantinum_membership_card';
// $route['important-update']          = 'page/important_update';
// $route['terms-conditions']          = 'page/terms_conditions';
// $route['disclaimer']                = 'page/disclaimer';
// $route['refund-policy']             = 'page/refund_policy';
// $route['privacy-policy']            = 'page/privacy_policy';
// $route['faqs']                      = 'page/faqs';

// $route['finmax-plan']               = 'page/finmax_plan';
// $route['channel-partner-code']      = 'page/channel_partner_code';
// $route['personal-loan']             = 'page/personal_loan';
// $route['business-loan']             = 'page/business_loan';
// $route['finmax']                    = 'page/finmax';
// $route['customer']                  = 'page/customer';
// $route['cureent-opening']           = 'page/cureent_opening';
// $route['forgot-password']           = 'page/forgot_password';

// $route['premium-membership']           = 'page/premium_membership';
// $route['platinum-membership']           = 'page/platinum_membership';

$route['admin/demo-page'] = 'admin/Dashboard/demoPage';

$route['admin/share-pl'] = 'admin/Home/loan_lead_add';
$route['admin/share-bl'] = 'admin/Home/businessloan_insert';

// For Network share

$route['admin/add-network-member-share'] = 'admin/Home/addNetworkMember';
$route['admin/send-network-otp-share'] = 'admin/Home/sendNetworkOtp';
$route['admin/create-network-member-share'] = 'admin/Home/createNetworkMember';
$route['admin/network-member-plan-share'] = 'admin/Home/networkMemberOffer';
$route['admin/network-member-payment-share'] = 'admin/Home/networkMemberPayment';
$route['admin/payment-respone-share'] = 'admin/Home/paymentResponse';

// For Team Share

$route['admin/my-team-share'] = 'admin/Home/myTeam';
$route['admin/add-member-share'] = 'admin/Home/addTeamMember';
$route['admin/send-otp-share'] = 'admin/Home/sendotp';
$route['admin/create-member-share'] = 'admin/Home/createTeamMember';



// Domain master
$route['admin/domain'] = 'admin/rolepermission/domain';
$route['admin/domain/domainupdate'] = 'admin/rolepermission/domainUpdate';
$route['admin/domainasign'] = 'admin/rolepermission/domainasign';
$route['admin/domain-add'] = 'admin/rolepermission/domain_add';
$route['admin/domain-view/(:num)'] = 'admin/rolepermission/domain_view/$1';
$route['admin/domain-edit/(:num)'] = 'admin/rolepermission/domain_edit/$1';
$route['admin/domainDel/(:num)'] = 'admin/rolepermission/domainDel/$1';


// permission master
$route['admin/permission'] = 'admin/rolepermission/permission';
$route['admin/menu-position'] = 'admin/rolepermission/menu_position';

// single change plan by
$route['admin/get_plan_data_by_domain'] = 'admin/Dashboard/get_plan_data_by_domain';

//header menus
$route['admin/show_menu'] = 'admin/Slider/show_menu';
$route['admin/add_menu'] = 'admin/Slider/add_menu';
$route['admin/save_menu'] = 'admin/Slider/save_menu';
$route['admin/edit_menu/(:num)'] = 'admin/Slider/edit_menu/$1';
$route['admin/update_menu/(:num)'] = 'admin/Slider/update_menu/$1';
$route['admin/delete_menu/(:num)'] = 'admin/Slider/delete_menu/$1';


$route['admin/marketing-data'] = 'admin/Dashboard/marketingDataList';
$route['admin/marketing-data-add'] = 'admin/Dashboard/marketingDataAdd';
$route['admin/marketing-data-store'] = 'admin/Dashboard/marketingDataStore';
$route['admin/marketing-data-edit/(:num)'] = 'admin/Dashboard/marketingDataEdit/$1';
$route['admin/marketing-data-update'] = 'admin/Dashboard/marketingDataUpdate';
$route['admin/marketing-data-delete/(:num)'] = 'admin/Dashboard/marketingDataDelete/$1';
$route['admin/get-users-by-domain'] = 'admin/Dashboard/getUsersByDomainAjax';
$route['admin/get-indiasale-link'] = 'admin/Dashboard/get_indiasale_link';

$route['admin/add-marketing-whatsapp'] = 'admin/Dashboard/marketingWhatsappForm';
$route['admin/marketing-whatsapp'] = 'admin/Dashboard/marketingWhatsapp';
$route['admin/edit-marketing-whatsapp/(:num)'] = 'admin/Dashboard/marketingWhatsappEdit/$1';
$route['admin/update-marketing-whatsapp/(:num)'] = 'admin/Dashboard/marketingWhatsappUpdate/$1';
$route['admin/delete-marketing-whatsapp/(:num)'] = 'admin/Dashboard/marketingWhatsappDelete/$1';


$route['admin/add-whatsapp-transfer'] = 'admin/Dashboard/whatsapp_transferForm';
$route['admin/whatsapp_transfer'] = 'admin/Dashboard/whatsapp_transfer';
$route['admin/edit-whatsapp-transfer/(:num)'] = 'admin/Dashboard/whatsapp_transferEdit/$1';
$route['admin/update-whatsapp-transfer'] = 'admin/Dashboard/whatsapp_transferUpdate';
$route['admin/delete-whatsapp-transfer/(:num)'] = 'admin/Dashboard/whatsapp_transferDelete/$1';
$route['admin/update-whatsapp-status-transfer'] = 'admin/Dashboard/whatsapp_transferStatusUpdate';
$route['admin/get-whatsapp-transfers-by-domain'] = 'admin/Dashboard/getWhatsappTransferByDomainAjax';

$route['admin/marketing-whatsapp-view/(:num)'] = 'admin/Dashboard/marketingWhatsappView/$1';
$route['admin/marketing-whatsapp-credentials/(:num)'] = 'admin/Dashboard/marketingWhatsappCredentials/$1';


$route['admin/branch-agreement'] = 'admin/Dashboard/branch_agreement';
$route['admin/dsa-agreement'] = 'admin/Dashboard/dsa_agreement';
$route['admin/agreement-update'] = 'admin/Dashboard/agreementUpdate';
$route['admin/access-denied'] = 'admin/Dashboard/accessDenied';

$route['admin/loan-enquiry'] = 'admin/Dashboard/loanEnquiry';
$route['admin/government-services'] = 'admin/Dashboard/governmentServices';
$route['admin/brand-loan'] = 'admin/Dashboard/brandLoan';

$route['admin/cibil-score-check'] = 'admin/Dashboard/cibilScoreCheck';
$route['admin/addCibilLink'] = 'admin/Dashboard/addCibilLink';
$route['admin/deleteCibilLink/(:num)'] = 'admin/Dashboard/deleteCibilLink/$1';

$route['admin/branch-location'] = 'admin/Branches/index';
$route['admin/branch-location-add'] = 'admin/Branches/add';
$route['admin/branch-location-store'] = 'admin/Branches/store';
$route['admin/branch-location-edit/(:num)'] = 'admin/Branches/edit/$1';
$route['admin/branch-location-update'] = 'admin/Branches/update';
$route['admin/branch-location-delete/(:num)'] = 'admin/Branches/delete/$1';

$route['admin/team-id-card/(:num)'] = 'admin/Dashboard/team_id_card/$1';
$route['admin/team-offer-letter/(:num)'] = 'admin/Dashboard/team_offer_letter/$1';
$route['admin/team-offer-letter-pdf/(:num)'] = 'admin/Dashboard/team_offer_pdf_letter/$1';

$route['admin/marketing-notification-add'] = 'admin/Dashboard/marketing_notification_add';
$route['admin/marketing-notification-toggle'] = 'admin/Dashboard/marketing_notification_toggle';
$route['admin/marketing-notification-list'] = 'admin/Dashboard/marketing_notification_list';
$route['admin/marketing-notification-edit'] = 'admin/Dashboard/marketing_notification_edit';
$route['admin/marketing-notification-edit/(:num)'] = 'admin/Dashboard/marketing_notification_edit/$1';
$route['admin/marketing-notification-delete/(:num)'] = 'admin/Dashboard/marketing_notification_delete/$1';



