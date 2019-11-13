<style>
.table-bordered>thead>tr>th{
	    background-color: #FFF !important;
		color: black !important;
}
</style>
<section class="content-header">
          <h1>
            <?php echo $page_title; ?>
           </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
			<li><a href="<?php echo site_url('admin/Resident') ?>"><?php echo lang('resident')?></a></li>
            <li class="active"><?php echo lang('view')?> <?php echo lang('resident')?></li>
          </ol>
</section>
<section class="content">
		  <div class="row">
            <div class="col-xs-12">
              <div class="box">
			  	<div class="box-body">
				 	<div class="box-content">
							<div class="col-lg-12 well well-sm">
								<legend style="font-weight:bold;">Project Details</legend>
								<table class="table">
									<tbody>
										<tr>
											<td>
												<table class="table">
													<colgroup>
														<col width="49%">
														<col width="1%">
														<col width="50%">
													</colgroup>
													<tbody>
														<tr>
															<td>Project Name</td>
															<td>:</td>
															<td>fdgfd</td>
														</tr>
														<tr>
															<td>Project flow</td>
															<td>:</td>
															<td></td>
														</tr>
													</tbody>
												</table>
											</td>
											<td>
												<table class="table">
													<colgroup>
														<col width="49%">
														<col width="1%">
														<col width="50%">
													</colgroup>
													<tbody>
														<tr>
															<td>Project Building</td>
															<td>:</td>
															<td></td>
														</tr>
														<tr>
															<td>Project Unit</td>
															<td>:</td>
															<td></td>
														</tr>
													</tbody>
												</table>
											</td>
										</tr>
									</tbody>
								</table>
								
							</div>
							<div class="col-lg-12 well well-sm">
							<legend style="font-weight:bold;">Family Members</legend>
								<div class="table-responsive col-sm-12">
									<table id="UnitTable" class="table table-bordered table-hover table-striped reports-table">
										<thead>
											<tr>
												<th><?= lang("id"); ?></th>
												<th>Name</th>
												<th>Gender</th>
												<th>Age</th>
												<th>Relationship</th>
												<th>ID NO</th>
												<th>DOB</th>
												<th>Photo</th>
											</tr>
										</thead>
										<tbody>
										<?php  if(!empty($tenant->family_members)){ $i=1;foreach(json_decode($tenant->family_members) as $row){  ?>
										<tr>
										<td><?php echo $i   ; ?></td>
										<td><?php echo $row->name   ; ?></td>
										<td><?php echo $row->gender   ; ?></td>
										<td><?php echo $row->age   ; ?></td>
										<td><?php echo $row->relationship   ; ?></td>
										<td><?php echo $row->id_no   ; ?></td>
										<td><?php echo $row->dob   ; ?></td>
										<td>
										<?php if(!empty($row->photo)){  ?>
										<img src="<?php echo base_url('uploads/tenant/familymembers/'.$row->photo)?>"  height="60" width="60" alt="User Image"/>
										<?php   }else{ ?>
										<img src="<?php echo base_url('uploads/tenant/familymembers/noimage.jpg')?>"  height="32" width="60" alt="User Image"/>
										<?php  }  ?>
										</td>
										</tr>
										<?php  $i++; } }else{  ?>
											<tr>
												<td colspan="8" class="dataTables_empty">
												  No Data Found
												</td>
											</tr>

										<?php  } ?>
										</tbody>
									</table>
								</div>
							</div>
           		
           					<div class="col-lg-12 well well-sm">
								<legend style="font-weight:bold;">Payment Details</legend>
								<div class="table-responsive col-sm-12">
									<table id="UnitTable" class="table table-bordered table-hover table-striped reports-table">
										<thead>
											<tr>
												<th>Date</th>
												<th>Amount</th>
												<th>Note</th>
												<th>Status</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>12-08-2019</td>
												<td>254645645</td>
												<td>vijayabalan</td>
												<td>success</td>
											</tr>
										</tbody>
									</table>
							</div>
            		</div>
               				<div class="col-lg-12 well well-sm">
								<legend style="font-weight:bold;">Agreement Details</legend>
								<table class="table">
									<tbody>
										<tr>
											<td>
												<table class="table">
													<colgroup>
														<col width="49%">
														<col width="1%">
														<col width="50%">
													</colgroup>
													<tbody>
														<tr>
															<td>Date</td>
															<td>:</td>
															<td>fdgfd</td>
														</tr>
														<tr>
															<td>Project flow</td>
															<td>:</td>
															<td></td>
														</tr>
													</tbody>
												</table>
											</td>
											<td>
												<table class="table">
													<colgroup>
														<col width="49%">
														<col width="1%">
														<col width="50%">
													</colgroup>
													<tbody>
														<tr>
															<td>Project Building</td>
															<td>:</td>
															<td></td>
														</tr>
														<tr>
															<td>Project Unit</td>
															<td>:</td>
															<td></td>
														</tr>
													</tbody>
												</table>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
                </div><!-- /.box -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section>
