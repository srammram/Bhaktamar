<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Feedback extends CI_Controller {
	  public function index($pos_enquiryid = false){
		   $data['id']		                 = $pos_enquiryid;
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
			$save['enquiry_id']		                 = $this->site->get_enquiryId($this->input->post('id'));
			$save['pos_enquiry_id']		             = $this->input->post('id');
			$save['date_of_review']		             = $this->input->post('created_by');
			$save['total_review']		             = $this->input->post('leads');
			$save['first_review']		             = $this->input->post('rating');
			$save['third_review']		             = $this->input->post('rating1');
			$save['fourth_review']		             = $this->input->post('rating3');
			$save['fifth_review']		             = $this->input->post('rating4');
			$save['impressed_you_the_most']		     = $this->input->post('rating5');
			$save['price_point_was']	    		 = $this->input->post('price_point');
			$save['recommand_our_project']	         = $this->input->post('recommand_our_project');
			$save['details_review']	    		     = $this->input->post('detail_review');
			$save['details_review1']	    		 = $this->input->post('details_review1');
			$save['think_the_price_point_was']	     = $this->input->post('think_the_price_point_was');
			$save['could_have_done_better']	         = $this->input->post('could_have_done_better');
		    if($this->site->feedback_save($save)){
					$data['response']=2;
					$this->load->view('feedback_form', $data);	
			}else{
					$data['response']=4;
					$this->load->view('feedback_form', $data);	
				
			}
		}
    }
	
}
