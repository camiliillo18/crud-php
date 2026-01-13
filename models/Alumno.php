<?php
// models/Alumno.php
class Alumno
{  // atributos relativos a la conexión/correspondencia con la Base de Datos, visibilidad private
    private $conn;
    private $table_name = "alumnos";
    
   // las columnas de la tabla son atributos de visibilidad public
    public $numAlumno;
    public $nombre;
    public $apellidos;
    public $fechaNacimiento;
    public $repite;

    public function __construct($db)          // establecer conexión
    {
        $this->conn = $db;
    }

    // Método para leer todos los alumnos. Devuelve la tabla entera
    public function read()
    {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY numAlumno ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Método para crear un alumno
    public function create()
    {
        $query = "INSERT INTO " . $this->table_name . " SET nombre=:nombre, apellidos=:apellidos, fechaNacimiento=:fechaNacimiento, repite=:repite";
        $stmt = $this->conn->prepare($query);

        // Limpiar y enlazar parámetros
        $this->nombre = $this->nombre;
        $this->apellidos = $this->apellidos;
        // ... validaciones si fueran necesarias

        $stmt->bindParam(":nombre", $this->nombre);                            // en insertar no se pide la clave primaria
        $stmt->bindParam(":apellidos", $this->apellidos);                      // es autoincremental
        $stmt->bindParam(":fechaNacimiento", $this->fechaNacimiento);
        $stmt->bindParam(":repite", $this->repite, PDO::PARAM_INT);            // se convierte explicitamente en entero
																																						   // debería ser una casilla de verificación OJO     

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Método para leer un solo alumno (para editar)
    public function readOne()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE numAlumno = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->numAlumno);
        $stmt->execute();                      // después de un select siempre se obtiene una tabla, y hay que "cortar" filas
        $row = $stmt->fetch(PDO::FETCH_ASSOC); // aquí se extrae una fila como si fuera un array asociativo
                                               // podía haber puesto, que fuera como un objeto FETCH_OBJ
                                               
        if ($row) {                            // ahora se procesa cada campo con las key del array asociativo
            $this->nombre = $row['nombre'];    // si se hubiera convertido en un objeto, trabajaría con $row -> nombre
            $this->apellidos = $row['apellidos'];
            $this->fechaNacimiento = $row['fechaNacimiento'];
            $this->repite = $row['repite'];
        }
    }

    // Método para actualizar un alumno
    public function update()
    {
        $query = "UPDATE " . $this->table_name . " SET nombre=:nombre, apellidos=:apellidos, fechaNacimiento=:fechaNacimiento, repite=:repite WHERE numAlumno=:numAlumno";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':nombre', $this->nombre);                          // aquí se procesan los datos desde el objeto alumno
        $stmt->bindParam(':apellidos', $this->apellidos);                    // y se vuelcan en la sentencia SQL
        $stmt->bindParam(':fechaNacimiento', $this->fechaNacimiento);
        $stmt->bindParam(':repite', $this->repite, PDO::PARAM_INT);          // la cadena obtenida en el formulario se convierte en int
        $stmt->bindParam(':numAlumno', $this->numAlumno, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Método para eliminar un alumno
    public function delete()
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE numAlumno = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->numAlumno, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}