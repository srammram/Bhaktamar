
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
     </div>
    <strong>Copyright &copy; <?php echo date('Y')?> <?php echo $this->setting->name?>.</strong> All rights
    reserved.
  </footer>
  
<!-- Bootstrap 3.3.6 -->




<script src="<?php echo base_url('assets/admin')?>/bootstrap/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url('assets/admin')?>/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/admin')?>/dist/js/app.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo base_url('assets/admin')?>/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="<?php echo base_url('assets/admin')?>/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo base_url('assets/admin')?>/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="<?php echo base_url('assets/admin')?>/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS 1.0.1 -->
<script src="<?php echo base_url('assets/admin')?>/plugins/chartjs/Chart.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- AdminLTE for demo purposes -->
<script src='<?php echo base_url('assets/admin')?>/dist/js/custom_js.js'></script>
<script src="<?php echo base_url('assets/plugin/moment.min.js')?>"></script>
<script src="<?php echo base_url('assets/admin/plugins/daterangepicker/daterangepicker.js')?>"></script>
<script src="<?php echo base_url('assets/admin/plugins/iCheck/icheck.min.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/') ?>/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url('assets/admin/plugins')?>/jquery-validation/jquery.validate.min.js"></script>
<script src='<?php echo base_url('assets/admin')?>/dist/js/forms_validation.js'></script>
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/customdatatable.js"></script>

<script>
$(".lang").click(function(e){
	  //alert(this.id);return false;
	  call_loader();
	$.ajax({
		url: '<?php echo site_url('admin/languages/switch_language') ?>',
		type:'POST',
		data:{id:this.id},
		success:function(result){
		//alert(result);return false;
			  if(result)
				{
					location.reload(); 
			   }
				else
				{
					remove_loader();
				}
		
		 }
	  });
	
	event.preventDefault();
});
function remove_loader()
{
	$('#overlay1').remove();
}
function call_loader(){
	
	if($('#overlay1').length == 0 ){
		var over = '<div id="overlay1">' +
						'<img  style="padding-top:300px; margin: 0 auto; " class="img-responsive " id="loading" src="<?php echo base_url('assets/admin/dist/img/ajax-loader.gif')?>"></div>';
		
		$(over).appendTo('body');
	}
}
</script>
<script>
	$(document).ready(function(){

    $(".navbar-nav .dropdown .login_head ").click(function() {
        $(".login_sec").toggle('slow');
    });
		 
});
//	$(".login_head").click(function() {
//  $(".login_sec").toggleClass('"show","hide"');
//});
</script>
<!--
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="Stylesheet" type="text/css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js" type="text/javascript"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js" type="text/javascript"></script>
<script>
$(function () {
    $("#Start_date").datepicker({
        minDate: "dateToday",
        changeMonth: true,
        dateFormat: 'dd-mm-yy',
        onClose: function (selectedDate, instance) {
            if (selectedDate != '') {
                $("#End_date").datepicker("option", "minDate", selectedDate);
                var date = $.datepicker.parseDate(instance.settings.dateFormat, selectedDate, instance.settings);
                date.setDate(date.getDate() + 6);
                console.log(selectedDate, date);
                $("#End_date").datepicker("option", "minDate", selectedDate);
                $("#End_date").datepicker("option", "maxDate", date);
            }
        }
    });
    $("#End_date").datepicker({
        minDate: "dateToday",
        changeMonth: true,
        dateFormat: 'dd-mm-yy',
        onClose: function (selectedDate) {
            $("#Start_date").datepicker("option", "maxDate", selectedDate);
        }
    });
});
</script>
-->

</body>
</html>
