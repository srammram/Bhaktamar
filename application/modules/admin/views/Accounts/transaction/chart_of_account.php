<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/ajax.js"></script>
<style>
.modal-header {
    background-color: #0083ad !important;
    color: #fff;
}
</style>
<?php  $seg= $this->uri->segment(4);?>
<section class="content-header">
    <h1>&nbsp;</h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i>
                <?php echo lang('dashboard')?></a></li>
        <li><a href="<?php echo site_url('admin/accounts/chartOfAccount') ?>"> <?= lang('chart_of_accounts_list') ?> </a></li>
    </ol>
</section>
<div id="msg" class="col-md-8" style="margin:0 auto;"></div>
    <div class="col-sm-12 col-xs-12" style="margin-top: 15px;">
        <div class="box">
            <div class="box-header">
                <h2 class="blue"><?= lang('chart_of_accounts_list') ?></h2>
                <div class="box-icon">
                    <a style="margin:4px;" class="btn btn-default btn-sm btn-flat" onclick="add()"><i
                     class="fa fa-fw fa-plus"></i><?= lang('add_new_account') ?></a>
                </div>
            </div>
            <div class="box-content">
                <div class="row">
                    <div class="col-lg-12">
                        <p class="introtext"><?= lang('list_results'); ?></p>
                        <div class="table-responsive col-sm-12">
                            <table id="UnitTable" class="table table-bordered table-hover table-striped reports-table">
                               <thead>
                        <tr>
                            <th><?= lang('name') ?></th>
                            <th><?= lang('description') ?></th>
                            <th><?= lang('account_type') ?></th>
                            <th><?= lang('balance') ?></th>
                            <th><?= lang('actions') ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($accounts_head as $item) { ?>
                            <tr>
                                <td>
                                    <a href="<?php echo site_url('admin/accounts/viewTransaction/'.'account-'.$item->id) ?>">
                                    <?php echo $item->account_title ?>
                                    </a>
                                </td>
                                <td><?php echo $item->description ?></td>
                                <td><?php echo $item->account_type ?></td>
                                <td><?php echo $item->balance ?>
                                </td>
                                <td>
                                    <?php if($item->sys): ?>
                                    <div class="btn-group">
                                        <a data-target="#modalSmall" title="View" data-placement="top" data-toggle="modal"
                                           class="btn btn-xs btn-default" href="javascript:void(0)" onclick="edit_title(<?php  echo $item->id;  ?>)">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a class="btn btn-xs btn-danger" onClick="return confirm('Are you sure you want to delete?')"
                                           href="javascript:void(0)" onclick="deleteItem(<?php  echo $item->id;  ?>)"> <i class="glyphicon glyphicon-trash"></i></a>
                                    </div>
                                    <?php endif ?>
                                </td>
                            </tr>
                        <?php } ?>

                        </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><?= lang('add_new_account') ?></h4>
            </div>
            <div class="modal-body form" style="margin:8px;">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id" />
                    <div class="form-body">
                        
        <div class="form-group">
            <label><?= lang('account_name') ?><span
                    class="required">*</span></label>
            <input type="text" name="account_title" value="<?php if(!empty($account)) echo $account->account_title ?>" class="form-control">
        </div>

        <div class="form-group">
            <label><?= lang('account_number') ?><span
                    class="required">*</span></label>
            <input type="text" name="account_number" value="<?php if(!empty($account)) echo $account->account_number ?>" class="form-control">
        </div>


        <div class="form-group">
            <label for="exampleInputEmail1"><?= lang('description') ?><span
                    class="required">*</span></label>
            <input type="text" name="description" value="<?php if(!empty($account)) echo $account->description ?>" class="form-control">
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1"><?= lang('phone') ?><span
                    class="required">*</span></label>
            <input type="text" name="phone" value="<?php if(!empty($account)) echo $account->phone ?>" class="form-control">
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1"><?= lang('address') ?><span
                    class="required">*</span></label>

            <textarea class="form-control" name="address"><?php if(!empty($account)) echo $account->address ?></textarea>
        </div>
                    </div>

                </form>
            </div>


            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary"><?= lang('save') ?></button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><?= lang('cancel') ?></button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/jquery.dataTables.dtFilter.min.js">
</script>
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/customdatatable.js"></script>

<script>
var save_method; //for save method string
var table;
var saveRow = 'admin/accounts/add_coa';
var edit = 'admin/accounts/update_coa';
var deleteRow = 'admin/accounts/delete_coa/';
var saveSuccess = "<?php echo $this->message->success_msg() ?>";
var deleteSuccess = "<?php echo $this->message->delete_msg() ?>";
var deleteError = "<?php echo lang('record_has_been_used'); ?>";
function edit_title(id) {
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $.ajax({
        url: "<?php echo site_url('admin/accounts/edit_coa/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            $('[name="id"]').val(data.id);
            $('[name="account_title"]').val(data.account_title);
            $('[name="account_number"]').val(data.account_number);
			$('[name="description"]').val(data.description);
			$('[name="phone"]').val(data.phone);
			$('[name="address"]').val(data.address);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Account '); // Set title to Bootstrap modal title

        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert('Error get data from ajax');
        }
    });
}
</script>