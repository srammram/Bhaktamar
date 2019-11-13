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
	.btn_tas_se li{display: inline-block;padding: 0px 0px 0px 15px;margin-bottom: 20px;}
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
	.table tbody tr td input{border:none;}
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
<form method="post" action="<?php echo site_url('admin/Project/Estimationform/'.$id); ?>" enctype="multipart/form-data" id="estimation">	
	<div class="container">
		<div class="well col-sm-12">
			<div class="row">
				<div class="col-sm-12 col-xs-12">
					<div class="form-group col-sm-4">
						<label class="control-label col-sm-4"><?php echo lang('Project')?></label>
						<div class="col-sm-8">
							<select class="form-control" name="project" id="project">
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
						<li>
							<div class="btn-group" role="group" >
							  <button type="button" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span></button>
							  <button type="button" class="btn btn-default newtask"><?php echo lang('New_task')?></button>
							</div>
						</li>
					</ul>

				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<div class="panel panel-default" style="margin-bottom: 0px;">
					<?php   	if(isset($TaskLists)){  foreach($TaskLists as $TaskList){  ?>
							
							<div>
    <input type="hidden" value="<?php  echo $TaskList->taskId ;  ?>" name="taskid[]">
    <div class="panel-heading panelHeader" data-toggle="collapse" data-target="#2" style="cursor:pointer;">
        <div class="panel-title">Task <?php  echo $TaskList->taskId ;  ?></div>
    </div>
    <div class="panel-body collapse in" id="2">
        <div class="row">
		 <div class="col-sm-12" style="padding: 0px;">
                <div class="form-group col-sm-4">
                    <label class="control-label col-sm-5 text-center">
                        <?php echo lang('Task_Name')  ?>
                    </label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" name="TaskName[]" placeholder="Name"  value="<?php  echo   $TaskList->TaskName  ?>">
                    </div>
                </div>
            </div>
            <div class="col-sm-12" style="padding: 0px;">
                <div class="form-group col-sm-4">
                    <label class="control-label col-sm-5 text-center">
                        <?php echo lang('Cost')  ?>
                    </label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control cost digits" name="cost[]" placeholder="cost"  value="<?php  echo   $TaskList->Cost  ?>">
                    </div>
                </div>
            </div>
			<?php   if(isset($TaskwiseLabourlists)){ foreach($TaskwiseLabourlists as $TaskwiseLabourlist){  if($TaskwiseLabourlist->Task_id == $TaskList->taskId) { ?>
            <div class="col-sm-12 labour" style="padding: 0px;">
                <div class="form-group col-sm-4">
                    <input type="hidden" name="Labourtaskid[]" value="<?php  echo $TaskList->taskId ;  ?>">
                    <label class="control-label col-sm-5 text-center">
                        <?php echo lang('labour')  ?>
                    </label>
                    <div class="col-sm-7">
                        <select class="form-control" name="labourtype[]">
                            <option>Select</option>
                            <?php  if(!empty($Laboutypes)){ foreach($Laboutypes  as $Laboutype){
?>
                                <option value="<?php echo $Laboutype->id ;  ?>" <?php  if(isset($TaskwiseLabourlist->LabourTypeId)){ echo $TaskwiseLabourlist->LabourTypeId == $Laboutype->id ?'selected':'' ;  } ?> >
                                    <?php echo $Laboutype->Name ;   ?>
                                        <?php  } }?>
                        </select>
                    </div>
                </div>
                <div class="form-group col-sm-3">
                    <label class="control-label col-sm-5 text-center">
                        <?php echo lang('NoOfPersons')  ?>
                    </label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control text-center nop" placeholder="No of Pesons" name="noofperson[]" value="<?php  echo $TaskwiseLabourlist->NoOfPerson;  ?>">
                    </div>
                </div>
                <div class="form-group col-sm-4">
                    <label class="control-label col-xs-4 text-center">
                        <?php echo lang('Payment_period')  ?>
                    </label>
                    <div class="col-xs-8">
                        <select class="form-control " name="paymentperiod[]">
                                 <option value="<?php  echo lang('Days')   ?>" <?php  if(isset($TaskwiseLabourlist->PaymentPeriod)){ echo $TaskwiseLabourlist->PaymentPeriod == lang('Days')  ?'selected':'' ;  } ?>>
                                <?php  echo lang('Days')   ?>
                            </option>
                            <option value="<?php  echo lang('Week')   ?>" <?php  if(isset($TaskwiseLabourlist->PaymentPeriod)){ echo $TaskwiseLabourlist->PaymentPeriod == lang('Week')  ?'selected':'' ;  } ?>>
                                <?php  echo lang('Week')   ?>
                            </option>
                            <option value="<?php  echo lang('Month')   ?>" <?php  if(isset($TaskwiseLabourlist->PaymentPeriod)){ echo $TaskwiseLabourlist->PaymentPeriod == lang('Month')  ?'selected':'' ;  } ?>>
                                <?php  echo lang('Month')   ?>
                            </option>
                        </select>
                    </div>
                </div>
              
            </div>
			<?php  } } } ?>
			<?php   if(!empty($TaskwiseMateriallists)){ foreach($TaskwiseMateriallists as $TaskwiseMateriallist){  if($TaskwiseMateriallist->taskId == $TaskList->taskId) { ?>
            <div class="col-sm-12 materials" style="padding: 0px;">
                <div class="form-group col-sm-4">
                    <input type="hidden" name="materialtaskid[]" value="<?php  echo $TaskList->taskId ;  ?>">
                    <label class="control-label col-sm-5 text-center">
                        <?php echo lang('Material')  ?>
                    </label>
                    <div class="col-sm-7">
                        <select class="form-control" name="material[]">
                            <option>Select</option>
                            <?php  if(!empty($Materials)){ foreach($Materials  as $Material){
?>
                                <option value="<?php echo $Material->id;  ?>" <?php  if(isset($TaskwiseMateriallist->MaterialTypeid)){ echo $TaskwiseMateriallist->MaterialTypeid == $Material->id ?'selected':'' ;  } ?>>
                                    <?php echo $Material->Name ;  ?>
                                        <?php  } }?>
                        </select>
                    </div>
                </div>
                <div class="form-group col-sm-3">
                    <label class="control-label col-sm-5 text-center">
                        <?php echo lang('Qty')  ?>
                    </label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control text-center" name="Qty[]"  value="<?php  echo $TaskwiseMateriallist->Qty;  ?>">
                    </div>
                </div>
                <div class="form-group col-sm-4">
                    <label class="control-label col-xs-4 text-center">
                        <?php echo lang('UOM')  ?>
                    </label>
                    <div class="col-xs-8">
                        <select class="form-control" name="uoms[] "><option>Select</option><?php  if(!empty($Uoms)){ foreach($Uoms  as $Uom){?><option value="<?php echo $Uom->id ; ?> " <?php  if(isset($TaskwiseMateriallist->UOMId)){ echo $TaskwiseMateriallist->UOMId == $Uom->id ?'selected':'' ;  } ?>>
                            <?php echo $Uom->Name ;   ?>
                                <?php  } }?>
                        </select>
                    </div>
                </div>
               
            </div>
			<?php  } } } ?>
            <div class="col-sm-12" style="padding: 0px;">
                <div class="form-group col-sm-4">
                    <label class="control-label col-sm-5 text-center">
                        <?php echo lang('time_period')  ?>
                    </label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control timeperiod" placeholder="10" name="timeperiod[]" value="<?php  echo   $TaskList->TimePeriod  ?>">
                    </div>
                    <div class="col-sm-4">
                        <select class="form-control " name="timetype[]">
                            <option value="<?php  echo lang('Days')   ?>" <?php  if(isset($TaskList->TimePeriodType)){ echo $TaskList->TimePeriodType == lang('Days')  ?'selected':'' ;  } ?>>
                                <?php  echo lang('Days')   ?>
                            </option>
                            <option value="<?php  echo lang('Week')   ?>" <?php  if(isset($TaskList->TimePeriodType)){ echo $TaskList->TimePeriodType == lang('Week')  ?'selected':'' ;  } ?>>
                                <?php  echo lang('Week')   ?>
                            </option>
                            <option value="<?php  echo lang('Month')   ?>" <?php  if(isset($TaskList->TimePeriodType)){ echo $TaskList->TimePeriodType == lang('Month')  ?'selected':'' ;  } ?>>
                                <?php  echo lang('Month')   ?>
                            </option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
					<?php  		
						} }
						?>
					</div>
					<div class="row">
							<div class="panel-footer">
								<ul class="btn_tas_se">
									<li><button type="submit" class="btn btn-primary"><?php echo lang('Save')?></button></li>
									<li><button type="reset" class="btn btn-primary"><?php echo lang('Reset')?></button></li>
								</ul>
							</div>
						  </div>
					<div class="col-sm-4 col-sm-offset-8" style="padding: 0px;">
						<table class="table table-bordered" style="table-layout: fixed;">
							<tbody>
								<tr>
									<td><?php echo lang('Total_cost')?></td>
									<td><input type="text" class="Totalcost" name="Totalcost"readonly value="<?php if(isset($TotalEstimateCost)){ echo $TotalEstimateCost ;  }  ?>"></td>
								</tr>
								<tr>
									<td><?php echo lang('Total_Labaour')?></td>
									<td><input type="text" class="Totallabour"name="Totallabour"readonly  value="<?php if(isset($TotalEstimateLabour)){ echo $TotalEstimateLabour;  }  ?>"></td>
								</tr>
								<tr>
									<td><?php echo lang('Total_TimePeriod')?></td>
									<td><input type="text" class="Totaltimeperiod" name="Totaltimeperiod"readonly value="<?php if(isset($TotalEstimateTime)){ echo $TotalEstimateTime;  }  ?>"></td>
								</tr>
							</tbody>
						</table>
					</div>   
				</div>
			</div>
		</div>	
	</div>
		</form>
        </section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".panel-default"); //Fields wrapper
    var add_button      = $(".newtask"); //Add button ID
    var x = 1; //initlal text box count
	var i=1;
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div><input type="hidden" value="'+i+'" name="taskid[]"><div class="panel-heading panelHeader" data-toggle="collapse" data-target="#2" style="cursor:pointer;"><div class="panel-title">Task'+i+'</div></div><div class="panel-body collapse in" id="2"> <div class="row"><div class="col-sm-12" style="padding: 0px;"><div class="form-group col-sm-4"><label class="control-label col-sm-5 text-center"><?php echo lang('Task_Name')  ?></label><div class="col-sm-7"><input type="text" class="form-control  " name="TaskName[]" placeholder="Name"></div></div></div><div class="col-sm-12" style="padding: 0px;"><div class="form-group col-sm-4"><label class="control-label col-sm-5 text-center"><?php echo lang('Cost')  ?></label><div class="col-sm-7"><input type="text" class="form-control cost digits" name="cost[]" placeholder="cost"></div></div></div><div class="col-sm-12 labour'+i+'" style="padding: 0px;"><div class="form-group col-sm-4"><input type="hidden" name="Labourtaskid[]" value="'+i+'"><label class="control-label col-sm-5 text-center"><?php echo lang('labour')  ?></label><div class="col-sm-7"><select class="form-control" name="labourtype[]"><option>Select</option><?php  if(!empty($Laboutypes)){ foreach($Laboutypes  as $Laboutype){
?><option value="<?php echo $Laboutype->id ;  ?>"><?php echo $Laboutype->Name ;   ?><?php  } }?></select></div></div><div class="form-group col-sm-3"><label class="control-label col-sm-5 text-center"><?php echo lang('NoOfPersons')  ?></label><div class="col-sm-7"><input type="text" class="form-control text-center nop"  placeholder="No of Pesons" name="noofperson[]"></div></div><div class="form-group col-sm-4"><label class="control-label col-xs-4 text-center"><?php echo lang('Payment_period')  ?></label><div class="col-xs-8"><select class="form-control " name="paymentperiod[]"><option value="<?php  echo lang('Days')   ?>"><?php  echo lang('Days')   ?> </option><option value="<?php  echo lang('Week')   ?>"><?php  echo lang('Week')   ?> </option><option value="<?php  echo lang('Month')   ?>"><?php  echo lang('Months')   ?> </option></select></div></div><div class="col-sm-1"><button type="button" class="btn-danger circle_btn_s addlabour" id='+i+'><span class="glyphicon glyphicon-plus "></span></button></div></div><div class="col-sm-12 materials'+i+'" style="padding: 0px;"><div class="form-group col-sm-4"><input type="hidden" name="materialtaskid[]" value="'+i+'"><label class="control-label col-sm-5 text-center"><?php echo lang('Material')  ?></label><div class="col-sm-7"><select class="form-control" name="material[]"><option>Select</option><?php  if(!empty($Materials)){ foreach($Materials  as $Material){
?><option value="<?php echo $Material->id;  ?>"><?php echo $Material->Name ;  ?><?php  } }?></select></div></div><div class="form-group col-sm-3"><label class="control-label col-sm-5 text-center"><?php echo lang('Qty')  ?></label><div class="col-sm-7"><input type="text" class="form-control text-center" name="Qty[]"></div></div><div class="form-group col-sm-4"><label class="control-label col-xs-4 text-center"><?php echo lang('UOM')  ?></label><div class="col-xs-8"><select class="form-control" name="uoms[]"><option>Select</option><?php  if(!empty($Uoms)){ foreach($Uoms  as $Uom){?><option value="<?php echo $Uom->id ; ?>"><?php echo $Uom->Name ;   ?><?php  } }?></select></div></div><div class="col-sm-1"><button type="button" class="btn-danger circle_btn_s addmaterial" id='+i+'><span class="glyphicon glyphicon-plus"></span></button></div></div><div class="col-sm-12" style="padding: 0px;"><div class="form-group col-sm-4"><label class="control-label col-sm-5 text-center"><?php echo lang('time_period')  ?></label><div class="col-sm-3"><input type="text" class="form-control timeperiod" placeholder="10" name="timeperiod[]"></div><div class="col-sm-4"><select class="form-control " name="timetype[]"><option value="<?php  echo lang('Days')   ?>"><?php  echo lang('Days')   ?> </option><option value="<?php  echo lang('Week')   ?>"><?php  echo lang('Week')   ?> </option><option value="<?php  echo lang('Month')   ?>"><?php  echo lang('Month')   ?> </option></select></div></div></div></div><div class="row"></div></div><a href="#" class="remove_field" style="float:right;color:red;">Remove</a></div>'); //add input box
			i++;
        }
    });
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});

</script>


<script>
$(document).ready(function() {
 $(document).on('click','.addlabour',function(e){
  var max_fields      = 10; //maximum input boxes allowed
    var wrapper1         = $(".labour"+$(this).attr('id')); //Fields wrapper
    var add_button1      = $(".addlabour"); //Add button ID
    var x = 1; //initlal text box count
	var i=1;
	 e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper1).append('<div class="removediv"><div class="form-group col-sm-4"><input type="hidden" name="Labourtaskid[]" value="'+i+'"><label class="control-label col-sm-5 text-center"><?php echo lang('labour')  ?></label><div class="col-sm-7"><select class="form-control" name="labourtype[]"><option>Select</option><?php  if(!empty($Laboutypes)){ foreach($Laboutypes  as $Laboutype){
?><option value="<?php echo $Laboutype->id ;  ?>"><?php echo $Laboutype->Name ;   ?><?php  } }?></select></div></div><div class="form-group col-sm-3"><label class="control-label col-sm-5 text-center"><?php echo lang('NoOfPersons')  ?></label><div class="col-sm-7"><input type="text" class="form-control text-center nop digits"  placeholder="No of Pesons" name="noofperson[]"></div></div><div class="form-group col-sm-4"><label class="control-label col-xs-4 text-center"><?php echo lang('Payment_period')  ?></label><div class="col-xs-8"><select class="form-control " name="paymentperiod[]"><option value="<?php  echo lang('Days')   ?>"><?php  echo lang('Days')   ?> </option><option value="<?php  echo lang('Week')   ?>"><?php  echo lang('Week')   ?> </option><option value="<?php  echo lang('Month')   ?>"><?php  echo lang('Months')   ?> </option></select></div></div><button type="button" class="btn-danger  circle_btn_s remove_labour_field" style="background-color: #f44336;margin:18px 12px"><span class="glyphicon glyphicon-remove "></span></button></div>'); //add input box
			i++;
        }
	//	 $(wrapper1).on("click",".remove_field", function(e){ //user click on remove text
		  $(document).on('click','.remove_labour_field',function(e){
        e.preventDefault(); $(this).parent('.removediv').remove(); x--;
    })
 
 });
 });
</script>

<script>
$(document).ready(function() {
 $(document).on('click','.addmaterial',function(e){
  var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".materials"+$(this).attr('id')); //Fields wrapper
    var add_button1      = $(".addmaterial"); //Add button ID
    var x = 1; //initlal text box count
	var i=1;
	 e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div class="removematrialdiv"><div class="form-group col-sm-4"><input type="hidden" name="materialtaskid[]" value="'+i+'"><label class="control-label col-sm-5 text-center"><?php echo lang('Material')  ?></label><div class="col-sm-7"><select class="form-control" name="material[]"><option>Select</option><?php  if(!empty($Materials)){ foreach($Materials  as $Material){
?><option value="<?php echo $Material->id;  ?>"><?php echo $Material->Name ;  ?><?php  } }?></select></div></div><div class="form-group col-sm-3"><label class="control-label col-sm-5 text-center"><?php echo lang('Qty')  ?></label><div class="col-sm-7"><input type="text" class="form-control text-center digits" name="Qty[]"></div></div><div class="form-group col-sm-4"><label class="control-label col-xs-4 text-center"><?php echo lang('UOM')  ?></label><div class="col-xs-8"><select class="form-control" name="uoms[]"><option>Select</option><?php  if(!empty($Uoms)){ foreach($Uoms  as $Uom){?><option value="<?php echo $Uom->id ; ?>"><?php echo $Uom->Name ;   ?><?php  } }?></select></div></div><button type="button" class="btn-danger  circle_btn_s remove_material_field" style="background-color: #f44336;margin:18px 12px"><span class="glyphicon glyphicon-remove "></span></button></div>'); //add input box
			i++;
        }
		  $(document).on('click','.remove_material_field',function(e){
        e.preventDefault(); $(this).parent('.removematrialdiv').remove(); x--;
    })
 
 });
 });
</script>
<script>
$(document).on('change', '#project', function(){
	var val = $(this).val();
	$.ajax({
	url: '<?php echo site_url('admin/Project/gtProjectStages') ?>',
	type:'POST',
	data:{projectid:val},
	dataType: "html",
	success:function(result){
	 $('#projectstage').append(result);
	}
	});
	}); 
	
/*   $(document).keypress(".digits",function (e) {
	  
     if (e.which != 8 && e.which != 46  && e.which != 0 && (e.which < 48 || e.which > 57) ) {
               return false;
    }
}); */

    $(document).on('keyup', '.cost',function() {
        var totalcost = 0;
        $('.cost').each( function() {
           totalcost = totalcost + parseFloat($(this).val());
        });
        $('.Totalcost').val(totalcost);
		
    });
	  $(document).on('keyup', '.nop',function() {
        var totalnop = 0;
        $('.nop').each( function() {
           totalnop = totalnop + parseFloat($(this).val());
        });
        $('.Totallabour').val(totalnop);
		
    });
	  $(document).on('keyup', '.timeperiod',function() {
        var Totaltimeperiod = 0;
        $('.timeperiod').each( function() {
           Totaltimeperiod = Totaltimeperiod + parseFloat($(this).val());
        });
        $('.Totaltimeperiod').val(Totaltimeperiod);
		
    });

</script>

</script>