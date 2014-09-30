<?php
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);
	
	class vp_stat {
		private $stat_id;
		
		public function __construct($stat_id) {
			$this->stat_id = $stat_id;
		}
		
		
		public function getName() {
			$name;
			include "dbCon.php";
			$query="SELECT stat_name FROM vp_stat WHERE stat_id=$this->stat_id";
			$result = mysqli_query($link, $query);
			while ($row = mysqli_fetch_assoc($result)) {
				$name=$row['stat_name'];
			}
			return $name;
		}
	}
?>