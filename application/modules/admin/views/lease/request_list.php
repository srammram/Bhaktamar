<?php defined('BASEPATH') or exit('No direct script access allowed');?>
<link rel="stylesheet" href="<?php echo base_url('assets/admin') ?>/dist/css/building_home.css">
<link rel="stylesheet" href="<?php echo base_url('assets/admin') ?>/dist/css/chosen.min.css">
 <script src="<?php echo base_url('assets/admin') ?>/dist/js/chosen.jquery.min.js"></script>
<script>
$(document).ready(function() {
    oTable = $('.requestlisttable').dataTable({
        "aaSorting": [
            [0, "asc"]
        ],
        "aLengthMenu": [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "<?=lang('all')?>"]
        ],
        "iDisplayLength": 10,
        'bProcessing': true,
        'bServerSide': true,
        'sAjaxSource': "<?php echo base_url() ?>" + 'admin/Lease/get_unitRequest',
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
        }, null, null, null, null, null,null,null,null, {
            "bSortable": false
        }]
    });
});

</script>
<div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="icon-layers"></i>Unit Request</h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="#">Dashboard</a></li>
                <li class="active">Unit Request</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
    <div class="row">
       <div class="col-md-12">
        <div class="col-md-3">
            <div class="white-box bg-inverse p-t-10 p-b-10">
                <h3 class="box-title text-white">Total Request</h3>
                <ul class="list-inline two-part">
                    <li><i class="fa fa-shopping-bag text-white"></i></li>
                    <li class="text-right"><span id="totalProjects" class="counter text-white">
					<?php $resident = $this->db->get_where('resident', array('soft_deleted' => 0))->result(); if (!empty($resident)) {echo count($resident);} else {echo 0;} ?></span></li>
                </ul>
            </div>
        </div>

        <div class="col-md-3">
            <div class="white-box bg-success p-t-10 p-b-10">
                <h3 class="box-title text-white">Closed Request</h3>
                <ul class="list-inline two-part">
                    <li><i class="fa fa-shopping-bag text-white"></i></li>
                    <li class="text-right"><span id="completedProjects" class="counter text-white">
					<?php $resident = $this->db->get_where('resident', array('occupy_status' => lang('temporary'),'soft_deleted' => 0))->result();if (!empty($resident)) {echo count($resident);} else {echo 0;} ?>
					</span></li>
                </ul>
            </div>
        </div>

        <div class="col-md-3">
            <div class="white-box p-t-10 p-b-10 bg-info">
                <h3 class="box-title text-white">In Progress Request</h3>
                <ul class="list-inline two-part">
                    <li><i class="fa fa-shopping-bag text-white"></i></li>
                    <li class="text-right"><span id="inProcessProjects" class="counter text-white">
						<?php $resident = $this->db->get_where('resident', array('occupy_status' => lang('permanent'),'soft_deleted' => 0))->result(); if (!empty($resident)) {echo count($resident);} else {echo 0;} ?>
					</span></li>
                </ul>
            </div>
        </div>

        <div class="col-md-3">
            <div class="white-box p-t-10 p-b-10 bg-danger">
                <h3 class="box-title text-white">Lease Request</h3>
                <ul class="list-inline two-part">
                    <li><i class="fa fa-shopping-bag text-white"></i></li>
                    <li class="text-right"><span id="overdueProjects" class="counter text-white">
					<?php $resident = $this->db->get_where('resident', array('occupy_status' =>lang('inactive'),'soft_deleted' => 0))->result();
							if (!empty($resident)) {echo count($resident);} else {echo 0;}
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
						<!--<a href="<?php echo base_url('admin/Resident/form'); ?>" class="btn btn-outline btn-success btn-sm">Add New Resident <i class="fa fa-plus" aria-hidden="true"></i></a>-->
					</div>
				</div>
			</div>
			<!--<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<label class="control-label">Projects</label>
						<select class="form-control chosen" id="projects">
							<option selected="" value="all">All</option>
                            <?php if(!empty($project)){    foreach($project as $row){   ?>
                            <option value="<?php  echo $row->id ; ?>"><?php  echo $row->Name ; ?></option>
                        
                        <?php   }}   ?>
						</select>
					</div>
                </div>
            <!--    <div class="col-md-3">
					<div class="form-group">
						<label class="control-label">Buildings</label>
						<select class="form-control chosen" id="buildings">
							<option selected="" value="all">All</option>
                            <?php if(!empty($buildings)){    foreach($buildings as $row){   ?>
                            <option value="<?php  echo $row->bldid ; ?>"><?php  echo $row->name ; ?></option>
                        
                        <?php   }}   ?>
						</select>
					</div>
                </div>
                <div class="col-md-3">
					<div class="form-group">
						<label class="control-label">Floors</label>
						<select class="form-control chosen" id="floors">
							<option selected="" value="all">All</option>
                            <?php if(!empty($floors)){    foreach($floors as $row){   ?>
                            <option value="<?php  echo $row->id ; ?>"><?php  echo $row->name ; ?></option>
                        
                        <?php   }}   ?>
						</select>
					</div>
                </div>
                <div class="col-md-3">
					<div class="form-group">
						<label class="control-label">Units</label>
						<select class="form-control chosen" id="units">
								<option selected="" value="all">All</option>
                            <?php if(!empty($units)){    foreach($units as $row){   ?>
                            <option value="<?php  echo $row->uid ; ?>"><?php  echo $row->unit_name ; ?></option>
                        
                        <?php   }}   ?>
						</select>
					</div>
                </div>
                <div class="col-md-3">
					<div class="form-group">
						<label class="control-label">Owners</label>
						<select class="form-control chosen" id="owner">
								<option selected="" value="all">All</option>
                            <?php if(!empty($owners)){    foreach($owners as $row){   ?>
                            <option value="<?php  echo $row->ownid ; ?>"><?php  echo $row->full_name ; ?></option>
                        
                        <?php   }}   ?>
						</select>
					</div>
				</div>-->
			<div class="table-responsives">
				<div id="project-table_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
					<div class="row">
						<div class="col-sm-12">
                            <table  class="table table-bordered table-hover table-striped reports-table requestlisttable">
                                <thead>
                                <tr>
                                        <th><?php  echo lang("id");?></th>
                                        <th><?php echo lang('project'); ?></th>
                                        <th><?php echo lang('building'); ?></th>
                                        <th><?php echo lang('Floors'); ?></th>
                                        <th><?php echo lang('unit'); ?></th>
                                        <th><?php echo lang('date'); ?></th>
                                        <th><?php echo lang('title'); ?></th>
										<th><?php echo lang('requesttype'); ?></th>
										<th><?php echo lang('status'); ?></th>
										<th><?php echo lang('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="9" class="dataTables_empty">
                                            <?=lang('loading_data_from_server')?>
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
<script type="text/javascript" src="<?php echo base_url('assets/admin') ?>/dist/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/admin') ?>/dist/js/jquery.dataTables.dtFilter.min.js">
</script>
<script>
   
</script>