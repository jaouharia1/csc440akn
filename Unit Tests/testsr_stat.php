<?php
//require_once '/var/www/html/csc440/Unit Tests/PHPUnit-3.4.0/PHPUnit-3.4.0/PHPUnit/Framework/TestCase.php';
require_once 'PHPUnit/Framework/TestCase.php';
require_once '../sr_stat.php';

class testSr_stat extends PHPUnit_Framework_TestCase
{
    protected $sr_statTest;
    
    protected function setUp()
    {
        $id=3;
        $this->sr_statTest = new sr_stat($id);
    }
    

  
    
    public function testGetName()
    {
        $id1="CLOSED";
        $id2 = "ABAT-OWN";  
        $id3 ="NEW";       
        $id4 = "VOIDED";    
        $id5 = "CLOS-NO";  
        $id6 = "ORDERS2";   
        $id7 = "DUPLICAT"; 
        $id8 = "ORDERS1";   
        $id9 = "CIVIL";     
        $id10= "CRIMINAL";  
        $id11=  "ACCEPTED";  
        $id12=  "ORDERS3";   
        $id13=  "INPROGRS";  
       // $this->assertEquals($id1, $this->sr_statTest->getName());
       // $this->assertEquals($id2, $this->sr_statTest->getName());
        $this->assertEquals($id3, $this->sr_statTest->getName());
    }
}
?>