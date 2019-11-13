
  <script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/bootstrap.min.js"></script>
  <link href="<?php echo base_url('assets/admin/plugins/iCheck/all.css')?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('assets/admin/plugins/datatables/dataTables.bootstrap.css')?>" rel="stylesheet" type="text/css" />
<style> 
.modal-backdrop{opacity:0;z-index:-1;}
/* Dropdown */

.dropdown {
  display: inline-block;
  position: relative;
}

.dd-button {
  display: inline-block;
  border: 1px solid gray;
  border-radius: 4px;
  padding: 0px 24px 0px 8px;
  background-color: #ffffff;
  cursor: pointer;
  white-space: nowrap;
  font-size:14px;
}

.dd-button:after {
  content: '';
  position: absolute;
  top: 50%;
  right: 8px;
  transform: translateY(-50%);
  width: 0; 
  height: 0; 
  border-left: 5px solid transparent;
  border-right: 5px solid transparent;
  border-top: 5px solid black;
}
.dd-button:hover {
  background-color: #eeeeee;
}
.dd-input {
  display: none;
}
.dd-menu {
  position: absolute;
  top: 100%;
  border: 1px solid #ccc;
  border-radius: 4px;
  padding: 0;
  margin: 2px 0 0 0;
  box-shadow: 0 0 6px 0 rgba(0,0,0,0.1);
  background-color: #ffffff;
  list-style-type: none;
  right:0px;
}

.dd-input + .dd-menu {
  display: none;
} 

.dd-input:checked + .dd-menu {
  display: block;
} 
.dd-menu li {
  padding: 2px;
  cursor: pointer;
  white-space: nowrap;
}
.dd-menu li:hover {
  background-color: #f6f6f6;
}
.dd-menu li a {
  display: block;
  padding:5px;
  font-size:13px;
}
.dd-menu li.divider{
  padding: 0;
  border-bottom: 1px solid #cccccc;
}
</style>
<section class="content-header">
         <h1>
            <?php echo $page_title; ?>
			 <small><?php echo lang('list'); ?></small>
           </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
			<li><a href="<?php echo site_url('admin/sales/Sales') ?>"> <?php echo $page_title." ".lang('list') ?> </a></li>
          </ol>
</section>
      <section class="content">
	  <?php 
			$tab                 = ($this->uri->segment(5)) ? $this->uri->segment(5) : 'tab1';	  ?>
  		<ul  class="nav nav-pills">
			<li class="<?php echo ($tab == 'tab1') ? 'active' : ''; ?>">
				<a href="#1a" data-toggle="tab"><?php echo lang('Sales_agent'); ?></a>
			</li>
			<!--<li class="<?php echo ($tab == 'tab2') ? 'active' : ''; ?>">
				<a href="#2a" data-toggle="tab"><?php echo lang('Excutive'); ?></a>
			</li>-->
		</ul>
         <div class="row">
		 	<div class="col-md-12">
				<div class="btn-group pull-right">
					<!-- <a class="btn btn-success" href="<?php echo site_url('admin/Crm/Crm/ClientForm'); ?>"><i class="fa fa-plus"></i> Add </a> -->
				</div>
			</div>
		 </div>
		 <div class="success"></div>
		 <div class="tab-content clearfix">
		 <!--  Conform Booking Start-->
		  <div class="row tab-pane active" id="1a">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title"> <?php echo $page_title; ?> </h3>
                </div><!-- /.box-header -->
                <div class="box-body">
					<table class="table table-striped" id="example1">
					   <thead >
						<tr>
							<th><?php echo lang('sno'); ?></th>
							<th><?php echo lang('Agent_Name'); ?></th>
							<th><?php echo lang('Sale_commission_amt'); ?></th>
							<th><?php echo lang('Sale_commission_paid'); ?></th>
							<th><?php echo lang('Sale_commission_balance'); ?></th>	
							<th><?php echo lang('Sale_commission_Percentage'); ?></th>
							<th><?php echo lang('Sale_commission_Status'); ?></th>
							<th><?php echo lang('action'); ?></th>
						 </tr>
					   </thead>
						<tbody >
						<?php if($SalesCommssion):?>		
						<?php $i=1;foreach ($SalesCommssion as $commission):?>
						<tr>
				<td><?php echo  $i; ?></td>
				<td><?php echo  $commission->name; ?></td>
			    <td><?php echo $this->sma->formatMoney($commission->commissionamt)  ;   ?> </td>
				<td><?php echo $this->sma->formatMoney($commission->paid)  ; ?></td>
				<td><?php echo $this->sma->formatMoney($commission->pending)  ;?></td>
				<td><?php echo $commission->sales_commission  ;  ?></td>
				<td><?php echo  ($commission->pending >=0)? '<p class="btn-warning" style="text-align:center;">Pending</p>' :'<p style="text-align:center; class="btn-success">Paid</p>'; ?></td>
				<td>
				<!--<div class="dropdown text-left">
				<button type="button" class="btn btn-default btn-xs btn-primary dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:#fff;"><?php echo lang('action'); ?> <span class="caret"></span></button>
                 <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenuButton">
					<li><a href="#" data-toggle="modal"  data-id="<?php echo $commission->agentid;  ?>" data-type="<?php echo $commission->SalesPersontype;  ?>"  onclick="viewpayment(<?php echo $commission->agentid;  ?>,'<?php echo $commission->SalesPersontype;  ?>')"><i class="fa fa-money"></i>&nbsp;&nbsp; <?php echo lang('View_payment'); ?> </a></li>
					<li><a href="#" data-id="<?php echo $commission->agentid;  ?>" data-type="<?php echo $commission->SalesPersontype;  ?>" data-toggle="modal" data-target="#addpayment" class="addpayment"><i class="fa fa-money"></i>&nbsp;&nbsp; <?php echo lang('Add_payment'); ?> </a></li> 
				</ul>   
           </div> -->
		   <label class="dropdown">
			  <div class="dd-button">
			   <?php echo lang('action'); ?> 
			  </div>

			  <input type="checkbox" class="dd-input" id="test">

			  <ul class="dd-menu">
				<li><a href="#" data-toggle="modal"  data-id="<?php echo $commission->agentid;  ?>" data-type="<?php echo $commission->SalesPersontype;  ?>"  onclick="viewpayment(<?php echo $commission->agentid;  ?>,'<?php echo $commission->SalesPersontype;  ?>')"><i class="fa fa-money"></i><?php echo lang('View_payment'); ?> </a></li>
				<li><a href="#" data-id="<?php echo $commission->agentid;  ?>" data-type="<?php echo $commission->SalesPersontype;  ?>" data-toggle="modal" data-target="#addpayment" class="addpayment"><i class="fa fa-money"></i><?php echo lang('Add_payment'); ?> </a></li>
			  </ul>
			  
			</label>
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
         <!--   <button type="button" class="btn btn-xs btn-default no-print pull-right" style="margin-right:15px;" onclick="window.print();">
                <i class="fa fa-print"></i> Print            </button>-->
            <h4 class="modal-title" id="myModalLabel"><?php echo lang('View_payment'); ?> </h4>
      </div>
      <div class="modal-body">
	  <form >
            <div class="table-responsive">
                <table id="CompTable" cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover table-striped">
                    <thead>
                    <tr>
					<th style="width:30%;"><?php echo lang('no'); ?></th>
					  <th style="width:15%;"><?php echo lang('amount'); ?></th>
                        <th style="width:30%;"><?php echo lang('date'); ?></th>
                        <th style="width:15%;"><?php echo lang('Note'); ?></th>
                        <th style="width:10%;"><?php echo lang('Action'); ?></th>
                    </tr>
                    </thead>
                    <tbody id="viewpayment">
                    </tbody>
                </table>
            </div>
        </div>
		</form>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('close'); ?></button>
      </div>
    </div>
  </div>
</div>

		<div class="modal" id="addpayment">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <div class="modal-header">
       <h4 class="modal-title" id="myModalLabel"><?php echo lang('Add_payment')?></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <div class="modal-body">
	        <form id="addcommissionpayment">
                <div class="modal-body">
                    <p><?php echo lang('please_fill')?></p>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group ">
                                <label for="date"><?php echo lang('date')?> </label>
                                <input type="text" name="date"  id="paymentdate" class="form-control datepicker"  required="required" ><i class="form-control-feedback"></i>
                                <small class="help-block" data-bv-validator="notEmpty" data-bv-for="date" data-bv-result="NOT_VALIDATED" style="display: none;"><?php echo lang('Ple_enter')?></small></div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                 <label for="amount_1"><?php echo lang('Amount')?></label>
                                <input name="amount-paid" type="text" id="amount_1"  class="pa form-control kb-pad amount" required="required" data-bv-field="amount-paid"><i class="form-control-feedback" data-bv-icon-for="amount-paid" style="display: none;"></i>
                            </div>
                        </div>
                    </div>
                                <div class="clearfix"></div>
	                       <div class="row">
                          <div class="col-sm-12">
                            <div class="form-group has-feedback">
                                <label for="date"><?php echo lang('Note'); ?> *</label><br>
								<textarea class="form-control" id="paymentnote" name="note">  </textarea>
                                </div>
                        </div>
                    </div>
	      </div>
         </div>
		 	  <input type="hidden"  id="agentid" name="agentid">
	         <input type="hidden"  id="type" name="type">
		 </form>
      <div class="modal-footer">
	   <input type="submit"  data-dismiss="modal" onclick="addcommission()"  id="paymentbutton" class="btn btn-primary">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo lang('close'); ?></button>
      </div>
    </div>
  </div>
</div>
</div></div>





<div id="receipt" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>

<div class="modal-body print">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-2x">×</i></button>
                            <!--<div class="text-center" style="margin-bottom:20px;">-->
                <img src="http://localhost/sramrms/assets/uploads/logos/Logo_Lesso_Cambodia_-.jpg" alt="OUN BUNRATANAK (Lesso Cambodia)">
                <!--</div>-->
                        <div class="clearfix"></div>
            <div class="row padding10">
                <div class="col-xs-5">
                    To:<br>
                    <h2 class="">Walk in Customer</h2>
                                        Cambodia<br>Phnom Penh  <br><p></p>Tel: *<br>Email: customer@mail.com
                </div>
                <div class="col-xs-5">
                    From:<br>
                    <h2 class="">OUN BUNRATANAK (Lesso Cambodia)</h2>
                                        #65B,St.271,S/K Psa Demtkov Khan Chomka mon, Phnom Penh,Cambodia<br>Phnom Penh  Phnom Penh<br><p></p>Tel: +85586666357<br>Email: atey@gmail.com                    <div class="clearfix"></div>
                </div>

            </div>
            <hr>
            <div class="row">
                <div class="col-sm-12">
                    <p style="font-weight:bold;">Date: 03/05/2019</p>
                    <p style="font-weight:bold;">Sale Reference: 0</p>
                    <p style="font-weight:bold;">Payment Reference: 0</p>
                </div>
            </div>
            <div class="well">
                <table class="table table-borderless" style="margin-bottom:0;">
                    <tbody>
                    <tr>
                        <td>
                            <strong>Payment Received</strong>
                        </td>
                        <td class="text-right">
                            <strong class="text-right">$107.86</strong>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Paid by</strong></td>
                        <td class="text-right"><strong class="text-right">Cash</strong></td>
                    </tr>
                                                            <tr>
                        <td colspan="2"></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div style="clear: both;"></div>
            <div class="row">
                <div class="col-sm-4 pull-left">
                    <p>&nbsp;</p>

                    <p>&nbsp;</p>

                    <p>&nbsp;</p>

                    <p style="border-bottom: 1px solid #666;">&nbsp;</p>

                    <p>Stamp &amp; Signature</p>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
 </div>
 </div>
 </div>
 </div>


 
<script src="<?php echo base_url('assets/admin/plugins/datatables/jquery.dataTables.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/plugins/datatables/dataTables.bootstrap.js')?>" type="text/javascript"></script>
<script type="text/javascript">
$(function() {
	$('#example1').dataTable({
		"paging":   false,
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
$('.addpayment').click(function(){
	$("#agentid").val($(this).data('id'));
	$("#type").val($(this).data('type'));
})
</script>