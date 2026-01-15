<?php
// controllers/MascotaController.php
include_once 'config/Database.php';
include_once 'models/Mascota.php';

class MascotaController
{
    private $db;
    private $mascota; // objeto mascota, para controlar intercambios bd-memoria ppal

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->mascota = new Mascota($this->db);
    }

    public function index() {
        $stmt = $this->mascota->read();               // invoca la operación read del modelo (SELECT * de la tabla entera)
        $mascotas = $stmt->fetchAll(PDO::FETCH_ASSOC);// lo convierte todo al formato array asociativo (es un array de filas)
        include 'views/listar.php';                  // incluye aquí el código de listar (mostrar tabla por pantalla)
    }

    public function create() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->mascota->nombre = $_POST['nombre'];
            $this->mascota->especie = $_POST['especie'];
            $this->mascota->edad = $_POST['edad'];
            $this->mascota->fechaIngreso = $_POST['fechaIngreso'];
            $this->mascota->peso = $_POST['peso'];
            $this->mascota->vacunado = isset($_POST['vacunado']) ? 1 : 0;

            if ($this->mascota->create()) {
                header("Location: index.php?action=index&message=created");
                exit();
            } else {
                $error = "Error al crear mascota.";
                include 'views/crear.php'; // Recargar vista con error
            }
        } else {
            include 'views/crear.php';
        }
    }

    public function edit() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Lógica de actualización (UPDATE)
            $this->mascota->idmascota = $_POST['idmascota'];
            $this->mascota->nombre = $_POST['nombre'];
            $this->mascota->especie = $_POST['especie'];
            $this->mascota->edad = $_POST['edad'];
            $this->mascota->fechaIngreso = $_POST['fechaIngreso'];
            $this->mascota->peso = $_POST['peso'];
            $this->mascota->vacunado = isset($_POST['vacunado']) ? 1 : 0;

            if ($this->mascota->update()) {
                header("Location: index.php?action=index&message=updated");
                exit();
            } else {
                $error = "Error al actualizar.";
            }
        }

        // Lógica para mostrar el formulario de edición (READ ONE)
        if (isset($_GET['id'])) {
            $this->mascota->idmascota = $_GET['id'];
            $this->mascota->readOne();
            if ($this->mascota->nombre) {
                $mascota_data = (object)['idmascota' => $this->mascota->idmascota, 'nombre' => $this->mascota->nombre, 'especie' => $this->mascota->especie, 'edad' => $this->mascota->edad, 'fechaIngreso' => $this->mascota->fechaIngreso, 'peso' => $this->mascota->peso, 'vacunado' => $this->mascota->vacunado];
                include 'views/editar.php';
            } else {
                echo "Mascota no encontrada.";
            }
        }
    }

    public function delete() {  // esta operación NO TIENE VISTA ASOCIADA, solo mensajes                                                                  // de confirmación o error
        if (isset($_GET['id'])) {
            $this->mascota->idmascota = $_GET['id'];
            if ($this->mascota->delete()) {
                header("Location: index.php?action=index&message=deleted");
                exit();
            } else {
                header("Location: index.php?action=index&message=error_delete");
                exit();
            }
        }
    }
}