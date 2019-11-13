
</style>
<?php   $seg= $this->uri->segment(5);?>
<section class="content-header">
    <h1>
        <?php echo $page_title; ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i>
                <?php echo lang('dashboard')?></a></li>
        <li><a href="<?php echo site_url('owner/Myunits/owner_unit_request_view') ?>"> <?php echo lang('owner_unit_request_view')?> </a></li>
       
    </ol>
</section>
<br>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><?php echo lang('owner_unit_request_view'); ?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
							<div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label><?php echo lang('type') ?></label>
                                </div>
                                <div class="col-md-3 ">
                                       <?php if(isset($requesttype)){ echo $requesttype;  }   ?>
                                </div>
                                <div class="col-md-2">
                                    <label><?php echo lang('unit_details') ?></label>
                                </div>
                                <div class="col-md-3 ">
                                    <?php if(isset($reqequestunit->unit_name)){ echo $reqequestunit->unit_name .'('.$reqequestunit->building .')';  }   ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label><?php echo lang('title') ?></label>
                                </div>
                                <div class="col-md-3 title">
                                 <?php if(isset($request->title)){ echo $request->title;  }   ?>
                                </div>
                                <div class="col-md-2">
                                    <label><?php echo lang('date') ?></label>
                                </div>
                                <div class="col-md-3 date">
                                  <?php if(isset($request->requesteddate)){ echo $request->requesteddate;  }   ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label><?php echo lang('tenure') ?></label>
                                </div>
                                <div class="col-md-3">
                                  <?php if(isset($request->tenure)){ echo $request->tenure;  }   ?>
                                </div>
                                <div class="col-md-2">
                                    <label><?php echo lang('tenure_type') ?></label>
                                </div>
                                <div class="col-md-3">
                             <?php echo !empty($request->tenure_type) && $request->tenure_type == lang('month') ? lang('month') : FALSE ; ?>
                               <?php echo !empty($request->tenure_type) && $request->tenure_type == lang('year') ? lang('year') : FALSE ; ?>
                                
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label><?php echo lang('expect_amount') ?></label><span style="color:red"> *</span>
                                </div>
                                <div class="col-md-3">
                              <?php if(isset($request->expect_amount)){ echo $request->expect_amount;  }else{ echo set_value('expectAmount') ; }    ?>
                                </div>
                                <div class="col-md-2">
                                    <label><?php echo lang('description') ?></label>
                                </div>
                                <div class="col-md-3">
                                <?php if(isset($request->owner_description)){ echo $request->owner_description;  }else{ echo set_value('description') ; }   ?>
                                </div>
                            </div>
                           
                
                </div><!-- /.box-body -->
            </div><!-- /.box -->

        </div><!-- /.col -->
    </div><!-- /.row -->
</section>