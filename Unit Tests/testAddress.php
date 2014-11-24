<?php
//require_once '/var/www/html/csc440/Unit Tests/PHPUnit-3.4.0/PHPUnit-3.4.0/PHPUnit/Framework/TestCase.php';
require_once 'PHPUnit/Framework/TestCase.php';
require_once '../functions.php';
require_once '../address.php';

class testAddress extends PHPUnit_Framework_Testcase
{
    protected $AddressTest;
    
    protected function setUp()
    {
        $parcel = 990020129;
        $this->AddressTest = new address($parcel);
    }
    
    public function testGet_Nhood()
    {
        $parcel = 990020129;
        $nhood = "CUF";
        $this->assertEquals($nhood, $this->AddressTest->getNhood());
        $this->assertNotEquals($nhood, $this->AddressTest->getNhood());
    }
    
    public function testGet_Address()
    {
        $address = "W MCMICKEN AV";
        $this->assertEquals($address, $this->AddressTest->getAddress());
        
    }
}

?>