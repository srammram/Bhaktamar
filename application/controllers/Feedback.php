<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Feedback extends CI_Controller {
	  public function index($pos_enquiryid = false){
		   $data['id']		                 = '';
		   $data['campaign_name']			 = '';
		   $data['purpose']	                 = '';
		   $data['members']			         = '';
		   $data['description']	    		 = '';
		   $data['created_by']	    		 = '';
		$this->form_validation->set_rules('rating', 'lang:rating', 'trim|required');
		if ($this->form_validation->run() == FALSE){
			if($this->site->checkFeedback($pos_enquiryid)  ==1){
			 $data['response']=1;
			$this->load->view('feedback_form', $data);	
			}else{
				 $data['response']=3;
			  $this->load->view('feedback_form', $data);	
			}				
		}
		else{	
print_r($POST);
die;		
			$save['id']		                     = $id;
			$save['campaign_name']		         = $this->input->post('campaign_name');
			$save['purpose']		             = $this->input->post('purpose');
			$save['created_by']		             = $this->input->post('created_by');
			$save['members']		             = json_encode($this->input->post('leads'));
			$save['description']	    		 = $this->input->post('description');
		    if($this->Crm_model->campaign_save($save)){
					$data['response']=2;
					$this->load->view('feedback_form', $data);	
			}else{
					$data['response']=4;
					$this->load->view('feedback_form', $data);	
				
			}
		}
    }
	
}
