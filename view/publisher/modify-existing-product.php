<?php
$aController = new AuthorController();
$authors = $aController->fetchAuthors();
$author = new Author();
?>
<div class="modal fade" id="modifyExistingProductModal" tabindex="-1" role="dialog"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modify this book</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="modifyExistingProductForm">
                <div class="modal-body" id="modifyExistingProductModalBody">
                    <div class="row mt-2">
                        <input type="hidden" readonly class="d-none" id="mEpPublisherId"
                            value="<?php echo $publisher->getPublisherId(); ?>">
                        <div class="col">
                            <label for="mEpTitle">Title</label>
                            <input type="text" readonly class="form-control" id="mEpTitle" required>
                        </div>
                        <div class="col">
                            <label for="mEpIsbn">ISBN</label>
                            <input type="text" readonly maxlength="11" class="form-control" id="mEpIsbn" required>
                        </div>
                        <div class="col">
                            <label for="mCategory">Genre</label>
                            <select class="form-control" id="mCategory" required readonly=""></select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <label for="authorsSelect">Authors</label>
                            <ul class="list-group author-list"></ul>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <label for="mEpPrice">Price</label>
                            <input type="text" class="form-control" id="mEpPrice2" readonly>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="price-addon">new price</span>
                                </div>
                                <input type="number" class="form-control" id="mEpPrice" step=any
                                       aria-describedby="price-addon"
                                       required>
                            </div>
                        </div>
                        <div class="col">
                            <label for="mEpQuantity">Quantity</label>
                            <input type="text" class="form-control" id="mEpQuantity2" min="1" readonly>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="qty-addon"># unit(s) to add</span>
                                </div>
                                <input type="number" class="form-control" id="mEpQuantity" min="1"
                                       aria-describedby="qty-addon" required>
                            </div>
                        </div>
                        <div class="col">
                            <label for="mEpEdition">Edition (0 = not applicable)</label>
                            <input type="text" class="form-control" id="mEpEdition2" readonly>
                            <input type="number" class="form-control" id="mEpEdition" min="1" value="0">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-sm" id="modifyExistingProductSubmit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>