<?php
	echo "<hr><h1>Neighborhoods</h1><hr>";
	
	include "dbCon.php";
	
	//Initial Query for the results
	$query = "SELECT * FROM nhood_list WHERE 1=1 ";
	
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
			echo "<p>Number of Vacant Properties By Type:</p>";
			$vp_tot=0;
			
			$vpQuery="SELECT COUNT(v.parcel) as cnt, vp_type FROM vp_list v
				JOIN address a ON v.parcel=a.parcel
				WHERE a.nhood_id=$nhood 
				group by vp_type";
			
			echo "<table>";
			$vpResult = mysqli_query($link, $vpQuery);
			while ($row = mysqli_fetch_assoc($vpResult)) {
				echo "<tr><td>";
				echo $row['vp_type']->getName();
				echo ": </td><td>";
				echo $row['cnt'];
				echo "</td></tr>";
				$vp_tot++;
			}
			echo "<tr><td>Total: </td><tr>$vp_tot</td></tr></table>";
			
			echo "<p>Number of Service Requests By Type:</p>";
			$sr_tot=0;
			
			$srQuery="SELECT COUNT(sr.parcel) as cnt, sr_type FROM sr_list sr
				JOIN address a ON sr.parcel=a.parcel
				WHERE sr.nhood_id=$nhood 
				group by sr_type";
			
			echo "<table>";
			$srResult = mysqli_query($link, $srQuery);
			while ($row = mysqli_fetch_assoc($srResult)) {
				echo "<tr><td>";
				echo $row['sr_type']->getName();
				echo ": </td><td>";
				echo $row['cnt'];
				echo "</td></tr>";
				$sr_tot++;
			}
			echo "<tr><td>Total: </td><tr>$sr_tot</td></tr></table>";
			
			
		}
	}
?>