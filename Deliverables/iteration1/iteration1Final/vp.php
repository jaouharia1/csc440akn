<?php
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);
	
	class vp {		
		private $parcel;
		private $type;
		private $status;
		
		public function __construct($parcel, $type, $status){
			$this->parcel = $parcel;
			$this->type = $type;
			$this->status = $status;
		}
		
		private function makeTD($value) {
			if($value!=NULL) echo "<td>".$value."</td>";
			else echo "<td>&nbsp</td>";
		}
		
		public function displayTableRow() {
			//Address,Neighborhood,Status,Type
			echo "<tr>";
			$this->makeTD($this->parcel->getAddress());
			$this->makeTD($this->parcel->getNhood());
			$this->makeTD($this->type->getName());
			$this->makeTD($this->status->getName());
			echo "</tr>";
		}
		
		public function pt() {
			echo "made";
		}
		
	}
?>