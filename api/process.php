<?php
require '../db/DB.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['updateReceiveItems'])) {
    /***
     let dataToPassToServer = {
        orderId: $(this).find('td.receiveBookstoreOrderId').html(),
        bookId: $(this).find('td.receiveBookId').html(),
        qtyToBeAdded: $(this).find('td.receiveQtyOrdered').html(),
     }
     */
    $bookstoreOrder = $_POST['updateReceiveItems'];
    $orderId = $bookstoreOrder['orderId'];
    $bookId = $bookstoreOrder['bookId'];
    $qtyToBeAdded = $bookstoreOrder['qtyToBeAdded'];

    $count = 0;

    // Update in database the qty of books
    $sql = "UPDATE books_inventory SET qty_on_hand = qty_on_hand + ? WHERE book_id = ?;";
    $stmt = DB::getInstance()->prepare($sql);
    if ($stmt->execute([$qtyToBeAdded, $bookId]) == 1) {
        $count++;
    }

    // Delete a row in orders table corresponding to order_id
    $sql = "SET FOREIGN_KEY_CHECKS=0;DELETE FROM bookstore_orders WHERE bookstore_order_id=?;SET FOREIGN_KEY_CHECKS=1;";
    $stmt = DB::getInstance()->prepare($sql);
    if ($stmt->execute([$orderId]) == 1) {
        $count++;
    }

    echo $count;
}

