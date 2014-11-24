<?php
	//ini_set('display_errors',1);
	//ini_set('display_startup_errors',1);
	//error_reporting(-1);
	
	
	echo "<script src=\"tableToExcel.js\"></script>";
	echo "<hr>";
	echo "<table width=100%><tr>";
	echo "<td width=25% class='title'>Service Requests</td>";
	echo "<td width=75% class=\"right\">Filter, Search and Map all Service Request Records</td></tr></table>";
	echo "<hr>";
	//Database Connection information
	include_once "dbCon.php";
	
	//Initial Query for the results
	$query = "SELECT * FROM sr_list s
			LEFT OUTER JOIN address a ON s.parcel=a.parcel
			WHERE 1=1 ";

	//Queries to get the drop downs populated
	$selQueryStat = "SELECT stat_id, stat_name from sr_stat";
	$selQueryType = "SELECT type_id, type_name from sr_type";
	$selQueryPri = "SELECT priority_id, priority_name from sr_priority";
	$selQueryNhood = "SELECT nhood_id, name from nhood_list";
	
	//Results to populate the drop downs
	$selResultStat = mysqli_query($link, $selQueryStat);
	$selResultType = mysqli_query($link, $selQueryType);
	$selResultPri = mysqli_query($link, $selQueryPri);
	$selResultNhood = mysqli_query($link, $selQueryNhood);
	
	//Filter form, posts to self
	echo "<form method=\"post\" action=\"index.php?pgNum=1\" width=100%>";
	//SR Status Filter
	echo "<td>Status: </td>";
	echo "<td><select name=\"stat\" type=\"text\" id=\"stat\">";
	echo '<option value="">All Statuses</option>';
		while ($row = mysqli_fetch_assoc($selResultStat)) {
				echo '<option value="'.$row['stat_id'].'">'.$row['stat_name'].'</option>';
		}
	echo "</select>";
	echo "</td>";
	
	//SR Type Filter
	echo "<td>Type: </td>";
	echo "<td><select name=\"type\" type=\"text\" id=\"type\">";
	echo '<option value="">All Types</option>';
		while ($row = mysqli_fetch_assoc($selResultType)) {
				echo '<option value="'.$row['type_id'].'">'.$row['type_name'].'</option>';
		}
	echo "</select>";
	echo "</td>";
	
	//SR Priority Filter
	echo "<td>Type: </td>";
	echo "<td><select name=\"pri\" type=\"text\" id=\"pri\">";
	echo '<option value="">All Priorities</option>';
		while ($row = mysqli_fetch_assoc($selResultPri)) {
				echo '<option value="'.$row['priority_id'].'">'.$row['priority_name'].'</option>';
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
	if(isset($_POST['pri'])) $pri=$_POST['pri'];
	if(isset($_POST['nhood'])) $nhood=$_POST['nhood'];

	
	//If All filters are not null, continue (If not filtered, display message to filter)
	if($stat!=NULL || $type!=NULL || $nhood!=NULL || $pri!=NULL){
		
		//Add each filter that is not null as a filter to the query
		if($stat!=NULL) $query = $query." AND s.stat_id=$stat ";
		if($type!=NULL) $query = $query." AND s.type_id=$type ";
		if($pri!=NULL) $query = $query." AND s.priority_id=$pri ";
		if($nhood!=NULL) $query = $query." AND a.nhood_id=$nhood ";
		//echo $query;
		
		//Make this list for the SRs
		$srlist = new sr_group();
		
		//Create an Array for the addresses to map
		$i=0;
		?>
		<script> var addrList=[]; </script>
		<?php
		
		//Get result and while there are entries
		$result = mysqli_query($link, $query);
		while ($row = mysqli_fetch_assoc($result)) {
			//public function __construct($csr_num, $stat_id, $sr_type, $description, $rcvd_dt, $priority, $parcel, $pln_comp_dt, $comp_dt)
			$addr=new address($row['parcel']);
			$sr_temp = new sr( $row['csr_id'],
						new sr_stat($row['stat_id']),
						new sr_type($row['type_id']),
						$row['description'],
						$row['rcvd_dt'],
						new sr_priority($row['priority_id']),
						$addr,
						$row['pln_comp_dt'],
						$row['comp_dt']
						);
			if($i<10) {
				$fullAddy=$addr->getAddress().", Cincinnati, OH";
				?>
				<script>
					addrList.push(<?php echo(json_encode(htmlentities($fullAddy))); ?>);
				</script>
				<?php
				$i++;
			}
			$srlist->add_sr($sr_temp);

		}
		?>
		<script>
			var addrList = window.opener.addrList;
		</script>
		<?php
		if(sizeof($srlist)>0){	
			echo "<table width=50%><tr>";
			echo "<td width=25%><input type=\"button\" onclick=\"tableToExcel('resTable')\" value=\"Export to Excel\"></td>";
			echo "<td width=25%><input type=\"button\" value=\"Map Addresses\" onclick=\"openMap()\">";
			echo "</td></tr></table>";
			$srlist->print_srs();

		}
		else echo "No Results Found";
	}
	//Else- If not filtered, show error message
	else {
		echo "Filter to Display Results";
	}
?>
