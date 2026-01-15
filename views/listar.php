<!-- views/listar.php -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Listado de Alumnos (MVC)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    <div class="container my-5">
        <h2 class="text-center">Listado de Alumnos</h2>
    
        <?php if (isset($_GET['message'])): ?>
            <div class="message">
                <?php
                // aquí se mostrarían los diferentes mensajes de confirmación tras la realización
                // de cualquiera de las 3 operaciones restantes: crear, modificar, eliminar
                // ya que volveremos a esta vista
                if ($_GET['message'] == 'created') echo 'Alumno creado correctamente.';
                if ($_GET['message'] == 'updated') echo 'Alumno actualizado correctamente.';
                if ($_GET['message'] == 'deleted') echo 'Alumno eliminado correctamente.';
                ?>
            </div>
        <?php endif; ?>
    
        <p class="text-center"><a class="btn btn-primary" href="index.php?action=create">Añadir Nuevo Alumno</a></p>
        <div class="container">
            <table class="table table-hover text-center">
                <thead>
                    <tr>
                        <th>Num Alumno</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Fecha Nacimiento</th>
                        <th>Repite</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($alumnos as $alumno): ?><!-- alumno es una colección de filas de la tabla -->
                        <tr>
                            <td><?php echo $alumno['numAlumno']; ?></td>
                            <td><?php echo htmlspecialchars($alumno['nombre']); ?></td>
                            <td><?php echo htmlspecialchars($alumno['apellidos']); ?></td>
                            <td><?php echo htmlspecialchars($alumno['fechaNacimiento']); ?></td>
                            <td><?php echo $alumno['repite'] ? 'Sí' : 'No'; ?></td>
                            <td>
                                <!-- en la última celda incluimos los botones para ir a borrar o editar una fila -->
                                <a href="index.php?action=edit&id=<?php echo $alumno['numAlumno']; ?>" class="btn btnn btn-warning">Editar</a> |
                                <a href="index.php?action=delete&id=<?php echo $alumno['numAlumno']; ?>" onclick="return confirm('¿Estás seguro?');" class="btn btn-danger">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>