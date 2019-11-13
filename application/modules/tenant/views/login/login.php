<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
<title><?php echo (isset($page_title))?' :: '.$page_title:''; ?></title>
 	 <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="<?php echo base_url('assets/admin/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="<?php echo base_url('assets/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.css')?>" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo base_url('assets/admin/dist/css/AdminLTE.min.css')?>" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link href="<?php echo base_url('assets/admin/dist/css/skins/_all-skins.min.css')?>" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo base_url('assets/admin/plugins/iCheck/all.css')?>" rel="stylesheet" type="text/css" />
	 <!-- jQuery 2.1.4 -->
 	 <script src="<?php echo base_url('assets/admin') ?>/plugins/jQuery/jquery-2.2.3.min.js"></script>
	 <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/admin/dist/css/AdminLTE.min.css')?>" rel="stylesheet" type="text/css" />
 	 <link href="https://fonts.googleapis.com/css?family=Barlow+Condensed&display=swap" rel="stylesheet">
 	
	<body class="owner-page tenant">
		<section>
		<?php 
			
				if($this->session->flashdata('message'))
						$message = $this->session->flashdata('message');
				  if($this->session->flashdata('error'))
						$error  = $this->session->flashdata('error');
					if(function_exists('validation_errors') && validation_errors() != '')
					{
						$error  = validation_errors();
					}
			?>
			
            <?php if(!empty($error) || !empty($message)){ ?>
			<div class="container" style="margin-top:20px;">
					
                    <?php if (!empty($error)): ?>
                    <div class="alert alert-danger alert-dismissable col-md-4 col-md-offset-8">
                        <i class="fa fa-ban"></i>
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <?php echo $error; ?>
                    </div>
                    <?php endif; ?>
                    
                    <?php if (!empty($message)): ?>
                    <div class="alert alert-info alert-dismissable col-md-4 col-md-offset-8">
                        <i class="fa fa-info"></i>
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                       <?php echo $message; ?>
                    </div>
                    <?php endif; ?>
                    
           </div>
           <?php }?>

			<div class="container">
				<div class="row">
					<div class="logo_owner">
						<a href="#"><img src="<?php echo base_url('assets/admin/dist/img/fms.png')?>"</a>
					</div>
				</div>
				<div class="row">
					<div class="owner_box">
						<div class="owner-heading">
							<h3 class="text-center">Tenant Login </h3>
						</div>
						<form action="login" method="post">
							<div class="form-group has-feedback">
								<input type="text" name="username" value="" autocomplete="off" class="form-control" placeholder="USERNAME">
            					<span class="form-control-feedback"><div class="remsowner-user"></div></span>
          					</div>
          					<div class="form-group has-feedback">
							 	<input type="password" name="password" autocomplete="off" value="" class="form-control" placeholder="PASSWORD">
								<span class="form-control-feedback"><div class="remsowner-pwd"></div></span>
								<span class="form-control-feedback eye"><div class="remsemployee-eye"></div></span>
						  	</div>
						  	<div class="checkbox text-right">
								<label>
								<a href="#">FORGET PASSWORD</a> 
								</label>
						  	</div>
						  	<div class="form-group text-center">
						  		<input type="submit" class="btn btn-primary" value="LOGIN">
								  <input type="hidden" value="<?php echo $redirect; ?>" name="redirect"/>
								<input type="hidden" value="submitted" name="submitted"/>
						  	</div>
						</form>
					</div>
				</div>
			</div>
		</section>
		
       
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

  
		
		<script src="<?php echo base_url('assets/admin') ?>/plugins/jQuery/jquery-2.2.3.min.js"></script>
		<script src="<?php echo base_url('assets/admin/bootstrap/js/bootstrap.min.js')?>" type="text/javascript"></script>
		<script src="<?php echo base_url('assets/admin/dist/js/demo.js')?>" type="text/javascript"></script>
  </body>
</html>
           