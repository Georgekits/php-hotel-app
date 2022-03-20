<html>
<body>

<?php
    //Database server IP
	$host = 'portfoliogeorge.mysql.database.azure.com';
	//Database name
	$db_name = 'hotels-com';
	//Database username
	$username = 'george@portfoliogeorge';
	//Database password
	$password = 'portfolioProject!';
	
	//Establishes the connection
	$conn = mysqli_init();
	mysqli_real_connect($conn, $host, $username, $password, $db_name, 3306);
	if (mysqli_connect_errno($conn)) {
		die('Failed to connect to MySQL: '.mysqli_connect_error());
	}
?>
</body>
</html>