<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

 <style type="text/css">
    tbody th {
        background-color: #0f7506;
        color: #fff;
    }

    #addrow {
        display: inline-block;
    }

    .right_plus {
        position: absolute;
        right: 0;
        top: 30px;
        transform: translateX(-111px);
    }

    .use_icon {
        display: inline-block;
        font-size: 17px;
        cursor: pointer;
    }
	
	.right_plus a {
    cursor: pointer;
    display: inline-block;
}
</style>

<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-plus"></i><?= lang('Edit_Opening_Stock'); ?></h2>
    </div>
	  <?php
                $attrib = array('data-toggle' => 'validator', 'role' => 'form','id'=>'openingstock');
                echo admin_form_open_multipart("products/OpeningStockEdit", $attrib)
                ?>
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
                                    <?= lang("warehouse", "warehouse"); ?>
									
                                    <?php
                                    $wh[''] = '';
                                    foreach ($warehouses as $warehouse) {
                                        $wh[$warehouse->id] = $warehouse->name;
                                    }
                                    echo form_dropdown('warehouse', $wh, (isset($_POST['warehouse']) ? $_POST['warehouse'] : $Master->whid), 'id="warehouse" class="form-control input-tip select" data-placeholder="' . lang("select") . ' ' . lang("warehouse") . '" required="required" style="width:100%;" ');
                                    ?>
                                </div>
                            </div>
                        <?php } else {
                            $warehouse_input = array(
                                'type' => 'hidden',
                                'name' => 'warehouse',
                                'id' => 'warehouse',
                                'value' => $this->session->userdata('warehouse_id'),
                                );

                            echo form_input($warehouse_input);
                        } ?>

                        <?php if ($Owner || $Admin) { ?>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <?= lang("date", "date"); ?>
                                    <?php echo form_input('date', (isset($_POST['date']) ? $_POST['date'] : $this->sma->hrld(date('Y-m-d H:i:s'))), 'class="form-control input-tip" id="date" required="required"'); ?>
                                </div>
                            </div>
                        <?php } ?>

                        <div class="col-md-4">
                            <div class="form-group">
                                <?= lang("reference", "ref"); ?>
                                <?php echo form_input('reference_no', (isset($_POST['reference_no']) ? $_POST['reference_no'] : ''), 'class="form-control input-tip" id="ref"'); ?>
                            </div>
                        </div>

                       
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
						<?php   if(isset($Items)){   $i=1; foreach($Items as $Item){  ?>
                            <tr id='addr0'>
                                <td><?php  echo $i;  ?><input type="hidden" value="<?php echo $Item->id ;  ?>"  name="itemid[]"></td>
                                <td> <?php $product[''] = '';
                                    foreach ($Product as $Products) {
                                        $product[$Products->id] = $Products->name .'-'.$Products->code ;
                                    }
                                    echo form_dropdown('Product[]', $product, (isset($_POST['Product']) ? $_POST['Product'] : $Item->product_id), 'id="Product" class="form-control input-tip select product" data-placeholder="' . lang("select") . ' ' . lang("Product") . '" required="required" style="width:100%;" ');
                                    ?>  </a></td>
                                <td><input type="text" readonly class="form-control input-md" name="CBM[]" value="<?php echo $Item->Cbm ;  ?>"></td>
                                <td><input type="text"  class="form-control input-md" name="Qty[]" value="<?php echo $Item->Qty ;  ?>"></td>
                                <td><input type="text" readonly class="form-control input-md" name="cost[]" value="<?php echo $Item->Cost ;  ?>"></td>
								<td><input type="text" readonly class="form-control input-md" name="Price[]" value="<?php echo $Item->Price ;  ?>"></td>
								<td> <?php $companies[''] = '';
                                    foreach ($Supplier as $Suppliers) {
                                        $companies[$Suppliers->id] = $Suppliers->name;
                                    }
                                    echo form_dropdown('supplier[]', $companies, (isset($_POST['supplier']) ? $_POST['supplier'] :$Item->copmaniesid), 'id="supplier" class="form-control input-tip select" data-placeholder="' . lang("select") . ' ' . lang("supplier") . '" style="width:100%;" ');
                                    ?> </td>
								<td><input type="date" class="form-control input-md datepicker" name="expired[]" value="<?php echo $Item->Expired_date ;  ?>"></td>
								<td><input type="text" class="form-control input-md" name="remark[]" value="<?php echo $Item->Remark ;  ?>"></td>
                               </span>
                                </td>
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
        </div>
                        <div class="clearfix"></div>

                        <div class="col-md-12">
                            <div class="fprom-group">
                                <?= form_submit('count_stock', lang("submit"), 'id="count_stock" class="btn btn-primary" style="padding: 6px 15px; margin:15px 0;"'); ?>
                              </div>
                        </div>
                    </div>
                </div>
                <?php echo form_close(); ?>

            </div>

        </div>
    </div>
</div>
