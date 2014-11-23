<?php
require_once '../PHPUnit-3.4.0/PHPUnit-3.4.0/PHPUnit/Framework';
//require_once 'PHPUnit/Framework/TestCase.php';
require_once '../functions.php';

class UserTest extends PHPUnit_Framework_TestCase
{
    protected $UserTest;
    
    protected function setUp()
    {
        $this->UserTest = new User;
    }
    
    public function testRegistration()
    {
        $name = 'test user';
        $username = 'testUser';
        $password = 123456;
        $passwordMD5 = "e10adc3949ba59abbe56e057f20f883e";
        $email = 'test@phpunit.com';
        echo "testing Registration";
        $this->assertTrue(true, $this->UserTest->register_user($name, $username, $password, $email));
        $this->assertFalse(false, $this->UserTest->register_user($name, $username, $password, $email));
    }
    
    public function testLogin()
    {
        $name = 'test user';
        $username = 'testUser';
        $password = 123456;
        $passwordMD5 = "e10adc3949ba59abbe56e057f20f883e";
        
        $this->assertTrue(true, $this->UserTest->check_login($username, $password));
        $this->assertFalse(false, $this->UserTest->check_login($username, $password));
        
    }
    public function testGet_fullname(){
    
        $uid=3;
        $name = 'ali jaouhari';
        $fakename = 'some string';
        
        $this->assertEquals($name, $this->UserTest->get_fullname($uid));
        $this->assertNotEquals($fakename, $this->UserTest->get_fullname($uid));
        //this suppose to fail
        //$this->assertNotEquals($name, $this->UserTest->get_fullname($uid));
    }
}

?>