<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap.min.css">
<style>
	.table_se{width: 100%;}
	.table tbody tr td{border: none;line-height: 26px;}
	.table tbody tr td .table{margin-bottom: 0px;}
	.table tbody tr td .table tbody tr td{padding: 0px;}
	@page {
  size: auto;
  margin-top:10px;
  margin-bottom:0px;
}
	
	#header,#footer{margin: 0px;}
	</style>
</head>

<body>
	<div class="table_se">
		<table class="table" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td>
						<table class="table">
						<?php   if($demand_letter->title  ==1){ ?>
							<tr>
								<td align="center"><h4><b><?php  echo $demand_letter->title_text ;  ?></b></h4></td>
							</tr>
						<?php    }   ?>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table>
						<tr>
								<td><b>From:</b></td>
							</tr>
								<?php   if($demand_letter->yourname==1){ ?>
							<tr>
								<td><?php  echo $settings->name;   ?></td>
							</tr>
	<?php    }   ?>
	<?php   if($demand_letter->address==1){ ?>
							<tr>
								<td><?php  echo $settings->address;   ?></td>
							</tr>
							<?php    }   ?>
							<?php   if($demand_letter->contact==1){ ?>
							<tr>
								<td><?php  echo $settings->phone;   ?></td>
							</tr>
							<?php    }   ?>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table>
						<?php   if($demand_letter->date==1){ ?>
							<tr>
								<td><b><?php  echo date('Y-m-d');  ?></b></td>
							</tr>
							<?php    }   ?>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table>
						<tr>
								<td><b>To :</b></td>
							</tr>
							
							<?php   if($demand_letter->debate_name==1){ ?>
							<tr>
								<td><?php  echo $booking_details->applicant_name  ?></td>
							</tr>
							<?php    }   ?>
							<?php   if($demand_letter->debate_address_1==1){ ?>
							<tr>
								<td><?php  echo $booking_details->address  ?></td>
							</tr>
							<?php    }   ?>
							<?php   if($demand_letter->debate_contact==1){ ?>
							<tr>
								<td><?php  echo $booking_details->contactno  ?></td>
							</tr>
							<?php    }   ?>
						</table>
					</td>
				</tr>
				
				<tr>
					<td>
						<table>
						<?php   if($demand_letter->subject ==1){ ?>
							<tr>
								<td><b>Subject:Letter of demand – outstanding payment for <?php echo $payment_details->name.'('.$payment_details->percetage.'%)'   ?></b></td>
							</tr>
							<?php    }   ?>
						</table>
					</td>
				</tr>
				<tr>
				<td>
					<table>
					<?php   if($demand_letter->out_standing_amount ==1){ ?>
						<tr>
							<td><b> Payment Details : <?php  echo $this->sma->formatMoney($payment_details->amount);  ?></b></td>
						</tr>
						<?php    }   ?>
					</table>
				</td>
			</tr>
			<tr>
					<td>
						<table>
						<?php   if($demand_letter->dear_debtor==1){ ?>
							<tr>
								<td>Dear  <?php  echo $booking_details->applicant_name  ?></td>
							</tr>
							<?php    }   ?>
							
						</table>
					</td>
				</tr>
			
				<tr>
					<td>
						<table>
						
							<tr>
								<td><?php  echo $demand_letter->comments;  ?></td>
							</tr>
							
							
						
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table>
						<?php   if($demand_letter->your_sincerely ==1){ ?>
							<tr>
								<td>Yours sincerely,</td>
							</tr>
							<?php    }   ?>
						</table>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</body>
</html>
