//*********************************************
//    Employee Attendance
//*********************************************

$(document).ready(function() {

    $(':checkbox').on('change', function() {
        var th = $(this), id = th.prop('id');

        if (th.is(':checked')) {
			
            $(':checkbox[id="' + id + '"]').not($(this)).prop('checked', false);
        }
    });
    $('input.select_one').on('change', function() {
        $('input.select_one').not(this).prop('checked', false);
    });


    var parent_absent = $('input[id="parent_absent"]');
    var parent_present = $('input[id="parent_present"]');
	  var Allows = $('input[id="Allows"]');
    var child_present = $('input[class="child_present"]');
	var childallow = $('input[class="childallow"]');

    var child_absent = $('input[class="child_absent"]');

    $('select[id="disable"]').prop('disabled', true);
    child_absent.click(function() {
		
        if (this.checked) {
			//console.log(5);
           // $('select[id="disable"]').prop('disabled', false);
		   $("select").find('option').removeAttr("selected");
        }
    });
    parent_absent.change(function() {
		
        if (this.checked) {
			console.log(7)
            child_present.prop('checked', false);
        }
    });
    parent_present.change(function() {
		
        if (this.checked) {
			console.log(9);
            child_absent.prop('checked', false);
        }
    });
    child_present.change(function() {
        parent_absent.prop($('input[class="child_present"]').length === 0);
    }).change();
    child_absent.change(function() {
        parent_present.prop($('input[class="child_absent"]').length === 0);
    }).change();
    Allows.change(function() {
	
        if (this.checked) {
			
            $( ".childallow" ).prop('checked', true);
        }else{
			$( ".childallow" ).prop('checked', false);
		}
    });
	  childallow.change(function() {
		
        Allows.prop($('input[class="childallow"]').length === 0);
    }).change();
});

function Leave_request_check() {

    console.log(str.id);
    var id = str.id;
    var postUrl     = getBaseURL() + 'employee/mail/change_status';
    var csrftoken = getCookie('csrf_cookie_name');

    // now upload the file using $.ajax
    $.ajax({
        url: postUrl,
        type: "POST",
        data: { id : id, 'csrf_test_name': csrftoken },
        cache: false,
        success: function(response) {
            console.log(response);
            var list        = 'admin/mail/inboxList';
            reload_table();
        }
    });

}