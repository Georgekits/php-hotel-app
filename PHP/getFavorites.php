<html>
<body>

<?php
    //Connect to database
    include_once('db_connection.php');

    $str_json = file_get_contents('php://input');
    
    $sql =  "SELECT * FROM favorites";
	$result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        //Output data of each row
        $counter = 0;
        while($row = $result->fetch_assoc()) {
            $sql1 =  'SELECT * FROM room WHERE room_id='.$row["room_id"].'';
            $result1 = $conn->query($sql1);
            while($row1 = $result1->fetch_assoc()) {
                if($row["status"]==1) {    
                    $counter++;   ?>
                    <h6><?php echo $counter.". ".$row1["name"];?></h6>
                <?php
                }
            }
        }   
    } else {
        echo "<h6>Nothing fetched</h6>";
    }
    $conn->close();
?>

</body>
</html>