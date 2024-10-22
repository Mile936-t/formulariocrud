
<?php
        $cedula= $_POST["cedula"]; 
        $nombre= $_POST["nombre"]; 
        $edad= $_POST["edad"]; 
        $correo= $_POST["correo"];
    
    
        include "conexion.php";

        $sql= "INSERT INTO persona (cedula,nombre,edad,correo) VALUES ('$cedula','$nombre','$edad','$correo')";

        $conn->query(query:$sql);
        
        header(header:'Location: ./');

    ?>
