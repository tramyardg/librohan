<?php
require('controller/OrderController.php');
$CController = new OrderController();
$Corders = $CController->fetchAllCustomerOrders();
?>
<div class="tab-pane fade" id="client-orders" role="tabpanel" aria-labelledby="client-orders-tab">
    <div class="tab-pane fade show active" id="orderBooks" role="tabpanel" aria-labelledby="addBooks-tab">
        <div class="pt-3 pb-3">
            <h3 for="oderlogClients">Customer Orders</h3>
            <table id="oderlogClients" class="table table-bordered table-hover table-sm" style="width:100%">
                <thead>
                <tr>
                    <th>Order_id</th>
                    <th>Customer_id</th>
                    <th>Order_date</th>
                    <th>Date to be received</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                <?php for ($i = 0; $i < count($Corders); $i++) { ?>
                    <tr class="clientOrdersRow">

                        <td><?php echo $Corders[$i]['order_id']; ?></td>
                        <td><?php echo $Corders[$i]['customer_id']; ?></td>
                        <td><?php echo $Corders[$i]['order_date']; ?></td>
                        <td><?php echo $Corders[$i]['date_received']; ?></td>
                        <td><?php echo $Corders[$i]['status']; ?></td>
                    </tr>
                <?php } ?>
                </tbody>
                <tfoot>
                <tr>
                    <th>Order_id</th>
                    <th>Customer_id</th>
                    <th>Order_date</th>
                    <th>Date to be received</th>
                    <th>Status</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>