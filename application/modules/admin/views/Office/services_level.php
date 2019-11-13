<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/booking.css">
  <!-- Main content -->
  <style>
	 .content-wrapper, .right-side {
    height: 100%;
    background-color: #ecf0f5;
    z-index: 800;
    min-height: 800px !important;
}
	  .floor_box_content .floor_box{padding-bottom: 25px;}
	   .service_sec_ma .service_sec_lt{position: absolute;left: 52%;top: 27%; background-color: red;width: 40px;height:40px;border-radius: 50px;z-index: 11;content: '';line-height: 40px;color: #fff;text-align: center;font-size: 16px;font-weight: 500;}
	  .floor_box_content .pink_floor_box .head_number_box, .floor_box_content .yellow_floor_box, .floor_box_content .blue_floor_box .head_number_box{padding: 15px 0px 20px;}
</style>
 <section class="content">
      <!-- Info boxes -->
      <div  class="col-sm-12 col-xs-12">
      	<div class="row">
         <div class="col-sm-12 col-xs-12" id="exTab1">	
			<ul  class="nav nav-pills">
				<li class="active">
					<a  href="#1a" data-toggle="tab">Owner Units</a>
				</li>
				<li>
					<a href="#2a" data-toggle="tab">Hotel Units</a>
				</li>
				<li>
					<a href="#3a" data-toggle="tab">Lease Back Units</a>
				</li>
				
			</ul>

			<div class="tab-content clearfix">
			  	<div class="tab-pane active" id="1a">
					<div class="row">
						<div class="col-sm-12 col-xs-12 dashboard_sec">
							<div class="row">
							<div class="col-sm-12 col-xs-12 floor_box_content">
									<?php  if(isset($Ownerunits)) {  foreach($Ownerunits as $Ownerunit){
							?>
								<div class="col-sm-3 col-xs-6">
							<a href="<?php echo site_url('admin/Office/complaintlist/11/'.$Ownerunit->uid) ?>" tabindex="-1">
									<!--   pink_floor_box  -->
									<div class="floor_box green_floor_box">
										<div class="row head_number_box">
										<div class="col-xs-4"><span class="number_box">>></span></div>
										<div class="col-xs-8"><span class="floor_num"><?php echo    $Ownerunit->unit_no;   ?></span></div></div>
										<div class="service_sec_ma">
											<img src="<?php echo base_url('assets/admin')?>/dist/img/service_icon.png" width="80px" height="80px" class="center-block" alt="service_icon">
										
											<?php $result=$this->db->query("  SELECT COUNT(complain_id) AS complaint FROM add_complain ac 
												LEFT JOIN add_unit au ON  au.uid=ac.Unit_id
												LEFT JOIN floors f   ON au.`floor_no`=f.`id`
												WHERE Unit_groupType=11 AND au.uid='".$Ownerunit->uid."' AND Complaint_status !='".lang('Completed')."' ")->row(); 
												if( $result->complaint!=0){ echo '<span class="service_sec_lt">'. $result->complaint.'  </span>'; };
											?>
										
										</div>                                           </div>
									</a>
								</div>
								<?php  
							}  }
								?>
							</div>
						</div>
						</div>
					</div>
     			</div>
				
				<div class="tab-pane" id="2a">
          			<div class="row">
						<div class="col-sm-12 col-xs-12 dashboard_sec">
							<div class="row">
							<div class="col-sm-12 col-xs-12 floor_box_content">
									<?php  if(isset($Hotelunits)) {  foreach($Hotelunits as $Hotelunit){
							?>
								<div class="col-sm-3 col-xs-6">
									<a href="<?php echo site_url('admin/Office/complaintlist/12/'.$Hotelunit->uid) ?>" tabindex="-1">
									<!--   pink_floor_box  -->
									<div class="floor_box green_floor_box">
										<div class="row head_number_box">
										<div class="col-xs-4"><span class="number_box">>></span></div>
										<div class="col-xs-8"><span class="floor_num"><?php echo    $Hotelunit->unit_no;   ?></span></div></div>
										<div class="service_sec_ma">
											<img src="<?php echo base_url('assets/admin')?>/dist/img/service_icon.png" width="80px" height="80px" class="center-block" alt="service_icon">
										<?php $result=$this->db->query("  SELECT COUNT(complain_id) AS complaint FROM add_complain ac 
												LEFT JOIN add_unit au ON  au.uid=ac.Unit_id
												LEFT JOIN floors f   ON au.`floor_no`=f.`id`
												WHERE Unit_groupType=12 AND au.uid='".$Hotelunit->uid."' AND Complaint_status !='".lang('Completed')."' ")->row(); 
												if( $result->complaint!=0){ echo '<span class="service_sec_lt">'. $result->complaint.'  </span>'; };
											?>
										
										</div>                                           </div>
									</a>
								</div>
								<?php  
							}  }
								?>
							</div>
						</div>
					</div>
     			</div>
				</div>
        		<div class="tab-pane" id="3a">
          			<div class="row">
						<div class="col-sm-12 col-xs-12 dashboard_sec">
							<div class="row">
							<div class="col-sm-12 col-xs-12 floor_box_content">
							
			     		<?php  if(isset($Leaseunits)) {  foreach($Leaseunits as $Leaseunit){
							?>
								<div class="col-sm-3 col-xs-6">
									<a href="<?php echo site_url('admin/Office/complaintlist/13/'.$Leaseunit->uid) ?>" tabindex="-1">
									<div class="floor_box green_floor_box">
										<div class="row head_number_box">
										<div class="col-xs-4"><span class="number_box">>></span></div>
										<div class="col-xs-8"><span class="floor_num"><?php echo    $Leaseunit->unit_no;   ?></span></div></div>
										<div class="service_sec_ma">
											<img src="<?php echo base_url('assets/admin')?>/dist/img/service_icon.png" width="80px" height="80px" class="center-block" alt="service_icon">
											<?php $result=$this->db->query("  SELECT COUNT(complain_id) AS complaint FROM add_complain ac 
												LEFT JOIN add_unit au ON  au.uid=ac.Unit_id
												LEFT JOIN floors f   ON au.`floor_no`=f.`id`
												WHERE Unit_groupType=13 AND au.uid='".$Leaseunit->uid."' AND Complaint_status !='".lang('Completed')."' ")->row(); 
												if( $result->complaint!=0){ echo '<span class="service_sec_lt">'. $result->complaint.'  </span>'; };
											?>
										</div>                                           </div>
									</a>
								</div>
								<?php  
							}  }
								?>
							</div>
						</div>
					</div>
     			</div>
				</div>
				
			</div>
		</div>
  	</div>
      </div>
</section>