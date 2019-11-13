  <?php  $seg= $this->uri->segment(4);?>
  <section class="content-header">
      <h1>
          <?php echo $page_title; ?>
      </h1>
      <ol class="breadcrumb">
          <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i>
                  <?php echo lang('dashboard')?></a></li>
          <li><a href="<?php echo site_url('admin/Settings/requestType_form') ?>"> <?php echo lang('Approved_stage')?>
              </a></li>
          <li class="active"><?php echo (empty($seg))?lang('add'):lang('edit');?></li>
      </ol>
  </section>
  <section class="content">
      <div class="row">
          <div class="col-xs-12">
              <div class="box">
                  <div class="box-body">
                      <form method="post" action="<?php echo site_url('admin/settings/requestType_form/'.$id); ?>"
                          enctype="multipart/form-data">
                          <div class="box-body">

                              <div class="form-group">
                                  <label for="Name"><?php echo lang('name')?></label><span
                                      class="errorStar">*</span></label>
                                  <input type="text" name="Name" value="<?php  if(isset($Name)){ echo $Name ;  } ?>"
                                      id="Name" class="form-control" autocomplete="off" />
                              </div>


                              <div class="form-group">
                                  <label for="Description"><?php echo lang('description')?><span
                                          class="errorStar">*</span></label>
                                  <input type="text" name="description"
                                      value="<?php  if(isset($description)){ echo $description ;  } ?>" id="description"
                                      class="form-control" autocomplete="off" />
                                  <input type="hidden" name="ids" value="<?php  if(isset($id)){ echo $id ;  } ?>"
                                      class="form-control" />
                              </div>
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