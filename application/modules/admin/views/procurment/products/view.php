
<link href="<?php echo base_url('assets/procurement/css/bootstrap.min.css')?>" rel="stylesheet"/>
         <section class="content-header">
          <h1>&nbsp;
           
           </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
			<li><a href="<?php echo site_url('admin/procurment/products/') ?>"><?php echo lang('products')?></a></li>
            <li class="active"><?php echo lang('view')?> <?php echo lang('products')?></li>
          </ol>
</section>
<section class="content">
		  <div class="row">
            <div class="col-xs-12">
      <div class="box">
            <div class="box-header">
                <h2 class="blue"><i class="fa-fw fa fa-file-text-o nb"></i> <?= $product->name; ?></h2>
               
                <div class="box-icon">
                    <ul class="btn-tasks">
                        <li class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <i class="icon fa fa-tasks tip" data-placement="left" title="<?= lang("actions") ?>"></i>
                            </a>
                            <ul class="dropdown-menu pull-right tasks-menus" role="menu"
                                aria-labelledby="dLabel">
                                <li>
                                    <a href="<?= base_url('admin/procurment/products/edit/' . $product->id) ?>">
                                        <i class="fa fa-edit"></i> <?= lang('edit') ?>
                                    </a>
                                </li>
                               <!-- <li>
                                    <a href="<?= base_url('admin/procurment/products/print_barcodes/' . $product->id) ?>">
                                        <i class="fa fa-print"></i> <?= lang('print_barcode_label') ?>
                                    </a>
                                </li>-->
                              <!--  <li>
                                    <a href="<?= base_url('admin/procurment/products/pdf/' . $product->id) ?>">
                                        <i class="fa fa-download"></i> <?= lang('pdf') ?>
                                    </a>
                                </li>-->
                                <li class="divider"></li>
                                <li>
                                    <a href="#" class="bpo" title="<b><?= lang("delete_product") ?></b>"
                                        data-content="<div style='width:150px;'><p><?= lang('r_u_sure') ?></p><a class='btn btn-danger' href='<?= base_url('products/delete/' . $product->id) ?>'><?= lang('i_m_sure') ?></a> <button class='btn bpo-close'><?= lang('no') ?></button></div>"
                                        data-html="true" data-placement="left">
                                        <i class="fa fa-trash-o"></i> <?= lang('delete') ?>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
              
            </div>
            <div class="box-content">
                <div class="row">
                    <div class="col-lg-12">
                        <p class="introtext"><?php echo lang('product_details'); ?></p>

                        <div class="row">
                            <div class="col-sm-5">
                                <img src="<?= base_url() ?>/assets/product/<?= $product->image ?>"
                                     alt="<?= $product->name ?>" class="img-responsive img-thumbnail"/>

                                <div id="multiimages" class="padding10">
                                    <?php if (!empty($images)) {
                                        echo '<a class="img-thumbnail" data-toggle="lightbox" data-gallery="multiimages" data-parent="#multiimages" href="' . base_url() . './assets/product/' . $product->image . '" style="margin-right:5px;"><img class="img-responsive" src="' . base_url() . './assets/product/thumbs/' . $product->image . '" alt="' . $product->image . '" style="width:' . $Settings->twidth . 'px; height:' . $Settings->theight . 'px;" /></a>';
                                        foreach ($images as $ph) {
                                            echo '<div class="gallery-image"><a class="img-thumbnail" data-toggle="lightbox" data-gallery="multiimages" data-parent="#multiimages" href="' . base_url() . './assets/product/' . $ph->photo . '" style="margin-right:5px;"><img class="img-responsive" src="' . base_url() . './assets/product/thumbs/' . $ph->photo . '" alt="' . $ph->photo . '" style="width:' . $Settings->twidth . 'px; height:' . $Settings->theight . 'px;" /></a>';
                                            if ($Owner || $Admin || $GP['products-edit']) {
                                                echo '<a href="#" class="delimg" data-item-id="'.$ph->id.'"><i class="fa fa-times"></i></a>';
                                            }
                                            echo '</div>';
                                        }
                                    }
                                    ?>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="col-sm-7">
                                <div class="table-responsive">
                                    <table class="table table-borderless table-striped dfTable table-right-left">
                                        <tbody>
                                        <tr>
                                            <td colspan="2" style="background-color:#FFF;"></td>
                                        </tr>
                                        <tr>
                                              <td style="width:30%;"><?= lang("barcode_qrcode"); ?></td>
                                            <td style="width:70%;">
                                          
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><?= lang("type"); ?></td>
                                            <td><?php echo lang($product->type); ?></td>
                                        </tr>
                                        <tr>
                                            <td><?= lang("name"); ?></td>
                                            <td><?php echo $product->name; ?></td>
                                        </tr>
                                        <tr>
                                            <td><?= lang("code"); ?></td>
                                            <td><?php echo $product->code; ?></td>
                                        </tr>
                                        <tr>
                                            <td><?= lang("brand"); ?></td>
                                            <td><?= $brand ? $brand->name : ''; ?></td>
                                        </tr>
                                        <tr>
                                            <td><?= lang("category"); ?></td>
                                            <td><?php echo $category->name; ?></td>
                                        </tr>
                                        <?php if ($product->subcategory_id) { ?>
                                            <tr>
                                                <td><?= lang("subcategory"); ?></td>
                                                <td><?php echo $subcategory->name; ?></td>
                                            </tr>
                                        <?php } ?>
                                        <tr>
                                            <td><?= lang("unit"); ?></td>
                                            <td><?= $unit ? $unit->name.' ('.$unit->code.')' : ''; ?></td>
                                        </tr>
                                        <?php if (true) {
                                            echo '<tr><td>' . lang("cost") . '</td><td>' . $this->sma->formatMoney($product->cost) . '</td></tr>';
                                            echo '<tr><td>' . lang("price") . '</td><td>' . $this->sma->formatMoney($product->price) . '</td></tr>';
                                            if ($product->promotion) {
                                                echo '<tr><td>' . lang("promotion") . '</td><td>' . $this->sma->formatMoney($product->promo_price) . ' ('.$this->sma->hrsd($product->start_date).' - '.$this->sma->hrsd($product->end_date).')</td></tr>';
                                            }
                                        } else {
                                            if ($this->session->userdata('show_cost')) {
                                                echo '<tr><td>' . lang("cost") . '</td><td>' . $this->sma->formatMoney($product->cost) . '</td></tr>';
                                            }
                                            if ($this->session->userdata('show_price')) {
                                                echo '<tr><td>' . lang("price") . '</td><td>' . $this->sma->formatMoney($product->price) . '</td></tr>';
                                                if ($product->promotion) {
                                                    echo '<tr><td>' . lang("promotion") . '</td><td>' . $this->sma->formatMoney($product->promo_price) . ' ('.$this->sma->hrsd($product->start_date).' - '.$this->sma->hrsd($product->start_date).')</td></tr>';
                                                }
                                            }
                                        }
                                        ?>

                                        <?php if ($product->tax_rate) { ?>
                                            <tr>
                                                <td><?= lang("tax_rate"); ?></td>
                                                <td><?php echo $tax_rate->name; ?></td>
                                            </tr>
                                            <tr>
                                                <td><?= lang("tax_method"); ?></td>
                                                <td><?php echo $product->tax_method == 0 ? lang('inclusive') : lang('exclusive'); ?></td>
                                            </tr>
                                        <?php } ?>
                                        <?php if ($product->alert_quantity != 0) { ?>
                                            <tr>
                                                <td><?= lang("alert_quantity"); ?></td>
                                                <td><?php echo $this->sma->formatQuantity($product->alert_quantity); ?></td>
                                            </tr>
                                        <?php } ?>
                                        <?php if ($variants) { ?>
                                            <tr>
                                                <td><?= lang("product_variants"); ?></td>
                                                <td><?php foreach ($variants as $variant) {
                                                        echo '<span class="label label-primary">' . $variant->name . '</span> ';
                                                    } ?></td>
                                            </tr>
                                        <?php } ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-5">
                                        <?php if ($product->cf1 || $product->cf2 || $product->cf3 || $product->cf4 || $product->cf5 || $product->cf6) { ?>
                                            <h3 class="bold"><?= lang('custom_fields') ?></h3>
                                            <div class="table-responsive">
                                                <table
                                                    class="table table-bordered table-striped table-condensed dfTable two-columns">
                                                    <thead>
                                                    <tr>
                                                        <th><?= lang('custom_field') ?></th>
                                                        <th><?= lang('value') ?></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    if ($product->cf1) {
                                                        echo '<tr><td>' . lang("pcf1") . '</td><td>' . $product->cf1 . '</td></tr>';
                                                    }
                                                    if ($product->cf2) {
                                                        echo '<tr><td>' . lang("pcf2") . '</td><td>' . $product->cf2 . '</td></tr>';
                                                    }
                                                    if ($product->cf3) {
                                                        echo '<tr><td>' . lang("pcf3") . '</td><td>' . $product->cf3 . '</td></tr>';
                                                    }
                                                    if ($product->cf4) {
                                                        echo '<tr><td>' . lang("pcf4") . '</td><td>' . $product->cf4 . '</td></tr>';
                                                    }
                                                    if ($product->cf5) {
                                                        echo '<tr><td>' . lang("pcf5") . '</td><td>' . $product->cf5 . '</td></tr>';
                                                    }
                                                    if ($product->cf6) {
                                                        echo '<tr><td>' . lang("pcf6") . '</td><td>' . $product->cf6 . '</td></tr>';
                                                    }
                                                    ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        <?php } ?>

                                        <?php if ( $product->type == 'standard') { ?>
                                            <h3 class="bold"><?= lang('warehouse_quantity') ?></h3>
                                            <div class="table-responsive">
                                                <table
                                                    class="table table-bordered table-striped table-condensed dfTable two-columns">
                                                    <thead>
                                                    <tr>
                                                        <th><?= lang('warehouse_name') ?></th>
                                                        <th><?= lang('quantity') . ' (' . lang('rack') . ')'; ?></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php foreach ($warehouses as $warehouse) {
                                                        if ($warehouse->quantity != 0) {
                                                            echo '<tr><td>' . $warehouse->name . ' (' . $warehouse->code . ')</td><td><strong>' . $this->sma->formatQuantity($warehouse->quantity) . '</strong>' . ($warehouse->rack ? ' (' . $warehouse->rack . ')' : '') . '</td></tr>';
                                                        }
                                                    } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="col-sm-7">
                                        <?php if ($product->type == 'combo') { ?>
                                            <h3 class="bold"><?= lang('combo_items') ?></h3>
                                            <div class="table-responsive">
                                                <table
                                                    class="table table-bordered table-striped table-condensed dfTable two-columns">
                                                    <thead>
                                                    <tr>
                                                        <th><?= lang('product_name') ?></th>
                                                        <th><?= lang('quantity') ?></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php foreach ($combo_items as $combo_item) {
                                                        echo '<tr><td>' . $combo_item->name . ' (' . $combo_item->code . ') </td><td>' . $this->sma->formatQuantity($combo_item->qty) . '</td></tr>';
                                                    } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        <?php } ?>
                                        <?php if (!empty($options)) { ?>
                                            <h3 class="bold"><?= lang('product_variants_quantity'); ?></h3>
                                            <div class="table-responsive">
                                                <table
                                                    class="table table-bordered table-striped table-condensed dfTable">
                                                    <thead>
                                                    <tr>
                                                        <th><?= lang('warehouse_name') ?></th>
                                                        <th><?= lang('product_variant'); ?></th>
                                                        <th><?= lang('quantity') . ' (' . lang('rack') . ')'; ?></th>
                                                        <?php 
                                                            echo '<th>' . lang('cost') . '</th>';
                                                            echo '<th>' . lang('price') . '</th>';
                                                       ?>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    foreach ($options as $option) {
                                                        if ($option->wh_qty != 0) {
                                                            echo '<tr><td>' . $option->wh_name . '</td><td>' . $option->name . '</td><td class="text-center">' . $this->sma->formatQuantity($option->wh_qty) . '</td>';
                                                          
                                                                echo '<td class="text-right">' . $this->sma->formatMoney($option->cost) . '</td><td class="text-right">' . $this->sma->formatMoney($option->price) . '</td>';
                                                          
                                                            echo '</tr>';
                                                        }

                                                    }
                                                    ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12">

                                <?= $product->details ? '<div class="panel panel-success"><div class="panel-heading">' . lang('product_details_for_invoice') . '</div><div class="panel-body">' . $product->details . '</div></div>' : ''; ?>
                                <?= $product->product_details ? '<div class="panel panel-primary"><div class="panel-heading">' . lang('product_details') . '</div><div class="panel-body">' . $product->product_details . '</div></div>' : ''; ?>

                            </div>
                        </div>

                        
                        <div class="buttons">
                            <div class="btn-group btn-group-justified">
                                <div class="btn-group">
                                 <!--   <a href="<?= base_url('products/print_barcodes/' . $product->id) ?>" class="tip btn btn-primary" title="<?= lang('print_barcode_label') ?>">
                                        <i class="fa fa-print"></i>
                                        <span class="hidden-sm hidden-xs"><?= lang('print_barcode_label') ?></span>
                                    </a>-->
                                </div>
                                <div class="btn-group">
                                    <a href="<?= base_url('products/pdf/' . $product->id) ?>" class="tip btn btn-primary" title="<?= lang('pdf') ?>">
                                        <i class="fa fa-download"></i> <span class="hidden-sm hidden-xs">pdf<?= lang('pdf') ?></span>
                                    </a>
                                </div>
                                
                                <div class="btn-group">
                                    <a href="<?= base_url('admin/procurment/products/edit/' . $product->id) ?>" class="tip btn btn-warning tip" title="<?= lang('edit_product') ?>">
                                        <i class="fa fa-edit"></i> <span class="hidden-sm hidden-xs"><?= lang('edit') ?></span>
                                    </a>
                                </div>
                                <div class="btn-group">
                                    <a href="#" class="tip btn btn-danger bpo" title="<b><?= lang("delete_product") ?></b>"
                                        data-content="<div style='width:150px;'><p><?= lang('r_u_sure') ?></p><a class='btn btn-danger' href='<?= base_url('admin/procurment/products/delete/' . $product->id) ?>'><?= lang('i_m_sure') ?></a> <button class='btn bpo-close'><?= lang('no') ?></button></div>"
                                        data-html="true" data-placement="top">
                                        <i class="fa fa-trash-o"></i> <span class="hidden-sm hidden-xs"><?= lang('delete') ?></span>
                                    </a>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(document).ready(function () {
                $('.tip').tooltip();
            });
        </script>
         
 
              

				
					
     			 </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div><!-- /.col -->
          </div><!-- /.row -->
        </section>
