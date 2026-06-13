<?php
if (!defined('APP_STARTED')) {
    exit('Acesso negado.');
}

class Database {
    private $host = 'localhost';
    private $dbname = 'cinevault';
    private $user = 'root';
    private $pass = '';

    public function connect() {
        try {
            $conn = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname};charset=utf8mb4",
                $this->user,
                $this->pass
            );
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $conn;
        } catch (PDOException $e) {
            error_log('Erro PDO: ' . $e->getMessage());
            die('Não foi possível conectar ao banco de dados.');
        }
    }
}
