<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/chosen.min.css">
<link rel="stylesheet" href="<?php echo base_url('assets/admin/') ?>/plugins/datepicker/datepicker3.css">
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/bootstrap-multiselect.js"></script>
<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap_search_select.min.css">
<script src="<?php echo base_url('assets/admin')?>/dist/js/bootstrap_select.min.js"></script>
<script src="<?php echo base_url('assets/admin')?>/dist/js/chosen.jquery.min.js"></script>
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
        <?php echo $page_title; ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i>
                <?php echo lang('dashboard')?></a></li>
        <li><a href="<?php echo site_url('admin/Fund/reserve_fund_form') ?>"> <?php echo lang('reserve_fund_form')?>
            </a></li>
        <li class="active"><?php echo (empty($seg))?lang('add'):lang('edit');?></li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
              <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">
					<?php echo lang('reserve_fund_form')?>
                    </h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <form method="post" action="<?php echo site_url('admin/Fund/reserve_fund_form/'.$id); ?>"
                        enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group  col-md-6">
                                <label for="ddlOwnerName"><?php echo lang('Owner_Name')?> :</label>
                                <select name="ownerid" id="ddlOwnerName" class="form-control chosen">
                                    <option value=""><?php echo lang('select');  ?></option>
                                    <?php  
			                        if(isset($Owners)){ foreach($Owners as $Owner){
			                                 ?>
                                    <option value="<?php echo $Owner->ownid ; ?>"
                                        <?php if(!empty($owner_id)) echo $owner_id == $Owner->ownid ?'selected':''  ?>>
                                        <?php echo $Owner->full_name ; ?></option>
                                    <?php
				                           }
			                               }
			                               ?>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="ddlMonth"><?php echo lang('paid_date')?>:</label>
                                <input type="text" name="paiddate"
                                    value="<?php if(isset($f_date)){ echo ($f_date); } ?>"
                                    id="txtCDate" class="form-control datepicker" onkeydown="return false" />
                            </div>
                            <div class="form-group  col-md-6">
                                <label for="startdate"><?php echo lang('start_date')?>:</label>
                                <input type="text" name="startdate" value="<?php if(isset($start_date)){ echo $start_date; } ?>"
                                    id="startdate" class="form-control datepicker" onkeydown="return false"  />
                            </div>
							 <div class="form-group  col-md-6">
                                <label for="enddate"><?php echo lang('end_date')?>:</label>
                                <input type="text" name="enddate" value="<?php if(isset($end_date)){ echo $end_date; } ?>"
                                    id="enddate" class="form-control datepicker"  onkeydown="return false" />
                            </div>
							 <div class="form-group  col-md-6">
                                 <label for="totalamount"> <?php echo lang('Total_amount')?>:</label>
                                <input type="text" name="totalamount" value="<?php if(isset($total_amount)){ echo $total_amount; } ?>"
                                    id="totalamount" class="form-control allowdecimalpoint" />
                            </div>
							 <div class="form-group  col-md-6">
                               <label for="txtPurpose"><?php echo lang('Fund_purpose')?>:</label>
                                <textarea name="txtPurpose" id="txtPurpose"
                                    class="form-control"><?php if(isset($purpose)){ echo $purpose; } ?></textarea>
                                <input type="hidden" name="id" value="<?php if(isset($id)){ echo $id; } ?>">
                            </div>
                           <!--  <div class="form-group  ">
                                <div class="col-md-6">
                                    <label><?php echo lang('maintenance_services') ?></label><br>
                                    <select id="boot-multiselect-demo" class="boot-multiselect-demo" multiple="multiple"
                                        name="maintenance_services[]">
                                        <?php  if(!empty($maintenanceservices)){ foreach($maintenanceservices as $item){  ?>
                                        <?php     $selected = in_array( $item->id, $ms ) ? ' selected="selected" ' : '';     ?>
                                        <option value="<?php  echo $item->id ?>" <?php echo $selected; ?>>
                                            <?php echo $item->Name  ?></option>
                                        <?php   }  }  ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
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
                            </div>
                       -->
                </div>
                <div class="box-footer">
                    <input class="btn btn-primary" type="submit" value="Save" />
                </div>
                </form>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
    </div><!-- /.row -->
</section>

<script src="<?php echo base_url('assets/plugin/moment.min.js')?>"></script>
<script src="<?php echo base_url('assets/admin/plugins/daterangepicker/daterangepicker.js')?>"></script>
<script src="<?php echo base_url('assets/admin/plugins/iCheck/icheck.min.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/') ?>/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url('assets/admin/plugins')?>/jquery-validation/jquery.validate.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    $('#my-select').multiselect();
});
</script>

<script>
$(function() {
    $('.datepicker').datepicker({
        todayHighlight: true,
        autoclose: true,
        format: 'yyyy-mm-dd',
    });
    $('.datepicker1').datepicker({
        todayHighlight: true,
        autoclose: true,
        format: 'yyyy-mm',
    });
    $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
    });
});
</script>