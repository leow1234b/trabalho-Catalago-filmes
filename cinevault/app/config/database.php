<?php

class Database{
    private $host = "localhost";
    private $dbname = "cinevault";
    private $user = "root";
    private $pass = "";

    public function connect(){
        try{
            $conn = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname}",
                $this->user,
                $this->pass
            );

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $conn;

        } catch(PDOException $e) {
            die("Erro: " . $e->getMessage());
        }
    }
}
?>