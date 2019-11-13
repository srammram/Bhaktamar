
<div class="row">
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header with-border bg-primary-dark">
                <h3 class="box-title"><?= lang('Create_user') ?></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php echo $form->open(); ?>

            <div class="box-body">

                <!-- View massage -->
                <?php echo $form->messages(); ?>

                <div class="row">
                    <div class="col-md-6 col-sm-12 col-xs-12">

                        <?php echo $form->bs3_text(lang('username'), 'username'); ?>
                       
                                    <div class="form-group">
                                        <label for="field-1" class="col-sm-3 control-label"><?= lang('department') ?> <span class="required">*</span></label>

                                      
                                            <select class="form-control select2" name="department_id" id="department" onchange="get_employee(this.value)">
                                                <option value="" ><?= lang('select_department') ?>...</option>
                                                <?php foreach ($department as $v_department) : ?>
                                                    <option value="<?php echo $v_department->id ?>" >
                                                        <?php echo $v_department->department ?></option>
                                                <?php endforeach; ?>

                                            </select>

                                    </div>

                                    <div class="form-group">
                                        <label for="field-1" class="col-sm-3 control-label"><?= lang('employee') ?> <span class="required">*</span></label>


                                            <select class="form-control select2" name="employee_id" id="employee"  onchange="get_employee_email(this.value)">
                                                <option value=""><?= lang('please_select') ?></option>
                                                <?php foreach($employee as $item){ ?>
                                                    <option value="<?php echo $item->id ?>" >
                                                        <?php echo  $item->first_name.' '.$item->last_name ?>
                                                    </option>
                                                <?php } ?>

                                            </select>
                                    </div>
                        <div class="form-group">
						<label for="email">Email</label>
						<input name="email" value="" id="email" class="form-control input-lg" type="email">
                        </div>
                        
                        <?php echo $form->bs3_password(lang('password'), 'password'); ?>
                        <?php echo $form->bs3_password(lang('retype_password'), 'retype_password'); ?>

                        <?php if ( !empty($groups) ): ?>
                            <div class="form-group">
                                <label for="groups"><?= lang('group') ?></label>
                                <div>
                                    <select class="form-control" name="groups[]">
                                        <option value=""><?= lang('select_group') ?>...</option>
                                    <?php foreach ($groups as $group): ?>
                                        <option value="<?php echo $group->id; ?>"><?php echo $group->description; ?></option>
                                    <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        <?php endif; ?>


                    </div>




                </div>

            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                <?php echo $form->bs4_submit(lang('submit')); ?>
            </div>
            <?php echo $form->close(); ?>

        </div>
        <!-- /.box -->

    </div>
</div>
<script>
	$('form').attr('autocomplete', 'off');
	</script>