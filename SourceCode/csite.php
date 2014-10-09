<?php
	//ini_set('display_errors',1);
	//ini_set('display_startup_errors',1);
	//error_reporting(-1);
	
	class csite {
        private $page;

        public function __construct() {
        }

        public function __destruct() {
        }

        public function render() {
            $this->page->render();
        }

        public function setPage(cpage $page) {
            $this->page = $page;
        }
    }
?>
