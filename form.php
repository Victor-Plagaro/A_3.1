<?php
    // Revisa la conexión a la base de datos
    include("./conecta_db.php");
    try{
        if(isset($_POST['nombreUsuario'])  && isset($_POST['pswd'])){
            $nombreUsuario = $_POST['nombreUsuario'];
            $correoUsuario = $_POST['email'];

            session_start();
            $_SESSION['usuario']= $nombreUsuario;

            //Consultar
            $sql = $conn -> prepare("SELECT contrasena_hash FROM usuarios2 WHERE nombre='$nombreUsuario'");
            $sql->execute();
            $pswdUsuario = $sql->fetch(PDO::FETCH_ASSOC);
            $pswdEncriptada = $pswdUsuario['contrasena_hash'];
            print_r($pswdUsuario);
            if(password_verify($_POST['pswd'],$pswdEncriptada)){
                echo "Contraseña Correcta";
                header('Location: ./consultar_productos.php');
            }else{
                echo "Contraseña Incorrecta";
            }
        }
    }catch (PDOException $e){
        echo "Error al recuperar los datos: " . $e->getMessage();
        die();
    } 
?>