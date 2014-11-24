<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
    <script>
	var geocoder;
	var map;
	var index;

	function codeAddress() {
		var addrList = window.opener.addrList;
		geocoder = new google.maps.Geocoder();
		var latlng = new google.maps.LatLng(39.174208, -84.481842);
		var mapOptions = {
			zoom: 11,
			center: latlng
		}
		map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
		
		for	(index = 0; index < addrList.length; index++) {
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
<body onload="codeAddress()">
	<div id="map-canvas" style="width: 680px; height: 480px;"></div>
</body>
</html>