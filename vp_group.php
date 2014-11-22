<?php
	
	class vp_group{
		
		private $vp_array;
		
		public function __construct() {
			$this->vp_array = array();
        }
		
		public function add_vp($vp_to_add) {
            array_push($this->vp_array, $vp_to_add);
        }
		
		public function print_vps(){
			echo "<table border=1 id=\"resTable\">";
			echo "<tr><th>Address</th><th>Status</th><th>Type</th><tr>";
			for($i=0; $i<count($this->vp_array); $i++){
				$this->vp_array[$i]->displayTableRow();
            }
			echo "</tr></table>";
		}
		
	}
?>
