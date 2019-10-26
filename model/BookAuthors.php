<?php


class BookAuthors implements JsonSerializable
{
    private $book_authors_id;
    private $book_id;
    private $author_id;

    public function getBookAuthorsId()
    {
        return $this->book_authors_id;
    }

    public function setBookAuthorsId($book_authors_id): void
    {
        $this->book_authors_id = $book_authors_id;
    }

    public function getBookId()
    {
        return $this->book_id;
    }

    public function setBookId($book_id): void
    {
        $this->book_id = $book_id;
    }

    public function getAuthorId()
    {
        return $this->author_id;
    }

    public function setAuthorId($author_id): void
    {
        $this->author_id = $author_id;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}
