<?php


class Book implements JsonSerializable
{
    private $book_id;
    private $isbn;
    private $title;
    private $edition;
    private $price;
    private $image;
    private $category;
    private $publisher_id;

    public function getBookId()
    {
        return $this->book_id;
    }

    public function setBookId($book_id)
    {
        $this->book_id = $book_id;
    }

    public function getIsbn()
    {
        return $this->isbn;
    }

    public function setIsbn($isbn)
    {
        $this->isbn = $isbn;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getEdition()
    {
        return $this->edition;
    }

    public function setEdition($edition)
    {
        $this->edition = $edition;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory($category)
    {
        $this->category = $category;
    }

    public function getPublisherId()
    {
        return $this->publisher_id;
    }

    public function setPublisherId($publisher_id)
    {
        $this->publisher_id = $publisher_id;
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}