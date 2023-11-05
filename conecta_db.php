<?php
    $servername = "localhost";
    $username = "mitiendaonline";
    $password = "";
    $db = "mitiendaonline";
    /**
     * Mediante MySQLi
    // Create connection
    $conn = new mysqli($servername, $username, $password, $db);

    // Check connection
    if($conn -> connect_error){
        die ("Conexion fallida: " . $conn -> connect_error);
    }
    echo "Conexion correcta";
    */
    
    //Uso de PDO. Es mejor porque es versatil y facil migracion a otros gestores DDBB
    // Create connection
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