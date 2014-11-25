<?php
//require_once '/var/www/html/csc440/Unit Tests/PHPUnit-3.4.0/PHPUnit-3.4.0/PHPUnit/Framework/TestCase.php';
require_once 'PHPUnit/Framework/TestCase.php';
require_once '../sr.php';
require_once '../sr_type.php';
require_once '../sr_priority.php';

class testSr extends PHPUnit_Framework_TestCase
{
    protected $srTest;
    
    protected function setUp()
    {
        $csr_num = "SR10080336";
		$stat_id = "1";
		$sr_type = new sr_type("193");
		$description = "Some description";
		$rcvd_dt = "2010-12-31";
		$priority = new sr_priority("2");
		$parcel = "11600020057";
		$pln_comp_dt = "2011-01-01";
		$comp_dt = "2012-08-07";
        $this->srTest = new sr($csr_num, $stat_id, $sr_type, $description, $rcvd_dt, $priority, $parcel, $pln_comp_dt, $comp_dt);
    }
    
    public function testClass()
    {
        $csr_num ="SR10080336";
        $falsecsr_num ="JR10340347";
        $this->assertEquals($csr_num, $this->srTest->displayNum());
        $this->assertNotEquals($falsecsr_num, $this->srTest->displayNum());
        
    }
}
?>