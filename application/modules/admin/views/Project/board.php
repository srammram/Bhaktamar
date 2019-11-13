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
        'sAjaxSource': "<?php echo  base_url()  ?>" + 'admin/Project/gettask/<?php echo $project_id;  ?>',
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
<style>
		.tabs-left {
			border-bottom: none;
		}

		.tabs-left>li {
			float: none;
			margin:0px;
		}

		.tabs-left>li.active>a,
		.tabs-left>li.active>a:hover,
		.tabs-left>li.active>a:focus {
		border-bottom-color: #ddd;
		border-right-color: transparent;
		background:#37bc9b;
		border:none;
		border-radius:0px;
		margin:0px;
		}
		.nav-tabs>li>a:hover {
		/* margin-right: 2px; */
		line-height: 1.42857143;
		border: 1px solid transparent;
		/* border-radius: 4px 4px 0 0; */
		}
		.tabs-left>li.active>a::after{content: "";
		position: absolute;
		top: 10px;
		right: -10px;
		border-top: 10px solid transparent;
		border-bottom: 10px solid transparent;

		border-left: 10px solid #37bc9b;
		display: block;
		width: 0;}
		body{background-color: #efefef;}
		.vertical_tab{padding: 20px;}
		.tab-content{
		margin-left: 20px;
		background-color: #fff;
		padding: 20px;
		}
		.nav-tabs>li>a{border-bottom: 1px solid #efefef;}
	</style>
 <section class="content-header">
     <h4>
         <?php echo $page_title; ?>
     </h4>
     <ol class="breadcrumb">
         <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i>
                 <?php echo lang('dashboard') ?></a></li>
         <li><a href="<?php echo site_url('admin/Project') ?>"><?php echo lang('Project') ?></a></li>
         <li class="active"><?php echo lang('view') ?> <?php echo lang('Project') ?></li>
     </ol>
 </section>
 
 <section class="vertical_tab">
 	<div class="container">
 		<div class="row">
 			<div class="col-sm-2" style="background-color: #fff;padding: 0px;"> <!-- required for floating -->
          <!-- Nav tabs -->
          <ul class="nav nav-tabs tabs-left sideways">
            <li class="active"><a href="#project" data-toggle="tab">Project Details</a></li>
			 <li><a href="#tasks" data-toggle="tab">Tasks</a></li>
			  <li><a href="#gantt" data-toggle="tab">Gantt View</a></li>
			          <!-- <li><a href="#Measurements" data-toggle="tab">Measurements</a></li>
			   <li><a href="#attachment" data-toggle="tab">Attachment</a></li>
            <li><a href="#comments" data-toggle="tab">Comments</a></li>
            <li><a href="#Members" data-toggle="tab">Members</a></li>-->
           
          </ul>
        </div>

        <div class="col-sm-9">
          <!-- Tab panes -->
          <div class="tab-content">
            <div class="tab-pane active" id="project">
			     <div class="row">
                     <div class="col-xs-12">
                        <div class="box">
                           <div class="box-body">
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-6">
                                       <label><?php echo lang('Name') ?> </label>
                                   <br>
                                       <?php if (!empty($project->Name)) {echo $project->Name;}?>
                                    </div>
                                    <div class="col-md-6">
                                       <label><?php echo lang('developer') ?></label>
									   <br>
                                       <?php if (!empty($project->developer)) {echo $project->developer;}?>
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-6">
                                       <label><?php echo lang('ProjectType') ?></label>
                                   <br>
                                       <?php if (!empty($projecttype)) {foreach ($projecttype as $propertytypes) {?>
                                       <?php if (!empty($project->project_type)) {echo $project->project_type == $propertytypes->id ? $propertytypes->ProjectType : '';}?>
                                       <?php }}?>
                                    </div>
                                    <div class="col-md-6">
                                       <label><?php echo lang('Start_date') ?> </label>
                                   <br>
                                       <?php if (!empty($project->start_date)) {echo $project->start_date;}?>
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                     <div class="col-md-6">
                                       <label><?php echo lang('complete_date') ?></label>
                                   <br>
                                       <?php if (!empty($project->project_completion_date)) {echo $project->project_completion_date;}?>
                                    </div>
                                    <div class="col-md-6">
                                       <label><?php echo lang('Project_area') ?> (Sqm) </label>
                                 <br>
                                       <?php if (!empty($project->Project_area)) {echo $project->Project_area;}?>
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-6">
                                       <label><?php echo lang('shared_public_area') ?> (Sqm)</label>
                                   <br>
                                       <?php if (!empty($project->shared_public_area)) {echo $project->shared_public_area;}?>
                                    </div>
                                  <div class="col-md-6">
                                       <label><?php echo lang('Planned_floors') ?></label>
                                                                      <br>
                                       <?php if (!empty($project->planned_floors)) {echo $project->planned_floors;}?>
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                   <div class="col-md-6">
                                       <label><?php echo lang('Planned_unit') ?></label>
                                                                     <br>
                                       <?php if (!empty($project->planned_units)) {echo $project->planned_units;}?>
                                    </div>
                                   <div class="col-md-6">
                                       <label><?php echo lang('Legal_description') ?></label>
                                                                      <br>
                                       <?php if (!empty($project->legal_descrioption)) {echo $project->legal_descrioption;}?>
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                     <div class="col-md-6">
                                       <label><?php echo lang('legal_document') ?></label>
                                                                       <br>
                                       <?php if (!empty($project->legal_document)) {foreach (json_decode($project->legal_document) as $doc) {
                                          if (!empty($doc)) {?>
                                       <a style="margin-left:12px;"
                                          href="<?php echo site_url('admin/Project/download_otherdoc/' . $doc) ?>"
                                          class="btn btn-xs btn-danger">
                                       <i class="glyphicon glyphicon-download-alt"></i><?php echo $doc; ?></a>
                                       <br>
                                       <?php }}}?>
                                    </div>
                                    <div class="col-md-6">
                                       <label><?php echo lang('Current_status') ?></label>
                                                                      <br>
                                       <?php if (isset($project->project_status)) {echo $project->project_status == lang('Yet') ? lang('Yet') : '';}?>
                                       <?php if (isset($project->project_status)) {echo $project->project_status == lang('Ongoing') ? lang('Ongoing') : '';}?>
                                       <?php if (isset($project->project_status)) {echo $project->project_status == lang('Completed') ? lang('Completed') : '';}?>
                                       <?php if (isset($project->project_status)) {echo $project->project_status == lang('OnHold') ? lang('OnHold') : '';}?>
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-6">
                                       <label><?php echo lang('facilities') ?></label>
                                                                      <br>
                                       <?php if (!empty($facilities)) {foreach ($facilities as $item) {echo $selected = in_array($item->Fac_id, json_decode($project->facilites)) ? $item->Facility_name . '<br>' : '';?>
                                       <?php }}?>
                                    </div>
                                     <div class="col-md-6">
                                       <label><?php echo lang('add_contractors') ?></label>
                                                                      <br>
                                       <?php if (!empty($project->contractors)) {foreach ($contractor as $item) {$selected = in_array($item->contractor_id, json_decode($project->contractors)) ? ' selected="selected" ' : '';?>
                                       <option value="<?php echo $item->contractor_id ?>" <?php echo $selected; ?>>
                                          <?php echo $item->con_Name ?>
                                       </option>
                                       <?php }}?>
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-6">
                                       <label><?php echo lang('Project_start_date') ?></label>
                                                                      <br>
                                       <?php if (!empty($project->pm_contract_start_date)) {echo $project->pm_contract_start_date;}?>
                                    </div>
                                    <div class="col-md-6">
                                       <label><?php echo lang('pm_contract_duration') ?></label>
                                       <br>            
                                       <?php if (!empty($project->pm_contract_duration)) {echo $project->pm_contract_duration;}?>
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-6">
                                       <label><?php echo lang('vendor_Name') ?></label>
                                       <br>
                                       <?php if (!empty($vendor)) {foreach ($vendor as $item) {echo $selected = in_array($item->service_provider_id, json_decode($project->vendor)) ? $item->sp_name : '';?>
                                       <?php }}?>
                                    </div>
                                   <div class="col-md-6">
                                       <label><?php echo lang('address') ?></label>
                                      <br>
                                       <?php if (!empty($project->address)) {echo $project->address;}?>
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                     <div class="col-md-6">
                                       <label><?php echo lang('PM_information') ?></label>
                                                                     <br>
                                       <?php if (!empty($project->pm_information)) {echo $project->pm_information;}?>
                                    </div>
                                    <div class="col-md-6">
                                       <label><?php echo lang('emergency_contact') ?></label>
                                                                      <br>
                                       <?php if (!empty($project->emergency_contact)) {echo $project->emergency_contact;}?>
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-6">
                                       <label><?php echo lang('HandBook') ?></label>
                                    </div>
                                    <div class="col-md-3">
                                       <?php if (!empty($project->attachment)) {?><a style="margin-left:12px;"
                                          href="<?php echo site_url('admin/Project/download_Attachment/' . $project->attachment) ?>"
                                          class="btn btn-xs btn-danger"><i
                                          class="glyphicon glyphicon-download-alt"></i><?php echo $project->attachment; ?></a>
                                       <?php }?>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
			
			
			
			
			</div>
            <div class="tab-pane" id="Measurements"> <div class="row">
                     <div class="col-xs-12">
                        <div class="box">
                           <div class="box-body">
                              <div class="row">
                                 <?php   if(!empty($buildings)){ foreach($buildings as $building){ ?>
                                 <div class="col-sm-12 table_sec_h">
                                    <table class="table table_se" cellpadding="0" cellspacing="0">
                                       <tbody>
                                          <tr>
                                             <td>
                                                <table class="table " cellpadding="0" cellspacing="0">
                                                   <tr>
                                                      <td style="border: 1px solid #ddd!important;">
                                                                  Building Name: <?php   echo  $building->name;  ?>
                                                      </td>
                                                      <td style="border: 1px solid #ddd!important;">
                                                                  Planned Area: <?php   echo  $building->total_area;  ?> sqm
                                                      </td>
                                                      <td style="border: 1px solid #ddd!important;">
                                                                  Planned shared Area:<?php   echo  $building->shared_public_area;  ?> sqm
                                                      </td>
                                                   </tr>
                                                </table>
                                             </td>
                                          </tr>
                                          <?php    if(!empty(getBuildingWisefloor($project_id,$building->bldid))){ foreach(getBuildingWisefloor($project_id,$building->bldid) as $floor){
                                             ?>
                                          <tr>
                                             <td>
                                                <table class="table" cellpadding="0" cellspacing="0">
                                                   <tr>
                                                      <td>
                                                         <table class="table" cellpadding="0" cellspacing="0" style="table-layout: fixed;border:1px solid #fff;">
                                                            <tr>
                                                               <td style="border: 1px solid #ddd!important;">
                                                                           floor Name: <?php   echo  $floor->name;  ?>
                                                               </td>
                                                               <td style="border: 1px solid #ddd!important;">
                                                                           Planned  Area:
                                                                       <?php   echo  $floor->gross_area;  ?> sft
                                                               </td>
                                                               <td style="border: 1px solid #ddd!important;">
                                                                           Planned shared Area:
                                                                      <?php   echo  $floor->shared_area;  ?> sft
                                                               </td>
                                                            </tr>
                                                         </table>
                                                      </td>
                                                   </tr>
                                                   <tr>
                                                      <td>
                                                         <table class="table table-bordered" cellpadding="0" cellspacing="0" style="table-layout: fixed;">
                                                            <thead>
                                                               <tr>
                                                                  <th>Unit Name</th>
                                                                  <th>Area</th>
                                                                  <th>Public Area</th>
                                                               </tr>
                                                            </thead>
                                                            <tbody>
                                                               <?php    if(!empty(getBuildingWiseunit($project_id,$building->bldid))){ foreach(getBuildingWiseunit($project_id,$building->bldid) as $unit){
                                                                  ?>
                                                               <tr>
                                                                  <td><?php echo $unit->unit_no  ?></td>
                                                                  <td><?php echo $unit->size  ?> sft</td>
                                                                  <td><?php echo $unit->insideunit  ?> sft</td>
                                                               </tr>
                                                               <?php    }  }?>
                                                            </tbody>
                                                         </table>
                                                      </td>
                                                   </tr>
                                                   <tr>
                                                      <td>
                                                         <table class="table table-bordered" cellpadding="0" cellspacing="0" style="table-layout: fixed;">
                                                            <tr>
                                                               <td><b>Floor Total Area</b></td>
                                                               <td><b><?php   echo  $floor->gross_area;  ?> sft</b></td>
                                                               <td><b><?php   echo  $floor->shared_area;  ?> sft</b></td>
                                                            </tr>
                                                         </table>
                                                      </td>
                                                   </tr>
                                                </table>
                                             </td>
                                          </tr>
                                          <?php  } }  ?>
                                       </tbody>
                                       <tfoot>
                                          <tr>
                                             <td>
                                                <table class="table table-bordered" cellpadding="0" cellspacing="0" style="table-layout: fixed;">
                                                   <tr>
                                                      <td><b>Building Total Area</b></td>
                                                      <td><b><?php   echo  $building->total_area;  ?> sqm</b></td>
                                                      <td><b><?php   echo  $building->shared_public_area;  ?> sqm</b></td>
                                                   </tr>
                                                </table>
                                             </td>
                                          </tr>
                                       </tfoot>
                                    </table>
                                 </div>
                                 <?php   } } ?>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            <div class="tab-pane" id="comments">comments Tab.</div>
            <div class="tab-pane" id="attachment">attachment Tab.</div>
            <div class="tab-pane" id="Members">Members Tab.</div>
            <div class="tab-pane" id="tasks">
			
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
            <div class="tab-pane" id="bugs">bugs Tab.</div>
            <div class="tab-pane" id="gantt">gantt Tab.</div>
          </div>
        </div>
 		</div>
 	</div>
 </section>
	

<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/jquery.dataTables.dtFilter.min.js">
 <script src="<?php echo base_url('assets/admin/plugins/daterangepicker/daterangepicker.js') ?>"></script>
 <script src="<?php echo base_url('assets/admin/plugins/iCheck/icheck.min.js') ?>" type="text/javascript"></script>
 <script src="<?php echo base_url('assets/admin/') ?>/plugins/datepicker/bootstrap-datepicker.js"></script>
 <script src="<?php echo base_url('assets/admin/plugins') ?>/jquery-validation/jquery.validate.min.js"></script>