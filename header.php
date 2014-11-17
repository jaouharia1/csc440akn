<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
	<head>
		<title>City of Cincinnati</title>
		<link href="favicon.ico" rel="icon" type="images/x-icon" />
		<meta http-equiv="Content-Type" content="text/html"; charset="utf-8" />
		<style>

		a:link { color: #00BCE4;
				text-decoration: none;}
		a:visited { color: #00457C;
					text-decoration: none;}
		a:hover { color: #CCCCCC;
					font-weight: bold;
					text-decoration: none;}
		
		
		.right { text-align: right;
				color: #00457C;
		}
		.title { text-align: left;
				color: #00457C;
				font-size: 30px;
				font-weight: bold;
		}
		.mainLogo {
			font-family: "arial", sans-serif;
			font-size: 80px;	
		}
		.odcText {
			font-family: "arial", sans-serif;
			font-size: 15px;
			color: #00457C;
		}
		div.padded {  
			padding-top: 50px;  
			padding-right: 100px;  
			padding-bottom: 20px;  
			padding-left: 100px;  
		}
		body {
			background-image: url("images/swirl.jpg");
			background-position: center top; 
		}
		
		
		</style>
		<script src="http://maps.google.com/maps/api/js?sensor=true"></script>
		<script>
			var geocoder;
			var map;
			var index;
		
			function codeAddress() {
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
<body>

<table width=100%>
	<tr>
		<td><a href="index.php?pgNum=1"><img src="images/sr.png" alt="Service Requests"/></a></td>
		<td><a href="index.php?pgNum=3"><img src="images/vp.png" alt="Vacant Properties"/></a></td>
		<td><a href="index.php?pgNum=4"><img src="images/nhood.png" alt="Neighborhoods"/></a></td>
		<td><a href="index.php?pgNum=5"><img src="images/search.png" alt="Address Search"/></a></td>
		<td><a href="index.php"><img src="images/city_logo.png" alt="City of Cincinnati" align="right" /></a></td>
	</tr>
</table>
<?php
?>