<?php
require_once './models/Usuario.php';

class AuthController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $userModel = new Usuario($this->db);
            $userModel->usuario = $_POST['username'];
            $password_escrita = $_POST['password'];

            $datos_db = $userModel->buscarPorUsuario();

            if ($datos_db && $password_escrita == $datos_db['password']) {
                session_start();
                $_SESSION['logueado'] = true;
                $_SESSION['nombre_usuario'] = $datos_db['username'];

                header("Location: index.php?action=index"); // Te manda a la lista de alumnos
                exit;
            } else {
                $error = "Usuario o clave incorrectos";
                include './views/login.php';
            }
        } else {
            include './views/login.php';
        }
    }
}

    