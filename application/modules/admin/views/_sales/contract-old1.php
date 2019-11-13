<?php 
	/* echo '<pre>';
	print_r($result);
	die; */
?>
<style>
	/*! Generated by Font Squirrel (https://www.fontsquirrel.com) on May 9, 2019 */


@font-face { font-family: khmer_os_muol_lightregular; font-weight: bold; src: url('<?=base_url()?>assets/fonts/khmer_font/KhmerOSmuollight_1.ttf');}
@font-face { font-family: khmer_os_battambangregular; font-weight: bold; src: url('<?=base_url()?>assets/fonts/khmer_font/KhmerOSbattambang_1.ttf');}
@font-face { font-family: khmer_os_muolregular; font-weight: bold; src: url('<?=base_url()?>assets/fonts/khmer_font/KhmerOSmuol_1.ttf');}
@font-face { font-family: khmer_osregular; font-weight: bold; src: url('<?=base_url()?>assets/fonts/khmer_font/KhmerOS_1.ttf');}
@font-face { font-family: khmer_os_siemreapregular; font-weight: bold; src: url('<?=base_url()?>assets/fonts/khmer_font/KhmerOSsiemreap_1.ttf');}

.view_booking {
         font-family: 'khmer_os_muol_lightregular'!important;
      }
	.se_f_df .table tbody tr td{border: none;}
	.report_se{background-color: #fff;}
	.report_se .form-control{border: none;box-shadow: none;margin-top: 0px;}
	.report_se .form_control{border: none;box-shadow: none;margin-top: 0px;border-bottom: 1px solid #ccc;}
	.main_ta_l tbody tr td{border: none;}
	.main_ta_l tbody tr td .table tbody tr td{border: 1px solid black;padding: 12px;text-align: center;}
	.hidden-print{margin-right: 15px;}
	.h3-font-size{font-size:14px;font-family: 'khmer_os_muol_lightregular';}
	.h2-font-size{font-size:16px;font-family: 'khmer_os_muol_lightregular';}
	.font-bold{font-weight:bold;}
	.view_booking{padding:20px;}
	.view_booking .table td{padding:0px;font-size: 12px; font-family: 'khmer_os_battambangregular';}
	.view_booking .table .first_li_r td{padding:12px!important;font-size: 12px;text-align: center; }
	.view_booking .table td input{height:0px;text-align: center;}
	.view_booking .table.homepage td{padding:12px;}
	.view_booking .brown p,.view_booking .brown div,
	.view_booking .brown h4,.view_booking .brown h5,.view_booking .brown h6,.view_booking .brown b,.view_booking .brown span,
	.view_booking .brown h1
	,.view_booking .brown td,.view_booking .brown td input{color:black !important;}
	.main-footer{display:none;}
	.se_f_df h4{font-size: 26px;font-family: 'khmer_os_muolregular';}
	.se_f_df h1{font-size: 22px;font-family: Cambria, "Hoefler Text", "Liberation Serif", Times, "Times New Roman", "serif"}
	.se_f_df h5{font-size: 10px; font-family: 'khmer_osregular';}
	.se_f_df h6{font-size: 10px; font-family: 'khmer_osregular';}
	@media print {
      .view_booking .brown {color:black;}
	}
	.khmer_os{ font-family: 'KhmerOSKienSvay'!important;}
	.se_f_dff h3{font-size: 15px;font-family: 'khmer_os_muol_lightregular';}
	.last_bt_t tbody tr td input{font-size: 12px;font-family: 'khmer_os_muol_lightregular';}
	.se_f_dff h4{font-size: 12px;font-family: 'khmer_os_muol_lightregular';}
	.se_f_dff h5{font-size: 12px;font-family: 'khmer_osregular';}
	
	.first_li_r_r tbody tr td input{font-size: 12px;}
	.half_s_e tbody tr td input{font-size: 12px;}
	.half_s_e p{font-size: 12px;font-family: 'khmer_osregular';}
	.half_s_e p b{font-size: 12px;font-family: 'khmer_os_muol_lightregular';margin-bottom: 15px;}
	.table tbody .first_li_r td input{font-size: 12px;text-align: center;}
	@media print {
   .table tbody tr .pinkhead {
         background-color: #FFB6C1 !important;
        -webkit-print-color-adjust: exact; 
    }
	.table thead tr .pinkhead {
         background-color: #FFB6C1 !important;
        -webkit-print-color-adjust: exact; 
    }
	.table tbody tr td small{
		color:red!important;font-size: 12px; font-family: 'khmer_osregular';
	}
		.brown{
			page-break-before: always;
		}
}
.pinkhead{
	 background-color: #FFB6C1 !important;
}
</style>
	<section class="col-sm-12 view_booking report_se">
	<div class="row">
		<div class="row" style="border: 3px solid #000;margin: 15px;padding: 0px 1px 1px 0px;">
		<div class="col-sm-12 row" style="border: 5px solid #000;margin: 2px;padding:5px;">
			<div class="col-sm-12">
				<button class="btn btn-primary hidden-print pull-right" onclick="myFunction()"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Print</button>
			</div>
			<?php   ?>
			<div class="col-sm-12 col-xs-12">
				<img src="<?php echo base_url('assets/admin')?>/dist/img/khlogo.png" alt="kh logo">
			</div>
			<div class="col-sm-12 col-xs-12 brown">
				<div class="h3-font-size text-center" style="font-weight:bold;">ព្រះរាជាណាចក្រកម្ពុជា</div>
				<div class="h3-font-size text-center" style="font-weight:bold;">ជាតិ  សាសនា  ព្រះមហាក្សត្</div>
				
				<div class="text-center">
<!--					<p class="khmer_os"> ✽ </p>-->
					<img src="<?php echo base_url('assets/admin')?>/dist/img/kh_header.png" alt="kh logo" width="90px">
				</div>
				<br><br><br><br><br><br><br>
				<div class="h2-font-size text-center font-bold">កិច្ចព្រមព្រៀងទិញ-លក់ផ្ទះ</div>
				<div class="col-sm-6 col-sm-offset-3 col-xs-12 se_f_df">
					<table class="homepage table text-center font-bold">
						<colgroup>
							<col width="45%">
							<col width="5%">
							<col width="45%">
						</colgroup>
						<tbody>
							<tr>
								<td>ផ្ទះលេខ</td>
								<td>:</td>
								<td><input  style="height:22px;text-align: left;"type="text"  value="<?php if(isset($bookingdetails->address)){  echo $bookingdetails->address ;  }  ?>"   class="form-control"></td>
							</tr>
							<tr>
								<td>ផ្លូវលេខ</td>
								<td>:</td>
								<td><input type="text" style= "height:22px;text-align: left;" value="<?php if(isset($bookingdetails->street)){  echo $bookingdetails->street ;  }  ?>"  class="form-control"></td>
							</tr>
							<tr>
								<td>ប្រភេទផ្ទះ</td>
								<td>:</td>
								<td><input type="text"  style= "height:22px;text-align: left;" value="<?php if(isset($bookingdetails->street)){  echo $bookingdetails->street ;  }  ?>"   class="form-control"></td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="col-sm-12  col-xs-12 se_f_df">
					<h4 class="text-center font-bold">បុរី ឃាង ហេង</h4>
					<div style="clear:both;height:40px;"></div>
					<h1 class="text-center">BOREY KHEANG HENG</h1>
					<div style="clear:both;height:30px;"></div>
					<h5 class="text-center font-bold">   <input type="text"  style="text-align:center;" value="  ថ្ងៃទី / ខែ/ ឆ្នាំ20"   class="form-control">    </h5>
					<h6 class="text-center font-bold">លេខរៀង</h6>
					<div style="clear:both;height:200px;"></div>
				</div>
			</div>
		</div>
		</div>
		<br>
		<br>
		<br>
		<!---  sceond page   --->
			<div class="col-sm-12 col-xs-12 brown"  >
				<div class="col-sm-12  col-xs-12 se_f_dff">
					<h3 class="text-center" style="font-weight:bold;font-size: 15px;">ព្រះរាជាណាចក្រកម្ពុជា </h5>
					<h4 class="text-center" style="font-weight:bold;">  ជាតិ  សាសនា  ព្រះមហាក្សត</h4>
					<img src="<?php echo base_url('assets/admin')?>/dist/img/kh_header.png" alt="kh logo" width="50px" class="center-block">
					<h3 class="text-center" style="text-decoration: underline;">កិច្ចព្រមព្រៀងទិញ-លក់</h3>
					
					<h5 class="text-left"><input type="text" class="form-control" value='កិច្ចព្រមព្រៀងទិញ-លក់ ផ្ទះ  ហ្សប ហោស៍  (បន្ទាប់ពីនេះហៅកាត់ថា"កិច្ចព្រមព្រៀង" )' style="padding: 0px;"></h5>
				</div>
				
				<div class="col-sm-12 col-xs-12">
					<table class="table main_ta_l " style="border:black;">
						<tbody>
							<tr>
								<td>
									<h4 style="font-size: 12px;font-family: 'khmer_os_muol_lightregular';">■  ការអធិប្បាយអំពីកម្មវត្ថុនៃការទិញ-លក់ :</h4>
								</td>
								<td><input type="text" class="form-control"></td>
							</tr>
							<tr>
								<td colspan="2">
									<table class="table table-bordered first_li_r_r">
										<tbody>
											<tr class="first_li_r">
												<td class="pinkhead">ប្រភេទផ្ទះ</td>
												<td style="border-right: 0px;"><input type="text" value="ផ្ទះ " class="form-control"></td>
												<td style="border-left: 0px;"><input type="text" value="ផ្ទះលេខ" class="form-control"></td>
												<td><input type="text" value=" ផ្លូវលេខ " class="form-control"></td>
											</tr>
											<tr>
												<td class="pinkhead" style="font-family: 'khmer_osregular';">ទំហំ</td>
												<td colspan="2" class="pinkhead" style="font-family: 'khmer_osregular';">ដី</td>
												<td class="pinkhead" style="font-family: 'khmer_osregular';">សំណង់</td>
											</tr>
											<tr>
												<td class="pinkhead" style="font-family: 'khmer_osregular';">ទទឹង</td>
												<td colspan="2" ><input type="text" value="ម៉ែត្រ" class="form-control" style="font-family: 'khmer_osregular';"></td>
												<td><input type="text" value="ម៉ែត្រ" class="form-control" style="font-family: 'khmer_osregular';"></td>
											</tr>
											<tr>
												<td class="pinkhead">បណ្តោយ</td>
												<td colspan="2"><input type="text" value="ម៉ែត្រ" class="form-control"></td>
												<td><input type="text" value="ម៉ែត្រ" class="form-control"></td>
											</tr>
											<tr>
												<td class="pinkhead">ទំហំសរុប</td>
												<td colspan="2"><input type="text" value="ម៉ែត្រការ៉េ" class="form-control"></td>
												<td><input type="text" value="ម៉ែត្រការ៉េ" class="form-control"></td>
											</tr>
											<tr>
												<td class="pinkhead">អាសយដ្ឋាន</td>
												<td colspan="3"><input type="text" value="ភូមិថ្មី សង្កាត់ដង្កោ ខណ្ឌដង្កោ រាជធានីភ្នំពញ" class="form-control" style="text-align: left;"></td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2" style="font-size: 12px;font-family: 'khmer_os_muol_lightregular';">■  កាលបរិចេ្ឆទបញ្ចប់ការដ្ឋានសាងសង់៖<span style="display: inline-block;"><input type="text" class="form-control" value="18ខែ  គិតចាប់ពី &nbsp;&nbsp; ថ្ងៃទី ខែ  ឆ្នាំ " style="text-align: left;font-family: 'khmer_os_muol_lightregular';"></span>   (អាចប្រែប្រួលទៅតាមកាលវិភាគសាងសង់)</td>
							</tr>
							<tr style="margin-bottom: 15px;">
								<td colspan="2" style="font-size: 12px;font-family: 'khmer_os_muol_lightregular';">■  កិច្ចព្រមព្រៀងនេះធ្វើឡើង និងមានប្រសិទ្ធភាពអនុវត្តដោយ និងរវាង ៖</td>
							</tr>
							<tr>
								<td colspan="2">
									<table class="table table-bordered first_li_r_r">
										<tbody>
											<tr class="first_li_r">
												<td class="pinkhead"></td>
												<td class="pinkhead">ភាគីអ្នកលក់  តំណាងដោយ </td>
												<td class="pinkhead">ភាគីអ្នកទិញ </td>
											</tr>
											<tr>
												<td><input type="text" value="ឈ្មោះ" class="form-control"></td>
												<td ><input type="text" value="ណា សុវណ្ណដា" class="form-control"></td>
												<td><input type="text"  class="form-control"></td>
											</tr>
											<tr>
												<td><input type="text" value="លេខអត្តសញ្ញាណប័ណ្ណ" class="form-control"></td>
												<td ><input type="text" value="010079586 (01)" class="form-control"></td>
												<td><input type="text"  class="form-control"></td>
											</tr>
											<tr>
												<td><input type="text" value="សញ្ជាតិ" class="form-control"></td>
												<td ><input type="text" value="ខ្មែរ" class="form-control"></td>
												<td><input type="text"  class="form-control"></td>
											</tr>
											<tr>
												<td><input type="text" value="លេខទូរស័ព្ទ" class="form-control"></td>
												<td ><input type="text" value="069 555 659 / 099 555 659 / 090 555 659 " class="form-control"></td>
												<td><input type="text" class="form-control"></td>
											</tr>
											<tr>
												<td><input type="text" value="អាសយដ្ឋាន" class="form-control"></td>
												<td><input type="text" value="ផ្ទះលេខ33 ផ្លូវលេខ1 សង្កាត់ភ្នំពេញថ្មី ខណ្ឌសែនសុខ ភ្នំពេញ" class="form-control"></td>
												<td><input type="text" class="form-control"></td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<p style="font-size: 12px; font-family: 'khmer_os_muol_lightregular';">ខចែងពិសេស (កិច្ចការផ្ទេរសិទិ្ធករណីអ្នកទិញជាជនបរទេស)</p>
									<p style="font-size:12px; font-family: 'khmer_osregular';">*ករណីភាគីអ្នកទិញមិនមាន ឬ មិនទាន់ទទួលបានសញ្ជាតិជាខ្មែរ   ភាគីអ្នកទិញបានយល់ច្បាស់លាស់និងទទួលស្គាល់ថាខ្លួនមានសិទិ្ធធ្វើជាម្ចាស់កម្មសិទិ្ធតែចំពោះផ្ទះត្រឹមជាន់ទីមួយ និង ចាប់ពីជាន់ទីមួយឡើងទៅតែប៉ុណ្ណោះ    ពោលគឺដី និងសំណង់ផ្ទះជាន់ផ្ទាល់ដី ខ្លួនគ្មានសិទិ្ធចុះបញ្ជីធ្វើប័ណ្ណកម្មសិទិ្ធកាន់កាប់អចលនវត្ថុឡើយ។  </p>
									<p style="font-size: 12px; font-family: 'khmer_osregular';">**ករណីដែលភាគីអ្នកទិញមិនមាន ឬ មិនទាន់ទទួលបានសញ្ជាតិជាខ្មែរ  ភាគីអ្នកលក់អាចលក់ផ្ទះត្រឹមជាន់ទីមួយ និងចាប់ពីជាន់ទីមួយឡើងទៅជូនភាគីអ្នកទិញតែប៉ុណ្ណោះ  រីឯដី និង សំណង់ផ្ទះជាន់ផ្ទាល់ដី ដូចមានរៀបរាប់នៅក្នុងតារាង “ការអធិប្បាយអំពីកម្មវត្ថុនៃការទិញ-លក់”</p>
									<p style="font-size: 12px; font-family: 'khmer_osregular';">ខាងលើ គឺភាគីអ្នកលក់មិនអាច ចូលរួមបំពេញធ្វើប័ណ្ណកម្មសិទិ្ធកាន់កាប់អចនវត្ថុនៃដី និង សំណង់ផ្ទះជាន់ផ្ទាល់ដី ជូនភាគីអ្នកទិញឡើយ ប៉ុន្តែ ខាងភាគីអ្នកលក់សន្យាថានឹងអនុញ្ញាតិ៎ឲ្យភាគីអ្នកទិញប្រើប្រាស់អាស្រ័យផលបាន ឬ អាចធ្វើការផ្ទេរកម្មសិទិ្ធជូនទៅភាគីអ្នកទិញបន្ត ឬបុគ្គលណាដែលទទួលសិទិ្ធបន្តពី ភាគីអ្នកទិញ ក្នុងករណីបុគ្គលដែលត្រូវបានបុគ្គលដែលត្រូវបានរៀបរាប់មកនេះទទួលបានសញ្ជាតិខ្មែរនាពេលក្រោយ ឬ មានសញ្ជាតិជាខ្មែរ ដោយសោហ៊ុយផេ្សងៗទាក់ទងនឹងការផ្ទេរសិទ្ឋិនេះជាបន្ទុកចំណាយរបស់អ្នកទទួលសិទិ្ធទាំងស្រុង។ </p>
									<p style="font-size: 12px; font-family: 'khmer_osregular';">   *** ប្រសិនបើអាសយដ្ឋានផ្ញើសារខុសពីអាស័យដ្ឋានដូចបានរៀបរាប់ខាងលើ ៖</p>
									<p style="font-size: 12px;font-family: 'khmer_os_muol_lightregular';">■ អាសយដ្ឋានផ្ញើសាររបស់ភាគីអ្នកទិញ</p>
								</td>
							</tr>
							<tr>
								<td colspan="2" style="font-size: 12px; font-family: 'khmer_osregular';">- អ៊ីម៉ែល ៖<span><input type="text" class="form_control" style="display: inline-block;"></span>ទូរសារ ៖ <span><input type="text" class="form_control" style="display: inline-block;"></span>លេខទូរស័ព្ទនៅកម្ពុជា ៖<span><input type="text" class="form_control" style="display: inline-block;"></span>  លេខទូរស័ព្ទនៅបរទេស ៖<span><input type="text" class="form_control" style="display: inline-block;"></span></td>
							</tr>
							<tr>
								<td colspan="2" style="font-size: 12px; font-family: 'khmer_os_muol_lightregular';">
									■ គណនីធនាគាររបស់អ្នកលក់ ៖
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<table class="table table-bordered first_li_r_r">
										<tbody>
											<tr class="first_li_r">
												<td class="pinkhead" style="padding:6px;">ឈ្មោះធនាគារ</td>
												<td class="pinkhead" style="padding:6px;">លេខគណនី</td>
												<td class="pinkhead" style="padding:6px;">Swift កូដ</td>
												<td class="pinkhead" style="padding:6px;">ម្ចាស់គណនី</td>
											</tr>
											<tr>
												<td><input type="text" value="CANADIA BANK PLC" class="form-control"></td>
												<td ><input type="text" value="0060000466789" class="form-control"></td>
												<td><input type="text"  class="form-control"></td>
												<td><input type="text" value="ណា សុវណ្ណដា"  class="form-control"></td>
											</tr>
											
										</tbody>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<p style="font-size: 12px; font-family: 'khmer_osregular';">គណនីនេះជាគណនីទូទាត់ដោយប្រសិទ្ធភាព ហើយអានុភាពនៃកិច្ចព្រមពៀងកើតមានលុះណាតែគ្រប់ភាគីពាក់ព័ន្ធនៃកិច្ចព្រមពៀងបានចុះហត្ថលេខា ឬ ផិ្តតមេដៃរួចរាល់ទាំងស្រុង នៅលើកិច្ចព្រមព្រៀងនេះ និងបានដាក់ប្រាក់ទូទាត់ចូលក្នុងគណនីខាងលើនេះ។ ប្រការ១ ៖ ថ្លៃទិញ និងការបង់ប្រាក់</p>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<p style="font-size: 12px; font-family: 'khmer_osregular';"><span>(១)<br>(ពន្ធលើអាករបន្ថែមត្រូវបានរាប់បញ្ចូល)                   </span><span class="pull-right">ថ្លៃទិញ/តារាងបង់ប្រាក់</span></p>
								</td>
							</tr>
							<tr>
								<td>
									<table class="table table-bordered half_s_e">
										<tbody>
											<tr>
												<td class="pinkhead">ថ្លៃទិញ</td>
												<td class="pinkhead">តំលៃលក់សរុបគិតទាំងដី និងសំណង់</td>
											</tr>
											<tr>
												<td ><input type="text" value="តម្លៃ" class="form-control"></td>
												<td ><input type="text" value="$.......................(ដុល្លា)" class="form-control"></td>
											</tr>
											
										</tbody>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<table class="table table-bordered half_s_e">
										<tbody>
											<tr>
												<td colspan="9" class="pinkhead text-center">តារាងបង់ប្រាក់</td>
											</tr>
											<tr>
												<td class="pinkhead" style="width:10%;">ពេលកំណត់</td>
												<td ><input type="text" style="text-align: center;"value="កក់ប្រាក់ដំបូង" class="form-control"></td>
												<td><input type="text" style="text-align: center;"value="លើកទី១ " class="form-control"></td>
												<td><input type="text" style="text-align: center;" value="លើកទី២" class="form-control"></td>
												<td><input type="text" style="text-align: center;" value="លើកទី៣" class="form-control"></td>
												<td><input type="text" style="text-align: center;" value="លើកទី៤" class="form-control"></td>
												<td><input type="text" style="text-align: center;" value="លើកទី៥" class="form-control"></td>
												<td><input type="text" style="text-align: center;" value="លើកទី៦" class="form-control"></td>
												<td><input type="text" style="text-align: center;" value="លើកទី៧" class="form-control"></td>
											</tr>
											<tr>
												<td class="pinkhead" style="width:10%;">អត្រា</td>
												<td ><input type="text" value="  %" class="form-control"></td>
												<td><input type="text" value="  %"  class="form-control"></td>
												<td><input type="text" value="  %"  class="form-control"></td>
												<td><input type="text" value="  %"  class="form-control"></td>
												<td><input type="text" value="  %"  class="form-control"></td>
												<td><input type="text" value="  %"  class="form-control"></td>
												<td><input type="text" value="  %"  class="form-control"></td>
												<td><input type="text" value="  %"  class="form-control"></td>
											</tr>
											<tr>
												<td class="pinkhead" style="width:10%;">កាលបរិចេ្ទទ</td>
												<td ><input type="text"  class="form-control"></td>
												<td><input type="text"  class="form-control"></td>
												<td><input type="text"  class="form-control"></td>
												<td><input type="text"  class="form-control"></td>
												<td><input type="text"  class="form-control"></td>
												<td><input type="text"  class="form-control"></td>
												<td><input type="text"  class="form-control"></td>
												<td><input type="text"  class="form-control"></td>
											</tr>
											<tr>
												<td class="pinkhead" style="width:10%;">ចំនួន</td>
												<td ><input type="text"  class="form-control"></td>
												<td><input type="text" value="$............"  class="form-control"></td>
												<td><input type="text"  class="form-control"></td>
												<td><input type="text"  class="form-control"></td>
												<td><input type="text"  class="form-control"></td>
												<td><input type="text"  class="form-control"></td>
												<td><input type="text"  class="form-control"></td>
												<td><input type="text"  class="form-control"></td>
											</tr>
											<tr>
												<td class="pinkhead" style="width:10%;"></td>
												<td ><input type="text"  class="form-control"></td>
												<td><input type="text"   class="form-control"></td>
												<td><input type="text"  class="form-control"></td>
												<td><input type="text"  class="form-control"></td>
												<td><input type="text"  class="form-control"></td>
												<td><input type="text"  class="form-control"></td>
												<td><input type="text"  class="form-control"></td>
												<td><input type="text"  class="form-control"></td>
											</tr>
											<tr>
												<td class="pinkhead" style="width:10%;"></td>
												<td ><input type="text"  class="form-control"></td>
												<td colspan="7"><input type="text"   class="form-control"></td>
											</tr>
											<tr>
												<td class="pinkhead" style="width:10%;"></td>
												<td ><input type="text"  class="form-control"></td>
												<td colspan="7"><input type="text"   class="form-control"></td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2" class="half_s_e">
									<p><b>ប្រការ២៖ ការដាក់ពិន័យ និងការបញ្ចប់កិច្ចព្រមព្រៀង</b></p>
									<p>(១) ក្នុងករណីដែលភាគី <b>"អ្នកទិញ"</b> ខកខានមិនបានបង់ប្រាក់អោយបានទាន់ពេលវេលាតាមកាលកំណត់នៃកិច្ចព្រមព្រៀងទេពោល គឺយឺជាង៣០ថ្ងៃ គិតចាប់ពីកាលបរិច្ឆេទដែល ត្រូវបង់មួយលើកៗដូចមានបញ្ជាក់ក្នុងប្រការ ១.១ខាងលើនោះ ភាគី <b>"អ្នកទិញ"</b> ត្រូវបង់បន្ថែមនូវប្រាក់ពិន័យចំនួន <b>១០ ភាគរយ នៃទឹកប្រាក់ដែលត្រូវបង់មួយលើកៗ។ </b>    </p>
									<p> (២) ការបង់ប្រាក់ពិន័យតាមចំនុច ២.១ ខាងលើ មិនអាចលើសពីរយៈពេល ៤៥ ថ្ងៃឡើយ គិតចាប់ពីកាលបរិច្ឆេទដែលត្រូវបង់មក។(៣) ក្នុងករណីដែលភាគីអ្នកទិញខកខានមិនបានបង់ប្រាក់តាមប្រការ ២.១ និង២.២ ខាងលើ ត្រូវចាត់ទុកថាភាគី "អ្នកទិញ" បានបោះបង់ចោល</p>
									<p>ការទិញជាឯកតោភាគី ហើយប្រាក់ ដែលបានបង់រួចត្រូវបានជាប្រយោជន៏របស់ ភាគី <b>"អ្នកលក់"</b> ទនឹ្ទមនឹងនោះ ភាគី "អ្នកលក់" អាចចាត់ចែងលក់ទីតាំងជាកម្មវត្ថុទិញលក់ឲ្យទៅតតីយជនផ្សេងទៀតបាន។  ភាគី <b>"អ្នកទិញ"</b> សុខចិត្តយល់ព្រមមិនប្តឹងទាមទារ ឬ តវ៉ាជាដាច់ខាត។  (៤) ភាគី <b>"អ្នកទិញ"</b> អាចបញ្ចប់កិច្ចព្រមព្រៀងនេះបានគ្រប់ពេល ប៉ុន្តែប្រាក់ដែលបានបង់រួចត្រូវបានជាប្រយោជន៏របស់ភាគី <b>"អ្នកលក់"</b> ទនឹ្ទមនឹង</p>
									<p>នោះ ភាគី "អ្នកលក់" អាចចាត់ចែងលក់ទីតាំងជាកម្មវត្ថុទិញលក់ឲ្យទៅតតីយជនផ្សេងទៀតបាន ។   ភាគី  "អ្នកទិញ"សុខចិត្តយល់ព្រមមិនប្តឹង ទាមទារ ឬ តវ៉ាជាដាច់ខាត។</p>
									<p> (៥)	ភាគីអ្នកទិញយល់ព្រមបង់ថ្លៃសេវាថែទាំ និងសេវាផ្សេងៗប្រចាំខែនៅក្នុងបូរី ទៅតាមប្រភេទផ្ទះនីមួយៗ ដែលនឺងកំណត់ពេលក្រោយ។(៦) ប្រសិនបើការបង់ប្រាក់សមតុល្យដែលនៅសល់និងការបង់ប្រាក់ដំណាក់កាលចុងក្រោយ ដូចមានចែងក្នុងប្រការ១.១ ត្រូវបានភាគីអ្នកទិញ ពន្យារពេលនោះ ភាគី<b> "អ្នកលក់"</b> អាចបញ្ចប់កិច្ចព្រមព្រៀងនេះ បន្ទាប់ពីមានការជូនដំណឹងចំនួន២ដងក្នុងកំឡុងពេល <b>១៤ថ្ងៃ </b>ទៅអោយភាគី <b>"អ្នកទិញ"</b>។</p>
									<p><b>ប្រការ៣៖ ការចុះបញ្ជីកម្មសិទិ្ធ</b></p>
									<p>ភាគី <b>"អ្នកទិញ"</b> អាចផ្ទេរកម្មសិទិ្ធនៃទីតាំងជាកម្មវត្ថុដែលខ្លួនបានទិញ បន្ទាប់ពីបានបង់ប្រាក់ចប់សព្វគ្រប់យោងតាមតម្លៃនៃកិច្ចព្រមព្រៀង ដោយបន្ទុកចំណាយខ្លួនឯង ។ </p>
									<p>ភាគី <b>"អ្នកលក់"</b> ត្រូវបំបែកប្លង់ដីទៅតាមចំណែកប្រភេទផ្ទះនីមួយៗតាមប្លង់មេរបស់ខ្លួន និងត្រូវចូលរួមសហការជាមួយភាគី  <b>"អ្នកទិញ"</b> សម្រាប់ ដំណើរការផ្សេងៗទាក់ទងនឹងការចុះបញ្ជី។</p>
									<p><b>ប្រការ៤៖ ការចូលមកស្នាក់នៅ និងសេវាគ្រប់គ្រង</b></p>
									<p>(១) ភាគី <b>"អ្នកទិញ"</b> មិនត្រូវចូលមកស្នាក់នៅក្នុងផ្ទះដែលខ្លួនបានទិញឡើយ មុនពេលទទួលបានលិខិតប្រគល់ទីតាំងពីភាគី "អ្នកលក់ "  ។</p>
									<p>  (២) ភាគី<b>"អ្នកទិញ"</b> ត្រូវទទួលខុសត្រូវរាល់ការបង់ថ្លៃគ្រប់គ្រង និងថែទាំចំពោះចំណែកនៃដី និង ផ្ទះ ដែលខ្លួនទិញ បន្ទាប់ពីបានកំណត់ថ្ងៃចូលមកស្នាក់នៅជាក់លាក់ ឬ ៧ថ្ងៃបន្ទាប់ ការជូនដំណឹងប្រគល់ទីតាំង  ដោយមិនគិតពីថ្ងៃដែលខ្លួនចូលមកស្នាក់នៅពិតប្រាកដ។</p>
									<p>(៣) ភាគី <b>"អ្នកទិញ"</b> ត្រូវគោរពរាល់បទបញ្ជាផ្ទៃក្នុងសំរាប់ការគ្រប់គ្រងនៃបុរី ។</p>
									<p><b>ប្រការ៥៖ ការផ្លាស់ប្តូរដែលមិនបានរំពឹងទុក</b></p>
									<p>(១) អាចនឹងមានការផ្លាស់ប្តូរមួយចំនួនកើតមានចំពោះទំហំនៃចំណែកដី និងផ្ទះ ដែលទិញ និង/ឬដីដែលជាប់ពាក់ព័ន្ធដោយយោងទៅតាមការ</p>
									<p>អនុវត្តន៍ និងបទដ្ឋានរបស់	រាជរដ្ឋាភិបាលកម្ពុជា។ ទោះបីជាយ៉ាងណាក៏ដោយ ការប្រែប្រួលលើស ឬខ្វះដែលស្ថិតក្នុងរង្វង់ត្រឹមពីរម៉្រែការ៉េ នៃ</p>
									<p>ទំហំដី មិនត្រូវប៉ះពាល់ដល់តម្លៃនៃកិច្ចសន្យាឡើយ ។</p>
									<p>(២) លេខផ្ទះដែលទិញ អាចត្រូវបានផ្លាស់ប្តូរអាស្រ័យទៅតាមការប្រែប្រួលដែលមិនអាចរំពឹងទុកណាមួយនៃកាលៈទេសៈ ឬ បទបញ្ញាត្តិរបស់ រដ្ឋាភិបាល ។</p>
									<p><b>ប្រការ៦៖ ការធានា</b></p>
									<p>(១) ភាគី "អ្នកលក់" ផ្តល់ការធានាចំនួន ៣ឆ្នាំ សំរាប់ធ្នឹម សរសរ និង បេតុងនៃផ្ទះ ។</p>
									<p>(២) ទោះជាយ៉ាងណាក៏ដោយ ភាគី "អ្នកលក់" មិនទទួលខុសត្រូវចំពោះការប្រើប្រាស់ខុសបច្ចេកទេស ឬ ការគ្រប់គ្រងមិនត្រឹមត្រូវនៃផ្ទះដោយ ភាគី "អ្នកទិញ" ឡើយ ។ អ្នកទិញ ត្រូវ ធ្វើការងារជួសជុលដោយការចំណាយខ្លួនឯង។</p>
									<p><b>ប្រការ៧៖ បន្ទុកចំណាយ</b></p>
									<p> ប្រាក់សោហ៊ុយផ្ទេរសិទិ្ធកាន់កាប់ ប្រាក់ពន្ធលើការផ្ទេរសិទិ្ធកាន់កាប់ និងពន្ធប្រថាប់ត្រា រួមទាំងពន្ធអចលនវត្ថុប្រចាំឆ្នាំ គិតបន្ទាប់ពីការប្រគល់តាំង ឬ ក្រោយ៧ថ្ងៃចាប់គិតពីថ្ងៃ  ជូនដំណឹងស្តីពីការប្រគល់ទីតាំង  ជាបន្ទុកចំណាយរបស់ភាគីអ្នកទិញទាំងស្រុង ។រការ៨៖ ការជូនដំណឹង</p>
									<p>ភាគី <b>"អ្នកទិញ"</b> ត្រូវជូនដំណឹងទៅភាគី <b>”អ្នកលក់”</b> រាល់ការផ្លាស់ប្តូរទាំងឡាយនូវព័ត៌មានដូចជា អាស័យដ្ឋាន លេខទូរស័ព្ទ និង អាស័យដ្ឋានសារអេឡិចត្រូនិច ។ ប្រសិនបើភាគី "អ្នកទិញ" មិនបានធ្វើការជូនដំណឹងអោយបានទាន់ពេលវេលានោះទេ នោះភាគី "អ្នកទិញ" ត្រូវទទួលខុសត្រូវរាល់ការខូចខាតទាំងឡាយដែលកើតមានចំពោះភាគី "អ្នកលក់" ។ រាល់ការជូនដំណឹងទៅកាន់អាសយដ្ឋានសំរាប់ទំនាក់ទំនងត្រូវចាត់ទុកថាមានប្រសិទ្ធភាព នៅពេលការជូដំណឹងនោះបានផ្តល់ទៅទីកន្លែង ឬ សារអេឡិចត្រូនិច ដែលបានចុះបញ្ជីខាងលើ ។</p>
									<p><b>ប្រការ៩៖ ប្រាក់កម្ចីធនាគារ</b></p>
									<p>(១) ក្នុងករណីដែលភាគី <b>"អ្នកទិញ"</b> ចង់ធ្វើការបង់ប្រាក់មួយចំនួននៃទឹកប្រាក់ដែលត្រូវបង់តាមរយៈកម្ចីរបស់ធនាគារដែលរៀបចំដោយភាគី"អ្នកលក់"(ធនាគារកាណាឌីយ៉ា ក អ)នោះភាគី "អ្នកទិញ" ត្រូវធ្វើតាមរាល់ល័ក្ខខ័ណ្ឌចាំបាច់នានាដែលតម្រូវដោយធនាគារកាណាឌីយ៉ាសម្រាប់ រយៈពេលនៃប្រាក់កម្ចីពីធនាគារកាណាឌីយ៉ា និង ដាក់រាល់សំណុំឯកសារ  នានា ដែលតម្រូវដោយធនាគារកាណាឌីយ៉ាអោយបានទាន់ពេល វេលា ដោយមិនឲ្យលើសរយះពេល ១០ ថ្ងៃ គិតចាប់ថ្ងៃដែលបានបង់ប្រាក់គ្រប់ ៣០ភាគរយនៃតម្លៃកម្មវត្ថុនៃកិច្ច ព្រមព្រៀង។ ថ្លៃសេវានានា ដែលទាក់ទងនឹងការទទួលបានប្រាក់កម្ចីពីធនាគារគឺជាបន្ទុករបស់ភាគី<b>"អ្នកទិញ"</b>ហើយប្រាក់កម្ចីដែលផ្តល់អោយដោយធនាគារ នេះត្រូវតែបង់ទៅក្នុងគណនីធនាគាររបស់អ្នកលក់ ដូចដែលបានបញ្ជាក់នៅខាងដើមនៃកិច្ចព្រមព្រៀងនេះ។</p>
									<p>(២) ក្នុងករណីដែលភាគី"អ្នកទិញ"ទទួលបានប្រាក់កម្ចីពីធនាគារដទៃក្រៅពីធនាគារដែលបានរៀបចំដោយភាគី "អ្នកលក់"នោះភាគី <b>"អ្នកទិញ"</b>   ត្រូវធ្វើការជូនដំណឹងភ្លាមអំពីទឹកប្រាក់កម្ចីដែលខ្លួនទទួលបានព្រមទាំងឈ្មោះធនាគារ និងអាសយដ្ឋានរបស់ធនាគារទៅអោយភាគី "អ្នកលក់"។</p>
									<p>ភាគី <b>"អ្នកទិញ"</b> មិនត្រូវបង្កើតអោយមានបន្ទុក   ការដាក់បញ្ចាំណាមួយដោយមិនបានទទួលការឯកភាពជាលាយលក្ខណ៏អក្សរជាមុនពីភាគី "អ្នកលក់" ចំពោះចំណែកនៃផ្ទះ និង ដី នៅពេលមិនទាន់បានបង់ប្រាក់គ្រប់ចំនួនឡើយ ។</p>
									<p>(៣) រាល់ចំនួនទឹកប្រាក់ដែលទទួលបានដោយភាគី <b>"អ្នកទិញ"</b> ត្រូវតែផ្ទេរទៅកាន់គណនីធនាគារដែលបានជ្រើសរើសដើម្បីបង់ប្រាក់យោងតាមប្រការ១ ខាងលើ។</p>
									<p>(៤) ក្នុងករណីដែលភាគីអ្នកទិញយឺតយ៉ាវមិនបានផ្តល់ឯកសារតាមចំនុច ៩.១ ខាងលើ អោយបានទាន់ពេលវេលាកំណត់ដើម្បីអោយធនាគារ ក្សាផ្តល់ឥណទានជូនភាគីអ្នកទិញទេនោះ   ភាគីអ្នកទិញទទួលខុសត្រូវចំពោះការខូចខាតដែលកើតមានបណ្តាលមកពីការយឺតយ៉ាវ ។</p>
									<p>ប្រការ១០៖ ការផ្ទេរ ឬការបញ្ចាំកិច្ចព្រមព្រៀងទិញ-លក់</p>
									<p>ភាគី <b>"អ្នកទិញ"</b> មានសិទិ្ធក្នុងការផ្ទេរផ្ទះ និង ដីដែលខ្លួនបានទិញ</p>
									<p>(១) ភាគី <b>"អ្នកទិញ"</b> មានសិទិ្ធផ្ទេរ  <small style="color:red;font-size: 12px; font-family: 'khmer_osregular';">(មិនរួមបញ្ចូលចំពោះករណីអ្នកទិញជាជនបរទេស ដែលត្រូវអនុវត្តយ៉ាងខ្ជាប់ខ្ជួនតាមខចែងពិសេសដូចមាន ចែងនៅក្នុងកិច្ចព្រមព្រៀងនេះ) </small>ចំណែក</p>
									<p>ផ្ទះ និង ដី ឬដាក់បញ្ចាំចំណែកនៃផ្ទះ និង ដីកម្មសិទ្ធិរបស់ខ្លួនដើម្បីទទួលបានប្រាក់កម្ចីពីធនាគារកាណាឌីយ៉ា ក អ  (ធនាគារដែលផ្តល់ហិរញ្ញប្បទានដល់គំរោង បុរី ឃាង ហេង ) ។</p>
									<p>(២) តតីយជនដែលបានចុះហត្ថលេខានៅក្នុងឧបសម្ពន័្ធស្តីអំពី សិទ្ឋិនិងកាតព្វកិច្ចនៃកិច្ចព្រមព្រៀងផ្ទេរបន្ត ត្រូវយល់ព្រមទៅនឹងរាល់ប្រការទាំង ឡាយដែលបានធ្វើឡើងរវាងភាគី <b>"អ្នកលក់"</b> និងភាគី <b>"អ្នកទិញ"</b> ។</p>
									<p>(៣) រាល់ការចំណាយនានាដែលកើតមាននៅពេលដែលមានការផ្ទេរកិច្ចសន្យា ទិញ-លក់ គឺជាបន្ទុករបស់ភាគី <b>"អ្នកទិញ"</b> ។ ថ្លៃសេវានៃការផ្ទេរ</p>
									<p>សិទិ្ធនេះគឺ ៣០០ដុល្លាអាមេរិក។</p>
									<p><b>ប្រការ១១៖ ខ ចែងផ្សេងៗ</b></p>
									<p>(១) ភាគី <b>"អ្នកទិញ"</b> មិនអាចកែប្រែរចនាសម្ព័ន្ធ និង សោភ័ណភាពខាងក្រៅ នៃសំណង់ដែលបានទិញជាដាច់ខាត ។ រាល់ការសាងសង់បន្ថែម </p>
									<p>ឬ កែប្រែណាមួយ ភាគីអ្នកទិញត្រូវទទួលបានការឯកភាពយល់ព្រមជាលាយល័ក្ខអក្សរជាមុនពីភាគីអ្នកលក់ ។</p>
									<p>(២) កិច្ចសន្យានេះមានអានុភាពចំពោះសន្តតិជនរបស់គូភាគីផងដែរ ។</p>
									<p>(៣) កិច្ចព្រមព្រៀងនេះត្រូវបានធ្វើឡើងនិងបកស្រាយដោយអនុលោមទៅតាមច្បាប់ធរមាននៃព្រះរាជាណាចក្រកម្ពុជាហើយរាល់វិវាទទាំង ឡាយដែលកើតចេញពីកិច្ចព្រមព្រៀងនេះត្រូវដោះស្រាយ ដោយតុលាការមានសមត្ថកិច្ចតាមផ្លូវច្បាប់ ។</p>
									<p>(៤) កិច្ចព្រមព្រៀងនេះមិនអាចធ្វើការផ្លាស់ប្តូរ ឬកែប្រែដោយគ្មានការយល់ព្រមជាលាយលក្ខណ៍អក្សរពីភាគីទាំងពីរឡើយ ។</p>
									<p>(៥) កិច្ចព្រមព្រៀងនេះត្រូវបានធ្វើជាភាសាខ្មែរ ចំនួន០៣ច្បាប់ និង ភាសាអង់គ្លេស <small style="color:red;font-size: 12px; font-family: 'khmer_osregular';"> ចំនួន០៣ច្បាប់  </small>រក្សាទុកនៅ ៖</p>
									
								</td>
							</tr>
							<tr>
								<td colspan="2" style="font-size: 12px; font-family: 'khmer_osregular';">-  ភាគី <b>"អ្នកទិញ"</b>  <span style="display: inline-block"><input type="text" value="........................." class="form-control"></span> ចំនួន០១ច្បាប់ </td>
							</tr>
							<tr>
								<td colspan="2" style="font-size: 12px; font-family: 'khmer_osregular';">-  ភាគី <b>"អ្នកលក់"</b>  <span style="display: inline-block"><input type="text" value="........................." class="form-control"></span> ចំនួន០១ច្បាប់</td>
							</tr>
							<tr>
								<td colspan="2" style="font-size: 12px; font-family: 'khmer_osregular';">-  ធនាគារកាណាឌីយ៉ា  <span style="display: inline-block"><input type="text" value="........................" class="form-control"></span> ចំនួន០១ច្បាប់</td>
							</tr>
							<tr>
								<td colspan="2" style="font-size: 12px;font-family: 'khmer_os_siemreapregular';">
									<p><small style="color:red;font-size: 12px; font-family: 'khmer_osregular';">ក្នុងករណីមានភាពលំអៀង ឬ ខុសគ្នារវាងទាំងពីរភាសា   ឯកសារជាភាសាខ្មែរត្រូវបានយកជាគោល។</small></p>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<table class="table table-bordered last_bt_t">
										<tbody>
											<tr>
												<td class="pinkhead"> អ្នកលក់ “ ភាគី ក “</td>
												<td class="pinkhead">គំរោងផ្តល់ហិរញ្ញប្បទានដោយ</td>
												<td class="pinkhead">អ្នកទិញ “ ភាគី ខ “</td>
											</tr>
											<tr>
												<td><br><br><br><br><input type="text" value=" ..........................."  class="form-control">16/05/2019</td>
												<td><br><br><br><br><input type="text" value="......................"  class="form-control"></td>
												<td><br><br><br><br><input type="text"  class="form-control" value="........................."  >16/05/2019</td>
											</tr>
											
											
											<tr>
												<td><input type="text"  value="តំណាងដោយ ណា សុវណ្ណដា" class="form-control" style="font-size:9px"></td>
												<td><input type="text" style="font-size:9px"value="ធនាគារកាណាឌីយ៉ា"  class="form-control"></td>
												<td ><input type="text" style="font-size:9px" value="ជិន តារ៉ា" class="form-control"></td>
											</tr>
											
											
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
	</div>
	</section>
	<script>
function myFunction() {
    window.print();
}
</script>

	
		
		
		

