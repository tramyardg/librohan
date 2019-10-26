<?php

class BackOrderController
{
    public function __construct()
    {
    }

    public function save(BackOrder $backOrder)
    {
        $sql = 'INSERT INTO `back_orders`(`customer_id`, `book_id`, `order_date`, `quantity`) VALUES (?, ?, ?, ?);';
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->execute([
            $backOrder->getCustomerId(),
            $backOrder->getBookId(),
            $backOrder->getOrderDate(),
            $backOrder->getQuantity()
        ]);
    }

    public function isIdExists($id)
    {
        $sql = 'SELECT back_order_id FROM back_orders WHERE back_order_id = ?';
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchColumn(0);
    }

    public function fetchByCustomerId($customerId)
    {
        $sql = 'SELECT
                    bo.back_order_id,
                    bo.order_date,
                    bo.quantity,
                    b.book_id,
                    b.title,
                    b.isbn,
                    b.edition,
                    b.category
                FROM
                    back_orders bo,
                    books b
                WHERE
                    b.book_id = bo.book_id AND bo.customer_id = ?;';
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->execute([$customerId]);
        return $stmt->fetchAll();
    }

}