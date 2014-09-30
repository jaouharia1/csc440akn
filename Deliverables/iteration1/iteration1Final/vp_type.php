<?php
	//ini_set('display_errors',1);
	//ini_set('display_startup_errors',1);
	//error_reporting(-1);
	
	class vp_type {
		private $type_id;
		
		public function __construct($type_id) {
			$this->type_id = $type_id;
		}
		
		
		public function getName() {
			$name;
			include "dbCon.php";
			$query="SELECT type_name FROM vp_type WHERE type_id=$this->type_id";
			$result = mysqli_query($link, $query);
			while ($row = mysqli_fetch_assoc($result)) {
				$name=$row['type_name'];
			}
			return $name;
		}
	}
?>
