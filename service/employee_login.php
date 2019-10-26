<?php
ob_start();
session_start();

require '../db/DB.php';
require '../model/Employee.php';
require '../controller/EmployeeController.php';


if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
    $controller = new EmployeeController();
    $employee = new Employee();
    $employee = $controller->findByEmail($_POST["email"]);

    if (!empty($employee[0])) {
        if ($_POST["password"] == $employee[0]->getPassword()) {
            $_SESSION["employee"] = $employee[0];
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