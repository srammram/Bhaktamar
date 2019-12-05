 <?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<link href="<?php echo base_url('assets/admin/plugins/iCheck/all.css')?>" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap-datepicker.min.css">
<link href="<?php echo base_url('assets/admin/plugins/colorpicker/bootstrap-colorpicker.min.css')?>" rel="stylesheet" type="text/css" />
<link type="text/css" href="<?php echo base_url('assets/admin/plugins/redactor/redactor.css');?>" rel="stylesheet" />
<link href="<?php echo base_url('assets/admin/plugins/clockpicker/bootstrap-clockpicker.min.css')?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('assets/admin/plugins/multiselect/css/multi-select.css')?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('assets/admin/plugins/responsivetabs/responsive-tabs.css')?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('assets/admin/plugins/responsivetabs/style.css')?>" rel="stylesheet" type="text/css" />
<style>
	.table tbody tr td{border: none;line-height: 26px;}
	.table tbody tr td .table{margin-bottom: 0px;}
	.table tbody tr td .table tbody tr td{padding: 0px;}
	input[type=text]{border: none;}
	input[type=text]:focus{outline: none;box-shadow: none;}
</style>
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
                                    <div class="panel-wrapper collapse in">
                                        <div class="panel-body">
                                                <div class="form-body">
                                                    <div class="row">
                                                  <div class="table_se">
														<table class="table" cellpadding="0" cellspacing="0">
															<tbody>
																<tr>
																	<td>
																		<table class="table">
																			<tr>
																				<td align="center"><h4><input type="checkbox">&nbsp;<input type="text" value="Demand Letter"></h4></td>
																			</tr>
																			
																			<tr>
																				<td align="right"	><input type="checkbox"> &nbsp;Date</td>
																			</tr>
																		</table>
																	</td>
																</tr>
																<tr>
																	<td>
																		<table>
																			<tr>
																				<td><input type="checkbox"> &nbsp;Your name</td>
																			</tr>
																			<tr>
																				<td><input type="checkbox"> &nbsp;Address</td>
																			</tr>
																			<tr>
																				<td><input type="checkbox"> &nbsp;Address</td>
																			</tr>
																		</table>
																	</td>
																</tr>
																
																<tr>
																	<td>
																		<table>
																			<tr>
																				<td><input type="checkbox"> &nbsp;Debtor’s name</td>
																			</tr>
																			<tr>
																				<td><input type="checkbox"> &nbsp;Title</td>
																			</tr>
																			<tr>
																				<td><input type="checkbox"> &nbsp;Address</td>
																			</tr>
																			<tr>
																				<td><input type="checkbox"> &nbsp;Address</td>
																			</tr>
																		</table>
																	</td>
																</tr>
																<tr>
																	<td>
																		<table>
																			<tr>
																				<td><input type="checkbox"> &nbsp;Dear(Debtor’s name)</td>
																			</tr>
																			<tr>
																				<td><input type="checkbox"> &nbsp;Title</td>
																			</tr>
																			<tr>
																				<td><input type="checkbox"> &nbsp;Address</td>
																			</tr>
																		</table>
																	</td>
																</tr>
																<tr>
																	<td>
																		<table>
																			<tr>
																				<td><input type="checkbox"> &nbsp;<b>Letter of demand – outstanding payment</b></td>
																			</tr>
																		</table>
																	</td>
																</tr>
																<tr>
																	<td>
																		<table class="table">
																			<tr>
																				<td>
																					<div class="col-md-12">
											<b> <?php echo lang('content_section');?> <?php echo lang('description');?></b>
											<div class="form-group">
												<textarea name="content_section_description" class="form-control redactor" ><?php if(!empty($comments)){ echo $comments;  } ?></textarea>
											</div>	
								  		</div>
																				</td>
																			</tr>
																		</table>
																	</td>
																</tr>
				
				
													<tr>
														<td>
															<table>
																<tr>
																	<td><input type="checkbox"> &nbsp;Yours sincerely,</td>
																</tr>
															</table>
														</td>
													</tr>
												</tbody>
											</table>
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