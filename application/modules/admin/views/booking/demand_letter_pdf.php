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
							<tr>
								<td align="center"><h4><b>Demand Letter</b></h4></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table>
						<tr>
								<td><b>From:</b></td>
							</tr>
							<tr>
								<td><?php  echo $settings->name;   ?></td>
							</tr>

							<tr>
								<td><?php  echo $settings->address;   ?></td>
							</tr>
							<tr>
								<td><?php  echo $settings->phone;   ?></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table>
							<tr>
								<td><b><?php  echo date('Y-m-d');  ?></b></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table>
						<tr>
								<td><b>To :</b></td>
							</tr>
							<tr>
								<td><?php  echo $booking_details->applicant_name  ?></td>
							</tr>
							<tr>
								<td><?php  echo $booking_details->address  ?></td>
							</tr>
							<tr>
								<td><?php  echo $booking_details->contactno  ?></td>
							</tr>
						</table>
					</td>
				</tr>
				
				<tr>
					<td>
						<table>
							<tr>
								<td><b>Subject:Letter of demand – outstanding payment for <?php echo $payment_details->name.'('.$payment_details->percetage.'%)'   ?></b></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
				<td>
					<table>
						<tr>
							<td><b> Payment Details : <?php  echo $this->sma->formatMoney($payment_details->amount);  ?></b></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
					<td>
						<table>
							<tr>
								<td>Dear  <?php  echo $booking_details->applicant_name  ?></td>
							</tr>
							
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
							<tr>
								<td>Yours sincerely,</td>
							</tr>
						</table>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</body>
</html>
