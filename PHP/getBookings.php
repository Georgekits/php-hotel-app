<html>
<body>

<?php
    //Connect to database
    include_once('db_connection.php');

    $str_json = file_get_contents('php://input');
	
    $sql =  "SELECT * FROM bookings";
	$result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        //Output data of each row
        while($row1 = $result->fetch_assoc()) {
            $checkIn = $row1["check_in_date"];
            $checkOut = $row1["check_out_date"];  

            $sql1 =  'SELECT * FROM room WHERE room_id='.$row1["room_id"].'';
            $result1 = $conn->query($sql1);
            while($row = $result1->fetch_assoc()) {
                if($row["room_type"]==1){
                    $row["room_type"] = "Single Room";
                }
                if($row["room_type"]==2){
                    $row["room_type"] = "Double Room";
                }
                if($row["room_type"]==3){
                    $row["room_type"] = "Triple Room";
                }   
                if($row["room_type"]==4){
                    $row["room_type"] = "Fourfold Room";
                }?>
                <!--Container with room information-->
                <div class="container resultItem">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                            <img src="images/rooms/<?php echo $row["photo"]?>">
                        </div>
                        
                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9" id="itemBody">
                            <h5><?php echo $row["name"]?></h5>
                            <h6><?php echo $row["city"].','.$row["area"];?></h6>
                            <p><?php echo $row["short_description"];?></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <button class="btn" onclick="goToRoom('<?php echo $checkIn;?>','<?php echo $checkOut;?>','<?php echo $row["name"];?>')">Go to Room</button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                            <div class="price">
                                <p>Per Night: <?php echo $row["price"];?>€</p>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                            <div class="info">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <p id="informationTag">Check-In:<?php echo $checkIn;?></p>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <p id="informationTag">Check-Out:<?php echo $checkOut;?></p>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <p id="informationTag">Room Type:<?php echo $row["room_type"];?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
    } else {
        echo "<h5>Nothing Fetched!</h5>";
    }
    $conn->close();
    ?>

</body>
</html>