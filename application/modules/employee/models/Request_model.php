<?php
class Worklist_model  extends CI_Model  {

	
	function reset_password($email)
    {
        $this->load->library('encrypt');
        $user = $this->get_user_by_email($email);
        if ($user)
        {
            $this->load->helper('string');
            $this->load->library('email');
            
            $new_password       = random_string('alnum', 8);
            $user['password']   = sha1($new_password);
            $this->save($user);
            
            $this->email->from($this->config->item('email'), $this->config->item('School Portal'));
            $this->email->to($email);
            $this->email->subject($this->config->item('School Portal').': Password Reset');
            $this->email->message('Your password has been reset to <strong>'. $new_password .'</strong>.');
            $this->email->send();
            
            return true;
        }
        else
        {
            return false;
        }
    }
	
	
	function getRequestTypeAll(){
		$this->db->select('*');
		$this->db->where('soft_delete',0);
		$query=$this->db->get('request_type');
	    if($query->num_rows()>0){
			foreach($query->result() as $row){
			$data[]=$row;
		}
		return $data;
		}
		return false;
	}
	function get_requestType_Category($id){
		$this->db->select('*');
		$this->db->where('request_category.id',$id);
		$query=$this->db->get('request_category');
	    if($query->num_rows()>0){
			foreach($query->result() as $row){
			$data[]=$row;
		}
		return $data;
		}
		return false;
	}
	function get_requestType_SubCategory($id){
		$this->db->select('*');
		$this->db->where('request_subcategory.id',$id);
		$query=$this->db->get('request_subcategory');
	    if($query->num_rows()>0){
			foreach($query->result() as $row){
			$data[]=$row;
		}
		return $data;
		}
		return false;
	}
	
	function get_requestall(){
		$this->db->select('request.*,request_category.Name as categoryname,request_type.Name as requesttype,request_subcategory.Name as subcategory');
		$this->db->join('request_type','request_type.id=request.requesttypeId','left');
		$this->db->join('request_category','request_category.id=request.categoryId','left');
		$this->db->join('request_subcategory','request_subcategory.id=request.subcategoryId','left');
		//$this->db->where('request.owner_id',$id);
		$query=$this->db->get('request');
	    if($query->num_rows()>0){
			foreach($query->result() as $row){
			$data[]=$row;
		}
		return $data;
		}
		return false;
	}
	function getrequestView($id){
		$this->db->select('request.*,request_category.Name as categoryname,request_type.Name as requesttype,request_subcategory.Name as subcategory');
		$this->db->join('request_type','request_type.id=request.requesttypeId','left');
		$this->db->join('request_category','request_category.id=request.categoryId','left');
		$this->db->join('request_subcategory','request_subcategory.id=request.subcategoryId','left');
		$this->db->where('request.request_id',$id);
		$query=$this->db->get('request');
		if($query->num_rows()>0){
	    return  $query->row();
		}
		return false;
	}
		  
	    function request_save($save)
    {
        if ($save['id'])
        {
            $this->db->where('id', $save['id']);
            $this->db->update('request', $save);
			$this->db->insert('request_logs',array('request_id'=>$save['id'],'note'=>$save['description']));
            return $save['id'];
        }
        else
        {
            $this->db->insert('request', $save);
            $request_id=$this->db->insert_id();
			$this->db->insert('request_logs',array('request_id'=>$request_id,'note'=>$save['description']));
			return $request_id;
        }
    }
}
