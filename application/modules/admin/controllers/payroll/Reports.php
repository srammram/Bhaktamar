<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_builder');
        $this->load->model('global_model');
        $this->load->model('crud_model', 'crud');
        $this->load->model('report_model', 'report');
        $this->load->model('attendance_model');
        $this->load->library('grocery_CRUD');
        $this->mTitle = TITLE;
    }

    function index()
    {
        $this->mTitle .= 'Report';
        $this->render('report/report');
    }
    function paymentReceived()
    {
        $flag = $this->input->post('flag', true);
        if($flag) {
            $start_date = date('d/m/Y', strtotime($this->input->post('start_date', true)));
            $end_date = date('d/m/Y', strtotime($this->input->post('end_date', true)));
            $this->mViewData['start_date'] = $start_date;
            $this->mViewData['end_date'] = $end_date;
            $this->mViewData['invoice'] = $this->report->get_payment_received_by_date($start_date, $end_date);
            if(empty($this->mViewData['invoice'])){
                $this->mViewData['start_date'] ='';
                $this->mViewData['end_date'] = '';
            }

        }
        $this->mTitle .= lang('payment_received');;
        $this->render('report/received_payment_report');
    }

    function employeeAttendance()
    {

        $sbtn = $this->input->post('sbtn', TRUE);
        $this->form_validation->set_rules('from', 'From', 'required');
        $this->form_validation->set_rules('to', 'To', 'required');
        $this->form_validation->set_rules('department_id', lang('department'), 'required');
        $this->form_validation->set_rules('employee_id', lang('employee'), 'required');


        if($sbtn) {


            if ($this->form_validation->run() == TRUE) {

                $employee_id    = $this->input->post('employee_id', TRUE);
                $department_id  = $this->input->post('department_id', TRUE);
                $start    = (new DateTime($this->input->post('from', TRUE)))->modify('first day of this month');
                $end      = (new DateTime( $this->input->post('to', TRUE)))->modify('first day of next month');
                $interval = DateInterval::createFromDateString('1 month');
                $period   = new DatePeriod($start, $interval, $end);

                $this->mViewData['period'] = $period;

                foreach ($period as $dt) {
                    //echo $dt->format("Y-m") . "<br>\n";
                    $date =  $dt->format("Y-m");

                    //==========How many day in a Month================>>>>>>>>>>>>>>
                    $month = date('n', strtotime($date));
                    $year = date('Y', strtotime($date));

                    $num = cal_days_in_month(CAL_GREGORIAN, $month, $year);

                    $this->mViewData['employee'] = $this->db->get_where('employee', array( 'id' => $employee_id))->row();
                    for ($i = 1; $i <= $num; $i++) {
                        $this->mViewData['dateSl'][$dt->format("Y-m")][] = $i;
                    }

                    //==========Grab Holiday and Public Holiday===========>>>>>>>>>>
                    if ($month >= 1 && $month <= 9) {
                        $yymm = $year . '-' . '0' . $month;
                    } else {
                        $yymm = $year . '-' . $month;
                    }

                    $public_holiday = $this->attendance_model->get_public_holidays($yymm);
                    $holidays = $this->db->get_where('working_days', array( 'flag' => 0 ))->result();


                    //============ tbl a_calendar Days Holiday==========>>>>>>>>>>>>
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

                    //============= Employee Attendance Generate ==================>>>>>>>
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
                            $this->mViewData['attendance'][$dt->format("Y-m")][] = $this->attendance_model->attendance_report_by_empid($employee_id, $sdate, $flag);
                        } else {
                            $this->mViewData['attendance'][$dt->format("Y-m")][] = $this->attendance_model->attendance_report_by_empid($employee_id, $sdate);
                        }

                        $key++;
                        $flag = '';
                    }

                }



                $this->mViewData['from'] = $this->input->post('from', TRUE);
                $this->mViewData['to'] = $this->input->post('to', TRUE);
                $where = array('id' => $department_id);
                $this->mViewData['dept_name'] = $this->attendance_model->check_by($where, 'department');

                $this->mViewData['month'] = date('F-Y', strtotime($yymm));


            } else {
                $error = validation_errors();;
                $this->message->custom_error_msg('admin/reports/employeeAttendance', $error);
            }

        }
        $this->mViewData['all_department'] = $this->db->get('department')->result();
        $this->mViewData['department_id'] = $this->input->post('department_id', TRUE);
        $this->mTitle .= lang('attendance_report');
        $this->render('report/attendance_report');
    }

    function employeeList()
    {
        $flag = $this->input->post('flag', true);

        if($flag) {
            $this->mViewData['employees'] = $this->db->get_where('employee', array( 'department' => $this->input->post('department_id', true)))->result();
        }
        $this->mViewData['all_department'] = $this->db->get('department')->result();
        $this->mTitle .= lang('employee_list');
        $this->render('report/employee_list');
    }

    function payrollList()
    {
		if($this->ion_auth->in_group('admin'))
        {
        $flag = $this->input->post('flag', true);
        $this->form_validation->set_rules('from', 'From', 'required');
        $this->form_validation->set_rules('to', 'To', 'required');
        $this->form_validation->set_rules('department_id', lang('department'), 'required');
        $this->form_validation->set_rules('employee_id', lang('employee'), 'required');

        if($flag) {
            if ($this->form_validation->run() == TRUE) {
                $from = $this->input->post('from', TRUE);
                $to = $this->input->post('to', TRUE);
                $employee_id = $this->input->post('employee_id', TRUE);

                $this->mViewData['payroll'] = $this->db->get_where('payroll', array(
                            'month >=' => $from,
                            'month <=' => $to,
                            'employee_id <=' => $employee_id,
                            ))->result();

                $this->mViewData['employee'] = $this->db->get_where('employee', array( 'id' => $employee_id))->row();

            }else {
                $error = validation_errors();;
                $this->message->custom_error_msg('admin/reports/payrollList', $error);
            }
        }
        $this->mViewData['all_department'] = $this->db->get('department')->result();
        $this->mViewData['department_id'] = $this->input->post('department_id', TRUE);
        $this->mTitle .= lang('payroll');
        $this->render('report/payroll_list');
        }
          else
           {
        $flag = $this->input->post('flag', true);
        $this->form_validation->set_rules('from', 'From', 'required');
        $this->form_validation->set_rules('to', 'To', 'required');
        $this->form_validation->set_rules('department_id', lang('department'), 'required');
        $this->form_validation->set_rules('employee_id', lang('employee'), 'required');
        if($flag) {
            if ($this->form_validation->run() == TRUE) {
                $from = $this->input->post('from', TRUE);
                $to = $this->input->post('to', TRUE);
                $employee_id = $this->input->post('employee_id', TRUE);

                $this->mViewData['payroll'] = $this->db->get_where('official_payroll', array(
                            'month >=' => $from,
                            'month <=' => $to,
                            'employee_id <=' => $employee_id,
                            ))->result();

                $this->mViewData['employee'] = $this->db->get_where('employee', array( 'id' => $employee_id))->row();

            }else {
                $error = validation_errors();;
                $this->message->custom_error_msg('admin/reports/payrollList1', $error);
            }
        }
         		$this->mViewData['all_department'] = $this->db->get('department')->result();
				$this->mViewData['department_id'] = $this->input->post('department_id', TRUE);
				$this->mTitle .= lang('payroll');
				$this->render('report/payroll_list');
           }
       
    }
   function  punchMonitoring()
   {
	   $flag = $this->input->post('flag', true);
        if($flag) {
			$date=$this->input->post('dates', true);
			$department=$this->input->post('department_id', true);
			$employee_ids= $this->db->select('id')
			->from('employee')
			->where('termination',1)
			->where('soft_delete',0)
			  ->get()
                ->result();
	         $datas=[];
		     foreach($employee_ids as $ids)
		      {
                   $query=$this->db->query("SELECT * FROM  (SELECT e.id ,e.employee_id AS employee,first_name,d.department,Punch_variant_for_attendance('".$ids->id."','".$date."') as variant,Punch_variant_for_attendance_intime('".$ids->id."','".$date."') variant_in FROM  employee e
					LEFT  JOIN department d  ON d.id=e.department
					WHERE e.id='".$ids->id."')tt
					LEFT JOIN(SELECT ta.employee_id, ta.in_time,out_time,ta.date,ta.Punch_times,  CASE WHEN attendance_status=3 AND leave_category_id !=0 
                     THEN 'Leave'
                         WHEN attendance_status=0 OR attendance_status IS NULL
                         THEN 'Absent'
                     WHEN attendance_status=1 
                     THEN 'Present'
                       END AS STATUS FROM tbl_attendance ta
					WHERE ta.employee_id='".$ids->id."' AND ta.DATE='".$date."')t
					ON tt.id=t.employee_id");
	              $datas[]=$query->row();
		     }
		 $this->mViewData['attendanceData']=$datas;
		 $this->mViewData['Date']=$date;
		 $this->mViewData['Department']=$department;
        }
        $this->mViewData['all_department'] = $this->db->get('department')->result();
        $this->mTitle .= lang('Punch_Monitoring');
        $this->render('report/PunchMonitoring');
    }
	   
   function  MissedOut_Punch_Report()
   {
	    $flag = $this->input->post('flag', true);
          if($flag) {
			$date=$this->input->post('dates', true);
			$department=$this->input->post('department_id', true);
			$employee_ids= $this->db->select('id')
			->from('employee')
			->where('termination',1)
			->where('soft_delete',0)
			  ->get()
                ->result();
		   $datas=[];
		  foreach($employee_ids as $ids)
		  {
             $query=$this->db->query("SELECT * FROM  (SELECT e.id ,e.employee_id AS employee,first_name,d.department FROM  employee e
			LEFT  JOIN department d  ON d.id=e.department
			WHERE e.id='".$ids->id."')tt
		    LEFT JOIN
		   (SELECT ta.employee_id, ta.in_time,out_time,ta.date,ta.Punch_times, CASE WHEN attendance_status IS NULL THEN 'Absent' ELSE 'Present' END AS STATUS FROM tbl_attendance ta
		    WHERE ta.employee_id='".$ids->id."' AND ta.DATE='".$date."')t
			ON tt.id=t.employee_id");
		    $datas[]=$query->row();
		  }
		   $this->mViewData['attendanceData']=$datas;
        }
           $this->mViewData['all_department'] = $this->db->get('department')->result();
           $this->mTitle .= lang('Missed_out_punching');
           $this->render('report/MissedOut_Punching');
   }
    function  shift_roster_report()
	{
        	$sbtn = $this->input->post('sbtn', TRUE);
        	$this->form_validation->set_rules('date', lang('date'), 'required');
        	$this->form_validation->set_rules('department_id', lang('department'), 'required');
        	if($sbtn) {
        		if ($this->form_validation->run() == TRUE) {
        			$department_id = $this->input->post('department_id', TRUE);
        			$date = $this->input->post('date', TRUE);
        			$month = date('n', strtotime($date));
        			$year = date('Y', strtotime($date));
        			$num = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        			$this->mViewData['employee'] = $this->attendance_model->get_employee_id_by_dept_id($department_id);
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
        						$this->mViewData['attendance'][$sl][] = $this->attendance_model->Shift_data_by_empid($v_employee->id, $sdate, 
        							$flag);
        					} else {
        						$this->mViewData['attendance'][$sl][] = $this->attendance_model->Shift_data_by_empid($v_employee->id, $sdate);
        					}
        					$key++;
        					$flag = '';
        				}
        			}
        			$this->mViewData['ShiftType']=$this->db->get_where('work_shift', array('Soft_delete' => 0 ))->result();
        			$this->mViewData['date'] = $this->input->post('date', TRUE);
        			$this->mViewData['department_id']=$this->input->post('department_id', TRUE);
        			$where = array('id' => $department_id);
        			$this->mViewData['dept_name'] = $this->attendance_model->check_by($where, 'department');
        			$this->mViewData['month'] = date('F-Y', strtotime($yymm));
        		} else {
        			$error = validation_errors();;
        			$this->message->custom_error_msg('admin/reports/shift_roster_report', $error);
        		}
        		$this->mViewData['department_id'] = $department_id;
        	}
        	$this->mViewData['all_department'] = $this->db->get('department')->result();
        	$this->mTitle .= lang('Shift_roster');
            $this->render('report/Shift_roster');
	}
  public function Logs()
  {
	 $this->mViewData['logs']=$this->db->query("SELECT  l.id  ,STATUS,  message,user_id,created_at,Table_name,Table_row_id ,username FROM LOGS l
     LEFT JOIN admin_users au ON au.id=l.user_id
     ORDER BY id DESC")->result();
	  $this->render('report/Logs');
	  
  }
   function  PunchVariant_Report()
	{
        	$sbtn = $this->input->post('sbtn', TRUE);
        	$this->form_validation->set_rules('date', lang('date'), 'required');
        	$this->form_validation->set_rules('department_id', lang('department'), 'required');
        	if($sbtn) {
        		if ($this->form_validation->run() == TRUE) {
        			$department_id = $this->input->post('department_id', TRUE);
        			$date = $this->input->post('date', TRUE);
        			$month = date('n', strtotime($date));
        			$year = date('Y', strtotime($date));
        			$num = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        			$this->mViewData['employee'] = $this->attendance_model->get_employee_id_by_dept_id($department_id);
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
        						$this->mViewData['attendance'][$sl][] = $this->attendance_model->Shift_data_by_empid($v_employee->id, $sdate, 
        							$flag);
        					} else {
        						$this->mViewData['attendance'][$sl][] = $this->attendance_model->Shift_data_by_empid($v_employee->id, $sdate);
        					}
        					$key++;
        					$flag = '';
        				}
        			}
        			$this->mViewData['ShiftType']=$this->db->get_where('work_shift', array('Soft_delete' => 0 ))->result();
        			$this->mViewData['date'] = $this->input->post('date', TRUE);
        			$this->mViewData['department_id']=$this->input->post('department_id', TRUE);
        			$where = array('id' => $department_id);
        			$this->mViewData['dept_name'] = $this->attendance_model->check_by($where, 'department');
        			$this->mViewData['month'] = date('F-Y', strtotime($yymm));
        		} else {
        			$error = validation_errors();;
        			$this->message->custom_error_msg('admin/reports/PunchVariant_Report', $error);
        		}
        		$this->mViewData['department_id'] = $department_id;
        	}
        	$this->mViewData['all_department'] = $this->db->get('department')->result();
        	$this->mTitle .= lang('Shift_roster');
            $this->render('report/PunchVariant_report');
	}

	function PunchMonitor(){
            $flag = $this->input->post('flag', true);
           if($flag) {
			$date=$this->input->post('dates', true);
			$department=$this->input->post('department_id', true);
                  $this->db->select(" EmployeeName,  Attendancedate  ,attendanc_sheet.Shift_name , attendanc_sheet.Shift_id , Onduty_time,  Offduty_time,  Clock_in , Clock_out,Absent,Working_time,department.Department ");
				  $this->db->from('attendanc_sheet');
				  $this->db->join('employee','employee.id=attendanc_sheet.Employee_id','left');
				  $this->db->join('department','department.id=employee.department','left');
				  $this->db->join('shift_rosters','shift_rosters.Employee_id=attendanc_sheet.Employee_id and shift_rosters.Shift_Date=attendanc_sheet.Attendancedate','left');
				  $this->db->where(array('Attendancedate'=>$date,'employee.department'=>$department));
				  $this->db->group_by('attendanc_sheet.Employee_id,attendanc_sheet.Shift_id'); 
				  $query=$this->db->get();
		 $this->mViewData['attendanceData']=$query->result();
		 $this->mViewData['Date']=$date;
		 $this->mViewData['Department']=$department;
        }
        $this->mViewData['all_department'] = $this->db->get('department')->result();
        $this->mTitle .= lang('Punch_Monitoring');
        $this->render('report/PunchMonitoring');
	}
	function leaveReport(){
          $flag = $this->input->post('flag', true);
           if($flag) {
			$Fromdate=$this->input->post('from', true);
			$Todate=$this->input->post('to', true);
			$department=$this->input->post('department_id', true);
			    $this->db->select("start_date,  end_date  ,reason , STATUS,   application_date,  leave_category ,first_name  last_name ,department.department");
				  $this->db->from('leave_application');
				  $this->db->join('employee','employee.id=leave_application.employee_id','left');
				  $this->db->join('department','department.id=employee.department','left');
				  $this->db->join('leave_application_type','leave_application_type.id=leave_application.leave_ctegory_id','left');
				  $this->db->where('employee.department',$department);
				  $this->db->where('start_date >=', $Fromdate);
                  $this->db->where('end_date <=',$Todate);
				  $query=$this->db->get();
	     $this->mViewData['leavedata']=$query->result();
		 $this->mViewData['department']=$department;
        }
       
    	$this->mViewData['department']=$this->db->get('department')->result();
        $this->mTitle .= lang('Punch_Monitoring');
        $this->render('report/leaverequestreport');

	}
    public function Monthroster(){
		    $sbtn = $this->input->post('sbtn', TRUE);
        	if($sbtn) {
				$this->form_validation->set_rules('date', lang('date'), 'required');
        		if ($this->form_validation->run() == TRUE) {
        		//	$department_id = $this->input->post('department_id', TRUE);
        			$date = $this->input->post('date', TRUE);
        		 	$month = date('n', strtotime($date));
        			$year = date('Y', strtotime($date));
        			$num =cal_days_in_month(CAL_GREGORIAN,$month,$year);
					
        			$this->mViewData['employee'] =$employee= $this->attendance_model->Get_roster_employee($date);
				
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
						
							
        					/* if (!empty($flag)) {
        	        $this->mViewData['attendance'][$sl][] = $this->attendance_model->roster_data_by_empid($v_employee->id,$sdate, $flag);
				//	print_r( $this->attendance_model->Shift_data_by_empid($v_employee->id,$sdate, $flag));
				
        					} else { */
						
        	        $this->mViewData['attendance'][$sl][] = $this->attendance_model->roster_data_by_empid($v_employee->id,$sdate);
					
        					/* } */
        					$key++;
        					$flag = '';
        				}
        			}
        			$this->mViewData['ShiftType']=$this->db->get_where('work_shift', array('Soft_delete' => 0 ))->result();
        			$this->mViewData['date'] = $this->input->post('date', TRUE);
        			
        			$this->mViewData['month'] = date('F-Y', strtotime($yymm));
        		} else {
        			$error = validation_errors();;
        			$this->message->custom_error_msg('admin/reports/Monthroster', $error);
        		}
        		
        	}
        	$this->mViewData['all_department'] = $this->db->get('department')->result();
        	$this->mTitle .= lang('MonthRoster');
       	    $this->render('report/Month_Roster');
		
		
		
	}

}