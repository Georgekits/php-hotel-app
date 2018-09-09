//Check book Button Value
function checkButton(checkIn, checkOut,room_id) {
    var value =  document.getElementById("bookButton").value;
    
    if (value == "Book Now"){
         Booking(checkIn, checkOut,room_id);
         document.getElementById("bookButton").value= "Already Booked";
    } else {
         Delete(room_id);
         document.getElementById("bookButton").value = 'Book Now';
    }
 }
 //Delete from Bookings Table
 function Delete(room_id) {
     var obj = {"room_id": room_id};
     var myJSON = JSON.stringify(obj);

     $.ajax({
         url: "PHP/DeleteBook.php",
         dataType: "html",
         type: 'POST',
         data: myJSON,
         success: function (data) {
             $("#result").html(data);
         }
     });
 }
 //Booking Button
 function Booking(checkIn, checkOut,room_id) {
     var currTmp = timestamp();
     var obj = { "currTmp": currTmp, "checkIn": checkIn, "checkOut": checkOut, "room_id": room_id};
     var myJSON = JSON.stringify(obj);

     $.ajax({
         url: "PHP/Booking.php",
         dataType: "html",
         type: 'POST',
         data: myJSON,
         success: function (data) {
             $("#result").html(data);
         }
     });
 }
 //Get Rate
 function getRate() {
     var rate = 0;
     if(document.getElementById('star1').checked) {
        var rate = 1;
     } else if (document.getElementById('star2').checked) {
         var rate = 2;
     } else if (document.getElementById('star3').checked) {
         var rate = 3;
     } else if (document.getElementById('star4').checked) {
         var rate = 4;
     } else if (document.getElementById('star5').checked) {
         var rate = 5;
     } 
     return rate;
 }
 //Get Current Timestamp
 function timestamp() {
     var now = new Date();
     // Create an array with the current month, day and time
     var date = [ now.getDate(),now.getMonth() + 1, now.getFullYear() ];
     // Create an array with the current hour, minute and second
     var time = [ now.getHours(), now.getMinutes(), now.getSeconds() ];
     // Determine AM or PM suffix based on the hour
     var suffix = ( time[0] < 12 ) ? "AM" : "PM";
     // Convert hour from military time
     time[0] = ( time[0] < 12 ) ? time[0] : time[0] - 12;
     // If hour is 0, set it to 12
     time[0] = time[0] || 12;
     // If seconds and minutes are less than 10, add a zero
     for ( var i = 1; i < 3; i++ ) {
         if ( time[i] < 10 ) {
         time[i] = "0" + time[i];
         }
     }
     // Return the formatted string
     return date.join("/") + " " + time.join(":") + " " + suffix;
 }
 //Add Review 
 function addReview(room_id) {
     var rate = getRate();
     var currTmp = timestamp();
     var text = document.getElementById("reviewText").value;

     var obj = { "rate": rate, "text": text, "currTmp": currTmp, "room_id": room_id};
     var myJSON = JSON.stringify(obj);

     $.ajax({
         url: "PHP/addReview.php",
         dataType: "html",
         type: 'POST',
         data: myJSON,
         success: function (data) {
             $("#reviews").html(data);
         }
     });
 }

 $(function addFavorite(){
    var status = document.getElementById("status").getAttribute("value");
    if(status == 1 ) {
        $("#heart").prop('checked', true);
    }
    //If heart is checked add this room to favorites
    $("#heart").change(function(){
        if(document.getElementById('heart').checked) {
            var currTmp = timestamp();                   
            var room_id = document.getElementById("room_id").getAttribute("value");
            var obj = { "room_id": room_id , "currTmp": currTmp};
            var myJSON = JSON.stringify(obj);
            $.ajax({
                url: "PHP/addFavorite.php",
                dataType: "html",
                type: 'POST',
                data: myJSON,
                success: function (data) {
                    alertify.alert("Update","Added to favorites");
                }
            });
        //if not, delete it from favorites
        } else {
            var room_id = document.getElementById("room_id").getAttribute("value");
            var obj = {"room_id": room_id};
            var myJSON = JSON.stringify(obj);
            $.ajax({
                url: "PHP/DeleteFavorite.php",
                dataType: "html",
                type: 'POST',
                data: myJSON,
                success: function (data) {
                    alertify.alert("Update","Removed from favorites");
                }
            });
        }
    });
});