<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {
	public function __construct() {
        parent::__construct();
        $protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? "https" : "http";
        $host     = $_SERVER['HTTP_HOST'];
        $uri      = $_SERVER['REQUEST_URI'];        
        $script   = $_SERVER['SCRIPT_NAME'];        
        if (strpos($uri, '/beta') === 0 || strpos($script, '/beta') === 0) {
            $clean_uri = preg_replace('#^/beta(/|$)#i', '/', $uri);
            $clean_uri = preg_replace('#/+#', '/', $clean_uri);
            $redirect_url = $protocol . '://' . $host . $clean_uri;
            if (!empty($_SERVER['QUERY_STRING'])) {
                $redirect_url .= '?' . $_SERVER['QUERY_STRING'];
            }
            header("Location: $redirect_url", true, 301);
            exit();
        }
		$clean_path = str_ireplace('/beta', '', $script);
        $clean_path = preg_replace('#/+#', '/', $clean_path);
        $base_url   = $protocol . '://' . $host . dirname($clean_path) . '/';
        $base_url   = rtrim($base_url, '/') . '/';

        $this->config->set_item('base_url', $base_url);
    }

	public function index()
	{   $data['base_url'] = base_url();
		redirect($data['base_url']);
		
	    $data['title'] = 'Home'; $data['keywords'] = 'home,page,test'; $data['description'] = 'this is home page';
		$this->load->view('Page/template/header',$data);
		$this->load->view('Page/index',$data);
		$this->load->view('Page/template/footer',$data);
	}
	
	public function company()
	{   $data['base_url'] = base_url();
		redirect($data['base_url']);
	    $data['title'] = 'Home'; $data['keywords'] = 'home,page,test'; $data['description'] = 'this is home page';
		$this->load->view('Page/template/header',$data);
		$this->load->view('Page/company',$data);
		$this->load->view('Page/template/footer',$data);
	}
		
	public function career()
	{   $data['base_url'] = base_url();
		redirect($data['base_url']);
	    $data['title'] = 'Home'; $data['keywords'] = 'home,page,test'; $data['description'] = 'this is home page';
		$this->load->view('Page/template/header',$data);
		$this->load->view('Page/career',$data);
		$this->load->view('Page/template/footer',$data);
	}

	public function profile()
	{   $data['base_url'] = base_url();
		redirect($data['base_url']);
	    $data['title'] = 'Profile'; $data['keywords'] = 'home,page,test'; $data['description'] = 'this is profile page';
		$this->load->view('Page/template/header',$data);
		$this->load->view('Page/profile',$data);
		$this->load->view('Page/template/footer',$data);
	}
	
	public function about()
	{$data['base_url'] = base_url();
		redirect($data['base_url']);
		$data['title'] = 'About'; $data['keywords'] = 'about,page,test'; $data['description'] = 'this is about page';
		$this->load->view('Page/about',$data);
	}
	
	public function services()
	{$data['base_url'] = base_url();
		redirect($data['base_url']);
		$data['title'] = 'Services'; $data['keywords'] = 'services,page,test'; $data['description'] = 'this is services page';
		$this->load->view('Page/services',$data);
	}
	public function contact()
	{$data['base_url'] = base_url();
		redirect($data['base_url']);
		$data['title'] = 'Contact'; $data['keywords'] = 'contact,page,test'; $data['description'] = 'this is contact page';
		$this->load->view('Page/template/header',$data);
		$this->load->view('Page/contact',$data);
		$this->load->view('Page/template/footer',$data);
		
	}
	
	public function plantinum_membership_card()
	{$data['base_url'] = base_url();
		redirect($data['base_url']);
		$data['title'] = 'plantinum-membership-card'; $data['keywords'] = 'plantinum-membership-card,page,test'; $data['description'] = 'this is plantinum-membership-card page';
		$this->load->view('Page/template/header',$data);
		$this->load->view('Page/plantinum-membership',$data);
		$this->load->view('Page/template/footer',$data);
	}
	
	public function premium_membership_card()
	{$data['base_url'] = base_url();
		redirect($data['base_url']);
		$data['title'] = 'premium-membership-card'; $data['keywords'] = 'premium-membership-card,page,test'; $data['description'] = 'this is premium-membership-card page';
		$this->load->view('Page/template/header',$data);
		$this->load->view('Page/premium-membership',$data);
		$this->load->view('Page/template/footer',$data);
		
	}
		public function important_update()
	{$data['base_url'] = base_url();
		redirect($data['base_url']);
		$data['title'] = 'Important Update-'; $data['keywords'] = 'update,page,test'; $data['description'] = 'this is Important Update page';
		$this->load->view('Page/template/header',$data);
		$this->load->view('Page/important-update',$data);
		$this->load->view('Page/template/footer',$data);
		
	}
	public function terms_conditions()
	{$data['base_url'] = base_url();
		redirect($data['base_url']);
		$data['title'] = 'Terms & Conditions-'; $data['keywords'] = 'terms-condtions,page,test'; $data['description'] = 'this is Terms & Conditions page';
		$this->load->view('Page/template/header',$data);
		$this->load->view('Page/terms-condtions',$data);
		$this->load->view('Page/template/footer',$data);
		
	}
	public function disclaimer()
	{$data['base_url'] = base_url();
		redirect($data['base_url']);
		$data['title'] = 'disclaimer-'; $data['keywords'] = 'disclaimer,page,test'; $data['description'] = 'this is Disclaimer page';
		$this->load->view('Page/template/header',$data);
		$this->load->view('Page/disclaimer',$data);
		$this->load->view('Page/template/footer',$data);
		
	}
	public function refund_policy()
	{$data['base_url'] = base_url();
		redirect($data['base_url']);
		$data['title'] = 'Cancellation & Refund Policy-'; $data['keywords'] = 'refund-policy,page,test'; $data['description'] = 'this is Cancellation & Refund Policy page';
		$this->load->view('Page/template/header',$data);
		$this->load->view('Page/refund-policy',$data);
		$this->load->view('Page/template/footer',$data);
		
	}
	public function privacy_policy()
	{$data['base_url'] = base_url();
		redirect($data['base_url']);
		$data['title'] = 'Privacy Policy-'; $data['keywords'] = 'privacy-policy,page,test'; $data['description'] = 'this is Privacy Policy page';
		$this->load->view('Page/template/header',$data);
		$this->load->view('Page/privacy-policy',$data);
		$this->load->view('Page/template/footer',$data);
		
	}
	public function faqs()
	{$data['base_url'] = base_url();
		redirect($data['base_url']);
		$data['title'] = 'faqs-'; $data['keywords'] = 'faqs,page,test'; $data['description'] = 'this is faqs page';
		$this->load->view('Page/template/header',$data);
		$this->load->view('Page/faqs',$data);
		$this->load->view('Page/template/footer',$data);
		
	}
	public function finmax_plan()
	{$data['base_url'] = base_url();
		redirect($data['base_url']);
		$data['title'] = 'finmax plan-'; $data['keywords'] = 'finmax-plan,page,test'; $data['description'] = 'this is finmax-plan page';
		$this->load->view('Page/template/header',$data);
		$this->load->view('Page/finmax_plan',$data);
		$this->load->view('Page/template/footer',$data);
	}
	
	
	
	public function channel_partner_code()
	{$data['base_url'] = base_url();
		redirect($data['base_url']);
		$data['title'] = 'channel-partner-code-'; $data['keywords'] = 'channel-partner-code,page,test'; $data['description'] = 'this is channel-partner-code page';
		$this->load->view('Page/template/header',$data);
		$this->load->view('Page/channel_partner_code',$data);
		$this->load->view('Page/template/footer',$data);
	}
	public function personal_loan()
	{$data['base_url'] = base_url();
		redirect($data['base_url']);
		$data['title'] = 'personal_loan-'; $data['keywords'] = 'personal_loan,page,test'; $data['description'] = 'this is personal_loan page';
		$this->load->view('Page/template/header',$data);
		$this->load->view('Page/personal_loan',$data);
		//$this->load->view('Page/template/footer',$data);
	}
	public function business_loan()
	{$data['base_url'] = base_url();
		redirect($data['base_url']);
		$data['title'] = 'business-loan-'; $data['keywords'] = 'business-loan,page,test'; $data['description'] = 'this is business-loan page';
	    $this->load->view('Page/template/header',$data);
		$this->load->view('Page/business_loan',$data);
	//	$this->load->view('Page/template/footer',$data);
	}
	public function finmax()
	{$data['base_url'] = base_url();
		redirect($data['base_url']);
		$data['title'] = 'finmax-'; $data['keywords'] = 'finmax,page,test'; $data['description'] = 'this is finmax page';
		$this->load->view('Page/template/header',$data);
		$this->load->view('Page/finmax',$data);
		//$this->load->view('Page/template/footer',$data);
	}
	public function customer()
	{$data['base_url'] = base_url();
		redirect($data['base_url']);
		$data['title'] = 'customer-'; $data['keywords'] = 'customer,page,test'; $data['description'] = 'this is customer page';
		$this->load->view('Page/template/header',$data);
		$this->load->view('Page/customer',$data);
		$this->load->view('Page/template/footer',$data);
	}
	public function cureent_opening()
	{$data['base_url'] = base_url();
		redirect($data['base_url']);
		$data['title'] = 'cureent-opening-'; $data['keywords'] = 'cureent-opening,page,test'; $data['description'] = 'this is cureent-opening page';
		$this->load->view('Page/template/header',$data);
		$this->load->view('Page/cureent_opening',$data);
		$this->load->view('Page/template/footer',$data);
	}
	public function forgot_password()
	{$data['base_url'] = base_url();
		redirect($data['base_url']);
		$data['title'] = 'forgot_password-'; $data['keywords'] = 'cureent-opening,page,test'; $data['description'] = 'this is cureent-opening page';
		$this->load->view('Page/template/header',$data);
		$this->load->view('Page/forgot-password',$data);
		$this->load->view('Page/template/footer',$data);
	}
	
	
}
