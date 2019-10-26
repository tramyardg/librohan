<?php
ob_start();
session_start();

require '../db/DB.php';
require '../model/Customer.php';
require '../controller/CustomerController.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
    $controller = new CustomerController();
    $customer = new Customer();
    $customer = $controller->findByEmail($_POST["email"]);

    if (!empty($customer[0])) {
        if ($_POST["password"] == $customer[0]->getPassword()) {
            $_SESSION["customer"] = $customer[0];
            echo json_encode(array('result' => true));
        } else {
            echo json_encode(array(
                'result' => false,
                'message' => 'The password you entered is incorrect.')
            );
        }
    } else {
        echo json_encode(array(
            'result' => false,
            'message' => 'No account associated with this email.')
        );
    }
}