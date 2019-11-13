<style>
    .dataTables_filter {
        display: none;
    }
    .dataTables_info{
        display: none;
    }
</style>
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>


<div class="row">
    <div class="col-sm-12">

        <div class="row">
            <div class="col-sm-12" data-offset="0">
                <div class="wrap-fpanel">
                    <div class="box box-primary" data-collapsed="0">
                        <div class="box-header with-border bg-primary-dark">
                            <h3 class="box-title"><?= lang('MIssedOutPunching') ?></h3>
                        </div>
                        <div class="panel-body">
                            <?php echo form_open('admin/reports/MissedOut_Punch_Report', array('class' => 'form-horizontal')) ?>
                            <div class="panel_controls">

                                <div class="form-group">
                                    <label for="field-1" class="col-sm-3 control-label"><?= lang('department') ?> <span class="required">*</span></label>

                                    <div class="col-sm-5">
                                        <select name="department_id" id="department" class="form-control">
                                            <option value="" ><?= lang('select_department') ?>...</option>
                                            <?php foreach ($all_department as $v_department) : ?>
                                                <option value="<?php echo $v_department->id ?>">
                                                    <?php echo $v_department->department ?></option>
                                            <?php endforeach; ?>

                                        </select>
                                    </div>
                                </div>
								<div class="form-group margin">
                            <label class="col-sm-3 control-label"><?= lang('date') ?><span class="required">*</span></label>

                            <div class="col-sm-5">
                                <div class="input-group">
                                  <input class="form-control" id="datepicker" name="dates" data-date-format="yyyy/mm/dd" type="text">
                                    <div class="input-group-addon">
                                       <i class="fa fa-calendar"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
						
								
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-5">
                                        <button type="submit" id="sbtn" name="sbtn" value="1" class="btn bg-olive btn-md btn-flat"><?= lang('submit') ?></button>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="flag" value="1">
                            <?php echo form_close() ?>

                          <table class="table table-bordered  table-striped " id="Punchmonitoring" style="border-color:black;overflow-x:auto;">
					<thead >
						<tr >
							<th style="border-color:black;">SN</th>
							<th style="border-color:black;">E.Code</th>
							<th style="border-color:black;">Name</th>
							<th style="border-color:black;">Shift</th>
							<th style="border-color:black;">In Time</th>
							<th style="border-color:black;">Out Time</th>
							<th style="border-color:black;">Work Dur.</th>
							<th style="border-color:black;">OT</th>
							<th style="border-color:black;">Tot Dur.</th>
							<th style="border-color:black;">Status</th>
							<th style="border-color:black;">Remarks</th>
						</tr>
					</thead>
					<tbody>
						<tr style="border-color:black;">
							<td style="border-color:black;">1</td>
							<td style="border-color:black;">3</td>
							<td style="border-color:black;">Manikandan R</td>
							<td style="border-color:black;">FS</td>
							<td style="border-color:black;">10.09</td>
							<td style="border-color:black;"></td>
							<td style="border-color:black;">00.00</td>
							<td style="border-color:black;">00.00</td>
							<td style="border-color:black;">00.00</td>
							<td style="border-color:black;">Absent(No OutPunch)</td>
							<td style="border-color:black;"></td>
						</tr>
					</tbody>
				</table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(function() {
            $('#date').datepicker({
                autoclose: true,
                format: "yyyy-mm-dd",
            });
            $('#date1').datepicker({
                autoclose: true,
                format: "yyyy-mm-dd",
            });
        });
    </script>
