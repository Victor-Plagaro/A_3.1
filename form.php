<?php
include("./conecta_db.php");
try{
    if(isset($_POST['nombreUsuario']) && isset($_POST['email']) && isset($_POST['pswd']))
    {
        $nombreUser=$_POST['nombreUsuario'];
        $correoUser=$_POST['email'];
        
        session_start();
        $_SESSION['usuario']=$nombreUser;

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
            if(!isset($_COOKIE['errores_login'])){
                setcookie("errores_login", 1);
            }else{
                $contador_errores = $_COOKIE['errores_login'];
                $contador_errores++;
                setcookie
            }
        } 
    }
}catch (Exception $e) {
    echo $e->getMessage();
    die();
}
?>