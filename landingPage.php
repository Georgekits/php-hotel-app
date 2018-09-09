<!DOCTYPE <!DOCTYPE html>
<html lang="en">

<head>
    <!--Favicon-->
    <link rel="shortcut icon" type="image/png" href="images/favicon/favicon.jpg" />
    <!--METADATA-->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--Title-->
    <title>Hotels.com</title>
    <!--BootStrap-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!--CSS File-->
    <link rel="stylesheet" type="text/css" href="CSS\landingPageStyle.css">
    <!--Google Font-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <!--Home Icon-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--jQuery Links-->
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!--Javascript File-->
    <script src="JS/landingPage.js"></script>
</head>

<body>
    <!--Header-->
    <?php include 'HTML/Landingheader.html'?> 
    <!--Container div-->
    <div class="masthead text-center d-flex flex-column justify-content-center text-align-center">
        <form action="listPage.php" method="POST">
            <div class="container">
                <!-- Select Row -->
                <div class="row">
                    <div class="col-lg-6">
                        <select id="city" name="city">
                            <option value="">City</option>
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
                    </div>
                    <div class="col-lg-6">
                        <select id="roomType" name="roomType">
                            <option value="">Room Type</option>
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
                    </div>
                </div>
                <!-- Datepicker Row -->
                <div class="row">
                    <div class="col-lg-6">
                        <input type="text" name="checkIn" class="datepickerIn" placeholder="Check-in Date" readonly>
                    </div>
                    <div class="col-lg-6">
                        <input type="text" name="checkOut" class="datepickerOut" placeholder="Check-out Date" readonly>
                    </div>
                </div>
                <!-- Button Row -->
                <div class="row">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4">
                        <input type="submit" class="btn" value="Search">
                    </div>
                    <div class="col-sm-4"></div>
                </div>
            </div>
        </form>
    </div>
    <!--Footer-->
    <?php include 'HTML/footer.html'?>
</body>

</html>