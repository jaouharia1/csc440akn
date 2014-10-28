<?php 
	//ini_set('display_errors',1);
	//ini_set('display_startup_errors',1);
	//error_reporting(-1);
	
	session_start();
	if($_SESSION['username']){
		include "dbCon.php";
	
		define('CSV_PATH','/var/www/html/csc440/uploadFiles/'); // specify CSV file path
		$fileNames=array("sr1-2013.csv", "sr2-2012.csv", "sr3-2011.csv", "sr4-2010.csv", "sr5-2009.csv", "sr6-2008.csv" );
		$numFiles=sizeof($fileNames);
		for ($i=0; $i<$numFiles; $i++) {
			$csv_file = CSV_PATH . $fileNames[$i]; // Name of your CSV file
			$csvfile = fopen($csv_file, 'r');
			$theData = fgets($csvfile);
			if(!$theData) echo "File not found";
			else echo "Attempting to Add...<br>";
			while (!feof($csvfile)) {
				$fgetsline = fgets($csvfile);
				echo $fgetsline."<br>";
				$csv_array = explode(",", $fgetsline );
				$csr = trim($csv_array[0]);
				$status = trim($csv_array[1]);
				$type = trim($csv_array[2]);
				$desc = trim($csv_array[3]);
				$rcvd_dt = trim($csv_array[4]);
				$nhood = trim($csv_array[5]);
				$priority = trim($csv_array[6]);
				$parcel = trim($csv_array[7]);
				$pln_comp_dt = trim($csv_array[8]);
				$comp_dt = trim($csv_array[9]);
				$xcoord = trim($csv_array[10]);
				$ycoord = trim($csv_array[11]);
				$st_num = trim($csv_array[12]);
				$st_dir = trim($csv_array[13]);
				$st_name = trim($csv_array[14]);
				
				//Check for Neighborhood and put in correct one. These are hard coded because they should never change.
				if($nhood=="AVONDALE") $nhood=1;
				elseif($nhood=="BOND HILL") $nhood=2;
				elseif($nhood=="CALIFORNIA") $nhood=3;
				elseif($nhood=="CAMP WASHINGTON" || $nhood=="CAMP WASH.") $nhood=4;
				elseif($nhood=="CARTHAGE") $nhood=5;
				elseif($nhood=="CLIFTON") $nhood=6;
				elseif($nhood=="CUF" || $nhood=="HEIGHTS") $nhood=7;
				elseif($nhood=="COLLEGE HILL" || $nhood=="NORTH COLLEGE HILL" || $nhood=="N COLLEGE HILL" || $nhood=="N. COLLEGE HILL") $nhood=8;
				elseif($nhood=="COLUMBIA TUSCULUM") $nhood=9;
				elseif($nhood=="CORRYVILLE") $nhood=10;
				elseif($nhood=="CBD/RIVERFRONT" || $nhood=="CBD RIVERFRONT") $nhood=11;
				elseif($nhood=="EAST END" || $nhood=="EASTEND") $nhood=12;
				elseif($nhood=="EAST PRICE HILL" || $nhood=="E PRICE HILL" || $nhood=="E. PRICE HILL") $nhood=13;
				elseif($nhood=="EAST WALNUT HILLS" || $nhood=="E WALNUT HILLS" || $nhood=="E. WALNUT HILLS") $nhood=14;
				elseif($nhood=="EAST WESTWOOD" || $nhood=="E WESTWOOD" || $nhood=="E. WESTWOOD") $nhood=15;
				elseif($nhood=="ENGLISH WOODS") $nhood=16;
				elseif($nhood=="EVANSTON") $nhood=17;
				elseif($nhood=="FAY APARTMENTS" || $nhood=="FAY") $nhood=18;
				elseif($nhood=="HARTWELL") $nhood=19;
				elseif($nhood=="HYDE PARK") $nhood=20;
				elseif($nhood=="KENNEDY HEIGHTS") $nhood=21;
				elseif($nhood=="LINWOOD") $nhood=22;
				elseif($nhood=="LOWER PRICE HILL") $nhood=23;
				elseif($nhood=="MADISONVILLE") $nhood=24;
				elseif($nhood=="MILLVALE") $nhood=25;
				elseif($nhood=="MOUNT ADAMS") $nhood=26;
				elseif($nhood=="MOUNT AIRY") $nhood=27;
				elseif($nhood=="MOUNT AUBURN") $nhood=28;
				elseif($nhood=="MOUNT LOOKOUT") $nhood=29;
				elseif($nhood=="MOUNT WASHINGTON") $nhood=30;
				elseif($nhood=="NORTH AVONDALE") $nhood=31;
				elseif($nhood=="NORTH FAIRMOUNT") $nhood=32;
				elseif($nhood=="NORTHSIDE") $nhood=33;
				elseif($nhood=="OAKLEY") $nhood=34;
				elseif($nhood=="OVER-THE-RHINE") $nhood=35;
				elseif($nhood=="PADDOCK HILLS") $nhood=36;
				elseif($nhood=="PENDLETON") $nhood=37;	
				elseif($nhood=="PLEASANT RIDGE") $nhood=38;
				elseif($nhood=="QUEENSGATE") $nhood=39;	
				elseif($nhood=="RIVERSIDE") $nhood=40;
				elseif($nhood=="ROSELAWN") $nhood=41;
				elseif($nhood=="SAYLER PARK") $nhood=42;
				elseif($nhood=="SEDAMSVILLE") $nhood=43;
				elseif($nhood=="SOUTH CUMMINSVILLE" || $nhood=="S CUMMINSVILLE" || $nhood=="S. CUMMINSVILLE") $nhood=44;
				elseif($nhood=="SOUTH FAIRMOUNT") $nhood=45;
				elseif($nhood=="SPRING GROVE VILLAGE") $nhood=46;
				elseif($nhood=="WALNUT HILLS") $nhood=47;		
				elseif($nhood=="WEST END") $nhood=48;
				elseif($nhood=="WEST PRICE HILL") $nhood=49;
				elseif($nhood=="WESTWOOD") $nhood=50;
				elseif($nhood=="WINTON HILLS") $nhood=51;
				elseif($nhood=="TERRACE PARK") $nhood=51;
				//Some out of Cincinnati service tickets put in (Some for Clermont County in DB!)
				//Or, some are bad data and the columns are so skewed, we cannot use the data
				else $nhood="Error";
				
				if($nhood!="Error") {
				
					//If there is a new Status, add it.
					$StatCheckQuery = "SELECT * FROM sr_stat WHERE stat_name='$status'";
					$StatCheckResult=mysqli_query($link, $StatCheckQuery);
					$num_rows = mysqli_num_rows($StatCheckResult);
					if($num_rows==0 and $status!=NULL){
						$statInsertQuery = "INSERT INTO sr_stat (stat_name) VALUES ('$status')";
						mysqli_query($link, $statInsertQuery);
					}
					$getStatQuery = "SELECT stat_id FROM sr_stat WHERE stat_name='$status'";
					$statIDResult=mysqli_query($link, $getStatQuery);
					while ($row = mysqli_fetch_assoc($statIDResult)) {
						$status=$row['stat_id'];
					}
					
					//If there is a new priority, add it
					$PriCheckQuery = "SELECT * FROM sr_priority WHERE priority_name='$priority'";
					$PriCheckResult=mysqli_query($link, $PriCheckQuery);
					$num_rows = mysqli_num_rows($PriCheckResult);
					if($num_rows==0 and $priority!=NULL){
						$PriInsertQuery = "INSERT INTO sr_priority (priority_name) VALUES ('$priority')";
						mysqli_query($link, $PriInsertQuery);
					}
					$getPriQuery = "SELECT priority_id FROM sr_priority WHERE priority_name='$priority'";
					$priIDResult=mysqli_query($link, $getPriQuery);
					while ($row = mysqli_fetch_assoc($priIDResult)) {
						$priority=$row['priority_id'];
					}
					
					//If there is a new type, add it
					$TypeCheckQuery = "SELECT * FROM sr_type WHERE type_name='$type'";
					$TypeCheckResult=mysqli_query($link, $TypeCheckQuery);
					$num_rows = mysqli_num_rows($TypeCheckResult);
					if($num_rows==0 and $type!=NULL){
						$TypeInsertQuery = "INSERT INTO sr_type (type_name) VALUES ('$type')";
						mysqli_query($link, $TypeInsertQuery);
					}
					$getTypeQuery = "SELECT type_id FROM sr_type WHERE type_name='$type'";
					$typeIDResult=mysqli_query($link, $getTypeQuery);
					while ($row = mysqli_fetch_assoc($typeIDResult)) {
						$type=$row['type_id'];
					}
					
					//If there is a new address, add it
					$AddrCheckQuery = "SELECT * FROM address WHERE parcel='$parcel'";
					$AddrCheckResult=mysqli_query($link, $AddrCheckQuery);
					$num_rows = mysqli_num_rows($AddrCheckResult);
					if($num_rows==0 and $parcel!=NULL){
						$AddrInsertQuery = "INSERT INTO address (parcel, st_no, st_dir, st_name, nhood_id, xcoord, ycoord) VALUES
						('$parcel', '$st_no', '$st_dir', '$st_name', $nhood, $xcoord, $ycoord)";
						mysqli_query($link, $AddrInsertQuery);
					}
					
					$SRcheckQuery = "SELECT * FROM sr_list WHERE csr_id='$csr'";
					$SRcheckResult=mysqli_query($link, $SRcheckQuery);
					$num_rows = mysqli_num_rows($SRcheckResult);
					if($num_rows==0){
						if($pln_comp_dt==NULL && $comp_dt==NULL) {
							$insertQuery = "INSERT INTO sr_list (csr_id, stat_id, type_id, description, rcvd_dt, priority_id, pln_comp_dt, comp_dt, parcel) VALUES
							('$csr', $status, $type, '$desc', '$rcvd_dt', $priority, NULL, NULL, '$parcel')";
						}
						elseif($pln_comp_dt==NULL) {
							$insertQuery = "INSERT INTO sr_list (csr_id, stat_id, type_id, description, rcvd_dt, priority_id, pln_comp_dt, comp_dt, parcel) VALUES ('$csr', $status, $type, '$desc', '$rcvd_dt', $priority, NULL, '$comp_dt', '$parcel')";
						}
						if($comp_dt==NULL) {
							$insertQuery = "INSERT INTO sr_list (csr_id, stat_id, type_id, description, rcvd_dt, priority_id, pln_comp_dt, comp_dt, parcel) VALUES
							('$csr', $status, $type, '$desc', '$rcvd_dt', $priority, '$pln_comp_dt', NULL, '$parcel')";
						}
						else {
							$insertQuery = "INSERT INTO sr_list (csr_id, stat_id, type_id, description, rcvd_dt, priority_id, pln_comp_dt, comp_dt, parcel) VALUES
							('$csr', $status, $type, '$desc', '$rcvd_dt', $priority, '$pln_comp_dt', '$comp_dt', '$parcel')";
						}
						mysqli_query($link, $insertQuery);
						//echo $insertQuery."<br>";
					}
				}
			}
		}
		fclose($csvfile);
	
	echo "File data successfully imported to database!!";
	mysqli_close($link);
}
?>