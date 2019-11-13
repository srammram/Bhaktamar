  
  <?php  $seg= $this->uri->segment(4);?>
  <link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap-datepicker.min.css">
<section class="content-header">
          <h1>
            <?php echo $page_title; ?>
           </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
			<li><a href="<?php echo site_url('admin/settings/soe') ?>"> <?php echo lang('source_of_enquiry')?> </a></li>
            <li class="active"><?php echo (empty($seg))?lang('add'):lang('edit');?></li>
          </ol>
</section>
     <section class="content">
		  <div class="row">
            <div class="col-xs-12">
              <div class="box">
			  <div class="box-header">
                  <h3 class="box-title"><?php echo lang('Sales_commissionEdit'); ?></h3>
                </div>
                <div class="box-body">
				<form method="post" action="<?php echo site_url('admin/sales/Sales/saleCommissionPaymentedit/'.$id); ?>" enctype="multipart/form-data">	
					<div class="box-body">
          <div class="form-group">
            <label for="Name"><?php echo lang('Agent_name')?></label></label><br>
             <?php  if(isset($salesCommission->name)){  echo $salesCommission->name;   }  ?>
          </div>
          <div class="form-group">
            <label for="date"><?php echo lang('date')?><span class="errorStar">*</span></label>
       		<input type="text" name="date" class="form-control datepicker"   autocomplete='off' value=" <?php  if(isset($salesCommission->paid_date)){  echo date('Y-m-d',strtotime($salesCommission->paid_date));   }  ?>" required>
		<input type="hidden" name="id" value=" <?php  if(isset($salesCommission->commission_id)){  echo $salesCommission->commission_id;   }  ?>"  >
          </div>
		  <div class="form-group">
            <label for="amount"><?php echo lang('amount')?><span class="errorStar">*</span></label>
            <input type="text" name="amount" value=" <?php  if(isset($salesCommission->commission_paid)){  echo $salesCommission->commission_paid;   }  ?>"  class="form-control"  required />
	
          </div>
		  <div class="form-group">
            <label for="note"><?php echo lang('Note')?><span class="errorStar">*</span></label>
            <textarea autocomplete="off"  name="note" class="form-control"><?php  if(isset($salesCommission->note)){  echo $salesCommission->note;   }  ?></textarea>
          </div>
		
        </div>
		              <div class="box-footer">
					     <input class="btn btn-primary" type="submit" value="Save"/>
					</div>
					</form>
     			 </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div><!-- /.col -->
          </div><!-- /.row -->
        </section>
	
<script>
    $('.datepicker').datepicker({
        weekStart: 1,
        autoclose: true,
        todayHighlight: true,
		  format: "yyyy-mm-dd",
    });
   // $('.datepicker').datepicker("setDate", new Date());

</script>