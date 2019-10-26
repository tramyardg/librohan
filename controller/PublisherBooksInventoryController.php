<?php

class PublisherBooksInventoryController
{
    public function save(PublisherBooksInventory $inventory)
    {
        $sql = 'INSERT INTO `pb_books_inventory` (`pb_book_inv_id`, `book_id`, `publisher_id`, `qty_on_hand`, `qty_sold`) VALUES (?, ?, ?, ?, ?);';
        $stmt = DB::getInstance()->prepare($sql);
        $exec = $stmt->execute([
            $inventory->getPbBookInvId(),
            $inventory->getBookId(),
            $inventory->getPublisherId(),
            $inventory->getQtyOnHand(),
            $inventory->getQtySold()
        ]);
        echo json_encode(['result' => $exec]);
    }

    public function fetchPublisherBooksInv($id)
    {
        $sql = "SELECT * FROM pb_books_inventory WHERE publisher_id = ?;";
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, "PublisherBooksInventory");
    }

    public function fetchBooksWithQtyOfPublisher($id)
    {
        $bk = new BookController();
        $books = $bk->fetchBookByPublisherId($id);
        $out = null;
        foreach ($books as $k) {
            $item = [
                'book_id' => $k->getBookId(),
                'title' => $k->getTitle(),
                'isbn' => $k->getIsbn(),
                'edition' => $k->getEdition(),
                'price' => $k->getPrice(),
                'image' => $k->getImage(),
                'category' => $k->getCategory(),
                'qty_on_hand' => 0 // currently set to 0, will be overwritten immediately
            ];
            $out[] = $item;

        }
        // will give you both book details and quantity on hand of a product
        foreach ($this->fetchPublisherBooksInv($id) as $i => $k2) {
            $out[$i]['qty_on_hand'] = $k2->getQtyOnHand();
        }
        return $out;
    }

    public function update(PublisherOrderFulfillmentHelper $helper) {
        // qty sold = (qty on hand) - (qty ordered) <- publisher book inventory
        // qty on hand = previous qty on hand - (qty ordered) <- publisher book inventory
        $sql = 'UPDATE `pb_books_inventory` 
                SET `qty_on_hand` = `qty_on_hand` - ?, `qty_sold` = `qty_sold` + ? 
                WHERE book_id = ? 
                AND publisher_id = ?;';
        $stmt = DB::getInstance()->prepare($sql);
        $exec = $stmt->execute([
            $helper->getQtyOrdered(),
            $helper->getQtyOrdered(),
            $helper->getBookId(),
            $helper->getPublisherId()
        ]);
        return ['result' => $exec];
    }

    public function updateQtyOnHand($qty, $bookId, $publisherId)
    {
        $sql = 'UPDATE `pb_books_inventory` 
                SET `qty_on_hand` = `qty_on_hand` + ?
                WHERE book_id = ? 
                AND publisher_id = ?;';
        $stmt = DB::getInstance()->prepare($sql);
        return $stmt->execute([$qty, $bookId, $publisherId]);
    }
}