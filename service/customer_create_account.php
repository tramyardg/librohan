<?php
$commonMessage = parse_ini_file("../common.ini");
require '../db/DB.php';
require '../model/Customer.php';
require '../controller/CustomerController.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isValidFormSubmitted()) {
        $customer = new Customer();
        $controller = new CustomerController();
        if ($controller->findByEmail($_POST["email"])) {
            echo json_encode(array('result' => false));
        } else {
            $customer->setCustomerName($_POST["fullName"]);
            $customer->setEmail($_POST["email"]);
            $customer->setPhoneNumber($_POST["phone"]);
            $customer->setAddress(addressCombined());
            $customer->setPassword($_POST["password"]);
            $controller->save($customer);
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