<?php
require '../db/DB.php';
require '../model/Book.php';
require '../model/BookAuthors.php';
require '../model/Publisher.php';
require '../model/BookInventory.php';
require '../model/PublisherBooksInventory.php';
require '../model/BookstoreOrder.php';
require '../model/PublisherOrderFulfillmentHelper.php';

require '../controller/BookController.php';
require '../controller/BookAuthorsController.php';
require '../controller/BookInventoryController.php';
require '../controller/PublisherBooksInventoryController.php';
require '../controller/BookstoreOrderController.php';

$bkController = new BookController();
$baController = new BookAuthorsController();
$bIController = new BookInventoryController();
$pbInvController = new PublisherBooksInventoryController();
$bookstoreOrderController = new BookstoreOrderController();

// minimum requirement -> publisher id to be able to do these functions
if (isset($_GET["publisherId"])) {

    // add new book
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["addBookData"])) {
        $newBook = new Book();
        $newBook->setIsbn($_POST["addBookData"]["isbn"]);
        $newBook->setTitle($_POST["addBookData"]["title"]);
        $newBook->setEdition($_POST["addBookData"]["edition"]);
        $newBook->setPrice($_POST["addBookData"]["price"]);
        $newBook->setCategory($_POST["addBookData"]["category"]);
        $newBook->setPublisherId($_POST["addBookData"]["publisherId"]);
        $newBook->setImage($_POST["addBookData"]['image']);

        $bkController->save($newBook);
        $bkId = DB::getInstance()->lastInsertId();

        // get all the authors and insert it to book_authors table
        // since a book can have many authors
        $authorsId = $_POST["addBookData"]["authorsId"];
        for ($i = 0; $i < count($authorsId); $i++) {
            $bookAuthors = new BookAuthors();
            $bookAuthors->setBookId($bkId);
            $bookAuthors->setAuthorId($authorsId[$i]);
            $baController->save($bookAuthors);
        }

        $bookInventory = new BookInventory();
        $bookInventory->setBookId($bkId);
        // insert 0 quantity in bookstore inventory
        $bookInventory->setQtyOnHand(0);
        $bookInventory->setQtySold(0);
        $bIController->save($bookInventory);

        // insert to publisher book inventory as well with quantity
        $pbInventory = new PublisherBooksInventory();
        $pbInventory->setBookId($bkId);
        $pbInventory->setPublisherId($_POST["addBookData"]["publisherId"]);
        $pbInventory->setQtyOnHand($_POST["addBookData"]["quantity"]);
        $pbInventory->setQtySold(0);
        $pbInvController->save($pbInventory);
    }

    // fulfill bookstore employee order
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["fulfillmentData"])) {
        $fulfillmentHelper = new PublisherOrderFulfillmentHelper();
        $fulfillmentHelper->setBookstoreOrderId($_POST['fulfillmentData']['bookstoreOrderId']);
        $fulfillmentHelper->setQtyOrdered($_POST['fulfillmentData']['qtyOrdered']);
        $fulfillmentHelper->setPublisherId($_POST['fulfillmentData']['publisherId']);
        $fulfillmentHelper->setBookId($_POST['fulfillmentData']['bookId']);
        $fulfillmentHelper->setStatus($_POST['fulfillmentData']['orderStatus']);
        $fulfillmentHelper->setDateShipped($_POST['fulfillmentData']['dateShipped']);

        $result = [];
        $result = [
            $bookstoreOrderController->update($fulfillmentHelper),
            $pbInvController->update($fulfillmentHelper)
        ];
        echo json_encode($result);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["modifySelProductData"])) {
        $result = [];
        // update price and edition in books table - use book id
        array_push($result, $bkController->updatePriceEdition(
            $_POST["modifySelProductData"]["price"],
            $_POST["modifySelProductData"]["edition"],
            $_POST["modifySelProductData"]["bookId"],
            $_POST["modifySelProductData"]["publisherId"]
        ));
        // update qty in pb_book_inventory - use publisher id and book id
        array_push($result, $pbInvController->updateQtyOnHand(
            $_POST["modifySelProductData"]["qty"],
            $_POST["modifySelProductData"]["bookId"],
            $_POST["modifySelProductData"]["publisherId"]
        ));
        // [true,true] if all success
        echo $result[0] == $result[1] ? "true" : "false";
    }

}