<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Global_model extends CI_Model {

    public $table;
    public $column_order; //set column field database for datatable orderable
    public $column_search; //set column field database for datatable searchable just firstname , lastname , address are searchable
    public $order; // default order
    Public $col;
    public $colId;
    public $where;


    public function __construct()
    {
        parent::__construct();
		//$this->load->helper('log');
    }

    private function _get_datatables_query()
    {
        $this->db->from($this->table);
        $i = 0;
        foreach ($this->column_search as $item) // loop column
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
    function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('id',$id);
        $query = $this->db->get();

        return $query->row();
    }

    public function save($data)
    {
	//	$userId = $this->ion_auth->get_user_id();
        $this->db->insert($this->table, $data);
		$insert_id=$this->db->insert_id();
		//Logs_details($this->table,$insert_id,'Insert Data Successfully','Insert',$userId);
        return $insert_id;
    }

    public function update($where, $data)
    {
		//$userId = $this->ion_auth->get_user_id();
        $this->db->update($this->table, $data, $where);
		//Logs_details($this->table,$where['id'],'Update Data Successfully','Update',$userId);
        return $this->db->affected_rows();
    }

    public function delete_by_id($id)
    {
		//$userId = $this->ion_auth->get_user_id();
        $this->db->where('id', $id);
        $this->db->delete($this->table);
		//Logs_details($this->table,$id,'Delete Data Successfully','Delete',$userId);
    }

    public function render_table($data)
    {
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->count_all(),
            "recordsFiltered" => $this->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function validation($rules)
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        $this->form_validation->set_rules($rules);

        if ($this->form_validation->run() == FALSE) {
            foreach ($rules as $r) {
                $data['inputerror'][] = $r['field'];
                $this->form_validation->set_error_delimiters('', '');
                $data['error_string'][] = $this->form_validation->error($r['field']);
                $data['status'] = FALSE;
            }
        }

        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

    public function get_employee($id)
    {
        $employee = $this->db->get_where('employee', array(
            'id' => $id
        ))->row();
        return $employee;
    }

    // Employee List ====================================================================================

    public function count_activeEmployee()
    {
        $this->db->from($this->table);
        $this->db->where('termination',1);
        return $this->db->count_all_results();
    }

    private function _get_datatables_employee_query($term=''){ //term is value of $_REQUEST['search']['value']
        $column = array('employee.id','employee.employee_id' ,'employee.first_name','employee.last_name', 'department.department', 'job_title.job_title', 'emp_status.status_name','work_shift.shift_name');
        $this->db->select('employee.*, department.department as department_name, job_title.job_title as title, emp_status.status_name, work_shift.shift_name');
        $this->db->from('employee');

        $this->db->join('department', 'department.id = employee.department','left');
        $this->db->join('job_title', 'job_title.id = employee.title','left');
        $this->db->join('emp_status', 'emp_status.id = employee.employment_status','left');
        $this->db->join('work_shift', 'work_shift.id = employee.work_shift','left');

        $this->db->where('employee.termination', 1);
        $this->db->where('employee.soft_delete', 0);
        $this->db->group_start();
        $this->db->like('employee.first_name', $term);
        $this->db->or_like('employee.last_name', $term);
        $this->db->or_like('employee.employee_id', $term);
        $this->db->or_like('department.department', $term);
        $this->db->or_like('job_title.job_title', $term);
        $this->db->or_like('emp_status.status_name', $term);
        $this->db->or_like('work_shift.shift_name', $term);
        $this->db->group_end();


        if(isset($_REQUEST['order'])) // here order processing
        {
            $this->db->order_by($column[$_REQUEST['order']['0']['column']], $_REQUEST['order']['0']['dir']);
        }
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_employee_datatables(){
        $term = $_REQUEST['search']['value'];
        $this->_get_datatables_employee_query($term);

        if($_REQUEST['length'] != -1)
          $this->db->limit($_REQUEST['length'], $_REQUEST['start']);

        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered_employee(){
        $term = $_REQUEST['search']['value'];
        $this->_get_datatables_employee_query($term);
        $query = $this->db->get();
        return $query->num_rows();
    }

	
	
	
	
	
	
	
	
  // Task ====================================================================================

  
  
    private function _get_datatables_Task_query($term=''){ //term is value of $_REQUEST['search']['value']
        $column = array('employee.id','employee.employee_id' ,'employee.first_name','employee.last_name', 'department.department', 'job_title.job_title', 'emp_status.status_name','work_shift.shift_name');
        $this->db->select('task.*, employee.employee_id as employeeid, employee.first_name as Employeename, department.department');
        $this->db->from('task');
		$this->db->join('department', 'department.id = task.department_id','left');
        $this->db->join('employee', 'employee.id = task.employee_id','left');
        $this->db->where('employee.soft_delete', 0);
      //  $this->db->group_start();
        $this->db->like('employee.first_name', $term);
        $this->db->or_like('employee.employee_id', $term);
        $this->db->or_like('department.department', $term);
        $this->db->or_like('task.tile', $term);
        $this->db->or_like('task.Description', $term);
        $this->db->or_like('task.from_date', $term);
		$this->db->or_like('task.to_date', $term);
		$this->db->or_like('task.Created_on', $term);
      //  $this->db->group_end();


        if(isset($_REQUEST['order'])) // here order processing
        {
            $this->db->order_by($column[$_REQUEST['order']['0']['column']], $_REQUEST['order']['0']['dir']);
        }
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_task_datatables(){
        $term = $_REQUEST['search']['value'];
        $this->_get_datatables_Task_query($term);

        if($_REQUEST['length'] != -1)
          $this->db->limit($_REQUEST['length'], $_REQUEST['start']);

        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered_task(){
        $term = $_REQUEST['search']['value'];
        $this->_get_datatables_Task_query($term);
        $query = $this->db->get();
        return $query->num_rows();
    }


	
    // Terminated Employee List ====================================================================================

    public function count_terminatedEmployee()
    {
        $this->db->from($this->table);
        $this->db->where('termination',0);
        return $this->db->count_all_results();
    }

    private function _get_datatables_terminatedEmployee_query($term=''){ //term is value of $_REQUEST['search']['value']
        $column = array('employee.id','employee.employee_id' ,'employee.first_name','employee.last_name', 'department.department', 'job_title.job_title', 'emp_status.status_name','work_shift.shift_name');
        $this->db->select('employee.*, department.department as department_name, job_title.job_title as title, emp_status.status_name, work_shift.shift_name');
        $this->db->from('employee');

        $this->db->join('department', 'department.id = employee.department','left');
        $this->db->join('job_title', 'job_title.id = employee.title','left');
        $this->db->join('emp_status', 'emp_status.id = employee.employment_status','left');
        $this->db->join('work_shift', 'work_shift.id = employee.work_shift','left');

        $this->db->where('employee.termination', 0);
        $this->db->where('employee.soft_delete', 0);
        $this->db->group_start();
        $this->db->like('employee.first_name', $term);
        $this->db->or_like('employee.last_name', $term);
        $this->db->or_like('employee.employee_id', $term);
        $this->db->or_like('department.department', $term);
        $this->db->or_like('job_title.job_title', $term);
        $this->db->or_like('emp_status.status_name', $term);
        $this->db->or_like('work_shift.shift_name', $term);
        $this->db->group_end();


        if(isset($_REQUEST['order'])) // here order processing
        {
            $this->db->order_by($column[$_REQUEST['order']['0']['column']], $_REQUEST['order']['0']['dir']);
        }
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_terminatedEmployee_datatables(){
        $term = $_REQUEST['search']['value'];
        $this->_get_datatables_terminatedEmployee_query($term);

        if($_REQUEST['length'] != -1)
            $this->db->limit($_REQUEST['length'], $_REQUEST['start']);

        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered_terminatedEmployee(){
        $term = $_REQUEST['search']['value'];
        $this->_get_datatables_terminatedEmployee_query($term);
        $query = $this->db->get();
        return $query->num_rows();
    }


    //=======================================================================================================




    function get_transactions_dataTables($column = null,$id = null)
    {
        $term = $_REQUEST['search']['value'];

        $this->_get_datatables_transactions_query($term);
        if($_REQUEST['length'] != -1)
            $this->db->limit($_REQUEST['length'], $_REQUEST['start']);


        $query = $this->db->get();
        return $query->result();

    }

    private function _get_datatables_transactions_query($term='')
    {
        $column = array(
            'accounts_transactions.transaction_id','accounts_transactions.transaction_type' ,'accounts_transactions.account_id','accounts_transactions.category_id',
            'accounts_head.account_title', 'accounts_category.name'
        );
        $this->db->select('accounts_transactions.*, accounts_head.account_title as account_name, accounts_category.name as category_name');
        $this->db->from('accounts_transactions');

        $this->db->join('accounts_head', 'accounts_head.id = accounts_transactions.account_id','left');
        $this->db->join('accounts_category', 'accounts_category.id = accounts_transactions.category_id','left');

        if($this->col != '' && $this->colId !='') {
            $this->db->where('accounts_transactions.'.$this->col, $this->colId);
        }
        //$this->db->where($where);
        $this->db->group_start();
        $this->db->like('accounts_transactions.transaction_id', $term);
        $this->db->or_like('accounts_head.account_title', $term);
        $this->db->or_like('accounts_transactions.transaction_type', $term);
        $this->db->or_like('accounts_category.name', $term);
        $this->db->or_like('accounts_transactions.amount', $term);
        $this->db->or_like('accounts_transactions.balance', $term);
        $this->db->or_like('accounts_transactions.date_time', $term);
        $this->db->group_end();

        if(isset($_REQUEST['order'])) // here order processing
        {
            $this->db->order_by($column[$_REQUEST['order']['0']['column']], $_REQUEST['order']['0']['dir']);
        }
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }

    }

    function count_filtered_transactions(){
        $term = $_REQUEST['search']['value'];
        $this->_get_datatables_transactions_query($term);
        $query = $this->db->get();
        return $query->num_rows();
    }


    public function count_all_transactions()
    {
        $this->db->from($this->table);
        if($this->col != '' && $this->colId !='') {
            $this->db->where($this->col, $this->colId);
        }
        return $this->db->count_all_results();
    }

    // all transactional List ==================================================================================>

    // employee award List ==================================================================================>

    private function _get_datatables_award_query($term=''){ //term is value of $_REQUEST['search']['value']
        $column = array('employee.employee_id' ,'employee.first_name','employee.last_name', 'employee_award.award_name', 'employee_award.gift_item', 'employee_award.award_amount','employee_award.award_month');
        $this->db->select('employee_award.*, employee.employee_id as employee_personal_id, employee.first_name , employee.last_name, employee.termination');
        $this->db->from('employee_award');

        $this->db->join('employee', 'employee.id = employee_award.employee_id','left');

        $this->db->like('employee.first_name', $term);
        $this->db->or_like('employee.last_name', $term);
        $this->db->or_like('employee.employee_id', $term);
        $this->db->or_like('employee_award.award_name', $term);
        $this->db->or_like('employee_award.gift_item', $term);
        $this->db->or_like('employee_award.award_amount', $term);
        $this->db->or_like('employee_award.award_month', $term);



        if(isset($_REQUEST['order'])) // here order processing
        {
            $this->db->order_by($column[$_REQUEST['order']['0']['column']], $_REQUEST['order']['0']['dir']);
        }
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_award_datatables(){
        $term = $_REQUEST['search']['value'];
        $this->_get_datatables_award_query($term);

        if($_REQUEST['length'] != -1)
            $this->db->limit($_REQUEST['length'], $_REQUEST['start']);

        $query = $this->db->get();
        return $query->result();
    }
	
    private function _get_datatables_deduction_query($term=''){ //term is value of $_REQUEST['search']['value']
        $column = array('employee.employee_id' ,'employee.first_name','employee.last_name', 'employee_deduction.Deduction_name', 'employee_deduction.Description', 'employee_deduction.deduction_amount','employee_deduction.Deduction_month');
        $this->db->select('employee_deduction.*, employee.employee_id as employee_personal_id, employee.first_name , employee.last_name, employee.termination');
        $this->db->from('employee_deduction');

        $this->db->join('employee', 'employee.id = employee_deduction.employee_id','left');
        $this->db->where('employee_deduction.Soft_delete',0);
        $this->db->like('employee.first_name', $term);
        $this->db->or_like('employee.last_name', $term);
        $this->db->or_like('employee.employee_id', $term);
        $this->db->or_like('employee_deduction.Deduction_name', $term);
        $this->db->or_like('employee_deduction.Description', $term);
        $this->db->or_like('employee_deduction.deduction_amount', $term);
        $this->db->or_like('employee_deduction.Deduction_month', $term);



        if(isset($_REQUEST['order'])) // here order processing
        {
            $this->db->order_by($column[$_REQUEST['order']['0']['column']], $_REQUEST['order']['0']['dir']);
        }
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
	
	///advance
	
	
    function get_advance_datatables(){
        $term = $_REQUEST['search']['value'];
        $this->_get_datatables_advance_query($term);

        if($_REQUEST['length'] != -1)
            $this->db->limit($_REQUEST['length'], $_REQUEST['start']);

        $query = $this->db->get();
        return $query->result();
    }
	
    private function _get_datatables_advance_query($term=''){ //term is value of $_REQUEST['search']['value']
        $column = array('employee.employee_id' ,'employee.first_name','employee.last_name', 'employee_advance.Advance_date', 'employee_advance.Purpose', 'employee_advance.Amount_amount','employee_advance.Tenture,employee_advance.IS_PAID');
        $this->db->select('employee_advance.*, employee.employee_id as employee_personal_id, employee.first_name , employee.last_name, employee.termination');
        $this->db->from('employee_advance');

        $this->db->join('employee', 'employee.id = employee_advance.employee_id','left');
        $this->db->where('employee_advance.Soft_delete',0);
        $this->db->like('employee.first_name', $term);
        $this->db->or_like('employee.last_name', $term);
        $this->db->or_like('employee.employee_id', $term);
        $this->db->or_like('employee_advance.Amount_amount', $term);
        $this->db->or_like('employee_advance.Purpose', $term);
        $this->db->or_like('employee_advance.Tenture', $term);
        //$this->db->or_like('employee_advance.Advance_date', $term);



        if(isset($_REQUEST['order'])) // here order processing
        {
            $this->db->order_by($column[$_REQUEST['order']['0']['column']], $_REQUEST['order']['0']['dir']);
        }
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
	
	
	
	
	
	
	
	
	/////////////
 function get_duction_datatables(){
        $term = $_REQUEST['search']['value'];
        $this->_get_datatables_deduction_query($term);

        if($_REQUEST['length'] != -1)
            $this->db->limit($_REQUEST['length'], $_REQUEST['start']);

        $query = $this->db->get();
        return $query->result();
    }
    function count_filtered_award(){
        $term = $_REQUEST['search']['value'];
        $this->_get_datatables_award_query($term);
        $query = $this->db->get();
        return $query->num_rows();
    }


    // Mailing List ==================================================================================>

    public function count_inbox()
    {
        $id = $this->ion_auth->user()->row()->id;
        $this->db->from($this->table);
        $this->db->where('to_emp_id', $id);
        $this->db->where('to_type', 'admin');
        return $this->db->count_all_results();
    }

    private function _get_inbox_query($term=''){ //term is value of $_REQUEST['search']['value']
        $id = $this->ion_auth->user()->row()->id;
        $column = array('sender_name','subject' ,'attachment','date',null,null);
        $this->db->select('inbox.*');
        $this->db->from('inbox');

        $this->db->where('to_emp_id', $id);
        $this->db->where('to_type', 'admin');
        $this->db->order_by('id', 'desc');
        $this->db->group_start();
        $this->db->like('sender_name', $term);
        $this->db->or_like('subject', $term);
        $this->db->or_like('date', $term);
        $this->db->group_end();


        if(isset($_REQUEST['order'])) // here order processing
        {
            $this->db->order_by($column[$_REQUEST['order']['0']['column']], $_REQUEST['order']['0']['dir']);
        }
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_inbox_datatables(){
        $term = $_REQUEST['search']['value'];
        $this->_get_inbox_query($term);

        if($_REQUEST['length'] != -1)
            $this->db->limit($_REQUEST['length'], $_REQUEST['start']);

        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered_inbox(){
        $term = $_REQUEST['search']['value'];
        $this->_get_inbox_query($term);
        $query = $this->db->get();
        return $query->num_rows();
    }

    // Sent Item Mailing List ==================================================================================>

    public function count_sentItem()
    {
     //   $id = $this->ion_auth->user()->row()->id;
        $this->db->from($this->table);
        $this->db->where('from_emp_id', $id);
        $this->db->where('from_type', 'admin');
        return $this->db->count_all_results();
    }

    private function _get_sentitem_query($term=''){ //term is value of $_REQUEST['search']['value']
        //$id = $this->ion_auth->user()->row()->id;

        $column = array('from_type','subject' ,'attachment','date',null);
        $this->db->select('outbox.*');
        $this->db->from('outbox');

        $this->db->where('from_emp_id', $id);
        $this->db->where('from_type', 'admin');

        $this->db->order_by('id', 'desc');
        $this->db->group_start();
        $this->db->like('from_type', $term);
        $this->db->or_like('subject', $term);
        $this->db->or_like('date', $term);
        $this->db->group_end();


        if(isset($_REQUEST['order'])) // here order processing
        {
            $this->db->order_by($column[$_REQUEST['order']['0']['column']], $_REQUEST['order']['0']['dir']);
        }
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_sentitem_datatables(){
        $term = $_REQUEST['search']['value'];
        $this->_get_sentitem_query($term);

        if($_REQUEST['length'] != -1)
            $this->db->limit($_REQUEST['length'], $_REQUEST['start']);

        $query = $this->db->get();

        return $query->result();
    }

    function count_filtered_sentitem(){
        $term = $_REQUEST['search']['value'];
        $this->_get_sentitem_query($term);
        $query = $this->db->get();
        return $query->num_rows();
    }
	/* NEW REQUIREMENT - ASSISMENT, SRRF, EIF, PROBATIONARY PERFORMANCE, PERFORMANCE APPRAISAL FORMS */
	
	public function get_education_master() {
        $this->db->select('*');
        $this->db->from('education_master');
        $query_result = $this->db->get();
        $result = $query_result->result_array();
        return $result;
    }
	
	public function get_skills_master() {
        $this->db->select('*');
        $this->db->from('skills_master');
        $query_result = $this->db->get();
        $result = $query_result->result_array();
        return $result;
    }
	
	public function get_education($id)
    {
		$this->db->select('*');
        $this->db->from('education');
		$this->db->where('candidate_id', $id);
		 
        $query_result = $this->db->get();
        $result = $query_result->result_array();
		
		return $result;
    }
	
	public function get_work_experience($id)
    {
		$this->db->select('*');
        $this->db->from('work_experience');
		$this->db->where('candidate_id', $id);
		 
        $query_result = $this->db->get();
        $result = $query_result->result_array();
		
		return $result;
    }
	
	public function get_skills($id)
    {
		$this->db->select('*');
        $this->db->from('skills');
		$this->db->where('candidate_id', $id);
		 
        $query_result = $this->db->get();
        $result = $query_result->result_array();
		
		return $result;
    }
	
	public function get_additional_skills($id)
    {
        $result = $this->db->get_where('additional_skills', array(
            'candidate_id' => $id
        ))->row();
		return $result;
    }
	
	public function get_srrf($id)
    {
        $result = $this->db->get_where('srrf', array(
            'id' => $id
        ))->row();
		return $result;
    }
	
	public function get_employee_eif($id)
    {
        $result = $this->db->get_where('eif', array(
            'employee_id' => $id
        ))->row();
		return $result;

    }
	
	public function get_employee_pro_performance($id)
    {
        $result = $this->db->get_where('probationary_performance', array(
            'employee_id' => $id
        ))->row();
		return $result;

    }
	
	public function get_employee_per_plan($id)
    {
		$this->db->select('*');
        $this->db->from('performance_plan');
		$this->db->where('employee_id', $id);
		 
        $query_result = $this->db->get();
        $result = $query_result->result_array();
		
		return $result;
    }
	
	public function get_employee_per_appraisal($id)
    {
		
		 $result = $this->db->get_where('appraisal', array(
            'employee_id' => $id
        ))->row();
		return $result;
		
    }
	
	

}
