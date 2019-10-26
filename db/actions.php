<?php


require 'DB.php';


if (isset($_GET['drop']) && $_GET['drop'] == 'all')
{
    $sql = file_get_contents('drop.sql');
    $instance = DB::getInstance()->query($sql);
    $instance->execute();
    echo 'all tables dropped';
}

if (isset($_GET['create']) && $_GET['create'] == 'all')
{
    $sql = file_get_contents('schema.sql');
    $instance = DB::getInstance()->query($sql);
    $instance->execute();
    echo 'all tables created';
}

if (isset($_GET['insert']) && $_GET['insert'] == 'all')
{
    $sql = file_get_contents('data.sql');
    $instance = DB::getInstance()->query($sql);
    $instance->execute();
    echo 'all data inserted';
}

if (isset($_GET['show']) && $_GET['show'] == 'all')
{
    showTables();
}

function showTables()
{
    $instance = DB::getInstance()->query('SHOW TABLES;');
    echo '<pre>';
    $showSql = $instance->fetchAll();
    print_r($showSql);
}