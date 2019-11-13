<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PropertyDashboard extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
    	$this->load->model(array('Property_model'));
	}
	function index() {
		$data['page_title']	=	lang('Property_dashboard');
		$data['totalowner']=$this->Property_model->TotalOwner();
		$data['Undetconstruction']=$this->get_count(11,1);
		$data['Complete']=$this->get_count(11,4);
		$data['OwnerDelivered']=$this->get_count(11,5);
		$data['Ownerpaid']=$this->get_count(11,6);
		$data['Ownerunpaid']=$this->get_count(11,7);
		$data['hotellauc']=$this->get_count(12,1);
		$data['hotelcom']=$this->get_count(12,4);
		$data['hotelinbusi']=$this->get_count(12,8);
		$data['hotel_avail']=$this->get_count(12,9);
		$data['hotel_hired']=$this->get_count(12,10);
		$data['leaseuc']=$this->get_count(13,1);
		$data['leasecom']=$this->get_count(13,4);
		$data['leaseinbusi']=$this->get_count(13,8);
		$data['lease_avai']=$this->get_count(13,9);
		$data['leasehired']=$this->get_count(13,10);
		$this->render_admin('dashboard/Property_dashboard', $data);	
	}	
		
   function table($Ownertype,$type,$typeName)
   {
	   $data['page_title']	=	lang('Property_dashboard');
	   $data['Table_title']	=	str_replace('%20',' ',$typeName);
	   $Result=$this->Property_model->get_Owner_unit($Ownertype);
	   $Owner_unit=array();
	   foreach($Result as $result) {
		  $Owner_unit[]=json_decode($result->Owner_unit);
	   }
	   $units = array();
	   foreach($Owner_unit as $array) {
       foreach($array as $k=>$v) {
               $units[] = $v;
          }
        }
        $data['tables']= $this->Property_model->Get_Unit_group($units,$type);
	    $this->render_admin('dashboard/list', $data);
   }
   
   function get_count($Ownertype,$type)
   {
	   $Result=$this->Property_model->get_Owner_unit($Ownertype);
	   $Owner_unit=array();
	   foreach($Result as $result) {
		  $Owner_unit[]=json_decode($result->Owner_unit);
	   }
	   $units = array();
	   foreach($Owner_unit as $array) {
       foreach($array as $k=>$v) {
               $units[] = $v;
          }
        }
	  return $count= count($this->Property_model->Get_Unit_group($units,$type));
   }
}