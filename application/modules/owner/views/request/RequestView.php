<link href="<?php echo base_url('assets/admin/plugins/iCheck/all.css')?>" rel="stylesheet" type="text/css" />
<style>
.switch {
    display: inline-block;
    height: 23px;
    position: relative;
    width: 50px;
    margin-bottom: 0px;
}

.se_mu_cu {
    float: left;
    margin-right: 5px;
}

.switch input {
    display: none;
}

.slider {
    background-color: #ccc;
    bottom: 0;
    cursor: pointer;
    left: 0;
    position: absolute;
    right: 0;
    top: 0;
    transition: .4s;
}

.slider:before {
    background-color: #fff;
    bottom: 4px;
    content: "";
    height: 15px;
    left: 4px;
    position: absolute;
    transition: .4s;
    width: 16px;
}

input:checked+.slider {
    background-color: #66bb6a;
}

input:checked+.slider:before {
    transform: translateX(26px);
}

.slider.round {
    border-radius: 34px;
}

.slider.round:before {
    border-radius: 50%;
}

.timeline {
    width: 100%;
    height: 100px;
    margin: 0 auto;
    display: flex;
    justify-content: center;
}

.timeline .events {
    position: relative;
    background-color: #606060;
    height: 3px;
    width: 100%;
    border-radius: 4px;
    margin: 5em 0;
}

.timeline .events ol {
    margin: 0;
    padding: 0;
    text-align: center;
}

.timeline .events ul {
    list-style: none;
}

.timeline .events ul li {
    display: inline-block;
    width: 24.65%;
    margin: 0;
    padding: 0;
}

.timeline .events ul li a {
    font-family: 'Arapey', sans-serif;
    font-style: italic;
    font-size: 1.25em;
    color: #606060;
    text-decoration: none;
    position: relative;
    top: -32px;
}

.timeline .events ul li a:after {
    content: '';
    position: absolute;
    bottom: -22px;
    left: 50%;
    right: auto;
    height: 20px;
    width: 20px;
    border-radius: 50%;
    border: 3px solid #606060;
    background-color: #fff;
    transition: 0.3s ease;
    transform: translateX(-50%);
}

.timeline .events ul li a:hover::after {
    background-color: #194693;
    border-color: #194693;
}

.timeline .events ul li a.selected:after {
    background-color: #194693;
    border-color: #194693;
}

.events-content {
    width: 100%;
    height: 100px;
    max-width: 800px;
    margin: 0 auto;
    display: flex;
    justify-content: left;
}

.events-content li {
    display: none;
    list-style: none;
}

.events-content li.selected {
    display: initial;
}

.events-content li h2 {
    font-family: 'Frank Ruhl Libre', serif;
    font-weight: 500;
    color: #919191;
    font-size: 2.5em;
}

.timeline:before {
    display: none;
}
</style>
<?php   $seg= $this->uri->segment(5);?>
<section class="content-header">
    <h1>
        <?php echo $page_title; ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i>
                <?php echo lang('dashboard')?></a></li>
        <li><a href="<?php echo site_url('owner/') ?>"> <?php echo lang('Client')." ".lang('view') ?> </a></li>
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
                                    <label><?php echo lang('Owner_units') ?></label>
                                </div>
                               <div class="col-md-3">
                                        <?php   if(isset($OwnerUnits)){  foreach($OwnerUnits as $row){?>
                                            <?php  if(isset($unit_id->id)){ echo $unit_id->id == $row->id ?$row->unit_name :'' ;  } ?>
                                        <?php  }   } ?>
                                </div>
                            </div>
                        </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label><?php echo lang('request_id') ?></label>
                            </div>
                            <div class="col-md-3">
                                <?php if(isset($request->request_id)){ echo $request->request_id;  }   ?>
                            </div>
                            <div class="col-md-2">
                                <label><?php echo lang('title') ?></label>
                            </div>
                            <div class="col-md-3">
                                <?php if(isset($request->title)){ echo $request->title;  }   ?>
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label><?php echo lang('date') ?></label>
                            </div>
                            <div class="col-md-3">
                                <?php if(isset($request->request_starttime)){ echo $request->request_starttime;  }   ?>
                            </div>
                            <div class="col-md-2">
                                <label><?php echo lang('requesttype') ?></label>
                            </div>
                            <div class="col-md-3">
                                <?php if(isset($request->requesttype)){ echo $request->requesttype;  }   ?>
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label><?php echo lang('categorytype') ?></label>
                            </div>
                            <div class="col-md-3 ">
                                <?php if(isset($request->categoryname)){ echo $request->categoryname;  }   ?>
                                <!--<span style="float:right;"class="glyphicon glyphicon-plus nationidadd"></span>  -->
                            </div>
                            <div class="col-md-2">
                                <label><?php echo lang('subtype') ?></label>
                            </div>
                            <div class="col-md-3 ">

                                <?php if(isset($request->subcategory)){ echo $request->subcategory;  }   ?>
                                <!--<span style="float:right;"class="glyphicon glyphicon-plus nationidadd"></span>-->
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label><?php echo lang('description') ?></label>
                            </div>
                            <div class="col-md-3">
                                <?php if(isset($request->request_description)){ echo $request->request_description;  }   ?>
                            </div>
                            <div class="col-md-2">
                                <label><?php echo lang('services_cost') ?></label>
                            </div>
                            <div class="col-md-3">
                                <?php echo $this->sma->formatMoney($request->service_cost) ;   ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label><?php echo lang('status') ?></label>
                            </div>
                            <div class="col-md-3">
                                <?php if(isset($request->Complaint_status)){ echo $request->Complaint_status;  }   ?>
                            </div>
                            <div class="col-md-2">
                                <label>Total Amount</label>
                            </div>
                            <div class="col-md-3">
                                <?php echo $this->sma->formatMoney($request->total_amount) ;   ?>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-12">
                            <fieldset class="scheduler-border">
                                <legend class="scheduler-border">Materials</legend>

                                <table class="table table-striped product_table_s" style="table-layout: fixed;">
                                    <thead>
                                        <tr>
                                            <th>Product Name</th>
                                            <th class="text-center">Qty</th>
                                            <th class="text-center">Cost</th>
                                            <th class="text-center">Total cost</th>
                                        </tr>
                                    </thead>
                                    <tbody id="productlist">
                                        <?php   if(!empty($material)){ $material_total_cost=0; foreach($material as $item){  ?>
                                        <tr>
                                            <td><?php  echo $item->code .'-'.$item->name ;  ?></td>
                                            <td class="text-center"><?php  echo $item->qty;  ?></td>
                                            <td class="text-center">
                                                <?php     echo $this->sma->formatMoney($item->cost)   ;  ?></td>
                                            <td class="text-center">
                                                <?php echo $this->sma->formatMoney($item->total_cost) ;  ?></td>
                                        </tr>
                                        <tr>
                                            <?php  $material_total_cost +=$item->total_cost ; }   ?>
                                            <td colspan="2"></td>
                                            <td><b>Total</b></td>
                                            <td class="text-center">
                                                <b><?php echo !empty($material_total_cost)? $this->sma->formatMoney($material_total_cost):0;  ?></b>
                                            </td>
                                        </tr>
                                        <?php  }  ?>
                                    </tbody>
                                </table>
                            </fieldset>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <fieldset class="scheduler-border ">
                                <legend class="scheduler-border">Payment Details</legend>
                                <div id="dvdropdown" style="display: block">
                                    <table class="table table-striped product_table_s" style="table-layout: fixed;">
                                        <thead>
                                            <tr>
                                                <th>Services Name</th>
                                                <th class="text-center">Cost</th>
                                                <th class="text-center">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(!empty($payment_details)){ $total=0; foreach($payment_details as $payment){  ?>
                                            <tr>
                                                <td><?php echo $payment->services_name;   ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php  echo $this->sma->formatMoney($payment->services_cost)      ; ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php  echo $this->sma->formatMoney($payment->services_cost)      ; ?>
                                                </td>
                                            </tr>
                                            <?php  $total += $payment->services_cost ; }  ?>

                                            <tr>
                                                <td colspan="1"></td>
                                                <td class="text-right"><b>Total <input type="hidden"
                                                            name="payment_total" class="payment_total"></b></td>
                                                <td class="text-center">
                                                    <b><?php echo !empty($total)? $this->sma->formatMoney($total):0;  ?></b>
                                                </td>
                                            </tr>
                                            <?php	} ?>
                                        </tbody>
                                    </table>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <h4 style="margin-left:12px;">Track Status</h4>
                            <div class="timeline col-sm-12">
                                <div class="events">
                                    <ol>
                                        <ul>
                                            <?php  if(!empty($track)){  $i=1;
                                          foreach ($track as $stage) {  ?>
                                            <li>
                                                <a href="#<?php  echo $i; ?>" style="font-size:12px;" class="selected">
                                                    <?php  if(!empty($stage->note)||!empty($stage->datetime)){ echo  $stage->note.' '.$stage->datetime ;  }    ?></a>
                                            </li>
                                            <?php $i++; }
									  }  ?>

                                        </ul>
                                    </ol>
                                </div>
                            </div>
                        </div>
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