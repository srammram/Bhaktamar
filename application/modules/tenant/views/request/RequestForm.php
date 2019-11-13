<link href="<?php echo base_url('assets/admin/plugins/iCheck/all.css')?>" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap-3.3.2.min.css" type="text/css">
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/jquery-2.1.3.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/js/bootstrap-3.3.2.min.js" type="text/css">
<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap-multiselect.css" type="text/css">
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/bootstrap-multiselect.js"></script>
<style>
.error {
    color: #FF0000;
}
</style>
<?php   $seg= $this->uri->segment(5);?>
<section class="content-header">
    <h1>
        <?php echo $page_title; ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('tenant/dashboard') ?>"><i class="fa fa-dashboard"></i>
                <?php echo lang('dashboard')?></a></li>
        <li><a href="<?php echo site_url('tenant/request/Clientform') ?>"> <?php echo lang('Client')?> </a></li>
        <li class="active"><?php echo (empty($seg))?lang('add'):lang('edit');?></li>
    </ol>
</section>
<br>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><?php echo lang('request_form'); ?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <form method="post" action="<?php echo site_url('tenant/request/request_form/'.$id); ?>"
                        enctype="multipart/form-data" id="requestform">

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label><?php echo lang('title') ?></label>
                                </div>
                                <div class="col-md-3 title">
                                    <input type="text" name="title" class="form-control " autocomplete='off'
                                        value="<?php if(isset($title)){ echo $title;  }   ?>">
                                </div>
                                <div class="col-md-2">
                                    <label><?php echo lang('date') ?></label>
                                </div>
                                <div class="col-md-3 date">
                                    <input type="text" name="date" class="form-control datepicker" autocomplete='off'
                                        value="<?php if(isset($date)){ echo $date;  }   ?>" onkeydown="return false" >
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label><?php echo lang('requesttype') ?></label>
                                </div>
                                <div class="col-md-3">
                                    <select name="requesttype" class="form-control" onchange="get_category(this.value)">
                                        <option><?php echo lang('select')?></option>
                                        <?php 
								if(isset($requesttypes)){
									foreach($requesttypes as $row){
									?>
                                        <option value="<?php  echo $row->id   ?>"
                                            <?php  if(isset($Requesttypid)){ echo $Requesttypid == $row->id ?'selected':'' ;  } ?>>
                                            <?php  echo $row->Name  ?></option>
                                        <?php
									}
								}
								?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label><?php echo lang('categorytype') ?></label>
                                </div>
                                <div class="col-md-3">
                                    <select name="categorytype" class="form-control" id="category"
                                        onchange="get_subcategory(this.value)">
                                        <option>Select</option>
                                        <?php 
								if(isset($category)){
									foreach($category as $item){
									?>
                                        <option value="<?php  echo $item->id   ?>"
                                            <?php  if(isset($categoryid)){ echo $categoryid == $item->id ?'selected':'' ;  } ?>>
                                            <?php  echo $item->Name  ?></option>
                                        <?php
									}
								}
								?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label><?php echo lang('subtype') ?></label><span style="color:red"> *</span>
                                </div>
                                <div class="col-md-3">
                                    <select name="subcategory" class="form-control" id="subcategory"
                                        onchange="get_subcategory_details(this.value)">
                                        <option>Select</option>
                                        <?php 
							    	if(isset($Subcategory)){
									foreach($Subcategory as $item){
									?>
                                        <option value="<?php  echo $item->id   ?>"
                                            <?php  if(isset($subcategoryid)){ echo $subcategoryid == $item->id ?'selected':'' ;  } ?>>
                                            <?php  echo $item->Name  ?></option>
                                        <?php
									}
								}
								?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label><?php echo lang('description') ?></label>
                                </div>
                                <div class="col-md-3">
                                    <textarea name="description" autocomplete="off"
                                        class="form-control"><?php if(isset($description)){ echo $description;  }   ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-2">
                                        <label><?php echo lang('services_cost') ?></label>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" id="price" name="service_cost"
                                            class="form-control datepicker" autocomplete='off'
                                            value="<?php if(isset($price)){ echo $price;  }   ?>" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="box-footer">
                                <input class="btn btn-primary" type="submit" id="request" value="Save" />
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
<script>
$(function() {
    $('.datepicker').datepicker({
        todayHighlight: true,
        autoclose: true,
        format: 'yyyy-mm-dd',
    });

});
</script>

<script type="text/javascript">
$(document).ready(function() {
    $('#my-select').multiselect();
});
</script>