<?php

//require_once '/var/www/html/csc440/Unit Tests/PHPUnit-3.4.0/PHPUnit-3.4.0/PHPUnit/Framework/TestCase.php';
require_once 'PHPUnit/Framework/TestCase.php';
require_once '../vp_stat.php';

class testVp_stat extends PHPUnit_Framework_TestCase
{
    protected $vp_statTest;
    
    protected function setUp()
    {
        $id=3;
        $this->vp_statTest = new vp_stat($id);
    }
    
    public function testGetName()
    {
       /* $id1 = "CRIMINAL";
        $id2 = "DIVERSN";*/
        $id3 = "ORDERS";
       /* $id4 = "FINLNOTC";
        $id5 = "CIVIL1";
        $id6 = "CIVIL2";
        $id7 = "PREPROS";
        $id8 = "HAZARD";
        $id9 = "CRIMPREP";
        $id10 = "INTAKE";
        $id11 = "PROBATN";
        $id12 = "BARRSPEC";
        $id13 = "CRIMINAC";
        $id14 = "BARRICD ";*/
       // $this->assertEquals($id1, $this->Vp_statTest->getName());
       // $this->assertEquals($id2, $this->Vp_statTest->getName());
        $this->assertEquals($id3, $this->vp_statTest->getName());
    }
}

?>