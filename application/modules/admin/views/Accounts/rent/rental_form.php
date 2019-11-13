<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/chosen.min.css">

<link href='<?php echo base_url()?>assets/assets/plugin/daterangepicker/daterangepicker-bs3.css' rel='stylesheet'media='screen'>
<link href='<?php echo base_url()?>assets/assets/plugin/datepicker/datepicker3.css' rel='stylesheet' media='screen'>
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<p class="error" style="padding:21px;"></p>
<style>
div[id="l_category"] {
    display: none;
}

input[class="child_absent"]:checked~div[id="l_category"] {
    display: block;
}

.child_absent {
    float: left;
}

div[id="check_in"] {
    display: none;
}

input[class="child_present"]:checked~div[id="check_in"] {
    display: block;
}

.child_present {
    float: left;
}
</style>

<div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-12" data-offset="0">
                <div class="wrap-fpanel" style="padding:0 24px;">
                    <div class="box box-primary" data-collapsed="0">
                        <div class="box-header with-border bg-primary-dark">
                            <h4 style="font-weight:bold;margin-left:12px;"><?= lang('generate_rental') ?></h4>
                        </div>
                       
                            <?php echo form_open('admin/accounts/rental', array('class' => 'form-horizontal rentalform')) ?>
                            <div class="panel_controls">
							  <div class="form-group margin">
                                    <label class="col-sm-3 control-label"><?= lang('project') ?> <span
                                            class="required">*</span></label>
                                    <div class="col-sm-5">
                                        <div class="input-group">
                                   <select name="project_id" id="project" class="form-control "
                                         onchange="get_building(this.value)" style="width:100%;">
                                       <option value="">Please Select </option>
                                       <?php if(isset($project)){ foreach($project as $item) {		 ?>
                                       <option value="<?php  echo $item->id ?>"
                                        <?php echo set_select('project_id',$item->id, ( !empty($project_id) && $project_id == $item->id ? TRUE : FALSE )); ?>><?php echo $item->Name  ?></option>
                                         <?php } }    ?>
                                    </select>
                                        </div>
                                    </div>
                                </div>
								  <div class="form-group margin">
                                    <label class="col-sm-3 control-label"><?= lang('building') ?> <span
                                            class="required">*</span></label>
                                    <div class="col-sm-5">
                                        <div class="input-group">
                                            <select name="building_id" class="form-control" id="building"
                                    onchange="get_buildingtenant(this.value)">
                                    <option value="">Please Select </option>
                                    <?php if(isset($buildings)){ foreach($buildings as $item) {		 ?>
                                    <option value="<?php  echo $item->bldid ?>"
                                        <?php  if(isset($building_id)){ echo $building_id == $item->bldid ?'selected':'' ;  } ?>>
                                        <?php echo $item->name  ?></option>
                                    <?php } }    ?>
                                </select>
                                        </div>
                                    </div>
                                </div>
								  <div class="form-group ">
                                    <label class="col-sm-3 control-label"><?= lang('tenant') ?> <span
                                            class="required">*</span></label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                          <select name="tenant_id" class="form-control" id="owner"
                                    onchange="get_tenantUnits(this.value)">
                                    <option value="">Please Select </option>
                                    <?php if(isset($owners)){ foreach($owners as $item) {		 ?>
                                    <option value="<?php  echo $item->ownid ?>"
                                        <?php  if(isset($owner_id)){ echo $owner_id == $item->ownid ?'selected':'' ;  } ?>>
                                        <?php echo $item->full_name  ?></option>
                                    <?php } }    ?>
                                </select>
                                        </div>
                                    </div>
                                </div>
								  <div class="form-group ">
                                    <label class="col-sm-3 control-label"><?= lang('unit') ?> <span
                                            class="required">*</span></label>
                                    <div class="col-sm-5">
                                        <div class="input-group">
                                            <select class="form-control " id="unit" name="unit_id" onchange="get_Unitsdetails(this.value)">
                                    <option value="">Please Select </option>
                                    <?php if(isset($ownerunits)){ foreach($ownerunits as $item) {		 ?>
                                    <option value="<?php  echo $item->uid ?>"
                                        <?php  if(isset($unit_id)){ echo $unit_id == $item->uid ?'selected':'' ;  } ?>>
                                        <?php echo $item->unit_name  ?></option>
                                    <?php } }    ?>
                                </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="col-sm-3 control-label"><?= lang('date') ?> <span
                                            class="required">*</span></label>
                                     <div class="col-sm-2">
                                        <div class="input-group">
                                            <input type="text" name="month" id="date" class="form-control monthyear "
                                                value="<?php
                                                if (!empty($months)) {
                                                    echo date('Y-n', strtotime($months));
                                                }
                                                ?>">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group salerevenue">
                                   
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-5">
                                        <button type="submit" id="sbtn" name="sbtn" value="1"
                                            class="btn bg-olive btn-md btn-flat"><?= lang('go') ?></button>
                                    </div>
                                </div>
                            </div>
                            <?php echo form_close() ?>
                           
</div>
</div>
</div>
</div>
</div>
</div>
</div>

<script>
$(function() {
    $('#date').datepicker({
        autoclose: true,
        format: "yyyy-mm",
        startView: "months",
        minViewMode: "months"
    });
});
</script>
<script>
$('form').attr('autocomplete', 'off');
</script>