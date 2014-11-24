<?php
//require_once '/var/www/html/csc440/Unit Tests/PHPUnit-3.4.0/PHPUnit-3.4.0/PHPUnit/Framework/TestCase.php';
require_once 'PHPUnit/Framework/TestCase.php';
require_once '../vp_type.php';

class testVp_type extends PHPUnit_Framework_TestCase
{
    protected $vp_typeTest;
    
    protected function setUp()
    {
        $id=3;
        $this->vp_typeTest = new vp_type($id);
    }
    
    public function testGetName()
    {
        $id1 = "KEEP THE BUILDING VACANT";
        $id2 = "CONDEMNATION";
        $id3 = "CONDEMNATION (FIRE)";
        $id4 = "VACATE THE BUILDING";
        $id5 = "VACATE- C.O.REQUIRED";
        $id6 = "VACATE THE APARTMENT";
        $id7 = "CONDEMNATION - HISTORIC DIST";
        $id8 = "KEEP APPARTMENT (B) VACANT";
        $id9 = "CONDEMNATION IN NHR DISTRICT";
       // $this->assertEquals($id1, $this->vp_typeTest->getName());
       // $this->assertEquals($id2, $this->vp_typeTest->getName());
        $this->assertEquals($id3, $this->vp_typeTest->getName());
    }
}
?>