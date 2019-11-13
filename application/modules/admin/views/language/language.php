<link href="<?php echo base_url('assets/admin/plugins/datatables/dataTables.bootstrap.css')?>" rel="stylesheet" type="text/css" />
<!-- Content Header (Page header) -->
<style>
.row{
	margin-bottom:10px;
}
</style>
 <!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo lang('language')?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin/dashboard')?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
      
        <li class="active"><?php echo lang('language')?></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                   
                </div><!-- /.box-header -->
                <!-- form start -->
				
			
				<form method="post" enctype="multipart/form-data" >
                    <div class="box-body">
                        <div class="form-group">
                        	<div class="row">
                                <div class="col-md-3">
                                	<b><?php echo lang('language_name')?></b>
								</div>
								<div class="col-md-4">
                                    
									<input type="text" name="name" value="<?php echo @$lang->name?>" class="form-control" autocomplete="off">
                                </div>
                            </div>
                        </div>
						
						<div class="form-group">
                        	<div class="row">
                                <div class="col-md-3">
                                	<b><?php echo lang('icon')?>/ <?php echo lang('flag')?></b>
								</div>
								<div class="col-md-4">
                                    
									<input type="file" name="img"  class="form-control">
                                </div>
								<div class="col-md-4">
								<?php if(!empty($lang->flag)){ ?>
										<img src="<?php echo base_url('assets/admin/uploads/languages/'.$lang->flag) ?>" height="100" width="100" />
								<?php } ?>
								</div>
                            </div>
                        </div>
						
						<div class="form-group">
                        	<div class="row">
                                <div class="col-md-3">
                                	<b><?php echo lang('language_file')?></b>
								</div>
								<div class="col-md-4">
                                    
									<input type="file" name="php"  class="form-control" required>
                                </div>
								<div class="col-md-4">
								
								</div>
                            </div>
                        </div>
						
						<div class="form-group">
                        	<div class="row">
                                <div class="col-md-4">
                                	<b><?php echo lang('download_english_language_file')?></b>
								</div>
								<div class="col-md-2">
									<a href="<?php echo site_url('admin/languages/download') ?>" download class="btn btn-default" ><?php echo lang('download')?></a>
						        </div>
                            </div>
                        </div>
						
					<div class="form-group">
                        	<div class="row">				
								<div class="col-sm-4"></div>
								<div class="col-md-4">
		                        <button  type="submit" class="btn btn-primary"><?php echo lang('save')?></button>
            					</div>
							</div>
					</div>		
                <div class="box-body" style="margin-top:40px;">
                    <table id="example1" class="table-responsive table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th><?php echo lang('serial_number');?></th>
								<th><?php echo lang('name');?></th>
								<th width="30%"><?php echo lang('action');?></th>
                            </tr>
                        </thead>
                        
                        <?php if(isset($langs)):?>
                        <tbody>
                            <?php $i=1;foreach ($langs as $new){?>
                                <tr class="gc_row">
                                    <td><?php echo $i?></td>
                                    <td><?php echo $new->name?></td>
									
                                    <td>
                                        <div class="btn-group">
                                          <a class="btn btn-primary"  href="<?php echo site_url('admin/languages/download_lang/'.$new->name); ?>"><i class="fa fa-download"></i> <?php echo lang('download');?></a> 
										   <a class="btn btn-primary" style="margin-left:10px;" href="<?php echo site_url('admin/languages/index/'.$new->id); ?>"><i class="fa fa-edit"></i> <?php echo lang('edit');?></a>
									     <a class="btn btn-danger" style="margin-left:20px;" href="<?php echo site_url('admin/languages/delete/'.$new->id); ?>" onclick="return areyousure(this)"><i class="fa fa-trash"></i> <?php echo lang('delete');?></a>
									    </div>
                                    </td>
                                </tr>
                                <?php $i++;}?>
                        </tbody>
                        <?php endif;?>
                    </table>
					
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
</section>

<script src="<?php echo base_url('assets/admin/plugins/datatables/jquery.dataTables.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/plugins/datatables/dataTables.bootstrap.js')?>" type="text/javascript"></script><script type="text/javascript">
$(function() {
	$('#example1').dataTable({
	});
});

</script>