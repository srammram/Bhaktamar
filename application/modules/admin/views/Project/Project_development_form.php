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

<form method="post" action="<?php echo site_url('admin/Project/ProjectDevelopmentform/'.$id); ?>" enctype="multipart/form-data" id="estimation">	
	<input type="hidden"value="<?php echo $id; ?>" name="id"> 
		<div class="well col-sm-12">
			<div class="row">
				<div class="col-sm-12 col-xs-12">
					<div class="form-group col-sm-4">
						<label class="control-label col-sm-4"><?php echo lang('Project')?></label>
						<div class="col-sm-8">
							<select class="form-control" name="project" id="project" disabled >
							<option ><?php echo lang('select')?></option>
							<?php  if(isset($projects)){ foreach($projects as $project){  ?>
								<option value="<?php echo  $project->id; ?>"<?php  if(isset($project_id)){ echo $project_id == $project->id ?'selected':'' ;  } ?>  ><?php echo  $project->Name; ?></option>
							<?php  }  }  ?>
							</select>
						</div>
					</div>
			
					<div class="form-group col-sm-4">
						<label class="control-label col-sm-4"><?php echo lang('ProjectStages')?></label>
						<div class="col-sm-8">
							<select class="form-control" name="projectstage" id="projectstage">
							<?php   if(isset($Project_Stages)){  foreach($Project_Stages as $Pstages){  ?>
							<option value="<?php echo  $Pstages->id; ?>"><?php echo $Pstages->Name;  ?></option>
							<?php   } } ?>
							</select>
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
				<input type="hidden" value="<?php  echo $TaskList->id ;  ?>" name="taskid[]">
					<h3>Task <?php  echo $TaskList->taskId ;  ?></h3>
					<div class="table_res">
						<table class="table">
							<tbody>
							<tr>
									<td colspan="2"><?php echo lang('Task_Name')?> :</td>
									<td colspan="2"><input type="text" class="form-control" readonly placeholder="Name"  value="<?php  echo   $TaskList->TaskName  ?>"></td>
								</tr>
								<tr>
									<td colspan="2"><b><?php echo lang('Estimated_cost')?> </b></td>
									<td colspan="2"><b><?php echo lang('Actual_cost')?> </b></td>
								</tr>
								<tr>
									<td colspan="2">  <input type="text" class="form-control  digits"  placeholder="cost" readonly  value="<?php  echo   $TaskList->Cost  ?>"></td>
									<td colspan="2">  <input type="text" class="form-control cost digits" name="cost[]" placeholder="cost"  value="<?php  echo   $TaskList->Actual_cost  ?>"></td>
								</tr>
								<tr>
									<td colspan="2"><b><?php echo lang('Estimated_labour')?> </b></td>
									<td colspan="2"><b><?php echo lang('Actual_Labour')?></b></td>
								</tr>
									<?php   if(isset($TaskwiseLabourlists)){ foreach($TaskwiseLabourlists as $TaskwiseLabourlist){  if($TaskwiseLabourlist->Task_id == $TaskList->taskId) { ?>
								<tr>
								  <input type="hidden" name="Labourtaskid[]" value="<?php  echo $TaskwiseLabourlist->id ;  ?>">
									<td><?php echo lang('labour')?>  :<select class="form-control" disabled >
                            <option>Select</option>
                            <?php  if(!empty($Laboutypes)){ foreach($Laboutypes  as $Laboutype){
?>
                                <option value="<?php echo $Laboutype->id ;  ?>" <?php  if(isset($TaskwiseLabourlist->LabourTypeId)){ echo $TaskwiseLabourlist->LabourTypeId == $Laboutype->id ?'selected':'' ;  } ?> >
                                    <?php echo $Laboutype->Name ;   ?>
                                        <?php  } }?>
                                  </select></td>
									<td><?php echo lang('NoOfPersons')?>  :<br> <input type="text" class="form-control text-center" placeholder="No of Pesons" readonly value="<?php  echo $TaskwiseLabourlist->NoOfPerson;  ?>"></td>
									
									<td><?php echo lang('labour')?>  :<select class="form-control"  name="labourtype[]">
                            <option>Select</option>
                            <?php  if(!empty($Laboutypes)){ foreach($Laboutypes  as $Laboutype){
?>
                                <option value="<?php echo $Laboutype->id ;  ?>" <?php  if(isset($TaskwiseLabourlist->Actual_labourTypeid)){ echo $TaskwiseLabourlist->Actual_labourTypeid == $Laboutype->id ?'selected':'' ;  } ?> >
                                    <?php echo $Laboutype->Name ;   ?>
                                        <?php  } }?>
                                  </select></td>
									<td><?php echo lang('NoOfPersons')?>  :<br> <input type="text" class="form-control text-center nop" placeholder="No of Pesons"  name="noofperson[]" value="<?php  echo $TaskwiseLabourlist->Actual_NoOfPerson;  ?>"></td>
								</tr>
									<?php } } }   ?>
								<tr>
									<td colspan="3"><b><?php echo lang('Estimated_Material')?> </b></td>
									<td colspan="2"><b><?php echo lang('Actual_Material')?> </b></td>
								</tr>
								<?php   if(!empty($TaskwiseMateriallists)){ foreach($TaskwiseMateriallists as $TaskwiseMateriallist){  if($TaskwiseMateriallist->taskId == $TaskList->taskId) { ?>
								  <input type="hidden" name="materialtaskid[]" value="<?php  echo $TaskwiseMateriallist->id ;  ?>">
								<tr>
									<td><?php echo lang('Material')?>  : <select class="form-control" disabled>
                            <option>Select</option>
                            <?php  if(!empty($Materials)){ foreach($Materials  as $Material){
?>
                                <option value="<?php echo $Material->id;  ?>" <?php  if(isset($TaskwiseMateriallist->MaterialTypeid)){ echo $TaskwiseMateriallist->MaterialTypeid == $Material->id ?'selected':'' ;  } ?>>
                                    <?php echo $Material->Name ;  ?>
                                        <?php  } }?>
                                      </select></td>
									<td><?php echo lang('Qty')?>  :<br> <input type="text" class="form-control text-center"   value="<?php  echo $TaskwiseMateriallist->Qty;  ?>" readonly></td>
									<td><?php echo lang('UOM')?> : <select class="form-control"  disabled><option>Select</option><?php  if(!empty($Uoms)){ foreach($Uoms  as $Uom){?><option value="<?php echo $Uom->id ; ?> " <?php  if(isset($TaskwiseMateriallist->UOMId)){ echo $TaskwiseMateriallist->UOMId == $Uom->id ?'selected':'' ;  } ?>>
                            <?php echo $Uom->Name ;   ?>
                                <?php  } }?>
                        </select> </td>
									<td><?php echo lang('Material')?><br> <select class="form-control" name="material[]">
                            <option>Select</option>
                            <?php  if(!empty($Materials)){ foreach($Materials  as $Material){
?>
                                <option value="<?php echo $Material->id;  ?>" <?php  if(isset($TaskwiseMateriallist->Actual_materialId)){ echo $TaskwiseMateriallist->Actual_materialId == $Material->id ?'selected':'' ;  } ?>>
                                    <?php echo $Material->Name ;  ?>
                                        <?php  } }?>
                                      </select> </td>
									<td><?php echo lang('Qty')?><br> <input type="text" class="form-control " name="Qty[]"  value="<?php  echo $TaskwiseMateriallist->Actual_qty;  ?>"> </td>
									<td><?php echo lang('UOM')?><br> <select class="form-control" name="uoms[] "><option>Select</option><?php  if(!empty($Uoms)){ foreach($Uoms  as $Uom){?><option value="<?php echo $Uom->id ; ?> " <?php  if(isset($TaskwiseMateriallist->Actual_uom)){ echo $TaskwiseMateriallist->Actual_uom == $Uom->id ?'selected':'' ;  } ?>>
                            <?php echo $Uom->Name ;   ?>
                                <?php  } }?>
                        </select> </td>
								</tr>
								<tr>
									<td colspan="2"><b><?php echo lang('Estimated_Time')?></b></td>
									<td colspan="2"><b><?php echo lang('Actual_Time')?> </b></td>
								</tr>
								<tr>
									<td ><?php echo lang('time_period')?>  :<br><input type="text" class="form-control " placeholder="10"  value="<?php  echo   $TaskList->TimePeriod  ?>" readonly></td>
									<td ><br> <select class="form-control "  disabled>
                            <option value="<?php  echo lang('Days')   ?>" <?php  if(isset($TaskList->TimePeriodType)){ echo $TaskList->TimePeriodType == lang('Days')  ?'selected':'' ;  } ?>>
                                <?php  echo lang('Days')   ?>
                            </option>
                            <option value="<?php  echo lang('Week')   ?>" <?php  if(isset($TaskList->TimePeriodType)){ echo $TaskList->TimePeriodType == lang('Week')  ?'selected':'' ;  } ?>>
                                <?php  echo lang('Week')   ?>
                            </option>
                            <option value="<?php  echo lang('Month')   ?>" <?php  if(isset($TaskList->TimePeriodType)){ echo $TaskList->TimePeriodType == lang('Month')  ?'selected':'' ;  } ?>>
                                <?php  echo lang('Month')   ?>
                            </option>
                        </select></td>
						<td ><?php echo lang('time_period')?> <br><input type="text" class="form-control timeperiod" placeholder="10" name="timeperiod[]" value="<?php  echo   $TaskList->ActualTimePeriod  ?>"></td>
						<td ><br><select class="form-control " name="timetype[]">
                            <option value="<?php  echo lang('Days')   ?>" <?php  if(isset($TaskList->ActualTimePeriodType)){ echo $TaskList->ActualTimePeriodType == lang('Days')  ?'selected':'' ;  } ?>>
                                <?php  echo lang('Days')   ?>
                            </option>
                            <option value="<?php  echo lang('Week')   ?>" <?php  if(isset($TaskList->ActualTimePeriodType)){ echo $TaskList->ActualTimePeriodType == lang('Week')  ?'selected':'' ;  } ?>>
                                <?php  echo lang('Week')   ?>
                            </option>
                            <option value="<?php  echo lang('Month')   ?>" <?php  if(isset($TaskList->ActualTimePeriodType)){ echo $TaskList->ActualTimePeriodType == lang('Month')  ?'selected':'' ;  } ?>>
                                <?php  echo lang('Month')   ?>
                            </option>
                        </select></td>
								</tr>
								<?php   }  }  }  ?>
							</tbody>
						</table>
					</div>
				</div>
			<?php   }   }  ?>
			</div>
			
			<div class="row">

					<div class="row">
							<div class="panel-footer">
								<ul class="btn_tas_se" style="padding-left:30px;">
									<li><button type="submit" class="btn btn-primary"><?php echo lang('Save')?></button></li>
									<li><button type="reset" class="btn btn-primary"><?php echo lang('Reset')?></button></li>
								</ul>
							</div>
						  </div>
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
		</form>
        </section>

<script>
  $(document).keypress(".digits",function (e) {
     if (e.which != 8 && e.which != 46  && e.which != 0 && (e.which < 48 || e.which > 57) ) {
               return false;
    }
});
    $(document).on('keyup', '.cost',function() {
        var totalcost = 0;
		var estimatecost=0;
		var Overlaycost=0;
        $('.cost').each( function() {
           totalcost = totalcost + parseFloat($(this).val());
        });
		estimatecost=$('.totalestimatecost').text();
		Overlaycost=estimatecost-totalcost;
        $('.Totalcost').val(totalcost);
		$('.Overlaycost').val(Overlaycost);
    });
	  $(document).on('keyup', '.nop',function() {
        var totalnop = 0;
		var estimatenop=0;
		var Overlaynop=0;
        $('.nop').each( function() {
           totalnop = totalnop + parseFloat($(this).val());
        });
		estimatenop=$('.totalestimatelabour').text();
		Overlaynop=estimatenop-totalnop;
        $('.Totallabour').val(totalnop);
		$('.Overlaylabour').val(Overlaynop);
    });
	  $(document).on('keyup', '.timeperiod',function() {
        var Totaltimeperiod = 0;
		var estimatedtime=0;
		var OverlayTime=0;
        $('.timeperiod').each( function() {
           Totaltimeperiod = Totaltimeperiod + parseFloat($(this).val());
        });
		estimatedtime=$('.totalestimateTime').text();
		OverlayTime=estimatedtime-Totaltimeperiod;
        $('.Totaltimeperiod').val(Totaltimeperiod);
		$('.Overlayperiod').val(OverlayTime);
    });

</script>

</script>