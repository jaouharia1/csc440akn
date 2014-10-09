<?php
	echo "<script src=\"tableToExcel.js\"></script>";
	echo "<hr><h1>Vacant Properties</h1><hr>";
	
	//Database Connection information
	include "dbCon.php";
	
	//Initial Query for the results
	$query = "SELECT * FROM vp_list v
			LEFT OUTER JOIN address a ON v.parcel=a.parcel
			WHERE 1=1 ";

	//Queries to get the drop downs populated
	$selQueryStat = "SELECT stat_id, stat_name from vp_stat";
	$selQueryType = "SELECT type_id, type_name from vp_type";
	$selQueryNhood = "SELECT nhood_id, name from nhood_list";
	
	//Results to populate the drop downs
	$selResultStat = mysqli_query($link, $selQueryStat);
	$selResultType = mysqli_query($link, $selQueryType);
	$selResultNhood = mysqli_query($link, $selQueryNhood);
	
	//Filter form, posts to self
	echo "<form method=\"post\" action=\"index.php?pgNum=3\" width=100%>";
	//VP Status Filter
	echo "<td>Status: </td>";
	echo "<td><select name=\"stat\" type=\"text\" id=\"stat\">";
	echo '<option value="">All Statuses</option>';
		while ($row = mysqli_fetch_assoc($selResultStat)) {
				echo '<option value="'.$row['stat_id'].'">'.$row['stat_name'].'</option>';
		}
	echo "</select>";
	echo "</td>";
	
	//VP Type Filter
	echo "<td>Type: </td>";
	echo "<td><select name=\"type\" type=\"text\" id=\"type\">";
	echo '<option value="">All Types</option>';
		while ($row = mysqli_fetch_assoc($selResultType)) {
				echo '<option value="'.$row['type_id'].'">'.$row['type_name'].'</option>';
		}
	echo "</select>";
	echo "</td>";
	
	//Neighborhood Filter
	echo "<td>Neighborhood: </td>";
	echo "<td><select name=\"nhood\" type=\"text\" id=\"nhoood\">";
	echo '<option value="">All Neighborhoods</option>';
		while ($row = mysqli_fetch_assoc($selResultNhood)) {
				echo '<option value="'.$row['nhood_id'].'">'.$row['name'].'</option>';
		}
	echo "</select>";
	echo "</td>";
	
	echo '</select><input type="submit" value="Filter" /></form>';
	
	//Post results from the form top a variable
	if(isset($_POST['stat'])) $stat=$_POST['stat'];
	if(isset($_POST['type'])) $type=$_POST['type'];
	if(isset($_POST['nhood'])) $nhood=$_POST['nhood'];

	
	//If All filters are not null, continue (If not filtered, display message to filter)
	if($stat!=NULL || $type!=NULL || $nhood!=NULL){
		
		//Add each filter that is not null as a filter to the query
		if($stat!=NULL) $query = $query." AND v.stat_id=$stat" ;
		if($type!=NULL) $query = $query." AND v.type_id=$type" ;
		if($nhood!=NULL) $query = $query." AND a.nhood_id=$nhood" ;
		//echo $query;
		
		//Make this list for the SRs
		$vplist = new vp_group();
		
		$result = mysqli_query($link, $query);
		while ($row = mysqli_fetch_assoc($result)) {
			//public function __construct($parcel, $type, $status)
			$vp_temp = new vp( new address($row['parcel']),
						new vp_type($row['type_id']),
						new vp_stat($row['stat_id']));
			$vplist->add_vp($vp_temp);
		}
		$row_count=mysqli_num_rows($result);
		if($row_count>0){
			$vplist->print_vps();
			echo "<p><input type=\"button\" onclick=\"tableToExcel('resTable')\" value=\"Export to Excel\"></p>";
		}
		else echo "No Results Found";
	}
	//Else- If not filtered, show error message
	else {
		echo "Filter to Display Results";
	}
?>
