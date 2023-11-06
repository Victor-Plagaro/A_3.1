<?php
    $servername = "localhost";
    $username = "mitiendaonline";
    $password = "";
    $dbname = "mitiendaonline";
     // Revisa la conexión a la base de datos
     include("C://xampp//htdocs//A_3.1//conecta_db.php");
     
    //Consultar
    try{
        $consulta = $conn -> prepare("SELECT * FROM categorías");
        $consulta->execute();
        $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e){
        echo "Error al recuperar los datos: " . $e->getMessage();
        die();
    } 

    // Verificar si los datos del formulario se enviaron correctamente
    if(isset($_POST['campo_nombre']) && isset($_POST['campo_precio']) && isset($_FILES['campo_archivo']['name']) && !empty($_POST['campo_categoria'])) {
        $nombre = $_POST['campo_nombre'];
        $precio = $_POST['campo_precio'];
        $archivo = $_FILES['campo_archivo']['name'];
        $categoria = $_POST['campo_categoria'];

        // Insertar datos
        try{
            $sql = "INSERT INTO productos (Nombre, Precio, Imagen, Categoría) VALUES ('$nombre', '$precio', '$archivo', '$categoria')";
            // usar exec() porque no devuelva resultados
            $conn->exec($sql);
            echo "Nuevo registro creado con éxito";
        }
        catch(PDOException $e){
                echo $sql . "<br>" . $e -> getMessage();
        }
        $conn = null;
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
                <li class="list_nav">Crear producto</li>
                <li class="list_nav">Consultar listado</li>
                <li class="list_nav">Modificar producto</li>
                <li class="list_nav">Eliminar producto</li>
            </ul>
        </nav>
    </header>
    <main>
        <form action="crear_producto.php" method="post" enctype="multipart/form-data">
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
                    <select id="campo_categoria" name="campo_categoria">
                        <?php 
                            foreach ($resultados as $cat){
                                echo "<option value={$cat['Id']}>{$cat['Nombre']}</option>";
                            }
                        ?>
                    </select>
                </label>
                <input type="submit" value="Enviar">
            </fieldset>
        </form>
    </main>
</body>
</html>