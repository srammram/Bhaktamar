<link href="<?php echo base_url('assets/admin/plugins/iCheck/all.css')?>" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap-datepicker.min.css">
<style>
#weekchart{
  width: 100%;
  height: 500px;
}
#monthchart{
  width: 100%;
  height: 500px;
}
#yearchart{
  width: 100%;
  height: 500px;
}
#customchart{
  width: 100%;
  height: 500px;
}
.amcharts-export-menu-top-right {
  top: 10px;
  right: 0;
}
.amcharts-chart-div a{display:none !important}
</style>
<section class="content">
<div class="col-sm-12">
<div class="box">
   <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-heart"></i><?php  echo $page_title;    ?>      </h2>
        <div class="box-icon">
            <ul class="btn-tasks">
                <li class="dropdown">
                    <a href="javascript:void(0);" id="xls" class="excel_report" title="Download as XLS">
                        <i class="icon fa fa-file-excel-o"></i>
                    </a>
                </li>
             <!--   <li class="dropdown">
                    <a href="#" id="image" class="tip" title="Save as Image" data-original-title="Save as Image">
                        <i class="icon fa fa-file-picture-o"></i>
                    </a>
                </li>-->
            </ul>
        </div>
    </div>
    <div class="box-content">
        <div class="row">
           <div class="col-sm-12" >
                <p class="introtext">Please customize the report below</p>
                <div id="form" style="">
						<div class="col-md-2">
                            <div class="form-group">
                                <label for="Mode">Mode</label>
								<select name="Mode" class="form-control" data-placeholder="Select Mode" id="Mode"  >
								<option >--</option>
								<option value="1">Active</option>
								<option value="2">InActive</option>
								
								</select>
                            </div>
                        </div>
                      
						<div class="col-sm-1">
                            <div class="form-group">
                             <label for="Show">Show</label>                               
							 <select name="pagelimit" class="form-control" id="pagelimit" style="width: 100px;" >
                                    <option value=""></option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="4">4</option>
                                    <option value="10" selected="selected">10</option>
                                    <option value="15">15</option>
                                    <option value="30">30</option>
                                    <option value="100">100</option>
                                    <option value="0">All</option>
                                </select>                               
                            </div>
                        </div>
                    <div class="form-group col-sm-12">
                        <div class="controls"> <input type="submit" name="submit_report" value="Submit" class="btn btn-primary bill_details">
 
                        </div>
                    </div>
                </div>
                    <!-- </form> -->
                <div class="clearfix"></div>
                <div class="col-sm-12 table-responsive">
                    <table id="ReportDetailsData" class="table table-bordered table-hover table-striped table-condensed reports-table">
                       <thead>
                          <tr>
                              <th>s.no</th>
                              <th>Client Name</th>
                              <th>Unit Number</th>
								<th>Building</th>
                              <th>Address</th>
                              <th>Contact</th>
                             <th>Email</th>
							 
                          </tr>
                        </thead>
                        <tbody><tr><td colspan="9" class="dataTables_empty">No data available in table</td></tr></tbody>                   
                    </table>
                    <div class="col-md-6 text-right" style="float:right">
                        <div class="dataTables_paginate paging_bootstrap"></div>
                    </div>
                </div>
           </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    var $offset = false;
   /*     $(document).ready(function () {
    /*     $('#pdf').click(function (event) {
            event.preventDefault();
			var path1="<?php echo  base_url('admin/reports/getReports/0/xls/?v=1'.$v)?>";
            window.location.href = path1;
            return false;
        }); */
       /*  $('#xls').click(function (event) {
            event.preventDefault();
			var $url="<?php echo  base_url('admin/reports/getReports/xls')?>";
             GetData($url);
            return false;
        }); */
      /*  $('#image').click(function (event) {
			alert('sddss');
            event.preventDefault();
            html2canvas($('.box'), {
                onrendered: function (canvas) {
                    openImg(canvas.toDataURL());
                }
            });
            return false;
        });
    }); */
        $(document).on('click', '.pagination a',function(e){
            e.preventDefault();
            $url = '<?php echo  base_url('admin/reports/get_client_reports')?>';
            $url_seg = $url.split('/');
            $count = $url_seg.length-1;  
			alert($count);			
            $offset = (isNaN($url_seg[$count]))?false:$url_seg[$count];
            GetData($url);
            return false;
        });
        $(document).on('click', '.bill_details', function () {
            $offset = false;
            $url = '<?php echo  base_url('admin/reports/get_client_reports')?>';
            GetData($url);
        });

        $(document).on('change', '#pagelimit', function () {
            $offset = false;
             $url = '<?php echo  base_url('admin/reports/get_client_reports')?>';
            GetData($url);
        });
            $url = '<?php echo  base_url('admin/reports/get_client_reports')?>';
       

function GetData($url){              

    var Mode = $('#Mode').val();
    var pagelimit = $('#pagelimit').val();
	var tt='<?php echo $settings->cur_symbol;   ?>';
	
                    
        
                  $.ajax({
                        type: 'POST',
                        url: $url,
                        data: {Mode : Mode,pagelimit:pagelimit},
                        dataType: "json",
                        success: function (data) {
                            $('#ReportDetailsData > tbody').empty();
                            if(data.reports =='empty' || data.reports == 'error'){
                            $('#ReportDetailsData > tbody').append('<tr><td colspan="9" class="dataTables_empty">No data available in table</td></tr>');    
                            }
                            else{
                                $('.dataTables_paginate').html(data.pagination);
                                 var $row_index = ($offset) ?parseInt($offset)+parseInt(1):1;
                                $.each(data.reports, function (a,b) 
                                {
                                      $html = '<tr>';
                                      $html +='<td>'+$row_index+'</td>';
                                      $html +='<td>'+b.applicant_name+'</td>';
                                      $html +='<td>'+b.unit_no+'</td>';
                                      $html +='<td>'+b.name+'</td>';
                                      $html +='<td>'+b.address+'</td>';                                   
                                      $html +='<td>'+b.contactno+'</td>';
									  $html +='<td>'+b.email+'</td>';
                                      $html +='</tr>';
                                      $('#ReportDetailsData > tbody').append($html);
                                      $row_index++;
                                });

                           } 
                        }
                    });
    
}   

</script>
<style>
    tr.table_whitelisted{
        color: red;
    }
</style>

</div>
</section>
<script>
function formatSA (x) {
    x=x.toString();
    var afterPoint = '';
    if(x.indexOf('.') > 0)
       afterPoint = x.substring(x.indexOf('.'),x.length);
    x = Math.floor(x);
    x=x.toString();
    var lastThree = x.substring(x.length-3);
    var otherNumbers = x.substring(0,x.length-3);
    if(otherNumbers != '')
        lastThree = ',' + lastThree;
    var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree + afterPoint;

    return res;
}
function formatMoney(x, symbol) {
	var currencysymbol=<?php echo $settings->cur_symbol;   ?>;
	var display_symbol=<?php echo $settings->display_symbol;   ?>;
	var decimals =<?php echo  $settings->decimals;   ?>;
	var thousands_sep ='<?php echo $settings->thousands_sep;   ?>';
	var decimals_sep ='<?php echo $settings->decimals_sep;   ?>';
	var sac ='<?php echo $settings->sac;   ?>';
    if(!symbol) { symbol = ""; }
    if(sac == 1) {
        return (display_symbol == 1 ? currencysymbol : '') +
            ''+formatSA(parseFloat(x).toFixed(decimals)) +
            (display_symbol == 2 ? currencysymbol : '');
    }
    var fmoney = accounting.formatMoney(x, symbol, decimals,thousands_sep == 0 ? ' ' : thousands_sep, decimals_sep);
   
	return fmoney; 
   /*  return (display_symbol == 1 ? <?php echo $settings->symbol;   ?> : '') +
        fmoney +
        (display_symbol == 2 ? <?php echo $settings->symbol;   ?> : ''); */
}
</script>

<script src="<?php echo base_url('assets/admin/dist/js/jquery.table2excel.min.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/plugins/datatables/jquery.dataTables.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/plugins/datatables/dataTables.bootstrap.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/') ?>/plugins/datepicker/bootstrap-datepicker.js"></script>

<script>
	$(document).ready(function() {
		$('#paymenttype').select2();
		$('#pagelimit').select2();
	});
</script>
<script type="text/javascript">
$("#xls").click(function(){
      $("#ReportDetailsData").table2excel({
        exclude: ".noExl",
        name: "Worksheet Name",
        filename: "Client_report" //do not include extension

      });
	   });

</script>