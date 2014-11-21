<?php
	
	class sr_group{
		
		private $sr_array;
		
		public function __construct() {
			$this->sr_array = array();
        }
		
		public function add_sr($sr_to_add) {
			array_push($this->sr_array, $sr_to_add);
        }
		
		public function print_srs(){
			echo "<table border=1 id=\"resTable\">";
			echo "<tr><th>CSR No.</th><th>Status</th><th>Type</th><th>Description</th><th>Received Dt.</th><th>Priority</th><th>Neighborhood</th><th>Address</th><th>Planned Comp.</th><th>Completed</th></tr>";
			for($i=0; $i<count($this->sr_array); $i++){
				$this->sr_array[$i]->displayTableRow();
            }
		}
				
	}
?>
