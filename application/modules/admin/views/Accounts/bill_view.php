<?php  $seg= $this->uri->segment(4);?>
<section class="content-header">
    <h1>
        <?php echo $page_title;   ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i><?php echo lang('dashboard')?></a></li>
        <li><a href="<?php echo site_url('admin/accounts/view_bill') ?>"> <?php echo lang('bill')?> </a></li>
        <li class="active"><?php echo lang('bill');?></li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                        <div class="box-body">
                           <!-- <div class="form-group col-md-6">
                                <label for="Paid_status"> <?php echo lang('paid_from'); ?> :</label><br>
                                        <?php echo  !empty($bill->paid_from) && $bill->paid_from == lang('reserve_fund') ? lang('reserve_fund') : FALSE ; ?>
                                        <?php echo !empty($bill->paid_from) && $bill->paid_from == lang('ready_cash') ? lang('ready_cash') : FALSE ; ?>
                            </div>-->
                            <div class="form-group col-md-6">
                                <label for="project_id"><?php echo lang('project')?>:</label><br>
                                    <?php if(isset($project)){ foreach($project as $item) {		 ?>
                                        <?php echo !empty($bill->project_id) && $bill->project_id == $item->id ? $item->Name : FALSE ; ?>
                                    <?php } }    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="building"><?php echo lang('building')?>:</label><br>
                                    <?php if(isset($buildings)){ foreach($buildings as $item) {		 ?>
                                        <?php  if(isset($bill->building_id)){ echo $bill->building_id == $item->bldid ?$item->name:'' ;  } ?>
                                    
                                    <?php } }    ?>
                               
                            </div>
                            <div class="form-group col-md-6">
                                <label for="owner"><?php echo lang('Owner')?>:</label><br>
                                    <?php if(isset($owners)){ foreach($owners as $item) {		 ?>
                                        <?php  if(isset($bill->Owner_id)){ echo $bill->Owner_id == $item->ownid ?$item->full_name:'' ;  } ?>
                                    <?php } }    ?>
                               
                            </div>

                            <div class="form-group col-md-6">
                                <label for="unit"><?php echo lang('unit'); ?>
                                    :</label>
                                    <?php if(isset($ownerunits)){ foreach($ownerunits as $item) {		 ?>
                                        <?php  if(isset($bill->unit_id)){ echo $bill->unit_id == $item->uid ?$item->unit_name :'' ;  } ?>
                                      
                                    <?php } }    ?>
                                </select>
                            </div>
                           
                            <div class="form-group col-md-6">
                                <label for="Issue_date"><?php echo lang('Issue_date'); ?> :</label><br>
                             <?php if(!empty($bill->Issued_date)){ echo $bill->Issued_date;  }   ?>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="Bill_Date"> <?php echo lang('Bill_Date'); ?> :</label><br>
                                <?php if(!empty($bill->bill_date)){ echo $bill->bill_date;  }else{ echo set_value('Bill_Date') ; }   ?>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="Total_amount"> <?php echo lang('Total_amount'); ?> :</label><br>
                                <?php if(!empty($bill->total_amount)){ echo $bill->total_amount;  }else{ echo set_value('Total_amount') ; }   ?>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="Details"> <?php echo lang('Details'); ?>
                                    :</label><br>
                                <?php if(!empty($bill->bill_details)){ echo $bill->bill_details;  }else{ echo set_value('Details') ; }   ?>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="Paid_status"> <?php echo lang('Paid_status'); ?> :</label><br>
                                        <?php echo !empty($bill->Paid_Status) && $bill->Paid_Status == lang('Paid_paid') ? lang('Paid_paid') : FALSE ; ?>
                                        <?php echo !empty($bill->Paid_Status) && $bill->Paid_Status == lang('Paid_Unpaid') ? lang('Paid_Unpaid') : FALSE ; ?>
                                      
                                </select>
                            </div>
                        </div>
                        
                    
                </div><!-- /.box-body -->
            </div><!-- /.box -->

        </div><!-- /.col -->
    </div><!-- /.row -->
</section>

