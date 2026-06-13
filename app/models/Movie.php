<?php
if (!defined('APP_STARTED')) {
    exit('Acesso negado.');
}

require_once __DIR__ . '/../../config/database.php';

class Movie {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function getAll() {
        $sql = 'SELECT filmes.*, usuarios.nome AS usuario_nome
                FROM filmes
                INNER JOIN usuarios ON usuarios.id = filmes.usuario_id
                ORDER BY filmes.id DESC';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($titulo, $descricao, $ano, $genero, $capa, $usuarioId) {
        $sql = 'INSERT INTO filmes(titulo, descricao, ano, genero, capa, usuario_id)
                VALUES(:titulo, :descricao, :ano, :genero, :capa, :usuario_id)';
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':titulo', $titulo, PDO::PARAM_STR);
        $stmt->bindValue(':descricao', $descricao, PDO::PARAM_STR);
        $stmt->bindValue(':ano', $ano, $ano === null ? PDO::PARAM_NULL : PDO::PARAM_INT);
        $stmt->bindValue(':genero', $genero, PDO::PARAM_STR);
        $stmt->bindValue(':capa', $capa, PDO::PARAM_STR);
        $stmt->bindValue(':usuario_id', $usuarioId, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function getById($id) {
        $sql = 'SELECT * FROM filmes WHERE id = :id';
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $titulo, $descricao, $ano, $genero, $capa, $usuarioId) {
        $sql = 'UPDATE filmes
                SET titulo = :titulo,
                    descricao = :descricao,
                    ano = :ano,
                    genero = :genero,
                    capa = :capa
                WHERE id = :id AND usuario_id = :usuario_id';
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':titulo', $titulo, PDO::PARAM_STR);
        $stmt->bindValue(':descricao', $descricao, PDO::PARAM_STR);
        $stmt->bindValue(':ano', $ano, $ano === null ? PDO::PARAM_NULL : PDO::PARAM_INT);
        $stmt->bindValue(':genero', $genero, PDO::PARAM_STR);
        $stmt->bindValue(':capa', $capa, PDO::PARAM_STR);
        $stmt->bindValue(':usuario_id', $usuarioId, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function delete($id, $usuarioId) {
        $sql = 'DELETE FROM filmes WHERE id = :id AND usuario_id = :usuario_id';
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':usuario_id', $usuarioId, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
