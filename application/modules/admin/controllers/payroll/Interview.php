<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Interview extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_builder');
        $this->mTitle = TITLE;
        $this->load->model('global_model');
        $this->load->model('attendance_model');
        $this->load->model('crud_model', 'crud');
        $this->load->library('grocery_CRUD');
    }
	
	/* INTERVIEW ASSESSMENT FORM */
	function add_interview_assessment()
    {
        $this->mTitle .= 'Interview';
		$this->mViewData['education_master'] = $this->global_model->get_education_master();
		$this->mViewData['skills_master'] = $this->global_model->get_skills_master();
		
        $this->render('interview/add_interview_assessment');
    }
	
	function interview_assessment_list()
	{
		$this->mViewData['interview_list']  = $this->db->select('*')
				->from('interview')
				->where('soft_delete', 0)
				->get()
				->result();
			
		$this->render('interview/interview_assessment_list');
	}
	
	function edit_interview_assessment($id = null){

		$id = $this->encrypt->decode(str_replace(array('-', '_', '~'), array('+', '/', '='), $id));
		
		$this->mViewData['candidate_education'] = $this->global_model->get_education($id);
		$this->mViewData['candidate_work_experience'] = $this->global_model->get_work_experience($id);
		$this->mViewData['candidate_skills'] = $this->global_model->get_skills($id);
		$this->mViewData['candidate_additional_skills'] = $this->global_model->get_additional_skills($id);
		
		$this->mViewData['education_master'] = $this->global_model->get_education_master();
		$this->mViewData['skills_master'] = $this->global_model->get_skills_master();
		
		$this->mViewData['interview'] = $this->db->select('interview.*, ')
				->from('interview')
				->where('interview.id', $id)
				->get()->row();
		
		$this->render('interview/edit_interview_assessment');
	}
	
	
	/* SRRF */
	function add_srrf()
    {
        $this->mTitle .= 'SRRF';
        $this->render('interview/add_srrf');
    }
	
	function srrf_list()
	{
		$this->mViewData['srrf_list']  = $this->db->select('*')
				->from('srrf')
				->where('soft_delete', 0)
				->get()
				->result();
				
		$this->render('interview/srrf_list');
	}
	
	function edit_srrf($id = null){

		$id = $this->encrypt->decode(str_replace(array('-', '_', '~'), array('+', '/', '='), $id));
		$this->mViewData['employee_srrf'] = $this->global_model->get_srrf($id);
		
		$this->render('interview/edit_srrf');
	}
	
	// save Interview_Assessment 
	public function save_interview_assessment() {
		
		$userId = $this->ion_auth->get_user_id();
		
		$this->form_validation->set_rules('major[]', 'Education', 'trim|required|xss_clean');
		$this->form_validation->set_rules('company_name[]', 'Work Experience', 'trim|required|xss_clean');
		$this->form_validation->set_rules('skill_name[]', 'Additional Skills', 'trim|required|xss_clean'); 
		
		$this->form_validation->set_rules('lang1', 'Language Skills - English', 'trim|required|xss_clean');
		$this->form_validation->set_rules('lang2', 'Language Skills - Chinese', 'trim|required|xss_clean');
		
		$this->form_validation->set_rules('prof', 'Appearance/Personality - Professional', 'trim|required|xss_clean');
		$this->form_validation->set_rules('enthu', 'Appearance/Personality - Neatly', 'trim|required|xss_clean');
		$this->form_validation->set_rules('neat', 'Appearance/Personality - Respectful', 'trim|required|xss_clean');
		
		$this->form_validation->set_rules('energy', 'Commitment - Enthusiastic', 'trim|required|xss_clean');
		$this->form_validation->set_rules('respect', 'Commitment - Energetics', 'trim|required|xss_clean');
		$this->form_validation->set_rules('willing', 'Commitment - Willingness', 'trim|required|xss_clean');
		
		$this->form_validation->set_rules('current_salary', 'Current Salary', 'trim|required|xss_clean');
		$this->form_validation->set_rules('expected_salary', 'Expected Salary', 'trim|required|xss_clean');
		$this->form_validation->set_rules('int_status', 'Interview Status', 'trim|required|xss_clean');
		
		
		if ($this->form_validation->run()== TRUE) { 
	   
			$name   	 		= $this->input->post('name');
			$dob         		= $this->input->post('dob');
			$gender       		= $this->input->post('gender');
			$position 			= $this->input->post('position');
				
			$interview = array(
				'name'   			=> $name,
				'dob'         		=> $dob,
				'gender'       	   	=> $gender,
				'position'			=> $position,
			);
				
			
			$this->db->insert('interview', $interview);
			$id = $this->db->insert_id();
			
			// Education
			$description   = $this->input->post('description');
			$major         = $this->input->post('major');
			$college       = $this->input->post('college');
			$percentage    = $this->input->post('percentage');
				
			for ($i=0; $i < count($description); $i++) 
			{
				$education_background[] = array(
					'employee_id'   => $id,
					'description'   => $description[$i],
					'major'         => $major[$i],
					'college'       => $college[$i],
					'percentage'    => $percentage[$i],
				);
			}

			$this->db->insert_batch('education', $education_background);
			
			// Work Experience
			if(!empty($this->input->post('company_name'))){
				$company_name = $this->input->post('company_name');
				$title = $this->input->post('title');
				$duration = $this->input->post('duration');

				for ($i=0; $i < count($company_name); $i++) 
				{
					 $work_experience[] = array(
						'employee_id'    => $id,
						'company_name'   => $company_name[$i],
						'title'       	 => $title[$i],
						'duration'       => $duration[$i],
					);
				}	
			}
			
			// Additional Work Experience
			if(!empty($this->input->post('company_name1'))){
				$company_name1 = $this->input->post('company_name1');
				$title1 = $this->input->post('title1');
				$duration1 = $this->input->post('duration1');

				for ($i=0; $i < count($company_name1); $i++) 
				{
					 $work_experience1[] = array(
						'employee_id'    => $id,
						'company_name'   => $company_name1[$i],
						'title'       	 => $title1[$i],
						'duration'       => $duration1[$i],
					);
				}
			}
			
				
			if(!empty($work_experience)){
				$this->db->insert_batch('work_experience', $work_experience);
			}
			
			if(!empty($work_experience1)){
				$this->db->insert_batch('work_experience', $work_experience1);
			}
			
			// Skills
			$this->db->delete('skills', array('employee_id' => $id));
			
			$skill_name = $this->input->post('skill_name');
			$result = $this->input->post('result');
			
			for($i=0; $i < count($skill_name); $i++)
			{
				$skills[] = array(
					'employee_id'    => $id,
					'skill_name'  	 => $skill_name[$i],
					'result'  	     => $result[$i],
				);
			}				 
			$this->db->insert_batch('skills', $skills);
			
			$additional_skills = array(
					'employee_id'   	=> $id,
					'lang1'  	 		=> $this->input->post('lang1'),
					'lang2'  	 		=> $this->input->post('lang2'),
					'prof'          	=> $this->input->post('prof'),
					'enthu'   			=> $this->input->post('enthu'),
					'neat'    			=> $this->input->post('neat'),
					'energy'  			=> $this->input->post('energy'),
					'respect' 			=> $this->input->post('respect'),
					'willing'			=> $this->input->post('willing'),
					'current_salary'  	=> $this->input->post('current_salary'),
					'expected_salary' 	=> $this->input->post('expected_salary'),
					'int_status'      	=> $this->input->post('int_status'),
				);
				
			
			if($btn_type == 'add') {
				
				$this->db->where('candidate_id', $id);
				$query = $this->db->get('additional_skills');
				$count_row = $query->num_rows();
			
				if ($count_row == 0) {
					$this->db->insert('additional_skills', $additional_skills);
				}else{	
				
					$this->db->where('candidate_id', $id);	
					$this->db->update('additional_skills', $additional_skills);	
				}
				
				$this->message->save_success('admin/interview/add_interview_assessment/'. str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encrypt->encode($id)));
			}else{
				
				$this->message->save_success('admin/interview/add_interview_assessment/'. str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encrypt->encode($id)));
			}
		 } else {
			$error = validation_errors();
			$this->message->custom_error_msg('admin/interview/add_interview_assessment/'. str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encrypt->encode($id)) ,$error);
		} 
		   
	}	

		
	// update Interview_Assessment 
	public function update_interview_assessment() {
		
		$userId = $this->ion_auth->get_user_id();
		
        $id = $this->encrypt->decode(str_replace(array('-', '_', '~'), array('+', '/', '='), $this->input->post('id')));
		
        if(empty($id)){
            $this->message->norecord_found('admin/interview/interview_assessment_list');
        } 
		
		$this->form_validation->set_rules('major[]', 'Education', 'trim|required|xss_clean');
		$this->form_validation->set_rules('company_name[]', 'Work Experience', 'trim|required|xss_clean');
		$this->form_validation->set_rules('skill_name[]', 'Additional Skills', 'trim|required|xss_clean'); 
		
		$this->form_validation->set_rules('lang1', 'Language Skills - English', 'trim|required|xss_clean');
		$this->form_validation->set_rules('lang2', 'Language Skills - Chinese', 'trim|required|xss_clean');
		
		$this->form_validation->set_rules('prof', 'Appearance/Personality - Professional', 'trim|required|xss_clean');
		$this->form_validation->set_rules('enthu', 'Appearance/Personality - Neatly', 'trim|required|xss_clean');
		$this->form_validation->set_rules('neat', 'Appearance/Personality - Respectful', 'trim|required|xss_clean');
		
		$this->form_validation->set_rules('energy', 'Commitment - Enthusiastic', 'trim|required|xss_clean');
		$this->form_validation->set_rules('respect', 'Commitment - Energetics', 'trim|required|xss_clean');
		$this->form_validation->set_rules('willing', 'Commitment - Willingness', 'trim|required|xss_clean');
		
		$this->form_validation->set_rules('current_salary', 'Current Salary', 'trim|required|xss_clean');
		$this->form_validation->set_rules('expected_salary', 'Expected Salary', 'trim|required|xss_clean');
		$this->form_validation->set_rules('int_status', 'Interview Status', 'trim|required|xss_clean'); 
		
		
		if ($this->form_validation->run()== TRUE) { 
	   
			$name   	 		= $this->input->post('name');
			$dob         		= $this->input->post('dob');
			$gender       		= $this->input->post('gender');
			$position 			= $this->input->post('position');
				
			$interview = array(
				'name'   			=> $name,
				'dob'         		=> $dob,
				'gender'       	   	=> $gender,
				'position'			=> $position,
			);
			
			$this->db->where('id', $id);	
			$this->db->update('interview', $interview);	
			
			// Education
			$this->db->delete('education', array('candidate_id' => $id));
		
			$description   = $this->input->post('description');
			$major         = $this->input->post('major');
			$college       = $this->input->post('college');
			$percentage    = $this->input->post('percentage');
				
			for ($i=0; $i < count($description); $i++) 
			{
				$education_background[] = array(
					'candidate_id'  => $id,
					'description'   => $description[$i],
					'major'         => $major[$i],
					'college'       => $college[$i],
					'percentage'    => $percentage[$i],
				);
			}
			
			$this->db->insert_batch('education', $education_background);
			
			// Work experience
			$this->db->delete('work_experience', array('candidate_id' => $id));
			
			if(!empty($this->input->post('company_name'))){
				$company_name = $this->input->post('company_name');
				$title = $this->input->post('title');
				$duration = $this->input->post('duration');

				for ($i=0; $i < count($company_name); $i++) 
				{
					 $work_experience[] = array(
						'candidate_id'   => $id,
						'company_name'   => $company_name[$i],
						'title'       	 => $title[$i],
						'duration'       => $duration[$i],
					);
				}	
			} 
			
			// Dynamic add row work experience
			 if(!empty($this->input->post('company_name1'))){
				$company_name1 = $this->input->post('company_name1');
				$title1 = $this->input->post('title1');
				$duration1 = $this->input->post('duration1');

				for ($i=0; $i < count($company_name1); $i++) 
				{
					 $work_experience1[] = array(
						'candidate_id'   => $id,
						'company_name'   => $company_name1[$i],
						'title'       	 => $title1[$i],
						'duration'       => $duration1[$i],
					);
				}
			} 
			
			if(!empty($work_experience)){
				//$this->db->delete('work_experience', array('candidate_id' => $id));
				$this->db->insert_batch('work_experience', $work_experience);
			}
			
			if(!empty($work_experience1)){
				$this->db->insert_batch('work_experience', $work_experience1);
			}
			
			// Skills
			if(!empty($this->input->post('skill_name'))){
				
			$this->db->delete('skills', array('candidate_id' => $id));
			
			$skill_name = $this->input->post('skill_name');
			$result = $this->input->post('result');
			
			
				for($i=0; $i < count($skill_name); $i++)
				{
					$skills[] = array(
						'candidate_id'    => $id,
						'skill_name'  	 => $skill_name[$i],
						'result'  	     => $result[$i],
					);
				}				 
				$this->db->insert_batch('skills', $skills);
			}
			
			 $additional_skills = array(
					'candidate_id'   	=> $id,
					'lang1'  	 		=> $this->input->post('lang1'),
					'lang2'  	 		=> $this->input->post('lang2'),
					'prof'          	=> $this->input->post('prof'),
					'enthu'   			=> $this->input->post('enthu'),
					'neat'    			=> $this->input->post('neat'),
					'energy'  			=> $this->input->post('energy'),
					'respect' 			=> $this->input->post('respect'),
					'willing'			=> $this->input->post('willing'),
					'current_salary'  	=> $this->input->post('current_salary'),
					'expected_salary' 	=> $this->input->post('expected_salary'),
					'int_status'      	=> $this->input->post('int_status'),
				);
				
			
				$this->db->where('candidate_id', $id);
				$query = $this->db->get('additional_skills');
				$count_row = $query->num_rows();
			
				if ($count_row == 0) {
					$this->db->insert('additional_skills', $additional_skills);
				}else{	
				
					$this->db->where('candidate_id', $id);	
					$this->db->update('additional_skills', $additional_skills);	
				}
				
				$this->message->save_success('admin/interview/interview_assessment_list/'. str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encrypt->encode($id)));
		  } else {
			$error = validation_errors();
			$this->message->custom_error_msg('admin/interview/edit_interview_assessment/'. str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encrypt->encode($id)) ,$error);
		}  
		   
	}
	
	// save SRRF  
	public function save_srrf() {
		
		$userId = $this->ion_auth->get_user_id();
		 
		//$btn_type = $this->input->post('btn_type');
	    $this->form_validation->set_rules('job_title', 'Job Title', 'trim|required|xss_clean');
		$this->form_validation->set_rules('anti_start_date', 'Anti Start Date', 'trim|required|xss_clean');
		$this->form_validation->set_rules('proposed_salary', 'Proposed Salary Range', 'trim|required|xss_clean');
		$this->form_validation->set_rules('manager_submitting_request', 'Manager Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('phone', lang('phone'), 'trim|required|xss_clean|numeric|min_length[10]|max_length[12]');
		$this->form_validation->set_rules('email', lang('email'), 'trim|required|xss_clean|valid_email');
		$this->form_validation->set_rules('request', 'Request', 'trim|required|xss_clean');
		$this->form_validation->set_rules('comments', 'Comments', 'trim|required|xss_clean');
		
			$srrf_data = array(
				'job_title'  	 				=> $this->input->post('job_title'),
				'job_time'  	 				=> $this->input->post('job_time'),
				'anti_start_date'  				=> $this->input->post('anti_start_date'),
				'position'  	 				=> $this->input->post('position'),
				'proposed_salary'  				=> $this->input->post('proposed_salary'),
				'manager_submitting_request' 	=> $this->input->post('manager_submitting_request'),
				'phone'  	 					=> $this->input->post('phone'),
				'email'  	 					=> $this->input->post('email'),
				'request'  	 					=> $this->input->post('request'),
				'comments'  	 				=> $this->input->post('comments'),
			);
			
			 if ($this->form_validation->run()== TRUE) { 
			
				if(!empty($srrf_data)) {	
					$this->db->insert('srrf', $srrf_data);
				}	
					$this->message->save_success('admin/interview/srrf_list/'. str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encrypt->encode($id)));
				 } else {
					$error = validation_errors();;
					$this->message->custom_error_msg('admin/interview/add_srrf/'. str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encrypt->encode($id)) ,$error);
				} 
	}
		
	
	// save SRRF  
	public function update_srrf() {
		
		$userId = $this->ion_auth->get_user_id();
		 
		$id = $this->encrypt->decode(str_replace(array('-', '_', '~'), array('+', '/', '='), $this->input->post('id')));
		
		//$btn_type = $this->input->post('btn_type');
		
	    $this->form_validation->set_rules('job_title', 'Job Title', 'trim|required|xss_clean');
		$this->form_validation->set_rules('anti_start_date', 'Anti Start Date', 'trim|required|xss_clean');
		$this->form_validation->set_rules('proposed_salary', 'Proposed Salary Range', 'trim|required|xss_clean');
		$this->form_validation->set_rules('manager_submitting_request', 'Manager Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('phone', lang('phone'), 'trim|required|xss_clean|numeric|min_length[10]|max_length[12]');
		$this->form_validation->set_rules('email', lang('email'), 'trim|required|xss_clean|valid_email');
		$this->form_validation->set_rules('request', 'Request', 'trim|required|xss_clean');
		$this->form_validation->set_rules('comments', 'Comments', 'trim|required|xss_clean');
		
		
		$srrf_data = array(
		
			'job_title'  	 				=> $this->input->post('job_title'),
			'job_time'  	 				=> $this->input->post('job_time'),
			'anti_start_date'  				=> $this->input->post('anti_start_date'),
			'position'  	 				=> $this->input->post('position'),
			'proposed_salary'  				=> $this->input->post('proposed_salary'),
			'manager_submitting_request' 	=> $this->input->post('manager_submitting_request'),
			'phone'  	 					=> $this->input->post('phone'),
			'email'  	 					=> $this->input->post('email'),
			'request'  	 					=> $this->input->post('request'),
			'comments'  	 				=> $this->input->post('comments'),
				
		);
			
			
		if ($this->form_validation->run()== TRUE) { 
			
				$this->db->where('id', $id);
				$query = $this->db->get('srrf');
				$count_row = $query->num_rows();

				if (isset($count_row)) {
				
					$this->db->where('id', $id);
					$this->db->update('srrf', $srrf_data);	
				}
				
					$this->message->save_success('admin/interview/srrf_list/'. str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encrypt->encode($id)));
		} else {
					$error = validation_errors();;
					$this->message->custom_error_msg('admin/interview/edit_srrf/'. str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encrypt->encode($id)) ,$error);
		} 
	}
	
	function delete_srrf($id)
    {
		$id = $this->encrypt->decode(str_replace(array('-', '_', '~'), array('+', '/', '='), $id));
		$id == TRUE || $this->message->norecord_found('admin/interview/srrf_list');

        //delete
        $this->db->delete('srrf', array('id' => $id));
		$this->message->delete_success('admin/interview/srrf_list');
		
	}
		
		
}