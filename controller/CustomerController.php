<?php

class CustomerController
{
    public function __construct()
    {
    }

    public function save(Customer $customer)
    {
        $sql = 'INSERT INTO `customers` (`customer_name`, `email`, `password`, `phone_number`, `address`) VALUES (?, ?, ?, ?, ?)';
        $stmt = DB::getInstance()->prepare($sql);
        $exec = $stmt->execute(
            array(
                $customer->getCustomerName(),
                $customer->getEmail(),
                $customer->getPassword(),
                $customer->getPhoneNumber(),
                $customer->getAddress()
            )
        );
        // returns 1 if successful, 0 otherwise
        echo json_encode(array('result' => $exec));
    }

    public function findByEmail($email)
    {
        $sql = 'SELECT * FROM customers WHERE email = ?;';
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, "Customer");
    }
}