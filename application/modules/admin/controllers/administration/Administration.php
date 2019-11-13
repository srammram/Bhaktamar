<?php

class Administration extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
		$this->load->model(array('administration/Administration_model'));
		$this->load->helper('form');
		$this->load->library('form_validation');
    }
    public function index()
    {
        $admin = $this->session->userdata('admin');
        $data['page_title']  = lang('request');
		$data['new'] = $this->Administration_model->get_new_request();
		$data['open'] = $this->Administration_model->get_open_request();
		$data['requesttypes']	 = $this->Administration_model->getRequestTypeAll();
		$data['Project']			= $this->Administration_model->get_Project();
		$data['services_persons']=$this->Administration_model->get_services_person();
        $this->render_admin('administration/dashboard', $data);
    }
    public function requestList()
    {
        $admin = $this->session->userdata('admin');
        $data['page_title'] = lang('request');
        $data['Complaint'] = $this->Administration_model->get_all_request();
        $this->render_admin('administration/list', $data);
    }

    public function view($id)
    {
        $admin = $this->session->userdata('admin');
        $data['page_title'] = lang('view') . " " . lang('request');
		 $data['request'] = $request = $this->Administration_model->getRequestByid($id);
		$data['category']	         = $this->Administration_model->get_requestType_Category($request->requesttypeId);
		$data['services_persons']=$this->Administration_model->get_services_person();
			$data['Subcategory']	     = $this->Administration_model->get_requestType_SubCategory($request->categoryId);
			$data['payment_details']	 = $this->Administration_model->getpayment($request->request_id);
			$data['material']	         = $this->Administration_model->getMaterial($request->request_id);
			$data['floors']	              = $this->Administration_model->getFloorByid($request->project_id);
			$data['houses']	              = $this->Administration_model->getHouseByid($request->project_id,$request->floor_id);
			$data['owners']	              = $this->Administration_model->getOwnerByid($request->owner_type);
			$data['category']	         = $this->Administration_model->get_requestType_Category($request->requesttypeId);
			$data['Subcategory']	     = $this->Administration_model->get_requestType_SubCategory($request->categoryId);
			$data['payment_details']	 = $this->Administration_model->getpayment($request->request_id);
			$data['material']	         = $this->Administration_model->getMaterial($request->request_id);
			$data['floors']	              = $this->Administration_model->getFloorByid($request->project_id);
			$data['houses']	              = $this->Administration_model->getHouseByid($request->project_id,$request->floor_id);
			//$data['owners']	              = $this->Administration_model->getOwnerByid($request->owner_type);
			$data['track']               = $this->Administration_model->getRequestLogs($request->request_id);
            $data['title']               = $request->title;
			$data['request_description'] = $request->request_description;
            $data['date']                = $request->request_starttime;
            $data['requestType']         = $request->requesttypeId;
            $data['categtoryType']       = $request->categoryId;
            $data['subcategoryType']     = $request->subcategoryId;
            $data['requestId']           = $request->request_id;
            $data['projectName']         = $this->Administration_model->getProject($request->project_id);
            $data['RequerequesttedBy'] = $this->Administration_model->getRequestby($request->owner_type,$request->owner_id);
			
            $data['Venue']               = $request->venue;
            $data['requestStartDate']    = $request->request_starttime;
			$data['requestEndDate']      = $request->request_endtime;
			$data['status']              = $request->Complaint_status;
			$data['assignto']            = explode(',',$request->assign_to);
			$data['assignee_comments']   = $request->assignee_comments;
			$data['rescheduling']        = $request->rescheduling;
		
			$data['ownertype']           = $request->owner_type;
			$data['ownerid']             = $request->owner_id;
			$data['projectid']           = $request->project_id;
			$data['floorid']             = $request->floor_id;
			$data['picture']             = $request->picture;
			$data['houseid']             = json_decode($request->Unit_id);
			$data['services_cost']       = !empty($request->service_cost)? $request->service_cost:0;
			$data['total_amount']       = !empty($request->total_amount)? $request->total_amount:0;
        $this->render_admin('administration/view', $data);
    }
    public function form($id = false)
    {
        $admin                      = $this->session->userdata('admin');
		$data['settings']           =$this->Administration_model->get_settings();
		$data['services_persons']   =$this->Administration_model->get_services_person();
		$data['requesttypes']	    = $this->Administration_model->getRequestTypeAll();
		$data['Project']			= $this->Administration_model->get_Project();
        $data['page_title'] = lang('request_from');
        $data['id']         = '';
		$data['title']         = '';
		$data['request_description'] = '';
		$data['date'] = '';
		$data['requestType'] = '';
		$data['categtoryType'] = '';
        $data['subcategoryType'] = '';
		$data['requestId'] = '';
		$data['projectName'] = '';
	    $data['RequerequesttedBy'] = '';
	    $data['Venue'] = '';
        $data['requestStartDate'] = '';
        $data['requestEndDate'] = '';
        $data['status'] = '';
        $data['assignto'] = '';
        $data['assignee_comments'] = '';
        $data['rescheduling'] = '';
        $data['services_cost'] = '';
        if ($id) {
            $data['request'] = $request = $this->Administration_model->getRequestByid($id);
			$this->Administration_model->requestStatuschange($id);
            if (!$request) {
                $this->session->set_flashdata('error', lang('Compaint_Not_found'));
                redirect('admin/administration/Administration/requestList');
            }
			$data['category']	         = $this->Administration_model->get_requestType_Category($request->requesttypeId);
			$data['Subcategory']	     = $this->Administration_model->get_requestType_SubCategory($request->categoryId);
			$data['payment_details']	 = $this->Administration_model->getpayment($request->request_id);
			$data['material']	         = $this->Administration_model->getMaterial($request->request_id);
			$data['floors']	              = $this->Administration_model->getFloorByid($request->project_id);
			$data['houses']	              = $this->Administration_model->getHouseByid($request->project_id,$request->floor_id);
			$data['owners']	              = $this->Administration_model->getOwnerByid($request->owner_type);
            $data['title']               = $request->title;
			$data['request_description'] = $request->request_description;
            $data['date']                = $request->request_starttime;
            $data['requestType']         = $request->requesttypeId;
            $data['categtoryType']       = $request->categoryId;
            $data['subcategoryType']     = $request->subcategoryId;
            $data['requestId']           = $request->request_id;
            $data['projectName']         = $this->Administration_model->getProject($request->project_id);
            $data['RequerequesttedBy']   = $this->Administration_model->getRequestby($request->owner_type,$request->owner_id);
			
            $data['Venue']               = $request->venue;
            $data['requestStartDate']    = $request->request_starttime;
			$data['requestEndDate']      = $request->request_endtime;
			$data['status']              = $request->Complaint_status;
			$data['assignto']            = explode(',',$request->assign_to);
			$data['assignee_comments']   = $request->assignee_comments;
			$data['rescheduling']        = $request->rescheduling;
			$data['ownertype']           = $request->owner_type;
			$data['ownerid']             = $request->owner_id;
			$data['projectid']           = $request->project_id;
			$data['floorid']             = $request->floor_id;
			$data['houseid']             = json_decode($request->Unit_id);
			$data['services_cost']       = !empty($request->service_cost)? $request->service_cost:0;
			$data['total_amount']        = !empty($request->total_amount)? $request->total_amount:0;
        }
		
        $this->form_validation->set_rules('title', 'lang:title', 'trim|required');
        $this->form_validation->set_rules('date', 'lang:date', 'trim|required');
        $this->form_validation->set_rules('requesttype', 'lang:requesttype', 'trim|required');
        if ($this->form_validation->run() == false) {
            $this->render_admin('administration/RequestForm', $data);
        } else {
            $save['request_id']=$id;
            $save['title'] = $this->input->post('title');
            $save['requesttypeId'] = $this->input->post('requesttype');
            $save['categoryId'] = $this->input->post('categorytype');
            $save['subcategoryId'] = $this->input->post('subcategory');
            $save['request_description'] = $this->input->post('description');
            $save['request_starttime'] = $this->input->post('request_startDate');
            $save['request_endtime'] = $this->input->post('request_endDate');
			$save['Complaint_status'] = $this->input->post('request_status');
			$save['rescheduling'] = $this->input->post('rescheduling');
			$save['admin_note'] = $this->input->post('adminnote');
			$save['owner_type'] = $this->input->post('OwnerType');
            $save['owner_id'] = $this->input->post('requestby');
			$save['project_id'] = $this->input->post('projectid');
			$save['floor_id'] = $this->input->post('floorid');
			$save['Unit_id'] = json_encode($this->input->post('houseid'));
			$save['service_cost'] = $services_cost=!empty($this->input->post('service_cost'))? $this->input->post('service_cost') :0;
			$total_amount=($services_cost +(!empty($this->input->post('payment_total'))? $this->input->post('payment_total') :0));
			$assign_to=implode(",", $this->input->post('assign_to'));
			$save['assign_to'] = $assign_to;
			$save['total_amount'] = $total_amount;
			for($i=0; $i<count($this->input->post('servicesName')); $i++){
				$service_payments[] = array(
					'services_name' => 	$_POST['servicesName'][$i],
					'services_cost' => 	$_POST['totalcost'][$i],
				);
			}
			for($i=0; $i<count($this->input->post('productid')); $i++){
				$service_material[] = array(
					'product_id' => 	$_POST['productid'][$i],
					'qty' => 	$_POST['qty'][$i],
					'cost' => 	$_POST['subtotal'][$i],
					'total_cost' => 	$_POST['subtotal'][$i],
				);
			}
            $this->Administration_model->requestSave($save, $service_payments,$service_material);
            if ($id) {
                $this->session->set_flashdata('message', lang('request_Updated'));
            } else {
                $this->session->set_flashdata('message', lang('request_saved'));
            }
            redirect('admin/administration/Administration/requestList');
        }
    }
	
	function quick_form(){
		  $this->form_validation->set_rules('title', 'lang:title', 'trim|required');
          $this->form_validation->set_rules('date', 'lang:date', 'trim|required');
          $this->form_validation->set_rules('requesttype', 'lang:requesttype', 'trim|required');
		if ($this->form_validation->run() == false) {
            $this->render_admin('administration/RequestForm', $data);
        } else {
            $save['title'] = $this->input->post('title');
            $save['requesttypeId'] = $this->input->post('requesttype');
            $save['categoryId'] = $this->input->post('categorytype');
            $save['subcategoryId'] = $this->input->post('subcategory');
            $save['owner_type'] = $this->input->post('OwnerType');
            $save['owner_id'] = $this->input->post('requestby');
			$save['project_id'] = $this->input->post('projectid');
			$save['floor_id'] = $this->input->post('floorid');
			$save['Unit_id'] = json_encode($this->input->post('houseid'));
			$save['venue_details'] = $this->input->post('venue');
			$save['service_cost'] = $this->input->post('services_cost');
			$save['admin_note'] = $this->input->post('description');
			$save['service_cost'] = $services_cost=!empty($this->input->post('service_cost'))? $this->input->post('service_cost') :0;
			$assign_to=implode(",", $this->input->post('assignto'));
			$save['assign_to'] = $assign_to;
            $this->Administration_model->requestQuickSave($save);
            if ($id) {
                $this->session->set_flashdata('message', lang('request_Updated'));
            } else {
                $this->session->set_flashdata('message', lang('request_saved'));
            }
            redirect('admin/administration/Administration/requestList');
        }
		
		
		
	}
	
   public  function requestReject($id){
	   $delete=$this->Administration_model->requestReject($id);
	     if (!$delete) {
                $this->session->set_flashdata('error', lang('request_reject'));
                redirect('admin/administration/Administration');
            } else {
                $this->session->set_flashdata('message', lang('request_reject'));
                redirect('admin/administration/Administration');
            }
	
}

    public function Get_types()
    {
        $type = $this->input->post('id');
        $options = '';
        switch ($type) {
            case 1:
                $amenities = $this->Administration_model->Get_amenities();
                foreach ($amenities as $item) {
                    $options .= '<option value="' . $item->id . '">' . $item->NAME . '</option>';
                }
                break;
            case 2:
                $services = $this->Administration_model->Get_Services();
                foreach ($services as $item) {
                    $options .= '<option value="' . $item->id . '">' . $item->NAME . '</option>';
                }
                break;
            case 3:
                echo $options = '';
                break;
        }
        echo $options;
    }
  
		function material_search(){
		    $term=$this->input->post('term');
			$products = $this->Administration_model->getProductNames($term);
			echo  json_encode($products);
		}
		function  stockcheck(){
			$qty=$this->input->post('qty');
			$product_id=$this->input->post('productid');
			$stock_in= $this->Administration_model->stockCheck($qty,$product_id);
		   if(!empty($stock_in)){
			   echo 1;
		   }else{
			   echo  0;
		   }
		}
		function productSelect(){
		    $productid=$this->input->post('productid');
			$products = $this->Administration_model->getProductitem($productid);
			$HTML='';
			$HTML .='<tr><td>'.$products->code ."-".$products->name .'</td><td class="text-center"><div class="qty"><span class="minus bg-dark">-</span><input type="number" class="count" name="qty[]" value="1"><span class="plus bg-dark">+</span></div></td><td class="cost">'.$products->mrp.'</td><td  class="totalcost">'.$products->mrp.'</td><td><input type="hidden" class="subtotal" name="subtotal[]" value="'.$products->mrp.'"><input type="hidden"  name="productid[]" id="productid" value="'.$products->id.'"><span class="glyphicon glyphicon-trash removeOption" onclick="removerow()" style="color:red;"></span></td></tr>';
			echo  $HTML;
		}
	
}
