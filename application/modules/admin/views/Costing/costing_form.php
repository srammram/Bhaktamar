<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap-datepicker.min.css">
<style>
label{
	font-weight:bold;
}
fieldset {
		border: 1px solid #ddd !important;
		margin: 0;
		min-width: 0;
		padding: 10px;       
		position: relative;
		border-radius:4px;
		background-color:#fff;
		padding-left:10px!important;margin: 15px;
	}	
legend{
			font-size:14px;
			font-weight:bold;
			margin-bottom: 0px; 
			width: auto; 
			border: 1px solid #ddd;
			border-radius: 4px; 
			padding: 5px 5px 5px 10px; 
			background-color: #ffffff;
		}
	fieldset .form-group label{font-weight: normal;}
	fieldset .table tr td{border: none;}
	fieldset .table-bordered tr td{border: 1px solid #efefef;;}
	.form-inline .form-control{width:100%;}
	.form-horizontal .form-group{ margin-left:-10px!important;margin-top:2px!important;}
	.costing_worksheet_s tbody tr td{border:none;padding:3px;}
	.costing_worksheet_s.table-bordered {border:none!important;}
	.costing_worksheet_s thead tr th{  background-color: #2c3542!important;color:#fff;border:1px solid #ddd;}
	
</style>
 <section class="content-header">
  <h1>Costing</h1>
  	<ol class="breadcrumb">
		<li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active">Costing</li>
  	</ol>
</section>
<section class="content">
  <?php echo form_open('admin/Costing/form/'.$id, array('class' => 'form-horizontal estimationform')) ?>
	 <div class="row">
		<div class="col-md-12">
			<div class="box">
                <div class="box-header">
                  <h3 class="box-title"> <?php echo $page_title  ; ?></h3>
				</div>
				<div class="box-content">
					<fieldset col-sm-12>
                  	<legend>Costing Details</legend>
                  	<div class="form-group col-sm-4">
						<label class="control-label col-sm-4"><?php echo lang('Project')?></label>
						<div class="col-sm-8">
						<select class="form-control" name="projectid" id="projectid" disabled>
						<option value="">Select</option>
						<?php  if(!empty($project)){ foreach($project as $row){ ?>
						<option value="<?php  echo $row->id  ; ?>"<?php if(!empty($project_id)){ echo ($project_id==$row->id)?"Selected":"";  } ?>><?php  echo $row->Name; ?>
						<?php   } }   ?>
						</select>
						</div>
					</div>
					<div class="form-group col-sm-4">
						<label class="control-label col-sm-4"><?php echo lang('project_stage')?></label>
						<div class="col-sm-8">
						<select class="form-control" id="stageid" name="stageid" disabled>
						<option value="">Select</option>
						<?php  if(!empty($stage)){ foreach($stage as $row){ ?>
						<option value="<?php  echo $row->id  ; ?>" <?php if(!empty($stage_id)){ echo ($stage_id==$row->id)?"Selected":"";  } ?>><?php  echo $row->Name; ?>
						<?php   } }  ?>
						</select>
						</div>
					</div>
					<div class="form-group col-sm-4">
						<label class="control-label col-sm-4"><?php echo lang('task_name')?></label>
						<div class="col-sm-8">
						<select class="form-control" id="task" name="taskid" disabled>
						<option value="">Select</option>
						<?php  if(!empty($task)){ foreach($task as $row){ ?>
						<option value="<?php  echo $row->id  ; ?>" <?php if(!empty($task_id)){ echo ($task_id==$row->id)?"Selected":"";  } ?>><?php  echo $row->taskName; ?>
						<?php   } }  ?>
						</select>
						</div>
					</div>
					<div class="form-group col-sm-4">
						<label class="control-label col-sm-4"><?php echo lang('RefNO')?></label>
						<div class="col-sm-8">
							<input type="text"  class="form-control" name="refno" value="<?php if(!empty($refno) && isset($id)){ echo $refno;  }else{ echo 'CS'.strtotime(date('Y/m/d H:i:s')); }   ?>" readonly>
						</div>
					</div>
					<div class="form-group col-sm-4">
						<label class="control-label col-sm-4"><?php echo lang('Remark')?></label>
						<div class="col-sm-8">
							<input type="text" name="remark" class="form-control" value="<?php if(isset($remarks)){ echo $remarks;  }   ?>">
						</div>
					</div>
					<div class="form-group col-sm-4">
						<label class="control-label col-sm-4"><?php echo lang('date')?></label>
						<div class="col-sm-8">
							<input type="text" name="date" class="form-control datepicker" value="<?php if(isset($date)){ echo $date;  }   ?>" onkeydown="return false" >
						</div>
					</div>
					<div class="form-group col-sm-4">
						<label class="control-label col-sm-4"><?php echo lang('Status')?></label>
						<div class="col-sm-8">
							<select class="form-control" name="estatus" id="estatus" >
							<option value="">Select</option>
							<option value="<?php echo lang('planning');  ?>" <?php if(!empty($status)){ echo ($status==lang('planning'))?"Selected":"";  } ?>><?php echo   lang('planning');  ?></option>
							<option value="<?php echo lang('in_process');  ?>" <?php if(!empty($status)){ echo ($status==lang('in_process'))?"Selected":"";  } ?>><?php echo   lang('in_process');  ?></option>
							<option value="<?php echo lang('Waiting_for_Approval');  ?>" <?php if(!empty($status)){ echo ($status==lang('Waiting_for_Approval'))?"Selected":"";  } ?>><?php echo   lang('Waiting_for_Approval');  ?></option>
							<option value="<?php echo lang('Approved');  ?>" <?php if(!empty($status)){ echo ($status==lang('Approved'))?"Selected":"";  } ?>><?php echo   lang('Approved');  ?></option>
							<option value="<?php echo lang('decline');  ?>" <?php if(!empty($status)){ echo ($status==lang('decline'))?"Selected":"";  } ?>><?php echo   lang('decline');  ?></option>
							
							</select>
						</div>
					</div>
					<?php  if($id){ ?>
					<div class="form-group col-sm-4">
						<label class="control-label col-sm-4"><?php echo lang('approved_remark')?></label>
						<div class="col-sm-8">
							<input type="text" name="approved_remarks" class="form-control" value="<?php if(isset($approved_remarks)){ echo $approved_remarks;  }   ?>">
						</div>
					</div>
					<div class="form-group col-sm-4">
						<label class="control-label col-sm-4"><?php echo lang('approved_date')?></label>
						<div class="col-sm-8">
							<input type="text" name="approved_date" class="form-control datepicker" value="<?php if(isset($approved_date)){ echo $approved_date;  }   ?>" onkeydown="return false" >
						</div>
					</div>
					<?php  } ?>
                  </fieldset>
                  <fieldset col-sm-12>
                  	<legend>Costing Worksheet</legend>
                  	<table class="table costing_worksheet_s">
					<colgroup>
						<col width=16.66%>
						<col width=16.66%>
						<col width=16.66%>
						<col width=16.66%>
						<col width=16.66%>
						<col width=16.66%>
						
					</colgroup>
						<thead>
							<tr>
								<th>Masters</th>
								<th>Unit</th>
								<th>UOM</th>
								<th>Price</th>
								<th>Actual Unit</th>
								<th>Actual Price</th>
							</tr>
						</thead>
                  		<tbody>
							<?php  if(!empty($workSheet)){foreach($workSheet as $item){  
							?>
						<tr>
							<td><?php  if(!empty($item->material_id)) { ?>
								 <select class="form-control"  id="material" disabled>
												<option value="">Select</option>
												<?php   if(isset($material)){  foreach($material as $row){  ?>
												<option value="<?php echo  $row->id; ?>" <?php if(!empty($item->material_id)){ echo ($item->material_id==$row->id)?"Selected":"";  } ?>><?php echo $row->Name;  ?></option>
												<?php   } } ?>
												</select>
											 <input type="hidden" class="form-control" name="material_id[]"  value="<?php   echo $item->material_id ;  ?>" readonly>
											  <input type="hidden" class="form-control" name="masterid[]"  value="<?php   echo $item->id ;  ?>" readonly>
										<?php   }else{   ?>
										
											 <input type="text" class="form-control"  value="<?php   echo $item->Name ;  ?>" readonly>
											  <input type="hidden" class="form-control" name="masterid[]"  value="<?php   echo $item->master_id ;  ?>" readonly>
											
										<?php  } ?>
							</td>
							<td>
							<input type="text" name="unit[]" class="form-control" readonly placeholder="Unit"  value="<?php if(!empty($item->unit)){ echo $item->unit ; }  ?>"/>
							</td>
							
							<td>
								   <select class="form-control"  id="uom" disabled>
											   <option value="">Select</option>
												<?php   if(isset($uom)){  foreach($uom as $row){  ?>
												<option value="<?php echo  $row->id; ?>" <?php if(!empty($item->uom)){ echo ($item->uom==$row->id)?"Selected":"";  } ?>><?php echo $row->Name;  ?></option>
												<?php   } } ?>
												</select>
												<input type="hidden" class="form-control" name="uom[]"  value="<?php   echo $item->uom ;  ?>" readonly>
							</td>
							<td>
								<input type="text" name="cost[]" readonly class="form-control allowdecimalpoint " placeholder="Total cost" value="<?php if(!empty($item->cost)){ echo $item->cost ; }  ?>" />
							</td>
							<td>
								<input type="text" name="d_unit[]" class="form-control " placeholder="Unit" value="<?php if(!empty($item->d_unit)){ echo $item->d_unit ; }  ?>">
							</td>
							<td>
								<input type="text" name="d_cost[]" class="form-control allowdecimalpoint cost" placeholder="Total cost" value="<?php if(!empty($item->d_price)){ echo $item->d_price ; }  ?>">
							</td>
						</tr>
							<?php   }  }  ?>
						<tr>
							<td colspan="4"></td>
							<td><b>Total Estimate Amount</b></td>
							<td><b><?php if(!empty($total_estimate_cost)){ echo $total_estimate_cost;  }else{ echo 0; }   ?>	</b></td>
							
				<input type="hidden" name="totalamount"  value="<?php if(!empty($total_estimate_cost)){ echo $total_estimate_cost;  }else{ echo 0; }   ?>">
						</tr>
						<tr>
							<td colspan="4"></td>
							<td><b>Total  Costing Amount</b></td>
							<td ><b class="amount">0</b>
							</td>
							<input type="hidden" name="total_Costing_amount" class="totalamount" value="<?php if(!empty($total_estimate_cost)){ echo $total_estimate_cost;  }else{ echo 0; }   ?>">
						</tr>
					
						
                  		</tbody>
                  	</table>
				<input type="hidden" name="id" value="<?php  if(!empty($id)){ echo $id;}  ?>">
						<button type="submit" style="float:right;" class="btn btn-primary next-step  saveestimation_form">Save </button>
                  </fieldset>
				</div>
	 		</div>
		 </div>
	 </div>
	 </form>
	 	
	

</section>
<script src="<?php echo base_url('assets/admin/') ?>/plugins/datepicker/bootstrap-datepicker.js"></script>
<script>
    $('.datepicker').datepicker({
        weekStart: 1,
        autoclose: true,
        todayHighlight: true,
		format: "yyyy-mm-dd",
		 maxDate: 0,
		endDate: '+0d', 
    });
</script>
<script>
$(function() {
	var qty=!$(this).val()?$(".totalqty").val():0;
var i=1+parseInt(qty);
    $(document).on(
        'click',
        '[data-role="dynamic-fields"] > .form-inline [data-role="remove"]',
        function(e) {
			i --;
            e.preventDefault();
            $(this).closest('.form-inline').remove();
			$('.item').text(i);
			$('.totalqty').val(i);
        }
    );
    $(document).on(
        'click',
        '[data-role="dynamic-fields"] > .form-inline [data-role="add"]',
        function(e) {
			i ++;
            e.preventDefault();
            var container = $(this).closest('[data-role="dynamic-fields"]');
            new_field_group = container.children().filter('.form-inline:first-child').clone();
            new_field_group.find('input').each(function() {
				$('.item').text(i);
				$('.totalqty').val(i);
                $(this).val('');
            });
            container.append(new_field_group);
        }
    );
});
</script>

  <script>
$(document).on("change", ".cost", function() {
	//var amount=$(".totalamount").val()?$(".totalamount").val():0;
	//alert(amount);
    var sum = 0;
    $(".cost").each(function(){
        sum += +$(this).val();
    });
    $(".amount").text(sum);
	$(".totalamount").val(sum);
});
</script>
