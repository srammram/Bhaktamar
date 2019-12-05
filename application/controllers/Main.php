<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
	
	  public function get_building(){
        $projectid = $this->input->post('projectid');
        $HTML = '';
	    $buildings = $this->site->get_building($projectid);
        if ($buildings) {
            foreach ($buildings as $row) {
                $HTML .= "<option value='" . $row->bldid . "'>" . $row->name . "</option>";
            }
        } 
        echo $HTML; 
    }
	public function get_buildingfloors(){
        $projectid = !empty($this->input->post('projectid'))?$this->input->post('projectid'):'';
		$buildingid = !empty($this->input->post('building'))? $this->input->post('building'):'';
        $HTML = '';
	    $floors = $this->site->get_floor($projectid,$buildingid);
        if ($floors) {
            foreach ($floors as $row) {
                $HTML .= "<option value='" . $row->id . "'>" . $row->name . "</option>";
            }
        } 
        echo $HTML; 
    }
	public function get_floorUnits(){
        $projectid = !empty($this->input->post('projectid'))?$this->input->post('projectid'):'';
		$buildingid = !empty($this->input->post('building'))? $this->input->post('building'):'';
		$floorid = !empty($this->input->post('floorid'))? $this->input->post('floorid'):''; 
        $HTML = '';
	    $units = $this->site->get_unit($projectid,$buildingid,$floorid);
        if ($units) {
            foreach ($units as $row) {
                $HTML .= "<option value='" . $row->uid . "'>" . $row->unit_name . "</option>";
            }
        } 
        echo $HTML; 
    }
	function send_sms(){
		     $message=$_POST['message'];
			 $purpose=$_POST['purpose'];
			 $leads=$_POST['leads'];
			 $data['date']=!empty($_POST['date'])?$_POST['date']:'';
			 $password="praful@123";
			 $username="praful19";
			 $route="trans1";
		     $response = file_get_contents("http://173.45.76.227/send.aspx?username=".$username."&pass=".$password."&route=".$route."&senderid=&numbers=".$leads."&message=".$message."");
			$response_array = json_decode($response);
			if(!empty($response_array) ){
				$this->db->insert("sms_history",array("message"=>$message,"members"=>json_encode($leads),"purpose"=>$purpose,"status"=>'Completed'));
				return 1;
			} else {
				return 0;
			}
		
	}
	function send_sms1(){
		 $response = file_get_contents("http://173.45.76.227/send.aspx?username=praful19&pass=praful@123&route=trans1&senderid=890&numbers=8903023063,7010969663&message=hi");
			$response_array = json_decode($response);
		print_r($response_array);
	}
	function send_sms2(){
		 $response = file_get_contents("http://173.45.76.227/balance.aspx?username=praful19&pass=praful@123");
			$response_array = json_decode($response);
		print_r($response_array);
	}
	function enquiry_form_sms($leadNumber,$agentname){
		$message='We Warmly Welcome To Bhaktamar Residency. Our Representative ('.$agentname.') Shall Attend To You Shortly.';
		$response = file_get_contents("http://173.45.76.227/send.aspx?username=praful19&pass=praful@123&route=trans1&senderid=890&numbers=".$leadNumber."&message=".$message."");
		$response_array = json_decode($response);
		print_r($response_array);
		
	}
	
	function post_enquiry_sms($leadNumber){
		$url=base_url().'/Feeaback';
		$message='Thankyou For Visiting Bhaktamar Residency ! Please Share Your Review For Our Representative & The Project On The Link Below. ('.$url.')  We Look Forward To Seeing You Again ! Regards Bhaktamar Realities LLP.';
		$response = file_get_contents("http://173.45.76.227/send.aspx?username=praful19&pass=praful@123&route=trans1&senderid=890&numbers=".$leadNumber."&message=".$message."");
		$response_array = json_decode($response);
		print_r($response_array);
		
	}
	function get_unit_details(){
		$this->db->select("*");
		$this->db->where("uid",$this->input->post('unit'));
		$q=$this->db->get("add_unit");
		$unit=$q->row();
		echo json_encode($unit);
	}
}
