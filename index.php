<?php
// 1. Iniciamos sesión
session_start();

// 2. Incluimos la conexión (Asegúrate de que la ruta sea correcta)
require_once './config/Database.php'; 
$database = new Database();
$db = $database->getConnection();

// 3. Primero determinamos la acción
// es lo mismo que esta sentencia pero mas corta 
// $action = isset($_GET['action']) ? $_GET['action'] : 'index';
$action = $_GET['action'] ?? 'login'; 

// 4. EL PORTERO: Si no está logueado y no va al login, lo echamos
if (!isset($_SESSION['logueado']) && $action !== 'login') {
    header('Location: index.php?action=login');
    exit;
}

// 5. Cargamos los controladores
require_once './controllers/MascotaController.php';
require_once './controllers/AuthController.php';

// 6. Creamos las instancias pasándole la base de datos ($db)
$controller = new MascotaController($db);
$controllerLogin = new AuthController($db);

// 7. El Switch de rutas
switch ($action) {
    case 'login':
        $controllerLogin->login();
        break;
    case 'index':
        $controller->index();
        break;
    case 'create':
        $controller->create();
        break;
    case 'edit':
        $controller->edit();
        break;
    case 'delete':
        $controller->delete();
        break;
    case 'logout':
        include 'logout.php';
        break;
    default:
        $controller->index();
        break;
}