<link rel="stylesheet" href="libraries/bootstrap-3.4.1-dist/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="libraries/bootstrap-3.4.1-dist/js/bootstrap.min.js"></script>
<link rel='stylesheet' href='libraries/leaflet/leaflet.css'/>
<script src='libraries/leaflet/leaflet.js'></script>
<link rel='stylesheet' href='libraries\leaflet-pulsingicon/L.Icon.Pulse.min.css'/>
<script src='libraries\leaflet-pulsingicon/L.Icon.Pulse.min.js'></script>
<div>
	<div style='height: 100%' class='col-sm-9' id='truckmap'></div>
	<div style='height: 100%' class='col-sm-3'>
		<center>
			<h1>TruckTrack</h1><h3>Operations Center Client</h3><br>
			<div style="margin:10%; outline: 1px solid black;"><h5>A-59-39</h5><p>Status: Normal</p></div>
			<div style="margin:10%; outline: 1px solid black;"><h5>E-39-22</h5><p>Status: Break Down</p></div>
		</center>
	</div>
</div>
<script>
	var mymap = L.map('truckmap').setView(new L.LatLng(0, 0), 4);
	L.control.scale().addTo(mymap);
	L.tileLayer('https://{s}.tile.osm.org/{z}/{x}/{y}.png', {attribution: 'Tiles &copy; Open Street Map'}).addTo(mymap);
	var markerGroup = L.layerGroup().addTo(mymap);
	L.marker([0, 0]).addTo(mymap);						
</script>