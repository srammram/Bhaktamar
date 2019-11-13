<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/jquery.barCharts.css">
<?php  $seg= $this->uri->segment(4);?>
<style>
.barChart__label{float:none;font-size:18px;margin-bottom:25x;}
.barChart__bar,.barChart__barFill{border-radius:25px;}
.barChart__row{margin-bottom:30px;}
.box h4{padding-left:2%;margin-top:25px;font-size:20px;}
.barChart{margin-top:25px;}
</style>
<section class="content-header" style="padding: 15px 0px;">
  
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i>
                <?php echo lang('dashboard')?></a></li>
        <li><a href="<?php echo site_url('admin/project') ?>"> <?php echo lang('project')?> </a></li>
        
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
			 <h4><?php echo $page_title; ?></h4>
                <div class="box-body">
			<div class="barChart col-sm-6">
			<?php  if(!empty($chart_data)){ foreach($chart_data as $line){  ?>
        <div class="barChart__row" data-value="<?php  echo !empty(completedtask($projectid,$line->id))?(100/$line->task)*count(completedtask($projectid,$line->id)):0; ?>">
            <span class="barChart__label"><?php echo $line->name ;   ?></span>
            <span class="barChart__value"><?php  echo !empty(completedtask($projectid,$line->id))?(100/$line->task)*count(completedtask($projectid,$line->id)):0; ?>%</span>
            <span class="barChart__bar"><span class="barChart__barFill"></span></span>
        </div>
		<?php   } }?>
        <div class="barChart__row" data-value="90">
           <!-- <span class="barChart__label">HTML</span>
            <span class="barChart__value">80</span>
            <span class="barChart__bar"><span class="barChart__barFill"></span></span>-->
        </div>
        
       
       
                </div><!-- /.box -->
            </div>
        </div>
    </div>
</section>

<script src="<?php echo base_url('assets/admin')?>/dist/js/jquery.easing.min.js"></script>
<script src="<?php echo base_url('assets/admin')?>/dist/js/jquery.barChart.js"></script>


<script>
 jQuery('.barChart').barChart({easing: 'easeOutQuart'});
</script>