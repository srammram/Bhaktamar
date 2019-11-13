<style type="text/css">
    /*=============*/
    /*table*/
	.title_fr_c h3{text-align: center;}
    .form_che_k {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    .form_che_k td,.form_che_k
    th {
        border: 1px solid #dddddd;
        text-align: center;
        padding: 8px;
    }
    .form_che_k input[type="text"] {
        width: 100%;
        border: honeydew;
        outline: none;
        background-color: transparent;
    }

    .area {
        overflow: auto;
        resize: vertical;
        width: 100%;
        min-height: 56px;
        border: 0px;
        outline: none;
        border-right: 1px solid #0000001a;
        border-bottom: 1px solid #0000001a;
    }

.form_che_k tr td
    input[type=checkbox], .form_che_k tr td
    input[type=radio] {
        zoom: 1.5;
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
                            <h3 class="box-title"><?= lang('change_permission') ?></h3>
                        </div>
                        <div class="panel-body">

                            <?php echo form_open('admin/panel/update_permission', array('class' => 'form-horizontal')) ?>



                            <div class="panel_controls">
                                <div class="form-group margin">
                                    <label class="col-sm-3 control-label"><?= lang('name') ?> </label>

                                    <div class="col-sm-7">
                                        <input type="text" disabled name="name" value="<?php if(!empty($admin_groups)) echo $admin_groups->name ?>" class="form-control"  >
                                    </div>
                                </div>

                                <div class="form-group margin">
                                    <label class="col-sm-3 control-label"><?= lang('description') ?> </label>

                                    <div class="col-sm-7">
										<input type="text" disabled name="description" value="<?php if(!empty($admin_groups)) echo $admin_groups->description ?>" class="form-control"  >
                                    </div>
                                </div>
								
								<?php 
							/* 	echo '<pre>';
								print_r($permission);
								die;  */
								?>
								
								<div class="table_content"> <label for="email"><?= lang('Role_permission') ?></label> 
					<table class="form_che_k">
						<tr class="">
							<th class="org" width="20%"><?= lang('ModuleName') ?></th>
							<th width="10%"><?= lang('Active') ?></th>
							<th width="40%">Miscellaneous</th>
						</tr>
						
						<tr>
							<td><?= lang('Employee_Module') ?></td>
								<td><input type="checkbox" name="employee" value="1" <?php if(!empty($permission->employee))  echo $permission->employee == '1' ?'checked':''  ?> ></td>
								<td><input type="checkbox" name="reset_pwd" value="1" <?php if(!empty($permission->reset_pwd))  echo $permission->reset_pwd == '1' ?'checked':''  ?>>Reset password</td>
						</tr>
						<tr>
							<td><?= lang('Payroll_Module') ?></td>
								<td><input type="checkbox" name="payroll" value="1" <?php if(!empty($permission->payroll))  echo $permission->payroll == '1' ?'checked':''  ?>></td>
								<td><input type="checkbox" name="change_permission" value="1" <?php if(!empty($permission->change_permission))  echo $permission->change_permission == '1' ?'checked':''  ?>>Change Permission</td>
						</tr>
						<tr>
							<td><?= lang('Interview_Module') ?></td>
							<td><input type="checkbox" name="interview" value="1" <?php if(!empty($permission->interview))  echo $permission->interview == '1' ?'checked':''  ?>></td>
							<td></td>
						</tr>	
						<tr>
							<td><?= lang('Notice_Module') ?></td>
								<td><input type="checkbox" name="notice" value="1" <?php if(!empty($permission->notice))  echo $permission->notice == '1' ?'checked':''  ?>></td>
								<td></td>
						</tr>
						
						<tr>
							<td><?= lang('Panel_Module') ?></td>
								<td><input type="checkbox" name="panel" value="1" <?php if(!empty($permission->panel))  echo $permission->panel == '1' ?'checked':''  ?>></td>
								<td></td>
						</tr>
						<tr>
							<td><?= lang('Office_Module') ?></td>
								<td><input type="checkbox" name="office" value="1" <?php if(!empty($permission->office))  echo $permission->office == '1' ?'checked':''  ?>></td>
								<td></td>
						</tr>
						<tr>
							    <td><?= lang('Setting_Module') ?></td>
								<td><input type="checkbox" name="setting" value="1" <?php if(!empty($permission->setting))  echo $permission->setting == '1' ?'checked':''  ?>></td>
								<td></td>
								
						</tr>
						<tr>
							<td><?= lang('Report_Module') ?></td>
								<td><input type="checkbox" name="reports" value="1" <?php if(!empty($permission->reports))  echo $permission->reports == '1' ?'checked':''  ?>></td>
								<td></td>
						</tr>
						<tr>
							<td><?= lang('Logs') ?></td>
								<td><input type="checkbox" name="Logs" value="1" <?php if(!empty($permission->Logs))  echo $permission->Logs == '1' ?'checked':''  ?>></td>
								<td></td>
						</tr>
						<tr>
							<td>Roles</td>
							<td>  <input type="checkbox" name="role_list" value="1" <?php if(!empty($permission->role_add))  echo $permission->role_add == '1' ?'checked':''  ?>><?= lang('Role_add') ?><br>
							   <input type="checkbox" name="role_add" value="1" <?php if(!empty($permission->role_edit))  echo $permission->role_edit == '1' ?'checked':''  ?>><?= lang('Role_Edit') ?><br>
							   <input type="checkbox" name="role_del" value="1" <?php if(!empty($permission->role_del))  echo $permission->role_del == '1' ?'checked':''  ?>>    <?= lang('Role_Delete') ?><br>
							</td>
						
							<td></td>
						
							
						</tr>	
						
						<!-- <tr>
							<td>Recruitment</td>
							<td><input type="checkbox" name="recruitment[]" value="1">1</td>
							<td><input type="checkbox" name="recruitment[]" value="2">2</td>
							<td><input type="checkbox" name="recruitment[]" value="3">3</td>
							<td><input type="checkbox" name="recruitment[]" value="4">4</td>
							<td><input type="checkbox" name="recruitment[]" value="5">5</td>
						</tr>
						<tr>
							<td>Notice Board</td>
							<td><input type="checkbox" name="notice[]" value="1">1</td>
							<td><input type="checkbox" name="notice[]" value="2">2</td>
							<td><input type="checkbox" name="notice[]" value="3">3</td>
							<td><input type="checkbox" name="notice[]" value="4">4</td>
							<td><input type="checkbox" name="notice[]" value="5">5</td>
						</tr>
						<tr>
							<td>Office Settings</td>
							<td><input type="checkbox" name="office[]" value="1">1</td>
							<td><input type="checkbox" name="office[]" value="2">2</td>
							<td><input type="checkbox" name="office[]" value="3">3</td>
							<td><input type="checkbox" name="office[]" value="4">4</td>
							<td><input type="checkbox" name="office[]" value="5">5</td>
						</tr>
						<tr>
							<td>Settings</td>
							<td><input type="checkbox" name="settings[]" value="1">1</td>
							<td><input type="checkbox" name="settings[]" value="2">2</td>
							<td><input type="checkbox" name="settings[]" value="3">3</td>
							<td><input type="checkbox" name="settings[]" value="4">4</td>
							<td><input type="checkbox" name="settings[]" value="5">5</td>
						</tr>
						<tr>
							<td>Reports</td>
							<td><input type="checkbox" name="reports[]" value="1">1</td>
							<td><input type="checkbox" name="reports[]" value="2">2</td>
							<td><input type="checkbox" name="reports[]" value="3">3</td>
							<td><input type="checkbox" name="reports[]" value="4">4</td>
							<td><input type="checkbox" name="reports[]" value="5">5</td>
						</tr>
						<tr>
							<td>User Activity</td>
							<td><input type="checkbox" name="user_activity[]" value="1">1</td>
							<td><input type="checkbox" name="user_activity[]" value="2">2</td>
							<td><input type="checkbox" name="user_activity[]" value="3">3</td>
							<td><input type="checkbox" name="user_activity[]" value="4">4</td>
							<td><input type="checkbox" name="user_activity[]" value="5">5</td>
						</tr> -->
						
						
					</table>
				</div>
							
                                <input type="hidden" name="id" value="<?php if(!empty($admin_groups)) echo $admin_groups->id  ?>">
								<br /><br />

                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-5">
                                        <button type="submit" id="sbtn" name="sbtn" value="1" class="btn bg-olive btn-md btn-flat"><?= lang('save') ?></button>
                                    </div>
                                </div> 
                            </div>
                            <?php echo form_close() ?>







                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

   

   
<script>
	$('form').attr('autocomplete', 'off');
	</script>