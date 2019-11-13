<style>
	.content-wrapper, .right-side{background-color: #d2d6de;}
	figure{
	border: 1.5px solid #2c3542;
    padding: 20px;
    margin: 40px;
    border-radius: 50px;
	}
	figure figcaption h3{font-size: 24px;color: #2c3542;font-weight: 600;}
	.number_notify{position: absolute;right: 10%;background-color: red;color: #fff;width: 50px;height: 50px;top: 10%;line-height: 50px;border-radius: 50px;font-size: 16px;}
/*	media quries*/
	@media (max-width: 1366px) and (min-width: 1362px){
		figure img{width: 120px;height: 120px;}
		.number_notify{right: 13%;}
	}
		body,.content{
		background-color:#fff;
	}
</style>

<section class="content">
	<div class="row">
	<div class="col-sm-12 col-xs-12">
		<div class="col-sm-4 col-xs-12">
			<a href="<?php echo site_url('admin/Office/Booked_guestlist') ?>">
				<figure class="text-center">
					<img src="<?php echo base_url('assets/admin')?>/dist/img/directory.png" width="150px" height="150px" alt="Directory">
					<figcaption>
						<h3>Directory</h3>
					</figcaption>
				<!--	<span class="number_notify">10</span>-->
				</figure>
			</a>
		</div>
		<div class="col-sm-4 col-xs-12">
			<a href="<?php echo site_url('admin/Office/booking_dashboard') ?>">
				<figure class="text-center">
					<img src="<?php echo base_url('assets/admin')?>/dist/img/booking.png" width="150px" height="150px" alt="available">
					<figcaption>
						<h3>Booking</h3>
					</figcaption>
				</figure>
			</a>
		</div>
		<div class="col-sm-4 col-xs-12">
			<a href="<?php echo site_url('admin/Office/services_level') ?>">
				<figure class="text-center">
					<img src="<?php echo base_url('assets/admin')?>/dist/img/services.png"  width="150px" height="150px" alt="available">
					<figcaption>
						<h3>Services</h3>
					</figcaption>
					<span class="number_notify"><?php if(isset($complaint)){ echo $complaint; }  ?></span>
				</figure>
			</a>
		</div>
		<!--<div class="col-sm-4 col-xs-12">
			<a href="#">
				<figure class="text-center">
					<img src="<?php echo base_url('assets/admin')?>/dist/img/accounts.png"  width="150px" height="150px" alt="available">
					<figcaption>
						<h3>Accounts</h3>
					</figcaption>
				</figure>
			</a>
		</div>-->
		<div class="col-sm-4 col-xs-12">
			<a href="#">
				<figure class="text-center">
					<img src="<?php echo base_url('assets/admin')?>/dist/img/report.png"  width="150px" height="150px" alt="available">
					<figcaption>
						<h3>Reports</h3>
					</figcaption>
				</figure>
			</a>
		</div>
	</div>
	</div>
</section>