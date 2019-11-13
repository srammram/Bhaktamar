<link rel="stylesheet" href="<?php echo base_url('assets/admin') ?>/dist/css/dropzone.css">
<link href="<?php echo base_url('assets/admin') ?>/dist/css/summernote.css" rel="stylesheet">
<script src="<?php echo base_url('assets/admin') ?>/dist/js/summernote.js"></script>
<link rel="stylesheet" href="<?php echo base_url('assets/admin') ?>/dist/css/building_board.css">
<link rel="stylesheet" href="<?php echo base_url('assets/admin') ?>/dist/css/chosen.min.css">
<script src="<?php echo base_url('assets/admin') ?>/dist/js/chosen.jquery.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url('assets/admin') ?>/dist/css/bootstrap-datepicker.min.css">
<script>
$(document).ready(function() {
    oTable = $('#milestonetable').dataTable({
        "aaSorting": [
            [3, "asc"],
            [1, "asc"]
        ],
        "aLengthMenu": [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "<?=lang('all')?>"]
        ],
        "iDisplayLength": 10,
        'bProcessing': true,
        'bServerSide': true,
        'sAjaxSource': "<?php echo base_url() ?>" + 'admin/building/getMilstone/',
        'fnServerData': function(sSource, aoData, fnCallback) {
            $.ajax({
                'dataType': 'json',
                'type': 'POST',
                'url': sSource,
                'data': aoData,
                'success': fnCallback
            });
        },
        "aoColumns": [{
            "bSortable": false
        }, null, null, null, {
            "bSortable": false
        }]
    });
});
</script>
<style>
.dataTables_length {
    float: left;
}

.dataTables_filter {
    float: right;
}

.dataTables_info {
    float: left;
}

.dataTables_paginate {
    float: right;
}

.dataTables_filter input {
    height: 30px;
    padding: 0px;
}

.dataTables_length select {
    height: 30px;
    padding: 0px;
}

.box {
    padding-bottom: 15px;
}

.table-bordered>thead>tr>th {
    background-color: #FFF !important;
    color: black !important;
}

.nav-pills>li.active>a,
.nav-pills>li.active>a:focus,
.nav-pills>li.active>a:hover {
    color: #00c292 !important;
    background-color: aliceblue;
    border-bottom: 1px solid 00c292 !important;
    border-top-color: #00c292 !important;
}

.btn-success,
.btn-success.disabled {
    margin: 13px !important;
}

.milestones .ribbon-corner:before {
    border: 23px solid transparent;
    border-top-color: #ff6849;
    border-left-color: #ff6849;
    font-size: 12px;
}

.ribbon-corner:before {
    position: absolute;
    top: 0;
    left: 0;
    width: 0;
    height: 0;
    content: '';
    border: 30px solid transparent;
    border-top-color: #ff6849;
    border-left-color: #ff6849;
}

.milestones {
    padding: 25px 15px 15px 50px;
    font-size: 12px;
}

.ribbon-wrapper,
.ribbon-wrapper-bottom,
.ribbon-wrapper-reverse,
.ribbon-wrapper-right-bottom {
    position: relative;
    background: #edf1f5;
    padding: 20px 15px 15px 50px;
}

.bg-white {
    background-color: #fff !important;
}

.milestone-count {
    position: relative;
}
</style>
<section class="content-header">
    <h4>
        Building Details
    </h4>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i>
                <?php echo lang('dashboard') ?></a></li>
        <li><a href="<?php echo site_url('admin/building') ?>"> <?php echo lang('building') ?> </a></li>

    </ol>
</section>
<section class="prj_sec">
    <div class="row">
        <div class="col-sm-12">
            <div id="exTab1">
                <ul class="nav nav-pills">
                    <li <?php if (empty($this->uri->segment(5))) {echo 'class="active"';}?>><a href="#1a"
                            data-toggle="tab">Overview</a></li>
                    <li <?php if ($this->uri->segment(5) == 'Members') {echo 'class="active"';}?>><a href="#2a"
                            data-toggle="tab">Members</a></li>
                    <li <?php if ($this->uri->segment(5) == 'Tasks') {echo 'class="active"';}?>><a href="#7a"
                            data-toggle="tab">Tasks</a></li>
                    <li <?php if ($this->uri->segment(5) == 'Milestone') {echo 'class="active"';}?>><a href="#3a"
                            data-toggle="tab">Milestone</a></li>
                    <li <?php if ($this->uri->segment(5) == 'Files') {echo 'class="active"';}?>><a href="#4a"
                            data-toggle="tab">Files</a></li>
                    <!--    <li <?php if ($this->uri->segment(5) == 'Invoices') {echo 'class="active"';}?>><a href="#5a" data-toggle="tab">Invoices</a></li>-->
                    <!--    <li <?php if ($this->uri->segment(5) == 'Time Logs') {echo 'class="active"';}?>><a href="#6a" data-toggle="tab">Time Logs</a></li>-->
                </ul>

                <div class="tab-content clearfix">
                    <div class="tab-pane <?php if (empty($this->uri->segment(5))) {echo 'active';}?>" id="1a">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="white-box" id="project-milestones">
                                    <h3 class="box-title"><i class="fa fa-flag"></i> Milestones
                                        <a href="<?php echo site_url('admin/building/building_board/'.$buildingid.'/Milestone'); ?>"
                                            class="text-success pull-right"><i class="fa fa-plus"></i>
                                            Create Milestone</a>
                                    </h3>
                                    <?php $i=1; if(!empty($milestone)){   foreach($milestone as $row){ ?>
                                    <div class="ribbon-wrapper  bg-white b-all m-b-15 milestones"
                                        style="border:1px solid #e4e7ea;margin-bottom:10px;">
                                        <div class="ribbon ribbon-corner"><span
                                                class="milestone-count">#<?php   echo $i;  ?></span></div>
                                        <div class="ribbon-content">
                                            <h5 class="media-heading text-info font-light">
                                                <a href="javascript:;" class="milestone-detail"
                                                    data-milestone-id="1"><?php echo $row->title ;   ?>
                                                </a>
                                            </h5>
                                            <div class="row m-t-20 m-b-10">
                                                <div class="col-xs-6">
                                                    <label
                                                        class="label label-danger"><?php echo $row->status ;   ?></label>
                                                </div>
                                                <div class="col-xs-6 text-right">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php  $i++; } }  ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="white-box">
                                    <h3 class="box-title b-b"><i class="fa fa-clock-o"></i> Active Timers</h3>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Who's Working</th>
                                                    <th>Active Since</th>
                                                    <th>&nbsp;</th>
                                                </tr>
                                            </thead>
                                            <tbody id="timer-list">
                                                <tr>
                                                    <td colspan="3">No active timer.</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-lg-12 col-sm-12">
                                <div class="white-box">
                                    <div class="row">
                                        <div class="col-lg-3 col-sm-6 row-in-br">
                                            <div class="col-in row">
                                                <div class="col-md-6 col-sm-6 col-xs-6 row-in">
                                                    <i class="fa fa-th-list" aria-hidden="true"></i>
                                                    <h5 class="text-muted vb">Open Tasks</h5>
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-6">
                                                    <h3 class="counter text-right m-t-15 text-danger">
                                                        <?php if(!empty($incompletedTask)){ echo count($incompletedTask); }  ?>
                                                    </h3>
                                                </div>
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <div class="progress">
                                                        <?php $buildingTasks=!empty($buildingTask)? count($buildingTask):0;
                                                        $incompletetask=!empty($incompletedTask)?count($incompletedTask):0;
                                                          $percentage=(100/$buildingTasks)*$incompletetask;   ?>
                                                        <div class="progress-bar progress-bar-danger" role="progressbar"
                                                            aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"
                                                            style="width:<?php echo $percentage;  ?>%"><span
                                                                class="sr-only"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-sm-6 row-in-br">
                                            <div class="col-in row">
                                                <div class="col-md-6 col-sm-6 col-xs-6 row-in">
                                                    <i class="fa fa-calendar"></i>
                                                    <h5 class="text-muted vb">Days Left</h5>
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-6">
                                                    <h3 class="counter text-right m-t-15 text-info">
                                                        <?php   if(!empty($building->planned_completion_date)){ 
                                                     $now = time(); $enddate = strtotime($building->planned_completion_date);
                                                    $datediff = $now - $enddate; echo round($datediff / (60 * 60 * 24));    }else{ echo 0 ;} ?>
                                                    </h3>
                                                </div>
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <div class="progress">
                                                        <div class="progress-bar progress-bar-info" role="progressbar"
                                                            aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"
                                                            style="width: 25%"><span class="sr-only"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-sm-6 row-in-br">
                                            <div class="col-in row">
                                                <div class="col-md-6 col-sm-6 col-xs-6 row-in"><i
                                                        class="glyphicon glyphicon-time"></i>
                                                    <h5 class="text-muted vb">Hours Logged</h5>
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-6">
                                                    <h3 class="counter text-right m-t-15 text-success">0</h3>
                                                </div>
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <div class="progress">
                                                        <div class="progress-bar progress-bar-success"
                                                            role="progressbar" aria-valuenow="40" aria-valuemin="0"
                                                            aria-valuemax="100" style="width: 100%"><span
                                                                class="sr-only">100% Complete (success)</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php 
                                                          $percentage=((100/$buildingTasks))*($buildingTasks-$incompletetask); 
                                                          ?>
                                        <div class="col-lg-3 col-sm-6  b-0">
                                            <div class="col-in row">
                                                <div class="col-md-6 col-sm-6 col-xs-6 row-in"><i
                                                        class="glyphicon glyphicon-alert"></i>
                                                    <h5 class="text-muted vb">Completion</h5>
                                                </div>
                                                <h3 class="counter text-right m-t-15 text-danger">
                                                    <?php echo $percentage;  ?>%</h3>
                                            </div>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="progress">

                                                    <div class="progress-bar progress-bar-danger" role="progressbar"
                                                        aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"
                                                        style="width:<?php echo $percentage;  ?>%">><span
                                                            class="sr-only"><?php echo $percentage;  ?>% Complete
                                                            (success)</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="white-box bg-inverse p-t-10 p-b-10">
                                    <h3 class="box-title text-white">Building Budget</h3>
                                    <ul class="list-inline two-part">
                                        <li><i class="fa fa-money text-white"></i></li>
                                        <li class="text-right"><span id="totalProjects" class="text-white">
                                                --
                                            </span></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="white-box bg-success p-t-10 p-b-10">
                                    <h3 class="box-title text-white">Earnings
                                        <a class="mytooltip" href="javascript:void(0)"> <i
                                                class="fa fa-info-circle text-white"></i><span
                                                class="tooltip-content5"></span></a>
                                    </h3>
                                    <ul class="list-inline two-part">
                                        <li><i class="fa fa-money text-white"></i></li>
                                        <li class="text-right"><span id="totalProjects" class="text-white">0</span></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="white-box bg-info p-t-10 p-b-10">
                                    <h3 class="box-title text-white">Hours Allocated</h3>
                                    <ul class="list-inline two-part">
                                        <li><i class="fa fa-clock-o text-white"></i></li>
                                        <li class="text-right"><span id="totalProjects" class="text-white">
                                            </span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Open Tasks</div>
                                            <div class="panel-wrapper collapse in">
                                                <div class="panel-body">
                                                    <ul class="list-task list-group" data-role="tasklist">
                                                        <li class="list-group-item" data-role="task">
                                                            <strong>Title</strong> <span class="pull-right"><strong>Due
                                                                    Date</strong></span>
                                                        </li>
                                                        <?php  if(!empty($incompletedTask)){ foreach($incompletedTask as $row){  ?>
                                                        <li class="list-group-item row" data-role="task">
                                                            <div class="col-xs-8">
                                                                <?php echo   $row->taskName;   ?>
                                                            </div>
                                                            <label
                                                                class="label label-danger pull-right col-xs-4"><?php echo   $row->end_date;   ?></label>
                                                        </li>
                                                        <?php  } }else{?>
                                                        <li class="list-group-item" data-role="task">No open tasks.</li>
                                                        <?php }   ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Members</div>
                                            <div class="panel-wrapper collapse in">
                                                <div class="panel-body">
                                                    <div class="message-center">
                                                        <?php  if(!empty($building_members)){
                                                            foreach ($building_members as $row) {  ?>
                                                        <a href="#">
                                                            <div class="user-img">
                                                                <img src="<?php echo base_url('assets/admin/dist/img/default-profile-2.png') ?>"
                                                                    alt="user" class="img-circle" width="40"
                                                                    height="40">

                                                            </div>
                                                            <div class="mail-contnet">
                                                                <h5> <?php   echo $row->first_name .' '.$row->last_name  ; ?></h5>
                                                                <span
                                                                    class="mail-desc"><?php  if(!empty($row->email)){ echo $row->email; }else{ '';}    ?></span>
                                                            </div>
                                                        </a>
                                                        <?php }
                                                        }  ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">



                                    <div class="col-md-6">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Files</div>
                                            <div class="panel-wrapper collapse in">
                                                <div class="panel-body">
                                                    <ul class="list-task list-group" data-role="tasklist">
                                                        <li class="list-group-item" data-role="task">
                                                            You have not uploaded any file. </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-3" id="project-timeline">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Activity Timeline</div>
                                    <div class="panel-wrapper collapse in">
                                        <div class="panel-body">
                                            <div class="steamline">
                                                <?php  if(!empty($buildingactivity)){
                                                   foreach ($buildingactivity as $row) { ?>
                                                <div class="sl-item">
                                                    <div class="sl-left"><i class="fa fa-circle text-info"></i>
                                                    </div>
                                                    <div class="sl-right">
                                                        <div>
                                                            <h6><?php echo $row->name;  ?></h6> <span class="sl-date">
                                                                <?php   echo get_timeago(strtotime($row->timestamp) ).'<br>'; ?>


                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php   }
                                               }?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="tab-pane <?php if ($this->uri->segment(5) == 'Members') {echo 'active';}?>" id="2a">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Members</div>
                                    <div class="panel-wrapper collapse in">
                                        <div class="panel-body">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th></th>
                                                        <th>User Role</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php   if(!empty($building_members)){
                                                        foreach ($building_members as $row) {  ?>
                                                    <tr>
                                                        <td>
                                                            <img src="<?php echo base_url('assets/admin/dist/img/default-profile-2.png') ?>"
                                                                alt="user" class="img-circle" width="40">
                                                            <?php   echo $row->first_name .' '.$row->last_name  ; ?>
                                                        </td>
                                                        <td>
                                                            <p style="color:GREEN;">
                                                                <?php   if($row->is_lead ==1){  echo 'LEAD' ;}  ?></p>
                                                        </td>
                                                        <td>
                                                            <div class="radio radio-info">
                                                                <label
                                                                    for="project_admin_91"><?php  echo $row->labour;   ?>
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td><a class="btn btn-sm btn-danger btn-rounded delete-members"
                                                                onclick='removeMembers(<?php echo  $row->id;   ?>)'><i
                                                                    class="fa fa-times"></i> Remove</a></td>
                                                    </tr>
                                                    <?php  }
                                                    }  ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="white-box">
                                    <h3>Add Members</h3>
                                    <form method="POST" action="<?php echo site_url('admin/building/members_save/'); ?>"
                                        class="ajax-form" id="membersadd">
                                        <div class="form-body">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label>Member</label>
                                                </div>
                                                <div class="col-md-12">
                                                    <select class="form-control " name="members">
                                                        <?php if ($employee) {foreach ($employee as $row) {?> <option
                                                            value="<?php echo $row->id; ?>">
                                                            <?php echo $row->first_name . '-' . $row->last_name; ?>
                                                        </option>

                                                        <?php	}}?>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>Role</label>
                                            </div>
                                            <div class="col-md-12">
                                                <select class="form-control " name="labourtype">
                                                    <?php if ($labourtype) {foreach ($labourtype as $row) {?> <option
                                                        value="<?php echo $row->id; ?>">
                                                        <?php echo $row->Name; ?></option>
                                                    <?php	}}?>
                                                </select>
                                            </div>
                                            <div class="form-actions">
                                                <button type="submit" id="save-members" class="btn btn-success"><i
                                                        class="fa fa-check"></i> Save </button>
                                                <input type="hidden" name="buildingid"
                                                    value="<?php echo $buildingid; ?>">
                                                <input type="hidden" name="projectid"
                                                    value="<?php echo $project_id; ?>">
                                            </div>
                                        </div>
                                    </form>
                                    <hr>
                                    <h3>Assign Lead</h3>
                                    <form method="POST" action="<?php echo site_url('admin/building/assignlead/'); ?>"
                                        accept-charset="UTF-8" id="saveGroup" class="ajax-form">
                                        <div class="form-body">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <select class="form-control " name="members">
                                                        <?php if ($building_members) {foreach ($building_members as $row) {?>
                                                        <option value="<?php echo $row->employee_id; ?>">
                                                            <?php echo $row->first_name . '-' . $row->last_name; ?>
                                                        </option>

                                                        <?php	}}?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-actions">
                                                <button type="submit" id="save-group" class="btn btn-success"><i
                                                        class="fa fa-check"></i> Save </button>
                                                <input type="hidden" name="buildingid"
                                                    value="<?php echo $buildingid; ?>">
                                                <input type="hidden" name="projectid"
                                                    value="<?php echo $project_id; ?>">
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane <?php if ($this->uri->segment(5) == 'Tasks') {echo 'active';}?>" id="7a">
                        <div class="row">
                            <div class="col-md-6" id="task-list-panel">
                                <div class="white-box">
                                    <h4><b>Tasks</b></h4>

                                    <div class="row m-b-10">
                                        <div class="col-md-5">
                                            <a href="javascript:;" id="show-new-task-panel"
                                                class="btn btn-success btn-outline"><i class="fa fa-plus"></i> New
                                                Task</a>
                                        </div>
                                    </div>

                                    <!--  <div class="row m-b-10">
                                    <div class="col-md-5">
                                        <div class="checkbox checkbox-info">
                                            <input type="checkbox" id="hide-completed-tasks">
                                            <label for="hide-completed-tasks">Hide Completed Tasks</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row m-b-10">
                                    <div class="col-md-5">
                                        <select class="form-control">
                                            <option value="id">Last Created</option>
                                            <option value="due_date">Due Soon</option>
                                        </select>
                                    </div>
                                </div>-->

                                    <ul class="list-group">
                                        <?php   if(!empty($buildingTask)){ foreach($buildingTask as $row){ ?>
                                        <li class="list-group-item ">
                                            <div class="row">
                                                <div class="checkbox checkbox-success checkbox-circle task-checkbox col-md-10  "
                                                    onclick='getTaskEdit(<?php echo  $row->id;   ?>)'>
                                                    <input class="task-check" data-task-id="" id="checkbox57"
                                                        type="checkbox">
                                                    <label for="checkbox57">&nbsp;</label>
                                                    <a href="javascript:;" class="text-muted edit-task"
                                                        data-task-id="57"><?php echo  $row->taskName;   ?></a>
                                                </div>
                                                <div class="col-md-2 text-right">
                                                    <span
                                                        class=" text-danger  m-r-10"><?php echo  date('d-M',strtotime($row->start_date));   ?></span>
                                                    <img data-toggle="tooltip"
                                                        src="<?php echo base_url('assets/admin/dist/img/default-profile-2.png') ?>"
                                                        alt="user" class="img-circle" height="35">
                                                </div>
                                            </div>
                                        </li>
                                        <?php  } }  ?>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-md-6 show" id="new-task-panel" style="display:none;">
                                <div class="panel panel-default">
                                    <div class="panel-heading "><i class="ti-plus"></i> New Task
                                        <div class="panel-action">
                                            <a href="javascript:;" id="hide-new-task-panel"><i class="ti-close"></i></a>
                                        </div>
                                    </div>
                                    <div class="panel-wrapper collapse in">
                                        <div class="panel-body">
                                            <form method="POST" id="createTask"
                                                action="<?php echo site_url('admin/building/task_save/'); ?>"
                                                class="ajax-form">
                                                <div class="form-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="control-label">Title</label>
                                                                <input type="text" id="heading" name="heading"
                                                                    class="form-control">
                                                            </div>
                                                        </div>
                                                        <!--/span-->
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="control-label">Description</label>
                                                                <textarea rows="6" name="editordata"
                                                                    style="width: 100%;"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="control-label">Start Date</label>
                                                                <input type="text" name="start_date" id="start_date "
                                                                    class="form-control datepicker" autocomplete="off"
                                                                    value="">
                                                            </div>
                                                        </div>
                                                        <!--/span-->
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="control-label">Due Date</label>
                                                                <input type="text" name="due_date" id="due_date"
                                                                    autocomplete="off" class="form-control datepicker">
                                                            </div>
                                                        </div>
                                                        <!--/span-->
                                                        <div class="col-md-12">
                                                            <label class="control-label">Milestones</label>
                                                            <div class="form-group">
                                                                <select class="form-control" name="milestone">
                                                                    <option value="">--</option>
                                                                    <?php if ($milestone) {foreach ($milestone as $row) {?>
                                                                    <option value="<?php echo $row->id; ?>">
                                                                        <?php echo  $row->title; ?></option>

                                                                    <?php	}}?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label class="control-label">Assigned To</label>
                                                            <div class="form-group">
                                                                <select class="form-control assigneto"
                                                                    name="assigned_to">
                                                                    <option value="">--
                                                                    <option>
                                                                        <?php if ($employee) {foreach ($employee as $row) {?>
                                                                    <option value="<?php echo $row->id; ?>">
                                                                        <?php echo $row->first_name . '-' . $row->last_name; ?>
                                                                    </option>

                                                                    <?php	}}?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 Taskstatus" style="display:none;">
                                                            <label class="control-label">Status</label>
                                                            <div class="form-group">
                                                                <select name="status" id="status" class="form-control">
                                                                    <option value="incomplete">Incomplete</option>
                                                                    <option value="complete">Complete</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <!--/span-->
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="control-label">Priority</label>
                                                                <div class="radio radio-danger">
                                                                    <input type="radio" name="priority" id="radio13"
                                                                        value="high">
                                                                    <label for="radio13" class="text-danger">
                                                                        High </label>
                                                                </div>
                                                                <div class="radio radio-warning">
                                                                    <input type="radio" name="priority" checked=""
                                                                        id="radio14" value="medium">
                                                                    <label for="radio14" class="text-warning">
                                                                        Medium </label>

                                                                </div>
                                                                <div class="radio radio-success">
                                                                    <input type="radio" name="priority" id="radio15"
                                                                        value="low">
                                                                    <label for="radio15" class="text-success">
                                                                        Low </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--/span-->
                                                    </div>
                                                    <!--/row-->
                                                </div>
                                                <div class="form-actions">
                                                    <button type="submit" id="save-task" class="btn btn-success">
                                                        <i class="fa fa-check"></i>Save</button>
                                                    <input type="hidden" name="buildingid"
                                                        value="<?php echo $buildingid; ?>">
                                                    <input type="hidden" name="projectid"
                                                        value="<?php echo $project_id; ?>">
                                                    <input type="hidden" name="task_id" id="taskid">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 hide" id="edit-task-panel">
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane <?php if ($this->uri->segment(5) == 'Milestone') {echo 'active';}?>" id="3a">
                        <div class="row">
                            <div class="col-md-12" id="issues-list-panel">
                                <div class="white-box">
                                    <h4><b>Milestones</b></h4>

                                    <div class="row m-b-10">
                                        <div class="col-md-12">
                                            <a href="javascript:;" id="show-add-milestoneform"
                                                class="btn btn-success btn-outline"><i class="fa fa-flag"></i> Create
                                                Milestone </a>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <form method="POST"
                                                action="<?php echo site_url('admin/building/milestone_save/'); ?>"
                                                accept-charset="UTF-8" id="milestoneform" class="ajax-form hide">
                                                <div class="form-body">
                                                    <div class="row m-t-30">
                                                        <div class="col-md-6 ">
                                                            <div class="form-group">
                                                                <label>Milestone Title</label>
                                                                <input id="milestone_title" name="milestone_title"
                                                                    type="text" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 ">
                                                            <div class="form-group">
                                                                <label>Status</label>
                                                                <select name="status" id="status" class="form-control">
                                                                    <option value="incomplete">Incomplete</option>
                                                                    <option value="complete">Complete</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 ">
                                                            <div class="form-group">
                                                                <label>Currency</label>
                                                                <select name="currency_id" id="currency_id"
                                                                    class="form-control">
                                                                    <option value="">--</option>
                                                                    <?php if ($currency) {foreach ($currency as $row) {?>
                                                                    <option value="<?php echo $row->id; ?>">
                                                                        <?php echo $row->currency_code . '(' . $row->currrency_symbol . ')'; ?>
                                                                    </option>(₹)

                                                                    <?php	}}?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 ">
                                                            <div class="form-group">
                                                                <label>Milestone Cost</label>
                                                                <input id="cost" name="cost" type="number"
                                                                    class="form-control" value="0" min="0" step=".01">
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="row m-t-20">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="memo">Milestone Summary</label>
                                                                <textarea name="summary" id="" rows="4"
                                                                    class="form-control"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-actions">
                                                    <button type="submit" id="save-task" class="btn btn-success">
                                                        <i class="fa fa-check"></i>Save</button>
                                                    <input type="hidden" name="buildingid"
                                                        value="<?php echo $buildingid; ?>">
                                                    <input type="hidden" name="projectid"
                                                        value="<?php echo $project_id; ?>">
                                                    <input type="hidden" name="milestone_id" id="milestoneid">
                                                    <!-- <button type="button" id="close-form" class="btn btn-default"><i
                                                        class="fa fa-times"></i> Close</button>-->
                                                </div>
                                            </form>
                                            <hr>
                                        </div>
                                    </div>

                                    <div class="table-responsives m-t-30">
                                        <div id="timelog-table_wrapper"
                                            class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <p class="introtext"><?=lang('list_results');?></p>
                                                    <div class="table-responsive col-sm-12">
                                                        <table id="milestonetable"
                                                            class="table table-bordered table-hover table-striped reports-table">
                                                            <thead>
                                                                <tr>
                                                                    <th><?=lang("id");?></th>
                                                                    <th>Title</th>
                                                                    <th>Cost</th>
                                                                    <th>Status</th>
                                                                    <th style="width:100px;"><?=lang("actions");?></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td colspan="6" class="dataTables_empty">
                                                                        <?=lang('loading_data_from_server')?>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="tab-pane <?php if ($this->uri->segment(5) == 'Files') {echo 'active';}?>" id="4a">
                        <div class="row">
                            <div class="col-md-12" id="files-list-panel">
                                <div class="white-box">
                                    <h4><b>Files</b></h4>

                                    <div class="row m-b-10">
                                        <div class="col-md-12">
                                            <a href="javascript:;" id="show-dropzone"
                                                class="btn btn-success btn-outline"><i class="ti-upload"></i> Upload
                                                File</a>
                                        </div>
                                    </div>

                                    <div class="row m-b-20 hide" id="file-dropzone">
                                        <div class="col-md-12">
                                            <form action="<?php echo site_url('admin/building/milestone_doc_save/'); ?>"
                                                class="dropzone dz-clickable" id="file-upload-dropzone">
                                                <input name="view" type="hidden" id="view" value="list">
                                                <input type="hidden" name="buildingid"
                                                    value="<?php echo $buildingid; ?>">
                                                <input type="hidden" name="projectid"
                                                    value="<?php echo $project_id; ?>">
                                                <div class="dz-default dz-message"><span>Drop files here OR click to
                                                        upload</span></div>
                                            </form>
                                        </div>
                                    </div>

                                    <ul class="nav nav-tabs" role="tablist" id="list-tabs">
                                        <li role="presentation" class="active nav-item" data-pk="list"><a href="#list"
                                                class="nav-link" aria-controls="home" role="tab" data-toggle="tab"
                                                aria-expanded="true"><span class="visible-xs"><i
                                                        class="ti-home"></i></span><span class="hidden-xs">
                                                    List</span></a>
                                        </li>
                                        <!--    <li role="presentation" class="nav-item" data-pk="thumbnail"><a href="#thumbnail"
                                            class="nav-link thumbnail" aria-controls="profile" role="tab"
                                            data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i
                                                    class="ti-user"></i></span> <span
												class="hidden-xs">Thumbnail</span></a></li>-->

                                    </ul>
                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane active" id="list">
                                            <ul class="list-group" id="files-list">
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col-md-12">

                                                            <div class="table-responsives m-t-30">
                                                                <div id="timelog-table_wrapper"
                                                                    class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                                                    <div class="row">
                                                                        <div class="col-lg-12">
                                                                            <p class="introtext">
                                                                                <?=lang('list_results');?></p>
                                                                            <div class="table-responsive col-sm-12">
                                                                                <table
                                                                                    class="table table-bordered table-hover table-striped reports-table">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th>Name</th>
                                                                                            <th style="width:100px;">
                                                                                                <?=lang("actions");?>
                                                                                            </th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        <?php    if(!empty($building->upload_doc)){  foreach(json_decode($building->upload_doc) as $doc){  ?>
                                                                                        <tr>
                                                                                            <td><?php  echo $doc;  ?>
                                                                                            </td>
                                                                                            <td>
                                                                                                <div
                                                                                                    class="text-center">
                                                                                                    <a
                                                                                                        href="<?php echo site_url('admin/building/building_doc_download/'.$doc); ?>">
                                                                                                        <i
                                                                                                            class="fa fa-download"></i></a>
                                                                                                    <a href="<?php echo site_url('admin/building/doc_deleted/'.$doc.'/'.$buildingid); ?>"
                                                                                                        class="tip po">
                                                                                                        <i
                                                                                                            class="fa fa-trash-o"></i></a>
                                                                                                </div>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <?php }   }else{  ?>
                                                                                        <tr>
                                                                                            <td colspan="6"
                                                                                                class="dataTables_empty">
                                                                                                <?=lang('loading_data_from_server')?>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <?php    }   ?>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>




                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <!--   <div role="tabpanel" class="tab-pane" id="thumbnail">


                                    </div>-->
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="tab-pane <?php if ($this->uri->segment(5) == 'Invoices') {echo 'active';}?>" id="5a">
                        <div class="white-box">
                            <h4><b>Invoices</b></h4>
                            <ul class="list-group" id="invoices-list">
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-sm-5 col-xs-12">
                                            14957059511
                                        </div>
                                        <div class="col-sm-2">
                                            $ 35076
                                        </div>
                                        <div class="col-sm-2 col-xs-12">
                                            <label class="label label-danger">Unpaid</label>
                                        </div>
                                        <div class="col-sm-3 col-xs-12">
                                            <a href="#" class="btn btn-inverse btn-circle"><i
                                                    class="fa fa-download"></i></a>
                                            &nbsp;&nbsp;
                                            <a href="javascript:;" data-invoice-id="400"
                                                class="btn btn-danger btn-circle sa-params"><i
                                                    class="fa fa-times"></i></a>
                                            <span class="m-l-10">08-06-2019</span>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-sm-5 col-xs-12">
                                            14957055018
                                        </div>
                                        <div class="col-sm-2">
                                            $ 39432
                                        </div>
                                        <div class="col-sm-2 col-xs-12">
                                            <label class="label label-success">Paid</label>
                                        </div>
                                        <div class="col-sm-3 col-xs-12">
                                            <a href="#" class="btn btn-inverse btn-circle"><i
                                                    class="fa fa-download"></i></a>
                                            &nbsp;&nbsp;
                                            <a href="javascript:;" data-invoice-id="399"
                                                class="btn btn-danger btn-circle sa-params"><i
                                                    class="fa fa-times"></i></a>

                                            <span class="m-l-10">07-06-2019</span>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-sm-5 col-xs-12">
                                            14957057114
                                        </div>
                                        <div class="col-sm-2">
                                            $ 23292
                                        </div>
                                        <div class="col-sm-2 col-xs-12">
                                            <label class="label label-success">Paid</label>
                                        </div>
                                        <div class="col-sm-3 col-xs-12">
                                            <a href="#" class="btn btn-inverse btn-circle"><i
                                                    class="fa fa-download"></i></a>
                                            &nbsp;&nbsp;
                                            <a href="javascript:;" data-invoice-id="398"
                                                class="btn btn-danger btn-circle sa-params"><i
                                                    class="fa fa-times"></i></a>
                                            <span class="m-l-10">07-06-2019</span>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-sm-5 col-xs-12">
                                            14957059043
                                        </div>
                                        <div class="col-sm-2">
                                            $ 48480
                                        </div>
                                        <div class="col-sm-2 col-xs-12">
                                            <label class="label label-success">Paid</label>
                                        </div>
                                        <div class="col-sm-3 col-xs-12">
                                            <a href="/397" class="btn btn-inverse btn-circle"><i
                                                    class="fa fa-download"></i></a>
                                            &nbsp;&nbsp;
                                            <a href="javascript:;" data-invoice-id="397"
                                                class="btn btn-danger btn-circle sa-params"><i
                                                    class="fa fa-times"></i></a>

                                            <span class="m-l-10">08-06-2019</span>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-sm-5 col-xs-12">
                                            14957058989
                                        </div>
                                        <div class="col-sm-2">
                                            $ 49747
                                        </div>
                                        <div class="col-sm-2 col-xs-12">
                                            <label class="label label-danger">Unpaid</label>
                                        </div>
                                        <div class="col-sm-3 col-xs-12">
                                            <a href="#" class="btn btn-inverse btn-circle"><i
                                                    class="fa fa-download"></i></a>
                                            &nbsp;&nbsp;
                                            <a href="javascript:;" data-invoice-id="396"
                                                class="btn btn-danger btn-circle sa-params"><i
                                                    class="fa fa-times"></i></a>

                                            <span class="m-l-10">14-06-2019</span>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-sm-5 col-xs-12">
                                            14957057927
                                        </div>
                                        <div class="col-sm-2">
                                            $ 15853
                                        </div>
                                        <div class="col-sm-2 col-xs-12">
                                            <label class="label label-success">Paid</label>
                                        </div>
                                        <div class="col-sm-3 col-xs-12">
                                            <a href="#" class="btn btn-inverse btn-circle"><i
                                                    class="fa fa-download"></i></a>
                                            &nbsp;&nbsp;
                                            <a href="javascript:;" data-invoice-id="395"
                                                class="btn btn-danger btn-circle sa-params"><i
                                                    class="fa fa-times"></i></a>
                                            <span class="m-l-10">06-06-2019</span>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-sm-5 col-xs-12">
                                            14957059601
                                        </div>
                                        <div class="col-sm-2">
                                            $ 38421
                                        </div>
                                        <div class="col-sm-2 col-xs-12">
                                            <label class="label label-danger">Unpaid</label>
                                        </div>
                                        <div class="col-sm-3 col-xs-12">
                                            <a href="#" class="btn btn-inverse btn-circle"><i
                                                    class="fa fa-download"></i></a>
                                            &nbsp;&nbsp;
                                            <a href="javascript:;" data-invoice-id="394"
                                                class="btn btn-danger btn-circle sa-params"><i
                                                    class="fa fa-times"></i></a>
                                            <span class="m-l-10">26-06-2019</span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="tab-pane <?php if ($this->uri->segment(5) == 'Invoices') {echo 'active';}?>" id="5a">
                        <div class="white-box">
                            <h2>Time Logs</h2>

                            <div class="row m-b-10">
                                <div class="col-md-12">
                                    <a href="javascript:;" id="show-add-form" class="btn btn-success btn-outline"><i
                                            class="fa fa-clock-o"></i> Log Time </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <form method="POST" action="#" accept-charset="UTF-8" id="logTime" class="ajax-form"
                                        style="">
                                        <div class="form-body">
                                            <div class="row m-t-30">
                                                <div class="col-md-3 ">
                                                    <div class="form-group">
                                                        <label>Employee Name</label>
                                                        <input name="employee_name" type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-3 ">
                                                    <div class="form-group">
                                                        <label>Start Date</label>
                                                        <input id="start_date" name="start_date" type="text"
                                                            class="form-control datepicker">
                                                    </div>
                                                </div>
                                                <div class="col-md-3 ">
                                                    <div class="form-group">
                                                        <label>End Date</label>
                                                        <input id="end_date" name="end_date" type="text"
                                                            class="form-control datepicker">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="input-group bootstrap-timepicker timepicker">
                                                        <label>Start Time</label>
                                                        <input type="text" name="start_time" id="start_time"
                                                            class="form-control">
                                                        <div class="bootstrap-timepicker-widget dropdown-menu">
                                                            <table>
                                                                <tbody>
                                                                    <tr>
                                                                        <td><a href="#" data-action="incrementHour"><i
                                                                                    class="glyphicon glyphicon-chevron-up"></i></a>
                                                                        </td>
                                                                        <td class="separator">&nbsp;</td>
                                                                        <td><a href="#" data-action="incrementMinute"><i
                                                                                    class="glyphicon glyphicon-chevron-up"></i></a>
                                                                        </td>
                                                                        <td class="separator">&nbsp;</td>
                                                                        <td class="meridian-column"><a href="#"
                                                                                data-action="toggleMeridian"><i
                                                                                    class="glyphicon glyphicon-chevron-up"></i></a>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><input type="text" name="hour"
                                                                                class="form-control bootstrap-timepicker-hour"
                                                                                maxlength="2">
                                                                        </td>
                                                                        <td class="separator">:</td>
                                                                        <td><input type="text" name="minute"
                                                                                class="form-control bootstrap-timepicker-minute"
                                                                                maxlength="2">
                                                                        </td>
                                                                        <td class="separator">&nbsp;</td>
                                                                        <td><input type="text" name="meridian"
                                                                                class="form-control bootstrap-timepicker-meridian"
                                                                                maxlength="2">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><a href="#" data-action="decrementHour"><i
                                                                                    class="glyphicon glyphicon-chevron-down"></i></a>
                                                                        </td>
                                                                        <td class="separator"></td>
                                                                        <td><a href="#" data-action="decrementMinute"><i
                                                                                    class="glyphicon glyphicon-chevron-down"></i></a>
                                                                        </td>
                                                                        <td class="separator">&nbsp;</td>
                                                                        <td><a href="#" data-action="toggleMeridian"><i
                                                                                    class="glyphicon glyphicon-chevron-down"></i></a>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="input-group bootstrap-timepicker timepicker">
                                                        <label>End Time</label>
                                                        <input type="text" name="end_time" id="end_time"
                                                            class="form-control">
                                                        <div class="bootstrap-timepicker-widget dropdown-menu">
                                                            <table>
                                                                <tbody>
                                                                    <tr>
                                                                        <td><a href="#" data-action="incrementHour"><i
                                                                                    class="glyphicon glyphicon-chevron-up"></i></a>
                                                                        </td>
                                                                        <td class="separator">&nbsp;</td>
                                                                        <td><a href="#" data-action="incrementMinute"><i
                                                                                    class="glyphicon glyphicon-chevron-up"></i></a>
                                                                        </td>
                                                                        <td class="separator">&nbsp;</td>
                                                                        <td class="meridian-column"><a href="#"
                                                                                data-action="toggleMeridian"><i
                                                                                    class="glyphicon glyphicon-chevron-up"></i></a>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><input type="text" name="hour"
                                                                                class="form-control bootstrap-timepicker-hour"
                                                                                maxlength="2">
                                                                        </td>
                                                                        <td class="separator">:</td>
                                                                        <td><input type="text" name="minute"
                                                                                class="form-control bootstrap-timepicker-minute"
                                                                                maxlength="2">
                                                                        </td>
                                                                        <td class="separator">&nbsp;</td>
                                                                        <td><input type="text" name="meridian"
                                                                                class="form-control bootstrap-timepicker-meridian"
                                                                                maxlength="2">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><a href="#" data-action="decrementHour"><i
                                                                                    class="glyphicon glyphicon-chevron-down"></i></a>
                                                                        </td>
                                                                        <td class="separator"></td>
                                                                        <td><a href="#" data-action="decrementMinute"><i
                                                                                    class="glyphicon glyphicon-chevron-down"></i></a>
                                                                        </td>
                                                                        <td class="separator">&nbsp;</td>
                                                                        <td><a href="#" data-action="toggleMeridian"><i
                                                                                    class="glyphicon glyphicon-chevron-down"></i></a>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <label for="">Total Hours</label>

                                                    <p id="total_time" class="form-control-static">0 Hrs</p>
                                                </div>
                                            </div>

                                            <div class="row m-t-20">
                                                <div class="col-md-9">
                                                    <div class="form-group">
                                                        <label for="memo">Memo</label>
                                                        <input type="text" name="memo" id="memo" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-actions m-t-30">
                                            <button type="button" id="save-form" class="btn btn-success"><i
                                                    class="fa fa-check"></i> Save</button>
                                            <input type="hidden" name="buildingid" value="<?php echo $buildingid; ?>">
                                            <input type="hidden" name="projectid" value="<?php echo $project_id; ?>">
                                        </div>
                                    </form>

                                    <hr>
                                </div>
                            </div>

                            <div class="table-responsives m-t-30">
                                <div id="timelog-table_wrapper"
                                    class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="dataTables_length" id="timelog-table_length"><label>Show <select
                                                        name="timelog-table_length" aria-controls="timelog-table"
                                                        class="form-control input-sm">
                                                        <option value="10">10</option>
                                                        <option value="25">25</option>
                                                        <option value="50">50</option>
                                                        <option value="100">100</option>
                                                    </select> entries</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div id="timelog-table_filter" class="dataTables_filter pull-right">
                                                <label>Search:<input type="search" class="form-control input-sm"
                                                        placeholder="" aria-controls="timelog-table"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table
                                                class="table table-bordered table-hover toggle-circle default footable-loaded footable dataTable no-footer dtr-inline"
                                                id="timelog-table" role="grid" aria-describedby="timelog-table_info"
                                                style="width: 1034px;">
                                                <thead>
                                                    <tr role="row">
                                                        <th class="sorting_desc" tabindex="0"
                                                            aria-controls="timelog-table" rowspan="1" colspan="1"
                                                            style="width: 13px;" aria-sort="descending"
                                                            aria-label="Id: activate to sort column ascending">Id</th>
                                                        <th class="sorting" tabindex="0" aria-controls="timelog-table"
                                                            rowspan="1" colspan="1" style="width: 127px;"
                                                            aria-label="Who Logged: activate to sort column ascending">
                                                            Who
                                                            Logged</th>
                                                        <th class="sorting" tabindex="0" aria-controls="timelog-table"
                                                            rowspan="1" colspan="1" style="width: 113px;"
                                                            aria-label="Start Time: activate to sort column ascending">
                                                            Start
                                                            Time</th>
                                                        <th class="sorting" tabindex="0" aria-controls="timelog-table"
                                                            rowspan="1" colspan="1" style="width: 115px;"
                                                            aria-label="End Time: activate to sort column ascending">End
                                                            Time</th>
                                                        <th class="sorting" tabindex="0" aria-controls="timelog-table"
                                                            rowspan="1" colspan="1" style="width: 76px;"
                                                            aria-label="Total Hours: activate to sort column ascending">
                                                            Total Hours</th>
                                                        <th class="sorting" tabindex="0" aria-controls="timelog-table"
                                                            rowspan="1" colspan="1" style="width: 128px;"
                                                            aria-label="Memo: activate to sort column ascending">Memo
                                                        </th>
                                                        <th class="sorting" tabindex="0" aria-controls="timelog-table"
                                                            rowspan="1" colspan="1" style="width: 105px;"
                                                            aria-label="Last updated by: activate to sort column ascending">
                                                            Last updated by</th>
                                                        <th class="sorting" tabindex="0" aria-controls="timelog-table"
                                                            rowspan="1" colspan="1" style="width: 46px;"
                                                            aria-label="Action: activate to sort column ascending">
                                                            Action
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr role="row" class="odd">
                                                        <td class="sorting_1" tabindex="0">400</td>
                                                        <td>Joannie Franecki Jr.</td>
                                                        <td>20-07-2019 12:00 am</td>
                                                        <td>28-07-2019 04:15 pm</td>
                                                        <td>208 hrs </td>
                                                        <td>working onsint</td>
                                                        <td></td>
                                                        <td><a href="javascript:;"
                                                                class="btn btn-info btn-circle edit-time-log"
                                                                data-time-id="400"><i class="fa fa-pencil"
                                                                    aria-hidden="true"></i></a>

                                                            <a href="javascript:;"
                                                                class="btn btn-danger btn-circle sa-params"
                                                                data-time-id="400"><i class="fa fa-times"
                                                                    aria-hidden="true"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr role="row" class="even">
                                                        <td class="sorting_1" tabindex="0">399</td>
                                                        <td>Miss Charity Mueller Sr.</td>
                                                        <td>05-09-2018 12:21 am</td>
                                                        <td>07-09-2018 04:15 pm</td>
                                                        <td>63 hrs </td>
                                                        <td>working ondoloremque</td>
                                                        <td></td>
                                                        <td><a href="javascript:;"
                                                                class="btn btn-info btn-circle edit-time-log"
                                                                data-time-id="399"><i class="fa fa-pencil"
                                                                    aria-hidden="true"></i></a>

                                                            <a href="javascript:;"
                                                                class="btn btn-danger btn-circle sa-params"
                                                                data-time-id="399"><i class="fa fa-times"
                                                                    aria-hidden="true"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr role="row" class="odd">
                                                        <td class="sorting_1" tabindex="0">398</td>
                                                        <td>Shannon Hayes</td>
                                                        <td>30-09-2018 01:07 pm</td>
                                                        <td>08-10-2018 04:15 pm</td>
                                                        <td>195 hrs </td>
                                                        <td>working onlaborum</td>
                                                        <td></td>
                                                        <td><a href="javascript:;"
                                                                class="btn btn-info btn-circle edit-time-log"
                                                                data-time-id="398"><i class="fa fa-pencil"
                                                                    aria-hidden="true"></i></a>

                                                            <a href="javascript:;"
                                                                class="btn btn-danger btn-circle sa-params"
                                                                data-time-id="398"><i class="fa fa-times"
                                                                    aria-hidden="true"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr role="row" class="even">
                                                        <td class="sorting_1" tabindex="0">397</td>
                                                        <td>Kathryne Cummings</td>
                                                        <td>29-05-2019 02:34 pm</td>
                                                        <td>03-06-2019 04:15 pm</td>
                                                        <td>121 hrs </td>
                                                        <td>working onrem</td>
                                                        <td></td>
                                                        <td><a href="javascript:;"
                                                                class="btn btn-info btn-circle edit-time-log"
                                                                data-time-id="397"><i class="fa fa-pencil"
                                                                    aria-hidden="true"></i></a>

                                                            <a href="javascript:;"
                                                                class="btn btn-danger btn-circle sa-params"
                                                                data-time-id="397"><i class="fa fa-times"
                                                                    aria-hidden="true"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr role="row" class="odd">
                                                        <td class="sorting_1" tabindex="0">396</td>
                                                        <td>Leslie Koss</td>
                                                        <td>11-07-2019 11:34 am</td>
                                                        <td>15-07-2019 04:15 pm</td>
                                                        <td>100 hrs </td>
                                                        <td>working onvoluptatem</td>
                                                        <td></td>
                                                        <td><a href="javascript:;"
                                                                class="btn btn-info btn-circle edit-time-log"
                                                                data-time-id="396"><i class="fa fa-pencil"
                                                                    aria-hidden="true"></i></a>

                                                            <a href="javascript:;"
                                                                class="btn btn-danger btn-circle sa-params"
                                                                data-time-id="396"><i class="fa fa-times"
                                                                    aria-hidden="true"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr role="row" class="even">
                                                        <td class="sorting_1" tabindex="0">395</td>
                                                        <td>Ms. Verona Swift MD</td>
                                                        <td>21-07-2019 12:00 am</td>
                                                        <td>22-07-2019 04:15 pm</td>
                                                        <td>40 hrs </td>
                                                        <td>working onoptio</td>
                                                        <td></td>
                                                        <td><a href="javascript:;"
                                                                class="btn btn-info btn-circle edit-time-log"
                                                                data-time-id="395"><i class="fa fa-pencil"
                                                                    aria-hidden="true"></i></a>

                                                            <a href="javascript:;"
                                                                class="btn btn-danger btn-circle sa-params"
                                                                data-time-id="395"><i class="fa fa-times"
                                                                    aria-hidden="true"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr role="row" class="odd">
                                                        <td class="sorting_1" tabindex="0">394</td>
                                                        <td>Dr. Kamryn Olson</td>
                                                        <td>04-07-2019 11:13 am</td>
                                                        <td>06-07-2019 04:15 pm</td>
                                                        <td>53 hrs </td>
                                                        <td>working ondoloribus</td>
                                                        <td></td>
                                                        <td><a href="javascript:;"
                                                                class="btn btn-info btn-circle edit-time-log"
                                                                data-time-id="394"><i class="fa fa-pencil"
                                                                    aria-hidden="true"></i></a>

                                                            <a href="javascript:;"
                                                                class="btn btn-danger btn-circle sa-params"
                                                                data-time-id="394"><i class="fa fa-times"
                                                                    aria-hidden="true"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr role="row" class="even">
                                                        <td class="sorting_1" tabindex="0">393</td>
                                                        <td>Leslie Koss</td>
                                                        <td>21-07-2019 12:00 am</td>
                                                        <td>26-07-2019 04:15 pm</td>
                                                        <td>136 hrs </td>
                                                        <td>working onsit</td>
                                                        <td></td>
                                                        <td><a href="javascript:;"
                                                                class="btn btn-info btn-circle edit-time-log"
                                                                data-time-id="393"><i class="fa fa-pencil"
                                                                    aria-hidden="true"></i></a>

                                                            <a href="javascript:;"
                                                                class="btn btn-danger btn-circle sa-params"
                                                                data-time-id="393"><i class="fa fa-times"
                                                                    aria-hidden="true"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr role="row" class="odd">
                                                        <td class="sorting_1" tabindex="0">392</td>
                                                        <td>Dr. Terrill Hagenes</td>
                                                        <td>22-07-2019 12:00 am</td>
                                                        <td>22-07-2019 04:15 pm</td>
                                                        <td>16 hrs </td>
                                                        <td>working onprovident</td>
                                                        <td></td>
                                                        <td><a href="javascript:;"
                                                                class="btn btn-info btn-circle edit-time-log"
                                                                data-time-id="392"><i class="fa fa-pencil"
                                                                    aria-hidden="true"></i></a>

                                                            <a href="javascript:;"
                                                                class="btn btn-danger btn-circle sa-params"
                                                                data-time-id="392"><i class="fa fa-times"
                                                                    aria-hidden="true"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr role="row" class="even">
                                                        <td class="sorting_1" tabindex="0">391</td>
                                                        <td>Dr. Terrill Hagenes</td>
                                                        <td>24-07-2019 12:00 am</td>
                                                        <td>01-08-2019 04:15 pm</td>
                                                        <td>208 hrs </td>
                                                        <td>working onconsequatur</td>
                                                        <td></td>
                                                        <td><a href="javascript:;"
                                                                class="btn btn-info btn-circle edit-time-log"
                                                                data-time-id="391"><i class="fa fa-pencil"
                                                                    aria-hidden="true"></i></a>

                                                            <a href="javascript:;"
                                                                class="btn btn-danger btn-circle sa-params"
                                                                data-time-id="391"><i class="fa fa-times"
                                                                    aria-hidden="true"></i></a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <div id="timelog-table_processing"
                                                class="dataTables_processing panel panel-default"
                                                style="display: none;">
                                                Processing...</div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-5">
                                            <div class="dataTables_info" id="timelog-table_info" role="status"
                                                aria-live="polite">Showing 1 to 10 of 20 entries</div>
                                        </div>
                                        <div class="col-sm-7">
                                            <div class="dataTables_paginate paging_simple_numbers pull-right"
                                                id="timelog-table_paginate">
                                                <ul class="pagination">
                                                    <li class="paginate_button previous disabled"
                                                        id="timelog-table_previous"><a href="#"
                                                            aria-controls="timelog-table" data-dt-idx="0"
                                                            tabindex="0">Previous</a>
                                                    </li>
                                                    <li class="paginate_button active"><a href="#"
                                                            aria-controls="timelog-table" data-dt-idx="1"
                                                            tabindex="0">1</a>
                                                    </li>
                                                    <li class="paginate_button "><a href="#"
                                                            aria-controls="timelog-table" data-dt-idx="2"
                                                            tabindex="0">2</a>
                                                    </li>
                                                    <li class="paginate_button next" id="timelog-table_next"><a href="#"
                                                            aria-controls="timelog-table" data-dt-idx="3"
                                                            tabindex="0">Next</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="<?php echo base_url('assets/admin') ?>/dist/js/dropzone.js"></script>
<script src="<?php echo base_url('assets/admin/') ?>/plugins/datepicker/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/admin') ?>/dist/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/admin') ?>/dist/js/jquery.dataTables.dtFilter.min.js">
</script>
<script type="text/javascript" src="<?php echo base_url('assets/admin') ?>/dist/js/customdatatable.js"></script>


<script>
$('#show-dropzone').click(function() {
    $('#file-dropzone').toggleClass('hide show');
});

// "myAwesomeDropzone" is the camelized version of the HTML element's ID
Dropzone.options.fileUploadDropzone = {
    paramName: "file", // The name that will be used to transfer the file
    //        maxFilesize: 2, // MB,
    dictDefaultMessage: "Drop files here OR click to upload",
    accept: function(file, done) {
        done();
    },
    init: function() {
        this.on("success", function(file, response) {
            var viewName = $('#view').val();
            if (viewName == 'list') {
                $('#files-list-panel ul.list-group').html(response.html);
            } else {
                $('#thumbnail').empty();
                $(response.html).hide().appendTo("#thumbnail").fadeIn(500);
            }
        })
    }
};


$('#list-tabs').on("shown.bs.tab", function(event) {
    var tabSwitch = $('#list').hasClass('active');
    if (tabSwitch == true) {
        $('#view').val('list');
    } else {
        $('#view').val('thumbnail');
    }
});
</script>
<script>
$(function() {
    $("#start_date").datepicker({
        autoclose: true,
        todayHighlight: true
    }).datepicker('update', new Date());
});

$('#show-add-form').click(function() {
    $('#logTime').toggleClass('hide', 'show');
});
$('#show-add-milestoneform').click(function() {
    $('#milestoneform').toggleClass('hide', 'show');
});
$('#show-new-task-panel').click(function() {
    $('#new-task-panel').toggleClass('hide', 'show');
});
$(document).ready(function() {
    $('#summernote').summernote();
});
$(document).ready(function() {
    $('#new-task-panel').toggleClass('hide', 'show');
});
</script>