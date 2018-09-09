<html>
<body>

<?php
    //Connect to database
    include_once('db_connection.php');

    $str_json = file_get_contents('php://input');
    //Decoding received JSON to array
    $response = json_decode($str_json,true); 
	//Get values
    $city = $response['city'];
    $roomType = $response['roomType'];  
    $countOfGuests = $response['countOfGuests'];  
    $min = $response['min'];
    $max = $response['max'];
    //Concatenate sql string considering users inputs
    $sql = "SELECT * FROM room";
    if($city!=="" || $countOfGuests !=="" || $roomType!=="") {
        $sql = "SELECT * FROM room WHERE";
    }
    if($city!=="" && $countOfGuests !=="" && $roomType!=="") {
        $sql =  $sql.  " room_type=$roomType AND city='$city' AND count_of_guests=$countOfGuests AND price BETWEEN $min AND $max";
    } else if ($city !== "" &&  $countOfGuests !=="") {
        $sql = $sql . " city='$city' AND count_of_guests=$countOfGuests AND price BETWEEN $min AND $max";
    } else if ($city !== "" &&  $roomType !=="") {
        $sql = $sql . " city='$city' AND room_type=$roomType AND price BETWEEN $min AND $max";
    } else if ($roomType!=="" && $countOfGuests!=="") {
        $sql =  $sql.  " room_type=$roomType AND count_of_guests=$countOfGuests AND price BETWEEN $min AND $max";
    } else if ($city!=="") {
        $sql = $sql . " city='$city' AND price BETWEEN $min AND $max";
    } else if ($roomType!=="") {
        $sql =  $sql.  " room_type=$roomType AND price BETWEEN $min AND $max";        
    } else if ($countOfGuests!=="") {
        $sql =  $sql.  " count_of_guests=$countOfGuests AND price BETWEEN $min AND $max";
    } else {
        $sql = $sql. " WHERE price BETWEEN $min AND $max";
    }

    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
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
            <!--Container with room's information-->
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
                            <button class="btn btn-danger goToRoom" onclick="goToRoom('<?php echo $row["name"];?>')">Go to Room</button>
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
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <p>Count of Guests: <?php echo $row["count_of_guests"];?></p>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <p>Type of Room: <?php echo $row["room_type"];?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
        }
    } else {
        ?>
        <script>
            alertify.alert("Update","There are no hotels with such filters");
        </script>
        <?php
    }
    $conn->close();
?>

</body>
</html>