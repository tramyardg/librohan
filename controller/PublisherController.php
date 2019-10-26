<?php

class PublisherController
{
    public function __construct()
    {
    }

    public function fetchPublishers()
    {
        $sql = "SELECT * FROM publishers;";
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, "Publisher");
    }

    public function fetchPublisherById($id)
    {
        $sql = "SELECT * FROM publishers WHERE publisher_id = ?;";
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, "Publisher");
    }

    public function fetchPublisherByEmail($email)
    {
        $sql = "SELECT * FROM publishers WHERE email = ?;";
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, "Publisher");
    }

    public function fetchBookPublisherInventory()
    {
        $sql = "SELECT
                    b.book_id,
                    b.isbn,
                    b.title,
                    b.edition,
                    b.price,
                    b.image,
                    b.category,
                    p.publisher_id,
                    p.company_name,
                    bi.qty_on_hand
                FROM
                    books b,
                    publishers p,
                    books_inventory bi
                WHERE
                    b.publisher_id = p.publisher_id
                    AND b.book_id = bi.book_id
                GROUP BY
                    bi.qty_on_hand;";
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

}