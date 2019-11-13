<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/chosen.min.css">
<link rel="stylesheet" href="<?php echo base_url('assets/admin/') ?>/plugins/datepicker/datepicker3.css">
<script src="<?php echo base_url('assets/admin')?>/dist/js/chosen.jquery.min.js"></script>
<script src="<?php echo base_url('assets/admin')?>/dist/js/bootstrap_select.min.js"></script>
<?php  $seg= $this->uri->segment(4);?>
<section class="content-header">
    <h1>  <?php echo lang('add_transaction')?></h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i>
                <?php echo lang('dashboard')?></a></li>
        <li><a href="<?php echo site_url('admin/accounts/addTransaction') ?>"> <?php echo lang('add_transaction')?> </a></li>
        <li class="active"><?php echo (empty($seg))?lang('add'):lang('edit');?></li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
            <form id="addTransaction" action="<?php echo site_url('admin/accounts/save_transaction')?>" method="post" >
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label><?= lang('transaction_type') ?><span class="required" aria-required="true">*</span></label>
                            <select class="form-control select2" name="transaction_type" id="transaction_type" onchange="transactionType(this)">
                                <option value=""><?= lang('please_select') ?>...</option>
                                <option value="Deposit"><?= lang('deposit') ?></option>
                                <option value="Expenses"><?= lang('expense') ?></option>
                                <option value="AP"><?= lang('accounts_payable') ?></option>
                                <option value="AR"><?= lang('accounts_receivable') ?></option>
                                <option value="TR"><?= lang('account_transfer') ?></option>
                            </select>
                        </div>
                        <!-- account-->
                        <div id="account" style="display: none">
                            <div class="form-group" >
                                <label><?= lang('account') ?><span class="required" aria-required="true">*</span></label>
                                <select class="form-control select2" name="account" id="account_select">
                                    <option value=""><?= lang('please_select') ?>...</option>
                                    <?php foreach($account as $item){ ?>
                                        <option value="<?php echo $item->id ?>"><?php echo $item->account_title ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <!-- account Transfer START-->

                        <div id="transfer_account" style="display: none">
                            <div class="form-group" >
                                <label><?= lang('from_account') ?><span class="required" aria-required="true">*</span></label>
                                <select class="form-control select2" name="from_account" id="account_select">
                                    <option value=""><?= lang('please_select') ?>...</option>
                                    <?php foreach($account as $item){ ?>
                                        <option value="<?php echo $item->id ?>"><?php echo $item->account_title ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-group" >
                                <label><?= lang('to_account') ?><span class="required" aria-required="true">*</span></label>
                                <select class="form-control select2" name="to_account" id="account_select">
                                    <option value=""><?= lang('please_select') ?>...</option>
                                    <?php foreach($account as $item){ ?>
                                        <option value="<?php echo $item->id ?>"><?php echo $item->account_title ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <!-- account Transfer END-->
                        <div class="form-group" id="trn_category">
                            <label><?= lang('category') ?><span class="required" aria-required="true">*</span></label>
                            <select class="form-control select2" name="category_id" id="category">
                                <option value=""><?= lang('please_select') ?>...</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label><?= lang('amount') ?><span class="required" aria-required="true">*</span></label>
                            <input type="text" name="amount" class="form-control">
                        </div>
                            <div class="form-group" id="method" style="display: none">
                                <label><?= lang('payment_method') ?><span class="required" aria-required="true">*</span></label>
                                <select class="form-control select2" name="payment_method">
                                    <option value=""><?= lang('please_select') ?>...</option>
                                    <option value="<?= lang('cash') ?>"><?= lang('cash') ?></option>
                                    <option value="<?= lang('check') ?>"><?= lang('check') ?></option>
                                    <option value="<?= lang('credit_card') ?>"><?= lang('credit_card') ?></option>
                                    <option value="<?= lang('debit_card') ?>"><?= lang('debit_card') ?></option>
                                    <option value="<?= lang('electronic_transfer') ?>"><?= lang('electronic_transfer') ?></option>
                                    <option value="<?= lang('online_payment') ?>"><?= lang('online_payment') ?></option>
                                </select>
                            </div>
                        <div class="form-group">
                            <label><?= lang('ref') ?>#</label>
                            <input type="text" name="ref" class="form-control">
                            <p class="help-block"><?= lang('trans_help') ?></p>
                        </div>

                        <div class="form-group">
                            <label><?= lang('description') ?><span class="required" aria-required="true">*</span></label>
                            <input type="text" name="description" class="form-control">
                        </div>
                        <p class="text-muted"><span class="required" aria-required="true">*</span> <?= lang('required_field') ?></p>
                    </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button id="saveSalary" type="submit" class="btn bg-navy btn-flat"><?= lang('save_transaction') ?></button>
                </div>
            </div>
            <!-- /.box -->
            </form>

                </div><!-- /.box-body -->
            </div><!-- /.box -->

        </div><!-- /.col -->
    </div><!-- /.row -->
</section>
<script src="<?php echo base_url('assets/admin/') ?>/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url('assets/admin/plugins')?>/jquery-validation/jquery.validate.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    $('#my-select').multiselect();
});
</script>