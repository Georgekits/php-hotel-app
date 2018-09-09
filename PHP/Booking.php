<html>
<body>

<?php
    //Connect to database
    include_once('db_connection.php');

    $str_json = file_get_contents('php://input');
    //Decoding received JSON to array
    $response = json_decode($str_json,true); 
    //Get values
    $currTmp = $response['currTmp'];
    $checkIn = $response['checkIn'];
    $checkOut = $response['checkOut'];
    $room_id = $response['room_id'];
    //Insert room into database
    $sql =  "INSERT INTO bookings (check_in_date, check_out_date,date_created,user_id,room_id) VALUES ('$checkIn','$checkOut','$currTmp','1',$room_id)";
    $result = $conn->query($sql);
    
    if ($result === FALSE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $conn->close();
?>
</body>
</html>