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

//==========================================================
//  Employee Personal Details
//==========================================================
$("#savePersonal").click(function ()  {

    $("#personalForm").validate({
        excluded: ':disabled',
         rules: {

            first_name: {
                required: true,
				maxlength: 25

            },
            last_name: {
                required: true,
				maxlength: 25
            },
			marital_status:{
                required: true
				
            },
            date_of_birth: {
                required: true,
				minAge: 18,
				
            },
            country: {
                required: true
            },
            Category_id: {
                required: true
            },
            EmployeeType_id: {
                required: true
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

//==========================================================
//  Employee add Employee Validation
//==========================================================


$("#addemployee").click(function ()  {

    $("#create_employee").validate({
        excluded: ':disabled',
        rules: {

            first_name: {
                required: true,
				maxlength: 25

            },
            last_name: {
                required: true,
				maxlength: 25
            },
			marital_status:{
                required: true
				
            },
            date_of_birth: {
                required: true,
				minAge: 18,
				
            },
            country: {
                required: true
            },
            Category_id: {
                required: true
            },
            EmployeeType_id: {
                required: true
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

//==========================================================
//  Employee Contact Validation
//==========================================================
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

//==========================================================
//  Employee Salary Validation
//==========================================================
$("#saveSalary").click(function ()  {

    $("#SalaryForm").validate({
        excluded: ':disabled',
        rules: {
            grade_id: {
                required: true
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
    }),
    $('input.earning').each(function() {
        $(this).rules("add",
            {
                required: true,
                number: true
            })
    });

    $('input.deduction').each(function() {
        $(this).rules("add",
            {
                required: true,
                number: true
            })
    });
});
//==========================================================
//  Create Invoice
//==========================================================
$("#saveInvoice").click(function ()  {

    $("#from-invoice").validate({
        excluded: ':disabled',
        rules: {

            customer_id: {
                required: true
            },
            invoice_date: {
                required: true
            },
            due_date: {
                required: true
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

$.validator.addMethod("DateValidateGreaterthan", 
function(value, element, params) {

    if (!/Invalid|NaN/.test(new Date(value))) {
        return new Date(value) > new Date($(params).val());
    }

    return isNaN(value) && isNaN($(params).val()) 
        || (Number(value) > Number($(params).val())); 
},'Must be greater than Joined date.');