<link href="<?php echo base_url('assets/admin/plugins/datatables/dataTables.bootstrap.css')?>" rel="stylesheet" type="text/css" />

<section class="content-header">
          <h1>
            <?php echo $page_title; ?>
            <small><?php echo lang('list'); ?></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
            <li class="active"><?php echo lang('Soc'); ?></li>
          </ol>
</section>


<section class="content">
         <div class="row">
		 	<div class="col-md-12">
				<div class="text-center">
  <a href="" style="float:right;" class="btn btn-default btn-rounded mb-4" data-toggle="modal" data-target="#modalRegisterForm">Add User Role</a>
</div>
			</div>
		 </div>
		  <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
               
                </div><!-- /.box-header -->
                <div class="box-body">
						<table class="table table-striped" id="example1">
	<thead >
		<tr>
			<th>#</th>
			<th><?php echo lang('Roleid'); ?></th>
			<th><?php echo lang('UserRole'); ?></th>
			<th><?php echo lang('UserRoleGroups'); ?></th>
			<th><?php echo lang('action'); ?></th>
		</tr>
	</thead>
	
	<tbody >
<?php if($userrolelist):?>		
<?php $i=1;foreach ($userrolelist as $new):?>
		<tr>
			<td><?php echo $i;?></td>
			<td class="gc_cell_left" ><?php echo  $new->Id; ?></td>
			<td><?php echo  $new->Role_name; ?></td>
			<td><?php echo  $new->Role_name; ?></td>
			<td>
				<div class="btn-group" style="float:right">
					
					<a class="btn btn-primary edit"  data-toggle="modal" data-target="#modalRegisterForm" href="<?php echo $new->Id; ?>"><i class="fa fa-edit"></i> <?php echo lang('edit')?></a>
					<a class="btn btn-primary" href="<?php echo site_url('admin/Settings/Userprivilege/'.$new->Id); ?>"><i class="glyphicon glyphicon-asterisk"></i></a>
					
					
					<a class="btn btn-danger" href="<?php echo site_url('admin/Settings/Socdee/'.$new->Id); ?>" onclick="return areyousure(this);"><i class="fa fa-trash"></i> <?php echo lang('delete')?></a>
				</div>
			</td>
		</tr>
<?php $i++; endforeach;?>
<?php endif?>
	</tbody>
</table>

				 </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div><!-- /.col -->
          </div><!-- /.row -->
        </section>

<script src="<?php echo base_url('assets/admin/plugins/datatables/jquery.dataTables.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/plugins/datatables/dataTables.bootstrap.js')?>" type="text/javascript"></script>
<div class="modal fade" id="modalRegisterForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">User Role</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
        
        <div class="md-form mb-5">
         <label data-error="wrong" data-success="right" for="orangeForm-email">RoleName</label>
          <input type="email" id="name" class="form-control validate">
          
        </div>
<br>
        <div class="md-form mb-4">
          <i class="fa fa-lock prefix grey-text"></i>
		   <label data-error="wrong" data-success="right" for="orangeForm-email">Role Description</label>
          <input type="text" id="desc" class="form-control validate">
       
        </div>

      </div>
      <div class="modal-footer d-flex justify-content-center">
	  <input type="hidden" id="id">
        <button class="btn btn-deep-orange save">Save</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
$(function() {
	$('#example1').dataTable({
	});
	
});

</script>
<script type="text/javascript">

	$('.save').on('click',function(){
		  var name	=	$('#name').val();
		  var desc	=	$('#desc').val();
		    var id	=	$('#id').val();
	 
		  $.ajax({
			url: '<?php echo site_url('admin/settings/userroleladd') ?>',
			type:'POST',
			data:{name:name,desc:desc,id:id},
			success:function(result){
				 location.reload();
				
			 }
		  });
	});
	

</script>
<script type="text/javascript">

	$('.edit').on('click',function(){
		
		  var id	=$(this).attr('href');;
		  $.ajax({
			url: '<?php echo site_url('admin/settings/userroleeditload') ?>',
			type:'POST',
			data:{id:id},
			 dataType: "JSON",
			success:function(result){
				$('#name').val(result.Role_name);
		        $('#desc').val(result.Role_name);
				 $('#id').val(result.Id);
				
				
			 }
		  });
	});
	

</script>
