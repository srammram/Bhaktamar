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
		$this->db->where('request_typeid',$id);
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
		$this->db->where('request_subcategory.category_id',$id);
		$query=$this->db->get('request_subcategory');
	    if($query->num_rows()>0){
			foreach($query->result() as $row){
			$data[]=$row;
		}
		return $data;
		}
		return false;
	}
	
	function get_requestall($employeeid){
		$this->db->select('request.*,request_category.Name as categoryname,request_type.Name as requesttype,request_subcategory.Name as subcategory');
		$this->db->join('request_type','request_type.id=request.requesttypeId','left');
		$this->db->join('request_category','request_category.id=request.categoryId','left');
		$this->db->join('request_subcategory','request_subcategory.id=request.subcategoryId','left');
		$this->db->where('FIND_IN_SET('.$employeeid.', assign_to)');
		$query=$this->db->get('request');
		
	    if($query->num_rows()>0){
			foreach($query->result() as $row){
			$data[]=$row;
		}
		return $data;
		}
		return false;
	}
		function getRequestby($ownertype,$ownerid){
		switch ($ownertype){
			case 1:
			$this->db->select("full_name as Name,permanent_address");
			$this->db->where('ownid',$ownerid);
			$query=$this->db->get('owner');
			break;
			case 2:
			 $this->db->select("full_name as Name,permanent_address");
			 $this->db->where('residentid',$ownerid);
			 $query=$this->db->get('resident');
			break;
			case 3:
			$this->db->select("full_name as Name,permanent_address");
			 $this->db->where('external_staff_id',$ownerid);
			 $query=$this->db->get('external_staff');
			break ;
		}
		    if($query->num_rows()>0){
				return $query->row();
			}
			return false;
			
		
	}
	function  worklist_save($save){
		if(!empty($save['request_id'])){
			$this->db->where('request_id',$save['request_id']);
			$this->db->update('request',$save);
			$data['request_id']=$save['request_id'];
			if(isset($save['Complaint_status'])){
				$data['note']=$save['Complaint_status'];
			}else{
				$data['note']=$save['assignee_comments'];
			}
			$this->db->insert('request_logs',$data);
			return $save['request_id'];
		}else{
			$this->db->where('request_id',$save['request_id']);
			$this->db->update('request',$save);
			$requestId=$this->db->insert_id();
			$data['request_id']=$requestId;
			if(isset($save['Complaint_status'])){
				$data['note']=$save['Complaint_status'];
			}else{
				$data['note']=$save['assignee_comments'];
			}
		}
		
		
	}
	function get_venue_details($id){
		$request=$this->db->get_where('request',array('Soft_delete'=>0,'request_id'=>$id))->row();
	    if($request){
	       switch ($request->owner_type){
			   case 1:
			   $this->db->select('owner.full_name as ownername,permanent_address');
	           $this->db->join('owner','owner.ownid=request.owner_id','left');
	           $this->db->where('request.Is_read',1);
			   $this->db->where('request.owner_type',1);
			   $this->db->where('request.request_id',$request->request_id);
			   break;
			   case 2:
			    $this->db->select('resident.full_name as ownername,permanent_address');
	           $this->db->join('resident','resident.residentid=request.owner_id','left');
	           $this->db->where('request.Is_read',1);
			    $this->db->where('request.owner_type',2);
				$this->db->where('request.request_id',$request->request_id);
			   break;
			   case 3:
			    $this->db->select('external_staff.full_name as ownername,permanent_address');
	            $this->db->join('external_staff','external_staff.external_staff_id=request.owner_id','left');
	            $this->db->where('request.Is_read',1);
				$this->db->where('request.owner_type',3);
				$this->db->where('request.request_id',$request->request_id);
			    break;
		   }
		   $this->db->group_by('request_id'); 
	       $this->db->order_by('request_id', 'DESC');
	       $this->db->limit('10');
	       $query=$this->db->get('request');
		   if($query->num_rows()>0){
		     return $query->row();
	   }
	   return false;
	   }
	}
}
