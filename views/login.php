<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplicación de Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="/CRUD-PHP/assets/css/login.css">
</head>
<body>
    <div class="main-form">
        <form action="index.php?action=login" method="post">
            <div class="login-container">
                <?php 
                    if (isset($_SESSION['error'])) {
                        echo "<div class='alert alert-danger' role='alert'>";
                        echo  $_SESSION['error'];
                        echo "</div>";
                        unset($_SESSION['error']);
                    }
                ?>
                <h1>LOGIN</h1>
                
                <div class="input-group">
                    <label for="username">Usuario</label>
                    <input type="text" id="username" name="username">
                    <div id="usuarioHelp" class="form-text text-danger"></div>
    
                </div>
                
                <div class="input-group">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password">
                    <div id="passwordHelp" class="form-text text-danger"></div>
                </div>
    
                <div id="loginHelp" class="form-text text-danger"><?= htmlspecialchars($error ?? "")?></div>
                <button type="submit">Iniciar Sesión</button>
                                
                <!-- <div class="footer">
                    Don't have an account? <a href="#">Sign up</a>
                </div> -->
            </div>
        </form>
    </div>
    <script src="/CRUD-PHP/assets/js/validaciones.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>