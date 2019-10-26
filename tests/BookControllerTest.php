<?php
require '../db/DB.php';
require '../model/Book.php';
require '../controller/BookController.php';

require '../model/Enum.php';
require '../model/BookCategory.php';

class BookControllerTest extends PHPUnit_Framework_TestCase
{
    private $book;

    public function setUp()
    {
        $this->book = new Book();
        $this->book->setIsbn("AAAtestBBB");
        $this->book->setTitle("test");
        $this->book->setEdition(2);
        $this->book->setPrice("123");
        $this->book->setPublisherId(1);
        $this->book->setCategory(1);
    }

    public function testFetchBooks()
    {
        $controller = new BookController();
        print_r($controller->fetchBooks());
    }

    public function testFetchBookById()
    {
        $controller = new BookController();
        print_r($controller->fetchBookById(1));
    }

    public function testSave()
    {
        $controller = new BookController();
        $controller->save($this->book);
    }

    public function testFetchBookByCategory()
    {
        $controller = new BookController();
        $biographyBooks = $controller->fetchBookByCategory(BookCategory::Biography);
        print_r($biographyBooks);
    }

}
