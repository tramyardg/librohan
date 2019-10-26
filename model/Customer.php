<?php

class Customer
{
    private $customer_id;
    private $customer_name;
    private $email;
    private $phone_number;
    private $address;
    private $password;

    public function __construct()
    {
    }

    public function getCustomerId()
    {
        return $this->customer_id;
    }

    public function getCustomerName()
    {
        return $this->customer_name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPhoneNumber()
    {
        return $this->phone_number;
    }

    public function setPhoneNumber($phone_number)
    {
        $this->phone_number = $phone_number;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setCustomerName($customer_name)
    {
        $this->customer_name = $customer_name;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setAddress($addressCombined)
    {
        $this->address = $addressCombined;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

}