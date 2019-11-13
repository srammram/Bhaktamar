<?php

/**
 * Get option value
 * @param  string $name Option name
 * @return mixed
 */
function Logs_details($tablename,$tablerow_id,$message,$status,$userid)
{
	 
    $CI =& get_instance();
    $CI->load->database();
	             
	$data=array('status'=>$status,'message'=>$message,'user_id'=>$userid,'Table_name'=>$tablename,'Table_row_id'=>$tablerow_id,'created_at'=>date("Y-m-d H:i:s"));
	$CI->db->insert('LOGS',$data);
    
}

