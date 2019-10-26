<?php
require '../db/DB.php';
require '../model/Author.php';
require '../controller/AuthorController.php';


class AuthorControllerTest extends PHPUnit_Framework_TestCase
{
    public function testGetAuthorsByBookId()
    {
        $controller = new AuthorController();
        print_r($controller->getAuthorsByBookId(1));
    }

    public function testViewAuthors()
    {
        $controller = new AuthorController();
        echo $controller->viewAuthors(1);
    }

    public function testFetchAuthors()
    {
        $controller = new AuthorController();
        print_r($controller->fetchAuthors());
    }

    public function testGetBookIdsWithNames()
    {
        $controller = new AuthorController();
        print_r($controller->getBookAuthors());
    }

}
