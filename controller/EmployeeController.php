<?php

class EmployeeController
{
    public function __construct()
    {
    }

    public function save(Employee $employee)
    {
        $sql = 'INSERT INTO `employees` (`emp_name`, `ssn`, `phone_number`, `email`, `password`, `address`) VALUES (?, ?, ?, ?, ?, ?)';
        $stmt = DB::getInstance()->prepare($sql);
        $exec = $stmt->execute(
            array(
                $employee->getEmpName(),
                $employee->getSsn(),
                $employee->getPhoneNumber(),
                $employee->getEmail(),
                $employee->getPassword(),
                $employee->getAddress()
            )
        );
        echo json_encode(array('result' => $exec));
    }

    public function findByEmail($email)
    {
        $sql = 'SELECT * FROM employees WHERE email = ?;';
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, "Employee");
    }
}