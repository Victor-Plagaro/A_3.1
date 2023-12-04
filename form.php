<?php
include("./conecta_db.php");
try{
    if(isset($_POST['nombreUsuario']) && isset($_POST['email']) && isset($_POST['pswd']))
    {
        $nombreUser=$_POST['nombreUsuario'];
        $correoUser=$_POST['email'];
        
        //Para poder iniciar sesion
        session_start();
        $_SESSION['usuario']=$nombreUser;

        //Para poder carga en una variable de sesión, hacemos una consulta
        $sql = $conn->prepare("SELECT nombre FROM usuarios WHERE nombre ='$nombreUser'");
        $sql->execute();
        $consulta=$sql->fetch(PDO::FETCH_ASSOC);
        $sesionUser=$consulta['nombre'];
        setcookie('usuario',$sesionUser);

        $sql = $conn->prepare("SELECT contrasena_hash FROM usuarios WHERE nombre ='$nombreUser'");
        $sql->execute();
        $consulta=$sql->fetch(PDO::FETCH_ASSOC);
        $pswdUser=$consulta['contrasena_hash'];
    
        if(password_verify($_POST['pswd'],$pswdUser))
        {
            echo("Contraseña correcta");

            //Consulta para coger el color que quiere el usuario
            $sql = $conn->prepare("SELECT color_fondo FROM usuarios WHERE nombre ='$nombreUser'");
            $sql->execute();
            $consulta=$sql->fetch(PDO::FETCH_ASSOC);
            $color = $consulta['color_fondo'];

            //Creamos la cookie para asignar el color segun el usuario
            if($color != null){
                setcookie("color_fondo", $color, time()+3600*24);
            }else{
                setcookie("color_fondo", "gray", time()+3600*24);
            }
            
            //Redirigimos al usuario
            header('Location: ./listar_productos.php');
        }else{
            //Para que contar los 5 intentos de inicio de sesion
            if(!isset($_COOKIE['errores_login'])){
                setcookie("errores_login", 1);
            }else{
                $contador_errores = $_COOKIE['errores_login'];
                $contador_errores++;
                setcookie("errores_login", $contador_errores);
            }
        } 
    }
}catch (Exception $e) {
    echo $e->getMessage();
    die();
}
?>