<html>
<body>

<?php
    //HUA DATABASE
    $conn = mysqli_connect("83.212.105.20", "it21520", "m%92m07h","it21520") or die (mysql_error());
    //Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>
</body>
</html>