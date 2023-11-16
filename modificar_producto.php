<?php
// Plantilla encabezado
include("./encabezado.html");
// Revisa la conexión a la base de datos
include("./conecta_db.php");
// Establece el directorio de destino.
$destino = "./imagenes/";
opendir($destino);

// Verificar si se proporciona un ID válido en la URL
if (!empty($_GET)) {
    $producto_id = $_GET['id'];

    // Consultar datos del producto y las categorias
    try {
        $consulta_producto = $conn->prepare("SELECT * FROM productos WHERE id =  $producto_id");
        $consulta_producto->execute();
        $producto = $consulta_producto->fetch(PDO::FETCH_ASSOC);

        $consulta_categorias = $conn->prepare("SELECT * FROM categorías");
        $consulta_categorias->execute();
        $resultados_categorias = $consulta_categorias->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error al recuperar los datos del producto: " . $e->getMessage();
        die();
    }
    // Verificar si los datos del formulario se enviaron correctamente
    if (isset($_POST['campo_nombre']) && isset($_POST['campo_precio']) && isset($_POST['campo_categoria'])) {
        //Guardar los campos
        $nombre = $_POST['campo_nombre'];
        $precio = $_POST['campo_precio'];
        $categoria = $_POST['campo_categoria'];

        try {
            // Comprueba si se insertó una imagen en el formulario y actualiza la imagen del producto.
            if (isset($_FILES['imagen']['name']) && !empty($_FILES['imagen']['name'])) {
                $imagen_nombre = $_FILES['imagen']['name'];
                $nombre_temporal = $_FILES['imagen']['tmp_name'];
                $ruta_tmp = $destino . $imagen_nombre;
        
                // Mueve la imagen al directorio.
                move_uploaded_file($nombre_temporal, $ruta_tmp);
        
                // Ejecuta la sentencia con la nueva imagen.
                $sql = "UPDATE productos SET Nombre = '$nombre', Precio = '$precio', Categoría = '$categoria', Imagen = '$ruta_tmp' WHERE productos.id = '$producto_id'";
            } else {
                // Si no se proporciona una nueva imagen, mantener la imagen actual en la base de datos.
                $sql = "UPDATE productos SET Nombre = '$nombre', Precio = '$precio', Categoría = '$categoria' WHERE productos.id = '$producto_id'";
            }
        
            $conn->exec($sql);
        
            // Redirige al usuario al index.php, para evitar que al refrescar la página inserte de nuevo los datos en la BBDD, ya que se almacenan en la caché.
            header('Location: ./consultar_producto.php');
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Producto</title>
    <link rel="stylesheet" href="./css/styleIndex.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500&display=swap" rel="stylesheet">
</head>
<body>
    <main>
        
        <form action="">

        </form>
        <form action="modificar_producto.php?id=<?php echo $producto_id; ?>" method="POST" enctype="multipart/form-data">
            <fieldset>
                <legend>Datos a modificar</legend>
                <label>ID:
                    <input type="text" name="campo_id" value="
                        <?php echo $producto['id']; ?>" 
                    >
                </label>
                <label>Nombre:
                    <input type="text" name="campo_nombre" value="
                        <?php echo $producto['Nombre']; ?>"
                    >
                </label>
                <label>Precio:
                    <input type="text" name="campo_precio" value="
                        <?php echo $producto['Precio']; ?>"
                    >
                </label>
                <label>Imagen actual:
                    <img src="<?php echo $producto['Imagen']; ?>" width="90px">
                </label></br>
                <label>Nueva imagen:
                    <input type="file" name="imagen">
                </label>
                <label>Categoria:
                    <select id="campo_categoria" name="campo_categoria">
                        <?php
                        foreach ($resultados_categorias as $cat) {
                            $selected = ($cat['Id'] == $producto['Categoría']) ? 'selected' : '';
                            echo "<option value={$cat['Id']} $selected>{$cat['Nombre']}</option>";
                        }
                        ?>
                    </select>
                </label>
                <input type="submit" value="Guardar" >
            </fieldset>
        </form>
    </main>
</body>
</html>
<?php
} else {
    // Manejar el caso en que no se proporciona un ID válido
    echo "ID de producto no válido";
}
?>