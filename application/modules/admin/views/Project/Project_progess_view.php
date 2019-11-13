<style>
    .content-element {
        margin: 50px 0 0 50px;
    }
    
    .circles-list ol {
        list-style-type: none;
        margin-left: 1.25em;
        padding-left: 2.5em;
        counter-reset: li-counter;
        border-left: 1px solid #00c4cc;
        position: relative;
    }
    
    .circles-list ol > li {
        position: relative;
        margin-bottom: 3.125em;
        clear: both;
    }
    
    .circles-list ol > li:before {
        position: absolute;
        top: -0.5em;
        font-family: "Open Sans", sans-serif;
        font-weight: 600;
        font-size: 1em;
        left: -3.75em;
        width: 2.25em;
        height: 2.25em;
        line-height: 2.25em;
        text-align: center;
        z-index: 9;
        color: #00c4cc;
        border: 2px solid #00c4cc;
        border-radius: 50%;
        content: counter(li-counter);
        background-color: #ebeced;
        counter-increment: li-counter;
    }
</style>

<section class="content-header">
    <h1>
            <?php echo $page_title; ?>
           </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
        <li>
            <a href="<?php echo site_url('admin/Project') ?>">
                <?php echo lang('Project')?>
            </a>
        </li>
        <li class="active">
            <?php echo lang('view')?>
                <?php echo lang('Project')?>
        </li>
    </ol>
</section>

<section class="prj_estimation_plan" style="padding: 30px 0px;background: #ecf0f5;">

    <div class="">
        <div class="well col-sm-12">
            <div class="row" style="background-color:#fff;">
                <div class="col-sm-12 col-xs-12">

                    <div class="text-element content-element circles-list">
                        <ol>
						<?php   if(isset($projectsstages)){ foreach($projectsstages as $projectsstage){  ?>
                            <li>
							<?php   $timeline=$this->db->get_where('Project_estimation_plan',array('project_id'=>$id,'Stage_id'=>$projectsstage->id))->row(); 
							
                                 $EstimatedTimeline= isset($timeline->ActualTime)? isset($timeline->TotalEstimateTime)? (($timeline->ActualTime/ $timeline->TotalEstimateTime)*100) : 0 : 0;
                                 $ActualTimeline= isset($timeline->ActualTime)? isset($timeline->TotalEstimateTime)? (($timeline->TotalEstimateTime/ $timeline->ActualTime)*100) : 0 : 0;
								 
							?>
						
                                <h3><?php echo $projectsstage->Name;   ?>  <?php echo lang('Timeline')?> </h3>
								<?php echo lang('Estimated')?> 
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" <?php echo isset($timeline->ActualTime) ?'style="width:'.round($EstimatedTimeline,2).'%;"': (!empty($timeline->TotalEstimateTime) && empty($timeline->ActualTime))?'style="width:100%;': 'style="width:0%;';   ?> aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo isset($timeline->TotalEstimateTime)? '100%': '0%';    ?></div>
                                </div><?php echo lang('Actual')?> 
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" <?php echo 'style="width:'.round($ActualTimeline,2).'%;"'   ?> aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo   round($ActualTimeline,2).'%' ;?></div>
                                </div>
                            </li>
							<a href="<?php echo site_url('admin/Project/ProjectProgressPlanner/'.$id.'/'.$projectsstage->id); ?>"><button class="btn"><?php echo lang('Progress_planner')?> >></button>
						<?php  }  }else{ 'No Stage Found' ;  }  ?>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
    </div>

</section>