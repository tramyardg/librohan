<?php

class AuthorController
{
    public function __construct()
    {
    }

    public function fetchAuthors()
    {
        $sql = "SELECT * FROM authors;";
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, "Author");
    }

    // get authors of a book given a book id
    public function getAuthorsByBookId($id)
    {
        $sql = 'SELECT first_name, middle_name, last_name, bio
                FROM authors a, book_authors ba
                WHERE ba.author_id = a.author_id AND ba.book_id = ?;';
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->execute([$id]);

        // returns an array of authors object
        return $stmt->fetchAll(PDO::FETCH_CLASS, "Author");
    }

    public function viewAuthors($bookId)
    {
        $authorsOfThisBook = [];
        $authors = $this->getAuthorsByBookId($bookId);
        $out = null;
        foreach ($authors as $v) {
            $authorsOfThisBook[] = $v;
        }

        $names = [];
        for ($i = 0; $i < sizeof($authorsOfThisBook); $i++)
        {
            $a = new Author();
            $a = $authorsOfThisBook[$i];
            $names[] = $a->getFirstName() . ' ' . $a->getMiddleName() . ' ' . $a->getLastName();
        }
        return implode(', ', $names);
    }

    public function getBookIds()
    {
        $sql = "SELECT book_id as id FROM books ORDER BY book_id;";
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getBookAuthors()
    {
        $ids = $this->getBookIds();
        $authorNames = [];
        for ($i = 0; $i < sizeof($ids); $i++)
        {
            $item = [
                'book_id' => $ids[$i]['id'],
                'names' => $this->viewAuthors($ids[$i]['id'])
            ];
            $authorNames[] = $item;
        }
        return $authorNames;
    }
}