
USE phkl16;
SET NAMES utf8;



-- ------------------------------------------------------------------------
--
-- Setup tables
--
DROP TABLE IF EXISTS `Prod2Cat`;
DROP TABLE IF EXISTS `ProdCategory`;
DROP TABLE IF EXISTS `Inventory`;
DROP TABLE IF EXISTS `InvenShelf`;
DROP TABLE IF EXISTS `OrderRow`;
DROP TABLE IF EXISTS `Cart`;
DROP TABLE IF EXISTS `Order`;
DROP TABLE IF EXISTS `Product`;
DROP TABLE IF EXISTS `Customer`;



-- ------------------------------------------------------------------------
--
-- Product and product category
--
CREATE TABLE `ProdCategory` (
	`id` INT AUTO_INCREMENT,
	`category` CHAR(10),

	PRIMARY KEY (`id`)
);

CREATE TABLE `Product` (
	`id` INT AUTO_INCREMENT,
    `description` VARCHAR(20),
    `image` VARCHAR(20),
    `price` INT,
    `status` VARCHAR(20),

	PRIMARY KEY (`id`)
);

CREATE TABLE `Prod2Cat` (
	`id` INT AUTO_INCREMENT,
	`prod_id` INT,
	`cat_id` INT,

	PRIMARY KEY (`id`),
    FOREIGN KEY (`prod_id`) REFERENCES `Product` (`id`) ON DELETE CASCADE,
    FOREIGN KEY (`cat_id`) REFERENCES `ProdCategory` (`id`)
);



-- ------------------------------------------------------------------------
--
-- Inventory and shelfs
--
CREATE TABLE `InvenShelf` (
    `shelf` CHAR(6),
    `description` VARCHAR(40),

	PRIMARY KEY (`shelf`)
);

CREATE TABLE `Inventory` (
	`id` INT AUTO_INCREMENT,
    `prod_id` INT,
    `shelf_id` CHAR(6),
    `items` INT,

	PRIMARY KEY (`id`),
	FOREIGN KEY (`prod_id`) REFERENCES `Product` (`id`),
	FOREIGN KEY (`shelf_id`) REFERENCES `InvenShelf` (`shelf`)
);




-- ------------------------------------------------------------------------
--
-- Customer
--
CREATE TABLE `Customer` (
	`id` INT AUTO_INCREMENT,
    `firstName` VARCHAR(20),
    `lastName` VARCHAR(20),

	PRIMARY KEY (`id`)
);


-- ------------------------------------------------------------------------
--
-- Cart
--

CREATE TABLE `Cart` (
	`id` INT AUTO_INCREMENT,
    `customer` INT,
    `product` INT,
	`items` INT,

	PRIMARY KEY (`id`),
	FOREIGN KEY (`customer`) REFERENCES `Customer` (`id`),
	FOREIGN KEY (`product`) REFERENCES `Product` (`id`)
);


-- ------------------------------------------------------------------------
--
-- Order
--
CREATE TABLE `Order` (
	`id` INT AUTO_INCREMENT,
    `customer` INT,
	`created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	`deleted` DATETIME DEFAULT NULL,
	`delivery` DATETIME DEFAULT NULL,

	PRIMARY KEY (`id`),
	FOREIGN KEY (`customer`) REFERENCES `Customer` (`id`)
);

CREATE TABLE `OrderRow` (
	`id` INT AUTO_INCREMENT,
    `order` INT,
    `product` INT,
	`items` INT,

	PRIMARY KEY (`id`),
	FOREIGN KEY (`order`) REFERENCES `Order` (`id`),
	FOREIGN KEY (`product`) REFERENCES `Product` (`id`)
);


--
-- Log table
--
DROP TABLE IF EXISTS InventoryLog;
CREATE TABLE InventoryLog
(
    `id` INTEGER PRIMARY KEY AUTO_INCREMENT,
    `prod_id` INT,
    `when` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `amount` INT
);

SELECT * FROM InventoryLog;


-- ------------------------------------------------------------------------
--
-- By some stuff to get it up and running,
-- the first truck has arrived and you need to
-- insert the details into you database.
--

-- ------------------------------------------------------------------------
--
-- Start with the product catalogue
--
INSERT INTO `ProdCategory` (`category`) VALUES
("consoles"), ("games")
;


--
-- View connecting products with their category
--
DROP VIEW IF EXISTS VProducts;
CREATE VIEW VProducts AS
SELECT
	P.id,
    P.description,
    P.price,
    P.image,
    P.status,
    GROUP_CONCAT(category) AS category
FROM Product AS P
	INNER JOIN Prod2Cat AS P2C
		ON P.id = P2C.prod_id
	INNER JOIN ProdCategory AS PC
		ON PC.id = P2C.cat_id
GROUP BY P.id
ORDER BY P.description
;

SELECT * FROM VProducts;



SELECT * FROM Inventory;

-- ------------------------------------------------------------------------
--
-- The truck has arrived, put the stuff into shelfs and update the database
--
INSERT INTO `InvenShelf` (`shelf`, `description`) VALUES
("AAA101", "House A, aisle A, part A, shelf 101"),
("AAA102", "House A, aisle A, part A, shelf 102")
;


-- ------------------------------------------------------------------------
--
-- The customers are arriving
--
INSERT INTO `Customer` (`firstName`, `lastName`) VALUES
("Mumin", "Trollet"),
("Mamma", "Mumin"),
("Pappa", "Mumin")
;



DROP PROCEDURE IF EXISTS createProduct;

DELIMITER //
CREATE PROCEDURE createProduct(
    description VARCHAR(20),
    image VARCHAR(20),
    price INT,
    prodStatus VARCHAR(20),
    category INT
)
BEGIN
    START TRANSACTION;
	INSERT INTO `Product` (`description`, `image`, `price`, `status`) VALUES
	(description, image, price, prodStatus);

    INSERT INTO `Prod2Cat` (`prod_id`, `cat_id`) VALUES
    (last_insert_id(), category);

    INSERT INTO `Inventory` (`prod_id`, `shelf_id`, `items`) VALUES
	(last_insert_id(), CONCAT("AAA10", category), 100);
    COMMIT;
END
//
DELIMITER ;


DROP PROCEDURE IF EXISTS getProduct;

DELIMITER //
CREATE PROCEDURE getProduct(
    prod_id INT
)
BEGIN
    START TRANSACTION;

	SELECT
	P.id,
    P.description,
    P.image,
    P.price,
    P.status,
	GROUP_CONCAT(category) AS category
    FROM Product AS P
    INNER JOIN Prod2Cat AS P2C
		ON P.id = P2C.prod_id
	INNER JOIN ProdCategory AS PC
		ON PC.id = P2C.cat_id
	WHERE P.id = prod_id;
    COMMIT;
END
//
DELIMITER ;


DROP PROCEDURE IF EXISTS updateProduct;

DELIMITER //
CREATE PROCEDURE updateProduct(
	product_id INT,
    description VARCHAR(20),
    image VARCHAR(20),
    price INT,
    prodStatus VARCHAR(20),
    category INT
)
BEGIN
    START TRANSACTION;
	UPDATE Product
    SET `description` = description,
    `image` = image,
    `price` = price,
    `status` = prodStatus
    WHERE id = product_id;
    UPDATE Prod2Cat
    SET cat_id = category
    WHERE prod_id = product_id;
    COMMIT;
END
//
DELIMITER ;

DROP PROCEDURE IF EXISTS deleteProduct;

DELIMITER //
CREATE PROCEDURE deleteProduct(
	product_id INT
)
BEGIN
    START TRANSACTION;

	DELETE FROM Prod2Cat
    WHERE prod_id = product_id;

    DELETE FROM Inventory
    WHERE prod_id = product_id;

    DELETE FROM Product
    WHERE id = product_id;



    COMMIT;
END
//
DELIMITER ;

DROP PROCEDURE IF EXISTS updateInventory;

DELIMITER //
CREATE PROCEDURE updateInventory(
	product_id INT,
    shelf_id CHAR(6),
    items INT
)
BEGIN
    START TRANSACTION;
	UPDATE Inventory
    SET `shelf_id` = shelf_id,
    `items` = items
    WHERE prod_id = product_id;
    COMMIT;
END
//
DELIMITER ;


DROP PROCEDURE IF EXISTS decreaseInventory;

DELIMITER //
CREATE PROCEDURE decreaseInventory(
	product_id INT,
    amount INT
)
BEGIN
    START TRANSACTION;
	UPDATE Inventory
    SET items = items - amount
    WHERE prod_id = product_id;
    COMMIT;
END
//
DELIMITER ;


DROP PROCEDURE IF EXISTS increaseInventory;

DELIMITER //
CREATE PROCEDURE increaseInventory(
	product_id INT,
    amount INT
)
BEGIN
    START TRANSACTION;
	UPDATE Inventory
    SET items = items + amount
    WHERE prod_id = product_id;
    COMMIT;
END
//
DELIMITER ;


DROP PROCEDURE IF EXISTS getInventory;

DELIMITER //
CREATE PROCEDURE getInventory(
    product_id INT
)
BEGIN
    START TRANSACTION;
	SELECT
	shelf_id,
    items,
    prod_id
    FROM Inventory
	WHERE prod_id = product_id;
    COMMIT;
END
//
DELIMITER ;

--
-- Trigger for logging updating balance
--
DROP TRIGGER IF EXISTS inventoryNewOrder;

DELIMITER //

CREATE TRIGGER inventoryNewOrder
BEFORE UPDATE
ON Inventory FOR EACH ROW
	IF NEW.items < 5 THEN
    INSERT INTO InventoryLog (`prod_id`, `amount`)
        VALUES (NEW.prod_id, NEW.items);
	END IF;
//
DELIMITER ;

DROP PROCEDURE IF EXISTS addToCart;

DELIMITER //
CREATE PROCEDURE addToCart(
    customerId INT,
    productId INT,
    items INT

)
BEGIN
    START TRANSACTION;

    INSERT INTO `Cart` (`customer`, `product`, `items`) VALUES
    (customerId, productId, items);

    COMMIT;
END
//
DELIMITER ;

DROP PROCEDURE IF EXISTS removeFromCart;

DELIMITER //
CREATE PROCEDURE removeFromCart(
    customerId INT,
    productId INT

)
BEGIN
    START TRANSACTION;
    DELETE FROM Cart
    WHERE customer = customerId AND product = productId;

    COMMIT;
END
//
DELIMITER ;

DROP PROCEDURE IF EXISTS getCart;

DELIMITER //
CREATE PROCEDURE getCart(
    customerId INT

)
BEGIN
	SELECT * FROM Cart WHERE `customer` = customerId;
END
//
DELIMITER ;


DROP PROCEDURE IF EXISTS createOrder;


DELIMITER //
CREATE PROCEDURE createOrder(
    customerId INT

)
BEGIN
	DECLARE counter INT DEFAULT 0;
    START TRANSACTION;
    INSERT INTO `Order` (`customer`) VALUES
    (customerId);
    SET @last_id_in_order = LAST_INSERT_ID();
    INSERT INTO `OrderRow` (`order`, `product`, `items`)
	SELECT @last_id_in_order, `product`, `items`
    FROM `Cart`
    WHERE `customer` = customerId;
    SET @n = (SELECT COUNT(*) FROM Cart WHERE `customer` = customerId);
    WHILE counter <	@n do
		CALL decreaseInventory((SELECT `product` FROM Cart WHERE `customer` = customerId LIMIT 1 OFFSET counter),
		(SELECT `items` FROM Cart WHERE `customer` = customerId LIMIT 1 OFFSET counter));
		SET counter = counter + 1;
     END WHILE;
    COMMIT;
END
//
DELIMITER ;

DROP PROCEDURE IF EXISTS deleteOrder;

DELIMITER //
CREATE PROCEDURE deleteOrder(
    orderId INT

)
BEGIN
	DECLARE counter INT DEFAULT 0;
    START TRANSACTION;

    SET @n = (SELECT COUNT(*) FROM OrderRow WHERE `order` = orderId);
    WHILE counter <	@n do
		CALL increaseInventory((SELECT `product` FROM OrderRow WHERE `order` = orderId LIMIT 1 OFFSET counter),
		(SELECT `items` FROM OrderRow WHERE `order` = orderId LIMIT 1 OFFSET counter));
		SET counter = counter + 1;
     END WHILE;

    DELETE FROM OrderRow
    WHERE `order` = orderId;

    DELETE FROM `Order`
    WHERE id = orderId;

    COMMIT;
END
//
DELIMITER ;


DROP PROCEDURE IF EXISTS getOrder;

DELIMITER //
CREATE PROCEDURE getOrder(
    orderId INT

)
BEGIN
	SELECT * FROM OrderRow WHERE `order` = orderId;
END
//
DELIMITER ;


DELIMITER //

DROP FUNCTION IF EXISTS checkStock //
CREATE FUNCTION checkStock(
    items INTEGER
)
RETURNS VARCHAR(30)
BEGIN
	IF items <= 5 THEN
        RETURN "Need to order more items";
    END IF;
    RETURN "No need to order more items";
END
//

DELIMITER ;

SELECT *, checkStock(items) AS 'Status' FROM Inventory;
--
-- View connecting products with their place in the inventory
-- and offering reports for inventory and sales personal.
--
DROP VIEW IF EXISTS VInventory;
CREATE VIEW VInventory AS
SELECT
	S.shelf,
    S.description AS location,
    I.items,
    P.description,
    P.id
FROM Inventory AS I
	INNER JOIN InvenShelf AS S
		ON I.shelf_id = S.shelf
	INNER JOIN Product AS P
		ON P.id = I.prod_id
ORDER BY S.shelf
;

SELECT * FROM VInventory;
SELECT description, items, shelf, location FROM VInventory;

--
-- Calling on the stored procedures
--


CALL createProduct("Playstation 4", "playstation.jpg", 2790, "In store", 1);
CALL createProduct("Xbox One", "xbox.jpg", 2490, "In store" , 1);
CALL createProduct("Nintendo Switch", "noimage.png",  3690, "In store", 1);
CALL createProduct("Uncharted 4", "noimage.png", 469, "In store", 2);
CALL createProduct("Fifa 17", "noimage.png", 565, "In store", 2);
CALL createProduct("Zelda", "noimage.png", 500, "In store", 2);

CALL updateProduct(5, "Fifa 17", "fifa", 555, "In store", 2);
CALL getProduct(5);
CALL deleteProduct(1);


CALL decreaseInventory(5, 4);
CALL getInventory(7);
CALL updateInventory(7, "AAA102", 4);

CALL addToCart(1, 7, 5);
CALL addToCart(2, 1, 3);
CALL addToCart(2, 5, 1);
CALL removeFromCart(2, 5);

CALL createOrder(1);
CALL createOrder(2);

CALL deleteOrder(1);

CALL getOrder(2);


SELECT * FROM Inventory;
SELECT * FROM OrderRow;
