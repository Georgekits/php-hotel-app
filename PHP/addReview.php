<html>
<body>

<?php
    //Connect to db
    include_once('db_connection.php');

    $str_json = file_get_contents('php://input');
    //Decoding received JSON to array
    $response = json_decode($str_json,true);
    //Get values
    $currTmp = $response['currTmp'];
    $text = $response['text'];
    $rate = $response['rate'];
    $room_id = $response['room_id'];

    $sql =  "SELECT * FROM reviews WHERE room_id=$room_id";
	$result = $conn->query($sql);
    //If a review exists in database
    if ($result->num_rows > 0) {
        echo "User-default-1 has already reviews this room";
    //If not, insert this review
    } else {
        $sql1 =  "INSERT INTO reviews (rate,text,date_created,user_id,room_id) VALUES ('$rate','$text','$currTmp','1',$room_id)";
        $result1 = $conn->query($sql1);
        if ($result1 === TRUE) { 
            //Review Results
            $sql2 =  "SELECT * FROM reviews WHERE room_id=$room_id";
            $result2 = $conn->query($sql2);
            if ($result2->num_rows > 0) {
                //Output data of each row
                $reviewCounter = 0;
                while($row = $result2->fetch_assoc()) {
                    $reviewCounter++;?>
                    <div class="row">
                        <div class="col-lg-12">
                            <h5>1.user_default1
                            <?php for ($i = 0; $i < $row["rate"] ; $i++) { ?>
                                <i class="fa fa-star"></i>
                            <?php } ?>
                            </h5>
                        </div>
                    </div>
                    <p><?php echo $row["text"];?></p>
                    <p><?php echo $row["date_created"];?></p>
                <?php
                }
            } 
            $conn->close();
        } else {
            echo "Error: " . $sql1 . "<br>" . $conn->error;
        }
        
    }
?>
</body>
</html>