<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Request extends Owner_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('owner/Request_model'));
        $this->load->library('form_validation');
    }
    public function index(){
        $user = $this->session->userdata('owner');
        $data['page_title'] = lang('dashboard');
        $this->load->view('template/header', $data);
        $this->load->view('dashboard/dashboard', $data);
        $this->load->view('template/footer', $data);
    }

    public function request_list(){
        $Owner = $this->session->userdata('owner');
        $data['page_title'] = lang('request_list');
        $data['request'] = $this->Request_model->get_requestall($Owner['Owner_type'],$Owner['owner_id']);
        $this->render_owner('request/RequestList', $data);
    }
    public function request_view($id){
		$Owner = $this->session->userdata('owner');
        $data['page_title'] = lang('request') . " " . lang('view');
		$data['request'] = $request = $this->Request_model->getrequestView($id);
		$data['material'] = $this->Request_model->getMaterial($id);
		$data['payment_details'] = $this->Request_model->getpayment($id);
		$data['OwnerUnits']   = $this->Request_model->getOwnerunits($Owner['owner_id']);
		$data['unit_id']       = $this->Request_model->get_ownerRelationalunitDetails($request->Unit_id,$request->floor_id,$request->building_id,$request->project_id);
		$data['track'] = $this->Request_model->getRequestLogs($id);
        $this->render_owner('request/RequestView', $data);
    }
    public function request_form($id = false){
		$Owner = $this->session->userdata('owner');
        $data['page_title'] = lang('request_form');
        $data['requesttypes'] = $this->Request_model->getRequestTypeAll();
		$data['OwnerUnits']   = $this->Request_model->getOwnerunits($Owner['owner_id']);
        $Owner = $this->session->userdata('owner');
        if (!empty($id)) {
			$request = $this->db->get_where('request', array('request_id' => $id))->row();
            $data['category'] = $this->Request_model->get_requestType_Category($request->requesttypeId);
			$data['Subcategory'] = $this->Request_model->get_requestType_SubCategory($request->categoryId);
        }
        $data['title'] = '';
        $data['requesttypid'] = '';
        $data['categoryid'] = '';
        $data['subcategoryid'] = '';
        $data['description'] = '';
        $data['price']       = '';
        $data['id']          = '';
		$data['unit_id']     = '';
        if ($id) {
            if (!$request) {
                $this->session->set_flashdata('error', lang('request_not_found'));
                redirect('owner/request_list');
			}
            $data['title'] = $request->title;
            $data['Requesttypid']  = $request->requesttypeId;
            $data['categoryid']    = $request->categoryId;
            $data['subcategoryid'] = $request->subcategoryId;
            $data['description']   = $request->request_description;
            $data['price']         = $request->service_cost;
            $data['date']          = date('Y-m-d', strtotime($request->request_starttime));
            $data['id']            = $request->request_id;
			$data['unit_id']       = $this->Request_model->get_ownerRelationalunitDetails($request->Unit_id,$request->floor_id,$request->building_id,$request->project_id);
		
        }
        $this->form_validation->set_rules('title', 'lang:title', 'trim|required');
        $this->form_validation->set_rules('requesttype', 'lang:requesttype', 'trim|required');
        if ($this->form_validation->run() == false) {
            $this->render_owner('request/RequestForm', $data);
        } else {
             $get_units=$this->Request_model->get_unitDetails($this->input->post('ownerUnit_relationid'));
            $save['title']                = $this->input->post('title');
            $save['request_starttime']    = $this->input->post('date');
            $save['requesttypeId']        = $this->input->post('requesttype');
            $save['categoryId']           = $this->input->post('categorytype');
            $save['subcategoryId']        = $this->input->post('subcategory');
            $save['request_description']  = $this->input->post('description');
            $save['service_cost']         = $this->input->post('service_cost');
            $save['project_id']           = $get_units->project_id;
            $save['floor_id']             = $get_units->floor_id;
            $save['Unit_id']              = $get_units->unit_id;
			$save['building_id']          = $get_units->building_id;
            $save['venue']                = $Owner['venue'];
            $save['owner_type']           = $Owner['Owner_type'];
            $save['owner_id']             = $Owner['owner_id'];
            if ($id) {
                $save['request_id'] = $id;
            }else{
				$save['reference_no']         ='REQ_'.strtotime(date('Y/m/d H:i:s'));
			}
            $this->Request_model->request_save($save);
            if ($id) {
                $this->session->set_flashdata('message', lang('request_updated'));
            } else {
                $this->session->set_flashdata('message', lang('request_saved'));
            }
            redirect('owner/request/request_list');
        }
    }

    public function help()
    {
    }
    public function get_category()
    {
        $HTML = '';
        $requesttype = $this->input->post('requesttype');
        $request_category = $this->db->get_where('request_category', array('soft_delete' => 0, 'request_typeid' => $requesttype))->result();
        if ($request_category) {
            foreach ($request_category as $item) {
                $HTML .= "<option value='" . $item->id . "'>" . $item->Name . "</option>";
            }
        } else {
            $HTML .= "<option value=''>Select Category</option>";
        }
        echo $HTML;

    }

    public function get_subcategory()
    {
        $HTML = '';
        $categoryid = $this->input->post('categoryid');
        $categoryid = $this->db->get_where('request_subcategory', array('soft_delete' => 0, 'category_id' => $categoryid))->result();
        if ($categoryid) {
            foreach ($categoryid as $item) {
                $HTML .= "<option value='" . $item->id . "'>" . $item->Name . "</option>";
            }
        } else {
            $HTML .= "<option value=''>Select SubCategory</option>";
        }
        echo $HTML;

    }
    public function get_subcategory_details()
    {
        $subcategoryid = $this->input->post('subcategoryid');
        $subcategory = $this->db->get_where('request_subcategory', array('soft_delete' => 0, 'id' => $subcategoryid))->row();
        if (!empty($subcategory->price)) {echo $subcategory->price;} else {echo 0;};

	}
	function requestDelete($requestid){
		if ($requestid){	
			$deleterequest	= $this->Request_model->getrequestView($requestid);
			if (!$deleterequest){
				$this->session->set_flashdata('error', lang('request_not_found'));
				redirect('owner/request/request_list');
			}else{
				$delete	= $this->Request_model->requestDelete($requestid);
				$this->session->set_flashdata('message', lang('request_deleted'));
				redirect('owner/request/request_list');
			}
		}
		else{
		
			$this->session->set_flashdata('error', lang('request_not_found'));
		    redirect('owner/request/request_list');
		}



	}
}
