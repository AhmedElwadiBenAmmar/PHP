CREATE DATABASE wadi;
USE wadi;

CREATE TABLE users (
                       id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                       username VARCHAR(255) NOT NULL,
                       password VARCHAR(255) NOT NULL,
                       email VARCHAR(255) NOT NULL,
                       online BOOLEAN NOT NULL DEFAULT 0
);

CREATE TABLE messages (
                          id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                          from_user VARCHAR(255) NOT NULL,
                          to_user VARCHAR(255) NOT NULL,
                          message TEXT NOT NULL,
                          time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                          is_read BOOLEAN NOT NULL DEFAULT 0
);
