<?php
$id = $this->ion_auth->user()->row()->id;

$mail = $this->db->get_where('inbox', array(
			'to_emp_id' => $id,
			'to_type' => 'admin',
			'reading' => 0,
	))->result();

$totalMail = count($mail);


?>
<header class="main-header">

	<!-- Logo -->
	<a href="<?php echo site_url('admin') ?>" class="logo">
		<!-- mini logo for sidebar mini 50x50 pixels -->
		<span class="logo-mini"><?= get_option('brand') ?></span>
		<!-- logo for regular state and mobile devices -->
		<span class="logo-lg"><?= get_option('brand') ?></span>
	</a>

	<!-- Header Navbar -->
	<nav class="navbar navbar-static-top" role="navigation">
		<!-- Sidebar toggle button-->
		<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
			<span class="sr-only">Toggle navigation</span>
		</a>
		<!-- Navbar Right Menu -->
		<div class="navbar-custom-menu">
			<ul class="nav navbar-nav">
				<!-- Messages: style can be found in dropdown.less-->
				<!--<li class="dropdown messages-menu">
					<!-- Menu toggle button 
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-envelope-o"></i>
						<span class="label label-success"><?php echo $totalMail ?></span>
					</a>
					<ul class="dropdown-menu">
						<li class="header"><?= lang('you_have') ?> <?php echo $totalMail ?> <?= lang('messages') ?></li>
						<li>
							<!-- inner menu: contains the messages -->
							
							<!--<ul class="menu">
							<?php if($totalMail) { foreach($mail as $item){ ?>

								<li><!-- start message -->
									<a href="<?php echo base_url('admin/mail/viewEmail').'/'.str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encrypt->encode($item->id)) ?>">
										<!-- Message title and timestamp -->
										<h4><?php echo substr($item->subject,0,20) ?></h4>
										<!-- The message 
										<p><?php echo substr(strip_tags($item->msg),0,40) ?></p>
									</a>
								</li>
							<?php } } ?>

								<!-- end message 
							</ul>-->
							<!-- /.menu 
						</li>
						<li class="footer"><a href="<?php echo site_url('admin/mail') ?>"><?= lang('see_all_msg') ?></a></li>
					</ul>
				</li>-->
				<!-- /.messages-menu -->

				<?php if($this->ion_auth->in_group(array('admin','hr'))) {

					$leave_application = $this->db->select('leave_application.*, employee.first_name, employee.last_name, employee.employee_id, leave_application_type.leave_category')
							->from('leave_application')
							->join('employee', 'employee.id = leave_application.employee_id', 'left')
							->join('leave_application_type', 'leave_application_type.id = leave_application.leave_ctegory_id', 'left')
							->where('Read_id',0)
							->where('leave_application.Soft_delete',0)
							->get()
							->result();
					$leave_application_count = count($leave_application);
					
					$interview_assessment = $this->db->select('*')
							->from('interview')
							//->join('employee', 'employee.id = additional_skills.employee_id', 'left')
							->where('read_id',0)
							->get()
							->result();
					$interview_assessment_count= count($interview_assessment);
					
					$srrf = $this->db->select('*')
							->from('srrf')
							//->join('employee', 'employee.id = srrf.employee_id', 'left')
							->where('read_id',0)
							->get()
							->result();
					$srrf_count= count($srrf);
					
					$eif = $this->db->select('eif.*, employee.first_name, employee.last_name')
							->from('eif')
							->join('employee', 'employee.id = eif.employee_id', 'left')
							->where('read_id',0)
							->get()
							->result();
					$eif_count= count($eif);
					
					$probationary_performance = $this->db->select('probationary_performance.*, employee.first_name, employee.last_name')
							->from('probationary_performance')
							->join('employee', 'employee.id = probationary_performance.employee_id', 'left')
							->where('read_id',0)
							->get()
							->result();
					$probationary_performance_count= count($probationary_performance);
					
					$performance_appraisal = $this->db->select('appraisal.*, employee.first_name, employee.last_name')
							->from('appraisal')
							->join('employee', 'employee.id = appraisal.employee_id', 'left')
							->where('read_id',0)
							->get()
							->result();
					$performance_appraisal_count= count($performance_appraisal);
					$totalApplication = $leave_application_count + $interview_assessment_count + $srrf_count + $eif_count + $probationary_performance_count+ $performance_appraisal_count;

				?>
				<!-- Notifications Menu -->
				<li class="dropdown notifications-menu">
					<!-- Menu toggle button -->
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-flag-o"></i>
						<span class="label label-warning"><?php echo $totalApplication ?></span>
					</a>
					<ul class="dropdown-menu">
						<li class="header"><?= lang('you_have') ?> <?php echo $totalApplication ?> <?= lang('notifications') ?></li>
						<li>
							<!-- Inner Menu: contains the notifications -->
							<ul class="menu">
							<!-- start notification -->
								<?php if($leave_application_count) { foreach($leave_application as $item){ ?>
								<li>
									<a href="<?php echo site_url('admin/Employee/viewApplication/'. str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encrypt->encode($item->id))) ?>">
										<?php echo  $item->first_name.' '.$item->last_name.' - Leave Request'  ?>
										<p><?php echo  $item->leave_category ?> on <?php echo date(get_option('date_format'), strtotime($item->start_date)) ?></p>
									</a>
								</li>
								<?php } } ?>
								
								<?php if($interview_assessment_count) { foreach($interview_assessment as $item){ ?>
								<li>
								
									<a href="<?php echo site_url('admin/interview/edit_interview_assessment/'. str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encrypt->encode($item->id))) ?>">
										<?php echo $item->name.' - Interview Assessment'  ?>
										<p>Submitted on <?php echo date(get_option('date_format'), strtotime($item->created_on)) ?></p>
									</a>
								</li>
								<?php } } ?>
								
								<?php if($srrf_count) { foreach($srrf as $item){ ?>
								<li>
								
									<a href="<?php echo site_url('admin/interview/add_srrf/'. str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encrypt->encode($item->id))) ?>">
										<?php echo $item->job_title.' - SRRF'  ?>
										<p>Submitted on <?php echo date(get_option('date_format'), strtotime($item->created_on)) ?></p>
									</a>
								</li>
								<?php } } ?>
								
								<?php if($eif_count) { foreach($eif as $item){ ?>
								<li>
								
									<a href="<?php echo site_url('admin/Employee/employeeDetails?tab=EIF/'. str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encrypt->encode($item->employee_id))) ?>">
										<?php echo $item->first_name.' '.$item->last_name.' - EIF'  ?>
										<p>Submitted on <?php echo date(get_option('date_format'), strtotime($item->created_on)) ?></p>
									</a>
								</li>
								<?php } } ?>
								
								<?php if($probationary_performance_count) { foreach($probationary_performance as $item){ ?>
								<li>
								
									<a href="<?php echo site_url('admin/Employee/employeeDetails?tab=Probationary_performance/'. str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encrypt->encode($item->employee_id))) ?>">
										<?php echo $item->first_name.' '.$item->last_name.' - Probationary Performance'  ?>
										<p>Submitted on <?php echo date(get_option('date_format'), strtotime($item->created_on)) ?></p>
									</a>
								</li>
								<?php } } ?>
								
								<?php if($performance_appraisal_count) { foreach($performance_appraisal as $item){ ?>
								<li>
								
									<a href="<?php echo site_url('admin/Employee/employeeDetails?tab=edit_appraisal/'. str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encrypt->encode($item->employee_id))) ?>">
										<?php echo $item->first_name.' '.$item->last_name.' - Performance Appraisal'  ?>
										<p>Submitted on <?php echo date(get_option('date_format'), strtotime($item->created_on)) ?></p>
									</a>
								</li>
								<?php } } ?>
								<!-- end notification -->
							</ul>
						</li>
						
						
						<li class="footer"><a href="<?php echo site_url('admin/employee/applicationList') ?>"><?= lang('view_all') ?></a></li>
					</ul>
				</li>
				<!-- Tasks Menu -->
				<?php } ?>

				<!-- User Account Menu -->
				<li>
					<a href="panel/logout" ><i class="fa fa-power-off"></i></a>
				</li>


				<!-- Control Sidebar Toggle Button -->
<!--				<li>-->
<!--					<a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>-->
<!--				</li>-->
			</ul>
		</div>
	</nav>
</header>
