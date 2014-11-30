<?php
//require_once '/var/www/html/csc440/Unit Tests/PHPUnit-3.4.0/PHPUnit-3.4.0/PHPUnit/Framework/TestCase.php';
require_once 'PHPUnit/Framework/TestCase.php';
require_once '../vp.php';
require_once '../vp_group.php';

class testVp extends PHPUnit_Framework_TestCase
{
    protected $vpGroup;
    
    protected function setUp()
    {
        $this->vpGroup = new vp_group;
    }
    
    public function testClass()
    {
    
		$stat_id = "1";
		$vp_type = new vp_type("193");
		$parcel = "11600020057";
		
        $vp = new vp($parcel, $vp_type, $stat_id);
        $this->$vpGroup->add_vp($vp);
        
        $this->assertContains($vp, $vpGroup);
        
    }
}
?>