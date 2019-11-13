<style>
<style>
@font-face { font-family: khmer_os_muol_lights1; src: url('<?=base_url()?>assets/fonts/khmer_font/KhmerOSmuollight_1.ttf');}
@font-face { font-family: khmer_os_muol_light; src: url('<?=base_url()?>assets/fonts/khmer_font/KhmerOSmuollight_1.ttf');}
@font-face { font-family: bottambang; src: url('<?=base_url()?>assets/fonts/khmer_font/KhmerOSbattambang_1.ttf');}
@font-face { font-family: khmer_os_Content_1; font-weight: bold; src: url('<?=base_url()?>assets/fonts/khmer_font/KhmerOScontent_1.ttf');}
@font-face { font-family: khmer_os_muol_light; src: url('<?=base_url()?>assets/fonts/khmer_font/KhmerOSmuollight_1.ttf');}



@font-face {
    font-family: 'Khmer OS Muol';
    src: url('<?=base_url()?>assets/fonts/khmer/khmer_os_light/KhmerOSMuolLight.woff2') format('woff2'),
        url('<?=base_url()?>assets/fonts/khmer/khmer_os_light/KhmerOSMuolLight.woff') format('woff');
    font-weight: 300;
    font-style: italic;
}

@font-face {
    font-family: 'Calibri';
    src: url('<?=base_url()?>assets/fonts/khmer/calibri/Calibri-Bold.woff2') format('woff2'),
        url('<?=base_url()?>assets/fonts/khmer/calibri/Calibri-Bold.woff') format('woff');
    font-weight: bold;
    font-style: normal;
}


.table_cont{font-size:11px;font-family: 'khmer_os_Content_1';}
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
		
        -webkit-print-color-adjust: exact; 
    }
	
}
@media print {
   .main-footer {
		display:none;
        -webkit-print-color-adjust: exact; 
    }
	
}
@media print {
   .resd {
		color:red;
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
			
				<p class="text-center" style="margin-bottom:1px;font-family:khmer_os_muol_light;font-size:20px;font-weight:bold;">វិក័យប័ត្រទទួលប្រាក់​(កក់បិទទីតាំង)</p> 
				<h3 class="text-center" style="margin-top:1px;font-family:Calibri;font-size:18px;">CASH RECEIPT</h3> <br>
				<p ><small style="font-family:khmer_os_Content_1;font-size:18px;font-weight:bold;"> បានទទួលពីឈ្មោះ /</small> <small style="font-size:18px;">Received from  :  </small>
				<small style="font-size:18px;">
				<?php  if(isset($receipt->displayname1) && $receipt->displayname1==1){ echo  $receipt->customer_name    ; }   ?>
				
				
				<?php  if(isset($receipt->dislayname2) && $receipt->dislayname2==1){ echo  '/'.$receipt->customername2    ; }  ?>
				</small>
				
				</span><span class="pull-right" style="margin-right:120px;font-family:khmer_os_Content_1;">កាលបរិច្ឆេទ/Date:   <?php  if(isset($receipt->initialamount_date)){ echo  date('d/m/Y',strtotime($receipt->initialamount_date))    ; }  ?></span></p>
				<p style="font-family:khmer_os_Content_1;font-size:18px;">ចំនួនទឹកប្រាក់ / Amount:   <small style="color:red;font-weight:bold;font-size:18px;"><?php
echo $this->sma->formatMoney($receipt->initial_amount) ;
  ?> </small><?php   if(isset($word)){ echo '('.$word.')'; }  ?></p>
				<br>
				 <table class="table table-bordered net_salary_tab table_cont">
					<colgroup>
						<col width="25%">
						<col width="25%">
						<col width="25%">
						<col width="25%">
					</colgroup>
					<tr  style="font-weight:100;font-size:16px; " >
					<th style="font-weight:100;text-align: center;vertical-align: middle;color:black;">ប្រភេទផ្ទះ / House Type</th>
					<th style="font-weight:100;text-align: center;vertical-align: middle;color:black;">ផ្ទះលេខ / House No</th>
					<th style="font-weight:100;text-align: center;vertical-align: middle;color:black;">ផ្លូវលេខ / Street No</th>
					<th style="font-weight:100;text-align: center;vertical-align: middle;color:black;">តម្លៃ​ ផ្ទះ/ House Price</th>
					</tr>
					<tbody>
						<tr style="font-size:16px;font-weight:100" >
							<td  style=" text-align: center;vertical-align: middle;"><?php  if(isset($receipt->UnitType)){ echo  $receipt->UnitType    ; }  ?></td>
							<td style=" text-align: center;vertical-align: middle;"><?php  if(isset($receipt->unit_no)){ echo  $receipt->unit_no   ; }  ?></td>
							<td style=" text-align: center;vertical-align: middle;"><?php  if(isset($receipt->address)){ echo  $receipt->address    ; }  ?></td>
							<td style=" text-align: center;vertical-align: middle;"><?php
									echo $this->sma->formatMoney($receipt->unitPrice) ;
							  ?></td>
						</tr>
					</tbody>
				</table><br>
                <p  class="resd" style="color:red;font-size:16px;font-family:khmer_os_Content_1;">បញ្ជាក់ ៖ ប្រាក់កក់បិទទីតាំង មានសុពលភាព មួយថ្ងៃ <br>
						Notice :  Deadline Only One day</p>
						<br>
				<table class="table " style="border: none;">
					<colgroup>
						<col width="50%">
						<col width="50%">
						
					</colgroup>
					<tbody>
						
						<tr style="border: none; font-size:16px;">
							<td class="nones" align="center"><p style="font-family:khmer_os_Content_1;"> ស្នាមមេដៃ និងឈ្មោះអ្នកតំណាង  / Receiver's Signature</p>
							<br>
							<br>
							<br>
							<br>
							<br>
						<p>-------------------</p></td>
							
							<td class="nones"  align="center"><p style="font-family:khmer_os_Content_1;">ស្នាមមេដៃ និងឈ្មោះអ្នកទិញ / Customer's Signature</p>
							<br>
							<br>
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