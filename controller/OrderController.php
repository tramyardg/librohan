<?php

class OrderController
{
    public function __construct()
    {
    }

    public function fetchAllCustomerOrders()
    {
        $sql = " SELECT * FROM orders ;";
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function fetchAllOrders()
    {
        $sql = " SELECT * FROM bookstore_orders ;";
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function fetchByCustomerId($customer_id)
    {
        $sql = "SELECT * 
                FROM `orders` 
                LEFT JOIN `order_items` 
                    ON orders.order_id = order_items.order_id 
                LEFT JOIN `books`
                    ON order_items.book_id = books.book_id
                WHERE orders.customer_id = ? 
                GROUP BY orders.order_id;";
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->execute([$customer_id]);
        return $stmt->fetchAll();
    }

    /*
     *  Save order and return the inserted row id
     */
    public function save(Order $order)
    {
        $sql = 'INSERT INTO `orders` 
                (`customer_id`, `order_date`, `date_received`, `status`, `total`) 
                VALUES (?, ?, ?, ?, ?);';
        $stmt = DB::getInstance()->prepare($sql);
        $exec = $stmt->execute([
            $order->getCustomerId(),
            $order->getOrderDate(),
            $order->getDateReceived(),
            $order->getStatus(),
            $order->getTotal()
        ]);
        return json_encode(['result' => $exec]);
    }

    public function fetchOrderDetails($orderId)
    {
        $sql = 'SELECT
                    oi.order_item_id,
                    oi.quantity,
                    b.title,
                    b.isbn,
                    b.edition,
                    b.price,
                    b.category,
                    a.first_name,
                    a.middle_name,
                    a.last_name
                FROM
                    order_items oi,
                    orders o,
                    books b,
                    authors a,
                    book_authors ba
                WHERE
                    oi.order_id = o.order_id AND oi.book_id = b.book_id AND ba.author_id = a.author_id AND ba.book_id = b.book_id AND o.order_id = ?;';
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->execute([$orderId]);
        return $stmt->fetchAll();
    }

    public function updateOrderById($orderId, $status, $dateReceived)
    {
        $sql = 'UPDATE orders SET status = ?, date_received = ? WHERE order_id = ?;';
        $stmt = DB::getInstance()->prepare($sql);
        return $stmt->execute([$status, $dateReceived, $orderId]);
    }

    public function fetchAllReceivedOrders()
    {
        $sql = "SELECT *
		FROM bookstore_orders, books, publishers
		WHERE bookstore_orders.book_id = books.book_id 
		AND bookstore_orders.publisher_id = publishers.publisher_id
		ORDER BY bookstore_order_id;";
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
