<?php
require '../db/DB.php';
require '../model/BackOrder.php';
require '../controller/BackOrderController.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST))
{
    $customerId = $_POST['customer_id'];
    $bookId = $_POST['book_id'];
    $orderDate = $_POST['order_date'];
    $quantity = $_POST['quantity'];

    $backOrder = new BackOrder();
    $backOrder->setBookId($bookId);
    $backOrder->setCustomerId($customerId);
    $backOrder->setOrderDate($orderDate);
    $backOrder->setQuantity($quantity);

    $backOrderController = new BackOrderController();
    $backOrderController->save($backOrder);

    $confirmationId = DB::getInstance()->lastInsertId();
    if ($backOrderController->isIdExists($confirmationId)) {
        $response = [
            'message' => 'Your confirmation number is #' . $confirmationId . '.',
            'status' => true
        ];
        echo json_encode($response);
    } else {
        echo json_encode(['status' => false]);
    }
}