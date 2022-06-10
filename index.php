<DOCTYPE html>
<html>
	<head>
		<title>Halo</title>
	</head>
	<body>
	<a href="phpinfo.php">PHP info</a>
	
	<?php
	$host 		= "192.168.16.2"; // ip address get from docker network, check ip address via "docker inspect <your_mysql_server_container>"
	$username 	= "hello";
	$password 	= "h3LL0";
	$dbname 	= "hello";

	// Create connection
	$conn = new mysqli($host, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}
	
	// Create table
	$createTableSQL = "CREATE TABLE IF NOT EXISTS hello(id INT PRIMARY KEY AUTO_INCREMENT, hello VARCHAR(50) NULL)";
	$createTable = $conn->query($createTableSQL);
	
	// Insert table 
	$insert = $conn->query("INSERT INTO hello VALUES (NULL, 'This is inserted at ".date('Y-m-d H:i:s')."')");

	$sql = "SELECT * FROM hello";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	  // output data of each row
	  while($row = $result->fetch_assoc()) {
		echo "<p>".$row["hello"]. "</p>";
	  }
	} else {
	  echo "0 results";
	}
	$conn->close();
	?>
	</body>
</html>