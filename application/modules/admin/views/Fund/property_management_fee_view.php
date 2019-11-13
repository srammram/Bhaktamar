<section class="content-header">
          <h1>
            <?php echo $page_title; ?>
           </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
			<li><a href="<?php echo site_url('admin/Fund/reserve_fund_view') ?>"><?php echo lang('property_management_fee')?></a></li>
            <li class="active"><?php echo lang('view')?> <?php echo lang('property_management_fee')?></li>
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
                                <?php if(isset($property_management_fee->full_name)){ echo $property_management_fee->full_name; } ?>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="ddlMonth"><?php echo lang('paid_date')?>:</label><br>
                              <?php if(isset($property_management_fee->f_date)){ echo ($property_management_fee->f_date); } ?>
                            </div>
                            <div class="form-group  col-md-6">
                                <label for="startdate"><?php echo lang('start_date')?>:</label><br>
                            <?php if(isset($property_management_fee->start_date)){ echo $property_management_fee->start_date; } ?>
                            </div>
							 <div class="form-group  col-md-6">
                                <label for="enddate"><?php echo lang('end_date')?>:</label><br>
                               <?php if(isset($property_management_fee->end_date)){ echo $property_management_fee->end_date; } ?>
                                   
                            </div>
							 <div class="form-group  col-md-6">
                                 <label for="totalamount"> <?php echo lang('Total_amount')?>:</label><br>
                          <?php if(isset($property_management_fee->total_amount)){ echo $property_management_fee->total_amount; } ?>
                                  
                            </div>
							 <div class="form-group  col-md-6">
                               <label for="txtPurpose"><?php echo lang('Fund_purpose')?>:</label><br>
                             <?php if(isset($property_management_fee->purpose)){ echo $property_management_fee->purpose; } ?>
                                
                            </div>
                   <div class="form-group  ">
                                <div class="col-md-6">
                                    <label><?php echo lang('maintenance_services') ?></label><br>
                                  
                                        <?php  if(!empty($maintenanceservices)){ foreach($maintenanceservices as $item){  ?>
                                        <?php     $selected = in_array( $item->id, json_decode($property_management_fee->maintenance_services) ) ? $item->Name : '';     ?>
                                         <?php echo $selected; ?><br>
                                            
                                        <?php   }  }  ?>
                                    
                                </div>
                                <div class="col-md-6">
                                    <label><?php echo lang('Other_services') ?></label>
                                    <br>
                                
                                        <?php  if(!empty($services_list)){ foreach($services_list as $item){  ?>
                                        <?php     $selected = in_array( $item->id, json_decode($property_management_fee->Other_services )) ? $item->Service_name : '';     ?>
                                        <?php echo $selected; ?><br>
                                          
                                        <?php   }  }  ?>
                                   
                                </div>
                            </div>
                       
                </div>
					
     			 </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div><!-- /.col -->
          </div><!-- /.row -->
        </section>
