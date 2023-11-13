<?php
// Plantilla encabezado
include("./encabezado.html");
// Revisa la conexión a la base de datos
include("./conecta_db.php");
// Establece el directorio de destino.
$destino = "./imagenes/";
opendir($destino);

// Verificar si se proporciona un ID válido en la URL
if (isset($_GET['id'])) {
    $producto_id = $_GET['id'];

    // Consultar datos del producto por ID
    try {
        $consulta_producto = $conn->prepare("SELECT * FROM productos WHERE id =  $producto_id");
        $consulta_producto->execute();
        $producto = $consulta_producto->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error al recuperar los datos del producto: " . $e->getMessage();
        die();
    }

    // Consultar categorías
    try {
        $consulta_categorias = $conn->prepare("SELECT * FROM categorías");
        $consulta_categorias->execute();
        $resultados_categorias = $consulta_categorias->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error al recuperar las categorías: " . $e->getMessage();
        die();
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
        <form action="procesar_modificacion.php" method="post" enctype="multipart/form-data">
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
                    <img src="<?php echo $producto['Imagen']; ?>" alt="Imagen actual" width="90px">
                </label>
                <label>Nueva imagen:
                    <input type="file" name="campo_archivo">
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
                <input type="submit" value="Guardar cambios">
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