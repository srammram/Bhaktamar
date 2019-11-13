
<div class="row">
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header with-border bg-primary-dark">
                <h3 class="box-title"><?= lang('Logs') ?></h3>
                <div class="box-tools">
                    <div class="input-group input-group-sm" >
                       
                    </div>
                </div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <div id="msg"></div>
                      <table id="logs" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th><?= lang('Type') ?></th>
                                <th><?= lang('Log_message') ?></th>
                                <th style="width:125px;"><?= lang('Table_name') ?></th>
								 <th style="width:125px;"><?= lang('Table_id') ?></th>
								  <th style="width:125px;"><?= lang('User_name') ?></th>
								   <th style="width:125px;"><?= lang('Log_time') ?></th>
                            </tr>
                            </thead>
                            <tbody>
							<?php  
							if(isset($logs))
							{
								foreach($logs as $log)
								{
							?>
							 <tr>
							<td><?php   
                                    switch($log->STATUS)
									{
										case 'ERROR':
										echo '<p style="color:Red">'.$log->STATUS.'</p>';
										break;
										case 'Delete':
											echo '<p style="color:green">'.$log->STATUS.'</p>';
										break;
										case 'Update':
											echo '<p style="color:Green">'.$log->STATUS.'</p>';
										break;
										case 'Insert':
											echo '<p style="color:green">'.$log->STATUS.'</p>';
										break;
										default:
                                             echo '<p style="color:green">'.$log->STATUS.'</p>';
									}

							?></td>
							<td><?php 

 switch($log->STATUS)
									{
										case 'ERROR':
										echo '<p style="color:Red">'.$log->message.'</p>';
										break;
										case 'Delete':
											echo '<p style="color:green">'.$log->message.'</p>';
										break;
										case 'Update':
											echo '<p style="color:Green">'.$log->message.'</p>';
										break;
										case 'Insert':
											echo '<p style="color:green">'.$log->message.'</p>';
										break;
									default:
                                             echo '<p style="color:green">'.$log->message.'</p>';
									}


							 ; ?></td>
							<td><?php  echo $log->Table_name ; ?></td>
							<td><?php  echo $log->Table_row_id ; ?></td>
							<td><?php  echo $log->username ; ?></td>
							<td><?php  echo $log->created_at ; ?></td>
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
$(document).ready(function() {
    $('#logs').DataTable();
} );
</script>