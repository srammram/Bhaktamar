<style>
		
/*	check box*/
	.checkbox-custom {
    opacity: 0;
    position: absolute;   
}

.checkbox-custom, .checkbox-custom-label {
    display: inline-block;
    vertical-align: middle;
    margin: 5px;
    cursor: pointer;
}

.checkbox-custom + .checkbox-custom-label:before {
    content: '';
    background: #ddd;
    border-radius: 5px;
    border: 2px solid #ddd;
    display: inline-block;
    vertical-align: middle;
    width: 20px;
    height: 20px;
    padding: 2px;
    margin-right: 10px;
    text-align: center;
}

.checkbox-custom:checked + .checkbox-custom-label:before {
    content: "";
   background: #2c3542;
	border: 2px solid #2c3542;
}
	
	.table thead tr th, .table tbody tr td{vertical-align: middle;}
	.user_privilege{border: 1px solid #ddd;}
</style>

<section class="content">
	 <div class="row">
         	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
         	<div class="box">
         		<div class="box-header">
         			<h3 class="box-title">Manage User privilege</h3>
         		</div>
         	</div>
				<form action="<?php echo site_url('admin/settings/screenpermission_save/'.$id); ?>" method="post">
         		<div class="box">
         			<div class="box-header">
         				<div class="col-sm-6 col-xs-12 privilege_user">
         					<h3 class="box-title"><?php echo lang('UserGroup');  ?></h3>
							<select class="form-control" name="UserGroup">
							<?php  if(isset($roles)){ foreach($roles as $item){ ?>
							<option value="<?php  echo $item->Id;  ?>"
							<?php if(!empty($id)) echo $id ==   $item->Id ? 'selected':''   ?>><?php  echo $item->Role_name; ?></option>
							
							<?php
							}
							}
							?>
								
							</select>
         				</div>
         				
         			</div>
         			<div class="box-body">
         				<div class="col-sm-12">
					
							<table class="table table-striped user_privilege">
								<thead>
									<tr>
										<th>ScreenName  <?php  if(isset($userrole->Project_index)){ if($userrole->Project_index==1){ echo $userrole->Project_index ; } } ?></th>
										<th>
											<div>
											  <input id="checkbox-5" class="checkbox-custom" name="checkbox-5" type="checkbox">
											  <label for="checkbox-5" class="checkbox-custom-label">Views</label>
											</div>
										</th>
										<th>
											<div>
											  <input id="checkbox-1" class="checkbox-custom" name="checkbox-1" type="checkbox">
											  <label for="checkbox-1" class="checkbox-custom-label">Add</label>
											</div>
										</th>
										<th>
											<div>
											  <input id="checkbox-2" class="checkbox-custom" name="checkbox-2" type="checkbox">
											  <label for="checkbox-2" class="checkbox-custom-label">Edit</label>
											</div>
										</th>
										<th>
											<div>
											  <input id="checkbox-3" class="checkbox-custom" name="checkbox-3" type="checkbox">
											  <label for="checkbox-3" class="checkbox-custom-label">Delete</label>
											</div>
										</th>
									
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Project </td>
										<td>
											<div>
											  <input id="checkbox-6" class="checkbox-custom" name="project_view" type="checkbox" <?php  if(isset($userrole->Project_index)){ if($userrole->Project_index==1){ echo 'checked' ; } } ?> value="1" >
											  <label for="checkbox-6" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-7" class="checkbox-custom" name="project_add" type="checkbox" <?php  if(isset($userrole->Project_add)){ if($userrole->Project_add==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-7" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-8" class="checkbox-custom" name="project_edit" type="checkbox" <?php  if(isset($userrole->Project_edit)){ if($userrole->Project_edit==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-8" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-9" class="checkbox-custom" name="project_delete" type="checkbox" <?php  if(isset($userrole->Project_delete)){ if($userrole->Project_delete==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-9" class="checkbox-custom-label"></label>
											</div>
										</td>
										 
									</tr>
									<tr>
										<td>Units</td>
										<td>
											<div>
											  <input id="checkbox-11" class="checkbox-custom" name="unit_view" type="checkbox" <?php  if(isset($userrole->Units_index)){ if($userrole->Units_index==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-11" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-12" class="checkbox-custom" name="unit_add" type="checkbox" <?php  if(isset($userrole->Units_add)){ if($userrole->Units_add==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-12" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-13" class="checkbox-custom" name="unit_edit" type="checkbox" <?php  if(isset($userrole->Units_edit)){ if($userrole->Units_edit==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-13" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-14" class="checkbox-custom" name="unit_delete" type="checkbox" <?php  if(isset($userrole->Units_delete)){ if($userrole->Units_delete==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-14" class="checkbox-custom-label"></label>
											</div>
										</td>
										
									</tr>
									<tr>
										<td> Floors</td>
										<td>
											<div>
											  <input id="checkbox-16" class="checkbox-custom" name="floor_view" type="checkbox" <?php  if(isset($userrole->Floor_index)){ if($userrole->Floor_index==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-16" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-17" class="checkbox-custom" name="floor_add" type="checkbox" <?php  if(isset($userrole->Floors_add)){ if($userrole->Floors_add==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-17" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-18" class="checkbox-custom" name="floor_edit" type="checkbox" <?php  if(isset($userrole->Floors_edit)){ if($userrole->Floors_edit==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-18" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-19" class="checkbox-custom" name="floor_delete" type="checkbox" <?php  if(isset($userrole->Floors_delete)){ if($userrole->Floors_delete==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-19" class="checkbox-custom-label"></label>
											</div>
										</td>
										
									</tr>
									<tr>
										<td> Owner</td>
										<td>
											<div>
											  <input id="checkbox-21" class="checkbox-custom" name="Owner_view" type="checkbox" <?php  if(isset($userrole->Owner_index)){ if($userrole->Owner_index==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-21" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-22" class="checkbox-custom" name="Owner_add" type="checkbox" <?php  if(isset($userrole->Owner_add)){ if($userrole->Owner_add==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-22" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-23" class="checkbox-custom" name="Owner_edit" type="checkbox" <?php  if(isset($userrole->Owner_edit)){ if($userrole->Owner_edit==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-23" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-24" class="checkbox-custom" name="Owner_delete" type="checkbox" <?php  if(isset($userrole->Owner_delete)){ if($userrole->Owner_delete==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-24" class="checkbox-custom-label"></label>
											</div>
										</td>
										
									</tr>
									<tr>
										<td>Guests </td>
										<td>
											<div>
											  <input id="checkbox-25" class="checkbox-custom" name="Guest_view" type="checkbox" <?php  if(isset($userrole->Guests_indexs)){ if($userrole->Guests_indexs==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-25" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-26" class="checkbox-custom" name="Guest_add" type="checkbox" <?php  if(isset($userrole->Guests_adds)){ if($userrole->Guests_adds==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-26" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-27" class="checkbox-custom" name="Guest_edit" type="checkbox" <?php  if(isset($userrole->Guests_edits)){ if($userrole->Guests_edits==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-27" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-28" class="checkbox-custom" name="Guest_delete" type="checkbox" <?php  if(isset($userrole->Guests_deletes)){ if($userrole->Guests_deletes==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-28" class="checkbox-custom-label"></label>
											</div>
										</td>
										 
									</tr>
									<tr>
										<td>Lease Owner </td>
										<td>
											<div>
											  <input id="checkbox-29" class="checkbox-custom" name="LeaseOwner_view" type="checkbox" <?php  if(isset($userrole->LeaseOwner_index)){ if($userrole->LeaseOwner_index==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-29" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-30" class="checkbox-custom" name="LeaseOwner_add" type="checkbox" <?php  if(isset($userrole->LeaseOwner_add)){ if($userrole->LeaseOwner_add==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-30" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-31" class="checkbox-custom" name="LeaseOwner_edit" type="checkbox" <?php  if(isset($userrole->LeaseOwner_edit)){ if($userrole->LeaseOwner_edit==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-31" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-32" class="checkbox-custom" name="LeaseOwner_delete" type="checkbox" <?php  if(isset($userrole->LeaseOwner_delete)){ if($userrole->LeaseOwner_delete==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-32" class="checkbox-custom-label"></label>
											</div>
										</td>
										 
									</tr>
									<tr>
										<td>Complaint </td>
										<td>
											<div>
											  <input id="checkbox-33" class="checkbox-custom" name="Complaint_view" type="checkbox" <?php  if(isset($userrole->Complaint_index)){ if($userrole->Complaint_index==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-33" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-34" class="checkbox-custom" name="Complaint_add" type="checkbox" <?php  if(isset($userrole->Complaint_add)){ if($userrole->Complaint_add==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-34" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-35" class="checkbox-custom" name="Complaint_edit" type="checkbox" <?php  if(isset($userrole->Complaint_edit)){ if($userrole->Complaint_edit==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-35" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-36" class="checkbox-custom" name="Complaint_delete" type="checkbox" <?php  if(isset($userrole->Complaint_delete)){ if($userrole->Complaint_delete==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-36" class="checkbox-custom-label"></label>
											</div>
										</td>
										 
									</tr>
									<tr>
										<td>Fund </td>
										<td>
											<div>
											  <input id="checkbox-37" class="checkbox-custom" name="fund_view" type="checkbox" <?php  if(isset($userrole->Fund_index)){ if($userrole->Fund_index==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-37" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-38" class="checkbox-custom" name="fund_add" type="checkbox" <?php  if(isset($userrole->Fund_add)){ if($userrole->Fund_add==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-38" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-39" class="checkbox-custom" name="fund_edit" type="checkbox" <?php  if(isset($userrole->Fund_edit)){ if($userrole->Fund_edit==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-39" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-40" class="checkbox-custom" name="fund_delete" type="checkbox" <?php  if(isset($userrole->Fund_delete)){ if($userrole->Fund_delete==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-40" class="checkbox-custom-label"></label>
											</div>
										</td>
										 
									</tr>
									<tr>
										<td>Management committee </td>
										<td>
											<div>
											  <input id="checkbox-41" class="checkbox-custom" name="Manage_committe_view" type="checkbox" <?php  if(isset($userrole->Management_committee_inedx)){ if($userrole->Management_committee_inedx==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-41" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-42" class="checkbox-custom" name="Manage_committe_add" type="checkbox" <?php  if(isset($userrole->Management_committee_add)){ if($userrole->Management_committee_add==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-42" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-43" class="checkbox-custom" name=" " type="Manage_committe_edit" <?php  if(isset($userrole->Management_committee_edit)){ if($userrole->Management_committee_edit==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-43" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-44" class="checkbox-custom" name="Manage_committe_delete" type="checkbox" <?php  if(isset($userrole->Management_committee_delete)){ if($userrole->Management_committee_delete==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-44" class="checkbox-custom-label"></label>
											</div>
										</td>
										 
									</tr>
									<tr>
										<td>Facility </td>
										<td>
											<div>
											  <input id="checkbox-45" class="checkbox-custom" name="Facility_view" type="checkbox" <?php  if(isset($userrole->Facility_index)){ if($userrole->Facility_index==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-45" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-46" class="checkbox-custom" name="Facility_add" type="checkbox" <?php  if(isset($userrole->Facility_add)){ if($userrole->Facility_add==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-46" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-47" class="checkbox-custom" name="Facility_edit" type="checkbox" <?php  if(isset($userrole->Facility_edit)){ if($userrole->Facility_edit==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-47" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-48" class="checkbox-custom" name="Facility_delete" type="checkbox" <?php  if(isset($userrole->Facility_delete)){ if($userrole->Facility_delete==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-48" class="checkbox-custom-label"></label>
											</div>
										</td>
										 
									</tr>
									<tr>
										<td>Services </td>
										<td>
											<div>
											  <input id="checkbox-49" class="checkbox-custom" name="services_view" type="checkbox" <?php  if(isset($userrole->Services_index)){ if($userrole->Services_index==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-49" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-50" class="checkbox-custom" name="services_add" type="checkbox" <?php  if(isset($userrole->Services_add)){ if($userrole->Services_add==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-50" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-185" class="checkbox-custom" name="services_edit" type="checkbox" <?php  if(isset($userrole->Services_edit)){ if($userrole->Services_edit==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-185" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-51" class="checkbox-custom" name="services_delete" type="checkbox" <?php  if(isset($userrole->Services_delete)){ if($userrole->Services_delete==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-51" class="checkbox-custom-label"></label>
											</div>
										</td>
										 
									</tr>
									<tr>
										<td>Accounts </td>
										<td>
											<div>
											  <input id="checkbox-52" class="checkbox-custom" name="Accounts_view" type="checkbox" <?php  if(isset($userrole->Accounts_indexs)){ if($userrole->Accounts_indexs==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-52" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-53" class="checkbox-custom" name="Accounts_add" type="checkbox" <?php  if(isset($userrole->Accounts_adds)){ if($userrole->Accounts_adds==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-53" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-54" class="checkbox-custom" name="Accounts_edit" type="checkbox" <?php  if(isset($userrole->Accounts_edits)){ if($userrole->Accounts_edits==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-54" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-55" class="checkbox-custom" name="Accounts_delete" type="checkbox" <?php  if(isset($userrole->Accounts_deletes)){ if($userrole->Accounts_deletes==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-55" class="checkbox-custom-label"></label>
											</div>
										</td>
										 
									</tr>
									<tr>
										<td>Parking Manager </td>
										<td>
											<div>
											  <input id="checkbox-56" class="checkbox-custom" name="Parking_Manager_view" type="checkbox" <?php  if(isset($userrole->Parking_Manager_index)){ if($userrole->Parking_Manager_index==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-56" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-57" class="checkbox-custom" name="Parking_Manager_add" type="checkbox" <?php  if(isset($userrole->Parking_Manager_add)){ if($userrole->Parking_Manager_add==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-57" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-58" class="checkbox-custom" name="Parking_Manager_edit" type="checkbox" <?php  if(isset($userrole->Parking_Manager_edit)){ if($userrole->Parking_Manager_edit==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-58" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-59" class="checkbox-custom" name="Parking_Manager_delete" type="checkbox" <?php  if(isset($userrole->Parking_Manager_delete)){ if($userrole->Parking_Manager_delete==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-59" class="checkbox-custom-label"></label>
											</div>
										</td>
										 
									</tr>
									<tr>
										<td>Parking Slot </td>
										<td>
											<div>
											  <input id="checkbox-60" class="checkbox-custom" name="slot_view" type="checkbox" <?php  if(isset($userrole->Parking_Slot_index)){ if($userrole->Parking_Slot_index==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-60" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-61" class="checkbox-custom" name="slot_add" type="checkbox" <?php  if(isset($userrole->ParkingSlot_add)){ if($userrole->ParkingSlot_add==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-61" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-62" class="checkbox-custom" name="slot_edit" type="checkbox" <?php  if(isset($userrole->ParkingSlot_edit)){ if($userrole->ParkingSlot_edit==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-62" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-63" class="checkbox-custom" name="slot_delete" type="checkbox" <?php  if(isset($userrole->ParkingSlot_delete)){ if($userrole->ParkingSlot_delete==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-63" class="checkbox-custom-label"></label>
											</div>
										</td>
										 
									</tr>
									<tr>
										<td>Inventory </td>
										<td>
											<div>
											  <input id="checkbox-64" class="checkbox-custom" name="Inventory_view" type="checkbox" <?php  if(isset($userrole->Inventory_index)){ if($userrole->Inventory_index==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-64" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-65" class="checkbox-custom" name="Inventory_add" type="checkbox" <?php  if(isset($userrole->Inventory_add)){ if($userrole->Inventory_add==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-65" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-66" class="checkbox-custom" name="Inventory_edit" type="checkbox" <?php  if(isset($userrole->Inventory_edit)){ if($userrole->Inventory_edit==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-66" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-67" class="checkbox-custom" name="Inventory_delete" type="checkbox" <?php  if(isset($userrole->Inventory_delete)){ if($userrole->Inventory_delete==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-67" class="checkbox-custom-label"></label>
											</div>
										</td>
										 
									</tr>
									<tr>
										<td>Assets </td>
										<td>
											<div>
											  <input id="checkbox-68" class="checkbox-custom" name="assets_view" type="checkbox" <?php  if(isset($userrole->Assets_index)){ if($userrole->Assets_index==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-68" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-69" class="checkbox-custom" name="assets_add" type="checkbox" <?php  if(isset($userrole->Assets_add)){ if($userrole->Assets_add==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-69" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-70" class="checkbox-custom" name="assets_edit" type="checkbox" <?php  if(isset($userrole->Assets_edit)){ if($userrole->Assets_edit==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-70" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-71" class="checkbox-custom" name="assets_delete" type="checkbox" <?php  if(isset($userrole->Assets_delete)){ if($userrole->Assets_delete==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-71" class="checkbox-custom-label"></label>
											</div>
										</td>
										 
									</tr>
									<tr>
										<td>Employees </td>
										<td>
											<div>
											  <input id="checkbox-72" class="checkbox-custom" name="employee_view" type="checkbox" <?php  if(isset($userrole->Employees_index)){ if($userrole->Employees_index==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-72" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-73" class="checkbox-custom" name="employee_add" type="checkbox" <?php  if(isset($userrole->Employees_add)){ if($userrole->Employees_add==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-73" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-74" class="checkbox-custom" name="employee_edit" type="checkbox" <?php  if(isset($userrole->Employees_edit)){ if($userrole->Employees_edit==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-74" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-181" class="checkbox-custom" name="employee_delete" type="checkbox" <?php  if(isset($userrole->Employees_delete)){ if($userrole->Employees_delete==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-181" class="checkbox-custom-label"></label>
											</div>
										</td>
										 
									</tr>
									<tr>
										<td>Departments </td>
										<td>
											<div>
											  <input id="checkbox-75" class="checkbox-custom" name="departments_View" type="checkbox" <?php  if(isset($userrole->Departments_index)){ if($userrole->Departments_index==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-75" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-76" class="checkbox-custom" name="departments_add" type="checkbox" <?php  if(isset($userrole->Departments_add)){ if($userrole->Departments_add==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-76" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-77" class="checkbox-custom" name="departments_edit" type="checkbox" <?php  if(isset($userrole->Departments_edit)){ if($userrole->Departments_edit==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-77" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-78" class="checkbox-custom" name="departments_delete" type="checkbox" <?php  if(isset($userrole->Departments_delete)){ if($userrole->Departments_delete==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-78" class="checkbox-custom-label"></label>
											</div>
										</td>
										 
									</tr>
									<tr>
										<td>Designations </td>
										<td>
											<div>
											  <input id="checkbox-79" class="checkbox-custom" name="Designations_view" type="checkbox" <?php  if(isset($userrole->Designations_index)){ if($userrole->Designations_index==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-79" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-80" class="checkbox-custom" name="Designations_add" type="checkbox" <?php  if(isset($userrole->Designations_add)){ if($userrole->Designations_add==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-80" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-81" class="checkbox-custom" name="Designations_edit" type="checkbox" <?php  if(isset($userrole->Designations_edit)){ if($userrole->Designations_edit==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-81" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-82" class="checkbox-custom" name="Designations_delete" type="checkbox" <?php  if(isset($userrole->Designations_delete)){ if($userrole->Designations_delete==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-82" class="checkbox-custom-label"></label>
											</div>
										</td>
										 
									</tr>
									<tr>
										<td>Employee_salary </td>
										<td>
											<div>
											  <input id="checkbox-83" class="checkbox-custom" name="Employee_salary_view" type="checkbox" <?php  if(isset($userrole->Employee_salary_index)){ if($userrole->Employee_salary_index==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-83" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-84" class="checkbox-custom" name="Employee_salary_add" type="checkbox" <?php  if(isset($userrole->Employee_salary_adds)){ if($userrole->Employee_salary_adds==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-84" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-85" class="checkbox-custom" name="Employee_salary_edit" type="checkbox" <?php  if(isset($userrole->Employee_salary_edit)){ if($userrole->Employee_salary_edit==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-85" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-86" class="checkbox-custom" name="Employee_salary_delete" type="checkbox" <?php  if(isset($userrole->Employee_salary_delete)){ if($userrole->Employee_salary_delete==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-86" class="checkbox-custom-label"></label>
											</div>
										</td>
										 
									</tr>
									<tr>
										<td>Perperty Dashboard </td>
										<td>
											<div>
											  <input id="checkbox-87" class="checkbox-custom" name="perpertyview" type="checkbox" <?php  if(isset($userrole->Perperty_Dashboard)){ if($userrole->Perperty_Dashboard==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-87" class="checkbox-custom-label"></label>
											</div>
										</td>
								
										 
									</tr>
									<tr>
										<td>Accounts </td>
										<td>
											<div>
											  <input id="checkbox-88" class="checkbox-custom" name="Accountsview" type="checkbox" <?php  if(isset($userrole->Accounts_index)){ if($userrole->Accounts_add==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-88" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-89" class="checkbox-custom" name="Accountsadd" type="checkbox" <?php  if(isset($userrole->Accounts_add)){ if($userrole->Accounts_add==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-89" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-90" class="checkbox-custom" name="Accountsedit" type="checkbox" <?php  if(isset($userrole->Accounts_edit)){ if($userrole->Accounts_edit==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-90" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-91" class="checkbox-custom" name="Accountsdelete" type="checkbox" <?php  if(isset($userrole->Accounts_delete)){ if($userrole->Accounts_delete==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-91" class="checkbox-custom-label"></label>
											</div>
										</td>
										 
									</tr>
									<tr>
										<td>Settings </td>
										<td>
											<div>
											  <input id="checkbox-92" class="checkbox-custom" name="settingsview" type="checkbox" <?php  if(isset($userrole->Settings_index)){ if($userrole->Settings_index==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-92" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-93" class="checkbox-custom" name="settingsadd" type="checkbox" <?php  if(isset($userrole->Settings_add)){ if($userrole->Settings_add==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-93" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-94" class="checkbox-custom" name="settingsedit" type="checkbox" <?php  if(isset($userrole->Settings_edit)){ if($userrole->Settings_edit==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-94" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-95" class="checkbox-custom" name="settingsdelete" type="checkbox" <?php  if(isset($userrole->Settings_delete)){ if($userrole->Settings_delete==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-95" class="checkbox-custom-label"></label>
											</div>
										</td>
										 
									</tr>
									<tr>
										<td>Languages </td>
										<td>
											<div>
											  <input id="checkbox-96" class="checkbox-custom" name="Languagesview" type="checkbox" <?php  if(isset($userrole->Languages_index)){ if($userrole->Languages_index==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-96" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-97" class="checkbox-custom" name="Languagesadd" type="checkbox" <?php  if(isset($userrole->Languages_add)){ if($userrole->Languages_add==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-97" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-98" class="checkbox-custom" name="Languagesedit" type="checkbox" <?php  if(isset($userrole->Languages_edit)){ if($userrole->Languages_edit==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-98" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-99" class="checkbox-custom" name="Languagesdelete" type="checkbox" <?php  if(isset($userrole->Languages_delete)){ if($userrole->Languages_delete==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-99" class="checkbox-custom-label"></label>
											</div>
										</td>
										 
									</tr>
									<tr>
										<td>Currency </td>
										<td>
											<div>
											  <input id="checkbox-100" class="checkbox-custom" name="Currencyview" type="checkbox" <?php  if(isset($userrole->Currency_index)){ if($userrole->Currency_index==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-100" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-101" class="checkbox-custom" name="Currencyadd" type="checkbox" <?php  if(isset($userrole->Currency_add)){ if($userrole->Currency_add==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-101" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-102" class="checkbox-custom" name="Currencyedit" type="checkbox" <?php  if(isset($userrole->Currency_edit)){ if($userrole->Currency_edit==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-102" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-103" class="checkbox-custom" name="Currencydelete" type="checkbox" <?php  if(isset($userrole->Currency_delete)){ if($userrole->Currency_delete==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-103" class="checkbox-custom-label"></label>
											</div>
										</td>
										 
									</tr>
									<tr>
										<td>Locations </td>
										<td>
											<div>
											  <input id="checkbox-104" class="checkbox-custom" name="Locationsview" type="checkbox" <?php  if(isset($userrole->Locations_index)){ if($userrole->Locations_index==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-104" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-105" class="checkbox-custom" name="Locationadd" type="checkbox" <?php  if(isset($userrole->Locations_add)){ if($userrole->Locations_add==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-105" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-106" class="checkbox-custom" name="Locationedit" type="checkbox" <?php  if(isset($userrole->Locations_edit)){ if($userrole->Locations_edit==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-106" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-107" class="checkbox-custom" name="Locationdelete" type="checkbox" <?php  if(isset($userrole->Locations_delete)){ if($userrole->Locations_delete==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-107" class="checkbox-custom-label"></label>
											</div>
										</td>
										 
									</tr>
									<tr>
										<td>Testimonials </td>
										<td>
											<div>
											  <input id="checkbox-108" class="checkbox-custom" name="Testimonialsview" type="checkbox" <?php  if(isset($userrole->Testimonials_index)){ if($userrole->Testimonials_index==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-108" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-109" class="checkbox-custom" name="Testimonialsadd" type="checkbox" <?php  if(isset($userrole->Testimonials_add)){ if($userrole->Testimonials_add==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-109" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-110" class="checkbox-custom" name="Testimonialsedit" type="checkbox" <?php  if(isset($userrole->Testimonials_edit)){ if($userrole->Testimonials_edit==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-110" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-180" class="checkbox-custom" name="Testimonialsedelete" type="checkbox" <?php  if(isset($userrole->Testimonials_delete)){ if($userrole->Testimonials_delete==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-180" class="checkbox-custom-label"></label>
											</div>
										</td>
										 
									</tr>
									<tr>
										<td>Owner Type </td>
										<td>
											<div>
											  <input id="checkbox-111" class="checkbox-custom" name="Owner_Type_view" type="checkbox" <?php  if(isset($userrole->Owner_Type_index)){ if($userrole->Owner_Type_index==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-111" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-112" class="checkbox-custom" name="Owner_Type_add" type="checkbox" <?php  if(isset($userrole->Owner_Type_add)){ if($userrole->Owner_Type_add==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-112" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-113" class="checkbox-custom" name="Owner_Type_edit" type="checkbox" <?php  if(isset($userrole->Owner_Type_edit)){ if($userrole->Owner_Type_edit==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-113" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-114" class="checkbox-custom" name="Owner_Type_delete" type="checkbox" <?php  if(isset($userrole->Owner_Type_delete)){ if($userrole->Owner_Type_delete==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-114" class="checkbox-custom-label"></label>
											</div>
										</td>
										 
									</tr>
									<tr>
										<td>Soc </td>
										<td>
											<div>
											  <input id="checkbox-115" class="checkbox-custom" name="Socview" type="checkbox" <?php  if(isset($userrole->Soc_index)){ if($userrole->Soc_index==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-115" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-116" class="checkbox-custom" name="Socadd" type="checkbox" <?php  if(isset($userrole->Soc_add)){ if($userrole->Soc_add==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-116" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-117" class="checkbox-custom" name="Socedit" type="checkbox" <?php  if(isset($userrole->Soc_edit)){ if($userrole->Soc_edit==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-117" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-118" class="checkbox-custom" name="Socdelete" type="checkbox" <?php  if(isset($userrole->Soc_delete)){ if($userrole->Soc_delete==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-118" class="checkbox-custom-label"></label>
											</div>
										</td>
										 
									</tr>
									<tr>
										<td>Amenities </td>
										<td>
											<div>
											  <input id="checkbox-119" class="checkbox-custom" name="Amenitiesview" type="checkbox" <?php  if(isset($userrole->Amenities_index)){ if($userrole->Amenities_index==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-119" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-120" class="checkbox-custom" name="Amenitiesadd" type="checkbox" <?php  if(isset($userrole->Amenities_add)){ if($userrole->Amenities_add==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-120" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-121" class="checkbox-custom" name="Amenitiesedit" type="checkbox" <?php  if(isset($userrole->Amenities_edit)){ if($userrole->Amenities_edit==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-121" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-122" class="checkbox-custom" name="Amenitiesdelete" type="checkbox" <?php  if(isset($userrole->Amenities_delete)){ if($userrole->Amenities_delete==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-122" class="checkbox-custom-label"></label>
											</div>
										</td>
										 
									</tr>
									<tr>
										<td>Lease Owner </td>
										<td>
											<div>
											  <input id="checkbox-123" class="checkbox-custom" name="Lease_Owner_view" type="checkbox" <?php  if(isset($userrole->Lease_Owner_index)){ if($userrole->Lease_Owner_index==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-123" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-124" class="checkbox-custom" name="Lease_Owner_add" type="checkbox" <?php  if(isset($userrole->Lease_Owner_add)){ if($userrole->Lease_Owner_add==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-124" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-125" class="checkbox-custom" name="Lease_Owner_edit" type="checkbox" <?php  if(isset($userrole->Lease_Owner_edit)){ if($userrole->Lease_Owner_edit==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-125" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-126" class="checkbox-custom" name="Lease_Owner_delete" type="checkbox" <?php  if(isset($userrole->Lease_Owner_delete)){ if($userrole->Lease_Owner_delete==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-126" class="checkbox-custom-label"></label>
											</div>
										</td>
										 
									</tr>
									<tr>
										<td>Booked_guestlist </td>
										<td>
											<div>
											  <input id="checkbox-127" class="checkbox-custom" name="Booked_guestlist_view" type="checkbox" <?php  if(isset($userrole->Booked_guestlist_index)){ if($userrole->Booked_guestlist_index==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-127" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-128" class="checkbox-custom" name="Booked_guestlist_add" type="checkbox" <?php  if(isset($userrole->Booked_guestlist_add)){ if($userrole->Booked_guestlist_add==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-128" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-129" class="checkbox-custom" name="Booked_guestlist_edit" type="checkbox" <?php  if(isset($userrole->Booked_guestlist_edit)){ if($userrole->Booked_guestlist_edit==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-129" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-130" class="checkbox-custom" name="Booked_guestlist_delete" type="checkbox" <?php  if(isset($userrole->Booked_guestlist_delete)){ if($userrole->Booked_guestlist_delete==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-130" class="checkbox-custom-label"></label>
											</div>
										</td>
										 
									</tr>
									<tr>
										<td>Guest Book List </td>
										<td>
											<div>
											  <input id="checkbox-131" class="checkbox-custom" name="Guest_Book_List_view" type="checkbox" <?php  if(isset($userrole->Guest_Book_List_index)){ if($userrole->Guest_Book_List_index==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-131" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-132" class="checkbox-custom" name="Guest_Book_List_add" type="checkbox" <?php  if(isset($userrole->Guest_Book_List_add)){ if($userrole->Guest_Book_List_add==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-132" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-133" class="checkbox-custom" name="Guest_Book_List_edit" type="checkbox" <?php  if(isset($userrole->Guest_Book_List_edit)){ if($userrole->Guest_Book_List_edit==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-133" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-133" class="checkbox-custom" name="Guest_Book_List_delete" type="checkbox" <?php  if(isset($userrole->Guest_Book_List_delete)){ if($userrole->Guest_Book_List_delete==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-133" class="checkbox-custom-label"></label>
											</div>
										</td>
										 
									</tr>
									
									<tr>
										<td>Unit Level </td>
										<td>
											<div>
											  <input id="checkbox-134" class="checkbox-custom" name="unitlevelview" type="checkbox" <?php  if(isset($userrole->unitlevelview)){ if($userrole->unitlevelview==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-134" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-135" class="checkbox-custom" name="unitleveladd" type="checkbox" <?php  if(isset($userrole->unitleveladd)){ if($userrole->unitleveladd==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-135" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-136" class="checkbox-custom" name="unitleveledit" type="checkbox" <?php  if(isset($userrole->unitleveledit)){ if($userrole->unitleveledit==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-136" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-137" class="checkbox-custom" name="unitleveldelete" type="checkbox" <?php  if(isset($userrole->unitleveldelete)){ if($userrole->unitleveldelete==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-137" class="checkbox-custom-label"></label>
											</div>
										</td>
										 
									</tr>
									<tr>
										<td>Delivery Level </td>
										<td>
											<div>
											  <input id="checkbox-138" class="checkbox-custom" name="Deliveryview" type="checkbox" <?php  if(isset($userrole->Delivery_Level_index)){ if($userrole->Delivery_Level_index==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-138" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-139" class="checkbox-custom" name="Deliveryadd" type="checkbox" <?php  if(isset($userrole->Delivery_Level_add)){ if($userrole->Delivery_Level_add==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-139" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-140" class="checkbox-custom" name="Deliveryedit" type="checkbox" <?php  if(isset($userrole->Delivery_Level_edit)){ if($userrole->Delivery_Level_edit==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-140" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-141" class="checkbox-custom" name="Deliverydelete" type="checkbox" <?php  if(isset($userrole->Delivery_Level_delete)){ if($userrole->Delivery_Level_delete==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-141" class="checkbox-custom-label"></label>
											</div>
										</td>
										 
									</tr>
									<tr>
										<td>Booking </td>
										<td>
											<div>
											  <input id="checkbox-142" class="checkbox-custom" name="Booking_view" type="checkbox" <?php  if(isset($userrole->bookingview)){ if($userrole->bookingview==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-142" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-143" class="checkbox-custom" name="Booking_add" type="checkbox" <?php  if(isset($userrole->bookingadd)){ if($userrole->bookingadd==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-143" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-144" class="checkbox-custom" name="Booking_edit" type="checkbox" <?php  if(isset($userrole->bookingedit)){ if($userrole->bookingedit==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-144" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-145" class="checkbox-custom" name="Booking_delete" type="checkbox" <?php  if(isset($userrole->bookingdelete)){ if($userrole->bookingdelete==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-145" class="checkbox-custom-label"></label>
											</div>
										</td>
										 
									</tr>
									<tr>
										<td>Check In </td>
										<td>
											<div>
											  <input id="checkbox-146" class="checkbox-custom" name="checkinview" type="checkbox" <?php  if(isset($userrole->Check_In_index)){ if($userrole->Check_In_index==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-146" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-147" class="checkbox-custom" name="checkinadd" type="checkbox" <?php  if(isset($userrole->Check_In_add)){ if($userrole->Check_In_add==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-147" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-148" class="checkbox-custom" name="checkedit"  type="checkbox" <?php  if(isset($userrole->Check_In_edit)){ if($userrole->Check_In_edit==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-148" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-149" class="checkbox-custom" name="checkdelete" type="checkbox" <?php  if(isset($userrole->Check_In_delete)){ if($userrole->Check_In_delete==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-149" class="checkbox-custom-label"></label>
											</div>
										</td>
										 
									</tr>
									<tr>
										<td>Checkout </td>
										<td>
											<div>
											  <input id="checkbox-150" class="checkbox-custom" name="Checkoutview" type="checkbox" <?php  if(isset($userrole->Checkout_index)){ if($userrole->Checkout_index==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-150" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-151" class="checkbox-custom" name="Checkoutadd" type="checkbox" <?php  if(isset($userrole->Checkout_add)){ if($userrole->Checkout_add==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-151" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-152" class="checkbox-custom" name="Checkoutedit" type="checkbox" <?php  if(isset($userrole->checkout_edit)){ if($userrole->checkout_edit==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-152" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-153" class="checkbox-custom" name="Checkoutdelete" type="checkbox" <?php  if(isset($userrole->Check_In_delete)){ if($userrole->Check_In_delete==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-153" class="checkbox-custom-label"></label>
											</div>
										</td>
										 
									</tr>
									<tr>
										<td>Invoice List </td>
										<td>
											<div>
											  <input id="checkbox-154" class="checkbox-custom" name="invoicelistview" type="checkbox" <?php  if(isset($userrole->Invoice_List_index)){ if($userrole->Invoice_List_index==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-154" class="checkbox-custom-label"></label>
											</div>
										</td>
										
									</tr>
									<tr>
										<td>complaint Services </td>
										<td>
											<div>
											  <input id="checkbox-155" class="checkbox-custom" name="complaintview" type="checkbox" <?php  if(isset($userrole->complaint_Services_index)){ if($userrole->complaint_Services_index==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-155" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-156" class="checkbox-custom" name="complaintadd" type="checkbox" <?php  if(isset($userrole->complaint_Services_add)){ if($userrole->complaint_Services_add==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-156" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-157" class="checkbox-custom" name="complaintedit" type="checkbox" <?php  if(isset($userrole->complaint_Services_edit)){ if($userrole->complaint_Services_edit==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-157" class="checkbox-custom-label"></label>
											</div>
										</td>
										<td>
											<div>
											  <input id="checkbox-158" class="checkbox-custom" name="complaintdelete" type="checkbox" <?php  if(isset($userrole->complaint_Services_delete)){ if($userrole->complaint_Services_delete==1){ echo 'checked' ; } } ?> value="1">
											  <label for="checkbox-158" class="checkbox-custom-label"></label>
											</div>
										</td>
										 
									</tr>
									
								</tbody>
							</table>
         				</div>
         			</div>
					<input class="btn btn-primary" type="submit" value="Update" style="margin:22px;">
         		</div>
				</form>
         	</div>
          </div><!-- /.row -->
</section>
