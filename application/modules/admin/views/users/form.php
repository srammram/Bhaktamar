<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap-datepicker.min.css">

<?php  $seg= $this->uri->segment(4);?>
<section class="content-header">
   <h1>
      <?php echo $page_title; ?>
   </h1>
   <ol class="breadcrumb">
      <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i>
         <?php echo lang('dashboard')?></a>
      </li>
      <li><a href="<?php echo site_url('admin/Users') ?>"> <?php echo lang('Users')?> </a></li>
      <li class="active"><?php echo (empty($seg))?lang('add'):lang('edit');?></li>
   </ol>
</section>
<section class="content">
   <div class="row">
      <div class="col-xs-12">
         <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">
					<?php echo lang('Users')?>
                    </h3>
                </div><!-- /.box-header -->
            <div class="box-body">
               <form method="post" class="userform" action="<?php echo site_url('admin/users/form/'.$id); ?>"
                  enctype="multipart/form-data">
                  <div class="box-body">
                     <div class="col-md-12">
                        <div class="col-md-5">
                           <div class="form-group">
                              <label for="first_name">First Name *</label>                             
                              <div class="controls">
                                 <input type="text" name="first_name"  class="form-control" id="first_name" required="required"  data-bv-field="first_name" autocomplete="off" value="<?php  if(isset($first_name)){ echo $first_name;  }     ?>">
                              </div>
                           </div>
                          
                           <div class="form-group">
                              <label for="gender">Gender *</label>                               
                              <select name="gender" class="tip form-control" id="gender" data-placeholder="Select Gender" required="required"  >
                                    <option value="male"  <?php  if(isset($gender)){ echo $gender ==1 ?'selected':'' ;  } ?>>Male</option>
                                    <option value="female"  <?php  if(isset($gender)){ echo $gender ==1 ?'selected':'' ;  } ?>>Female</option>
                              </select>
                           </div>
                           <!-- <div class="form-group">
                              <label for="company">Company</label>                                <div class="controls">
                                  <input type="text" name="company" value=""  class="form-control" id="company" required="required" />
                              </div>
                              </div>-->
                           <div class="form-group">
                              <label for="phone">Phone *</label>                                
                              <div class="controls">
                                 <input type="text" name="phone"  class="form-control numberonly" id="phone" required="required" data-bv-field="phone" autocomplete="off"
								  value="<?php  if(isset($Users->phone)){ echo $Users->phone;  }     ?>">
                              </div>
                             
                           </div>
                           <div class="form-group">
                              <label for="email">Email *</label>                                
                              <div class="controls">
                                 <input type="email" id="email" name="email" class="form-control" required="required" data-bv-field="email" autocomplete="off"  value="<?php  if(isset($Users->email)){ echo $Users->email;  }     ?>">
                              </div>
                             
                           </div>
                           <div class="form-group">
                              <label for="username">Username *</label>                                
                              <div class="controls">
                                 <input type="text" id="username" name="username" class="form-control" required="required" pattern=".{4,20}" data-bv-field="username" autocomplete="off"  value="<?php  if(isset($Users->username)){ echo $Users->username;  }     ?>">
                              </div>
                             
                           </div>
                           <div class="form-group">
                              <label for="password">Password *</label>                                
                              <div class="controls">
                                 <input type="password" name="password" value="" class="form-control tip" id="password" required="required" autocomplete="off">
                                
                              </div>
                             
                           </div>
                           <div class="form-group">
                              <label for="confirm_password">Confirm Password *</label>                                
                              <div class="controls">
                                 <input type="password" name="confirm_password" value="" class="form-control" id="confirm_password" required="requiredautocomplete="off">
                              </div>
                      
                           </div>
                        </div>
                        <div class="col-md-5 col-md-offset-1">
                           <div class="form-group">
                              <label for="status">Status </label>                               
                              <select name="status" id="status" required="required" class="form-control select" style="width: 100%; ">
                                 <option value="1"  <?php  if(isset($status)){ echo $status ==1 ?'selected':'' ;  } ?>>Active</option>
                                 <option value="0"  <?php  if(isset($status)){ echo $status ==0  ?'selected':'' ;  } ?>>Inactive</option>
                              </select>
                           </div>
                           <div class="form-group">
                              <label for="group">Group </label>                               
                              <select name="group" id="group" required="required" class="form-control select" >
                                 <option value="">Select</option>
								 <?php  if(isset($groups)){ foreach($groups as $row){   ?>
								 <option  value="<?php   echo $row->id ?>"  <?php  if(isset($group_id)){ echo $group_id ==$row->id  ?'selected':'' ;  } ?>><?php  echo $row->name; ?></option>	
								 <?php  } } ?>
                              </select>
                            
                           </div>
                           <div class="clearfix"></div>
                               <div class="form-group">  
							  <div class="row">
							  <div class="col-md-1">
									<input type="checkbox" name="issalesperson" value="1" ></label>
								</div>
								<div class="col-md-4">
									<label>Is Sales Person</label>
								</div>	
								
							  </div>		
							</div>
                              <div class="clearfix"></div>
                        </div>
                     </div>
                  </div>
                  <div class="box-footer">
                     <input type="hidden" name="id" id="unitid" value="<?php   if(isset($id)){  echo   $id ; } ?>">
                     <input class="btn btn-primary userformbutton" type="submit" value="Save" />
                  </div>
               </form>
            </div>
            <!-- /.box-body -->
         </div>
         <!-- /.box -->
      </div>
      <!-- /.col -->
   </div>
   <!-- /.row -->
</section>
<script src="<?php echo base_url('assets/admin/plugins/daterangepicker/daterangepicker.js')?>"></script>
<script src="<?php echo base_url('assets/admin/plugins/iCheck/icheck.min.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/') ?>/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url('assets/admin/plugins')?>/jquery-validation/jquery.validate.min.js"></script>
<script type="text/javascript">
   $(document).ready(function() {
       $('#my-select').multiselect();
   });
    
</script>
<script>
$('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
     });
   
</script>