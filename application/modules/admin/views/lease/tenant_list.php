<?php defined('BASEPATH') or exit('No direct script access allowed');?>
<link rel="stylesheet" href="<?php echo base_url('assets/admin') ?>/dist/css/building_home.css">
<link rel="stylesheet" href="<?php echo base_url('assets/admin') ?>/dist/css/chosen.min.css">
 <script src="<?php echo base_url('assets/admin') ?>/dist/js/chosen.jquery.min.js"></script>
<script>$(document).ready(function() {
    oTable = $('.residenttable').dataTable({
        "aaSorting": [
            [1, "asc"]
        ],
        "aLengthMenu": [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "<?=lang('all')?>"]
        ],
        "iDisplayLength": 10,
        'bProcessing': true,
        'bServerSide': true,
        'sAjaxSource': "<?php echo base_url() ?>" + 'admin/Resident/get_resident',
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
            "bSortable": false
        }]
    });
});

</script>

<div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="icon-layers"></i> Resident</h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Resident</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
    <div class="row">
       <div class="col-md-12">
        <div class="col-md-3">
            <div class="white-box bg-inverse p-t-10 p-b-10">
                <h3 class="box-title text-white">Total Resident</h3>
                <ul class="list-inline two-part">
                    <li><i class="fa fa-shopping-bag text-white"></i></li>
                    <li class="text-right"><span id="totalProjects" class="counter text-white">
					<?php $resident = $this->db->get_where('resident', array('soft_deleted' => 0))->result();
if (!empty($resident)) {echo count($resident);} else {echo 0;}
?></span></li>
                </ul>
            </div>
        </div>

        <div class="col-md-3">
            <div class="white-box bg-success p-t-10 p-b-10">
                <h3 class="box-title text-white">Temporary</h3>
                <ul class="list-inline two-part">
                    <li><i class="fa fa-shopping-bag text-white"></i></li>
                    <li class="text-right"><span id="completedProjects" class="counter text-white">
					<?php $resident = $this->db->get_where('resident', array('occupy_status' => lang('temporary'),'soft_deleted' => 0))->result();
if (!empty($resident)) {echo count($resident);} else {echo 0;}
?>
					</span></li>
                </ul>
            </div>
        </div>

        <div class="col-md-3">
            <div class="white-box p-t-10 p-b-10 bg-info">
                <h3 class="box-title text-white">Permanent</h3>
                <ul class="list-inline two-part">
                    <li><i class="fa fa-shopping-bag text-white"></i></li>
                    <li class="text-right"><span id="inProcessProjects" class="counter text-white">
<?php $resident = $this->db->get_where('resident', array('occupy_status' => lang('permanent'),'soft_deleted' => 0))->result();
if (!empty($resident)) {echo count($resident);} else {echo 0;}
?>
					</span></li>
                </ul>
            </div>
        </div>

        <div class="col-md-3">
            <div class="white-box p-t-10 p-b-10 bg-danger">
                <h3 class="box-title text-white">Inactive</h3>
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
						<a href="<?php echo base_url('admin/Resident/form'); ?>" class="btn btn-outline btn-success btn-sm">Add New Resident <i class="fa fa-plus" aria-hidden="true"></i></a>
					</div>
				</div>
			</div>
			<div class="row">
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
                <div class="col-md-3">
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
				</div>
			</div>

			<div class="table-responsives">
				<div id="project-table_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">

					<div class="row">
						<div class="col-sm-12">

                            <table id="UnitTable" class="table table-bordered table-hover table-striped reports-table residenttable">
                                <thead>
                                <tr>
                                        <th><?=lang("id");?></th>
                                        <th><?php echo lang('fullname'); ?></th>
                                        <th><?php echo lang('Project'); ?></th>
                                        <th><?php echo lang('building'); ?></th>
                                        <th><?php echo lang('floor'); ?></th>
                                        <th><?php echo lang('unit'); ?></th>
                                        <th><?php echo lang('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="6" class="dataTables_empty">
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
 function showData() {
	// alert('dfdf');
        /* var status = $('#status').val();
        var clientID = $('#client_id').val();
        var categoryID = $('#category_id').val();

        var searchQuery = "?status="+status+"&client_id="+clientID+"&category_id="+categoryID;
       table = $('#project-table').dataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            destroy: true,
            ajax: 'https://demo.worksuite.biz/admin/projects/data'+searchQuery,
            "order": [[ 0, "desc" ]],
            deferRender: true,
            language: {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/English.json"
            },
            "fnDrawCallback": function( oSettings ) {
                $("body").tooltip({
                    selector: '[data-toggle="tooltip"]'
                });
            },
            columns: [
                { data: 'id', name: 'id' },
                { data: 'project_name', name: 'project_name'},
                { data: 'members', name: 'members' },
                { data: 'deadline', name: 'deadline' },
                { data: 'client_id', name: 'client_id' },
                { data: 'completion_percent', name: 'completion_percent' },
                { data: 'action', name: 'action' }
            ]
        }); */
		 var projects = $('#projects').val();
        var buildings = $('#buildings').val();
        var floors = $('#floors').val();
		var units = $('#units').val();
		var owner = $('#owner').val();
		var searchQuery = "?projects="+projects+"&buildings="+buildings+"&floors="+floors+"&units="+units+"&owner="+owner;
		 oTable = $('.residenttable').dataTable({
			 stateSave: true,
    "bDestroy": true,
        "aaSorting": [
            [1, "asc"]
        ],
        "aLengthMenu": [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "<?=lang('all')?>"]
        ],
        "iDisplayLength": 10,
        'bProcessing': true,
        'bServerSide': true,
        'sAjaxSource': "<?php echo base_url() ?>" + 'admin/Resident/get_residentWithQuery'+searchQuery,
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
            "bSortable": false
        }]
    });
    }

    $('#projects').on('change', function(event) {
        event.preventDefault();
        showData();
    });

    $('#buildings').on('change', function(event) {
        event.preventDefault();
        showData();
    });

    $('#floors').on('change', function(event) {
        event.preventDefault();
        showData();
    });
	 $('#units').on('change', function(event) {
        event.preventDefault();
        showData();
    });
	 $('#units').on('change', function(event) {
        event.preventDefault();
        showData();
    });
</script>