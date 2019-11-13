<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/chosen.min.css">
<link rel="stylesheet" href="<?php echo base_url('assets/admin/') ?>/plugins/datepicker/datepicker3.css">
<script src="<?php echo base_url('assets/admin')?>/dist/js/chosen.jquery.min.js"></script>

<script src="<?php echo base_url('assets/admin')?>/dist/js/bootstrap_select.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {

    $('.boot-multiselect-demo').multiselect({
        includeSelectAllOption: true,
        buttonWidth: 420,
        enableFiltering: true
    });
});
</script>
<?php  $seg= $this->uri->segment(4);?>
<section class="content-header">
    <h1>
        <?php echo $page_title;  ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i>
                <?php echo lang('dashboard')?></a></li>
        <li><a href="<?php echo site_url('admin/accounts/bill_form') ?>"> <?php echo lang('bill')?> </a></li>
        <li class="active"><?php echo (empty($seg))?lang('add'):lang('edit');?></li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <form method="post" action="<?php echo site_url('admin/Accounts/bill_form/'.$id); ?>"
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
                                <label for="project_id"><?php echo lang('project')?>:</label>
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
                                <label for="building"><?php echo lang('building')?>:</label>
                                <select name="building_id" class="form-control" id="building"
                                    onchange="get_buildingOwners(this.value)">
                                    <option><?php echo lang('select')?></option>
                                    <?php if(isset($buildings)){ foreach($buildings as $item) {		 ?>
                                    <option value="<?php  echo $item->bldid ?>"
                                        <?php  if(isset($building_id)){ echo $building_id == $item->bldid ?'selected':'' ;  } ?>>
                                        <?php echo $item->name  ?></option>
                                    <?php } }    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="owner"><?php echo lang('Owner')?>:</label>
                                <select name="owner_id" class="form-control" id="owner"
                                    onchange="get_ownerUnits(this.value)">
                                    <option><?php echo lang('select')?></option>
                                    <?php if(isset($owners)){ foreach($owners as $item) {		 ?>
                                    <option value="<?php  echo $item->ownid ?>"
                                        <?php  if(isset($owner_id)){ echo $owner_id == $item->ownid ?'selected':'' ;  } ?>>
                                        <?php echo $item->full_name  ?></option>
                                    <?php } }    ?>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="unit"> <span style="color:red;">*</span><?php echo lang('unit'); ?>
                                    :</label>
                                <select class="form-control " id="unit" name="unit_id">
                                    <option>Please Select </option>
                                    <?php if(isset($ownerunits)){ foreach($ownerunits as $item) {		 ?>
                                    <option value="<?php  echo $item->uid ?>"
                                        <?php  if(isset($unit_id)){ echo $unit_id == $item->uid ?'selected':'' ;  } ?>>
                                        <?php echo $item->unit_name  ?></option>
                                    <?php } }    ?>
                                </select>
                            </div>
                              <div class="form-group  col-md-6">
                                    <label><?php echo lang('Other_services') ?></label>
                                    <br>
                                    <select id="boot-multiselect-demo" class="boot-multiselect-demo" multiple="multiple"
                                        name="services[]">
                                        <?php  if(!empty($services_list)){ foreach($services_list as $item){  ?>
                                        <?php     $selected = in_array( $item->id, $services ) ? ' selected="selected" ' : '';     ?>
                                        <option value="<?php  echo $item->id ?>" <?php echo $selected; ?>>
                                            <?php echo $item->Service_name  ?></option>
                                        <?php   }  }  ?>
                                    </select>
                                </div>
                            <div class="form-group col-md-6">
                                <label for="Issue_date"> <span
                                        style="color:red;">*</span><?php echo lang('Issue_date'); ?> :</label>
                                <input type="text" name="Issue_date" class="form-control datepicker"
                                    value=" <?php if(!empty($Issued_date)){ echo $Issued_date;  }else{ echo set_value('Issue_date') ; }   ?>" onkeydown="return false" >
                            </div>
                            <div class="form-group col-md-6">
                                <label for="Bill_Date"> <span
                                        style="color:red;">*</span><?php echo lang('Bill_Date'); ?> :</label>
                                <input type="text" name="Bill_Date" class="form-control datepicker"
                                    value=" <?php if(!empty($bill_date)){ echo $bill_date;  }else{ echo set_value('Bill_Date') ; }   ?>" onkeydown="return false" >
                            </div>
                            <div class="form-group col-md-6">
                                <label for="Total_amount"> <span
                                        style="color:red;">*</span><?php echo lang('Total_amount'); ?> :</label>
                                <input type="text" class="form-control allowdecimalpoint" name="Total_amount"
                                    value=" <?php if(!empty($total_amount)){ echo $total_amount;  }else{ echo set_value('Total_amount') ; }   ?>">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="Details"> <span style="color:red;">*</span><?php echo lang('Details'); ?>
                                    :</label>
                                <textarea name="Details"
                                    class="form-control"><?php if(!empty($bill_details)){ echo $bill_details;  }else{ echo set_value('Details') ; }   ?></textarea>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="Paid_status"> <span
                                        style="color:red;">*</span><?php echo lang('Paid_status'); ?> :</label>
                                <select class="form-control" name="Paid_status">
                                    <option>Please Select </option>
                                    <option value="<?php echo lang('Paid_paid')?>"
                                        <?php echo set_select('Paid_status',lang('Paid_paid'), ( !empty($Paid_Status) && $Paid_Status == lang('Paid_paid') ? TRUE : FALSE )); ?>>
                                        <?php echo lang('Paid_paid')?></option>
                                    <option value="<?php echo lang('Paid_Unpaid')?>"
                                        <?php echo set_select('Paid_status',lang('Paid_Unpaid'), ( !empty($Paid_Status) && $Paid_Status == lang('Paid_Unpaid') ? TRUE : FALSE )); ?>>
                                        <?php echo lang('Paid_Unpaid')?></option>
                                </select>
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


<script src="<?php echo base_url('assets/admin/') ?>/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url('assets/admin/plugins')?>/jquery-validation/jquery.validate.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    $('#my-select').multiselect();
});
</script>