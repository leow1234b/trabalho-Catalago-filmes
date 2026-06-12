<?php
require_once __DIR__ . '/../../config/database.php';

class Movie{
    private $conn;

    public function __construct(){
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function getAll(){
        $sql = "SELECT * FROM filmes ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($titulo, $descricao, $ano, $genero, $capa){
        $sql = "INSERT INTO filmes(titulo, descricao, ano, genero, capa) VALUES(:titulo, :descricao, :ano, :genero, :capa)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':titulo' => $titulo,
            ':descricao' => $descricao,
            ':ano' => $ano,
            ':genero' => $genero,
            ':capa' => $capa
        ]);
    }

    public function getById($id){
        $sql = "SELECT * FROM filmes WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>