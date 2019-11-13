<?php
class test extends Front_Controller {

	function __construct()
	{		
		parent::__construct();
		$this->load->model(array('homepage_model','login_model','account_model'));
	}
	
	function index()
	{
		echo 'hi';
	}
	
}