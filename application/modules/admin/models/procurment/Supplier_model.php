<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }
    public function addSupplier($data = array())
    {
        $this->db->insert('companies', $data);
        $insert_id = $this->db->insert_id(); 
        if ($insert_id) {
            //file_put_contents('supplier.txt',json_encode($this->db->error()),FILE_APPEND);
            $unique_id = $this->site->generateUniqueTableID($insert_id);
	    if ($insert_id) {
		$this->site->updateUniqueTableId($insert_id,$unique_id,'companies');
		return true;
	    }
            return $insert_id;
        }
        //print_R($this->db->error());//exit;
        return false;
    }
}