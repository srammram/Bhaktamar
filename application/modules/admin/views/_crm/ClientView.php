<link href="<?php echo base_url('assets/admin/plugins/iCheck/all.css')?>" rel="stylesheet" type="text/css" />

<?php   $seg= $this->uri->segment(5);?>
<section class="content-header">
          <h1>
            <?php echo $page_title; ?>
           </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
			<li><a href="<?php echo site_url('admin/crm/Crm/ClientView') ?>"> <?php echo lang('Client')." ".lang('view') ?> </a></li>
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
                      		<label><?php echo lang('Customer_name') ?></label>
                      	</div>
						<div class="col-md-3">
							<?php if(isset($client->customer_name)){ echo $client->customer_name;  }   ?>
						</div>	
						<div class="col-md-2">
                      		<label><?php echo lang('Customer_name2') ?></label>
                      	</div>
						<div class="col-md-3">
							<?php if(isset($client->customername2)){ echo $client->customername2;  }   ?>
						</div>	
						
					  </div>		
                    </div>
					<div class="form-group">
					  <div class="row">
						 <div class="col-md-2">
                      		<label><?php echo lang('NationalId') ?></label>
                      	</div>
                        <div class="col-md-3 nationalid">
                        <?php if(isset($client->nationalid)){ echo $client->nationalid;  }   ?>
						<!--<span style="float:right;"class="glyphicon glyphicon-plus nationidadd"></span>  -->
                        </div>	
                         <div class="col-md-2">
                      		<label><?php echo lang('NationalId2') ?></label>
                      	</div>
                        <div class="col-md-3 nationalid">
						
                        <?php if(isset($client->nationalid2)){ echo $client->nationalid2;  }   ?>
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
                        <?php if(isset($client->dob)){ echo $client->dob;  }   ?>
                        </div>
								<div class="col-md-2">
                      		<label><?php echo lang('DOB2') ?></label>
                      	</div>
						<div class="col-md-3">
                        <?php if(isset($client->dob2)){ echo $client->dob2;  }   ?>
                        </div>						
						
					  </div>		
                    </div>
					
                    <div class="form-group">
					  <div class="row">
						<div class="col-md-2">
                      		<label><?php echo lang('Contact_number') ?></label>
                      	</div>
						<div class="col-md-3">
                        <?php if(isset($client->contact_number)){ echo $client->contact_number;  }   ?>
                        </div>	
                        <div class="col-md-2">
                      		<label><?php echo lang('email') ?></label>
                      	</div>
                        <div class="col-md-3">
                        <?php if(isset($client->email)){ echo $client->email;  }   ?>
                        </div>	
                    </div>
                    </div>
					<div class="form-group">
					  <div class="row">
						<div class="col-md-2">
                      		<label><?php echo lang('Customer_address1') ?></label>
                      	</div>
						<div class="col-md-3">
                        <?php if(isset($client->address)){ echo $client->address;  }   ?>
                        </div>	
                        <div class="col-md-2">
                      		<label><?php echo lang('Customer_address2') ?></label>
                      	</div>
                        <div class="col-md-3">
                        <?php if(isset($client->customeraddress2)){ echo $client->customeraddress2;  }   ?>
                        </div>	
                    </div><br>
					
					
					
						
				
					<div class="form-group">
					  <div class="row">
					  <div class="col-md-2">
                      		<label><?php echo lang('select_country') ?></label>
                      	</div>
                        <div class="col-md-3">
					
								<?php 
								if(isset($countries)){
									foreach($countries as $country){
									?>
								<?php  if(isset($client->country)){ echo $client->country == $country->id ?$country->name:'' ;  } ?>
										<?php
									}
								}
								?>
							
                        </div>	
					<div class="col-md-2">
                      		<label><?php echo lang('City') ?></label>
                      	</div>
                        <div class="col-md-3">
                        <?php if(isset($client->city)){ echo $client->city;  }   ?>
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
							<?php if(isset($client->occupation)){ echo $client->occupation;  }   ?>
						</div>
					
					<div class="col-md-2">
                      		<label><?php echo lang('contract_Number') ?></label>
                      	</div>
								<div class="col-md-3">
							<?php if(isset($client->contractNumber)){ echo $client->contractNumber;  }   ?>
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
							<?php if(isset($client->initial_amount)){ echo $this->sma->formatMoney($client->initial_amount)  ;  }   ?>
						</div>
					
						
                    </div>
					<br>
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