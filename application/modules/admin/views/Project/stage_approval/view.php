 <script type="text/javascript" src="<?php echo base_url('assets/admin') ?>/dist/js/jquery.min.js"></script>
 <script type="text/javascript" src="<?php echo base_url('assets/admin') ?>/dist/js/bootstrap-multiselect.min.js">
 </script>
 <link rel="stylesheet" href="<?php echo base_url('assets/admin') ?>/dist/css/bootstrap.min.css">
 <link rel="stylesheet" href="<?php echo base_url('assets/admin') ?>/dist/css/bootstrap-datepicker.min.css">
 <link rel="stylesheet" href="<?php echo base_url('assets/admin') ?>/dist/css/chosen.min.css">
 <script src="<?php echo base_url('assets/admin') ?>/dist/js/chosen.jquery.min.js"></script>
 
<style>
		.tabs-left {
			border-bottom: none;
		}

		.tabs-left>li {
			float: none;
			margin:0px;
		}

		.tabs-left>li.active>a,
		.tabs-left>li.active>a:hover,
		.tabs-left>li.active>a:focus {
		border-bottom-color: #ddd;
		border-right-color: transparent;
		background:#37bc9b;
		border:none;
		border-radius:0px;
		margin:0px;
		}
		.nav-tabs>li>a:hover {
		/* margin-right: 2px; */
		line-height: 1.42857143;
		border: 1px solid transparent;
		/* border-radius: 4px 4px 0 0; */
		}
		.tabs-left>li.active>a::after{content: "";
		position: absolute;
		top: 10px;
		right: -10px;
		border-top: 10px solid transparent;
		border-bottom: 10px solid transparent;

		border-left: 10px solid #37bc9b;
		display: block;
		width: 0;}
		body{background-color: #efefef;}
		.vertical_tab{padding: 20px;}
		.tab-content{
		margin-left: 20px;
		background-color: #fff;
		padding: 20px;
		}
		.nav-tabs>li>a{border-bottom: 1px solid #efefef;}
	</style>
 <section class="content-header">
     <h1>
         <?php echo $page_title; ?>
     </h1>
     <ol class="breadcrumb">
         <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i>
                 <?php echo lang('dashboard') ?></a></li>
         <li><a href="<?php echo site_url('admin/Project') ?>"><?php echo lang('Project') ?></a></li>
         <li class="active"><?php echo lang('view') ?> <?php echo lang('Project') ?></li>
     </ol>
 </section>
 
 <section class="vertical_tab">
 	<div class="container">
 		<div class="row">
 			<div class="col-sm-3" style="background-color: #fff;padding: 0px;"> <!-- required for floating -->
          <!-- Nav tabs -->
          <ul class="nav nav-tabs tabs-left sideways">
            <li class="active"><a href="#project" data-toggle="tab">Project Details</a></li>
            <li><a href="#calendar" data-toggle="tab">Calendar</a></li>
            <li><a href="#comments" data-toggle="tab">Comments</a></li>
            <li><a href="#attachment" data-toggle="tab">Attachment</a></li>
            <li><a href="#milestone" data-toggle="tab">Milestone</a></li>
            <li><a href="#tasks" data-toggle="tab">Tasks</a></li>
            <li><a href="#bugs" data-toggle="tab">Bugs</a></li>
            <li><a href="#gantt" data-toggle="tab">Gantt View</a></li>
          </ul>
        </div>

        <div class="col-sm-9">
          <!-- Tab panes -->
          <div class="tab-content">
            <div class="tab-pane active" id="project">project Tab.</div>
            <div class="tab-pane" id="calendar">calendar Tab.</div>
            <div class="tab-pane" id="comments">comments Tab.</div>
            <div class="tab-pane" id="attachment">attachment Tab.</div>
            <div class="tab-pane" id="milestone">milestone Tab.</div>
            <div class="tab-pane" id="tasks">tasks Tab.</div>
            <div class="tab-pane" id="bugs">bugs Tab.</div>
            <div class="tab-pane" id="gantt">gantt Tab.</div>
          </div>
        </div>
 		</div>
 	</div>
 </section>
	
 <script src="<?php echo base_url('assets/admin/plugins/daterangepicker/daterangepicker.js') ?>"></script>
 <script src="<?php echo base_url('assets/admin/plugins/iCheck/icheck.min.js') ?>" type="text/javascript"></script>
 <script src="<?php echo base_url('assets/admin/') ?>/plugins/datepicker/bootstrap-datepicker.js"></script>
 <script src="<?php echo base_url('assets/admin/plugins') ?>/jquery-validation/jquery.validate.min.js"></script>