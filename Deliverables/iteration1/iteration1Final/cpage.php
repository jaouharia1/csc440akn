<?php
	//ini_set('display_errors',1);
	//ini_set('display_startup_errors',1);
	//error_reporting(-1);
	
	class cpage {
        private $content;

        public function __construct($content) {
            $this->content = $content;
        }

        public function __destruct() {
        }

        public function render() {
			include "header.php";
			if($this->content==1) {include "sr_list.php";}
			elseif($this->content==2) {include "sr_by_year.php";}
			elseif($this->content==3) {include "vp_list.php";}
			elseif($this->content==4) {include "nhood_list.php";}
			elseif($this->content==5) {include "map_stat.php";}
			elseif($this->content==6) {include "nhood_comp.php";}
			else {include "main.php";}
			include "footer.php";
        }
    }
?> 
