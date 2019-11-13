<style>


.table > tbody > tr > .no-line {
    border-top: none;
}

.table > thead > tr > .no-line {
    border-bottom: none;
}
h5{
	margin:0px;
	padding:4px;
}

.table > tbody > tr > .thick-line {
    border-top: 2px solid;
}
.table{
	margin-bottom:0px;
}

@media print {
    .vendorListHeading th {
		border: 1px solid #FFFFCC;
         background-color: #FFFFCC !important;
        -webkit-print-color-adjust: exact; 
    }
	
}
@media print {
    .emitable th {
		border: 1px solid #E5FFCC;
         background-color: #E5FFCC !important;
        -webkit-print-color-adjust: exact; 
    }
	
}



@media print {
   .housedetails{
		border: 1px solid #FFFFCC;
		padding:8px;
         background-color: #FFFFCC !important;
        -webkit-print-color-adjust: exact; 
    }
}



@media print {
   .pinktd td {
		border: 1px solid #FFFFCC;
         background-color: #FFFFCC !important;
       -webkit-print-color-adjust: exact !important;
    }
}
@media print {
   strong {
		border: 1px solid #FFCCCC;
         background-color: #FFCCCC !important;
		 float:right;
		 margin-right:10px;
		 background-color:#FFB6C1;
		 text-align:center;
		 padding-top:12px;
		 padding-bottom:32px;
		 width:70%;
       -webkit-print-color-adjust: exact !important;
    }
}

@media print {
   h5 {
	    background-color: #FFCCCC !important;
		border-top:1px solid #FFCCCC;
		margin:0px;
       -webkit-print-color-adjust: exact !important;
    }
}

@media print {
  @page { margin: 0; }
	.sec_housedetails{page-break-before: always;}
}
.main-footer{
	
	display:none;
}
.sect{position:relative;float:left;width:100%;}
.sect strong{background-color:#000;padding:15px;color:#fff;}
.sect .ta_sect{background-color:#efefef;position:relative;float:left;width:100%;margin-top: 20px;}
.ta_sect tbody tr td{border:none;}
.ta_se tbody tr td{text-align:center;}
@media print {
.sect{position:relative;float:left;width:100%;}
.ta_se tbody tr td strong{background-color:#000!important;padding:15px;color:#fff!important;margin:25px auto;width:40%;margin-right:-50px;text-align:center!important;}
.sect .table.ta_sect{background-color:#efefef!important;position:relative;float:left;width:100%;margin-top: 20px;}
	.sec_housedetails{page-break-after: always;}
}
</style>

<section class="content" style="background-color:#fff;">
	<div class="row" >
		<div class="col-sm-12"><button id="print_btn" onclick="printpage();" class="btn btn-success btn-sm pull-right print_btn">Print out</button>	</div>
	</div>
	<div class="row">
			<div class="col-sm-12 col-xs-12">
				<h1><img src="<?php echo base_url('assets/admin')?>/dist/img/khlogo.png" alt="kh logo">
				<strong style="float:right;margin-right:10px;background-color:#FFB6C1;text-align:center;padding-top:12px;padding-bottom:32px;" class="col-sm-10"> Loan Schedule</strong></h1>
				<br>
				<br>
				<h4></h4>
				<div class="row">
				<div class="col-sm-12 col-xs-12 sect text-center" style="padding:0px;" >
				<!--<table class="table ta_se">
					<tbody >
						<tr>
							<td style="background-color:#000!important;padding:15px;color:#fff!important;margin:5px auto;text-align:center !important;">Mark Receiced by Cash 30% without Interest
							</td>
						</tr>
					</tbody>
				</table>-->
					
			<!--	<table class="table ta_sect" style="background-color:#EFEFEF!important;margin-top: 20px;">
					<tbody>
						<tr>
							<td>Customer's Name </td>
							<td></td>
							<td class="text-right">Name:</td>
							<td></td>
						</tr>
						<tr>
							<td>Sear</td>
							<td></td>
							<td class="text-right">Tel: 124252</td>
							<td></td>
						</tr>
					</tbody>
				</table>-->
				</div>
				</div>
				<?php /*?><h4 class="text-center"><b>Customer's Name	</b>	<br>
				Name: 
				<?php  if(isset($sales->displayname1) && $sales->displayname1==1){ echo  $sales->customer_name    ; }   ?>
				<?php  if(isset($sales->dislayname2) && $sales->dislayname2==1){ echo  '/'.$sales->customername2    ; }  ?>
						<br>
				Tel: <?php  if(isset($sales->contact_number)){ echo $sales->contact_number   ; }  ?>
			   </h4><?php */?>
			   
			   <?php   if(!empty($result_emi)): ?>
				<h3 class="text-center housedetails" style="margin-top:1px;background-color:#FFFFCC;margin:0px;font-size:18px;"><b>House No <?php  if(isset($sales->unit_no)){ echo $sales->unit_no   ; }  ?> / House Price:
				
				<?php echo $this->sma->formatMoney($sales->unitPrice) ;  ?></b></h3> 
				 <table class="table" >
				<colgroup>
					<col width="40%">
					<col width="20%">
					<col width="40%">
				</colgroup>
				<tr class="vendorListHeading" style="background-color:#FFFFCC;">
				<th>Loan Values
				 </th>
				 <th style="background-color:#FFF;"></th>
				<th>Loan Summary</th>
				</tr>
				<tbody style="background-color:#FFCCCC;" >
					<tr class="vendorListHeading">
						<td class="pinktd"style="padding:0px;border-top:1px solid #FFCCCC;"><h5>Loan amount <?php  if(isset($loanpercentage)){ echo $loanpercentage.'%'   ; }  ?> :<?php  
						echo $this->sma->formatMoney($loanamount)  ;
						 ?></h5></td>
						<td  style="background-color:#FFF;padding:0px;border-top:1px solid #FFCCCC;text-align: center;padding: 0px;"><b>Customer's Name	</b></td>
						
						<td style="padding:0px;border-top:1px solid #FFCCCC;"><?php   if($sales->moratorium_per <100){ ?><h5>Monthly payment :<?php  
						echo $this->sma->formatMoney($monthly)  ;
						 ?></h5><?php   }  ?></td>
						
						</tr>
						<tr class="vendorListHeading">
						<td style="padding:0px;border-top:1px solid #FFCCCC;"><h5>Annual interest rate  :  <?php  if(isset($interest_per)){ echo $interest_per.'%'   ; }  ?></h5></td>
						<td style="background-color:#FFF;border-top:1px solid #fff;text-align: center;padding: 0px;">
							Name: 
			<?php  if(isset($sales->displayname1) && $sales->displayname1==1){ echo  $sales->customer_name    ; }   ?>
			<?php  if(isset($sales->dislayname2) && $sales->dislayname2==1){ echo  '/'.$sales->customername2    ; }  ?>
						</td>
						<td style="padding:0px;border-top:1px solid #FFCCCC;"><h5>Number of payments   : <?php  if(isset($numberpayment)){ echo $numberpayment   ; }  ?></h5></td>
						</tr>
						<tr class="vendorListHeading">
							<td style="padding:0px;border-top:1px solid #FFCCCC;"><h5>Loan period   :  <?php  if(isset($numberpayment)){ echo round(($numberpayment),1)   ; }  ?>  Months</h5></td>
							<td style="background-color:#FFF;border-top:1px solid #fff;text-align: center;padding: 0px;">Tel: <?php  if(isset($sales->contact_number)){ echo $sales->contact_number   ; }  ?></td>
							<td style="padding:0px;border-top:1px solid #FFCCCC;"><h5>Total interest : <?php
echo $this->sma->formatMoney($totalinterest)  ;
 ?></h5></td>
					</tr>
						<tr class="vendorListHeading">
						<td style="padding:0px;border-top:1px solid #FFCCCC;"><h5>Start date of loan  : <?php  if(isset($sales->booking_date)){ echo ($sales->booking_date)   ; }  ?></h5></td>
						<td style="background-color:#FFF;border-top:1px solid #fff;"></td>
						<td style="padding:0px;border-top:1px solid #FFCCCC;"><h5>Total Payment :
						<?php
echo $this->sma->formatMoney($payment)  ;
?>		
						</h5></td>

					</tr>
				</tbody>
			</table>
				 <table class="table">
					<tr style="background-color:#E5FFCC;"  class="emitable" >
					<th>Pmt No.</th>
					<th>Payment Date</th>
					<th>Beginning Balance</th>
					<th>Payment</th>
					<th>Principal</th>
					<th>Interest</th>
					<th>Ending Balance</th>
					</tr>
					<tbody>
					<?php 
								 	
									$i = 1;
									foreach($result_emi as $row_emi) { ?>
									<tr>
										<td><?php echo $i; ?></td>
									
										<td><?php echo $row_emi->emi_duedate; ?></td>
									<td><?php  echo $this->sma->formatMoney($row_emi->Beginning_Balance)                         ; ?></td>
										<td><?php  echo $this->sma->formatMoney($row_emi->emi_amount)                         ; ?></td>
										<td><?php  echo $this->sma->formatMoney($row_emi->Principal)                         ; ?></td>
										<td><?php  echo $this->sma->formatMoney($row_emi->Interest)                         ; ?></td>
										<td><?php  echo $this->sma->formatMoney($row_emi->Ending_Balance)                         ; ?></td>
										
										
									</tr>
									<?php
									$i++;
									} ?>
					</tbody>
				</table>
				
				
				<!--<div class="col-sm-12 col-xs-12 sect text-center" style="margin-top:25px;" >
					<p class="text-center" style="background-color:#000!important;padding:15px;color:#fff!important;margin:25px auto;width:30%;">Mark  70% with Interest%</p>
				</div>-->
				<table class="table " style="border: none;">
					<colgroup>
						<col width="50%">
						<col width="50%">
						
					</colgroup>
					<tbody>
						<br>
						<tr style="border: none;">
							<td class="nones" align="center"><p> Authorized Signature</p>
							<br>
							<br>
							
							
						<p>-------------------</p></td>
							<br>
							<td class="nones"  align="center"><p>Customer's Signature</p>
							<br>
							<br>
								<p>-------------------</p></td>
							
						</tr>
					</tbody>
				</table>
				
		</div>
			</div>	
				</section>
				<?php endif;  ?>
				  <?php   if(!empty($result_emi1)): ?>
				<section class="content" style="background-color: #fff;">
				<div class="row">
					<div class="col-sm-12 col-xs-12">
				<h3 class="text-center housedetails sec_housedetails" style="margin-top:1px;background-color:#FFFFCC;margin:0px;font-size:18px;position:relative;float:left;width:100%;margin-top:0px;page-break-before: always;"><b>House No <?php  if(isset($sales->unit_no)){ echo $sales->unit_no   ; }  ?> / House Price:
				<?php echo $this->sma->formatMoney($sales->unitPrice) ;  ?></b></h3> 
					 <table class="table " >
					<colgroup>
						<col width="40%">
						<col width="20%">
						<col width="40%">
					</colgroup>
					<tr class="vendorListHeading" style="background-color:#FFFFCC;">
					<th>Loan Values
                     </th>
					 <th style="background-color:#FFF;"></th>
					<th>Loan Summary</th>
					</tr>
					<tbody style="background-color:#FFCCCC;" >
						<tr class="vendorListHeading">
							<td class="pinktd"style="padding:0px;border-top:1px solid #FFCCCC;"><h5>Loan amount <?php  if(isset($loanpercentage1)){ echo $loanpercentage1.'%'   ; }  ?> :<?php  
							echo $this->sma->formatMoney($loanamount1)  ;
							 ?></h5></td>
							<td  style="background-color:#FFF;padding:0px;border-top:1px solid #FFCCCC;text-align: center;padding: 0px;"><b>Customer's Name	</b></td>
							<td style="padding:0px;border-top:1px solid #FFCCCC;"><h5>Monthly payment :<?php  
							echo $this->sma->formatMoney($monthly1)  ;
							 ?></h5></td>
							</tr>
							<tr class="vendorListHeading">
							<td style="padding:0px;border-top:1px solid #FFCCCC;"><h5>Annual interest rate  :  <?php  if(isset($interest_per1)){ echo $interest_per1.'%'   ; }  ?></h5></td>
							<td style="background-color:#FFF;border-top:1px solid #fff;text-align: center;padding: 0px;">
								Name: 
				<?php  if(isset($sales->displayname1) && $sales->displayname1==1){ echo  $sales->customer_name    ; }   ?>
				<?php  if(isset($sales->dislayname2) && $sales->dislayname2==1){ echo  '/'.$sales->customername2    ; }  ?>
							</td>
							<td style="padding:0px;border-top:1px solid #FFCCCC;"><h5>Number of payments   : <?php  if(isset($numberpayment1)){ echo $numberpayment1   ; }  ?></h5></td>
							</tr>
							<tr class="vendorListHeading">
							<td style="padding:0px;border-top:1px solid #FFCCCC;"><h5>Loan period   :  <?php  if(isset($numberpayment1)){ echo round(($numberpayment1),1)   ; }  ?>  Months</h5></td>
							<td style="background-color:#FFF;border-top:1px solid #fff;text-align: center;padding: 0px;">Tel: <?php  if(isset($sales->contact_number)){ echo $sales->contact_number   ; }  ?></td>
							<td style="padding:0px;border-top:1px solid #FFCCCC;"><h5>Total interest : <?php
echo $this->sma->formatMoney($totalinterest1)  ;
 ?></h5></td></tr>
							<tr class="vendorListHeading">
							<td style="padding:0px;border-top:1px solid #FFCCCC;"><h5>Start date of loan  :
<?php     

if($sales->moratorium !=0){
echo $dates=Date("Y-m-d", strtotime("".$sales->booking_date." +".round(($sales->moratorium),1)." Month +0 Day"));
}else{
	echo $sales->booking_date;
}

?>



							</h5></td>
							<td style="background-color:#FFF;border-top:1px solid #fff;"></td>
							<td style="padding:0px;border-top:1px solid #FFCCCC;"><h5>Total Payment :
							<?php
echo $this->sma->formatMoney($payment1)  ;
 ?>		
							</h5></td>
							
						</tr>
					</tbody>
				</table>
				 <table class="table">
					<tr style="background-color:#E5FFCC;"  class="emitable" >
					<th>Pmt No.</th>
					<th>Payment Date</th>
					<th>Beginning Balance</th>
					<th>Payment</th>
					<th>Principal</th>
					<th>Interest</th>
					<th>Ending Balance</th>
					</tr>
					<tbody>
					<?php 
								 	
									$i = 1;
									foreach($result_emi1 as $row_emi) { ?>
									<tr>
										<td><?php echo $i; ?></td>
									
										<td><?php echo $row_emi->emi_duedate; ?></td>
									<td><?php  echo $this->sma->formatMoney($row_emi->Beginning_Balance)                         ; ?></td>
										<td><?php  echo $this->sma->formatMoney($row_emi->emi_amount)                         ; ?></td>
										<td><?php  echo $this->sma->formatMoney($row_emi->Principal)                         ; ?></td>
										<td><?php  echo $this->sma->formatMoney($row_emi->Interest)                         ; ?></td>
										<td><?php  echo $this->sma->formatMoney($row_emi->Ending_Balance)                         ; ?></td>
										
										
									</tr>
									<?php
									$i++;
									} ?>
					</tbody>
				</table>
				
			
				
				<table class="table " style="border: none;">
					<colgroup>
						<col width="50%">
						<col width="50%">
						
					</colgroup>
					<tbody>
						<br>
						<tr style="border: none;">
							<td class="nones" align="center"><p> Authorized Signature</p>
							<br>
							<br>
							
							
						<p>-------------------</p></td>
							<br>
							<td class="nones"  align="center"><p>Customer's Signature</p>
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
<?php endif;  ?>
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
