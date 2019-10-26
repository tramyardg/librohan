<?php
require '../db/DB.php';

require '../model/BackOrder.php';
require '../controller/BackOrderController.php';


class BackOrderControllerTest extends PHPUnit_Framework_TestCase
{

    public function testIsBackOrderIdExists()
    {
        $c = new BackOrderController();
        // A
        echo strlen($c->isIdExists(2)) > 0 ? 'it exists' : 'it does NOT exists';
        // B
        if ($c->isIdExists(2)) {
            echo 'true';
        } else {
            echo 'false';
        }
    }

}
