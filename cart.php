<?php
$commonNameTitle = parse_ini_file("./common.ini");
require 'model/Customer.php';
require 'model/Book.php';
require 'controller/BookController.php';

ob_start();
session_start();
if (isset($_SESSION["customer"])) {
    $customer = $_SESSION["customer"];
} else {
    header('Location: index.php?indexActive=true');
}
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
    <input type="hidden" id="customer-id" class="d-none" value="<?php echo $customer->getCustomerId(); ?>">
    <?php include 'view/customer/navbar.php' ?>
    <main class="container">
        <div class="row">
            <div class="col">
                <h3>My Cart</h3>
                <form id="cart-form">
                    <hr>
                    <div class="row cart-row-header">
                        <div class="col-6 font-weight-bold">Book Title</div>
                        <div class="col-3 font-weight-bold">Price</div>
                        <div class="col-3 font-weight-bold">Quantity</div>
                    </div>
                </form>
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
    <script src="js/util.js"></script>
    <script src="js/client-index.js"></script>
    <script>
        $(document).ready(() => {
            cartForm.submit((e) => {
                e.preventDefault();
                submitCartForm();
                return false;
            });
        });
    </script>
</body>
</html>