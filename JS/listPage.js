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
//Slider range
$(function () {
    $("#slider").slider({
        range: true,
        min: 0,
        max: 1000,
        values: [0, 1000],
        slide: function (event, ui) {//Ajax call each time user modifies the range
            $("#min").val(ui.values[0]);
            $("#max").val(ui.values[1]);
            var city = document.getElementById("city").value;
            var roomType = document.getElementById("roomType").value;
            var countOfGuests = document.getElementById("countOfGuests").value;
            var min = document.getElementById("min").value;
            var max = document.getElementById("max").value;

            var obj = { "city": city, "roomType": roomType, "countOfGuests": countOfGuests, "min": min, "max": max };
            var myJSON = JSON.stringify(obj);
            $.ajax({
                url: "PHP/searchHotels.php",
                dataType: "html",
                type: 'POST',
                data: myJSON,
                success: function (data) {
                    $("#result").html(data);
                }
            });
            }
    });
    $("#min").val($("#slider").slider("values", 0));
    $("#max").val($("#slider").slider("values", 1));
});
//Redirecting user to room's page
function goToRoom(name) {
    var checkIn = $('#checkIn').val();
    var checkOut = $('#checkOut').val();
    if($("#checkIn").val()!=="" && $("#checkOut").val()!=="") {//Check's if user gave checkIn and checkOut dates
        window.location.href = "roomPage.php?name=" + name +"&checkIn="+checkIn+"&checkOut="+checkOut;
    } else{
        alertify.alert("Update","You must give a check in and check out date");
    }
}
$(function send() {
    //Ajax call when user changes the city field
    $('#city').change(function(){
        var city = document.getElementById("city").value;
        var roomType = document.getElementById("roomType").value;
        var countOfGuests = document.getElementById("countOfGuests").value;
        var min = document.getElementById("min").value;
        var max = document.getElementById("max").value;

        var obj = { "city": city, "roomType": roomType, "countOfGuests": countOfGuests, "min": min, "max": max };
        var myJSON = JSON.stringify(obj);
        $.ajax({
            url: "PHP/SearchHotels.php",
            dataType: "html",
            type: 'POST',
            data: myJSON,
            success: function (data) {
                $("#result").html(data);
            }
        });
    });   
    //Ajax call when user changes the count of guests field
    $('#countOfGuests').change(function(){
        var city = document.getElementById("city").value;
        var roomType = document.getElementById("roomType").value;
        var countOfGuests = document.getElementById("countOfGuests").value;
        var min = document.getElementById("min").value;
        var max = document.getElementById("max").value;

        var obj = { "city": city, "roomType": roomType, "countOfGuests": countOfGuests, "min": min, "max": max };
        var myJSON = JSON.stringify(obj);
        $.ajax({
            url: "PHP/SearchHotels.php",
            dataType: "html",
            type: 'POST',
            data: myJSON,
            success: function (data) {
                $("#result").html(data);
            }
        });
    });
    //Ajax call when user changes the room type field
    $('#roomType').change(function(){
        var city = document.getElementById("city").value;
        var roomType = document.getElementById("roomType").value;
        var countOfGuests = document.getElementById("countOfGuests").value;
        var min = document.getElementById("min").value;
        var max = document.getElementById("max").value;

        var obj = { "city": city, "roomType": roomType, "countOfGuests": countOfGuests, "min": min, "max": max };
        var myJSON = JSON.stringify(obj);
        $.ajax({
            url: "PHP/SearchHotels.php",
            dataType: "html",
            type: 'POST',
            data: myJSON,
            success: function (data) {
                $("#result").html(data);
            }
        });
    });
});