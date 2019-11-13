<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Employee_Controller extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
		$this->load->helper('language');
		 if($this->session->userdata('lang')!="")
		{
			$this->lang->load('admin',$this->session->userdata('lang'));
		}else{
			$this->lang->load('employee', 'english');
		}
		$this->setting	=	get_setting();
		$this->emp_auth->check_session();
	    //if SSL is enabled in config force it here.
        if (config_item('ssl_support') && (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == 'off'))
		{
			$CI =& get_instance();
			$CI->config->config['base_url'] = str_replace('http://', 'https://', $CI->config->config['base_url']);
			die;
			redirect($CI->uri->uri_string());
		} 
    }
	 public function render_employee($page=false,$data=false)
	{
		$this->load->view('template/header',$data);
		$this->load->view('template/sidebar',$data);
		$this->load->view($page,$data);
		$this->load->view('template/footer',$data);
	} 
}



?>