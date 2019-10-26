const publisherId = $('a#company-name-id').attr('data-id');
const addBookModal = $('#addBookModal');
// add new book product - start
const addBookForm = $('#addBookForm');
const addBookFormData = {
    getVal: function () {
        return {
            publisherId: $('#publishersSelect').val(),
            isbn: $('#bIsbn').val(),
            title: $('#bTitle').val(),
            edition: $('#bEdition').val(),
            price: $('#bPrice').val(),
            quantity: $('#bQuantity').val(),
            category: $('#bCategory').val(),
            authorsId: $('#authorsSelect').val()
        }
    }
};

function handleFileSelect() {
    let bImage = document.getElementById("bookImage");
    for (let i = 0; i < bImage.files.length; i++) {
        let file = bImage.files[i];
        if (!file.type.match('image.*')) {
            continue;
        }
        let reader = new FileReader();
        reader.onload = (function (theFile) {
            return function (e) {
                let span = document.createElement('span');
                span.innerHTML = ['<img class="thumb" id="product-image-' + i + '" src="', e.target.result,
                    '" title="', theFile.name, '"/>'].join('');
                $('#bookImagePreview').empty();
                document.getElementById('bookImagePreview').insertBefore(span, null);
            };
        })(file);
        reader.readAsDataURL(file);
    }
}

const preAddBookFormSubmit = () => {
    let url = 'service/publisher_index.php?publisherId=' + publisherId;
    let productImage = $('#product-image-0').attr('src');
    console.log(productImage);
    $.post(url, {addBookData: addBookFormData.getVal()}, function (response) {
        addBookModal.modal('hide');
        if (response.includes('{"result":true}{"result":true}')) {
            reloadPage('publisher-products.php', 2, $('#addNewProductAlert'));
        }
    });
    return false;
};

const postAddBookFormSubmit = () => {
    addBookForm.submit(function (event) {
        event.preventDefault();
        preAddBookFormSubmit();
    });
};

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// fulfill bookstore order(s) - start
//////////////////////////////////////
const fulfillOrder = {
    sel: function () {
        return {
            dialog: $('#updateOrderModal'),
            dialogBody: $('#updateOrderModalBody'),
            fulfillOrderForm: $('#fulfillOrderForm'),
            fulfillSubmitBtn: $('#fulfillOrderFormSubmit'),
            updateBtn: $('#update-bookstore-order')
        }
    }
};

fulfillSelectedOrder = (table) => {
    fulfillOrder.sel().updateBtn.click(function () {
        // selRowDat is an array, follows order of the table header
        let selRowData = table.row('.selected').data();
        if (!table.row('.selected').data()) {
            alert('Please select an order to fulfill.');
            return;
        }
        if (parseInt(selRowData[4]) > parseInt(selRowData[5])) {
            alert("You don't have enough in the inventory to fulfill this order.");
            return;
        }
        let submitModalBtn = fulfillOrder.sel().fulfillSubmitBtn;
        if (selRowData[selRowData.length - 1] === "SHIPPED") submitModalBtn.attr('disabled', true);
        else submitModalBtn.attr('disabled', false);

        let rowObj = {
            orderId: selRowData[0],
            bookId: selRowData[1],
            qtyOrdered: selRowData[4],
            qtyOnHand: selRowData[5],
            dateShipped: selRowData[6],
            status: selRowData[selRowData.length - 1]
        };
        fulfillOrder.sel().dialogBody.empty().append(`
        <input name="bookstore-order-id" type="hidden" class="d-none" value="${rowObj.orderId}">
        <input name="book-id" type="hidden" class="d-none" value="${rowObj.bookId}">
        <div class="row mt-2">
            <div class="col">
                <label for="dateShipped">Date Shipped</label>
                <input class="form-control" type="date" value="${new Date().toDateInputValue()}" name="dateShipped"
                id="dateShipped" 
                min="${new Date().toDateInputValue()}">
            </div>
        </div>
        <div class="row mt-2">
            <div class="col">
                <label for="qtyOrderedByClient">Qty Ordered</label>
                <input class="form-control" readonly type="number" value="${parseInt(rowObj.qtyOrdered)}" name="qtyOrderedByClient"
                id="qtyOrderedByClient">
            </div>
            <div class="col">
                <label for="qtyOnHandByPublisher">Qty On Hand</label>
                <input class="form-control" readonly type="number" value="${parseInt(rowObj.qtyOnHand)}" name="qtyOnHandByPublisher"
                id="qtyOnHandByPublisher">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Status</label>
                    </div>
                    <select class="custom-select" id="inputGroupSelectShippedStatus">
                        ${(rowObj.status !== 'SHIPPED') ? 
                        '<option value="SHIPPED" selected>SHIPPED</option>' :
                        '<option value="SHIPPED" selected>SHIPPED</option>'}
                    </select>
                </div>
            </div>
        </div>`);

        fulfillOrder.sel().dialog.modal('show');
        fulfillOrder.sel().dialog.on('hidden.bs.modal', function () {
            fulfillOrder.sel().dialogBody.empty();
        });
    });
};

const fulfillOrderRequest = async () => {
    fulfillOrder.sel().fulfillSubmitBtn.click((e) => {
        let fulfillmentPayload = {
            publisherId: $('input[name=publisher-id]').val(),
            bookstoreOrderId: $('input[name=bookstore-order-id]').val(),
            bookId: $('input[name=book-id]').val(),
            dateShipped: $('input[name=dateShipped]').val(),
            qtyOrdered: $('input[name=qtyOrderedByClient]').val(),
            qtyOnHand: $('input[name=qtyOnHandByPublisher]').val(),
            orderStatus: $('#inputGroupSelectShippedStatus').val()
        };
        let url = 'service/publisher_index.php?publisherId=' + fulfillmentPayload.publisherId;
        $.post(url, {fulfillmentData: fulfillmentPayload}, function (response) {
            let result = JSON.parse(response);
            if (result.length > 0) {
                alert('This order will be ship to the bookstore.');
                fulfillOrder.sel().fulfillSubmitBtn.parent().empty().append(`
                    <button type="button" class="btn btn-secondary btn-sm" onclick="location.reload()" 
                    data-dismiss="modal">Close</button>
                `);
            } else {
                alert('Something went wrong!');
                fulfillOrder.sel().dialog.modal('hide');
            }
        });
        e.preventDefault();
    });
};

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// modify existing product(book)
/////////////////////////////////
const existingOrderElements = {
    ele: function () {
        return {
            dialog: $('#modifyExistingProductModal'),
            dialogBody: $('#modifyExistingProductModalBody'),
            fulfillSubmitBtn: $('#modifyExistingProductSubmit'),
            modifySelProduct: $('#updated-selected-book')
        }
    }
};

modifyExistingProduct = (table) => {
    existingOrderElements.ele().modifySelProduct.click(function () {
        let selRow = table.row('.selected').data();
        if (!table.row('.selected').data()) {
            alert('Please select a product first.');
            return;
        }
        let rowObj = {
            bookId: selRow[0],
            title: selRow[1],
            isbn: selRow[2],
            edition: selRow[3],
            price: selRow[4],
            qty: selRow[selRow.length - 1],
            genre: selRow[selRow.length - 3],
            authors: (selRow[selRow.length - 2]).split(','),
            publisherId: $('input[id=mEpPublisherId]').val()
        };

        console.log(rowObj);
        // editable
        let qtyInput = $('input[id=mEpQuantity]');
        let edInput = $('input[id=mEpEdition]');
        let priceInput = $('input[id=mEpPrice]');

        $('input[id=mEpQuantity2]').val('previous quantity: ' + rowObj.qty);

        edInput.val(rowObj.edition);
        edInput.attr('min', rowObj.edition);
        $('input[id=mEpEdition2]').val('previous edition: ' + rowObj.edition);

        priceInput.val(rowObj.price);
        $('input[id=mEpPrice2]').val('previous price: ' + rowObj.price);

        existingOrderElements.ele().dialog.modal('show');

        // non editable
        $('select[id=mCategory]').append(`
            <option value="${rowObj.genre}">${bookCategory[rowObj.genre]}</option>
        `);
        let authorList = [];
        rowObj.authors.map((v) => {
            authorList.push('<li class="list-group-item">' + v + '</li>');
        });
        $('.author-list').append(authorList);
        $('input[id=mEpTitle]').val(rowObj.title);
        $('input[id=mEpIsbn]').val(rowObj.isbn);

        let modifyExistingProductSubmitBtn = $('#modifyExistingProductSubmit');
        modifyExistingProductSubmitBtn.click((e) => {
            let url = 'service/publisher_index.php?publisherId=' + rowObj.publisherId;
            let payload = {
                publisherId: rowObj.publisherId,
                bookId: rowObj.bookId,
                price: priceInput.val(),
                edition: edInput.val(),
                qty: qtyInput.val()
            };
            $.post(url, {modifySelProductData: payload}, function (response) {
                if (response) {
                    alert('This book has been updated successfully.');
                    modifyExistingProductSubmitBtn.attr('disabled', true);
                    location.reload();
                } else {
                    alert('Something went wrong.');
                }
            });
            e.preventDefault();
        })
    });
};