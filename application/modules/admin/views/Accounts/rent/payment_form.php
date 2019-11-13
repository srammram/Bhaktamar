<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap-datepicker.min.css">
<style>
label{
	font-weigth:bold;
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
	
		legend
		{
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
</style>
 <section class="content-header">
  <h1>Rental  Details</h1>
  	<ol class="breadcrumb">
		 <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i>
		<li class="active">Rental  Details</li>
  	</ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body" style="color:black;">
                    <form method="post" action="<?php echo site_url('admin/Accounts/add_payment/'.$id); ?>"
                        enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group col-md-6">
                                <label for="Paid_status"> <span
                                        style="color:red;">*</span><?php echo lang('paid_from'); ?> :</label>
                                <select class="form-control" name="paid_from">
                                    <option>Please Select </option>
                                    <option value="<?php echo lang('reserve_fund')?>"
                                        <?php echo set_select('paid_from',lang('reserve_fund'), ( !empty($paid_from) && $paid_from == lang('reserve_fund') ? TRUE : FALSE )); ?>>
                                        <?php echo lang('reserve_fund')?></option>
                                    <option value="<?php echo lang('ready_cash')?>"
                                        <?php echo set_select('paid_from',lang('ready_cash'), ( !empty($paid_from) && $paid_from == lang('ready_cash') ? TRUE : FALSE )); ?>>
                                        <?php echo lang('ready_cash')?></option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <span
                                        style="color:red;">*</span> <label for="project_id"><?php echo lang('project')?>:</label>
                                <select name="project_id" id="project" class="form-control chosen"
                                    onchange="get_building(this.value)">
                                    <option><?php echo lang('select')?></option>
                                    <?php if(isset($project)){ foreach($project as $item) {		 ?>
                                    <option value="<?php  echo $item->id ?>"
                                        <?php echo set_select('project_id',$item->id, ( !empty($project_id) && $project_id == $item->id ? TRUE : FALSE )); ?>>
                                        <?php echo $item->Name  ?></option>
                                    <?php } }    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                            <span
                                        style="color:red;">*</span>    <label for="building"><?php echo lang('building')?>:</label> 
                                <select name="building_id" class="form-control" id="building"
                                    onchange="get_buildingtenant(this.value)">
                                    <option><?php echo lang('select')?></option>
                                    <?php if(isset($buildings)){ foreach($buildings as $item) {		 ?>
                                    <option value="<?php  echo $item->bldid ?>"
                                        <?php  if(isset($building_id)){ echo $building_id == $item->bldid ?'selected':'' ;  } ?>>
                                        <?php echo $item->name  ?></option>
                                    <?php } }    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                              <span
                                        style="color:red;">*</span>   <label for="owner"><?php echo lang('tenant')?>:</label>
                                <select name="owner_id" class="form-control" id="owner"
                                    onchange="get_tenantUnits(this.value)">
                                    <option><?php echo lang('select')?></option>
                                    <?php if(isset($owners)){ foreach($owners as $item) {		 ?>
                                    <option value="<?php  echo $item->tentant_id ?>"
                                        <?php  if(isset($owner_id)){ echo $owner_id == $item->tentant_id ?'selected':'' ;  } ?>>
                                        <?php echo $item->full_name  ?></option>
                                    <?php } }    ?>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="unit"> <span style="color:red;">*</span><?php echo lang('unit'); ?>
                                    :</label>
                                <select class="form-control " id="unit" name="unit_id" onchange="get_rentalBills(this.value)">
                                    <option>Please Select </option>
                                    <?php if(isset($ownerunits)){ foreach($ownerunits as $item) {		 ?>
                                    <option value="<?php  echo $item->uid ?>"
                                        <?php  if(isset($unit_id)){ echo $unit_id == $item->uid ?'selected':'' ;  } ?>>
                                        <?php echo $item->unit_name  ?></option>
                                    <?php } }    ?>
                                </select>
                            </div>
							  <div class="form-group col-md-6">
                                <label for="unit"> <span style="color:red;">*</span><?php echo lang('bill'); ?>
                                    :</label>
                                <select class="form-control " id="rentalbill" name="rentalbillid"  onchange="get_rentalBillsamount(this.value)">
                                    <option>Please Select </option>
                                    
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="Bill_Date"> <span
                                        style="color:red;">*</span><?php echo lang('paid_date'); ?> :</label>
                                <input type="text" name="paid_date" class="form-control datepicker"
                                    value=" <?php if(!empty($paid_date)){ echo $paid_date;  }else{ echo set_value('paid_date') ; }   ?>" onkeydown="return false" >
                            </div>
                            <div class="form-group col-md-6">
                                <label for="Total_amount"> <span
                                        style="color:red;">*</span><?php echo lang('Total_amount'); ?> :</label>
                                <input type="text" class="form-control allowdecimalpoint" name="Total_amount" id="totalAmount"
                                    value=" <?php if(!empty($total_amount)){ echo $total_amount;  }else{ echo set_value('Total_amount') ; }   ?>" readonly>
                            </div>
							 <div class="form-group col-md-6">
                                <label for="Total_amount"> <span
                                        style="color:red;">*</span><?php echo lang('paid_amount'); ?> :</label>
                                <input type="text" class="form-control allowdecimalpoint" name="paidamount" 
                                    value=" <?php if(!empty($total_amount)){ echo $total_amount;  }else{ echo set_value('Total_amount') ; }   ?>">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="Details"> <span style="color:red;">*</span><?php echo lang('Note'); ?>
                                    :</label>
                                <textarea name="Note"
                                    class="form-control"><?php if(!empty($bill_details)){ echo $bill_details;  }else{ echo set_value('Details') ; }   ?></textarea>
                            </div>
                          
                        </div>
                        <div class="box-footer">
                            <input type="hidden" name="id" value="<?php if(isset($id)){ echo $id; } ?>">
                            <input class="btn btn-primary" type="submit" value="Save" />
                        </div>
                    </form>
                </div><!-- /.box-body -->
            </div><!-- /.box -->

        </div><!-- /.col -->
    </div><!-- /.row -->
</section>