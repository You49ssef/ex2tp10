CREATE DATABASE TP10;
USE TP10;
CREATE TABLE exercice (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(25),
    auteur VARCHAR(25),
    date_creation DATETIME,
);