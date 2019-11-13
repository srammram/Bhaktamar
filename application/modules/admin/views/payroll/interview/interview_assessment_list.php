<div class="row">
    <div class="col-md-12">

        <?php echo message_box('success'); ?>
        <?php echo message_box('error'); ?>
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header with-border bg-primary-dark">
                <h3 class="box-title"><?= lang('interview_assessment_list') ?></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->

            <!-- View massage -->



            <div class="box-body">

                <!-- View massage -->
                <div class="row">
                    <div class="col-md-12">

                        <table id="datatable-buttons" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>
                                        <?= lang('#') ?>
                                    </th>
                                    <th>
                                        <?= lang('name') ?>
                                    </th>
                                    <th>
                                        <?= lang('date_of_birth') ?>
                                    </th>
                                    <th>
                                        <?= lang('gender') ?>
                                    </th>
                                    <th>
                                        <?= lang('position') ?>
                                    </th>
                                    <th class="text-center">
                                        <?= lang('actions') ?>
                                    </th>
                                </tr>
                            </thead>


                            <tbody>
                                <?php if(!empty($interview_list)){ 
								$i = 1;
								
								?>
								
                                    <?php foreach($interview_list as $interview){ ?>
                                        <tr>
											<td>
                                                <?php echo $i ?>
                                            </td>
                                            <td>
                                                <?php echo $interview->name ?>
                                            </td>
                                            <td>
                                                <?php echo $interview->dob ?>
                                            </td>
                                            <td>
                                                <?php echo $interview->gender ?>
                                            </td>
                                            <td>
                                                <?php echo $interview->position ?>
                                            </td>
                                           
                                            <td class="text-center">
                                                <div class="btn-group">
                                                 
                                                    <a data-original-title="<?= lang('edit') ?>"
                                                       href="<?php echo base_url('admin/interview/edit_interview_assessment/'.str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encrypt->encode($interview->id))) ?>"
                                                       class="btn btn-xs bg-gray" type="button" data-toggle="tooltip" title=""><i class="fa fa-pencil"></i></a>
                                                    <a data-original-title="<?= lang('delete') ?>" onClick="return confirm('Are you sure you want to delete?')"
                                                       href="<?php echo base_url('admin/interview/delete_interview_assessment/'. str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encrypt->encode($interview->id))) ?>"
                                                       class="btn btn-xs btn-danger" type="button" data-toggle="tooltip" title=""><i class="fa fa-times"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php $i++;
									} ?>
                                <?php } ?>
                            </tbody>
							
							
							
							
                        </table>

                    </div>
                </div>

            </div>
            <!-- /.box-body -->

        </div>
        <!-- /.box -->

    </div>
</div>
<script>
	$('form').attr('autocomplete', 'off');
	</script>