<?php 
	/**
	 * AMORTIZATION CALCULATOR
	 * @author PRANEETH NIDARSHAN
	 * @version V1.0
	 */
	class Amortization
	{
		private $loan_amount;
		private $term_years;
		private $interest;
		private $terms;
		private $period;
		private $currency = "XXX";
		private $principal;
		private $balance;
		private $term_pay;

		public function __construct($data)
		{
			if($this->validate($data)) {

				
				$this->loan_amount 	= (float) $data['loan_amount'];
				$this->term_years 	= (int) $data['term_years'];
				$this->interest 	= (float) $data['interest'];
				$this->terms 		= (int) $data['terms'];
				
				$this->terms = ($this->terms == 0) ? 1 : $this->terms;

				$this->period = $this->terms * $this->term_years;
				$this->interest = ($this->interest/100) / $this->terms;

				$results = array(
					'inputs' => $data,
					'summary' => $this->getSummary(),
					'shedule' => $this->getShedule(),
					);

				$this->getJSON($results);
			}
		}

		private function validate($data) {
			$data_format = array(
				'loan_amount' 	=> 0,
				'term_years' 	=> 0,
				'interest' 		=> 0,
				'terms' 		=> 0
				);

			$validate_data = array_diff_key($data_format,$data);
			
			if(empty($validate_data)) {
				return true;
			}else{
				echo "<div style='background-color:#ccc;padding:0.5em;'>";
				echo '<p style="color:red;margin:0.5em 0em;font-weight:bold;background-color:#fff;padding:0.2em;">Missing Values</p>';
				foreach ($validate_data as $key => $value) {
					echo ":: Value <b>$key</b> is missing.<br>";
				}
				echo "</div>";
				return false;
			}
		}

		private function calculate()
		{
			$deno = 1 - 1 / pow((1+ $this->interest),$this->period);
			$this->term_pay = ($this->loan_amount * $this->interest) / $deno;
			$interest = $this->loan_amount * $this->interest;
			$this->principal = $this->term_pay - $interest;
			$this->balance = $this->loan_amount - $this->principal;
			return array (
				'payment' 	=> $this->term_pay,
				'interest' 	=> $interest,
				'principal' => $this->principal,
				'balance' 	=> $this->balance
				);
		}

		public function getSummary()
		{
			$this->calculate();
			$total_pay = $this->term_pay *  $this->period;
			$total_interest = $total_pay - $this->loan_amount;

			return array (
				'total_pay' => $total_pay,
				'total_interest' => $total_interest,
				);
		}

		public function getShedule ()
		{
			$shedule = array();
			
			while  ($this->balance >= 0) { 
				array_push($shedule, $this->calculate());
				$this->loan_amount = $this->balance;
				$this->period--;
			}

			return $shedule;

		}

		private function getJSON($data)
		{
			header('Content-Type: application/json');
			echo json_encode($data);
		}
	}

	$data = array(
		'loan_amount' 	=> 20000,
		'term_years' 	=> 1,
		'interest' 		=> 10,
		'terms' 		=> 12
		);

	$amortization = new Amortization($data);


	?>