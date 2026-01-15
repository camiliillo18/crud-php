document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector("form");
    const usuarioError = document.getElementById("usuarioHelp");
    const passwordError = document.getElementById("passwordHelp");

    // Lista de caracteres que NO queremos
    const caracteresEspeciales = "<>()'\"/=";

    form.addEventListener("submit", function(evento) {
        
        // Limpiamos errores
        usuarioError.textContent = "";
        passwordError.textContent = "";
        let hayErrores = false;

        const usuario = document.getElementById("username").value;
        const password = document.getElementById("password").value; 

        // Validamos usuario
        if (usuario.length < 8 || usuario.length > 15) {
            usuarioError.textContent = "El usuario debe tener entre 8 y 15 caracteres.";
            hayErrores = true;
        } else {
            let tieneCaracterMalo = false;

            // Recorremos todos. Si encuentra uno malo, pone la variable a true.
            for (let i = 0; i < caracteresEspeciales.length; i++) {
                if (usuario.includes(caracteresEspeciales[i])) {
                    tieneCaracterMalo = true;
                }
            }

            // Si al acabar el bucle la variable esta true mostramos el error
            if (tieneCaracterMalo) {
                usuarioError.textContent = "El usuario contiene caracteres prohibidos.";
                hayErrores = true;
            }
        }

        // Validamos contraseña
        if (password.length < 8 || password.length > 15) {
            passwordError.textContent = "La contraseña debe tener entre 8 y 15 caracteres.";
            hayErrores = true;

        } else if (password === password.toLowerCase()) {
            // Si la contraseña base es igual a la contraseña entera en minúsculas, es que no tiene mayúsculas
            passwordError.textContent = "La contraseña debe tener al menos una mayúscula.";
            hayErrores = true;

        } else if (password === password.toUpperCase()) {
            // Si la contraseña base es igual a la contraseña entera en mayúsculas, es que no tiene minúsculas
            passwordError.textContent = "La contraseña debe tener al menos una minúscula.";
            hayErrores = true;

        } else {
            // Mismo procedimiento que para el usuario, pero para la contraseña
            let tieneCaracterMalo = false;

            for (let i = 0; i < caracteresEspeciales.length; i++) {
                if (password.includes(caracteresEspeciales[i])) {
                    tieneCaracterMalo = true;
                }
            }

            if (tieneCaracterMalo) {
                passwordError.textContent = "La contraseña contiene caracteres prohibidos.";
                hayErrores = true;
            }
        }

        // Si hay error en algun lado no envia el formulario
        if (hayErrores) {
            evento.preventDefault();
        }
    });
});