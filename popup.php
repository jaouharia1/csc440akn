<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
    <script>
	var geocoder;
	var map;
	var index;
	
	function codeAddress(num) {
		var addrList = window.opener.addrList;
		geocoder = new google.maps.Geocoder();
		var latlng = new google.maps.LatLng(39.174208, -84.481842);
		var mapOptions = {
			zoom: 11,
			center: latlng
		}
		map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
		
		//Map up to the number that the user requested or the length of the address array
		for	(index = 0; index < addrList.length-1 && index <= num-1; index++) {
			geocoder.geocode( { 'address': addrList[index]}, function(results, status) {
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
	}
	
	
</script>
</head>
<?php
//Determine how many the user wanted to map
$num = $_GET['num'];
echo "<body onload=\"codeAddress($num)\">"
?>
	<div id="map-canvas" style="width: 680px; height: 480px;"></div>
</body>
</html>