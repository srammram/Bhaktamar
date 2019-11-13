<?php $admin	=	$this->session->userdata('admin');
		$user	=	$this->auth->get_admin($admin['id']);
?>
<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <section class="sidebar">
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION </li>
	<?php    if( $this->uri->segment(1)=='owner'){   ?>
	<li ><a href="<?php echo site_url('owner/dashboard')?>"><i class="fa fa-circle-o"></i> <span><?php echo lang('Dashboard');?></span></a></li>   
		<li class="<?php echo ($this->uri->segment(2)=='request_list')?'active':''?>"><a href="<?php echo site_url('owner/request/request_list')?>"><i class="fa fa-circle-o"></i> <span><?php echo lang('request');?></span></a></li>
		
		<li>
	<a href="#">
            <i class="fa fa-circle-o"></i>
            <span><?php echo lang('Tenant')?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
    </a>
     <ul class="treeview-menu">
		<li class="<?php echo ($this->uri->segment(2)=='Project')?'active':''?>"><a href="<?php echo site_url('owner/Tenant/tenant_form')?>"><i class="fa fa-circle-o"></i> <span><?php echo lang('add_tenant');?></span></a></li>
	<li class="<?php echo ($this->uri->segment(3)=='tenant_list')?'active':''?>"><a href="<?php echo site_url('owner/Tenant/tenant_list')?>"><i class="fa fa-circle-o"></i> <span><?php echo lang('list_tenant');?></span></a></li>
		  </ul>
		</li> 
			<li>
	<a href="#">
            <i class="fa fa-circle-o"></i>
            <span><?php echo lang('myunits')?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
    </a>
     <ul class="treeview-menu">
		<li class="<?php echo ($this->uri->segment(2)=='Project')?'active':''?>"><a href="<?php echo site_url('owner/Myunits')?>"><i class="fa fa-circle-o"></i> <span><?php echo lang('myunits');?></span></a></li>
	    <li class="<?php echo ($this->uri->segment(3)=='tenant_list')?'active':''?>"><a href="<?php echo site_url('owner/Myunits/unit_request_list')?>"><i class="fa fa-circle-o"></i> <span><?php echo lang('unit_request');?></span></a></li>
		  </ul>
		</li> 
			<li class="<?php echo ($this->uri->segment(2)=='help')?'active':''?>"><a href="#"><i class="fa fa-circle-o"></i> <span><?php echo lang('myPayment');?></span></a></li>
		<li class="<?php echo ($this->uri->segment(2)=='help')?'active':''?>"><a href="#"><i class="fa fa-circle-o"></i> <span><?php echo lang('help');?></span></a></li>
	
	<?php   }  ?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <?php 
				if($this->session->flashdata('message'))
						$message = $this->session->flashdata('message');
				  if($this->session->flashdata('error'))
						$error  = $this->session->flashdata('error');
					if(function_exists('validation_errors') && validation_errors() != '')
					{
						$error  = validation_errors();
					}
			?>
            <?php if(!empty($error) || !empty($message)){ ?>
			<div class="container">		
                    <?php if (!empty($error)): ?>
                    <div class="alert alert-danger alert-dismissable col-md-11">
                        <i class="fa fa-ban"></i>
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <?php echo $error; ?>
                    </div>
                    <?php endif; ?>
                    
                    <?php if (!empty($message)): ?>
                    <div class="alert alert-info alert-dismissable col-md-11">
                        <i class="fa fa-info"></i>
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                       <?php echo $message; ?>
                    </div>
                    <?php endif; ?>
                    
           </div>
           <?php }?>