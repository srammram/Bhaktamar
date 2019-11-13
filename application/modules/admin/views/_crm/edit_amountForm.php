<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap-datepicker.min.css">
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
              <form method="post" action="<?php echo site_url('admin/crm/Crm/editamount/'.$customer_id); ?>" enctype="multipart/form-data" id="Clientform">	
					<div class="form-group">
					  <div class="row">
						<div class="col-md-2">
                      		<label><?php echo lang('Customer_name') ?></label> <span style="color:red">*</span>
							  
                      	</div>
						<div class="col-md-3">
						<?php if(isset($name1)){ echo $name1;  }   ?>
						</div>	
						<div class="col-md-2">
                      		<label><?php echo lang('Customer_name2') ?></label>
							
                      	</div>
						<div class="col-md-3">
						<?php if(isset($name2)){ echo $name2;  }   ?>
							
						</div>	
						
					  </div>		
                    </div>
					<div class="form-group">
					  <div class="row">
						 <div class="col-md-2">
                      		<label><?php echo lang('amount') ?></label>
                      	</div>
                        <div class="col-md-3 amount">
                        <input type="text" name="amount" class="form-control allowdecimalpoint"   autocomplete='off' value="<?php if(isset($amount)){ echo $amount;  }   ?>">
						<!--<span style="float:right;"class="glyphicon glyphicon-plus nationidadd"></span>  -->
                        </div>	
                         <div class="col-md-2">
                      		<label><?php echo lang('Paid_date') ?></label>
                      	</div>
                        <div class="col-md-3 date">
						
                       <input type='text' name="date" class="form-control datepicker"  value=
"<?php if(isset($date)){ echo date('Y-m-d',strtotime($date));  }   ?>"					   />
						<!--<span style="float:right;"class="glyphicon glyphicon-plus nationidadd"></span>-->
                        </div>	
                    </div>
                    </div>
					<div class="box-footer">
					<input type="hidden" name="enquiryid" value=
"<?php if(isset($enquyiry_id)){ echo $enquyiry_id;  }   ?>"	 >
<input type="hidden" name="customerid" value=
"<?php if(isset($customer_id)){ echo $customer_id;  }   ?>"	 >
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