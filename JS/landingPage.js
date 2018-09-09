//Datepickers
$(document).ready(function () { 
    $(".datepickerIn").datepicker({
        dateFormat: "dd-M-yy",//Specific format
        minDate: new Date(),//Sets minDate to today's date
        onSelect: function (date) {
            var date2 = $('.datepickerIn').datepicker('getDate');
            date2.setDate(date2.getDate());
            $('.datepickerOut').datepicker('option', 'minDate', date2);//Disables everything before checkin
        }
    });
    $('.datepickerOut').datepicker({
        dateFormat: "dd-M-yy",
        onClose: function () {
            var dt1 = $('.datepickerIn').datepicker('getDate');
            var dt2 = $('.datepickerOut').datepicker('getDate');
            if (dt2 <= dt1) {
                var minDate = $('.datepickerOut').datepicker('option', 'minDate');
                $('.datepickerOut').datepicker('setDate', minDate);
            }
        }
    });
});