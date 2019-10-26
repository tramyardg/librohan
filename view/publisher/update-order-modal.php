<!-- update order modal for c353proj/publisher-orders.php -->
<div class="modal fade" id="updateOrderModal" tabindex="-1" role="dialog"
     aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Fulfill this client order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="fulfillOrderForm" method="post">
                <input name="publisher-id" type="hidden" class="d-none" value="<?php echo $publisher->getPublisherId(); ?>">
                <div class="modal-body" id="updateOrderModalBody"></div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-sm" id="fulfillOrderFormSubmit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
