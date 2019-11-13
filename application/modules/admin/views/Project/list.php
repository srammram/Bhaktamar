<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/building_home.css">
<script>
$(document).ready(function() {
    oTable = $('#UnitTable').dataTable({
        "aaSorting": [
            [3, "asc"],
            [1, "asc"]
        ],
        "aLengthMenu": [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "<?= lang('all') ?>"]
        ],
        "iDisplayLength": 10,
        'bProcessing': true,
        'bServerSide': true,
        'sAjaxSource': "<?php echo  base_url()  ?>" + 'admin/Project/getProject',
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
        }, null, null, null, null, null, null, {
            "bSortable": false
        }]
    });
});
</script>

<div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="icon-layers"></i> Project</h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Project</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
    <div class="row">
       <div class="col-md-12">
        <div class="col-md-3">
            <div class="white-box bg-inverse p-t-10 p-b-10">
                <h3 class="box-title text-white">Total Project</h3>
                <ul class="list-inline two-part">
                    <li><i class="fa fa-shopping-bag text-white"></i></li>
                    <li class="text-right"><span id="totalProjects" class="counter text-white">
					<?php  $project=$this->db->get_where('project',array('soft_delete'=>0))->result();
                            if(!empty($project)){  echo count($project) ;}else{ echo 0; }
                    ?></span></li>
                </ul>
            </div>
        </div>

        <div class="col-md-3">
            <div class="white-box bg-success p-t-10 p-b-10">
                <h3 class="box-title text-white">Completed Project</h3>
                <ul class="list-inline two-part">
                    <li><i class="fa fa-shopping-bag text-white"></i></li>
                    <li class="text-right"><span id="completedProjects" class="counter text-white">
					<?php  $project=$this->db->get_where('project',array('project_status'=>lang('Completed'),'soft_delete'=>0))->result();
                        if(!empty($project)){  echo count($project) ;}else{ echo 0; }
                    ?>
					</span></li>
                </ul>
            </div>
        </div>

        <div class="col-md-3">
            <div class="white-box p-t-10 p-b-10 bg-info">
                <h3 class="box-title text-white">In Process Project</h3>
                <ul class="list-inline two-part">
                    <li><i class="fa fa-shopping-bag text-white"></i></li>
                    <li class="text-right"><span id="inProcessProjects" class="counter text-white">
                    <?php  $project=$this->db->get_where('project',array('project_status'=>lang('Ongoing'),'soft_delete'=>0))->result();
                        if(!empty($project)){  echo count($project) ;}else{ echo 0; }
                        ?>
					</span></li>
                </ul>
            </div>
        </div>

        <div class="col-md-3">
            <div class="white-box p-t-10 p-b-10 bg-danger">
                <h3 class="box-title text-white">Overdue Project</h3>
                <ul class="list-inline two-part">
                    <li><i class="fa fa-shopping-bag text-white"></i></li>
                    <li class="text-right"><span id="overdueProjects" class="counter text-white">
					<?php  $project=$this->db->get_where('project',array('project_completion_date<'=>'now()','project_status'=>lang('Ongoing'),'soft_delete'=>0))->result();
                    if(!empty($project)){  echo count($project) ;}else{ echo 0; }
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
						<a href="<?php echo base_url('admin/Project/form'); ?>" class="btn btn-outline btn-success btn-sm">Add New Project <i class="fa fa-plus" aria-hidden="true"></i></a>
						<a href="#" class="btn btn-outline btn-danger btn-sm"><i class="fa fa-bar-chart" aria-hidden="true"></i> Gantt Chart</a>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<label class="control-label">Status</label>
						<select class="form-control">
							<option selected="" value="all">All</option>
							<option value="<?php echo lang('Yet')  ?>"
                                                         <?php  if(isset($project_status)){ echo $project_status == lang('Yet')  ?'selected':'' ;  } ?>>
                                                         <?php echo lang('Yet')  ?></option>
                                                     <option value="<?php echo lang('Ongoing')  ?>"
                                                         <?php  if(isset($project_status)){ echo $project_status == lang('Ongoing') ?'selected':'' ;  } ?>>
                                                         <?php echo lang('Ongoing')  ?></option>
                                                     <option value="<?php echo lang('Completed')  ?>"
                                                         <?php  if(isset($project_status)){ echo $project_status == lang('Completed') ?'selected':'' ;  } ?>>
                                                         <?php echo lang('Completed')  ?></option>
                                                     <option value="<?php echo lang('OnHold')  ?>"
                                                         <?php  if(isset($project_status)){ echo $project_status == lang('OnHold') ?'selected':'' ;  } ?>>
                                                         <?php echo lang('OnHold')  ?></option>
						</select>
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
                                        <th><?php echo lang('Current_status'); ?></th>
                                        <th><?php echo lang('Start_date'); ?></th>
                                        <th><?php echo lang('Project_area'); ?></th>
                                        <th><?php echo lang('planned_floor'); ?></th>
                                        <th><?php echo lang('Planned_unit'); ?></th>
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