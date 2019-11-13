function getBaseURL() {
    return baseUrl = base_url;
};
//*******************************************************
//*********************Get CSRF TOKEN********************
//*******************************************************

function getCookie(name) {
    var cookieValue = null;
    if (document.cookie && document.cookie != '') {
        var cookies = document.cookie.split(';');
        for (var i = 0; i < cookies.length; i++) {
            var cookie = jQuery.trim(cookies[i]);
            // Does this cookie string begin with the name we want?
            if (cookie.substring(0, name.length + 1) == (name + '=')) {
                cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
                break;
            }
        }
    }
    return cookieValue;
}
var csrftoken = getCookie('csrf_cookie_name');

$(function(){
    $('#start').datepicker({
        inline: true,
        autoclose: true,
        format: "yyyy-mm-dd",
        todayHighlight: true,
        orientation: "top auto",
        todayBtn: true,
        todayHighlight: true,
        onSelect: function(dateText, inst) {
            var d = new Date(dateText);
            $('#fullcalendar').fullCalendar('gotoDate', d);
        }
    });

    $('#end').datepicker({
        inline: true,
        autoclose: true,
        format: "yyyy-mm-dd",
        todayHighlight: true,
        orientation: "top auto",
        todayBtn: true,
        todayHighlight: true,
        onSelect: function(dateText, inst) {
            var d = new Date(dateText);
            $('#fullcalendar').fullCalendar('gotoDate', d);
        }
    });

    //
    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month'
        },
		 dayClick: function( date, allDay, jsEvent, view ) { 
                    var myDate = new Date();
                    var isLocked=document.getElementById("locked")
                    var currMonth = getCurrentDisplayedMonth()
                    var blockedMonths = getMonthsBlockedByUserFromList();   
                 }, 
//console.log($(#currentdate).val());
       defaultDate: $('#currentdate').val(),
        editable: true,
        eventLimit: true, // allow "more" link when too many events
        selectable: true,
        selectHelper: true,
        select: function(start, end) {
            $('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD'));
            $('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD'));
            $('#ModalAdd').modal('show');
        },
        eventRender: function(event, element) {
            element.bind('dblclick', function() {
			     $('#ModalEdit #shift').append(event.title).trigger('change');
                 $('#ModalEdit #eStart').val(moment(event.start).format('YYYY-MM-DD'));
               
                $('#ModalEdit').modal('show');
            });
        },
        eventDrop: function(event, delta, revertFunc) { //   if change of position
          
            edit(event);
                    
        },
        eventResize: function(event,dayDelta,minuteDelta,revertFunc) { // if change in length
                  edit(event);

        },
            events:getBaseURL() + 'admin/payroll/office/getRoster/'+$('#employeeid').val()+'/'+$('#currentdate').val()
    });

    function edit(event){
		
        start = event.start.format('YYYY-MM-DD HH:mm:ss');
        if(event.end){
            end = event.end.format('YYYY-MM-DD HH:mm:ss');
        }else{
            end = start;
        }

        id =  event.id;

        Event = [];
        Event[0] = id;
        Event[1] = start;
        Event[2] = end;

        $.ajax({
            url: 'payroll/office/editEventDate',
            type: "POST",
            data: {Event:Event, 'csrf_test_name': csrftoken},
            success: function(msg){
                alert('Event Saved Successfully');
            },
            error: function(){
                alert("failure");
            }
        });
    }

    //add new event

    $('#addEvent').on('click', function(e){
        // We don't want this to act as a link so cancel the link action
        e.preventDefault();
        var input = $("<input>")
            .attr("type", "hidden")
            .attr("name", "csrf_test_name").val( getCookie('csrf_cookie_name'));
        $('form.addEvent').append($(input));
        $.ajax({
            type: "POST",
            url: 'payroll/office/addShiftroaster',
            data: $('form.addEvent').serialize(),
            success: function(msg){
                //$("#thanks").html(msg)
                $("#ModalAdd").modal('hide');
                $('#calendar').fullCalendar( 'refetchEvents' );
            },
            error: function(){
                alert("failure");
            }
        });
    });
  $('#addshift').on('click', function(e){
        // We don't want this to act as a link so cancel the link action
        e.preventDefault();
        var input = $("<input>")
            .attr("type", "hidden")
            .attr("name", "csrf_test_name").val( getCookie('csrf_cookie_name'));
        $('form.addEvent').append($(input));
        $.ajax({
            type: "POST",
            url: 'payroll/office/addshiftOverall',
            data: $('form.addEvent').serialize(),
            success: function(msg){
                //$("#thanks").html(msg)
                $("#overallshift").modal('hide');
                $('#calendar').fullCalendar( 'refetchEvents' );
            },
            error: function(){
                alert("failure");
            }
        });
    });
    //Edit event
    $('#editEvent').on('click', function(e){
        // We don't want this to act as a link so cancel the link action
        e.preventDefault();

        var input = $("<input>")
            .attr("type", "hidden")
            .attr("name", "csrf_test_name").val( getCookie('csrf_cookie_name'));
        $('form.editEvent').append($(input));
        $.ajax({
            type: "POST",
            url: 'payroll/office/edit_event',
            data: $('form.editEvent').serialize(),
            success: function(msg){
                $("#ModalEdit").modal('hide');
                $('#calendar').fullCalendar( 'refetchEvents' );
            },
            error: function(){
                alert("failure");
            }
        });
    });

});
$(document).ready(function() {
  /*   $("#startTime").timepicker({
        showInputs: false,
        defaultTime: 'current',
        showSeconds: true,
        showMeridian: false,
    });

    $("#endTime").timepicker({
        showInputs: false,
        defaultTime: 'current',
        showSeconds: true,
        showMeridian: false,
    }); */
})

$(document).ready(function() {
   /*  $("#eStartTime").timepicker({
        showInputs: false,
        defaultTime: 'current',
        showSeconds: true,
        showMeridian: false,
    });

    $("#eEndTime").timepicker({
        showInputs: false,
        defaultTime: 'current',
        showSeconds: true,
        showMeridian: false,
    }); */
})


$(document).ready(function() {

    $('#eStart').datepicker({
        inline: true,
        autoclose: true,
        format: "yyyy-mm-dd",
        todayHighlight: true,
        orientation: "top auto",
        todayBtn: true,
        todayHighlight: true,
        onSelect: function(dateText, inst) {
            var d = new Date(dateText);
            $('#fullcalendar').fullCalendar('gotoDate', d);
        }
    });

    $('#eEnd').datepicker({
        inline: true,
        autoclose: true,
        format: "yyyy-mm-dd",
        todayHighlight: true,
        orientation: "top auto",
        todayBtn: true,
        todayHighlight: true,
        onSelect: function(dateText, inst) {
            var d = new Date(dateText);
            $('#fullcalendar').fullCalendar('gotoDate', d);
        }
    });

})

