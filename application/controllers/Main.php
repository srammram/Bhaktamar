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
        $projectid = $this->input->post('projectid');
		$buildingid = $this->input->post('building');
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
        $projectid = $this->input->post('projectid');
		$buildingid = $this->input->post('building');
		$floorid = $this->input->post('floorid');
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
}
