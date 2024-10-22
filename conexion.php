<?php
    // Datos de conexión
    $_servername = "localhost";
    $username = "root";
    $password = "";
    $bdname = "formulario";

    // Crear la conexión
    $conn = new mysqli($_servername, $username, $password, $bdname);

    // Comprobar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }
?>
