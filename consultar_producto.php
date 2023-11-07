<?php
    //Plantilla encabezado
    include("C://xampp//htdocs//A_3.1//encabezado.html");
    // Revisa la conexión a la base de datos
    include("C://xampp//htdocs//A_3.1//conecta_db.php");
     
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
                        echo("<td>{$filas['Imagen']}</td>");
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
                        
                    echo "</tr>";
                }
            ?>
        </table>
    </main>
</body>
</html>