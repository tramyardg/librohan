<?php
require '../db/DB.php';
require '../model/Customer.php';
require '../controller/CustomerController.php';

class CustomerControllerTest extends PHPUnit_Framework_TestCase
{
    private $customer;

    public function setUp()
    {
        $this->customer = new Customer();
        $this->customer->setCustomerName("test");
        $this->customer->setEmail("test@gmail.com");
        $this->customer->setPhoneNumber("5141231234");
        $this->customer->setAddress("test address");
        $this->customer->setPassword("test");
    }

    public function testFindByEmail()
    {
        $controller = new CustomerController();
        print_r($controller->findByEmail("test@gmail.com"));
    }

    public function testSave()
    {
        $controller = new CustomerController();
        $controller->save($this->customer);
    }
}
