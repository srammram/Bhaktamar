<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap-datepicker.min.css">
<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap-select.min.css">
<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/chosen.min.css">
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/bootstrap-multiselect.min.js"></script>
<script src="<?php echo base_url('assets/admin')?>/dist/js/chosen.jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/bootstrap-select.min.js"></script>
<?php  $seg= $this->uri->segment(4);?>
<section class="content-header" style="padding: 15px 0px;">
    <h1><?php echo $page_title; ?></h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i>
                <?php echo lang('dashboard')?></a></li>
        <li><a href="<?php echo site_url('admin/Ex_staff') ?>"> <?php echo lang('External_staff')?> </a></li>
        <li class="active"><?php echo (empty($seg))?lang('add'):lang('edit');?></li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <form method="post" action="<?php echo site_url('admin/Ex_staff/form/'.$id); ?>"
                        enctype="multipart/form-data" id="ownerform">
						 <div class="form-group col-md-6">
                            <label for="resident_relationship"><?php echo lang('resident_relationship')?> <span class="errorStar">*</span>
                                :</label>
                            <select class="form-control chosen" name="resident_relationship">
                                <option value="">select</option>
                                <option value="<?php echo lang('family_member')?>"
                                    <?php  if(isset($relatiotype)){ echo $relatiotype == lang('family_member')  ?'selected':'' ;  } ?>>
                                    <?php echo lang('family_member')?></option>
                                <option value="<?php echo lang('tenant')?>"
                                    <?php  if(isset($relatiotype)){ echo $relatiotype == lang('tenant')  ?'selected':'' ;  } ?>>
                                    <?php echo lang('tenant')?></option>
                                <option value="<?php echo lang('assitant')?>"
                                    <?php  if(isset($relatiotype)){ echo $relatiotype == lang('assitant')  ?'selected':'' ;  } ?>>
                                    <?php echo lang('assitant')?></option>
                            </select>
                        </div>
						 <div class="form-group col-md-6">
                            <label for="Occupancy_status"><?php echo lang('Occupancy_status')?> <span class="errorStar">*</span>
                                :</label>
                            <select class="form-control chosen" name="Occupancy_status">
                                <option value="">select</option>
                                <option value="<?php echo lang('active')?>"
                                    <?php  if(isset($occupy_status)){ echo $occupy_status == lang('active')  ?'selected':'' ;  } ?>>
                                    <?php echo lang('active')?></option>
                                <option value="<?php echo lang('inactive')?>"
                                    <?php  if(isset($occupy_status)){ echo $occupy_status == lang('inactive')  ?'selected':'' ;  } ?>>
                                    <?php echo lang('inactive')?></option>
                            </select>
                        </div>
						<div class="form-group col-md-6">
                            <label for="job_title">
                                <?php echo lang('job_title')?>:</label>
                            <input type="text" name="job_title"  value=" <?php if(isset($job_title)){ echo $job_title ; } ?>"
                                class="form-control " />
                        </div>
						<div class="form-group col-md-6">
                            <label for="company_name">
                                <?php echo lang('company_name')?>:</label>
                            <input type="text" name="company_name"  value=" <?php if(isset($company_name)){ echo $company_name ; } ?>"
                                class="form-control " />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="fullname"><?php echo lang('fullname')?> <span
                                    class="errorStar">*</span>:</label>
                            <input type="text" name="fullname"
                                value="<?php if(isset($full_name)){ echo $full_name ; } ?>" id="fullname"
                                class="form-control" autocomplete="off" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="salutation"><?php echo lang('Salutation')?> <span class="errorStar">*</span>
                                :</label>
                            <select class="form-control chosen" name="salutation">
                                <option value="">select</option>
                                <option value="<?php echo lang('Mr')?>"
                                    <?php  if(isset($salutation)){ echo $salutation == lang('Mr')  ?'selected':'' ;  } ?>>
                                    <?php echo lang('Mr')?></option>
                                <option value="<?php echo lang('Ms')?>"
                                    <?php  if(isset($salutation)){ echo $salutation == lang('Ms')  ?'selected':'' ;  } ?>>
                                    <?php echo lang('Ms')?></option>
                                <option value="<?php echo lang('Mrs')?>"
                                    <?php  if(isset($salutation)){ echo $salutation == lang('Mrs')  ?'selected':'' ;  } ?>>
                                    <?php echo lang('Mrs')?></option>
                                <option value="<?php echo lang('Dr')?>"
                                    <?php  if(isset($salutation)){ echo $salutation == lang('Dr')  ?'selected':'' ;  } ?>>
                                    <?php echo lang('Dr')?></option>
                            </select>
                        </div>
						
                        <div class="form-group col-md-6">
                            <label for="surname"><?php echo lang('surname')?>
                                :</label>
                            <input type="text" name="surname" value="<?php if(isset($surname)){ echo $surname ; } ?>"
                                id="surname" class="form-control" autocomplete="off" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="firstname"><?php echo lang('firstname')?>:</label>
                            <input type="text" name="firstname"
                                value=" <?php if(isset($firstname)){ echo $firstname ; } ?>" id="firstname"
                                class="form-control" autocomplete="off" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="nationality"><?php echo lang('Nationality')?>
                                :</label>
                                <select class="form-control chosen" name="nationality">
                                <option>Select </option>
                                <?php  foreach($nationalitylist as $item){ ?>
                                <option value="<?php echo $item->NationalityID ?>"
                                    <?php if(!empty($nationality)) echo $nationality == $item->NationalityID ?'selected':''  ?>>
                                    <?php echo $item->Nationality ?></option>
                                <?php }				?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="dob">
                                <?php echo lang('DOB')?>:</label>
                            <input type="text" name="dob" id="dob" value=" <?php if(isset($dob)){ echo $dob ; } ?>"
                                class="form-control datepicker"  onkeydown="return false"  />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="sex"><?php echo lang('Sex')?>:</label>
                            <select class="form-control chosen" name="sex">
                                <option value="">select</option>
                                <option value="<?php echo lang('Male')?>"
                                    <?php  if(isset($sex)){ echo $sex == lang('Male')  ?'selected':'' ;  } ?>>
                                    <?php echo lang('Male')?></option>
                                <option value="<?php echo lang('Female')?>"
                                    <?php  if(isset($sex)){ echo $sex == lang('Female')  ?'selected':'' ;  } ?>>
                                    <?php echo lang('Female')?></option>
                                <option value="<?php echo lang('transgender')?>"
                                    <?php  if(isset($sex)){ echo $sex == lang('transgender')  ?'selected':'' ;  } ?>>
                                    <?php echo lang('transgender')?></option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="idtype"><?php echo lang('Id_type')?>:</label>
                            <select class="form-control chosen" name="idtype">
                                <option>Select </option>
                                <?php  foreach($idtype as $item){ ?>
                                <option value="<?php echo $item->id ?>"
                                    <?php if(!empty($id_type)) echo $id_type == $item->id ?'selected':''  ?>>
                                    <?php echo $item->id_type_name ?></option>
                                <?php }				?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="idno"><?php echo lang('Id_no')?>:</label>
                            <div>
                                <input type="text" name="id_no" id="id_no"
                                    value=" <?php if(isset($id_no)){ echo $id_no ; } ?>" class="form-control allownumber"
                                    autocomplete="off" />
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="primary_phone"><?php echo lang('Primary_phone')?>:</label>
                            <input type="text" name="primary_phone" id="primary_phone"
                                value=" <?php if(isset($primary_phone)){ echo $primary_phone ; } ?>"
                                class="form-control allownumber" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="handphone"><span
                                    class="errorStar">*</span><?php echo lang('handphone')?>:</label>
                            <input type="text" name="handphone"
                                value="<?php if(isset($handphone)){ echo $handphone ; } ?>" id="handphone"
                                class="form-control allownumber" autocomplete="off" />
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-sm-12"
                                style="padding-left:0px;"><?php echo lang('add_communication_app') ?></label>
                            <div data-role="dynamic-fields">
                                <?php  if(!empty($app_communication_details)){
								foreach ($app_communication_details as $item) {  ?>
                                <div class="form-inline">
                                    <div class="form-group col-md-5"
                                        style="padding-left:0px;padding-right:5px;margin-bottom:5px;">
                                        <input type="text" name="Appname[]" class="form-control"
                                            value="<?php echo $item->Appname;   ?>" placeholder="App name" />
                                    </div>
                                    <div class="form-group col-md-5"
                                        style="padding-left:0px;padding-right:15px;margin-bottom:5px;">
                                        <input type="text" name="Appid[]" class="form-control"
                                            value="<?php echo $item->Appid;   ?>" placeholder="App id" />
                                    </div>
                                    <button class="btn btn-danger btn_dan btn-sm" data-role="remove">
                                        <span class="glyphicon glyphicon-remove"></span>
                                    </button>
                                </div>
                                <?php   }
							}		?>

                            </div>
                            <div data-role="dynamic-fields">
                                <div class="form-inline">
                                    <div class="form-group">
                                        <input type="text" name="Appname[]" class="form-control"
                                            placeholder="App name" />
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="Appid[]" class="form-control" placeholder="App id" />
                                    </div>
                                    <button class="btn btn-danger btn-sm" data-role="remove">
                                        <span class="glyphicon glyphicon-remove"></span>
                                    </button>
                                    <button class="btn btn-primary btn-sm" data-role="add">
                                        <span class="glyphicon glyphicon-plus"></span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="permanent_address"><?php echo lang('permanent_address')?>:</label>
                            <input type="text" name="permanent_address"
                                value="<?php if(isset($permanent_address)){ echo $permanent_address ; } ?>"
                                id="permanent_address" class="form-control" autocomplete="off" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="assigned_project"><?php echo lang('assigned_project')?>:</label>

                            <select name="assigned_project" id="project" class="form-control chosen"
                                onchange="get_unitByproject(this.value)">
                                <option><?php echo lang('select')?></option>
                                <?php if(isset($project)){ foreach($project as $item) {		 ?>
                                <option value="<?php  echo $item->id ?>"
                                    <?php  if(isset($project_id)){ echo $project_id == $item->id ?'selected':'' ;  } ?>>
                                    <?php echo $item->Name  ?></option>
                                <?php } }    ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="assigned_unit"><?php echo lang('assigned_unit')?>:</label>
                            <select name="assigned_unit[]" class="form-control  assigned_unit">
							<?php if(!empty($projectunits)){ foreach($projectunits as $item){ $selected = in_array( $item->uid, $assigned_unit ) ? ' selected="selected" ' : '';     ?>  
								<option value="<?php  echo $item->uid ?>" <?php echo $selected; ?>>
                                     <?php echo $item->unit_name  ?></option>
								<?php  }  } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email"><?php echo lang('email')?>:</label>
                            <input type="email" name="email" value="<?php if(isset($email)){ echo $email ; } ?>"
                                id="email" class="form-control" autocomplete=off"" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="password"><?php echo lang('password')?>:</label>
                            <input type="text" name="password" value="<?php if(isset($password)){ echo $password ; } ?>"
                                id="password" class="form-control" />
                        </div>
                        <div class="form-group col-md-6">
                            <label><?php echo lang('attachment') ?></label>
                            <div data-role="dynamic-fields">
                                <div class="form-inline">
                                    <div class="form-group">
                                        <input type="file" name="attachment[]" multiple class="form-control" />
                                    </div>
                                    <button class="btn btn-danger btn-sm" data-role="remove">
                                        <span class="glyphicon glyphicon-remove"></span>
                                    </button>
                                    <button class="btn btn-primary btn-sm" data-role="add">
                                        <span class="glyphicon glyphicon-plus"></span>
                                    </button>
                                </div>
                            </div>
                            <?php  if(!empty($attachments)){ foreach(json_decode($attachments) as $doc){ 
                                                  if(!empty($doc)){  	?>
                            <!-- <a href="<?php echo  site_url('admin/Owner/download_attachment/'.$doc) ?> "
													 class="btn btn-default col-md-offset-1"><?php echo $doc ; ?></a> -->
                            <a style="margin-left:12px;"
                                href="<?php   echo  site_url('admin/Project/download_otherdoc/'.$doc)  ?>"
                                class="btn btn-xs btn-danger">
                                <i class="glyphicon glyphicon-download-alt"></i><?php    echo $doc; ?></a>
                            <span class="glyphicon glyphicon-remove"
                                onclick="delete_file('<?php echo $doc ; ?>')"></span><br>
                            <?php    } } } ?>
                        </div>
                        <div class="col-md-6">
                            <label>VIP</label>
                            <input type="checkbox" name="vip" value="1"
                                <?php if(!empty($vip) && $vip==1){ echo 'checked' ; } ?>>
                        </div>

                        <div class="box-footer">
                            <input type="hidden" name="id" value="<?php  if(!empty($external_staff_id)){ echo $external_staff_id ;  } ?>"
                                class="form-control" id="external_staff_id" />
                            <input class="btn btn-primary" id="residentsubmit" type="submit" value="Save" />
                        </div>
                    </form>
                </div><!-- /.box -->
            </div>
        </div>
    </div>
</section>
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
    $(document).on(
        'click',
        '[data-role="dynamic-fields"] > .form-inline [data-role="remove"]',
        function(e) {
            e.preventDefault();
            $(this).closest('.form-inline').remove();
        }
    );
    $(document).on(
        'click',
        '[data-role="dynamic-fields"] > .form-inline [data-role="add"]',
        function(e) {
            e.preventDefault();
            var container = $(this).closest('[data-role="dynamic-fields"]');
            new_field_group = container.children().filter('.form-inline:first-child').clone();
            new_field_group.find('input').each(function() {
                $(this).val('');
            });
            container.append(new_field_group);
        }
    );
});
</script>
<script>
function delete_file(str) {
    var external_staff_id = $('#external_staff_id').val();
    var postUrl = getBaseURL() + 'admin/Resident/doc_delete';
    $.ajax({
        type: "POST",
        url: postUrl,
        data: {
            doc: str,
            external_staff_id: external_staff_id
        },
        cache: false,
        success: function(result) {
            // location.reload(true);
        }
    });
}
</script>
<script type="text/javascript">
$(document).ready(function() {
    $('#my-select').multiselect();
});
</script>
<script>
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#displayimage')
                .attr('src', e.target.result)
                .width(150)
                .height(200);
        };

        reader.readAsDataURL(input.files[0]);
    }
}
</script>