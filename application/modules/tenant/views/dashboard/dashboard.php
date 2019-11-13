
</script>
<style>
	.skin-blue .wrapper, .skin-blue .main-sidebar, .skin-blue .left-side{background-color: #fff;}
	.main-footer{margin: 0px!important;}
	.dashboard_main_sec{margin: 30px;margin-left: 5%;}
	.card-body h3{font-size: 45px;color: #fff;font-family: 'Source Sans Pro', sans-serif;}
	.card-body .card-title{font-weight: 300;}
	.card-body .card-text{font-weight: 400;}
	.card{padding:50px;}
	.card-body{margin-top: 40px;}
	.card-body .btn-primary{background-color: transparent;border-color: #fff;padding: 0px;width: 120px;height: 35px;border-radius: 4px;line-height: 35px;}
	.card-body .btn_srd{margin-left: 20px;}
	.card_img{width: 249px;height: 211px;background-color: #15305e;text-align: center;padding: 50px 0px 0px;margin: 0px 15px 15px 0px;float: left;}
	.card_img figcaption{font-size: 18px;color: #fff;}
	@media (max-width: 1600px) and (min-width: 1500px){
		.dashboard_main_sec{margin: 30px;margin-left: 10%;}
	}
	@media  (max-width: 1920px) and (min-width: 1900px){
		.card_img{
			margin: 0px 40px 20px 50px;
		}
	}
	@media (max-width: 1280px) and (min-width: 1200px){
		.dashboard_main_sec{margin-left: 3%;}
	}
	@media (max-width: 1024px) and (min-width: 980px){
		.card_img{    width: 190px;}
		.dashbackgound1{width: 100%;}
		.card-body .btn-primary{width: 77px;}
		.card-body h3{font-size: 35px;}
	}
</style>
<section class="dashboard_main_sec">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xl-5 col-md-4 col-sm-4 col-xs-12">
				<div class="card" style="width: 100%;height: 436px;background-color: #2671ee;">
				  <div class="card-body">
					<h3 class="card-title">Hi</h3>
					<h3 class="card-text"><?php  if(isset($user['firstname'])){  echo $user['firstname']; }else{  'Buddy'; } ?></h3>
				  </div>
				  <div class="card-body">
					<a href="#" class="btn btn-primary">Profile</a>
					<a href="<?php echo site_url('tenant/login/logout')?>" class="btn btn-primary btn_srd">Sign Out</a>
				  </div>
				</div>
				<figure style="margin: 15px 0px 0px;">
					<div class="dashboardbackground-bg" style="width: 100%;"></div>
				</figure>
			</div>
			<div class="col-xl-7 col-md-8 col-sm-8 col-xs-12">
				<div class="row">
				<a href="<?php echo site_url('tenant/request/request_list')?>"><figure class="card_img">
					<div class="dashboardmessages"></div>
					<figcaption>Messages</figcaption>
				</figure></a>
				<a href="#"><figure class="card_img">
					<div class="dashboardhouses"></div>
					<figcaption>Houses</figcaption>
				</figure></a>
				<a href="#"><figure class="card_img">
					<div class="dashboardpayment"></div>
					<figcaption>Payment</figcaption>
				</figure></a>
				<a href="<?php echo site_url('tenant/request/request_list')?>"><figure class="card_img">
					<div class="dashboardrequest"></div>
					<figcaption>Request</figcaption>
				</figure></a>
				<a href="#"><figure class="card_img">
					<div class="dashboardprofile"></div>
					<figcaption>Profile</figcaption>
				</figure></a>
				<a href="#"><figure class="card_img back_imh_sec" style="background-color: transparent;padding: 0px;">
					<div class="dashboardbg2"></div>
				</figure></a>
				<a href="#"><figure class="card_img">
					<div class="dashboardmusic-demand"></div>
					<figcaption>Others</figcaption>
				</figure></a>
				<a href="#"><figure class="card_img">
					<div class="dashboardvideo-demand"></div>
					<figcaption>Others</figcaption>
				</figure></a>
				</div>
			</div>
		</div>
	</div>
</section>