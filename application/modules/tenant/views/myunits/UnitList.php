<link href="<?php echo base_url('assets/admin/plugins/datatables/dataTables.bootstrap.css')?>" rel="stylesheet"
    type="text/css" />
<style>
</style>
<section class="content-header">
    <h1>
        <?php echo $page_title; ?>
        <small><?php echo lang('list'); ?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i>
                <?php echo lang('dashboard')?></a></li>
        <li><a href="<?php echo site_url('myunits') ?>"> <?php echo lang('myunits')." ".lang('list') ?> </a></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="btn-group pull-right">
               <h1></h1>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"> <?php echo $page_title; ?>
                    </h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-striped" id="example1">
                        <thead>
                                    <tr>
                                        <th><?= lang("id"); ?></th>
                                        <th><?php echo lang('project'); ?></th>
                                        <th><?php echo lang('building'); ?></th>
                                        <th><?php echo lang('Floors'); ?></th>
                                        <th><?php echo lang('unit'); ?></th>
                                        <th><?php echo lang('Intension'); ?></th>
                                        <th><?php echo lang('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php   if(!empty($activeunits)){ $i=0;
							foreach($activeunits as $row){ $i++; ?>
                                    <tr>
									<td ><?php   echo $i; ?></td>
                                        <td ><?php  echo $row->project  ;  ?></td>
										<td ><?php  echo $row->building  ;  ?></td>
										<td ><?php  echo $row->floors  ;  ?></td>
										<td ><?php  echo $row->unit_name  ;  ?></td>
										<td ></td>
										<td ><?php    if(!empty($row->book_status) && ($row->book_status==1)){   ?>
										
										<?php   }else{   ?>
										
											<div class="dropdown text-left"><button type="button" class="btn btn-default btn-xs btn-primary dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:#fff;"><?php echo lang('action'); ?> <span class="caret"></span></button>
                                      <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenuButton">
				                       <?php   foreach($unitrequest as $request){ ?>
										<li><a href="<?php echo site_url('owner/Myunits/'. $request->link .'/'.$request->id .'/'.$row->id); ?>"><i class="fa fa-mail-forward"></i><?php echo $request->name; ?></a></li>
									<?php   }   ?>
							</ul>   
							</div> 	
										<?php   ?>
										</td>
                                    </tr>
								<?php  }  }  } ?>
                                </tbody>
                    </table>

                </div><!-- /.box-body -->
            </div><!-- /.box -->

        </div><!-- /.col -->
    </div><!-- /.row -->

    </div><!-- /.col -->
    </div><!-- /.row -->

</section>

<script src="<?php echo base_url('assets/admin/plugins/datatables/jquery.dataTables.js')?>" type="text/javascript">
</script>
<script src="<?php echo base_url('assets/admin/plugins/datatables/dataTables.bootstrap.js')?>" type="text/javascript">
</script>
<script type="text/javascript">
$(function() {
    $('#example1').dataTable({
        "paging": true,
    });

});
</script>