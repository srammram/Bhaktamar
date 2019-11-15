<?php
class Booking extends Admin_Controller {
	function __construct(){		
		parent::__construct();
		$this->load->model(array('Booking_model'));
		$this->load->library("pagination");
		$this->load->helper("url");
		$this->load->helper('form');
		$this->load->library('form_validation');
	}
	function index(){
	
        $admin = $this->session->userdata('admin');
        $data['page_title'] = lang('booking');
        $this->render_admin('booking/list', $data);
	}
	public function getbookings(){
        $actions = "<div class=\"text-center\">";
       // $actions .= "<a href='" . base_url('admin/Project/project_chart/$1') . "'  class='tip' ><i class=\"fa fa-bar-chart\"></i></a> <a href='" . base_url('admin/Project/view/$1') . "'  class='tip' ><i class=\"fa fa-eye\"></i></a> <a href='" . base_url('admin/Project/form/$1') . "'  class='tip' ><i class=\"fa fa-edit\"></i></a> <a href='" . base_url('admin/Project/delete/$1') . "' class='tip po'  onclick='return areyousure(this)'><i class=\"fa fa-trash-o\"></i></a>";
		  $actions .= "<a href='" . base_url('admin/booking/view/$1') . "'  class='tip' ><i class=\"fa fa-eye\"></i></a> <a href='" . base_url('admin/booking/booking/$1') . "'  class='tip' ><i class=\"fa fa-edit\"></i></a> <a href='" . base_url('admin/booking/delete/$1') . "' class='tip po'  onclick='return areyousure(this)'><i class=\"fa fa-trash-o\"></i></a>";
        $actions .= "</div>";
        $this->load->library('datatables');  
        $this->datatables
			->select("booking.id,serial_no, date ,building_info.name building,floors.name floors, unit_name ,   applicant_name, total_received_amt,grand_total_cost", false)
			->from("booking")
			->join("floors","floors.id=booking.floor","left")
			->join("building_info","building_info.bldid=booking.building_no","left")
			->join("add_unit","add_unit.uid=booking.unit_id","left")        
            ->where("booking.soft_delete", 0)
            ->add_column("Actions", $actions, "booking.id");
        echo $this->datatables->generate();
    }
	function booking($id = false){
		$data['page_title']         	               = lang('booking');		
		$data['building']=$this->Booking_model->getbuilding();
		$maxid=$this->Booking_model->findmaxId();
		$data['id']                                    = "";
		$data['serial_no']                             = 'BN'.str_pad($maxid, 6, '0', STR_PAD_LEFT);
		$data['date']                                  ="";
		$data['applicant_name']                        ="";
		$data['address']                               ="";
		$data['pincode']                               ="";
		$data['contactno']                             ="";
		$data['whatapp']                               ="";
		$data['email']                                 ="";
		$data['occuption']                             ="";
		$data['organization']                          ="";
		$data['desigantion']                           ="";
		$data['d_o_b']                                 ="";
		$data['anniversary']                           ="";
		$data['pan_no']                                ="";
		$data['aadhar_no']                             ="";
		$data['co_applicant_name']                     ="";
		$data['relationship']                          ="";
		$data['co_app_contact_no']                     ="";
		$data['co_app_email']                          ="";
		$data['co_app_occupation']                     ="";
		$data['co_app_organization']                   ="";
		$data['co_app_desigantion']                    ="";
		$data['co_app_d_o_b']                          ="";
		$data['co_app_anniversary']                    ="";
		$data['co_app_pan_no']                         ="";
		$data['co_app_aadhar_no']                      ="";
		$data['building_no']                           ="";
		$data['floor']                                 ="";
		$data['flat']                                  ="";
		$data['carpet_area']                           ="";
		$data['enclosed_balcony_area']                 ="";
		$data['open_balcony_carpet']                   ="";
		$data['basic_cost']                            ="";
		$data['intra_charges']                         ="";
		$data['agreement_value']                       ="";
		$data['stamp_duty']                            ="";
		$data['registration_fee']                      ="";
		$data['legal_charges']                         ="";
		$data['gst']                                   ="";
		$data['grand_total_cost']                      ="";
		$data['owner_contribution']                    ="";
		$data['bank_loan']                             ="";
		$data['payment_schedule_plan']                 ="";
		$data['token_booking_amt']                     ="";
		$data['execution_of_agreement_amt']            ="";
		$data['completion_of_plinth_amt']              ="";
		$data['parking_1st_slab_amt']                  ="";
		$data['completionof_2nd_slab_amt']             ="";
		$data['completion_of_5th_slab_amt']            ="";
		$data['completion_of_8th_slab_amt']            ="";
		$data['completion_of_11_slab_amt']             ="";
		$data['completion_of_topmost_slab_amt']        ="";
		$data['paint_stage_amt']                       ="";
		$data['finishg_work_amt']                      ="";
		$data['possesion_amt']                         ="";
		$data['valid_days']                            ="";
		$data['purchaser_signature_path']              ="";
		$data['authorized_signatory']                  ="";
		$data['attended_by']                           ="";
		$data['witness']                               ="";
		if ($id){	
			$data['booking']			=	$booking   = $this->Booking_model->getbookingByid($id);
			$data['floorlist']			    =   $this->Booking_model->get_floor($booking->building_no);
			$data['unitlist']		     	=   $this->Booking_model->get_units($booking->floor);
			$data['payment_details']    =   $this->Booking_model->get_payment_details($booking->id);		
			if (!$booking){
				$this->session->set_flashdata('error', 'Booking Details Not Found');
				redirect('admin/booking');
			}
		$data['id']                                    =$booking->id;
		$data['serial_no']                             =$booking->serial_no;
		$data['date']                                  =$booking->date;
		$data['applicant_name']                        =$booking->applicant_name;
		$data['address']                               =$booking->address;
		$data['pincode']                               =$booking->pincode;
		$data['contactno']                             =$booking->contactno;
		$data['whatapp']                               =$booking->whatapp;
		$data['email']                                 =$booking->email;
		$data['occuption']                             =$booking->occuption;
		$data['organization']                          =$booking->organization;
		$data['desigantion']                           =$booking->desigantion;
		$data['d_o_b']                                 =$booking->d_o_b;
		$data['anniversary']                           =$booking->anniversary;
		$data['pan_no']                                =$booking->pan_no;
		$data['aadhar_no']                             =$booking->aadhar_no;
		$data['co_applicant_name']                     =$booking->co_applicant_name;
		$data['relationship']                           =$booking->relationship;
		$data['co_app_contact_no']                     =$booking->co_app_contact_no;
		$data['co_app_email']                          =$booking->co_app_email;
		$data['co_app_occupation']                     =$booking->co_app_occupation;
		$data['co_app_organization']                   =$booking->co_app_organization;
		$data['co_app_desigantion']                    =$booking->co_app_desigantion;
		$data['co_app_d_o_b']                          =$booking->co_app_d_o_b;
		$data['co_app_anniversary']                    =$booking->co_app_anniversary;
		$data['co_app_pan_no']                         =$booking->co_app_pan_no;
		$data['co_app_aadhar_no']                      =$booking->co_app_pan_no;
		$data['building_no']                           =$booking->building_no;
		$data['floor']                                 =$booking->floor;
		$data['flat']                                  =$booking->unit_id;
		$data['carpet_area']                           =$booking->carpet_area;
		$data['enclosed_balcony_area']                 =$booking->enclosed_balcony_area;
		$data['open_balcony_carpet']                   =$booking->open_balcony_carpet;
		$data['basic_cost']                            =$booking->basic_cost;
		$data['intra_charges']                         =$booking->intra_charges;
		$data['agreement_value']                       =$booking->agreement_value;
		$data['stamp_duty']                            =$booking->stamp_duty;
		$data['registration_fee']                      =$booking->registration_fee;
		$data['legal_charges']                         =$booking->legal_charges;
		$data['gst']                                   =$booking->gst;
		$data['grand_total_cost']                      =$booking->grand_total_cost;
		$data['owner_contribution']                    =$booking->owner_contribution;
		$data['bank_loan']                             =$booking->bank_loan;
		$data['payment_schedule_plan']                 =$booking->payment_schedule_plan;
		$data['token_booking_amt']                     =$booking->token_booking_amt;
		$data['execution_of_agreement_amt']            =$booking->execution_of_agreement_amt;
		$data['completion_of_plinth_amt']              =$booking->completion_of_plinth_amt;
		$data['parking_1st_slab_amt']                  =$booking->parking_1st_slab_amt;
		$data['completionof_2nd_slab_amt']             =$booking->completionof_2nd_slab_amt;
		$data['completion_of_5th_slab_amt']            =$booking->completion_of_5th_slab_amt;
		$data['completion_of_8th_slab_amt']            =$booking->completion_of_8th_slab_amt;
		$data['completion_of_11_slab_amt']             =$booking->completion_of_11_slab_amt;
		$data['completion_of_topmost_slab_amt']        =$booking->completion_of_topmost_slab_amt;
		$data['paint_stage_amt']                       =$booking->paint_stage_amt;
		$data['finishg_work_amt']                      =$booking->finishg_work_amt;
		$data['possesion_amt']                         =$booking->possesion_amt;
		$data['valid_days']                            =$booking->valid_days;
		$data['purchaser_signature_path']              =$booking->purchaser_signature_path;
		$data['authorized_signatory']                  =$booking->authorized_signatory;
		$data['total_received_amt']                    =$booking->total_received_amt;
		$data['rupee_in_word']                         =$booking->rupee_in_word;
		$data['attended_by']                           =$booking->attended_by;
		$data['witness']                               =$booking->witness;
		}
		$this->form_validation->set_rules('date', 'lang:date', 'trim|required');
		$this->form_validation->set_rules('applicantname', 'lang:applicantname', 'trim|required');
		if ($this->form_validation->run() == FALSE){
		$this->render_admin('booking/bookingform',$data);		
		}else{
			$this->load->library('upload',$config);
			$Doc = '';
			 if(!empty($_FILES['purchaser_signature']['name'])){
                $config['upload_path'] = 'uploads/booking/purchaser_signatory/';
                $config['allowed_types'] = '*';
                $config['file_name'] = $_FILES['purchaser_signature']['name'];
                $this->upload->initialize($config);
                if($this->upload->do_upload('purchaser_signature')){
                    $uploadData = $this->upload->data();
                    $Doc = $uploadData['file_name'];
                }else{
                    $Doc = '';
                }
			 }
			 if(!empty($Doc)){
		 		 $save['purchaser_signature_path']		        =$Doc;  
			 }
			 $signatory='';
			 if(!empty($_FILES['authorised_signatory']['name'])){
                $config['upload_path'] = 'uploads/booking/authorized_signatory/';
                $config['allowed_types'] = '*';
                $config['file_name'] = $_FILES['authorised_signatory']['name'];
                $this->upload->initialize($config);
                if($this->upload->do_upload('authorised_signatory')){
                    $uploadData = $this->upload->data();
                    $signatory = $uploadData['file_name'];
                }else{
                    $signatory = '';
                }
			 }
			 if(!empty($signatory)){
		 		 $save['authorized_signatory']		        =$signatory;  
			 }
			 for($i=0; $i<count($this->input->post('paymentdate')); $i++){
				if(!empty($_POST['cheque'][$i]) ||!empty($_POST['paymentdate'][$i]) ){
					$paymentdetails[] = array(
						'cheque_no' =>	$_POST['cheque'][$i],
			         	'date' =>$_POST['paymentdate'][$i],
				        'bank_branch' =>$_POST['bank_details'][$i],
				         'amount' =>!empty($_POST['amount'][$i])?$_POST['amount'][$i]:0
					); 

				}
			}

			 $save['id']   =$id;
			 $save['serial_no']                             =$this->input->post('serialno');
			 $save['date']                                  =$this->input->post('date');
			 $save['applicant_name']                        =$this->input->post('applicantname');
			 $save['address']                               =$this->input->post('address');
			 $save['pincode']                               =$this->input->post('pincode');
			 $save['contactno']                             =$this->input->post('contact');
			 $save['whatapp']                               =$this->input->post('whatapp');
			 $save['email']                                 =$this->input->post('email');
			 $save['occuption']                             =$this->input->post('occupation');
			 $save['organization']                          =$this->input->post('organization');
			 $save['desigantion']                           =$this->input->post('desigantion');
			 $save['d_o_b']                                 =$this->input->post('age');
			 $save['anniversary']                           =$this->input->post('Anniversary');
			 $save['pan_no']                                =$this->input->post('pan');
			 $save['aadhar_no']                             =$this->input->post('adhar');
			 $save['co_applicant_name']                     =$this->input->post('co_applicant');
			 $save['relationship']                            =$this->input->post('relationship');
			 $save['co_app_contact_no']                     =$this->input->post('contact2');
			 $save['co_app_email']                          =$this->input->post('email2');
			 $save['co_app_occupation']                     =$this->input->post('occupation2');
			 $save['co_app_organization']                   =$this->input->post('organization2');
			 $save['co_app_desigantion']                    =$this->input->post('desigantion2');
			 $save['co_app_d_o_b']                          =$this->input->post('dob2');
			 $save['co_app_anniversary']                    =$this->input->post('anniversary2');
			 $save['co_app_pan_no']                         =$this->input->post('pan2');
			 $save['co_app_aadhar_no']                      =$this->input->post('adhar2');
			 $save['building_no']                           =$this->input->post('building_id');
			 $save['floor']                                 =$this->input->post('floor_id');
			 $save['unit_id']                                  =$this->input->post('unit_id');
			 $save['carpet_area']                           =$this->input->post('carpetarea');
			 $save['enclosed_balcony_area']                 =$this->input->post('enclosed_balconycarpet_area');
			 $save['open_balcony_carpet']                   =$this->input->post('open_balcony_carpet_area');
			 $save['basic_cost']                            =$this->input->post('basic_cost');
			 $save['intra_charges']                         =$this->input->post('intra_charges');
			 $save['agreement_value']                       =$this->input->post('agreementvalue');
			 $save['stamp_duty']                            =$this->input->post('stamp_duty');
			 $save['registration_fee']                      =$this->input->post('registration_fees');
			 $save['legal_charges']                         =$this->input->post('legal_charges');
			 $save['gst']                                   =$this->input->post('gst');
			 $save['grand_total_cost']                      =$this->input->post('total_cost');
			 $save['owner_contribution']                    =$this->input->post('own_contribution');
			 $save['bank_loan']                             =$this->input->post('bank_loan');
			 $save['payment_schedule_plan']                 =$this->input->post('scheduletype');
			 $save['token_booking_amt']                     =$this->input->post('token_booking_amt');
			 $save['execution_of_agreement_amt']            =$this->input->post('execution_of_agreement_amt');
			 $save['completion_of_plinth_amt']              =$this->input->post('completion_of_plinth_amt');
			 $save['parking_1st_slab_amt']                  =$this->input->post('parking_1st_slab_amt');
			 $save['completionof_2nd_slab_amt']             =$this->input->post('completionof_2nd_slab_amt');
			 $save['completion_of_5th_slab_amt']            =$this->input->post('completion_of_5th_slab_amt');
			 $save['completion_of_8th_slab_amt']            =$this->input->post('completion_of_8th_slab_amt');
			 $save['completion_of_11_slab_amt']             =$this->input->post('completion_of_11_slab_amt');
			 $save['completion_of_topmost_slab_amt']        =$this->input->post('completion_of_topmost_slab_amt');
			 $save['paint_stage_amt']                       =$this->input->post('paint_stage_amt');
			 $save['finishg_work_amt']                      =$this->input->post('finishg_work_amt');
			 $save['possesion_amt']                         =$this->input->post('possesion_amt');
			 $save['valid_days']                            =$this->input->post('valid_days');
			 $save['attended_by']                           =$this->input->post('attendedby');
			 $save['total_received_amt']                     =$this->input->post('total_received_payment');
			 $save['rupee_in_word']                        =$this->input->post('rupee_in_word');
			$this->Booking_model->booking_save($save,$paymentdetails);
		
			if($id){
				$this->session->set_flashdata('message', lang('AgentformUpdated'));
			}else{
				$this->session->set_flashdata('message', lang('AgentformSaved'));
			}
		       redirect('admin/booking');
		}
		
	}
	
}