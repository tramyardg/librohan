<?php
ob_start();
session_start();

require '../db/DB.php';
require '../model/Publisher.php';
require '../controller/PublisherController.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
    $controller = new PublisherController();
    $publisher = new Publisher();

    if (filter_var($_POST["companyEmail"], FILTER_VALIDATE_EMAIL)) {
        $publisher = $controller->fetchPublisherByEmail($_POST["companyEmail"]);
    }

    if (!empty($publisher[0])) {
        if ($_POST["password"] == $publisher[0]->getPassword()) {
            $_SESSION["publisher"] = $publisher[0];
            echo json_encode(array('result' => true));
        } else {
            echo json_encode(['result' => false, 'message' => 'The password you entered is incorrect.']);
        }
    } else {
        echo json_encode(['result' => false, 'message' => 'No account associated with this email.']);
    }
}