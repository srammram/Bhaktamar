 <?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
 <script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/jquery.min.js"></script>
 <script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/bootstrap-multiselect.min.js"></script>
 <link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap.min.css">
 <link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap-datepicker.min.css">
 <link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/chosen.min.css">
 <script src="<?php echo base_url('assets/admin')?>/dist/js/chosen.jquery.min.js"></script>
 <style>
.btn-group {
    width: 100%;
}

.multiselect {
    width: 100%;
}

.multiselect-container {
    width: 100%;
}
 </style>
 <?php  $seg= $this->uri->segment(4);?>
 <section class="content-header">
     <h1>
         <?php echo $page_title; ?>
     </h1>
     <ol class="breadcrumb">
         <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i>
                 <?php echo lang('dashboard')?></a></li>
         <li><a href="<?php echo site_url('admin/Unit') ?>"> <?php echo lang('Units')?> </a></li>
         <li class="active"><?php echo (empty($seg))?lang('add'):lang('edit');?></li>
     </ol>
 </section>
 <section class="content">
     <div class="row">
         <div class="col-xs-12">
             <div class="box">
                 <div class="box-body">
                     <form method="post" action="<?php echo site_url('admin/Unit/form/'.$id); ?>"
                         enctype="multipart/form-data">
                         <div class="box-body">
                             <div class="form-group col-md-6">
                                 <label for="Project"><?php echo lang('ProjectsName')?></label><span
                                     class="errorStar">*</span></label>
                                 <select name="Project" id="project" class="form-control chosen"
                                       onchange="get_building(this.value)">
                                     <option value=""><?php echo lang('select')?></option>
                                     <?php if(isset($Project)){ foreach($Project as $item) {		 ?>
                                     <option value="<?php  echo $item->id ?>"
                                         <?php  if(isset($Project_id)){ echo $Project_id == $item->id ?'selected':'' ;  } ?>>
                                         <?php echo $item->Name  ?></option>
                                     <?php } }    ?>
                                 </select>
                             </div>
							 <div class="form-group col-md-6">
                                 <label for="UnitType"><?php echo lang('building')?></label><span
                                     class="errorStar">*</span></label> 
                                <select name="building_id" class="form-control"  id="building"   onchange="get_floors_with_building(this.value)">
							<option value=""><?php echo lang('select')?></option>
							<?php  if(!empty($buildings)){ foreach($buildings  as $building){  ?>
				             <option value="<?php echo $building->bldid ?>" 
							 <?php if(!empty($building_id)) echo $building_id == $building->bldid ?'selected':''  ?>>
							 <?php echo $building->name ?></option>                      		<?php  } }  ?>
						</select>
                             </div>
							  <div class="form-group col-md-6">
                                 <label for="UnitType"><?php echo lang('pmc')?></label><span
                                     class="errorStar">*</span></label> 
                                <select name="pmc_id" class="form-control"  id="pmcid" >
							<option value=""><?php echo lang('select')?></option>
							<?php  if(!empty($pmc)){ foreach($pmc  as $row){  ?>
				             <option value="<?php echo $row->pmc_id ?>" 
							 <?php if(!empty($pmc_id)) echo $pmc_id == $row->pmc_id ?'selected':''  ?>>
							 <?php echo $row->name ?></option>                      		<?php  } }  ?>
						</select>
                             </div>
                             <div class="form-group col-md-6">
                                 <label for="UnitType"><?php echo lang('unit_group_type')?></label><span
                                     class="errorStar">*</span></label>
                                 <select class="form-control chosen" name="Unitgrouptype">
                                     <option value="">Select </option>
                                     <?php foreach($UnitGroupType as $item){  ?>
                                     <option value="<?php echo $item->id ?>"
                                         <?php if(!empty($Unitgrouptype_id)) echo $Unitgrouptype_id == $item->id ?'selected':''  ?>>
                                         <?php echo $item->unit_group_type ?></option>
                                     <?php  }				?>
                                 </select>
                             </div>
                             <div class="form-group col-md-6">
                                 <label for="soc"><?php echo lang('Unit_soc')?></label><span
                                     class="errorStar"></span></label>
                                 <select name="soc" id="soc" class="form-control chosen">
                                     <option value=""><?php echo lang('select')?></option>
                                     <?php if(isset($soc)){ foreach($soc as $item) {		 ?>
                                     <option value="<?php  echo $item->id ?>"
                                         <?php  if(isset($soc_id)){ echo $soc_id == $item->id ?'selected':'' ;  } ?>>
                                         <?php echo $item->Name  ?></option>
                                     <?php  } }     ?>
                                 </select>
                             </div>
                             <div class="form-group col-md-6">
                                 <label for="UnitType"><?php echo lang('unit_type')?></label><span
                                     class="errorStar">*</span></label>
                                 <select name="UnitType" id="UnitType" class="form-control chosen">
                                     <option value=""><?php echo lang('select')?></option>
                                     <?php if(isset($Unit_type)){ foreach($Unit_type as $item){ ?>
                                     <option value="<?php  echo $item->id ?>"
                                         <?php  if(isset($UnitType)){ echo $UnitType == $item->id ?'selected':'' ;  } ?>>
                                         <?php echo $item->UnitType  ?></option>
                                     <?php } }    ?>
                                 </select>
                             </div>
                             <div class="form-group col-md-6">
                                 <label for="status"><?php echo lang('Status')?></label><span
                                     class="errorStar"></span></label>
                                 <select name="status" id="status" class="form-control chosen">
                                     <option><?php echo lang('select')?></option>
                                     <?php if(isset($status)){ foreach($status as $item){		 ?>
                                     <option value="<?php  echo $item->status_id ?>"
                                         <?php  if(isset($status_id)){ echo $status_id == $item->status_id ?'selected':'' ;  } ?>>
                                         <?php echo $item->status_name  ?></option>
                                     <?php } }    ?>
                                 </select>
                             </div>
                             <div class="form-group col-md-6">
                                 <label for="intension"><?php echo lang('Intension')?></label><span
                                     class="errorStar">*</span></label>
                                 <select name="intension" id="intension" class="form-control chosen">
                                     <option><?php echo lang('select')?></option>
                                     <?php if(isset($intension)){ foreach($intension as $item){ ?>
                                     <option value="<?php  echo $item->intension_id ?>"
                                         <?php  if(isset($intention_id)){ echo $intention_id == $item->intension_id ?'selected':'' ;  } ?>>
                                         <?php echo $item->name  ?></option>
                                     <?php } }    ?>
                                 </select>
                             </div>

                             <div class="form-group col-md-6">
                                 <label for="unitname"><?php echo lang('unit_name')?><span
                                         class="errorStar">*</span></label>
                                 <input type="text" name="unitname"
                                     value="<?php  if(isset($unitname)){ echo $unitname ;  } ?>" class="form-control"
                                     autocomplete="off" />
                             </div>
                             <div class="form-group col-md-6">
                                 <label for="Floor"><?php echo lang('floor')?></label><span
                                     class="errorStar">*</span></label>
                                 <select name="Floor" id="floor_id" class="form-control ">
                                     <option><?php echo lang('select')?></option>
                                     <?php if(isset($floor)){ foreach($floor as $item){		 ?>
                                     <option value="<?php  echo $item->id ?>"
                                         <?php  if(isset($Floor_id)){ echo $Floor_id == $item->id ?'selected':'' ;  } ?>>
                                         <?php echo $item->name  ?></option>
                                     <?php  } }    ?>
                                 </select>
                             </div>
                             <div class="form-group col-md-6">
                                 <label for="unit"><?php echo lang('unit_no')?><span class="errorStar">*</span></label>
                                 <input type="text" name="unit_no"
                                     value="<?php  if(isset($unit_no)){ echo $unit_no ;  } ?>" id="unit"
                                     class="form-control allownumber" />
                             </div>
                             <div class="form-group col-md-6">
                                 <label for="size"><?php echo lang('House_details')?><span
                                         class="errorStar">*</span></label>
                                 <input type="text" name="size" value="<?php  if(isset($size)){ echo $size ;  } ?>"
                                     class="form-control" />
                             </div>
                             <div class="form-group col-md-6">
                                 <label for="desc"><?php echo lang('address')?><span class="errorStar">*</span></label>
                                 <input type="text" name="address"
                                     value="<?php  if(isset($address)){ echo $address ;  } ?>" class="form-control " autocomplete="off" />

                             </div>
                             <div class="form-group col-md-6">
                                 <label for="insidearea"><?php echo lang('House_length')?><span
                                         class="errorStar">*</span></label>
                                 <input type="text" name="Inside_unit"
                                     value="<?php  if(isset($Inside_unit)){ echo $Inside_unit ;  } ?>"
                                     class="form-control" />
                             </div>
							  <div class="form-group col-md-6">
                                 <label for="price"><?php echo lang('price')?><span class="errorStar">*</span></label>
                                 <input type="text" name="price" value="<?php  if(isset($price)){ echo $price ;  } ?>"
                                     class="form-control allowdecimalpoint" />
                             </div>
                             <div class="form-group col-md-6">
                                 <label for="note"><?php echo lang('Note')?><span class="errorStar">*</span></label>
                                 <input type="text" name="note" value="<?php  if(isset($note)){ echo $note ;  } ?>"
                                     class="form-control" />
                             </div>
                             <div class="col-md-6">
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
                                 <?php  if(!empty($attachments)){ foreach($attachments as $doc){ 
                                                  if(!empty($doc)){  	?>
                                 <a style="margin-left:12px;"
                                     href="<?php   echo  site_url('admin/unit/download_otherdoc/'.$doc)  ?>"
                                     class="btn btn-xs btn-danger">
                                     <i class="glyphicon glyphicon-download-alt"></i><?php    echo $doc; ?></a>
                                 <span class="glyphicon glyphicon-remove"
                                     onclick="delete_file('<?php echo $doc ; ?>')"></span><br>
                                 <?php    } } } ?>
                             </div>
                         </div>
                         <div class="form-group col-md-6">
                             <label for="contract"><?php echo lang('contract')?></label>
                             <input type="file" class="form-control " name="contract">
                             <?php  if(!empty($contracts)){  ?>
                             <a style="margin-left:12px;"
                                 href="<?php   echo  site_url('admin/unit/download_contract/'.$contracts)  ?>"
                                 class="btn btn-xs btn-danger">
                                 <i class="glyphicon glyphicon-download-alt"></i><?php    echo $contracts; ?></a>
                             <?php   } ?>
                         </div>
                         <div class="form-group col-md-6">
                             <label for="Amenities"><?php echo lang('Interiors_neccessacity')?></label><span
                                 class="errorStar">*</span></label><br>
                             <select name="Amenities[]" class="form-control my-select" multiple="multiple">
                                 <?php if(isset($Amenities)){ foreach($Amenities as $item){
										$selected = in_array( $item->id, $Amenities_ids ) ? ' selected="selected" ' : '';    ?>
                                 <option value="<?php  echo $item->id ?>" <?php echo $selected; ?>>
                                     <?php echo $item->NAME  ?></option>
                                 <?php  }  }    ?>
                             </select>
                         </div>
                 
                 </div>
                 <div class="box-footer">
                     <input type="hidden" name="id" id="unitid" value="<?php   if(isset($id)){  echo   $id ; } ?>">
                     <input class="btn btn-primary" type="submit" value="Save" />
                 </div>
                 </form>
             </div><!-- /.box-body -->
         </div><!-- /.box -->

     </div><!-- /.col -->
     </div><!-- /.row -->
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
    var unitid = $('#unitid').val();
    var postUrl = getBaseURL() + 'admin/unit/doc_delete';
    $.ajax({
        type: "POST",
        url: postUrl,
        data: {
            doc: str,
            unitid: unitid
        },
        cache: false,
        success: function(result) {
            location.reload(true);
        }
    });
}
 </script>