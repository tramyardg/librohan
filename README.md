# Setup
1. Download or clone this repo.
- https://github.com/tramyardg/librohan.git
2. Configure [`database.ini`](https://github.com/tramyardg/librohan/blob/master/database.ini) file to match your MySQL database environment
```
; MySQL database configuration file

host = "localhost"
port = "3306"
user = "root"
password = ""
dbname = "librohandb"
charset = "UTF-8"
```
3. Import [`schema.sql`](https://github.com/tramyardg/librohan/blob/master/db/schema.sql) to phpMyadmin or copy and paste it to MySQL terminal
4. You can then access the app here: http://localhost/librohan/index.php

## Functionalities and Features
- The bookstore's employee can order books from several publishers.
- A customer can make an order, if the book is not available in the inventory a backorder is created.
- An employee is responsible for managing the customer order(s), as well as managing the bookstore's inventory of book.
- A book may appear on several orders by different customers and order may include several books.
- An employee can receive a shipment of books from the publisher.
- A publisher can ship orders made by a bookstore employee.
- A publisher can create/modify a new book and add it to its inventory.
- A book can have more than one authors.
- An account (Login/Logout) system for customers, bookstore employees, and publishers.
- Book cart and order history. 
 