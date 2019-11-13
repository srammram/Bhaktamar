
<div class="row">
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header with-border bg-primary-dark">
                <h3 class="box-title"><?= lang('Year_end_process') ?></h3>
				<div class="box-tools">
                    <div class="input-group input-group-sm" >
                        <a class="btn btn-default btn-sm btn-flat " id="solTitle" onclick="call()" ><i class="fa fa-fw fa-plus"></i><?= lang('Leave_carry_forward') ?></a>
                    </div>
                </div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->

            <div class="box-body">

                <!-- View massage -->
                <!-- View massage -->
                <?php echo message_box('success'); ?>
                <?php echo message_box('error'); ?>

                <div class="row">
                    <div class="col-md-12">


                        <div id="msg"></div>


                        <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                              
                                <th><?= lang('employee_name') ?></th>
                           
                                <th><?= lang('Leave_type') ?></th>
                                <th><?= lang('Year_Limit') ?></th>
                                <th><?= lang('Carry_forward') ?></th>
                                <th style="width:125px;"><?= lang('Total_allowed') ?></th>
                            </tr>
                            </thead>
                            <tbody>
							<?php  
							if(isset($carry_forward_list))
							{
								foreach($carry_forward_list as $list)
								{
							?>
							<tr>
							<td><?php echo $list->first_name;  ?></td>
							<td><?php echo $list->leave_category;  ?></td>
							<td><?php echo $list->YearLimit;  ?></td>
							<td><?php echo $list->Balance_Leave;  ?></td>
							<td><?php echo ($list->Balance_Leave)+($list->YearLimit);  ?></td>
							</tr>
							<?php  
								}
							}
							?>
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
function call()
{
	
        //Do stuff when clicked
}

</script>
<script>
	$('form').attr('autocomplete', 'off');
	</script>

