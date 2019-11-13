<link href="<?php echo base_url('assets/admin/plugins/datatables/dataTables.bootstrap.css')?>" rel="stylesheet" type="text/css" />

<section class="content-header">
          <h1>
            <?php echo $page_title; ?>
            <small><?php echo lang('list'); ?></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
            <li class="active"><?php echo lang('Services_complaint'); ?></li>
          </ol>
</section>


<section class="content">
         <div class="row">
		 	<div class="col-md-12" style="padding-bottom:10px;">
			
			</div>
		 </div>
		 
		
      <!-- /.row --> <div class="col-md-12">
	  <div class="col-md-3">
             <select class="form-control projects" >
			  <option>Select Project</option>
			  <?php 
			  if(isset($projects)){
				  foreach($projects as $item){   
					  ?>
					  <option value="<?php  echo $item->id ?>"><?php  echo $item->Name ?></option>
					  <?php
				  }
			  }
			  ?>
			 </select>
			 </div>
			 <div class="col-md-3">
             <select class="form-control units">
			 <option>Select Unit</option>
			 </select>
			 </div>
			 </div>
			 <br>
			 <br>
			 <br>
		  <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title"><?php echo lang('Services_complaint'); ?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
						<table class="table table-striped" id="example1">
	<thead >
		<tr>
			<th><?php echo lang('Units'); ?></th>
			<th><?php echo lang('Complaint_title'); ?></th>
			<th><?php echo lang('Complaint_desc'); ?></th>
			<th><?php echo lang('action'); ?></th>
		</tr>
	</thead>
	
	<tbody class="display">
<?php if($Complaint):?>		
<?php foreach ($Complaint as $new):?>
		<tr>
			
			<td class="gc_cell_left" ><?php echo  $new->unit_no; ?></td>
			<td><?php echo  $new->c_title; ?></td>
			<td><?php echo  $new->c_description;  ?></td>
		<td>
				<div class="btn-group" style="float:right">
					<a class="btn btn-default" href="<?php echo site_url('admin/Complaint/view/'.$new->complain_id); ?>"><i class="fa fa-eye"></i></a>
					
					
				</div>
			</td>
		</tr>
<?php endforeach;?>
<?php endif?>
	</tbody>
</table>
 </div><!-- /.box-body -->
       </div><!-- /.box -->

            </div><!-- /.col -->
          </div><!-- /.row -->
		 
		 
          </div><!-- /.row -->
        </section>

<script src="<?php echo base_url('assets/admin/plugins/datatables/jquery.dataTables.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/plugins/datatables/dataTables.bootstrap.js')?>" type="text/javascript"></script>
<script>
$(".projects").on('change',function() {   
    var val = $(this).val();
     if(val){
	 	$.ajax({
		url: '<?php echo site_url('admin/Services/projectdatatble') ?>',
		type:'POST',
		data:{id:val},
		success:function(result){
			var result = $.parseJSON(result)
		    $('.display').html(result[1]);
			$('.units').html(result[0]);
		}
	  });
	 }     
}); 
</script>

<script>
$(".units").on('change',function() {   
    var val = $(this).val();
	var project = $('.projects').val();
     if(val){
	 	$.ajax({
		url: '<?php echo site_url('admin/Services/unitdatatble') ?>',
		type:'POST',
		data:{id:project,unit:val},
		success:function(result){
		  $('.display').html(result);
		}
	  });
	 }     
}); 
</script>
