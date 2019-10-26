<?php
$commonMessage = parse_ini_file("../common.ini");
require '../db/DB.php';
require '../model/Employee.php';
require '../controller/EmployeeController.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isValidFormSubmitted()) {
        $employee = new Employee();
        $controller = new EmployeeController();
        if ($controller->findByEmail($_POST["email"])) {
            echo json_encode(array('result' => false));
        } else {
            $employee->setEmpName($_POST["fullName"]);
            $employee->setSsn($_POST["ssn"]);
            $employee->setPhoneNumber($_POST["phone"]);
            $employee->setEmail($_POST["email"]);
            $employee->setAddress(addressCombined());
            $employee->setPassword($_POST["password"]);
            $controller->save($employee);
        }
    }
} else {
    echo $commonMessage["formSubmissionError"];
}

function isValidFormSubmitted()
{
    if (!empty($_POST)) {
        if (!empty($_POST["email"]) && !empty($_POST["password"])) {
            return true;
        }
    }
    return false;
}

function addressCombined()
{
    return $_POST["address"]["inputAddress"] . ', ' .
        $_POST["address"]["inputCity"] . ', ' .
        $_POST["address"]["inputProvince"];
}