<?php
require("db.php");
if (isset($_POST["truck"]) && isset($_POST["lat"]) && isset($_POST["lon"])) {
	$conn = new mysqli($db_server, $db_user, $db_password, $db_db);
	if ($conn->connect_error) {
		echo "Conn Error";
	} 
	$sql = "UPDATE trucks SET lat = '".$_POST["lat"]."', lon = '".$_POST["lon"]."' WHERE UTID = ".$_POST["truck"];
	if ($conn->query($sql) === TRUE) {
		echo "200: Good";
	} else {
		echo $conn->error;
	}
	$conn->close();
}
?>