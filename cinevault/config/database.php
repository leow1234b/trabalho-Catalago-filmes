<?php

class Database {

    private $host = "localhost";
    private $port = "3307";
    private $db = "cinevault";
    private $user = "root";
    private $pass = "";


    public function connect(){

        try {

            $conn = new PDO(
                "mysql:host=".$this->host.";port=".$this->port.";dbname=".$this->db,
                $this->user,
                $this->pass
            );

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $conn;

        } catch(PDOException $e){

            die("Erro de conexão: ".$e->getMessage());

        }

    }

}

?>