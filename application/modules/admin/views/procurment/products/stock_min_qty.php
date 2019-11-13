<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<script>
 
</script>
<style>
    #StockData_filter{
	display: none;
    }
</style>
<?php
                $attrib = array('role' => 'form');
                echo admin_form_open_multipart("products/stock_min_qty/".$product->id, $attrib)
                ?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-2x">&times;</i>
            </button>
            <h4 class="modal-title" id="myModalLabel"><?=$product->code.' - '.$product->name?> - <?php echo lang('stock_details'); ?></h4>
        </div>
      
      
        <div class="modal-body">
          <div class="table-responsive">
                    <table id="StockData" class="table table-bordered table-condensed table-hover table-striped">
                        <thead>
                        <tr class="primary">
			    <th><?= lang("store_name") ?></th>
			    <th><?= lang("min_qty") ?></th>
			    <th><?= lang("max_qty") ?></th>
                            
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($stock_minqty as $k => $row) : ?>
			<tr>
			    <td><?=$row->store_name?><input type="hidden" name="stock[store_id][]" value="<?=$row->store_id?>"></td>
			    <td><input type="text" name="stock[min_qty][]" value="<?=$row->min_qty?>"></td>
			    <td><input type="text" name="stock[max_qty][]" value="<?=$row->max_qty?>"></td>
			</tr>
			<?php endforeach; ?>
                        </tbody>

                        
                    </table>
                </div>

        </div>
        <div class="modal-footer">
            <input type="submit" name="update" value="Update" class="btn btn-primary">
        </div>
    </div>
    
</div>
<?= form_close(); ?>
<?= $modal_js ?>