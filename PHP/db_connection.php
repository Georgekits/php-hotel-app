<html>
<body>

<?php
	//Database server IP
	$host = '';
	//Database name
	$db_name = '';
	//Database username
	$username = '';
	//Database password
	$password = '!';
	
	//Establishes the connection
	$conn = mysqli_init();
	mysqli_real_connect($conn, $host, $username, $password, $db_name, 3306);
	if (mysqli_connect_errno($conn)) {
		die('Failed to connect to MySQL: '.mysqli_connect_error());
	}
?>
</body>
</html>
