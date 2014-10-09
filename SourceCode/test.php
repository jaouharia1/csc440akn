<?php
	echo "<hr><h1>TEST</h1><hr>";

	
	//Database Connection information
	include "dbCon.php";
	
	//echo $db;
	//Initial Query for the results
	$query = "select * from vp_list LIMIT 7";
	//$result = mysqli_query($con, $query, MYSQLI_USE_RESULT);
	//while ($row = mysql_fetch_assoc($result)) {
		//echo $row['parcel'];
	//}
	$result = mysqli_query($link, "SELECT stat_name FROM vp_stat LIMIT 10");
	while ($row = mysqli_fetch_assoc($result)) {
		echo $row['stat_name'];
	}

    /* free result set */
    mysqli_free_result($result);

	
?>