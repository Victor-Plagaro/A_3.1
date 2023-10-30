<?php

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de la tienda online</title>
    <link rel="stylesheet" href="css/styleIndex.css">
    <link rel="stylesheet" href="css/styleProducto.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500&display=swap" rel="stylesheet">
</head>
<body>
    <header class="nav_container">
        <nav class="central_nav">
            <ul>
                <li class="list_nav">Crear producto</li>
                <li class="list_nav">Consultar listado</li>
                <li class="list_nav">Modificar producto</li>
                <li class="list_nav">Eliminar producto</li>
            </ul>
        </nav>
    </header>
    <main>
        <form action="index.php" method="post" enctype="multipart/form-data">
            <fieldset>
                <legend>Datos del producto</legend>
                <label>Nombre:
                    <input type="text" name="campo_nombre">
                </label>
                <label>Precio:
                    <input type="text" name="campo_precio">
                </label>
                <label>Imagen:
                    <input type="file" name="campo_archivo">
                </label>
                <label>Categoria:
                    <input type="text" name="campo_categoria">
                </label>
            </fieldset>
        </form>
    </main>
</body>
</html>