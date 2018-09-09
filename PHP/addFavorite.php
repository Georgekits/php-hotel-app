<html>
<body>

<?php
    //Connect to database
    include_once('db_connection.php');
    $str_json = file_get_contents('php://input');
    //Decoding received JSON to array
    $response = json_decode($str_json,true); 
    //Get values
    $room_id = $response['room_id'];
    $currTmp = $response['currTmp'];
    
    $sql =  "SELECT * FROM favorites WHERE room_id=$room_id";
	$result = $conn->query($sql);
    //if this room exists to favorites update status
    if ($result->num_rows > 0) {        
        while($row = $result->fetch_assoc()) {
            if($row["status"]==1) {
                $tsql =  "UPDATE favorites
                SET status = 0
                WHERE room_id=$room_id";
                if ($conn->query($tsql) === TRUE) {
                }
                $conn->close();  
            } else {
                $tsql =  "UPDATE favorites
                SET status = 1
                WHERE room_id=$room_id";
                if ($conn->query($tsql) === TRUE) {
                }
                $conn->close();  
            }
        }
        $conn->close();  
    //If not, add it to favorites
    } else {
        $tsql =  "INSERT INTO favorites (date_created,status,user_id,room_id) VALUES ('$currTmp',1,1,$room_id)";
        if ($conn->query($tsql) === TRUE) {
            $conn->close();  
        } else {
            echo "err";
        }
    }
?>

</body>
</html>