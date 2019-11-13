
<script type="text/javascript" src="<?php echo base_url('assets/admin/bootstrap/js/rTabs.js')?>"></script>
 <style>
 .tab {
  position: relative;
  height: 720px;
  overflow: hidden;
  margin: 0 auto 20px auto;
}
.tab-nav {
  height: 30px;
  overflow: hidden;
  padding: 0px 0px 30px 25px;
}
.tab-nav a {
  display: block;
  float: left;
  height: 30px;
  line-height: 30px;
  text-align: center;
  text-decoration: none;
  color: #333;
  background-color:#ccc;
  margin-left:5px;
}
.tab-nav a.current {
  background: #2C3542;
  color: #fff;
}
.tab-con {
  position: relative;
  overflow: hidden;
}
.tab-con-item {
  display: none;
  height: 780px;
  text-align: center;
  color: black;
}
  .controller{
                width: 400px;
                margin: 0 auto 10px auto;
     }
	 
.tabs-left{border: none;}
.tab-content h3{margin-top: 0px;}
.tabs-left>li {
 float: none;
 margin:8px 0px;
}
 .tabs-left li a{padding: 20px;color: #fff;}
.tabs-left>li.active>a,
.tabs-left>li.active>a:hover,
.tabs-left>li.active>a:focus {
  border-bottom-color: #ddd;
  border-right-color: transparent;
  background:#f90;
  border:none;
  border-radius:0px;
  margin:0px;
}
.nav-tabs>li>a:hover {
    /* margin-right: 2px; */
    line-height: 1.42857143;
    border: 1px solid transparent;
    /* border-radius: 4px 4px 0 0; */
}
.tabs-left>li.active>a::after
	 {
		content: "";
		position: absolute;
		top: 20px;
		right: -10px;
		border-top: 10px solid transparent;
		border-bottom: 10px solid transparent;
		border-left: 10px solid #2c3542;
		display: block;
		width: 0;
	 }
/*	 ticket*/
.plane {
  margin:0px auto;
  max-width:600px;
}

.cockpit {
  height: 50px;
  position: relative;
  overflow: hidden;
  text-align: center;
}
.cockpit:before {
  content: "";
  display: block;
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  border-radius: 0%;
}
.cockpit h1 {
	width: 100%;
	margin: 10px auto 10px auto;
	font-size: 25px;
	line-height: 50px;
}

.exit {
  position: relative;
  height: 50px;
}
.exit:before, .exit:after {
  content: "EXIT";
  font-size: 14px;
  line-height: 18px;
  padding: 0px 2px;
  font-family: "Arial Narrow", Arial, sans-serif;
  display: block;
  position: absolute;
  background: green;
  color: white;
  top: 50%;
  transform: translate(0, -50%);
}
.exit:before {
  left: 0;
}
.exit:after {
  right: 0;
}

.seats {
  display: block;
  flex-direction: row;
  flex-wrap: nowrap;
  justify-content: flex-start;
}

.seat {
  display: inline-block;
  flex: 0 0 14.28571428571429%;
  padding: 5px;
  position: relative;
  float:left;
}

.seat input[type=checkbox] {
  position: absolute;
  opacity: 0;
}
.seat input[type=checkbox]:checked + label {
  background: green;
  -webkit-animation-name: rubberBand;
  animation-name: rubberBand;
  animation-duration: 300ms;
  animation-fill-mode: both;
	box-shadow: none;
}
.seat input[type=checkbox]:disabled + label {
  background: #dddddd;
  text-indent: -9999px;
  overflow: hidden;
}
.seat input[type=checkbox]:disabled + label:after {
  content: "X";
  text-indent: 0;
  position: absolute;
  top: 4px;
  left: 50%;
  transform: translate(-50%, 0%);
}
.seat input[type=checkbox]:disabled + label:hover {
  box-shadow: none;
  cursor: not-allowed;
}
.seat label {
  display: block;
  position: relative;
  width: 100%;
  text-align: center;
  font-size: 14px;
  font-weight: normal;
  line-height: 1.5rem;
  padding: 6px 15px;
  background: #2C3543;
  border-radius: 5px;
  animation-duration: 300ms;
  animation-fill-mode: both;
	color: #fff;
}
.seat label:before {
  content: "";
  position: absolute;
  width: 75%;
  height: 75%;
  top: 1px;
  left: 50%;
  transform: translate(-50%, 0%);
  background: rgba(255, 255, 255, 0);
  border-radius: 3px;
}
.seat label:hover {
  cursor: pointer;
  box-shadow: 0 0 0px 2px #5C6AFF;
}
.btn_default{background-color: #2C3542 !important;
color: #fff!important;
padding: 3px 30px;
border-radius: 5px;
border-color: #2C3542;}
.btn_default:hover{border-color: #2C3542;background-color: #2C3542 !important;color: #fff;}

@-webkit-keyframes rubberBand {
  0% {
    -webkit-transform: scale3d(1, 1, 1);
    transform: scale3d(1, 1, 1);
  }
  30% {
    -webkit-transform: scale3d(1.25, 0.75, 1);
    transform: scale3d(1.25, 0.75, 1);
  }
  40% {
    -webkit-transform: scale3d(0.75, 1.25, 1);
    transform: scale3d(0.75, 1.25, 1);
  }
  50% {
    -webkit-transform: scale3d(1.15, 0.85, 1);
    transform: scale3d(1.15, 0.85, 1);
  }
  65% {
    -webkit-transform: scale3d(0.95, 1.05, 1);
    transform: scale3d(0.95, 1.05, 1);
  }
  75% {
    -webkit-transform: scale3d(1.05, 0.95, 1);
    transform: scale3d(1.05, 0.95, 1);
  }
  100% {
    -webkit-transform: scale3d(1, 1, 1);
    transform: scale3d(1, 1, 1);
  }
}
@keyframes rubberBand {
  0% {
    -webkit-transform: scale3d(1, 1, 1);
    transform: scale3d(1, 1, 1);
  }
  30% {
    -webkit-transform: scale3d(1.25, 0.75, 1);
    transform: scale3d(1.25, 0.75, 1);
  }
  40% {
    -webkit-transform: scale3d(0.75, 1.25, 1);
    transform: scale3d(0.75, 1.25, 1);
  }
  50% {
    -webkit-transform: scale3d(1.15, 0.85, 1);
    transform: scale3d(1.15, 0.85, 1);
  }
  65% {
    -webkit-transform: scale3d(0.95, 1.05, 1);
    transform: scale3d(0.95, 1.05, 1);
  }
  75% {
    -webkit-transform: scale3d(1.05, 0.95, 1);
    transform: scale3d(1.05, 0.95, 1);
  }
  100% {
    -webkit-transform: scale3d(1, 1, 1);
    transform: scale3d(1, 1, 1);
  }
}
.rubberBand {
  -webkit-animation-name: rubberBand;
  animation-name: rubberBand;
  .seat .btn_default{    display: block;
    position: relative;
    width: 100%;
    text-align: center;
    font-size: 14px;
    font-weight: normal;
    line-height: 1.5rem;
    padding: 4px 0 !important;
    background: #2C3543 !important;
    border-radius: 5px;
    animation-duration: 300ms;
    animation-fill-mode: both;
  color: #fff;}
 
        </style>
        <style>
#exTab1 .tab-content {
  color : white;
  background-color: #428bca;
  padding : 5px 15px;
}

#exTab2 h3 {
  color : white;
  background-color: #428bca;
  padding : 5px 15px;
}

/* remove border radius for the tab */

#exTab1 .nav-pills > li > a {
  border-radius: 0;
}

/* change border radius for the tab , apply corners on top*/

#exTab3 .nav-pills > li > a {
  border-radius: 4px 4px 0 0 ;
}

#exTab3 .tab-content {
  color : white;
  background-color: #428bca;
  padding : 5px 15px;
}
</style>
 <script type="text/javascript">
            $(function() {
                $("#tabauto").rTabs({
                    bind : 'click',
                    defaultShow:true,
                    auto: false
                });

                $("#tab").rTabs();

                $("#tab2").rTabs({
                    bind : 'click',
                    animation : 'left'
                });

                $("#tab3").rTabs({
                    bind : 'hover',
                    animation : 'up'
                });

                $("#tab4").rTabs({
                    bind : 'hover',
                    animation : 'fadein'
                });

                $("#gallery").rTabs({
                    bind : 'hover',
                    animation : 'fadein'
                });
            })
        </script>
 <!-- Main content -->
 <section class="content">
      <!-- Info boxes -->
     
		  <p class="er"></p>
          <div class="row">
          	<div class="dropdown pull-right">
			 </div>
        </div>
         <div class="row">
			 <div id="pages" class="col-sm-12">
          <div class="tab" id="tabauto">
            <div class="tab-nav j-tab-nav">
                <a href="javascript:void(0);" class="col-md-3" show-index="show-tab1"><?php  echo lang('Owner_unit');   ?></a>
                <a href="javascript:void(0);" class="col-md-3"show-index="show-tab2"><?php  echo  lang('Hotel_unit');   ?></a>
                <a href="javascript:void(0);" class="col-md-3"show-index="show-tab3"><?php  echo  lang('Lease_Back');   ?></a>
            </div>
            <div class="tab-con">
                <div class="j-tab-con">
                    <div class="tab-con-item" style="display:block;">
					
					
					
					 <section class="content">
<div class="row">
   	<div  class="col-sm-12">
      
    
        <div class="col-xs-3"> <!-- required for floating -->
          <!-- Nav tabs -->
          <ul class="nav nav-tabs tabs-left sideways">
             <li class="active"><a class="bg-green" href="#completed" data-toggle="tab">Completed:  <?php  if(isset($Complete)){ echo $Complete ; } ?></a></li>
            <li><a class="bg-red" href="#under_const" data-toggle="tab">Under Constructions: <?php  if(isset($Undetconstruction)){ echo $Undetconstruction ; } ?></a></li>
           
            <li><a class="bg-blue" href="#delivered" data-toggle="tab">Delivered: <?php  if(isset($OwnerDelivered)){ echo $OwnerDelivered ; } ?></a></li>
            <li><a class="bg-teal" href="#pm_paid" data-toggle="tab">PM Paid: <?php  if(isset($Ownerpaid)){ echo $Ownerpaid ; } ?></a></li>
            <li><a class="bg-navy"accesskey="" href="#pm_notpaid" data-toggle="tab">PM Not Paid: <?php  if(isset($Ownerunpaid)){ echo $Ownerunpaid ; } ?></a></li>
			<li><a class="bg-aqua" href="#total_owner" data-toggle="tab">Total Owners: <?php  if(isset($totalowner->OWNER)){ echo $totalowner->OWNER ; } ?></a></li>
          </ul>
        </div>

        <div class="col-xs-9">
          <!-- Tab panes -->
          <div class="tab-content">
            <div class="tab-pane " id="total_owner">
            	<h3 class="text-center">Total Owners:  <?php  if(isset($totalowner->OWNER)){ echo $totalowner->OWNER ; } ?></h3>
            </div>
            <div class="tab-pane" id="under_const">
            <h3 class="text-center"></h3>
			<div class="plane">
					
					  <ol class="cabin fuselage list-unstyled">
						<li class="row row--1">
						  <ol class="seats" type="A">
						 <?php 
								if(isset($OwnerUnder_unit)){
									foreach($OwnerUnder_unit as $OwnerUnder_units){
						  ?>
						  
							<li class="seat">
							<a  href="<?php echo site_url('admin/Office/Unit_Details/'.$OwnerUnder_units->uid); ?>">
							  <input type="button" class="btn btn-default btn_default" value="<?php  echo $OwnerUnder_units->unit_no;  ?>"  />
							</a>
							</li>
							
							<?php
									}
								}
							?>
							
						  </ol>
						</li>
					  </ol>
					 
					</div>
            </div>
            <div class="tab-pane active" id="completed">
            	<h3 class="text-center"></h3>
					<div class="plane">
					 
					  <ol class="cabin fuselage list-unstyled">
						<li class="row row--1">
						  <ol class="seats" type="A">
						 <?php 
								if(isset($OwnerComplete_unit)){
									foreach($OwnerComplete_unit as $OwnerComplete_units){
						  ?>
<li class="seat">
							<a  href="<?php echo site_url('admin/Office/Unit_Details/'.$OwnerComplete_units->uid); ?>">
							  <input type="button" class="btn btn-default btn_default" value="<?php  echo $OwnerComplete_units->unit_no;  ?>"  />
							</a>
							</li>
							
							<?php
									}
								}
							?>
						  </ol>
						</li>
					  </ol>
					 
					</div>
            </div>
            <div class="tab-pane" id="delivered">
            	<h3 class="text-center"></h3>
				<div class="plane">
					 
					  <ol class="cabin fuselage list-unstyled">
						<li class="row row--1">
						  <ol class="seats" type="A">
						 <?php 
								if(isset($OwnerDelivered_unit)){
									foreach($OwnerDelivered_unit as $OwnerDelivered_units){
						  ?>
						  <li class="seat">
							<a  href="<?php echo site_url('admin/Office/Unit_Details/'.$OwnerDelivered_units->uid); ?>">
							  <input type="button" class="btn btn-default btn_default" value="<?php  echo $OwnerDelivered_units->unit_no;  ?>"  />
							</a>
							</li>
							
							<?php
									}
								}
							?>
						  </ol>
						</li>
					  </ol>
					</div>
            </div>
            <div class="tab-pane" id="pm_paid">
            	<h3 class="text-center"></h3>
				<div class="plane">
					 
					  <ol class="cabin fuselage list-unstyled">
						<li class="row row--1">
						  <ol class="seats" type="A">
						 <?php 
								if(isset($Ownerpaid_unit)){
									foreach($Ownerpaid_unit as $Ownerpaid_units){
						  ?>
						   <li class="seat">
							<a  href="<?php echo site_url('admin/Office/Unit_Details/'.$Ownerpaid_units->uid); ?>">
							  <input type="button" class="btn btn-default btn_default" value="<?php  echo $Ownerpaid_units->unit_no;  ?>"  />
							</a>
							</li>
							
							<?php
									}
								}
							?>
						  </ol>
						</li>
					  </ol>
					</div>
            </div>
            <div class="tab-pane" id="pm_notpaid">
            	<h3 class="text-center"></h3>
				<div class="plane">
					 
					  <ol class="cabin fuselage list-unstyled">
						<li class="row row--1">
						  <ol class="seats" type="A">
						 <?php 
								if(isset($Ownerunpaid_unit)){
									foreach($Ownerunpaid_unit as $Ownerunpaid_units){
						  ?>
						   <li class="seat">
							<a  href="<?php echo site_url('admin/Office/Unit_Details/'.$Ownerunpaid_units->uid); ?>">
							  <input type="button" class="btn btn-default btn_default" value="<?php  echo $Ownerunpaid_units->unit_no;  ?>"  />
							</a>
							</li>
							<?php
									}
								}
							?>
						  </ol>
						</li>
					  </ol>
					</div>
            </div>
          </div>
        </div>
        <div class="clearfix"></div>
      </div>
   </div></section>

                    </div>
                    <div class="tab-con-item">
					 <section class="content">
<div class="row">
   	<div  class="col-sm-12">
       
        <div class="col-xs-3"> <!-- required for floating -->
          <!-- Nav tabs -->
          <ul class="nav nav-tabs tabs-left sideways">
           
            <li><a class="bg-red" href="#under_const1" data-toggle="tab">Under Constructions: <?php  if(isset($hotellauc)){ echo $hotellauc ; } ?></a></li>
            <li class="active"><a class="bg-green" href="#completed1" data-toggle="tab">Completed: <?php  if(isset($hotelcom)){ echo $hotelcom ; } ?></a></li>
			 <li><a class="bg-navy"accesskey="" href="#pm_notpaid1" data-toggle="tab"><?php echo lang('In_Business'); ?>:  <?php  if(isset($hotelinbusi)){ echo $hotelinbusi ; } ?></a></li>
            <li><a class="bg-blue" href="#delivered1" data-toggle="tab">Available:  <?php  if(isset($hotel_avail)){ echo $hotel_avail ; } ?></a></li>
            <li><a class="bg-teal" href="#pm_paid1" data-toggle="tab">Hired Unit: <?php  if(isset($hotel_hired)){ echo $hotel_hired ; } ?></a></li>
            <li><a class="bg-aqua" href="#total_owner1" data-toggle="tab">Total Units: <?php  if(isset($hotellauc)){ echo ($hotellauc + $hotelcom+$hotelinbusi + $hotel_avail+ $hotel_hired) ; } ?></a></li>
          </ul>
        </div>

        <div class="col-xs-9">
          <!-- Tab panes -->
          <div class="tab-content">
            <div class="tab-pane " id="total_owner1">
            	<h3 class="text-center">Total Units: <?php  if(isset($hotellauc)){ echo ($hotellauc + $hotelcom+$hotelinbusi + $hotel_avail+ $hotel_hired) ; } ?></h3>
            </div>
           
            <div class="tab-pane " id="under_const1">
            	<h3 class="text-center"></h3>
					<div class="plane">
					  
					  <ol class="cabin fuselage list-unstyled">
						<li class="row row--1">
						  <ol class="seats" type="A">
							 <?php 
								if(isset($HotelUnder_unit)){
									foreach($HotelUnder_unit as $HotelUnder_units){
						  ?>
						   <li class="seat">
							<a  href="<?php echo site_url('admin/Office/Unit_Details/'.$HotelUnder_units->uid); ?>">
							  <input type="button" class="btn btn-default btn_default" value="<?php  echo $HotelUnder_units->unit_no;  ?>"  />
							</a>
							</li>
							
							<?php
									}
								}
							?>
							</ol>
						</li>
					  </ol>
					 
					</div>
            </div>
			
            <div class="tab-pane active" id="completed1">
            	<h3 class="text-center"></h3>
				<div class="plane">
					  
					  <ol class="cabin fuselage list-unstyled">
						<li class="row row--1">
						  <ol class="seats" type="A">
							 <?php 
								if(isset($HotelComplete_unit)){
									foreach($HotelComplete_unit as $HotelComplete_units){
						  ?>
						   <li class="seat">
							<a  href="<?php echo site_url('admin/Office/Unit_Details/'.$HotelComplete_units->uid); ?>">
							  <input type="button" class="btn btn-default btn_default" value="<?php  echo $HotelComplete_units->unit_no;  ?>"  />
							</a>
							</li>
							
							<?php
									}
								}
							?>




							</ol>
						</li>
					  </ol>
					 
					</div>
            </div>
            <div class="tab-pane" id="pm_notpaid1">
            	<h3 class="text-center"></h3>
				<div class="plane">
					  
					  <ol class="cabin fuselage list-unstyled">
						<li class="row row--1">
						  <ol class="seats" type="A">
							 <?php 
								if(isset($HotelBusiness_unit)){
									foreach($HotelBusiness_unit as $HotelBusiness_units){
						  ?>
						   <li class="seat">
							<a  href="<?php echo site_url('admin/Office/Unit_Details/'.$HotelBusiness_units->uid); ?>">
							  <input type="button" class="btn btn-default btn_default" value="<?php  echo $HotelBusiness_units->unit_no;  ?>"  />
							</a>
							</li>
							
							<?php
									}
								}
							?>


							</ol>
						</li>
					  </ol>
					 
					</div>
            </div>
            <div class="tab-pane" id="delivered1">
            	<h3 class="text-center"></h3>
				<div class="plane">
					  
					  <ol class="cabin fuselage list-unstyled">
						<li class="row row--1">
						  <ol class="seats" type="A">
							 <?php 
								if(isset($HotelAvail_unit)){
									foreach($HotelAvail_unit as $HotelAvail_units){
						  ?>
						   <li class="seat">
							<a  href="<?php echo site_url('admin/Office/Unit_Details/'.$HotelAvail_units->uid); ?>">
							  <input type="button" class="btn btn-default btn_default" value="<?php  echo $HotelAvail_units->unit_no;  ?>"  />
							</a>
							</li>
							
							<?php
									}
								}
							?>


							</ol>
						</li>
					  </ol>
					 
					</div>
					</div>
					 <div class="tab-pane" id="pm_paid1">
            	<h3 class="text-center"></h3>
				<div class="plane">
					  
					  <ol class="cabin fuselage list-unstyled">
						<li class="row row--1">
						  <ol class="seats" type="A">
							 <?php 
								if(isset($HotelHIred_unit)){
									foreach($HotelHIred_unit as $HotelHIred_units){
						  ?>
						   <li class="seat">
							<a  href="<?php echo site_url('admin/Office/Unit_Details/'.$HotelHIred_units->uid); ?>">
							  <input type="button" class="btn btn-default btn_default" value="<?php  echo $HotelHIred_units->unit_no;  ?>"  />
							</a>
							</li>
							
							<?php
									}
								}
							?>




							</ol>
						</li>
					  </ol>
					 
					</div>
            </div>
          </div>
        </div>

        <div class="clearfix"></div>

      </div>

      
   </div></section>

					
                    </div>
                    <div class="tab-con-item">
					 <section class="content">
<div class="row">
   	<div  class="col-sm-12">
     
        <div class="col-xs-3"> <!-- required for floating -->
          <!-- Nav tabs -->
          <ul class="nav nav-tabs tabs-left sideways">
          <li><a class="bg-aqua" href="#total_owner2" data-toggle="tab">Total Units:  <?php  if(isset($leaseuc)){ echo ($leaseuc + $leasecom + $leaseinbusi + $lease_avai + $leasehired ); } ?></a></li>
            <li><a class="bg-red" href="#under_const2" data-toggle="tab">Under Constructions: <?php  if(isset($leaseuc)){ echo $leaseuc ; } ?></a></li>
            <li class="active"><a class="bg-green" href="#completed2" data-toggle="tab">Completed: <?php  if(isset($leasecom)){ echo $leasecom ; } ?></a></li>
            <li><a class="bg-blue" href="#delivered2" data-toggle="tab"><?php echo lang('In_Business'); ?>:  <?php  if(isset($leaseinbusi)){ echo $leaseinbusi ; } ?></a></li>
            <li><a class="bg-teal" href="#pm_paid2" data-toggle="tab"><?php echo lang('Available_Units'); ?>: <?php  if(isset($lease_avai)){ echo $lease_avai ; } ?></a></li>
            <li><a class="bg-navy"accesskey="" href="#pm_notpaid2" data-toggle="tab"><?php echo lang('Hired_units'); ?>: <?php  if(isset($leasehired)){ echo $leasehired ; } ?></a></li>
          </ul>
        </div>

        <div class="col-xs-9">
          <!-- Tab panes -->
          <div class="tab-content">
            <div class="tab-pane " id="total_owner2">
            	<h3 class="text-center">Total Units: <?php  if(isset($leaseuc)){ echo ($leaseuc + $leasecom + $leaseinbusi + $lease_avai + $leasehired ); } ?></h3>
            </div>
            <div class="tab-pane" id="under_const2">
            <h3 class="text-center"></h3>
			<div class="plane">
					  
					  <ol class="cabin fuselage list-unstyled">
						<li class="row row--1">
						  <ol class="seats" type="A">
							 <?php 
								if(isset($LeaseUnder_unit)){
									foreach($LeaseUnder_unit as $LeaseUnder_units){
						  ?>
						   <li class="seat">
							<a  href="<?php echo site_url('admin/Office/Unit_Details/'.$LeaseUnder_units->uid); ?>">
							  <input type="button" class="btn btn-default btn_default" value="<?php  echo $LeaseUnder_units->unit_no;  ?>"  />
							</a>
							</li>
							
							<?php
									}
								}
							?>

							
						  </ol>
						</li>
					  </ol>
					 
					</div>
            </div>
            <div class="tab-pane active" id="completed2">
            	<h3 class="text-center"></h3>
					<div class="plane">
					  
					  <ol class="cabin fuselage list-unstyled">
						<li class="row row--1">
						  <ol class="seats" type="A">
							 <?php 
								if(isset($LeaseComplete_unit)){
									foreach($LeaseComplete_unit as $LeaseComplete_units){
						  ?>
						   <li class="seat">
							<a  href="<?php echo site_url('admin/Office/Unit_Details/'.$LeaseComplete_units->uid); ?>">
							  <input type="button" class="btn btn-default btn_default" value="<?php  echo $LeaseComplete_units->unit_no;  ?>"  />
							</a>
							</li>
							
							<?php
									}
								}
							?>

							
						  </ol>
						</li>
					  </ol>
					 
					</div>
            </div>
            <div class="tab-pane" id="delivered2">
            	<h3 class="text-center"></h3>
				<div class="plane">
					  
					  <ol class="cabin fuselage list-unstyled">
						<li class="row row--1">
						  <ol class="seats" type="A">
							 <?php 
								if(isset($LeaseBusiness_unit)){
									foreach($LeaseBusiness_unit as $LeaseBusiness_units){
						  ?>
						   <li class="seat">
							<a  href="<?php echo site_url('admin/Office/Unit_Details/'.$LeaseBusiness_units->uid); ?>">
							  <input type="button" class="btn btn-default btn_default" value="<?php  echo $LeaseBusiness_units->unit_no;  ?>"  />
							</a>
							</li>
							
							<?php
									}
								}
							?>

							
						  </ol>
						</li>
					  </ol>
					 
					</div>
            </div>
            <div class="tab-pane" id="pm_paid2">
            	<h3 class="text-center"></h3>
				<div class="plane">
					  
					  <ol class="cabin fuselage list-unstyled">
						<li class="row row--1">
						  <ol class="seats" type="A">
							 <?php 
								if(isset($LeaseAvail_unit)){
									foreach($LeaseAvail_unit as $LeaseAvail_units){
						  ?>
						   <li class="seat">
							<a  href="<?php echo site_url('admin/Office/Unit_Details/'.$LeaseAvail_units->uid); ?>">
							  <input type="button" class="btn btn-default btn_default" value="<?php  echo $LeaseAvail_units->unit_no;  ?>"  />
							</a>
							</li>
							
							<?php
									}
								}
							?>

							
						  </ol>
						</li>
					  </ol>
					 
					</div>
            </div>
            <div class="tab-pane" id="pm_notpaid2">
            	<h3 class="text-center"></h3>
				<div class="plane">
					  
					  <ol class="cabin fuselage list-unstyled">
						<li class="row row--1">
						  <ol class="seats" type="A">
							 <?php 
								if(isset($LeaseHIred_unit)){
									foreach($LeaseHIred_unit as $LeaseHIred_units){
						  ?>
						   <li class="seat">
							<a  href="<?php echo site_url('admin/Office/Unit_Details/'.$LeaseHIred_units->uid); ?>">
							  <input type="button" class="btn btn-default btn_default" value="<?php  echo $LeaseHIred_units->unit_no;  ?>"  />
							</a>
							</li>
							
							<?php
									}
								}
							?>

							
						  </ol>
						</li>
					  </ol>
					 
					</div>
            </div>
          </div>
        </div>

        <div class="clearfix"></div>

      </div>

      
   </div></section>

                    </div>
                </div>
            </div>
          </div>
			</div>
	 	</div>
    </section>
<script>
$('.project').click(function(){
	  var c_id	=	$(this).text();
	  if(c_id){
		  $.ajax({
			url: '<?php echo site_url('admin/Dashboard/Unit_load') ?>',
			type:'POST',
			data:{Project_id:c_id},
			success:function(result){
			$('#pages').html(result);
			 }
		  });
	  }  
	});

</script>
