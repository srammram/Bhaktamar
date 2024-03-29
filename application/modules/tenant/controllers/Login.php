<?php
class Login extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model(array('Owner_model'));
	}
	function index(){	
		$redirect	= $this->tenant_auth->is_logged_in(false, false);
		if ($redirect){
			redirect('tenant/dashboard');
		}
		$data['setting']	=	get_setting();
		$this->load->helper('form');
		$data['redirect']	= $this->session->flashdata('redirect');
		$submitted 			= $this->input->post('submitted');
		
		if ($submitted){
			
			$username	= $this->input->post('username');
			$password	= $this->input->post('password');
			$remember   = $this->input->post('remember');
			$redirect	= $this->input->post('redirect');
			$login		= $this->tenant_auth->login_tenant($username, $password, $remember);
			if ($login){
				if ($redirect == ''){
					$this->session->set_flashdata('message', 'Welcome');
				    $redirect = 'tenant/dashboard';
				}
		         redirect($redirect);
			}
			else{
				//this adds the redirect back to flash data if they provide an incorrect credentials
				$this->session->set_flashdata('redirect', $redirect);
				$this->session->set_flashdata('error', 'Authentication Failed');
				redirect('tenant/login');
			}
		}
		$this->load->view('tenant/login/login', $data);		
	}
	function logout()
	{
		$this->tenant_auth->logout();
		
		//when someone logs out, automatically redirect them to the login page.
		$this->session->set_flashdata('message', "logged Out successfully");
		redirect('tenant/login');
	}
	
}
