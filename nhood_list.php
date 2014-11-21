<?php
	echo "<hr>";
	echo "<table width=100%><tr>";
	echo "<td width=25% class='title'>Neighborhoods</td>";
	echo "<td width=75% class=\"right\">Select a Neighborhood and see a Record Overview</td></tr></table>";
	echo "<hr>";
	
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
			echo "<p class='title'>".$row['name']."</p>";
			if($row['perimeter']>0) {
				echo "<p class='odcText'>Perimeter: ".number_format(($row['perimeter']*.000189394),2)." Miles</p>";
				echo "<p class='odcText'>Area: ".number_format(($row['area']*.00000003587),2)." Square Miles</p>";
				echo "<p class='odcText'>Acerage: ".number_format($row['acres'],2)." Acres</p>";
			}
			else echo "<p class='odcText'>No Size Information Found</p>";
			
			/*
			Vacant Property Records are no longer by Neighborhood
			$vpQuery="SELECT COUNT(v.parcel) as cnt, vp_type FROM vp_list v
				JOIN address a ON v.parcel=a.parcel
				WHERE a.nhood_id=$nhood 
				group by vp_type";			
			$vpResult = mysqli_query($link, $vpQuery);
			$num_rows = mysql_num_rows($vpResult);
			if($num_rows>0) {
				echo "<p class='odcText'>Number of Vacant Properties By Type:</p>";
				$vp_tot=0;
				echo "<table class='odcText'>";
				while ($row = mysqli_fetch_assoc($vpResult)) {
					echo "<tr><td>";
					echo $row['vp_type']->getName();
					echo ": </td><td>";
					echo $row['cnt'];
					echo "</td></tr>";
					$vp_tot=$vp_tot+$row['cnt'];
				}
				echo "<tr><td>Total: </td><tr>$vp_tot</td></tr></table>";
			}
			else {
				echo "<p class='odcText'>No Vacant Properties were found in this Neighborhood</p>";
			}*/
			
			
			
			$srQuery="SELECT COUNT(sr.parcel) as cnt, type_id FROM sr_list sr
				JOIN address a ON sr.parcel=a.parcel
				WHERE a.nhood_id=$nhood 
				group by sr.type_id";
			$srResult = mysqli_query($link, $srQuery);
			$num_rows = mysqli_num_rows($srResult);
			if($num_rows>0) {
				$sr_tot=0;
				
				echo "<p class='odcText'>Number of Service Requests By Type:</p>";
				
				echo "<table class='odcText' border=1><tr><th>Type</th><th>Count</th></tr>";
				while ($row = mysqli_fetch_assoc($srResult)) {
					echo "<tr><td>";
					$type=new sr_type($row['type_id']);
					echo $type->getName();
					echo ": </td><td>";
					echo $row['cnt'];
					echo "</td></tr>";
					$sr_tot=$sr_tot+$row['cnt'];
				}
				echo "</table>";
				echo "<p class='odcText'>Total: ".$sr_tot."</p>";
			}
			else {
				echo "<p class='odcText'>No Service Request Records were found in this Neighborhood</p>";
			}
			
			
		}
	}
?>