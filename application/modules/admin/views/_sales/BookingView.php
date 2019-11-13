
<link href="<?php echo base_url('assets/admin/plugins/datatables/dataTables.bootstrap.css')?>" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url('assets/admin/dist/css/bootstrap-datetimepicker.min.css')?>" />
<script src="<?php echo base_url('assets/admin/dist/js/moment.min.js')?>"></script>
<script src="<?php echo base_url('assets/admin/dist/js/bootstrap-datetimepicker.min.js')?>"></script>
<style>
</style>
<br>
<section class="content-header">
         <h1>
            <?php echo $page_title; ?>
			 <small><?php echo lang('list'); ?></small>
           </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
			<li><a href="<?php echo site_url('admin/sales/Sales') ?>"> <?php echo lang('Sales')." ".lang('list') ?> </a></li>
          </ol>
</section>
      <section class="content">
	  <br>
  <div class="panel-group">
    <div class="panel panel-default">
      <div class="panel-heading" style="background-color:#5A7670;color:#fff;"><h4><b><?php echo lang('Enquiry_details'); ?></b></h4></div>
      <div class="panel-body">
	  
	  <div class="form-group">
					  <div class="row">
						<div class="col-md-2">
                      		<label><?php echo lang('Enquiry_id') ?> :</label>                       	</div>
						<div class="col-md-3">
						<?php  if(isset($enquiry->enquiry_id)){ echo $enquiry->enquiry_id ;}  ?>
						</div>	
						<div class="col-md-2">
                      		<label><?php echo lang('Contact_number') ?> :</label>
                      	</div>
						<div class="col-md-2">
							<?php  if(isset($enquiry->contact_number)){ echo $enquiry->contact_number ;}  ?>
						</div>	
						<div class="col-md-2">
                      		<label><?php echo lang('SalesPerson') ?> :</label>
                      	</div>
						<div class="col-md-2">
							
						</div>	
					  </div>		
                    </div>
				<div class="form-group">
					  <div class="row">
						<div class="col-md-2">
                      		<label><?php echo lang('date') ?>  :</label>                       	</div>
						<div class="col-md-3">
						<?php  if(isset($enquiry->enquiry_date)){ echo $enquiry->enquiry_date ;}  ?>
						</div>	
						<div class="col-md-2">
                      		<label><?php echo lang('email') ?> :</label>
                      	</div>
						<div class="col-md-2">
							<?php  if(isset($enquiry->email)){ echo $enquiry->email ;}  ?>
						</div>	
						<div class="col-md-2">
                      		<label><?php echo lang('requirement') ?> :</label>
                      	</div>
						<div class="col-md-2">
							
						</div>	
					  </div>		
                    </div>
					<div class="form-group">
					  <div class="row">
						<div class="col-md-2">
                      		<label><?php echo lang('Customer_name') ?> :</label>                       	</div>
						<div class="col-md-3">
						<?php  if(isset($enquiry->Customer_name)){ echo $enquiry->Customer_name ;}  ?>
						</div>	
					  </div>		
                    </div>
	  </div>
    </div>
  </div>
  <div class="success"></div>
  <div class="col-md-offset-9">
  <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal" data-dismiss="modal"><?php echo lang('AddFollowup'); ?></button> <button  onclick="addfinaltag(<?php echo $enquiryid;   ?>)" type="button" class="btn btn-secondary"><?php echo lang('AddFinalTag'); ?></button>
  </div>
   <div class="panel-group">
    <div class="panel panel-default" >
      <div class="panel-heading" style="background-color:#5A7670;color:#fff;"><h4><b><?php echo $page_title; ?></b> <small><?php echo lang('list'); ?></small></h4>
			 </div>
      <div class="panel-body">
	  <table class="table table-striped" >
	     <thead >
		<tr>
			<th><?php echo lang('FollowUpid'); ?></th>
			<th><?php echo lang('Enquiry_id'); ?></th>
			<th><?php echo lang('FollowupDate'); ?></th>
			<th><?php echo lang('Calltype'); ?></th>
			<th><?php echo lang('Discussion'); ?></th>
			<th><?php echo lang('NextFollowupDate'); ?></th>
			<th><?php echo lang('action'); ?></th>
		</tr>
	</thead>
	<tbody >
<?php if($follow_list):?>		
<?php $i=1;foreach ($follow_list as $new):?>
		<tr>
			<td><?php echo  $new->followupid; ?></td>
			<td><?php echo  $new->enquiryid; ?></td>
			<td><?php echo date('Y-m-d',strtotime($new->followup_date_time)); ?></td>	
			<td><?php echo  $new->calltype; ?> </td>
			<td style="width:30%"><?php echo  $new->discussion; ?></td>
			<td><?php echo  date('Y-m-d',strtotime($new->next_followup_date));  ?></td>
			<td>
				<div class="btn-group" style="float:right">
					<a class="btn btn-primary" onclick="edit_followup(<?php echo $new->followupid;   ?>)"><i class="fa fa-edit"></i> <?php echo lang('edit')?></a>
					<a class="btn btn-danger" href="<?php echo site_url('admin/Crm/Crm/followupDelete/'.$new->followupid.'/'.$enquiryid); ?>" onclick="return areyousure(this);"><i class="fa fa-trash"></i> <?php echo lang('delete')?></a>
				</div>
			</td>
		</tr>
<?php $i++; endforeach;?>
<?php endif?>
	</tbody>
</table>
	  </div>
    </div>
  </div>

<!-- The Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
         <form action="#" id="followup" class="form-horizontal">
       <div class="form-group col-md-offset-2" style="margin:2px;padding:4px;">
					  <div class="row">
						<div class="col-md-6">
                      		<label><?php echo lang('FollowupDate') ?></label>
                      	</div>
						<div class="col-md-6">
                   <div class='input-group date'  id='datetimepicker1'>
                    <input type='text' name="followdate" class="form-control" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
                        </div>	
                       
                    </div>
                       </div>
	               <div class="form-group col-md-offset-2" style="margin:2px;padding:4px;">
					  <div class="row">
						<div class="col-md-6">
                      		<label><?php echo lang('Calltype') ?></label>
                      	</div>
						<div class="col-md-6">
                    <select name="calltype" class="form-control" >
								<option >Select</option>
									<option value="<?php echo lang('email')  ?>"<?php  if(isset($SalesPersontype)){ echo $SalesPersontype == lang('email')  ?'selected':'' ;  } ?>><?php echo lang('email')  ?></option>
										<option value="<?php echo lang('Sms')  ?>"<?php  if(isset($SalesPersontype)){ echo $SalesPersontype == lang('Sms') ?'selected':'' ;  } ?>><?php echo lang('Sms')  ?></option>
										<option value="<?php echo lang('Call')  ?>"<?php  if(isset($SalesPersontype)){ echo $SalesPersontype == lang('Call') ?'selected':'' ;  } ?>><?php echo lang('Call')  ?></option>
										<option value="<?php echo lang('Directvisit')  ?>"<?php  if(isset($SalesPersontype)){ echo $SalesPersontype == lang('Directvisit') ?'selected':'' ;  } ?>><?php echo lang('Directvisit')  ?></option>
							</select>
                        </div>	
                    </div>
                     </div>
	                  <div class="form-group col-md-offset-2" style="margin:2px;padding:4px;">
					  <div class="row">
						<div class="col-md-6">
                      		<label><?php echo lang('Discussion') ?></label>
                      	</div>
						<div class="col-md-6">
                    <textarea name="discuss" class="form-control"></textarea>
                        </div>	
                       
                    </div>
                   </div>
	              <div class="form-group col-md-offset-2" style="margin:2px;padding:4px;">
					  <div class="row">
						<div class="col-md-6">
                      		<label><?php echo lang('NextFollowupDate') ?></label>
                      	</div>
						<div class="col-md-6">
                     <div class='input-group date'  id='datetimepicker2'>
                    <input type='text' name="nextdate" class="form-control" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
					
                </div>
               </div>	
             </div>
			  <input type="hidden" name="id" >
			 <input type="hidden" name="Enquiry_id" value="<?php echo $enquiryid  ?>">
      </div>
	  </form>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn btn-success followupsave"onclick="addfollowup()" data-dismiss="modal"><?php echo lang('save')?></button>
		<button type="button" class="btn btn-default btn btn-danger" data-dismiss="modal"> <?php echo lang('close')?></button>
      </div>
    </div>

  </div>
</div>
        </section>

<script src="<?php echo base_url('assets/admin/plugins/datatables/jquery.dataTables.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/plugins/datatables/dataTables.bootstrap.js')?>" type="text/javascript"></script>
<script type="text/javascript">
  $(function () {
                $('#datetimepicker1').datetimepicker();
            });
			$(function () {
                $('#datetimepicker2').datetimepicker();
            });

</script>
