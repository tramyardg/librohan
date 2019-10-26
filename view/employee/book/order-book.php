<?php
$pController = new PublisherController();
$bkPb = $pController->fetchBookPublisherInventory();
?>
<div class="tab-pane fade show active" id="orderBooks" role="tabpanel" aria-labelledby="addBooks-tab">
    <div class="pt-3 pb-3">
        <h3 for="selectBookToOrderTable">Select a book to order from the list below.</h3>
        <table id="selectBookToOrderTable" class="table table-sm table-bordered table-hover">
            <thead>
            <tr>
                <th>Book Id</th>
                <th class="d-none">Publisher Id</th>
                <th>Publisher</th>
                <th>Book</th>
                <th>On Hand</th>
            </tr>
            </thead>
            <tbody>
            <?php for ($i = 0; $i < count($bkPb); $i++) { ?>
                <?php $bookAllProps = $bkPb[$i]['title'] . ', ' . $bkPb[$i]['edition'] . ' ed. ' . $bkPb[$i]['isbn']; ?>
                <?php $bookAllProps .= ', $' . $bkPb[$i]['price'] . ', ' . BookCategory::toString(intval($bkPb[$i]['category'])); ?>
                <tr>
                    <td><?php echo $bkPb[$i]['book_id']; ?></td>
                    <td  class="d-none"><?php echo $bkPb[$i]['publisher_id']; ?></td>
                    <td><?php echo $bkPb[$i]['company_name']; ?></td>
                    <td><?php echo $bookAllProps; ?></td>
                    <td><?php echo $bkPb[$i]['qty_on_hand']; ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="pb-3">
        <h3 for="quantityNeeded">How many do you need?</h3>
        <div class="row">
            <div class="col">
                <input type="number" class="form-control" id="quantity-needed" min="1" max="50" value="1">
            </div>
        </div>
    </div>
    <div class="pt-1">
        <button type="button" id="order-book-submit" class="btn btn-primary">Submit</button>
    </div>
</div>
