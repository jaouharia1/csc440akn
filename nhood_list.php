<?php
	//Standard Heading for page
	echo "<hr>";
	echo "<table width=100%><tr>";
	echo "<td width=25% class='title'>Neighborhoods</td>";
	echo "<td width=75% class=\"right\">Select a Neighborhood and see a Record Overview</td></tr></table>";
	echo "<hr>";
	
	//Include the db connection information
	include "dbCon.php";
	
	//Initial Query for the results
	$query = "SELECT * FROM nhood_list WHERE 1=1 ";
	$NhoodResult = mysqli_query($link, $query);
	
	//Neighborhood Filter
	echo "<form method=\"post\" action=\"index.php?pgNum=4\" width=100%>";
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
	$nhood = preg_replace('/[^A-Za-z0-9 ]/', '', $nhood);
	
	//If a neighborhood was selected
	if($nhood!=NULL){
		//Create a table to format the results
		echo "<table width=100%><tr><td width=50% valign='top'>";
		$query=$query." AND nhood_id=$nhood ";
		$result = mysqli_query($link, $query);
		while ($row = mysqli_fetch_assoc($result)) {
			echo "<p class='title'>".$row['name']."</p>";
			if($row['perimeter']>0) {
				echo "<p class='odcText'>Perimeter: ".number_format(($row['perimeter']*.000189394),2)." Miles</p>";
				echo "<p class='odcText'>Area: ".number_format(($row['area']*.00000003587),2)." Square Miles</p>";
				echo "<p class='odcText'>Acerage: ".number_format($row['acres'],2)." Acres</p><br><br>";
			}
			else echo "<p class='odcText'>No Size Information Found</p><br><br>";		
		}
		
		//Query for the total number of SRs overall and the number for this neighborhood.
		$query2="select COUNT(sr.csr_id) as overallTot, count(if(a.nhood_id=$nhood, 1, NULL)) as nhoodTot from sr_list sr
				JOIN address a ON sr.parcel=a.parcel ";
		$result2 = mysqli_query($link, $query2);
		while ($row = mysqli_fetch_assoc($result2)) {
			$tot=$row['overallTot'];
			$nTot=$row['nhoodTot'];
		}
		//Display number of SRs for neighborhood plus percentage of overall SRs
		echo "<p class='odcText'>This Neighborhood has $nTot Service Requests</p>";
		echo "<p class='odcText'>That is ".number_format(($nTot/$tot)*100,2)."% of all Service Requests</p><br>";
		
		
		
		//Query for number of addresses with repeat SRs
		$query3="select * from (
					SELECT sr.parcel, count(sr.csr_id) as cnt
					from sr_list sr
					JOIN address a ON sr.parcel=a.parcel
					WHERE a.nhood_id=$nhood 
					group by sr.parcel
				) sq
				WHERE cnt>1";
		$result = mysqli_query($link, $query3);
		$num_rows = mysqli_num_rows($result);
		//If there are rows returned, then that means at least one address had more than one SR
		if($num_rows>0) {
			//create a variable for the initial max of 0
			$initMax=0;
			//Have two echos for grammar
			if($num_rows==1) echo "<p class='odcText'>1 Address in this Neighborhood has multiple Service Requests</p>";
			else echo "<p class='odcText'>$num_rows Addresses in this Neighborhood have multiple Service Requests</p>";
			//Go through the results to get the max for display.
			while ($row = mysqli_fetch_assoc($result)) {
				if($row['cnt']>$initMax) {
					$maxAddr=new address($row['parcel']);
					$maxAddrNum=$row['cnt'];
				}
			}
			echo "<p class='odcText'>".$maxAddr->getAddress()." had the most at ".$maxAddrNum." Service Requests</p>";
		}
		else echo "<p class='odcText'>No Addresses have more than 1 Service Request</p>";
		
		
		
		
			
		//Next part of table for page formatting
		echo "</td><td width=50% valign='top'>";
			
		//Query for the type and percentage of SRs from that Neighborhood
		$srQuery="SELECT COUNT(sr.csr_id) as cnt, type_id
			FROM sr_list sr
			JOIN address a ON sr.parcel=a.parcel
			WHERE a.nhood_id=$nhood 
			group by sr.type_id";
		$srResult = mysqli_query($link, $srQuery);
		$num_rows = mysqli_num_rows($srResult);
		//If there are SR records from the neighborhood, then display
		if($num_rows>0) {
			$sr_tot=0;				
			echo "<p class='odcText'>Number of Service Requests By Type:</p>";				
			echo "<table class='odcText' border=1><tr><th>Type</th><th>Count</th><th>Percentage</th></tr>";
			while ($row = mysqli_fetch_assoc($srResult)) {
				echo "<tr><td>";
				$type=new sr_type($row['type_id']);
				echo $type->getName();
				echo ": </td><td>";
				echo $row['cnt'];
				echo "</td><td>".number_format(($row['cnt']/$nTot)*100,2)."%</td></tr>";
			}
			echo "</table>";
		}
		else {
			echo "<p class='odcText'>No Service Request Records were found in this Neighborhood</p>";
		}

		//Close table
		echo "</td></tr></table>";
	}
?>