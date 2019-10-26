<?php


class PublisherOrderFulfillmentHelper
{
    private $bookstoreOrderId;
    private $publisherId;
    private $bookId;
    private $dateShipped;
    private $status;
    private $qtyOrdered;

    public function getBookstoreOrderId()
    {
        return $this->bookstoreOrderId;
    }

    public function setBookstoreOrderId($bookstoreOrderId): void
    {
        $this->bookstoreOrderId = $bookstoreOrderId;
    }

    public function getPublisherId()
    {
        return $this->publisherId;
    }

    public function setPublisherId($publisherId): void
    {
        $this->publisherId = $publisherId;
    }

    public function getBookId()
    {
        return $this->bookId;
    }

    public function setBookId($bookId): void
    {
        $this->bookId = $bookId;
    }

    public function getDateShipped()
    {
        return $this->dateShipped;
    }

    public function setDateShipped($dateShipped): void
    {
        $this->dateShipped = $dateShipped;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status): void
    {
        $this->status = $status;
    }

    public function getQtyOrdered()
    {
        return $this->qtyOrdered;
    }

    public function setQtyOrdered($qtyOrdered): void
    {
        $this->qtyOrdered = $qtyOrdered;
    }
}