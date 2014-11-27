<?php
	echo "<hr>";
	echo "<table width=100%><tr>";
	echo "<td width=25% class='title'>Address Search</td>";
	echo "<td width=75% class=\"right\">Search all Service Request Records and Vacant Property Records for an address</td></tr></table>";
	echo "<hr>";
	
	//Database Connection information
	include "dbCon.php";
	
	//Initial Query for the results
	$VPquery = "SELECT * FROM vp_list v
			LEFT OUTER JOIN address a ON v.parcel=a.parcel
			WHERE 1=1 ";
	$SRquery = "SELECT * FROM sr_list s
			LEFT OUTER JOIN address a ON s.parcel=a.parcel
			WHERE 1=1 ";
			
	//Filter for Address
	echo "<form method=\"post\" action=\"$_PHP_SELF\">";
	echo "<table border=\"0\" cellspacing=\"1\" cellpadding=\"2\">";
	echo "<td>Street Number:</td><td><input name=\"st_num\" type=\"text\" id=\"st_num\"></td>";
	echo "<td>Street Direction:</td><td><select name=\"st_dir\" type=\"text\" id=\"st_dir\">";
		echo '<option value="">All/None</option>';
		echo '<option value="N">North</option>';
		echo '<option value="S">South</option>';
		echo '<option value="E">East</option>';
		echo '<option value="W">West</option>';
		echo "</select></td>";
	echo "<td>Street Name:</td><td><input name=\"st_name\" type=\"text\" id=\"st_name\"></td>";
	echo "<td><input type=\"submit\" value=\"Filter\" /><td></form></table>";	

	$st_num=$_POST['st_num'];
	$st_dir=$_POST['st_dir'];
	$st_name=$_POST['st_name'];
	
	//If All filters are not null, continue (If not filtered, display message to filter)
	if($st_name!=NULL){
		
		//Add each filter that is not null as a filter to the query
		if($st_num!=NULL) {
			$VPquery=$VPquery. " and a.st_no LIKE '%$st_num%' ";
			$SRquery=$SRquery. " and a.st_no LIKE '%$st_num%' ";
		}
		if($st_dir!=NULL) {
			$VPquery=$VPquery. " and a.st_dir = '$st_dir' ";
			$SRquery=$SRquery. " and a.st_dir = '$st_dir' ";
		}
		if($st_name!=NULL) {
			$VPquery=$VPquery. " and a.st_name LIKE '%$st_name%' ";
			$SRquery=$SRquery. " and a.st_name LIKE '%$st_name%' ";
		}
		
		
		//Make this list for the SRs and one for the VPs
		$srlist = new sr_group();
		$vplist = new vp_group();
		
		//Add results from VPs and SRs to the group objects
		$VPresult = mysqli_query($link, $VPquery);
		while ($row = mysqli_fetch_assoc($VPresult)) {
			$vp_temp = new vp( new address($row['parcel']), new vp_type($row['type_id']), new vp_stat($row['stat_id']));
			$vplist->add_vp($vp_temp);
		}
		$SRresult = mysqli_query($link, $SRquery);
		while ($row = mysqli_fetch_assoc($SRresult)) {
			$sr_temp = new sr( $row['csr_id'],
						new sr_stat($row['stat_id']),
						new sr_type($row['type_id']),
						$row['description'],
						$row['rcvd_dt'],
						new sr_priority($row['priority_id']),
						new address ($row['parcel']),
						$row['pln_comp_dt'],
						$row['comp_dt']
						);
			$srlist->add_sr($sr_temp);
		}
		
		//Print results found for that address
		$num_rowsVP = mysqli_num_rows($VPresult);
		$num_rowsSR = mysqli_num_rows($SRresult);
		if( $num_rowsVP==0 && $num_rowsSR==0 ){
			echo "No Results Found";
		}
		else {
			if( $num_rowsVP>0 ){
				echo "<p class='title'>Vacant Property Records</p>";
				$vplist->print_vps();
			}
			if( $num_rowsSR>0 ){
				echo "<p class='title'>Service Request Records</p>";
				$srlist->print_srs();
			}
		}
	}
	//Else- If not filtered, show error message
	else {
		echo "You must enter at least a street name to continue.";
	}
?>