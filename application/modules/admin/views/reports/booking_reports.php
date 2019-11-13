<link rel="stylesheet" href="<?php echo base_url('assets/admin/') ?>/plugins/datepicker/datepicker3.css">  <?php  $seg= $this->uri->segment(4);?>
<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
<link href="<?php echo base_url('assets/admin/plugins/responsivetabs/responsive-tabs.css')?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('assets/admin/plugins/responsivetabs/style.css')?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('assets/admin/plugins/datatables/dataTables.bootstrap.css')?>" rel="stylesheet" type="text/css" />

<style>
#weekchart{
  width: 100%;
  height: 500px;
}
#monthchart{
  width: 100%;
  height: 500px;
}
#yearchart{
  width: 100%;
  height: 500px;
}
#customchart{
  width: 100%;
  height: 500px;
}
.amcharts-export-menu-top-right {
  top: 10px;
  right: 0;
}
.amcharts-chart-div a{display:none !important}
</style>

<section class="content-header">
          <h1>
            <?php echo $page_title; ?>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
            <li class="active"><?php echo lang('client_reports'); ?></li>
          </ol>
</section>


<section class="content">
         
		 
		      <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title"> <?php echo $page_title; ?>
       </h3>
                </div><!-- /.box-header -->
                      <div class="row tab-pane" id="3a">
            <div class="col-xs-12">
              <div class="box">
                
                <div class="box-body">
                  <table class="table table-striped" id="example1">
                     <thead >
                    <tr>
                      <th><?php echo lang('no'); ?></th>
                      <th><?php echo lang('Booking_id'); ?></th>
                      <th><?php echo lang('refno'); ?></th>
                      <th><?php echo lang('Client_name'); ?></th>
                      <th><?php echo lang('Project'); ?></th>
                      <th><?php echo lang('Unit_No'); ?></th>   
                      <th><?php echo lang('Status'); ?></th>
                     </tr>
                     </thead>
                    <tbody >
                    <?php if($booking_reports):?>   
                    <?php $i=1;foreach ($booking_reports as $booking):?>
                    <tr>
                      <td><?php echo  $i; ?></td>
                      <td><?php echo  $booking->id; ?></td>
                      <td><?php echo  $booking->ref_no; ?></td>
                      <td><?php echo  $booking->customer_name; ?></td>
                      <td><?php echo  $booking->projectname; ?> </td>
                      <td><?php echo  $booking->unit_no; ?></td>
                      <td><?php echo  $booking->booking_status; ?></td>                     
                    </tr>
                    <?php $i++; endforeach;?>
                    <?php endif?>
                    </tbody>
                </table>
              </div>
              </div>
            </div>
          </div>
              </div><!-- /.box -->

            </div><!-- /.col -->
          </div><!-- /.row -->

        </section>


<!-- Resources -->
<script src="<?php echo base_url('assets/admin/plugins/responsivetabs/jquery.responsiveTabs.min.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/') ?>/plugins/datepicker/bootstrap-datepicker.js"></script>

<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/serial.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>

<!-- Chart code -->


<script src="<?php echo base_url('assets/admin/plugins/datatables/jquery.dataTables.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/plugins/datatables/dataTables.bootstrap.js')?>" type="text/javascript"></script>
<script type="text/javascript">
  $('#example1').DataTable( {
    dom: 'Bfrtip',
    buttons: [
        'copy', 'excel', 'pdf'
    ],
    "paging":   false,
} );

/*$(function() {
  $('#example1').dataTable({
    "paging":   false,
  });
  
});*/

</script>