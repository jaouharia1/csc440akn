<?php
//require_once '/var/www/html/csc440/Unit Tests/PHPUnit-3.4.0/PHPUnit-3.4.0/PHPUnit/Framework/TestCase.php';
require_once 'PHPUnit/Framework/TestCase.php';
require_once '../vp.php';
require_once '../vp_type.php';
require_once '../vp_stat.php';

class testSr extends PHPUnit_Framework_TestCase
{
    protected $vpTest;
    
    protected function setUp()
    {
        $parcel = "11600020057";
        $type = new vp_type(1);
        $status = new vp_stat(1);
        $this->vpTest = new vp($parcel, $type, $status);
    }
    
    public function testClass()
    {
        $parcel = "11600020057";
        $falseparcel = "21601020058";//random number
        $this->assertClassHasAttribute("$parcel", "vp");
        $this->assertClassNotHasAttribute("$falseparcel", "vp");
    }
}