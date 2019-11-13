<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<link href='<?php echo base_url('assets/assets/css/custom.css')?>' rel='stylesheet' media='screen'>
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/ajax.js"></script>
<script>
$(document).ready(function() {
    oTable = $('#UnitTable').dataTable({
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
        'sAjaxSource': "<?php echo  base_url()  ?>" + 'admin/payroll/office/get_salaryComponent',
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
        }, null, null,null, null,null, {
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
        <li><a href="<?php echo site_url('admin/payroll/office/salaryComponent') ?>"> <?= lang('salary_component_list') ?> </a></li>
    </ol>
</section>
<div id="msg" class="col-md-8" style="margin:0 auto;"></div>

    <div class="col-sm-12 col-xs-12" style="margin-top: 15px;">
        <div class="box">
            <div class="box-header">
                <h2 class="blue"><?= lang('salary_component_list') ?></h2>
                <div class="box-icon">
                    <a style="margin:4px;" class="btn btn-default btn-sm btn-flat" onclick="add()"><i
                     class="fa fa-fw fa-plus"></i><?= lang('add_component') ?></a>

                </div>
            </div>
            <div class="box-content">
                <div class="row">
                    <div class="col-lg-12">
                        <p class="introtext"><?= lang('list_results'); ?></p>
                        <div class="table-responsive col-sm-12">
                            <table id="UnitTable" class="table table-bordered table-hover table-striped reports-table">
                                <thead>
                                    <tr>
									 <th><?= lang("id"); ?></th>
                                        <th><?= lang('name') ?></th>
                                <th><?= lang('type') ?></th>
                                <th style="width:125px;"><?= lang('total_payable') ?></th>
                                <th style="width:125px;"><?= lang('cost_company') ?></th>
                                <th style="width:125px;"><?= lang('rule') ?></th>
                                <th style="width:125px;"><?= lang('actions') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="7" class="dataTables_empty">
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

<script>

    var save_method; //for save method string
    var table;
    var list        = 'admin/payroll/office/salary_component_list';
    var saveRow     = 'admin/payroll/office/add_salary_component';
    var edit        = 'admin/payroll/office/update_salary_component';
    var deleteRow   = 'admin/payroll/office/delete_salary_component/';
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
            url : "<?php echo site_url('admin/payroll/office/edit_salary_component/')?>/" + id,
            type: "GET",
            //
            dataType: "JSON",
            success: function(data)
            {
                $('[name="id"]').val(data.id);
                $('[name="component_name"]').val(data.component_name);
                $('[name="type"][value=' + data.type + ']').prop('checked', true);
                $('[name="total_payable"]').prop('checked', data.total_payable == 1 ? true:false);
                $('[name="cost_company"]').prop('checked', data.cost_company == 1 ? true:false);
                $('[name="value_type"][value=' + data.value_type + ']').prop('checked', true);
				 $('#Of_what option[value=' + data.Of_what_id + ']').prop('selected', true);
				//  $('#of_what_value_type option[value=' + data.Of_what_value_type + ']').prop('selected', true);
				 $('[name="taxable"][value=' + data.Include_tax + ']').prop('checked', true);
                $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Salary Component'); // Set title to Bootstrap modal title
              $("#Of_what").children("option[value^=" + data.id + "]").hide();

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
                <h4 class="modal-title"><?= lang('add_salary_component') ?></h4>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id"/>
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3"><?= lang('component_name') ?></label>
                            <div class="col-md-9">
                                <input name="component_name"  class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>

                            <table style="width: 100%; padding-left: 50px">
                                <tbody><tr style="height: 50px">
                                    <td>
                                        <label for="exampleInputEmail1"><?= lang('type') ?> <span class="required">*</span></label>
                                    </td>
                                    <td>
                                        <label class="css-input css-radio css-radio-success push-10-r">
                                            <input name="type" value="1" checked="" type="radio"><span></span><?= lang('earning') ?>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="css-input css-radio css-radio-success push-10-r">
                                            <input name="type" value="2" type="radio"><span></span> <?= lang('deduction') ?>
                                        </label>
                                    </td>
                                </tr>

                                <tr style="height: 50px">
                                    <td>
                                        <label for="exampleInputEmail1"><?= lang('add_to') ?><span class="required">*</span></label>
                                    </td>
                                    <td>

                                        <label class="css-input css-checkbox css-checkbox-success">
                                            <input name="total_payable" value="1"  type="checkbox"><span></span> <?= lang('total_payable') ?>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="css-input css-checkbox css-checkbox-success">
                                            <input name="cost_company" value="1"  type="checkbox"><span></span> <?= lang('cost_company') ?>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    </td>
                                    <td colspan="2">
                                        <span class="chk_error_msg"></span>
                                    </td>

                                </tr>
                                <tr style="height: 50px">
                                    <td>
                                        <label for="exampleInputEmail1"><?= lang('value_type') ?><span class="required">*</span></label>
                                    </td>
                                    <td>
                                        <label class="css-input css-radio css-radio-success push-10-r">
                                            <input name="value_type" value="1" class="value_type_MOUNT" checked="" type="radio"><span></span><?= lang('amount') ?>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="css-input css-radio css-radio-success push-10-r">
                                            <input name="value_type" class="value_type_percentage" value="2"  type="radio"><span></span> <?= lang('percentage') ?>
                                        </label>
                                    </td>
                                </tr>

								
								<tr style="height: 50px">
                                    <td>
                                        <label for="exampleInputEmail1">  <?= lang('Calculate_on') ?><span class="required">*</span></label>
                                    </td>
                                    <td>
                                        <label class="css-input  push-10-r"> 
                                           
								
							         <div class="form-group">
                                     <select class="form-control" name="Of_what" id="Of_what" disabled>
                                    <option value="">Please Select..</option>
									 <option value="Gross_Salary">Gross Salary</option>
									  <option value="Net_Salary">Net Salary</option>
									<?php if(isset($Component)) { foreach($Component as $item) { ?>
                                    <option value="<?php  echo $item->id ; ?>"><?php  echo $item->component_name ; ?></option>   
                                      <?php  
									}
									}
									  ?>
                                   </select>
                                       </label>
                                    </td>
								<!--	 <td>
                                        <label class="css-input  push-10-r">
                                           	<div class="form-group">
													<select class="form-control" name="of_what_value_type" id="of_what_value_type">
                                           <option value="">Please Select..</option>
                                            <option value="1">Amount</option>
								        	<option value="2">Percentage</option>
                                           </select>
                                    </label>
                                       
                                    </td>-->
                                </tr>
								 <tr style="height: 50px">
                                    <td>
                                        <label for="exampleInputEmail1"><?= lang('Include_Taxable') ?><span class="required">*</span></label>
                                    </td>
                                   
                                    <td>
                                        <label class="css-input css-checkbox css-checkbox-success">
                                            <input name="taxable" value="1"  type="checkbox"><span></span>
                                        </label>
                                    </td>
                                </tr>
								</select>

								</div>
                                </tbody></table>

                    </div>

                </form>
            </div>


            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="check()" class="btn btn-primary"><?= lang('save') ?></button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><?= lang('cancel') ?></button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->

<script>
    function check()
    {
        if( $('[name="total_payable"]').prop('checked') == true || $('[name="cost_company"]').prop('checked') == true ){
            //do something
            save();

        }else{
            $(".chk_error_msg").html('<div class="help-block" style="color: #dd4b39;"><?= lang('please_select_at_least_one_chk') ?></div>');
            console.log('Not select');
        }

    }

</script>
<script>
$('.value_type_percentage').change(function() {
    if ($(this).val()== 2) {
        $('#Of_what').attr('disabled', false);
    } 
    else if ($(this).val()=='') {
		alert();
        $('#Of_what').attr('disabled', true);
    }
});
</script>

<script>
$('.value_type_MOUNT').change(function() {
    if ($(this).val()== 1) {
        $('#Of_what').attr('disabled', true);
    } 
    else if ($(this).val()=='') {
		alert();
        $('#Of_what').attr('disabled', false);
    }
});
</script>
<script>
	$('form').attr('autocomplete', 'off');
	</script>