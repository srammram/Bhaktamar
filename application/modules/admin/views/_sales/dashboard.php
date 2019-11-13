<style>
	.content-wrapper, .right-side{background-color: #d2d6de;}
	figure{
	border: 1.5px solid #2c3542;
    padding: 20px;
    margin: 40px 0px;
    border-radius: 50px;
	}
	figure figcaption h3{font-size: 24px;color: #2c3542;font-weight: 600;}
	.number_notify{position: absolute;right: 10%;background-color: red;color: #fff;width: 50px;height: 50px;top: 10%;line-height: 50px;border-radius: 50px;font-size: 16px;}
	@media (max-width: 1366px) and (min-width: 1362px){
		figure img{width: 120px;height: 120px;}
		.number_notify{right: 13%;}
	}
		body,.content{
		background-color:#fff;
	}
	.col-half-offset{
    margin-left:4.166666667%;
}
figure figcaption h3{font-size:18px;}
@media (max-width: 1366px) and (min-width: 1362px)
figure img {
    width: 120px;
    height: 120px;
}
@media (max-width: 1280px) {
	figure img{width:100px;height:100px;}
	figure figcaption h3{font-size:16px!important;}
}
</style>
<section class="content">
	<div class="row">
	<div class="col-sm-12 col-xs-12">
		<div class="col-sm-2 col-xs-12">
			<a href="<?php echo site_url('admin/Project') ?>">
				<figure class="text-center">
					<img src="<?php echo base_url('assets/admin')?>/dist/img/dashboard/Property.png" width="150px" height="150px" alt="Directory">
					<figcaption>
						<h3><?php echo lang('Property');?></h3>
					</figcaption>
				<!--	<span class="number_notify">10</span>-->
				</figure>
			</a>
		</div>
		<div class="col-sm-2 col-half-offset col-xs-12">
			<a href="<?php echo site_url('admin/Facility') ?>">
				<figure class="text-center">
					<img src="<?php echo base_url('assets/admin')?>/dist/img/dashboard/Facility.png" width="150px" height="150px" alt="available">
					<figcaption>
						<h3><?php echo lang('Facility');?></h3>
					</figcaption>
				</figure>
			</a>
		</div>
		<div class="col-sm-2 col-xs-12 col-half-offset">
			<a href="#">
				<figure class="text-center">
					<img src="<?php echo base_url('assets/admin')?>/dist/img//dashboard/Inventory-Management.1.png"  width="150px" height="150px" alt="available">
					<figcaption>
						<h3><?php echo lang('Asset_Inventory_Management');?></h3>
					</figcaption>
				</figure>
			</a>
		</div>
			<div class="col-sm-2 col-xs-12 col-half-offset">
			<a href="#">
				<figure class="text-center">
					<img src="<?php echo base_url('assets/admin')?>/dist/img/dashboard/Accounts.png"  width="150px" height="150px" alt="available">
					<figcaption>
						<h3><?php echo lang('Accounts');?></h3>
					</figcaption>
				</figure>
			</a>
		</div>	
		<div class="col-sm-2 col-xs-12 col-half-offset">
			<a href="#">
				<figure class="text-center">
					<img src="<?php echo base_url('assets/admin')?>/dist/img/dashboard/CRM.png"  width="150px" height="150px" alt="available">
					<figcaption>
						<h3><?php echo lang('HRMS');?></h3>
					</figcaption>
				</figure>
			</a>
		</div>	
		<div class="row">
		<div class="col-sm-2 col-xs-12 ">
			<a href="<?php echo site_url('admin/Crm/Crm') ?>">
				<figure class="text-center">
					<img src="<?php echo base_url('assets/admin')?>/dist/img/dashboard/CRM.png"  width="150px" height="150px" alt="available">
					<figcaption>
						<h3><?php echo lang('CRM');?></h3>
					</figcaption>
				</figure>
			</a>
		</div>	
		<div class="col-sm-2 col-xs-12 col-half-offset disabled ">
			<a href="#">
				<figure class="text-center">
					<img src="<?php echo base_url('assets/admin')?>/dist/img/dashboard/Marketing.png"  width="150px" height="150px" alt="available">
					<figcaption>
						<h3><?php echo lang('Marketing');?></h3>
					</figcaption>
				</figure>
			</a>
		</div>	
		<div class="col-sm-2 col-xs-12 col-half-offset">
			<a href="#">
				<figure class="text-center">
					<img src="<?php echo base_url('assets/admin')?>/dist/img/dashboard/Sales.png"  width="150px" height="150px" alt="available">
					<figcaption>
					<h3><?php echo lang('Sales');?></h3>
					</figcaption>
				</figure>
			</a>
		</div>	
		<div class="col-sm-2 col-xs-12 col-half-offset">
			<a href="<?php echo site_url('admin/ParkingManager') ?>">
				<figure class="text-center">
					<img src="<?php echo base_url('assets/admin')?>/dist/img/dashboard/Parking-Management.png"  width="150px" height="150px" alt="available">
					<figcaption>
						<h3  style="font-size:18px;"><?php echo lang('Parking_Management');?></h3>
					</figcaption>
				</figure>
			</a>
		</div>	
		<div class="col-sm-2 col-xs-12 col-half-offset">
		<a href="<?php echo site_url('admin/ManageCommittee') ?>">
				<figure class="text-center">
					<img src="<?php echo base_url('assets/admin')?>/dist/img/dashboard/Management-Committee.png"  width="150px" height="150px" alt="available">
					<figcaption>
						<h3 style="font-size:18px;"><?php echo lang('Management_Committee');?></h3>
					</figcaption>
				</figure>
			</a>
		</div>
		</div>
		<div class="row">
		<div class="col-sm-2 col-xs-12 ">
			<a href="#">
				<figure class="text-center">
					<img src="<?php echo base_url('assets/admin')?>/dist/img/dashboard/Administration.png"  width="150px" height="150px" alt="available">
					<figcaption>
						<h3 ><?php echo lang('Administration');?></h3>
					</figcaption>
				</figure>
			</a>
		</div>
		<div class="col-sm-2 col-xs-12 col-half-offset">
			<a href="#">
				<figure class="text-center">
					<img src="<?php echo base_url('assets/admin')?>/dist/img/dashboard/Reports.png"  width="150px" height="150px" alt="available">
					<figcaption>
						<h3 ><?php echo lang('Reports');?></h3>
					</figcaption>
				</figure>
			</a>
		</div>
		
		</div>
	</div>
	</div>
</section>