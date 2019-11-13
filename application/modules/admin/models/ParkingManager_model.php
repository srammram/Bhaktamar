<?php
Class ParkingManager_model extends CI_Model
{
    var $CI;

    function __construct()
    {
        parent::__construct();

        $this->CI =& get_instance();
        $this->CI->load->database(); 
        $this->CI->load->helper('url');
    }
	
function get_all()
    {
		$result = $this->db->query("
SELECT pm.id , Vechile_number,  Assign_status,  STATUS,  ps.Slot_No,  ps.Slot_Type,  full_name 
FROM parkingmanager pm
LEFT JOIN parking_slot ps ON pm.Slot_no=ps.id
LEFT JOIN owner aw ON pm.OwnerName=aw.ownid")->result();
        return $result;
    }
	function get($id)
    {
		$result = $this->db->query("SELECT ps.id as Slot_Nos,pm.id , OwnerName,Vechile_number,  Assign_status,  STATUS,  ps.Slot_No,  ps.Slot_Type,  full_name 
        FROM parkingmanager pm
        LEFT JOIN parking_slot ps ON pm.Slot_no=ps.id
        LEFT JOIN owner aw ON pm.OwnerName=aw.ownid where pm.id='".$id."'")->row();
        return $result;
    }
    function save($save)
    {
        if ($save['id'])
        {
            $this->db->where('id', $save['id']);
            $this->db->update('parkingmanager', $save);
            return $save['id'];
        }
        else
        {
            $this->db->insert('parkingmanager', $save);
            return $this->db->insert_id();
        }
    }
	 
    function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('parkingmanager');
    }

	function Slot_getall()
	{
		$result = $this->db->get('parking_slot');
        return $result->result();
		
	}
	function Slot_get($id)
	{
			$this->db->where('id', $id);
		    $result = $this->db->get('parking_slot');
            return $result->row();
	}
	function Slot_save($save,$ids){
		if ($save['id']){
            $this->db->where('id', $save['id']);
            $this->db->update('parking_slot', $save);
            return $save['id'];
        }
        else
        {
            $this->db->insert('parking_slot', $save);
            return $this->db->insert_id();
        }
	}
	function Slot_delete($id)
	{
		$this->db->where('id', $id);
        $this->db->delete('parking_slot');
	}
    function Get_owner()
	{
		$result = $this->db->get('owner');
        return $result->result();
		
	}
	 function Get_Slot()
	{
		$result = $this->db->query('SELECT * FROM parking_slot ')->result();
        return $result;
		
	}
}