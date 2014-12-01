<?php
	echo "<script src=\"tableToExcel.js\"></script>";
	echo "<hr>";
	echo "<table width=100%><tr>";
	echo "<td width=25% class='title'>Vacant Properties</td>";
	echo "<td width=75% class=\"right\">Filter, Search and Map all Vacant Property Records</td></tr></table>";
	echo "<hr>";
	
	//Database Connection information
	include "dbCon.php";
	
	//Initial Query for the results
	$query = "SELECT * FROM vp_list v
			LEFT OUTER JOIN address a ON v.parcel=a.parcel
			WHERE 1=1 ";

	//Queries to get the drop downs populated
	$selQueryStat = "SELECT v.stat_id, v.stat_name from vp_stat v where exists(select 1 from vp_list where stat_id=v.stat_id) ";
	$selQueryType = "SELECT v.type_id, v.type_name from vp_type v where exists(select 1 from vp_list where type_id=v.type_id) ";
	
	//Results to populate the drop downs
	$selResultStat = mysqli_query($link, $selQueryStat);
	$selResultType = mysqli_query($link, $selQueryType);
	
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
	
	echo '</select><input type="submit" value="Filter" /></form>';
	
	//Post results from the form top a variable
	if(isset($_POST['stat'])) $stat=$_POST['stat'];
	if(isset($_POST['type'])) $type=$_POST['type'];

	
	//If All filters are not null, continue (If not filtered, display message to filter)
	if($stat!=NULL || $type!=NULL){
		
		//Add each filter that is not null as a filter to the query
		if($stat!=NULL) $query = $query." AND v.stat_id=$stat" ;
		if($type!=NULL) $query = $query." AND v.type_id=$type" ;
		//echo $query;
		
		//Make this list for the SRs
		$vplist = new vp_group();
		
		//Create an Array for the addresses to map
		$i=0;
		?>
		<script> var addrList=[]; </script>
		<?php
		
		$result = mysqli_query($link, $query);
		while ($row = mysqli_fetch_assoc($result)) {
			//public function __construct($parcel, $type, $status)
			$addr=new address($row['parcel']);
			$vp_temp = new vp( $addr, new vp_type($row['type_id']), new vp_stat($row['stat_id']));
			if($i<10) {
				$fullAddy=$addr->getAddress().", Cincinnati, OH";
				?>
				<script>
					addrList.push(<?php echo(json_encode(htmlentities($fullAddy))); ?>);
				</script>
				<?php
				$i++;
			}
			$vplist->add_vp($vp_temp);
		}	
		?>
		<script>
			var addrList = window.opener.addrList;
		</script>
		<?php
		$num_rows = mysqli_num_rows($result);
		if( $num_rows>0 ){
			echo "<table><tr>";
			echo "<td width=25%><input type=\"button\" onclick=\"tableToExcel('resTable')\" value=\"Export to Excel\"></td>";
			?>
			<td valign='top'>How many Addresses would you like to map: </td><td valign='top'>
			<form>
			<input type="text" name="numMap" id="numMap" />
			<input type="button" onClick="openMap(document.getElementById('numMap').value);" value="Map Addresses"/>
			</form>
			<?php
			echo "</td></tr></table>";
			$vplist->print_vps();
		}
		else echo "No Results Found";
	}
	//Else- If not filtered, show error message
	else {
		echo "Filter to Display Results";
	}
?>
