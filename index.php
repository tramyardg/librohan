<?php
$commonNameTitle = parse_ini_file("./common.ini");
require 'db/DB.php';
require 'model/Customer.php';
require 'model/Book.php';
require 'model/Author.php';
require 'controller/BookController.php';
require 'controller/AuthorController.php';

require 'model/Enum.php';
require 'model/BookCategory.php';


$bkController = new BookController();
$aController = new AuthorController();

ob_start();
session_start();
$customer = new Customer();
if (isset($_SESSION["customer"])) {
    $customer = $_SESSION["customer"];
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
    <main class="container-fluid">
        <!-- Order Request Modal -->
        <div class="modal fade" id="orderRequestModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form id="backOrderForm">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Send Order Request</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?php if (isset($_SESSION["customer"])) { ?>
                            <div id="order-body" class="modal-body">
                                <!-- content populated from js file -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <input type="submit" class="btn btn-primary" value="Send Order">
                            </div>
                        <?php } else { ?>
                            <div class="modal-body">You must login before submitting an order request</div>
                        <?php } ?>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- All the filters are in here -->
            <div class="col-3">
                <div class="filter-container">
                    <label for="category-filter">Categories</label>
                    <select id="category-filter" class="custom-select" onchange="rerenderBooks()">
                        <option value="-1" selected>All</option>
                        <option value="0"><?php echo BookCategory::toString(0); ?></option>
                        <option value="1"><?php echo BookCategory::toString(1); ?></option>
                        <option value="2"><?php echo BookCategory::toString(2); ?></option>
                        <option value="3"><?php echo BookCategory::toString(3); ?></option>
                        <option value="4"><?php echo BookCategory::toString(4); ?></option>
                        <option value="5"><?php echo BookCategory::toString(5); ?></option>
                    </select>
                </div>

                <div class="filter-container">
                    <label for="inventory-filter">Availability</label>
                    <select id="inventory-filter" class="custom-select" onchange="rerenderBooks()">
                        <option value="-1" selected>All</option>
                        <option value="0">Out of Stock</option>
                        <option value="1">In Stock</option>
                    </select>
                </div>
            </div>
            <!-- Each book gets appended in here -->
            <div id="book-container" class="col book-container">
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
        let books = <?php echo json_encode($bkController->fetchBooks()); ?>;
        let authorNames = <?php echo json_encode($aController->getBookAuthors()); ?>;
        authorNames.map((k, i) => {
           if (parseInt(books[i].book_id) === parseInt(authorNames[i].book_id)) {
               books[i]['authorNames'] = authorNames[i].names;
           }
        });

        initializeBooks(books);
        // console.log(books);

        $('#backOrderForm').submit((e) => {
            e.preventDefault();
            orderSubmit();
            return false;
        });
    });
</script>
</body>
</html>