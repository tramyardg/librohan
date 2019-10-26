<?php
require '../db/DB.php';
require '../model/Employee.php';
require '../model/Author.php';
require '../model/Book.php';
require '../model/Publisher.php';
require '../model/BookInventory.php';
require '../model/BookstoreOrder.php';

require '../controller/EmployeeController.php';
require '../controller/AuthorController.php';
require '../controller/BookController.php';
require '../controller/OrderController.php';
require '../controller/PublisherController.php';
require '../controller/BookInventoryController.php';
require '../controller/BookstoreOrderController.php';

if (isset($_GET["employeeId"])) {
    if (isset($_GET["authors"]) && $_GET["authors"] == "all") {
        $aController = new AuthorController();
        echo $aController->fetchAuthors();
    }

    if (isset($_GET["publishers"]) && $_GET["publishers"] == "all") {
        $pbController = new PublisherController();
        echo $pbController->fetchPublishers();
    }

    // employee order book
    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST) && isset($_POST['orderBookPayload'])) {
        $bookstoreOrder = new BookstoreOrder();
        $bookstoreOrder->setBookId($_POST['orderBookPayload']['bookId']);
        $bookstoreOrder->setPublisherId($_POST['orderBookPayload']['publisherId']);
        $bookstoreOrder->setQtyOrdered($_POST['orderBookPayload']['qtyOrdered']);
        $bookstoreOrder->setDateRequested($_POST['orderBookPayload']['dateRequested']);

        $result = [];
        $bookstoreOrderController = new BookstoreOrderController();
        $result = $bookstoreOrderController->save($bookstoreOrder);
        // if something went wrong -> {result: false}
        // otherwise, result -> {result: true}
        echo json_encode($result);
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['updateClientOrder'])) {
        $oController = new OrderController();
        $result = $oController->updateOrderById(
            $_POST['updateClientOrder']['orderId'],
            "SHIPPED", $_POST['updateClientOrder']['dateShipped']
        );
        echo $result;
    }
}
