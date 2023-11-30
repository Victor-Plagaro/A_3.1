<?php
    if(!empty($_SESSION['usuario'])){
        session_start();
    }else{
        header('Location:./form_login.php');
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de la tienda online</title>
    <link rel="stylesheet" href="./css/styleIndex.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500&display=swap" rel="stylesheet">
</head>
<body>
    <header class="nav_container">
        <nav class="central_nav">
            <ul>
                <a href="./crear_producto.php"><li class="list_nav">Crear producto</li></a>
                <a href="./consultar_producto.php"><li class="list_nav">Consultar listado</li></a>
                <a href="./eliminar_producto.php"><li class="list_nav">Eliminar producto</li></a>
            </ul>
            <a href="./disconnectUser.php"><img src="imagenes_web/user_disconnect.png" alt="icono para desloguearse" onclick=""></a>
        </nav>
    </header>
</body>
</html>