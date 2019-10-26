<?php

class Order
{
    private $order_id;
    private $customer_id;
    private $order_date;
    private $date_received;
    private $status;
    private $total;

    public function getOrderId()
    {
        return $this->order_id;
    }

    public function setOrderId($order_id): void
    {
        $this->order_id = $order_id;
    }

    public function getCustomerId()
    {
        return $this->customer_id;
    }

    public function setCustomerId($customer_id): void
    {
        $this->customer_id = $customer_id;
    }

    public function getOrderDate()
    {
        return $this->order_date;
    }

    public function setOrderDate($order_date): void
    {
        $this->order_date = $order_date;
    }

    public function getDateReceived()
    {
        return $this->date_received;
    }

    public function setDateReceived($date_received): void
    {
        $this->date_received = $date_received;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status): void
    {
        $this->status = $status;
    }

    public function getTotal()
    {
        return $this->total;
    }

    public function setTotal($total): void
    {
        $this->total = $total;
    }
}