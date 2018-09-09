<html>
<body>

<?php
    //Connect to Database
    include_once('db_connection.php');

    $str_json = file_get_contents('php://input'); 
    //Decoding received JSON to array
    $response = json_decode($str_json,true); 
	//Get values
    $room_id = $response['room_id'];
    //Detete room from favorites using room_id
    $sql =  "DELETE FROM favorites WHERE room_id=$room_id";
    $result = $conn->query($sql);
    
    if ($result === FALSE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $conn->close();
?>
</body>
</html>