<?php

class Employee
{
    private $emp_id;
    private $emp_name;
    private $ssn;
    private $phone_number;
    private $email;
    private $address;
    private $password;
    private $is_admin;

    public function __construct()
    {
    }

    public function getEmpId()
    {
        return $this->emp_id;
    }

    public function setEmpId($emp_id)
    {
        $this->emp_id = $emp_id;
    }

    public function getEmpName()
    {
        return $this->emp_name;
    }

    public function setEmpName($emp_name)
    {
        $this->emp_name = $emp_name;
    }

    public function getSsn()
    {
        return $this->ssn;
    }

    public function setSsn($ssn)
    {
        $this->ssn = $ssn;
    }

    public function getPhoneNumber()
    {
        return $this->phone_number;
    }

    public function setPhoneNumber($phone_number)
    {
        $this->phone_number = $phone_number;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getIsAdmin()
    {
        return $this->is_admin;
    }

    public function setIsAdmin($is_admin)
    {
        $this->is_admin = $is_admin;
    }
}