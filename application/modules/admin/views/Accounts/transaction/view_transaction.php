<section class="content-header">
    <h1>
        <?php echo $page_title;   ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i><?php echo lang('dashboard')?></a></li>
        <li><a href="<?php echo site_url('admin/accounts/view') ?>"> <?php echo lang('view_transaction')?> </a></li>
       
    </ol>
</section>
<section class="content">
<div class="row">
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header with-border bg-primary-dark">
                <h3 class="box-title"><?= lang('view_transaction') ?></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div class="box-body">
                <!-- View massage -->
                <?php echo message_box('success'); ?>
                <?php echo message_box('error'); ?>
                <div class="row">
                    <div class="col-md-12">
                       <?php echo form_open('', array('class' => 'form-horizontal', 'id' => 'printableArea')) ?>
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="val-username"><?= lang('date') ?></label>
                                <div class="col-md-7">
                                    <?php echo $this->localization->dateFormat($transaction->date_time) ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="val-username"><?= lang('transaction_id') ?></label>
                                <div class="col-md-7">
                                    <?php echo $transaction->transaction_id ?>
                                </div>
                            </div>

                            <?php if(empty($transaction_from)){ ?>

                                <?php if($transaction->account_id != 2 && $transaction->account_id != 4 ){ ?>
                                    <!-- deposit, expense-->
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="val-email"><?= lang('account') ?></label>
                                        <div class="col-md-7">
                                            <?php echo $transaction->account_title ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="val-password"><?= lang('transaction_type') ?></label>
                                        <div class="col-md-7">
                                            <?php echo $transaction->transaction_type ?>
                                        </div>
                                    </div>
                                <?php }else{ ?>
                                    <!-- A/P, A/R -->
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="val-email"><?= lang('transaction_type') ?></label>
                                        <div class="col-md-7">
                                            <?php echo $transaction->account_title ?>
                                        </div>
                                    </div>



                                <?php } ?>

                            <?php }else{ ?>
                            <!--  transaction between two account-->
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="val-email"><?= lang('from_account') ?></label>
                                    <div class="col-md-7">
                                        <?php echo $transaction_from->account_title ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label" ><?= lang('to_account') ?></label>
                                    <div class="col-md-7">
                                        <?php echo $transaction->account_title ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label"> <?= lang('transaction_type') ?></label>
                                    <div class="col-md-7">
                                        <?php echo $transaction->transaction_type ?>
                                    </div>
                                </div>
                            <?php } ?>

                            <div class="form-group">
                                <label class="col-md-3 control-label"><?= lang('category') ?></label>
                                <div class="col-md-7">
                                    <?php echo $transaction->category_name ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"><?= lang('amount') ?></label>
                                <div class="col-md-7">
                                    <?php echo $this->localization->currencyFormat($transaction->amount) ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label"><?= lang('balance') ?></label>
                                <div class="col-md-7">
                                    <?php echo $this->localization->currencyFormat($transaction->balance) ?>
                                </div>
                            </div>
                            <?php if($transaction->account_id != 2 && $transaction->account_id != 4 ){ ?>
                            <div class="form-group">
                                <label class="col-md-3 control-label"><?= lang('payment_method') ?></label>
                                <div class="col-md-7">
                                    <?php echo $transaction->payment_method ?>
                                </div>
                            </div>
                            <?php } ?>

                            <div class="form-group">
                                <label class="col-md-3 control-label"><?= lang('description') ?></label>
                                <div class="col-md-7">
                                    <?php echo $transaction->description ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"><?= lang('ref') ?>#</label>
                                <div class="col-md-7">
                                    <?php echo $transaction->ref ?>
                                </div>
                            </div>
                    <?php echo form_close() ?>
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-3">
                                <a onclick="print_invoice('printableArea')" class="btn bg-navy btn-flat" type="submit"><?= lang('print') ?></a>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <!-- /.box -->

        </div>
    </div>
</div>