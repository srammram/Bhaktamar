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


</style>
	<section class="col-sm-12 view_booking report_se">
		<div class="invoice-container row">
		<div class="col-sm-12">
				<button class="btn btn-primary hidden-print pull-right" onclick="myFunction()"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Print</button>
			</div>
			<div class="col-sm-12 col-xs-12 padding-zero">
				<img src="<?php echo base_url('assets/admin')?>/dist/img/khlogo.png" alt="kh logo">				
			</div>
			<div class="col-sm-12 col-xs-12 address-container">
				<div class="col-sm-6 col-xs-6 address-email">
					<h4 class="address"><span class="font-bold">Address:</span>  ភូមថ្ិ ីមសង្កាតដ់ ង្ង្កា ខណ្ឌដង្ង្កា រាជធានីភង្នំេញ
</h4>
					<h4><span class="font-bold">Email:</span> borey.kheangheng@yahoo.com</h4>
				</div>
				<div class="col-sm-6 col-xs-6 phone">
				<h4><span class="font-bold">Phone:</span> <span class="font-bold"> 069 555 659 / 099 555 659 / 090 555 659</span></h4>
				</div>
			</div>
			<div class="col-sm-12 col-xs-12 invoice-title font-bold">INVOICE</div>
			<div class="col-sm-12 col-xs-12 invoice-details font-bold">
				<div class="col-sm-4 col-xs-4 invoice-details font-bold">
				</div>
				<div class="col-sm-8 col-xs-8 invoice-details font-bold">
					<div class="row col-sm-4 col-xs-4 invoice-details font-bold">
						<table style="width:85%;" class="table text-center font-bold">
							<colgroup>
								<col width="15%">
								<col width="15%">
								
							</colgroup>
							<tbody>
								<tr>
									<td class="bg-yellow"><span>Invoice Nº</span></td>
									<td style="position: absolute;"><input type="text"></td>								
								</tr>
								<tr>
									<td class="bg-yellow"><span>Invoice Date</span></td>
									<td style="position: absolute;"><input type="text"></td>								
								</tr>
								<tr>
									<td class="bg-yellow"><span>Sale Person</span></td>
									<td style="position: absolute;"><input type="text"></td>								
								</tr>
							</tbody>
						</table>
					</div>
					<div class="row">
						<table  class="table text-center font-bold">
							<colgroup>
									<col width="45%">
									<col width="45%">
									<col width="45%">
								</colgroup>
							<tbody>
							<tr>
								<td style="float:left;">Address</td>
								<td rowspan=3 colspan=2><input type="text"></td>
								</tr>
							</tbody>
							</table>
					</div>
				</div>				
			</div>
				
			</div>
		</div>
	</section>
	<script>
function myFunction() {
	
    window.print();
}
</script>

	
		
		
		

