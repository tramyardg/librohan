<?php


class BackOrder
{
    private $back_order_id;
    private $customer_id;
    private $book_id;
    private $order_date;
    private $quantity;

    public function getBackOrderId()
    {
        return $this->back_order_id;
    }

    public function setBackOrderId($back_order_id): void
    {
        $this->back_order_id = $back_order_id;
    }

    public function getCustomerId()
    {
        return $this->customer_id;
    }

    public function setCustomerId($customer_id): void
    {
        $this->customer_id = $customer_id;
    }

    public function getBookId()
    {
        return $this->book_id;
    }

    public function setBookId($book_id): void
    {
        $this->book_id = $book_id;
    }

    public function getOrderDate()
    {
        return $this->order_date;
    }

    public function setOrderDate($order_date): void
    {
        $this->order_date = $order_date;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setQuantity($quantity): void
    {
        $this->quantity = $quantity;
    }
}