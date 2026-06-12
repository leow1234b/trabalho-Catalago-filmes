<?php
require_once __DIR__ . '/../../config/database.php';

class User{
    private $conn;

    public function __construct(){
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function register($nome, $email, $senha){
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        $sql = "INSERT INTO usuarios(nome, email, senha) VALUES(:nome, :email, :senha)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':nome' => $nome,
            ':email' => $email,
            ':senha' => $senhaHash
        ]);
    }

    public function login($email, $senha){
        $sql = "SELECT * FROM usuarios WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if($user && password_verify($senha, $user['senha'])){
            return $user;
        }
        return false;
    }
}
?>