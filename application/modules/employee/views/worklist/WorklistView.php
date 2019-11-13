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
	.form-control{border: none;box-shadow: none;}
	.form-control:hover,.form-control:focus{box-shadow: none;outline: none;border:none;}
	.form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control{background-color: transparent;}
	select::-ms-expand {
    display: none;
}
	select {
    -webkit-appearance: none;
    -moz-appearance: none;
    text-indent: 1px;
    text-overflow: '';
}
</style>
<?php   $seg= $this->uri->segment(5);?>
<section class="content-header">
    <h1>
        <?php echo $page_title; ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i>
                <?php echo lang('dashboard')?></a></li>
        <li><a href="<?php echo site_url('admin/crm/Crm/Clientform') ?>"> <?php echo lang('Client')?> </a></li>
        <li class="active"><?php echo (empty($seg))?lang('add'):lang('edit');?></li>
    </ol>
</section>
<br>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><?php echo lang('Worklist_View'); ?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                   

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label><?php echo lang('title') ?></label>
                                </div>
                                <div class="col-md-3 title">
                                   <?php if(isset($title)){ echo $title;  }   ?>
                                </div>
                                <div class="col-md-2">
                                    <label><?php echo lang('date') ?></label>
                                </div>
                                <div class="col-md-3 date">
                                  <?php if(isset($date)){ echo $date;  }   ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label><?php echo lang('requesttype') ?></label>				
                                </div>
                                <div class="col-md-3">
                                    <select name="requesttype" class="form-control" disabled>
                                         <option><?php echo lang('select')?></option>
                                <?php 
								if(isset($requesttypes)){
									foreach($requesttypes as $row){
									?>
                                        <option value="<?php  echo $row->id   ?>"
                                            <?php  if(isset($requesttypid)){ echo $requesttypid == $row->id ?'selected':'' ;  } ?>>
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
                                    <select name="categorytype" class="form-control" id="category" disabled>
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
                                    <label><?php echo lang('subtype') ?></label><span style="color:red" > *</span>
                                </div>
                                <div class="col-md-3">
                                    <select name="subcategory" class="form-control" id="subcategory"disabled>
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
                                    <label><?php echo lang('Owner_description') ?></label>
                                </div>
                                <div class="col-md-3">
                                    <textarea name="description" autocomplete="off"
                                        class="form-control" disabled><?php if(isset($description)){ echo $description;  }   ?></textarea>
                                </div>
								</div>
								</div>
								  <div class="form-group">
                              <div class="row">
								 <div class="col-md-2">
                                    <label><?php echo lang('admin_note') ?></label>
                                </div>
                                <div class="col-md-3">
                                    <textarea name="admin_note" autocomplete="off"
                                        class="form-control" disabled><?php if(isset($admin_note)){ echo $admin_note;  }   ?></textarea>
                                </div>
								 <div class="col-md-2">
                                    <label><?php echo lang('Venue') ?></label>
                                </div>
                                <div class="col-md-3">
                                    <textarea name="Venue" autocomplete="off"
                                        class="form-control" disabled><?php if(isset($venue_details)){

//echo nl2br($venue_details->ownername);  
echo $venue_details->permanent_address;

										 }   ?></textarea>
                                </div>
                            </div>
                        </div>
						 <div class="form-group">
                              <div class="row">
								 <div class="col-md-2">
                                    <label><?php echo lang('note') ?></label>
                                </div>
                                <div class="col-md-3">
                                    <textarea name="Note" autocomplete="off"
                                        class="form-control"  disabled><?php if(isset($assignee_comments)){ echo $assignee_comments;  }   ?></textarea>
                                </div>
								 <div class="col-md-2">
                                    <label><?php echo lang('picture') ?></label>
                                </div>
                                <div class="col-md-3">
                                 
								<img class="form-control" src="<?php  echo base_url('uploads/worklist_image') ; ?>/<?php if(!empty($picture)){ echo $picture ; }else{ echo 'noimage.jpg' ; }  ?>" style="height:120px;width:120px;" id="output"/>
                            </div>
							</div>
                        </div>
						<div class="form-group">
                              <div class="row">
								 <div class="col-md-2">
                                    <label><?php echo lang('status') ?></label>
                                </div>
                                <div class="col-md-3">
                                  <select name="request_status" class="form-control"  disabled>
                                        <option ><?php echo lang('select');  ?></option>
		                       <option value="<?php echo lang('Initiated'); ?>" <?php if(!empty($status)) echo $status ==    lang('Initiated') ? 'selected':''   ?>><?php echo lang('Initiated');  ?></option>
		                        <option value="<?php echo lang('Inprogress'); ?>" <?php if(!empty($status)) echo $status == lang('Inprogress') ?'selected':''  ?>><?php echo lang('Inprogress'); ?></option>
			                   <option value="<?php echo lang('Accepted'); ?>" <?php if(!empty($status)) echo $status == lang('Accepted') ?'selected':''  ?>><?php echo lang('Accepted'); ?></option>
			                    <option value="<?php echo lang('ReInitiated'); ?>" <?php if(!empty($status)) echo $status == lang('ReInitiated') ?'selected':''  ?>><?php echo lang('ReInitiated'); ?></option>
			                    <option value="<?php echo lang('Completed'); ?>" <?php if(!empty($status)) echo $status == lang('Completed') ?'selected':''  ?>><?php echo lang('Completed'); ?></option>
                                    </select>
                                </div>
								 <div class="col-md-2">
                                    <label><?php echo lang('requestBy') ?></label>
                                </div>
                                <div class="col-md-3">
                                   <input type="text" readonly class="form-control " autocomplete='off'
                                        value="<?php if(!empty($requestby->Name)){ echo $requestby->Name;  }   ?>">
                                </div>
                            </div>
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