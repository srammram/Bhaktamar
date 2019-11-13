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
        <li><a href="<?php echo site_url('admin/payroll/office/holidayList') ?>"> <?= lang('holiday') ?> </a></li>
    </ol>
</section>
<div id="msg" class="col-md-8" style="margin:0 auto;"></div>

    <div class="col-sm-12 col-xs-12" style="margin-top: 15px;">
        <div class="box">
            <div class="box-header">
                <h2 class="blue"><?= lang('list_of_holiday') ?></h2>
                <div class="box-icon">
                    <a style="margin:4px;" class="btn btn-default btn-sm btn-flat" href="<?php echo site_url('admin/payroll/office/holiday_form/') ?>"><i
                     class="fa fa-fw fa-plus"></i><?= lang('add_holiday') ?></a>

                </div>
            </div>
            <div class="box-content">
                  <p class="introtext"><?= lang('list_results'); ?></p>
                            <table class="table table-bordered table-striped datatable-buttons" >
                                <thead ><!-- Table head -->
                                <tr>
                                    <th class="active"><?= lang('holiday') ?></th>
                                    <th class="active"><?= lang('description') ?></th>
                                    <th class="active"><?= lang('start_date') ?></th>
                                    <th class="active"><?= lang('end_date') ?></th>
                                    <th class="active"><?= lang('actions') ?></th>
                                </tr>
                                </thead><!-- / Table head -->
                                <tbody><!-- / Table body -->

                                <?php if (!empty($yearly_holiday)): foreach ($yearly_holiday as $name => $month) : ?>
                                    <?php if(!empty($month)): foreach($month as $item):?>
                                        <tr class="custom-tr">
                                            <td class="vertical-td"><?php echo  $item->event_name ?></td>
                                            <td class="vertical-td"><?php echo  $item->description ?></td>
                                            <td class="vertical-td"><?php echo $item->start_date ?></td>
                                            <td class="vertical-td"><?php echo $item->end_date ?></td>
                                            <td class="vertical-td">
                                                <div class="btn-group">
                                                        <a  
                                                            href="<?php echo site_url('admin/payroll/office/holiday_form/'. $item->holiday_id) ?>" class="btn btn-xs bg-gray">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                                    <a class="btn btn-xs btn-danger"
                                                       onClick="return confirm('Are you sure you want to delete?')" href="<?php echo site_url('admin/payroll/office/deleteHoliday/'. $item->holiday_id) ?>" ><i class="glyphicon glyphicon-trash"></i></a>
                                                </div>
                                            </td>

                                        </tr>
                                        <?php
                                    endforeach;
                                    endif;
                                endforeach;
                                    ?><!--get all sub category if not this empty-->
                                <?php else : ?> <!--get error message if this empty-->
                                    <td colspan="5">
                                        <strong><?= lang('no_records_found') ?></strong>
                                    </td><!--/ get error message if this empty-->
                                <?php endif; ?>
                                </tbody><!-- / Table body -->
                            </table> <!-- / Table -->
                        </div>

            </div>
        </div>
    </div>
   
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/jquery.dataTables.dtFilter.min.js">
</script>
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/customdatatable.js"></script>

<script>
var save_method; //for save method string
var table;
var saveRow = 'admin/payroll/office/add_department';
var edit = 'admin/payroll/office/update_department';
var deleteRow = 'admin/payroll/office/delete_department/';
var saveSuccess = "<?php echo $this->message->success_msg() ?>";
var deleteSuccess = "<?php echo $this->message->delete_msg() ?>";
var deleteError = "<?php echo lang('record_has_been_used'); ?>";

function edit_title(id) {
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url: "<?php echo site_url('admin/payroll/office/edit_department/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            $('[name="id"]').val(data.id);
            $('[name="department"]').val(data.department);
            $('[name="description"]').val(data.description);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Department'); // Set title to Bootstrap modal title

        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert('Error get data from ajax');
        }
    });
}
</script>