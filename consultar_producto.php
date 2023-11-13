<?php
    //Plantilla encabezado
    include("./encabezado.html");
    // Revisa la conexión a la base de datos
    include("./conecta_db.php");
     
    //Consultar
    try{
        $consulta = $conn -> prepare("SELECT * FROM productos");
        $consulta->execute();
        $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e){
        echo "Error al recuperar los datos: " . $e->getMessage();
        die();
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
        <table>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Imagen</th>
                <th>Categoria</th>
            </tr>
            <?php
                foreach($resultados as $filas){
                    echo "<tr>";
                        echo("<td>{$filas['id']}</td>");
                        echo("<td>{$filas['Nombre']}</td>");
                        echo("<td>{$filas['Precio']}</td>");
                        echo("<td><img src={$filas['Imagen']} width=90px></td>");
                        echo "<td>";
                        switch($filas['Categoría']){
                            case 1:
                                echo "Camisetas";
                                break;
                            case 2:
                                echo "Blusas";
                                break;
                            case 3:
                                echo "Pantalones";
                                break;
                            case 4:
                                echo "Chaquetas";
                                break;

                        }
                        echo "</td>";
                        echo("<td><a href='./modificar_producto.php?id={$filas['id']}'><img src='./imagenes_web/edit_icon.svg' alt=Icono de modificar width=30px></a></td>");
                        echo("<td><a href='./eliminar_producto.php'><img src='./imagenes_web/delete_icon.svg' alt=Icono de eliminar  width=30px></a></td>");
                    echo "</tr>";
                }
            ?>
        </table>
        <a href=""><img src="" alt=""></a>
    </main>
</body>
</html>