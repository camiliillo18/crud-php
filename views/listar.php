<!-- views/listar.php -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Listado de Mascotas (MVC)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="/CRUD-PHP/assets/css/login.css">
</head>

<body>
    <div class="d-flex justify-content-between container w-100 my-4 header-container">
        <p><?php echo $_SESSION['nombre_usuario'] ?><p>
        <p class="text-end "><a class="a-btn" href="/CRUD-PHP/views/logout.php">Logout</a></p>
    </div>
    <div class="container my-5">
        <h2 class="text-center">Listado de Mascotas</h2>
    
        <?php if (isset($_GET['message'])): ?>
            <div class="message">
                <?php
                // aquí se mostrarían los diferentes mensajes de confirmación tras la realización
                // de cualquiera de las 3 operaciones restantes: crear, modificar, eliminar
                // ya que volveremos a esta vista
                if ($_GET['message'] == 'created') echo '<p class="text-center text-success text-neon my-4">Mascota creada correctamente.</p>';
                if ($_GET['message'] == 'updated') echo '<p class="text-center text-success text-neon my-4">Mascota actualizada correctamente.</p>';
                if ($_GET['message'] == 'deleted') echo '<p class="text-center text-success text-neon my-4">Mascota eliminada correctamente.</p>';
                ?>
            </div>
        <?php endif; ?>
    
        <p class="text-center"><a class="btn btn-primary" href="index.php?action=create">Añadir Nueva Mascota</a></p>
        <div class="container listar-container">
            <table class="table table-hover text-center">
                <thead>
                    <tr>
                        <th>Id Mascota</th>
                        <th>Nombre</th>
                        <th>Especie</th>
                        <th>Edad</th>
                        <th>Fecha Ingreso</th>
                        <th>Peso</th>
                        <th>Vacunado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($mascotas as $mascota): ?><!-- mascota es una colección de filas de la tabla -->
                        <tr>
                            <td><?php echo $mascota['idmascota']; ?></td>
                            <td><?php echo htmlspecialchars($mascota['nombre']); ?></td>
                            <td><?php echo htmlspecialchars($mascota['especie']); ?></td>
                            <td><?php echo htmlspecialchars($mascota['edad']); ?></td>
                            <td><?php echo htmlspecialchars($mascota['fechaIngreso']); ?></td>
                            <td><?php echo htmlspecialchars($mascota['peso']); ?></td>
                            <td><?php echo $mascota['vacunado'] ? 'Sí' : 'No'; ?></td>
                            <td>
                                <!-- en la última celda incluimos los botones para ir a borrar o editar una fila -->
                                <a href="index.php?action=edit&id=<?php echo $mascota['idmascota']; ?>" class="btn btnn btn-warning">Editar</a> |
                                <a href="index.php?action=delete&id=<?php echo $mascota['idmascota']; ?>" onclick="return confirm('¿Estás seguro?');" class="btn btn-danger">Eliminar</a>
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