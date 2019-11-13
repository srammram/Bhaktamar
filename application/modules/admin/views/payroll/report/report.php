<div class="row report-listing">
    <div class="col-md-6  ">
        <div class="panel">
            <div class="panel-body">
                <div class="list-group parent-list">
                    <h3 id="right_heading" class="page-header text-info"><i class="icon ti-angle-double-left"></i><?= lang('report_category') ?></h3>
                    <?php if($this->ion_auth->in_group(array('admin'))){ ?>
                    <a href="#" class="list-group-item" id="employee"><?= lang('employee') ?></a>
                    <?php } ?>
                 <?php if($this->ion_auth->in_group(array('admin'))){ ?>
                    <a href="#" class="list-group-item" id="attendance"><?= lang('attendance') ?></a>
                    <?php } ?>
                    <?php if($this->ion_auth->in_group(array('admin'))){ ?>
                    <a href="#" class="list-group-item" id="Leave"><?= lang('Leave') ?></a>
                <a href="#" class="list-group-item" id="roster"><?= lang('rosterReport') ?></a>
                 
                    <?php } ?>
<!--                    <a href="#" class="list-group-item" id="assets">Assets</a>-->

                </div>
            </div>
        </div> <!-- /panel -->
    </div>
    <div class="col-md-6" id="report_selection">
        <div class="panel">
            <div class="panel-body child-list">
                <h3 id="right_heading" class="page-header text-info"><i class="icon ti-angle-double-left"></i><?= lang('make_a_selection') ?></h3>
                <?php if($this->ion_auth->in_group(array('admin','accounts','hr'))){ ?>
                <div class="list-group employee hidden">
                    <a href="<?php echo site_url('admin/reports/employeeList')?>" class="list-group-item"><i class="icon ti-receipt"></i> <?= lang('employee_list') ?> </a>
                </div>
                <?php } ?>
              <?php if($this->ion_auth->in_group(array('admin'))){ ?>
                <div class="list-group attendance hidden">
                    <a href="<?php echo site_url('admin/reports/PunchMonitor')?>" class="list-group-item"><i class="icon ti-bar-chart-alt"></i><?= lang('Punch_monitor') ?></a>
                </div>
                <?php } ?>
                <?php if($this->ion_auth->in_group(array('admin'))){ ?>
                <div class="list-group Leave hidden">
                    <a href="<?php echo site_url('admin/reports/leaveReport')?>" class="list-group-item"><i class="icon ti-bar-chart-alt"></i> <?= lang('MonthWiseLeaveReport') ?> </a>
                </div>
                <?php } ?>
				
				 <?php if($this->ion_auth->in_group(array('admin'))){ ?>
                <div class="list-group roster hidden">
                    <a href="<?php echo site_url('admin/reports/Monthroster')?>" class="list-group-item"><i class="icon ti-bar-chart-alt"></i> <?= lang('MonthRoster') ?> </a>
                </div>
                <?php } ?>


            </div>
        </div> <!-- /panel -->
    </div>
</div>

<script type="text/javascript">
    $('.parent-list a').click(function(e){
        e.preventDefault();
        $('.parent-list a').removeClass('active');
        $(this).addClass('active');
        var currentClass='.child-list .'+ $(this).attr("id");
        $('.child-list .page-header').html($(this).html());
        $('.child-list .list-group').addClass('hidden');
        $(currentClass).removeClass('hidden');
        $('#right_heading').addClass('active');
        $('html, body').animate({
            scrollTop: $("#report_selection").offset().top
        }, 500);
    });
</script>