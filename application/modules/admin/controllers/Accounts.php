<?php

class Accounts extends Admin_Controller {
 private $newTransactionBalance;
	function __construct(){
		parent::__construct();
		$this->load->model(array('Account_model','payroll/global_model','Tenant_model'));
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('datatables');
	}
	function bill(){
		$admin = $this->session->userdata('admin');
		$data['page_title']	= lang('bill');
		$this->render_admin('Accounts/bill_list', $data);		
	}
	function view_bill($id,$tab=false){
		$admin = $this->session->userdata('admin');
		$data['page_title']	= lang('view')." ".lang('Accounts') ;
		$data['bill']		=	$bill		= $this->Account_model->get_bill($id);
		$data['project']	                = $this->Account_model->get_Project();
		$data['buildings']  =	$building   = $this->Account_model->get_building($bill->project_id);
		$data['owners']	    =	$owner		= $this->Account_model->get_OwnerbyBuilding($bill->project_id,$bill->building_id);
		$data['ownerunits']	=	$ownerunits	= $this->Account_model->get_Ownerunits($bill->project_id,$bill->building_id,$bill->Owner_id);
		$this->render_admin('Accounts/bill_view', $data);
	}   
	   function get_billList(){
		 $actions = "<div class=\"text-center\">";
		 $actions .= "<a href='" . base_url('admin/accounts/view_bill/$1') . "'  class='tip' ><i class=\"fa fa-eye\"></i></a> <a href='" . base_url('/admin/accounts/bill_form/$1') . "'  class='tip' ><i class=\"fa fa-edit\"></i></a> <a href='" . base_url('admin/accounts/bill_delete/$1') . "' class='tip po'  onclick='return areyousure(this)'><i class=\"fa fa-trash-o\"></i></a>";
		 $actions .= "</div>";
		  $this->load->library('datatables');
		  $this->datatables
		  ->select("bill_id,reference_no, owner.full_name ,Service_name,bill_date,Issued_date,total_amount,Paid_Status", FALSE)
		  ->from("add_bill")
		  ->join("owner","owner.ownid=add_bill.Owner_id","left")
		  ->join("services","services.id=add_bill.services_id","left")
		  ->where("add_bill.soft_delete",0)
		  ->add_column("Actions", $actions, "bill_id");
		   echo $this->datatables->generate();
   }
	 function bill_form($id = false){
		$data['page_title']		= lang('AddBill');
		$data['project']	            = $this->Account_model->get_Project();
	    $data['services_list']          = $this->db->get_where("services",array("Soft_delete"=>0))->result();
		$data['id']			            = '';
		$data['project_id']		        = '';
		$data['building_id']		    = '';
		$data['owner_id']			    = '';
		$data['unit_id']		        = '';
		$data['services']		        = '';
		$data['Issue_date']		        = '';
		$data['Bill_Date']		        = '';
		$data['Total_amount']	        ='';
		$data['Details']	            ='';
		$data['Paid_status']	        ='';
		$data['services_id']            ='';
		if ($id){	
			$data['bill']		=	$bill		= $this->Account_model->get_bill($id);
			$data['buildings']   =	$building   = $this->Account_model->get_building($bill->project_id);
			$data['owners']	    =	$owner		= $this->Account_model->get_OwnerbyBuilding($bill->project_id,$bill->building_id);
			$data['ownerunits']	=	$ownerunits	= $this->Account_model->get_Ownerunits($bill->project_id,$bill->building_id,$bill->Owner_id);
			if (!$bill){
				$this->session->set_flashdata('error', lang('bill_details_not_found'));
				redirect('admin/Accounts/bill');
			}
			$data['id']			            = $bill->bill_id;
		    $data['project_id']		        = $bill->project_id;
		    $data['building_id']		    = $bill->building_id;
		    $data['owner_id']			    = $bill->Owner_id;
			$data['unit_id']		        = $bill->owner_unit;
			$data['Issued_date']		    = $bill->Issued_date;
			$data['bill_date']		        = $bill->bill_date;
			$data['total_amount']	        = $bill->total_amount;
			$data['bill_details']	        = $bill->bill_details;
			$data['Paid_Status']	        = $bill->Paid_Status;
			$data['paid_from']	            = $bill->paid_from;
			$data['services_id']	        = $bill->services_id;
		}
		$this->form_validation->set_rules('project_id', 'lang:Paid_status', 'trim|required');
		$this->form_validation->set_rules('building_id', 'lang:building', 'trim|required');
		$this->form_validation->set_rules('owner_id', 'lang:Owner', 'trim|required');
		$this->form_validation->set_rules('Total_amount', 'lang:Total_amount', 'trim|required');
		$this->form_validation->set_rules('Issue_date', 'lang:Issue_date', 'trim|required');
		if ($this->form_validation->run() == FALSE){
			$this->render_admin('Accounts/bill_form', $data);		
		}
		else{
			$save['bill_id']	        = $this->input->post('id');
			$save['bill_date']	        = $this->input->post('Bill_Date');
			$save['total_amount']	    = $this->input->post('Total_amount');
			$save['bill_details']	    = $this->input->post('Details');
			$save['Issued_date']	    = $this->input->post('Issue_date');
			$save['Paid_Status']	    = lang('Paid_Unpaid');
			$save['Owner_id']	        = $this->input->post('owner_id');
			$save['owner_unit']	        = $this->input->post('unit_id');
			$save['project_id']	        = $this->input->post('project_id');
			$save['building_id']	    = $this->input->post('building_id');
			$save['services_id']	    = $this->input->post('services');
			if(empty($id)){
			$save['reference_no']       ='Bill_'.strtotime(date('Y/m/d H:i:s'));
			}
			$this->Account_model->bill_save($save);
			if($id){
				$this->session->set_flashdata('message', lang('bill_updated'));
			}else{
				$this->session->set_flashdata('message', lang('bill_saved'));
			}
			redirect('admin/Accounts/bill');
		}
	}
     public function get_owner(){
        $projectid = $this->input->post('project_id');
        $buildingid = $this->input->post('buildingid');
        $HTML = '<option value="">Select Owner</option>';
			$owner = $this->Account_model->get_OwnerbyBuilding($projectid,$buildingid);
        if ($owner) {
            foreach ($owner as $row) {
                $HTML .= "<option value='" . $row->ownid . "'>" . $row->full_name . "</option>";
            }
        } 
        echo $HTML;
     }
    public function get_owner_units(){
        $projectid = $this->input->post('project_id');
        $buildingid = $this->input->post('buildingid');
		$ownerid = $this->input->post('ownerid');
        $HTML = '<option value="">Select unit</option>';
	    $units = $this->Account_model->get_Ownerunits($projectid,$buildingid,$ownerid);
        if ($units) {
            foreach ($units as $row) {
                $HTML .= "<option value='" . $row->uid . "'>" . $row->unit_name . "</option>";
            }
        } 
        echo $HTML; 
    }
	function bill_delete($id){
		if ($id){	
			$bill	= $this->Account_model->get_bill($id);
			if (!$bill){
				$this->session->set_flashdata('error', lang('bill_details_not_found'));
				redirect('admin/Accounts/bill');
			}else{
				$delete	= $this->Account_model->bill_delete($id);
				$this->session->set_flashdata('message', lang('bill_details_deleted'));
				redirect('admin/Accounts/bill');
			}
		}else{
			    $this->session->set_flashdata('error', lang('bill_details_not_found'));
				redirect('admin/Accounts/bill');
		}
	}
	///bill payment
	 public function get_bills(){
        $billtype  = $this->input->post('billtype');
		$projectid = $this->input->post('ownerid');
		$ownerid   = $this->input->post('billtype');
		$unitid    = $this->input->post('unitid');
        $buildingid = $this->input->post('buildingid');
		$ownerid = $this->input->post('ownerid');
        $HTML = '<option value="">Select Bills</option>';
	    $bills = $this->Account_model->get_bills($billtype,$projectid,$buildingid,$ownerid,$unitid);
        if ($bills) {
            foreach ($bills as $row) {
                $HTML .= "<option value='" . $row->id . "'>" . $row->rfno . "</option>";
            }
        } 
        echo $HTML; 
    }
	function get_billAmount(){
		$billtype  = $this->input->post('billtype');
		$billid    = $this->input->post('billid');
	    $bills     = $this->Account_model->get_bills_details($billtype,$billid);
        echo json_encode($bills); 
		
	}
	function payment(){
		$admin = $this->session->userdata('admin');
		$data['page_title']	= lang('bill');
		$this->render_admin('Accounts/payment/payment_list', $data);
	}
	function view_payment($id,$tab=false){
		$admin = $this->session->userdata('admin');
		$data['page_title']	= lang('view')." ".lang('Accounts') ;
		$data['bill']		=	$bill		= $this->Account_model->get_bill($id);
		$data['project']	                = $this->Account_model->get_Project();
		$data['buildings']  =	$building   = $this->Account_model->get_building($bill->project_id);
		$data['owners']	    =	$owner		= $this->Account_model->get_OwnerbyBuilding($bill->project_id,$bill->building_id);
		$data['ownerunits']	=	$ownerunits	= $this->Account_model->get_Ownerunits($bill->project_id,$bill->building_id,$bill->Owner_id);
		$this->render_admin('Accounts/payment/payment_list', $data);
	}   
	   function get_payment_list(){
		 $actions = "<div class=\"text-center\">";
		 $actions .= "<a href='" . base_url('admin/accounts/payment_invoices/$1') . "'  class='tip' ><i class=\"glyphicon glyphicon-file\"></i></a> <a href='" . base_url('/admin/accounts/payment_form/$1') . "'  class='tip' ><i class=\"fa fa-edit\"></i></a> <a href='" . base_url('admin/accounts/payment_delete/$1') . "' class='tip po'  onclick='return areyousure(this)'><i class=\"fa fa-trash-o\"></i></a>";
		 $actions .= "</div>";
		  $this->load->library('datatables');
		  $this->datatables
		  ->select("id,reference_no,bill_refernceno, owner.full_name ,paid_form,bill_amount,paid_date", FALSE)
		  ->from("bill_payments")
		  ->join("owner","owner.ownid=bill_payments.ownerid","left")
		  ->where("bill_payments.soft_delete",0)
		  ->add_column("Actions", $actions, "id");
		   echo $this->datatables->generate();
		 
   }
	 function payment_form($id = false){
		$data['page_title']		        = lang('add_payment');
		$data['project']	            = $this->Account_model->get_Project();
	    $data['services_list']          = $this->db->get_where("services",array("Soft_delete"=>0))->result();
		$data['id']			            = '';
		$data['paid_form']		        = '';
		$data['projectid']		        = '';
		$data['buildingid']		        = '';
		$data['ownerid']			    = '';
		$data['unitid']		            = '';
		$data['billtype']		        = '';
		$data['bill_refernceno']		= '';
		$date['bill_id']	            = '';
		$data['bill_amount']		    = '';
		$data['paid_amount']	        = '';
		$data['paid_date']	            = '';
		$data['paid_type']	            = '';
		$data['note']	                = '';
		
		if ($id){	
	     	$data['page_title'] = lang('edit_payment');
			$data['bill']		=	$bill		= $this->Account_model->get_billpayment($id);
			$data['buildings']  =	$building   = $this->Account_model->get_building($bill->projectid);
			$data['owners']	    =	$owner		= $this->Account_model->get_OwnerbyBuilding($bill->projectid,$bill->buildingid);
			$data['ownerunits']	=	$ownerunits	= $this->Account_model->get_Ownerunits($bill->projectid,$bill->buildingid,$bill->ownerid);
			$data['billlist']	= $this->Account_model->get_Ownerbilllist($bill->projectid,$bill->buildingid,$bill->ownerid,$bill->billtype,$bill->bill_id);
			if (!$bill){
				$this->session->set_flashdata('error', lang('payment_details_not_found'));
				redirect('admin/Accounts/bill');
			}
			$data['id']			            = $bill->id;
			$data['paid_form']		        = $bill->paid_form;
		    $data['projectid']		        = $bill->projectid;
		    $data['buildingid']		        = $bill->buildingid;
		    $data['ownerid']			    = $bill->ownerid;
			$data['unitid']		            = $bill->unitid;
			$data['billtype']		        = $bill->billtype;
			$data['bill_refernceno']		= $bill->bill_refernceno;
			$data['bill_id']	            = $bill->bill_id;
			$data['bill_amount']	        = $bill->bill_amount;
			$data['paid_amount']	        = $bill->paid_amount;
			$data['paid_date']	            = $bill->paid_date;
			$data['paid_type']              = json_decode($bill->paid_type);
			$data['note']	                = $bill->note;
			
		}
		$this->form_validation->set_rules('project_id', 'lang:Paid_status', 'trim|required');
		$this->form_validation->set_rules('building_id', 'lang:building', 'trim|required');
		$this->form_validation->set_rules('owner_id', 'lang:Owner', 'trim|required');
		$this->form_validation->set_rules('Total_amount', 'lang:Total_amount', 'trim|required');
		if ($this->form_validation->run() == FALSE){
			$this->render_admin('Accounts/payment/payment_form', $data);		
		}
		else{
		    $save['id']	                = $this->input->post('id');
			$save['paid_form']	        = $this->input->post('paid_from');
			$save['projectid']	        = $this->input->post('project_id');
			$save['buildingid']	        = $this->input->post('building_id');
			$save['ownerid']	        = $this->input->post('owner_id');
			$save['unitid']	            = $this->input->post('unit_id');
			$save['billtype']	        = $this->input->post('billType');
			$save['bill_id']	        = $this->input->post('bill');
			$save['bill_refernceno']	= $this->input->post('bill_refernceno');
			$save['bill_amount']	    = $this->input->post('Total_amount');
			$save['paid_amount']	    = $this->input->post('paidamount');
			$save['paid_date']	        = $this->input->post('paid_date');
			$save['note']	            = $this->input->post('Note');
			  for ($i = 0; $i < count($this->input->post('cardholdername')); $i++) {
                if (!empty($_POST['cardholdername'][$i])) {
                    $paid_type[] = array(
                        'cardholdername' => $_POST['cardholdername'][$i],
                        'cardnumber' => $_POST['Cardnumber'][$i],
                        'expired' => $_POST['monthyears'][$i],
                        'cvv' => $_POST['cvv'][$i],
                    );
                }
            }
            if (!empty($card_details)) {
                $save['paid_type'] = json_encode($paid_type);
            }
			if(empty($id)){
			$save['reference_no']       ='INV_'.strtotime(date('Y/m/d H:i:s'));
			}
			$this->Account_model->billpayment_save($save);
			if($id){
				$this->session->set_flashdata('message', lang('payment_details_updated'));
			}else{
				$this->session->set_flashdata('message', lang('payment_details_saved'));
			}
			redirect('admin/Accounts/payment');
		}
	}
	
	function payment_invoices($id){
		$data['payment']		=	$payments		= $this->Account_model->get_billpayment($id);
		$data['bill_details']			= $this->Account_model->get_billdetails($payments->billtype,$payments->bill_id);
		$this->render_admin('Accounts/payment/Invoiceview', $data);
	}
	function payment_delete(){
		if ($id){	
			$bill	= $this->Account_model->get_billpayment($id);
			if (!$bill){
				$this->session->set_flashdata('error', lang('payment_details_not_found'));
				redirect('admin/Accounts/payment');
			}else{
				$delete	= $this->Account_model->billpayment_delete($id);
				$this->session->set_flashdata('message', lang('payment_details_deleted'));
				redirect('admin/Accounts/payment');
			}
		}else{
			    $this->session->set_flashdata('error', lang('payment_details_not_found'));
				redirect('admin/Accounts/payment');
		}
		
	}
// accounts 	
	
	
   public function expense_categories(){
        $data['page_title'] = lang('expense_categories');
        $this->render_admin('Accounts/transaction/expense_category', $data);
    }
    public function get_expense_categories() {
        $actions = "<div class=\"text-center\">";
        $actions .= '<div class="btn-group"><a style="padding:6px;" class="btn btn-xs btn-default" href="javascript:void(0)" onclick="edit_title(' . "'" . '$1' . "'" . ')"><i class="fa fa-pencil"></i></a>
        		<a class="btn btn-xs btn-danger" style="margin-left:6px;padding:6px;" href="javascript:void(0)"  onclick="deleteItem(' . "'" . '$1' . "'" . ')"><i class="glyphicon glyphicon-trash"></i></a></div>';
        $actions .= "</div>";
        $this->datatables
            ->select("id  ,name ,  description ", false)
            ->from("accounts_category")
			->where("type",2)
			->where("soft_delete",0)
            ->add_column("Actions", $actions, "id");
        echo $this->datatables->generate();
    }
    public function edit_expense_catgory($id){
        $this->global_model->table = 'accounts_category';
        $data = $this->global_model->get_by_id($id);
        echo json_encode($data);
    }
    public function add_expense_category(){
        $this->global_model->table = 'accounts_category';
        $this->_expense_cate_validate();
        $data = array(
            'name' => $this->input->post('name'),
            'description' => $this->input->post('description'),
			'type' => 2
        );
        $insert = $this->global_model->save($data);
        echo json_encode(array("status" => true));
    }

    public function update_expenses_categories(){
        $this->global_model->table = 'accounts_category';
        $this->_expense_cate_validate();
        $data = array(
            'name' => $this->input->post('name'),
            'description' => $this->input->post('description'),
			'type' => 2
        );
        $this->global_model->update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => true));
    }
     public function income_categories(){
        $data['page_title'] = lang('income_categories');
        $this->render_admin('Accounts/transaction/income_category', $data);
     }
    public function get_income_categories() {
        $actions = "<div class=\"text-center\">";
        $actions .= '<div class="btn-group"><a style="padding:6px;" class="btn btn-xs btn-default" href="javascript:void(0)" onclick="edit_title(' . "'" . '$1' . "'" . ')"><i class="fa fa-pencil"></i></a>
        		<a class="btn btn-xs btn-danger" style="margin-left:6px;padding:6px;" href="javascript:void(0)"  onclick="deleteItem(' . "'" . '$1' . "'" . ')"><i class="glyphicon glyphicon-trash"></i></a></div>';
        $actions .= "</div>";
        $this->datatables
            ->select("id  ,name ,  description ", false)
            ->from("accounts_category")
			->where("type",1)
			->where("soft_delete",0)
            ->add_column("Actions", $actions, "id");
        echo $this->datatables->generate();
    }
    public function edit_income_catgory($id){
        $this->global_model->table = 'accounts_category';
        $data = $this->global_model->get_by_id($id);
        echo json_encode($data);
    }
    public function add_income_category(){
        $this->global_model->table = 'accounts_category';
        $this->_expense_cate_validate();
        $data = array(
            'name' => $this->input->post('name'),
            'description' => $this->input->post('description'),
			'type' => 1
        );
        $insert = $this->global_model->save($data);
        echo json_encode(array("status" => true));
    }

    public function update_income_categories(){
        $this->global_model->table = 'accounts_category';
        $this->_expense_cate_validate();
        $data = array(
            'name' => $this->input->post('name'),
            'description' => $this->input->post('description'),
			'type' => 1
        );
        $this->global_model->update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => true));
    }

    public function delete_category($id){
		 $result = count($this->db->get_where('accounts_transactions',array(
            'category_id' => $id
        ))->result());
        $category =  $this->db->get_where('accounts_category', array(
            'id' => $id))->row();
        if($category->type == 1){
            $url = 'admin/accounts/income_categories';
        }else{
            $url = 'admin/accounts/expense_categories';
        }
        if($result){
            $this->message->custom_error_msg($url, lang('record_has_been_used'));
        }else{
            $this->db->delete('accounts_category', array('id' => $id));
            echo 1;
        }
    }
    private function _expense_cate_validate(){
        $rules = array(
            array('field' => 'name', 'label' => lang('name'), 'rules' => 'trim|required'),
            array('field' => 'description', 'label' => lang('description'), 'rules' => 'trim|required'),
        );
        $this->global_model->validation($rules);
    }
	  function get_transaction_category(){
		  $HTML='';
        $type = $this->input->post('type');
        if($type == 'Deposit' || $type == 'AR'){
            $id = 1;
        }else{
            $id = 2;
        }
        $category = $this->db->order_by('name', 'asc')->get_where('accounts_category', array(
                            'type' => $id
                        ))->result();
        if ($category) {
            foreach ($category as $item) {
               $HTML.="<option value='" . $item->id . "'>" . $item->name. "</option>";
            }
        }
        echo $HTML;
    }
	  function chartOfAccount(){
        $account_type = $this->db->get('accounts_type')->result();
         foreach($account_type as $type){
            $tem_head = $this->db->select('accounts_head.*,accounts_type.account_type')
                ->from('accounts_head')
                ->join('accounts_type', 'accounts_head.account_type_id = accounts_type.id', 'left')
                ->where('accounts_head.account_type_id', $type->id)
                ->get()
                ->result();
            foreach($tem_head as $item){
               $result[] = $item;
            }
        }
        $data['accounts_head'] = $result; 
        $data['page_title'] = lang('chart_of_accounts');
        $this->render_admin('Accounts/transaction/chart_of_account',$data);
    }
	 public function edit_coa($id){
        $this->global_model->table = 'accounts_head';
        $data = $this->global_model->get_by_id($id);
        echo json_encode($data);
    }
    public function add_coa(){
        $this->global_model->table = 'accounts_head';
        $this->_coa_validate();
           $data['account_title']      = $this->input->post('account_title');
            $data['description']        = $this->input->post('description');
            $data['account_number']     = $this->input->post('account_number');
            $data['phone']              = $this->input->post('phone');
            $data['address']            = $this->input->post('address');
            $data['account_type_id']    = 1;
        $insert = $this->global_model->save($data);
        echo json_encode(array("status" => true));
    }

    public function update_coa(){
        $this->global_model->table = 'accounts_head';
        $this->_coa_validate();
		   $data['account_title']      = $this->input->post('account_title');
            $data['description']        = $this->input->post('description');
            $data['account_number']     = $this->input->post('account_number');
            $data['phone']              = $this->input->post('phone');
            $data['address']            = $this->input->post('address');
            $data['account_type_id']    = 1;
       
        $this->global_model->update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => true));
    }
 function delete_coa($id = null){
        $id == TRUE || $this->message->norecord_found('admin/accounts/chartOfAccount');
        $result = $this->db->get_where('accounts_transactions',array(
            'account_id' => $id
        ))->row();
        if($result){
            $this->message->custom_error_msg('admin/transaction/chartOfAccount', lang('record_has_been_used'));
        }else{
			$this->db->where('id',$id);
            $this->db->update('accounts_head', array('soft_delete' => 1));
            $this->message->delete_success('admin/accounts/chartOfAccount');
        }
    }
    
    private function _coa_validate(){
        $rules = array(
            array('field' => 'account_title', 'label' => lang('account_title'), 'rules' => 'trim|required'),
            array('field' => 'description', 'label' => lang('description'), 'rules' => 'trim|required'),
			array('field' => 'account_number', 'label' => lang('account_number'), 'rules' => 'trim|required'),
            array('field' => 'phone', 'label' => lang('phone'), 'rules' => 'trim|required'),
			array('field' => 'address', 'label' => lang('address'), 'rules' => 'trim|required'),
        );
        $this->global_model->validation($rules);
    }
	function transactionlist(){
		 $data['page_title'] = lang('transaction_list');
		  $data['account'] = $this->db->get('accounts_head')->result();
        $this->render_admin('Accounts/transaction/transaction_list', $data);
	}
	   function get_transactionlist(){
		    $actions = "<div class=\"text-center\">";
		    $actions .= " <a href='" . base_url('/admin/accounts/editTransaction/$1') . "'  class='tip' ><i class=\"fa fa-edit\"></i></a> <a href='" . base_url('admin/accounts/deleteTransaction/$1') . "' class='tip po'  onclick='return areyousure(this)'><i class=\"fa fa-trash-o\"></i></a>";
		    $actions .= "</div>";
		    $this->load->library('datatables');
		    $this->datatables
		   ->select("accounts_transactions.id ,transaction_id,accounts_head.account_title,transaction_type,accounts_category.name,amount,amount cr,accounts_transactions.balance,DATE(date_time),transaction_type_id,account_id,category_id", FALSE)
		   ->from("accounts_transactions")
		   ->join('accounts_head', 'accounts_head.id = accounts_transactions.account_id','left')
           ->join('accounts_category', 'accounts_category.id = accounts_transactions.category_id','left')
		   ->where("accounts_transactions.soft_delete",0)
		   ->add_column("Actions", $actions, "accounts_transactions.id");
		   echo $this->datatables->generate();
   }
	function addTransaction(){
        $data['page_title']= lang('add_transaction');
        $data['account'] = $this->db->get_where('accounts_head', array(
                                        'account_type_id' => 1
                                    ))->result();
        $this->render_admin('Accounts/transaction/add_transactions',$data);
    }

    function save_transaction(){
       $transaction_type = $this->input->post('transaction_type');
        $this->form_validation->set_rules('transaction_type', lang('transaction_type'), 'trim|required|xss_clean');
        if($transaction_type == 'Deposit' || $transaction_type == 'Expenses' ) {
            $this->form_validation->set_rules('account', lang('account'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('payment_method', lang('payment_method'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('category_id', lang('category'), 'trim|required|xss_clean');
        }elseif($transaction_type == 'TR'){
            $this->form_validation->set_rules('from_account', lang('from_account'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('to_account', lang('to_account'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('payment_method', lang('payment_method'), 'trim|required|xss_clean');
        }else{
            $this->form_validation->set_rules('category_id', lang('category'), 'trim|required|xss_clean');
        }
        $this->form_validation->set_rules('amount', lang('amount'), 'trim|required|xss_clean|numeric');
        $this->form_validation->set_rules('description', lang('description'), 'trim|required|xss_clean');
        if ($this->form_validation->run() == TRUE) {
            if($transaction_type == 'Deposit' || $transaction_type == 'Expenses' ) {
                $data['account_id']             = $this->input->post('account');
                $data['payment_method']         = $this->input->post('payment_method');
                $data['category_id']            = $this->input->post('category_id');
            }elseif($transaction_type == 'TR'){
                $from_account_id                = $this->input->post('from_account');
                $to_account_id                     = $this->input->post('to_account');
                $data['payment_method']         = $this->input->post('payment_method');
                if($from_account_id == $to_account_id) {
                    $this->message->custom_error_msg('admin/accounts/addTransaction', lang('same_account_transfer_not_allowed'));
                }
            }else{
                $data['category_id']            = $this->input->post('category_id');
            }
            if($transaction_type == 'AP'){
                $data['account_id']    = 4;
            }elseif($transaction_type == 'AR'){
                $data['account_id']    = 2;
            }
                $transaction_type = $this->_transaction_type($transaction_type);
                $data['transaction_type_id'] = $transaction_type[0];
                $data['transaction_type'] = $transaction_type[1];
            $data['amount']                     = floatval($this->input->post('amount'));
            $data['ref']                        = $this->input->post('ref');
            $data['description']                = $this->input->post('description');
            if($data['transaction_type_id'] == 3){//Accounts Payable(A/P)
                $balance = $this->db->get_where('accounts_head', array(
                    'id' => 4
                ))->row()->balance;

                $data['balance']            = $balance + $data['amount'];
                $accounts_head['balance']    = $balance + $data['amount'];

                $this->db->where('id', 4);
                $this->db->update('accounts_head', $accounts_head);

            }elseif($data['transaction_type_id'] == 4){//Accounts Receivable(A/R)
                $balance = $this->db->get_where('accounts_head', array(
                    'id' => 2
                ))->row()->balance;

                $data['balance']            = $balance + $data['amount'];
                $accounts_head['balance']    = $balance + $data['amount'];

                $this->db->where('id', 2);
                $this->db->update('accounts_head', $accounts_head);

            }elseif($data['transaction_type_id'] == 5){//Transfer Balance

                $from_account_balance = $this->db->get_where('accounts_head', array(
                    'id' => $from_account_id
                ))->row()->balance;

                $to_account_balance = $this->db->get_where('accounts_head', array(
                    'id' => $to_account_id
                ))->row()->balance;

                $data_form['balance']            = $from_account_balance - $data['amount'];
                $data_to['balance']              = $to_account_balance + $data['amount'];

                $this->db->where('id', $from_account_id);
                $this->db->update('accounts_head', $data_form);

                $this->db->where('id', $to_account_id);
                $this->db->update('accounts_head', $data_to);
            }else{//account
                $balance = $this->db->get_where('accounts_head', array(
                    'id' => $data['account_id']
                ))->row()->balance;

                if($data['transaction_type_id'] == 1)
                {
                    //Deposit
                    $data['balance']            = $balance + $data['amount'];
                    $accounts_head['balance']    = $balance + $data['amount'];

                    $this->db->where('id', $data['account_id']);
                    $this->db->update('accounts_head', $accounts_head);
                }

                if($data['transaction_type_id'] == 2)
                {
                    //Expenses
                    $data['balance']            = $balance - $data['amount'];
                    $accounts_head['balance']    = $balance - $data['amount'];

                    $this->db->where('id', $data['account_id']);
                    $this->db->update('accounts_head', $accounts_head);
                }

            }


            if($data['transaction_type_id'] != 5) {
                $this->db->insert('accounts_transactions', $data);

                $id = $this->db->insert_id();
                $prefix = TRANSACTION_PREFIX;
                $transaction_id['transaction_id'] = $prefix + $id;

                $this->db->where('id', $id);
                $this->db->update('accounts_transactions', $transaction_id);
            }else{
                //from account Transfer
                $this->db->insert('accounts_transactions', $data);
                $trn_from_id = $this->db->insert_id();
                $prefix = TRANSACTION_PREFIX;
                $data_form['transaction_id'] = $prefix + $trn_from_id;
                $data_form['transaction_type']      = lang('transfer');
                $data_form['transaction_type_id']   = 5 ;
                $data_form['account_id']   = $from_account_id ;
                $data_form['category_id']   = 99 ;

                $this->db->where('id', $trn_from_id);
                $this->db->update('accounts_transactions', $data_form);

                //to account Transfer
                $this->db->insert('accounts_transactions', $data);
                $trn_to_id = $this->db->insert_id();
                $prefix = TRANSACTION_PREFIX;
                $data_to['transaction_id'] = $prefix + $trn_to_id;
                $data_to['transaction_type']        = lang('deposit');
                $data_to['transaction_type_id']     = 1 ;
                $data_to['account_id']              = $to_account_id ;
                $data_to['category_id']             = 99 ;
                $this->db->where('id', $trn_to_id);
                $this->db->update('accounts_transactions', $data_to);

                $ref = array(
                    array(
                        'id' => $trn_from_id,
                        'transfer_ref' => $data_to['transaction_id']
                    ),
                    array(
                        'id' => $trn_to_id ,
                        'transfer_ref' => $data_form['transaction_id']
                    )
                );
                $this->db->update_batch('accounts_transactions',$ref, 'id');
            }
            $this->message->save_success('admin/accounts/transactionlist');
        } else {
            $error = validation_errors();;
            $this->message->custom_error_msg('admin/accounts/addTransaction',$error);
        }
    }

    function _transaction_type($prm)
    {
        /* @transaction_type
         *
         * Deposit
         * Expense
         * Accounts Payable
         * Accounts Payable
         *
         * @transaction_type_id
         *
         * 1 = Deposit
         * 2 = Expense
         * 3 = Accounts Payable(A/P)
         * 4 = Accounts Receivable(A/R)
         *
         * */

        switch ($prm) {
            case "Deposit":
                $transaction[0] = '1';
                $transaction[1] = lang('deposit');
                return $transaction;
                break;
            case "Expenses":
                $transaction[0] = '2';
                $transaction[1] = lang('expense');
                return $transaction;
                break;
            case "AP":
                $transaction[0] = '3';
                $transaction[1] = 'A/P';

                return $transaction;
                break;
            case "AR":
                $transaction[0] = '4';
                $transaction[1] = 'A/R';
                return $transaction;
                break;
            case "TR":
                $transaction[0] = '5';
                $transaction[1] = lang('account_transfer');
                return $transaction;
                break;

        }
    }

   
    //    view transaction
    function viewTransaction($id = null)
    {
        if(!empty($id)) {
            $prm = explode("-", $id);
            $data['column'] = $prm[0] . '_id';
            $data['id'] = $prm[1];
			if($data['column'] == 'account_id'){
                $result = $this->db->get_where('accounts_head', array(
                    'id' => $data['id']
                ))->row()->account_title;
                if(empty($result)){
                    $this->message->custom_error_msg('admin/accounts/transactionlist', lang('no_record_found'));
                }
            }
            elseif($data['column'] == 'transaction_type_id'){
                $result = $this->db->get_where('accounts_transactions', array(
                    'transaction_type_id' => $data['id']
                ))->row()->transaction_type;
                if(empty($result)){
                    $this->message->custom_error_msg('admin/accounts/transactionlist',lang('no_record_found'));
                }
            }
            elseif($data['column'] == 'category_id'){
                $result = $this->db->get_where('accounts_category', array(
                    'id' => $data['id']
                ))->row()->name;
                if(empty($result)){
                    $this->message->custom_error_msg('admin/accounts/transactionlist',lang('no_record_found'));
                }
            }else{
                $this->message->custom_error_msg('admin/accounts/transactionlist',lang('no_record_found'));
            }
			}else{
            $this->message->custom_error_msg('admin/accounts/transactionlist',lang('no_record_found'));
        }
        $data['modal'] = FALSE;
        $data['title'] = $result;
        $data['page_title']=lang('view_transaction');
		//$data['table_data']= $this->transaction_view($id);
        $this->render_admin('Accounts/transaction/transaction_view',$data);
    }
    function view($id){
        $result = $this->db->select('accounts_transactions.*, accounts_head.account_title, accounts_category.name as category_name ')
            ->from('accounts_transactions')
            ->join('accounts_head', 'accounts_head.id = accounts_transactions.account_id', 'left')
            ->join('accounts_category', 'accounts_category.id = accounts_transactions.category_id', 'left')
            ->where('accounts_transactions.id', $id)
            ->get()
            ->row();
        $result == TRUE || $this->message->norecord_found('admin/transaction/allTransaction');
        if(!empty($result->transfer_ref)){
            $transfer_form = $this->db->select('accounts_transactions.*, accounts_head.account_title, accounts_category.name as category_name ')
                ->from('accounts_transactions')
                ->join('accounts_head', 'accounts_head.id = accounts_transactions.account_id', 'left')
                ->join('accounts_category', 'accounts_category.id = accounts_transactions.category_id', 'left')
                ->where('accounts_transactions.transaction_id', $result->transfer_ref)
                ->get()
                ->row();
            $data['transaction_from'] = $transfer_form;
        }

        $data['transaction'] = $result;
        $data['account'] = $this->db->get_where('accounts_head', array(
            'account_type_id' => 1
        ))->result();
        $data['page_title'] = lang('view_transaction');
        $this->render_admin('Accounts/transaction/view_transaction',$data);
    }
	

    function update_transaction(){
		  $id =$this->input->post('id');
        $result = $this->db->get_where('accounts_transactions', array(
            'id' => $id
        ))->row();
        $result == TRUE || $this->message->norecord_found('admin/accounts/transactionlist');
        $this->form_validation->set_rules('description', lang('description'), 'trim|required|xss_clean');
        if($result->transaction_type_id == 3 || $result->transaction_type_id == 4){
            $this->form_validation->set_rules('account', lang('account'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('payment_method', lang('payment_method'), 'trim|required|xss_clean');
        }
        if ($this->form_validation->run() == TRUE) {
            if($result->transaction_type_id == 3 || $result->transaction_type_id == 4){
                //account head select
                $balance = $this->db->get_where('accounts_head', array(
                    'id' => $result->account_id
                ))->row()->balance;

                $accountHeadBalance['balance'] = $balance - $result->amount;
                //update account head
                $this->db->where('id', $result->account_id);
                $this->db->update('accounts_head', $accountHeadBalance);

                //select all transaction will effected
                $affectedRow = $this->db->select("*")
                    ->from('accounts_transactions')
                    ->where('id >', $id)
                    ->order_by('id', 'asc')
                    ->get()
                    ->result();

                $this->newTransactionBalance = $result->balance - $result->amount;
                $this->_adjust_balance_other($affectedRow, $result);

                //create new transaction
                $data['account_id'] = $this->input->post('account');
                $data['payment_method'] = $this->input->post('payment_method');
                $result->transaction_type_id == 3 ? $data['transaction_type'] = 'Expenses' : $data['transaction_type'] = 'Deposit';

                $accountBalance = $this->db->get_where('accounts_head', array(
                    'id' => $data['account_id']
                ))->row()->balance;

                if($result->transaction_type_id == 3){//expense
                    $data['transaction_type'] = 'Expenses';
                    $data['transaction_type_id'] = 2;
                    $data['balance'] = $accountBalance - $result->amount;
                    $newHeadBalance['balance'] = $accountBalance - $result->amount;

                }else{//deposit
                    $data['transaction_type'] = 'Deposit';
                    $data['transaction_type_id'] = 1;
                    $data['balance'] = $accountBalance + $result->amount;
                    $newHeadBalance['balance'] = $accountBalance + $result->amount;
                }
                $data['category_id'] = $result->category_id;
                $data['amount'] = $result->amount;

                //insert transaction
                $this->db->insert('accounts_transactions', $data);

                $id = $this->db->insert_id();
                $prefix = TRANSACTION_PREFIX;
                $transaction_id['transaction_id'] = $prefix + $id;

                $this->db->where('id', $id);
                $this->db->update('accounts_transactions', $transaction_id);

                //update new account balance
                $this->db->where('id', $data['account_id']);
                $this->db->update('accounts_head', $newHeadBalance);

                //delete transaction
                $this->db->delete('accounts_transactions', array('id' => $result->id));


            }else{
                $data['description'] = $this->input->post('description');
                $data['ref'] = $this->input->post('ref');

                //update
                $this->db->where('id', $result->id);
                $this->db->update('accounts_transactions', $data);

            }

            $this->message->save_success('admin/accounts/transactionlist');
        } else {
            $error = validation_errors();;
            $this->message->custom_error_msg('admin/accounts/editTransaction/'.$id,$error);
        }
    }


    public function transaction_view($id){
        $prm = explode("-", $id);
        $column = $prm[0];
        $id = $prm[1];
        $this->global_model->table = 'accounts_transactions';
        $this->global_model->col = $column;
        $this->global_model->colId = $id;
        $this->global_model->order = array('id' => 'desc');
        $list = $this->global_model->get_transactions_dataTables($column,$id);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $item->transaction_id;
            if($column != 'account_id') {
                $row[] = '<a href="'. site_url('admin/accounts/viewTransaction/account-'.$item->account_id) .'">'.$item->account_name.'</a>';
            }
            if($column != 'transaction_type_id') {
                $row[] = '<a href="'. site_url('admin/accounts/viewTransaction/transaction_type-'.$item->transaction_type_id) .'">'.$item->transaction_type.'</a>';
            }
            if($column != 'category_id') {
                $row[] = '<a href="'. site_url('admin/accounts/viewTransaction/category-'.$item->category_id) .'">'.$item->category_name .'</a>';
            }
            //$row[] =$column;

            if($item->transaction_type_id == 1 || $item->transaction_type_id == 4){
                $row[] = '<span class="dr">'.$this->localization->currencyFormat($item->amount).'</span>';
            }else{
                $row[] = '<span class="dr">'.$this->localization->currencyFormat(0).'</span>';
            }

            if($item->transaction_type_id == 2 || $item->transaction_type_id == 3 || $item->transaction_type_id == 5 ){
                $row[] = '<span class="cr">'.$this->localization->currencyFormat($item->amount).'</span>';
            }else{
                $row[] = '<span class="cr">'.$this->localization->currencyFormat(0).'</span>';
            }
            $row[] = '<span class="balance">'.$this->localization->currencyFormat($item->balance).'</span>';
            $row[] = $this->localization->dateFormat($item->date_time);
            //add html for action
            $row[] = '<div class="btn-group"><a class="btn btn-xs btn-default" href="'.site_url('admin/transaction/editTransaction/'.$item->id).'" ><i class="fa fa-pencil"></i></a>
				  <a class="btn btn-xs btn-danger" onClick="return confirm(\'Are you sure you want to delete?\')" href="'.site_url('admin/transaction/deleteTransaction/'.$item->id).'" >
				  <i class="glyphicon glyphicon-trash"></i></a></div>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->global_model->count_all_transactions(),
            "recordsFiltered" => $this->global_model->count_filtered_transactions(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    function searchTransactions(){
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $account_id = $this->input->post('account');
        $transaction_type = $this->input->post('transaction_type');
        $this->mViewData['search'] = array(
                                        'start_date' => $start_date,
                                        'end_date' => $end_date,
                                        'account_id' => $account_id,
                                        'transaction_type' => $transaction_type,
                                    );
        $result = $this->_search_transactions($start_date, $end_date, $account_id, $transaction_type );
        $this->mViewData['transactions'] = $result;
        $this->mViewData['account'] = $this->db->get('accounts_head')->result();
        $this->mTitle .= lang('search_transaction');
        $this->render('transaction/search');
    }

    private function _search_transactions($start_date = null, $end_date=null, $account_id = null, $transaction_type = null)
    {
        $this->db->select('accounts_transactions.*, accounts_head.account_title, transaction_category.name', false);
        $this->db->from('accounts_transactions');
        $this->db->join('accounts_head', 'accounts_head.id  =  accounts_transactions.account_id', 'left');
        $this->db->join('transaction_category', 'transaction_category.id  =  accounts_transactions.category_id', 'left');
        if(!empty($start_date) && !empty($end_date)){
            $start_date = date('Y-m-d', strtotime($start_date));
            $end_date = date('Y-m-d', strtotime($end_date));
            if ($start_date == $end_date) {
                $this->db->like('accounts_transactions.date_time', $start_date);
            } else {
                $this->db->where('accounts_transactions.date_time >=', $start_date);
                $this->db->where('accounts_transactions.date_time <=', $end_date.' '.'23:59:59');
            }
        }elseif(!empty($start_date)){
            $start_date = date('Y-m-d', strtotime($start_date));
            $this->db->like('accounts_transactions.date_time', $start_date);
        }elseif(!empty($end_date)){
            $end_date = date('Y-m-d', strtotime($end_date));
            $this->db->like('accounts_transactions.date_time', $end_date);
        }
        if(!empty($account_id)){
            $this->db->where('accounts_transactions.account_id', $account_id);
        }
        if(!empty($transaction_type)){
            $this->db->where('accounts_transactions.transaction_type_id', $transaction_type);
        }
        $query_result = $this->db->get();
        $result = $query_result->result();

        return $result;
    }

    function deleteTransaction($id=null)
    {
        //select all transaction will effected
        $result = $this->db->select("*")
            ->from('accounts_transactions')
            ->where('id >', $id)
            ->order_by('id', 'asc')
            ->get()
            ->result();
        //select delete transaction row
        $transaction = $this->db->get_where('accounts_transactions', array(
            'id' => $id
        ))->row();
        $transaction == TRUE || $this->message->norecord_found('admin/accounts/transactionlist');
        /**
         * @deposit balance adjustment
         *
         * @deposit deduct from accounts head
         * @select delete transaction row amount and balance
         * @newTransactionBalance = balance - amount
         * @adjustTransactionBalance
         *
         * @deposit     =1
         * @expense     =2
         * @AP          =3
         * @AR          =4
         * @transfer    =5
         *
         */

        //Account head select
        $account_balance = $this->db->get_where('accounts_head', array(
            'id' => $transaction->account_id
        ))->row()->balance;

        if($transaction->transaction_type_id == 1){//deposit
            $accountBalance['balance'] = $account_balance - $transaction->amount;
            $this->db->where('id', $transaction->account_id);
            $this->db->update('accounts_head', $accountBalance);
            //Batch Update
            $this->newTransactionBalance = $transaction->balance - $transaction->amount;
            $this->_adjust_balance($result, $transaction);
            //Delete transactions
            $this->db->delete('accounts_transactions', array('id' => $id));
            //if account transfer has
            if(!empty($transaction->transfer_ref)){
                //Batch Update
                $this->_transfer_adjestment($transaction->transfer_ref);
            }
        }elseif($transaction->transaction_type_id == 2 || $transaction->transaction_type_id == 5){//expense and transfer
            $accountBalance['balance'] = $account_balance + $transaction->amount;
            $this->db->where('id', $transaction->account_id);
            $this->db->update('accounts_head', $accountBalance);
            //Batch Update
            $this->newTransactionBalance = $transaction->balance + $transaction->amount;
            $this->_adjust_balance($result, $transaction);
            //Delete transactions
            $this->db->delete('accounts_transactions', array('id' => $id));
            //if account transfer has
            if(!empty($transaction->transfer_ref)){
                $this->_transfer_adjestment($transaction->transfer_ref);
            }
        }elseif($transaction->transaction_type_id == 3 || $transaction->transaction_type_id == 4){//accounts payables
            $accountBalance['balance'] = $account_balance - $transaction->amount;
            $this->db->where('id', $transaction->account_id);
            $this->db->update('accounts_head', $accountBalance);
            //Batch Update
            $this->newTransactionBalance = $transaction->balance - $transaction->amount;
            $this->_adjust_balance_other($result, $transaction);
            //Delete transactions
            $this->db->delete('accounts_transactions', array('id' => $id));
        }
        $this->message->delete_success('admin/acounts/transactionlist');
    }

    private function _adjust_balance($result, $transaction){
        foreach($result as $item){
            if($transaction->account_id == $item->account_id ) {
                if ($item->transaction_type_id == 1) {
                    $this->newTransactionBalance += $item->amount;
                    $transUpdate[] = array(
                        'id' => $item->id,
                        'balance' => $this->newTransactionBalance,
                    );
                } elseif ($item->transaction_type_id == 2 || $item->transaction_type_id == 5) {
                    $this->newTransactionBalance -= $item->amount;
                    $transUpdate[] = array(
                        'id' => $item->id,
                        'balance' => $this->newTransactionBalance,
                    );
                }
            }
        }
        if(!empty($transUpdate)){
            $this->db->update_batch('accounts_transactions',$transUpdate, 'id');
        }
    }

    private function _transfer_adjestment($transfer_ref){
        $transfer = $this->db->get_where('accounts_transactions', array(
            'transaction_id' => $transfer_ref
        ))->row();
        $result = $this->db->select("*")
            ->from('accounts_transactions')
            ->where('id >', $transfer->id)
            ->order_by('id', 'asc')
            ->get()
            ->result();
        //account head
        $account_balance = $this->db->get_where('accounts_head', array(
            'id' => $transfer->account_id
        ))->row()->balance;
        if($transfer->transaction_type_id == 5){
            $accountBalance['balance'] = $account_balance + $transfer->amount;
            $this->newTransactionBalance = $transfer->balance + $transfer->amount;
        }else{
            $accountBalance['balance'] = $account_balance - $transfer->amount;
            $this->newTransactionBalance = $transfer->balance - $transfer->amount;
        }
        //update account head
        $this->db->where('id', $transfer->account_id);
        $this->db->update('accounts_head', $accountBalance);
        foreach($result as $item){
            if($transfer->account_id == $item->account_id ) {
                if ($item->transaction_type_id == 1) {
                    $this->newTransactionBalance += $item->amount;
                    $transUpdate[] = array(
                        'id' => $item->id,
                        'balance' => $this->newTransactionBalance,
                    );
                } elseif ($item->transaction_type_id == 2 || $item->transaction_type_id == 5) {
                    $this->newTransactionBalance -= $item->amount;
                    $transUpdate[] = array(
                        'id' => $item->id,
                        'balance' => $this->newTransactionBalance,
                    );
                }
            }
        }
        //Delete transactions
        $this->db->delete('accounts_transactions', array('id' => $transfer->id));

        if(!empty($transUpdate)){
            //return $transUpdate;
            $this->db->update_batch('accounts_transactions',$transUpdate, 'id');
        }

    }

    private function _adjust_balance_other($result, $transaction){
        foreach($result as $item){
            if($transaction->account_id == $item->account_id ) {
                if ($item->transaction_type_id == 1 || $item->transaction_type_id == 3 || $item->transaction_type_id == 4 ) {
                    $this->newTransactionBalance += $item->amount;
                    $transUpdate[] = array(
                        'id' => $item->id,
                        'balance' => $this->newTransactionBalance,
                    );
                } elseif ($item->transaction_type_id == 2) {
                    $this->newTransactionBalance -= $item->amount;
                    $transUpdate[] = array(
                        'id' => $item->id,
                        'balance' => $this->newTransactionBalance,
                    );
                }
            }
        }
        if(!empty($transUpdate)){
            $this->db->update_batch('accounts_transactions',$transUpdate, 'id');
        }
    }

    function editTransaction($id){
        $result = $this->db->select('accounts_transactions.*, accounts_head.account_title, accounts_category.name as category_name ')
            ->from('accounts_transactions')
            ->join('accounts_head', 'accounts_head.id = accounts_transactions.account_id', 'left')
            ->join('accounts_category', 'accounts_category.id = accounts_transactions.category_id', 'left')
            ->where('accounts_transactions.id', $id)
            ->get()
            ->row();
        $result == TRUE || $this->message->norecord_found('admin/transaction/allTransaction');
        if(!empty($result->transfer_ref)){
            $transfer_form = $this->db->select('accounts_transactions.*, accounts_head.account_title, accounts_category.name as category_name ')
                ->from('accounts_transactions')
                ->join('accounts_head', 'accounts_head.id = accounts_transactions.account_id', 'left')
                ->join('accounts_category', 'accounts_category.id = accounts_transactions.category_id', 'left')
                ->where('accounts_transactions.transaction_id', $result->transfer_ref)
                ->get()
                ->row();
            $data['transaction_from'] = $transfer_form;
        }
        $data['transaction'] = $result;
        $data['account'] = $this->db->get_where('accounts_head', array(
            'account_type_id' => 1
        ))->result();
        $data['page_title']= lang('edit_transaction');
        $this->render_admin('Accounts/transaction/edit_transaction',$data);
    }

    function editAccount($id = null){
        $id = $this->encrypt->decode(str_replace(array('-', '_', '~'), array('+', '/', '='), $id));
        $result = $this->db->get_where('accounts_head',array(
                    'id' => $id
                  ))->row();
        $result == TRUE || $this->message->norecord_found('admin/transaction/chartOfAccount');
        $data['account'] = $result;

        $data['modal_subview'] = $this->load->view('admin/transaction/_modals/add_account',$data, FALSE);
        $this->load->view('admin/_partials/_layout_modal_small', $data);
    }

    function deleteAccount($id = null){
        $id = $this->encrypt->decode(str_replace(array('-', '_', '~'), array('+', '/', '='), $id));
        $id == TRUE || $this->message->norecord_found('admin/transaction/chartOfAccount');

        $result = $this->db->get_where('accounts_transactions',array(
            'account_id' => $id
        ))->row();

        if($result){
            $this->message->custom_error_msg('admin/transaction/chartOfAccount', lang('record_has_been_used'));
        }else{
            $this->db->delete('accounts_head', array('id' => $id));
            $this->message->delete_success('admin/transaction/chartOfAccount');
        }
    }


    //============================================================
    //************************Income Categories*******************
    //============================================================

   public function rentallist(){
        $data['page_title'] = lang('rental_collection_list');
        $this->render_admin('Accounts/rent/rent_list', $data);
    }
    public function get_rentallist() {
       $actions = "<div class=\"text-center\">";
		 $actions .= "<a href='" . base_url('admin/accounts/rental_details/$1') . "'  class='tip' ><i class=\"fa fa-eye\"></i></a> <a href='" . base_url('/admin/accounts/rental_delete/$1') . "'  class='tip' ><i class=\"glyphicon glyphicon-trash\"></i></a> ";
		 $actions .= "</div>";
         $this->datatables
		   ->select("unit_rental.id,full_name,project.Name,building_info.name building,floors.name floor,unit_no ,due_date,total_rental_amount amount,payment_status
		  ", FALSE)
		   ->from("unit_rental")
		   ->join("project","project.id=unit_rental.projectid","left")
		   ->join("building_info","building_info.bldid=unit_rental.buildingid","left")
		   ->join("add_unit","add_unit.uid=unit_rental.unitid","left")
		   ->join("floors","floors.id=add_unit.floor_no","left")
		    ->join("tenant","tenant.tentant_id=unit_rental.tenantid","left")
		   ->where("unit_rental.soft_delete",0)
		   ->add_column("Actions", $actions, "unit_rental.id");
		echo $this->datatables->generate();
    }
  public function rental(){
        $data['page_title'] = lang('generate_rental');
		$data['project']	= $this->Account_model->get_Project();
		$this->form_validation->set_rules('project_id', 'lang:project', 'trim|required');
		$this->form_validation->set_rules('building_id', 'lang:building', 'trim|required');
		$this->form_validation->set_rules('tenant_id', 'lang:tenant', 'trim|required');
		$this->form_validation->set_rules('unit_id', 'lang:units', 'trim|required');
		$this->form_validation->set_rules('month', 'lang:date', 'trim|required');
		$query=$this->db->get_where("tenant",array("project_id"=>$this->input->post('project_id'),"building_id"=>$this->input->post('building_id'),"unitid"=>$this->input->post('unit_id')));
		if($query->num_rows()>0){
			$tenant=$query->row();
			$rentaltype=json_decode($tenant->type);
			 if(in_array( lang('revenue_sales'), $rentaltype )){
				 $this->form_validation->set_rules('revenue_amount', 'lang:sales_revenue_amount', 'trim|required');
			 }
		}
		if ($this->form_validation->run() == FALSE){
		$this->render_admin('Accounts/rent/rental_form', $data);
		}
		else{
             $checkrental=$this->Account_model->checkrental($this->input->post('project_id'),$this->input->post('building_id'),$this->input->post('unit_id'),$this->input->post('tenant_id'),$this->input->post('month'));
	         if(!empty($checkrental)){
				 $this->session->set_flashdata('error', lang('rental_details_already_exists'));
				  redirect('admin/accounts/rental');
			 }
	         $data['bill_details']=$this->Account_model->get_unpaidBills($this->input->post('unit_id'),$this->input->post('tenant_id'));
			 $data['rental_amount']=$this->Account_model->get_rental_details($this->input->post('unit_id'),$this->input->post('tenant_id'),$this->input->post('revenue_amount'));
			 $data['project_name']=$this->Account_model->getprojectBy_id($this->input->post('project_id'));
			 $data['building']    =$this->Account_model->getbuildingBy_id($this->input->post('project_id'),$this->input->post('building_id'));
			 $data['tenant']      =$this->Account_model->gettenantBy_id($this->input->post('tenant_id'));
			 $data['unit']        =$this->Account_model->gettenantunitBy_id($this->input->post('tenant_id'),$this->input->post('unit_id'));
			 $data['month']       =$this->input->post('month');
			 $this->render_admin('Accounts/rent/rent_form', $data);
		}
    }
    
	function rental_save(){
		//	$save['bill_date']	        = $this->input->post('bill_date');
			$save['projectid']	        = $this->input->post('projectid');
			$save['buildingid']	        = $this->input->post('buildingid');
			$save['floorid']	        = $this->input->post('floorid');
			$save['unitid']	            = $this->input->post('unitid');
			$save['tenantid']	        = $this->input->post('tenantid');
			$save['bill_details']	    = json_encode($this->input->post('bill_details')) ;
			$save['rental_amount']	    = $this->input->post('rental_amount');
			$save['revenue_amount']	    = $this->input->post('revenue_amount');
			$save['revenue_percentage']	= $this->input->post('revenue_percentage');
			$save['total_rental_amount'] = $this->input->post('total_rental_amount');
			$save['due_date']           = $this->input->post('due_date');
			$save['month']              = $this->input->post('month');
			$save['payment_status']     =lang('pending'); 
			$saved=$this->Account_model->rental_save($save);
			$this->session->set_flashdata('message', lang('rental_bills_generated_successfully'));
			redirect('admin/Accounts/rentallist');
	}
	function rental_details($rentalid){
		$data['page_title'] = lang('rental_collection_list');
		$data['rental_details']=$this->Account_model->get_rental_detail($rentalid);
		$data['bill_details']=$this->Account_model->get_billByrentalid($rentalid);
        $this->render_admin('Accounts/rent/rent_details_view', $data);
	}
	function rental_delete($id){
		if ($id) {
            $rental = $this->Account_model->delete_rental($id);
            if (!$rental) {
                $this->session->set_flashdata('error', lang('unable_to_deleted_rental_data'));
                redirect('admin/Accounts/rentallist');
            } else {
                $delete = $this->Account_model->delete($id);
                $this->session->set_flashdata('message', lang('rental_data_deleted'));
                redirect('admin/Accounts/rentallist');
            }
        } else {
            $this->session->set_flashdata('error', lang('unable_to_deleted_rental_data'));
           redirect('admin/Accounts/rentallist');
        }
		
		
	}
	 public function rental_paymentlist(){
        $data['page_title'] = lang('rental_payment');
        $this->render_admin('Accounts/rent/payment_list', $data);
    }
    public function get_paymentlist() {
       $actions = "<div class=\"text-center\">";
		 $actions .= "<a href='" . base_url('admin/accounts/invoice/$1') . "'  class='tip' ><i class=\"fa fa-file-pdf-o\"></i></a> ";
		 $actions .= "</div>";
         $this->datatables
		   ->select("unit_rental_payment.id,full_name,project.Name,building_info.name building,floors.name floor,unit_no ,due_date,total_rental_amount amount,payment_status
		  ", FALSE)
		   ->from("unit_rental_payment")
		   ->join("project","project.id=unit_rental_payment.projectid","left")
		   ->join("building_info","building_info.bldid=unit_rental_payment.buildingid","left")
		   ->join("add_unit","add_unit.uid=unit_rental_payment.unitid","left")
		   ->join("floors","floors.id=add_unit.floor_no","left")
		    ->join("tenant","tenant.tentant_id=unit_rental_payment.tenantid","left")
		   ->where("unit_rental_payment.soft_delete",0)
		   ->add_column("Actions", $actions, "unit_rental_payment.id");
		echo $this->datatables->generate();
    }
	 function add_rental_payment($id = false){
		$data['page_title']		= lang('Add_payment');
		$data['project']	            = $this->Account_model->get_Project();
	    $data['services_list']          = $this->db->get_where("services",array("Soft_delete"=>0))->result();
		$data['id']			            = '';
		$data['project_id']		        = '';
		$data['building_id']		    = '';
		$data['owner_id']			    = '';
		$data['unit_id']		        = '';
		$data['Issue_date']		        = '';
		$data['Bill_Date']		        = '';
		$data['Total_amount']	        = '';
		$data['paid_amount']	        = '';
		$data['note']	                = '';
		$data['paid_from']	            = '';
		if ($id){	
			$data['bill']		=	$bill		= $this->Account_model->getrentalbill_details($id);       
			$data['buildings']   =	$building   = $this->Account_model->get_building($bill->projectid);
			$data['owners']	    =	$owner		= $this->Account_model->get_tenantbyBuilding($bill->projectid,$bill->buildingid);
			$data['ownerunits']	=	$ownerunits	= $this->Account_model->get_tenant_units($bill->projectid,$bill->buildingid,$bill->tenantid);
			if (!$bill){
				$this->session->set_flashdata('error', lang('bill_details_not_found'));
				redirect('admin/Accounts/rental_paymentlist');
			}
			   
			$data['id']			            = $bill->id;
		    $data['project_id']		        = $bill->projectid;
		    $data['building_id']		    = $bill->buildingid;
		    $data['owner_id']			    = $bill->tenantid;
			$data['unit_id']		        = $bill->unitid;
			$data['Issued_date']		    = $bill->paid_date;
			$data['bill_date']		        = $bill->paid_date;
			$data['Total_amount']	        = $bill->total_rental_amount;
			$data['paid_amount']	        = $bill->paid_amount;
			$data['note']	                = $bill->note;
			$data['paid_from']	            = $bill->paid_from;
		}
		$this->form_validation->set_rules('paid_from', 'lang:paid_from', 'trim|required');
		$this->form_validation->set_rules('project_id', 'lang:Paid_status', 'trim|required');
		$this->form_validation->set_rules('building_id', 'lang:building', 'trim|required');
		$this->form_validation->set_rules('owner_id', 'lang:Owner', 'trim|required');
		$this->form_validation->set_rules('Total_amount', 'lang:Total_amount', 'trim|required');
		if ($this->form_validation->run() == FALSE){
			$this->render_admin('Accounts/rent/payment_form', $data);		
		}
		else{
			$save['id']	                = $this->input->post('id');
			$save['rentalbillid']	    = $this->input->post('rentalbillid');
			$save['paid_date']	        = $this->input->post('paid_date');
			$save['paid_amount']	    = $this->input->post('paidamount');
			$save['note']	            = $this->input->post('Note');
			$save['paid_from']	        = $this->input->post('paid_from');
			$this->Account_model->payment_save($save);
			if($id){
				$this->session->set_flashdata('message', lang('bill_updated'));
			}else{
				$this->session->set_flashdata('message', lang('bill_saved'));
			}
			redirect('admin/Accounts/rental_paymentlist');
		}
	}
	public function get_rentalbill(){
        $projectid = $this->input->post('project_id');
        $buildingid = $this->input->post('buildingid');
		$tenantid = $this->input->post('tenantid');
	    $unitid = $this->input->post('unit');
	    $rentalbill = $this->Account_model->get_rentalbill($projectid,$buildingid,$tenantid,$unitid);
		$HTML='';
        if ($rentalbill) {
            foreach ($rentalbill as $row) {
                $HTML .= "<option value='" . $row->id . "'>" . $row->referncenumber . "</option>";
            }
        }   
        echo $HTML; 
    }
	public function get_rentalbillamount(){
	    $rentalid = $this->input->post('rentalid');
		$rentalbill=$this->db->get_where("unit_rental",array("id"=>$rentalid))->row();
	     echo !empty($rentalbill->total_rental_amount)?$rentalbill->total_rental_amount:0  ;
    }
	 public function invoice($id){
        $data['page_title'] = lang('invoice');
		$data['payment']=$payment=$this->Account_model->get_payment($id);
		$data['bills']=$data['bill_details']=$this->Account_model->get_billByrentalid($payment->rental_id);
        $this->render_admin('Accounts/rent/Invoiceview', $data);
    }
    public function lease_collection(){
	     $data['page_title']	=	lang('lease_collection');
		 $this->render_admin('Accounts/settlement/Lease_collection', $data); 
    }
	function get_lease_collection(){
		   $actions = "<div class=\"text-center\">";
		   $actions .= "<a href='" .
		   base_url('admin/accounts/lease_collection_details/$1') . "'  class='tip' ><i class=\"fa fa-search\"></i></a> ";
		    $actions .= "</div>";
		   $this->load->library('datatables');
		   $this->datatables
		   ->select("agreement_id,project.Name project,building_info.name building,floors.name as name,unit_name,tenant_agreement.full_name,tenant_agreement.amount,tenant_agreement.balanceamount,case when  tenant_agreement.balanceamount>0 then 'UnPaid' else 'Paid' end status ", FALSE)      
		   ->from("tenant_agreement")
		   ->join("project","project.id=tenant_agreement.project_id","left")
		   ->join("add_unit","add_unit.uid=tenant_agreement.unitid","left")
		    ->join("floors","floors.id=add_unit.floor_no","left")
		   ->join("building_info","building_info.bldid=tenant_agreement.building_id","left")
		  ->join("tenant","tenant.tentant_id=tenant_agreement.tentant_id","left")
		   ->where("tenant_agreement.soft_deleted", 0)
		     ->where("tenant_creadted_by", 2)
			 ->where("tenant_agreement.active", 1)
		   ->add_column("Actions", $actions, "agreement_id");
		echo	  $this->datatables->generate();
			//echo $this->db->last_query();
   }
   function  lease_collection_details($id){
	    $data['page_title']	   =	lang('lease_agreements');
		$data['leasedetails']     = $this->Account_model->agreementDetails($id);
		$data['paymentdetails']   = $this->Account_model->paymentdetails($id);
		$this->render_admin('Accounts/settlement/lease_collection_details', $data);
	}
	 public function add_payment($id = null){
        if ($id) {
            $lease = $this->Account_model->agreementDetails($id);
			
        if ($lease->balanceamount<=0) {
            $this->session->set_flashdata('error', lang("Payment_status_lease"));
			  redirect($_SERVER["HTTP_REFERER"]);
        }
        $this->form_validation->set_rules('amount-paid', lang("Amount"), 'required');
        $this->form_validation->set_rules('paid_by', lang("Paying_by"), 'required');
        if ($this->form_validation->run() == true) {
			  if($this->input->post('paymentid')){
			  $payment_id=$this->input->post('paymentid');
			  $payments_details = $this->Account_model->getPayments($payment_id);
			 echo  $balanceamount=($payments_details->balance_amount +$payments_details->paid_amount)-$this->input->post('amount-paid');
			  }else{
				 $balanceamount= $this->input->post('balanceamount') - $this->input->post('amount-paid');
			  }
            $payment = array(
                'payment_date' => $this->input->post('date'),
                'reference_no' => strtotime(date('Y/m/d H:i:s')) ,
                'paid_amount' => $this->input->post('amount-paid'),
                'paid_by' => $this->input->post('paid_by'),
                'cc_no' => $this->input->post('pcc_no'),
                'cc_holder' => $this->input->post('pcc_holder'),
                'cc_month' => $this->input->post('pcc_month'),
                'cc_year' => $this->input->post('pcc_year'),
                 'balance_amount'=>$balanceamount,
                'note' => $this->input->post('note'),
				'tenantid'=>$lease->tentant_id,
                 'agreementid'=>$id,
                'type' => 'received',
            );
        } elseif ($this->input->post('add_payment')) {
            $this->session->set_flashdata('error', validation_errors());
               redirect($_SERVER["HTTP_REFERER"]);
        }
        if ($this->form_validation->run() == true && $this->Account_model->addPayment($payment,$id,$payment_id)) {
            $this->session->set_flashdata('message', lang("payment_added"));
              redirect($_SERVER["HTTP_REFERER"]);
        } else {
            $data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
            $data['inv'] = $sale;
            $data['payment_ref'] = '';
		  redirect($_SERVER["HTTP_REFERER"]);
        }
		}
		redirect($_SERVER["HTTP_REFERER"]);
    }
	function paymentdelete($id = false){
		if ($id){	
				$delete	= $this->Account_model->paymentdelete($id);
				$this->session->set_flashdata('message', lang('payment_delete'));
				 redirect($_SERVER["HTTP_REFERER"]);
		}
		else{
			    $this->session->set_flashdata('error', lang('Nodatafound'));
				redirect($_SERVER["HTTP_REFERER"]);
		}
		
	}
	
	// lease commission
	public function lease_commission(){
	     $data['page_title']	=	lang('lease_Commission');
		 $this->render_admin('Accounts/settlement/Lease_commission', $data); 
    }
	function get_lease_commission(){
		   $actions = "<div class=\"text-center\">";
		   $actions .= "<a href='" .
		   base_url('admin/accounts/lease_commission_details/$1') . "'  class='tip' ><i class=\"fa fa-search\"></i></a> ";
		    $actions .= "</div>";
		   $this->load->library('datatables');
		   $this->datatables
		   ->select("lease_commission.id,project.Name project,building_info.name building,floors.name as name,unit_name,owner.full_name owner,lease_commission.commission_amount,lease_commission.balance,case when  lease_commission.balance>0 then 'UnPaid' else 'Paid' end status ", FALSE)      
		   ->from("lease_commission")
		   ->join("project","project.id=lease_commission.projectid","left")
		   ->join("add_unit","add_unit.uid=lease_commission.unitid","left")
		    ->join("floors","floors.id=add_unit.floor_no","left")
		   ->join("building_info","building_info.bldid=lease_commission.buildingid","left")
		   ->join("owner","owner.ownid=lease_commission.owner_id","left")
		   ->where("lease_commission.soft_deleted", 0)
		  
			 ->where("lease_commission.active", 1)
		   ->add_column("Actions", $actions, "lease_commission.id");
		echo	  $this->datatables->generate();
			//echo $this->db->last_query();
   }
   function  lease_commission_details($id){
	    $data['page_title']	   =	lang('lease_Commission');
		$data['commission_details']     = $this->Account_model->commissionDetails($id);
		$data['paymentdetails']   = $this->Account_model->commission_paymentdetails($id);
		$this->render_admin('Accounts/settlement/lease_commission_details', $data);
	}
	 public function add_commissionPayment($id = null){
        if ($id) {
            $lease = $this->Account_model->commissionDetails($id);
        if ($lease->balance<=0) {
            $this->session->set_flashdata('error', lang("Payment_status_lease"));
			  redirect($_SERVER["HTTP_REFERER"]);
        }
        $this->form_validation->set_rules('amount-paid', lang("Amount"), 'required');
        $this->form_validation->set_rules('paid_by', lang("Paying_by"), 'required');
        if ($this->form_validation->run() == true) {
			  if($this->input->post('paymentid')){
			  $payment_id=$this->input->post('paymentid');
			  $payments_details = $this->Account_model->getcommissionPayments($payment_id);
			 echo   $balanceamount=($payments_details->balance_amount +$payments_details->paid_amount)-$this->input->post('amount-paid');
			  }else{
				 $balanceamount= $this->input->post('balanceamount') - $this->input->post('amount-paid');
			  }
            $payment = array(
                'payment_date' => $this->input->post('date'),
                'reference_no' => strtotime(date('Y/m/d H:i:s')) ,
                'paid_amount' => $this->input->post('amount-paid'),
                'paid_by' => $this->input->post('paid_by'),
                'cc_no' => $this->input->post('pcc_no'),
                'cc_holder' => $this->input->post('pcc_holder'),
                'cc_month' => $this->input->post('pcc_month'),
                'cc_year' => $this->input->post('pcc_year'),
                 'balance_amount'=>$balanceamount,
                'note' => $this->input->post('note'),
				'ownerid'=>$lease->owner_id,
                'leasecommissionid'=>$id,
                'type' => 'received',
            );
        } elseif ($this->input->post('add_payment')) {
            $this->session->set_flashdata('error', validation_errors());
               redirect($_SERVER["HTTP_REFERER"]);
        }
        if ($this->form_validation->run() == true && $this->Account_model->addCommissionPayment($payment,$id,$payment_id)) {
            $this->session->set_flashdata('message', lang("payment_added"));
              redirect($_SERVER["HTTP_REFERER"]);
        } else {
            $data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
            $data['inv'] = $sale;
            $data['payment_ref'] = '';
		  redirect($_SERVER["HTTP_REFERER"]);
        }
		}
		redirect($_SERVER["HTTP_REFERER"]);
    }
	function commissionpaymentdelete($id = false){
		if ($id){	
				$delete	= $this->Account_model->commissionpaymentdelete($id);
				$this->session->set_flashdata('message', lang('payment_delete'));
				 redirect($_SERVER["HTTP_REFERER"]);
		}
		else{
			    $this->session->set_flashdata('error', lang('Nodatafound'));
				redirect($_SERVER["HTTP_REFERER"]);
		}
		
	}
	
	//resale commission
	public function resale_commission(){
	     $data['page_title']	=	lang('resales_Commission');
		 $this->render_admin('Accounts/settlement/resale_commission', $data); 
    }
	function get_resale_commission(){
		   $actions = "<div class=\"text-center\">";
		   $actions .= "<a href='" .
		   base_url('admin/accounts/resale_commission_details/$1') . "'  class='tip' ><i class=\"fa fa-search\"></i></a> ";
		    $actions .= "</div>";
		   $this->load->library('datatables');
		   $this->datatables
		   ->select("resale_commission.id,project.Name project,building_info.name building,floors.name as name,unit_name,owner.full_name owner,resale_commission.commission_amount,resale_commission.balance,case when  resale_commission.balance>0 then 'UnPaid' else 'Paid' end status ", FALSE)      
		   ->from("resale_commission")
		   ->join("project","project.id=resale_commission.projectid","left")
		   ->join("add_unit","add_unit.uid=resale_commission.unitid","left")
		    ->join("floors","floors.id=add_unit.floor_no","left")
		   ->join("building_info","building_info.bldid=resale_commission.buildingid","left")
		   ->join("owner","owner.ownid=resale_commission.owner_id","left")
		   ->where("resale_commission.soft_deleted", 0)
		  
			 ->where("resale_commission.active", 1)
		   ->add_column("Actions", $actions, "resale_commission.id");
		echo	  $this->datatables->generate();
			//echo $this->db->last_query();
   }
   function  resale_commission_details($id){
	    $data['page_title']	   =	lang('resales_Commission');
		$data['commission_details']     = $this->Account_model->resale_commissionDetails($id);
		$data['paymentdetails']   = $this->Account_model->resale_commission_paymentdetails($id);
		$this->render_admin('Accounts/settlement/resale_commission_details', $data);
	}
	 public function add_resale_commissionPayment($id = null){
        if ($id) {
            $commission = $this->Account_model->resale_commissionDetails($id);
        if ($commission->balance<=0) {
            $this->session->set_flashdata('error', lang("Payment_status_lease"));
			  redirect($_SERVER["HTTP_REFERER"]);
        }
        $this->form_validation->set_rules('amount-paid', lang("Amount"), 'required');
        $this->form_validation->set_rules('paid_by', lang("Paying_by"), 'required');
        if ($this->form_validation->run() == true) {
			  if($this->input->post('paymentid')){
			  $payment_id=$this->input->post('paymentid');
			  $payments_details = $this->Account_model->getresale_commissionPayments($payment_id);
			 echo   $balanceamount=($payments_details->balance_amount +$payments_details->paid_amount)-$this->input->post('amount-paid');
			  }else{
				 $balanceamount= $this->input->post('balanceamount') - $this->input->post('amount-paid');
			  }
            $payment = array(
                'payment_date' => $this->input->post('date'),
                'reference_no' => strtotime(date('Y/m/d H:i:s')) ,
                'paid_amount' => $this->input->post('amount-paid'),
                'paid_by' => $this->input->post('paid_by'),
                'cc_no' => $this->input->post('pcc_no'),
                'cc_holder' => $this->input->post('pcc_holder'),
                'cc_month' => $this->input->post('pcc_month'),
                'cc_year' => $this->input->post('pcc_year'),
                 'balance_amount'=>$balanceamount,
                'note' => $this->input->post('note'),
				'ownerid'=>$commission->owner_id,
                'resalecommissionid'=>$id,
                'type' => 'received',
            );
        } elseif ($this->input->post('add_payment')) {
            $this->session->set_flashdata('error', validation_errors());
               redirect($_SERVER["HTTP_REFERER"]);
        }
        if ($this->form_validation->run() == true && $this->Account_model->add_resale_CommissionPayment($payment,$id,$payment_id)) {
            $this->session->set_flashdata('message', lang("payment_added"));
              redirect($_SERVER["HTTP_REFERER"]);
        } else {
            $data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
            $data['inv'] = $sale;
            $data['payment_ref'] = '';
		  redirect($_SERVER["HTTP_REFERER"]);
        }
		}
		redirect($_SERVER["HTTP_REFERER"]);
    }
	function resale_commission_paymentdelete($id = false){
		if ($id){	
				$delete	= $this->Account_model->resale_commissionpaymentdelete($id);
				$this->session->set_flashdata('message', lang('payment_delete'));
				 redirect($_SERVER["HTTP_REFERER"]);
		}
		else{
			    $this->session->set_flashdata('error', lang('Nodatafound'));
				redirect($_SERVER["HTTP_REFERER"]);
		}
		
	}
	
	

}