<style>
@font-face { font-family: khmer_os_muol_lights1; src: url('<?=base_url()?>assets/fonts/khmer_font/KhmerOSmuollight_1.ttf');}
@font-face { font-family: bottambang; src: url('<?=base_url()?>assets/fonts/khmer_font/KhmerOSbattambang_1.ttf');}
@font-face { font-family: khmer_os_Content_1; font-weight: bold; src: url('<?=base_url()?>assets/fonts/khmer_font/KhmerOScontent_1.ttf');}

.table_cont,.table_cont5{font-size:11px;font-family: 'khmer_os_Content_1';}
.table_cont6{width:50%;}

.foo {
 
  width: 18px;
  height: 18px;
 display: inline-block; 
  border: 1px solid rgba(0, 0, 0, .2);
}

.table > tbody > tr > .no-line {
    border-top: none;
}

.table > thead > tr > .no-line {
    border-bottom: none;
}

.table > tbody > tr > .thick-line {
    border-top: 2px solid;
}
.table{
	margin-bottom:0px;
}

@media print {
    .vendorListHeading th {
		border: 1px solid #FFB6C1;
         background-color: #FFB6C1 !important;
        -webkit-print-color-adjust: exact; 
    }
	
}
@media print {
   small {
		
         background-color: #FFB6C1 !important;
        -webkit-print-color-adjust: exact; 
    }
	
}

 @page    {
        size:  auto;   /* auto is the initial value */
        margin: 0mm;  /* this affects the margin in the printer settings */
    }

.form-group {
  display: inline-block;
  margin-bottom: 0px;
}

.form-group input {
  padding: 0;
  height: initial;
  width: initial;
  margin-bottom: 0;
  display: none;
  cursor: pointer;
}

.form-group label {
  position: relative;
  cursor: pointer;
}

.form-group label:before {
  content:'';
  -webkit-appearance: none;
  background-color: transparent;
  border: 2px solid #ea764c;
  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05), inset 0px -15px 10px -12px rgba(0, 0, 0, 0.05);
  padding: 5px;
  display: inline-block;
  position: relative;
  vertical-align: middle;
  cursor: pointer;
  margin-right: 0px;
}

.form-group input:checked + label:after {
    content: '';
    display: block;
    position: absolute;
    top:2px;
    left:6px;
    width: 4px;
    height: 8px;
    border: solid #7a5026;
    border-width: 0 2px 2px 0;
    transform: rotate(45deg);
}
.table_cont5{table-layout:fixed;}
.table_cont5 tbody tr td,.table_con_check tbody tr td{border:none!important;}
/*.table_cont5 tbody tr td:last-child{text-align:center;}*/
.table_cont6 tbody tr td:last-child{text-align:left;}
.table_wid{width:70%;}
@media print {
   .main-footer {
		display:none;
        -webkit-print-color-adjust: exact; 
    }
	.table_cont6{width:70%;}
	.table_wid{width:100%;}
}
</style>

<section class="content" style="background-color:#fff;">
	<div class="row" >
		<div class="col-sm-12"><button id="print_btn" onclick="printpage();" class="btn btn-success btn-sm pull-right print_btn">Print out</button>	</div>
	</div>
	<div class="row">
			<div class="col-sm-12 col-xs-12">
				<img src="<?php echo base_url('assets/admin')?>/dist/img/khlogo.png" alt="kh logo">
				<table class=" " border="0" >
					<colgroup>
						<col width="60%">
						<col width="40%">
					</colgroup>
					
					<tbody>
						<tr>
							<td><p style="margin-bottom:1px;font-family:bottambang;font-size:11px;">អាសយដ្ឋាន : ភូមិថ្មី សង្កាត់ដង្កោ ខណ្ឌដង្កោ រាជធានីភ្នំពេញ<br>
							 <p></td>
							<td><strong style="font-size:15px;">Tel: 069 555 659 / 099 555 659 / 090 555 659</strong></td>
						</tr>
						<tr><td>Address: Phum Thmey Sangkat Dongkor Khan Dongkor Phnom Penh.</td><td>Email: borey.kheangheng@yahoo.com </td></tr>
					</tbody>
				</table>
				<br>
				<br>
				<h4 class="text-center" style="margin-bottom:1px;font-family:khmer_os_muol_lights1;font-size:12px;font-weight:normal;">បង្កាន់ដៃទទួលប្រាក់</h4> 
				<h3 class="text-center" style="margin-top:1px;"><?php echo lang('Payment_receipt'); ?></h3> 
					 <table class="table table-bordered net_salary_tab border-bottom-0 table_cont" >
					<colgroup>
						<col width="50%">
						<col width="50%">
					</colgroup>
					<tr class="vendorListHeading" style="background-color:#FFB6C1;">
					<th>ពត៌មានអតិថិជន / Client info
                     </th>
					<th>ទទួលបាន / Payment Received in:</th>
					</tr>
					<tbody>
						<tr>
							<td>
								<table class="table table_cont5 table_wid">
									<colgroup>
										<col width="35%">
										<col width="65%">
									</colgroup>
									<tbody>
										<tr>
										<td>ឈ្មោះ / Name: </td>
										<td>
											<span>
												<?php  if(isset($invoice->displayname1) && $invoice->displayname1==1){ echo  $invoice->customer_name    ; }   ?>
												
												
												<?php  if(isset($invoice->dislayname2) && $invoice->dislayname2==1){ echo  '/'.$invoice->customername2    ; }  ?>
											</span>
										</td>
										
										</tr>
										<tr>
											<td>ទូរស័ព្ទលេខ/Telephone:</td>
											<td><span> &nbsp;<?php  if(isset($invoice->contact_number)){ echo  $invoice->contact_number    ; }  ?></span>
											</td>
										</tr>
										<tr>
											<td>អាសយដ្ឋាន/Address:</td>
											<td>
												<span><?php  if(isset($invoice->customeraddress)){ echo  $invoice->customeraddress    ; }  ?> </span>
											</td>
										</tr>
									</tbody>
								</table>
							
							</td>
							<td>
							<table class="table table_cont5 table_cont6">
								<tbody>
									<tr>
										<td><span style="background-color:#FFB6C1;">លេខរៀង / Receipt No:</span></td>
										<td><span> <?php  if(isset($invoice->receiptid)){ echo  $invoice->receiptid    ; }  ?> </span></td>
									</tr>
									<tr>
										<td><span style="background-color:#FFB6C1;">កាលបរិច្ឆេទ / Date&nbsp;&nbsp;&nbsp;&nbsp;   : </span></td>
										<td><span ><?php  if(isset($date)){ echo  date('d/m/Y',strtotime($date))    ; }  ?>  </span></td>
									</tr>
									
								</tbody>
							</table>
							<table class="table table_cont table_con_check">
								<tbody>
									<tr>
										<td>
											<div >ប្រាក់សុទ្ឋ / Cash   : 
												<div class="form-group">
												  <input type="checkbox" id="checkbox1">
												  <label for="checkbox1"></label>
												</div>
											
											មូលប្បទានប័ត្រ / Cheque:
												<div class="form-group">
												  <input type="checkbox" id="checkbox2">
												  <label for="checkbox2"></label>
												</div>
											
											ផ្សេងៗ / Others :
												<div class="form-group">
												  <input type="checkbox" id="checkbox3">
												  <label for="checkbox3"></label>
												</div>
											</div>
										</td>
									</tr>
								</tbody>
							</table>
							
						</td>
						</tr>
					</tbody>
				</table>
				 <table class="table table-bordered net_salary_tab table_cont">
					<colgroup>
						<col width="50%">
						<col width="25%">
						<col width="25%">
					</colgroup>
					<tr style="background-color:#FFB6C1;" class="vendorListHeading" >
					<th style="text-align:center;">បរិយាយ / Description</th>
					<th style="text-align:center;">លេខកិច្ចសន្យា / Contract No</th>
					<th style="text-align:center;">តម្លៃ / Amount(USD)</th>
					</tr>
					<tbody>
						<tr>
							<td >
								<table class="table table_cont5 table_wid">
									<colgroup>
										<col width="35%">
										<col width="65%">
									</colgroup>
									<tbody>
										<tr>
											<td>ប្រភេទផ្ទះ / House Type  :</td>
											<td><span> <?php  if(isset($invoice->UnitType)){ echo  $invoice->UnitType    ; }  ?></span></td>
										</tr>
										<tr>
											<td>លេខផ្ទះ / House No : </td>
											<td><span> <?php  if(isset($invoice->unit_no)){ echo  $invoice->unit_no    ; }  ?> </span></td>
										</tr>
										<tr>
											<td>លេខផ្លូវ / Street No :</td>
											<td><span> <?php  if(isset($invoice->houseaddress)){ echo  $invoice->houseaddress    ; }  ?> </span></td>
										</tr>
									</tbody>
								</table>
							
							</td>
							<td class="text-center"><span><?php  if(isset($invoice->contractNumber)){ echo  $invoice->contractNumber    ; }  ?></span></td>
						
							<td class="text-center"><strong><span style="font-size:12px;"><?php 
echo $this->sma->formatMoney($amount)  ;

							?></span></strong></td>
						</tr>
					</tbody>
				</table>
                <table class="table table-bordered table_cont">
					<colgroup>
						<col width="50%">
						<col width="25%">
						<col width="25%">
					</colgroup>
					<tbody>
						<tr >
							<td ><p>សូមអរគុណ / Thank you</p></td>
							<td style="background-color:#FFB6C1;text-align:center;" class="bckcolors" ><strong>ទទួលសរុប​ / Total Receive</strong></td>
							<td class="text-center"><strong ><?php echo $this->sma->formatMoney($amount)  ;  ?></strong></td>
						</tr>
					</tbody>
				</table>
				
				
				<table class="table table_cont" style="border: none;">
					<colgroup>
						<col width="50%">
						<col width="50%">
						
					</colgroup>
					<tbody>
						
						<tr style="border: none;">
							<td class="nones" align="center"><p> ស្នាមមេដៃ និងឈ្មោះអ្នកតំណាង <br>Authorized Signature</p>
							<br>
							<br>
							<br>
						<p>-------------------</p></td>
							
							<td class="nones"  align="center"><p>ស្នាមមេដៃ និងឈ្មោះអ្នកទិញ</br>Customer's Signature</p>
							<br>
							<br>
							<br>
								<p>-------------------</p></td>
							
						</tr>
					</tbody>
				</table>
				
				
				
					<div class="col-sm-6 text-center">
						
					</div>
				</div>
			</div>
		</div>
		
</section>
<script>
 function printpage() {
        //Get the print button and put it into a variable
        var printButton = document.getElementById("print_btn");
        //Set the print button visibility to 'hidden' 
        printButton.style.visibility = 'hidden';
        //Print the page content
        window.print()
        printButton.style.visibility = 'visible';
    }

</script>