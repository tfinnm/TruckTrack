<?php
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');
include("db.php");
session_start();
$conn = new mysqli($db_server, $db_user, $db_password, $db_db);
if ($conn->connect_error) {
	// connection failed error goes here
}
$out = "";

$sql = "SELECT * FROM trucks";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		$out .= "<div style='margin:10%; outline: 1px solid black;'><h5>".$row["Name"]."</h5><p>Status: ".$row["status"]."</p></div>";
	}
}
if (!isset($_SESSION["list"]) or $_SESSION["list"] == null or $_SESSION["list"] != crc32($out)) {
	$_SESSION["list"] = crc32($out);
	echo "data: ".$out." \n\n";
	flush();
}
$conn->close();
?>