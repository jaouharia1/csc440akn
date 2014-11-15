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
			$result = mysqli_query($query, $con);
			while ($row = mysqli_fetch_assoc($result)) {
				$name=$row['type_name'];
			}
			return $name;
		}
	}
?>