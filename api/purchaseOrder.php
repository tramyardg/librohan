<?php

require '../db/DB.php';
require '../model/Order.php';
require '../model/OrderItem.php';
require '../controller/OrderController.php';
require '../controller/OrderItemController.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST) && isset($_POST['payload']))
{
    $orderController = new OrderController();
    $order = new Order();

    $orderItemController = new OrderItemController();
    $orderItem = new OrderItem();

    $ordersPayload = $_POST['payload']['orders'];
    $orderItemsPayload = $_POST['payload']['order_items'];

    $order->setCustomerId($ordersPayload['customer_id']);
    $order->setOrderDate($ordersPayload['order_date']);
    $order->setStatus('PROCESSING');
    $order->setDateReceived('0000-00-00');
    $order->setTotal($ordersPayload['total']);

    $orderController->save($order);
    $lastOrderId = DB::getInstance()->lastInsertId();

    $result = [];
    foreach ($orderItemsPayload as $k)
    {
        $orderItem->setBookId($k['book_id']);
        $orderItem->setQuantity($k['quantity']);
        $orderItem->setOrderId($lastOrderId);
        $result = $orderItemController->save($orderItem);
    }
    // if something went wrong the expected result array must be empty
    // otherwise, it returns {result: true}
    echo json_encode($result);
}