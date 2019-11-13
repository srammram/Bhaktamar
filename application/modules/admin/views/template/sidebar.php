<?php $admin	=	$this->session->userdata('admin');
		$user	=	$this->auth->get_admin($admin['id']);
?>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION </li>
            <!----  property start                 ----->
            <?php    if( $this->uri->segment(2)=='Project' ||$this->uri->segment(1)=='project'||$this->uri->segment(2)=='unit' ||$this->uri->segment(2)=='Unit' || $this->uri->segment(2)=='floors'||$this->uri->segment(2)=='Building' ||$this->uri->segment(2)=='Task' || $this->uri->segment(2)=='estimation'||$this->uri->segment(2)=='Estimation' || $this->uri->segment(2)=='task'||$this->uri->segment(2)=='costing' || $this->uri->segment(2)=='Costing' || $this->uri->segment(2)=='FinalSheet'|| $this->uri->segment(2)=='Parking'){   ?>
            <li><a href="<?php echo site_url('admin/dashboard')?>"><i class="fa fa-circle-o"></i>
                    <span><?php echo lang('dashboard');?></span></a></li>
      <!--    <li>
                <a href="#">
                    <i class="fa fa-trello"></i>
                    <span><?php echo lang('Project')?></span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
               <li class="<?php echo ($this->uri->segment(2)=='Project')?'active':''?>"><a
                            href="<?php echo site_url('admin/Project')?>"><i class="fa fa-circle-o"></i>
                            <span><?php echo lang('Project');?></span></a></li>
							  <li class="<?php echo ($this->uri->segment(2)=='Project')?'active':''?>"><a
                            href="<?php echo site_url('admin/Project/task')?>"><i class="fa fa-circle-o"></i>
                            <span><?php echo lang('Task');?></span></a></li>
             <li class="<?php echo ($this->uri->segment(3)=='Estimation')?'active':''?>"><a href="<?php echo site_url('admin/Project/Estimation')?>"><i class="fa fa-circle-o"></i> <span><?php echo lang('Project_estimation');?></span></a></li>
		          <li class="<?php echo ($this->uri->segment(2)=='Project')?'active':''?>"><a href="<?php echo site_url('admin/Project/ProjectDevelopment')?>"><i class="fa fa-circle-o"></i> <span><?php echo lang('Project_development');?></span></a></li>
	            	<li class="<?php echo ($this->uri->segment(2)=='Project')?'active':''?>"><a href="<?php echo site_url('admin/Project/ProjectProgress')?>"><i class="fa fa-circle-o"></i> <span><?php echo lang('Project_planner');?></span></a></li>
                </ul>
            </li>-->
			<li class="<?php echo ($this->uri->segment(2)=='Project' &&$this->uri->segment(3) !='stage_approval')?'active':''?>"><a
                    href="<?php echo site_url('admin/Project')?>"><i class="fa fa-building-o"></i>
                    <span><?php echo lang('Project');?></span></a></li>
		  <li class="<?php echo ($this->uri->segment(3)=='stage_approval')?'active':''?>"><a
                    href="<?php echo site_url('admin/Project/stage_approval')?>"><i class="fa fa-building-o"></i>
                    <span><?php echo lang('stage_approval');?></span></a></li>
		    <li class="<?php echo ($this->uri->segment(2)=='Task')?'active':''?>"><a
                    href="<?php echo site_url('admin/Task')?>"><i class="fa fa-fax"></i>
                    <span><?php echo lang('Task');?></span></a></li>
					<li class="<?php echo ($this->uri->segment(2)=='Estimation' && $this->uri->segment(3)!='estimation_master')?'active':''?>"><a
                    href="<?php echo site_url('admin/Estimation')?>"><i class="fa fa-cubes"></i>
                    <span><?php echo lang('Estimation');?></span></a></li>
		    <li class="<?php echo ($this->uri->segment(3)=='estimation_master')?'active':''?>"><a
                    href="<?php echo site_url('admin/Estimation/estimation_master')?>"><i class=" fa fa-cog"></i>
                    <span><?php echo lang('estimation_master');?></span></a></li>
		    <li class ="<?php echo ($this->uri->segment(2)=='Costing')?'active':''?>"><a
                    href="<?php echo site_url('admin/Costing')?>"><i class="fa fa-money"></i>
                    <span><?php echo lang('Costing');?></span></a></li>
					<li class ="<?php echo ($this->uri->segment(2)=='FinalSheet')?'active':''?>"><a
                    href="<?php echo site_url('admin/FinalSheet')?>"><i class="fa fa-money"></i>
                    <span><?php echo lang('Final_sheet');?></span></a></li>
            <li class="<?php echo ($this->uri->segment(2)=='Building')?'active':''?>"><a
                    href="<?php echo site_url('admin/Building/building_home')?>"><i class="fa fa-building-o"></i>
                    <span><?php echo lang('building');?></span></a></li>
                 <li class="<?php echo ($this->uri->segment(2)=='floors')?'active':''?>"><a
                    href="<?php echo site_url('admin/floors')?>"><i class="fa fa-building-o"></i>
                    <span><?php echo lang('floors');?></span></a></li>
			  <li class="<?php echo ($this->uri->segment(2)=='Parking')?'active':''?>"><a
                    href="<?php echo site_url('admin/Parking')?>"><i class="fa fa-building-o"></i>
               <span><?php echo lang('parking_area');?></span></a>
			  </li>
               <li>
                <a href="#">
                    <i class="fa fa-trello"></i>
                    <span><?php echo lang('unit')?></span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php echo ($this->uri->segment(2)=='unit')?'active':''?>"><a
                            href="<?php echo site_url('admin/unit')?>"><i class="fa fa-circle-o"></i>
                            <span><?php echo lang('Units');?></span></a></li>
                    <li class="<?php echo ($this->uri->segment(3)=='importUnits')?'active':''?>"><a
                            href="<?php echo site_url('admin/unit/importUnits')?>"><i class="fa fa-circle-o"></i>
                            <span><?php echo lang('Import_unit');?></span></a></li>
                </ul>
            </li>
            <?php   }  ?>

            <?php    if($this->uri->segment(2)=='Owner' ||$this->uri->segment(2)=='Ex_staff' ||$this->uri->segment(2)=='guests' ||$this->uri->segment(2)=='Resident'){   ?>
            <li><a href="<?php echo site_url('admin/dashboard')?>"><i class="fa fa-circle-o"></i>
                    <span><?php echo lang('dashboard');?></span></a></li>
            <li class="<?php echo ($this->uri->segment(2)=='Owner')?'active':''?>"><a
                    href="<?php echo site_url('admin/Owner')?>"><i class="fa fa-circle-o"></i>
                    <span><?php echo lang('Owner');?></span></a></li>
            <li class="<?php echo ($this->uri->segment(2)=='Resident')?'active':''?>"><a
                    href="<?php echo site_url('admin/Resident')?>"><i class="fa fa-circle-o"></i>
                    <span><?php echo lang('Resident');?></span></a></li>
            <!--	<li class="<?php echo ($this->uri->segment(2)=='Leaseowner')?'active':''?>"><a href="<?php echo site_url('admin/Leaseowner')?>"><i class="fa fa-circle-o"></i> <span><?php echo lang('Lease_Owner');?></span></a></li>-->
            <!---<li class="<?php echo ($this->uri->segment(2)=='guests')?'active':''?>"><a href="<?php echo site_url('admin/guests')?>"><i class="fa fa-circle-o"></i> <span><?php echo lang('guests');?></span></a></li>-->
            <li class="<?php echo ($this->uri->segment(2)=='Ex_staff')?'active':''?>"><a
                    href="<?php echo site_url('admin/Ex_staff')?>"><i class="fa fa-circle-o"></i>
                    <span><?php echo lang('External_staff');?></span></a></li>
            <li class="<?php echo ($this->uri->segment(3)=='people_settings')?'active':''?>"><a
                    href="<?php echo site_url('admin/settings/people_settings')?>"><i class="fa fa-circle-o"></i>
                    <span><?php echo lang('people_settings');?></span></a></li>
				<!--	<li>
                <a href="#">
                    <i class="fa fa-circle-o"></i>
                    <span><?php echo lang('agreements')?></span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php echo ($this->uri->segment(2)=='unit')?'active':''?>"><a
                            href="<?php echo site_url('admin/unit')?>"><i class="fa fa-circle-o"></i>
                            <span><?php echo lang('Owner_to_pmc');?></span></a></li>
                    <li class="<?php echo ($this->uri->segment(3)=='importUnits')?'active':''?>"><a
                            href="<?php echo site_url('admin/unit/importUnits')?>"><i class="fa fa-circle-o"></i>
                            <span><?php echo lang('Pmc_to_owner');?></span></a></li>
                </ul>
            </li>-->
            <?php   }  ?>

            <?php    if($this->uri->segment(2)=='Lease' ||$this->uri->segment(2)=='lease' ||$this->uri->segment(2)=='Tenant'  ||$this->uri->segment(2)=='tenant'){   ?>
            <li><a href="<?php echo site_url('admin/lease')?>"><i class="fa fa-circle-o"></i>
                    <span><?php echo lang('request');?></span></a></li>
            <li class="<?php echo ($this->uri->segment(2)=='Owner')?'active':''?>"><a
                    href="<?php echo site_url('admin/Tenant/tenant_list')?>"><i class="fa fa-circle-o"></i>
                    <span><?php echo lang('Tenant');?></span></a></li>
				 <li>
                <a href="#">
                    <i class="fa fa-circle-o"></i>
                    <span><?php echo lang('agreements')?></span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                   <li class="<?php echo ($this->uri->segment(3)=='lease_agreements')?'active':''?>"><a
                            href="<?php echo site_url('admin/lease/lease_agreements')?>"><i class="fa fa-circle-o"></i>
                            <span><?php echo lang('Lease_agreement');?></span></a></li>
                    <li class="<?php echo ($this->uri->segment(3)=='maintenance_agreements')?'active':''?>"><a
                            href="<?php echo site_url('admin/lease/maintenance_agreements')?>"><i class="fa fa-circle-o"></i>
                            <span><?php echo lang('maintenance_agreement');?></span></a></li>
                </ul>
            </li>
            <?php   }  ?>

            <?php    if($this->uri->segment(2)=='Facility' ||$this->uri->segment(3)=='services' ||$this->uri->segment(3)=='servicesview'||$this->uri->segment(3)=='service_form' &&$this->uri->segment(2) !='vendor'){   ?>
            <li><a href="<?php echo site_url('admin/dashboard')?>"><i class="fa fa-circle-o"></i>
                    <span><?php echo lang('dashboard');?></span></a></li>
            <li class="<?php echo ($this->uri->segment(2)=='Facility')?'active':''?>"><a
                    href="<?php echo site_url('admin/Facility')?>"><i class="fa fa-fire-extinguisher"></i>
                    <span><?php echo lang('Facility');?></span></a></li>
            <li class="<?php echo ($this->uri->segment(3)=='utility_services')?'active':''?>"><a
                    href="<?php echo site_url('admin/Facility/utility_services')?>"><i class="fa fa-circle-o"></i>
                    <span><?php echo lang('utility_services');?></span></a></li>
            <?php   }  ?>
			
            <?php    if($this->uri->segment(2)=='ManageCommittee' ||$this->uri->segment(2)=='Fund' ||$this->uri->segment(2)=='fund' ){   ?>
            <li><a href="<?php echo site_url('admin/dashboard')?>"><i class="fa fa-circle-o"></i>
                    <span><?php echo lang('dashboard');?></span></a></li>
					 <li><a href="<?php echo site_url('admin/ManageCommittee')?>"><i class="fa fa-circle-o"></i>
                    <span><?php echo lang('Management_committee');?></span></a></li>
				  <li>
                <a href="#">
                    <i class="fa fa-circle-o"></i>
                    <span><?php echo lang('Fund')?></span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php echo ($this->uri->segment(2)=='settings')?'active':''?>"><a
                            href="<?php echo site_url('admin/Fund/reserve_fund')?>"><i class="fa fa-circle-o"></i>
                            <span><?php echo lang('reserve_fund');?></span></a></li>
                    <li class="<?php echo ($this->uri->segment(2)=='ManageCommittee')?'active':''?>"><a
                            href="<?php echo site_url('admin/Fund/property_management_fee')?>"><i
                                class="fa fa-circle-o"></i><span><?php echo lang('property_management_fee');?></span></a>
                    </li>
                </ul>
            <!--<li class="<?php echo ($this->uri->segment(3)=='Office/Leaseowner')?'active':''?>"><a href="<?php echo site_url('admin/Leaseowner')?>"><i class="fa fa-user-plus"></i> <span><?php echo lang('Lease_Owner');?></span></a></li>-->

            </li>
            <?php   }  ?>
			
			
            <?php    if($this->uri->segment(2)=='ParkingManager' || $this->uri->segment(3)=='Parking' ){   ?>
            <li><a href="<?php echo site_url('admin/dashboard')?>"><i class="fa fa-circle-o"></i>
                    <span><?php echo lang('dashboard');?></span></a></li>
            <li class="<?php echo ($this->uri->segment(4)=='Parking')?'active':''?>"><a
                    href="<?php echo site_url('admin/ParkingManager')?>"><i class="fa fa-circle-o"></i>
                    <span><?php echo lang('Parking_Manager');?></span></a></li>
            <li class="<?php echo ($this->uri->segment(4)=='Parking')?'active':''?>"><a
                    href="<?php echo site_url('admin/Office/Parking')?>"><i class="fa fa-circle-o"></i>
                    <span><?php echo lang('Parking_monitor');?></span></a></li>
            <?php   }  ?>

            <?php    if($this->uri->segment(2)=='crm' || $this->uri->segment(3)=='Crm' ){   ?>
            <li><a href="<?php echo site_url('admin/dashboard')?>"><i class="fa fa-circle-o"></i>
                    <span><?php echo lang('dashboard');?></span></a></li>
            <li><a href="<?php echo site_url('admin/crm/Crm/Enquiry/')?>"><i class="fa fa-circle-o"></i>
                    <span><?php echo lang('Enquiry');?></span></a></li>
					<li><a href="<?php echo site_url('admin/crm/Crm/Enquiry_trash/')?>"><i class="fa fa-circle-o"></i>
                    <span><?php echo lang('EnquiryTrash');?></span></a></li>
            <li class="<?php echo ($this->uri->segment(4)=='followup')?'active':''?>"><a
                    href="<?php echo site_url('admin/crm/Crm/followup/')?>"><i class="fa fa-circle-o"></i>
                    <span><?php echo lang('FollowUp');?></span></a></li>
					  <li class="<?php echo ($this->uri->segment(4)=='ClientList')?'active':''?>"><a
                    href="<?php echo site_url('admin/crm/Crm/ClientList/')?>"><i class="fa fa-circle-o"></i>
                    <span><?php echo lang('Customer');?></span></a></li>
            <li class="<?php echo ($this->uri->segment(4)=='campaign')?'active':''?>"><a
                    href="<?php echo site_url('admin/crm/Crm/campaign/')?>"><i class="fa fa-circle-o"></i>
                    <span><?php echo lang('campaign');?></span></a></li>
					  <li class="<?php echo ($this->uri->segment(2)=='Project')?'active':''?>"><a href="<?php echo site_url('admin/crm/Crm/sms')?>"><i class="fa fa-circle-o"></i> <span><?php echo lang('send_sms');?></span></a></li>
	            	<li class="<?php echo ($this->uri->segment(2)=='Project')?'active':''?>"><a href="<?php echo site_url('admin/crm/Crm/sms_history')?>"><i class="fa fa-circle-o"></i> <span><?php echo lang('sms_history');?></span></a></li>
					    
            <?php   }  ?>
            <?php    if($this->uri->segment(2)=='sales' || $this->uri->segment(3)=='Sales' ){   ?>
            <li><a href="<?php echo site_url('admin/dashboard')?>"><i class="fa fa-circle-o"></i>
                    <span><?php echo lang('dashboard');?></span></a></li>
            <li><a href="<?php echo site_url('admin/sales/Sales')?>"><i class="fa fa-circle-o"></i>
                    <span><?php echo lang('Bookinglist');?></span></a></li>
          
            <?php   }  ?>
			
            <?php    if($this->uri->segment(2)=='administration' ){   ?>
            <li><a href="<?php echo site_url('admin/dashboard')?>"><i class="fa fa-circle-o"></i>
                    <span><?php echo lang('dashboard');?></span></a></li>
            <li><a href="<?php echo site_url('admin/administration/Administration')?>"><i class="fa fa-circle-o"></i>
                    <span><?php echo lang('request_board');?></span></a></li>
            <li><a href="<?php echo site_url('admin/administration/Administration/requestList')?>"><i
                        class="fa fa-circle-o"></i> <span><?php echo lang('request');?></span></a></li>
           <!-- <li><a href="<?php echo site_url('admin/administration/Administration')?>"><i class="fa fa-circle-o"></i>
                    <span><?php echo lang('billing');?></span></a></li>-->
            <?php   }  ?>
			
            <!--       Vendor          -->
            <?php if($this->uri->segment(2)=='vendor' || $this->uri->segment(2)=='Users' ){   ?>
            <!--<li ><a href="<?php echo site_url('admin/vendor/services')?>"><i class="fa fa-circle-o"></i> <span><?php echo lang('services');?></span></a></li>-->
			 <li class="<?php echo ($this->uri->segment(2)=='Owner')?'active':''?>"><a
                    href="<?php echo site_url('admin/Users')?>"><i class="fa fa-circle-o"></i>
                    <span><?php echo lang('users');?></span></a></li>
				 <li>
                <a href="#">
                    <i class="fa fa-circle-o"></i>
                    <span><?php echo lang('public_users')?></span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo site_url('admin/vendor/service_provider')?>"><i class="fa fa-circle-o"></i>
                    <span><?php echo lang('service_provider');?></span></a></li>
            <li class="<?php echo ($this->uri->segment(3)=='settings')?'active':''?>"><a
                    href="<?php echo site_url('admin/settings/contractor')?>"><i class="fa fa-circle-o"></i>
                    <span><?php echo lang('contractor');?></span></a></li>
            <li><a href="<?php echo site_url('admin/vendor/pmc')?>"><i class="fa fa-circle-o"></i>
                    <span><?php echo lang('pmc');?></span></a></li>
                </ul>
            </li>
            <?php   }  ?>
            <?php if($this->uri->segment(2)=='Reports' ){   ?>
              <li ><a href="<?php echo site_url('admin/Reports')?>"><i class="fa fa-circle-o"></i> <span><?php echo lang('client_reports');?></span></a></li>
		      <li ><a href="<?php echo site_url('admin/Reports/booking_report')?>"><i class="fa fa-circle-o"></i> <span><?php echo lang('booking_reports');?></span></a></li>	
		      <li ><a href="<?php echo site_url('admin/Reports/unAttendant_report')?>"><i class="fa fa-circle-o"></i> <span><?php echo lang('unattendant_enquiry');?></span></a></li>
		      <li ><a href="<?php echo site_url('admin/Reports/pendingFollowup_report')?>"><i class="fa fa-circle-o"></i> <span><?php echo lang('Pending_followup');?></span></a></li>
		      <li ><a href="<?php echo site_url('admin/Reports/prospectiveEnquiry_report')?>"><i class="fa fa-circle-o"></i> <span><?php echo lang('Prospective_enquiry');?></span></a></li>
		      <li ><a href="<?php echo site_url('admin/Reports/unit_report')?>"><i class="fa fa-circle-o"></i> <span><?php echo lang('unit_reports');?></span></a></li>
		      <li ><a href="<?php echo site_url('admin/Reports/salemanwiseSales_report')?>"><i class="fa fa-circle-o"></i> <span><?php echo lang('salemanwise_sales');?></span></a></li>	
              <li ><a href="<?php echo site_url('admin/Reports/saleReport')?>"><i class="fa fa-circle-o"></i> <span><?php echo lang('sales_report');?></span></a></li>		
             <li><a href="<?php echo site_url('admin/Reports/projectStatus_report')?>"><i class="fa fa-circle-o"></i>
                    <span><?php echo lang('project_status');?></span></a></li>
            <?php   }  ?>
            <?php  if($this->uri->segment(2)=='Inventory'  || $this->uri->segment(2)=='Inventory'  || $this->uri->segment(2)=='procurment' || $this->uri->segment(2)=='Procurment' ){  ?>
          
					 <li>
                <a href="#">
                    <i class="fa fa-circle-o"></i>
                    <span><?php echo lang('Inventory')?></span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php echo ($this->uri->segment(3)=='products')?'active':''?>"><a
                            href="<?php echo site_url('/admin/procurment/products')?>"><i
                                class="fa fa-circle-o"></i><span><?php echo lang('products');?></span></a>
                    </li>
					<li class="<?php echo ($this->uri->segment(3)=='rental_paymentlist')?'active':''?>"><a
                            href="<?php echo site_url('admin/procurment/purchase_invoices/')?>"><i
                                class="fa fa-circle-o"></i><span><?php echo lang('purchase_invoices');?></span></a>
                    </li>
					<li class="<?php echo ($this->uri->segment(3)=='rental_paymentlist')?'active':''?>"><a
                            href="<?php echo site_url('admin/procurment/products/stocklist/')?>"><i
                                class="fa fa-circle-o"></i><span><?php echo lang('stock');?></span></a>
                    </li>
					 
                </ul>
				</li>
            <li class="<?php echo ($this->uri->segment(3)=='Inventory')?'active':''?>"><a
                    href="<?php echo site_url('admin/Inventory/Assets_list')?>"><i
                        class="fa fa-circle-o"></i><span><?php echo lang('Assets');?></span></a></li>
				<li>
                <a href="#">
                    <i class="fa fa-circle-o"></i>
                    <span><?php echo lang('settings')?></span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php echo ($this->uri->segment(4)=='tax')?'active':''?>"><a
                            href="<?php echo site_url('/admin/procurment/products/tax')?>"><i
                                class="fa fa-circle-o"></i><span><?php echo lang('tax');?></span></a>
                    </li>
					<li class="<?php echo ($this->uri->segment(4)=='categories')?'active':''?>"><a
                            href="<?php echo site_url('admin/procurment/products/categories')?>"><i
                                class="fa fa-circle-o"></i><span><?php echo lang('categories_');?></span></a>
                    </li>
					<li class="<?php echo ($this->uri->segment(4)=='department')?'active':''?>"><a
                            href="<?php echo site_url('admin/procurment/products/department/')?>"><i
                                class="fa fa-circle-o"></i><span><?php echo lang('department');?></span></a>
                    </li>
					<li class="<?php echo ($this->uri->segment(4)=='brands')?'active':''?>"><a
                            href="<?php echo site_url('admin/procurment/products/brand/')?>"><i
                                class="fa fa-circle-o"></i><span><?php echo lang('brands');?></span></a>
                    </li>
					<li class="<?php echo ($this->uri->segment(4)=='unit')?'active':''?>"><a
                            href="<?php echo site_url('admin/procurment/products/unit/')?>"><i
                                class="fa fa-circle-o"></i><span><?php echo lang('unit');?></span></a>
                    </li>
					 
                </ul>
				</li>
            <?php    }    ?>
			
			
			<?php    if($this->uri->segment(2)=='accounts' ||$this->uri->segment(2)=='Accounts' ){   ?>
            <li><a href="<?php echo site_url('admin/accounts/bill')?>"><i class="fa fa-circle-o"></i>
                    <span><?php echo lang('bill');?></span></a></li>
           <!-- <li class="<?php echo ($this->uri->segment(2)=='Owner')?'active':''?>"><a
                    href="<?php echo site_url('admin/accounts/rentallist')?>"><i class="fa fa-circle-o"></i>
                    <span><?php echo lang('rental_collection');?></span></a></li>-->
					 <li class="<?php echo ($this->uri->segment(3)=='payment')?'active':''?>"><a
                    href="<?php echo site_url('admin/accounts/payment')?>"><i class="fa fa-circle-o"></i>
                    <span><?php echo lang('Payment');?></span></a></li>
					 <li>
                <a href="#">
                    <i class="fa fa-circle-o"></i>
                    <span><?php echo lang('settlement')?></span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php echo ($this->uri->segment(2)=='income_categories')?'active':''?>"><a
                            href="<?php echo site_url('/admin/accounts/rentallist')?>"><i
                                class="fa fa-circle-o"></i><span><?php echo lang('rental_generate');?></span></a>
                    </li>
					<li class="<?php echo ($this->uri->segment(3)=='rental_paymentlist')?'active':''?>"><a
                            href="<?php echo site_url('admin/accounts/rental_paymentlist')?>"><i
                                class="fa fa-circle-o"></i><span><?php echo lang('rental_collection');?></span></a>
                    </li>
					 <li class="<?php echo ($this->uri->segment(3)=='lease_collection')?'active':''?>"><a
                            href="<?php echo site_url('admin/accounts/lease_collection')?>"><i
                                class="fa fa-circle-o"></i><span><?php echo lang('lease_collection');?></span></a>
                    </li>
					 <li class="<?php echo ($this->uri->segment(3)=='resale_commission')?'active':''?>"><a
                            href="<?php echo site_url('admin/accounts/resale_commission')?>"><i
                                class="fa fa-circle-o"></i><span><?php echo lang('resales_Commission');?></span></a>
                    </li>
					<li class="<?php echo ($this->uri->segment(2)=='lease_commission')?'active':''?>"><a
                            href="<?php echo site_url('admin/accounts/lease_commission')?>"><i
                                class="fa fa-circle-o"></i><span><?php echo lang('lease_Commission');?></span></a>
                    </li>
                </ul>
				</li>
					    <li>
                <a href="#">
                    <i class="fa fa-circle-o"></i>
                    <span><?php echo lang('accounts')?></span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php echo ($this->uri->segment(2)=='expense_categories')?'active':''?>"><a
                            href="<?php echo site_url('admin/accounts/expense_categories')?>"><i class="fa fa-circle-o"></i>
                            <span><?php echo lang('expense_categories');?></span></a></li>
                    <li class="<?php echo ($this->uri->segment(2)=='income_categories')?'active':''?>"><a
                            href="<?php echo site_url('admin/accounts/income_categories')?>"><i
                                class="fa fa-circle-o"></i><span><?php echo lang('income_categories');?></span></a>
                    </li>
					 <li class="<?php echo ($this->uri->segment(2)=='ManageCommittee')?'active':''?>"><a
                            href="<?php echo site_url('admin/accounts/transactionlist')?>"><i
                                class="fa fa-circle-o"></i><span><?php echo lang('transaction_list');?></span></a>
                    </li>
					 <li class="<?php echo ($this->uri->segment(2)=='addTransaction')?'active':''?>"><a
                            href="<?php echo site_url('admin/accounts/addTransaction')?>"><i
                                class="fa fa-circle-o"></i><span><?php echo lang('add_transaction');?></span></a>
                    </li>
					<li class="<?php echo ($this->uri->segment(2)=='chartOfAccount')?'active':''?>"><a
                            href="<?php echo site_url('admin/accounts/chartOfAccount')?>"><i
                                class="fa fa-circle-o"></i><span><?php echo lang('Chart_of_accounts');?></span></a>
                    </li>
                </ul>
				</li>
				 
            <?php   }  ?>
			
			
			
			
            <?php  if($this->uri->segment(2)=='payroll'  || $this->uri->segment(2)=='payroll' ){  ?>
            <li class="<?php echo ($this->uri->segment(3)=='home')?'active':''?>"><a
                    href="<?php echo site_url('admin/payroll/home')?>"><i class="fa fa-circle-o"></i>
                    <span><?php echo lang('dashboard');?></span></a></li>
                <li>
                <a href="#">
                    <i class="fa fa-trello"></i>
                    <span><?php echo lang('employee')?></span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php echo ($this->uri->segment(4)=='addEmployee')?'active':''?>"><a
                            href="<?php echo site_url('admin/payroll/employee/addEmployee')?>"><i
                                class="fa fa-circle-o"></i> <span><?php echo lang('add_employee');?></span></a></li>
                    <li class="<?php echo ($this->uri->segment(4)=='employeeList')?'active':''?>"><a
                            href="<?php echo site_url('admin/payroll/employee/employeeList')?>"><i
                                class="fa fa-circle-o"></i> <span><?php echo lang('employee_list');?></span></a></li>
                    <li class="<?php echo ($this->uri->segment(4)=='terminatedEmployeeList')?'active':''?>"><a
                            href="<?php echo site_url('admin/payroll/employee/terminatedEmployeeList')?>"><i
                                class="fa fa-circle-o"></i> <span><?php echo lang('terminated_employee');?></span></a>
                    </li>
                    <li class="<?php echo ($this->uri->segment(4)=='awardList')?'active':''?>"><a
                            href="<?php echo site_url('admin/payroll/employee/awardList')?>"><i
                                class="fa fa-circle-o"></i> <span><?php echo lang('employee_award');?></span></a></li>
                    <li class="<?php echo ($this->uri->segment(4)=='DeductionList')?'active':''?>"><a
                            href="<?php echo site_url('admin/payroll/employee/DeductionList')?>"><i
                                class="fa fa-circle-o"></i> <span><?php echo lang('Employee_deduction');?></span></a>
                    </li>
                    <li class="<?php echo ($this->uri->segment(4)=='AdvanceList')?'active':''?>"><a
                            href="<?php echo site_url('admin/payroll/employee/AdvanceList')?>"><i
                                class="fa fa-circle-o"></i> <span><?php echo lang('Advancepayment');?></span></a></li>
                    <li class="<?php echo ($this->uri->segment(4)=='setAttendance')?'active':''?>"><a
                            href="<?php echo site_url('admin/payroll/employee/setAttendance')?>"><i
                                class="fa fa-circle-o"></i> <span><?php echo lang('set_attendance');?></span></a></li>
                    <li class="<?php echo ($this->uri->segment(4)=='importAttendance')?'active':''?>"><a
                            href="<?php echo site_url('admin/payroll/employee/importAttendance')?>"><i
                                class="fa fa-circle-o"></i> <span><?php echo lang('import_attendance');?></span></a>
                    </li>
                    <li class="<?php echo ($this->uri->segment(4)=='applicationList')?'active':''?>"><a
                            href="<?php echo site_url('admin/payroll/employee/applicationList')?>"><i
                                class="fa fa-circle-o"></i> <span><?php echo lang('application_list');?></span></a></li>

                </ul>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-trello"></i>
                    <span><?php echo lang('payroll')?></span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php echo ($this->uri->segment(4)=='Consolidate')?'active':''?>"><a
                            href="<?php echo site_url('admin/payroll/payroll/Consolidate')?>"><i
                                class="fa fa-circle-o"></i> <span><?php echo lang('Consolidate_payroll');?></span></a>
                    </li>
                    <li class="<?php echo ($this->uri->segment(4)=='listSalaryPayment')?'active':''?>"><a
                            href="<?php echo site_url('admin/payroll/payroll/listSalaryPayment')?>"><i
                                class="fa fa-circle-o"></i> <span><?php echo lang('list_payment');?></span></a></li>
                </ul>
            </li>

            <li>
                <a href="#">
                    <i class="fa fa-trello"></i>
                    <span><?php echo lang('office_settings')?></span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php echo ($this->uri->segment(4)=='Consolidate')?'active':''?>"><a
                            href="<?php echo site_url('admin/payroll/office/department')?>"><i
                                class="fa fa-circle-o"></i> <span><?php echo lang('department');?></span></a></li>
                    <li class="<?php echo ($this->uri->segment(4)=='jobTitle')?'active':''?>"><a
                            href="<?php echo site_url('admin/payroll/office/jobTitle')?>"><i class="fa fa-circle-o"></i>
                            <span><?php echo lang('job_titles');?></span></a></li>
                    <li class="<?php echo ($this->uri->segment(4)=='workingDays')?'active':''?>"><a
                            href="<?php echo site_url('admin/payroll/office/workingDays')?>"><i
                                class="fa fa-circle-o"></i> <span><?php echo lang('working_days');?></span></a></li>
                    <li class="<?php echo ($this->uri->segment(4)=='holidayList')?'active':''?>"><a
                            href="<?php echo site_url('admin/payroll/office/holidayList')?>"><i
                                class="fa fa-circle-o"></i> <span><?php echo lang('holiday_list');?></span></a></li>
                    <li class="<?php echo ($this->uri->segment(4)=='salaryComponent')?'active':''?>"><a
                            href="<?php echo site_url('admin/payroll/office/salaryComponent')?>"><i
                                class="fa fa-circle-o"></i> <span><?php echo lang('salary_component');?></span></a></li>
                    <li class="<?php echo ($this->uri->segment(4)=='workShift')?'active':''?>"><a
                            href="<?php echo site_url('admin/payroll/office/workShift')?>"><i
                                class="fa fa-circle-o"></i> <span><?php echo lang('work_shifts');?></span></a></li>
                    <li class="<?php echo ($this->uri->segment(4)=='leaveType')?'active':''?>"><a
                            href="<?php echo site_url('admin/payroll/office/leaveType')?>"><i
                                class="fa fa-circle-o"></i> <span><?php echo lang('leave_type');?></span></a></li>
                    <li class="<?php echo ($this->uri->segment(4)=='Shift_roster')?'active':''?>"><a
                            href="<?php echo site_url('admin/payroll/office/Shift_roster')?>"><i
                                class="fa fa-circle-o"></i> <span><?php echo lang('add_Shift_roster');?></span></a></li>
                    <li class="<?php echo ($this->uri->segment(4)=='shift_Planner')?'active':''?>"><a
                            href="<?php echo site_url('admin/payroll/office/shift_Planner')?>"><i
                                class="fa fa-circle-o"></i> <span><?php echo lang('Shift_calender');?></span></a></li>
                    <li class="<?php echo ($this->uri->segment(4)=='Currency')?'active':''?>"><a
                            href="<?php echo site_url('admin/payroll/office/Currency')?>"><i class="fa fa-circle-o"></i>
                            <span><?php echo lang('Currency_master');?></span></a></li>
                    <li class="<?php echo ($this->uri->segment(4)=='Employee_tax_master')?'active':''?>"><a
                            href="<?php echo site_url('admin/payroll/office/Employee_tax_master')?>"><i
                                class="fa fa-circle-o"></i> <span><?php echo lang('Taxs');?></span></a></li>

                </ul>
            </li>
            <?php    }    ?>
   <?php  if($this->uri->segment(2)=='Settings'||$this->uri->segment(2)=='settings' || $this->uri->segment(2)=='languages' || $this->uri->segment(2)=='currency' ||$this->uri->segment(2)=='locations'||$this->uri->segment(2)=='taxes'||$this->uri->segment(2)=='testimonials' ){  ?>
            <li
                class="treeview <?php echo($this->uri->segment(2)=='Settings'||$this->uri->segment(2)=='settings' || $this->uri->segment(2)=='languages' || $this->uri->segment(2)=='currency' ||$this->uri->segment(2)=='locations'||$this->uri->segment(2)=='taxes'||$this->uri->segment(2)=='testimonials')?'active':'';?>">
                <a href="#">
                    <i class="fa fa-cogs"></i>
                    <span><?php echo lang('administrative')?></span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php echo ($this->uri->segment(2)=='settings')?'active':''?>"><a
                            href="<?php echo site_url('admin/settings')?>"><i class="fa fa-circle-o"></i>
                            <span><?php echo lang('settings');?></span></a></li>
                    <li class="<?php echo ($this->uri->segment(2)=='languages')?'active':''?>"><a
                            href="<?php echo site_url('admin/languages')?>"><i
                                class="fa fa-circle-o"></i><span><?php echo lang('languages');?></span></a></li>
                    <li class="<?php echo ($this->uri->segment(2)=='currency')?'active':''?>"><a
                            href="<?php echo site_url('admin/currency')?>"><i class="fa fa-circle-o"></i>
                            <span><?php echo lang('currency');?></span></a></li>
                    <li class="<?php echo ($this->uri->segment(2)=='locations')?'active':''?>"><a
                            href="<?php echo site_url('admin/locations')?>"><i class="fa fa-circle-o"></i>
                            <span><?php echo lang('locations');?></span></a></li>
							  <li class="<?php echo ($this->uri->segment(4)=='permissions')?'active':''?>"><a
                            href="<?php echo site_url('admin/settings/permissionlist')?>"><i class="fa fa-circle-o"></i>
                            <span><?php echo lang('permission');?></span></a></li>
                    <li class="<?php echo ($this->uri->segment(2)=='testimonials')?'active':''?>"><a
                            href="<?php echo site_url('admin/testimonials')?>"><i class="fa fa-circle-o"></i>
                            <span><?php echo lang('testimonials');?></span></a></li>
                    <li class="<?php echo ($this->uri->segment(3)=='ProjectType')?'active':''?>"><a
                            href="<?php echo site_url('admin/Settings/ProjectType')?>"><i class="fa fa-circle-o"></i>
                            <span><?php echo lang('ProjectType');?></span></a></li>
                    <li class="<?php echo ($this->uri->segment(3)=='soc')?'active':''?>"><a
                            href="<?php echo site_url('admin/settings/soc')?>"><i class="fa fa-circle-o"></i>
                            <span><?php echo lang('Soc');?></span></a></li>
                    <li class="<?php echo ($this->uri->segment(3)=='soe')?'active':''?>"><a
                            href="<?php echo site_url('admin/settings/soe')?>"><i class="fa fa-circle-o"></i>
                            <span><?php echo lang('source_of_enquiry');?></span></a></li>
                    <li class="<?php echo ($this->uri->segment(3)=='Approved')?'active':''?>"><a
                            href="<?php echo site_url('admin/settings/Approved')?>"><i class="fa fa-circle-o"></i>
                            <span><?php echo lang('Approved_stage');?></span></a></li>
                    <li class="<?php echo ($this->uri->segment(3)=='UOM')?'active':''?>"><a
                            href="<?php echo site_url('admin/settings/UOM')?>"><i class="fa fa-circle-o"></i>
                            <span><?php echo lang('UOM');?></span></a></li>
                    <li class="<?php echo ($this->uri->segment(3)=='Amenities')?'active':''?>"><a
                            href="<?php echo site_url('admin/settings/Amenities')?>"><i class="fa fa-circle-o"></i>
                            <span><?php echo lang('Amenties');?></span></a></li>
                    <li class="<?php echo ($this->uri->segment(3)=='workingDays')?'active':''?>"><a
                            href="<?php echo site_url('admin/settings/workingDays')?>"><i class="fa fa-circle-o"></i>
                            <span><?php echo lang('Working_days');?></span></a></li>
                    <li class="<?php echo ($this->uri->segment(3)=='Material')?'active':''?>"><a
                            href="<?php echo site_url('admin/settings/Material')?>"><i class="fa fa-circle-o"></i>
                            <span><?php echo lang('Material');?></span></a></li>
                    <li class="<?php echo ($this->uri->segment(3)=='Labour')?'active':''?>"><a
                            href="<?php echo site_url('admin/settings/Labour')?>"><i class="fa fa-circle-o"></i>
                            <span><?php echo lang('Labour');?></span></a></li>
                    <li class="<?php echo ($this->uri->segment(3)=='requestType')?'active':''?>"><a
                            href="<?php echo site_url('admin/settings/requestType')?>"><i class="fa fa-circle-o"></i>
                            <span><?php echo lang('requesttype');?></span></a></li>
                    <li class="<?php echo ($this->uri->segment(3)=='request_category')?'active':''?>"><a
                            href="<?php echo site_url('admin/settings/request_category')?>"><i
                                class="fa fa-circle-o"></i> <span><?php echo lang('requestType_category');?></span></a>
                    </li>
                    <li class="<?php echo ($this->uri->segment(3)=='request_subcategory')?'active':''?>"><a
                            href="<?php echo site_url('admin/settings/request_subcategory')?>"><i
                                class="fa fa-circle-o"></i>
                            <span><?php echo lang('requestType_subcategory');?></span></a></li>
                    <li class="<?php echo ($this->uri->segment(3)=='unit_status')?'active':''?>"><a
                            href="<?php echo site_url('admin/settings/unit_status')?>"><i class="fa fa-circle-o"></i>
                            <span><?php echo lang('unit_status');?></span></a></li>
                    <li class="<?php echo ($this->uri->segment(3)=='settings')?'active':''?>"><a
                            href="<?php echo site_url('admin/settings/unitIntension')?>"><i class="fa fa-circle-o"></i>
                            <span><?php echo lang('unit_intension');?></span></a></li>
                    <li class="<?php echo ($this->uri->segment(3)=='settings')?'active':''?>"><a
                            href="<?php echo site_url('admin/settings/unitGroupType')?>"><i class="fa fa-circle-o"></i>
                            <span><?php echo lang('unit_group_type');?></span></a></li>
                    <li class="<?php echo ($this->uri->segment(3)=='settings')?'active':''?>"><a
                            href="<?php echo site_url('admin/settings/unitType')?>"><i class="fa fa-circle-o"></i>
                            <span><?php echo lang('unit_type');?></span></a></li>
							  
                </ul>
				</li>
   <?php    }  ?>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
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
    <div class="container">
        <?php if (!empty($error)): ?>
        <div class="alert alert-danger alert-dismissable col-md-11">
            <i class="fa fa-ban"></i>
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?php echo $error; ?>
        </div>
        <?php endif; ?>

        <?php if (!empty($message)): ?>
        <div class="alert alert-info alert-dismissable col-md-11">
            <i class="fa fa-info"></i>
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?php echo $message; ?>
        </div>
        <?php endif; ?>

    </div>
    <?php }?>