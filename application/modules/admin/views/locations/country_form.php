<?php  $seg= $this->uri->segment(4);?>
<section class="content-header">
          <h1>
            <?php echo $page_title; ?>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
			<li><a href="<?php echo site_url('admin/locations') ?>"> <?php echo lang('countries') ?></a></li>
            <li class="active"><?php echo (empty($seg))?lang('add'):lang('update');?></li>
          </ol>
</section>


<section class="content">
		  <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body">
						<?php echo form_open('admin/locations/country_form/'.$id); ?>

					<fieldset>
							
							<div class="form-group">
							  <div class="row">
								<div class="col-md-12">
								<label for="name"><?php echo lang('name');?></label>
									<?php
									$data	= array('name'=>'name', 'value'=>set_value('name', $name), 'class'=>'form-control' 'autocomplete="off"');
									echo form_input($data);
									?>

								</div>	
							  </div>		
							</div>
							<div class="form-group">
							  <div class="row">
								<div class="col-md-12">
								<label for="name"><?php echo lang('sortname');?></label>
									<?php
									$data	= array('name'=>'sortname', 'value'=>set_value('sortname', $sortname), 'class'=>'form-control');
									echo form_input($data);
									?>

								</div>	
							  </div>		
							</div>
														
					
					<div class="form-actions">
						<button type="submit" class="btn btn-primary"><?php echo lang('save');?></button>
					</div>
					</form>



				 </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div><!-- /.col -->
          </div><!-- /.row -->
        </section>



<script type="text/javascript">
$('form').submit(function() {
	$('.btn').attr('disabled', true).addClass('disabled');
});
</script>