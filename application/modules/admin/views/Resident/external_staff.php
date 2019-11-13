<style>
.wizard {
    margin: 20px auto;
    background: #fff;
}
.wizard .nav-tabs {
    position: relative;
    margin: 40px auto;
    margin-bottom: 0;
    border-bottom-color: #e0e0e0;
}
.wizard .tab-content{background-color: #efefef;padding: 15px 15px;}
.wizard > div.wizard-inner {
    position: relative;
}
.connecting-line {
    height: 2px;
    background: #e0e0e0;
    position: absolute;
    width:69%;
    margin: 0 auto;
    left: 0;
    right: 0;
    top: 50%;
    z-index: 1;
}

.wizard .nav-tabs > li.active > a, .wizard .nav-tabs > li.active > a:hover, .wizard .nav-tabs > li.active > a:focus {
    color: #555555;
    cursor: default;
    border: 0;
    border-bottom-color: transparent;
}

span.round-tab {
    width: 30px;
    height: 30px;
    line-height: 30px;
    display: inline-block;
    border-radius: 0px;
    border: 2px solid #e0e0e0;
    z-index: 2;
    position: absolute;
    left: 0;
    text-align: center;
	background: #ccc;
	border-radius: 50px;
}
span.round-tab i{
    color:#555555;
}
.wizard li.active span.round-tab {
    background: #2c3542;
    border: 2px solid #999;
    color: #2c3542;
}
.wizard li.active span.round-tab i{
    color: #337ab7;
}

span.round-tab:hover {
    color: #333;
    border: 2px solid #333;
}

.wizard .nav-tabs > li {
    width: 33.33%;
}

.wizard li:after {
    content: " ";
    position: absolute;
    left: 47%;
    opacity: 0;
    margin: 0 auto;
    bottom: 0px;
    border: 5px solid transparent;
    border-bottom-color: #ccc;
    transition: 0.1s ease-in-out;
}

.wizard li.active:after {
    content: " ";
    position: absolute;
    left: 47%;
    opacity: 1;
    margin: 0 auto;
    bottom: 0px;
    border: 10px solid transparent;
    border-bottom-color: #2c3542;
}

.wizard .nav-tabs > li a {
    width: 30px;
    height: 30px;
    margin: 20px auto;
    border-radius: 0px;
    padding: 0;
}

.wizard .nav-tabs > li a:hover {
    background: transparent;
}
.wizard .tab-pane {
    position: relative;
    padding-top: 50px;
}
.wizard h3 {
    margin-top: 0;
}

@media( max-width : 585px ) {
    .wizard {
        width: 90%;
        height: auto !important;
    }

    span.round-tab {
        font-size: 16px;
        width: 50px;
        height: 50px;
        line-height: 50px;
    }
    .wizard .nav-tabs > li a {
        width: 50px;
        height: 50px;
        line-height: 50px;
    }

    .wizard li.active:after {
        content: " ";
        position: absolute;
        left: 35%;
    }
}
</style>
<section class="content-header">
          <h1>
            <?php echo $page_title; ?>
           </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
			<li><a href="<?php echo site_url('admin/Owner') ?>"><?php echo lang('Owner')?></a></li>
            <li class="active"><?php echo lang('view')?> <?php echo lang('Owner')?></li>
          </ol>
</section>


<section class="content">
		  <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body">
					<div class="booking_add">
							<div class="col-sm-12 col-xs-12">
							<div class="wizard">
            					<div class="wizard-inner">
                				<div class="connecting-line"></div>
									<ul class="nav nav-tabs" role="tablist">
										<li role="presentation" class="active">
											<a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Step1">
												<span class="round-tab">
													Unit Intergation
												</span>
											</a>
										</li>

										<li role="presentation" class="disabled">
											<a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Step2">
												<span class="round-tab">
													
												</span>
											</a>
										</li>
										<li role="presentation" class="disabled">
											<a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="Complete">
												<span class="round-tab">
													
												</span>
											</a>
										</li>
									</ul>
            					</div>
									<div class="tab-content">
										<div class="tab-pane active" role="tabpanel" id="step1">
											<div class="col-sm-12">
												<ul class="list-inline pull-right">
													<li><button type="button" class="btn btn-primary next-step">Save and continue</button></li>
												</ul>
											</div>
										</div>
										
										<div class="tab-pane" role="tabpanel" id="step2">
											<ul class="list-inline pull-right">
												<li><button type="button" class="btn btn-default prev-step">Previous</button></li>
												
												<li><button type="button" class="btn btn-primary btn-info-full next-step">Save and continue</button></li>
											</ul>
										</div>
										<div class="tab-pane" role="tabpanel" id="complete">
											<div class="col-sm-12 text-center">
												<ul class="list-inline">
													<li><button type="button" class="btn btn-default prev-step">Previous</button></li>
													<li><button type="submit" class="btn btn-primary next-step">Save </button></li>
												</ul>
											</div>
										</div>
										<div class="clearfix"></div>
									</div>
        					</div>
							</div>
				</div>
					
     			 </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div><!-- /.col -->
          </div><!-- /.row -->
        </section>
<script>
$(document).ready(function () {
//Wizard
$('a[data-toggle="tab"]').on('show.bs.tab', function (e) {
	var $target = $(e.target);
	if ($target.parent().hasClass('disabled')) {
		return false;
	}
});

$(".next-step").click(function (e) {
	var $active = $('.wizard .nav-tabs li.active');
	$active.next().removeClass('disabled');
	nextTab($active);

});
$(".prev-step").click(function (e) {
	var $active = $('.wizard .nav-tabs li.active');
	prevTab($active);

});
});

function nextTab(elem) {
$(elem).next().find('a[data-toggle="tab"]').click();
}
function prevTab(elem) {
$(elem).prev().find('a[data-toggle="tab"]').click();
}
</script>