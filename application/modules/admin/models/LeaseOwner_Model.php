<?php
Class LeaseOwner_Model extends CI_Model
{

    var $CI;
    function __construct()
    {
        parent::__construct();
        $this->CI =& get_instance();
        $this->CI->load->database(); 
        $this->CI->load->helper('url');
    }
	 public function record_count() {
       return $this->db->count_all("leaseowner");
   }
    function get_all($limit,$start)
    {
		 $this->db->limit($limit, $start);
          $query = $this->db->get("leaseowner");
       if ($query->num_rows() > 0) {
 
           foreach ($query->result() as $row) {
 
               $data[] = $row;
           }
           return $data;
       }
       return false;
 
    }
	
function get($id)
    {
		$this->db->where('l.id', $id);
		$this->db->select('l.*,C.name country,S.name state,CT.name city');
		$this->db->join('countries C', 'C.id = l.country_id', 'LEFT');
		$this->db->join('cities CT', 'CT.id = l.city_id', 'LEFT');
		$this->db->join('states S', 'S.id = l.state_id', 'LEFT');
		$result = $this->db->get('leaseowner l');
        return $result->row();
    }
    
	function get_floor()
	{
		$result = $this->db->query("SELECT * FROM floors WHERE active=1")->result();
        return $result;
	}
    function save($save)
    {
        if ($save['id'])
        {
            $this->db->where('id', $save['id']);
            $this->db->update('leaseowner', $save);
            return $id;
        }
        else
        {
            $this->db->insert('leaseowner', $save);
            return $this->db->insert_id();
        }
    }
	 
    function delete($id)
    {
		$data=array('Soft_deleted'=>0);
        $this->db->where('id', $id);
        $result=$this->db->update('leaseowner',$data);
		return $result;
    }
  
   
}