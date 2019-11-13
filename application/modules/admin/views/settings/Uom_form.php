  <?php  $seg= $this->uri->segment(4);?>
  <section class="content-header">
      <h1><?php echo $page_title; ?></h1>
      <ol class="breadcrumb">
          <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i>
                  <?php echo lang('dashboard')?></a></li>
          <li><a href="<?php echo site_url('admin/Settings/UOM') ?>"><?php echo lang('UOM')?></a></li>
          <li class="active"><?php echo lang('Settings')?> <?php echo lang('UOM')?></li>
          <li class="active"><?php echo (empty($seg))?lang('add'):lang('edit');?></li>
      </ol>
  </section>
  <section class="content">
      <div class="row">
          <div class="col-xs-12">
              <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">
					<?php echo lang('UOM')?>
                    </h3>
                </div><!-- /.box-header  -->
                  <div class="box-body">
                      <form method="post" action="<?php echo site_url('admin/Settings/UOM_form/'.$id); ?>"
                          enctype="multipart/form-data"  class="uomform">
                          <div class="box-body">
                               <div class="form-group col-md-8">
                                  <label for="UOM_name"><?php echo lang('UOM_name')?><span
                                          class="errorStar">*</span></label>
                                  <input type="text" name="UOM_name"
                                      value="<?php  if(isset($name)){ echo $name ;  } ?>" id="UOM_name"
                                      class="form-control" />
                              </div>
                              <div class="form-group col-md-8">
                                  <label><?php echo lang('default_uom')?></label>
                                  <select class="form-control chosen" name="default_uom">
                                      <span>
                                          <option value=""><?= lang('please_select') ?>..</option>
                                          <?php foreach($uomlist as $item){ ?>
                                          <option value="<?php echo $item->id ?>"
                                              <?php if(!empty($default_uom)) echo $item->id === $default_uom? 'selected':''?>>
                                              <?php echo $item->Name ?></option><?php } ?>
                                  </select>
                              </div>
                              <div class="form-group col-md-8">
                                  <label><?php echo lang('convert_rate')?></label>
                                  <input type="text" class="form-control allowdecimalpoint" name="convert_rate"
                                      autocomplete="off" required value="<?php  if(!empty($convert_rate)){ echo $convert_rate; }   ?>">
                              </div>
                              <div class="form-group col-md-8">
                                  <label for="Description"><?php echo lang('UOM_Description')?><span
                                          class="errorStar">*</span></label>
                                  <input type="text" name="UOM_Description"
                                      value="<?php  if(isset($description)){ echo $description ;  } ?>"
                                      id="UOM_Description" class="form-control" />
                                  <input type="hidden" name="ids" value="<?php  if(isset($id)){ echo $id ;  } ?>"
                                      class="form-control" />
                              </div>
                          </div>
                          <div class="box-footer">
                              <input class="btn btn-primary saveform" type="submit" value="Save" />
                          </div>
                      </form>
                  </div><!-- /.box-body -->
              </div><!-- /.box -->

          </div><!-- /.col -->
      </div><!-- /.row -->
  </section>
  
  <script>
$(".saveform").click(function ()  {
    $(".uomform").validate({
        excluded: ':disabled',
        rules: {
            convert_rate: {
                required: true
            },
			 /*  default_uom: {
                required: true
            }, */
			  UOM_name: {
                required: true
            },
            
			
        },

        highlight: function(element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function(element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'help-block animated fadeInDown',
        errorPlacement: function(error, element) {
            if (element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }
    })
});
</script>