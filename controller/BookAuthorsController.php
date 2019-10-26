<?php


class BookAuthorsController
{

    /**
     * BookAuthorsController constructor.
     */
    public function __construct()
    {
    }

    public function save(BookAuthors $bookAuthors)
    {
        $sql = 'INSERT INTO book_authors (`book_id`, `author_id`) VALUES (?, ?);';
        $stmt = DB::getInstance()->prepare($sql);
        $exec = $stmt->execute([$bookAuthors->getBookId(), $bookAuthors->getAuthorId()]);
        echo json_encode(['result' => $exec]);
    }
}