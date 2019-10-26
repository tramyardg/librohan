<?php
$commonNameTitle = parse_ini_file("./common.ini");
require 'db/DB.php';
require 'model/Enum.php';
require 'model/BookCategory.php';
require 'model/Customer.php';
require 'model/Order.php';
require 'model/BackOrder.php';
require 'controller/BookInventoryController.php';
require 'controller/OrderController.php';
require 'controller/BackOrderController.php';

ob_start();
session_start();
if (isset($_SESSION["customer"])) {
    $customer = $_SESSION["customer"];
} else {
    header('Location: index.php?indexActive=true');
}

$orderController = new OrderController();
$orders = $orderController->fetchByCustomerId($customer->getCustomerId());

$backOrderController = new BackOrderController();
$backOrders = $backOrderController->fetchByCustomerId($customer->getCustomerId());

$biController = new BookInventoryController();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Home</title>

    <link href="css/bootstrap-pulse.css" rel="stylesheet">
    <link href="css/index.css" rel="stylesheet">
    <link href="css/navbar.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.2.5/css/select.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
</head>
<body>
<?php include 'view/customer/navbar.php' ?>
<main class="container">
    <div class="row">
        <div class="col">
            <h3>My Orders</h3>
            <?php if (sizeof($orders) == 0) { ?>
                You do not have any orders currently
            <?php } else { ?>
                <table class="table">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">Order Id</th>
                        <th scope="col">Order Date</th>
                        <th scope="col">Date Received</th>
                        <th scope="col">Status</th>
                        <th scope="col">Total</th>
                        <th scope="col">Details</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($orders as $k): ?>
                        <tr>
                            <th scope="row"><?php echo $k["order_id"]; ?></th>
                            <td><?php echo $k["order_date"]; ?></td>
                            <td><?php echo $k["date_received"]; ?></td>
                            <td><?php echo $k["status"]; ?></td>
                            <td>$<?php echo $k["total"]; ?></td>
                            <td>
                                <?php $orderItems = $orderController->fetchOrderDetails($k["order_id"]); ?>
                                <button type="button" class="btn btn-outline-success" data-toggle="modal"
                                        data-target=".bd-modal-<?php echo $k['order_id']; ?>">View details
                                </button>
                                <div class="modal fade bd-modal-<?php echo $k['order_id']; ?> show" tabindex="-1" role="dialog"
                                     aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <table class="table table-striped">
                                                    <thead class="thead-light">
                                                    <tr>
                                                        <th scope="col">Item Id</th>
                                                        <th scope="col">Qty</th>
                                                        <th scope="col">Title</th>
                                                        <th scope="col">ISBN</th>
                                                        <th scope="col">Edition</th>
                                                        <th scope="col">Price</th>
                                                        <th scope="col">Category</th>
                                                        <th scope="col">Author's name</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php foreach ($orderItems as $p) { ?>
                                                        <?php $midName = $p['middle_name'] != "" ? $p['middle_name'] : " "; ?>
                                                        <tr>
                                                            <th scope="row"><?php echo $p['order_item_id']; ?></th>
                                                            <td><?php echo $p['quantity']; ?></td>
                                                            <td><?php echo $p['title']; ?></td>
                                                            <td><?php echo $p['isbn']; ?></td>
                                                            <td><?php echo $p['edition']; ?></td>
                                                            <td>$<?php echo $p['price']; ?></td>
                                                            <td><?php echo BookCategory::toString(intval($p['category'])); ?></td>
                                                            <td><?php echo $p['first_name'] . ' ' . $midName . ' ' . $p['last_name']; ?></td>
                                                        </tr>
                                                    <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php } ?>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <h3>Requested Orders</h3>
            <?php if (sizeof($orders) == 0) { ?>
                You do not have any orders currently
            <?php } else { ?>
                <table class="table">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">Back Order Id</th>
                        <th scope="col">Request Date</th>
                        <th scope="col">Quantity Requested</th>
                        <th scope="col">Book Requested</th>
                        <th scope="col">Availability</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($backOrders as $q): ?>
                        <?php $requestedCategory = BookCategory::toString(intval($q['category'])) ?>
                        <?php $bookRequested = $q['title'] . ', ' . $q['edition'] . ' edition, ' . $requestedCategory; ?>
                        <?php $qtyCount = intval($biController->fetchQtyByBookId($q['book_id'])); ?>
                        <?php $availability = $qtyCount > 0 ? 'ORDER NOW' : 'OUT OF STOCK'; ?>
                        <tr>
                            <th scope="row"><?php echo $q['back_order_id']; ?></th>
                            <td><?php echo $q['order_date']; ?></td>
                            <td><?php echo $q['quantity']; ?></td>
                            <td><?php echo $bookRequested; ?></td>
                            <?php if ($qtyCount > 0) { ?>
                                <td><label class="badge-info p-1"><?php echo $availability; ?></label></td>
                            <?php } else { ?>
                                <td><label class="badge-warning p-1"><?php echo $availability; ?></label></td>
                            <?php } ?>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php } ?>
        </div>
    </div>
</main>
<script>
    feather.replace();
</script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>