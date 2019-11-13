<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style>
    .table td:first-child {
        font-weight: bold;
    }

    label {
        margin-right: 10px;
    }
    .permission-container li{
        list-style:none;
        width: 20%;
        float: left;

    }
</style>
<script>
    $(document).ready(function(){
        $('.checkbox').attr('disabled',true);
    });
</script>
<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-folder-open"></i><?= lang('group_permissions'); ?></h2>
    </div>
    <div class="box-content permission-container">
        <div class="row">
            <div class="col-lg-12">

                <p class="introtext"><?= lang("view_permissions"); ?></p>

                <?php if (!empty($p)) {
                    if ($p->group_id != 1) {

                        echo admin_form_open("system_settings/permissions/" . $id); ?>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">

                                <thead>
                                <tr>
                                    <th colspan="6"
                                        class="text-center"><?php echo $group->description . ' ( ' . $group->name . ' ) ' . $this->lang->line("group_permissions"); ?></th>
                                </tr>
                                <tr>
                                    <th rowspan="2" class="text-center"><?= lang("module_name"); ?>
                                    </th>
                                    <th colspan="5" class="text-center"><?= lang("permissions"); ?></th>
                                </tr>
                                <tr>
                                    <th class="text-center"><?= lang("view"); ?></th>
                                    <th class="text-center"><?= lang("add"); ?></th>
                                    <th class="text-center"><?= lang("edit"); ?></th>
                                    <th class="text-center"><?= lang("delete"); ?></th>
                                    <th class="text-center"><?= lang("misc"); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><?= lang("products"); ?></td>
                                    <td class="text-center">
                                        <input type="checkbox" value="1" class="checkbox skip" name="products-index" <?php echo $p->{'products-index'} ? "checked" : ''; ?>>
                                    </td>
                                    <td class="text-center">
                                        <input type="checkbox" value="1" class="checkbox skip" name="products-add" <?php echo $p->{'products-add'} ? "checked" : ''; ?>>
                                    </td>
                                    <td class="text-center">
                                        <input type="checkbox" value="1" class="checkbox skip" name="products-edit" <?php echo $p->{'products-edit'} ? "checked" : ''; ?>>
                                    </td>
                                    <td class="text-center">
                                        <input type="checkbox" value="1" class="checkbox skip" name="products-delete" <?php echo $p->{'products-delete'} ? "checked" : ''; ?>>
                                    </td>
                                    <td>
                                        
                                        <span style="display:inline-block;">
                                            <input type="checkbox" value="1" id="products-adjustments" class="checkbox skip" name="products-adjustments" <?php echo $p->{'products-adjustments'} ? "checked" : ''; ?>>
                                            <label for="products-adjustments" class="padding05"><?= lang('adjustments') ?></label>
                                        </span>
                                        <span style="display:inline-block;">
                                            <input type="checkbox" value="1" id="products-barcode" class="checkbox skip" name="products-barcode" <?php echo $p->{'products-barcode'} ? "checked" : ''; ?>>
                                            <label for="products-barcode" class="padding05"><?= lang('print_barcodes') ?></label>
                                        </span>
                                        <span style="display:inline-block;">
                                            <input type="checkbox" value="1" id="products-stock_count" class="checkbox skip" name="products-stock_count" <?php echo $p->{'products-stock_count'} ? "checked" : ''; ?>>
                                            <label for="products-stock_count" class="padding05"><?= lang('stock_counts') ?></label>
                                        </span>
                                        <span style="display:inline-block;">
                                            <input type="checkbox" value="1" id="products-selling_price_change" class="checkbox skip" name="products-selling_price_change" <?php echo $p->{'products-selling_price_change'} ? "checked" : ''; ?>>
                                            <label for="products-selling_price_change" class="padding05"><?= lang('update_selling_price') ?></label>
                                        </span>
                                    </td>
                                </tr>

                                

                                

                                
                                
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive">
                            
                            <table class="table table-bordered table-hover table-striped">
                                <thead><tr><th colspan="6" class="text-center">People - Group Permissions</th></tr></thead>
                                <tbody>
                                    <tr class="users">
                                        <td><?= lang("users"); ?></td>
                                        <td colspan="5">
                                            <ul>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="auth-index" name="auth-index" <?php echo $p->{'auth-index'} ? "checked" : ''; ?>>
                                                    <label for="auth-index" class="padding05"><?= lang('list') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="auth-add" name="auth-add" <?php echo $p->{'auth-add'} ? "checked" : ''; ?>>
                                                    <label for="auth-add" class="padding05"><?= lang('add') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="auth-edit" name="auth-edit" <?php echo $p->{'auth-edit'} ? "checked" : ''; ?>>
                                                    <label for="auth-edit" class="padding05"><?= lang('edit') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="auth-view" name="auth-view" <?php echo $p->{'auth-view'} ? "checked" : ''; ?>>
                                                    <label for="auth-view" class="padding05"><?= lang('view') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="auth-delete" name="auth-delete" <?php echo $p->{'auth-delete'} ? "checked" : ''; ?>>
                                                    <label for="auth-delete" class="padding05"><?= lang('delete') ?></label>
                                                </span>
                                                </li>
                                            </ul>
                                        </td>
                                     </tr>
                                    
                                     <tr class="customers">
                                        <td><?= lang("customers"); ?></td>
                                        <td colspan="5">
                                            <ul>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="customers-index" name="customers-index" <?php echo $p->{'customers-index'} ? "checked" : ''; ?>>
                                                    <label for="customers-index" class="padding05"><?= lang('list') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="customers-add" name="customers-add" <?php echo $p->{'customers-add'} ? "checked" : ''; ?>>
                                                    <label for="customers-add" class="padding05"><?= lang('add') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="customers-edit" name="customers-edit" <?php echo $p->{'customers-edit'} ? "checked" : ''; ?>>
                                                    <label for="customers-edit" class="padding05"><?= lang('edit') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="customers-view" name="customers-view" <?php echo $p->{'customers-view'} ? "checked" : ''; ?>>
                                                    <label for="customers-view" class="padding05"><?= lang('view') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="customers-delete" name="customers-delete" <?php echo $p->{'customers-delete'} ? "checked" : ''; ?>>
                                                    <label for="customers-delete" class="padding05"><?= lang('delete') ?></label>
                                                </span>
                                                </li>
                                            </ul>
                                        </td>
                                     </tr>
                                     
                                     <tr class="suppliers">
                                        <td><?= lang("suppliers"); ?></td>
                                        <td colspan="5">
                                            <ul>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="suppliers-index" name="suppliers-index" <?php echo $p->{'suppliers-index'} ? "checked" : ''; ?>>
                                                    <label for="suppliers-index" class="padding05"><?= lang('list') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="suppliers-add" name="suppliers-add" <?php echo $p->{'suppliers-add'} ? "checked" : ''; ?>>
                                                    <label for="suppliers-add" class="padding05"><?= lang('add') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="suppliers-edit" name="suppliers-edit" <?php echo $p->{'suppliers-edit'} ? "checked" : ''; ?>>
                                                    <label for="suppliers-edit" class="padding05"><?= lang('edit') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="suppliers-view" name="suppliers-view" <?php echo $p->{'suppliers-view'} ? "checked" : ''; ?>>
                                                    <label for="suppliers-view" class="padding05"><?= lang('view') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="suppliers-delete" name="suppliers-delete" <?php echo $p->{'suppliers-delete'} ? "checked" : ''; ?>>
                                                    <label for="suppliers-delete" class="padding05"><?= lang('delete') ?></label>
                                                </span>
                                                </li>
                                            </ul>
                                        </td>
                                     </tr>
                                    <tr>
                                    <td><?= lang("customer_fields_required"); ?></td>
                                    <td colspan="5">
                                        <span style="display:inline-block;">
                                            <input type="checkbox" value="1" class="checkbox skip" id="customer_name"
                                            name="customer_name" <?php echo $p->customer_name ? "checked" : ''; ?>>
                                            <label for="customer_name" class="padding05"><?= lang('name') ?></label>
                                        </span>
                                        <span style="display:inline-block;">
                                            <input type="checkbox" value="1" class="checkbox skip" id="customer_passport_number"
                                            name="customer_passport_number" <?php echo $p->customer_passport_number ? "checked" : ''; ?>>
                                            <label for="customer_passport_number" class="padding05"><?= lang('passport_number') ?></label>
                                        </span>
                                        <span style="display:inline-block;">
                                            <input type="checkbox" value="1" class="checkbox skip" id="customer_gender"
                                            name="customer_gender" <?php echo $p->customer_gender ? "checked" : ''; ?>>
                                            <label for="customer_gender" class="padding05"><?= lang('gender') ?></label>
                                        </span>
                                        <span style="display:inline-block;">
                                            <input type="checkbox" value="1" class="checkbox skip" id="customer_nationality"
                                            name="customer_nationality" <?php echo $p->customer_nationality ? "checked" : ''; ?>>
                                            <label for="customer_nationality" class="padding05"><?= lang('nationality') ?></label>
                                        </span>
                                        <span style="display:inline-block;">
                                            <input type="checkbox" value="1" class="checkbox skip" id="customer_dob"
                                            name="customer_dob" <?php echo $p->customer_dob ? "checked" : ''; ?>>
                                            <label for="customer_dob" class="padding05"><?= lang('dob') ?></label>
                                        </span>
                                    </td>
                                </tr>

                                
                                
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead><tr><th colspan="6" class="text-center">Gift Voucher - Group Permissions</th></tr></thead>
                                <tbody>
                                    
                                     <tr class="giftvoucher_master">
                                        <td><?= lang("giftvoucher_master"); ?></td>
                                        <td colspan="5">
                                            <ul>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="giftvoucher-index" name="giftvoucher-index" <?php echo $p->{'giftvoucher-index'} ? "checked" : ''; ?>>
                                                    <label for="giftvoucher-index" class="padding05"><?= lang('list') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="giftvoucher-add" name="giftvoucher-add" <?php echo $p->{'giftvoucher-add'} ? "checked" : ''; ?>>
                                                    <label for="giftvoucher-add" class="padding05"><?= lang('add') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="giftvoucher-edit" name="giftvoucher-edit" <?php echo $p->{'giftvoucher-edit'} ? "checked" : ''; ?>>
                                                    <label for="giftvoucher-edit" class="padding05"><?= lang('edit') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="giftvoucher-view" name="giftvoucher-view" <?php echo $p->{'giftvoucher-view'} ? "checked" : ''; ?>>
                                                    <label for="giftvoucher-view" class="padding05"><?= lang('view') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="giftvoucher-delete" name="giftvoucher-delete" <?php echo $p->{'giftvoucher-delete'} ? "checked" : ''; ?>>
                                                    <label for="giftvoucher-delete" class="padding05"><?= lang('delete') ?></label>
                                                </span>
                                                </li>
                                            </ul>
                                        </td>
                                     </tr>
                                     
                                     <tr class="giftvoucher_details">
                                        <td><?= lang("giftvoucher_details"); ?></td>
                                        <td colspan="5">
                                            <ul>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="giftvoucher-gv_details" name="giftvoucher-gv_details" <?php echo $p->{'giftvoucher-gv_details'} ? "checked" : ''; ?>>
                                                    <label for="giftvoucher-gv_details" class="padding05"><?= lang('list') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="giftvoucher-create_giftvoucher" name="giftvoucher-create_giftvoucher" <?php echo $p->{'giftvoucher-create_giftvoucher'} ? "checked" : ''; ?>>
                                                    <label for="giftvoucher-create_giftvoucher" class="padding05"><?= lang('add') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="giftvoucher-assign" name="giftvoucher-assign" <?php echo $p->{'giftvoucher-assign'} ? "checked" : ''; ?>>
                                                    <label for="giftvoucher-assign" class="padding05"><?= lang('assign') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="giftvoucher-view_voucher" name="giftvoucher-view_voucher" <?php echo $p->{'giftvoucher-view_voucher'} ? "checked" : ''; ?>>
                                                    <label for="giftvoucher-view_voucher" class="padding05"><?= lang('view') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="giftvoucher-delete_voucher" name="giftvoucher-delete_voucher" <?php echo $p->{'giftvoucher-delete_voucher'} ? "checked" : ''; ?>>
                                                    <label for="giftvoucher-delete_voucher" class="padding05"><?= lang('delete') ?></label>
                                                </span>
                                                </li>
                                            </ul>
                                        </td>
                                     </tr>
                                     
                                     <tr class="issue_giftvoucher">
                                        <td><?= lang("issue_giftvoucher"); ?></td>
                                        <td colspan="5">
                                            <ul>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="giftvoucher-giftvoucher_issued" name="giftvoucher-giftvoucher_issued" <?php echo $p->{'giftvoucher-giftvoucher_issued'} ? "checked" : ''; ?>>
                                                    <label for="giftvoucher-giftvoucher_issued" class="padding05"><?= lang('list') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="giftvoucher-issue" name="giftvoucher-issue" <?php echo $p->{'giftvoucher-issue'} ? "checked" : ''; ?>>
                                                    <label for="giftvoucher-issue" class="padding05"><?= lang('issue') ?></label>
                                                </span>
                                                </li>
                                               
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="giftvoucher-view_issued_voucher" name="giftvoucher-view_issued_voucher" <?php echo $p->{'giftvoucher-view_issued_voucher'} ? "checked" : ''; ?>>
                                                    <label for="giftvoucher-view_issued_voucher" class="padding05"><?= lang('view') ?></label>
                                                </span>
                                                </li>
                                               
                                            </ul>
                                        </td>
                                     </tr>
                                     
                                     <tr class="block_giftvoucher">
                                        <td><?= lang("block_giftvoucher"); ?></td>
                                        <td colspan="5">
                                            <ul>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="giftvoucher-blocked_giftvouchers" name="giftvoucher-blocked_giftvouchers" <?php echo $p->{'giftvoucher-blocked_giftvouchers'} ? "checked" : ''; ?>>
                                                    <label for="giftvoucher-blocked_giftvouchers" class="padding05"><?= lang('list') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="giftvoucher-block" name="giftvoucher-block" <?php echo $p->{'giftvoucher-block'} ? "checked" : ''; ?>>
                                                    <label for="giftvoucher-block" class="padding05"><?= lang('block') ?></label>
                                                </span>
                                                </li>
                                               
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="giftvoucher-view_blocked_voucher" name="giftvoucher-view_blocked_voucher" <?php echo $p->{'giftvoucher-view_blocked_voucher'} ? "checked" : ''; ?>>
                                                    <label for="giftvoucher-view_blocked_voucher" class="padding05"><?= lang('view') ?></label>
                                                </span>
                                                </li>
                                               
                                            </ul>
                                        </td>
                                     </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped settings-table">

                                <thead>
                               <tr>
                                    <th colspan="6"
                                        class="text-center">Settings -  <?= $page_title; ?></th>
                                </tr>
                                </thead>
                                <tbody>
				    <tr>
                                    <td><?= lang("printers"); ?></td>
                                    <td colspan="5">
                                        <span style="display:inline-block">
                                        
                                            <input type="checkbox" value="1" class="checkbox skip" id="pos-printers"
                                            name="pos-printers" <?php echo $p->{'pos-printers'} ? "checked" : ''; ?>>
                                            <label for="pos-printers" class="padding05"><?= lang('list') ?></label>
                                        </span>
					<span style="display:inline-block">
                                            <input type="checkbox" value="1" class="checkbox skip" id="pos-add_printer"
                                            name="pos-add_printer" <?php echo $p->{'pos-add_printer'} ? "checked" : ''; ?>>
                                            <label for="pos-add_printer" class="padding05"><?= lang('add') ?></label>
                                        </span>
                                        <span style="display:inline-block">
                                            <input type="checkbox" value="1" class="checkbox skip" id="pos-edit_printer"
                                            name="pos-edit_printer" <?php echo $p->{'pos-edit_printer'} ? "checked" : ''; ?>>
                                            <label for="pos-edit_printer" class="padding05"><?= lang('edit') ?></label>
                                        </span>
                                        <span style="display:inline-block">
                                            <input type="checkbox" value="1" class="checkbox skip" id="pos-view_printer"
                                            name="pos-view_printer" <?php echo $p->{'pos-view_printer'} ? "checked" : ''; ?>>
                                            <label for="pos-view_printer" class="padding05"><?= lang('view') ?></label>
                                        </span>
                                        <span style="display:inline-block">
                                            <input type="checkbox" value="1" class="checkbox skip" id="pos-delete_printer"
                                            name="pos-delete_printer" <?php echo $p->{'pos-delete_printer'} ? "checked" : ''; ?>>
                                            <label for="pos-delete_printer" class="padding05"><?= lang('delete') ?></label>
                                        </span>                                       
                                    </td>
                                </tr>
				    <tr>
                                    <td><?= lang("tender_type"); ?></td>
                                    <td colspan="5">
                                        <span style="display:inline-block">
                                        
                                            <input type="checkbox" value="1" class="checkbox skip" id="system_settings-payment_methods"
                                            name="system_settings-payment_methods" <?php echo $p->{'system_settings-payment_methods'} ? "checked" : ''; ?>>
                                            <label for="system_settings-payment_methods" class="padding05"><?= lang('list') ?></label>
                                        </span>
					<span style="display:inline-block">
                                            <input type="checkbox" value="1" class="checkbox skip" id="system_settings-add_payment_method"
                                            name="system_settings-add_payment_method" <?php echo $p->{'system_settings-add_payment_method'} ? "checked" : ''; ?>>
                                            <label for="system_settings-add_payment_method" class="padding05"><?= lang('add') ?></label>
                                        </span>
                                        <span style="display:inline-block">
                                            <input type="checkbox" value="1" class="checkbox skip" id="system_settings-tender_type_status"
                                            name="system_settings-tender_type_status" <?php echo $p->{'system_settings-tender_type_status'} ? "checked" : ''; ?>>
                                            <label for="system_settings-tender_type_status" class="padding05"><?= lang('status') ?></label>
                                        </span>
                                        <input type="checkbox" value="1" class="checkbox skip" id="system_settings-payment_method_options"
                                            name="system_settings-payment_method_options" <?php echo $p->{'system_settings-payment_method_options'} ? "checked" : ''; ?>>
                                            <label for="system_settings-payment_method_options" class="padding05"><?= lang('options') ?></label>
                                        </span>
                                    </td>
                                </tr>
				    
				    <tr>
					<td><?= lang("logo"); ?></td>
					<td colspan="5">
					    <span style="display:inline-block">
					    
						<input type="checkbox" value="1" class="checkbox skip" id="system_settings-change_logo"
						name="system_settings-change_logo" <?php echo $p->{'system_settings-change_logo'} ? "checked" : ''; ?>>
						<label for="system_settings-change_logo" class="padding05"><?= lang('change') ?></label>
					    </span>
					</td>
				    </tr>
				    <tr>
					<td><?= lang("currencies"); ?></td>
					<td colspan="5">
					    <span style="display:inline-block">					    
						<input type="checkbox" value="1" class="checkbox skip" id="system_settings-currencies"
						name="system_settings-currencies" <?php echo $p->{'system_settings-currencies'} ? "checked" : ''; ?>>
						<label for="system_settings-currencies" class="padding05"><?= lang('view') ?></label>
					    </span>
					    <span style="display:inline-block">					    
						<input type="checkbox" value="1" class="checkbox skip" id="system_settings-add_currency"
						name="system_settings-add_currency" <?php echo $p->{'system_settings-add_currency'} ? "checked" : ''; ?>>
						<label for="system_settings-add_currency" class="padding05"><?= lang('add') ?></label>
					    </span>
					    <span style="display:inline-block">					    
						<input type="checkbox" value="1" class="checkbox skip" id="system_settings-edit_currency"
						name="system_settings-edit_currency" <?php echo $p->{'system_settings-edit_currency'} ? "checked" : ''; ?>>
						<label for="system_settings-edit_currency" class="padding05"><?= lang('edit') ?></label>
					    </span>
					    <span style="display:inline-block">					    
						<input type="checkbox" value="1" class="checkbox skip" id="system_settings-delete_currency"
						name="system_settings-delete_currency" <?php echo $p->{'system_settings-delete_currency'} ? "checked" : ''; ?>>
						<label for="system_settings-delete_currency" class="padding05"><?= lang('delete') ?></label>
					    </span>
                                            <span style="display:inline-block">					    
						<input type="checkbox" value="1" class="checkbox skip" id="system_settings-exchange_rates"
						name="system_settings-exchange_rates" <?php echo $p->{'system_settings-exchange_rates'} ? "checked" : ''; ?>>
						<label for="system_settings-exchange_rates" class="padding05"><?= lang('update/import exchange_rates') ?></label>
					    </span><span style="display:inline-block">					    
						<input type="checkbox" value="1" class="checkbox skip" id="system_settings-view_exchange_rates"
						name="system_settings-view_exchange_rates" <?php echo $p->{'system_settings-view_exchange_rates'} ? "checked" : ''; ?>>
						<label for="system_settings-view_exchange_rates" class="padding05"><?= lang('view_exchange_rates') ?></label>
					    </span>
					</td>
				    </tr>
				    <tr>
					<td><?= lang("customer_groups"); ?></td>
					<td colspan="5">
					    <span style="display:inline-block">					    
						<input type="checkbox" value="1" class="checkbox skip" id="system_settings-customer_groups"
						name="system_settings-customer_groups" <?php echo $p->{'system_settings-customer_groups'} ? "checked" : ''; ?>>
						<label for="system_settings-customer_groups" class="padding05"><?= lang('list') ?></label>
					    </span>
					    <span style="display:inline-block">					    
						<input type="checkbox" value="1" class="checkbox skip" id="system_settings-add_customer_group"
						name="system_settings-add_customer_group" <?php echo $p->{'system_settings-add_customer_group'} ? "checked" : ''; ?>>
						<label for="system_settings-add_customer_group" class="padding05"><?= lang('add') ?></label>
					    </span>
					    <span style="display:inline-block">					    
						<input type="checkbox" value="1" class="checkbox skip" id="system_settings-edit_customer_group"
						name="system_settings-edit_customer_group" <?php echo $p->{'system_settings-edit_customer_group'} ? "checked" : ''; ?>>
						<label for="system_settings-edit_customer_group" class="padding05"><?= lang('edit') ?></label>
					    </span>
                                            <span style="display:inline-block">					    
						<input type="checkbox" value="1" class="checkbox skip" id="system_settings-view_customer_group"
						name="system_settings-view_customer_group" <?php echo $p->{'system_settings-view_customer_group'} ? "checked" : ''; ?>>
						<label for="system_settings-view_customer_group" class="padding05"><?= lang('view') ?></label>
					    </span>
					    <span style="display:inline-block">					    
						<input type="checkbox" value="1" class="checkbox skip" id="system_settings-delete_customer_group"
						name="system_settings-delete_customer_group" <?php echo $p->{'system_settings-delete_customer_group'} ? "checked" : ''; ?>>
						<label for="system_settings-delete_customer_group" class="padding05"><?= lang('delete') ?></label>
					    </span>
					</td>
				    </tr>
				    <tr>
					<td><?= lang("categories"); ?></td>
					<td colspan="5">
					    <span style="display:inline-block">					    
						<input type="checkbox" value="1" class="checkbox skip" id="system_settings-categories"
						name="system_settings-categories" <?php echo $p->{'system_settings-categories'} ? "checked" : ''; ?>>
						<label for="system_settings-categories" class="padding05"><?= lang('view') ?></label>
					    </span>
					    <span style="display:inline-block">					    
						<input type="checkbox" value="1" class="checkbox skip" id="system_settings-add_category"
						name="system_settings-add_category" <?php echo $p->{'system_settings-add_category'} ? "checked" : ''; ?>>
						<label for="system_settings-add_category" class="padding05"><?= lang('add') ?></label>
					    </span>
					    <span style="display:inline-block">					    
						<input type="checkbox" value="1" class="checkbox skip" id="system_settings-edit_category"
						name="system_settings-edit_category" <?php echo $p->{'system_settings-edit_category'} ? "checked" : ''; ?>>
						<label for="system_settings-edit_category" class="padding05"><?= lang('edit') ?></label>
					    </span>
					    <span style="display:inline-block">					    
						<input type="checkbox" value="1" class="checkbox skip" id="system_settings-delete_category"
						name="system_settings-delete_category" <?php echo $p->{'system_settings-delete_category'} ? "checked" : ''; ?>>
						<label for="system_settings-delete_category" class="padding05"><?= lang('delete') ?></label>
					    </span>
					  <!--  <span style="display:inline-block">					    
						<input type="checkbox" value="1" class="checkbox skip" id="products-barcode"
						name="products-barcode" <?php echo $p->{'products-barcode'} ? "checked" : ''; ?>>
						<label for="products-barcode" class="padding05"><?= lang('print_barcodes') ?></label>
					    </span>-->
					</td>
				    </tr>
				    
				    <tr>
					<td><?= lang("expense_categories"); ?></td>
					<td colspan="5">
					    <span style="display:inline-block">					    
						<input type="checkbox" value="1" class="checkbox skip" id="system_settings-expense_categories"
						name="system_settings-expense_categories" <?php echo $p->{'system_settings-expense_categories'} ? "checked" : ''; ?>>
						<label for="system_settings-expense_categories" class="padding05"><?= lang('list') ?></label>
					    </span>
					    <span style="display:inline-block">					    
						<input type="checkbox" value="1" class="checkbox skip" id="system_settings-add_expense_category"
						name="system_settings-add_expense_category" <?php echo $p->{'system_settings-add_expense_category'} ? "checked" : ''; ?>>
						<label for="system_settings-add_expense_category" class="padding05"><?= lang('add') ?></label>
					    </span>
					    <span style="display:inline-block">					    
						<input type="checkbox" value="1" class="checkbox skip" id="system_settings-edit_expense_category"
						name="system_settings-edit_expense_category" <?php echo $p->{'system_settings-edit_expense_category'} ? "checked" : ''; ?>>
						<label for="system_settings-edit_expense_category" class="padding05"><?= lang('edit') ?></label>
					    </span>
                                            <span style="display:inline-block">					    
						<input type="checkbox" value="1" class="checkbox skip" id="system_settings-view_expense_category"
						name="system_settings-view_expense_category" <?php echo $p->{'system_settings-view_expense_category'} ? "checked" : ''; ?>>
						<label for="system_settings-view_expense_category" class="padding05"><?= lang('view') ?></label>
					    </span>
					    <span style="display:inline-block">					    
						<input type="checkbox" value="1" class="checkbox skip" id="system_settings-delete_expense_category"
						name="system_settings-delete_expense_category" <?php echo $p->{'system_settings-delete_expense_category'} ? "checked" : ''; ?>>
						<label for="system_settings-delete_expense_category" class="padding05"><?= lang('delete') ?></label>
					    </span>
					</td>
				    </tr>
				    <tr>
					<td><?= lang("units"); ?></td>
					<td colspan="5">
					    <span style="display:inline-block">					    
						<input type="checkbox" value="1" class="checkbox skip" id="system_settings-units"
						name="system_settings-units" <?php echo $p->{'system_settings-units'} ? "checked" : ''; ?>>
						<label for="system_settings-units" class="padding05"><?= lang('list') ?></label>
					    </span>
					    <span style="display:inline-block">					    
						<input type="checkbox" value="1" class="checkbox skip" id="system_settings-add_unit"
						name="system_settings-add_unit" <?php echo $p->{'system_settings-add_unit'} ? "checked" : ''; ?>>
						<label for="system_settings-add_unit" class="padding05"><?= lang('add') ?></label>
					    </span>
					    <span style="display:inline-block">					    
						<input type="checkbox" value="1" class="checkbox skip" id="system_settings-edit_unit"
						name="system_settings-edit_unit" <?php echo $p->{'system_settings-edit_unit'} ? "checked" : ''; ?>>
						<label for="system_settings-edit_unit" class="padding05"><?= lang('edit') ?></label>
					    </span>
                                            <span style="display:inline-block">					    
						<input type="checkbox" value="1" class="checkbox skip" id="system_settings-view_unit"
						name="system_settings-view_unit" <?php echo $p->{'system_settings-view_unit'} ? "checked" : ''; ?>>
						<label for="system_settings-view_unit" class="padding05"><?= lang('view') ?></label>
					    </span>
					    <span style="display:inline-block">					    
						<input type="checkbox" value="1" class="checkbox skip" id="system_settings-delete_unit"
						name="system_settings-delete_unit" <?php echo $p->{'system_settings-delete_unit'} ? "checked" : ''; ?>>
						<label for="system_settings-delete_unit" class="padding05"><?= lang('delete') ?></label>
					    </span>
					</td>
				    </tr>
				    <tr>
					<td><?= lang("brands"); ?></td>
					<td colspan="5">
					    <span style="display:inline-block">					    
						<input type="checkbox" value="1" class="checkbox skip" id="system_settings-brands"
						name="system_settings-brands" <?php echo $p->{'system_settings-brands'} ? "checked" : ''; ?>>
						<label for="system_settings-brands" class="padding05"><?= lang('view') ?></label>
					    </span>
					    <span style="display:inline-block">					    
						<input type="checkbox" value="1" class="checkbox skip" id="system_settings-add_brand"
						name="system_settings-add_brand" <?php echo $p->{'system_settings-add_brand'} ? "checked" : ''; ?>>
						<label for="system_settings-add_brand" class="padding05"><?= lang('add/import') ?></label>
					    </span>
					    <span style="display:inline-block">					    
						<input type="checkbox" value="1" class="checkbox skip" id="system_settings-edit_brand"
						name="system_settings-edit_brand" <?php echo $p->{'system_settings-edit_brand'} ? "checked" : ''; ?>>
						<label for="system_settings-edit_brand" class="padding05"><?= lang('edit') ?></label>
					    </span>
                                            <span style="display:inline-block">					    
						<input type="checkbox" value="1" class="checkbox skip" id="system_settings-view_brand"
						name="system_settings-view_brand" <?php echo $p->{'system_settings-view_brand'} ? "checked" : ''; ?>>
						<label for="system_settings-view_brand" class="padding05"><?= lang('view') ?></label>
					    </span>
					    <span style="display:inline-block">					    
						<input type="checkbox" value="1" class="checkbox skip" id="system_settings-delete_brand"
						name="system_settings-delete_brand" <?php echo $p->{'system_settings-delete_brand'} ? "checked" : ''; ?>>
						<label for="system_settings-delete_brand" class="padding05"><?= lang('delete') ?></label>
					    </span>
					</td>
				    </tr>
				    
				    <tr>
					<td><?= lang("tax_rates"); ?></td>
					<td colspan="5">
					    <span style="display:inline-block">					    
						<input type="checkbox" value="1" class="checkbox skip" id="system_settings-tax_rates"
						name="system_settings-tax_rates" <?php echo $p->{'system_settings-tax_rates'} ? "checked" : ''; ?>>
						<label for="system_settings-tax_rates" class="padding05"><?= lang('list') ?></label>
					    </span>
					    <span style="display:inline-block">					    
						<input type="checkbox" value="1" class="checkbox skip" id="system_settings-add_tax_rate"
						name="system_settings-add_tax_rate" <?php echo $p->{'system_settings-add_tax_rate'} ? "checked" : ''; ?>>
						<label for="system_settings-add_tax_rate" class="padding05"><?= lang('add') ?></label>
					    </span>
					    <span style="display:inline-block">					    
						<input type="checkbox" value="1" class="checkbox skip" id="system_settings-edit_tax_rate"
						name="system_settings-edit_tax_rate" <?php echo $p->{'system_settings-edit_tax_rate'} ? "checked" : ''; ?>>
						<label for="system_settings-edit_tax_rate" class="padding05"><?= lang('edit') ?></label>
					    </span>
                                            <span style="display:inline-block">					    
						<input type="checkbox" value="1" class="checkbox skip" id="system_settings-view_tax_rate"
						name="system_settings-view_tax_rate" <?php echo $p->{'system_settings-view_tax_rate'} ? "checked" : ''; ?>>
						<label for="system_settings-view_tax_rate" class="padding05"><?= lang('view') ?></label>
					    </span>
					    <span style="display:inline-block">					    
						<input type="checkbox" value="1" class="checkbox skip" id="system_settings-delete_tax_rate"
						name="system_settings-delete_tax_rate" <?php echo $p->{'system_settings-delete_tax_rate'} ? "checked" : ''; ?>>
						<label for="system_settings-delete_tax_rate" class="padding05"><?= lang('delete') ?></label>
					    </span>
					</td>
				    </tr>
                                    <tr>
				    
				    <tr>
					<td><?= lang("backups"); ?></td>
					<td colspan="5">
					    <span style="display:inline-block">					    
						<input type="checkbox" value="1" class="checkbox skip" id="system_settings-backups"
						name="system_settings-backups" <?php echo $p->{'system_settings-backups'} ? "checked" : ''; ?>>
						<label for="system_settings-backups" class="padding05"><?= lang('view') ?></label>
					    </span>
					    <span style="display:inline-block">					    
						<input type="checkbox" value="1" class="checkbox skip" id="system_settings-backup_database"
						name="system_settings-backup_database" <?php echo $p->{'system_settings-backup_database'} ? "checked" : ''; ?>>
						<label for="system_settings-backup_database" class="padding05"><?= lang('backup') ?></label>
					    </span>
					    <span style="display:inline-block">					    
						<input type="checkbox" value="1" class="checkbox skip" id="system_settings-download_database"
						name="system_settings-download_database" <?php echo $p->{'system_settings-download_database'} ? "checked" : ''; ?>>
						<label for="system_settings-download_database" class="padding05"><?= lang('download_database') ?></label>
					    </span>
					    <span style="display:inline-block">					    
						<input type="checkbox" value="1" class="checkbox skip" id="system_settings-restore_database"
						name="system_settings-restore_database" <?php echo $p->{'system_settings-restore_database'} ? "checked" : ''; ?>>
						<label for="system_settings-restore_database" class="padding05"><?= lang('restore_database') ?></label>
					    </span>
					    <span style="display:inline-block">					    
						<input type="checkbox" value="1" class="checkbox skip" id="system_settings-delete_database"
						name="system_settings-delete_database" <?php echo $p->{'system_settings-delete_database'} ? "checked" : ''; ?>>
						<label for="system_settings-delete_database" class="padding05"><?= lang('delete_database') ?></label>
					    </span>
					</td>
				    </tr>
                                    
                                     <tr class="tills">
                                        <td><?= lang("tills"); ?></td>
                                        <td colspan="5">
                                            <ul>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="system_settings-tills" name="system_settings-tills" <?php echo $p->{'system_settings-tills'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-tills" class="padding05"><?= lang('list') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="system_settings-add_till" name="system_settings-add_till" <?php echo $p->{'system_settings-add_till'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-add_till" class="padding05"><?= lang('add') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="system_settings-edit_till" name="system_settings-edit_till" <?php echo $p->{'system_settings-edit_till'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-edit_till" class="padding05"><?= lang('edit') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="system_settings-view_till" name="system_settings-view_till" <?php echo $p->{'system_settings-view_till'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-view_till" class="padding05"><?= lang('view') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="system_settings-delete_till" name="system_settings-delete_till" <?php echo $p->{'system_settings-delete_till'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-delete_till" class="padding05"><?= lang('delete') ?></label>
                                                </span>
                                                </li>
                                            </ul>
                                        </td>
                                     </tr>
				</tbody>
			    </table>
			 </div>
                        
                        <div class="table-responsive">
                            
                            <table class="table table-bordered table-hover table-striped">
                                <thead><tr><th colspan="6" class="text-center">Inventory - Group Permissions</th></tr></thead>
                                <tbody>
                                    
                                     <tr class="store_indent_request">
                                        <td><?= lang("store_indent_request"); ?></td>
                                        <td colspan="5">
                                            <ul>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="store_request-index" name="store_request-index" <?php echo $p->{'store_request-index'} ? "checked" : ''; ?>>
                                                    <label for="store_request-index" class="padding05"><?= lang('list') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="store_request-add" name="store_request-add" <?php echo $p->{'store_request-add'} ? "checked" : ''; ?>>
                                                    <label for="store_request-add" class="padding05"><?= lang('add') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="store_request-edit" name="store_request-edit" <?php echo $p->{'store_request-edit'} ? "checked" : ''; ?>>
                                                    <label for="store_request-edit" class="padding05"><?= lang('edit') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="store_request-view" name="store_request-view" <?php echo $p->{'store_request-view'} ? "checked" : ''; ?>>
                                                    <label for="store_request-view" class="padding05"><?= lang('view') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="store_request-delete" name="store_request-delete" <?php echo $p->{'store_request-delete'} ? "checked" : ''; ?>>
                                                    <label for="store_request-delete" class="padding05"><?= lang('delete') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="store_request-approve" name="store_request-approve" <?php echo $p->{'store_request-approve'} ? "checked" : ''; ?>>
                                                    <label for="store_request-approve" class="padding05"><?= lang('approve') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="store_request-process" name="store_request-process" <?php echo $p->{'store_request-process'} ? "checked" : ''; ?>>
                                                    <label for="store_request-process" class="padding05"><?= lang('process') ?></label>
                                                </span>
                                                </li>
                                                
                                            </ul>
                                        </td>
                                     </tr>
                                       <tr class="store_indent_receive">
                                        <td><?= lang("store_indent_receive"); ?></td>
                                        <td colspan="5">
                                            <ul>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="store_indent_receive-index" name="store_indent_receive-index" <?php echo $p->{'store_indent_receive-index'} ? "checked" : ''; ?>>
                                                    <label for="store_indent_receive-index" class="padding05"><?= lang('list') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="store_indent_receive-view" name="store_indent_receive-view" <?php echo $p->{'store_indent_receive-view'} ? "checked" : ''; ?>>
                                                    <label for="store_indent_receive-view" class="padding05"><?= lang('view') ?></label>
                                                </span>
                                                </li>
                                            </ul>
                                        </td>                                                
                                        </tr>
                                       
                                       
                                     <tr class="indent_process">
                                        <td><?= lang("indent_process"); ?></td>
                                        <td colspan="5">
                                            <ul>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="indent_process-index" name="indent_process-index" <?php echo $p->{'indent_process-index'} ? "checked" : ''; ?>>
                                                    <label for="indent_process-index" class="padding05"><?= lang('list') ?></label>
                                                </span>
                                                </li>
                                                <!--<li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="indent_process-add" name="indent_process-add" <?php echo $p->{'indent_process-add'} ? "checked" : ''; ?>>
                                                    <label for="indent_process-add" class="padding05"><?= lang('add') ?></label>
                                                </span>
                                                </li>-->
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="indent_process-edit" name="indent_process-edit" <?php echo $p->{'indent_process-edit'} ? "checked" : ''; ?>>
                                                    <label for="indent_process-edit" class="padding05"><?= lang('edit') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="indent_process-view" name="indent_process-view" <?php echo $p->{'indent_process-view'} ? "checked" : ''; ?>>
                                                    <label for="indent_process-view" class="padding05"><?= lang('view') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="indent_process-approve" name="indent_process-approve" <?php echo $p->{'indent_process-approve'} ? "checked" : ''; ?>>
                                                    <label for="indent_process-approve" class="padding05"><?= lang('approve') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="indent_process-process" name="indent_process-process" <?php echo $p->{'indent_process-process'} ? "checked" : ''; ?>>
                                                    <label for="indent_process-process" class="padding05"><?= lang('process') ?></label>
                                                </span>
                                                </li>
                                                
                                            </ul>
                                        </td>
                                     </tr>
                                     
                                     <tr class="store_transfers">
                                        <td><?= lang("store_transfers"); ?></td>
                                        <td colspan="5">
                                            <ul>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="store_transfers-index" name="store_transfers-index" <?php echo $p->{'store_transfers-index'} ? "checked" : ''; ?>>
                                                    <label for="store_transfers-index" class="padding05"><?= lang('list') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="store_transfers-add" name="store_transfers-add" <?php echo $p->{'store_transfers-add'} ? "checked" : ''; ?>>
                                                    <label for="store_transfers-add" class="padding05"><?= lang('add') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="store_transfers-edit" name="store_transfers-edit" <?php echo $p->{'store_transfers-edit'} ? "checked" : ''; ?>>
                                                    <label for="store_transfers-edit" class="padding05"><?= lang('edit') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="store_transfers-view" name="store_transfers-view" <?php echo $p->{'store_transfers-view'} ? "checked" : ''; ?>>
                                                    <label for="store_transfers-view" class="padding05"><?= lang('view') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="store_transfers-approve" name="store_transfers-approve" <?php echo $p->{'store_transfers-approve'} ? "checked" : ''; ?>>
                                                    <label for="store_transfers-approve" class="padding05"><?= lang('approve') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="store_transfers-process" name="store_transfers-process" <?php echo $p->{'store_transfers-process'} ? "checked" : ''; ?>>
                                                    <label for="store_transfers-process" class="padding05"><?= lang('process') ?></label>
                                                </span>
                                                </li>
                                                
                                            </ul>
                                        </td>
                                     </tr>
                                     
                                     <tr class="store_receivers">
                                        <td><?= lang("store_receivers"); ?></td>
                                        <td colspan="5">
                                            <ul>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="store_receivers-index" name="store_receivers-index" <?php echo $p->{'store_receivers-index'} ? "checked" : ''; ?>>
                                                    <label for="store_receivers-index" class="padding05"><?= lang('list') ?></label>
                                                </span>
                                                </li>
                                                <!-- <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="store_receivers-add" name="store_receivers-add" <?php echo $p->{'store_receivers-add'} ? "checked" : ''; ?>>
                                                    <label for="store_receivers-add" class="padding05"><?= lang('add') ?></label>
                                                </span>
                                                </li>-->
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="store_receivers-edit" name="store_receivers-edit" <?php echo $p->{'store_receivers-edit'} ? "checked" : ''; ?>>
                                                    <label for="store_receivers-edit" class="padding05"><?= lang('edit') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="store_receivers-view" name="store_receivers-view" <?php echo $p->{'store_receivers-view'} ? "checked" : ''; ?>>
                                                    <label for="store_receivers-view" class="padding05"><?= lang('view') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="store_receivers-approve" name="store_receivers-approve" <?php echo $p->{'store_receivers-approve'} ? "checked" : ''; ?>>
                                                    <label for="store_receivers-approve" class="padding05"><?= lang('approve') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="store_receivers-process" name="store_receivers-process" <?php echo $p->{'store_receivers-process'} ? "checked" : ''; ?>>
                                                    <label for="store_receivers-process" class="padding05"><?= lang('process') ?></label>
                                                </span>
                                                </li>
                                                
                                            </ul>
                                        </td>
                                     </tr>
                                     
                                     <tr class="purchase_orders">
                                        <td><?= lang("purchase_orders"); ?></td>
                                        <td colspan="5">
                                            <ul>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="purchase_orders-index" name="purchase_orders-index" <?php echo $p->{'purchase_orders-index'} ? "checked" : ''; ?>>
                                                    <label for="purchase_orders-index" class="padding05"><?= lang('list') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="purchase_orders-add" name="purchase_orders-add" <?php echo $p->{'purchase_orders-add'} ? "checked" : ''; ?>>
                                                    <label for="purchase_orders-add" class="padding05"><?= lang('add') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="purchase_orders-edit" name="purchase_orders-edit" <?php echo $p->{'purchase_orders-edit'} ? "checked" : ''; ?>>
                                                    <label for="purchase_orders-edit" class="padding05"><?= lang('edit') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="purchase_orders-view" name="purchase_orders-view" <?php echo $p->{'purchase_orders-view'} ? "checked" : ''; ?>>
                                                    <label for="purchase_orders-view" class="padding05"><?= lang('view') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="purchase_orders-approve" name="purchase_orders-approve" <?php echo $p->{'purchase_orders-approve'} ? "checked" : ''; ?>>
                                                    <label for="purchase_orders-approve" class="padding05"><?= lang('approve') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="purchase_orders-process" name="purchase_orders-process" <?php echo $p->{'purchase_orders-process'} ? "checked" : ''; ?>>
                                                    <label for="purchase_orders-process" class="padding05"><?= lang('process') ?></label>
                                                </span>
                                                </li>
                                                
                                            </ul>
                                        </td>
                                     </tr>
                                     
                                     <tr class="purchase_invoices">
                                        <td><?= lang("purchase_invoices"); ?></td>
                                        <td colspan="5">
                                            <ul>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="purchase_invoices-index" name="purchase_invoices-index" <?php echo $p->{'purchase_invoices-index'} ? "checked" : ''; ?>>
                                                    <label for="purchase_invoices-index" class="padding05"><?= lang('list') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="purchase_invoices-add" name="purchase_invoices-add" <?php echo $p->{'purchase_invoices-add'} ? "checked" : ''; ?>>
                                                    <label for="purchase_invoices-add" class="padding05"><?= lang('add') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="purchase_invoices-edit" name="purchase_invoices-edit" <?php echo $p->{'purchase_invoices-edit'} ? "checked" : ''; ?>>
                                                    <label for="purchase_invoices-edit" class="padding05"><?= lang('edit') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="purchase_invoices-view" name="purchase_invoices-view" <?php echo $p->{'purchase_invoices-view'} ? "checked" : ''; ?>>
                                                    <label for="purchase_invoices-view" class="padding05"><?= lang('view') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="purchase_invoices-approve" name="purchase_invoices-approve" <?php echo $p->{'purchase_invoices-approve'} ? "checked" : ''; ?>>
                                                    <label for="purchase_invoices-approve" class="padding05"><?= lang('approve') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="purchase_invoices-process" name="purchase_invoices-process" <?php echo $p->{'purchase_invoices-process'} ? "checked" : ''; ?>>
                                                    <label for="purchase_invoices-process" class="padding05"><?= lang('process') ?></label>
                                                </span>
                                                </li>
                                                
                                            </ul>
                                        </td>
                                     </tr>
                                     
                                     <tr class="purchase_returns">
                                        <td><?= lang("purchase_returns"); ?></td>
                                        <td colspan="5">
                                            <ul>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="purchase_returns-index" name="purchase_returns-index" <?php echo $p->{'purchase_returns-index'} ? "checked" : ''; ?>>
                                                    <label for="purchase_returns-index" class="padding05"><?= lang('list') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="purchase_returns-add" name="purchase_returns-add" <?php echo $p->{'purchase_returns-add'} ? "checked" : ''; ?>>
                                                    <label for="purchase_returns-add" class="padding05"><?= lang('add') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="purchase_returns-edit" name="purchase_returns-edit" <?php echo $p->{'purchase_returns-edit'} ? "checked" : ''; ?>>
                                                    <label for="purchase_returns-edit" class="padding05"><?= lang('edit') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="purchase_returns-view" name="purchase_returns-view" <?php echo $p->{'purchase_returns-view'} ? "checked" : ''; ?>>
                                                    <label for="purchase_returns-view" class="padding05"><?= lang('view') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="purchase_returns-approve" name="purchase_returns-approve" <?php echo $p->{'purchase_returns-approve'} ? "checked" : ''; ?>>
                                                    <label for="purchase_returns-approve" class="padding05"><?= lang('approve') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="purchase_returns-process" name="purchase_returns-process" <?php echo $p->{'purchase_returns-process'} ? "checked" : ''; ?>>
                                                    <label for="purchase_returns-process" class="padding05"><?= lang('process') ?></label>
                                                </span>
                                                </li>
                                                
                                            </ul>
                                        </td>
                                     </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive">
                            
                            <table class="table table-bordered table-hover table-striped reports-table">
                                <thead><tr><th colspan="6" class="text-center">Reports - Group Permissions</th></tr></thead>
                                <tbody>
                                    <tr>
                                        <td style="width:100px;"><?= lang("reports"); ?></td>
                                        <td colspan="5">
                                            <ul>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="reports-billwise_summary" name="reports-billwise_summary" <?php echo $p->{'reports-billwise_summary'} ? "checked" : ''; ?>>
                                                    <label for="reports-billwise_summary" class="padding05"><?= lang('billwise_summary') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="reports-daywise_summary" name="reports-daywise_summary" <?php echo $p->{'reports-daywise_summary'} ? "checked" : ''; ?>>
                                                    <label for="reports-daywise_summary" class="padding05"><?= lang('daywise_summary') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="reports-counterwise_summary" name="reports-counterwise_summary" <?php echo $p->{'reports-counterwise_summary'} ? "checked" : ''; ?>>
                                                    <label for="reports-counterwise_summary" class="padding05"><?= lang('counterwise_summary') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="reports-current_stock" name="reports-current_stock" <?php echo $p->{'reports-current_stock'} ? "checked" : ''; ?>>
                                                    <label for="reports-current_stock" class="padding05"><?= lang('current_stock') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="reports-bill_details" name="reports-bill_details" <?php echo $p->{'reports-bill_details'} ? "checked" : ''; ?>>
                                                    <label for="reports-bill_details" class="padding05"><?= lang('bill_details') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="reports-profit_analysis" name="reports-profit_analysis" <?php echo $p->{'reports-profit_analysis'} ? "checked" : ''; ?>>
                                                    <label for="reports-profit_analysis" class="padding05"><?= lang('profit_analysis') ?></label>
                                                </span>
                                                </li>
                                               
                                            </ul>
                                        </td>    
                                    
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                         <div class="table-responsive">
                            
                            <table class="table table-bordered table-hover table-striped">
                                <thead><tr><th colspan="6" class="text-center">Pos - Group Permissions</th></tr></thead>
                                <tbody>
                                     <tr class="sales_bill">
                                        <td><?= lang("sales_bill"); ?></td>
                                        <td colspan="5">
                                            <ul>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="sales-salesbill_screen" name="sales-salesbill_screen" <?php echo $p->{'sales-salesbill_screen'} ? "checked" : ''; ?>>
                                                    <label for="sales-salesbill-screen" class="padding05"><?= lang('billing_screen') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="sales-salesbill_customer_list" name="sales-salesbill_customer_list" <?php echo $p->{'sales-salesbill_customer_list'} ? "checked" : ''; ?>>
                                                    <label for="sales-salesbill-customer-list" class="padding05"><?= lang('customer_list') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="sales-salesbill_hold" name="sales-salesbill_hold" <?php echo $p->{'sales-salesbill_hold'} ? "checked" : ''; ?>>
                                                    <label for="sales-salesbill-hold" class="padding05"><?= lang('hold') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="sales-salesbill_recall" name="sales-salesbill_recall" <?php echo $p->{'sales-salesbill_recall'} ? "checked" : ''; ?>>
                                                    <label for="sales-salesbill-recall" class="padding05"><?= lang('recall') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="sales-salesbill_billdisc" name="sales-salesbill_billdisc" <?php echo $p->{'sales-salesbill_billdisc'} ? "checked" : ''; ?>>
                                                    <label for="sales-salesbill-billdisc" class="padding05"><?= lang('billdisc') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="sales-salesbill_loadso" name="sales-salesbill_loadso" <?php echo $p->{'sales-salesbill_loadso'} ? "checked" : ''; ?>>
                                                    <label for="sales-salesbill-loadso" class="padding05"><?= lang('loadso') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="sales-salesbill_edit" name="sales-salesbill_edit" <?php echo $p->{'sales-salesbill_edit'} ? "checked" : ''; ?>>
                                                    <label for="sales-salesbill-edit" class="padding05"><?= lang('edit') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="sales-salesbill_pay" name="sales-salesbill_pay" <?php echo $p->{'sales-salesbill_pay'} ? "checked" : ''; ?>>
                                                    <label for="sales-salesbill-pay" class="padding05"><?= lang('pay') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="sales-salesbill_reprint" name="sales-salesbill_reprint" <?php echo $p->{'sales-salesbill_reprint'} ? "checked" : ''; ?>>
                                                    <label for="sales-salesbill-reprint" class="padding05"><?= lang('reprint') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="sales-salesbill_addproducts" name="sales-salesbill_addproducts" <?php echo $p->{'sales-salesbill_addproducts'} ? "checked" : ''; ?>>
                                                    <label for="sales-salesbill-addproducts" class="padding05"><?= lang('add_products') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="sales-salesbill_addcustomer" name="sales-salesbill_addcustomer" <?php echo $p->{'sales-salesbill_addcustomer'} ? "checked" : ''; ?>>
                                                    <label for="sales-salesbill-addcustomer" class="padding05"><?= lang('add_customers') ?></label>
                                                </span>
                                                </li>
                                            </ul>
                                        </td>
                                     </tr>
                                
                                    <tr class="sales-salesorder">
                                        <td><?= lang("sales_order"); ?></td>
                                        <td colspan="5">
                                            <ul>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="sales-salesorder_screen" name="sales-salesorder_screen" <?php echo $p->{'sales-salesorder_screen'} ? "checked" : ''; ?>>
                                                    <label for="sales-salesorder-screen" class="padding05"><?= lang('sales-salesorder_screen') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="sales-salesorder_customer_list" name="sales-salesorder_customer_list" <?php echo $p->{'sales-salesorder_customer_list'} ? "checked" : ''; ?>>
                                                    <label for="sales-salesorder-customer-list" class="padding05"><?= lang('customer_list') ?></label>
                                                </span>
                                                </li>
                                               
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="sales-salesorder_billdisc" name="sales-salesorder_billdisc" <?php echo $p->{'sales-salesorder_billdisc'} ? "checked" : ''; ?>>
                                                    <label for="sales-salesorder-billdisc" class="padding05"><?= lang('billdisc') ?></label>
                                                </span>
                                                </li>
                                                
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="sales-salesorder_edit" name="sales-salesorder_edit" <?php echo $p->{'sales-salesorder_edit'} ? "checked" : ''; ?>>
                                                    <label for="sales-salesorder-edit" class="padding05"><?= lang('edit') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="sales-salesorder_save" name="sales-salesorder_save" <?php echo $p->{'sales-salesorder_save'} ? "checked" : ''; ?>>
                                                    <label for="sales-salesorder-save" class="padding05"><?= lang('save') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="sales-salesorder_view" name="sales-salesorder_view" <?php echo $p->{'sales-salesorder_view'} ? "checked" : ''; ?>>
                                                    <label for="sales-salesorder-view" class="padding05"><?= lang('view') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="sales-salesorder_reprint" name="sales-salesorder_reprint" <?php echo $p->{'sales-salesorder_reprint'} ? "checked" : ''; ?>>
                                                    <label for="sales-salesorder-reprint" class="padding05"><?= lang('reprint') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="sales-salesorder_addproducts" name="sales-salesorder_addproducts" <?php echo $p->{'sales-salesorder_addproducts'} ? "checked" : ''; ?>>
                                                    <label for="sales-salesorder-addproducts" class="padding05"><?= lang('add_products') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="sales-salesorder_addcustomer" name="sales-salesorder_addcustomer" <?php echo $p->{'sales-salesorder_addcustomer'} ? "checked" : ''; ?>>
                                                    <label for="sales-salesorder-addcustomer" class="padding05"><?= lang('add_customers') ?></label>
                                                </span>
                                                </li>
                                            </ul>
                                        </td>
                                     </tr>
                                    <tr class="sales-salesreturn">
                                        <td><?= lang("sales_return"); ?></td>
                                        <td colspan="5">
                                            <ul>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="sales-salesreturn_screen" name="sales-salesreturn_screen" <?php echo $p->{'sales-salesreturn_screen'} ? "checked" : ''; ?>>
                                                    <label for="sales-salesreturn-screen" class="padding05"><?= lang('sales-salesreturn_screen') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="sales-salesreturn_customer_list" name="sales-salesreturn_customer_list" <?php echo $p->{'sales-salesreturn_customer_list'} ? "checked" : ''; ?>>
                                                    <label for="sales-salesreturn-customer-list" class="padding05"><?= lang('customer_list') ?></label>
                                                </span>
                                                </li>
                                               
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="sales-salesreturn_billdisc" name="sales-salesreturn_billdisc" <?php echo $p->{'sales-salesreturn_billdisc'} ? "checked" : ''; ?>>
                                                    <label for="sales-salesreturn-billdisc" class="padding05"><?= lang('billdisc') ?></label>
                                                </span>
                                                </li>
                                                
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="sales-salesreturn_edit" name="sales-salesreturn_edit" <?php echo $p->{'sales-salesreturn_edit'} ? "checked" : ''; ?>>
                                                    <label for="sales-salesreturn-edit" class="padding05"><?= lang('edit') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="sales-salesreturn_save" name="sales-salesreturn_save" <?php echo $p->{'sales-salesreturn_save'} ? "checked" : ''; ?>>
                                                    <label for="sales-salesreturn-save" class="padding05"><?= lang('save') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="sales-salesreturn_reprint" name="sales-salesreturn_reprint" <?php echo $p->{'sales-salesreturn_reprint'} ? "checked" : ''; ?>>
                                                    <label for="sales-salesreturn-reprint" class="padding05"><?= lang('reprint') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="sales-salesreturn_addproducts" name="sales-salesreturn_addproducts" <?php echo $p->{'sales-salesreturn_addproducts'} ? "checked" : ''; ?>>
                                                    <label for="sales-salesreturn-addproducts" class="padding05"><?= lang('add_products') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="sales-salesreturn_addcustomer" name="sales-salesreturn_addcustomer" <?php echo $p->{'sales-salesreturn_addcustomer'} ? "checked" : ''; ?>>
                                                    <label for="sales-salesreturn-addcustomer" class="padding05"><?= lang('add_customers') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="sales-salesreturn_loadbills" name="sales-salesreturn_loadbills" <?php echo $p->{'sales-salesreturn_loadbills'} ? "checked" : ''; ?>>
                                                    <label for="sales-salesreturn-loadbills" class="padding05"><?= lang('load_sales_bills') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="sales-salesreturn_view" name="sales-salesreturn_view" <?php echo $p->{'sales-salesreturn_view'} ? "checked" : ''; ?>>
                                                    <label for="sales-salesreturn-view" class="padding05"><?= lang('view') ?></label>
                                                </span>
                                                </li>
                                            </ul>
                                        </td>
                                     </tr>
                                    <tr class="sales-settlement">
                                        <td><?= lang("daily_settlement"); ?></td>
                                        <td colspan="5">
                                            <ul>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="sales-settlement_screen" name="sales-settlement_screen" <?php echo $p->{'sales-settlement_screen'} ? "checked" : ''; ?>>
                                                    <label for="sales-settlement-screen" class="padding05"><?= lang('sales-settlement_screen') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="sales-settlement_save" name="sales-settlement_save" <?php echo $p->{'sales-settlement_save'} ? "checked" : ''; ?>>
                                                    <label for="sales-settlement-save" class="padding05"><?= lang('save') ?></label>
                                                </span>
                                                </li>
                                               
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="sales-settlement_view" name="sales-settlement_view" <?php echo $p->{'sales-settlement_view'} ? "checked" : ''; ?>>
                                                    <label for="sales-settlement-view" class="padding05"><?= lang('view') ?></label>
                                                </span>
                                                </li>
                                                
                                               
                                            </ul>
                                        </td>
                                     </tr>
                                    <tr class="pos_reports">
                                        <td><?= lang("pos_reports"); ?></td>
                                        <td colspan="5">
                                            <ul>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="reports-posreports_daily" name="reports-posreports_daily" <?php echo $p->{'reports-posreports_daily'} ? "checked" : ''; ?>>
                                                    <label for="reports-posreports-daily" class="padding05"><?= lang('reports-posreports_daily') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="reports-posreports_itemwise" name="reports-posreports_itemwise" <?php echo $p->{'reports-posreports_itemwise'} ? "checked" : ''; ?>>
                                                    <label for="reports-posreports-itemwise" class="padding05"><?= lang('itemwise') ?></label>
                                                </span>
                                                </li>
                                            </ul>
                                        </td>
                                     </tr>
                               
                                <tr class="pettycash">
                                        <td><?= lang("pettycash"); ?></td>
                                        <td colspan="5">
                                            <ul>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="pettycash-screen" name="pettycash-screen" <?php echo $p->{'pettycash-screen'} ? "checked" : ''; ?>>
                                                    <label for="pettycash-screen" class="padding05"><?= lang('pettycash-screen') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="pettycash-save" name="pettycash-save" <?php echo $p->{'pettycash-save'} ? "checked" : ''; ?>>
                                                    <label for="pettycash-save" class="padding05"><?= lang('pettycash-save') ?></label>
                                                </span>
                                                </li>
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="pettycash-edit" name="pettycash-edit" <?php echo $p->{'pettycash-edit'} ? "checked" : ''; ?>>
                                                    <label for="pettycash-edit" class="padding05"><?= lang('edit') ?></label>
                                                </span>
                                                </li>
                                               
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="pettycash-view" name="pettycash-view" <?php echo $p->{'pettycash-view'} ? "checked" : ''; ?>>
                                                    <label for="pettycash-view" class="padding05"><?= lang('view') ?></label>
                                                </span>
                                                </li>
                                                
                                                <li>
                                                <span style="display:inline-block">
                                                    <input type="checkbox" value="1" class="checkbox skip" id="pettycash-add-category" name="pettycash-add_category" <?php echo $p->{'pettycash-add_category'} ? "checked" : ''; ?>>
                                                    <label for="pettycash-addcategory" class="padding05"><?= lang('add_category') ?></label>
                                                </span>
                                                </li>
                                                
                                               
                                            </ul>
                                        </td>
                                     </tr>
                                
                                </tbody>
                            </table>
                         </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary"><?=lang('update')?></button>
                        </div>
                        <?php echo form_close();
                    } else {
                        echo $this->lang->line("group_x_allowed");
                    }
                } else {
                    echo $this->lang->line("group_x_allowed");
                } ?>


            </div>
        </div>
    </div>
</div>