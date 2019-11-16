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
	@media (max-width: 1366px) and (min-width: 1362px){
 figure img {
    width: 120px;
    height: 120px;
  }}
  @media (max-width: 1280px) {
	figure img{width:100px;height:100px;}
	figure figcaption h3{font-size:16px!important;}
}
	.main-footer{margin-left: 0px;}
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
				</figure>
			</a>
		</div>
		<div class="col-sm-2 col-half-offset col-xs-12">
			<a href="<?php echo site_url('admin/Owner') ?>">
				<figure class="text-center">
					<img src="<?php echo base_url('assets/admin')?>/dist/img/dashboard/People-01.png" width="150px" height="150px" alt="available">
					<figcaption>
						<h3><?php echo lang('people');?></h3>
					</figcaption>
				</figure>
			</a>
		</div>
			<div class="col-sm-2 col-half-offset col-xs-12">
			<a href="<?php echo site_url('admin/Lease') ?>">
				<figure class="text-center">
					<img src="<?php echo base_url('assets/admin')?>/dist/img/dashboard/Lease-01.png" width="150px" height="150px" alt="available">
					<figcaption>
						<h3 style="font-size:16px;"><?php echo lang('lease_management');?></h3>
					</figcaption>
				</figure>
			</a>
		</div>
		<div class="col-sm-2 col-xs-12 col-half-offset">
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
			<a href="<?php echo site_url('/admin/procurment/products') ?>">
				<figure class="text-center">
					<img src="<?php echo base_url('assets/admin/')?>/dist/img//dashboard/Inventory-Management.1.png"  width="150px" height="150px" alt="available">
					<figcaption>
					<h3><?php echo lang('Asset_Inventory_Management');?></h3>
					</figcaption>
				</figure>
			</a>
		</div>	
			
		<div class="row">
		<div class="col-sm-2 col-xs-12 ">
			<a href="<?php echo site_url('admin/accounts/bill') ?>">
				<figure class="text-center">
				<img src="<?php echo base_url('assets/admin')?>/dist/img/dashboard/Accounts.png"  width="150px" height="150px" alt="available">
					<figcaption>
					<h3><?php echo lang('Accounts');?></h3>
					</figcaption>
				</figure>
			</a>
		</div>
		<div class="col-sm-2 col-xs-12 col-half-offset">
			<a href="<?php echo site_url('admin/payroll/home') ?>">
				<figure class="text-center">
			<img src="<?php echo base_url('assets/admin')?>/dist/img/dashboard/Hrms1-01.png"  width="150px" height="150px" alt="available">
					<figcaption>
				<h3><?php echo lang('HRMS');?></h3>
				</figcaption>
				</figure>
			</a>
		</div>	
	  <div class="col-sm-2 col-xs-12 col-half-offset disabled ">
		    <a href="<?php echo site_url('admin/crm/Crm/enquirys') ?>">
				<figure class="text-center">
					<img src="<?php echo base_url('assets/admin')?>/dist/img/dashboard/CRM.png"  width="150px" height="150px" alt="available">
					<figcaption>
						<h3><?php echo lang('CRM');?></h3>
					</figcaption>
				</figure>
			</a>
		</div>	
		<!--<div class="col-sm-2 col-xs-12 col-half-offset">
		    <a href="<?php echo site_url('admin/crm/Crm/Sales/') ?>">
				<figure class="text-center">
					<img src="<?php echo base_url('assets/admin')?>/dist/img/dashboard/Marketing.png"  width="150px" height="150px" alt="available">
					<figcaption>
						<h3><?php echo lang('Marketing');?></h3>
					</figcaption>
				</figure>
			</a>
		</div>	-->
		<div class="col-sm-2 col-xs-12 col-half-offset">
			<a href="<?php echo site_url('admin/booking') ?>">
				<figure class="text-center">
					<img src="<?php echo base_url('assets/admin')?>/dist/img/dashboard/Sales.png"  width="150px" height="150px" alt="available">
					<figcaption>
					<h3><?php echo lang('Sales');?></h3>
					</figcaption>
				</figure>
			</a>
		</div>	
		<div class="col-sm-2 col-xs-12 col-half-offset">			
		    <a href="<?php echo site_url('admin/vendor/service_provider') ?>">
				<figure class="text-center">
					<img src="<?php echo base_url('assets/admin')?>/dist/img/dashboard/Vendor management-01.png"  width="150px" height="150px" alt="available">
					<figcaption>
						<h3 ><?php echo lang('users');?></h3>
					</figcaption>
				</figure>
			</a>
		</div>
		<div class="col-sm-2 col-xs-12">
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
		<div class="col-sm-2 col-xs-12 col-half-offset">			
			<a href="<?php echo site_url('admin/administration/Administration') ?>">
				<figure class="text-center">
				<img src="<?php echo base_url('assets/admin')?>/dist/img/dashboard/Admin-01.png"  width="150px" height="150px" alt="available">
					<figcaption>
						<h3 ><?php echo lang('Administration');?></h3>
					</figcaption>
				</figure>
			</a>
		</div>
		<div class="col-sm-2 col-xs-12 col-half-offset">			
			<a href="<?php echo site_url('admin/Reports') ?>">
				<figure class="text-center">
					<img src="<?php echo base_url('assets/admin')?>/dist/img/dashboard/Reports.png"  width="150px" height="150px" alt="available">
					<figcaption>
						<h3 ><?php echo lang('Reports');?></h3>
					</figcaption>
				</figure>
			</a>
		</div>
		<div class="col-sm-2 col-xs-12 col-half-offset">			
			<a href="<?php echo site_url('admin/settings') ?>">
				<figure class="text-center">
					<img src="<?php echo base_url('assets/admin')?>/dist/img/dashboard/settings-01.png"  width="150px" height="150px" alt="available">
					<figcaption>
						<h3 ><?php echo lang('Masters');?></h3>
					</figcaption>
				</figure>
			</a>
		</div>
		</div>
	</div>
	</div>
</section>