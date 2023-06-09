CREATE DATABASE wallet_manager;

USE wallet_manager;

CREATE TABLE users (
	userID VARCHAR(255) NOT NULL,
	name VARCHAR(100),
	password VARCHAR(255),
	PRIMARY KEY (userID)
);

CREATE TABLE wallets (
	walletID VARCHAR(255) NOT NULL,
	name VARCHAR(100),
	amount DECIMAL(64, 2),
	PRIMARY KEY (walletID),

	userID VARCHAR(255) NOT NULL,
	FOREIGN KEY (userID) REFERENCES users(userID) ON DELETE CASCADE
);

CREATE TABLE categories (
	categoryID VARCHAR(255) NOT NULL,
	name VARCHAR(100),
	description TEXT,
	budget DECIMAL(64, 2),
	PRIMARY KEY (categoryID),
	
	userID VARCHAR(255),
	FOREIGN KEY (userID) REFERENCES users(userID) ON DELETE CASCADE
);

CREATE TABLE wallet_category ( -- (many to many relationship)
	walletID VARCHAR(255),
	categoryID VARCHAR(255),
	FOREIGN KEY(walletID) REFERENCES wallets(walletID),
	FOREIGN KEY(categoryID) REFERENCES categories(categoryID)
);

EXPLAIN users;
EXPLAIN wallets;
EXPLAIN catergories;
EXPLAIN wallet_category;

INSERT INTO users (userID, name, password) 
VALUES 
	("devHiu",		"Híu",			"Hiupass"),
	("devGau",		"Gâu",			"Gaupass"),
	("devMeu",		"Meu",			"Meupass"),
	("devEng",		"Én",			"Enpass")
;

INSERT INTO wallets (walletID, name, amount, userID) 
VALUES
	("devHiu_w0",		"Híu's Wallet",		0810,		"devHiu"),
	("devGau_w0",		"Gâu's Wallet",		2412,		"devGau"),
	("devMeu_w0",		"Meu's Wallet",		1401,		"devMeu"),
	("devEng_w0",		"Én's Wallet",		1404,		"devEng")
;

INSERT INTO categories (categoryID, name, description, budget) 
VALUES
	("cat_food",			"Food",				"Essential food",							200),
	("cat_snack",			"Snack",			"Fun food",									400),
	("cat_edu",				"Education",		"Tuition fee",								200),
	("cat_bill",			"Billings",			"Monthly billings and subscriptions",		400), -- 4
	("cat_fun",				"Fun Money",		"Self reward money",						200),
	("cat_upcorner",		"Upcorners",		"For unexpected things",					100),
	("cat_lend",			"Lending",			"Lending for other people",					800),
	("cat_invest",			"Investing",		"For S things",								120), -- 8
	("cat_donate",			"Donating",			"For M things",								240)
;


-- Hiện tại là các users có thể access toàn bộ categories
INSERT INTO wallet_category (walletID, categoryID)
VALUES
	("devHiu_w0", 		"cat_food"),
	("devHiu_w0", 		"cat_edu"),
	("devHiu_w0", 		"cat_bill"),
	("devHiu_w0", 		"cat_fun"),
	("devHiu_w0", 		"cat_upcorner"),
	("devHiu_w0", 		"cat_invest"),

	("devGau_w0", 		"cat_food"),
	("devGau_w0", 		"cat_snack"),
	("devGau_w0", 		"cat_edu"),
	("devGau_w0", 		"cat_bill"),
	("devGau_w0", 		"cat_fun"),
	("devGau_w0", 		"cat_lend"),

	("devMeu_w0", 		"cat_food"),
	("devMeu_w0", 		"cat_snack"),
	("devMeu_w0", 		"cat_fun"),
	("devMeu_w0", 		"cat_upcorner"),
	("devMeu_w0", 		"cat_invest"),

	("devEng_w0", 		"cat_food"),
	("devEng_w0", 		"cat_edu"),
	("devEng_w0", 		"cat_fun"),
	("devEng_w0", 		"cat_invest"),
	("devEng_w0", 		"cat_donate")
;



-- ALTER TABLE categories MODIFY COLUMN categoryID VARCHAR (255) NOT NULL;
-- ALTER TABLE wallets ADD FOREIGN KEY (userID) REFERENCES users(userID) ON DELETE CASCADE;
-- ALTER TABLE categories ADD FOREIGN KEY (userID) REFERENCES users(userID) ON DELETE CASCADE;

-- DELETE FROM users;
-- DELETE FROM wallets;
-- DELETE FROM categories;
-- DELETE FROM wallet_category;

-- DROP TABLE users;
-- DROP TABLE wallets;
-- DROP TABLE categories;
-- DROP TABLE wallet_category;