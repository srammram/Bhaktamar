<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap-datepicker.min.css">


  <?php  $seg= $this->uri->segment(4);?>
   <section class="content-header">
          <h1>
            <?php echo $page_title; ?>
           </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
			<li><a href="<?php echo site_url('admin/Facility') ?>"> <?php echo lang('Facility')?> </a></li>
            <li class="active"><?php echo (empty($seg))?lang('add'):lang('edit');?></li>
          </ol>
	</section>
      <section class="content">
		  <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body">
			
    <?php echo form_open_multipart('admin/payroll/office/save_holiday/', $attribute= array('id' => 'holiday'))?>


        <div class="form-group">
            <label for="exampleInputEmail1"><?= lang('event_name') ?><span class="required">*</span></label>
            <input type="text" name="event_name" value="<?php if (!empty($event_name)) {echo $event_name;} ?>" required class="form-control">
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1"><?= lang('description') ?><span
                    class="required">*</span></label>
            <textarea class="form-control" name="description" required><?php if (!empty($description)) {echo $description;} ?></textarea>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1"><?= lang('start_date') ?><span class="required">*</span></label>
            <div class="input-group">
                <input type="text" class="form-control datepicker" required name="start_date" id="start_date" value="<?php if (!empty($start_date)) {echo date('Y-m-d', strtotime($start_date));} ?>"
                       data-date-format="yyyy/mm/dd" onkeydown="return false" >
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1"><?= lang('end_date') ?><span class="required">*</span></label>
            <div class="input-group">
                <input type="text" class="form-control datepicker" name="end_date" required value="<?php if (!empty($end_date)) {echo date('Y-m-d', strtotime($end_date));} ?>"
                       data-date-format="yyyy/mm/dd" onkeydown="return false" >
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
            </div>
        </div>

        <input type="hidden" name="holiday_id" value="<?php if(!empty($holiday_id)) echo $holiday_id ?>">

        <span class="required">*</span> <?= lang('required_field') ?>

        <div class="modal-footer" >

            <button type="button" id="close" class="btn btn-danger btn-flat pull-left" data-dismiss="modal"><?= lang('close') ?></button>
            <button type="submit" class="btn bg-olive btn-flat" id="btn" ><?= lang('save') ?></button>


        </div>


    <?php echo form_close()?>
     			 </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div><!-- /.col -->
          </div><!-- /.row -->
        </section>
		 
</section>
<script src="<?php echo base_url('assets/admin/plugins/daterangepicker/daterangepicker.js')?>"></script>
<script src="<?php echo base_url('assets/admin/plugins/iCheck/icheck.min.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/') ?>/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url('assets/admin/plugins')?>/jquery-validation/jquery.validate.min.js"></script>
<script type="text/javascript">
 $(document).ready(function() {
    $('#my-select').multiselect();
  });
 </script>
 <script>
  $('#modalSmall').on('hidden.bs.modal', function () {
        location.reload();
    });

    $(document).ready(function() {
        $('.datepicker').datepicker({
            autoclose: true,
            format: "yyyy-mm-dd",
            todayHighlight: true,
            orientation: "top auto",
            todayBtn: true,
            todayHighlight: true,
        });
    });

    $("#btn").click(function ()  {

        $("#holiday").validate({
            excluded: ':disabled',
            rules: {
                event_name: {
                    required: true
                },
                description: {
                    required: true
                },

                start_date: {
                    required: true
                },
                end_date: { greaterThanDate: "#start_date" }

            },

            highlight: function(element) {
                $(element).closest('.form-group').addClass('has-error');
            },
            unhighlight: function(element) {
                $(element).closest('.form-group').removeClass('has-error');
            },
            errorElement: 'span',
            errorClass: 'help-block animated fadeInDown',
            errorPlacement: function(error, element) {
                if (element.parent('.input-group').length) {
                    error.insertAfter(element.parent());
                } else {
                    error.insertAfter(element);
                }
            }
        })
    });


    // start date end date validation
    jQuery.validator.addMethod("greaterThanDate",
        function(value, element, params) {


            if (!/Invalid|NaN/.test(new Date(value))) {
                return new Date(value) >= new Date($(params).val());
            }

            return Number(value) >= Number($(params).val());
        },'<?= lang ('end_date_must_be_greater_than_start_date.') ?>');

    $('body').on('hidden.bs.modal', '.modal', function () {
        $(this).removeData('bs.modal');
    });
 </script>
