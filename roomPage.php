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
    <title>Hotels.com: <?php echo $_GET["name"]?></title>
    <!--Google Font-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <!--BootStrap-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!--Home-Profile-Hotel Icon-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--CSS File-->
    <link rel="stylesheet" type="text/css" media="screen" href="CSS/roomPageStyle.css"/>
    <link rel="stylesheet" href="CSS/alertify-css/alertify.min.css">
    <link rel="stylesheet" href="CSS/alertify-css/themes/default.min.css">
    <!--jQuery Links-->
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!--Javascript File-->
    <script src="JS/roomPage.js"></script>
</head>

<body>
    <!--HeaderMenu-->
    <?php include 'HTML/header.html'?>

    <?php
        //Get values from URL
        $name = $_GET["name"];
        $checkIn = $_GET["checkIn"];
        $checkOut = $_GET["checkOut"];
        //Connect to Database
        include 'PHP/db_connection.php';

        $sql =  "SELECT * FROM room WHERE name='$name'";
        $result = $conn->query($sql);

        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                //Checks if this room have been reviewed
                $sql1 = 'SELECT * FROM reviews WHERE room_id='.$row["room_id"].'';
                $result1 = $conn->query($sql1);
                if ($result1->num_rows > 0) {
                    while($row1 = $result1->fetch_assoc()) {
                        $rate = $row1["rate"];
                    }
                } else {
                    $rate=0;    
                }
                //Checks if this room have been added to favorites
                $sql2 = 'SELECT * FROM favorites WHERE room_id='.$row["room_id"].'';
                $result2 = $conn->query($sql2);
                if ($result2->num_rows > 0) {
                    while($row2 = $result2->fetch_assoc()) {
                        $status = $row2["status"];
                    }
                    ?>
                    <div id="status" value="<?php echo $status;?>"></div>
                    <?php
                } else {
                    $status = 0;?>
                    <div id="status" value="<?php echo $status;?>"></div>
                    <?php
                }

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
                }
                if($row["pet_friendly"]) {
                    $pet_friendly = "";
                } else {
                    $pet_friendly = "NOT";
                }
                //Checks if this room have been booked
                $sqlBook = 'SELECT * FROM bookings WHERE room_id='.$row["room_id"].'';
                $result1 = $conn->query($sqlBook);
                if($result1->num_rows > 0){
                    $buttonValue = "Already Booked";
                } else {
                    $buttonValue = "Book Now";                    
                }
                ?>
                <!--Container with room's information-->
                <div class="container" id="mainBody">
            
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="Headerinformation">
                                <p class="leftHeaderText"><?php echo $row["name"]." - ".$row["city"].", ".$row["area"];?>
                                | Reviews: 
                                <?php 
                                if($rate!==0){ 
                                    for ($i = 0; $i < $rate ; $i++) { ?>
                                        <i class="fa fa-star"></i>
                                    <?php 
                                    } 
                                }   ?>
                                | <input type="checkBox" id="heart" name="favortie" value="On"/>
                                <label class="full" for="heart" title="Favorite"></label></p>
                                <p class="rightHeaderText">Per night: <?php echo $row["price"] ;?>€</p>
                            </div>
                        </div>
                    </div>
            
                    <div class="row">
                        <div class="col-lg-12">
                            <img src="images/rooms/<?php echo $row["photo"];?>" alt="room-image-here">
                        </div>
                    </div>
            
                    <div class="row">
                        <div class="col-lg-12">
                            <nav id="info">
                            <ul class="information">
                                <li class="infoi">
                                    <p class="infoText"><i class="fa fa-user" aria-hidden="true"></i> <?php echo $row["count_of_guests"];?> Count of guests</p>
                                </li>
                                <li class="infoi">
                                    <p class="infoText"><i class="fa fa-hotel" aria-hidden="true"></i> <?php echo $row["room_type"];?></p>
                                </li>
                                <li class="infoi">
                                    <p class="infoText"><i class="fa fa-car" aria-hidden="true"></i> <?php echo $row["parking"];?> Parking</p>
                                </li>
                                <li class="infoi">
                                    <p class="infoText"><i class="fa fa-wifi" aria-hidden="true"></i> WIFI: Yes</p>
                                </li>
                                <li class="infoi">
                                    <p class="infoText"><i class="fa fa-paw" aria-hidden="true"></i> <?php echo $pet_friendly;?> PET FRIENDLY</p>
                                </li>
                            </ul>
                            <!-- <hr> -->
                            </nav>                              
                        </div>
                    </div>
            
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="description">
                                <h5>Room Description</h5>
                                <p><?php echo $row["long_description"];?></p>
                            </div>
                        </div>
                    </div>
                
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="state">
                                <input type="Submit" value="<?php echo $buttonValue;?>" onclick="checkButton('<?php echo $checkIn;?>', '<?php echo $checkOut;?>', '<?php echo $row["room_id"];?>')" class="btn btn-danger" id="bookButton" style="float: right;">
                            </div>
                        </div>
                    </div>
                
                    <!-- Map  -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="lat" value="<?php echo $row["lat_location"];?>"></div>
                            <div id="long" value="<?php echo $row["lng_location"]?>"></div>                            
                            <div class="myMap" id="map"></div>
                        </div>
                    </div>
                    <hr id="ReviewHr">
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="description">
                                <h5>Add Review</h5>
                                <form action="Javascript:addReview('<?php echo $row["room_id"];?>')">
                                    <fieldset class="rating">
                                        <input type="radio" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
                                        <input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>  
                                        <input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
                                        <input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>    
                                        <input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>    
                                    </fieldset>
                                    <textarea id="reviewText" rows="4" placeholder="Review" required></textarea>
                                    <input type="submit" id="reviewButton" class="btn btn-danger" value="Submit" width="25%">
                                </form>    
                            </div>
                        </div>
                    </div>
                    
                    <div id="room_id" value="<?php echo $row["room_id"];?>"></div>
                    
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="description">
                                <h5>Reviews</h5>  
                                <div id="reviews">
                                    <?php
                                    $sql = 'SELECT * FROM reviews WHERE room_id='.$row["room_id"].'';
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        // output data of each row
                                        $reviewCounter = 0;
                                        while($row = $result->fetch_assoc()) {
                                            $reviewCounter++;
                                            ?>
                                            <div class="row" id="listReviews">
                                                <div class="col-lg-12">
                                                    <h5><?php echo $reviewCounter;?> - user_default1 
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
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               <?php              
            }
        } else {
            echo "err";
        }
    ?>
    <!--Footer-->
    <?php include 'HTML/footer.html'?>
    <!--JavaScript Scripts-->
    <script>
        //Google Maps Initialization
        function initMap() {
            var lat = document.getElementById("lat").getAttribute("value");
            var lon = document.getElementById("long").getAttribute("value");
            
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 15,
                center: new google.maps.LatLng(lat, lon)
            });

            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(lat, lon),
                map: map
            });
        }
    </script>
    <!--Google Maps-->
    <script async defer 
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB0ZpTUel4-sHesOIooPTlQEChPTTyPUKM&callback=initMap">
    </script>
    <!--jQuery Bundle-->
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="JS/alertify.js"></script>    
</body>

</html>