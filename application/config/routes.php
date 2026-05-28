<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'Page';
$route['404_override'] = '';
$route['translate_uri_dashes'] = false;

/**********************************
ADMIN ROUTE
 ***********************************/

$route['desk-login'] = 'admin/Login';
$route['admin-dashboard'] = 'admin/Dashboard';

$route['accessdenied'] = 'AccessDenied/index';
$route['access-denied'] = 'AccessDenied/index'; // friendly slug


$route['category'] = 'admin/Dashboard/category';
$route['add-category'] = 'admin/Dashboard/categoryForm';
$route['edit-category/(:num)'] = 'admin/Dashboard/categoryEdit/$1';
$route['update-category'] = 'admin/Dashboard/categoryUpdate';
$route['delete-category/(:num)'] = 'admin/Dashboard/categoryDelete/$1';
$route['update_category_status'] = 'admin/Dashboard/categoryStatusUpdate';

$route['subcategory'] = 'admin/Dashboard/subcategory';
$route['add-subcategory'] = 'admin/Dashboard/subcategoryForm';
$route['edit-subcategory/(:num)'] = 'admin/Dashboard/subcategoryEdit/$1';
$route['update-subcategory'] = 'admin/Dashboard/subcategoryUpdate';
$route['delete-subcategory/(:num)'] = 'admin/Dashboard/subcategoryDelete/$1';
$route['update_subcategory_status'] = 'admin/Dashboard/subcategoryStatusUpdate';

$route['admin/child-subcategory'] = 'admin/Dashboard/childSubcategory';
$route['admin/add-child-subcategory'] = 'admin/Dashboard/childSubcategoryForm';
$route['admin/edit-child-subcategory/(:num)'] = 'admin/Dashboard/childSubcategoryEdit/$1';
$route['admin/update-child-subcategory'] = 'admin/Dashboard/childSubcategoryUpdate';
$route['delete-child-subcategory/(:num)'] = 'admin/Dashboard/childSubcategoryDelete/$1';
$route['update_child_subcategory_status'] = 'admin/Dashboard/childSubcategoryStatusUpdate';

$route['admin/add-slider'] = 'admin/Slider/sliderForm';
$route['admin/slider'] = 'admin/Slider/slider';
$route['admin/edit-slider/(:num)'] = 'admin/Slider/sliderEdit/$1';
$route['admin/update-slider'] = 'admin/Slider/sliderUpdate';
$route['admin/delete-slider/(:num)'] = 'admin/Slider/sliderDelete/$1';
$route['admin/update_slider_status'] = 'admin/Slider/sliderStatusUpdate';

$route['all-category'] = 'admin/Dashboard/productAll';

$route['admin/policy'] = 'admin/PolicyTerm/policy';
$route['admin/add-policy'] = 'admin/PolicyTerm/policyForm';
$route['admin/edit-policy/(:num)'] = 'admin/PolicyTerm/policyEdit/$1';
$route['admin/update-policy'] = 'admin/PolicyTerm/policyUpdate';
$route['admin/delete-policy/(:num)'] = 'admin/PolicyTerm/policyDelete/$1';
$route['admin/update_policy_status'] = 'admin/PolicyTerm/policyStatusUpdate';

$route['admin/about-us'] = 'admin/AboutUs/about';
//$route['admin/add-about-us'] = 'admin/AboutUs/aboutForm';
$route['admin/edit-about-us/(:num)'] = 'admin/AboutUs/aboutEdit/$1';
$route['admin/update-about-us'] = 'admin/AboutUs/aboutUpdate';
//$route['admin/delete-about-us/(:num)'] = 'admin/AboutUs/aboutDelete/$1';
$route['admin/update_aboutus_status'] = 'admin/AboutUs/aboutStatusUpdate';

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




$route['admin/contact-us'] = 'admin/Dashboard/contactUs';
$route['admin/register-user'] = 'admin/Dashboard/registerUser';



/**********************************
FRONT ROUTE
 ***********************************/

$route[''] = 'Page';
$route['customer-login'] = 'Page/login';
$route['logout'] = 'Page/logout';

$route['userPayment'] = 'Page/userPayment';
$route['userPayment/(:num)'] = 'Page/userPaymentAgen/$1';
$route['submitpayment'] = 'Page/submitpayment';
$route['success'] = 'Page/success';
$route['failed'] = 'Page/failed';

$route['agentpayment'] = 'Page/agentPayment';
$route['brancepayment'] = 'Page/brancePayment';

$route['personalLoan'] = 'Page/personalLoan';
//$route['otp']                       = 'Page/otpPage';
$route['businessLoan'] = 'Page/personalLoan';
$route['checkamount'] = 'Page/checkAmount';
$route['checkamount/(:num)'] = 'page/checkAmountAgen/$1';

$route['checkeligibility'] = 'Page/checkeligibility';
$route['checkeligibility/(:num)'] = 'Page/checkeligibilityAgen/$1';
$route['preapproval'] = 'Page/preapproval';
$route['preapproval/(:num)'] = 'Page/preapprovalAgen/$1';
$route['card'] = 'Page/card';
$route['card/(:num)'] = 'Page/cardAgen/$1';
$route['checkpayment'] = 'Page/checkPayment';

$route['payment-respone'] = 'Page/paymentResponse';
$route['profile'] = 'Page/profile';

$route['save-change-password'] = 'Page/saveChangePassword';

$route['customer'] = 'page/customer';
$route['sendotp'] = 'Page/sendotp';
$route['sendotp_customer'] = 'Page/sendotp_customer';
$route['sendotp_franchise'] = 'Page/sendotp_franchise';
$route['branchRegistration'] = 'Page/branchRegistration';
$route['userRegistration'] = 'Page/userRegistration';
$route['checkEmail'] = 'Page/checkEmail';

$route['branch-franchise'] = 'page/branch_franchise';
$route['agent'] = 'page/agent';
$route['agentdetail'] = 'page/agentdetail';
$route['agentOffer'] = 'page/agentOffer';

$route['brancedetail'] = 'page/brancedetail';
$route['branceOffer'] = 'page/branceOffer';

$route['send-query'] = 'page/sendMail';
$route['forgetPassword'] = 'page/forgetPassword';

$route['forgetPassword'] = 'page/forgetPassword';

$route['raise-request'] = 'Page/raise_request';

$route['career'] = 'Page/career';
$route['company'] = 'Page/company';
$route['services'] = 'Page/services';
$route['contact'] = 'Page/contact';
$route['premium-membership-card'] = 'Page/premium_membership_card';
$route['plantinum-membership-card'] = 'Page/plantinum_membership_card';
$route['important-update'] = 'Page/important_update';
$route['terms-conditions'] = 'Page/terms_conditions';
$route['disclaimer'] = 'Page/disclaimer';
$route['refund-policy'] = 'Page/refund_policy';
$route['privacy-policy'] = 'page/privacy_policy';
$route['faqs'] = 'page/faqs';
$route['emi-calculator'] = 'page/emi_calculator';

$route['finmax-plan'] = 'page/finmax_plan';
$route['channel-partner-code'] = 'page/channel_partner_code';
$route['branch-franchise-code'] = 'page/branch_franchise_code';
$route['personal-loan'] = 'page/personal_loan';
$route['business-loan'] = 'page/business_loan';
$route['finmax'] = 'page/finmax';

$route['cureent-opening'] = 'page/cureent_opening';
$route['forgot-password'] = 'page/forgot_password';

$route['premium-membership'] = 'page/premium_membership';
$route['platinum-membership'] = 'page/platinum_membership';

$route['Cards'] = 'page/cards';
$route['Loan_details'] = 'page/loan_details';
$route['blog'] = 'page/blog';
$route['blog-detail/(:num)'] = 'page/blog_detail/$1';

$route['enquiry-leads'] = 'page/enquiry_leads';
$route['loan_insert'] = 'page/loan_insert';

$route['government-services'] = 'page/government_services';
$route['government-services-insert'] = 'page/government_services_insert';

$route['brand-loan'] = 'page/brand_loan';
$route['brand-loan-insert'] = 'page/brand_loan_insert';
