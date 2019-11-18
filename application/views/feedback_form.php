 <?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

 <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url('')?>/assets/admin/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  
 <script src="http://13.233.76.77/bhaktamar_rems/assets/admin/plugins/jQuery/jquery-2.2.3.min.js"></script>
<style>
.error{
    color: #FF0000;
}
.content-header .breadcrumb{ margin-bottom: 0px;background-color: transparent;}
	.content-header h3{margin: 0px;}
	fieldset.scheduler-border {
    border: 1px groove #ddd !important;
    padding: 0 1.4em 1.4em 1.4em !important;
    margin: 0 0 1.5em 0 !important;
    -webkit-box-shadow:  0px 0px 0px 0px #000;
            box-shadow:  0px 0px 0px 0px #000;
}

    legend.scheduler-border {
        font-size: 1.2em !important;
        font-weight: bold !important;
        text-align: left !important;
        width:auto;
        padding:0 10px;
        border-bottom:none;
		border: 1px solid;
    }
	.table-bordered>thead>tr>th {background-color: #2c3542!important;}
	.terms_conditions_s{padding-left: 20px;}
	.terms_conditions_s li{line-height: 28px;}
	.form-control{border-radius: 0px;}
	.checkbox_group label:before {
	  content:'';
	  -webkit-appearance: none;
	  background-color: transparent;
	  border: 2px solid #0079bf;
	  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05), inset 0px -15px 10px -12px rgba(0, 0, 0, 0.05);
	  padding: 8px;
	  display: inline-block;
	  position: relative;
	  vertical-align: middle;
	  cursor: pointer;
	  margin-right: 5px;
	}
	.checkbox_group input:checked + label:after {
		content: '';
		display: block;
		position: absolute;
		top: 5px;
		left: 7px;
		width: 6px;
		height: 12px;
		border: solid #0079bf;
		border-width: 0 2px 2px 0;
		transform: rotate(45deg);
	}
	.checkbox_group input {
    padding: 0;
    height: initial;
    width: initial;
    margin-bottom: 0;
    display: none;
    cursor: pointer;
}
	.checkbox_group label {
  position: relative;
  cursor: pointer;
}
/*	rating*/
.rating { 
  border: none;
  float: left;
}

.rating > input { display: none; } 
.rating > label:before { 
  margin: 5px;
  font-size: 1.25em;
  font-family: FontAwesome;
  display: inline-block;
  content: "\f005";
}
.rating > .half:before { 
  content: "\f089";
  position: absolute;
}
.rating > label { 
  color: #ccc; 
 float: right; 
}
/***** CSS Magic to Highlight Stars on Hover *****/
.rating > input:checked ~ label, /* show gold star when clicked */
.rating:not(:checked) > label:hover, /* hover current star */
.rating:not(:checked) > label:hover ~ label { color: #2c3542;  } /* hover previous stars in list */

.rating > input:checked + label:hover, /* hover current star when changing rating */
.rating > input:checked ~ label:hover,
.rating > label:hover ~ input:checked ~ label, /* lighten current selection */
.rating > input:checked ~ label:hover ~ label { color: #2c3542;  } 
	
/*	radio*/
	.feed_back [type="radio"]:checked,
.feed_back [type="radio"]:not(:checked) {
    position: absolute;
    left: -9999px;
}
.feed_back [type="radio"]:checked + label,
.feed_back [type="radio"]:not(:checked) + label
{
    position: relative;
    padding-left: 28px;
    cursor: pointer;
    line-height: 20px;
    display: inline-block;
    color: #666;
}
.feed_back [type="radio"]:checked + label:before,
.feed_back [type="radio"]:not(:checked) + label:before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    width: 18px;
    height: 18px;
    border: 2px solid #0079bf;
    border-radius: 100%;
    background: #fff;
}
.feed_back [type="radio"]:checked + label:after,
.feed_back [type="radio"]:not(:checked) + label:after {
    content: '';
    width: 12px;
    height: 12px;
    background: #0079bf;
    position: absolute;
    top: 3px;
    left: 3px;
    border-radius: 100%;
    -webkit-transition: all 0.2s ease;
    transition: all 0.2s ease;
}
.feed_back [type="radio"]:not(:checked) + label:after {
    opacity: 0;
    -webkit-transform: scale(0);
    transform: scale(0);
}
.feed_back [type="radio"]:checked + label:after {
    opacity: 1;
    -webkit-transform: scale(1);
    transform: scale(1);
}
</style><?php  switch($response){
   case 1:   
   echo 'Already feed back submitted.Thank You !!!';
   break;
   case 4:
   echo 'Faild To save the Feedback Data.';
   break;
   case 3:
	?>
		 <form method="post" action="<?php echo site_url('Feedback/index/'); ?>" id="enquiryform">
<fieldset class="scheduler-border ">
						<legend class="scheduler-border">Feedback Link </legend>
						<div class="form-group col-md-10">
							<label class="col-sm-8">1) How Would You Rate The Waiting Time To Be Attended ? </label>
							<div class="rating col-sm-4">
								<input type="radio" id="star5" name="rating"  class="start" value="5" />
								<label class = "full" for="star5" title="Awesome - 5 stars"></label>
								<input type="radio" id="star4half" name="rating" class="start" value="4.5" />
								<label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
								<input type="radio" id="star4" name="rating" class="start" value="4" />
								<label class = "full" for="star4" title="Pretty good - 4 stars"></label>
								<input type="radio" id="star3half" name="rating" class="start" value="3.5" />
								<label class="half" for="star3half" title="Meh - 3.5 stars"></label>
								<input type="radio" id="star3" name="rating"  class="start" value="3" />
								<label class = "full" for="star3" title="Meh - 3 stars"></label>
								<input type="radio" id="star2half" name="rating"  class="start" value="2.5" />
								<label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
								<input type="radio" id="star2" name="rating" class="start" value="2" />
								<label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
								<input type="radio" id="star1half" name="rating" class="start" value="1.5" />
								<label class="half" for="star1half" title="Meh - 1.5 stars"></label>
								<input type="radio" id="star1" name="rating" class="start" value="1" />
								<label class = "full" for="star1" title="Sucks big time - 1 star"></label>
								<input type="radio" id="starhalf" name="rating" class="start" value="0.5" />
								<label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
							</div>
						</div>
						<div class="form-group col-md-10">
							<label class="col-sm-8">2) How Would You Rate Our Representative Communication ? </label>
							<div class="rating col-sm-4">
								<input type="radio" id="1star5" name="rating1" class="start" value="5" />
								<label class ="full" for="1star5" title="Awesome - 5 stars"></label>
								<input type="radio" id="1star4half" name="rating1" class="start" value="4.5" />
								<label class="half" for="1star4half" title="Pretty good - 4.5 stars"></label>
								<input type="radio" id="1star4" name="rating1" class="start" value="4" />
								<label class ="full" for="1star4" title="Pretty good - 4 stars"></label>
								<input type="radio" id="1star3half" name="rating1" class="start" value="3.5" />
								<label class="half" for="1star3half" title="Meh - 3.5 stars"></label>
								<input type="radio" id="1star3" name="rating1" class="start" value="3" />
								<label class ="full" for="1star3" title="Meh - 3 stars"></label>
								<input type="radio" id="1star2half" name="rating1" class="start" value="2.5" />
								<label class="half" for="1star2half" title="Kinda bad - 2.5 stars"></label>
								<input type="radio" id="1star2" name="rating1" class="start" value="2" />
								<label class ="full" for="1star2" title="Kinda bad - 2 stars"></label>
								<input type="radio" id="1star1half" name="rating1" class="start" value="1.5" />
								<label class="half" for="1star1half" title="Meh - 1.5 stars"></label>
								<input type="radio" id="1star1" name="rating1" class="start" value="1" />
								<label class ="full" for="1star1" title="Sucks big time - 1 star"></label>
								<input type="radio" id="1starhalf" name="rating1" class="start" value="0.5" />
								<label class="half" for="1starhalf" title="Sucks big time - 0.5 stars"></label>
							</div>
						</div>
						<div class="form-group col-md-10">
							<label class="col-sm-8">3) How Would You Rate Our Overall Hospitality ? </label>
							<div class="rating col-sm-4">
								<input type="radio" id="2star5" name="rating3" value="5" />
								<label class ="full" for="2star5" title="Awesome - 5 stars"></label>
								<input type="radio" id="2star4half" name="rating3" value="4.5" />
								<label class="half" for="2star4half" title="Pretty good - 4.5 stars"></label>
								<input type="radio" id="2star4" name="rating3" value="4" />
								<label class ="full" for="2star4" title="Pretty good - 4 stars"></label>
								<input type="radio" id="2star3half" name="rating3" value="3.5" />
								<label class="half" for="2star3half" title="Meh - 3.5 stars"></label>
								<input type="radio" id="2star3" name="rating3" value="3" />
								<label class ="full" for="2star3" title="Meh - 3 stars"></label>
								<input type="radio" id="2star2half" name="rating3" value="2.5" />
								<label class="half" for="2star2half" title="Kinda bad - 2.5 stars"></label>
								<input type="radio" id="2star2" name="rating3" value="2" />
								<label class ="full" for="2star2" title="Kinda bad - 2 stars"></label>
								<input type="radio" id="2star1half" name="rating3" value="1.5" />
								<label class="half" for="2star1half" title="Meh - 1.5 stars"></label>
								<input type="radio" id="2star1" name="rating3" value="1" />
								<label class ="full" for="2star1" title="Sucks big time - 1 star"></label>
								<input type="radio" id="2starhalf" name="rating3" value="0.5" />
								<label class="half" for="2starhalf" title="Sucks big time - 0.5 stars"></label>
							</div>
						</div>
						<div class="form-group col-md-10">
							<label class="col-sm-8">4) How Would You Rate Our Project Presentation ? </label>
							<div class="rating col-sm-4">
								<input type="radio" id="3star5" name="rating4" value="5" />
								<label class ="full" for="3star5" title="Awesome - 5 stars"></label>
								<input type="radio" id="3star4half" name="rating4" value="4.5" />
								<label class="half" for="3star4half" title="Pretty good - 4.5 stars"></label>
								<input type="radio" id="3star4" name="rating4" value="4" />
								<label class ="full" for="3star4" title="Pretty good - 4 stars"></label>
								<input type="radio" id="3star3half" name="rating4" value="3.5" />
								<label class="half" for="3star3half" title="Meh - 3.5 stars"></label>
								<input type="radio" id="3star3" name="rating4" value="3" />
								<label class ="full" for="3star3" title="Meh - 3 stars"></label>
								<input type="radio" id="3star2half" name="rating4" value="2.5" />
								<label class="half" for="3star2half" title="Kinda bad - 2.5 stars"></label>
								<input type="radio" id="3star2" name="rating4" value="2" />
								<label class ="full" for="3star2" title="Kinda bad - 2 stars"></label>
								<input type="radio" id="3star1half" name="rating4" value="1.5" />
								<label class="half" for="3star1half" title="Meh - 1.5 stars"></label>
								<input type="radio" id="3star1" name="rating4" value="1" />
								<label class ="full" for="3star1" title="Sucks big time - 1 star"></label>
								<input type="radio" id="3starhalf" name="rating4" value=".5" />
								<label class="half" for="3starhalf" title="Sucks big time - 0.5 stars"></label>
							</div>
						</div>
						<div class="form-group col-md-10">
							<label class="col-sm-8">5) How Would You Rate The Project Overall ?</label>
							<div class="rating col-sm-4">
								<input type="radio" id="4star5" name="rating5" value="5" />
								<label class ="full" for="4star5" title="Awesome - 5 stars"></label>
								<input type="radio" id="4star4half" name="rating5" value="4.5" />
								<label class="half" for="4star4half" title="Pretty good - 4.5 stars"></label>
								<input type="radio" id="4star4" name="rating5" value="4" />
								<label class ="full" for="4star4" title="Pretty good - 4 stars"></label>
								<input type="radio" id="4star3half" name="rating5" value="3.5" />
								<label class="half" for="4star3half" title="Meh - 3.5 stars"></label>
								<input type="radio" id="4star3" name="rating5" value="3" />
								<label class ="full" for="4star3" title="Meh - 3 stars"></label>
								<input type="radio" id="4star2half" name="rating5" value="2.5" />
								<label class="half" for="4star2half" title="Kinda bad - 2.5 stars"></label>
								<input type="radio" id="4star2" name="rating5" value="2" />
								<label class ="full" for="4star2" title="Kinda bad - 2 stars"></label>
								<input type="radio" id="4star1half" name="rating5" value="1.5" />
								<label class="half" for="4star1half" title="Meh - 1.5 stars"></label>
								<input type="radio" id="4star1" name="rating5" value="1" />
								<label class ="full" for="4star1" title="Sucks big time - 1 star"></label>
								<input type="radio" id="4starhalf" name="rating5" value="0.5" />
								<label class="half" for="4starhalf" title="Sucks big time - 0.5 stars"></label>
							</div>
						</div>
						<div class="col-md-12 feed_back">
							<h4><b>If Rating 4+ Following Questions</b></h4>
							<div class="form-group col-md-12">
								<label class="col-md-12">1. Which Impressed You The Most</label>
								<div class="form-group checkbox_group col-md-2">
									<input type="checkbox"  value="1" id="location" name="location">
									<label for="location">Location</label>
								</div>
								<div class="form-group checkbox_group col-md-2">
								  <input type="checkbox"  value="2" id="plan" name="plan">
								  <label for="plan">Plan</label>
								</div>
								<div class="form-group checkbox_group col-md-2">
								  <input type="checkbox" value="2" id="amenities" name="amenities">
								  <label for="amenities">Amenities</label>
								</div>
								<div class="form-group checkbox_group col-md-3">
								  <input type="checkbox" value="3" id="construction_quality" name="construction_quality">
								  <label for="construction_quality">Construction Quality</label>
								</div>
							  	<div class="form-group checkbox_group col-md-3">
								  <input type="checkbox"  value="4" id="builders_goodwill" name="builders_goodwill">
								  <label for="builders_goodwill">Builders Goodwill</label>
								</div>
							</div>
							<div class="form-group col-md-12">
								<label class="col-md-12">2. How Do You Think The Price Point Was ?</label>
								<div class="form-group col-md-2">
									<input type="radio"  value="1" id="very_high" name="price_point">
									<label for="very_high">Very High</label>
								</div>
								<div class="form-group col-md-2">
								  <input type="radio"  value="2" id="high" name="price_point">
								  <label for="high">High</label>
								</div>
								<div class="form-group col-md-2">
								  <input type="radio" value="3" id="fair" name="price_point">
								  <label for="fair">Fair</label>
								</div>
							  <div class="form-group col-md-2">
								  <input type="radio" value="4" id="low" name="price_point">
								  <label for="low">Low</label>
								</div>
								
							</div>
							<div class="form-group col-md-12">
								<label class="col-md-12">3. Would You Recommend Our Project To A Friend/Relative ?</label>
								<div class="form-group col-md-2">
									<input type="radio" value="1" id="yes" name="recommand_our_project">
									<label for="yes">Yes</label>
								</div>
								<div class="form-group col-md-2">
								  <input type="radio" value="2" id="no" name="recommand_our_project">
								  <label for="no">No</label>
								</div>
							</div>
							<div class="form-group col-md-12">
								<label class="col-md-12">4. Detail Review ()</label>
								<div class="form-group col-md-5">
									<textarea rows="3" style="width: 100%;" name="detail_review"></textarea>
								</div>
								
							</div>
						</div>
						<div class="col-md-12 feed_back">
							<h4><b>If Rating less than 4- Following Questions</b></h4>
							<div class="form-group col-md-12">
								<label class="col-md-12">1. On Which Fields You Feel The Project Could Have Done Better</label>
								
								<div class="form-group checkbox_group col-md-2">
								  <input type="checkbox"  value="1" id="pln" name="could_have_done_better">
								  <label for="pln">Plan</label>
								</div>
								<div class="form-group checkbox_group col-md-2">
								  <input type="checkbox" value="2" id="amenit" name="could_have_done_better">
								  <label for="amenit">Amenities</label>
								</div>
								<div class="form-group checkbox_group col-md-3">
								  <input type="checkbox"  value="3" id="construction_qty" name="could_have_done_better">
								  <label for="construction_qty">Construction Quality</label>
								</div>
							  	<div class="form-group checkbox_group col-md-3">
								  <input type="checkbox" value="4" id="other_text_box" name="could_have_done_better">
								  <label for="other_text_box">Other-Text Box</label>
								</div>
							</div>
							<div class="form-group col-md-12">
								<label class="col-md-12">2. How Do You Think The Price Point Was ?</label>
								<div class="form-group col-md-2">
									<input type="radio" value="1" id="very_hig" name="think_the_price_point_was">
									<label for="very_hig">Very High</label>
								</div>
								<div class="form-group col-md-2">
								  <input type="radio"  value="2" id="hig" name="radio-group" name="think_the_price_point_was">
								  <label for="hig">High</label>
								</div>
								<div class="form-group col-md-2">
								  <input type="radio"  value="3" id="fai" name="radio-group" name="think_the_price_point_was">
								  <label for="fai">Fair</label>
								</div>
							  <div class="form-group col-md-2">
								  <input type="radio"  value="4" id="lo" name="radio-group" name="think_the_price_point_was">
								  <label for="lo">Low</label>
								</div>
								
							</div>
							
							<div class="form-group col-md-12">
								<label class="col-md-12">3. Detail Review ()</label>
								<div class="form-group col-md-5">
									<textarea rows="3" style="width: 100%;" name="details_review1"></textarea>
								</div>
								
							</div>
						</div>
					</fieldset>
					   <div class="box-footer">
					   <input type="hidden" name="id"  value="<?php echo $id;   ?>">
                     <input class="btn btn-primary" type="submit" id="enquirybtn" value="Save" />
                 </div>
					</form>
<?php  break;case  4: 
echo 'Feeback Saved.Thank You for your Feedback.' ; break; } ?>

 <script>
 $(document).ready(function () {
 $('.start').change(function() {
	var sum = 0;
    $('.start').each(function() {
        sum += Number($(this).val());
    });
	alert(sum);
 });
});
 
 
 
 </script>