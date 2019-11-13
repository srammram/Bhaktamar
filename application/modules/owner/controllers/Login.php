<?php
class Login extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model(array('Owner_model'));
	}
	function index()
	{	
		$redirect	= $this->owner_auth->is_logged_in(false, false);
		if ($redirect){
			redirect('owner/dashboard');
		}
		$data['setting']	=	get_setting();
		$this->load->helper('form');
		$data['redirect']	= $this->session->flashdata('redirect');
		$submitted 			= $this->input->post('submitted');
		
		if ($submitted)
		{
			$username	= $this->input->post('username');
			$password	= $this->input->post('password');
			$remember   = $this->input->post('remember');
			$redirect	= $this->input->post('redirect');
			$login		= $this->owner_auth->login_owner($username, $password, $remember);
			if ($login){

				if ($redirect == ''){
					$this->session->set_flashdata('message', 'Welcome');
				    $redirect = 'owner/dashboard';
				}
		         redirect($redirect);
				 
			}
			else
			{
				//this adds the redirect back to flash data if they provide an incorrect credentials
				$this->session->set_flashdata('redirect', $redirect);
				$this->session->set_flashdata('error', 'Authentication Failed');
				redirect('owner/login');
			}
		}
		$this->load->view('owner/login/login', $data);		
	}
	function logout()
	{
		$this->owner_auth->logout();
		
		//when someone logs out, automatically redirect them to the login page.
		$this->session->set_flashdata('message', "logged Out successfully");
		redirect('owner/login');
	}
	
}
