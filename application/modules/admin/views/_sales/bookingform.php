<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/select2.min.css" type="text/css">
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/select2.min.js"></script>
<link href='<?php echo base_url()?>assets/assets/plugin/datepicker/datepicker3.css' rel='stylesheet' media='screen'>
<style>
.error {
    color: #FF0000;
}

.select2-container .select2-selection--single {
    height: 35px;
    border-radius: 0px;
    border: 1px solid #ddd;
}

.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 35px;
}

.content-header .breadcrumb {
    margin-bottom: 0px;
    background-color: transparent;
}

.content-header h3 {
    margin: 0px;
}

fieldset.scheduler-border {
    border: 1px groove #ddd !important;
    padding: 0 1.4em 1.4em 1.4em !important;
    margin: 0 0 1.5em 0 !important;
    -webkit-box-shadow: 0px 0px 0px 0px #000;
    box-shadow: 0px 0px 0px 0px #000;
}

legend.scheduler-border {
    font-size: 1.2em !important;
    font-weight: bold !important;
    text-align: left !important;
    width: auto;
    padding: 0 10px;
    border-bottom: none;
    border: 1px solid;
}

.table-bordered>thead>tr>th {
    background-color: #2c3542 !important;
}

.terms_conditions_s {
    padding-left: 20px;
}

.terms_conditions_s li {
    line-height: 28px;
}

.form-control {
    border-radius: 0px;
}

#customFields tbody tr td input {
    border: none;
    border-bottom: 1px solid #ddd;
}

#customFields {
    position: relative;
}

.remCF,
.addCF {
    position: absolute;
    right: 7px;
    margin-top: -2%;
    color: white;
    background-color: #d80404;
    padding: 0;
    width: 20px;
    height: 20px;
    line-height: 17px;
    text-align: center;
    border-radius: 10px;
}

.addCF {
    line-height: 20px;
    background-color: darkgreen;
}

.addCF:hover {
    line-height: 20px;
    background-color: darkgreen;
    color: white
}

#customFields>tbody>tr>td,
#customFields>tbody>tr>th,
#customFields>tfoot>tr>td,
#customFields>tfoot>tr>th {
    padding: 4px;
}

#customFields>tbody>tr>td:first-child {
    text-align: center;
}

.file-upload-wrapper {
    position: relative;
    width: 100%;
    height: 40px;
    border: 1px solid #ccc;
}

.file-upload-wrapper:after {
    content: attr(data-text-upload);
    font-size: 14px;
    position: absolute;
    top: 0;
    left: 0;
    background: #fff;
    padding: 0px 15px;
    display: block;
    width: calc(100% - 40px);
    pointer-events: none;
    z-index: 20;
    height: 35px;
    line-height: 35px;
    color: #999;
    border-radius: 5px 10px 10px 5px;
    font-weight: 300;
}

.file-upload-wrapper:before {
    content: "Upload";
    position: absolute;
    top: 0;
    right: 0;
    display: inline-block;
    height: 40px;
    background: #2c3542;
    color: #fff;
    font-weight: 700;
    z-index: 25;
    font-size: 14px;
    line-height: 40px;
    padding: 0 15px;
    text-transform: uppercase;
    pointer-events: none;
    border-radius: 0 0px 0px 0;
}

.file-upload-wrapper:hover:before {
    background: #2c3542;
}

.file-upload-wrapper input {
    opacity: 0;
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    z-index: 99;
    height: 40px;
    margin: 0;
    padding: 0;
    display: block;
    cursor: pointer;
    width: 100%;
}
</style>
<?php   $seg= $this->uri->segment(5);?>
<section class="content-header">
    <h1>
        Booking
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i>
                <?php echo lang('dashboard')?></a></li>
        <li><a href="<?php echo site_url('admin/sales/Sales/booking') ?>">Booking </a></li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Application | Booking Form</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <form method="post" action="<?php echo site_url('admin/sales/Sales/booking/'.$agentid); ?>"
                        enctype="multipart/form-data" id="bookingform">

                        <fieldset class="scheduler-border">
                            <legend class="scheduler-border">Form</legend>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label>Date<span class="required" aria-required="true">*</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control datepicker" id="datepicker"
                                            name="date" data-date-format="yyyy/mm/dd" onkeydown="return false">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar-o"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-5">
                                    <label>Serial No</label>
                                    <input type="text" class="form-control" name="serialno" readonly>

                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label>Applicant Name</label>
                                    <span class="required" aria-required="true">*</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control"  name="applicantname">
                                        <div class="input-group-addon">
                                            <i class="fa fa-user"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-5">
                                    <label>Address</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="address">
                                        <div class="input-group-addon">
                                            <i class="fa fa-home fa-1x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label>Pincode</label>
                                    <input type="text" class="form-control" name="pincode">
                                </div>
                                <div class="form-group col-md-5">
                                    <label>Contact No</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="contact">
                                        <div class="input-group-addon">
                                            <i class="fa fa-phone"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label>Whats app</label>
                                    <span class="required" aria-required="true">*</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="whatapp">
                                        <div class="input-group-addon">
                                            <i class="fa fa-comment"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-5">
                                    <label>Email id</label>
                                    <span class="required" aria-required="true">*</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="email">
                                        <div class="input-group-addon">
                                            <i class="fa fa-mail-reply"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label>Occupation</label>
                                    <input type="text" class="form-control"  name="occupation">
                                </div>
                                <div class="form-group col-md-5">
                                    <label>Organization</label>
                                    <input type="text" class="form-control"  name="organization">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label>Desigantion</label>
                                    <input type="text" class="form-control"  name="desigantion">
                                </div>
                                <div class="form-group col-md-5">
                                    <label>D.O.B (Age)</label>
                                    <input type="text" class="form-control"  name="age">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label>Anniversary</label>
                                    <input type="text" class="form-control"  name="Anniversary">
                                </div>
                                <div class="form-group col-md-5">
                                    <label>Pan No</label>
                                    <span class="required" aria-required="true">*</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control"  name="pan">
                                        <div class="input-group-addon">
                                            <i class="fa fa-list"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label>Aadhar No</label>
                                    <span class="required" aria-required="true">*</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control"  name="adhar">
                                        <div class="input-group-addon">
                                            <i class="fa fa-list"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="scheduler-border" style="padding-top:1.4em !important">
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label>Co-Applicant's Name</label>
                                    <span class="required" aria-required="true">*</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control"  name="co_applicant">
                                        <div class="input-group-addon">
                                            <i class="fa fa-user"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-5">
                                    <label>Relationship</label>
                                    <input type="text" class="form-control"  name="relantionship">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label>Contact No</label>
                                    <span class="required" aria-required="true">*</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control"  name="contact2">
                                        <div class="input-group-addon">
                                            <i class="fa fa-phone"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-5">
                                    <label>Email id</label>
                                    <span class="required" aria-required="true">*</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control"  name="email2">
                                        <div class="input-group-addon">
                                            <i class="fa fa-mail-reply"></i>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label>Occupation</label>
                                    <input type="text" class="form-control" name="occupation">
                                </div>
                                <div class="form-group col-md-5">
                                    <label>Organization</label>
                                    <input type="text" class="form-control"  name="organization">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label>Desigantion</label>
                                    <input type="text" class="form-control"  name="desigantion">
                                </div>
                                <div class="form-group col-md-5">
                                    <label>D.O.B (Age)</label>
                                    <input type="text" class="form-control" name="dob2">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label>Anniversary</label>
                                    <input type="text" class="form-control" name="anniversary2">
                                </div>
                                <div class="form-group col-md-5">
                                    <label>Pan No</label>
                                    <span class="required" aria-required="true">*</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="pan2">
                                        <div class="input-group-addon">
                                            <i class="fa fa-list"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label>Aadhar No</label>
                                    <span class="required" aria-required="true">*</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control"  name="adhar2">
                                        <div class="input-group-addon">
                                            <i class="fa fa-list"></i>fa fa-building
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="scheduler-border">
                            <legend class="scheduler-border">Booking Details(For office use only)</legend>
                            <div class="row">
                                <div class="form-group col-md-5" style="padding: 0px;">
                                    <div class="form-group col-md-6">
                                        <label>Wing No</label>
                                        <div class="col-md-12" style="padding: 0px;">
                                            <select class="select2 form-control">
                                                <option>wing</option>
                                                <option>wing</option>
                                                <option>wing</option>
                                                <option>wing</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Floor</label>
                                        <div class="col-md-12" style="padding: 0px;">
                                            <select class="select2 form-control">
                                                <option>Floor</option>
                                                <option>Floor</option>
                                                <option>Floor</option>
                                                <option>Floor</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-5">
                                    <label>Shop/Flat No</label>
                                    <div class="col-md-12" style="padding: 0px;">
                                        <select class="select2 form-control">
                                            <option>Flat</option>
                                            <option>Flat</option>
                                            <option>Flat</option>
                                            <option>Flat</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label>Carpet Area(5q. mtr)</label>
                                    <span class="required" aria-required="true">*</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="carpetarea">
                                        <div class="input-group-addon">
                                            <i class="fa fa-building"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-5">
                                    <label>Enclosed Balcony Carpet Area(5q. mtr)</label>
                                    <input type="text" class="form-control" name="enclosed_balconycarpet_area">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label>Open Balcony Carpet Area(5q. mtr)</label>
                                    <span class="required" aria-required="true">*</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control"  name="open_balcony_carpet_area">
                                        <div class="input-group-addon">
                                            <i class="fa fa-building"></i>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label>Basic Cost</label>
                                    <input type="text" class="form-control" name="basic_cost">
                                </div>
                                <div class="form-group col-md-5">
                                    <label>Intra Charges</label>
                                    <span class="required" aria-required="true">*</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="intra_charges">
                                        <div class="input-group-addon">
                                            <i class="fa fa-money"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label>Agreement Value</label>
                                    <span class="required" aria-required="true">*</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control"  name="agreementvalue">
                                        <div class="input-group-addon">
                                            <i class="fa fa-money"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-5">
                                    <label>Stamp Duty @</label>
                                    <input type="text" class="form-control"  name="stamp_duty">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label>Registration Fees</label>
                                    <input type="text" class="form-control"  name="registration_fees">
                                </div>
                                <div class="form-group col-md-5">
                                    <label>Legal Charges</label>
                                    <span class="required" aria-required="true">*</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control"  name="legal_charges">
                                        <div class="input-group-addon">
                                            <i class="fa fa-money"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label>GST</label>
                                    <span class="required" aria-required="true">*</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control"  name="gst">
                                        <div class="input-group-addon">
                                            <i class="fa fa-money"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-5">
                                    <label>GRAND TOTAL COST</label>
                                    <span class="required" aria-required="true">*</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control"  name="total_cost">
                                        <div class="input-group-addon">
                                            <i class="fa fa-money"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label>Own Contribution</label>
                                    <input type="text" class="form-control"  name="own_contribution">
                                </div>
                                <div class="form-group col-md-5">
                                    <label>Bank Loan</label>
                                    <input type="text" class="form-control"  name="bank_loan">
                                </div>
                            </div>
                        </fieldset>
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Payment Schedule<sup>*</sup>:</h4>
                                
                                   <div class="form-group">
                                         
                                            <label class="css-input css-radio css-radio-success push-10-r">
                                                <input name="scheduletype" value="1" 
                                                    type="radio" class="scheduletype"><span></span>Custom Plan
                                            </label>   
                                            <label class="css-input css-radio css-radio-success push-10-r">
                                                <input name="scheduletype" value="2"
                                                    type="radio" class="scheduletype" checked><span></span>Regular Plan
                                            </label>
                                        </div>
                                
                                <table class="table table-bordered">
                                    <colgroup>
                                        <col width="85%">
                                        <col width="15%">
                                    </colgroup>
                                    <tbody>
                                        <tr>
                                            <td>Token/Booking Amount</td>
                                            <td><input type="text" value="10%" class="payment_tk form-control"></td>
                                        </tr>
                                        <tr>
                                            <td>On Execution of Agreement</td>
                                            <td><input type="text" value="20" class="payment_tk form-control"><span>%</span></td>
                                        </tr>
                                        <tr>
                                            <td>On Completion of Plinth</td>
                                            <td><input type="text" value="15%" class="payment_tk form-control"></td>
                                        </tr>
                                        <tr>
                                            <td>On Completion of Parking & 1st Slab</td>
                                            <td><input type="text" value="5%" class="payment_tk form-control"></td>
                                        </tr>
                                        <tr>
                                            <td>On Completion of 2nd Slab</td>
                                            <td><input type="text" value="5%" class="payment_tk form-control"></td>
                                        </tr>
                                        <tr>
                                            <td>On Completion of 5th Slab</td>
                                            <td><input type="text" value="5%" class="payment_tk form-control"></td>
                                        </tr>
                                        <tr>
                                            <td>On Completion of 8th Slab</td>
                                            <td><input type="text" value="5%" class="payment_tk form-control"></td>
                                        </tr>
                                        <tr>
                                            <td>On Completion of 11th Slab</td>
                                            <td><input type="text" value="5%" class="payment_tk form-control"></td>
                                        </tr>
                                        <tr>
                                            <td>On Completion of Topmost Slab</td>
                                            <td><input type="text" value="5%" class="payment_tk form-control"></td>
                                        </tr>
                                        <tr>
                                            <td>On Completion of Brick Work,Plaster & Flooring</td>
                                            <td><input type="text" value="5%" class="payment_tk form-control"></td>
                                        </tr>
                                        <tr>
                                            <td>On Completion of Sanitary Fitting & Paint</td>
                                            <td><input type="text" value="5%" class="payment_tk form-control"></td>
                                        </tr>
                                        <tr>
                                            <td>On Completion of MEP & Finishing Work</td>
                                            <td><input type="text" value="10%" class="payment_tk form-control"></td>
                                        </tr>
                                        <tr>
                                            <td>On Handover/Possesion</td>
                                            <td><input type="text" value="5%" class="payment_tk form-control"></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <p><sup>*</sup>No reveiving of payment as per payment schedule will cause interest and
                                    penality.</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Payment Received Details(Till Date)</h3>
                                <table class="table table-bordered" id="customFields">
                                    <thead>
                                        <tr>
                                            <th>Sr</th>
                                            <th>Cheque No.</th>
                                            <th>Dated</th>
                                            <th>Bank & Branch</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td><input type="text" class="form-control" name="chequen[]"></td>
                                            <td><input type="text" class="form-control" name="paymentdate[]"></td>
                                            <td><input type="text" class="form-control" name="bank_details[]"></td>
                                            <td><input type="text" class="form-control" name="anmount"><a href="javascript:void(0);"
                                                    class="addCF">+</a></td>

                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="4" style="text-align: right;">Total Received Payment</td>
                                            <td><input type="text" class="form-control"
                                                    style="border: none;border-bottom: 1px solid #ddd;" name="total_received_payment"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="5">
                                                <input type="text" class="form-control"
                                                    style="border: none;border-bottom: 1px solid #ddd;"
                                                    placeholder="Rupees(in Words)" name="rupee_in_word">
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <h4>Terms & Conditions:</h4>
                                <ol class="terms_conditions_s">
                                    <li>Document registration should be executed within 15-20 days after own
                                        contribution payment</li>
                                    <li>Cancellation charges Rs 25000 would be deducted on A/C of administartive
                                        expenses</li>
                                    <li>If any gift in promotional scheme.the same value would be deducted from
                                        refunding amount after cancellation.</li>
                                    <li>We are not accepting any kind of internal changes. so please don't request for
                                        any changes.</li>
                                    <li>The above quotation id valid for <input type="text"> days only.</li>
                                    <li>Payment schedule must be followed. Non receiving of payment on time will cause
                                        interest and penalty.</li>
                                    <li>Above mentioned govt taxed are as per current charges. if it changes, same will
                                        be applicable to you too.</li>
                                    <li>GST rate is applicable as per received payment during existing tenure.</li>
                                    <li>Maintenance charge fo 24 months to be paid at the time of possession.</li>
                                    <li>The promoters reserve the right to change the design layout, plan and
                                        specification on technical ground</li>
                                </ol>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12" style="margin-bottom: 25px;">
                                <div class="form-group col-md-6">
                                    <label class="col-sm-4">Attended By :</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control"
                                            style="border: none;border-bottom: 1px solid #ddd;"  name="attendedby">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group  col-md-12">
                                    <div class="col-md-12 file_upload">
                                        <div class="file-upload-wrapper" data-text-upload="Upload Document">
                                            <input name="file-upload-field" type="file" name="purchaser_signature" class="file-upload-field"
                                                value="">
                                        </div>
                                    </div>
                                    <label class="col-sm-12">Purchaser Sign</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group col-md-12">
                                    <div class="col-md-12">
                                        <input type="text" class="form-control"
                                            style="border: none;border-bottom: 1px solid #ddd;" name="witness">
                                    </div>
                                    <label class="col-sm-12">Witness</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group col-md-12">
                                    <div class="col-md-12 file_upload">
                                        <div class="file-upload-wrapper" data-text-upload="Upload Document">
                                            <input name="signatory" type="file" class="file-upload-field" value=""  name="authorised_signatory">
                                        </div>
                                    </div>
                                    <label class="col-sm-12" style="padding-right: 0px;">Authorised Signatory with
                                        company seal</label>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn bg-navy btn-flat" id="booking">
                                Save </button>
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
    $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
    });
});
</script>
<script>
$('input[type="checkbox"]').on('change', function() {
    $('input[type="checkbox"]').not(this).prop('checked', false);
});
</script>
<script type="text/javascript">
$(document).ready(function() {
    $('#my-select').multiselect();
});
</script>
<script>
$(document).ready(function() {
    var i = 2;
    $(".addCF").on('click', function() {
        var data = '<tr><td>' + i + '.</td><td><input type="text" id="booking_formName' + i +
            '" name="booking_formName[]" class="form-control"></td><td><input type="text" class="form-control"></td><td><input type="text" class="form-control"></td><td><input type="text" class="form-control"><a href="javascript:void(0);" class="remCF">x</a></td></tr>';
        $('#customFields').append(data);
        i++;
        $(".remCF").on('click', function() {
            $(this).parent().parent().remove();
        });
    });

});
</script>
<script>
$(".file_upload").on("change", ".file-upload-field", function() {
    $(this).parent(".file-upload-wrapper").attr("data-text-upload", $(this).val().replace(/.*(\/|\\)/, ''));
});
$(document).ready(function() {
    $('.select2').select2();
});
$(document).ready(function() {
	$('.scheduletype').on('ifChanged', function(event){
	 if(this.value ==1){
		 $('.payment_tk').attr('readonly', false);
	 }else{
		 $('.payment_tk').attr('readonly', true);
	 }
});
});
</script>