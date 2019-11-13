$(".allowdecimalpoint").on("keypress keyup blur",function (event) {
            //this.value = this.value.replace(/[^0-9\.]/g,'');
     $(this).val($(this).val().replace(/[^0-9\.]/g,''));
            if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
        });
 $(".allownumber").on("keypress keyup blur",function (event) {    
           $(this).val($(this).val().replace(/[^\d].+/, ""));
            if ((event.which < 48 || event.which > 57)) {
                event.preventDefault();
			}
     });
 $(".avoidsepcialcharacter").on("keypress keyup blur",function (event) {    
            if (this.value.match(/[^a-zA-Z0-9 ]/g)) {
                    this.value = this.value.replace(/[^a-zA-Z0-9 ]/g, '');
           }
 });
                 
 $(".allowcharacter").on("keypress keyup blur",function (event) { 
       if (this.value.match(/[^a-zA-Z ]/g)) {
       this.value = this.value.replace(/[^a-zA-Z ]/g, '');
   }
  });
  $(".allowcharacter_specharacter").on("keypress keyup blur",function (event) { 
     var key = event.keyCode;
     if (key >= 48 && key <= 57) {
      event.preventDefault();
       }
   });    
  $(document).ready(function() {
         $('#my-select').multiselect();
     });
     $(document).ready(function() {
        $('.my-select').multiselect();
    });
     $('.datepicker').datepicker({
        weekStart: 1,
        autoclose: true,
        todayHighlight: true,
		  format: "yyyy-mm-dd",
    });
   // $(".chosen").chosen();