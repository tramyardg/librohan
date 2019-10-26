<?php
$commonNameTitle = parse_ini_file("./common.ini");
require 'db/DB.php';
require 'model/Employee.php';
require 'model/Enum.php';
require 'model/BookCategory.php';
require 'model/Book.php';
require 'model/Publisher.php';
require 'model/BookInventory.php';
require 'model/BookstoreOrder.php';

require 'controller/EmployeeController.php';
require 'controller/BookController.php';
require 'controller/BookInventoryController.php';
require 'controller/PublisherController.php';
require 'controller/BookstoreOrderController.php';

ob_start();
session_start();

$employee = new Employee();
if (isset($_SESSION["employee"])) {
    $employee = $_SESSION["employee"];
} else {
    header("Location: index.php");
}
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Home</title>

    <link href="css/bootstrap-pulse.css" rel="stylesheet">
    <link href="css/navbar.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.2.5/css/select.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
</head>
<body>
<div class="container">
    <div class="d-none"><input type="hidden" id="employee-input" value="<?php echo $employee->getEmpId(); ?>"></div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light rounded">
        <a class="navbar-brand" href="#"><?php echo $commonNameTitle['siteName']; ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample09"
                aria-controls="navbarsExample09" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExample09">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="employee-index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="employee-book-function.php">Book</a>
                </li>
            </ul>
            <!-- employee nav -->
            <?php include 'view/employee/nav.php'; ?>
        </div>
    </nav>
    <!-- Receive Shipment Success Alert -->
    <div class="alert alert-success d-none" role="alert">
        These books are now in the inventory. This page will reload in <span class="badge badge-primary" id="receiveRefreshSeconds"></span> seconds.
    </div>
    <?php include 'view/employee/home-tab-list.php' ?>
    <div class="tab-content pt-2" id="homeTabContent">
        <?php include 'view/employee/home/receive-orders.php' ?>
        <?php include 'view/employee/home/books-ordered.php' ?>
    </div>
    <script>
        feather.replace();
    </script>

    <!-- Order: jQuery, popper, bootstrap -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.2.5/js/dataTables.select.min.js"></script>
    <script src="js/util.js"></script>
    <script src="js/employee-index.js"></script>
    <script>
        $(document).ready(function () {
            $('#booksOrderedTable').DataTable({
                'pageLength': 10
            });
        });
    </script>
    <script>
        $("#bookReceiveTable tr").click(function () {
            // cannot received a shipment that is not shipped
            if ($(this).find('td.receiveStatus').html() === "PROCESSING") {
                alert('This shipment has pending status.\nPlease wait until publisher shipped this order.');
                return;
            }
            let dataToPassToServer = {
                orderId: $(this).find('td.receiveBookstoreOrderId').html(),
                bookId: $(this).find('td.receiveBookId').html(),
                qtyToBeAdded: $(this).find('td.receiveQtyOrdered').html(),
            };
            let retVal = confirm("The shipment to receive is ORDER ID#: " + dataToPassToServer.orderId + "\nDo you want to continue?");
            if (retVal === true) {
                $.post("api/process.php", {updateReceiveItems: dataToPassToServer}, (response) => {
                    console.log(response);
                    if (parseInt(response) === 2) {
                        console.log('success');
                        location.reload();
                    } else {
                        alert('something went wrong');
                    }
                });
                return true;
            } else {
                return false;
            }
        });
    </script>
</body>
</html>
