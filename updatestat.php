<?php
require("db.php");
if (isset($_POST["truck"]) && isset($_POST["status"])) {
	$conn = new mysqli($db_server, $db_user, $db_password, $db_db);
	$sql = "UPDATE trucks SET status = '".$_POST["status"]."' WHERE UTID = ".$_POST["truck"];
	$conn->query($sql);
	$conn->close();
}
?>