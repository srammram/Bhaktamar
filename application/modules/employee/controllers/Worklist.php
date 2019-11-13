<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Worklist extends Employee_Controller {

	public function __construct()
	{
		parent::__construct();
    	  $this->load->model(array('employee/Worklist_model'));
		 $this->load->library('form_validation');
	}
	function index() {
        $employee=$this->session->userdata('employee');
	    $data['page_title']	=	lang('dashboard');
	    $this->load->view('template/header',$data);
		$this->load->view('dashboard/dashboard',$data);
		$this->load->view('template/footer',$data); 
	}	
	
	function Work_list(){
		 $employee = $this->session->userdata('employee');
		 $data['page_title']	= lang('Worklist');
	     $data['request']=$this->Worklist_model->get_requestall($employee['id']);
		 $this->render_employee('worklist/Worklist', $data);
	}
	function worklist_form($id = false){
		$data['page_title']         	= lang('Worklist_form');
		$data['requesttypes']	        = $this->Worklist_model->getRequestTypeAll();
		$Owner = $this->session->userdata('owner');
		if(!empty($id)){
			$request=$this->db->get_where('request',array('request_id'=>$id))->row();
			$data['category']	        = $this->Worklist_model->get_requestType_Category($request->requesttypeId);
			$data['Subcategory']	    = $this->Worklist_model->get_requestType_SubCategory($request->categoryId);
		}
	    	$data['title']                  ='';
		    $data['requesttypid']           ='';
		    $data['categoryid']             ='';
		    $data['subcategoryid']          ='';
		    $data['description']            ='';
		    $data['price']                  ='';
		    $data['id']                     ='';
		if ($id)
		{	
			if (!$request)
			{
				$this->session->set_flashdata('error', lang('request_not_found'));
				redirect('employee/Worklist/Work_list');
			}
	    $data['title']                  =$request->title;
		$data['requesttypid']           =$request->requesttypeId;
		$data['categoryid']             =$request->categoryId;
		$data['subcategoryid']          =$request->subcategoryId;
		$data['description']            =$request->request_description;
		$data['price']                  =$request->service_cost;
		$data['date']                   =date('Y-m-d',strtotime($request->request_starttime));
		$data['id']                     =$request->request_id;
		$data['status']                 =$request->Complaint_status;
		$data['assignee_comments']      =$request->assignee_comments;
		$data['admin_note']             =$request->admin_note;
		//$data['venue_details']          =$request->venue_details;
		$data['picture']                =$request->picture;
		$data['requestby']              =$this->Worklist_model->getRequestby($request->owner_type,$request->owner_id);
		}
		$this->form_validation->set_rules('title', 'lang:title', 'trim|required');
		$this->form_validation->set_rules('requesttype', 'lang:requesttype', 'trim|required');
		if ($this->form_validation->run() == FALSE){
			$this->render_employee('worklist/Worklist_form', $data);		
		}
		else{
			
			 if(!empty($_FILES['picture']['name'])){
                $config['upload_path'] = 'uploads/worklist_image/';
                $config['allowed_types'] = '*';
                $config['file_name'] = $_FILES['picture']['name'];
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                if($this->upload->do_upload('picture')){
                    $uploadData = $this->upload->data();
                    $Doc = $uploadData['file_name'];
                }
					$save['picture']=$Doc;	
			 }
	
		$save['assignee_comments']                  =$this->input->post('Note');
		$save['Complaint_status']                   =$this->input->post('request_status');
		if($id){
		$save['request_id']                     =$id;
		}
		    $this->Worklist_model->worklist_save($save);
			if($id){
				$this->session->set_flashdata('message', lang('Worklist_saved'));
			}else{
				$this->session->set_flashdata('message', lang('Worklist_saved'));
			}
		       redirect('employee/Worklist/Work_list');
		}
	} 
	function worklist_view($id){
		$data['page_title']         	= lang('Worklist_View12');
		$data['requesttypes']	        = $this->Worklist_model->getRequestTypeAll();
		$request=$this->db->get_where('request',array('request_id'=>$id))->row();
	    $data['category']	        = $this->Worklist_model->get_requestType_Category($request->requesttypeId);
	    $data['Subcategory']	    = $this->Worklist_model->get_requestType_SubCategory($request->categoryId);
		    $data['title']                  =$request->title;
		$data['requesttypid']           =$request->requesttypeId;
		$data['categoryid']             =$request->categoryId;
		$data['subcategoryid']          =$request->subcategoryId;
		$data['description']            =$request->request_description;
		$data['price']                  =$request->service_cost;
		$data['date']                   =date('Y-m-d',strtotime($request->request_starttime));
		$data['id']                     =$request->request_id;
		$data['status']                 =$request->Complaint_status;
		$data['assignee_comments']      =$request->assignee_comments;
		$data['admin_note']             =$request->admin_note;
		$data['venue_details']          =$this->Worklist_model->get_venue_details($request->request_id);
		
		$data['picture']                =$request->picture;
		$data['requestby']              =$this->Worklist_model->getRequestby($request->owner_type,$request->owner_id);
		$this->render_employee('worklist/WorklistView', $data);		
	}
	
}