$(function () {
    var obj = {};
    var myJSON = JSON.stringify(obj);
    //Get user's bookings when the page loads
    $.ajax({
        url: "PHP/getBookings.php",
        dataType: "html",
        type: 'POST',
        data: myJSON,
        success: function (data) {
            $("#result").html(data);
        }
    });
    //Get user's reviews when the page loads
    $.ajax({
        url: "PHP/getReviews.php",
        dataType: "html",
        type: 'POST',
        data: myJSON,
        success: function (data) {
            $("#reviewResults").html(data);
        }
    });
    //Get user's favorites when the page loads
    $.ajax({
        url: "php/getFavorites.php",
        dataType: "html",
        type: 'POST',
        data: myJSON,
        success: function (data) {
            $("#favoriteResults").html(data);
        }
    });

});
//Redirects user to room's page
function goToRoom(checkIn, checkOut, name) {
    window.location.href = "roomPage.php?checkIn=" + checkIn + "&name=" + name + "&checkOut=" + checkOut ;
}