<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Office extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        ///$this->load->library('form_builder');
        ///$this->load->model('payrosettings_model');
        $this->load->model('payroll/global_model');
        $this->load->model('payroll/settings_model');
        $this->load->model('payroll/attendance_model');

        $this->load->library('datatables');
    }
    public function workingDays()
    {
        //$this->mTitle .= lang('set_working_days');
        ///    $this->mViewData['workingDays'] = $this->db->get('working_days')->result();
        ///$this->render('office/working_days');
        $data['workingDays'] = $this->db->get('working_days')->result();
        $data['page_title'] = lang('set_working_days');
        $this->render_admin('payroll/office/working_days', $data);
    }

    public function save_working_days()
    {
        $workingDaysId = $this->input->post('working_days');
        $days = $this->input->post('days');
        foreach ($days as $day) {
            foreach ($workingDaysId as $id) {
                if ($day == $id) {
                    $data['flag'] = 1;
                    $this->db->where('id', $id);
                    $this->db->update('working_days', $data);
                    $val = array_search($id, $days);
                    unset($days[$val]);
                }
            }
        }
        foreach ($days as $day) {
            $data['flag'] = 0;
            $this->db->where('id', $day);
            $this->db->update('working_days', $data);
        }
        $this->session->set_flashdata('message', lang('save_success'));
        redirect('admin/payroll/office/workingDays');

    }

    public function holidayList()
    {
        // get yearly report
        if ($this->input->post('year', true)) { // if input data
            $year = $this->input->post('year', true);
            $data['year'] = $year;
        } else {
            $year = date('Y'); // present year select
            $data['year'] = $year;
        }
        $data['yearly_holiday'] = $this->get_yearly_holiday($year); // get yearly report
        $data['page_title'] = lang('list_of_holiday');
        $this->render_admin('payroll/office/holidays', $data);
    }

    /*** Get Yearly Report ***/
    public function get_yearly_holiday($year)
    {
        for ($i = 1; $i <= 12; $i++) { // query for months
            if ($i >= 1 && $i <= 9) {
                $start_date = $year . '-' . '0' . $i . '-' . '01';
                $end_date = $year . '-' . '0' . $i . '-' . '31';
            } else {
                $start_date = $year . '-' . $i . '-' . '01';
                $end_date = $year . '-' . $i . '-' . '31';
            }
            $get_all_holiday[$i] = $this->settings_model->get_all_holiday_by_date($start_date, $end_date); // get all report by start date and in date
        }
        return $get_all_holiday;
    }

    public function add_holiday($id = null)
    {
        if (!empty($id)) {
            $data['holiday'] = $this->db->get_where('holidays', array(
                'holiday_id' => $id,
            ))->row();
        } else {
            $data['holiday'] = '';
        }
        $data['modal_subview'] = $this->load->view('admin/office/add_holiday', $data, false);
        $this->load->view('admin/_partials/_layout_modal_small', $data);
    }
    public function holiday_form($id = false)
    {
        $data['page_title'] = lang('add_holiday');
        $query = $this->db->get_where('holidays', array('holiday_id' => $id));
        if ($query->num_rows() > 0) {
            $data['page_title'] = lang('edit_holiday');
            $holiday = $query->row();
        }
        $data['holiday_id'] = !empty($holiday->holiday_id) ? $holiday->holiday_id : '';
        $data['event_name'] = !empty($holiday->event_name) ? $holiday->event_name : '';
        $data['description'] = !empty($holiday->description) ? $holiday->description : '';
        $data['start_date'] = !empty($holiday->start_date) ? $holiday->start_date : '';
        $data['end_date'] = !empty($holiday->end_date) ? $holiday->end_date : '';
        $this->render_admin('payroll/office/holiday_form', $data);

    }

    public function save_holiday()
    {
        $holiday_id = $this->input->post('holiday_id');
        $this->form_validation->set_rules('event_name', lang('event_name'), 'required');
        $this->form_validation->set_rules('description', lang('description'), 'required');
        $this->form_validation->set_rules('start_date', lang('start_date'), 'required');
        $this->form_validation->set_rules('end_date', lang('end_date'), 'required');
        if ($this->form_validation->run() == true) {
            $data['event_name'] = $this->input->post('event_name');
            $data['description'] = $this->input->post('description');
            $data['start_date'] = date("Y-m-d H:i:s", strtotime($this->input->post('start_date')));
            $data['end_date'] = date("Y-m-d H:i:s", strtotime($this->input->post('end_date')));
            if (empty($holiday_id)) {
                $this->db->insert('holidays', $data);
            } else {
                $this->db->where('holiday_id', $holiday_id);
                $this->db->update('holidays', $data);
            }
            $this->session->set_flashdata('message', lang('save_success'));
            redirect('admin/payroll/office/holidayList');
        } else {
            //$this->session->set_flashdata('error', lang('data_not_saved'));
            //redirect('admin/payroll/office/holidayList');
            $this->render_admin('payroll/office/holiday_form', $data);
        }

    }
    //============================================================
    //************************Leave Type*******************
    //============================================================

    public function leaveType()
    {
        $data['page_title'] = lang('list_leave_type');
        $data['category'] = $this->db->get_where('payroll_category_settings', array('Soft_delete' => 0))->result();
        $this->render_admin('payroll/office/leave_type_list', $data);
    }
    public function get_leaveType()
    {
        $actions = "<div class=\"text-center\">";
        $actions .= '<div class="btn-group"><a style="padding:6px;" class="btn btn-xs btn-default" href="javascript:void(0)" onclick="edit_title(' . "'" . '$1' . "'" . ')"><i class="fa fa-pencil"></i></a>
        		<a class="btn btn-xs btn-danger" style="margin-left:6px;padding:6px;" href="javascript:void(0)"  onclick="deleteItem(' . "'" . '$1' . "'" . ')"><i class="glyphicon glyphicon-trash"></i></a></div>';
        $actions .= "</div>";
        $this->datatables
            ->select("id  ,leave_category ", false)
            ->from("payroll_leave_application_type")
            ->add_column("Actions", $actions, "id");
        echo $this->datatables->generate();
    }
    public function leaveType_list()
    {
        $this->global_model->table = 'payroll_leave_application_type';
        $this->global_model->column_order = array('leave_category', null);
        $this->global_model->column_search = array('leave_category');
        $this->global_model->order = array('id' => 'desc');
        $list = $this->global_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $item->id;
            $row[] = $item->leave_category;
            //add html for action
            $row[] = '<div class="btn-group"><a class="btn btn-xs btn-default" href="javascript:void(0)" onclick="edit_title(' . "'" . $item->id . "'" . ')"><i class="fa fa-pencil"></i></a>
    		<a class="btn btn-xs btn-danger" style="margin-left:12px;" href="javascript:void(0)"  onclick="deleteItem(' . "'" . $item->id . "'" . ')"><i class="glyphicon glyphicon-trash"></i></a></div>';
            $data[] = $row;
        }
        $this->global_model->render_table($data);
    }

    public function add_leave_category()
    {
        $this->global_model->table = 'payroll_leave_application_type';
        $catagory_id = json_encode($this->input->post('Category_id'));
        $this->_leave_category_validate();
        $data = array(
            'leave_category' => $this->input->post('leave_category'),
            //    'YearLimit' => $this->input->post('YearLimit'),
            //    'Consider_as' => $this->input->post('carryforward'),
            //'Carry_forward_limit' => $this->input->post('carry_forward_limit'),
            'Category_type_id' => $catagory_id,
            'Deduct_days' => $this->input->post('Deduct_days'),
        );
        $insert = $this->global_model->save($data);
        echo json_encode(array("status" => true));
    }
    public function LeaveCategoryExist()
    {
        $leavename = $this->input->post('leave_category');
        $check = $this->db->get_where('payroll_leave_application_type', array('leave_category' => $leavename))->row();
        if (empty($check)) {
            return true;
        } else {
            return false;
        }
    }
    private function _leave_category_validate()
    {
        $rules = array(
            array('field' => 'leave_category', 'label' => lang('leave_type'), 'rules' => 'trim|required|is_unique[leave_application_type.leave_category]'),
            array('field' => 'Deduct_days', 'label' => lang('Deduct_days'), 'rules' => 'trim|required|numeric|xss_clean'));
        $this->global_model->validation($rules);
    }
    public function edit_leave_category($id)
    {
        $this->global_model->table = 'payroll_leave_application_type';
        $data1 = $this->global_model->get_by_id($id);
        $datas = $this->db->query("SELECT Category_type_id FROM `payroll_leave_application_type` lpt WHERE id='" . $id . "'")->row();
        $category_ids = json_decode($datas->Category_type_id);
        $ids = join("','", $category_ids);
        $catagory_names = $this->db->query("SELECT  id,Categoryname  FROM `payroll_category_settings` WHERE id IN('" . $ids . "')")->result();
        $selectbox = '';
        foreach ($catagory_names as $catagory_name) {
            $selectbox .= '<option value="' . $catagory_name->id . '" selected>' . $catagory_name->Categoryname . '</option>';
        }
        $selectboxs = (object) $selectbox;
        $obj_merged = (object) array_merge((array) $selectboxs, (array) $data1);
        echo json_encode($obj_merged);
    }

    public function update_leave_category()
    {
        $this->global_model->table = 'payroll_leave_application_type';
        //$this->_leave_category_validate();
        $catagory_id = json_encode($this->input->post('Category_id'));
        $data = array(
            'leave_category' => $this->input->post('leave_category'),
            //    'YearLimit' => $this->input->post('YearLimit'),
            //    'Consider_as' => $this->input->post('carryforward'),
            //'Carry_forward_limit' => $this->input->post('carry_forward_limit'),
            'Category_type_id' => $catagory_id,
            'Deduct_days' => $this->input->post('Deduct_days'),
        );
        $this->global_model->update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => true));
    }

    public function delete_leave_category($id)
    {
        $this->global_model->table = 'payroll_leave_application_type';
        $leave_category = $this->db->get_where('payroll_attendanc_sheet', array(
            'leave_category_id' => $id,
        ))->row();
        if (empty($leave_category)) {
            $this->global_model->delete_by_id($id);
            echo 1;
        } else {
            echo 0;
        }
    }

    public function deleteHoliday($id = null)
    {
        if (!empty($id)) {
            $this->db->delete('holidays', array('holiday_id' => $id));
            $this->session->set_flashdata('message', lang('delete_success'));
            redirect('admin/payroll/office/holidayList');
        } else {
            $this->session->set_flashdata('error', lang('no_record_found'));
            redirect('admin/payroll/office/holidayList');
        }
    }

    //============================================================
    //************************Department**************************
    //============================================================
    public function department()
    {
        $data['page_title'] = lang('department');
        $this->render_admin('payroll/office/department', $data);
    }
    public function get_department()
    {
        $actions = "<div class=\"text-center\">";
        $actions .= '<div class="btn-group"><a style="padding:6px;" class="btn btn-xs btn-default" href="javascript:void(0)" onclick="edit_title(' . "'" . '$1' . "'" . ')"><i class="fa fa-pencil"></i></a>
        		<a class="btn btn-xs btn-danger" style="margin-left:6px;padding:6px;" href="javascript:void(0)"  onclick="deleteItem(' . "'" . '$1' . "'" . ')"><i class="glyphicon glyphicon-trash"></i></a></div>';
        $actions .= "</div>";
        $this->datatables
            ->select("id  ,department ,  description ", false)
            ->from("payroll_department")
            ->add_column("Actions", $actions, "id");
        echo $this->datatables->generate();
    }
    public function edit_department($id)
    {
        $this->global_model->table = 'payroll_department';
        $data = $this->global_model->get_by_id($id);
        echo json_encode($data);
    }
    public function add_department()
    {
        $this->global_model->table = 'payroll_department';
        $this->_department_validate();
        $data = array(
            'department' => $this->input->post('department'),
            'description' => $this->input->post('description'),

        );
        $insert = $this->global_model->save($data);
        echo json_encode(array("status" => true));
    }

    public function update_department()
    {
        $this->global_model->table = 'payroll_department';
        $this->_department_validate();
        $data = array(
            'department' => $this->input->post('department'),
            'description' => $this->input->post('description'),
        );
        $this->global_model->update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => true));
    }

    public function delete_department($id)
    {
        $this->global_model->table = 'payroll_department';
        $result = $this->db->get_where('payroll_employee', array('department' => $id))->result();
        if (empty($result)) {
            $this->global_model->delete_by_id($id);
            echo 1;
        } else {
            echo 0;
        }

    }

    private function _department_validate()
    {
        $rules = array(
            array('field' => 'department', 'label' => lang('department'), 'rules' => 'trim|required'),
            array('field' => 'description', 'label' => lang('description'), 'rules' => 'trim|required'),
        );

        $this->global_model->validation($rules);
    }

    //============================================================
    //************************Job Title***************************
    //============================================================

    /* function jobTitle()
    {

    $this->mTitle= lang('job_title');
    $this->render('office/job_title');
    }

    public function title_list()
    {

    $this->global_model->table = 'job_title';
    $this->global_model->column_order = array('job_title','description',null);
    $this->global_model->column_search = array('job_title','description');
    $this->global_model->order = array('id' => 'desc');
    $list = $this->global_model->get_datatables();
    $data = array();
    $no = $_POST['start'];
    foreach ($list as $item) {
    $no++;
    $row = array();
    $row[] = $item->job_title;
    $row[] = $item->description;

    //add html for action
    $row[] = '<div class="btn-group"><a class="btn btn-xs btn-default" href="javascript:void(0)" onclick="edit_title('."'".$item->id."'".')"><i class="fa fa-pencil"></i></a>
    <a class="btn btn-xs btn-danger"  style="margin-left:12px;" href="javascript:void(0)"  onclick="deleteItem('."'".$item->id."'".')"><i class="glyphicon glyphicon-trash"></i></a></div>';
    $data[] = $row;
    }
    $this->global_model->render_table($data);
    } */
    public function jobTitle()
    {
        $data['page_title'] = lang('job_title');
        $this->render_admin('payroll/office/job_title', $data);
    }
    public function get_jobTitle()
    {
        $actions = "<div class=\"text-center\">";
        $actions .= '<div class="btn-group"><a style="padding:6px;" class="btn btn-xs btn-default" href="javascript:void(0)" onclick="edit_title(' . "'" . '$1' . "'" . ')"><i class="fa fa-pencil"></i></a>
        		<a class="btn btn-xs btn-danger" style="margin-left:6px;padding:6px;" href="javascript:void(0)"  onclick="deleteItem(' . "'" . '$1' . "'" . ')"><i class="glyphicon glyphicon-trash"></i></a></div>';
        $actions .= "</div>";
        $this->datatables
            ->select("   id , job_title ,   description    ", false)
            ->from("payroll_job_title")
            ->add_column("Actions", $actions, "id");
        echo $this->datatables->generate();
    }

    public function title_edit($id)
    {
        $this->global_model->table = 'payroll_job_title';
        $data = $this->global_model->get_by_id($id);
        echo json_encode($data);
    }

    public function title_add()
    {
        $this->global_model->table = 'payroll_job_title';
        $this->_title_validate();
        $data = array(
            'job_title' => $this->input->post('job_title'),
            'description' => $this->input->post('description'),
        );
        $insert = $this->global_model->save($data);
        echo json_encode(array("status" => true));
    }

    public function title_update()
    {
        $this->global_model->table = 'payroll_job_title';
        $this->_title_validate();
        $data = array(
            'job_title' => $this->input->post('job_title', true),
            'description' => $this->input->post('description'),
        );
        $this->global_model->update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => true));
    }

    public function title_delete($id)
    {
        $this->global_model->table = 'payroll_job_title';
        $result = $this->db->get_where('employee', array('title' => $id))->result();
        if (empty($result)) {
            $this->global_model->delete_by_id($id);
            echo 1;
        } else {
            echo 0;
        }

    }
    private function _title_validate()
    {
        $rules = array(
            array('field' => 'job_title', 'label' => lang('job_title'), 'rules' => 'trim|required'),
            array('field' => 'description', 'label' => lang('description'), 'rules' => 'trim|required'),
        );
        $this->global_model->validation($rules);
    }

    //============================================================
    //************************Salary Component********************
    //============================================================

    public function salaryComponent()
    {
        $data['Component'] = $this->db->get_where('payroll_salary_component', array('Soft_delete' => 0))->result();
        $data['page_title'] = lang('department');
        $this->render_admin('payroll/office/salary_component', $data);

    }
    public function get_salaryComponent()
    {
        $actions = "<div class=\"text-center\">";
        $actions .= '<div class="btn-group"><a style="padding:6px;" class="btn btn-xs btn-default" href="javascript:void(0)" onclick="edit_title(' . "'" . '$1' . "'" . ')"><i class="fa fa-pencil"></i></a>
        		<a class="btn btn-xs btn-danger" style="margin-left:6px;padding:6px;" href="javascript:void(0)"  onclick="deleteItem(' . "'" . '$1' . "'" . ')"><i class="glyphicon glyphicon-trash"></i></a></div>';
        $actions .= "</div>";
        $this->datatables
            ->select("id  ,component_name ,CASE
    WHEN type=1 THEN 'Earning'
    WHEN type=2 THEN 'Deduction'
END as type  ,CASE
    WHEN total_payable=1 THEN 'Yes'
    WHEN total_payable=0 THEN 'No'
END as total_payable,CASE
    WHEN cost_company=1 THEN 'Yes'
    WHEN cost_company=0 THEN 'No'
END as cost_company,CASE
    WHEN value_type=1 THEN 'Amount'
    WHEN value_type=2 THEN 'percentage'
END as value_type ", false)
            ->from("payroll_salary_component")
            ->add_column("Actions", $actions, "id");
        echo $this->datatables->generate();
    }

    public function edit_salary_component($id)
    {
        $this->global_model->table = 'payroll_salary_component';
        $data = $this->global_model->get_by_id($id);
        echo json_encode($data);
    }

    public function add_salary_component()
    {
        $this->global_model->table = 'payroll_salary_component';
        $this->_salary_component_validate();
        $total_payable = (!empty($this->input->post('total_payable')) ? $this->input->post('total_payable') : 0);
        $cost_company = (!empty($this->input->post('cost_company')) ? $this->input->post('cost_company') : 0);
        $of_what_id = (!empty($this->input->post('Of_what')) ? $this->input->post('Of_what') : 0);
        $include_tax = (!empty($this->input->post('taxable')) ? $this->input->post('taxable') : 0);
        $data = array(
            'component_name' => $this->input->post('component_name'),
            'type' => $this->input->post('type'),
            'total_payable' => $total_payable,
            'cost_company' => $cost_company,
            'value_type' => $this->input->post('value_type'),
            'Of_what_id' => $of_what_id,
            'Include_tax' => $include_tax,
            'Is_salary_component' => 1,
        );
        $insert = $this->global_model->save($data);
        echo json_encode(array("status" => true));
    }

    public function update_salary_component()
    {
        $this->global_model->table = 'payroll_salary_component';
        $this->_salary_component_validate();
        $total_payable = (!empty($this->input->post('total_payable')) ? $this->input->post('total_payable') : 0);
        $cost_company = (!empty($this->input->post('cost_company')) ? $this->input->post('cost_company') : 0);
        $of_what_id = (!empty($this->input->post('Of_what')) ? $this->input->post('Of_what') : 0);
        $include_tax = (!empty($this->input->post('taxable')) ? $this->input->post('taxable') : 0);
        $data = array(
            'component_name' => $this->input->post('component_name'),
            'type' => $this->input->post('type'),
            'total_payable' => $total_payable,
            'cost_company' => $cost_company,
            'value_type' => $this->input->post('value_type'),
            'Of_what_id' => $of_what_id,
            'Include_tax' => $include_tax,
            'Is_salary_component' => 1,
        );
        $this->global_model->update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => true));
    }

    public function delete_salary_component($id)
    {
        $this->global_model->table = 'payroll_salary_component';
        $result = $this->db->get_where('component', array('component_id' => $id))->result();
        if (empty($result)) {
            $this->global_model->delete_by_id($id);
            echo 1;
        } else {
            echo 0;
        }
    }
    private function _salary_component_validate()
    {
        $rules = array(
            array('field' => 'component_name', 'label' => 'Component Name', 'rules' => 'trim|required'));
        $this->global_model->validation($rules);
    }

    //============================================================
    //***************************Pay Grade************************
    //============================================================

    public function payGrades()
    {
        $this->mTitle = lang('pay_grade');
        $this->render('office/pay_grade');
    }

    public function pay_grade_list()
    {
        $this->global_model->table = 'salary_grade';
        $this->global_model->column_order = array('grade_name', 'min_salary', 'max_salary', null);
        $this->global_model->column_search = array('grade_name', 'min_salary', 'max_salary');
        $this->global_model->order = array('grade_name' => 'asc');
        $list = $this->global_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $item->grade_name;
            $row[] = $item->min_salary;
            $row[] = $item->max_salary;
            //add html for action
            $row[] = '<div class="btn-group"><a class="btn btn-xs btn-default" href="javascript:void(0)" onclick="edit_title(' . "'" . $item->id . "'" . ')"><i class="fa fa-pencil"></i></a>
    		<a class="btn btn-xs btn-danger" style="margin-left:12px;" href="javascript:void(0)"  onclick="deleteItem(' . "'" . $item->id . "'" . ')"><i class="glyphicon glyphicon-trash"></i></a></div>';
            $data[] = $row;
        }
        $this->global_model->render_table($data);
    }

    public function edit_pay_grade($id)
    {
        $this->global_model->table = 'salary_grade';
        $data = $this->global_model->get_by_id($id);
        echo json_encode($data);
    }

    public function add_pay_grade()
    {
        $this->global_model->table = 'salary_grade';
        $this->_pay_grade_validate();
        $data = array(
            'grade_name' => $this->input->post('grade_name', true),
            'min_salary' => floatval($this->input->post('min_salary')),
            'max_salary' => floatval($this->input->post('max_salary')),
        );
        $insert = $this->global_model->save($data);
        echo json_encode(array("status" => true));
    }

    public function update_pay_grade()
    {
        $this->global_model->table = 'salary_grade';
        $this->_pay_grade_validate();
        $data = array(
            'grade_name' => $this->input->post('grade_name', true),
            'min_salary' => floatval($this->input->post('min_salary')),
            'max_salary' => floatval($this->input->post('max_salary')),
        );
        $this->global_model->update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => true));
    }

    public function delete_pay_grade($id)
    {
        $this->global_model->table = 'salary_grade';
        $result = $this->db->get_where('salary', array('grade_id' => $id))->result();
        if (empty($result)) {
            $this->global_model->delete_by_id($id);
            echo 1;
        } else {
            echo 0;
        }
    }
    private function _pay_grade_validate()
    {
        $rules = array(
            array('field' => 'grade_name', 'label' => lang('pay_grade'), 'rules' => 'trim|required'),
            array('field' => 'min_salary', 'label' => lang('min_salary'), 'rules' => 'trim|required'),
            array('field' => 'max_salary', 'label' => lang('max_salary'), 'rules' => 'trim|required'),

        );

        $this->global_model->validation($rules);
    }

    //============================================================
    //***************************Emp Status***********************
    //============================================================

    public function employmentStatus()
    {
        $this->mTitle = lang('emp_status');
        $this->render('office/employee_status');
    }

    public function emp_status_list()
    {
        $this->global_model->table = 'emp_status';
        $this->global_model->column_order = array('status_name', null);
        $this->global_model->column_search = array('status_name');
        $this->global_model->order = array('status_name' => 'asc');

        $list = $this->global_model->get_datatables();

        $data = array();
        $no = $_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $item->status_name;

            //add html for action
            $row[] = '<div class="btn-group"><a class="btn btn-xs btn-default" href="javascript:void(0)" onclick="edit_title(' . "'" . $item->id . "'" . ')"><i class="fa fa-pencil"></i></a>
    		<a class="btn btn-xs btn-danger" style="margin-left:12px;" href="javascript:void(0)"  onclick="deleteItem(' . "'" . $item->id . "'" . ')"><i class="glyphicon glyphicon-trash"></i></a></div>';
            $data[] = $row;
        }
        $this->global_model->render_table($data);
    }

    public function edit_emp_status($id)
    {
        $this->global_model->table = 'emp_status';
        $data = $this->global_model->get_by_id($id);
        echo json_encode($data);
    }

    public function add_emp_status()
    {
        $this->global_model->table = 'emp_status';
        $this->_emp_status_validate();
        $data = array(
            'status_name' => $this->input->post('status_name', true),
        );
        $insert = $this->global_model->save($data);
        echo json_encode(array("status" => true));
    }

    public function update_emp_status()
    {
        $this->global_model->table = 'emp_status';
        $this->_emp_status_validate();
        $data = array(
            'status_name' => $this->input->post('status_name', true),
        );
        $this->global_model->update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => true));
    }

    public function delete_emp_status($id)
    {
        $this->global_model->table = 'emp_status';
        $empStatus = $this->db->get_where('job_history', array('employment_status' => $id))->result();
        $emp = $this->db->get_where('employee', array('employment_status' => $id))->result();

        if (empty($emp || $empStatus)) {
            $this->global_model->delete_by_id($id);
            echo 1;
        } else {
            echo 0;
        }
    }

    private function _emp_status_validate()
    {
        $rules = array(
            array('field' => 'status_name', 'label' => lang('emp_status'), 'rules' => 'trim|required'),

        );

        $this->global_model->validation($rules);
    }

    //============================================================
    //***************************Job Categories*******************
    //============================================================

    public function jobCategories()
    {
        $this->mTitle = lang('job_categories');
        $this->render('office/job_categories');
    }

    public function job_categories_list()
    {
        $this->global_model->table = 'job_category';
        $this->global_model->column_order = array('category_name', null);
        $this->global_model->column_search = array('category_name');
        $this->global_model->order = array('category_name' => 'asc');

        $list = $this->global_model->get_datatables();

        $data = array();
        $no = $_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $item->category_name;

            //add html for action
            $row[] = '<div class="btn-group"><a class="btn btn-xs btn-default" href="javascript:void(0)" onclick="edit_title(' . "'" . $item->id . "'" . ')"><i class="fa fa-pencil"></i></a>
    		<a class="btn btn-xs btn-danger" style="margin-left:12px;" href="javascript:void(0)"  onclick="deleteItem(' . "'" . $item->id . "'" . ')"><i class="glyphicon glyphicon-trash"></i></a></div>';
            $data[] = $row;
        }
        $this->global_model->render_table($data);
    }

    public function edit_job_categories($id)
    {
        $this->global_model->table = 'job_category';
        $data = $this->global_model->get_by_id($id);
        echo json_encode($data);
    }

    public function add_job_categories()
    {
        $this->global_model->table = 'job_category';
        $this->_job_categories_validate();
        $data = array(
            'category_name' => $this->input->post('category_name', true),
        );
        $insert = $this->global_model->save($data);
        echo json_encode(array("status" => true));
    }

    public function update_job_categories()
    {
        $this->global_model->table = 'job_category';
        $this->_job_categories_validate();
        $data = array(
            'category_name' => $this->input->post('category_name', true),
        );
        $this->global_model->update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => true));
    }

    public function delete_job_categories($id)
    {
        $this->global_model->table = 'job_category';
        $empCategory = $this->db->get_where('job_history', array('category' => $id))->result();
        $emp = $this->db->get_where('employee', array('category' => $id))->result();

        if (empty($emp || $empCategory)) {
            $this->global_model->delete_by_id($id);
            echo 1;
        } else {
            echo 0;
        }
    }

    private function _job_categories_validate()
    {
        $rules = array(
            array('field' => 'category_name', 'label' => lang('job_categories'), 'rules' => 'trim|required'),

        );

        $this->global_model->validation($rules);
    }

    //============================================================
    //***************************Work Shift***********************
    //============================================================

    public function workShift()
    {
        $data['page_title'] = lang('work_shift');
        $this->render_admin('payroll/office/workShift', $data);
    }
    public function get_workshift()
    {
        $actions = "<div class=\"text-center\">";
        $actions .= '<div class="btn-group"><a style="padding:6px;" class="btn btn-xs btn-default" href="javascript:void(0)" onclick="edit_title(' . "'" . '$1' . "'" . ')"><i class="fa fa-pencil"></i></a>
        		<a class="btn btn-xs btn-danger" style="margin-left:6px;padding:6px;" href="javascript:void(0)"  onclick="deleteItem(' . "'" . '$1' . "'" . ')"><i class="glyphicon glyphicon-trash"></i></a></div>';
        $actions .= "</div>";
        $this->datatables
            ->select("id,  shift_name , shift_form  ,shift_to", false)
            ->from("payroll_work_shift")
            ->add_column("Actions", $actions, "id");
        echo $this->datatables->generate();
    }

    public function edit_work_shift($id)
    {
        $this->global_model->table = 'payroll_work_shift';
        $data = $this->global_model->get_by_id($id);
        echo json_encode($data);
    }
    public function add_work_shift()
    {
        $this->global_model->table = 'payroll_work_shift';
        //$this->_job_work_shift_validate();
        $data = array(
            'shift_name' => $this->input->post('shift_name', true),
            'shift_form' => $this->input->post('shift_form', true),
            'shift_to' => $this->input->post('shift_to', true),
        );
        $insert = $this->global_model->save($data);
        echo json_encode(array("status" => true));
    }

    public function update_work_shift()
    {
        $this->global_model->table = 'payroll_work_shift';
        //$this->_job_work_shift_validate();
        $data = array(
            'shift_name' => $this->input->post('shift_name', true),
            'shift_form' => $this->input->post('shift_form', true),
            'shift_to' => $this->input->post('shift_to', true),
        );
        $this->global_model->update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => true));
    }

    public function delete_work_shift($id)
    {
        $this->global_model->table = 'payroll_work_shift';
        $empCategory = $this->db->get_where('payroll_job_history', array('work_shift' => $id))->result();
        $emp = $this->db->get_where('employee', array('work_shift' => $id))->result();

        if (empty($emp || $empCategory)) {
            $this->global_model->delete_by_id($id);
            echo 1;
        } else {
            echo 0;
        }
    }

    private function _job_work_shift_validate()
    {
        $rules = array(
            array('field' => 'shift_name', 'label' => lang('shift_name'), 'rules' => 'trim|required|is_unique[work_shift.shift_name]'),
            array('field' => 'shift_form', 'label' => lang('shift_form'), 'rules' => 'trim|required|is_unique[work_shift.shift_form]'),
            array('field' => 'shift_to', 'label' => lang('shift_to'), 'rules' => 'trim|required|is_unique[work_shift.shift_to]'),
        );
        $this->global_model->validation($rules);
    }
    public function ShiftTimecheck($fromtime, $totime)
    {
        $query = $this->db->get_where('work_shift', array('shift_form' => $fromtime, 'shift_to' => $totime, 'Soft_delete' => 0));
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }

    }

    public function Shiftnamecheck($shiftname)
    {
        echo
        $shiftname = 'fff';
        $this->db->where('shift_name', $shiftname);
        $query = $this->db->get('work_shift');
        if ($query->num_rows() > 0) {

            return true;
        } else {

            return false;
        }

    }

    //============================================================
    //************************Tax**************************
    //============================================================

    public function tax()
    {
        $this->mViewData['modal'] = false;
        $this->mTitle = lang('tax');
        $this->render('office/tax');
    }

    public function tax_list()
    {

        $this->global_model->table = 'tax';
        $this->global_model->column_order = array('name', 'rate', 'type', null);
        $this->global_model->column_search = array('name', 'rate', 'type');
        $this->global_model->order = array('id' => 'desc');

        $list = $this->global_model->get_datatables();

        $data = array();
        $no = $_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $item->name;
            $row[] = $item->rate;
            $type = $item->type == 1 ? lang('percentage') : lang('fixed');
            $row[] = $type;

            //add html for action
            $row[] = '<div class="btn-group"><a class="btn btn-xs btn-default" href="javascript:void(0)" onclick="edit_title(' . "'" . $item->id . "'" . ')"><i class="fa fa-pencil"></i></a>
    		<a class="btn btn-xs btn-danger" style="margin-left:12px;" href="javascript:void(0)"  onclick="deleteItem(' . "'" . $item->id . "'" . ')"><i class="glyphicon glyphicon-trash"></i></a></div>';
            $data[] = $row;
        }
        $this->global_model->render_table($data);
    }

    public function edit_tax($id)
    {
        $this->global_model->table = 'tax';
        $data = $this->global_model->get_by_id($id);
        echo json_encode($data);
    }

    public function add_tax()
    {
        $this->global_model->table = 'tax';
        $this->_tax_validate();
        $data = array(
            'name' => $this->input->post('name'),
            'type' => $this->input->post('type'),
            'rate' => (double) $this->input->post('rate'),

        );
        $insert = $this->global_model->save($data);
        echo json_encode(array("status" => true));
    }

    public function update_tax()
    {
        $this->global_model->table = 'tax';
        $this->_tax_validate();
        $data = array(
            'name' => $this->input->post('name'),
            'type' => $this->input->post('type'),
            'rate' => (double) $this->input->post('rate'),
        );
        $this->global_model->update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => true));
    }

    public function tax_department($id)
    {
        $this->global_model->table = 'tax';

        $result = $this->db->get_where('tax', array('id' => $id))->result();

        if (empty($result)) {
            $this->global_model->delete_by_id($id);
            echo 1;
        } else {
            echo 0;
        }

    }
    private function _tax_validate()
    {
        $rules = array(
            array('field' => 'name', 'label' => lang('name'), 'rules' => 'trim|required'),
            array('rate' => 'rate', 'label' => lang('rate'), 'rules' => 'trim|required'),
        );

        $this->global_model->validation($rules);
    }

    public function Shift_roster1()
    {
        $sbtn = $this->input->post('sbtn', true);
        $this->form_validation->set_rules('date', lang('date'), 'required');
        $this->form_validation->set_rules('department_id', lang('department'), 'required');

        if ($sbtn) {

            if ($this->form_validation->run() == true) {

                $department_id = $this->input->post('department_id', true);
                $date = $this->input->post('date', true);
                $records = $this->db->query("select * from shift_rosters where YEAR(Shift_Date) = YEAR('" . ($date) . '-' . ('00') . "')
    				AND MONTH(Shift_Date) = MONTH('" . ($date) . '-' . ('00') . "') and Department_id='" . $department_id . "' ")->result();
                if (empty($records)) {
                } else {
                    $this->mViewData['shift_record'] = $records;
                }

                $month = date('n', strtotime($date));
                $year = date('Y', strtotime($date));

                $num = cal_days_in_month(CAL_GREGORIAN, $month, $year);

                $this->mViewData['employee'] = $this->attendance_model->get_employee_id_by_dept_id($department_id);
                $day = date('d', strtotime($date));
                for ($i = 1; $i <= $num; $i++) {
                    $this->mViewData['dateSl'][] = $i;
                }
                $holidays = $this->db->get_where('working_days', array(
                    'flag' => 0,
                ))->result();

                if ($month >= 1 && $month <= 9) {
                    $yymm = $year . '-' . '0' . $month;
                } else {
                    $yymm = $year . '-' . $month;
                }

                $public_holiday = $this->attendance_model->get_public_holidays($yymm);

                //tbl a_calendar Days Holiday
                if (!empty($public_holiday)) {
                    foreach ($public_holiday as $p_holiday) {
                        for ($k = 1; $k <= $num; $k++) {

                            if ($k >= 1 && $k <= 9) {
                                $sdate = $yymm . '-' . '0' . $k;
                            } else {
                                $sdate = $yymm . '-' . $k;
                            }

                            if ($p_holiday->start_date == $sdate && $p_holiday->end_date == $sdate) {
                                $p_hday[] = $sdate;
                            }
                            if ($p_holiday->start_date == $sdate) {
                                for ($j = $p_holiday->start_date; $j <= $p_holiday->end_date; $j++) {
                                    $p_hday[] = $j;
                                }
                            }
                        }
                    }
                }
                foreach ($this->mViewData['employee'] as $sl => $v_employee) {
                    $key = 1;
                    $x = 0;
                    for ($i = 1; $i <= $num; $i++) {

                        if ($i >= 1 && $i <= 9) {

                            $sdate = $yymm . '-' . '0' . $i;
                        } else {
                            $sdate = $yymm . '-' . $i;
                        }
                        $day_name = date('l', strtotime("+$x days", strtotime($year . '-' . $month . '-' . $key)));

                        if (!empty($holidays)) {
                            foreach ($holidays as $v_holiday) {

                                if ($v_holiday->days == $day_name) {
                                    $flag = 'H';
                                }
                            }
                        }
                        if (!empty($p_hday)) {
                            foreach ($p_hday as $v_hday) {
                                if ($v_hday == $sdate) {
                                    $flag = 'H';
                                }
                            }
                        }

                        if (!empty($flag)) {
                            $this->mViewData['attendance'][$sl][] = $this->attendance_model->attendance_report_by_empid($v_employee->id, $sdate,
                                $flag);

                        } else {
                            $this->mViewData['attendance'][$sl][] = $this->attendance_model->attendance_report_by_empid($v_employee->id, $sdate);
                        }

                        $key++;
                        $flag = '';
                    }
                }
                $this->mViewData['ShiftType'] = $this->db->get_where('work_shift', array('Soft_delete' => 0))->result();
                $this->mViewData['date'] = $this->input->post('date', true);
                $this->mViewData['department_id'] = $this->input->post('date', true);
                $where = array('id' => $department_id);
                $this->mViewData['dept_name'] = $this->attendance_model->check_by($where, 'department');
                $this->mViewData['month'] = date('F-Y', strtotime($yymm));

            } else {
                $error = validation_errors();
                $this->message->custom_error_msg('office/Shift_Roster', $error);
            }
            $this->mViewData['department_id'] = $department_id;
        }

        $this->mViewData['all_department'] = $this->db->get('department')->result();

        $this->mTitle .= lang('Shift_roster');
        $this->render('office/Shift_Roster');
    }

    public function Shift_roster()
    {
        $data['department'] = $this->db->get('payroll_department')->result();
        //$data['employee']=$this->db->get_where('employee',array('soft_delete'=>0,'termination'=>1,))->result();
        $data['work_shift'] = $this->db->get_where('payroll_work_shift', array('Soft_delete' => 0))->result();
        $this->render_admin('payroll/office/Shift_Roster_old', $data);
    }
    public function Shift_roster_save()
    {
        $this->form_validation->set_rules('department_id', lang('department'), 'required');
        $this->form_validation->set_rules('employee_id[]', lang('Employee_id'), 'required');
        $this->form_validation->set_rules('Shiftname[]', lang('Shift_name'), 'required');
        $this->form_validation->set_rules('from', lang('date'), 'required');
        $this->form_validation->set_rules('to', 'To date', 'required');
        if ($this->form_validation->run() == true) {
            $employees = $this->input->post('employee_id', true);
            $Department = $this->input->post('department_id', true);
            $Shifts = $this->input->post('Shiftname', true);
            $Fromdate = $newDate = date("Y-m-d", strtotime($this->input->post('from', true)));
            $Todate = date("Y-m-d", strtotime($this->input->post('to', true)));
            $week_holidays = $this->db->get_where('working_days', array('flag' => 0))->result();
            //find between date post from and to date
            $between_dates = $this->Get_between_day($Fromdate, $Todate);
            array_push($between_dates, $Todate);
            $date = date('Y-m-d');
            foreach ($employees as $employee) {
                foreach ($between_dates as $between_date) {
                    $is_holiday = $this->Get_holidays($between_date);
                    if (empty($is_holiday)) {
                        $records = $this->db->get_where('payroll_shift_rosters', array('Shift_Date' => $between_date, 'employee_id' => $employee))->row();
                        if (empty($records)) {
                            foreach ($Shifts as $Shift) {
                                $shiftName = $this->db->get_where('payroll_work_shift', array('id' => $Shift))->row()->shift_name;
                                $data = array('employee_id' => $employee, 'department_id' => $Department, 'Shift_id' => $Shift, 'Shift_Date' => $between_date, 'Shift_name' => $shiftName, 'Created_on' => $date);
                                $this->db->insert('payroll_shift_rosters', $data);
                            }
                        } else {
                            $where = array('employee_id' => $employee, 'Shift_Date' => $between_date);
                            $this->db->where($where);
                            $this->db->delete('payroll_shift_rosters');
                            foreach ($Shifts as $Shift) {
                                $shiftName = $this->db->get_where('payroll_work_shift', array('id' => $Shift))->row()->shift_name;
                                $data = array('employee_id' => $employee, 'department_id' => $Department, 'Shift_id' => $Shift, 'Shift_Date' => $between_date, 'Shift_name' => $shiftName, 'Created_on' => $date);
                                $this->db->insert('payroll_shift_rosters', $data);
                            }
                        }
                    }
                }
            }
        } else {
            $error = validation_errors();
            $this->session->set_flashdata('error', $error);
            redirect('admin/payroll/office/Shift_roster');
        }
        $this->session->set_flashdata('message', lang('save_success'));
        redirect('admin/payroll/office/Shift_roster');
    }

    /* function Shift_calender()
    {
    $sbtn = $this->input->post('sbtn', TRUE);
    $this->form_validation->set_rules('date', lang('date'), 'required');
    $this->form_validation->set_rules('department_id', lang('department'), 'required');
    $employee_id = $this->input->post('employee_id', TRUE);
    if(empty($employee_id)){ $employee_id=0; }else{ $employee_id; }
    if($sbtn) {
    if ($this->form_validation->run() == TRUE) {
    $department_id = $this->input->post('department_id', TRUE);
    $date = $this->input->post('date', TRUE);
    $month = date('n', strtotime($date));
    $year = date('Y', strtotime($date));
    $num =cal_days_in_month(CAL_GREGORIAN,$month,$year);
    $this->mViewData['employee'] = $this->attendance_model->get_employee_id_by_dept_id_search($department_id,$employee_id);
    $day = date('d', strtotime($date));
    for ($i = 1; $i <= $num; $i++) {
    $this->mViewData['dateSl'][] = $i;
    }
    $holidays = $this->db->get_where('working_days', array(
    'flag' => 0
    ))->result();
    if ($month >= 1 && $month <= 9) {
    $yymm = $year . '-' . '0' . $month;
    } else {
    $yymm = $year . '-' . $month;
    }

    $public_holiday = $this->attendance_model->get_public_holidays($yymm);
    //tbl a_calendar Days Holiday
    if (!empty($public_holiday)) {
    foreach ($public_holiday as $p_holiday) {
    for ($k = 1; $k <= $num; $k++) {

    if ($k >= 1 && $k <= 9) {
    $sdate = $yymm . '-' . '0' . $k;
    } else {
    $sdate = $yymm . '-' . $k;
    }

    if ($p_holiday->start_date == $sdate && $p_holiday->end_date == $sdate) {
    $p_hday[] = $sdate;
    }
    if ($p_holiday->start_date == $sdate) {
    for ($j = $p_holiday->start_date; $j <= $p_holiday->end_date; $j++) {
    $p_hday[] = $j;
    }
    }
    }
    }
    }
    foreach ($this->mViewData['employee'] as $sl => $v_employee) {
    $key = 1;
    $x = 0;
    for ($i = 1; $i <= $num; $i++) {

    if ($i >= 1 && $i <= 9) {

    $sdate = $yymm . '-' . '0' . $i;
    } else {
    $sdate = $yymm . '-' . $i;
    }
    $day_name = date('l', strtotime("+$x days", strtotime($year . '-' . $month . '-' . $key)));

    if (!empty($holidays)) {
    foreach ($holidays as $v_holiday) {

    if ($v_holiday->days == $day_name) {
    $flag = 'H';
    }
    }
    }
    if (!empty($p_hday)) {
    foreach ($p_hday as $v_hday) {
    if ($v_hday == $sdate) {
    $flag = 'H';
    }
    }
    }
    if (!empty($flag)) {
    $this->mViewData['attendance'][$sl][] = $this->attendance_model->Shift_data_by_empid($v_employee->id,$sdate, $flag);
    //    print_r( $this->attendance_model->Shift_data_by_empid($v_employee->id,$sdate, $flag));

    } else {
    $this->mViewData['attendance'][$sl][] = $this->attendance_model->Shift_data_by_empid($v_employee->id,$sdate);
    //print_r($this->attendance_model->Shift_data_by_empid($v_employee->id,$sdate));
    }
    $key++;
    $flag = '';
    }
    }
    //print_r($this->mViewData['attendance'][$sl]);
    $this->mViewData['ShiftType']=$this->db->get_where('work_shift', array('Soft_delete' => 0 ))->result();
    $this->mViewData['date'] = $this->input->post('date', TRUE);
    $this->mViewData['department_id']=$this->input->post('department_id', TRUE);
    $where = array('id' => $department_id);
    $this->mViewData['dept_name'] = $this->attendance_model->check_by($where, 'department');
    $this->mViewData['month'] = date('F-Y', strtotime($yymm));
    } else {
    $error = validation_errors();;
    $this->message->custom_error_msg('admin/office/Shift_calender', $error);
    }
    $this->mViewData['department_id'] = $department_id;
    }
    $this->mViewData['all_department'] = $this->db->get('department')->result();
    $this->mTitle .= lang('Shift_roster');
    $this->render('office/Shift_Roster');
    }
     */

    public function shift_Planner()
    {
        $sbtn = $this->input->post('sbtn', true);
        $this->form_validation->set_rules('date', lang('date'), 'required');
       // $this->form_validation->set_rules('department_id', lang('department'), 'required');
        $employee_id = $this->input->post('employee_id', true);
        if (empty($employee_id)) {$employee_id = 0;} else { $employee_id;}
        if ($sbtn) {
            if ($this->form_validation->run() == true) {
				
                $department_id = $this->input->post('department_id', true);
                $data['employees'] = $this->db->get_where('employee', array('id' => $employee_id))->row();
                $data['employeeid'] = $employee_id;
                $data['months'] = $this->input->post('date') . '-01';
                $Shiftnames = $this->db->get_where('payroll_work_shift')->result();
                $Shiftnames[] = (object) array('id' => 0, 'shift_name' => 'H');
                $data['shifts'] = $Shiftnames;
               	//$this->render_admin('payroll/office/Shift_Roster', $data);
            } else {
                $error = validation_errors();
			    $this->session->set_flashdata('message', $error);
			    redirect('admin/payroll/office/shift_Planner'); 
            }
            $data['department_id'] = $department_id;
        }
        $data['all_department'] = $this->db->get('payroll_department')->result();
        $data['page_title'] = lang('Shift_roster');
		$this->render_admin('payroll/office/Shift_Roster', $data);
        
    }

    public function shift_list()
    {
        $records = $this->db->query("SELECT department , DATE_FORMAT(Shift_Date,'%M %Y') AS dateschar,DATE_FORMAT(Shift_Date,'%Y-%m') AS dates FROM  `shift_rosters` sr
        		LEFT JOIN department d ON d.id=sr.department_id
        		GROUP BY department,dates")->result();
        $this->mViewData['shift_lists'] = $records;
        $this->render('office/Shift_Roster_home');
    }
    public function Shift_update_ajax()
    {
        $userId = $this->ion_auth->get_user_id();
        $employee_id = $this->input->post('Employee');
        $shift_date = $this->input->post('shift_date');
        $shifts = $this->input->post('Shift_id');
        $Department_id = $this->input->post('Department_id');
        $date = $this->input->post('month') . '-' . $shift_date;
        $created_date = date('Y-m-d');
        $delete = $this->db->delete('shift_rosters', array('employee_id' => $employee_id, 'Shift_Date' => $date));
        if ($delete) {
            foreach ($shifts as $shift) {
                $data = array('employee_id' => $employee_id, 'department_id' => $Department_id, 'Shift_id' => $shift, 'Shift_Date' => $date, 'Created_on' => $created_date);
                $this->db->insert('shift_rosters', $data);
                $inert_id = $this->db->insert_id();
                Logs_details('shift_rosters', $inert_id, 'Insert Data Successfully', 'Insert', $userId);
            }
            if ($this->db->affected_rows()) {
                echo 1;
            } else {
                echo 2;
            }
        } else {
            echo 2;
        }

    }
    public function edit_shift($department = null, $dates = null)
    {
        $department = $this->encrypt->decode(str_replace(array('-', '_', '~'), array('+', '/', '='), $department));
        $dates = $this->encrypt->decode(str_replace(array('-', '_', '~'), array('+', '/', '='), $dates));
    }
    public function category_settings()
    {
        $data['page_title'] = lang('work_shift');
        $this->render_admin('payroll/office/Category_setting', $data);
        //$this->render('office/Category_setting');
    }
    public function get_category_settings()
    {
        $actions = "<div class=\"text-center\">";
        $actions .= '<div class="btn-group"><a style="padding:6px;" class="btn btn-xs btn-default" href="javascript:void(0)" onclick="edit_title(' . "'" . '$1' . "'" . ')"><i class="fa fa-pencil"></i></a>
        		<a class="btn btn-xs btn-danger" style="margin-left:6px;padding:6px;" href="javascript:void(0)"  onclick="deleteItem(' . "'" . '$1' . "'" . ')"><i class="glyphicon glyphicon-trash"></i></a></div>';
        $actions .= "</div>";
        $this->datatables
            ->select("id  ,Categoryname ", false)
            ->from("payroll_category_settings")
            ->add_column("Actions", $actions, "id");
        echo $this->datatables->generate();
    }
    public function Add_Category()
    {
        $date = date("Y-m-d");
        $this->global_model->table = 'payroll_category_settings';
        $this->_catgory_validate();
        $data = array('Categoryname' => $this->input->post('categoryname'),
            'GraceTime_For_late_coming' => $this->input->post('late_coming'),
            'GarceTime_for_Early_going' => $this->input->post('early_coming'),
            'Absent_late_for_day' => $this->input->post('Ab_late_for'),
            'After_grace_minute' => $this->input->post('Daily_grace_time'),
            'Mark_absent_late_by' => $this->input->post('Mark_absent_late_by'),
            'Absent_when_late_for' => $this->input->post('Mark_absent'),
            'Cal_ab_if_work_dur_less_than' => !empty($this->input->post('Cal_ab_if_work_dur_less_than')) ? $this->input->post('Cal_ab_if_work_dur_less_than') : 0,
            'Duration_less_than_min' => $this->input->post('Duration_less_than_min'),
            'Fine_active' => !empty($this->input->post('Late_fine_active')) ? $this->input->post('Late_fine_active') : 0,
            'Fine_for_late' => $this->input->post('Late_fine'),
            'Mark_absent_early_go' => !empty($this->input->post('Mark_absent_early_go')) ? $this->input->post('Mark_absent_early_go') : 0,
            'Absent_when_early_go' => !empty($this->input->post('Mark_absent_early_go_min')) ? $this->input->post('Mark_absent_early_go_min') : 0,
            'OverTime' => !empty($this->input->post('OverTime')) ? $this->input->post('OverTime') : 0,
            'Punch_variant_time' => $this->input->post('Variant_time'),
            'GraceTime_for' => $this->input->post('gractimefor'),
            'Late_compensate' => !empty($this->input->post('Late_compensate')) ? $this->input->post('Late_compensate') : 0,
            'Punch_variant_active' => !empty($this->input->post('Punchvariantactive')) ? $this->input->post('Punchvariantactive') : 0,
            'Deafult_fine' => !empty($this->input->post('Defaultfine')) ? $this->input->post('Defaultfine') : 0,
            //'AttendanceFromDate'=>substr($this->input->post('Afromdate'), 0, 2),
            //'AttendanceTodate'=>substr($this->input->post('Atodate'), 0, 2),
            'Total_workingday_pe_mon' => $this->input->post('totalworkingdays'),
            'Active' => 0, 'Created_on' => $date,
        );
        $insert = $this->global_model->save($data);
        echo json_encode(array("status" => true));
    }
    public function category_list()
    {
        $this->global_model->table = 'payroll_category_settings';
        $this->global_model->column_order = array('Categoryname', 'description', null);
        $this->global_model->column_search = array('Categoryname', 'description');
        $this->global_model->order = array('id' => 'desc');
        $list = $this->global_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $item->Categoryname;
            $row[] = $item->Categoryname;
            if ($item->id != 1) {
                $row[] = '<div class="btn-group"><a class="btn btn-xs btn-default" href="javascript:void(0)" onclick="edit_title(' . "'" . $item->id . "'" . ')"><i class="fa fa-pencil"></i></a>
    			<a class="btn btn-xs btn-danger" style="margin-left:12px;" href="javascript:void(0)"  onclick="deleteItem(' . "'" . $item->id . "'" . ')"><i class="glyphicon glyphicon-trash"></i></a></div>';
            } else {
                $row[] = '<div class="btn-group"><a class="btn btn-xs btn-default" href="javascript:void(0)" onclick="edit_title(' . "'" . $item->id . "'" . ')"><i class="fa fa-pencil"></i></a></div>';
            }
            $data[] = $row;
        }
        $this->global_model->render_table($data);
    }

    public function edit_Category($id)
    {
        $this->global_model->table = 'payroll_category_settings';
        $data = $this->global_model->get_by_id($id);
        echo json_encode($data);
    }
    public function update_Category()
    {
        $date = date("Y-m-d");
        $this->global_model->table = 'payroll_category_settings';
        $this->_catgory_validate();
        $data = array('Categoryname' => $this->input->post('categoryname'),
            'GraceTime_For_late_coming' => $this->input->post('late_coming'),
            'GarceTime_for_Early_going' => $this->input->post('early_coming'),
            'Absent_late_for_day' => $this->input->post('Ab_late_for'),
            'After_grace_minute' => $this->input->post('Daily_grace_time'),
            'Mark_absent_late_by' => !empty($this->input->post('Mark_absent_late_by')) ? $this->input->post('Mark_absent_late_by') : 0,
            'Absent_when_late_for' => $this->input->post('Mark_absent'),
            'Cal_ab_if_work_dur_less_than' => !empty($this->input->post('Cal_ab_if_work_dur_less_than')) ? $this->input->post('Cal_ab_if_work_dur_less_than') : 0,
            'Duration_less_than_min' => $this->input->post('Duration_less_than_min'),
            'Fine_active' => !empty($this->input->post('Late_fine_active')) ? $this->input->post('Late_fine_active') : 0,
            'Fine_for_late' => $this->input->post('Late_fine'),
            'Mark_absent_early_go' => !empty($this->input->post('Mark_absent_early_go')) ? $this->input->post('Mark_absent_early_go') : 0,
            'Absent_when_early_go' => !empty($this->input->post('Mark_absent_early_go_min')) ? $this->input->post('Mark_absent_early_go_min') : 0,
            'OverTime' => !empty($this->input->post('OverTime')) ? $this->input->post('OverTime') : 0,
            'Punch_variant_time' => $this->input->post('Variant_time'),
            'GraceTime_for' => $this->input->post('gractimefor'),
            'Late_compensate' => !empty($this->input->post('Late_compensate')) ? $this->input->post('Late_compensate') : 0,
            'Punch_variant_active' => !empty($this->input->post('Punchvariantactive')) ? $this->input->post('Punchvariantactive') : 0,
            'Deafult_fine' => !empty($this->input->post('Defaultfine')) ? $this->input->post('Defaultfine') : 0,
            //'AttendanceFromDate'=>substr($this->input->post('Afromdate'), 0, 2),
            //'AttendanceTodate'=>substr($this->input->post('Atodate'), 0, 2),
            'Total_workingday_pe_mon' => $this->input->post('totalworkingdays'),
            'Active' => 0, 'Modified_on' => $date,
        );
        $this->global_model->update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => true));
    }

    public function delete_Category($id)
    {
        $this->global_model->table = 'payroll_category_settings';
        $result = $this->db->get_where('payroll_category_settings', array('id' => $id))->result();
        $data = array('Soft_delete' => 1);
        if (empty($result)) {
            $this->db->where('id', $id);
            $this->db->update('payroll_category_settings', $data);
            echo 1;
        } else {
            echo 0;
        }
    }
    public function Category_active($id)
    {
        $this->global_model->table = 'payroll_category_settings';
        $result = $this->db->get_where('employee', array('department' => $id))->result();
        if (empty($result)) {
            $this->global_model->delete_by_id($id);
            echo 1;
        } else {
            echo 0;
        }

    }
    private function _catgory_validate()
    {
        $rules = array(array('field' => 'categoryname', 'label' => lang('categoryname'), 'rules' => 'trim|required'),
            //array('field'=>'Afromdate', 'label'=> lang('Attendance_from_date'), 'rules'=>'trim|required'),
            //array('field'=>'Atodate', 'label'=> lang('Attendance_to_date'), 'rules'=>'trim|required'),
            array('field' => 'totalworkingdays', 'label' => lang('Total_workingday'), 'rules' => 'trim|required'));
        $this->global_model->validation($rules);
    }
    //============================================================
    //************************Hrd Year*******************
    //============================================================

    public function Hrd_year()
    {
        $this->mViewData['hrd_year'] = $this->db->get_where('hrd_year', array(
            'Soft_delete' => 0,
        ))->result();
        $this->render('office/Hrd_year');
    }
    public function HRDyear_list()
    {
        $this->global_model->table = 'hrd_year';
        $this->global_model->column_order = array('Hrd_year_name', null);
        $this->global_model->column_search = array('Hrd_year_name');
        $this->global_model->order = array('id' => 'desc');
        $list = $this->db->get_where('hrd_year', array(
            'Soft_delete' => 0,
        ))->result();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $item->Hrd_year_name;
            //add html for action
            $row[] = '<div class="btn-group"><a class="btn btn-xs btn-default" href="javascript:void(0)" onclick="edit_title(' . "'" . $item->id . "'" . ')"><i class="fa fa-pencil"></i></a>
        		<a class="btn btn-xs btn-danger" style="margin-left:12px;" href="javascript:void(0)"  onclick="deleteItem(' . "'" . $item->id . "'" . ')"><i class="glyphicon glyphicon-trash"></i></a></div>';
            $data[] = $row;
        }
        $this->global_model->render_table($data);
    }
    public function change_status()
    {
        $id = $this->encrypt->decode(str_replace(array('-', '_', '~'), array('+', '/', '='), $this->input->post('userId')));
        $statusvalue = $this->input->post('checkboxstatus');
        $date = date('Y-m-d');
        $userId = $this->ion_auth->get_user_id();
        if ($statusvalue == 'true') {
            $hrd = $this->db->get_where('hrd_year', array('id' => $id))->row();
            $hrd_fromdate = $hrd->from_date;
            $hrd_todate = $hrd->To_date;
            if (strtotime($hrd_fromdate) <= strtotime($date) && strtotime($hrd_todate) >= strtotime($date)) {
                $data = array('Active' => 0);
                $this->db->where('Active', 1);
                $this->db->update('hrd_year', $data);
                $this->db->set('active', $statusvalue, false)->where('id', $id)->update('hrd_year');
                echo 1;
            } else {
                echo 0;
            }
        } else {
            echo 0;
        }
    }
    public function add_Hrd_year()
    {
        $this->global_model->table = 'Hrd_year';
        $hrdname = $this->input->post('Hrd_year');
        $startdate = $this->input->post('From_date');
        $enddate = $this->input->post('Todate');
        $overlap = $this->db->query("SELECT * FROM (SELECT *FROM hrd_year WHERE Soft_delete=0 and '" . $startdate . "' BETWEEN from_date AND To_date  OR '" . $enddate . "' BETWEEN from_date AND To_date
									  OR '" . $startdate . "'>= from_date AND '" . $enddate . "'<= To_date)TT
                             WHERE Soft_delete=0  ")->result();
        if (!empty($overlap)) {
            echo json_encode(array("error" => 'Date Overlapping'));
        } else {
            $last_end_date = $this->db->get_where('hrd_year', array('Active' => 1))->row();
            $limitdate = date('Y-m-d', (strtotime("+1 month", strtotime($last_end_date->To_date))));
            if (strtotime($limitdate) > strtotime($startdate)) {
                $this->HRDYear_validate();
                $data = array(
                    'Hrd_year_name' => $hrdname,
                    'from_date' => $startdate,
                    'To_date' => $enddate,
                );
                $insert = $this->global_model->save($data);
                echo json_encode(array("status" => true));
            } else {
                echo json_encode(array("error" => 'Invalid Date Range'));

            }
        }
    }

    private function HRDYear_validate()
    {
        $rules = array(
            array('field' => 'Hrd_year', 'label' => lang('hrd_years'), 'rules' => 'trim|required'),
            array('field' => 'From_date', 'label' => lang('From_date'), 'rules' => 'trim|required'),
            array('field' => 'Todate', 'label' => lang('To_date'), 'rules' => 'trim|required'),
        );
        $this->global_model->validation($rules);
    }

    public function Edit_Hrd_Year($id)
    {
        $this->global_model->table = 'Hrd_year';
        $data = $this->global_model->get_by_id($id);
        echo json_encode($data);
    }

    public function update_Hrd_Year()
    {
        $this->global_model->table = 'Hrd_year';
        $this->HRDYear_validate();
        $data = array(
            'Hrd_year_name' => $this->input->post('Hrd_year'),
            'from_date' => $this->input->post('From_date'),
            'To_date' => $this->input->post('Todate'),
        );
        $this->global_model->update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => true));
    }

    public function delete_Hrd()
    {
        $userId = $this->ion_auth->get_user_id();
        $id = $this->input->post('id');
        $Exists_hrdyear_id = $this->db->get_where('tbl_attendance', array('hrd_year' => $id))->result();

        if (empty($Exists_hrdyear_id)) {
            $data = array('Soft_delete' => 1);
            $this->db->where('id', $id);
            $this->db->update('hrd_year', $data);
            Logs_details('hrd_year', $id, 'Delete Data Successfully', 'Delete', $userId);
            echo 1;
        } else {
            echo 0;
        }

    }
    //============================================================
    //************************Fin Year*******************
    //============================================================

    public function financial_year()
    {
        $this->mViewData['modal'] = false;
        // $this->mTitle .= lang('department');
        $this->render('office/Financial_year');
    }

    public function financial_list()
    {

        $this->global_model->table = 'Financial_year';
        $this->global_model->column_order = array('Fin_year_name', null);
        $this->global_model->column_search = array('Fin_year_name');
        $this->global_model->order = array('id' => 'desc');
        $list = $this->global_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $item->Fin_year_name;

            //add html for action
            $row[] = '<div class="btn-group"><a class="btn btn-xs btn-default" href="javascript:void(0)" onclick="edit_title(' . "'" . $item->id . "'" . ')"><i class="fa fa-pencil"></i></a>
        		<a class="btn btn-xs btn-danger" style="margin-left:12px;" href="javascript:void(0)"  onclick="deleteItem(' . "'" . $item->id . "'" . ')"><i class="glyphicon glyphicon-trash"></i></a></div>';
            $data[] = $row;
        }
        $this->global_model->render_table($data);
    }

    public function add_financial_year()
    {
        $this->global_model->table = 'Financial_year';
        $this->financial_validate();
        $data = array(
            'Fin_year_name' => $this->input->post('Fin_year_name'),
            'from_date' => $this->input->post('From_date'),
            'To_date' => $this->input->post('Todate'),
        );

        $insert = $this->global_model->save($data);
        echo json_encode(array("status" => true));
    }

    private function financial_validate()
    {
        $rules = array(
            array('field' => 'Fin_year_name', 'label' => lang('hrd_years'), 'rules' => 'trim|required'),
            array('field' => 'From_date', 'label' => lang('From_date'), 'rules' => 'trim|required'),
            array('field' => 'Todate', 'label' => lang('To_date'), 'rules' => 'trim|required'),
        );
        $this->global_model->validation($rules);
    }

    public function Edit_financial_Year($id)
    {
        $this->global_model->table = 'Financial_year';
        $data = $this->global_model->get_by_id($id);
        echo json_encode($data);
    }

    public function update_financial_Year()
    {
        $this->global_model->table = 'Financial_year';
        $this->financial_validate();
        $data = array(
            'Fin_year_name' => $this->input->post('Fin_year_name'),
            'from_date' => $this->input->post('From_date'),
            'To_date' => $this->input->post('Todate'),
        );
        $this->global_model->update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => true));
    }

    public function financial_Year_Delete($id)
    {
        $this->global_model->table = 'Financial_year';
        $delete = 1;

        if (empty($delete)) {
            $this->global_model->delete_by_id($id);
            echo 1;
        } else {
            echo 0;
        }
    }
    //============================================================
    //************************Currency Master*******************
    //============================================================
 
  
    public function Currency(){
		$data['currency_master'] = $this->db->get('payroll_currency_master')->result();
        $data['Countries'] = $this->db->get('payroll_countries')->result();
        $this->render_admin('payroll/office/Currency_master', $data);
    }
	  public function get_currency(){
        $actions = "<div class=\"text-center\">";
        $actions .= '<div class="btn-group"><a style="padding:6px;" class="btn btn-xs btn-default" href="javascript:void(0)" onclick="edit_title(' . "'" . '$1' . "'" . ')"><i class="fa fa-pencil"></i></a>
        		<a class="btn btn-xs btn-danger" style="margin-left:6px;padding:6px;" href="javascript:void(0)"  onclick="deleteItem(' . "'" . '$1' . "'" . ')"><i class="glyphicon glyphicon-trash"></i></a></div>';
        $actions .= "</div>";
        $this->datatables
            ->select("id ,Country, Currency_code,Exchange_rate ", false)
            ->from("payroll_currency_master")
            ->add_column("Actions", $actions, "id");
        echo $this->datatables->generate();
    }

    public function add_Currency(){
        $dates = date("Y-m-d h:i:sa");
        $this->global_model->table = 'payroll_currency_master';
        $this->Currency_validate();
        $data = array(
            'Currency_code' => $this->input->post('Currency_code'),
            'Exchange_rate' => $this->input->post('ExchangeRate'),
            'Symbol' => $this->input->post('Symbol'),
            'Country' => $this->input->post('countryname'),
            'Round_of' => $this->input->post('precision'),
            'Precision_convert_currency' => $this->input->post('precision_convert_type'),
            'Valid_amount' => $this->input->post('Valid_amount'),
            'Created_on' => $dates,
        );
        $insert = $this->global_model->save($data);
        echo json_encode(array("status" => true));
    }

    private function Currency_validate()
    {
        $rules = array(
            array('field' => 'countryname', 'label' => lang('Currency_name'), 'rules' => 'trim|required'),
            array('field' => 'Currency_code', 'label' => lang('Currency_Code'), 'rules' => 'trim|required'),
            array('field' => 'ExchangeRate', 'label' => lang('Exchenage_rate'), 'rules' => 'trim|required'),
            array('field' => 'precision', 'label' => lang('Round_Half'), 'rules' => 'trim|required'),
            array('field' => 'Valid_amount', 'label' => lang('Valid_amount'), 'rules' => 'trim|required'),
            array('field' => 'precision_convert_type', 'label' => lang('Convert_currency'), 'rules' => 'trim|required'));
        $this->global_model->validation($rules);
    }

    public function Edit_Currency($id)
    {
        $this->global_model->table = 'payroll_currency_master';
        $data = $this->global_model->get_by_id($id);
        echo json_encode($data);
    }
    public function Currency_load($id)
    {
        $result = $this->db->get_where('payroll_countries', array('country' => $id))->row();
        echo json_encode($result);
    }

    public function update_Currency()
    {
        $dates = date("Y-m-d h:i:sa");
        $this->global_model->table = 'payroll_currency_master';
        $this->Currency_validate();
        $data = array(
            'Currency_code' => $this->input->post('Currency_code'),
            'Exchange_rate' => $this->input->post('ExchangeRate'),
            'Symbol' => $this->input->post('Symbol'),
            'Country' => $this->input->post('countryname'),
            'Round_of' => $this->input->post('precision'),
            'Precision_convert_currency' => $this->input->post('precision_convert_type'),
            'Valid_amount' => $this->input->post('Valid_amount'),
            'Modified_on' => $dates,
        );
        $this->global_model->update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => true));
    }

    public function Currency_Delete($id)
    {
        $this->global_model->table = 'payroll_currency_master';
        $delete = 1;
        if (empty($delete)) {
            $this->global_model->delete_by_id($id);
            echo 1;
        } else {
            echo 0;
        }
    }
////////////////////////////// Leave  carry forward Script Start ////////////////////////
    public function Year_end_Process()
    {
        $this->mViewData['carry_forward_list'] = $this->db->query("SELECT Balance_Leave,first_name,leave_category,YearLimit  FROM  `leave_carry_forward` lcf
        		LEFT JOIN employee e ON lcf.Employee_id=e.id
        		LEFT JOIN leave_application_type lat ON lat.id=lcf.Leave_type_id
        		WHERE Active_year=1")->result();
        $this->render('office/YearEndProcess');
    }
    public function Balance_leave($employee_id, $leaveType_id)
    {
        $Balance_leave = $this->db->query("SELECT YearLimit-COUNT(leave_category_id) AS balanceleave  FROM `attendanc_sheet` ta
                         LEFT JOIN hrd_year  hrd ON hrd.id=ta.hrd_year
                         LEFT JOIN leave_application_type lat ON lat.id=ta.leave_category_id
                         WHERE hrd.Active=1 AND leave_category_id IS NOT NULL AND leave_category_id !=0 AND leave_category_id='" . $leaveType_id . "' AND employee_id='" . $employee_id . "'
                         GROUP BY employee_id,leave_category_id")->row();
        if (empty($Balance_leave->balanceleave)) {
            $limit = $this->db->query("SELECT YearLimit  FROM `leave_application_type` WHERE id='" . $leaveType_id . "'")->row();
            return $limit->YearLimit;
        } else {
            return $Balance_leave->balanceleave;
        }
    }
    public function Leave_type_for_employee()
    {
        $employees = $this->db->get('employee')->result();
        $Total_balance_leave = array();
        foreach ($employees as $employee) {
            $Category_ids = $employee->Category_id;
            if (isset($Category_ids)) {
                $records = $this->db->query("SELECT * FROM `leave_application_type` where Category_type_id like '%$Category_ids%'")->result();
                foreach ($records as $record) {
                    $Total_balance_leave[] = array('employeeid' => $employee->id, 'balance_leave' => $this->Balance_leave($employee->id, $record->id), 'Leavetype_id' => $record->id, 'Yearlimit' => $record->YearLimit);
                    echo $employee->id . '\\\\' . $record->YearLimit . '||' . $this->Balance_leave($employee->id, $record->id) . '||' . $record->id . '<br>';

                }

            }
        }
        //return $Total_balance_leave;
        //print_r($Total_balance_leave);
    }
    public function Leave_carry_forward()
    {
        $Employee_leaves = $this->Leave_type_for_employee();
        $New_carry_forward_leave = array();
        foreach ($Employee_leaves as $Employee_leave) {
            $Old_carry_forward = $this->db->get_where('leave_carry_forward', array('Active_year' => 1, 'soft_delete' => 0, 'Employee_id' => $Employee_leave['employeeid'], 'Leave_type_id' => $Employee_leave['Leavetype_id']))->row();
            print_r($Employee_leaves);
            if (((($Employee_leave['balance_leave']) + ($Old_carry_forward['Balance_Leave'])) > $Employee_leave['Yearlimit'])) {
                $balance_carry_forward = $Employee_leave['Yearlimit'];
            } else {
                $balance_carry_forward = (($Employee_leave['balance_leave']) + ($Old_carry_forward['Balance_Leave']));
            }

            $New_carry_forward_leave[] = array('Employee_id' => $Employee_leave['employeeid'], 'Leave_type_id' => $Employee_leave['Leavetype_id'], 'Balance_Leave' => $balance_carry_forward, 'YearLimit' => $Employee_leave['Yearlimit']);
        }
        //  print_r($New_carry_forward_leave);

        /* $create_leave_carry_forward=$this->Generate_end_year_for($New_carry_forward_leave);
    if($create_leave_carry_forward)
    {
    $this->message->save_success('admin/office/Year_end_Process');
    }else
    {
    $this->message->save_success('admin/office/Year_end_Process');
    } */

    }
    public function Generate_end_year_for($records)
    {
        $hrd_year = $this->db->get_where('hrd_year', array('Active' => 1))->row();
        $hrd_year_id = $hrd_year->id;
        $hrd_year_name = $hrd_year->Hrd_year_name;
        $data = array('Active_year' => 0);
        $this->db->where('Active_year', 1);
        $this->db->update('leave_carry_forward', $data);
        $date = date('m/d/Y');
        $i = 0;
        foreach ($records as $record) {
            $datas = array('Employee_id' => $record['Employee_id'], 'Hrd_year' => $hrd_year_id, 'Hrd_name' => $hrd_year_name, 'Leave_type_id' => $record['Leave_type_id'], 'Balance_Leave' => $record['Balance_Leave'], 'Leave_limit' => $record['YearLimit'], 'Active_year' => 1, 'Create_on' => $date);
            print_r($datas) . '<br>';
            //$this->db->insert('leave_carry_forward',$datas);
            //    $i++;
        }
        //if($i>0)
        //{
        //    return true;
        //    }else{
        //return flase;
        //
        //}

    }
    ////////////////////   Leave Carry forward Script end  ////////////////////////////////////////

    public function Allowed_leave_For_employee()
    {
        $leaves = $this->db->get_where('leave_application_type', array('Soft_deletes' => 0))->result();
        $employee_id = $this->input->post('employee_id');
        $Leave_type_id = $this->input->post('leave_id');
        //check this leave type applicable for this employee
        $applicable = $this->db->query("SELECT * FROM (SELECT Category_type_id FROM `leave_application_type` WHERE id='" . $Leave_type_id . "')tt WHERE Category_type_id LIKE  CONCAT('%',(SELECT Category_id FROM employee  WHERE id='" . $employee_id . "'),'%')")->row();
        if (empty($applicable)) {
            $output = '<option value="">Select State</option>';
            foreach ($leaves as $row) {
                $output .= '<option value="' . $row->id . '">' . $row->leave_category . '</option>';
            }
            echo $output;
        } else {
            $ifexist = $this->db->get_where('leave_carry_forward', array('Employee_id' => $employee_id, 'Leave_type_id' => $Leave_type_id, 'Active_year' => 1))->row();
            //check if employee have carry_forward_limit in carry_forward table
            if (empty($ifexist)) {
                $query = $this->db->query("SELECT YearLimit-COUNT(leave_category_id) AS balanceleave  FROM `attendanc_sheet` ta
              LEFT JOIN hrd_year  hrd ON hrd.id=ta.hrd_year
              LEFT JOIN leave_application_type lat ON lat.id=ta.leave_category_id
              WHERE hrd.Active=1 AND leave_category_id IS NOT NULL AND leave_category_id !=0 AND leave_category_id='" . $Leave_type_id . "' AND employee_id='" . $employee_id . "'
              GROUP BY employee_id,leave_category_id");
                $RemainingLeave = $query->row();

                if (empty($RemainingLeave)) {
                    $RemainingLeave = $this->db->query("SELECT YearLimit AS balanceleave FROM `leave_application_type` WHERE id='" . $Leave_type_id . "'")->row();
                } else {
                    $RemainingLeave;
                }
            } else {
                $query = $this->db->query("CALL Remaining_leave($employee_id,$Leave_type_id)");
                $RemainingLeave = $query->row();
                $query->next_result();
                $query->free_result();
            }
            //avoid the Commands out of sync; you can't run this command now
            if ($RemainingLeave->balanceleave > 0) {
                echo 1;
            } else {
                $output = '<option value="">Select State</option>';
                foreach ($leaves as $row) {
                    $output .= '<option value="' . $row->id . '">' . $row->leave_category . '</option>';
                }
                echo $output;
            }
        }
    }

    //============================================================
    //************************Employee Tax*******************
    //============================================================

    public function Employee_tax_master()
    {
     $data['currency_master'] = $this->db->get('payroll_currency_master')->result();
	 $data['category'] =  $this->db->get_where('payroll_category_settings', array('Soft_delete' => 0))->result();
	 $this->render_admin('payroll/office/toe', $data);
    }
  public function get_taxslab(){
        $actions = "<div class=\"text-center\">";
        $actions .= '<div class="btn-group"><a style="padding:6px;" class="btn btn-xs btn-default" href="javascript:void(0)" onclick="edit_title(' . "'" . '$1' . "'" . ')"><i class="fa fa-pencil"></i></a>
        		<a class="btn btn-xs btn-danger" style="margin-left:6px;padding:6px;" href="javascript:void(0)"  onclick="deleteItem(' . "'" . '$1' . "'" . ')"><i class="glyphicon glyphicon-trash"></i></a></div>';
        $actions .= "</div>";
        $this->datatables
            ->select("id ,Slab_name,Start_range ,End_range", false)
            ->from("payroll_tax_slab")
            ->add_column("Actions", $actions, "id");
        echo $this->datatables->generate();
    }
   
    public function Add_tax_master()
    {
        $this->global_model->table = 'payroll_tax_slab';
        $this->TaxMaster_validate();
        $created_date = date("Y-m-d");
        $data = array(
            'Slab_name' => $this->input->post('Slabname'),
            'Start_range' => $this->input->post('Startrange'),
            'End_range' => $this->input->post('EndRange'),
            'Tax_percentage' => $this->input->post('Percentage'),
            'Allow_Benefits' => $this->input->post('Benefits'),
            'Created_on' => $created_date,
        );
        $insert = $this->global_model->save($data);
        echo json_encode(array("status" => true));
    }

    private function TaxMaster_validate()
    {
        $rules = array(
            array('field' => 'Slabname', 'label' => lang('Slab_name'), 'rules' => 'trim|required'),
            array('field' => 'Startrange', 'label' => lang('Start_range'), 'rules' => 'trim|required'),
            array('field' => 'EndRange', 'label' => lang('End_range'), 'rules' => 'trim|required'),
            array('field' => 'Percentage', 'label' => lang('Taxation_pecentage'), 'rules' => 'trim|required'),
            array('field' => 'Benefits', 'label' => lang('Allowed_Benefits'), 'rules' => 'trim|required'),
        );

        $this->global_model->validation($rules);
    }

    public function edit_Tax_master($id)
    {
        $this->global_model->table = 'payroll_tax_slab';
        $data = $this->global_model->get_by_id($id);
        echo json_encode($data);
    }

    public function update_Tax_master()
    {
        $this->global_model->table = 'payroll_tax_slab';
        $this->TaxMaster_validate();
        $data = array(
            'Slab_name' => $this->input->post('Slabname'),
            'Start_range' => $this->input->post('Startrange'),
            'End_range' => $this->input->post('EndRange'),
            'Tax_percentage' => $this->input->post('Percentage'),
            'Allow_Benefits' => $this->input->post('Benefits'),
        );
        $this->global_model->update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => true));
    }

    public function delete_Taxmaster($id)
    {
        $this->global_model->table = 'payroll_tax_slab';
        $delete = '';
        if (empty($delete)) {
            $this->global_model->delete_by_id($id);
            echo 1;
        } else {
            echo 0;
        }
    }

    public function Get_day_holiday($startDates, $endDates, $dayof)
    {
        $startDate = new DateTime($startDates);
        $endDate = new DateTime($endDates);
        $sundays = array();
        while ($startDate <= $endDate) {
            if ($startDate->format('w') == $dayof) {
                $sundays[] = $startDate->format('Y-m-d');
            }
            $startDate->modify('+1 day');
        }
        return $sundays;

    }

    public function Get_between_day($Fromdate = 0, $Todate = 0)
    {
        $period = new DatePeriod(
            new DateTime($Fromdate),
            new DateInterval('P1D'),
            new DateTime($Todate));

        foreach ($period as $key => $value) {
            $days[] = $value->format('Y-m-d');
        }
        return $days;
    }

    public function Currency_Exchange_rate($id)
    {
        $result = $this->db->get_where('currency_master', array('Currency_code' => $id))->row();
        echo json_encode($result);
    }

    public function Get_holidays($date)
    {
        $holidays = $this->db->get_where('working_days', array('flag' => 0))->result();
        $public_holiday = $this->attendance_model->get_public_holidaysForDate($date);
        if (!empty($public_holiday)) {
            foreach ($public_holiday as $p_holiday) {
                if ($p_holiday->start_date == $date && $p_holiday->end_date == $date) {
                    $dates[] = $date;
                }
                if ($p_holiday->start_date == $date) {
                    /* for ($j = $p_holiday->start_date; $j <= $p_holiday->end_date; $j++) {
                        $dates[] = $j;
                    } */
					$dates[] = $date;
                }
            }
        }
        $x = 0;
        $day_name = date('l', strtotime("+0 days", strtotime($date)));
        if (!empty($holidays)) {
            foreach ($holidays as $v_holiday) {
                if ($v_holiday->days == $day_name) {
                    $dates[] = $date;
                }
            }
        }
        return $dates = !empty($dates) ? $dates : $dates = array();
    }

    public function ImportShift()
    {
        if (isset($_POST["submit"])) {
            $tmp = explode(".", $_FILES['import']['name']);
            $extension = end($tmp);
            $allowed_extension = array("xls", "xlsx", "csv"); //allowed extension
            if (in_array($extension, $allowed_extension)) //check selected file extension is present in allowed extension array
            {
                $this->load->library('Data_importer');
                $file = $_FILES["import"]["tmp_name"]; // getting temporary
                // prepend file path with project directory
                $excel = PHPExcel_IOFactory::load($file);
                $i = 0;
                foreach ($excel->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $Shiftname = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $date = str_replace('/', '-', \PHPExcel_Style_NumberFormat::toFormattedString($worksheet->getCellByColumnAndRow(1, $row)->getValue(), 'MM-DD-Y'));
                        list($month, $day, $year) = explode("-", $date);
                        $year = (strlen($year) != 2) ? $year : '20' . $year;
                        $Fromdate = date('Y-m-d', strtotime($month . '/' . $day . '/' . $year));
                        $date1 = str_replace('/', '-', \PHPExcel_Style_NumberFormat::toFormattedString($worksheet->getCellByColumnAndRow(2, $row)->getValue(), 'MM-DD-Y'));
                        list($month1, $day1, $year1) = explode("-", $date1);
                        $year1 = (strlen($year1) != 2) ? $year1 : '20' . $year1;
                        $Todate = date('Y-m-d', strtotime($month1 . '/' . $day1 . '/' . $year1));
                        $Employeeid = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $employee = $this->db->get_where('employee', array('soft_delete' => 0, 'employee_id' => $Employeeid))->row();
                        $Departments = $this->db->get_where('department', array('id' => $employee->department))->row();
                        $Department = $Departments->id;
                        $week_holidays = $this->db->get_where('working_days', array('flag' => 0))->result();

                        $shift = $this->db->get_where('work_shift', array('Soft_delete' => 0, 'shift_name' => $Shiftname))->row();
                        $Shifts = $shift->id;
                        $ShiftName = $shift->shift_name;
                        //find between date post from and to date
                        $between_dates = $this->Get_between_day($Fromdate, $Todate);
                        array_push($between_dates, $Todate);
                        $date = date('Y-m-d');
                        foreach ($between_dates as $between_date) {
                            $is_holiday = $this->Get_holidays($between_date);
                            if (empty($is_holiday)) {
                                $records = $this->db->get_where('shift_rosters', array('Shift_Date' => $between_date, 'employee_id' => $employee->id))->row();
                                if (empty($records)) {
                                    $data = array('employee_id' => $employee->id, 'department_id' => $Department, 'Shift_id' => $Shifts, 'Shift_Date' => $between_date, 'Created_on' => $date, 'Shift_name' => $ShiftName);
                                    $this->db->insert('shift_rosters', $data);
                                }
                            } else {
                                $where = array('employee_id' => $employee->id, 'Shift_Date' => $between_date);
                                $this->db->where($where);
                                $this->db->delete('shift_rosters');
                                $data = array('employee_id' => $employee->id, 'department_id' => $Department, 'Shift_id' => $Shifts, 'Shift_Date' => $between_date, 'Created_on' => $date, 'Shift_name' => $ShiftName);
                                $this->db->insert('shift_rosters', $data);
                            }
                        }
                    }
                }
                $this->message->custom_success_msg('admin/office/ImportShift', lang('import_data_successfully'));

            } else {
                $this->message->custom_error_msg('admin/office/ImportShift', lang('failed_to_import_data'));
            }
        }

        $this->mViewData['form'] = $this->form_builder->create_form();
        $this->mTitle .= lang('import_data');
        $this->render('office/import_Shift');
    }

    public function downloadShiftSample()
    {
        $this->load->helper('download');
        $file = base_url() . SAMPLE_FILE . '/' . 'Shift.xlsx';
        $data = file_get_contents($file);
        force_download('Shift.xlsx', $data);
    }

    public function ImportDayoff()
    {
        if (isset($_POST["submit"])) {
            $tmp = explode(".", $_FILES['import']['name']);
            $extension = end($tmp);
            $allowed_extension = array("xls", "xlsx", "csv"); //allowed extension
            if (in_array($extension, $allowed_extension)) //check selected file extension is present in allowed extension array
            {
                $this->load->library('Data_importer');
                $file = $_FILES["import"]["tmp_name"]; // getting temporary
                // prepend file path with project directory
                $excel = PHPExcel_IOFactory::load($file);
                $i = 0;
                foreach ($excel->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $employee_id = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $date = str_replace('/', '-', \PHPExcel_Style_NumberFormat::toFormattedString($worksheet->getCellByColumnAndRow(1, $row)->getValue(), 'MM-DD-Y'));
                        list($month, $day, $year) = explode("-", $date);
                        $year = (strlen($year) != 2) ? $year : '20' . $year;
                        $Dayoff = date('Y-m-d', strtotime($month . '/' . $day . '/' . $year));
                        $employee = $this->db->get_where('employee', array('soft_delete' => 0, 'employee_id' => $employee_id))->row();
                        $records = $this->db->get_where('shift_rosters', array('Shift_Date' => $Dayoff, 'employee_id' => $employee->id))->row();
                        if (empty($records)) {
                            $data = array('employee_id' => $employee->id, 'department_id' => $employee->department, 'Shift_id' => 0, 'Shift_Date' => $Dayoff, 'Shift_name' => 'DayOff', 'Dayoff' => 1);
                            $this->db->insert('shift_rosters', $data);
                        } else {
                            $where = array('employee_id' => $employee->id, 'Shift_Date' => $Dayoff);
                            $this->db->where($where);
                            $this->db->delete('shift_rosters');
                            $data = array('employee_id' => $employee->id, 'department_id' => $employee->department, 'Shift_id' => 0, 'Shift_Date' => $Dayoff, 'Shift_name' => 'Dayoff', 'Dayoff' => 1);
                            $this->db->insert('shift_rosters', $data);
                        }
                    }
                }
                $this->message->custom_success_msg('admin/office/ImportDayoff', lang('import_data_successfully'));

            } else {
                $this->message->custom_error_msg('admin/office/ImportDayoff', lang('failed_to_import_data'));
            }
        }

        $this->mViewData['form'] = $this->form_builder->create_form();
        $this->mTitle .= lang('import_data');
        $this->render('office/Import_dayOff');
    }
    public function downloadDayoffSample()
    {
        $this->load->helper('download');
        $file = base_url() . SAMPLE_FILE . '/' . 'Dayoff.xlsx';
        $data = file_get_contents($file);
        force_download('Dayoff.xlsx', $data);
    }
    public function planner()
    {
        $Shiftnames = $this->db->get_where('work_shift')->result();
        $Shiftnames[] = (object) array('id' => 0, 'shift_name' => 'H');
        $this->mViewData['shifts'] = $Shiftnames;
        $this->mViewData['employee_id'] = 1;
        $this->mTitle .= lang('employee_home_page');
        $this->render('office/home');
    }
    public function getRoster($employeeid, $months)
    {

        $month = date('n', strtotime($months));
        $year = date('Y', strtotime($months));
        $num = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $begin = new DateTime(date('Y-m-d', strtotime($year . '-' . $month . '-01')));
        $end = new DateTime(date('Y-m-d', strtotime('+1 day', strtotime($year . '-' . $month . '-' . $num))));
        //    $begin =$begin->format('d/m/Y');
        //    $end = $end->format('d/m/Y');
        $interval = DateInterval::createFromDateString('1 day');
        $duration = new DatePeriod($begin, $interval, $end);
        $data = array();
        foreach ($duration as $shiftdate) {
            $shiftDate = $shiftdate->format("Y-m-d");
            $is_holiday = $this->Get_holidays($shiftDate);
            if (empty($is_holiday)) {
                $this->db->select('(  CASE
            WHEN Shift_name IS NULL
            THEN "H"
            ELSE GROUP_CONCAT(`Shift_name` SEPARATOR ",")
        END
        ) AS title
       ,Shift_Date   AS start,"#006400" as color,Shift_id');
                $this->db->from('payroll_shift_rosters');
                $this->db->where(array(
                    'employee_id' => $employeeid,
                ));
                $this->db->where('Shift_Date =', $shiftDate);
                $this->db->group_by('Shift_Date,employee_id');
                $query = $this->db->get();
                $result = $query->row();
                if (!empty($result)) {
                    if ($result->Shift_id != 0) {
                        $data[] = $query->row();
                    } else {
                        $data[] = array('title' => 'H', 'start' => $shiftDate, 'color' => '#FFA500');
                    }
                } else {
                    $data[] = array('title' => 'No Shift', 'start' => $shiftDate, 'color' => '#B22222');
                }
            } else {
                $data[] = array('title' => 'H', 'start' => $shiftDate, 'color' => '#FFA500');
            }
        }
        echo json_encode($data);
    }

    public function addShiftroaster()
    {
        $employee_id = $this->input->post('employee_id');
        $shift_date = $this->input->post('start');
        $shifts = $this->input->post('shift');
        $userId = $this->ion_auth->get_user_id();
        $created_date = date('Y-m-d');
        $delete = $this->db->delete('shift_rosters', array('employee_id' => $employee_id, 'Shift_Date' => $shift_date));
        if ($delete) {
            foreach ($shifts as $shift) {
                $work_shift = $this->db->get_where('work_shift', array('id' => $shift))->row();
                $shiftName = $work_shift->shift_name;
                $data = array('employee_id' => $employee_id, 'Shift_id' => $shift, 'Shift_name' => $shiftName, 'Shift_Date' => $shift_date, 'Created_on' => $created_date, 'Type' => 1);
                $this->db->insert('shift_rosters', $data);
                echo $inert_id = $this->db->insert_id();
                Logs_details('shift_rosters', $inert_id, 'Insert Data Successfully', 'Insert', $userId);
            }
            if ($this->db->affected_rows()) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function editEventDate()
    {
        $id = $_POST['Event'][0];
        $data['start'] = $_POST['Event'][1];
        $data['end'] = $_POST['Event'][2];
        $this->db->where('id', $id);
        $this->db->update('events', $data);
        return true;
    }

    public function edit_event()
    {
        $employee_id = $this->input->post('employee_id');
        $shift_date = $this->input->post('start');
        $shifts = $this->input->post('shift');
        $userId = $this->ion_auth->get_user_id();
        $deleteshift = $this->input->post('delete');
        $created_date = date('Y-m-d');
        if (isset($deleteshift)) {
            $delete = $this->db->delete('shift_rosters', array('employee_id' => $employee_id, 'Shift_Date' => $shift_date));
            return true;

        } else {
            $delete = $this->db->delete('shift_rosters', array('employee_id' => $employee_id, 'Shift_Date' => $shift_date));
            if ($delete) {
                foreach ($shifts as $shift) {
                    $work_shift = $this->db->get_where('work_shift', array('id' => $shift))->row();
                    $shiftName = $work_shift->shift_name;
                    $data = array('employee_id' => $employee_id, 'Shift_id' => $shift, 'Shift_name' => $shiftName, 'Shift_Date' => $shift_date, 'Created_on' => $created_date, 'Type' => 1);
                    $this->db->insert('shift_rosters', $data);
                    $inert_id = $this->db->insert_id();
                    Logs_details('shift_rosters', $inert_id, 'Insert Data Successfully', 'Insert', $userId);
                }
                if ($this->db->affected_rows()) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
    }

    public function Importroster()
    {
        if (isset($_POST["submit"])) {

            $tmp = explode(".", $_FILES['import']['name']);
            $extension = end($tmp);
            $allowed_extension = array("xls", "xlsx", "csv"); //allowed extension
            if (in_array($extension, $allowed_extension)) //check selected file extension is present in allowed extension array
            {
                $this->load->library('Data_importer');
                $file = $_FILES["import"]["tmp_name"]; // getting temporary
                // prepend file path with project directory
                $excel = PHPExcel_IOFactory::load($file);
                $i = 0;
                foreach ($excel->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $Employeeid = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $Type = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        if ($worksheet->getCellByColumnAndRow(2, $row)->getValue()) {
                            $Typeid = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        } else {
                            $Typeid = 0;
                        }
                        // $Typeid         = (isset()? $worksheet->getCellByColumnAndRow(2, $row)->getValue():'');
                        $Name = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $date = str_replace('/', '-', \PHPExcel_Style_NumberFormat::toFormattedString($worksheet->getCellByColumnAndRow(4, $row)->getValue(), 'MM-DD-Y'));
                        list($month, $day, $year) = explode("-", $date);
                        $year = (strlen($year) != 2) ? $year : '20' . $year;
                        $Fromdate = date('Y-m-d', strtotime($month . '/' . $day . '/' . $year));
                        $date1 = str_replace('/', '-', \PHPExcel_Style_NumberFormat::toFormattedString($worksheet->getCellByColumnAndRow(5, $row)->getValue(), 'MM-DD-Y'));
                        if ($date1) {
                            list($month1, $day1, $year1) = explode("-", $date1);
                            $year1 = (strlen($year1) != 2) ? $year1 : '20' . $year1;
                            $Todate = date('Y-m-d', strtotime($month1 . '/' . $day1 . '/' . $year1));

                        } else {
                            $Todate = '';
                        }
                        $employee = $this->db->get_where('employee', array('soft_delete' => 0, 'employee_id' => $Employeeid))->row();
                        $Departments = $this->db->get_where('department', array('id' => $employee->department))->row();
                        $Department = $Departments->id;
                        switch ($Type) {
                            case 1:
                                $shift = $this->db->get_where('work_shift', array('Soft_delete' => 0, 'id' => $Typeid))->row();
                                echo $Name = $shift->shift_name;
                                break;
                            case 2:
                                $leave = $this->db->get_where('leave_application_type', array('id' => $Typeid))->row();
                                $Name = $leave->leave_category;
                                break;
                            default:
                                $Name = $Name;
                        }
                        if (isset($Fromdate) && !empty($Todate)) {
                            $between_dates = $this->Get_between_day($Fromdate, $Todate);
                            array_push($between_dates, $Todate);
                            foreach ($between_dates as $between_date) {
                                $records = $this->db->get_where('rosters', array('Date' => $between_date, 'employee_id' => $employee->id))->row();
                                if (empty($records)) {
                                    $data = array('employee_id' => $employee->id, 'department_id' => $Department, 'Type' => $Type, 'Type_id' => $Typeid, 'Type_name' => $Name, 'Date' => $between_date);
                                    $this->db->insert('rosters', $data);
                                } else {
                                    $where = array('employee_id' => $employee->id, 'Date' => $between_date);
                                    $this->db->where($where);
                                    $this->db->delete('rosters');
                                    $data = array('employee_id' => $employee->id, 'department_id' => $Department, 'Type' => $Type, 'Type_id' => $Typeid, 'Type_name' => $Name, 'Date' => $between_date);
                                    $this->db->insert('rosters', $data);
                                }
                            }
                        } else {
                            $records = $this->db->get_where('rosters', array('Date' => $Fromdate, 'employee_id' => $employee->id))->row();
                            if (empty($records)) {
                                $data = array('employee_id' => $employee->id, 'department_id' => $Department, 'Type' => $Type, 'Type_id' => $Typeid, 'Type_name' => $Name, 'Date' => $Fromdate);
                                $this->db->insert('rosters', $data);
                            } else {
                                $where = array('employee_id' => $employee->id, 'Date' => $Fromdate);
                                $this->db->where($where);
                                $this->db->delete('rosters');
                                $data = array('employee_id' => $employee->id, 'department_id' => $Department, 'Type' => $Type, 'Type_id' => $Typeid, 'Type_name' => $Name, 'Date' => $Fromdate);
                                $this->db->insert('rosters', $data);
                            }

                        }

                    }
                }
                $this->message->custom_success_msg('admin/office/Importroster', lang('import_data_successfully'));

            } else {
                $this->message->custom_error_msg('admin/office/Importroster', lang('failed_to_import_data'));
            }
        }

        $this->mViewData['form'] = $this->form_builder->create_form();
        $this->mTitle .= lang('Import_roster');
        $this->render('office/Import_roster');
    }
    public function download_roster_sample()
    {
        $this->load->helper('download');
        $file = base_url() . SAMPLE_FILE . '/' . 'roster.csv';
        $data = file_get_contents($file);
        force_download('roster.csv', $data);

    }
    public function addshiftOverall()
    {

        $this->form_validation->set_rules('employee_id', lang('Employee_id'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('shift[]', lang('Shift_name'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('shiftmonth', lang('date'), 'trim|required|xss_clean');

        if ($this->form_validation->run() == true) {
            $employee = $this->input->post('employee_id', true);
            $months = $this->input->post('shiftmonth', true);
            $Shifts = $this->input->post('shift', true);
            $emp_details = $this->db->get_where('employee', array('id' => $employee))->row();
            $Department = $emp_details->department;
            $month = date('n', strtotime($months));
            $year = date('Y', strtotime($months));
            $num = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            $begin = new DateTime(date('Y-m-d', strtotime($year . '-' . $month . '-01')));
            $end = new DateTime(date('Y-m-d', strtotime('+1 day', strtotime($year . '-' . $month . '-' . $num))));
            $interval = DateInterval::createFromDateString('1 day');
            $duration = new DatePeriod($begin, $interval, $end);
            foreach ($duration as $shiftdate) {
                $shiftDate = $shiftdate->format("Y-m-d");
                 $is_holiday=$this->Get_holidays($shiftDate);
                $is_holiday = $this->Get_holidays($shiftDate);
                if (empty($is_holiday)) {
                    $records = $this->db->get_where('shift_rosters', array('Shift_Date' => $shiftDate, 'employee_id' => $employee))->row();
                    if (empty($records)) {
                        foreach ($Shifts as $Shift) {
                            $workshift = $this->db->get_where('work_shift', array('id' => $Shift))->row();
                            $shift_name = $workshift->shift_name;
                            $data = array('employee_id' => $employee, 'department_id' => $Department, 'Shift_id' => $Shift, 'Shift_Date' => $shiftDate, 'Shift_name' => $shift_name);
                            $this->db->insert('shift_rosters', $data);
                        }
                    } else {
                        $where = array('employee_id' => $employee, 'Shift_Date' => $shiftDate);
                        $this->db->where($where);
                        $this->db->delete('shift_rosters');
                        foreach ($Shifts as $Shift) {
                            $workshift = $this->db->get_where('work_shift', array('id' => $Shift))->row();
                            $shift_name = $workshift->shift_name;
                            $data = array('employee_id' => $employee, 'department_id' => $Department, 'Shift_id' => $Shift, 'Shift_Date' => $shiftDate, 'Shift_name' => $shift_name);
                            $this->db->insert('shift_rosters', $data);
                        }
                    }
                }
            }
            return true;
        } else {
            return false;
        }

    }

    public function get_employee_by_department()
    {
        $HTML = '';
        $department_id = $this->input->post('department_id');
        $employees = $this->db->get_where('employee', array(
            'department' => $department_id,
            'termination' => 1,
            'soft_delete' => 0,
        ))->result();
        if (!empty($employees)) {
            foreach ($employees as $item) {
                $HTML .= "<option value='" . $item->id . "'>" . $item->first_name . ' ' . $item->last_name . "</option>";
            }
        }
        echo $HTML;
    }
}
