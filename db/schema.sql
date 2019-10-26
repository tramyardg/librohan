CREATE TABLE IF NOT EXISTS `employees`
(
  `emp_id`       INT(4) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `emp_name`     VARCHAR(50)        NOT NULL,
  `ssn`          VARCHAR(10)        NOT NULL,
  `phone_number` VARCHAR(20),
  `email`        VARCHAR(50)        NOT NULL,
  `password`     VARCHAR(50)        NOT NULL,
  `address`      VARCHAR(100),
  `is_admin`     CHAR(1)            DEFAULT '0'
);

CREATE TABLE IF NOT EXISTS `customers`
(
  `customer_id`   INT(4) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `customer_name` VARCHAR(50)        NOT NULL,
  `email`         VARCHAR(50)        NOT NULL,
  `password`      VARCHAR(50)        NOT NULL,
  `phone_number`  VARCHAR(20),
  `address`       VARCHAR(100)
);

CREATE TABLE IF NOT EXISTS `authors`
(
  `author_id`   INT(4) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `first_name`  VARCHAR(50)        NOT NULL,
  `middle_name` VARCHAR(5)    DEFAULT NULL,
  `last_name`   VARCHAR(50)        NOT NULL,
  `bio`         VARCHAR(2000) DEFAULT NULL
);

CREATE TABLE IF NOT EXISTS `publishers`
(
  `publisher_id` INT(4) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `company_name` VARCHAR(50)        NOT NULL,
  `phone_number` VARCHAR(20),
  `email`        VARCHAR(50),
  `password`     VARCHAR(50)        NOT NULL,
  `address`      VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS `books`
(
  `book_id`      INT(4) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `isbn`         VARCHAR(20)        NOT NULL,
  `title`        VARCHAR(250)       NOT NULL,
  `edition`      INT                                 DEFAULT 0,
  `price`        DOUBLE(8, 2),
  `publisher_id` INT(4)             NOT NULL,
  `image`        BLOB                                DEFAULT NULL,
  `category`     ENUM ('0', '1', '2', '3', '4', '5') DEFAULT NULL,
  FOREIGN KEY (`publisher_id`) REFERENCES `publishers` (`publisher_id`)
);

# a book can have many authors (one-to-many)
CREATE TABLE IF NOT EXISTS `book_authors`
(
  `book_authors_id` INT(4) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `book_id`         INT(4),
  `author_id`       INT(4)
);

# one-to-one relationship with books
# thus, you can use either book_id or book_inv_id
CREATE TABLE IF NOT EXISTS `books_inventory`
(
  `book_inv_id` INT(4) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `book_id`     INT(4)             NOT NULL,
  `qty_on_hand` INT,
  `qty_sold`    INT,
  FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`)
);

CREATE TABLE IF NOT EXISTS pb_books_inventory
(
  `pb_book_inv_id` INT(4) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `book_id`        INT(4)             NOT NULL,
  `publisher_id`   INT(4),
  `qty_on_hand`    INT,
  `qty_sold`       INT,
  FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`),
  FOREIGN KEY (`publisher_id`) REFERENCES `books` (`publisher_id`)
);

## create a table in customer page to display the content of this table
## check the quantity on hand in the inventory
## if a book ordered become available make customer see it by displaying another column called 'availability'
CREATE TABLE IF NOT EXISTS `back_orders`
(
    `back_order_id` INT(4) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `customer_id`   INT(4)             NOT NULL,
    `book_id`       INT(4)             NOT NULL, ##
    `order_date`    DATE               NOT NULL,
    `quantity`      INT                NOT NULL,
    FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`),
    FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`)
);

## assumed the customer orders and pays at the same day, therefore, payment date not required
## date_received and status are updated with the date when employee
## sends the order (update the status to SHIPPED) -> one day shipping
CREATE TABLE IF NOT EXISTS `orders`
(
    `order_id`      INT(4) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `customer_id`   INT(4)             NOT NULL,
    `order_date`    DATE               NOT NULL,
    `date_received` DATE                          DEFAULT '0000-00-00',
    `status`        ENUM ('PROCESSING','SHIPPED') DEFAULT 'PROCESSING',
    `total`         DOUBLE(8, 2),
    FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`)
);

## you can get the total amount paid by a customer by
## joining this table and book table
CREATE TABLE IF NOT EXISTS `order_items`
(
    `order_item_id` INT(4) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `order_id`      INT(4)             NOT NULL,
    `book_id`       INT(4)             NOT NULL,
    `quantity`      INT                NOT NULL,
    FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
    FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`)
);

CREATE TABLE IF NOT EXISTS `branches`
(
  `branch_id`      INT(4) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `publisher_id`   INT(4)             NOT NULL,
  `branch_name`    VARCHAR(50)        NOT NULL,
  `branch_manager` VARCHAR(50),
  `phone_number`   VARCHAR(20),
  `email`          VARCHAR(50),
  `address`        VARCHAR(250),
  FOREIGN KEY (`publisher_id`) REFERENCES `publishers` (`publisher_id`)
);

## a copy of what employee/bookstore ordered
## employee can only receive a shipment when a publisher set the status to `SHIPPED`
## changed is_received to (processing, shipped) status to reflect the same status of publisher_orders
CREATE TABLE IF NOT EXISTS `bookstore_orders`
(
    `bookstore_order_id` INT(4) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `book_id`            INT(4)             NOT NULL,
    `publisher_id`       INT(4)             NOT NULL,
    `qty_ordered`        INT                NOT NULL,
    `status`             ENUM ('PROCESSING','SHIPPED') DEFAULT 'PROCESSING',
    `date_requested`     DATE,
    `period_specified`   DATE, ## date_requested + 2 weeks
    `date_shipped`       DATE                          DEFAULT '0000-00-00',
    FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`),
    FOREIGN KEY (`publisher_id`) REFERENCES `publishers` (`publisher_id`)
);

ALTER TABLE book_authors ADD CONSTRAINT book_authors_book_id_foreign_k
  FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`);

ALTER TABLE book_authors ADD CONSTRAINT book_authors_author_id_foreign_k
  FOREIGN KEY (`author_id`) REFERENCES `authors` (`author_id`);

ALTER TABLE authors
  AUTO_INCREMENT = 1;
ALTER TABLE books
  AUTO_INCREMENT = 1;
ALTER TABLE book_authors
  AUTO_INCREMENT = 1;
ALTER TABLE books_inventory
  AUTO_INCREMENT = 1;
ALTER TABLE branches
  AUTO_INCREMENT = 1;
ALTER TABLE customers
  AUTO_INCREMENT = 1;
ALTER TABLE employees
  AUTO_INCREMENT = 1;
ALTER TABLE order_items
  AUTO_INCREMENT = 1;
ALTER TABLE orders
  AUTO_INCREMENT = 1;
ALTER TABLE publishers
  AUTO_INCREMENT = 1;
ALTER TABLE bookstore_orders
  AUTO_INCREMENT = 1;
ALTER TABLE pb_books_inventory
  AUTO_INCREMENT = 1;
