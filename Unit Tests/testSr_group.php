<?php
//require_once '/var/www/html/csc440/Unit Tests/PHPUnit-3.4.0/PHPUnit-3.4.0/PHPUnit/Framework/TestCase.php';
require_once 'PHPUnit/Framework/TestCase.php';
require_once '../sr.php';
require_once '../sr_type.php';
require_once '../sr_priority.php';
require_once '../sr_group.php';

class testSr extends PHPUnit_Framework_TestCase
{
    protected $srGroup;
    
    protected function setUp()
    {
        $this->srGroup = new sr_group;
    }
    
    public function testClass()
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
        $sr = new sr($csr_num, $stat_id, $sr_type, $description,                         $rcvd_dt, $priority, $parcel, $pln_comp_dt, $comp_dt);
        $this->$srGroup->add_sr($sr);
        
        $this->assertContains($sr, $srGroup);
        
    }
}
?>