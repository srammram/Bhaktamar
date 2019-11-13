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
$("#request").click(function ()  {
	
    $("#requestform").validate({
        excluded: ':disabled',
         rules: {

            title: {
                required: true,
				

            },
            date: {
                required: true,
			
            },
			requesttype:{
                
				
            },
            categorytype: {
                required: true,
				
				
            },
            description: {
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