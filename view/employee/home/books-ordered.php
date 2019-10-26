<?php
$booksOrderedController = new BookstoreOrderController();
$booksOrdered = $booksOrderedController->fetchOrdersJoinBooksPublisher();
?>
<div class="tab-pane fade" id="booksOrdered" role="tabpanel" aria-labelledby="booksOrdered-tab">
    <table class="table  table-sm table-bordered table-striped" id="booksOrderedTable">
        <thead>
        <tr>
            <th>#</th>
            <th>Book</th>
            <th>Publisher</th>
            <th>Order Quantity</th>
            <th>Date Ordered</th>
            <th>Date Shipped</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($booksOrdered as $k) { ?>
            <?php $bookAllPropsMerged = $k['book_id'] . ' - ' . $k['title'] . ', ' . $k['edition'] . ' ed., '; ?>
            <?php $bookAllPropsMerged .= $k['isbn'] . ', ' . $k['price'] . ', ' . BookCategory::toString(intval($k['category'])); ?>
            <?php $publisherIdName = $k['publisher_id'] . ' - ' . $k['company_name']; ?>
            <tr role="row">
                <td><?php echo $k['bookstore_order_id']; ?></td>
                <td><?php echo $bookAllPropsMerged; ?></td>
                <td><?php echo $publisherIdName; ?></td>
                <td><?php echo $k['qty_ordered']; ?></td>
                <td><?php echo $k['date_requested']; ?></td>
                <td><?php echo $k['date_shipped'] == '0000-00-00' ? 'AWAITING SHIPMENT' : $k['date_shipped']; ?></td>
                <td><?php echo $k['status']; ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>