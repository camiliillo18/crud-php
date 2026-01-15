<?php
    session_start();
    $_SESSION = [];
    // Con este if preguntamos si las sesiones usan cookies
    if (ini_get("session.use_cookies")) {

        // Recuperamos los datos de la cookie actual.
        // Necesitamos saber exactamente cómo se creó la cookie original 
        // (su ruta, su dominio, si es segura...) para poder borrar la correcta.
        $params = session_get_cookie_params();
        
        // Sobrescribimos la cookie.
        setcookie(
            session_name(),  // El nombre de la cookie 
            '',              // El valor nuevo: vacío (borramos el ID)
            time() - 42000,  // La fecha de caducidad: EL PASADO.
                            // Al poner una fecha negativa (hace 42000 segundos),
                            // el navegador la borra.
            
            $params["path"],     // Mismos parámetros que la original
            $params["domain"],   // para asegurarnos de que borramos
            $params["secure"],   // la cookie exacta y no otra.
            $params["httponly"]
        );
    }
    session_destroy();
    header("Location:../index.php");