<?php

class Attendance_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function check_by($where, $tbl_name)
    {
        $this->db->select('*');
        $this->db->from($tbl_name);
        $this->db->where($where);
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;
    }
    public function check_bys($where, $tbl_name)
    {
        $this->db->select('*');
        $this->db->from($tbl_name);
        $this->db->where($where);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
    public function Getshift($date, $employee)
    {
        $where = array('employee_id' => $employee, 'Shift_Date' => $date);
        $this->db->select(' employee_id,department_id,shift_form,shift_to');
        $this->db->from('shift_rosters');
        $this->db->join('work_shift', 'work_shift.id = shift_rosters.Shift_id');
        $this->db->where($where);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;

    }
    public function get_employee_id_by_dept_id($department_id)
    {
        $this->db->select('employee.*', false);
        $this->db->select('job_title.job_title', false);
        $this->db->select('department.department', false);
        $this->db->from('employee');
        $this->db->join('job_title', 'job_title.id = employee.title', 'left');
        $this->db->join('department', 'department.id = employee.department', 'left');
        $this->db->where('employee.department', $department_id);
        $this->db->where('employee.termination', 1);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function get_public_holidays($yymm)
    {
        $this->db->select('holidays.*', false);
        $this->db->from('holidays');
        $this->db->like('start_date', $yymm);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
    public function get_public_holidaysForDate($Date)
    {
        $this->db->select('holidays.*', false);
        $this->db->from('holidays');
        $this->db->where('start_date', $Date);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
    public function attendance_report_by_empid($employee_id = null, $sdate = null, $flag = null)
    {
        $this->db->select('tbl_attendance.date,tbl_attendance.attendance_status', false);
        $this->db->select('employee.first_name, employee.last_name ', false);
        $this->db->from('tbl_attendance');
        $this->db->join('employee', 'tbl_attendance.employee_id  = employee.id', 'left');
        $this->db->where_in('tbl_attendance.employee_id', $employee_id);
        $this->db->where('tbl_attendance.date', $sdate);
        $query_result = $this->db->get();
        $result = $query_result->result();
        if (empty($result)) {
            $val['attendance_status'] = $flag;
            $val['date'] = $sdate;
            $result[] = (object) $val;
        } else {
            if ($result[0]->attendance_status == 0) {
                if ($flag == 'H') {
                    $result[0]->attendance_status = 'H';
                }
            }
        }
        return $result;
    }
    public function Variant_punch($employee_id, $month)
    {
        $sql = "SELECT * FROM (SELECT   attendance_id  ,attendance_status    , IFNULL(in_time,'00:00:00') AS in_time     ,IFNULL(out_time,'00:00:00') AS out_time      ,
IFNULL(shift_form,'00:00:00') AS shift_form  ,IFNULL(shift_to,'00:00:00') AS shift_to   ,
employee_id , Shift_Date,Punch_variant_time FROM
(SELECT e.id,attendance_status,attendance_id,allow,CASE WHEN '00:00:00'=TIMEDIFF(out_time,in_time) THEN TIMEDIFF(out_time,in_time)
WHEN '00:00:00'!=TIMEDIFF(out_time,in_time) THEN
TIME_FORMAT(TIMEDIFF(out_time,in_time),'%h:%i')  END AS times ,DATE,in_time,out_time,SEC_TO_TIME(Punch_variant_time *60) AS Punch_variant_time
FROM employee e
LEFT JOIN tbl_attendance ta ON ta.employee_id=e.id
LEFT JOIN    category_settings cs    ON  cs.id =e.Category_id
WHERE  e.id=$employee_id AND YEAR(ta.date) = YEAR('" . $month . "') AND MONTH(ta.date) = MONTH('" . $month . "') AND allow=0
AND Punch_variant_time !=0
ORDER BY DATE ASC)tt
LEFT JOIN (SELECT STR_TO_DATE(shift_form, '%l:%i %p' ) AS shift_form  ,STR_TO_DATE(shift_to, '%l:%i %p' ) AS shift_to ,employee_id,Shift_Date FROM  `shift_rosters` sr
LEFT JOIN  `work_shift`   ws ON   sr.Shift_id=ws.id) ts
ON tt.id=ts.employee_id AND ts.Shift_Date=tt.date
WHERE  in_time>ADDTIME(shift_form,Punch_variant_time) OR out_time<SUBTIME(shift_to,Punch_variant_time)
ORDER BY DATE ASC)ss
WHERE attendance_status NOT IN (3,0)
";
        $query = $this->db->query($sql);
        return $query->result_array();

    }
    public function Get_Missout_punchs($attendance_id)
    {
        $ids = join(', ', $attendance_id);
        $sql = "SELECT e.id,jt.id AS department_id,attendance_id,e.employee_id,attendance_status,DATE,in_time,out_time,allow ,first_name ,job_title,leave_category_id FROM    `tbl_attendance` ta
      LEFT JOIN employee e ON e.id=ta.employee_id
      LEFT JOIN job_title jt ON jt.id=e.department
      WHERE attendance_id  IN($ids) and attendance_status NOT IN(0,3)";
        $query = $this->db->query($sql);
        return $query->result();
    }
    public function MOnthShift_check($date, $employees, $num)
    {
        $data = array();
        foreach ($employees as $employee) {
            for ($i = 1; $i <= $num; $i++) {
                $shiftdate = $date . '-' . $i;
                $is_holiday = $this->Get_holidays($shiftdate);
                if (empty($is_holiday)) {
                    $shift = $this->db->get_where('shift_rosters', array('Soft_delete' => 0, 'employee_id' => $employee->id, 'Shift_Date' => $shiftdate))->result();
                    if (empty($shift)) {
                        $data[] = array('shiftdate' => $shiftdate, 'employeename' => $employee->first_name . '-' . $employee->last_name, 'Shift_status' => 'Not Assigned');
                    }
                }
            }
        }
        return $data;
    }
    public function MOnthAttendance_check($date, $employees, $num)
    {

        $data = array();
        foreach ($employees as $employee) {
            $employee_id = $this->db->get_where('employee', array('id' => $employee->id))->row();
            $category_id = $employee_id->Category_id;
            $Empcatgory = $this->db->get_where('category_settings', array('id' => $category_id))->row();
            $Punch_variant_active = isset($Empcatgory->Punch_variant_active) ? $Empcatgory->Punch_variant_active : 0;
            $Punch_variant_time = isset($Empcatgory->Punch_variant_time) ? $Empcatgory->Punch_variant_time : 0;
            for ($i = 1; $i <= $num; $i++) {
                $shiftdate = $date . '-' . $i;
                $is_holiday = $this->Get_holidays($shiftdate);
                if (empty($is_holiday)) {
                    $shifts = $this->db->query("SELECT * FROM shift_rosters sr
				LEFT JOIN  work_shift ws  ON ws.id=sr.Shift_id
				WHERE sr.Soft_delete=0 AND sr.employee_id='" . $employee->id . "' AND sr.Shift_Date='" . $shiftdate . "' ")->result();
                    if (count($shifts) === 0) {
                        $data[] = array('Attendacedate' => $shiftdate,
                            'employeename' => $employee->first_name . '-' . $employee->last_name,
                            'Shift_status' => 'No Record found', 'ShiftName' => '');
                    } else {
                        foreach ($shifts as $shift) {
                            if ($shift->Shift_id != 0) {
                                $attendances = $this->db->get_where('attendanc_sheet', array('Soft_delete' => 0, 'employee_id' => $employee->id,
                                    'Attendancedate' => $shift->Shift_Date,
                                    'Shift_id' => $shift->Shift_id))->result();
                                if (!empty($attendances)) {
                                    foreach ($attendances as $attendance) {
                                        list($hours, $minutes, $sec) = explode(":", $attendance->Late);
                                        $latetime = $hours * 60 + $minutes;
                                        $attendance->Late;
                                        list($hours, $minutes, $sec) = explode(":", $attendance->Early);
                                        $Earlyime = $hours * 60 + $minutes;
                                        if ($Punch_variant_active == 1 && $attendance->Absent != 'true') {
                                            if ($Earlyime >= $Punch_variant_time || $latetime >= $Punch_variant_time) {
                                                $data[] = array('Attendacedate' => $shiftdate, 'employeename' => $employee->first_name . '-' . $employee->last_name, 'Attendance_status' => 'No Record found', 'ShiftName' => $shift->shift_name);
                                            }
                                        }
                                    }
                                } else {
                                    $data[] = array('Attendacedate' => $shiftdate, 'employeename' => $employee->first_name . '-' . $employee->last_name, 'Attendance_status' => 'No Record found', 'ShiftName' => $shift->shift_name);
                                }
                            }
                        }
                    }
                }
            }
        }
        return $data;
    }

    public function Shift_data_by_empid($employee_id = null, $sdate = null, $flag = null)
    {
        $this->db->select('shift_rosters.Shift_id', false);
        $this->db->from('shift_rosters');
        $this->db->join('employee', 'shift_rosters.employee_id  = employee.id', 'left');
        $this->db->where_in('shift_rosters.employee_id', $employee_id);
        $this->db->where('shift_rosters.Shift_Date', $sdate);
        $query_result = $this->db->get();
        $result = $query_result->result();
        if (empty($result)) {
            $val['Shift_id'] = $flag;
            $val['Shift_Date'] = $sdate;
            $result[] = (object) $val;
        } else {
            if ($result[0]->Shift_id == 0) {
                if ($flag == 'H') {
                    $result[0]->Shift_id = 'H';
                }
            }
        }
        return $result;
    }
    public function get_employee_id_by_dept_id_search($department_id, $employee_id)
    {
        $query_result = $this->db->query("select * from employee where soft_delete=0 and termination=1 and department=$department_id and   case when $employee_id !=0 then  id=$employee_id  else id=id  end ");
        $result = $query_result->result();
        return $result;
    }
    public function saveAttendanceresult($data)
    {
        $update = $this->db->query("SELECT * FROM payroll_attendance_data WHERE soft_delete=0 AND employee_id='" . $data['employee_id'] . "' and  YEAR(salarymonth) = YEAR('" . $data['salarymonth'] . "') AND MONTH(salarymonth) = MONTH('" . $data['salarymonth'] . "')")->row();
        if (count($update) === 0) {
            $insert = $this->db->insert('payroll_attendance_data', $data);
            return true;
        } else {
            $this->db->where('id', $update->id);
            $this->db->update('payroll_attendance_data', $data);
            return true;
        }

    }
    public function checksalary($employees)
    {
        $data = array();
        foreach ($employees as $employee) {
            $salaryconfig = $this->db->get_where('salary', array('Soft_delete' => 0, 'employee_id' => $employee->id))->result();
            if (count($salaryconfig) === 0) {
                $data[] = array('employeename' => $employee->first_name . '-' . $employee->last_name, 'status' => 'Not Salary For' . $employee->first_name . '-' . $employee->last_name);
            }
        }

        return $data;
    }

    public function saveCurrentSalaryresult($data)
    {
        $update = $this->db->query("SELECT * FROM payroll WHERE soft_delete=0 AND employee_id='" . $data['employee_id'] . "' and  month='" . $data['month'] . "' ")->row();
        if (empty($update)) {
            $insert = $this->db->insert('payroll', $data);
            return true;
        } else {
            $this->db->where('id', $update->id);
            $this->db->update('payroll', $data);
            return true;

        }
    }
    public function saveOfficialSalaryresult($data)
    {
        $update = $this->db->query("SELECT * FROM official_payroll WHERE soft_delete=0 AND employee_id='" . $data['employee_id'] . "' and month='" . $data['month'] . "'")->row();
        if (count($update) === 0) {
            $insert = $this->db->insert('official_payroll', $data);
            return true;
        } else {
            $this->db->where('id', $update->id);
            $this->db->update('official_payroll', $data);
            return true;

        }
    }
    public function getemployeewisecategory($employeeid)
    {
        $this->db->select('employee.id,first_name,  OverTime, Fine_active, last_name,GraceTime_For_late_coming,Total_workingday_pe_mon ,GraceTime_for,GarceTime_for_Early_going ,Cal_ab_if_work_dur_less_than ,Absent_late_for_day  ,After_grace_minute,
    Mark_absent_late_by ,Absent_when_late_for ,Duration_less_than_min, Mark_absent_early_go  ,Absent_when_early_go');
        $this->db->from('employee');
        $this->db->where('employee.id', $employeeid);
        $this->db->join('payroll_category_settings', 'payroll_category_settings.id = employee.Category_id', 'left');
        $query = $this->db->get();
        if ($query !== false && $query->num_rows() > 0) {
            return $data = $query->row();
        }
        return false;
    }
    public function getshiftdate($employee, $month, $fromdate, $todate)
    {
        $fromdate = $month . '-' . $fromdate;
        $todate = $month . '-' . $todate;
        $this->db->select('employee_id,Shift_id,Shift_Date,shift_form,shift_to');
        $this->db->from('payroll_shift_rosters');
        $this->db->where('Shift_Date >=', $fromdate);
        $this->db->where('Shift_Date <=', $todate);
        $this->db->where('employee_id ', $employee);
        //$this->db->where('Shift_id !=',0);
        $this->db->join('payroll_work_shift', 'payroll_work_shift.id = payroll_shift_rosters.Shift_id', 'left');
        $query = $this->db->get();
        if ($query !== false && $query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    public function GetAttendanceEmployee($month, $department)
    {
        $where = array('joined_date <=' => $month, 'department' => $department, 'termination' => 1, 'soft_delete' => 0);
        $this->db->select('*');
        $this->db->from('employee');
        $this->db->where($where);
        $query = $this->db->get();
        if ($query !== false && $query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
    public function GetshiftDateForattendance($employee, $month)
    {
        $shift = $this->db->query("SELECT Shift_id FROM `shift_rosters` sr
    WHERE employee_id=$employee  AND YEAR(Shift_Date) = YEAR('" . $month . '-01' . "') AND MONTH(Shift_Date) = MONTH('" . $month . '-01' . "')  and sr.Soft_delete=0 and Shift_id!=0 GROUP BY Shift_id")->result();
        if ($query !== false && $query->num_rows() > 0) {
            return $shift;
        }
        return false;
    }

    public function SaveSalary($salary)
    {
        $payroll = $this->db->get_where('payroll_payroll', array('employee_id' => $salary['employee_id'], 'MONTH' => $salary['month']))->row();
        if (empty($payroll)) {
            $insert = $this->db->insert('payroll_payroll', $salary);
            return $this->db->insert_id();
        } else {
            $this->db->where('id', $payroll->id);
            $this->db->update('payroll_payroll', $salary);
            return $payroll->id;

        }
        return false;
    }
    public function Advanceadjustment($salary)
    {
        //echo $paid.'||'.$advance->BalanceAmount.'||'.$advance->id.'<br>';
        $advancesdetails = $this->db->get_where('payroll_advanceamount_details',
            array('employee_id' => $salary['employee_id'],
                'Month' => $salary['month']))->result();
        $paid = $salary['Advance_Amount'];
        if (!empty($advancesdetails)) {
            {
                foreach ($advancesdetails as $item) {
                    $advanceamounts = $this->db->get_where('payroll_employee_advance', array('id' => $item->Emp_advance_id))->row();
                    $updateamount = isset($advanceamounts->BalanceAmount) ? $advanceamounts->BalanceAmount : 0;
                    $updateamount += $item->amount;
                    $this->db->where('id', $item->Emp_advance_id);
                    $this->db->update('payroll_employee_advance', array('BalanceAmount' => $updateamount, 'IS_PAID' => 0));
                    $this->db->where('id', $item->id);
                    $this->db->delete('payroll_advanceamount_details');

                }
                $advances = $this->db->get_where('payroll_employee_advance',
                    array('employee_id' => $salary['employee_id'],
                        'IS_PAID' => 0))->result();
                foreach ($advances as $advance) {
                    if ($paid > $advance->BalanceAmount) {
                        $paid -= $advance->BalanceAmount;
                        $this->db->where('id', $advance->id);
                        $this->db->update('payroll_employee_advance', array('BalanceAmount' => 0, 'IS_PAID' => 1));
                        $this->db->insert('payroll_advanceamount_details', array('employee_id' => $salary['employee_id'], 'Emp_advance_id' => $advance->id, 'Month' => $salary['month'], 'amount' => $advance->BalanceAmount));

                    } else {
                        if ($paid != 0 && $paid > 0) {
                            $paidamount = $advance->BalanceAmount - $paid;
                            $advance->id;
                            $this->db->where('id', $advance->id);
                            $this->db->update('payroll_employee_advance', array('BalanceAmount' => $paidamount));
                            $this->db->insert('payroll_advanceamount_details', array('employee_id' => $salary['employee_id'], 'Emp_advance_id' => $advance->id, 'Month' => $salary['month'], 'amount' => $paid));
                            break;
                        }
                    }
                }
            }

        } else {
            $advances = $this->db->get_where('payroll_employee_advance',
                array('employee_id' => $salary['employee_id'],
                    'IS_PAID' => 0))->result();
            foreach ($advances as $advance) {
                if ($paid > $advance->BalanceAmount) {
                    $paid -= $advance->BalanceAmount;
                    $this->db->where('id', $advance->id);
                    $this->db->update('payroll_employee_advance', array('BalanceAmount' => 0, 'IS_PAID' => 1));
                    $this->db->insert('payroll_advanceamount_details', array('employee_id' => $salary['employee_id'], 'Emp_advance_id' => $advance->id, 'Month' => $salary['month'], 'amount' => $advance->BalanceAmount));

                } else {
                    if ($paid != 0 && $paid > 0) {
                        $paidamount = $advance->BalanceAmount - $paid;
                        $advance->id;
                        $this->db->where('id', $advance->id);
                        $this->db->update('payroll_employee_advance', array('BalanceAmount' => $paidamount));
                        $this->db->insert('payroll_advanceamount_details', array('employee_id' => $salary['employee_id'], 'Emp_advance_id' => $advance->id, 'Month' => $salary['month'], 'amount' => $paid));
                        break;
                    }
                }
            }
        }

        return true;
    }

    public function SaveOfficialSalary($salary)
    {
        $payroll = $this->db->get_where('official_payroll', array('employee_id' => $salary['employee_id'], 'MONTH' => $salary['month']))->row();
        if (empty($payroll)) {
            $insert = $this->db->insert('official_payroll', $salary);
            return true;
        } else {
            $this->db->where('id', $payroll->id);
            $this->db->update('official_payroll', $salary);
            return true;

        }
        return false;
    }

    public function Get_holidays($date)
    {

        $holidays = $this->db->get_where('working_days', array('flag' => 0))->result();
        $public_holiday = $this->get_public_holidaysForDate($date);
        if (!empty($public_holiday)) {
            foreach ($public_holiday as $p_holiday) {
                if ($p_holiday->start_date == $date && $p_holiday->end_date == $date) {
                    $dates[] = $date;
                }
                if ($p_holiday->start_date == $date) {
                   /*  for ($j = $p_holiday->start_date; $j <= $p_holiday->end_date; $j++) {
                        $dates[] = $j;
						die;
                    } */
					 $dates[]=$date;
					
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
    public function MOnthShift_check_For_conslidate($date, $employee, $num)
    {

        $data = array();
        for ($i = 1; $i <= $num; $i++) {
            $this->db->save_queries = false;
            $shiftdate = $date . '-' . $i;
            $is_holiday = $this->Get_holidays($shiftdate);

            if (empty($is_holiday)) {
                $shift = $this->db->get_where('payroll_shift_rosters', array('Soft_delete' => 0, 'employee_id' => $employee, 'Shift_Date' => $shiftdate))->result();
                if (empty($shift)) {
                    $data[] = array('shiftdate' => $shiftdate, 'Shift_status' => 'Not Assigned');
                }
            }

        }

        return $data;
    }
/*   public function MOnthAttendance_check_for_consolidate($date,$employee,$num){
$data=array();
$employee_id=$this->db->get_where('employee',array('id'=>$employee))->row();
$category_id=$employee_id->Category_id;
$Empcatgory=$this->db->get_where('category_settings',array('id'=>$category_id))->row();
$Punch_variant_active=isset($Empcatgory->Punch_variant_active)? $Empcatgory->Punch_variant_active : 0 ;
$Punch_variant_time=isset($Empcatgory->Punch_variant_time)? $Empcatgory->Punch_variant_time : 0;
for($i=1;$i<=$num;$i++){
$shiftdate=$date.'-'.$i;
$is_holiday=$this->Get_holidays($shiftdate);
if(empty($is_holiday)){
$shifts=$this->db->query("SELECT * FROM shift_rosters sr
LEFT JOIN  work_shift ws  ON ws.id=sr.Shift_id
WHERE sr.Soft_delete=0 AND sr.employee_id='".$employee."' AND sr.Shift_Date='".$shiftdate."' ")->result();
if(count($shifts)===0){
$data[]=array('Attendacedate'=>$shiftdate,

'Shift_status'=>'No Record found','ShiftName'=>'');
}else{
foreach($shifts as $shift){
if($shift->Shift_id !=0){
$attendances=$this->db->get_where('attendanc_sheet',array('Soft_delete'=>0,'employee_id'=>$employee,
'Attendancedate'=>$shift->Shift_Date,
'Shift_id'=>$shift->Shift_id))->result();
if(!empty($attendances)){
foreach($attendances as $attendance){
list($hours, $minutes, $sec) =explode(":",$attendance->Late);
$latetime= $hours*60+$minutes;
$attendance->Late;
list($hours, $minutes, $sec) =explode(":",$attendance->Early);
$Earlyime= $hours*60+$minutes;
if($Punch_variant_active ==1 && $attendance->Absent !='true'  ){
if($Earlyime>=$Punch_variant_time || $latetime>=$Punch_variant_time){
$data[]=array('Attendacedate'=>$shiftdate,'Attendance_status'=>'No Record found','ShiftName'=>$shift->shift_name,'shift_id'=>$shift->Shift_id);
}
}
}
}
else{
$data[]=array('Attendacedate'=>$shiftdate,'Attendance_status'=>'No Record found','ShiftName'=>$shift->shift_name,     'shift_id'=>$shift->Shift_id);
}
}
}
}
}
}
return $data;
} */
    public function MOnthAttendance_check_for_consolidate($date, $employee, $num)
    {
        $data = array();
        $employee_id = $this->db->get_where('employee', array('id' => $employee))->row();
        $category_id = $employee_id->Category_id;
        $Empcatgory = $this->db->get_where('payroll_category_settings', array('id' => $category_id))->row();
        $Punch_variant_active = isset($Empcatgory->Punch_variant_active) ? $Empcatgory->Punch_variant_active : 0;
        $Punch_variant_time = isset($Empcatgory->Punch_variant_time) ? $Empcatgory->Punch_variant_time : 0;
        for ($i = 1; $i <= $num; $i++) {
            $shiftdate = $date . '-' . $i;
            //   $is_holiday=$this->Get_holidays($shiftdate);
            //   if(empty($is_holiday)){
            if (empty($shiftdate)) {
                $shifts = $this->db->query("SELECT * FROM payroll_shift_rosters sr
				LEFT JOIN  payroll_work_shift ws  ON ws.id=sr.Shift_id
				WHERE sr.Soft_delete=0 AND sr.employee_id='" . $employee . "' AND sr.Shift_Date='" . $shiftdate . "' ")->result();
                if (count($shifts) === 0) {
                    $data[] = array('Attendacedate' => $shiftdate, 'Shift_status' => 'No Record found', 'ShiftName' => '');
                } else {
                    foreach ($shifts as $shift) {
                        if ($shift->Shift_id != 0) {
                            $attendances = $this->db->get_where('payroll_attendanc_sheet', array('Soft_delete' => 0, 'employee_id' => $employee,
                                'Attendancedate' => $shift->Shift_Date,
                                'Shift_id' => $shift->Shift_id))->result();
                            if (!empty($attendances)) {
                                foreach ($attendances as $attendance) {
                                    /*  list($hours, $minutes, $sec) =explode(":",$attendance->Late);
                                    $latetime= $hours*60+$minutes;
                                    $attendance->Late;
                                    list($hours, $minutes, $sec) =explode(":",$attendance->Early);
                                    $Earlyime= $hours*60+$minutes;
                                    if($Punch_variant_active ==1 && $attendance->Absent !='true'  ){ */
                                    /* if($Earlyime>=$Punch_variant_time || $latetime>=$Punch_variant_time){ */
                                    $data[] = array('Attendacedate' => $shiftdate, 'Attendance_status' => 'No Record found', 'ShiftName' => $shift->shift_name, 'shift_id' => $shift->Shift_id, 'id' => $attendance->id, 'leave_category_id' => $attendance->leave_category_id);
                                    /* } */
                                    /* } */
                                }
                            } else {
                                $data[] = array('Attendacedate' => $shiftdate, 'Attendance_status' => 'No Record found', 'ShiftName' => $shift->shift_name, 'shift_id' => $shift->Shift_id);
                            }
                        }
                    }
                }
            }
        }
        return $data;
    }

    public function checksalaryforemployee($employees)
    {
        $salaryconfig = $this->db->get_where('salary', array('Soft_delete' => 0, 'employee_id' => $employees))->row();
        if (empty($salaryconfig)) {
            return false;
        }
        return $salaryconfig;

    }
    public function Get_roster_employee($month)
    {

        $this->db->select("employee.id,department.department,first_name  , last_name ");
        $this->db->from("rosters");
        $this->db->join("employee", "employee.id=rosters.employee_id", "left");
        $this->db->join("department", "department.id=employee.department", "left");
        $this->db->where("  DATE_FORMAT(rosters.Date ,'%Y') = DATE_FORMAT('" . $month . '-01' . "','%Y')  AND DATE_FORMAT(rosters.Date ,'%m') = DATE_FORMAT('" . $month . '-01' . "','%m')");
        $this->db->group_by('rosters.employee_id');
        $query = $this->db->get();
        $result = $query->result();
        return $result;

    }public function roster_data_by_empid($employee_id = null, $sdate = null, $flag = null)
    {
        $this->db->select("GROUP_CONCAT(`Type_name` SEPARATOR ',') AS `Type_name`,DATE ");
        $this->db->from("rosters");
        $this->db->join("employee", "employee.id=rosters.employee_id", "left");
        $this->db->join("department", "department.id=employee.department", "left");
        $this->db->where(array('rosters.Date' => $sdate, 'rosters.employee_id' => $employee_id));
        $this->db->group_by('Type_id,DATE');
        $this->db->order_by('DATE', 'ASC');
        $query = $this->db->get();
        $result = $query->row();

        if (!empty($result)) {
            $val['employeeid'] = $employee_id;
            $val['Shift_id'] = $result->Type_name;
            $val['Shift_Date'] = $sdate;

            //    $results[] = (object) $val;
            $results[] = (object) $val;

        } else {
            $val['employeeid'] = $employee_id;
            $val['Shift_id'] = '';
            $val['Shift_Date'] = $sdate;

            //    $results[] = (object) $val;
            $results[] = (object) $val;
        }

        return $results;
    }
}
