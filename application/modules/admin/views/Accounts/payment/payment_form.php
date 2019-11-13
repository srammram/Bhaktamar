<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap-datepicker.min.css">
<style>
label{
	font-weigth:bold;
}
	fieldset 
	{
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
	.help-block{color:red;}
</style>
 <section class="content-header">
 <h3> <?php   echo $page_title; ?></h3>
  	<ol class="breadcrumb">
		<li><a href="<?php echo base_url('admin/dashboard');  ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active"><?php   echo $page_title; ?></li>
  	</ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
              <div class="box box-primary" data-collapsed="0">
                        <div class="box-header with-border bg-primary-dark">
                            <h4 style="font-weight:bold;margin-left:12px;"><?php   echo $page_title; ?></h4>
                        </div>
                <div class="box-body">
                    <form method="post"  class="billpaymentform" action="<?php echo site_url('admin/Accounts/payment_form/'.$id); ?>"
                        enctype="multipart/form-data">
                        <div class="box-body">
						
                            <div class="form-group col-md-6">
							<div class="col-md-12" style="padding:0px;">
                                <label for="Paid_status"> <span
                                        style="color:red;">*</span><?php echo lang('paid_from'); ?> :</label>
                                <select class="form-control" name="paid_from">
                                    <option value="">Please Select </option>
                                    <option value="<?php echo lang('reserve_fund')?>"
                                        <?php echo  !empty($paid_form) && $paid_form == lang('reserve_fund') ? "selected" :"" ; ?>>
                                        <?php echo lang('reserve_fund')?></option>
                                    <option value="<?php echo lang('ready_cash')?>"
                                        <?php echo !empty($paid_from) && $paid_from == lang('ready_cash') ? "selected" : "" ; ?>>
                                        <?php echo lang('ready_cash')?></option>
								      <option value="<?php echo lang('directCash')?>"  <?php echo !empty($paid_from) && $paid_from == lang('directCash') ? TRUE :""; ?> >
                                        <?php echo lang('directCash')?></option>
                                </select>
							</div>	
                            </div>
                            <div class="form-group col-md-6">
							
                                <label for="project_id"><?php echo lang('project')?>:</label>
                                <select name="project_id" id="project" class="form-control chosen"
                                    onchange="get_building(this.value)">
                                    <option value=""><?php echo lang('select')?></option>
                                    <?php if(isset($project)){ foreach($project as $item) {		 ?>
                                    <option value="<?php  echo $item->id ?>"
                                        <?php echo set_select('project_id',$item->id, ( !empty($projectid) && $projectid == $item->id ? TRUE : FALSE )); ?>>
                                        <?php echo $item->Name  ?></option>
                                    <?php } }    ?>
                                </select>
							
                            </div>
                            <div class="form-group col-md-6">
                                <label for="building"><?php echo lang('building')?>:</label>
                                <select name="building_id" class="form-control" id="building"
                                    onchange="get_buildingOwners(this.value)">
                                    <option value=""><?php echo lang('select')?></option>
                                    <?php if(isset($buildings)){ foreach($buildings as $item) {		 ?>
                                    <option value="<?php  echo $item->bldid ?>"
                                        <?php  if(isset($buildingid)){ echo $buildingid == $item->bldid ?'selected':'' ;  } ?>>
                                        <?php echo $item->name  ?></option>
                                    <?php } }    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="owner"><?php echo lang('Owner')?>:</label>
                                <select name="owner_id" class="form-control" id="owner"
                                    onchange="get_ownerUnits(this.value)">
                                    <option value=""><?php echo lang('select')?></option>
                                    <?php if(isset($owners)){ foreach($owners as $item) {		 ?>
                                    <option value="<?php  echo $item->ownid ?>"
                                        <?php  if(isset($ownerid)){ echo $ownerid == $item->ownid ?'selected':'' ;  } ?>>
                                        <?php echo $item->full_name  ?></option>
                                    <?php } }    ?>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="unit"> <span style="color:red;">*</span><?php echo lang('unit'); ?>
                                    :</label>
                                <select class="form-control " id="unit" name="unit_id">
                                    <option value="">Please Select </option>
                                    <?php if(isset($ownerunits)){ foreach($ownerunits as $item) {		 ?>
                                    <option value="<?php  echo $item->uid ?>"
                                        <?php  if(isset($unitid)){ echo $unitid == $item->uid ?'selected':'' ;  } ?>>
                                        <?php echo $item->unit_name  ?></option>
                                    <?php } }    ?>
                                </select>
                            </div>
						    <div class="form-group col-md-6">
                                <label for="Paid_status"> <span
                                        style="color:red;">*</span><?php echo lang('billType'); ?> :</label>
                                <select class="form-control" name="billType" id="billType"  onchange="get_ownerBills(this.value)">
                                    <option value="">Please Select </option>
                                    <option value="<?php echo lang('utility_services')?>"
                                        <?php echo !empty($billtype) && $billtype == lang('utility_services') ? "selected" : "" ; ?>>
                                        <?php echo lang('utility_services')?></option>
                                    <option value="<?php echo lang('Request_services')?>"
                                        <?php echo !empty($billtype) && $billtype == lang('Request_services') ? "selected" : "" ; ?>>
                                        <?php echo lang('Request_services')?></option>
                                </select>
                            </div>
						   
							  <div class="form-group col-md-6">
                                <label for="unit"> <span style="color:red;">*</span><?php echo lang('Bill_no'); ?>
                                    :</label>
                                <select class="form-control " id="bill" name="bill"  onchange="get_billAmount(this.value)">
                                    <option value="">Please Select </option>
									<?php if(isset($billlist)){ foreach($billlist as $item) {		 ?>
                                    <option value="<?php  echo $item->id ?>"
                                        <?php  if(isset($bill_id)){ echo $bill_id == $item->id ?'selected':'' ;  } ?>>
                                        <?php echo $item->rfno  ?></option>
                                    <?php } }    ?>
                                    
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
                                    value=" <?php if(!empty($bill_amount)){ echo $bill_amount;  }    ?>" readonly>
									 <input type="hidden" class="form-control allowdecimalpoint" name="bill_refernceno" id="bill_refernceno"
                                    value=" <?php if(!empty($bill_refernceno)){ echo $bill_refernceno;  }   ?>" readonly>
                            </div>
							 <div class="form-group col-md-6">
                                <label for="paid_amount"> <span
                                        style="color:red;">*</span><?php echo lang('paid_amount'); ?> :</label>
                                <input type="text" class="form-control allowdecimalpoint" name="paidamount" 
                                    value=" <?php if(!empty($paid_amount)){ echo $paid_amount;  }  ?>">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="Details"> <span style="color:red;">*</span><?php echo lang('Note'); ?>
                                    :</label>
                                <textarea name="Note"
                                    class="form-control"><?php if(!empty($Note)){ echo $Note;  }   ?></textarea>
                            </div>
                          
                        </div>
                        <div class="box-footer">
                            <input type="hidden" name="id" value="<?php if(isset($id)){ echo $id; } ?>">
                            <input class="btn btn-primary billpaymentformsave" type="submit" value="Save" />
                        </div>
                    </form>
                </div><!-- /.box-body -->
            </div><!-- /.box -->

        </div><!-- /.col -->
    </div><!-- /.row -->
</section>