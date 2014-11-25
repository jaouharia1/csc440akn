<?php
//require_once '/var/www/html/csc440/Unit Tests/PHPUnit-3.4.0/PHPUnit-3.4.0/PHPUnit/Framework/TestCase.php';
require_once 'PHPUnit/Framework/TestCase.php';
require_once '../sr_type.php';

class testSr_type extends PHPUnit_Framework_TestCase
{
    protected $sr_typeTest;
    
    protected function setUp()
    {
        $id=346;
        $this->sr_typeTest = new sr_type($id);
    }
    
    
  
    
    public function testGetName()
    {
        $id193 = "Light repair";
        $id223 = "Sign down/missing";
        $id346 = "Default park";
        $this->assertNotEquals($id193, $this->sr_typeTest->getName());
        $this->assertNotEquals($id223, $this->sr_typeTest->getName());
        $this->assertEquals($id346, $this->sr_typeTest->getName());
    }
}
?>