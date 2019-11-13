<link href="<?php echo base_url('assets/admin/plugins/iCheck/all.css')?>" rel="stylesheet" type="text/css" />

<?php   $seg= $this->uri->segment(5);?>
<section class="content-header">
          <h1>
            <?php echo $page_title; ?>
           </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
			<li><a href="<?php echo site_url('admin/crm/Crm/Enquiry') ?>"> <?php echo lang('Enquiry')." ".lang('view') ?> </a></li>
          </ol>
</section>
	<section class="content">
		  <div class="row">
            <div class="col-xs-12">
              <div class="box">
			  	 <div class="box-header">
                  <h3 class="box-title"><?php echo $page_title; ?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                
					<div class="form-group">
					  <div class="row">
						<div class="col-md-2">
                      		<label><?php echo lang('Customer_name') ?></label> <span style="color:red">*</span>
                      	</div>
						<div class="col-md-3">
							<?php if(isset($enquiry->Customer_name)){ echo $enquiry->Customer_name;  }   ?>
						</div>	
						<div class="col-md-2">
                      		<label><?php echo lang('Customer_name2') ?></label> <span style="color:red">*</span>
                      	</div>
						<div class="col-md-3">
							<?php if(isset($enquiry->customername2)){ echo $enquiry->customername2;  }   ?>
						</div>	
						
					  </div>		
                    </div>
					<div class="form-group">
					  <div class="row">
						 <div class="col-md-2">
                      		<label><?php echo lang('NationalId') ?></label>
                      	</div>
                        <div class="col-md-3 nationalid">
                          <?php if(isset($enquiry->nationalid)){ echo $enquiry->nationalid;  }   ?>
                        </div>	
                         <div class="col-md-2">
                      		<label><?php echo lang('NationalId2') ?></label>
                      	</div>
                        <div class="col-md-3 nationalid">
						   <?php if(isset($enquiry->nationalid2)){ echo $enquiry->nationalid2;  }   ?>                        </div>	
                    </div>
					</div>
					
						<div class="form-group">
					  <div class="row">
					 <div class="col-md-2">
                      		<label><?php echo lang('DOB') ?></label>
                      	</div>
						<div class="col-md-3">
                       <?php if(isset($enquiry->dob)){ echo $enquiry->dob;  }   ?>
                        </div>
								<div class="col-md-2">
                      		<label><?php echo lang('DOB2') ?></label>
                      	</div>
						<div class="col-md-3">
                       <?php if(isset($enquiry->dob2)){ echo $enquiry->dob2;  }   ?>
                        </div>						
						
					  </div>		
                    </div>
					
                    <div class="form-group">
					  <div class="row">
						<div class="col-md-2">
                      		<label><?php echo lang('Contact_number') ?></label><span style="color:red"> *</span>
                      	</div>
						<div class="col-md-3">
                         <?php if(isset($enquiry->contact_number)){ echo $enquiry->contact_number;  }   ?>
                        </div>	
                        <div class="col-md-2">
                      		<label><?php echo lang('email') ?></label>
                      	</div>
                        <div class="col-md-3">
                        <?php if(isset($enquiry->email)){ echo $enquiry->email;  }   ?>
                        </div>	
                    </div>
                    </div>
					<div class="form-group">
					  <div class="row">
						<div class="col-md-2">
                      		<label><?php echo lang('Customer_address1') ?></label>
                      	</div>
						<div class="col-md-3">
                      <?php if(isset($enquiry->address)){ echo $enquiry->address;  }   ?>
                        </div>	
                        <div class="col-md-2">
                      		<label><?php echo lang('Customer_address2') ?></label>
                      	</div>
                        <div class="col-md-3">
                       <?php if(isset($enquiry->customeraddress2)){ echo $enquiry->customeraddress2;  }   ?>
                        </div>	
                    </div><br>
					
                    </div>
					<div class="form-group">
					  <div class="row">
					  <div class="col-md-2">
                      		<label><?php echo lang('Project') ?></label><span style="color:red"> *</span>
                      	</div>
						<div class="col-md-3">
						<?php if(isset($enquiry->projectname)){ echo $enquiry->projectname;  }   ?>
						</div>	
						
					  <div class="col-md-2">
                      		<label><?php echo lang('Type_for') ?></label>
                      	</div>
						<div class="col-md-3">
								<?php if(isset($enquiry->ProjectType)){ echo $enquiry->ProjectType;  }   ?>					</div>	
						
					  </div>		
                    </div>
					<div class="form-group">
					  <div class="row">
					  <div class="col-md-2">
                      		<label><?php echo lang('Units') ?></label>
                      	</div>
						
						<div class="col-md-3">
							<?php 
								if(isset($unitslists)){
									foreach($unitslists as $unitslist){
									   echo  $enquiry->unitid == $unitslist->uid ?  $unitslist->unit_no:'' ; 
									}
								}
								?>
						</div>	
						<div class="col-md-2">
                      		<label><?php echo lang('Enquiry_date') ?></label><span style="color:red"> *</span>
                      	</div>
						<div class="col-md-3">
																<?php if(isset($enquiry->enquiry_date)){ echo $enquiry->enquiry_date;  }   ?>
								</div>
						
					  </div>		
                    </div>
					<div class="form-group">
					  <div class="row">
					  
						
						<div class="col-md-2">
                      		<label><?php echo lang('Budget') ?></label>
                      	</div>
						<div class="col-md-3">
						<?php  echo $this->sma->formatMoney($enquiry->Budget)  ;  ?>
							
						</div>	
						<div class="col-md-2">
                      		<label><?php echo lang('Suggets_modification') ?></label>
                      	</div>
						<div class="col-md-3">
						<?php 
								if(isset($Amenities)){
									foreach($Amenities as $Amenitie){
									echo 	$selected = in_array( $Amenitie->id, json_decode($enquiry->suggest_modification )) ?   $Amenitie->Name .", " : '';  
									}
								}
								?>
						</div>	
					  </div>		
                    </div>
					
					
					
						<div class="form-group">
					  <div class="row">
										<div class="col-md-2">
                      		<label><?php echo lang('occupation') ?> </label>
                      	</div>
						<div class="col-md-3">
						<?php if(isset($enquiry->occupation)){ echo $enquiry->occupation;  }   ?>
						</div>
						
						<div class="col-md-2">
                      		<label><?php echo lang('Location_preference') ?></label>
                      	</div>
						<div class="col-md-3">
                       <?php if(isset($enquiry->location_preference)){ echo $enquiry->location_preference;  }   ?>
						</div>	
					  </div>		
                    </div>
				
					<div class="form-group">
					  <div class="row">
					  <div class="col-md-2">
                      		<label><?php echo lang('select_country') ?></label>
                      	</div>
                        <div class="col-md-3">
					 <?php if(isset($enquiry->countryname)){ echo $enquiry->countryname;  }   ?>
                        </div>	
					<div class="col-md-2">
                      		<label><?php echo lang('City') ?></label>
                      	</div>
                        <div class="col-md-3">
                       <?php if(isset($enquiry->city)){ echo $enquiry->city;  }   ?>
                        </div>
                        
                    </div>
					<br>
                    
                    </div>
                    
                    
					<div class="form-group">
						<div class="row">
						<div class="col-md-2">
                      		<label><?php echo lang('SalesPersontype') ?></label>
                      	</div>
						<div class="col-md-3">
						<?php  echo $enquiry->SalesPersontype == lang('Executive')  ?  lang('Executive'):'' ;   ?>
									<?php  echo $enquiry->SalesPersontype == lang('Agent')  ?  lang('Agent'):'' ;   ?>
						</div>	
						<div class="col-md-2">
                      		<label><?php echo lang('SalesPerson') ?></label>
                      	</div>
						<div class="col-md-3">
						<?php 
								if(isset($salespersons)){
									foreach($salespersons as $salesperson){
										  echo  $enquiry->agentid == $salesperson->id ? $salesperson->Name:'' ; 
									
									}
								}
								?>
						</div>	
								<!-- /.input group -->
							</div>
                    </div>
					<div class="form-group">
						<div class="row">
			
					<div class="col-md-2">
                      		<label><?php echo lang('Project_doc') ?></label>
                      	</div>
					<div class="col-md-3">
							
							<?php if(!empty($enquiry->document_path)){?>
								<a href="<?php echo base_url('uploads/enquiry/'.$enquiry->document_path)?>" class="btn btn-default" download><?php echo lang('download')?></a>
								<?php }else{ echo 'No File Found';  } ?>
						     </div>	
							
								<!-- /.input group -->
								
							</div>
						
                    </div>
					<br>
                         <div class="form-group">
						<div class="row">
						<div class="col-md-2 col-md-offset-2">
                        <input class="checkbox_s status" value="1" name="status" disabled type="checkbox" <?php if($enquiry->enquiry_status == 1){  echo 'checked';  }   ?>  />
                        <label><?php echo lang('Follow_up') ?></label>
                        </div>	
                        <div class="col-md-2">
						<input class="checkbox_s status" value="2" name="status"type="checkbox" disabled <?php if($enquiry->enquiry_status == 2){  echo 'checked' ;  }   ?> />
                        <label><?php echo lang('Trash') ?></label>
                                           
						</div>	
								<!-- /.input group -->
							</div>
                    </div>
					
     			 </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div><!-- /.col -->
          </div><!-- /.row -->
        </section>
<script>

 $(function() {
 	$('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
     });
	      });
</script>