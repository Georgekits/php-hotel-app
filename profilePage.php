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
    <title>Hotels.com: Profile</title>
    <!--Google Font-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <!--BootStrap-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!--CSS Link-->
    <link rel="stylesheet" type="text/css" media="screen" href="CSS/profilePageStyle.css"/>
    <!--Home-Profile-Hotel Icon-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--jQuery Links-->
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!--Javascript File-->
    <script src="JS/profilePage.js"></script>
</head>

<body>
    <!--HeaderMenu-->
    <?php include 'HTML/header.html'?>

    <!--Container Div-->
    <div class="container">
        <div class="row">
            <!--Left Bar-->
            <div class="col-lg-3" id="leftNav">
                <h5 id="leftNavHeading">Favorites <i class="fa fa-heart" style="color:red"></i></h5>
                <div id="favoriteResults"></div>
                <h5 id="leftNavHeading">Reviews <i class="fa fa-star" style="color:rgb(250, 250, 81)"></i></h5>
                <div id="reviewResults"></div>
            </div>
            <!--Bookings Tag-->
            <div class="col-lg-9" id="resultBody">
                <div class="bookingHeading">
                    <h5>My Bookings</h5>
                </div>
                <!-- RESULTS HERE -->
                <div class="results">
                    <div id="result"></div>
                </div>
            </div>
        </div>

    </div>
    <!--Footer-->
    <?php include 'HTML/footer.html'?>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>