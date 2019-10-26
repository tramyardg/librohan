<?php
$aController = new AuthorController();
$authors = $aController->fetchAuthors();
$author = new Author();
?>
<!-- Add Book Modal -->
<div class="modal fade" id="addBookModal" tabindex="-1" role="dialog"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add new book</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addBookForm" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row mt-2">
                        <div class="col">
                            <label for="bTitle">Title</label>
                            <input type="text" class="form-control" id="bTitle" required value="test">
                        </div>
                        <div class="col">
                            <label for="bIsbn">ISBN</label>
                            <input type="text" maxlength="11" class="form-control" id="bIsbn" required value="test">
                        </div>
                        <div class="col">
                            <label for="bEdition">Edition</label>
                            <input type="number" class="form-control" id="bEdition" min="1" value="1">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <label for="bPrice">Price</label>
                            <input type="number" class="form-control" id="bPrice" step=any required value="1.0">
                        </div>
                        <div class="col">
                            <label for="bQuantity">Quantity</label>
                            <input type="number" class="form-control" id="bQuantity" min="1" required value="1">
                        </div>
                        <div class="col">
                            <label for="publishersSelect">Publisher</label>
                            <select class="form-control" id="publishersSelect" required readonly>
                                <option value="<?php echo $publisher->getPublisherId(); ?>">
                                    <?php echo $publisher->getCompanyName(); ?>
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <label for="authorsSelect">Authors</label>
                            <select multiple class="form-control" id="authorsSelect" required>
                                <?php foreach ($authors as $k => $v)  { $author = $v; ?>
                                    <option value="<?php echo $author->getAuthorId() ?>">
                                        <?php echo $author->getFirstName() . " "; ?>
                                        <?php echo $author->getMiddleName() != "" ? $author->getMiddleName() : " "; ?>
                                        <?php echo $author->getLastName(); ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col">
                            <label for="bAuthorId">Genre</label>
                            <select class="form-control" id="bCategory" required>
                                <option value="">Select genre</option>
                                <option value="0" selected>Biography</option>
                                <option value="1">Fiction</option>
                                <option value="2">History</option>
                                <option value="3">Mystery</option>
                                <option value="4">Suspense</option>
                                <option value="5">Thriller</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col mb-2">
                            <label for="bookImage">Book Cover Image (optional)</label>
                            <input type="file" class="form-control-file" id="bookImage" onchange="handleFileSelect()"
                                   accept="image/x-png,image/gif,image/jpeg">
                        </div>
                        <div class="col d-none" id="bookImagePreview"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-sm" id="addBookSubmit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>