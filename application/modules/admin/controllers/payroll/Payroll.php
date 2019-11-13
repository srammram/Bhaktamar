<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Payroll extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
      //  $this->load->library('form_builder');
        //$this->load->model('payroll/settings_model');
        // $this->load->model('payroll/global_model');
        $this->load->model('payroll/attendance_model');
        // $this->mTitle = TITLE;
    }
    public function employee()
    {
        if ($this->ion_auth->in_group('admin')) {
            $this->mTitle .= lang('make_payment');
            $data['department'] = $this->db->get('department')->result();
            $this->render('payroll/select_employee');
        } else {
            $this->mTitle .= lang('make_payment');
            $data['department'] = $this->db->get('department')->result();
            $this->render('payroll/select_employee1');
        }
    }
    public function setEmployeePayment()
    {
        $this->form_validation->set_rules('department_id', lang('department'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('employee_id', lang('employee'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('month', lang('month'), 'trim|required|xss_clean');
        $months = $this->input->post('month') . '-' . '01';
        $employee_id = $this->input->post('employee_id');
        //    if ($employee_id == 'ALL') {
        $currency = $this->db->get_where('currency_master', array('Soft_delete' => 0))->row();
        $department = $this->db->get_where('department', array('id' => $this->input->post('department_id')))->row();
        if ($this->form_validation->run() == true) {if ($employee_id == 'ALL') {
            $employees = $this->db->query("SELECT * FROM    `employee` WHERE joined_date <='" . $months . "'  AND department='" . $this->input->post('department_id') . "' AND termination=1 AND soft_delete=0 ")->result();
        } else {
            $employees = $this->db->query("SELECT * FROM    `employee` WHERE joined_date <='" . $months . "'  AND department='" . $this->input->post('department_id') . "' AND termination=1 AND soft_delete=0 and  id='" . $employee_id . "'")->result();
        }
            $m = date('n', strtotime($months));
            $y = date('Y', strtotime($months));
            $num = cal_days_in_month(CAL_GREGORIAN, $m, $y);
            $monthsalary = array();
            $salaryconfigcheck = $this->attendance_model->checksalary($employees);
            if (!empty($salaryconfigcheck)) {
                $data['salaryconfigcheck'] = $salaryconfigcheck;
                $this->render('payroll/select_employee');
            } else {
                foreach ($employees as $employee) {
                    //get empdetails
                    $empdetails = $this->db->select('employee .*, job_title.job_title, emp_status.status_name ')->from('employee')->join('job_title', 'job_title.id = employee.title', 'left')->join('emp_status', 'emp_status.id = employee.employment_status', 'left')->where('employee.id', $employee->id)->get()->row();
                    //get latefine

                    $query = $this->db->query("SELECT Fine_for_late,Total_workingday_pe_mon FROM  employee e
                         LEFT JOIN `category_settings` cs ON cs.id=e.Category_id WHERE e.id=$employee->id");
                    $category = $query->row();
                    ///get bonus of employee
                    $award = $this->db->get_where('employee_award', array('award_month' => $this->input->post('month'), 'employee_id' => $employee->id))->result();
                    $awardamount = 0.00;
                    if (!empty($award)) {
                        foreach ($award as $item) {
                            $awardamount += $item->award_amount;
                        }
                    }
                    $penalty = $this->db->get_where('employee_deduction', array('Deduction_month' => $this->input->post('month'), 'employee_id' => $employee->id))->result();
                    $deductionamount = 0.00;
                    if (!empty($penalty)) {
                        foreach ($penalty as $item) {
                            $deductionamount += $item->deduction_amount;
                        }
                    }
                    $salary = $this->db->get_where('salary', array('employee_id' => $employee->id))->row();
                    $lop = $this->getlop($employee->id_number, $this->input->post('month'), $employee->id);
                    $taxs = $this->tax_S($employee->id);
                    $total_lateminute = $lop['total_latemintue'];
                    $absent_Based_on_time_sheet = $lop["absent_Based_on_time_sheet"];
                    $OverTime = $lop["OverTime"];
                    $Monthwise_absent = $this->monthWise_absent($employee->id, $months);
                    $year_salary = $taxs['YearSalary'];
                    $tax = $taxs['tax'];
                    if (isset($taxs['YearSalary']) && (isset($taxs['tax']->Tax_percentage) && (($taxs['tax']->Tax_percentage)) > 0)) {
                        $monthtax = round((((($taxs['YearSalary'] / 100) * ($taxs['tax']->Tax_percentage)) - $taxs['tax']->Allow_Benefits) / 12), 2);
                    } else {
                        $monthtax = 0;
                    }
                    if (isset($taxs['YearSalary']) && (isset($taxs['tax']->Tax_percentage) && (($taxs['tax']->Tax_percentage)) > 0)) {
                        $annualtax = (($taxs['YearSalary'] / 100) * ($taxs['tax']->Tax_percentage)) - $taxs['tax']->Allow_Benefits;
                    } else {
                        $annualtax = 0;
                    }
                    if (!empty($salary->Current_total_payable)) {
                        $payamount = round(((($salary->Current_total_payable / $category->Total_workingday_pe_mon) * ($category->Total_workingday_pe_mon - $absent_Based_on_time_sheet)) - ($category->Fine_for_late * $total_lateminute)), 2);
                        $totalpayamount = ($payamount + $awardamount) - $deductionamount;
                    }
                    if ($category->Total_workingday_pe_mon > $absent_Based_on_time_sheet) {
                        $totallop = $absent_Based_on_time_sheet;
                    } else {
                        $totallop = $category->Total_workingday_pe_mon;
                    }
                    if ($total_lateminute > 0) {
                        $totallatemin = $total_lateminute;
                    } else {
                        $totallatemin = 0;
                    }
                    if (!empty($salary->Current_total_payable)) {
                        $payamount = round(((($salary->Current_total_payable / $category->Total_workingday_pe_mon) * ($category->Total_workingday_pe_mon - $totallop)) - ($category->Fine_for_late * $totallatemin)), 2);
                        $totalpayamount = ($payamount + $awardamount) - $deductionamount;
                    }
                    $OvertimeAmount = round((($salary->Current_total_payable + $salary->Current_total_deduction) / ($category->Total_workingday_pe_mon) * $OverTime), 2);
                    $monthsalary[] = array('salarymont' => $this->input->post('month'), 'employeename' => $employee->first_name . $employee->last_name, 'employeeid' => $employee->id, 'lop' => $totallop, 'department' => $department->department, 'latemin' => $totallatemin, 'grosssalary' => $salary->Current_total_payable + $salary->Current_total_deduction, 'deduction' => $salary->Current_total_deduction, 'latefineamount' => $category->Fine_for_late, 'netsalary' => $salary->Current_total_payable, 'lateamount' => $category->Fine_for_late * $totallatemin, 'pendeduction' => $deductionamount, 'bonus' => $awardamount,
                        'annualtax' => $annualtax, 'monthlytax' => $monthtax, 'paymentamount' => ($totalpayamount + $OvertimeAmount) - $monthtax, 'year_salary' => $taxs['YearSalary'], 'OverTime' => $OverTime, 'OvertimeAmount' => $OvertimeAmount);
                }
                $data['monthsalary'] = $monthsalary;
                $this->render('payroll/select_employee');
            }

        } else {
            echo $error = validation_errors();
            $this->message->custom_error_msg('admin/payroll/employee', $error);
        }
    }
    public function Official_setEmployeePayment()
    {
        $this->form_validation->set_rules('department_id', lang('department'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('employee_id', lang('employee'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('month', lang('month'), 'trim|required|xss_clean');
        $months = $this->input->post('month') . '-' . '01';
        $employee_id = $this->input->post('employee_id');
        //    if ($employee_id == 'ALL') {
        $currency = $this->db->get_where('currency_master', array('Soft_delete' => 0))->row();
        $department = $this->db->get_where('department', array('id' => $this->input->post('department_id')))->row();
        if ($this->form_validation->run() == true) {if ($employee_id == 'ALL') {
            $employees = $this->db->query("SELECT * FROM    `employee` WHERE joined_date <='" . $months . "'  AND department='" . $this->input->post('department_id') . "' AND termination=1 AND soft_delete=0 ")->result();
        } else {
            $employees = $this->db->query("SELECT * FROM    `employee` WHERE joined_date <='" . $months . "'  AND department='" . $this->input->post('department_id') . "' AND termination=1 AND soft_delete=0 and  id='" . $employee_id . "'")->result();
        }
            $m = date('n', strtotime($months));
            $y = date('Y', strtotime($months));
            $num = cal_days_in_month(CAL_GREGORIAN, $m, $y);
            $monthsalary = array();
            $salaryconfigcheck = $this->attendance_model->checksalary($employees);
            if (!empty($salaryconfigcheck)) {
                $data['salaryconfigcheck'] = $salaryconfigcheck;
                $this->render('payroll/select_employee');
            } else {
                foreach ($employees as $employee) {
                    //get empdetails
                    $empdetails = $this->db->select('employee .*, job_title.job_title, emp_status.status_name ')->from('employee')->join('job_title', 'job_title.id = employee.title', 'left')->join('emp_status', 'emp_status.id = employee.employment_status', 'left')->where('employee.id', $employee->id)->get()->row();
                    //get latefine
                    $query = $this->db->query("SELECT Fine_for_late,Total_workingday_pe_mon FROM  employee e
                         LEFT JOIN `category_settings` cs ON cs.id=e.Category_id WHERE e.id=$employee->id");
                    $category = $query->row();
                    ///get bonus of employee
                    $award = $this->db->get_where('employee_award', array('award_month' => $this->input->post('month'), 'employee_id' => $employee->id))->result();
                    $awardamount = 0.00;
                    if (!empty($award)) {
                        foreach ($award as $item) {
                            $awardamount += $item->award_amount;
                        }
                    }
                    $penalty = $this->db->get_where('employee_deduction', array('Deduction_month' => $this->input->post('month'), 'employee_id' => $employee->id))->result();
                    $deductionamount = 0.00;
                    if (!empty($penalty)) {
                        foreach ($penalty as $item) {
                            $deductionamount += $item->deduction_amount;
                        }
                    }
                    $salary = $this->db->get_where('salary', array('employee_id' => $employee->id))->row();
                    $lop = $this->getlop($employee->id_number, $this->input->post('month'), $employee->id);

                    $taxs = $this->Official_tax_S($employee->id);
                    $total_lateminute = $lop['total_latemintue'];
                    $absent_Based_on_time_sheet = $lop["absent_Based_on_time_sheet"];
                    $OverTime = $lop["OverTime"];
                    $Monthwise_absent = $this->monthWise_absent($employee->id, $months);
                    $year_salary = $taxs['YearSalary'];
                    $tax = $taxs['tax'];
                    if (isset($taxs['YearSalary']) && (isset($taxs['tax']->Tax_percentage) && (($taxs['tax']->Tax_percentage)) > 0)) {
                        $monthtax = round((((($taxs['YearSalary'] / 100) * ($taxs['tax']->Tax_percentage)) - $taxs['tax']->Allow_Benefits) / 12), 2);
                    } else {
                        $monthtax = 0;
                    }
                    if (isset($taxs['YearSalary']) && (isset($taxs['tax']->Tax_percentage) && (($taxs['tax']->Tax_percentage)) > 0)) {
                        $annualtax = (($taxs['YearSalary'] / 100) * ($taxs['tax']->Tax_percentage)) - $taxs['tax']->Allow_Benefits;
                    } else {
                        $annualtax = 0;
                    }
                    if (!empty($salary->total_payable)) {
                        $payamount = round(((($salary->total_payable / $category->Total_workingday_pe_mon) * ($category->Total_workingday_pe_mon - $absent_Based_on_time_sheet)) - ($category->Fine_for_late * $total_lateminute)), 2);
                        $totalpayamount = ($payamount + $awardamount) - $deductionamount;
                    }
                    if ($category->Total_workingday_pe_mon > $absent_Based_on_time_sheet) {
                        $totallop = $absent_Based_on_time_sheet;
                    } else {
                        $totallop = $category->Total_workingday_pe_mon;
                    }
                    if ($total_lateminute > 0) {
                        $totallatemin = $total_lateminute;
                    } else {
                        $totallatemin = 0;
                    }
                    if (!empty($salary->total_payable)) {
                        $payamount = round(((($salary->total_payable / $category->Total_workingday_pe_mon) * ($category->Total_workingday_pe_mon - $totallop)) - ($category->Fine_for_late * $totallatemin)), 2);
                        $totalpayamount = ($payamount + $awardamount) - $deductionamount;
                    }
                    $monthsalary[] = array('salarymont' => $months, 'employeename' => $employee->first_name . $employee->last_name, 'employeeid' => $employee->id, 'lop' => $totallop, 'department' => $department->department, 'latemin' => $totallatemin, 'grosssalary' => $salary->total_payable + $salary->total_deduction, 'deduction' => $salary->total_deduction, 'latefineamount' => $category->Fine_for_late, 'netsalary' => $salary->total_payable, 'lateamount' => $category->Fine_for_late * $totallatemin, 'pendeduction' => $deductionamount, 'bonus' => $awardamount,
                        //   'taxslab' => $taxs['tax']->Start_range . '-' . $taxs['tax']->End_range,
                        //  'Taxper' => $taxs['tax']->Tax_percentage,
                        'annualtax' => $annualtax, 'monthlytax' => $monthtax, 'paymentamount' => $totalpayamount - $monthtax, 'year_salary' => $taxs['YearSalary'], 'OverTime' => $OverTime);
                }
                $data['monthsalary'] = $monthsalary;
                $this->render('payroll/select_employee1');
            }

        } else {
            echo $error = validation_errors();
            $this->message->custom_error_msg('admin/payroll/employee', $error);
        }

    }

    public function savecurrentsalary()
    {
        foreach ($_POST['employeeid'] as $key => $eid) {
            $yearsalary = $this->input->post('year_salary')[$key];
            $tax = $this->db->query("SELECT * FROM `tax_slab` WHERE $yearsalary  BETWEEN Start_range AND End_range")->row();
            $salary = $this->db->get_where('salary', array('employee_id' => $eid))->row();
            $employess = $this->db->get_where('employee', array('id' => $eid))->row();
            $taxper = $tax->Tax_percentage;
            $data = array('month' => date('Y-m', strtotime($this->input->post('salarymonth')[$key])),
                'employee_id' => $this->input->post('employeeid')[$key],
                'department_id' => $employess->department,
                'gross_salary' => $this->input->post('grosssalary')[$key],
                'net_salary' => $this->input->post('payamount')[$key],
                'award' => $this->input->post('bonus')[$key],
                'fine_deduction' => $this->input->post('deduction')[$key],
                'bonus' => $this->input->post('bonus')[$key],
                //'payment_method' => $this->input->post('') [$key],
                'net_payment' => $this->input->post('payamount')[$key],
                'Penalty' => $this->input->post('pendeduction')[$key],
                'Lop' => $this->input->post('lop')[$key],
                'Late_minutes' => $this->input->post('latemin')[$key],
                'Late_fine' => $this->input->post('latefineamount')[$key],
                'Late_amount' => $this->input->post('lateamount')[$key],
                'Payment_amount' => $this->input->post('payamount')[$key],
                'Annual_salary' => $this->input->post('year_salary')[$key],
                'Tax_pecentage' => $taxper,
                'Annual_tax' => $this->input->post('annualtax')[$key],
                'Monthly_tax' => $this->input->post('monthtax')[$key],
                'OverTime' => $this->input->post('OverTime')[$key],
                'component' => $salary->Current_salary_component,
                'OverTimeAmount' => $this->input->post('Overtimamount')[$key],
            );
            $result = $this->attendance_model->saveCurrentSalaryresult($data);
        }
        //print_r($data);
        if ($result) {
            $this->message->save_success('admin/payroll/listSalaryPayment');
        } else {
            $error = 'Data Not Saved';
            $this->message->custom_error_msg('admin/payroll/employee', $error);
        }

    }
    public function saveOfficialsalary()
    {
        foreach ($_POST['employeeid'] as $key => $eid) {
            $yearsalary = $this->input->post('year_salary')[$key];
            $tax = $this->db->query("SELECT * FROM `tax_slab` WHERE $yearsalary  BETWEEN Start_range AND End_range")->row();
            $salary = $this->db->get_where('salary', array('employee_id' => $eid))->row();
            $employess = $this->db->get_where('employee', array('id' => $eid))->row();
            $taxper = $tax->Tax_percentage;
            $data = array('month' => date('Y-m', strtotime($this->input->post('salarymonth')[$key])),
                'employee_id' => $this->input->post('employeeid')[$key],
                'department_id' => $employess->department,
                'gross_salary' => $this->input->post('grosssalary')[$key],
                'net_salary' => $this->input->post('payamount')[$key],
                'award' => $this->input->post('bonus')[$key],
                'fine_deduction' => $this->input->post('deduction')[$key],
                'bonus' => $this->input->post('bonus')[$key],
                //'payment_method' => $this->input->post('') [$key],
                'net_payment' => $this->input->post('payamount')[$key],
                'Penalty' => $this->input->post('pendeduction')[$key],
                'Lop' => $this->input->post('lop')[$key],
                'Late_minutes' => $this->input->post('latemin')[$key],
                'Late_fine' => $this->input->post('latefineamount')[$key],
                'Late_amount' => $this->input->post('lateamount')[$key],
                'Payment_amount' => $this->input->post('payamount')[$key],
                'Annual_salary' => $this->input->post('year_salary')[$key],
                'Tax_pecentage' => $taxper,
                'Annual_tax' => $this->input->post('annualtax')[$key],
                'Monthly_tax' => $this->input->post('monthtax')[$key],
                'OverTime' => $this->input->post('OverTime')[$key],
                'component' => $salary->component);
            $result = $this->attendance_model->saveOfficialSalaryresult($data);
        }
        if ($result) {
            $this->message->save_success('admin/payroll/listSalaryPayment');
        } else {
            $error = 'Data Not Saved';
            $this->message->custom_error_msg('admin/payroll/employee', $error);
        }

    }
    public function savePayroll()
    {
        $employee_id =  $this->input->post('employee_id', true);
        $month = $this->input->post('month', true);
        $this->form_validation->set_rules('payment_method', lang('payment_method'), 'trim|required|xss_clean');
        if ($this->form_validation->run() == true) {
            $salary = $this->db->get_where('payroll_salary', array('employee_id' => $employee_id))->row();
            $employess = $this->db->get_where('employee', array('id' => $employee_id))->row();
            $currency = $this->db->get_where('payroll_currency_master', array('id' => $this->input->post('Currency')))->row();
            $salary = array('employee_id' => $employee_id,
                'month' => $month,
                'department_id' => !empty($employess->department) ? $employess->department : 0,
                'gross_salary' => $this->input->post('grosssalary'),
                'net_salary' => $this->input->post('PayAmounts'),
                'award' => $this->input->post('bonus'),
                'payment_method' => $this->input->post('payment_method'),
                'note' => $this->input->post('note'),
                'net_payment' => $this->input->post('PayAmounts'),
                'Lop' => $this->input->post('lops'),
                'Fine_deduction' => $this->input->post('fine_deduction'),
                'Penalty' => $this->input->post('fine_deduction'),
                'Late_minutes' => $this->input->post('Late_Minutes'),
                'Late_fine' => $this->input->post('Late_fine'),
                'Late_amount' => $this->input->post('Late_Amount'),
                'Payment_amount' => $this->input->post('PayAmounts'),
                'Annual_salary' => $this->input->post('annualsalary'),
                'Tax_pecentage' => $this->input->post('tax_percentage'),
                'Annual_tax' => $this->input->post('Annualtax'),
                'Monthly_tax' => $this->input->post('Monthly_tax'),
                'component' => !empty($salary->component) ? $salary->component : 0,
                'currency_id' => $this->input->post('Currency'),
                'Exchange_rate' => !empty($currency->Exchange_rate) ? $currency->Exchange_rate : 0
                ,
                'OverTime' => !empty($this->input->post('OverTime')) ? $this->input->post('OverTime') : 0,
                'Advance_Amount' => !empty($this->input->post('advance')) ? $this->input->post('advance') : 0);
            $this->attendance_model->Advanceadjustment($salary);

            $payslipid = $this->attendance_model->SaveSalary($salary);
            $this->employeePaySlip($payslipid);
            //$this->message->save_success('admin/payroll/listSalaryPayment');
        } else {
            $error = validation_errors();
            $this->message->custom_error_msg('admin/payroll/payroll/employee/', $error);
        }
    }

    public function saveOfficialPayroll()
    {
        $employee_id = $this->encrypt->decode(str_replace(array('-', '_', '~'), array('+', '/', '='), $this->input->post('employee_id', true)));
        $month = $this->encrypt->decode(str_replace(array('-', '_', '~'), array('+', '/', '='), $this->input->post('month', true)));
        $this->form_validation->set_rules('payment_method', lang('payment_method'), 'trim|required|xss_clean');
        if ($this->form_validation->run() == true) {
            $salary = $this->db->get_where('salary', array('employee_id' => $employee_id))->row();
            $employess = $this->db->get_where('employee', array('id' => $employee_id))->row();
            $currency = $this->db->get_where('currency_master', array('id' => $this->input->post('Currency')))->row();
            $salary = array('employee_id' => $employee_id,
                'month' => $month,
                'department_id' => !empty($employess->department) ? $employess->department : 0,
                'gross_salary' => $this->input->post('grosssalary'),
                'net_salary' => $this->input->post('PayAmounts'),
                'award' => $this->input->post('bonus'),
                'payment_method' => $this->input->post('payment_method'),
                'note' => $this->input->post('note'),
                'net_payment' => $this->input->post('PayAmounts'),
                'Lop' => $this->input->post('lops'),
                'Fine_deduction' => $this->input->post('fine_deduction'),
                'Penalty' => $this->input->post('fine_deduction'),
                'Late_minutes' => $this->input->post('Late_Minutes'),
                'Late_fine' => $this->input->post('Late_fine'),
                'Late_amount' => $this->input->post('Late_Amount'),
                'Payment_amount' => $this->input->post('PayAmounts'),
                'Annual_salary' => $this->input->post('annualsalary'),
                'Tax_pecentage' => $this->input->post('tax_percentage'),
                'Annual_tax' => $this->input->post('Annualtax'),
                'Monthly_tax' => $this->input->post('Monthly_tax'),
                'component' => !empty($salary->component) ? $salary->component : 0,
                'currency_id' => $this->input->post('Currency'),
                'Exchange_rate' => !empty($currency->Exchange_rate) ? $currency->Exchange_rate : 0,
                'Precision_convert_currency' => !empty($currency->Precision_convert_currency) ? $currency->Precision_convert_currency : 0,
                'OverTime' => !empty($this->input->post('OverTime')) ? $this->input->post('OverTime') : 0);
            $this->attendance_model->SaveOfficialSalary($salary);
            $this->message->save_success('admin/payroll/listSalaryPayment');
        } else {
            $error = validation_errors();
            $this->message->custom_error_msg('admin/payroll/employee/', $error);
        }
    }
    public function setSalaryEdit($employeeid, $department, $month)
    {
        
        $department_id =  $department;
        $employee_id =  $employeeid;
        $months = $month . '-' . '01';
        $data['Currency'] = $this->db->get_where('payroll_currency_master', array('Soft_delete' => 0))->result();
        $employee = $this->db->get_where('employee', array('id' => $employee_id))->row();
        $data['page_title'] = lang('SalaryEdit');
        $data['department'] = $this->db->get_where('payroll_department', array('id' => $department_id))->row();
        $data['employee'] = $this->db->select('employee .*, payroll_job_title.job_title, payroll_emp_status.status_name ')
            ->from('employee')
            ->join('payroll_job_title', 'payroll_job_title.id = employee.title', 'left')
            ->join('payroll_emp_status', 'payroll_emp_status.id = employee.employment_status', 'left')
            ->where('employee.id', $employee_id)
            ->get()->row();
        $emp_id = $employee_id;
        $query = $this->db->query("SELECT Fine_for_late FROM  employee e
               LEFT JOIN `payroll_category_settings` cs ON cs.id=e.Category_id WHERE e.id=$emp_id");
        $results = $query->row();
        $data['month'] = $month;
        $data['salary'] = $this->db->get_where('payroll_salary', array('employee_id' => $employee_id))->row();
        $data['salary'] == true || $this->message->custom_error_msg('admin/payroll/employee', 'Sorry! This Employee salary has not set yet.');
        $data['award'] = $this->db->get_where('payroll_employee_award', array(
            'award_month' => $month,
            'employee_id' => $employee_id,
        ))->result();

        $data['findeduction'] = $this->db->get_where('payroll_employee_deduction', array(
            'Deduction_month' => $month,
            'employee_id' => $employee_id,
        ))->result();
        $advances = $this->db->get_where('payroll_employee_advance', array(
            'employee_id' => $employee_id,
        ))->result();
        if (!empty($advances)): $totalbalanceadvance = 0;foreach ($advances as $advance):
                if ($advance->BalanceAmount == '0.00') {
                    continue;
                }
                $totalbalanceadvance += $advance->BalanceAmount;
            endforeach;endif;

        $data['payroll'] = $this->db->get_where('payroll_payroll', array(
            'department_id' => $department_id, 'employee_id' => $employee_id,
            'month' => $month,
        ))->row();
        $months = $month . '-' . '00';
        $data['Advance'] = isset($totalbalanceadvance) ? $totalbalanceadvance : 0;
        $lop = $this->getlop($employee->id_number, $month, $employee_id);
        $data['taxs'] = $this->tax_S($employee_id);
        $data['total_lateminute'] = $lop['total_latemintue'];
        $data['absent_Based_on_time_sheet'] = $lop["absent_Based_on_time_sheet"];
        $data['OverTime'] = $lop["OverTime"];
       // $data['Monthwise_absent'] = $this->monthWise_absent($employee_id, $months);
        $data['fine_amount'] = $results->Fine_for_late;
        $this->render_admin('payroll/payroll/SalaryEdit',$data);

    }

    public function setOfficialSalaryEdit($employeeid, $department, $month)
    {
        $month = $this->encrypt->decode(str_replace(array('-', '_', '~'), array('+', '/', '='), $month));
        $department_id = $this->encrypt->decode(str_replace(array('-', '_', '~'), array('+', '/', '='), $department));
        $employee_id = $this->encrypt->decode(str_replace(array('-', '_', '~'), array('+', '/', '='), $employeeid));
        $months = $month . '-' . '01';
        $data['Currency'] = $this->db->get_where('currency_master', array('Soft_delete' => 0))->result();
        $data['default_currency_Pro'] = $this->db->get_where('currency_master', array('Soft_delete' => 0))->result();

        $employee = $this->db->get_where('employee', array('id' => $employee_id))->row();
        $this->mTitle .= lang('SalaryEdit');
        $data['department'] = $this->db->get_where('department', array('id' => $department_id))->row();
        $data['employee'] = $this->db->get_where('employee', array('id' => $employee_id))->row();
        $data['employee'] = $this->db->select('employee .*, job_title.job_title, emp_status.status_name ')
            ->from('employee')
            ->join('job_title', 'job_title.id = employee.title', 'left')
            ->join('emp_status', 'emp_status.id = employee.employment_status', 'left')
            ->where('employee.id', $employee_id)
            ->get()->row();
        $emp_id = $employee_id;
        $query = $this->db->query("SELECT Fine_for_late FROM  employee e
               LEFT JOIN `category_settings` cs ON cs.id=e.Category_id WHERE e.id=$emp_id");
        $results = $query->row();
        $data['month'] = $month;
        $data['salary'] = $this->db->get_where('salary', array('employee_id' => $employee_id))->row();
        $data['salary'] == true || $this->message->custom_error_msg('admin/payroll/employee', 'Sorry! This Employee salary has not set yet.');
        $data['award'] = $this->db->get_where('employee_award', array(
            'award_month' => $month,
            'employee_id' => $employee_id,
        ))->result();

        $data['findeduction'] = $this->db->get_where('employee_deduction', array(
            'Deduction_month' => $month,
            'employee_id' => $employee_id,
        ))->result();
        $data['payroll'] = $this->db->get_where('official_payroll', array(
            'department_id' => $department_id, 'employee_id' => $employee_id,
            'month' => $month,
        ))->row();
        $months = $month . '-' . '00';
        $lop = $this->getlop($employee->id_number, $month, $employee_id);
        $data['taxs'] = $this->Official_tax_S($employee_id);
        $data['total_lateminute'] = $lop['total_latemintue'];
        $data['OverTime'] = $lop["OverTime"];
        $data['absent_Based_on_time_sheet'] = $lop["absent_Based_on_time_sheet"];
        $data['Monthwise_absent'] = $this->monthWise_absent($employee_id, $months);
        $data['fine_amount'] = $results->Fine_for_late;
        $this->render('payroll/SalaryEdit1');

    }
    public function employeePaySlip($id)
    {
        
            $data['page_title']= lang('salary_payslip');
            $id = $id;
            $id == true || $this->message->norecord_found('admin/payroll/payroll/listSalaryPayment');
            $data['Currency'] =$currency= $this->db->get_where('payroll_currency_master', array('Active' => 1))->row();
            $data['round_off'] = $currency->Round_of;
            $data['Currency_code'] = $currency->Currency_code;
            $data['pay_slip'] = $this->db->get_where('payroll_payroll', array('id' => $id))->row();
            $data['employee'] = $employee_details = $this->db->get_where('employee', array('id' => $data['pay_slip']->employee_id))->row();
            if (isset($employee_details->Category_id)) {
                $Category = $this->db->get_where('payroll_category_settings', array('id' => $employee_details->Category_id))->row();
                $data['TotalWorkingday'] = isset($Category->Total_workingday_pe_mon) ? $Category->Total_workingday_pe_mon : 30;
            } else {
                $data['TotalWorkingday'] = 30;
            }
            $data['employee'] = $this->db->select('employee .*, payroll_job_title.job_title, payroll_department.department, ')->from('employee')->join('payroll_job_title', 'payroll_job_title.id = employee.title', 'left')->join('payroll_department', 'payroll_department.id = employee.department', 'left')->where('employee.id', $data['pay_slip']->employee_id)->get()->row();
            $data['empSalary'] = $this->db->get_where('payroll_payroll', array('employee_id' => $data['pay_slip']->employee_id))->row();
            if (!empty($data['empSalary']->component)) {
                $data['empSalaryDetails'] = json_decode($data['empSalary']->component, true);
            }
            $data['Bonusremark'] = $this->db->get_where('payroll_employee_award', array('award_month' => $data['pay_slip']->month, 'employee_id' => $data['pay_slip']->employee_id))->result();
            $data['Deductionremark'] = $this->db->get_where('payroll_employee_deduction', array('Deduction_month' => $data['pay_slip']->month, 'employee_id' => $data['pay_slip']->employee_id))->result();
            $data['gradeList'] = $this->db->get('payroll_salary_grade')->result();
            $data['salaryEarningList'] = $this->db->get_where('payroll_salary_component', array('type' => 1))->result();
            $data['salaryDeductionList'] = $this->db->get_where('payroll_salary_component', array('type' => 2))->result();
            //net salary(min vali amount and precison calcultion)
            $netsalary = $data['pay_slip']->Payment_amount;
            //split from dollar value
            list($int, $dec) = explode('.', $netsalary);
            $Precision_convert_currency = $this->db->get_where('payroll_currency_master', array('Active' => 1))->row()->Precision_convert_currency;
            $currencylistvalue = $this->db->get_where('payroll_currency_master', array('id' => $Precision_convert_currency))->row();
            $precisionvalue = ('.' . $dec) * $currencylistvalue->Exchange_rate;
            $min_value = $currencylistvalue->Valid_amount;
            $data['precisionvalue'] = $this->Precision_round_off($precisionvalue, $min_value);
            $data['precisionvalue_currency'] = $currencylistvalue->Currency_code;
            $data['precisionvalue_currency'] = $currencylistvalue->Currency_code;
            $this->render_admin('payroll/payroll/employee_payslip',$data);
        
    }
    public function Precision_round_off($precisionvalue, $min_value)
    {
        return ($min_value * floor($precisionvalue / $min_value));
    }
    public function listSalaryPayment(){
            $data['page_title'] = lang('employee_payroll_list');
            $data['department'] = $this->db->get('payroll_department')->result();
            if ($this->input->post('department_id') && $this->input->post('month')) {

                $data['payroll_list'] = $this->db->query("SELECT gross_salary,p.employee_id,first_name,last_name,Payment_amount,month,p.id,job_title,termination,e.department FROM  payroll_payroll p
								LEFT JOIN employee e ON e.id=p.employee_id
								LEFT JOIN payroll_job_title j ON j.id=e.title
								LEFT JOIN payroll_department d ON d.id=p.department_id
								WHERE p.department_id ='" . $this->input->post('department_id') . "'
								AND month ='" . $this->input->post('month') . "'")->result();
            }
            $this->render_admin('payroll/payroll/list_payroll',$data);
    }
    public function ClearAttendance()
    {
        $data['department'] = $this->db->get('department')->result();
        $this->render('payroll/clear_attedance');
    }
    public function Getattendance()
    {
        $this->form_validation->set_rules('department_id', lang('department'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('month', lang('month'), 'trim|required|xss_clean');
        $months = $this->input->post('month') . '-' . '01';
        if ($this->form_validation->run() == true) {
            $employees = $this->attendance_model->GetAttendanceEmployee($months, $this->input->post('department_id'));
            $m = date('n', strtotime($months));
            $y = date('Y', strtotime($months));
            $num = cal_days_in_month(CAL_GREGORIAN, $m, $y);
            $missedshift = $this->attendance_model->MOnthShift_check($this->input->post('month'), $employees, $num);
            // check if record found in given period
            if (!empty($employees)) {
                /// check shift allocated for all staff
                if (!empty($missedshift)) {
                    $data['missedshift'] = $missedshift;
                    $this->render('payroll/clear_attedance');
                } else {
                    ///check all attendance record given properly or not
                    $missedattendance = $this->attendance_model->MOnthAttendance_check($this->input->post('month'), $employees, $num);
                    if (!empty($missedattendance)) {
                        $data['missedAttendance'] = $missedattendance;
                        $this->render('payroll/clear_attedance');
                    } else {
                        //generate attendance data
                        foreach ($employees as $employee) {
                            $lop[] = $this->getlop($employee->id_number, $this->input->post('month'), $employee->id);
                        }

                        $data['lop'] = $lop;
                        $this->render('payroll/clear_attedance');
                    }
                }
            } else {
                $data['norecorsd'] = 'No Record Found';
                $this->render('payroll/clear_attedance');
            }
        } else {
            $error = validation_errors();
            $this->message->custom_error_msg('admin/payroll/ClearAttendance', $error);
        }
    }

    public function getlop($machine_empid, $month, $employee)
    {

        /*    function getlop() {
        $machine_empid=40;
        $month='2019-01';
        $employee =11; */
        //get category Setting data based on  employee
        $category = $this->attendance_model->getemployeewisecategory($employee);
        $limit = $category->Absent_late_for_day;
        $monthworkingday = !empty($category->Total_workingday_pe_mon) ? $category->Total_workingday_pe_mon : 30;
        $OvertimeActive = !empty($category->OverTime) ? $category->OverTime : 0;
        $grace_Late_come = $category->GraceTime_For_late_coming;
        $grace_early_go = $category->GarceTime_for_Early_going;
        $Absent_when_late_for_mins = $category->Absent_when_late_for;
        $absent_work_dur_less_than = $category->Duration_less_than_min;
        $After_grace_minute = $category->After_grace_minute;
        $GraceTime_for = $category->GraceTime_for;
        $fromdate = !empty($category->AttendanceFromDate) ? $category->AttendanceFromDate : 1;
        $Todate = !empty($category->AttendanceTodate) ? $category->AttendanceTodate : 31;
        $Shift_dates = $this->attendance_model->getshiftdate($employee, $month, $fromdate, $Todate);
        foreach ($Shift_dates as $shift) {
            $totalshifts = $this->db->query("SELECT COUNT(id) AS shift FROM `payroll_shift_rosters`  WHERE employee_id=$employee  AND Shift_Date='" . $shift->Shift_Date . "'")->row();
            $totalshifts = $totalshifts->shift;
            if ($shift->Shift_id == 0) {
                $attendenaces = $this->db->get_where('payroll_attendanc_sheet', array('Attendancedate' => $shift->Shift_Date, 'Employee_id' => $shift->employee_id))->result();
                foreach ($attendenaces as $attendenace) {
                    if ($shift->Shift_id == 0 && $attendenace->Absent != 'true' && $OvertimeActive != 0) {
                        $data['OverTimeInDays'][] = round((1 / $totalshifts), 1);
                        $data['overtimedate'][] = $shift->Shift_Date;
                    }
                }
            } else {
                $attendenaces = $this->db->get_where('payroll_attendanc_sheet', array('Shift_id' => $shift->Shift_id, 'Attendancedate' => $shift->Shift_Date, 'Employee_id' => $shift->employee_id))->result();
                foreach ($attendenaces as $attendenace) {
                    $Out_diff = ((strtotime($shift->shift_to) - strtotime($attendenace->Clock_out)) / 60);
                    $Out_diff = ($Out_diff >= 0 ? $Out_diff : 0);
                    $in_diff = ((strtotime($attendenace->Clock_in) - strtotime($shift->shift_form)) / 60);
                    $in_diff = ($in_diff >= 0 ? $in_diff : 0);
                    //  echo $in_diff.'||'.$Out_diff.'||'.$attendenace->Employee_id.'||'.$shift->Shift_Date.'<br>';
                    if ($grace_Late_come != 0 || $grace_early_go != 0) {
                        ///grace time times based
                        if ($GraceTime_for == 'Times' && $GraceTime_for != null) {
                            if ($limit > 0) {
                                // echo $limit;
                                if (strtotime($attendenace->Clock_in) > strtotime($shift->shift_form) || strtotime($attendenace->Clock_out) < strtotime($shift->shift_to) || $attendenace->Absent == 'true') {
                                    if ($in_diff > $Absent_when_late_for_mins && $category->Mark_absent_late_by == 1 || $Out_diff > $category->Absent_when_early_go && $category->Mark_absent_early_go == 1 || $attendenace->Absent == 'true') {
                                        if ($attendenace->Absent == 'true' && $shift->Shift_id != 0) {
                                            $data['Absent'][] = round((1 / $totalshifts), 1);
                                            $data['Absent_date'][] = $shift->Shift_Date;
                                        }
                                    } else {
                                        if ($attendenace->Absent !== 'true') {
                                            if ($attendenace->Clock_in != $shift->shift_form && strtotime($attendenace->Clock_in) > strtotime($shift->shift_form)) {
                                                $data['minute'][] = ($in_diff - $grace_Late_come > 0) ? $in_diff - $grace_Late_come : 0;
                                                $data['minute_date'][] = array('date' => $shift->Shift_Date, 'mintue' => $in_diff - $grace_Late_come, 'Type' => 'In');
                                                $limit--;
                                            }
                                            if (strtotime($attendenace->Clock_out) != strtotime($shift->shift_to) && strtotime($attendenace->Clock_out) <= strtotime($shift->shift_to)) {
                                                $data['minute'][] = ($Out_diff - $grace_early_go > 0) ? $Out_diff - $grace_early_go : 0;
                                                $data['minute_date'][] = array('date' => $shift->Shift_Date, 'mintue' => $Out_diff - $grace_early_go, 'Type' => 'Out');
                                                $limit--;
                                            }
                                        }
                                    }
                                }
                            } else {
                                // after limit calculate with daily limit
                                if (strtotime($attendenace->Clock_in) > strtotime($shift->shift_form) || strtotime($attendenace->Clock_out) < strtotime($shift->shift_to)) {
                                    if ($in_diff > $Absent_when_late_for_mins && $category->Mark_absent_late_by == 1 || $Out_diff > $category->Absent_when_early_go && $category->Mark_absent_early_go == 1 || $attendenace->Absent == 'true' && $shift->Shift_id != 0) {
                                        if ($attendenace->Absent == 'true' && $shift->Shift_id != 0) {
                                            $data['Absent'][] = round((1 / $totalshifts), 1);
                                            $data['Absent_date'][] = $shift->Shift_Date;
                                        }
                                    } else {
                                        if ($attendenace->Absent !== 'true' && $shift->Shift_id != 0) {
                                            if ($attendenace->Clock_in != $shift->shift_form && strtotime($attendenace->Clock_in) > strtotime($shift->shift_form)) {
                                                $data['minute'][] = ($in_diff - $After_grace_minute > 0) ? $in_diff - $After_grace_minute : 0;
                                                $data['minute_date'][] = array('date' => $shift->Shift_Date, 'mintue' => $in_diff - $After_grace_minute, 'Type' => 'In');
                                                //$data['minute'][] = $in_diff ;
                                                // echo $in_diff - $After_grace_minute.'\\'.$shift->Shift_id.'||'.$shift->Shift_Date."||4".'<br>';
                                                //echo $in_diff - $After_grace_minute.'<br>';
                                                // echo $shift->Shift_id.'||'.$shift->Shift_Date.'||'.$in_diff - $After_grace_minute.'<br>';

                                            }
                                            if (strtotime($attendenace->Clock_out) != strtotime($shift->shift_to) && strtotime($attendenace->Clock_out) <= strtotime($shift->shift_to)) {
                                                echo $Out_diff - $After_grace_minute . '\\' . $shift->Shift_id . '||' . $shift->Shift_Date . "||5" . '<br>';
                                                $data['minute'][] = ($Out_diff - $After_grace_minute > 0) ? $Out_diff - $After_grace_minute : 0;
                                                $data['minute_date'][] = array('date' => $shift->Shift_Date, 'mintue' => $Out_diff - $After_grace_minute, 'Type' => 'Out');
                                                //$data['minute'][] = $Out_diff ;

                                            }
                                        }
                                    }
                                }
                            }
                        } else {
                            if ($limit > 0) {
                                // echo $limit;
                                if (strtotime($attendenace->Clock_in) > strtotime($shift->shift_form) || strtotime($attendenace->Clock_out) < strtotime($shift->shift_to) || $attendenace->Absent == 'true') {
                                    if ($in_diff > $Absent_when_late_for_mins && $category->Mark_absent_late_by == 1 || $Out_diff > $category->Absent_when_early_go && $category->Mark_absent_early_go == 1 || $attendenace->Absent == 'true') {
                                        if ($attendenace->Absent == 'true' && $shift->Shift_id != 0) {
                                            $data['Absent'][] = round((1 / $totalshifts), 1);
                                            $data['Absent_date'][] = $shift->Shift_Date;
                                        }
                                    } else {
                                        if ($attendenace->Absent !== 'true') {
                                            if ($attendenace->Clock_in != $shift->shift_form && strtotime($attendenace->Clock_in) > strtotime($shift->shift_form)) {
                                                $data['minute'][] = ($in_diff - $grace_Late_come > 0) ? $in_diff - $grace_Late_come : 0;
                                                $data['minute_date'][] = array('date' => $shift->Shift_Date, 'mintue' => $in_diff - $grace_Late_come, 'Type' => 'In');
                                            }
                                            if (strtotime($attendenace->Clock_out) != strtotime($shift->shift_to) && strtotime($attendenace->Clock_out) <= strtotime($shift->shift_to)) {
                                                //echo $shift->Shift_id.'||'.$shift->Shift_Date.'<br>';
                                                //echo $Out_diff - $grace_early_go.'\\'.$shift->Shift_id.'||'.$shift->Shift_Date."||3".'<br>';
                                                $data['minute'][] = ($Out_diff - $grace_early_go > 0) ? $Out_diff - $grace_early_go : 0;
                                                $data['minute_date'][] = array('date' => $shift->Shift_Date, 'mintue' => $Out_diff - $grace_early_go, 'Type' => 'Out');
                                            }
                                            $limit--;
                                        }
                                    }
                                }
                            } else {
                                // after limit calculate with daily limit
                                if (strtotime($attendenace->Clock_in) > strtotime($shift->shift_form) || strtotime($attendenace->Clock_out) < strtotime($shift->shift_to)) {
                                    if ($in_diff > $Absent_when_late_for_mins && $category->Mark_absent_late_by == 1 || $Out_diff > $category->Absent_when_early_go && $category->Mark_absent_early_go == 1 || $attendenace->Absent == 'true' && $shift->Shift_id != 0) {
                                        if ($attendenace->Absent == 'true' && $shift->Shift_id != 0) {
                                            $data['Absent'][] = round((1 / $totalshifts), 1);
                                            $data['Absent_date'][] = $shift->Shift_Date;
                                        }
                                    } else {
                                        if ($attendenace->Absent !== 'TRUE' && $shift->Shift_id != 0) {
                                            if ($attendenace->Clock_in != $shift->shift_form && strtotime($attendenace->Clock_in) > strtotime($shift->shift_form)) {
                                                $data['minute'][] = ($in_diff - $After_grace_minute > 0) ? $in_diff - $After_grace_minute : 0;
                                                $data['minute_date'][] = array('date' => $shift->Shift_Date, 'mintue' => $in_diff - $After_grace_minute, 'Type' => 'In');
                                            }
                                            if (strtotime($attendenace->Clock_out) != strtotime($shift->shift_to) && strtotime($attendenace->Clock_out) <= strtotime($shift->shift_to)) {
                                                $data['minute'][] = ($Out_diff - $After_grace_minute > 0) ? $Out_diff - $After_grace_minute : 0;
                                                $data['minute_date'][] = array('date' => $shift->Shift_Date, 'mintue' => $Out_diff - $After_grace_minute, 'Type' => 'Out');
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    } else {
                        // $times_min = (explode(":", $record->times));
                        //list($h, $m) = $times_min;
                        //$total_minutes = ($h * 60) + $m;
                        // when late coming and early going not given then will run this block
                        if ($in_diff > $Absent_when_late_for_mins && $category->Mark_absent_late_by == 1 || $Out_diff > $category->Absent_when_early_go && $category->Mark_absent_early_go == 1 && $category->Cal_ab_if_work_dur_less_than == 1 && $in_diff + $Out_diff > $Absent_when_late_for_mins || $attendenace->Absent == 'true')
                        //|| $total_minutes < $category->Duration_less_than_min
                        {
                            if ($attendenace->Absent == 'true' && $shift->Shift_id != 0) {
                                $data['Absent'][] = round((1 / $totalshifts), 1);
                                $data['Absent_date'][] = $shift->Shift_Date;
                            }
                        } else {
                            //All grace and all Late scenario didn't consider . only consider absent. when Absent =='true'
                            if ($attendenace->Absent == 'true') {
                                $data['Absent'][] = 1;
                                $data['Absent_date'][] = $shift->Shift_Date;
                            }
                            if ($category->Fine_active == 0 && $category->GraceTime_For_late_coming == 0 && $category->GarceTime_for_Early_going == 0) {
                                $data['minute'][] = 0;
                            } else {
                                $data['minute'][] = ($in_diff + $Out_diff - $After_grace_minute >= 0 ? $in_diff + $Out_diff - $After_grace_minute : 0);
                            }
                        }
                    }
                    //    }
                }
            }
        }
        //    if $data['Absent'] not set will assign 0
        if (isset($data['Absent'])) {
            if (is_array($data['Absent'])) {
                //half day calculation
                $absent_Based_on_time_sheet = 0;
                foreach ($data['Absent'] as $num => $values) {
                    $absent_Based_on_time_sheet += $values;
                }

                // $absent_Based_on_time_sheet = ($absent_Based_on_time_sheet / $totalshifts);
                $overTimes = isset($data['OverTimeInDays']) ? $data['OverTimeInDays'] : 0;

            } else {
                $absent_Based_on_time_sheet = 0;
                $overTimes = isset($data['OverTimeInDays']) ? $data['OverTimeInDays'] : 0;

            }
        } else {
            $absent_Based_on_time_sheet = 0;
            $overTimes = isset($data['OverTimeInDays']) ? $data['OverTimeInDays'] : 0;

        }
        // if $data['minute'] not set will assign 0
        if (isset($data['minute'])) {
            if (is_array($data['minute'])) {
                $total_late_time = array_sum($data['minute']);
            } else {
                $total_late_time = 0;
            }
        } else {
            $total_late_time = 0;
        }

        if (isset($data['Absent_date'])) {
            if (is_array($data['Absent_date'])) {
                $data['Absent_date'];
            } else {
                $data['Absent_date'] = array();
            }
        } else {
            $data['Absent_date'] = array();
        }

        if (isset($data['overtimedate'])) {
            if (is_array($data['overtimedate'])) {
                $data['overtimedate'];
            } else {
                $data['overtimedate'] = array();
            }
        } else {
            $data['overtimedate'] = array();
        }

        if (isset($data['minute_date'])) {
            if (is_array($data['minute_date'])) {
                $data['minute_date'];
            } else {
                $data['minute_date'] = array();
            }
        } else {
            $data['minute_date'] = array();
        }

        $datas = array('total_latemintue' => $total_late_time, 'absent_Based_on_time_sheet' => $absent_Based_on_time_sheet, 'EmployeeName' => $category->first_name . '-' . $category->last_name, 'workingday' => $category->Total_workingday_pe_mon, 'month' => $month, 'employeeid' => $category->id, 'OverTime' => $overTimes, 'absentdate' => $data['Absent_date'], 'OT_date' => $data['overtimedate'], 'latemin' => $data['minute_date']);

        return $datas;
    }

    public function Saveattendance()
    {
        foreach ($_POST['employeeid'] as $key => $eid) {
            $data = array('employee_id' => $this->input->post('employeeid')[$key], 'Employeename' => $this->input->post('employeename')[$key], 'salarymonth' => date('Y-m-d', strtotime($this->input->post('salarymonth')[$key])), 'absent' => $this->input->post('absent')[$key], 'workingday' => $this->input->post('workingday')[$key], 'lateminute' => $this->input->post('lateminute')[$key], 'OverTime' => $this->input->post('overtime')[$key]);
            $result = $this->attendance_model->saveAttendanceresult($data);
        }
        if ($result) {
            $this->message->save_success('admin/payroll/ClearAttendance');
        } else {
            $error = 'Data Not Saved';
            $this->message->custom_error_msg('admin/payroll/ClearAttendance', $error);
        }
    }
    public function holidays($date, $department_id)
    {
        $month = date('n', strtotime($date));
        $year = date('Y', strtotime($date));
        $num = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $data['employees'] = $this->attendance_model->get_employee_id_by_dept_id($department_id);
        $day = date('d', strtotime($date));
        for ($i = 1; $i <= $num; $i++) {
            $data['dateSl'][] = $i;}
        $holidays = $this->db->get_where('working_days', array('flag' => 0))->result();
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
        foreach ($data['employees'] as $sl => $v_employee) {
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
        $count = 0;
        foreach ($data['attendance'] as $key => $v_employee) {
            foreach ($v_employee as $v_result) {
                foreach ($v_result as $emp_attendance) {
                    if ($emp_attendance->attendance_status == 'H') {
                        $count++;
                    }
                }
            }
        }
        $query = $this->db->query("SELECT COUNT(*) AS total FROM    employee WHERE termination NOT IN (0) AND soft_delete NOT IN (1)");
        $results = $query->row();
        $total_holiday = $count / $results->total;
        return $count;
    }
    public function monthWise_absent($employee_id, $month)
    {
        $query = $this->db->query("SELECT COUNT(employee_id) AS absent FROM   `payroll_attendanc_sheet`
                  WHERE attendance_status=0 AND  employee_id='" . $employee_id . "' AND YEAR(DATE) = YEAR('" . $month . "') AND MONTH(DATE) = MONTH('" . $month . "') ");
        $result = $query->row();
        return $result->absent;
    }
    public function MissedOut_attendance($employee_id, $month)
    {
        $attendance_id = $this->attendance_model->Variant_punch($employee_id, $month);
        $ids = array();
        foreach ($attendance_id as $id) {
            $ids[] = $id['attendance_id'];
        }
        $data['all_leave_category_info'] = $this->db->get('leave_application_type')->result();
        $data['attendance'] = $this->attendance_model->Get_Missout_punchs($ids);
        $this->render('payroll/Missout_attendance');
    }
    public function SaveMissedOut_attendance()
    {
        $attendance_status = $this->input->post('attendance', true);
        $leave_category_id = $this->input->post('leave_category_id', true);
        $employee_id = $this->input->post('employee_id', true);
        $attendance_id = $this->input->post('attendance_id', true);
        $in_time = $this->input->post('in', true);
        $out_time = $this->input->post('out', true);
        $allows = $this->input->post('allows', true);
        $key = 0;
        foreach ($attendance_id as $id) {
            $data['leave_category_id'] = $leave_category_id[$key];
            $data['in_time'] = date("H:i:s", strtotime($in_time[$key]));
            $data['out_time'] = date("H:i:s", strtotime($out_time[$key]));
            $data['attendance_status'] = $attendance_status[$key];
            $data['allow'] = $allows[$key];
            $this->db->where('attendance_id', $attendance_id[$key]);
            $this->db->update('tbl_attendance', $data);
            $key++;
        }
        $this->message->save_success('admin/payroll/employee');
    }
    public function tax_S($employee_id)
    {
        $salarys = $this->db->get_where('payroll_salary', array('employee_id' => $employee_id))->row();
        $salarycom = json_decode($salarys->Current_salary_component, true);
        $salaryEarningList = $this->db->get_where('payroll_salary_component', array('Soft_delete' => 0))->result();
        $salary = '';
        foreach ($salaryEarningList as $earning) {
            foreach ($salarycom as $key => $details) {
                if ($earning->id . 's' == $key && $earning->Include_tax && $earning->cost_company == 1) {
                    $salary += $details;
                }
            }
        }
        $YearSalary = $salary * 12;
        $tax = $this->db->query("SELECT * FROM `payroll_tax_slab` WHERE $YearSalary  BETWEEN Start_range AND End_range")->row();
        $data = array('YearSalary' => $YearSalary, 'tax' => $tax);
        return $data;
    }
    public function Official_tax_S($employee_id)
    {
        $salarys = $this->db->get_where('salary', array('employee_id' => $employee_id))->row();
        $salarycom = json_decode($salarys->component, true);
        $salaryEarningList = $this->db->get_where('salary_component', array('Soft_delete' => 0))->result();
        $salary = '';
        foreach ($salaryEarningList as $earning) {
            foreach ($salarycom as $key => $details) {
                if ($earning->id == $key && $earning->Include_tax && $earning->cost_company == 1) {
                    $salary += $details;
                }
            }
        }
        $YearSalary = $salary * 12;
        $tax = $this->db->query("SELECT * FROM `tax_slab` WHERE $YearSalary  BETWEEN Start_range AND End_range")->row();
        $data = array('YearSalary' => $YearSalary, 'tax' => $tax);
        return $data;
    }
    public function currency_load($currency_id)
    {
        $currency = $this->db->get_where('currency_master', array('Soft_delete' => 0, 'id' => $currency_id))->row();
        echo json_encode($currency);
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
                    for ($j = $p_holiday->start_date; $j <= $p_holiday->end_date; $j++) {
                        $dates[] = $j;
                    }
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
    public function Consolidate()
    {
        $data['page_title'] = lang('Consolidate_payroll');
        $data['department'] = $department = $this->db->get('payroll_department')->result();
        $this->render_admin('payroll/payroll/Overall', $data);
    }
    public function Consolidateview()
    {


        $url = $this->input->get('tab');
        $pieces = explode("/", $url);
        $tab = $pieces[0];

        if (!empty($this->input->post('department_id'))) {
            $data['department_id'] = $department = $this->input->post('department_id');
        } else {
            $data['department_id'] = $department = $pieces[3];
        }
        if (!empty($this->input->post('employee_id'))) {
            $data['employee_id'] = $employee = $this->input->post('employee_id');
        } else {
            $data['employee_id'] = $employee = $pieces[1];
        }

        if (!empty($this->input->post('month'))) {
            $data['months'] = $months = $this->input->post('month');
        } else {
            $data['months'] = $months = date('Y-m', strtotime($pieces[2]));
        }
        $data['department'] = $this->db->get('payroll_department')->result();
        $data['employees'] = $empdetails = $this->db->get_where('employee', array('id' => $employee))->row();
        $m = date('n', strtotime($months));
        $y = date('Y', strtotime($months));
        $num = cal_days_in_month(CAL_GREGORIAN, $m, $y);
        $employee_details = $this->db->get_where('employee', array('id' => $employee))->row();
        $missedshift = $this->attendance_model->MOnthShift_check_For_conslidate($months, $employee, $num);
		
        switch ($tab) {
            case 'Setattendance':
                $missedattendances = $this->attendance_model->MOnthAttendance_check_for_consolidate($months, $employee, $num);
                $data['missedAttendance'] = $missedattendances;
                foreach ($missedattendances as $missedattendance) {
                    $where = array('employee_id' => $employee, 'Attendancedate' => $missedattendance['Attendacedate'], 'Soft_delete' => 0);
                    $data['atndnce'][] = $this->attendance_model->check_bys($where, 'payroll_attendanc_sheet');
                }
                $data['all_leave_category_info'] = $this->db->get('payroll_leave_application_type')->result();
                $data['employee_id'] = $employee;
                $this->render_admin('payroll/payroll/Overall', $data);
                break;
            case 'reviewAttendance':
                $lop[] = $this->getlop($employee_details->id_number, $months, $employee);
                $data['lop'] = $lop;
                $this->render_admin('payroll/payroll/Overall', $data);
                break;
            case 'Payment':
                $data['Currency'] = $this->db->get_where('payroll_currency_master', array('Soft_delete' => 0))->result();
                //$data['default_currency_Pro'] = $this->db->get_where('currency_master', array('Soft_delete' => 0))->result();
                $data['page_title'] = lang('SalaryEdit');
                $data['department'] = $this->db->get_where('payroll_department', array('id' => $department))->row();
                //$data['employee'] = $emp_id = $this->db->get_where('employee', array('id' => $employee))->row();
                $data['employee'] =$emp_id= $this->db->select('employee .*, payroll_job_title.job_title, payroll_emp_status.status_name ')
                    ->from('employee')
                    ->join('payroll_job_title', 'payroll_job_title.id = employee.title', 'left')
                    ->join('payroll_emp_status', 'payroll_emp_status.id = employee.employment_status', 'left')
                    ->where('employee.id', $employee)
                    ->get()->row();

                $query = $this->db->query("SELECT Fine_for_late,Total_workingday_pe_mon FROM  employee e
               LEFT JOIN `payroll_category_settings` cs ON cs.id=e.Category_id WHERE e.id=$employee");
                $results = $query->row();
                $data['month'] = $months;
                $data['salary'] = $this->db->get_where('payroll_salary', array('employee_id' => $employee))->row();
                $data['salary'] == true || $this->message->custom_error_msg('admin/payroll/payroll/Consolidate', 'Sorry! This Employee salary has not set yet.');
                $data['award'] = $award = $this->db->get_where('payroll_employee_award', array(
                    'award_month' => $months,
                    'employee_id' => $employee,
                ))->result();
                $data['findeduction'] = $this->db->get_where('payroll_employee_deduction', array(
                    'Deduction_month' => $months,
                    'employee_id' => $employee,
                ))->result();
                $advances = $this->db->get_where('payroll_employee_advance', array(
                    'employee_id' => $employee,
                ))->result();
                if (!empty($advances)): $totalbalanceadvance = 0;foreach ($advances as $advance):
                        if ($advance->BalanceAmount == '0.00') {continue;}
                        $totalbalanceadvance += $advance->BalanceAmount;
                    endforeach;endif;
                $data['payroll'] = $this->db->get_where('payroll_payroll', array(
                    'department_id' => $department, 'employee_id' => $employee,
                    'month' => $months,
                ))->row();
                $data['Advance'] = isset($totalbalanceadvance) ? $totalbalanceadvance : 0;
                $lop = $this->getlop($emp_id->id_number, $months, $employee);
                $data['taxs'] = $this->tax_S($employee);
                $data['total_lateminute'] = $lop['total_latemintue'];
                $data['absent_Based_on_time_sheet'] = $lop["absent_Based_on_time_sheet"];
                $data['OverTime'] = $lop["OverTime"];
             //   $data['Monthwise_absent'] = $this->monthWise_absent($employee, $months . '-01');
                $data['fine_amount'] = $results->Fine_for_late;
                $data['totalworkingdaypermonth'] = $results->Total_workingday_pe_mon;
                $this->render_admin('payroll/payroll/Overall', $data);
                break;
            case 'Payslip':
                $id = $pieces[3];
                $data['Currency'] = $currency=$this->db->get_where('payroll_currency_master', array('Active' => 1))->row();
                $data['round_off'] = $currency->Round_of;
                $data['Currency_code'] = $currency->Currency_code;
                $data['pay_slip'] = $this->db->get_where('payroll_payroll', array('id' => $id))->row();
                $data['employee'] = $employee_details = $this->db->get_where('employee', array('id' => $data['pay_slip']->employee_id))->row();
                if (isset($employee_details->Category_id)) {
                    $Category = $this->db->get_where('payroll_category_settings', array('id' => $employee_details->Category_id))->row();
                    $data['TotalWorkingday'] = isset($Category->Total_workingday_pe_mon) ? $Category->Total_workingday_pe_mon : 30;
                } else {
                    $data['TotalWorkingday'] = 30;
                }
                $data['employee'] = $this->db->select('employee .*, payroll_job_title.job_title, payroll_department.department, ')->from('employee')->join('payroll_job_title', 'payroll_job_title.id = employee.title', 'left')->join('payroll_department', 'payroll_department.id = employee.department', 'left')->where('employee.id', $data['pay_slip']->employee_id)->get()->row();
                $data['empSalary'] = $this->db->get_where('payroll_payroll', array('employee_id' => $data['pay_slip']->employee_id))->row();
                if (!empty($data['empSalary']->component)) {
                    $data['empSalaryDetails'] = json_decode($data['empSalary']->component, true);
                }
                $data['Bonusremark'] = $this->db->get_where('payroll_employee_award', array('award_month' => $data['pay_slip']->month, 'employee_id' => $data['pay_slip']->employee_id))->result();
                $data['Deductionremark'] = $this->db->get_where('payroll_employee_deduction', array('Deduction_month' => $data['pay_slip']->month, 'employee_id' => $data['pay_slip']->employee_id))->result();
                $data['gradeList'] = $this->db->get('payroll_salary_grade')->result();
                $data['salaryEarningList'] = $this->db->get_where('payroll_salary_component', array('type' => 1))->result();
                $data['salaryDeductionList'] = $this->db->get_where('payroll_salary_component', array('type' => 2))->result();
                //net salary(min vali amount and precison calcultion)
                $netsalary = $data['pay_slip']->Payment_amount;
                //split from dollar value
                list($int, $dec) = explode('.', $netsalary);
                $Precision_convert_currency = $this->db->get_where('payroll_currency_master', array('Active' => 1))->row()->Precision_convert_currency;
                $currencylistvalue = $this->db->get_where('payroll_currency_master', array('id' => $Precision_convert_currency))->row();
                $precisionvalue = ('.' . $dec) * $currencylistvalue->Exchange_rate;
                $min_value = $currencylistvalue->Valid_amount;
                $data['precisionvalue'] = $this->Precision_round_off($precisionvalue, $min_value);
                $data['precisionvalue_currency'] = $currencylistvalue->Currency_code;
                $this->render_admin('payroll/payroll/Overall', $data);
                break;
            default:
                $Shiftnames = $this->db->get_where('payroll_work_shift')->result();
                $Shiftnames[] = (object) array('id' => 0, 'shift_name' => 'H');
                $data['shifts'] = $Shiftnames;
                $data['missedshift'] = $missedshift;
                $data['employee_id'] = $employee;
                $data['months'] = $months . '-01';
                $this->render_admin('payroll/payroll/Overall', $data);
                break;
        }
    }
    public function Savereviewattendance()
    {
        $employee_id = $this->input->post('employeeid');
        $department = $this->db->get_where('employee', array('id' => $employee_id))->row();
        $department_id = $department->department;
        $month = $this->input->post('salarymonth');
        $data = array('employee_id' => $employee_id, 'Employeename' => $this->input->post('employeename'), 'salarymonth' => date('Y-m-d', strtotime($this->input->post('salarymonth'))), 'absent' => $this->input->post('absent'), 'workingday' => $this->input->post('workingday'), 'lateminute' => $this->input->post('lateminute'), 'OverTime' => $this->input->post('overtime'));
        $result = $this->attendance_model->saveAttendanceresult($data);
        if ($result) {
            redirect('admin/payroll/payroll/Consolidateview?tab=Payment/' .$employee_id. '/' .$month. '/' . $department_id);
        }
    }
    public function savepayment()
    {
        $employee_id = $this->input->post('empid');
        $month = $this->input->post('month');
        $salary = $this->db->get_where('payroll_salary', array('employee_id' => $employee_id))->row();
        $employess = $this->db->get_where('employee', array('id' => $employee_id))->row();
        $currency = $this->db->get_where('payroll_currency_master', array('id' => $this->input->post('Currency')))->row();
        $salary = array('employee_id' => $employee_id,
            'month' => $month,
            'department_id' => !empty($employess->department) ? $employess->department : 0,
            'gross_salary' => $this->input->post('grosssalary'),
            'net_salary' => $this->input->post('PayAmounts'),
            'award' => $this->input->post('bonus'),
            'payment_method' => $this->input->post('payment_method'),
            'note' => $this->input->post('note'),
            'net_payment' => $this->input->post('PayAmounts'),
            'Lop' => $this->input->post('lops'),
            'Fine_deduction' => $this->input->post('fine_deduction'),
            'Penalty' => $this->input->post('fine_deduction'),
            'Late_minutes' => $this->input->post('Late_Minutes'),
            'Late_fine' => $this->input->post('Late_fine'),
            'Late_amount' => $this->input->post('Late_Amount'),
            'Payment_amount' => $this->input->post('PayAmounts'),
            'Annual_salary' => $this->input->post('annualsalary'),
            'Tax_pecentage' => $this->input->post('tax_percentage'),
            'Annual_tax' => $this->input->post('Annualtax'),
            'Monthly_tax' => $this->input->post('Monthly_tax'),
            'component' => !empty($salary->component) ? $salary->component : 0,
            'currency_id' => $this->input->post('Currency'),
            'Exchange_rate' => !empty($currency->Exchange_rate) ? $currency->Exchange_rate : 0,
            'OverTime' => !empty($this->input->post('OverTime')) ? $this->input->post('OverTime') : 0,
            'Advance_Amount' => !empty($this->input->post('advance')) ? $this->input->post('advance') : 0);
        $this->attendance_model->Advanceadjustment($salary);
        $payslipid = $this->attendance_model->SaveSalary($salary);
        // $payslipid=str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encrypt->encode($payslipid)) ;

        //    $this->employeePaySlip($payslipid);

        redirect('admin/payroll/payroll/Consolidateview?tab=Payslip/' .$employee_id . '/' .$month. '/' .$department_id. '/' .$payslipid);
        //$this->message->save_success('admin/payroll/listSalaryPayment');

    }
}
