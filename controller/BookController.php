<?php


class BookController
{
    public function __construct()
    {
    }

    public function fetchBooks()
    {
        $sql = "SELECT * 
                FROM `books` 
                LEFT JOIN `book_authors` 
                    ON books.book_id = book_authors.book_id
                LEFT JOIN `authors` 
                    ON book_authors.author_id = authors.author_id
                LEFT JOIN `books_inventory`
                    ON books.book_id = books_inventory.book_id
                GROUP BY books.book_id";
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS,"Book");
    }

    public function fetchBookById($id)
    {
        $sql = "SELECT * FROM books WHERE book_id = ?;";
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, "Book");
    }

    public function fetchBookByCategory($n)
    {
        $sql = "SELECT * FROM books WHERE category = ?;";
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->execute([$n]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, "Book");
    }

    public function save(Book $book)
    {
        $sql = 'INSERT INTO `books` (`isbn`, `title`, `edition`, `price`, `publisher_id`, `image`, `category`) VALUES (?, ?, ?, ?, ?, ?, ?)';
        $stmt = DB::getInstance()->prepare($sql);
        $exec = $stmt->execute(
            array(
                $book->getIsbn(),
                $book->getTitle(),
                $book->getEdition(),
                $book->getPrice(),
                $book->getPublisherId(),
                $book->getImage(),
                $book->getCategory()
            )
        );
        echo json_encode(array('result' => $exec));
    }

    public function fetchBookByPublisherId($id)
    {
        $sql = 'SELECT * FROM books WHERE publisher_id = ?;';
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, "Book");
    }

    public function updatePriceEdition($price, $edition, $bookId, $publisherId)
    {
        $sql = 'UPDATE `books` 
                SET `edition` = ?, `price` = ? 
                WHERE book_id = ? 
                AND publisher_id = ?;';
        $stmt = DB::getInstance()->prepare($sql);
        return $stmt->execute([$edition, $price, $bookId, $publisherId]);
    }
}