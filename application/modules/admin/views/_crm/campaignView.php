
  <script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/jquery1.min.js"></script>
 <script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/select2.min.js"></script>
 <link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap-datepicker.min.css">
 <link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap3.3.min.css">
 <link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/select2.min.css">

<?php   $seg= $this->uri->segment(5);?>
<section class="content-header">
          <h1>
            <?php echo $page_title; ?>
           </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
			<li><a href="<?php echo site_url('admin/crm/Crm/campaign') ?>"> <?php echo lang('campaign')." ".lang('view') ?> </a></li>
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
                  <div class="col-xs-12">
                         <div class="row">
                         <div class="form-group col-md-5">
                             <label><?php echo lang('campaign_name') ?></label> <br>
                             <?php if(isset($campaign->campaign_name)){ echo $campaign->campaign_name;  }   ?>
                         </div>
                         <div class="form-group col-md-5">
                             <label><?php echo lang('purpose') ?></label><br>
                            <?php if(isset($campaign->purpose)){ echo $campaign->purpose;  }   ?>
                         </div>
                         </div>
                          <div class="row">
                         <div class="form-group col-md-5">
                             <label><?php echo lang('created_by') ?></label><br>
							 <?php if(isset($campaign->first_name)){ echo $campaign->first_name;  }   ?>
                         </div>
                         
                         <div class="form-group col-md-5">
                             <label><?php echo lang('leads') ?></label><br>
                                 <?php  if(isset($leads)){ foreach($leads as $row){ $selected = in_array( $row->enquiry_id, json_decode($campaign->members) ) ? $row->Customer_name .'<br>' : '';   ?>
                                 <?php echo $selected; ?>
                                   
                                 <?php }  } ?>
                             </select>
                         </div>
                         </div>
                        <div class="row">
                         <div class="form-group col-md-5"><br>
                             <label><?php echo lang('description') ?></label>
                             <?php if(isset($campaign->description)){ echo $campaign->description;  }   ?>
							 </div>
							 </div>
							</div>
					</div><!-- /.box-body -->
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