
<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- /.col -->
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <?= lang('import_attendance') ?>
                    </h3>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->

                <?php echo $form->open(); ?>

                <div class="box-body">

                    <!-- View massage -->
                    <?php echo $form->messages(); ?>
                    <!-- View massage -->
                    <?php echo message_box('success'); ?>
                    <?php echo message_box('error'); ?>

                    <div class="row">
                        <div class="col-md-5">
                            <div id="msg"></div>
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="row">

                                        <div class="col-md-10">

                                            <strong><?= lang('download_sample_csv_file') ?></strong><br/>
                                            <p>Import employee attendance use <strong>Employee ID</strong> Search from bellow Table</p>
                                           <!-- <p>Attendance Status: 1 = Present | 0 = Absent | 3 = On leave</p>-->
                                            <p>Date Format:Year-Month-Day | 2018-01-28</p>
											 <p>System Date Format Should Be (2018-01-28)</p>
                                            <a href="<?php echo site_url('admin/payroll/employee/downloadAttendanceSample')?>"><i class="fa fa-download" aria-hidden="true"></i> <?= lang('sample_csv_file') ?></a>
                                               <div class="form-group">
                                                <label><?= lang('import_attendance') ?></label>
                                                <input type="file" name="import" class="form-control">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <input class="btn bg-navy" name="submit" type="submit" value="<?= lang('import') ?>">
                        </div>

                        <div class="col-md-7">
					

                        <table id="datatable-buttons" class="table table-bordered table-striped datatable-buttons dataTable no-footer dtr-inline">
                            <thead>
                                <tr>
                                    <th><?= lang('hrd_years') ?></th>
									 <th><?= lang('Year_range') ?></th>
                                    
                                    <th>
                                        <?= lang('active') ?>
                                    </th>
                                    <th class="text-center">
                                        <?= lang('actions') ?>
                                    </th>
                                </tr>
                            </thead>


                            <tbody>
                                <?php if(!empty($crud)){ ?>
                                    <?php foreach($crud as $item){ ?>
                                        <tr>
                                            <td>
                                                <?php echo $item->employee_id; ?>
                                            </td>
											<td>
                                                <?php echo $item->first_name; ?>
                                            </td>
                                            <td>
                                                <?php echo $item->last_name; ?>
                                            </td>
                                            <td class="text-center">
                                              <?php echo $item->department; ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
								
                            </tbody>
                        </table>
                        </div>
                    </div>


                </div>
                <!-- /.box-body -->

                <div class="box-footer">

                </div>
                <?php echo $form->close(); ?>

            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->
<script>
	$('form').attr('autocomplete', 'off');
	</script>

