<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<style>
.dr{
	color: #009900;
font-weight: bold;
}
.cr{
	color: #DD4B39;
font-weight: bold;
	
}
.balance{
	color: #0066A4;
font-weight: bold;

}
</style>
<script>
 var url="<?php echo base_url(); ?>";
$(document).ready(function() {
    oTable = $('#transactionlist').dataTable({
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
         'sAjaxSource': "<?php echo  base_url()  ?>" + 'admin/accounts/get_transactionlist',
        'fnServerData': function(sSource, aoData, fnCallback) {
            $.ajax({
                'dataType': 'json',
                'type': 'POST',
                'url': sSource,
                'data': aoData,
                'success': fnCallback
            });
        },
       /*  "aoColumns": [{
            "bSortable": false
        }, null, null,null, null,null, null, null,null, {
            "bSortable": false
        }] */
		/*  "aoColumns": [ {"mRender": null}, {"mRender": null},{"mRender": null},{"mRender": null}, {"mRender": null}, {"mRender": null}, {"mRender": null}, {"mRender": null}, {"mRender": currency_status}, {"bSortable": true}] */
		 "aoColumnDefs": [ {
                   
                   "aTargets": [1],
                   "mRender": function (data, type, full) {
                     return '<a href="'+url+'admin/accounts/view/'+full[0]+'">'+data +'</span>';
                   }
               },{
                   
                   "aTargets": [2],
                   "mRender": function (data, type, full) {
						return '<a href="'+url+'admin/accounts/viewTransaction/account-'+full[9]+'">'+data +'</span>';
                   }
               },{
                   
                   "aTargets": [3],
                   "mRender": function (data, type, full) {
					   
                      return '<a href="'+url+'admin/accounts/viewTransaction/transaction_type-'+full[10]+'">'+data +'</span>';
                   }
               },{
                   
                   "aTargets": [4],
                   "mRender": function (data, type, full) {
					   return data;
					   /*  if(full[4] !='null'){
                      return '<a href="'+url+'admin/accounts/viewTransaction/category_id-'+full[11]+'">'+data +'</span>';
						} */
                   }
               },
			   {
                   
                   "aTargets": [5],
                   "mRender": function (data, type, full) {
                       if (full[9] == "1" || full[9] == "4") {
                           return '<span class="dr">'+data +'</span>';
                       } 
                   }
               }, {
                   "aTargets": [6],
                   "mRender": function (data, type, full) {
                       if (full[9] == "2" || full[9] == "3" || full[9] == "5") {
                           return '<span class="cr">'+data +'</span>';
                       } 
                   }
               },{
                   "aTargets": [7],
                   "mRender": function (data, type, full) {
                      
                           return '<span class="balance">'+data +'</span>';
                     
                   }
               }
			   ,{
                   "aTargets": [9],
                   "mRender": function (data, type, full) {
                      
                           return full[12];
                     
                   }
			   }

               ]
               
             
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
        <li><a href="<?php echo site_url('admin/accounts/transactionlist') ?>"> <?= lang('transaction_list') ?> </a></li>
    </ol>
</section>
<div id="msg" class="col-md-8" style="margin:0 auto;"></div>
    <div class="col-sm-12 col-xs-12" style="margin-top: 15px;">
        <div class="box">
            <div class="box-header">
                <h2 class="blue"><?= lang('transaction_list') ?></h2>
                <div class="box-icon">
                   <h1>&nbsp;</h1>
                </div>
            </div>
            <div class="box-content">
                <div class="row">
                    <div class="col-lg-12">
                        <p class="introtext"><?= lang('list_results'); ?></p>
                        <div class="table-responsive col-sm-12">
                            <table id="transactionlist" class="table table-bordered table-hover table-striped reports-table">
                                <thead>
                                    <tr>
                                        <th><?= lang("id"); ?></th>
                                        <th><?= lang('trns_id') ?></th>
                                        <th><?= lang('account') ?></th>
                                        <th><?= lang('type') ?></th>
                                        <th><?= lang('transaction_category') ?></th>
                                        <th><?= lang('dr') ?>.</th>
                                        <th><?= lang('cr') ?>.</th>
                                        <th><?= lang('balance') ?></th>
                                        <th><?= lang('date') ?></th>
                                        <th style="width:100px;"><?= lang("actions"); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
								
                                    <tr>
                                        <td colspan="10" class="dataTables_empty">
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
