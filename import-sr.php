<?php 
	//ini_set('display_errors',1);
	//ini_set('display_startup_errors',1);
	//error_reporting(-1);
	
	include 'header.php';
	include_once 'functions.php';
	require_once 'PHPExcel/PHPExcel/IOFactory.php';
	echo "<hr>";
	$user = new User();
	// Checking for user logged in or not
	if ($user->get_session())
	{
		header("location:home.php");
	}
		
		
	$year = $_GET['year'];
	if($year!=NULL) {
		$fileToImport = "uploadFiles/sr-".$year.".xlsx"; 
		//echo $fileToImport;
		if(!file_exists($fileToImport)) echo "File Not Found.";
		else {
			echo 'Importing '.$year.' Service Request Records...<br><br>';
			$objPHPExcel = PHPExcel_IOFactory::load($fileToImport);
			foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
				$worksheetTitle     = $worksheet->getTitle();
				$highestRow         = $worksheet->getHighestRow(); // e.g. 10
				//echo "The highest row is ".$highestRow."<br>";
				$highestColumn      = $worksheet->getHighestColumn(); // e.g 'F'
				$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
				$nrColumns = ord($highestColumn) - 64;
				for ($xrow = 1; $xrow <= $highestRow; ++$xrow) {
					$cell = $worksheet->getCellByColumnAndRow(0, $xrow);
					$csr = trim($cell->getValue());
					
					$cell = $worksheet->getCellByColumnAndRow(1, $xrow);
					$status = trim($cell->getValue());
					
					$cell = $worksheet->getCellByColumnAndRow(2, $xrow);
					$type = trim($cell->getValue());
					
					$cell = $worksheet->getCellByColumnAndRow(3, $xrow);
					$desc = trim($cell->getValue());
					
					$cell = $worksheet->getCellByColumnAndRow(4, $xrow);
					$rcvd_dt = trim($cell->getValue());
					$UNIX_DATE = ($rcvd_dt - 25569) * 86400;
					$rcvd_dt = date("Y-m-d", $UNIX_DATE);
					
					$cell = $worksheet->getCellByColumnAndRow(8, $xrow);
					$nhood = trim($cell->getValue());
					
					$cell = $worksheet->getCellByColumnAndRow(10, $xrow);
					$priority = trim($cell->getValue());
					
					$cell = $worksheet->getCellByColumnAndRow(12, $xrow);
					$parcel = trim($cell->getValue());
					
					$cell = $worksheet->getCellByColumnAndRow(15, $xrow);
					$pln_comp_dt = trim($cell->getValue());
					$UNIX_DATE = ($pln_comp_dt - 25569) * 86400;
					$pln_comp_dt = date("Y-m-d", $UNIX_DATE);
					
					$cell = $worksheet->getCellByColumnAndRow(17, $xrow);
					$comp_dt = trim($cell->getValue());
					$UNIX_DATE = ($comp_dt - 25569) * 86400;
					$comp_dt = date("Y-m-d", $UNIX_DATE);
					
					$cell = $worksheet->getCellByColumnAndRow(20, $xrow);
					$xcoord = trim($cell->getValue());
					
					$cell = $worksheet->getCellByColumnAndRow(21, $xrow);
					$ycoord = trim($cell->getValue());
					
					$cell = $worksheet->getCellByColumnAndRow(22, $xrow);
					$st_num = trim($cell->getValue());
					
					$cell = $worksheet->getCellByColumnAndRow(23, $xrow);
					$st_dir = trim($cell->getValue());
					
					$cell = $worksheet->getCellByColumnAndRow(24, $xrow);
					$st_name = trim($cell->getValue());
					
					
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
						echo "Importing Record: ".$csr.", ".$status.", ".$type.", ".$desc.", ".$rcvd_dt.", ".$priority.", ".$pln_comp_dt.", ".$comp_dt.", ".$parcel."<br>";
					
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
							('$parcel', '$st_num', '$st_dir', '$st_name', $nhood, $xcoord, $ycoord)";
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
			echo "File data successfully imported to database!!";
			mysqli_close($link);
		}
	}
	else echo "Invalid Year!";
	include 'footer.php';
?>