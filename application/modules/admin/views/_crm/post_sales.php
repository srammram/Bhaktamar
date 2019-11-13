<link href="<?php echo base_url('assets/admin/plugins/iCheck/all.css')?>" rel="stylesheet" type="text/css" />
       <link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap-3.3.2.min.css" type="text/css">
        <script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/jquery-2.1.3.min.js"></script>
        <link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/js/bootstrap-3.3.2.min.js" type="text/css">
        <link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap-multiselect.css" type="text/css">
        <script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/bootstrap-multiselect.js"></script>
<style>
.error{
    color: #FF0000;
}
</style>    
  <?php   $seg= $this->uri->segment(5);?>
<section class="content-header">
          <h1>
            <?php echo $page_title; ?>
           </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
			<li><a href="<?php echo site_url('admin/crm/Crm/Clientform') ?>"> <?php echo lang('Client')?> </a></li>
            <li class="active"><?php echo (empty($seg))?lang('add'):lang('edit');?></li>
          </ol>
</section>
<br>
	<section class="content">
		  <div class="row">
            <div class="col-xs-12">
              <div class="box">
			  	 <div class="box-header">
                  <h3 class="box-title"> <?php echo $page_title; ?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
              <form method="post" action="<?php echo site_url('admin/crm/Crm/Clientform/'.$customer_id); ?>" enctype="multipart/form-data" id="Clientform">	
					<div class="form-group">
					  <div class="row">
						<div class="col-md-2">
                      		<label><?php echo lang('Customer_name') ?></label> <span style="color:red">*</span>
							<input class="checkbox_s is_display1" value="1" name="is_display1"type="checkbox" <?php if(isset($is_display1)){if($is_display1 == 1){  echo 'checked';  } }   ?>  />
                      	</div>
						<div class="col-md-3">
							<input type="text"  autocomplete="off"  name="Customername" class="form-control" value="<?php if(isset($customer_name)){ echo $customer_name;  }   ?>">
						</div>	
						<div class="col-md-2">
                      		<label><?php echo lang('Customer_name2') ?></label>
							<input class="checkbox_s is_display2" value="1" name="is_display2"type="checkbox" <?php if(isset($is_display2)){if($is_display2 == 1){  echo 'checked';  } }   ?>  />
                      	</div>
						<div class="col-md-3">
							<input type="text" autocomplete="off"  name="Customername2" class="form-control" value="<?php if(isset($customername2)){ echo $customername2;  }   ?>">
							
						</div>	
						
					  </div>		
                    </div>
					<div class="form-group">
					  <div class="row">
						 <div class="col-md-2">
                      		<label><?php echo lang('NationalId') ?></label>
                      	</div>
                        <div class="col-md-3 nationalid">
                        <input type="text" name="NationalId" class="form-control "   autocomplete='off' value="<?php if(isset($nationalid)){ echo $nationalid;  }   ?>">
						<!--<span style="float:right;"class="glyphicon glyphicon-plus nationidadd"></span>  -->
                        </div>	
                         <div class="col-md-2">
                      		<label><?php echo lang('NationalId2') ?></label>
                      	</div>
                        <div class="col-md-3 nationalid">
						
                        <input type="text" name="NationalId2" class="form-control "   autocomplete='off' value="<?php if(isset($nationalid2)){ echo $nationalid2;  }   ?>">
						<!--<span style="float:right;"class="glyphicon glyphicon-plus nationidadd"></span>-->
                        </div>	
                    </div>
                    </div>
					
						<div class="form-group">
					  <div class="row">
					 <div class="col-md-2">
                      		<label><?php echo lang('DOB') ?></label>
                      	</div>
						<div class="col-md-3">
                        <input type="text" name="dob" class="form-control datepicker"   autocomplete='off' value="<?php if(isset($dob)){ echo $dob;  }   ?>">
                        </div>
								<div class="col-md-2">
                      		<label><?php echo lang('DOB2') ?></label>
                      	</div>
						<div class="col-md-3">
                        <input type="text" name="dob2" class="form-control datepicker"   autocomplete='off' value="<?php if(isset($dob2)){ echo $dob2;  }   ?>">
                        </div>						
						
					  </div>		
                    </div>
					 <div class="form-group">
					  <div class="row">
						<div class="col-md-2">
                      		<label><?php echo lang('Contact_number') ?></label><span style="color:red"> *</span>
                      	</div>
						<div class="col-md-3">
                        <input type="text" name="contactnumber" class="form-control "   autocomplete='off' value="<?php if(isset($contact_number)){ echo $contact_number;  }   ?>">
                        </div>	
                        <div class="col-md-2">
                      		<label><?php echo lang('email') ?></label>
                      	</div>
                        <div class="col-md-3">
                        <input type="text" name="email" class="form-control "   autocomplete='off'  value="<?php if(isset($email)){ echo $email;  }   ?>">
                        </div>	
                    </div>
                    </div>
					<div class="form-group">
					  <div class="row">
						<div class="col-md-2">
                      		<label><?php echo lang('Customer_address1') ?></label>
                      	</div>
						<div class="col-md-3">
                        <textarea autocomplete="off"  name="address1" class="form-control"><?php if(isset($address)){ echo $address;  }   ?></textarea>
                        </div>	
                        <div class="col-md-2">
                      		<label><?php echo lang('Customer_address2') ?></label>
                      	</div>
                        <div class="col-md-3">
                        <textarea name="address2" autocomplete="off"  class="form-control"><?php if(isset($customeraddress2)){ echo $customeraddress2;  }   ?></textarea>
                        </div>	
                    </div><br>
					
					
					
                   
						
				
					<div class="form-group">
					  <div class="row">
					  <div class="col-md-2">
                      		<label><?php echo lang('select_country') ?></label>
                      	</div>
                        <div class="col-md-3">
					<select name="country" class="form-control" >
								<option >Select</option>
								<?php 
								if(isset($countries)){
									foreach($countries as $country){
									?>
								<option value="<?php  echo $country->id   ?>"<?php  if(isset($country_id)){ echo $country_id == $country->id ?'selected':'' ;  } ?>><?php  echo $country->name  ?></option>	
										<?php
									}
								}
								?>
							</select>
                        </div>	
					<div class="col-md-2">
                      		<label><?php echo lang('City') ?></label>
                      	</div>
                        <div class="col-md-3">
                        <input type="text" name="city" class="form-control "   autocomplete='off' value="<?php if(isset($city)){ echo $city;  }   ?>">
                        </div>
                        
                    </div>
					<br>
                    </div>
                    </div>
					<div class="form-group">
						<div class="row">
							<div class="col-md-2">
                      		<label><?php echo lang('occupation') ?> </label>
                      	</div>
						<div class="col-md-3">
							<input type="text" name="occupation"  autocomplete='off' class="form-control" value="<?php if(isset($occupation)){ echo $occupation;  }   ?>">
						</div>
					
					<div class="col-md-2">
                      		<label><?php echo lang('contract_Number') ?></label>
                      	</div>
								<div class="col-md-3">
							<input type="text" name="contractnumber"  autocomplete='off' class="form-control" value="<?php if(isset($contractNumber)){ echo $contractNumber;  }   ?>">
						</div>
								<!-- /.input group -->
								
							</div>
						
                    </div>
					     
					<div class="form-group">
						<div class="row">
						<div class="col-md-2">
                      		<label><?php echo lang('SalesPersontype') ?></label>
                      	</div>
						<div class="col-md-3">
						<select name="salespersontype" class="form-control"  onchange="get_agent(this.value)">
								<option >Select</option>
									<option value="<?php echo lang('Executive')  ?>"<?php  if(isset($SalesPersontype)){ echo $SalesPersontype == lang('Executive')  ?'selected':'' ;  } ?>><?php echo lang('Executive')  ?></option>
										<option value="<?php echo lang('Agent')  ?>"<?php  if(isset($SalesPersontype)){ echo $SalesPersontype == lang('Agent') ?'selected':'' ;  } ?>><?php echo lang('Agent')  ?></option>
							</select>
						</div>	
						<div class="col-md-2">
                      		<label><?php echo lang('SalesPerson') ?></label>
                      	</div>
						<div class="col-md-3">
						<select name="salesperson" class="form-control" id="salesperson" >
						<?php 
								if(isset($salespersons)){
									foreach($salespersons as $salesperson){
									?>
								<option value="<?php  echo $salesperson->id   ?>"<?php  if(isset($agentid)){ echo $agentid == $salesperson->id ?'selected':'' ;  } ?>><?php  echo $salesperson->Name  ?></option>	
										<?php
									}
								}
								?>
							</select>
						</div>	
								<!-- /.input group -->
							</div>
                    </div>
					<div class="form-group">
						<div class="row">
							<div class="col-md-2">
                      		<label><?php echo lang('Initial_Amount') ?> </label>
                      	</div>
						<div class="col-md-3">
							<input type="text" name="initialamount"  autocomplete='off' class="form-control" value="<?php if(isset($initial_amount)){ echo $initial_amount;  }   ?>">
						</div>
					
						
                    </div>
					<br>
                   
					<div class="box-footer">
					
							<input class="btn btn-primary" type="submit" id="enquirybtn" value="Save"/>
					</div>
					</form>
     			 </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div><!-- /.col -->
          </div><!-- /.row -->
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
 	
	      });
</script>

<script type="text/javascript">
 $(document).ready(function() {
    $('#my-select').multiselect();
  });
 </script>