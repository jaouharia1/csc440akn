<?php 
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);
	
	include "dbCon.php";

	define('CSV_PATH','/var/www/html/csc440/uploadFiles'); // specify CSV file path
    $csv_file = CSV_PATH . "vps.csv"; // Name of your CSV file
	$csvfile = fopen($csv_file, 'r');
	$theData = fgets($csvfile);
	if(!$theData) echo "File not found";
	while (!feof($csvfile)) {
		$fgetsline = fgets($csvfile);
		echo $fgetsline."<br>";
		$csv_array = explode(",", $fgetsline );
		$type = trim($csv_array[0]);
		$st_no = trim($csv_array[2]);
		$st_name = trim($csv_array[3]);
		$status = trim($csv_array[4]);
		$st_dir = trim($csv_array[6]);
		$xcoord = trim($csv_array[10]);
		$ycoord = trim($csv_array[11]);
		$parcel = trim($csv_array[12]);
		$nhood = trim($csv_array[13]);
			
		if($type!=NULL && $type!="NOTATION" && $st_no!=NULL && $st_name!=NULL && $parcel!=NULL && $nhood!=NULL) {
		
			//If there is a new Status, add it.
			$StatCheckQuery = "SELECT * FROM vp_stat WHERE stat_name='$status'";
			$StatCheckResult=mysqli_query($con, $StatCheckQuery);
			$num_rows = mysqli_num_rows($StatCheckResult);
			if($num_rows==0 and $status!=NULL){
				$statInsertQuery = "INSERT INTO vp_stat (stat_name) VALUES ('$status')";
				mysqli_query($con, $statInsertQuery);
			}
			$getStatQuery = "SELECT stat_id FROM vp_stat WHERE stat_name='$status'";
			$statIDResult=mysqli_query($con, $getStatQuery);
			while ($row = mysqli_fetch_assoc($statIDResult)) {
				$status=$row['stat_id'];
			}
			
			
			//If there is a new type, add it
			$TypeCheckQuery = "SELECT * FROM vp_type WHERE type_name='$type'";
			$TypeCheckResult=mysqli_query($con, $TypeCheckQuery);
			$num_rows = mysqli_num_rows($TypeCheckResult);
			if($num_rows==0 and $type!=NULL){
				$TypeInsertQuery = "INSERT INTO vp_type (type_name) VALUES ('$type')";
				mysqli_query($con, $TypeInsertQuery);
			}
			$getTypeQuery = "SELECT type_id FROM vp_type WHERE type_name='$type'";
			$typeIDResult=mysqli_query($con, $getTypeQuery);
			while ($row = mysqli_fetch_assoc($typeIDResult)) {
				$type=$row['type_id'];
			}
			
			//If there is a new address, add it
			$AddrCheckQuery = "SELECT * FROM address WHERE parcel='$parcel'";
			$AddrCheckResult=mysqli_query($con, $AddrCheckQuery);
			$num_rows = mysqli_num_rows($AddrCheckResult);
			if($num_rows==0 and $parcel!=NULL){
				$AddrInsertQuery = "INSERT INTO address (parcel, st_no, st_dir, st_name, nhood_id, xcoord, ycoord) VALUES
				('$parcel', '$st_no', '$st_dir', '$st_name', $nhood, $xcoord, $ycoord)";
				mysqli_query($con, $AddrInsertQuery);
			}
			
			$SRcheckQuery = "SELECT * FROM vp_list WHERE parcel='$parcel'";
			$SRcheckResult=mysqli_query($con, $SRcheckQuery);
			$num_rows = mysqli_num_rows($SRcheckResult);
			if($num_rows==0){
					$insertQuery = "INSERT INTO vp_list ( parcel) VALUES
					('$csr', $status, $type, '$desc', '$rcvd_dt', $priority, NULL, NULL, '$parcel')";
					mysqli_query($con, $insertQuery);
			}
				//echo $insertQuery."<br>";
		}
	}
    fclose($csvfile);

echo "File data successfully imported to database!!";
mysqli_close($con);
?>