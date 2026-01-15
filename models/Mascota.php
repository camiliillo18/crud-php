<?php
// models/Mascota.php
class Mascota
{  // atributos relativos a la conexión/correspondencia con la Base de Datos, visibilidad private
    private $conn;
    private $table_name = "mascotas";
    
   // las columnas de la tabla son atributos de visibilidad public
    public $idmascota;
    public $nombre;
    public $especie;
    public $edad;
    public $fechaIngreso;
    public $peso;
    public $vacunado;

    public function __construct($db)          // establecer conexión
    {
        $this->conn = $db;
    }

    // Método para leer todas las mascotas. Devuelve la tabla entera
    public function read()
    {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY idmascota ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Método para crear una mascota
    public function create()
    {
        $query = "INSERT INTO " . $this->table_name . " SET nombre=:nombre, especie=:especie, edad=:edad, fechaIngreso=:fechaIngreso, peso=:peso, vacunado=:vacunado";
        $stmt = $this->conn->prepare($query);

        // Limpiar y enlazar parámetros
        $this->nombre = $this->nombre;
        $this->especie = $this->especie;
        $this->edad = $this->edad;
        $this->fechaIngreso = $this->fechaIngreso;
        $this->peso = $this->peso;
        $this->vacunado = $this->vacunado;

        // ... validaciones si fueran necesarias

        $stmt->bindParam(":nombre", $this->nombre);                            // en insertar no se pide la clave primaria
        $stmt->bindParam(":especie", $this->especie);                      // es autoincremental
        $stmt->bindParam(":edad", $this->edad); 
        $stmt->bindParam(":fechaIngreso", $this->fechaIngreso);
        $stmt->bindParam(":peso", $this->peso);
        $stmt->bindParam(":vacunado", $this->vacunado, PDO::PARAM_INT);            // se convierte explicitamente en entero
																																						   // debería ser una casilla de verificación OJO     

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Método para leer una sola mascota (para editar)
    public function readOne()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE idmascota = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->idmascota);
        $stmt->execute();                      // después de un select siempre se obtiene una tabla, y hay que "cortar" filas
        $row = $stmt->fetch(PDO::FETCH_ASSOC); // aquí se extrae una fila como si fuera un array asociativo
                                               // podía haber puesto, que fuera como un objeto FETCH_OBJ
                                               
        if ($row) {                            // ahora se procesa cada campo con las key del array asociativo
            $this->nombre = $row['nombre'];    // si se hubiera convertido en un objeto, trabajaría con $row -> nombre
            $this->especie = $row['especie'];
            $this->edad = $row['edad'];
            $this->fechaIngreso = $row['fechaIngreso'];
            $this->peso = $row['peso'];
            $this->vacunado = $row['vacunado'];
        }
    }

    // Método para actualizar una mascota
    public function update()
    {
        $query = "UPDATE " . $this->table_name . " SET nombre=:nombre, especie=:especie, edad=:edad, fechaIngreso=:fechaIngreso, peso=:peso, vacunado=:vacunado WHERE idmascota=:idmascota";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':nombre', $this->nombre);                          // aquí se procesan los datos desde el objeto alumno
        $stmt->bindParam(':especie', $this->especie);                    // y se vuelcan en la sentencia SQL
        $stmt->bindParam(':edad', $this->edad);
        $stmt->bindParam(':fechaIngreso', $this->fechaIngreso);
        $stmt->bindParam(':peso', $this->peso);
        $stmt->bindParam(':vacunado', $this->vacunado, PDO::PARAM_INT);          // la cadena obtenida en el formulario se convierte en int
        $stmt->bindParam(':idmascota', $this->idmascota, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo "Correcto";
            return true;
        } else {
            // --- CÓDIGO DE DEPURACIÓN AQUÍ ---
            echo "<h3>Error al actualizar:</h3>";
            echo "<pre>";
            print_r($stmt->errorInfo()); // Esto te dirá el error exacto de SQL
            echo "</pre>";
            echo "ID que intentas editar: " . $this->idmascota;
            die(); // Detenemos la ejecución para que puedas leer el error
            // ---------------------------------
        }
    }

    // Método para eliminar una mascota
    public function delete()
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE idmascota = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->idmascota, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}