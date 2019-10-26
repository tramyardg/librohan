<?php
$commonNameTitle = parse_ini_file("./common.ini");
require 'db/DB.php';
require 'model/Employee.php';
require 'model/Publisher.php';
require 'model/Enum.php';
require 'model/BookCategory.php';
require 'controller/EmployeeController.php';
require 'controller/PublisherController.php';

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
    <title>Order book</title>

    <link href="css/bootstrap-pulse.css" rel="stylesheet">
    <link href="css/navbar.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.2.5/css/select.dataTables.min.css">
    <link rel="stylesheet" href="https:////cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>

</head>
<body>
<div class="container">
    <div class="d-none"><input type="hidden" name="employee-input" value="<?php echo $employee->getEmpId(); ?>"></div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light rounded">
        <a class="navbar-brand" href="#"><?php echo $commonNameTitle['siteName']; ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample09"
                aria-controls="navbarsExample09" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExample09">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="employee-index.php">Home</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="employee-book-function.php">Book <span
                                class="sr-only">(current)</span></a>
                </li>
            </ul>
            <!-- employee nav -->
            <?php include 'view/employee/nav.php'; ?>
        </div>
    </nav>
    <?php include 'view/employee/book-tab-list.php' ?>
    <div class="tab-content pt-2">
        <?php include 'view/employee/book/order-book.php' ?>
        <?php include 'view/employee/book/client-orders.php' ?>
    </div>
    <script>
        feather.replace();
    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="js/util.js"></script>
    <script>
        $(document).ready(function () {
            ////////////////////////////////////////////////////////////////////////////////////////////////////////////
            // employee ordering books from publisher
            ///////////////////////////////////////
            let employeeId = $('input[name=employee-input]').val();
            $('#oderlogClients').DataTable({
                'pageLength': 10,
            });
            let selectBookToOrderTable = $('#selectBookToOrderTable').DataTable({
                'pageLength': 10,
                'bLengthChange': false,
                'columnDefs': [
                    {"width": "10%", "targets": 0},
                    {"width": "10%", "targets": 4}],
                "order": [[0, "asc"]]
            });
            $('#selectBookToOrderTable_filter').css({
                'float': 'left',
                'text-align': 'left'
            });

            $('#selectBookToOrderTable tbody').on('click', 'tr', function () {
                if ($(this).hasClass('selected')) {
                    $(this).removeClass('selected');
                } else {
                    selectBookToOrderTable.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                }
            });

            let qtyNeededInput = $('#quantity-needed');
            let orderBookSubmitBtn = $('#order-book-submit');
            orderBookSubmitBtn.click(function () {
                let selectedBookRow = selectBookToOrderTable.row('.selected').data() || [];
                if (selectedBookRow.length === 0) {
                    alert('Please select a book first.');
                    return;
                }
                console.log(selectedBookRow);
                let bookOrdered = {
                    bookId: selectedBookRow[0],
                    publisherId: selectedBookRow[1],
                    qtyOrdered: qtyNeededInput.val(),
                    dateRequested: new Date().toDateInputValue()
                };
                // console.log(bookOrdered);
                submitAddBookReq(bookOrdered)
            });

            const submitAddBookReq = (data) => {
                console.log(data);
                $.post("service/employee_index.php?employeeId=" + employeeId, {orderBookPayload: data}, (response) => {
                    if (JSON.parse(response).result) {
                        console.log(JSON.parse(response));
                        orderBookSubmitBtn.attr('disabled', true);
                        alert('Your order is submitted to this publisher successfully.');
                        location.reload();
                    } else {
                        alert('Something went wrong!');
                    }
                });
            };

            ////////////////////////////////////////////////////////////////////////////////////////////////////////////
            // fulfill client/customer orders
            ///////////////////////////////////////
            $("#oderlogClients tr.clientOrdersRow)").click(function () {
                $(this).addClass('selected').siblings().removeClass('selected');
                let value = $(this).find('td:first').html();
                if ($(this).find('td:last').html() === "SHIPPED") {
                    alert('This is already shipped.');
                    return;
                }
                let data = {orderId: value, dateShipped: new Date().toDateInputValue()};
                let retVal = confirm("The order ID is: " + value + ". Do you want to continue?");
                if (retVal === true) {
                    $.post("service/employee_index.php?employeeId=" + employeeId, {updateClientOrder: data}, (response) => {
                        if (response === "1") {
                            alert('Success');
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
        });
    </script>
</body>
</html>
