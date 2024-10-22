<?php
include "conexion.php";

if (isset($_POST['cedula'])) {
    $cedula = $_POST['cedula'];
    $sql = "DELETE FROM persona WHERE cedula = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $cedula);

    if ($stmt->execute()) {
        header("Location: index.php");
    } else {
        echo "Error al eliminar el registro.";
    }

    $stmt->close();
    $conn->close();
}
?>
