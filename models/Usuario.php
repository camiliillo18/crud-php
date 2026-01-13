<?php
class Usuario {
    private $conn;
    private $table_name = "usuarios";

    public $usuario;
    public $password;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function buscarPorUsuario() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE usuario=:user LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user', $this->usuario);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC); // Devuelve el array con los datos del usuario
    }
}