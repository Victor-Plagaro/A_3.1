<?php
    //Plantilla encabezado
    include("encabezado.php");
    // Revisa la conexión a la base de datos
    include("conecta_db.php");
     
    if(!empty($_GET))
    {
    //Almacena el id en una variable.
    $id = $_GET['id'];

    try {
        //Consulta para las categorías.
        $consulta = $conn->prepare("SELECT * FROM `categorías`");
        $consulta->execute();
        $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);
        //Consulta para mostrar los datos del producto.
        $consulta = $conn->prepare("SELECT * FROM `productos` WHERE id = $id");
        $consulta->execute();
        $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
        $campos = $resultado[0];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            try {
                // Consulta para eliminar el producto
                $sql = "DELETE FROM productos WHERE `productos`.`id` = $id";
                $conn->exec($sql);

                // Redirige al usuario a consultar_producto.php
                header('Location: ./consultar_producto.php');
                exit(); // Importante para detener la ejecución del script después de la redirección
            } catch (PDOException $e) {
                echo "Error al eliminar el producto: " . $e->getMessage();
            }
        }
    } catch (PDOException $e) {
        echo "Error al recuperar los datos: " . $e->getMessage();
        die();
    }
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
    <main>
    <?php if (empty($_GET['id'])): ?>
            <form action="eliminar_producto.php" method="GET">
                <fieldset>
                    <legend>Seleccionar Producto</legend>
                    <label for="producto_select">
                        Producto
                        <select name="id" id="producto_select">
                            <!--Ejecuta la sentancia para obtener el nombre de los productos-->
                            <?php $consulta = $conn->prepare("SELECT * FROM productos");
                                  $consulta->execute();
                                  $productos = $consulta->fetchAll(PDO::FETCH_ASSOC);?>
                            <!--Muestra el nombre de los productos en el desplegable-->
                            <?php foreach ($productos as $producto): ?>
                                <option value="<?php echo $producto['id']; ?>"><?php echo $producto['Nombre']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </label>
                    <input type="submit" value="Seleccionar">
                </fieldset>
            </form>
        <?php else: ?>
            <!--Muestra el form con los datos del producto seleccionado en el index.php -->
            <form action="eliminar_producto.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data" name="form" autocomplete="off">            
        <fieldset>
            <legend>Producto a eliminar</legend>
                <label for="">
                    Nombre
                    <span class="datos"><?php echo $campos['Nombre']?></span>
                </label>
                <label for="">
                    Precio
                    <span class="datos"><?php echo $campos['Precio']?></span>
                </label>
                <label for="">
                    Imagen
                    <img src=<?php echo $campos['Imagen']?> alt="" width=35px>
                </label>
                <label for="">
                    Categoría
                    <span class="datos"><?php echo $resultados[$campos['Categoría']]['Nombre']?></span>
                </label>
                <input type="submit" name="submit" value="Eliminar">
                <a href="consultar_listado.php"><button class="cnc">Cancelar</button></a>
            </fieldset>
            </form>
        <?php endif; ?>
    </main>
</body>
</html>