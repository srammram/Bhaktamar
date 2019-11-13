<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
	<title>owner</title>
 	<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="<?php echo base_url('assets/admin/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet" type="text/css" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/admin/dist/css/AdminLTE.min.css')?>" rel="stylesheet" type="text/css" />
 	 <link href="https://fonts.googleapis.com/css?family=Barlow+Condensed&display=swap" rel="stylesheet">
  </head>
	<body class="owner-page">
		<section>
			<div class="container">
				<div class="row">
					<div class="owner_box">
						<div class="owner-heading">
							<h3 class="text-center">Owner Login </h3>
						</div>
						<form>
							<div class="form-group has-feedback">
								<input type="text" name="username" value="" class="form-control" placeholder="USERNAME">
            					<span class="form-control-feedback"><div class="remsowner-user"></div></span>
          					</div>
          					<div class="form-group has-feedback">
							 	<input type="password" name="password" value="" class="form-control" placeholder="PASSWORD">
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
						  	</div>
						</form>
					</div>
				</div>
			</div>
		</section>
		
		
		
		
		
		
		
		<script src="<?php echo base_url('assets/admin') ?>/plugins/jQuery/jquery-2.2.3.min.js"></script>
		<script src="<?php echo base_url('assets/admin/bootstrap/js/bootstrap.min.js')?>" type="text/javascript"></script>
		<script src="<?php echo base_url('assets/admin/dist/js/demo.js')?>" type="text/javascript"></script>
  </body>
</html>
           