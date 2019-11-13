 <link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/jquery-ui.css" type="text/css">
 <link href="<?php echo base_url('assets/admin/plugins/iCheck/all.css')?>" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap-3.3.2.min.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap-multiselect.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/jquery-ui.css" type="text/css">
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/bootstrap-multiselect.js"></script>
<link href='<?php echo base_url('assets')?>/assets/plugin/datepicker/datepicker3.css' rel='stylesheet' media='screen'>
<style>
	#accordion .table tr td a{display: inline;}
</style>



<?php  $seg= $this->uri->segment(4);?>
   <section class="content-header">
          <h1>
            <br>
           </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
			<li><a href="<?php echo site_url('admin/Complaint') ?>"> <?php echo lang('Complaint')?> </a></li>
            <li class="active"><?php echo (empty($seg))?lang('add'):lang('edit');?></li>
          </ol>
	</section>
<section class="dashboard_pg">
	<div class="row">
	 	<div class="col-sm-12">
				<div class="col-sm-12">
					<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
						<div class="panel panel-default">
							<div class="panel-heading" role="tab" id="headingOne">
								<h4 class="panel-title"> <a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><?php    if(!empty($new)){ echo count($new) ; }else{ echo 0;  }  ?> New Request <small>All New Request</small> </a></h4>
							</div>
							<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
								<div class="panel-body">
								
								 	<table class="table table-striped">
								 		<thead>
								 			<tr>
								 			
								 				<th>RequestId</th>
								 				<th>Owner Name</th>
								 				<th>Description</th>
								 				<th>Date</th>
												<th>Action</th>
								 				
								 			</tr>
								 		</thead>
								 		<tbody>
								 		<?php   if(!empty($new)){ foreach ($new as $tickets){ ?>
										<tr><td><?php  echo $tickets->request_id  ; ?></td>
										<td><?php  echo $tickets->ownername  ; ?></td>
										<td><?php  echo $tickets->request_description  ; ?></td>
										<td><?php  echo $tickets->request_starttime  ; ?></td>
										<td><a href="<?php echo site_url('admin/administration/Administration/form/'. $tickets->request_id)?>"><button type="button" class="btn btn-success">Open</button></a></td>
										</tr>
										<?php  }  }?>
								 		</tbody>
								 	</table>
								 </div>
							</div>
						</div>
						<div class="panel panel-default">
							<div class="panel-heading" role="tab" id="headingOne">
								<h4 class="panel-title"> <a data-toggle="collapse" href="#collapse2" aria-expanded="true" aria-controls="collapseOne"> <?php   if(!empty($open)){ echo count($open) ; }else{ echo 0;  }  ?> Open Request <small>All Open Request</small> </a></h4>
							</div>
							<div id="collapse2" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
								<div class="panel-body">
								 	<table class="table table-striped">
								 		<thead>
								 			<tr>
								 			<tr>
								 				<th>RequestId</th>
								 				<th>Owner Name</th>
								 				<th>Description</th>
								 				<th>Date</th>
												<th>Action</th>
								 			</tr>
								 			</tr>
								 		</thead>
								 		<tbody>
								 			<?php   if(!empty($open)){ foreach ($open as $tickets){ ?>
										<tr><td><?php  echo $tickets->request_id  ; ?></td>
										<td><?php  echo $tickets->ownername  ; ?></td>
										<td><?php  echo $tickets->request_description  ; ?></td>
										<td><?php  echo $tickets->request_starttime  ; ?></td>
										<td width="25%;"><a href="<?php echo site_url('admin/administration/Administration/form/'. $tickets->request_id)?>"><button type="button" class="btn btn-success">View</button></a><a href="<?php echo site_url('admin/administration/Administration/requestReject/'. $tickets->request_id)?>"><span  class="glyphicon glyphicon-trash"></span></td>
										</tr>
										<?php  }  }?>
								 		</tbody>
								 	</table>
								 </div>
							</div>
						</div>
						<div class="panel panel-default">
							<div class="panel-heading" role="tab" id="headingOne">
								<h4 class="panel-title"> <a data-toggle="collapse" href="#collapse3" aria-expanded="true" aria-controls="collapseOne"> Quick Request Creation </a></h4>
							</div>
							<div id="collapse3" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
								<div class="panel-body">
								 	<div class="box-body">
                    <form method="post" action="<?php echo site_url('admin/administration/Administration/quick_form/'); ?>"
                        enctype="multipart/form-data" id="requestform">

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label><?php echo lang('title') ?></label>
                                </div>
                                <div class="col-md-3 title">
                                    <input type="text" name="title" class="form-control " autocomplete='off'
                                       >
                                </div>
                                <div class="col-md-2">
                                    <label><?php echo lang('date') ?></label>
                                </div>
                                <div class="col-md-3 date">
                                    <input type="text" name="date" class="form-control datepicker" autocomplete='off'
                                      onkeydown="return false" >
                                </div>
                            </div>
                        </div>
						
						 <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label><?php echo lang('requesttype') ?></label>				
                                </div>
                                <div class="col-md-3">
                                    <select name="requesttype" class="form-control" onchange="get_category(this.value)">
                                         <option><?php echo lang('select')?></option>
                                <?php 
								if(isset($requesttypes)){
									foreach($requesttypes as $row){
									?>
                                        <option value="<?php  echo $row->id   ?>"
                                           >
                                            <?php  echo $row->Name  ?></option>
                                        <?php
									}
								}
								?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label><?php echo lang('categorytype') ?></label>
                                </div>
                                <div class="col-md-3">
                                    <select name="categorytype" class="form-control" id="category" onchange="get_subcategory(this.value)">
                                        <option>Select</option>
                                        <?php 
								if(isset($category)){
									foreach($category as $item){
									?>
                                        <option value="<?php  echo $item->id   ?>"
                                         >
                                            <?php  echo $item->Name  ?></option>
                                        <?php
									}
								}
								?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label><?php echo lang('subtype') ?></label><span style="color:red" > *</span>
                                </div>
                                <div class="col-md-3">
                                    <select name="subcategory" class="form-control" id="subcategory" onchange="get_subcategory_details(this.value)">
                                        <option value="">Select</option>
                                        <?php 
							    	if(isset($Subcategory)){
									foreach($Subcategory as $item){
									?>
                                        <option value="<?php  echo $item->id   ?>"
                                          >
                                            <?php  echo $item->Name  ?></option>
                                        <?php
									}
								}
								?>
                                    </select>
                                </div>
                                 <div class="col-md-2">
                                    <label><?php echo lang('OwnerType') ?></label>				
                                </div>
                                <div class="col-md-3">
                                    <select name="OwnerType" class="form-control"  onchange="get_owners(this.value)">
                                         <option value=""><?php echo lang('select')?></option>
										 <option value="1">Owners</option>
										 <option value="2">Lease Owners</option>
                              
                                    </select>
                                </div>
								</div>
									</div>
								 <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label><?php echo lang('Request_by') ?></label>				
                                </div>
                                <div class="col-md-3">
                                    <select name="requestby" class="form-control"   id="owners" onchange="get_venue(this.value)" >
                                         <option value=""><?php echo lang('select')?></option>
                              
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label><?php echo lang('project_name') ?></label>
                                </div>
                                <div class="col-md-3">
                                    <select name="projectid" class="form-control" id="projectid" onchange="get_floors(this.value)">
                                        <option value="">Select</option>
                                        <?php 
								if(isset($Project)){
									foreach($Project as $item){
									?>
                                        <option value="<?php  echo $item->id   ?>"
                                            >
                                            <?php  echo $item->Name  ?></option>
                                        <?php
									}
								}
								?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label><?php echo lang('Floor_name') ?></label><span style="color:red" > *</span>
                                </div>
                                <div class="col-md-3">
                                    <select name="floorid" class="form-control" id="floor_id" onchange="get_houses(this.value)">
                                        <option value="">Select</option>
                                       
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label><?php echo lang('Houses') ?></label>
                                </div>
                                <div class="col-md-3">
                                   <select name="houseid[]" class="form-control" id="houses">
                                        <option value="">Select</option>
                                      
                                    </select>
                                </div>
								</div>
									</div>
								
							 <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label><?php echo lang('assign_to') ?></label><span style="color:red" > *</span>
                                </div>
                                <div class="col-md-3">
                                    <select name="assignto[]" class="form-control" >
                                        <option value="">Select</option>
                                        <?php 
							    	if(isset($services_persons)){
									foreach($services_persons as $item){
									?>
                                        <option value="<?php  echo $item->id   ?>"
                                           >
                                            <?php  echo $item->first_name  ?></option>
                                        <?php
									}
								}
								?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label><?php echo lang('Venue') ?></label>
                                </div>
                                <div class="col-md-3">
                                    <textarea name="venue" autocomplete="off"  id="venue"
                                        class="form-control"></textarea>
                                </div>
								</div>
									</div>
								 <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label><?php echo lang('services_cost') ?></label><span style="color:red" > *</span>
                                </div>
                                <div class="col-md-3">
                                  <input type="text" name="services_cost" class="form-control" id="price" readonly>
                                </div>
                                <div class="col-md-2">
                                    <label><?php echo lang('Note') ?></label>
                                </div>
                                <div class="col-md-3">
                                    <textarea name="description" autocomplete="off"
                                        class="form-control" ></textarea>
                                </div>
								</div>
									</div>
								<div class="form-group col-sm-12">
								 			<input type="submit" class="btn btn-primary " id="request" value="Submit">
								 		</div>
								 </div>
							</div>
						</div>
						</form>
					</div>
				</div>
				<!--<div class="col-sm-4">
					<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
						<div class="panel panel-default">
							<div class="panel-heading" role="tab" id="headingOne">
								<h4 class="panel-title"> <a data-toggle="collapse" href="#collapse4" aria-expanded="true" aria-controls="collapseOne">Active Services</a></h4>
							</div>
							<div id="collapse4" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
								<div class="panel-body">
								 	<figure class="col-sm-12">
								 		<img src="<?php echo base_url('assets/admin/dist/img/admin.png')?>" style="float: left;width: 50px;margin-right: 10px;">
								 		<figcaption>johnson</figcaption>
								 	</figure>
								 	<figure  class="col-sm-12">
								 		<img src="<?php echo base_url('assets/admin/dist/img/admin.png')?>" style="float: left;width: 50px;margin-right: 10px;">
								 		<figcaption>jancy</figcaption>
								 	</figure>
								 	<figure  class="col-sm-12">
								 		<img src="<?php echo base_url('assets/admin/dist/img/admin.png')?>" style="float: left;width: 50px;margin-right: 10px;">
								 		<figcaption>dfgfdagfd</figcaption>
								 	</figure>
								 	<figure  class="col-sm-12">
								 		<img src="<?php echo base_url('assets/admin/dist/img/admin.png')?>" style="float: left;width: 50px;margin-right: 10px;">
								 		<figcaption>johnsdfgfdgon</figcaption>
								 	</figure>
								 </div>
							</div>
						</div>
					</div>-->
				</div>
			</div>
		</div>
</section>

<script src="<?php echo base_url('assets/plugin/moment.min.js')?>"></script>
<script src="<?php echo base_url('assets/admin/plugins/daterangepicker/daterangepicker.js')?>"></script>
<script src="<?php echo base_url('assets/admin/plugins/iCheck/icheck.min.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/') ?>/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url('assets/admin/plugins')?>/jquery-validation/jquery.validate.min.js"></script>
<script>
$(function() {
    $('.datepicker').datepicker({
        todayHighlight: true,
        autoclose: true,
        format: 'yyyy-mm-dd',
    });

});
</script>
<script>
$("#request").click(function ()  {
    $("#requestform").validate({
        excluded: ':disabled',
         rules: {
            title: {
                required: true,
            },
            OwnerType: {
                required: true,
            },
			requestby:{
                required: true,
            },
            projectid: {
                required: true,
            },
            floorid: {
                required: true
            },
            houseid: {
                required: true
            },
          

        },

        highlight: function(element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function(element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'help-block animated fadeInDown',
        errorPlacement: function(error, element) {
            if (element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }
    })
});

</script>