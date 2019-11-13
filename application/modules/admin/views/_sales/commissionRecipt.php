<?php 
	/* echo '<pre>';
	print_r($result);
	die; */
?>
<style>
.se_f_df .table tbody tr td{border: none;}
	.report_se{background-color: #fff;}
	.report_se .form-control{border: none;box-shadow: none;margin-top: 0px;}
	.report_se .form_control{border: none;box-shadow: none;margin-top: 0px;border-bottom: 1px solid #ccc;}
	.main_ta_l tbody tr td{border: none;}
	.main_ta_l tbody tr td .table tbody tr td{border: 1px solid #ccc;padding: 2px}
	.hidden-print{margin-right: 15px;}
	.h3-font-size{font-size:24px;}
	.font-bold{font-weight:bold;}
	.view_booking{padding:0px;width:98%;}
	.invoice-container{width:100%}

	.view_booking .brown p,.view_booking .brown div,
	.view_booking .brown h4,.view_booking .brown h5,.view_booking .brown h6,.view_booking .brown b,.view_booking .brown span,
	.view_booking .brown h1
	,.view_booking .brown td,.view_booking .brown td input{color:#7b4f26 !important;}
	.main-footer{display:none;}
	@media print {
      .view_booking .brown {
        color: #7b4f26;
      }
	}
	.address-email{    padding-left: 4px;
padding-top: 6px;}
.phone{padding: 17px;font-weight:bold}
.address-container{   
    background-color: #ffcc66 !important;
    
padding-left: 14px;}
.address-container h5{margin:0px;    padding: 2px;}
@media print {
   div.address-container{
        background-color: #ffcc66 !important;
        -webkit-print-color-adjust: exact; 
    }
	.table td.bg-yellow{background-color: #ffcc66 !important;-webkit-print-color-adjust: exact; }
}
.invoice-title{font-size:20px;text-align:center}
.address{    margin-bottom: 5px;}
.view_booking {margin:0px;}
.padding-zero{padding:0px;}

.table td.bg-yellow{   text-align:left; padding-left: 4px !important;background-color: #ffcc66 !important;    border: 4px solid #fff !important;}
.table td{padding:0px !important;border:1px solid #fff !important}
.table td input{padding:0px !important;border:2px solid #000 !important}
.table{margin-bottom:0px;}
	.invoice_ta tbody tr td{border: none!important;}
	.invoice_head{background-color: #fff;}
	.well .table tbody tr td{padding: 10px!important;}
</style>
	<section class="invoice_head">
		<div class="row" style="padding: 15px 30px;">
			<div class="col-sm-12">
				<button class="btn btn-primary hidden-print pull-right" onclick="myFunction()"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Print</button>
			</div>
			<div class="col-sm-12 col-xs-12">
				<img src="<?php echo base_url('assets/admin')?>/dist/img/khlogo.png" alt="kh logo" style="margin-bottom: 25px;">				
			</div>
			<div class="row">
			<table class="table invoice_ta">
				<tbody>
					<tr>
						<td>
							<div class="col-sm-12">
							
								<p>To</p>
								<p><b><?php  if(isset($details->name)){ echo $details->name  ;  }  ?></b></p>
								<p><?php  if(isset($details->address)){ echo $details->address  ;   } ?></p>
								
								<p>Tel:<a href="tel:">* <?php  if(isset($details->mobile)){ echo $details->mobile  ;   } ?></a></p>
								<p>Email:<a href="mailto:"><?php  if(isset($details->email)){ echo $details->email  ;   } ?></a></p>
							</div>
						</td>
						<td>
							<div class="col-sm-12">
								<p>From</p>
								<p><b><?php if(isset($settings->name)){  echo $settings->name ;  }  ?></b></p>
								<p><?php if(isset($settings->address)){  echo $settings->address   ;  }  ?></p>
								
								<p>Tel:<a href="tel:"><?php if(isset($settings->phone)){  echo $settings->phone ; }  ?></a></p>
								<p>Email:<a href="mailto:"><?php if(isset($settings->email)){  echo $settings->email ;  }  ?></a></p>
							</div>
						</td>
					</tr>
					<tr>
						<td colspan="2"><hr></td>
					</tr>
					<tr>
						<td colspan="2">
							<div class="col-sm-12" style="margin-top: 15px;">
								<p><b>Date : <?php  if(isset($details->paid_date)){ echo date('Y-m-d',strtotime($details->paid_date))  ;   } ?></b></p>
								<p><b>Sales Commission Percentage : <?php  if(isset($details->sales_commission)){ echo $details->sales_commission  ;  }  ?>%</b></p>
								<p><b>payment Reference : 0</b></p>
							</div>
						</td>
					</tr>
					<tr>
						<td colspan="2">
						<div class="col-sm-12">
							<div class="col-sm-12 well">
								<table class="table" style="background-color: transparent;">
									<tbody>
										<tr>
											<td>Payment Paid</td>
											<td class="text-right"><?php 

echo $this->sma->formatMoney($details->commission_paid)  ;
 ?></td>
										</tr>
										<tr>
											<td>Note</td>
											<td class="text-right"><?php  if(isset($details->note)){ echo $details->note  ;   } ?></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						</td>
					</tr>
				</tbody>
			</table>
			
	</section>
	<script>
function myFunction() {
	
    window.print();
}
</script>

	
		
		
		

