
function getBaseURL() {
    return baseUrl = base_url;
};

function get_agent(str){
	var postUrl  = getBaseURL()+'admin/crm/Crm/get_agent' ;
		if (str == '') {
			$("#salesperson").html("<option value=''>Please Select</option>");
		} else {
			$("#salesperson").html("<option value=''>Please Select</option>");
			$.ajax({
				type: "POST",
				url:  postUrl,
				data: { salespersontype : str },
				cache: false,
				success: function(result){
					$("#salesperson").html("<option value=''>Please Select</option>");
					$("#salesperson").append(result);
				}
			});

		}
	}
	
	/// get projectwise unit 
	
	function get_units(str){
		var postUrl  = getBaseURL()+'admin/crm/Crm/get_unit' ;
		if (str == '') {
			$("#units").html("<option value=''>Please Select</option>");
		} else {
			$("#units").html("<option value=''>Please Select</option>");
			$.ajax({
				type: "POST",
				url: postUrl,
				data: { projectid : str },
				cache: false,
				success: function(result){
					$("#units").html("<option value=''>Please Select</option>");
					$("#units").append(result);
				}
			});

		}
	}
	function addfollowup() { 
	var postUrl  = getBaseURL()+'admin/crm/Crm/addFollowup' ;
			 $.ajax({
				type: "POST",
				url: postUrl,
				data: $('#followup').serialize()  ,
				cache: false,
				success: function(result){
					$('.success').html("<div class='alert alert-success'><strong>FollowUp saved Success!</strong> .</div>");
					$('.success').hide().delay(100).fadeIn(400);
					$('.success').hide().delay(5000).fadeOut(400);
					 setTimeout(function(){
           location.reload(); 
                     }, 1000); 
				
				}
			}); 

		
	}
	 function edit_followup(id){
      var postUrl  = getBaseURL()+'admin/crm/Crm/editFollowup' ;
     $.ajax({
				type: "POST",
				url: postUrl,
				data: { followupid :id  }  ,
				cache: false,
				dataType: "JSON",
				success: function(data){
				console.log(data.followupid);
				$('[name="id"]').val(data.followupid);
                $('[name="followdate"]').val(data.followup_date_time);
                $('[name="calltype"]').val(data.calltype);
				$('[name="discuss"]').val(data.discussion);
				$('[name="nextdate"]').val(data.next_followup_date);
                $('#myModal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Department'); // Set title to Bootstrap modal titles
				}
			}); 
        //Ajax Load data from ajax
    }
	
	function openfinaltag(id){
		$('#AddFinalmyModal').modal('show');
		// $( ".modal-backdrop fade in" ).removeClass( "modal-backdrop fade in" );		
	}
	function showfollowupmodal(){
		$('#myModal').modal('show');
		// $( ".modal-backdrop fade in" ).removeClass( "modal-backdrop fade in" );		
	}
	function showaddpayment(){
		$('#addpayment').modal('show');
		// $( ".modal-backdrop fade in" ).removeClass( "modal-backdrop fade in" );		
	}
	function showcontractpopup(){
		$('#addModal').modal('show');
		// $( ".modal-backdrop fade in" ).removeClass( "modal-backdrop fade in" );		
	}

	function addfinaltag(id){
		var Intial_Amount = $('#Intial_Amount').val();
		var paiddate = $('#Paid_date').val();
		//var ContractNumber = $('#contractNumber').val();
		var postUrl  = getBaseURL()+'admin/crm/Crm/addfinalTag' ;
			 $.ajax({
				type: "POST",
				url: postUrl,
				data: { id:id,Intial_Amount:Intial_Amount,paiddate:paiddate}  ,
				cache: false,
				success: function(result){
					$('.success').html("<div class='alert alert-success'><strong>Generate lead Success</strong> .</div>");
					$('.success').hide().delay(100).fadeIn(400);
					$('.success').hide().delay(5000).fadeOut(400);
					setTimeout(function() {
                      location.reload();
      }, 3000);
				
				}
			}); 
	}	
	
	function get_projectWiseBuilding(str){
		var postUrl  = getBaseURL()+'admin/sales/Sales/get_building' ;
		if (str == '') {
			$("#building_id").html("<option value=''>Please Select</option>");
		} else {
			$("#building_id").html("<option value=''>Please Select</option>");
			$.ajax({
				type: "POST",
				url: postUrl,
				data: { project_id : str },
				cache: false,
				success: function(result){
					$("#building_id").html("<option value=''>Please Select</option>");
					$("#building_id").append(result);
				}
			});
		}
	}
	function get_floors(str){
		var postUrl  = getBaseURL()+'admin/sales/Sales/get_floor' ;
		var project_id = $('#project_id').val();
		if (str == '') {
			$("#floor_id").html("<option value=''>Please Select</option>");
		} else {
			$("#floor_id").html("<option value=''>Please Select</option>");
			$.ajax({
				type: "POST",
				url: postUrl,
				data: { buildingid : str,project_id:project_id },
				cache: false,
				success: function(result){
					$("#floor_id").html("<option value=''>Please Select</option>");
					$("#floor_id").append(result);
				}
			});
		}
	}
	function get_floors_with_building(str){
		var postUrl  = getBaseURL()+'admin/unit/get_floor' ;
		var project_id= $('#project').val();
		if (str == '') {
			$("#floor_id").html("<option value=''>Please Select</option>");
		} else {
			$("#floor_id").html("<option value=''>Please Select</option>");
			$.ajax({
				type: "POST",
				url: postUrl,
				data: { project_id : project_id , buildingid:str },
				cache: false,
				success: function(result){
					$("#floor_id").html("<option value=''>Please Select</option>");
					$("#floor_id").append(result);
				}
			});
		}
	}
	
	/*function get_flats(str){*/
		function get_floorsUnits(str){
		var postUrl  = getBaseURL()+'admin/sales/Sales/get_floorWiseUnit' ;
		var projectid=$('#project_id').val();
		var building=$('#building_id').val();
		if (str == '') {
			$("#unit_id").html("<option value=''>Please Select</option>");
		} else {
			$("#unit_id").html("<option value=''>Please Select</option>");
			$.ajax({
				type: "POST",
				url: postUrl,
				data: { floor_id : str,projectid:projectid,building:building },
				cache: false,
				success: function(result){
					$("#unit_id").html("<option value=''>Please Select</option>");
					$("#unit_id").append(result);
				}
			});

		}
	}
	
	function get_unitvalue(str){
		var postUrl  = getBaseURL()+'admin/sales/Sales/get_unit' ;
		var client_id = $('#client_id').val();
		$('#client_details').html('');
			$.ajax({
				type: "POST",
				url: postUrl,
				data: { uid : str, client_id : client_id },
				cache: false,
				success: function(result){
					var res = JSON.parse(result);
					$('#rate_per_sqft').val(res.rateperSqft);
					$('#area_sqft').val(res.areaSqft);
					$('#basic_sale_price').val(res.unitPrice);
					$('#discount').val(0);
					$('#discount_amt').val('0.00');
					$('#total_cost').val(res.unitPrice);
					$.each(res.unit_types,function(index, value1){
						$('#unit_type').append($('<option>').text(value1.UnitType).attr('value', value1.id));
					});
					var i = 1;
					var final_total = 0;
					$.each(res.amenties_array,function(index, value2){
						final_total += parseFloat(value2.list_total);
						$('#client_details').append('<tr><td id="sales_text_item_'+i+'">'+value2.list_item+'</td><td id="sales_text_amount_'+i+'">'+value2.list_amount+'</td><td id="sales_text_discount_'+i+'">'+value2.list_discount+'</td><td id="sales_text_total_'+i+'">'+value2.list_total+'</td><input type="hidden" name="sales_list_item[]" value="'+value2.list_item+'" id="sales_list_item_'+i+'"><input type="hidden" name="sales_list_amount[]" value="'+value2.list_amount+'" id="sales_list_amount_'+i+'"><input type="hidden" name="sales_list_discount[]" value="'+value2.list_discount+'" id="sales_list_discount_'+i+'"><input type="hidden" value="'+value2.list_total+'" name="sales_list_total[]" id="sales_list_total_'+i+'"></tr>');
						i++;
					});
					if(res.isPaidInitial_amt ==0){
					$('.inital_amttr').append('<td style="width:100%;float:left;margin-bottom:5px;">Initial Amount</td><td> <label><input type="checkbox" value="1" id="intial_check" onclick="getamount()"name="initialAmt_ispaid" ><input type="text" value="'+res.initial_amt+'" name="initial_amt" id="initial_amt" readonly class="form-control" style="width:85%;margin-left:5px;display:inline-block;"></label></td>');
					}
					$('#basic_total_cost').val(res.amenties_array[0].list_total);
					$('#total_cost').val(final_total);
					$('#total_cost_val').text(final_total);
					$('#balance').val(final_total);
					$('.totalbalance').val(final_total);
					
				}
			});

		
	}
	
	//for sales discount
	function get_discount(str){
	var postUrl  = getBaseURL()+'admin/sales/Sales/get_discount';
	var basic_sale_price = $('#basic_sale_price').val();
	var advance_amt = $('#advance_amt').val();
	
	var client_id = $('#client_id').val();
		$.ajax({
			type: "POST",
			url: postUrl,
			data: { discount : str, basic_sale_price: basic_sale_price, client_id : client_id },
			cache: false,
			success: function(result){
				var res = JSON.parse(result);
				$('#discount_amt').val(res.discount_amt);
				$('#basic_total_cost').val(res.basic_total_cost);
				$('#sales_text_discount_1').text(res.sales_text_discount);
				$('#sales_list_discount_1').val(res.sales_text_discount);
				$('#sales_text_total_1').text(res.sales_text_total);
				$('#sales_list_total_1').val(res.sales_text_total);
				$('#total_cost_val').text(res.total_cost);
				$('#total_cost').val(res.total_cost);
				if(advance_amt !=0){
					//for edit
				$('#balance').val(res.total_cost - advance_amt);
				$('.totalbalance').val(res.total_cost -advance_amt);
				get_moratorium();
				}else{
				$('#balance').val(res.total_cost);
				$('.totalbalance').val(res.total_cost);
				}
			}
		});

	}
	//for initial amount 
	/*function getamount(){
	var postUrl  = getBaseURL()+'admin/sales/Sales/get_initial_amt' ;
	var emi_period = $('#emi_period').val();
	var emi_percentage = $('#emi_percentage').val();
	if($("#intial_check").is(":checked")){
		var initial_amount=$('#initial_amt').val();
		var balance =parseFloat($('#balance').val())-parseFloat(initial_amount);
	}else{
		var balance =parseFloat($('#balance').val())+parseFloat(initial_amount);
			var balance = $('#balance').val();
	}
	var date = $('#booking_date').val();
		$.ajax({
			type: "POST",
			url: postUrl,
			data: {  emi_period: emi_period, emi_percentage: emi_percentage, balance: balance,date:date },
			cache: false,
			success: function(result){
				var res = JSON.parse(result);
				var j = 1;
				var h = '';
				var i=1;
				$.each(res.emi,function(index, value){
					h += '<tr><td id="emi_text_no_'+j+'">'+ i +'</td><td id="emi_text_duedate_'+j+'">'+value.date+'</td><td id="emi_text_Beginning_Balance_'+j+'">'+value.Beginning_Balance+'</td><td id="emi_text_Total_Payment_'+j+'">'+value.Total_Payment+'</td><td id="emi_text_Principle_'+j+'">'+value.Principle+'</td><td id="emi_text_Interest_'+j+'">'+value.Interest+'</td><td id="emi_text_Ending_Balance_'+j+'">'+value.Ending_Balance+'</td><input type="hidden" name="emi_no[]" value="'+i+'" id="emi_no_'+j+'"><input type="hidden" value="'+value.date+'" name="emi_duedate[]" id="emi_duedate_'+j+'"><input type="hidden" value="'+value.Beginning_Balance+'" name="emi_Beginning_Balance[]" id="emi_Beginning_Balance_'+j+'"><input type="hidden" value="'+value.Total_Payment+'" name="emi_amount[]" id="emi_amount_'+j+'"><input type="hidden" value="'+value.Principle+'" name="emi_Principle[]" id="emi_Principle_'+j+'"><input type="hidden" value="'+value.Interest+'" name="emi_Interest[]" id="emi_Interest_'+j+'"><input type="hidden" value="'+value.Ending_Balance+'" name="emi_Balance[]" id="emi_Balance_'+j+'"><input type="hidden" value="'+value.type+'" name="type[]" id="type'+j+'"></tr>';
					
					
					/*$('#emi_calculator').html('<tr><td id="emi_text_no_'+j+'">'+value.emi_no+'</td><td id="emi_text_duedate_'+j+'">'+value.emi_duedate+'</td><td id="emi_text_amount_'+j+'">'+value.emi_amount+'</td><input type="hidden" name="emi_no[]" value="'+value.emi_no+'" id="emi_no_'+j+'"><input type="hidden" value="'+value.emi_duedate+'" name="emi_duedate[]" id="emi_duedate_'+j+'"><input type="hidden" value="'+value.emi_amount+'" name="emi_amount[]" id="emi_amount_'+j+'"></tr>');
					j++;
					i++;
				});
				$('#emi_calculator').html(h);
				$('#balance').val(res.balance);
			}
		});

	}
	*/
	function get_advance_amt(str){
	var postUrl  = getBaseURL()+'admin/sales/Sales/get_advance_amt' ;
	var balance = $('.totalbalance').val();
	var emi_period = $('#emi_period').val();
	var emi_percentage = $('#emi_percentage').val();
	var date = $('#booking_date').val();
	var moratorium = $('#moratorium').val();
	var moratorium_per = $('#moratorium_per').val();
	var   bookingid=$('#bookingid').val();
	   if (typeof bookingid === "undefined") {
		var balance = $('.totalbalance').val();
		}else{
		var balance = $('#total_cost').val(); 
	}
		$.ajax({
			type: "POST",
			url: postUrl,
			data: { advance_amt : str, emi_period: emi_period, emi_percentage: emi_percentage, balance: balance,date:date,moratorium:moratorium,moratorium_per:moratorium_per },
			cache: false,
			success: function(result){
				var res = JSON.parse(result);
				var j = 1;
				var h = '';
				var i=1;
				$.each(res.emi,function(index, value){
						h += '<tr><td id="emi_text_no_'+j+'">'+ i +'</td><td id="emi_text_duedate_'+j+'">'+value.date+'</td><td id="emi_text_Beginning_Balance_'+j+'">'+value.Beginning_Balance+'</td>';
					if(value.type ==1 && emi_period ==0){
					h +='<td ><input type="text" name="percentage[]" style="width:42px;" id="emi_text_percentage_'+j+'" onchange="get_moratorium_emi_amt_for_per(this.value)" class="allownumericwithdecimalpoint"></td>';
					}else{
						h +='<td ></td>';
					}
					h +='<td id="emi_text_Total_Payment_'+j+'">'+value.Total_Payment+'</td><td id="emi_text_Principle_'+j+'">'+value.Principle+'</td><td id="emi_text_Interest_'+j+'">'+value.Interest+'</td><td id="emi_text_Ending_Balance_'+j+'">'+value.Ending_Balance+'</td><input type="hidden" name="emi_no[]" value="'+i+'" id="emi_no_'+j+'"><input type="hidden" value="'+value.date+'" name="emi_duedate[]" id="emi_duedate_'+j+'"><input type="hidden" value="'+value.Beginning_Balance+'" name="emi_Beginning_Balance[]" id="emi_Beginning_Balance_'+j+'"><input type="hidden" value="'+value.Total_Payment+'" name="emi_amount[]" id="emi_amount_'+j+'"><input type="hidden" value="'+value.Principle+'" name="emi_Principle[]" id="emi_Principle_'+j+'"><input type="hidden" value="'+value.Interest+'" name="emi_Interest[]" id="emi_Interest_'+j+'"><input type="hidden" value="'+value.Ending_Balance+'" name="emi_Balance[]" id="emi_Balance_'+j+'"><input type="hidden" value="'+value.type+'" name="type[]" id="type'+j+'"></tr>';
					j++;
					i++;
				});
				$('#emi_calculator').html(h);
				$('#balance').val(res.balance);
				$('#moratorium_amt').val(res.moratorium_amt);
			}
		});

	}
	
	function get_emi_period(str){
	var postUrl  = getBaseURL()+'admin/sales/Sales/get_emi_period' ;
	var balance = $('#balance').val();
	var emi_percentage = $('#emi_percentage').val();
	var date = $('#booking_date').val();
	var moratorium = $('#moratorium').val();
	var moratorium_per = $('#moratorium_per').val();
	if(emi_percentage  !=0){
		$.ajax({
			type: "POST",
			url: postUrl,
			data: { emi_period : str, balance: balance, emi_percentage: emi_percentage,date:date,moratorium:moratorium,moratorium_per:moratorium_per },
			cache: false,
			success: function(result){
				var res = JSON.parse(result);
				var j = 1;
				var h = '';
				var i=1;
				$.each(res.emi,function(index, value){
								h += '<tr><td id="emi_text_no_'+j+'">'+ i +'</td><td id="emi_text_duedate_'+j+'">'+value.date+'</td><td id="emi_text_Beginning_Balance_'+j+'">'+value.Beginning_Balance+'</td>';
					
						if(value.type ==1 && str ==0){
					h +='<td ><input type="text" name="percentage[]" style="width:42px;" id="emi_text_percentage_'+j+'" onchange="get_moratorium_emi_amt_for_per(this.value)" class="allownumericwithdecimalpoint"></td>';
					}else{
						h +='<td ></td>';
					}
					h +='<td id="emi_text_Total_Payment_'+j+'">'+value.Total_Payment+'</td><td id="emi_text_Principle_'+j+'">'+value.Principle+'</td><td id="emi_text_Interest_'+j+'">'+value.Interest+'</td><td id="emi_text_Ending_Balance_'+j+'">'+value.Ending_Balance+'</td><input type="hidden" name="emi_no[]" value="'+i+'" id="emi_no_'+j+'"><input type="hidden" value="'+value.date+'" name="emi_duedate[]" id="emi_duedate_'+j+'"><input type="hidden" value="'+value.Beginning_Balance+'" name="emi_Beginning_Balance[]" id="emi_Beginning_Balance_'+j+'"><input type="hidden" value="'+value.Total_Payment+'" name="emi_amount[]" id="emi_amount_'+j+'"><input type="hidden" value="'+value.Principle+'" name="emi_Principle[]" id="emi_Principle_'+j+'"><input type="hidden" value="'+value.Interest+'" name="emi_Interest[]" id="emi_Interest_'+j+'"><input type="hidden" value="'+value.Ending_Balance+'" name="emi_Balance[]" id="emi_Balance_'+j+'"><input type="hidden" value="'+value.type+'" name="type[]" id="type'+j+'"></tr>';
					j++;
					i++;
				});
				$('#emi_calculator').html(h);
				
			}
		});
	}else{
		
		alert("Emi percentage Should not be 0");
	}
	}
	
	function get_emi_percentage(str){
	var postUrl  = getBaseURL()+'admin/sales/Sales/get_emi_percentage' ;
	var balance = $('#balance').val();
	var emi_period = $('#emi_period').val();
	var date = $('#booking_date').val();
	var moratorium = $('#moratorium').val();
	var moratorium_per = $('#moratorium_per').val();
		$.ajax({
			type: "POST",
			url: postUrl,
			data: { emi_percentage : str, balance: balance, emi_period: emi_period,date:date,moratorium:moratorium ,moratorium_per:moratorium_per},
			cache: false,
			success: function(result){
				var res = JSON.parse(result);
				var j = 1;
				var h = '';
				var i=1;
				
				$.each(res.emi,function(index, value){
								h += '<tr><td id="emi_text_no_'+j+'">'+ i +'</td><td id="emi_text_duedate_'+j+'">'+value.date+'</td><td id="emi_text_Beginning_Balance_'+j+'">'+value.Beginning_Balance+'</td>';
					if(value.type ==1 && emi_period ==0){
					h +='<td ><input type="text" name="percentage[]" style="width:42px;" id="emi_text_percentage_'+j+'" onchange="get_moratorium_emi_amt_for_per(this.value)" class="allownumericwithdecimalpoint"></td>';
					}else{
						h +='<td ></td>';
					}
					h +='<td id="emi_text_Total_Payment_'+j+'">'+value.Total_Payment+'</td><td id="emi_text_Principle_'+j+'">'+value.Principle+'</td><td id="emi_text_Interest_'+j+'">'+value.Interest+'</td><td id="emi_text_Ending_Balance_'+j+'">'+value.Ending_Balance+'</td><input type="hidden" name="emi_no[]" value="'+i+'" id="emi_no_'+j+'"><input type="hidden" value="'+value.date+'" name="emi_duedate[]" id="emi_duedate_'+j+'"><input type="hidden" value="'+value.Beginning_Balance+'" name="emi_Beginning_Balance[]" id="emi_Beginning_Balance_'+j+'"><input type="hidden" value="'+value.Total_Payment+'" name="emi_amount[]" id="emi_amount_'+j+'"><input type="hidden" value="'+value.Principle+'" name="emi_Principle[]" id="emi_Principle_'+j+'"><input type="hidden" value="'+value.Interest+'" name="emi_Interest[]" id="emi_Interest_'+j+'"><input type="hidden" value="'+value.Ending_Balance+'" name="emi_Balance[]" id="emi_Balance_'+j+'"><input type="hidden" value="'+value.type+'" name="type[]" id="type'+j+'"></tr>';
					j++;
					i++;
				});
				$('#emi_calculator').html(h);
				
			}
		});

	}
	function get_moratorium(){
	var postUrl  = getBaseURL()+'admin/sales/Sales/get_moratorium' ;
	var balance = $('#balance').val();
	var emi_period = $('#emi_period').val();
	var emi_percentage = $('#emi_percentage').val();
	var date = $('#booking_date').val();
	var moratorium = $('#moratorium').val();
	
	if(emi_period ==0 &&  emi_percentage ==0){
		var moratorium_per = $('#moratorium_per').val(100);
	}
	var moratorium_per = $('#moratorium_per').val();
		$.ajax({
			type: "POST",
			url: postUrl,
			data: { emi_percentage : emi_percentage, balance: balance, emi_period: emi_period,date:date,moratorium:moratorium,moratorium_per:moratorium_per },
			cache: false,
			success: function(result){
				var res = JSON.parse(result);
				var j = 1;
				var h = '';
				var i=1;
				console.log(res.emi);
				$.each(res.emi,function(index, value){
								h += '<tr><td id="emi_text_no_'+j+'">'+ i +'</td><td id="emi_text_duedate_'+j+'">'+value.date+'</td><td id="emi_text_Beginning_Balance_'+j+'">'+value.Beginning_Balance+'</td>';
				if(value.type ==1 && emi_period ==0){
					h +='<td ><input type="text" name="percentage[]" style="width:42px;" id="emi_text_percentage_'+j+'" onchange="get_moratorium_emi_amt_for_per(this.value)" class="allownumericwithdecimalpoint"></td>';
					}else{
						h +='<td ></td>';
					}
					h +='<td id="emi_text_Total_Payment_'+j+'">'+value.Total_Payment+'</td><td id="emi_text_Principle_'+j+'">'+value.Principle+'</td><td id="emi_text_Interest_'+j+'">'+value.Interest+'</td><td id="emi_text_Ending_Balance_'+j+'">'+value.Ending_Balance+'</td><input type="hidden" name="emi_no[]" value="'+i+'" id="emi_no_'+j+'"><input type="hidden" value="'+value.date+'" name="emi_duedate[]" id="emi_duedate_'+j+'"><input type="hidden" value="'+value.Beginning_Balance+'" name="emi_Beginning_Balance[]" id="emi_Beginning_Balance_'+j+'"><input type="hidden" value="'+value.Total_Payment+'" name="emi_amount[]" id="emi_amount_'+j+'"><input type="hidden" value="'+value.Principle+'" name="emi_Principle[]" id="emi_Principle_'+j+'"><input type="hidden" value="'+value.Interest+'" name="emi_Interest[]" id="emi_Interest_'+j+'"><input type="hidden" value="'+value.Ending_Balance+'" name="emi_Balance[]" id="emi_Balance_'+j+'"><input type="hidden" value="'+value.type+'" name="type[]" id="type'+j+'"></tr>';
					j++;
					i++;
				});
				$('#emi_calculator').html(h);
				$('#moratorium_amt').val(res.moratorium_amt);
			}
		});

	}
		function get_moratorium_percentage(str){
	var postUrl  = getBaseURL()+'admin/sales/Sales/get_moratorium_per' ;
	var balance = $('#balance').val();
	var emi_period = $('#emi_period').val();
	var emi_percentage = $('#emi_percentage').val();
	var date = $('#booking_date').val();
	var moratorium = $('#moratorium').val();
  if(emi_period !=0 && emi_percentage !=0 &&  str<100){
		$.ajax({
			type: "POST",
			url: postUrl,
			data: { emi_percentage : emi_percentage, balance: balance, emi_period: emi_period,date:date,moratorium:moratorium,moratorium_per:str },
			cache: false,
			success: function(result){
				var res = JSON.parse(result);
				var j = 1;
				var h = '';
				var i=1;
				console.log(res.emi);
				$.each(res.emi,function(index, value){
							h += '<tr><td id="emi_text_no_'+j+'">'+ i +'</td><td id="emi_text_duedate_'+j+'">'+value.date+'</td><td id="emi_text_Beginning_Balance_'+j+'">'+value.Beginning_Balance+'</td>';
					if(value.type ==1 && emi_period ==0){
					h +='<td ><input type="text" name="percentage[]" style="width:42px;" id="emi_text_percentage_'+j+'" onchange="get_moratorium_emi_amt_for_per(this.value)" class="allownumericwithdecimalpoint"></td>';
					}else{
						h +='<td ></td>';
					}
					h +='<td id="emi_text_Total_Payment_'+j+'">'+value.Total_Payment+'</td><td id="emi_text_Principle_'+j+'">'+value.Principle+'</td><td id="emi_text_Interest_'+j+'">'+value.Interest+'</td><td id="emi_text_Ending_Balance_'+j+'">'+value.Ending_Balance+'</td><input type="hidden" name="emi_no[]" value="'+i+'" id="emi_no_'+j+'"><input type="hidden" value="'+value.date+'" name="emi_duedate[]" id="emi_duedate_'+j+'"><input type="hidden" value="'+value.Beginning_Balance+'" name="emi_Beginning_Balance[]" id="emi_Beginning_Balance_'+j+'"><input type="hidden" value="'+value.Total_Payment+'" name="emi_amount[]" id="emi_amount_'+j+'"><input type="hidden" value="'+value.Principle+'" name="emi_Principle[]" id="emi_Principle_'+j+'"><input type="hidden" value="'+value.Interest+'" name="emi_Interest[]" id="emi_Interest_'+j+'"><input type="hidden" value="'+value.Ending_Balance+'" name="emi_Balance[]" id="emi_Balance_'+j+'"><input type="hidden" value="'+value.type+'" name="type[]" id="type'+j+'"></tr>';
					j++;
					i++;
				});
				$('#emi_calculator').html(h);
				$('#moratorium_amt').val(res.moratorium_amt);
			}
		});
  }else{
	  $('#moratorium').val(0);
	  alert('Moratorium Precentage Should not be 100');
  }
	}
	function get_initial_amount(str){
	var postUrl  = getBaseURL()+'admin/sales/Sales/get_emi_percentage' ;
	var balance = $('#balance').val();
	var emi_period = $('#emi_period').val();
	var date = $('#booking_date').val();
	var moratorium = $('#moratorium').val();
	var moratorium_per = $('#moratorium_per').val();
		$.ajax({
			type: "POST",
			url: postUrl,
			data: { emi_percentage : str, balance: balance, emi_period: emi_period,date:date,moratorium:moratorium,moratorium_per:moratorium_per  },
			cache: false,
			success: function(result){
				var res = JSON.parse(result);
				var j = 1;
				var h = '';
				var i=1;
				$.each(res.emi,function(index, value){
							h += '<tr><td id="emi_text_no_'+j+'">'+ i +'</td><td id="emi_text_duedate_'+j+'">'+value.date+'</td><td id="emi_text_Beginning_Balance_'+j+'">'+value.Beginning_Balance+'</td>';
					if(value.type ==1 && emi_period ==0){
					h +='<td ><input type="text" name="percentage[]" style="width:42px;" id="emi_text_percentage_'+j+'" onchange="get_moratorium_emi_amt_for_per(this.value)" class="allownumericwithdecimalpoint"></td>';
					}else{
						h +='<td ></td>';
					}
					h +='<td id="emi_text_Total_Payment_'+j+'">'+value.Total_Payment+'</td><td id="emi_text_Principle_'+j+'">'+value.Principle+'</td><td id="emi_text_Interest_'+j+'">'+value.Interest+'</td><td id="emi_text_Ending_Balance_'+j+'">'+value.Ending_Balance+'</td><input type="hidden" name="emi_no[]" value="'+i+'" id="emi_no_'+j+'"><input type="hidden" value="'+value.date+'" name="emi_duedate[]" id="emi_duedate_'+j+'"><input type="hidden" value="'+value.Beginning_Balance+'" name="emi_Beginning_Balance[]" id="emi_Beginning_Balance_'+j+'"><input type="hidden" value="'+value.Total_Payment+'" name="emi_amount[]" id="emi_amount_'+j+'"><input type="hidden" value="'+value.Principle+'" name="emi_Principle[]" id="emi_Principle_'+j+'"><input type="hidden" value="'+value.Interest+'" name="emi_Interest[]" id="emi_Interest_'+j+'"><input type="hidden" value="'+value.Ending_Balance+'" name="emi_Balance[]" id="emi_Balance_'+j+'"><input type="hidden" value="'+value.type+'" name="type[]" id="type'+j+'"></tr>';
					j++;
					i++;
				});
				$('#emi_calculator').html(h);
				$('#moratorium_amt').val(res.moratorium_amt);
			}
		});

	}
	function get_moratorium_emi_amt_for_per(str){
    var postUrl  = getBaseURL()+'admin/sales/Sales/get_moratorium_emi_per_wise_amt' ;
	var date = $('#booking_date').val();
	var moratorium = $('#moratorium').val();
	var moratorium_amt = $('#moratorium_amt').val();
	///which emi need to be apply this percentage.not for all particular emi only.
	var mor_emi_percentage = $("input[name='percentage[]']")
              .map(function(){return $(this).val();}).get();
		$.ajax({
			type: "POST",
			url: postUrl,
			data: {date:date,moratorium:moratorium,moratorium_amt:moratorium_amt,moratorium_emi_per:mor_emi_percentage  },
			cache: false,
			success: function(result){
				var res = JSON.parse(result);
				var j = 1;
				var h = '';
				var i=1;
				$.each(res.emi,function(index, value){
							h += '<tr><td id="emi_text_no_'+j+'">'+ i +'</td><td id="emi_text_duedate_'+j+'">'+value.date+'</td><td id="emi_text_Beginning_Balance_'+j+'">'+value.Beginning_Balance+'</td>';
					if(value.percentage ==''){
					h +='<td ><input type="text" name="percentage[]" style="width:42px;" id="emi_text_percentage_'+j+'" onchange="get_moratorium_emi_amt_for_per(this.value)" class="allownumericwithdecimalpoint" ></td>';
					}else{
						h +='<td ><input type="text" name="percentage[]" style="width:42px;" id="emi_text_percentage_'+j+'" onchange="get_moratorium_emi_amt_for_per(this.value)" value="'+value.percentage+'" class="allownumericwithdecimalpoint"></td>';
						
					}
					h +='<td id="emi_text_Total_Payment_'+j+'">'+value.Total_Payment+'</td><td id="emi_text_Principle_'+j+'">'+value.Principle+'</td><td id="emi_text_Interest_'+j+'">'+value.Interest+'</td><td id="emi_text_Ending_Balance_'+j+'">'+value.Ending_Balance+'</td><input type="hidden" name="emi_no[]" value="'+i+'" id="emi_no_'+j+'"><input type="hidden" value="'+value.date+'" name="emi_duedate[]" id="emi_duedate_'+j+'"><input type="hidden" value="'+value.Beginning_Balance+'" name="emi_Beginning_Balance[]" id="emi_Beginning_Balance_'+j+'"><input type="hidden" value="'+value.Total_Payment+'" name="emi_amount[]" id="emi_amount_'+j+'"><input type="hidden" value="'+value.Principle+'" name="emi_Principle[]" id="emi_Principle_'+j+'"><input type="hidden" value="'+value.Interest+'" name="emi_Interest[]" id="emi_Interest_'+j+'"><input type="hidden" value="'+value.Ending_Balance+'" name="emi_Balance[]" id="emi_Balance_'+j+'"><input type="hidden" value="'+value.type+'" name="type[]" id="type'+j+'"></tr>';
					j++;
					i++;
				});
				  $('#emi_calculator').html(h);
			}
		});




	}		
	function addcommission(){
		var postUrl  = getBaseURL()+'admin/sales/Sales/add_Commission_payment' ;
			$.ajax({
				type: "POST",
				url: postUrl,
				data:  $('#addcommissionpayment').serialize(),
				cache: false,
				success: function(result){
				$('.success').html("<div class='alert alert-success'><strong>Payment saved Success!</strong> .</div>");
					$('.success').hide().delay(100).fadeIn(400);
					$('.success').hide().delay(5000).fadeOut(400);
					 setTimeout(function(){
           location.reload(); 
                     }, 1000); 
				}
			});

	}
	
function viewpayment(id,type){
	var postUrl  = getBaseURL()+'admin/sales/Sales/viewsalesCommission' ;
			$.ajax({
				type: "POST",
				url: postUrl,
				data:  {id:id,type:type  },
				cache: false,
				dataType: "html",
				success: function(result){
					$('#viewpayment').html(result);
					$('#myModal1').modal('show');
				}
			});
}
function get_clients_contractno(str){
	var postUrl  = getBaseURL()+'admin/sales/Sales/get_contractno' ;
		$.ajax({
			type: "POST",
			url: postUrl,
			data: { clientid : str},
			cache: false,
			dataType: "html",
			success: function(result){
				$('#ref_no').val(result);
			}
		});

	}
	function get_category(str){
		var postUrl  = getBaseURL()+'admin/settings/get_category' ;
		if (str == '') {
			$("#category").html("<option value=''>Please Select</option>");
		} else {
			$("#category").html("<option value=''>Please Select</option>");
			$.ajax({
				type: "POST",
				url: postUrl,
				data: { requesttype : str },
				cache: false,
				success: function(result){
					$("#category").html("<option value=''>Please Select</option>");
					$("#category").append(result);
				}
			});
		}
	}
    $( function() {
    $("#add_products").autocomplete({
      minLength: 0,
      source: function (request, response) {
                $.ajax({
                    type: 'post',
                    url: getBaseURL()+'admin/administration/Administration/material_search',
                    dataType: "json",
                    data: {
                        term: request.term
                    },
					cache: false,
                    success: function (data) {
                        $(this).removeClass('ui-autocomplete-loading');
                        response(data);
                    }
                });
            },
      focus: function( event, ui ) {
        $("#add_products").val( ui.item.label );
        return false;
      },
      select: function( event, ui ) {
		  var producttotal=0;
      if( $('.materialgrandtotal').val() ) {		 
		 producttotal=parseFloat($('.materialgrandtotal').val());
      }
	  var productid=ui.item.id;
	  $( "#productlist" ).append('<tr><td>'+ui.item.code + "-" + ui.item.name +'</td><td>'+ ui.item.instock+'</td><td class="text-center"><div class="qty"><span class="minus bg-dark">-</span><input type="number" class="count" name="qty[]" value="1"><span class="plus bg-dark">+</span></div></td><td class="cost">'+ ui.item.mrp +'</td><td  class="totalcost">'+ ui.item.mrp +'</td><td><input type="hidden" class="subtotal" name="subtotal[]" value="'+ ui.item.mrp +'"><input type="hidden"  name="productid[]" id="productid" value="'+ ui.item.id +'"><span class="glyphicon glyphicon-trash removeOption" onclick="removerow()" style="color:red;"></span></td></tr>'); 
		
		 producttotal = (producttotal)+(parseFloat(ui.item.mrp));
		   $('#total').text(producttotal);
		   $('.mat_cost1').text(producttotal);
		   $('.Material_cost1').val(producttotal);
		   $('.Material_totalcost1').val(producttotal);
		   $('.paymenttotal').text(producttotal);
		   $('.payment_total').val(producttotal);
		   $('.materialgrandtotal').val(producttotal);
          return false;
      }
    })
    .autocomplete( "instance" )._renderItem = function( ul, item ) {
      return $( "<li>" )
        .append( "<div>" + item.code + "-" + item.name + "</div>" )
        .appendTo( ul );
    };
  } );
  
  /* function stockcheck(count,productid){
	  var postUrl  = getBaseURL()+'admin/administration/Administration/stockcheck' ;
		$.ajax({
			type: "POST",
			url: postUrl,
			data: { qty : count,productid:productid},
			cache: false,
			dataType: "html",
			success: function(result){
					if(result ==1){
						
					}elsE{
						
			}
		});
	  
	  
	  
  } */
  
	function get_subcategory(str){
		var postUrl  = getBaseURL()+'admin/settings/get_subcategory' ;
		if (str == '') {
			$("#subcategory").html("<option value=''>Please Select</option>");
		} else {
			$("#subcategory").html("<option value=''>Please Select</option>");
			$.ajax({
				type: "POST",
				url: postUrl,
				data: { categoryid : str },
				cache: false,
				success: function(result){
					$("#subcategory").html("<option value=''>Please Select</option>");
					$("#subcategory").append(result);
				}
			});
		}
	}
	
	function get_subcategory_details(str){
			var postUrl  = getBaseURL()+'admin/settings/get_subcategory_details' ;
		
			$.ajax({
				type: "POST",
				url: postUrl,
				data: { subcategoryid : str },
				cache: false,
				success: function(result){
					$("#price").val(result);
				}
			});
		
	}
		function get_houses(str){
		
		var postUrl  = getBaseURL()+'admin/sales/Sales/get_flat' ;
		var projectid  = $('#projectid').val();
		if (str == '') {
			$("#houses").html("<option value=''>Please Select</option>");
		} else {
			$("#houses").html("<option value=''>Please Select</option>");
			$.ajax({
				type: "POST",
				url: postUrl,
				data: { floor_id : str,projectid:projectid },
				cache: false,
				success: function(result){
					$("#houses").html("<option value=''>Please Select</option>");
					$("#houses").append(result);
				}
			});

		}
	}
	
	function  get_owners(str){
	var postUrl  = getBaseURL()+'admin/settings/get_owners' ;
		if (str == '') {
			$("#owners").html("<option value=''>Please Select</option>");
		} else {
			$("#owners").html("<option value=''>Please Select</option>");
			$.ajax({
				type: "POST",
				url: postUrl,
				data: { ownertype: str, },
				cache: false,
				success: function(result){
					$("#owners").html("<option value=''>Please Select</option>");
					$("#owners").append(result);
				}
			});

		}
		
	}
	function  get_unitByproject(str){
	var postUrl  = getBaseURL()+'admin/Owner/get_unitByProject' ;
			$.ajax({
				type: "POST",
				url: postUrl,
				data: { projectid: str, },
				cache: false,
				success: function(result){
					$(".assigned_unit").html("<option value=''>Please Select</option>");
					$(".assigned_unit").append(result);
				}
			});
	}
	function  get_unitByBuilding(str){
		var project_id=$('#project').val();
	    var postUrl  = getBaseURL()+'admin/Owner/get_unitBybuilding' ;
			$.ajax({
				type: "POST",
				url: postUrl,
				data: { buildingid: str, project_id:project_id},
				cache: false,
				success: function(result){
				///	$(".assigned_unit").html("<option value=''>Please Select</option>");
				//	$(".assigned_unit").html(result);
				$('.assigned_unit').html(result);
      			$('.assigned_unit').multiselect('rebuild');
				}
			});
	}
	
	function get_building(str){
	var postUrl  = getBaseURL()+'admin/floors/get_building' ;
		if (str == '') {
			$("#building").html("<option value=''>Please Select</option>");
		} else {
			$("#building").html("<option value=''>Please Select</option>");
			$.ajax({
				type: "POST",
				url:  postUrl,
				data: { projectid : str },
				cache: false,
				success: function(result){
					$("#building").html("<option value=''>Please Select</option>");
					$("#building").append(result);
				}
			});

		}
	}

	function get_unitOwner(str){
		var postUrl  = getBaseURL()+'admin/Resident/get_unitOwnerDetails' ;
		var projectid  = $('#project').val();
		var building_id  = $('#building').val();
				$.ajax({
					type: "POST",
					url:  postUrl,
					data: { unit_id : str ,projectid:projectid,building_id:building_id},
					cache: false,
					dataType: "json",
					success: function(result){
					  $("#ownerid").val(result.ownid);
					  $("#owner_details").val(result.full_name+','+result.email);
					}
				});
		}
	
		function  get_units(str){
			var project_id=$('#project').val();
			var postUrl  = getBaseURL()+'admin/Owner/get_unit' ;
				$.ajax({
					type: "POST",
					url: postUrl,
					data: { buildingid: str, project_id:project_id},
					cache: false,
					success: function(result){
					///	$(".assigned_unit").html("<option value=''>Please Select</option>");
					//	$(".assigned_unit").html(result);
					$(".assigned_unit").html("<option value=''>Please Select</option>");
					$(".assigned_unit").append(result);
					}
				});
		}

		
	
	
$('#save-members').click(function() {
	var postUrl  = getBaseURL()+'admin/Building/members_save' ;
    $.ajax({
		url: postUrl,
       // container: '#logTime',
        type: "POST",
        data: $('#membersadd').serialize(),
        success: function(data) {
            
        }
    })
});

function  getMilstoneEdit(){
	$('#milestoneform').toggleClass('hide', 'show');
	var milestoneid=$('.milestoneedit').attr('id');
	var postUrl  = getBaseURL()+'admin/Building/getMilstoneEdit' ;
    $.ajax({
		url: postUrl,
        type: "POST",
		data:{milestone_id:milestoneid},
		dataType: "json",
        success: function(data) {
			console.log(data);
			$('[name="milestone_id"]').val(data.id);
			$('[name="summary"]').val(data.milestone_summary);
			$('[name="cost"]').val(data.cost);
			$('[name="currency_id"]').val(data.currency);
			$('[name="status"]').val(data.status);
			$('[name="milestone_title"]').val(data.title);
        }
    })
  }
  
function  getTaskEdit(str){
	$('#new-task-panel').toggleClass('hide', 'show');
	var postUrl  = getBaseURL()+'admin/Building/getTaskEdit' ;
    $.ajax({
		url: postUrl,
        type: "POST",
		data:{task_id:str},
		dataType: "json",
        success: function(data) {
			console.log(data);
			$('[name="heading"]').val(data.taskName);
			$('[name="editordata"]').val(data.description);
			$('[name="start_date"]').val(data.start_date);
			$('[name="due_date"]').val(data.end_date);
			$('[name="milestone"]').val(data.milestone_id);
			$('[name="assigned_to"]').val(data.assign_to);
			$('[name="milestone_title"]').val(data.priority);
			$('[name="task_id"]').val(data.id);
			$('[name="status"]').val(data.status);
			$('.Taskstatus').attr('style','display: block !important');

        }
    })
  }

  function  removeMembers(str){
	var postUrl  = getBaseURL()+'admin/Building/member_remove' ;
    $.ajax({
		url: postUrl,
        type: "POST",
		data:{memeberid:str},
		dataType: "json",
        success: function(data) {
            location.reload();
        }
    })
  }
  function get_project_and_building(str){
	var postUrl  = getBaseURL()+'admin/Resident/' ;
	var project = $('#projects').val();
	var buildings = $('#buildings').val();
	var floors = $('#floors').val();
	var units = $('#units').val();
	var owner = $('#owner').val();
		$.ajax({
			type: "POST",
			url: postUrl,
			data: { project : project, building: buildings, floors: floors, units: units,Owner:owner },
			cache: false,
			success: function(result){
				var res = JSON.parse(result);
				var j = 1;
				var h = '';
				var i=1;
				$.each(res.emi,function(index, value){
						h += '<tr><td id="emi_text_no_'+j+'">'+ i +'</td><td id="emi_text_duedate_'+j+'">'+value.date+'</td><td id="emi_text_Beginning_Balance_'+j+'">'+value.Beginning_Balance+'</td>';
					if(value.type ==1 && emi_period ==0){
					h +='<td ><input type="text" name="percentage[]" style="width:42px;" id="emi_text_percentage_'+j+'" onchange="get_moratorium_emi_amt_for_per(this.value)" class="allownumericwithdecimalpoint"></td>';
					}else{
						h +='<td ></td>';
					}
					h +='<td id="emi_text_Total_Payment_'+j+'">'+value.Total_Payment+'</td><td id="emi_text_Principle_'+j+'">'+value.Principle+'</td><td id="emi_text_Interest_'+j+'">'+value.Interest+'</td><td id="emi_text_Ending_Balance_'+j+'">'+value.Ending_Balance+'</td><input type="hidden" name="emi_no[]" value="'+i+'" id="emi_no_'+j+'"><input type="hidden" value="'+value.date+'" name="emi_duedate[]" id="emi_duedate_'+j+'"><input type="hidden" value="'+value.Beginning_Balance+'" name="emi_Beginning_Balance[]" id="emi_Beginning_Balance_'+j+'"><input type="hidden" value="'+value.Total_Payment+'" name="emi_amount[]" id="emi_amount_'+j+'"><input type="hidden" value="'+value.Principle+'" name="emi_Principle[]" id="emi_Principle_'+j+'"><input type="hidden" value="'+value.Interest+'" name="emi_Interest[]" id="emi_Interest_'+j+'"><input type="hidden" value="'+value.Ending_Balance+'" name="emi_Balance[]" id="emi_Balance_'+j+'"><input type="hidden" value="'+value.type+'" name="type[]" id="type'+j+'"></tr>';
					j++;
					i++;
				});
				$('#emi_calculator').html(h);
				$('#balance').val(res.balance);
				$('#moratorium_amt').val(res.moratorium_amt);
			}
		});

	}
	function  get_lease_units(str){
			var project_id=$('#project').val();
			var leaseUnitType=$('#lease_unit_type').val();
			var postUrl  = getBaseURL()+'admin/tenant/get_unit' ;
				$.ajax({
					type: "POST",
					url: postUrl,
					data: { buildingid: str, project_id:project_id,leaseUnitType:leaseUnitType},
					cache: false,
					success: function(result){
					///	$(".assigned_unit").html("<option value=''>Please Select</option>");
					//	$(".assigned_unit").html(result);
					$("#unit").html("<option value=''>Please Select</option>");
					$("#unit").append(result);
					}
				});
		}
		function  get_buildingOwners(str){
			var project_id=$('#project').val();
			var postUrl  = getBaseURL()+'admin/accounts/get_owner' ;
				$.ajax({
					type: "POST",
					url: postUrl,
					data: { buildingid: str, project_id:project_id},
					cache: false,
					success: function(result){
					///	$(".assigned_unit").html("<option value=''>Please Select</option>");
					//	$(".assigned_unit").html(result);
					$("#owner").html("<option value=''>Please Select</option>");
					$("#owner").append(result);
					}
				});
		}
		function  get_ownerUnits(str){
			var project_id=$('#project').val();
			var buildingid=$('#building').val();
			var postUrl  = getBaseURL()+'admin/accounts/get_owner_units' ;
				$.ajax({
					type: "POST",
					url: postUrl,
					data: { buildingid: buildingid, project_id:project_id,ownerid:str},
					cache: false,
					success: function(result){
					///	$(".assigned_unit").html("<option value=''>Please Select</option>");
					//	$(".assigned_unit").html(result);
					$("#unit").html("<option value=''>Please Select</option>");
					$("#unit").append(result);
					}
				});
		}
		
		function  get_ownerBills(str){
			var project_id=$('#project').val();
			var buildingid=$('#building').val();
			var ownerid   =$('#owner').val();
			var unitid    =$('#unit').val();
			var postUrl  = getBaseURL()+'admin/accounts/get_bills' ;
				$.ajax({
					type: "POST",
					url: postUrl,
					data: { buildingid: buildingid, project_id:project_id,ownerid:ownerid,unitid:unitid,billtype:str},
					cache: false,
					success: function(result){
					///	$(".assigned_unit").html("<option value=''>Please Select</option>");
					//	$(".assigned_unit").html(result);
					$("#bill").html("<option value=''>Please Select</option>");
					$("#bill").append(result);
					}
				});
		}
			function  get_billAmount(str){
			var billtype    =$('#billType').val();
			var postUrl   = getBaseURL()+'admin/accounts/get_billAmount' ;
				$.ajax({
					type: "POST",
					url: postUrl,
					data: { billtype: billtype, billid:str},
					cache: false,
					  dataType: "json",
					success: function(result){
						console.log(result);
					$("#bill_refernceno").val(result.refno);
					$("#totalAmount").val(result.amount);
					}
				});
		}

	function transactionType(str){
		var type = str.value;
		if (type == '') {
			$("#account").css({'display':'none'});
			$("#method").css({'display':'none'});
			$("#category").html("<option value=''>"+select+"...</option>");
			exit;
		}
		//if(type == 'AP' || type == 'AR'){
		//	$("#account").css({'display':'none'});
		//	$("#method").css({'display':'none'});
		//}else{
		//	$("#account").css({'display':'block'});
		//	$("#method").css({'display':'block'});
		//	$(".select2").css({'width':'100%'});
		//}
		if(type == 'AP' || type == 'AR'){
			$("#account").css({'display':'none'});
			$("#method").css({'display':'none'});
			$("#trn_category").css({'display':'block'});
			$("#transfer_account").css({'display':'none'});
		}else if(type == 'TR') {
			$("#trn_category").css({'display':'none'});
			$("#account").css({'display':'none'});
			$("#transfer_account").css({'display':'block'});
			$("#method").css({'display':'block'});
			$(".select2").css({'width':'100%'});
		}else{
			$("#account").css({'display':'block'});
			$("#method").css({'display':'block'});
			$("#trn_category").css({'display':'block'});
			$(".select2").css({'width':'100%'});
			$("#transfer_account").css({'display':'none'});
		}

		var link = getBaseURL();
		$.ajax({
			type: "POST",
			url: link + 'admin/accounts/get_transaction_category',
			data: { type : type  },
			cache: false,
			success: function(result){
				$("#category").html("<option value=''>"+"select"+"...</option>");
				$("#category").append(result);
			}
		});
	}
	
	function get_stage(str){
		var postUrl  = getBaseURL()+'admin/Estimation/stages' ;
		if (str == '') {
			$("#stageid").html("<option value=''>Please Select</option>");
		} else {
			$("#stageid").html("<option value=''>Please Select</option>");
			$.ajax({
				type: "POST",
				url: postUrl,
				data: { projectid : str },
				cache: false,
				success: function(result){
					$("#stageid").html("<option value=''>Please Select</option>");
					$("#stageid").append(result);
				}
			});

		}
	}
	function get_stageWiseTask(str){
		var postUrl  = getBaseURL()+'admin/Estimation/get_task' ;
		var projectid=$("#projectid").val();
		if (str == '') {
			$("#task").html("<option value=''>Please Select</option>");
		} else {
			$("#task").html("<option value=''>Please Select</option>");
			$.ajax({
				type: "POST",
				url: postUrl,
				data: { stageid : str,projectid:projectid},
				cache: false,
				success: function(result){
					$("#task").html("<option value=''>Please Select</option>");
					$("#task").append(result);
					
				}
			});

		}
	}
	
	function check_status(str){
		var postUrl  = getBaseURL()+'admin/Estimation/check_status' ;
		var projectid=$("#projectid").val();
		var stageid=$("#stageid").val();
		var taskid=$("#projectid").val();
		if (str != 'Approved') {
		return true;
		} else {
			$.ajax({
				type: "POST",
				url: postUrl,
				data: { status:str,stageid : stageid,projectid:projectid,taskid:taskid},
				cache: false,
				success: function(result){
					if(result ==1){
						alert('This Task Estimation Already Approved !!!;');
						$('#estatus option:selected').removeAttr('selected');
					}
				}
			});

		}
	}
function get_buildings(str){
	var postUrl  = getBaseURL()+'main/get_building' ;
		if (str == '') {
			$("#building").html("<option value=''>Please Select</option>");
		} else {
			$("#building").html("<option value=''>Please Select</option>");
			$.ajax({
				type: "POST",
				url:  postUrl,
				data: { projectid : str },
				cache: false,
				success: function(result){
					$("#building").html("<option value=''>Please Select</option>");
					$("#building").append(result);
				}
			});

		}
	}



function get_buildingfloors(str){
	var projectid=$("#projectid").val();
	var postUrl  = getBaseURL()+'main/get_buildingfloors' ;
		if (str == '') {
			$("#floor").html("<option value=''>Please Select</option>");
		} else {
			$("#floor").html("<option value=''>Please Select</option>");
			$.ajax({
				type: "POST",
				url:  postUrl,
				data: { projectid : projectid, building:str },
				cache: false,
				success: function(result){
					$("#floor").html("<option value=''>Please Select</option>");
					$("#floor").append(result);
				}
			});

		}
	}
	
	

function get_floorunit(str){
	var projectid=$("#projectid").val();
	var buildingid=$("#building").val();
	var postUrl  = getBaseURL()+'main/get_floorUnits' ;
		if (str == '') {
			$("#units").html("<option value=''>Please Select</option>");
		} else {
			$("#units").html("<option value=''>Please Select</option>");
			$.ajax({
				type: "POST",
				url:  postUrl,
				data: { projectid : projectid, building:buildingid,floorid:str },
				cache: false,
				success: function(result){
					$("#units").html("<option value=''>Please Select</option>");
					$("#units").append(result);
				}
			});

		}
	}


function get_leads(str){
	var postUrl  = getBaseURL()+'admin/crm/Crm/get_leads' ;
			$.ajax({
				type: "POST",
				url:  postUrl,
				data: { campaignid:str },
				cache: false,
				success: function(result){
					$(".send_to").html(result);
				}
			});
	}

	function get_buildingwise_floor(str){
	var postUrl  = getBaseURL()+'admin/floors/get_building' ;
		if (str == '') {
			$("#building").html("<option value=''>Please Select</option>");
		} else {
			$("#building").html("<option value=''>Please Select</option>");
			$.ajax({
				type: "POST",
				url:  postUrl,
				data: { projectid : str },
				cache: false,
				success: function(result){
					$("#building").html("<option value=''>Please Select</option>");
					$("#building").append(result);
				}
			});

		}
	}

