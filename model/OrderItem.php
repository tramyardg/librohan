<?php

class OrderItem
{

    private $order_item_id;
    private $order_id;
    private $book_id;
    private $quantity;

    public function getOrderItemId()
    {
        return $this->order_item_id;
    }

    public function setOrderItemId($order_item_id): void
    {
        $this->order_item_id = $order_item_id;
    }

    public function getOrderId()
    {
        return $this->order_id;
    }

    public function setOrderId($order_id): void
    {
        $this->order_id = $order_id;
    }

    public function getBookId()
    {
        return $this->book_id;
    }

    public function setBookId($book_id): void
    {
        $this->book_id = $book_id;
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