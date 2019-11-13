<?php
class Reports extends Admin_Controller {


	function __construct()
	{		
		parent::__construct();
		// $this->load->model("report_model");
		$this->load->model(array('report_model','setting_model','crm/Crm_model'));
		$this->load->library('form_validation');
		$this->colors	=	array('#FF0F00','#FF6600','#FF9E01','#FCD202','#F8FF01','#B0DE09','#04D215','#0D8ECF','#0D52D1','#2A0CD0','#8A0CCF','#CD0D74','#CD5C5C','#F08080','#FA8072','#FFA07A','#B22222','#DB7093','#C71585','#FF1493','#FF69B4','#FFB6C1','#FFC0CB','#FF4500','#FF6347','#FFA07A','#FFFF00','#FFD700','#F0E68C','#EE82EE','#9370DB','#00FA9A','#B0C4DE','#FF0F00','#FF6600','#FF9E01','#FCD202','#F8FF01','#B0DE09','#04D215','#0D8ECF','#0D52D1','#2A0CD0','#8A0CCF','#CD0D74','#CD5C5C','#F08080','#FA8072','#FFA07A','#B22222','#DB7093','#C71585','#FF1493','#FF69B4','#FFB6C1','#FFC0CB','#FF4500','#FF6347','#FFA07A','#FFFF00','#FFD700','#F0E68C','#EE82EE','#9370DB','#00FA9A','#B0C4DE','#FF0F00','#FF6600','#FF9E01','#FCD202','#F8FF01','#B0DE09','#04D215','#0D8ECF','#0D52D1','#2A0CD0','#8A0CCF','#CD0D74','#CD5C5C','#F08080','#FA8072','#FFA07A','#B22222','#DB7093','#C71585','#FF1493','#FF69B4','#FFB6C1','#FFC0CB','#FF4500','#FF6347','#FFA07A','#FFFF00','#FFD700','#F0E68C','#EE82EE','#9370DB','#00FA9A','#B0C4DE');
		$this->load->library("pagination");
		$this->load->helper("url");
	}
	
	
	/*public function index(){
		$data['page_title']	= lang('client_report');
		$this->render_admin('reports/occupancy', $data);
	}*/

	public function index(){
		$data['page_title']	= lang('client_reports');
		$data['crm_customer']      = $this->Crm_model->getCustomerlist();
		$this->render_admin('reports/client_reports', $data);
	}
	public function booking_report(){
		$data['page_title']	= lang('booking_reports');
		$data['booking_reports']      = $this->report_model->get_all_booking_details();
		$this->render_admin('reports/booking_reports', $data);
	}	

	/*function occupancy()
	{	
		$data['room_types']	= $this->room_type_model->get_all();
		$data['setting']	= $this->setting_model->get();		
		$data['weekdata']	=	array();
		$data['monthdata']	=	array();		
		$data['yeardata']	=	array();
		$data['customdata']	=	array();
				// 7 DAYS Week Chart
						$weekstart	=	date("Y-m-d", strtotime("- 6 DAYS"));
						$wbegin = new DateTime($weekstart);
						$wend = new DateTime(date('Y-m-d', strtotime("+ 1 DAYS")));
						
						$winterval = DateInterval::createFromDateString('1 day');
						$wperiod = new DatePeriod($wbegin, $winterval, $wend);
						$i=0;
						foreach($wperiod as $dt){
							$date		=	 $dt->format( "Y-m-d" );	
							$dayno		=	 $dt->format( "N" );
							$day		=	 $dt->format( "D" );
							$day		=	strtolower($day);
							$weekdata	=	$this->report_model->get_this_week_occupancy($date);
							$data['weekdata'][$i]['date']	=	date('d M', strtotime($date));
							$data['weekdata'][$i]['total']	=	@$weekdata->total;
							$data['weekdata'][$i]['color']	=	$this->colors[$i];
						$i++;
						}		
						
						
						$mbegin = new DateTime(date("Y-m-d", strtotime("- 30 DAYS")));
						$mend = new DateTime(date('Y-m-d', strtotime("+ 1 DAYS")));
						
						$minterval = DateInterval::createFromDateString('1 day');
						$mperiod = new DatePeriod($mbegin, $minterval, $mend);
						$i=0;
						foreach($mperiod as $dt){
							$date		=	 $dt->format( "Y-m-d" );	
							$dayno		=	 $dt->format( "N" );
							$day		=	 $dt->format( "D" );
							$day		=	strtolower($day);
							$monthdata	=	$this->report_model->get_this_week_occupancy($date);
						 
							$data['monthdata'][$i]['date']	=	date('d M', strtotime($date));
							$data['monthdata'][$i]['total']	=	@$monthdata->total;
							$data['monthdata'][$i]['color']	=	$this->colors[$i];
						$i++;
						}		
						
						
						$start = $month = strtotime("- 365 days");
						$end = strtotime('+ 1 day');
						$i=0;
						while($month < $end)
						{
							$month = strtotime("+1 month", $month);
							 $Y	= date('Y', $month);
							 $M	= date('m', $month);
							$yeardata	=	$this->report_model->get_this_year_occupancy($Y,$M); 
							
							$data['yeardata'][$i]['date']	=	date('M', $month)." ".date('Y', $month);
							$data['yeardata'][$i]['total']	=	@$yeardata->total;
							$data['yeardata'][$i]['color']	=	$this->colors[$i];
							$i++;	 
						}		
						
						if(!empty($_POST['from']) && !empty($_POST['to'])){
						
							$from = $this->input->post('from');
							$to = $this->input->post('to');
							$cbegin = new DateTime($from);
							$cend = new DateTime($to );
							
							$cinterval = DateInterval::createFromDateString('1 day');
							$cperiod = new DatePeriod($cbegin, $cinterval, $cend);
							$cnt=1;
							foreach ($cperiod as $dt){
								$cnt++;
							}
							//echo '<pre>'; print_r($this->colors);die;	
							
								$i=0;
								foreach ($cperiod as $dt){
									$customdata	=	$this->report_model->get_this_week_occupancy($dt->format( "Y-m-d" ));
									$data['customdata'][$i]['date']		=	$dt->format( "d M Y" );
									$data['customdata'][$i]['total']	=	@$customdata->total;
									$data['customdata'][$i]['color']	=	@$this->colors[$i];
									$i++;
								}
							
						}
						
		$data['page_title']	= lang('occupancy_report');
		$this->render_admin('reports/occupancy', $data);		
	}
	*/
/*	function guest()
	{	
		$data['room_types']	= $this->room_type_model->get_all();
		$data['setting']	= $this->setting_model->get();		
		$data['weekdata']	=	array();
		$data['monthdata']	=	array();		
		$data['yeardata']	=	array();
		$data['customdata']	=	array();
				// 7 DAYS Week Chart
						$weekstart	=	date("Y-m-d", strtotime("- 6 DAYS"));
						$wbegin = new DateTime($weekstart);
						$wend = new DateTime(date('Y-m-d', strtotime("+ 1 DAYS")));
						
						$winterval = DateInterval::createFromDateString('1 day');
						$wperiod = new DatePeriod($wbegin, $winterval, $wend);
						$i=0;
						foreach($wperiod as $dt){
							$date		=	 $dt->format( "Y-m-d" );	
							$dayno		=	 $dt->format( "N" );
							$day		=	 $dt->format( "D" );
							$day		=	strtolower($day);
							$weekdata	=	$this->report_model->get_this_date_guest($date);
							$data['weekdata'][$i]['date']	=	date('d M', strtotime($date));
							$data['weekdata'][$i]['total']	=	@$weekdata->total;
							$data['weekdata'][$i]['color']	=	$this->colors[$i];
						$i++;
						}		
						
						
						$mbegin = new DateTime(date("Y-m-d", strtotime("- 30 DAYS")));
						$mend = new DateTime(date('Y-m-d', strtotime("+ 1 DAYS")));
						
						$minterval = DateInterval::createFromDateString('1 day');
						$mperiod = new DatePeriod($mbegin, $minterval, $mend);
						$i=0;
						foreach($mperiod as $dt){
							$date		=	 $dt->format( "Y-m-d" );	
							$dayno		=	 $dt->format( "N" );
							$day		=	 $dt->format( "D" );
							$day		=	strtolower($day);
							$monthdata	=	$this->report_model->get_this_date_guest($date);
						 
							$data['monthdata'][$i]['date']	=	date('d M', strtotime($date));
							$data['monthdata'][$i]['total']	=	@$monthdata->total;
							$data['monthdata'][$i]['color']	=	$this->colors[$i];
						$i++;
						}		
						
						
						$start = $month = strtotime("- 365 days");
						$end = strtotime('+ 1 day');
						$i=0;
						while($month < $end)
						{
							$month = strtotime("+1 month", $month);
							 $Y	= date('Y', $month);
							 $M	= date('m', $month);
							$yeardata	=	$this->report_model->get_this_year_guest($Y,$M); 
							
							$data['yeardata'][$i]['date']	=	date('M', $month)." ".date('Y', $month);
							$data['yeardata'][$i]['total']	=	@$yeardata->total;
							$data['yeardata'][$i]['color']	=	$this->colors[$i];
							$i++;	 
						}		
						
						if(!empty($_POST['from']) && !empty($_POST['to'])){
						
							$from = $this->input->post('from');
							$to = $this->input->post('to');
							$cbegin = new DateTime($from);
							$cend = new DateTime($to );
							
							$cinterval = DateInterval::createFromDateString('1 day');
							$cperiod = new DatePeriod($cbegin, $cinterval, $cend);
							$cnt=1;
							foreach ($cperiod as $dt){
								$cnt++;
							}
							//echo '<pre>'; print_r($this->colors);die;	
							
								$i=0;
								foreach ($cperiod as $dt){
									$customdata	=	$this->report_model->get_this_date_guest($dt->format( "Y-m-d" ));
									$data['customdata'][$i]['date']		=	$dt->format( "d M Y" );
									$data['customdata'][$i]['total']	=	@$customdata->total;
									$data['customdata'][$i]['color']	=	@$this->colors[$i];
									$i++;
								}
							
						}
						
			//echo json_encode($data['weekdata']);			
		//echo '<pre>'; print_r($data['customdata']);die;
		$data['page_title']	= lang('guest_report');
		$this->render_admin('reports/guest', $data);		
	}*/
	
	function financial()
	{	
		$data['weekdata']	=	array();
		$data['monthdata']	=	array();		
		$data['yeardata']	=	array();
		$data['customdata']	=	array();
				// 7 DAYS Week Chart
						$weekstart	=	date("Y-m-d", strtotime("- 6 DAYS"));
						$wbegin = new DateTime($weekstart);
						$wend = new DateTime(date('Y-m-d', strtotime("+ 1 DAYS")));
						
						$winterval = DateInterval::createFromDateString('1 day');
						$wperiod = new DatePeriod($wbegin, $winterval, $wend);
						$i=0;
						foreach($wperiod as $dt){
							$date		=	 $dt->format( "Y-m-d" );	
							$dayno		=	 $dt->format( "N" );
							$day		=	 $dt->format( "D" );
							$day		=	strtolower($day);
							$weekdata	=	$this->report_model->get_this_date_financial($date);
							$data['weekdata'][$i]['date']	=	date('d M', strtotime($date));
							$data['weekdata'][$i]['total']	=	@$weekdata->total;
							$data['weekdata'][$i]['color']	=	$this->colors[$i];
						$i++;
						}		
						
						
						$mbegin = new DateTime(date("Y-m-d", strtotime("- 30 DAYS")));
						$mend = new DateTime(date('Y-m-d', strtotime("+ 1 DAYS")));
						
						$minterval = DateInterval::createFromDateString('1 day');
						$mperiod = new DatePeriod($mbegin, $minterval, $mend);
						$i=0;
						foreach($mperiod as $dt){
							$date		=	 $dt->format( "Y-m-d" );	
							$dayno		=	 $dt->format( "N" );
							$day		=	 $dt->format( "D" );
							$day		=	strtolower($day);
							$monthdata	=	$this->report_model->get_this_date_financial($date);
						 
							$data['monthdata'][$i]['date']	=	date('d M', strtotime($date));
							$data['monthdata'][$i]['total']	=	@$monthdata->total;
							$data['monthdata'][$i]['color']	=	$this->colors[$i];
						$i++;
						}		
						
						
						$start = $month = strtotime("- 365 days");
						$end = strtotime('+ 1 day');
						$i=0;
						while($month < $end)
						{
							$month = strtotime("+1 month", $month);
							 $Y	= date('Y', $month);
							 $M	= date('m', $month);
							$yeardata	=	$this->report_model->get_this_year_financial($Y,$M); 
							
							$data['yeardata'][$i]['date']	=	date('M', $month)." ".date('Y', $month);
							$data['yeardata'][$i]['total']	=	@$yeardata->total;
							$data['yeardata'][$i]['color']	=	$this->colors[$i];
							$i++;	 
						}		
						
						if(!empty($_POST['from']) && !empty($_POST['to'])){
						
							$from = $this->input->post('from');
							$to = $this->input->post('to');
							$cbegin = new DateTime($from);
							$cend = new DateTime($to );
							
							$cinterval = DateInterval::createFromDateString('1 day');
							$cperiod = new DatePeriod($cbegin, $cinterval, $cend);
							$cnt=1;
							foreach ($cperiod as $dt){
								$cnt++;
							}
						
								$i=0;
								foreach ($cperiod as $dt){
									$customdata	=	$this->report_model->get_this_date_financial($dt->format( "Y-m-d" ));
									$data['customdata'][$i]['date']		=	$dt->format( "d M Y" );
									$data['customdata'][$i]['total']	=	@$customdata->total;
									$data['customdata'][$i]['color']	=	@$this->colors[$i];
									$i++;
								}
							
						}
					
		$data['page_title']	= lang('financial_report');
		$this->render_admin('reports/financial', $data);		
	}
	 function saleReport(){
        $data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error');
        $data['page_title']	= lang('sales_report');
		$data['settings']=$settings=$this->report_model->getSettings();
		$this->render_admin('reports/sales_report',$data);
    }

    public function get_sales_reports(){
        $start = $this->input->post('start');
        $end = $this->input->post('end');
        $paymenttype = $this->input->post('paymenttype');
        $limit = $this->input->post('pagelimit');        
        $offsetSegment = 4;
        $offset = $this->uri->segment($offsetSegment,0);
        $this->session->set_userdata('start_date', $this->input->post('start'));
        $this->session->set_userdata('end_date', $this->input->post('end'));
        $data= '';
        if ($start != '' ) {
            $data = $this->report_model->getSalesReports($start,$end,$paymenttype,$limit,$offset);
            if (!empty($data['data'])){
                 $report = $data['data'];
             }
             else{
                $report = 'empty';
             }
        }
        else{
            $report = 'error';
        }
        $total = $data['total'];
        $pagination = $this->pagination('reports/get_till_settlement_reports',$limit,$offsetSegment,$total);
        $this->sma->send_json(array('reports' => $report,'pagination'=>$pagination));
        
   }
   
    function getReports($pdf = NULL, $xls = NULL)
    {
      
        $start = $this->input->post('start');
        $end = $this->input->post('end');
        $paymenttype = $this->input->post('paymenttype');
        $limit = $this->input->post('pagelimit');        
        $offsetSegment = 4;
        $offset = $this->uri->segment($offsetSegment,0);
        $this->session->set_userdata('start_date', $this->input->post('start'));
        $this->session->set_userdata('end_date', $this->input->post('end'));
        $data= '';
        
        if ($pdf || $xls) {
             $this->db->select('*');
                if($paymenttype ==1){
					$this->db->where('(advance_amt +balance) =total_cost');
					$this->db->where('isPaid_initialAmount',1);
				}
				if($paymenttype ==2){
					$this->db->where('balance >=',0);
				}
				if($paymenttype ==3){
					$this->db->where('balance <=',0);
				}
              $this->db ->where('DATE(s.booking_date) >=', $start);
              $this->db->where('DATE(s.booking_date) <=', $end);
              $this->db->stop_cache();
              $this->db->limit($limit,$offset);
	          $q = $this->db->get('sale_project s');
          
            if ($q->num_rows() > 0) {
                foreach (($q->result()) as $row) {
                    $data[] = $row;
                }
            } else {
                $data = NULL;
            }
			
            if (!empty($data)) {

                $this->load->library('excel');
                $this->excel->setActiveSheetIndex(0);
                $this->excel->getActiveSheet()->setTitle(lang('sales_report'));
                $this->excel->getActiveSheet()->SetCellValue('A1', lang('date'));
                $this->excel->getActiveSheet()->SetCellValue('B1', lang('reference_no'));
                $this->excel->getActiveSheet()->SetCellValue('C1', lang('biller'));
                $this->excel->getActiveSheet()->SetCellValue('D1', lang('customer'));
                $this->excel->getActiveSheet()->SetCellValue('E1', lang('product_qty'));
                $this->excel->getActiveSheet()->SetCellValue('F1', lang('grand_total'));
                $this->excel->getActiveSheet()->SetCellValue('G1', lang('paid'));
                $this->excel->getActiveSheet()->SetCellValue('H1', lang('balance'));
                $this->excel->getActiveSheet()->SetCellValue('I1', lang('payment_status'));

                $row = 2;
                $total = 0;
                $paid = 0;
                $balance = 0;
                foreach ($data as $data_row) {
                    $this->excel->getActiveSheet()->SetCellValue('A' . $row,$data_row->booking_date);
                    $this->excel->getActiveSheet()->SetCellValue('B' . $row, $data_row->booking_date);
                    $this->excel->getActiveSheet()->SetCellValue('C' . $row, $data_row->booking_date);
                    $this->excel->getActiveSheet()->SetCellValue('D' . $row, $data_row->booking_date);
                    $this->excel->getActiveSheet()->SetCellValue('E' . $row, $data_row->booking_date);
                    $this->excel->getActiveSheet()->SetCellValue('F' . $row, $data_row->booking_date);
                    $this->excel->getActiveSheet()->SetCellValue('G' . $row, $data_row->booking_date);
                    $this->excel->getActiveSheet()->SetCellValue('H' . $row, ($data_row->booking_date ));
                    $this->excel->getActiveSheet()->SetCellValue('I' . $row,($data_row->booking_date ));
                    $total += $data_row->basic_sale_price;
                    $paid += $data_row->basic_sale_price;
                    $balance += ($data_row->basic_sale_price - $data_row->basic_sale_price);
                    $row++;
                }
                $this->excel->getActiveSheet()->getStyle("F" . $row . ":H" . $row)->getBorders()
                    ->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
                $this->excel->getActiveSheet()->SetCellValue('F' . $row, $total);
                $this->excel->getActiveSheet()->SetCellValue('G' . $row, $paid);
                $this->excel->getActiveSheet()->SetCellValue('H' . $row, $balance);
                $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
                $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
                $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
                $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
                $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
                $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
                $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
                $this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
                $this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
                $this->excel->getDefaultStyle()->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $this->excel->getActiveSheet()->getStyle('E2:E' . $row)->getAlignment()->setWrapText(true);
				
               $filename = 'sales_report';
               $this->load->helper('excel');
               create_excel($this->excel, $filename);
			   $object_writer = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
 /*  header('Content-Type: application/vnd.ms-excel');
  header('Content-Disposition: attachment;filename="Employee Data.xls"');
  $object_writer->save('php://output');
  die; */

            }
            $this->session->set_flashdata('error', lang('nothing_found'));
            redirect($_SERVER["HTTP_REFERER"]);

        } else {

            $si = "( SELECT sale_id, product_id, serial_no, GROUP_CONCAT(CONCAT({$this->db->dbprefix('sale_items')}.product_name, '__', {$this->db->dbprefix('sale_items')}.quantity) SEPARATOR '___') as item_nane from {$this->db->dbprefix('sale_items')} ";
            if ($product || $serial) { $si .= " WHERE "; }
            if ($product) {
                $si .= " {$this->db->dbprefix('sale_items')}.product_id = {$product} ";
            }
            if ($product && $serial) { $si .= " AND "; }
            if ($serial) {
                $si .= " {$this->db->dbprefix('sale_items')}.serial_no LIKe '%{$serial}%' ";
            }
            $si .= " GROUP BY {$this->db->dbprefix('sale_items')}.sale_id ) FSI";
            $this->load->library('datatables');
            $this->datatables
                ->select("DATE_FORMAT(date, '%Y-%m-%d %T') as date, reference_no, biller, customer, FSI.item_nane as iname, grand_total, paid, (grand_total-paid) as balance, payment_status, {$this->db->dbprefix('sales')}.id as id", FALSE)
                ->from('sales')
                ->join($si, 'FSI.sale_id=sales.id', 'left')
                ->join('warehouses', 'warehouses.id=sales.warehouse_id', 'left');
                // ->group_by('sales.id');

            if ($user) {
                $this->datatables->where('sales.created_by', $user);
            }
            if ($product) {
                $this->datatables->where('FSI.product_id', $product);
            }
            if ($serial) {
                $this->datatables->like('FSI.serial_no', $serial);
            }
            if ($biller) {
                $this->datatables->where('sales.biller_id', $biller);
            }
            if ($customer) {
                $this->datatables->where('sales.customer_id', $customer);
            }
            if ($warehouse) {
                $this->datatables->where('sales.warehouse_id', $warehouse);
            }
            if ($reference_no) {
                $this->datatables->like('sales.reference_no', $reference_no, 'both');
            }
            if ($start_date) {
                $this->datatables->where($this->db->dbprefix('sales').'.date BETWEEN "' . $start_date . '" and "' . $end_date . '"');
            }

            echo $this->datatables->generate();

        }

    }
   
   
   
   
   	public function unit_report(){
		$data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error');
		$data['page_title']	= lang('unit_reports');
		$data['settings']=$this->report_model->getSettings();
		$this->render_admin('reports/unit_reports', $data);
	}	
	 public function get_unit_reports(){
        $bookedtype = $this->input->post('bookedtype');
        $limit = $this->input->post('pagelimit');        
        $offsetSegment = 4;
        $offset = $this->uri->segment($offsetSegment,0);
        $data= '';
            $data = $this->report_model->getUnitReports($bookedtype,$limit,$offset);
            if (!empty($data['data'])){
                 $report = $data['data'];
             }
             else{
                $report = 'empty';
             }
        $total = $data['total'];
        $pagination = $this->pagination('reports/get_unit_reports',$limit,$offsetSegment,$total);
        $this->sma->send_json(array('reports' => $report,'pagination'=>$pagination));
        
   }
   	public function unAttendant_report(){
		$data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error');
		$data['page_title']	= lang('unattendant_enquiry');
		$data['settings']=$this->report_model->getSettings();
		$this->render_admin('reports/unattendant_report', $data);
	}	
	 public function get_unAttendant_reports(){
		$start = $this->input->post('start');
        $end = $this->input->post('end');
        $limit = $this->input->post('pagelimit');        
        $offsetSegment = 4;
        $offset = $this->uri->segment($offsetSegment,0);
        $data= '';
            $data = $this->report_model->getUnattendantReports($start,$end,$limit,$offset);
            if (!empty($data['data'])){
                 $report = $data['data'];
             }
             else{
                $report = 'empty';
             }
        $total = $data['total'];
        $pagination = $this->pagination('reports/get_unAttendant_reports',$limit,$offsetSegment,$total);
        $this->sma->send_json(array('reports' => $report,'pagination'=>$pagination));
        
   }
   	public function prospectiveEnquiry_report(){
		$data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error');
		$data['page_title']	= lang('Prospective_enquiry');
		$data['settings']=$this->report_model->getSettings();
		$this->render_admin('reports/prospective_enquiry', $data);
	}	
	 public function get_prospective_reports(){
		$start = $this->input->post('start');
        $end = $this->input->post('end');
        $limit = $this->input->post('pagelimit');        
        $offsetSegment = 4;
        $offset = $this->uri->segment($offsetSegment,0);
        $data= '';
            $data = $this->report_model->getprospectiveEnquiry_Reports($start,$end,$limit,$offset);
            if (!empty($data['data'])){
                 $report = $data['data'];
             }
             else{
                $report = 'empty';
             }
        $total = $data['total'];
        $pagination = $this->pagination('reports/get_prospective_reports',$limit,$offsetSegment,$total);
        $this->sma->send_json(array('reports' => $report,'pagination'=>$pagination));
        
   }
   	public function pendingFollowup_report(){
		$data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error');
		$data['page_title']	= lang('Pending_followup');
		$data['settings']=$this->report_model->getSettings();
		$this->render_admin('reports/pending_followup', $data);
	}	
	 public function get_pendingFollowup_reports(){
        $start = $this->input->post('start');
        $end = $this->input->post('end');
        $followuptype = $this->input->post('followuptype');
		$agenttype = $this->input->post('agenttype');
		$name = $this->input->post('name');
        $limit = $this->input->post('pagelimit');        
        $offsetSegment = 4;
        $offset = $this->uri->segment($offsetSegment,0);
        $this->session->set_userdata('start_date', $this->input->post('start'));
        $this->session->set_userdata('end_date', $this->input->post('end'));
        $data= '';
        if ($start != '' ) {
            $data = $this->report_model->getPendingFollowUpReports($start,$end,$followuptype,$agenttype,$name,$limit,$offset);
            if (!empty($data['data'])){
                 $report = $data['data'];
             }
             else{
                $report = 'empty';
             }
        }
        else{
            $report = 'error';
        }
        $total = $data['total'];
        $pagination = $this->pagination('reports/get_pendingFollowup_reports',$limit,$offsetSegment,$total);
        $this->sma->send_json(array('reports' => $report,'pagination'=>$pagination));
        
   }
   
   	public function salemanwiseSales_report(){
		$data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error');
		$data['page_title']	= lang('salemanwise_sales');
		$data['settings']=$this->report_model->getSettings();
		$this->render_admin('reports/salemanwise_sales', $data);
	}	
	 public function get_salemanwiseSales_reports(){
        $start = $this->input->post('start');
        $end = $this->input->post('end');
		$agenttype = $this->input->post('agenttype');
		$name = $this->input->post('name');
        $limit = $this->input->post('pagelimit');        
        $offsetSegment = 4;
        $offset = $this->uri->segment($offsetSegment,0);
        $this->session->set_userdata('start_date', $this->input->post('start'));
        $this->session->set_userdata('end_date', $this->input->post('end'));
        $data= '';
        if ($start != '' ) {
           $data = $this->report_model->get_SalesmanWise_SalesReports($start,$end,$agenttype,$name,$limit,$offset);
            if (!empty($data['data'])){
                 $report = $data['data'];
             }
             else{
                $report = 'empty';
             }
        }
        else{
            $report = 'error';
        }
        $total = $data['total'];
        $pagination = $this->pagination('reports/get_salemanwiseSales_reports',$limit,$offsetSegment,$total);
        $this->sma->send_json(array('reports' => $report,'pagination'=>$pagination));
   }
   
   
   function pagination($url,$per,$segment,$total){
        $config['base_url'] = $url;
        $config['per_page'] = $per;
        $config['uri_segment'] = $segment;
        $config['total_rows'] = $total;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['prev_link'] = 'Previous';
        $config['next_link'] = 'Next';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
       //$config['num_links'] = 3;
        $config['first_link']  = FALSE;
        $config['last_link']   = FALSE;
        $limit = $config['per_page'];
        $offset = $this->uri->segment($config['uri_segment'],0);
        $offset = ($offset>1)?(($offset-1) * $limit):0;
        
        $this->pagination->initialize($config);
        return $this->pagination->create_links();
   }

		public function projectStatus_report(){
		$data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error');
		$data['page_title']	= lang('project_status');
		if($this->input->post('project_status')){
	    $status = $this->input->post('project_status');
		$data['projects']=$this->report_model->get_project($status);
		  /* foreach($projects as $project){
			  $buildings=$this->report_model->get_building($project->id);
			  foreach($buildings as $building){
				  $milesstones=$this->report_model->get_milestone($project->id,$building->bldid);
				  foreach($milesstones as $milesstone){
					  $taskslists=$this->report_model->get_task($project->id,$building->bldid,$milesstone->id);
					 foreach($taskslists as $taskslist){
						  $datatask[]=$taskslist;
					  } 
					  $datamilestone[]=array('milestone'=>$milesstone,'taskdata'=>$datatask);
				  }
				  $databuilding[]=array('building'=>$building,'step1'=>$datamilestone);
			  }
			    $dataproject[]=array('project'=>$project,'step2'=>$databuilding);
		  } */
	         
		}
		$this->render_admin('reports/project_status', $data);
	}	
	function get_project_status(){
	     $status = $this->input->post('project_status');
		 $projects=$this->report_model->get_project($status);
		  foreach($projects as $project){
			  $buildings=$this->report_model->get_building($project->id);
			  foreach($buildings as $building){
				  $milesstones=$this->report_model->get_milestone($project->id,$building->bldid);
				  foreach($milesstones as $milesstone){
					  $taskslists=$this->report_model->get_task($project->id,$building->bldid,$milesstone->id);
					 foreach($taskslists as $taskslist){
						  $datatask[]=$taskslist;
					  } 
					  $datamilestone[]=array('milestone'=>$milesstone,'taskdata'=>$datatask);
				  }
				  $databuilding[]=array('building'=>$building,'step1'=>$datamilestone);
			  }
			    $dataproject[]=array('project'=>$project,'step2'=>$databuilding);
		  }
	echo json_encode($dataproject);
	}
	
}