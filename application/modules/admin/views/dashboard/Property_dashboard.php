<style>
         .dashboard_labels ul li{margin-bottom: 10px;}
         .info-box_content{border-radius: 10px;}
         .dashboard_labels_top li{display: inline-block;padding: 0px 10px;}
         .dashboard_labels_top li a{background-color: #1e282c;padding: 6px 20px; color: #fff;border-radius: 4px;}
         .dashboard_labels_top_sec h2{margin: 0px;}
        .hide_se {
            display: none;
        }
		.info-box-text {
				height: 75px;
				line-height: 75px;
}
#pages {
    min-height: 250px;
    background-color: #fff;
    padding: 30px;
    margin-top: 20px;
}
</style>
 
 <section class="content">
    <div class="row">
                <div class="col-sm-6 col-xs-12 dashboard_labels_top_sec">
                         <h2><?php echo  $page_title; ?></h2>
                 </div>
             </div>
     <div class="row" style="margin: 30px 0px;">
     <div id="dashboard-main">
             <div class="col-sm-4 col-xs-12 dashboard_labels">
             <h3 class="text-center">Owners Units</h3>
                     <ul class="list-unstyled">
                             <li >
                                        <a data-page="information" href="<?php echo site_url('admin/Owner'); ?>">
                                                <div class="info-box_content bg-green">
                                                        <div class="info-box-content_sec">
                                                                <span class="info-box-text text-center"><?php echo lang('Total_owner'); ?>: <?php  if(isset($totalowner->OWNER)){ echo $totalowner->OWNER ; } ?></span>
                                                        </div>
                                                </div>
                                        </a>
                             </li>
                             <li><a href="<?php echo site_url('admin/PropertyDashboard/table/11/1/'.lang('Under_constructoin')); ?>">
                                     <div class="info-box_content bg-blue">
                                                        <div class="info-box-content_sec">
                                                                <span class="info-box-text text-center"><?php echo lang('Under_constructoin'); ?>:
<?php  if(isset($Undetconstruction)){ echo $Undetconstruction ; } ?></span>
                                                        </div>
                                                </div>
                             </a></li>
                             <li><a href="<?php echo site_url('admin/PropertyDashboard/table/11/4/'.lang('Completed')); ?>">
                                     <div class="info-box_content bg-yellow">
                                                        <div class="info-box-content_sec">
               <span class="info-box-text text-center"><?php echo lang('Completed'); ?>: <?php  if(isset($Complete)){ echo $Complete ; } ?></span>
                                                        </div>
                                                </div>
                             </a></li>
                             <li><a href="<?php echo site_url('admin/PropertyDashboard/table/11/5/'.lang('Delivered')); ?>">
                                     <div class="info-box_content bg-red">
                                                        <div class="info-box-content_sec">
                                                                <span class="info-box-text text-center"><?php echo lang('Delivered'); ?>: <?php  if(isset($OwnerDelivered)){ echo $OwnerDelivered ; } ?></span>
                                                        </div>
                                                </div>
                             </a></li>
                             <li><a href="<?php echo site_url('admin/PropertyDashboard/table/11/6/'.lang('Pm_paid')); ?>">
                                     <div class="info-box_content bg-aqua">
                                                        <div class="info-box-content_sec">
                                                                <span class="info-box-text text-center"><?php echo lang('Pm_paid'); ?>: <?php  if(isset($Ownerpaid)){ echo $Ownerpaid ; } ?></span>
                                                        </div>
                                                </div>
                             </a></li>
                             <li><a href="<?php echo site_url('admin/PropertyDashboard/table/11/7/'.lang('Pm_unpaid')); ?>">
                                     <div class="info-box_content bg-aqua">
                                                        <div class="info-box-content_sec" style="background-color:#ff0000;">
                                                                <span class="info-box-text text-center"><?php echo lang('Pm_unpaid'); ?>: <?php  if(isset($Ownerunpaid)){ echo $Ownerunpaid ; } ?></span>
                                                        </div>
                                                </div>
                             </a></li>
                     </ul>
             </div>
             <div class="col-sm-4 col-xs-12 dashboard_labels" id="showme">
                     <h3 class="text-center">Hotel Units</h3>
                     <ul class="list-unstyled">
                             <li>
                                        <a  data-page="information1" href="<?php echo site_url('admin/PropertyDashboard/table/11/4/'.lang('Total_units')); ?>">
                                                <div class="info-box_content bg-green">
                                                        <div class="info-box-content_sec" >
        <span class="info-box-text text-center"><?php echo lang('Total_units'); ?>: <?php  if(isset($hotellauc)){ echo ($hotellauc + $hotelcom+$hotelinbusi + $hotel_avail+ $hotel_hired) ; } ?></span>
                                                        </div>
                                                </div>
                                        </a>
                             </li>
                             <li><a href="<?php echo site_url('admin/PropertyDashboard/table/12/1/'.lang('Under_constructoin')); ?>">
                                     <div class="info-box_content bg-blue">
                                                        <div class="info-box-content_sec">
                                                                <span class="info-box-text text-center"><?php echo lang('Under_constructoin'); ?>:
<?php  if(isset($hotellauc)){ echo $hotellauc ; } ?></span>
                                                        </div>
                                                </div>
                             </a></li>
                             <li><a href="<?php echo site_url('admin/PropertyDashboard/table/12/4/'.lang('Completed')); ?>">
                                     <div class="info-box_content bg-yellow">
                                                        <div class="info-box-content_sec">
                                                                <span class="info-box-text text-center"><?php echo lang('Completed'); ?>: <?php  if(isset($hotelcom)){ echo $hotelcom ; } ?></span>
                                                        </div>
                                                </div>
                             </a></li>
                             <li><a href="<?php echo site_url('admin/PropertyDashboard/table/12/8/'.lang('In_Business')); ?>">
                                     <div class="info-box_content bg-red">
                                                        <div class="info-box-content_sec">
                                                                <span class="info-box-text text-center"><?php echo lang('In_Business'); ?>: <?php  if(isset($hotelinbusi)){ echo $hotelinbusi ; } ?></span>
                                                        </div>
                                                </div>
                             </a></li>
                             <li><a href="<?php echo site_url('admin/PropertyDashboard/table/12/9/'.lang('Available_Units')); ?>">
                                     <div class="info-box_content bg-aqua">
                                                        <div class="info-box-content_sec">
                                                                <span class="info-box-text text-center"><?php echo lang('Available_Units'); ?>: <?php  if(isset($hotel_avail)){ echo $hotel_avail ; } ?></span>
                                                        </div>
                                                </div>
                             </a></li>
                             <li ><a href="<?php echo site_url('admin/PropertyDashboard/table/12/10/'.lang('Hired_units')); ?>" >
                                     <div class="info-box_content bg-aqua" >
                                                        <div class="info-box-content_sec" style="background-color:#ff0000;">
                                                                <span class="info-box-text text-center"><?php echo lang('Hired_units'); ?>: <?php  if(isset($hotel_hired)){ echo $hotel_hired ; } ?></span>
                                                        </div>
                                                </div>
                             </a></li>
                     </ul>
             </div>
             <div class="col-sm-4 col-xs-12 dashboard_labels">
                     <h3 class="text-center">Lease Back</h3>
                     <ul class="list-unstyled">
                             <li>
                                        <a href="<?php echo site_url('admin/PropertyDashboard/table/11/4/'.lang('Total_units')); ?>">
                                                <div class="info-box_content bg-green">
                                                        <div class="info-box-content_sec">
   <span class="info-box-text text-center"><?php echo lang('Total_units'); ?>: <?php  if(isset($leaseuc)){ echo ($leaseuc + $leasecom + $leaseinbusi + $lease_avai + $leasehired ); } ?></span>
                                                        </div>
                                                </div>
                                        </a>
                             </li>
                             <li><a href="<?php echo site_url('admin/PropertyDashboard/table/13/1/'.lang('Under_constructoin')); ?>">
                                     <div class="info-box_content bg-blue">
                                                        <div class="info-box-content_sec">
                                                                <span class="info-box-text text-center"><?php echo lang('Under_constructoin'); ?>:
<?php  if(isset($leaseuc)){ echo $leaseuc ; } ?></span>
                                                        </div>
                                                </div>
                             </a></li>
							
							
                             <li><a href="<?php echo site_url('admin/PropertyDashboard/table/13/4/'.lang('Completed')); ?>">
                                     <div class="info-box_content bg-yellow">
                                                        <div class="info-box-content_sec">
                                                                <span class="info-box-text text-center"><?php echo lang('Completed'); ?>: <?php  if(isset($leasecom)){ echo $leasecom ; } ?></span>
                                                        </div>
                                                </div>
                             </a></li>
                             <li><a href="<?php echo site_url('admin/PropertyDashboard/table/13/8/'.lang('In_Business')); ?>">
                                     <div class="info-box_content bg-red">
                                                        <div class="info-box-content_sec">
                                                                <span class="info-box-text text-center"><?php echo lang('In_Business'); ?>: <?php  if(isset($leaseinbusi)){ echo $leaseinbusi ; } ?></span>
                                                        </div>
                                                </div>
                             </a></li>
                             <li><a href="<?php echo site_url('admin/PropertyDashboard/table/13/9/'.lang('Available_Units')); ?>">
                                     <div class="info-box_content bg-aqua">
                                                        <div class="info-box-content_sec">
                                                                <span class="info-box-text text-center"><?php echo lang('Available_Units'); ?>: <?php  if(isset($lease_avai)){ echo $lease_avai ; } ?></span>
                                                        </div>
                                                </div>
                             </a></li>
                             <li><a href="<?php echo site_url('admin/PropertyDashboard/table/13/10/'.lang('Hired_units')); ?>">
                                     <div class="info-box_content bg-aqua">
                                                        <div class="info-box-content_sec" style="background-color:#ff0000;">
                                                                <span class="info-box-text text-center"><?php echo lang('Hired_units'); ?>: <?php  if(isset($leasehired)){ echo $leasehired ; } ?></span>
                                                        </div>
                                                </div>
                             </a></li>
                     </ul>
             </div>
     
    </div>

  </div></section>