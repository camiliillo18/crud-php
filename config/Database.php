<?php
// config/Database.php
class Database
{
    private $host = "localhost";
    private $db_name = "crud-php";
    private $username = "camilo_mascotas";
    private $password = "NoSeQuePoner1234";
    public $conn;

    public function getConnection()
    {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Error de conexión a la base de datos: " . $exception->getMessage();
        }
        return $this->conn;
    }
}