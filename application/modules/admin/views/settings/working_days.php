

<section class="content">
    	 
<div class="row">
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header with-border bg-primary-dark">
                <h3 class="box-title"><?= lang('Working_days') ?></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->


            <?php echo form_open('admin/settings/save_working_days'); ?>

            <div class="box-body">

                <!-- View massage -->

                <!-- View massage -->
          

                <div class="row">
                    <div class="col-md-7 col-sm-12 col-xs-12 col-md-offset-2" style="padding-top: 40px; padding-bottom: 40px">

                        <div class="row">


                                <?php foreach($workingDays as $days): ?>
                                <label class="css-input css-checkbox css-checkbox-success">

                                    <input type="checkbox" name="working_days[]" value="<?php echo $days->id ?>"
                                        <?php echo $days->flag == 1? 'checked':'' ?>><span></span> <?php echo $days->days ?>

                                    <input type="hidden" name="days[]" value="<?php echo $days->id ?>">
                                </label>
                                <?php endforeach ?>


                        </div>

                    </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer ">
                    <button id="saveSalary" type="submit" class="btn bg-olive btn-flat col-md-offset-2"><?= lang('save') ?></button>
                </div>


            </div>
			</div></div></div>
			</section>
            <!-- /.box -->
            <?php echo form_close() ?>

        </div>
    </div>
	<script>
	$('form').attr('autocomplete', 'off');
	</script>