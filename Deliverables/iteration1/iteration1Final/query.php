<?php
	class query{
		private $qString;
		public $qType;
		public $filtered;
		
		public function __construct($qType, $qString) {
            $this->qString = $qString;
			$this->qType = $qType;
			$this->filtered = 0;
        }
		
		public function filter($fString){
			$this->qString=$this->qString." ".$fString;
			$this->filtered=1;
			echo "This Result was Filtered<br>";
		}

		public function getResults() {
			include "dbCon.php";
			$result = mysql_query($this->qString, $con);
			if($this->qType=="sr"){
				$srlist=new sr_group();
				while ($row = mysql_fetch_assoc($result)) {
					//public function __construct($csr_num, $stat_id, $sr_type, $rcvd_dt, $priority, $parcel, $pln_comp_dt, $comp_dt)
					$sr_temp = new sr($row['csr_num'],
									new sr_stat($row['stat_id']),
									new sr_type($row['sr_type']),
									$row['rcvd_dt'],
									new sr_priority($row['priority']),
									new address($row['parcel']),
									$row['pln_comp_dt'],
									$row['comp_dt']);
					$srlist->add_sr($sr_temp);
				}
				$srlist->print_srs();
				
			}elseif($this->qType=="vp") {
				$vplist=new vp_group();
				while ($row = mysql_fetch_assoc($result)) {
					//public function __construct($parcel, $type, $status)
					$vp_temp = new vp( new address($row['parcel']),
										new vp_type($row['vp_type']),
										new vp_stat($row['vp_stat']));
					$vplist->add_vp($vp_temp);
				}
				$vplist->print_vps();
			}
		}
		
		
	}
?>