<?php
	class sr_stat{
		private $stat_id;
		
		public function __construct($stat_id) {
			$this->stat_id = $stat_id;
		}
		
		public function getName() {
			$name;
			include "dbCon.php";
			$query="SELECT stat_name FROM sr_stat WHERE stat_id=$this->stat_id";
			$result = mysql_query($query, $con);
			while ($row = mysql_fetch_assoc($result)) {
				$name=$row['stat_name'];
			}
			return $name;
		}
	}
?>
