<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/building_home.css">
<script>
$(document).ready(function() {
    oTable = $('#UnitTable').dataTable({
        "aaSorting": [
            [0, "desc"]
        ],
        "aLengthMenu": [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "<?= lang('all') ?>"]
        ],
        "iDisplayLength": 10,
        'bProcessing': true,
        'bServerSide': true,
        'sAjaxSource': "<?php echo  base_url()  ?>" + 'admin/Task/gettask',
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
        }, null, null, null, null, null, {
      
        "mRender": function (data, type, full) {
			console.log(full[6]);
				 switch (full[6]) {
                    case ('complete'):
                   var status=   '<span class="btn btn-success btn-sm" style="padding:2px;color:#fff;font-weight:bold;">'+full[6]+'</span>';
                        break;
                    case ('Decline'):
                        var status=   '<span class="btn bg-danger btn-sm" style="padding:2px;color:#fff;font-weight:bold;">'+full[6]+'</span>';
                        break;
                    default:
                         var status=   '<span class="btn bg-inverse btn-sm" style="padding:2px;color:#fff;font-weight:bold;">'+full[6]+'</span>';
                }
		
    return status;
        }}, {
            "bSortable": false
        }]
    });
});
</script>

<div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="icon-layers"></i> Task</h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Task</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
    <div class="row">
       <div class="col-md-12">
        <div class="col-md-3">
            <div class="white-box bg-inverse p-t-10 p-b-10">
                <h3 class="box-title text-white">Total Task</h3>
                <ul class="list-inline two-part">
                    <li><i class="fa fa-shopping-bag text-white"></i></li>
                    <li class="text-right"><span id="totalProjects" class="counter text-white">
					<?php  $task=$this->db->get_where('task',array('soft_delete'=>0))->result();
                            if(!empty($task)){  echo count($task) ;}else{ echo 0; }
                    ?></span></li>
                </ul>
            </div>
        </div>

        <div class="col-md-3">
            <div class="white-box bg-success p-t-10 p-b-10">
                <h3 class="box-title text-white">Completed Task</h3>
                <ul class="list-inline two-part">
                    <li><i class="fa fa-shopping-bag text-white"></i></li>
                    <li class="text-right"><span id="completedProjects" class="counter text-white">
					<?php  $task=$this->db->get_where('task',array('status'=>lang('Completed'),'soft_delete'=>0))->result();
                        if(!empty($task)){  echo count($task) ;}else{ echo 0; }
                    ?>
					</span></li>
                </ul>
            </div>
        </div>

        <div class="col-md-3">
            <div class="white-box p-t-10 p-b-10 bg-info">
                <h3 class="box-title text-white">In Process Task</h3>
                <ul class="list-inline two-part">
                    <li><i class="fa fa-shopping-bag text-white"></i></li>
                    <li class="text-right"><span id="inProcessProjects" class="counter text-white">
                    <?php  $task=$this->db->get_where('task',array('status'=>lang('Ongoing'),'soft_delete'=>0))->result();
                        if(!empty($task)){  echo count($task) ;}else{ echo 0; }
                        ?>
					</span></li>
                </ul>
            </div>
        </div>

        <div class="col-md-3">
            <div class="white-box p-t-10 p-b-10 bg-danger">
                <h3 class="box-title text-white">Overdue Task</h3>
                <ul class="list-inline two-part">
                    <li><i class="fa fa-shopping-bag text-white"></i></li>
                    <li class="text-right"><span id="overdueProjects" class="counter text-white">
					<?php  $task=$this->db->get_where('task',array('due_date<'=>'now()','status'=>lang('Ongoing'),'soft_delete'=>0))->result();
                    if(!empty($task)){  echo count($task) ;}else{ echo 0; }
                        ?>
					</span></li>
                </ul>
            </div>
        </div>
	
       </div>

    </div>
    
<div class="row">
	<div class="col-md-12">
		<div class="white-box">
			<div class="row">
				<div class="col-sm-12">
					<div class="form-group custom-action">
						<a href="<?php echo base_url('admin/Task/form'); ?>" class="btn btn-outline btn-success btn-sm">Add New Task <i class="fa fa-plus" aria-hidden="true"></i></a>
					
					</div>
				</div>
			</div>
			
			<div class="table-responsives">
				<div id="project-table_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
					<div class="row">
						<div class="col-sm-12">
                            <table id="UnitTable" class="table table-bordered table-hover table-striped reports-table">
                                <thead>
                                    <tr>
                                    <th><?= lang("id"); ?></th>
                                        <th><?php echo lang('Name'); ?></th>
                                        <th><?php echo lang('Project'); ?></th>
                                        <th><?php echo lang('Project_stage'); ?></th>
                                        <th><?php echo lang('start_date'); ?></th>
                                        <th><?php echo lang('end_date'); ?></th>
                                        <th><?php echo lang('Status'); ?></th>
                                        <th><?php echo lang('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="6" class="dataTables_empty">
                                            <?= lang('loading_data_from_server') ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
							<div id="project-table_processing" class="dataTables_processing panel panel-default" style="display: none;">Processing...</div>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/jquery.dataTables.dtFilter.min.js">
</script>