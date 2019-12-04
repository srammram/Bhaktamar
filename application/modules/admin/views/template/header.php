<?php $admin	=	$this->session->userdata('admin');
      $user	=	$this->auth->get_admin($admin['id']);
	  
	  	$this->db->select("owner_unit_request.id,owner_unit_request.request_status,unit_name,project.Name project,floors.name as floors,building_info.name building,requesteddate,title,request_type,owner_realtion_unitid,view_link");
		$this->db->join("project","project.id=owner_unit_request.projectid","left");
		$this->db->join("floors","floors.id=owner_unit_request.floorid","left");
		$this->db->join("add_unit","add_unit.uid=owner_unit_request.unitid","left");
		$this->db->join("building_info","building_info.bldid=owner_unit_request.buildingid","left");
		$this->db->join("owner_unit_requesttype","owner_unit_requesttype.id=owner_unit_request.request_type","left");
        $this->db->where("soft_deleted", 0);
		$this->db->where("is_read_pmc", 2);
		//$this->db->where("owner_unit_request.owner_id", $Owner['owner_id']);
        $query = $this->db->get("owner_unit_request");
	    $request=$query->result();
		$totalRequest = count($request);
	  
	  
	  
	  
	  
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
  <script src="<?php echo base_url('assets/admin')?>/dist/js/jquery-ui.min.js"></script>
  <script src="<?php echo base_url('assets/admin/plugins/alertify/alertify.min.js')?>"></script>
  <link href="<?php echo base_url('assets/admin/plugins/iCheck/all.css')?>" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap-multiselect.css" type="text/css">
  <link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/customes.css" type="text/css">
  <script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/bootstrap-3.3.2.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/bootstrap-multiselect.js"></script>
  <script src='<?php echo base_url('assets/admin')?>/plugins/jquery-validation/jquery.validate.min.js'></script>
  <script src='<?php echo base_url('assets/admin')?>/plugins/jquery-validation/additional-methods.min.js'></script>
  <script src="<?php echo base_url('assets/admin/') ?>/plugins/datepicker/bootstrap-datepicker.js"></script>
  <script src="<?php echo base_url('assets/admin/plugins/iCheck/icheck.min.js')?>" type="text/javascript"></script>
  <script src="<?php echo base_url('assets/admin/dist/js/app_custom.js')?>" type="text/javascript"></script>	
   <!---           userdefine js        --->
  <script src='<?php echo base_url('assets/admin')?>/dist/js/adminajax.js'></script>
   <script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/customdatatable.js"></script>



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
		function areyousure_undo(e){
			event.preventDefault();
			alertify.confirm("Are You Sure Undo This Payment.",
				function(){
					var href = $(this).attr('href');
					//alert(e);
					window.location = e;
					//lertify.success('Ok');
					
					//$('.ajs-button').text("No");
					return true;
				},
				function(){
					//alertify.error('Cancel');
					return true;
			});
			//return false;
		}
	</script>	
	 <script>
  function genrateMaintenance(e){

			event.preventDefault();
			alertify.confirm("Do You Want To Generate Request To Agreemets.",
				function(){
					$(".ajs-button").text('Confirm');
					var href = $(this).attr('href');
					//alert(e);
					window.location = e;
					//alertify.success('acccpt');
					
					//$('.ajs-button').text("No");
					return true;
				},
				function(){
					alertify.error('Cancel');
					return true;
			}).set('labels', {ok:'Confirm', cancel:'Cancel'}); 
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
<body class="hold-transition skin-blue sidebar-mini ">
<div class="wrapper">

  <header class="main-header">

    <!-- Logo -->
    <a href="<?php echo base_url('admin'); ?>" class="logo">
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
				<li class="dropdown notifications-menu notification_menu">
					<!-- Menu toggle button -->
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
						<i class="fa fa-bell-o"></i>
						<span class="label label-success"><?php echo $totalRequest ?></span>
					</a>
					<ul class="dropdown-menu" id="notification_menu_sec">
						<?php if($totalRequest) { foreach($request as $item){ ?>
							<li class="header">
							<a href="<?php echo base_url('admin/lease/'.$item->view_link).'/'.$item->id ?>">
										<!-- Message title and timestamp -->
										<h5><?php echo $item->title; ?></h5>
										<!-- The message -->
										<p style="font-size:12px;"><?php echo  $item->unit_name .'('.$item->building .')'; ?></p>
										<p style="margin-bottom: 0px;"><span class="pull-left"><a href="<?php echo base_url('admin/lease/request_acceptByPMC').'/'.$item->id ?>"><button type="button" class="btn btn-success btn-xs">Accept</button></a></span>
										<span class="pull-right"><a href="<?php echo base_url('admin/lease/request_declineByPMC').'/'.$item->id ?>"><button type="button" class="btn btn-danger btn-xs">Decline</button></a></span></p>
										</a>
							</li>
							<?php } }else{ ?>
						<li class="header">You have 0 messages</li>
							<?php   }  ?>
						</ul>
							<!-- /.menu -->
						
          </li>
            <li ><a href="<?php echo site_url('/admin/dashboard')?>"><i style="color:white;" class="glyphicon glyphicon-dashboard"></i></a></li>
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
            <a href="#" class="dropdown-toggle login_head" data-toggle="dropdown">
              <img src="<?php echo base_url('assets/admin')?>/dist/img/admin.png" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $user->firstname?> <?php echo $user->lastname?> </span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo base_url('assets/admin')?>/dist/img/admin.png" class="img-circle" alt="User Image">

                <p>
                  <?php echo $user->firstname?> <?php echo $user->lastname?> 
                  <small></small>
                </p>
              </li>
              <!-- Menu Body -->
              
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?php echo site_url('admin/account/profile')?>" class="btn btn-default btn-flat"><?php echo lang('profile')?></a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo site_url('admin/login/logout')?>" class="btn btn-default btn-flat"><?php echo lang('signout')?></a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
         
        </ul>
      </div>

    </nav>
  </header>
<script>
	$(document).ready(function() {
    $(".dropdown-toggle").dropdown();
});</script>