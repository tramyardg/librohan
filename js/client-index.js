// keep all the books here
let allBooks = [];
// these are the books to be displayed
let books = [];
let selectedBook = null;

const initializeBooks = (data) => {
    allBooks = data;
    books = data;
    rerenderBooks();
};

// renders a single book card
const renderBookCard = (book) => {
    $("#book-container").append(`
        <div class="card-box">
            <div class="card">
                <div class="book-image">
                        Sample Image Here
                </div>
                <div class="card-body">
                    <div class="cart-title text-uppercase">
                        <span>${book.title}</span><br>
                        <span class="badge badge-primary">${bookCategory[book.category]}</span>
                    </div>
                    <div class="card-author" style="font-size: 0.75rem; margin: 0.5rem 0 1rem 0">by <b>${book.authorNames}</b></div>
                    <div class="inventory" style="font-size: 0.75rem">
                        ${(book.qty_on_hand > 0) ? "In Stock" : "<b class='text-danger'>Out of Stock</b>"}
                    </div>
                    <div class="button-container">
                        ${(containsOrder(book.book_id)) ? 
                            `<button type="button" class="btn btn-success" onclick="removeOrder(${book.book_id})">Remove from Cart</button>` :
                            `<button type="button" 
                                class="btn btn-success" 
                                onclick="addOrder(${book.book_id})"
                                ${(book.qty_on_hand == 0 || containsOrder(book.book_id)) ? "disabled" : ""}>
                                Add to Cart
                            </button>`
                        }
                        ${(book.qty_on_hand == 0) ? `
                            <button type="button" 
                                class="btn btn-primary" 
                                data-toggle="modal" 
                                data-target="#orderRequestModal"
                                onclick="requestOrder(${book.book_id})">Request Book</button>
                        ` : ""}
                    </div>
                </div>
            </div>
        </div>
    `)

};

// check if bookId is in localstorage, if not, add it and set localstorage again
const addOrder = (bookId) => {
    let orderBook = allBooks.filter(book => book.book_id == bookId)[0];
    // by deffault, order count is 1
    orderBook.order_count = 1;
    let customerOrders = JSON.parse(localStorage.getItem("customer-cart")) || [];

    if (!containsOrder(bookId)) customerOrders.push(orderBook);
    localStorage.setItem("customer-cart", JSON.stringify(customerOrders));
    rerenderBooks();
};

// removes order from localstorage
const removeOrder = (bookId) => {
    let customerOrders = JSON.parse(localStorage.getItem("customer-cart")) || [];
    let newCustomerOrders = customerOrders.filter(book => book.book_id != bookId);
    localStorage.setItem("customer-cart", JSON.stringify(newCustomerOrders));
    rerenderBooks();
};

// helper method to check if bookId is contained in localstorage
const containsOrder = (bookId) => {
    let customerOrders = JSON.parse(localStorage.getItem("customer-cart")) || [];

    for (let customerOrder of customerOrders) {
        if (customerOrder.book_id == bookId) return true;
    }

    return false;
};

// apply filter changes on books
const filterChange = () => {
    const selectedCategory = $("#category-filter").val();
    const inventoryFilter = $("#inventory-filter").val();

    books = allBooks;
    books = applyCategoryFilter(selectedCategory);
    books = applyInventoryFilter(inventoryFilter);
};

// apply specific category filter on books
const applyCategoryFilter = (selectedCategory) => {
    let filteredBooks = [];

    (selectedCategory == -1) ?
        filteredBooks = books :
        books.forEach((book) => {
            if (book.category == selectedCategory)
                filteredBooks.push(book);
        });

    return filteredBooks;
};

// apply specific inventory filter on books
const applyInventoryFilter = (selectedInventory) => {
    let filteredBooks = [];

    (selectedInventory == -1) ?
        filteredBooks = books :
        books.forEach((book) => {
            // books with available inventory
            if (selectedInventory == 1 && book.qty_on_hand > 0) {
                filteredBooks.push(book);
                // books with no inventory
            } else if (selectedInventory == 0 && book.qty_on_hand == 0) {
                filteredBooks.push(book);
            }
        });

    return filteredBooks;
};

// empties container and rerenders new books
const rerenderBooks = () => {
    filterChange();
    $("#book-container").empty();
    books.forEach((book) => {
        renderBookCard(book);
    });
};

// insert into back_orders
const requestOrder = (bookId) => {
    // populate modal body with the data that is needed
    $("#order-body").empty();
    selectedBook = allBooks.filter((book) => book.book_id == bookId)[0];
    console.log("back order book request: ", selectedBook);

    $("#order-body").append(`
        <div>${selectedBook.title}</div><br>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon3">Quantity</span>
            </div>
            <input id="order-quantity" style="width: 60px" type="number" class="form-control" value="1">
        </div>
    `);
};

const orderSubmit = () => {
    let customerId = $("#customer-id").val();
    let orderQty = $("#order-quantity");
    let payload = {
        customer_id: customerId,
        order_date: new Date().toDateInputValue(),
        book_id: selectedBook.book_id,
        quantity: orderQty.val()
    };

    if (payload.quantity < 1) {
        alert("Quantity must have at least 1");
        return;
    }

    // console.log(payload);

    $.post("api/backOrder.php", payload, (response) => {
        response = JSON.parse(response);
        if (response.status) {
            $('#backOrderForm input[type=submit]').attr('disabled', true);
            alert(response.message);
        } else {
            alert("Something went wrong");
        }
    });
};

//////////////////////////////////////////////////////////////////////////////////////////////////
const updateOrderPrice = (ele, startingPrice) => {
    let updatedQty = $(ele).val();
    let endingPrice = round2Dec(startingPrice * updatedQty);
    $(ele).parent().prev().text('$' + endingPrice);
    $('#total-amount').text('$' + getTotalPrice());
};
const getTotalPrice = () => {
    let total = 0;
    $('.row-price').map((i, v) => {
        let num = $(v).text().substr(1);
        total += parseFloat(num);
    });
    return total.toFixed(2);
};

let cartForm = $('#cart-form');
const cartItems = JSON.parse(localStorage.getItem("customer-cart")) || [];
// console.log(cartItems);

let priceTotal = [];
cartItems.forEach((item) => {
    priceTotal.push(parseFloat(item.price));
    cartForm.append(`<hr>
        <div class="row cart-item-row" data-id="${item.book_id}">
            <div class="col-6 row-title">${item.title}</div>
            <div class="col-3 row-price">$${item.price}</div>
            <div class="col-3 row-qty">
                <input type="number" class="form-control" max="10" min="1"
                    value="${item.order_count}"
                    onchange="updateOrderPrice(this, ${item.price})"/>
            </div>
        </div>
    `);
});

cartForm.append(`
        <hr>
        <div class="row">
            <div class="col-6 font-weight-bold">Total</div>
            <div class="col-3 font-weight-bold" id="total-amount">$${arrSum(priceTotal)}</div>
            <div class="col-3 font-weight-bold"></div>
        </div>
        <hr>
        <div id="cart-purchase-back-btn">
            <button type="submit" class="btn btn-success" id=purchase-btn>Purchase</button>
        </div>
`);

const submitCartForm = () => {
    console.log(cartItems);
    if (cartItems.length <= 0) {
        alert('Your cart is empty.');
        return;
    }
    let customerId = $("#customer-id").val();
    let orderPayload = {
        customer_id: customerId,
        order_date: new Date().toDateInputValue(),
        total: $('#total-amount').text().substr(1)
    };

    let orderItemsPayload = [];
    $('.cart-item-row').map((i, v) => {
        orderItemsPayload.push({
            book_id: $(v).attr('data-id'),
            quantity: $(v).find('input[type=number]').val()
        })
    });

    let ordersPayload = {orders: orderPayload, order_items: orderItemsPayload};
    $.post("api/purchaseOrder.php", {payload: ordersPayload}, (response) => {
        if(JSON.parse(response).length === 0) {
            alert('Something went wrong!');
        } else {
            console.log(JSON.parse(response));
            localStorage.clear();
            alert('Thank you for purchasing with us.');
        }

        $('#cart-purchase-back-btn').empty().prepend(`
            <a href="index.php?indexActive=true" class="btn btn-success" >Home</a>
        `);
    });
};