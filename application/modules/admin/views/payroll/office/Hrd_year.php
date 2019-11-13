<script src="<?php echo site_url('assets/js/ajax.js') ?>"></script>
<div class="row">
    <div class="col-md-12">
        <!-- general form elements -->
		<div id="msg"></div>
        <div class="box box-primary">
		  
            <div class="box-header with-border bg-primary-dark">
                <h3 class="box-title"><?= lang('hrd_years_list') ?></h3>
                <div class="box-tools">
                    <div class="input-group input-group-sm" >
                        <a class="btn btn-default btn-sm btn-flat" onclick="add()"><i class="fa fa-fw fa-plus"></i><?= lang('Add_hrd_year') ?></a>
                    </div>
                </div>
				
            </div>
            <!-- /.box-header -->
            <!-- form start -->

            <div class="box-body">

                <!-- View massage -->
                <div class="row">
				
                    <div class="col-md-12">
                      

                        <table id="datatable-buttons" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th><?= lang('hrd_years') ?></th>
									 <th><?= lang('Year_range') ?></th>
                                    
                                    <th>
                                        <?= lang('active') ?>
                                    </th>
                                    <th class="text-center">
                                        <?= lang('actions') ?>
                                    </th>
                                </tr>
                            </thead>


                            <tbody>
                                <?php if(!empty($hrd_year)){ ?>
                                    <?php foreach($hrd_year as $item){ ?>
                                        <tr>
                                            <td>
                                                <?php echo $item->Hrd_year_name ?>
                                            </td>
											<td>
                                                <?php echo date('d-m-Y',strtotime($item->from_date)) ?> to  <?php echo date('d-m-Y',strtotime($item->To_date)) ?>     
                                            </td>
                                            <td>
                                                <label class="css-input switch switch-sm switch-success">
                                                    <input id="<?php echo str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encrypt->encode($item->id)) ?>" <?php echo $item->Active == 1 ? 'checked':'' ?> type="checkbox" onclick='HrdYear_active(this)'><span></span>
                                                </label>
                                            </td>
                                            <td class="text-center">
                                               <div class="btn-group"><a class="btn btn-xs btn-default" href="javascript:void(0)" onclick="edit_title(<?php  echo $item->id; ?>)"><i class="fa fa-pencil"></i></a>
				                               <a class="btn btn-xs btn-danger" href="javascript:void(0)"  onclick="HrdYear_delete((<?php  echo $item->id; ?>))"><i class="glyphicon glyphicon-trash"></i></a></div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
								
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </div>
</div>
<script>
    var save_method; //for save method string
    var table;
    var list        = 'admin/office/HRDyear_list';
    var saveRow     = 'admin/office/add_Hrd_year';
    var edit        = 'admin/office/update_Hrd_Year';
    var deleteRow   = 'admin/office/delete_Delete/';
    var saveSuccess = "<?php echo $this->message->success_msg() ?>" ;
	var Errors = "<div class='alert alert-danger'>Invalid Date Range</div>" ;
    var deleteSuccess = "<?php echo $this->message->delete_msg() ?>" ;
    var deleteError = "<?php echo lang('record_has_been_used'); ?>" ;
    function edit_title(id)
    {

        save_method = 'update';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string

        //Ajax Load data from ajax
        $.ajax({
            url : "<?php echo site_url('admin/office/Edit_Hrd_Year/')?>/" + id,
            type: "GET",
            data : {'csrf_test_name' : getCookie('csrf_cookie_name')},
            dataType: "JSON",
            success: function(data)
            {
                $('[name="id"]').val(data.id);
                $('[name="Hrd_year"]').val(data.Hrd_year_name);
				$('[name="From_date"]').val(data.from_date);
				$('[name="Todate"]').val(data.To_date);
                $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('<?= lang('Add_hrd_year') ?>'); // Set title to Bootstrap modal title

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

</script>
<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><?= lang('Add_hrd_year') ?></h4>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id"/>
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3"><?= lang('hrd_years') ?></label>
                            <div class="col-md-9">
                                <input name="Hrd_year"  class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
					     	<div class="col-md-6">
                                    <!-- /.Start Date -->
                                    <div class="form-group form-group-bottom col-md-10">
                                        <label><?= lang('From_date') ?><span class="required" aria-required="true">*</span></label>
                                        <div class="input-group">
                                            <input class="form-control" id="datepicker" name="From_date" data-date-format="yyyy/mm/dd" type="text">
                                            <div class="input-group-addon">
                                               <i class="fa fa-calendar-o"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								<div class="col-md-6">
                                    <!-- /.Start Date -->
                                    <div class="form-group form-group-bottom col-md-10">
                                        <label><?= lang('To_date') ?> <span class="required" aria-required="true">*</span></label>

                                        <div class="input-group">
                                            <input class="form-control" id="datepicker1"  name="Todate" data-date-format="yyyy/mm/dd" type="text">
                                            <div class="input-group-addon">
                                               <i class="fa fa-calendar-o"></i>
                                            </div>
                                        </div>
                                    </div>
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
<!-- End Bootstrap modal -->

<script>
        $(function() {
         
			$('#datepicker').datepicker({
     format: "yyyy-mm-dd",
     autoclose: true,
}).on('changeDate', function (ev) {
     $(this).datepicker('hide');
});

      
        });
    </script>
	<script>
        $(function() {
         
			$('#datepicker1').datepicker({
     format: "yyyy-mm-dd",
     autoclose: true,
}).on('changeDate', function (ev) {
     $(this).datepicker('hide');
});

      
        });
    </script>
	<script>
	$('form').attr('autocomplete', 'off');
	</script>