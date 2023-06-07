CREATE DATABASE wallet_manager;

USE wallet_manager;

CREATE TABLE users (
	userID INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(100),
    password INT,
    PRIMARY KEY (userID)
);

CREATE TABLE wallets (
	walletID INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(100),
    amount DECIMAL(64, 2),
    PRIMARY KEY (walletID),
	userID INT NOT NULL
);

CREATE TABLE categories (
	categoryID INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(100),
    description TEXT,
	PRIMARY KEY (categoryID),
    budget DECIMAL(64, 2)
);

CREATE TABLE wallet_category ( -- many to many relationship
	temp INT
)


-- DROP TABLE users;
-- DROP TABLE wallets;
-- DROP TABLE categories;
-- DROP TABLE wallet_category;