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
		$status = $row["status"];
		$mapColor = "";
		if ($status == "reststop") {
			$mapColor = "blue";
		} elseif ($status == "traffic") {
			$mapColor = "yellow";
		} elseif ($status == "breakdown") {
			$mapColor = "red";
		} else {
			$mapColor = "green";
		}
		if ($status == "breakdown") {
			$out .= "L.marker([".$row["Lat"].", ".$row["Lon"]."], {icon: L.icon.pulse({iconSize:[10,10],fillColor:'".$mapColor."',animate:true,color:'".$mapColor."'})}).bindTooltip('".$row["Name"]."<br>".$row["status"]."',{permanent: true}).addTo(markerGroup);";
		} else {
			$out .= "L.marker([".$row["Lat"].", ".$row["Lon"]."], {icon: L.icon.pulse({iconSize:[10,10],fillColor:'".$mapColor."',animate: false,color:'".$mapColor."'})}).bindTooltip('".$row["Name"]."<br>".$row["status"]."',{permanent: true}).addTo(markerGroup);";
		}
	}
}
if ($_SESSION["map"] == null or $_SESSION["map"] != crc32($out)) {
	$_SESSION["map"] = crc32($out);
	echo "data: ".$out." \n\n";
	flush();
}
$conn->close();
?>