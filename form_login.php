<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Login</title>
</head>
<body>
    <main>
        <div id="login_container">
            <h2>Login</h2>
            <form action="form.php" method="POST">
                <label for="nombreUsuario">Nombre de usuario</label>
                <input type="text" name="nombreUsuario" id="nombreUsuario">
    
                <label for="email">Email</label>
                <input type="email" name="email" id="email">
    
                <label for="pswd">Contraseña</label>
                <input type="password" name="pswd" id="pswd">

                <!--Esto sirve para poder bloquear el inicio de seison durante 3min -->

                <?php if(!empty($_COOKIE['errores_login']))
                    {
                        echo("<span>Intentos fallidos: {$_COOKIE['errores_login']} A los 5 se bloquea el login</span>");
                    }?>
                <input type="submit" id="env" value="Login" <?php
                if ($_COOKIE['errores_login'] == 5) {
                    $tiempo_actual = time();
                    $tiempo_limite = $_COOKIE['tiempo_limite'] ?? 0; // Obtiene el tiempo límite de la cookie o establece 0 si no existe

                    // Verifica si ha pasado 1 minuto desde el último bloqueo
                    if ($tiempo_actual - $tiempo_limite >= 60) {
                        // Tu lógica aquí

                        // Después de realizar la acción, actualiza la marca de tiempo en la cookie
                        setcookie('tiempo_limite', $tiempo_actual, $tiempo_actual + 60); // La cookie expirará en 1 minuto
                    } else {
                        echo "disabled"; // Acción deshabilitada porque no ha pasado el tiempo requerido
                    }
                }
                ?>>
            </form>
        </div>
    </main>    
</body>
</html>