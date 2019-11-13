
  <script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/bootstrap.min.js"></script>
  <link href="<?php echo base_url('assets/admin/plugins/iCheck/all.css')?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('assets/admin/plugins/datatables/dataTables.bootstrap.css')?>" rel="stylesheet" type="text/css" />
<style>
.modal-backdrop{opacity:0;z-index:-1;}
</style>
<section class="content-header">
         <h1>
            <?php echo $page_title; ?>
			 <small><?php echo lang('list'); ?></small>
           </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
			<li><a href="<?php echo site_url('admin/sales/Sales') ?>"> <?php echo lang('Enquiry')." ".lang('list') ?> </a></li>
          </ol>
</section>
      <section class="content">
	  <?php 
			$tab                 = ($this->uri->segment(5)) ? $this->uri->segment(5) : 'tab1';	  ?>
  		<ul  class="nav nav-pills">
			<li class="<?php echo ($tab == 'tab1') ? 'active' : ''; ?>">
				<a href="#1a" data-toggle="tab"><?php echo lang('Confirm Booking'); ?></a>
			</li>
			<li class="<?php echo ($tab == 'tab2') ? 'active' : ''; ?>">
				<a href="#2a" data-toggle="tab"><?php echo lang('Hold Booking'); ?></a>
			</li>
			<li class="<?php echo ($tab == 'tab3') ? 'active' : ''; ?>" > 
				<a href="#3a" data-toggle="tab"><?php echo lang('Cancelled Booking'); ?></a>
			</li>
		</ul>

         <div class="row">
		 	<div class="col-md-12">
				<div class="btn-group pull-right">
					<!-- <a class="btn btn-success" href="<?php echo site_url('admin/Crm/Crm/ClientForm'); ?>"><i class="fa fa-plus"></i> Add </a> -->
				</div>

			</div>
		 </div>
		 <div class="tab-content clearfix">
		 <!--  Conform Booking Start-->
		  <div class="row tab-pane active" id="1a">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title"> <?php echo lang('Confirm Booking'); ?> </h3>
                </div><!-- /.box-header -->
                <div class="box-body">
					<table class="table table-striped" id="example1">
					   <thead >
						<tr>
							<th><?php echo lang('sno'); ?></th>
							<th><?php echo lang('Booking_id'); ?></th>
							<th><?php echo lang('refno'); ?></th>
							<th><?php echo lang('Client_name'); ?></th>
							<th><?php echo lang('Project'); ?></th>
							<th><?php echo lang('Unit_No'); ?></th>		
							<th><?php echo lang('action'); ?></th>
						 </tr>
					   </thead>
						<tbody >
						<?php if($confirm_booking):?>		
						<?php $i=1;foreach ($confirm_booking as $confirm_book):?>
						<tr>
							<td><?php echo  $i; ?></td>
							<td><?php echo  $confirm_book->id; ?></td>
							<td><?php echo  $confirm_book->ref_no; ?></td>
							<td><?php echo  $confirm_book->customer_name; ?></td>
							<td><?php echo  $confirm_book->projectname; ?> </td>
							<td><?php echo  $confirm_book->unit_no; ?></td>
							<td>
				<div class="dropdown text-left"><button type="button" class="btn btn-default btn-xs btn-primary dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:#fff;"><?php echo lang('action'); ?> <span class="caret"></span></button>
                 <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenuButton">
                 <li><a href="<?php echo site_url('admin/sales/Sales/bookingViewDetail/'.$confirm_book->id); ?>"><i class="fa fa-file-text-o"></i><?php echo lang('Booking_details'); ?></a></li>
             <!--    <li><a href="#" data-toggle="modal" data-target="#myModal1"><i class="fa fa-money"></i><?php echo lang('View_payment'); ?> </a></li>
                 <li><a href="<?php echo site_url('admin/sales/Sales/add_payment/'.$confirm_book->id); ?>" data-toggle="modal" data-target="#myModal" class="addpayment"><i class="fa fa-money"></i><?php echo lang('Add_payment'); ?> </a></li> -->
			     <li><a href="<?php echo site_url('admin/sales/Sales/editBooking/'.$confirm_book->id); ?>" class="sledit"><i class="fa fa-edit"></i> <?php echo lang('Edit_booking'); ?></a></li>
                 <li><a href="<?php echo site_url('admin/sales/Sales/cancelBooking/'.$confirm_book->id); ?>" onclick="return areyousure(this);"><i class="fa fa-trash"></i><?php echo lang('Cancel_booking'); ?> </li>
              </ul>   
           </div> 
	     
							</td>
						</tr>
						<?php $i++; endforeach;?>
						<?php endif?>
						</tbody>
				</table>
				 </div>
              </div>
            </div>
          </div>
		  <!--  Conform Booking End-->
		 <!--  Hold Booking Start-->
		  <div class="row tab-pane" id="2a">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title"> <?php echo lang('Hold Booking'); ?> </h3>
                </div><!-- /.box-header -->
                <div class="box-body">
					<table class="table table-striped" id="example2">
					   <thead>
						<tr>
							<th><?php echo lang('no'); ?></th>
							<th><?php echo lang('Booking_id'); ?></th>
							<th><?php echo lang('refno'); ?></th>
							<th><?php echo lang('Client_name'); ?></th>
							<th><?php echo lang('Project'); ?></th>
							<th><?php echo lang('Unit_No'); ?></th>		
							<th><?php echo lang('action'); ?></th>
						 </tr>
					   </thead>
						<tbody >
						<?php if($hold_booking):?>		
						<?php $i=1;foreach ($hold_booking as $hold_book):?>
						<tr>
							<td><?php echo  $i; ?></td>
							<td><?php echo  $hold_book->id; ?></td>
							<td><?php echo  $hold_book->ref_no; ?></td>
							<td><?php echo  $hold_book->customer_name; ?></td>
							<td><?php echo  $hold_book->projectname; ?> </td>
							<td><?php echo  $hold_book->unit_no; ?></td>
							<td>
								<div class="btn-group" style="float:right">
									<a class="btn btn-default" href="<?php echo site_url('admin/sales/Sales/bookingViewDetail/'.$hold_book->id); ?>"><i class="fa fa-eye"></i> <?php echo lang('view')?></a>
									<a class="btn btn-primary" href="<?php echo site_url('admin/sales/Sales/editBooking/'.$hold_book->id); ?>"><i class="fa fa-edit"></i> <?php echo lang('edit')?></a>
									<a class="btn btn-danger" href="<?php echo site_url('admin/sales/Sales/cancelBooking/'.$hold_book->id); ?>" ><i class="fa fa-trash"></i> <?php echo lang('cancel')?></a>
							
								</div>
							</td>
						</tr>
						<?php $i++; endforeach;?>
						<?php endif?>
						</tbody>
				</table>

				 </div>
              </div>

            </div>
          </div>
		  <!--  Hold Booking End-->	
		  
		 <!--  Cancelled Booking Start-->
		  <div class="row tab-pane" id="3a">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title"> <?php echo lang('Cancelled Booking'); ?> </h3>
                </div><!-- /.box-header -->
                <div class="box-body">
					<table class="table table-striped" id="example3">
					   <thead >
						<tr>
							<th><?php echo lang('no'); ?></th>
							<th><?php echo lang('Booking_id'); ?></th>
							<th><?php echo lang('refno'); ?></th>
							<th><?php echo lang('Client_name'); ?></th>
							<th><?php echo lang('Project'); ?></th>
							<th><?php echo lang('Unit_No'); ?></th>		
							<th><?php echo lang('action'); ?></th>
						 </tr>
					   </thead>
						<tbody >
						<?php if($cancelled_booking):?>		
						<?php $i=1;foreach ($cancelled_booking as $cancel_book):?>
						<tr>
							<td><?php echo  $i; ?></td>
							<td><?php echo  $cancel_book->id; ?></td>
							<td><?php echo  $cancel_book->ref_no; ?></td>
							<td><?php echo  $cancel_book->customer_name; ?></td>
							<td><?php echo  $cancel_book->projectname; ?> </td>
							<td><?php echo  $cancel_book->unit_no; ?></td>
							<td>
								<div class="btn-group" style="float:right">
									<a class="btn btn-default" href="<?php echo site_url('admin/sales/Sales/bookingViewDetail/'.$cancel_book->id); ?>"><i class="fa fa-eye"></i> <?php echo lang('view')?></a>
									<a class="btn btn-primary" href="<?php echo site_url('admin/sales/Sales/editBooking/'.$cancel_book->id); ?>"><i class="fa fa-edit"></i> <?php echo lang('edit')?></a>
									<a class="btn btn-danger" href="<?php echo site_url('admin/sales/Sales/deleteBooking/'.$cancel_book->id); ?>" ><i class="fa fa-trash"></i> <?php echo lang('delete')?></a>
									
								</div>
							</td>
						</tr>
						<?php $i++; endforeach;?>
						<?php endif?>
						</tbody>
				</table>
				 </div>
              </div>
            </div>
          </div>
		  <!--  Cancelled Booking End-->	
        </div>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section>
		

<div class="modal" id="myModal1">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                <i class="fa fa-2x">×</i>
            </button>
            <button type="button" class="btn btn-xs btn-default no-print pull-right" style="margin-right:15px;" onclick="window.print();">
                <i class="fa fa-print"></i> Print            </button>
            <h4 class="modal-title" id="myModalLabel"><?php echo lang('View_payment'); ?> </h4>
      </div>
      <div class="modal-body">
            <div class="table-responsive">
                <table id="CompTable" cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover table-striped">
                    <thead>
                    <tr>
                        <th style="width:30%;"><?php echo lang('date'); ?></th>
                        <th style="width:30%;"><?php echo lang('Reference_no'); ?></th>
                        <th style="width:15%;"><?php echo lang('amount'); ?></th>
                        <th style="width:15%;"><?php echo lang('Paidby'); ?></th>
                        <th style="width:10%;"><?php echo lang('Action'); ?></th>
                    </tr>
					<!--<div class="text-center">
                                        <a href="http://localhost/sramrms/admin/sales/payment_note/1" data-toggle="modal" data-target="#myModal2"><i class="fa fa-file-text-o"></i></a>
                                                                                    <a href="http://localhost/sramrms/admin/sales/email_payment/1" class="email_payment"><i class="fa fa-envelope"></i></a>
                                            <a href="http://localhost/sramrms/admin/sales/edit_payment/1" data-toggle="modal" data-target="#myModal2"><i class="fa fa-edit"></i></a>
                                            <a href="#" class="po" title="<b>Delete Payment</b>" data-content="<p>Are you sure?</p><a class='btn btn-danger' id='1' href='http://localhost/sramrms/admin/sales/delete_payment/1'>Yes I'm sure</a> <button class='btn po-close'>No</button>" rel="popover"><i class="fa fa-trash-o"></i></a>
                                                                            </div>
					
					-->
					
					
					
					
					
					
					
					
					
                    </thead>
                    <tbody>
                    <tr><td colspan="5"><?php echo lang('Nodatafound'); ?></td></tr>                    </tbody>
                </table>
            </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('close'); ?></button>
      </div>
    </div>
  </div>
</div>
<script src="<?php echo base_url('assets/admin/plugins/datatables/jquery.dataTables.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/plugins/datatables/dataTables.bootstrap.js')?>" type="text/javascript"></script>
<script type="text/javascript">
$(function() {
	$('#example1').dataTable({
		"paging":   true,
	});

	$('#example2').dataTable({
		"paging":   true,
	});

	$('#example3').dataTable({
		"paging":   true,
	});	
	
});
</script>
<script>
 $(function() {
 $('.datepicker').datepicker({
		autoclose: true,
		todayHighlight: true,
	   format: 'yyyy-mm-dd',
    });
 
	      });
</script>
<script>
$('.payingtype').on('change', function() {
  if(this.value == '<?php echo lang('Credit_Card'); ?>'){
	  $('.pcc_1').css('display','block');
	
  }else{
	$('.pcc_1').css('display','none');
  }
});

</script>