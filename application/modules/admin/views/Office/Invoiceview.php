<style>

.invoice-title h2{
 background-color: #2c3542;
padding: 5px;
color: #fff;
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
 @page 
    {
        size:  auto;   /* auto is the initial value */
        margin: 0mm;  /* this affects the margin in the printer settings */
    }
</style>

<section class="content">
	<div class="row">
		<div class="col-sm-12"><button id="print_btn" onclick="printpage();" class="btn btn-success btn-sm pull-right print_btn">Print out</button>	</div>
	</div>
	<div class="row">
        <div class="col-xs-12">
		
    		<div class="invoice-title">
    			<h2 class="text-center">Invoice</h2>
    			<h3 class="pull-right">Inv No #<p style="font-size:14px;"><?php if(isset($Invoicedetails->reservation_number)){ echo $Invoicedetails->reservation_number ;}else { echo '######';  }  ?></p><p style="font-size:10px;">STR10,Hills Park,Los Vegas,</p><p style="font-size:10px;">united states of america.</p></h3>
				
				
    		</div>
    		<hr>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    				<strong>Billed To:</strong><br>
    					  <?php if(isset($Invoicedetails->firstname)){ echo $Invoicedetails->firstname ;}else { echo '######';  }  ?><br>
    					<?php if(isset($Invoicedetails->mobile)){ echo $Invoicedetails->mobile ;}else { echo '######';  }  ?><br>
						<?php if(isset($Invoicedetails->email)){ echo $Invoicedetails->email ;}else { echo '######';  }  ?><br>
    				</address>
    			</div>
    			<div class="col-xs-6 text-right">
    				<address>
        			<?php if(isset($Invoicedetails->address)){ echo nl2br($Invoicedetails->address) ;}else { echo '######';  }    ?>
					
    				</address>
    			</div>
    		</div>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    					<strong>Payment Method:</strong><br>
    					#########<br>
    					<?php if(isset($Invoicedetails->email)){ echo $Invoicedetails->email ;}else { echo '######';  }  ?>
    				</address>
    			</div>
    			<div class="col-xs-6 text-right">
    				<address>
    					<strong>Bill Date:</strong>
    					<br><?php if(isset($Invoicedetails->check_out)){ echo $Invoicedetails->check_out ;}else { echo '######';  }    ?><br>
    				</address>
    			</div>
    		</div>
    	</div>
    </div>
    
    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<h3 class="panel-title"><strong>Bill summary</strong></h3>
    			</div>
    			<div class="panel-body">
    				<div class="table-responsive">
    					<table class="table table-condensed">
    						<thead>
                                <tr>
        							<td><strong>Services</strong></td>
        							<td class="text-center"><strong>Amount</strong></td>
        							<td class="text-center"><strong>Description</strong></td>
        							<td class="text-right"><strong>Totals</strong></td>
                                </tr>
    						</thead>
    						<tbody>
    						<?php 
							if(isset($payment)){

							foreach ($payment as $payments){
								?>
    							<tr>
    								<td><?php if(isset($payments->Payingby)){ echo $payments->Payingby ;}else { echo '######';  }    ?></td>
    								<td class="text-center">$<?php if(isset($payments->Amount)){ echo round($payments->Amount,2) ;}else { echo '######';  }    ?></td>
    								<td class="text-center">USD</td>
    								<td class="text-right">$<?php if(isset($payments->Amount)){ echo round($payments->Amount,2) ;}else { echo '######';  }    ?></td>
    							</tr>
                             <?php
							}
							}
							 ?>
    							<tr>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line text-center"><strong>Subtotal</strong></td>
    								<td class="thick-line text-right">$<?php if(isset($Invoicedetails->Totalpaying)){ echo round($Invoicedetails->Totalpaying,2) ;}else { echo '######';  }    ?></td>
    							</tr>
    							
    							<tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line text-center"><strong>Total</strong></td>
    								<td class="no-line text-right"><strong>$<?php if(isset($Invoicedetails->Totalpaying)){ echo round($Invoicedetails->Totalpaying,2) ;}else { echo '######';  }    ?></strong></td>
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