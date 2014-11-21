<?php 
	/*ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);*/
	
	//include "dbCon.php";
	include 'header.php';
	include_once 'functions.php';
	require_once 'PHPExcel/PHPExcel/IOFactory.php';
	echo "<hr>";
	/*$user = new User();
	// Checking for user logged in or not
	if ($user->get_session())
	{
		header("location:home.php");
	}*/
	
	define('CSV_PATH','/var/www/html/csc440/uploadFiles/'); // specify CSV file path
    $csv_file = CSV_PATH . "vp.csv"; // Name of your CSV file
	$csvfile = fopen($csv_file, 'r');
	$theData = fgets($csvfile);
	if(!$theData) echo "File not found";
	$line=1;
	while (!feof($csvfile)) {
		$fgetsline = fgets($csvfile);
		//echo $fgetsline."<br>";
		$csv_array = explode(",", $fgetsline );
		$zero = trim($csv_array[0]);
		$one = trim($csv_array[1]);
		$two = trim($csv_array[2]);
		$three = trim($csv_array[3]);
		$four = trim($csv_array[4]);
		$five = trim($csv_array[5]);
		$six = trim($csv_array[6]);
		$seven = trim($csv_array[7]);
		$eight = trim($csv_array[8]);
		$nine = trim($csv_array[9]);
		if($line==1){
			$type=$zero;
			$wholeAddy=substr($one, 1);
		}
		elseif($line==3) {
			$status=$three;
			$parcel=substr($nine,1);
		}
		//echo "Testing line: type=".$type." addr=".$wholeAddy." status=".$status." parcel=".$parcel." line=".$line."<br>";
		
		if(/*$type!=NULL && $wholeAddy!=NULL && $status!=NULL && $parcel!=NULL*/ $line==3){
			echo "Importing Record: ".$type.", ".$wholeAddy.", ".$status.", ".$parcel."<br>"; 
		
			//If there is a new Status, add it.
			$StatCheckQuery = "SELECT * FROM vp_stat WHERE stat_name='$status'";
			$StatCheckResult=mysqli_query($link, $StatCheckQuery);
			$num_rows = mysqli_num_rows($StatCheckResult);
			if($num_rows==0 and $status!=NULL){
				$statInsertQuery = "INSERT INTO vp_stat (stat_name) VALUES ('$status')";
				mysqli_query($link, $statInsertQuery);
			}
			$getStatQuery = "SELECT stat_id FROM vp_stat WHERE stat_name='$status'";
			$statIDResult=mysqli_query($link, $getStatQuery);
			while ($row = mysqli_fetch_assoc($statIDResult)) {
				$status=$row['stat_id'];
			}
			
			//If there is a new type, add it
			$TypeCheckQuery = "SELECT * FROM vp_type WHERE type_name='$type'";
			$TypeCheckResult=mysqli_query($link, $TypeCheckQuery);
			$num_rows = mysqli_num_rows($TypeCheckResult);
			if($num_rows==0 and $type!=NULL){
				$TypeInsertQuery = "INSERT INTO vp_type (type_name) VALUES ('$type')";
				mysqli_query($link, $TypeInsertQuery);
			}
			$getTypeQuery = "SELECT type_id FROM vp_type WHERE type_name='$type'";
			$typeIDResult=mysqli_query($link, $getTypeQuery);
			while ($row = mysqli_fetch_assoc($typeIDResult)) {
				$type=$row['type_id'];
			}
			
			//If there is a new address, add it
			$AddrCheckQuery = "SELECT * FROM address WHERE parcel='$parcel'";
			$AddrCheckResult=mysqli_query($link, $AddrCheckQuery);
			$num_rows = mysqli_num_rows($AddrCheckResult);
			$st_no=NULL;
			$st_dir=NULL;
			$st_name=NULL;
			if($num_rows==0 and $parcel!=NULL){
				$addrBroken=explode(" ", $wholeAddy);
				$st_no=$addrBroken[0];
				if($addrBroken[1]=="E" || $addrBroken[1]=="W" || $addrBroken[1]=="N" || $addrBroken[1]=="S"){
					$st_dir=$addrBroken[1];
					for($i=2; $i<sizeof($addrBroken); $i++) {
						$st_name=$st_name." ".$addrBroken[$i];
					}
				}
				else {
					for($i=1; $i<sizeof($addrBroken); $i++) {
						$st_name=$st_name." ".$addrBroken[$i];
					}
				}
				//echo "Num: ".$st_no." dir: ".$st_dir." name: ".$st_name."<br>";
				$AddrInsertQuery = "INSERT INTO address (parcel, st_no, st_dir, st_name) VALUES
				('$parcel', '$st_no', '$st_dir', '$st_name')";
				mysqli_query($link, $AddrInsertQuery);
			}
			
			$VPcheckQuery = "SELECT * FROM vp_list WHERE parcel='$parcel'";
			$VPcheckResult=mysqli_query($link, $VPcheckQuery);
			$num_rows = mysqli_num_rows($VPcheckResult);
			if($num_rows==0){
					$insertQuery = "INSERT INTO vp_list (parcel, type_id, stat_id) VALUES
					('$parcel', $type, $status)";
					mysqli_query($link, $insertQuery);
			}
				//echo $insertQuery."<br>";

		}
		$line++;
		if($line==4) {
			$status=NULL;
			$parcel=NULL;
			$type=NULL;
			$wholeAddy=NULL;
			$line=1;
		}
	}
    fclose($csvfile);

echo "File data successfully imported to database!!";
mysqli_close($con);
?>