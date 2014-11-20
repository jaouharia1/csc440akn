<?php
	class sr_type {
		private $type_id;
		
		public function __construct($type_id) {
			$this->type_id = $type_id;
		}
			
		public function getName() {
			$name;
			include "dbCon.php";
			$query="SELECT type_name FROM sr_type WHERE type_id=$this->type_id";
			$result = mysql_query($link, $query);
			while ($row = mysql_fetch_assoc($result)) {
				$name=$row['type_name'];
			}
			return $name;
		}
	}
?>