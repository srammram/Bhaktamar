 <?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<link href="<?php echo base_url('assets/admin/plugins/iCheck/all.css')?>" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap-datepicker.min.css">
<link href="<?php echo base_url('assets/admin/plugins/colorpicker/bootstrap-colorpicker.min.css')?>" rel="stylesheet" type="text/css" />
<link type="text/css" href="<?php echo base_url('assets/admin/plugins/redactor/redactor.css');?>" rel="stylesheet" />
<link href="<?php echo base_url('assets/admin/plugins/clockpicker/bootstrap-clockpicker.min.css')?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('assets/admin/plugins/multiselect/css/multi-select.css')?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('assets/admin/plugins/responsivetabs/responsive-tabs.css')?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('assets/admin/plugins/responsivetabs/style.css')?>" rel="stylesheet" type="text/css" />
 <?php  $seg= $this->uri->segment(4);?>
 <section class="content-header">
     <h1><?php echo $page_title; ?></h1>
     <ol class="breadcrumb">
         <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i>
                 <?php echo lang('dashboard')?></a></li>
         <li><a href="<?php echo site_url('admin/Task') ?>"> <?php echo lang('Task')?> </a></li>
         <li class="active"><?php echo (empty($seg))?lang('add'):lang('edit');?></li>
     </ol>
 </section>
 <section class="content">
     <div class="row">
         <div class="col-xs-12">
             <div id="exTab1">
                 <div class="tab-content clearfix">
                     <div class="tab-pane active" id="1a">
                         <div class="box">
                             <div class="box-header">
                                 <h3 class="box-title"><?php echo lang('Task'); ?></h3>
                             </div><!-- /.box-header -->
                             <div class="box-body">
                                 <form method="post" action="<?php echo site_url('admin/Task/form/'); ?>"
                                     enctype="multipart/form-data" id="projectform">
                                                <div class=" show" id="new-task-panel" >
                                    <div class="panel-wrapper collapse in">
                                        <div class="panel-body">
                                                <div class="form-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Task Name</label>
                                                                <input type="text" id="heading" name="TaskName"
                                                                    class="form-control" value="<?php if(!empty($taskName)){ echo $taskName;  } ?>">
                                                            </div>
                                                        </div>
                                                        <!--/span-->
														<div class="col-md-6">
                                                            <label class="control-label">Parent Task</label>
                                                            <div class="form-group">
                                                                <select class="form-control "
                                                                    name="Parenttaskid">
                                                                    <option value="">--</option>
                                                                        <?php if ($tasks) {foreach ($tasks as $row) {?>
                                                                    <option value="<?php echo $row->id; ?>"<?php echo ($parentasktid==$row->id)?'selected':'';?>><?php echo $row->taskName; ?></option>
                                                                    <?php	} } ?>
                                                                </select>
                                                            </div>
                                                        </div>
														<div class="col-md-6">
                                                            <label class="control-label">Project</label>
                                                            <div class="form-group">
                                                                <select class="form-control projectid"
                                                                    name="projectid" onchange="get_building(this.value)">
                                                                    <option value="">--</option>
                                                                        <?php if ($project) {foreach ($project as $row) {?>
                                                                    <option value="<?php echo $row->id; ?>" <?php echo ($projectid==$row->id)?'selected':'';?>>
                                                                        <?php echo $row->Name; ?>
                                                                    </option>
                                                                    <?php	}}?>
                                                                </select>
                                                            </div>
                                                        </div>
															<div class="col-md-6">
                                                            <label class="control-label">Building</label>
                                                            <div class="form-group">
                                                                <select class="form-control building"
                                                                    name="building" id="building">
                                                                    <option value="">--</option>
																    <?php if ($building) {foreach ($building as $row) {?>
                                                                    <option value="<?php echo $row->bldid; ?>" <?php echo ($building_id==$row->bldid)?'selected':'';?>>
                                                                        <?php echo $row->name; ?>
                                                                    </option>
																	<?php   }  }   ?>
                                                                </select>
                                                            </div>
                                                        </div>
														<div class="col-md-6">
                                                            <label class="control-label">Project Stage</label>
                                                            <div class="form-group">
                                                                <select class="form-control "
                                                                    name="Projectstageid">
                                                                    <option value="">--</option>
                                                                        <?php if ($stages) {foreach ($stages as $item) {?>
                                                                    <option value="<?php echo $item->id; ?>"  <?php echo ($Projectstageid==$item->id)?'selected':'';?>>
                                                                        <?php echo $item->Name ?>
                                                                    </option>
                                                                    <?php	}}?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Start Date</label>
                                                                <input type="text" name="start_date" id="start_date "
                                                                    class="form-control datepicker" autocomplete="off"
                                                                   value="<?php if(!empty($start_date)){ echo $start_date;  } ?>">
                                                            </div>
                                                        </div>
                                                        <!--/span-->
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Due Date</label>
                                                                <input type="text" name="due_date" id="due_date"
                                                                    autocomplete="off" class="form-control datepicker" value="<?php if(!empty($due_date)){ echo $due_date;  } ?>">
                                                            </div>
                                                        </div>
                                                        <!--/span-->
                                                        
                                                        <div class="col-md-6">
                                                            <label class="control-label">Assigned To</label>
                                                            <div class="form-group">
                                                                <select class="form-control assigneto"
                                                                    name="assigned_to">
                                                                    <option value="">--
                                                                    </option>
                                                                        <?php if ($employee) {foreach ($employee as $row) {?>
                                                                    <option value="<?php echo $row->id; ?>"  <?php echo (@$assigned_to==$row->id)?'selected="selected"':'';?>>
                                                                        <?php echo $row->first_name . '-' . $row->last_name; ?>
                                                                    </option>

                                                                    <?php	}}?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 Taskstatus" >
                                                            <label class="control-label">Status</label>
                                                            <div class="form-group">
                                                                <select name="status" id="status" class="form-control">
                                                                    <option value="incomplete" <?php echo (@$status=='Incomplete')?'selected="selected"':'';?>>Incomplete</option>
                                                                    <option value="complete" <?php echo (@$status=='Complete')?'selected="selected"':'';?>>Complete</option>
                                                                </select>
                                                            </div>
                                                        </div>
														<div class="col-md-6 Taskstatus" >
                                                            <label class="control-label">Payment Plan</label>
                                                            <div class="form-group">
                                                                <select name="payment_plan" id="payment_plan" class="form-control">
																<option value="">--  </option>
																<?php  if($payment_plan){ foreach($payment_plan as $row){    ?>
																<option value="<?php echo $row->id;    ?>" <?php echo (@$payment_planid==$row->id)?'selected="selected"':'';?>><?php echo $row->name;   ?></option>
																<?php  }  }   ?>
                                                                </select>
                                                            </div>
                                                        </div>


                                                        <!--/span-->
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Priority</label>
                                                            
                                                                    <input type="radio" name="priority" id="radio13"
                                                                        value="High" <?php echo (@$status=='High')?'selected="selected"':'';?>>
                                                                    <label for="radio13" class="text-danger">
                                                                        High </label>
                                                              
                                                               
                                                                    <input type="radio" name="priority" checked=""
                                                                        id="radio14" value="Medium" <?php echo (@$status=='Medium')?'selected="selected"':'';?>>
                                                                    <label for="radio14" class="text-warning">
                                                                        Medium </label>

                                                                    <input type="radio" name="priority" id="radio15"
                                                                        value="Low" <?php echo (@$status=='Low')?'selected="selected"':'';?>>
                                                                    <label for="radio15" class="text-success">
                                                                        Low </label>
                                                            
                                                            </div>
                                                        </div>
														
															<div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Approved</label>
                                                                    <input type="checkbox" name="is_approved" id="radio13"
                                                                        value="1" <?php echo (@$is_approved==1)?'checked':'';?>>
                                                                   
                                                                   
                                                            </div>
                                                        </div>

														 <div class="col-md-12">
														<b> <?php echo lang('content_section');?> <?php echo lang('description');?></b>
														<div class="form-group">
										<textarea name="content_section_description" class="form-control redactor" ><?php if(!empty($comments)){ echo $comments;  } ?></textarea>
									</div>	
								  </div>		
								</div>
                                  </div>		
								</div>        
                                </div>
                            </div>
                        </div>
                                     <div class="box-footer">
                                        
                                         <input class="btn btn-primary" type="submit" id="project_form_submit"
                                             value="Save" />
                                     </div>
                                 </form>
                             </div><!-- /.box-body -->
                         </div>
                     </div><!-- /.row -->
 </section>

<script src="<?php echo base_url('assets/admin/plugins/iCheck/icheck.min.js')?>" type="text/javascript"></script>		
<script type="text/javascript" src="<?php echo base_url('assets/admin/plugins/colorpicker/bootstrap-colorpicker.min.js');?>"></script>		
<script type="text/javascript" src="<?php echo base_url('assets/admin/plugins/redactor/redactor.min.js');?>"></script>		
<script src="<?php echo base_url('assets/admin/plugins/clockpicker/bootstrap-clockpicker.min.js')?>" type="text/javascript"></script>		
<script src="<?php echo base_url('assets/admin/plugins/multiselect/js/jquery.multi-select.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/plugins/multiselect/js/jquery.quicksearch.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/plugins/responsivetabs/jquery.responsiveTabs.min.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/plugins/daterangepicker/daterangepicker.js')?>"></script>
<script>
$(function() {
	$(".colorpicker").colorpicker();
	$(".colorpicker2").colorpicker();
	$('.clockpicker').clockpicker({donetext:'Done'});
	$('#responsiveTabsDemo').responsiveTabs({
    	startCollapsed: 'accordion'
	});
	$('#reservationtime').daterangepicker({
        timePicker: true,
		timePickerIncrement: 30,
        locale: {
            format: 'YYYY-MM-DD'
        }
    });
	$('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
     });
	$('.multiselect').multiSelect({
	  selectableHeader: "<input type='text' class='search-input form-control' autocomplete='off' placeholder='Search..'>",
	  selectionHeader: "<input type='text' class='search-input form-control' autocomplete='off' placeholder='Search..'>",
	  afterInit: function(ms){
		var that = this,
			$selectableSearch = that.$selectableUl.prev(),
			$selectionSearch = that.$selectionUl.prev(),
			selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
			selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';
	
		that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
		.on('keydown', function(e){
		  if (e.which === 40){
			that.$selectableUl.focus();
			return false;
		  }
		});
	
		that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
		.on('keydown', function(e){
		  if (e.which == 40){
			that.$selectionUl.focus();
			return false;
		  }
		});
	  },
	  afterSelect: function(){
		this.qs1.cache();
		this.qs2.cache();
	  },
	  afterDeselect: function(){
		this.qs1.cache();
		this.qs2.cache();
	  }
	});
	
	 $('.multiselect').change(function () {
			//var mangle =  $(this).closest('form').find('select.multiselect option:selected').val();
			var tot = 0;
            $.each($(this).closest('form').find('select.multiselect option:selected'), function () {
                var curr_val = parseFloat($(this).data('id'));
               // alert(curr_val);
				tot = tot + curr_val;
				//console.log(tot);
            }
            );
            //var discount = $('#dis_id').val();
			var discount =  $(this).closest('form').find('.dis_id').val();
            var gross = tot - discount;
            //$('#add_form').find('[name="sub_total"]').val(tot).end()
            $(this).closest('form').find('[name="sub_total"]').val(tot).end()
			$(this).closest('form').find('[name="total"]').val(Math.round(gross))
			//$('#add_form').find('[name="total"]').val(gross)
			 
        }

    );	  	
	$('.redactor').redactor({
			  // formatting: ['p', 'blockquote', 'h2','img'],
            minHeight: 200,
            imageUpload: '<?php echo site_url('/wysiwyg/upload_image');?>',
            fileUpload: '<?php echo site_url('/wysiwyg/upload_file');?>',
            imageGetJson: '<?php echo site_url('/wysiwyg/get_images');?>',
            imageUploadErrorCallback: function(json)
            {
                alert(json.error);
            },
            fileUploadErrorCallback: function(json)
            {
                alert(json.error);
            }
      });
});
</script>
<script>
	$('form').attr('autocomplete', 'off');
	</script>