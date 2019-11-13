  <?php  $seg= $this->uri->segment(4);?>
<section class="content-header">
          <h1>
            <?php echo $page_title; ?>
           </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
			<li><a href="<?php echo site_url('admin/floors') ?>"> <?php echo lang('floors')?> </a></li>
            <li class="active"><?php echo (empty($seg))?lang('add'):lang('edit');?></li>
          </ol>
</section>
<section class="content">
		  <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body">
				<form method="post" action="<?php echo site_url('admin/floors/form/'.$id); ?>" enctype="multipart/form-data">	
					<div class="form-group">
					  <div class="row">
						<div class="col-md-4">
                      		<label><?php echo lang('name') ?></label>
							<input type="text" name="name" value="" class="form-control avoidsepcialcharacter" value="<?php if(!empty($name)){ echo $name ; } ?>"autocomplete='off'>
                      		
						</div>	
					  </div>		
                    </div>
					<div class="form-group">
					  <div class="row">
						<div class="col-md-4">
                      		<label><?php echo lang('ProjectsName') ?></label>
							<select name="ProjectsName" class="form-control chosen"     onchange="get_building(this.value)">
							<option ><?php echo lang('select')?></option>
                      		<?php
								if(isset($projects)){ foreach($projects as $project){?>
                                   <option value="<?php echo  $project->id  ?>" <?php if(!empty($ProjectsName)) echo $ProjectsName == $project->id ?'selected':''  ?>><?php  echo $project->Name  ?></option>
								<?php   }  }?>
								</select>
						</div>	
					  </div>		
                    </div>
					<div class="form-group">
					  <div class="row">
						<div class="col-md-4">
                      		<label><?php echo lang('building') ?></label>
							<select name="building_id" class="form-control"  id="building">
							<option ><?php echo lang('select')?></option>
							<?php  if(!empty($buildings)){ foreach($buildings  as $building){  ?>
				             <option value="<?php echo $building->bldid ?>" 
							 <?php if(!empty($building_id)) echo $building_id == $building->bldid ?'selected':''  ?>>
							 <?php echo $building->name ?></option>                      		<?php  } }  ?>
						</select>
						</div>	
					  </div>		
                    </div>
					<div class="form-group">
					  <div class="row">
						<div class="col-md-4">
                      		<label><?php echo lang('floor_number') ?></label>
                      		<?php
								$data	= array('name'=>'floor_no', 'value'=>set_value('floor_no', $floor_no), 'class'=>'form-control allownumber');
								echo form_input($data); ?>
						</div>	
					  </div>		
                    </div>
					<div class="form-group">
					  <div class="row">
						<div class="col-md-4">
                      		<label><?php echo lang('area') ?>(SFT)</label>
                      		<?php
								$data	= array('name'=>'area', 'value'=>set_value('area', $area), 'class'=>'form-control allowdecimalpoint');
								echo form_input($data); ?>
						</div>	
					  </div>		
                    </div>
					<div class="form-group">
					  <div class="row">
						<div class="col-md-4">
                      		<label><?php echo lang('shared_public_area') ?>(SFT)</label>
                      		<?php
								$data	= array('name'=>'shared_public_area', 'value'=>set_value('shared_public_area', $shared_public_area), 'class'=>'form-control allowdecimalpoint');
								echo form_input($data); ?>
						</div>	
					  </div>		
                    </div>
					<div class="form-group">
					  <div class="row">
						<div class="col-md-4">
                      		<label><?php echo lang('description') ?></label>
                      		<?php
								$data	= array('name'=>'description', 'value'=>set_value('description', $description), 'class'=>'form-control');
								echo form_textarea($data); ?>
						</div>	
					  </div>		
                    </div>
					<div class="form-group">
					  <div class="row">
						<div class="col-md-4">
                      		<label><?php echo lang('active') ?></label> &nbsp; &nbsp; 
                      		<input type="checkbox" name="active" value="1" <?php echo ($active==1)?'checked="checked"':'';?> />
						</div>	
					  </div>		
                    </div>
					<div class="class="box-footer"">
							<input class="btn btn-primary" type="submit" value="Save"/>
					</div>
					</form>
     			 </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div><!-- /.col -->
          </div><!-- /.row -->
        </section>
