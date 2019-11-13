
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
            right: 'month,agendaWeek',
        },
		defaultView: 'agendaWeek',
    views: {
      week: {
        titleFormat: '[Week from] D MMMM YYYY',
        titleRangeSeparator: ' to ',
      }
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
				 $('#ModalEdit #id').val(event.id);
                 $('#ModalEdit #title').val(event.title);
			     $('#ModalEdit #color').val(event.color);
                 $('#ModalEdit #start').val(moment(event.start).format('YYYY-MM-DD'));
				 $('#ModalEdit #startTime').val(moment(event.start).format('HH:mm:ss'));
				 $('#ModalEdit #endTime').val(moment(event.end).format('HH:mm:ss'));
				  $('#ModalEdit #end').val(moment(event.end).format('YYYY-MM-DD'));
				  $('#ModalEdit #Cost').val(event.Actual_cost);
				  $('#ModalEdit #labour').val(event.Actual_labour);
				  $('#ModalEdit #Timeline').val(event.Actual_time);
				  $('#ModalEdit #Timelinetype').val(event.Timelinetype);
				  $('#ModalEdit #Tasklist').val(event.Task_id);
               
                $('#ModalEdit').modal('show');
            });
        },
        eventDrop: function(event, delta, revertFunc) { //   if change of position
            edit(event);
        },
        eventResize: function(event,dayDelta,minuteDelta,revertFunc) { // if change in length
                  edit(event);
        },
            events: $('#projectstage').val()
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
            url: 'office/editEventDate',
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
            url: '',
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
            url: '',
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

