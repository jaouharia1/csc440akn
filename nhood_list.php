<?php
	echo "<hr><h1>Neighborhoods</h1><hr>";
	
	include "dbCon.php";
	
	//Initial Query for the results
	$query = "SELECT * FROM nhood WHERE 1=1 ";
	
	$NhoodResult = mysqli_query($link, $query);
	
	echo "<form method=\"post\" action=\"index.php?pgNum=4\" width=100%>";
	//Neighborhood Filter
	echo "<td>Neighborhood: </td>";
	echo "<td><select name=\"nhood\" type=\"text\" id=\"nhood\">";
	echo '<option value="">Choose A Neighborhood</option>';
		while ($row = mysqli_fetch_assoc($NhoodResult)) {
				echo '<option value="'.$row['nhood_id'].'">'.$row['name'].'</option>';
		}
	echo "</select>";
	echo "</td>";
	
	echo '</select><input type="submit" value="Filter" /></form>';
	
	//Post results from the form top a variable
	if(isset($_POST['nhood'])) $nhood=$_POST['nhood'];
	
	
	if($nhood!=NULL){
		$query=$query." AND nhood_id=$nhood ";
		$result = mysqli_query($link, $query);
		while ($row = mysqli_fetch_assoc($result)) {
			echo "<h1>".$row['name']."</h1>";
			echo "<p>Perimeter: ".$row['perimeter']."</p>";
			echo "<p>Area: ".$row['area']."</p>";
			echo "<p>Acerage: ".$row['acres']."</p>";
			echo "<p>Number of Vacant Properties: ";
			
			$vpQuery="SELECT COUNT(v.parcel) as cnt FROM vp_list v
				JOIN address a ON v.parcel=a.parcel
				WHERE a.nhood_id=$nhood ";
			
			$vpResult = mysqli_query($link, $vpQuery);
			while ($row = mysqli_fetch_assoc($vpResult)) {
				echo $row['cnt'];
			}
			echo "</p>";
			
			
		}
	}
?>
