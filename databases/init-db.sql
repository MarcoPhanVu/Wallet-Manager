CREATE DATABASE wallet_manager;

USE wallet_manager;

CREATE TABLE users (
	userID VARCHAR(255) NOT NULL,
	name VARCHAR(100),
	password VARCHAR(255),
	PRIMARY KEY (userID)
    -- All CONSTRAINT of PK always named "PRIMARY"
);

CREATE TABLE wallets (
	walletID VARCHAR(255) NOT NULL,
	name VARCHAR(100),
	amount DECIMAL(36, 2),
	PRIMARY KEY (walletID),

	userID VARCHAR(255) NOT NULL,
	CONSTRAINT fk_userID_w FOREIGN KEY (userID) REFERENCES users(userID) ON DELETE CASCADE
);

CREATE TABLE categories (
	categoryID VARCHAR(255) NOT NULL,
	name VARCHAR(100),
	description TEXT,
	budget DECIMAL(36, 2),
	PRIMARY KEY (categoryID),
	
	userID VARCHAR(255),
	CONSTRAINT fk_userID_c FOREIGN KEY (userID) REFERENCES users(userID) ON DELETE CASCADE
);

CREATE TABLE wallet_category ( -- (many to many relationship)
	walletID VARCHAR(255),
	categoryID VARCHAR(255),
	CONSTRAINT fk_walletID_wc FOREIGN KEY(walletID) REFERENCES wallets(walletID),
	CONSTRAINT fk_categoryID_wc FOREIGN KEY(categoryID) REFERENCES categories(categoryID)
);

ALTER TABLE wallet_category ADD COLUMN connectionID INT(10) PRIMARY KEY;

CREATE TABLE transactions (
	transactionID VARCHAR(255),
	amount decimal(36, 2),
	description TEXT,
	date DATE,
	PRIMARY KEY (transactionID),

	-- userID VARCHAR(255), no need because wallet and category already linked to the user
	walletID VARCHAR(255),
	categoryID VARCHAR(255),
	CONSTRAINT fk_walletID_t FOREIGN KEY(walletID) REFERENCES wallets(walletID),
	CONSTRAINT fk_categoryID_t FOREIGN KEY(categoryID) REFERENCES categories(categoryID)
);

DESCRIBE transactions;

INSERT INTO users (userID, name, password) 
VALUES 
	("devHiu",		"Híu",		"Hiupass"),
	("devGau",		"Gâu",		"Gaupass"),
	("devMeu",		"Meu",		"Meupass"),
	("devEng",		"Én",		"Enpass")
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
INSERT INTO wallet_category (connectionID, walletID, categoryID)
VALUES
	("1", 		"devHiu_w0", 		"cat_food"),
	("2", 		"devHiu_w0", 		"cat_edu"),
	("3", 		"devHiu_w0", 		"cat_bill"),
	("4", 		"devHiu_w0", 		"cat_fun"),
	("5", 		"devHiu_w0", 		"cat_upcorner"),
	("6", 		"devHiu_w0", 		"cat_invest"),
	("7", 		"devGau_w0", 		"cat_food"),
	("8", 		"devGau_w0", 		"cat_snack"),
	("9", 		"devGau_w0", 		"cat_edu"),
	("10", 		"devGau_w0", 		"cat_bill"),
	("11", 		"devGau_w0", 		"cat_fun"),
	("12", 		"devGau_w0", 		"cat_lend"),
	("13", 		"devMeu_w0", 		"cat_food"),
	("14", 		"devMeu_w0", 		"cat_snack"),
	("15", 		"devMeu_w0", 		"cat_fun"),
	("16", 		"devMeu_w0", 		"cat_upcorner"),
	("17", 		"devMeu_w0", 		"cat_invest"),
	("18", 		"devEng_w0", 		"cat_food"),
	("19", 		"devEng_w0", 		"cat_edu"),
	("20", 		"devEng_w0", 		"cat_fun"),
	("21", 		"devEng_w0", 		"cat_invest"),
	("22", 		"devEng_w0", 		"cat_donate")
;		



-- ALTER TABLE categories MODIFY COLUMN categoryID VARCHAR (255) NOT NULL;
-- ALTER TABLE wallets ADD FOREIGN KEY (userID) REFERENCES users(userID) ON DELETE CASCADE;

-- DELETE FROM users;
-- DELETE FROM wallets;
-- DELETE FROM categories;
-- DELETE FROM wallet_category;

-- Gotta drop from child
-- DROP TABLE wallet_category;
-- DROP TABLE wallets;
-- DROP TABLE categories;
-- DROP TABLE users;