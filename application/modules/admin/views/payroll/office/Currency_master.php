<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/ajax.js"></script>
<script>
$(document).ready(function() {
    oTable = $('#UnitTable').dataTable({
        "aaSorting": [
            [1, "asc"]
        ],
        "aLengthMenu": [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "<?= lang('all') ?>"]
        ],
        "iDisplayLength": 10,
        'bProcessing': true,
        'bServerSide': true,
        'sAjaxSource': "<?php echo  base_url()  ?>" + 'admin/payroll/office/get_currency',
        'fnServerData': function(sSource, aoData, fnCallback) {
            $.ajax({
                'dataType': 'json',
                'type': 'POST',
                'url': sSource,
                'data': aoData,
                'success': fnCallback
            });
        },
        "aoColumns": [{
            "bSortable": false
        }, null, null, null, {
            "bSortable": false
        }]
    });
});
</script>
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
        <li><a href="<?php echo site_url('admin/payroll/office/Currency') ?>"> <?= lang('List_currency') ?> </a></li>
    </ol>
</section>
<div id="msg" class="col-md-8" style="margin:0 auto;"></div>
    <div class="col-sm-12 col-xs-12" style="margin-top: 15px;">
        <div class="box">
            <div class="box-header">
                <h2 class="blue"><?= lang('List_currency') ?></h2>
                <div class="box-icon">
                    <a style="margin:4px;" class="btn btn-default btn-sm btn-flat" onclick="add()"><i
                     class="fa fa-fw fa-plus"></i><?= lang('Add_Currency') ?></a>
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
                                        <th><?= lang("id"); ?></th>
                                         <th><?= lang('Currency_name') ?></th>
										 <th><?= lang('Currency_Codes') ?></th>
										 <th><?= lang('Exchenage_rates') ?></th>
                                        <th style="width:100px;"><?= lang("actions"); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="5" class="dataTables_empty">
                                            <?= lang('loading_data_from_server') ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
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
    var list        = 'admin/payroll/office/Currency_list';
    var saveRow     = 'admin/payroll/office/add_Currency';
    var edit        = 'admin/payroll/office/update_Currency';
    var deleteRow   = 'admin/payroll/office/Currency_Delete/';
    var saveSuccess = "<?php echo $this->message->success_msg() ?>" ;
    var deleteSuccess = "<?php echo $this->message->delete_msg() ?>" ;
    var deleteError = "<?php echo lang('record_has_been_used'); ?>" ;
    function edit_title(id){
        save_method = 'update';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        //Ajax Load data from ajax
        $.ajax({
            url : "<?php echo site_url('admin/payroll/office/Edit_Currency/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $('[name="id"]').val(data.id);
                $('[name="countryname"]').val(data.Country);
				$('[name="Currency_code"]').val(data.Currency_code);
				$('[name="Symbol"]').val(data.Symbol);
				$('[name="ExchangeRate"]').val(data.Exchange_rate);
				$('[name="precision"]').val(data.Round_of);
				$('[name="Valid_amount"]').val(data.Valid_amount);
                $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Currency'); // Set title to Bootstrap modal title

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
                <h4 class="modal-title"><?= lang('Add_Currency') ?></h4>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id"/>
                    <div class="form-body">
				              	<div class="col-md-12">
                                    <div class="form-group ">
                                        <label><?= lang('country') ?><span class="required" aria-required="true">*</span></label><br>
                                    
									   <select class="form-control country" name="countryname">
									   <option value=""><?= lang('please_select') ?>..</option>
									   <?php  if(isset($Countries))
									   { 
								   foreach($Countries as $country)
										   {	
?>										   
									   <option value="<?php  echo $country->country ; ?>"><?php  echo $country->country ; ?></option>
									   <?php  
										   }
									   }
									   ?>
									   </select>
                                    </div>
                                </div>
								  <div class="col-md-12">
                                    <div class="form-group">
                                        <label><?= lang('Currency_Codes') ?><span class="required" aria-required="true">*</span></label>
                                        <input type="text" name="Currency_code" class="form-control">
                                    </div>
                                </div>
								  <div class="col-md-12">
                                    <div class="form-group">
                                        <label><?= lang('Exchenage_rates') ?><span class="required" aria-required="true">*</span></label>
                                        <input type="text" name="ExchangeRate" class="form-control allowdecimalpoint">
                                    </div>
                                </div>
								  <div class="col-md-12">
                                    <div class="form-group">
                                        <label><?= lang('Symbols') ?><span class="required" aria-required="true">*</span></label>
                                        <input type="text" name="Symbol" class="form-control">
                                    </div>
                                </div>
								<div class="col-md-12">
                                    <div class="form-group">
                                        <label><?= lang('default_currency') ?><span class="required" aria-required="true">*</span></label>
                                        <input type="text" readonly value="<?php  echo get_option('default_currency'); ?>" class="form-control">
                                    </div>
                                </div>
								<div class="col-md-12">
                                    <div class="form-group">
                                        <label><?= lang('Round_Half') ?><span class="required" aria-required="true">*</span></label>
                                        <input type="text" id="precision" name="precision" class="form-control allownumber">
                                    </div>
                                </div>
								<div class="col-md-12">
                                    <div class="form-group">
                                        <label><?= lang('Valid_amount') ?><span class="required" aria-required="true">*</span></label>
                                        <input type="text" id="valid_amount" name="Valid_amount" class="form-control allowdecimalpoint" >
                                    </div>
                                </div>
								
								<div class="col-md-12">
                                    <div class="form-group">
                                        <label><?= lang('Convert_currency') ?><span class="required" aria-required="true">*</span></label>
                                       	 <select class=" form-control " style="width: 100%;" name="precision_convert_type">
											 <option value="0">Same Currency</option>
                                             <?php foreach($currency_master as $item){ ?>
                                                <option value="<?php echo $item->id ?>"><?php echo $item->Currency_code ?></option>
                                            <?php } ?>
                                        </select>
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
    $( "#datepicker" ).datepicker();
    $( "#datepicker1" ).datepicker();
  });
  </script>
<script>
	$('.country').on('change',function(){
		   var Country_id=$(this).val();
		   $.ajax({
             url : "<?php echo site_url('admin/payroll/office/Currency_load/')?>/" + Country_id,
            type: "GET",
            data : {'csrf_test_name' : getCookie('csrf_cookie_name')},
            dataType: "JSON",
            success: function(data){
				$('[name="Currency_code"]').val(data.currency_code);
				$('[name="Symbol"]').val(data.Symbol);
                $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Add Currency'); // Set title to Bootstrap modal title
 
            },
            
        });
		
	});

</script>
<script>
$("#btnSave").click(function ()  {

    $("#form").validate({
        excluded: ':disabled',
        rules: {
             precision:
			 { 
			 required:true
			 },
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



</script>
<script>
	$('form').attr('autocomplete', 'off');
	</script>