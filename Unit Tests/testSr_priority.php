<?php
//require_once '/var/www/html/csc440/Unit Tests/PHPUnit-3.4.0/PHPUnit-3.4.0/PHPUnit/Framework/TestCase.php';
require_once 'PHPUnit/Framework/TestCase.php';
require_once '../sr_priority.php';

class testSr_priority extends PHPUnit_Framework_TestCase
{
    protected $sr_priorityTest;
    
    protected function setUp()
    {
        $id=3;
        $this->sr_priorityTest = new sr_priority($id);
    }
    
    
  
    
    public function testGetName()
    {
        $id1 = "standard";
        $id2 = "hazardous";
        $id3 = "priority";
       // $this->assertEquals($id1, $this->sr_priorityTest->getName());
       // $this->assertEquals($id2, $this->sr_priorityTest->getName());
        $this->assertEquals($id3, $this->sr_priorityTest->getName());
    }
}
?>