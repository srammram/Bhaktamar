<?php
class Departments extends Admin_Controller {

	function __construct()
	{		
		parent::__construct();
		$this->load->model(array('department_model'));
	}
	
	function index()
	{	
		$data['page_title']	= lang('departments');
		$data['departments']	= $this->department_model->get_all();
		$this->render_admin('departments/list', $data);		
	}
	
	
	function form($id = false)
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		$data['page_title']		= lang('department_form');
		$data['id']					= '';
		$data['name']				= '';
		
		if ($id)
		{	
			$data['department']			=	$department		= $this->department_model->get($id);
			if (!$department)
			{
				$this->session->set_flashdata('error', lang('department_not_found'));
				redirect('admin/departments');
			}
			//set values to db values
			$data['id']					= $department->id;
			$data['name']				= $department->name;
			
		}
		$this->form_validation->set_rules('name', 'lang:name', 'trim|required');
		if ($this->form_validation->run() == FALSE)
		{
			$this->render_admin('departments/form', $data);		
		}
		else
		{
			$save['id']				= $id;
			$save['name']			= $this->input->post('name');
			$this->department_model->save($save);
			if($id){
				$this->session->set_flashdata('message', lang('department_update'));
			}else{
				$this->session->set_flashdata('message', lang('department_save'));
			}
			redirect('admin/departments');
		}
	}
	
	function delete($id = false)
	{
		if ($id)
		{	
			$department	= $this->department_model->get($id);
			if (!$department)
			{
				$this->session->set_flashdata('error', lang('department_not_found'));
				redirect('admin/departments');
			}
			else
			{
				$delete	= $this->department_model->delete($id);
				$this->session->set_flashdata('message', lang('department_delete'));
				redirect('admin/departments');
			}
		}
		else
		{
			$this->session->set_flashdata('error', lang('department_not_found'));
			redirect('admin/departments');
		}
	}
	
	
}