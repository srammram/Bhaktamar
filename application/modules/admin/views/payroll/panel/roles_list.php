<?php
// Roles
$this->load->library('session');
$userId = $this->session->userdata('user_id');

if(!empty($userId)){
	$group_id = $this->db->get_where('admin_users_groups',array('user_id'=>$userId))->row('group_id');
} else{
	$group_id = 0;
} 

$result = $this->db->get_where('permission',array('group_id'=>$group_id))->row();

/* echo '<pre>';
print_r($result); 
print_r($result->user_list); 
print_r($result->group_id); */  
//die;
?>
<div class="row">
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header with-border bg-primary-dark">
                <h3 class="box-title"><?= lang('roles_list') ?></h3>
                <div class="box-tools">
                    <div class="input-group input-group-sm" >
                   <!--  <a class="btn btn-default btn-sm btn-flat" onclick="add()"><i class="fa fa-fw fa-plus"></i><?= lang('add_role') ?> </a> -->
                    </div>
                </div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div class="box-body">
                <!-- View massage -->
                <div class="row">
                    <div class="col-md-12">
                        <div id="msg"></div>
                        <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr><th>#</th>
                                <th><?= lang('name') ?></th>
								<th><?= lang('description') ?></th>
								<?php if($result->change_permission == 1) {  ?>
									<th style="width:125px;"><?= lang('actions') ?></th>
								<?php } ?>
                            </tr>
							
                            </thead>
                             <tbody>
                                <?php if(!empty($admin_groups_list)){ 
								$i = 1;
								
								?>
								
                                    <?php foreach($admin_groups_list as $admin_groups){ ?>
                                        <tr>
											<td>
                                                <?php echo $i ?>
                                            </td>
                                            <td>
                                                <?php echo $admin_groups->name ?>
                                            </td>
                                            <td>
                                                <?php echo $admin_groups->description ?>
                                            </td>
                                            
                                           <?php if($result->change_permission == 1) {  ?>
                                            <td class="text-center">
                                                <div class="btn-group">
													<a data-original-title="<?= lang('change_permission') ?>"
                                                       href="<?php echo base_url('admin/panel/change_permission/'.$admin_groups->id) ?>" <?php echo $admin_groups->id; ?>
                                                       class="btn btn-xs bg-gray" type="button" data-toggle="tooltip" title=""><i class="fa fa-tasks"></i></a>
													
													<?php if($admin_groups->name != 'admin' && $result->role_edit == 1) {  ?> 
                                                    <a data-original-title="<?= lang('edit') ?>"
                                                       href="<?php echo base_url('admin/panel/edit_roles/'.$admin_groups->id) ?>" <?php echo $admin_groups->id; ?>
                                                       class="btn btn-xs bg-gray" type="button" data-toggle="tooltip" title=""><i class="fa fa-pencil"></i></a> 
													<?php }  ?>
													
													<?php if($admin_groups->name != 'admin' && $result->role_del == 1) {  ?> 
                                                    <a data-original-title="<?= lang('delete') ?>" onClick="return confirm('Are you sure you want to delete?')"
                                                       href="<?php echo base_url('admin/panel/delete_roles/'.$admin_groups->id) ?>"
                                                       class="btn btn-xs btn-danger" type="button" data-toggle="tooltip" title=""><i class="fa fa-times"></i></a>
													 <?php } ?>  
                                                </div>
                                            </td>
											<?php } ?>
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

    </div>
</div>



<script>
  $(function() {
    $( "#datepicker" ).datepicker();
    $( "#datepicker1" ).datepicker();
  });
  </script>


<script>
	$('form').attr('autocomplete', 'off');
	</script>