<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Request extends Owner_Controller {

	public function __construct()
	{
		parent::__construct();
    	  $this->load->model(array('owner/Request_model'));
		 $this->load->library('form_validation');
	}
	function index() {
        $user=$this->session->userdata('owner');
	    $data['page_title']	=	lang('dashboard');
	    $this->load->view('template/header',$data);
		$this->load->view('dashboard/dashboard',$data);
		$this->load->view('template/footer',$data); 
		
	}	
	
	function request_list(){
		 $Owner = $this->session->userdata('owner');
		 $data['page_title']	= lang('request_list');
	     $data['request']=$this->Request_model->get_requestall();
		 $this->render_owner('request/RequestList', $data);
	}
	
	 function request_view($id){
		$data['page_title']	= lang('request')." ".lang('view') ;
		$data['request']	= $request = $this->Request_model->getrequestView($id);
		$this->render_owner('request/RequestView', $data);
	} 
 	function request_form($id = false){
		$data['page_title']         	= lang('request_form');
		$data['requesttypes']	        = $this->Request_model->getRequestTypeAll();
		$Owner = $this->session->userdata('owner');
		if(!empty($id)){
			$request=$this->db->get_where('request',array('request_id'=>$id))->row();
			$data['category']	        = $this->Request_model->get_requestType_Category($request->requesttypeId);
			$data['Subcategory']	    = $this->Request_model->get_requestType_SubCategory($request->categoryId);
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
				redirect('owner/request_list');
			}
	    $data['title']                  =$request->title;
		$data['requesttypid']           =$request->requesttypeId;
		$data['categoryid']             =$request->categoryId;
		$data['subcategoryid']          =$request->subcategoryId;
		$data['description']            =$request->request_description;
		$data['price']                  =$request->service_cost;
		$data['date']                   =date('Y-m-d',strtotime($request->request_starttime));
		$data['id']                     =$request->request_id;
		}
		$this->form_validation->set_rules('title', 'lang:title', 'trim|required');
		$this->form_validation->set_rules('requesttype', 'lang:requesttype', 'trim|required');
		if ($this->form_validation->run() == FALSE){
			$this->render_owner('request/RequestForm', $data);		
		}
		else{
			
		$save['title']                  =$this->input->post('title');
		$save['request_starttime']      =$this->input->post('date');
		$save['requesttypeId']          =$this->input->post('requesttype');
		$save['categoryId']             =$this->input->post('categorytype');
		$save['subcategoryId']          =$this->input->post('subcategory');
		$save['request_description']    =$this->input->post('description');
		$save['service_cost']           =$this->input->post('service_cost');
		$save['project_id']             =$Owner['projectid'];
		$save['floor_id']               =$Owner['floor'];
		$save['Unit_id']                =$Owner['unit'];
		$save['venue']                  =$Owner['venue'];
		$save['owner_type']             =$Owner['Owner_type'];
		$save['owner_id']               =$Owner['owner_id'];
		if($id){
		$save['id']                     =$id;
		}
		    $this->Request_model->request_save($save);
			if($id){
				$this->session->set_flashdata('message', lang('request_updated'));
			}else{
				$this->session->set_flashdata('message', lang('request_saved'));
			}
		       redirect('owner/request/request_list');
		}
	} 
	
	function help(){
	}
	function get_category(){
	$HTML='';
    $requesttype = $this->input->post('requesttype');
	$request_category=$this->db->get_where('request_category',array('soft_delete'=>0,'request_typeid' => $requesttype))->result();
	if ($request_category) {
		foreach ($request_category as $item) {
			$HTML.="<option value='" . $item->id . "'>" . $item->Name. "</option>";
		}
	}else{
		$HTML.="<option value=''>Select Category</option>";
	}
        echo $HTML;
	 
    }
	
	function get_subcategory(){
	$HTML='';
    $categoryid = $this->input->post('categoryid');
	$categoryid=$this->db->get_where('request_subcategory',array('soft_delete'=>0,'category_id' => $categoryid))->result();
	if ($categoryid) {
		foreach ($categoryid as $item) {
			$HTML.="<option value='" . $item->id . "'>" . $item->Name. "</option>";
		}
	}else{
		$HTML.="<option value=''>Select SubCategory</option>";
	}
        echo $HTML;
	 
    }
	function get_subcategory_details(){
    $subcategoryid = $this->input->post('subcategoryid');
	$subcategory=$this->db->get_where('request_subcategory',array('soft_delete'=>0,'id' => $subcategoryid))->row();
	if(!empty($subcategory->price)) {  echo $subcategory->price ; }else{    echo 0  ; };
	
}
}