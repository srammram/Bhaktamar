<link href="<?php echo base_url('assets/admin/plugins/datatables/dataTables.bootstrap.css')?>" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url('assets/admin/dist/css/bootstrap-datetimepicker.min.css')?>" />
<script src="<?php echo base_url('assets/admin/dist/js/moment.min.js')?>"></script>
<script src="<?php echo base_url('assets/admin/dist/js/bootstrap-datetimepicker.min.js')?>"></script>
<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap-datepicker.min.css">
<style>
.modal-backdrop.in {
    filter: alpha(opacity=50);
    opacity: 0;
    z-index: -1;
}
</style>
<br>
<section class="content-header">
         <h1>
            <?php echo $page_title; ?>
			 <small><?php echo lang('list'); ?></small>
           </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
			<li><a href="<?php echo site_url('admin/crm/Crm/Enquiry') ?>"> <?php echo lang('Enquiry')." ".lang('list') ?> </a></li>
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
                      		<label>Serial No :</label>                       	</div>
						<div class="col-md-3">
						<?php  if(!empty($enquiry->serial_no)){ echo $enquiry->serial_no ;}  ?>
						</div>	
						<div class="col-md-2">
                      		<label><?php echo lang('Contact_number') ?> :</label>
                      	</div>
						<div class="col-md-2">
							<?php  if(!empty($enquiry->contact_no)){ echo $enquiry->contact_no ;}  ?>
						</div>	
						<div class="col-md-2">
						
                      		<label><?php echo lang('SalesPerson') ?>  :  </label>  <?php  if(isset($salesperson->Name)){ echo $salesperson->Name ;}  ?>
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
						<?php  if(!empty($enquiry->date)){ echo $enquiry->date ;}  ?>
						</div>	
						<div class="col-md-2">
                      		<label><?php echo lang('email') ?> :</label>
                      	</div>
						<div class="col-md-2">
							<?php  if(isset($enquiry->email)){ echo $enquiry->email ;}  ?>
						</div>	
						
						<div class="col-md-2">
                      		<label>Address :</label>                  
						
						<?php  if(isset($enquiry->address)){ echo $enquiry->address ;}  ?>
						     	</div>
						<div class="col-md-2">
							
							
						</div>	
					  </div>		
                    </div>
						<div class="form-group">
					  <div class="row">
						<div class="col-md-2">
                      				<label>Alternate No</label>                   	</div>
						<div class="col-md-3">
					  <?php if(!empty($enquiry->alernate_no)){ echo $enquiry->alernate_no; }  ?>
						</div>	
						<div class="col-md-2">
                      	   		<label><?php echo lang('requirement') ?> :</label>
                      	</div>
						<div class="col-md-2">
							  <?php if(!empty($enquiry->building)){ echo 'Building:-' .$enquiry->building; }  ?>
							   <?php if(!empty($enquiry->floors)){ echo 'Floor:-'. $enquiry->floors; }  ?>
						</div>	
						
						<div class="col-md-2">
                      			<label>Attended by :</label>
						
						    <?php if(!empty($enquiry->attendedby)){ echo $enquiry->attendedby; }  ?>
						     	</div>
						<div class="col-md-2">
							
							
						</div>	
					  </div>		
                    </div>
						<div class="form-group">
					  <div class="row">
						<div class="col-md-2">
                      			<label>Lead Forward To :</label>
								</div>
						<div class="col-md-3">
					    <?php if(!empty($enquiry->first_name)){ echo $enquiry->first_name; }  ?>
						</div>	
						
					  </div>		
                    </div>
					
					
	  </div>
    </div>
  </div>
  <div class="success"></div>
  <div class="col-md-offset-9">
  <?php  if(isset($enquiry->id)){ 
  $customer=$this->db->get_where('crm_customer',array('enquiry_id'=>$enquiry->id))->row();
  if(empty($customer)){ 
  ?> <button type="button" class="btn btn-danger" onclick="showfollowupmodal()" data-dismiss="modal"><?php echo lang('AddFollowup'); ?></button> <button  onclick="openfinaltag(<?php echo $enquiry->id;   ?>)"  data-target="#AddFinalmyModal"  data-dismiss="modal"  type="button" class="btn btn-secondary"><?php echo lang('GenerateLead'); ?></button>
  <?php   }else{  ?>  <a href="<?php  echo site_url('admin/crm/Crm/depositReceipt/'.$enquiry->id) ?>"><button type="button" class="btn btn-danger" ><?php echo lang('Deposite_receipt'); ?></button>   </a>  <?php }}  ?>
  
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
					<a class="btn btn-danger" href="<?php echo site_url('admin/Crm/Crm/followupDelete/'.$new->followupid.'/'.$enquiry->id); ?>" onclick="return areyousure(this);"><i class="fa fa-trash"></i> <?php echo lang('delete')?></a>
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
        <h4 class="modal-title">Follow Up</h4>
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
                    <input type='text' name="followdate" class="form-control datepicker" />
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
                    <input type='text' name="nextdate" class="form-control datepicker" />
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
</div>


<!-- Add Final Tag -->
<div id="AddFinalmyModal" class="modal fade" role="dialog" style="z-index: 2000 !important;">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Enquiry To Customer</h4>
      </div>
      <div class="modal-body">
         <form action="#" id="followup" class="form-horizontal">
       <!-- <div class="form-group col-md-offset-2" style="margin:2px;padding:4px;">
			<div class="row">
				<div class="col-md-6">
				<label><?php echo lang('Customer_name') ?></label>
				</div>
			<div class="col-md-6">
				<input type='text' name="Customer_name" class="form-control" id="enquiry_id" />				
			</div>	
			</div>
          </div> -->	                 
      	<div class="form-group col-md-offset-2" style="margin:2px;padding:4px;">
			  <div class="row">
				<div class="col-md-6">
              		<label><?php echo lang('Intial_Amount') ?></label>
              	</div>
				<div class="col-md-6">
				   <input type='text' name="Intial_Amount" class="form-control" id="Intial_Amount" required />	
				</div>
				
           </div>
		   	<div class="form-group col-md-offset-2" style="margin:0px;padding:3px;">
			  <div class="row">
				<div class="col-md-6">
              		<label><?php echo lang('Paid_date') ?></label>
              	</div>
				<div class="col-md-6">
				   <input type='text' name="Paid_date" class="form-control datepicker" id="Paid_date"  required />	
				</div>
				
           </div>
		  <!-- <div class="form-group col-md-offset-2" style="margin:0px;padding:2px;">
			  <div class="row">
				<div class="col-md-6">
              		<label><?php echo lang('contract_Number') ?></label>
              	</div>
				<div class="col-md-6">
				   <input type='text' name="contractNumber" class="form-control " id="contractNumber"  required />	
				</div>
				
           </div>-->
	       <input type="hidden" name="id" >
	       <input type="hidden" name="Enquiry_id" id="Enquiry_id" value="<?php echo $enquiry->id;  ?>">
      	</div>

	  </form>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn btn-success followupsave" onclick="addfinaltag(<?php echo $enquiry->id;   ?>)"    data-dismiss="modal"><?php echo lang('save')?></button>
		<button type="button" class="btn btn-default btn btn-danger" data-dismiss="modal"> <?php echo lang('close')?></button>
      </div>
    </div>

  </div>
</div>
</div>
<!-- Add Final Tag -->
        </section>
 <script src="<?php echo base_url('assets/plugin/moment.min.js')?>"></script>
<script src="<?php echo base_url('assets/admin/plugins/daterangepicker/daterangepicker.js')?>"></script>
<script src="<?php echo base_url('assets/admin/plugins/iCheck/icheck.min.js')?>" type="text/javascript"></script>				
<script src="<?php echo base_url('assets/admin/') ?>/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url('assets/admin/plugins')?>/jquery-validation/jquery.validate.min.js"></script>
<script>

 $(function() {
 $('.datepicker').datepicker({
      	todayHighlight: true,
		autoclose: true,
	   format: 'yyyy-mm-dd',
    });
 	$('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
     });
	      });
</script>
<script src="<?php echo base_url('assets/admin/plugins/datatables/jquery.dataTables.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/plugins/datatables/dataTables.bootstrap.js')?>" type="text/javascript"></script>
</script>