<?php
require('controller/OrderController.php');
$oController = new OrderController();
$orders = $oController->fetchAllReceivedOrders();
?>
<div class="tab-pane fade show active" id="receive-shipment" role="tabpanel" aria-labelledby="receive-shipment-tab">
    <table id="bookReceiveTable" class="display table table-striped table-hover table-sm">
        <thead>
        <tr>
            <th>Order ID</th>
            <th>Book ID</th>
            <th>Title</th>
            <th>ISBN</th>
            <th>Quantity</th>
            <th>Publisher ID & Name</th>
            <th>Date Shipped</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        <?php for ($i = 0; $i < count($orders); $i++) { ?>
            <tr>
                <td class="receiveBookstoreOrderId"><?php echo $orders[$i]['bookstore_order_id']; ?></td>
                <td class="receiveBookId"><?php echo $orders[$i]['book_id']; ?></td>
                <td><?php echo $orders[$i]['title']; ?></td>
                <td><?php echo $orders[$i]['isbn']; ?></td>
                <td class="receiveQtyOrdered"><?php echo $orders[$i]['qty_ordered']; ?></td>
                <td><?php echo $orders[$i]['publisher_id'], "-", $orders[$i]['company_name']; ?></td>
                <td><?php echo $orders[$i]['date_shipped'] == '0000-00-00' ? 'AWAITING SHIPMENT' : $orders[$i]['date_shipped']; ?></td>
                <td class="receiveStatus"><?php echo $orders[$i]['status']; ?></td>
            </tr>
        <?php } ?>
        </tbody>
        <tfoot>
        <tr>
            <th>Order ID</th>
            <th>Book ID</th>
            <th>Title</th>
            <th>ISBN</th>
            <th>Quantity</th>
            <th>Publisher ID & Name</th>
            <th>Date Shipped</th>
            <th>Status</th>
        </tr>
        </tfoot>
    </table>
    <!-- Receive Orders Modal -->
    <div class="modal fade" id="receiveShipmentModal" tabindex="-1" role="dialog"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Receive Orders</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to proceed?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="receiveSaveChanges">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</div>


