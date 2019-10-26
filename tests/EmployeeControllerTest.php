<?php
require '../db/DB.php';
require '../model/Employee.php';
require '../controller/EmployeeController.php';

class EmployeeControllerTest extends PHPUnit_Framework_TestCase
{
    private $employee;

    public function setUp()
    {
        $this->employee = new Employee();
        $this->employee->setEmpName("test");
        $this->employee->setSsn("123456789");
        $this->employee->setPhoneNumber("5141234567");
        $this->employee->setEmail("test@gmail.com");
        $this->employee->setAddress("test address");
        $this->employee->setPassword("test");
    }

    public function testFindByEmail()
    {
        $controller = new EmployeeController();
        print_r($controller->findByEmail("test@gmail.com"));
    }

    public function testSave()
    {
        $controller = new EmployeeController();
        $controller->save($this->employee);
    }
}
