<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/ajax.js"></script>
<link href='<?php echo base_url('assets/admin')?>/plugins/timepicker/bootstrap-timepicker.min.css' rel='stylesheet' media='screen'>

<script>
$(document).ready(function() {
    oTable = $('#workshifttable').dataTable({
        "aaSorting": [
            [1, "asc"]
        ],
        "aLengthMenu": [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "<?= lang('all') ?>"]
        ],
        "iDisplayLength": 10,
        'bProcessing': true,
        'bServerSide': true,
        'sAjaxSource': "<?php echo  base_url()  ?>" + 'admin/payroll/office/get_category_settings',
        'fnServerData': function(sSource, aoData, fnCallback) {
            $.ajax({
                'dataType': 'json',
                'type': 'POST',
                'url': sSource,
                'data': aoData,
                'success': fnCallback
            });
        },
        "aoColumns": [{
            "bSortable": false
        }, null, {
            "bSortable": false
        }]
    });
});
</script>
<style>
.modal-header {
    background-color: #0083ad !important;
    color: #fff;
}
</style>
<?php  $seg= $this->uri->segment(4);?>
<section class="content-header">
    <h1>&nbsp;</h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i>
                <?php echo lang('dashboard')?></a></li>
        <li><a href="<?php echo site_url('admin/payroll/office/category_settings') ?>"> <?= lang('Category_settings') ?> </a></li>
    </ol>
</section>
<div id="msg" class="col-md-8" style="margin:0 auto;"></div>

    <div class="col-sm-12 col-xs-12" style="margin-top: 15px;">
        <div class="box">
            <div class="box-header">
                <h2 class="blue"><?= lang('Category_settings') ?></h2>
                <div class="box-icon">
                    <a style="margin:4px;" class="btn btn-default btn-sm btn-flat" onclick="add()"><i
                     class="fa fa-fw fa-plus"></i><?= lang('Add_cat') ?></a>

                </div>
            </div>
            <div class="box-content">
                <div class="row">
                    <div class="col-lg-12">
                        <p class="introtext"><?= lang('list_results'); ?></p>
                        <div class="table-responsive col-sm-12">
                            <table id="workshifttable" class="table table-bordered table-hover table-striped reports-table">
                                <thead>
                                    <tr>
                                        <th><?= lang("id"); ?></th>
                                     <th> 	<?= lang('Cate_name') ?></th>
                                    <th style="width:125px;"><?= lang('actions') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="3" class="dataTables_empty">
                                            <?= lang('loading_data_from_server') ?>
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
   <script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/jquery.dataTables.dtFilter.min.js">
</script>
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/customdatatable.js"></script>
<script src='<?php echo base_url('assets/admin')?>/plugins/timepicker/bootstrap-timepicker.min.js'></script>
<script>

var save_method; //for save method string
var table;
var list          = 'admin/payroll/office/category_list'; //list view
var saveRow       = 'admin/payroll/office/Add_Category';
var edit          = 'admin/payroll/office/update_Category';
var deleteRow     = 'admin/payroll/office/delete_Category/';
var saveSuccess   = "<?php echo $this->message->success_msg(); ?>" ;
var deleteSuccess = "<?php echo $this->message->delete_msg(); ?>" ;
var deleteError   = "<?php echo lang('record_has_been_used'); ?>" ;
function edit_title(id)
{
	save_method = 'update';
	$('#form')[0].reset(); // reset form on modals
	$('.form-group').removeClass('has-error'); // clear error class
	$('.help-block').empty(); // clear error string
		//Ajax Load data from ajax
		$.ajax({
		url : "<?php echo site_url('admin/payroll/office/edit_Category/')?>/" + id,
		type: "GET",
		data : {'csrf_test_name' : getCookie('csrf_cookie_name')},
		dataType: "JSON",
		success: function(data)
			{
			$('[name="id"]').val(data.id);
			$('[name="categoryname"]').val(data.Categoryname);
			$('[name="late_coming"]').val(data.GraceTime_For_late_coming);
			$('[name="early_coming"]').val(data.GarceTime_for_Early_going);
			$('[name="gractimefor"]').val(data.GraceTime_for);
			$('[name="Ab_late_for"]').val(data.Absent_late_for_day);
			$('[name="Daily_grace_time"]').val(data.After_grace_minute);
			$('[name="Mark_absent_late_by"]').prop('checked', data.Mark_absent_late_by == 1 ? true:false);
			$('[name="Mark_absent"]').val(data.Absent_when_late_for);
			$('[name="Cal_ab_if_work_dur_less_than"]').prop('checked', data.Cal_ab_if_work_dur_less_than == 1 ? true:false);
			$('[name="Duration_less_than_min"]').val(data.Duration_less_than_min);
			$('[name="Late_fine_active"]').prop('checked', data.Fine_active == 1 ? true:false);
			$('[name="Late_fine"]').val(data.Fine_for_late);
			$('[name="Mark_absent_early_go"]').prop('checked', data.Mark_absent_early_go == 1 ? true:false);
			$('[name="Late_compensate"]').prop('checked', data.Late_compensate == 1 ? true:false);
			$('[name="Defaultfine"]').prop('checked', data.Deafult_fine == 1 ? true:false);
			$('[name="Punchvariantactive"]').prop('checked', data.Punch_variant_active == 1 ? true:false);
			$('[name="Mark_absent_early_go_min"]').val(data.Absent_when_early_go);
			$('[name="Variant_time"]').val(data.Punch_variant_time);
		//	$('[name="Afromdate"]').val(data.AttendanceFromDate);
		//	$('[name="Atodate"]').val(data.AttendanceTodate);
			$('[name="totalworkingdays"]').val(data.Total_workingday_pe_mon);
			$('[name="OverTime"]').prop('checked', data.OverTime == 1 ? true:false);
			$('#modal_form').modal('show'); // show bootstrap modal when complete loaded
			$('.modal-title').text('<?= lang('edit_Category') ?>'); // Set title to Bootstrap modal title
		  },
		error: function (jqXHR, textStatus, errorThrown)
		{
			alert('Error get data from ajax');
		}
});
}
</script>




<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
<style>
	.employee_dialog{width:90%!important;}
</style>
<div class="modal-dialog employee_dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title">
				<?= lang('Add_catgory') ?>
			</h4>
		</div>
		<div class="modal-body form">
			<form action="#" id="form" class="form-horizontal">
				<style>
					.employee_category{padding: 20px 0px;}
						.employee_category label{margin-top: 6px;font-weight: normal;}
						.employee_category .cate_name{font-weight: bold;}
						.employee_category .form-control{border-radius: 0px;}
						.employee_category .checkbox{padding: 0 30px;margin-top: 0px;}
				</style>

				
					<div class="employee_category" style="overflow: auto;">
						<div class="container">
							
								<form action="#" id="form" class="form-horizontal">
								<input type="hidden" value="" name="id"/>
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
										<div class="form-group col-sm-8 col-xs-12">
											<label class="control-label col-sm-3 col-xs-12 cate_name"><?= lang('categoryname') ?></label>
											<div class="col-sm-9 col-xs-12">
												<input type="text" class="form-control" placeholder="Default" name="categoryname">
											</div>
										</div>
										<div class="form-group col-sm-6 col-xs-12">
											<label class="control-label col-sm-4 col-xs-12"><?= lang('Grace_Time_for_Late_Coming') ?></label>
											<div class="col-sm-3 col-xs-12">
												<input type="text" class="form-control allownumericwithoutdecimalpoint" placeholder="15" value name="late_coming">
											</div>
											<label class="control-label col-sm-2 col-xs-1"><?= lang('Mins') ?></label>
										</div>
										<div class="form-group col-sm-6 col-xs-12">
											<label class="control-label col-sm-4 col-xs-12"><?= lang('Grace_Time_for_Early_Going') ?></label>
											<div class="col-sm-3 col-xs-12">
												<input type="text" class="form-control allownumericwithoutdecimalpoint" placeholder="30" name="early_coming">
											</div>
											<label class="control-label col-sm-2 col-xs-12"><?= lang('Mins') ?></label>
										</div>
										
										<div class="form-group col-sm-6 col-xs-12">
											<label class="control-label col-sm-4 col-xs-12"><?= lang('Max_Grace_Time_for') ?></label>
											<div class="col-sm-3 col-xs-12">
												<input type="text" class="form-control allownumericwithoutdecimalpoint" placeholder="15" value name="Ab_late_for">
											</div>
											<select class="form-contorl" name="gractimefor">
											<option value="<?= lang('Days') ?>"><?= lang('Days') ?></option><option value="<?= lang('Times') ?>"><?= lang('Times') ?></option></select>
										  
										</div>
										<div class="form-group col-sm-6 col-xs-12">
											<label class="control-label col-sm-4 col-xs-12"><?= lang('Daily_Grace_Time') ?></label>
											<div class="col-sm-3 col-xs-12">
												<input type="text" class="form-control allownumericwithoutdecimalpoint" value="" placeholder="30" name="Daily_grace_time">
											</div>
											<label class="control-label col-sm-2 col-xs-12"><?= lang('Mins') ?></label>
										</div>
										
										 <div class="checkbox form-group col-sm-12 col-xs-12">
											<label class="col-sm-4 col-xs-12"><input type="checkbox" value="1" name="Mark_absent_late_by"><?= lang('Mark_Absent_If_Late_by') ?></label>
											<div class="col-sm-1 col-xs-12">
												<input type="text" class="form-control allownumericwithoutdecimalpoint" placeholder="180" name="Mark_absent">
											</div>
											<label class="control-label col-sm-1 col-xs-12"><?= lang('Mins') ?></label>
										</div>
										
										<div class="checkbox form-group col-sm-12 col-xs-12">
											<label class="col-sm-4 col-xs-12"><input type="checkbox" value="1" name="Mark_absent_early_go"><?= lang('Mark_Absent_If_Early_Go') ?></label>
											<div class="col-sm-1 col-xs-12">
												<input type="text" class="form-control allownumericwithoutdecimalpoint" placeholder="180" name="Mark_absent_early_go_min">
											</div>
											<label class="control-label col-sm-1 col-xs-12"><?= lang('Mins') ?></label>
										</div>
										<div class="checkbox form-group col-sm-12 col-xs-12">
											<label class="col-sm-4 col-xs-12"><input type="checkbox" value="1" name="Cal_ab_if_work_dur_less_than"><?= lang('Calculate_Absent_if_Work_Duration_is_less_than') ?></label>
											<div class="col-sm-1 col-xs-12">
												<input type="text" class="form-control allownumericwithoutdecimalpoint" placeholder="120" name="Duration_less_than_min">
											</div>
											<label class="control-label col-sm-1 col-xs-12"><?= lang('Mins') ?></label>
										</div>
										<div class="checkbox form-group col-sm-12 col-xs-12">
											<label class="col-sm-4 col-xs-12"><input type="checkbox" class="fine" value="1" name="Late_fine_active"><?= lang('Late_Fine_Amount') ?></label>
											<div class="col-sm-1 col-xs-12">
												<input type="text" class="form-control allownumericwithdecimalpoint" placeholder="Amount" name="Late_fine">
											</div>
											<label class="control-label col-sm-1 col-xs-12" style="text-align:left;"><?= lang('Mins') ?></label>
										</div>
										<div class="checkbox form-group col-sm-12 col-xs-12">
											<label class="col-sm-4 col-xs-12"><input type="checkbox" value="1"  class="fine"  name="Defaultfine"><?= lang('Defaultfine') ?></label>
											
											<label class="control-label col-sm-12 col-xs-12" style="text-align:left;"><?= lang('Defaultfine_des') ?></label>
										</div>
											<div class="checkbox form-group col-sm-12 col-xs-12">
											<label class="col-sm-4 col-xs-12"><input type="checkbox" value="1" name="OverTime"><?= lang('OverTime') ?></label>
										</div>
										<div class="checkbox form-group col-sm-12 col-xs-12">
											<label class="col-sm-4 col-xs-12"><input type="checkbox" value="1" name="Late_compensate"><?= lang('Late_Compensate_with_Work_Hours') ?></label>
											
										</div>
										<div class="checkbox form-group col-sm-12 col-xs-12">
											<label class="col-sm-4 col-xs-12"><input type="checkbox" value="1"   name="Punchvariantactive"><?= lang('Punch_variant_time') ?></label>
											<div class="col-sm-1 col-xs-12">
												<input type="text" class="form-control allownumericwithoutdecimalpoint" placeholder="Min" name="Variant_time">
											</div>
											<label class="control-label col-sm-1 col-xs-12"> <?= lang('Mins') ?></label>
										</div>
										<div class="checkbox form-group col-sm-12 col-xs-12">
											<label class="col-sm-4 col-xs-12"><?= lang('Total_workingday') ?></label>
											<div class="col-sm-1 col-xs-12">
												<input type="text" class="form-control allownumericwithoutdecimalpoint" placeholder="<?= lang('Days') ?>" name="totalworkingdays">
											</div>
											<label class="control-label col-sm-1 col-xs-12"> <?= lang('Days') ?></label>
										</div>
								
							</div>
						</div>
					</div>

				 </form>
			  </div>


		<div class="modal-footer">
			<button type="button" id="btnSave" onclick="save()" class="btn btn-primary"><?= lang('save') ?></button>
			<button type="button" class="btn btn-danger" data-dismiss="modal"><?= lang('cancel') ?></button>
		</div>
	</div>
	<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- End Bootstrap modal -->