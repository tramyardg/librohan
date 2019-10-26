<?php
require '../db/DB.php';
require '../model/Publisher.php';
require '../controller/PublisherController.php';

class PublisherControllerTest extends PHPUnit_Framework_TestCase
{
    public function testFetchPublishers()
    {
        $controller = new PublisherController();
        print $controller->fetchPublishers();
    }
}
