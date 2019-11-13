<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Employee extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        // $this->load->library('form_builder');
        // $this->mTitle = TITLE;
        $this->load->model('payroll/global_model');
        $this->load->model('payroll/attendance_model');
        ///  $this->load->model('payroll/crud_model', 'crud');
        //  $this->load->library('payroll/grocery_CRUD');
        $this->load->library('datatables');
    }
    public function employeeList()
    {
        $data['page_title'] = lang('employee_list');
        $this->render_admin('payroll/employee/employeeList');
    }
    public function get_employee()
    {
        $actions = "<div class=\"text-center\">";
        $actions .= '<div class="btn-group"><a style="padding:6px;" class="btn btn-xs btn-default" href="' . base_url('admin/payroll/employee/employeeDetails/$1') . '" ><i class="fa fa-search"></i></a>
        		<a class="btn btn-xs btn-danger" style="margin-left:6px;padding:6px;"  href="' . base_url('admin/payroll/employee/DeleteEmployee/$1') . '"><i class="glyphicon glyphicon-trash"></i></a></div>';
        $actions .= "</div>";
        $this->datatables
            ->select("employee.id ,employee_id,CONCAT(first_name,'  ',last_name) name,payroll_department.department,job_title,status_name,shift_name", false)
            ->from("employee")
            ->join("payroll_department", "payroll_department.id=employee.department", "left")
            ->join("payroll_job_title", "payroll_job_title.id=employee.title", "left")
            ->add_column("Actions", $actions, "employee.id");
        echo $this->datatables->generate();
    }

    public function addEmployee()
    {
        $data['page_title'] = lang('add_employee');
        $data['countries'] = $this->db->get('payroll_countries')->result();
        $data['employee_type'] = $this->db->get_where('payroll_employee_type', array('Soft_delete' => 0))->result();
        $data['category_settings'] = $this->db->get_where('payroll_category_settings', array('Soft_delete' => 0))->result();
        $this->render_admin('admin/payroll/employee/create_employee', $data);
    }
    public function saveEmployee()
    {

        $this->form_validation->set_rules('first_name', lang('first_name'), 'trim|required|xss_clean|max_length[32]');
        $this->form_validation->set_rules('last_name', lang('last_name'), 'trim|required|xss_clean|max_length[32]');
        $this->form_validation->set_rules('date_of_birth', lang('date_of_birth'), 'trim|required');
        $this->form_validation->set_rules('country', lang('country'), 'required');
        $this->form_validation->set_rules('Category_id', lang('Category_type'), 'required');
        $this->form_validation->set_rules('EmployeeType_id', lang('Employee_type'), 'required');
        if ($this->form_validation->run() == true) {
            $prefix = EMPLOYEE_ID_PREFIX;
            $data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'marital_status' => $this->input->post('marital_status'),
                'date_of_birth' => $this->input->post('date_of_birth'),
                'country' => $this->input->post('country'),
                'blood_group' => $this->input->post('blood_group'),
                'id_number' => !empty($this->input->post('id_number')) ? $this->input->post('id_number') : 0,
                'religious' => $this->input->post('religious'),
                'gender' => $this->input->post('gender'),
                'Category_id' => $this->input->post('Category_id'),
                'EmployeeType_id' => $this->input->post('EmployeeType_id'));
            $this->db->insert('employee', $data);
            $id = $this->db->insert_id();

            $employee_id = $prefix + $id;
            $path = UPLOAD_EMPLOYEE . $employee_id;
            mkdir_if_not_exist($path);
            $file = upload_employee_photo($employee_id);
            $data = array(
                'employee_id' => $employee_id,
                'photo' => $file,
            );
            $this->db->where('id', $id);
            $this->db->update('employee', $data);
            $this->message->save_success('admin/payroll/employee/employeeList');
        } else {
            $error = validation_errors();
            $this->message->custom_error_msg('admin/payroll/employee/addEmployee', $error);

        }

    }

    public function validate_age($birthday)
    {
        $age = 18;
        $birthday = strtotime($birthday);
        if (time() - $birthday < $age * 31536000) {
            return false;
        } else {
            return true;
        }

    }

    public function employeeDetails($id = null)
    {
        if (empty($id)) {
            $url = $this->input->get('tab');
            $pieces = explode("/", $url);
            $tab = $pieces[0];
            $id = $pieces[1];
        }
        $data['employee'] = $this->global_model->get_employee($id);
        $data['countries'] = $this->db->get('payroll_countries')->result();
        $data['employee_type'] = $this->db->get_where('payroll_employee_type', array('Soft_delete' => 0))->result();
        $data['category_settings'] = $this->db->get_where('payroll_category_settings', array('Soft_delete' => 0))->result();
        $data['employee'] == true || $this->message->norecord_found('admin/payroll/employee/employeeList');

        if (!$this->input->get('tab') || $tab == 'personal') {
            $view = 'personal';
            $tab = 'personal';
            $data['page_title'] = lang('personal_details');
        } elseif ($tab == 'contact') {
            $view = $tab;
            $tab = $tab;
            $data['page_title'] = lang('contact_details');
        } elseif ($tab == 'dependents') {
            $view = $tab;
            $tab = $tab;
            $data['page_title'] = lang('dependents');
        } elseif ($tab == 'job') {
            $view = $tab;
            $tab = $tab;
            $data['EmployeeType'] = $this->db->get_where('payroll_employee_type', array('Soft_delete' => 0))->result();
            $data['job'] = $this->db->select('payroll_job_history.*, payroll_department.department as department_name, payroll_job_title.job_title as title, payroll_emp_status.status_name, payroll_work_shift.shift_name, payroll_job_category.category_name')
                ->from('payroll_job_history')
                ->join('payroll_department', 'payroll_department.id = payroll_job_history.department', 'left')
                ->join('payroll_job_title', 'payroll_job_title.id = payroll_job_history.title', 'left')
                ->join('payroll_emp_status', 'payroll_emp_status.id = payroll_job_history.employment_status', 'left')
                ->join('payroll_work_shift', 'payroll_work_shift.id = payroll_job_history.work_shift', 'left')
                ->join('payroll_job_category', 'payroll_job_category.id = payroll_job_history.category', 'left')

                ->where('payroll_job_history.employee_id', $id)
                ->order_by('payroll_job_history.id', 'desc')
                ->get()
                ->result();
            $data['page_title'] = lang('employee_job');
        } elseif ($tab == 'salary') {
            $view = $tab;
            $tab = $tab;
            $data['empSalary'] = $this->db->get_where('payroll_salary', array('employee_id' => $id))->row();
            $data['empSalarys'] = $this->db->get_where('payroll_salary', array('employee_id' => $id))->row();
            if (!empty($data['empSalary']->component)) {
                $data['empSalaryDetails'] = json_decode($data['empSalary']->component, true);
                $data['empSalaryDetailss'] = json_decode($data['empSalary']->Current_salary_component, true);
            }
            $data['gradeList'] = $this->db->get('payroll_salary_grade')->result();
            $data['salaryEarningList'] = $this->db->get_where('payroll_salary_component', array('type' => 1, 'Is_salary_component' => 1))->result();
            $data['salaryDeductionList'] = $this->db->get_where('payroll_salary_component', array('type' => 2, 'Is_salary_component' => 1))->result();
            $data['page_title'] = lang('salary');

        } elseif ($tab == 'report') {
            $view = $tab;
            $tab = $tab;
            $data['supervisor'] = $this->db->select('employee.first_name, employee.last_name, supervisor.*, s_visor.first_name as supervisor_first_name, s_visor.last_name as supervisor_last_name')
                ->from('supervisor')
                ->join('employee', 'employee.id = supervisor.employee_id', 'left')
                ->join('employee as s_visor', 's_visor.id = supervisor.supervisor_id', 'left')
                ->where('supervisor.employee_id', $id)
                ->get()
                ->result();

            $data['subordinate'] = $this->db->select('employee.first_name, employee.last_name, subordinate.*, s_ordinate.first_name as subordinate_first_name, s_ordinate.last_name as subordinate_last_name')
                ->from('subordinate')
                ->join('employee', 'employee.id = subordinate.employee_id', 'left')
                ->join('employee as s_ordinate', 's_ordinate.id = subordinate.subordinate_id', 'left')
                ->where('subordinate.employee_id', $id)
                ->get()
                ->result();

            $data['page_title'] .= lang('employee_report');
        } elseif ($tab == 'deposit') {
            $view = $tab;
            $tab = $tab;
//            $data['deposit'] = $this->db->get_where('users', array('employee_id' => $id))->row();
            $data['page_title'] = lang('direct_deposit');
        } elseif ($tab == 'login') {
            $view = $tab;
            $tab = $tab;
            $data['login'] = $this->db->get_where('employee', array('id' => $id))->row();
            $data['page_title'] = lang('employee_login');
        } elseif ($tab == 'termination') {
            $view = $tab;
            $tab = $tab;
            $data['termination'] = $this->db->get_where('employee', array('id' => $id))->row();
            $data['employee_details'] = $this->db->get_where('employee', array('id' => $id))->row();
            $data['page_title'] .= lang('termination_note');
        }

        $data['form'] = $this->form_builder->create_form();
        $data['tab'] = $tab;
        $data['tab_view'] = $this->load->view('admin/payroll/employee/includes/' . $view, $data, true);

        $this->render_admin('payroll/employee/employee_details', $data);
    }

    //=================================================================
    //*********************Employee Personal Details*******************
    //=================================================================

    public function save_employee_personal_info()
    {

        $id = $this->input->post('id');
        if (empty($id)) {
            $this->message->norecord_found('admin/employee/employeeList');
        }

        $tab = $this->input->post('tab_view');

        $this->form_validation->set_rules('first_name', lang('first_name'), 'trim|required|xss_clean|max_length[32]');
        $this->form_validation->set_rules('last_name', lang('last_name'), 'trim|required|xss_clean|max_length[32]');
        $this->form_validation->set_rules('date_of_birth', lang('date_of_birth'), 'required');
        $this->form_validation->set_rules('country', lang('country'), 'required');
        $this->form_validation->set_rules('Category_id', lang('Category_type'), 'required');
        $this->form_validation->set_rules('EmployeeType_id', lang('Employee_type'), 'required');

        if ($this->form_validation->run() == true) {
            $employee = $this->global_model->get_employee($id);
            $file = upload_employee_photo($employee->employee_id, $id);
            $flag = false;
            if (!empty($file)) {

                if (!empty($employee->photo)) {
                    $path = UPLOAD_EMPLOYEE . $employee->employee_id . '/' . $employee->photo;
                    unlink($path);
                }
                $flag = true;
            }

            $data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'marital_status' => $this->input->post('marital_status'),
                'date_of_birth' => $this->input->post('date_of_birth'),
                'country' => $this->input->post('country'),
                'blood_group' => $this->input->post('blood_group'),
                'id_number' => $this->input->post('id_number'),
                'religious' => $this->input->post('religious'),
                'gender' => $this->input->post('gender'),
                'EmployeeType_id' => $this->input->post('EmployeeType_id'),
                'Category_id' => $this->input->post('Category_id'),
            );
            $flag == false || $data['photo'] = $file;

            $this->db->where('id', $id);
            $this->db->update('employee', $data);

            $this->message->save_success('admin/payroll/employee/employeeDetails?tab=' . $tab . '/' . $id);
        } else {
            $error = validation_errors();

            $this->message->custom_error_msg('admin/payroll/employee/employeeDetails?tab=' . $tab . '/' . $id, $error);
        }

    }

    public function add_personal_attachment($id)
    {
        $data['id'] = $id;
        $data['modal_subview'] = $this->load->view('admin/employee/_modals/personal_attachment', $data, false);
        $this->load->view('admin/_partials/_layout_modal_small', $data);
    }

    public function save_personal_attachment()
    {
        $userId = $this->ion_auth->get_user_id();
        $id = $this->input->post('id');
        $employee = $this->global_model->get_employee($id);
        $this->form_validation->set_rules('description', lang('description'), 'trim|required|xss_clean');
        if ($this->form_validation->run() == true) {
            $file_name = upload_employee_file($employee->employee_id, '*', $id);
            $description = $this->input->post('description');
            if (!empty($employee->personal_attachment)) {
                $personal_attachment = json_decode($employee->personal_attachment);
            }
            $loggedUser = $this->ion_auth->user()->row();
            $personal_attachment[] = array(
                'file' => $file_name,
                'description' => $description,
                'date' => date("Y/m/d"),
                'added_by' => $loggedUser->first_name,
            );
            $data['personal_attachment'] = json_encode($personal_attachment);
            $this->db->where('id', $id);
            $this->db->update('employee', $data);
            Logs_details('employee', $id, json_encode($personal_attachment), 'update', $userId);
            $this->message->save_success('admin/employee/employeeDetails?tab=personal/' . str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encrypt->encode($id)));
        } else {
            $error = validation_errors();
            Logs_details('employee', 0, $error, 'Error', $userId);
            $this->message->custom_error_msg('admin/employee/employeeDetails?tab=personal/' . str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encrypt->encode($id)), $error);
        }

    }

    public function delete_personalAttach()
    {
        $userId = $this->ion_auth->get_user_id();
        $attachments = $this->input->post('personalAttach');
        $id = $this->input->post('id');
        $employee = $this->global_model->get_employee($id);
        $personalAttachment = json_decode($employee->personal_attachment);
        foreach ($attachments as $item) {
            //Delete File
            $path = UPLOAD_EMPLOYEE . $employee->employee_id . '/' . $personalAttachment[$item]->file;
            unlink($path);
            //remove from array
            unset($personalAttachment[$item]); // remove item at index
        }
        $personalAttachment = array_values($personalAttachment); // 'reindex' array
        $data['personal_attachment'] = json_encode($personalAttachment);
        //update
        $this->db->where('id', $id);
        $this->db->update('employee', $data);
        Logs_details('employee', $id, 'Delete Personal Attachment Successfully', 'Delete', $userId);
        $this->message->delete_success('admin/employee/employeeDetails?tab=personal/' . str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encrypt->encode($id)));
    }

    public function download_personalAttachment($id = null)
    {
        $userId = $this->ion_auth->get_user_id();
        $this->load->helper('download');
        $pieces = explode("_", $id);
        $id = $pieces[0];
        $index = $pieces[1];
        $employee = $this->global_model->get_employee($id);
        $personalAttachment = json_decode($employee->personal_attachment);
        $file = base_url() . UPLOAD_EMPLOYEE . $employee->employee_id . '/' . $personalAttachment[$index]->file;
        $data = file_get_contents($file);
        Logs_details('employee', $id, 'Download Successfully-' . $personalAttachment[$index]->file, 'Download', $userId);
        force_download($personalAttachment[$index]->file, $data);

    }
    public function View_file($id = null)
    {
        $userId = $this->ion_auth->get_user_id();
        $this->load->helper('download');
        $pieces = explode("_", $id);
        $id = $pieces[0];
        $index = $pieces[1];
        $employee = $this->global_model->get_employee($id);
        $personalAttachment = json_decode($employee->personal_attachment);
        $file = base_url() . UPLOAD_EMPLOYEE . $employee->employee_id . '/' . $personalAttachment[$index]->file;
        $data['image_url'] = $file;
        Logs_details('employee', $id, 'Viewed File-' . $personalAttachment[$index]->file, 'Viewed', $userId);
        // redirect($file);
        $this->load->view('admin/employee/imageview', $data);
    }

    //=================================================================
    //*********************Employee Contact Details********************
    //=================================================================

    public function save_employeeContact()
    {

        $id = $this->input->post('id');
        if (empty($id)) {
            $this->message->norecord_found('admin/employee/employeeList');
        }
        $employee = $this->global_model->get_employee($id);

        $this->form_validation->set_rules('address_1', lang('address_street_1'), 'trim|required|xss_clean|max_length[152]');
        //  $this->form_validation->set_rules('city', lang('city'), 'trim|required|xss_clean|max_length[152]');
        //  $this->form_validation->set_rules('state', lang('state_province'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('postal', lang('zip_postal_code'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('country', lang('country'), 'trim|required|xss_clean');
        //  $this->form_validation->set_rules('home_telephone', lang('home_telephone'), 'trim|required|xss_clean');

        if ($this->form_validation->run() == true) {

            $contact_details = array(
                'address_1' => $this->input->post('address_1'),
                'address_2' => $this->input->post('address_2'),
                'city' => $this->input->post('city'),
                'state' => $this->input->post('state'),
                'postal' => $this->input->post('postal'),
                'country' => $this->input->post('country'),
                'home_telephone' => $this->input->post('home_telephone'),
                'mobile' => $this->input->post('mobile'),
                'work_telephone' => $this->input->post('work_telephone'),
                'work_email' => $this->input->post('work_email'),
                'other_email' => $this->input->post('other_email'),
            );
            $data['contact_details'] = json_encode($contact_details);
            $this->db->where('id', $id);
            $this->db->update('employee', $data);
            $this->message->save_success('admin/payroll/employee/employeeDetails?tab=contact/' . $id);
        } else {
            $error = validation_errors();
            $this->message->custom_error_msg('admin/payroll/employee/employeeDetails?tab=contact/' . $id, $error);
        }
    }

    public function add_emergency_contact($id = null)
    {
        $data['id'] = $id;
        $data['modal_subview'] = $this->load->view('admin/employee/_modals/emergency_contact', $data, false);
        $this->load->view('admin/_partials/_layout_modal_small', $data);
    }

    public function edit_emergency_contact($id)
    {
        $pieces = explode("_", $id);

        $data['id'] = str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encrypt->encode($pieces[0]));
        $data['index'] = $pieces[1];

        $employee = $this->global_model->get_employee($pieces[0]);
        $emergency_contact = json_decode($employee->emergency_contact);
        $data['emergency_contact'] = $emergency_contact->$data['index'];

        $data['modal_subview'] = $this->load->view('admin/employee/_modals/emergency_contact', $data, false);
        $this->load->view('admin/_partials/_layout_modal_small', $data);
    }

    public function save_emergency_contact()
    {
        $userId = $this->ion_auth->get_user_id();
        $id = $this->encrypt->decode(str_replace(array('-', '_', '~'), array('+', '/', '='), $this->input->post('id')));
        if (empty($id)) {
            $this->message->norecord_found('admin/employee/employeeList');
        }
        $index = $this->input->post('index');
        $employee = $this->global_model->get_employee($id);
        $this->form_validation->set_rules('name', lang('name'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('relationship', lang('relationship'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('home_telephone', lang('home_telephone'), 'trim|required|xss_clean|alpha_numeric');
        //$this->form_validation->set_rules('work_telephone', lang('work_telephone'), 'trim|required|xss_clean|alpha_numeric');
        // $this->form_validation->set_rules('work_telephone', lang('work_telephone') ,'trim|required|');
        // $this->form_validation->set_message('validate_phone_num', 'The {field} field can not be the word "Number"');
        if ($this->form_validation->run() == true) {

            if (!empty($employee->emergency_contact)) {
                $emergency_contact = json_decode($employee->emergency_contact, true);
            }
            if (empty($index)) {
                $emergency_contact[] = array(

                    'name' => $this->input->post('name', true),
                    'relationship' => $this->input->post('relationship', true),
                    'home_telephone' => $this->input->post('home_telephone', true),
                    'mobile' => $this->input->post('mobile', true),
                    'work_telephone' => $this->input->post('work_telephone', true),

                );
            } else {
                $emergency_contact[$index] = array(

                    'name' => $this->input->post('name', true),
                    'relationship' => $this->input->post('relationship', true),
                    'home_telephone' => $this->input->post('home_telephone', true),
                    'mobile' => $this->input->post('mobile', true),
                    'work_telephone' => $this->input->post('work_telephone', true),

                );
            }

            //reindex array start from 1
            $emergency_contact = array_combine(range(1, count($emergency_contact)), array_values($emergency_contact));
            $data['emergency_contact'] = json_encode($emergency_contact);
            $this->db->where('id', $id);
            $this->db->update('employee', $data);
            Logs_details('employee', $id, 'emergency_contact Update Successfully', 'Update', $userId);
            $this->message->save_success('admin/employee/employeeDetails?tab=contact/' . str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encrypt->encode($id)));
        } else {
            $error = validation_errors();
            Logs_details('employee', $id, $error, 'ERROR', $userId);
            $this->message->custom_error_msg('admin/employee/employeeDetails?tab=contact/' . str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encrypt->encode($id)), $error);
        }

    }
    public function validate_phone_num($input)
    {

        if (preg_match("/^[0-9]{3}-[0-9]{4}-[0-9]{4}$/", $input)) {
            return false;
        } else {
            return true;
        }
    }

    public function delete_emergencyContact()
    {
        $id = $this->encrypt->decode(str_replace(array('-', '_', '~'), array('+', '/', '='), $this->input->post('id')));
        $emergency = $this->input->post('emergencyContact');
        if (!empty($emergency)) {
            if (empty($id)) {
                $this->message->norecord_found('admin/employee/employeeList');
            }
            $employee = $this->global_model->get_employee($id);
            $emergency_contact = json_decode($employee->emergency_contact, true);
            foreach ($emergency as $item) {
                //remove from array
                unset($emergency_contact[$item]); // remove item at index
            }

            $emergency_contact = array_combine(range(1, count($emergency_contact)), array_values($emergency_contact)); // 'reindex' array

            $data['emergency_contact'] = json_encode($emergency_contact);

            //update
            $this->db->where('id', $id);
            $this->db->update('employee', $data);

            $this->message->delete_success('admin/employee/employeeDetails?tab=contact/' . str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encrypt->encode($id)));
        } else {
            $error = 'Please Select Delete Checkbox';
            $this->message->custom_error_msg('admin/employee/employeeDetails?tab=contact/' . str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encrypt->encode($id)), $error);
        }
    }

    //=================================================================
    //*********************Employee Dependents*************************
    //=================================================================

    public function add_dependent($id)
    {
        $data['id'] = $id;
        $data['modal_subview'] = $this->load->view('admin/employee/_modals/dependent', $data, false);
        $this->load->view('admin/_partials/_layout_modal_small', $data);
    }

    public function save_dependent()
    {

        $id = $this->encrypt->decode(str_replace(array('-', '_', '~'), array('+', '/', '='), $this->input->post('id')));
        if (empty($id)) {
            $this->message->norecord_found('admin/employee/employeeList');
        }
        $index = $this->input->post('index');
        $employee = $this->global_model->get_employee($id);

        $this->form_validation->set_rules('name', lang('name'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('relationship', lang('relationship'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('date_of_birth', lang('date_of_birth'), 'trim|required|xss_clean');

        if ($this->form_validation->run() == true) {

            if (!empty($employee->dependents)) {
                $dependents = json_decode($employee->dependents, true);
            }

            if (empty($index)) {
                $dependents[] = array(

                    'name' => $this->input->post('name', true),
                    'relationship' => $this->input->post('relationship', true),
                    'date_of_birth' => $this->input->post('date_of_birth', true),
                );
            } else {
                $dependents[$index] = array(

                    'name' => $this->input->post('name', true),
                    'relationship' => $this->input->post('relationship', true),
                    'date_of_birth' => $this->input->post('date_of_birth', true),

                );
            }

            //reindex array start from 1
            $dependents = array_combine(range(1, count($dependents)), array_values($dependents));
            $data['dependents'] = json_encode($dependents);
            $this->db->where('id', $id);
            $this->db->update('employee', $data);
            $this->message->save_success('admin/employee/employeeDetails?tab=dependents/' . str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encrypt->encode($id)));

        } else {
            $error = validation_errors();
            $this->message->custom_error_msg('admin/employee/employeeDetails?tab=dependents/' . str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encrypt->encode($id)), $error);
        }

    }

    public function edit_dependent($id)
    {
        $pieces = explode("_", $id);

        $data['id'] = str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encrypt->encode($pieces[0]));
        $data['index'] = $pieces[1];

        $employee = $this->global_model->get_employee($pieces[0]);
        $dependents = json_decode($employee->dependents);
        $data['dependents'] = $dependents->$data['index'];

        $data['modal_subview'] = $this->load->view('admin/employee/_modals/dependent', $data, false);
        $this->load->view('admin/_partials/_layout_modal_small', $data);
    }

    public function delete_dependent()
    {
        $dependentId = $this->input->post('dependentId');
        $id = $this->input->post('id');
        $employee = $this->global_model->get_employee($id);

        $dependents = json_decode($employee->dependents, true);

        foreach ($dependentId as $item) {
            //remove from array
            unset($dependents[$item]); // remove item at index
        }

        $dependents = array_combine(range(1, count($dependents)), array_values($dependents)); // 'reindex' array
        $data['dependents'] = json_encode($dependents);

        //update
        $this->db->where('id', $id);
        $this->db->update('employee', $data);
        $this->message->delete_success('admin/employee/employeeDetails?tab=dependents/' . str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encrypt->encode($id)));

    }

    //=================================================================
    //*********************Employee Job********************************
    //=================================================================

    public function save_commencement()
    {
        $id = $this->encrypt->decode(str_replace(array('-', '_', '~'), array('+', '/', '='), $this->input->post('id')));
        if (empty($id)) {
            $this->message->norecord_found('admin/employee/employeeList');
        }

        $this->form_validation->set_rules('joined_date', lang('joined_date'), 'required');
        $this->form_validation->set_rules('date_of_permanency', lang('date_of_permanency'), 'required');
        $this->form_validation->set_rules('probation_end_date', lang('probation_end_date'), 'required');

        if ($this->form_validation->run() == true) {
            $employee = $this->global_model->get_employee($id);

            $data = array(
                'joined_date' => $this->input->post('joined_date'),
                'date_of_permanency' => $this->input->post('date_of_permanency'),
                'probation_end_date' => $this->input->post('probation_end_date'),

            );

            $this->db->where('id', $id);
            $this->db->update('employee', $data);

            $this->message->save_success('admin/employee/employeeDetails?tab=job/' . str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encrypt->encode($id)));
        } else {
            $error = validation_errors();
            $this->message->custom_error_msg('admin/employee/employeeDetails?tab=job/' . str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encrypt->encode($id)), $error);
        }

    }

    public function add_new_job($id)
    {
        $data['id'] = $id;
        $data['departments'] = $this->db->get('department')->result(); //department
        $data['titles'] = $this->db->get('job_title')->result(); //job_title
        $data['categories'] = $this->db->get('job_category')->result(); //job_category
        $data['emp_status'] = $this->db->get('emp_status')->result(); //emp_status
        $data['work_shift'] = $this->db->get('work_shift')->result(); //work_shift
        $data['modal_subview'] = $this->load->view('admin/employee/_modals/new_job', $data, false);
        $this->load->view('admin/_partials/_layout_modal_small', $data);
    }

    public function save_new_job()
    {
        $id = $this->encrypt->decode(str_replace(array('-', '_', '~'), array('+', '/', '='), $this->input->post('id')));
        if (empty($id)) {
            $this->message->norecord_found('admin/employee/employeeList');
        }
        $job_id = $this->input->post('job_id');

        $this->form_validation->set_rules('effective_from', lang('effective_from'), 'required');
        $this->form_validation->set_rules('department', lang('department'), 'required');
        $this->form_validation->set_rules('title', lang('job_title'), 'required');
        //$this->form_validation->set_rules('category', lang('job_category'), 'required');
        // $this->form_validation->set_rules('employment_status', lang('employment_status'), 'required');
        $this->form_validation->set_rules('work_shift', lang('work_shift'), 'required');

        if ($this->form_validation->run() == true) {

            $data = array(
                'effective_from' => $this->input->post('effective_from'),
                'department' => $this->input->post('department'),
                'title' => $this->input->post('title'),
                'status' => 1,
                'work_shift' => $this->input->post('work_shift'),
            );

            if (!empty($job_id)) { //update

                $this->db->where('id', $job_id);
                $this->db->update('job_history', $data);
                $job = $this->db->get_where('job_history', array(
                    'id' => $job_id,
                ))->row();

                //check active job
                if ($job->status == 1) {
                    //update employee table record
                    $data = array(
                        'department' => $this->input->post('department'),
                        'title' => $this->input->post('title'),
                        'category' => $this->input->post('category'),
                        'employment_status' => $this->input->post('employment_status'),
                        'work_shift' => $this->input->post('work_shift'),
                    );
                    $this->db->where('employee_id', $job->employee_id);
                    $this->db->where_not_in('id', $job_id);
                    $this->db->update('job_history', array('status' => 0));
                    $this->db->where('id', $job->employee_id);
                    $this->db->update('employee', $data);
                }

            } else { //new insert
                $this->db->where('employee_id', $id);
                $this->db->update('job_history', array('status' => 0));
                $data['employee_id'] = $id;
                $this->db->insert('job_history', $data);
            }

            $this->message->save_success('admin/employee/employeeDetails?tab=job/' . str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encrypt->encode($id)));
        } else {
            $error = validation_errors();
            $this->message->custom_error_msg('admin/employee/employeeDetails?tab=job/' . str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encrypt->encode($id)), $error);
        }
    }

    public function edit_job_history($id)
    {

        $data['departments'] = $this->db->get('department')->result(); //department
        $data['titles'] = $this->db->get('job_title')->result(); //job_title
        $data['categories'] = $this->db->get('job_category')->result(); //job_category
        $data['emp_status'] = $this->db->get('emp_status')->result(); //emp_status
        $data['work_shift'] = $this->db->get('work_shift')->result(); //work_shift

        $data['job'] = $this->db->get_where('job_history', array(
            'id' => $id,
        ))->row();
        $data['id'] = str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encrypt->encode($data['job']->employee_id));
        $data['modal_subview'] = $this->load->view('admin/employee/_modals/new_job', $data, false);
        $this->load->view('admin/_partials/_layout_modal_small', $data);
    }

    public function job_activate($id = null)
    {
        $job = $this->db->get_where('job_history', array(
            'id' => $id,
        ))->row();

        if ($job->status == 0) {
            //find active job
            $activeJob = $this->db->get_where('job_history', array(
                'employee_id' => $job->employee_id,
                'status' => 1,
            ))->row();

            //inactive old job
            if ($activeJob->status == 1) {
                $this->db->where('id', $activeJob->id);
                $this->db->update('job_history', $data = array('status' => 2));
            }

            //active new job record
            $this->db->where('id', $job->id);
            $this->db->update('job_history', $data = array('status' => 1));

            //update employee table
            $data = array(
                'department' => $job->department,
                'title' => $job->title,
                'category' => $job->category,
                'employment_status' => $job->employment_status,
                'work_shift' => $job->work_shift,

            );
            $this->db->where('id', $job->employee_id);
            $this->db->update('employee', $data);
        }
        $this->message->save_success('admin/employee/employeeDetails?tab=job/' . str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encrypt->encode($job->employee_id)));
    }

    public function delete_job($id = null)
    {
        $id = $this->encrypt->decode(str_replace(array('-', '_', '~'), array('+', '/', '='), $id));
        if (empty($id)) {
            $this->message->norecord_found('admin/employee/employeeList');
        }
        $job = $this->db->get_where('job_history', array(
            'id' => $id,
        ))->row();

        //delete
        $this->db->delete('job_history', array('id' => $id));
        //update employee table
        if ($job->status == 1) {
            $data = array(
                'department' => '',
                'title' => '',
                'category' => '',
                'employment_status' => '',
                'work_shift' => '',
            );
            $this->db->where('id', $job->employee_id);
            $this->db->update('employee', $data);
        }

        $this->message->delete_success('admin/employee/employeeDetails?tab=job/' . str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encrypt->encode($job->employee_id)));
    }

    //=================================================================
    //*************************Employee Salary*************************
    //=================================================================

    public function get_salaryRange_by_id()
    {
        $grade_id = $this->input->post('grade_id');
        $salary_grade = $this->db->get_where('salary_grade', array(
            'id' => $grade_id,
        ))->row();
        if (count($salary_grade)) {
            echo json_encode(array($salary_grade->min_salary, $salary_grade->max_salary));

        } else {
            echo '';
        }
    }

    public function save_salary()
    {

        $id = $this->input->post('id');
        if (empty($id)) {
            $this->message->norecord_found('admin/payroll/employee/employeeList');
        }

        $salary_id = $this->input->post('salary_id', true);
        if (!empty($salary_id)) {
            $salary_id = $salary_id;
            if (empty($salary_id)) {
                $this->message->norecord_found('admin/payroll/employee/employeeDetails?tab=salary/' . $id);
            }
        }

        $data['employee_id'] = $id;

        $records = $this->db->get_where('payroll_salary_component', array('Is_salary_component' => 1))->result();
        // $this->form_validation->set_rules('grade_id', lang('pay_grade'), 'required');
        foreach ($records as $record) {
            $this->form_validation->set_rules($record->id, $record->component_name, 'required|xss_clean|integer');
        }

        if ($this->form_validation->run() == true) {

            //     $data['grade_id']           = $this->input->post('grade_id', true);
            $data['comment'] = $this->input->post('comment', true);
            $earning_id = $this->input->post('earn');
            $deduction_id = $this->input->post('deduction');
            $earning_ids = $this->input->post('earns');
            $deduction_ids = $this->input->post('deductions');

            $total_cost_company = 0;
            $total_payable = 0;
            $total_deduction = 0;
            $basic_salary = $this->input->post(1);

            $total_cost_companys = 0;
            $total_payables = 0;
            $total_deductions = 0;
            $basic_salarys = $this->input->post(1);

            // print_r($_POST);

            for ($i = 0; $i < sizeof($earning_id); $i++) {

                if ($_POST[$earning_id[$i]] == 0) {
                    continue;
                }

                $dbData['component_id'][] = $earning_id[$i];
                $dbData['salary'][] = $_POST[$earning_id[$i]];

                //check payment type
                foreach ($records as $record) {
                    if ($record->id == $earning_id[$i]) {
                        if ($record->total_payable == 1) //total payable
                        {
                            $total_payable += $_POST[$earning_id[$i]];
                        }
                        if ($record->cost_company == 1) //cost to company
                        {
                            $total_cost_company += $_POST[$earning_id[$i]];
                        }
                    }
                }
            }

            /// for current salary
            for ($i = 0; $i < sizeof($earning_ids); $i++) {

                if ($_POST[$earning_ids[$i]] == 0) {
                    continue;
                }

                $dbData['component_ids'][] = $earning_ids[$i];
                $dbData['salarys'][] = $_POST[$earning_ids[$i]];

                //check payment type
                foreach ($records as $record) {
                    if ($record->id . 's' == $earning_ids[$i]) {
                        if ($record->total_payable == 1) //total payable
                        {
                            $total_payables += $_POST[$earning_ids[$i]];
                        }
                        if ($record->cost_company == 1) //cost to company
                        {

                            $_POST[$earning_ids[$i]];
                            $total_cost_companys += $_POST[$earning_ids[$i]];
                        }
                    }
                }
            }

            for ($j = 0; $j < sizeof($deduction_id); $j++) {

                if ($_POST[$deduction_id[$j]] == 0) {
                    continue;
                }

                $dbData['component_id'][] = $deduction_id[$j];
                $dbData['salary'][] = $_POST[$deduction_id[$j]];

                foreach ($records as $record) {
                    if ($record->id == $deduction_id[$j]) {
                        if ($record->value_type == 1) //Amount
                        {
                            $total_deduction += $_POST[$deduction_id[$j]];
                            if ($record->total_payable == 1) //total payable
                            {
                                $total_payable -= $_POST[$deduction_id[$j]];
                            }
                            if ($record->cost_company == 1) //cost to company
                            {
                                $total_cost_company += $_POST[$deduction_id[$j]];
                            }

                        }
                        if ($record->value_type == 2) //percentage
                        {
                            $total_deduction += ($basic_salary * $_POST[$deduction_id[$j]]) / 100;
                            $deduction = ($basic_salary * $_POST[$deduction_id[$j]]) / 100;
                            if ($record->total_payable == 1) //total payable
                            {
                                $total_payable -= $deduction;
                            }
                            if ($record->cost_company == 1) //cost to company
                            {
                                $total_cost_company += $deduction;
                            }

                        }
                    }
                }

            }

            //For current salary deduction
            for ($j = 0; $j < sizeof($deduction_ids); $j++) {

                if ($_POST[$deduction_ids[$j]] == 0) {
                    continue;
                }

                $dbData['component_ids'][] = $deduction_ids[$j];
                $dbData['salarys'][] = $_POST[$deduction_ids[$j]];

                foreach ($records as $record) {
                    if ($record->id . 's' == $deduction_ids[$j]) {
                        if ($record->value_type == 1) //Amount
                        {
                            $total_deductions += $_POST[$deduction_ids[$j]];
                            if ($record->total_payable == 1) //total payable
                            {
                                $total_payables -= $_POST[$deduction_ids[$j]];
                            }
                            if ($record->cost_company == 1) //cost to company
                            {
                                $total_cost_companys += $_POST[$deduction_ids[$j]];

                            }

                        }
                        if ($record->value_type == 2) //percentage
                        {
                            $total_deductions += ($basic_salarys * $_POST[$deduction_ids[$j]]) / 100;
                            $deductions = ($basic_salarys * $_POST[$deduction_ids[$j]]) / 100;
                            if ($record->total_payable == 1) //total payable
                            {
                                $total_payables -= $deductions;
                            }
                            if ($record->cost_company == 1) //cost to company
                            {
                                $total_cost_companys += $deductions;
                            }

                        }
                    }
                }

            }

            $data['total_payable'] = $total_payable;
            $data['total_cost_company'] = $total_cost_company;
            $data['total_deduction'] = $total_deduction;
            //for current
            $data['Current_total_payable'] = $total_payables;
            $data['Current_total_cost_company'] = $total_cost_companys;
            $data['Current_total_deduction'] = $total_deductions;

            $salaryDetails = array();
            for ($j = 0; $j < sizeof($dbData['component_id']); $j++) {
                $salaryDetails[$dbData['component_id'][$j]] = $dbData['salary'][$j];
                $componentID[] = $dbData['component_id'][$j];
            }
            //for current
            $current_salaryDetails = array();
            for ($j = 0; $j < sizeof($dbData['component_ids']); $j++) {
                $current_salaryDetails[$dbData['component_ids'][$j]] = $dbData['salarys'][$j];
                $componentID[] = $dbData['component_ids'][$j];
            }

            //save component
            $salaryComponent = $this->db->query(" select id from payroll_salary_component where Is_salary_component=1")->result();

//            echo '<pre>';
            //            print_r($salaryComponent[0]->id);
            //            echo '<br>';
            //            print_r($componentID);
            //            exit();

            foreach ($salaryComponent as $key => $item) {

                if ($item->id == $componentID[$key]) {
                    $component['component_id'] = $item->id;
                    $component['employee_id'] = $data['employee_id'];

                    $result = $this->db->get_where('payroll_component', array(
                        'employee_id' => $data['employee_id'],
                        'component_id' => $item->id,
                    ))->row();

                    if (empty($result)) {
                        $this->db->insert('payroll_component', $component);
                    }
                } else {
                    $this->db->delete('payroll_component', array('component_id' => $item->id, 'employee_id' => $data['employee_id']));
                }

            }

            $data['component'] = json_encode($salaryDetails);
            $data['Current_salary_component'] = json_encode($current_salaryDetails);

            if (!empty($salary_id)) {
                //update data
                $this->db->where('id', $salary_id);
                $this->db->update('payroll_salary', $data);

            } else {
                //insert data
                $this->db->insert('payroll_salary', $data);
            }

            $this->message->save_success('admin/payroll/employee/employeeDetails?tab=salary/' . $id);

        } else {
            $error = validation_errors();
            $this->message->custom_error_msg('admin/payroll/employee/employeeDetails?tab=salary/' . $id, $error);
        }
    }

    public function save_salary1()
    {

        $id = $this->encrypt->decode(str_replace(array('-', '_', '~'), array('+', '/', '='), $this->input->post('id')));
        if (empty($id)) {
            $this->message->norecord_found('admin/employee/employeeList');
        }

        $salary_id = $this->input->post('salary_id', true);
        if (!empty($salary_id)) {
            $salary_id = $this->encrypt->decode(str_replace(array('-', '_', '~'), array('+', '/', '='), $salary_id));
            if (empty($salary_id)) {
                $this->message->norecord_found('admin/employee/employeeDetails?tab=salary/' . str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encrypt->encode($id)));
            }
        }

        $data['employee_id'] = $id;

        $records = $this->db->get_where('salary_component', array('Is_salary_component' => 1))->result();

        //$this->form_validation->set_rules('grade_id', lang('pay_grade'), 'required');
        foreach ($records as $record) {
            $this->form_validation->set_rules($record->id, $record->component_name, 'required|xss_clean|integer');
        }

        if ($this->form_validation->run() == true) {

            $data['comment'] = $this->input->post('comment', true);
            $earning_id = $this->input->post('earn');
            $deduction_id = $this->input->post('deduction');

            $total_cost_company = 0;
            $total_payable = 0;
            $total_deduction = 0;
            $basic_salary = $this->input->post(1);
            for ($i = 0; $i < sizeof($earning_id); $i++) {

                if ($_POST[$earning_id[$i]] == 0) {
                    continue;
                }

                $dbData['component_id'][] = $earning_id[$i];
                $dbData['salary'][] = $_POST[$earning_id[$i]];

                //check payment type
                foreach ($records as $record) {
                    if ($record->id == $earning_id[$i]) {
                        if ($record->total_payable == 1) //total payable
                        {
                            $total_payable += $_POST[$earning_id[$i]];
                        }
                        if ($record->cost_company == 1) //cost to company
                        {
                            $total_cost_company += $_POST[$earning_id[$i]];
                        }
                    }
                }
            }

            for ($j = 0; $j < sizeof($deduction_id); $j++) {

                if ($_POST[$deduction_id[$j]] == 0) {
                    continue;
                }

                $dbData['component_id'][] = $deduction_id[$j];
                $dbData['salary'][] = $_POST[$deduction_id[$j]];

                foreach ($records as $record) {
                    if ($record->id == $deduction_id[$j]) {
                        if ($record->value_type == 1) //Amount
                        {
                            $total_deduction += $_POST[$deduction_id[$j]];
                            if ($record->total_payable == 1) //total payable
                            {
                                $total_payable -= $_POST[$deduction_id[$j]];
                            }
                            if ($record->cost_company == 1) //cost to company
                            {
                                $total_cost_company += $_POST[$deduction_id[$j]];
                            }

                        }
                        if ($record->value_type == 2) //percentage
                        {
                            $total_deduction += ($basic_salary * $_POST[$deduction_id[$j]]) / 100;
                            $deduction = ($basic_salary * $_POST[$deduction_id[$j]]) / 100;
                            if ($record->total_payable == 1) //total payable
                            {
                                $total_payable -= $deduction;
                            }
                            if ($record->cost_company == 1) //cost to company
                            {
                                $total_cost_company += $deduction;
                            }

                        }
                    }
                }

            }

            $data['total_payable'] = $total_payable;
            $data['total_cost_company'] = $total_cost_company;
            $data['total_deduction'] = $total_deduction;
            $salaryDetails = array();
            for ($j = 0; $j < sizeof($dbData['component_id']); $j++) {
                $salaryDetails[$dbData['component_id'][$j]] = $dbData['salary'][$j];
                $componentID[] = $dbData['component_id'][$j];
            }
            //save component
            $salaryComponent = $salaryComponent = $this->db->query(" select id from salary_component where Is_salary_component=1")->result();
            foreach ($salaryComponent as $key => $item) {

                if ($item->id == $componentID[$key]) {
                    $component['component_id'] = $item->id;
                    $component['employee_id'] = $data['employee_id'];

                    $result = $this->db->get_where('component', array(
                        'employee_id' => $data['employee_id'],
                        'component_id' => $item->id,
                    ))->row();

                    if (empty($result)) {
                        $this->db->insert('component', $component);
                    }
                } else {
                    $this->db->delete('component', array('component_id' => $item->id, 'employee_id' => $data['employee_id']));
                }

            }

            $data['component'] = json_encode($salaryDetails);
            // $data['Current_salary_component'] = json_encode($current_salaryDetails);

            if (!empty($salary_id)) {
                //update data
                $this->db->where('id', $salary_id);
                $this->db->update('salary', $data);

            } else {
                //insert data
                $this->db->insert('salary', $data);
            }

            $this->message->save_success('admin/employee/employeeDetails?tab=salary/' . str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encrypt->encode($id)));

        } else {
            $error = validation_errors();
            $this->message->custom_error_msg('admin/employee/employeeDetails?tab=salary/' . str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encrypt->encode($id)), $error);
        }
    }

    //=================================================================
    //*************************Employee Report TO**********************
    //=================================================================

    public function add_supervisors($id)
    {
        $data['id'] = $id;
        $data['department'] = $this->db->get('department')->result();
        $data['modal_subview'] = $this->load->view('admin/employee/_modals/add_supervisors', $data, false);
        $this->load->view('admin/_partials/_layout_modal_small', $data);
    }

    public function get_employee_by_department($id)
    {
        $department_id = $this->input->post('department_id');
        $employeeId = $this->input->post('employeeId');

        $employees = $this->db->get_where('employee', array(
            'department' => $department_id,
            'termination' => 1,
            'soft_delete' => 0,
        ))->result();
        if ($employees) {

            foreach ($employees as $item) {
                if ($item->id == $employeeId) { // skip even members
                    continue;
                }
                $HTML .= "<option value='" . $item->id . "'>" . $item->first_name . ' ' . $item->last_name . "</option>";
            }
        }
        echo $HTML;
    }

    public function save_supervisor()
    {
        $id = $this->encrypt->decode(str_replace(array('-', '_', '~'), array('+', '/', '='), $this->input->post('id')));
        if (empty($id)) {
            $this->message->norecord_found('admin/employee/employeeList');
        }

        $supervisor = $this->input->post('supervisor');
        if (!empty($supervisor)) {
            $supervisor = $this->encrypt->decode(str_replace(array('-', '_', '~'), array('+', '/', '='), $supervisor));
            if (empty($supervisor)) {
                $this->message->norecord_found('admin/employee/employeeDetails?tab=report/' . str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encrypt->encode($id)));
            }
        }

        $data['employee_id'] = $id;
        $data['supervisor_id'] = $this->input->post('supervisor_id');
        $data['department_id'] = $this->input->post('department_id');

        if (!empty($supervisor)) {
            $this->db->where('id', $supervisor);
            $this->db->update('supervisor', $data);
        } else {
            $this->db->insert('supervisor', $data);
        }
        $this->message->save_success('admin/employee/employeeDetails?tab=report/' . str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encrypt->encode($id)));
    }

    public function edit_supervisor($id = null)
    {
        $id = $this->encrypt->decode(str_replace(array('-', '_', '~'), array('+', '/', '='), $id));
        if (empty($id)) {
            $this->message->norecord_found('admin/employee/employeeList');
        }

        $data['supervisor'] = $this->db->get_where('supervisor', array('id' => $id))->row();
        $data['id'] = str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encrypt->encode($data['supervisor']->employee_id));
        $data['department'] = $this->db->get('department')->result();
        $data['employee'] = $this->db->get_where('employee', array('department' => $data['supervisor']->department_id))->result();

        $data['modal_subview'] = $this->load->view('admin/employee/_modals/add_supervisors', $data, false);
        $this->load->view('admin/_partials/_layout_modal_small', $data);
    }

    public function delete_supervisor($id = null)
    {
        $id = $this->encrypt->decode(str_replace(array('-', '_', '~'), array('+', '/', '='), $id));
        if (empty($id)) {
            $this->message->norecord_found('admin/employee/employeeList');
        } else {
            //delete
            $employee = $this->db->get_where('supervisor', array('id' => $id))->row()->employee_id;
            $this->db->delete('supervisor', array('id' => $id));
            $this->message->delete_success('admin/employee/employeeDetails?tab=report/' . str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encrypt->encode($employee)));
        }
    }

    // Subordinate -------------------------------------------------------------------------------------->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

    public function add_subordinate($id)
    {
        $data['id'] = $id;
        $data['department'] = $this->db->get('department')->result();
        $data['modal_subview'] = $this->load->view('admin/employee/_modals/add_subordinate', $data, false);
        $this->load->view('admin/_partials/_layout_modal_small', $data);
    }

    public function save_subordinate()
    {
        $id = $this->encrypt->decode(str_replace(array('-', '_', '~'), array('+', '/', '='), $this->input->post('id')));
        if (empty($id)) {
            $this->message->norecord_found('admin/employee/employeeList');
        }

        $subordinate = $this->input->post('subordinate');

        if (!empty($subordinate)) {
            $subordinate = $this->encrypt->decode(str_replace(array('-', '_', '~'), array('+', '/', '='), $subordinate));
            if (empty($subordinate)) {
                $this->message->norecord_found('admin/employee/employeeDetails?tab=report/' . str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encrypt->encode($id)));
            }
        }
        $subordinate = $subordinate;
        $data['employee_id'] = $id;
        $data['subordinate_id'] = $this->input->post('subordinate_id');
        $data['department_id'] = $this->input->post('department_id');

        if (!empty($subordinate)) {
            $this->db->where('id', $subordinate);
            $this->db->update('subordinate', $data);
        } else {
            $this->db->insert('subordinate', $data);
        }
        $this->message->save_success('admin/employee/employeeDetails?tab=report/' . str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encrypt->encode($id)));
    }

    public function edit_subordinate($id)
    {
        $id = $this->encrypt->decode(str_replace(array('-', '_', '~'), array('+', '/', '='), $id));
        if (empty($id)) {
            $this->message->norecord_found('admin/employee/employeeList');
        }

        $data['subordinate'] = $this->db->get_where('subordinate', array('id' => $id))->row();
        $data['id'] = str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encrypt->encode($data['subordinate']->employee_id));
        $data['department'] = $this->db->get('department')->result();
        $data['employee'] = $this->db->get_where('employee', array('department' => $data['subordinate']->department_id))->result();

        $data['modal_subview'] = $this->load->view('admin/employee/_modals/add_subordinate', $data, false);
        $this->load->view('admin/_partials/_layout_modal_small', $data);
    }

    public function delete_subordinate($id = null)
    {
        $id = $this->encrypt->decode(str_replace(array('-', '_', '~'), array('+', '/', '='), $id));
        if (empty($id)) {
            $this->message->norecord_found('admin/employee/employeeList');
        } else {
            //delete
            $employee = $this->db->get_where('subordinate', array('id' => $id))->row()->employee_id;
            $this->db->delete('subordinate', array('id' => $id));
            $this->message->delete_success('admin/employee/employeeDetails?tab=report/' . str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encrypt->encode($employee)));
        }
    }

    //=================================================================
    //*************************Employee Create Login*******************
    //=================================================================

    public function create_user()
    {
        $id = $this->encrypt->decode(str_replace(array('-', '_', '~'), array('+', '/', '='), $this->input->post('id')));

        if (empty($id)) {
            $this->message->norecord_found('admin/employee/employeeList');
        }

        $this->form_validation->set_rules('password', lang('password'), 'required');
        $this->form_validation->set_rules('retype_password', lang('retype_password'), 'required|matches[password]');

        if ($this->form_validation->run() == true) {

            $loginID = $this->db->get_where('employee', array(
                'id' => $id,
            ))->row();

            $employee_id = $id;
            $username = $loginID->employee_id;
            $email = '';
            $password = $this->input->post('password');
            $identity = empty($username) ? $email : $username;
            $additional_data = array(
                'employee_id' => $employee_id,
            );
            $groups = array('0' => 1);

            // [IMPORTANT] override database tables to update Frontend Users instead of Admin Users
            $this->ion_auth_model->tables = array(
                'users' => 'users',
                'groups' => 'groups',
                'users_groups' => 'users_groups',
                'login_attempts' => 'login_attempts',
            );

            // proceed to create user
            $user_id = $this->ion_auth->register($identity, $password, $email, $additional_data, $groups);
            if ($user_id) {
                // success
                $messages = $this->ion_auth->messages();
                $this->system_message->set_success($messages);

                // directly activate user
                $this->ion_auth->activate($user_id);
            } else {
                // failed
                $errors = $this->ion_auth->errors();
                $this->message->custom_error_msg('admin/employee/employeeDetails?tab=login/' . str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encrypt->encode($id)), $errors);
            }

            $this->message->save_success('admin/employee/employeeDetails?tab=login/' . str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encrypt->encode($id)));
        } else {
            $error = validation_errors();
            $this->message->custom_error_msg('admin/employee/employeeDetails?tab=login/' . str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encrypt->encode($id)), $error);
        }
    }

    // Frontend User Reset Password
    public function reset_password()
    {
        // only top-level users can reset user passwords
        //$this->verify_auth(array('webmaster', 'admin'));

        $id =  $this->input->post('id');
        $user_id =$this->input->post('login_id');

        if (empty($id)) {
            $this->message->norecord_found('admin/payroll/employee/employeeList');
        }
        if (empty($user_id)) {
            $this->message->norecord_found('admin/payroll/employee/employeeDetails?tab=login/' . $id);
        }

        $this->form_validation->set_rules('password', lang('password'), 'required');
        $this->form_validation->set_rules('retype_password', lang('retype_password'), 'required|matches[password]');

        if ($this->form_validation->run() == true) {
            // pass validation
            $data = array('password' => sha1($this->input->post('password')));

            // [IMPORTANT] override database tables to update Frontend Users instead of Admin Users
            /* $this->ion_auth_model->tables = array(
                'users' => 'users',
                'groups' => 'groups',
                'users_groups' => 'users_groups',
                'login_attempts' => 'login_attempts',
            ); */
               $this->db->where('employee_id',$user_id);
            // proceed to change user password
            if ($this->db->update('employee',$data)) {
                 $this->message->custom_success_msg('admin/payroll/employee/employeeDetails?tab=login/' .$id, lang('password_update_successfully'));
            } else {
               // $errors = $this->ion_auth->errors();
              //  $this->message->custom_error_msg('admin/payroll/employee/employeeDetails?tab=login/' . $id, $errors);
            }
            $this->message->custom_success_msg('admin/payroll/employee/employeeDetails?tab=login/' .$id, lang('password_update_successfully'));
        } else {
            $error = validation_errors();
            $this->message->custom_error_msg('admin/payroll/employee/employeeDetails?tab=login/' .$id, $error);
        }

    }

    public function awardList()
    {
        $data['department'] = $this->db->get('payroll_department')->result();
        $data['page_title'] = lang('employee_award');
        $this->render_admin('payroll/employee/employee_award', $data);

    }
    public function get_awardlist()
    {
        $actions = "<div class=\"text-center\">";
        $actions .= '<div class="btn-group"><a style="padding:6px;" class="btn btn-xs btn-default" href="javascript:void(0)" onclick="edit_title(' . "'" . '$1' . "'" . ')"><i class="fa fa-pencil"></i></a>
        		<a class="btn btn-xs btn-danger" style="margin-left:6px;padding:6px;" href="javascript:void(0)"  onclick="deleteItem(' . "'" . '$1' . "'" . ')"><i class="glyphicon glyphicon-trash"></i></a></div>';
        $actions .= "</div>";
        $this->datatables
            ->select("payroll_employee_award.id,employee.employee_id ,  CONCAT(first_name,'  ',last_name) name,gift_item,award_name, award_amount , award_month ", false)
            ->join("employee", "employee.id=payroll_employee_award.employee_id", "left")
            ->from("payroll_employee_award")
            ->add_column("Actions", $actions, "payroll_employee_award.id");
        echo $this->datatables->generate();
    }

    public function edit_award($id)
    {
        $this->global_model->table = 'payroll_employee_award';
        $data = $this->global_model->get_by_id($id);
        $employees = $this->db->get_where('employee', array('department' => $data->department_id, 'termination' => 1))->result();
        $selectbox = '';
        if (!empty($employees)) {
            foreach ($employees as $employee) {
                $selected = ($data->employee_id == $employee->id) ? 'selected' : '';
                $selectbox .= '<option value="' . $employee->id . '""' . $selected . '">' . $employee->first_name . '</option>';
            }
        }
        $selectboxs = (object) $selectbox;
        $obj_merged = (object) array_merge((array) $selectboxs, (array) $data);
        echo json_encode($obj_merged);
    }
    public function add_award()
    {
        $this->global_model->table = 'payroll_employee_award';
        $this->_award_validate();
        $data = array(
            'employee_id' => $this->input->post('employee_id'),
            'gift_item' => $this->input->post('gift_item'),
            'award_name' => $this->input->post('award_name'),
            'award_amount' => $this->input->post('award_amount'),
            'award_month' => $this->input->post('month'),
            'department_id' => $this->input->post('department_id'),
        );
        $insert = $this->global_model->save($data);
        echo json_encode(array("status" => true));
    }

    public function update_award()
    {
        $this->global_model->table = 'payroll_employee_award';
        $this->_award_validate();
        $data = array(
            'employee_id' => $this->input->post('employee_id'),
            'gift_item' => $this->input->post('gift_item'),
            'award_name' => $this->input->post('award_name'),
            'award_amount' => $this->input->post('award_amount'),
            'award_month' => $this->input->post('month'),
            'department_id' => $this->input->post('department_id'),
        );
        $this->global_model->update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => true));
    }

    public function delete_award($id)
    {
        $this->global_model->table = 'payroll_employee_award';
        //$result = $this->db->get_where('payroll_employee', array('department' => $id))->result();
        if (!empty($id)) {
            $this->global_model->delete_by_id($id);
            echo 1;
        } else {
            echo 0;
        }

    }

    private function _award_validate()
    {
        $rules = array(
            array('field' => 'employee_id', 'label' => lang('employee'), 'rules' => 'trim|required'),
            array('field' => 'deduction_name', 'label' => lang('Deduction_name'), 'rules' => 'trim|required'),
            array('field' => 'month', 'label' => lang('month'), 'rules' => 'trim|required'),
            array('field' => 'department_id', 'label' => lang('department'), 'rules' => 'trim|required'),
        );

        $this->global_model->validation($rules);
    }

//// ADVANCE AMOUNT

    public function advanceList()
    {
        $data['department'] = $this->db->get('payroll_department')->result();
        $data['page_title'] = lang('Advance_payment_list');
        $this->render_admin('payroll/employee/Employee_advance', $data);

    }
    public function get_adavancelist()
    {
        $actions = "<div class=\"text-center\">";
        $actions .= '<div class="btn-group"><a style="padding:6px;" class="btn btn-xs btn-default" href="javascript:void(0)" onclick="edit_title(' . "'" . '$1' . "'" . ')"><i class="fa fa-pencil"></i></a>
        		<a class="btn btn-xs btn-danger" style="margin-left:6px;padding:6px;" href="javascript:void(0)"  onclick="deleteItem(' . "'" . '$1' . "'" . ')"><i class="glyphicon glyphicon-trash"></i></a></div>';
        $actions .= "</div>";
        $this->datatables
            ->select("payroll_employee_advance.id,employee.employee_id ,  CONCAT(first_name,'  ',last_name) name,Advance_date,Amount_amount,Purpose,CASE IS_PAID WHEN 0 THEN
             'Not Paid'
         WHEN 1 THEN
             'Paid'

    END IS_PAID ", false)
            ->join("employee", "employee.id=payroll_employee_advance.employee_id", "left")
            ->from("payroll_employee_advance")
        //->add_column("Actions", $actions, "payroll_employee_advance.id");
            ->add_column("Actions", $actions, "payroll_employee_advance.id");
        echo $this->datatables->generate();
    }

    public function edit_advance($id)
    {
        $this->global_model->table = 'payroll_employee_advance';
        $data = $this->global_model->get_by_id($id);
        $employees = $this->db->get_where('employee', array('department' => $data->department_id, 'termination' => 1))->result();
        $selectbox = '';
        if (!empty($employees)) {
            foreach ($employees as $employee) {
                $selected = ($data->employee_id == $employee->id) ? 'selected' : '';
                $selectbox .= '<option value="' . $employee->id . '""' . $selected . '">' . $employee->first_name . '</option>';
            }
        }
        $selectboxs = (object) $selectbox;
        $obj_merged = (object) array_merge((array) $selectboxs, (array) $data);
        echo json_encode($obj_merged);
    }
    public function add_advance()
    {
        $this->global_model->table = 'payroll_employee_advance';
        $this->_advance_validate();
        $data = array(
            'employee_id' => $this->input->post('employee_id'),
            'Purpose' => $this->input->post('purpose'),
            'Amount_amount' => $this->input->post('Amounts'),
            'Advance_date' => $this->input->post('advancedatte'),
            'department_id' => $this->input->post('department_id'),
        );
        $insert = $this->global_model->save($data);
        echo json_encode(array("status" => true));
    }

    public function update_advance()
    {
        $this->global_model->table = 'payroll_employee_advance';
        $this->_advance_validate();
        $data = array(
            'employee_id' => $this->input->post('employee_id'),
            'Purpose' => $this->input->post('purpose'),
            'Amount_amount' => $this->input->post('Amounts'),
            'Advance_date' => $this->input->post('advancedatte'),
            'department_id' => $this->input->post('department_id'),
        );
        $this->global_model->update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => true));
    }

    public function delete_advance($id)
    {
        $this->global_model->table = 'payroll_employee_advance';
        //$result = $this->db->get_where('payroll_employee', array('department' => $id))->result();
        if (!empty($id)) {
            $this->global_model->delete_by_id($id);
            echo 1;
        } else {
            echo 0;
        }

    }

    private function _advance_validate()
    {
        $rules = array(
            array('field' => 'employee_id', 'label' => lang('employee'), 'rules' => 'trim|required'),
            array('field' => 'Amounts', 'label' => lang('amount'), 'rules' => 'trim|required'),
            array('field' => 'advancedatte', 'label' => lang('Advance_Date'), 'rules' => 'trim|required'),
            array('field' => 'department_id', 'label' => lang('department'), 'rules' => 'trim|required'),
        );

        $this->global_model->validation($rules);
    }

    public function AdvanceList1()
    {
        $data['modal'] = false;
        $this->mTitle = lang('Advance_payment_list');
        $this->render('employee/Employee_advance');
    }

    public function add_advance1()
    {
        $data['department'] = $this->db->get('department')->result();
        $data['modal_subview'] = $this->load->view('admin/employee/_modals/add_Advance', $data, false);
        $this->load->view('admin/_partials/_layout_modal_small', $data);
    }

    public function save_advance1()
    {
        $id = $this->encrypt->decode(str_replace(array('-', '_', '~'), array('+', '/', '='), $this->input->post('id')));
        $this->form_validation->set_rules('employee_id', lang('employee'), 'trim|required|xss_clean');
        //   $this->form_validation->set_rules('tenure', lang('Tenure'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('Amounts', lang('amount'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('department_id', lang('department'), 'trim|required|xss_clean');
        if ($this->form_validation->run() == true) {
            $data['employee_id'] = $this->input->post('employee_id');
            $data['Purpose'] = $this->input->post('purpose');
            $data['Amount_amount'] = $this->input->post('Amounts');
            $data['Advance_date'] = $this->input->post('advancedatte');
            //    $data['Tenture'] = $this->input->post('tenure');
            //    $data['Tenture_amount'] = $this->input->post('Amounts')/$this->input->post('tenure');
            $data['BalanceAmount'] = $this->input->post('Amounts');
            $data['department_id'] = $this->input->post('department_id');
            if (empty($id)) {
                $this->db->insert('employee_advance', $data);
            } else {
                $this->db->where('id', $id);
                $this->db->update('employee_advance', $data);
            }
            $this->message->save_success('admin/employee/AdvanceList');
        } else {
            $error = validation_errors();
            $this->message->custom_error_msg('admin/employee/AdvanceList', $error);
        }
    }

    public function employeeAdvanceTable1()
    {
        $this->global_model->table = 'employee_advance';
        $this->global_model->order = array('id' => 'desc');
        $list = $this->global_model->get_advance_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array();

            //$row[] = $item->employee_personal_id;
            $row[] = $item->termination == 0 ? '<span class="label bg-red">' . $item->employee_personal_id . '</span>' : $item->employee_personal_id;
            $row[] = $item->first_name . ' ' . $item->last_name;
            $row[] = $item->Advance_date;
            $row[] = $item->Amount_amount;
            $row[] = $item->Purpose;
            //  $row[] = $item->Tenture;
            $row[] = ($item->IS_PAID == 0) ? '<p class="btn-danger" style="font-size:12px; padding: 0px;text-align:center;">Not Paid</p>' : '<p class="btn-success" style="font-size:12px;text-align:center;"> Paid</p>';
            //add html for action
            if ($item->IS_PAID != 1) {
                $row[] = '<div class="btn-group"><a class="btn btn-xs btn-default" data-target="#modalSmall" title="View" data-placement="top" data-toggle="modal"
            href="' . site_url('admin/employee/editEmployeeadvance/' . str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encrypt->encode($item->id))) . '" ><i class="fa fa-pencil"></i></a>
            <a class="btn btn-xs btn-danger" style="margin-left:12px;" href="javascript:void(0)"  onclick="deleteItem(' . "'" . $item->id . "'" . ')"><i class="glyphicon glyphicon-trash"></i></a></div>';
            } else {
                $row[] = '<div class="btn-group">
            <a class="btn btn-xs btn-danger" style="margin-left:12px;" href="javascript:void(0)"  onclick="deleteItem(' . "'" . $item->id . "'" . ')"><i class="glyphicon glyphicon-trash"></i></a></div>';
            }

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->global_model->count_all(),
            "recordsFiltered" => $this->global_model->count_filtered_award(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
    public function editEmployeeadvance1($id = null)
    {
        $id = $this->encrypt->decode(str_replace(array('-', '_', '~'), array('+', '/', '='), $id));
        $data['advance'] = $this->db->select('employee_advance.*, employee.department')
            ->from('employee_advance')
            ->join('employee', 'employee_advance.employee_id = employee.id', 'left')
            ->where('employee_advance.id', $id)
            ->get()
            ->row();
        $data['employee'] = $this->db->get_where('employee', array(
            'department' => $data['advance']->department,
        ))->result();
        $data['department'] = $this->db->get('department')->result();
        $data['modal_subview'] = $this->load->view('admin/employee/_modals/add_Advance', $data, false);
        $this->load->view('admin/_partials/_layout_modal_small', $data);
    }

    public function delete_advance1($id)
    {
        $this->global_model->table = 'employee_advance';
        $result = $this->db->get_where('employee_advance', array('id' => $id))->result();
        $data = array('Soft_delete' => 1);
        if (!empty($result)) {
            $this->db->delete('employee_advance', array('id' => $id));
            echo 1;
        } else {
            echo 0;
        }
    }

/////deduction  amount

    public function DeductionList()
    {
        $data['department'] = $this->db->get('payroll_department')->result();
        $data['page_title'] = lang('Employee_deduction');
        $this->render_admin('payroll/employee/employee_Deduction', $data);

    }
    public function get_deductionlist()
    {
        $actions = "<div class=\"text-center\">";
        $actions .= '<div class="btn-group"><a style="padding:6px;" class="btn btn-xs btn-default" href="javascript:void(0)" onclick="edit_title(' . "'" . '$1' . "'" . ')"><i class="fa fa-pencil"></i></a>
        		<a class="btn btn-xs btn-danger" style="margin-left:6px;padding:6px;" href="javascript:void(0)"  onclick="deleteItem(' . "'" . '$1' . "'" . ')"><i class="glyphicon glyphicon-trash"></i></a></div>';
        $actions .= "</div>";
        $this->datatables
            ->select("payroll_employee_deduction.id,employee.employee_id ,  CONCAT(first_name,'  ',last_name) name,Description,Deduction_name, deduction_amount , Deduction_month ", false)
            ->join("employee", "employee.id=payroll_employee_deduction.employee_id", "left")
            ->from("payroll_employee_deduction")
            ->add_column("Actions", $actions, "payroll_employee_deduction.id");
        echo $this->datatables->generate();
    }

    public function edit_deduction($id)
    {
        $this->global_model->table = 'payroll_employee_deduction';
        $data = $this->global_model->get_by_id($id);
        $employees = $this->db->get_where('employee', array('department' => $data->department_id, 'termination' => 1))->result();
        $selectbox = '';
        if (!empty($employees)) {
            foreach ($employees as $employee) {
                $selected = ($data->employee_id == $employee->id) ? 'selected' : '';
                $selectbox .= '<option value="' . $employee->id . '""' . $selected . '">' . $employee->first_name . '</option>';
            }
        }
        $selectboxs = (object) $selectbox;
        $obj_merged = (object) array_merge((array) $selectboxs, (array) $data);
        echo json_encode($obj_merged);
    }
    public function add_deduction()
    {
        $this->global_model->table = 'payroll_employee_deduction';
        $this->_deduction_validate();
        $data = array(
            'employee_id' => $this->input->post('employee_id'),
            'Description' => $this->input->post('description'),
            'Deduction_name' => $this->input->post('deduction_name'),
            'deduction_amount' => $this->input->post('deduction_amount'),
            'Deduction_month' => $this->input->post('month'),
            'department_id' => $this->input->post('department_id'),
        );
        $insert = $this->global_model->save($data);
        echo json_encode(array("status" => true));
    }

    public function update_deduction()
    {
        $this->global_model->table = 'payroll_employee_deduction';
        $this->_deduction_validate();
        $data = array(
            'employee_id' => $this->input->post('employee_id'),
            'Description' => $this->input->post('description'),
            'Deduction_name' => $this->input->post('deduction_name'),
            'deduction_amount' => $this->input->post('deduction_amount'),
            'Deduction_month' => $this->input->post('month'),
            'department_id' => $this->input->post('department_id'));
        $this->global_model->update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => true));
    }

    public function delete_deduction($id)
    {
        $this->global_model->table = 'payroll_employee_deduction';
        //$result = $this->db->get_where('payroll_employee', array('department' => $id))->result();
        if (!empty($id)) {
            $this->global_model->delete_by_id($id);
            echo 1;
        } else {
            echo 0;
        }
    }

    private function _deduction_validate()
    {
        $rules = array(
            array('field' => 'employee_id', 'label' => lang('employee'), 'rules' => 'trim|required'),
            array('field' => 'deduction_name', 'label' => lang('Deduction_name'), 'rules' => 'trim|required'),
            array('field' => 'month', 'label' => lang('month'), 'rules' => 'trim|required'),
            array('field' => 'department_id', 'label' => lang('department'), 'rules' => 'trim|required'),
        );

        $this->global_model->validation($rules);
    }

    public function termination($id = null)
    {
        $data['id'] = $id;
        $data['terminations'] = $this->db->get_where('termination_type', array(
            'Soft_delete' => 0))->result();
        $id = $this->encrypt->decode(str_replace(array('-', '_', '~'), array('+', '/', '='), $id));
        $result = $this->db->get_where('employee', array('id' => $id))->row();
        if (!empty($result->termination_note)) {
            $termination = json_decode($result->termination_note);
            $data['termination'] = $termination;
        }
        $data['modal_subview'] = $this->load->view('admin/employee/_modals/termination', $data, false);
        $this->load->view('admin/_partials/_layout_modal_small', $data);
    }

    public function employeeTermination()
    {
        $id = $this->encrypt->decode(str_replace(array('-', '_', '~'), array('+', '/', '='), $this->input->post('id')));
        if (empty($id)) {
            $this->message->norecord_found('admin/employee/employeeList');
        }

        $this->form_validation->set_rules('termination_date', lang('termination_date'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('termination_reason', lang('termination_reason'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('termination_note', lang('termination_note'), 'trim|required|xss_clean');

        if ($this->form_validation->run() == true) {

            $termination = array(
                'termination_date' => $this->input->post('termination_date'),
                'termination_reason' => $this->input->post('termination_reason'),
                'termination_note' => $this->input->post('termination_note'),
            );

            $data['termination_note'] = json_encode($termination);
            $data['termination'] = 0;

            //update employee table
            $this->db->where('id', $id);
            $this->db->update('employee', $data);

            //update employee login table
            $loginId = $this->db->get_where('users', array(
                'employee_id' => $id,
            ))->row()->id;

            $login['active'] = 0;
            $this->db->where('id', $loginId);
            $this->db->update('users', $login);

            $this->message->save_success('admin/employee/employeeDetails?tab=termination/' . str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encrypt->encode($id)));
        } else {
            $error = validation_errors();
            $this->message->custom_error_msg('admin/employee/employeeDetails/' . str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encrypt->encode($id)), $error);
        }
    }

    public function terminatedEmployeeList()
    {

        $data['page_title'] = lang('terminated_employee_list');
        $this->render_admin('payroll/employee/terminatedEmployeeList');
    }
    public function get_terminationlist()
    {
        $actions = "<div class=\"text-center\">";
        $actions .= '<div class="btn-group"><a style="padding:6px;" class="btn btn-xs btn-default" href="' . base_url('admin/payroll/employee/employeeDetails/$1') . '" ><i class="fa fa-search"></i></a>
</div>';
        $actions .= "</div>";
        $this->datatables
            ->select("employee.id ,employee_id,CONCAT(first_name,'  ',last_name) name,payroll_department.department,job_title,status_name,shift_name", false)
            ->from("employee")
            ->join("payroll_department", "payroll_department.id=employee.department", "left")
            ->join("payroll_job_title", "payroll_job_title.id=employee.title", "left")
            ->where("employee.termination", 0)
            ->add_column("Actions", $actions, "employee.id");
        echo $this->datatables->generate();
    }
    public function terminatedEmployeeTable()
    {
        $this->global_model->table = 'employee';
        $list = $this->global_model->get_terminatedEmployee_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $item->employee_id;
            $row[] = $item->first_name . ' ' . $item->last_name;
            $row[] = $item->department_name;
            $row[] = $item->title;
            $row[] = $item->status_name;
            $row[] = $item->shift_name;

            //add html for action
            $row[] = '<div class="btn-group"><a class="btn btn-xs btn-default" href="' . site_url('admin/employee/employeeDetails/' . str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encrypt->encode($item->id))) . '" ><i class="fa fa-search"></i></a>
            <a class="btn btn-xs btn-danger" style="margin-left:12px;" onClick="return confirm(\'Are you sure you want to delete ? \')"  href="' . site_url('admin/employee/DeleteEmployee/' . str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encrypt->encode($item->id))) . '" >
            <i class="glyphicon glyphicon-trash"></i></a></div>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->global_model->count_terminatedEmployee(),
            "recordsFiltered" => $this->global_model->count_filtered_terminatedEmployee(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function change_status()
    {
        $id = $this->encrypt->decode(str_replace(array('-', '_', '~'), array('+', '/', '='), $this->input->post('userId')));
        $status = $this->input->post('status');

        $this->db->set('active', $status, false)->where('id', $id)->update('users');
    }

    public function reJoin($id = null)
    {
        $id = $this->encrypt->decode(str_replace(array('-', '_', '~'), array('+', '/', '='), $id));
        if (empty($id)) {
            $this->message->norecord_found('admin/employee/employeeList');
        } else {

            $this->db->set('termination', 1, false)->where('id', $id)->update('employee');
            $this->db->set('active', 1, false)->where('employee_id', $id)->update('users');

            $this->message->custom_success_msg('admin/employee/employeeDetails/' . str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encrypt->encode($id)), lang('re_join_employment_successfully'));

        }
    }

    public function deposit()
    {
        $id = $this->input->post('id');
        if (empty($id)) {
            $this->message->norecord_found('admin/employee/employeeList');
        }
        $this->form_validation->set_rules('account_name', lang('account_name'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('account_number', lang('account_number'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('bank_name', lang('bank_name'), 'trim|required|xss_clean');
        if ($this->form_validation->run() == true) {
            $deposit = array(
                'account_name' => $this->input->post('account_name'),
                'account_number' => $this->input->post('account_number'),
                'bank_name' => $this->input->post('bank_name'),
                'note' => $this->input->post('note'),
            );
            $data['deposit'] = json_encode($deposit);

            //update
            $this->db->where('id', $id);
            $this->db->update('employee', $data);

            $this->message->save_success('admin/payroll/employee/employeeDetails?tab=deposit/' . $id);
        } else {
            $error = validation_errors();
            $this->message->custom_error_msg('admin/payroll/employee/employeeDetails?tab=deposit/' . $id, $error);
        }
    }

    public function DeleteEmployee($id = null)
    {
        $id = $this->encrypt->decode(str_replace(array('-', '_', '~'), array('+', '/', '='), $id));
        if (empty($id)) {
            $this->message->norecord_found('admin/employee/employeeList');
        }

        //delete
        $data['termination'] = 0;
        $data['soft_delete'] = 1;
        //update employee table
        $this->db->where('id', $id);
        $this->db->update('employee', $data);
        //update employee login table
        $loginId = $this->db->get_where('users', array(
            'employee_id' => $id,
        ))->row()->id;
        $this->db->delete('users', array('id' => $loginId));
        $this->message->custom_success_msg('admin/employee/employeeList', lang('employee_delete_success'));

    }

    //=================================================================
    //*************************Employee Attendance *******************
    //=================================================================

    public function setAttendance()
    {
        $data[''] = lang('set_attendance');
        $data['all_leave_category_info'] = $this->db->get('payroll_leave_application_type')->result();
        $data['all_department'] = $this->db->get('payroll_department')->result();
        $data['department_id'] = $this->input->post('department_id');
        $data['date'] = $this->input->post('date', true);
        $sbtnType = $this->input->post('sbtn');
        $flag = $this->session->userdata('flag');
        if ($sbtnType == 1 || $flag == 1) {
            if ($flag) {
                $data['date'] = $this->session->userdata('date');
                $data['department_id'] = $this->session->userdata('department_id');
                $this->session->unset_userdata('date');
                $this->session->unset_userdata('flag');
                $this->session->unset_userdata('department_id');
            } else {
                $this->form_validation->set_rules('date', lang('date'), 'required');
                $this->form_validation->set_rules('department_id', lang('department'), 'required');
                if ($this->form_validation->run() == true) {
                    $data['employee_info'] = $this->db->get_where('employee', array(
                        'department' => $this->input->post('department_id'),
                        'termination' => 1,
                    ))->result();
                    foreach ($data['employee_info'] as $v_employee) {
                        $where = array('employee_id' => $v_employee->id, 'Attendancedate' => $data['date'], 'Soft_delete' => 0);
                        $data['atndnce'][] = $this->attendance_model->check_bys($where, 'payroll_attendanc_sheet');
                    }
                    $data['date'] = $this->input->post('date');
                    $data['department_id'] = $this->input->post('department_id');
                } else {
                    $error = validation_errors();
                    $this->message->custom_error_msg('admin/employee/setAttendance', $error);
                }
            }
        }
        //print_r( $data['atndnce']);
        $this->render_admin('payroll/employee/set_attendance', $data);
    }
    public function save_attendance()
    {
        $attendance_status = $this->input->post('attendance', true);
        $leave_category_id = $this->input->post('leave_category_id', true);
        $employee_id = $this->input->post('employee_id', true);
        $attendance_id = $this->input->post('attendance_id', true);
        $in_time = $this->input->post('in', true);
        $out_time = $this->input->post('out', true);
        $shiftids = $this->input->post('shiftid', true);

        //print_r($shiftids);
        //    echo '<br>';

        if (!empty($attendance_id)) {
            foreach ($employee_id as $empID) {
                $data['Attendancedate'] = $this->input->post('date', true);
                $data['Absent'] = 'True';
                $employee = $this->db->get_where('employee', array('id' => $empID));
                $employee = $employee->row();
                $employeeName = isset($employee->first_name) ? $employee->first_name : '';
                $data['EmployeeName'] = $employeeName;
                if (!empty($attendance_status)) {

                    foreach ($attendance_status as $key => $item) {
                        if ($empID == $item) {
                            $data['Absent'] = '';
                            $data['leave_category_id'] = null;
                            $data['Clock_in'] = date("H:i:s", strtotime($in_time[$key]));
                            $data['Clock_out'] = date("H:i:s", strtotime($out_time[$key]));
                            $data['Shift_id'] = $shiftids[$key];
                            $shiftname = $this->db->get_where('payroll_work_shift', array('id' => $shiftids[$key]))->row();
                            $data['Shift_name'] = isset($shiftname->shift_name) ? $shiftname->shift_name : '';
                            $data['Onduty_time'] = isset($shiftname->shift_form) ? $shiftname->shift_form : '';
                            $data['Offduty_time'] = isset($shiftname->shift_to) ? $shiftname->shift_to : '';
                            $data['Late'] = '00:00:00';
                            $data['Early'] = '00:00:00';

                            if (!empty($leave_category_id[$key])) {
                                $data['leave_category_id'] = $leave_category_id[$key];
                                $leaveType = $this->db->get_where('payroll_leave_application_type', array('id' => $leave_category_id[$key]))->row();
                                $Deduct_days = isset($leaveType->Deduct_days) ? $leaveType->Deduct_days : 0;
                                $data['Leave_deduct_day'] = $Deduct_days;
                                $data['Absent'] = 'true';
                            } else {
                                $data['leave_category_id'] = null;
                            }
                            $id = isset($attendance_id[$key]) ? $attendance_id[$key] : 0;
                            if ($id != 0) {
                                $data['employee_id'] = $empID;
                                $this->db->where('id', $id);
                                $this->db->update('payroll_attendanc_sheet', $data);
                                //  print_r($data);echo '<br>';
                            } else {
                                $data['employee_id'] = $empID;
                                $data['Entry_type'] = 1;
                                $this->db->insert('payroll_attendanc_sheet', $data);
                                //print_r($data);echo '<br>';
                            }

                        }

                    }

                }
            }

        } else {

            foreach ($employee_id as $empID) {

                $employee = $this->db->get_where('employee', array('id' => $empID));
                $employee = $employee->row();
                $employeeName = isset($employee->first_name) ? $employee->first_name : '';
                $data['Attendancedate'] = $this->input->post('date', true);
                $data['Absent'] = 'True';
                $data['EmployeeName'] = $employeeName;
                $data['employee_id'] = $empID;
                if (!empty($attendance_status)) {

                    $keys = 0;
                    foreach ($attendance_status as $key => $item) {
                        if ($empID == $item) {
                            $data['Absent'] = '';
                            $data['leave_category_id'] = null;
                            $data['Clock_in'] = date("H:i:s", strtotime($in_time[$key]));
                            $data['Clock_out'] = date("H:i:s", strtotime($out_time[$key]));
                            $data['Shift_id'] = $shiftids[$key];
                            $shiftname = $this->db->get_where('payroll_work_shift', array('id' => $shiftids[$key]))->row();
                            $data['Shift_name'] = isset($shiftname->shift_name) ? $shiftname->shift_name : '';
                            $data['Onduty_time'] = isset($shiftname->shift_form) ? $shiftname->shift_form : '';
                            $data['Offduty_time'] = isset($shiftname->shift_to) ? $shiftname->shift_to : '';
                            $data['Entry_type'] = 1;
                            $data['Late'] = '00:00:00';
                            $data['Early'] = '00:00:00';
                            if (!empty($leave_category_id[$key])) {
                                $data['leave_category_id'] = $leave_category_id[$key];
                                $leaveType = $this->db->get_where('payroll_leave_application_type', array('id' => $leave_category_id[$key]))->row();
                                $Deduct_days = isset($leaveType->Deduct_days) ? $leaveType->Deduct_days : 0;
                                $data['Leave_deduct_day'] = $Deduct_days;
                                $data['Absent'] = 'true';
                            } else {
                                $data['leave_category_id'] = null;
                            }
                            $this->db->insert('payroll_attendanc_sheet', $data);

                        }
                    }

                }

            }
        }

        $fdata['department_id'] = $this->input->post('department_id', true);
        $fdata['date'] = $this->input->post('date');
        $fdata['flag'] = 1;
        $this->session->set_userdata($fdata);
        $this->message->save_success('admin/payroll/employee/setAttendance', $data);

    }

    public function report()
    {
        $sbtn = $this->input->post('sbtn', true);
        $this->form_validation->set_rules('date', lang('date'), 'required');
        $this->form_validation->set_rules('department_id', lang('department'), 'required');
        if ($sbtn) {
            if ($this->form_validation->run() == true) {
                $department_id = $this->input->post('department_id', true);
                $date = $this->input->post('date', true);
                $month = date('n', strtotime($date));
                $year = date('Y', strtotime($date));
                $num = cal_days_in_month(CAL_GREGORIAN, $month, $year);
                $data['employee'] = $this->attendance_model->get_employee_id_by_dept_id($department_id);
                $day = date('d', strtotime($date));
                for ($i = 1; $i <= $num; $i++) {
                    $data['dateSl'][] = $i;
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
                foreach ($data['employee'] as $sl => $v_employee) {
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
                            $data['attendance'][$sl][] = $this->attendance_model->attendance_report_by_empid($v_employee->id, $sdate, $flag);
                        } else {
                            $data['attendance'][$sl][] = $this->attendance_model->attendance_report_by_empid($v_employee->id, $sdate);
                        }

                        $key++;
                        $flag = '';
                    }
                }

                $data['date'] = $this->input->post('date', true);
                $where = array('id' => $department_id);
                $data['dept_name'] = $this->attendance_model->check_by($where, 'department');
                $data['month'] = date('F-Y', strtotime($yymm));

            } else {
                $error = validation_errors();
                $this->message->custom_error_msg('admin/employee/report', $error);
            }

        }
        $data['all_department'] = $this->db->get('department')->result();
        $data['department_id'] = $this->input->post('department_id', true);
        $this->mTitle .= lang('attendance_report');
        $this->render('employee/attendance_report');
    }
    //=================================================================
    //*************************Employee Application *******************
    //=================================================================

    public function applicationList()
    {
        $data['page_title'] = lang('application_list');
        $this->render_admin('payroll/employee/application_list', $data);
    }
    public function get_applicationlist()
    {
        $actions = "<div class=\"text-center\">";
        $actions .= '<div class="btn-group"><a style="padding:6px;" class="btn btn-xs btn-default"href="' . base_url('admin/payroll/employee/viewApplication/$1') . '" ><i class="fa fa-eye"></i></a>
        		<a class="btn btn-xs btn-danger" style="margin-left:6px;padding:6px;" href="' . base_url('admin/payroll/employee/Delete_leave_status/$1') . '"><i class="glyphicon glyphicon-trash"></i></a></div>';
        $actions .= "</div>";
        $this->datatables
            ->select("payroll_leave_application.id,employee.employee_id ,  CONCAT(first_name,'  ',last_name) name,start_date  ,end_date,payroll_leave_application_type.leave_category,application_date,STATUS", false)
            ->join("employee", "employee.id=payroll_leave_application.employee_id", "left")
            ->join("payroll_leave_application_type", "payroll_leave_application_type.id=payroll_leave_application.leave_ctegory_id", "left")
            ->from("payroll_leave_application")
            ->where("payroll_leave_application.Soft_delete", 0)
            ->add_column("Actions", $actions, "payroll_leave_application.id");
        echo $this->datatables->generate();
    }

    public function viewApplication($id = null)
    {
        $id = $id;
        $id == true || $this->message->norecord_found('admin/payroll/employee/applicationList');
        $result = $this->db->select('payroll_leave_application.*, employee.first_name, employee.last_name, employee.employee_id, employee.id as emp_id,payroll_leave_application_type.leave_category,payroll_leave_application_type.id as Leaveid')
            ->from('payroll_leave_application')
            ->join('employee', 'employee.id = payroll_leave_application.employee_id', 'left')
            ->join('payroll_leave_application_type', 'payroll_leave_application_type.id = payroll_leave_application.leave_ctegory_id', 'left')
            ->where('payroll_leave_application.id =', $id)
            ->get()
            ->row();
        $data['page_title'] = lang('application_view');
        $result == true || $this->message->norecord_found('admin/payroll/employee/applicationList');
        $data['application'] = $result;
        $this->render_admin('payroll/employee/view_application', $data);
    }

    public function changeApplicationStatus()
    {
        $id = $this->input->post('id');
        $id == true || $this->message->norecord_found('admin/payroll/employee/applicationList');
        //update
        $status = $this->input->post('status');
        $data = array('status' => $status, 'Read_id' => 1);
        $config['upload_path'] = './assets/uploads/Leave_certificte/';
        $config['allowed_types'] = 'gif|jpg|png|docx|doc|txt|rtf|pdf';
        $config['max_size'] = '1000';
        $config['max_width'] = '1024';
        $config['max_height'] = '1068';
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('Certificate')) {
            $uploadData = $this->upload->data();
            $uploadedFile = $uploadData['file_name'];
            $uploadedFile_exten = $uploadData['file_ext'];
            $Pathinfo = './assets/uploads/Leave_certificte/' . $uploadedFile;
            $data = array(
                'File_path_Url' => $Pathinfo,
            );
        }
        $this->db->where('id', $id);
        $this->db->update('payroll_leave_application', $data);
        $this->message->save_success('admin/payroll/employee/applicationList');
    }

    //=============================================================
    //  Import Employee
    //=============================================================

    public function downloadEmployeeSample()
    {
        $this->load->helper('download');
        $file = base_url() . SAMPLE_FILE . '/' . 'employee.xlsx';
        $data = file_get_contents($file);
        force_download('employee.xlsx', $data);
    }
    public function importEmployee()
    {

        if (isset($_POST["submit"])) {
            $tmp = explode(".", $_FILES['import']['name']); // For getting Extension of selected file
            $extension = end($tmp);
            $allowed_extension = array("xls", "xlsx", "csv"); //allowed extension
            if (in_array($extension, $allowed_extension)) //check selected file extension is present in allowed extension array
            {
                $this->load->library('Data_importer');
                $file = $_FILES["import"]["tmp_name"]; // getting temporary
                $prefix = EMPLOYEE_ID_PREFIX;
                // prepend file path with project directory
                $excel = PHPExcel_IOFactory::load($file);
                $i = 0;
                foreach ($excel->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $first_name = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $last_name = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $marital_status = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        //  $date_of_birth      = date('Y-m-d', strtotime($worksheet->getCellByColumnAndRow(3, $row)->getValue()));
                        $date_of_birth = \PHPExcel_Style_NumberFormat::toFormattedString($worksheet->getCellByColumnAndRow(3, $row)->getValue(), 'YYYY-MM-DD');
                        if (!empty($date_of_birth)) {
                            $date_of_birth;

                        } else {
                            $date_of_birth = "";
                        }
                        $gender = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $department = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $job_title = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                        $id_number = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                        $employee_type = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                        $Emp_Account_id = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                        //$department = trim($department);
                        //$job_title = trim($job_title);
                        //$employee_type = trim($employee_type);
                        $employee_type = isset($employee_type) ? $employee_type : '';
                        $data_dept = array(
                            'department' => $department);
                        $data_job_title = array(
                            'job_title' => $job_title);
                        $data_emp_type = array(
                            'Name' => $employee_type);
                        if (isset($department)) {
                            $department = $this->db->get_where('department', array('department' => $department))->row();
                            if (empty($department->department)) {
                                $this->db->insert('department', $data_dept);
                                $department_id = $this->db->insert_id();
                                $department = $this->db->get_where('department', array('id' => $department_id))->row('department');
                            } else { $department_id = $department->id;
                                $department = $department->department;}
                        }
                        if (isset($job_title)) {
                            $job_title = $this->db->get_where('job_title', array('job_title' => $job_title))->row();
                            if (empty($job_title->job_title)) {
                                $this->db->insert('job_title', $data_job_title);
                                $job_title_id = $this->db->insert_id();
                                $job_title = $this->db->get_where('job_title', array('id' => $job_title_id))->row('job_title');
                            } else { $job_title_id = $job_title->id;
                                $job_title = $job_title->job_title;}
                        }
                        $employee_type = $this->db->get_where('employee_type', array('Name' => $employee_type))->row();
                        if (empty($employee_type->Name)) {
                            $this->db->insert('employee_type', $data_emp_type);
                            $employee_type_id = $this->db->insert_id();
                            $employee_type = $this->db->get_where('employee_type', array('Name' => $employee_type->Name))->row('Name');
                        } else { $employee_type_id = $employee_type->Employee_Type_id;
                            $employee_type = $employee_type->Name;}
                        if (isset($job_title) && isset($department)) {
                            $data[] = array(
                                'first_name' => $first_name,
                                'last_name' => $last_name,
                                'marital_status' => $marital_status,
                                'date_of_birth' => $date_of_birth,
                                'gender' => $gender,
                                'department' => $department,
                                'department_id' => $department_id,
                                'job_title_id' => $job_title_id,
                                'job_title' => $job_title,
                                'id_number' => !empty($id_number) ? $id_number : 0,
                                'employee_type' => $employee_type,
                                'employee_type_id' => $employee_type_id,
                                'Emp_acc_no' => $Emp_Account_id,
                            );
                        }
                    }

                }

                $table = '';
                $table .= '<table width="100%" classs="table table-striped" style="table-layout:fixed;" > <caption>Errors are highlighted. Please correct it to save successfully.</caption><th>Firstname</th><th>Lastname</th><th>Marital</th><th>DOB</th><th>Gender</th><th>Dept</th><th>Job Title</th><th>ID No</th><th>Emp type</th><th>Emp Acc_no</th>';
                foreach ($data as $items) {
                    $table .= '<tr style="background-color:#fff;">
		<td><input type="text" value="' . $items['first_name'] . '" name="firstname[' . $i . ']"></td>' .
                        '<td><input type="text" value="' . $items['last_name'] . '" name="lastname[' . $i . ']"></td>' .
                        '<td><input type="text" value="' . $items['marital_status'] . '" name="marital[' . $i . ']"></td>' .
                        '<td><input type="text" value="' . $items['date_of_birth'] . '" name="dob[' . $i . ']"  class="correct dob datepicker"></td>' .
                        '<td><input type="text" value="' . $items['gender'] . '" name="gender[' . $i . ']"></td>' .

                        '<td><input type="text" value="' . $items['department'] . '" name="department[' . $i . ']">
	   <input type="hidden" value="' . $items['department_id'] . '" name="deparment_id[' . $i . ']"></td>' .
                        '<td><input type="text" value="' . $items['job_title'] . '" name="job_title[' . $i . ']">
	    <input type="hidden" value="' . $items['job_title_id'] . '" name="job_title_id[' . $i . ']"></td>' .
                        '<td><input type="text" value="' . $items['id_number'] . '" name="id_number[' . $i . ']"></td>' .
                        '<td><input type="text" value="' . $items['employee_type'] . '" name="employee_type[' . $i . ']">
	   <input type="hidden" value="' . $items['employee_type_id'] . '" name="employee_type_id[' . $i . ']"></td>
	      <td><input type="text" value="' . $items['Emp_acc_no'] . '" name="Emp_acc_no[' . $i . ']"></td>' .

                        '</tr>';
                    $i++;
                }
                $table .= '</table>';
                $data['table'] = $table;
            } else {
                $this->message->custom_error_msg('admin/employee/importEmployee', lang('failed_to_import_data'));
            }
        }
        $data['form'] = $this->form_builder->create_form();
        $this->mTitle .= lang('import_data');
        $this->render('import/import_employee');
    }
    // excel validation
    public function name_check($string)
    {
        if (preg_match('/[a-z A-Z]/', $string)) {
            return 'class="correct names"';

        } else {
            return 'class="incorrect names"';
        }
    }
    public function Marital_check($string)
    {

        switch ($string) {
            case 'Single':
                return 'class="correct marital"';
                break;
            case 'single':
                return 'class="correct marital"';
                break;
            case 'Married':
                return ' class="correct marital"';
                break;
            case 'married':
                return ' class="correct marital"';
                break;
            case 'Widow':
                return ' class="correct marital"';
                break;
            case 'Widow':
                return ' class="correct marital"';
                break;
            case 'Widower':
                return ' class="correct marital"';
                break;
            case 'widower':
                return ' class="correct marital"';
                break;
            case 'Divorcee':
                return ' class="correct marital"';
                break;
            case 'divorcee':
                return ' class="correct marital"';
                break;

            default:
                return 'title="Not Valid" class="incorrect marital"';
        }

    }
    public function Gender_check($string)
    {
        switch ($string) {
            case 'Male':
                return 'class="correct gender"';
                break;
            case 'male':
                return ' class="correct gender"';
                break;
            case 'Female':
                return ' class="correct gender"';
                break;
            case 'female':
                return ' class="correct gender"';
                break;
            case 'others':
                return ' class="correct gender"';
                break;
            case 'Others':
                return ' class="correct gender"';
                break;

            default:
                return ' class="incorrect gender"';
        }
    }
    public function EmployeeSheet_save()
    {

        $first_name = $this->input->post('firstname');
        $last_name = $this->input->post('lastname', true);
        $marital_status = $this->input->post('marital', true);
        $date_of_birth = $this->input->post('dob', true);
        $gender = $this->input->post('gender', true);
        $department_id = $this->input->post('deparment_id', true);
        $job_title = $this->input->post('job_title_id', true);
        $id_number = $this->input->post('id_number', true);
        $Emp_acc_no = $this->input->post('Emp_acc_no', true);
        $prefix = EMPLOYEE_ID_PREFIX;

        foreach ($first_name as $key => $value) {
            $data = array(
                'first_name' => $first_name[$key],
                'last_name' => $last_name[$key],
                'marital_status' => $marital_status[$key],
                'date_of_birth' => $date_of_birth[$key],
                'gender' => $gender[$key],
                'id_number' => $id_number[$key],
                'department' => $department_id[$key],
                'title' => $job_title[$key],
                'Category_id' => 1,
                'Empid' => $Emp_acc_no[$key],
            );
            $empexists = $this->db->get_where('employee', array('first_name' => $first_name[$key], 'last_name' => $last_name[$key], 'gender' => $gender[$key]))->row();
            if (empty($empexists)) {
                $this->db->trans_start();
                $this->db->insert('employee', $data);
                $id = $this->db->insert_id();
                $this->db->trans_complete();

                if ($this->db->trans_status() === true) {
                    $employee_id = $prefix + $id;
                    $path = UPLOAD_EMPLOYEE . $employee_id;
                    mkdir_if_not_exist($path);
                    $data = array('employee_id' => $employee_id);
                    $this->db->where('id', $id);
                    $this->db->update('employee', $data);
                }
            } else {
                $this->db->where('id', $empexists->id);
                $this->db->update('employee', $data);
            }
        }
        $this->message->save_success('admin/employee/importEmployee');
    }

    //=============================================================
    //  Import Attendance
    //=============================================================

    public function downloadAttendanceSample()
    {
        $this->load->helper('download');
        $file = base_url() . SAMPLE_FILE . '/' . 'attendance.csv';
        $data = file_get_contents($file);
        force_download('attendance.csv', $data);
    }

    public function importAttendance()
    {

        if (isset($_POST["submit"])) {
            $tmp = explode(".", $_FILES['import']['name']); // For getting Extension of selected file
            $extension = end($tmp);
            $allowed_extension = array("xls", "xlsx", "csv"); //allowed extension
            if (in_array($extension, $allowed_extension)) //check selected file extension is present in allowed extension array
            {
                $this->load->library('Data_importer');
                $file = $_FILES["import"]["tmp_name"]; // getting temporary source of excel file
                $this->data_importer->attendance_excel_import($file);
            } else {
                $this->message->custom_error_msg('admin/payroll/employee/importAttendance', lang('failed_to_import_data'));
            }
        }
        $data['form'] = $this->form_builder->create_form();
        $array = array('termination' => 1, 'soft_delete' => 0);
        $this->db->select(' employee.employee_id,employee.first_name , employee.last_name,payroll_department.department')
            ->from('employee')
            ->join('payroll_department', 'employee.department = payroll_department.id', 'left')
            ->where($array);
        $result = $this->db->get();

        $data['crud'] = $result->result();
        $data['page_title']= lang('import_data');
        $this->render_admin('payroll/import/import_attendance',$data);
    }
    public function Task()
    {
        $data['modal'] = false;
        $this->mTitle = lang('employee_award');
        $this->render('employee/employee_Task');
    }
    public function add_Task()
    {
        $data['department'] = $this->db->get('department')->result();
        $data['modal_subview'] = $this->load->view('admin/employee/_modals/add_task', $data, false);
        $this->load->view('admin/_partials/_layout_modal_small', $data);
    }

    public function save_Task()
    {
        $id = $this->encrypt->decode(str_replace(array('-', '_', '~'), array('+', '/', '='), $this->input->post('id')));
        $this->form_validation->set_rules('employee_id', lang('employee'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('Task_title', lang('Task_Title'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('Description', lang('Task_Description'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('From_date', lang('From_date'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('To_date', lang('To_date'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('department_id', lang('department'), 'trim|required|xss_clean');
        if ($this->form_validation->run() == true) {
            $data['employee_id'] = $this->input->post('employee_id');
            $data['tile'] = $this->input->post('Task_title');
            $data['Description'] = $this->input->post('Description');
            $data['from_date'] = $this->input->post('From_date');
            $data['to_date'] = $this->input->post('To_date');
            $data['department_id'] = $this->input->post('department_id');
            $data['Created_on'] = date("Y-m-d h:i:sa");
            if (empty($id)) {
                $this->db->insert('task', $data);
            } else {
                $this->db->where('id', $id);
                $this->db->update('task', $data);
            }
            $this->message->save_success('admin/employee/Task');
        } else {
            $error = validation_errors();
            $this->message->custom_error_msg('admin/employee/Task', $error);
        }
    }

    public function employeeTaskTable()
    {
        $this->global_model->table = 'task';
        $this->global_model->order = array('task_id' => 'desc');
        $list = $this->global_model->get_task_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $item->employee_id;
            // $row[] = $item->termination == 0 ? '<span class="label bg-red">'.$item->employee_personal_id .'</span>':$item->employee_personal_id ;
            $row[] = $item->department;
            $row[] = $item->tile;
            $row[] = $item->Description;
            $row[] = $item->to_date;
            $row[] = $item->from_date;
            //$row[] = $item->from_date;
            //add html for action
            $row[] = '<div class="btn-group"><a class="btn btn-xs btn-default" data-target="#modalSmall" title="View" data-placement="top" data-toggle="modal"
    href="' . site_url('admin/employee/editTask/' . str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encrypt->encode($item->Task_id))) . '" ><i class="fa fa-pencil"></i></a>
    <a class="btn btn-xs btn-danger" style="margin-left:12px;" href="javascript:void(0)"  onclick="deleteItem(' . "'" . $item->Task_id . "'" . ')"><i class="glyphicon glyphicon-trash"></i></a></div>';
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->global_model->count_all(),
            "recordsFiltered" => $this->global_model->count_filtered_task(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
/*
public function View_file($id = null)
{
$id = $this->encrypt->decode(str_replace(array('-', '_', '~'), array('+', '/', '='), $id));
$result= $this->db->get_where('leave_application', array('id' =>$id))->row();
$path=$result->File_path_Url;
$filetype = substr($path, strrpos($path, '.') + 1);
if($filetype=='pdf')
{
echo 'pdfs';
echo APPPATH.$path;

}else if($filetype=='gif' || $filetype=='jpg'|| $filetype=='png' || $filetype=='jpeg')
{
echo' <img src="E:\xampp\htdocs\Sramhrm\assets\uploads\Leave_certificte\Chrysanthemum.jpg" />';
// echo APPPATH.$path;
//  redirect(APPPATH.$path);
//echo '<img  border="0" align="center"  src="APPPATH.$path"/> ';

}
/* define('DOMPDF_ENABLE_AUTOLOAD', false);
// require_once("./third_party/dompdf/dompdf_config.inc.php");
require_once(APPPATH.'third_party/dompdf/autoload.inc.php');

$dompdf = new Dompdf();
$dompdf->load_html($html);
$dompdf->set_paper($paper, $orientation);
$dompdf->render();
if ($stream) {
$dompdf->stream($filename.".pdf", array("Attachment" => 0));
} else {
return $dompdf->output();
}

}
 */
    public function Delete_leave_status($id = null)
    {
        $id = $id;
        $data = array('Soft_delete' => 1);
        $this->db->where('id', $id);
        $this->db->update('payroll_leave_application', $data);
        if ($this->db->trans_status() === true) {
            $this->session->set_flashdata('message', lang('delete_success'));
            redirect('admin/payroll/employee/applicationList/');

        }
    }

    public function consolidate_setattendance()
    {
        $attendance = $this->input->post('attendance', true);
        $leave_category_id = $this->input->post('leave_category_id', true);
        $employee_id = $this->input->post('employeeid', true);
        $in_time = $this->input->post('in', true);
        $out_time = $this->input->post('out', true);
        $shiftids = $this->input->post('shiftid', true);
        $month = $this->input->post('month', true);
        $department = $this->input->post('department', true);
        if (!empty($attendance)) {
            $data['Absent'] = 'True';
            $employee = $this->db->get_where('employee', array('id' => $employee_id));
            $employee = $employee->row();
            $employeeName = isset($employee->first_name) ? $employee->first_name . '' . $employee->last_name : '';
            $data['EmployeeName'] = $employeeName;
            if (!empty($attendance)) {
                foreach ($attendance as $key => $item) {
                    $data['Attendancedate'] = $item;
                    $data['Absent'] = '';
                    $data['leave_category_id'] = null;
                    $data['Clock_in'] = date("H:i:s", strtotime($in_time[$key]));
                    $data['Clock_out'] = date("H:i:s", strtotime($out_time[$key]));
                    $data['Shift_id'] = $shiftids[$key];
                    $shiftname = $this->db->get_where('payroll_work_shift', array('id' => $shiftids[$key]))->row();
                    $data['Shift_name'] = isset($shiftname->shift_name) ? $shiftname->shift_name : '';
                    $data['Onduty_time'] = isset($shiftname->shift_form) ? $shiftname->shift_form : '';
                    $data['Offduty_time'] = isset($shiftname->shift_to) ? $shiftname->shift_to : '';
                    $data['Late'] = '00:00:00';
                    $data['Early'] = '00:00:00';
                    if (!empty($leave_category_id[$key])) {
                        $data['leave_category_id'] = $leave_category_id[$key];
                        $leaveType = $this->db->get_where('payroll_leave_application_type', array('id' => $leave_category_id[$key]))->row();
                        $Deduct_days = isset($leaveType->Deduct_days) ? $leaveType->Deduct_days : 0;
                        $data['Leave_deduct_day'] = $Deduct_days;
                        $data['Absent'] = 'true';
                    } else {
                        $data['leave_category_id'] = 0;
                    }
                    $data['employee_id'] = $employee_id;
                    $data['Entry_type'] = 1;
                    if ($data) {
                        $where = array('Employee_id' => $employee_id, 'Attendancedate' => $item, 'Shift_id' => $shiftids[$key]);
                        $this->db->where($where);
                        $this->db->delete('payroll_attendanc_sheet');
                        $this->db->insert('payroll_attendanc_sheet', $data);
                    }
                }
            }
        }
        redirect('admin/payroll/payroll/Consolidateview?tab=reviewAttendance/' . $employee_id . '/' . $month . '/' . $department);
    }
}
