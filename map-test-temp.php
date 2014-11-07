<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
    <script>
	var geocoder;
	var map;

	function codeAddress() {
		geocoder = new google.maps.Geocoder();
		var latlng = new google.maps.LatLng(39.174208, -84.481842);
		var mapOptions = {
			zoom: 11,
			center: latlng
		}
		map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
		geocoder.geocode( { 'address': address1}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				var marker = new google.maps.Marker({
					map: map,
					position: results[0].geometry.location,
					title: results[0].formatted_address
				});
			}
			else {
				alert("Geocode was not successful for the following reason: " + status);
			}
		});
	
	
		geocoder.geocode( { 'address': address2}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				var marker = new google.maps.Marker({
					map: map,
					position: results[0].geometry.location,
					title: results[0].formatted_address
				});
			}
			else {
				alert("Geocode was not successful for the following reason: " + status);
			}
		});
		
		geocoder.geocode( { 'address': address3}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				var marker = new google.maps.Marker({
					map: map,
					position: results[0].geometry.location,
					title: results[0].formatted_address
				});
			}
			else {
				alert("Geocode was not successful for the following reason: " + status);
			}
		});
		
		geocoder.geocode( { 'address': address4}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				var marker = new google.maps.Marker({
					map: map,
					position: results[0].geometry.location,
					title: results[0].formatted_address
				});
			}
			else {
				alert("Geocode was not successful for the following reason: " + status);
			}
		});
		
		map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
		geocoder.geocode( { 'address': address5}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				var marker = new google.maps.Marker({
					map: map,
					position: results[0].geometry.location,
					title: results[0].formatted_address
				});
			}
			else {
				alert("Geocode was not successful for the following reason: " + status);
			}
		});
	
	
		geocoder.geocode( { 'address': address6}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				var marker = new google.maps.Marker({
					map: map,
					position: results[0].geometry.location,
					title: results[0].formatted_address
				});
			}
			else {
				alert("Geocode was not successful for the following reason: " + status);
			}
		});
		
		geocoder.geocode( { 'address': address7}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				var marker = new google.maps.Marker({
					map: map,
					position: results[0].geometry.location,
					title: results[0].formatted_address
				});
			}
			else {
				alert("Geocode was not successful for the following reason: " + status);
			}
		});
		
		geocoder.geocode( { 'address': address8}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				var marker = new google.maps.Marker({
					map: map,
					position: results[0].geometry.location,
					title: results[0].formatted_address
				});
			}
			else {
				alert("Geocode was not successful for the following reason: " + status);
			}
		});
		
		geocoder.geocode( { 'address': address9}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				var marker = new google.maps.Marker({
					map: map,
					position: results[0].geometry.location,
					title: results[0].formatted_address
				});
			}
			else {
				alert("Geocode was not successful for the following reason: " + status);
			}
		});
		
		geocoder.geocode( { 'address': address10}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				var marker = new google.maps.Marker({
					map: map,
					position: results[0].geometry.location,
					title: results[0].formatted_address
				});
			}
			else {
				alert("Geocode was not successful for the following reason: " + status);
			}
		});
	}
	
	
</script>
</head>
<body>
 <?php
	//Include Functions
	include ('../includes/dbCon.php');
	echo "Page Header Stuff<br><br>";
	$query= "SELECT concat(prop_addr1, ', Cincinnati, OH') as addr from file_lst where city='cincinnati'  and file_num not like 'train%' limit 25";
	$result = mysql_query($query, $con);
	echo "<div>";
	$i=0;
	$top10Addys = array();
	while ($row = mysql_fetch_assoc($result)) {
		echo $row['addr']."<br>";
		if($i<10) {
			$top10Addys[$i]=htmlentities($row['addr']);
			$i++;
		}
	}
?>
<script>
	var address1 = <?php echo(json_encode($top10Addys[0])); ?>;
	var address2 = <?php echo(json_encode($top10Addys[1])); ?>;
	var address3 = <?php echo(json_encode($top10Addys[2])); ?>;
	var address4 = <?php echo(json_encode($top10Addys[3])); ?>;
	var address5 = <?php echo(json_encode($top10Addys[4])); ?>;
	var address6 = <?php echo(json_encode($top10Addys[5])); ?>;
	var address7 = <?php echo(json_encode($top10Addys[6])); ?>;
	var address8 = <?php echo(json_encode($top10Addys[7])); ?>;
	var address9 = <?php echo(json_encode($top10Addys[8])); ?>;
	var address10 = <?php echo(json_encode($top10Addys[9])); ?>;
</script>


<input type="button" value="Map Top 10 Addresses" onclick="codeAddress()">
</div>
<div id="map-canvas" style="width: 680px; height: 480px;"></div>
</body>
</html>