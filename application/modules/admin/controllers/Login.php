<?php
class Login extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model(array('Forgot_model'));
	}
      function index(){	
		$redirect	= $this->auth->is_logged_in(false, false);
		if ($redirect){
			redirect('admin/dashboard');
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
			$login		= $this->auth->login_admin($username, $password, $remember);
			if ($login){	
				if ($redirect == ''){
					$this->session->set_flashdata('message', 'Welcome');
					$redirect = 'admin/dashboard';
				}
				redirect($redirect);
			}else{
				$this->session->set_flashdata('redirect', $redirect);
				$this->session->set_flashdata('error', 'Authentication Failed');
				redirect('admin/login');
			}
		}
		$this->load->view('login/login', $data);		
	}
	function logout(){
		$this->auth->logout();
		$this->session->set_flashdata('message', "logged Out successfully");
		redirect('admin/login');
	}
}
