<?php
	//ini_set('display_errors',1);
	//ini_set('display_startup_errors',1);
	//error_reporting(-1);
	
	class address{
		public $parcel;

		
		public function __construct($parcel) {
				$this->parcel = $parcel;
		}
		
		
		public function getNhood(){
			$nhood;
			include "dbCon.php";
			$query="SELECT n.name FROM address a
					JOIN nhood_list n ON a.nhood_id=n.nhood_id
					WHERE a.parcel='$this->parcel'";
			$result = mysqli_query($link, $query);
			while ($row = mysqli_fetch_assoc($result)) {
				$nhood=$row['name'];
			}
			return $nhood;
		}
		
		public function getAddress() {
			$address;
			include "dbCon.php";
			$query="SELECT CONCAT_WS(' ', st_no, st_dir, st_name) as addr FROM address WHERE parcel='".$this->parcel."'";
			$result = mysqli_query($link, $query);
			while ($row = mysqli_fetch_assoc($result)) {
				$address=$row['addr'];
			}
			return $address;
		}
		
		
	}
?>
