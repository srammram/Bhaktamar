<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style>
.table td:first-child {
    font-weight: bold;
}

label {
    margin-right: 10px;
}

.permission-container li {
    list-style: none;
    width: 20%;
    float: left;
}

.reports-table li {
    width: 30%;
}

.tablethback {
    background: #fff !important;
    color: black;

}
</style>

<section class="content-header">
    <h1><?= lang('permission') ?> </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i>
                <?php echo lang('dashboard')?></a></li>
        <li><a href="<?php echo site_url('admin/settings/permission') ?>"> <?= lang('permission') ?> </a></li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h2 class="blue"><i class="fa-fw fa fa-folder-open"></i><?= lang('group_permissions'); ?></h2>
                </div>
                <div class="box-content ">
                    <div class="row">
                        <div class="col-lg-12">
                            <p class="introtext"><?= lang("set_permissions"); ?></p>
                            <?php if (!empty($p)) {
                    if ($p->Group_id != 1) {
                        echo form_open("admin/settings/permissions/" . $id); ?>
                            <div class="table-responsive" style="margin:12px;">
                                <table class="table table-bordered table-hover table-striped" style="margin:0 auto;">
                                    <thead>
                                        <tr>
                                            <th colspan="6" class="text-center">
                                                <?php echo $group->description . ' ( ' . $group->name . ' ) ' . $this->lang->line("group_permissions"); ?>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th rowspan="2" class="text-center"><?= lang("module_name"); ?>
                                            </th>
                                            <th colspan="5" class="text-center"><?= lang("permissions"); ?></th>
                                        </tr>

                                        <th class="text-center tablethback"><?= lang("list"); ?></th>
                                        <th class="text-center tablethback"><?= lang("view"); ?></th>
                                        <th class="text-center tablethback"><?= lang("add"); ?></th>
                                        <th class="text-center tablethback"><?= lang("edit"); ?></th>
                                        <th class="text-center tablethback"><?= lang("delete"); ?></th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- <tr>
                                    <td><?= lang("products"); ?></td>
                                    <td class="text-center">
                                        <input type="checkbox" value="1" class="checkbox" name="products-index" <?php echo $p->{'project_index'} ? "checked" : ''; ?>>
                                    </td>
                                    <td class="text-center">
                                        <input type="checkbox" value="1" class="checkbox" name="products-add" <?php echo $p->{'project_form'} ? "checked" : ''; ?>>
                                    </td>
                                    <td class="text-center">
                                        <input type="checkbox" value="1" class="checkbox" name="products-edit" <?php echo $p->{'project_form'} ? "checked" : ''; ?>>
                                    </td>
                                    <td class="text-center">
                                        <input type="checkbox" value="1" class="checkbox" name="products-delete" <?php echo $p->{'products-delete'} ? "checked" : ''; ?>>
                                    </td>
                                    <td>
                                        
                                        <span style="display:inline-block;">
                                            <input type="checkbox" value="1" id="products-adjustments" class="checkbox" name="products-adjustments" <?php echo $p->{'products-adjustments'} ? "checked" : ''; ?>>
                                            <label for="products-adjustments" class="padding05"><?= lang('adjustments') ?></label>
                                        </span>
                                        <span style="display:inline-block;">
                                            <input type="checkbox" value="1" id="products-barcode" class="checkbox" name="products-barcode" <?php echo $p->{'products-barcode'} ? "checked" : ''; ?>>
                                            <label for="products-barcode" class="padding05"><?= lang('print_barcodes') ?></label>
                                        </span>
                                        <span style="display:inline-block;">
                                            <input type="checkbox" value="1" id="products-stock_count" class="checkbox" name="products-stock_count" <?php echo $p->{'products-stock_count'} ? "checked" : ''; ?>>
                                            <label for="products-stock_count" class="padding05"><?= lang('stock_counts') ?></label>
                                        </span>
                          
					</td>
				    </tr>-->
                                        <tr>
                                            <td><?= lang("projects"); ?></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-project" name="project_index"
                                                        <?php echo $p->{'project_index'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-project"
                                                        class="padding05"><?= lang('list') ?></label>
                                                </span></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-add_project" name="add_project"
                                                        <?php echo $p->{'project_form'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-add_project"
                                                        class="padding05"><?= lang('add') ?></label>
                                                </span></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-edit_project" name="edit_project"
                                                        <?php echo $p->{'project_form_edit'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-edit_project"
                                                        class="padding05"><?= lang('edit') ?></label>
                                                </span></td>

                                            <td> <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-view_project" name="view_project"
                                                        <?php echo $p->{'project_view'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-view_project"
                                                        class="padding05"><?= lang('view') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-delete_project" name="delete_project"
                                                        <?php echo $p->{'project_delete'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-delete_project"
                                                        class="padding05"><?= lang('delete') ?></label>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><?= lang("buildings"); ?></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-building" name="building_index"
                                                        <?php echo $p->{'building_index'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-building"
                                                        class="padding05"><?= lang('list') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-add_building" name="add_building"
                                                        <?php echo $p->{'building_form'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-add_project"
                                                        class="padding05"><?= lang('add') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-edit_building" name="edit_building"
                                                        <?php echo $p->{'building_form_edit'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-edit_buidling"
                                                        class="padding05"><?= lang('edit') ?></label>
                                                </span>
                                            </td>
                                            <td><span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-view_building" name="view_building"
                                                        <?php echo $p->{'building_view'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-view_building"
                                                        class="padding05"><?= lang('view') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-delete_building" name="delete_building"
                                                        <?php echo $p->{'building_delete'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-delete_building"
                                                        class="padding05"><?= lang('delete') ?></label>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><?= lang("floors"); ?></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-floor" name="floor_index"
                                                        <?php echo $p->{'floors_index'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-floor"
                                                        class="padding05"><?= lang('list') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-add_floor" name="add_floor"
                                                        <?php echo $p->{'floors_form'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-add_floor"
                                                        class="padding05"><?= lang('add') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-edit_floor" name="edit_floor"
                                                        <?php echo $p->{'floors_form_edit'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-edit_floor"
                                                        class="padding05"><?= lang('edit') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-view_floor" name="view_floor"
                                                        <?php echo $p->{'floors_view'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-view_floor"
                                                        class="padding05"><?= lang('view') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-delete_floor" name="delete_floor"
                                                        <?php echo $p->{'floors_deleted'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-delete_floor"
                                                        class="padding05"><?= lang('delete') ?></label>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><?= lang("units"); ?></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-units" name="units_index"
                                                        <?php echo $p->{'unit_index'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-units"
                                                        class="padding05"><?= lang('list') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-add_unit" name="add_unit"
                                                        <?php echo $p->{'unit_form'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-add_unit"
                                                        class="padding05"><?= lang('add') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-edit_unit" name="edit_unit"
                                                        <?php echo $p->{'unit_form_edit'} ? "checked" : ''; ?>>
                                                    <label for="edit_unit" class="padding05"><?= lang('edit') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-view_unit" name="view_unit"
                                                        <?php echo $p->{'unit_view'} ? "checked" : ''; ?>>
                                                    <label for="view_unit" class="padding05"><?= lang('view') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-delete_unit" name="delete_unit"
                                                        <?php echo $p->{'unit_delete'} ? "checked" : ''; ?>>
                                                    <label for="delete_unit"
                                                        class="padding05"><?= lang('delete') ?></label>
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
							
							
							
							
							
							<!--------------------------------- start Block -----------------------------------            -->

                            <div class="table-responsive" style="margin:12px;">
                                <table class="table table-bordered table-hover table-striped" style="margin:0 auto;">
                                    <thead>
                                        <tr>
                                            <th colspan="6" class="text-center">
                                                <?php echo $this->lang->line("peoples"). ' ( ' . $this->lang->line("peoples"). ' ) ' . $this->lang->line("group_permissions"); ?>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?= lang("Owners"); ?></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-peoples" name="peoples_index"
                                                        <?php echo $p->{'peoples_index'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-project"
                                                        class="padding05"><?= lang('list') ?></label>
                                                </span></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-add_peoples" name="add_peoples"
                                                        <?php echo $p->{'peoples_form'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-add_peoples"
                                                        class="padding05"><?= lang('add') ?></label>
                                                </span></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-edit_peoples" name="edit_peoples"
                                                        <?php echo $p->{'peoples_form_edit'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-edit_peoples"
                                                        class="padding05"><?= lang('edit') ?></label>
                                                </span></td>

                                            <td> <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-view_peoples" name="view_peoples"
                                                        <?php echo $p->{'peoples_view'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-view_peoples"
                                                        class="padding05"><?= lang('view') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-delete_peoples" name="delete_peoples"
                                                        <?php echo $p->{'peoples_delete'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-delete_peoples"
                                                        class="padding05"><?= lang('delete') ?></label>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><?= lang("resident"); ?></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-resident" name="resident_index"
                                                        <?php echo $p->{'resident_index'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-resident"
                                                        class="padding05"><?= lang('list') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-add_resident" name="add_resident"
                                                        <?php echo $p->{'resident_form'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-add_resident"
                                                        class="padding05"><?= lang('add') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-edit_resident" name="edit_resident"
                                                        <?php echo $p->{'resident_form_edit'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-edit_resident"
                                                        class="padding05"><?= lang('edit') ?></label>
                                                </span>
                                            </td>
                                            <td><span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-view_resident" name="view_resident"
                                                        <?php echo $p->{'resident_view'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-view_resident"
                                                        class="padding05"><?= lang('view') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-delete_resident" name="delete_resident"
                                                        <?php echo $p->{'resident_delete'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-delete_resident"
                                                        class="padding05"><?= lang('delete') ?></label>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><?= lang("resident"); ?></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-resident" name="resident_index"
                                                        <?php echo $p->{'resident_index'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-floor"
                                                        class="padding05"><?= lang('list') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-add_resident" name="add_resident"
                                                        <?php echo $p->{'resident_form'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-add_resident"
                                                        class="padding05"><?= lang('add') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-edit_resident" name="edit_resident"
                                                        <?php echo $p->{'resident_form_edit'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-edit_resident"
                                                        class="padding05"><?= lang('edit') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-resident_floor" name="resident_floor"
                                                        <?php echo $p->{'resident_view'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-resident_floor"
                                                        class="padding05"><?= lang('view') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-resident_floor" name="resident_floor"
                                                        <?php echo $p->{'resident_deleted'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-resident_floor"
                                                        class="padding05"><?= lang('delete') ?></label>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><?= lang("External_staff"); ?></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-es" name="es_index"
                                                        <?php echo $p->{'es_index'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-es"
                                                        class="padding05"><?= lang('list') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-add_es" name="add_es"
                                                        <?php echo $p->{'es_form'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-add_es"
                                                        class="padding05"><?= lang('add') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-edit_es" name="edit_es"
                                                        <?php echo $p->{'es_form_edit'} ? "checked" : ''; ?>>
                                                    <label for="edit_es" class="padding05"><?= lang('edit') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-view_es" name="view_es"
                                                        <?php echo $p->{'es_view'} ? "checked" : ''; ?>>
                                                    <label for="view_es" class="padding05"><?= lang('view') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-delete_es" name="delete_es"
                                                        <?php echo $p->{'es_delete'} ? "checked" : ''; ?>>
                                                    <label for="delete_es"
                                                        class="padding05"><?= lang('delete') ?></label>
                                                </span>
                                            </td>
                                        </tr>
										 <tr>
                                            <td><?= lang("people_settings"); ?></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-ps" name="ps_index"
                                                        <?php echo $p->{'ps_index'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-ps"
                                                        class="padding05"><?= lang('list') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-add_ps" name="add_ps"
                                                        <?php echo $p->{'ps_form'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-add_ps"
                                                        class="padding05"><?= lang('add') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-edit_ps" name="edit_ps"
                                                        <?php echo $p->{'ps_form_edit'} ? "checked" : ''; ?>>
                                                    <label for="edit_ps" class="padding05"><?= lang('edit') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-view_ps" name="view_ps"
                                                        <?php echo $p->{'ps_view'} ? "checked" : ''; ?>>
                                                    <label for="view_ps" class="padding05"><?= lang('view') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-delete_ps" name="delete_ps"
                                                        <?php echo $p->{'ps_delete'} ? "checked" : ''; ?>>
                                                    <label for="delete_ps"
                                                        class="padding05"><?= lang('delete') ?></label>
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
<!--------------------------------------------------------               end -------------------------------->






							
							
							
							<!--------------------------------- start Block -----------------------------------            -->

                            <div class="table-responsive" style="margin:12px;">
                                <table class="table table-bordered table-hover table-striped" style="margin:0 auto;">
                                    <thead>
                                        <tr>
                                            <th colspan="6" class="text-center">
                                            <?php echo $this->lang->line("lease_managment") . ' ( ' . $this->lang->line("lease_managment"). ' ) ' . $this->lang->line("group_permissions"); ?>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?= lang("request"); ?></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-ls" name="ls_index"
                                                        <?php echo $p->{'ls_index'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-ls"
                                                        class="padding05"><?= lang('list') ?></label>
                                                </span></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-add_ls" name="add_ls"
                                                        <?php echo $p->{'project_form'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-add_ls"
                                                        class="padding05"><?= lang('add') ?></label>
                                                </span></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-edit_ls" name="edit_ls"
                                                        <?php echo $p->{'project_form_edit'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-edit_ls"
                                                        class="padding05"><?= lang('edit') ?></label>
                                                </span></td>

                                            <td> <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-view_ls" name="view_ls"
                                                        <?php echo $p->{'ls_view'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-view_project"
                                                        class="padding05"><?= lang('view') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-delete_project" name="delete_project"
                                                        <?php echo $p->{'project_delete'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-delete_project"
                                                        class="padding05"><?= lang('delete') ?></label>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><?= lang("tenant"); ?></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-building" name="building_index"
                                                        <?php echo $p->{'building_index'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-building"
                                                        class="padding05"><?= lang('list') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-add_building" name="add_building"
                                                        <?php echo $p->{'building_form'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-add_project"
                                                        class="padding05"><?= lang('add') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-edit_building" name="edit_building"
                                                        <?php echo $p->{'building_form_edit'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-edit_buidling"
                                                        class="padding05"><?= lang('edit') ?></label>
                                                </span>
                                            </td>
                                            <td><span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-view_building" name="view_building"
                                                        <?php echo $p->{'building_view'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-view_building"
                                                        class="padding05"><?= lang('view') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-delete_building" name="delete_building"
                                                        <?php echo $p->{'building_delete'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-delete_building"
                                                        class="padding05"><?= lang('delete') ?></label>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><?= lang("Lease_agreement"); ?></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-floor" name="floor_index"
                                                        <?php echo $p->{'floors_index'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-floor"
                                                        class="padding05"><?= lang('list') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-add_floor" name="add_floor"
                                                        <?php echo $p->{'floors_form'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-add_floor"
                                                        class="padding05"><?= lang('add') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-edit_floor" name="edit_floor"
                                                        <?php echo $p->{'floors_form_edit'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-edit_floor"
                                                        class="padding05"><?= lang('edit') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-view_floor" name="view_floor"
                                                        <?php echo $p->{'floors_view'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-view_floor"
                                                        class="padding05"><?= lang('view') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-delete_floor" name="delete_floor"
                                                        <?php echo $p->{'floors_deleted'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-delete_floor"
                                                        class="padding05"><?= lang('delete') ?></label>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><?= lang("maintenance_agreement"); ?></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-units" name="units_index"
                                                        <?php echo $p->{'unit_index'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-units"
                                                        class="padding05"><?= lang('list') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-add_unit" name="add_unit"
                                                        <?php echo $p->{'unit_form'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-add_unit"
                                                        class="padding05"><?= lang('add') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-edit_unit" name="edit_unit"
                                                        <?php echo $p->{'unit_form_edit'} ? "checked" : ''; ?>>
                                                    <label for="edit_unit" class="padding05"><?= lang('edit') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-view_unit" name="view_unit"
                                                        <?php echo $p->{'unit_view'} ? "checked" : ''; ?>>
                                                    <label for="view_unit" class="padding05"><?= lang('view') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-delete_unit" name="delete_unit"
                                                        <?php echo $p->{'unit_delete'} ? "checked" : ''; ?>>
                                                    <label for="delete_unit"
                                                        class="padding05"><?= lang('delete') ?></label>
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
<!--------------------------------------------------------               end -------------------------------->









							
							
							
							<!--------------------------------- start Block -----------------------------------            -->

                            <div class="table-responsive" style="margin:12px;">
                                <table class="table table-bordered table-hover table-striped" style="margin:0 auto;">
                                    <thead>
                                        <tr>
                                            <th colspan="6" class="text-center">
                                                <?php echo $this->lang->line("facility") . ' ( ' . $this->lang->line("facility"). ' ) ' . $this->lang->line("group_permissions"); ?>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?= lang("facility"); ?></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-project" name="project_index"
                                                        <?php echo $p->{'project_index'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-project"
                                                        class="padding05"><?= lang('list') ?></label>
                                                </span></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-add_project" name="add_project"
                                                        <?php echo $p->{'project_form'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-add_project"
                                                        class="padding05"><?= lang('add') ?></label>
                                                </span></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-edit_project" name="edit_project"
                                                        <?php echo $p->{'project_form_edit'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-edit_project"
                                                        class="padding05"><?= lang('edit') ?></label>
                                                </span></td>

                                            <td> <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-view_project" name="view_project"
                                                        <?php echo $p->{'project_view'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-view_project"
                                                        class="padding05"><?= lang('view') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-delete_project" name="delete_project"
                                                        <?php echo $p->{'project_delete'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-delete_project"
                                                        class="padding05"><?= lang('delete') ?></label>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><?= lang("utility_services"); ?></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-building" name="building_index"
                                                        <?php echo $p->{'building_index'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-building"
                                                        class="padding05"><?= lang('list') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-add_building" name="add_building"
                                                        <?php echo $p->{'building_form'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-add_project"
                                                        class="padding05"><?= lang('add') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-edit_building" name="edit_building"
                                                        <?php echo $p->{'building_form_edit'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-edit_buidling"
                                                        class="padding05"><?= lang('edit') ?></label>
                                                </span>
                                            </td>
                                            <td><span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-view_building" name="view_building"
                                                        <?php echo $p->{'building_view'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-view_building"
                                                        class="padding05"><?= lang('view') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-delete_building" name="delete_building"
                                                        <?php echo $p->{'building_delete'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-delete_building"
                                                        class="padding05"><?= lang('delete') ?></label>
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
<!--------------------------------------------------------               end -------------------------------->




							
							
							
							<!--------------------------------- start Block -----------------------------------            -->

                            <div class="table-responsive" style="margin:12px;">
                                <table class="table table-bordered table-hover table-striped" style="margin:0 auto;">
                                    <thead>
                                        <tr>
                                            <th colspan="6" class="text-center">
                                                  <?php echo $this->lang->line("Assets_inventory"). ' ( ' . $this->lang->line("Assets_inventory"). ' ) ' . $this->lang->line("group_permissions"); ?>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?= lang("products"); ?></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-project" name="project_index"
                                                        <?php echo $p->{'project_index'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-project"
                                                        class="padding05"><?= lang('list') ?></label>
                                                </span></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-add_project" name="add_project"
                                                        <?php echo $p->{'project_form'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-add_project"
                                                        class="padding05"><?= lang('add') ?></label>
                                                </span></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-edit_project" name="edit_project"
                                                        <?php echo $p->{'project_form_edit'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-edit_project"
                                                        class="padding05"><?= lang('edit') ?></label>
                                                </span></td>

                                            <td> <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-view_project" name="view_project"
                                                        <?php echo $p->{'project_view'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-view_project"
                                                        class="padding05"><?= lang('view') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-delete_project" name="delete_project"
                                                        <?php echo $p->{'project_delete'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-delete_project"
                                                        class="padding05"><?= lang('delete') ?></label>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><?= lang("purchase_invoices"); ?></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-building" name="building_index"
                                                        <?php echo $p->{'building_index'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-building"
                                                        class="padding05"><?= lang('list') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-add_building" name="add_building"
                                                        <?php echo $p->{'building_form'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-add_project"
                                                        class="padding05"><?= lang('add') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-edit_building" name="edit_building"
                                                        <?php echo $p->{'building_form_edit'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-edit_buidling"
                                                        class="padding05"><?= lang('edit') ?></label>
                                                </span>
                                            </td>
                                            <td><span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-view_building" name="view_building"
                                                        <?php echo $p->{'building_view'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-view_building"
                                                        class="padding05"><?= lang('view') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-delete_building" name="delete_building"
                                                        <?php echo $p->{'building_delete'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-delete_building"
                                                        class="padding05"><?= lang('delete') ?></label>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><?= lang("stock"); ?></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-floor" name="floor_index"
                                                        <?php echo $p->{'floors_index'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-floor"
                                                        class="padding05"><?= lang('list') ?></label>
                                                </span>
                                            </td>
                                            
                                        </tr>
                                        <tr>
                                            <td><?= lang("assets"); ?></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-units" name="units_index"
                                                        <?php echo $p->{'unit_index'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-units"
                                                        class="padding05"><?= lang('list') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-add_unit" name="add_unit"
                                                        <?php echo $p->{'unit_form'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-add_unit"
                                                        class="padding05"><?= lang('add') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-edit_unit" name="edit_unit"
                                                        <?php echo $p->{'unit_form_edit'} ? "checked" : ''; ?>>
                                                    <label for="edit_unit" class="padding05"><?= lang('edit') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-view_unit" name="view_unit"
                                                        <?php echo $p->{'unit_view'} ? "checked" : ''; ?>>
                                                    <label for="view_unit" class="padding05"><?= lang('view') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-delete_unit" name="delete_unit"
                                                        <?php echo $p->{'unit_delete'} ? "checked" : ''; ?>>
                                                    <label for="delete_unit"
                                                        class="padding05"><?= lang('delete') ?></label>
                                                </span>
                                            </td>
                                        </tr>
										
										 <tr>
                                            <td><?= lang("tax"); ?></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-units" name="units_index"
                                                        <?php echo $p->{'unit_index'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-units"
                                                        class="padding05"><?= lang('list') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-add_unit" name="add_unit"
                                                        <?php echo $p->{'unit_form'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-add_unit"
                                                        class="padding05"><?= lang('add') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-edit_unit" name="edit_unit"
                                                        <?php echo $p->{'unit_form_edit'} ? "checked" : ''; ?>>
                                                    <label for="edit_unit" class="padding05"><?= lang('edit') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-view_unit" name="view_unit"
                                                        <?php echo $p->{'unit_view'} ? "checked" : ''; ?>>
                                                    <label for="view_unit" class="padding05"><?= lang('view') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-delete_unit" name="delete_unit"
                                                        <?php echo $p->{'unit_delete'} ? "checked" : ''; ?>>
                                                    <label for="delete_unit"
                                                        class="padding05"><?= lang('delete') ?></label>
                                                </span>
                                            </td>
                                        </tr>
										 <tr>
                                            <td><?= lang("categories_"); ?></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-units" name="units_index"
                                                        <?php echo $p->{'unit_index'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-units"
                                                        class="padding05"><?= lang('list') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-add_unit" name="add_unit"
                                                        <?php echo $p->{'unit_form'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-add_unit"
                                                        class="padding05"><?= lang('add') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-edit_unit" name="edit_unit"
                                                        <?php echo $p->{'unit_form_edit'} ? "checked" : ''; ?>>
                                                    <label for="edit_unit" class="padding05"><?= lang('edit') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-view_unit" name="view_unit"
                                                        <?php echo $p->{'unit_view'} ? "checked" : ''; ?>>
                                                    <label for="view_unit" class="padding05"><?= lang('view') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-delete_unit" name="delete_unit"
                                                        <?php echo $p->{'unit_delete'} ? "checked" : ''; ?>>
                                                    <label for="delete_unit"
                                                        class="padding05"><?= lang('delete') ?></label>
                                                </span>
                                            </td>
                                        </tr>
										 <tr>
                                            <td><?= lang("departments"); ?></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-units" name="units_index"
                                                        <?php echo $p->{'unit_index'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-units"
                                                        class="padding05"><?= lang('list') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-add_unit" name="add_unit"
                                                        <?php echo $p->{'unit_form'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-add_unit"
                                                        class="padding05"><?= lang('add') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-edit_unit" name="edit_unit"
                                                        <?php echo $p->{'unit_form_edit'} ? "checked" : ''; ?>>
                                                    <label for="edit_unit" class="padding05"><?= lang('edit') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-view_unit" name="view_unit"
                                                        <?php echo $p->{'unit_view'} ? "checked" : ''; ?>>
                                                    <label for="view_unit" class="padding05"><?= lang('view') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-delete_unit" name="delete_unit"
                                                        <?php echo $p->{'unit_delete'} ? "checked" : ''; ?>>
                                                    <label for="delete_unit"
                                                        class="padding05"><?= lang('delete') ?></label>
                                                </span>
                                            </td>
                                        </tr>
										 <tr>
                                            <td><?= lang("units"); ?></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-units" name="units_index"
                                                        <?php echo $p->{'unit_index'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-units"
                                                        class="padding05"><?= lang('list') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-add_unit" name="add_unit"
                                                        <?php echo $p->{'unit_form'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-add_unit"
                                                        class="padding05"><?= lang('add') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-edit_unit" name="edit_unit"
                                                        <?php echo $p->{'unit_form_edit'} ? "checked" : ''; ?>>
                                                    <label for="edit_unit" class="padding05"><?= lang('edit') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-view_unit" name="view_unit"
                                                        <?php echo $p->{'unit_view'} ? "checked" : ''; ?>>
                                                    <label for="view_unit" class="padding05"><?= lang('view') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-delete_unit" name="delete_unit"
                                                        <?php echo $p->{'unit_delete'} ? "checked" : ''; ?>>
                                                    <label for="delete_unit"
                                                        class="padding05"><?= lang('delete') ?></label>
                                                </span>
                                            </td>
                                        </tr>
										 <tr>
                                            <td><?= lang("brands"); ?></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-units" name="units_index"
                                                        <?php echo $p->{'unit_index'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-units"
                                                        class="padding05"><?= lang('list') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-add_unit" name="add_unit"
                                                        <?php echo $p->{'unit_form'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-add_unit"
                                                        class="padding05"><?= lang('add') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-edit_unit" name="edit_unit"
                                                        <?php echo $p->{'unit_form_edit'} ? "checked" : ''; ?>>
                                                    <label for="edit_unit" class="padding05"><?= lang('edit') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-view_unit" name="view_unit"
                                                        <?php echo $p->{'unit_view'} ? "checked" : ''; ?>>
                                                    <label for="view_unit" class="padding05"><?= lang('view') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-delete_unit" name="delete_unit"
                                                        <?php echo $p->{'unit_delete'} ? "checked" : ''; ?>>
                                                    <label for="delete_unit"
                                                        class="padding05"><?= lang('delete') ?></label>
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
<!--------------------------------------------------------               end -------------------------------->




							
							
							
							<!--------------------------------- start Block -----------------------------------            -->
<!--
                            <div class="table-responsive" style="margin:12px;">
                                <table class="table table-bordered table-hover table-striped" style="margin:0 auto;">
                                    <thead>
                                        <tr>
                                            <th colspan="6" class="text-center">
                                                  <?php echo $this->lang->line("Accounts") . ' ( ' . $this->lang->line("Accounts"). ' ) ' . $this->lang->line("group_permissions"); ?>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?= lang("projects"); ?></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-project" name="project_index"
                                                        <?php echo $p->{'project_index'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-project"
                                                        class="padding05"><?= lang('list') ?></label>
                                                </span></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-add_project" name="add_project"
                                                        <?php echo $p->{'project_form'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-add_project"
                                                        class="padding05"><?= lang('add') ?></label>
                                                </span></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-edit_project" name="edit_project"
                                                        <?php echo $p->{'project_form_edit'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-edit_project"
                                                        class="padding05"><?= lang('edit') ?></label>
                                                </span></td>

                                            <td> <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-view_project" name="view_project"
                                                        <?php echo $p->{'project_view'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-view_project"
                                                        class="padding05"><?= lang('view') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-delete_project" name="delete_project"
                                                        <?php echo $p->{'project_delete'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-delete_project"
                                                        class="padding05"><?= lang('delete') ?></label>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><?= lang("buildings"); ?></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-building" name="building_index"
                                                        <?php echo $p->{'building_index'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-building"
                                                        class="padding05"><?= lang('list') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-add_building" name="add_building"
                                                        <?php echo $p->{'building_form'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-add_project"
                                                        class="padding05"><?= lang('add') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-edit_building" name="edit_building"
                                                        <?php echo $p->{'building_form_edit'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-edit_buidling"
                                                        class="padding05"><?= lang('edit') ?></label>
                                                </span>
                                            </td>
                                            <td><span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-view_building" name="view_building"
                                                        <?php echo $p->{'building_view'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-view_building"
                                                        class="padding05"><?= lang('view') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-delete_building" name="delete_building"
                                                        <?php echo $p->{'building_delete'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-delete_building"
                                                        class="padding05"><?= lang('delete') ?></label>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><?= lang("floors"); ?></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-floor" name="floor_index"
                                                        <?php echo $p->{'floors_index'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-floor"
                                                        class="padding05"><?= lang('list') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-add_floor" name="add_floor"
                                                        <?php echo $p->{'floors_form'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-add_floor"
                                                        class="padding05"><?= lang('add') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-edit_floor" name="edit_floor"
                                                        <?php echo $p->{'floors_form_edit'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-edit_floor"
                                                        class="padding05"><?= lang('edit') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-view_floor" name="view_floor"
                                                        <?php echo $p->{'floors_view'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-view_floor"
                                                        class="padding05"><?= lang('view') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-delete_floor" name="delete_floor"
                                                        <?php echo $p->{'floors_deleted'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-delete_floor"
                                                        class="padding05"><?= lang('delete') ?></label>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><?= lang("units"); ?></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-units" name="units_index"
                                                        <?php echo $p->{'unit_index'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-units"
                                                        class="padding05"><?= lang('list') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-add_unit" name="add_unit"
                                                        <?php echo $p->{'unit_form'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-add_unit"
                                                        class="padding05"><?= lang('add') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-edit_unit" name="edit_unit"
                                                        <?php echo $p->{'unit_form_edit'} ? "checked" : ''; ?>>
                                                    <label for="edit_unit" class="padding05"><?= lang('edit') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-view_unit" name="view_unit"
                                                        <?php echo $p->{'unit_view'} ? "checked" : ''; ?>>
                                                    <label for="view_unit" class="padding05"><?= lang('view') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-delete_unit" name="delete_unit"
                                                        <?php echo $p->{'unit_delete'} ? "checked" : ''; ?>>
                                                    <label for="delete_unit"
                                                        class="padding05"><?= lang('delete') ?></label>
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
<!--------------------------------------------------------               end -------------------------------->




							
							
							
							<!--------------------------------- start Block -----------------------------------            -->
<!--
                            <div class="table-responsive" style="margin:12px;">
                                <table class="table table-bordered table-hover table-striped" style="margin:0 auto;">
                                    <thead>
                                        <tr>
                                            <th colspan="6" class="text-center">
                                                   <?php echo $this->lang->line("hrms") . ' ( ' . $this->lang->line("hrms"). ' ) ' . $this->lang->line("group_permissions"); ?>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?= lang("projects"); ?></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-project" name="project_index"
                                                        <?php echo $p->{'project_index'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-project"
                                                        class="padding05"><?= lang('list') ?></label>
                                                </span></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-add_project" name="add_project"
                                                        <?php echo $p->{'project_form'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-add_project"
                                                        class="padding05"><?= lang('add') ?></label>
                                                </span></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-edit_project" name="edit_project"
                                                        <?php echo $p->{'project_form_edit'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-edit_project"
                                                        class="padding05"><?= lang('edit') ?></label>
                                                </span></td>

                                            <td> <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-view_project" name="view_project"
                                                        <?php echo $p->{'project_view'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-view_project"
                                                        class="padding05"><?= lang('view') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-delete_project" name="delete_project"
                                                        <?php echo $p->{'project_delete'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-delete_project"
                                                        class="padding05"><?= lang('delete') ?></label>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><?= lang("buildings"); ?></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-building" name="building_index"
                                                        <?php echo $p->{'building_index'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-building"
                                                        class="padding05"><?= lang('list') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-add_building" name="add_building"
                                                        <?php echo $p->{'building_form'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-add_project"
                                                        class="padding05"><?= lang('add') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-edit_building" name="edit_building"
                                                        <?php echo $p->{'building_form_edit'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-edit_buidling"
                                                        class="padding05"><?= lang('edit') ?></label>
                                                </span>
                                            </td>
                                            <td><span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-view_building" name="view_building"
                                                        <?php echo $p->{'building_view'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-view_building"
                                                        class="padding05"><?= lang('view') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-delete_building" name="delete_building"
                                                        <?php echo $p->{'building_delete'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-delete_building"
                                                        class="padding05"><?= lang('delete') ?></label>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><?= lang("floors"); ?></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-floor" name="floor_index"
                                                        <?php echo $p->{'floors_index'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-floor"
                                                        class="padding05"><?= lang('list') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-add_floor" name="add_floor"
                                                        <?php echo $p->{'floors_form'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-add_floor"
                                                        class="padding05"><?= lang('add') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-edit_floor" name="edit_floor"
                                                        <?php echo $p->{'floors_form_edit'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-edit_floor"
                                                        class="padding05"><?= lang('edit') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-view_floor" name="view_floor"
                                                        <?php echo $p->{'floors_view'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-view_floor"
                                                        class="padding05"><?= lang('view') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-delete_floor" name="delete_floor"
                                                        <?php echo $p->{'floors_deleted'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-delete_floor"
                                                        class="padding05"><?= lang('delete') ?></label>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><?= lang("units"); ?></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-units" name="units_index"
                                                        <?php echo $p->{'unit_index'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-units"
                                                        class="padding05"><?= lang('list') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-add_unit" name="add_unit"
                                                        <?php echo $p->{'unit_form'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-add_unit"
                                                        class="padding05"><?= lang('add') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-edit_unit" name="edit_unit"
                                                        <?php echo $p->{'unit_form_edit'} ? "checked" : ''; ?>>
                                                    <label for="edit_unit" class="padding05"><?= lang('edit') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-view_unit" name="view_unit"
                                                        <?php echo $p->{'unit_view'} ? "checked" : ''; ?>>
                                                    <label for="view_unit" class="padding05"><?= lang('view') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-delete_unit" name="delete_unit"
                                                        <?php echo $p->{'unit_delete'} ? "checked" : ''; ?>>
                                                    <label for="delete_unit"
                                                        class="padding05"><?= lang('delete') ?></label>
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
<!--------------------------------------------------------               end -------------------------------->




							<!--------------------------------- start Block -----------------------------------            -->
<!--
                            <div class="table-responsive" style="margin:12px;">
                                <table class="table table-bordered table-hover table-striped" style="margin:0 auto;">
                                    <thead>
                                        <tr>
                                            <th colspan="6" class="text-center">
                                                   <?php echo $this->lang->line("crm") . ' ( ' . $this->lang->line("crm"). ' ) ' . $this->lang->line("group_permissions"); ?>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?= lang("projects"); ?></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-project" name="project_index"
                                                        <?php echo $p->{'project_index'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-project"
                                                        class="padding05"><?= lang('list') ?></label>
                                                </span></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-add_project" name="add_project"
                                                        <?php echo $p->{'project_form'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-add_project"
                                                        class="padding05"><?= lang('add') ?></label>
                                                </span></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-edit_project" name="edit_project"
                                                        <?php echo $p->{'project_form_edit'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-edit_project"
                                                        class="padding05"><?= lang('edit') ?></label>
                                                </span></td>

                                            <td> <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-view_project" name="view_project"
                                                        <?php echo $p->{'project_view'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-view_project"
                                                        class="padding05"><?= lang('view') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-delete_project" name="delete_project"
                                                        <?php echo $p->{'project_delete'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-delete_project"
                                                        class="padding05"><?= lang('delete') ?></label>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><?= lang("buildings"); ?></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-building" name="building_index"
                                                        <?php echo $p->{'building_index'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-building"
                                                        class="padding05"><?= lang('list') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-add_building" name="add_building"
                                                        <?php echo $p->{'building_form'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-add_project"
                                                        class="padding05"><?= lang('add') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-edit_building" name="edit_building"
                                                        <?php echo $p->{'building_form_edit'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-edit_buidling"
                                                        class="padding05"><?= lang('edit') ?></label>
                                                </span>
                                            </td>
                                            <td><span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-view_building" name="view_building"
                                                        <?php echo $p->{'building_view'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-view_building"
                                                        class="padding05"><?= lang('view') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-delete_building" name="delete_building"
                                                        <?php echo $p->{'building_delete'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-delete_building"
                                                        class="padding05"><?= lang('delete') ?></label>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><?= lang("floors"); ?></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-floor" name="floor_index"
                                                        <?php echo $p->{'floors_index'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-floor"
                                                        class="padding05"><?= lang('list') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-add_floor" name="add_floor"
                                                        <?php echo $p->{'floors_form'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-add_floor"
                                                        class="padding05"><?= lang('add') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-edit_floor" name="edit_floor"
                                                        <?php echo $p->{'floors_form_edit'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-edit_floor"
                                                        class="padding05"><?= lang('edit') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-view_floor" name="view_floor"
                                                        <?php echo $p->{'floors_view'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-view_floor"
                                                        class="padding05"><?= lang('view') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-delete_floor" name="delete_floor"
                                                        <?php echo $p->{'floors_deleted'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-delete_floor"
                                                        class="padding05"><?= lang('delete') ?></label>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><?= lang("units"); ?></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-units" name="units_index"
                                                        <?php echo $p->{'unit_index'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-units"
                                                        class="padding05"><?= lang('list') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-add_unit" name="add_unit"
                                                        <?php echo $p->{'unit_form'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-add_unit"
                                                        class="padding05"><?= lang('add') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-edit_unit" name="edit_unit"
                                                        <?php echo $p->{'unit_form_edit'} ? "checked" : ''; ?>>
                                                    <label for="edit_unit" class="padding05"><?= lang('edit') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-view_unit" name="view_unit"
                                                        <?php echo $p->{'unit_view'} ? "checked" : ''; ?>>
                                                    <label for="view_unit" class="padding05"><?= lang('view') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-delete_unit" name="delete_unit"
                                                        <?php echo $p->{'unit_delete'} ? "checked" : ''; ?>>
                                                    <label for="delete_unit"
                                                        class="padding05"><?= lang('delete') ?></label>
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
<!--------------------------------------------------------               end -------------------------------->


							<!--------------------------------- start Block -----------------------------------            -->
<!--
                            <div class="table-responsive" style="margin:12px;">
                                <table class="table table-bordered table-hover table-striped" style="margin:0 auto;">
                                    <thead>
                                        <tr>
                                            <th colspan="6" class="text-center">
                                                   <?php echo $this->lang->line("sales") . ' ( ' . $this->lang->line("sales"). ' ) ' . $this->lang->line("group_permissions"); ?>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?= lang("projects"); ?></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-project" name="project_index"
                                                        <?php echo $p->{'project_index'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-project"
                                                        class="padding05"><?= lang('list') ?></label>
                                                </span></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-add_project" name="add_project"
                                                        <?php echo $p->{'project_form'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-add_project"
                                                        class="padding05"><?= lang('add') ?></label>
                                                </span></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-edit_project" name="edit_project"
                                                        <?php echo $p->{'project_form_edit'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-edit_project"
                                                        class="padding05"><?= lang('edit') ?></label>
                                                </span></td>

                                            <td> <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-view_project" name="view_project"
                                                        <?php echo $p->{'project_view'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-view_project"
                                                        class="padding05"><?= lang('view') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-delete_project" name="delete_project"
                                                        <?php echo $p->{'project_delete'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-delete_project"
                                                        class="padding05"><?= lang('delete') ?></label>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><?= lang("buildings"); ?></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-building" name="building_index"
                                                        <?php echo $p->{'building_index'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-building"
                                                        class="padding05"><?= lang('list') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-add_building" name="add_building"
                                                        <?php echo $p->{'building_form'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-add_project"
                                                        class="padding05"><?= lang('add') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-edit_building" name="edit_building"
                                                        <?php echo $p->{'building_form_edit'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-edit_buidling"
                                                        class="padding05"><?= lang('edit') ?></label>
                                                </span>
                                            </td>
                                            <td><span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-view_building" name="view_building"
                                                        <?php echo $p->{'building_view'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-view_building"
                                                        class="padding05"><?= lang('view') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-delete_building" name="delete_building"
                                                        <?php echo $p->{'building_delete'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-delete_building"
                                                        class="padding05"><?= lang('delete') ?></label>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><?= lang("floors"); ?></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-floor" name="floor_index"
                                                        <?php echo $p->{'floors_index'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-floor"
                                                        class="padding05"><?= lang('list') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-add_floor" name="add_floor"
                                                        <?php echo $p->{'floors_form'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-add_floor"
                                                        class="padding05"><?= lang('add') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-edit_floor" name="edit_floor"
                                                        <?php echo $p->{'floors_form_edit'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-edit_floor"
                                                        class="padding05"><?= lang('edit') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-view_floor" name="view_floor"
                                                        <?php echo $p->{'floors_view'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-view_floor"
                                                        class="padding05"><?= lang('view') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-delete_floor" name="delete_floor"
                                                        <?php echo $p->{'floors_deleted'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-delete_floor"
                                                        class="padding05"><?= lang('delete') ?></label>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><?= lang("units"); ?></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-units" name="units_index"
                                                        <?php echo $p->{'unit_index'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-units"
                                                        class="padding05"><?= lang('list') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-add_unit" name="add_unit"
                                                        <?php echo $p->{'unit_form'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-add_unit"
                                                        class="padding05"><?= lang('add') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-edit_unit" name="edit_unit"
                                                        <?php echo $p->{'unit_form_edit'} ? "checked" : ''; ?>>
                                                    <label for="edit_unit" class="padding05"><?= lang('edit') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-view_unit" name="view_unit"
                                                        <?php echo $p->{'unit_view'} ? "checked" : ''; ?>>
                                                    <label for="view_unit" class="padding05"><?= lang('view') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-delete_unit" name="delete_unit"
                                                        <?php echo $p->{'unit_delete'} ? "checked" : ''; ?>>
                                                    <label for="delete_unit"
                                                        class="padding05"><?= lang('delete') ?></label>
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
<!--------------------------------------------------------               end -------------------------------->



							<!--------------------------------- start Block -----------------------------------            -->
<!--
                            <div class="table-responsive" style="margin:12px;">
                                <table class="table table-bordered table-hover table-striped" style="margin:0 auto;">
                                    <thead>
                                        <tr>
                                            <th colspan="6" class="text-center">
                                                   <?php echo $this->lang->line("users") . ' ( ' . $this->lang->line("users"). ' ) ' . $this->lang->line("group_permissions"); ?>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?= lang("projects"); ?></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-project" name="project_index"
                                                        <?php echo $p->{'project_index'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-project"
                                                        class="padding05"><?= lang('list') ?></label>
                                                </span></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-add_project" name="add_project"
                                                        <?php echo $p->{'project_form'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-add_project"
                                                        class="padding05"><?= lang('add') ?></label>
                                                </span></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-edit_project" name="edit_project"
                                                        <?php echo $p->{'project_form_edit'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-edit_project"
                                                        class="padding05"><?= lang('edit') ?></label>
                                                </span></td>

                                            <td> <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-view_project" name="view_project"
                                                        <?php echo $p->{'project_view'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-view_project"
                                                        class="padding05"><?= lang('view') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-delete_project" name="delete_project"
                                                        <?php echo $p->{'project_delete'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-delete_project"
                                                        class="padding05"><?= lang('delete') ?></label>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><?= lang("buildings"); ?></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-building" name="building_index"
                                                        <?php echo $p->{'building_index'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-building"
                                                        class="padding05"><?= lang('list') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-add_building" name="add_building"
                                                        <?php echo $p->{'building_form'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-add_project"
                                                        class="padding05"><?= lang('add') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-edit_building" name="edit_building"
                                                        <?php echo $p->{'building_form_edit'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-edit_buidling"
                                                        class="padding05"><?= lang('edit') ?></label>
                                                </span>
                                            </td>
                                            <td><span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-view_building" name="view_building"
                                                        <?php echo $p->{'building_view'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-view_building"
                                                        class="padding05"><?= lang('view') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-delete_building" name="delete_building"
                                                        <?php echo $p->{'building_delete'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-delete_building"
                                                        class="padding05"><?= lang('delete') ?></label>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><?= lang("floors"); ?></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-floor" name="floor_index"
                                                        <?php echo $p->{'floors_index'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-floor"
                                                        class="padding05"><?= lang('list') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-add_floor" name="add_floor"
                                                        <?php echo $p->{'floors_form'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-add_floor"
                                                        class="padding05"><?= lang('add') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-edit_floor" name="edit_floor"
                                                        <?php echo $p->{'floors_form_edit'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-edit_floor"
                                                        class="padding05"><?= lang('edit') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-view_floor" name="view_floor"
                                                        <?php echo $p->{'floors_view'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-view_floor"
                                                        class="padding05"><?= lang('view') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-delete_floor" name="delete_floor"
                                                        <?php echo $p->{'floors_deleted'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-delete_floor"
                                                        class="padding05"><?= lang('delete') ?></label>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><?= lang("units"); ?></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-units" name="units_index"
                                                        <?php echo $p->{'unit_index'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-units"
                                                        class="padding05"><?= lang('list') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-add_unit" name="add_unit"
                                                        <?php echo $p->{'unit_form'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-add_unit"
                                                        class="padding05"><?= lang('add') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-edit_unit" name="edit_unit"
                                                        <?php echo $p->{'unit_form_edit'} ? "checked" : ''; ?>>
                                                    <label for="edit_unit" class="padding05"><?= lang('edit') ?></label>
                                                </span>
                                            </td>
											
							<!--------------------------------- start Block -----------------------------------            -->
<!--
                            <div class="table-responsive" style="margin:12px;">
                                <table class="table table-bordered table-hover table-striped" style="margin:0 auto;">
                                    <thead>
                                        <tr>
                                            <th colspan="6" class="text-center">
                                                   <?php echo $this->lang->line("parking_management") . ' ( ' . $this->lang->line("parking_management"). ' ) ' . $this->lang->line("group_permissions"); ?>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?= lang("projects"); ?></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-project" name="project_index"
                                                        <?php echo $p->{'project_index'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-project"
                                                        class="padding05"><?= lang('list') ?></label>
                                                </span></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-add_project" name="add_project"
                                                        <?php echo $p->{'project_form'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-add_project"
                                                        class="padding05"><?= lang('add') ?></label>
                                                </span></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-edit_project" name="edit_project"
                                                        <?php echo $p->{'project_form_edit'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-edit_project"
                                                        class="padding05"><?= lang('edit') ?></label>
                                                </span></td>

                                            <td> <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-view_project" name="view_project"
                                                        <?php echo $p->{'project_view'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-view_project"
                                                        class="padding05"><?= lang('view') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-delete_project" name="delete_project"
                                                        <?php echo $p->{'project_delete'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-delete_project"
                                                        class="padding05"><?= lang('delete') ?></label>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><?= lang("buildings"); ?></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-building" name="building_index"
                                                        <?php echo $p->{'building_index'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-building"
                                                        class="padding05"><?= lang('list') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-add_building" name="add_building"
                                                        <?php echo $p->{'building_form'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-add_project"
                                                        class="padding05"><?= lang('add') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-edit_building" name="edit_building"
                                                        <?php echo $p->{'building_form_edit'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-edit_buidling"
                                                        class="padding05"><?= lang('edit') ?></label>
                                                </span>
                                            </td>
                                            <td><span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-view_building" name="view_building"
                                                        <?php echo $p->{'building_view'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-view_building"
                                                        class="padding05"><?= lang('view') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-delete_building" name="delete_building"
                                                        <?php echo $p->{'building_delete'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-delete_building"
                                                        class="padding05"><?= lang('delete') ?></label>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><?= lang("floors"); ?></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-floor" name="floor_index"
                                                        <?php echo $p->{'floors_index'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-floor"
                                                        class="padding05"><?= lang('list') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-add_floor" name="add_floor"
                                                        <?php echo $p->{'floors_form'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-add_floor"
                                                        class="padding05"><?= lang('add') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-edit_floor" name="edit_floor"
                                                        <?php echo $p->{'floors_form_edit'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-edit_floor"
                                                        class="padding05"><?= lang('edit') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-view_floor" name="view_floor"
                                                        <?php echo $p->{'floors_view'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-view_floor"
                                                        class="padding05"><?= lang('view') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-delete_floor" name="delete_floor"
                                                        <?php echo $p->{'floors_deleted'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-delete_floor"
                                                        class="padding05"><?= lang('delete') ?></label>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><?= lang("units"); ?></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-units" name="units_index"
                                                        <?php echo $p->{'unit_index'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-units"
                                                        class="padding05"><?= lang('list') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-add_unit" name="add_unit"
                                                        <?php echo $p->{'unit_form'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-add_unit"
                                                        class="padding05"><?= lang('add') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-edit_unit" name="edit_unit"
                                                        <?php echo $p->{'unit_form_edit'} ? "checked" : ''; ?>>
                                                    <label for="edit_unit" class="padding05"><?= lang('edit') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-view_unit" name="view_unit"
                                                        <?php echo $p->{'unit_view'} ? "checked" : ''; ?>>
                                                    <label for="view_unit" class="padding05"><?= lang('view') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-delete_unit" name="delete_unit"
                                                        <?php echo $p->{'unit_delete'} ? "checked" : ''; ?>>
                                                    <label for="delete_unit"
                                                        class="padding05"><?= lang('delete') ?></label>
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
<!--------------------------------------------------------               end -------------------------------->


							<!--------------------------------- start Block -----------------------------------            -->
<!--
                            <div class="table-responsive" style="margin:12px;">
                                <table class="table table-bordered table-hover table-striped" style="margin:0 auto;">
                                    <thead>
                                        <tr>
                                            <th colspan="6" class="text-center">
                                                   <?php echo $this->lang->line("management_committee") . ' ( ' . $this->lang->line("management_committee"). ' ) ' . $this->lang->line("group_permissions"); ?>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?= lang("projects"); ?></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-project" name="project_index"
                                                        <?php echo $p->{'project_index'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-project"
                                                        class="padding05"><?= lang('list') ?></label>
                                                </span></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-add_project" name="add_project"
                                                        <?php echo $p->{'project_form'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-add_project"
                                                        class="padding05"><?= lang('add') ?></label>
                                                </span></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-edit_project" name="edit_project"
                                                        <?php echo $p->{'project_form_edit'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-edit_project"
                                                        class="padding05"><?= lang('edit') ?></label>
                                                </span></td>

                                            <td> <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-view_project" name="view_project"
                                                        <?php echo $p->{'project_view'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-view_project"
                                                        class="padding05"><?= lang('view') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-delete_project" name="delete_project"
                                                        <?php echo $p->{'project_delete'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-delete_project"
                                                        class="padding05"><?= lang('delete') ?></label>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><?= lang("buildings"); ?></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-building" name="building_index"
                                                        <?php echo $p->{'building_index'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-building"
                                                        class="padding05"><?= lang('list') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-add_building" name="add_building"
                                                        <?php echo $p->{'building_form'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-add_project"
                                                        class="padding05"><?= lang('add') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-edit_building" name="edit_building"
                                                        <?php echo $p->{'building_form_edit'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-edit_buidling"
                                                        class="padding05"><?= lang('edit') ?></label>
                                                </span>
                                            </td>
                                            <td><span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-view_building" name="view_building"
                                                        <?php echo $p->{'building_view'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-view_building"
                                                        class="padding05"><?= lang('view') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-delete_building" name="delete_building"
                                                        <?php echo $p->{'building_delete'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-delete_building"
                                                        class="padding05"><?= lang('delete') ?></label>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><?= lang("floors"); ?></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-floor" name="floor_index"
                                                        <?php echo $p->{'floors_index'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-floor"
                                                        class="padding05"><?= lang('list') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-add_floor" name="add_floor"
                                                        <?php echo $p->{'floors_form'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-add_floor"
                                                        class="padding05"><?= lang('add') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-edit_floor" name="edit_floor"
                                                        <?php echo $p->{'floors_form_edit'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-edit_floor"
                                                        class="padding05"><?= lang('edit') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-view_floor" name="view_floor"
                                                        <?php echo $p->{'floors_view'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-view_floor"
                                                        class="padding05"><?= lang('view') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-delete_floor" name="delete_floor"
                                                        <?php echo $p->{'floors_deleted'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-delete_floor"
                                                        class="padding05"><?= lang('delete') ?></label>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><?= lang("units"); ?></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-units" name="units_index"
                                                        <?php echo $p->{'unit_index'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-units"
                                                        class="padding05"><?= lang('list') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-add_unit" name="add_unit"
                                                        <?php echo $p->{'unit_form'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-add_unit"
                                                        class="padding05"><?= lang('add') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-edit_unit" name="edit_unit"
                                                        <?php echo $p->{'unit_form_edit'} ? "checked" : ''; ?>>
                                                    <label for="edit_unit" class="padding05"><?= lang('edit') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-view_unit" name="view_unit"
                                                        <?php echo $p->{'unit_view'} ? "checked" : ''; ?>>
                                                    <label for="view_unit" class="padding05"><?= lang('view') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-delete_unit" name="delete_unit"
                                                        <?php echo $p->{'unit_delete'} ? "checked" : ''; ?>>
                                                    <label for="delete_unit"
                                                        class="padding05"><?= lang('delete') ?></label>
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
<!--------------------------------------------------------               end -------------------------------->




							<!--------------------------------- start Block -----------------------------------            -->
<!--
                            <div class="table-responsive" style="margin:12px;">
                                <table class="table table-bordered table-hover table-striped" style="margin:0 auto;">
                                    <thead>
                                        <tr>
                                            <th colspan="6" class="text-center">
                                                   <?php echo $this->lang->line("Administration") . ' ( ' . $this->lang->line("Administration"). ' ) ' . $this->lang->line("group_permissions"); ?>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?= lang("projects"); ?></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-project" name="project_index"
                                                        <?php echo $p->{'project_index'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-project"
                                                        class="padding05"><?= lang('list') ?></label>
                                                </span></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-add_project" name="add_project"
                                                        <?php echo $p->{'project_form'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-add_project"
                                                        class="padding05"><?= lang('add') ?></label>
                                                </span></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-edit_project" name="edit_project"
                                                        <?php echo $p->{'project_form_edit'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-edit_project"
                                                        class="padding05"><?= lang('edit') ?></label>
                                                </span></td>

                                            <td> <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-view_project" name="view_project"
                                                        <?php echo $p->{'project_view'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-view_project"
                                                        class="padding05"><?= lang('view') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-delete_project" name="delete_project"
                                                        <?php echo $p->{'project_delete'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-delete_project"
                                                        class="padding05"><?= lang('delete') ?></label>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><?= lang("buildings"); ?></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-building" name="building_index"
                                                        <?php echo $p->{'building_index'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-building"
                                                        class="padding05"><?= lang('list') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-add_building" name="add_building"
                                                        <?php echo $p->{'building_form'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-add_project"
                                                        class="padding05"><?= lang('add') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-edit_building" name="edit_building"
                                                        <?php echo $p->{'building_form_edit'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-edit_buidling"
                                                        class="padding05"><?= lang('edit') ?></label>
                                                </span>
                                            </td>
                                            <td><span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-view_building" name="view_building"
                                                        <?php echo $p->{'building_view'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-view_building"
                                                        class="padding05"><?= lang('view') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-delete_building" name="delete_building"
                                                        <?php echo $p->{'building_delete'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-delete_building"
                                                        class="padding05"><?= lang('delete') ?></label>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><?= lang("floors"); ?></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-floor" name="floor_index"
                                                        <?php echo $p->{'floors_index'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-floor"
                                                        class="padding05"><?= lang('list') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-add_floor" name="add_floor"
                                                        <?php echo $p->{'floors_form'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-add_floor"
                                                        class="padding05"><?= lang('add') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-edit_floor" name="edit_floor"
                                                        <?php echo $p->{'floors_form_edit'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-edit_floor"
                                                        class="padding05"><?= lang('edit') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-view_floor" name="view_floor"
                                                        <?php echo $p->{'floors_view'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-view_floor"
                                                        class="padding05"><?= lang('view') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-delete_floor" name="delete_floor"
                                                        <?php echo $p->{'floors_deleted'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-delete_floor"
                                                        class="padding05"><?= lang('delete') ?></label>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><?= lang("units"); ?></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-units" name="units_index"
                                                        <?php echo $p->{'unit_index'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-units"
                                                        class="padding05"><?= lang('list') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-add_unit" name="add_unit"
                                                        <?php echo $p->{'unit_form'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-add_unit"
                                                        class="padding05"><?= lang('add') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-edit_unit" name="edit_unit"
                                                        <?php echo $p->{'unit_form_edit'} ? "checked" : ''; ?>>
                                                    <label for="edit_unit" class="padding05"><?= lang('edit') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-view_unit" name="view_unit"
                                                        <?php echo $p->{'unit_view'} ? "checked" : ''; ?>>
                                                    <label for="view_unit" class="padding05"><?= lang('view') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-delete_unit" name="delete_unit"
                                                        <?php echo $p->{'unit_delete'} ? "checked" : ''; ?>>
                                                    <label for="delete_unit"
                                                        class="padding05"><?= lang('delete') ?></label>
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
<!--------------------------------------------------------               end -------------------------------->




							<!--------------------------------- start Block -----------------------------------            -->
<!--
                            <div class="table-responsive" style="margin:12px;">
                                <table class="table table-bordered table-hover table-striped" style="margin:0 auto;">
                                    <thead>
                                        <tr>
                                            <th colspan="6" class="text-center">
                                                   <?php echo $this->lang->line("report") . ' ( ' . $this->lang->line("report"). ' ) ' . $this->lang->line("group_permissions"); ?>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?= lang("projects"); ?></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-project" name="project_index"
                                                        <?php echo $p->{'project_index'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-project"
                                                        class="padding05"><?= lang('list') ?></label>
                                                </span></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-add_project" name="add_project"
                                                        <?php echo $p->{'project_form'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-add_project"
                                                        class="padding05"><?= lang('add') ?></label>
                                                </span></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-edit_project" name="edit_project"
                                                        <?php echo $p->{'project_form_edit'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-edit_project"
                                                        class="padding05"><?= lang('edit') ?></label>
                                                </span></td>

                                            <td> <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-view_project" name="view_project"
                                                        <?php echo $p->{'project_view'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-view_project"
                                                        class="padding05"><?= lang('view') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-delete_project" name="delete_project"
                                                        <?php echo $p->{'project_delete'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-delete_project"
                                                        class="padding05"><?= lang('delete') ?></label>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><?= lang("buildings"); ?></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-building" name="building_index"
                                                        <?php echo $p->{'building_index'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-building"
                                                        class="padding05"><?= lang('list') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-add_building" name="add_building"
                                                        <?php echo $p->{'building_form'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-add_project"
                                                        class="padding05"><?= lang('add') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-edit_building" name="edit_building"
                                                        <?php echo $p->{'building_form_edit'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-edit_buidling"
                                                        class="padding05"><?= lang('edit') ?></label>
                                                </span>
                                            </td>
                                            <td><span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-view_building" name="view_building"
                                                        <?php echo $p->{'building_view'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-view_building"
                                                        class="padding05"><?= lang('view') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-delete_building" name="delete_building"
                                                        <?php echo $p->{'building_delete'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-delete_building"
                                                        class="padding05"><?= lang('delete') ?></label>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><?= lang("floors"); ?></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-floor" name="floor_index"
                                                        <?php echo $p->{'floors_index'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-floor"
                                                        class="padding05"><?= lang('list') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-add_floor" name="add_floor"
                                                        <?php echo $p->{'floors_form'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-add_floor"
                                                        class="padding05"><?= lang('add') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-edit_floor" name="edit_floor"
                                                        <?php echo $p->{'floors_form_edit'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-edit_floor"
                                                        class="padding05"><?= lang('edit') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-view_floor" name="view_floor"
                                                        <?php echo $p->{'floors_view'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-view_floor"
                                                        class="padding05"><?= lang('view') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-delete_floor" name="delete_floor"
                                                        <?php echo $p->{'floors_deleted'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-delete_floor"
                                                        class="padding05"><?= lang('delete') ?></label>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><?= lang("units"); ?></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-units" name="units_index"
                                                        <?php echo $p->{'unit_index'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-units"
                                                        class="padding05"><?= lang('list') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-add_unit" name="add_unit"
                                                        <?php echo $p->{'unit_form'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-add_unit"
                                                        class="padding05"><?= lang('add') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-edit_unit" name="edit_unit"
                                                        <?php echo $p->{'unit_form_edit'} ? "checked" : ''; ?>>
                                                    <label for="edit_unit" class="padding05"><?= lang('edit') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-view_unit" name="view_unit"
                                                        <?php echo $p->{'unit_view'} ? "checked" : ''; ?>>
                                                    <label for="view_unit" class="padding05"><?= lang('view') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-delete_unit" name="delete_unit"
                                                        <?php echo $p->{'unit_delete'} ? "checked" : ''; ?>>
                                                    <label for="delete_unit"
                                                        class="padding05"><?= lang('delete') ?></label>
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
<!--------------------------------------------------------               end -------------------------------->



							<!--------------------------------- start Block -----------------------------------            -->
<!--
                            <div class="table-responsive" style="margin:12px;">
                                <table class="table table-bordered table-hover table-striped" style="margin:0 auto;">
                                    <thead>
                                        <tr>
                                            <th colspan="6" class="text-center">
                                                   <?php echo $this->lang->line("master") . ' ( ' . $this->lang->line("master"). ' ) ' . $this->lang->line("group_permissions"); ?>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?= lang("projects"); ?></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-project" name="project_index"
                                                        <?php echo $p->{'project_index'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-project"
                                                        class="padding05"><?= lang('list') ?></label>
                                                </span></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-add_project" name="add_project"
                                                        <?php echo $p->{'project_form'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-add_project"
                                                        class="padding05"><?= lang('add') ?></label>
                                                </span></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-edit_project" name="edit_project"
                                                        <?php echo $p->{'project_form_edit'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-edit_project"
                                                        class="padding05"><?= lang('edit') ?></label>
                                                </span></td>

                                            <td> <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-view_project" name="view_project"
                                                        <?php echo $p->{'project_view'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-view_project"
                                                        class="padding05"><?= lang('view') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-delete_project" name="delete_project"
                                                        <?php echo $p->{'project_delete'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-delete_project"
                                                        class="padding05"><?= lang('delete') ?></label>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><?= lang("buildings"); ?></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-building" name="building_index"
                                                        <?php echo $p->{'building_index'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-building"
                                                        class="padding05"><?= lang('list') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-add_building" name="add_building"
                                                        <?php echo $p->{'building_form'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-add_project"
                                                        class="padding05"><?= lang('add') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-edit_building" name="edit_building"
                                                        <?php echo $p->{'building_form_edit'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-edit_buidling"
                                                        class="padding05"><?= lang('edit') ?></label>
                                                </span>
                                            </td>
                                            <td><span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-view_building" name="view_building"
                                                        <?php echo $p->{'building_view'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-view_building"
                                                        class="padding05"><?= lang('view') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-delete_building" name="delete_building"
                                                        <?php echo $p->{'building_delete'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-delete_building"
                                                        class="padding05"><?= lang('delete') ?></label>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><?= lang("floors"); ?></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-floor" name="floor_index"
                                                        <?php echo $p->{'floors_index'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-floor"
                                                        class="padding05"><?= lang('list') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-add_floor" name="add_floor"
                                                        <?php echo $p->{'floors_form'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-add_floor"
                                                        class="padding05"><?= lang('add') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-edit_floor" name="edit_floor"
                                                        <?php echo $p->{'floors_form_edit'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-edit_floor"
                                                        class="padding05"><?= lang('edit') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-view_floor" name="view_floor"
                                                        <?php echo $p->{'floors_view'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-view_floor"
                                                        class="padding05"><?= lang('view') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-delete_floor" name="delete_floor"
                                                        <?php echo $p->{'floors_deleted'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-delete_floor"
                                                        class="padding05"><?= lang('delete') ?></label>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><?= lang("units"); ?></td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-units" name="units_index"
                                                        <?php echo $p->{'unit_index'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-units"
                                                        class="padding05"><?= lang('list') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-add_unit" name="add_unit"
                                                        <?php echo $p->{'unit_form'} ? "checked" : ''; ?>>
                                                    <label for="system_settings-add_unit"
                                                        class="padding05"><?= lang('add') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-edit_unit" name="edit_unit"
                                                        <?php echo $p->{'unit_form_edit'} ? "checked" : ''; ?>>
                                                    <label for="edit_unit" class="padding05"><?= lang('edit') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-view_unit" name="view_unit"
                                                        <?php echo $p->{'unit_view'} ? "checked" : ''; ?>>
                                                    <label for="view_unit" class="padding05"><?= lang('view') ?></label>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="inline-block">
                                                    <input type="checkbox" value="1" class="checkbox"
                                                        id="system_settings-delete_unit" name="delete_unit"
                                                        <?php echo $p->{'unit_delete'} ? "checked" : ''; ?>>
                                                    <label for="delete_unit"
                                                        class="padding05"><?= lang('delete') ?></label>
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
<!--------------------------------------------------------               end -------------------------------->

                                        








                            <div class="form-actions">
                                <button type="submit" style="margin:12px;"
                                    class="btn btn-primary"><?=lang('update')?></button>
                                <input type="hidden" name="flag" value="1">
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
        </div>
    </div>


    <script>
    $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '10%' // optional
    });
    </script>