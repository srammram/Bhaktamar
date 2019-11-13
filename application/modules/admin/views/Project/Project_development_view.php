<link rel="stylesheet" href="<?php echo base_url('assets/admin/plugins/daterangepicker/daterangepicker.css')?>">
<link href="<?php echo base_url('assets/admin/plugins/iCheck/all.css')?>" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url('assets/admin/') ?>/plugins/datepicker/datepicker3.css"> 
<style>
.error{
    color: #FF0000;
}
#gender-error{
width:200px;
padding-top:15px;
}
.prj_estimation_plan .control-label{margin-top: 5px;padding: 0px;}
	.prj_estimation_plan .form-control{border-radius: 0px;}
	.well{background-color: #fff;    border-top: 2px solid #e3e3e3;}
	.title_sec h3{color: #19210b;font-weight: normal;margin-bottom: 25px;}
	.btn_tas_se{margin: 0px;padding: 0px;list-style-type: none;}
	.btn_tas_se li{display: inline-block;padding: 0px 0px 0px;margin-bottom: 5px;}
	.btn_tas_se .btn-group .btn-success{background: #23b882;}
	.btn_tas_se .btn-group .btn-default{border-color: #23b882;color: #23b882;font-size: 14px;}
	.circle_btn_s{border-radius: 15px;color: #fff;background-color: #23b882;border: none;padding: 4px 8px;}
	.circle_btn_s:hover,.circle_btn_s:focus,.circle_btn_s:active:hover{outline: none;box-shadow: none;background-color: #23b882;border: none;}
	.circle_btn_s .glyphicon-plus{font-size: 12px;}
	.prj_estimation_plan  select{width: 100%;}
	.prj_estimation_plan .panel-footer{background-color: transparent;padding:15px 0px 0px;}
	.prj_estimation_plan  .panel-footer .btn_tas_se li{margin-bottom: 0px;}
	.prj_estimation_plan .panel-default>.panel-heading{
		color: #fff;
    	background-color: #939cab;
    	border-color: #939cab;
	}
	.prj_estimation_plan .panel-default{border-color: #ddd;}
	.btn_tas_se li h3{margin:0px;}
	.well{margin-bottom:0px;}
	.table_res .table tbody tr td input,.table_res .table tbody tr td{border:none;}
</style>         

  <?php  $seg= $this->uri->segment(4);?>
<section class="content-header">
          <h1>
            <?php echo $page_title; ?>
           </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
			<li><a href="<?php echo site_url('admin/Project') ?>"> <?php echo lang('Project')?> </a></li>
            <li class="active"><?php echo (empty($seg))?lang('add'):lang('edit');?></li>
          </ol>
</section>
<section class="prj_estimation_plan" style="padding: 30px 0px;background: #ecf0f5;">
	<input type="hidden"value="<?php echo $id; ?>" name="id"> 
		<div class="well col-sm-12">
			<div class="row">
				<div class="col-sm-12 col-xs-12">
					<div class="form-group col-sm-4">
						<label class="control-label col-sm-4"><?php echo lang('Project')?></label>
						<div class="col-sm-8">
							
							<?php  if(isset($projects)){ foreach($projects as $project){  ?>
								<?php  if(isset($project_id)){ echo $project_id == $project->id ?$project->Name:'' ;  } ?>  
							<?php  }  }  ?>
							</select>
						</div>
					</div>
			
					<div class="form-group col-sm-4">
						<label class="control-label col-sm-4"><?php echo lang('ProjectStages')?></label>
						<div class="col-sm-8">
							<?php   if(isset($Project_Stages)){  foreach($Project_Stages as $Pstages){  ?>
							<option value="<?php echo  $Pstages->id; ?>"><?php echo $Pstages->Name;  ?></option>
							<?php   } } ?>
						</div>
					</div>
				</div>
				<div class="col-sm-12">
					<ul class="btn_tas_se">
						<li><h3><?php echo lang('Task_list')?></h3></li>
					</ul>
				</div>
			</div>
			<div class="row">
			<?php   	if(isset($TaskLists)){  foreach($TaskLists as $TaskList){  ?>
				<div class="col-sm-10 col-sm-offset-right-2">
				<input type="hidden" value="<?php  echo $TaskList->taskId ;  ?>" name="taskid[]">
					<h3>Task <?php  echo $TaskList->taskId ;  ?></h3>
					<div class="table_res">
						<table class="table table-bordered">
							<tbody>
							<tr>
									<td colspan="2"><?php echo lang('Task_Name')?> :</td>
									<td colspan="2"><?php  echo   $TaskList->TaskName  ?></td>
								</tr>
								<tr>
									<td colspan="2"><b><?php echo lang('Estimated_cost')?> </b></td>
									<td colspan="2"><b><?php echo lang('Actual_cost')?> </b></td>
								</tr>
								<tr>
									<td colspan="2">  <?php  echo   $TaskList->Cost  ?></td>
									<td colspan="2"> <?php  echo   $TaskList->Actual_cost  ?></td>
								</tr>
								<tr>
									<td colspan="2"><b><?php echo lang('Estimated_labour')?> </b></td>
									<td colspan="2"><b><?php echo lang('Actual_Labour')?></b></td>
								</tr>
									<?php   if(isset($TaskwiseLabourlists)){ foreach($TaskwiseLabourlists as $TaskwiseLabourlist){  if($TaskwiseLabourlist->Task_id == $TaskList->taskId) { ?>
								<tr>
									<td><?php echo lang('labour')?>  :
                         <br>
                            <?php  if(!empty($Laboutypes)){ foreach($Laboutypes  as $Laboutype){
?>
                                <?php  if(isset($TaskwiseLabourlist->LabourTypeId)){ echo $TaskwiseLabourlist->LabourTypeId == $Laboutype->id ?$Laboutype->Name:'' ;  } ?>
                                        <?php  } }?>
                                  </td>
									<td><?php echo lang('NoOfPersons')?>  :<br><?php  echo $TaskwiseLabourlist->NoOfPerson;  ?></td>
									
									<td><?php echo lang('labour')?>  :
                            <br>
                            <?php  if(!empty($Laboutypes)){ foreach($Laboutypes  as $Laboutype){
?>
                                <?php  if(isset($TaskwiseLabourlist->Actual_labourTypeid)){ echo $TaskwiseLabourlist->Actual_labourTypeid == $Laboutype->id ?$Laboutype->Name:'' ;  } ?> 
                                   
                                        <?php  } }?>
                                  </td>
									<td><?php echo lang('NoOfPersons')?>  :<br> <?php  echo $TaskwiseLabourlist->Actual_NoOfPerson;  ?></td>
								</tr>
									<?php } } }   ?>
								<tr>
									<td colspan="3"><b><?php echo lang('Estimated_Material')?> </b></td>
									<td colspan="2"><b><?php echo lang('Actual_Material')?> </b></td>
								</tr>
								<?php   if(!empty($TaskwiseMateriallists)){ foreach($TaskwiseMateriallists as $TaskwiseMateriallist){  if($TaskwiseMateriallist->taskId == $TaskList->taskId) { ?>
								  
								<tr>
									<td><?php echo lang('Material')?>  : <br>
                            <?php  if(!empty($Materials)){ foreach($Materials  as $Material){
?>
                                <?php  if(isset($TaskwiseMateriallist->MaterialTypeid)){ echo $TaskwiseMateriallist->MaterialTypeid == $Material->id ?$Material->Name:'' ;  } ?>
                                   
                                        <?php  } }?>
                                     </td>
									<td><?php echo lang('Qty')?>  :<br> <?php  echo $TaskwiseMateriallist->Qty;  ?></td>
									<td><?php echo lang('UOM')?> : <?php  if(!empty($Uoms)){ foreach($Uoms  as $Uom){?> <?php  if(isset($TaskwiseMateriallist->UOMId)){ echo $TaskwiseMateriallist->UOMId == $Uom->id ?$Uom->Name:'' ;  } ?>
                                <?php  } }?>
                        </td>
									<td><?php echo lang('Material')?><br> 
                            <?php  if(!empty($Materials)){ foreach($Materials  as $Material){
?>
                                 <?php  if(isset($TaskwiseMateriallist->Actual_materialId)){ echo $TaskwiseMateriallist->Actual_materialId == $Material->id ?$Material->Name:'' ;  } ?>
                                        <?php  } }?>
                                   </td>
									<td><?php echo lang('Qty')?><br> <?php  echo $TaskwiseMateriallist->Actual_qty;  ?> </td>
									<td><?php echo lang('UOM')?><br> <?php  if(!empty($Uoms)){ foreach($Uoms  as $Uom){?> <?php  if(isset($TaskwiseMateriallist->Actual_uom)){ echo $TaskwiseMateriallist->Actual_uom == $Uom->id ?$Uom->Name:'' ;  } ?>
                                <?php  } }?>
                         </td>
								</tr>
								<tr>
									<td colspan="2"><b><?php echo lang('Estimated_Time')?></b></td>
									<td colspan="2"><b><?php echo lang('Actual_Time')?> </b></td>
								</tr>
								<tr>
									<td ><?php echo lang('time_period')?>  :<br><?php  echo   $TaskList->TimePeriod  ?></td>
									<td ><br> <?php  if(isset($TaskList->TimePeriodType)){ echo $TaskList->TimePeriodType == lang('Days')  ?lang('Days'):'' ;  } ?>
                            </option>
                            <?php  if(isset($TaskList->TimePeriodType)){ echo $TaskList->TimePeriodType == lang('Week')  ?lang('Week'):'' ;  } ?>
                            
                          <?php  if(isset($TaskList->TimePeriodType)){ echo $TaskList->TimePeriodType == lang('Month')  ?lang('Month'):'' ;  } ?>
                                
                          
                        </select></td>
						<td ><?php echo lang('time_period')?> <br><?php  echo   $TaskList->ActualTimePeriod  ?></td>
						<td ><br>
                          <?php  if(isset($TaskList->ActualTimePeriodType)){ echo $TaskList->ActualTimePeriodType == lang('Days')  ?lang('Days'):'' ;  } ?>
                        <?php  if(isset($TaskList->ActualTimePeriodType)){ echo $TaskList->ActualTimePeriodType == lang('Week')  ?lang('Week'):'' ;  } ?>                       <?php  if(isset($TaskList->ActualTimePeriodType)){ echo $TaskList->ActualTimePeriodType == lang('Month')  ?lang('Month'):'' ;  } ?>
                           </td>
								</tr>
								<?php   }  }  }  ?>
							</tbody>
						</table>
					</div>
				</div>
			<?php   }   }  ?>
			</div>
			
			<div class="row">

					
						  <div class="col-sm-6 col-sm-offset-6 col-xs-12">
					<div class="table_res">
						<table class="table">
							<tbody>
								<tr>
									<td><strong></strong></td>
									<td><strong><?php echo lang('Estimated')?></strong></td>
									<td><strong><?php echo lang('Actual')?></strong></td>
									<td><strong><?php echo lang('Overlay')?></strong></td>
								</tr>
								<tr>
									<td><strong><?php echo lang('Total_cost')?></strong></td>
									<td><strong class="totalestimatecost"><?php if(isset($TotalEstimateCost)){ echo $TotalEstimateCost ;  }  ?></strong></td>
									<td><strong><input type="text" class="Totalcost" name="Totalcost"readonly value="<?php if(isset($Estimationplan->ActualCost)){ echo $Estimationplan->ActualCost ;  }  ?>"></strong></td>
									<td><strong><input type="text" class="Overlaycost" name="Overlaycost"readonly value="<?php if(isset($Estimationplan->ActualCost)){ echo $Estimationplan->ActualCost ;  }  ?>"></strong></td>
								</tr>
								<tr>
									<td><strong ><?php echo lang('Total_Labaour')?></strong></td>
									<td><strong class="totalestimatelabour"><?php if(isset($TotalEstimateLabour)){ echo $TotalEstimateLabour;  }  ?></strong></td>
									<td><strong><input type="text" class="Totallabour"name="Totallabour"readonly  value="<?php if(isset($Estimationplan->ActualLabour)){ echo $Estimationplan->ActualLabour;  }  ?>"></strong></td>
									<td><strong><input type="text" class="Overlaylabour"name="Overlaylabour"readonly  value="<?php if(isset($Estimationplan->ActualLabour)){ echo $Estimationplan->ActualLabour;  }  ?>"></strong></td>
								</tr>
								<tr>
									<td><strong ><?php echo lang('Total_TimePeriod')?></strong></td>
									<td><strong class="totalestimateTime"><?php if(isset($TotalEstimateTime)){ echo $TotalEstimateTime;  }  ?></strong></td>
									<td><strong><input type="text" class="Totaltimeperiod" name="Totaltimeperiod"readonly value="<?php if(isset($Estimationplan->ActualTime)){ echo $Estimationplan->ActualTime;  }  ?>"></strong></td>
									<td><strong><input type="text" class="Overlayperiod" name="Overlayperiod"readonly value="<?php if(isset($Estimationplan->ActualTime)){ echo $Estimationplan->ActualTime;  }  ?>"></strong></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
					
				</div>
			</div>
		</div>	
	</div>
		
        </section>


</script>