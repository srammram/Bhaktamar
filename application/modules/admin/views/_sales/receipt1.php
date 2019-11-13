<style>
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
		border: 1px solid #FFB6C1;
         background-color: #FFB6C1 !important;
        -webkit-print-color-adjust: exact; 
    }
	
}


 @page 
    {
        size:  auto;   /* auto is the initial value */
        margin: 0mm;  /* this affects the margin in the printer settings */
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
							<td><p>អាសយដ្ឋាន : ភូមិថ្មី សង្កាត់ដង្កោ ខណ្ឌដង្កោ រាជធានីភ្នំពេញ<br>
							 <p></td>
							<td><strong style="font-size:15px;">Tel: 069 555 659 / 099 555 659 / 090 555 659</strong></td>
						</tr>
						<tr><td>Address: Phum Thmey Sangkat Dongkor Khan Dongkor Phnom Penh.</td><td>Email: borey.kheangheng@yahoo.com </td></tr>
					</tbody>
				</table>
				<br>
				<br>
				<h4 class="text-center" style="margin-bottom:1px;">បង្កាន់ដៃទទួលប្រាក់</h4> 
				<h3 class="text-center" style="margin-top:1px;"><?php echo lang('Payment_receipt'); ?></h3> 
					 <table class="table table-bordered net_salary_tab border-bottom-0" >
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
							<p>
							
							ឈ្មោះ / Name:  <?php  if(isset($invoice->customer_name)){ echo  $invoice->customer_name    ; }  ?>  <br>
							ទូរស័ព្ទលេខ/Telephone:  <?php  if(isset($invoice->contact_number)){ echo  $invoice->contact_number    ; }  ?> <br>
							អាសយដ្ឋាន/Address: <?php  if(isset($invoice->customeraddress)){ echo  $invoice->customeraddress    ; }  ?> <br></p>
							</td>
							<td><p>
							<small style="background-color:#FFB6C1;">លេខរៀង / Receipt No: <?php  if(isset($invoice->receiptid)){ echo  $invoice->receiptid    ; }  ?> </small>  <br>
							<small style="background-color:#FFB6C1;">កាលបរិច្ឆេទ / Date&nbsp;&nbsp;&nbsp;&nbsp;   :  <?php  if(isset($date)){ echo  $date    ; }  ?>  </small>  <br>
							<div >ប្រាក់សុទ្ឋ / Cash   : &nbsp;<div class="foo blue"  ></div></div>
							<div>មូលប្បទានប័ត្រ / Cheque:&nbsp;<div class="foo blue"  > </div>&nbsp;&nbsp;
							ផ្សេងៗ / Others : &nbsp;<div class="foo blue"  > <br>
					</p></td>
						</tr>
					</tbody>
				</table>
				 <table class="table table-bordered net_salary_tab">
					<colgroup>
						<col width="50%">
						
						<col width="25%">
						<col width="25%">
					</colgroup>
					<tr style="background-color:#FFB6C1;" class="vendorListHeading" >
					<th>បរិយាយ / Description</th>
					
					<th>លេខកិច្ចសន្យា / Contract No</th>
					<th>តម្លៃ / Amount(USD)</th>
					</tr>
					<tbody>
						<tr>
							<td  ><p>ប្រភេទផ្ទះ / House Type  : <?php  if(isset($invoice->UnitType)){ echo  $invoice->UnitType    ; }  ?> <br>
							លេខផ្ទះ / House No      : <?php  if(isset($invoice->house_no)){ echo  $invoice->house_no    ; }  ?> <br>
							លេខផ្លូវ / Street No        : <?php  if(isset($invoice->houseaddress)){ echo  $invoice->houseaddress    ; }  ?>  <br></p></td>
							<td><?php  if(isset($invoice->ref_no)){ echo  $invoice->ref_no    ; }  ?></td>
							<td><strong><?php  if(isset($currency->currrency_symbol)){ echo  $currency->currrency_symbol    ; }  ?><?php  if(isset($amount)){ echo  $amount    ; }  ?></strong></td>
						</tr>
					</tbody>
				</table>
                <table class="table table-bordered ">
					<colgroup>
						<col width="50%">
						<col width="25%">
						<col width="25%">
					</colgroup>
					<tbody>
						<tr >
							<td ><p>សូមអរគុណ / Thank you</p></td>
							<td style="background-color:#FFB6C1;" class="bckcolors"><strong>ទទួលសរុប​ / Total Receive</strong></td>
							<td><strong><?php  if(isset($currency->currrency_symbol)){ echo  $currency->currrency_symbol    ; }  ?><?php  if(isset($amount)){ echo  $amount    ; }  ?></strong></td>
						</tr>
					</tbody>
				</table>
				
				
				<table class="table " style="border: none;">
					<colgroup>
						<col width="50%">
						<col width="50%">
						
					</colgroup>
					<tbody>
						
						<tr style="border: none;">
							<td class="nones" align="center"><p> ស្នាមមេដៃ និងឈ្មោះអ្នកតំណាង <br>Authorized Signature</p>
						<p>-------------------</p></td>
							
							<td class="nones"  align="center"><p>ស្នាមមេដៃ និងឈ្មោះអ្នកទិញ</br>Customer's Signature</p>
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