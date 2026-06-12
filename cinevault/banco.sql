CREATE DATABASE cinevault;
USE cinevault;

CREATE TABLE usuarios(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    tipo ENUM('admin','user') DEFAULT 'user'
);

CREATE TABLE filmes(
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(150) NOT NULL,
    descricao TEXT,
    ano INT,
    genero VARCHAR(100),
    capa VARCHAR(255)
);