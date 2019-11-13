<section class="content-header">
          <h1>
            <?php echo $page_title; ?>
           </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
			<li><a href="<?php echo site_url('admin/Fund/reserve_fund_view') ?>"><?php echo lang('reserve_fund')?></a></li>
            <li class="active"><?php echo lang('view')?> <?php echo lang('reserve_fund')?></li>
          </ol>
</section>
<section class="content">

		  <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body">
					 <div class="box-body">
                            <div class="form-group  col-md-6">
                                <label for="ddlOwnerName"><?php echo lang('Owner_Name')           ?> :</label><br>
                                <?php if(isset($reserve_fund->full_name)){ echo $reserve_fund->full_name; } ?>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="ddlMonth"><?php echo lang('paid_date')?>:</label><br>
                              <?php if(isset($reserve_fund->f_date)){ echo ($reserve_fund->f_date); } ?>
                            </div>
                            <div class="form-group  col-md-6">
                                <label for="startdate"><?php echo lang('start_date')?>:</label><br>
                            <?php if(isset($reserve_fund->start_date)){ echo $reserve_fund->start_date; } ?>
                            </div>
							 <div class="form-group  col-md-6">
                                <label for="enddate"><?php echo lang('end_date')?>:</label><br>
                               <?php if(isset($reserve_fund->end_date)){ echo $reserve_fund->end_date; } ?>
                                   
                            </div>
							 <div class="form-group  col-md-6">
                                 <label for="totalamount"> <?php echo lang('Total_amount')?>:</label><br>
                          <?php if(isset($reserve_fund->total_amount)){ echo $reserve_fund->total_amount; } ?>
                                  
                            </div>
							 <div class="form-group  col-md-6">
                               <label for="txtPurpose"><?php echo lang('Fund_purpose')?>:</label><br>
                             <?php if(isset($reserve_fund->purpose)){ echo $reserve_fund->purpose; } ?>
                                
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
					
     			 </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div><!-- /.col -->
          </div><!-- /.row -->
        </section>
