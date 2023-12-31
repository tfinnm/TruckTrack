<?php
if (isset($_GET["t"])) {
	include("db.php");
	$conn = new mysqli($db_server, $db_user, $db_password, $db_db);
	if ($conn->connect_error) {
		// connection failed error goes here
	}
	$sql = "SELECT * FROM trucks WHERE UTID = '".$_GET["t"]."';";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
?> 
<link rel="stylesheet" href="libraries/bootstrap-3.4.1-dist/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="libraries/bootstrap-3.4.1-dist/js/bootstrap.min.js"></script>
<link rel='stylesheet' href='libraries/leaflet/leaflet.css'/>
<script src='libraries/leaflet/leaflet.js'></script>
<link rel='stylesheet' href='libraries\leaflet-pulsingicon/L.Icon.Pulse.min.css'/>
<script src='libraries\leaflet-pulsingicon/L.Icon.Pulse.min.js'></script>
<div>
	<div style='height: 100%' class='col-sm-3'>
		<center>
			<h1>TruckTrack</h1><h3>Field Client</h3><br>
			<button onClick="sendStatus('normal')" type="button" class="btn btn-success">Signal Normal/OK</button><br><br>
			<button onClick="sendStatus('reststop')" type="button" class="btn btn-primary">Signal Rest Stop</button><br><br>
			<button onClick="sendStatus('traffic')" type="button" class="btn btn-warning">Signal Heavy Traffic</button><br><br>
			<button onClick="sendStatus('breakdown')" type="button" class="btn btn-danger">Signal Breakdown</button><br><br>
			<p style="position: fixed; bottom: 10;">Reporting as: <?php echo $row["Name"]; ?></p>
		</center>
	</div>
	<div style='height: 100%' class='col-sm-9' id='truckmap'></div>
</div>
<script>
	var mymap = L.map('truckmap').setView(new L.LatLng(<?php echo $row["Lat"]; ?>, <?php echo $row["Lon"]; ?>), 4);
	L.control.scale().addTo(mymap);
	L.tileLayer('https://{s}.tile.osm.org/{z}/{x}/{y}.png', {attribution: 'Tiles &copy; Open Street Map'}).addTo(mymap);
	var markerGroup = L.layerGroup().addTo(mymap);

	options = {
		enableHighAccuracy: true,
		timeout: 5000,
		maximumAge: 0
	};
	navigator.geolocation.watchPosition((position) => {
		var ajax = new XMLHttpRequest();
		ajax.open('POST', 'sendloc.php');
		ajax.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		ajax.send('lat='+position.coords.latitude+'&lon='+position.coords.longitude+'&truck=<?php echo $_GET["t"]; ?>');
	}, (error) => {}, options);
	function sendStatus(status) {
		var ajax = new XMLHttpRequest();
		ajax.open('POST', 'updatestat.php');
		ajax.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		ajax.send('status='+status+'&truck=<?php echo $_GET["t"]; ?>');
	}
	if(typeof(EventSource) !== "undefined") {
	var sourcemap = new EventSource("updateMap.php");
	sourcemap.onmessage = function(event) {
		markerGroup.clearLayers();
		eval(event.data);
	};
}
</script>
<?php
	}
} else {
	echo "Truck Not Found";
}
} else {
	echo "Truck Not Specified";
}
?>