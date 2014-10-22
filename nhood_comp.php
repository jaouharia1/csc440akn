<?php
	echo "<hr><h1>Neighborhood Comparisonnnnnnnnnn</h1><hr>";
	
	include "dbCon.php";
	
	//Initial Query for the results
	$query = "SELECT * FROM nhood_list WHERE 1=1 ";
	
	$NhoodResult1 = mysqli_query($link, $query);
	$NhoodResult2 = mysqli_query($link, $query);
	
	echo "<form method=\"post\" action=\"index.php?pgNum=6\">";
	//Neighborhood 1 Filter
	echo "<td width=10%>Neighborhood 1: </td>";
	echo "<td width=40%><select name=\"nhood1\" type=\"text\" id=\"nhood1\">";
	echo '<option value="">Choose A Neighborhood</option>';
		while ($row = mysqli_fetch_assoc($NhoodResult1)) {
				echo '<option value="'.$row['nhood_id'].'">'.$row['name'].'</option>';
		}
	echo "</select>";
	echo "</td>";
	
	//Neighborhood 2 Filter
	echo "<td width=10%>Neighborhood 2: </td>";
	echo "<td width=40%><select name=\"nhood2\" type=\"text\" id=\"nhood2\">";
	echo '<option value="">Choose A Neighborhood</option>';
		while ($row = mysqli_fetch_assoc($NhoodResult2)) {
				echo '<option value="'.$row['nhood_id'].'">'.$row['name'].'</option>';
		}
	echo "</select>";
	echo "</td>";
	
	echo '</select><input type="submit" value="Filter" /></form>';
	
	//Post results from the form top a variable
	if(isset($_POST['nhood1'])) $nhood1=$_POST['nhood1'];
	if(isset($_POST['nhood2'])) $nhood2=$_POST['nhood2'];
	
	if($nhood1!=NULL && $nhood2!=NULL){
		
		echo "<table width=100% border=1><tr><td width=50%>";
		//LEFT
		$query1=$query." AND nhood_id=$nhood1 ";
		$result1 = mysqli_query($link, $query1);
		while ($row = mysqli_fetch_assoc($result1)) {
			echo "<h1>".$row['name']."</h1>";
			echo "<p>Perimeter: ".$row['perimeter']."</p>";
			echo "<p>Area: ".$row['area']."</p>";
			echo "<p>Acerage: ".$row['acres']."</p>";
			echo "<p>Number of Vacant Properties: ";
			
			$vpQuery="SELECT COUNT(v.parcel) as cnt FROM vp_list v
				JOIN address a ON v.parcel=a.parcel
				WHERE a.nhood_id=$nhood1 ";
			
			$vpResult1 = mysqli_query($link, $vpQuery);
			while ($row = mysqli_fetch_assoc($vpResult1)) {
				echo $row['cnt'];
			}
			echo "</p>";
		}
		
		echo "</td><td>";
		//Right Side
		$query2=$query." AND nhood_id=$nhood2 ";
		$result2 = mysqli_query($link, $query2);
		while ($row = mysqli_fetch_assoc($result2)) {
			echo "<h1>".$row['name']."</h1>";
			echo "<p>Perimeter: ".$row['perimeter']."</p>";
			echo "<p>Area: ".$row['area']."</p>";
			echo "<p>Acerage: ".$row['acres']."</p>";
			echo "<p>Number of Vacant Properties: ";
			
			$vpQuery="SELECT COUNT(v.parcel) as cnt FROM vp_list v
				JOIN address a ON v.parcel=a.parcel
				WHERE a.nhood_id=$nhood2 ";
			
			$vpResult2 = mysqli_query($link, $vpQuery);
			while ($row = mysqli_fetch_assoc($vpResult2)) {
				echo $row['cnt'];
			}
			echo "</p>";
		}
		
		echo "</td></tr></table>";
		
	}

?>
