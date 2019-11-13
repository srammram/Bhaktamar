<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/ajax.js"></script>
<link href='<?php echo base_url('assets/admin')?>/plugins/timepicker/bootstrap-timepicker.min.css' rel='stylesheet' media='screen'>
<link href='<?php echo base_url('assets/admin')?>/plugins/select2/select2.min.css' rel='stylesheet' media='screen'>

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
        'sAjaxSource': "<?php echo  base_url()  ?>" + 'admin/payroll/office/get_leaveType',
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
        <li><a href="<?php echo site_url('admin/payroll/office/leaveType') ?>"> <?= lang('list_leave_type') ?> </a></li>
    </ol>
</section>
<div id="msg" class="col-md-8" style="margin:0 auto;"></div>
    <div class="col-sm-12 col-xs-12" style="margin-top: 15px;">
        <div class="box">
            <div class="box-header">
                <h2 class="blue"><?= lang('list_leave_type') ?></h2>
                <div class="box-icon">
                    <a style="margin:4px;" class="btn btn-default btn-sm btn-flat" onclick="add()"><i
                     class="fa fa-fw fa-plus"></i><?= lang('add_leave_type') ?></a>
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
                                    <th><?= lang('leave_type') ?></th>
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
<script src='<?php echo base_url('assets/admin')?>/plugins/select2/select2.full.min.js'></script>

<script>
var save_method; //for save method string
    var table;
    var list        = 'admin/payroll/office/leaveType_list';
    var saveRow     = 'admin/payroll/office/add_leave_category';
    var edit        = 'admin/payroll/office/update_leave_category';
    var deleteRow   = 'admin/payroll/office/delete_leave_category/';
    var saveSuccess = "<?php echo $this->message->success_msg() ?>" ;
    var deleteSuccess = "<?php echo $this->message->delete_msg() ?>" ;
    var deleteError = "<?php echo lang('record_has_been_used'); ?>" ;
    function edit_title(id)
    {
        save_method = 'update';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        //Ajax Load data from ajax
        $.ajax({
            url : "<?php echo site_url('admin/payroll/office/edit_leave_category/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
				console.log(data);
                $('.category_id').append(data.scalar).trigger('change');
				//$('.category_id').html('<option value="1" selected >category 1</option>');
                $('[name="id"]').val(data.id);
                $('[name="leave_category"]').val(data.leave_category);
				$('[name="Deduct_days"]').val(data.Deduct_days);
				
			//	$('[name="YearLimit"]').val(data.YearLimit);
           //     $('[name="carryforward"]').prop('checked', data.Consider_as == 1 ? true:false);
			//	$('[name="carry_forward_limit"]').val(data.Carry_forward_limit);
                $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('<?= lang('add_leave_type') ?>'); // Set title to Bootstrap modal title
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
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><?= lang('add_leave_type') ?></h4>
            </div>
			 <form action="#"  id="form" class="form-horizontal leavetype">
            <div class="modal-body form">
               
                    <input type="hidden" value="" name="id"/>
                    <div class="form-body">
                                    <div class="form-group">
                                        <label class="control-label col-md-3"><?= lang('Category_type') ?></label>
										  <div class="col-md-9">
										 <select class="select2 form-control category_id" multiple  style="width: 100%;" name="Category_id[]">
                                            <option value=""><?= lang('please_select') ?>..</option>
                                             <?php foreach($category as $item){ ?>
                                                <option value="<?php echo $item->id ?>" ><?php echo $item->Categoryname ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
									</div>
									 <div class="form-group">
                            <label class="control-label col-md-3"><?= lang('leave_type') ?></label>
                            <div class="col-md-9">
                                <input name="leave_category"  class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
						<div class="form-group">
                            <label class="control-label col-md-3"><?= lang('Deduct_days') ?></label>
                            <div class="col-md-9">
                                <input name="Deduct_days" id="Deduct_days"  class="form-control digits" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <!-- <div class="form-group">
                            <label class="control-label col-md-3"><?= lang('Days') ?></label>
                            <div class="col-md-9">
                                <input name="YearLimit" id="YearLimit"  class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div> -->
						<!--	<div class="form-group">
                            <label class="control-label col-md-3"><?= lang('Carry_forward') ?></label>
                            <div class="col-md-9">
                                <input name="carryforward" value="1" id="carryforward"  type="checkbox">
                                <span class="help-block"></span>
                            </div>
                        </div>
						<div class="form-group">
                            <label class="control-label col-md-3"><?= lang('Carry_forward_limit') ?></label>
                            <div class="col-md-9">
                                <input name="carry_forward_limit"  class="form-control limits" type="text"  disabled="disabled">
                                <span class="help-block"></span>
                            </div>
                        </div>-->
                       </div>
                
            </div>
            <div class="modal-footer">
                <button type="submit" id="btnSave"  class="btn btn-primary"><?= lang('save') ?></button>
				<!-- onclick="save()" -->
                <button type="button" class="btn btn-danger" data-dismiss="modal"><?= lang('cancel') ?></button>
            </div>
			</form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->

<script>
$(function () {
        $("#carryforward").click(function () {
            if ($(this).is(":checked")) {
                $(".limits").removeAttr("disabled");
                $(".limits").focus();
            } else {
                $(".limits").attr("disabled", "disabled");
            }
        });
    });
</script>

<script>

$("#btnSave").click(function ()  {
    $("#form").validate({
        excluded: ':disabled',
	
        rules: {
             carry_forward_limit: { greaterThanNumber: "#YearLimit" },
            YearLimit: {
                required: true
            },
			leave_category: {
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
    });
	save();
	location.reload();
});

</script>
<script>
	$('form').attr('autocomplete', 'off');
	</script>

<script>
$(document).ready(function () {
  $(".digits").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
               return false;
    }
   });
});

</script>

<script>
$(".select2").select2();

</script>