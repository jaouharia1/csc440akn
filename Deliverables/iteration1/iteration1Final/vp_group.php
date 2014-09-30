<?php
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);
	
	class vp_group{
		
		private $vp_array;
		
		public function __construct() {
			$this->vp_array = array();
        }
		
		public function add_vp($vp_to_add) {
            array_push($this->vp_array, $vp_to_add);
        }
		
		public function print_vps(){
			echo "<table border=1>";
			echo "<tr><th>Address</th><th>Neighborhood</th><th>Status</th><th>Type</th><tr>";
			for($i=0; $i<count($this->vp_array)-1; $i++){
				$this->vp_array[$i]->displayTableRow();
            }
		}
		
	}
?>