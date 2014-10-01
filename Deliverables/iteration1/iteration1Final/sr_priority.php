<?php
	class sr_priority {
		private $priority_id;
		
		public function __construct($priority_id) {
			$this->priority_id = $priority_id;
		}
		
		public function getName() {
			$name;
			include "dbCon.php";
			$query="SELECT priority_name FROM sr_priority WHERE priority_id=$this->priority_id";
			$result = mysqli_query($link, $query);
			while ($row = mysqli_fetch_assoc($result)) {
				$name=$row['priority_name'];
			}
			return $name;
		}
	}
?>
