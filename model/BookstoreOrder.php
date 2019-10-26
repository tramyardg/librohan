<?php

class BookstoreOrder
{
    private $bookstore_order_id;
    private $book_id;
    private $publisher_id;
    private $qty_ordered;
    private $status;
    private $date_requested;
    private $date_shipped;
    private $period_specified;

    public function __construct()
    {
        // date requested, period specified, status, and date shipped are set here by default
        $dateRequested = date('Y-m-d');
        $dateRequestedPlus2Weeks = strtotime("+14 day", strtotime($dateRequested));
        $periodSpecified = date('Y-m-d', $dateRequestedPlus2Weeks);
        $this->date_requested = $dateRequested;
        $this->period_specified = $periodSpecified;
        $this->status = 'PROCESSING';
        $this->date_shipped = '0000-00-00';
    }

    public function getPeriodSpecified()
    {
        return $this->period_specified;
    }

    public function setPeriodSpecified($period_specified)
    {
        $this->period_specified = $period_specified;
    }

    public function getBookstoreOrderId()
    {
        return $this->bookstore_order_id;
    }

    public function setBookstoreOrderId($bookstore_order_id): void
    {
        $this->bookstore_order_id = $bookstore_order_id;
    }

    public function getBookId()
    {
        return $this->book_id;
    }

    public function setBookId($book_id): void
    {
        $this->book_id = $book_id;
    }

    public function getPublisherId()
    {
        return $this->publisher_id;
    }

    public function setPublisherId($publisher_id): void
    {
        $this->publisher_id = $publisher_id;
    }

    public function getQtyOrdered()
    {
        return $this->qty_ordered;
    }

    public function setQtyOrdered($qty_ordered): void
    {
        $this->qty_ordered = $qty_ordered;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status): void
    {
        $this->status = $status;
    }

    public function getDateRequested()
    {
        return $this->date_requested;
    }

    public function setDateRequested($date_requested): void
    {
        $this->date_requested = $date_requested;
    }

    public function getDateShipped()
    {
        return $this->date_shipped;
    }

    public function setDateShipped($date_shipped): void
    {
        $this->date_shipped = $date_shipped;
    }

}