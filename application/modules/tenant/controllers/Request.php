<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Request extends Tenant_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model(array('tenant/Request_model'));
        $this->load->library('form_validation');
    }
    public function index(){
        $user = $this->session->userdata('tenant');
        $data['page_title'] = lang('dashboard');
        $this->load->view('template/header', $data);
        $this->load->view('dashboard/dashboard', $data);
        $this->load->view('template/footer', $data);
    }

    public function request_list(){
        $tenant = $this->session->userdata('tenant');
        $data['page_title'] = lang('request_list');
        $data['request'] = $this->Request_model->get_requestall($tenant['projectid'],$tenant['building_id'],$tenant['unit'],$tenant['id']);
        $this->render_tenant('request/RequestList', $data);
    }
    public function request_view($id){
        $data['page_title'] = lang('request') . " " . lang('view');
		$data['request'] = $request = $this->Request_model->getrequestView($id);
		$data['material'] = $this->Request_model->getMaterial($id);
		$data['payment_details'] = $this->Request_model->getpayment($id);
		$data['track'] = $this->Request_model->getRequestLogs($id);
        $this->render_tenant('request/RequestView', $data);
    }
    public function request_form($id = false){
        $data['page_title'] = lang('request_form');
        $data['requesttypes'] = $this->Request_model->getRequestTypeAll();
        $tenant = $this->session->userdata('tenant');
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
        $data['price'] = '';
        $data['id'] = '';
        if ($id) {
            if (!$request) {
                $this->session->set_flashdata('error', lang('request_not_found'));
                redirect('tenant/request/request_list');
			}
            $data['title'] = $request->title;
            $data['Requesttypid'] = $request->requesttypeId;
            $data['categoryid'] = $request->categoryId;
            $data['subcategoryid'] = $request->subcategoryId;
            $data['description'] = $request->request_description;
            $data['price'] = $request->service_cost;
            $data['date'] = date('Y-m-d', strtotime($request->request_starttime));
            $data['id'] = $request->request_id;
        }
        $this->form_validation->set_rules('title', 'lang:title', 'trim|required');
        $this->form_validation->set_rules('requesttype', 'lang:requesttype', 'trim|required');
        if ($this->form_validation->run() == false) {
            $this->render_tenant('request/RequestForm', $data);
        } else {

            $save['title']                = $this->input->post('title');
            $save['request_starttime']    = $this->input->post('date');
            $save['requesttypeId']        = $this->input->post('requesttype');
            $save['categoryId']           = $this->input->post('categorytype');
            $save['subcategoryId']        = $this->input->post('subcategory');
            $save['request_description']  = $this->input->post('description');
            $save['service_cost']         = $this->input->post('service_cost');
            $save['project_id']           = $tenant['projectid'];
            $save['floor_id']             = $tenant['floor'];
			$save['building_id']          = $tenant['building_id'];
            $save['Unit_id']              = $tenant['unit'];
            $save['venue']                = $tenant['venue'];
           // $save['owner_type']           = $tenant['Owner_type'];
            $save['tenant_id']            = $tenant['id'];
            if ($id) {
                $save['request_id'] = $id;
            }
            $this->Request_model->request_save($save);
            if ($id) {
                $this->session->set_flashdata('message', lang('request_updated'));
            } else {
                $this->session->set_flashdata('message', lang('request_saved'));
            }
            redirect('tenant/request/request_list');
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
