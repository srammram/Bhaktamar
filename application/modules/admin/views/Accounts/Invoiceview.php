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
    			<h3 class="pull-right">#INV-000<?php if(isset($bills->bill_id)){ echo $bills->bill_id ;}else { echo '######';  }  ?></h3>
    		</div>
    		<hr>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    				<strong>Billed To:</strong><br>
    					<?php if(isset($to->o_name)){ echo $to->o_name ;}else { echo '######';  }  ?><br>
    					<?php if(isset($to->o_contact)){ echo $to->o_contact ;}else { echo '######';  }  ?><br>
						<?php if(isset($to->o_email)){ echo $to->o_email ;}else { echo '######';  }  ?><br>
    				</address>
    			</div>
    			<div class="col-xs-6 text-right">
    				<address>
        			<?php if(isset($from->address)){ echo nl2br($from->address) ;}else { echo '######';  }    ?>
					
    				</address>
    			</div>
    		</div>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    					<strong>Payment Method:</strong><br>
    					#########<br>
    					<?php if(isset($to->o_email)){ echo $to->o_email ;}else { echo '######';  }  ?>
    				</address>
    			</div>
    			<div class="col-xs-6 text-right">
    				<address>
    					<strong>Bill Date:</strong>
    					<br><?php if(isset($bills->bill_date)){ echo $bills->bill_date ;}else { echo '######';  }    ?><br>
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
    							<!-- foreach ($order->lineItems as $line) or some such thing here -->
    							<tr>
    								<td><?php if(isset($bills->Servicess)){ echo $bills->Servicess ;}else { echo '######';  }    ?></td>
    								<td class="text-center">$<?php if(isset($bills->total_amount)){ echo $bills->total_amount ;}else { echo '######';  }    ?></td>
    								<td class="text-center"><?php if(isset($bills->bill_details)){ echo $bills->bill_details ;}else { echo '######';  }    ?></td>
    								<td class="text-right">$<?php if(isset($bills->total_amount)){ echo $bills->total_amount ;}else { echo '######';  }    ?></td>
    							</tr>
                             
    							<tr>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line text-center"><strong>Subtotal</strong></td>
    								<td class="thick-line text-right">$<?php if(isset($bills->total_amount)){ echo $bills->total_amount ;}else { echo '######';  }    ?></td>
    							</tr>
    							
    							<tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line text-center"><strong>Total</strong></td>
    								<td class="no-line text-right"><strong>$<?php if(isset($bills->total_amount)){ echo $bills->total_amount ;}else { echo '######';  }    ?></strong></td>
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