<?php $admin	=	$this->session->userdata('admin');
      $user	=	$this->auth->get_admin($admin['id']);
?>
<script>var base_url = '<?php echo base_url() ?>';</script>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $this->setting->name?> | <?php echo @$page_title?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="shortcut icon" href="<?php echo base_url('assets/logo.png')  ?>" />
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/admin')?>/dist/css/print.css" media="print">
<link type="text/css" href="<?php echo base_url('assets/admin/plugins/toastr/toastr.min.css');?>" rel="stylesheet" />
<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/skins/_all-skins.min.css">
<link href="<?php echo base_url('assets/admin/plugins/alertify/alertify.min.css')?>" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url('assets/admin')?>/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="http://code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>
<script src="<?php echo base_url('assets/admin/plugins/alertify/alertify.min.js')?>"></script>
  <!--<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap-3.3.2.min.css" type="text/css">-->
 <!--<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/jquery-2.1.3.min.js"></script> -->
 
  <link href="<?php echo base_url('assets/admin/plugins/iCheck/all.css')?>" rel="stylesheet" type="text/css" />
 <link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap-multiselect.css" type="text/css">
  <link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/customes.css" type="text/css">
  <script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/bootstrap-3.3.2.min.js"></script>
 <script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/bootstrap-multiselect.js"></script>
 <script src='<?php echo base_url('assets/admin')?>/plugins/jquery-validation/jquery.validate.min.js'></script>
<script src='<?php echo base_url('assets/admin')?>/dist/js/ownerajax.js'></script>
<script src='<?php echo base_url('assets/admin')?>/plugins/jquery-validation/additional-methods.min.js'></script>
<!---           userdefine js        --->
<link href='<?php echo base_url('assets')?>/assets/css/bootstrap/css/bootstrap.css' rel='stylesheet' media='screen'>
<link href='<?php echo base_url('assets')?>/assets/plugin/select2/select2.min.css' rel='stylesheet' media='screen'>
<link href='<?php echo base_url('assets')?>/assets/css/AdminLTE.css' rel='stylesheet' media='screen'>
<link href='<?php echo base_url('assets')?>/assets/css/custom.css' rel='stylesheet' media='screen'>
<link href='<?php echo base_url('assets')?>/assets/css/skins.css' rel='stylesheet' media='screen'>
<link href='<?php echo base_url('assets')?>/assets/plugin/datatables/jquery.dataTables.min.css' rel='stylesheet' media='screen'>
<link href='<?php echo base_url('assets')?>/assets/plugin/datatables/buttons.bootstrap.min.css' rel='stylesheet' media='screen'>
<link href='<?php echo base_url('assets')?>/assets/plugin/datatables/fixedHeader.bootstrap.min.css' rel='stylesheet' media='screen'>
<link href='<?php echo base_url('assets')?>/assets/plugin/datatables/responsive.bootstrap.min.css' rel='stylesheet' media='screen'>
<link href='<?php echo base_url('assets')?>/assets/plugin/datatables/scroller.bootstrap.min.css' rel='stylesheet' media='screen'>
<link href='<?php echo base_url('assets')?>/assets/plugin/daterangepicker/daterangepicker-bs3.css' rel='stylesheet' media='screen'>
<link href='<?php echo base_url('assets')?>/assets/plugin/datepicker/datepicker3.css' rel='stylesheet' media='screen'>
<link href='<?php echo base_url('assets')?>/assets/plugin/colorpicker/bootstrap-colorpicker.min.css' rel='stylesheet' media='screen'>
<link href='<?php echo base_url('assets')?>/assets/plugin/timepicker/bootstrap-timepicker.min.css' rel='stylesheet' media='screen'>
<link href='<?php echo base_url('assets')?>/assets/plugin/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css' rel='stylesheet' media='screen'>
<link href='<?php echo base_url('assets')?>/assets/css/font-awesome.min.css' rel='stylesheet' media='screen'>
<link href='<?php echo base_url('assets')?>/assets/css/ionicons.min.css' rel='stylesheet' media='screen'>
<link href='<?php echo base_url('assets')?>/assets/plugin/morris/morris.css' rel='stylesheet' media='screen'>
<link href='<?php echo base_url('assets')?>/assets/plugin/fullcalendar/fullcalendar.min.css' rel='stylesheet' media='screen'>
<link href='<?php echo base_url('assets')?>/assets/plugin/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css' rel='stylesheet' media='screen'>
<link href='https://fonts.googleapis.com/icon?family=Material+Icons' rel='stylesheet' media='screen'>
<script src='<?php echo base_url('assets/')?>/assets/js/jQuery-2.2.0.min.js'></script>
<script src='<?php echo base_url('assets/')?>/assets/js/bootstrap.min.js'></script>



  <style>
#overlay1 {
	position: fixed;
	left: 0;
	top: 0;
	bottom: 0;
	right: 0;
	background: #ffffff;
	opacity: 0.7;
	filter: alpha(opacity=80);
	-moz-opacity: 0.6;
	z-index: 10000;
}
.badge-notify{
   background:red;
   position:absolute;
   top:0px;
  }
</style> 

  <script>
  function areyousure(e){
			event.preventDefault();
			alertify.confirm("This post will be deleted and you won't be able to find it anymore.",
				function(){
					var href = $(this).attr('href');
					//alert(e);
					window.location = e;
					alertify.success('Ok');
					
					//$('.ajs-button').text("No");
					return true;
				},
				function(){
					alertify.error('Cancel');
					return true;
			});
			//return false;
		}
	</script>	
	 <script>
  function areyousurecheckout(e){
			event.preventDefault();
			alertify.confirm("This Booking Will Checkout Are Sure.",
				function(){
					var href = $(this).attr('href');
					//alert(e);
					
					window.location = e;
					alertify.success('Checkout Success');
					return true;
				},
				function(){
					alertify.error('Cancel');
					return true;
			});
			//return false;
		}
	</script>
	 <script>
  function areyousureCancel(e){
			event.preventDefault();
			alertify.confirm("This Booking Will Cancelled Are Sure.",
				function(){
					var href = $(this).attr('href');
					//alert(e);
					
					window.location = e;
					alertify.success('Booking Cancelled');
					return true;
				},
				function(){
					alertify.error('Cancel');
					return true;
			});
			//return false;
		}
	</script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">

    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b><?php echo $this->setting->name?></b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b><?php echo $this->setting->name?></b></span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            <li ><a href="<?php echo site_url('/owner/dashboard')?>"><i style="color:white;" class="glyphicon glyphicon-dashboard"></i></a></li>
          <!-- Notifications: style can be found in dropdown.less -->
           <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
             <i class="fa fa-language"></i>
            </a>
            <ul class="dropdown-menu">
              <?php /*?><li class="header">You have 10 notifications</li><?php */?>
              <li>
                <!-- inner menu: contains the actual data -->
               <ul class="menu">
                  <li class="lang" id="0">
                    <a href="#">
					<img src="<?php echo base_url('assets/admin/uploads/languages/eng.png')?>" class="img-circle" height="32" width="32" alt="User Image"/> English
                    </a>
                  </li>
                  <?php foreach ($langs as $new){ ?>
				  	<li class="lang" id="<?php echo $new->id?>">
                    <a href="#" >
					<img src="<?php echo base_url('assets/admin/uploads/languages/'.$new->flag)?>" class="img-circle" height="32" width="32" alt="User Image"/> <?php echo $new->name?>
                    </a>
                  </li>
				  <?php } ?>
                </ul>
              </li>
            </ul>
          </li>
          <!-- Tasks: style can be found in dropdown.less -->
   <!-- <li class="dropdown notifications-menu">
    	<a href="#" class="dropdown-toggle" data-toggle="dropdown">
		<i class="glyphicon glyphicon-comment"></i>
		<span class="label label-warning">3</span>
	</a>
	<ul class="dropdown-menu">
					<li class="header"><?= lang('you_have') ?> 3 <?= lang('notifications') ?></li>
						<li>
							<!-- Inner Menu: contains the notifications 
							<ul class="menu">
								<!--<?php if($totalApplication) { foreach($application as $item){ ?>
								<li><!-- start notification 
									<a href="<?php echo site_url('admin/Employee/viewApplication/'. str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encrypt->encode($item->id))) ?>">
										<?php echo  $item->first_name.' '.$item->last_name ?>
										<p><?php echo  $item->leave_category ?> (<?php echo date(get_option('date_format'), strtotime($item->start_date)) ?>)</p>
									</a>
								</li>
								<?php } } ?> 
								
							</ul>
						</li>
						<li class="footer"><a href="<?php echo site_url('admin/employee/applicationList') ?>"><?= lang('view_all') ?></a></li>
					</ul>
          </li>-->
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo base_url('assets/admin')?>/dist/img/admin.png" class="user-image" alt="User Image">
              <span class="hidden-xs"> <?php  if(isset($user->firstname)){   echo $user->firstname  ; }?> </span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo base_url('assets/admin')?>/dist/img/admin.png" class="img-circle" alt="User Image">

                <p>
                  <?php  if(isset($user->firstname)){   echo $user->firstname  ; }?> 
                  <small></small>
                </p>
              </li>
              <!-- Menu Body -->
              
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat"><?php echo lang('profile')?></a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo site_url('employee/login/logout')?>" class="btn btn-default btn-flat"><?php echo lang('signout')?></a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
         
        </ul>
      </div>

    </nav>
  </header>
