<!-- <script type="text/javascript" src="<?php echo base_url('assets/admin')?>/plugins/chartjs/charts.js"></script>

<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/plugins/chartjs/core.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/plugins/themes/animated.js"></script> -->

<script src="https://www.amcharts.com/lib/4/core.js"></script>
<script src="https://www.amcharts.com/lib/4/charts.js"></script>
<script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>


<style>
	
.col-xs-offset-right-12 {
  margin-right: 100%;
}
.col-xs-offset-right-11 {
  margin-right: 91.66666667%;
}
.col-xs-offset-right-10 {
  margin-right: 83.33333333%;
}
.col-xs-offset-right-9 {
  margin-right: 75%;
}
.col-xs-offset-right-8 {
  margin-right: 66.66666667%;
}
.col-xs-offset-right-7 {
  margin-right: 58.33333333%;
}
.col-xs-offset-right-6 {
  margin-right: 50%;
}
.col-xs-offset-right-5 {
  margin-right: 41.66666667%;
}
.col-xs-offset-right-4 {
  margin-right: 33.33333333%;
}
.col-xs-offset-right-3 {
  margin-right: 25%;
}
.col-xs-offset-right-2 {
  margin-right: 16.66666667%;
}
.col-xs-offset-right-1 {
  margin-right: 8.33333333%;
}
.col-xs-offset-right-0 {
  margin-right: 0;
}
@media (min-width: 768px) {
  .col-sm-offset-right-12 {
    margin-right: 100%;
  }
  .col-sm-offset-right-11 {
    margin-right: 91.66666667%;
  }
  .col-sm-offset-right-10 {
    margin-right: 83.33333333%;
  }
  .col-sm-offset-right-9 {
    margin-right: 75%;
  }
  .col-sm-offset-right-8 {
    margin-right: 66.66666667%;
  }
  .col-sm-offset-right-7 {
    margin-right: 58.33333333%;
  }
  .col-sm-offset-right-6 {
    margin-right: 50%;
  }
  .col-sm-offset-right-5 {
    margin-right: 41.66666667%;
  }
  .col-sm-offset-right-4 {
    margin-right: 33.33333333%;
  }
  .col-sm-offset-right-3 {
    margin-right: 25%;
  }
  .col-sm-offset-right-2 {
    margin-right: 16.66666667%;
  }
  .col-sm-offset-right-1 {
    margin-right: 8.33333333%;
  }
  .col-sm-offset-right-0 {
    margin-right: 0;
  }
}
@media (min-width: 992px) {
  .col-md-offset-right-12 {
    margin-right: 100%;
  }
  .col-md-offset-right-11 {
    margin-right: 91.66666667%;
  }
  .col-md-offset-right-10 {
    margin-right: 83.33333333%;
  }
  .col-md-offset-right-9 {
    margin-right: 75%;
  }
  .col-md-offset-right-8 {
    margin-right: 66.66666667%;
  }
  .col-md-offset-right-7 {
    margin-right: 58.33333333%;
  }
  .col-md-offset-right-6 {
    margin-right: 50%;
  }
  .col-md-offset-right-5 {
    margin-right: 41.66666667%;
  }
  .col-md-offset-right-4 {
    margin-right: 33.33333333%;
  }
  .col-md-offset-right-3 {
    margin-right: 25%;
  }
  .col-md-offset-right-2 {
    margin-right: 16.66666667%;
  }
  .col-md-offset-right-1 {
    margin-right: 8.33333333%;
  }
  .col-md-offset-right-0 {
    margin-right: 0;
  }
}

@media (min-width: 1200px) {
	.container{
		width:  100%!important;
	}
  .col-lg-offset-right-12 {
    margin-right: 100%!important;
  }
  .col-lg-offset-right-11 {
    margin-right: 91.66666667%;
  }
  .col-lg-offset-right-10 {
    margin-right: 83.33333333%;
  }
  .col-lg-offset-right-9 {
    margin-right: 75%;
  }
  .col-lg-offset-right-8 {
    margin-right: 66.66666667%;
  }
  .col-lg-offset-right-7 {
    margin-right: 58.33333333%;
  }
  .col-lg-offset-right-6 {
    margin-right: 50%;
  }
  .col-lg-offset-right-5 {
    margin-right: 41.66666667%;
  }
  .col-lg-offset-right-4 {
    margin-right: 33.33333333%;
  }
  .col-lg-offset-right-3 {
    margin-right: 25%;
  }
  .col-lg-offset-right-2 {
    margin-right: 16.66666667%;
  }
  .col-lg-offset-right-1 {
    margin-right: 8.33333333%;
  }
  .col-lg-offset-right-0 {
    margin-right: 0;
  }
}
	
</style>
<style>

.show-grid {
    margin: 15px 0;
}

.huge {
    font-size: 40px;
}

.panel-green {
    border-color: #5cb85c;
}

.panel-green > .panel-heading {
    border-color: #5cb85c;
    color: #fff;
    background-color: #5cb85c;
}

.panel-green a {
    color: #5cb85c;
}

.panel-green a:hover {
    color: #3d8b3d;
}

.panel-red {
    border-color: #d9534f;
}

.panel-red > .panel-heading {
    border-color: #d9534f;
    color: #fff;
    background-color: #d9534f;
}

.panel-red a {
    color: #d9534f;
}

.panel-red a:hover {
    color: #b52b27;
}

.panel-yellow {
    border-color: #f0ad4e;
}

.panel-yellow > .panel-heading {
    border-color: #f0ad4e;
    color: #fff;
    background-color: #f0ad4e;
}

.panel-yellow a {
    color: #f0ad4e;
}

.panel-yellow a:hover {
    color: #df8a13;
}
	#chartdiv {
  width: 100%;
  height: 500px;
}
		#chartdiv1 {
  width: 100%;
  height: 500px;
}
</style>

<style>
	.content-wrapper, .right-side{background-color: #d2d6de;}
	figure{
	border: 1.5px solid #2c3542;
    padding: 20px;
    margin: 40px 0px;
    border-radius: 50px;
	}
	figure figcaption h3{font-size: 24px;color: #2c3542;font-weight: 600;}
	.number_notify{position: absolute;right: 10%;background-color: red;color: #fff;width: 50px;height: 50px;top: 10%;line-height: 50px;border-radius: 50px;font-size: 16px;}
	@media (max-width: 1366px) and (min-width: 1362px){
		figure img{width: 120px;height: 120px;}
		.number_notify{right: 13%;}
	}
		body,.content{
		background-color:#fff;
	}
	.col-half-offset{
    margin-left:4.166666667%;
}
figure figcaption h3{font-size:18px;}
@media (max-width: 1366px) and (min-width: 1362px)
figure img {
    width: 120px;
    height: 120px;
}
@media (max-width: 1280px) {
	figure img{width:100px;height:100px;}
	figure figcaption h3{font-size:16px!important;}
}
</style>
<section class="content dashboard_se">
		<div class="container">
		<div class="row">
			<div class="col-sm-12 col-xs-12">
				<h1 class="page-header">CRM Dashboard</h1>
			</div>
		</div>
		<div class="row">
		  <div class="col-lg-3 col-md-6">
			<div class="panel panel-primary">
			  <div class="panel-heading">
				<div class="row">
				  <div class="col-xs-3">
					<i class="fa fa-comments fa-5x"></i>
				  </div>
				  <div class="col-xs-9 text-right">
					<div class="huge"><?= $total_enquiry ?></div>
					<div>Enquiry!</div>
				  </div>
				</div>
			  </div>
			  <a href="#">
				<div class="panel-footer">
				  <span class="pull-left">View Details</span>
				  <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
				  <div class="clearfix"></div>
				</div>
			  </a>
			</div>
		  </div>
		  <div class="col-lg-3 col-md-6">
			<div class="panel panel-green">
			  <div class="panel-heading">
				<div class="row">
				  <div class="col-xs-3">
					<i class="fa fa-tasks fa-5x"></i>
				  </div>
				  <div class="col-xs-9 text-right">
					<div class="huge"><?= $followup_visitor ?></div>
					<div>Follow up!</div>
				  </div>
				</div>
			  </div>
			  <a href="#">
				<div class="panel-footer">
				  <span class="pull-left">View Details</span>
				  <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
				  <div class="clearfix"></div>
				</div>
			  </a>
			</div>
		  </div>
		  <div class="col-lg-3 col-md-6">
			<div class="panel panel-yellow">
			  <div class="panel-heading">
				<div class="row">
				  <div class="col-xs-3">
					<i class="fa fa-shopping-cart fa-5x"></i>
				  </div>
				  <div class="col-xs-9 text-right">
					<div class="huge"><?= $total_visitor ?></div>
					<div>Site visit!</div>
				  </div>
				</div>
			  </div>
			  <a href="#">
				<div class="panel-footer">
				  <span class="pull-left">View Details</span>
				  <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
				  <div class="clearfix"></div>
				</div>
			  </a>
			</div>
		  </div>
		  <div class="col-lg-3 col-md-6">
			<div class="panel panel-red">
			  <div class="panel-heading">
				<div class="row">
				  <div class="col-xs-3">
					<i class="fa fa-support fa-5x"></i>
				  </div>
				  <div class="col-xs-9 text-right">
					<div class="huge">13</div>
					<div>Trash!</div>
				  </div>
				</div>
			  </div>
			  <a href="#">
				<div class="panel-footer">
				  <span class="pull-left">View Details</span>
				  <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
				  <div class="clearfix"></div>
				</div>
			  </a>
			</div>
		  </div>
    	</div>
    
      <div class="row" style="margin-top: 30px;">
		  <div class="col-lg-6">
			<div class="panel panel-default">
			  <div class="panel-heading">
				<i class="fa fa-bar-chart-o fa-fw"></i> Followup
				<div class="pull-right">
				  <div class="btn-group">
					<button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
											Actions
											<span class="caret"></span>
										</button>
					<ul class="dropdown-menu pull-right" role="menu">
					  <li><a href="#">Action</a>
					  </li>
					  <li><a href="#">Another action</a>
					  </li>
					  <li><a href="#">Something else here</a>
					  </li>
					  <li class="divider"></li>
					  <li><a href="#">Separated link</a>
					  </li>
					</ul>
				  </div>
				</div>
			  </div>
			  <div class="panel-body">
				<div id="chartdiv"></div>
			  </div>
			</div>
		  </div>
  		<div class="col-lg-6">
			<div class="panel panel-default">
			  <div class="panel-heading">
				<i class="fa fa-bar-chart-o fa-fw"></i> Equality
				<div class="pull-right">
				  <div class="btn-group">
					<button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
											Actions
											<span class="caret"></span>
										</button>
					<ul class="dropdown-menu pull-right" role="menu">
					  <li><a href="#">Action</a>
					  </li>
					  <li><a href="#">Another action</a>
					  </li>
					  <li><a href="#">Something else here</a>
					  </li>
					  <li class="divider"></li>
					  <li><a href="#">Separated link</a>
					  </li>
					</ul>
				  </div>
				</div>
			  </div>
			  <div class="panel-body">
				<div id="chartdiv1"></div>
			  </div>
			</div>
      </div>
    </div>
	</div>
</section>
<script>
am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
var chart = am4core.create("chartdiv", am4charts.PieChart);

// Add data
chart.data = [{
  "country": "Lithuania",
  "litres": 501.9
}, {
  "country": "Czech Republic",
  "litres": 301.9
}, {
  "country": "Ireland",
  "litres": 201.1
}, {
  "country": "Germany",
  "litres": 165.8
}, {
  "country": "Australia",
  "litres": 139.9
}, {
  "country": "Austria",
  "litres": 128.3
}, {
  "country": "UK",
  "litres": 99
}, {
  "country": "Belgium",
  "litres": 60
}, {
  "country": "The Netherlands",
  "litres": 50
}];

// Add and configure Series
var pieSeries = chart.series.push(new am4charts.PieSeries());
pieSeries.dataFields.value = "litres";
pieSeries.dataFields.category = "country";
pieSeries.innerRadius = am4core.percent(50);
pieSeries.ticks.template.disabled = true;
pieSeries.labels.template.disabled = true;

var rgm = new am4core.RadialGradientModifier();
rgm.brightnesses.push(-0.8, -0.8, -0.5, 0, - 0.5);
pieSeries.slices.template.fillModifier = rgm;
pieSeries.slices.template.strokeModifier = rgm;
pieSeries.slices.template.strokeOpacity = 0.4;
pieSeries.slices.template.strokeWidth = 0;

chart.legend = new am4charts.Legend();
chart.legend.position = "right";

}); // end am4core.ready()
</script>
<script>
am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
var chart = am4core.create("chartdiv1", am4charts.XYChart);
chart.scrollbarX = new am4core.Scrollbar();

// Add data
chart.data = [{
  "country": "USA",
  "visits": 3025
}, {
  "country": "China",
  "visits": 1882
}, {
  "country": "Japan",
  "visits": 1809
}, {
  "country": "Germany",
  "visits": 1322
}, {
  "country": "UK",
  "visits": 1122
}, {
  "country": "France",
  "visits": 1114
}, {
  "country": "India",
  "visits": 984
}, {
  "country": "Spain",
  "visits": 711
}, {
  "country": "Netherlands",
  "visits": 665
}, {
  "country": "Russia",
  "visits": 580
}, {
  "country": "South Korea",
  "visits": 443
}, {
  "country": "Canada",
  "visits": 441
}];

// Create axes
var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "country";
categoryAxis.renderer.grid.template.location = 0;
categoryAxis.renderer.minGridDistance = 30;
categoryAxis.renderer.labels.template.horizontalCenter = "right";
categoryAxis.renderer.labels.template.verticalCenter = "middle";
categoryAxis.renderer.labels.template.rotation = 270;
categoryAxis.tooltip.disabled = true;
categoryAxis.renderer.minHeight = 110;

var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis.renderer.minWidth = 50;

// Create series
var series = chart.series.push(new am4charts.ColumnSeries());
series.sequencedInterpolation = true;
series.dataFields.valueY = "visits";
series.dataFields.categoryX = "country";
series.tooltipText = "[{categoryX}: bold]{valueY}[/]";
series.columns.template.strokeWidth = 0;

series.tooltip.pointerOrientation = "vertical";

series.columns.template.column.cornerRadiusTopLeft = 10;
series.columns.template.column.cornerRadiusTopRight = 10;
series.columns.template.column.fillOpacity = 0.8;

// on hover, make corner radiuses bigger
var hoverState = series.columns.template.column.states.create("hover");
hoverState.properties.cornerRadiusTopLeft = 0;
hoverState.properties.cornerRadiusTopRight = 0;
hoverState.properties.fillOpacity = 1;

series.columns.template.adapter.add("fill", function(fill, target) {
  return chart.colors.getIndex(target.dataItem.index);
});

// Cursor
chart.cursor = new am4charts.XYCursor();

}); // end am4core.ready()
</script>