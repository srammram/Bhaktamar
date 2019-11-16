$.validator.addMethod("minAge", function(value, element, min) {
    var today = new Date();
    var birthDate = new Date(value);
    var age = today.getFullYear() - birthDate.getFullYear();
    if (age > min+1) {
        return true;
    }
    var m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }
    return age >= min;
}, "You are not old enough(18<)!");

$.validator.addMethod("greaterThan", 
function(value, element, params) {
    if (!/Invalid|NaN/.test(new Date(value))) {
        return new Date(value) > new Date($(params).val());
    }

    return isNaN(value) && isNaN($(params).val()) 
        || (Number(value) > Number($(params).val())); 
},'Must be greater than Frome date.');

$.validator.addMethod("greaterThanNumber", 
function(value, element, params) {

    if (!/Invalid|NaN/.test(new Date(value))) {
        return new Date(value) < new Date($(params).val());
    }

    return isNaN(value) && isNaN($(params).val()) 
        || (Number(value) < Number($(params).val())); 
},'Must be greater than Per Year.');

//============            ================

$("#enquiry").click(function ()  {
    $("#enquiryform").validate({
        excluded: ':disabled',
         rules: {

            Customername: {
                required: true,
				maxlength: 25

            },
            
        },
messages: {
        dob: {
            required: "Please enter you date of birth.",
            minAge: "You are not old enough(18<)!"
        } 
    },
        highlight: function(element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function(element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'help-block animated fadeInDown',
        errorPlacement: function(error, element) {
            if (element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }
    })
});

$.validator.addMethod('customphone', function (value, element) {
    return this.optional(element) || /[0-9\-\(\)\s]+/.test(value);
}, "Please enter a valid phone number");
$.validator.addMethod('TextCheck', function (value, element) {
    return this.optional(element) || /[a-z]/.test(value);
}, "Must contain  letters");
      
$("#saveContact").click(function ()  {

    $("#ContactForm").validate({
        excluded: ':disabled',
        rules: {
			address_1:'TextCheck',
            city: 'TextCheck',
			state:'TextCheck',
			work_email:'TextCheck',
            postal: {
                required: true
            },
            home_telephone:'customphone',
			 work_telephone:'customphone',
			  mobile:'customphone',
             country: {
                required: true
            },
			
			other_email: {
                email: true
            },
			
        },

        highlight: function(element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function(element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'help-block animated fadeInDown',
        errorPlacement: function(error, element) {
            if (element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }
    })
});
//=======================================================


$.validator.addMethod("DateValidateGreaterthan", 
function(value, element, params) {

    if (!/Invalid|NaN/.test(new Date(value))) {
        return new Date(value) > new Date($(params).val());
    }

    return isNaN(value) && isNaN($(params).val()) 
        || (Number(value) > Number($(params).val())); 
},'Must be greater than Joined date.');


$("#servicesprovider_form_submit").click(function ()  {
    $("#service_providerform").validate({
        excluded: ':disabled',
         rules: {

            providername: {
                required: true,
            },
            
        },
messages: {
        dob: {
            required: "Please enter you date of birth.",
            minAge: "You are not old enough(18<)!"
        } 
    },
        highlight: function(element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function(element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'help-block animated fadeInDown',
        errorPlacement: function(error, element) {
            if (element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }
    })
});


$("#project_form_submit").click(function ()  {
    $("#projectform").validate({
        excluded: ':disabled',
         rules: {
            Name: {
                required: true,
            },
            projecttype: {
                required: true,
            },
            Start_date: {
                required: true,
            },
            Project_area: {
                required: true,
            },
            Planned_floors: {
                required: true,
            },
            Planned_unit: {
                required: true,
            },
            complete_date: { greaterThan: "#start_date" }
        },

        highlight: function(element) {
            $(element).closest('.col-md-3').addClass('has-error');
        },
        unhighlight: function(element) {
            $(element).closest('.col-md-3').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'help-block animated fadeInDown',
        errorPlacement: function(error, element) {
            if (element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }
    })
});




$("#ownersubmit").click(function ()  {
    $("#ownerform").validate({
        excluded: ':disabled',
         rules: {
            fullname: {
                required: true,
            },
            salutation: {
                required: true,
            },
            
        },

        highlight: function(element) {
            $(element).closest('.col-md-6').addClass('has-error');
        },
        unhighlight: function(element) {
            $(element).closest('.col-md-6').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'help-block animated fadeInDown',
        errorPlacement: function(error, element) {
            if (element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }
    })
	
});



$(".userformbutton").click(function ()  {
    $(".userform").validate({
        excluded: ':disabled',
         rules: {
            first_name: {
                required: true,
            },
          
            gender: {
                required: true,
            },
            username: {
                required: true,
            },
            password: {
				minlength : 6,
                required: true,
            },
            confirm_password: {
                  minlength : 6,
                    equalTo : "#password"
            },
            status: {
                required: true,
            },
			  group: {
                required: true,
            },
        },

        highlight: function(element) {
            $(element).closest('form-group').addClass('has-error');
        },
        unhighlight: function(element) {
            $(element).closest('form-group').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'help-block animated fadeInDown',
        errorPlacement: function(error, element) {
            if (element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }
    })
});


$(".billpaymentformsave").click(function ()  {
    $(".billpaymentform").validate({
        excluded: ':disabled',
         rules: {
            paid_from: {
                required: true,
            },
			 project_id: {
                required: true,
            },
            building_id: {
                required: true,
            },
            owner_id: {
                required: true,
            },
            unit_id: {
                required: true,
            },
			billType: {
                required: true,
            },
			bill: {
                required: true,
            },
			paid_date: {
                required: true,
            },
			Total_amount: {
                required: true,
            },
            paidamount: {
                    equalTo : "#totalAmount"
            },
        },
 messages: {
            'paidamount': {
                equalTo: "Please enter the same Amount"
            }
        },
        highlight: function(element) {
            $(element).closest('.col-md-12').addClass('has-error');
        },
        unhighlight: function(element) {
            $(element).closest('.col-md-12').removeClass('has-error');
        },
		
        errorElement: 'span',
        errorClass: 'help-block animated fadeInDown',
        errorPlacement: function(error, element) {
            if (element.parent('.col-md-12').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }
    })
});



$(".saveestimation_form").click(function ()  {
    $(".estimationform").validate({
        excluded: ':disabled',
         rules: {
            estatus: {
                required: true,
            },
			 date: {
                required: true,
            },
          
            refno: {
                required: true,
            },
			 projectid: {
                required: true,
            },
            stageid: {
                required: true,
            },
			  taskid: {
                required: true,
            },
			  
        },

        highlight: function(element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function(element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
		
        errorElement: 'span',
        errorClass: 'help-block animated fadeInDown',
        errorPlacement: function(error, element) {
            if (element.parent('.form-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }
    })
});




$("#booking").click(function ()  {
    $("#bookingform").validate({
        excluded: ':disabled',
         rules: {
            date: {
                required: true,
            },
			  applicantname: {
                required: true,
            },
			 building_id: {
                required: true,
            },
			 floor_id: {
                required: true,
            },
			 unit_id: {
                required: true,
            },
        },

        highlight: function(element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function(element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
		
        errorElement: 'span',
        errorClass: 'help-block animated fadeInDown',
        errorPlacement: function(error, element) {
            if (element.parent('.form-group .form-control').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }
    });
});
