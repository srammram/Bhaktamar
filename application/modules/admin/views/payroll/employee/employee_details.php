<link href='<?php echo base_url('assets/assets')?>/plugin/css/bootstrap/css/bootstrap.css' rel='stylesheet' media='screen'>
<link href='<?php echo base_url('assets/assets')?>/plugin/select2/select2.min.css' rel='stylesheet' media='screen'>
<link href='<?php echo base_url('assets/assets')?>/css/AdminLTE.css' rel='stylesheet' media='screen'>
<link href='<?php echo base_url('assets/assets')?>/css/custom.css' rel='stylesheet' media='screen'>
<link href='<?php echo base_url('assets/assets')?>/css/skins.css' rel='stylesheet' media='screen'>
<div class="row profile">
    <div class="col-md-3">
        <div class="profile-sidebar">
            <!-- SIDEBAR USERPIC -->
            <div class="profile-userpic">
                <!-- <img src="<?php echo $employee->photo !='' ? site_url(UPLOAD_EMPLOYEE.$employee->employee_id.'/'.$employee->photo) : site_url(IMAGE.'client.png') ?>" class="img-responsive" alt="">-->
            </div>
            <!-- END SIDEBAR USERPIC -->
            <!-- SIDEBAR USER TITLE -->
            <div class="profile-usertitle">
                <div class="profile-usertitle-name">
                    <?php echo $employee->first_name.' '.$employee->last_name ?>
                </div>
                <?php if($employee->termination){?>
                <div class="profile-usertitle-job">
                    <?= lang('employee_id') ?> : <?php echo $employee->employee_id ?>
                </div>
                <?php }else{ ?>
                <div class="profile-usertitle-job">
                    <?= lang('employee_id') ?> : <strong style="color: RED"><?= lang('terminated') ?></strong>
                </div>
                <?php } ?>
            </div>
            <!-- END SIDEBAR USER TITLE -->
            <!-- SIDEBAR BUTTONS -->
            <div class="profile-userbuttons">
                <?php if($employee->termination){?>
                <a data-target="#modalSmall" data-placement="top" data-toggle="modal"
                    href="<?php echo base_url()?>admin/payroll/employee/termination/<?php echo $employee->id ?>"
                    class="btn btn-danger btn-sm">
                    <?= lang('termination') ?>
                </a>
                <?php }else{ ?>
                <a href="<?php echo base_url()?>admin/payroll/employee/reJoin/<?php echo $employee->id ;?>"
                    class="btn bg-navy btn-sm">
                    <?= lang('re_join_employment') ?>
                </a>
                <?php } ?>
            </div>
            <!-- END SIDEBAR BUTTONS -->
            <!-- SIDEBAR MENU -->
            </br>

            <?php if($employee->termination == 0){?>
            <a href="<?php echo site_url('admin/payroll/employee/employeeDetails?tab=termination/'. $employee->id); ?>"
                class="btn btn-block btn-flat bg-maroon text-left"><?= lang('termination_note') ?></a>
            <?php }?>
            <div class="profile-usermenu">
                <ul class="nav">
                    <li class="<?php if($tab == 'personal') echo 'active' ?>">
                        <a
                            href="<?php echo site_url('admin/payroll/employee/employeeDetails?tab=personal/'. $employee->id); ?>"><?= lang('personal_details') ?></a>
                    </li>
                    <li class="<?php if($tab == 'contact') echo 'active' ?>">
                        <a
                            href="<?php echo site_url('admin/payroll/employee/employeeDetails?tab=contact/'.$employee->id); ?>"><?= lang('contact_details') ?></a>
                    </li>
                    <li class="<?php if($tab == 'dependents') echo 'active' ?>">
                        <a
                            href="<?php echo site_url('admin/payroll/employee/employeeDetails?tab=dependents/'.$employee->id); ?>"><?= lang('dependents') ?></a>
                    </li>
                    <li class="<?php if($tab == 'job') echo 'active' ?>">
                        <a
                            href="<?php echo site_url('admin/payroll/employee/employeeDetails?tab=job/'.$employee->id); ?>"><?= lang('job') ?></a>
                    </li>
                    <li class="<?php if($tab == 'salary') echo 'active' ?>">
                        <a
                            href="<?php echo site_url('admin/payroll/employee/employeeDetails?tab=salary/'.$employee->id); ?>"><?= lang('salary') ?></a>
                    </li>
                 <!--   <li class="<?php if($tab == 'report') echo 'active' ?>">
                        <a
                            href="<?php echo site_url('admin/payroll/employee/employeeDetails?tab=report/'.$employee->id); ?>"><?= lang('report-to') ?></a>
                    </li>-->
                    <li class="<?php if($tab == 'deposit') echo 'active' ?>">
                        <a
                            href="<?php echo site_url('admin/payroll/employee/employeeDetails?tab=deposit/'.$employee->id); ?>"><?= lang('direct_deposit') ?></a>
                    </li>
                    <li class="<?php if($tab == 'login') echo 'active' ?>">
                        <a
                            href="<?php echo site_url('admin/payroll/employee/employeeDetails?tab=login/'.$employee->id); ?>"><?= lang('login') ?></a>
                    </li>
                    <!--<li class="<?php if($tab == 'EIF') echo 'active' ?>">
                            <a href="<?php echo site_url('admin/payroll/employee/employeeDetails?tab=EIF/'.$employee->id); ?>"><?= lang('eif') ?></a>
                        </li>
						<li class="<?php if($tab == 'Probationary_performance') echo 'active' ?>">
                            <a href="<?php echo site_url('admin/payroll/employee/employeeDetails?tab=Probationary_performance/'.$employee->id); ?>"><?= lang('probationary_performance') ?></a>
                        </li>
						<li class="<?php if($tab == 'edit_appraisal') echo 'active' ?>">
                            <a href="<?php echo site_url('admin/payroll/employee/employeeDetails?tab=edit_appraisal/'.$employee->id); ?>"><?= lang('performance_appraisal') ?></a>
                        </li>
						<!--
						<li class="<?php // if($tab == 'SRRF') echo 'active' ?>">
                            <a href="<?php // echo site_url('admin/employee/employeeDetails?tab=SRRF/'.str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encrypt->encode($employee->id))); ?>"><?php // echo lang('view/edit_srrf') ?></a>
						</li>
						<li class="<?php // if($tab == 'Add_Interview_Assessment') echo 'active' ?>">
                            <a href="<?php // echo site_url('admin/employee/employeeDetails?tab=Add_Interview_Assessment/'.str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encrypt->encode($employee->id))); ?>"><?php // echo lang('add_interview_assessment') ?></a>
                        </li>
						 <li class="<?php // if($tab == 'Interview_Assessment') echo 'active' ?>">
                            <a href="<?php // echo site_url('admin/employee/employeeDetails?tab=Interview_Assessment/'.str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encrypt->encode($employee->id))); ?>"><?php // echo lang('view/edit_interview_assessment') ?></a>
                        </li> -->
                    <!-- <li class="<?php // if($tab == 'Add_SRRF') echo 'active' ?>">
                            <a href="<?php // echo site_url('admin/employee/employeeDetails?tab=Add_SRRF/'.str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encrypt->encode($employee->id))); ?>"><?php // echo lang('add_srrf') ?></a>
						</li> -->
                    <!-- <li class="<?php // if($tab == 'Add_EIF') echo 'active' ?>">
                            <a href="<?php // echo site_url('admin/employee/employeeDetails?tab=Add_EIF/'.str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encrypt->encode($employee->id))); ?>"><?php // echo lang('add_eif') ?></a>
                        </li> -->
                    <!-- <li class="<?php // if($tab == 'Add_Probationary_performance') echo 'active' ?>">
                            <a href="<?php  // echo site_url('admin/employee/employeeDetails?tab=Add_Probationary_performance/'.str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encrypt->encode($employee->id))); ?>"><?php // echo lang('add_probationary_performance') ?></a>
                        </li> -->
                    <!-- <li class="<?php // if($tab == 'add_appraisal') echo 'active' ?>">
                            <a href="<?php // echo site_url('admin/employee/employeeDetails?tab=add_appraisal/'.str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encrypt->encode($employee->id))); ?>"><?php // echo lang('add_performance_appraisal') ?></a>
                        </li> -->

                </ul>
            </div>
            <!-- END MENU -->
        </div>
    </div>

    <div class="col-md-9">
        <?php echo $tab_view; ?>
    </div>

</div>
<script>
$('form').attr('autocomplete', 'off');
</script>