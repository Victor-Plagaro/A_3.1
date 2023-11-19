<?php
    // Revisa la conexión a la base de datos
    require("./conecta_db.php");
    
    if(isset($_POST['nombreUsuario'])  && isset($_POST['pswd'])){
        $nombreUsuario = $_POST['nombreUsuario'];
        $correoUsuario = $_POST['email'];
        $contraseñaUsuario = $_POST['pswd'];

        //Consultar
        try{
            $consulta = $conn -> prepare("SELECT contrasena_hash FROM usuarios2 WHERE nombre='$nombreUsuario'");
            $consulta->execute();
            $pswdUsuario = $consulta->fetch(PDO::FETCH_ASSOC);
            $pswdEncriptada = $pswdUsuario['contrasena_hash'];
            if(password_verify($contraseñaUsuario, $pswdEncriptada)){
                echo "Contraseña Correcta";
            }else{
                echo "Contraseña Incorrecta";
            }
        } catch (PDOException $e){
            echo "Error al recuperar los datos: " . $e->getMessage();
            die();
        } 
    }
?>