<?php
	class sr {
		private $csr_num;
		private $stat_id;
		private $sr_type;
		private $rcvd_dt;
		private $priority;
		private $parcel;
		private $pln_comp_dt;
		private $comp_dt;
		
		public function __construct($csr_num, $stat_id, $sr_type, $rcvd_dt, $priority, $parcel, $pln_comp_dt, $comp_dt) {
			$this->csr_num = $csr_num;
			$this->stat_id = $stat_id;
			$this->sr_type= $sr_type;
			$this->rcvd_dt = $rcvd_dt;
			$this->priority = $priority;
			$this->parcel = $parcel;
			$this->pln_comp_dt = $pln_comp_dt;
			$this->comp_dt = $comp_dt;
		}
		
		private function makeTD($value) {
			if($value!=NULL) echo "<td>".$value."</td>";
			else echo "<td>&nbsp</td>";
		}
		
		
		public function displayTableRow() {
			//CSR No.,Status,Type,Received Dt.,Priority,Neighborhood,Address,Planned Comp.,Completed
			echo "<tr>";
			$this->makeTD($this->csr_num);
			$this->makeTD($this->stat_id->getName());
			$this->makeTD($this->sr_type->getName());
			$this->makeTD($this->rcvd_dt);
			$this->makeTD($this->priority->getName());
			$this->makeTD($this->parcel->getNhood());
			$this->makeTD($this->parcel->getAddress());
			$this->makeTD($this->pln_comp_dt);
			$this->makeTD($this->comp_dt);
			echo "</tr>";
		}
		
		public function displayNum() {
			echo $this->csr_num;
		}
	}
?>
