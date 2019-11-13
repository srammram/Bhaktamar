<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-plus"></i><?= lang('OpeningstockView'); ?></h2>
    </div>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">

                <p class="introtext"><?php echo lang('enter_info'); ?></p>
                <?php
                $attrib = array('data-toggle' => 'validator', 'role' => 'form', 'id' => 'stForm');
                echo admin_form_open_multipart("products/count_stock", $attrib);
                ?>
                <div class="row">
                    <div class="col-lg-12">
                        <?php if ($Owner || $Admin || !$this->session->userdata('warehouse_id')) { ?>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <?= lang("warehouse", "warehouse"); ?><br>
                                   <?php  if(isset($Master->name)){echo $Master->name ; } ?>
                                </div>
                            </div>
                        <?php } else {
                            
                        } ?>

                        <?php if ($Owner || $Admin) { ?>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <?= lang("date", "date"); ?><br>
                                  <?php  if(isset($Master->Date)){echo $Master->Date ; } ?>
                                </div>
                            </div>
                        <?php } ?>

                        <div class="col-md-4">
                            <div class="form-group">
                                <?= lang("reference", "ref"); ?><br>
                                <?php  if(isset($Master->Refernce)){echo $Master->Refernce ; } ?>
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <br>
						
                         <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-hover" id="tab_logic">
                        <thead>
                            <tr>
                                <th class="frh"><?php echo lang('No'); ?></th>
                                <th class="frh"><?php echo lang('ProductName'); ?></th>
                                <th class="frh"><?php echo lang('CBM'); ?></th>
                                <th class="frh"><?php echo lang('QTY'); ?></th>
                                <th class="frh"><?php echo lang('Cost'); ?></th>
								<th class="frh"><?php echo lang('Price'); ?></th>
								<th class="frh"><?php echo lang('Supplier'); ?></th>
								<th class="frh"><?php echo lang('Expdate'); ?></th>
								<th class="frh"><?php echo lang('Remark'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
						<?php  if(isset($Items)){   $i=1; foreach($Items as $Item){  ?>
                            <tr >
                                <td><?php  echo $i;  ?></td>
                                <td><?php   echo $Item->product;  ?></td>
                                <td><?php   echo $Item->Cbm;  ?></td>
                                <td><?php   echo $Item->Qty;  ?></td>
                                <td><?php   echo $Item->Cost;  ?></td>
								<td><?php   echo $Item->Price;  ?></td>
								<td><?php   echo $Item->companies;  ?></td>
								<td><?php   echo $Item->Expired_date;  ?></td>
								<td><?php   echo $Item->Remark;  ?></td>
                              
                            </tr>
							<?php
						
						$i++ ;}
						}
							?>
                            <tr id='addr1'></tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="right_plus">
              
            </div>
        </div>
                        <div class="clearfix"></div>

                       
                    </div>
                </div>
                <?php echo form_close(); ?>

            </div>

        </div>
    </div>
</div>