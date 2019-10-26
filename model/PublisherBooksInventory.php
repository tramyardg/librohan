<?php


class PublisherBooksInventory
{
    private $pb_book_inv_id;
    private $book_id;
    private $publisher_id;
    private $qty_on_hand;
    private $qty_sold;

    public function getPbBookInvId()
    {
        return $this->pb_book_inv_id;
    }

    public function setPbBookInvId($pb_book_inv_id): void
    {
        $this->pb_book_inv_id = $pb_book_inv_id;
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

    public function getQtyOnHand()
    {
        return $this->qty_on_hand;
    }

    public function setQtyOnHand($qty_on_hand): void
    {
        $this->qty_on_hand = $qty_on_hand;
    }

    public function getQtySold()
    {
        return $this->qty_sold;
    }

    public function setQtySold($qty_sold): void
    {
        $this->qty_sold = $qty_sold;
    }
}