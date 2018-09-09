<!DOCTYPE <!DOCTYPE html>
<html>

<head>
    <!--Favicon-->
    <link rel="shortcut icon" type="image/png" href="images/favicon/favicon.jpg" />
    <!--MetaData-->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--Title-->
    <title>Hotels.com: Hotel List</title>
    <!--Google Font-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <!--BootStrap-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!--Home-Profile-Hotel Icon-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--CSS File-->
    <link rel="stylesheet" type="text/css" href="CSS/listPageStyle.css" />
    <link rel="stylesheet" href="CSS/alertify-css/alertify.min.css">
    <link rel="stylesheet" href="CSS/alertify-css/themes/default.min.css">
    <!--jQuery Links-->
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!--Javascript File-->
    <script src="JS/listPage.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Roboto:100,400,300,500,700' rel='stylesheet' type='text/css'>
</head>

<body>
   <!--HeaderMenu-->
   <?php include 'HTML/header.html'?>
    <!--Container Div-->
    <div class="container">
        <div class="row">
            <!-- Left Navigation Bar -->
            <div class="col-lg-3" id="filterNav">
                <h5 style="text-align: center">FIND THE PERFECT HOTEL</h5>
                <select id="countOfGuests">
                    <option value="">Count of guests</opiton>
                    <?php 
                    include_once('PHP/db_connection.php');
                    $sql =  'SELECT DISTINCT count_of_guests FROM room';
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                    ?>
                    <option value="<?php echo $row["count_of_guests"];?>"><?php echo $row["count_of_guests"];?></option>
                    <?php 
                        }
                    }
                    ?>
                </select>
                <select id="city">
                <option value="">City</opiton>
                <?php 
                    include_once('PHP/db_connection.php');
                    $sql =  'SELECT DISTINCT city FROM room';
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                    ?>
                    <option value="<?php echo $row["city"];?>"><?php echo $row["city"];?></option>
                    <?php 
                        }
                    }
                    ?>
                </select>
                <select id="roomType">
                    <option value="">Room Type</opiton>
                    <?php 
                        include_once('PHP/db_connection.php');
                        $sql =  'SELECT * FROM room_type';
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                        ?>
                        <option value="<?php echo $row["id"];?>"><?php echo $row["room_type"];?></option>
                        <?php 
                            }
                        }
                        ?>
                </select>
                <div class="row">
                    <div class="col-lg-6">
                        <input type="text" id="min" readonly> 
                    </div>
                    <div class="col-lg-6">
                        <input type="text" id="max" readonly>
                    </div>
                </div>
                <div id="slider"></div>

                <div class="row">
                    <div class="col-lg-6">
                        <input type="text" readonly style="border:0;font-size:0.9em" placeholder="PRICE MIN." readonly> 
                    </div>
                    <div class="col-lg-6">
                        <input type="text" readonly style="border:0;font-size:0.9em" placeholder="PRICE MAX." readonly> 
                    </div>
                </div>

                <input id="checkIn" type="text" class="datepickerIn" placeholder="Check-in Date" readonly
                value="<?php if (isset($_POST["checkIn"])) {
                    echo $_POST['checkIn'];
                } 
                ?>">
                <input id="checkOut" type="text" class="datepickerOut" placeholder="Check-out Date" readonly
                value="<?php if (isset($_POST["checkOut"])) {
                    echo $_POST['checkOut'];
                } 
                ?>">
            </div>
            <!-- Search Body -->
            <div class="col-lg-9" id="resultBody">
                <div class="bookingHeading">
                    <h5>Search Results</h5>
                </div>
                <!-- RESULTS HERE -->
                <div id="result">
                <?php  
                // Connect to database
                include_once('PHP/db_connection.php');
                
                if(isset($_POST["city"]) && $_POST["city"]!== "") {
                    $city = $_POST["city"];
                    if(isset($_POST["roomType"]) && $_POST["roomType"] !== "") {
                        $roomType= $_POST["roomType"];
                        $sql =  "SELECT * FROM room WHERE city='$city' AND room_type=$roomType";
                    } else {
                        $sql =  "SELECT * FROM room WHERE city='$city'"; 
                    }
                } else if(isset($_POST["roomType"]) && $_POST["roomType"] !== "") {
                    $roomType= $_POST["roomType"];
                    $sql =  "SELECT * FROM room WHERE room_type=$roomType";                  
                } else {
                    $sql = 'SELECT * FROM room';
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
                        } ?>
                        <!-- Container with room's information -->
                        <div class="container resultItem style_prevu_kit">
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
                                    <button class="btn" onclick="goToRoom('<?php echo $row["name"];?>')">Go to Room</button>
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
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                <p>Count of Guests: <?php echo $row["count_of_guests"];?></p>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                <p id="typeOfroom">Type of Room: <?php echo $row["room_type"];?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "<h5>Nothing Fetched!</h5>";
                }
                $conn->close();
                ?>
                </div>

            </div>
        </div>
    </div>
    <!--Footer-->
    <?php include 'HTML/footer.html'?>
    <!--jQuery Bundle-->
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="JS/alertify.js"></script>
</body>

</html>