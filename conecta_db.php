<?php
    $servername = "localhost";
    $username = "mitiendaonline";
    $password = "";
    $db = "mitiendaonline";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
        // set the PDO error mode to exception
        $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Conexion exitosa";
    } catch (PDOException $e) {
        echo "Conexion fallida " . $e->getMessage();
    }

    echo "<br>He llegado al final<br>"; //Comprobar la ejecucion el code
?>