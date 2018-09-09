<html>
<body>

<?php
    //Connect to database
    include_once('db_connection.php');

    $str_json = file_get_contents('php://input');
    //Decoding received JSON to array
    $response = json_decode($str_json,true); 
	//Get Values
    $room_id = $response['room_id'];
    //Delete room from bookings using room_id
    $sql =  "DELETE FROM bookings WHERE room_id=$room_id";
    $result = $conn->query($sql);
    
    if ($result === FALSE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
?>
</body>
</html>