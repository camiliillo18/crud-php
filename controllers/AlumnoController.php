<?php
// controllers/AlumnoController.php
include_once 'config/Database.php';
include_once 'models/Alumno.php';

class AlumnoController
{
    private $db;
    private $alumno; // objeto alumno, para controlar intercambios bd-memoria ppal

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->alumno = new Alumno($this->db);
    }

    public function index() {
        $stmt = $this->alumno->read();               // invoca la operación read del modelo (SELECT * de la tabla entera)
        $alumnos = $stmt->fetchAll(PDO::FETCH_ASSOC);// lo convierte todo al formato array asociativo (es un array de filas)
        include 'views/listar.php';                  // incluye aquí el código de listar (mostrar tabla por pantalla)
    }

    public function create() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->alumno->nombre = $_POST['nombre'];
            $this->alumno->apellidos = $_POST['apellidos'];
            $this->alumno->fechaNacimiento = $_POST['fechaNacimiento'];
            $this->alumno->repite = isset($_POST['repite']) ? 1 : 0;

            if ($this->alumno->create()) {
                header("Location: index.php?action=index&message=created");
                exit();
            } else {
                $error = "Error al crear alumno.";
                include 'views/crear.php'; // Recargar vista con error
            }
        } else {
            include 'views/crear.php';
        }
    }

    public function edit() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Lógica de actualización (UPDATE)
            $this->alumno->numAlumno = $_POST['numAlumno'];
            $this->alumno->nombre = $_POST['nombre'];
            $this->alumno->apellidos = $_POST['apellidos'];
            $this->alumno->fechaNacimiento = $_POST['fechaNacimiento'];
            $this->alumno->repite = isset($_POST['repite']) ? 1 : 0;

            if ($this->alumno->update()) {
                header("Location: index.php?action=index&message=updated");
                exit();
            } else {
                $error = "Error al actualizar.";
            }
        }

        // Lógica para mostrar el formulario de edición (READ ONE)
        if (isset($_GET['id'])) {
            $this->alumno->numAlumno = $_GET['id'];
            $this->alumno->readOne();
            if ($this->alumno->nombre) {
                $alumno_data = (object)['numAlumno' => $this->alumno->numAlumno, 'nombre' => $this->alumno->nombre, 'apellidos' => $this->alumno->apellidos, 'fechaNacimiento' => $this->alumno->fechaNacimiento, 'repite' => $this->alumno->repite];
                include 'views/editar.php';
            } else {
                echo "Alumno no encontrado.";
            }
        }
    }

    public function delete() {  // esta operación NO TIENE VISTA ASOCIADA, solo mensajes                                                                  // de confirmación o error
        if (isset($_GET['id'])) {
            $this->alumno->numAlumno = $_GET['id'];
            if ($this->alumno->delete()) {
                header("Location: index.php?action=index&message=deleted");
                exit();
            } else {
                header("Location: index.php?action=index&message=error_delete");
                exit();
            }
        }
    }
}