<?php

class ManageCommittee extends Admin_Controller {

	function __construct(){		
		parent::__construct();
		$this->load->model(array('ManageCommittee_Model'));
	}
	
	function index(){
		$admin = $this->session->userdata('admin');
		$data['page_title']	= lang('Management_committee');
		$data['ManageCommittee']	= $this->ManageCommittee_Model->get_all();
		
		$this->render_admin('ManageCommittee/list', $data);		
	}
	function get_committee(){
		 $actions = "<div class=\"text-center\">";
		 $actions .= "<a href='" . base_url('admin/ManageCommittee/view/$1') . "'  class='tip' ><i class=\"fa fa-eye\"></i></a> <a href='" . base_url('admin/ManageCommittee/form/$1') . "'  class='tip' ><i class=\"fa fa-edit\"></i></a> <a href='" . base_url('admin/ManageCommittee/delete/$1') . "' class='tip po'  onclick='return areyousure(this)'><i class=\"fa fa-trash-o\"></i></a>";
		 $actions .= "</div>";
		   $this->load->library('datatables');
		   $this->datatables
		   ->select("mc_id,mc_name,mc_start_date,owner.full_name, CASE Active when 1 Then 'Active' ELSE 'In Active' end as status", FALSE)
		   ->from("add_management_committee")
		   ->join("owner","owner.ownid=add_management_committee.mc_Leader","left")
		  // ->where("soft_delete",0)
		   ->add_column("Actions", $actions, "mc_id");
		   echo $this->datatables->generate();
	}
	function view($id,$tab=false){
		$admin = $this->session->userdata('admin');
		$data['ManageCommittee']			=	$ManageCommittee		= $this->ManageCommittee_Model->get($id);
		$data['page_title']	= lang('view')." ".lang('ManageCommittee') ;
		$member=json_decode($ManageCommittee->mc_members);
		$data['Ownerss']=$this->ManageCommittee_Model->Get_Member($member);
		$this->render_admin('ManageCommittee/view', $data);
	}
	function form($id = false){
		$admin = $this->session->userdata('admin');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$data['page_title']		= lang('Add_ManageCommittee');
		$data['Owners']		    = $this->ManageCommittee_Model->Get_Owner();
		$data['id']			     = '';
		$data['mc_id']		     = '';
		$data['mc_name']		 = '';
		$data['mc_members']	     = '';
		$data['mc_Leader']		 = '';
		$data['mc_start_date']   = '';
		$data['mc_Rules']		 = '';
		$data['Active']	         = '';
		if ($id){	
			$data['ManageCommittee']	=	$ManageCommittee	= $this->ManageCommittee_Model->get($id);
			if (!$ManageCommittee){
				$this->session->set_flashdata('error', lang('ManageCommittee_not_found'));
				redirect('ManageCommittee/form');
			}
			$data['mc_id']		   = $ManageCommittee->mc_id;
		    $data['mc_name']	   = $ManageCommittee->mc_name;
		    $data['mc_members']	   = json_decode($ManageCommittee->mc_members) ;
		    $data['mc_Leader']	   = $ManageCommittee->mc_Leader;
		    $data['mc_start_date'] = $ManageCommittee->mc_start_date;
		    $data['mc_Rules']	   = $ManageCommittee->mc_Rules;
			$data['Active']	       = $ManageCommittee->Active;
		}
		$this->form_validation->set_rules('Committe_name', 'lang:Committe_name', 'trim|required');
		if ($this->form_validation->run() == FALSE){
			$this->render_admin('ManageCommittee/form', $data);		
		}else{
			$id=$this->input->post('ids');
			$save['mc_members']		    = json_encode($this->input->post('Members'));
			$save['mc_name']		    = $this->input->post('Committe_name');
		    $save['mc_Leader']		    = $this->input->post('Leader');
		    $save['mc_start_date']      = $this->input->post('startdate');
		    $save['mc_Rules']		    = $this->input->post('Rules');
			$this->ManageCommittee_Model->save($save,$id);
			if($id){
				$this->session->set_flashdata('message', lang('ManageCommittee_update'));
			}else{
				$this->session->set_flashdata('message', lang('ManageCommittee_save'));
			}
	        	redirect('admin/ManageCommittee');
		}
	}
	
	function delete($id = false){
		if ($id){	
			$ManageCommittee	= $this->ManageCommittee_Model->get($id);
			if (!$ManageCommittee){
				$this->session->set_flashdata('error', lang('ManageCommittee_not_found'));
			    redirect('admin/ManageCommittee');
			}
			else{
				$delete	= $this->ManageCommittee_Model->delete($id);
				$this->session->set_flashdata('message', lang('ManageCommittee_delete'));
				redirect('admin/ManageCommittee');
			}
		}
		else{   $this->session->set_flashdata('error', lang('ManageCommittee_not_found'));
				redirect('admin/ManageCommittee');
		}
	}
	
	
}