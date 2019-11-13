<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap-datepicker.min.css">
<style>
<style>#exTab1 {
    margin: 15px 0px;
}

#exTab1 .tab-content {
    color: black;
    background-color: white;
    padding: 15px 15px;
    position: relative;
}


/* remove border radius for the tab */
#exTab1 .nav-pills>li+li {
    margin-left: 10px;
}

#exTab1 .nav-pills>li>a {
    border-radius: 0;
    background-color: #efefef;
    border: 1px solid #333;
}

#exTab1 .nav-pills>li.active>a,
#exTab1 .nav-pills>li.active>a:hover,
#exTab1 .nav-pills>li.active>a:focus {
    color: #fff;
    background-color: #428bca;
    border: 1px solid #333;
}

#add-table {
    position: absolute;
    right: 10px;
    padding: 3px;
    margin-top: 4px;
}

.table-responsive {
    border: 3px solid #333;
}

#test-body tr td {
    padding: 0px 0px;
}

.table_se_s table tbody tr td {
    padding:0px;
}

#foot_se tr td {
    padding: 0px 0px;
}

#test-body tr td .form-control {
    border: none;
    border-radius: 0px;
}

.table_se_s table tbody tr td .form-control {
    border: none;
    border-radius: 0px;
}

.table-bordered #foot_se tr td .form-control {
    border: none;
    border-radius: 0px;
}

#test-body tr td .form-control:focus {
    outline: none;
    box-shadow: none;
}

.table_se_s table tbody tr td .form-control:focus {
    outline: none;
    box-shadow: none;
}

.table-bordered #foot_se tr td .form-control:focus {
    outline: none;
    box-shadow: none;
}

.delete-row {
    position: absolute;
    right: 19px;
    margin-top: -26px;
    padding: 0px 4px;
}

.add-row {
    position: absolute;
    right: 19px;
    margin-top: -26px;
    padding: 0px 4px;
}

.table-bordered #foot_se tr td:first-child {
    border-right: none;
}
.th_head{background-color:#2c3542;color:#fff!important;padding:8px!important;}
@media print {
	body {
  -webkit-print-color-adjust: exact !important;
}
	.table tbody tr td.th_head {
    background:#2c3542!important;
    color: #fff!important;
    padding: 8px!important;
}
td.const_cost_est{background:#ccccfe!important;}
td.name_ct{background:#fffe99!important;}
}
</style>
</head>

<body>
    <div class="row">
        <div class="col-sm-12"><button id="print_btn" onclick="printpage();"
                class="btn btn-success btn-sm pull-right print_btn">Print out</button> </div>
    </div>
    <div class="col-sm-12">
        <div id="exTab1">

            <div class="tab-content clearfix">
                <div class="tab-pane active" id="1a">
                    <div class="table-responsive">
                        <table class="table table-bordered" style="margin-bottom: 0px;table-layout:fixed;">
                            <tr>
                                <td colspan="2" align="center" bgcolor="#ccccfe" class="const_cost_est" style="font-size: 24px;">Construction
                                    Cost Estimate Worksheet</td>
                            </tr>
                            <tr bgcolor="#313131">
                                <td align="center" style="color: #fff;padding: 3px 8px;">Project Name</td>
                                <td align="left" style="color: #fff;padding: 3px 8px;padding-left:15%;"><?php echo  $project->Name ; ?></td>
                            </tr>
                            <tr>
                                <td style="font-size: 16px;font-weight: bold"><?php echo  $project->address ;?></td>
                                <td style="font-size: 16px;font-weight: bold"><?php echo  $project->Name ;?></td>
                            </tr>
                        </table>
                        <table class="table table-bordered" style="table-layout: fixed;margin-bottom: 0px;">
                            <thead>
                                
                            </thead>
                        </table>

                        <div id="test_table" class="table_se_s">
                            <table class="table table-bordered" style="table-layout: fixed;margin-bottom: 0px;">
                                <tbody class="clone_row">
								<?php  $i=1;$grand_stagewise_cost_total =0;
											$grand_stagewise_d_price_total =0;
											$grand_stagewise_total_variance_total =0; if(!empty($stage)){ foreach($stage as $row){ ?>
                                    <tr>
                                        <td colspan="6" bgcolor="#fffe99" class="name_ct"><input type="text" class="form-control"
                                                value="<?php  echo $i.'.'.$row->Name ; ?>"
                                                style="background-color: #fffe99;font-weight: bold;font-size: 16px;"
                                                readonly></td>
                                    </tr>
									<?php  
									        $cost_total=0;
										    $d_price_total=0;
										    $total_variance=0;
											$stagewise_cost_total=0;
											$stagewise_d_price_total=0;
											$stagewise_total_variance_total=0;

									$tasks=stagesWiseTask($project->id,$row->id); 
											if(!empty($tasks)){ foreach($tasks as $task){
											?>
									 <tr>
                                        <td colspan="6" align="center" class="name_ct"  style="font-weight:bold;"bgcolor="#fffe99"><?php echo $task->taskName;  ?></td>
                                    </tr>
									 <tr >
                                    <td class="th_head">Description</td>
                                    <td class="th_head">Unit</td>
                                    <td class="th_head">Price</td>
                                    <td class="th_head">Draw Unit</td>
                                    <td class="th_head">Draw Price</td>
                                    <td class="th_head">Variance Price</td>
                                </tr>
									<?php   $sheets=taskwise_costing($project->id,$row->id,$task->id); 
											if(!empty($sheets)){ 
												foreach($sheets as $sheet){
												$cost_total +=$sheet->cost;
												$d_price_total +=$sheet->d_price;
												$variance= ($sheet->cost-$sheet->d_price);
												$total_variance +=$variance;
											?>
									
                                 
                                        <td>
										<?php  if($sheet->material_id !=0){ ?>
										<?php $q=$this->db->get_where("material",array("id"=>$sheet->material_id));
										if($q->num_rows()>0){
											$material=$q->row();
											echo $material->Name;
										}
										?>
										<?php  }else{  ?>
										<?php echo $sheet->Name ; ?>
										<?php  }   ?>
                                          
                                        </td>
                                        <td>
                                         <?php echo $sheet->unit ; ?>
                                        </td>

                                        <td>
                                          <?php echo $this->sma->formatMoney($sheet->cost) ; ?>
                                        </td>
                                        <td>
                                          <?php echo $sheet->d_unit ; ?>
                                        </td>
                                        <td>
                                           <?php echo $this->sma->formatMoney($sheet->d_price) ; ?>
                                        </td>
                                        <td>
										<?php   
										if($variance>0){
											echo '<small style="color:green;">'.$this->sma->formatMoney($variance).'</small>';
										}else{
											echo '<small style="color:red;">'.$this->sma->formatMoney(str_replace( '-', '', $variance )).'</small>';
										}
										?>
                                           
                                        </td>
                                    </tr>
									
											<?php } }  ?>
											 <tr>
                                        <td class="text-right" colspan="1"></td>
										 <td class="text-right"><input type="text" class="form-control"
                                                style="font-weight:bold;font-size:11px;" value="<?php echo $task->taskName;  ?> Total" readonly></td>
                                        <td><input type="text" style="font-weight:bold;" class="form-control"
                                                value="<?php echo $this->sma->formatMoney($cost_total);  ?>" readonly></td>
												  <td style="background:#eee"></td>
                                        <td><input type="text" style="font-weight:bold;" class="form-control"
                                                value="<?php echo $this->sma->formatMoney($d_price_total);  ?>" readonly></td>
                                        <td style="font-weight:bold;background-color:#eee;"><?php
												if($total_variance>0){
											      echo '<small style="color:green;">'.$this->sma->formatMoney($total_variance).'</small>';
										           }else{
											        echo '<small style="color:red;">'.$this->sma->formatMoney(str_replace( '-', '', $total_variance )).'</small>';
										      }
										?></td>
                                    </tr>
											<?php  }}   ?>
											<?php 
											$stagewise_cost_total +=$cost_total;
											$stagewise_d_price_total +=$d_price_total;
											$stagewise_total_variance_total +=$total_variance;

											?>
											<td class="text-right" colspan="1"></td>
										 <td class="text-right"><input type="text" class="form-control"
                                                style="font-weight:bold;font-size:11px;" value="<?php echo $row->Name;  ?> Total" readonly></td>
                                        <td><input type="text" style="font-weight:bold;" class="form-control"
                                                value="<?php echo $this->sma->formatMoney($stagewise_cost_total);  ?>" readonly></td>
												  <td style="background:#eee"></td>
                                        <td><input type="text" style="font-weight:bold;" class="form-control"
                                                value="<?php echo $this->sma->formatMoney($stagewise_d_price_total);  ?>" readonly></td>
                                        <td style="font-weight:bold;background-color:#eee;"><?php
												if($stagewise_total_variance_total>0){
											      echo '<small style="color:green;">'.$this->sma->formatMoney($stagewise_total_variance_total).'</small>';
										           }else{
											        echo '<small style="color:red;">'.$this->sma->formatMoney(str_replace( '-', '', $stagewise_total_variance_total )).'</small>';
										      }
										?></td>
                                    </tr>
											
											
								<?php $i++;
												
											$grand_stagewise_cost_total +=$stagewise_cost_total;
											$grand_stagewise_d_price_total +=$stagewise_d_price_total;
											$grand_stagewise_total_variance_total +=$stagewise_total_variance_total;
								}   }  ?>
                                   

                                    <tr>
                                        <td colspan="6" bgcolor="#bfbfbf"><input type="text" class="form-control"
                                                style="background-color: #c0c0c0;font-weight: bold;font-size: 16px;"
                                                readonly></td>
                                    </tr>
                                    <tr>
                                      <td class="text-right" colspan="1"></td>
										 <td class="text-right"><input type="text" class="form-control"
                                                style="font-weight:bold;font-size:11px;" value="Grand Total" readonly></td>
                                        <td><input type="text" style="font-weight:bold;" class="form-control"
                                                value="<?php echo $this->sma->formatMoney($grand_stagewise_cost_total);  ?>" readonly></td>
												  <td style="background:#eee"></td>
                                        <td><input type="text" style="font-weight:bold;" class="form-control"
                                                value="<?php echo $this->sma->formatMoney($grand_stagewise_d_price_total);  ?>" readonly></td>
                                        <td style="font-weight:bold;background-color:#eee;"><?php
												if($grand_stagewise_total_variance_total>0){
											      echo '<small style="color:green;">'.$this->sma->formatMoney($grand_stagewise_total_variance_total).'</small>';
										           }else{
											        echo '<small style="color:red;">'.$this->sma->formatMoney(str_replace( '-', '', $grand_stagewise_total_variance_total )).'</small>';
										      }
										?></td>
                                    </tr>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    function printpage() {
        var printButton = document.getElementById("print_btn");
        printButton.style.visibility = 'hidden';
        window.print()
        printButton.style.visibility = 'visible';
    }
    </script>
    </script>
</body>

</html>