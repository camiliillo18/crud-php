<!-- views/crear.php -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Crear Mascota</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="/CRUD-PHP/assets/css/login.css">
    <link rel="stylesheet" href="/CRUD-PHP/assets/css/editar.css">
</head>

<body>
    <div class="main-form">
        <div>
            <h2>Crear Nueva Mascota</h2>
            <form method="POST" action="index.php?action=create">
                <label>Nombre: <input type="text" name="nombre" required></label><br>
                <label>Especie: <input type="text" name="especie" required></label><br>
                <label>Edad: <input type="text" name="edad" required></label><br>
                <label>Fecha de Ingreso: <input type="date" name="fechaIngreso" required></label><br>
                <label>Peso: <input type="text" name="peso" required></label><br>
                <label>Vacunado: <input type="checkbox" name="vacunado" value="1"></label><br>
                <button type="submit">Crear Mascota</button>
            </form>
            <br>
            <p class="text-center mt-4 mb-0"><a href="index.php?action=index">
                <svg class="volver-atras" clip-rule="evenodd" fill-rule="evenodd" width="75px" height="75px" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m9.474 5.209s-4.501 4.505-6.254 6.259c-.147.146-.22.338-.22.53s.073.384.22.53c1.752 1.754 6.252 6.257 6.252 6.257.145.145.336.217.527.217.191-.001.383-.074.53-.221.293-.293.294-.766.004-1.057l-4.976-4.976h14.692c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-14.692l4.978-4.979c.289-.289.287-.761-.006-1.054-.147-.147-.339-.221-.53-.221-.191-.001-.38.071-.525.215z" fill-rule="nonzero"/></svg>
            </a></p>
        </div>
    </div>
</body>

</html>