<?php
require 'db/DB.php';
require 'model/Author.php';
require 'model/Book.php';
require 'model/BookAuthors.php';
require 'model/Publisher.php';
require 'model/BookInventory.php';
require 'model/PublisherBooksInventory.php';

require 'controller/BookController.php';
require 'controller/AuthorController.php';
require 'controller/PublisherController.php';
require 'controller/BookAuthorsController.php';
require 'controller/BookInventoryController.php';
require 'controller/PublisherBooksInventoryController.php';

ob_start();
session_start();

$publisher = new Publisher();
if (isset($_SESSION["publisher"])) {
    $publisher = $_SESSION["publisher"];

    $pbInvController = new PublisherBooksInventoryController();
    $booksByPublisher = $pbInvController->fetchBooksWithQtyOfPublisher($publisher->getPublisherId());
    $aController = new AuthorController();
} else {
    header("Location: publisher-signin.php");
}

?>
<html lang="en" class="gr__getbootstrap_com">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Publisher Dashboard</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="css/publisher-dashboard.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
</head>
<body data-gr-c-s-loaded="true">
<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#" id="company-name-id" data-id="<?php echo $publisher->getPublisherId(); ?>">
        <?php echo $publisher->getCompanyName(); ?>
    </a>
    <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
            <a class="nav-link" href="logout.php">Sign out</a>
        </li>
    </ul>
</nav>

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="publisher-dashboard.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="feather feather-home">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                <polyline points="9 22 9 12 15 12 15 22"></polyline>
                            </svg>
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="publisher-orders.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="feather feather-file">
                                <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                <polyline points="13 2 13 9 20 9"></polyline>
                            </svg>
                            Orders
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="publisher-products.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="feather feather-shopping-cart">
                                <circle cx="9" cy="21" r="1"></circle>
                                <circle cx="20" cy="21" r="1"></circle>
                                <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                            </svg>
                            Products <span class="sr-only">(current)</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Products</h1>
            </div>
            <div class="alert alert-dark d-none" role="alert">
                This book is now in the inventory. Reloading in <span class="badge badge-primary" id="addNewProductAlert"></span> seconds.
            </div>
            <div id="productsDiv">
                <table class="table table-sm" id="productsTable">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">Book ID</th>
                        <th scope="col">Title</th>
                        <th scope="col">ISBN</th>
                        <th scope="col">Edition</th>
                        <th scope="col">Price</th>
                        <th scope="col">Image</th>
                        <th scope="col">Category</th>
                        <th scope="col">Author(s)</th>
                        <th scope="col">Quantity On Hand</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($booksByPublisher as $k => $v) { ?>
                    <tr>
                        <td><?php echo $v['book_id']; ?></td>
                        <td><?php echo $v['title']; ?></td>
                        <td><?php echo $v['isbn']; ?></td>
                        <td><?php echo $v['edition']; ?></td>
                        <td><?php echo $v['price']; ?></td>
                        <td><?php echo $v['image']; ?></td>
                        <td><?php echo $v['category']; ?></td>
                        <td><?php echo $aController->viewAuthors($v['book_id']); ?></td>
                        <td><?php echo $v['qty_on_hand']; ?></td>
                    </tr>
                    <?php } ?>
                    </tbody>
                    <tfoot class="thead-light">
                    <tr>
                        <th scope="col">Book ID</th>
                        <th scope="col">Title</th>
                        <th scope="col">ISBN</th>
                        <th scope="col">Edition</th>
                        <th scope="col">Price</th>
                        <th scope="col">Image</th>
                        <th scope="col">Category</th>
                        <th scope="col">Author(s)</th>
                        <th scope="col">Quantity On Hand</th>
                    </tr>
                    </tfoot>
                </table>
                <div class="my-3">
                    <div class="row">
                        <button type="button" id="add-new-book" class="btn btn-primary btn-sm mr-2"
                                data-toggle="modal" data-target="#addBookModal">
                            <i class="mr-sm-1" style="width: 20px; height: 20px;" data-feather="plus"></i>Add new
                        </button>
                        <button type="button" id="updated-selected-book" class="btn btn-primary btn-sm"
                                data-toggle="modal" data-target="#updateSelectedProductModal">
                            <i class="mr-sm-1" style="height: 18px;" data-feather="edit"></i>Update
                            Selected
                        </button>
                    </div>
                </div>
            </div>
            <?php include 'view/publisher/add-book-modal.php'; ?>
            <?php include 'view/publisher/modify-existing-product.php'; ?>
        </main>
    </div>
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
<script src="js/publisher-index.js"></script>
<script>
    $(document).ready(function () {
        postAddBookFormSubmit();
        let productsTable = $('#productsTable').DataTable({
            'pageLength': 10
        });
        $('#productsTable tbody').on('click', 'tr', function () {
            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected');
            } else {
                productsTable.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        });
        modifyExistingProduct(productsTable);
    });
</script>
</body>
</html>